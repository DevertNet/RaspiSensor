<?PHP

function res($var){
	global $mysqli;

	if (get_magic_quotes_gpc()){ 
		$var = stripslashes($var); 
	}

	if ($escaped = @mysqli_real_escape_string($mysqli, $var)){
		return($escaped);
	}else{
		return(FALSE); 
	}
}

function filter_var_mod($string, $mode, $valueArray=""){
	$result = false;
	if($mode=="mail"){
		$result = (preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $string)) ? false : true;
		
	}elseif($mode=="url"){
		$result = (preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $string)) ? false : true;
		
	}elseif($mode=="empty"){
		if($string=="") $result = true;
		
	}elseif($mode=="empty_split"){
		if($string['plz']=="" OR $string['city']=="") $result = true;
		
	}elseif($mode=="array"){
		$result = true;
		foreach($valueArray as $arrayName=>$arrayValue){
			if(($arrayName==$string OR $arrayValue==$string) AND $string!="-"){
				$result = false;
				break;
				
			}
		}
		
	}
	return $result;
}
?>