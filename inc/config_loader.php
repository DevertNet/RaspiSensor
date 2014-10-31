<?php

/*
	Load the Config Files
*/

//get the main path of the script "config_loader.php"
$mainPath = realpath(dirname(__FILE__)."/../");

//get sensor config
$config = json_decode( file_get_contents($mainPath."/_py/config.json"), true );
if(!is_array($config)) $config = array();

//get modul config
$configModuls = json_decode( file_get_contents($mainPath."/_py/config.moduls.json"), true );
if(!is_array($configModuls)) $configModuls = array();


?>