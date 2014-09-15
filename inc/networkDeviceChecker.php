<?PHP
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

$time = date('Gs'); //Stunde im 24-Stunden-Format, ohne führende Nullen + Sekunden, mit führenden Nullen

if($time>=1800 && $time<=2000){
	$_GET['a']='fritzBoxNetworkDevices';
	
	include("api.php");
}
?>