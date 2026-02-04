<?php
	class fnaSetupInsertNew Extends BaseClass {
		function fnaSetupInsertNew() {
			$this->con=$this->BaseClass();
		}		
				
		// Insert Labour Contract Information Start
		function insertLabourContractInfo($userId){
			
			$LABOURID 			= $_REQUEST["LABOURID"];
			$startLDate 		= insertDateMySQlFormat($_REQUEST["startLDate"]);
			$endLDate 			= insertDateMySQlFormat($_REQUEST["endLDate"]);
			$description 		= addslashes($_REQUEST["description"]);
			
			
			$ChmbrFrom 			= $_REQUEST["ChmbrFrom"];
			$ChmbrTo 			= $_REQUEST["ChmbrTo"];
			$packingUnitId 		= $_REQUEST["packingUnit"];
			$loadPrice 			= $_REQUEST["loadPrice"];
			$unloadPrice 		= $_REQUEST["unloadPrice"];
			$transferPrice 		= $_REQUEST["transferPrice"];
			$palotPrice 		= $_REQUEST["palotPrice"];
			$shadePrice 		= $_REQUEST["shadePrice"];
			$TOTAL_PRODUCT_LIST	= $_REQUEST["TOTAL_PRODUCT_LIST"];
			
			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
			$Query		= "
							SELECT 
									LABOURID 
							FROM 
									fna_labourcontact
							WHERE LABOURID = '".$LABOURID."' AND STARTDATE = '".$startLDate."' AND ENDDATE = '".$endLDate."'
								  ";
			$QueryStatement	= mysql_query($Query);
			if(mysql_num_rows($QueryStatement)>0) {
				$msg = "<span class='errorMsg'>Sorry, This Information [ $LABOURID ] already exist!</span>";
			} else {
				$insertQuery = "
										INSERT INTO 
													fna_labourcontact
																	(
																		LABOURID,
																		STARTDATE,
																		ENDDATE,
																		DESCRIPTION,
																		STATUS,
																		ENTDATE,
																		ENTTIME,
																		USERID
																	) 
															VALUES
																	(
																		'".$LABOURID."',
																		'".$startLDate."',
																		'".$endLDate."',
																		'".$description."',
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									"; 
				if(mysql_query($insertQuery)){
					
					$labourCtId = mysql_insert_id();
					
					$k = 0;
					for($i = 1; $i < $TOTAL_PRODUCT_LIST; $i++ ){
						
								$insertbkdnQuery = "
										INSERT INTO 
													fna_labourcontact_bkdn
																	(
																		LABCONTACTID,
																		CHAMBERIDFROM,
																		CHAMBERIDTO,
																		PACKINGUNITID,
																		LOADPRICE,
																		UNLOADPRICE,
																		TRANSFERPRICE,
																		SHADEPRICE,
																		PALOTPRICE,
																		STATUS,
																		ENTDATE,
																		ENTTIME,
																		USERID
																	) 
															VALUES
																	(
																		'".$labourCtId."',
																		'".$ChmbrFrom[$k]."',
																		'".$ChmbrTo[$k]."',
																		'".$packingUnitId[$k]."',
																		'".$loadPrice[$k]."',
																		'".$unloadPrice[$k]."',
																		'".$transferPrice[$k]."',
																		'".$palotPrice[$k]."',
																		'".$shadePrice[$k]."',
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									"; 
									$insertbkdnQueryStatement = mysql_query($insertbkdnQuery);
									if($insertbkdnQueryStatement){
										$msg = "<span class='validMsg'>Labour Information [ $LABOURID ] added sucessfully</span>";
									}else{
										$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
										break;
										}
						$k++;
					}
					
					
					
				} else {
					$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
				}
			}
			return $msg;
			
			
			
			
		}
		// Insert Labour Contract Information  End
		
		// Insert Load Information Start
		function insertLoadInfo($userId){
			
			$LABOURID 			= $_REQUEST["LABOURID"];
			$PARTYID 			= $_REQUEST["PARTYID"];
			$FATHERNAME			= $_REQUEST["FATHERNAME"];
			$ADDRESS 			= $_REQUEST["ADDRESS"];
			$MOBILE 			= $_REQUEST["MOBILE"];
			$ENTRYDATE	 		= insertDateMySQlFormat($_REQUEST["ENTRYDATE"]);
			
			
			$PRODCATTYPEID		= $_REQUEST["PRODCATTYPEID"];
			$PRODUCTID 			= $_REQUEST["PRODUCTID"];
			$quantity	 		= $_REQUEST["quantity"];
			$PACKINGNAMEID		= $_REQUEST["PACKINGNAMEID"];
			$CHID		 		= $_REQUEST["CHID"];
			$pocket		 		= $_REQUEST["pocket"];
			$TOTAL_PRODUCT_LIST	= $_REQUEST["TOTAL_PRODUCT_LIST"];
			
			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
			$Query		= "
							SELECT 
									LABOURID 
							FROM 
									fna_labourcontact
							WHERE LABOURID = '".$LABOURID."' AND STARTDATE = '".$startLDate."' AND ENDDATE = '".$endLDate."'
								  ";
			$QueryStatement	= mysql_query($Query);
			if(mysql_num_rows($QueryStatement)>0) {
				$msg = "<span class='errorMsg'>Sorry, This Information [ $LABOURID ] already exist!</span>";
			} else {
				$insertQuery = "
										INSERT INTO 
													fna_labourcontact
																	(
																		LABOURID,
																		STARTDATE,
																		ENDDATE,
																		DESCRIPTION,
																		STATUS,
																		ENTDATE,
																		ENTTIME,
																		USERID
																	) 
															VALUES
																	(
																		'".$LABOURID."',
																		'".$startLDate."',
																		'".$endLDate."',
																		'".$description."',
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									"; 
				if(mysql_query($insertQuery)){
					
					$labourCtId = mysql_insert_id();
					
					$k = 0;
					for($i = 1; $i < $TOTAL_PRODUCT_LIST; $i++ ){
						
								$insertbkdnQuery = "
										INSERT INTO 
													fna_labourcontact_bkdn
																	(
																		LABCONTACTID,
																		CHAMBERIDFROM,
																		CHAMBERIDTO,
																		PACKINGUNITID,
																		LOADPRICE,
																		UNLOADPRICE,
																		TRANSFERPRICE,
																		SHADEPRICE,
																		PALOTPRICE,
																		STATUS,
																		ENTDATE,
																		ENTTIME,
																		USERID
																	) 
															VALUES
																	(
																		'".$labourCtId."',
																		'".$ChmbrFrom[$k]."',
																		'".$ChmbrTo[$k]."',
																		'".$packingUnitId[$k]."',
																		'".$loadPrice[$k]."',
																		'".$unloadPrice[$k]."',
																		'".$transferPrice[$k]."',
																		'".$palotPrice[$k]."',
																		'".$shadePrice[$k]."',
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									"; 
									$insertbkdnQueryStatement = mysql_query($insertbkdnQuery);
									if($insertbkdnQueryStatement){
										$msg = "<span class='validMsg'>Labour Information [ $LABOURID ] added sucessfully</span>";
									}else{
										$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
										break;
										}
						$k++;
					}
					
					
					
				} else {
					$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
				}
			}
			return $msg;
			
			
			
			
		}
		// Insert Load Information  End
		
		
		
	}
?>