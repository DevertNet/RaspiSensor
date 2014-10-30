<?php
/*
	Output the Config for the Modules
*/


/*
	add modul
*/
if( isset($_POST['addModul']) )
{
	//reload module config
	$configModuls = json_decode( file_get_contents("_py/config.moduls.json"), true );
	if(!is_array($configModuls)) $configModuls = array();
	
	//get new index number
	end($configModuls['moduls']);
	$last = key($configModuls['moduls']);
	$nextindex = $last + 1;
	
	//get argument count
	unset($modulInfo);
	
	//check if defaultInstance exists
	if( method_exists( $_POST['modulname'], 'defaultInstance' ) ) 
	{
		$modul = getModulClass( $_POST['modulname'] );
		$defaultInstance = $modul->defaultInstance();

		//add modul info
		$configModuls['moduls'][$nextindex]['modul'] = $_POST['modulname'];
		$configModuls['moduls'][$nextindex]['data'] = $defaultInstance;

		//save the module data
		file_put_contents("_py/config.moduls.json", json_encode( $configModuls ));
	} 
	else
	{
		print ( "DEV-ERROR: Module has no defaultInstance!" );
	}
}

/*
	delete modul
*/
if( isset($_GET['deleteModul']) AND $_GET['deleteModul'] >= 0 )
{
	//reload module config
	$configModuls = json_decode( file_get_contents("_py/config.moduls.json"), true );
	if(!is_array($configModuls)) $configModuls = array();
	
	//delete
	unset( $configModuls['moduls'][$_GET['deleteModul']] );
	
	//reindex the array
	$reordered = array();
	foreach($configModuls['moduls'] as $data)
	{
		$reordered[] = $data;
	}
	$configModuls['moduls'] = $reordered;
	
	//save the module data
	file_put_contents("_py/config.moduls.json", json_encode( $configModuls ));
}

//save changes to config
if( isset($_POST['updateModuls']) )
{	
	//reindex the array
	$reordered = array();
	foreach($_POST['moduls'] as $data)
	{
		$reordered[] = $data;
	}
	$configModuls['moduls'] = $reordered;
	
	//save the module data
	file_put_contents("_py/config.moduls.json", json_encode( $configModuls ));
}

//get config
$configModuls = json_decode( file_get_contents("_py/config.moduls.json"), true );
if(!is_array($configModuls)) $configModuls = array();



?>

<div class="page-header">
  <h1>Config <small>Customize your dashboard</small></h1>
</div>

<!-- Modul Config -->

<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">Add Moduls</h3>
	</div>
	
	<div class="panel-body">
		<p>
			Add a modul at the bottom of the dashboard. After you added the modul you can set it up in the "Modul Config" section. You can drag&drop the modules for a custom order.
		</p>
		<hr />
		<form method="post">
			<div class="row">
				<div class="col-md-9">
					<select name="modulname" class="form-control">
						<?php
							$children  = array();
							foreach(get_declared_classes() as $class)
							{
								if(is_subclass_of($class, "rsModuls"))
								{
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
	</div>
</div>

<br />
<hr />
<br />   


<div class="alert alert-sticky alert-danger" style="display:none;" role="alert">
	<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	<strong>Unsaved Changes!</strong> You have unsaved changes! Please click on the "Save Changes" Button at the bottom of the page!
</div>

<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">Modul Config</h3>
	</div>
	
	<div class="panel-body">

					<form method="post" class="form-horizontal" role="form">
						<div class="row moduls-sortable">
							<?php
							foreach($configModuls['moduls'] as $index=>$data){
									
								if($data['data']['columnSize'] < 1 OR $data['data']['columnSize'] > 12 OR $data['data']['columnSize']=="") $data['data']['columnSize'] = 12;
								if($data['data']['titel']=="") $data['data']['titel'] = "No Titel";
								?>
								<div class="col-md-<?php echo($data['data']['columnSize']); ?> col-module-config">
									<div class="panel panel-info">
										<input type="hidden" name="moduls[<?php echo ($index); ?>][modul]" value="<?php echo ($data['modul']); ?>">
										<div class="panel-heading">
											<h3 class="panel-title">
												<span class="glyphicon glyphicon-fullscreen" style="float:left;"></span>
												<?php echo ($data['data']['titel']); ?> <br /><small>(<?php echo ($data['modul']); ?>)</small>
											</h3>
										</div>
										<div class="panel-body">
											<!-- Button trigger modal -->
											<button class="btn btn-default" data-toggle="modal" data-target="#moduleModalIndex<?php echo ($index); ?>">
												<span class="glyphicon glyphicon-cog"></span> Edit
											</button>
											
											<!-- Modal -->
											<div class="modal fade" id="moduleModalIndex<?php echo ($index); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
															<h4 class="modal-title" id="myModalLabel">
																<?php echo ($data['data']['titel']); ?> <small>(<?php echo ($data['modul']); ?>)</small>
															</h4>
														</div>
														<div class="modal-body">
															<?php
																$modul = getModulClass( $data['modul'] );
																$modul->form( $index, $data['data'] );
															?>
														</div>
														<div class="modal-footer">
															<a href="index.php?p=config&deleteModul=<?php echo ($index); ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete (NO WARNING!)</a>
															<button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
														</div>
													</div>
												</div>
											</div>

											<!-- <input type="submit" class="btn btn-success" name="updateModuls" value="Save"> -->
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
<!-- Modul Config -->