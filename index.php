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
          <a class="navbar-brand" href="#">Elektrokasten</a>
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
<!--        <h1>Bootstrap starter template</h1>
        <p class="lead">Use this document as a way to quickly start any new project.<br> All you get is this text and a mostly barebones HTML document.</p>



        <button type="button" class="btn btn-default">Default</button>
        <button type="button" class="btn btn-primary">Primary</button>
        <button type="button" class="btn btn-success">Success</button>
        <button type="button" class="btn btn-info">Info</button>
        <button type="button" class="btn btn-warning">Warning</button>
        <button type="button" class="btn btn-danger">Danger</button>
        <button type="button" class="btn btn-link">Link</button>

<div class="alert alert-danger">
        <strong>Oh snap!</strong> Change a few things up and try submitting again.
      </div>
      -->
      
		<div class="page-header">
			<h1>Geräte</h1>
		</div>
      
		<div class="col-sm-4">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Stehlampe</h3>
				</div>
				<div class="panel-body">
					<button type="button" data-unit="1" data-state="1" class="switchPlug btn btn-success">Einschalten</button>
					<button type="button" data-unit="1" data-state="0" class="switchPlug btn btn-danger">Ausschalten</button>
				</div>
			</div>
		</div><!-- /.col-sm-4 -->
		
		<div class="col-sm-4">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Lautsprecher</h3>
				</div>
				<div class="panel-body">
					<button type="button" data-unit="2" data-state="1" class="switchPlug btn btn-success">Einschalten</button>
					<button type="button" data-unit="2" data-state="0" class="switchPlug btn btn-danger">Ausschalten</button>
				</div>
			</div>
		</div><!-- /.col-sm-4 -->
		
		<div class="col-sm-4">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Kleine Lampe</h3>
				</div>
				<div class="panel-body">
					<button type="button" data-unit="3" data-state="1" class="switchPlug btn btn-success">Einschalten</button>
					<button type="button" data-unit="3" data-state="0" class="switchPlug btn btn-danger">Ausschalten</button>
				</div>
			</div>
		</div><!-- /.col-sm-4 -->


		<div class="clearfix"></div>
		  
		  
		  
		  
		  
		  
		<div class="page-header">
			<h1>Temperatur</h1>
		</div>
      
		<div class="col-sm-9">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Letzte 7 Tage</h3>
				</div>
				<div class="panel-body">
					<div id="chart_temp1_last7days" style="width: 100%; height: 300px;"></div>
				</div>
			</div>
		</div><!-- /.col-sm-4 -->
		
		<div class="col-sm-3">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Aktuell</h3>
				</div>
				<div class="panel-body">
					<div id="chart_temp1_current" style="width: 100%; height: 300px;"></div>
				</div>
			</div>
		</div><!-- /.col-sm-4 -->
		
		<div class="col-sm-9">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Letzte 24 Stunden</h3>
				</div>
				<div class="panel-body">
					<div id="chart_temp1_last24hours" style="width: 100%; height: 300px;"></div>
				</div>
			</div>
		</div><!-- /.col-sm-4 -->

		<div class="clearfix"></div>
		  
		  
		  
		  
		  
		
		<div class="page-header">
			<h1>Erdfeuchte</h1>
		</div>
      
		<div class="col-sm-9">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Letzte 7 Tage</h3>
				</div>
				<div class="panel-body">
					<div id="chart_moisture1_last7days" style="width: 100%; height: 300px;"></div>
				</div>
			</div>
		</div><!-- /.col-sm-4 -->
		
		<div class="col-sm-3">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Aktuell</h3>
				</div>
				<div class="panel-body">
					<div id="chart_moisture1_current" style="width: 100%; height: 300px;"></div>
				</div>
			</div>
		</div><!-- /.col-sm-4 -->

		<div class="clearfix"></div>
		  
		  
		  
		  
		  
		  

		<div class="page-header">
			<h1>Allgemein</h1>
		</div>

		<div class="col-sm-6">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Webcam</h3>
				</div>
				<div class="panel-body">
					Size: <span class="webcamSize">0x0</span><br /><br />
					<img src="test.jpg" alt="Webcam Picture" class="webcamScreen img-thumbnail" /><br /><br />
					<button type="button" class="reloadWebcam btn btn-success">Reload</button>
					<button type="button" class="restartWebcam btn btn-warning">Restart</button>
				</div>
			</div>
		</div><!-- /.col-sm-4 -->
		
		<div class="col-sm-6">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">System Info</h3>
				</div>
				<div class="panel-body">
					<span class="systemInfo">n/A</span><br />
					
					<button type="button" class="loadSystemInfo btn btn-success">Load</button>
				</div>
			</div>
		</div><!-- /.col-sm-4 -->
		
		<div class="col-sm-6" style="display:none;">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Network Devices</h3>
				</div>
				<div class="panel-body">
					<span class="networkDevices">n/A</span><br />
					
					<button type="button" class="loadNetworkDevices btn btn-success">Load</button>
				</div>
			</div>
		</div><!-- /.col-sm-4 -->
		
		<div class="col-sm-6" style="display:none;">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Uptime Chart</h3>
				</div>
				<div class="panel-body">
					<canvas id="canvas" width="500" height="200"></canvas>
					<br />
					<button type="button" class="loadUptimeChart btn btn-success">Load</button>
				</div>
			</div>
		</div><!-- /.col-sm-4 -->

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
		$.get( "api.php", { a: "switchPlug", systemCode: '10011', unit: $(this).data('unit'), state: $(this).data('state') } )
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
