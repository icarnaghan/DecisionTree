<?php
    require_once( "common.inc.php" );
    require_once( "config.php" );
    require_once( "controller.php" );
	displayPageHeader( "Decision Tree" );
    $con = DbConnect();

	if (isset($_GET['parent_id']) and isset($_GET['decision_id']) and isset($_GET['level_id'])){
		$parent_id = $_GET['parent_id'];
		$decision_id = $_GET['decision_id'];
		$level_id = $_GET['level_id'];
		UpdateTreeForm($parent_id, $decision_id, $level_id);
	}
	else {
		NewTreeForm();
	}

?>