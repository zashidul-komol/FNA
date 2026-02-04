<?php
	class procurementEdit Extends BaseClass {
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

		function procurementPlanNext($userId,$packageId) {
			
			$systemParametersBody = $this->getTemplateContent('packageInformationEditNext');
			$pi_4   = '';
			$pi_5   = '';
			$pi_6   = '';
			$pi_7   = '';
			$pi_7a  = '';
			$pi_7b  = '';
			$pi_7c  = '';
			$pi_7d  = '';
			$pi_8   = '';
			$pi_17  = '';
			$pName  = '';

			$piSql	= "SELECT * FROM adbs_package WHERE pId='".$packageId."' ORDER BY pId";
			$piSqlStatement		= mysql_query($piSql);
			$piSqlStatementData	= mysql_fetch_array($piSqlStatement);
			$pId      			= $piSqlStatementData["pId"];
			
			$ptId      			= $piSqlStatementData["ptId"];
			$pmId      			= $piSqlStatementData["pmId"];
			$bpId      			= $piSqlStatementData["bpId"];
			$pName      		= $piSqlStatementData["pName"];
			$agency      	    = $piSqlStatementData["agency"];
			$agencyName      	= $piSqlStatementData["agencyName"];
			$psId      		    = $piSqlStatementData["psId"];
			$adbPackageName     = $piSqlStatementData["adbPackageName"];
			
			$pi_4      			= $piSqlStatementData["pi_4"];
			$pi_5      			= $piSqlStatementData["pi_5"];
			$pi_6      			= $piSqlStatementData["pi_6"];
			$pi_7      			= $piSqlStatementData["pi_7"];
			$pi_7a      		= $piSqlStatementData["pi_7a"];
			$pi_7b      		= $piSqlStatementData["pi_7b"];
			$pi_7c      		= $piSqlStatementData["pi_7c"];
			$pi_7d      		= $piSqlStatementData["pi_7d"];
			$pi_8      			= $piSqlStatementData["pi_8"];
			
			$pi_16      		= $piSqlStatementData["pi_16"];
			$pi_16_Yes          = '';
			if($pi_16 == "ADB"){
         		$pi_16_Yes    .= "<option value='".$pi_16."' selected='selected' >".$pi_16."</option>
								  <option value='GOB' >GOB</option>";
        	}elseif($pi_16 == "GOB"){
       		  $pi_16_Yes   .= "<option value='".$pi_16."' selected='selected' >".$pi_16."</option>
							  <option value='ADB' >ADB</option>";
        	}elseif($pi_16 == ''){
       		  $pi_16_Yes   .= "<option value='ADB' >ADB</option>
							  <option value='GOB' >GOB</option>";
        	}
			
			$pi_17      		= $piSqlStatementData["pi_17"];
			$pi_17_Yes          = '';
			if($pi_17 == "PD, CTIIP"){
         		$pi_17_Yes    .= "<option value='".$pi_17."' selected='selected' >".$pi_17."</option>
							 	  <option value='HOPE'>HOPE</option>
								  <option value='BOD'>BOD</option>
								  <option value='MI'>MI</option>
							 	  <option value='MINS'>MINS</option>
							 	  <option value='CCGP'>CCGP</option>";
        	}elseif($pi_17 == "PD"){
         		$pi_17_Yes    .= "<option value='".$pi_17."' selected='selected' >".$pi_17."</option>
								  <option value='PD, CPIIP'>PD, CTIIP</option>	
							 	  <option value='HOPE'>HOPE</option>
								  <option value='BOD'>BOD</option>
								  <option value='MI'>MI</option>
							 	  <option value='MINS'>MINS</option>
							 	  <option value='CCGP'>CCGP</option>";
        	}elseif($pi_17 == "HOPE"){
       		$pi_17_Yes       .= "<option value='".$pi_17."' selected='selected' >".$pi_17."</option>
								  <option value='PD, CPIIP'>PD, CTIIP</option>	
			  				      <option value='PD'>PD</option>
								  <option value='BOD'>BOD</option>
								  <option value='MI'>MI</option>
							 	  <option value='MINS'>MINS</option>
							 	  <option value='CCGP'>CCGP</option>";
        	}elseif($pi_17 == "BOD"){
       		$pi_17_Yes       .= "<option value='".$pi_17."' selected='selected' >".$pi_17."</option>
			  				      <option value='PD, CPIIP'>PD, CTIIP</option>
								  <option value='PD'>PD</option>
							 	  <option value='HOPE'>HOPE</option>
								  <option value='MI'>MI</option>
							 	  <option value='MINS'>MINS</option>
							 	  <option value='CCGP'>CCGP</option>";
        	}elseif($pi_17 == 'MI'){
       		$pi_17_Yes       .= "<option value='".$pi_17."' selected='selected' >".$pi_17."</option>
			  				      <option value='PD, CPIIP'>PD, CTIIP</option>
								  <option value='PD'>PD</option>
							 	  <option value='HOPE'>HOPE</option>
								  <option value='BOD'>BOD</option>
							 	  <option value='MINS'>MINS</option>
							 	  <option value='CCGP'>CCGP</option>";
        	}elseif($pi_17 == 'MINS'){
       		$pi_17_Yes       .= "<option value='".$pi_17."' selected='selected' >".$pi_17."</option>
			  				      <option value='PD, CPIIP'>PD, CTIIP</option>
								  <option value='PD'>PD</option>
							 	  <option value='HOPE'>HOPE</option>
								  <option value='BOD'>BOD</option>
								  <option value='MI'>MI</option>
							 	  <option value='CCGP'>CCGP</option>";
        	}elseif($pi_17 == 'CCGP'){	
       		  $pi_17_Yes   .= "<option value='PD'>PD</option>
							  <option value='PD, CPIIP'>PD, CTIIP</option>
							  <option value='HOPE' >HOPE</option>
							  <option value='BOD' >BOD</option>
							  <option value='MI' >MI</option>
							  <option value='MINS' >MINS</option>";
        	}elseif($pi_17 == ''){	
       		  $pi_17_Yes   .= "<option value='PD, CPIIP'>PD, CTIIP</option>
			  				  <option value='PD'>PD</option>
							  <option value='HOPE' >HOPE</option>
							  <option value='BOD' >BOD</option>
							  <option value='MI' >MI</option>
							  <option value='MINS' >MINS</option>
							  <option value='CCGP' >CCGP</option>";
        	}
		
			
			$pi_18      		= $piSqlStatementData["pi_18"];
			$pi_18_Yes          = '';
			if($pi_18 == "Yes"){
         		$pi_18_Yes    .= "<option value='".$pi_18."' selected='selected' >".$pi_18."</option>
								  <option value='No' >No</option>";
        	}elseif($pi_18 == "No"){
       		  $pi_18_Yes   .= "<option value='".$pi_18."' selected='selected' >".$pi_18."</option>
							  <option value='Yes' >Yes</option>";
        	}elseif($pi_18 == ''){
       		  $pi_18_Yes   .= "<option value='Yes' >Yes</option>
							  <option value='No' >No</option>";
        	}
		
			
			$pi_19      		= $piSqlStatementData["pi_19"];
			$pi_19_Yes          = '';
			if($pi_19 == "Yes"){
         		$pi_19_Yes    .= "<option value='".$pi_19."' selected='selected' >".$pi_19."</option>
								  <option value='No' >No</option>";
        	}elseif($pi_19 == "No"){
       		  $pi_19_Yes   .= "<option value='".$pi_19."' selected='selected' >".$pi_19."</option>
							  <option value='Yes' >Yes</option>";
        	}elseif($pi_19 == ''){
       		  $pi_19_Yes   .= "<option value='Yes' >Yes</option>
							  <option value='No' >No</option>";
        	}
			
			

			$systemParametersBody = str_replace('<!--%[PACKE_ID]%-->',$pId,$systemParametersBody);
			
			$systemParametersBody = str_replace('<!--%[PT_ID]%-->',$ptId,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[PM_ID]%-->',$pmId,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[BP_ID]%-->',$bpId,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[PACKE_NAME]%-->',$pName,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[AGENCY]%-->',$agency,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[AGENCY_NMAE]%-->',$agencyName,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[PS_ID]%-->',$psId,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[ADB_PACKAGE_NAME]%-->',$adbPackageName,$systemParametersBody);
			
			$systemParametersBody = str_replace('<!--%[PI_4]%-->',$pi_4,$systemParametersBody); 
			$systemParametersBody = str_replace('<!--%[PI_5]%-->',$pi_5,$systemParametersBody); 
			$systemParametersBody = str_replace('<!--%[PI_6]%-->',$pi_6,$systemParametersBody); 
			$systemParametersBody = str_replace('<!--%[PI_7]%-->',$pi_7,$systemParametersBody); 
			$systemParametersBody = str_replace('<!--%[PI_7A]%-->',$pi_7a,$systemParametersBody); 
			$systemParametersBody = str_replace('<!--%[PI_7B]%-->',$pi_7b,$systemParametersBody); 
			$systemParametersBody = str_replace('<!--%[PI_7C]%-->',$pi_7c,$systemParametersBody); 
			$systemParametersBody = str_replace('<!--%[PI_7D]%-->',number_format($pi_7d,2),$systemParametersBody); 
			$systemParametersBody = str_replace('<!--%[PI_8]%-->',number_format($pi_8,2),$systemParametersBody); 
			$systemParametersBody = str_replace('<!--%[PI_16]%-->',$pi_16_Yes,$systemParametersBody); 
			$systemParametersBody = str_replace('<!--%[PI_17]%-->',$pi_17_Yes,$systemParametersBody); 
			$systemParametersBody = str_replace('<!--%[PI_18]%-->',$pi_18_Yes,$systemParametersBody); 
			$systemParametersBody = str_replace('<!--%[PI_19]%-->',$pi_19_Yes,$systemParametersBody); 
			$checkDate = date('Y-m-d');
			$systemParametersBody = str_replace('<!--%[CHECK_DATE]%-->',$checkDate,$systemParametersBody);	

			
			// adbs_procurementtype
			$ptRealName = '';
			$ptRealList = '';
			$ptRealId   = '';
			$ptSql	= "SELECT * FROM adbs_procurementtype ORDER BY ptId";
			$ptSqlStatement		= mysql_query($ptSql);
			while($ptSqlStatementData	= mysql_fetch_array($ptSqlStatement)){
				$ptRealName = $ptSqlStatementData['ptName'];
				$ptRealId   = $ptSqlStatementData['ptId'];
				if($ptRealId == $ptId){
					$ptRealList				.= "<option value='".$ptRealId."' selected='selected'>".$ptRealName."</option>";
				}else{
					$ptRealList				.= "<option value='".$ptRealId."'>".$ptRealName."</option>";
				}
			}
			
			
			$systemParametersBody = str_replace('<!--%[PT_NAME_LIST]%-->',$ptRealList,$systemParametersBody);
			
			// adbs_procurementmethod
			$pmRealName = '';
			$pmRealList	= '';
			$pmRealId   = '';
			$pmSql	= "SELECT * FROM adbs_procurementmethod ORDER BY pmId";
			$pmSqlStatement		= mysql_query($pmSql);
			while($pmSqlStatementData	= mysql_fetch_array($pmSqlStatement)){
			$pmRealName = $pmSqlStatementData['pmName'];
			$pmRealId = $pmSqlStatementData['pmId'];
			if($pmRealId == $pmId){
					$pmRealList				.= "<option value='".$pmRealId."' selected='selected'>".$pmRealName."</option>";
				}else{
					$pmRealList				.= "<option value='".$pmRealId."'>".$pmRealName."</option>";
				}
			}
		
			$systemParametersBody = str_replace('<!--%[PM_NAME_LIST]%-->',$pmRealList,$systemParametersBody);
			
			// adbs_biddingprocedure
			$bpRealName = '';
			$bpRealList	= '';
			$bpRealId   = '';
			$bpSql	= "SELECT * FROM adbs_biddingprocedure ORDER BY bpId";
			$bpSqlStatement		= mysql_query($bpSql);
			while($bpSqlStatementData	= mysql_fetch_array($bpSqlStatement)){
			$bpRealName = $bpSqlStatementData['bpName'];
			$bpRealId = $bpSqlStatementData['bpId'];
			if($bpRealId == $bpId){
					$bpRealList				.= "<option value='".$bpRealId."' selected='selected'>".$bpRealName."</option>";
				}else{
					$bpRealList				.= "<option value='".$bpRealId."'>".$bpRealName."</option>";
				}
			}
		
			
			$systemParametersBody = str_replace('<!--%[BP_NAME_LIST]%-->',$bpRealList,$systemParametersBody);
			
			$agencyList 					= '';
			$agencyListQuery 				= "SELECT aId, aFName FROM adbs_agency ORDER BY aId ASC";
			$agencyListStatement			= mysql_query($agencyListQuery);
			while($agencyListStatementData	= mysql_fetch_array($agencyListStatement)) {
				$aId					= $agencyListStatementData["aId"];
				$aFName					= $agencyListStatementData["aFName"];
				$agencyList				.= "<option value='".$aId."'>".$aFName."</option>";
			}
	
			$systemParametersBody = str_replace('<!--%[PI_AGENCY_LIST]%-->',$agencyList,$systemParametersBody);
	
			
			$adbProjectList 					= '';
			$projectListQuery 				= "SELECT psId, adbProjectName FROM adbs_projectsetup ORDER BY psId ASC";
			$projectListStatement			= mysql_query($projectListQuery);
			while($projectListStatementData	= mysql_fetch_array($projectListStatement)) {
				$adbProjectName				= $projectListStatementData["adbProjectName"];
				$psIdName				= $projectListStatementData["psId"];
				$adbProjectList				.= "<option value='".$psIdName."'>".$adbProjectName."</option>";
			}
	
			$systemParametersBody = str_replace('<!--%[PROJECT_LIST]%-->',$adbProjectList,$systemParametersBody);
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
			
			$systemParametersBody = $this->getTemplateContent('pqStageEditNext');
			
			$pqsId 		= '';
			$pId 		= '';
			$pqs_20 	= '';
			$pqs_21 	= '';
			$pqs_22 	= '';
			$pqs_22a 	= '';
			$pqs_23 	= '';
			$pqs_24 	= '';
			$pqs_25 	= '';
			$pqs_26 	= '';
			$pqs_27		= '';
			$pqs_28		= '';
			$pqs_81     = '';
			$pqs_82     = '';
			$pqs_83     = '';
			$pqs_101    = '';
			$pqs_102    = '';
			$pqs_103    = '';
			
		$pqsSql	= "SELECT * FROM adbs_pqstage WHERE pId='".$packageId."' ORDER BY pqsId";
			$pqsSqlStatement			= mysql_query($pqsSql);
			$pqsSqlStatementData		= mysql_fetch_array($pqsSqlStatement);
			
			$pqsId      			    = $pqsSqlStatementData["pqsId"];
			$pId      			    	= $pqsSqlStatementData["pId"];
			$pqs_20      			    = showDateMySQlFormat($pqsSqlStatementData["pqs_20"]);
			$pqs_21      			    = showDateMySQlFormat ($pqsSqlStatementData["pqs_21"]);
			$pqs_22      			    = showDateMySQlFormat ($pqsSqlStatementData["pqs_22"]);
			$pqs_22a      			    = showDateMySQlFormat ($pqsSqlStatementData["pqs_22a"]);
			$pqs_23      			    = showDateMySQlFormat ($pqsSqlStatementData["pqs_23"]);
			
			$pqs_24      			    = showDateMySQlFormat ($pqsSqlStatementData["pqs_24"]);
			$pqs_25      			    = showDateMySQlFormat ($pqsSqlStatementData["pqs_25"]);
			$pqs_26      			    = showDateMySQlFormat ($pqsSqlStatementData["pqs_26"]);
			
			$pqs_27      			    = showDateMySQlFormat ($pqsSqlStatementData["pqs_27"]);
			$pqs_27a      			    = showDateMySQlFormat ($pqsSqlStatementData["pqs_27a"]);
			$pqs_28      			    = showDateMySQlFormat ($pqsSqlStatementData["pqs_28"]);
			
			$pqs_81      			    = $pqsSqlStatementData["pqs_81"];
			$pqs_82      			    = $pqsSqlStatementData["pqs_82"];
			$pqs_83      			    = $pqsSqlStatementData["pqs_83"];
			$pqs_101      			    = $pqsSqlStatementData["pqs_101"];
			$pqs_102      			    = $pqsSqlStatementData["pqs_102"];
			$pqs_103      			    = $pqsSqlStatementData["pqs_103"];
			
			$pqs_103_Yes          = '';
			if($pqs_103 == "Yes"){
         		$pqs_103_Yes    .= "<option value='".$pqs_103."' selected='selected' >".$pqs_103."</option>
								  <option value='No' >No</option>";
        	}elseif($pqs_103 == "No"){
       		  $pqs_103_Yes   .= "<option value='".$pqs_103."' selected='selected' >".$pqs_103."</option>
							  <option value='Yes' >Yes</option>";
        	}elseif($pqs_103 == ''){
       		  $pqs_103_Yes   .= "<option value='Yes' >Yes</option>
							  <option value='No' >No</option>";
        	}
			
			$pqs_104      			    = $pqsSqlStatementData["pqs_104"];
			
			
			$systemParametersBody = str_replace('<!--%[PQS_20]%-->',$pqs_20,$systemParametersBody); 
			$systemParametersBody = str_replace('<!--%[PQS_21]%-->',$pqs_21,$systemParametersBody); 
			$systemParametersBody = str_replace('<!--%[PQS_22]%-->',$pqs_22,$systemParametersBody); 
			$systemParametersBody = str_replace('<!--%[PQS_22A]%-->',$pqs_22a,$systemParametersBody);  
			$systemParametersBody = str_replace('<!--%[PQS_24]%-->',$pqs_24,$systemParametersBody); 
			$systemParametersBody = str_replace('<!--%[PQS_25]%-->',$pqs_25,$systemParametersBody); 
			$systemParametersBody = str_replace('<!--%[PQS_26]%-->',$pqs_26,$systemParametersBody); 
			$systemParametersBody = str_replace('<!--%[PQS_27]%-->',$pqs_27,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[PQS_27A]%-->',$pqs_27a,$systemParametersBody); 
			$systemParametersBody = str_replace('<!--%[PQS_28]%-->',$pqs_28,$systemParametersBody); 
			$systemParametersBody = str_replace('<!--%[PQS_81]%-->',$pqs_81,$systemParametersBody); 
			$systemParametersBody = str_replace('<!--%[PQS_82]%-->',$pqs_82,$systemParametersBody); 
			$systemParametersBody = str_replace('<!--%[PQS_83]%-->',$pqs_83,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[PQS_102]%-->',$pqs_102,$systemParametersBody); 
			$systemParametersBody = str_replace('<!--%[PQS_103]%-->',$pqs_103_Yes,$systemParametersBody); 
			$systemParametersBody = str_replace('<!--%[PQS_104]%-->',$pqs_104,$systemParametersBody); 
			
			if($pqs_23 == '00-00-0000'){
			$pqs_23_Edit  = " <input type='text' id='pqs_23' name='pqs_23'  class='FormDateTypeInput' value='$pqs_23'  autocomplete='off'> "; 		
			}else{
			$pqs_23_Edit  =" <input type='text' name='pqs_23' id='pqs_23Check' readonly='readonly'  class='FormDateTypeInput' value='$pqs_23'  style='background-color:#EEEEEE;' autocomplete='off'> ";	
			}
			
			$systemParametersBody = str_replace('<!--%[PQS_23]%-->',$pqs_23_Edit,$systemParametersBody);
			
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
		function biddingDPStageEditNext($empId,$packageId,$packageName,$pi_4,$pi_5,$pi_6) {
			
			$systemParametersBody = $this->getTemplateContent('biddingDPStageEditNext');
			$bdpsId		 = '';
			$bdps_29	 = '';
			$bdps_30     = '';
			$bdps_31     = '';
			$bdps_32     = '';
			
		$bdpsSql	= "SELECT * FROM adbs_biddingdocumentpreparationstage WHERE pId='".$packageId."' ORDER BY bdpsId";
			$bdpsSqlStatement			= mysql_query($bdpsSql);
			$bdpsSqlStatementData		= mysql_fetch_array($bdpsSqlStatement);
			
			$bdpsId      			    =  $bdpsSqlStatementData["bdpsId"];
			$bdps_29      			    = showDateMySQlFormat ($bdpsSqlStatementData["bdps_29"]);
			$bdps_30      			    = showDateMySQlFormat ($bdpsSqlStatementData["bdps_30"]);
			$bdps_31      			    = showDateMySQlFormat ($bdpsSqlStatementData["bdps_31"]);
			$bdps_32      			    = showDateMySQlFormat ($bdpsSqlStatementData["bdps_32"]);
			$bdps_89      			    =  $bdpsSqlStatementData["bdps_89"];
			$bdps_90      			    =  $bdpsSqlStatementData["bdps_90"];
			
			
			$systemParametersBody = str_replace('<!--%[BDPS_ID]%-->',$bdpsId,$systemParametersBody); 
			$systemParametersBody = str_replace('<!--%[BDPS_31]%-->',$bdps_31,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[BDPS_30]%-->',$bdps_30,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[BDPS_29]%-->',$bdps_29,$systemParametersBody); 
			$systemParametersBody = str_replace('<!--%[BDPS_32]%-->',$bdps_32,$systemParametersBody); 
			$systemParametersBody = str_replace('<!--%[BDPS_89]%-->',$bdps_89,$systemParametersBody); 
			$systemParametersBody = str_replace('<!--%[BDPS_90]%-->',$bdps_90,$systemParametersBody); 
			
			$checkDate = date('Y-m-d');
			$systemParametersBody = str_replace('<!--%[CHECK_DATE]%-->',$checkDate,$systemParametersBody);
			
			$priorReviewSql	= "SELECT * FROM adbs_package WHERE pId='".$packageId."' ORDER BY 	pId";
			$priorReviewSqlStatement			= mysql_query($priorReviewSql);
			$priorReviewSqlStatementData		= mysql_fetch_array($priorReviewSqlStatement);
			$pi_18Check      			    	=  $priorReviewSqlStatementData["pi_18"]; 
			$bdps_29_30View = '';
			if($pi_18Check == 'No'){
				$bdps_29_30View = "none";
			}else{
				$bdps_29_30View = "";	
			}		
			$systemParametersBody = str_replace('<!--%[BDPS_29_30]%-->',$bdps_29_30View,$systemParametersBody); 
			
			
			if($pi_18Check == 'No'){
				$bdps_89_90View = "none";
			}else{
				$bdps_89_90View = "";	
			}
			$systemParametersBody = str_replace('<!--%[BDPS_89_90]%-->',$bdps_89_90View,$systemParametersBody); 
			
			
			$systemParametersBody = str_replace('<!--%[PI_4]%-->',$pi_4,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[PI_5]%-->',$pi_5,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[PI_6]%-->',$pi_6,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[BIDDING_DP_STAGE_PACKAGEID]%-->',$packageId,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[BIDDING_DP_STAGE_PACKAGENAME]%-->',$packageName,$systemParametersBody);

			
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
		function biddingProposalStageEditNext($empId,$packageId,$packageName,$pi_4,$pi_5,$pi_6) {
			
			$systemParametersBody = $this->getTemplateContent('biddingProposalStageEditNext');
			
			
			
			$pq 					= '';
			$pqSql 					= "SELECT * FROM adbs_package WHERE pId='".$packageId."'";
			$pqSqlStatement			= mysql_query($pqSql);
			$pqSqlStatementData		= mysql_fetch_array($pqSqlStatement);
			
			$pqBidder = "";
			if(strtolower($pqSqlStatementData['pi_19']) == 'no'){
				$pqBidder = 'none';
			}		
			
		    $bpsId 		= '';
			$bps_38 	= '';
			$bps_39 	= '';
			$bps_40 	= '';
			$bps_41 	= '';
			$bps_42 	= '';
			$bps_43 	= '';
			$bps_44 	= '';
			$bps_45 	= '';
			$bps_46		= '';
			$bps_47		= '';
			$bps_48     = '';
			$bps_49     = '';
			$bps_84     = '';
			$bps_90     = '';
			$bps_91     = '';
			$bps_92     = '';
			$bps_101    = '';
			
		$bpsSql	= "SELECT * FROM adbs_biddingproposalstage WHERE pId='".$packageId."' ORDER BY bpsId";
			$bpsSqlStatement			= mysql_query($bpsSql);
			$bpsSqlStatementData		= mysql_fetch_array($bpsSqlStatement);
			
			$bpsId      			    =  $bpsSqlStatementData["bpsId"];
			$bps_38      			    = showDateMySQlFormat ($bpsSqlStatementData["bps_38"]);
			$bps_38a      			    = showDateMySQlFormat ($bpsSqlStatementData["bps_38a"]);
			$bps_39      			    = showDateMySQlFormat ($bpsSqlStatementData["bps_39"]);
			$bps_40      			    = showDateMySQlFormat ($bpsSqlStatementData["bps_40"]);
			$bps_41      			    = showDateMySQlFormat ($bpsSqlStatementData["bps_41"]);
			$bps_42      			    = showDateMySQlFormat ($bpsSqlStatementData["bps_42"]);
			
			$bps_43      			    = showDateMySQlFormat ($bpsSqlStatementData["bps_43"]);
			$bps_44      			    = showDateMySQlFormat ($bpsSqlStatementData["bps_44"]);
			$bps_45      			    = showDateMySQlFormat ($bpsSqlStatementData["bps_45"]);
			
			$bps_46      			    = showDateMySQlFormat ($bpsSqlStatementData["bps_46"]);
			$bps_47      			    = $bpsSqlStatementData["bps_47"];
			
			$bps_48      			    = showDateMySQlFormat ($bpsSqlStatementData["bps_48"]);
			$bps_49      			    = showDateMySQlFormat ($bpsSqlStatementData["bps_49"]);
			$bps_84      			    = $bpsSqlStatementData["bps_84"];
			$bps_90      			    = $bpsSqlStatementData["bps_90"];
			$bps_91      			    = $bpsSqlStatementData["bps_91"];
			$bps_92      			    = $bpsSqlStatementData["bps_92"];
			$bps_102      			    = $bpsSqlStatementData["bps_102"];
			
			
			$checkDate = date('Y-m-d');
			$systemParametersBody = str_replace('<!--%[CHECK_DATE]%-->',$checkDate,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[BPS_ID]%-->',$bpsId,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[BPS_38]%-->',$bps_38,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[BPS_38A]%-->',$bps_38a,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[BPS_39]%-->',$bps_39,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[BPS_40]%-->',$bps_40,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[BPS_41]%-->',$bps_41,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[BPS_42]%-->',$bps_42,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[BPS_43]%-->',$bps_43,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[BPS_44]%-->',$bps_44,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[BPS_45]%-->',$bps_45,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[BPS_46]%-->',$bps_46,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[BPS_47]%-->',$bps_47,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[BPS_49]%-->',$bps_49,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[BPS_84]%-->',$bps_84,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[BPS_90]%-->',$bps_90,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[BPS_91]%-->',$bps_91,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[BPS_92]%-->',$bps_92,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[BPS_102]%-->',$bps_102,$systemParametersBody);
			
			
			if($bps_48 == '00-00-0000'){
			$bps_48_Edit  = " <input type='text' id='bps_48' name='bps_48'  class='FormDateTypeInput' value='$bps_48'  autocomplete='off'> "; 		
			}else{
			$bps_48_Edit  =" <input type='text' name='bps_48' readonly='readonly' style='background-color:#eeeeee;' class='FormDateTypeInput' value='$bps_48'  autocomplete='off'> ";	
			}
			$systemParametersBody = str_replace('<!--%[BPS_48]%-->',$bps_48_Edit,$systemParametersBody);
			
			if($bps_38a != '' && $bps_38a != '00-00-0000'){
			$bps_38a_Edit  = " <input type='text' id='' readonly='readonly' style='background-color:#eeeeee;' name='bps_38a'  class='FormDateTypeInput' value='$bps_38a'  autocomplete='off'/> "; 		
			}else{
			$bps_38a_Edit  ="<input type='text' id='bps_38a' name='bps_38a'  class='FormDateTypeInput' value=''  autocomplete='off'>";
			}
			$systemParametersBody = str_replace('<!--%[BPS_38A_EDIT]%-->',$bps_38a_Edit,$systemParametersBody);
			
			
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
			
			
			$systemParametersBody = str_replace('<!--%[PI_4]%-->',$pi_4,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[PI_5]%-->',$pi_5,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[PI_6]%-->',$pi_6,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[SHOW_HIDE]%-->',$pqBidder,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[BIDDING_PS_PACKAGEID]%-->',$packageId,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[BIDDING_PS_PACKAGENAME]%-->',$packageName,$systemParametersBody);

			
			return $systemParametersBody;
		}
		// show Bidding/Proposal Stage end
		
		
		
		
		
  // .......................................................................Dfault Bid Proposal Evaluation Stage Start......................................................................
	  function bidProposalESNext2($empId) {
			$systemParametersBody = $this->getTemplateContent('bidProposalEvaluationStage');
			
			
			return $systemParametersBody;
		}
		
		// show Bid Proposal Evaluation Stage start
		function biddingEvaluationlStageEditNext($empId,$packageId,$packageName,$pi_4,$pi_5,$pi_6) {
			
			$systemParametersBody = $this->getTemplateContent('biddingEvaluationlStageEditNext');
			
			$bpesId    = '';
			$bpes_50     = '';
			
		$bpesSql	= "SELECT * FROM adbs_bidproposalevaluationstage WHERE pId='".$packageId."' ORDER BY bpesId";
			$bpesSqlStatement			= mysql_query($bpesSql);
			$bpesSqlStatementData		= mysql_fetch_array($bpesSqlStatement);
			
			$bpesId      			    = $bpesSqlStatementData["bpesId"];
			$bpes_50      			    = showDateMySQlFormat ($bpesSqlStatementData["bpes_50"]);
			$bpes_50a      			    = showDateMySQlFormat ($bpesSqlStatementData["bpes_50a"]);
			$bpes_51a      			    = showDateMySQlFormat ($bpesSqlStatementData["bpes_51a"]);
			$bpes_51      			    = $bpesSqlStatementData["bpes_51"];
			$bpes_52      			    = $bpesSqlStatementData["bpes_52"];
			$bpes_53      			    = $bpesSqlStatementData["bpes_53"];
			$bpes_54      			    = $bpesSqlStatementData["bpes_54"];
			$bpes_54a      			    = showDateMySQlFormat ($bpesSqlStatementData["bpes_54a"]);
			$bpes_55      			    = $bpesSqlStatementData["bpes_55"];
			$bpes_56a      			    = $bpesSqlStatementData["bpes_56a"];
			$bpes_56      			    = showDateMySQlFormat ($bpesSqlStatementData["bpes_56"]);
			$bpes_85      			    = $bpesSqlStatementData["bpes_85"];
			$bpes_86      			    = $bpesSqlStatementData["bpes_86"];
			
			$bpes_87      			    = $bpesSqlStatementData["bpes_87"];
			$bpes_87_Yes          = '';
			if($bpes_87 == "Yes"){
         		$bpes_87_Yes    .= "<option value='".$bpes_87."' selected='selected' >".$bpes_87."</option>
								  <option value='No' >No</option>";
        	}elseif($bpes_87 == "No"){
       		  $bpes_87_Yes   .= "<option value='".$bpes_87."' selected='selected' >".$bpes_87."</option>
							  <option value='Yes' >Yes</option>";
        	}elseif($bpes_87 == ''){
       		  $bpes_87_Yes   .= "<option value='Yes' >Yes</option>
							  <option value='No' >No</option>";
        	}
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
			
			
			$bpes_93      			    = $bpesSqlStatementData["bpes_93"];
			$bpes_94      			    = $bpesSqlStatementData["bpes_94"];
			$bpes_95a      			    = $bpesSqlStatementData["bpes_95a"];
			$bpes_97      			    = $bpesSqlStatementData["bpes_97"];
			$bpes_98      			    = $bpesSqlStatementData["bpes_98"];
			
			$bpes_100      			    = $bpesSqlStatementData["bpes_100"];
			$bpes_100_Yes          = '';
			if($bpes_100 == "Yes"){
         		$bpes_100_Yes    .= "<option value='".$bpes_100."' selected='selected' >".$bpes_100."</option>
								  <option value='No' >No</option>";
        	}elseif($bpes_100 == "No"){
       		  $bpes_100_Yes   .= "<option value='".$bpes_100."' selected='selected' >".$bpes_100."</option>
							  <option value='Yes' >Yes</option>";
        	}elseif($bpes_100 == ''){
       		  $bpes_100_Yes   .= "<option value='Yes' >Yes</option>
							  <option value='No' >No</option>";
        	}
			
			$bpes_101      			    = $bpesSqlStatementData["bpes_101"];
			$bpes_102      			    = $bpesSqlStatementData["bpes_102"];
			
			$bpes_103      			    = $bpesSqlStatementData["bpes_103"]; 
			$bpes_103_Yes          		= '';
			if($bpes_103 == "Yes"){
         		$bpes_103_Yes    .= "<option value='".$bpes_103."' selected='selected' >".$bpes_103."</option>
								  <option value='No' >No</option>";
        	}elseif($bpes_103 == "No"){
       		  $bpes_103_Yes   .= "<option value='".$bpes_103."' selected='selected' >".$bpes_103."</option>
							  <option value='Yes' >Yes</option>";
        	}elseif($bpes_103 == ''){
       		  $bpes_103_Yes   .= "<option value='Yes' >Yes</option>
							  <option value='No' >No</option>";
        	}
			
			$bpes_104      			    = $bpesSqlStatementData["bpes_104"];
			
			$bpes_113      			    = $bpesSqlStatementData["bpes_113"];
			$bpes_113_Yes          		= '';
			if($bpes_113 == "Yes"){
         		$bpes_113_Yes    .= "<option value='".$bpes_113."' selected='selected' >".$bpes_113."</option>
								  <option value='No' >No</option>";
        	}elseif($bpes_113 == "No"){
       		  $bpes_113_Yes   .= "<option value='".$bpes_113."' selected='selected' >".$bpes_113."</option>
							  <option value='Yes' >Yes</option>";
        	}elseif($bpes_113 == ''){
       		  $bpes_113_Yes   .= "<option value='Yes' >Yes</option>
							  <option value='No' >No</option>";
        	}
			
			$systemParametersBody = str_replace('<!--%[BPES_ID]%-->',$bpesId,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[BPES_50A]%-->',$bpes_50a,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[BPES_51A]%-->',$bpes_51a,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[BPES_54A]%-->',$bpes_54a,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[BPES_56]%-->',$bpes_56,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[BPES_85]%-->',$bpes_85,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[BPES_86]%-->',$bpes_86,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[BPES_87]%-->',$bpes_87_Yes,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[BPES_93]%-->',$bpes_93,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[BPES_94]%-->',$bpes_94,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[BPES_95A]%-->',$bpes_95a,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[BPES_97]%-->',number_format($bpes_97,2),$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[BPES_98]%-->',number_format($bpes_98,2),$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[BPES_100]%-->',$bpes_100_Yes,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[BPES_102]%-->',$bpes_102,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[BPES_104]%-->',$bpes_104,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[BPES_103]%-->',$bpes_103_Yes,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[BPES_113]%-->',$bpes_113_Yes,$systemParametersBody);
			$checkDate = date('Y-m-d'); 
			$systemParametersBody = str_replace('<!--%[CHECK_DATE]%-->',$checkDate,$systemParametersBody);
			
			
			$bps_48Old          = '';
			$bps_49Old          = '';
			$biddingStageQuery 		= "SELECT * FROM adbs_biddingproposalstage WHERE pId='".$packageId."'"; 
			$biddingStageQueryStatement	= mysql_query($biddingStageQuery); 
			while($biddingStageQueryStatementData	= mysql_fetch_array($biddingStageQueryStatement)){ 
					
			 $bps_48Old        = $biddingStageQueryStatementData["bps_48"];  
			 $bps_49Old        = $biddingStageQueryStatementData["bps_49"];    
			}
			
			$bps_48Cal 					= date("Ymd",strtotime($bps_48Old));
			$bps_49Cal 					= date("Ymd",strtotime($bps_49Old)); 
			$bpes_50Cal 				= date("Ymd",strtotime($bpes_50)); 
			
			if($bps_48Cal > $bps_49Cal){
				if($bps_48Cal == $bpes_50Cal){
					$bpes_50_Red = "<input type='text' id='bpes_50' name='bpes_50' class='FormDateTypeInput' value='$bpes_50' style='color:#000000;' autocomplete='off'>";	
				}else{
					$bpes_50_Red = "<input type='text' id='bpes_50' name='bpes_50' class='FormDateTypeInput' value='$bpes_50' style='color:#F03;'  autocomplete='off'>";	
				}	
			}else{
				if($bps_49Cal == $bpes_50Cal){
					$bpes_50_Red = "<input type='text' id='bpes_50' name='bpes_50' class='FormDateTypeInput' style='color:#000000;' value='$bpes_50' autocomplete='off'>";	
				}else{
					$bpes_50_Red = "<input type='text' id='bpes_50' name='bpes_50' class='FormDateTypeInput' value='$bpes_50' style='color:#F03;'  autocomplete='off'>";	
				}		
			}

			$systemParametersBody = str_replace('<!--%[BPES_50]%-->',$bpes_50_Red,$systemParametersBody);
		
			if($bpes_56a == '0'){
			$bpes_56a_Edit  = "<input type='text' id='bpes_56a' onkeyup='removeChar(this);' name='bpes_56a' autocomplete='off' value='$bpes_56a' class='FormTextTypeInput' />"; 		
			}else{
			$bpes_56a_Edit  ="<input type='text' id='bpes_56a' onkeyup='removeChar(this);' readonly='readonly' style='background-color:#eeeeee;' name='bpes_56a' autocomplete='off' value='$bpes_56a' class='FormTextTypeInput' />";	
			}
			$systemParametersBody = str_replace('<!--%[BPES_56A]%-->',$bpes_56a_Edit,$systemParametersBody);
			
			if($bpes_54a != ''  && $bpes_54a != '00-00-0000'){
			$bpes_54a_Edit  = "<input type='text' id='' name='bpes_54a' readonly='readonly' style='background-color:#eeeeee;' class='FormDateTypeInput' value='$bpes_54a'  autocomplete='off'>"; 		
			}else{
			$bpes_54a_Edit  ="<input type='text' id='bps_38a' name='bps_38a'  class='FormDateTypeInput' value='' autocomplete='off'>";
			}
			$systemParametersBody = str_replace('<!--%[BPES_54A_EDIT]%-->',$bpes_54a_Edit,$systemParametersBody);
			
			$checkDate = date('Y-m-d');  
			$systemParametersBody = str_replace('<!--%[CHECK_DATE]%-->',$checkDate,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[PI_4]%-->',$pi_4,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[PI_5]%-->',$pi_5,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[PI_6]%-->',$pi_6,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[BID_PES_PACKAGEID]%-->',$packageId,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[BID_PES_PACKAGENAME]%-->',$packageName,$systemParametersBody);

			
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
		function evaluationRAStageEditNext($empId,$packageId,$packageName,$pi_4,$pi_5,$pi_6) {
			
			$systemParametersBody = $this->getTemplateContent('evaluationRAStageEditNext');
			
		$erasSql	= "SELECT * FROM adbs_evaluationreportapprovalstage WHERE pId='".$packageId."' ORDER BY erasId";
			$erasSqlStatement			= mysql_query($erasSql);
			$erasSqlStatementData		= mysql_fetch_array($erasSqlStatement);
			
			$erasId      			    = $erasSqlStatementData["erasId"];
			$eras_60a     			    = showDateMySQlFormat ($erasSqlStatementData["eras_60a"]);
			$eras_61     			    = showDateMySQlFormat ($erasSqlStatementData["eras_61"]);
			$eras_62     			    = showDateMySQlFormat ($erasSqlStatementData["eras_62"]);
			$eras_62a     			    = showDateMySQlFormat ($erasSqlStatementData["eras_62a"]);
			$eras_62b     			    = showDateMySQlFormat ($erasSqlStatementData["eras_62b"]);
			$eras_63    			    = showDateMySQlFormat ($erasSqlStatementData["eras_63"]);
			$eras_95     			    = $erasSqlStatementData["eras_95"];
			$eras_96     			    = $erasSqlStatementData["eras_96"];
			
			$eras_99     			    = $erasSqlStatementData["eras_99"];
			$eras_99_Yes          = '';
			if($eras_99 == "Yes"){
         		$eras_99_Yes    .= "<option value='".$eras_99."' selected='selected' >".$eras_99."</option>
								  <option value='No' >No</option>";
        	}elseif($eras_99 == "No"){
       		  $eras_99_Yes   .= "<option value='".$eras_99."' selected='selected' >".$eras_99."</option>
							  <option value='Yes' >Yes</option>";
        	}elseif($eras_99 == ''){
       		  $eras_99_Yes   .= "<option value='Yes' >Yes</option>
							  <option value='No' >No</option>";
        	}
			
			$eras_101     			    = $erasSqlStatementData["eras_101"];
			$eras_104     			    = $erasSqlStatementData["eras_104"];
			
 		    $systemParametersBody = str_replace('<!--%[ERAS_ID]%-->',$erasId,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[ERAS_60A]%-->',$eras_60a,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[ERAS_61]%-->',$eras_61,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[ERAS_62]%-->',$eras_62,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[ERAS_62A]%-->',$eras_62a,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[ERAS_63]%-->',$eras_63,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[ERAS_95]%-->',$eras_95,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[ERAS_96]%-->',$eras_96,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[ERAS_99]%-->',$eras_99_Yes,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[ERAS_101]%-->',$eras_101,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[ERAS_62B]%-->',$eras_62b,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[ERAS_104]%-->',$eras_104,$systemParametersBody);
			
			
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
			
			if($eras_60a != '' && $eras_60a != '00-00-0000'){
			$eras_60a_Edit  = "<input type='text' id='' name='eras_60a' readonly='readonly' style='background-color:#eeeeee;' class='FormDateTypeInput' value='$eras_60a'  autocomplete='off'>"; 		
			}else{
			$eras_60a_Edit  ="<input type='text' id='eras_60a' name='eras_60a'  class='FormDateTypeInput' value='' autocomplete='off'>";
			}
			$systemParametersBody = str_replace('<!--%[ERAS_60A_EDIT]%-->',$eras_60a_Edit,$systemParametersBody);
			
			if($eras_62a != '' && $eras_62a != '00-00-0000'){
			$eras_62a_Edit  = "<input type='text' id='' name='eras_62a' readonly='readonly' style='background-color:#eeeeee;' class='FormDateTypeInput' value='$eras_62a'  autocomplete='off'>"; 		
			}else{
			$eras_62a_Edit  ="<input type='text' id='eras_62a' name='eras_62a'  class='FormDateTypeInput' value='' autocomplete='off'>";
			}
			$systemParametersBody = str_replace('<!--%[ERAS_62A_EDIT]%-->',$eras_62a_Edit,$systemParametersBody);
			
			
			$checkDate = date('Y-m-d');
			$systemParametersBody = str_replace('<!--%[CHECK_DATE]%-->',$checkDate,$systemParametersBody);
			
			$systemParametersBody = str_replace('<!--%[PI_4]%-->',$pi_4,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[PI_5]%-->',$pi_5,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[PI_6]%-->',$pi_6,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[EVALUATION_RAS_PACKAGEID]%-->',$packageId,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[EVALUATION_RAS_PACKAGENAME]%-->',$packageName,$systemParametersBody);

			
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
		function contractingStageEditNext($empId,$packageId,$packageName,$pi_4,$pi_5,$pi_6) {
			
			$systemParametersBody = $this->getTemplateContent('contractingStageEditNext');

		$csSql	= "SELECT * FROM adbs_contractingstage WHERE pId='".$packageId."' ORDER BY csId";
			$csSqlStatement			= mysql_query($csSql);
			$csSqlStatementData		= mysql_fetch_array($csSqlStatement);
			
			$csId      			    = $csSqlStatementData["csId"];
			$cs_63a     			= showDateMySQlFormat ($csSqlStatementData["cs_63a"]);
			$cs_64     			    = showDateMySQlFormat ($csSqlStatementData["cs_64"]);
			$cs_65     			    = showDateMySQlFormat ($csSqlStatementData["cs_65"]);
			$cs_66     			    = showDateMySQlFormat ($csSqlStatementData["cs_66"]);
			$cs_67    			    = showDateMySQlFormat ($csSqlStatementData["cs_67"]);
			$cs_67aEdit    			= showDateMySQlFormat ($csSqlStatementData["cs_67a"]);
			$cs_67a     			= $csSqlStatementData["cs_67a"];
			$cs_67aFShow     		= showDateMySQlFormat ($csSqlStatementData["cs_67a"]);
			$cs_68     			    = showDateMySQlFormat ($csSqlStatementData["cs_68"]);
			$cs_69     			    = showDateMySQlFormat ($csSqlStatementData["cs_69"]);
			$cs_70     			    = showDateMySQlFormat ($csSqlStatementData["cs_70"]);
			$cs_9     			    = $csSqlStatementData["cs_9"];
			$cs_11     			    = $csSqlStatementData["cs_11"];
			$cs_72     			    = showDateMySQlFormat ($csSqlStatementData["cs_72"]); 
			$cs_72a     			= $csSqlStatementData["cs_72a"];
			
			$cs_104     			= $csSqlStatementData["cs_104"];
			$cs_104_Yes          = '';
			if($cs_104 == "Yes"){
         		$cs_104_Yes    .= "<option value='".$cs_104."' selected='selected' >".$cs_104."</option>
								  <option value='No' >No</option>";
        	}elseif($cs_104 == "No"){
       		  $cs_104_Yes   .= "<option value='".$cs_104."' selected='selected' >".$cs_104."</option>
							  <option value='Yes' >Yes</option>";
        	}elseif($cs_104 == ''){
       		  $cs_104_Yes   .= "<option value='Yes' >Yes</option>
							  <option value='No' >No</option>";
        	}
			
			$cs_105     			= $csSqlStatementData["cs_105"];
			$cs_105_Yes          = '';
			if($cs_105 == "Yes"){
         		$cs_105_Yes    .= "<option value='".$cs_105."' selected='selected' >".$cs_105."</option>
								  <option value='No' >No</option>";
        	}elseif($cs_105 == "No"){
       		  $cs_105_Yes   .= "<option value='".$cs_105."' selected='selected' >".$cs_105."</option>
							  <option value='Yes' >Yes</option>";
        	}elseif($cs_105 == ''){
       		  $cs_105_Yes   .= "<option value='Yes' >Yes</option>
							  <option value='No' >No</option>";
        	}
			
			$cs_106     			= $csSqlStatementData["cs_106"];
			$cs_106_Yes          = '';
			if($cs_106 == "Yes"){
         		$cs_106_Yes    .= "<option value='".$cs_106."' selected='selected' >".$cs_106."</option>
								  <option value='No' >No</option>";
        	}elseif($cs_106 == "No"){
       		  $cs_106_Yes   .= "<option value='".$cs_106."' selected='selected' >".$cs_106."</option>
							  <option value='Yes' >Yes</option>";
        	}elseif($cs_106 == ''){
       		  $cs_106_Yes   .= "<option value='Yes' >Yes</option>
							  <option value='No' >No</option>";
        	}
			
			$cs_113     			= $csSqlStatementData["cs_113"];
			$cs_114a     			= $csSqlStatementData["cs_114a"];
						
			
			$systemParametersBody = str_replace('<!--%[CS_ID]%-->',$csId,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[CS_63A]%-->',$cs_63a,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[CS_64]%-->',$cs_64,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[CS_65]%-->',$cs_65,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[CS_66]%-->',$cs_66,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[CS_67]%-->',$cs_67,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[CS_67A]%-->',$cs_67aFShow,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[CS_68]%-->',$cs_68,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[CS_69]%-->',$cs_69,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[CS_70]%-->',$cs_70,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[CS_9]%-->',$cs_9,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[CS_11]%-->',number_format($cs_11,2),$systemParametersBody);
		
			$systemParametersBody = str_replace('<!--%[CS_104]%-->',$cs_104_Yes,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[CS_105]%-->',$cs_105_Yes,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[CS_106]%-->',$cs_106_Yes,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[CS_113]%-->',$cs_113,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[CS_72A]%-->',$cs_72a,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[CS_114A]%-->',$cs_114a,$systemParametersBody);
			
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

			//<!--/*$cs_72Result	=  ("$cs_67a", strtotime("+$cs_72a days"));*/-->

			$date = "$cs_67a"; 
			$date = strtotime($date);
			$date = strtotime("+$cs_72a day", $date);
			$cs_72Result =  date('d-m-Y', $date); 
			
			$cs_72Calculate = '';		
			if($cs_72 != '' &&  $cs_72 != '01-01-1970'){
				$cs_72Calculate = "<input type='text' id='' name='cs_72'  readonly='readonly' style='background-color:#eeeeee;'  class='FormDateTypeInput' value='$cs_72Result'  autocomplete='off'>";
			}else{
				$cs_72Calculate = "<input type='text' id='cs_72' name='cs_72' class='FormDateTypeInput' value='$cs_72Result'  autocomplete='off'>";	
			}
			$systemParametersBody = str_replace('<!--%[CS_72]%-->',$cs_72Calculate,$systemParametersBody);
			
			if($cs_67aEdit != '' && $cs_67aEdit != '00-00-0000'){
			$cs_67aEdit  = " <input type='text' id='' readonly='readonly' style='background-color:#eeeeee;' name='cs_67a'  class='FormDateTypeInput' value='$cs_67aEdit'  autocomplete='off'/> "; 		
			}else{
			$cs_67aEdit  ="<input type='text' id='cs_67a' name='cs_67a'  class='FormDateTypeInput' value=''  autocomplete='off'>";
			}
			$systemParametersBody = str_replace('<!--%[CS_67A_EDIT]%-->',$cs_67aEdit,$systemParametersBody);
			
			
			
			$checkDate = date('Y-m-d');
			$systemParametersBody = str_replace('<!--%[CHECK_DATE]%-->',$checkDate,$systemParametersBody);	
			$systemParametersBody = str_replace('<!--%[PI_4]%-->',$pi_4,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[PI_5]%-->',$pi_5,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[PI_6]%-->',$pi_6,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[CONTRACTING_STAGE_PACKAGEID]%-->',$packageId,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[CONTRACTING_STAGE_PACKAGENAME]%-->',$packageName,$systemParametersBody);

			
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
		function contractingManagementStageEditNext($empId,$packageId,$packageName,$pi_4,$pi_5,$pi_6) {
			
			$systemParametersBody = $this->getTemplateContent('contractingManagementStageEditNext');
			
			$cmsSql	= "SELECT * FROM adbs_contractmanagementstage WHERE pId='".$packageId."' ORDER BY cmsId";
			$cmsSqlStatement			    = mysql_query($cmsSql);
			$cmsSqlStatementData		    = mysql_fetch_array($cmsSqlStatement);
			
			$cmsId      			        = $cmsSqlStatementData["cmsId"];
			$cms_71      			        = showDateMySQlFormat ($cmsSqlStatementData["cms_71"]);
			$cms_72a      			        = showDateMySQlFormat ($cmsSqlStatementData["cms_72a"]);
			$cms_73      			        = showDateMySQlFormat ($cmsSqlStatementData["cms_73"]);
			$cms_74      			        = showDateMySQlFormat ($cmsSqlStatementData["cms_74"]);
			$cms_75      			        = showDateMySQlFormat ($cmsSqlStatementData["cms_75"]);
			$cms_75a      			        = showDateMySQlFormat ($cmsSqlStatementData["cms_75a"]);
			$cms_107      			        = $cmsSqlStatementData["cms_107"];
			$cms_108      			        = $cmsSqlStatementData["cms_108"];
			$cms_109      			        = $cmsSqlStatementData["cms_109"];
			$cms_10      			        = $cmsSqlStatementData["cms_10"];
			$cms_12      			        = $cmsSqlStatementData["cms_12"];
			
			$systemParametersBody = str_replace('<!--%[CMS_ID]%-->',$cmsId,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[CMS_71]%-->',$cms_71,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[CMS_72A]%-->',$cms_72a,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[CMS_73]%-->',$cms_73,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[CMS_74]%-->',$cms_74,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[CMS_75]%-->',$cms_75,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[CMS_75A]%-->',$cms_75a,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[CMS_107]%-->',$cms_107,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[CMS_108]%-->',$cms_108,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[CMS_109]%-->',number_format($cms_109,2),$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[CMS_10]%-->',$cms_10,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[CMS_12]%-->',number_format($cms_12,2),$systemParametersBody);
			

			$checkDate = date('Y-m-d');
			$systemParametersBody = str_replace('<!--%[CHECK_DATE]%-->',$checkDate,$systemParametersBody);	
			$systemParametersBody = str_replace('<!--%[PI_4]%-->',$pi_4,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[PI_5]%-->',$pi_5,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[PI_6]%-->',$pi_6,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[CONTRACT_M_STAGE_PACKAGEID]%-->',$packageId,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[CONTRACT_M_STAGE_PACKAGENAME]%-->',$packageName,$systemParametersBody);

			
			return $systemParametersBody;
		}
		// show Bid Proposal Evaluation Stage end
		
		//Dfault Contract Management Stage End
	// .......................................................................Dfault Payment Stage Start......................................................................	
		// show Bidding Document Preparation Stage start
		function paymentStageEditNext($empId,$packageId,$packageName,$pi_4,$pi_5,$pi_6) {
			
			$systemParametersBody = $this->getTemplateContent('paymentStageEditNext');
			$bdpsId		 = '';
			$bdps_29	 = '';
			$bdps_30     = '';
			$bdps_31     = '';
			$bdps_32     = '';
			
			$bdpsSql	= "SELECT * FROM adbs_paymentstage_bkdn WHERE pId='".$packageId."' ORDER BY psbkdnId";
			$bdpsSqlStatement			= mysql_query($bdpsSql);
			$bdpsSqlStatementData		= mysql_fetch_array($bdpsSqlStatement);
			
			$psbkdn_79aId      			=  $bdpsSqlStatementData["psId"];
			$psbkdn_79a      			= showDateMySQlFormat ($bdpsSqlStatementData["psbkdn_79a"]);
			$psbkdn_79b      			= showDateMySQlFormat ($bdpsSqlStatementData["psbkdn_79b"]);
			$psbkdn_79c      			=  $bdpsSqlStatementData["psbkdn_79c"];
			$psbkdn_79d      			=  $bdpsSqlStatementData["psbkdn_79d"];
			
			
			$systemParametersBody = str_replace('<!--%[PSBKDN_ID]%-->',$psbkdn_79aId,$systemParametersBody); 
			$systemParametersBody = str_replace('<!--%[PSBKDN_79A]%-->',$psbkdn_79a,$systemParametersBody); 
			$systemParametersBody = str_replace('<!--%[PSBKDN_79B]%-->',$psbkdn_79b,$systemParametersBody); 
			$systemParametersBody = str_replace('<!--%[PSBKDN_79C]%-->',$psbkdn_79c,$systemParametersBody); 
			$systemParametersBody = str_replace('<!--%[PSBKDN_79D]%-->',$psbkdn_79d,$systemParametersBody); 
			
			$checkDate = date('Y-m-d');
			$systemParametersBody = str_replace('<!--%[CHECK_DATE]%-->',$checkDate,$systemParametersBody);
			
			$systemParametersBody = str_replace('<!--%[PI_4]%-->',$pi_4,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[PI_5]%-->',$pi_5,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[PI_6]%-->',$pi_6,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[PAYMENT_PACKAGEID]%-->',$packageId,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[PAYMENT_PACKAGENAME]%-->',$packageName,$systemParametersBody);

			
			return $systemParametersBody;
		}
		// show Payment Stage end
		
		
		
  // .......................................................................Dfault Contract Concluding Stage  Start......................................................................
	  function contractConcludingStageNext2($empId) {
			$systemParametersBody = $this->getTemplateContent('contractConcludingStage');
			
			return $systemParametersBody;
		}
		
		 // show Contract Concluding Stage start
		function contractConcludingStageEditNext($empId,$packageId,$packageName,$pi_4,$pi_5,$pi_6) {
			
			$systemParametersBody = $this->getTemplateContent('contractConcludingStageEditNext');
			
		$ccsSql	= "SELECT * FROM adbs_contractconcludingstage WHERE pId='".$packageId."' ORDER BY ccsId";
			$ccsSqlStatement			    = mysql_query($ccsSql);
			$ccsSqlStatementData		    = mysql_fetch_array($ccsSqlStatement);
			
			$ccsId      			        = $ccsSqlStatementData["ccsId"];
			$ccs_76      			        = showDateMySQlFormat ($ccsSqlStatementData["ccs_76"]);
			$ccs_77      			        = showDateMySQlFormat ($ccsSqlStatementData["ccs_77"]);
			$ccs_78      			        = $ccsSqlStatementData["ccs_78"];
			$ccs_79      			        = $ccsSqlStatementData["ccs_79"];
			$ccs_80      			        = $ccsSqlStatementData["ccs_80"];
			$ccs_110      			        = $ccsSqlStatementData["ccs_110"];
			$ccs_111      			        = $ccsSqlStatementData["ccs_111"];
			
			$systemParametersBody = str_replace('<!--%[CCS_ID]%-->',$ccsId,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[CCS_76]%-->',$ccs_76,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[CCS_77]%-->',$ccs_77,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[CCS_78]%-->',number_format($ccs_78,2),$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[CCS_79]%-->',number_format($ccs_79,2),$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[CCS_80]%-->',number_format($ccs_80,2),$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[CCS_110]%-->',$ccs_110,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[CCS_111]%-->',$ccs_111,$systemParametersBody);
			$checkDate = date('Y-m-d');
			$systemParametersBody = str_replace('<!--%[CHECK_DATE]%-->',$checkDate,$systemParametersBody);
			
			$systemParametersBody = str_replace('<!--%[PI_4]%-->',$pi_4,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[PI_5]%-->',$pi_5,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[PI_6]%-->',$pi_6,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[CONTRACT_CONCLUDING_STAGE_PACKAGEID]%-->',$packageId,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[CONTRACT_CONCLUDING_STAGE_PACKAGENAME]%-->',$packageName,$systemParametersBody);

			
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
		function othersInformationEditNext($empId,$packageId,$packageName,$pi_4,$pi_5,$pi_6) {
			
			$systemParametersBody = $this->getTemplateContent('othersInformationEditNext');


		$oiSql	= "SELECT * FROM adbs_othersinformation WHERE pId='".$packageId."' ORDER BY oiId";
			$oiSqlStatement			= mysql_query($oiSql);
			$oiSqlStatementData		= mysql_fetch_array($oiSqlStatement);
			
			$oiId      			    = $oiSqlStatementData["oiId"];
			$oi_114      			= $oiSqlStatementData["oi_114"];
			$oi_111      			= $oiSqlStatementData["oi_111"];
			$oi_112      			= $oiSqlStatementData["oi_112"];
			$oi_119      			= $oiSqlStatementData["oi_119"];
			
			$oi_118     		    = $oiSqlStatementData["oi_118"];
			$oi_118_Yes          = '';
			if($oi_118 == "Yes"){
         		$oi_118_Yes    .= "<option value='".$oi_118."' selected='selected' >".$oi_118."</option>
								  <option value='No' >No</option>";
        	}elseif($oi_118 == "No"){
       		  $oi_118_Yes   .= "<option value='".$oi_118."' selected='selected' >".$oi_118."</option>
							  <option value='Yes' >Yes</option>";
        	}elseif($oi_118 == ''){
       		  $oi_118_Yes   .= "<option value='Yes' >Yes</option>
							  <option value='No' >No</option>";
        	}
			
			$oi_119     		    = $oiSqlStatementData["oi_119"];
			$oi_119_Yes          = '';
			if($oi_119 == "Yes"){
         		$oi_119_Yes    .= "<option value='".$oi_119."' selected='selected' >".$oi_119."</option>
								  <option value='No' >No</option>";
        	}elseif($oi_119 == "No"){
       		  $oi_119_Yes   .= "<option value='".$oi_119."' selected='selected' >".$oi_119."</option>
							  <option value='Yes' >Yes</option>";
        	}elseif($oi_119 == ''){
       		  $oi_119_Yes   .= "<option value='Yes' >Yes</option>
							  <option value='No' >No</option>";
        	}
			
			
			$systemParametersBody = str_replace('<!--%[OI_ID]%-->',$oiId,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[OI_114]%-->',$oi_114,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[OI_111]%-->',$oi_111,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[OI_112]%-->',$oi_112,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[OI_118]%-->',$oi_118_Yes,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[OI_119]%-->',$oi_119_Yes,$systemParametersBody);
			
			$systemParametersBody = str_replace('<!--%[PI_4]%-->',$pi_4,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[PI_5]%-->',$pi_5,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[PI_6]%-->',$pi_6,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[OTHERS_INFORMATION_PACKAGEID]%-->',$packageId,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[OTHERS_INFORMATION_PACKAGENAME]%-->',$packageName,$systemParametersBody);

			
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
				
		
  // .......................................................................Dfault Test2 Start......................................................................
	  function getDfoltcreateNewPacakge($empId) {
			$systemParametersBody = $this->getTemplateContent('createNewPacakge');
			
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
		
		
		
		
		
		
		
	}
?>