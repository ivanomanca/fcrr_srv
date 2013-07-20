<?php
// esecuzione query
$esito = $dao->invia_query($query);
if($esito){
	if ($dao->query_result == 0) {
		// nessun parametro di ritorno feedback = 0 se la query è andata bene.
		echo(json_encode(array("query_feedback" => $dao->query_result)));
	}else{
		// lista di output
		// invio output json
		echo($dao->get_json_obj($esito));
	}
	//}elseif($esito === true){
		//else{
			// id creato
			//echo(json_encode(array("_id" => $dao->query_result)));
		//}
}else{
	echo('Errore: la query non è stata eseguita.');
}
mysql_close();
?>