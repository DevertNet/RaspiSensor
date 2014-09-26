<?php

class chartLineModul extends rsModuls{
	function run( $titel, $sensorName, $timeScale ) {
	
		if($timeScale=='24hours') $id = "chart_".$sensorName."_last24hours";
		else $id = "chart_".$sensorName."_last7days";
?>
		<div class="col-sm-9">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title"><?php echo($titel); ?></h3>
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