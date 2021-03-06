<?php

class titelModul extends rsModuls{

	function defaultInstance() {
		return array(
					"columnSize" => 12,
					"titel" => "No Titel"
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
		<?php
	}

	function run( $index, $instance ) {
		?>
		<div class="clearfix"></div>
		<div class="page-header">
			<h1><?php echo( $instance['titel'] ); ?></h1>
		</div>
		<?php
    }
}

?>