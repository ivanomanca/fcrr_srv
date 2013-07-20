<?php
//session_start();
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
//#############################################
/*
echo("1: ".$_SERVER['SERVER_ADDR']);
echo("<br><br>");
echo("2: ".$_SERVER['DOCUMENT_ROOT']);
echo("<br><br>");
echo("3: ".$_SERVER['PHP_SELF']);
echo("<br><br>");
echo("4: ".$_SERVER['PATH']);
echo("<br><br>");
echo("5: ".$_SERVER['SCRIPT_FILENAME']);
echo("<br><br>");
echo("6: ".getcwd());
echo("<br><br>");
*/

//#############################################
// test input
//$o = array(	"req" => 'get_carpooler_list',
//			"params" => null);
//$o = array( "req" => "get_driver_trip_list", 
//			"params" => array("id_driver" => 2));
//$receivedJson = json_encode($o);

//####### RECUPERO INPUT ######################
$handle = fopen('php://input','r');
$jsonRaw = fgets($handle, 1000);
// In $receivedJson ci sarà il JSON inviato dal client

//####### NO PARAMS ###########################
if (($jsonRaw) == "") {
	echo(" FCRRServer is running!");
	//echo ' [SERVER_ADDR: '.$_SERVER['SERVER_ADDR'].'] ';
	//echo '[HTTP_HOST: '.$_SERVER['HTTP_HOST'].'] ';
	//session_destroy();
	exit(0);
}

//#############################################

//######## DECODIFICA #########################
$receivedJson = json_decode($jsonRaw,true);
// ricavo il tipo di operazione richiesta e i parametri
$req = $receivedJson["req"];
$params = $receivedJson["params"];
include($_SERVER['DOCUMENT_ROOT']."Service/Wrapper.php");
$w = new Service_Wrapper();

//######## ROUTING #############################
if(isset($params) && !is_null($params))
{$w->$req($params);}
else{$w->$req();}

//session_destroy();
?>