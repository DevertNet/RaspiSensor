<?php
/*
	Load the dashboard moduls (html)
*/


$currentColumn = 0;

echo ('<div class="row">');
foreach($configModuls['moduls'] as $index=>$data)
{
	//init the class of the module
	$module = getModulClass( $data['modul'] );

	//output the dashboard frontend of the module
	$module->run( $index, $data['data'] );

	//put 12 columns (e.g. 9er and 3er module) in one <div class="row"></div>
	$currentColumn += $data['data']['columnSize'];
	if( $currentColumn >= 12 )
	{
		$currentColumn = 0;
		echo ('</div><div class="row">');
	}

}
echo ('</div>');

?>