<?php
class Service_Wrapper{
	private $dao;
	
	public function __construct(){
		// Percorsi alle cartelle dei moduli
		require($_SERVER['DOCUMENT_ROOT']."Data/DataAccess.php");
		// creo l'istanza dao
		try{
			$this->dao = Data_DataAccess::getInstance();
		}catch (Data_DataAccess_ConnException $e) {
			echo('DbConnectionException lanciata!');
			//rethrow it
			//throw $e;
		}catch (Data_DataAccess_SelectException $e) {
			echo('DbSelectionException lanciata!');
			//rethrow it
			//throw $e;
		}
	}
	
	public function get_carpooler_list(){
		// query
		$query = "SELECT * FROM carpooler";
		// esecuzione query
		$esito = $this->dao->invia_query($query);
		if($esito){
			// invio output json
			echo($this->dao->get_json_obj($esito));
		}else{
			echo('Wrapper: Errore nella query.');
		}
		//mysql_close();
	}
	
	/**
	 * Restituisce la lista dei viaggi di un determinato driver
	 * input: array("id_driver" => 2);
	 * @param array $id_driver_array
	 */
	public function get_driver_trip_list($id_driver_array){
		// prima c e poi t, così t sovrascrive _id di c. ;)
		$query = 	"SELECT c.*, t.* ".
					"FROM trip t, carpooler c ".
					"WHERE t.id_driver = {$id_driver_array['id_driver']} ".
					"AND t.id_driver = c._id;";
		
		$esito = $this->dao->invia_query($query);
		if($esito){
			// invio output json
			echo($this->dao->get_json_obj($esito));
		}else{
			echo('Wrapper: Errore nella query.');
		}
	}
	
	/**
	* Restituisce tutte le informazioni (tranne i riders) correnti su un determinato trip
	* input: array("id_trip" => 1);
	* @param array $id_rider_array
	*/
	public function get_trip_info($id_trip_array){
		$query =	"SELECT t.*, c.* ".
					"FROM trip t, carpooler c ".
					"WHERE t._id = {$id_trip_array['_id']} ".
					"AND t.id_driver = c._id;";
	
		$esito = $this->dao->invia_query($query);
		if($esito){
			// invio output json
			echo($this->dao->get_json_obj($esito));
		}else{
			echo('Wrapper: Errore nella query.');
		}
	}
	
	/**
	* Restituisce la lista dei rider ACCETTATI per un determinato trip
	* input: array("_id" => 1);
	* @param array $id_rider_array
	*/
	public function get_trip_rider_list($id_trip_array){
		$query = 	"SELECT r.*, c.* ".
					"FROM reservation r, carpooler c ".
					"WHERE r.id_trip = {$id_trip_array['_id']} ".
					"AND r.id_rider = c._id ".
					"AND r.status = 1;";
	
		$esito = $this->dao->invia_query($query);
		if($esito){
			// invio output json
			echo($this->dao->get_json_obj($esito));
		}else{
			echo('Wrapper: Errore nella query.');
		}
	}
}
?>