<?PHP
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

$config = json_decode( file_get_contents("../_py/config.json"), true );


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
	exec ("sudo /home/pi/Desktop/gpio/raspberry-remote/send ".intval($_GET['systemCode'])." ".intval($_GET['unit'])." ".intval($_GET['state']), $out);
	echo ('ok');	

}else{
	echo ('error');
	
}
//print_r($out);

//echo ('<hr />');
?>