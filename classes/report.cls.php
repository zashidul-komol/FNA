<?php
	class report Extends BaseClass {
		function report() {
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
			
	  // ....................................................................... Package_1 Report  Start..........................................................
	  
	  //Report Daily Income Expanse Start 
		function getReptFnaDailyIncome($empId) {
		$systemParametersBody = $this->getTemplateContent('reptFnaDailyIncome');
			
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project where STATUS = 'Active' ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End		
			
			return $systemParametersBody;
		}
	  //Report Daily Income Expanse  End
	
	 //Report Income Expanse Report Start 
		function getReptFnaIncomeExpanse($empId) {
		$systemParametersBody = $this->getTemplateContent('reptFnaIncomeExpanse');
			
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project where STATUS = 'Active' ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End		
			
			return $systemParametersBody;
		}
	  //Report Income Expanse Report  End
	
	  // Receve Number Report Start
	  function getReptReceiveNumber($empId) {
			$systemParametersBody = $this->getTemplateContent('reptReceiveNumber');
			
						
			//Project View Start
			$pTList 					= '';
			$pTQuery 				= "SELECT plu.RECEIVENUMBER, plu.RECEIVENUMBER FROM fna_productloadunload plu  where plu.RECEIVENUMBER != '' ORDER BY plu.RECEIVENUMBER DESC";
			$pTQueryStatement			= mysql_query($pTQuery);
			while($pTQueryStatementData	= mysql_fetch_array($pTQueryStatement)) {
				$pTId					= $pTQueryStatementData["RECEIVENUMBER"];
				$pTName				= $pTQueryStatementData["RECEIVENUMBER"];
				$pTList				.= "<option value='".$pTId."'>".$pTName."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[RECEIVED_NUMBER_LIST]%-->',$pTList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
				
			return $systemParametersBody;
		}
	  //Receive Number Report End
	  
	 // Gate Pass Number Report Start	
	 function getReptGatePassNumber($empId) {
			$systemParametersBody = $this->getTemplateContent('reptGatepass');
			
						
			//Project View Start
			$pTList 					= '';
			$pTQuery 				= "SELECT plu.DELIVERYCHALLANNUMBER, plu.DELIVERYCHALLANNUMBER FROM fna_productloadunload plu  where plu.DELIVERYCHALLANNUMBER != '' ORDER BY plu.DELIVERYCHALLANNUMBER ASC";
			$pTQueryStatement			= mysql_query($pTQuery);
			while($pTQueryStatementData	= mysql_fetch_array($pTQueryStatement)) {
				$pTId					= $pTQueryStatementData["DELIVERYCHALLANNUMBER"];
				$pTName				= $pTQueryStatementData["DELIVERYCHALLANNUMBER"];
				$pTList				.= "<option value='".$pTId."'>".$pTName."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[GATEPASS_NUMBER_LIST]%-->',$pTList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}	
	 // Gate Pass Number Report End
	 	
	//Report Pran Receive Product Information Start
	function getReptPranReceive($empId) {
			$systemParametersBody = $this->getTemplateContent('reptFnaPranReceive');
			
						
			
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project where STATUS = 'Active' ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End	
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//PaRTY	 View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report Pran Receive Product Information Start
	
	//Report Pran Delivery Product Information Start
	function getReptPranDelivery($empId) {
			$systemParametersBody = $this->getTemplateContent('reptFnaPranDelivery');
			
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project where STATUS = 'Active' ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End	
						
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report Pran Delivery Product Information Start
	
	//Report Pran FNA Bill Information Start 
	function getReptFnaBill($empId) {
			$systemParametersBody = $this->getTemplateContent('reptFnaBill');
			
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project where STATUS = 'Active' ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End			
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report Pran FNA Bill Information Start
	
	//Report Pran FNA Bill Information Start 
	function getReptLoadUnload($empId) {
			$systemParametersBody = $this->getTemplateContent('reptLoadUnload');
			
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project where STATUS = 'Active' ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End			
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report Pran FNA Bill Information Start
	
	//Report Pran FNA Bill Information Start 
	function getReptPocket($empId) {
			$systemParametersBody = $this->getTemplateContent('reptPocketLoad');
			
			//Chamber From Start
			$chamberFromVal							= '';
			$chamberFromQuery 						= "SELECT CHID, CHNAME FROM fna_chamber ORDER BY CHNAME ASC";
			$chamberFromQueryStatement				= mysql_query($chamberFromQuery);
			while($chamberFromQueryStatementData	= mysql_fetch_array($chamberFromQueryStatement)) {
				$chamberId							= $chamberFromQueryStatementData["CHID"];
				$chamberName						= $chamberFromQueryStatementData["CHNAME"];
				$chamberFromVal 					.= "<option value='".$chamberId."'>".$chamberName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[CHAMBER_FROM]%-->',$chamberFromVal,$systemParametersBody);
			//Chamber From End
			
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project where STATUS = 'Active' ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End			
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report Pran FNA Bill Information Start
	
	//Report Pran FNA Bill Information Start 
	function getReptPocketRemainingQnty($empId) {
			$systemParametersBody = $this->getTemplateContent('reptPocketRemainingQnty');
			
			//Chamber From Start
			$chamberFromVal							= '';
			$chamberFromQuery 						= "SELECT CHID, CHNAME FROM fna_chamber ORDER BY CHID ASC";
			$chamberFromQueryStatement				= mysql_query($chamberFromQuery);
			while($chamberFromQueryStatementData	= mysql_fetch_array($chamberFromQueryStatement)) {
				$chamberId							= $chamberFromQueryStatementData["CHID"];
				$chamberName						= $chamberFromQueryStatementData["CHNAME"];
				$chamberFromVal 					.= "<option value='".$chamberId."'>".$chamberName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[CHAMBER_FROM]%-->',$chamberFromVal,$systemParametersBody);
			//Chamber From End
			
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project where STATUS = 'Active' ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End			
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report Pran FNA Bill Information Start
	
	//Report Pran FNA Bill Information Start 
	function getReptTransferHistry($empId) {
			$systemParametersBody = $this->getTemplateContent('reptTransferHistry');
			
			//Chamber From Start
			$chamberFromVal							= '';
			$chamberFromQuery 						= "SELECT CHID, CHNAME FROM fna_chamber ORDER BY CHNAME ASC";
			$chamberFromQueryStatement				= mysql_query($chamberFromQuery);
			while($chamberFromQueryStatementData	= mysql_fetch_array($chamberFromQueryStatement)) {
				$chamberId							= $chamberFromQueryStatementData["CHID"];
				$chamberName						= $chamberFromQueryStatementData["CHNAME"];
				$chamberFromVal 					.= "<option value='".$chamberId."'>".$chamberName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[CHAMBER_FROM]%-->',$chamberFromVal,$systemParametersBody);
			//Chamber From End
			
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project where STATUS = 'Active' ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End			
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report Pran FNA Bill Information Start
	
	//Report Pran FNA Bill Information Start 
	function getReptPalotHistry($empId) {
			$systemParametersBody = $this->getTemplateContent('reptPalotHistry');
			
			//Chamber From Start
			$chamberFromVal							= '';
			$chamberFromQuery 						= "SELECT CHID, CHNAME FROM fna_chamber ORDER BY CHNAME ASC";
			$chamberFromQueryStatement				= mysql_query($chamberFromQuery);
			while($chamberFromQueryStatementData	= mysql_fetch_array($chamberFromQueryStatement)) {
				$chamberId							= $chamberFromQueryStatementData["CHID"];
				$chamberName						= $chamberFromQueryStatementData["CHNAME"];
				$chamberFromVal 					.= "<option value='".$chamberId."'>".$chamberName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[CHAMBER_FROM]%-->',$chamberFromVal,$systemParametersBody);
			//Chamber From End
			
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project where STATUS = 'Active' ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End			
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report Pran FNA Bill Information Start
	
	//Report Pran FNA Bill Information Start 
	function getReptCategoryWiseBalance($empId) {
			$systemParametersBody = $this->getTemplateContent('reptCategoryWiseBalance');
			
			//Chamber From Start
			$chamberFromVal							= '';
			$chamberFromQuery 						= "SELECT CHID, CHNAME FROM fna_chamber ORDER BY CHNAME ASC";
			$chamberFromQueryStatement				= mysql_query($chamberFromQuery);
			while($chamberFromQueryStatementData	= mysql_fetch_array($chamberFromQueryStatement)) {
				$chamberId							= $chamberFromQueryStatementData["CHID"];
				$chamberName						= $chamberFromQueryStatementData["CHNAME"];
				$chamberFromVal 					.= "<option value='".$chamberId."'>".$chamberName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[CHAMBER_FROM]%-->',$chamberFromVal,$systemParametersBody);
			//Chamber From End
			
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project where STATUS = 'Active' ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End			
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report Pran FNA Bill Information Start
	
	//Report Pran FNA Bill Information Start 
	function getReptPocketLoad($empId) {
			$systemParametersBody = $this->getTemplateContent('reptPocketLoad');
			
			//Chamber From Start
			$chamberFromVal							= '';
			$chamberFromQuery 						= "SELECT CHID, CHNAME FROM fna_chamber ORDER BY CHNAME ASC";
			$chamberFromQueryStatement				= mysql_query($chamberFromQuery);
			while($chamberFromQueryStatementData	= mysql_fetch_array($chamberFromQueryStatement)) {
				$chamberId							= $chamberFromQueryStatementData["CHID"];
				$chamberName						= $chamberFromQueryStatementData["CHNAME"];
				$chamberFromVal 					.= "<option value='".$chamberId."'>".$chamberName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[CHAMBER_FROM]%-->',$chamberFromVal,$systemParametersBody);
			//Chamber From End
			
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project where STATUS = 'Active' ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End			
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report Pran FNA Bill Information Start
	
	//Report Pran FNA Bill Information Start 
	function getReptChamberBalance($empId) {
			$systemParametersBody = $this->getTemplateContent('reptChamberBalance');
			
			//Chamber From Start
			$chamberFromVal							= '';
			$chamberFromQuery 						= "SELECT CHID, CHNAME FROM fna_chamber ORDER BY CHNAME ASC";
			$chamberFromQueryStatement				= mysql_query($chamberFromQuery);
			while($chamberFromQueryStatementData	= mysql_fetch_array($chamberFromQueryStatement)) {
				$chamberId							= $chamberFromQueryStatementData["CHID"];
				$chamberName						= $chamberFromQueryStatementData["CHNAME"];
				$chamberFromVal 					.= "<option value='".$chamberId."'>".$chamberName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[CHAMBER_FROM]%-->',$chamberFromVal,$systemParametersBody);
			//Chamber From End
			
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project where STATUS = 'Active' ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End			
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report Pran FNA Bill Information Start
	
	//Report Pran FNA Bill Information Start 
	function getReptProductWiseChamberBalance($empId) {
			$systemParametersBody = $this->getTemplateContent('reptProductWiseChamberBalance');
			
			//Chamber From Start
			$chamberFromVal							= '';
			$chamberFromQuery 						= "SELECT CHID, CHNAME FROM fna_chamber ORDER BY CHNAME ASC";
			$chamberFromQueryStatement				= mysql_query($chamberFromQuery);
			while($chamberFromQueryStatementData	= mysql_fetch_array($chamberFromQueryStatement)) {
				$chamberId							= $chamberFromQueryStatementData["CHID"];
				$chamberName						= $chamberFromQueryStatementData["CHNAME"];
				$chamberFromVal 					.= "<option value='".$chamberId."'>".$chamberName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[CHAMBER_FROM]%-->',$chamberFromVal,$systemParametersBody);
			//Chamber From End
			
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project where STATUS = 'Active' ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End			
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report Pran FNA Bill Information Start
	
	//Report Pran FNA Bill Information Start 
	function getReptFloorWiseBalance($empId) {
			$systemParametersBody = $this->getTemplateContent('reptFloorWiseBalance');
			
			//Chamber From Start
			$chamberFromVal							= '';
			$chamberFromQuery 						= "SELECT CHID, CHNAME FROM fna_chamber ORDER BY CHNAME ASC";
			$chamberFromQueryStatement				= mysql_query($chamberFromQuery);
			while($chamberFromQueryStatementData	= mysql_fetch_array($chamberFromQueryStatement)) {
				$chamberId							= $chamberFromQueryStatementData["CHID"];
				$chamberName						= $chamberFromQueryStatementData["CHNAME"];
				$chamberFromVal 					.= "<option value='".$chamberId."'>".$chamberName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[CHAMBER_FROM]%-->',$chamberFromVal,$systemParametersBody);
			//Chamber From End
			
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project where STATUS = 'Active' ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End			
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report Pran FNA Bill Information Start
	
	//Report Pran FNA Bill Information Start 
	function getReptFloorBalance($empId) {
			$systemParametersBody = $this->getTemplateContent('reptFloorBalance');
			
			//Chamber From Start
			$chamberFromVal							= '';
			$chamberFromQuery 						= "SELECT CHID, CHNAME FROM fna_chamber ORDER BY CHNAME ASC";
			$chamberFromQueryStatement				= mysql_query($chamberFromQuery);
			while($chamberFromQueryStatementData	= mysql_fetch_array($chamberFromQueryStatement)) {
				$chamberId							= $chamberFromQueryStatementData["CHID"];
				$chamberName						= $chamberFromQueryStatementData["CHNAME"];
				$chamberFromVal 					.= "<option value='".$chamberId."'>".$chamberName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[CHAMBER_FROM]%-->',$chamberFromVal,$systemParametersBody);
			//Chamber From End
			
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project where STATUS = 'Active' ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End			
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report Pran FNA Bill Information Start
	
	//Report FNA Customer Ledger Information Start 
	function getReptFnaCustomerLedger($empId) {
			$systemParametersBody = $this->getTemplateContent('reptCustomerLedger');
			
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project where STATUS = 'Active' ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End			
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report Customer Ledger Information Start
	
	//Report FNA Customer Ledger Information Start 
	function getReptFnaCustomerLedgerAll($empId) {
			$systemParametersBody = $this->getTemplateContent('reptCustomerLedgerAll');
			
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project where STATUS = 'Active' ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End			
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report Customer Ledger Information Start
	
	//Report FNA Payment Receive Information Start 
	function getReptFnaPaymentRec($empId) {
			$systemParametersBody = $this->getTemplateContent('reptFnaPaymentRec');
			
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project where STATUS = 'Active' ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End			
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report FNA Payment Receive Information End
	
	//Report FNA Party Statement  Start 
	function getReptFnaPartyStatement($empId) {
			$systemParametersBody = $this->getTemplateContent('reptFnaPartyStatement');
			
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project where STATUS = 'Active' ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End			
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report FNA Party Statement End
	
	//Report FNA Party Statement  Start 
	function getReptFnaLoanDetails($empId) {
			$systemParametersBody = $this->getTemplateContent('reptFnaLoanDetails');
			
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project where STATUS = 'Active' ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End			
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report FNA Party Statement End
	
	//Report FNA Party Statement  Start 
	function getReptFnaBastaLoanSummary($empId) {
			$systemParametersBody = $this->getTemplateContent('reptAluBastaLoanSummary');
			
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project where STATUS = 'Active' ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End			
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report FNA Party Statement End
	
	//Report FNA Party Statement  Start 
	function getReptFnaLoanSummary($empId) {
			$systemParametersBody = $this->getTemplateContent('reptFnaLoanSummary');
			
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project where STATUS = 'Active' ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End			
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report FNA Party Statement End
	
	//Report FNA Party Statement  Start 
	function getReptAluDOReport($empId) {
			$systemParametersBody = $this->getTemplateContent('reptFnaAluDOReport');
			
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project where STATUS = 'Active' ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End			
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report FNA Party Statement End
	
	//Report FNA Party Statement  Start 
	function getReptAluSummaryDOReport($empId) {
			$systemParametersBody = $this->getTemplateContent('reptAluSummaryDOReport');
			
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End			
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report FNA Party Statement End
	
	//Report FNA Alu Fare Start 
	function getReptProductFare($empId) {
			$systemParametersBody = $this->getTemplateContent('reptProductFare');
			
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project where STATUS = 'Active' ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End			
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report FNA Alu Fare End
	
	//Report FNA Party Statement  Start 
	function getReptFnaPartyAll($empId) {
			$systemParametersBody = $this->getTemplateContent('reptFnaPartyAll');
			
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project where STATUS = 'Active' ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End			
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report FNA Party Statement End
	
	//Report FNA Party Details  Start 
	function getReptFnaPartyDetails($empId) {
			$systemParametersBody = $this->getTemplateContent('reptFnaPartyDetails');
			
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project where STATUS = 'Active' ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End			
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report FNA Party Details End
	
	//Report Pran FNA Bill Sub Project wise Information Start 
	function getReptFnaBillSubProj($empId) {
			$systemParametersBody = $this->getTemplateContent('reptFnaBillSubProj');
			
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project where STATUS = 'Active' ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End			
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report Pran FNA Bill Sub Project wise Information Start
	
	//Report Pran FNA Labour Bill Information Start
	function getReptLabourBill($empId) {
			$systemParametersBody = $this->getTemplateContent('reptLabourBill');
			
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project where STATUS = 'Active' ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End


			
						
			//Project View Start
			$lNameList 					= '';
			$lNameQuery 				= "SELECT LABOURID, LABOURNAME FROM fna_labour ORDER BY LABOURNAME ASC";
			$lNameQueryStatement		= mysql_query($lNameQuery);
			while($lNameQueryStatementData	= mysql_fetch_array($lNameQueryStatement)) {
				$LABOURID					= $lNameQueryStatementData["LABOURID"];
				$LABOURNAME					= $lNameQueryStatementData["LABOURNAME"];
				$lNameList					.= "<option value='".$LABOURID."'>".$LABOURNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[LABOUR_NAME]%-->',$lNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report Pran FNA Labour Bill Information Start
	
	//Report Pran FNA Labour Bill Information Start
	function getReptLabourBillSummary($empId) {
			$systemParametersBody = $this->getTemplateContent('reptLabourBillSummary');
			
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project where STATUS = 'Active' ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End


			
						
			//Project View Start
			$lNameList 					= '';
			$lNameQuery 				= "SELECT LABOURID, LABOURNAME FROM fna_labour ORDER BY LABOURNAME ASC";
			$lNameQueryStatement		= mysql_query($lNameQuery);
			while($lNameQueryStatementData	= mysql_fetch_array($lNameQueryStatement)) {
				$LABOURID					= $lNameQueryStatementData["LABOURID"];
				$LABOURNAME					= $lNameQueryStatementData["LABOURNAME"];
				$lNameList					.= "<option value='".$LABOURID."'>".$LABOURNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[LABOUR_NAME]%-->',$lNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report Pran FNA Labour Bill Information Start
	
	//Report Pran FNA Labour Bill Information Start
	function getReptLabourBillLabourWise($empId) {
			$systemParametersBody = $this->getTemplateContent('reptLabourBillLabourWise');
			
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project where STATUS = 'Active' ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End


			
						
			//Project View Start
			$lNameList 					= '';
			$lNameQuery 				= "SELECT LABOURID, LABOURNAME FROM fna_labour ORDER BY LABOURNAME ASC";
			$lNameQueryStatement		= mysql_query($lNameQuery);
			while($lNameQueryStatementData	= mysql_fetch_array($lNameQueryStatement)) {
				$LABOURID					= $lNameQueryStatementData["LABOURID"];
				$LABOURNAME					= $lNameQueryStatementData["LABOURNAME"];
				$lNameList					.= "<option value='".$LABOURID."'>".$LABOURNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[LABOUR_NAME]%-->',$lNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report Pran FNA Labour Bill Information Start
	
	//Report Pran FNA Labour Contact Information Start
	function getReptLabourContact($empId) {
			$systemParametersBody = $this->getTemplateContent('reptLabourContact');
			
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project where STATUS = 'Active' ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End


			
						
			//Project View Start
			$lNameList 					= '';
			$lNameQuery 				= "SELECT LABOURID, LABOURNAME FROM fna_labour ORDER BY LABOURNAME ASC";
			$lNameQueryStatement		= mysql_query($lNameQuery);
			while($lNameQueryStatementData	= mysql_fetch_array($lNameQueryStatement)) {
				$LABOURID					= $lNameQueryStatementData["LABOURID"];
				$LABOURNAME					= $lNameQueryStatementData["LABOURNAME"];
				$lNameList					.= "<option value='".$LABOURID."'>".$LABOURNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[LABOUR_NAME]%-->',$lNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report Pran FNA Labour Contact Information Start
	
	//Report Pran FNA Labour Bill Date Wise Information Start
	function getReptLabourBillDateWise($empId) {
			$systemParametersBody = $this->getTemplateContent('ReptLabourBillDateRange');
			
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project where STATUS = 'Active' ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End


			
						
			//Project View Start
			$lNameList 					= '';
			$lNameQuery 				= "SELECT LABOURID, LABOURNAME FROM fna_labour ORDER BY LABOURNAME ASC";
			$lNameQueryStatement		= mysql_query($lNameQuery);
			while($lNameQueryStatementData	= mysql_fetch_array($lNameQueryStatement)) {
				$LABOURID					= $lNameQueryStatementData["LABOURID"];
				$LABOURNAME					= $lNameQueryStatementData["LABOURNAME"];
				$lNameList					.= "<option value='".$LABOURID."'>".$LABOURNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[LABOUR_NAME]%-->',$lNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report Pran FNA Labour Bill Date Wise Information Start
	
	//Report Pran FNA Party Stock Information Start 
	function getReptFnaPartyStock($empId) {
			$systemParametersBody = $this->getTemplateContent('reptFnaPartyStock');
			
						
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project where STATUS = 'Active' ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End
			
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report Pran FNA Party Stock Information Start
	
	//Report Pran FNA Party Stock Information Start 
	function getReptFnaPartyStockDateWise($empId) {
			$systemParametersBody = $this->getTemplateContent('reptFnaPartyStockDateWise');
			
						
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project where STATUS = 'Active' ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End
			
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report Pran FNA Party Stock Information Start
	
	//Report Pran FNA Party Stock Information Start 
	function getReptFnaPartyStockDateWisePC($empId) {
			$systemParametersBody = $this->getTemplateContent('reptFnaPartyStockDateWisePC');
			
						
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project where STATUS = 'Active' ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End
			
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report Pran FNA Party Stock Information Start
	
	//Report FNA Aluy Party Stock Information Start 
	function getReptFnaAluPartyStock($empId) {
			$systemParametersBody = $this->getTemplateContent('reptFnaAluPartyStock');
			
						
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project where STATUS = 'Active' ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End
			
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report FNA Alu Party Stock Information Start
	
	//Report Alu Customer Ledger Information Start 
	function getreptFnaCustLedger($empId) {
			$systemParametersBody = $this->getTemplateContent('reptFnaCustLedger');
			
						
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project where STATUS = 'Active' ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End
			
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report Alu Customer Ledger Information Start
	
	//Report Profit or Loss Report Start
	function getReptProfitLoss($empId) {
			$systemParametersBody = $this->getTemplateContent('ReptProfitLoss');
			
						
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project where STATUS = 'Active' ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End
			
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report Profit or Loss Report End
	
	//Report Feed Profit or Loss Report Start
	function getReptFeedProfitLoss($empId) {
			$systemParametersBody = $this->getTemplateContent('ReptFeedProfitLoss');
			
						
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End
			
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report Feed Profit or Loss Report End
	
	//Report Feed Balance Sheet Report Start
	function getReptFeedBalanceSheet($empId) {
			$systemParametersBody = $this->getTemplateContent('ReptFeedBalanceSheet');
			
						
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End
			
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report Feed Balance Sheet Report End
	
	//Report Poultry Profit or Loss Report Start
	function getReptPoultryProfitLoss($empId) {
			$systemParametersBody = $this->getTemplateContent('ReptPoultryProfitLoss');
			
						
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End
			
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report Poultry Profit or Loss Report End
	
	//Report Poultry Batch Wise Balance Sheet Report Start 
	function getReptPalBatchwiseBalance($empId) {
			$systemParametersBody = $this->getTemplateContent('ReptPalBatchwiseBalance');
			
						
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End
			
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			//Batch Select start
			
			$BatchVal 							= '';
			$BatchQuery 						= "SELECT DISTINCT BATCHNO FROM pal_batchopen ORDER BY BATCHNO DESC";
			$BatchQueryStatement				= mysql_query($BatchQuery);
			while($BatchQueryStatementData		= mysql_fetch_array($BatchQueryStatement)) {
				$BATCHNO						= $BatchQueryStatementData["BATCHNO"];
				$BatchVal 						.= "<option value='".$BATCHNO."'>".$BATCHNO."</option>";
			}
			$systemParametersBody = str_replace('<!--%[BATCH_NO]%-->',$BatchVal,$systemParametersBody);
			
			//Batch Select End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report Poultry Batch Wise Balance Sheet Report End
	
	//Report Poultry Batch Wise Statement Report Start 
	function getReptPalBatchwiseStatement($empId) {
			$systemParametersBody = $this->getTemplateContent('ReptPalBatchWiseStatement');
			
						
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End
			
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			//Batch Select start
			
			$BatchVal 							= '';
			$BatchQuery 						= "SELECT  DISTINCT BATCHNO FROM pal_batchopen ORDER BY BATCHNO DESC";
			$BatchQueryStatement				= mysql_query($BatchQuery);
			while($BatchQueryStatementData		= mysql_fetch_array($BatchQueryStatement)) {
				$BATCHNO						= $BatchQueryStatementData["BATCHNO"];
				$BatchVal 						.= "<option value='".$BATCHNO."'>".$BATCHNO."</option>";
			}
			$systemParametersBody = str_replace('<!--%[BATCH_NO]%-->',$BatchVal,$systemParametersBody);
			
			//Batch Select End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report Poultry Batch Wise Statement Report End
	
	
	//Report Hatchery Profit or Loss Report Start
	function getReptHatcheryProfitLoss($empId) {
			$systemParametersBody = $this->getTemplateContent('ReptHatcheryProfitLoss');
			
						
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End
			
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report Hatchery Profit or Loss Report End
	
	//Report Hatchery Profit or Loss Report Start
	function getReptBankTransaction($empId) {
			$systemParametersBody = $this->getTemplateContent('ReptBankTransaction');
			
						
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project where STATUS = 'Active' ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End
			
			// Bank name View  Start
			
			$BankNameVal 						= '';
			$BankQuery 							= "SELECT BANKID, BANKNAME FROM fna_bank ORDER BY BANKNAME ASC";
			$BankQueryStatement					= mysql_query($BankQuery);
			while($BankQueryStatementData		= mysql_fetch_array($BankQueryStatement)) {
				$BANKID							= $BankQueryStatementData["BANKID"];
				$BANKNAME						= $BankQueryStatementData["BANKNAME"];
				$BankNameVal	 				.= "<option value='".$BANKID."'>".$BANKNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[BANK_NAME]%-->',$BankNameVal,$systemParametersBody);
			// Bank name View  End
			
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report Hatchery Profit or Loss Report End
	
	//Report Hatchery Profit or Loss Report Start
	function getReptBankTransactionSummary($empId) {
			$systemParametersBody = $this->getTemplateContent('ReptBankTransactionSummary');
			
						
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project where STATUS = 'Active' ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End
			
			// Bank name View  Start
			
			$BankNameVal 						= '';
			$BankQuery 							= "SELECT BANKID, BANKNAME FROM fna_bank ORDER BY BANKNAME ASC";
			$BankQueryStatement					= mysql_query($BankQuery);
			while($BankQueryStatementData		= mysql_fetch_array($BankQueryStatement)) {
				$BANKID							= $BankQueryStatementData["BANKID"];
				$BANKNAME						= $BankQueryStatementData["BANKNAME"];
				$BankNameVal	 				.= "<option value='".$BANKID."'>".$BANKNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[BANK_NAME]%-->',$BankNameVal,$systemParametersBody);
			// Bank name View  End
			
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report Hatchery Profit or Loss Report End
	
	//Report Group Balance Sheet Report Start
	function getReptGroupBalanceSheet($empId) {
			$systemParametersBody = $this->getTemplateContent('ReptGroupBalanceSheet');
			
						
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project where STATUS = 'Active' ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End
			
			// Bank name View  Start
			
			$BankNameVal 						= '';
			$BankQuery 							= "SELECT BANKID, BANKNAME FROM fna_bank ORDER BY BANKNAME ASC";
			$BankQueryStatement					= mysql_query($BankQuery);
			while($BankQueryStatementData		= mysql_fetch_array($BankQueryStatement)) {
				$BANKID							= $BankQueryStatementData["BANKID"];
				$BANKNAME						= $BankQueryStatementData["BANKNAME"];
				$BankNameVal	 				.= "<option value='".$BANKID."'>".$BANKNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[BANK_NAME]%-->',$BankNameVal,$systemParametersBody);
			// Bank name View  End
			
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report Group Balance Sheet Report End
	
	//Report Project Wise Group Balance Details Report Start 
	function getReptProjectWiseGroupBalanceDetails($empId) {
			$systemParametersBody = $this->getTemplateContent('ReptProjectWiseGroupBalanceDetails');
			
						
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project where STATUS = 'Active' ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End
			
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report Project Wise Group Balance Details Report End
	
	//Report Project Wise Profit or Loss Report Start 
	function getReptProjectWiseProfitLoss($empId) {
			$systemParametersBody = $this->getTemplateContent('ReptProjectWiseProfitLoss');
			
						
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project where STATUS = 'Active' ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End
			
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report Project Wise Profit or Loss Report End
	
	//Report Alu Stock Report Start 
	function getReptAluStock($empId) {
			$systemParametersBody = $this->getTemplateContent('ReptAluStock');
			
						
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End
			
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//ReportAlu Stock Report End
	
	//Report Alu Stock Report Start 
	function getReptAluStockLotNo($empId) {
			$systemParametersBody = $this->getTemplateContent('ReptAluStockLotNo');
			
						
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End
			
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//ReportAlu Stock Report End
	
	//Report Feed Raw Materials Purchase Report Start 
	function getReptFeedRawMatPurchase($empId) {
			$systemParametersBody = $this->getTemplateContent('ReptFeedRawMatPurchase');
			
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End
			
			// Product View  Start
			
			$ProdNameVal 						= '';
			$ProdQuery 							= "SELECT PRODUCTID, PRODUCTNAME FROM fna_product WHERE PROJECTID = '2' AND SUBPROJECTID = '6' ORDER BY PRODUCTNAME ASC";
			$ProdQueryStatement					= mysql_query($ProdQuery);
			while($ProdQueryStatementData		= mysql_fetch_array($ProdQueryStatement)) {
				$PRODUCTID						= $ProdQueryStatementData["PRODUCTID"];
				$PRODUCTNAME					= $ProdQueryStatementData["PRODUCTNAME"];
				$ProdNameVal	 				.= "<option value='".$PRODUCTID."'>".$PRODUCTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT_NAME]%-->',$ProdNameVal,$systemParametersBody);
			// Product View  End
			
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report Feed Raw Materials Purchase Report End
	
	//Report Feed Raw Materials Purchase Report Start 
	function getReptFeedRawMatPurPay($empId) {
			$systemParametersBody = $this->getTemplateContent('ReptFeedRawMatPurPay');
			
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End
			
			// Product View  Start
			
			$ProdNameVal 						= '';
			$ProdQuery 							= "SELECT PRODUCTID, PRODUCTNAME FROM fna_product WHERE PROJECTID = '2' AND SUBPROJECTID = '6' ORDER BY PRODUCTNAME ASC";
			$ProdQueryStatement					= mysql_query($ProdQuery);
			while($ProdQueryStatementData		= mysql_fetch_array($ProdQueryStatement)) {
				$PRODUCTID						= $ProdQueryStatementData["PRODUCTID"];
				$PRODUCTNAME					= $ProdQueryStatementData["PRODUCTNAME"];
				$ProdNameVal	 				.= "<option value='".$PRODUCTID."'>".$PRODUCTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT_NAME]%-->',$ProdNameVal,$systemParametersBody);
			// Product View  End
			
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report Feed Raw Materials Purchase Report End
	
	//Report Feed Raw Materials Purchase Report Start 
	function getReptFeedRawMatPurchaseSummary($empId) {
			$systemParametersBody = $this->getTemplateContent('ReptFeedRawMatPurchaseSummary');
			
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End
			
			// Product View  Start
			
			$ProdNameVal 						= '';
			$ProdQuery 							= "SELECT PRODUCTID, PRODUCTNAME FROM fna_product WHERE PROJECTID = '2' AND SUBPROJECTID = '6' ORDER BY PRODUCTNAME ASC";
			$ProdQueryStatement					= mysql_query($ProdQuery);
			while($ProdQueryStatementData		= mysql_fetch_array($ProdQueryStatement)) {
				$PRODUCTID						= $ProdQueryStatementData["PRODUCTID"];
				$PRODUCTNAME					= $ProdQueryStatementData["PRODUCTNAME"];
				$ProdNameVal	 				.= "<option value='".$PRODUCTID."'>".$PRODUCTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT_NAME]%-->',$ProdNameVal,$systemParametersBody);
			// Product View  End
			
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report Feed Raw Materials Purchase Report End
	
	//Report Feed Raw Materials Purchase Report Start 
	function getReptFeedRawMatUseSummary($empId) {
			$systemParametersBody = $this->getTemplateContent('ReptFeedRawMatUseSummary');
			
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End
			
			// Product View  Start
			
			$ProdNameVal 						= '';
			$ProdQuery 							= "SELECT PRODUCTID, PRODUCTNAME FROM fna_product WHERE PROJECTID = '2' AND SUBPROJECTID = '6' ORDER BY PRODUCTNAME ASC";
			$ProdQueryStatement					= mysql_query($ProdQuery);
			while($ProdQueryStatementData		= mysql_fetch_array($ProdQueryStatement)) {
				$PRODUCTID						= $ProdQueryStatementData["PRODUCTID"];
				$PRODUCTNAME					= $ProdQueryStatementData["PRODUCTNAME"];
				$ProdNameVal	 				.= "<option value='".$PRODUCTID."'>".$PRODUCTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT_NAME]%-->',$ProdNameVal,$systemParametersBody);
			// Product View  End
			
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report Feed Raw Materials Purchase Report End
	
	
	//Report Feed Mill Finished Stock Report Start 
	function getReptFeedMillFinishStock($empId) {
			$systemParametersBody = $this->getTemplateContent('ReptFeedMillFinishStock');
			
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End
			
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report Feed Mill Finished Stock Report End
	
	//Report Feed Mill Finished Stock Report Start 
	function getReptPoultryFinishStock($empId) {
			$systemParametersBody = $this->getTemplateContent('ReptPoultryFinishStock');
			
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End
			
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report Feed Mill Finished Stock Report End
	
	//Report Feed Raw Materials Stock Report Start 
	function getReptFeedRawMatStock($empId) {
			$systemParametersBody = $this->getTemplateContent('ReptFeedRawMatStock');
			
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End
			
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report Feed Raw Materials Stock Report End
	
	//Report Cold Storage Product Stock Report Start 
	function getReptColdProductStock($empId) {
			$systemParametersBody = $this->getTemplateContent('ReptColdProductStock');
			
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project where STATUS = 'Active' ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End
			
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report Cold Storage Product Stock Report End
	
	//Report Recipe Report Start 
	function getReptFeedRecipe($empId) {
			$systemParametersBody = $this->getTemplateContent('ReptFeedRecipe');
			
			// Food Name View  Start
			//echo 'komol';
			$recipeVal 						= '';
			$recipeQuery					= "SELECT f.FOODID, 
													  f.FOODNAME 
												FROM feed_fooditem f, feed_recipi r
												WHERE f.FOODID = r.FOODID
												
												ORDER BY FOODNAME ASC";
			$recipeQueryStatement			= mysql_query($recipeQuery);
			while($recipeQueryStatementData	= mysql_fetch_array($recipeQueryStatement)) {
				$FOODID						= $recipeQueryStatementData["FOODID"];
				$FOODNAME					= $recipeQueryStatementData["FOODNAME"];
				$recipeVal	 				.= "<option value='".$FOODID."'>".$FOODNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[FOOD_NAME]%-->',$recipeVal,$systemParametersBody);
			// Food Name View  End
			
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report Recipe Report End
	
	//Report Feed Production Report Start 
	function getReptFeedProduction($empId) {
			$systemParametersBody = $this->getTemplateContent('ReptFeedProduction');
			
			// Food Name View  Start
			
			$recipeVal 						= '';
			$recipeQuery					= "SELECT f.FOODID, 
													  f.FOODNAME 
												FROM feed_fooditem f, feed_recipi r
												WHERE f.FOODID = r.FOODID
												
												ORDER BY FOODNAME ASC";
			$recipeQueryStatement			= mysql_query($recipeQuery);
			while($recipeQueryStatementData	= mysql_fetch_array($recipeQueryStatement)) {
				$FOODID						= $recipeQueryStatementData["FOODID"];
				$FOODNAME					= $recipeQueryStatementData["FOODNAME"];
				$recipeVal	 				.= "<option value='".$FOODID."'>".$FOODNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[FOOD_NAME]%-->',$recipeVal,$systemParametersBody);
			// Food Name View  End
			
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End
			
			//Product Category View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report Feed Production Report End
	
	//Report Feed Production Report Start 
	function getReptFeedProductionTotal($empId) {
			$systemParametersBody = $this->getTemplateContent('ReptFeedProductionTotal');
			
			// Food Name View  Start
			
			$recipeVal 						= '';
			$recipeQuery					= "SELECT f.FOODID, 
													  f.FOODNAME 
												FROM feed_fooditem f, feed_recipi r
												WHERE f.FOODID = r.FOODID
												
												ORDER BY FOODNAME ASC";
			$recipeQueryStatement			= mysql_query($recipeQuery);
			while($recipeQueryStatementData	= mysql_fetch_array($recipeQueryStatement)) {
				$FOODID						= $recipeQueryStatementData["FOODID"];
				$FOODNAME					= $recipeQueryStatementData["FOODNAME"];
				$recipeVal	 				.= "<option value='".$FOODID."'>".$FOODNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[FOOD_NAME]%-->',$recipeVal,$systemParametersBody);
			// Food Name View  End
			
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End
			
			//Product Category View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report Feed Production Report End
	
	//Report Feed Raw Materials Use Report Start 
	function getReptFeedRawMatUse($empId) {
			$systemParametersBody = $this->getTemplateContent('ReptFeedRawMatUse');
			
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End
			
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report Feed Raw Materials Use Report End
	
	//Report Poultry Opening Batch Report Start 
	function getReptPalOpenBatch($empId) {
			$systemParametersBody = $this->getTemplateContent('ReptPalOpenBatch');
			
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End
			
			// Product View  Start
			
			$ProdNameVal 						= '';
			$ProdQuery 							= "SELECT PRODUCTID, PRODUCTNAME FROM fna_product WHERE PROJECTID = '2' AND SUBPROJECTID = '6' ORDER BY PRODUCTNAME ASC";
			$ProdQueryStatement					= mysql_query($ProdQuery);
			while($ProdQueryStatementData		= mysql_fetch_array($ProdQueryStatement)) {
				$PRODUCTID						= $ProdQueryStatementData["PRODUCTID"];
				$PRODUCTNAME					= $ProdQueryStatementData["PRODUCTNAME"];
				$ProdNameVal	 				.= "<option value='".$PRODUCTID."'>".$PRODUCTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT_NAME]%-->',$ProdNameVal,$systemParametersBody);
			// Product View  End
			
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report Poultry Opening Batch Report End
	
	//Report Poultry Batch Wise Food Distribute Report Start 
	function getReptPalFoodDist($empId) {
			$systemParametersBody = $this->getTemplateContent('ReptPalFoodDist');
			
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End
			
			//Batch Select start
			
			$BatchVal 							= '';
			$BatchQuery 						= "SELECT DISTINCT BATCHNO FROM pal_batchopen ORDER BY BATCHNO DESC";
			$BatchQueryStatement				= mysql_query($BatchQuery);
			while($BatchQueryStatementData		= mysql_fetch_array($BatchQueryStatement)) {
				$BATCHNO						= $BatchQueryStatementData["BATCHNO"];
				$BatchVal 						.= "<option value='".$BATCHNO."'>".$BATCHNO."</option>";
			}
			$systemParametersBody = str_replace('<!--%[BATCH_NO]%-->',$BatchVal,$systemParametersBody);
			
			//Batch Select End 
			
			// Product View  Start
			
			$ProdNameVal 						= '';
			$ProdQuery 							= "SELECT PRODUCTID, PRODUCTNAME FROM fna_product WHERE PROJECTID = '2' AND SUBPROJECTID = '6' ORDER BY PRODUCTNAME ASC";
			$ProdQueryStatement					= mysql_query($ProdQuery);
			while($ProdQueryStatementData		= mysql_fetch_array($ProdQueryStatement)) {
				$PRODUCTID						= $ProdQueryStatementData["PRODUCTID"];
				$PRODUCTNAME					= $ProdQueryStatementData["PRODUCTNAME"];
				$ProdNameVal	 				.= "<option value='".$PRODUCTID."'>".$PRODUCTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT_NAME]%-->',$ProdNameVal,$systemParametersBody);
			// Product View  End
			
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report Poultry Batch Wise Food Distribute Report End
	
	//Report Poultry Batch Wise Medicine Distribute Report Start 
	function getReptPalMedicineDist($empId) {
			$systemParametersBody = $this->getTemplateContent('ReptPalMedicineDist');
			
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End
			
			//Batch Select start
			
			$BatchVal 							= '';
			$BatchQuery 						= "SELECT DISTINCT BATCHNO FROM pal_batchopen ORDER BY BATCHNO DESC";
			$BatchQueryStatement				= mysql_query($BatchQuery);
			while($BatchQueryStatementData		= mysql_fetch_array($BatchQueryStatement)) {
				$BATCHNO						= $BatchQueryStatementData["BATCHNO"];
				$BatchVal 						.= "<option value='".$BATCHNO."'>".$BATCHNO."</option>";
			}
			$systemParametersBody = str_replace('<!--%[BATCH_NO]%-->',$BatchVal,$systemParametersBody);
			
			//Batch Select End 
			
			// Product View  Start
			
			$ProdNameVal 						= '';
			$ProdQuery 							= "SELECT PRODUCTID, PRODUCTNAME FROM fna_product WHERE PROJECTID = '2' AND SUBPROJECTID = '6' ORDER BY PRODUCTNAME ASC";
			$ProdQueryStatement					= mysql_query($ProdQuery);
			while($ProdQueryStatementData		= mysql_fetch_array($ProdQueryStatement)) {
				$PRODUCTID						= $ProdQueryStatementData["PRODUCTID"];
				$PRODUCTNAME					= $ProdQueryStatementData["PRODUCTNAME"];
				$ProdNameVal	 				.= "<option value='".$PRODUCTID."'>".$PRODUCTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT_NAME]%-->',$ProdNameVal,$systemParametersBody);
			// Product View  End
			
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report Poultry Batch Wise Medicine Distribute Report End
	
	//Report Poultry Batch Wise Egg Production Report Start 
	function getReptPalEggProd($empId) {
			$systemParametersBody = $this->getTemplateContent('ReptPalEggProd');
			
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End
			
			//Batch Select start
			
			$BatchVal 							= '';
			$BatchQuery 						= "SELECT DISTINCT BATCHNO FROM pal_batchopen ORDER BY BATCHNO DESC";
			$BatchQueryStatement				= mysql_query($BatchQuery);
			while($BatchQueryStatementData		= mysql_fetch_array($BatchQueryStatement)) {
				$BATCHNO						= $BatchQueryStatementData["BATCHNO"];
				$BatchVal 						.= "<option value='".$BATCHNO."'>".$BATCHNO."</option>";
			}
			$systemParametersBody = str_replace('<!--%[BATCH_NO]%-->',$BatchVal,$systemParametersBody);
			
			//Batch Select End 
			
			// Product View  Start
			
			$ProdNameVal 						= '';
			$ProdQuery 							= "SELECT PRODUCTID, PRODUCTNAME FROM fna_product WHERE PROJECTID = '2' AND SUBPROJECTID = '6' ORDER BY PRODUCTNAME ASC";
			$ProdQueryStatement					= mysql_query($ProdQuery);
			while($ProdQueryStatementData		= mysql_fetch_array($ProdQueryStatement)) {
				$PRODUCTID						= $ProdQueryStatementData["PRODUCTID"];
				$PRODUCTNAME					= $ProdQueryStatementData["PRODUCTNAME"];
				$ProdNameVal	 				.= "<option value='".$PRODUCTID."'>".$PRODUCTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT_NAME]%-->',$ProdNameVal,$systemParametersBody);
			// Product View  End
			
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report Poultry Batch Wise Egg Production Report End
	
	//Report Poultry Batch Wise Egg Sell Report Start 
	function getReptPalEggSell($empId) {
			$systemParametersBody = $this->getTemplateContent('ReptPalEggSell');
			
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End
			
			//Batch Select start
			
			$BatchVal 							= '';
			$BatchQuery 						= "SELECT  DISTINCT BATCHNO FROM pal_batchopen ORDER BY BATCHNO DESC";
			$BatchQueryStatement				= mysql_query($BatchQuery);
			while($BatchQueryStatementData		= mysql_fetch_array($BatchQueryStatement)) {
				$BATCHNO						= $BatchQueryStatementData["BATCHNO"];
				$BatchVal 						.= "<option value='".$BATCHNO."'>".$BATCHNO."</option>";
			}
			$systemParametersBody = str_replace('<!--%[BATCH_NO]%-->',$BatchVal,$systemParametersBody);
			
			//Batch Select End 
			
			// Product View  Start
			
			$ProdNameVal 						= '';
			$ProdQuery 							= "SELECT PRODUCTID, PRODUCTNAME FROM fna_product WHERE PROJECTID = '2' AND SUBPROJECTID = '6' ORDER BY PRODUCTNAME ASC";
			$ProdQueryStatement					= mysql_query($ProdQuery);
			while($ProdQueryStatementData		= mysql_fetch_array($ProdQueryStatement)) {
				$PRODUCTID						= $ProdQueryStatementData["PRODUCTID"];
				$PRODUCTNAME					= $ProdQueryStatementData["PRODUCTNAME"];
				$ProdNameVal	 				.= "<option value='".$PRODUCTID."'>".$PRODUCTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT_NAME]%-->',$ProdNameVal,$systemParametersBody);
			// Product View  End
			
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report Poultry Batch Wise Egg Sell Report End
	
	//Report Poultry Batch Wise Egg Sell Summary Report Start 
	function getReptPalEggSellSummary($empId) {
			$systemParametersBody = $this->getTemplateContent('ReptPalEggSellSummary');
			
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End
			
			//Batch Select start
			
			$BatchVal 							= '';
			$BatchQuery 						= "SELECT  DISTINCT BATCHNO FROM pal_batchopen ORDER BY BATCHNO DESC";
			$BatchQueryStatement				= mysql_query($BatchQuery);
			while($BatchQueryStatementData		= mysql_fetch_array($BatchQueryStatement)) {
				$BATCHNO						= $BatchQueryStatementData["BATCHNO"];
				$BatchVal 						.= "<option value='".$BATCHNO."'>".$BATCHNO."</option>";
			}
			$systemParametersBody = str_replace('<!--%[BATCH_NO]%-->',$BatchVal,$systemParametersBody);
			
			//Batch Select End 
			
			// Product View  Start
			
			$ProdNameVal 						= '';
			$ProdQuery 							= "SELECT PRODUCTID, PRODUCTNAME FROM fna_product WHERE PROJECTID = '2' AND SUBPROJECTID = '6' ORDER BY PRODUCTNAME ASC";
			$ProdQueryStatement					= mysql_query($ProdQuery);
			while($ProdQueryStatementData		= mysql_fetch_array($ProdQueryStatement)) {
				$PRODUCTID						= $ProdQueryStatementData["PRODUCTID"];
				$PRODUCTNAME					= $ProdQueryStatementData["PRODUCTNAME"];
				$ProdNameVal	 				.= "<option value='".$PRODUCTID."'>".$PRODUCTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT_NAME]%-->',$ProdNameVal,$systemParametersBody);
			// Product View  End
			
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report Poultry Batch Wise Egg Sell Summary Report End
	
	//Report Poultry Batch Wise Egg Sell Summary Report Start 
	function getReptPalEggProdSummary($empId) {
			$systemParametersBody = $this->getTemplateContent('ReptPalEggProdSummary');
			
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End
			
			//Batch Select start
			
			$BatchVal 							= '';
			$BatchQuery 						= "SELECT  DISTINCT BATCHNO FROM pal_batchopen ORDER BY BATCHNO DESC";
			$BatchQueryStatement				= mysql_query($BatchQuery);
			while($BatchQueryStatementData		= mysql_fetch_array($BatchQueryStatement)) {
				$BATCHNO						= $BatchQueryStatementData["BATCHNO"];
				$BatchVal 						.= "<option value='".$BATCHNO."'>".$BATCHNO."</option>";
			}
			$systemParametersBody = str_replace('<!--%[BATCH_NO]%-->',$BatchVal,$systemParametersBody);
			
			//Batch Select End 
			
			// Product View  Start
			
			$ProdNameVal 						= '';
			$ProdQuery 							= "SELECT PRODUCTID, PRODUCTNAME FROM fna_product WHERE PROJECTID = '2' AND SUBPROJECTID = '6' ORDER BY PRODUCTNAME ASC";
			$ProdQueryStatement					= mysql_query($ProdQuery);
			while($ProdQueryStatementData		= mysql_fetch_array($ProdQueryStatement)) {
				$PRODUCTID						= $ProdQueryStatementData["PRODUCTID"];
				$PRODUCTNAME					= $ProdQueryStatementData["PRODUCTNAME"];
				$ProdNameVal	 				.= "<option value='".$PRODUCTID."'>".$PRODUCTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT_NAME]%-->',$ProdNameVal,$systemParametersBody);
			// Product View  End
			
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report Poultry Batch Wise Egg Sell Summary Report End
	
	//Report Poultry Batch Wise Egg Sell Summary Report Start 
	function getReptPalBatchLiveSummary($empId) {
		//echo 'komol';
			$systemParametersBody = $this->getTemplateContent('ReptPalBatchLiveSummary');
			
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End
			
			//Batch Select start
			
			$BatchVal 							= '';
			$BatchQuery 						= "SELECT  DISTINCT BATCHNO FROM pal_batchopen ORDER BY BATCHNO DESC";
			$BatchQueryStatement				= mysql_query($BatchQuery);
			while($BatchQueryStatementData		= mysql_fetch_array($BatchQueryStatement)) {
				$BATCHNO						= $BatchQueryStatementData["BATCHNO"];
				$BatchVal 						.= "<option value='".$BATCHNO."'>".$BATCHNO."</option>";
			}
			$systemParametersBody = str_replace('<!--%[BATCH_NO]%-->',$BatchVal,$systemParametersBody);
			
			//Batch Select End 
			
			// Product View  Start
			
			$ProdNameVal 						= '';
			$ProdQuery 							= "SELECT PRODUCTID, PRODUCTNAME FROM fna_product WHERE PROJECTID = '2' AND SUBPROJECTID = '6' ORDER BY PRODUCTNAME ASC";
			$ProdQueryStatement					= mysql_query($ProdQuery);
			while($ProdQueryStatementData		= mysql_fetch_array($ProdQueryStatement)) {
				$PRODUCTID						= $ProdQueryStatementData["PRODUCTID"];
				$PRODUCTNAME					= $ProdQueryStatementData["PRODUCTNAME"];
				$ProdNameVal	 				.= "<option value='".$PRODUCTID."'>".$PRODUCTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT_NAME]%-->',$ProdNameVal,$systemParametersBody);
			// Product View  End
			
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report Poultry Batch Wise Egg Sell Summary Report End
	
	//Report Poultry Batch Wise Egg Sell Summary Report Start 
	function getReptPalBatchFoodSummary($empId) {
		//echo 'komol';
			$systemParametersBody = $this->getTemplateContent('ReptPalBatchFoodSummary');
			
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End
			
			//Batch Select start
			
			$BatchVal 							= '';
			$BatchQuery 						= "SELECT  DISTINCT BATCHNO FROM pal_batchopen ORDER BY BATCHNO DESC";
			$BatchQueryStatement				= mysql_query($BatchQuery);
			while($BatchQueryStatementData		= mysql_fetch_array($BatchQueryStatement)) {
				$BATCHNO						= $BatchQueryStatementData["BATCHNO"];
				$BatchVal 						.= "<option value='".$BATCHNO."'>".$BATCHNO."</option>";
			}
			$systemParametersBody = str_replace('<!--%[BATCH_NO]%-->',$BatchVal,$systemParametersBody);
			
			//Batch Select End 
			
			// Product View  Start
			
			$ProdNameVal 						= '';
			$ProdQuery 							= "SELECT PRODUCTID, PRODUCTNAME FROM fna_product WHERE PROJECTID = '2' AND SUBPROJECTID = '6' ORDER BY PRODUCTNAME ASC";
			$ProdQueryStatement					= mysql_query($ProdQuery);
			while($ProdQueryStatementData		= mysql_fetch_array($ProdQueryStatement)) {
				$PRODUCTID						= $ProdQueryStatementData["PRODUCTID"];
				$PRODUCTNAME					= $ProdQueryStatementData["PRODUCTNAME"];
				$ProdNameVal	 				.= "<option value='".$PRODUCTID."'>".$PRODUCTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT_NAME]%-->',$ProdNameVal,$systemParametersBody);
			// Product View  End
			
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report Poultry Batch Wise Egg Sell Summary Report End
	
	//Report Poultry Batch Wise Egg Sell Summary Report Start 
	function getReptPalBatchMedicineSummary($empId) {
		//echo 'komol';
			$systemParametersBody = $this->getTemplateContent('ReptPalBatchMedicineSummary');
			
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End
			
			//Batch Select start
			
			$BatchVal 							= '';
			$BatchQuery 						= "SELECT  DISTINCT BATCHNO FROM pal_batchopen ORDER BY BATCHNO DESC";
			$BatchQueryStatement				= mysql_query($BatchQuery);
			while($BatchQueryStatementData		= mysql_fetch_array($BatchQueryStatement)) {
				$BATCHNO						= $BatchQueryStatementData["BATCHNO"];
				$BatchVal 						.= "<option value='".$BATCHNO."'>".$BATCHNO."</option>";
			}
			$systemParametersBody = str_replace('<!--%[BATCH_NO]%-->',$BatchVal,$systemParametersBody);
			
			//Batch Select End 
			
			// Product View  Start
			
			$ProdNameVal 						= '';
			$ProdQuery 							= "SELECT PRODUCTID, PRODUCTNAME FROM fna_product WHERE PROJECTID = '2' AND SUBPROJECTID = '6' ORDER BY PRODUCTNAME ASC";
			$ProdQueryStatement					= mysql_query($ProdQuery);
			while($ProdQueryStatementData		= mysql_fetch_array($ProdQueryStatement)) {
				$PRODUCTID						= $ProdQueryStatementData["PRODUCTID"];
				$PRODUCTNAME					= $ProdQueryStatementData["PRODUCTNAME"];
				$ProdNameVal	 				.= "<option value='".$PRODUCTID."'>".$PRODUCTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT_NAME]%-->',$ProdNameVal,$systemParametersBody);
			// Product View  End
			
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report Poultry Batch Wise Egg Sell Summary Report End
	
	//Report Poultry Batch Wise Egg Sell Summary Report Start 
	function getReptMedicineSummaryBatchWise($empId) {
		//echo 'komol';
			$systemParametersBody = $this->getTemplateContent('ReptMedicineSummaryBatchWise');
			
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End
			
			//Batch Select start
			
			$BatchVal 							= '';
			$BatchQuery 						= "SELECT  DISTINCT BATCHNO FROM pal_batchopen ORDER BY BATCHNO DESC";
			$BatchQueryStatement				= mysql_query($BatchQuery);
			while($BatchQueryStatementData		= mysql_fetch_array($BatchQueryStatement)) {
				$BATCHNO						= $BatchQueryStatementData["BATCHNO"];
				$BatchVal 						.= "<option value='".$BATCHNO."'>".$BATCHNO."</option>";
			}
			$systemParametersBody = str_replace('<!--%[BATCH_NO]%-->',$BatchVal,$systemParametersBody);
			
			//Batch Select End 
			
			// Product View  Start
			
			$ProdNameVal 						= '';
			$ProdQuery 							= "SELECT PRODUCTID, PRODUCTNAME FROM fna_product WHERE PROJECTID = '2' AND SUBPROJECTID = '6' ORDER BY PRODUCTNAME ASC";
			$ProdQueryStatement					= mysql_query($ProdQuery);
			while($ProdQueryStatementData		= mysql_fetch_array($ProdQueryStatement)) {
				$PRODUCTID						= $ProdQueryStatementData["PRODUCTID"];
				$PRODUCTNAME					= $ProdQueryStatementData["PRODUCTNAME"];
				$ProdNameVal	 				.= "<option value='".$PRODUCTID."'>".$PRODUCTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT_NAME]%-->',$ProdNameVal,$systemParametersBody);
			// Product View  End
			
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report Poultry Batch Wise Egg Sell Summary Report End
	
	//Report Poultry Batch Wise Murgi Morog Sell Report Start 
	function getReptPalMurMorSell($empId) {
			$systemParametersBody = $this->getTemplateContent('ReptPalMurMorSell');
			
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End
			
			//Batch Select start
			
			$BatchVal 							= '';
			$BatchQuery 						= "SELECT  DISTINCT BATCHNO FROM pal_batchopen ORDER BY BATCHNO DESC";
			$BatchQueryStatement				= mysql_query($BatchQuery);
			while($BatchQueryStatementData		= mysql_fetch_array($BatchQueryStatement)) {
				$BATCHNO						= $BatchQueryStatementData["BATCHNO"];
				$BatchVal 						.= "<option value='".$BATCHNO."'>".$BATCHNO."</option>";
			}
			$systemParametersBody = str_replace('<!--%[BATCH_NO]%-->',$BatchVal,$systemParametersBody);
			
			//Batch Select End 
			
			// Product View  Start
			
			$ProdNameVal 						= '';
			$ProdQuery 							= "SELECT PRODUCTID, PRODUCTNAME FROM fna_product WHERE PROJECTID = '2' AND SUBPROJECTID = '6' ORDER BY PRODUCTNAME ASC";
			$ProdQueryStatement					= mysql_query($ProdQuery);
			while($ProdQueryStatementData		= mysql_fetch_array($ProdQueryStatement)) {
				$PRODUCTID						= $ProdQueryStatementData["PRODUCTID"];
				$PRODUCTNAME					= $ProdQueryStatementData["PRODUCTNAME"];
				$ProdNameVal	 				.= "<option value='".$PRODUCTID."'>".$PRODUCTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT_NAME]%-->',$ProdNameVal,$systemParametersBody);
			// Product View  End
			
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report Poultry Batch Wise Murgi Morog Sell Report End
	
	//Report Hatchery Hatch Wise Opening Egg Report Start 
	function getReptHatchOpeningEgg($empId) {
			$systemParametersBody = $this->getTemplateContent('ReptHatchOpeningEgg');
			
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End
			
			//Batch Select start
			
			$BatchVal 							= '';
			$BatchQuery 						= "SELECT DISTINCT BATCHNO FROM pal_batchopen ORDER BY BATCHNO DESC";
			$BatchQueryStatement				= mysql_query($BatchQuery);
			while($BatchQueryStatementData		= mysql_fetch_array($BatchQueryStatement)) {
				$BATCHNO						= $BatchQueryStatementData["BATCHNO"];
				$BatchVal 						.= "<option value='".$BATCHNO."'>".$BATCHNO."</option>";
			}
			$systemParametersBody = str_replace('<!--%[BATCH_NO]%-->',$BatchVal,$systemParametersBody);
			
			//Batch Select End 
			
			// Product View  Start
			
			$ProdNameVal 						= '';
			$ProdQuery 							= "SELECT PRODUCTID, PRODUCTNAME FROM fna_product WHERE PROJECTID = '2' AND SUBPROJECTID = '6' ORDER BY PRODUCTNAME ASC";
			$ProdQueryStatement					= mysql_query($ProdQuery);
			while($ProdQueryStatementData		= mysql_fetch_array($ProdQueryStatement)) {
				$PRODUCTID						= $ProdQueryStatementData["PRODUCTID"];
				$PRODUCTNAME					= $ProdQueryStatementData["PRODUCTNAME"];
				$ProdNameVal	 				.= "<option value='".$PRODUCTID."'>".$PRODUCTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT_NAME]%-->',$ProdNameVal,$systemParametersBody);
			// Product View  End
			
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report Hatchery Hatch Wise Opening Egg Report End
	
	//Report Hatchery Cancel Egg Report Start 
	function getReptHatchCancelEgg($empId) {
			$systemParametersBody = $this->getTemplateContent('ReptHatchCancelEgg');
			
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End
			
			//Batch Select start
			
			$BatchVal 							= '';
			$BatchQuery 						= "SELECT BATCHNO FROM pal_batchopen ORDER BY BATCHNO DESC";
			$BatchQueryStatement				= mysql_query($BatchQuery);
			while($BatchQueryStatementData		= mysql_fetch_array($BatchQueryStatement)) {
				$BATCHNO						= $BatchQueryStatementData["BATCHNO"];
				$BatchVal 						.= "<option value='".$BATCHNO."'>".$BATCHNO."</option>";
			}
			$systemParametersBody = str_replace('<!--%[BATCH_NO]%-->',$BatchVal,$systemParametersBody);
			
			//Batch Select End 
			
			// Product View  Start
			
			$ProdNameVal 						= '';
			$ProdQuery 							= "SELECT PRODUCTID, PRODUCTNAME FROM fna_product WHERE PROJECTID = '2' AND SUBPROJECTID = '6' ORDER BY PRODUCTNAME ASC";
			$ProdQueryStatement					= mysql_query($ProdQuery);
			while($ProdQueryStatementData		= mysql_fetch_array($ProdQueryStatement)) {
				$PRODUCTID						= $ProdQueryStatementData["PRODUCTID"];
				$PRODUCTNAME					= $ProdQueryStatementData["PRODUCTNAME"];
				$ProdNameVal	 				.= "<option value='".$PRODUCTID."'>".$PRODUCTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT_NAME]%-->',$ProdNameVal,$systemParametersBody);
			// Product View  End
			
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report Hatchery Cancel Egg Report End
	
	//Report Hatchery Egg Settings Report Start 
	function getReptHatchEggSettings($empId) {
			$systemParametersBody = $this->getTemplateContent('ReptHatchEggSettings');
			
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End
			
			//Batch Select start
			
			$HatchVal 							= '';
			$HatchQuery 						= "SELECT DISTINCT HATCHNO FROM hatch_egg_settings_machine ORDER BY HATCHNO DESC";
			$HatchQueryStatement				= mysql_query($HatchQuery);
			while($HatchQueryStatementData		= mysql_fetch_array($HatchQueryStatement)) {
				$HATCHNO						= $HatchQueryStatementData["HATCHNO"];
				$HatchVal 						.= "<option value='".$HATCHNO."'>".$HATCHNO."</option>";
			}
			$systemParametersBody = str_replace('<!--%[HATCH_NO]%-->',$HatchVal,$systemParametersBody);
			
			//Batch Select End 
			
			// Product View  Start
			
			$ProdNameVal 						= '';
			$ProdQuery 							= "SELECT PRODUCTID, PRODUCTNAME FROM fna_product WHERE PROJECTID = '2' AND SUBPROJECTID = '6' ORDER BY PRODUCTNAME ASC";
			$ProdQueryStatement					= mysql_query($ProdQuery);
			while($ProdQueryStatementData		= mysql_fetch_array($ProdQueryStatement)) {
				$PRODUCTID						= $ProdQueryStatementData["PRODUCTID"];
				$PRODUCTNAME					= $ProdQueryStatementData["PRODUCTNAME"];
				$ProdNameVal	 				.= "<option value='".$PRODUCTID."'>".$PRODUCTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT_NAME]%-->',$ProdNameVal,$systemParametersBody);
			// Product View  End
			
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report Hatchery Egg Settings Report End
	
	//Report Hatchery Chicken Production Report Start 
	function getReptHatchChickenProd($empId) {
			$systemParametersBody = $this->getTemplateContent('ReptHatchChickenProd');
			
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End
			
			//Batch Select start
			
			$HatchVal 							= '';
			$HatchQuery 						= "SELECT DISTINCT HATCHNO FROM hatch_egg_settings_machine ORDER BY HATCHNO DESC";
			$HatchQueryStatement				= mysql_query($HatchQuery);
			while($HatchQueryStatementData		= mysql_fetch_array($HatchQueryStatement)) {
				$HATCHNO						= $HatchQueryStatementData["HATCHNO"];
				$HatchVal 						.= "<option value='".$HATCHNO."'>".$HATCHNO."</option>";
			}
			$systemParametersBody = str_replace('<!--%[HATCH_NO]%-->',$HatchVal,$systemParametersBody);
			
			//Batch Select End 
			
			// Product View  Start
			
			$ProdNameVal 						= '';
			$ProdQuery 							= "SELECT PRODUCTID, PRODUCTNAME FROM fna_product WHERE PROJECTID = '2' AND SUBPROJECTID = '6' ORDER BY PRODUCTNAME ASC";
			$ProdQueryStatement					= mysql_query($ProdQuery);
			while($ProdQueryStatementData		= mysql_fetch_array($ProdQueryStatement)) {
				$PRODUCTID						= $ProdQueryStatementData["PRODUCTID"];
				$PRODUCTNAME					= $ProdQueryStatementData["PRODUCTNAME"];
				$ProdNameVal	 				.= "<option value='".$PRODUCTID."'>".$PRODUCTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT_NAME]%-->',$ProdNameVal,$systemParametersBody);
			// Product View  End
			
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report Hatchery Chicken Production Report End
	
	//Report Hatchery Chicken Stock Report Start 
	function getReptHatchChickenStock($empId) {
			$systemParametersBody = $this->getTemplateContent('ReptHatchChickenStock');
			
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End
			
			//Batch Select start
			
			$HatchVal 							= '';
			$HatchQuery 						= "SELECT DISTINCT HATCHNO FROM hatch_egg_settings_machine ORDER BY HATCHNO DESC";
			$HatchQueryStatement				= mysql_query($HatchQuery);
			while($HatchQueryStatementData		= mysql_fetch_array($HatchQueryStatement)) {
				$HATCHNO						= $HatchQueryStatementData["HATCHNO"];
				$HatchVal 						.= "<option value='".$HATCHNO."'>".$HATCHNO."</option>";
			}
			$systemParametersBody = str_replace('<!--%[HATCH_NO]%-->',$HatchVal,$systemParametersBody);
			
			//Batch Select End 
			
			// Product View  Start
			
			$ProdNameVal 						= '';
			$ProdQuery 							= "SELECT PRODUCTID, PRODUCTNAME FROM fna_product WHERE PROJECTID = '2' AND SUBPROJECTID = '6' ORDER BY PRODUCTNAME ASC";
			$ProdQueryStatement					= mysql_query($ProdQuery);
			while($ProdQueryStatementData		= mysql_fetch_array($ProdQueryStatement)) {
				$PRODUCTID						= $ProdQueryStatementData["PRODUCTID"];
				$PRODUCTNAME					= $ProdQueryStatementData["PRODUCTNAME"];
				$ProdNameVal	 				.= "<option value='".$PRODUCTID."'>".$PRODUCTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT_NAME]%-->',$ProdNameVal,$systemParametersBody);
			// Product View  End
			
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report Hatchery Chicken Stock Report End
	
	//Report Hatchery Chicken Sales Statement Report Start 
	function getReptHatchChickenSalesStatement($empId) {
			$systemParametersBody = $this->getTemplateContent('ReptHatchChickenSalesState');
			
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End
			
			//Batch Select start
			
			$HatchVal 							= '';
			$HatchQuery 						= "SELECT DISTINCT HATCHNO FROM hatch_egg_settings_machine ORDER BY HATCHNO DESC";
			$HatchQueryStatement				= mysql_query($HatchQuery);
			while($HatchQueryStatementData		= mysql_fetch_array($HatchQueryStatement)) {
				$HATCHNO						= $HatchQueryStatementData["HATCHNO"];
				$HatchVal 						.= "<option value='".$HATCHNO."'>".$HATCHNO."</option>";
			}
			$systemParametersBody = str_replace('<!--%[HATCH_NO]%-->',$HatchVal,$systemParametersBody);
			
			//Batch Select End 
			
			// Product View  Start
			
			$ProdNameVal 						= '';
			$ProdQuery 							= "SELECT PRODUCTID, PRODUCTNAME FROM fna_product WHERE PROJECTID = '2' AND SUBPROJECTID = '6' ORDER BY PRODUCTNAME ASC";
			$ProdQueryStatement					= mysql_query($ProdQuery);
			while($ProdQueryStatementData		= mysql_fetch_array($ProdQueryStatement)) {
				$PRODUCTID						= $ProdQueryStatementData["PRODUCTID"];
				$PRODUCTNAME					= $ProdQueryStatementData["PRODUCTNAME"];
				$ProdNameVal	 				.= "<option value='".$PRODUCTID."'>".$PRODUCTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT_NAME]%-->',$ProdNameVal,$systemParametersBody);
			// Product View  End
			
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report Hatchery Chicken Sales Statement Report End
	
	//Report Hatchery Party Bill Receive Report Start 
	function getReptHatchPartyBillReceive($empId) {
			$systemParametersBody = $this->getTemplateContent('reptHatchPartyBillRec');
			
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End			
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End  
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report Hatchery Party Bill Receive Report  End
	
	//Report FNA Expanse Head Individual Information Start 
	function getReptFnaExpHeadIndividual($empId) {
			$systemParametersBody = $this->getTemplateContent('reptFnaExpanseIndividual');
			
						
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project where STATUS = 'Active' ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End
			
			//Project View Start
			
			$expHeadNameList 						= '';
			$expHeadNameQuery 						= "SELECT EXPHID, EXPHEADNAME FROM fna_expense_head ORDER BY EXPHEADNAME ASC";
			$expHeadNameQueryStatement				= mysql_query($expHeadNameQuery);
			while($expHeadNameQueryStatementData	= mysql_fetch_array($expHeadNameQueryStatement)) {
				$EXPHID								= $expHeadNameQueryStatementData["EXPHID"];
				$EXPHEADNAME						= $expHeadNameQueryStatementData["EXPHEADNAME"];
				$expHeadNameList					.= "<option value='".$EXPHID."'>".$EXPHEADNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[EXPANSE_HEAD_NAME]%-->',$expHeadNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report FNA Expanse Head Individual Information End
	
	//Report FNA Income Head Individual Information Start 
	function getReptFnaIncomeHeadIndividual($empId) {
			$systemParametersBody = $this->getTemplateContent('reptFnaIncomeIndividual');
			
						
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project where STATUS = 'Active' ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End
			
			//Income Head Name Start
			
			$incomeHeadNameList 						= '';
			$incomeHeadNameQuery 						= "SELECT pc.INHID, pc.INCHEADNAME FROM fna_income_head pc ORDER BY pc.INCHEADNAME ASC";
			$incomeHeadNameQueryStatement				= mysql_query($incomeHeadNameQuery);
			while($incomeHeadNameQueryStatementData		= mysql_fetch_array($incomeHeadNameQueryStatement)) {
				$INHID									= $incomeHeadNameQueryStatementData["INHID"];
				$INCHEADNAME							= $incomeHeadNameQueryStatementData["INCHEADNAME"];
				$incomeHeadNameList						.= "<option value='".$INHID."'>".$INCHEADNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[INCOME_HEAD_NAME]%-->',$incomeHeadNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Income Head Name End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report FNA Income Head Individual Information End
	
	//Report FNA Alu Commussion  Start 
	function getReptFnaAluCommussion($empId) {
			$systemParametersBody = $this->getTemplateContent('reptFnaAluCommussion');
			
						
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End
			
			//Project View Start
			
			$expHeadNameList 						= '';
			$expHeadNameQuery 						= "SELECT pc.EXPHID, pc.EXPHEADNAME FROM fna_expense_head pc ORDER BY pc.EXPHEADNAME ASC";
			$expHeadNameQueryStatement				= mysql_query($expHeadNameQuery);
			while($expHeadNameQueryStatementData	= mysql_fetch_array($expHeadNameQueryStatement)) {
				$EXPHID								= $expHeadNameQueryStatementData["EXPHID"];
				$EXPHEADNAME						= $expHeadNameQueryStatementData["EXPHEADNAME"];
				$expHeadNameList					.= "<option value='".$EXPHID."'>".$EXPHEADNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[EXPANSE_HEAD_NAME]%-->',$expHeadNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report FNA Alu Commussion End
	
	//Report FNA Alu Commussion  Start 
	function getReptAluLoanDOReport($empId) {
			$systemParametersBody = $this->getTemplateContent('reptFnaAluLoanDOReport');
			
						
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End
			
			//Project View Start
			
			$expHeadNameList 						= '';
			$expHeadNameQuery 						= "SELECT pc.EXPHID, pc.EXPHEADNAME FROM fna_expense_head pc ORDER BY pc.EXPHEADNAME ASC";
			$expHeadNameQueryStatement				= mysql_query($expHeadNameQuery);
			while($expHeadNameQueryStatementData	= mysql_fetch_array($expHeadNameQueryStatement)) {
				$EXPHID								= $expHeadNameQueryStatementData["EXPHID"];
				$EXPHEADNAME						= $expHeadNameQueryStatementData["EXPHEADNAME"];
				$expHeadNameList					.= "<option value='".$EXPHID."'>".$EXPHEADNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[EXPANSE_HEAD_NAME]%-->',$expHeadNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report FNA Alu Commussion End
	
	//Report FNA Expanse Head Individual Information Start 
	function getReptFnaExpHeadSubProj($empId) {
			$systemParametersBody = $this->getTemplateContent('reptFnaExpanseSubProj');
			
						
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project where STATUS = 'Active' ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End
			
			//Project View Start
			
			$expHeadNameList 						= '';
			$expHeadNameQuery 						= "SELECT pc.EXPHID, pc.EXPHEADNAME FROM fna_expense_head pc ORDER BY pc.EXPHEADNAME ASC";
			$expHeadNameQueryStatement				= mysql_query($expHeadNameQuery);
			while($expHeadNameQueryStatementData	= mysql_fetch_array($expHeadNameQueryStatement)) {
				$EXPHID								= $expHeadNameQueryStatementData["EXPHID"];
				$EXPHEADNAME						= $expHeadNameQueryStatementData["EXPHEADNAME"];
				$expHeadNameList					.= "<option value='".$EXPHID."'>".$EXPHEADNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[EXPANSE_HEAD_NAME]%-->',$expHeadNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			// Expanse Head View  Start
			
			$IncHeadNameVal 					= '';
			$IncHeadQuery 						= "SELECT INHID, INCHEADNAME FROM fna_income_head ORDER BY INCHEADNAME ASC";
			$IncHeadQueryStatement				= mysql_query($IncHeadQuery);
			while($IncHeadQueryStatementData	= mysql_fetch_array($IncHeadQueryStatement)) {
				$INHID							= $IncHeadQueryStatementData["INHID"];
				$INCHEADNAME					= $IncHeadQueryStatementData["INCHEADNAME"];
				$IncHeadNameVal 					.= "<option value='".$INHID."'>".$INCHEADNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[INCOME_HEAD_NAME]%-->',$IncHeadNameVal,$systemParametersBody);
			// Expanse Head View  End
			
			
			return $systemParametersBody;
		}
	//Report FNA Expanse Head Individual Information End
	
	//Report Poultry Head Wise Expanse Start 
	function getReptPalHeadWiseExpanse($empId) {
			$systemParametersBody = $this->getTemplateContent('reptPoultryHeadWiseExpanses');
			
						
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End
			
			//Project View Start
			
			$expHeadNameList 						= '';
			$expHeadNameQuery 						= "SELECT POEXID, EXPANSEHEAD FROM pal_others_expanse ORDER BY EXPANSEHEAD ASC";
			$expHeadNameQueryStatement				= mysql_query($expHeadNameQuery);
			while($expHeadNameQueryStatementData	= mysql_fetch_array($expHeadNameQueryStatement)) {
				$POEXID								= $expHeadNameQueryStatementData["POEXID"];
				$EXPANSEHEAD						= $expHeadNameQueryStatementData["EXPANSEHEAD"];
				$expHeadNameList					.= "<option value='".$POEXID."'>".$EXPANSEHEAD."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[EXPANSE_HEAD_NAME]%-->',$expHeadNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			//Batch Select start
			
			$BatchVal 							= '';
			$BatchQuery 						= "SELECT DISTINCT BATCHNO FROM pal_batchopen ORDER BY BATCHNO DESC";
			$BatchQueryStatement				= mysql_query($BatchQuery);
			while($BatchQueryStatementData		= mysql_fetch_array($BatchQueryStatement)) {
				$BATCHNO						= $BatchQueryStatementData["BATCHNO"];
				$BatchVal 						.= "<option value='".$BATCHNO."'>".$BATCHNO."</option>";
			}
			$systemParametersBody = str_replace('<!--%[BATCH_NO]%-->',$BatchVal,$systemParametersBody);
			
			//Batch Select End 
			
			
			
			return $systemParametersBody;
		}
	//Report Poultry Head Wise Expanse End
	
	//Report Poultry Head Wise Income Start 
	function getReptPalHeadWiseIncome($empId) {
			$systemParametersBody = $this->getTemplateContent('reptPoultryHeadWiseIncome');
			
						
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End
			
			//Project View Start
			
			$expHeadNameList 						= '';
			$expHeadNameQuery 						= "SELECT POINID, INCOMEHEAD FROM pal_others_income ORDER BY INCOMEHEAD ASC";
			$expHeadNameQueryStatement				= mysql_query($expHeadNameQuery);
			while($expHeadNameQueryStatementData	= mysql_fetch_array($expHeadNameQueryStatement)) {
				$POINID								= $expHeadNameQueryStatementData["POINID"];
				$INCOMEHEAD							= $expHeadNameQueryStatementData["INCOMEHEAD"];
				$expHeadNameList					.= "<option value='".$POINID."'>".$INCOMEHEAD."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[INCOME_HEAD_NAME]%-->',$expHeadNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			//Batch Select start
			
			$BatchVal 							= '';
			$BatchQuery 						= "SELECT DISTINCT BATCHNO FROM pal_batchopen ORDER BY BATCHNO DESC";
			$BatchQueryStatement				= mysql_query($BatchQuery);
			while($BatchQueryStatementData		= mysql_fetch_array($BatchQueryStatement)) {
				$BATCHNO						= $BatchQueryStatementData["BATCHNO"];
				$BatchVal 						.= "<option value='".$BATCHNO."'>".$BATCHNO."</option>";
			}
			$systemParametersBody = str_replace('<!--%[BATCH_NO]%-->',$BatchVal,$systemParametersBody);
			
			//Batch Select End 
			
			
			
			return $systemParametersBody;
		}
	//Report Poultry Head Wise Income End
	
	//Report Feed Mill Party Bill Receive Report Start 
	function getReptFeedPartyBillReceive($empId) {
			$systemParametersBody = $this->getTemplateContent('reptFeedPartyBillRec');
			
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End			
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End  
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report Feed Mill Party Bill Receive Report  End
	
	//Report Poultry Firm Party Bill Receive Report Start 
	function getReptPoultryPartyBillReceive($empId) {
			$systemParametersBody = $this->getTemplateContent('reptPoultryPartyBillRec');
			
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End			
			//Party View Start
			$pNameList 					= '';
			$pNameQuery 				= "SELECT p.PARTYID, p.PARTYNAME FROM fna_party p ORDER BY p.PARTYNAME ASC";
			$pNameQueryStatement		= mysql_query($pNameQuery);
			while($pNameQueryStatementData	= mysql_fetch_array($pNameQueryStatement)) {
				$PARTYID					= $pNameQueryStatementData["PARTYID"];
				$PARTYNAME					= $pNameQueryStatementData["PARTYNAME"];
				$pNameList					.= "<option value='".$PARTYID."'>".$PARTYNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$pNameList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Party View End 
			
			//Project View Start
			$pcategoryList 						= '';
			$pcategoryQuery 					= "SELECT pc.PRODCATTYPEID, pc.CATEGORYTYPENAME FROM fna_productcattype pc ORDER BY pc.CATEGORYTYPENAME ASC";
			$pcategoryQueryStatement			= mysql_query($pcategoryQuery);
			while($pcategoryQueryStatementData	= mysql_fetch_array($pcategoryQueryStatement)) {
				$PRODCATTYPEID					= $pcategoryQueryStatementData["PRODCATTYPEID"];
				$CATEGORYTYPENAME				= $pcategoryQueryStatementData["CATEGORYTYPENAME"];
				$pcategoryList					.= "<option value='".$PRODCATTYPEID."'>".$CATEGORYTYPENAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PRODUCT_CAT_NAME]%-->',$pcategoryList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End  
			
			
			
			
			
			return $systemParametersBody;
		}
	//Report Poultry Firm Party Bill Receive Report  End
	
		 // ....................................................................... Advance Search Start......................................................................
	  function getDfoltAdvanceSearch($empId) {
			$systemParametersBody = $this->getTemplateContent('advanceSearch');
			
			//Ministry/Division and Project/Programme Name View Report Start
			$moduleService 						= '';
			$moduleServiceQuery 				= "SELECT ministryDivision,adbProjectName FROM adbs_projectsetup ORDER BY psId ASC";
			$moduleServiceStatement				= mysql_query($moduleServiceQuery);
			while($moduleServiceStatementData	= mysql_fetch_array($moduleServiceStatement)) {
				$ministryDivision				= $moduleServiceStatementData["ministryDivision"];
				$adbProjectName				= $moduleServiceStatementData["adbProjectName"];
			}
			$systemParametersBody = str_replace('<!--%[MNISTRY_DIVISION_VIEW]%-->',$ministryDivision,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[ADB_PROJECT_NAME_VIEW]%-->',$adbProjectName,$systemParametersBody);
			//Ministry/Division and Project/Programme Name View Report End
			
			//Agency View Report Start
			$moduleService 						= '';
			$moduleServiceQuery 				= "SELECT aFName FROM adbs_agency ORDER BY 	aId ASC";
			$moduleServiceStatement				= mysql_query($moduleServiceQuery);
			while($moduleServiceStatementData	= mysql_fetch_array($moduleServiceStatement)) {
				$aFName				= $moduleServiceStatementData["aFName"];
			}
			$systemParametersBody = str_replace('<!--%[AGENCY_VIEW]%-->',$aFName,$systemParametersBody);
			//Agency View Report End
			
			
			//Project View Start
			$adbProjectList 					= '';
			$adbProjectListQuery 				= "SELECT ps.psId, ps.adbProjectName FROM adbs_projectsetup ps, s_user u WHERE ps.psId = u.psId  AND u.USER_ID = {$empId} ORDER BY adbProjectName ASC";
			$adbProjectListStatement			= mysql_query($adbProjectListQuery);
			while($adbProjectListStatementData	= mysql_fetch_array($adbProjectListStatement)) {
				$psId					= $adbProjectListStatementData["psId"];
				$adbProjectName				= $adbProjectListStatementData["adbProjectName"];
				$adbProjectList				.= "<option value='".$psId."'>".$adbProjectName."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PI_PROJECT_LIST]%-->',$adbProjectList,$systemParametersBody);
			
			//Project View End 
			
			//Project View Start
			$pTList 					= '';
			$pTQuery 				= "SELECT pt.ptId, pt.ptName FROM adbs_procurementtype pt ORDER BY ptName ASC";
			$pTQueryStatement			= mysql_query($pTQuery);
			while($pTQueryStatementData	= mysql_fetch_array($pTQueryStatement)) {
				$pTId					= $pTQueryStatementData["ptId"];
				$pTName				= $pTQueryStatementData["ptName"];
				$pTList				.= "<option value='".$pTId."'>".$pTName."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PT_LIST]%-->',$pTList,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[USER_ID]%-->',$empId,$systemParametersBody);
			
			//Project View End 
			
			
			
			//Project/Programme Name & Code View Report Start
			$bps_38                             = '';
			$moduleService 						= '';
			$moduleServiceQuery 				= "SELECT pi_4,pi_6,pi_13,pi_14 FROM adbs_package ORDER BY pId ASC";
			$moduleServiceStatement				= mysql_query($moduleServiceQuery);
			while($moduleServiceStatementData	= mysql_fetch_array($moduleServiceStatement)) {
				$pi_4				= $moduleServiceStatementData["pi_4"];
				$pi_6				= $moduleServiceStatementData["pi_6"];
				$pi_13				= $moduleServiceStatementData["pi_13"];
				$pi_14				= $moduleServiceStatementData["pi_14"];
			}
			$systemParametersBody = str_replace('<!--%[PI_4_VIEW]%-->',$pi_4,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[PI_6_VIEW]%-->',$pi_6,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[PI_13_VIEW]%-->',$pi_13,$systemParametersBody);
			$systemParametersBody = str_replace('<!--%[PI_14_VIEW]%-->',$pi_14,$systemParametersBody);
			//Project/Programme Name & Code View Report End
			
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
			
			// Project Name View Start
			$adbProjectList 					= '';
			$projectListQuery 				= "SELECT psId, adbProjectName FROM adbs_projectsetup ORDER BY psId ASC";
			$projectListStatement			= mysql_query($projectListQuery);
			while($projectListStatementData	= mysql_fetch_array($projectListStatement)) {
				$adbProjectName				= $projectListStatementData["adbProjectName"];
				$psIdName				= $projectListStatementData["psId"];
				$adbProjectList				.= "<option value='".$psIdName."'>".$adbProjectName."</option>";
			}
	
			$systemParametersBody = str_replace('<!--%[PROJECT_LIST]%-->',$adbProjectList,$systemParametersBody);
			// Project Name View End
			
			
			return $systemParametersBody;
		}
		
		 function insertAdvanceSearch($empId) {
			$systemParametersBody = $this->getTemplateContent('advanceSearch');
			
		echo	$ptId 							= addslashes($_REQUEST["ptId"]); die();
			$piProcurementMethod 			= addslashes($_REQUEST["piProcurementMethod"]);
			$piBiddingProcedure 			= addslashes($_REQUEST["piBiddingProcedure"]);
			$piPriorReview 					= addslashes($_REQUEST["piPriorReview"]);
			$piPrequalificationProcess 		= addslashes($_REQUEST["piPrequalificationProcess"]);
			$contractName 					= addslashes($_REQUEST["contractName"]);

			// View Package in home page start
			$packageView = "<table border='0' width='100%' align='left' cellspacing='0' cellpadding='3' style='font-size:13px;'>";
			$admin = 1; 
			$packageServQuery = "
									SELECT
											p.pId,
											p.pName,
											p.entUser,
											p.status,
											p.pi_19,
											p.pi_4,
											p.pi_5,
											p.ptId
									FROM
											adbs_package p, s_user u
											
									WHERE  p.ptId = $ptId
									AND    u.USER_ID = $userId											
									ORDER BY pId ASC";
			$msv							= 1;
			$packageServStatement			= mysql_query($packageServQuery);
			while($packageServStatementData	= mysql_fetch_array($packageServStatement)) {
				if($msv%2==0) {
					$class	= "evenRow";
				} else {
					$class	= "oddRow";
				}
				
				$packageID        = $packageServStatementData["pId"];
				$entUserId        = $packageServStatementData["entUser"];
				$packageName      = $packageServStatementData["pName"];
				$status           = $packageServStatementData["status"];
				$pi_19            = $packageServStatementData["pi_19"]; 
				$pi_4            = $packageServStatementData["pi_4"]; 
				$pi_5            = $packageServStatementData["pi_5"]; 
				$pi_6            = $packageServStatementData["pi_6"]; 
				
				$packageView .= "<tr class='$class'><td style='font-weight:bold;background:#069;margin-top:20px;color:#ffffff;padding:7px;'><span onclick=\"return ShowHide('viewPackageInformation{$packageID}')\" style='display:block;cursor:pointer'>$pi_4, $pi_5, $pi_6</span></td></tr>";
				$packageQuery = "
								SELECT
										adbs_package.adbPackageName,
										adbs_package.pi_4,
										adbs_package.pi_5,
										adbs_package.pi_6,
										adbs_package.pi_7,
										adbs_package.pi_7a,
										adbs_package.pi_7b,
										adbs_package.pi_7c,
										adbs_package.pi_7d,
										adbs_package.pi_8,
										adbs_package.pi_13,
										adbs_package.pi_14,
										adbs_package.pi_15,
										adbs_package.pi_16,
										adbs_package.pi_17,
										adbs_package.pi_18,
										adbs_package.pi_19,
										adbs_package.entDate
								FROM
										adbs_package
								WHERE
										adbs_package.pId='$packageID'
								ORDER BY
										adbs_package.pId
							  ";
			// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Start Package Information <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<	
			$show    = '';
			$notShow = '';
			if($pi_19 != 'No'){
				$show = "<li><a href='#tabs{$packageID}-2'>PQ Stage</a></li>";
				}
			else{
				$notShow = ' ';
				}					  

				$packageView .= " 
				
									</tr><td style='border:solid 1px #069;'>									
									<div id='viewPackageInformation{$packageID}' style='display:none;'>
									<script>
										$(function() {
										$( '#tabs{$packageID}').tabs();
										});
									</script>
									 <!-- Details main body  -->
										<div id='tabs{$packageID}' style='width:100%px; font-family:Arial, Helvetica, sans-serif; font-size:12px; border: 0;'>
											<ul>
												<li><a href='#tabs{$packageID}-1'>Package Information</a></li>
												$show
												<li><a href='#tabs{$packageID}-3'>BDP Stage</a></li>
												<li><a href='#tabs{$packageID}-4'>Bidding Stage</a></li>
												<li><a href='#tabs{$packageID}-5'>BE Stage</a></li>
												<li><a href='#tabs{$packageID}-6'>Bid Approval Stage</a></li>
												<li><a href='#tabs{$packageID}-7'>Contracting</a></li>
												<li><a href='#tabs{$packageID}-8'>CM Stage</a></li>
												<li><a href='#tabs{$packageID}-9'>CC Stage</a></li>
												<li><a href='#tabs{$packageID}-10'>Others</a></li>
											</ul>
											<!-- Tab 1 Stert  -->
											<div id='tabs{$packageID}-1' >
													<table border='0' width='100%' align='left' cellspacing='1' cellpadding='2' style='font-size:90%;'>";
														$packageStatement	= mysql_query($packageQuery);
														$packageCount 		= mysql_num_rows($packageStatement);
														if($packageCount>0) {
															$mv 						= 1;
															$packageStatement			= mysql_query($packageQuery);
															while($packageStatementData	= mysql_fetch_array($packageStatement)) {
																if($mv%2==0) {
																	$packageClass="evenRow";
																} else {
																	$packageClass="oddRow";
																}
																$adbPackageName         = $packageStatementData["adbPackageName"];
																$pi_4		  			= $packageStatementData["pi_4"];
																$pi_5      				= $packageStatementData["pi_5"];
																$pi_6         			= $packageStatementData["pi_6"];
																$pi_7		 			= $packageStatementData["pi_7"];
																$pi_7a					= $packageStatementData["pi_7a"];
																$pi_7b		            = $packageStatementData["pi_7b"];
																$pi_7c		            = $packageStatementData["pi_7c"];
																$pi_7d					= $packageStatementData["pi_7d"];
																$pi_8                   = $packageStatementData["pi_8"];
																$pi_13                  = $packageStatementData["pi_13"];
																$pi_14                  = $packageStatementData["pi_14"];
																$pi_15                  = $packageStatementData["pi_15"];
																$pi_16                  = $packageStatementData["pi_16"];
																$pi_17                  = $packageStatementData["pi_17"];
																$pi_18                  = $packageStatementData["pi_18"];
																$pi_19                  = $packageStatementData["pi_19"];  
																
															$packageView .= "
																				<tr class='$packageClass'>
																					<td colspan='3' style='text-align:left;background:#ffffff;'>
																					<p style='font-size:17px;'>Package Information:</p>	
																					</td>
																					<td colspan='2' style='text-align:right;background:#ffffff;'>
																						<form action='procurementEdit.php' method='post'>
																							<input type='hidden' name='packageId' value='$packageID'/>
																							<input type='hidden' name='packageName' value='$packageName'/>
																							<input type='submit' name='editSubmitProcurement'  value='Enter Progress'/>
																						</form>
																					</td>
																				</tr>
																				
																				<tr style='background:#DDDDDD;'>
																					<td style='text-align:left;width:20%;padding-left:10px;'> Package No: </td><td style='width: 28%;text-align:left;padding-left:10px;'> $pi_4</td><td style='width:1%; background:#ffffff;'></td>
																					<td style='text-align:left;width:20%;padding-left:10px;'> Lot No:</td><td style='width: 28%;text-align:left;padding-left:10px;'>$pi_5</td>
																					
																				</tr>
																				
																				<tr class='$packageClass'>
																				<td style='text-align:left;width:20%;padding-left:10px;'> Contract Name:</td><td style='width: 28%;text-align:left;padding-left:10px;'> $pi_6</td><td style='width:1%; background:#ffffff;'></td>
																				<td style='text-align:left;width:20%;padding-left:10px;'> Short Description of Contract:</td><td style='width: 28%;text-align:left;padding-left:10px;'> $pi_7</td>

																				</tr>
																				
																				<tr style='background:#DDDDDD;'>
																					<td style='text-align:left;width:20%;padding-left:10px;'>  Unit:</td><td style='width: 28%;text-align:left;padding-left:10px;'> $pi_7a</td><td style='width:1%; background:#ffffff;'></td>
																					<td style='text-align:left;width:20%;padding-left:10px;'> Quantity :</td><td style='width: 28;text-align:left;padding-left:10px;'> $pi_7b</td>
																					
																				</tr>
																				
																				<tr class='$packageClass'>
																				    <td style='text-align:left;width:20%;padding-left:10px;'> Source of Funds :</td><td style='width: 28%;text-align:left;padding-left:10px;'> $pi_7c</td><td style='width:1%; background:#ffffff;'></td>
																								<td style='text-align:left;width:20%;padding-left:10px;'> Cost Estimate (BDT) :</td><td style='width: 28%;text-align:left;padding-left:10px;'> ".number_format($pi_7d,2)."</td>
																				</tr>
																				
																				<tr style='background:#DDDDDD;'>
																					<td style='text-align:left;width:20%;padding-left:10px;'> Cost Estimate (US$) :</td><td style='width: 28%;text-align:left;padding-left:10px;'> ".number_format($pi_8,2)."</td><td style='width:1%; background:#ffffff;'></td>
																					<td style='text-align:left;width:20%;padding-left:10px;'> Procurement Type :</td><td style='width: 28%;text-align:left;padding-left:10px;'>$pi_13</td>
																				</tr>
																				
																				<tr class='$packageClass'>
																				<td style='text-align:left;width:20%;padding-left:10px;'> Procurement Method :</td><td style='width: 28%;text-align:left;padding-left:10px;'> $pi_14</td><td style='width:1%; background:#ffffff;'></td>
																				<td style='text-align:left;width:20%;padding-left:10px;'> Bidding Procedures  :</td><td style='width: 28%;text-align:left;padding-left:10px;'> $pi_15</td>																						
																					   								
																				</tr>
																				
																				<tr style='background:#DDDDDD;'>
													                                 <td style='text-align:left;width:20%;padding-left:10px;'> Applicability of Guidelines :</td><td style='width: 28%;text-align:left;padding-left:10px;'> $pi_16 </td><td style='width:1%; background:#ffffff;'></td>
                                                                                     <td style='text-align:left;width:20%;padding-left:10px;'> Approving Authority :</td><td style='width: 28%;text-align:left;padding-left:10px;'> $pi_17 </td>	
																				</tr>
																				
																				<tr class='$packageClass'>
																					<td style='text-align:left;width:20%;padding-left:10px;'> Prior Review :</td><td style='width: 28%;text-align:left;padding-left:10px;'> $pi_18</td><td style='width:1%; background:#ffffff;'></td>
																					<td style='text-align:left;width:20%;padding-left:10px;'> Prequalification Process :</td><td style='width: 28%;text-align:left;padding-left:10px;'> $pi_19</td>
																				</tr>
																				

																				
																				
																				
																				
																				
																				
																				<tr style='background:#ffffff;'>
																					<td style='text-align:left;width:20%;padding-left:10px;'> &nbsp; </td><td style='width: 28%;text-align:left;padding-left:10px;'> &nbsp; </td><td style='width:1%; background:#ffffff;'></td>
																					<td style='text-align:left;width:20%;padding-left:10px;'> &nbsp; </td><td style='width: 28%;text-align:left;padding-left:10px;'> &nbsp; </td>
																				</tr>							
																				";
																$mv++;
																
															}
														} else {
															$packageView .= "<tr style='background:#F7F4F4'>
																				<td colspan='3' style='text-align:center; color:red;'>No Data Found</td>
																			</tr>";
														}
														$packageView .= "</table>
																		</div>
																		<!--  Tab 1 End  -->";
														$msv++;
	// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> End Package Information<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<				
				
	// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Start PQ Stage <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
	
		$packageQuery = "
								SELECT
										adbs_pqstage.pqs_20,
										adbs_pqstage.pqs_21,
										adbs_pqstage.pqs_22,
										adbs_pqstage.pqs_23,
										adbs_pqstage.pqs_24,
										adbs_pqstage.pqs_25,
										adbs_pqstage.pqs_26,
										adbs_pqstage.pqs_27,
										adbs_pqstage.pqs_28,
										
										adbs_pqstage.pqs_81,
										adbs_pqstage.pqs_82,
										adbs_pqstage.pqs_83,
										adbs_pqstage.pqs_102,
										adbs_pqstage.entDate
								FROM
										adbs_pqstage
								WHERE
										adbs_pqstage.pId='$packageID'
								ORDER BY
										adbs_pqstage.pqsId 
							  ";	
	if($pi_19 != 'No'){
			$packageView .= " 
							<!-- Tab 2 Start -->
                            <div id='tabs{$packageID}-2'>
									<table border='0' width='100%' align='left' cellspacing='1' cellpadding='2' style='font-size:90%;'>";
				$packageStatement	= mysql_query($packageQuery);
				$packageCount 		= mysql_num_rows($packageStatement);
				if($packageCount>0) {
					$mv 						= 1;
					$packageStatement			= mysql_query($packageQuery);
					while($packageStatementData	= mysql_fetch_array($packageStatement)) {
						if($mv%2==0) {
							$packageClass="evenRow";
						} else {
							$packageClass="oddRow";
						}
						
						$pqs_20_null = '';
						$pqs_20_date = '';
						$pqs_20         = $packageStatementData["pqs_20"];
						if ($pqs_20=='0000-00-00'){
							$pqs_20_null = '';
						}
						else{$pqs_20_date = showDateMySQlFormat($packageStatementData["pqs_20"]);}
						
						$pqs_21         = $packageStatementData["pqs_21"];
						$pqs_21_null = '';
						$pqs_21_date = '';
						if ($pqs_21=='0000-00-00'){
							$pqs_21_null = '';
						}
						else{$pqs_21_date = showDateMySQlFormat($packageStatementData["pqs_21"]);}
						
						$pqs_22         = $packageStatementData["pqs_22"];
						$pqs_22_null = '';
						$pqs_22_date = '';
						if ($pqs_22=='0000-00-00'){
							$pqs_22_null = '';
						}
						else{$pqs_22_date = showDateMySQlFormat($packageStatementData["pqs_22"]);}
						
						$pqs_23         = $packageStatementData["pqs_23"];
						$pqs_23_null = '';
						$pqs_23_date = '';
						if ($pqs_23=='0000-00-00'){
							$pqs_23_null = '';
						}
						else{$pqs_23_date = showDateMySQlFormat($packageStatementData["pqs_23"]);}
						
						$pqs_24         = $packageStatementData["pqs_24"];
						$pqs_24_null = '';
						$pqs_24_date = '';
						if ($pqs_24=='0000-00-00'){
							$pqs_24_null = '';
						}
						else{$pqs_24_date = showDateMySQlFormat($packageStatementData["pqs_24"]);}
						
						$pqs_25         = $packageStatementData["pqs_25"];
						$pqs_25_null = '';
						$pqs_25_date = '';
						if ($pqs_25=='0000-00-00'){
							$pqs_25_null = '';
						}
						else{$pqs_25_date = showDateMySQlFormat($packageStatementData["pqs_25"]);}
						
						$pqs_26		    = $packageStatementData["pqs_26"];
						$pqs_26_null = '';
						$pqs_26_date = '';
						if ($pqs_26=='0000-00-00'){
							$pqs_26_null = '';
						}
						else{$pqs_26_date = showDateMySQlFormat($packageStatementData["pqs_26"]);}
						
						$pqs_27         = $packageStatementData["pqs_27"];
						$pqs_27_null = '';
						$pqs_27_date = '';
						if ($pqs_27=='0000-00-00'){
							$pqs_27_null = '';
						}
						else{$pqs_27_date = showDateMySQlFormat($packageStatementData["pqs_27"]);}
						
						$pqs_28         = $packageStatementData["pqs_28"];
						$pqs_28_null = '';
						$pqs_28_date = '';
						if ($pqs_28=='0000-00-00'){
							$pqs_28_null = '';
						}
						else{$pqs_28_date = showDateMySQlFormat($packageStatementData["pqs_28"]);}
						
						$pqs_81		    = $packageStatementData["pqs_81"];
						$pqs_82		    = $packageStatementData["pqs_82"];
						$pqs_83		    = $packageStatementData["pqs_83"];
						$pqs_102        = $packageStatementData["pqs_102"];
						
						
						
						$packageView .= "
										<tr class='$packageClass'>
											<td colspan='3' style='text-align:left;background:#ffffff;'>
												<p style='font-size:17px;'>Pre Qualification Stage Information:</p>	
											</td>
											<td colspan='2' style='text-align:right;background:#ffffff;'>
												<form action='pqStageEdit.php' method='post'>
													<input type='hidden' name='packageId' value='$packageID'/>
													<input type='hidden' name='packageName' value='$packageName'/>
													<input type='submit' name='editSubmitPQStage'  value='Enter Progress'/>
												</form>
											</td>
										</tr>
										
							 			<tr class='$packageClass'>
										<td style='text-align:left;width:30%;padding-left:10px;'> Date of DPQD sent to ADB:</td><td style='width: 18%; text-align:left'> &nbsp; $pqs_20_null $pqs_20_date</td><td style='width:1%; background:#ffffff;'></td>
										<td style='text-align:left;width:30%;padding-left:10px;'> Date of ADB's NO on DPQD:</td><td style='width:18%;text-align:left;'> &nbsp; $pqs_21_null $pqs_21_date </td>
										</tr>
										
										<tr style='background:#DDDDDD;'>
										   <td style='text-align:left;width:30%;padding-left:10px;'> Date of EA's Approval on PQD :</td><td style='width: 18%; text-align:left;padding-left:10px;'> $pqs_22_null $pqs_22_date </td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:30%;padding-left:10px;'> Date of Original PQ Submission Deadline:</td><td style='width: 18%;text-align:left;padding-left:10px;'> $pqs_23_null $pqs_23_date</td><td style='width:1%; background:#ffffff;'></td>
											

										</tr>
										
										<tr class='$packageClass'>
											<td style='text-align:left;width:30%;padding-left:10px;'> Date of Revised PQ Submission Deadline:</td><td style='width: 18%;text-align:left;padding-left:10px;'> $pqs_24_null $pqs_24_date</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:30%;padding-left:10px;'> Date of PQ Evaluation Report:</td><td style='width: 18%;text-align:left;padding-left:10px;'> $pqs_25_null $pqs_25_date</td>
										</tr>
										
										<tr style='background:#DDDDDD;'>
											<td style='text-align:left;width:30%;padding-left:10px;'> Date of PQ Evaluation Report Sent to ADB:</td><td style='width: 18%;text-align:left;padding-left:10px;'> $pqs_26_null $pqs_26_date</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:30%;padding-left:10px;'> Date of ADB's NO on PQ Evaluation Report:</td><td style='width: 18%;text-align:left;padding-left:10px;'> $pqs_27_null $pqs_27_date</td>
										</tr>
										
										<tr class='$packageClass'>
											<td style='text-align:left;width:30%;padding-left:10px;'> Date Notifying PQ Bidders:</td><td style='width: 18%; text-align:left;padding-left:10px;'> $pqs_28_null $pqs_28_date</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:30%;padding-left:10px;'> Number of PQD sold/ Issued:</td><td style='width:18%;text-align:left;padding-left:10px;'> $pqs_81</td>
										</tr>
										
										<tr style='background:#DDDDDD;'>
											<td style='text-align:left;width:30%;padding-left:10px;'>  Number of PQ Applications:</td><td style='width: 18%;text-align:left;padding-left:10px;'> $pqs_82</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:30%;padding-left:10px;'>  Number of Prequalified Bidders:</td><td style='width: 18%;text-align:left;padding-left:10px;'> $pqs_83</td>
										</tr>
										
										<tr class='$packageClass'>
											<td style='text-align:left;width:30%;padding-left:10px;'> Fraud and Corruption Detected by EA (Yes/ No):</td><td style='width: 18%;text-align:left;padding-left:10px;'> $pqs_102</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:30%;padding-left:10px;'> </td><td style='width:18%;text-align:left;padding-left:10px;'></td>
										</tr>
										
										
										
										
										
										
										
										<tr style='background:#ffffff;'>
											<td style='text-align:left;width:20%;padding-left:10px;'> &nbsp; </td><td style='width: 28%;text-align:left;padding-left:10px;'> &nbsp; </td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:20%;padding-left:10px;'> &nbsp; </td><td style='width: 28%;text-align:left;padding-left:10px;'> &nbsp; </td>
										</tr>	
										";
						$mv++;

						}
					}
				 else {
					$packageView .= "
									<tr style='background:#F7F4F4'>
										<td colspan='1' style='text-align:center; color:red;'>&nbsp;</td>
									</tr>
									<tr style='background:#F7F4F4'>
										<td colspan='1' style='text-align:center; color:red;'> 
										<form action='pqStage.php' method='post'>
										<input type='hidden' name='packageId' value='$packageID'/>
										<input type='hidden' name='packageName' value='$packageName'/>
										<input type='submit' name='submitPQStage'  value='No Data Found Insert New Data'/>
										</form>
									</td></tr>";
				 }
				$packageView .= "</table>     
                            </div>
                            <!-- Tab 2 End -->";
				$msv++;
			}
    // >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> End PQ Stage <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<	
	

	
	
	// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Start Bidding Document Preparation Stage <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
	
		$packageQuery = "
								SELECT
										adbs_biddingdocumentpreparationstage.bdps_29,
										adbs_biddingdocumentpreparationstage.bdps_30,
										adbs_biddingdocumentpreparationstage.bdps_31,
										adbs_biddingdocumentpreparationstage.bdps_32
								FROM
										adbs_biddingdocumentpreparationstage
								WHERE
										adbs_biddingdocumentpreparationstage.pId='$packageID'
								ORDER BY
										adbs_biddingdocumentpreparationstage.bdpsId
							  ";	
	
	$packageView .= "<!-- Tab 3 Start -->
						<div id='tabs{$packageID}-3'>
								<table border='0' width='100%' align='left' cellspacing='1' cellpadding='2' style='font-size:90%;'>";
				$packageStatement	= mysql_query($packageQuery);
				$packageCount 		= mysql_num_rows($packageStatement);
				if($packageCount>0) {
					$mv 						= 1;
					$packageStatement			= mysql_query($packageQuery);
					while($packageStatementData	= mysql_fetch_array($packageStatement)) {
						if($mv%2==0) {
							$packageClass="evenRow";
						} else {
							$packageClass="oddRow";
						}
						$bdps_29         = $packageStatementData["bdps_29"];
						$bdps_29_null = '';
						$bdps_29_date = '';
						if ($bdps_29=='0000-00-00'){
							$bdps_29_null = '';
						}
						else{$bdps_29_date = showDateMySQlFormat($packageStatementData["bdps_29"]);}
						
						$bdps_30         = $packageStatementData["bdps_30"];
						$bdps_30_null = '';
						$bdps_30_date = '';
						if ($bdps_30=='0000-00-00'){
							$bdps_30_null = '';
						}
						else{$bdps_30_date = showDateMySQlFormat($packageStatementData["bdps_30"]);}
						
						$bdps_31         = $packageStatementData["bdps_31"];
						$bdps_31_null = '';
						$bdps_31_date = '';
						if ($bdps_31=='0000-00-00'){
							$bdps_31_null = '';
						}
						else{$bdps_31_date = showDateMySQlFormat($packageStatementData["bdps_31"]);}
						
						$bdps_32         = $packageStatementData["bdps_32"];
						$bdps_32_null = '';
						$bdps_32_date = '';
						if ($bdps_32=='0000-00-00'){
							$bdps_32_null = '';
						}
						else{$bdps_32_date = showDateMySQlFormat($packageStatementData["bdps_32"]);}

						$packageView .= "
										<tr class='$packageClass'>
											<td colspan='3' style='text-align:left;background:#ffffff;'>
												<p style='font-size:17px;'>Bidding Document Preparation Stage Information:</p>	
											</td>

											<td colspan='2' style='text-align:right;background:#ffffff;'>
												<form action='biddingDPStageEdit.php' method='post'>
													<input type='hidden' name='packageId' value='$packageID'/>
													<input type='hidden' name='packageName' value='$packageName'/>
													<input type='submit' name='editSubmitBiddingDPStage'  value='Enter Progress'/>
												</form>
											</td>
										</tr>
										<tr class='$packageClass'>
											<td style='text-align:left;width:30%;padding-left:10px;'> Date of DBD sent to ADB :</td><td style='width: 18%; text-align:left;padding-left:10px;'> $bdps_29_null $bdps_29_date</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:30%;padding-left:10px;'> Date of ADB's NO on DBD :</td><td style='width: 18%; text-align:left;padding-left:10px;'>  $bdps_30_null $bdps_30_date</td><td style='width:1%; background:#ffffff;'></td>
											
										</tr>
										<tr style='background:#DDDDDD;'>
											<td style='text-align:left;width:30%;padding-left:10px;'>Date of EA's Approval on BD : </td><td style='width: 18%; text-align:left;padding-left:10px;'> $bdps_31_null $bdps_31_date</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:30%;padding-left:10px;'>Date of BD/ 1st Stage BD Availability : </td><td style='width: 18%;text-align:left;padding-left:10px;'> $bdps_32_null $bdps_32_date </td>
										</tr>
										
			
			
			
			
			
										<tr style='background:#ffffff;'>
											<td style='text-align:left;width:20%;padding-left:10px;'> &nbsp; </td><td style='width: 28%;text-align:left;padding-left:10px;'> &nbsp; </td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:20%;padding-left:10px;'> &nbsp; </td><td style='width: 28%;text-align:left;padding-left:10px;'> &nbsp; </td>
										</tr>	
									
										";
						$mv++;
						
					}
				} else {
					$packageView .= "
									<tr style='background:#F7F4F4'>
										<td colspan='1' style='text-align:center; color:red;'>&nbsp;</td>
									</tr>
									<tr style='background:#F7F4F4'>
										<td colspan='1' style='text-align:center; color:red;'> 
										<form action='biddingDPStage.php' method='post'>
										<input type='hidden' name='packageId' value='$packageID'/>
										<input type='hidden' name='packageName' value='$packageName'/>
										<input type='submit' name='submitBiddingDPStage'  value='No Data Found Insert New Data'/>
										</form>
									</td></tr>";
				}
				$packageView .= "</table>  
                            </div>
                            <!--  Tab 3 End -->";
				$msv++;
			
    // >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> End Bidding Document Preparation Stage <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
	
		
	
	// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Start Bidding / Proposal Stage <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
	
		$packageQuery = "
								SELECT
										adbs_biddingproposalstage.bps_38,
										adbs_biddingproposalstage.bps_38a,
										adbs_biddingproposalstage.bps_39,
										adbs_biddingproposalstage.bps_40,
										adbs_biddingproposalstage.bps_41,
										adbs_biddingproposalstage.bps_42,
										adbs_biddingproposalstage.bps_43,
										adbs_biddingproposalstage.bps_44,
										adbs_biddingproposalstage.bps_45,
										adbs_biddingproposalstage.bps_46,
										adbs_biddingproposalstage.bps_48,
										adbs_biddingproposalstage.bps_49,
										adbs_biddingproposalstage.bps_84,
										adbs_biddingproposalstage.bps_90,
										adbs_biddingproposalstage.bps_91,
										adbs_biddingproposalstage.bps_92,
										adbs_biddingproposalstage.entDate
								FROM
										adbs_biddingproposalstage
								WHERE
										adbs_biddingproposalstage.pId='$packageID'
								ORDER BY
										adbs_biddingproposalstage.bps_42
							  ";	
	
		$packageView .= " <!-- Tab 4 Start -->
                            <div id='tabs{$packageID}-4'>		
									<table border='0' width='100%' align='left' cellspacing='1' cellpadding='2' style='font-size:90%;'>";
				$packageStatement	= mysql_query($packageQuery);
				$packageCount 		= mysql_num_rows($packageStatement);
				if($packageCount>0) {
					$mv 						= 1;
					$packageStatement			= mysql_query($packageQuery);
					while($packageStatementData	= mysql_fetch_array($packageStatement)) {
						
						if($mv%2==0) {
							$packageClass="evenRow";
						} else {
							$packageClass="oddRow";
						}
						
						$bps_38        = $packageStatementData["bps_38"];
						$bps_38_null = '';
						$bps_38_date = '';
						if ($bps_38=='0000-00-00'){
							$bps_38_null = '';
						}
						else{$bps_38_date = showDateMySQlFormat($packageStatementData["bps_38"]);}
						
						$bps_38a        = $packageStatementData["bps_38a"];
						$bps_38a_null = '';
						$bps_38a_date = '';
						if ($bps_38a=='0000-00-00'){
							$bps_38a_null = '';
						}
						else{$bps_38a_date = showDateMySQlFormat($packageStatementData["bps_38a"]);}
						
						$bps_39        = $packageStatementData["bps_39"];
						$bps_39_null = '';
						$bps_39_date = '';
						if ($bps_39=='0000-00-00'){
							$bps_39_null = '';
						}
						else{$bps_39_date = showDateMySQlFormat($packageStatementData["bps_39"]);}
						
						$bps_40		   = $packageStatementData["bps_40"];
						$bps_40_null = '';
						$bps_40_date = '';
						if ($bps_40=='0000-00-00'){
							$bps_40_null = '';
						}
						else{$bps_40_date = showDateMySQlFormat($packageStatementData["bps_40"]);}
						
						$bps_41        = $packageStatementData["bps_41"];
						$bps_41_null = '';
						$bps_41_date = '';
						if ($bps_41=='0000-00-00'){
							$bps_41_null = '';
						}
						else{$bps_41_date = showDateMySQlFormat($packageStatementData["bps_41"]);}
						
						$bps_42        = $packageStatementData["bps_42"];
						$bps_42_null = '';
						$bps_42_date = '';
						if ($bps_42=='0000-00-00'){
							$bps_42_null = '';
						}
						else{$bps_42_date = showDateMySQlFormat($packageStatementData["bps_42"]);}
						
						$bps_43        = $packageStatementData["bps_43"];
						$bps_43_null = '';
						$bps_43_date = '';
						if ($bps_43=='0000-00-00'){
							$bps_43_null = '';
						}
						else{$bps_43_date = showDateMySQlFormat($packageStatementData["bps_43"]);}
						
						$bps_44		   = $packageStatementData["bps_44"];
						$bps_44_null = '';
						$bps_44_date = '';
						if ($bps_44=='0000-00-00'){
							$bps_44_null = '';
						}
						else{$bps_44_date = showDateMySQlFormat($packageStatementData["bps_44"]);}
						
						$bps_45        = $packageStatementData["bps_45"];
						$bps_45_null = '';
						$bps_45_date = '';
						if ($bps_45=='0000-00-00'){
							$bps_45_null = '';
						}
						else{$bps_45_date = showDateMySQlFormat($packageStatementData["bps_45"]);}
						
						$bps_46        = $packageStatementData["bps_46"];
						$bps_46_null = '';
						$bps_46_date = '';
						if ($bps_46=='0000-00-00'){
							$bps_46_null = '';
						}
						else{$bps_46_date = showDateMySQlFormat($packageStatementData["bps_46"]);}
						
						$bps_48		   = $packageStatementData["bps_48"];
						$bps_48_null = '';
						$bps_48_date = '';
						if ($bps_48=='0000-00-00'){
							$bps_48_null = '';
						}
						else{$bps_48_date = showDateMySQlFormat($packageStatementData["bps_48"]);}
						
						$bps_49        = $packageStatementData["bps_49"];
						$bps_49_null = '';
						$bps_49_date = '';
						if ($bps_49=='0000-00-00'){
							$bps_49_null = '';
						}
						else{$bps_49_date = showDateMySQlFormat($packageStatementData["bps_49"]);}
						
						$bps_84        = $packageStatementData["bps_84"];
						$bps_90		   = $packageStatementData["bps_90"];
						$bps_91        = $packageStatementData["bps_91"];
						$bps_92		   = $packageStatementData["bps_92"];
						
						$packageView .= "
										<tr class='$packageClass'>
										<td colspan='3' style='text-align:left;background:#ffffff;'>
												<p style='font-size:17px;'>Bidding/Proposal Stage Information:</p>	
											</td>
											<td colspan='2' style='text-align:right;background:#ffffff;'>
												<form action='biddingProposalStageEdit.php' method='post'>
													<input type='hidden' name='packageId' value='$packageID'/>
													<input type='hidden' name='packageName' value='$packageName'/>
													<input type='submit' name='editSubmitBiddingProposalStage'  value='Enter Progress'/>
												</form>
											</td>
										</tr>
										<tr class='$packageClass'>
											<td style='text-align:left;width:35%;padding-left:10px;'> Date Inviting Bids from PQ Bidders:</td><td style='width: 13%; text-align:left;padding-left:10px;'> $bps_38_null $bps_38_date</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'>Actual Date of Procurement Notice (PQ/ IFB) Published in National Newspapers (Bangla):</td><td style='width:13%;text-align:left;padding-left:10px;'> $bps_39_null $bps_39_date</td>
										</tr>
										
										<tr style='background:#DDDDDD;'>
											<td style='text-align:left;width:35%;padding-left:10px;'> Date of Procurement Notice (PQ/ IFB) Published in National Newspapers (English):</td><td style='width: 13%;text-align:left;padding-left:10px;'>$bps_40_null $bps_40_date</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'> Date of Procurement Notice (PQ/ IFB) Published in CPTU Website:</td><td style='width: 13%;text-align:left;padding-left:10px;'> $bps_41_null $bps_41_date</td>
										</tr>
										
										<tr class='$packageClass'>
											<td style='text-align:left;width:35%;padding-left:10px;'> Date of Procurement Notice (PQ/ IFB) Published in ADB Website	:</td><td style='width: 13%;text-align:left;padding-left:10px;'> $bps_42_null $bps_42_date</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'> Date of Pre-bid Conference Held :</td><td style='width: 13%;text-align:left;padding-left:10px;'> $bps_43_null $bps_43_date</td>
										</tr>
										
										<tr style='background:#DDDDDD;'>
											<td style='text-align:left;width:35%;padding-left:10px;'> Date of Pre-bid Meeting Minutes Sent to ADB:</td><td style='width: 13%;text-align:left;padding-left:10px;'> $bps_44_null $bps_44_date</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'> Date of ADB's NO on Pre-bid Meeting Minutes:</td><td style='width: 13%;text-align:left;padding-left:10px;'> $bps_45_null $bps_45_date</td>
										</tr>
										
										<tr class='$packageClass'>
											<td style='text-align:left;width:35%;padding-left:10px;'> Date of Pre-bid Meeting Minutes Sent to Bidders:</td><td style='width: 13%; text-align:left;padding-left:10px;'> $bps_46_null $bps_46_date</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'> Date of Original BSD:</td><td style='width:13%;text-align:left;padding-left:10px;'> $bps_48_null $bps_48_date</td>
										</tr>
										
										<tr style='background:#DDDDDD;'>
											<td style='text-align:left;width:35%;padding-left:10px;'> Date of Revised BSD:</td><td style='width: 13%;text-align:left;padding-left:10px;'> $bps_49_null $bps_49_date</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'> Number of BD Sold/ Issued:</td><td style='width: 13%;text-align:left;padding-left:10px;'> $bps_84</td>
										</tr>
										
										<tr class='$packageClass'>
											<td style='text-align:left;width:35%;padding-left:10px;'> Number of Amendments for BD:</td><td style='width: 13%;text-align:left;padding-left:10px;'> $bps_90</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'> Number of Amendments for Technical Specifications:</td><td style='width: 13%;text-align:left;padding-left:10px;'> $bps_91</td>
										</tr>
										
										<tr style='background:#DDDDDD;'>
											<td style='text-align:left;width:35%;padding-left:10px;'> Original Bid Validity Period (days):</td><td style='width: 13%;text-align:left;padding-left:10px;'> $bps_92</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'> Planned Date of Procurement Notice:</td><td style='width: 13%; text-align:left;padding-left:10px;'> $bps_38a_null $bps_38a_date</td><td style='width:1%; background:#ffffff;'></td>

										</tr>
										
									
									
									
									
									
										<tr style='background:#ffffff;'>
											<td style='text-align:left;width:20%;padding-left:10px;'> &nbsp; </td><td style='width: 28%;text-align:left;padding-left:10px;'> &nbsp; </td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:20%;padding-left:10px;'> &nbsp; </td><td style='width: 28%;text-align:left;padding-left:10px;'> &nbsp; </td>
										</tr>	
									
										";
						$mv++;
						
					}
				} else {
					$packageView .= "
									<tr style='background:#F7F4F4'>
										<td colspan='1' style='text-align:center; color:red;'>&nbsp;</td>
									</tr>
									<tr style='background:#F7F4F4'>
										<td colspan='1' style='text-align:center; color:red;'> 
										<form action='biddingProposalStage.php' method='post'>
										<input type='hidden' name='packageId' value='$packageID'/>
										<input type='hidden' name='packageName' value='$packageName'/>
										<input type='submit' name='biddingProposalStageSubmit'  value='No Data Found Insert New Data'/>
										</form>
									</td></tr>";				
				}
				$packageView .= "</table>
									</div>
									<!--  Tab 4 End -->";
				$msv++;
			
    // >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> End Bidding / Proposal Stage <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
	
	
	// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Start Bid / Proposal Evaluation Stage <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
	
		$packageQuery = "
								SELECT
										adbs_bidproposalevaluationstage.bpes_50,
										adbs_bidproposalevaluationstage.bpes_51,
										adbs_bidproposalevaluationstage.bpes_52,
										adbs_bidproposalevaluationstage.bpes_53,
										adbs_bidproposalevaluationstage.bpes_54,
										adbs_bidproposalevaluationstage.bpes_54a,
										adbs_bidproposalevaluationstage.bpes_55,
										adbs_bidproposalevaluationstage.bpes_56,
										adbs_bidproposalevaluationstage.bpes_85,
										adbs_bidproposalevaluationstage.bpes_86,
										adbs_bidproposalevaluationstage.bpes_87,
										adbs_bidproposalevaluationstage.bpes_93,
										adbs_bidproposalevaluationstage.bpes_94,
										adbs_bidproposalevaluationstage.bpes_97,
										adbs_bidproposalevaluationstage.bpes_98,
										adbs_bidproposalevaluationstage.bpes_100,
										adbs_bidproposalevaluationstage.bpes_101,
										adbs_bidproposalevaluationstage.bpes_102,
										adbs_bidproposalevaluationstage.bpes_103,
										adbs_bidproposalevaluationstage.bpes_112,
										adbs_bidproposalevaluationstage.entDate
								FROM
										adbs_bidproposalevaluationstage
								WHERE
										adbs_bidproposalevaluationstage.pId='$packageID'
								ORDER BY
										adbs_bidproposalevaluationstage.bpes_50
							  ";	
	
		$packageView .= " <!-- Tab 5 Start -->
                            <div id='tabs{$packageID}-5'>
									<table border='0' width='100%' align='left' cellspacing='1' cellpadding='2' style='font-size:90%;'>";
				$packageStatement	= mysql_query($packageQuery);
				$packageCount 		= mysql_num_rows($packageStatement);
				if($packageCount>0) {
					$mv 						= 1;
					$packageStatement			= mysql_query($packageQuery);
					while($packageStatementData	= mysql_fetch_array($packageStatement)) {
						if($mv%2==0) {
							$packageClass="evenRow";
						} else {
							$packageClass="oddRow";
						}
						$bpes_50        = $packageStatementData["bpes_50"];
						$bpes_50_null = '';
						$bpes_50_date = '';
						if ($bpes_50=='0000-00-00'){
							$bpes_50_null = '';
						}
						else{$bpes_50_date = showDateMySQlFormat($packageStatementData["bpes_50"]);}
						
						$bpes_51        = $packageStatementData["bpes_51"];
						$bpes_52		= $packageStatementData["bpes_52"];
						$bpes_53        = $packageStatementData["bpes_53"];
						$bpes_54        = $packageStatementData["bpes_54"];
						
						$bpes_54a        = $packageStatementData["bpes_54a"];
						$bpes_54a_null = '';
						$bpes_54a_date = '';
						if ($bpes_54a=='0000-00-00'){
							$bpes_54a_null = '';
						}
						else{$bpes_54a_date = showDateMySQlFormat($packageStatementData["bpes_54a"]);}
						
						$bpes_55        = $packageStatementData["bpes_55"];
						$bpes_56	    = $packageStatementData["bpes_56"];
						$bpes_56_null = '';
						$bpes_56_date = '';
						if ($bpes_56=='0000-00-00'){
							$bpes_56_null = '';
						}
						else{$bpes_56_date = showDateMySQlFormat($packageStatementData["bpes_56"]);}
						
						$bpes_85        = $packageStatementData["bpes_85"];
						$bpes_86        = $packageStatementData["bpes_86"];
						$bpes_87        = $packageStatementData["bpes_87"];
						$bpes_93		= $packageStatementData["bpes_93"];
						$bpes_94        = $packageStatementData["bpes_94"];
						$bpes_97        = $packageStatementData["bpes_97"];
						$bpes_98		= $packageStatementData["bpes_98"];
						$bpes_100       = $packageStatementData["bpes_100"];
						$bpes_101       = $packageStatementData["bpes_101"];
						$bpes_102       = $packageStatementData["bpes_102"];
						$bpes_103		= $packageStatementData["bpes_103"];
						$bpes_112       = $packageStatementData["bpes_112"];
						
						$packageView .= "
										<tr class='$packageClass'>
											<td colspan='3' style='text-align:left;background:#ffffff;'>
												<p style='font-size:17px;'>Bid/Proposal Evalution Stage Information:</p>	
											</td>
											<td colspan='2' style='text-align:right;background:#ffffff;'>
												<form action='biddingProposalEvaluationStageEdit.php' method='post'>
													<input type='hidden' name='packageId' value='$packageID'/>
													<input type='hidden' name='packageName' value='$packageName'/>
													<input type='submit' name='editSubmitBiddingEvaluationlStage'  value='Enter Progress'/>
												</form>
											</td>
										</tr>
										
										<tr class='$packageClass'>
											<td style='text-align:left;width:35%;padding-left:10px;'> Date of Bids Opening :</td><td style='width: 13%; text-align:left;padding-left:10px;'> $bpes_50_null $bpes_50_date</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'> Date of BER :</td><td style='width:13%;text-align:left;padding-left:10px;'> $bpes_56_null $bpes_56_date</td>
										</tr>
										
										<tr style='background:#DDDDDD;'>
											<td style='text-align:left;width:35%;padding-left:10px;'> Number of Bids Received:</td><td style='width: 13%;text-align:left;padding-left:10px;'> $bpes_85</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'> Number of Responsive Bids:</td><td style='width: 13%;text-align:left;padding-left:10px;'> $bpes_86</td>
										</tr>
										
										<tr class='$packageClass'>
											<td style='text-align:left;width:35%;padding-left:10px;'> BOS Sent to ADB (Yes/ No):</td><td style='width: 13%;text-align:left;padding-left:10px;'> $bpes_87</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'> Revised  Bid Validity Period (days):</td><td style='width: 13%;text-align:left;padding-left:10px;'> $bpes_93</td>
										</tr>
										
										<tr style='background:#DDDDDD;'>
											<td style='text-align:left;width:35%;padding-left:10px;'> Number of Extension of Bid Validity Period:</td><td style='width: 13%;text-align:left;padding-left:10px;'> $bpes_94</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'> 1st Ranked Bidder's Evaluated Bid Price (Equiv. US$):</td><td style='width: 13%;text-align:left;padding-left:10px;'>".number_format($bpes_97,2)."</td>
										</tr>
										
										<tr class='$packageClass'>
											<td style='text-align:left;width:35%;padding-left:10px;'> 2nd Ranked Bidder's Evaluated Bid Price (Equiv. US$):</td><td style='width: 13%; text-align:left;padding-left:10px;'>".number_format($bpes_98,2)."</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'> Confidentiality Provision Maintained in Bid Evaluation (Yes/ No):</td><td style='width:13%;text-align:left;padding-left:10px;'> $bpes_100</td>
										</tr>
										
										<tr style='background:#DDDDDD;'>
											<td style='text-align:left;width:35%;padding-left:10px;'> Short Description of F&C Detected:</td><td style='width: 13%;text-align:left;padding-left:10px;'> $bpes_103</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'> Planned Date of Bids Opening :</td><td style='width:13%;text-align:left;padding-left:10px;'> $bpes_54a_null $bpes_54a_date</td>

										</tr>
										
					
					
					
					
					
										<tr style='background:#ffffff;'>
											<td style='text-align:left;width:20%;padding-left:10px;'> &nbsp; </td><td style='width: 28%;text-align:left;padding-left:10px;'> &nbsp; </td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:20%;padding-left:10px;'> &nbsp; </td><td style='width: 28%;text-align:left;padding-left:10px;'> &nbsp; </td>
										</tr>	
									
										";
						$mv++;
						
					}
				} else {
					$packageView .= "
									<tr style='background:#F7F4F4'>
										<td colspan='1' style='text-align:center; color:red;'>&nbsp;</td>
									</tr>
									<tr style='background:#F7F4F4'>
										<td colspan='1' style='text-align:center; color:red;'> 
										<form action='bidProposalEvaluationStage.php' method='post'>
										<input type='hidden' name='packageId' value='$packageID'/>
										<input type='hidden' name='packageName' value='$packageName'/>
										<input type='submit' name='bidProposalEvaluationStageSubmit'  value='No Data Found Insert New Data'/>
										</form>
									</td></tr>";	
				}
				$packageView .= "</table>
                            </div>
                            <!--  Tab 5 End -->";
				$msv++;
			
    // >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> End Bid / Proposal Evaluation Stage <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
	
	
	// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Start Evaluation Report Approval Stage <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
	
		$packageQuery = "
								SELECT
										adbs_evaluationreportapprovalstage.eras_57,
										adbs_evaluationreportapprovalstage.eras_58,
										adbs_evaluationreportapprovalstage.eras_59,
										adbs_evaluationreportapprovalstage.eras_60,
										adbs_evaluationreportapprovalstage.eras_60a,
										adbs_evaluationreportapprovalstage.eras_61,
										adbs_evaluationreportapprovalstage.eras_62,
										adbs_evaluationreportapprovalstage.eras_62a,
										adbs_evaluationreportapprovalstage.eras_63,
										adbs_evaluationreportapprovalstage.eras_95,
										adbs_evaluationreportapprovalstage.eras_96,
										adbs_evaluationreportapprovalstage.eras_99,
										adbs_evaluationreportapprovalstage.eras_101,
										adbs_evaluationreportapprovalstage.entDate
								FROM
										adbs_evaluationreportapprovalstage
								WHERE
										adbs_evaluationreportapprovalstage.pId='$packageID'
								ORDER BY
										adbs_evaluationreportapprovalstage.erasId
							  ";	
	
		$packageView .= " <!-- Tab 6 Start -->
                            <div id='tabs{$packageID}-6'>
									<table border='0' width='100%' align='left' cellspacing='1' cellpadding='2' style='font-size:90%;'>";
				$packageStatement	= mysql_query($packageQuery);
				$packageCount 		= mysql_num_rows($packageStatement);
				if($packageCount>0) {
					$mv 						= 1;
					$packageStatement			= mysql_query($packageQuery);
					while($packageStatementData	= mysql_fetch_array($packageStatement)) {
						if($mv%2==0) {
							$packageClass="evenRow";
						} else {
							$packageClass="oddRow";
						}
						
						$eras_60a        = $packageStatementData["eras_60a"];
						$eras_60a_null = '';
						$eras_60a_date = '';
						if ($eras_60a=='0000-00-00'){
							$eras_60a_null = '';
						}
						else{$eras_60a_date = showDateMySQlFormat($packageStatementData["eras_60a"]);}
						
						$eras_61        = $packageStatementData["eras_61"];
						$eras_61_null = '';
						$eras_61_date = '';
						if ($eras_61=='0000-00-00'){
							$eras_61_null = '';
						}
						else{$eras_61_date = showDateMySQlFormat($packageStatementData["eras_61"]);}
						
						$eras_62        = $packageStatementData["eras_62"];
						$eras_62_null = '';
						$eras_62_date = '';
						if ($eras_62=='0000-00-00'){
							$eras_62_null = '';
						}
						else{$eras_62_date = showDateMySQlFormat($packageStatementData["eras_62"]);}
						
						$eras_62a        = $packageStatementData["eras_62a"];
						$eras_62a_null = '';
						$eras_62a_date = '';
						if ($eras_62a=='0000-00-00'){
							$eras_62a_null = '';
						}
						else{$eras_62a_date = showDateMySQlFormat($packageStatementData["eras_62a"]);}
						
						$eras_63        = $packageStatementData["eras_63"];
						$eras_63_null = '';
						$eras_63_date = '';
						if ($eras_63=='0000-00-00'){
							$eras_63_null = '';
						}
						else{$eras_63_date = showDateMySQlFormat($packageStatementData["eras_63"]);}
						
						$eras_95	    = $packageStatementData["eras_95"];
						
						$eras_96        = $packageStatementData["eras_96"];
						$eras_99        = $packageStatementData["eras_99"];
						$eras_101        = $packageStatementData["eras_101"];
						
						$packageView .= "
										<tr class='$packageClass'>
										<td colspan='3' style='text-align:left;background:#ffffff;'>
												<p style='font-size:17px;'>Evaluation Report Approval Stage Information:</p>	
											</td>
											<td colspan='2' style='text-align:right;background:#ffffff;'>
												<form action='evaluationReportApprovalStageEdit.php' method='post'>
													<input type='hidden' name='packageId' value='$packageID'/>
													<input type='hidden' name='packageName' value='$packageName'/>
													<input type='submit' name='editSubmitEvaluationReportApprovalStage'  value='Enter Progress'/>
												</form>
											</td>
										</tr>
										
										<tr class='$packageClass'>
											<td style='text-align:left;width:35%;padding-left:10px;'>Actual Date of BER Sent to ADB :</td><td style='width: 13%; text-align:left;padding-left:10px;'>  $eras_61_null $eras_61_date</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'> Date of ADB's NO on BER :</td><td style='width:13%;text-align:left;padding-left:10px;'> $eras_62_null $eras_62_date</td>
										</tr>
										
										<tr style='background:#DDDDDD;'>
											<td style='text-align:left;width:35%;padding-left:10px;'> Times of Clarification Sought by ADB and/or Approving Authority on BER/ TBER/FBER:</td><td style='width: 13%;text-align:left;padding-left:10px;'> $eras_95</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'> Number of Revision of BER/ TBER/ FBER Sought by ADB and/or Approving Authority:</td><td style='width: 13%;text-align:left;padding-left:10px;'> $eras_96</td>
										</tr>
										
										<tr class='$packageClass'>
											<td style='text-align:left;width:35%;padding-left:10px;'> NOA in Favour of 1st Ranked Bidder (Yes/ No):</td><td style='width: 13%;text-align:left;padding-left:10px;'> $eras_99</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'> Number of Complaints Received by EA:</td><td style='width: 13%;text-align:left;padding-left:10px;'> $eras_101</td>
										</tr>
										
										<tr style='background:#DDDDDD;'>
											<td style='text-align:left;width:35%;padding-left:10px;'> Planned Date of BER Sent to ADB:</td><td style='width: 13%;text-align:left;padding-left:10px;'> $eras_60a_null $eras_60a_date</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'> Planned Date of EA's Approval on BER (all):</td><td style='width: 13%;text-align:left;padding-left:10px;'> $eras_62a_null $eras_62a_date</td>
										</tr>

									
									
									
									
									
									
										<tr style='background:#ffffff;'>
											<td style='text-align:left;width:20%;padding-left:10px;'> &nbsp; </td><td style='width: 28%;text-align:left;padding-left:10px;'> &nbsp; </td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:20%;padding-left:10px;'> &nbsp; </td><td style='width: 28%;text-align:left;padding-left:10px;'> &nbsp; </td>
										</tr>	
										";
						$mv++;
						
					}
				} else {
					$packageView .= "
									<tr style='background:#F7F4F4'>
										<td colspan='1' style='text-align:center; color:red;'>&nbsp;</td>
									</tr>
									<tr style='background:#F7F4F4'>
										<td colspan='1' style='text-align:center; color:red;'> 
										<form action='evaluationReportApprovalStage.php' method='post'>
										<input type='hidden' name='packageId' value='$packageID'/>
										<input type='hidden' name='packageName' value='$packageName'/>
										<input type='submit' name='evaluationPASsubmit'  value='No Data Found Insert New Data'/>
										</form>
									</td></tr>";
				}
				$packageView .= "</table>
                            </div>
                            <!--  Tab 6 End -->";
				$msv++;
			
    // >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> End Evaluation Report Approval Stage <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
	
	
	// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Start Contracting Stage <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
	
		$packageQuery = "
								SELECT
										adbs_contractingstage.cs_63a,
										adbs_contractingstage.cs_64,
										adbs_contractingstage.cs_65,
										adbs_contractingstage.cs_66,
										adbs_contractingstage.cs_67,
										adbs_contractingstage.cs_67a,
										adbs_contractingstage.cs_68,
										adbs_contractingstage.cs_69,
										adbs_contractingstage.cs_70,
										adbs_contractingstage.cs_9,
										adbs_contractingstage.cs_11,
										adbs_contractingstage.cs_72,
										adbs_contractingstage.cs_104,
										adbs_contractingstage.cs_105,
										adbs_contractingstage.cs_106,
										adbs_contractingstage.cs_113,
										adbs_contractingstage.entDate
								FROM
										adbs_contractingstage
								WHERE
										adbs_contractingstage.pId='$packageID'
								ORDER BY
										adbs_contractingstage.csId
							  ";	
	
		$packageView .= "<!-- Tab 7 Start -->
                            <div id='tabs{$packageID}-7'>
									<table border='0' width='100%' align='left' cellspacing='1' cellpadding='2' style='font-size:90%;'>";
				$packageStatement	= mysql_query($packageQuery);
				$packageCount 		= mysql_num_rows($packageStatement);
				if($packageCount>0) {
					$mv 						= 1;
					$packageStatement			= mysql_query($packageQuery);
					while($packageStatementData	= mysql_fetch_array($packageStatement)) {
						if($mv%2==0) {
							$packageClass="evenRow";
						} else {
							$packageClass="oddRow";
						}
						$cs_63a         = $packageStatementData["cs_63a"];
						$cs_63a_null = '';
						$cs_63a_date = '';
						if ($cs_63a=='0000-00-00'){
							$cs_63a_null = '';
						}
						else{$cs_63a_date = showDateMySQlFormat($packageStatementData["cs_63a"]);}
						
						$cs_64         = $packageStatementData["cs_64"];
						$cs_64_null = '';
						$cs_64_date = '';
						if ($cs_64=='0000-00-00'){
							$cs_64_null = '';
						}
						else{$cs_64_date = showDateMySQlFormat($packageStatementData["cs_64"]);}
						
						$cs_65         = $packageStatementData["cs_65"];
						
						$cs_66         = $packageStatementData["cs_66"];
						$cs_66_null = '';
						$cs_66_date = '';
						if ($cs_66=='0000-00-00'){
							$cs_66_null = '';
						}
						else{$cs_66_date = showDateMySQlFormat($packageStatementData["cs_66"]);}
						
						$cs_67         = $packageStatementData["cs_67"];
						
						$cs_67a         = $packageStatementData["cs_67a"];
						$cs_67a_null = '';
						$cs_67a_date = '';
						if ($cs_67a=='0000-00-00'){
							$cs_67a_null = '';
						}
						else{$cs_67a_date = showDateMySQlFormat($packageStatementData["cs_67a"]);}
						
						$cs_68         = $packageStatementData["cs_68"];
						$cs_68_null = '';
						$cs_68_date = '';
						if ($cs_68=='0000-00-00'){
							$cs_68_null = '';
						}
						else{$cs_68_date = showDateMySQlFormat($packageStatementData["cs_68"]);}
						
						$cs_69         = $packageStatementData["cs_69"];
						$cs_69_null = '';
						$cs_69_date = '';
						if ($cs_69=='0000-00-00'){
							$cs_69_null = '';
						}
						else{$cs_69_date = showDateMySQlFormat($packageStatementData["cs_69"]);}
						
						$cs_70		  = $packageStatementData["cs_70"];
						$cs_70_null = '';
						$cs_70_date = '';
						if ($cs_70=='0000-00-00'){
							$cs_70_null = '';
						}
						else{$cs_70_date = showDateMySQlFormat($packageStatementData["cs_70"]);}
						
						$cs_9         = $packageStatementData["cs_9"];
						$cs_11         = $packageStatementData["cs_11"];
						
						$cs_72		  = $packageStatementData["cs_72"];
						$cs_72_null = '';
						$cs_72_date = '';
						if ($cs_72=='0000-00-00'){
							$cs_72_null = '';
						}
						else{$cs_72_date = showDateMySQlFormat($packageStatementData["cs_72"]);}
						
						$cs_104		  = $packageStatementData["cs_104"];
						$cs_105        = $packageStatementData["cs_105"];
						$cs_106       = $packageStatementData["cs_106"];
						$cs_113		  = $packageStatementData["cs_113"];
						
						$packageView .= "
										<tr class='$packageClass'>
											<td colspan='3' style='text-align:left;background:#ffffff;'>
												<p style='font-size:17px;'>Contracting Stage Information:</p>	
											</td>
											<td colspan='2' style='text-align:right;background:#ffffff;'>
												<form action='contractingStageEdit.php' method='post'>
													<input type='hidden' name='packageId' value='$packageID'/>
													<input type='hidden' name='packageName' value='$packageName'/>
													<input type='submit' name='editSubmitContractingStage'  value='Enter Progress'/>
												</form>
											</td>
										</tr>
										
										<tr class='$packageClass'>
											<td style='text-align:left;width:35%;padding-left:10px;'> Original Contract Price in Contract Currency or Currencies:</td><td style='width: 13%; text-align:left;padding-left:10px;'> ".number_format($cs_9,2)."</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'> Original Contract Price (Equiv. US$:</td><td style='width:13%;text-align:left;padding-left:10px;'>".number_format($cs_11,2)."</td>
										</tr>
										
										<tr style='background:#DDDDDD;'>
											<td style='text-align:left;width:35%;padding-left:10px;'> Planned Date of NOA Issued to Successful Bidder:</td><td style='width: 13%;text-align:left;padding-left:10px;'> $cs_63a_null $cs_63a_date</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'> Actual Date of NOA Issued to Successful Bidder:</td><td style='width: 13%;text-align:left;padding-left:10px;'> $cs_64_null $cs_64_date </td><td style='width:1%; background:#ffffff;'></td>
										</tr>
										
										<tr class='$packageClass'>
											<td style='text-align:left;width:35%;padding-left:10px;'> Issued Date of Performance Security:</td><td style='width: 13%; text-align:left;padding-left:10px;'> $cs_66_null $cs_66_date</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'> Actual Date of Contract Signing :</td><td style='width:13%;text-align:left;padding-left:10px;'> $cs_68_null $cs_68_date</td>
										</tr>
										
										<tr style='background:#DDDDDD;'>
											<td style='text-align:left;width:35%;padding-left:10px;'> Date of Contract Award Notification Published into ADB/ CPTU/ Entity's Website:</td><td style='width: 13%;text-align:left;padding-left:10px;'> $cs_69_null $cs_69_date</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'> Planned Date of Contract Signing:</td><td style='width: 13%;text-align:left;padding-left:10px;'> $cs_67a_null $cs_67a_date</td>
										</tr>
										
										<tr class='$packageClass'>
											<td style='text-align:left;width:35%;padding-left:10px;'> Date of Final Contract Sent to ADB:</td><td style='width: 13%;text-align:left;padding-left:10px;'> $cs_70_null $cs_70_date</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'> Original Scheduled Completion Date: </td><td style='width: 13%;text-align:left;padding-left:10px;'> $cs_72_null $cs_72_date</td>

										</tr>
										
										
										<tr style='background:#DDDDDD;'>
											<td style='text-align:left;width:35%;padding-left:10px;'> Debriefing Held (Yes/ No):</td><td style='width: 13%;text-align:left;padding-left:10px;'>$cs_104</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'> Contract with Advance Payment Provision (Yes/ No):</td><td style='width: 13%;text-align:left;padding-left:10px;'>  $cs_105</td>
										</tr>
										
										<tr class='$packageClass'>
											<td style='text-align:left;width:35%;padding-left:10px;'> Contract with Price Adjustment Provision  (Yes/ No):</td><td style='width: 13%;text-align:left;padding-left:10px;'>$cs_106</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'> Name of the Supplier/ Contractor (with Country):</td><td style='width: 13%;text-align:left;padding-left:10px;'> $cs_113</td>
										</tr>
										
									
									
									
									
										<tr style='background:#ffffff;'>
											<td style='text-align:left;width:20%;padding-left:10px;'> &nbsp; </td><td style='width: 28%;text-align:left;padding-left:10px;'> &nbsp; </td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:20%;padding-left:10px;'> &nbsp; </td><td style='width: 28%;text-align:left;padding-left:10px;'> &nbsp; </td>
										</tr>	
										";
						$mv++;
						
					}
				} else {
					$packageView .= "
									<tr style='background:#F7F4F4'>
										<td colspan='1' style='text-align:center; color:red;'>&nbsp;</td>
									</tr>
									<tr style='background:#F7F4F4'>
										<td colspan='1' style='text-align:center; color:red;'> 
										<form action='contractingStage.php' method='post'>
										<input type='hidden' name='packageId' value='$packageID'/>
										<input type='hidden' name='packageName' value='$packageName'/>
										<input type='submit' name='contractingStageSubmit'  value='No Data Found Insert New Data'/>
										</form>
									</td></tr>";				
									
				}
				$packageView .= "</table>
									</div>
									<!--  Tab 7 End -->";
				$msv++;
			
    // >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> End Contracting Stage <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
	
	
	
	
	
	
	// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Start Contract Management Stage <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
	
		$packageQuery = "
								SELECT
										adbs_contractmanagementstage.cms_71,
										adbs_contractmanagementstage.cms_72a,
										adbs_contractmanagementstage.cms_73,
										adbs_contractmanagementstage.cms_74,
										adbs_contractmanagementstage.cms_75,
										adbs_contractmanagementstage.cms_107,
										adbs_contractmanagementstage.cms_108,
										adbs_contractmanagementstage.cms_109,
										adbs_contractmanagementstage.cms_10,
										adbs_contractmanagementstage.cms_12,
										adbs_contractmanagementstage.entDate
								FROM
										adbs_contractmanagementstage
								WHERE
										adbs_contractmanagementstage.pId='$packageID'
								ORDER BY
										adbs_contractmanagementstage.cmsId
							  ";	
	
		$packageView .= " <!-- Tab 8 Start -->
                            <div id='tabs{$packageID}-8'>
									<table border='0' width='100%' align='left' cellspacing='1' cellpadding='2' style='font-size:90%;'>";
				$packageStatement	= mysql_query($packageQuery);
				$packageCount 		= mysql_num_rows($packageStatement);
				if($packageCount>0) {
					$mv 						= 1;
					$packageStatement			= mysql_query($packageQuery);
					while($packageStatementData	= mysql_fetch_array($packageStatement)) {
						if($mv%2==0) {
							$packageClass="evenRow";
						} else {
							$packageClass="oddRow";
						}
						
						$cms_72a		  = $packageStatementData["cms_72a"];
						$cms_72a_null = '';
						$cms_72a_date = '';
						if ($cms_72a=='0000-00-00'){
							$cms_72a_null = '';
						}
						else{$cms_72a_date = showDateMySQlFormat($packageStatementData["cms_72a"]);}
						
						$cms_71		  = $packageStatementData["cms_71"];
						$cms_71_null = '';
						$cms_71_date = '';
						if ($cms_71=='0000-00-00'){
							$cms_71_null = '';
						}
						else{$cms_71_date = showDateMySQlFormat($packageStatementData["cms_71"]);}
						
						$cms_73		  = $packageStatementData["cms_73"];
						$cms_73_null = '';
						$cms_73_date = '';
						if ($cms_73=='0000-00-00'){
							$cms_73_null = '';
						}
						else{$cms_73_date = showDateMySQlFormat($packageStatementData["cms_73"]);}
						
						$cms_74		  = $packageStatementData["cms_74"];
						$cms_74_null = '';
						$cms_74_date = '';
						if ($cms_74=='0000-00-00'){
							$cms_74_null = '';
						}
						else{$cms_74_date = showDateMySQlFormat($packageStatementData["cms_74"]);}
						
						$cms_75		  = $packageStatementData["cms_75"];
						$cms_75_null = '';
						$cms_75_date = '';
						if ($cms_75=='0000-00-00'){
							$cms_75_null = '';
						}
						else{$cms_75_date = showDateMySQlFormat($packageStatementData["cms_75"]);}
						
						
						$cms_107        = $packageStatementData["cms_107"];
						$cms_108        = $packageStatementData["cms_108"];
						$cms_109		= $packageStatementData["cms_109"];
						$cms_10         = $packageStatementData["cms_10"];
						$cms_12         = $packageStatementData["cms_12"];
						
						$packageView .= "
										<tr class='$packageClass'>
											<td colspan='3' style='text-align:left;background:#ffffff;'>
												<p style='font-size:17px;'>Contract Management Stage Information:</p>	
											</td>
											<td colspan='2' style='text-align:right;background:#ffffff;'>
												<form action='contractingManagementStageEdit.php' method='post'>
													<input type='hidden' name='packageId' value='$packageID'/>
													<input type='hidden' name='packageName' value='$packageName'/>
													<input type='submit' name='editSubmitContractingManagementStage'  value='Enter Progress'/>
												</form>
											</td>
										</tr>
										<tr class='$packageClass'>
											<td style='text-align:left;width:35%;padding-left:10px;'> Revised Contract Price in Contract Currency or Currencies:</td><td style='width: 13%; text-align:left;padding-left:10px;'>".number_format($cms_10,2)."</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'> Revised Contract Price (Equiv. US$:</td><td style='width:13%;text-align:left;padding-left:10px;'>".number_format($cms_12,2)."</td>
										</tr>
										
										<tr style='background:#DDDDDD;'>
											<td style='text-align:left;width:35%;padding-left:10px;'> Commencement Date:</td><td style='width: 13%;text-align:left;padding-left:10px;'>$cms_71_null $cms_71_date</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'> Planned date: </td><td style='width:13%;text-align:left;padding-left:10px;'> $cms_72a_null $cms_72a_date </td>
										</tr>
										
										<tr class='$packageClass'>
											<td style='text-align:left;width:35%;padding-left:10px;'> Revised Scheduled Completion Date:</td><td style='width: 13%;text-align:left;padding-left:10px;'> $cms_73_null $cms_73_date</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'> Actual Completion Date:</td><td style='width: 13%;text-align:left;padding-left:10px;'> $cms_74_null $cms_74_date</td>
										</tr>
										
										<tr style='background:#DDDDDD;'>
											<td style='text-align:left;width:35%;padding-left:10px;'> Final Acceptance Date:</td><td style='width: 13%;text-align:left;padding-left:10px;'> $cms_75_null $cms_75_date</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'>Number of Contract Amendments:</td><td style='width: 13%;text-align:left;padding-left:10px;'>$cms_107</td>
										</tr>
										
										<tr class='$packageClass'>
											<td style='text-align:left;width:35%;padding-left:10px;'> Number of Variation Order:</td><td style='width: 13%; text-align:left;padding-left:10px;'>$cms_108</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'>Variation Order Amount (Equiv. US$:</td><td style='width: 13%;text-align:left;padding-left:10px;'>  ".number_format($cms_109,2)."</td>
											
										</tr>

										
									
									
									
									
										<tr style='background:#ffffff;'>
											<td style='text-align:left;width:20%;padding-left:10px;'> &nbsp; </td><td style='width: 28%;text-align:left;padding-left:10px;'> &nbsp; </td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:20%;padding-left:10px;'> &nbsp; </td><td style='width: 28%;text-align:left;padding-left:10px;'> &nbsp; </td>
										</tr>	
										";
						$mv++;
						
					}
				} else {
					$packageView .= "
									<tr style='background:#F7F4F4'>
										<td colspan='1' style='text-align:center; color:red;'>&nbsp;</td>
									</tr>
									<tr style='background:#F7F4F4'>
										<td colspan='1' style='text-align:center; color:red;'> 
										<form action='contractManagementStage.php' method='post'>
										<input type='hidden' name='packageId' value='$packageID'/>
										<input type='hidden' name='packageName' value='$packageName'/>
										<input type='submit' name='contractManagementStageSubmit'  value='No Data Found Insert New Data'/>
										</form>
									</td></tr>";				
				}
				$packageView .= "</table>
									</div>
									<!--  Tab 8 End --> ";
				$msv++;
			
    // >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> End Contract Management Stage <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
	
		
	// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Start Contract Concluding Stage <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
	
		$packageQuery = "
								SELECT
										adbs_contractconcludingstage.ccs_76,
										adbs_contractconcludingstage.ccs_77,
										adbs_contractconcludingstage.ccs_78,
										adbs_contractconcludingstage.ccs_79,
										adbs_contractconcludingstage.ccs_80,
										adbs_contractconcludingstage.ccs_110,
										adbs_contractconcludingstage.ccs_111,
										adbs_contractconcludingstage.entDate
								FROM
										adbs_contractconcludingstage
								WHERE
										adbs_contractconcludingstage.pId='$packageID'
								ORDER BY
										adbs_contractconcludingstage.ccsId
							  ";	
	
		$packageView .= " <!-- Tab 9 Start -->
                            <div id='tabs{$packageID}-9'>
									<table border='0' width='100%' align='left' cellspacing='1' cellpadding='2' style='font-size:90%;'>";
				$packageStatement	= mysql_query($packageQuery);
				$packageCount 		= mysql_num_rows($packageStatement);
				if($packageCount>0) {
					$mv 						= 1;
					$packageStatement			= mysql_query($packageQuery);
					while($packageStatementData	= mysql_fetch_array($packageStatement)) {
						if($mv%2==0) {
							$packageClass="evenRow";
						} else {
							$packageClass="oddRow";
						}
						$ccs_76         = $packageStatementData["ccs_76"];
						$ccs_76_null = '';
						$ccs_76_date = '';
						if ($ccs_76=='0000-00-00'){
							$ccs_76_null = '';
						}
						else{$ccs_76_date = showDateMySQlFormat($packageStatementData["ccs_76"]);}
						
						$ccs_77         = $packageStatementData["ccs_77"];
						$ccs_77_null = '';
						$ccs_77_date = '';
						if ($ccs_77=='0000-00-00'){
							$ccs_77_null = '';
						}
						else{$ccs_77_date = showDateMySQlFormat($packageStatementData["ccs_77"]);}
						
						$ccs_78		 = $packageStatementData["ccs_78"];
						$ccs_79         = $packageStatementData["ccs_79"];
						$ccs_80         = $packageStatementData["ccs_80"];
						$ccs_110         = $packageStatementData["ccs_110"];
						$ccs_111		 = $packageStatementData["ccs_111"];
						
						$packageView .= "
										<tr class='$packageClass'>
										<td colspan='3' style='text-align:left;background:#ffffff;'>
												<p style='font-size:17px;'>Contract Concluding Stage Information:</p>	
											</td>
											<td colspan='2' style='text-align:right;background:#ffffff;'>
												<form action='contractConcludingStageEdit.php' method='post'>
													<input type='hidden' name='packageId' value='$packageID'/>
													<input type='hidden' name='packageName' value='$packageName'/>
													<input type='submit' name='editSubmitContractConcludingStage'  value='Enter Progress'/>
												</form>
											</td>
										</tr>
										<tr class='$packageClass'>
											<td style='text-align:left;width:35%;padding-left:10px;'> Final Bill Date :</td><td style='width: 13%; text-align:left;padding-left:10px;'> $ccs_76_null $ccs_76_date</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'> Final Bill Payment Date (Cheque Date):</td><td style='width:13%;text-align:left;padding-left:10px;'> $ccs_77_null $ccs_77_date</td>
										</tr>
										
										<tr style='background:#DDDDDD;'>
											<td style='text-align:left;width:35%;padding-left:10px;'> Total Payments Paid to Supplier/ Contractor/ Consultant (Equiv. US$) :</td><td style='width: 13%;text-align:left;padding-left:10px;'>".number_format($ccs_78,2)."</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'> Amounts Paid for Late Payment (Equiv. US$):</td><td style='width: 13%;text-align:left;padding-left:10px;'>".number_format($ccs_79,2)."</td>
										</tr>
										
										<tr class='$packageClass'>
											<td style='text-align:left;width:35%;padding-left:10px;'> LDs imposed on Supplier/ Contractor/ Consultant (Equiv. US$):</td><td style='width: 13%;text-align:left;padding-left:10px;'>".number_format($ccs_80,2)."</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'> Number of Disputes Raised by the Parties:</td><td style='width: 13%;text-align:left;padding-left:10px;'> $ccs_110</td>
										</tr>
										
										<tr style='background:#DDDDDD;'>
											<td style='text-align:left;width:35%;padding-left:10px;'> Number of Unresolved Disputes:</td><td style='width: 13%;text-align:left;padding-left:10px;'> $ccs_111</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'> </td><td style='width: 13%;text-align:left;padding-left:10px;'>  </td>
										</tr>
									
									
									
									
										<tr style='background:#ffffff;'>
											<td style='text-align:left;width:20%;padding-left:10px;'> &nbsp; </td><td style='width: 28%;text-align:left;padding-left:10px;'> &nbsp; </td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:20%;padding-left:10px;'> &nbsp; </td><td style='width: 28%;text-align:left;padding-left:10px;'> &nbsp; </td>
										</tr>	
										";
						$mv++;
						
					}
				} else {
				    $packageView .= "
									<tr style='background:#F7F4F4'>
										<td colspan='1' style='text-align:center; color:red;'>&nbsp;</td>
									</tr>
									<tr style='background:#F7F4F4'>
										<td colspan='1' style='text-align:center; color:red;'> 
										<form action='contractConcludingStage.php' method='post'>
										<input type='hidden' name='packageId' value='$packageID'/>
										<input type='hidden' name='packageName' value='$packageName'/>
										<input type='submit' name='contractConcludingStageSubmit'  value='No Data Found Insert New Data'/>
										</form>
									</td></tr>";					
									
				}
				$packageView .= "</table>
										</div>
										<!--  Tab 9 End --> ";
				$msv++;
			
    // >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> End Contract Concluding Stage <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
	
	
	// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Start Others Information <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
	
		$packageQuery = "
								SELECT
										adbs_othersinformation.oi_114,
										adbs_othersinformation.oi_120,
										adbs_othersinformation.oi_121,
										adbs_othersinformation.entDate
								FROM
										adbs_othersinformation
								WHERE
										adbs_othersinformation.pId='$packageID'
								ORDER BY
										adbs_othersinformation.oiId
							  ";	
	
		$packageView .= " <!-- Tab 10 Start -->
                            <div id='tabs{$packageID}-10'>
									<table border='0' width='100%' align='left' cellspacing='1' cellpadding='2' style='font-size:90%;'>";
				$packageStatement	= mysql_query($packageQuery);
				$packageCount 		= mysql_num_rows($packageStatement);
				if($packageCount>0) {
					$mv 						= 1;
					$packageStatement			= mysql_query($packageQuery);
					while($packageStatementData	= mysql_fetch_array($packageStatement)) {
						if($mv%2==0) {
							$packageClass="evenRow";
						} else {
							$packageClass="oddRow";
						}
						$oi_114         = $packageStatementData["oi_114"];
						$oi_120         = $packageStatementData["oi_120"];
						$oi_121		  = $packageStatementData["oi_121"];
					
						
						$packageView .= "
										<tr class='$packageClass'>
										<td colspan='3' style='text-align:left;background:#ffffff;'>
												<p style='font-size:17px;'>Others Information:</p>	
											</td>
											<td colspan='5' style='text-align:right;background:#ffffff;'>
												<form action='othersInformationEdit.php' method='post'>
													<input type='hidden' name='packageId' value='$packageID'/>
													<input type='hidden' name='packageName' value='$packageName'/>
													<input type='submit' name='editSubmitOthersInformation'  value='Enter Progress'/>
												</form>
											</td>
										</tr>
										<tr class='$packageClass'>
											<td style='text-align:left;width:30%;'> &nbsp; Remarks, if any :</td><td style='width: 18%; text-align:left'> &nbsp; $oi_114</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:30%;'> &nbsp; </td><td style='width:18%;text-align:left;'> &nbsp; </td>
										</tr>
										
										
										
										
										
										<tr style='background:#ffffff;'>
											<td style='text-align:left;width:20%;padding-left:10px;'> &nbsp; </td><td style='width: 28%;text-align:left;padding-left:10px;'> &nbsp; </td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:20%;padding-left:10px;'> &nbsp; </td><td style='width: 28%;text-align:left;padding-left:10px;'> &nbsp; </td>
										</tr>	
										";
						$mv++;
						
					}
				} else {
					$packageView .= "
									<tr style='background:#F7F4F4'>
										<td colspan='1' style='text-align:center; color:red;'>&nbsp;</td>
									</tr>
									<tr style='background:#F7F4F4'>
										<td colspan='1' style='text-align:center; color:red;'> 
										<form action='othersInformation.php' method='post'>
										<input type='hidden' name='packageId' value='$packageID'/>
										<input type='hidden' name='packageName' value='$packageName'/>
										<input type='submit' name='othersInformationSubmit'  value='No Data Found Insert New Data'/>
										</form>
									</td></tr>";					
				}
				$packageView .= "</table>
									</div>
									<!--  Tab 10 End --> 
								</div>
					  	<!-- end of details -->	
				</div><br/></td></tr>";
				$msv++;
	
    // >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> End Others Information <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
	
				
			}
			

			$packageView .= "</table>";
			
			$systemParametersBody = str_replace('<!--%[PACKAGE_HOME_VIEW]%-->',$packageView,$systemParametersBody);

		return $systemParametersBody;
		}
		
		
		// Advance Search   End
		
		
		
	}
?>