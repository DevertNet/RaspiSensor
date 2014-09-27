<?php

class chartGaugeModul extends rsModuls{
	function info() {
		return array(
					"columnSize" => 3,
					"arguments" => array(
										"Titel",
										"Sensorname"
									)
					);
	}

	function run( $titel, $sensorName ) {
		$id = "chart_".$sensorName."_current";
?>
		<div class="col-sm-3">
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