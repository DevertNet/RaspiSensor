<?php

class systemInfoModul extends rsModuls{
	function info() {
		return array(
					"columnSize" => 6,
					"arguments" => array(
										"Titel"
									)
					);
	}
	
	function run( $titel ) {
?>
		<div class="col-sm-6">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title"><?php echo($titel); ?></h3>
				</div>
				<div class="panel-body">
					<span class="systemInfo">n/A</span><br />
					
					<button type="button" class="loadSystemInfo btn btn-success">Load</button>
				</div>
			</div>
		</div><!-- /.col-sm-4 -->
<?php
    }
}

?>