<?php
//######## DOCUMENT ROOT #####################
if(!isset($_SERVER['SERVER_ADDR'])){
	// debug ?
}elseif($_SERVER['SERVER_ADDR'] == '127.0.0.1' ||
$_SERVER['SERVER_ADDR'] == '192.168.10.5'){
	// LOCALE
	$_SERVER['DOCUMENT_ROOT'] = "c:/Users/ivano/Dropbox/wsp/FCRRServer/";
}else{
	// REMOTO
	// ubuivo.altervista.org
	// 178.63.42.76
	$_SERVER['DOCUMENT_ROOT'] = "/membri/ubuivo/";
	//echo($_SERVER['DOCUMENT_ROOT']);
}
//######## Configurazione di debug ###########
//require_once("debug.php");
require_once $_SERVER['DOCUMENT_ROOT'].'krumo/class.krumo.php';
// disable Krumo
krumo::disable();
// enable Krumo
//krumo::enable();

// ####### BOOTSTRAP #########################
// Error reporting
error_reporting(E_ALL|E_STRICT);
ini_set('display_errors','on');

//######## SECURITY SETTINGS #################
// durata dei cookies sul browser
ini_set('session.cookie_lifetime', 86400);
ini_set('session.gc_maxlifetime', 1440);
//ini_set('session.auto_start', 1);
ini_set('open_basedir', $_SERVER['DOCUMENT_ROOT']);

//####### RECUPERO INPUT ######################
$handle = fopen('php://input','r');
$jsonRaw = fgets($handle, 1000);
// In $receivedJson vi ша il JSON inviato dal client

//####### INCLUDO I TEST ######################
include_once($_SERVER['DOCUMENT_ROOT']."testInput.php");

//######## DECODIFICA ##########################
$receivedJson = NULL;
if (!is_null($jsonRaw)) {
	$receivedJson = json_decode($jsonRaw,true);
}

//####### DB CONNECTION ########################
// Percorsi alle cartelle dei moduli
require($_SERVER['DOCUMENT_ROOT']."Data/DataAccess.php");
// creo l'istanza dao
$dao = NULL;
try{
	$dao = Data_DataAccess::getInstance();
}catch (Data_DataAccess_ConnException $e) {
	echo('DbConnectionException lanciata!');
	//rethrow it
	//throw $e;
}catch (Data_DataAccess_SelectException $e) {
	echo('DbSelectionException lanciata!');
	//rethrow it
	//throw $e;
}
?>