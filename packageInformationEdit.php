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
		if(isset($_POST['editSubmitProcurement'])) {
			 
			 $packageId = $_POST['packageId']; 
			 $msg 			= $action->procurementPlanNext($userId,$packageId,$pi_4,$pi_6);
		}
		// View Pacakge Information End
		
		if(isset($_POST['editPacakgeInformationSubmit'])) {
			 $pacakgeInformationEdit 	= new pacakgeInformationEditInsert();
			 $msg 			= $pacakgeInformationEdit->insertPacakgeInformationEidt($userId);
			
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