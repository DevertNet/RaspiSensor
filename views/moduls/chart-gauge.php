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
}

?>