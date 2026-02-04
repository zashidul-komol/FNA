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
		if(isset($_REQUEST['trainingMethodologiesId'])) {
			$body 			= $training->getMethodologiesEdit($_REQUEST['trainingMethodologiesId']);
		}
	} else {
		$body 				= $struc->getTemplateContent('login');
	}
	
	$struc->loadStructure($body);
?>