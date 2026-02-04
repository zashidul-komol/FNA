<?php
	include('init.php');
	
	$action 		= new ProjectSetup();
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
		
		
		
		// Insert Labour Information Start
		if(isset($_POST['InsertLabourInfo'])) {
			$labourInsert 	= new projectSetupInsertNew();
			$msg 			= $labourInsert->insertLabourInfo($userId);
		}
		// Insert Labour Information End
		
		// Insert Party Information Start
		if(isset($_POST['InsertPartyInfo'])) {
			$labourInsert 	= new projectSetupInsertNew();
			$msg 			= $labourInsert->InsertPartyInfo($userId);
		}
		// Insert Party Information End
		
		// Insert Chamber Information Start
		if(isset($_POST['InsertChamberInfo'])) {
			$labourInsert 	= new projectSetupInsertNew();
			$msg 			= $labourInsert->InsertChamberInfo($userId);
		}
		// Insert Chamber Information End
		
		// Insert Floor Information Start
		if(isset($_POST['InsertFloorInfo'])) {
			$labourInsert 	= new projectSetupInsertNew();
			$msg 			= $labourInsert->InsertFloorInfo($userId);
		}
		// Insert Floor Information End
		
		// Insert Pocket Information Start
		if(isset($_POST['InsertPocketInfo'])) {
			$labourInsert 	= new projectSetupInsertNew();
			$msg 			= $labourInsert->InsertPocketInfo($userId);
		}
		// Insert Pocket Information End
		
		// Insert Product Category Type Information Start
		if(isset($_POST['InsertProdCatTypeInfo'])) {
			$labourInsert 	= new projectSetupInsertNew();
			$msg 			= $labourInsert->InsertProdCatTypeInfo($userId);
		}
		// Insert Product Category Type Information End
		
		// Insert Product Information Start
		if(isset($_POST['InsertProdInfo'])) {
			$labourInsert 	= new projectSetupInsertNew();
			$msg 			= $labourInsert->InsertProdInfo($userId);
		}
		// Insert Product Information End
		
		// Insert Poultry Others Income Information Start  
		if(isset($_POST['InsertPalOthersIncomeInfo'])) {
			$labourInsert 	= new projectSetupInsertNew();
			$msg 			= $labourInsert->InsertPalOthersIncomeInfo($userId);
		}
		// Insert Poultry Others Income Information End
		
		// Insert Poultry Others Expanse Information Start  
		if(isset($_POST['InsertPalOthersExpanseInfo'])) {
			$labourInsert 	= new projectSetupInsertNew();
			$msg 			= $labourInsert->InsertPalOthersExpanseInfo($userId);
		}
		// Insert Poultry Others Expanse Information End
		
		// Insert Product Fare  Information Start
		if(isset($_POST['InsertProdFareInfo'])) {
			$ProductFareInsert 	= new projectSetupInsertNew();
			$msg 				= $ProductFareInsert->InsertProdFareInfo($userId);
		}
		// Insert Product Fare Information End
		
		// Insert Alu Fare  Information Start
		if(isset($_POST['InsertAluFareInfo'])) {
			$ProductFareInsert 	= new projectSetupInsertNew();
			$msg 				= $ProductFareInsert->InsertAluFareInfo($userId);
		}
		// Insert Alu Fare Information End
		
		// Insert Session Information Start
		if(isset($_POST['InsertSessionInfo'])) {
			$labourInsert 	= new projectSetupInsertNew();
			$msg 			= $labourInsert->InsertSessionInfo($userId);
		}
		// Insert Session Information End
		
		// Insert Packing Name Information Start
		if(isset($_POST['InsertPackingNameInfo'])) {
			$labourInsert 	= new projectSetupInsertNew();
			$msg 			= $labourInsert->insertPackingNameInfo($userId);
		}
		// Insert Packing Name Information End	
		
		// Insert Loan Type Information Start
		if(isset($_POST['InsertLoanTypeInfo'])) {
			$labourInsert 	= new projectSetupInsertNew();
			$msg 			= $labourInsert->insertLoanTypeInfo($userId);
		}
		// Insert Loan Type Information End	
		
		// Insert Packing Unit Information Start
		if(isset($_POST['InsertPackingUnitInfo'])) {
			$labourInsert 	= new projectSetupInsertNew();
			$msg 			= $labourInsert->insertPackingUnitInfo($userId);
		}
		// Insert Packing Unit Information End	
		
		// Insert Quantity Information StartInsertWeightInfo
		if(isset($_POST['InsertQuantityInfo'])) {
			$labourInsert 	= new projectSetupInsertNew();
			$msg 			= $labourInsert->insertQuantityInfo($userId);
		}
		// Insert Quantity Information End	
		
		// Insert Weight Information Start
		if(isset($_POST['InsertWeightInfo'])) {
			$labourInsert 	= new projectSetupInsertNew();
			$msg 			= $labourInsert->insertWeightInfo($userId);
		}
		// Insert Weight Information End	
		
		// Insert Labour Contract Information Start
		if(isset($_POST['InsertLabourContract'])) {
			$labourInsert 	= new projectSetupInsertNew();
			$msg 			= $labourInsert->insertLabourContractInfo($userId);
		}
		// Insert Labour Contract Information End
		
		// Insert Expanse Head Information Start
		if(isset($_POST['InsertExpHeadInfo'])) {
			$labourInsert 	= new projectSetupInsertNew();
			$msg 			= $labourInsert->InsertExpHeadInfo($userId);
		}
		// Insert Expanse Head Information End
		
		// Insert Income Head Information Start
		if(isset($_POST['InsertIncHeadInfo'])) {
			$labourInsert 	= new projectSetupInsertNew();
			$msg 			= $labourInsert->InsertIncHeadInfo($userId);
		}
		// Insert Income Head Information End
		
		// Insert Project Information Start
		if(isset($_POST['InsertProjectInfo'])) {
			$projectInsert 	= new projectSetupInsertNew();
			$msg 			= $projectInsert->InsertProjectInfo($userId);
		}
		// Insert Project Information End
		
		// Insert Bank Information Start
		if(isset($_POST['InsertBankInfo'])) {
			$projectInsert 	= new projectSetupInsertNew();
			$msg 			= $projectInsert->InsertBankInfo($userId);
		}
		// Insert Bank Information End  
		
		// Insert Bank Branch Information Start
		if(isset($_POST['InsertBankBranchInfo'])) {
			$projectInsert 	= new projectSetupInsertNew();
			$msg 			= $projectInsert->InsertBankBranchInfo($userId);
		}
		// Insert Bank Branch Information End
		
		// Insert Bank Account No Information Start
		if(isset($_POST['InsertBankAccountInfo'])) {
			$projectInsert 	= new projectSetupInsertNew();
			$msg 			= $projectInsert->InsertBankAccountInfo($userId);
		}
		// Insert Bank Account No  Information End
		
		// Insert Sub Project Information Start 
		if(isset($_POST['InsertSubProjInfo'])) {
			$subProjInsert 	= new projectSetupInsertNew();
			$msg 			= $subProjInsert->InsertSubProjInfo($userId);
		}
		// Insert Sub Project Information End
		
		// Insert Expanse Sub Head Information Start 
		if(isset($_POST['InsertExpSubHeadInfo'])) {
			$labourInsert 	= new projectSetupInsertNew();
			$msg 			= $labourInsert->InsertExpSubHeadInfo($userId);
		}
		// Insert Expanse Sub Head Information End
		
		$body 				= $action->getSystemParameters($userId);
		if(strlen($msg)>0) {
			$body 			= str_replace('<!--%[MSG]%-->',$msg,$body);
		}
	} else {
		$body 				= $struc->getTemplateContent('login');
	}
	$struc->loadStructure($body);
?>