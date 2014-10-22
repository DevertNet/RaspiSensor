<?php


function runModul($name, $index, $instance){
	return call_user_func_array(array($name, "run"), array($index, $instance));
}

function getModul($name, $func, $args = array()){
	return call_user_func_array(array($name, $func), $args);
}

function getModulClass($name){
	$classHolder = new $name();
	
	return $classHolder;
}

class rsModuls {
    function __construct() {
        //echo 'hi!';
    }
}

//include("views/moduls/titel.php");

$mainPath = realpath(dirname(__FILE__)."/../");

foreach (glob($mainPath."/views/moduls/*.php") as $filename)
{
    include $filename;
}



?>