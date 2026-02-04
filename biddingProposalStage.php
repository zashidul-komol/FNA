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
		
		
		
		if(isset($_POST['biddingProposalStageSubmit'])) {
			 
			 $packageId = $_POST['packageId']; 
			 $pi_4 = $_POST['pi_4'];
			 $pi_5 = $_POST['pi_5'];
			 $pi_6 = $_POST['pi_6']; 
			 $packageName = $_POST['packageName'];
			 $msg 			= $action->biddingProposalStageNext($userId,$packageId,$packageName,$pi_4,$pi_5,$pi_6);
		}
		
		if(isset($_POST['insertbiddingProposalStage'])) {
			 $biddingProposalStageInsert 	= new pacakgeInformationInsert();
			 $msg 			= $biddingProposalStageInsert->insertbiddingProposalStage($userId);
			
		}
		
		
		$body 				= $action->biddingProposalStageNext2($userId);
		if(strlen($msg)>0) {
			$body 			= str_replace('<!--%[MSG]%-->',$msg,$body);
		}
	} else {
		$body 				= $struc->getTemplateContent('login');
	}
	$struc->loadStructure($body);
?>