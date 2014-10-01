<?php


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
	$defaultInstance = getModul($_POST['modulname'], "defaultInstance");
	
	//add modul info
	$configModuls['moduls'][$nextindex]['modul'] = $_POST['modulname'];
	$configModuls['moduls'][$nextindex]['data'] = $defaultInstance;
	
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

					<form method="post" class="form-horizontal" role="form">
						<div class="row moduls-sortable">
							<?php
							foreach($configModuls['moduls'] as $index=>$data){
									
								if($data['data']['columnSize'] < 1 OR $data['data']['columnSize'] > 12 OR $data['data']['columnSize']=="") $data['data']['columnSize'] = 12;
								if($data['data']['titel']=="") $data['data']['titel'] = "No Titel";
								?>
								<div class="col-md-<?php echo($data['data']['columnSize']); ?>" style="float:left; margin-bottom:20px;">
									<div class="panel panel-info" style="min-height:300px;">
										<input type="hidden" name="moduls[<?php echo ($index); ?>][modul]" value="<?php echo ($data['modul']); ?>">
										<div class="panel-heading">
											<h3 class="panel-title">
												<?php echo ($data['data']['titel']); ?> <small>(<?php echo ($data['modul']); ?>)</small>
											</h3>
										</div>
										<div class="panel-body">
											<?php
												getModul($data['modul'], "form", array($index, $data['data']));
											?>
											<a href="index.php?deleteModul=<?php echo ($index); ?>" class="btn btn-default">Delete</a>
											<input type="submit" class="btn btn-success" name="updateModuls" value="Save">
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