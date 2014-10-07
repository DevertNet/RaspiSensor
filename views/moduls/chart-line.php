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

	function run( $instance ) {
	
		if($instance['timeScale']=='24hours') $id = "chart_".$instance['sensorName']."_last24hours";
		else $id = "chart_".$instance['sensorName']."_last7days";
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