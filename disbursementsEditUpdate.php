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
		
		
		
		if(isset($_POST['editUpdateSubmitDisbursementsStage'])) {
			 
			 $packageId 	= $_POST['packageId']; 
			 $packageName 	= $_POST['packageName'];
			 $bpc_79h 		= $_POST['bpc_79h'];
			 $bpc_79i 		= $_POST['bpc_79i'];
			 $bpc_79j 		= $_POST['bpc_79j'];
			 $pi_4 			= $_POST['pi_4'];
			 $pi_5 			= $_POST['pi_5'];
			 $pi_6 			= $_POST['pi_6']; 
			 $msg 			= $action->disbursementsStageEditUpdate($userId,$packageId,$packageName,$bpc_79h,$bpc_79i,$bpc_79j,$pi_4,$pi_5,$pi_6);
		}
		
		if(isset($_POST['submitDisbursementsStage'])) {
			 $disbursementsStageInsert 	= new pacakgeInformationInsert();
			 $msg 			= $disbursementsStageInsert->insertDisbursementsStage($userId);
			
		}
		
		
		$body 				= $action->disbursementsStageNext2($userId);
		if(strlen($msg)>0) {
			$body 			= str_replace('<!--%[MSG]%-->',$msg,$body);
		}
	} else {
		$body 				= $struc->getTemplateContent('login');
	}
	$struc->loadStructure($body);
?>