<?php
include_once('Service/init.php');

//##### ESTRAZIONE PARAMETRI ########################
if (isset($receivedJson) && !is_null($receivedJson)) {
	$selectParams = $receivedJson["selectParams"];
}else{exit(0);}


//##### CONTROLLO PARAMETRI ########################
// se i parametri sono vuoti non devo effettuare la query
//44.151897,12.240154
//##### QUERY #######################################
$query = 	"SELECT c.*, t.* ".
			"FROM trip t, carpooler c ".
			"WHERE t.id_driver = {$selectParams['id_driver']} ".
			"AND t.id_driver = c._id;";

//##### ESECUZIONE QUERY ############################
include_once($_SERVER['DOCUMENT_ROOT'].'Service/execQuery.php');
?>