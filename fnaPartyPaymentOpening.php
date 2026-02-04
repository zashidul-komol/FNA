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
		
		
		// Insert Palot Information Start
		if(isset($_POST['InsertPartyPaymentOpening'])) {
			$PalotInsert 	= new projectSetupInsertNew();
			$msg 				= $PalotInsert->InsertPartyPaymentOpening($userId);
		}
		// Insert Palot Information End
		
		$body 				= $action->getPartyPaymentOpeningEntry($userId);
		if(strlen($msg)>0) {
			$body 			= str_replace('<!--%[MSG]%-->',$msg,$body);
		}
	} else {
		$body 				= $struc->getTemplateContent('login');
	}
	$struc->loadStructure($body);
?>