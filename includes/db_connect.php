<?php
/**
* define() defines a constant which unlike variables, can not be redefined. 
* Constants are also global meaning the can be reached in any scope.
*/
//Special cases MAMP
//define("DSN", "mysql:unix_socket=/Applications/MAMP/tmp/mysql/mysql.sock;dbname=cms;user=root;password=root");

define("DSN", "mysql:host=localhost;dbname=ex_foto;");
define("USER", "root");
define("PASS", "");
$opt = array(
    // any occurring errors will be thrown as PDOException
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    // an SQL command to execute when connecting
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"
);

$db = new PDO(DSN, USER, PASS, $opt);

?>