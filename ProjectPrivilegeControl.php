<?php
	include('init.php');
	
	$action 		= new ProjectSetup();
	$opId 			= '';
	$userId 		= '';
	$role 			= '';
	
	if(isset($_SESSION['fmOperatorId'])) {
		$opId 			= $_SESSION['fmOperatorId'];
		$userId 		= $_SESSION['fmUserId'];
	}
	
	if(isset($opId) && (strlen($opId) > 0)) {
		// Update User Role Start
		if(isset($_POST['UpdateModulePrivilege'])) {
			$modPrivilegeUpdate 	= new ProjectSetupInsert();
			$msg 					= $modPrivilegeUpdate->insertModulePrivilege();
		}
		// Update User Role End
		
		
		$body 				= $action->getModulePrivilege($userId);
		if(strlen($msg)>0) {
			$body 			= str_replace('<!--%[MSG]%-->',$msg,$body);
		}
	} else {
		$body 				= $struc->getTemplateContent('login');
	}
	
	$struc->loadStructure($body);
?>