<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="ico/favicon.png">

    <title>Starter Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">raspiSensor</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="index.html">Home</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container">
      <div class="starter-template">

 
<?php
include("inc/moduls.php");

$showModulConfig = false;

//add modul
if( isset($_POST['addModul']) ){
	$showModulConfig = true;
	$configModuls = json_decode( file_get_contents("_py/config.moduls.json"), true );
	if(!is_array($configModuls)) $configModuls = array();
	
	//var_dump($configModuls['moduls']);
	
	//get new index number
	end($configModuls['moduls']);
	$last = key($configModuls['moduls']);
	$nextindex = $last + 1;
	
	//get argument count
	unset($modulInfo);
	$modulInfo = getModul($_POST['modulname'], "info");
	if(!is_array($modulInfo['arguments'])) $modulInfo['arguments'] = array(null);
	
	//add modul info
	$configModuls['moduls'][$nextindex]['modul'] = $_POST['modulname'];
	$configModuls['moduls'][$nextindex]['data'] = array_fill(0, count($modulInfo['arguments']), null);
	
	//var_dump($configModuls['moduls']);
	
	file_put_contents("_py/config.moduls.json", json_encode( $configModuls ));
}

//delete modul
if( isset($_GET['deleteModul']) AND $_GET['deleteModul'] >= 0 ){
	$showModulConfig = true;
	$configModuls = json_decode( file_get_contents("_py/config.moduls.json"), true );
	if(!is_array($configModuls)) $configModuls = array();
	
	//delete
	unset( $configModuls['moduls'][$_GET['deleteModul']] );
	
	//reindex the array
	$reordered = array();
	foreach($configModuls['moduls'] as $data){
		$reordered[] = $data;
	}
	
	$configModuls['moduls'] = $reordered;
	file_put_contents("_py/config.moduls.json", json_encode( $configModuls ));
}

//save changes to config
if( isset($_POST['updateModuls']) ){
	$showModulConfig = true;
	
	//reindex the array
	$reordered = array();
	foreach($_POST['moduls'] as $data){
		$reordered[] = $data;
	}
	
	$configModuls['moduls'] = $reordered;
	file_put_contents("_py/config.moduls.json", json_encode( $configModuls ));
}

//get config
$configModuls = json_decode( file_get_contents("_py/config.moduls.json"), true );
if(!is_array($configModuls)) $configModuls = array();




?>
<!-- Modul Config -->
<div class="bs-example">
    <div class="panel-group" id="accordion">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Einstellungen</a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse <?php echo ( ($showModulConfig) ? "in" : "" ); ?>">
                <div class="panel-body">
                
                	<form method="post">
	                	<div class="row">
		                	<div class="col-md-9">
								<select name="modulname" class="form-control">
									<?php
										$children  = array();
										foreach(get_declared_classes() as $class){
										    if(is_subclass_of($class, "rsModuls")){
											    ?>
											    <option value="<?php echo ($class); ?>"><?php echo ($class); ?></option>
											    <?php
										    }
										}
									?>
								</select>
		                	</div>
		                	
		                	<div class="col-md-3">
		                		<input type="submit" class="btn btn-info" style="width:100%;" name="addModul" value="+ Add Modul">
		                	</div>
	                	</div>
                	</form>
                	
	                <hr />

					<form method="post">
						<div class="row moduls-sortable">
							<?php
							foreach($configModuls['moduls'] as $index=>$data){
								unset($modulInfo);
								$modulInfo = getModul($data['modul'], "info");
								if($modulInfo['columnSize'] < 1 OR $modulInfo['columnSize'] > 12) $modulInfo['columnSize'] = 12;
								?>
								<div class="col-md-<?php echo($modulInfo['columnSize']); ?>" style="float:left; margin-bottom:20px;">
									<div class="panel panel-info" style="height:200px;">
										<input type="hidden" name="moduls[<?php echo ($index); ?>][modul]" value="<?php echo ($data['modul']); ?>">
										<div class="panel-heading">
											<h3 class="panel-title">
												<?php echo ($data['data'][0]); ?> <small>(<?php echo ($data['modul']); ?>)</small>
											</h3>
										</div>
										<div class="panel-body">
											<?php
											foreach($data['data'] as $attrIndex=>$attrData){ ?>
												<label><?php echo ($modulInfo['arguments'][$attrIndex]); ?>: </label>
												<input type="text" name="moduls[<?php echo ($index); ?>][data][]" value="<?php echo ($attrData); ?>"><br />
											<?php } ?>
											<br />
											<a href="index.php?deleteModul=<?php echo ($index); ?>" class="btn btn-default">Delete</a>
										</div>
									</div>
								</div>
								<?php
							}
							?>
						</div>
					<input type="submit" class="btn btn-success" name="updateModuls" value="Save Changes">
					</form>
					
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modul Config -->
<?php

foreach($configModuls['moduls'] as $index=>$data){
	runModul($data['modul'], $data['data']);
}

/*
runModul("titelModul", array("Geräte"));

runModul("switchModul", array("Stehlampe", 1, 10011));
runModul("switchModul", array("Lautsprecher", 2, 10011));
runModul("switchModul", array("Kleine Lampe", 3, 10011));


runModul("titelModul", array("Temperatur"));
runModul("chartLineModul", array("Last 24 Hours", "temp1", "24hours"));
runModul("chartGaugeModul", array("Current", "temp1", "24hours"));
runModul("chartLineModul", array("Last 7 Days", "temp1"));

runModul("titelModul", array("General"));
runModul("systemInfoModul", array("System Info"));
runModul("webcamModul", array("Webcam", "test.jpg"));
*/

?>


      </div>
    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/Chart.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="//www.google.com/jsapi?autoload={'modules':[{'name':'visualization','version':'1','packages':['corechart', 'gauge']}]}"></script>
    
    <script>
	var actDate = "01.01.0001";
	var defaultData = [0, 0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
	
	function initApi(){
		$.getJSON ( "api_v2/api.php", { a: "init" } )
		.done(function( data ) {
			$(".systemInfo").html( data.systemInfo );
			
			console.table(data);
			
			drawCharts( data.raspiSensor );
			
		})
		.fail(function() {
		    alert( "error" );
		});
	}
	
		
	function drawCharts(chartsData) {
		var lineChart = function(index, name, chartData, widget){
			chartData[0][1] = name;
			
			var data = google.visualization.arrayToDataTable( chartData );

			var options = {
				titlea: name, // Elefantenfu
				chartArea: {'width': '80%', 'height': '70%'},
                legend: {'position': 'bottom'}
			};

			//var el = $('<div id="chart-line-'+index+'" style="width: 900px; height: 500px;"></div>');
			//$('.charts').append( el );
			if ($('#'+widget.id).length > 0) {
				var chart = new google.visualization.LineChart( document.getElementById( widget.id ) );
	
				chart.draw(data, options);
			}
		};

		$.each(chartsData['lineChart'], function( index, value ) {
			lineChart(index, value['name'], value['data'], value['widget']);
		});


		var gaugeChart = function(index, name, chartData, widget){
			var data = google.visualization.arrayToDataTable([
				['Label', 'Value'],
				[name, parseFloat(chartData)]
			]);
console.log(data);

			var formatter = new google.visualization.NumberFormat(
				{suffix: widget.suffix ,pattern:'#.##'}
			);
			formatter.format(data,1);
			
			var options = widget.options;

			//var el = $('<div id="chart-gauge-'+index+'" style="width: 150px; height: 150px;"></div>');
			//$('.charts').append( el );
			if ($('#'+widget.id).length > 0) {
				var chart = new google.visualization.Gauge(document.getElementById( widget.id ));
	
				chart.draw(data, options);
			}
		};

		$.each(chartsData['gaugeChart'], function( index, value ) {
			gaugeChart(index, value['name'], value['data'], value['widget']);
		});
	}
		
		
	$(function() {
		initApi();
		
		$('.moduls-sortable').sortable();
	});
    
	$(".switchPlug").click(function() {	
		$.get( "api.php", { a: "switchPlug", systemCode: $(this).data('systemcode'), unit: $(this).data('unit'), state: $(this).data('state') } )
		.done(function( data ) {
			//alert( "Completed" );
		})
		.fail(function() {
		    alert( "error" );
		});
	});
	
	$(".restartWebcam").click(function() {	
		$.get( "api.php", { a: "killWebCam" } )
		.done(function( data ) {
			//alert( "Completed" );
		})
		.fail(function() {
		    alert( "error" );
		});
	});
	
	$(".reloadWebcam").click(function() {
		var webcamImg = $(".webcamScreen");
		webcamImg.attr("src", "../test.jpg?t=" + new Date().getTime());
		
		$(".webcamSize").html(webcamImg.width()+'x'+webcamImg.height());
	});
	
	$(".loadSystemInfo").click(function() {	
		$.get( "api.php", { a: "systemInfo" } )
		.done(function( data ) {
			//alert( "Completed" );
			$(".systemInfo").html(data);
		});
	});
	
	$(".loadNetworkDevices").click(function() {	
		$.get( "api.php", { a: "fritzBoxNetworkDevices" } )
		.done(function( data ) {
			//alert( "Completed" );
			$(".networkDevices").html(data);
		});
	});
	

	
    </script>
  </body>
</html>
