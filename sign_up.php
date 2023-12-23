 <html>
<body>
  <form action="/" method="POST">
    Login: <input type="text" name="login" /> 
    Password:<input type="password" name="password" />
    Number: <input type="text" name="number" />
   <input type="submit" value="Sign up" name="log_up"/>
  </form>
</body>
</html>

<?php
  if (isset($_POST['log_up'])){
    echo "Login and password should contains 30 symbols or less<br/>";
    if (!empty($_POST['login']) && 
        !empty($_POST['password']) &&
        !empty($_POST['number'])){
        if (preg_match($pattern_number, $_POST['number'])){
          try{
            $task_db = $pdo->prepare("INSERT INTO users
              (login, password, number)
              VALUES($_POST['login'], $_POST['password'], $_POST['number']");
              $task_db->execute();
              echo "Success saving<br/>";
          }catch(PDOException $ex){
            echo $ex->getMessage();
            echo "Error with saving, try again later<br/>";
          }
        }else{
          echo "Incorrect phone number<br/>";
        }
      
    }else{
      echo "Please, input information<br/>";
    }
  }
?>