<?php

class chartGaugeModul extends rsModuls{
	
	function defaultInstance() {
		return array(
					"columnSize" => 3,
					"titel" => "Current",
					"sensorName" => "temp1"
					);
	}
	
	
	function api( $instance ) {
		global $mysqli;
		
		return array( 	"name" => $instance['titel'], 
						"data" => raspiSensorGetSensorDataLast($mysqli, $instance['sensorName']), 
						"widget" => array("id"=>"chart_".$instance['sensorName']."_current",
										  "suffix"=>"%",
										  "options"=>array( "redFrom"=> 0, "redTo"=> 15,
															"yellowFrom"=>15, "yellowTo"=> 20,
															"minorTicks"=>5,
															"max"=> 100,
															"min"=> 0 
															))
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

		<?php
	}

	function run( $instance ) {
		$id = "chart_".$instance['sensorName']."_current";
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

	var gaugeChart = function(index, name, chartData, widget){
		var data = google.visualization.arrayToDataTable([
			['Label', 'Value'],
			[name, parseFloat(chartData)]
		]);

		var formatter = new google.visualization.NumberFormat(
			{suffix: widget.suffix ,pattern:'#.##'}
		);
		formatter.format(data,1);

		var options = widget.options;

		//var el = $('<div id="chart-gauge-'+index+'" style="width: 150px; height: 150px;"></div>');
		//$('.charts').append( el );
		if ($('#'+widget.id).length > 0) {
			var chart = new google.visualization.Gauge(document.getElementById( widget.id ));

			chart.draw(data, options);
		}
	};

	$.each(chartsData['chartGaugeModul'], function( index, value ) {
		gaugeChart(index, value['name'], value['data'], value['widget']);
	});
});
	<?php
	}
	
	
}

?>