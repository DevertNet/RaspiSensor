<?php


/*
	Return the Module Class
*/
function getModulClass($name)
{
	$classHolder = new $name();
	
	return $classHolder;
}


/*
	Parent Class for all Child Moduls
*/
class rsModuls 
{
    function __construct() 
	{
        //echo 'hi!';
    }
}



/*
	init all needed classes
*/
function initModules()
{
	global $configModuls;
	
	foreach($configModuls['moduls'] as $index=>$data)
	{
		$configModuls['moduls'][$index]['class'] = getModulClass( $data['modul'] );
	}
}



/*
	Save Config File and refresh vars
*/
function saveConfigModuls()
{
	global $mainPath;
	global $configModuls;
	
	//reindex the array
	$reordered = array();
	foreach($configModuls['moduls'] as $data)
	{
		unset( $data['class'] );
		$reordered[] = $data;
	}
	$configModuls['moduls'] = $reordered;
	
	
	//save the module data
	file_put_contents($mainPath."/_py/config.moduls.json", json_encode( $configModuls ));
	
	//reinit module classes
	initModules();
}


//get the main path of the script "modules.php"
$mainPath = realpath(dirname(__FILE__)."/../");

//autoload all modules
foreach (glob($mainPath."/views/moduls/*.php") as $filename)
{
    include $filename;
}

//init all needed classes
initModules();


?>