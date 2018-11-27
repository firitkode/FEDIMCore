<?php
/* MYSQL */
//connection:
$dba = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if($dba->connect_errno > 0){
	die('Unable to connect to database [' . $dba->connect_error . ']');
}
?>
