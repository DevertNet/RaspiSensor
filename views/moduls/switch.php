<?php

class switchModul extends rsModuls{
	function run( $titel, $unit, $systemCode ) {
?>
		<div class="col-sm-4">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title"><?php echo($titel); ?></h3>
				</div>
				<div class="panel-body">
					<button type="button" data-unit="<?php echo($unit); ?>" data-systemcode="<?php echo($systemCode); ?>" data-state="1" class="switchPlug btn btn-success">Einschalten</button>
					<button type="button" data-unit="<?php echo($unit); ?>" data-systemcode="<?php echo($systemCode); ?>" data-state="0" class="switchPlug btn btn-danger">Ausschalten</button>
				</div>
			</div>
		</div>
<?php
    }
}

?>