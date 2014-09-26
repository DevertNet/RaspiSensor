<!DOCTYPE html>
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

/*
	Needed for the admin panel ;)

$children  = array();
foreach(get_declared_classes() as $class){
    if($class instanceof rsModuls) $children[] = $class;
}

var_dump( $children );
*/

?>


      </div>
    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
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
