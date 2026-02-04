<?php
	include('init.php');
	
	$action 		= new package();
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
		if(isset($_POST['pacakgeInformation'])) {
			// $pacakgeInformationInsert 	= new PacakgeInformationInsert();
			 //$msg 			= $pacakgeInformationInsert->insertPacakgeInformation($userId);
			 
			 $procurementType = $_POST['piProcurementType']; 
			 $piProcurementMethod = $_POST['piProcurementMethod'];
			 $piBiddingProcedure = $_POST['piBiddingProcedure'];
			 $piPriorReview = $_POST['piPriorReview'];
			 $piPrequalificationProcess = $_POST['piPrequalificationProcess'];
			 $msg 			= $action->pacakgeInformationNext($userId,$procurementType,$piProcurementMethod,$piBiddingProcedure,$piPriorReview,$piPrequalificationProcess);
		}
		// View Pacakge Information End
		
		if(isset($_POST['insertPacakgeInformation'])) {
			 $pacakgeInformationInsert 	= new PacakgeInformationInsert();
			 $msg 			= $pacakgeInformationInsert->insertPacakgeInformation($userId);
			
		}
		if(isset($_POST['insertActualStage'])) {
			 $insertActualStageInsert 	= new PacakgeInformationInsert();
			 $msg 			= $insertActualStageInsert->actualStageInsert($userId);
			
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