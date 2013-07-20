<?php
include_once('Service/init.php');

//##### ESTRAZIONE PARAMETRI ########################
if (isset($receivedJson) && !is_null($receivedJson)) {
	$updateParams = $receivedJson["updateParams"];
	$selectParams = $receivedJson["selectParams"];
}else{exit(0);}


//##### CONTROLLO PARAMETRI ########################
// se i parametri sono vuoti non devo effettuare la query
//44.151897,12.240154
//##### QUERY #######################################
$query = 	"UPDATE `carpooler` ".
			"SET `geopoint`='{$updateParams['geopoint']}' ".
			"WHERE _id ={$selectParams['_id']};";
	
//##### ESECUZIONE QUERY ############################
include_once($_SERVER['DOCUMENT_ROOT'].'Service/execQuery.php');
?>