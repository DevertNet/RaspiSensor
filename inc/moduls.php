<?php

function runModul($name, $args){
	return call_user_func_array(array($name, "run"), $args);
}

class rsModuls {
    function __construct() {
        echo 'hi!';
    }
}

include("views/moduls/titel.php");

?>