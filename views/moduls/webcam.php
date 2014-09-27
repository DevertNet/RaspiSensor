<?php

class webcamModul extends rsModuls{
	function info() {
		return array(
					"columnSize" => 6,
					"arguments" => array(
										"Titel",
										"Image Source (test.jpg)"
									)
					);
	}

	function run( $titel, $source ) {
?>
		<div class="col-sm-6">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title"><?php echo($titel); ?></h3>
				</div>
				<div class="panel-body">
					Size: <span class="webcamSize">0x0</span><br /><br />
					<img src="<?php echo($source); ?>" alt="Webcam Picture" class="webcamScreen img-thumbnail" /><br /><br />
					<button type="button" class="reloadWebcam btn btn-success">Reload</button>
					<button type="button" class="restartWebcam btn btn-warning">Restart</button>
				</div>
			</div>
		</div><!-- /.col-sm-4 -->
<?php
    }
}

?>