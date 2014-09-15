<?php



function raspiSensor($mysqli){
	$outArray = array();
	
	$outArray['lineChart'][] = array( 	"name" => "Temp.", 
									 	"data" => raspiSensorGetSensorData($mysqli, 'temp1', 7), 
									 	"widget" => array("id"=>"chart_temp_last7days", "options"=>array())
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
									 	"data" => raspiSensorGetSensorData($mysqli, 'moisture1', 7), 
									 	"widget" => array("id"=>"chart_moisture_last7days", "options"=>array())
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

function raspiSensorGetSensorData($mysqli, $sensorID, $days){
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
										"dataRaw" => $row["dataRaw"],
										"dataRefined" => $row["dataRefined"],
										"dataDivider" => 1
									   );
			}
		}

		foreach( $out as $dayKey=>$dayData ){
			$out[ $dayKey ][ 'dataRaw' ] /= $dayData['dataDivider'];
			$out[ $dayKey ][ 'dataRefined' ] /= $dayData['dataDivider'];
		}

		//var_dump( $out );

		$result->free();
	}


	$finalArray = array();
	$finalArray[] = array("Datum", "".$sensorID.""); //Erdfeuchte
	foreach( $out as $dayKey=>$dayData ){
		$finalArray[] = array(
								$dayData["date"],
								round($dayData["dataRefined"])
						);
	}
	
	return $finalArray;
}

function raspiSensorGetSensorDataLast($mysqli, $sensorID){
	if ($result = $mysqli->query("SELECT * FROM sensorData WHERE sensorID='".$sensorID."' ORDER BY date DESC LIMIT 1")) {

		$row = $result->fetch_assoc();
		$out = $row['dataRefined'];
		
		$result->free();
	}


	return $out;
}

?>