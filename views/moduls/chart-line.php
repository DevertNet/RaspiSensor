<?php

class chartLineModul extends rsModuls{
	function info() {
		return array(
					"columnSize" => 9,
					"arguments" => array(
										"Titel",
										"Sensorname",
										"Timescale (24hours or 7days)"
									)
					);
	}
	
	
	function defaultInstance() {
		return array(
					"columnSize" => 9,
					"titel" => "Last 24 Hours",
					"sensorName" => "temp1",
					"timeScale" => "24hours"
					);
	}
	
	
	function api( $index, $instance ) {
		global $mysqli;
		
		if($instance['timeScale']=='24hours'){
			$id = "chart_".$instance['sensorName']."_last24hours_".$index;
			$data = raspiSensorGetSensorDataLastHours($mysqli, $instance['sensorName'], 24);
		}else{
			$id = "chart_".$instance['sensorName']."_last7days_".$index;
			$data = raspiSensorGetSensorDataLastDays($mysqli, $instance['sensorName'], 7);
		}
		
		return array( 	"name" => $instance['titel'], 
						"data" => $data, 
						"widget" => array("id"=>$id, "options"=>array())
					);
	}
	
	
	function form ( $index, $instance ) {
		global $config;
		?>

		<div class="form-group" style="padding:0px 10px;">
			<label class="col-sm-4 control-label">ColumnSize: </label>
			<div class="col-sm-8">
				<input class="form-control input-sm" type="text" name="moduls[<?php echo ($index); ?>][data][columnSize]" value="<?php echo ( $instance['columnSize'] ); ?>">
			</div>
		</div>

		<div class="form-group" style="padding:0px 10px;">
			<label class="col-sm-4 control-label">Titel: </label>
			<div class="col-sm-8">
				<input class="form-control input-sm" type="text" name="moduls[<?php echo ($index); ?>][data][titel]" value="<?php echo ( $instance['titel'] ); ?>">
			</div>
		</div>

		<div class="form-group" style="padding:0px 10px;">
			<label class="col-sm-4 control-label">Sensor: </label>
			<div class="col-sm-8">
				<select name="moduls[<?php echo ($index); ?>][data][sensorName]" class="form-control input-sm">
					<?php
						$children  = array();
						foreach($config['sensors'] as $sensor){
							?>
							<option <?php echo ( ($instance['sensorName']==$sensor['name']) ? "selected" : "" ); ?> value="<?php echo ( $sensor['name'] ); ?>"><?php echo ( $sensor['displayName'] ); ?> (<?php echo ( $sensor['name'] ); ?>)</option>
							<?php
						}
					?>
				</select>
			</div>
		</div>

		<div class="form-group" style="padding:0px 10px;">
			<label class="col-sm-4 control-label">Time: </label>
			<div class="col-sm-8">
				<select class="form-control input-sm" name="moduls[<?php echo ($index); ?>][data][timeScale]">
				  <option <?php echo ( ($instance['timeScale']=="24hours") ? "selected" : "" ); ?> value="24hours">Last 24 Hours</option>
				  <option <?php echo ( ($instance['timeScale']=="7days") ? "selected" : "" ); ?> value="7days">Last 7 Days</option>
				</select>
			</div>
		</div>
		<?php
	}

	
	function run( $index, $instance ) {
	
		if($instance['timeScale']=='24hours') $id = "chart_".$instance['sensorName']."_last24hours_".$index;
		else $id = "chart_".$instance['sensorName']."_last7days_".$index;
?>
		<div class="col-sm-<?php echo($instance['columnSize']); ?>">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title"><?php echo($instance['titel']); ?></h3>
				</div>
				<div class="panel-body">
					<div id="<?php echo($id); ?>" style="width: 100%; height: 300px;"></div>
				</div>
			</div>
		</div><!-- /.col-sm-4 -->
<?php
    }
	
	
	function javascript() {
		?>
$( document ).on( "initApiComplete", function( e, data ) {
	chartsData = data.raspiSensor;

	var lineChart = function(index, name, chartData, widget){
		chartData[0][1] = name;

		var data = google.visualization.arrayToDataTable( chartData );

		var options = {
			titlea: name, // Elefantenfu
			chartArea: {'width': '80%', 'height': '70%'},
			legend: {'position': 'bottom'}
		};

		//var el = $('<div id="chart-line-'+index+'" style="width: 900px; height: 500px;"></div>');
		//$('.charts').append( el );
		if ($('#'+widget.id).length > 0) {
			var chart = new google.visualization.LineChart( document.getElementById( widget.id ) );

			chart.draw(data, options);
		}
	};

	$.each(chartsData['chartLineModul'], function( index, value ) {
		lineChart(index, value['name'], value['data'], value['widget']);
	});
});
	<?php
	}
	
}

?>