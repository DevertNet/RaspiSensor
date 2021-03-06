<?php
//Debugging
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

    <title>RaspiSensor Dashboard</title>

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
            <li class="<?php echo ($_GET['p']=="") ? "active" : "" ; ?>"><a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
			<li class="<?php echo ($_GET['p']=="config") ? "active" : "" ; ?>"><a href="index.php?p=config"><span class="glyphicon glyphicon-cog"></span> Config</a></li>
          </ul>
			
          <ul class="nav navbar-nav navbar-right">
			<li class=""><a href="#" onclick="initApi(); return false;" style="color:green;"><span class="glyphicon glyphicon-refresh"></span> Refresh</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container">
      <div class="starter-template">  
		
<?php


//load config
include("inc/config_loader.php");

//load moduls
include("inc/moduls.php");

if($_GET['p']=="config"){
	//insert config page view
	include("views/partials/index_config.php");
}else{
	//insert/run moduls
	include("views/partials/index_dashboard.php");
}


?>


      </div>
    </div><!-- /.container -->

	  
	<div class="loadingoverlay">
		<div class="spinner"></div>
	</div>

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
		$('.loadingoverlay').fadeIn('fast');
		$.getJSON ( "api_v2/api.php", { a: "init" } )
		.done(function( data ) {					
			//Trigger "initApiComplete" Event
			$( document ).trigger( "initApiComplete", [data] );
			$('.loadingoverlay').fadeOut('slow');
		})
		.fail(function() {
		    console.log( "Api loading error..." );
		});
	}
		
	$(function() {
		//init the api load
		initApi();
		
		//Make the moduls sortable
		$('.moduls-sortable').sortable();
		
		//Show Tooltips (e.g. in Config)
		$('[data-toggle=tooltip]').tooltip({container: 'body'});
		
		//Changes in the config -> show the warning to save
		$( ".col-module-config input, .col-module-config select" ).change(function() {
			$('.alert').fadeIn();
		});
	});	
		
	/*
	$( document ).on( "initApiComplete", function( e, data ) {
		console.log( "Event 1 Fired" + data.systemInfo );
	});
	*/
    </script>
	
	<!-- Modul Javascript -->
	<script>
	<?php
	//output javascript of the module
	foreach($configModuls['moduls'] as $index=>$data)
	{		
		//check if module has javascript method and output the javascript of the module
		if( method_exists( $data['class'], 'javascript' ) ) $data['class']->javascript();
	}
	?>
	</script>
  </body>
</html>
