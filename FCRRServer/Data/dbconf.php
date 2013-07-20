<?php
/************************************
* DB: REMOTO E LOCALE
************************************/
if(!isset($_SERVER['SERVER_ADDR'])){
	// debug ?
}elseif($_SERVER['SERVER_ADDR'] == '127.0.0.1' ||
		$_SERVER['SERVER_ADDR'] == '192.168.10.5'){
	// LOCALE
	$db_host     = "localhost:3306";
	$db_user     = "root";
	$db_password = "fcrrpw";
	$db_name     = "fcrr";
}else{
	// REMOTO
	// ubuivo.altervista.org
	// 178.63.42.76
	$db_host     = "localhost";
	$db_user     = "ubuivo";
	$db_password = "sigmidogke27";
	$db_name     = "my_ubuivo";
}
?>