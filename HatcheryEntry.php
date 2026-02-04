<?php
	include('init.php');
	
	$action 		= new HatcherySetup();
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
		// Insert Hatching Opening Egg Qnty Information Start 
		if(isset($_POST['InsertOpenHatchEggInfo'])) {
			$labourInsert 	= new HatcheryInsertNew();
			$msg 			= $labourInsert->insertOpenHatchEggInfo($userId);
		}
		// Insert Hatching Opening Egg Qnty Information End
		
		// Insert Hatching Egg Setting Information Start 
		if(isset($_POST['InsertEggSettingInfo'])) {
			$labourInsert 	= new HatcheryInsertNew();
			$msg 			= $labourInsert->insertEggSettingInfo($userId);
		}
		// Insert Hatching Egg Setting Information End
		
		// Insert Hatching Chicken Production Information Start 
		if(isset($_POST['InsertChickProdInfo'])) {
			$labourInsert 	= new HatcheryInsertNew();
			$msg 			= $labourInsert->insertChickProdInfo($userId);
		}
		// Insert Hatching Chicken Production Information End
		
		// Insert Hatching Chicken Sell Information Start 
		if(isset($_POST['InsertChickSellInfo'])) {
			$labourInsert 	= new HatcheryInsertNew();
			$msg 			= $labourInsert->insertChickSellInfo($userId);
		}
		// Insert Hatching  Chicken Sell Information End
		
		// Insert Vanga Egg Sell Information Start 
		if(isset($_POST['InsertVangaEggSellInfo'])) {
			$labourInsert 	= new HatcheryInsertNew();
			$msg 			= $labourInsert->insertVangaEggSellInfo($userId);
		}
		// Insert Vanga Egg Sell Information End
		
		$body 				= $action->getSystemParameters($userId);
		if(strlen($msg)>0) {
			$body 			= str_replace('<!--%[MSG]%-->',$msg,$body);
		}
	} else {
		$body 				= $struc->getTemplateContent('login');
	}
	$struc->loadStructure($body);
?>