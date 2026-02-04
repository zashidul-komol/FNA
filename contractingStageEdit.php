<?php
	include('init.php');
	
	$action 		= new procurementEdit();
	$opId 			= '';
	$userId 		= '';
	$role 			= '';
	$businessDate 	= '';
	$body           = '';
	if(isset($_SESSION['fmOperatorId'])) {
		$opId 			= $_SESSION['fmOperatorId'];
		$userId 		= $_SESSION['fmUserId'];
	}
	
	if(isset($opId) && (strlen($opId) > 0)) {
		$msg 				= '';
		
		
		
		// View Pacakge Information Start
		if(isset($_POST['editSubmitContractingStage'])) {
			 
			 $packageId = $_POST['packageId']; 
			 $packageName = $_POST['packageName'];
			 $pi_4 = $_POST['pi_4'];
			 $pi_5 = $_POST['pi_5'];
			 $pi_6 = $_POST['pi_6']; 
			 $msg 			= $action->contractingStageEditNext($userId,$packageId,$packageName,$pi_4,$pi_5,$pi_6);
		}
		// View Pacakge Information End
		
		if(isset($_POST['editContractingStage'])) {
			 $contractingStageEdit 	= new pacakgeInformationEditInsert();
			 $msg 			= $contractingStageEdit->contractingStageEidt($userId);
			
		}
		
		
		
		 $body 				= $action->pacakgeInformationNext2($userId);
		if(strlen($msg)>0) {
			$body 			= str_replace('<!--%[MSG]%-->',$msg,$body);
		}
	} else {
		$body 				= $struc->getTemplateContent('login');
	}
	$struc->loadStructure($body);
?>