<?php
	require_once("includes/db_connect.php");
	require_once("includes/functions.php");
?>

<?php
	//find session
	session_start();

	//unset all session variables 
	$_SESSION = array();

	if(isset($_COOKIE[session_name()])){
		setcookie(session_name(), '', time()-20, '/'); //let cookie know when to expire
	}

	//destroy session
	session_destroy();

	redirect_to("login.php?logout=1");
?>