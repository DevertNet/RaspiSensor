<?PHP
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

//get sensor config
$config = json_decode( file_get_contents("../_py/config.json"), true );
if(!is_array($config)) $config = array();

//get modul config
$configModuls = json_decode( file_get_contents("../_py/config.moduls.json"), true );
if(!is_array($configModuls)) $configModuls = array();

//load moduls
include("../inc/moduls.php");

if($_GET['a']=='init'){
	
	include ("inc/inc.mysql.php");
	include ("inc/inc.functions.php");
	
	$out = array();
	include ("inc/systemInfo.php");
	$out['systemInfo'] = systemInfo();
	
	include ("inc/raspiSensor.php");
	$out['raspiSensor'] = raspiSensor($mysqli);
	
	echo (json_encode($out));
	
}else if($_GET['a']=='killWebCam'){
	exec ("sudo pkill fswebcam", $out);
	echo ('ok');
	
}else if($_GET['a']=='switchPlug'){
	$pathRaspberryRemote = realpath(dirname(__FILE__)."/../_raspberry-remote");
	exec ("sudo ".$pathRaspberryRemote."/send ".intval($_GET['systemCode'])." ".intval($_GET['unit'])." ".intval($_GET['state']), $out);
	echo ('ok');	
}else{
	echo ('error');
	
}
//print_r($out);

//echo ('<hr />');
?>