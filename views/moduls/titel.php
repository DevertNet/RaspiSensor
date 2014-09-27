<?php

class titelModul extends rsModuls{

	function info() {
		return array(
					"columnSize" => 12,
					"arguments" => array(
										"Titel"
									)
					);
	}

	function run( $titel ) {
?>
<div class="clearfix"></div>
<div class="page-header">
	<h1><?php echo($titel); ?></h1>
</div>
<?php
    }
}

?>