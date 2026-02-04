<?php
	//error_reporting(0);
	include('init.php');
	
	$action 		= new Action();
	$opId 			= '';
	$userId 		= '';
	$role 			= '';
	if(isset($_SESSION['fmOperatorId'])) {
		$opId 				= $_SESSION['fmOperatorId'];
		$userId 			= $_SESSION['fmUserId'];
		if(isset($_SESSION['fmRole'])) {
			$role 			= $_SESSION['fmRole'];
		}
	}
	if(isset($opId) && (strlen($opId) > 0)) {
		if(isset($_POST['UpdateUserRegistration'])) {
			$update 		= new Update();
			$msg 			= $update->updateMyInformation($userId);
		}
		$body 				= $action->getIndexContent($userId);
	} else {
		$body 				= $struc->getTemplateContent('login');
		$body 				= str_replace('<!--%[MSG]%-->',$loginMsg,$body);
	}
	$struc->loadStructure($body,'y');
?>