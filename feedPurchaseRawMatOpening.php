<?php
	include('init.php');
	
	$action 		= new ProjectSetup();
	$opId 			= '';
	$userId 		= '';
	$role 			= '';
	$businessDate 	= '';
	if(isset($_SESSION['fmOperatorId'])) {
		$opId 			= $_SESSION['fmOperatorId'];
		$userId 		= $_SESSION['fmUserId'];
	}
	
	if(isset($opId) && (strlen($opId) > 0)) {
		$msg 				= '';
		
		
		
		// Insert Load Information Start
		if(isset($_POST['insertPurChaseRawMatOpening'])) {
			$labourInsert 	= new projectSetupInsertNew();
			$msg 			= $labourInsert->insertPurChaseRawMatOpening($userId);
		}
		// Insert Load Information End
		
		$body 				= $action->getPurRawMatOpening($userId);
		if(strlen($msg)>0) {
			$body 			= str_replace('<!--%[MSG]%-->',$msg,$body);
		}
	} else {
		$body 				= $struc->getTemplateContent('login');
	}
	$struc->loadStructure($body);
?>