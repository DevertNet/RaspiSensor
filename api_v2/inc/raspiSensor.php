<?php



function raspiSensor($mysqli){
	$outArray = array();
	
	$outArray['lineChart'][] = array( 	"name" => "Temp.", 
									 	"data" => raspiSensorGetSensorDataLastDays($mysqli, 'temp1', 7), 
									 	"widget" => array("id"=>"chart_temp_last7days", "options"=>array())
									);
	$outArray['lineChart'][] = array( 	"name" => "Temp.", 
									 	"data" => raspiSensorGetSensorDataLastHours($mysqli, 'temp1', 240), 
									 	"widget" => array("id"=>"chart_temp_last24hours", "options"=>array())
									);
	$outArray['gaugeChart'][] = array( 	"name" => "Temp.", 
									  	"data" => raspiSensorGetSensorDataLast($mysqli, 'temp1'), 
									  	"widget" => array("id"=>"chart_temp_current", "suffix"=>"°", "options"=>array( "redFrom"=> 0, "redTo"=> 10, "redColor"=>"#0074ff",
																										   	"yellowFrom"=>10, "yellowTo"=> 15, "yellowColor"=>"#96c6ff",
																											"minorTicks"=>5,
																											"max"=> 50,
																											"min"=> 0 
																											))
									 );
	
	
	
	
	$outArray['lineChart'][] = array( 	"name" => "Erdf.", 
									 	"data" => raspiSensorGetSensorDataLastDays($mysqli, 'moisture1', 7), 
									 	"widget" => array("id"=>"chart_moisture_last7days", "options"=>array())
									);
	$outArray['lineChart'][] = array( 	"name" => "Erdf.", 
									 	"data" => raspiSensorGetSensorDataLastHours($mysqli, 'moisture1', 24), 
									 	"widget" => array("id"=>"chart_moisture_last24hours", "options"=>array())
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
	
	return $finalArray;
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
	
	return $finalArray;
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