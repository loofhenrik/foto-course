<?php

	require("constants.php");

	//1. Create a connection
	$connection = mysql_connect(DB_SERVER, DB_USER, DB_PASS);
	if(!$connection){
		die("unable to connect to page");
	}

	//2. Select a DB (test_cms)
	$db = mysql_select_db(DB_NAME, $connection);
	if(!$db){
		die("unable to connect to database");
	}
?>

