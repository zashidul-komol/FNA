<?php
	include('init.php');
	
	$action 		= new package();
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
		
		
		
		if(isset($_POST['submitPaymentStage'])) {
			 
			 $packageId = $_POST['packageId']; 
			 $packageName = $_POST['packageName'];
			 $pi_4 			= $_POST['pi_4'];
			 $pi_6 			= $_POST['pi_6'];
			 $msg 			= $action->paymentStageNext($userId,$packageId,$packageName,$pi_4,$pi_6);
		}
		
		if(isset($_POST['insertPaymentStage'])) {
			 $paymentStageInsert 	= new pacakgeInformationInsert();
			 $msg 			= $paymentStageInsert->insertPaymentStage($userId);
			
		}
		
		
		$body 				= $action->paymentStageNext2($userId);
		if(strlen($msg)>0) {
			$body 			= str_replace('<!--%[MSG]%-->',$msg,$body);
		}
	} else {
		$body 				= $struc->getTemplateContent('login');
	}
	$struc->loadStructure($body);
?>