<?php

class systemInfoModul extends rsModuls{
	
	function defaultInstance() {
		return array(
					"columnSize" => 6,
					"titel" => "Systeminfo"
					);
	}
	
	function form ( $index, $instance ) {
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
		<?php
	}
	
	function run( $instance ) {
?>
		<div class="col-sm-<?php echo($instance['columnSize']); ?>">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title"><?php echo( $instance['titel'] ); ?></h3>
				</div>
				<div class="panel-body">
					<span class="systemInfo">n/A</span><br />
					
					<button type="button" class="loadSystemInfo btn btn-success"><span class="glyphicon glyphicon-refresh"></span> Refresh</button>
				</div>
			</div>
		</div><!-- /.col-sm-4 -->
<?php
    }
	
	
		function javascript() {
		?>
$(".loadSystemInfo").click(function(e) {
	e.preventDefault();
	initApi();
});

$( document ).on( "initApiComplete", function( e, data ) {
	$(".systemInfo").html( data.systemInfo );
});
		<?php
	}
	
	
}

?>