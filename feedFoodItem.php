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
		
		
		// Insert Loan Information Start
		if(isset($_POST['InsertFoodItemInfo'])) {
			$LoanInsert 	= new projectSetupInsertNew();
			$msg 				= $LoanInsert->insertFoodItemInfo($userId);
		}
		// Insert Loan Information End
		
		$body 				= $action->getFoodItemEntry($userId);
		if(strlen($msg)>0) {
			$body 			= str_replace('<!--%[MSG]%-->',$msg,$body);
		}
	} else {
		$body 				= $struc->getTemplateContent('login');
	}
	$struc->loadStructure($body);
?>