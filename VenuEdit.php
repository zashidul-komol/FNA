<?php
	include('init.php');
	
	$training		= new Training();
	$opId 			= '';
	$userId 		= '';
	$role 			= '';
	
	if(isset($_SESSION['fmOperatorId'])) {
		$opId 			= $_SESSION['fmOperatorId'];
		$userId 		= $_SESSION['fmUserId'];
	}
	
	if(isset($opId) && (strlen($opId) > 0)) {
		if(isset($_REQUEST['venuId'])) {
			$body 			= $training->getVenuEdit($_REQUEST['venuId']);
		}
	} else {
		$body 				= $struc->getTemplateContent('login');
	}
	
	$struc->loadStructure($body);
?>