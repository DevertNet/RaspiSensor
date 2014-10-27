<?php

class switchModul extends rsModuls{
	
	function defaultInstance() {
		return array(
					"columnSize" => 4,
					"titel" => "Switch",
					"unit" => "1",
					"systemCode" => "10111"
					);
	}
	
	function form ( $index, $instance ) {
		?>
		<div class="form-group" style="padding:0px 10px;" data-toggle="tooltip" data-placement="top" title="Width of the module from 1 to 12">
			<label class="col-sm-4 control-label">ColumnSize: </label>
			<div class="col-sm-8">
				<input class="form-control input-sm" type="text" name="moduls[<?php echo ($index); ?>][data][columnSize]" value="<?php echo ( $instance['columnSize'] ); ?>">
			</div>
		</div>

		<div class="form-group" style="padding:0px 10px;" data-toggle="tooltip" data-placement="top" title="Displayed on the dashboard as titel">
			<label class="col-sm-4 control-label">Titel: </label>
			<div class="col-sm-8">
				<input class="form-control input-sm" type="text" name="moduls[<?php echo ($index); ?>][data][titel]" value="<?php echo ( $instance['titel'] ); ?>">
			</div>
		</div>

		<div class="form-group" style="padding:0px 10px;" data-toggle="tooltip" data-placement="top" title="Number (1 to x) of the plug.">
			<label class="col-sm-4 control-label">Unit: </label>
			<div class="col-sm-8">
				<input class="form-control input-sm" type="text" name="moduls[<?php echo ($index); ?>][data][unit]" value="<?php echo ( $instance['unit'] ); ?>">
			</div>
		</div>

		<div class="form-group" style="padding:0px 10px;" data-toggle="tooltip" data-placement="top" title="Systemcode of the plugs. Format: 11011">
			<label class="col-sm-4 control-label">Systemcode: </label>
			<div class="col-sm-8">
				<input class="form-control input-sm" type="text" name="moduls[<?php echo ($index); ?>][data][systemCode]" value="<?php echo ( $instance['systemCode'] ); ?>">
			</div>
		</div>
		<?php
	}

	function run( $index, $instance ) {
?>
		<div class="col-sm-<?php echo($instance['columnSize']); ?>">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title"><?php echo($instance['titel']); ?></h3>
				</div>
				<div class="panel-body">
					<button type="button" data-unit="<?php echo($instance['unit']); ?>" data-systemcode="<?php echo($instance['systemCode']); ?>" data-state="1" class="switchPlug btn btn-success">On</button>
					<button type="button" data-unit="<?php echo($instance['unit']); ?>" data-systemcode="<?php echo($instance['systemCode']); ?>" data-state="0" class="switchPlug btn btn-danger">Off</button>
				</div>
			</div>
		</div>
<?php
    }
	
	
	function javascript() {
		?>
$(".switchPlug").click(function() {	
	$.get( "api_v2/api.php", { a: "switchPlug", systemCode: $(this).data('systemcode'), unit: $(this).data('unit'), state: $(this).data('state') } )
	.done(function( data ) {
		//alert( "Completed" );
	})
	.fail(function() {
		alert( "error" );
	});
});
	<?php
	}
	
	
}

?>