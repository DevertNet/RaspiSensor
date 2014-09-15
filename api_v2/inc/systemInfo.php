<?php

function systemInfo(){
	$fswebcampid = trim(shell_exec('pgrep fswebcam'));
	$x .= 'fswebcam '.(($fswebcampid>=1)?"is running":"is down").' (pid:'.$fswebcampid.')<br />';
	
	$freespace = trim(shell_exec("df --total | grep ^total | awk -F\" \" '{ print $5 }'"));
	$x .= 'Used Space: '.$freespace.'/100%<br />';
	
	$uptime = trim(shell_exec("uptime"));
	$x .= $uptime.'<br />';
	
	$boottime = trim(shell_exec("who -b"));
	$x .= $boottime.'<br />';
	
	return $x;
}

?>