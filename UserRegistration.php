<?php
	include('init.php');
	
	$action 		= new Action();
	$opId 			= '';
	$userId 		= '';
	$role 			= '';
	$msg			= '';
	
	if(isset($_SESSION['fmOperatorId'])) {
		$opId 			= $_SESSION['fmOperatorId'];
		$userId 		= $_SESSION['fmUserId'];
	}
	
	if(isset($opId) && (strlen($opId) > 0)) {
		// Insert User Role Start
		if(isset($_POST['InsertRole'])) {
			$roleInsert 	= new Insert();
			$msg 			= $roleInsert->insertUserRole($userId);
		}
		// Insert User Role End
		
		// Update User Role Start
		if(isset($_POST['UpdateUserRoleName'])) {
			$roleUpdate 	= new Update();
			$msg 			= $roleUpdate->updateUserRole($userId);
		}
		// Update User Role End
		
		// Insert User Position Start
		if(isset($_POST['InsertPosition'])) {
			$positionInsert 	= new Insert();
			$msg 				= $positionInsert->InsertPosition($userId);
		}
		// Insert User Position End
		
		// Update User Position Start
		if(isset($_POST['UpdatePosition'])) {
			$positionUpdate	= new UpdateMohsin();
			$msg 			= $positionUpdate->UpdatePosition($userId);
		}
		// Update User Position End
		
		// Insert User Information Start
		if(isset($_POST['InsertUserRegistration'])) {
			$insert 		= new Insert();
			$msg 			= $insert->insertUserRegistration($userId);
		}
		// Insert User Information End
		
		// Update User Information Start
		if(isset($_POST['UpdateUserRegistration'])) {
			$update 		= new Update();
			$msg 			= $update->updateUserRegistration($userId);
		}
		// Update User Information End
		
		$body 				= $action->getUserRegistration($userId);
		if(strlen($msg)>0) {
			$body 			= str_replace('<!--%[MSG]%-->',$msg,$body);
		}
	} else {
		$body 				= $struc->getTemplateContent('login');
	}
	
	$struc->loadStructure($body);
?>