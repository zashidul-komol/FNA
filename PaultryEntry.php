<?php
	include('init.php');
	
	$action 		= new PaultrySetup();
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
		// Insert Egg Sell Category Information Start 
		if(isset($_POST['InsertEggSellCatInfo'])) {
			$labourInsert 	= new PaultryInsertNew();
			$msg 			= $labourInsert->insertEggSellCatInfo($userId);
		}
		// Insert Egg Sell Category Information End
		
		// Insert Opening Batch Information Start 
		if(isset($_POST['InsertOpeningBatchInfo'])) {
			$labourInsert 	= new PaultryInsertNew();
			$msg 			= $labourInsert->insertOpeningBatchInfo($userId);
		}
		// Insert Opening Batch Information End
		
		// Insert Standard Food Item Start 
		if(isset($_POST['InsertStandardFoodInfo'])) {
			$labourInsert 	= new PaultryInsertNew();
			$msg 			= $labourInsert->InsertStandardFoodInfo($userId);
		}
		// Insert Standard Food Item End
		
		// Insert Daily Operation Information Start 
		if(isset($_POST['InsertDailyOperInfo'])) {
			$labourInsert 	= new PaultryInsertNew();
			$msg 			= $labourInsert->insertDailyOperInfo($userId);
		}
		// Insert Daily Operation Information End
		
		// Insert Divide Morog Murgi Information Start 
		if(isset($_POST['InsertDivMMInfo'])) {
			$labourInsert 	= new PaultryInsertNew();
			$msg 			= $labourInsert->insertDivMMInfo($userId);
		}
		// Insert Divide Morog Murgi Information End
		
		// Insert Daily Operation Morog Murgi  Start 
		if(isset($_POST['InsertDailyOperMurMorInfo'])) {
			$labourInsert 	= new PaultryInsertNew();
			$msg 			= $labourInsert->insertDailyOperMurMorInfo($userId);
		}
		// Insert Daily Operation Morog Murgi End
		
		// Insert Food Distribution Morog Murgi  Start 
		if(isset($_POST['InsertFoodDistInfo'])) {
			$labourInsert 	= new PaultryInsertNew();
			$msg 			= $labourInsert->insertFoodDistInfo($userId);
		}
		// Insert Food Distribution Morog Murgi End
		
		// Insert Medicine Distribution Start 
		if(isset($_POST['InsertMedicinDistInfo'])) {
			$labourInsert 	= new PaultryInsertNew();
			$msg 			= $labourInsert->insertMedicinDistInfo($userId);
		}
		// Insert Medicine Distribution End
		
		// Insert Others Income Start 
		if(isset($_POST['InsertOthersIncomeInfo'])) {
			$labourInsert 	= new PaultryInsertNew();
			$msg 			= $labourInsert->InsertOthersIncomeInfo($userId);
		}
		// Insert Others Income End
		
		// Insert Others Expanse Start 
		if(isset($_POST['InsertOthersExpanseInfo'])) {
			$labourInsert 	= new PaultryInsertNew();
			$msg 			= $labourInsert->InsertOthersExpanseInfo($userId);
		}
		// Insert Others Expanse End
		
		// Insert Egg Production Start 
		if(isset($_POST['InsertEggProdInfo'])) {
			$labourInsert 	= new PaultryInsertNew();
			$msg 			= $labourInsert->insertEggProdInfo($userId);
		}
		// Insert  Egg Production End
		
		
		$body 				= $action->getSystemParameters($userId);
		if(strlen($msg)>0) {
			$body 			= str_replace('<!--%[MSG]%-->',$msg,$body);
		}
	} else {
		$body 				= $struc->getTemplateContent('login');
	}
	$struc->loadStructure($body);
?>