<?PHP
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

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

}else if($_GET['a']=='systemInfo'){
	$fswebcampid = trim(shell_exec('pgrep fswebcam'));
	echo ('fswebcam '.(($fswebcampid>=1)?"is running":"is down").' (pid:'.$fswebcampid.')<br />');
	
	$freespace = trim(shell_exec("df --total | grep ^total | awk -F\" \" '{ print $5 }'"));
	echo ('Used Space: '.$freespace.'/100%<br />');
	
	$uptime = trim(shell_exec("uptime"));
	echo ($uptime.'<br />');
	
	$boottime = trim(shell_exec("who -b"));
	echo ($boottime.'<br />');
	
}else if($_GET['a']=='fritzBoxNetworkDevices'){
	include("inc/fritzbox_api/fritzbox_get_network_devices.php");
	
	if(is_array($networkDevices)){
		foreach($networkDevices as $networkDevice){
			if($networkDevice['mac']=="F0:D1:A9:80:7E:FA" && $networkDevice['active']=="1"){
				echo ('<hr>iPhone is in range! Lights go on!!');
				exec ("sudo /home/pi/Desktop/gpio/raspberry-remote/send 10011 1 1", $out);

			}
		}
	}
	
}else{
	echo ('error');
	
}
//print_r($out);

//echo ('<hr />');
?>