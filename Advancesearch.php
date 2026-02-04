<?php
	include('init.php');
	
	$action 		= new report();
	$opId 			= '';
	$userId 		= '';
	$role 			= '';
	$businessDate 	= '';
	if(isset($_SESSION['fmOperatorId'])) {
		$opId 			= $_SESSION['fmOperatorId'];
		$userId 		= $_SESSION['fmUserId'];
	}
	
	if(isset($_POST['advanceSearch'])) {
	 $advanceSearch 	= new report();
	 $msg 			= $advanceSearch->insertAdvanceSearch($userId);
	
    }
	
	if(isset($opId) && (strlen($opId) > 0)) {
		$msg 				= '';
		
		$body 				= $action->getDfoltAdvanceSearch($userId);
		if(strlen($msg)>0) {
			$body 			= str_replace('<!--%[MSG]%-->',$msg,$body);
		}
	} else {
		$body 				= $struc->getTemplateContent('login');
	}
	$struc->loadStructure($body);
?>