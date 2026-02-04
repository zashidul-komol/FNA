<?php
	include('init.php');
	
	$action 		= new Action();
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
		
		// Insert Services Start
		if(isset($_POST['InsertService'])) {
			$serviceInsert 	= new Insert();
			$msg 			= $serviceInsert->insertServices();
		}
		// Insert Services End
		
		$body 				= $action->getSystemParameters($userId);
		if(strlen($msg)>0) {
			$body 			= str_replace('<!--%[MSG]%-->',$msg,$body);
		}
	} else {
		$body 				= $struc->getTemplateContent('login');
	}
	$struc->loadStructure($body);
?>