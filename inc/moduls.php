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


//get the main path of the script
$mainPath = realpath(dirname(__FILE__)."/../");

//autoload all modules
foreach (glob($mainPath."/views/moduls/*.php") as $filename)
{
    include $filename;
}



?>