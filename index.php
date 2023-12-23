<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "db";
try{
	$pdo = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	session_start();
	if (isset($_POST['log_in'])){
		$error = login($pdo);
	}else if(isset($_POST['log_up'])){
		$error = new_user($pdo);
	}
	/*$temp = $pdo->prepare("CREATE TABLE users(
			name VARCHAR(30) NOT NULL,
	 		password VARCHAR(30) NOT NULL,
	 		number VARCHAR(30) NOT NULL)");
	$temp->execute();*/
	echo $_SESSION['res'];
	$pdo = null;
}catch(PDOException $ex){
	echo $ex->getMessage();
	die;
}
function login($pdo){
	if(!empty( $_POST['login']) && !empty($_POST['password'])){
// создаем сессионную переменную
		$login = $_POST['login']; 
		$password = $_POST['password'];

		$stmt = $pdo->prepare("SELECT password FROM users WHERE login = ? LIMIT 1");
		$stmt->execute([$login]);
		if ($stmt->rowCount() == 1 && $stmt == $password){
				$_SESSION['res'] = "Nice to see you" . $login;
				header( "Location: sign_in.php");         
		}else{  
			$_SESSION['res'] = "Incorrect login and password";      
		}      
	}else{
		$_SESSION['res'] = 'Sorry, fields mush be filled<br/>';
	}
}

function new_user($pdo){
	$pattern_number = '/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/';
	// $pattern_name = '/\w{3,}/';
	// $pattern_mail = '/\w+@\w+\.\w+/';
	// $pattern_password = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/';
	header("Location: sign_up.php");
	
}

include ('index.html');
?>


