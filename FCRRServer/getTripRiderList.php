<?php
include_once('Service/init.php');

//##### ESTRAZIONE PARAMETRI ########################
if (isset($receivedJson) && !is_null($receivedJson)) {
	$selectParams = $receivedJson["selectParams"];
	$id = (int)$selectParams["_id"];
}else{exit(0);}


//##### CONTROLLO PARAMETRI ########################
// se i parametri sono vuoti non devo effettuare la query
//44.151897,12.240154
//##### QUERY #######################################
$query =	"SELECT r.*, c.* FROM carpooler c, reservation r ".
			"WHERE r.id_trip ={$id} ".
			"AND r.rider_status=0 ".
			"AND r.status=1 ".
			"AND c._id=r.id_rider;"; 

//##### ESECUZIONE QUERY ############################
include_once($_SERVER['DOCUMENT_ROOT'].'Service/execQuery.php');
?>