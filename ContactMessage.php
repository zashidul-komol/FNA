<?php
	include('init.php');
	
	$action 		= new Training();
	$opId 			= '';
	$userId 		= '';
	$role 			= '';
	$businessDate 	= '';
	if(isset($_SESSION['fmOperatorId'])) {
		$opId 			= $_SESSION['fmOperatorId'];
		$userId 		= $_SESSION['fmUserId'];
	}
	if(isset($opId) && (strlen($opId) > 0)) {
		$msg 		= '';
		$body 		= $action->getContactMessageList($userId);
		if(strlen($msg)>0) {
			$body 	= str_replace('<!--%[MSG]%-->',$msg,$body);
		}		
	} else {
		$body 		= $struc->getTemplateContent('login');
	}
	
	$struc->loadStructure($body);
?>