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
		
		// Update Services Start
		if(isset($_POST['UpdateService'])) {
			$serviceUpdate 	= new Update();
			$msg 			= $serviceUpdate->updateServices();
		}
		// Update Services End
		
		// Insert Module Start
		if(isset($_POST['InsertModule'])) {
			$moduleInsert 	= new Insert();
			$msg 			= $moduleInsert->insertModule();
		}
		// Insert Module End
		
		// Update Module Start
		if(isset($_POST['UpdateModule'])) {
			$moduleUpdate 	= new Update();
			$msg 			= $moduleUpdate->updateModule();
		}
		// Update Module End
		
		// Insert Sub Module Start
		if(isset($_POST['InsertSubModule'])) {
			$subModInsert 	= new Insert();
			$msg 			= $subModInsert->insertSubModule();
		}
		// Insert Sub Module End
		
		// Update Sub Module Start
		if(isset($_POST['UpdateSubModule'])) {
			$subModUpdate 	= new Update();
			$msg 			= $subModUpdate->UpdateSubModule();
		}
		// Update Sub Module End
		
		$body 				= $action->getSystemParameters($userId);
		if(strlen($msg)>0) {
			$body 			= str_replace('<!--%[MSG]%-->',$msg,$body);
		}
	} else {
		$body 				= $struc->getTemplateContent('login');
	}
	$struc->loadStructure($body);
?>