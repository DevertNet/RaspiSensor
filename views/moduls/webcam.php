<?php

class webcamModul extends rsModuls{
	
	function defaultInstance() {
		return array(
					"columnSize" => 6,
					"titel" => "Webcam",
					"imageSource" => "test.jpg"
					);
	}
	
	function javascript() {
		?>
$(".restartWebcam").click(function() {	
	$.get( "api_v2/api.php", { a: "killWebCam" } )
	.done(function( data ) {
		//alert( "Completed" );
	})
	.fail(function() {
		alert( "error" );
	});
});

$(".reloadWebcam").click(function() {
	var webcamImg = $(this).parents('.panel-body').find(".webcamScreen");
	webcamImg.attr("src", webcamImg.attr("data-orgSrc") + "?t=" + new Date().getTime());

	$(".webcamSize").html(webcamImg.width()+'x'+webcamImg.height());
});
		<?php
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

		<div class="form-group" style="padding:0px 10px;">
			<label class="col-sm-4 control-label">Image Source: </label>
			<div class="col-sm-8">
				<input class="form-control input-sm" type="text" name="moduls[<?php echo ($index); ?>][data][imageSource]" value="<?php echo ( $instance['imageSource'] ); ?>">
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
					Size: <span class="webcamSize">0x0</span><br /><br />
					<img src="<?php echo($instance['imageSource']); ?>" data-orgSrc="<?php echo($instance['imageSource']); ?>" alt="Webcam Picture" class="webcamScreen img-thumbnail" /><br /><br />
					<button type="button" class="reloadWebcam btn btn-success"><span class="glyphicon glyphicon-refresh"></span> Reload</button>
					<!--<button type="button" class="restartWebcam btn btn-warning">Restart</button>-->
				</div>
			</div>
		</div><!-- /.col-sm-4 -->
<?php
    }
}

?>