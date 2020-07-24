<?php

define('DB_SERVER', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'crt');


@$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME);
if(!$link) {
	echo "<h1>ERROR DATABASE CONNECT</h1>";
	die;
}		
mysqli_select_db($link,DB_NAME);
mysqli_query($link,"SET NAMES 'utf8'");

/*
	CREATE TABLE statistics
	(id INT NOT NULL AUTO_INCREMENT,
	numbers INT,
	datas INT,			
	PRIMARY KEY (id) )
*/

?>