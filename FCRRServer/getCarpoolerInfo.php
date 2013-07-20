<?php
include_once('Service/init.php');

//##### ESTRAZIONE PARAMETRI ########################
if (isset($receivedJson) && !is_null($receivedJson)) {
	$selectParams = $receivedJson["selectParams"];
}else{exit(0);}


//##### CONTROLLO PARAMETRI ########################

//##### QUERY #######################################
$query =	"SELECT * FROM `carpooler` ".
			"WHERE `_id`={$selectParams['_id']};";
	
//##### ESECUZIONE QUERY ############################
include_once($_SERVER['DOCUMENT_ROOT'].'Service/execQuery.php');
?>