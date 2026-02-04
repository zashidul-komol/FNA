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
		if(isset($_POST['submitPQStage'])) {
			 
			 $packageId = $_POST['packageId']; 
			 $pi_4 = $_POST['pi_4'];
			 $pi_5 = $_POST['pi_5'];
			 $pi_6 = $_POST['pi_6']; 
			 $packageName   = $_POST['packageName'];
			 $msg 			= $action->pqStageNext($userId,$packageId,$packageName,$pi_4,$pi_5,$pi_6);
		}
		// View Pacakge Information End
		
		if(isset($_POST['insertPQStage'])) {
			 $pQStageInsert 	= new pacakgeInformationInsert();
			 $msg 			= $pQStageInsert->insertPQStage($userId);
			
		}
		
		
		$body 				= $action->pqStageNext2($userId);
		if(strlen($msg)>0) {
			$body 			= str_replace('<!--%[MSG]%-->',$msg,$body);
		}
	} else {
		$body 				= $struc->getTemplateContent('login');
	}
	$struc->loadStructure($body);
?>