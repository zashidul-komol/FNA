<?php
	class package Extends BaseClass {
		function package() {
			$this->con	= $this->BaseClass();
		}
		
		//Index Content Start
		function getIndexContent($userId) {
			$indexbody 	= $this->getTemplateContent('index');
			$str 		= $this->generateTab($userId);
			$indexbody 	= str_replace('<!--%[TABS]%-->',$str,$indexbody);
			return $indexbody;
		}
		//Index Content End
		
	// .......................................................................Dfault Package Information Start......................................................................
		function pacakgeInformationNext2($empId) {
			$systemParametersBody = $this->getTemplateContent('packageInformation');

			
			return $systemParametersBody;
		}
		//Dfault Package Information End
		
		
		// show package Information start
		function pacakgeInformationNext($userId,$procurementType,$piProcurementMethod,$piBiddingProcedure,$piPriorReview,$piPrequalificationProcess) {
			
			$systemParametersBody = $this->getTemplateContent('packageInformationNext');
			
			
			//Service for Module Form Starta 
			
			$systemParametersBody = str_replace('<!--%[PROCUREMENTTYPE]%-->',$procurementType,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[PROCUREMENTMETHOD]%-->',$piProcurementMethod,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[BIDDINGPROCUREDURE]%-->',$piBiddingProcedure,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[PRIOREVIEW]%-->',$piPriorReview,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[PREWUALIFICATIONPROCESS]%-->',$piPrequalificationProcess,$systemParametersBody);
			
			$adbProjectList 				= '';
			$projectListQuery 				= "SELECT ps.psId, ps.adbProjectName FROM adbs_projectsetup ps, s_user u WHERE ps.psId = u.psId  AND u.USER_ID = {$userId} ORDER BY adbProjectName ASC";
			$projectListStatement			= mysql_query($projectListQuery);
			while($projectListStatementData	= mysql_fetch_array($projectListStatement)) {
				$adbProjectName				= $projectListStatementData["adbProjectName"];
				$psIdName				    = $projectListStatementData["psId"];
				$adbProjectList				.= "<option value='".$psIdName."'>".$adbProjectName."</option>";
			}
	
			$systemParametersBody = str_replace('<!--%[PROJECT_LIST]%-->',$adbProjectList,$systemParametersBody);
			/*
			$adbProjectList 					= '';
			$adbProjectListQuery 				= "			
												SELECT
													adbs_projectsetup.psId,
													adbs_projectsetup.adbProjectName
											FROM
													adbs_projectsetup
											WHERE
													adbs_projectsetup.aId='$aId'
											ORDER BY
													adbs_projectsetup.psId
			
								";
			$adbProjectListStatement			= mysql_query($adbProjectListQuery);
			while($adbProjectListStatementData	= mysql_fetch_array($adbProjectListStatement)) {
				$psId					= $adbProjectListStatementData["psId"];
				$adbProjectName				= $adbProjectListStatementData["adbProjectName"];
				$adbProjectList				.= "<option value='".$psId."'>".$adbProjectName."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[ADB_PACKAGE_NAME_LIST]%-->',$adbProjectList,$systemParametersBody);*/
		
			
			return $systemParametersBody;
		}
			
		// show package Information end
		
		
   // .......................................................................Dfault PQ Stage Start......................................................................
		function pqStageNext2($empId) {
			$systemParametersBody = $this->getTemplateContent('pqStage');

			
			return $systemParametersBody;
		}
		
		
		// show PQ Stage start
		function pqStageNext($empId,$packageId,$packageName,$pi_4,$pi_5,$pi_6) {
			
			$systemParametersBody = $this->getTemplateContent('pqStageNext');

			$checkDate = date('Y-m-d');
			$systemParametersBody = str_replace('<!--%[CHECK_DATE]%-->',$checkDate,$systemParametersBody);
			
			$systemParametersBody = str_replace('<!--%[PI_4]%-->',$pi_4,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[PI_5]%-->',$pi_5,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[PI_6]%-->',$pi_6,$systemParametersBody);
			
			$systemParametersBody = str_replace('<!--%[PACKAGEID]%-->',$packageId,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[PACKAGENAME]%-->',$packageName,$systemParametersBody);

			
			return $systemParametersBody;
		}
		// show PQ Stage end
		
	
		
		
		
  // .......................................................................Dfault Bidding Document Preparation Stage Start......................................................................
		function biddingDPStageNext2($empId) {
			$systemParametersBody = $this->getTemplateContent('biddingDPStage');
			
	
		
			
			return $systemParametersBody;
		}
		//Dfault Bidding Document Preparation Stage End
		
		
		// show Bidding Document Preparation Stage start
		function biddingDPStageNext($empId,$packageId,$packageName,$pi_4,$pi_5,$pi_6) {
			
			$systemParametersBody = $this->getTemplateContent('biddingDPStageNext');


			$systemParametersBody = str_replace('<!--%[PI_4]%-->',$pi_4,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[PI_5]%-->',$pi_5,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[PI_6]%-->',$pi_6,$systemParametersBody);
			
			$systemParametersBody = str_replace('<!--%[BIDDING_DP_STAGE_PACKAGEID]%-->',$packageId,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[BIDDING_DP_STAGE_PACKAGENAME]%-->',$packageName,$systemParametersBody);
			$checkDate = date('Y-m-d');
			$systemParametersBody = str_replace('<!--%[CHECK_DATE]%-->',$checkDate,$systemParametersBody);	
			
			
			$priorReviewSql	= "SELECT * FROM adbs_package WHERE pId='".$packageId."' ORDER BY pId";
			$priorReviewSqlStatement			= mysql_query($priorReviewSql);
			$priorReviewSqlStatementData		= mysql_fetch_array($priorReviewSqlStatement);
			$pi_18Check      			    	=  $priorReviewSqlStatementData["pi_18"]; 
			if($pi_18Check == 'No'){
				$bdps_29_30View = "none";
			}else{
				$bdps_29_30View = "";	
			}		
			$systemParametersBody = str_replace('<!--%[BDPS_29_30]%-->',$bdps_29_30View,$systemParametersBody); 
			

			
			return $systemParametersBody;
		}
		// show Bidding Document Preparation Stage end
		
		
		
		
		
		
  // .......................................................................Dfault Bidding/Proposal Stage Start......................................................................
	  function biddingProposalStageNext2($empId) {
			$systemParametersBody = $this->getTemplateContent('biddingProposalStage');
		
			
			return $systemParametersBody;
		}
		//Dfault Bidding/Proposal Stage End
		
		// show Bidding/Proposal Stage start
		function biddingProposalStageNext($empId,$packageId,$packageName,$pi_4,$pi_5,$pi_6) {
			
			$systemParametersBody = $this->getTemplateContent('biddingProposalStageNext');
			
			
			
			$pq 					= '';
			$pqSql 					= "SELECT * FROM adbs_package WHERE pId='".$packageId."'";
			$pqSqlStatement			= mysql_query($pqSql);
			$pqSqlStatementData		= mysql_fetch_array($pqSqlStatement);
			
			$pqBidder = "";
			if(strtolower($pqSqlStatementData['pi_19']) == 'no'){
				$pqBidder = 'none';
			}		

			$systemParametersBody = str_replace('<!--%[PI_4]%-->',$pi_4,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[PI_5]%-->',$pi_5,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[PI_6]%-->',$pi_6,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[SHOW_HIDE]%-->',$pqBidder,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[BIDDING_PS_PACKAGEID]%-->',$packageId,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[BIDDING_PS_PACKAGENAME]%-->',$packageName,$systemParametersBody);
			$checkDate = date('Y-m-d');
			$systemParametersBody = str_replace('<!--%[CHECK_DATE]%-->',$checkDate,$systemParametersBody);	
			
			
			$priorReviewSql	= "SELECT * FROM adbs_package WHERE pId='".$packageId."' ORDER BY 	pId";
			$priorReviewSqlStatement			= mysql_query($priorReviewSql);
			$priorReviewSqlStatementData		= mysql_fetch_array($priorReviewSqlStatement);
			$pi_18Check      			    	=  $priorReviewSqlStatementData["pi_18"]; 
			if($pi_18Check == 'No'){
				$bps_42_43_44View = "none";
			}else{
				$bps_42_43_44View = "";	
			}			
			$systemParametersBody = str_replace('<!--%[BPS_43_43_44VIEW]%-->',$bps_42_43_44View,$systemParametersBody); 

			
			return $systemParametersBody;
		}
		// show Bidding/Proposal Stage end
		
		
		
		
		
  // .......................................................................Dfault Bid Proposal Evaluation Stage Start......................................................................
	  function bidProposalESNext2($empId) {
			$systemParametersBody = $this->getTemplateContent('bidProposalEvaluationStage');
			
			
			return $systemParametersBody;
		}
		
		// show Bid Proposal Evaluation Stage start
		function bidProposalESNext($empId,$packageId,$packageName,$pi_4,$pi_5,$pi_6) {
			
			$systemParametersBody = $this->getTemplateContent('bidProposalEvaluationStageNext');


			$systemParametersBody = str_replace('<!--%[PI_4]%-->',$pi_4,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[PI_5]%-->',$pi_5,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[PI_6]%-->',$pi_6,$systemParametersBody);
			
			$systemParametersBody = str_replace('<!--%[BID_PES_PACKAGEID]%-->',$packageId,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[BID_PES_PACKAGENAME]%-->',$packageName,$systemParametersBody);
			
			$bpes_50a_View 	= '';
			$pi_18Check    	= '';
			$priorReviewSql	= "SELECT * FROM adbs_package WHERE pId='".$packageId."' ORDER BY 	pId";
			$priorReviewSqlStatement			= mysql_query($priorReviewSql);
			$priorReviewSqlStatementData		= mysql_fetch_array($priorReviewSqlStatement);
			$pi_18Check      			    	=  $priorReviewSqlStatementData["pi_18"]; 
			$bdps_29_30View = '';
			if($pi_18Check == 'No'){
				$bpes_50a_View = "none";
			}else{
				$bpes_50a_View = "";	
			}		
			$systemParametersBody = str_replace('<!--%[BPES_50A]%-->',$bpes_50a_View,$systemParametersBody); 

			$checkDate = date('Y-m-d');
			$systemParametersBody = str_replace('<!--%[CHECK_DATE]%-->',$checkDate,$systemParametersBody);	
			
			return $systemParametersBody;
		}
		// show Bid Proposal Evaluation Stage end
		
		//Dfault Bid Proposal Evaluation Stage End
		
  // .......................................................................Dfault Evaluation Report Approval Stage Start......................................................................
	  function evaluationPASNext2($empId) {
			$systemParametersBody = $this->getTemplateContent('evaluationReportApprovalStage');
			
			
			return $systemParametersBody;
		}
		
				// show Bid Proposal Evaluation Stage start
		function evaluationPASNext($empId,$packageId,$packageName,$pi_4,$pi_5,$pi_6) {
			
			$systemParametersBody = $this->getTemplateContent('evaluationReportApprovalStageNext');

			
			
			$systemParametersBody = str_replace('<!--%[PI_4]%-->',$pi_4,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[PI_5]%-->',$pi_5,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[PI_6]%-->',$pi_6,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[EVALUATION_RAS_PACKAGEID]%-->',$packageId,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[EVALUATION_RAS_PACKAGENAME]%-->',$packageName,$systemParametersBody);
			
			$priorReviewSql	= "SELECT * FROM adbs_package WHERE pId='".$packageId."' ORDER BY 	pId";
			$priorReviewSqlStatement			= mysql_query($priorReviewSql);
			$priorReviewSqlStatementData		= mysql_fetch_array($priorReviewSqlStatement);
			$pi_18Check      			    	=  $priorReviewSqlStatementData["pi_18"]; 
			if($pi_18Check == 'No'){
				$eras_60a6162View = "none";
			}else{
				$eras_60a6162View = "";	
			}			
			$systemParametersBody = str_replace('<!--%[ERAS_60A_61_62_VIEW]%-->',$eras_60a6162View,$systemParametersBody); 
	
			$checkDate = date('Y-m-d');
			$systemParametersBody = str_replace('<!--%[CHECK_DATE]%-->',$checkDate,$systemParametersBody);	
			
			return $systemParametersBody;
		}
		// show Bid Proposal Evaluation Stage end
		
		//Dfault Evaluation Report Approval Stage End
		
  // .......................................................................Dfault Contracting Stage Start......................................................................
	  function contractingStageNext2($empId) {
			$systemParametersBody = $this->getTemplateContent('contractingStage');
			
			
			return $systemParametersBody;
		}
		
			// show Bid Proposal Evaluation Stage start
		function contractingStageNext($empId,$packageId,$packageName,$pi_4,$pi_5,$pi_6) {
			
			$systemParametersBody = $this->getTemplateContent('contractingStageNext');
			
			$systemParametersBody = str_replace('<!--%[PI_4]%-->',$pi_4,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[PI_5]%-->',$pi_5,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[PI_6]%-->',$pi_6,$systemParametersBody);
			
			$systemParametersBody = str_replace('<!--%[CONTRACTING_STAGE_PACKAGEID]%-->',$packageId,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[CONTRACTING_STAGE_PACKAGENAME]%-->',$packageName,$systemParametersBody);
			
			$priorReviewSql	= "SELECT * FROM adbs_package WHERE pId='".$packageId."' ORDER BY 	pId";
			$priorReviewSqlStatement			= mysql_query($priorReviewSql);
			$priorReviewSqlStatementData		= mysql_fetch_array($priorReviewSqlStatement);
			$pi_18Check      			    	=  $priorReviewSqlStatementData["pi_18"]; 
			if($pi_18Check == 'No'){
				$cs_70View = "none";
			}else{
				$cs_70View = "";	
			}			
			$systemParametersBody = str_replace('<!--%[CS_70VIEW]%-->',$cs_70View,$systemParametersBody); 

			$checkDate = date('Y-m-d');
			$systemParametersBody = str_replace('<!--%[CHECK_DATE]%-->',$checkDate,$systemParametersBody);	
			
			return $systemParametersBody;
		}
		// show Bid Proposal Evaluation Stage end
		
		//Dfault Contracting Stage End
		
  // .......................................................................Dfault Contract Management Stage Start......................................................................
	  function contractManagementStageNext2($empId) {
			$systemParametersBody = $this->getTemplateContent('contractManagementStage');
			
			return $systemParametersBody;
		}
		
					// show Bid Proposal Evaluation Stage start
		function contractManagementStageNext($empId,$packageId,$packageName,$pi_4,$pi_5,$pi_6) {
			
			$systemParametersBody = $this->getTemplateContent('contractManagementStageNext');

			$systemParametersBody = str_replace('<!--%[PI_4]%-->',$pi_4,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[PI_5]%-->',$pi_5,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[PI_6]%-->',$pi_6,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[CONTRACT_M_STAGE_PACKAGEID]%-->',$packageId,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[CONTRACT_M_STAGE_PACKAGENAME]%-->',$packageName,$systemParametersBody);
			
			$checkDate = date('Y-m-d'); 
			$systemParametersBody = str_replace('<!--%[CHECK_DATE]%-->',$checkDate,$systemParametersBody);	
			
			return $systemParametersBody;
		}
		// show Bid Proposal Evaluation Stage end
		
		//Dfault Contract Management Stage End
		
  // .......................................................................Dfault Contract Concluding Stage  Start......................................................................
	  function contractConcludingStageNext2($empId) {
			$systemParametersBody = $this->getTemplateContent('contractConcludingStage');
			
			return $systemParametersBody;
		}
		
		 // show Contract Concluding Stage start
		function contractConcludingStageNext($empId,$packageId,$packageName,$pi_4,$pi_5,$pi_6) {
			
			$systemParametersBody = $this->getTemplateContent('contractConcludingStageNext');

			$systemParametersBody = str_replace('<!--%[PI_4]%-->',$pi_4,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[PI_5]%-->',$pi_5,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[PI_6]%-->',$pi_6,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[CONTRACT_CONCLUDING_STAGE_PACKAGEID]%-->',$packageId,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[CONTRACT_CONCLUDING_STAGE_PACKAGENAME]%-->',$packageName,$systemParametersBody);
			$checkDate = date('Y-m-d');
			$systemParametersBody = str_replace('<!--%[CHECK_DATE]%-->',$checkDate,$systemParametersBody);	

			
			return $systemParametersBody;
		}
		// show Contract Concluding Stage end
		
		//Dfault Contract Concluding Stage End
		
  // .......................................................................Dfault Others Information Start......................................................................
	  function othersInformationNext2($empId) {
			$systemParametersBody = $this->getTemplateContent('othersInformation');
			
			return $systemParametersBody;
		}
		
		// show Others Information start
		function othersInformationNext($empId,$packageId,$packageName,$pi_4,$pi_5,$pi_6) {
			
			$systemParametersBody = $this->getTemplateContent('othersInformationNext');

			$systemParametersBody = str_replace('<!--%[PI_4]%-->',$pi_4,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[PI_5]%-->',$pi_5,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[PI_6]%-->',$pi_6,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[OTHERS_INFORMATION_PACKAGEID]%-->',$packageId,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[OTHERS_INFORMATION_PACKAGENAME]%-->',$packageName,$systemParametersBody);
			$checkDate = date('Y-m-d');
			$systemParametersBody = str_replace('<!--%[CHECK_DATE]%-->',$checkDate,$systemParametersBody);	

			
			return $systemParametersBody;
		}
		// show Others Information end
		
		//Dfault Others Information  End
		
		
		
 // .......................................................................Dfault APP Simple Report Start......................................................................
	  function getDfoltappSimple($empId) {
			$systemParametersBody = $this->getTemplateContent('appSimple');
			
			return $systemParametersBody;
		}
		
		//Dfault Others Information  End
		
 // .......................................................................Dfault Data Uploader file Start......................................................................
	  function getDataUpload($userId) {
			$systemParametersBody = $this->getTemplateContent('dataUpload');
			
			$pProcurementTypeList 					= '';
			$pProcurementTypeListQuery 				= "SELECT ptId, ptName FROM adbs_procurementtype ORDER BY ptId ASC";
			$pProcurementTypeListStatement			= mysql_query($pProcurementTypeListQuery);
			while($pProcurementTypeListStatementData	= mysql_fetch_array($pProcurementTypeListStatement)) {
				$ptId					= $pProcurementTypeListStatementData["ptId"];
				$ptName				= $pProcurementTypeListStatementData["ptName"];
				$pProcurementTypeList 				.= "<option value='".$ptId."'>".$ptName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_PROCUREMENT_TYPE_LIST]%-->',$pProcurementTypeList,$systemParametersBody);
			
			$pName = '';
			$psSql	= "SELECT * FROM adbs_package WHERE entUser='".$userId."' ORDER BY pId";
			$pSqlStatement		= mysql_query($psSql);
			$pSqlStatementData	= mysql_fetch_array($pSqlStatement);
			$pName       			= $pSqlStatementData["pName"];
			
			$systemParametersBody = str_replace('<!--%[PACKAGE_LIST]%-->',$pName,$systemParametersBody);
			
			return $systemParametersBody;
		}
		
		//Dfault Data Uploader file End		
				
		
  // .......................................................................Dfault Test2 Start......................................................................
	  function getDfoltcreateNewPacakge($empId) {
			$systemParametersBody = $this->getTemplateContent('createNewPacakge');

			
			$packageNameList 							= '';
			$packageNameListQuery 						= "SELECT * FROM adbs_package where entUser='$empId' ORDER BY pId";
			$packageNameListQueryStatement				= mysql_query($packageNameListQuery);
			while($packageNameListQueryStatementData	= mysql_fetch_array($packageNameListQueryStatement)) {
				$pId				= $packageNameListQueryStatementData["pId"];
				$pName           	= substr($packageNameListQueryStatementData["pName"],0, 60); 
				$packageNameList 				.= "<option value='".$pId."'>".$pName."......</option>";
			}
			$systemParametersBody = str_replace('<!--%[PACKAGE_NAME_LIST]%-->',$packageNameList,$systemParametersBody);
			
			
			// Input Tab Head View Start
			$ithView 		= '';
			$ithViewQuery 	= "
									SELECT
											ithName,
											ithDescription
									FROM
											adbs_inputtabhead
									ORDER BY
											ithName
									ASC
								";
			$sv								= 1;
			$ithViewStatement			= mysql_query($ithViewQuery);
			while($ithViewStatementData	= mysql_fetch_array($ithViewStatement)) {
				if($sv%2==0) {
					$class	= "evenRow";
				} else {
					$class	= "oddRow";
				}
				
				$ithName        		= $ithViewStatementData["ithName"];
				$ithDescription      = $ithViewStatementData["ithDescription"];
				
				$ithView .= "<tr valign='top' class='$class'>
									<td >{$sv}</td>
									<td >{$ithName}</td>
									<td >{$ithDescription}</td>
									<td align='center'>
									<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' />
									</td>
								</tr>";
				
				$sv++;
			}
			$systemParametersBody = str_replace('<!--%[Input_Tab_Head_VIEW]%-->',$ithView,$systemParametersBody);
			
			//Input Tab Head View End
			
			// Input Tab Head List Start
			$ithList 					= '';
			$ithListQuery 				= "SELECT ithId, ithName FROM adbs_inputtabhead ORDER BY ithId ASC";
			$ithListStatement			= mysql_query($ithListQuery);
			while($ithListStatementData	= mysql_fetch_array($ithListStatement)) {
				$ithId					= $ithListStatementData["ithId"];
				$ithName				= $ithListStatementData["ithName"];
				$ithList 				.= "<option value='".$ithId."'>".$ithName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[INPUT_TAB_HEAD_LIST]%-->',$ithList,$systemParametersBody);
			// Input Tab Head List End
			
			
			// Input Tab Fields View Start
			$itfView 		= '';
			$itfViewQuery 	= "
									SELECT
											itf.itfName,
											ith.ithName
									FROM
											adbs_inputtabfields as itf,adbs_inputtabhead as ith
									WHERE itf.itfId = ith.ithId 
											
									ORDER BY
											itfName
									ASC
								";
			$sv								= 1;
			$itfViewStatement			= mysql_query($itfViewQuery);
			while($itfViewStatementData	= mysql_fetch_array($itfViewStatement)) {
				if($sv%2==0) {
					$class	= "evenRow";
				} else {
					$class	= "oddRow";
				}
				
				$itfName         = $itfViewStatementData["itfName"];
				$ithName         = $itfViewStatementData["ithName"];
				
				$itfView .= "<tr valign='top' class='$class'>
									<td >{$sv}</td>
									<td >{$ithName}</td>
									<td >{$itfName}</td>
									<td align='center'>
									<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' />
									</td>
								</tr>";
				
				$sv++;
			}
			$systemParametersBody = str_replace('<!--%[Input_Tab_Fields_VIEW]%-->',$itfView,$systemParametersBody);
			
			//Input Tab Fields View End
			
			// Procurement Type List Start
			$pProcurementTypeList 					= '';
			$pProcurementTypeListQuery 				= "SELECT ptId, ptName FROM adbs_procurementtype ORDER BY ptId ASC";
			$pProcurementTypeListStatement			= mysql_query($pProcurementTypeListQuery);
			while($pProcurementTypeListStatementData	= mysql_fetch_array($pProcurementTypeListStatement)) {
				$ptId					= $pProcurementTypeListStatementData["ptId"];
				$ptName				= $pProcurementTypeListStatementData["ptName"];
				$pProcurementTypeList 				.= "<option value='".$ptId."'>".$ptName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_PROCUREMENT_TYPE_LIST]%-->',$pProcurementTypeList,$systemParametersBody);
			// Input Tab Head List End
			
			// Input Tab Procurement Method  Start
			$pProcurementMethodList 					= '';
			$pProcurementMethodListQuery 				= "SELECT pmId, pmName FROM adbs_procurementmethod ORDER BY pmId ASC";

			$pProcurementMethodListStatement			= mysql_query($pProcurementMethodListQuery);
			while($pProcurementMethodListStatementData	= mysql_fetch_array($pProcurementMethodListStatement)) {
				$pmId					= $pProcurementMethodListStatementData["pmId"];
				$pmName				= $pProcurementMethodListStatementData["pmName"];
				$pProcurementMethodList 				.= "<option value='".$pmId."'>".$pmName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_PROCUREMENT_MATHOD_LIST]%-->',$pProcurementMethodList,$systemParametersBody);
			// Input Tab Procurement Method End
			
			// Input Bidding Procurement Start
			$pBiddingProcedureList 					= '';
			$pBiddingProcedureListQuery 				= "SELECT bpId, bpName FROM adbs_biddingprocedure ORDER BY bpId ASC";
			$pBiddingProcedureListStatement			= mysql_query($pBiddingProcedureListQuery);
			while($pBiddingProcedureListStatementData	= mysql_fetch_array($pBiddingProcedureListStatement)) {
				$bpId					= $pBiddingProcedureListStatementData["bpId"];
				$bpName				= $pBiddingProcedureListStatementData["bpName"];
				$pBiddingProcedureList				.= "<option value='".$bpId."'>".$bpName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_BIDDING_PROCEDURE_LIST]%-->',$pBiddingProcedureList,$systemParametersBody);
			// Input Bidding Procurement End
			
			
			// Project View Start
			$pView 		= '';
			$pViewQuery 	= "
									SELECT
											pt.ptName,
											pm.pmName,
											bp.bpName,
											p.pName
									FROM
											adbs_package as p,adbs_procurementtype as pt,adbs_procurementmethod as pm,adbs_biddingprocedure as bp
									WHERE p.ptId = pt.ptId AND p.pmId = pm.pmId AND p.bpId = bp.bpId
									ORDER BY
											pName
									ASC
								";
			$sv								= 1;
			$pViewStatement			= mysql_query($pViewQuery);
			while($pViewStatementData	= mysql_fetch_array($pViewStatement)) {
				if($sv%2==0) {
					$class	= "evenRow";
				} else {
					$class	= "oddRow";
				}
				
				$ptName        		= $pViewStatementData["ptName"];
				$pmName      		= $pViewStatementData["pmName"];
				$bpName        		= $pViewStatementData["bpName"];
				$pName     		    = $pViewStatementData["pName"];
				
				$pNameNew				= ''.$pViewStatementData["ptName"].','.$pViewStatementData["pmName"].','.$pViewStatementData["bpName"].'';
				
				$pView .= "<tr valign='top' class='$class'>
									<td >{$sv}</td>
									<td >{$ptName}</td>
									<td >{$pmName}</td>
									<td >{$bpName}</td>
									<td >{$pNameNew}</td>
									<td align='center'>
									<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' />
									</td>
								</tr>";
				
				$sv++;
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_VIEW]%-->',$pView,$systemParametersBody);
			
			//Project View End
			
			
			
			
			//Service for Module Form Start
			$moduleService 						= '';
			$moduleServiceQuery 				= "SELECT DISTINCT SERVICE_ID,SERVICE_NAME FROM s_service_main ORDER BY SERVICE_NAME ASC";
			$moduleServiceStatement				= mysql_query($moduleServiceQuery);
			while($moduleServiceStatementData	= mysql_fetch_array($moduleServiceStatement)) {
				$serviceId						= $moduleServiceStatementData["SERVICE_ID"];
				$serviceName					= $moduleServiceStatementData["SERVICE_NAME"];
				$moduleService 					.= "<option value='".$serviceId."'>".$serviceName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[MODULE_SERVICE]%-->',$moduleService,$systemParametersBody);
			//Service for Module Form End
	
			
			//Service for Sub Module Start
			$systemParametersBody = str_replace('<!--%[SUBMODULE_SERVICE]%-->',$moduleService,$systemParametersBody);
			//Service for Sub Module End
			
			return $systemParametersBody;
		}
		//Dfault Test2  End	
		
  // .......................................................................Dfault Test1 Start......................................................................
	  function getDfoltTest1($empId) {
			$systemParametersBody = $this->getTemplateContent('test1');
			
			// Input Tab Head View Start
			$ithView 		= '';
			$ithViewQuery 	= "
									SELECT
											ithName,
											ithDescription
									FROM
											adbs_inputtabhead
									ORDER BY
											ithName
									ASC
								";
			$sv								= 1;
			$ithViewStatement			= mysql_query($ithViewQuery);
			while($ithViewStatementData	= mysql_fetch_array($ithViewStatement)) {
				if($sv%2==0) {
					$class	= "evenRow";
				} else {
					$class	= "oddRow";
				}
				
				$ithName        		= $ithViewStatementData["ithName"];
				$ithDescription      = $ithViewStatementData["ithDescription"];
				
				$ithView .= "<tr valign='top' class='$class'>
									<td >{$sv}</td>
									<td >{$ithName}</td>
									<td >{$ithDescription}</td>
									<td align='center'>
									<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' />
									</td>
								</tr>";
				
				$sv++;
			}
			$systemParametersBody = str_replace('<!--%[Input_Tab_Head_VIEW]%-->',$ithView,$systemParametersBody);
			
			//Input Tab Head View End
			
			// Input Tab Head List Start
			$ithList 					= '';
			$ithListQuery 				= "SELECT ithId, ithName FROM adbs_inputtabhead ORDER BY ithId ASC";
			$ithListStatement			= mysql_query($ithListQuery);
			while($ithListStatementData	= mysql_fetch_array($ithListStatement)) {
				$ithId					= $ithListStatementData["ithId"];
				$ithName				= $ithListStatementData["ithName"];
				$ithList 				.= "<option value='".$ithId."'>".$ithName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[INPUT_TAB_HEAD_LIST]%-->',$ithList,$systemParametersBody);
			// Input Tab Head List End
			
			
			// Input Tab Fields View Start
			$itfView 		= '';
			$itfViewQuery 	= "
									SELECT
											itf.itfName,
											ith.ithName
									FROM
											adbs_inputtabfields as itf,adbs_inputtabhead as ith
									WHERE itf.itfId = ith.ithId 
											
									ORDER BY
											itfName
									ASC
								";
			$sv								= 1;
			$itfViewStatement			= mysql_query($itfViewQuery);
			while($itfViewStatementData	= mysql_fetch_array($itfViewStatement)) {
				if($sv%2==0) {
					$class	= "evenRow";
				} else {
					$class	= "oddRow";
				}
				
				$itfName         = $itfViewStatementData["itfName"];
				$ithName         = $itfViewStatementData["ithName"];
				
				$itfView .= "<tr valign='top' class='$class'>
									<td >{$sv}</td>
									<td >{$ithName}</td>
									<td >{$itfName}</td>
									<td align='center'>
									<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' />
									</td>
								</tr>";
				
				$sv++;
			}
			$systemParametersBody = str_replace('<!--%[Input_Tab_Fields_VIEW]%-->',$itfView,$systemParametersBody);
			
			//Input Tab Fields View End
			
			// Procurement Type List Start
			$pProcurementTypeList 					= '';
			$pProcurementTypeListQuery 				= "SELECT ptId, ptName FROM adbs_procurementtype ORDER BY ptId ASC";
			$pProcurementTypeListStatement			= mysql_query($pProcurementTypeListQuery);
			while($pProcurementTypeListStatementData	= mysql_fetch_array($pProcurementTypeListStatement)) {
				$ptId					= $pProcurementTypeListStatementData["ptId"];
				$ptName				= $pProcurementTypeListStatementData["ptName"];
				$pProcurementTypeList 				.= "<option value='".$ptId."'>".$ptName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_PROCUREMENT_TYPE_LIST]%-->',$pProcurementTypeList,$systemParametersBody);
			// Input Tab Head List End
			
			// Input Tab Procurement Method  Start
			$pProcurementMethodList 					= '';
			$pProcurementMethodListQuery 				= "SELECT pmId, pmName FROM adbs_procurementmethod ORDER BY pmId ASC";

			$pProcurementMethodListStatement			= mysql_query($pProcurementMethodListQuery);
			while($pProcurementMethodListStatementData	= mysql_fetch_array($pProcurementMethodListStatement)) {
				$pmId					= $pProcurementMethodListStatementData["pmId"];
				$pmName				= $pProcurementMethodListStatementData["pmName"];
				$pProcurementMethodList 				.= "<option value='".$pmId."'>".$pmName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_PROCUREMENT_MATHOD_LIST]%-->',$pProcurementMethodList,$systemParametersBody);
			// Input Tab Procurement Method End
			
			// Input Bidding Procurement Start
			$pBiddingProcedureList 					= '';
			$pBiddingProcedureListQuery 				= "SELECT bpId, bpName FROM adbs_biddingprocedure ORDER BY bpId ASC";
			$pBiddingProcedureListStatement			= mysql_query($pBiddingProcedureListQuery);
			while($pBiddingProcedureListStatementData	= mysql_fetch_array($pBiddingProcedureListStatement)) {
				$bpId					= $pBiddingProcedureListStatementData["bpId"];
				$bpName				= $pBiddingProcedureListStatementData["bpName"];
				$pBiddingProcedureList				.= "<option value='".$bpId."'>".$bpName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_BIDDING_PROCEDURE_LIST]%-->',$pBiddingProcedureList,$systemParametersBody);
			// Input Bidding Procurement End
			
			
			// Project View Start
			$pView 		= '';
			$pViewQuery 	= "
									SELECT
											pt.ptName,
											pm.pmName,
											bp.bpName,
											p.pName
									FROM
											adbs_package as p,adbs_procurementtype as pt,adbs_procurementmethod as pm,adbs_biddingprocedure as bp
									WHERE p.ptId = pt.ptId AND p.pmId = pm.pmId AND p.bpId = bp.bpId
									ORDER BY
											pName
									ASC
								";
			$sv								= 1;
			$pViewStatement			= mysql_query($pViewQuery);
			while($pViewStatementData	= mysql_fetch_array($pViewStatement)) {
				if($sv%2==0) {
					$class	= "evenRow";
				} else {
					$class	= "oddRow";
				}
				
				$ptName        		= $pViewStatementData["ptName"];
				$pmName      		= $pViewStatementData["pmName"];
				$bpName        		= $pViewStatementData["bpName"];
				$pName     		    = $pViewStatementData["pName"];
				
				$pNameNew				= ''.$pViewStatementData["ptName"].','.$pViewStatementData["pmName"].','.$pViewStatementData["bpName"].'';
				
				$pView .= "<tr valign='top' class='$class'>
									<td >{$sv}</td>
									<td >{$ptName}</td>
									<td >{$pmName}</td>
									<td >{$bpName}</td>
									<td >{$pNameNew}</td>
									<td align='center'>
									<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' />
									</td>
								</tr>";
				
				$sv++;
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_VIEW]%-->',$pView,$systemParametersBody);
			
			//Project View End
			
			
			
			
			//Service for Module Form Start
			$moduleService 						= '';
			$moduleServiceQuery 				= "SELECT DISTINCT SERVICE_ID,SERVICE_NAME FROM s_service_main ORDER BY SERVICE_NAME ASC";
			$moduleServiceStatement				= mysql_query($moduleServiceQuery);
			while($moduleServiceStatementData	= mysql_fetch_array($moduleServiceStatement)) {
				$serviceId						= $moduleServiceStatementData["SERVICE_ID"];
				$serviceName					= $moduleServiceStatementData["SERVICE_NAME"];
				$moduleService 					.= "<option value='".$serviceId."'>".$serviceName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[MODULE_SERVICE]%-->',$moduleService,$systemParametersBody);
			//Service for Module Form End
	
			
			//Service for Sub Module Start
			$systemParametersBody = str_replace('<!--%[SUBMODULE_SERVICE]%-->',$moduleService,$systemParametersBody);
			//Service for Sub Module End
			
			return $systemParametersBody;
		}
		//Dfault Test1  End		
		
		
		  // .......................................................................Dfault Disbursements Stage Start......................................................................
		function disbursementsStageNext2($empId) {
			$systemParametersBody = $this->getTemplateContent('disbursementsStage');
			

			
			return $systemParametersBody;
		}
		//Dfault Bidding Document Preparation Stage End
		
		
		
		// show Bidding Document Preparation Stage start
		function disbursementsStageNext($empId,$packageId,$packageName,$pi_4,$pi_5,$pi_6) {
			
			$systemParametersBody = $this->getTemplateContent('disbursementsStageNext');

			$systemParametersBody = str_replace('<!--%[PI_4]%-->',$pi_4,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[PI_5]%-->',$pi_5,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[PI_6]%-->',$pi_6,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[DISBURSMENT_STAGE_PACKAGEID]%-->',$packageId,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[DISBURSMENT_STAGE_PACKAGENAME]%-->',$packageName,$systemParametersBody);
			
			$ithView 		= '';
			$ithViewQuery 	= "
								SELECT
										adbs_paymentstage_bkdn.pId,
										adbs_paymentstage_bkdn.psbkdn_QuaterNo,
										adbs_paymentstage_bkdn.psbkdn_Year,
										adbs_paymentstage_bkdn.psbkdn_Actual,
										adbs_paymentstage_bkdn.entDate
										
								FROM
										adbs_paymentstage_bkdn
								WHERE
										adbs_paymentstage_bkdn.pId='$packageId'
								ORDER BY
										adbs_paymentstage_bkdn.psbkdn_flag
								";
								
			$sv								= 1;
			$ithView						= '';
			
			
			$originalPrice  = '';
			$originalPriceSql	= "SELECT * FROM adbs_contractingstage WHERE pId='".$packageId."'"; 
			$originalPriceSqlStatement		= mysql_query($originalPriceSql);
			$originalPriceSqlStatementData	= mysql_fetch_array($originalPriceSqlStatement);   
			$originalPrice 					= $originalPriceSqlStatementData["cs_11"]; 
			
			$sqlYear = "Select distinct psbkdn_Year from adbs_paymentstage_bkdn WHERE pId='".$packageId."' order by psbkdn_Year";
			$sqlYearQuery = mysql_query($sqlYear);
			while($sqlYearQueryResult = mysql_fetch_array($sqlYearQuery)){			
				
			$sqlQuater = "Select distinct psbkdn_QuaterNo from adbs_paymentstage_bkdn WHERE pId='".$packageId."' AND psbkdn_Year='".$sqlYearQueryResult['psbkdn_Year']."' order by psbkdn_QuaterNo";
			$sqlQuaterQuery = mysql_query($sqlQuater);
			while($sqlQuaterQueryResult = mysql_fetch_array($sqlQuaterQuery)){
			$sqlAmount = "Select sum(psbkdn_Actual), psbkdn_8 from adbs_paymentstage_bkdn where psbkdn_QuaterNo='".$sqlQuaterQueryResult['psbkdn_QuaterNo']."' AND psbkdn_Year='".$sqlYearQueryResult['psbkdn_Year']."' AND pId='".$packageId."' order by psbkdnId";
			$sqlAmountQuery = mysql_query($sqlAmount);
			$sqlAmountQueryResult = mysql_fetch_array($sqlAmountQuery);
			if($sv%2==0) {
					$class	= "evenRow";
				} else {
					$class	= "oddRow";
				}
			
			$amount 		 = $sqlAmountQueryResult['sum(psbkdn_Actual)'];  
			$psbkdn_8 		 = $sqlAmountQueryResult['psbkdn_8']; 
			$psbkdn_QuaterNo = $sqlQuaterQueryResult["psbkdn_QuaterNo"]; 
			$psbkdn_Year 	 = $sqlYearQueryResult["psbkdn_Year"]; 
			$psbkdn_11       = $originalPrice - $psbkdn_8;
			
			

			$ithView .= "<tr valign='top' class='$class'>
				<td >{$sv}</td>
				<td >{$psbkdn_QuaterNo}</td>
				<td >{$psbkdn_Year}</td>
				<td >".number_format($amount,2)."</td>
				<td >".number_format($psbkdn_11,2)."</td>
			</tr>";
			
			$sv++;
			} 
			}
			$systemParametersBody = str_replace('<!--%[SHOW_DISBURSMENT_TABLE]%-->',$ithView,$systemParametersBody);

			
			return $systemParametersBody;
		}
		
		function disbursementsStageEdit($empId,$packageId,$packageName,$pi_4,$pi_5,$pi_6) {
			
			$systemParametersBody = $this->getTemplateContent('disbursementsStageEdit');

			
			$systemParametersBody = str_replace('<!--%[PI_4]%-->',$pi_4,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[PI_5]%-->',$pi_5,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[PI_6]%-->',$pi_6,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[DISBURSMENT_STAGE_PACKAGEID]%-->',$packageId,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[DISBURSMENT_STAGE_PACKAGENAME]%-->',$packageName,$systemParametersBody);
			
			$sv								= 1;
			$ithView						= '';
			
			
			$originalPrice  = '';
			$originalPriceSql	= "SELECT * FROM adbs_contractingstage WHERE pId='".$packageId."'"; 
			$originalPriceSqlStatement		= mysql_query($originalPriceSql);
			$originalPriceSqlStatementData	= mysql_fetch_array($originalPriceSqlStatement);   
			$originalPrice 					= $originalPriceSqlStatementData["cs_11"]; 
			
			$sqlYear = "Select distinct psbkdn_Year from adbs_paymentstage_bkdn WHERE pId='".$packageId."' order by psbkdn_Year";
			$sqlYearQuery = mysql_query($sqlYear);
			while($sqlYearQueryResult = mysql_fetch_array($sqlYearQuery)){			
				
			$sqlQuater = "Select distinct psbkdn_QuaterNo from adbs_paymentstage_bkdn WHERE pId='".$packageId."' AND psbkdn_Year='".$sqlYearQueryResult['psbkdn_Year']."' order by psbkdn_QuaterNo";
			$sqlQuaterQuery = mysql_query($sqlQuater);
			while($sqlQuaterQueryResult = mysql_fetch_array($sqlQuaterQuery)){
			$sqlAmount = "Select sum(psbkdn_Actual), psbkdn_8 from adbs_paymentstage_bkdn where psbkdn_QuaterNo='".$sqlQuaterQueryResult['psbkdn_QuaterNo']."' AND psbkdn_Year='".$sqlYearQueryResult['psbkdn_Year']."' AND pId='".$packageId."' order by psbkdnId";
			$sqlAmountQuery = mysql_query($sqlAmount);
			$sqlAmountQueryResult = mysql_fetch_array($sqlAmountQuery);
			if($sv%2==0) {
					$class	= "evenRow";
				} else {
					$class	= "oddRow";
				}
			
			$amount 		 = $sqlAmountQueryResult['sum(psbkdn_Actual)'];  
			$psbkdn_8 		 = $sqlAmountQueryResult['psbkdn_8']; 
			$psbkdn_QuaterNo = $sqlQuaterQueryResult["psbkdn_QuaterNo"]; 
			$psbkdn_Year 	 = $sqlYearQueryResult["psbkdn_Year"]; 
			$psbkdn_11       = $originalPrice - $psbkdn_8;
			
			

			$ithView .= "<tr valign='top' class='$class'>
				<td >{$sv}</td>
				<td >{$psbkdn_QuaterNo}</td>
				<td >{$psbkdn_Year}</td>
				<td >".number_format($amount,2)."</td>
				<td >".number_format($psbkdn_11,2)."</td>
			</tr>";
			
			$sv++;
			} 
			}
			$systemParametersBody = str_replace('<!--%[SHOW_DISBURSMENT_TABLE]%-->',$ithView,$systemParametersBody);
			
			
			$sv								= 1;
			$mv								= 1;
			$disbursementsStageEditView		= '';
			
			$psBkdnQuery = "
								SELECT
										adbs_disbursementproject_child.pId,
										adbs_disbursementproject_child.bpc_79h,
										adbs_disbursementproject_child.bpc_79i,
										adbs_disbursementproject_child.bpc_79j,
										adbs_disbursementproject_child.entDate
										
								FROM
										adbs_disbursementproject_child
								WHERE
										adbs_disbursementproject_child.pId='$packageId'
								ORDER BY
										adbs_disbursementproject_child.dpcId				
										
								";
							  
						$psBkdnQueryStatement			= mysql_query($psBkdnQuery);
						$paymentBkdnShow = '';
						while($packageStatementData	= mysql_fetch_array($psBkdnQueryStatement)){
							
						if($mv%2==0) {
							$packageClass="evenRow";
						} else {
							$packageClass="oddRow";
						}

							$bpc_79h        = $packageStatementData["bpc_79h"];
							$bpc_79i        = $packageStatementData["bpc_79i"];
							$bpc_79j        = $packageStatementData["bpc_79j"];
					
							$disbursementsStageEditView .= "<tr class='$packageClass' >
													<td style='padding-left:20px;padding:5px;'>{$sv}</td>
													<td style='padding-left:20px;padding:5px;'>{$bpc_79h}</td>
													<td style='padding-left:20px;padding:5px;'>{$bpc_79i}</td>
													<td style='padding-left:20px;padding:5px;'>".number_format($bpc_79j,2)."</td>
													<td style='padding-left:20px;padding:5px;'><center>
														<form action='disbursementsEditUpdate.php' method='post' target='_blank'>
														    <input type='hidden' name='bpc_79h' value='$bpc_79h'/>
															<input type='hidden' name='bpc_79i' value='$bpc_79i'/>
															<input type='hidden' name='bpc_79j' value='$bpc_79j'/>
															<input type='hidden' name='pi_4' value='$pi_4'/>
															<input type='hidden' name='pi_5' value='$pi_5'/>
															<input type='hidden' name='pi_6' value='$pi_6'/>
															<input type='hidden' name='packageId' value='$packageId'/>
															<input type='hidden' name='packageName' value='$packageName'/>
															<input type='submit' name='editUpdateSubmitDisbursementsStage'  value='Update Info' style='height:25px;'/>
														</form>
													</center></td>
												</tr>						
													";						
						$mv++;
						$sv++;
						}

			
			
			$systemParametersBody = str_replace('<!--%[SHOW_DISBURSMENT_EDIT_TABLE]%-->',$disbursementsStageEditView,$systemParametersBody);
			

			
			return $systemParametersBody;
		}
		
		
		
		
		function disbursementsStageEditUpdate($empId,$packageId,$packageName,$bpc_79h,$bpc_79i,$bpc_79j,$pi_4,$pi_5,$pi_6) {
			
			$systemParametersBody = $this->getTemplateContent('disbursementsStageEditUpdate');
			
			$bpc_79h_Option          = '';
			if($bpc_79h == "Q1"){
         		$bpc_79h_Option    .= "<option value='".$bpc_79h."' selected='selected' >".$bpc_79h."</option>
                                       <option value='Q2'>Q2</option>
                                       <option value='Q3'>Q3</option>
                                       <option value='Q4'>Q4</option>";
        	}elseif($bpc_79h == "Q2"){
       		  $bpc_79h_Option   .= "<option value='".$bpc_79h."' selected='selected' >".$bpc_79h."</option>
                                       <option value='Q1'>Q1</option>
                                       <option value='Q3'>Q3</option>
                                       <option value='Q4'>Q4</option>";
        	}elseif($bpc_79h == "Q3"){
       		  $bpc_79h_Option   .= "<option value='".$bpc_79h."' selected='selected' >".$bpc_79h."</option>
                                    <option value='Q1'>Q1</option>
                                    <option value='Q2'>Q2</option>
                                    <option value='Q4'>Q4</option>";
        	}elseif($bpc_79h == "Q4"){
       		  $bpc_79h_Option   .= "<option value='".$bpc_79h."' selected='selected' >".$bpc_79h."</option>
                                    <option value='Q1'>Q1</option>
                                    <option value='Q2'>Q2</option>
                                    <option value='Q3'>Q3</option>";
        	}

			
			$systemParametersBody = str_replace('<!--%[BPC_79H]%-->',$bpc_79h_Option,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[BPC_79I]%-->',$bpc_79i,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[BPC_79J]%-->',number_format($bpc_79j,2),$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[PI_4]%-->',$pi_4,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[PI_5]%-->',$pi_5,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[PI_6]%-->',$pi_6,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[DISBURSMENT_STAGE_PACKAGEID]%-->',$packageId,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[DISBURSMENT_STAGE_PACKAGENAME]%-->',$packageName,$systemParametersBody);
			
			$sv								= 1;
			$ithView						= '';			
			$sqlYear = "Select distinct psbkdn_Year from adbs_paymentstage_bkdn WHERE pId='".$packageId."' order by psbkdn_Year";
			$sqlYearQuery = mysql_query($sqlYear);
			while($sqlYearQueryResult = mysql_fetch_array($sqlYearQuery)){			
				
			$sqlQuater = "Select distinct psbkdn_QuaterNo from adbs_paymentstage_bkdn WHERE pId='".$packageId."' AND psbkdn_Year='".$sqlYearQueryResult['psbkdn_Year']."' order by psbkdn_QuaterNo";
			$sqlQuaterQuery = mysql_query($sqlQuater);
			while($sqlQuaterQueryResult = mysql_fetch_array($sqlQuaterQuery)){
			$sqlAmount = "Select sum(psbkdn_Actual) from adbs_paymentstage_bkdn where psbkdn_QuaterNo='".$sqlQuaterQueryResult['psbkdn_QuaterNo']."' AND psbkdn_Year='".$sqlYearQueryResult['psbkdn_Year']."' AND pId='".$packageId."'";
			$sqlAmountQuery = mysql_query($sqlAmount);
			$sqlAmountQueryResult = mysql_fetch_array($sqlAmountQuery);
			if($sv%2==0) {
					$class	= "evenRow";
				} else {
					$class	= "oddRow";
				}
			
			$amount 		 = $sqlAmountQueryResult['sum(psbkdn_Actual)']; 
			$psbkdn_QuaterNo = $sqlQuaterQueryResult["psbkdn_QuaterNo"]; 
			$psbkdn_Year 	 = $sqlYearQueryResult["psbkdn_Year"]; 
			
			

			$ithView .= "<tr valign='top' class='$class'>
				<td >{$sv}</td>
				<td >{$psbkdn_QuaterNo}</td>
				<td >{$psbkdn_Year}</td>
				<td >".number_format($amount,2)."</td>
			</tr>";
			
			$sv++;
			} 
			}
			$systemParametersBody = str_replace('<!--%[SHOW_DISBURSMENT_TABLE]%-->',$ithView,$systemParametersBody);

			

			
			return $systemParametersBody;
		}
		
		
		
		
		// show Disbursements Stage end <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<      <<<<<
		
		
		
		
		  // .......................................................................Dfault Payment Stage Start......................................................................
		function paymentStageNext2($empId) {
			$systemParametersBody = $this->getTemplateContent('paymentStage');
			

			
			return $systemParametersBody;
		}
		//Dfault Bidding Document Preparation Stage End
		
		
		
		// show Bidding Document Preparation Stage start
		function paymentStageNext($empId,$packageId,$packageName,$pi_4,$pi_6) {
			
			$systemParametersBody = $this->getTemplateContent('paymentStageNext');
			
			$originalPrice  = '';
			$originalPriceSql	= "SELECT * FROM adbs_contractingstage WHERE pId='".$packageId."'"; 
			$originalPriceSqlStatement		= mysql_query($originalPriceSql);
			$originalPriceSqlStatementData	= mysql_fetch_array($originalPriceSqlStatement);  
			$originalAmount 				= $originalPriceSqlStatementData["cs_11"]; 
			
			if($originalAmount == ''){
			$originalPrice = '0'; 
			}else{
			$originalPrice 					= $originalPriceSqlStatementData["cs_11"];	 
			}
		
			$systemParametersBody = str_replace('<!--%[ORIGINAL_PRIZE_VIEW]%-->',number_format($originalPrice,2),$systemParametersBody);  
			
			
			$advancePProvisionSql	= "SELECT * FROM adbs_contractingstage WHERE pId='".$packageId."' ORDER BY 	pId";
			$advancePProvisionSqlStatement			= mysql_query($advancePProvisionSql);
			$advancePProvisionSqlStatementData		= mysql_fetch_array($advancePProvisionSqlStatement);
			$cs_105Check      			    	    =  $advancePProvisionSqlStatementData["cs_105"]; 
			if($cs_105Check == 'No'){
				$psbkdn_1_2View = "none";
			}else{
				$psbkdn_1_2View = "";	
			}		
			$systemParametersBody = str_replace('<!--%[PSBKDN_1_2]%-->',$psbkdn_1_2View,$systemParametersBody); 
			
			if($cs_105Check == 'Yes'){
				$psbkdn_reguler_View = "none";
			}else{
				$psbkdn_reguler_View = "";	
			}
			$systemParametersBody = str_replace('<!--%[PSBKDN_REGULER]%-->',$psbkdn_reguler_View,$systemParametersBody);
			
			if($cs_105Check == 'No'){
				$psbkdn_javaScript_View = "
				 <script  type='text/javascript'>
							function confirmInputTabFields() {
								var x = document.forms['inputTabForm']['psbkdn_8'].value;
								if (x == null || x == '' || x < 1) {
									alert('Cumulative Total Amount Minimum 1 Must be Filled Out');
									$('#psbkdn_8').focus();
									return false;
								}
								
								var fieldsAmount    = $('#psbkdn_8').val();
								var originalAmount  = $('#contactPrize').val();
								if (originalAmount != 0){	
									if (originalAmount < fieldsAmount){
									alert('Cumulative Total Amount Must be Less Then Original Contact Price!');
									$('#psbkdn_8').focus();
									return false;
									}
								}else{
									alert('Award Stage Fill Up First !');
									$('#psbkdn_8').focus();
									return false;
								}
								
								if(!confirm('Are you sure, you want to proceed?')){
									return false;
								}
								return true;
								}
                            </script>
				
				";
			}else{
				$psbkdn_javaScript_View = "
				         <script  type='text/javascript'>
							function confirmInputTabFields() {
								var x = document.forms['inputTabForm']['psbkdn_2'].value;
								if (x == null || x == '' || x < 1) {
									alert('Contractual Advance Payment Amount Minimum 1 Must be Filled Out');
									$('#psbkdn_2').focus();
									return false;
								}
								if(!confirm('Are you sure, you want to proceed?')){
									return false;
								}
								return true;
								}
                          </script>
					";	
			}
			$systemParametersBody = str_replace('<!--%[PSBKDN_JAVASCRIPT]%-->',$psbkdn_javaScript_View,$systemParametersBody); 	
			
			$psbkdn_error_View  = '';			
			if($cs_105Check == ''){
				$psbkdn_error_View = "<Font color='#FF3333'>Sorry! First Entry Award Stage, After Entry This Stage.</font>";
			}
			$systemParametersBody = str_replace('<!--%[PSBKDN_ERROR]%-->',$psbkdn_error_View,$systemParametersBody);
			$psbkdn_error_hidde = '';
			if($cs_105Check == ''){
				$psbkdn_error_hidde = "none";
			}
			$systemParametersBody = str_replace('<!--%[PSBKDN_ERROR_HIDDE]%-->',$psbkdn_error_hidde,$systemParametersBody);
			
			
			
			$systemParametersBody = str_replace('<!--%[PI_4]%-->',$pi_4,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[PI_6]%-->',$pi_6,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[PAYMENT_PACKAGEID]%-->',$packageId,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[PAYMENT_PACKAGENAME]%-->',$packageName,$systemParametersBody);

			
			return $systemParametersBody;
		}
		// show Bidding Document Preparation Stage end
		
		
		// show Bidding Document Preparation Stage start
		function paymentStageEditNext($empId,$packageId,$packageName,$pi_4,$pi_5,$pi_6) {
			
			$systemParametersBody = $this->getTemplateContent('paymentStageEdit');
			
			$originalPrice  = '';
			$originalPriceSql	= "SELECT * FROM adbs_contractingstage WHERE pId='".$packageId."'"; 
			$originalPriceSqlStatement		= mysql_query($originalPriceSql);
			$originalPriceSqlStatementData	= mysql_fetch_array($originalPriceSqlStatement);  
			$originalAmount 				= $originalPriceSqlStatementData["cs_11"]; 
			
			if($originalAmount == ''){
			$originalPrice = '0'; 
			}else{
			$originalPrice 					= $originalPriceSqlStatementData["cs_11"];	
			}
		
			$systemParametersBody = str_replace('<!--%[ORIGINAL_PRIZE_VIEW]%-->',number_format($originalPrice,2),$systemParametersBody);  
			
			$systemParametersBody = str_replace('<!--%[PI_4]%-->',$pi_4,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[PI_5]%-->',$pi_5,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[PI_6]%-->',$pi_6,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[PAYMENT_PACKAGEID]%-->',$packageId,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[PAYMENT_PACKAGENAME]%-->',$packageName,$systemParametersBody);
			
			
			$maxPsbkdn_79d  = '';
			$psbkdnMaxIdSql	= "SELECT COUNT(*) FROM adbs_paymentstage_bkdn WHERE pId='".$packageId."'"; 
			$psbkdnMaxIdSqllStatement		= mysql_query($psbkdnMaxIdSql);
			$psbkdnMaxIdSqllStatementData	= mysql_fetch_array($psbkdnMaxIdSqllStatement);  
			$maxPsbkdn_79d       			= $psbkdnMaxIdSqllStatementData[0]; 
			$maxPsbkdn_79dResult =  $maxPsbkdn_79d + 1; 
			
			$systemParametersBody = str_replace('<!--%[MAX_PAYMENT_NO]%-->',$maxPsbkdn_79dResult,$systemParametersBody);
			
			
			$advancePProvisionSql	= "SELECT * FROM adbs_contractingstage WHERE pId='".$packageId."' ORDER BY 	pId";
			$advancePProvisionSqlStatement			= mysql_query($advancePProvisionSql);
			$advancePProvisionSqlStatementData		= mysql_fetch_array($advancePProvisionSqlStatement);
			$cs_105Check      			    	    =  $advancePProvisionSqlStatementData["cs_105"];  
			if($cs_105Check == 'No'){
				$psbkdn_1_2View = "none";
			}else{
				$psbkdn_1_2View = "";	
			}		
			$systemParametersBody = str_replace('<!--%[PSBKDN_1_2]%-->',$psbkdn_1_2View,$systemParametersBody); 
			
			if($cs_105Check == 'Yes'){
				$psbkdn_reguler_View = "none";
			}else{
				$psbkdn_reguler_View = "";	
			}
			$systemParametersBody = str_replace('<!--%[PSBKDN_REGULER]%-->',$psbkdn_reguler_View,$systemParametersBody);
						
			$psbkdn_error_View   = '';			
			if($cs_105Check == ''){
				$psbkdn_error_View = "<Font color='#FF3333'>Sorry! First Entry Award Stage, After Entry This Stage.</font>";
			}
			$systemParametersBody = str_replace('<!--%[PSBKDN_ERROR]%-->',$psbkdn_error_View,$systemParametersBody);
			
			$psbkdn_error_hidde = '';
			if($cs_105Check == ''){
				$psbkdn_error_hidde = "none";
			}
			$systemParametersBody = str_replace('<!--%[PSBKDN_ERROR_HIDDE]%-->',$psbkdn_error_hidde,$systemParametersBody);
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			$sv								= 1;
			$ithView						= '';
			
			
			
			
			
	$psbkdn_flag  = '';
	$psbkdnMaxIdSql	= "SELECT COUNT(*) FROM adbs_paymentstage_bkdn WHERE pId='".$packageId."'"; 
	$psbkdnMaxIdSqllStatement		= mysql_query($psbkdnMaxIdSql);
	$psbkdnMaxIdSqllStatementData	= mysql_fetch_array($psbkdnMaxIdSqllStatement);  
	$maxpsbkdn_flag      			= $psbkdnMaxIdSqllStatementData[0]; 
	
	$flagOne = 1;
	$flagOneSql	= "SELECT * FROM adbs_paymentstage_bkdn WHERE pId='".$packageId."' AND psbkdn_flag='".$flagOne."'"; 
	$flagOneSqlStatement		= mysql_query($flagOneSql);
	$flagOneSqlStatementData	= mysql_fetch_array($flagOneSqlStatement);  
	$advancePAmount      		= $flagOneSqlStatementData["psbkdn_2"]; 
	$psbkdn_2a    			    = $flagOneSqlStatementData["psbkdn_2a"];
	$psbkdn_2b   			    = $flagOneSqlStatementData["psbkdn_2b"];
	
	$advancePDate      			= $flagOneSqlStatementData["psbkdn_1"];
	$advancePDate_null = '';
	$advancePDate_date = '';
	if ($advancePDate=='0000-00-00'){
		$advancePDate_null = '';
	}
	else{$advancePDate_date = showDateFormat($flagOneSqlStatementData["psbkdn_1"]);}
	
	$originalPrice  = '';
	$originalPriceSql	= "SELECT * FROM adbs_contractingstage WHERE pId='".$packageId."'"; 
	$originalPriceSqlStatement		= mysql_query($originalPriceSql);
	$originalPriceSqlStatementData	= mysql_fetch_array($originalPriceSqlStatement);  
	$originalPrice 					= $originalPriceSqlStatementData["cs_11"];
	$packageView = '';
	$packageQuery = "
								SELECT
										adbs_paymentstage_bkdn.psId,
										adbs_paymentstage_bkdn.pId,
										adbs_paymentstage_bkdn.psbkdn_1,
										adbs_paymentstage_bkdn.psbkdn_2a,
										adbs_paymentstage_bkdn.psbkdn_2b,
										adbs_paymentstage_bkdn.psbkdn_78b,
										adbs_paymentstage_bkdn.psbkdn_2,
										adbs_paymentstage_bkdn.psbkdn_3,
										adbs_paymentstage_bkdn.psbkdn_4,
										adbs_paymentstage_bkdn.psbkdn_5,
										adbs_paymentstage_bkdn.psbkdn_6,
										adbs_paymentstage_bkdn.psbkdn_7,
										adbs_paymentstage_bkdn.psbkdn_8,
										adbs_paymentstage_bkdn.psbkdn_9,
										adbs_paymentstage_bkdn.psbkdn_10,
										adbs_paymentstage_bkdn.psbkdn_12,
										adbs_paymentstage_bkdn.psbkdn_flag,

										adbs_paymentstage_bkdn.entDate
										
										
								FROM
										adbs_paymentstage_bkdn 
								WHERE adbs_paymentstage_bkdn.pId='$packageId'
								
							  ";
					$packageStatement			= mysql_query($packageQuery);
					while($packageStatementData	= mysql_fetch_array($packageStatement)){	
				if($sv%2==0) {
						$class	= "evenRow";
					} else {
						$class	= "oddRow";
					}	
										
						$psbkdn_1        				= showDateFormat($packageStatementData["psbkdn_1"]);
						$psbkdn_2    			    	= $packageStatementData["psbkdn_2"];
						$psbkdn_3       				= $packageStatementData["psbkdn_3"];
						$psbkdn_78b   			    	= $packageStatementData["psbkdn_78b"];
						
						$psbkdn_4		  				= $packageStatementData["psbkdn_4"];
						$psbkdn_4_null = '';
						$psbkdn_4_date = '';
						if ($psbkdn_4=='0000-00-00'){
							$psbkdn_4_null = '';
						}
						else{$psbkdn_4_date = showDateFormat($packageStatementData["psbkdn_4"]);}
						
						$psbkdn_5		  				= $packageStatementData["psbkdn_5"];
						$psbkdn_5_null = '';
						$psbkdn_5_date = '';
						if ($psbkdn_5=='0000-00-00'){
							$psbkdn_5_null = '';
						}
						else{$psbkdn_5_date = showDateFormat($packageStatementData["psbkdn_5"]);}
						
						
						$psbkdn_7       				= $packageStatementData["psbkdn_7"];
						$psbkdn_8        				= $packageStatementData["psbkdn_8"];
						$psbkdn_9    			    	= $packageStatementData["psbkdn_9"];
						$psbkdn_10       				= $packageStatementData["psbkdn_10"];
						$psbkdn_11       				= $originalPrice - $psbkdn_8;
						$psbkdn_12        				= $packageStatementData["psbkdn_12"];
						$entDateps       				= showDateFormat($packageStatementData["entDate"]);
					
						$psbkdn_6		  				= $packageStatementData["psbkdn_6"];
						$psbkdn_6_null = '';
						$psbkdn_6_date = '';
						if ($psbkdn_6=='0000-00-00'){
							$psbkdn_6_null = '';
						}
						else{$psbkdn_6_date = showDateFormat($packageStatementData["psbkdn_6"]);}
						
						if($psbkdn_6 == '0000-00-00' || $psbkdn_8 == '0'){
								$packageView .= "						
										<tr style='background:#ffffff;'>	
											<td colspan='4' style='text-align:left;background:#ffffff;'>
											<font size='2px'><b>Last Interim Payment Claim(IPC) No: $psbkdn_3 </b> </font>
											</td>			 					
											<td colspan='3' style='text-align:right;background:#ffffff;'>
												<form action='paymentStageUpdate.php' method='post' target='_blank'>
													<input type='hidden' name='psbkdn_3' value='$psbkdn_3'/>
													<input type='hidden' name='pi_4' value='$pi_4'/>
													<input type='hidden' name='pi_5' value='$pi_5'/>
													<input type='hidden' name='pi_6' value='$pi_6'/>
													<input type='hidden' name='packageId' value='$packageId'/>
													<input type='hidden' name='packageName' value='$packageName'/>
													<input type='submit' name='updateSubmitPaymentStage'  value='Update Info'/>
												</form>
											</td>
										</tr>	
													
										<tr style='background:#DDDDDD;'>
											<td>1.</td><td style='text-align:left;width:30%;padding-left:5px;'>Contractual Advance Payment Date (Cheque Date), if any: </td><td style='width: 18%;text-align:left;padding-left:5px;'> $advancePDate_null $advancePDate_date</td><td style='background:#ffffff;'></td>
											<td>2.</td><td style='text-align:left;width:30%;padding-left:5px;'>Contractual Advance Payment Amount(Equiv. US$),if any:</td><td style='width: 18%;text-align:left;padding-left:5px;'>".number_format($advancePAmount,2)."</td>	
										</tr>
										
										<tr style='background:#eeeeee;'>
											<td>3.</td><td style='text-align:left;width:30%;padding-left:5px;'>Advance Payment amount (in contract currency or currencies):</td><td style='width: 18%;text-align:left;padding-left:5px;'> $psbkdn_2a</td><td style=' background:#ffffff;'></td>
											<td>4.</td><td style='text-align:left;width:30%;padding-left:5px;'>Remaining Advance Amount after Adjustment in Last IPC payment(equiv. US$):</td><td style='width: 18%;text-align:left;padding-left:5px;'>$psbkdn_2b</td>
										</tr>
                                        
                                        <tr style='background:#DDDDDD;'>
											<td>5.</td><td style='text-align:left;width:30%;padding-left:5px;'>ADB Financing (percentage):</td><td style='width: 18%;text-align:left;padding-left:5px;'> $psbkdn_78b</td><td style=' background:#ffffff;'></td>
											<td>10.</td><td style='text-align:left;width:30%;padding-left:5px;'>Cumulative Total Amount Certified & Paid up to Last IPC (In contract currency or currencies):</td><td style='width: 18%;text-align:left;padding-left:5px;'>$psbkdn_7</td>
		
										</tr>
										
										<tr style='background:#eeeeee;'>
											<td>6.</td><td style='text-align:left;width:30%;padding-left:5px;'>Last Interim Payment Date (Cheque Date):</td><td style='width: 18%;text-align:left;padding-left:5px;'>$psbkdn_6_null $psbkdn_6_date</td><td style=' background:#ffffff;'></td>
											<td>11.</td><td style='text-align:left;width:30%;padding-left:5px;'>Cumulative Total Amount Certified & Paid up to Last IPC (Equiv. US$):</td><td style='width: 18%;text-align:left;padding-left:5px;'>".number_format($psbkdn_8,2)."</td>
											
										</tr>
										
										<tr style='background:#DDDDDD;'>
											<td>7.</td><td style='text-align:left;width:30%;padding-left:5px;'>Last IPCSubmissionDate:</td><td style='width: 18%;text-align:left;padding-left:5px;'>$psbkdn_4_null $psbkdn_4_date</td><td style=' background:#ffffff;'></td>
											<td>12.</td><td style='text-align:left;width:30%;padding-left:5px;'>Cumulative Total ADB Financing Amount up to last  IPC (Equiv. US$):</td><td style='width: 18%;text-align:left;padding-left:5px;'>$psbkdn_2b</td>
										</tr>
										
										<tr style='background:#eeeeee;'>
											<td>8.</td><td style='text-align:left;width:30%;padding-left:5px;'>Last IPC Certification / AcceptanceDate (by Employer/ Purchaser):</td><td style='width: 18%;text-align:left;padding-left:5px;'>$psbkdn_5_null $psbkdn_5_date</td><td style=' background:#ffffff;'></td>
											<td>13.</td><td style='text-align:left;width:30%;padding-left:5px;'>Cumulative Total Amount (up to Last IPC)Imposed on Employer for Late Payment (Equiv. US$) :</td><td style='width: 18%;text-align:left;padding-left:5px;'>".number_format($psbkdn_9,2)."</td>
										</tr>
										
										<tr style='background:#DDDDDD;'>
											<td>9.</td><td style='text-align:left;width:30%;padding-left:5px;'>Last Interim Payment Claim(IPC) No.:</td><td style='width: 18%;text-align:left;padding-left:5px;'>$psbkdn_3</td><td style=' background:#ffffff;'></td>
											<td>14.</td><td style='text-align:left;width:30%;padding-left:5px;'>Cumulative Total Liquidated Damage(up to Last IPC) imposed on Supplier/ Contractor (Equiv. US$):</td><td style='width: 18%;text-align:left;padding-left:5px;'>".number_format($psbkdn_10,2)."</td>																						
																			
										</tr>
                                        
                                        <tr style='background:#eeeeee;'>
											<td>15.</td><td style='text-align:left;width:30%;padding-left:5px;'>Remaining Contract Amount after Certified Last IPC (equiv. US$):</td><td style='width: 18%;text-align:left;padding-left:5px;'>".number_format($psbkdn_11,2)."</td><td style=' background:#ffffff;'></td>
											<td></td><td style='text-align:left;width:30%;padding-left:5px;'></td><td style='width: 18%;text-align:left;padding-left:5px;'></td>																						
										</tr>
										
										<tr style='background:#ffffff;'>
											<td></td><td style='text-align:left;width:30%;padding-left:5px;'> &nbsp; </td><td style='width: 18%;text-align:left;padding-left:5px;'> &nbsp; </td><td style='background:#ffffff;'></td>
											<td></td><td style='text-align:left;width:30%;padding-left:5px;'> &nbsp; </td><td style='width: 18%;text-align:left;padding-left:5px;'> &nbsp; </td>	
										</tr>										
										";	
						}else{
							$packageView .= "						
										<tr style='background:#ffffff;'>	
											<td colspan='4' style='text-align:left;background:#ffffff;'>
											<font size='2px'><b>Last Interim Payment Claim(IPC) No: $psbkdn_3 </b> </font>
											</td>			 					
											<td colspan='3' style='text-align:right;background:#ffffff;'>
													&nbsp;
											</td>
										</tr>	
													
										<tr style='background:#DDDDDD;'>
											<td>1.</td><td style='text-align:left;width:30%;padding-left:5px;'>Contractual Advance Payment Date (Cheque Date), if any: </td><td style='width: 18%;text-align:left;padding-left:5px;'> $advancePDate_null $advancePDate_date</td><td style='background:#ffffff;'></td>
											<td>2.</td><td style='text-align:left;width:30%;padding-left:5px;'>Contractual Advance Payment Amount(Equiv. US$),if any:</td><td style='width: 18%;text-align:left;padding-left:5px;'>".number_format($advancePAmount,2)."</td>	
										</tr>
										
										<tr style='background:#eeeeee;'>
											<td>3.</td><td style='text-align:left;width:30%;padding-left:5px;'>Advance Payment amount (in contract currency or currencies):</td><td style='width: 18%;text-align:left;padding-left:5px;'> $psbkdn_2a</td><td style=' background:#ffffff;'></td>
											<td>4.</td><td style='text-align:left;width:30%;padding-left:5px;'>Remaining Advance Amount after Adjustment in Last IPC payment(equiv. US$):</td><td style='width: 18%;text-align:left;padding-left:5px;'>$psbkdn_2b</td>
										</tr>
                                        
                                        <tr style='background:#DDDDDD;'>
											<td>5.</td><td style='text-align:left;width:30%;padding-left:5px;'>ADB Financing (percentage):</td><td style='width: 18%;text-align:left;padding-left:5px;'> $psbkdn_78b</td><td style=' background:#ffffff;'></td>
											<td>10.</td><td style='text-align:left;width:30%;padding-left:5px;'>Cumulative Total Amount Certified & Paid up to Last IPC (In contract currency or currencies):</td><td style='width: 18%;text-align:left;padding-left:5px;'>$psbkdn_7</td>
		
										</tr>
										
										<tr style='background:#eeeeee;'>
											<td>6.</td><td style='text-align:left;width:30%;padding-left:5px;'>Last Interim Payment Date (Cheque Date):</td><td style='width: 18%;text-align:left;padding-left:5px;'>$psbkdn_6_null $psbkdn_6_date</td><td style=' background:#ffffff;'></td>
											<td>11.</td><td style='text-align:left;width:30%;padding-left:5px;'>Cumulative Total Amount Certified & Paid up to Last IPC (Equiv. US$):</td><td style='width: 18%;text-align:left;padding-left:5px;'>".number_format($psbkdn_8,2)."</td>
											
										</tr>
										
										<tr style='background:#DDDDDD;'>
											<td>7.</td><td style='text-align:left;width:30%;padding-left:5px;'>Last IPCSubmissionDate:</td><td style='width: 18%;text-align:left;padding-left:5px;'>$psbkdn_4_null $psbkdn_4_date</td><td style=' background:#ffffff;'></td>
											<td>12.</td><td style='text-align:left;width:30%;padding-left:5px;'>Cumulative Total ADB Financing Amount up to last  IPC (Equiv. US$):</td><td style='width: 18%;text-align:left;padding-left:5px;'>$psbkdn_2b</td>
										</tr>
										
										<tr style='background:#eeeeee;'>
											<td>8.</td><td style='text-align:left;width:30%;padding-left:5px;'>Last IPC Certification / AcceptanceDate (by Employer/ Purchaser):</td><td style='width: 18%;text-align:left;padding-left:5px;'>$psbkdn_5_null $psbkdn_5_date</td><td style=' background:#ffffff;'></td>
											<td>13.</td><td style='text-align:left;width:30%;padding-left:5px;'>Cumulative Total Amount (up to Last IPC)Imposed on Employer for Late Payment (Equiv. US$) :</td><td style='width: 18%;text-align:left;padding-left:5px;'>".number_format($psbkdn_9,2)."</td>
										</tr>
										
										<tr style='background:#DDDDDD;'>
											<td>9.</td><td style='text-align:left;width:30%;padding-left:5px;'>Last Interim Payment Claim(IPC) No.:</td><td style='width: 18%;text-align:left;padding-left:5px;'>$psbkdn_3</td><td style=' background:#ffffff;'></td>
											<td>14.</td><td style='text-align:left;width:30%;padding-left:5px;'>Cumulative Total Liquidated Damage(up to Last IPC) imposed on Supplier/ Contractor (Equiv. US$):</td><td style='width: 18%;text-align:left;padding-left:5px;'>".number_format($psbkdn_10,2)."</td>																						
																			
										</tr>
                                        
                                        <tr style='background:#eeeeee;'>
											<td>15.</td><td style='text-align:left;width:30%;padding-left:5px;'>Remaining Contract Amount after Certified Last IPC (equiv. US$):</td><td style='width: 18%;text-align:left;padding-left:5px;'>".number_format($psbkdn_11,2)."</td><td style=' background:#ffffff;'></td>
											<td></td><td style='text-align:left;width:30%;padding-left:5px;'></td><td style='width: 18%;text-align:left;padding-left:5px;'></td>																						
										</tr>
										<tr style='background:#ffffff;'>
											<td></td><td style='text-align:left;width:30%;padding-left:5px;'> &nbsp; </td><td style='width: 18%;text-align:left;padding-left:5px;'> &nbsp; </td><td style='background:#ffffff;'></td>
											<td></td><td style='text-align:left;width:30%;padding-left:5px;'> &nbsp; </td><td style='width: 18%;text-align:left;padding-left:5px;'> &nbsp; </td>	
										</tr>									
										";	
						 
						}
					
						
							
			$sv++;
					}
			$systemParametersBody = str_replace('<!--%[SHOW_PAYMENT_TABLE]%-->',$packageView,$systemParametersBody);
			
			
			return $systemParametersBody;
		}
		
		
		function paymentStageUpdateNext($empId,$packageId,$packageName,$pi_4,$psbkdn_3,$pi_5,$pi_6) {
			
			$systemParametersBody = $this->getTemplateContent('paymentStageUpdate');
			
			
			$psbkdn_flag  = '';
			$psbkdnMaxIdSql	= "SELECT COUNT(*) FROM adbs_paymentstage_bkdn WHERE pId='".$packageId."'"; 
			$psbkdnMaxIdSqllStatement		= mysql_query($psbkdnMaxIdSql);
			$psbkdnMaxIdSqllStatementData	= mysql_fetch_array($psbkdnMaxIdSqllStatement);  
			$maxpsbkdn_flag      			= $psbkdnMaxIdSqllStatementData[0]; 
			
			$flagOne = 1;
			$flagOneSql	= "SELECT * FROM adbs_paymentstage_bkdn WHERE pId='".$packageId."' AND psbkdn_flag='".$flagOne."'"; 
			$flagOneSqlStatement		= mysql_query($flagOneSql);
			$flagOneSqlStatementData	= mysql_fetch_array($flagOneSqlStatement);  
			$advancePDate      			= showDateMySQlFormat($flagOneSqlStatementData["psbkdn_1"]); 
			$advancePAmount      		= $flagOneSqlStatementData["psbkdn_2"];

		$paymentUpdateSql	= "SELECT * FROM adbs_paymentstage_bkdn WHERE pId='".$packageId."' AND psbkdn_3='".$psbkdn_3."' ORDER BY psbkdnId";
			$paymentUpdateSqlStatement	= mysql_query($paymentUpdateSql);
			$paymentUpdateSqlStatementData		= mysql_fetch_array($paymentUpdateSqlStatement);
			
			$psId      			     = $paymentUpdateSqlStatementData["psId"];
			$pId      			     = $paymentUpdateSqlStatementData["pId"];
			$psbkdn_1      			 = showDateMySQlFormat($paymentUpdateSqlStatementData["psbkdn_1"]);
			$psbkdn_2      			 = $paymentUpdateSqlStatementData["psbkdn_2"];
			$psbkdn_3      			 = $paymentUpdateSqlStatementData["psbkdn_3"];
			$psbkdn_4      			 = showDateMySQlFormat($paymentUpdateSqlStatementData["psbkdn_4"]);
			$psbkdn_5      			 = showDateMySQlFormat($paymentUpdateSqlStatementData["psbkdn_5"]);
			$psbkdn_6      			 = showDateMySQlFormat($paymentUpdateSqlStatementData["psbkdn_6"]);
			$psbkdn_7      			 = $paymentUpdateSqlStatementData["psbkdn_7"];
			$psbkdn_8      			 = $paymentUpdateSqlStatementData["psbkdn_8"];
			$psbkdn_9      			 = $paymentUpdateSqlStatementData["psbkdn_9"];
			$psbkdn_10      		 = $paymentUpdateSqlStatementData["psbkdn_10"];
			$psbkdn_12     			 = $paymentUpdateSqlStatementData["psbkdn_12"];
			$psbkdn_flag     		 = $paymentUpdateSqlStatementData["psbkdn_flag"];
			
			
			$systemParametersBody = str_replace('<!--%[PSID]%-->',$psId,$systemParametersBody); 
			$systemParametersBody = str_replace('<!--%[PID]%-->',$pId,$systemParametersBody); 
			$systemParametersBody = str_replace('<!--%[PSKBKDN_1]%-->',$advancePDate,$systemParametersBody); 
			$systemParametersBody = str_replace('<!--%[PSKBKDN_2]%-->',number_format($advancePAmount,2),$systemParametersBody); 
			$systemParametersBody = str_replace('<!--%[PSKBKDN_3]%-->',$psbkdn_3,$systemParametersBody); 
			$systemParametersBody = str_replace('<!--%[PSKBKDN_4]%-->',$psbkdn_4,$systemParametersBody); 
			$systemParametersBody = str_replace('<!--%[PSKBKDN_5]%-->',$psbkdn_5,$systemParametersBody); 
			$systemParametersBody = str_replace('<!--%[PSKBKDN_6]%-->',$psbkdn_6,$systemParametersBody); 
			$systemParametersBody = str_replace('<!--%[PSKBKDN_7]%-->',$psbkdn_7,$systemParametersBody); 
			$systemParametersBody = str_replace('<!--%[PSKBKDN_8]%-->',number_format($psbkdn_8,2),$systemParametersBody); 
			$systemParametersBody = str_replace('<!--%[PSKBKDN_9]%-->',number_format($psbkdn_9,2),$systemParametersBody); 
			$systemParametersBody = str_replace('<!--%[PSKBKDN_10]%-->',number_format($psbkdn_10,2),$systemParametersBody); 
			$systemParametersBody = str_replace('<!--%[PSKBKDN_12]%-->',number_format($psbkdn_12,2),$systemParametersBody); 
			$systemParametersBody = str_replace('<!--%[PSKBKDN_FLAG]%-->',$psbkdn_flag,$systemParametersBody); 
			






			
			$systemParametersBody = str_replace('<!--%[PI_4]%-->',$pi_4,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[PI_5]%-->',$pi_5,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[PI_6]%-->',$pi_6,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[PAYMENT_PACKAGEID]%-->',$packageId,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[PAYMENT_PACKAGENAME]%-->',$packageName,$systemParametersBody);

			
			
			return $systemParametersBody;
		}
		// show Bidding Document Preparation Stage end
		
		
		  // .......................................................................Dfault Objective Purpose Start......................................................................
	  function defoldObjectivePurpose($empId) {
			$systemParametersBody = $this->getTemplateContent('objectivePurpose');
			
			return $systemParametersBody;
		}
		
		// show Objective Purpose End
		
				  // .......................................................................Dfault Others Information Start......................................................................
	  function defoldContactInformation($empId) {
			$systemParametersBody = $this->getTemplateContent('contactInformation');
			
			return $systemParametersBody;
		}
		
		// show Others Information start
		
		
		
	}
?>