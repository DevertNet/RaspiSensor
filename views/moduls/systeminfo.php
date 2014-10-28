<?php

class systemInfoModul extends rsModuls{
	
	function defaultInstance() {
		return array(
					"columnSize" => 6,
					"titel" => "Systeminfo"
					);
	}
	
	function api( $index, $instance ) {
		
		
		
		$fswebcampid = trim(shell_exec('pgrep fswebcam'));
		if($fswebcampid=="") $fswebcampid = 0;
		$x .= '<div class="row">
				<div class="col-md-4">fswebcam</div>
				<div class="col-md-8">'.(($fswebcampid>=1)?'<span class="label label-success">running</span>':'<span class="label label-danger">down</span>').' (pid:'.$fswebcampid.')</div>
			</div>';
		
		$freespace = trim(shell_exec("df --total | grep ^total | awk -F\" \" '{ print $5 }'"));
		if($freespace=="") $freespace = 0;
		$x .= '<div class="row">
				<div class="col-md-4">Used Space</div>
				<div class="col-md-8">
					<div class="progress">
					  <div class="progress-bar progress-bar-danger" style="width: '.$freespace.'%">
						<span class="">'.$freespace.'% used</span>
					  </div>
					  <div class="progress-bar progress-bar-success" style="width: '.(100-$freespace).'%">
						<span class="">'.(100-$freespace).'% free</span>
					  </div>
					</div>
				</div>
			</div>';

		$uptime = trim(shell_exec("uptime"));
		$x .= '<div class="row">
				<div class="col-md-4">Uptime</div>
				<div class="col-md-8">'.$uptime.'</div>
			</div>';

		$boottime = trim(shell_exec("who -b"));
		$x .= '<div class="row">
				<div class="col-md-4">Boot Time</div>
				<div class="col-md-8">'.$boottime.'</div>
			</div>';
		
		$x .= '<div class="row">
				<div class="col-md-4">Dashboard Load</div>
				<div class="col-md-8">'.date("d.m.Y H:i:s", time()).'</div>
			</div>';

		return $x;
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
	$(".systemInfo").html( data.raspiSensor.systemInfoModul );
});
		<?php
	}
	
	
}

?>