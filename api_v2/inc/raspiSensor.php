<?php



function raspiSensor($mysqli){
	$outArray = array();
	global $config;
	global $configModuls;
	
	//var_dump($configModuls['moduls']);
	
	foreach($configModuls['moduls'] as $index=>$modul){
		if( method_exists( $modul['modul'], 'api' ) ){			
			$outArray[ $modul['modul'] ][] = getModul( $modul['modul'], "api", array($index, $modul['data']) );
		}
	}
	
	
	/*
	foreach($config['sensors'] as $sensor){
		$outArray['lineChart'][] = array( 	"name" => $sensor['displayName'], 
											"data" => raspiSensorGetSensorDataLastDays($mysqli, $sensor['name'], 7), 
											"widget" => array("id"=>"chart_".$sensor['name']."_last7days", "options"=>array())
										);
		$outArray['lineChart'][] = array( 	"name" => $sensor['displayName'], 
											"data" => raspiSensorGetSensorDataLastHours($mysqli, $sensor['name'], 24), 
											"widget" => array("id"=>"chart_".$sensor['name']."_last24hours", "options"=>array())
										);
		$outArray['gaugeChart'][] = array( 	"name" => $sensor['displayName'], 
											"data" => raspiSensorGetSensorDataLast($mysqli, $sensor['name']), 
											"widget" => array("id"=>"chart_".$sensor['name']."_current", "suffix"=>"%", "options"=>array( "redFrom"=> 0, "redTo"=> 15,
																												"yellowFrom"=>15, "yellowTo"=> 20,
																												"minorTicks"=>5,
																												"max"=> 100,
																												"min"=> 0 
																												))
										 );
	}
	*/
	
	//var_dump($outArray);
	//exit;
	/*

	$outArray['gaugeChart'][] = array( 	"name" => "Temp.", 
									  	"data" => raspiSensorGetSensorDataLast($mysqli, 'temp1'), 
									  	"widget" => array("id"=>"chart_temp_current", "suffix"=>"°", "options"=>array( "redFrom"=> 0, "redTo"=> 10, "redColor"=>"#0074ff",
																										   	"yellowFrom"=>10, "yellowTo"=> 15, "yellowColor"=>"#96c6ff",
																											"minorTicks"=>5,
																											"max"=> 50,
																											"min"=> 0 
																											))
									 );


	$outArray['gaugeChart'][] = array( 	"name" => "Erdf.", 
									  	"data" => raspiSensorGetSensorDataLast($mysqli, 'moisture1'), 
									  	"widget" => array("id"=>"chart_moisture_current", "suffix"=>"%", "options"=>array( "redFrom"=> 0, "redTo"=> 15,
																										   	"yellowFrom"=>15, "yellowTo"=> 20,
																											"minorTicks"=>5,
																											"max"=> 100,
																											"min"=> 0 
																											))
									 );
	*/
	
	return $outArray;
}

function raspiSensorGetSensorDataLastHours($mysqli, $sensorID, $hours){
	if ($result = $mysqli->query("SELECT * FROM sensorData WHERE sensorID='".$sensorID."' AND date>=".( time() - (3600 * $hours) )." ORDER BY date DESC")) {

		$out = array();

		while ($row = $result->fetch_assoc()) {
			$dayKey = date("YmdH", $row["date"]);

			if( array_key_exists ( $dayKey, $out ) ){
				$out[ $dayKey ]["dataRaw"] += $row["dataRaw"];
				$out[ $dayKey ]["dataRefined"] += $row["dataRefined"];
				$out[ $dayKey ]["dataDivider"] += 1;

			}else{
				$out[ $dayKey ] = array(
										"date" => date("H", $row["date"]),
										"dataRaw" => floatval($row["dataRaw"]),
										"dataRefined" => floatval($row["dataRefined"]),
										"dataDivider" => 1
									   );
			}
		}
		

		foreach( $out as $dayKey=>$dayData ){
			$out[ $dayKey ][ 'dataRaw' ] /= $dayData['dataDivider'];
			$out[ $dayKey ][ 'dataRefined' ] /= $dayData['dataDivider'];
		}


		$result->free();
	}


	$finalArray = array();
	$finalArray[] = array("Zeit", "".$sensorID.""); //Erdfeuchte
	foreach( $out as $dayKey=>$dayData ){
		$finalArray[] = array(
								$dayData["date"],
								round($dayData["dataRefined"], 2)
						);
	}
	
	return array_reverse($finalArray);
}

function raspiSensorGetSensorDataLastDays($mysqli, $sensorID, $days){
	if ($result = $mysqli->query("SELECT * FROM sensorData WHERE sensorID='".$sensorID."' AND date>=".( time() - (86400 * $days) )." ORDER BY date DESC")) {

		$out = array();

		while ($row = $result->fetch_assoc()) {
			$dayKey = date("Ymd", $row["date"]);

			if( array_key_exists ( $dayKey, $out ) ){
				$out[ $dayKey ]["dataRaw"] += $row["dataRaw"];
				$out[ $dayKey ]["dataRefined"] += $row["dataRefined"];
				$out[ $dayKey ]["dataDivider"] += 1;

			}else{
				$out[ $dayKey ] = array(
										"date" => date("d.m.Y", $row["date"]),
										"dataRaw" => floatval($row["dataRaw"]),
										"dataRefined" => floatval($row["dataRefined"]),
										"dataDivider" => 1
									   );
			}
		}
		

		foreach( $out as $dayKey=>$dayData ){
			$out[ $dayKey ][ 'dataRaw' ] /= $dayData['dataDivider'];
			$out[ $dayKey ][ 'dataRefined' ] /= $dayData['dataDivider'];
		}


		$result->free();
	}


	$finalArray = array();
	$finalArray[] = array("Datum", "".$sensorID.""); //Erdfeuchte
	foreach( $out as $dayKey=>$dayData ){
		$finalArray[] = array(
								$dayData["date"],
								round($dayData["dataRefined"], 2)
						);
	}
	
	return array_reverse($finalArray);
}

function raspiSensorGetSensorDataLast($mysqli, $sensorID){
	if ($result = $mysqli->query("SELECT * FROM sensorData WHERE sensorID='".$sensorID."' ORDER BY date DESC LIMIT 1")) {

		$row = $result->fetch_assoc();
		$out = floatval($row['dataRefined']);
		
		$result->free();
	}


	return $out;
}

?>