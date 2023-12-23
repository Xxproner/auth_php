<a href="index.php?do=exit"> exit </a>

<?php
if ( isset ( $_GET [ 'do' ]) && $_GET [ 'do' ] === 'exit'){
	if (isset( $_SESSION['res'])){
		echo $_SESSION['res'];
	}
	unset ( $_SESSION [ 'admin' ]); 
	header ( "Location: index.php" );
	// die;
}
?>