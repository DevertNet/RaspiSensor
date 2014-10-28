<?php



function raspiSensor($mysqli){
	$outArray = array();
	global $config;
	global $configModuls;
		
	foreach($configModuls['moduls'] as $index=>$modul){
		if( method_exists( $modul['modul'], 'api' ) ){			
			$outArray[ $modul['modul'] ][] = getModul( $modul['modul'], "api", array($index, $modul['data']) );
		}
	}
	
	return $outArray;
}

function raspiSensorGetSensorDataLastHours($mysqli, $sensorID, $hours){
	if ($result = $mysqli->query("SELECT * FROM sensorData WHERE sensorID='".res($sensorID)."' AND date>=".res( time() - (3600 * $hours) )." ORDER BY date DESC")) {

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
	if ($result = $mysqli->query("SELECT * FROM sensorData WHERE sensorID='".res($sensorID)."' AND date>=".res( time() - (86400 * $days) )." ORDER BY date DESC")) {

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
	if ($result = $mysqli->query("SELECT * FROM sensorData WHERE sensorID='".res($sensorID)."' ORDER BY date DESC LIMIT 1")) {

		$row = $result->fetch_assoc();
		$out = floatval($row['dataRefined']);
		
		$result->free();
	}


	return $out;
}

?>