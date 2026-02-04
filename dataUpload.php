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
		
		
	if(isset($_POST['dataUploadSubmit'])) {
		$dataUploadInsert 	= new pacakgeInformationInsert();
		 $msg 			= $dataUploadInsert->insertdataUpload($userId);
		}
		
		$body 				= $action->getDataUpload($userId);
		if(strlen($msg)>0) {
			$body 			= str_replace('<!--%[MSG]%-->',$msg,$body);
		}
	} else {
		$body 				= $struc->getTemplateContent('login');
	}
	$struc->loadStructure($body);
?>