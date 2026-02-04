<?php
	class projectSetupInsertNew Extends BaseClass {
		function projectSetupInsertNew() {
			$this->con=$this->BaseClass();
		}		
		// Insert Labour start
		function insertLabourInfo($userId){
			
			$PROJECTID		= addslashes($_REQUEST["PROJECTID"]);
			$SUBPROJECTID	= addslashes($_REQUEST["SUBPROJECTID"]);
			$name 			= addslashes($_REQUEST["name"]);
			$fName 			= addslashes($_REQUEST["fName"]);
			$address 		= addslashes($_REQUEST["address"]);
			$mobile 		= addslashes($_REQUEST["mobile"]);
			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
			$Query		= "
									SELECT 
											LABOURNAME 
									FROM 
											fna_labour
									WHERE LOWER(LABOURNAME) = '".strtolower($name)."' 
									AND LOWER(FATHERNAME) = '".strtolower($fName)."'
									AND PROJECTID = '".$PROJECTID."'
									AND SUBPROJECTID = '".$SUBPROJECTID."'
								  ";
			$QueryStatement	= mysql_query($Query);
			if(mysql_num_rows($QueryStatement)>0) {
				$msg = "<span class='errorMsg'>Sorry, labour name [ $name ] already exist!</span>";
			} else {
				$insertQuery = "
										INSERT INTO 
													fna_labour
																	(
																		PROJECTID,
																		SUBPROJECTID,
																		LABOURNAME,
																		FATHERNAME,
																		ADDRESS,
																		MOBILE,
																		STATUS,
																		ENTDATE,
																		ENTTIME,
																		USERID
																	) 
															VALUES
																	(
																		'".$PROJECTID."',
																		'".$SUBPROJECTID."',
																		'".$name."',
																		'".$fName."',
																		'".$address."',
																		'".$mobile."',
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									"; 
				$insertQueryStatement = mysql_query($insertQuery);
				if($insertQueryStatement){
					$msg = "<span class='validMsg'>Labour name [ $name ] added sucessfully</span>";
				} else {
					$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
				}
			}
			return $msg;
			
			
			
			
		}
		// Insert Labour End
		
		// Insert Party start
		function InsertPartyInfo($userId){
			$PROJECTID_PARTY		= addslashes($_REQUEST["PROJECTID_PARTY"]);
			$SUBPROJECTID_PARTY	= addslashes($_REQUEST["SUBPROJECTID_PARTY"]);
			$partyname		= addslashes($_REQUEST["partyname"]);
			$fName 			= addslashes($_REQUEST["fatherName"]);
			$address 		= addslashes($_REQUEST["address"]);
			$mobile 		= addslashes($_REQUEST["mobile"]);
			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
			$Query		= "
									SELECT 
											PARTYNAME 
									FROM 
											fna_party
									WHERE LOWER(PARTYNAME) = '".strtolower($partyname)."' AND LOWER(FATHERNAME) = '".strtolower($fName)."'
								  ";
			$QueryStatement	= mysql_query($Query);
			if(mysql_num_rows($QueryStatement)>0) {
				$msg = "<span class='errorMsg'>Sorry, Party name [ $partyname ] already exist!</span>";
			} else {
				$insertQuery = "
										INSERT INTO 
													fna_party
																	(
																		PROJECTID,
																		SUBPROJECTID,
																		PARTYNAME,
																		FATHERNAME,
																		ADDRESS,
																		MOBILE,
																		STATUS,
																		ENTDATE,
																		ENTTIME,
																		USERID
																	) 
															VALUES
																	(
																		'".$PROJECTID_PARTY."',
																		'".$SUBPROJECTID_PARTY."',
																		'".$partyname."',
																		'".$fName."',
																		'".$address."',
																		'".$mobile."',
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									"; 
				$insertQueryStatement = mysql_query($insertQuery);
				if($insertQueryStatement){
					$msg = "<span class='validMsg'>Party name [ $partyname ] added sucessfully</span>";
				} else {
					$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
				}
			}
			return $msg;
			
			
			
			
		}
		// Insert Party End
		
		// Insert Chamber start
		function InsertChamberInfo($userId){
			
			$chname				= addslashes($_REQUEST["chname"]);
			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
			$Query		= "
									SELECT 
											CHNAME 
									FROM 
											fna_chamber
									WHERE LOWER(CHNAME) = '".strtolower($chname)."'
								  ";
			$QueryStatement	= mysql_query($Query);
			if(mysql_num_rows($QueryStatement)>0) {
				$msg = "<span class='errorMsg'>Sorry, Chamber name [ $chname ] already exist!</span>";
			} else {
				$insertQuery = "
										INSERT INTO 
													fna_chamber
																	(
																		CHNAME,
																		STATUS,
																		ENTDATE,
																		ENTTIME,
																		USERID
																	) 
															VALUES
																	(
																		'".$chname."',
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									"; 
				$insertQueryStatement = mysql_query($insertQuery);
				if($insertQueryStatement){
					$msg = "<span class='validMsg'>Chamber name [ $chname ] added sucessfully</span>";
				} else {
					$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
				}
			}
			return $msg;
			
			
			
			
		}
		// Insert Chamber End
		
		// Insert Packing Name start 
		function insertPackingNameInfo($userId){
			
			$packingname		= addslashes($_REQUEST["packingname"]);
			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
			$Query		= "
									SELECT 
											PACKINGNAME 
									FROM 
											fna_packingname
									WHERE LOWER(PACKINGNAME) = '".strtolower($packingname)."'
								  ";
			$QueryStatement	= mysql_query($Query);
			if(mysql_num_rows($QueryStatement)>0) {
				$msg = "<span class='errorMsg'>Sorry, Packing  name [ $packingname ] already exist!</span>";
			} else {
				$insertQuery = "
										INSERT INTO 
													fna_packingname
																	(
																		PACKINGNAME,
																		STATUS,
																		ENTDATE,
																		ENTTIME,
																		USERID
																	) 
															VALUES
																	(
																		'".$packingname."',
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									"; 
				$insertQueryStatement = mysql_query($insertQuery);
				if($insertQueryStatement){
					$msg = "<span class='validMsg'>Packing name [ $packingname ] added sucessfully</span>";
				} else {
					$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
				}
			}
			return $msg;
			
			
			
			
		}
		// Insert Packing Name End
		
		// Insert Loan Type start 
		function insertLoanTypeInfo($userId){
			
			$LOANTYPENAME		= addslashes($_REQUEST["LOANTYPENAME"]);
			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
			$Query		= "
									SELECT 
											LOANTYPENAME 
									FROM 
											fna_loantype
									WHERE LOWER(LOANTYPENAME) = '".strtolower($LOANTYPENAME)."'
								  ";
			$QueryStatement	= mysql_query($Query);
			if(mysql_num_rows($QueryStatement)>0) {
				$msg = "<span class='errorMsg'>Sorry, Loan Type [ $LOANTYPENAME ] already exist!</span>";
			} else {
				$insertQuery = "
										INSERT INTO 
													fna_loantype
																	(
																		LOANTYPENAME,
																		STATUS,
																		ENTDATE,
																		ENTTIME,
																		USERID
																	) 
															VALUES
																	(
																		'".$LOANTYPENAME."',
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									"; 
				$insertQueryStatement = mysql_query($insertQuery);
				if($insertQueryStatement){
					$msg = "<span class='validMsg'>Loan Type [ $LOANTYPENAME ] added sucessfully</span>";
				} else {
					$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
				}
			}
			return $msg;
			
			
			
			
		}
		// Insert Loan Type End
		
		// Insert Product Category Type  Name start
		function InsertProdCatTypeInfo($userId){
			
			$PROJECTID_ProdCat		= addslashes($_REQUEST["PROJECTID_ProdCat"]);
			$SUBPROJECTID_ProdCat	= addslashes($_REQUEST["SUBPROJECTID_ProdCat"]);
			$ProdCatTypeName		= addslashes($_REQUEST["ProdCatTypeName"]);
			$entDate 				= date('Y-m-d');
			$entTime 				= date('H:i:s A');
			
			$ProdCatTypeQuery		= "
									SELECT 
											CATEGORYTYPENAME 
									FROM 
											fna_productcattype
									WHERE LOWER(CATEGORYTYPENAME) = '".strtolower($ProdCatTypeName)."'
									AND PROJECTID = '".$PROJECTID_ProdCat."'
									AND SUBPROJECTID = '".$SUBPROJECTID_ProdCat."'
								  ";
			$ProdCatTypeQueryStatement	= mysql_query($ProdCatTypeQuery);
			if(mysql_num_rows($ProdCatTypeQueryStatement)>0) {
				$msg = "<span class='errorMsg'>Sorry, Product Category Type  name [ $ProdCatTypeName ] already exist!</span>";
			} else {
				$insertQueryProdCatType = "
										INSERT INTO 
													fna_productcattype
																	(
																		PROJECTID,
																		SUBPROJECTID,
																		CATEGORYTYPENAME,
																		STATUS,
																		ENTDATE,
																		ENTTIME,
																		USERID
																	) 
															VALUES
																	(
																		'".$PROJECTID_ProdCat."',
																		'".$SUBPROJECTID_ProdCat."',
																		'".$ProdCatTypeName."',
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									"; 
				$insertQueryProdCatTypeStatement = mysql_query($insertQueryProdCatType);
				if($insertQueryProdCatTypeStatement){
					$msg = "<span class='validMsg'>Product Category Type Name [ $ProdCatTypeName ] added sucessfully</span>";
				} else {
					$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
				}
			}
			return $msg;
			
			
			
			
		}
		// Insert Product Category Type Name End
		
		// Insert Product  Name start
		function InsertProdInfo($userId){
			
			$PROJECTID_Prod		= addslashes($_REQUEST["PROJECTID_PROD"]);
			$SUBPROJECTID_Prod	= addslashes($_REQUEST["SUBPROJECTID_PROD"]);
			$catType			= addslashes($_REQUEST["catType"]);
			$Prodname			= addslashes($_REQUEST["Prodname"]);
			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
			$ProdQuery		= "
									SELECT 
											PRODCATTYPEID,
											PRODUCTNAME 
									FROM 
											fna_product
									WHERE LOWER(PRODUCTNAME) = '".strtolower($Prodname)."'
									AND PROJECTID = '".$PROJECTID_Prod."'
									AND SUBPROJECTID = '".$SUBPROJECTID_Prod."'
								  ";
			$ProdQueryStatement	= mysql_query($ProdQuery);
			if(mysql_num_rows($ProdQueryStatement)>0) {
				$msg = "<span class='errorMsg'>Sorry, Product name [ $Prodname ] already exist!</span>";
			} else {
				$insertQueryProd = "
										INSERT INTO 
													fna_product
																	(
																		PROJECTID,
																		SUBPROJECTID,
																		PRODCATTYPEID,
																		PRODUCTNAME,
																		STATUS,
																		ENTDATE,
																		ENTTIME,
																		USERID
																	) 
															VALUES
																	(
																		'".$PROJECTID_Prod."',
																		'".$SUBPROJECTID_Prod."',
																		'".$catType."',
																		'".$Prodname."',
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									"; 
				$insertQueryProdStatement = mysql_query($insertQueryProd);
				if($insertQueryProdStatement){
					$msg = "<span class='validMsg'>Product Name [ $Prodname ] added sucessfully</span>";
				} else {
					$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
				}
			}
			return $msg;
			
			
			
			
		}
		// Insert Product Name End
		
		// Insert Poultry Others Income  Name start
		function InsertPalOthersIncomeInfo($userId){
			$PROJECTID_OTHERS		= addslashes($_REQUEST["PROJECTID_OTHERS"]);
			$SUBPROJECTID_OTHERS	= addslashes($_REQUEST["SUBPROJECTID_OTHERS"]);
			$INCOMEHEAD				= addslashes($_REQUEST["INCOMEHEAD"]);
			$othersIncome			= addslashes($_REQUEST["abcd"]);
			$entDate 				= date('Y-m-d');
			$entTime 				= date('H:i:s A');
			
			$PoultryOthersIncomeQuery		= "
												SELECT 
														INCOMEHEAD 
												FROM 
														pal_others_income
												WHERE LOWER(INCOMEHEAD) = '".strtolower($INCOMEHEAD)."'
											  ";
			$PoultryOthersIncomeQueryStatement	= mysql_query($PoultryOthersIncomeQuery);
			if(mysql_num_rows($PoultryOthersIncomeQueryStatement)>0) {
				$msg = "<span class='errorMsg'>Sorry, Head name [ $INCOMEHEAD ] already exist!</span>";
			} else {
				$insertQueryPoultryOthersIncome = "
													INSERT INTO 
																pal_others_income
																	(
																		PROJECTID,
																		SUBPROJECTID,
																		INCOMEHEAD,
																		REMARKS,
																		STATUS,
																		ENTDATE,
																		ENTTIME,
																		USERID
																	) 
															VALUES
																	(
																		'".$PROJECTID_OTHERS."',
																		'".$SUBPROJECTID_OTHERS."',
																		'".$INCOMEHEAD."',
																		'".$othersIncome."',
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									"; 
				$insertQueryPoultryOthersIncomeStatement = mysql_query($insertQueryPoultryOthersIncome);
				if($insertQueryPoultryOthersIncomeStatement){
					$msg = "<span class='validMsg'>Head Name [ $INCOMEHEAD ] added sucessfully</span>";
				} else {
					$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
				}
			}
			return $msg;
			
			
			
			
		}
		// Insert Poultry Others Income Name End
		
		// Insert Poultry Others Income  Name start
		function InsertPalOthersExpanseInfo($userId){
			$PROJECTID_OTHERSEXP		= addslashes($_REQUEST["PROJECTID_OTHERSEXP"]);
			$SUBPROJECTID_OTHERSEXP		= addslashes($_REQUEST["SUBPROJECTID_OTHERSEXP"]);
			$EXPANSEHEAD				= addslashes($_REQUEST["EXPANSEHEAD"]);
			$abcdExp					= addslashes($_REQUEST["abcdExp"]);
			$entDate 				= date('Y-m-d');
			$entTime 				= date('H:i:s A');
			
			$PoultryOthersExpQuery		= "
												SELECT 
														EXPANSEHEAD 
												FROM 
														pal_others_expanse
												WHERE LOWER(EXPANSEHEAD) = '".strtolower($EXPANSEHEAD)."'
											  ";
			$PoultryOthersExpQueryStatement	= mysql_query($PoultryOthersExpQuery);
			if(mysql_num_rows($PoultryOthersExpQueryStatement)>0) {
				$msg = "<span class='errorMsg'>Sorry, Head name [ $EXPANSEHEAD ] already exist!</span>";
			} else {
				$insertQueryPoultryOthersExp = "
													INSERT INTO 
																pal_others_expanse
																	(
																		PROJECTID,
																		SUBPROJECTID,
																		EXPANSEHEAD,
																		REMARKS,
																		STATUS,
																		ENTDATE,
																		ENTTIME,
																		USERID
																	) 
															VALUES
																	(
																		'".$PROJECTID_OTHERSEXP."',
																		'".$SUBPROJECTID_OTHERSEXP."',
																		'".$EXPANSEHEAD."',
																		'".$abcdExp."',
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									"; 
				$insertQueryPoultryOthersExpStatement = mysql_query($insertQueryPoultryOthersExp);
				if($insertQueryPoultryOthersExpStatement){
					$msg = "<span class='validMsg'>Head Name [ $EXPANSEHEAD ] added sucessfully</span>";
				} else {
					$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
				}
			}
			return $msg;
			
			
			
			
		}
		// Insert Poultry Others Income Name End
		
		// Insert Expanse Head Name start 
		function InsertExpHeadInfo($userId){
			
			$EXPHEADNAME		= addslashes($_REQUEST["EXPHEADNAME"]);
			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
			$ExpHeadQuery		= "
									SELECT 
											EXPHID,
											EXPHEADNAME 
									FROM 
											fna_expense_head
									WHERE LOWER(EXPHEADNAME) = '".strtolower($EXPHEADNAME)."'
								  ";
			$ExpHeadQueryStatement	= mysql_query($ExpHeadQuery);
			if(mysql_num_rows($ExpHeadQueryStatement)>0) {
				$msg = "<span class='errorMsg'>Sorry, Expanse Head name [ $EXPHEADNAME ] already exist!</span>";
			} else {
				$insertQueryExpHead = "
										INSERT INTO 
													fna_expense_head
																	(
																		EXPHEADNAME,
																		STATUS,
																		ENTDATE,
																		ENTTIME,
																		USERID
																	) 
															VALUES
																	(
																		'".$EXPHEADNAME."',
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									"; 
				$insertQueryExpHeadStatement = mysql_query($insertQueryExpHead);
				if($insertQueryExpHeadStatement){
					$msg = "<span class='validMsg'>Expanse Head Name [ $EXPHEADNAME ] added sucessfully</span>";
				} else {
					$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
				}
			}
			return $msg;
			
			
			
			
		}
		// Insert Expanse Head Name End
		
		// Insert Income Head Name start 
		function InsertIncHeadInfo($userId){
			
			$INCHEADNAME		= addslashes($_REQUEST["INCHEADNAME"]);
			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
			$IncHeadQuery		= "
									SELECT 
											INHID,
											INCHEADNAME 
									FROM 
											fna_income_head
									WHERE LOWER(INCHEADNAME) = '".strtolower($INCHEADNAME)."'
								  ";
			$IncHeadQueryStatement	= mysql_query($IncHeadQuery);
			if(mysql_num_rows($IncHeadQueryStatement)>0) {
				$msg = "<span class='errorMsg'>Sorry, Income Head name [ $INCHEADNAME ] already exist!</span>";
			} else {
				$insertQueryIncHead = "
										INSERT INTO 
													fna_income_head
																	(
																		INCHEADNAME,
																		STATUS,
																		ENTDATE,
																		ENTTIME,
																		USERID
																	) 
															VALUES
																	(
																		'".$INCHEADNAME."',
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									"; 
				$insertQueryIncHeadStatement = mysql_query($insertQueryIncHead);
				if($insertQueryIncHeadStatement){
					$msg = "<span class='validMsg'>Expanse Head Name [ $INCHEADNAME ] added sucessfully</span>";
				} else {
					$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
				}
			}
			return $msg;
			
			
			
			
		}
		// Insert Income Head Name End
		
		// Insert Expanse Sub Head Name start 
		function InsertExpSubHeadInfo($userId){
			$EXPHID 			= addslashes($_REQUEST["EXPHID"]);
			$SUBHEADNAME		= addslashes($_REQUEST["SUBHEADNAME"]);
			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
			$ExpSubHeadQuery		= "
									SELECT 
											EXPSUBHID,
											EXPHID,
											SUBHEADNAME 
									FROM 
											fna_expsubhead
									WHERE EXPHID = '".$EXPHID."' 
									AND LOWER(SUBHEADNAME) = '".strtolower($SUBHEADNAME)."'
								  ";
			$ExpSubHeadQueryStatement	= mysql_query($ExpSubHeadQuery);
			if(mysql_num_rows($ExpSubHeadQueryStatement)>0) {
				$msg = "<span class='errorMsg'>Sorry, Expanse Sub Head name [ $SUBHEADNAME ] already exist!</span>";
			} else {
				$insertQueryExpSubHead = "
										INSERT INTO 
													fna_expsubhead
																	(
																		EXPHID,
																		SUBHEADNAME,
																		STATUS,
																		ENTDATE,
																		ENTTIME,
																		USERID
																	) 
															VALUES
																	(
																		'".$EXPHID."',
																		'".$SUBHEADNAME."',
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									"; 
				$insertQueryExpSubHeadStatement = mysql_query($insertQueryExpSubHead);
				if($insertQueryExpSubHeadStatement){
					$msg = "<span class='validMsg'>Expanse Sub Head Name [ $SUBHEADNAME ] added sucessfully</span>";
				} else {
					$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
				}
			}
			return $msg;
			
			
			
			
		}
		// Insert Expanse Sub Head Name End
		
		// Insert Expanse Entry start   
		function InsertExpanseInfo($userId){
			
			$PROJECTID 			= $_REQUEST["PROJECTID"];
			$SUBPROJECTID		= $_REQUEST["SUBPROJECTID"];
			$BATCHNO			= addslashes($_REQUEST["BATCHNO"]);
			$PARTYID 			= addslashes($_REQUEST["PARTYID"]);
			$EXPHID 			= addslashes($_REQUEST["EXPHID"]);
			//$EXPSUBHID 			= addslashes($_REQUEST["EXPSUBHID"]);
			$AMOUNT 			= addslashes($_REQUEST["AMOUNT"]);
			$EXPDATE 			= insertDateMySQlFormat($_REQUEST["EXPDATE"]);
			$DESCRIPTION 		= addslashes($_REQUEST["DESCRIPTION"]);
			$VOUCHERNO			= addslashes($_REQUEST["VOUCHERNO"]);
			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
			$ExpQuery		= "
									SELECT 
											VOUCHERNO
									FROM 
											fna_expanse
									WHERE VOUCHERNO = '".$VOUCHERNO."'
								  ";
								 
			$ExpQueryStatement	= mysql_query($ExpQuery);
			if(mysql_num_rows($ExpQueryStatement)>0) {
				$msg = "<span class='errorMsg'>Sorry, This Voucher Number [ $VOUCHERNO ] already exist!</span>";
			} else {
				
				$FNA_Balance_Query_Flag = mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_balance"));
				$MaxFlag				= $FNA_Balance_Query_Flag['MAX(FLAG)'];
				
				$FNA_Balance_Query  	= mysql_fetch_array(mysql_query("SELECT BALANCE FROM fna_balance WHERE FLAG = '".$MaxFlag."'"));
				$BALANCE				= $FNA_Balance_Query['BALANCE'];
				
				if($BALANCE >= $AMOUNT){
					
					if($PROJECTID != 3){
						
						$EntrySerial_Query_Flag = mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_entryserialno"));
						$MaxFlagEntrySl			= $EntrySerial_Query_Flag['MAX(FLAG)'];
						
						$EntrySerial_Query_No	= mysql_fetch_array(mysql_query("SELECT MAX(ENTRYSERIALNOID) FROM fna_entryserialno"));
						$MaxEntrySlNo			= $EntrySerial_Query_No['MAX(ENTRYSERIALNOID)'] + 1;
				
				
						$insertQueryEntrySl = "
												INSERT INTO 
															fna_entryserialno
																			(
																				ENTRYSERIALNO,
																				PROJECTID,
																				SUBPROJECTID,
																				ENTRYDATE,
																				FLAG,
																				STATUS,
																				ENTDATE,
																				ENTTIME,
																				USERID
																			) 
																	VALUES
																			(
																				'".$MaxEntrySlNo."',
																				'".$PROJECTID."',
																				'".$SUBPROJECTID."',
																				'".$EXPDATE."',
																				'".$MaxFlagEntrySl."',
																				'Active',
																				'".$entDate."',
																				'".$entTime."',
																				'".$userId."'
																			)
											";
						$insertQueryEntrySlStatement = mysql_query($insertQueryEntrySl);
				
						$insertQueryExp = "
												INSERT INTO 
															fna_expanse
																			(
																				ENTRYSERIALNOID,
																				PROJECTID,
																				SUBPROJECTID,
																				EXPHID,
																				EXPSUBHID,
																				PARTYID,
																				AMOUNT,
																				EXPDATE,
																				VOUCHERNO,
																				DESCRIPTION,
																				STATUS,
																				ENTDATE,
																				ENTTIME,
																				USERID
																			) 
																	VALUES
																			(
																				'".$MaxEntrySlNo."',
																				'".$PROJECTID."',
																				'".$SUBPROJECTID."',
																				'".$EXPHID."',
																				'0',
																				'".$PARTYID."',
																				'".$AMOUNT."',
																				'".$EXPDATE."',
																				'".$VOUCHERNO."',
																				'".$DESCRIPTION."',
																				'Active',
																				'".$entDate."',
																				'".$entTime."',
																				'".$userId."'
																			)
											";
							$insertQueryExpStatement = mysql_query($insertQueryExp);
							
							//Update FNA Balance Table Start
									$BALANCE_FLAG 			= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_balance"));
									$MAXBALANCE_FLAG 		= $BALANCE_FLAG['MAX(FLAG)'];
									$NOW_MAXBALANCE_FLAG 	= $MAXBALANCE_FLAG + 1;
									
									$BALANCE_QUERY		 	= mysql_fetch_array(mysql_query("SELECT * FROM fna_balance WHERE FLAG = '".$MAXBALANCE_FLAG."'"));
									$INCOME_AMOUNT 			= $BALANCE_QUERY['INCOME'];
									$EXPANSE_AMOUNT			= $BALANCE_QUERY['EXPANSE'];
									$BALANCE_AMOUNT 		= $BALANCE_QUERY['BALANCE'];
									
									$NOW_BALANCE_AMOUNT		= $BALANCE_AMOUNT - $AMOUNT ;
									
									$insertBalanceQuery = "
															INSERT INTO 
																		fna_balance
																				(
																					ENTRYSERIALNOID,
																					PROJECTID,
																					SUBPROJECTID,
																					EXPANSE,
																					BALANCE,
																					FLAG,
																					BALDATE,
																					STATUS,
																					ENTDATE,
																					ENTTIME,
																					USERID
																				) 
																		VALUES
																				(
																					'".$MaxEntrySlNo."',
																					'".$PROJECTID."',
																					'".$SUBPROJECTID."',
																					'".$AMOUNT."',
																					'".$NOW_BALANCE_AMOUNT."',
																					'".$NOW_MAXBALANCE_FLAG."',
																					'".$EXPDATE."',
																					'Payment',
																					'".$entDate."',
																					'".$entTime."',
																					'".$userId."'
																				)
										";
										$insertBalanceQueryStatement = mysql_query($insertBalanceQuery);
									//Update FNA Balance Table End
									
									//----------------------------------------------------Update Daily Income Expanse Table Start------------------------------------------------
										/*$INEX_FLAG	 			= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_daily_income_expanse"));
										$MAXINEX_FLAG	 		= $INEX_FLAG['MAX(FLAG)'];
										$NOW_MAXINEX_FLAG	 	= $MAXINEX_FLAG + 1;
										*/
										$INEX_FLAG	 			= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_daily_income_expanse"));
										$MAXINEX_FLAG	 		= $INEX_FLAG['MAX(FLAG)'];
										$NOW_MAXINEX_FLAG	 	= $MAXINEX_FLAG + 1;
										
										$EXPHEADNAME_QRY 		= mysql_fetch_array(mysql_query("SELECT EXPHEADNAME FROM fna_expense_head WHERE EXPHID = '".$EXPHID."'"));
										$ESPHEAD_NAME			= $EXPHEADNAME_QRY['EXPHEADNAME'];
										$PARTYNAME_QRY 			= mysql_fetch_array(mysql_query("SELECT PARTYNAME FROM fna_party WHERE PARTYID = '".$PARTYID."'"));
										$PARTYNAME				= $PARTYNAME_QRY['PARTYNAME'];
										$NOW_DESCRIPTION		= 'Expanse for ' .$PARTYNAME . '   (' .$DESCRIPTION. ')' ;
										
										
										$insertDailyInExQuery = "
																INSERT INTO 
																				fna_daily_income_expanse
																											(
																												ENTRYSERIALNOID,
																												PROJECTID,
																												SUBPROJECTID,
																												DATE,
																												EXPHID,
																												EXPANSE,
																												DESCRIPTION,
																												FLAG,
																												STATUS,
																												ENTDATE,
																												ENTTIME,
																												USERID
																											) 
																									VALUES
																											(
																												'".$MaxEntrySlNo."',
																												'".$PROJECTID."',
																												'".$SUBPROJECTID."',
																												'".$EXPDATE."',
																												'".$EXPHID."',
																												'".$AMOUNT."',
																												'".$NOW_DESCRIPTION."',
																												'".$NOW_MAXINEX_FLAG."',
																												'Active',
																												'".$entDate."',
																												'".$entTime."',
																												'".$userId."'
																											)
																	";
												
												
												$insertDailyInExQueryStatement = mysql_query($insertDailyInExQuery);
									
									//----------------------------------------------------Update Daily Income Expanse Table End ------------------------------------------------
									
								if($insertQueryExpStatement){
									$msg = "<span class='validMsg'>This Voucher Number [ $VOUCHERNO ] added sucessfully</span>";
								} else {
									$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
								}
								
							}else{
							
								$INEX_FLAG	 			= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_daily_income_expanse"));
								$MAXINEX_FLAG	 		= $INEX_FLAG['MAX(FLAG)'];
								$NOW_MAXINEX_FLAG	 	= $MAXINEX_FLAG + 1;
								
								$EXPHEADNAME_QRY 		= mysql_fetch_array(mysql_query("SELECT EXPHEADNAME FROM fna_expense_head WHERE EXPHID = '".$EXPHID."'"));
								$ESPHEAD_NAME			= $EXPHEADNAME_QRY['EXPHEADNAME'];
								$PARTYNAME_QRY 			= mysql_fetch_array(mysql_query("SELECT PARTYNAME FROM fna_party WHERE PARTYID = '".$PARTYID."'"));
								$PARTYNAME				= $PARTYNAME_QRY['PARTYNAME'];
								$NOW_DESCRIPTION		= 'Expanse for '.$BATCHNO . ' No Batch er '.'' .$ESPHEAD_NAME . ' Babod '.'' .$PARTYNAME . '  = Poultry ' ;
								
								/*
								$insertQuery_OIn	= "
													INSERT INTO 
															pal_others_income_expanse
																				(
																					POEXID,
																					BATCHNO,
																					PARTYID,
																					EXPANSEAMOUNT,
																					INVOICENO,
																					REMARKS,
																					ENTRYDATE,
																					STATUS,
																					ENTDATE,
																					ENTTIME,
																					USERID
																				) 
																		VALUES
																				(
																					'".$EXPHID."',
																					'".$BATCHNO."',
																					'".$PARTYID."',
																					'".$AMOUNT."',
																					'".$VOUCHERNO."',
																					'".$NOW_DESCRIPTION."',
																					'".$EXPDATE."',
																					'Active',
																					'".$entDate."',
																					'".$entTime."',
																					'".$userId."'
																				)
												"; 
							$insertQuery_OInStatement = mysql_query($insertQuery_OIn);
							
							*/
								
								$EntrySerial_Query_Flag = mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_entryserialno"));
								$MaxFlagEntrySl			= $EntrySerial_Query_Flag['MAX(FLAG)'];
								
								$EntrySerial_Query_No	= mysql_fetch_array(mysql_query("SELECT MAX(ENTRYSERIALNOID) FROM fna_entryserialno"));
								$MaxEntrySlNo			= $EntrySerial_Query_No['MAX(ENTRYSERIALNOID)'] + 1;
						
						
								$insertQueryEntrySl = "
														INSERT INTO 
																	fna_entryserialno
																					(
																						ENTRYSERIALNO,
																						PROJECTID,
																						SUBPROJECTID,
																						ENTRYDATE,
																						FLAG,
																						STATUS,
																						ENTDATE,
																						ENTTIME,
																						USERID
																					) 
																			VALUES
																					(
																						'".$MaxEntrySlNo."',
																						'".$PROJECTID."',
																						'".$SUBPROJECTID."',
																						'".$EXPDATE."',
																						'".$MaxFlagEntrySl."',
																						'Active',
																						'".$entDate."',
																						'".$entTime."',
																						'".$userId."'
																					)
													";
								$insertQueryEntrySlStatement = mysql_query($insertQueryEntrySl);
							//Update FNA Balance Table Start
									$BALANCE_FLAG 			= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_balance"));
									$MAXBALANCE_FLAG 		= $BALANCE_FLAG['MAX(FLAG)'];
									$NOW_MAXBALANCE_FLAG 	= $MAXBALANCE_FLAG + 1;
									
									$BALANCE_QUERY		 	= mysql_fetch_array(mysql_query("SELECT * FROM fna_balance WHERE FLAG = '".$MAXBALANCE_FLAG."'"));
									$INCOME_AMOUNT 			= $BALANCE_QUERY['INCOME'];
									$EXPANSE_AMOUNT			= $BALANCE_QUERY['EXPANSE'];
									$BALANCE_AMOUNT 		= $BALANCE_QUERY['BALANCE'];
									
									$NOW_BALANCE_AMOUNT		= $BALANCE_AMOUNT - $AMOUNT ;
									
									$insertBalanceQuery = "
															INSERT INTO 
																		fna_balance
																				(
																					ENTRYSERIALNOID,
																					PROJECTID,
																					SUBPROJECTID,
																					EXPANSE,
																					BALANCE,
																					FLAG,
																					BALDATE,
																					STATUS,
																					ENTDATE,
																					ENTTIME,
																					USERID
																				) 
																		VALUES
																				(
																					'".$MaxEntrySlNo."',
																					'3',
																					'8',
																					'".$AMOUNT."',
																					'".$NOW_BALANCE_AMOUNT."',
																					'".$NOW_MAXBALANCE_FLAG."',
																					'".$EXPDATE."',
																					'Payment',
																					'".$entDate."',
																					'".$entTime."',
																					'".$userId."'
																				)
										";
										$insertBalanceQueryStatement = mysql_query($insertBalanceQuery);
									//Update FNA Balance Table End
									
									//----------------------------------------------------Update Daily Income Expanse Table Start------------------------------------------------
										$INEX_FLAG	 			= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_daily_income_expanse"));
										$MAXINEX_FLAG	 		= $INEX_FLAG['MAX(FLAG)'];
										$NOW_MAXINEX_FLAG	 	= $MAXINEX_FLAG + 1;
										
										$EXPHEADNAME_QRY 		= mysql_fetch_array(mysql_query("SELECT EXPHEADNAME FROM fna_expense_head WHERE EXPHID = '".$EXPHID."'"));
										$ESPHEAD_NAME			= $EXPHEADNAME_QRY['EXPHEADNAME'];
										$PARTYNAME_QRY 			= mysql_fetch_array(mysql_query("SELECT PARTYNAME FROM fna_party WHERE PARTYID = '".$PARTYID."'"));
										$PARTYNAME				= $PARTYNAME_QRY['PARTYNAME'];
										$NOW_DESCRIPTION		= 'Expanse for '.$BATCHNO . ' No Batch er '.'' .$ESPHEAD_NAME . ' Babod '.'' .$PARTYNAME .'   (' .$DESCRIPTION. ')' ;
										
										
										$insertDailyInExQuery = "
																INSERT INTO 
																				fna_daily_income_expanse
																											(
																												ENTRYSERIALNOID,
																												PROJECTID,
																												SUBPROJECTID,
																												DATE,
																												EXPHID,
																												EXPANSE,
																												DESCRIPTION,
																												FLAG,
																												STATUS,
																												ENTDATE,
																												ENTTIME,
																												USERID
																											) 
																									VALUES
																											(
																												'".$MaxEntrySlNo."',
																												'3',
																												'8',
																												'".$EXPDATE."',
																												'".$EXPHID."',
																												'".$AMOUNT."',
																												'".$NOW_DESCRIPTION."',
																												'".$NOW_MAXINEX_FLAG."',
																												'Active',
																												'".$entDate."',
																												'".$entTime."',
																												'".$userId."'
																											)
																	";
												
												
												$insertDailyInExQueryStatement = mysql_query($insertDailyInExQuery);
							
							//----------------------------------------------------Update Daily Income Expanse Table End ------------------------------------------------
							
												$insertQueryExp = "
																	INSERT INTO 
																				fna_expanse
																								(
																									ENTRYSERIALNOID,
																									PROJECTID,
																									SUBPROJECTID,
																									EXPHID,
																									EXPSUBHID,
																									PARTYID,
																									AMOUNT,
																									EXPDATE,
																									VOUCHERNO,
																									BATCHNO,
																									DESCRIPTION,
																									STATUS,
																									ENTDATE,
																									ENTTIME,
																									USERID
																								) 
																						VALUES
																								(
																									'".$MaxEntrySlNo."',
																									'".$PROJECTID."',
																									'".$SUBPROJECTID."',
																									'".$EXPHID."',
																									'0',
																									'".$PARTYID."',
																									'".$AMOUNT."',
																									'".$EXPDATE."',
																									'".$VOUCHERNO."',
																									'".$BATCHNO."',
																									'".$NOW_DESCRIPTION."',
																									'Active',
																									'".$entDate."',
																									'".$entTime."',
																									'".$userId."'
																								)
																";
												$insertQueryExpStatement = mysql_query($insertQueryExp);
							
									if($insertBalanceQueryStatement){
										$msg = "<span class='validMsg'>This Voucher Number  added sucessfully</span>";
									} else {
										$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
									}
									
								
								
							}//if($PROJECTID != 3)
							
						}else{
								$msg = "<span class='errorMsg'>Sorry! Insufficient Balance.......!</span>";
							}
			}
			return $msg;
			
			
			
			
		}
		// Insert Expanse Entry End
		
		// Insert Alu Booking Money Entry start   
		function InsertAluBookingInfo($userId){
			
			$PROJECTID 			= $_REQUEST["PROJECTID"];
			$SUBPROJECTID		= $_REQUEST["SUBPROJECTID"];
			
			$PARTYID 			= addslashes($_REQUEST["PARTYID"]);
			$AMOUNT 			= addslashes($_REQUEST["AMOUNT"]);
			$INHID	 			= addslashes($_REQUEST["INHID"]);
			$BOOKINGDATE		= insertDateMySQlFormat($_REQUEST["EXPDATE"]);
			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
			
				
				$FNA_Balance_Query_Flag = mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_balance"));
				$MaxFlag				= $FNA_Balance_Query_Flag['MAX(FLAG)'];
				
				$FNA_Balance_Query  	= mysql_fetch_array(mysql_query("SELECT BALANCE FROM fna_balance WHERE FLAG = '".$MaxFlag."'"));
				$BALANCE				= $FNA_Balance_Query['BALANCE'];
				
				if($BALANCE >= $AMOUNT){
					
					$EntrySerial_Query_Flag = mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_entryserialno"));
					$MaxFlagEntrySl			= $EntrySerial_Query_Flag['MAX(FLAG)'];
					
					$EntrySerial_Query_No	= mysql_fetch_array(mysql_query("SELECT MAX(ENTRYSERIALNOID) FROM fna_entryserialno"));
					$MaxEntrySlNo			= $EntrySerial_Query_No['MAX(ENTRYSERIALNOID)'] + 1;
			
			
					$insertQueryEntrySl = "
											INSERT INTO 
														fna_entryserialno
																		(
																			ENTRYSERIALNO,
																			PROJECTID,
																			SUBPROJECTID,
																			ENTRYDATE,
																			FLAG,
																			STATUS,
																			ENTDATE,
																			ENTTIME,
																			USERID
																		) 
																VALUES
																		(
																			'".$MaxEntrySlNo."',
																			'".$PROJECTID."',
																			'".$SUBPROJECTID."',
																			'".$BOOKINGDATE."',
																			'".$MaxFlagEntrySl."',
																			'Active',
																			'".$entDate."',
																			'".$entTime."',
																			'".$userId."'
																		)
										";
					$insertQueryEntrySlStatement = mysql_query($insertQueryEntrySl);
					
					$BOOKING_FLAG_QRY		= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_alubooking"));
					$MAXBOOKING_FLAG 		= $BOOKING_FLAG_QRY['MAX(FLAG)'];
					$NOW_MAXBOOKING_FLAG 	= $MAXBOOKING_FLAG + 1;
					
					$PARTY_FLAG_QRY			= mysql_fetch_array(mysql_query("SELECT MAX(PARTYFLAG) FROM fna_alubooking WHERE PARTYID = '".$PARTYID."'"));
					$MAXPARTY_FLAG	 		= $PARTY_FLAG_QRY['MAX(PARTYFLAG)'];
					$NOW_MAXPARTY_FLAG	 	= $MAXPARTY_FLAG + 1;
					
					$BOOKING_QRY			= mysql_fetch_array(mysql_query("SELECT BALANCE FROM fna_alubooking WHERE PARTYID = '".$PARTYID."' AND PARTYFLAG = '".$MAXPARTY_FLAG."'"));
					$PARTY_BALANCE	 		= $BOOKING_QRY['BALANCE'];
					$NOW_PARTYBALANCE		= $PARTY_BALANCE + $AMOUNT ; 
		
					$insertQueryAluBook = "
										INSERT INTO 
													fna_alubooking
															(
																ENTRYSERIALNOID,
																PROJECTID,
																SUBPROJECTID,
																PARTYID,
																BOOKINGMONEY,
																ADJUSTMENTMONEY,
																BALANCE,
																BOOKINGDATE,
																PARTYFLAG,
																FLAG,
																STATUS,
																ENTDATE,
																ENTTIME,
																USERID
															) 
													VALUES
															(
																'".$MaxEntrySlNo."',
																'".$PROJECTID."',
																'".$SUBPROJECTID."',
																'".$PARTYID."',
																'".$AMOUNT."',
																'',
																'".$NOW_PARTYBALANCE."',
																'".$BOOKINGDATE."',
																'".$NOW_MAXPARTY_FLAG."',
																'".$NOW_MAXBOOKING_FLAG."',
																'Active',
																'".$entDate."',
																'".$entTime."',
																'".$userId."'
															)
									";
					$insertQueryAluBookStatement = mysql_query($insertQueryAluBook);
					
					//Update FNA Balance Table Start
							$BALANCE_FLAG 			= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_balance"));
							$MAXBALANCE_FLAG 		= $BALANCE_FLAG['MAX(FLAG)'];
							$NOW_MAXBALANCE_FLAG 	= $MAXBALANCE_FLAG + 1;
							
							$BALANCE_QUERY		 	= mysql_fetch_array(mysql_query("SELECT * FROM fna_balance WHERE FLAG = '".$MAXBALANCE_FLAG."'"));
							$INCOME_AMOUNT 			= $BALANCE_QUERY['INCOME'];
							$EXPANSE_AMOUNT			= $BALANCE_QUERY['EXPANSE'];
							$BALANCE_AMOUNT 		= $BALANCE_QUERY['BALANCE'];
							
							$NOW_BALANCE_AMOUNT		= $BALANCE_AMOUNT + $AMOUNT ;
							
							$insertBalanceQuery = "
													INSERT INTO 
																fna_balance
																		(
																			ENTRYSERIALNOID,
																			PROJECTID,
																			SUBPROJECTID,
																			INCOME,
																			BALANCE,
																			FLAG,
																			BALDATE,
																			STATUS,
																			ENTDATE,
																			ENTTIME,
																			USERID
																		) 
																VALUES
																		(
																			'".$MaxEntrySlNo."',
																			'".$PROJECTID."',
																			'".$SUBPROJECTID."',
																			'".$AMOUNT."',
																			'".$NOW_BALANCE_AMOUNT."',
																			'".$NOW_MAXBALANCE_FLAG."',
																			'".$BOOKINGDATE."',
																			'Payment',
																			'".$entDate."',
																			'".$entTime."',
																			'".$userId."'
																		)
								";
								$insertBalanceQueryStatement = mysql_query($insertBalanceQuery);
							//Update FNA Balance Table End
							
							//----------------------------------------------------Update Daily Income Expanse Table Start------------------------------------------------
								$INEX_FLAG	 			= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_daily_income_expanse"));
								$MAXINEX_FLAG	 		= $INEX_FLAG['MAX(FLAG)'];
								$NOW_MAXINEX_FLAG	 	= $MAXINEX_FLAG + 1;
								
								$PARTYNAME_QRY 			= mysql_fetch_array(mysql_query("SELECT PARTYNAME FROM fna_party WHERE PARTYID = '".$PARTYID."'"));
								$PARTYNAME				= $PARTYNAME_QRY['PARTYNAME'];
								$NOW_DESCRIPTION		= 'Booking Money Receive from '.$PARTYNAME . '  (' .$DESCRIPTION. ')';
								
								$insertDailyInExQuery = "
														INSERT INTO 
																		fna_daily_income_expanse
																									(
																										ENTRYSERIALNOID,
																										PROJECTID,
																										SUBPROJECTID,
																										DATE,
																										INHID,
																										INCOME,
																										DESCRIPTION,
																										FLAG,
																										STATUS,
																										ENTDATE,
																										ENTTIME,
																										USERID
																									) 
																							VALUES
																									(
																										'".$MaxEntrySlNo."',
																										'".$PROJECTID."',
																										'".$SUBPROJECTID."',
																										'".$BOOKINGDATE."',
																										'".$INHID."',
																										'".$AMOUNT."',
																										'".$NOW_DESCRIPTION."',
																										'".$NOW_MAXINEX_FLAG."',
																										'Active',
																										'".$entDate."',
																										'".$entTime."',
																										'".$userId."'
																									)
															";
										
										
										$insertDailyInExQueryStatement = mysql_query($insertDailyInExQuery);
							
							//----------------------------------------------------Update Daily Income Expanse Table End ------------------------------------------------
							
							//----------------------------------------------------Update FNA Income Table Start ------------------------------------------------
							
							$FNA_Balance_Query_Flag = mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_balance"));
							$MaxFlag				= $FNA_Balance_Query_Flag['MAX(FLAG)'];
							
							$FNA_Balance_Query  	= mysql_fetch_array(mysql_query("SELECT BALANCE FROM fna_balance WHERE FLAG = '".$MaxFlag."'"));
							$BALANCE				= $FNA_Balance_Query['BALANCE'];
							
							
							$insertQueryExp = "
													INSERT INTO 
																fna_income
																				(
																					ENTRYSERIALNOID,
																					PROJECTID,
																					SUBPROJECTID,
																					INHID,
																					INSUBHID,
																					PARTYID,
																					AMOUNT,
																					INDATE,
																					VOUCHERNO,
																					DESCRIPTION,
																					STATUS,
																					ENTDATE,
																					ENTTIME,
																					USERID
																				) 
																		VALUES
																				(
																					'".$MaxEntrySlNo."',
																					'".$PROJECTID."',
																					'".$SUBPROJECTID."',
																					'".$INHID."',
																					'0',
																					'".$PARTYID."',
																					'".$AMOUNT."',
																					'".$BOOKINGDATE."',
																					'',
																					'".$NOW_DESCRIPTION."',
																					'Receive',
																					'".$entDate."',
																					'".$entTime."',
																					'".$userId."'
																				)
												";
								$insertQueryExpStatement = mysql_query($insertQueryExp);
								
								//----------------------------------------------------Update FNA Income Table End ------------------------------------------------
							
						if($insertDailyInExQueryStatement){
							$msg = "<span class='validMsg'>This Voucher Number [ $AMOUNT ] added sucessfully</span>";
						} else {
							$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
						}
					
				}else{
						$msg = "<span class='errorMsg'>Sorry! Insufficient Balance.......!</span>";
					}
			return $msg;
				
		}
		// Insert Alu Booking Money Entry End
		
		// Insert Alu Booking Money Entry start   
		function InsertAluBookingRefundInfo($userId){
			
			$PROJECTID 			= $_REQUEST["PROJECTID"];
			$SUBPROJECTID		= $_REQUEST["SUBPROJECTID"];
			
			$PARTYID 			= addslashes($_REQUEST["PARTYID"]);
			$AMOUNT 			= addslashes($_REQUEST["AMOUNT"]);
			$EXPHID	 			= addslashes($_REQUEST["EXPHID"]);
			$BOOKINGDATE		= insertDateMySQlFormat($_REQUEST["EXPDATE"]);
			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
			
				
				$FNA_Balance_Query_Flag = mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_balance"));
				$MaxFlag				= $FNA_Balance_Query_Flag['MAX(FLAG)'];
				
				$FNA_Balance_Query  	= mysql_fetch_array(mysql_query("SELECT BALANCE FROM fna_balance WHERE FLAG = '".$MaxFlag."'"));
				$BALANCE				= $FNA_Balance_Query['BALANCE'];
				
				if($BALANCE >= $AMOUNT){
					
					$BOOKING_FLAG_QRY		= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_alubooking"));
					$MAXBOOKING_FLAG 		= $BOOKING_FLAG_QRY['MAX(FLAG)'];
					$NOW_MAXBOOKING_FLAG 	= $MAXBOOKING_FLAG + 1;
					
					$PARTY_FLAG_QRY			= mysql_fetch_array(mysql_query("SELECT MAX(PARTYFLAG) FROM fna_alubooking WHERE PARTYID = '".$PARTYID."'"));
					$MAXPARTY_FLAG	 		= $PARTY_FLAG_QRY['MAX(PARTYFLAG)'];
					$NOW_MAXPARTY_FLAG	 	= $MAXPARTY_FLAG + 1;
					
					$BOOKING_QRY			= mysql_fetch_array(mysql_query("SELECT BALANCE FROM fna_alubooking WHERE PARTYID = '".$PARTYID."' AND PARTYFLAG = '".$MAXPARTY_FLAG."'"));
					$PARTY_BALANCE	 		= $BOOKING_QRY['BALANCE'];
					
					if ($PARTY_BALANCE >= $AMOUNT){
						
							$EntrySerial_Query_Flag = mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_entryserialno"));
							$MaxFlagEntrySl			= $EntrySerial_Query_Flag['MAX(FLAG)'];
							
							$EntrySerial_Query_No	= mysql_fetch_array(mysql_query("SELECT MAX(ENTRYSERIALNOID) FROM fna_entryserialno"));
							$MaxEntrySlNo			= $EntrySerial_Query_No['MAX(ENTRYSERIALNOID)'] + 1;
					
					
							$insertQueryEntrySl = "
													INSERT INTO 
																fna_entryserialno
																				(
																					ENTRYSERIALNO,
																					PROJECTID,
																					SUBPROJECTID,
																					ENTRYDATE,
																					FLAG,
																					STATUS,
																					ENTDATE,
																					ENTTIME,
																					USERID
																				) 
																		VALUES
																				(
																					'".$MaxEntrySlNo."',
																					'".$PROJECTID."',
																					'".$SUBPROJECTID."',
																					'".$BOOKINGDATE."',
																					'".$MaxFlagEntrySl."',
																					'Active',
																					'".$entDate."',
																					'".$entTime."',
																					'".$userId."'
																				)
												";
							$insertQueryEntrySlStatement = mysql_query($insertQueryEntrySl);
						
							
							$NOW_PARTYBALANCE		= $PARTY_BALANCE - $AMOUNT ; 
				
							$insertQueryAluBook = "
												INSERT INTO 
															fna_alubooking
																	(
																		ENTRYSERIALNOID,
																		PROJECTID,
																		SUBPROJECTID,
																		PARTYID,
																		BOOKINGMONEY,
																		ADJUSTMENTMONEY,
																		BALANCE,
																		BOOKINGDATE,
																		PARTYFLAG,
																		FLAG,
																		STATUS,
																		ENTDATE,
																		ENTTIME,
																		USERID
																	) 
															VALUES
																	(
																		'".$MaxEntrySlNo."',
																		'".$PROJECTID."',
																		'".$SUBPROJECTID."',
																		'".$PARTYID."',
																		'',
																		'".$AMOUNT."',
																		'".$NOW_PARTYBALANCE."',
																		'".$BOOKINGDATE."',
																		'".$NOW_MAXPARTY_FLAG."',
																		'".$NOW_MAXBOOKING_FLAG."',
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
											";
							$insertQueryAluBookStatement = mysql_query($insertQueryAluBook);
							
							//Update FNA Balance Table Start
									$BALANCE_FLAG 			= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_balance"));
									$MAXBALANCE_FLAG 		= $BALANCE_FLAG['MAX(FLAG)'];
									$NOW_MAXBALANCE_FLAG 	= $MAXBALANCE_FLAG + 1;
									
									$BALANCE_QUERY		 	= mysql_fetch_array(mysql_query("SELECT * FROM fna_balance WHERE FLAG = '".$MAXBALANCE_FLAG."'"));
									$INCOME_AMOUNT 			= $BALANCE_QUERY['INCOME'];
									$EXPANSE_AMOUNT			= $BALANCE_QUERY['EXPANSE'];
									$BALANCE_AMOUNT 		= $BALANCE_QUERY['BALANCE'];
									
									$NOW_BALANCE_AMOUNT		= $BALANCE_AMOUNT - $AMOUNT ;
									
									$insertBalanceQuery = "
															INSERT INTO 
																		fna_balance
																				(
																					ENTRYSERIALNOID,
																					PROJECTID,
																					SUBPROJECTID,
																					EXPANSE,
																					BALANCE,
																					FLAG,
																					BALDATE,
																					STATUS,
																					ENTDATE,
																					ENTTIME,
																					USERID
																				) 
																		VALUES
																				(
																					'".$MaxEntrySlNo."',
																					'".$PROJECTID."',
																					'".$SUBPROJECTID."',
																					'".$AMOUNT."',
																					'".$NOW_BALANCE_AMOUNT."',
																					'".$NOW_MAXBALANCE_FLAG."',
																					'".$BOOKINGDATE."',
																					'Payment',
																					'".$entDate."',
																					'".$entTime."',
																					'".$userId."'
																				)
										";
										$insertBalanceQueryStatement = mysql_query($insertBalanceQuery);
									//Update FNA Balance Table End
									
									//----------------------------------------------------Update Daily Income Expanse Table Start------------------------------------------------
										$INEX_FLAG	 			= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_daily_income_expanse"));
										$MAXINEX_FLAG	 		= $INEX_FLAG['MAX(FLAG)'];
										$NOW_MAXINEX_FLAG	 	= $MAXINEX_FLAG + 1;
										
										$PARTYNAME_QRY 			= mysql_fetch_array(mysql_query("SELECT PARTYNAME FROM fna_party WHERE PARTYID = '".$PARTYID."'"));
										$PARTYNAME				= $PARTYNAME_QRY['PARTYNAME'];
										$NOW_DESCRIPTION		= 'Alu Booking Money Return to '.$PARTYNAME . '  (' .$DESCRIPTION. ')';
										
										$insertDailyInExQuery = "
																INSERT INTO 
																				fna_daily_income_expanse
																											(
																												ENTRYSERIALNOID,
																												PROJECTID,
																												SUBPROJECTID,
																												DATE,
																												EXPHID,
																												EXPANSE,
																												DESCRIPTION,
																												FLAG,
																												STATUS,
																												ENTDATE,
																												ENTTIME,
																												USERID
																											) 
																									VALUES
																											(
																												'".$MaxEntrySlNo."',
																												'".$PROJECTID."',
																												'".$SUBPROJECTID."',
																												'".$BOOKINGDATE."',
																												'".$EXPHID."',
																												'".$AMOUNT."',
																												'".$NOW_DESCRIPTION."',
																												'".$NOW_MAXINEX_FLAG."',
																												'Active',
																												'".$entDate."',
																												'".$entTime."',
																												'".$userId."'
																											)
																	";
												
												
												$insertDailyInExQueryStatement = mysql_query($insertDailyInExQuery);
									
									//----------------------------------------------------Update Daily Income Expanse Table End ------------------------------------------------
									
									//----------------------------------------------------Update FNA Expanse Table Start ------------------------------------------------
									
									
									
									$insertQueryExp = "
															INSERT INTO 
																		fna_expanse
																						(
																							ENTRYSERIALNOID,
																							PROJECTID,
																							SUBPROJECTID,
																							EXPHID,
																							EXPSUBHID,
																							PARTYID,
																							AMOUNT,
																							EXPDATE,
																							VOUCHERNO,
																							DESCRIPTION,
																							STATUS,
																							ENTDATE,
																							ENTTIME,
																							USERID
																						) 
																				VALUES
																						(
																							'".$MaxEntrySlNo."',
																							'".$PROJECTID."',
																							'".$SUBPROJECTID."',
																							'".$EXPHID."',
																							'0',
																							'".$PARTYID."',
																							'".$AMOUNT."',
																							'".$BOOKINGDATE."',
																							'',
																							'".$NOW_DESCRIPTION."',
																							'Payment',
																							'".$entDate."',
																							'".$entTime."',
																							'".$userId."'
																						)
														";
										$insertQueryExpStatement = mysql_query($insertQueryExp);
					
							if($insertBalanceQueryStatement){
								$msg = "<span class='validMsg'>This Voucher Number  added sucessfully</span>";
							} else {
								$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
							}
							
					}else{
						$msg = "<span class='errorMsg'>Sorry! This Party Booking balance is not greater than $AMOUNT  Taka.......!</span>";
					}
					
				}else{
						$msg = "<span class='errorMsg'>Sorry! Insufficient Balance.......!</span>";
					}
			return $msg;
				
		}
		// Insert Alu Booking Money Entry End
		
		// Insert Alu Commission Entry start   
		function InsertAluCommissionInfo($userId){
			
			$PROJECTID 			= $_REQUEST["PROJECTID"];
			$SUBPROJECTID		= $_REQUEST["SUBPROJECTID"];
			
			$PARTYID 			= addslashes($_REQUEST["PARTYID"]);
			$PERBASTA_AMOUNT	= addslashes($_REQUEST["AMOUNT"]);
			$TOTALCOMMISSION	= addslashes($_REQUEST["TOTALCOMMISSION"]);
			$TOT_BASTA			= addslashes($_REQUEST["QUANTITY"]);
			//$EXPHID	 			= addslashes($_REQUEST["EXPHID"]);
			$COMMDATE			= insertDateMySQlFormat($_REQUEST["COMMDATE"]);
			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
			
				
				$FNA_Balance_Query_Flag = mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_balance"));
				$MaxFlag				= $FNA_Balance_Query_Flag['MAX(FLAG)'];
				
				$FNA_Balance_Query  	= mysql_fetch_array(mysql_query("SELECT BALANCE FROM fna_balance WHERE FLAG = '".$MaxFlag."'"));
				$BALANCE				= $FNA_Balance_Query['BALANCE'];
				
				if($BALANCE >= $TOTALCOMMISSION){
					
					$EntrySerial_Query_Flag = mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_entryserialno"));
					$MaxFlagEntrySl			= $EntrySerial_Query_Flag['MAX(FLAG)'];
					
					$EntrySerial_Query_No	= mysql_fetch_array(mysql_query("SELECT MAX(ENTRYSERIALNOID) FROM fna_entryserialno"));
					$MaxEntrySlNo			= $EntrySerial_Query_No['MAX(ENTRYSERIALNOID)'] + 1;
			
			
					$insertQueryEntrySl = "
											INSERT INTO 
														fna_entryserialno
																		(
																			ENTRYSERIALNO,
																			PROJECTID,
																			SUBPROJECTID,
																			ENTRYDATE,
																			FLAG,
																			STATUS,
																			ENTDATE,
																			ENTTIME,
																			USERID
																		) 
																VALUES
																		(
																			'".$MaxEntrySlNo."',
																			'".$PROJECTID."',
																			'".$SUBPROJECTID."',
																			'".$COMMDATE."',
																			'".$MaxFlagEntrySl."',
																			'Active',
																			'".$entDate."',
																			'".$entTime."',
																			'".$userId."'
																		)
										";
					$insertQueryEntrySlStatement = mysql_query($insertQueryEntrySl);
					
					$COMM_FLAG_QRY			= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_alucommission"));
					$MAXCOMMISSION_FLAG 	= $COMM_FLAG_QRY['MAX(FLAG)'];
					$NOW_MAXCOMMISSION_FLAG	= $MAXCOMMISSION_FLAG + 1;
					
					$PARTY_FLAG_QRY			= mysql_fetch_array(mysql_query("SELECT MAX(PARTYFLAG) FROM fna_alucommission WHERE PARTYID = '".$PARTYID."'"));
					$MAXPARTY_FLAG	 		= $PARTY_FLAG_QRY['MAX(PARTYFLAG)'];
					$NOW_MAXPARTY_FLAG	 	= $MAXPARTY_FLAG + 1;
					
					$insertQueryAluBook = "
												INSERT INTO 
															fna_alucommission
																	(
																		ENTRYSERIALNOID,
																		PROJECTID,
																		SUBPROJECTID,
																		PARTYID,
																		TOTALBASTA,
																		COMMISSIONPERBASTA,
																		TOTALCOMMISSION,
																		COMMDATE,
																		PARTYFLAG,
																		FLAG,
																		STATUS,
																		ENTDATE,
																		ENTTIME,
																		USERID
																	) 
															VALUES
																	(
																		'".$MaxEntrySlNo."',
																		'".$PROJECTID."',
																		'".$SUBPROJECTID."',
																		'".$PARTYID."',
																		'".$TOT_BASTA."',
																		'".$PERBASTA_AMOUNT."',
																		'".$TOTALCOMMISSION."',
																		'".$COMMDATE."',
																		'".$NOW_MAXPARTY_FLAG."',
																		'".$NOW_MAXCOMMISSION_FLAG."',
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
											";
							$insertQueryAluBookStatement = mysql_query($insertQueryAluBook);
							
							//Update FNA Balance Table Start
									$BALANCE_FLAG 			= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_balance"));
									$MAXBALANCE_FLAG 		= $BALANCE_FLAG['MAX(FLAG)'];
									$NOW_MAXBALANCE_FLAG 	= $MAXBALANCE_FLAG + 1;
									
									$BALANCE_QUERY		 	= mysql_fetch_array(mysql_query("SELECT * FROM fna_balance WHERE FLAG = '".$MAXBALANCE_FLAG."'"));
									$INCOME_AMOUNT 			= $BALANCE_QUERY['INCOME'];
									$EXPANSE_AMOUNT			= $BALANCE_QUERY['EXPANSE'];
									$BALANCE_AMOUNT 		= $BALANCE_QUERY['BALANCE'];
									
									$NOW_BALANCE_AMOUNT		= $BALANCE_AMOUNT - $TOTALCOMMISSION ;
									
									$insertBalanceQuery = "
															INSERT INTO 
																		fna_balance
																				(
																					ENTRYSERIALNOID,
																					PROJECTID,
																					SUBPROJECTID,
																					EXPANSE,
																					BALANCE,
																					FLAG,
																					BALDATE,
																					STATUS,
																					ENTDATE,
																					ENTTIME,
																					USERID
																				) 
																		VALUES
																				(
																					'".$MaxEntrySlNo."',
																					'".$PROJECTID."',
																					'".$SUBPROJECTID."',
																					'".$TOTALCOMMISSION."',
																					'".$NOW_BALANCE_AMOUNT."',
																					'".$NOW_MAXBALANCE_FLAG."',
																					'".$COMMDATE."',
																					'Payment',
																					'".$entDate."',
																					'".$entTime."',
																					'".$userId."'
																				)
										";
										$insertBalanceQueryStatement = mysql_query($insertBalanceQuery);
									//Update FNA Balance Table End
									
									//----------------------------------------------------Update Daily Income Expanse Table Start------------------------------------------------
										$INEX_FLAG	 			= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_daily_income_expanse"));
										$MAXINEX_FLAG	 		= $INEX_FLAG['MAX(FLAG)'];
										$NOW_MAXINEX_FLAG	 	= $MAXINEX_FLAG + 1;
										
										$PARTYNAME_QRY 			= mysql_fetch_array(mysql_query("SELECT PARTYNAME FROM fna_party WHERE PARTYID = '".$PARTYID."'"));
										$PARTYNAME				= $PARTYNAME_QRY['PARTYNAME'];
										$NOW_DESCRIPTION		= 'Alu Commission to '.$PARTYNAME . ' --Alu Commission   (' .$DESCRIPTION. ')';
										
										$insertDailyInExQuery = "
																INSERT INTO 
																				fna_daily_income_expanse
																											(
																												ENTRYSERIALNOID,
																												PROJECTID,
																												SUBPROJECTID,
																												DATE,
																												EXPHID,
																												EXPANSE,
																												DESCRIPTION,
																												FLAG,
																												STATUS,
																												ENTDATE,
																												ENTTIME,
																												USERID
																											) 
																									VALUES
																											(
																												'".$MaxEntrySlNo."',
																												'".$PROJECTID."',
																												'".$SUBPROJECTID."',
																												'".$COMMDATE."',
																												'44',
																												'".$TOTALCOMMISSION."',
																												'".$NOW_DESCRIPTION."',
																												'".$NOW_MAXINEX_FLAG."',
																												'Active',
																												'".$entDate."',
																												'".$entTime."',
																												'".$userId."'
																											)
																	";
												
												
												$insertDailyInExQueryStatement = mysql_query($insertDailyInExQuery);
									
									//----------------------------------------------------Update Daily Income Expanse Table End ------------------------------------------------
									
									//----------------------------------------------------Update FNA Expanse Table Start ------------------------------------------------
									
									
									
									$insertQueryExp = "
															INSERT INTO 
																		fna_expanse
																						(
																							ENTRYSERIALNOID,
																							PROJECTID,
																							SUBPROJECTID,
																							EXPHID,
																							EXPSUBHID,
																							PARTYID,
																							AMOUNT,
																							EXPDATE,
																							VOUCHERNO,
																							DESCRIPTION,
																							STATUS,
																							ENTDATE,
																							ENTTIME,
																							USERID
																						) 
																				VALUES
																						(
																							'".$MaxEntrySlNo."',
																							'".$PROJECTID."',
																							'".$SUBPROJECTID."',
																							'0',
																							'0',
																							'".$PARTYID."',
																							'".$TOTALCOMMISSION."',
																							'".$COMMDATE."',
																							'',
																							'".$NOW_DESCRIPTION."',
																							'Active',
																							'".$entDate."',
																							'".$entTime."',
																							'".$userId."'
																						)
														";
										$insertQueryExpStatement = mysql_query($insertQueryExp);
					
							if($insertBalanceQueryStatement){
								$msg = "<span class='validMsg'>This Party Commission Amount added sucessfully</span>";
							} else {
								$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
							}
							
					
				}else{
						$msg = "<span class='errorMsg'>Sorry! Insufficient Balance.......!</span>";
					}
			return $msg;
				
		}
		// Insert Alu Commission Entry End
		
		
		// Insert Expanse Entry start   
		function InsertIncomeInfo($userId){
			
			$PROJECTID 			= $_REQUEST["PROJECTID"];
			$SUBPROJECTID		= $_REQUEST["SUBPROJECTID"];
			$BATCHNO			= addslashes($_REQUEST["BATCHNO"]);
			
			$PARTYID 			= addslashes($_REQUEST["PARTYID"]);
			$INHID	 			= addslashes($_REQUEST["INHID"]);
			//$EXPSUBHID 			= addslashes($_REQUEST["EXPSUBHID"]);
			$AMOUNT 			= addslashes($_REQUEST["AMOUNT"]);
			$INDATE 			= insertDateMySQlFormat($_REQUEST["INDATE"]);
			$DESCRIPTION 		= addslashes($_REQUEST["DESCRIPTION"]);
			$VOUCHERNO			= addslashes($_REQUEST["VOUCHERNO"]);
			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
			$IncQuery		= "
									SELECT 
											VOUCHERNO
									FROM 
											fna_income
									WHERE VOUCHERNO = '".$VOUCHERNO."'
								  ";
								
			$IncQueryStatement	= mysql_query($IncQuery);
			if(mysql_num_rows($IncQueryStatement)>0) {
				$msg = "<span class='errorMsg'>Sorry, This Voucher Number [ $VOUCHERNO ] already exist!</span>";
			} else {
				
				if($PROJECTID != 3){
					
					
						$EntrySerial_Query_Flag = mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_entryserialno"));
						$MaxFlagEntrySl			= $EntrySerial_Query_Flag['MAX(FLAG)'];
						
						$EntrySerial_Query_No	= mysql_fetch_array(mysql_query("SELECT MAX(ENTRYSERIALNOID) FROM fna_entryserialno"));
						$MaxEntrySlNo			= $EntrySerial_Query_No['MAX(ENTRYSERIALNOID)'] + 1;
				
				
						$insertQueryEntrySl = "
												INSERT INTO 
															fna_entryserialno
																			(
																				ENTRYSERIALNO,
																				PROJECTID,
																				SUBPROJECTID,
																				ENTRYDATE,
																				FLAG,
																				STATUS,
																				ENTDATE,
																				ENTTIME,
																				USERID
																			) 
																	VALUES
																			(
																				'".$MaxEntrySlNo."',
																				'".$PROJECTID."',
																				'".$SUBPROJECTID."',
																				'".$INDATE."',
																				'".$MaxFlagEntrySl."',
																				'Active',
																				'".$entDate."',
																				'".$entTime."',
																				'".$userId."'
																			)
											";
						$insertQueryEntrySlStatement = mysql_query($insertQueryEntrySl);
				
						$FNA_Balance_Query_Flag = mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_balance"));
						$MaxFlag				= $FNA_Balance_Query_Flag['MAX(FLAG)'];
						
						$FNA_Balance_Query  	= mysql_fetch_array(mysql_query("SELECT BALANCE FROM fna_balance WHERE FLAG = '".$MaxFlag."'"));
						$BALANCE				= $FNA_Balance_Query['BALANCE'];
						
						
						$insertQueryExp = "
												INSERT INTO 
															fna_income
																			(
																				ENTRYSERIALNOID,
																				PROJECTID,
																				SUBPROJECTID,
																				INHID,
																				INSUBHID,
																				PARTYID,
																				AMOUNT,
																				INDATE,
																				VOUCHERNO,
																				DESCRIPTION,
																				STATUS,
																				ENTDATE,
																				ENTTIME,
																				USERID
																			) 
																	VALUES
																			(
																				'".$MaxEntrySlNo."',
																				'".$PROJECTID."',
																				'".$SUBPROJECTID."',
																				'".$INHID."',
																				'0',
																				'".$PARTYID."',
																				'".$AMOUNT."',
																				'".$INDATE."',
																				'".$VOUCHERNO."',
																				'".$DESCRIPTION."',
																				'Active',
																				'".$entDate."',
																				'".$entTime."',
																				'".$userId."'
																			)
											";
							$insertQueryExpStatement = mysql_query($insertQueryExp);
							
							//Update FNA Balance Table Start
									$BALANCE_FLAG 			= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_balance"));
									$MAXBALANCE_FLAG 		= $BALANCE_FLAG['MAX(FLAG)'];
									$NOW_MAXBALANCE_FLAG 	= $MAXBALANCE_FLAG + 1;
									
									$BALANCE_QUERY		 	= mysql_fetch_array(mysql_query("SELECT * FROM fna_balance WHERE FLAG = '".$MAXBALANCE_FLAG."'"));
									$INCOME_AMOUNT 			= $BALANCE_QUERY['INCOME'];
									$EXPANSE_AMOUNT			= $BALANCE_QUERY['EXPANSE'];
									$BALANCE_AMOUNT 		= $BALANCE_QUERY['BALANCE'];
									
									$NOW_BALANCE_AMOUNT		= $BALANCE_AMOUNT + $AMOUNT ;
									
									$insertBalanceQuery = "
															INSERT INTO 
																		fna_balance
																				(
																					ENTRYSERIALNOID,
																					PROJECTID,
																					SUBPROJECTID,
																					INCOME,
																					BALANCE,
																					FLAG,
																					BALDATE,
																					STATUS,
																					ENTDATE,
																					ENTTIME,
																					USERID
																				) 
																		VALUES
																				(
																					'".$MaxEntrySlNo."',
																					'".$PROJECTID."',
																					'".$SUBPROJECTID."',
																					'".$AMOUNT."',
																					'".$NOW_BALANCE_AMOUNT."',
																					'".$NOW_MAXBALANCE_FLAG."',
																					'".$INDATE."',
																					'Income',
																					'".$entDate."',
																					'".$entTime."',
																					'".$userId."'
																				)
										";
										$insertBalanceQueryStatement = mysql_query($insertBalanceQuery);
									//Update FNA Balance Table End
									
									//----------------------------------------------------Update Daily Income Expanse Table Start------------------------------------------------
										$INEX_FLAG	 			= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_daily_income_expanse"));
										$MAXINEX_FLAG	 		= $INEX_FLAG['MAX(FLAG)'];
										$NOW_MAXINEX_FLAG	 	= $MAXINEX_FLAG + 1;
										
										$PARTYNAME_QRY 			= mysql_fetch_array(mysql_query("SELECT PARTYNAME FROM fna_party WHERE PARTYID = '".$PARTYID."'"));
										$PARTYNAME				= $PARTYNAME_QRY['PARTYNAME'];
										$NOW_DESCRIPTION		= 'Income from  '.$PARTYNAME . '  (' .$DESCRIPTION. ')';
										
										
										$insertDailyInExQuery = "
																INSERT INTO 
																				fna_daily_income_expanse
																											(
																												ENTRYSERIALNOID,
																												PROJECTID,
																												SUBPROJECTID,
																												DATE,
																												INHID,
																												INCOME,
																												DESCRIPTION,
																												FLAG,
																												STATUS,
																												ENTDATE,
																												ENTTIME,
																												USERID
																											) 
																									VALUES
																											(
																												'".$MaxEntrySlNo."',
																												'".$PROJECTID."',
																												'".$SUBPROJECTID."',
																												'".$INDATE."',
																												'".$INHID."',
																												'".$AMOUNT."',
																												'".$NOW_DESCRIPTION."',
																												'".$NOW_MAXINEX_FLAG."',
																												'Active',
																												'".$entDate."',
																												'".$entTime."',
																												'".$userId."'
																											)
																	";
												
												
												$insertDailyInExQueryStatement = mysql_query($insertDailyInExQuery);
									
									//----------------------------------------------------Update Daily Income Expanse Table End ------------------------------------------------
									
								if($insertQueryExpStatement){
									$msg = "<span class='validMsg'>This Voucher Number [ $VOUCHERNO ] added sucessfully</span>";
								} else {
									$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
								}
					}else{
						
						$EntrySerial_Query_Flag = mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_entryserialno"));
						$MaxFlagEntrySl			= $EntrySerial_Query_Flag['MAX(FLAG)'];
						
						$EntrySerial_Query_No	= mysql_fetch_array(mysql_query("SELECT MAX(ENTRYSERIALNOID) FROM fna_entryserialno"));
						$MaxEntrySlNo			= $EntrySerial_Query_No['MAX(ENTRYSERIALNOID)'] + 1;
				
				
						$insertQueryEntrySl = "
												INSERT INTO 
															fna_entryserialno
																			(
																				ENTRYSERIALNO,
																				PROJECTID,
																				SUBPROJECTID,
																				ENTRYDATE,
																				FLAG,
																				STATUS,
																				ENTDATE,
																				ENTTIME,
																				USERID
																			) 
																	VALUES
																			(
																				'".$MaxEntrySlNo."',
																				'".$PROJECTID."',
																				'".$SUBPROJECTID."',
																				'".$INDATE."',
																				'".$MaxFlagEntrySl."',
																				'Active',
																				'".$entDate."',
																				'".$entTime."',
																				'".$userId."'
																			)
											";
						$insertQueryEntrySlStatement = mysql_query($insertQueryEntrySl);
						/*
						$INEX_FLAG	 			= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_daily_income_expanse"));
						$MAXINEX_FLAG	 		= $INEX_FLAG['MAX(FLAG)'];
						$NOW_MAXINEX_FLAG	 	= $MAXINEX_FLAG + 1;
						
						$INCHEADNAME_QRY 		= mysql_fetch_array(mysql_query("SELECT INCHEADNAME FROM fna_income_head WHERE INHID = '".$INHID."'"));
						$INCHEAD_NAME			= $INCHEADNAME_QRY['INCHEADNAME'];
						$PARTYNAME_QRY 			= mysql_fetch_array(mysql_query("SELECT PARTYNAME FROM fna_party WHERE PARTYID = '".$PARTYID."'"));
						$PARTYNAME				= $PARTYNAME_QRY['PARTYNAME'];
						$NOW_DESCRIPTION		= 'Income from '.$BATCHNO . ' No Batch er '.'' .$INCHEAD_NAME . ' Babod '.'' .$PARTYNAME . '  = Poultry  (' .$DESCRIPTION. ')';
						
										
						$insertQuery_OIn	= "
													INSERT INTO 
															pal_others_income_expanse
																				(
																					ENTRYSERIALNOID,
																					POINID,
																					BATCHNO,
																					PARTYID,
																					INCOMEAMOUNT,
																					INVOICENO,
																					REMARKS,
																					ENTRYDATE,
																					STATUS,
																					ENTDATE,
																					ENTTIME,
																					USERID
																				) 
																		VALUES
																				(
																					'".$MaxEntrySlNo."',
																					'".$INHID."',
																					'".$BATCHNO."',
																					'".$PARTYID."',
																					'".$AMOUNT."',
																					'".$VOUCHERNO."',
																					'".$NOW_DESCRIPTION."',
																					'".$INDATE."',
																					'Active',
																					'".$entDate."',
																					'".$entTime."',
																					'".$userId."'
																				)
												"; 
							$insertQuery_OInStatement = mysql_query($insertQuery_OIn);
						*/	
							
							if($insertQueryEntrySlStatement){
								
								//Update Party Bill Table Start
										$PartyFlagQuery				= mysql_fetch_array(mysql_query("SELECT MAX(PARTYFLAG) FROM fna_partybill WHERE PARTYID = '".$PARTYID."' AND PURSELLFLAG = 'Sell'"));
										$MaxPartyFlag				= $PartyFlagQuery['MAX(PARTYFLAG)'];
										$NowMaxPartyFlag			= $PartyFlagQuery['MAX(PARTYFLAG)'] + 1;
										
										$PartyBalanceQuery			= mysql_fetch_array(mysql_query("SELECT BALANCEAMOUNT FROM fna_partybill WHERE PARTYID = '".$PARTYID."' AND PARTYFLAG = '".$MaxPartyFlag."' AND PURSELLFLAG = 'Sell'"));
										$PartyBalanceAmount			= $PartyBalanceQuery['BALANCEAMOUNT'];
										$NowPartyBalanceAmount		= $PartyBalanceAmount + $AMOUNT ; 
										
										$insertPartyQuery 			= "
																		INSERT INTO 
																					fna_partybill
																									(
																										ENTRYSERIALNOID,
																										PARTYID,
																										PROJECTID,
																										SUBPROJECTID,
																										BATCHNO,
																										SELL_BILLAMOUNT,
																										PAYMENTAMOUNT,
																										RECEIVEAMOUNT,
																										BALANCEAMOUNT,
																										ENTRYDATE,
																										PARTYFLAG,
																										STATUS,
																										PURSELLFLAG,
																										ENTDATE,
																										ENTTIME,
																										USERID
																									) 
																								VALUES
																									(
																										'".$MaxEntrySlNo."',
																										'".$PARTYID."',
																										'3',
																										'8',
																										'".$BATCHNO."',
																										'".$AMOUNT."',
																										'0',
																										'0',
																										'".$NowPartyBalanceAmount."',
																										'".$INDATE."',
																										'".$NowMaxPartyFlag."',
																										'Sell',
																										'Sell',
																										'".$entDate."',
																										'".$entTime."',
																										'".$userId."'
																									)
																								"; 
										$insertPartyQueryStatement = mysql_query($insertPartyQuery);
										
								//Update Party Bill Table End
								
								//Update FNA Balance Table Start
									$BALANCE_IN_FLAG 			= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_balance"));
									$MAXBALANCE_IN_FLAG 		= $BALANCE_IN_FLAG['MAX(FLAG)'];
									$NOW_MAXBALANCE_IN_FLAG 	= $MAXBALANCE_IN_FLAG + 1;
									
									$BALANCE_IN_QUERY		 	= mysql_fetch_array(mysql_query("SELECT * FROM fna_balance WHERE FLAG = '".$MAXBALANCE_IN_FLAG."'"));
									$INCOME_IN_AMOUNT 			= $BALANCE_IN_QUERY['INCOME'];
									$EXPANSE_IN_AMOUNT			= $BALANCE_IN_QUERY['EXPANSE'];
									$BALANCE_IN_AMOUNT 			= $BALANCE_IN_QUERY['BALANCE'];
									
									$NOW_BALANCE_IN_AMOUNT		= $BALANCE_IN_AMOUNT + $AMOUNT ;
									
									$insertBalanceInQuery = "
															INSERT INTO 
																		fna_balance
																				(
																					ENTRYSERIALNOID,
																					PROJECTID,
																					SUBPROJECTID,
																					INCOME,
																					BALANCE,
																					FLAG,
																					BALDATE,
																					STATUS,
																					ENTDATE,
																					ENTTIME,
																					USERID
																				) 
																		VALUES
																				(
																					'".$MaxEntrySlNo."',
																					'3',
																					'8',
																					'".$AMOUNT."',
																					'".$NOW_BALANCE_IN_AMOUNT."',
																					'".$NOW_MAXBALANCE_IN_FLAG."',
																					'".$INDATE."',
																					'Receive',
																					'".$entDate."',
																					'".$entTime."',
																					'".$userId."'
																				)
										";
										$insertBalanceInQueryStatement = mysql_query($insertBalanceInQuery);
									//Update FNA Balance Table End
								
									//----------------------------------------------------Update Daily Income Expanse Table Start------------------------------------------------
										$INEX_FLAG	 			= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_daily_income_expanse"));
										$MAXINEX_FLAG	 		= $INEX_FLAG['MAX(FLAG)'];
										$NOW_MAXINEX_FLAG	 	= $MAXINEX_FLAG + 1;
										
										$INCHEADNAME_QRY 		= mysql_fetch_array(mysql_query("SELECT INCHEADNAME FROM fna_income_head WHERE INHID = '".$INHID."'"));
										$INCHEAD_NAME			= $INCHEADNAME_QRY['INCHEADNAME'];
										$PARTYNAME_QRY 			= mysql_fetch_array(mysql_query("SELECT PARTYNAME FROM fna_party WHERE PARTYID = '".$PARTYID."'"));
										$PARTYNAME				= $PARTYNAME_QRY['PARTYNAME'];
										$NOW_DESCRIPTION		= 'Income from '.$BATCHNO . ' No Batch er '.'' .$INCHEAD_NAME . ' Babod '.'' .$PARTYNAME . '  = Poultry   (' .$DESCRIPTION. ')';
										
										
										
										$insertDailyInQuery = "
																INSERT INTO 
																				fna_daily_income_expanse
																											(
																												ENTRYSERIALNOID,
																												PROJECTID,
																												SUBPROJECTID,
																												DATE,
																												INHID,
																												INCOME,
																												DESCRIPTION,
																												FLAG,
																												STATUS,
																												ENTDATE,
																												ENTTIME,
																												USERID
																											) 
																									VALUES
																											(
																												'".$MaxEntrySlNo."',
																												'3',
																												'8',
																												'".$INDATE."',
																												'".$INHID."',
																												'".$AMOUNT."',
																												'".$NOW_DESCRIPTION."',
																												'".$NOW_MAXINEX_FLAG."',
																												'Active',
																												'".$entDate."',
																												'".$entTime."',
																												'".$userId."'
																											)
																	";
												
												
												$insertDailyInQueryStatement = mysql_query($insertDailyInQuery);
							
							//----------------------------------------------------Update Daily Income Expanse Table End ------------------------------------------------
							
										$FNA_Balance_Query_Flag = mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_balance"));
										$MaxFlag				= $FNA_Balance_Query_Flag['MAX(FLAG)'];
										
										$FNA_Balance_Query  	= mysql_fetch_array(mysql_query("SELECT BALANCE FROM fna_balance WHERE FLAG = '".$MaxFlag."'"));
										$BALANCE				= $FNA_Balance_Query['BALANCE'];
										
										
										$insertQueryExp = "
																INSERT INTO 
																			fna_income
																							(
																								ENTRYSERIALNOID,
																								PROJECTID,
																								SUBPROJECTID,
																								INHID,
																								INSUBHID,
																								PARTYID,
																								AMOUNT,
																								INDATE,
																								VOUCHERNO,
																								BATCHNO,
																								DESCRIPTION,
																								STATUS,
																								ENTDATE,
																								ENTTIME,
																								USERID
																							) 
																					VALUES
																							(
																								'".$MaxEntrySlNo."',
																								'".$PROJECTID."',
																								'".$SUBPROJECTID."',
																								'".$INHID."',
																								'0',
																								'".$PARTYID."',
																								'".$AMOUNT."',
																								'".$INDATE."',
																								'".$VOUCHERNO."',
																								'".$BATCHNO."',
																								'".$NOW_DESCRIPTION."',
																								'Active',
																								'".$entDate."',
																								'".$entTime."',
																								'".$userId."'
																							)
												";
								$insertQueryExpStatement = mysql_query($insertQueryExp);
									$msg = "<span class='validMsg'>This Batch No Information ($BATCHNO)  added sucessfully</span>";
								
							} else {
								$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
							}
							
					}//if($PROJECTID != 3)
				
			}
			return $msg;
			
			
			
			
		}
		// Insert Expanse Entry End
		
		// Insert Loan Entry start   
		function insertLoanInfo($userId){
			
			$PROJECTID 			= $_REQUEST["PROJECTID"];
			$SUBPROJECTID		= $_REQUEST["SUBPROJECTID"];
			
			$BASTAUNITPRICE		= addslashes($_REQUEST["BASTAUNITPRICE"]);
			$BASTAQNTY			= addslashes($_REQUEST["BASTAQNTY"]);
			$UNITPRICE			= addslashes($_REQUEST["BASTAUNITPRICE"]);
			
			$PARTYID 			= addslashes($_REQUEST["PARTYID"]);
			$LOANAMOUNT			= addslashes($_REQUEST["LOANAMOUNT"]);
			$ENTRYDATE 			= insertDateMySQlFormat($_REQUEST["ENTRYDATE"]);
			$LOANPURPOSE 		= addslashes($_REQUEST["LOANPURPOSE"]);
			$LOANTYPEID			= addslashes($_REQUEST["LOANTYPEID"]);
			$INTERESTRATE		= addslashes($_REQUEST["INTERESTRATE"]);
			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
			$LoanQuery		= "
									SELECT 
											PROJECTID,
											SUBPROJECTID,
											PARTYID,
											LOANAMOUNT,
											ENTRYDATE,
											LOANPURPOSE
									FROM 
											fna_loan
									WHERE PARTYID 		= '".$PARTYID."' 
									AND SUBPROJECTID 	= '".$SUBPROJECTID."'
									AND LOANAMOUNT 		= '".$LOANAMOUNT."'
									AND ENTRYDATE 		= '".$ENTRYDATE."'
									AND LOANPURPOSE 	= '".$LOANPURPOSE."'
								  ";
			$LoanQueryStatement	= mysql_query($LoanQuery);
			if(mysql_num_rows($LoanQueryStatement)>0) {
				$msg = "<span class='errorMsg'>Sorry, This Party [ $PARTYID ] already exist!</span>";
			} else {
				
						
					$EntrySerial_Query_Flag = mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_entryserialno"));
					$MaxFlagEntrySl			= $EntrySerial_Query_Flag['MAX(FLAG)'];
					
					$EntrySerial_Query_No	= mysql_fetch_array(mysql_query("SELECT MAX(ENTRYSERIALNOID) FROM fna_entryserialno"));
					$MaxEntrySlNo			= $EntrySerial_Query_No['MAX(ENTRYSERIALNOID)'] + 1;
			
			
					$insertQueryEntrySl = "
											INSERT INTO 
														fna_entryserialno
																		(
																			ENTRYSERIALNO,
																			PROJECTID,
																			SUBPROJECTID,
																			ENTRYDATE,
																			FLAG,
																			STATUS,
																			ENTDATE,
																			ENTTIME,
																			USERID
																		) 
																VALUES
																		(
																			'".$MaxEntrySlNo."',
																			'".$PROJECTID."',
																			'".$SUBPROJECTID."',
																			'".$ENTRYDATE."',
																			'".$MaxFlagEntrySl."',
																			'Active',
																			'".$entDate."',
																			'".$entTime."',
																			'".$userId."'
																		)
										";
					$insertQueryEntrySlStatement = mysql_query($insertQueryEntrySl);
						
						$MAXPARTYFLAG_ALU_QRY 		= mysql_fetch_array(mysql_query("SELECT MAX(PARTYFLAG) FROM fna_alustock WHERE PARTYID = '".$PARTYID."'"));
						$MAXPARTY_FLAG_ALU	 		= $MAXPARTYFLAG_ALU_QRY['MAX(PARTYFLAG)'];
						
						
						$PARTY_TOTAL_BASTA_QRY	= mysql_fetch_array(mysql_query("SELECT PARTYTOTQNTY FROM fna_alustock WHERE PARTYID = '".$PARTYID."' AND PARTYFLAG = '".$MAXPARTY_FLAG_ALU."'"));
						$PARTY_TOTAL_BASTA 	= $PARTY_TOTAL_BASTA_QRY['PARTYTOTQNTY'];
						
						$MAXPARTYFLAG 		= mysql_fetch_array(mysql_query("SELECT MAX(PARTYFLAG) FROM fna_loan WHERE PARTYID = '".$PARTYID."'"));
						$MAXPARTY_FLAG	 	= $MAXPARTYFLAG['MAX(PARTYFLAG)'];
						$NOW_MAXPARTY_FLAG 	= $MAXPARTY_FLAG + 1;
						
						$LOAN_NUM_QRY 			= mysql_fetch_array(mysql_query("SELECT MAX(LOAN_NUMBER) FROM fna_loan WHERE PARTYID = '".$PARTYID."'"));
						$MAXLOAN_NUMBER	 		= $LOAN_NUM_QRY['MAX(LOAN_NUMBER)'];
						$NOW_MAXLOAN_NUMBER 	= $MAXLOAN_NUMBER + 1;
						
						$MAXLOANFLAG 		= mysql_fetch_array(mysql_query("SELECT MAX(LOANFLAG) FROM fna_loan WHERE PARTYID = '".$PARTYID."'"));
						$MAXLOAN_FLAG	 	= $MAXLOANFLAG['MAX(LOANFLAG)'];
						$NOW_MAXLOAN_FLAG 	= $MAXLOAN_FLAG + 1;
						
						
						$BALANCE_QRY		= mysql_fetch_array(mysql_query("SELECT LOAN_BALANCE FROM fna_loan WHERE PARTYID = '".$PARTYID."' AND PARTYFLAG = '".$MAXPARTY_FLAG."'"));
						$BALANCE		 	= $BALANCE_QRY['LOAN_BALANCE'];
						$NOW_BALANCE		= $BALANCE + $LOANAMOUNT ;
						
						
						
						$MAX_ALUPRICE_FLAG_QRY 		= mysql_fetch_array(mysql_query("SELECT MAX(PRICEFLAG) FROM alu_presentprice "));
						$MAX_ALUPRICE_FLAG	 		= $MAX_ALUPRICE_FLAG_QRY['MAX(PRICEFLAG)'];
						//$NOW_MAX_ALUPRICE_FLAG 		= $MAX_ALUPRICE_FLAG + 1;
						
						$ALU_PRESENTPRICE_QRY	= mysql_fetch_array(mysql_query("SELECT PRESENTPRICE FROM alu_presentprice WHERE PRICEFLAG = '".$MAX_ALUPRICE_FLAG."'"));
						$ALU_PRESENT_PRICE	 	= $ALU_PRESENTPRICE_QRY['PRESENTPRICE'];
						
						$PARTY_TOTAL_BASTA_PRICE	= $ALU_PRESENT_PRICE * $PARTY_TOTAL_BASTA ; 
						
						$LOAN_FOR_PAY				= ($PARTY_TOTAL_BASTA_PRICE * 50)/100 ;
						
						$Elligible_For_Loan			= $LOAN_FOR_PAY - $BALANCE ;
						
						if($Elligible_For_Loan >= $LOANAMOUNT){
								
								$insertQueryLoan = "
														INSERT INTO 
																	fna_loan
																			(
																				ENTRYSERIALNOID,
																				PROJECTID,
																				SUBPROJECTID,
																				LOANTYPEID,
																				PARTYID,
																				LOAN_NUMBER,
																				LOANDATE,
																				LOAN_PAYMENTDATE,
																				LOANAMOUNT,
																				PRINCIPALAMOUNT,
																				RESTOFTHE_AMOUNT,
																				LOANPAYMENT,
																				INTERESTRATE,
																				INTERESTAMOUNT,
																				LOAN_BALANCE,
																				ENTRYDATE,
																				LOANPURPOSE,
																				PARTYFLAG,
																				LOANFLAG,
																				STATUS,
																				ENTDATE,
																				ENTTIME,
																				USERID
																			) 
																	VALUES
																			(
																				'".$MaxEntrySlNo."',
																				'".$PROJECTID."',
																				'".$SUBPROJECTID."',
																				'".$LOANTYPEID."',
																				'".$PARTYID."',
																				'".$NOW_MAXLOAN_NUMBER."',
																				'".$ENTRYDATE."',
																				'',
																				'".$LOANAMOUNT."',
																				'0',
																				'".$LOANAMOUNT."',
																				'0',
																				'".$INTERESTRATE."',
																				'0',
																				'".$NOW_BALANCE."',
																				'".$ENTRYDATE."',
																				'".$LOANPURPOSE."',
																				'".$NOW_MAXPARTY_FLAG."',
																				'".$NOW_MAXLOAN_FLAG."',
																				'Active',
																				'".$entDate."',
																				'".$entTime."',
																				'".$userId."'
																			)
											";
								$insertQueryLoanStatement = mysql_query($insertQueryLoan);
								
								//Update FNA Balance Table Start
									$BALANCE_FLAG 			= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_balance"));
									$MAXBALANCE_FLAG 		= $BALANCE_FLAG['MAX(FLAG)'];
									$NOW_MAXBALANCE_FLAG 	= $MAXBALANCE_FLAG + 1;
									
									$BALANCE_QUERY		 	= mysql_fetch_array(mysql_query("SELECT * FROM fna_balance WHERE FLAG = '".$MAXBALANCE_FLAG."'"));
									$INCOME_AMOUNT 			= $BALANCE_QUERY['INCOME'];
									$EXPANSE_AMOUNT			= $BALANCE_QUERY['EXPANSE'];
									$BALANCE_AMOUNT 		= $BALANCE_QUERY['BALANCE'];
									
									$NOW_BALANCE_AMOUNT		= $BALANCE_AMOUNT - $LOANAMOUNT ;
									
									$insertBalanceQuery = "
															INSERT INTO 
																		fna_balance
																				(
																					ENTRYSERIALNOID,
																					PROJECTID,
																					SUBPROJECTID,
																					EXPANSE,
																					BALANCE,
																					FLAG,
																					BALDATE,
																					STATUS,
																					ENTDATE,
																					ENTTIME,
																					USERID
																				) 
																		VALUES
																				(
																					'".$MaxEntrySlNo."',
																					'".$PROJECTID."',
																					'".$SUBPROJECTID."',
																					'".$LOANAMOUNT."',
																					'".$NOW_BALANCE_AMOUNT."',
																					'".$NOW_MAXBALANCE_FLAG."',
																					'".$ENTRYDATE."',
																					'Loan',
																					'".$entDate."',
																					'".$entTime."',
																					'".$userId."'
																				)
										";
										$insertBalanceQueryStatement = mysql_query($insertBalanceQuery);
									//Update FNA Balance Table End
									
									//Update FNA Daily Income Expanse Table  Start
									$INEX_FLAG	 			= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_daily_income_expanse"));
									$MAXINEX_FLAG	 		= $INEX_FLAG['MAX(FLAG)'];
									$NOW_MAXINEX_FLAG	 	= $MAXINEX_FLAG + 1;
									
									$PARTYNAME_QRY 			= mysql_fetch_array(mysql_query("SELECT PARTYNAME FROM fna_party WHERE PARTYID = '".$PARTYID."'"));
									$PARTYNAME				= $PARTYNAME_QRY['PARTYNAME'];
									$NOW_DESCRIPTION		= 'Loan Payment to '.$PARTYNAME . '   (' .$DESCRIPTION. ')';
									
									$insertDailyInExQuery = "
															INSERT INTO 
																			fna_daily_income_expanse
																										(
																											ENTRYSERIALNOID,
																											PROJECTID,
																											SUBPROJECTID,
																											DATE,
																											EXPANSE,
																											DESCRIPTION,
																											FLAG,
																											STATUS,
																											ENTDATE,
																											ENTTIME,
																											USERID
																										) 
																								VALUES
																										(
																											'".$MaxEntrySlNo."',
																											'".$PROJECTID."',
																											'".$SUBPROJECTID."',
																											'".$ENTRYDATE."',
																											'".$LOANAMOUNT."',
																											'".$NOW_DESCRIPTION."',
																											'".$NOW_MAXINEX_FLAG."',
																											'Active',
																											'".$entDate."',
																											'".$entTime."',
																											'".$userId."'
																										)
																";
											
											
											$insertDailyInExQueryStatement = mysql_query($insertDailyInExQuery);
									//Update FNA Daily Income Expanse Table End
								
								
								if($insertQueryLoanStatement){
									$msg = "<span class='validMsg'>This Party Loan Amount [ $PARTYID ] added sucessfully</span>";
								} else {
									$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
								}
						
						}else{
							$msg = "<span class='errorMsg'>Sorry, You are not Elligible for [ $LOANAMOUNT ] This Amount....!  // You are Elligible for [ $Elligible_For_Loan ] this amount...</span>";
							//$msg = "<span class='validMsg'>You are Elligible for [ $Elligible_For_Loan ] This Amount....!</span>";
						}
					}
					return $msg;
					
			
			
			
		}
		// Insert Loan Entry End
		
		// Insert Basta Entry start   
		function insertBastaInfo($userId){
			
			$PROJECTID 			= $_REQUEST["PROJECTID"];
			$SUBPROJECTID		= $_REQUEST["SUBPROJECTID"];
			$DESCRIPTION 		= addslashes($_REQUEST["DESCRIPTION"]);
			$PARTYID 			= addslashes($_REQUEST["PARTYID"]);
			$EXPHID 			= addslashes($_REQUEST["EXPHID"]);
						
			$BASTAUNITPRICE		= addslashes($_REQUEST["BASTAUNITPRICE"]);
			$BASTAQNTY			= addslashes($_REQUEST["BASTAQNTY"]);
			$AMOUNT				= addslashes($_REQUEST["AMOUNT"]);
			$BASTAUNITPRICE		= addslashes($_REQUEST["BASTAUNITPRICE"]);
			$ENTRYDATE 			= insertDateMySQlFormat($_REQUEST["ENTRYDATE"]);
			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
			
			$EntrySerial_Query_Flag = mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_entryserialno"));
			$MaxFlagEntrySl			= $EntrySerial_Query_Flag['MAX(FLAG)'];
			
			$EntrySerial_Query_No	= mysql_fetch_array(mysql_query("SELECT MAX(ENTRYSERIALNOID) FROM fna_entryserialno"));
			$MaxEntrySlNo			= $EntrySerial_Query_No['MAX(ENTRYSERIALNOID)'] + 1;
	
	
			$insertQueryEntrySl = "
									INSERT INTO 
												fna_entryserialno
																(
																	ENTRYSERIALNO,
																	PROJECTID,
																	SUBPROJECTID,
																	ENTRYDATE,
																	FLAG,
																	STATUS,
																	ENTDATE,
																	ENTTIME,
																	USERID
																) 
														VALUES
																(
																	'".$MaxEntrySlNo."',
																	'".$PROJECTID."',
																	'".$SUBPROJECTID."',
																	'".$ENTRYDATE."',
																	'".$MaxFlagEntrySl."',
																	'Active',
																	'".$entDate."',
																	'".$entTime."',
																	'".$userId."'
																)
								";
			$insertQueryEntrySlStatement = mysql_query($insertQueryEntrySl);
			
			
			$BastaQuery		= "
									SELECT 
											BUYQNTY,
											BUYPRICE,
											ENTRYDATE
									FROM 
											fna_basta
									WHERE BUYQNTY 		= '".$BASTAQNTY."' 
									AND BUYPRICE 		= '".$AMOUNT."'
									AND ENTRYDATE 		= '".$ENTRYDATE."'
								";
			$BastaQueryStatement	= mysql_query($BastaQuery);
			if(mysql_num_rows($BastaQueryStatement)>0) {
				$msg = "<span class='errorMsg'>Sorry, This Quantity [ $BUYQNTY ] already exist!</span>";
			} else {
						$MAXFLAG 			= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_basta"));
						$MAX_FLAG		 	= $MAXFLAG['MAX(FLAG)'];
						$NOW_MAX_FLAG	 	= $MAX_FLAG + 1;
						
						$TOTBUYQNTY_QRY		= mysql_fetch_array(mysql_query("SELECT TOTBUYQNTY FROM fna_basta WHERE FLAG = '".$MAX_FLAG."'"));
						$TOTBUYQNTY		 	= $TOTBUYQNTY_QRY['TOTBUYQNTY'];
						$NOW_TOTBUYQNTY		= $TOTBUYQNTY + $BASTAQNTY ;
						
						$BALANCE_QRY		= mysql_fetch_array(mysql_query("SELECT BALANCEQNTY FROM fna_basta WHERE FLAG = '".$MAX_FLAG."'"));
						$BALANCEQNTY	 	= $BALANCE_QRY['BALANCEQNTY'];
						$NOW_BALANCE		= $BALANCEQNTY + $BASTAQNTY ;
						
						$TOTBUYPRICE_QRY	= mysql_fetch_array(mysql_query("SELECT TOTBUYPRICE FROM fna_basta WHERE FLAG = '".$MAX_FLAG."'"));
						$TOTBUYPRICE	 	= $TOTBUYPRICE_QRY['TOTBUYPRICE'];
						$NOW_TOTBUYPRICE	= $TOTBUYPRICE + $AMOUNT ;
						
						$insertQueryBasta = "
												INSERT INTO 
															fna_basta
																	(
																		ENTRYSERIALNOID,
																		PARTYID,
																		BUYQNTY,
																		TOTBUYQNTY,
																		BALANCEQNTY,
																		BUYPRICE,
																		UNITPRICE,
																		TOTBUYPRICE,
																		ENTRYDATE,
																		STATUS,
																		FLAG,
																		ENTDATE,
																		ENTTIME,
																		USERID
																	) 
															VALUES
																	(
																		'".$MaxEntrySlNo."',
																		'".$PARTYID."',
																		'".$BASTAQNTY."',
																		'".$NOW_TOTBUYQNTY."',
																		'".$NOW_BALANCE."',
																		'".$AMOUNT."',
																		'".$BASTAUNITPRICE."',
																		'".$NOW_TOTBUYPRICE."',
																		'".$ENTRYDATE."',
																		'Active',
																		'".$NOW_MAX_FLAG."',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									";
						$insertQueryBastaStatement = mysql_query($insertQueryBasta);
						
						$insertQueryExp = "
												INSERT INTO 
															fna_expanse
																			(
																				ENTRYSERIALNOID,
																				PROJECTID,
																				SUBPROJECTID,
																				EXPHID,
																				EXPSUBHID,
																				PARTYID,
																				AMOUNT,
																				EXPDATE,
																				DESCRIPTION,
																				STATUS,
																				ENTDATE,
																				ENTTIME,
																				USERID
																			) 
																	VALUES
																			(
																				'".$MaxEntrySlNo."',
																				'".$PROJECTID."',
																				'".$SUBPROJECTID."',
																				'".$EXPHID."',
																				'0',
																				'".$PARTYID."',
																				'".$AMOUNT."',
																				'".$ENTRYDATE."',
																				'".$DESCRIPTION."',
																				'Active',
																				'".$entDate."',
																				'".$entTime."',
																				'".$userId."'
																			)
											";
							$insertQueryExpStatement = mysql_query($insertQueryExp);
							
							//Update FNA Balance Table Start
									$BALANCE_FLAG 			= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_balance"));
									$MAXBALANCE_FLAG 		= $BALANCE_FLAG['MAX(FLAG)'];
									$NOW_MAXBALANCE_FLAG 	= $MAXBALANCE_FLAG + 1;
									
									$BALANCE_QUERY		 	= mysql_fetch_array(mysql_query("SELECT * FROM fna_balance WHERE FLAG = '".$MAXBALANCE_FLAG."'"));
									$INCOME_AMOUNT 			= $BALANCE_QUERY['INCOME'];
									$EXPANSE_AMOUNT			= $BALANCE_QUERY['EXPANSE'];
									$BALANCE_AMOUNT 		= $BALANCE_QUERY['BALANCE'];
									
									$NOW_BALANCE_AMOUNT		= $BALANCE_AMOUNT - $AMOUNT ;
									
									$insertBalanceQuery = "
															INSERT INTO 
																		fna_balance
																				(
																					ENTRYSERIALNOID,
																					PROJECTID,
																					SUBPROJECTID,
																					EXPANSE,
																					BALANCE,
																					FLAG,
																					BALDATE,
																					STATUS,
																					ENTDATE,
																					ENTTIME,
																					USERID
																				) 
																		VALUES
																				(
																					'".$MaxEntrySlNo."',
																					'".$PROJECTID."',
																					'".$SUBPROJECTID."',
																					'".$AMOUNT."',
																					'".$NOW_BALANCE_AMOUNT."',
																					'".$NOW_MAXBALANCE_FLAG."',
																					'".$ENTRYDATE."',
																					'Payment',
																					'".$entDate."',
																					'".$entTime."',
																					'".$userId."'
																				)
										";
										$insertBalanceQueryStatement = mysql_query($insertBalanceQuery);
									//Update FNA Balance Table End
									
									//----------------------------------------------------Update Daily Income Expanse Table Start------------------------------------------------
										/*$INEX_FLAG	 			= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_daily_income_expanse"));
										$MAXINEX_FLAG	 		= $INEX_FLAG['MAX(FLAG)'];
										$NOW_MAXINEX_FLAG	 	= $MAXINEX_FLAG + 1;
										*/
										$INEX_FLAG	 			= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_daily_income_expanse"));
										$MAXINEX_FLAG	 		= $INEX_FLAG['MAX(FLAG)'];
										$NOW_MAXINEX_FLAG	 	= $MAXINEX_FLAG + 1;
										
										$EXPHEADNAME_QRY 		= mysql_fetch_array(mysql_query("SELECT EXPHEADNAME FROM fna_expense_head WHERE EXPHID = '".$EXPHID."'"));
										$ESPHEAD_NAME			= $EXPHEADNAME_QRY['EXPHEADNAME'];
										$PARTYNAME_QRY 			= mysql_fetch_array(mysql_query("SELECT PARTYNAME FROM fna_party WHERE PARTYID = '".$PARTYID."'"));
										$PARTYNAME				= $PARTYNAME_QRY['PARTYNAME'];
										$NOW_DESCRIPTION		= 'Basta Purchase for ' .$PARTYNAME . '   (' .$DESCRIPTION. ')' ;
										
										
										$insertDailyInExQuery = "
																INSERT INTO 
																				fna_daily_income_expanse
																											(
																												ENTRYSERIALNOID,
																												PROJECTID,
																												SUBPROJECTID,
																												DATE,
																												EXPHID,
																												EXPANSE,
																												DESCRIPTION,
																												FLAG,
																												STATUS,
																												ENTDATE,
																												ENTTIME,
																												USERID
																											) 
																									VALUES
																											(
																												'".$MaxEntrySlNo."',
																												'".$PROJECTID."',
																												'".$SUBPROJECTID."',
																												'".$ENTRYDATE."',
																												'".$EXPHID."',
																												'".$AMOUNT."',
																												'".$NOW_DESCRIPTION."',
																												'".$NOW_MAXINEX_FLAG."',
																												'Active',
																												'".$entDate."',
																												'".$entTime."',
																												'".$userId."'
																											)
																	";
												
												
												$insertDailyInExQueryStatement = mysql_query($insertDailyInExQuery);
									
									//----------------------------------------------------Update Daily Income Expanse Table End ------------------------------------------------
						
						if($insertQueryBastaStatement){
							$msg = "<span class='validMsg'>Basta Entry [ $BASTAQNTY ] added sucessfully</span>";
						} else {
							$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
						}
					}
					return $msg;
					
			
			
			
		}
		// Insert Basta  Entry End
		
		// Insert Food Item Entry start   
		function insertFoodItemInfo($userId){
			
			$PROJECTID				= addslashes($_REQUEST["PROJECTID"]);
			$SUBPROJECTID			= addslashes($_REQUEST["SUBPROJECTID"]);
			$FOODNAME				= addslashes($_REQUEST["FOODNAME"]);
			$DETAILS				= addslashes($_REQUEST["DETAILS"]);
			
			$entDate 				= date('Y-m-d');
			$entTime 				= date('H:i:s A');
			
			$Query		= "
									SELECT 
											FOODNAME 
									FROM 
											feed_fooditem
									WHERE LOWER(FOODNAME) = '".strtolower($FOODNAME)."'
								  ";
			$QueryStatement	= mysql_query($Query);
			if(mysql_num_rows($QueryStatement)>0) {
				$msg = "<span class='errorMsg'>Sorry, Food name [ $FOODNAME ] already exist!</span>";
			} else {
				
				$EntrySerial_Query_Flag = mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_entryserialno"));
				$MaxFlagEntrySl			= $EntrySerial_Query_Flag['MAX(FLAG)'];
				
				$EntrySerial_Query_No	= mysql_fetch_array(mysql_query("SELECT MAX(ENTRYSERIALNOID) FROM fna_entryserialno"));
				$MaxEntrySlNo			= $EntrySerial_Query_No['MAX(ENTRYSERIALNOID)'] + 1;
		
		
				$insertQueryEntrySl = "
										INSERT INTO 
													fna_entryserialno
																	(
																		ENTRYSERIALNO,
																		PROJECTID,
																		SUBPROJECTID,
																		ENTRYDATE,
																		FLAG,
																		STATUS,
																		ENTDATE,
																		ENTTIME,
																		USERID
																	) 
															VALUES
																	(
																		'".$MaxEntrySlNo."',
																		'".$PROJECTID."',
																		'".$SUBPROJECTID."',
																		'".$PRODUCTIONDATE."',
																		'".$MaxFlagEntrySl."',
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									";
				$insertQueryEntrySlStatement = mysql_query($insertQueryEntrySl);
				
				$insertQuery = "
										INSERT INTO 
													feed_fooditem
																	(
																		ENTRYSERIALNOID,
																		PROJECTID,
																		SUBPROJECTID,
																		FOODNAME,
																		DETAILS,
																		STATUS,
																		ENTDATE,
																		ENTTIME,
																		USERID
																	) 
															VALUES
																	(
																		'".$MaxEntrySlNo."',
																		'".$PROJECTID."',
																		'".$SUBPROJECTID."',
																		'".$FOODNAME."',
																		'".$DETAILS."',
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									"; 
				$insertQueryStatement = mysql_query($insertQuery);
				if($insertQueryStatement){
					$msg = "<span class='validMsg'>Food name [ $FOODNAME ] added sucessfully</span>";
				} else {
					$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
				}
				
				$insertQueryProd = "
										INSERT INTO 
													fna_product
																	(
																		ENTRYSERIALNOID,
																		PROJECTID,
																		SUBPROJECTID,
																		PRODCATTYPEID,
																		PRODUCTNAME,
																		STATUS,
																		ENTDATE,
																		ENTTIME,
																		USERID
																	) 
															VALUES
																	(
																		'".$MaxEntrySlNo."',
																		'".$PROJECTID."',
																		'".$SUBPROJECTID."',
																		'10',
																		'".$FOODNAME."',
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									"; 
				$insertQueryProdStatement = mysql_query($insertQueryProd);
				if($insertQueryProdStatement){
					$msg = "<span class='validMsg'>Product Name [ $FOODNAME ] added sucessfully</span>";
				} else {
					$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
				}
			}
			return $msg;
					
			
			
			
		}
		// Insert Food Item Entry End
		
		// Insert Project Entry start 
		function InsertProjectInfo($userId){
			$PROJECTNAME 		= addslashes($_REQUEST["PROJECTNAME"]);
			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
			$ProjQuery		= "
									SELECT 
											PROJECTID,
											PROJECTNAME
									FROM 
											fna_project
									WHERE PROJECTNAME = '".$PROJECTNAME."' 
								";
			$ProjQueryStatement	= mysql_query($ProjQuery);
			if(mysql_num_rows($ProjQueryStatement)>0) {
				$msg = "<span class='errorMsg'>Sorry, This Project Name  [ $PROJECTNAME ] already exist!</span>";
			} else {
				$insertQueryProj = "
										INSERT INTO 
													fna_project
																	(
																		PROJECTNAME,
																		STATUS,
																		ENTDATE,
																		ENTTIME,
																		USERID
																	) 
															VALUES
																	(
																		'".$PROJECTNAME."',
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									";
				$insertQueryProjStatement = mysql_query($insertQueryProj);
				if($insertQueryProjStatement){
					$msg = "<span class='validMsg'>This Project Name [ $PROJECTNAME ] added sucessfully</span>";
				} else {
					$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
				}
			}
			return $msg;
			
			
			
			
		}
		// Insert Project Entry End
		
		// Insert Bank Entry start 
		function InsertBankInfo($userId){
			$BANKNAME	 		= addslashes($_REQUEST["BANKNAME"]);
			$ADDRESS	 		= addslashes($_REQUEST["ADDRESS"]);
			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
			$BankQuery		= "
									SELECT 
											BANKID,
											BANKNAME
									FROM 
											fna_bank
									WHERE BANKNAME = '".$BANKNAME."' 
								";
			$BankQueryStatement	= mysql_query($BankQuery);
			if(mysql_num_rows($BankQueryStatement)>0) {
				$msg = "<span class='errorMsg'>Sorry, This BANK Name  [ $BANKNAME ] already exist!</span>";
			} else {
				$insertQueryBank = "
										INSERT INTO 
													fna_bank
																	(
																		BANKNAME,
																		ADDRESS,
																		STATUS,
																		ENTDATE,
																		ENTTIME,
																		USERID
																	) 
															VALUES
																	(
																		'".$BANKNAME."',
																		'".$ADDRESS."',
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									";
				$insertQueryBankStatement = mysql_query($insertQueryBank);
				if($insertQueryBankStatement){
					$msg = "<span class='validMsg'>This Bank Name [ $BANKNAME ] added sucessfully</span>";
				} else {
					$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
				}
			}
			return $msg;
			
			
			
			
		}
		// Insert Bank Entry End
		
		// Insert Bank Branch Entry start 
		function InsertBankBranchInfo($userId){
			$BANKID		 		= addslashes($_REQUEST["BANKID"]);
			$BRANCHNAME	 		= addslashes($_REQUEST["BRANCHNAME"]);
			$ADDRESS_Branch		= addslashes($_REQUEST["ADDRESS_Branch"]);
			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
			$BankQuery		= "
									SELECT 
											BANKID,
											BRANCHNAME
									FROM 
											fna_branch
									WHERE BANKID = '".$BANKID."'
									AND BRANCHNAME = '".$BRANCHNAME."' 
								";
			$BankQueryStatement	= mysql_query($BankQuery);
			if(mysql_num_rows($BankQueryStatement)>0) {
				$msg = "<span class='errorMsg'>Sorry, This BANK Name  [ $BRANCHNAME ] already exist!</span>";
			} else {
				$insertQueryBranch = "
										INSERT INTO 
													fna_branch
																	(
																		BANKID,
																		BRANCHNAME,
																		ADDRESS,
																		STATUS,
																		ENTDATE,
																		ENTTIME,
																		USERID
																	) 
															VALUES
																	(
																		'".$BANKID."',
																		'".$BRANCHNAME."',
																		'".$ADDRESS_Branch."',
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									";
				$insertQueryBranchStatement = mysql_query($insertQueryBranch);
				if($insertQueryBranchStatement){
					$msg = "<span class='validMsg'>This Bank Name [ $BRANCHNAME ] added sucessfully</span>";
				} else {
					$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
				}
			}
			return $msg;
			
			
			
			
		}
		// Insert Bank Branch Entry End
		
		// Insert Bank Account No  Entry start 
		function InsertBankAccountInfo($userId){
			$BANKID_ACC	 		= addslashes($_REQUEST["BANKID_ACC"]);
			$BRANCHID_ACC 		= addslashes($_REQUEST["BRANCHID_ACC"]);
			$ACCOUNTNAME		= addslashes($_REQUEST["ACCOUNTNAME"]);
			$ACCOUNTNO			= addslashes($_REQUEST["ACCOUNTNO"]);
			$DESCRIPTION		= addslashes($_REQUEST["DESCRIPTION"]);
			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
			$BankAccQuery		= "
									SELECT 
											BANKID,
											BRANCHID,
											ACCOUNTNO
									FROM 
											fna_bankaccount
									WHERE ACCOUNTNO = '".$ACCOUNTNO."' 
								";
			$BankAccQueryStatement	= mysql_query($BankAccQuery);
			if(mysql_num_rows($BankAccQueryStatement)>0) {
				$msg = "<span class='errorMsg'>Sorry, This BANK Account No:  [ $ACCOUNTNO ] already exist!</span>";
			} else {
				$insertQueryAccnt = "
										INSERT INTO 
													fna_bankaccount
																	(
																		BANKID,
																		BRANCHID,
																		ACCOUNTNAME,
																		ACCOUNTNO,
																		DESCRIPTION,
																		STATUS,
																		ENTDATE,
																		ENTTIME,
																		USERID
																	) 
															VALUES
																	(
																		'".$BANKID_ACC."',
																		'".$BRANCHID_ACC."',
																		'".$ACCOUNTNAME."',
																		'".$ACCOUNTNO."',
																		'".$DESCRIPTION."',
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									";
				$insertQueryAccntStatement = mysql_query($insertQueryAccnt);
				if($insertQueryAccntStatement){
					$msg = "<span class='validMsg'>This Bank Account No: [ $ACCOUNTNO ] added sucessfully</span>";
				} else {
					$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
				}
			}
			return $msg;
			
			
			
			
		}
		// Insert Bank Account No Entry End
		
		// Insert Bank Transction  Entry start 
		function InsertBankTransactionInfo($userId){
			$PROJECTID	 		= addslashes($_REQUEST["PROJECTID"]);
			$SUBPROJECTID 		= addslashes($_REQUEST["SUBPROJECTID"]);
			$BANKID_ACC			= addslashes($_REQUEST["BANKID_ACC"]);
			$BRANCHID_ACC		= addslashes($_REQUEST["BRANCHID_ACC"]);
			$ACCOUNTNO	 		= addslashes($_REQUEST["ACCOUNTNO"]);
			$DESCRIPTION 		= addslashes($_REQUEST["DESCRIPTION"]);
			$transaction 		= addslashes($_REQUEST["transaction"]);
			$amount				= addslashes($_REQUEST["amount"]);
			$ENTRYDATE			= insertDateMySQlFormat($_REQUEST["ENTRYDATE"]);
			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
			
				
				$BankAccID_Query	= mysql_fetch_array(mysql_query("SELECT BANKACCOUNTID FROM fna_bankaccount WHERE ACCOUNTNO = '".$ACCOUNTNO."'"));
				$BankAccID			= $BankAccID_Query['BANKACCOUNTID'];
				
					if($transaction == 'Withdraw'){
						
						$EntrySerial_Query_Flag = mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_entryserialno"));
						$MaxFlagEntrySl			= $EntrySerial_Query_Flag['MAX(FLAG)'];
						
						$EntrySerial_Query_No	= mysql_fetch_array(mysql_query("SELECT MAX(ENTRYSERIALNOID) FROM fna_entryserialno"));
						$MaxEntrySlNo			= $EntrySerial_Query_No['MAX(ENTRYSERIALNOID)'] + 1;
				
				
						$insertQueryEntrySl = "
												INSERT INTO 
															fna_entryserialno
																			(
																				ENTRYSERIALNO,
																				PROJECTID,
																				SUBPROJECTID,
																				ENTRYDATE,
																				FLAG,
																				STATUS,
																				ENTDATE,
																				ENTTIME,
																				USERID
																			) 
																	VALUES
																			(
																				'".$MaxEntrySlNo."',
																				'".$PROJECTID."',
																				'".$SUBPROJECTID."',
																				'".$ENTRYDATE."',
																				'".$MaxFlagEntrySl."',
																				'Active',
																				'".$entDate."',
																				'".$entTime."',
																				'".$userId."'
																			)
											";
						$insertQueryEntrySlStatement = mysql_query($insertQueryEntrySl);
						
						$BankFlagQry		= mysql_fetch_array(mysql_query("SELECT MAX(BANKFLAG) FROM fna_banktransaction"));
						$BANKFLAG			= $BankFlagQry['MAX(BANKFLAG)'];
						$MaxBANKFLAG		= $BankFlagQry['MAX(BANKFLAG)'] + 1;
						
						$AccountFlagQry		= mysql_fetch_array(mysql_query("SELECT MAX(ACCFLAG) FROM fna_banktransaction WHERE ACCOUNTNO = '".$ACCOUNTNO."' AND BANKACCOUNTID = '".$BankAccID."'"));
						$ACCOUNTFLAG		= $AccountFlagQry['MAX(ACCFLAG)'];
						$MaxACCOUNTFLAG		= $AccountFlagQry['MAX(ACCFLAG)'] + 1;
						
						$ACC_BALANCE_QRY	= mysql_fetch_array(mysql_query("SELECT ACCOUNTBALANCE FROM fna_banktransaction WHERE ACCOUNTNO = '".$ACCOUNTNO."' AND BANKACCOUNTID = '".$BankAccID."' AND ACCFLAG = '".$ACCOUNTFLAG."'"));
						$ACCOUNT_BALANCE	= $ACC_BALANCE_QRY['ACCOUNTBALANCE'];
						$NOW_ACCOUNT_BALANCE= $ACCOUNT_BALANCE - $amount ; 
						
						$BANK_BALANCE_QRY	= mysql_fetch_array(mysql_query("SELECT BALANCE FROM fna_banktransaction WHERE BANKID = '".$BANKID_ACC."' AND BANKFLAG = '".$BANKFLAG."'"));
						$BANK_BALANCE		= $BANK_BALANCE_QRY['BALANCE'];
						$NOW_BANK_BALANCE	= $BANK_BALANCE - $amount ; 
						
						if($ACCOUNT_BALANCE >= $amount ){
							
							$insertQueryBankTran = "
													INSERT INTO 
																fna_banktransaction
																				(
																					ENTRYSERIALNOID,
																					PROJECTID,
																					SUBPROJECTID,
																					BANKID,
																					BRANCHID,
																					BANKACCOUNTID,
																					ACCOUNTNO,
																					DEPOSIT,
																					WITHDRAW,
																					DESCRIPTION,
																					BALANCE,
																					ACCOUNTBALANCE,
																					BTDATE,
																					ACCFLAG,
																					BANKFLAG,
																					STATUS,
																					ENTDATE,
																					ENTTIME,
																					USERID
																				) 
																		VALUES
																				(
																					'".$MaxEntrySlNo."',
																					'".$PROJECTID."',
																					'".$SUBPROJECTID."',
																					'".$BANKID_ACC."',
																					'".$BRANCHID_ACC."',
																					'".$BankAccID."',
																					'".$ACCOUNTNO."',
																					'0',
																					'".$amount."',
																					'".$DESCRIPTION."',
																					'".$NOW_BANK_BALANCE."',
																					'".$NOW_ACCOUNT_BALANCE."',
																					'".$ENTRYDATE."',
																					'".$MaxACCOUNTFLAG."',
																					'".$MaxBANKFLAG."',
																					'Active',
																					'".$entDate."',
																					'".$entTime."',
																					'".$userId."'
																				)
														";
							$insertQueryBankTranStatement = mysql_query($insertQueryBankTran);
							if($insertQueryBankTranStatement){
								
								//Update FNA Balance Table Start
								$BALANCE_FLAG 			= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_balance"));
								$MAXBALANCE_FLAG 		= $BALANCE_FLAG['MAX(FLAG)'];
								$NOW_MAXBALANCE_FLAG 	= $MAXBALANCE_FLAG + 1;
								
								$BALANCE_QUERY		 	= mysql_fetch_array(mysql_query("SELECT * FROM fna_balance WHERE FLAG = '".$MAXBALANCE_FLAG."'"));
								$INCOME_AMOUNT 			= $BALANCE_QUERY['INCOME'];
								$EXPANSE_AMOUNT			= $BALANCE_QUERY['EXPANSE'];
								$BALANCE_AMOUNT 		= $BALANCE_QUERY['BALANCE'];
								
								$NOW_BALANCE_AMOUNT		= $BALANCE_AMOUNT + $amount ;
								
								$insertBalanceQuery = "
														INSERT INTO 
																	fna_balance
																			(
																				ENTRYSERIALNOID,
																				PROJECTID,
																				SUBPROJECTID,
																				INCOME,
																				EXPANSE,
																				BALANCE,
																				FLAG,
																				BALDATE,
																				STATUS,
																				ENTDATE,
																				ENTTIME,
																				USERID
																			) 
																	VALUES
																			(
																				'".$MaxEntrySlNo."',
																				'".$PROJECTID."',
																				'".$SUBPROJECTID."',
																				'".$amount."',
																				'0',
																				'".$NOW_BALANCE_AMOUNT."',
																				'".$NOW_MAXBALANCE_FLAG."',
																				'".$ENTRYDATE."',
																				'Active',
																				'".$entDate."',
																				'".$entTime."',
																				'".$userId."'
																			)
									";
									
									
									$insertBalanceQueryStatement = mysql_query($insertBalanceQuery);
								//Update FNA Balance Table End
								
								
							//----------------------------------------------------Update Daily Income Expanse Table Start------------------------------------------------
								$INEX_FLAG	 			= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_daily_income_expanse"));
								$MAXINEX_FLAG	 		= $INEX_FLAG['MAX(FLAG)'];
								$NOW_MAXINEX_FLAG	 	= $MAXINEX_FLAG + 1;
								
								//$PARTYNAME_QRY 			= mysql_fetch_array(mysql_query("SELECT PARTYNAME FROM fna_party WHERE PARTYID = '".$PARTYID."'"));
								//$PARTYNAME				= $PARTYNAME_QRY['PARTYNAME'];
								$NOW_DESCRIPTION		= 'Withdraw from   '.$ACCOUNTNO . ' , '.$DESCRIPTION.' ';
								
								
								$insertDailyInExQuery = "
														INSERT INTO 
																		fna_daily_income_expanse
																									(
																										ENTRYSERIALNOID,
																										PROJECTID,
																										SUBPROJECTID,
																										DATE,
																										INHID,
																										INCOME,
																										DESCRIPTION,
																										FLAG,
																										STATUS,
																										ENTDATE,
																										ENTTIME,
																										USERID
																									) 
																							VALUES
																									(
																										'".$MaxEntrySlNo."',
																										'".$PROJECTID."',
																										'".$SUBPROJECTID."',
																										'".$ENTRYDATE."',
																										'17',
																										'".$amount."',
																										'".$NOW_DESCRIPTION."',
																										'".$NOW_MAXINEX_FLAG."',
																										'Active',
																										'".$entDate."',
																										'".$entTime."',
																										'".$userId."'
																									)
															";
										
										
										$insertDailyInExQueryStatement = mysql_query($insertDailyInExQuery);
							
							//----------------------------------------------------Update Daily Income Expanse Table End ------------------------------------------------
								$msg = "<span class='validMsg'>This Bank Account No: [ $ACCOUNTNO ] added sucessfully</span>";
							} else {
								$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
							}
						}else{
							$msg = "<span class='errorMsg'>Sorry! Insufficient Balance...!</span>";
						}
						
					}else{
						
						$EntrySerial_Query_Flag = mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_entryserialno"));
						$MaxFlagEntrySl			= $EntrySerial_Query_Flag['MAX(FLAG)'];
						
						$EntrySerial_Query_No	= mysql_fetch_array(mysql_query("SELECT MAX(ENTRYSERIALNOID) FROM fna_entryserialno"));
						$MaxEntrySlNo			= $EntrySerial_Query_No['MAX(ENTRYSERIALNOID)'] + 1;
				
				
						$insertQueryEntrySl = "
												INSERT INTO 
															fna_entryserialno
																			(
																				ENTRYSERIALNO,
																				PROJECTID,
																				SUBPROJECTID,
																				ENTRYDATE,
																				FLAG,
																				STATUS,
																				ENTDATE,
																				ENTTIME,
																				USERID
																			) 
																	VALUES
																			(
																				'".$MaxEntrySlNo."',
																				'".$PROJECTID."',
																				'".$SUBPROJECTID."',
																				'".$ENTRYDATE."',
																				'".$MaxFlagEntrySl."',
																				'Active',
																				'".$entDate."',
																				'".$entTime."',
																				'".$userId."'
																			)
											";
						$insertQueryEntrySlStatement = mysql_query($insertQueryEntrySl);
						
						
						$BankFlagQry		= mysql_fetch_array(mysql_query("SELECT MAX(BANKFLAG) FROM fna_banktransaction"));
						$BANKFLAG			= $BankFlagQry['MAX(BANKFLAG)'];
						$MaxBANKFLAG		= $BankFlagQry['MAX(BANKFLAG)'] + 1;
						
						$AccountFlagQry		= mysql_fetch_array(mysql_query("SELECT MAX(ACCFLAG) FROM fna_banktransaction WHERE ACCOUNTNO = '".$ACCOUNTNO."' AND BANKACCOUNTID = '".$BankAccID."'"));
						$ACCOUNTFLAG		= $AccountFlagQry['MAX(ACCFLAG)'];
						$MaxACCOUNTFLAG		= $AccountFlagQry['MAX(ACCFLAG)'] + 1;
						
						$ACC_BALANCE_QRY	= mysql_fetch_array(mysql_query("SELECT ACCOUNTBALANCE FROM fna_banktransaction WHERE ACCOUNTNO = '".$ACCOUNTNO."' AND BANKACCOUNTID = '".$BankAccID."' AND ACCFLAG = '".$ACCOUNTFLAG."'"));
						$ACCOUNT_BALANCE	= $ACC_BALANCE_QRY['ACCOUNTBALANCE'];
						$NOW_ACCOUNT_BALANCE= $ACCOUNT_BALANCE + $amount ; 
						
						$BANK_BALANCE_QRY	= mysql_fetch_array(mysql_query("SELECT BALANCE FROM fna_banktransaction WHERE BANKID = '".$BANKID_ACC."' AND BANKFLAG = '".$BANKFLAG."'"));
						$BANK_BALANCE		= $BANK_BALANCE_QRY['BALANCE'];
						$NOW_BANK_BALANCE	= $BANK_BALANCE + $amount ; 
						
						$insertQueryBankTran = "
												INSERT INTO 
															fna_banktransaction
																			(
																				ENTRYSERIALNOID,
																				PROJECTID,
																				SUBPROJECTID,
																				BANKID,
																				BRANCHID,
																				BANKACCOUNTID,
																				ACCOUNTNO,
																				DEPOSIT,
																				WITHDRAW,
																				DESCRIPTION,
																				BALANCE,
																				ACCOUNTBALANCE,
																				BTDATE,
																				ACCFLAG,
																				BANKFLAG,
																				STATUS,
																				ENTDATE,
																				ENTTIME,
																				USERID
																			) 
																	VALUES
																			(
																				'".$MaxEntrySlNo."',
																				'".$PROJECTID."',
																				'".$SUBPROJECTID."',
																				'".$BANKID_ACC."',
																				'".$BRANCHID_ACC."',
																				'".$BankAccID."',
																				'".$ACCOUNTNO."',
																				'".$amount."',
																				'0',
																				'".$DESCRIPTION."',
																				'".$NOW_BANK_BALANCE."',
																				'".$NOW_ACCOUNT_BALANCE."',
																				'".$ENTRYDATE."',
																				'".$MaxACCOUNTFLAG."',
																				'".$MaxBANKFLAG."',
																				'Active',
																				'".$entDate."',
																				'".$entTime."',
																				'".$userId."'
																			)
													";
						$insertQueryBankTranStatement = mysql_query($insertQueryBankTran);
						if($insertQueryBankTranStatement){
							
							//Update FNA Balance Table Start
							$BALANCE_FLAG 			= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_balance"));
							$MAXBALANCE_FLAG 		= $BALANCE_FLAG['MAX(FLAG)'];
							$NOW_MAXBALANCE_FLAG 	= $MAXBALANCE_FLAG + 1;
							
							$BALANCE_QUERY		 	= mysql_fetch_array(mysql_query("SELECT * FROM fna_balance WHERE FLAG = '".$MAXBALANCE_FLAG."'"));
							$INCOME_AMOUNT 			= $BALANCE_QUERY['INCOME'];
							$EXPANSE_AMOUNT			= $BALANCE_QUERY['EXPANSE'];
							$BALANCE_AMOUNT 		= $BALANCE_QUERY['BALANCE'];
							
							$NOW_BALANCE_AMOUNT		= $BALANCE_AMOUNT - $amount ;
							
							$insertBalanceQuery = "
													INSERT INTO 
																fna_balance
																		(
																			ENTRYSERIALNOID,
																			PROJECTID,
																			SUBPROJECTID,
																			INCOME,
																			EXPANSE,
																			BALANCE,
																			FLAG,
																			BALDATE,
																			STATUS,
																			ENTDATE,
																			ENTTIME,
																			USERID
																		) 
																VALUES
																		(
																			'".$MaxEntrySlNo."',
																			'".$PROJECTID."',
																			'".$SUBPROJECTID."',
																			'0',
																			'".$amount."',
																			'".$NOW_BALANCE_AMOUNT."',
																			'".$NOW_MAXBALANCE_FLAG."',
																			'".$ENTRYDATE."',
																			'Active',
																			'".$entDate."',
																			'".$entTime."',
																			'".$userId."'
																		)
								";
								
								
								$insertBalanceQueryStatement = mysql_query($insertBalanceQuery);
							//Update FNA Balance Table End
							
							
							//----------------------------------------------------Update Daily Income Expanse Table Start------------------------------------------------
								$INEX_FLAG	 			= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_daily_income_expanse"));
								$MAXINEX_FLAG	 		= $INEX_FLAG['MAX(FLAG)'];
								$NOW_MAXINEX_FLAG	 	= $MAXINEX_FLAG + 1;
								
								//$PARTYNAME_QRY 			= mysql_fetch_array(mysql_query("SELECT PARTYNAME FROM fna_party WHERE PARTYID = '".$PARTYID."'"));
								//$PARTYNAME				= $PARTYNAME_QRY['PARTYNAME'];
								$NOW_DESCRIPTION		= 'Deposit to   '.$ACCOUNTNO . ' , '.$DESCRIPTION.' ';
								
								
								$insertDailyInExQuery = "
														INSERT INTO 
																		fna_daily_income_expanse
																									(
																										ENTRYSERIALNOID,
																										PROJECTID,
																										SUBPROJECTID,
																										DATE,
																										EXPHID,
																										EXPANSE,
																										DESCRIPTION,
																										FLAG,
																										STATUS,
																										ENTDATE,
																										ENTTIME,
																										USERID
																									) 
																							VALUES
																									(
																										'".$MaxEntrySlNo."',
																										'".$PROJECTID."',
																										'".$SUBPROJECTID."',
																										'".$ENTRYDATE."',
																										'154',
																										'".$amount."',
																										'".$NOW_DESCRIPTION."',
																										'".$NOW_MAXINEX_FLAG."',
																										'Active',
																										'".$entDate."',
																										'".$entTime."',
																										'".$userId."'
																									)
															";
										
										
										$insertDailyInExQueryStatement = mysql_query($insertDailyInExQuery);
							
							//----------------------------------------------------Update Daily Income Expanse Table End ------------------------------------------------
							$msg = "<span class='validMsg'>This Bank Account No: [ $ACCOUNTNO ] added sucessfully</span>";
						} else {
							$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
						}
					
					}
				
			
			return $msg;
			
			
			
			
		}
		// Insert Bank  Transction Entry End
		
		// Insert Sub Project start 
		function InsertSubProjInfo($userId){
			$PROJECTID_sub		= addslashes($_REQUEST["PROJECTID_sub"]);
			$SUBPROJECTNAME		= addslashes($_REQUEST["SUBPROJECTNAME"]);
			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
			$SubProjQuery		= "
									SELECT 
											SUBPROJECTID,
											PROJECTID,
											SUBPROJECTNAME 
									FROM 
											fna_subproject
									WHERE PROJECTID = '".$PROJECTID_sub."' 
									AND LOWER(SUBPROJECTNAME) = '".strtolower($SUBPROJECTNAME)."'
								  ";
			$SubProjQueryStatement	= mysql_query($SubProjQuery);
			if(mysql_num_rows($SubProjQueryStatement)>0) {
				$msg = "<span class='errorMsg'>Sorry, Sub Project name [ $SUBPROJECTNAME ] already exist!</span>";
			} else {
				$insertQuerySubProj = "
										INSERT INTO 
													fna_subproject
																	(
																		PROJECTID,
																		SUBPROJECTNAME,
																		STATUS,
																		ENTDATE,
																		ENTTIME,
																		USERID
																	) 
															VALUES
																	(
																		'".$PROJECTID_sub."',
																		'".$SUBPROJECTNAME."',
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									"; 
				$insertQuerySubProjStatement = mysql_query($insertQuerySubProj);
				if($insertQuerySubProjStatement){
					$msg = "<span class='validMsg'>Sub Project Name [ $SUBPROJECTNAME ] added sucessfully</span>";
				} else {
					$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
				}
			}
			return $msg;
			
			
			
			
		}
		// Insert Sub Project End
		
		// Insert Product Fare start
		function InsertProdFareInfo($userId){
			
			$PROJECTID_ProdFare		= addslashes($_REQUEST["PROJECTID_prodFare"]);
			$SUBPROJECTID_ProdFare	= addslashes($_REQUEST["SUBPROJECTID_prodFare"]);
			$productCatTypeid_Fare	= addslashes($_REQUEST["prodCatTypeid_prodFare"]);
			$PRODUCTID_Fare			= addslashes($_REQUEST["PRODUCTID_ProdFare"]);
			$productFare			= addslashes($_REQUEST["productFare"]);
			$startFDate				= insertDateMySQlFormat($_REQUEST["startPFDate"]);
			$endFDate				= insertDateMySQlFormat($_REQUEST["endPFDate"]);
			$entDate 				= date('Y-m-d');
			$entTime 				= date('H:i:s A');
			
			$ProdQuery		= "
									SELECT 
											PRODUCTID
									FROM 
											fna_productfare
									WHERE PRODUCTID = '".strtolower($PRODUCTID_Fare)."'
								  ";
			$ProdQueryStatement	= mysql_query($ProdQuery);
			if(mysql_num_rows($ProdQueryStatement)>0) {
				$msg = "<span class='errorMsg'>Sorry, Product name [ $PRODUCTID_Fare ] already exist!</span>";
			} else {
				$insertQueryProdFare = "
										INSERT INTO 
													fna_productfare
																	(
																		PROJECTID,
																		SUBPROJECTID,
																		PRODCATTYPEID,
																		PRODUCTID,
																		UNITFARE,
																		STARTDATE,
																		ENDDATE,
																		STATUS,
																		ENTDATE,
																		ENTTIME,
																		USERID
																	) 
															VALUES
																	(
																		'".$PROJECTID_ProdFare."',
																		'".$SUBPROJECTID_ProdFare."',
																		'".$productCatTypeid_Fare."',
																		'".$PRODUCTID_Fare."',
																		'".$productFare."',
																		'".$startFDate."',
																		'".$endFDate."',
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									"; 
				$insertQueryProdFareStatement = mysql_query($insertQueryProdFare);
				if($insertQueryProdFareStatement){
					$msg = "<span class='validMsg'>Product Name [ $PRODUCTID_Fare ] added sucessfully</span>";
				} else {
					$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
				}
			}
			return $msg;
			
			
			
			
		}
		// Insert Product Fare End
		
		// Insert Alu Fare start
		function InsertAluFareInfo($userId){
			
			$PROJECTID_AluFare				= addslashes($_REQUEST["PROJECTID_aluFare"]);
			$SUBPROJECTID_AluFare			= addslashes($_REQUEST["SUBPROJECTID_aluFare"]);
			//$PARTYID_ALU					= addslashes($_REQUEST["PARTYID_ALU"]);
			$productCatTypeid_Alu			= addslashes($_REQUEST["prodCatTypeidAlu"]);
			$PRODUCTID_Alu					= addslashes($_REQUEST["PRODUCTIDAlu"]);
			$packingUnit_Alu				= addslashes($_REQUEST["packingUnitAlu"]);
			$productFare_Alu				= addslashes($_REQUEST["productFareAlu"]);
			$startFDate						= insertDateMySQlFormat($_REQUEST["startAFDate"]);
			$endFDate						= insertDateMySQlFormat($_REQUEST["endAFDate"]);
			$entDate 						= date('Y-m-d');
			$entTime 						= date('H:i:s A');
			
			$ProdQuery		= "
									SELECT 
											PRODUCTID
									FROM 
											fna_productfare
									WHERE PRODUCTID = '".strtolower($PRODUCTID_Alu)."'
									AND PACKINGUNITID = '".$packingUnit_Alu."'
									";
			$ProdQueryStatement	= mysql_query($ProdQuery);
			if(mysql_num_rows($ProdQueryStatement)>0) {
				$msg = "<span class='errorMsg'>Sorry, This Product and this packing unit fare [ $PRODUCTID_Alu ] already exist!</span>";
			} else {
				$insertQueryProdFare = "
										INSERT INTO 
													fna_productfare
																	(
																		PROJECTID,
																		SUBPROJECTID,
																		PRODCATTYPEID,
																		PRODUCTID,
																		PACKINGUNITID,
																		UNITFARE,
																		STARTDATE,
																		ENDDATE,
																		STATUS,
																		ENTDATE,
																		ENTTIME,
																		USERID
																	) 
															VALUES
																	(
																		'".$PROJECTID_AluFare."',
																		'".$SUBPROJECTID_AluFare."',
																		'".$productCatTypeid_Alu."',
																		'".$PRODUCTID_Alu."',
																		'".$packingUnit_Alu."',
																		'".$productFare_Alu."',
																		'".$startFDate."',
																		'".$endFDate."',
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									"; 
				$insertQueryProdFareStatement = mysql_query($insertQueryProdFare);
				if($insertQueryProdFareStatement){
					$msg = "<span class='validMsg'>Product Name [ $PRODUCTID_Alu ] added sucessfully</span>";
				} else {
					$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
				}
			}
			return $msg;
			
			
			
			
		}
		// Insert Alu Fare End
		
		// Insert Session start
		function InsertSessionInfo($userId){
			
			$worktype			= addslashes($_REQUEST["WORKTYPE"]);
			$SESSIONYEARID		= addslashes($_REQUEST["SESSIONYEARID"]);
			$PROJECTID_SESSION	= addslashes($_REQUEST["PROJECTID_SESSION"]);
			$SUBPROJECTID_SESSION	= addslashes($_REQUEST["SUBPROJECTID_SESSION"]);
			$productCatTypeid	= addslashes($_REQUEST["productCatTypeidSession"]);
			$startDate			= insertDateMySQlFormat($_REQUEST["startDate"]);
			$endDate			= insertDateMySQlFormat($_REQUEST["endDate"]);
			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
			$ProdQuery		= "
									SELECT 
											PRODCATTYPEID 
									FROM 
											fna_session
									WHERE PROJECTID = '".$PROJECTID_SESSION."'
									AND SUBPROJECTID = '".$SUBPROJECTID_SESSION."'
									AND SESSIONYEARID = '".$SESSIONYEARID."'
									AND YEARCOMPLETE = 'No'
									AND LOWER(PRODCATTYPEID) = '".strtolower($productCatTypeid)."'
								  ";
			$ProdQueryStatement	= mysql_query($ProdQuery);
			if(mysql_num_rows($ProdQueryStatement)<=0) {
				
				$TypeFlagQry		= mysql_fetch_array(mysql_query("SELECT MAX(PRODCATTYPEFLAG) FROM fna_session WHERE PROJECTID = '".$PROJECTID_SESSION."' AND SUBPROJECTID = '".$SUBPROJECTID_SESSION."' AND PRODCATTYPEID = '".$productCatTypeid."'"));
				$MaxTypeFlag		= $TypeFlagQry['MAX(PRODCATTYPEFLAG)'];
				$NowMaxTypeFlag		= $MaxTypeFlag + 1;
				
				$SessionYearQry		= mysql_fetch_array(mysql_query("SELECT SESSIONYEAR FROM fna_sessionyear WHERE SESSIONYEARID = '".$SESSIONYEARID."' "));
				$SESSIONYEAR		= $SessionYearQry['SESSIONYEAR'];
				
				$insertQuerySession = "
										INSERT INTO 
													fna_session
																	(
																		PROJECTID,
																		SUBPROJECTID,
																		PRODCATTYPEID,
																		WORKTYPE,
																		STARTDATE,
																		ENDDATE,
																		SESSIONYEARID,
																		SESSIONYEAR,
																		YEARCOMPLETE,
																		PRODCATTYPEFLAG,
																		STATUS,
																		ENTDATE,
																		ENTTIME,
																		USERID
																	) 
															VALUES
																	(
																		'".$PROJECTID_SESSION."',
																		'".$SUBPROJECTID_SESSION."',
																		'".$productCatTypeid."',
																		'".$worktype."',
																		'".$startDate."',
																		'".$endDate."',
																		'".$SESSIONYEARID."',
																		'".$SESSIONYEAR."',
																		'No',
																		'".$NowMaxTypeFlag."',
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									"; 
				$insertQuerySessionStatement = mysql_query($insertQuerySession);
				if($insertQuerySessionStatement){
					$msg = "<span class='validMsg'>Session [ $productCatTypeid ] added sucessfully</span>";
				} else {
					$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
				}
				
			} else {		
				$msg = "<span class='errorMsg'>Sorry! This Product Category Session Alraedy Inserted.......!</span>";
			}//if(mysql_num_rows($ProdQueryStatement)<=0)
			return $msg;
			
			
			
			
		}
		// Insert Session End
		
		// Insert Packing Name start
		function insertPackingUnitInfo($userId){
			
			$PackingName		= addslashes($_REQUEST["PackingName"]);
			$quantity 			= addslashes($_REQUEST["quantity"]);
			$weight 			= addslashes($_REQUEST["weight"]);
			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
			$Query		= "
									SELECT 
											PACKINGNAMEID, QID, WTID 
									FROM 
											fna_packingunit
									WHERE LOWER(PACKINGNAMEID) = '".strtolower($PackingName)."' and LOWER(QID) = '".strtolower($quantity)."' and LOWER(WTID) = '".strtolower($weight)."'
								  ";
			$QueryStatement	= mysql_query($Query);
			if(mysql_num_rows($QueryStatement)>0) {
				$msg = "<span class='errorMsg'>Sorry, Packing  Unit [ $PackingName ] already exist!</span>";
			} else {
				$insertQuery = "
										INSERT INTO 
													fna_packingunit
																	(
																		PACKINGNAMEID,
																		QID,
																		WTID,
																		STATUS,
																		ENTDATE,
																		ENTTIME,
																		USERID
																	) 
															VALUES
																	(
																		'".$PackingName."',
																		'".$quantity."',
																		'".$weight."',
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)";
				$insertQueryStatement = mysql_query($insertQuery);
				if($insertQueryStatement){
					$msg = "<span class='validMsg'>Packing Unit [ $PackingName ] added sucessfully</span>";
				} else {
					$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
				}
			}
			return $msg;
			
			
			
			
		}
		// Insert Packing Name End
		
		// Insert Quantity start
		function insertQuantityInfo($userId){
			
			$quantity 			= addslashes($_REQUEST["quantity"]);
			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
			$Query		= "
									SELECT 
											QVALUE 
									FROM 
											fna_quantity
									WHERE LOWER(QVALUE) = '".strtolower($quantity)."'
								  ";
			$QueryStatement	= mysql_query($Query);
			if(mysql_num_rows($QueryStatement)>0) {
				$msg = "<span class='errorMsg'>Sorry, Quantity [ $quantity ] already exist!</span>";
			} else {
				$insertQuery = "
										INSERT INTO 
													fna_quantity
																	(
																		QVALUE,
																		STATUS,
																		ENTDATE,
																		ENTTIME,
																		USERID
																	) 
															VALUES
																	(
																		'".$quantity."',
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									"; 
				$insertQueryStatement = mysql_query($insertQuery);
				if($insertQueryStatement){
					$msg = "<span class='validMsg'>Quantity [ $quantity ] added sucessfully</span>";
				} else {
					$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
				}
			}
			return $msg;
			
			
			
			
		}
		// Insert Quantity End
		
		// Insert Weight start
		function insertWeightInfo($userId){
			
			$weight 			= addslashes($_REQUEST["weight"]);
			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
			$Query		= "
									SELECT 
											WNAME 
									FROM 
											fna_weight
									WHERE LOWER(WNAME) = '".strtolower($weight)."'
								  ";
			$QueryStatement	= mysql_query($Query);
			if(mysql_num_rows($QueryStatement)>0) {
				$msg = "<span class='errorMsg'>Sorry, Weight [ $weight ] already exist!</span>";
			} else {
				$insertQuery = "
										INSERT INTO 
													fna_weight
																	(
																		WNAME,
																		STATUS,
																		ENTDATE,
																		ENTTIME,
																		USERID
																	) 
															VALUES
																	(
																		'".$weight."',
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									"; 
				$insertQueryStatement = mysql_query($insertQuery);
				if($insertQueryStatement){
					$msg = "<span class='validMsg'>Weight [ $weight ] added sucessfully</span>";
				} else {
					$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
				}
			}
			return $msg;
			
			
			
			
		}
		// Insert Weight End
		
		// Insert Labour Contract Information Start
		function insertLabourContractInfo($userId){
			
			$PROJECTID_labCon		= 0;
			$SUBPROJECTID_labCon	= 0;
			$LABOURID	= 0;
			$startLDate	= '';
			$endLDate	= '';
			$description	= '';
			$ChmbrFrom	= 0;
			$ChmbrTo	= 0;
			$packingUnitId	= 0;
			$loadPrice	= 0;
			$unloadPrice	= 0;
			$transferPrice	= 0;
			$palotPrice	= 0;
			$shadePrice	= 0;
			
			
			$PROJECTID_labCon	= addslashes($_REQUEST["PROJECTID_labCon"]);
			$SUBPROJECTID_labCon= addslashes($_REQUEST["SUBPROJECTID_labCon"]);
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
										lc.LABCONTACTID
								FROM 
										fna_labourcontact lc
								WHERE lc.LABOURID = '".$LABOURID."' 
								  AND lc.PROJECTID = '".$PROJECTID_labCon."'
								  AND lc.SUBPROJECTID = '".$SUBPROJECTID_labCon."'
								  AND '".$startLDate."' BETWEEN  lc.STARTDATE AND lc.ENDDATE
							"; 
			$QueryStatement	= mysql_query($Query);
			if(mysql_num_rows($QueryStatement)>0) {
				
					$QueryStatementResult	= mysql_fetch_array($QueryStatement);
					$labourContactId = $QueryStatementResult['LABCONTACTID'];
				
					$k = 0;
					for($i = 1; $i < $TOTAL_PRODUCT_LIST; $i++ ){
						
						$QueryBkdnChck		= "
													SELECT 
															lc_bkdn.LABCONTACTBKDNID
													FROM 
															fna_labourcontact lc, fna_labourcontact_bkdn lc_bkdn
													WHERE lc.LABCONTACTID = lc_bkdn.LABCONTACTID
													  AND lc.LABOURID = '".$LABOURID."' 
													  AND lc.PROJECTID = '".$PROJECTID_labCon."'
													  AND lc.SUBPROJECTID = '".$SUBPROJECTID_labCon."'
													  AND '".$startLDate."' BETWEEN  lc.STARTDATE AND lc.ENDDATE
													  AND lc_bkdn.LABCONTACTID = '".$labourContactId."'
													  AND lc_bkdn.CHAMBERIDFROM = '".$ChmbrFrom[$k]."'
													  AND lc_bkdn.CHAMBERIDTO = '".$ChmbrTo[$k]."'
													  AND lc_bkdn.PACKINGUNITID = '".$packingUnitId[$k]."'
												";
						$QueryBkdnChckStatement	= mysql_query($QueryBkdnChck);
							if(mysql_num_rows($QueryBkdnChckStatement)>0) {
								$QueryBkdnChckStatementResult	= mysql_fetch_array($QueryBkdnChckStatement);
								$LABCONTACTBKDNID = $QueryBkdnChckStatementResult['LABCONTACTBKDNID'];
								
								$updatebkdnQuery = "UPDATE  fna_labourcontact_bkdn SET LOADPRICE = '".$loadPrice[$k]."', 
																						UNLOADPRICE = '".$unloadPrice[$k]."',
																						TRANSFERPRICE = '".$transferPrice[$k]."', 
																						SHADEPRICE = '".$palotPrice[$k]."', 
																						PALOTPRICE = '".$shadePrice[$k]."'
													WHERE LABCONTACTBKDNID = '".$LABCONTACTBKDNID."'"; 
									mysql_query($updatebkdnQuery);
								
							}else{
								
								$insertbkdnQuery = "INSERT INTO 
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
																							'".$labourContactId."',
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
										$msg = "<span class='validMsg'>Labour Information [ $ChmbrTo[$k] ] added sucessfully</span>";
									}else{
										$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
										break;
									}
								
							}						
							
					$k++;
					}
				
				
				
			} else {
				
				$LABOUR_FLAG		= mysql_fetch_array(mysql_query("SELECT MAX(LABOURFLAG) FROM fna_labourcontact WHERE PROJECTID = '".$PROJECTID_labCon."' AND SUBPROJECTID = '".$SUBPROJECTID_labCon."' AND LABOURID = '".$LABOURID."'"));
									$MAXLABOUR_FLAG 		= $LABOUR_FLAG['MAX(FLAG)'];
									$NOW_MAXLABOUR_FLAG 	= $MAXLABOUR_FLAG + 1;
				
				$insertQuery = "
										INSERT INTO 
													fna_labourcontact
																	(
																		PROJECTID,
																		SUBPROJECTID,
																		LABOURID,
																		STARTDATE,
																		ENDDATE,
																		DESCRIPTION,
																		LABOURFLAG,
																		STATUS,
																		ENTDATE,
																		ENTTIME,
																		USERID
																	) 
															VALUES
																	(
																		'".$PROJECTID_labCon."',
																		'".$SUBPROJECTID_labCon."',
																		'".$LABOURID."',
																		'".$startLDate."',
																		'".$endLDate."',
																		'".$description."',
																		'".$NOW_MAXLABOUR_FLAG."',
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
						
						$QueryBkdn	= "
										SELECT 
												count(*)
												
										FROM 
												fna_labourcontact_bkdn bkdn
										WHERE bkdn.CHAMBERIDTO = '".$ChmbrTo[$k]."' 
										  AND bkdn.PACKINGUNITID = '".$packingUnitId[$k]."'
										  AND bkdn.LABCONTACTID = '".$labourCtId."'
										  AND bkdn.LOADPRICE = '".$loadPrice[$k]."'
										  AND bkdn.UNLOADPRICE = '".$unloadPrice[$k]."'
										  AND bkdn.PALOTPRICE = '".$palotPrice[$k]."'
										  AND bkdn.SHADEPRICE = '".$shadePrice[$k]."'
										  
									";
						$QueryBkdnStatement	= mysql_query($QueryBkdn);
						
						$insertbkdnQuery = "INSERT INTO 
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
										$msg = "<span class='validMsg'>Labour Information [ $ChmbrTo[$k] ] added sucessfully</span>";
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
			
			$PROJECTID 			= $_REQUEST["PROJECTID"];
			$SUBPROJECTID		= $_REQUEST["SUBPROJECTID"];
			
			
			$LABOURID 			= $_REQUEST["LABOURID"];
			$PARTYID 			= $_REQUEST["PARTYID"];
			$ENTRYDATE	 		= insertDateMySQlFormat($_REQUEST["ENTRYDATE"]);
			
			
			$PRODCATTYPEID		= $_REQUEST["PRODCATTYPEID"];
			$PRODUCTID 			= $_REQUEST["PRODUCTID"];
			$quantity	 		= $_REQUEST["quantity"];
			$LoadBasta	 		= $_REQUEST["quantity"];
			$CHALLANNO 			= $_REQUEST["CHALLANNO"];
			$wtquantity	 		= $_REQUEST["wtquantity"];
			$LoadKg		 		= $_REQUEST["wtquantity"];
			$packingUnit		= $_REQUEST["packingUnit"];
			$CHID		 		= $_REQUEST["CHID"];
			//$pocket		 		= $_REQUEST["pocket"];
			$EXTRALABBILL 		= $_REQUEST["EXTRALABBILL"];
			
			$TOTAL_PRODUCT_LIST	= $_REQUEST["TOTAL_PRODUCT_LIST"];
			
			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
			$WorkType			= 'Load';
			
			$MaxTypeFlag_Query	= mysql_fetch_array(mysql_query("Select MAX(PRODCATTYPEFLAG) from fna_session WHERE PROJECTID = '".$PROJECTID."' AND SUBPROJECTID = '".$SUBPROJECTID."' AND PRODCATTYPEID = '".$PRODCATTYPEID."' AND YEARCOMPLETE = 'No'"));
			$MaxProdCatTypeFlag	= $MaxTypeFlag_Query['MAX(PRODCATTYPEFLAG)'];
			
			
			$Query		= "
									SELECT 
											*
									FROM 
											fna_session
									WHERE '".$ENTRYDATE."' 	BETWEEN STARTDATE AND ENDDATE
										AND PROJECTID = '".$PROJECTID."'
										AND SUBPROJECTID = '".$SUBPROJECTID."'
										AND PRODCATTYPEID = '".$PRODCATTYPEID."'
										AND PRODCATTYPEFLAG = '".$MaxProdCatTypeFlag."'
										AND YEARCOMPLETE = 'No'
								";
			$QueryStatement	= mysql_query($Query);
			if(mysql_num_rows($QueryStatement)>0) {
				
				$EntrySerial_Query_Flag = mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_entryserialno"));
				$MaxFlagEntrySl			= $EntrySerial_Query_Flag['MAX(FLAG)'];
				
				$EntrySerial_Query_No	= mysql_fetch_array(mysql_query("SELECT MAX(ENTRYSERIALNOID) FROM fna_entryserialno"));
				$MaxEntrySlNo			= $EntrySerial_Query_No['MAX(ENTRYSERIALNOID)'] + 1;
		
		
				$insertQueryEntrySl = "
										INSERT INTO 
													fna_entryserialno
																	(
																		ENTRYSERIALNO,
																		PROJECTID,
																		SUBPROJECTID,
																		ENTRYDATE,
																		FLAG,
																		STATUS,
																		ENTDATE,
																		ENTTIME,
																		USERID
																	) 
															VALUES
																	(
																		'".$MaxEntrySlNo."',
																		'".$PROJECTID."',
																		'".$SUBPROJECTID."',
																		'".$ENTRYDATE."',
																		'".$MaxFlagEntrySl."',
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									";
				$insertQueryEntrySlStatement = mysql_query($insertQueryEntrySl);
				
				
				$CheckQuery		= mysql_fetch_array(mysql_query("SELECT * FROM fna_session WHERE PROJECTID = '".$PROJECTID."' AND SUBPROJECTID = '".$SUBPROJECTID."' AND PRODCATTYPEID = '".$PRODCATTYPEID."' AND WORKTYPE = '".$WorkType."' AND PRODCATTYPEFLAG = '".$MaxProdCatTypeFlag."' AND YEARCOMPLETE = 'No' "));
				$StartDateQry	= $CheckQuery['STARTDATE'];
				$EndDateQry		= $CheckQuery['ENDDATE'];
				
				$start 	= strtotime($ENTRYDATE);
				$end 	= strtotime($EndDateQry);
				
				$days_between = ceil(abs($end - $start) / 86400);	
				
					if($days_between > 15){
				
					$MAXRECNO = mysql_fetch_array(mysql_query("SELECT MAX(IFNULL(RECEIVENUMBER,0)) FROM fna_productloadunload "));
					$maxNo = $MAXRECNO['MAX(IFNULL(RECEIVENUMBER,0))'];
					if($maxNo == 0){
							$nowMAXRECNO = $maxNo + 1;
						}else{
							$nowMAXRECNO = $maxNo + 1;	
						}
						$insertQuery = "
										INSERT INTO 
													fna_productloadunload
																		(
																			ENTRYSERIALNOID,
																			PROJECTID,
																			SUBPROJECTID,
																			PARTYID,
																			LABOURID,
																			ENTRYDATE,
																			RECEIVENUMBER,
																			STATUS,
																			ENTDATE,
																			ENTTIME,
																			USERID
																		) 
																VALUES
																		(
																			'".$MaxEntrySlNo."',
																			'".$PROJECTID."',
																			'".$SUBPROJECTID."',
																			'".$PARTYID."',
																			'".$LABOURID."',
																			'".$ENTRYDATE."',
																			'".$nowMAXRECNO."',
																			'Load',
																			'".$entDate."',
																			'".$entTime."',
																			'".$userId."'
																		)
										"; 
						if(mysql_query($insertQuery)){
							
							$loadCtId = mysql_insert_id();
							
							
							$k = 0;
							$globalLabourTotalBillAmount = 0;
							$globalPartyTotalBillAmount = 0;
							
							for($i = 1; $i < $TOTAL_PRODUCT_LIST; $i++ ){
							
									$insertbkdnQuery = "
											INSERT INTO 
														fna_productloadunloadbkdn
																		(
																			ENTRYSERIALNOID,
																			PRODUCTLOADUNLOADID,
																			PRODCATTYPEID,
																			PRODUCTID,
																			PACKINGUNITID,
																			CHALLANNO,
																			QUANTITY,
																			WTQNTY,
																			CHID,
																			POCKET,
																			STATUS,
																			ENTDATE,
																			ENTTIME,
																			USERID
																		) 
																VALUES
																		(
																			'".$MaxEntrySlNo."',
																			'".$loadCtId."',
																			'".$PRODCATTYPEID."',
																			'".$PRODUCTID[$k]."',
																			'".$packingUnit[$k]."',
																			'".$CHALLANNO[$k]."',
																			'".$quantity[$k]."',
																			'".$wtquantity[$k]."',
																			'".$CHID[$k]."',
																			'',
																			'Load',
																			'".$entDate."',
																			'".$entTime."',
																			'".$userId."'
																		)
										"; 
										
										
										$insertbkdnQueryStatement = mysql_query($insertbkdnQuery);
										if($insertbkdnQueryStatement){
											$msg = "<span class='validMsg'>Labour Information [$loadCtId] added sucessfully</span>";
										}else{
											$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
											break;
											}
											
											//Update Product Stock table Start
											$loadUnloadBkdnIdCtId = mysql_insert_id();
											
											$partyFlag = mysql_fetch_array(mysql_query("SELECT MAX(IFNULL(PARTYFLAG,0)) FROM fna_productstock WHERE PARTYID = '".$PARTYID."'"));
											$MAXpartyFlag = $partyFlag['MAX(IFNULL(PARTYFLAG,0))'];
											$NowMAXpartyFlag = $MAXpartyFlag + 1;
											
											$prodCatTypeFlag = mysql_fetch_array(mysql_query("SELECT MAX(IFNULL(PRODCATTYPEFLAG,0)) FROM fna_productstock WHERE PARTYID = '".$PARTYID."' AND PRODCATTYPEID = '".$PRODCATTYPEID."'"));
											$MAXprodCatTypeFlag = $prodCatTypeFlag['MAX(IFNULL(PRODCATTYPEFLAG,0))'];
											$NowMaxprodCatTypeFlag = $MAXprodCatTypeFlag + 1;
											
											$prodTypeFlag = mysql_fetch_array(mysql_query("SELECT MAX(PRODTYPEFLAG) FROM fna_productstock WHERE PARTYID = '".$PARTYID."' AND PRODUCTID = '".$PRODUCTID[$k]."'"));
											
											$MAXprodTypeFlag = $prodTypeFlag['MAX(PRODTYPEFLAG)'];
											if ($MAXprodTypeFlag == ''){
													//$MAXprodTypeFlag = 0;
													$NowTotQnty = $quantity[$k];
													$NowBalBasta = $LoadBasta[$k];
													$NowBalKG	 = $LoadKg[$k];
												}else
												{
													$prodQnty = mysql_fetch_array(mysql_query("SELECT TOTQUANTITY, BALBASTA, BALKG, AVGUNIT FROM fna_productstock WHERE PARTYID = '".$PARTYID."' AND PRODUCTID = '".$PRODUCTID[$k]."' AND PRODTYPEFLAG = '".$MAXprodTypeFlag."'"));
													$TotQnty 		= $prodQnty['TOTQUANTITY'];
													$NowTotQnty 	= $prodQnty['TOTQUANTITY'] + $quantity[$k];
													$NowBalBasta 	= $prodQnty['BALBASTA'] + $LoadBasta[$k];
													$NowBalKG	 	= $prodQnty['BALKG'] + $LoadKg[$k];
													
												
												}
												
											$LoadUnit		= ($LoadKg[$k] / $LoadBasta[$k] ) ; 
											$NowAVGUNIT	 	= ($NowBalKG / $NowBalBasta ) ;	
														
											$NowMaxprodTypeFlag = $MAXprodTypeFlag + 1;
											
											
											$insertStockQuery = "
																INSERT INTO 
																			fna_productstock
																						(
																							ENTRYSERIALNOID,
																							PROJECTID,
																							SUBPROJECTID,
																							PRODUCTLOADUNLOADBKDNID,
																							PARTYID,
																							PRODCATTYPEID,
																							PRODUCTID,
																							QUANTITY,
																							WTQNTY,
																							TOTQUANTITY,
																							LOADBASTA,
																							BALBASTA,
																							LOADKG,
																							BALKG,
																							LOADUNIT,
																							AVGUNIT,
																							PARTYFLAG,
																							PRODCATTYPEFLAG,
																							PRODTYPEFLAG,
																							WORKTYPEFLAG,
																							STATUS,
																							ENTDATE,
																							ENTTIME,
																							USERID
																						) 
																				VALUES
																						(
																							'".$MaxEntrySlNo."',
																							'".$PROJECTID."',
																							'".$SUBPROJECTID."',
																							'".$loadUnloadBkdnIdCtId."',
																							'".$PARTYID."',
																							'".$PRODCATTYPEID."',
																							'".$PRODUCTID[$k]."',
																							'".$quantity[$k]."',
																							'".$wtquantity[$k]."',
																							'".$NowTotQnty."',
																							'".$LoadBasta[$k]."',
																							'".$NowBalBasta."',
																							'".$LoadKg[$k]."',
																							'".$NowBalKG."',
																							'".$LoadUnit."',
																							'".$NowAVGUNIT."',
																							'".$NowMAXpartyFlag."',
																							'".$NowMaxprodCatTypeFlag."',
																							'".$NowMaxprodTypeFlag."',
																							'Load',
																							'Active',
																							'".$ENTRYDATE."',
																							'".$entTime."',
																							'".$userId."'
																						)
										"; 
										
										
										$insertStockQueryStatement = mysql_query($insertStockQuery);
											//Update Product Stock table End
											
											//Update Labour Work History Table Start
											$LABOURIDQUERY  =mysql_fetch_array(mysql_query("SELECT LABCONTACTID FROM fna_labourcontact WHERE LABOURID = '".$LABOURID."'"));
											$LABCONTACTID = $LABOURIDQUERY['LABCONTACTID'];
											
											$QUERYLOADPRICE = "
																			SELECT 	
																					 DISTINCT lc_bkdn.LOADPRICE
																			FROM 	
																					fna_labourcontact lc, fna_labourcontact_bkdn lc_bkdn
																			WHERE	lc.LABCONTACTID = lc_bkdn.LABCONTACTID
																			AND 	lc.LABOURID =".$LABOURID." 
																			AND 	lc_bkdn.PACKINGUNITID =".$packingUnit[$k]."
																			AND 	lc_bkdn.CHAMBERIDTO =".$CHID[$k]." 
																			AND 	lc_bkdn.CHAMBERIDFROM = '' 
																			ORDER BY 
																					lc_bkdn.PACKINGUNITID ASC
																			";
														$QUERYLOADPRICEStatement				= mysql_query($QUERYLOADPRICE);
														while($QUERYLOADPRICEStatementData		= mysql_fetch_array($QUERYLOADPRICEStatement)) {
															$LOADPRICE		   					= $QUERYLOADPRICEStatementData['LOADPRICE'];
															
														}
											
											
											
											$TOTBILLAMOUNT = ( $quantity[$k] * $LOADPRICE ) + $EXTRALABBILL[$k] ;
											$globalLabourTotalBillAmount = $globalLabourTotalBillAmount + $TOTBILLAMOUNT ;
											
											
											$insertLabWorkHistQuery = "
																INSERT INTO 
																			fna_labourworkhistory
																						(
																							ENTRYSERIALNOID,
																							PROJECTID,
																							SUBPROJECTID,
																							LABOURID,
																							PARTYID,
																							PRODUCTLOADUNLOADBKDNID,
																							PRODCATTYPEID,
																							PRODUCTID,
																							PACKINGUNITID,
																							QUANTITY,
																							CHID,
																							POCKET,
																							BILLAMOUNT,
																							EXTRALABBILL,
																							TOTBILLAMOUNT,
																							RECEIVENUMBER,
																							WORKTYPEFLAG,
																							STATUS,
																							ENTDATE,
																							ENTTIME,
																							USERID
																						) 
																				VALUES
																						(
																							'".$MaxEntrySlNo."',
																							'".$PROJECTID."',
																							'".$SUBPROJECTID."',
																							'".$LABOURID."',
																							'".$PARTYID."',
																							'".$loadUnloadBkdnIdCtId."',
																							'".$PRODCATTYPEID."',
																							'".$PRODUCTID[$k]."',
																							'".$packingUnit[$k]."',
																							'".$quantity[$k]."',
																							'".$CHID[$k]."',
																							'',
																							'".$LOADPRICE."',
																							'".$EXTRALABBILL[$k]."',
																							'".$TOTBILLAMOUNT."',
																							'".$nowMAXRECNO."',
																							'Load',
																							'Active',
																							'".$ENTRYDATE."',
																							'".$entTime."',
																							'".$userId."'
																						)
										"; 
										
										
										$insertLabWorkHistQueryStatement = mysql_query($insertLabWorkHistQuery);
										
										//Update Labour Work History Table End
										
										// Update FNA Bill Table Start
										$MAX_PARTY_FLAG_BILL = mysql_fetch_array(mysql_query("SELECT MAX(IFNULL(PARTYFLAG,0)) FROM fna_bill WHERE PARTYID = '".$PARTYID."'"));
										$MAXPARTY_FLAG_BILL 		= $MAX_PARTY_FLAG_BILL['MAX(IFNULL(PARTYFLAG,0))'];
										$NOW_MAX_PARTY_FLAG_BILL 	= $MAXPARTY_FLAG_BILL + 1 ;
										$TOT_AMOUNT_PARTY_BILL 		= mysql_fetch_array(mysql_query("SELECT * FROM fna_bill WHERE PARTYID = '".$PARTYID."' and PARTYFLAG = '".$MAXPARTY_FLAG_BILL."'"));
										$PARTY_TOT_AMOUNT_BILL 	= $TOT_AMOUNT_PARTY_BILL['TOTBILLAMOUNT'];
										$PARTY_BALANCE_BILL 	= $TOT_AMOUNT_PARTY_BILL['BALANCE_BILL'];
										
											
										$SESSIONID  =mysql_fetch_array(mysql_query("SELECT SESSIONID FROM fna_session WHERE PRODCATTYPEID = '".$PRODCATTYPEID."'"));
										$NOWSESSIONID = $SESSIONID['SESSIONID'];
										$QUERYPACKINGUNITID = mysql_fetch_array(mysql_query("SELECT QID, WTID FROM fna_packingunit WHERE PACKINGUNITID = '".$packingUnit[$k]."'"));
										$NOW_QID 			= $QUERYPACKINGUNITID['QID'];
										$NOW_WTID 			= $QUERYPACKINGUNITID['WTID'];
										
										$qvalue = mysql_fetch_array(mysql_query("SELECT QVALUE FROM fna_quantity WHERE QID = '".$NOW_QID."'"));
										$now_qvalue = $qvalue['QVALUE'];
										$TOTQUANTITY_PROD 	= $quantity[$k] * $now_qvalue ;
										$QUERYPRODFARE		= mysql_fetch_array(mysql_query("SELECT UNITFARE FROM fna_productfare WHERE PRODCATTYPEID = '".$PRODCATTYPEID."' AND PRODUCTID = '".$PRODUCTID[$k]."'"));
										$NOW_UNITFARE		= $QUERYPRODFARE['UNITFARE'];
										$NOW_BILLAMOUNT		= $wtquantity[$k] * $NOW_UNITFARE ; 
										$TOTBILLAMOUNT_PROD	= $NOW_BILLAMOUNT + $PARTY_TOT_AMOUNT_BILL ;
										$NOW_PARTY_BALANCE_BILL		= $PARTY_BALANCE_BILL + $NOW_BILLAMOUNT ;
										
										$globalPartyTotalBillAmount = $globalPartyTotalBillAmount + $NOW_BILLAMOUNT ; 
										
										
										$insertFNABillQuery = "
															INSERT INTO 
																		fna_bill
																					(
																						ENTRYSERIALNOID,
																						PROJECTID,
																						SUBPROJECTID,
																						SESSIONID,
																						PARTYID,
																						RECEIVENUMBER,
																						PRODCATTYPEID,
																						PRODUCTID,
																						PACKINGUNITID,
																						QUANTITY,
																						WTQNTY,
																						TOTQUANTITY,
																						BILLAMOUNT,
																						TOTBILLAMOUNT,
																						BALANCE_BILL,
																						PARTYFLAG,
																						ENTRYDATE,
																						STATUS,
																						ENTDATE,
																						ENTTIME,
																						USERID
																					) 
																			VALUES
																					(
																						'".$MaxEntrySlNo."',
																						'".$PROJECTID."',
																						'".$SUBPROJECTID."',
																						'".$NOWSESSIONID."',
																						'".$PARTYID."',
																						'".$nowMAXRECNO."',
																						'".$PRODCATTYPEID."',
																						'".$PRODUCTID[$k]."',
																						'".$packingUnit[$k]."',
																						'".$quantity[$k]."',
																						'".$wtquantity[$k]."',
																						'".$wtquantity[$k]."',
																						'".$NOW_BILLAMOUNT."',
																						'".$TOTBILLAMOUNT_PROD."',
																						'".$NOW_PARTY_BALANCE_BILL."',
																						'".$NOW_MAX_PARTY_FLAG_BILL."',
																						'".$ENTRYDATE."',
																						'Load',
																						'".$entDate."',
																						'".$entTime."',
																						'".$userId."'
																					)
									";
									
									
									$insertFNABillQueryStatement = mysql_query($insertFNABillQuery);
									
										// Update FNA Bill Table End
										
										//----------------------------Packing Unit Name Start--------------------------------------------------------
										
										$ProCatNameQuery		= mysql_fetch_array(mysql_query("SELECT CATEGORYTYPENAME FROM fna_productcattype WHERE PROJECTID = '".$PROJECTID."' and SUBPROJECTID = '".$SUBPROJECTID."' and PRODCATTYPEID = '".$PRODCATTYPEID."'"));
										
										$CATEGORYTYPENAME_NEW	= $ProCatNameQuery['CATEGORYTYPENAME'];
										
										$ProdNameQuery = "
																			SELECT
																					PRODUCTNAME
																			FROM
																					fna_product 
																					WHERE PROJECTID = '".$PROJECTID."'
																					AND SUBPROJECTID = '".$SUBPROJECTID."'
																					AND PRODCATTYPEID = '".$PRODCATTYPEID."'
																					AND PRODUCTID = '".$PRODUCTID[$k]."'
																			";
														$ProdNameQueryStatement				= mysql_query($ProdNameQuery);
														while($ProdNameQueryStatementData	= mysql_fetch_array($ProdNameQueryStatement)) {
															$PRODUCTNAME_NEW   				= $ProdNameQueryStatementData['PRODUCTNAME'];
															
														}
														
													$getModuleQuery	= "
																			SELECT 	
																						pu.PACKINGNAMEID,
																						pu.QID,
																						pu.WTID
																			FROM 	
																					fna_packingunit pu
																			WHERE	PACKINGUNITID ='".$packingUnit[$k]."' 
																			
																		 "; 
											$getModuleStatement				= mysql_query($getModuleQuery);
											while($getModuleStatementData	= mysql_fetch_array($getModuleStatement)) {
												$PACKINGNAMEID 				= $getModuleStatementData['PACKINGNAMEID'];
												$QID 						= $getModuleStatementData['QID'];
												$WTID 						= $getModuleStatementData['WTID'];
										
									 			
												$packingNameQuery = "
																			SELECT
																					PACKINGNAME
																			FROM
																					fna_packingname 
																					WHERE PACKINGNAMEID = '".$PACKINGNAMEID."'
																			"; 
														$packingNameQueryStatement				= mysql_query($packingNameQuery);
														while($packingNameQueryStatementData	= mysql_fetch_array($packingNameQueryStatement)) {
															$PACKINGNAME_NEW   			= $packingNameQueryStatementData['PACKINGNAME'];
															
														}
														
														$QidQuery = "
																			SELECT
																					QVALUE
																			FROM
																					fna_quantity 
																					WHERE QID = '".$QID."'
																			"; 
														$QidQueryStatement				= mysql_query($QidQuery);
														while($QidQueryStatementData	= mysql_fetch_array($QidQueryStatement)) {
															$QVALUE   		= $QidQueryStatementData['QVALUE'];
															
														}
														
														$wtidQuery = "
																			SELECT
																					WNAME
																			FROM
																					fna_weight 
																					WHERE WTID = '".$WTID."'
																			"; 
														$wtidQueryStatement				= mysql_query($wtidQuery);
														while($wtidQueryStatementData	= mysql_fetch_array($wtidQueryStatement)) {
															$WNAME   		= $wtidQueryStatementData['WNAME'];
															
														}
												
												
														$packingUnitList  = $PACKINGNAME_NEW.", ".$QVALUE.",".$WNAME;
											}
										//----------------------------Packing Unit Name End --------------------------------------------------------
										
										//-----------------------------------------Update Daily Income Expanse Table Start------------------------------------------------
										
										
										$INEX_FLAG	 			= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_daily_income_expanse"));
										$MAXINEX_FLAG	 		= $INEX_FLAG['MAX(FLAG)'];
										$NOW_MAXINEX_FLAG	 	= $MAXINEX_FLAG + 1;
										
										$LABNAME_QRY 			= mysql_fetch_array(mysql_query("SELECT LABOURNAME FROM fna_labour WHERE LABOURID = '".$LABOURID."'"));
										$LABOURNAME				= $LABNAME_QRY['LABOURNAME'];
										$EX_Quantity			= $globalLabourTotalBillAmount / $LOADPRICE ;
										$NOW_DESCRIPTION		= 'LOAD : Labour Bill Payment to  '.$LABOURNAME . ' , '. $CATEGORYTYPENAME_NEW . ' , '.$PRODUCTNAME_NEW.' , ' .$packingUnitList.' , '.$quantity[$k].' * '.$LOADPRICE.' = '.$TOTBILLAMOUNT.'  ';
		
										$insertDailyInExQuery = "
																INSERT INTO 
																				fna_daily_income_expanse
																											(
																												ENTRYSERIALNOID,
																												PROJECTID,
																												SUBPROJECTID,
																												DATE,
																												EXPHID,
																												EXPANSE,
																												DESCRIPTION,
																												FLAG,
																												STATUS,
																												ENTDATE,
																												ENTTIME,
																												USERID
																											) 
																									VALUES
																											(
																												'".$MaxEntrySlNo."',
																												'".$PROJECTID."',
																												'".$SUBPROJECTID."',
																												'".$ENTRYDATE."',
																												'155',
																												'".$TOTBILLAMOUNT."',
																												'".$NOW_DESCRIPTION."',
																												'".$NOW_MAXINEX_FLAG."',
																												'Payment',
																												'".$entDate."',
																												'".$entTime."',
																												'".$userId."'
																											)
																	";
												
												
												$insertDailyInExQueryStatement = mysql_query($insertDailyInExQuery);
							
							//----------------------------------------------------Update Daily Income Expanse Table End ------------------------------------------------
											
											
							$k++;
						}
					// Upadate FNA Labour Bill Table Start
					$MAXLABFLAG = mysql_fetch_array(mysql_query("SELECT MAX(LABOURFLAG) FROM fna_labourbill WHERE LABOURID = '".$LABOURID."'"));
					$MAXLABOUR_FLAG = $MAXLABFLAG['MAX(LABOURFLAG)'];
					$NOW_MAXLAB_FLAG = $MAXLABOUR_FLAG + 1;
					$BAL_AMOUNT = mysql_fetch_array(mysql_query("SELECT BALANCEAMOUNT FROM fna_labourbill WHERE LABOURID = '".$LABOURID."' AND LABOURFLAG = '".$MAXLABOUR_FLAG."'"));
					$LAB_BAL_AMOUNT = $BAL_AMOUNT['BALANCEAMOUNT'];
					if(($MAXLABOUR_FLAG == 0) or ($MAXLABOUR_FLAG ='')){
						$NOW_LAB_BALAMOUNT = $globalLabourTotalBillAmount ;
					}else{
						$NOW_LAB_BALAMOUNT = $LAB_BAL_AMOUNT + $globalLabourTotalBillAmount ;
					}
					$insertLabourBillQuery = "
											INSERT INTO 
														fna_labourbill
																(
																	ENTRYSERIALNOID,
																	PROJECTID,
																	SUBPROJECTID,
																	LABOURID,
																	PARTYID,
																	PRODUCTLOADUNLOADID,
																	BILLAMOUNT,
																	PAYMENTAMOUNT,
																	BALANCEAMOUNT,
																	LABOURFLAG,
																	ENTRYDATE,
																	STATUS,
																	ENTDATE,
																	ENTTIME,
																	USERID
																) 
														VALUES
																(
																	'".$MaxEntrySlNo."',
																	'".$PROJECTID."',
																	'".$SUBPROJECTID."',
																	'".$LABOURID."',
																	'".$PARTYID."',
																	'".$loadCtId."',
																	'".$globalLabourTotalBillAmount."',
																	'0',
																	'".$NOW_LAB_BALAMOUNT."',
																	'".$NOW_MAXLAB_FLAG."',
																	'".$ENTRYDATE."',
																	'Load',
																	'".$entDate."',
																	'".$entTime."',
																	'".$userId."'
																)
						"; 
						
						
						$insertLabourBillQueryStatement = mysql_query($insertLabourBillQuery);
						
					// Upadate FNA Labour Bill Table End
					
					// Upadate FNA Party Bill Table Start	
					
					$MAX_PARTY_FLAG = mysql_fetch_array(mysql_query("SELECT MAX(PARTYFLAG) FROM fna_partybill WHERE PARTYID = '".$PARTYID."' AND PURSELLFLAG = 'Load'"));
					$MAXPARTY_FLAG = $MAX_PARTY_FLAG['MAX(PARTYFLAG)'];
					$NOW_MAX_PARTY_FLAG = $MAXPARTY_FLAG + 1;
					$BAL_AMOUNT_PARTY = mysql_fetch_array(mysql_query("SELECT BALANCEAMOUNT FROM fna_partybill WHERE PARTYID = '".$PARTYID."' AND PARTYFLAG = '".$MAXPARTY_FLAG."' AND PURSELLFLAG = 'Load'"));
					$PARTY_BAL_AMOUNT = $BAL_AMOUNT_PARTY['BALANCEAMOUNT'];
					
					if(($MAXPARTY_FLAG == 0) or ($MAXPARTY_FLAG ='')){
						$NOW_PARTY_BALAMOUNT = $globalPartyTotalBillAmount ;
					}else{
						$NOW_PARTY_BALAMOUNT = $PARTY_BAL_AMOUNT + $globalPartyTotalBillAmount ; 
					}
					$insertPartyBillQuery = "
											INSERT INTO 
														fna_partybill
																(
																	ENTRYSERIALNOID,
																	PROJECTID,
																	SUBPROJECTID,
																	PARTYID,
																	RECEIVENUMBER,
																	SELL_BILLAMOUNT,
																	PAYMENTAMOUNT,
																	RECEIVEAMOUNT,
																	BALANCEAMOUNT,
																	ENTRYDATE,
																	PARTYFLAG,
																	STATUS,
																	PURSELLFLAG,
																	ENTDATE,
																	ENTTIME,
																	USERID
																) 
														VALUES
																(
																	'".$MaxEntrySlNo."',
																	'".$PROJECTID."',
																	'".$SUBPROJECTID."',
																	'".$PARTYID."',
																	'".$nowMAXRECNO."',
																	'".$globalPartyTotalBillAmount."',
																	'0',
																	'0',
																	'".$NOW_PARTY_BALAMOUNT."',
																	'".$ENTRYDATE."',
																	'".$NOW_MAX_PARTY_FLAG."',
																	'Active',
																	'Load',
																	'".$entDate."',
																	'".$entTime."',
																	'".$userId."'
																)
						"; 
						
						
						$insertPartyBillQueryStatement = mysql_query($insertPartyBillQuery);
					// Upadate FNA Party Bill Table End
					
					//------------------------------------------------Labour Bill Direct Entry Start---------------------------------------------------------------
					
					
					// Upadate FNA Labour Bill Table Start
						$MAXLABFLAG = mysql_fetch_array(mysql_query("SELECT MAX(LABOURFLAG) FROM fna_labourbill WHERE LABOURID = '".$LABOURID."'"));
						$MAXLABOUR_FLAG = $MAXLABFLAG['MAX(LABOURFLAG)'];
						$NOW_MAXLAB_FLAG = $MAXLABOUR_FLAG + 1;
						$BAL_AMOUNT = mysql_fetch_array(mysql_query("SELECT BALANCEAMOUNT FROM fna_labourbill WHERE LABOURID = '".$LABOURID."' AND LABOURFLAG = '".$MAXLABOUR_FLAG."'"));
						$LAB_BAL_AMOUNT = $BAL_AMOUNT['BALANCEAMOUNT'];
						
						if(($MAXLABOUR_FLAG == 0) or ($MAXLABOUR_FLAG ='')){
							$NOW_LAB_BALAMOUNT = $globalLabourTotalBillAmount ;
						}else{
							$NOW_LAB_BALAMOUNT = $LAB_BAL_AMOUNT - $globalLabourTotalBillAmount ;
						}
							
												
							$insertLabourBillQueryPayment = "
																INSERT INTO 
																			fna_labourbill
																					(
																						ENTRYSERIALNOID,
																						PROJECTID,
																						SUBPROJECTID,
																						LABOURID,
																						EXPHID,
																						PARTYID,
																						PRODUCTLOADUNLOADID,
																						BILLAMOUNT,
																						PAYMENTAMOUNT,
																						BALANCEAMOUNT,
																						LABOURFLAG,
																						ENTRYDATE,
																						STATUS,
																						ENTDATE,
																						ENTTIME,
																						USERID
																					) 
																			VALUES
																					(
																						'".$MaxEntrySlNo."',
																						'".$PROJECTID."',
																						'".$SUBPROJECTID."',
																						'".$LABOURID."',
																						'155',
																						'".$PARTYID."',
																						'".$loadCtId."',
																						'0',
																						'".$globalLabourTotalBillAmount."',
																						'".$NOW_LAB_BALAMOUNT."',
																						'".$NOW_MAXLAB_FLAG."',
																						'".$ENTRYDATE."',
																						'Load',
																						'".$entDate."',
																						'".$entTime."',
																						'".$userId."'
						
																					)
																				"; 
								
								
								$insertLabourBillQueryStatementPayment = mysql_query($insertLabourBillQueryPayment);
							
							if($insertLabourBillQueryStatementPayment){
								
									$insertQueryExpLabBill = "
														INSERT INTO 
																	fna_expanse
																					(
																						ENTRYSERIALNOID,
																						PROJECTID,
																						SUBPROJECTID,
																						PARTYID,
																						EXPHID,
																						EXPSUBHID,
																						AMOUNT,
																						EXPDATE,
																						DESCRIPTION,
																						STATUS,
																						ENTDATE,
																						ENTTIME,
																						USERID
																					) 
																			VALUES
																					(
																						'".$MaxEntrySlNo."',
																						'".$PROJECTID."',
																						'".$SUBPROJECTID."',
																						'".$PARTYID."',
																						'155',
																						'0',
																						'".$globalLabourTotalBillAmount."',
																						'".$ENTRYDATE."',
																						'Labour Bill Payment....',
																						'Payment',
																						'".$entDate."',
																						'".$entTime."',
																						'".$userId."'
																					)
													";
									$insertQueryExpStatementLabBill = mysql_query($insertQueryExpLabBill);
									
									//Update FNA Balance Table Start
									$BALANCE_FLAG 			= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_balance"));
									$MAXBALANCE_FLAG 		= $BALANCE_FLAG['MAX(FLAG)'];
									$NOW_MAXBALANCE_FLAG 	= $MAXBALANCE_FLAG + 1;
									
									$BALANCE_QUERY		 	= mysql_fetch_array(mysql_query("SELECT * FROM fna_balance WHERE FLAG = '".$MAXBALANCE_FLAG."'"));
									$INCOME_AMOUNT 			= $BALANCE_QUERY['INCOME'];
									$EXPANSE_AMOUNT			= $BALANCE_QUERY['EXPANSE'];
									$BALANCE_AMOUNT 		= $BALANCE_QUERY['BALANCE'];
									
									$NOW_BALANCE_AMOUNT		= $BALANCE_AMOUNT - $globalLabourTotalBillAmount ;
									
									$insertBalanceQuery = "
															INSERT INTO 
																		fna_balance
																				(
																					ENTRYSERIALNOID,
																					PROJECTID,
																					SUBPROJECTID,
																					EXPANSE,
																					BALANCE,
																					FLAG,
																					BALDATE,
																					STATUS,
																					ENTDATE,
																					ENTTIME,
																					USERID
																				) 
																		VALUES
																				(
																					'".$MaxEntrySlNo."',
																					'".$PROJECTID."',
																					'".$SUBPROJECTID."',
																					'".$globalLabourTotalBillAmount."',
																					'".$NOW_BALANCE_AMOUNT."',
																					'".$NOW_MAXBALANCE_FLAG."',
																					'".$ENTRYDATE."',
																					'Payment',
																					'".$entDate."',
																					'".$entTime."',
																					'".$userId."'
																				)
										";
										
										
										$insertBalanceQueryStatement = mysql_query($insertBalanceQuery);
							}
									//Update FNA Balance Table End
									
							//------------------------------------------------Labour Bill Direct Entry End  ---------------------------------------------------------------
						
						
					} else {
						$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
					}
					
				}else{
					$MAXRECNO = mysql_fetch_array(mysql_query("SELECT MAX(IFNULL(RECEIVENUMBER,0)) FROM fna_productloadunload "));
					$maxNo = $MAXRECNO['MAX(IFNULL(RECEIVENUMBER,0))'];
					if($maxNo == 0){
							$nowMAXRECNO = $maxNo + 1;
						}else{
							$nowMAXRECNO = $maxNo + 1;	
						}
						
						$maxFlagQry			= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_productloadunload"));
						$maxFlag			= $maxFlagQry['MAX(FLAG)'];
						$Now_maxFlag		= $maxFlag + 1;
						$insertQuery = "
										INSERT INTO 
													fna_productloadunload
																		(
																			ENTRYSERIALNOID,
																			PROJECTID,
																			SUBPROJECTID,
																			PARTYID,
																			LABOURID,
																			ENTRYDATE,
																			RECEIVENUMBER,
																			FLAG,
																			STATUS,
																			ENTDATE,
																			ENTTIME,
																			USERID
																		) 
																VALUES
																		(
																			'".$MaxEntrySlNo."',
																			'".$PROJECTID."',
																			'".$SUBPROJECTID."',
																			'".$PARTYID."',
																			'".$LABOURID."',
																			'".$ENTRYDATE."',
																			'".$nowMAXRECNO."',
																			'".$Now_maxFlag."',
																			'Load',
																			'".$entDate."',
																			'".$entTime."',
																			'".$userId."'
																		)
										"; 
						if(mysql_query($insertQuery)){
							
							$loadCtId = mysql_insert_id();
							
							
							$k = 0;
							$globalLabourTotalBillAmount = 0;
							$globalPartyTotalBillAmount = 0;
							
							for($i = 1; $i < $TOTAL_PRODUCT_LIST; $i++ ){
							
									$insertbkdnQuery = "
											INSERT INTO 
														fna_productloadunloadbkdn
																		(
																			ENTRYSERIALNOID,
																			PRODUCTLOADUNLOADID,
																			PRODCATTYPEID,
																			PRODUCTID,
																			PACKINGUNITID,
																			CHALLANNO,
																			QUANTITY,
																			WTQNTY,
																			CHID,
																			POCKET,
																			STATUS,
																			ENTDATE,
																			ENTTIME,
																			USERID
																		) 
																VALUES
																		(
																			'".$MaxEntrySlNo."',
																			'".$loadCtId."',
																			'".$PRODCATTYPEID."',
																			'".$PRODUCTID[$k]."',
																			'".$packingUnit[$k]."',
																			'".$CHALLANNO[$k]."',
																			'".$quantity[$k]."',
																			'".$wtquantity[$k]."',
																			'".$CHID[$k]."',
																			'',
																			'Load',
																			'".$entDate."',
																			'".$entTime."',
																			'".$userId."'
																		)
										"; 
										
										
										$insertbkdnQueryStatement = mysql_query($insertbkdnQuery);
										if($insertbkdnQueryStatement){
											$msg = "<span class='validMsg'>Labour Information [$loadCtId] added sucessfully</span>";
										}else{
											$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
											break;
											}
											
											//Update Product Stock table Start
											$loadUnloadBkdnIdCtId = mysql_insert_id();
											
											$partyFlag = mysql_fetch_array(mysql_query("SELECT MAX(IFNULL(PARTYFLAG,0)) FROM fna_productstock WHERE PARTYID = '".$PARTYID."'"));
											$MAXpartyFlag = $partyFlag['MAX(IFNULL(PARTYFLAG,0))'];
											$NowMAXpartyFlag = $MAXpartyFlag + 1;
											
											$prodCatTypeFlag = mysql_fetch_array(mysql_query("SELECT MAX(IFNULL(PRODCATTYPEFLAG,0)) FROM fna_productstock WHERE PARTYID = '".$PARTYID."' AND PRODCATTYPEID = '".$PRODCATTYPEID."'"));
											$MAXprodCatTypeFlag = $prodCatTypeFlag['MAX(IFNULL(PRODCATTYPEFLAG,0))'];
											$NowMaxprodCatTypeFlag = $MAXprodCatTypeFlag + 1;
											
											$prodTypeFlag = mysql_fetch_array(mysql_query("SELECT MAX(PRODTYPEFLAG) FROM fna_productstock WHERE PARTYID = '".$PARTYID."' AND PRODUCTID = '".$PRODUCTID[$k]."'"));
											
											$MAXprodTypeFlag = $prodTypeFlag['MAX(PRODTYPEFLAG)'];
											if ($MAXprodTypeFlag == ''){
													//$MAXprodTypeFlag = 0;
													$NowTotQnty = $quantity[$k];
													$NowBalBasta = $LoadBasta[$k];
													$NowBalKG	 = $LoadKg[$k];
												}else
												{
													$prodQnty = mysql_fetch_array(mysql_query("SELECT TOTQUANTITY, BALBASTA, BALKG, AVGUNIT FROM fna_productstock WHERE PARTYID = '".$PARTYID."' AND PRODUCTID = '".$PRODUCTID[$k]."' AND PRODTYPEFLAG = '".$MAXprodTypeFlag."'"));
													$TotQnty 		= $prodQnty['TOTQUANTITY'];
													$NowTotQnty 	= $prodQnty['TOTQUANTITY'] + $quantity[$k];
													$NowBalBasta 	= $prodQnty['BALBASTA'] + $LoadBasta[$k];
													$NowBalKG	 	= $prodQnty['BALKG'] + $LoadKg[$k];
													
												
												}
												
											$LoadUnit		= ($LoadKg[$k] / $LoadBasta[$k] ) ; 
											$NowAVGUNIT	 	= ($NowBalKG / $NowBalBasta ) ;	
														
											$NowMaxprodTypeFlag = $MAXprodTypeFlag + 1;
											
											
											$insertStockQuery = "
																INSERT INTO 
																			fna_productstock
																						(
																							ENTRYSERIALNOID,
																							PROJECTID,
																							SUBPROJECTID,
																							PRODUCTLOADUNLOADBKDNID,
																							PARTYID,
																							PRODCATTYPEID,
																							PRODUCTID,
																							QUANTITY,
																							WTQNTY,
																							TOTQUANTITY,
																							LOADBASTA,
																							BALBASTA,
																							LOADKG,
																							BALKG,
																							LOADUNIT,
																							AVGUNIT,
																							PARTYFLAG,
																							PRODCATTYPEFLAG,
																							PRODTYPEFLAG,
																							WORKTYPEFLAG,
																							STATUS,
																							ENTDATE,
																							ENTTIME,
																							USERID
																						) 
																				VALUES
																						(
																							'".$MaxEntrySlNo."',
																							'".$PROJECTID."',
																							'".$SUBPROJECTID."',
																							'".$loadUnloadBkdnIdCtId."',
																							'".$PARTYID."',
																							'".$PRODCATTYPEID."',
																							'".$PRODUCTID[$k]."',
																							'".$quantity[$k]."',
																							'".$wtquantity[$k]."',
																							'".$NowTotQnty."',
																							'".$LoadBasta[$k]."',
																							'".$NowBalBasta."',
																							'".$LoadKg[$k]."',
																							'".$NowBalKG."',
																							'".$LoadUnit."',
																							'".$NowAVGUNIT."',
																							'".$NowMAXpartyFlag."',
																							'".$NowMaxprodCatTypeFlag."',
																							'".$NowMaxprodTypeFlag."',
																							'Load',
																							'Active',
																							'".$ENTRYDATE."',
																							'".$entTime."',
																							'".$userId."'
																						)
										"; 
										
										
										$insertStockQueryStatement = mysql_query($insertStockQuery);
											//Update Product Stock table End
											
											//Update Labour Work History Table Start
											$LABOURIDQUERY  =mysql_fetch_array(mysql_query("SELECT LABCONTACTID FROM fna_labourcontact WHERE LABOURID = '".$LABOURID."'"));
											$LABCONTACTID = $LABOURIDQUERY['LABCONTACTID'];
											
											$QUERYLOADPRICE = "				SELECT 	
																					 DISTINCT lc_bkdn.LOADPRICE
																			FROM 	
																					fna_labourcontact lc, fna_labourcontact_bkdn lc_bkdn
																			WHERE	lc.LABCONTACTID = lc_bkdn.LABCONTACTID
																			AND 	lc.LABOURID =".$LABOURID." 
																			AND 	lc_bkdn.PACKINGUNITID =".$packingUnit[$k]."
																			AND 	lc_bkdn.CHAMBERIDTO =".$CHID[$k]." 
																			AND 	lc_bkdn.CHAMBERIDFROM = '' 
																			ORDER BY 
																					lc_bkdn.PACKINGUNITID ASC
																			
																			";
														$QUERYLOADPRICEStatement				= mysql_query($QUERYLOADPRICE);
														while($QUERYLOADPRICEStatementData		= mysql_fetch_array($QUERYLOADPRICEStatement)) {
															$LOADPRICE		   					= $QUERYLOADPRICEStatementData['LOADPRICE'];
															
														}
											
											$LOADPRICE = $QUERYLOADPRICE['LOADPRICE'];
											$TOTBILLAMOUNT = ($quantity[$k] * $LOADPRICE) + $EXTRALABBILL[$k] ;
											$globalLabourTotalBillAmount = $globalLabourTotalBillAmount + $TOTBILLAMOUNT ;
											
											
											$insertLabWorkHistQuery = "
																INSERT INTO 
																			fna_labourworkhistory
																						(
																							ENTRYSERIALNOID,
																							PROJECTID,
																							SUBPROJECTID,
																							LABOURID,
																							PARTYID,
																							PRODUCTLOADUNLOADBKDNID,
																							PRODCATTYPEID,
																							PRODUCTID,
																							PACKINGUNITID,
																							QUANTITY,
																							CHID,
																							POCKET,
																							BILLAMOUNT,
																							EXTRALABBILL,
																							TOTBILLAMOUNT,
																							RECEIVENUMBER,
																							WORKTYPEFLAG,
																							STATUS,
																							ENTDATE,
																							ENTTIME,
																							USERID
																						) 
																				VALUES
																						(
																							'".$MaxEntrySlNo."',
																							'".$PROJECTID."',
																							'".$SUBPROJECTID."',
																							'".$LABOURID."',
																							'".$PARTYID."',
																							'".$loadUnloadBkdnIdCtId."',
																							'".$PRODCATTYPEID."',
																							'".$PRODUCTID[$k]."',
																							'".$packingUnit[$k]."',
																							'".$quantity[$k]."',
																							'".$CHID[$k]."',
																							'',
																							'".$LOADPRICE."',
																							'".$EXTRALABBILL[$k]."',
																							'".$TOTBILLAMOUNT."',
																							'".$nowMAXRECNO."',
																							'Load',
																							'Active',
																							'".$ENTRYDATE."',
																							'".$entTime."',
																							'".$userId."'
																						)
										"; 
										
										
										$insertLabWorkHistQueryStatement = mysql_query($insertLabWorkHistQuery);
										
										//Update Labour Work History Table End
										/*
										// Update FNA Bill Table Start
										$MAX_PARTY_FLAG_BILL = mysql_fetch_array(mysql_query("SELECT MAX(IFNULL(PARTYFLAG,0)) FROM fna_bill WHERE PARTYID = '".$PARTYID."'"));
										$MAXPARTY_FLAG_BILL 		= $MAX_PARTY_FLAG_BILL['MAX(IFNULL(PARTYFLAG,0))'];
										$NOW_MAX_PARTY_FLAG_BILL 	= $MAXPARTY_FLAG_BILL + 1 ;
										$TOT_AMOUNT_PARTY_BILL 		= mysql_fetch_array(mysql_query("SELECT TOTBILLAMOUNT FROM fna_bill WHERE PARTYID = '".$PARTYID."' and PARTYFLAG = '".$MAXPARTY_FLAG_BILL."'"));
										$PARTY_TOT_AMOUNT_BILL = $TOT_AMOUNT_PARTY_BILL['TOTBILLAMOUNT'];
										
										$SESSIONID  =mysql_fetch_array(mysql_query("SELECT SESSIONID FROM fna_session WHERE PRODCATTYPEID = '".$PRODCATTYPEID."'"));
										$NOWSESSIONID = $SESSIONID['SESSIONID'];
										$QUERYPACKINGUNITID = mysql_fetch_array(mysql_query("SELECT QID, WTID FROM fna_packingunit WHERE PACKINGUNITID = '".$packingUnit[$k]."'"));
										$NOW_QID 			= $QUERYPACKINGUNITID['QID'];
										$NOW_WTID 			= $QUERYPACKINGUNITID['WTID'];
										
										$qvalue = mysql_fetch_array(mysql_query("SELECT QVALUE FROM fna_quantity WHERE QID = '".$NOW_QID."'"));
										$now_qvalue = $qvalue['QVALUE'];
										$TOTQUANTITY_PROD 	= $quantity[$k] * $now_qvalue ;
										$QUERYPRODFARE		= mysql_fetch_array(mysql_query("SELECT UNITFARE FROM fna_productfare WHERE PRODCATTYPEID = '".$PRODCATTYPEID."' AND PRODUCTID = '".$PRODUCTID[$k]."'"));
										$NOW_UNITFARE		= $QUERYPRODFARE['UNITFARE'];
										$NOW_BILLAMOUNT		= $wtquantity[$k] * $NOW_UNITFARE ; 
										$TOTBILLAMOUNT_PROD	= $NOW_BILLAMOUNT + $PARTY_TOT_AMOUNT_BILL ;
										
										$globalPartyTotalBillAmount = $globalPartyTotalBillAmount + $NOW_BILLAMOUNT ; 
										
										
										$insertFNABillQuery = "
															INSERT INTO 
																		fna_bill
																					(
																						PROJECTID,
																						SUBPROJECTID,
																						SESSIONID,
																						PARTYID,
																						RECEIVENUMBER,
																						PRODCATTYPEID,
																						PRODUCTID,
																						PACKINGUNITID,
																						QUANTITY,
																						WTQNTY,
																						TOTQUANTITY,
																						BILLAMOUNT,
																						TOTBILLAMOUNT,
																						PARTYFLAG,
																						ENTRYDATE,
																						STATUS,
																						ENTDATE,
																						ENTTIME,
																						USERID
																					) 
																			VALUES
																					(
																						'".$PROJECTID."',
																						'".$SUBPROJECTID."',
																						'".$NOWSESSIONID."',
																						'".$PARTYID."',
																						'".$nowMAXRECNO."',
																						'".$PRODCATTYPEID."',
																						'".$PRODUCTID[$k]."',
																						'".$packingUnit[$k]."',
																						'".$quantity[$k]."',
																						'".$wtquantity[$k]."',
																						'".$wtquantity[$k]."',
																						'".$NOW_BILLAMOUNT."',
																						'".$TOTBILLAMOUNT_PROD."',
																						'".$NOW_MAX_PARTY_FLAG_BILL."',
																						'".$ENTRYDATE."',
																						'Active',
																						'".$entDate."',
																						'".$entTime."',
																						'".$userId."'
																					)
									";
									
									
									$insertFNABillQueryStatement = mysql_query($insertFNABillQuery);
										// Update FNA Bill Table End
										*/	
										
										//----------------------------Packing Unit Name Start--------------------------------------------------------
										
										$ProCatNameQuery		= mysql_fetch_array(mysql_query("SELECT CATEGORYTYPENAME FROM fna_productcattype WHERE PROJECTID = '".$PROJECTID."' and SUBPROJECTID = '".$SUBPROJECTID."' and PRODCATTYPEID = '".$PRODCATTYPEID."'"));
										
										$CATEGORYTYPENAME_NEW	= $ProCatNameQuery['CATEGORYTYPENAME'];
										
										$ProdNameQuery = "
																			SELECT
																					PRODUCTNAME
																			FROM
																					fna_product 
																					WHERE PROJECTID = '".$PROJECTID."'
																					AND SUBPROJECTID = '".$SUBPROJECTID."'
																					AND PRODCATTYPEID = '".$PRODCATTYPEID."'
																					AND PRODUCTID = '".$PRODUCTID[$k]."'
																			";
														$ProdNameQueryStatement				= mysql_query($ProdNameQuery);
														while($ProdNameQueryStatementData	= mysql_fetch_array($ProdNameQueryStatement)) {
															$PRODUCTNAME_NEW   				= $ProdNameQueryStatementData['PRODUCTNAME'];
															
														}
									 	
										
											$getModuleQuery	= "
																				SELECT 	
																							pu.PACKINGNAMEID,
																							pu.QID,
																							pu.WTID
																				FROM 	
																						fna_packingunit pu
																				WHERE	PACKINGUNITID ='".$packingUnit[$k]."' 
																				
																			 "; 
												$getModuleStatement				= mysql_query($getModuleQuery);
												while($getModuleStatementData	= mysql_fetch_array($getModuleStatement)) {
													$PACKINGNAMEID 				= $getModuleStatementData['PACKINGNAMEID'];
													$QID 						= $getModuleStatementData['QID'];
													$WTID 						= $getModuleStatementData['WTID'];
													
													
												$packingNameQuery = "
																			SELECT
																					PACKINGNAMEID,
																					PACKINGNAME
																			FROM
																					fna_packingname 
																					WHERE PACKINGNAMEID = '".$PACKINGNAMEID."'
																			";
														$packingNameQueryStatement				= mysql_query($packingNameQuery);
														while($packingNameQueryStatementData	= mysql_fetch_array($packingNameQueryStatement)) {
															$PACKINGNAMEID_NEW   		= $packingNameQueryStatementData['PACKINGNAMEID'];
															$PACKINGNAME_NEW   			= $packingNameQueryStatementData['PACKINGNAME'];
															
														}
														
														$QidQuery = "
																			SELECT
																					QVALUE
																			FROM
																					fna_quantity 
																					WHERE QID = '".$QID."'
																			";
														$QidQueryStatement				= mysql_query($QidQuery);
														while($QidQueryStatementData	= mysql_fetch_array($QidQueryStatement)) {
															$QVALUE   		= $QidQueryStatementData['QVALUE'];
															
														}
														
														$wtidQuery = "
																			SELECT
																					WNAME
																			FROM
																					fna_weight 
																					WHERE WTID = '".$WTID."'
																			";
														$wtidQueryStatement				= mysql_query($wtidQuery);
														while($wtidQueryStatementData	= mysql_fetch_array($wtidQueryStatement)) {
															$WNAME   		= $wtidQueryStatementData['WNAME'];
															
														}
												
												
														$packingUnitList  = $PACKINGNAME_NEW.", ".$QVALUE.",".$WNAME;
											}
										//----------------------------Packing Unit Name End --------------------------------------------------------
										
										//-----------------------------------------Update Daily Income Expanse Table Start------------------------------------------------
										
										
										$INEX_FLAG	 			= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_daily_income_expanse"));
										$MAXINEX_FLAG	 		= $INEX_FLAG['MAX(FLAG)'];
										$NOW_MAXINEX_FLAG	 	= $MAXINEX_FLAG + 1;
										
										$LABNAME_QRY 			= mysql_fetch_array(mysql_query("SELECT LABOURNAME FROM fna_labour WHERE LABOURID = '".$LABOURID."'"));
										$LABOURNAME				= $LABNAME_QRY['LABOURNAME'];
										$EX_Quantity			= $globalLabourTotalBillAmount / $LOADPRICE ;
										$NOW_DESCRIPTION		= 'LOAD : Labour Bill Payment to  '.$LABOURNAME . ' , '. $CATEGORYTYPENAME_NEW . ' , '.$PRODUCTNAME_NEW.' , ' .$packingUnitList.' , '.$quantity[$k].' * '.$LOADPRICE.' = '.$TOTBILLAMOUNT.'  ';
										
		
										$insertDailyInExQuery = "
																INSERT INTO 
																				fna_daily_income_expanse
																											(
																												ENTRYSERIALNOID,
																												PROJECTID,
																												SUBPROJECTID,
																												DATE,
																												EXPHID,
																												EXPANSE,
																												DESCRIPTION,
																												FLAG,
																												STATUS,
																												ENTDATE,
																												ENTTIME,
																												USERID
																											) 
																									VALUES
																											(
																												'".$MaxEntrySlNo."',
																												'".$PROJECTID."',
																												'".$SUBPROJECTID."',
																												'".$ENTRYDATE."',
																												'155',
																												'".$TOTBILLAMOUNT."',
																												'".$NOW_DESCRIPTION."',
																												'".$NOW_MAXINEX_FLAG."',
																												'Payment',
																												'".$entDate."',
																												'".$entTime."',
																												'".$userId."'
																											)
																	";
												
												
												$insertDailyInExQueryStatement = mysql_query($insertDailyInExQuery);
							
							//----------------------------------------------------Update Daily Income Expanse Table End ------------------------------------------------
											
							$k++;
						}
					// Upadate FNA Labour Bill Table Start
					$MAXLABFLAG = mysql_fetch_array(mysql_query("SELECT MAX(LABOURFLAG) FROM fna_labourbill WHERE LABOURID = '".$LABOURID."'"));
					$MAXLABOUR_FLAG = $MAXLABFLAG['MAX(LABOURFLAG)'];
					$NOW_MAXLAB_FLAG = $MAXLABOUR_FLAG + 1;
					$BAL_AMOUNT = mysql_fetch_array(mysql_query("SELECT BALANCEAMOUNT FROM fna_labourbill WHERE LABOURID = '".$LABOURID."' AND LABOURFLAG = '".$MAXLABOUR_FLAG."'"));
					$LAB_BAL_AMOUNT = $BAL_AMOUNT['BALANCEAMOUNT'];
					if(($MAXLABOUR_FLAG == 0) or ($MAXLABOUR_FLAG ='')){
						$NOW_LAB_BALAMOUNT = $globalLabourTotalBillAmount ;
					}else{
						$NOW_LAB_BALAMOUNT = $LAB_BAL_AMOUNT + $globalLabourTotalBillAmount ;
					}
					$insertLabourBillQuery = "
											INSERT INTO 
														fna_labourbill
																(
																	ENTRYSERIALNOID,
																	PROJECTID,
																	SUBPROJECTID,
																	LABOURID,
																	PARTYID,
																	PRODUCTLOADUNLOADID,
																	BILLAMOUNT,
																	PAYMENTAMOUNT,
																	BALANCEAMOUNT,
																	LABOURFLAG,
																	ENTRYDATE,
																	STATUS,
																	ENTDATE,
																	ENTTIME,
																	USERID
																) 
														VALUES
																(
																	'".$MaxEntrySlNo."',
																	'".$PROJECTID."',
																	'".$SUBPROJECTID."',
																	'".$LABOURID."',
																	'".$PARTYID."',
																	'".$loadCtId."',
																	'".$globalLabourTotalBillAmount."',
																	'0',
																	'".$NOW_LAB_BALAMOUNT."',
																	'".$NOW_MAXLAB_FLAG."',
																	'".$ENTRYDATE."',
																	'Load',
																	'".$entDate."',
																	'".$entTime."',
																	'".$userId."'
																)
						"; 
						
						
						$insertLabourBillQueryStatement = mysql_query($insertLabourBillQuery);
						
					// Upadate FNA Labour Bill Table End
					
						
						//------------------------------------------------Labour Bill Direct Entry Start---------------------------------------------------------------
					
					
					// Upadate FNA Labour Bill Table Start
						$MAXLABFLAG = mysql_fetch_array(mysql_query("SELECT MAX(LABOURFLAG) FROM fna_labourbill WHERE LABOURID = '".$LABOURID."'"));
						$MAXLABOUR_FLAG = $MAXLABFLAG['MAX(LABOURFLAG)'];
						$NOW_MAXLAB_FLAG = $MAXLABOUR_FLAG + 1;
						$BAL_AMOUNT = mysql_fetch_array(mysql_query("SELECT BALANCEAMOUNT FROM fna_labourbill WHERE LABOURID = '".$LABOURID."' AND LABOURFLAG = '".$MAXLABOUR_FLAG."'"));
						$LAB_BAL_AMOUNT = $BAL_AMOUNT['BALANCEAMOUNT'];
						
						if(($MAXLABOUR_FLAG == 0) or ($MAXLABOUR_FLAG ='')){
							$NOW_LAB_BALAMOUNT = $globalLabourTotalBillAmount ;
						}else{
							$NOW_LAB_BALAMOUNT = $LAB_BAL_AMOUNT - $globalLabourTotalBillAmount ;
						}
							
												
							$insertLabourBillQueryPayment = "
																INSERT INTO 
																			fna_labourbill
																					(
																						ENTRYSERIALNOID,
																						PROJECTID,
																						SUBPROJECTID,
																						LABOURID,
																						EXPHID,
																						PARTYID,
																						PRODUCTLOADUNLOADID,
																						BILLAMOUNT,
																						PAYMENTAMOUNT,
																						BALANCEAMOUNT,
																						LABOURFLAG,
																						ENTRYDATE,
																						STATUS,
																						ENTDATE,
																						ENTTIME,
																						USERID
																					) 
																			VALUES
																					(
																						'".$MaxEntrySlNo."',
																						'".$PROJECTID."',
																						'".$SUBPROJECTID."',
																						'".$LABOURID."',
																						'155',
																						'".$PARTYID."',
																						'".$loadCtId."',
																						'0',
																						'".$globalLabourTotalBillAmount."',
																						'".$NOW_LAB_BALAMOUNT."',
																						'".$NOW_MAXLAB_FLAG."',
																						'".$ENTRYDATE."',
																						'Load',
																						'".$entDate."',
																						'".$entTime."',
																						'".$userId."'
						
																					)
																				"; 
								
								
								$insertLabourBillQueryStatementPayment = mysql_query($insertLabourBillQueryPayment);
							
							if($insertLabourBillQueryStatementPayment){
								
									$insertQueryExpLabBill = "
														INSERT INTO 
																	fna_expanse
																					(
																						ENTRYSERIALNOID,
																						PROJECTID,
																						SUBPROJECTID,
																						PARTYID,
																						EXPHID,
																						EXPSUBHID,
																						AMOUNT,
																						EXPDATE,
																						DESCRIPTION,
																						STATUS,
																						ENTDATE,
																						ENTTIME,
																						USERID
																					) 
																			VALUES
																					(
																						'".$MaxEntrySlNo."',
																						'".$PROJECTID."',
																						'".$SUBPROJECTID."',
																						'".$PARTYID."',
																						'155',
																						'0',
																						'".$globalLabourTotalBillAmount."',
																						'".$ENTRYDATE."',
																						'Labour Bill Payment....',
																						'Payment',
																						'".$entDate."',
																						'".$entTime."',
																						'".$userId."'
																					)
													";
									$insertQueryExpStatementLabBill = mysql_query($insertQueryExpLabBill);
									
									//Update FNA Balance Table Start
									$BALANCE_FLAG 			= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_balance"));
									$MAXBALANCE_FLAG 		= $BALANCE_FLAG['MAX(FLAG)'];
									$NOW_MAXBALANCE_FLAG 	= $MAXBALANCE_FLAG + 1;
									
									$BALANCE_QUERY		 	= mysql_fetch_array(mysql_query("SELECT * FROM fna_balance WHERE FLAG = '".$MAXBALANCE_FLAG."'"));
									$INCOME_AMOUNT 			= $BALANCE_QUERY['INCOME'];
									$EXPANSE_AMOUNT			= $BALANCE_QUERY['EXPANSE'];
									$BALANCE_AMOUNT 		= $BALANCE_QUERY['BALANCE'];
									
									$NOW_BALANCE_AMOUNT		= $BALANCE_AMOUNT - $globalLabourTotalBillAmount ;
									
									$insertBalanceQuery = "
															INSERT INTO 
																		fna_balance
																				(
																					ENTRYSERIALNOID,
																					PROJECTID,
																					SUBPROJECTID,
																					EXPANSE,
																					BALANCE,
																					FLAG,
																					BALDATE,
																					STATUS,
																					ENTDATE,
																					ENTTIME,
																					USERID
																				) 
																		VALUES
																				(
																					'".$MaxEntrySlNo."',
																					'".$PROJECTID."',
																					'".$SUBPROJECTID."',
																					'".$globalLabourTotalBillAmount."',
																					'".$NOW_BALANCE_AMOUNT."',
																					'".$NOW_MAXBALANCE_FLAG."',
																					'".$ENTRYDATE."',
																					'Payment',
																					'".$entDate."',
																					'".$entTime."',
																					'".$userId."'
																				)
										";
										
										
										$insertBalanceQueryStatement = mysql_query($insertBalanceQuery);
							}
									//Update FNA Balance Table End
									
							//------------------------------------------------Labour Bill Direct Entry End  ---------------------------------------------------------------
						
					} else {
						$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
					}
					
				
				}
			}else{
				$msg = "<span class='errorMsg'>Sorry, Please Enter  Session Entry First....!</span>";
			}
		return $msg;
			
			
			
			
		}
		// Insert Load Information  End
		
		// Insert Load Information Start
		function insertUnloadToPCInfo($userId){
			
			$PROJECTID 			= $_REQUEST["PROJECTID"];
			$SUBPROJECTID		= $_REQUEST["SUBPROJECTID"];
			
			
			$LABOURID 			= $_REQUEST["LABOURID"];
			$PARTYID 			= $_REQUEST["PARTYID"];
			$ENTRYDATE	 		= insertDateMySQlFormat($_REQUEST["ENTRYDATE"]);
			
			
			$PRODCATTYPEID		= $_REQUEST["PRODCATTYPEID"];
			$PRODUCTID 			= $_REQUEST["PRODUCTID"];
			$quantity	 		= $_REQUEST["quantity"];
			$CHALLANNO 			= $_REQUEST["CHALLANNO"];
			$packingUnit		= $_REQUEST["packingUnit"];
			$CHID		 		= $_REQUEST["CHID"];
			//$pocket		 		= $_REQUEST["pocket"];
			$EXTRALABBILL 		= $_REQUEST["EXTRALABBILL"];
			
			$TOTAL_PRODUCT_LIST	= $_REQUEST["TOTAL_PRODUCT_LIST_PC"];
			
			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
			$WorkType			= 'Load';
			
			$MaxTypeFlag_Query	= mysql_fetch_array(mysql_query("Select MAX(PRODCATTYPEFLAG) from fna_session WHERE PROJECTID = '".$PROJECTID."' AND SUBPROJECTID = '".$SUBPROJECTID."' AND PRODCATTYPEID = '".$PRODCATTYPEID."' AND WORKTYPE = '".$WorkType."' AND YEARCOMPLETE = 'No'"));
			$MaxProdCatTypeFlag	= $MaxTypeFlag_Query['MAX(PRODCATTYPEFLAG)'];
			
			
			$Query		= "
									SELECT 
											*
									FROM 
											fna_session
									WHERE '".$ENTRYDATE."' 	BETWEEN STARTDATE AND ENDDATE
										AND PROJECTID = '".$PROJECTID."'
										AND SUBPROJECTID = '".$SUBPROJECTID."'
										AND PRODCATTYPEID = '".$PRODCATTYPEID."'
										AND WORKTYPE = '".$WorkType."'
										AND PRODCATTYPEFLAG = '".$MaxProdCatTypeFlag."'
										AND YEARCOMPLETE = 'No'
								";
			$QueryStatement	= mysql_query($Query);
			if(mysql_num_rows($QueryStatement)>0) {
				
				$EntrySerial_Query_Flag = mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_entryserialno"));
				$MaxFlagEntrySl			= $EntrySerial_Query_Flag['MAX(FLAG)'];
				
				$EntrySerial_Query_No	= mysql_fetch_array(mysql_query("SELECT MAX(ENTRYSERIALNOID) FROM fna_entryserialno"));
				$MaxEntrySlNo			= $EntrySerial_Query_No['MAX(ENTRYSERIALNOID)'] + 1;
		
		
				$insertQueryEntrySl = "
										INSERT INTO 
													fna_entryserialno
																	(
																		ENTRYSERIALNO,
																		PROJECTID,
																		SUBPROJECTID,
																		ENTRYDATE,
																		FLAG,
																		STATUS,
																		ENTDATE,
																		ENTTIME,
																		USERID
																	) 
															VALUES
																	(
																		'".$MaxEntrySlNo."',
																		'".$PROJECTID."',
																		'".$SUBPROJECTID."',
																		'".$ENTRYDATE."',
																		'".$MaxFlagEntrySl."',
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									";
				$insertQueryEntrySlStatement = mysql_query($insertQueryEntrySl);
				
				
				
				$CheckQuery		= mysql_fetch_array(mysql_query("SELECT * FROM fna_session WHERE PROJECTID = '".$PROJECTID."' AND SUBPROJECTID = '".$SUBPROJECTID."' AND PRODCATTYPEID = '".$PRODCATTYPEID."' AND WORKTYPE = '".$WorkType."' AND PRODCATTYPEFLAG = '".$MaxProdCatTypeFlag."' AND YEARCOMPLETE = 'No' "));
				$StartDateQry	= $CheckQuery['STARTDATE'];
				$EndDateQry		= $CheckQuery['ENDDATE'];
				
				$start 	= strtotime($ENTRYDATE);
				$end 	= strtotime($EndDateQry);
				
				$days_between = ceil(abs($end - $start) / 86400);	
				
					if($days_between > 15){
				
							$MAXRECNO = mysql_fetch_array(mysql_query("SELECT MAX(IFNULL(RECEIVENUMBER,0)) FROM fna_productloadunload "));
							$maxNo = $MAXRECNO['MAX(IFNULL(RECEIVENUMBER,0))'];
							if($maxNo == 0){
									$nowMAXRECNO = $maxNo + 1;
								}else{
									$nowMAXRECNO = $maxNo + 1;	
								}
							
							
							$k = 0;
							for($i = 1; $i < $TOTAL_PRODUCT_LIST; $i++ ){
								
								$globalLabourTotalBillAmount = 0;
								$MAXPCFLAG_QRY		 	= mysql_fetch_array(mysql_query("SELECT MAX(PARTYFLAG) FROM fna_unloadtopc WHERE PARTYID = '".$PARTYID."'"));
								$MAXPARTY_FLAG 			= $MAXPCFLAG_QRY['MAX(PARTYFLAG)'];
								$NOW_MAXPARTY_FLAG 		= $MAXPARTY_FLAG + 1;
								$PARTY_TOT_QNTY_QRY		= mysql_fetch_array(mysql_query("SELECT PARTYTOTQNTY FROM fna_unloadtopc WHERE PARTYID = '".$PARTYID."' AND PARTYFLAG = '".$MAXPARTY_FLAG."'"));
								$PARTYTOTQNTY	 		= $PARTY_TOT_QNTY_QRY['PARTYTOTQNTY'];
								$NOW_PARTYTOTQNTY		= $PARTYTOTQNTY + $quantity[$k] ; 
								
								$insertUnloadtopcQuery = "
														INSERT INTO 
																	fna_unloadtopc
																				(
																					ENTRYSERIALNOID,
																					PROJECTID,
																					SUBPROJECTID,
																					PARTYID,
																					PRODCATTYPEID,
																					PACKINGUNITID,
																					PRODUCTID,
																					CHALLANNO,
																					LOAD_QUANTITY,
																					PARTYTOTQNTY,
																					PARTYFLAG,
																					STATUS,
																					ENTDATE,
																					ENTTIME,
																					USERID
																				) 
																		VALUES
																				(
																					'".$MaxEntrySlNo."',
																					'".$PROJECTID."',
																					'".$SUBPROJECTID."',
																					'".$PARTYID."',
																					'".$PRODCATTYPEID."',
																					'".$packingUnit[$k]."',
																					'".$PRODUCTID[$k]."',
																					'".$CHALLANNO[$k]."',
																					'".$quantity[$k]."',
																					'".$NOW_PARTYTOTQNTY."',
																					'".$NOW_MAXPARTY_FLAG."',
																					'Active',
																					'".$entDate."',
																					'".$entTime."',
																					'".$userId."'
																				)
										"; 
										
										
										$insertUnloadtopcQueryStatement = mysql_query($insertUnloadtopcQuery);
										if($insertUnloadtopcQueryStatement){
											$msg = "<span class='validMsg'>Unload To PC Information [$PARTYID] added sucessfully</span>";
										}else{
											$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
											break;
											}
											
											
											
											//Update Labour Work History Table Start
											$LABOURIDQUERY  =mysql_fetch_array(mysql_query("SELECT LABCONTACTID FROM fna_labourcontact WHERE LABOURID = '".$LABOURID."'"));
											$LABCONTACTID = $LABOURIDQUERY['LABCONTACTID'];
											$QUERYLOADPRICE = mysql_fetch_array(mysql_query("SELECT LOADPRICE FROM fna_labourcontact_bkdn WHERE LABCONTACTID = '".$LABCONTACTID."' AND CHAMBERIDTO = '".$CHID[$k]."' and CHAMBERIDFROM = '' and PACKINGUNITID = '".$packingUnit[$k]."'"));
											$LOADPRICE = $QUERYLOADPRICE['LOADPRICE'];
											$TOTBILLAMOUNT = ($quantity[$k] * $LOADPRICE) + $EXTRALABBILL[$k] ;
											$globalLabourTotalBillAmount = $globalLabourTotalBillAmount + $TOTBILLAMOUNT ;
											
											
											$insertLabWorkHistQuery = "
																INSERT INTO 
																			fna_labourworkhistory
																						(
																							ENTRYSERIALNOID,
																							PROJECTID,
																							SUBPROJECTID,
																							LABOURID,
																							PARTYID,
																							PRODUCTLOADUNLOADBKDNID,
																							PRODCATTYPEID,
																							PRODUCTID,
																							PACKINGUNITID,
																							QUANTITY,
																							CHID,
																							BILLAMOUNT,
																							EXTRALABBILL,
																							TOTBILLAMOUNT,
																							RECEIVENUMBER,
																							WORKTYPEFLAG,
																							STATUS,
																							ENTDATE,
																							ENTTIME,
																							USERID
																						) 
																				VALUES
																						(
																							'".$MaxEntrySlNo."',
																							'".$PROJECTID."',
																							'".$SUBPROJECTID."',
																							'".$LABOURID."',
																							'".$PARTYID."',
																							'',
																							'".$PRODCATTYPEID."',
																							'".$PRODUCTID[$k]."',
																							'".$packingUnit[$k]."',
																							'".$quantity[$k]."',
																							'".$CHID[$k]."',
																							'".$LOADPRICE."',
																							'".$EXTRALABBILL[$k]."',
																							'".$TOTBILLAMOUNT."',
																							'".$nowMAXRECNO."',
																							'Load',
																							'Active',
																							'".$ENTRYDATE."',
																							'".$entTime."',
																							'".$userId."'
																						)
										"; 
										
										
										$insertLabWorkHistQueryStatement = mysql_query($insertLabWorkHistQuery);
										
										//Update Labour Work History Table End
										
												
							$k++;
						}
					// Upadate FNA Labour Bill Table Start
					$MAXLABFLAG = mysql_fetch_array(mysql_query("SELECT MAX(LABOURFLAG) FROM fna_labourbill WHERE LABOURID = '".$LABOURID."'"));
					$MAXLABOUR_FLAG = $MAXLABFLAG['MAX(LABOURFLAG)'];
					$NOW_MAXLAB_FLAG = $MAXLABOUR_FLAG + 1;
					$BAL_AMOUNT = mysql_fetch_array(mysql_query("SELECT BALANCEAMOUNT FROM fna_labourbill WHERE LABOURID = '".$LABOURID."' AND LABOURFLAG = '".$MAXLABOUR_FLAG."'"));
					$LAB_BAL_AMOUNT = $BAL_AMOUNT['BALANCEAMOUNT'];
					if(($MAXLABOUR_FLAG == 0) or ($MAXLABOUR_FLAG ='')){
						$NOW_LAB_BALAMOUNT = $globalLabourTotalBillAmount ;
					}else{
						$NOW_LAB_BALAMOUNT = $LAB_BAL_AMOUNT + $globalLabourTotalBillAmount ;
					}
					$insertLabourBillQuery = "
											INSERT INTO 
														fna_labourbill
																(
																	ENTRYSERIALNOID,
																	PROJECTID,
																	SUBPROJECTID,
																	LABOURID,
																	PARTYID,
																	PRODUCTLOADUNLOADID,
																	BILLAMOUNT,
																	PAYMENTAMOUNT,
																	BALANCEAMOUNT,
																	LABOURFLAG,
																	ENTRYDATE,
																	STATUS,
																	ENTDATE,
																	ENTTIME,
																	USERID
																) 
														VALUES
																(
																	'".$MaxEntrySlNo."',
																	'".$PROJECTID."',
																	'".$SUBPROJECTID."',
																	'".$LABOURID."',
																	'".$PARTYID."',
																	'',
																	'".$globalLabourTotalBillAmount."',
																	'0',
																	'".$NOW_LAB_BALAMOUNT."',
																	'".$NOW_MAXLAB_FLAG."',
																	'".$ENTRYDATE."',
																	'Active',
																	'".$entDate."',
																	'".$entTime."',
																	'".$userId."'
																)
						"; 
						
						
						$insertLabourBillQueryStatement = mysql_query($insertLabourBillQuery);
						
					// Upadate FNA Labour Bill Table End
					
					
					
					}
				}else{
					$msg = "<span class='errorMsg'>Sorry, Please Enter  Session Entry First....!</span>";
				}
		return $msg;
			
			
			
			
		}
		// Insert Load Information  End
		
		// Insert UnLoad Information Start
		function insertUnLoadInfo($userId){
			
			$PROJECTID 			= $_REQUEST["PROJECTID"];
			$SUBPROJECTID		= $_REQUEST["SUBPROJECTID"];
			
			$LABOURID 			= $_REQUEST["LABOURID"];
			$PARTYID 			= $_REQUEST["PARTYID"];
			$ENTRYDATE	 		= insertDateMySQlFormat($_REQUEST["ENTRYDATE"]);
			
			
			$PRODCATTYPEID		= $_REQUEST["PRODCATTYPEID"];
			$PRODUCTID 			= $_REQUEST["PRODUCTID"];
			$quantity	 		= $_REQUEST["quantity"];
			$UnloadBasta 		= $_REQUEST["quantity"];
			$packingUnit		= $_REQUEST["packingUnit"];
			$CHID		 		= $_REQUEST["CHID"];
			//$pocket		 		= $_REQUEST["pocket"];
			$EXTRALABBILL 		= $_REQUEST["EXTRALABBILL"];
			$TOTAL_PRODUCT_LIST	= $_REQUEST["TOTAL_PRODUCT_LIST"];
			
			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
			$WorkType			= 'Load';
			
			$MaxTypeFlag_Query	= mysql_fetch_array(mysql_query("Select MAX(PRODCATTYPEFLAG) from fna_session WHERE PROJECTID = '".$PROJECTID."' AND SUBPROJECTID = '".$SUBPROJECTID."' AND PRODCATTYPEID = '".$PRODCATTYPEID."' "));
			$MaxProdCatTypeFlag	= $MaxTypeFlag_Query['MAX(PRODCATTYPEFLAG)'];
			
				
			$Query		= "
									SELECT 
											*
									FROM 
											fna_session
									WHERE '".$ENTRYDATE."' 	BETWEEN STARTDATE AND ENDDATE
										AND SUBPROJECTID = '".$SUBPROJECTID."'
										AND PRODCATTYPEID = '".$PRODCATTYPEID."'
										AND PRODCATTYPEFLAG = '".$MaxProdCatTypeFlag."'
								";
			$QueryStatement	= mysql_query($Query);
			if(mysql_num_rows($QueryStatement)>0) {
				
				$EntrySerial_Query_Flag = mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_entryserialno"));
				$MaxFlagEntrySl			= $EntrySerial_Query_Flag['MAX(FLAG)'];
				
				$EntrySerial_Query_No	= mysql_fetch_array(mysql_query("SELECT MAX(ENTRYSERIALNOID) FROM fna_entryserialno"));
				$MaxEntrySlNo			= $EntrySerial_Query_No['MAX(ENTRYSERIALNOID)'] + 1;
		
		
				$insertQueryEntrySl = "
										INSERT INTO 
													fna_entryserialno
																	(
																		ENTRYSERIALNO,
																		PROJECTID,
																		SUBPROJECTID,
																		ENTRYDATE,
																		FLAG,
																		STATUS,
																		ENTDATE,
																		ENTTIME,
																		USERID
																	) 
															VALUES
																	(
																		'".$MaxEntrySlNo."',
																		'".$PROJECTID."',
																		'".$SUBPROJECTID."',
																		'".$ENTRYDATE."',
																		'".$MaxFlagEntrySl."',
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									";
				$insertQueryEntrySlStatement = mysql_query($insertQueryEntrySl);
				
				
			for($p = 0; $p < $TOTAL_PRODUCT_LIST; $p++ ){
				
				
			
				$PARTY_FLAG_QUERY 	= mysql_fetch_array(mysql_query("SELECT MAX(PARTYFLAG) FROM fna_productstock WHERE PARTYID = '".$PARTYID."' AND PRODUCTID = '".$PRODUCTID[$p]."' "));
				$MaxPartyFlag 		= $PARTY_FLAG_QUERY['MAX(PARTYFLAG)'];
				
				
				$PRODUCT_FLAG_QUERY = mysql_fetch_array(mysql_query("SELECT MAX(PRODTYPEFLAG) FROM fna_productstock WHERE PARTYID = '".$PARTYID."' AND PRODUCTID = '".$PRODUCTID[$p]."'"));
				$MaxProductFlag 	= $PRODUCT_FLAG_QUERY['MAX(PRODTYPEFLAG)'];
				
				$queryCheck = mysql_fetch_array(mysql_query("SELECT	TOTQUANTITY, BALBASTA FROM fna_productstock WHERE PARTYID = '".$PARTYID."' AND PRODUCTID = '".$PRODUCTID[$p]."'  AND PARTYFLAG = '".$MaxPartyFlag."' AND PRODTYPEFLAG = '".$MaxProductFlag."'"));
				
				$TotalQnty = $queryCheck['TOTQUANTITY'];
				$BalBasta  = $queryCheck['BALBASTA'];
				
				$queryCheckProdName = mysql_fetch_array(mysql_query("SELECT	* FROM fna_product WHERE PRODUCTID = '".$PRODUCTID[$p]."'"));
				$ProdName = $queryCheckProdName['PRODUCTNAME'];
					
				
					if($TotalQnty >= $quantity[$p] or $BalBasta >= $UnloadBasta[$p]){
						$check = true;
					}else
					{
						$check =false;
						break;
						$msg = "<span class='errorMsg'>Sorry! Product Quantity [$quantity[$p], $ProdName ] is not Sufficient!</span>";
					}
									
			}//for($p = 1; $p < $TOTAL_PRODUCT_LIST; $p++ )
			if($check){
				
			
				
				//This section work for multiple entry within 5 mints start.
				$getEntTimeResult = mysql_fetch_array(mysql_query("SELECT MAX(ENTTIME) FROM fna_productloadunload where PARTYID='".$PARTYID."' AND ENTDATE='".$entDate."'"));
				$getEntTime = $getEntTimeResult['MAX(ENTTIME)'];
				if(empty($getEntTime)){
					$duration = 100;
				}else{
					$exp = explode(" ",$getEntTime);
					$assigned_time = $exp[0];
					$completed_time = date('H:i:s');   
				
					$d1 = new DateTime($assigned_time);
					$d2 = new DateTime($completed_time);
					$interval = $d2->diff($d1);
					
					$duration =  $interval->format('%I');
				}
				//This section work for multiple entry within 5 mints End.
				if($duration > 5){
					// Insert Here
				}else{
					// Error Message generate here.
				}
				
				$MAXDELCHALLNO = mysql_fetch_array(mysql_query("SELECT MAX(IFNULL(DELIVERYCHALLANNUMBER,0)) FROM fna_productloadunload "));
				$maxNo = $MAXDELCHALLNO['MAX(IFNULL(DELIVERYCHALLANNUMBER,0))'];
				if($maxNo == 0 or $maxNo =''){
						$nowMAXDELCHALLNO = $maxNo + 1;
					}else{
						$nowMAXDELCHALLNO = $maxNo + 1;	
					}
					
					$maxFlagQry			= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_productloadunload"));
					$maxFlag			= $maxFlagQry['MAX(FLAG)'];
					$Now_maxFlag		= $maxFlag + 1;
					$insertQuery = "
									INSERT INTO 
												fna_productloadunload
																	(
																		ENTRYSERIALNOID,
																		PROJECTID,
																		SUBPROJECTID,
																		PARTYID,
																		LABOURID,
																		ENTRYDATE,
																		DELIVERYCHALLANNUMBER,
																		FLAG,
																		STATUS,
																		ENTDATE,
																		ENTTIME,
																		USERID
																	) 
															VALUES
																	(
																		'".$MaxEntrySlNo."',
																		'".$PROJECTID."',
																		'".$SUBPROJECTID."',
																		'".$PARTYID."',
																		'".$LABOURID."',
																		'".$ENTRYDATE."',
																		'".$nowMAXDELCHALLNO."',
																		'".$Now_maxFlag."',
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									"; 
				if(mysql_query($insertQuery)){
					
					$loadCtId = mysql_insert_id();
					
					
					$k = 0;
					$globalLabourTotalBillAmount = 0;
					$globalPartyTotalBillAmount = 0;
					
					for($i = 1; $i < $TOTAL_PRODUCT_LIST; $i++ ){
						
							$insertbkdnQuery = "
										INSERT INTO 
													fna_productloadunloadbkdn
																	(
																		ENTRYSERIALNOID,
																		PRODUCTLOADUNLOADID,
																		PRODCATTYPEID,
																		PRODUCTID,
																		PACKINGUNITID,
																		QUANTITY,
																		CHID,
																		POCKET,
																		STATUS,
																		ENTDATE,
																		ENTTIME,
																		USERID
																	) 
															VALUES
																	(
																		'".$MaxEntrySlNo."',
																		'".$loadCtId."',
																		'".$PRODCATTYPEID."',
																		'".$PRODUCTID[$k]."',
																		'".$packingUnit[$k]."',
																		'".$quantity[$k]."',
																		'".$CHID[$k]."',
																		'',
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									"; 
									
									
									$insertbkdnQueryStatement = mysql_query($insertbkdnQuery);
									if($insertbkdnQueryStatement){
										$msg = "<span class='validMsg'>Labour Information [$loadCtId] added sucessfully</span>";
									}else{
										$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
										break;
										$msg = "<span class='errorMsg'>Sorry! Product Quantity [$quantity[$k], $PRODUCTID[$k] ] is not Sufficient!</span>";
										}
										
										//Update Product Stock table Start
										
										$loadUnloadBkdnIdCtId = mysql_insert_id();
									 	
										$partyFlag = mysql_fetch_array(mysql_query("SELECT MAX(IFNULL(PARTYFLAG,0)) FROM fna_productstock WHERE PARTYID = '".$PARTYID."'"));
										$MAXpartyFlag = $partyFlag['MAX(IFNULL(PARTYFLAG,0))'];
										$NowMAXpartyFlag = $MAXpartyFlag + 1;
										
										$prodCatTypeFlag = mysql_fetch_array(mysql_query("SELECT MAX(IFNULL(PRODCATTYPEFLAG,0)) FROM fna_productstock WHERE PARTYID = '".$PARTYID."' AND PRODCATTYPEID = '".$PRODCATTYPEID."'"));
										$MAXprodCatTypeFlag = $prodCatTypeFlag['MAX(IFNULL(PRODCATTYPEFLAG,0))'];
										$NowMaxprodCatTypeFlag = $MAXprodCatTypeFlag + 1;
										
										$prodTypeFlag = mysql_fetch_array(mysql_query("SELECT MAX(PRODTYPEFLAG) FROM fna_productstock WHERE PARTYID = '".$PARTYID."' AND PRODUCTID = '".$PRODUCTID[$k]."'"));
										
										$MAXprodTypeFlag = $prodTypeFlag['MAX(PRODTYPEFLAG)'];
										if ($MAXprodTypeFlag == ''){
												//$MAXprodTypeFlag = 0;
												$NowTotQnty 	= $quantity[$k];
												$NowTotBalBasta = $UnloadBasta[$k];
											}else
											{
												$prodQnty = mysql_fetch_array(mysql_query("SELECT TOTQUANTITY, BALBASTA, AVGUNIT, BALKG FROM fna_productstock WHERE PARTYID = '".$PARTYID."' AND PRODUCTID = '".$PRODUCTID[$k]."' AND PRODTYPEFLAG = '".$MAXprodTypeFlag."'"));
												$TotQnty 		= $prodQnty['TOTQUANTITY'];
												$TotBalBasta 	= $prodQnty['BALBASTA'] ;
												$AVGUNIT	 	= $prodQnty['AVGUNIT'] ;
												$BALKG		 	= $prodQnty['BALKG'] ;
												if ($TotQnty >= $quantity[$k]){
														$NowTotQnty = $prodQnty['TOTQUANTITY'] - $quantity[$k];
														$NowTotBalBasta = $prodQnty['BALBASTA'] - $UnloadBasta[$k];
													}else
													{
														$msg = "<span class='errorMsg'>Sorry! Product Quantity is not Sufficient!</span>";
														
													}
												//$NowTotQnty = $prodQnty['TOTQUANTITY'] + $quantity[$k];
											}
												$NowMaxprodTypeFlag = $MAXprodTypeFlag + 1;
												
												$NowUnloadKG		= $UnloadBasta[$k] * $AVGUNIT ;
												$NowTotBalKG		= $BALKG - $NowUnloadKG ;
												$UNLOADUNIT			= $AVGUNIT ;
												$insertStockQuery = "
																	INSERT INTO 		
																				fna_productstock
																							(
																								ENTRYSERIALNOID,
																								PROJECTID,
																								SUBPROJECTID,
																								PRODUCTLOADUNLOADBKDNID,
																								PARTYID,
																								PRODCATTYPEID,
																								PRODUCTID,
																								QUANTITY,
																								TOTQUANTITY,
																								UNLOADBASTA,
																								BALBASTA,
																								UNLOADKG,
																								BALKG,
																								UNLOADUNIT,
																								AVGUNIT,
																								PARTYFLAG,
																								PRODCATTYPEFLAG,
																								PRODTYPEFLAG,
																								WORKTYPEFLAG,
																								STATUS,
																								ENTDATE,
																								ENTTIME,
																								USERID
																							) 
																					VALUES
																							(
																								'".$MaxEntrySlNo."',
																								'".$PROJECTID."',
																								'".$SUBPROJECTID."',
																								'".$loadUnloadBkdnIdCtId."',
																								'".$PARTYID."',
																								'".$PRODCATTYPEID."',
																								'".$PRODUCTID[$k]."',
																								'".$quantity[$k]."',
																								'".$NowTotQnty."',
																								'".$UnloadBasta[$k]."',
																								'".$NowTotBalBasta."',
																								'".$NowUnloadKG."',
																								'".$NowTotBalKG."',
																								'".$UNLOADUNIT."',
																								'".$AVGUNIT."',
																								'".$NowMAXpartyFlag."',
																								'".$NowMaxprodCatTypeFlag."',
																								'".$NowMaxprodTypeFlag."',
																								'Unload',
																								'Active',
																								'".$ENTRYDATE."',
																								'".$entTime."',
																								'".$userId."'
																							)
											"; 
											
											
											$insertStockQueryStatement = mysql_query($insertStockQuery);
									
									
										//Update Product Stock table End
										
										//Update Labour Work History Table Start
										
										$LABOURIDQUERY  =mysql_fetch_array(mysql_query("SELECT LABCONTACTID FROM fna_labourcontact WHERE LABOURID = '".$LABOURID."'"));
										$LABCONTACTID = $LABOURIDQUERY['LABCONTACTID'];
										
										$QUERYUNLOADPRICE = "
																			SELECT 	
																					 DISTINCT lc_bkdn.UNLOADPRICE
																			FROM 	
																					fna_labourcontact lc, fna_labourcontact_bkdn lc_bkdn
																			WHERE	lc.LABCONTACTID = lc_bkdn.LABCONTACTID
																			AND 	lc.LABOURID =".$LABOURID." 
																			AND 	lc_bkdn.PACKINGUNITID =".$packingUnit[$k]."
																			AND 	lc_bkdn.CHAMBERIDTO =".$CHID[$k]." 
																			AND 	lc_bkdn.CHAMBERIDFROM = '' 
																			ORDER BY 
																					lc_bkdn.PACKINGUNITID ASC
																			
																			";
														$QUERYUNLOADPRICEStatement					= mysql_query($QUERYUNLOADPRICE);
														while($QUERYUNLOADPRICEStatementData		= mysql_fetch_array($QUERYUNLOADPRICEStatement)) {
															$UNLOADPRICE	   						= $QUERYUNLOADPRICEStatementData['UNLOADPRICE'];
															
														}
														
										
										$TOTBILLAMOUNT = $quantity[$k] * $UNLOADPRICE + $EXTRALABBILL[$k];
										$globalLabourTotalBillAmount = $globalLabourTotalBillAmount + $TOTBILLAMOUNT ;
										
										
										$insertLabWorkHistQuery = "
															INSERT INTO 
																		fna_labourworkhistory
																					(
																						ENTRYSERIALNOID,
																						PROJECTID,
																						SUBPROJECTID,
																						LABOURID,
																						PARTYID,
																						PRODUCTLOADUNLOADBKDNID,
																						PRODCATTYPEID,
																						PRODUCTID,
																						PACKINGUNITID,
																						QUANTITY,
																						CHID,
																						POCKET,
																						BILLAMOUNT,
																						EXTRALABBILL,
																						TOTBILLAMOUNT,
																						DELIVERYCHALLANNUMBER,
																						WORKTYPEFLAG,
																						STATUS,
																						ENTDATE,
																						ENTTIME,
																						USERID
																					) 
																			VALUES
																					(
																						'".$MaxEntrySlNo."',
																						'".$PROJECTID."',
																						'".$SUBPROJECTID."',
																						'".$LABOURID."',
																						'".$PARTYID."',
																						'".$loadUnloadBkdnIdCtId."',
																						'".$PRODCATTYPEID."',
																						'".$PRODUCTID[$k]."',
																						'".$packingUnit[$k]."',
																						'".$quantity[$k]."',
																						'".$CHID[$k]."',
																						'',
																						'".$UNLOADPRICE."',
																						'".$EXTRALABBILL[$k]."',
																						'".$TOTBILLAMOUNT."',
																						'".$nowMAXDELCHALLNO."',
																						'Unload',
																						'Active',
																						'".$ENTRYDATE."',
																						'".$entTime."',
																						'".$userId."'
																					)
									";
									
									
									$insertLabWorkHistQueryStatement = mysql_query($insertLabWorkHistQuery);
									
									//Update Labour Work History Table End
									
									
										//----------------------------Packing Unit Name Start--------------------------------------------------------
										
										$ProCatNameQuery		= mysql_fetch_array(mysql_query("SELECT CATEGORYTYPENAME FROM fna_productcattype WHERE PROJECTID = '".$PROJECTID."' and SUBPROJECTID = '".$SUBPROJECTID."' and PRODCATTYPEID = '".$PRODCATTYPEID."'"));
										
										$CATEGORYTYPENAME_NEW	= $ProCatNameQuery['CATEGORYTYPENAME'];
										
										$ProdNameQuery = "
																			SELECT
																					PRODUCTNAME
																			FROM
																					fna_product 
																					WHERE PROJECTID = '".$PROJECTID."'
																					AND SUBPROJECTID = '".$SUBPROJECTID."'
																					AND PRODCATTYPEID = '".$PRODCATTYPEID."'
																					AND PRODUCTID = '".$PRODUCTID[$k]."'
																			";
														$ProdNameQueryStatement				= mysql_query($ProdNameQuery);
														while($ProdNameQueryStatementData	= mysql_fetch_array($ProdNameQueryStatement)) {
															$PRODUCTNAME_NEW   				= $ProdNameQueryStatementData['PRODUCTNAME'];
															
														}
									 	
										
												$getModuleQuery	= "
																					SELECT 	
																								pu.PACKINGNAMEID,
																								pu.QID,
																								pu.WTID
																					FROM 	
																							fna_packingunit pu
																					WHERE	PACKINGUNITID ='".$packingUnit[$k]."' 
																					
																				 "; 
													$getModuleStatement				= mysql_query($getModuleQuery);
													while($getModuleStatementData	= mysql_fetch_array($getModuleStatement)) {
														$PACKINGNAMEID 				= $getModuleStatementData['PACKINGNAMEID'];
														$QID 						= $getModuleStatementData['QID'];
														$WTID 						= $getModuleStatementData['WTID'];
														
												$packingNameQuery = "
																			SELECT
																					PACKINGNAMEID,
																					PACKINGNAME
																			FROM
																					fna_packingname 
																					WHERE PACKINGNAMEID = '".$PACKINGNAMEID."'
																			";
														$packingNameQueryStatement				= mysql_query($packingNameQuery);
														$PACKINGNAMEID_NEW	=	'';
														$PACKINGNAME_NEW	=	'';
														while($packingNameQueryStatementData	= mysql_fetch_array($packingNameQueryStatement)) {
															$PACKINGNAMEID_NEW   		= $packingNameQueryStatementData['PACKINGNAMEID'];
															$PACKINGNAME_NEW   			= $packingNameQueryStatementData['PACKINGNAME'];
															
														}
														
														$QidQuery = "
																			SELECT
																					QVALUE
																			FROM
																					fna_quantity 
																					WHERE QID = '".$QID."'
																			";
														$QidQueryStatement				= mysql_query($QidQuery);
														$QVALUE	=	'';
														while($QidQueryStatementData	= mysql_fetch_array($QidQueryStatement)) {
															$QVALUE   		= $QidQueryStatementData['QVALUE'];
															
														}
														
														$wtidQuery = "
																			SELECT
																					WNAME
																			FROM
																					fna_weight 
																					WHERE WTID = '".$WTID."'
																			";
														$wtidQueryStatement				= mysql_query($wtidQuery);
														$WNAME	=	'';
														while($wtidQueryStatementData	= mysql_fetch_array($wtidQueryStatement)) {
															$WNAME   		= $wtidQueryStatementData['WNAME'];
															
														}
												
												
														$packingUnitList  = $PACKINGNAME_NEW.", ".$QVALUE.",".$WNAME;
											}
										//----------------------------Packing Unit Name End --------------------------------------------------------
										
										//-----------------------------------------Update Daily Income Expanse Table Start------------------------------------------------
										
										
										$INEX_FLAG	 			= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_daily_income_expanse"));
										$MAXINEX_FLAG	 		= $INEX_FLAG['MAX(FLAG)'];
										$NOW_MAXINEX_FLAG	 	= $MAXINEX_FLAG + 1;
										
										$LABNAME_QRY 			= mysql_fetch_array(mysql_query("SELECT LABOURNAME FROM fna_labour WHERE LABOURID = '".$LABOURID."'"));
										$LABOURNAME				= $LABNAME_QRY['LABOURNAME'];
										$EX_Quantity			= $globalLabourTotalBillAmount / $UNLOADPRICE ;
										$NOW_DESCRIPTION		= 'UNLOAD : Labour Bill Payment to  '.$LABOURNAME . ' , '. $CATEGORYTYPENAME_NEW . ' , '.$PRODUCTNAME_NEW.' , ' .$packingUnitList.' , '.$quantity[$k].' * '.$UNLOADPRICE.' = '.$TOTBILLAMOUNT.'  ';
										
		
										$insertDailyInExQuery = "
																INSERT INTO 
																				fna_daily_income_expanse
																											(
																												ENTRYSERIALNOID,
																												PROJECTID,
																												SUBPROJECTID,
																												DATE,
																												EXPHID,
																												EXPANSE,
																												DESCRIPTION,
																												FLAG,
																												STATUS,
																												ENTDATE,
																												ENTTIME,
																												USERID
																											) 
																									VALUES
																											(
																												'".$MaxEntrySlNo."',
																												'".$PROJECTID."',
																												'".$SUBPROJECTID."',
																												'".$ENTRYDATE."',
																												'185',
																												'".$TOTBILLAMOUNT."',
																												'".$NOW_DESCRIPTION."',
																												'".$NOW_MAXINEX_FLAG."',
																												'Payment',
																												'".$entDate."',
																												'".$entTime."',
																												'".$userId."'
																											)
																	";
												
												
												$insertDailyInExQueryStatement = mysql_query($insertDailyInExQuery);
							
							//----------------------------------------------------Update Daily Income Expanse Table End ------------------------------------------------
									
											
										
						$k++;
					}
				// Upadate FNA Labour Bill Table Start
				$MAXLABFLAG = mysql_fetch_array(mysql_query("SELECT MAX(LABOURFLAG) FROM fna_labourbill WHERE LABOURID = '".$LABOURID."'"));
				$MAXLABOUR_FLAG = $MAXLABFLAG['MAX(LABOURFLAG)'];
				$NOW_MAXLAB_FLAG = $MAXLABOUR_FLAG + 1;
				$BAL_AMOUNT = mysql_fetch_array(mysql_query("SELECT BALANCEAMOUNT FROM fna_labourbill WHERE LABOURID = '".$LABOURID."' AND LABOURFLAG = '".$MAXLABOUR_FLAG."'"));
				$LAB_BAL_AMOUNT = $BAL_AMOUNT['BALANCEAMOUNT'];
				if(($MAXLABOUR_FLAG == 0) or ($MAXLABOUR_FLAG ='')){
					$NOW_LAB_BALAMOUNT = $globalLabourTotalBillAmount ;
				}else{
					$NOW_LAB_BALAMOUNT = $LAB_BAL_AMOUNT + $globalLabourTotalBillAmount ;
				}
				$insertLabourBillQuery = "
										INSERT INTO 
													fna_labourbill
															(
																ENTRYSERIALNOID,
																PROJECTID,
																SUBPROJECTID,
																LABOURID,
																PARTYID,
																PRODUCTLOADUNLOADID,
																BILLAMOUNT,
																PAYMENTAMOUNT,
																BALANCEAMOUNT,
																LABOURFLAG,
																ENTRYDATE,
																STATUS,
																ENTDATE,
																ENTTIME,
																USERID
															) 
													VALUES
															(
																'".$MaxEntrySlNo."',
																'".$PROJECTID."',
																'".$SUBPROJECTID."',
																'".$LABOURID."',
																'".$PARTYID."',
																'".$loadCtId."',
																'".$globalLabourTotalBillAmount."',
																'0',
																'".$NOW_LAB_BALAMOUNT."',
																'".$NOW_MAXLAB_FLAG."',
																'".$ENTRYDATE."',
																'Active',
																'".$entDate."',
																'".$entTime."',
																'".$userId."'
															)
					"; 
					
					
					$insertLabourBillQueryStatement = mysql_query($insertLabourBillQuery);
					
				// Upadate FNA Labour Bill Table End
				
				
						//------------------------------------------------Labour Bill Direct Entry Start---------------------------------------------------------------
					
					
					// Upadate FNA Labour Bill Table Start
						$MAXLABFLAG = mysql_fetch_array(mysql_query("SELECT MAX(LABOURFLAG) FROM fna_labourbill WHERE LABOURID = '".$LABOURID."'"));
						$MAXLABOUR_FLAG = $MAXLABFLAG['MAX(LABOURFLAG)'];
						$NOW_MAXLAB_FLAG = $MAXLABOUR_FLAG + 1;
						$BAL_AMOUNT = mysql_fetch_array(mysql_query("SELECT BALANCEAMOUNT FROM fna_labourbill WHERE LABOURID = '".$LABOURID."' AND LABOURFLAG = '".$MAXLABOUR_FLAG."'"));
						$LAB_BAL_AMOUNT = $BAL_AMOUNT['BALANCEAMOUNT'];
						
						if(($MAXLABOUR_FLAG == 0) or ($MAXLABOUR_FLAG ='')){
							$NOW_LAB_BALAMOUNT = $globalLabourTotalBillAmount ;
						}else{
							$NOW_LAB_BALAMOUNT = $LAB_BAL_AMOUNT - $globalLabourTotalBillAmount ;
						}
							
												
							$insertLabourBillQueryPayment = "
																INSERT INTO 
																			fna_labourbill
																					(
																						ENTRYSERIALNOID,
																						PROJECTID,
																						SUBPROJECTID,
																						LABOURID,
																						EXPHID,
																						PARTYID,
																						PRODUCTLOADUNLOADID,
																						BILLAMOUNT,
																						PAYMENTAMOUNT,
																						BALANCEAMOUNT,
																						LABOURFLAG,
																						ENTRYDATE,
																						STATUS,
																						ENTDATE,
																						ENTTIME,
																						USERID
																					) 
																			VALUES
																					(
																						'".$MaxEntrySlNo."',
																						'".$PROJECTID."',
																						'".$SUBPROJECTID."',
																						'".$LABOURID."',
																						'185',
																						'".$PARTYID."',
																						'".$loadCtId."',
																						'0',
																						'".$globalLabourTotalBillAmount."',
																						'".$NOW_LAB_BALAMOUNT."',
																						'".$NOW_MAXLAB_FLAG."',
																						'".$ENTRYDATE."',
																						'Load',
																						'".$entDate."',
																						'".$entTime."',
																						'".$userId."'
						
																					)
																				"; 
								
								
								$insertLabourBillQueryStatementPayment = mysql_query($insertLabourBillQueryPayment);
							
							if($insertLabourBillQueryStatementPayment){
								
									$insertQueryExpLabBill = "
														INSERT INTO 
																	fna_expanse
																					(
																						ENTRYSERIALNOID,
																						PROJECTID,
																						SUBPROJECTID,
																						PARTYID,
																						EXPHID,
																						EXPSUBHID,
																						AMOUNT,
																						EXPDATE,
																						DESCRIPTION,
																						STATUS,
																						ENTDATE,
																						ENTTIME,
																						USERID
																					) 
																			VALUES
																					(
																						'".$MaxEntrySlNo."',
																						'".$PROJECTID."',
																						'".$SUBPROJECTID."',
																						'".$PARTYID."',
																						'185',
																						'0',
																						'".$globalLabourTotalBillAmount."',
																						'".$ENTRYDATE."',
																						'Unload Labour Bill Payment....',
																						'Payment',
																						'".$entDate."',
																						'".$entTime."',
																						'".$userId."'
																					)
													";
									$insertQueryExpStatementLabBill = mysql_query($insertQueryExpLabBill);
									
									//Update FNA Balance Table Start
									$BALANCE_FLAG 			= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_balance"));
									$MAXBALANCE_FLAG 		= $BALANCE_FLAG['MAX(FLAG)'];
									$NOW_MAXBALANCE_FLAG 	= $MAXBALANCE_FLAG + 1;
									
									$BALANCE_QUERY		 	= mysql_fetch_array(mysql_query("SELECT * FROM fna_balance WHERE FLAG = '".$MAXBALANCE_FLAG."'"));
									$INCOME_AMOUNT 			= $BALANCE_QUERY['INCOME'];
									$EXPANSE_AMOUNT			= $BALANCE_QUERY['EXPANSE'];
									$BALANCE_AMOUNT 		= $BALANCE_QUERY['BALANCE'];
									
									$NOW_BALANCE_AMOUNT		= $BALANCE_AMOUNT - $globalLabourTotalBillAmount ;
									
									$insertBalanceQuery = "
															INSERT INTO 
																		fna_balance
																				(
																					ENTRYSERIALNOID,
																					PROJECTID,
																					SUBPROJECTID,
																					EXPANSE,
																					BALANCE,
																					FLAG,
																					BALDATE,
																					STATUS,
																					ENTDATE,
																					ENTTIME,
																					USERID
																				) 
																		VALUES
																				(
																					'".$MaxEntrySlNo."',
																					'".$PROJECTID."',
																					'".$SUBPROJECTID."',
																					'".$globalLabourTotalBillAmount."',
																					'".$NOW_BALANCE_AMOUNT."',
																					'".$NOW_MAXBALANCE_FLAG."',
																					'".$ENTRYDATE."',
																					'Payment',
																					'".$entDate."',
																					'".$entTime."',
																					'".$userId."'
																				)
										";
										
										
										$insertBalanceQueryStatement = mysql_query($insertBalanceQuery);
							}
									//Update FNA Balance Table End
									
							//------------------------------------------------Labour Bill Direct Entry End  ---------------------------------------------------------------
				
				
					
				} else {
					$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
				}
			
				}else
				{
					$msg = "<span class='errorMsg'>Sorry! Product Quantity [$quantity[$p], $ProdName ] is not Sufficient!</span>";
					}
					
			}else{
				$msg = "<span class='errorMsg'>Sorry, Please Enter  Session Entry First....!</span>";
			}
			
			return $msg;
			
			
			
			
		}
		// Insert UnLoad Information  End
		
		// Insert Purchase Raw Materials  Information Start
		function insertPurChaseRawMatInfo($userId){
			$PROJECTID 			= $_REQUEST["PROJECTID"];
			$SUBPROJECTID		= $_REQUEST["SUBPROJECTID"];
			
			$PARTYID 			= $_REQUEST["PARTYID"];
			$PURCHASEDATE 		= insertDateMySQlFormat($_REQUEST["PURCHASEDATE"]);
			$UNITPRICE			= $_REQUEST["UNITPRICE"];
			
			$PRODCATTYPEID		= $_REQUEST["PRODCATTYPEID"];
			$PRODUCTID 			= $_REQUEST["PRODUCTID"];
			$quantity	 		= $_REQUEST["quantity"];
			$AMOUNT				= $_REQUEST["AMOUNT"];
			$WTID		 		= $_REQUEST["WTID"];
			
			$TOTAL_PRODUCT_LIST	= $_REQUEST["TOTAL_PRODUCT_LIST"];
			$INVOICENO			= $_REQUEST["INVOICENO"];
			
			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
			$Query		= "
							SELECT 
									INVOICENO 
							FROM 
									feed_purchaserawmat
							WHERE INVOICENO = '".$INVOICENO."'
						";
			$QueryStatement	= mysql_query($Query);
			if(mysql_num_rows($QueryStatement)>0) {
				$msg = "<span class='errorMsg'>Sorry, This Invoice No. Data [ $INVOICENO ] already exist!</span>";
			} else {
				
				
					$EntrySerial_Query_Flag = mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_entryserialno"));
					$MaxFlagEntrySl			= $EntrySerial_Query_Flag['MAX(FLAG)'];
					
					$EntrySerial_Query_No	= mysql_fetch_array(mysql_query("SELECT MAX(ENTRYSERIALNOID) FROM fna_entryserialno"));
					$MaxEntrySlNo			= $EntrySerial_Query_No['MAX(ENTRYSERIALNOID)'] + 1;
			
			
					$insertQueryEntrySl = "
											INSERT INTO 
														fna_entryserialno
																		(
																			ENTRYSERIALNO,
																			PROJECTID,
																			SUBPROJECTID,
																			ENTRYDATE,
																			FLAG,
																			STATUS,
																			ENTDATE,
																			ENTTIME,
																			USERID
																		) 
																VALUES
																		(
																			'".$MaxEntrySlNo."',
																			'".$PROJECTID."',
																			'".$SUBPROJECTID."',
																			'".$PURCHASEDATE."',
																			'".$MaxFlagEntrySl."',
																			'Active',
																			'".$entDate."',
																			'".$entTime."',
																			'".$userId."'
																		)
										";
					$insertQueryEntrySlStatement = mysql_query($insertQueryEntrySl);
				
					$k = 0;
					for($i = 1; $i < $TOTAL_PRODUCT_LIST; $i++ ){
						
						$insertPurRawQuery = "
										INSERT INTO 
													feed_purchaserawmat
																	(
																		ENTRYSERIALNOID,
																		PROJECTID,
																		SUBPROJECTID,
																		PARTYID,
																		PRODCATTYPEID,
																		PRODUCTID,
																		INVOICENO,
																		UNITPRICE,
																		QUANTITY,
																		WTID,
																		AMOUNT,
																		PURCHASEDATE,
																		STATUS,
																		ENTDATE,
																		ENTTIME,
																		USERID
																	) 
															VALUES
																	(
																		'".$MaxEntrySlNo."',
																		'".$PROJECTID."',
																		'".$SUBPROJECTID."',
																		'".$PARTYID."',
																		'".$PRODCATTYPEID[$k]."',
																		'".$PRODUCTID[$k]."',
																		'".$INVOICENO."',
																		'".$UNITPRICE[$k]."',
																		'".$quantity[$k]."',
																		'".$WTID[$k]."',
																		'".$AMOUNT[$k]."',
																		'".$PURCHASEDATE."',
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									"; 
									
									
									$insertPurRawQueryStatement = mysql_query($insertPurRawQuery);
									
									if($insertPurRawQueryStatement){
										$msg = "<span class='validMsg'>Invoice No.[$INVOICENO] added sucessfully</span>";
									}else{
										$msg = "<span class='errorMsg'>Sorry! System Error komol!</span>";
										break;
										}
										
										$PRMID_Id = mysql_insert_id();
										
										//Update Product Stock table Start
										$partyFlag 			= mysql_fetch_array(mysql_query("SELECT MAX(IFNULL(PARTYFLAG,0)) FROM feed_rawmatstock WHERE PARTYID = '".$PARTYID."'"));
										$MAXpartyFlag 		= $partyFlag['MAX(IFNULL(PARTYFLAG,0))'];
										$NowMAXpartyFlag 	= $MAXpartyFlag + 1;
										
										$prodFlag 			= mysql_fetch_array(mysql_query("SELECT MAX(IFNULL(PRODFLAG,0)) FROM feed_rawmatstock WHERE PRODUCTID = '".$PRODUCTID[$k]."'"));
										$MAXprodFlag 		= $prodFlag['MAX(IFNULL(PRODFLAG,0))'];
										$NowMAXprodFlag 	= $MAXprodFlag + 1;
										
										$PartyProdFlag 		= mysql_fetch_array(mysql_query("SELECT MAX(IFNULL(PRODFLAG,0)) FROM feed_rawmatstock WHERE PARTYID = '".$PARTYID."' AND PRODUCTID = '".$PRODUCTID[$k]."'"));
										$MAXPartyProdFlag	= $PartyProdFlag['MAX(IFNULL(PRODFLAG,0))'];
										
										
									
										$TotQntyQry				= mysql_fetch_array(mysql_query("SELECT PARTYTOTQNTY FROM feed_rawmatstock WHERE PARTYID = '".$PARTYID."' AND PRODUCTID = '".$PRODUCTID[$k]."' AND PRODFLAG = '".$MAXPartyProdFlag."'"));
										$partyTotalQuantity  	= $TotQntyQry['PARTYTOTQNTY'];
										$NowPartyTotalQnty		= $TotQntyQry['PARTYTOTQNTY'] + $quantity[$k];
										
										$TotQnty	 			= mysql_fetch_array(mysql_query("SELECT TOTQNTY FROM feed_rawmatstock WHERE PRODUCTID = '".$PRODUCTID[$k]."' AND PRODFLAG = '".$MAXprodFlag."'"));
										$TotalQnty				= $TotQnty['TOTQNTY'];
										$NowTotQnty				= $TotQnty['TOTQNTY'] + $quantity[$k];
										
										$amount		 			= mysql_fetch_array(mysql_query("SELECT TOTAMOUNT FROM feed_rawmatstock WHERE PRODUCTID = '".$PRODUCTID[$k]."' AND PRODFLAG = '".$MAXprodFlag."'"));
										$TotalAmount			= $amount['TOTAMOUNT'];
										$NowTotalAmount			= $amount['TOTAMOUNT'] + $AMOUNT[$k];
										
										$Avg_Price				= $NowTotalAmount / $NowTotQnty ; 
										
										$insertStockQuery = "
															INSERT INTO 
																		feed_rawmatstock
																					(
																						ENTRYSERIALNOID,
																						PRMID,
																						PROJECTID,
																						SUBPROJECTID,
																						PARTYID,
																						PRODCATTYPEID,
																						PRODUCTID,
																						QUANTITY,
																						TOTQNTY,
																						AMOUNT,
																						TOTAMOUNT,
																						UNITPRICE,
																						AVGPRICE,
																						PARTYTOTQNTY,
																						PARTYFLAG,
																						PRODFLAG,
																						WORKFLAG,
																						STATUS,
																						ENTDATE,
																						ENTTIME,
																						USERID
																					) 
																			VALUES
																					(
																						'".$MaxEntrySlNo."',
																						'".$PRMID_Id."',
																						'".$PROJECTID."',
																						'".$SUBPROJECTID."',
																						'".$PARTYID."',
																						'".$PRODCATTYPEID[$k]."',
																						'".$PRODUCTID[$k]."',
																						'".$quantity[$k]."',
																						'".$NowTotQnty."',
																						'".$AMOUNT[$k]."',
																						'".$NowTotalAmount."',
																						'".$UNITPRICE[$k]."',
																						'".$Avg_Price."',
																						'".$NowPartyTotalQnty."',
																						'".$NowMAXpartyFlag."',
																						'".$NowMAXprodFlag."',
																						'In',
																						'Active',
																						'".$entDate."',
																						'".$entTime."',
																						'".$userId."'
																					)
									";
									$insertStockQueryStatement = mysql_query($insertStockQuery);
										//Update Product Stock table End
										
										//Update Party bill table Start
										// Upadate FNA Party Bill Table Start	
				
										$MAX_PARTY_FLAG = mysql_fetch_array(mysql_query("SELECT MAX(PARTYFLAG) FROM fna_partybill WHERE PARTYID = '".$PARTYID."' AND PURSELLFLAG = 'Purchase'"));
										$MAXPARTY_FLAG = $MAX_PARTY_FLAG['MAX(PARTYFLAG)'];
										$NOW_MAX_PARTY_FLAG = $MAXPARTY_FLAG + 1;
										$BAL_AMOUNT_PARTY = mysql_fetch_array(mysql_query("SELECT BALANCEAMOUNT FROM fna_partybill WHERE PARTYID = '".$PARTYID."' AND PARTYFLAG = '".$MAXPARTY_FLAG."' AND PURSELLFLAG = 'Purchase'"));
										$PARTY_BAL_AMOUNT = $BAL_AMOUNT_PARTY['BALANCEAMOUNT'];
										
										if(($MAXPARTY_FLAG == 0) or ($MAXPARTY_FLAG ='')){
											$NOW_PARTY_BALAMOUNT = 0 - $AMOUNT[$k] ;
										}else{
											$NOW_PARTY_BALAMOUNT = $PARTY_BAL_AMOUNT - $AMOUNT[$k] ; 
										}
										$insertPartyBillQuery = "
																INSERT INTO 
																			fna_partybill
																					(
																						ENTRYSERIALNOID,
																						PROJECTID,
																						SUBPROJECTID,
																						PARTYID,
																						PUR_BILLAMOUNT,
																						PAYMENTAMOUNT,
																						RECEIVEAMOUNT,
																						BALANCEAMOUNT,
																						ENTRYDATE,
																						PARTYFLAG,
																						STATUS,
																						PURSELLFLAG,
																						ENTDATE,
																						ENTTIME,
																						USERID
																					) 
																			VALUES
																					(
																						'".$MaxEntrySlNo."',
																						'".$PROJECTID."',
																						'".$SUBPROJECTID."',
																						'".$PARTYID."',
																						'".$AMOUNT[$k]."',
																						'0',
																						'0',
																						'".$NOW_PARTY_BALAMOUNT."',
																						'".$PURCHASEDATE."',
																						'".$NOW_MAX_PARTY_FLAG."',
																						'Active',
																						'Purchase',
																						'".$entDate."',
																						'".$entTime."',
																						'".$userId."'
																					)
											"; 
											
											
											$insertPartyBillQueryStatement = mysql_query($insertPartyBillQuery);
										// Upadate FNA Party Bill Table End
										//Update Party bill table End
									$msg = "<span class='validMsg'>Invoice No.[$INVOICENO] added sucessfully</span>";	
									
										
						$k++;
					}
				}
			return $msg;
		}
		// Insert Purchase Raw Materials  Information  End
		
		// Insert Purchase Raw Materials  Information Start
		function insertReadyFeedPurInfo($userId){
			$PROJECTID 			= $_REQUEST["PROJECTID"];
			$SUBPROJECTID		= $_REQUEST["SUBPROJECTID"];
			
			$PARTYID 			= $_REQUEST["PARTYID"];
			$PURCHASEDATE 		= insertDateMySQlFormat($_REQUEST["PURCHASEDATE"]);
			$UNITPRICE			= $_REQUEST["UNITPRICE"];
			
			$PRODCATTYPEID		= $_REQUEST["PRODCATTYPEID"];
			$PRODUCTID 			= $_REQUEST["PRODUCTID"];
			$quantity	 		= $_REQUEST["quantity"];
			$AMOUNT				= $_REQUEST["AMOUNT"];
			$WTID		 		= $_REQUEST["WTID"];
			
			$TOTAL_PRODUCT_LIST	= $_REQUEST["TOTAL_PRODUCT_LIST"];
			$INVOICENO			= $_REQUEST["INVOICENO"];
			
			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
			$Query		= "
							SELECT 
									INVOICENO 
							FROM 
									feed_purchaserawmat
							WHERE INVOICENO = '".$INVOICENO."'
						";
			$QueryStatement	= mysql_query($Query);
			if(mysql_num_rows($QueryStatement)>0) {
				$msg = "<span class='errorMsg'>Sorry, This Invoice No. Data [ $INVOICENO ] already exist!</span>";
			} else {
				
					$EntrySerial_Query_Flag = mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_entryserialno"));
					$MaxFlagEntrySl			= $EntrySerial_Query_Flag['MAX(FLAG)'];
					
					$EntrySerial_Query_No	= mysql_fetch_array(mysql_query("SELECT MAX(ENTRYSERIALNOID) FROM fna_entryserialno"));
					$MaxEntrySlNo			= $EntrySerial_Query_No['MAX(ENTRYSERIALNOID)'] + 1;
			
			
					$insertQueryEntrySl = "
											INSERT INTO 
														fna_entryserialno
																		(
																			ENTRYSERIALNO,
																			PROJECTID,
																			SUBPROJECTID,
																			ENTRYDATE,
																			FLAG,
																			STATUS,
																			ENTDATE,
																			ENTTIME,
																			USERID
																		) 
																VALUES
																		(
																			'".$MaxEntrySlNo."',
																			'".$PROJECTID."',
																			'".$SUBPROJECTID."',
																			'".$PURCHASEDATE."',
																			'".$MaxFlagEntrySl."',
																			'Active',
																			'".$entDate."',
																			'".$entTime."',
																			'".$userId."'
																		)
										";
					$insertQueryEntrySlStatement = mysql_query($insertQueryEntrySl);
				
					$k = 0;
					for($i = 1; $i < $TOTAL_PRODUCT_LIST; $i++ ){
						
						$insertPurRawQuery = "
										INSERT INTO 
													feed_purchaserawmat
																	(
																		ENTRYSERIALNOID,
																		PROJECTID,
																		SUBPROJECTID,
																		PARTYID,
																		PRODCATTYPEID,
																		PRODUCTID,
																		INVOICENO,
																		UNITPRICE,
																		QUANTITY,
																		WTID,
																		AMOUNT,
																		PURCHASEDATE,
																		STATUS,
																		ENTDATE,
																		ENTTIME,
																		USERID
																	) 
															VALUES
																	(
																		'".$MaxEntrySlNo."',
																		'".$PROJECTID."',
																		'".$SUBPROJECTID."',
																		'".$PARTYID."',
																		'".$PRODCATTYPEID[$k]."',
																		'".$PRODUCTID[$k]."',
																		'".$INVOICENO."',
																		'".$UNITPRICE[$k]."',
																		'".$quantity[$k]."',
																		'".$WTID[$k]."',
																		'".$AMOUNT[$k]."',
																		'".$PURCHASEDATE."',
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									"; 
									
									
									$insertPurRawQueryStatement = mysql_query($insertPurRawQuery);
									
									if($insertPurRawQueryStatement){
										$msg = "<span class='validMsg'>Invoice No.[$INVOICENO] added sucessfully</span>";
									}else{
										$msg = "<span class='errorMsg'>Sorry! System Error komol!</span>";
										break;
										}
										
										$PRMID_Id = mysql_insert_id();
										
										//Update Product Stock table Start
										$partyFlag 			= mysql_fetch_array(mysql_query("SELECT MAX(IFNULL(PARTYFLAG,0)) FROM feed_rawmatstock WHERE PARTYID = '".$PARTYID."'"));
										$MAXpartyFlag 		= $partyFlag['MAX(IFNULL(PARTYFLAG,0))'];
										$NowMAXpartyFlag 	= $MAXpartyFlag + 1;
										
										$prodFlag 			= mysql_fetch_array(mysql_query("SELECT MAX(IFNULL(PRODFLAG,0)) FROM feed_rawmatstock WHERE PRODUCTID = '".$PRODUCTID[$k]."'"));
										$MAXprodFlag 		= $prodFlag['MAX(IFNULL(PRODFLAG,0))'];
										$NowMAXprodFlag 	= $MAXprodFlag + 1;
										
										$PartyProdFlag 		= mysql_fetch_array(mysql_query("SELECT MAX(IFNULL(PRODFLAG,0)) FROM feed_rawmatstock WHERE PARTYID = '".$PARTYID."' AND PRODUCTID = '".$PRODUCTID[$k]."'"));
										$MAXPartyProdFlag	= $PartyProdFlag['MAX(IFNULL(PRODFLAG,0))'];
										
										
										
										$TotQntyQry				= mysql_fetch_array(mysql_query("SELECT PARTYTOTQNTY FROM feed_rawmatstock WHERE PARTYID = '".$PARTYID."' AND PRODUCTID = '".$PRODUCTID[$k]."' AND PRODFLAG = '".$MAXPartyProdFlag."'"));
										$partyTotalQuantity  	= $TotQntyQry['PARTYTOTQNTY'];
										$NowPartyTotalQnty		= $TotQntyQry['PARTYTOTQNTY'] + $quantity[$k];
										
										$TotQnty	 			= mysql_fetch_array(mysql_query("SELECT TOTQNTY FROM feed_rawmatstock WHERE PRODUCTID = '".$PRODUCTID[$k]."' AND PRODFLAG = '".$MAXprodFlag."'"));
										$TotalQnty				= $TotQnty['TOTQNTY'];
										$NowTotQnty				= $TotQnty['TOTQNTY'] + $quantity[$k];
										
										$amount		 			= mysql_fetch_array(mysql_query("SELECT TOTAMOUNT FROM feed_rawmatstock WHERE PRODUCTID = '".$PRODUCTID[$k]."' AND PRODFLAG = '".$MAXprodFlag."'"));
										$TotalAmount			= $amount['TOTAMOUNT'];
										$NowTotalAmount			= $amount['TOTAMOUNT'] + $AMOUNT[$k];
										
										$Avg_Price				= $NowTotalAmount / $NowTotQnty ; 
										
										$insertStockQuery = "
															INSERT INTO 
																		feed_rawmatstock
																					(
																						ENTRYSERIALNOID,
																						PRMID,
																						PROJECTID,
																						SUBPROJECTID,
																						PARTYID,
																						PRODCATTYPEID,
																						PRODUCTID,
																						QUANTITY,
																						TOTQNTY,
																						AMOUNT,
																						TOTAMOUNT,
																						UNITPRICE,
																						AVGPRICE,
																						PARTYTOTQNTY,
																						PARTYFLAG,
																						PRODFLAG,
																						WORKFLAG,
																						STATUS,
																						ENTDATE,
																						ENTTIME,
																						USERID
																					) 
																			VALUES
																					(
																						'".$MaxEntrySlNo."',
																						'".$PRMID_Id."',
																						'".$PROJECTID."',
																						'".$SUBPROJECTID."',
																						'".$PARTYID."',
																						'".$PRODCATTYPEID[$k]."',
																						'".$PRODUCTID[$k]."',
																						'".$quantity[$k]."',
																						'".$NowTotQnty."',
																						'".$AMOUNT[$k]."',
																						'".$NowTotalAmount."',
																						'".$UNITPRICE[$k]."',
																						'".$Avg_Price."',
																						'".$NowPartyTotalQnty."',
																						'".$NowMAXpartyFlag."',
																						'".$NowMAXprodFlag."',
																						'In',
																						'Active',
																						'".$entDate."',
																						'".$entTime."',
																						'".$userId."'
																					)
									";
									$insertStockQueryStatement = mysql_query($insertStockQuery);
										//Update Product Stock table End
										
										//-------------------START   FOODID--------------------------------------------------------
									$PRODUCTIDQry					= mysql_fetch_array(mysql_query("SELECT * FROM fna_product WHERE PRODUCTID = '".$PRODUCTID[$k]."'"));
									$PRODUCTNAME					= $PRODUCTIDQry['PRODUCTNAME'];
									$FOODIDQry					= mysql_fetch_array(mysql_query("SELECT * FROM feed_fooditem WHERE FOODNAME = '".$PRODUCTNAME."'"));
									$FOODID					= $FOODIDQry['FOODID'];
									//-------------------END   FOODID--------------------------------------------------------
									
						
									$MAXFLAG_FinishStck				= mysql_fetch_array(mysql_query("SELECT MAX(FOODFLAG) FROM feed_finishedstock WHERE FOODID = '".$FOODID."'"));
									$MAXFOOD_Flag					= $MAXFLAG_FinishStck['MAX(FOODFLAG)'];
									$Now_MAXFOOD_Flag_Finishstk		= $MAXFLAG_FinishStck['MAX(FOODFLAG)'] + 1;
									
									$FinishStkQry					= mysql_fetch_array(mysql_query("SELECT * FROM feed_finishedstock WHERE FOODID = '".$FOODID."' AND FOODFLAG = '".$MAXFOOD_Flag."'"));
									$FOODTOTQNTY					= $FinishStkQry['FOODTOTQNTY'];
									$AMOUNT_FINISH					= $FinishStkQry['AMOUNT'];
									$TOTAMOUNT_FINISH				= $FinishStkQry['TOTAMOUNT'];
									$AVGPRICE_FINISH				= $FinishStkQry['AVGPRICE'];
									
									$Now_FOODTOTQNTY				= $FOODTOTQNTY + $quantity[$k] ; 
									
									//$Now_AMOUNT_FINISH				= $AMOUNT_FINISH + $PRODUCTIONQNTY ;
									
									$Now_TOTAMOUNT_FINISH			= $TOTAMOUNT_FINISH + $AMOUNT[$k] ;
									
									$Now_AVGPRICE_FINISH			= $Now_TOTAMOUNT_FINISH / $Now_FOODTOTQNTY ;
									
									
									
									$insertQueryFinishStock = "
															INSERT INTO 
																		feed_finishedstock
																						(
																							ENTRYSERIALNOID,
																							PARTYID,
																							PROJECTID,
																							SUBPROJECTID,
																							FOODID,
																							QUANTITY,
																							FOODTOTQNTY,
																							AMOUNT,
																							TOTAMOUNT,
																							AVGPRICE,
																							FOODFLAG,
																							WORKFLAG,
																							STATUS,
																							ENTDATE,
																							ENTTIME,
																							USERID
																						) 
																				VALUES
																						(
																							'".$MaxEntrySlNo."',
																							'".$PARTYID."',
																							'2',
																							'6',
																							'".$FOODID."',
																							'".$quantity[$k]."',
																							'".$Now_FOODTOTQNTY."',
																							'".$AMOUNT[$k]."',
																							'".$Now_TOTAMOUNT_FINISH."',
																							'".$Now_AVGPRICE_FINISH."',
																							'".$Now_MAXFOOD_Flag_Finishstk."',
																							'In',
																							'Active',
																							'".$PURCHASEDATE."',
																							'".$entTime."',
																							'".$userId."'
																						)
															"; 
								$queryStatementSubmitFinishStock = mysql_query($insertQueryFinishStock);
					
					
										//Update Party bill table Start
										// Upadate FNA Party Bill Table Start	
				
										$MAX_PARTY_FLAG = mysql_fetch_array(mysql_query("SELECT MAX(PARTYFLAG) FROM fna_partybill WHERE PARTYID = '".$PARTYID."' AND PURSELLFLAG = 'Purchase'"));
										$MAXPARTY_FLAG = $MAX_PARTY_FLAG['MAX(PARTYFLAG)'];
										$NOW_MAX_PARTY_FLAG = $MAXPARTY_FLAG + 1;
										$BAL_AMOUNT_PARTY = mysql_fetch_array(mysql_query("SELECT BALANCEAMOUNT FROM fna_partybill WHERE PARTYID = '".$PARTYID."' AND PARTYFLAG = '".$MAXPARTY_FLAG."' AND PURSELLFLAG = 'Purchase'"));
										$PARTY_BAL_AMOUNT = $BAL_AMOUNT_PARTY['BALANCEAMOUNT'];
										
										if(($MAXPARTY_FLAG == 0) or ($MAXPARTY_FLAG ='')){
											$NOW_PARTY_BALAMOUNT = 0 - $AMOUNT[$k] ;
										}else{
											$NOW_PARTY_BALAMOUNT = $PARTY_BAL_AMOUNT - $AMOUNT[$k] ; 
										}
										$insertPartyBillQuery = "
																INSERT INTO 
																			fna_partybill
																					(
																						ENTRYSERIALNOID,
																						PROJECTID,
																						SUBPROJECTID,
																						PARTYID,
																						PUR_BILLAMOUNT,
																						PAYMENTAMOUNT,
																						RECEIVEAMOUNT,
																						BALANCEAMOUNT,
																						ENTRYDATE,
																						PARTYFLAG,
																						STATUS,
																						PURSELLFLAG,
																						ENTDATE,
																						ENTTIME,
																						USERID
																					) 
																			VALUES
																					(
																						'".$MaxEntrySlNo."',
																						'".$PROJECTID."',
																						'".$SUBPROJECTID."',
																						'".$PARTYID."',
																						'".$AMOUNT[$k]."',
																						'0',
																						'0',
																						'".$NOW_PARTY_BALAMOUNT."',
																						'".$PURCHASEDATE."',
																						'".$NOW_MAX_PARTY_FLAG."',
																						'Active',
																						'Purchase',
																						'".$entDate."',
																						'".$entTime."',
																						'".$userId."'
																					)
											"; 
											
											
											$insertPartyBillQueryStatement = mysql_query($insertPartyBillQuery);
										// Upadate FNA Party Bill Table End
										//Update Party bill table End
									$msg = "<span class='validMsg'>Invoice No.[] added sucessfully</span>";	
									
										
						$k++;
					}
			}
			return $msg;
		}
		// Insert Purchase Raw Materials  Information  End
		
		// Insert Recipi Entry Information Start 
		function insertRecipiInfo($userId){
			
			$RECIPIDATE	 		= insertDateMySQlFormat($_REQUEST["RECIPIDATE"]);
			$FOODID				= $_REQUEST["FOODID"];
			$FOODQNTY			= $_REQUEST["FOODQNTY"];
			
			$PRODUCTID 			= $_REQUEST["PRODUCTID"];
			$quantity	 		= $_REQUEST["quantity"];
			$WTID		 		= $_REQUEST["WTID"];
			$TOTAL_PRODUCT_LIST	= $_REQUEST["TOTAL_PRODUCT_LIST"];
			
			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
			$Query		= "
							SELECT 
									FOODID 
							FROM 
									feed_recipi
							WHERE FOODID = '".$FOODID."'
						";
			$QueryStatement	= mysql_query($Query);
			if(mysql_num_rows($QueryStatement)>0) {
				$msg = "<span class='errorMsg'>Sorry, This Food Item recipe[ $FOODID ] already exist!</span>";
			} else {
				
				$EntrySerial_Query_Flag = mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_entryserialno"));
				$MaxFlagEntrySl			= $EntrySerial_Query_Flag['MAX(FLAG)'];
				
				$EntrySerial_Query_No	= mysql_fetch_array(mysql_query("SELECT MAX(ENTRYSERIALNOID) FROM fna_entryserialno"));
				$MaxEntrySlNo			= $EntrySerial_Query_No['MAX(ENTRYSERIALNOID)'] + 1;
		
		
				$insertQueryEntrySl = "
										INSERT INTO 
													fna_entryserialno
																	(
																		ENTRYSERIALNO,
																		PROJECTID,
																		SUBPROJECTID,
																		ENTRYDATE,
																		FLAG,
																		STATUS,
																		ENTDATE,
																		ENTTIME,
																		USERID
																	) 
															VALUES
																	(
																		'".$MaxEntrySlNo."',
																		'".$PROJECTID."',
																		'".$SUBPROJECTID."',
																		'".$RECIPIDATE."',
																		'".$MaxFlagEntrySl."',
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									";
				$insertQueryEntrySlStatement = mysql_query($insertQueryEntrySl);
				
				$insertQuery = "
									INSERT INTO 
												feed_recipi
																	(
																		ENTRYSERIALNOID,
																		FOODID,
																		PROJECTID,
																		SUBPROJECTID,
																		RECIPIDATE,
																		FOODQNTY,
																		STATUS,
																		ENTDATE,
																		ENTTIME,
																		USERID
																	) 
															VALUES
																	(
																		'".$MaxEntrySlNo."',
																		'".$FOODID."',
																		'2',
																		'6',
																		'".$RECIPIDATE."',
																		'".$FOODQNTY."',
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									"; 
				if(mysql_query($insertQuery)){
					
					$RECIPIID = mysql_insert_id();
					
					
					$k = 0;
					for($i = 1; $i < $TOTAL_PRODUCT_LIST; $i++ ){
						
								$insertbkdnQuery = "
										INSERT INTO 
													feed_recipi_bkdn
																	(
																		ENTRYSERIALNOID,
																		RECIPIID,
																		PROJECTID,
																		SUBPROJECTID,
																		PRODUCTID,
																		QUANTITY,
																		WTID,
																		STATUS,
																		ENTDATE,
																		ENTTIME,
																		USERID
																	) 
															VALUES
																	(
																		'".$MaxEntrySlNo."',
																		'".$RECIPIID."',
																		'2',
																		'6',
																		'".$PRODUCTID[$k]."',
																		'".$quantity[$k]."',
																		'".$WTID[$k]."',
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									"; 
									
									
									$insertbkdnQueryStatement = mysql_query($insertbkdnQuery);
									if($insertbkdnQueryStatement){
										$msg = "<span class='validMsg'>Food Item Recipe [$RECIPIID] added sucessfully</span>";
									}else{
										$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
									}
														
						$k++;
					}
				
					
				} else {
					$msg = "<span class='errorMsg'>Sorry! System Error Last!</span>";
				}
			}
			return $msg;
		}
		// Insert Recipi Entry Information  End
		
		// Insert Profit Amount Information Start 
		function insertProfitInfo($userId){
			
			$PADATE		 		= insertDateMySQlFormat($_REQUEST["PADATE"]);
			$RATE				= $_REQUEST["RATE"];
			
			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
			$Query		= "
							SELECT 
									RATE,
									OPENING_PADATE 
							FROM 
									feed_profitamount
							WHERE RATE = '".$RATE."'
							AND   OPENING_PADATE = '".$PADATE."'
						";
			$QueryStatement	= mysql_query($Query);
			if(mysql_num_rows($QueryStatement)>0) {
				$msg = "<span class='errorMsg'>Sorry, This Rate and Date [ $RATE ] already exist!</span>";
			} else {
				
				$EntrySerial_Query_Flag = mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_entryserialno"));
				$MaxFlagEntrySl			= $EntrySerial_Query_Flag['MAX(FLAG)'];
				
				$EntrySerial_Query_No	= mysql_fetch_array(mysql_query("SELECT MAX(ENTRYSERIALNOID) FROM fna_entryserialno"));
				$MaxEntrySlNo			= $EntrySerial_Query_No['MAX(ENTRYSERIALNOID)'] + 1;
		
		
				$insertQueryEntrySl = "
										INSERT INTO 
													fna_entryserialno
																	(
																		ENTRYSERIALNO,
																		PROJECTID,
																		SUBPROJECTID,
																		ENTRYDATE,
																		FLAG,
																		STATUS,
																		ENTDATE,
																		ENTTIME,
																		USERID
																	) 
															VALUES
																	(
																		'".$MaxEntrySlNo."',
																		'".$PROJECTID."',
																		'".$SUBPROJECTID."',
																		'".$PADATE."',
																		'".$MaxFlagEntrySl."',
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									";
				$insertQueryEntrySlStatement = mysql_query($insertQueryEntrySl);
				
				$MaxFlagProfit	= mysql_fetch_array(mysql_query("SELECT MAX(PROFITFLAG) FROM feed_profitamount"));
				$ProfitFlag		= $MaxFlagProfit['MAX(PROFITFLAG)'];
				$NOWMAXFLAF		= $MaxFlagProfit['MAX(PROFITFLAG)'] + 1;
				$insertQuery = "
									INSERT INTO 
												feed_profitamount
																	(
																		ENTRYSERIALNOID,
																		RATE,
																		PROFITFLAG,
																		OPENING_PADATE,
																		STATUS,
																		ENTDATE,
																		ENTTIME,
																		USERID
																	) 
															VALUES
																	(
																		'".$MaxEntrySlNo."',
																		'".$RATE."',
																		'".$NOWMAXFLAF."',
																		'".$PADATE."',
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									"; 
				$submitQueryStatement = mysql_query($insertQuery);
				if($submitQueryStatement){
					
					$Upadet_Query_Profit = "UPDATE feed_profitamount SET
											CLOSING_PADATE = '".$PADATE."'
											WHERE PROFITFLAG = '".$ProfitFlag."'";
											
					$submit_UpdateQuery = mysql_query($Upadet_Query_Profit);
					$msg = "<span class='validMsg'>Profit Amount  [ $RATE ] added sucessfully</span>";
				} else {
					$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
				}
			}
			return $msg;
		}
		// Insert Profit Amount Information  End
		
		// Insert Production Information Start
		function insertProductionInfo($userId){
			
			$PRODUCTIONDATE		= ($_REQUEST["PRODUCTIONDATE"]);
			$FOODID				= $_REQUEST["FOODID"];
			$PRODUCTIONQNTY		= $_REQUEST["PRODUCTIONQNTY"];
			
			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
			$Query		= "
							SELECT 
									FOODID,
									PRODUCTIONQNTY,
									PRODUCTIONDATE
							FROM 
									feed_production
							WHERE FOODID = '".$FOODID."'
							AND PRODUCTIONQNTY = '".$PRODUCTIONQNTY."'
							AND PRODUCTIONDATE = '".$PRODUCTIONDATE."'
						";
			$QueryStatement	= mysql_query($Query);
			if(mysql_num_rows($QueryStatement)>0) {
				$msg = "<span class='errorMsg'>Sorry, Today This Production Quantity [ $PRODUCTIONQNTY ] already exist!</span>";
			} else {
				
				$EntrySerial_Query_Flag = mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_entryserialno"));
				$MaxFlagEntrySl			= $EntrySerial_Query_Flag['MAX(FLAG)'];
				
				$EntrySerial_Query_No	= mysql_fetch_array(mysql_query("SELECT MAX(ENTRYSERIALNOID) FROM fna_entryserialno"));
				$MaxEntrySlNo			= $EntrySerial_Query_No['MAX(ENTRYSERIALNOID)'] + 1;
		
		
				$insertQueryEntrySl = "
										INSERT INTO 
													fna_entryserialno
																	(
																		ENTRYSERIALNO,
																		PROJECTID,
																		SUBPROJECTID,
																		ENTRYDATE,
																		FLAG,
																		STATUS,
																		ENTDATE,
																		ENTTIME,
																		USERID
																	) 
															VALUES
																	(
																		'".$MaxEntrySlNo."',
																		'".$PROJECTID."',
																		'".$SUBPROJECTID."',
																		'".$PRODUCTIONDATE."',
																		'".$MaxFlagEntrySl."',
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									";
				$insertQueryEntrySlStatement = mysql_query($insertQueryEntrySl);
				
				$chk = 1;
				
				$sql_Recipe 	= mysql_fetch_array(mysql_query("SELECT * FROM feed_recipi WHERE FOODID = '".$FOODID."'"));
				$RECIPIID  		= $sql_Recipe['RECIPIID'];
				$DefaultQnty 	= $sql_Recipe['FOODQNTY'];
				
				$sql_rec_bkdn				= "SELECT * FROM feed_recipi_bkdn WHERE RECIPIID = '".$RECIPIID."'";
				$QueryStatement				= mysql_query($sql_rec_bkdn);
				//$querySatementData			= mysql_fetch_array($QueryStatement);
				while($querySatementData	= mysql_fetch_array($QueryStatement)){
					$PRODUCTID_BKDN			= $querySatementData['PRODUCTID'];
					$QUANTITY_BKDN			= $querySatementData['QUANTITY'];
					$WTID_BKDN				= $querySatementData['WTID'];
					
					$FormulatedQnty			= ($QUANTITY_BKDN / $DefaultQnty)* $PRODUCTIONQNTY ;
					
					$MAXFLAG_Raw_Prod				= mysql_fetch_array(mysql_query("SELECT MAX(PRODFLAG) FROM feed_rawmatstock WHERE PRODUCTID = '".$PRODUCTID_BKDN."'"));
					$MAXPROD_Raw_FLAG			= $MAXFLAG_Raw_Prod['MAX(PRODFLAG)'];
					$RawMatStock_Prod			= mysql_fetch_array(mysql_query("SELECT * FROM feed_rawmatstock WHERE PRODUCTID = '".$PRODUCTID_BKDN."' AND PRODFLAG = '".$MAXPROD_Raw_FLAG."'"));
					$LATEST_TOTQNTY_PROD	= $RawMatStock_Prod['TOTQNTY'];
					$AVG_PRICE_PROD			= $RawMatStock_Prod['AVGPRICE'];
					
					$queryCheckProdName = mysql_fetch_array(mysql_query("SELECT	* FROM fna_product WHERE PRODUCTID = '".$PRODUCTID_BKDN."'"));
					$ProdName = $queryCheckProdName['PRODUCTNAME'];
					
					
					if($FormulatedQnty >= $LATEST_TOTQNTY_PROD){
						$chk = 0;
						break;
						$msg = "<span class='errorMsg'>Sorry! Product [$FormulatedQnty , $ProdName ] Not Available............!</span>";
						
					}
					
				}//end while loop
				
				//End Check
				
				if($chk == 1){
					
					$insertQueryProduction = "
										INSERT INTO 
													feed_production
																	(
																		ENTRYSERIALNOID,
																		FOODID,
																		PROJECTID,
																		SUBPROJECTID,
																		PRODUCTIONQNTY,
																		PRODUCTIONDATE,
																		STATUS,
																		ENTDATE,
																		ENTTIME,
																		USERID
																	) 
															VALUES
																	(
																		'".$MaxEntrySlNo."',
																		'".$FOODID."',
																		'2',
																		'6',
																		'".$PRODUCTIONQNTY."',
																		'".$PRODUCTIONDATE."',
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									"; 
					$queryStatementSubmit = mysql_query($insertQueryProduction);
					$PRODUCTIONID			= mysql_insert_id();
					
					$sql_Recipe 	= mysql_fetch_array(mysql_query("SELECT * FROM feed_recipi WHERE FOODID = '".$FOODID."'"));
					$RECIPIID  		= $sql_Recipe['RECIPIID'];
					$DefaultQnty 	= $sql_Recipe['FOODQNTY'];
				
					$sql_rec_bkdn				= "SELECT * FROM feed_recipi_bkdn WHERE RECIPIID = '".$RECIPIID."'";
					$QueryStatement				= mysql_query($sql_rec_bkdn);
					//$querySatementData			= mysql_fetch_array($QueryStatement);
					$Global_ProductionCost		= 0;
					$prodAvgPrice				= 0;
					$Global_AvgPrice			= 0;
					while($querySatementData	= mysql_fetch_array($QueryStatement)){
						$RECIPIBKDNID_BKDN		= $querySatementData['RECIPIBKDNID'];
						$RECIPIID_BKDN			= $querySatementData['RECIPIID'];
						$PRODUCTID_BKDN			= $querySatementData['PRODUCTID'];
						$QUANTITY_BKDN			= $querySatementData['QUANTITY'];
						$WTID_BKDN				= $querySatementData['WTID'];
						
						$CalculatedQnty			= ($QUANTITY_BKDN / $DefaultQnty)* $PRODUCTIONQNTY ;
						
						$MAXFLAG				= mysql_fetch_array(mysql_query("SELECT MAX(PRODFLAG) FROM feed_rawmatstock WHERE PRODUCTID = '".$PRODUCTID_BKDN."'"));
						$MAXPROD_FLAG			= $MAXFLAG['MAX(PRODFLAG)'];
						$RawMatStock			= mysql_fetch_array(mysql_query("SELECT * FROM feed_rawmatstock WHERE PRODUCTID = '".$PRODUCTID_BKDN."' AND PRODFLAG = '".$MAXPROD_FLAG."'"));
						$LATEST_TOTQNTY_PROD	= $RawMatStock['TOTQNTY'];
						$AVG_PRICE_PROD			= $RawMatStock['AVGPRICE'];
						
						$NeedQnty				= $LATEST_TOTQNTY_PROD - $CalculatedQnty ;
						$ProductionCost			= $AVG_PRICE_PROD * $CalculatedQnty ;
						
						
						
						$insertQueryProductionBkdn = "
														INSERT INTO 
																	feed_production_bkdn
																					(
																						ENTRYSERIALNOID,
																						PRODUCTIONID,
																						FOODID,
																						RECIPIID,
																						RECIPIBKDNID,
																						PROJECTID,
																						SUBPROJECTID,
																						PRODUCTID,
																						QUANTITY,
																						WTID,
																						PRICE,
																						STATUS,
																						ENTDATE,
																						ENTTIME,
																						USERID
																					) 
																			VALUES
																					(
																						'".$MaxEntrySlNo."',
																						'".$PRODUCTIONID."',
																						'".$FOODID."',
																						'".$RECIPIID_BKDN."',
																						'".$RECIPIBKDNID_BKDN."',
																						'2',
																						'6',
																						'".$PRODUCTID_BKDN."',
																						'".$CalculatedQnty."',
																						'".$WTID_BKDN."',
																						'".$ProductionCost."',
																						'Active',
																						'".$entDate."',
																						'".$entTime."',
																						'".$userId."'
																					)
													";
						$queryStatementSubmitBkdn = mysql_query($insertQueryProductionBkdn);
						//if($queryStatementSubmitBkdn){
								//RawMatStock Table Start
								$MAXFLAG_Raw			= mysql_fetch_array(mysql_query("SELECT MAX(PRODFLAG) FROM feed_rawmatstock WHERE PRODUCTID = '".$PRODUCTID_BKDN."'"));
								$MAXPROD_FLAG_Raw		= $MAXFLAG_Raw['MAX(PRODFLAG)'];
								$Now_MAXPROD_FLAG_Raw	= $MAXFLAG_Raw['MAX(PRODFLAG)'] + 1;
								
								$rawMatStkQry			= mysql_fetch_array(mysql_query("SELECT * FROM feed_rawmatstock WHERE PRODUCTID = '".$PRODUCTID_BKDN."' AND PRODFLAG = '".$MAXPROD_FLAG_Raw."'"));
								$TOTQNTY_RawStk			= $rawMatStkQry['TOTQNTY'];
								$TOTAMOUNT_RawStk		= $rawMatStkQry['TOTAMOUNT'];
								$UNITPRICE_RawStk		= $rawMatStkQry['UNITPRICE'];
								$AVGPRICE_RawStk		= $rawMatStkQry['AVGPRICE'];
								
								$PRMID_RawStk			= $rawMatStkQry['PRMID'];
								$PROJECTID_RawStk		= $rawMatStkQry['PROJECTID'];
								$SUBPROJECTID_RawStk	= $rawMatStkQry['SUBPROJECTID'];
								$PARTYID_RawStk			= $rawMatStkQry['PARTYID'];
								$PRODCATTYPEID_RawStk	= $rawMatStkQry['PRODCATTYPEID'];
								$PRODUCTID_RawStk		= $rawMatStkQry['PRODUCTID'];
								$QUANTITY_RawStk		= $rawMatStkQry['QUANTITY'];
								$AMOUNT_RawStk			= $rawMatStkQry['AMOUNT'];
								$PARTYTOTQNTY_RawStk	= $rawMatStkQry['PARTYTOTQNTY'];
								$PARTYFLAG_RawStk		= $rawMatStkQry['PARTYFLAG'];
								
								$Now_TOTQNTY			= $TOTQNTY_RawStk - $CalculatedQnty ; 
								$Now_TOTAMOUNT			= $TOTAMOUNT_RawStk - $ProductionCost ; 
								$Now_PARTYFLAG			= $PARTYFLAG_RawStk + 1;
								
								$Global_ProductionCost 	= $Global_ProductionCost + $ProductionCost ;
								$prodAvgPrice			= $ProductionCost / $CalculatedQnty ;
								
									$insertQueryRawMatStk = "
																INSERT INTO 
																			feed_rawmatstock
																							(
																								ENTRYSERIALNOID,
																								PRMID,
																								PROJECTID,
																								SUBPROJECTID,
																								PARTYID,
																								PRODCATTYPEID,
																								PRODUCTID,
																								QUANTITY,
																								TOTQNTY,
																								AMOUNT,
																								TOTAMOUNT,
																								UNITPRICE,
																								AVGPRICE,
																								PARTYTOTQNTY,
																								PARTYFLAG,
																								PRODFLAG,
																								WORKFLAG,
																								STATUS,
																								ENTDATE,
																								ENTTIME,
																								USERID
																							) 
																					VALUES
																							(
																								'".$MaxEntrySlNo."',
																								'".$PRMID_RawStk."',
																								'".$PROJECTID_RawStk."',
																								'".$SUBPROJECTID_RawStk."',
																								'".$PARTYID_RawStk."',
																								'".$PRODCATTYPEID_RawStk."',
																								'".$PRODUCTID_BKDN."',
																								'".$CalculatedQnty."',
																								'".$Now_TOTQNTY."',
																								'".$ProductionCost."',
																								'".$Now_TOTAMOUNT."',
																								'".$UNITPRICE_RawStk."',
																								'".$prodAvgPrice."',
																								'".$PARTYTOTQNTY_RawStk."',
																								'".$Now_PARTYFLAG."',
																								'".$Now_MAXPROD_FLAG_Raw."',
																								'Out',
																								'Active',
																								'".$entDate."',
																								'".$entTime."',
																								'".$userId."'
																							)
															"; 
								$queryStatementSubmitRawStk = mysql_query($insertQueryRawMatStk);
								if($queryStatementSubmitRawStk){
									$msg = "<span class='validMsg'>This Information (Stock)  added sucessfully</span>";
								}else{
									$msg = "<span class='errorMsg'>Sorry! System Error ( Raw Materials Stock)!</span>";
								}
								//RawMatStock Table End
							}
								
								
								$MAXFLAG_FinishStck				= mysql_fetch_array(mysql_query("SELECT MAX(FOODFLAG) FROM feed_finishedstock WHERE FOODID = '".$FOODID."'"));
								$MAXFOOD_Flag					= $MAXFLAG_FinishStck['MAX(FOODFLAG)'];
								$Now_MAXFOOD_Flag_Finishstk		= $MAXFLAG_FinishStck['MAX(FOODFLAG)'] + 1;
								
								$FinishStkQry					= mysql_fetch_array(mysql_query("SELECT * FROM feed_finishedstock WHERE FOODID = '".$FOODID."' AND FOODFLAG = '".$MAXFOOD_Flag."'"));
								$FOODTOTQNTY					= $FinishStkQry['FOODTOTQNTY'];
								$AMOUNT_FINISH					= $FinishStkQry['AMOUNT'];
								$TOTAMOUNT_FINISH				= $FinishStkQry['TOTAMOUNT'];
								$AVGPRICE_FINISH				= $FinishStkQry['AVGPRICE'];
								
								$Now_FOODTOTQNTY				= $FOODTOTQNTY + $PRODUCTIONQNTY ; 
								
								//$Now_AMOUNT_FINISH				= $AMOUNT_FINISH + $PRODUCTIONQNTY ;
								
								$Now_TOTAMOUNT_FINISH			= $TOTAMOUNT_FINISH + $Global_ProductionCost ;
								
								$Now_AVGPRICE_FINISH			= $Now_TOTAMOUNT_FINISH / $Now_FOODTOTQNTY ;
								
								
								$insertQueryFinishStock = "
														INSERT INTO 
																	feed_finishedstock
																					(
																						ENTRYSERIALNOID,
																						PROJECTID,
																						SUBPROJECTID,
																						PRODUCTIONID,
																						FOODID,
																						QUANTITY,
																						FOODTOTQNTY,
																						AMOUNT,
																						TOTAMOUNT,
																						AVGPRICE,
																						FOODFLAG,
																						WORKFLAG,
																						STATUS,
																						ENTDATE,
																						ENTTIME,
																						USERID
																					) 
																			VALUES
																					(
																						'".$MaxEntrySlNo."',
																						'2',
																						'6',
																						'".$PRODUCTIONID."',
																						'".$FOODID."',
																						'".$PRODUCTIONQNTY."',
																						'".$Now_FOODTOTQNTY."',
																						'".$Global_ProductionCost."',
																						'".$Now_TOTAMOUNT_FINISH."',
																						'".$Now_AVGPRICE_FINISH."',
																						'".$Now_MAXFOOD_Flag_Finishstk."',
																						'In',
																						'Active',
																						'".$PRODUCTIONDATE."',
																						'".$entTime."',
																						'".$userId."'
																					)
														"; 
							$queryStatementSubmitFinishStock = mysql_query($insertQueryFinishStock);
							
							if($queryStatementSubmitFinishStock){
									
									$Global_AvgPrice				= $Global_ProductionCost / $PRODUCTIONQNTY ;
								
									$updateQuery = "UPDATE feed_production SET
													PRODUCTIONCOST = '".$Global_ProductionCost."',
													AVGPRICE		= '".$Global_AvgPrice."'
													where PRODUCTIONID = '".$PRODUCTIONID."'";
									$updateQrySubmit	= mysql_query($updateQuery);
									
									//------------------------------Finished Stock Table Update Start----------------------------------
									
									$MAXFLAG_FinishStckUpdate		= mysql_fetch_array(mysql_query("SELECT MAX(FOODFLAG) FROM feed_finishedstock WHERE FOODID = '".$FOODID."'"));
									$MAXFOOD_Flag_Update			= $MAXFLAG_FinishStckUpdate['MAX(FOODFLAG)'];
									
									$updateQueryFinished 		= "UPDATE feed_finishedstock SET
																		TOTAMOUNT = '".$Global_ProductionCost."',
																		AVGPRICE		= '".$Global_AvgPrice."'
																		where FOODFLAG = '".$MAXFOOD_Flag_Update."'";
									$updateQrySubmitFinished	= mysql_query($updateQueryFinished);
									//-----------------------------Finished Stock Table Update End  ----------------------------
									$msg = "<span class='validMsg'>This Information (Finish Stock)  added sucessfully</span>";
								}else{
									$msg = "<span class='errorMsg'>Sorry! System Error Finished Stock...!</span>";
									
								}
					
										
				}else{
				$msg = "<span class='errorMsg'>Sorry! [$FormulatedQnty , $ProdName ] Product  Not Available............!</span>";
				}
			}
			return $msg;
		}
		// Insert Production Entry Information  End
		
		// Insert Load Alu Information Start
		function insertLoadAluInfo($userId){
			
			$PROJECTID 			= $_REQUEST["PROJECTID"];
			$SUBPROJECTID		= $_REQUEST["SUBPROJECTID"];
			
			$LABOURID 			= $_REQUEST["LABOURID"];
			$PARTYID 			= $_REQUEST["PARTYID"];
			$ENTRYDATE	 		= insertDateMySQlFormat($_REQUEST["ENTRYDATE"]);
			
			
			$PRODCATTYPEID		= $_REQUEST["PRODCATTYPEID"];
			$PRODUCTID 			= $_REQUEST["PRODUCTID"];
			$quantity	 		= $_REQUEST["quantity"];
			$packingUnit		= $_REQUEST["packingUnit"];
			$CHID		 		= $_REQUEST["CHID"];
			$carloan	 		= $_REQUEST["carloan"];
			$BASTA_QNTY	 		= $_REQUEST["bastaloan"];
			$TOTAL_PRODUCT_LIST	= $_REQUEST["TOTAL_PRODUCT_LIST"];
			$LOTNO				= $_REQUEST["LOTNO"];
			
			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
			$Query		= "
							SELECT 
									LOTNO 
							FROM 
									fna_productloadunload
							WHERE LOTNO = '".$LOTNO."'
							AND PROJECTID = '".$PROJECTID."'
							AND SUBPROJECTID = '".$SUBPROJECTID."'
						";
			$QueryStatement	= mysql_query($Query);
			if(mysql_num_rows($QueryStatement)>0) {
				$msg = "<span class='errorMsg'>Sorry, This Lot No. Data [ $LOTNO ] already exist!</span>";
			} else {
				
				$EntrySerial_Query_Flag = mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_entryserialno"));
				$MaxFlagEntrySl			= $EntrySerial_Query_Flag['MAX(FLAG)'];
				
				$EntrySerial_Query_No	= mysql_fetch_array(mysql_query("SELECT MAX(ENTRYSERIALNOID) FROM fna_entryserialno"));
				$MaxEntrySlNo			= $EntrySerial_Query_No['MAX(ENTRYSERIALNOID)'] + 1;
		
		
				$insertQueryEntrySl = "
										INSERT INTO 
													fna_entryserialno
																	(
																		ENTRYSERIALNO,
																		PROJECTID,
																		SUBPROJECTID,
																		ENTRYDATE,
																		FLAG,
																		STATUS,
																		ENTDATE,
																		ENTTIME,
																		USERID
																	) 
															VALUES
																	(
																		'".$MaxEntrySlNo."',
																		'".$PROJECTID."',
																		'".$SUBPROJECTID."',
																		'".$ENTRYDATE."',
																		'".$MaxFlagEntrySl."',
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									";
				$insertQueryEntrySlStatement = mysql_query($insertQueryEntrySl);
				
					$MAXRECNO = mysql_fetch_array(mysql_query("SELECT MAX(IFNULL(RECEIVENUMBER,0)) FROM fna_productloadunload "));
					$maxNo = $MAXRECNO['MAX(IFNULL(RECEIVENUMBER,0))'];
					if($maxNo == 0){
							$nowMAXRECNO = $maxNo + 1;
						}else{
							$nowMAXRECNO = $maxNo + 1;	
						}
						
					$maxFlagQry			= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_productloadunload"));
					$maxFlag			= $maxFlagQry['MAX(FLAG)'];
					$Now_maxFlag		= $maxFlag + 1;
						
					$insertQuery = "
										INSERT INTO 
													fna_productloadunload
																		(
																			ENTRYSERIALNOID,
																			PROJECTID,
																			SUBPROJECTID,
																			PARTYID,
																			LABOURID,
																			ENTRYDATE,
																			RECEIVENUMBER,
																			LOTNO,
																			FLAG,
																			STATUS,
																			ENTDATE,
																			ENTTIME,
																			USERID
																		) 
																VALUES
																		(
																			'".$MaxEntrySlNo."',
																			'".$PROJECTID."',
																			'".$SUBPROJECTID."',
																			'".$PARTYID."',
																			'".$LABOURID."',
																			'".$ENTRYDATE."',
																			'".$nowMAXRECNO."',
																			'".$LOTNO."',
																			'".$Now_maxFlag."',
																			'Active',
																			'".$entDate."',
																			'".$entTime."',
																			'".$userId."'
																		)
										"; 
					if(mysql_query($insertQuery)){
						
						$loadCtId = mysql_insert_id();
						
						
						$k = 0;
						$globalLabourTotalBillAmount = 0;
						$globalPartyTotalBillAmount = 0;
					
						for($i = 1; $i < $TOTAL_PRODUCT_LIST; $i++ ){
						
						//---------------------------Unload to PC Start -----------------------------------------------
				
							$MAXPCFLAG_QRY		 	= mysql_fetch_array(mysql_query("SELECT MAX(PARTYFLAG) FROM fna_unloadtopc WHERE PARTYID = '".$PARTYID."'"));
							$MAXPARTY_FLAG 			= $MAXPCFLAG_QRY['MAX(PARTYFLAG)'];
							$NOW_MAXPARTY_FLAG 		= $MAXPARTY_FLAG + 1;
							$PARTY_TOT_QNTY_QRY		= mysql_fetch_array(mysql_query("SELECT PARTYTOTQNTY FROM fna_unloadtopc WHERE PARTYID = '".$PARTYID."' AND PARTYFLAG = '".$MAXPARTY_FLAG."'"));
							$PARTYTOTQNTY	 		= $PARTY_TOT_QNTY_QRY['PARTYTOTQNTY'];
							$NOW_PARTYTOTQNTY		= $PARTYTOTQNTY - $quantity[$k] ; 
						
						
								if($PARTYTOTQNTY >= $quantity[$k]){
								
										$insertUnloadtopcQuery = "
																	INSERT INTO 
																				fna_unloadtopc
																							(
																								ENTRYSERIALNOID,
																								PROJECTID,
																								SUBPROJECTID,
																								PARTYID,
																								PRODCATTYPEID,
																								PACKINGUNITID,
																								PRODUCTID,
																								UNLOAD_QUANTITY,
																								PARTYTOTQNTY,
																								PARTYFLAG,
																								STATUS,
																								ENTDATE,
																								ENTTIME,
																								USERID
																							) 
																					VALUES
																							(
																								'".$MaxEntrySlNo."',
																								'".$PROJECTID."',
																								'".$SUBPROJECTID."',
																								'".$PARTYID."',
																								'".$PRODCATTYPEID[$k]."',
																								'".$packingUnit[$k]."',
																								'".$PRODUCTID[$k]."',
																								'".$quantity[$k]."',
																								'".$NOW_PARTYTOTQNTY."',
																								'".$NOW_MAXPARTY_FLAG."',
																								'Active',
																								'".$entDate."',
																								'".$entTime."',
																								'".$userId."'
																							)
										"; 
								
								
								$insertUnloadtopcQueryStatement = mysql_query($insertUnloadtopcQuery);
								if($insertUnloadtopcQueryStatement){
									$msg = "<span class='validMsg'>Unload To PC Information [$PARTYID] added sucessfully</span>";
								}else{
									$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
									break;
									}
								
								//---------------------------Unload to PC End -------------------------------------------------
				
					
							
								$insertbkdnQuery = "
														INSERT INTO 
																	fna_productloadunloadbkdn
																						(
																							ENTRYSERIALNOID,
																							PRODUCTLOADUNLOADID,
																							PRODCATTYPEID,
																							PRODUCTID,
																							PACKINGUNITID,
																							QUANTITY,
																							CHID,
																							STATUS,
																							ENTDATE,
																							ENTTIME,
																							USERID
																						) 
																				VALUES
																						(
																							'".$MaxEntrySlNo."',
																							'".$loadCtId."',
																							'".$PRODCATTYPEID[$k]."',
																							'".$PRODUCTID[$k]."',
																							'".$packingUnit[$k]."',
																							'".$quantity[$k]."',
																							'".$CHID[$k]."',
																							'Active',
																							'".$entDate."',
																							'".$entTime."',
																							'".$userId."'
																						)
																				"; 
									
									
									$insertbkdnQueryStatement = mysql_query($insertbkdnQuery);
									if($insertbkdnQueryStatement){
										$msg = "<span class='validMsg'>Labour Information [$loadCtId] added sucessfully</span>";
									}else{
										$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
										break;
										}
										
										//Update Product Stock table Start
										$loadUnloadBkdnIdCtId = mysql_insert_id();
									 	
										$partyFlag = mysql_fetch_array(mysql_query("SELECT MAX(IFNULL(PARTYFLAG,0)) FROM fna_alustock WHERE PARTYID = '".$PARTYID."' AND PROJECTID = '".$PROJECTID."' AND SUBPROJECTID = '".$SUBPROJECTID."'"));
										$MAXpartyFlag = $partyFlag['MAX(IFNULL(PARTYFLAG,0))'];
										$NowMAXpartyFlag = $MAXpartyFlag + 1;
										
										$LotFlag = mysql_fetch_array(mysql_query("SELECT MAX(IFNULL(LOTFLAG,0)) FROM fna_alustock WHERE LOTNO = '".$LOTNO."' AND PROJECTID = '".$PROJECTID."' AND SUBPROJECTID = '".$SUBPROJECTID."'"));
										$MAXLotFlag = $LotFlag['MAX(IFNULL(LOTFLAG,0))'];
										$NowMAXLotFlag = $MAXLotFlag + 1;
										
										
										$aluLotQnty 			= mysql_fetch_array(mysql_query("SELECT LOTTOTQNTY FROM fna_alustock WHERE LOTNO = '".$LOTNO."' AND LOTFLAG = '".$MAXLotFlag."' AND PROJECTID = '".$PROJECTID."' AND SUBPROJECTID = '".$SUBPROJECTID."'"));
										$LotTotQnty 			= $aluLotQnty['LOTTOTQNTY'];
										$NowLotTotQnty 			= $aluLotQnty['LOTTOTQNTY'] + $quantity[$k];
										
										$partyLotQnty 			= mysql_fetch_array(mysql_query("SELECT PARTYTOTQNTY FROM fna_alustock WHERE PARTYID = '".$PARTYID."' AND PARTYFLAG = '".$MAXpartyFlag."' AND PROJECTID = '".$PROJECTID."' AND SUBPROJECTID = '".$SUBPROJECTID."'"));
										$partyLotTotQnty		= $partyLotQnty['PARTYTOTQNTY'];
										$NowPartyTotQnty		= $partyLotQnty['PARTYTOTQNTY'] + $quantity[$k];
										
										$insertStockQuery = "
															INSERT INTO 
																		fna_alustock
																					(
																						ENTRYSERIALNOID,
																						PRODUCTLOADUNLOADBKDNID,
																						PROJECTID,
																						SUBPROJECTID,
																						PARTYID,
																						PRODCATTYPEID,
																						PACKINGUNITID,
																						PRODUCTID,
																						LOTNO,
																						ENTRYDATE,
																						LOADQUANTITY,
																						LOTTOTQNTY,
																						PARTYTOTQNTY,
																						LOTFLAG,
																						PARTYFLAG,
																						WORKTYPEFLAG,
																						STATUS,
																						ENTDATE,
																						ENTTIME,
																						USERID
																					) 
																			VALUES
																					(
																						'".$MaxEntrySlNo."',
																						'".$loadUnloadBkdnIdCtId."',
																						'".$PROJECTID."',
																						'".$SUBPROJECTID."',
																						'".$PARTYID."',
																						'".$PRODCATTYPEID[$k]."',
																						'".$packingUnit[$k]."',
																						'".$PRODUCTID[$k]."',
																						'".$LOTNO."',
																						'".$ENTRYDATE."',
																						'".$quantity[$k]."',
																						'".$NowLotTotQnty."',
																						'".$NowPartyTotQnty."',
																						'".$NowMAXLotFlag."',
																						'".$NowMAXpartyFlag."',
																						'Load',
																						'Active',
																						'".$entDate."',
																						'".$entTime."',
																						'".$userId."'
																					)
									";
									
									
										$insertStockQueryStatement = mysql_query($insertStockQuery);
										//Update Product Stock table End
										
										//Update Labour Work History Table Start
										$LABOURIDQUERY  =mysql_fetch_array(mysql_query("SELECT LABCONTACTID FROM fna_labourcontact WHERE LABOURID = '".$LABOURID."'"));
										$LABCONTACTID = $LABOURIDQUERY['LABCONTACTID'];
										$QUERYLOADPRICE = mysql_fetch_array(mysql_query("SELECT LOADPRICE FROM fna_labourcontact_bkdn WHERE LABCONTACTID = '".$LABCONTACTID."' AND CHAMBERIDTO = '".$CHID[$k]."' and PACKINGUNITID = '".$packingUnit[$k]."'"));
										$LOADPRICE = $QUERYLOADPRICE['LOADPRICE'];
										$TOTBILLAMOUNT = $quantity[$k] * $LOADPRICE ;
										$globalLabourTotalBillAmount = $globalLabourTotalBillAmount + $TOTBILLAMOUNT ;
										
										
										$insertLabWorkHistQuery = "
															INSERT INTO 
																		fna_labourworkhistory
																					(
																						ENTRYSERIALNOID,
																						PROJECTID,
																						SUBPROJECTID,
																						LABOURID,
																						PARTYID,
																						PRODUCTLOADUNLOADBKDNID,
																						PRODCATTYPEID,
																						PRODUCTID,
																						PACKINGUNITID,
																						QUANTITY,
																						CHID,
																						BILLAMOUNT,
																						TOTBILLAMOUNT,
																						RECEIVENUMBER,
																						WORKTYPEFLAG,
																						STATUS,
																						ENTDATE,
																						ENTTIME,
																						USERID
																					) 
																			VALUES
																					(
																						'".$MaxEntrySlNo."',
																						'".$PROJECTID."',
																						'".$SUBPROJECTID."',
																						'".$LABOURID."',
																						'".$PARTYID."',
																						'".$loadUnloadBkdnIdCtId."',
																						'".$PRODCATTYPEID[$k]."',
																						'".$PRODUCTID[$k]."',
																						'".$packingUnit[$k]."',
																						'".$quantity[$k]."',
																						'".$CHID[$k]."',
																						'".$LOADPRICE."',
																						'".$TOTBILLAMOUNT."',
																						'".$nowMAXRECNO."',
																						'Load',
																						'Active',
																						'".$ENTRYDATE."',
																						'".$entTime."',
																						'".$userId."'
																					)
									"; 
									
									
									$insertLabWorkHistQueryStatement = mysql_query($insertLabWorkHistQuery);
									
									//Update Labour Work History Table End
									
									// Update FNA Bill Table Start
									$MAX_PARTY_FLAG_BILL = mysql_fetch_array(mysql_query("SELECT MAX(IFNULL(PARTYFLAG,0)) FROM fna_bill WHERE PARTYID = '".$PARTYID."'"));
									$MAXPARTY_FLAG_BILL 		= $MAX_PARTY_FLAG_BILL['MAX(IFNULL(PARTYFLAG,0))'];
									$NOW_MAX_PARTY_FLAG_BILL 	= $MAXPARTY_FLAG_BILL + 1 ;
									
									$MAX_PARTY_LOT_FLAG_QRY		= mysql_fetch_array(mysql_query("SELECT MAX(IFNULL(LOTFLAG,0)) FROM fna_bill WHERE PARTYID = '".$PARTYID."' AND LOTNO = '".$LOTNO."'"));
									$MAX_PARTY_LOT_FLAG 		= $MAX_PARTY_LOT_FLAG_QRY['MAX(IFNULL(LOTFLAG,0))'];
									$NOW_MAX_PARTY_LOT_FLAG 	= $MAX_PARTY_LOT_FLAG + 1 ;
									
									$TOT_AMOUNT_PARTY_BILL 		= mysql_fetch_array(mysql_query("SELECT * FROM fna_bill WHERE PARTYID = '".$PARTYID."' and PARTYFLAG = '".$MAXPARTY_FLAG_BILL."'"));
									$PARTY_TOT_AMOUNT_BILL 	= $TOT_AMOUNT_PARTY_BILL['TOTBILLAMOUNT'];
									$PARTY_BALANCE_BILL 	= $TOT_AMOUNT_PARTY_BILL['BALANCE_BILL'];
									
									$SESSIONID  =mysql_fetch_array(mysql_query("SELECT SESSIONID FROM fna_session WHERE PRODCATTYPEID = '".$PRODCATTYPEID[$k]."'"));
									$NOWSESSIONID = $SESSIONID['SESSIONID'];
									
									$TOTQUANTITY_PROD 	= $quantity[$k];
									
									
									$QUERYPRODFARE		= mysql_fetch_array(mysql_query("SELECT UNITFARE FROM fna_productfare WHERE PRODCATTYPEID = '".$PRODCATTYPEID[$k]."' AND PRODUCTID = '".$PRODUCTID[$k]."' AND PACKINGUNITID = '".$packingUnit[$k]."'"));
									$NOW_UNITFARE		= $QUERYPRODFARE['UNITFARE'];
									$NOW_FNA_BILLAMOUNT		= $quantity[$k] * $NOW_UNITFARE ; 
									$TOTBILLAMOUNT_PROD	= $NOW_FNA_BILLAMOUNT + $PARTY_TOT_AMOUNT_BILL ;
									$NOW_PARTY_BALANCE_BILL		= $PARTY_BALANCE_BILL + $NOW_FNA_BILLAMOUNT ;
									
									$globalPartyTotalBillAmount = $globalPartyTotalBillAmount + $NOW_FNA_BILLAMOUNT ; 
									
									
									$insertFNABillQuery = "
															INSERT INTO 
																		fna_bill
																				(
																					ENTRYSERIALNOID,
																					PROJECTID,
																					SUBPROJECTID,
																					SESSIONID,
																					PARTYID,
																					LOTNO,
																					RECEIVENUMBER,
																					PRODCATTYPEID,
																					PRODUCTID,
																					PACKINGUNITID,
																					QUANTITY,
																					TOTQUANTITY,
																					BILLAMOUNT,
																					TOTBILLAMOUNT,
																					BALANCE_BILL,
																					PARTYFLAG,
																					LOTFLAG,
																					ENTRYDATE,
																					STATUS,
																					ENTDATE,
																					ENTTIME,
																					USERID
																				) 
																		VALUES
																				(
																					'".$MaxEntrySlNo."',
																					'".$PROJECTID."',
																					'".$SUBPROJECTID."',
																					'".$NOWSESSIONID."',
																					'".$PARTYID."',
																					'".$LOTNO."',
																					'".$nowMAXRECNO."',
																					'".$PRODCATTYPEID[$k]."',
																					'".$PRODUCTID[$k]."',
																					'".$packingUnit[$k]."',
																					'".$quantity[$k]."',
																					'".$quantity[$k]."',
																					'".$NOW_FNA_BILLAMOUNT."',
																					'".$TOTBILLAMOUNT_PROD."',
																					'".$NOW_PARTY_BALANCE_BILL."',
																					'".$NOW_MAX_PARTY_FLAG_BILL."',
																					'".$NOW_MAX_PARTY_LOT_FLAG."',
																					'".$ENTRYDATE."',
																					'Active',
																					'".$entDate."',
																					'".$entTime."',
																					'".$userId."'
																				)
																		";
								
								
									$insertFNABillQueryStatement = mysql_query($insertFNABillQuery);
									// Update FNA Bill Table End
									
									// Upadate FNA Basta Table Start
				
									if($BASTA_QNTY[$k] !='' ){
							
										$MAXFLAG 			= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_basta"));
										$MAX_FLAG		 	= $MAXFLAG['MAX(FLAG)'];
										$NOW_MAX_FLAG	 	= $MAX_FLAG + 1;
										
										$BASTA_UNIT_PRICE_QRY		= mysql_fetch_array(mysql_query("SELECT UNITPRICE FROM fna_basta WHERE FLAG = '".$MAX_FLAG."'"));
										$BASTA_UNITPRICE	= $BASTA_UNIT_PRICE_QRY['UNITPRICE'];
										$BASTA_TOTPRICE		= $BASTA_UNITPRICE * $BASTA_QNTY[$k] ; 
										
										$SELLQNTY_QRY		= mysql_fetch_array(mysql_query("SELECT TOTSELLQNTY FROM fna_basta WHERE FLAG = '".$MAX_FLAG."'"));
										$TOTSELLQNTY		= $SELLQNTY_QRY['TOTSELLQNTY'];
										$TOT_SELLQNTY		= $TOTSELLQNTY + $BASTA_QNTY[$k] ;
										
										$BALANCE_QRY		= mysql_fetch_array(mysql_query("SELECT BALANCEQNTY FROM fna_basta WHERE FLAG = '".$MAX_FLAG."'"));
										$BALANCEQNTY	 	= $BALANCE_QRY['BALANCEQNTY'];
										$NOW_BALANCE		= $BALANCEQNTY - $BASTA_QNTY[$k] ;
										
										$TOTSELLPRICE_QRY	= mysql_fetch_array(mysql_query("SELECT TOTSELLPRICE FROM fna_basta WHERE FLAG = '".$MAX_FLAG."'"));
										$TOTSELLPRICE	 	= $TOTSELLPRICE_QRY['TOTSELLPRICE'];
										$NOW_TOTSELLPRICE	= $TOTSELLPRICE + $BASTA_TOTPRICE ;
										
										$insertQueryBasta = "
																INSERT INTO 
																			fna_basta
																					(
																						ENTRYSERIALNOID,
																						PARTYID,
																						LOTNO,
																						SELLQNTY,
																						TOTSELLQNTY,
																						BALANCEQNTY,
																						UNITPRICE,
																						SELLPRICE,
																						TOTSELLPRICE,
																						ENTRYDATE,
																						STATUS,
																						FLAG,
																						ENTDATE,
																						ENTTIME,
																						USERID
																					) 
																			VALUES
																					(
																						'".$MaxEntrySlNo."',
																						'".$PARTYID."',
																						'".$LOTNO."',
																						'".$BASTA_QNTY[$k]."',
																						'".$TOT_SELLQNTY."',
																						'".$NOW_BALANCE."',
																						'".$BASTA_UNITPRICE."',
																						'".$BASTA_TOTPRICE."',
																						'".$NOW_TOTSELLPRICE."',
																						'".$ENTRYDATE."',
																						'Active',
																						'".$NOW_MAX_FLAG."',
																						'".$entDate."',
																						'".$entTime."',
																						'".$userId."'
																					)
													";
										$insertQueryBastaStatement = mysql_query($insertQueryBasta);
								
									}
													
								// Upadate FNA Basta Table End
								
								// Upadate FNA Loan Table Start
								
								if($carloan[$k] !='' ){
								
								$MAXPARTYFLAG_ALU_QRY 		= mysql_fetch_array(mysql_query("SELECT MAX(PARTYFLAG) FROM fna_alustock WHERE PARTYID = '".$PARTYID."'"));
								$MAXPARTY_FLAG_ALU	 		= $MAXPARTYFLAG_ALU_QRY['MAX(PARTYFLAG)'];
								
								
								$PARTY_TOTAL_BASTA_QRY	= mysql_fetch_array(mysql_query("SELECT PARTYTOTQNTY FROM fna_alustock WHERE PARTYID = '".$PARTYID."' AND PARTYFLAG = '".$MAXPARTY_FLAG_ALU."'"));
								$PARTY_TOTAL_BASTA 	= $PARTY_TOTAL_BASTA_QRY['PARTYTOTQNTY'];
								
								$MAXPARTYFLAG 		= mysql_fetch_array(mysql_query("SELECT MAX(PARTYFLAG) FROM fna_loan WHERE PARTYID = '".$PARTYID."'"));
								$MAXPARTY_FLAG	 	= $MAXPARTYFLAG['MAX(PARTYFLAG)'];
								$NOW_MAXPARTY_FLAG 	= $MAXPARTY_FLAG + 1;
								
								$LOAN_NUM_QRY 			= mysql_fetch_array(mysql_query("SELECT MAX(LOAN_NUMBER) FROM fna_loan WHERE PARTYID = '".$PARTYID."'"));
								$MAXLOAN_NUMBER	 		= $LOAN_NUM_QRY['MAX(LOAN_NUMBER)'];
								$NOW_MAXLOAN_NUMBER 	= $MAXLOAN_NUMBER + 1;
								
								$MAXLOANFLAG 		= mysql_fetch_array(mysql_query("SELECT MAX(LOANFLAG) FROM fna_loan WHERE PARTYID = '".$PARTYID."'"));
								$MAXLOAN_FLAG	 	= $MAXLOANFLAG['MAX(LOANFLAG)'];
								$NOW_MAXLOAN_FLAG 	= $MAXLOAN_FLAG + 1;
								
								
								$BALANCE_QRY		= mysql_fetch_array(mysql_query("SELECT LOAN_BALANCE FROM fna_loan WHERE PARTYID = '".$PARTYID."' AND PARTYFLAG = '".$MAXPARTY_FLAG."'"));
								$BALANCE		 	= $BALANCE_QRY['LOAN_BALANCE'];
								$NOW_BALANCE		= $BALANCE + $carloan[$k] ;
								
								$PARTYNAME_QRY 			= mysql_fetch_array(mysql_query("SELECT PARTYNAME FROM fna_party WHERE PARTYID = '".$PARTYID."'"));
								$PARTYNAME				= $PARTYNAME_QRY['PARTYNAME'];
								$LOANPURPOSE			= 'Loan Payment to '.$PARTYNAME . ' ,  Car Loan';
							
								$MAX_ALUPRICE_FLAG_QRY 		= mysql_fetch_array(mysql_query("SELECT MAX(PRICEFLAG) FROM alu_presentprice "));
								$MAX_ALUPRICE_FLAG	 		= $MAX_ALUPRICE_FLAG_QRY['MAX(PRICEFLAG)'];
								//$NOW_MAX_ALUPRICE_FLAG 		= $MAX_ALUPRICE_FLAG + 1;
								
								$ALU_PRESENTPRICE_QRY	= mysql_fetch_array(mysql_query("SELECT PRESENTPRICE FROM alu_presentprice WHERE PRICEFLAG = '".$MAX_ALUPRICE_FLAG."'"));
								$ALU_PRESENT_PRICE	 	= $ALU_PRESENTPRICE_QRY['PRESENTPRICE'];
								
								$PARTY_TOTAL_BASTA_PRICE	= $ALU_PRESENT_PRICE * $PARTY_TOTAL_BASTA ; 
								
								$LOAN_FOR_PAY				= ($PARTY_TOTAL_BASTA_PRICE * 50)/100 ;
								
								$Elligible_For_Loan			= $LOAN_FOR_PAY - $BALANCE ;
								
								if($Elligible_For_Loan >= $carloan[$k]){
										
										$insertQueryLoan = "
																INSERT INTO 
																			fna_loan
																					(
																						ENTRYSERIALNOID,
																						PROJECTID,
																						SUBPROJECTID,
																						LOANTYPEID,
																						PARTYID,
																						LOAN_NUMBER,
																						LOTNO,
																						LOANDATE,
																						LOAN_PAYMENTDATE,
																						LOANAMOUNT,
																						PRINCIPALAMOUNT,
																						RESTOFTHE_AMOUNT,
																						LOANPAYMENT,
																						INTERESTRATE,
																						INTERESTAMOUNT,
																						LOAN_BALANCE,
																						ENTRYDATE,
																						LOANPURPOSE,
																						PARTYFLAG,
																						LOANFLAG,
																						STATUS,
																						ENTDATE,
																						ENTTIME,
																						USERID
																					) 
																			VALUES
																					(
																						'".$MaxEntrySlNo."',
																						'".$PROJECTID."',
																						'".$SUBPROJECTID."',
																						'1',
																						'".$PARTYID."',
																						'".$NOW_MAXLOAN_NUMBER."',
																						'".$LOTNO."',
																						'".$ENTRYDATE."',
																						'',
																						'".$carloan[$k]."',
																						'0',
																						'".$carloan[$k]."',
																						'0',
																						'18',
																						'0',
																						'".$NOW_BALANCE."',
																						'".$ENTRYDATE."',
																						'".$LOANPURPOSE."',
																						'".$NOW_MAXPARTY_FLAG."',
																						'".$NOW_MAXLOAN_FLAG."',
																						'Active',
																						'".$entDate."',
																						'".$entTime."',
																						'".$userId."'
																					)
													";
										$insertQueryLoanStatement = mysql_query($insertQueryLoan);
										
										//-----------------------------Update Daily Income Expanse Table Start-----------------------------
										$INEX_FLAG	 			= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_daily_income_expanse"));
										$MAXINEX_FLAG	 		= $INEX_FLAG['MAX(FLAG)'];
										$NOW_MAXINEX_FLAG	 	= $MAXINEX_FLAG + 1;
										
										$PARTYNAME_QRY 			= mysql_fetch_array(mysql_query("SELECT PARTYNAME FROM fna_party WHERE PARTYID = '".$PARTYID."'"));
										$PARTYNAME				= $PARTYNAME_QRY['PARTYNAME'];
										$NOW_DESCRIPTION		= 'Car Loan Payment to '.$PARTYNAME . '   Car Loan..Alu ';
										
										$insertDailyInExQuery = "
																INSERT INTO 
																				fna_daily_income_expanse
																											(
																												ENTRYSERIALNOID,
																												PROJECTID,
																												SUBPROJECTID,
																												DATE,
																												EXPANSE,
																												DESCRIPTION,
																												FLAG,
																												STATUS,
																												ENTDATE,
																												ENTTIME,
																												USERID
																											) 
																									VALUES
																											(
																												'".$MaxEntrySlNo."',
																												'".$PROJECTID."',
																												'".$SUBPROJECTID."',
																												'".$ENTRYDATE."',
																												'".$carloan[$k]."',
																												'".$NOW_DESCRIPTION."',
																												'".$NOW_MAXINEX_FLAG."',
																												'Active',
																												'".$entDate."',
																												'".$entTime."',
																												'".$userId."'
																											)
																	";
												
												
												$insertDailyInExQueryStatement = mysql_query($insertDailyInExQuery);
									
									//----------------------------Update Daily Income Expanse Table End --------------------------
										}else{
											$msg = "<span class='errorMsg'>Sorry, You are not Elligible for [ $carloan[$k] ] This Amount....!  // You are Elligible for [ $Elligible_For_Loan ] this amount...</span>";
											//$msg = "<span class='validMsg'>You are Elligible for [ $Elligible_For_Loan ] This Amount....!</span>";
										}
										
								}
										
							// Upadate FNA Loan Table End
							
							}else{
								
								$PRODLOADUNLOAD_DELETE_QRY		= "DELETE FROM `fna_productloadunload`
																			WHERE PRODUCTLOADUNLOADID = '".$loadCtId."'
												";
												
								$PRODLOADUNLOAD_DELETE_QRYStatement = mysql_query($PRODLOADUNLOAD_DELETE_QRY);
								$msg = "<span class='errorMsg'>Sorry! Please Unload to PC first ..... then Load to Store.....!</span>";
								}
										
						$k++;
					}
				// Upadate FNA Labour Bill Table Start
				$MAXLABFLAG = mysql_fetch_array(mysql_query("SELECT MAX(LABOURFLAG) FROM fna_labourbill WHERE LABOURID = '".$LABOURID."'"));
				$MAXLABOUR_FLAG = $MAXLABFLAG['MAX(LABOURFLAG)'];
				$NOW_MAXLAB_FLAG = $MAXLABOUR_FLAG + 1;
				$BAL_AMOUNT = mysql_fetch_array(mysql_query("SELECT BALANCEAMOUNT FROM fna_labourbill WHERE LABOURID = '".$LABOURID."' AND LABOURFLAG = '".$MAXLABOUR_FLAG."'"));
				$LAB_BAL_AMOUNT = $BAL_AMOUNT['BALANCEAMOUNT'];
				if(($MAXLABOUR_FLAG == 0) or ($MAXLABOUR_FLAG ='')){
					$NOW_LAB_BALAMOUNT = $globalLabourTotalBillAmount ;
				}else{
					$NOW_LAB_BALAMOUNT = $LAB_BAL_AMOUNT + $globalLabourTotalBillAmount ;
				}
				$insertLabourBillQuery = "
										INSERT INTO 
													fna_labourbill
															(
																ENTRYSERIALNOID,
																PROJECTID,
																SUBPROJECTID,
																LABOURID,
																PARTYID,
																PRODUCTLOADUNLOADID,
																BILLAMOUNT,
																PAYMENTAMOUNT,
																BALANCEAMOUNT,
																LABOURFLAG,
																ENTRYDATE,
																STATUS,
																ENTDATE,
																ENTTIME,
																USERID
															) 
													VALUES
															(
																'".$MaxEntrySlNo."',
																'".$PROJECTID."',
																'".$SUBPROJECTID."',
																'".$LABOURID."',
																'".$PARTYID."',
																'".$loadCtId."',
																'".$globalLabourTotalBillAmount."',
																'0',
																'".$NOW_LAB_BALAMOUNT."',
																'".$NOW_MAXLAB_FLAG."',
																'".$ENTRYDATE."',
																'Active',
																'".$entDate."',
																'".$entTime."',
																'".$userId."'
															)
					"; 
					
					
					$insertLabourBillQueryStatement = mysql_query($insertLabourBillQuery);
					
				// Upadate FNA Labour Bill Table End
				
				
				// Upadate FNA Party Bill Table Start	
				
				$MAX_PARTY_FLAG = mysql_fetch_array(mysql_query("SELECT MAX(PARTYFLAG) FROM fna_partybill WHERE PARTYID = '".$PARTYID."' AND PURSELLFLAG = 'Load'"));
				$MAXPARTY_FLAG = $MAX_PARTY_FLAG['MAX(PARTYFLAG)'];
				$NOW_MAX_PARTY_FLAG = $MAXPARTY_FLAG + 1;
				$BAL_AMOUNT_PARTY_ALU = mysql_fetch_array(mysql_query("SELECT BALANCEAMOUNT FROM fna_partybill WHERE PARTYID = '".$PARTYID."' AND PURSELLFLAG = 'Load' AND PARTYFLAG = '".$MAXPARTY_FLAG."'"));
				$PARTY_BAL_AMOUNT_ALU = $BAL_AMOUNT_PARTY_ALU['BALANCEAMOUNT'];
				
				if(($MAXPARTY_FLAG == 0) or ($MAXPARTY_FLAG ='')){
					$NOW_PARTY_BALAMOUNT_ALU = $globalPartyTotalBillAmount ;
				}else{
					$NOW_PARTY_BALAMOUNT_ALU = $PARTY_BAL_AMOUNT_ALU + $globalPartyTotalBillAmount ; 
				}
				$insertPartyBillQuery = "
										INSERT INTO 
													fna_partybill
															(
																ENTRYSERIALNOID,
																PROJECTID,
																SUBPROJECTID,
																PARTYID,
																RECEIVENUMBER,
																SELL_BILLAMOUNT,
																PAYMENTAMOUNT,
																RECEIVEAMOUNT,
																BALANCEAMOUNT,
																ENTRYDATE,
																PARTYFLAG,
																STATUS,
																PURSELLFLAG,
																ENTDATE,
																ENTTIME,
																USERID
															) 
													VALUES
															(
																'".$MaxEntrySlNo."',
																'".$PROJECTID."',
																'".$SUBPROJECTID."',
																'".$PARTYID."',
																'".$nowMAXRECNO."',
																'".$globalPartyTotalBillAmount."',
																'0',
																'0',
																'".$NOW_PARTY_BALAMOUNT_ALU."',
																'".$ENTRYDATE."',
																'".$NOW_MAX_PARTY_FLAG."',
																'Active',
																'Load',
																'".$entDate."',
																'".$entTime."',
																'".$userId."'
															)
														"; 
					
					
							$insertPartyBillQueryStatement = mysql_query($insertPartyBillQuery);
						// Upadate FNA Party Bill Table End
				
				} else {
					$msg = "<span class='errorMsg'>Sorry! System Error Last!</span>";
				}
			
				
		}
			
			
			return $msg;
			
	}
		// Insert Load Alu Information  End
		
		// Insert Alu Unload Information Start 
		function InsertAluUnloadInfo($userId){
			
			$PROJECTID 		= $_REQUEST['PROJECTID'];
			$SUBPROJECTID 	= $_REQUEST['SUBPROJECTID'];
			$PARTYID 		= $_REQUEST['PARTYID'];
			$LABOURID 		= $_REQUEST['LABOURID'];
			$ENTRYDATE 		= $_REQUEST['ENTRYDATE'];
			$LOTNO	 		= $_REQUEST['LOTNO'];
			
			$basta_qnty					= $_REQUEST["BASTAQNTY"]; 
			$FNA_BILLAMOUNT				= $_REQUEST["BILLAMOUNT"];
			$BASTALOANAMOUNT			= $_REQUEST["BASTALOANAMOUNT"];
			$SERVICECHARGE				= $_REQUEST["SERVICECHARGE"];
			$OTHERSINCOME				= $_REQUEST["OTHERSINCOME"];
			$UNITFARE					= $_REQUEST["UNITFARE"];
			
			$TOTAL_FNA_BILL_RECEIVE		= $_REQUEST["UNLOAD_BILL_RECEIVED_WITHOUT_BOOKING"];
			$UNLOAD_CARLOANPAYMENT_NEW	= $_REQUEST["CARLOANPAYMENT"];
			$UNLOAD_CARLOANDEDUCTION	= $_REQUEST["CARLOANDEDUCTION"];
			$BOOKINGMONEY				= $_REQUEST["BOOKINGMONEY"];
			$UNLOAD_BASTA_PAYMENT		= $_REQUEST["UNLOAD_BASTA_PAYMENT"];
			$UNLOADBILL					= $_REQUEST["UNLOADBILL"];
			$LOANID						= $_REQUEST["LOANID"];
			
			if($UNLOAD_CARLOANPAYMENT_NEW >= $UNLOAD_CARLOANDEDUCTION){
				
				$UNLOAD_CARLOANPAYMENT		= $UNLOAD_CARLOANPAYMENT_NEW - $UNLOAD_CARLOANDEDUCTION ; 
			}else{
				$UNLOAD_CARLOANPAYMENT 		= 0;
			}
			
			
			
			$entDate 			= date('Y-m-d'); 
			$entTime 			= date('H:i:s A');
			
			$queryLoadUnloadId	 	= mysql_fetch_array(mysql_query("SELECT MIN(PRODUCTLOADUNLOADID) FROM fna_productloadunload WHERE LOTNO = '".$LOTNO."'"));
			$minLoadUnlId			= $queryLoadUnloadId['MIN(PRODUCTLOADUNLOADID)'];
			
			$queryProdId		 	= mysql_fetch_array(mysql_query("SELECT * FROM fna_productloadunloadbkdn WHERE PRODUCTLOADUNLOADID = '".$minLoadUnlId."'"));
			
			$productId				= $queryProdId['PRODUCTID'];
			$productCatTId			= $queryProdId['PRODCATTYPEID'];
			$packunitId				= $queryProdId['PACKINGUNITID'];
			$chId					= $queryProdId['CHID'];
			
				
				$EntrySerial_Query_Flag = mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_entryserialno"));
				$MaxFlagEntrySl			= $EntrySerial_Query_Flag['MAX(FLAG)'];
				
				$EntrySerial_Query_No	= mysql_fetch_array(mysql_query("SELECT MAX(ENTRYSERIALNOID) FROM fna_entryserialno"));
				$MaxEntrySlNo			= $EntrySerial_Query_No['MAX(ENTRYSERIALNOID)'] + 1;
		
		
				$insertQueryEntrySl = "
										INSERT INTO 
													fna_entryserialno
																	(
																		ENTRYSERIALNO,
																		PROJECTID,
																		SUBPROJECTID,
																		ENTRYDATE,
																		FLAG,
																		STATUS,
																		ENTDATE,
																		ENTTIME,
																		USERID
																	) 
															VALUES
																	(
																		'".$MaxEntrySlNo."',
																		'".$PROJECTID."',
																		'".$SUBPROJECTID."',
																		'".$ENTRYDATE."',
																		'".$MaxFlagEntrySl."',
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									";
				$insertQueryEntrySlStatement = mysql_query($insertQueryEntrySl);
				
				$PARTY_FLAG_QUERY 	= mysql_fetch_array(mysql_query("SELECT MAX(PARTYFLAG) FROM fna_alustock WHERE PARTYID = '".$PARTYID."'"));
				$MaxPartyFlag 		= $PARTY_FLAG_QUERY['MAX(PARTYFLAG)'];
				
				$LOT_FLAG_QUERY 	= mysql_fetch_array(mysql_query("SELECT MAX(LOTFLAG) FROM fna_alustock WHERE LOTNO = '".$LOTNO."'"));
				$MaxLotFlag 		= $LOT_FLAG_QUERY['MAX(LOTFLAG)'];
				
				$queryPartyCheck = mysql_fetch_array(mysql_query("SELECT PARTYTOTQNTY FROM fna_alustock WHERE PARTYID = '".$PARTYID."' AND PARTYFLAG = '".$MaxPartyFlag."'"));
				$TotalPartyQnty = $queryPartyCheck['PARTYTOTQNTY'];	
				
				$queryLotCheck = mysql_fetch_array(mysql_query("SELECT LOTTOTQNTY FROM fna_alustock WHERE LOTNO = '".$LOTNO."' AND LOTFLAG = '".$MaxLotFlag."'"));
				$TotalLotQnty = $queryLotCheck['LOTTOTQNTY'];	
				
					if($TotalLotQnty >= $basta_qnty){
						
							$LoanQuery 	= "SELECT	
												SUM(LOANAMOUNT) LOANAMOUNT,
												SUM(LOANPAYMENT) LOANPAYMENT			
											FROM fna_loan 
											WHERE PARTYID = '".$PARTYID."' 
											AND PROJECTID =  '".$PROJECTID."'
											AND SUBPROJECTID = '".$SUBPROJECTID."'
											AND LOTNO = ''
										";
							$LoanQueryStatement				= mysql_query($LoanQuery);
							while($LoanQueryStatementData	= mysql_fetch_array($LoanQueryStatement)){
	
							//Dynamic Row Start
								$LOANAMOUNT 		= $LoanQueryStatementData['LOANAMOUNT'];
								$LOANPAYMENT 		= $LoanQueryStatementData['LOANPAYMENT'];
							
							}
							
							$ALU_PRICE_FLAG_QRY 	= mysql_fetch_array(mysql_query("SELECT MAX(PRICEFLAG) FROM alu_presentprice "));
							$MaxPriceFlag 			= $ALU_PRICE_FLAG_QRY['MAX(PRICEFLAG)'];
							
							$ALU_PRICE_QRY				= mysql_fetch_array(mysql_query("SELECT PRESENTPRICE FROM alu_presentprice WHERE PRICEFLAG = '".$MaxPriceFlag."'"));
							$ALU_PRESENT_UNITPRICE		= $ALU_PRICE_QRY['PRESENTPRICE'];
							
							$PARTY_TOT_BASTA_PRICE		= $ALU_PRESENT_UNITPRICE * $TotalPartyQnty ;
							$PRESENT_ALU_FARE			= $UNITFARE ;
							$PARTY_TOT_BASTA_FARE		= $PRESENT_ALU_FARE * $TotalPartyQnty ;	
							$NOW_PARTY_BALANCE			= $PARTY_TOT_BASTA_PRICE - $PARTY_TOT_BASTA_FARE ; 
							
							$BALANCE_LOAN_AMOUNT		= $LOANAMOUNT - $LOANPAYMENT ; 
							
							
							if($NOW_PARTY_BALANCE >= $BALANCE_LOAN_AMOUNT){
								
								$BastaQuery 	= "SELECT	
														SUM(SELLPRICE) SELLPRICE,
														SUM(RECEIVEDAMOUNT) RECEIVEDAMOUNT			
													FROM fna_basta 
													WHERE PARTYID = '".$PARTYID."' 
													AND LOTNO = '".$LOTNO."'
													ORDER BY LOTNO ASC
												";
							$BastaQueryStatement				= mysql_query($BastaQuery);
							while($BastaQueryStatementData		= mysql_fetch_array($BastaQueryStatement)){
	
							//Dynamic Row Start
								$SELLPRICE			= $BastaQueryStatementData['SELLPRICE'];
								$RECEIVEDAMOUNT		= $BastaQueryStatementData['RECEIVEDAMOUNT'];
							
							}
							$TOTAL_RECEIVEDAMOUNT 	= $RECEIVEDAMOUNT + $BASTALOANAMOUNT ;
							
							if($BASTALOANAMOUNT >= $UNLOAD_BASTA_PAYMENT){
										
							//This section work for multiple entry within 5 mints start.
							$getEntTimeResult = mysql_fetch_array(mysql_query("SELECT MAX(ENTTIME) FROM fna_productloadunload where PARTYID='".$PARTYID."' AND ENTDATE='".$entDate."' AND LOTNO = '".$LOTNO."'"));
							$getEntTime = $getEntTimeResult['MAX(ENTTIME)'];
							
							
							if(empty($getEntTime)){
								$duration = 100;
							}else{
								$exp = explode(" ",$getEntTime);
								$assigned_time = $exp[0];
								$completed_time = date('H:i:s');   
							
								$d1 = new DateTime($assigned_time);
								$d2 = new DateTime($completed_time);
								$interval = $d2->diff($d1);
								
								$duration =  $interval->format('%I');
							}
							//This section work for multiple entry within 5 mints End.
							if($duration > 5){
								// Insert Here
							}else{
								// Error Message generate here.
							}
							
							
							$TOT_UNLOAD_BILL		= $TOTAL_FNA_BILL_RECEIVE - $BOOKINGMONEY ;
							
							if ($FNA_BILLAMOUNT >= $TOT_UNLOAD_BILL){
							
								$NOW_FNA_BILL_RECEIVE_AMOUNT	= ($FNA_BILLAMOUNT + $BOOKINGMONEY )  - ($UNLOAD_CARLOANPAYMENT + $UNLOAD_BASTA_PAYMENT + $UNLOAD_CARLOANDEDUCTION);
								
									$MAXDELCHALLNO = mysql_fetch_array(mysql_query("SELECT MAX(IFNULL(DELIVERYCHALLANNUMBER,0)) FROM fna_productloadunload "));
									$maxNo = $MAXDELCHALLNO['MAX(IFNULL(DELIVERYCHALLANNUMBER,0))'];
									if($maxNo == 0 or $maxNo =''){
											$nowMAXDELCHALLNO = $maxNo + 1;
										}else{
											$nowMAXDELCHALLNO = $maxNo + 1;	
										}
										
											$maxFlagQry			= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_productloadunload"));
											$maxFlag			= $maxFlagQry['MAX(FLAG)'];
											$Now_maxFlag		= $maxFlag + 1;
											
											$insertQuery = "
															INSERT INTO 
																		fna_productloadunload
																						(
																							ENTRYSERIALNOID,
																							PROJECTID,
																							SUBPROJECTID,
																							PARTYID,
																							LABOURID,
																							ENTRYDATE,
																							DELIVERYCHALLANNUMBER,
																							LOTNO,
																							FLAG,
																							STATUS,
																							ENTDATE,
																							ENTTIME,
																							USERID
																						) 
																				VALUES
																						(
																							'".$MaxEntrySlNo."',
																							'".$PROJECTID."',
																							'".$SUBPROJECTID."',
																							'".$PARTYID."',
																							'".$LABOURID."',
																							'".$ENTRYDATE."',
																							'".$nowMAXDELCHALLNO."',
																							'".$LOTNO."',
																							'".$Now_maxFlag."',
																							'Active',
																							'".$entDate."',
																							'".$entTime."',
																							'".$userId."'
																						)
																					"; 
													if(mysql_query($insertQuery)){
												
												$loadCtId = mysql_insert_id();
												
												
												$k = 0;
												$globalLabourTotalBillAmount = 0;
												$globalPartyTotalBillAmount = 0;
										
												$insertbkdnQuery = "
															INSERT INTO 
																		fna_productloadunloadbkdn
																						(
																							ENTRYSERIALNOID,
																							PRODUCTLOADUNLOADID,
																							PRODCATTYPEID,
																							PRODUCTID,
																							PACKINGUNITID,
																							QUANTITY,
																							STATUS,
																							ENTDATE,
																							ENTTIME,
																							USERID
																						) 
																				VALUES
																						(
																							'".$MaxEntrySlNo."',
																							'".$loadCtId."',
																							'".$productCatTId."',
																							'".$productId."',
																							'".$packunitId."',
																							'".$basta_qnty."',
																							'Active',
																							'".$entDate."',
																							'".$entTime."',
																							'".$userId."'
																						)
														"; 
														
														
														$insertbkdnQueryStatement = mysql_query($insertbkdnQuery);
														if($insertbkdnQueryStatement){
															$msg = "<span class='validMsg'>Labour Information [$loadCtId] added sucessfully</span>";
														}else{
															$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
															break;
															}
															
															//Update Product Stock table Start
															
															$loadUnloadBkdnIdCtId = mysql_insert_id();
															
															$partyFlag = mysql_fetch_array(mysql_query("SELECT MAX(IFNULL(PARTYFLAG,0)) FROM fna_alustock WHERE PARTYID = '".$PARTYID."'"));
															$MAXpartyFlag = $partyFlag['MAX(IFNULL(PARTYFLAG,0))'];
															$NowMAXpartyFlag = $MAXpartyFlag + 1;
															
															$LotFlag = mysql_fetch_array(mysql_query("SELECT MAX(IFNULL(LOTFLAG,0)) FROM fna_alustock WHERE LOTNO = '".$LOTNO."'"));
															$MAXLotFlag = $LotFlag['MAX(IFNULL(LOTFLAG,0))'];
															$NowMAXLotFlag = $MAXLotFlag + 1;
															
															
															$aluLotQnty 			= mysql_fetch_array(mysql_query("SELECT LOTTOTQNTY FROM fna_alustock WHERE LOTNO = '".$LOTNO."' AND LOTFLAG = '".$MAXLotFlag."'"));
															$LotTotQnty 			= $aluLotQnty['LOTTOTQNTY'];
															$NowLotTotQnty 			= $aluLotQnty['LOTTOTQNTY'] - $basta_qnty;
															
															$partyLotQnty 			= mysql_fetch_array(mysql_query("SELECT PARTYTOTQNTY FROM fna_alustock WHERE PARTYID = '".$PARTYID."' AND PARTYFLAG = '".$MAXpartyFlag."'"));
															$partyLotTotQnty		= $partyLotQnty['PARTYTOTQNTY'];
															$NowPartyTotQnty		= $partyLotQnty['PARTYTOTQNTY'] - $basta_qnty;
																	
																	
																	$insertStockQuery = "
																							INSERT INTO 
																										fna_alustock
																													(
																														ENTRYSERIALNOID,
																														PRODUCTLOADUNLOADBKDNID,
																														PROJECTID,
																														SUBPROJECTID,
																														PARTYID,
																														PRODCATTYPEID,
																														PACKINGUNITID,
																														PRODUCTID,
																														LOTNO,
																														ENTRYDATE,
																														UNLOADQUANTITY,
																														LOTTOTQNTY,
																														PARTYTOTQNTY,
																														LOTFLAG,
																														PARTYFLAG,
																														WORKTYPEFLAG,
																														STATUS,
																														ENTDATE,
																														ENTTIME,
																														USERID
																													) 
																											VALUES
																													(
																														'".$MaxEntrySlNo."',
																														'".$loadUnloadBkdnIdCtId."',
																														'".$PROJECTID."',
																														'".$SUBPROJECTID."',
																														'".$PARTYID."',
																														'".$productCatTId."',
																														'".$packunitId."',
																														'".$productId."',
																														'".$LOTNO."',
																														'".$ENTRYDATE."',
																														'".$basta_qnty."',
																														'".$NowLotTotQnty."',
																														'".$NowPartyTotQnty."',
																														'".$NowMAXLotFlag."',
																														'".$NowMAXpartyFlag."',
																														'Unload',
																														'Active',
																														'".$entDate."',
																														'".$entTime."',
																														'".$userId."'
																													)
																	";
																
																
																$insertStockQueryStatement = mysql_query($insertStockQuery);
														
														
															//Update Product Stock table End
															
															//Update Labour Work History Table Start
															$LABOURIDQUERY  =mysql_fetch_array(mysql_query("SELECT LABCONTACTID FROM fna_labourcontact WHERE LABOURID = '".$LABOURID."'"));
															$LABCONTACTID = $LABOURIDQUERY['LABCONTACTID'];
															$QUERYUNLOADPRICE = mysql_fetch_array(mysql_query("SELECT UNLOADPRICE FROM fna_labourcontact_bkdn WHERE LABCONTACTID = '".$LABCONTACTID."' AND CHAMBERIDTO = '".$chId."' and PACKINGUNITID = '".$packunitId."'"));
															$UNLOADPRICE = $QUERYUNLOADPRICE['UNLOADPRICE'];
															$TOTBILLAMOUNT = $basta_qnty * $UNLOADPRICE ;
															$globalLabourTotalBillAmount = $globalLabourTotalBillAmount + $TOTBILLAMOUNT ;
															
															
															$insertLabWorkHistQuery = "
																				INSERT INTO 
																							fna_labourworkhistory
																										(
																											ENTRYSERIALNOID,
																											PROJECTID,
																											SUBPROJECTID,
																											LABOURID,
																											PARTYID,
																											PRODUCTLOADUNLOADBKDNID,
																											PRODCATTYPEID,
																											PRODUCTID,
																											PACKINGUNITID,
																											QUANTITY,
																											CHID,
																											BILLAMOUNT,
																											TOTBILLAMOUNT,
																											DELIVERYCHALLANNUMBER,
																											WORKTYPEFLAG,
																											STATUS,
																											ENTDATE,
																											ENTTIME,
																											USERID
																										) 
																								VALUES
																										(
																											'".$MaxEntrySlNo."',
																											'".$PROJECTID."',
																											'".$SUBPROJECTID."',
																											'".$LABOURID."',
																											'".$PARTYID."',
																											'".$loadUnloadBkdnIdCtId."',
																											'".$productCatTId."',
																											'".$productId."',
																											'".$packunitId."',
																											'".$basta_qnty."',
																											'".$chId."',
																											'".$UNLOADPRICE."',
																											'".$TOTBILLAMOUNT."',
																											'".$nowMAXDELCHALLNO."',
																											'Unload',
																											'Active',
																											'".$ENTRYDATE."',
																											'".$entTime."',
																											'".$userId."'
																										)
														";
														
														
														$insertLabWorkHistQueryStatement = mysql_query($insertLabWorkHistQuery);
														
														//Update Labour Work History Table End
														
					
														// Upadate FNA Labour Bill Table Start
														$MAXLABFLAG = mysql_fetch_array(mysql_query("SELECT MAX(LABOURFLAG) FROM fna_labourbill WHERE LABOURID = '".$LABOURID."'"));
														$MAXLABOUR_FLAG = $MAXLABFLAG['MAX(LABOURFLAG)'];
														$NOW_MAXLAB_FLAG = $MAXLABOUR_FLAG + 1;
														$BAL_AMOUNT = mysql_fetch_array(mysql_query("SELECT BALANCEAMOUNT FROM fna_labourbill WHERE LABOURID = '".$LABOURID."' AND LABOURFLAG = '".$MAXLABOUR_FLAG."'"));
														$LAB_BAL_AMOUNT = $BAL_AMOUNT['BALANCEAMOUNT'];
														if(($MAXLABOUR_FLAG == 0) or ($MAXLABOUR_FLAG ='')){
															$NOW_LAB_BALAMOUNT = $globalLabourTotalBillAmount ;
														}else{
															$NOW_LAB_BALAMOUNT = $LAB_BAL_AMOUNT + $globalLabourTotalBillAmount ;
														}
														$insertLabourBillQuery = "
																				INSERT INTO 
																							fna_labourbill
																									(
																										ENTRYSERIALNOID,
																										PROJECTID,
																										SUBPROJECTID,
																										LABOURID,
																										PARTYID,
																										PRODUCTLOADUNLOADID,
																										BILLAMOUNT,
																										PAYMENTAMOUNT,
																										BALANCEAMOUNT,
																										LABOURFLAG,
																										ENTRYDATE,
																										STATUS,
																										ENTDATE,
																										ENTTIME,
																										USERID
																									) 
																							VALUES
																									(
																										'".$MaxEntrySlNo."',
																										'".$PROJECTID."',
																										'".$SUBPROJECTID."',
																										'".$LABOURID."',
																										'".$PARTYID."',
																										'".$loadCtId."',
																										'".$globalLabourTotalBillAmount."',
																										'0',
																										'".$NOW_LAB_BALAMOUNT."',
																										'".$NOW_MAXLAB_FLAG."',
																										'".$ENTRYDATE."',
																										'Active',
																										'".$entDate."',
																										'".$entTime."',
																										'".$userId."'
																									)
															"; 
															
															
															$insertLabourBillQueryStatement = mysql_query($insertLabourBillQuery);
															
														// Upadate FNA Labour Bill Table End
														
														// Update FNA Bill Table Start
														
														$MAXRECNO = mysql_fetch_array(mysql_query("SELECT MAX(IFNULL(RECEIVENUMBER,0)) FROM fna_productloadunload "));
														$maxNo = $MAXRECNO['MAX(IFNULL(RECEIVENUMBER,0))'];
														if($maxNo == 0){
																$nowMAXRECNO = $maxNo + 1;
															}else{
																$nowMAXRECNO = $maxNo + 1;	
															}
															
															
														$MAX_PARTY_FLAG_BILL = mysql_fetch_array(mysql_query("SELECT MAX(IFNULL(PARTYFLAG,0)) FROM fna_bill WHERE PARTYID = '".$PARTYID."'"));
														$MAXPARTY_FLAG_BILL 		= $MAX_PARTY_FLAG_BILL['MAX(IFNULL(PARTYFLAG,0))'];
														$NOW_MAX_PARTY_FLAG_BILL 	= $MAXPARTY_FLAG_BILL + 1 ;
														
														$MAX_PARTY_LOT_FLAG_QRY		= mysql_fetch_array(mysql_query("SELECT MAX(IFNULL(LOTFLAG,0)),SESSIONID FROM fna_bill WHERE PARTYID = '".$PARTYID."' AND LOTNO = '".$LOTNO."'"));
														$MAX_PARTY_LOT_FLAG 		= $MAX_PARTY_LOT_FLAG_QRY['MAX(IFNULL(LOTFLAG,0))'];
														$NOW_MAX_PARTY_LOT_FLAG 	= $MAX_PARTY_LOT_FLAG + 1 ;
														
														$TOT_AMOUNT_PARTY_BILL_QRY 		= mysql_fetch_array(mysql_query("SELECT * FROM fna_bill WHERE PARTYID = '".$PARTYID."' AND LOTNO = '".$LOTNO."' AND LOTFLAG = '".$MAX_PARTY_LOT_FLAG."'"));
														
														$PRODCATTYPEID 					= $TOT_AMOUNT_PARTY_BILL_QRY['PRODCATTYPEID'];
														$PACKINGUNITID 					= $TOT_AMOUNT_PARTY_BILL_QRY['PACKINGUNITID'];
														$PRODUCTID	 					= $TOT_AMOUNT_PARTY_BILL_QRY['PRODUCTID'];
														$QUANTITY	 					= $TOT_AMOUNT_PARTY_BILL_QRY['QUANTITY'];
														$TOTQUANTITY 					= $TOT_AMOUNT_PARTY_BILL_QRY['TOTQUANTITY'];
														$NOW_SESSIONID 					= $TOT_AMOUNT_PARTY_BILL_QRY['SESSIONID'];
														$BILLRECEIVED					= $TOT_AMOUNT_PARTY_BILL_QRY['BILLRECEIVED'];
														$TOT_BILLRECEIVED				= $TOT_AMOUNT_PARTY_BILL_QRY['TOT_BILLRECEIVED'];
														$BALANCE_BILL					= $TOT_AMOUNT_PARTY_BILL_QRY['BALANCE_BILL'];
														$TOTBILLAMOUNT					= $TOT_AMOUNT_PARTY_BILL_QRY['TOTBILLAMOUNT'];
														
														
														$NOW_TOTBILLAMOUNT				= $TOTBILLAMOUNT - $NOW_FNA_BILL_RECEIVE_AMOUNT;
														$NOW_TOTQUANTITY				= $TOTQUANTITY - $basta_qnty ; 
														$NOW_TOTBILLRECEIVED			= $TOT_BILLRECEIVED + $NOW_FNA_BILL_RECEIVE_AMOUNT ;
														$NOW_BALANCE_BILL				= $BALANCE_BILL - $NOW_FNA_BILL_RECEIVE_AMOUNT ;
														
														$insertFNABillQuery = "
																				INSERT INTO 
																							fna_bill
																									(
																										ENTRYSERIALNOID,
																										PROJECTID,
																										SUBPROJECTID,
																										SESSIONID,
																										PARTYID,
																										LOTNO,
																										RECEIVENUMBER,
																										PRODCATTYPEID,
																										PRODUCTID,
																										PACKINGUNITID,
																										QUANTITY,
																										TOTQUANTITY,
																										BILLAMOUNT,
																										TOTBILLAMOUNT,
																										BILLRECEIVED,
																										TOT_BILLRECEIVED,
																										BALANCE_BILL,
																										SERVICES_CHARGE,
																										OTHERS_INCOME,
																										PARTYFLAG,
																										LOTFLAG,
																										ENTRYDATE,
																										STATUS,
																										ENTDATE,
																										ENTTIME,
																										USERID
																									) 
																							VALUES
																									(
																										'".$MaxEntrySlNo."',
																										'".$PROJECTID."',
																										'".$SUBPROJECTID."',
																										'".$NOW_SESSIONID."',
																										'".$PARTYID."',
																										'".$LOTNO."',
																										'".$nowMAXRECNO."',
																										'".$PRODCATTYPEID."',
																										'".$PRODUCTID."',
																										'".$PACKINGUNITID."',
																										'".$basta_qnty."',
																										'".$NOW_TOTQUANTITY."',
																										'0',
																										'".$NOW_TOTBILLAMOUNT."',
																										'".$NOW_FNA_BILL_RECEIVE_AMOUNT."',
																										'".$NOW_TOTBILLRECEIVED."',
																										'".$NOW_BALANCE_BILL."',
																										'".$SERVICECHARGE."',
																										'".$OTHERSINCOME."',
																										'".$NOW_MAX_PARTY_FLAG_BILL."',
																										'".$NOW_MAX_PARTY_LOT_FLAG."',
																										'".$ENTRYDATE."',
																										'Active',
																										'".$entDate."',
																										'".$entTime."',
																										'".$userId."'
																									)
																							";
													
													
														$insertFNABillQueryStatement = mysql_query($insertFNABillQuery);
														// Update FNA Bill Table End
														//-----------------------------Update Daily Income Expanse Table Start-----------------------------
																$SERVICE_FLAG	 		= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_daily_income_expanse"));
																$MAXSERVICE_FLAG	 	= $SERVICE_FLAG['MAX(FLAG)'];
																$NOW_MAXSERVICE_FLAG	 = $MAXSERVICE_FLAG + 1;
																
																$PARTYNAME_QRY 			= mysql_fetch_array(mysql_query("SELECT PARTYNAME FROM fna_party WHERE PARTYID = '".$PARTYID."'"));
																$PARTYNAME				= $PARTYNAME_QRY['PARTYNAME'];
																$NOW_DESCRIPTION_SERV	= 'Service Charge Payment Receive from '.$PARTYNAME . '  ';
																
																if($SERVICECHARGE > 0){
																	
																	$insertServiceChargeQuery = "
																							INSERT INTO 
																										fna_daily_income_expanse
																																	(
																																		ENTRYSERIALNOID,
																																		PROJECTID,
																																		SUBPROJECTID,
																																		DATE,
																																		INCOME,
																																		DESCRIPTION,
																																		FLAG,
																																		STATUS,
																																		ENTDATE,
																																		ENTTIME,
																																		USERID
																																	) 
																															VALUES
																																	(
																																		'".$MaxEntrySlNo."',
																																		'".$PROJECTID."',
																																		'".$SUBPROJECTID."',
																																		'".$ENTRYDATE."',
																																		'".$SERVICECHARGE."',
																																		'".$NOW_DESCRIPTION_SERV."',
																																		'".$NOW_MAXSERVICE_FLAG."',
																																		'Active',
																																		'".$entDate."',
																																		'".$entTime."',
																																		'".$userId."'
																																	)
																							";
																		
																		
																		$insertServiceChargeQueryStatement = mysql_query($insertServiceChargeQuery);
																}
															//----------------------------Update Daily Income Expanse Table End --------------------------
														//-----------------------------Update Daily Income Expanse Table Start-----------------------------
																$OTHERSINC_FLAG	 		= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_daily_income_expanse"));
																$MAXOTHERSINC_FLAG 		= $OTHERSINC_FLAG['MAX(FLAG)'];
																$NOW_MAXOTHERSINC_FLAG 	= $MAXOTHERSINC_FLAG + 1;
																
																$PARTYNAME_QRY 			= mysql_fetch_array(mysql_query("SELECT PARTYNAME FROM fna_party WHERE PARTYID = '".$PARTYID."'"));
																$PARTYNAME				= $PARTYNAME_QRY['PARTYNAME'];
																$NOW_DESCRIPTION_OTHERSINC		= 'Others Income Payment Receive from '.$PARTYNAME . ' ';
																
																if($OTHERSINCOME > 0){
																	
																	$insertDailyInExQuery_Others = "
																							INSERT INTO 
																										fna_daily_income_expanse
																																	(
																																		ENTRYSERIALNOID,
																																		PROJECTID,
																																		SUBPROJECTID,
																																		DATE,
																																		INCOME,
																																		DESCRIPTION,
																																		FLAG,
																																		STATUS,
																																		ENTDATE,
																																		ENTTIME,
																																		USERID
																																	) 
																															VALUES
																																	(
																																		'".$MaxEntrySlNo."',
																																		'".$PROJECTID."',
																																		'".$SUBPROJECTID."',
																																		'".$ENTRYDATE."',
																																		'".$OTHERSINCOME."',
																																		'".$NOW_DESCRIPTION_OTHERSINC."',
																																		'".$NOW_MAXOTHERSINC_FLAG."',
																																		'Active',
																																		'".$entDate."',
																																		'".$entTime."',
																																		'".$userId."'
																																	)
																							";
																		
																		
																		$insertDailyInExQuery_OthersStatement = mysql_query($insertDailyInExQuery_Others);
																}
															//----------------------------Update Daily Income Expanse Table End --------------------------
														
														// Update FNA BASTA Table START
														
														if($BASTALOANAMOUNT != '' or $BASTALOANAMOUNT != 0){
															
															
														
															$BASTA_FLAG_QRY			= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_basta"));
															$MAXBASTA_FLAG 			= $BASTA_FLAG_QRY['MAX(FLAG)'];
															$NOW_MAXBASTA_FLAG	 	= $MAXBASTA_FLAG + 1;
															
															$BALANCE_QUERY		 	= mysql_fetch_array(mysql_query("SELECT * FROM fna_basta WHERE FLAG = '".$MAXBASTA_FLAG."'"));
															$TOTSELLQNTY 			= $BALANCE_QUERY['TOTSELLQNTY'];
															$BALANCEQNTY			= $BALANCE_QUERY['BALANCEQNTY'];
															$UNITPRICE 				= $BALANCE_QUERY['UNITPRICE'];
															$TOTSELLPRICE 			= $BALANCE_QUERY['TOTSELLPRICE'];
															$RECEIVEDAMOUNT			= $BALANCE_QUERY['RECEIVEDAMOUNT'];
															
															$NOW_RECEIVEDAMOUNT		= $RECEIVEDAMOUNT + $BASTALOANAMOUNT ;
															
															$insertBastaQuery = "
																					INSERT INTO 
																								fna_basta
																										(
																											ENTRYSERIALNOID,
																											PARTYID,
																											LOTNO,
																											TOTSELLQNTY,
																											BALANCEQNTY,
																											UNITPRICE,
																											TOTSELLPRICE,
																											RECEIVEDAMOUNT,
																											ENTRYDATE,
																											FLAG,
																											STATUS,
																											ENTDATE,
																											ENTTIME,
																											USERID
																										) 
																								VALUES
																										(
																											'".$MaxEntrySlNo."',
																											'".$PARTYID."',
																											'".$LOTNO."',
																											'".$TOTSELLQNTY."',
																											'".$BALANCEQNTY."',
																											'".$UNITPRICE."',
																											'".$TOTSELLPRICE."',
																											'".$BASTALOANAMOUNT."',
																											'".$ENTRYDATE."',
																											'".$NOW_MAXBASTA_FLAG."',
																											'Receive',
																											'".$entDate."',
																											'".$entTime."',
																											'".$userId."'
																										)
																";
																
																
																$insertBastaQueryStatement = mysql_query($insertBastaQuery);
																
																//-----------------------------Update Daily Income Expanse Table Start-----------------------------
																$INEX_FLAG	 			= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_daily_income_expanse"));
																$MAXINEX_FLAG	 		= $INEX_FLAG['MAX(FLAG)'];
																$NOW_MAXINEX_FLAG	 	= $MAXINEX_FLAG + 1;
																
																$PARTYNAME_QRY 			= mysql_fetch_array(mysql_query("SELECT PARTYNAME FROM fna_party WHERE PARTYID = '".$PARTYID."'"));
																$PARTYNAME				= $PARTYNAME_QRY['PARTYNAME'];
																$NOW_DESCRIPTION		= 'Basta Loan Payment Receive from '.$PARTYNAME . '   Basta Loan..Alu ';
																
																if($BASTALOANAMOUNT > 0){
																	
																	$insertDailyInExQuery = "
																							INSERT INTO 
																										fna_daily_income_expanse
																																	(
																																		ENTRYSERIALNOID,
																																		PROJECTID,
																																		SUBPROJECTID,
																																		DATE,
																																		INCOME,
																																		DESCRIPTION,
																																		FLAG,
																																		STATUS,
																																		ENTDATE,
																																		ENTTIME,
																																		USERID
																																	) 
																															VALUES
																																	(
																																		'".$MaxEntrySlNo."',
																																		'".$PROJECTID."',
																																		'".$SUBPROJECTID."',
																																		'".$ENTRYDATE."',
																																		'".$BASTALOANAMOUNT."',
																																		'".$NOW_DESCRIPTION."',
																																		'".$NOW_MAXINEX_FLAG."',
																																		'Active',
																																		'".$entDate."',
																																		'".$entTime."',
																																		'".$userId."'
																																	)
																							";
																		
																		
																		$insertDailyInExQueryStatement = mysql_query($insertDailyInExQuery);
																}
															//----------------------------Update Daily Income Expanse Table End --------------------------
														}
														// Update FNA BASTA Table END
														
														// ----------------------------------Update ALU BOOKING  Table START---------------------------------------
														
														if($BOOKINGMONEY != '' or $BOOKINGMONEY != 0){
																													
															$BOOKING_FLAG_QRY		= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_alubooking "));
															$MAXBOOKING_FLAG 		= $BOOKING_FLAG_QRY['MAX(FLAG)'];
															$NOW_MAXBOOKING_FLAG 	= $MAXBOOKING_FLAG + 1;
															
															$PARTY_FLAG_QRY			= mysql_fetch_array(mysql_query("SELECT MAX(PARTYFLAG) FROM fna_alubooking WHERE PARTYID = '".$PARTYID."'"));
															$MAXPARTY_FLAG	 		= $PARTY_FLAG_QRY['MAX(PARTYFLAG)'];
															$NOW_MAXPARTY_FLAG	 	= $MAXPARTY_FLAG + 1;
															
															$BOOKING_QRY			= mysql_fetch_array(mysql_query("SELECT BALANCE FROM fna_alubooking WHERE PARTYID = '".$PARTYID."' AND PARTYFLAG = '".$MAXPARTY_FLAG."'"));
															$PARTY_BALANCE	 		= $BOOKING_QRY['BALANCE'];
															$NOW_PARTYBALANCE		= $PARTY_BALANCE - $BOOKINGMONEY ; 
												
															$insertQueryAluBook = "
																				INSERT INTO 
																							fna_alubooking
																									(
																										ENTRYSERIALNOID,
																										PROJECTID,
																										SUBPROJECTID,
																										PARTYID,
																										BOOKINGMONEY,
																										ADJUSTMENTMONEY,
																										BALANCE,
																										BOOKINGDATE,
																										PARTYFLAG,
																										FLAG,
																										STATUS,
																										ENTDATE,
																										ENTTIME,
																										USERID
																									) 
																							VALUES
																									(
																										'".$MaxEntrySlNo."',
																										'".$PROJECTID."',
																										'".$SUBPROJECTID."',
																										'".$PARTYID."',
																										'0',
																										'".$BOOKINGMONEY."',
																										'".$NOW_PARTYBALANCE."',
																										'".$ENTRYDATE."',
																										'".$NOW_MAXPARTY_FLAG."',
																										'".$NOW_MAXBOOKING_FLAG."',
																										'Active',
																										'".$entDate."',
																										'".$entTime."',
																										'".$userId."'
																									)
																			";
															$insertQueryAluBookStatement = mysql_query($insertQueryAluBook);
														
														
														//-----------------------------Update Daily Income Expanse Table Start-----------------------------
														$INEX_FLAG	 			= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_daily_income_expanse"));
														$MAXINEX_FLAG	 		= $INEX_FLAG['MAX(FLAG)'];
														$NOW_MAXINEX_FLAG	 	= $MAXINEX_FLAG + 1;
														
														$PARTYNAME_QRY 			= mysql_fetch_array(mysql_query("SELECT PARTYNAME FROM fna_party WHERE PARTYID = '".$PARTYID."'"));
														$PARTYNAME				= $PARTYNAME_QRY['PARTYNAME'];
														$NOW_DESCRIPTION		= 'Booking Money Return to '.$PARTYNAME . '   ..Alu ';
														
														$insertDailyInExQuery = "
																				INSERT INTO 
																								fna_daily_income_expanse
																															(
																																ENTRYSERIALNOID,
																																PROJECTID,
																																SUBPROJECTID,
																																DATE,
																																EXPANSE,
																																DESCRIPTION,
																																FLAG,
																																STATUS,
																																ENTDATE,
																																ENTTIME,
																																USERID
																															) 
																													VALUES
																															(
																																'".$MaxEntrySlNo."',
																																'".$PROJECTID."',
																																'".$SUBPROJECTID."',
																																'".$ENTRYDATE."',
																																'".$BOOKINGMONEY."',
																																'".$NOW_DESCRIPTION."',
																																'".$NOW_MAXINEX_FLAG."',
																																'Active',
																																'".$entDate."',
																																'".$entTime."',
																																'".$userId."'
																															)
																					";
																
																
																$insertDailyInExQueryStatement = mysql_query($insertDailyInExQuery);
																	
														//----------------------------Update Daily Income Expanse Table End --------------------------
														//--------------------------- Update ALU BOOKING Table END  -----------------------------------------
												}		
														
										// -----------------------------Update Alu Loan Table Start-----------------------------------------
														
													if($UNLOAD_CARLOANPAYMENT > 0 ){
														
														$aQuery 	= "SELECT   LOANID,
																				LOANTYPEID,
																				PROJECTID,
																				SUBPROJECTID,
																				PARTYID,
																				LOAN_NUMBER,
																				LOTNO,
																				LOANDATE,
																				LOAN_PAYMENTDATE,
																				LOANAMOUNT,
																				PRINCIPALAMOUNT,
																				RESTOFTHE_AMOUNT,
																				LOANPAYMENT,
																				INTERESTRATE,
																				INTERESTAMOUNT,
																				LOAN_BALANCE,
																				ENTRYDATE,
																				LOANFLAG,
																				LOANPURPOSE										
																			FROM `fna_loan` 
																			WHERE `LOANID` = '".$LOANID."'
																	";
														$aQueryStatement	= mysql_query($aQuery);
														$sl = 1;
														$glabalToatalBill = 0;
														$PAYMENTAMOUNT ='';
														$partyBalAmount ='';
														$INT_AMOUNT = '';
														$TOT_LOANAMOUNT = '';
														$LOANTYPEID		='';
														$INTERESTRATE	='';
														$LOANPURPOSE	='';
														while($aQueryStatementData	= mysql_fetch_array($aQueryStatement)){
											
														// Dynamic Row Start
														$LOANID 		= $aQueryStatementData['LOANID'];
														$LOANTYPEID 	= $aQueryStatementData['LOANTYPEID'];
														$PROJECTID 		= $aQueryStatementData['PROJECTID'];
														$SUBPROJECTID 	= $aQueryStatementData['SUBPROJECTID'];
														$PARTYID 		= $aQueryStatementData['PARTYID'];
														$LOAN_NUMBER	= $aQueryStatementData['LOAN_NUMBER'];
														$LOTNO			= $aQueryStatementData['LOTNO'];
														$LOANDATE 		= $aQueryStatementData['LOANDATE'];
														$LOAN_PAYMENTDATE	= $aQueryStatementData['LOAN_PAYMENTDATE'];
														$LOANAMOUNT 		= round($aQueryStatementData['LOANAMOUNT']);
														$PRINCIPALAMOUNT 	= round($aQueryStatementData['PRINCIPALAMOUNT']);
														$RESTOFTHE_AMOUNT 	= round($aQueryStatementData['RESTOFTHE_AMOUNT']);
														
														$INTERESTRATE 	= $aQueryStatementData['INTERESTRATE'];
														$INTERESTAMOUNT = round($aQueryStatementData['INTERESTAMOUNT']);
														$LOANPAYMENT	= round($aQueryStatementData['LOANPAYMENT']);
														$LOAN_BALANCE	= round($aQueryStatementData['LOAN_BALANCE']);
														$ENTRYDATE2		= $aQueryStatementData['ENTRYDATE'];
														$LOANFLAG 		= $aQueryStatementData['LOANFLAG'];
														$LOANPURPOSE 	= $aQueryStatementData['LOANPURPOSE'];
														
														
														$daylen = 60*60*24;
											
													   $date2 = $ENTRYDATE2;
													   $date1 = $ENTRYDATE;
																$days = (strtotime($date1)-strtotime($date2))/$daylen;
																$INT_AMOUNT_TEST = round(((($RESTOFTHE_AMOUNT * $INTERESTRATE)/100)/365) * $days) ;
																$TOT_LOANAMOUNT_TEST = $RESTOFTHE_AMOUNT + $INT_AMOUNT_TEST;
														
													   
													   if($UNLOAD_CARLOANPAYMENT <= $TOT_LOANAMOUNT_TEST){
														 
															   $days = (strtotime($date1)-strtotime($date2))/$daylen;
																$INT_AMOUNT = round(((($RESTOFTHE_AMOUNT * $INTERESTRATE)/100)/365) * $days) ; 
																$TOT_LOANAMOUNT = round($RESTOFTHE_AMOUNT + $INT_AMOUNT) ;
															   
															   $NOW_PRINCIPAL_AMOUNT	= round($UNLOAD_CARLOANPAYMENT - $INT_AMOUNT) ;
															   $NOW_RESTOFTHE_AMOUNT	= round($RESTOFTHE_AMOUNT - $NOW_PRINCIPAL_AMOUNT) ;
														   
														  }else{
															
															   $days = (strtotime($date1)-strtotime($date2))/$daylen;
															   $INT_AMOUNT = round((($UNLOAD_CARLOANPAYMENT * $INTERESTRATE)/100)/365) * $days ; 
															   //$LOAN_PAY_INT_AMOUNT = round((($LOAN_PAYMENT_AMOUNT * $INTERESTRATE)/100)/365) * $days ;
															   $TOT_LOANAMOUNT = round($RESTOFTHE_AMOUNT + $INT_AMOUNT) ;
															   
															   $NOW_PRINCIPAL_AMOUNT	= round($UNLOAD_CARLOANPAYMENT - $INT_AMOUNT) ;
															   $NOW_RESTOFTHE_AMOUNT	= round($RESTOFTHE_AMOUNT - $NOW_PRINCIPAL_AMOUNT) ;
															 }
													    
														}
														
														if($TOT_LOANAMOUNT >= $UNLOAD_CARLOANPAYMENT){
																
																$BALANCE_AMOUNT = round($TOT_LOANAMOUNT - $UNLOAD_CARLOANPAYMENT) ;
																
																	if($BALANCE_AMOUNT >= 0){
																		
																		
											//------------------------------------------ Update Loan Table Start --------------------------------------------	
																										
																		$MAXPARTYFLAG 		= mysql_fetch_array(mysql_query("SELECT MAX(PARTYFLAG) FROM fna_loan WHERE PARTYID = '".$PARTYID."'"));
																		$MAXPARTY_FLAG	 	= $MAXPARTYFLAG['MAX(PARTYFLAG)'];
																		$NOW_MAXPARTY_FLAG 	= $MAXPARTY_FLAG + 1;
																		
																								
																		$BALANCE_QRY		= mysql_fetch_array(mysql_query("SELECT LOAN_BALANCE FROM fna_loan WHERE PARTYID = '".$PARTYID."' AND PARTYFLAG = '".$MAXPARTY_FLAG."'"));
																		$BALANCE		 	= $BALANCE_QRY['LOAN_BALANCE'];
																		$NOW_LOAN_BALANCE	= round($BALANCE - $NOW_PRINCIPAL_AMOUNT);
																	
																		$insertQueryLoan = "
																									INSERT INTO 
																												fna_loan
																														(
																															ENTRYSERIALNOID,
																															PROJECTID,
																															SUBPROJECTID,
																															LOANTYPEID,
																															PARTYID,
																															LOAN_NUMBER,
																															LOTNO,
																															LOANDATE,
																															LOAN_PAYMENTDATE,
																															LOANAMOUNT,
																															PRINCIPALAMOUNT,
																															RESTOFTHE_AMOUNT,
																															LOANPAYMENT,
																															INTERESTRATE,
																															INTERESTAMOUNT,
																															LOAN_BALANCE,
																															ENTRYDATE,
																															LOANPURPOSE,
																															PARTYFLAG,
																															LOANFLAG,
																															STATUS,
																															ENTDATE,
																															ENTTIME,
																															USERID
																														) 
																												VALUES
																														(
																															'".$MaxEntrySlNo."',
																															'".$PROJECTID."',
																															'".$SUBPROJECTID."',
																															'".$LOANTYPEID."',
																															'".$PARTYID."',
																															'".$LOAN_NUMBER."',
																															'".$LOTNO."',
																															'".$LOANDATE."',
																															'".$ENTRYDATE."',
																															'0',
																															'".$NOW_PRINCIPAL_AMOUNT."',
																															'".$NOW_RESTOFTHE_AMOUNT."',
																															'".$UNLOAD_CARLOANPAYMENT."',
																															'".$INTERESTRATE."',
																															'".$INT_AMOUNT."',
																															'".$NOW_LOAN_BALANCE."',
																															'".$ENTRYDATE."',
																															'".$LOANPURPOSE."',
																															'".$NOW_MAXPARTY_FLAG."',
																															'".$LOANFLAG."',
																															'Active',
																															'".$entDate."',
																															'".$entTime."',
																															'".$userId."'
																														)
																						";
																			$insertQueryLoanStatement = mysql_query($insertQueryLoan);
																			
																			
																			
																		//-----------------------------Update Daily Income Expanse Table Start-----------------------------
																		$INEX_FLAG	 			= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_daily_income_expanse"));
																		$MAXINEX_FLAG	 		= $INEX_FLAG['MAX(FLAG)'];
																		$NOW_MAXINEX_FLAG	 	= $MAXINEX_FLAG + 1;
																		
																		$PARTYNAME_QRY 			= mysql_fetch_array(mysql_query("SELECT PARTYNAME FROM fna_party WHERE PARTYID = '".$PARTYID."'"));
																		$PARTYNAME				= $PARTYNAME_QRY['PARTYNAME'];
																		$NOW_DESCRIPTION		= 'Loan Payment Receive from '.$PARTYNAME . '   Car Loan..Alu ';
																		
																		$insertDailyInExQuery = "
																								INSERT INTO 
																												fna_daily_income_expanse
																																			(
																																				ENTRYSERIALNOID,
																																				PROJECTID,
																																				SUBPROJECTID,
																																				DATE,
																																				INCOME,
																																				DESCRIPTION,
																																				FLAG,
																																				STATUS,
																																				ENTDATE,
																																				ENTTIME,
																																				USERID
																																			) 
																																	VALUES
																																			(
																																				'".$MaxEntrySlNo."',
																																				'".$PROJECTID."',
																																				'".$SUBPROJECTID."',
																																				'".$ENTRYDATE."',
																																				'".$UNLOAD_CARLOANPAYMENT."',
																																				'".$NOW_DESCRIPTION."',
																																				'".$NOW_MAXINEX_FLAG."',
																																				'Active',
																																				'".$entDate."',
																																				'".$entTime."',
																																				'".$userId."'
																																			)
																									";
																				
																				
																				$insertDailyInExQueryStatement = mysql_query($insertDailyInExQuery);
																	
																	//----------------------------Update Daily Income Expanse Table End --------------------------
																			
																			$UpdateQuery	= "UPDATE fna_loan 
																												SET 
																													STATUS 			='Inactive'
																												WHERE LOANID = '".$LOANID."'";
																			$UpdateQueryStatement = mysql_query($UpdateQuery);
								
														
														}else
															{
																$msg = "<span class='validMsg'>Komol.........</span>";
																//update loan table	
															}
															
												}else
												{
													$msg = "<span class='errorMsg'>This Amount is greater than Total Loan Amount.........</span>";
												}
											}//Modified by Recover Loan without paid loan amount
											
												//------------------------------------------ Update Loan Table End --------------------------------------------
												
														
														// Upadate FNA Party Bill Table Start	
					
														$MAX_PARTY_FLAG = mysql_fetch_array(mysql_query("SELECT MAX(PARTYFLAG) FROM fna_partybill WHERE PARTYID = '".$PARTYID."'"));
														$MAXPARTY_FLAG = $MAX_PARTY_FLAG['MAX(PARTYFLAG)'];
														$NOW_MAX_PARTY_FLAG = $MAXPARTY_FLAG + 1;
														$BAL_AMOUNT_PARTY = mysql_fetch_array(mysql_query("SELECT BALANCEAMOUNT FROM fna_partybill WHERE PARTYFLAG = '".$MAXPARTY_FLAG."' AND PARTYID = '".$PARTYID."'"));
														$PARTY_BAL_AMOUNT = $BAL_AMOUNT_PARTY['BALANCEAMOUNT'];
														
														if(($MAXPARTY_FLAG == 0) or ($MAXPARTY_FLAG ='')){
															$NOW_PARTY_BALAMOUNT = 0 - $NOW_FNA_BILL_RECEIVE_AMOUNT ;
														}else{
															if($PARTY_BAL_AMOUNT <0){
																if($PARTY_BAL_AMOUNT > $NOW_FNA_BILL_RECEIVE_AMOUNT){
																	$NOW_PARTY_BALAMOUNT = $PARTY_BAL_AMOUNT - $NOW_FNA_BILL_RECEIVE_AMOUNT ;
																	
																}elseif($PARTY_BAL_AMOUNT <= $NOW_FNA_BILL_RECEIVE_AMOUNT){
																	$NOW_PARTY_BALAMOUNT = $PARTY_BAL_AMOUNT - $NOW_FNA_BILL_RECEIVE_AMOUNT ;
																	
																}
																
																 
															}else{
																$NOW_PARTY_BALAMOUNT = $PARTY_BAL_AMOUNT - $NOW_FNA_BILL_RECEIVE_AMOUNT ; 
															}
															
														}
														$insertPartyBillQuery = "
																				INSERT INTO 
																							fna_partybill
																									(
																										ENTRYSERIALNOID,
																										PROJECTID,
																										SUBPROJECTID,
																										BATCHNO,
																										PARTYID,
																										PRODCATTYPEID,
																										RECEIVENUMBER,
																										PAYMENTAMOUNT,
																										RECEIVEAMOUNT,
																										BALANCEAMOUNT,
																										ENTRYDATE,
																										BANKNAME,
																										CHEQUENUMBER,
																										CHEQUEDATE,
																										PARTYFLAG,
																										STATUS,
																										PURSELLFLAG,
																										ENTDATE,
																										ENTTIME,
																										USERID
																									) 
																							VALUES
																									(
																										'".$MaxEntrySlNo."',
																										'".$PROJECTID."',
																										'".$SUBPROJECTID."',
																										'',
																										'".$PARTYID."',
																										'".$PRODCATTYPEID."',
																										'0',
																										'0',
																										'".$NOW_FNA_BILL_RECEIVE_AMOUNT."',
																										'".$NOW_PARTY_BALAMOUNT."',
																										'".$ENTRYDATE."',
																										'',
																										'',
																										'',
																										'".$NOW_MAX_PARTY_FLAG."',
																										'Receive',
																										'Sell',
																										'".$entDate."',
																										'".$entTime."',
																										'".$userId."'
																									)
															";
															
															
															$insertPartyBillQueryStatement = mysql_query($insertPartyBillQuery);
															if($insertPartyBillQueryStatement){
																
																//Update FNA Balance Table Start
																$BALANCE_FLAG 			= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_balance"));
																$MAXBALANCE_FLAG 		= $BALANCE_FLAG['MAX(FLAG)'];
																$NOW_MAXBALANCE_FLAG 	= $MAXBALANCE_FLAG + 1;
																
																$BALANCE_QUERY		 	= mysql_fetch_array(mysql_query("SELECT * FROM fna_balance WHERE FLAG = '".$MAXBALANCE_FLAG."'"));
																$INCOME_AMOUNT 			= $BALANCE_QUERY['INCOME'];
																$EXPANSE_AMOUNT			= $BALANCE_QUERY['EXPANSE'];
																$BALANCE_AMOUNT 		= $BALANCE_QUERY['BALANCE'];
																
																$NOW_BALANCE_AMOUNT		= $BALANCE_AMOUNT + $FNA_BILLAMOUNT ;
																
																$insertBalanceQuery = "
																						INSERT INTO 
																									fna_balance
																											(
																												ENTRYSERIALNOID,
																												PROJECTID,
																												SUBPROJECTID,
																												INCOME,
																												BALANCE,
																												FLAG,
																												BALDATE,
																												STATUS,
																												ENTDATE,
																												ENTTIME,
																												USERID
																											) 
																									VALUES
																											(
																												'".$MaxEntrySlNo."',
																												'".$PROJECTID."',
																												'".$SUBPROJECTID."',
																												'".$FNA_BILLAMOUNT."',
																												'".$NOW_BALANCE_AMOUNT."',
																												'".$NOW_MAXBALANCE_FLAG."',
																												'".$ENTRYDATE."',
																												'Receive',
																												'".$entDate."',
																												'".$entTime."',
																												'".$userId."'
																											)
																	";
																	
																	
																	$insertBalanceQueryStatement = mysql_query($insertBalanceQuery);
																//Update FNA Balance Table End
																//-----------------------------Update Daily Income Expanse Table Start-----------------------------
																		$INEX_FLAG	 			= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_daily_income_expanse"));
																		$MAXINEX_FLAG	 		= $INEX_FLAG['MAX(FLAG)'];
																		$NOW_MAXINEX_FLAG	 	= $MAXINEX_FLAG + 1;
																		
																		$PARTYNAME_QRY 			= mysql_fetch_array(mysql_query("SELECT PARTYNAME FROM fna_party WHERE PARTYID = '".$PARTYID."'"));
																		$PARTYNAME				= $PARTYNAME_QRY['PARTYNAME'];
																		$NOW_DESCRIPTION		= 'Payment Receive from '.$PARTYNAME . '   Store Fare..Alu ';
																		
																		$insertDailyInExQuery = "
																								INSERT INTO 
																												fna_daily_income_expanse
																																			(
																																				ENTRYSERIALNOID,
																																				PROJECTID,
																																				SUBPROJECTID,
																																				DATE,
																																				INHID,
																																				INCOME,
																																				DESCRIPTION,
																																				FLAG,
																																				STATUS,
																																				ENTDATE,
																																				ENTTIME,
																																				USERID
																																			) 
																																	VALUES
																																			(
																																				'".$MaxEntrySlNo."',
																																				'".$PROJECTID."',
																																				'".$SUBPROJECTID."',
																																				'".$ENTRYDATE."',
																																				'22',
																																				'".$NOW_FNA_BILL_RECEIVE_AMOUNT."',
																																				'".$NOW_DESCRIPTION."',
																																				'".$NOW_MAXINEX_FLAG."',
																																				'Active',
																																				'".$entDate."',
																																				'".$entTime."',
																																				'".$userId."'
																																			)
																									";
																				
																				
																				$insertDailyInExQueryStatement = mysql_query($insertDailyInExQuery);
																	
																	//----------------------------Update Daily Income Expanse Table End --------------------------
																
																	$msg = "<span class='validMsg'>This Information [ $NOW_FNA_BILL_RECEIVE_AMOUNT ] added sucessfully</span>";
																}else{
																	$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
																	
																}
									
									
										
														} else {
															$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
														}
												
												
											}else{
													$msg = "<span class='errorMsg'>Please Pay al Least [$TOT_UNLOAD_BILL] Taka before Unload......!</span>";
												}
											
									}else
										{
											$msg = "<span class='errorMsg'>Please Pay Basta Loan Payment Amount [$UNLOAD_BASTA_PAYMENT] Taka before Unload......!</span>";
										}
										

											
								}else{
									$msg = "<span class='errorMsg'>Please Pay Loan Amount [$BALANCE_LOAN_AMOUNT] Taka before Unload......!</span>";
								}	
									
						}else
						{
							$msg = "<span class='errorMsg'>Sorry! Product Quantity is not Sufficient!</span>";
						}
		
		return $msg;
			
			
			
			
		} 
		// Insert Alu Unload Information  End
		
		// Insert Load Pendinf Information Start
		function insertLoadPendingInfo($userId){
			
			$LOTNO				= '';
			
			$PROJECTID 			= $_REQUEST["PROJECTID"];
			$SUBPROJECTID		= $_REQUEST["SUBPROJECTID"];
			
			$CHALLANNO 			= $_REQUEST["CHALLANNO"];
			
			$LABOURID 			= $_REQUEST["LABOURID"];
			$PARTYID 			= $_REQUEST["PARTYID"];
			$ENTRYDATE	 		= insertDateMySQlFormat($_REQUEST["ENTRYDATE"]);
			
			
			$PRODCATTYPEID		= $_REQUEST["PRODCATTYPEID"];
			$PRODUCTID 			= $_REQUEST["PRODUCTID"];
			$quantity	 		= $_REQUEST["quantity"];
			$wtquantity	 		= $_REQUEST["wtquantity"];
			$packingUnit		= $_REQUEST["packingUnit"];
			$CHID		 		= $_REQUEST["CHID"];
			$pocket		 		= $_REQUEST["pocket"];
			$TOTAL_PRODUCT_LIST	= $_REQUEST["TOTAL_PRODUCT_LIST"];
			$LOTNO				= $_REQUEST["LOTNO"];
			
			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
			$Query		= "
							SELECT 
									CHALLANNO 
							FROM 
									fna_productloadunload
							WHERE CHALLANNO = '".$CHALLANNO."'
						";
			$QueryStatement	= mysql_query($Query);
			if(mysql_num_rows($QueryStatement)>0) {
				$msg = "<span class='errorMsg'>Sorry, This Challan No Data [ $CHALLANNO ] already exist!</span>";
			} else {
				
				$MAXRECNO = mysql_fetch_array(mysql_query("SELECT MAX(IFNULL(RECEIVENUMBER,0)) FROM fna_productloadunload "));
				$maxNo = $MAXRECNO['MAX(IFNULL(RECEIVENUMBER,0))'];
				if($maxNo == 0){
						$nowMAXRECNO = $maxNo + 1;
					}else{
						$nowMAXRECNO = $maxNo + 1;	
					}
				$insertQuery = "
									INSERT INTO 
												fna_productloadunload
																	(
																		PROJECTID,
																		SUBPROJECTID,
																		PARTYID,
																		LABOURID,
																		ENTRYDATE,
																		RECEIVENUMBER,
																		CHALLANNO,
																		LOTNO,
																		STATUS,
																		ENTDATE,
																		ENTTIME,
																		USERID
																	) 
															VALUES
																	(
																		'".$PROJECTID."',
																		'".$SUBPROJECTID."',
																		'".$PARTYID."',
																		'".$LABOURID."',
																		'".$ENTRYDATE."',
																		'".$nowMAXRECNO."',
																		'".$CHALLANNO."',
																		'".$LOTNO."',
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									"; 
				if(mysql_query($insertQuery)){
					
					$loadCtId = mysql_insert_id();
					
					
					$k = 0;
					$globalLabourTotalBillAmount = 0;
					$globalPartyTotalBillAmount = 0;
					
					for($i = 1; $i < $TOTAL_PRODUCT_LIST; $i++ ){
						
								$insertbkdnQuery = "
										INSERT INTO 
													fna_productloadunloadbkdn
																	(
																		PRODUCTLOADUNLOADID,
																		PRODCATTYPEID,
																		PRODUCTID,
																		PACKINGUNITID,
																		QUANTITY,
																		WTQNTY,
																		CHID,
																		POCKET,
																		STATUS,
																		ENTDATE,
																		ENTTIME,
																		USERID
																	) 
															VALUES
																	(
																		'".$loadCtId."',
																		'".$PRODCATTYPEID[$k]."',
																		'".$PRODUCTID[$k]."',
																		'".$packingUnit[$k]."',
																		'".$quantity[$k]."',
																		'".$wtquantity[$k]."',
																		'".$CHID[$k]."',
																		'".$pocket[$k]."',
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									"; 
									
									
									$insertbkdnQueryStatement = mysql_query($insertbkdnQuery);
									if($insertbkdnQueryStatement){
										$msg = "<span class='validMsg'>Labour Information [$loadCtId] added sucessfully</span>";
									}else{
										$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
										break;
										}
										
										//Update Product Stock table Start
										$loadUnloadBkdnIdCtId = mysql_insert_id();
									 	
										$partyFlag = mysql_fetch_array(mysql_query("SELECT MAX(IFNULL(PARTYFLAG,0)) FROM fna_productstock WHERE PARTYID = '".$PARTYID."'"));
										$MAXpartyFlag = $partyFlag['MAX(IFNULL(PARTYFLAG,0))'];
										$NowMAXpartyFlag = $MAXpartyFlag + 1;
										
										$prodCatTypeFlag = mysql_fetch_array(mysql_query("SELECT MAX(IFNULL(PRODCATTYPEFLAG,0)) FROM fna_productstock WHERE PARTYID = '".$PARTYID."' AND PRODCATTYPEID = '".$PRODCATTYPEID[$k]."'"));
										$MAXprodCatTypeFlag = $prodCatTypeFlag['MAX(IFNULL(PRODCATTYPEFLAG,0))'];
										$NowMaxprodCatTypeFlag = $MAXprodCatTypeFlag + 1;
										
										$prodTypeFlag = mysql_fetch_array(mysql_query("SELECT MAX(PRODTYPEFLAG) FROM fna_productstock WHERE PARTYID = '".$PARTYID."' AND PRODUCTID = '".$PRODUCTID[$k]."'"));
										
										$MAXprodTypeFlag = $prodTypeFlag['MAX(PRODTYPEFLAG)'];
										if ($MAXprodTypeFlag == ''){
												//$MAXprodTypeFlag = 0;
												$NowTotQnty = $quantity[$k];
											}else
											{
												$prodQnty = mysql_fetch_array(mysql_query("SELECT TOTQUANTITY FROM fna_productstock WHERE PARTYID = '".$PARTYID."' AND PRODUCTID = '".$PRODUCTID[$k]."' AND PRODTYPEFLAG = '".$MAXprodTypeFlag."'"));
												$TotQnty = $prodQnty['TOTQUANTITY'];
												$NowTotQnty = $prodQnty['TOTQUANTITY'] + $quantity[$k];
											}
										$NowMaxprodTypeFlag = $MAXprodTypeFlag + 1;
										
										
										$insertStockQuery = "
															INSERT INTO 
																		fna_productstock
																					(
																						PROJECTID,
																						SUBPROJECTID,
																						PRODUCTLOADUNLOADBKDNID,
																						PARTYID,
																						PRODCATTYPEID,
																						PRODUCTID,
																						QUANTITY,
																						WTQNTY,
																						TOTQUANTITY,
																						PARTYFLAG,
																						PRODCATTYPEFLAG,
																						PRODTYPEFLAG,
																						WORKTYPEFLAG,
																						STATUS,
																						ENTDATE,
																						ENTTIME,
																						USERID
																					) 
																			VALUES
																					(
																						'".$PROJECTID."',
																						'".$SUBPROJECTID."',
																						'".$loadUnloadBkdnIdCtId."',
																						'".$PARTYID."',
																						'".$PRODCATTYPEID[$k]."',
																						'".$PRODUCTID[$k]."',
																						'".$quantity[$k]."',
																						'".$wtquantity[$k]."',
																						'".$NowTotQnty."',
																						'".$NowMAXpartyFlag."',
																						'".$NowMaxprodCatTypeFlag."',
																						'".$NowMaxprodTypeFlag."',
																						'Load',
																						'Active',
																						'".$entDate."',
																						'".$entTime."',
																						'".$userId."'
																					)
									"; 
									
									
									$insertStockQueryStatement = mysql_query($insertStockQuery);
										//Update Product Stock table End
										
										//Update Labour Work History Table Start
										$LABOURIDQUERY  =mysql_fetch_array(mysql_query("SELECT LABCONTACTID FROM fna_labourcontact WHERE LABOURID = '".$LABOURID."'"));
										$LABCONTACTID = $LABOURIDQUERY['LABCONTACTID'];
										$QUERYLOADPRICE = mysql_fetch_array(mysql_query("SELECT LOADPRICE FROM fna_labourcontact_bkdn WHERE LABCONTACTID = '".$LABCONTACTID."' AND CHAMBERIDTO = '".$CHID[$k]."' and PACKINGUNITID = '".$packingUnit[$k]."'"));
										$LOADPRICE = $QUERYLOADPRICE['LOADPRICE'];
										$TOTBILLAMOUNT = $quantity[$k] * $LOADPRICE ;
										$globalLabourTotalBillAmount = $globalLabourTotalBillAmount + $TOTBILLAMOUNT ;
										
										
										$insertLabWorkHistQuery = "
															INSERT INTO 

																		fna_labourworkhistory
																					(
																						PROJECTID,
																						SUBPROJECTID,
																						LABOURID,
																						PARTYID,
																						PRODUCTLOADUNLOADBKDNID,
																						PRODCATTYPEID,
																						PRODUCTID,
																						PACKINGUNITID,
																						QUANTITY,
																						CHID,
																						POCKET,
																						BILLAMOUNT,
																						TOTBILLAMOUNT,
																						RECEIVENUMBER,
																						WORKTYPEFLAG,
																						STATUS,
																						ENTDATE,
																						ENTTIME,
																						USERID
																					) 
																			VALUES
																					(
																						'".$PROJECTID."',
																						'".$SUBPROJECTID."',
																						'".$LABOURID."',
																						'".$PARTYID."',
																						'".$loadUnloadBkdnIdCtId."',
																						'".$PRODCATTYPEID[$k]."',
																						'".$PRODUCTID[$k]."',
																						'".$packingUnit[$k]."',
																						'".$quantity[$k]."',
																						'".$CHID[$k]."',
																						'".$pocket[$k]."',
																						'".$LOADPRICE."',
																						'".$TOTBILLAMOUNT."',
																						'".$nowMAXRECNO."',
																						'Load',
																						'Active',
																						'".$entDate."',
																						'".$entTime."',
																						'".$userId."'
																					)
									"; 
									
									
									$insertLabWorkHistQueryStatement = mysql_query($insertLabWorkHistQuery);
									
									//Update Labour Work History Table End
									
									// Update FNA Bill Table Start
									$MAX_PARTY_FLAG_BILL = mysql_fetch_array(mysql_query("SELECT MAX(IFNULL(PARTYFLAG,0)) FROM fna_bill WHERE PARTYID = '".$PARTYID."'"));
									$MAXPARTY_FLAG_BILL 		= $MAX_PARTY_FLAG_BILL['MAX(IFNULL(PARTYFLAG,0))'];
									$NOW_MAX_PARTY_FLAG_BILL 	= $MAXPARTY_FLAG_BILL + 1 ;
									$TOT_AMOUNT_PARTY_BILL 		= mysql_fetch_array(mysql_query("SELECT TOTBILLAMOUNT FROM fna_bill WHERE PARTYID = '".$PARTYID."' and PARTYFLAG = '".$MAXPARTY_FLAG_BILL."'"));
									$PARTY_TOT_AMOUNT_BILL = $TOT_AMOUNT_PARTY_BILL['TOTBILLAMOUNT'];
									
									$SESSIONID  =mysql_fetch_array(mysql_query("SELECT SESSIONID FROM fna_session WHERE PRODCATTYPEID = '".$PRODCATTYPEID[$k]."'"));
									$NOWSESSIONID = $SESSIONID['SESSIONID'];
									$QUERYPACKINGUNITID = mysql_fetch_array(mysql_query("SELECT QID, WTID FROM fna_packingunit WHERE PACKINGUNITID = '".$packingUnit[$k]."'"));
									$NOW_QID 			= $QUERYPACKINGUNITID['QID'];
									$NOW_WTID 			= $QUERYPACKINGUNITID['WTID'];
									
									$qvalue = mysql_fetch_array(mysql_query("SELECT QVALUE FROM fna_quantity WHERE QID = '".$NOW_QID."'"));
									$now_qvalue = $qvalue['QVALUE'];
									$TOTQUANTITY_PROD 	= $quantity[$k] * $now_qvalue ;
									$QUERYPRODFARE		= mysql_fetch_array(mysql_query("SELECT UNITFARE FROM fna_productfare WHERE PRODCATTYPEID = '".$PRODCATTYPEID[$k]."' AND PRODUCTID = '".$PRODUCTID[$k]."'"));
									$NOW_UNITFARE		= $QUERYPRODFARE['UNITFARE'];
									$NOW_BILLAMOUNT		= $wtquantity[$k] * $NOW_UNITFARE ; 
									$TOTBILLAMOUNT_PROD	= $NOW_BILLAMOUNT + $PARTY_TOT_AMOUNT_BILL ;
									
									$globalPartyTotalBillAmount = $globalPartyTotalBillAmount + $NOW_BILLAMOUNT ; 
									
									
									$insertFNABillQuery = "
														INSERT INTO 
																	fna_bill
																				(
																					PROJECTID,
																					SUBPROJECTID,
																					SESSIONID,
																					PARTYID,
																					RECEIVENUMBER,
																					PRODCATTYPEID,
																					PRODUCTID,
																					PACKINGUNITID,
																					QUANTITY,
																					WTQNTY,
																					TOTQUANTITY,
																					BILLAMOUNT,
																					TOTBILLAMOUNT,
																					PARTYFLAG,
																					ENTRYDATE,
																					STATUS,
																					ENTDATE,
																					ENTTIME,
																					USERID
																				) 
																		VALUES
																				(
																					'".$PROJECTID."',
																					'".$SUBPROJECTID."',
																					'".$NOWSESSIONID."',
																					'".$PARTYID."',
																					'".$nowMAXRECNO."',
																					'".$PRODCATTYPEID[$k]."',
																					'".$PRODUCTID[$k]."',
																					'".$packingUnit[$k]."',
																					'".$quantity[$k]."',
																					'".$wtquantity[$k]."',
																					'".$wtquantity[$k]."',
																					'".$NOW_BILLAMOUNT."',
																					'".$TOTBILLAMOUNT_PROD."',
																					'".$NOW_MAX_PARTY_FLAG_BILL."',
																					'".$ENTRYDATE."',
																					'Active',
																					'".$entDate."',
																					'".$entTime."',
																					'".$userId."'
																				)
								";
								
								
								$insertFNABillQueryStatement = mysql_query($insertFNABillQuery);
									// Update FNA Bill Table End
										
										
						$k++;
					}
				// Upadate FNA Labour Bill Table Start
				$MAXLABFLAG = mysql_fetch_array(mysql_query("SELECT MAX(LABOURFLAG) FROM fna_labourbill WHERE LABOURID = '".$LABOURID."'"));
				$MAXLABOUR_FLAG = $MAXLABFLAG['MAX(LABOURFLAG)'];
				$NOW_MAXLAB_FLAG = $MAXLABOUR_FLAG + 1;
				$BAL_AMOUNT = mysql_fetch_array(mysql_query("SELECT BALANCEAMOUNT FROM fna_labourbill WHERE LABOURID = '".$LABOURID."' AND LABOURFLAG = '".$MAXLABOUR_FLAG."'"));
				$LAB_BAL_AMOUNT = $BAL_AMOUNT['BALANCEAMOUNT'];
				if(($MAXLABOUR_FLAG == 0) or ($MAXLABOUR_FLAG ='')){
					$NOW_LAB_BALAMOUNT = $globalLabourTotalBillAmount ;
				}else{
					$NOW_LAB_BALAMOUNT = $LAB_BAL_AMOUNT + $globalLabourTotalBillAmount ;
				}
				$insertLabourBillQuery = "
										INSERT INTO 
													fna_labourbill
															(
																PROJECTID,
																SUBPROJECTID,
																LABOURID,
																PARTYID,
																PRODUCTLOADUNLOADID,
																BILLAMOUNT,
																PAYMENTAMOUNT,
																BALANCEAMOUNT,
																LABOURFLAG,
																ENTRYDATE,
																STATUS,
																ENTDATE,
																ENTTIME,
																USERID
															) 
													VALUES
															(
																'".$PROJECTID."',
																'".$SUBPROJECTID."',
																'".$LABOURID."',
																'".$PARTYID."',
																'".$loadCtId."',
																'".$globalLabourTotalBillAmount."',
																'0',
																'".$NOW_LAB_BALAMOUNT."',
																'".$NOW_MAXLAB_FLAG."',
																'".$ENTRYDATE."',
																'Active',
																'".$entDate."',
																'".$entTime."',
																'".$userId."'
															)
					"; 
					
					
					$insertLabourBillQueryStatement = mysql_query($insertLabourBillQuery);
					
				// Upadate FNA Labour Bill Table End
				
				// Upadate FNA Party Bill Table Start	
				
				$MAX_PARTY_FLAG = mysql_fetch_array(mysql_query("SELECT MAX(PARTYFLAG) FROM fna_partybill WHERE PARTYID = '".$PARTYID."'"));
				$MAXPARTY_FLAG = $MAX_PARTY_FLAG['MAX(PARTYFLAG)'];
				$NOW_MAX_PARTY_FLAG = $MAXPARTY_FLAG + 1;
				$BAL_AMOUNT_PARTY = mysql_fetch_array(mysql_query("SELECT BALANCEAMOUNT FROM fna_partybill WHERE PARTYFLAG = '".$MAXPARTY_FLAG."'"));
				$PARTY_BAL_AMOUNT = $BAL_AMOUNT_PARTY['BALANCEAMOUNT'];
				
				if(($MAXPARTY_FLAG == 0) or ($MAXPARTY_FLAG ='')){
					$NOW_PARTY_BALAMOUNT = $globalPartyTotalBillAmount ;
				}else{
					$NOW_PARTY_BALAMOUNT = $PARTY_BAL_AMOUNT + $globalPartyTotalBillAmount ; 
				}
				$insertPartyBillQuery = "
										INSERT INTO 
													fna_partybill
															(
																PROJECTID,
																SUBPROJECTID,
																PARTYID,
																RECEIVENUMBER,
																BILLAMOUNT,
																BALANCEAMOUNT,
																ENTRYDATE,
																PARTYFLAG,
																STATUS,
																ENTDATE,
																ENTTIME,
																USERID
															) 
													VALUES
															(
																'".$PROJECTID."',
																'".$SUBPROJECTID."',
																'".$PARTYID."',
																'".$nowMAXRECNO."',
																'".$globalPartyTotalBillAmount."',
																'".$NOW_PARTY_BALAMOUNT."',
																'".$ENTRYDATE."',
																'".$NOW_MAX_PARTY_FLAG."',
																'Active',
																'".$entDate."',
																'".$entTime."',
																'".$userId."'
															)
					"; 
					
					
					$insertPartyBillQueryStatement = mysql_query($insertPartyBillQuery);
				// Upadate FNA Party Bill Table End
					
					
				} else {
					$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
				}
			}
			return $msg;
			
			
			
			
		}
		// Insert Load Pending Information  End
		
		// Insert Transfer Information Start
		function InsertTransferInfo($userId){
			
			$PROJECTID 			= $_REQUEST["PROJECTID"];
			$SUBPROJECTID		= $_REQUEST["SUBPROJECTID"];
			
			$LABOURID 			= $_REQUEST["LABOURID"];
			$ENTRYDATE	 		= insertDateMySQlFormat($_REQUEST["ENTRYDATE"]);
			
			
			$PRODCATTYPEID		= $_REQUEST["PRODCATTYPEID"];
			$PRODUCTID 			= $_REQUEST["PRODUCTID"];
			$quantity	 		= $_REQUEST["quantity"];
			$packingUnit		= $_REQUEST["packingUnit"];
			$CHID_FROM	 		= $_REQUEST["CHID"];
			$CHID_TO	 		= $_REQUEST["CHID2"];
			$EXTRALABBILL 		= $_REQUEST["EXTRALABBILL"];
			$TOTAL_PRODUCT_LIST	= $_REQUEST["TOTAL_PRODUCT_LIST"];
			
			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
				$EntrySerial_Query_Flag = mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_entryserialno"));
				$MaxFlagEntrySl			= $EntrySerial_Query_Flag['MAX(FLAG)'];
				
				$EntrySerial_Query_No	= mysql_fetch_array(mysql_query("SELECT MAX(ENTRYSERIALNOID) FROM fna_entryserialno"));
				$MaxEntrySlNo			= $EntrySerial_Query_No['MAX(ENTRYSERIALNOID)'] + 1;
		
		
				$insertQueryEntrySl = "
										INSERT INTO 
													fna_entryserialno
																	(
																		ENTRYSERIALNO,
																		PROJECTID,
																		SUBPROJECTID,
																		ENTRYDATE,
																		FLAG,
																		STATUS,
																		ENTDATE,
																		ENTTIME,
																		USERID
																	) 
															VALUES
																	(
																		'".$MaxEntrySlNo."',
																		'".$PROJECTID."',
																		'".$SUBPROJECTID."',
																		'".$ENTRYDATE."',
																		'".$MaxFlagEntrySl."',
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									";
				$insertQueryEntrySlStatement = mysql_query($insertQueryEntrySl);
					$k = 0;
					$globalLabourTotalBillAmount = 0;
					$globalPartyTotalBillAmount = 0;
					
					for($i = 1; $i < $TOTAL_PRODUCT_LIST; $i++ ){
							
						//Update Labour Work History Table Start
						$LABOURIDQUERY  =mysql_fetch_array(mysql_query("SELECT LABCONTACTID FROM fna_labourcontact WHERE LABOURID = '".$LABOURID."'"));
						$LABCONTACTID = $LABOURIDQUERY['LABCONTACTID'];
						$QUERYUNLOADPRICE = mysql_fetch_array(mysql_query("SELECT TRANSFERPRICE FROM fna_labourcontact_bkdn WHERE LABCONTACTID = '".$LABCONTACTID."' AND CHAMBERIDFROM = '".$CHID_FROM[$k]."' AND CHAMBERIDTO = '".$CHID_TO[$k]."' and PACKINGUNITID = '".$packingUnit[$k]."'"));
						$TRANSFERPRICE = $QUERYUNLOADPRICE['TRANSFERPRICE'];
						$TOTBILLAMOUNT = ($quantity[$k] * $TRANSFERPRICE) + $EXTRALABBILL[$k];
						$globalLabourTotalBillAmount = $globalLabourTotalBillAmount + $TOTBILLAMOUNT ;
						
						
						$insertLabWorkHistQuery = "
											INSERT INTO 
														fna_labourworkhistory
																	(
																		ENTRYSERIALNOID,
																		PROJECTID,
																		SUBPROJECTID,
																		LABOURID,
																		PRODUCTLOADUNLOADBKDNID,
																		PRODCATTYPEID,
																		PRODUCTID,
																		PACKINGUNITID,
																		QUANTITY,
																		CHID,
																		BILLAMOUNT,
																		EXTRALABBILL,
																		TOTBILLAMOUNT,
																		WORKTYPEFLAG,
																		STATUS,
																		ENTDATE,
																		ENTTIME,
																		USERID
																	) 
															VALUES
																	(
																		'".$MaxEntrySlNo."',
																		'".$PROJECTID."',
																		'".$SUBPROJECTID."',
																		'".$LABOURID."',
																		'0',
																		'".$PRODCATTYPEID[$k]."',
																		'".$PRODUCTID[$k]."',
																		'".$packingUnit[$k]."',
																		'".$quantity[$k]."',
																		'".$CHID_FROM[$k]."',
																		'".$TRANSFERPRICE."',
																		'".$EXTRALABBILL[$k]."',
																		'".$TOTBILLAMOUNT."',
																		'Transfer',
																		'Active',
																		'".$ENTRYDATE."',
																		'".$entTime."',
																		'".$userId."'
																	)
					";
					
					$insertLabWorkHistQueryStatement = mysql_query($insertLabWorkHistQuery);
					
					//Update Labour Work History Table End
										
					$k++;
				}
				// Upadate FNA Labour Bill Table Start
				$MAXLABFLAG = mysql_fetch_array(mysql_query("SELECT MAX(LABOURFLAG) FROM fna_labourbill WHERE LABOURID = '".$LABOURID."'"));
				$MAXLABOUR_FLAG = $MAXLABFLAG['MAX(LABOURFLAG)'];
				$NOW_MAXLAB_FLAG = $MAXLABOUR_FLAG + 1;
				$BAL_AMOUNT = mysql_fetch_array(mysql_query("SELECT BALANCEAMOUNT FROM fna_labourbill WHERE LABOURID = '".$LABOURID."' AND LABOURFLAG = '".$MAXLABOUR_FLAG."'"));
				$LAB_BAL_AMOUNT = $BAL_AMOUNT['BALANCEAMOUNT'];
				if(($MAXLABOUR_FLAG == 0) or ($MAXLABOUR_FLAG ='')){
					$NOW_LAB_BALAMOUNT = $globalLabourTotalBillAmount ;
				}else{
					$NOW_LAB_BALAMOUNT = $LAB_BAL_AMOUNT + $globalLabourTotalBillAmount ;
				}
				$insertLabourBillQuery = "
										INSERT INTO 
													fna_labourbill
															(
																ENTRYSERIALNOID,
																PROJECTID,
																SUBPROJECTID,
																LABOURID,
																BILLAMOUNT,
																PAYMENTAMOUNT,
																BALANCEAMOUNT,
																LABOURFLAG,
																ENTRYDATE,
																STATUS,
																ENTDATE,
																ENTTIME,
																USERID
															) 
													VALUES
															(
																'".$MaxEntrySlNo."',
																'".$PROJECTID."',
																'".$SUBPROJECTID."',
																'".$LABOURID."',
																'".$globalLabourTotalBillAmount."',
																'0',
																'".$NOW_LAB_BALAMOUNT."',
																'".$NOW_MAXLAB_FLAG."',
																'".$ENTRYDATE."',
																'Active',
																'".$entDate."',
																'".$entTime."',
																'".$userId."'
															)
					"; 
					
					
					$insertLabourBillQueryStatement = mysql_query($insertLabourBillQuery);
					
					if($insertLabourBillQueryStatement){
							$msg = "<span class='validMsg'>This Information  added sucessfully</span>";
						}else{
							$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
							break;
						}
					return $msg;
				// Upadate FNA Labour Bill Table End
			}
		// Insert Transfer Information  End
		
		// Insert Palot Information Start
		function InsertPalotInfo($userId){
			
			$PROJECTID 			= $_REQUEST["PROJECTID"];
			$SUBPROJECTID		= $_REQUEST["SUBPROJECTID"];
			
			$LABOURID 			= $_REQUEST["LABOURID"];
			$ENTRYDATE	 		= insertDateMySQlFormat($_REQUEST["ENTRYDATE"]);
			
			
			$PRODCATTYPEID		= $_REQUEST["PRODCATTYPEID"];
			$PRODUCTID 			= $_REQUEST["PRODUCTID"];
			$quantity	 		= $_REQUEST["quantity"];
			$packingUnit		= $_REQUEST["packingUnit"];
			$CHIDTO		 		= $_REQUEST["CHID"];
			$EXTRALABBILL 		= $_REQUEST["EXTRALABBILL"];
			
			$TOTAL_PRODUCT_LIST	= $_REQUEST["TOTAL_PRODUCT_LIST"];
			
			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
			$EntrySerial_Query_Flag = mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_entryserialno"));
			$MaxFlagEntrySl			= $EntrySerial_Query_Flag['MAX(FLAG)'];
			
			$EntrySerial_Query_No	= mysql_fetch_array(mysql_query("SELECT MAX(ENTRYSERIALNOID) FROM fna_entryserialno"));
			$MaxEntrySlNo			= $EntrySerial_Query_No['MAX(ENTRYSERIALNOID)'] + 1;
	
	
			$insertQueryEntrySl = "
									INSERT INTO 
												fna_entryserialno
																(
																	ENTRYSERIALNO,
																	PROJECTID,
																	SUBPROJECTID,
																	ENTRYDATE,
																	FLAG,
																	STATUS,
																	ENTDATE,
																	ENTTIME,
																	USERID
																) 
														VALUES
																(
																	'".$MaxEntrySlNo."',
																	'".$PROJECTID."',
																	'".$SUBPROJECTID."',
																	'".$ENTRYDATE."',
																	'".$MaxFlagEntrySl."',
																	'Active',
																	'".$entDate."',
																	'".$entTime."',
																	'".$userId."'
																)
								";
			$insertQueryEntrySlStatement = mysql_query($insertQueryEntrySl);
			
				
					$k = 0;
					$globalLabourTotalBillAmount = 0;
					$globalPartyTotalBillAmount = 0;
					
					for($i = 1; $i < $TOTAL_PRODUCT_LIST; $i++ ){
							
						//Update Labour Work History Table Start
						$LABOURIDQUERY  =mysql_fetch_array(mysql_query("SELECT LABCONTACTID FROM fna_labourcontact WHERE LABOURID = '".$LABOURID."'"));
						$LABCONTACTID = $LABOURIDQUERY['LABCONTACTID'];
						$QUERYPALOTPRICE = mysql_fetch_array(mysql_query("SELECT PALOTPRICE FROM fna_labourcontact_bkdn WHERE LABCONTACTID = '".$LABCONTACTID."' AND PACKINGUNITID = '".$packingUnit[$k]."' AND CHAMBERIDTO = '".$CHIDTO[$k]."'"));
						$PALOTPRICE = $QUERYPALOTPRICE['PALOTPRICE'];
						$TOTBILLAMOUNT = ($quantity[$k] * $PALOTPRICE) + $EXTRALABBILL[$k] ;
						$globalLabourTotalBillAmount = $globalLabourTotalBillAmount + $TOTBILLAMOUNT ;
						
						
						$insertLabWorkHistQuery = "
											INSERT INTO 
														fna_labourworkhistory
																	(
																		ENTRYSERIALNOID,
																		PROJECTID,
																		SUBPROJECTID,
																		LABOURID,
																		PRODUCTLOADUNLOADBKDNID,
																		PRODCATTYPEID,
																		PRODUCTID,
																		PACKINGUNITID,
																		QUANTITY,
																		CHID,
																		BILLAMOUNT,
																		EXTRALABBILL,
																		TOTBILLAMOUNT,
																		WORKTYPEFLAG,
																		STATUS,
																		ENTDATE,
																		ENTTIME,
																		USERID
																	) 
															VALUES
																	(
																		'".$MaxEntrySlNo."',
																		'".$PROJECTID."',
																		'".$SUBPROJECTID."',
																		'".$LABOURID."',
																		'0',
																		'".$PRODCATTYPEID[$k]."',
																		'".$PRODUCTID[$k]."',
																		'".$packingUnit[$k]."',
																		'".$quantity[$k]."',
																		'".$CHIDTO[$k]."',
																		'".$PALOTPRICE."',
																		'".$EXTRALABBILL[$k]."',
																		'".$TOTBILLAMOUNT."',
																		'Palot',
																		'Active',
																		'".$ENTRYDATE."',
																		'".$entTime."',
																		'".$userId."'
																	)
					";
					
					$insertLabWorkHistQueryStatement = mysql_query($insertLabWorkHistQuery);
					
					//Update Labour Work History Table End
										
					$k++;
				}
				// Upadate FNA Labour Bill Table Start
				$MAXLABFLAG = mysql_fetch_array(mysql_query("SELECT MAX(LABOURFLAG) FROM fna_labourbill WHERE LABOURID = '".$LABOURID."'"));
				$MAXLABOUR_FLAG = $MAXLABFLAG['MAX(LABOURFLAG)'];
				$NOW_MAXLAB_FLAG = $MAXLABOUR_FLAG + 1;
				$BAL_AMOUNT = mysql_fetch_array(mysql_query("SELECT BALANCEAMOUNT FROM fna_labourbill WHERE LABOURID = '".$LABOURID."' AND LABOURFLAG = '".$MAXLABOUR_FLAG."'"));
				$LAB_BAL_AMOUNT = $BAL_AMOUNT['BALANCEAMOUNT'];
				if(($MAXLABOUR_FLAG == 0) or ($MAXLABOUR_FLAG ='')){
					$NOW_LAB_BALAMOUNT = $globalLabourTotalBillAmount ;
				}else{
					$NOW_LAB_BALAMOUNT = $LAB_BAL_AMOUNT + $globalLabourTotalBillAmount ;
				}
				$insertLabourBillQuery = "
										INSERT INTO 
													fna_labourbill
															(
																ENTRYSERIALNOID,
																PROJECTID,
																SUBPROJECTID,
																LABOURID,
																BILLAMOUNT,
																PAYMENTAMOUNT,
																BALANCEAMOUNT,
																LABOURFLAG,
																ENTRYDATE,
																STATUS,
																ENTDATE,
																ENTTIME,
																USERID
															) 
													VALUES
															(
																'".$MaxEntrySlNo."',
																'".$PROJECTID."',
																'".$SUBPROJECTID."',
																'".$LABOURID."',
																'".$globalLabourTotalBillAmount."',
																'0',
																'".$NOW_LAB_BALAMOUNT."',
																'".$NOW_MAXLAB_FLAG."',
																'".$ENTRYDATE."',
																'Active',
																'".$entDate."',
																'".$entTime."',
																'".$userId."'
															)
					"; 
					
					
					$insertLabourBillQueryStatement = mysql_query($insertLabourBillQuery);
					
					if($insertLabourBillQueryStatement){
							$msg = "<span class='validMsg'>This Information  added sucessfully</span>";
						}else{
							$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
							break;
						}
					
				// Upadate FNA Labour Bill Table End
				return $msg;
			}
		// Insert Palot Information  End
		
		// Insert Palot Information Start
		function InsertShadeInfo($userId){
			
			$PROJECTID 			= $_REQUEST["PROJECTID"];
			$SUBPROJECTID		= $_REQUEST["SUBPROJECTID"];
			
			$LABOURID 			= $_REQUEST["LABOURID"];
			$ENTRYDATE	 		= insertDateMySQlFormat($_REQUEST["ENTRYDATE"]);
			
			
			$PRODCATTYPEID		= $_REQUEST["PRODCATTYPEID"];
			$PRODUCTID 			= $_REQUEST["PRODUCTID"];
			$quantity	 		= $_REQUEST["quantity"];
			$packingUnit		= $_REQUEST["packingUnit"];
			$CHIDTO		 		= $_REQUEST["CHID"];
			$EXTRALABBILL 		= $_REQUEST["EXTRALABBILL"];
			
			$TOTAL_PRODUCT_LIST	= $_REQUEST["TOTAL_PRODUCT_LIST"];
			
			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
			$EntrySerial_Query_Flag = mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_entryserialno"));
			$MaxFlagEntrySl			= $EntrySerial_Query_Flag['MAX(FLAG)'];
			
			$EntrySerial_Query_No	= mysql_fetch_array(mysql_query("SELECT MAX(ENTRYSERIALNOID) FROM fna_entryserialno"));
			$MaxEntrySlNo			= $EntrySerial_Query_No['MAX(ENTRYSERIALNOID)'] + 1;
	
	
			$insertQueryEntrySl = "
									INSERT INTO 
												fna_entryserialno
																(
																	ENTRYSERIALNO,
																	PROJECTID,
																	SUBPROJECTID,
																	ENTRYDATE,
																	FLAG,
																	STATUS,
																	ENTDATE,
																	ENTTIME,
																	USERID
																) 
														VALUES
																(
																	'".$MaxEntrySlNo."',
																	'".$PROJECTID."',
																	'".$SUBPROJECTID."',
																	'".$ENTRYDATE."',
																	'".$MaxFlagEntrySl."',
																	'Active',
																	'".$entDate."',
																	'".$entTime."',
																	'".$userId."'
																)
								";
			$insertQueryEntrySlStatement = mysql_query($insertQueryEntrySl);
			
			
				
					$k = 0;
					$globalLabourTotalBillAmount = 0;
					$globalPartyTotalBillAmount = 0;
					
					for($i = 1; $i < $TOTAL_PRODUCT_LIST; $i++ ){
							
						//Update Labour Work History Table Start
						$LABOURIDQUERY  =mysql_fetch_array(mysql_query("SELECT LABCONTACTID FROM fna_labourcontact WHERE LABOURID = '".$LABOURID."'"));
						$LABCONTACTID = $LABOURIDQUERY['LABCONTACTID'];
						$QUERYPALOTPRICE = mysql_fetch_array(mysql_query("SELECT SHADEPRICE FROM fna_labourcontact_bkdn WHERE LABCONTACTID = '".$LABCONTACTID."' AND PACKINGUNITID = '".$packingUnit[$k]."' AND CHAMBERIDTO = '".$CHIDTO[$k]."'"));
						$SHADEPRICE = $QUERYPALOTPRICE['SHADEPRICE'];
						$TOTBILLAMOUNT = ($quantity[$k] * $SHADEPRICE) + $EXTRALABBILL[$k] ;
						$globalLabourTotalBillAmount = $globalLabourTotalBillAmount + $TOTBILLAMOUNT ;
						
						
						$insertLabWorkHistQuery = "
											INSERT INTO 
														fna_labourworkhistory
																	(
																		ENTRYSERIALNOID,
																		PROJECTID,
																		SUBPROJECTID,
																		LABOURID,
																		PRODUCTLOADUNLOADBKDNID,
																		PRODCATTYPEID,
																		PRODUCTID,
																		PACKINGUNITID,
																		QUANTITY,
																		CHID,
																		BILLAMOUNT,
																		EXTRALABBILL,
																		TOTBILLAMOUNT,
																		WORKTYPEFLAG,
																		STATUS,
																		ENTDATE,
																		ENTTIME,
																		USERID
																	) 
															VALUES
																	(
																		'".$MaxEntrySlNo."',
																		'".$PROJECTID."',
																		'".$SUBPROJECTID."',
																		'".$LABOURID."',
																		'0',
																		'".$PRODCATTYPEID[$k]."',
																		'".$PRODUCTID[$k]."',
																		'".$packingUnit[$k]."',
																		'".$quantity[$k]."',
																		'".$CHIDTO[$k]."',
																		'".$SHADEPRICE."',
																		'".$EXTRALABBILL[$k]."',
																		'".$TOTBILLAMOUNT."',
																		'Shade',
																		'Active',
																		'".$ENTRYDATE."',
																		'".$entTime."',
																		'".$userId."'
																	)
					";
					
					$insertLabWorkHistQueryStatement = mysql_query($insertLabWorkHistQuery);
					
					//Update Labour Work History Table End
										
					$k++;
				}
				// Upadate FNA Labour Bill Table Start
				$MAXLABFLAG = mysql_fetch_array(mysql_query("SELECT MAX(LABOURFLAG) FROM fna_labourbill WHERE LABOURID = '".$LABOURID."'"));
				$MAXLABOUR_FLAG = $MAXLABFLAG['MAX(LABOURFLAG)'];
				$NOW_MAXLAB_FLAG = $MAXLABOUR_FLAG + 1;
				$BAL_AMOUNT = mysql_fetch_array(mysql_query("SELECT BALANCEAMOUNT FROM fna_labourbill WHERE LABOURID = '".$LABOURID."' AND LABOURFLAG = '".$MAXLABOUR_FLAG."'"));
				$LAB_BAL_AMOUNT = $BAL_AMOUNT['BALANCEAMOUNT'];
				if(($MAXLABOUR_FLAG == 0) or ($MAXLABOUR_FLAG ='')){
					$NOW_LAB_BALAMOUNT = $globalLabourTotalBillAmount ;
				}else{
					$NOW_LAB_BALAMOUNT = $LAB_BAL_AMOUNT + $globalLabourTotalBillAmount ;
				}
				$insertLabourBillQuery = "
										INSERT INTO 
													fna_labourbill
															(
																ENTRYSERIALNOID,
																PROJECTID,
																SUBPROJECTID,
																LABOURID,
																BILLAMOUNT,
																PAYMENTAMOUNT,
																BALANCEAMOUNT,
																LABOURFLAG,
																ENTRYDATE,
																STATUS,
																ENTDATE,
																ENTTIME,
																USERID
															) 
													VALUES
															(
																'".$MaxEntrySlNo."',
																'".$PROJECTID."',
																'".$SUBPROJECTID."',
																'".$LABOURID."',
																'".$globalLabourTotalBillAmount."',
																'0',
																'".$NOW_LAB_BALAMOUNT."',
																'".$NOW_MAXLAB_FLAG."',
																'".$ENTRYDATE."',
																'Active',
																'".$entDate."',
																'".$entTime."',
																'".$userId."'
															)
					"; 
					
					
					$insertLabourBillQueryStatement = mysql_query($insertLabourBillQuery);
					
					if($insertLabourBillQueryStatement){
							$msg = "<span class='validMsg'>This Information  added sucessfully</span>";
						}else{
							$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
							break;
						}
					
				// Upadate FNA Labour Bill Table End
				return $msg;
			}
		// Insert Palot Information  End
		
		// Insert Egg Sell Information Start
		function insertEggSellInfo($userId){
			
			$PROJECTID			= $_REQUEST["PROJECTID"];
			$SUBPROJECTID		= $_REQUEST["SUBPROJECTID"];
			$BATCHNO_ES			= $_REQUEST["BATCHNO_ES"];
			$STOCKINHAND_ES		= $_REQUEST["STOCKINHAND_ES"];
			$ESDATE				= insertDateMySQlFormat($_REQUEST["ESDATE"]);
			
			$SCID				= $_REQUEST["SCID"];
			$PARTYID			= $_REQUEST["PARTYID"];
			$QUANTITY 			= $_REQUEST["QUANTITY"];
			$RATE		 		= $_REQUEST["RATE"];
			$TOTALPRICE			= $_REQUEST["TOTALPRICE"];
			
			$TOTAL_PRODUCT_LIST	= $_REQUEST["TOTAL_PRODUCT_LIST"];
			
			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
					$EntrySerial_Query_Flag = mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_entryserialno"));
					$MaxFlagEntrySl			= $EntrySerial_Query_Flag['MAX(FLAG)'];
					
					$EntrySerial_Query_No	= mysql_fetch_array(mysql_query("SELECT MAX(ENTRYSERIALNOID) FROM fna_entryserialno"));
					$MaxEntrySlNo			= $EntrySerial_Query_No['MAX(ENTRYSERIALNOID)'] + 1;
			
			
					$insertQueryEntrySl = "
											INSERT INTO 
														fna_entryserialno
																		(
																			ENTRYSERIALNO,
																			PROJECTID,
																			SUBPROJECTID,
																			ENTRYDATE,
																			FLAG,
																			STATUS,
																			ENTDATE,
																			ENTTIME,
																			USERID
																		) 
																VALUES
																		(
																			'".$MaxEntrySlNo."',
																			'".$PROJECTID."',
																			'".$SUBPROJECTID."',
																			'".$ESDATE."',
																			'".$MaxFlagEntrySl."',
																			'Active',
																			'".$entDate."',
																			'".$entTime."',
																			'".$userId."'
																		)
										";
					$insertQueryEntrySlStatement = mysql_query($insertQueryEntrySl);
					
					$k = 0;
					for($i = 1; $i < $TOTAL_PRODUCT_LIST; $i++ ){
						
						
							
						
						$BatchFlag		  		= mysql_fetch_array(mysql_query("SELECT MAX(BATCHFLAG) FROM pal_egg_sell WHERE BATCHNO = '".$BATCHNO_ES."'"));
						$MaxBatchFlag 			= $BatchFlag['MAX(BATCHFLAG)'];
						$NowMaxBatchFlag		= $BatchFlag['MAX(BATCHFLAG)'] + 1;
						
						$TOTQUANTITY_QUERY 		= mysql_fetch_array(mysql_query("SELECT * FROM pal_egg_sell WHERE BATCHNO = '".$BATCHNO_ES."' AND BATCHFLAG = '".$MaxBatchFlag."'"));
						$TOTQUANTITY 			= $TOTQUANTITY_QUERY['TOTQUANTITY'];
						$NOW_TOTQUANTITY		= $TOTQUANTITY + $QUANTITY[$k] ; 
						
						$GRANDTOTALPRICE		= $TOTQUANTITY_QUERY['GRANDTOTALPRICE'];
						$NOW_GRANDTOTALPRICE	= $GRANDTOTALPRICE + $TOTALPRICE[$k] ;
						 
						$insertEggSellQuery = "
												INSERT INTO 
																pal_egg_sell
																	(
																		ENTRYSERIALNOID,
																		SCID,
																		PROJECTID,
																		SUBPROJECTID,
																		BATCHNO,
																		PARTYID,
																		RATE,
																		QUANTITY,
																		TOTQUANTITY,
																		TOTPRICE,
																		GRANDTOTALPRICE,
																		BATCHFLAG,
																		ESDATE,
																		STATUS,
																		ENTDATE,
																		ENTTIME,
																		USERID
																	) 
															VALUES
																	(
																		'".$MaxEntrySlNo."',
																		'".$SCID[$k]."',
																		'".$PROJECTID."',
																		'".$SUBPROJECTID."',
																		'".$BATCHNO_ES."',
																		'".$PARTYID[$k]."',
																		'".$RATE[$k]."',
																		'".$QUANTITY[$k]."',
																		'".$NOW_TOTQUANTITY."',
																		'".$TOTALPRICE[$k]."',
																		'".$NOW_GRANDTOTALPRICE."',
																		'".$NowMaxBatchFlag."',
																		'".$ESDATE."',
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
											";
						
						$insertEggSellQueryStatement = mysql_query($insertEggSellQuery);
						$esid =  mysql_insert_id();
						if($insertEggSellQueryStatement){
							//Update Egg Production Table Start
							$BatchFlag_EP		= mysql_fetch_array(mysql_query("SELECT MAX(BATCHFLAG) FROM pal_egg_production WHERE BATCHNO = '".$BATCHNO_ES."'"));
							$MaxBatchFlag_EP	= $BatchFlag_EP['MAX(BATCHFLAG)'];
							$NowMaxBatchFlag_EP	= $BatchFlag_EP['MAX(BATCHFLAG)'] + 1;
							
							$EggProdQuery		= mysql_fetch_array(mysql_query("SELECT * FROM pal_egg_production WHERE BATCHNO = '".$BATCHNO_ES."' AND BATCHFLAG = '".$MaxBatchFlag_EP."'"));
							$MURGIQNTY			= $EggProdQuery['MURGIQNTY'];
							$EGGQNTY			= $EggProdQuery['EGGQNTY'];
							$EGGTOTQNTY			= $EggProdQuery['EGGTOTQNTY'];
							$EGGPERCENTAGE		= $EggProdQuery['EGGPERCENTAGE'];
							$EPDATE				= $EggProdQuery['EPDATE'];
							$BATCHFLAG			= $EggProdQuery['BATCHFLAG'];
							
							$NowEggTotQnty		= $EGGTOTQNTY - $QUANTITY[$k] ; 
							
							$insertEggProdQuery = "
													INSERT INTO 
																pal_egg_production
																			(
																				ENTRYSERIALNOID,
																				PROJECTID,
																				SUBPROJECTID,
																				BATCHNO,
																				MURGIQNTY,
																				EGGQNTY,
																				EGGTOTQNTY,
																				EGGPERCENTAGE,
																				EPDATE,
																				BATCHFLAG,
																				STATUS,
																				ENTDATE,
																				ENTTIME,
																				USERID
																			) 
																	VALUES
																			(
																				'".$MaxEntrySlNo."',
																				'".$PROJECTID."',
																				'".$SUBPROJECTID."',
																				'".$BATCHNO_ES."',
																				'".$MURGIQNTY."',
																				'".$QUANTITY[$k]."',
																				'".$NowEggTotQnty."',
																				'".$EGGPERCENTAGE."',
																				'".$EPDATE."',
																				'".$NowMaxBatchFlag_EP."',
																				'Out',
																				'".$entDate."',
																				'".$entTime."',
																				'".$userId."'
																			)
																		"; 
							$insertEggProdQueryStatement = mysql_query($insertEggProdQuery);
							
							//Hatching Table Insert Start
							
								 if($PARTYID[$k] == '3'){
									 
									$OHEFLAG_QUERY		= mysql_fetch_array(mysql_query("SELECT MAX(OHEFLAG) FROM hatch_opening_hatching_egg "));
									$MaxOHEFLAG			= $OHEFLAG_QUERY['MAX(OHEFLAG)'];
									$NowMaxOHEFLAG		= $OHEFLAG_QUERY['MAX(OHEFLAG)'] + 1;
									
									$OpenHatchQuery		= mysql_fetch_array(mysql_query("SELECT * FROM hatch_opening_hatching_egg WHERE OHEFLAG = '".$MaxOHEFLAG."'"));
									$TOTEGGQNTY			= $OpenHatchQuery['TOTEGGQNTY'];
									$TOTPRICE_EGG		= $OpenHatchQuery['TOTPRICE'];
									$AVGRATEPEREGG		= $OpenHatchQuery['AVGRATEPEREGG'];
									
									$Now_TOTEGGQNTY		= $TOTEGGQNTY + $QUANTITY[$k] ; 
									$Now_TOTPRICE_EGG	= $TOTPRICE_EGG + $TOTALPRICE[$k] ;
									
									$AvgRate_Egg		=  $Now_TOTPRICE_EGG / $Now_TOTEGGQNTY ;
									
									$insertOpenHatchEggQuery = "
																	INSERT INTO 
																				hatch_opening_hatching_egg
																								(
																									ENTRYSERIALNOID,
																									ESID,
																									PARTYID,
																									PROJECTID,
																									SUBPROJECTID,
																									BATCHNO,
																									OPENDATE,
																									EGGQUANTITY,
																									TOTEGGQNTY,
																									PRICE,
																									TOTPRICE,
																									RATE,
																									AVGRATEPEREGG,
																									OHEFLAG,
																									STATUS,
																									ENTDATE,
																									ENTTIME,
																									USERID
																								) 
																							VALUES
																								(
																									'".$MaxEntrySlNo."',
																									'".$esid."',
																									'4',
																									'4',
																									'9',
																									'".$BATCHNO_ES."',
																									'".$ESDATE."',
																									'".$QUANTITY[$k]."',
																									'".$Now_TOTEGGQNTY."',
																									'".$TOTALPRICE[$k]."',
																									'".$Now_TOTPRICE_EGG."',
																									'".$RATE[$k]."',
																									'".$AvgRate_Egg."',
																									'".$NowMaxOHEFLAG."',
																									'In',
																									'".$entDate."',
																									'".$entTime."',
																									'".$userId."'
																								)
																							"; 
									$insertOpenHatchEggQueryStatement = mysql_query($insertOpenHatchEggQuery);
									
									//Update Party Bill Table Start
										$PartyFlagQueryPoult			= mysql_fetch_array(mysql_query("SELECT MAX(PARTYFLAG) FROM fna_partybill WHERE PARTYID = '".$PARTYID[$k]."' AND PURSELLFLAG = 'Sell' "));
										$MaxPartyFlagPoult				= $PartyFlagQueryPoult['MAX(PARTYFLAG)'];
										$NowMaxPartyFlagPoult			= $PartyFlagQueryPoult['MAX(PARTYFLAG)'] + 1;
										
										$PartyBalanceQueryPoult			= mysql_fetch_array(mysql_query("SELECT BALANCEAMOUNT FROM fna_partybill WHERE PARTYID = '".$PARTYID[$k]."' AND PARTYFLAG = '".$MaxPartyFlagPoult."' AND PURSELLFLAG = 'Sell'"));
										$PartyBalanceAmountPoult		= $PartyBalanceQueryPoult['BALANCEAMOUNT'];
										$NowPartyBalanceAmountPoult		= $PartyBalanceAmountPoult ; 
										
										$insertPartyQuery 			= "
																		INSERT INTO 
																					fna_partybill
																									(
																										ENTRYSERIALNOID,
																										PARTYID,
																										PROJECTID,
																										SUBPROJECTID,
																										SELL_BILLAMOUNT,
																										PAYMENTAMOUNT,
																										RECEIVEAMOUNT,
																										BALANCEAMOUNT,
																										ENTRYDATE,
																										PARTYFLAG,
																										STATUS,
																										PURSELLFLAG,
																										ENTDATE,
																										ENTTIME,
																										USERID
																									) 
																								VALUES
																									(
																										'".$MaxEntrySlNo."',
																										'".$PARTYID[$k]."',
																										'".$PROJECTID."',
																										'".$SUBPROJECTID."',
																										'".$TOTALPRICE[$k]."',
																										'0',
																										'".$TOTALPRICE[$k]."',
																										'".$NowPartyBalanceAmountPoult."',
																										'".$ESDATE."',
																										'".$NowMaxPartyFlagPoult."',
																										'Sell',
																										'Sell',
																										'".$entDate."',
																										'".$entTime."',
																										'".$userId."'
																									)
																								"; 
										$insertPartyQueryStatement = mysql_query($insertPartyQuery);
										
										//-----------------------------Update Daily Income Expanse Table Start-----------------------------
										
										$INEX_FLAG	 			= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_daily_income_expanse"));
										$MAXINEX_FLAG	 		= $INEX_FLAG['MAX(FLAG)'];
										$NOW_MAXINEX_FLAG	 	= $MAXINEX_FLAG + 1;
										
										//$PARTYNAME_QRY 			= mysql_fetch_array(mysql_query("SELECT PARTYNAME FROM fna_party WHERE PARTYID = '".$PARTYID."'"));
										//$PARTYNAME				= $PARTYNAME_QRY['PARTYNAME'];
										$NOW_DESCRIPTION		= 'Payment Receive from Hatchery. Batch No: '.' '.$BATCHNO_ES.', Qnty : '.$QUANTITY[$k].' * '.$RATE[$k].'';
										
										$insertDailyInExQuery = "
																INSERT INTO 
																				fna_daily_income_expanse
																											(
																												ENTRYSERIALNOID,
																												PROJECTID,
																												SUBPROJECTID,
																												DATE,
																												INHID,
																												INCOME,
																												DESCRIPTION,
																												FLAG,
																												STATUS,
																												ENTDATE,
																												ENTTIME,
																												USERID
																											) 
																									VALUES
																											(
																												'".$MaxEntrySlNo."',
																												'".$PROJECTID."',
																												'".$SUBPROJECTID."',
																												'".$ESDATE."',
																												'20',
																												'".$TOTALPRICE[$k]."',
																												'".$NOW_DESCRIPTION."',
																												'".$NOW_MAXINEX_FLAG."',
																												'Active',
																												'".$entDate."',
																												'".$entTime."',
																												'".$userId."'
																											)
																	";
												
												
									$insertDailyInExQueryStatement = mysql_query($insertDailyInExQuery);
									
									//----------------------------Update Daily Income Expanse Table End --------------------------
										
										$PartyFlagQueryHatch			= mysql_fetch_array(mysql_query("SELECT MAX(PARTYFLAG) FROM fna_partybill WHERE PARTYID = '4' AND PURSELLFLAG = 'Purchase'"));
										$MaxPartyFlagHatch				= $PartyFlagQueryHatch['MAX(PARTYFLAG)'];
										$NowMaxPartyFlagHatch			= $PartyFlagQueryHatch['MAX(PARTYFLAG)'] + 1;
										
										$PartyBalanceQueryHatch			= mysql_fetch_array(mysql_query("SELECT BALANCEAMOUNT FROM fna_partybill WHERE PARTYID = '4' AND PARTYFLAG = '".$MaxPartyFlagHatch."' AND PURSELLFLAG = 'Purchase'"));
										$PartyBalanceAmountHatch		= $PartyBalanceQueryHatch['BALANCEAMOUNT'];
										$NowPartyBalanceAmountHatch		= $PartyBalanceAmountHatch  ; 
										
										$insertPartyQueryHatch 			= "
																		INSERT INTO 
																					fna_partybill
																									(
																										ENTRYSERIALNOID,
																										PARTYID,
																										PROJECTID,
																										SUBPROJECTID,
																										PUR_BILLAMOUNT,
																										PAYMENTAMOUNT,
																										RECEIVEAMOUNT,
																										BALANCEAMOUNT,
																										ENTRYDATE,
																										PARTYFLAG,
																										STATUS,
																										PURSELLFLAG,
																										ENTDATE,
																										ENTTIME,
																										USERID
																									) 
																								VALUES
																									(
																										'".$MaxEntrySlNo."',
																										'4',
																										'4',
																										'9',
																										'".$TOTALPRICE[$k]."',
																										'".$TOTALPRICE[$k]."',
																										'0',
																										'".$NowPartyBalanceAmountHatch."',
																										'".$ESDATE."',
																										'".$NowMaxPartyFlagHatch."',
																										'Buy',
																										'Purchase',
																										'".$entDate."',
																										'".$entTime."',
																										'".$userId."'
																									)
																								"; 
										$insertPartyQueryHatchStatement = mysql_query($insertPartyQueryHatch);
										//Update Party Bill Table End
										
										//--------------------------------Update Daily Income Expanse Table Start----------------------------------------
										
										$INEX_FLAG	 			= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_daily_income_expanse"));
										$MAXINEX_FLAG	 		= $INEX_FLAG['MAX(FLAG)'];
										$NOW_MAXINEX_FLAG	 	= $MAXINEX_FLAG + 1;
										
										$DESCRIPTION_NOW		= 'Payment to Poultry Firm.. Batch No: '.' '.$BATCHNO_ES.' , Qnty : '.$QUANTITY[$k].' * '.$RATE[$k].'';
										
										$insertDailyInExQuery = "
																INSERT INTO 
																				fna_daily_income_expanse
																											(
																												ENTRYSERIALNOID,
																												PROJECTID,
																												SUBPROJECTID,
																												DATE,
																												EXPHID,
																												EXPANSE,
																												DESCRIPTION,
																												FLAG,
																												STATUS,
																												ENTDATE,
																												ENTTIME,
																												USERID
																											) 
																									VALUES
																											(
																												'".$MaxEntrySlNo."',
																												'4',
																												'9',
																												'".$ESDATE."',
																												'156',
																												'".$TOTALPRICE[$k]."',
																												'".$DESCRIPTION_NOW."',
																												'".$NOW_MAXINEX_FLAG."',
																												'Active',
																												'".$entDate."',
																												'".$entTime."',
																												'".$userId."'
																											)
																	";
												
												
												$insertDailyInExQueryStatement = mysql_query($insertDailyInExQuery);
							
										//---------------------------------------Update Daily Income Expanse Table End ----------------------------------------
										
								 
								}else{
										//Update Party Bill Table Start
										$PartyFlagQuery				= mysql_fetch_array(mysql_query("SELECT MAX(PARTYFLAG) FROM fna_partybill WHERE PARTYID = '".$PARTYID[$k]."' AND PURSELLFLAG = 'Sell'"));
										$MaxPartyFlag				= $PartyFlagQuery['MAX(PARTYFLAG)'];
										$NowMaxPartyFlag			= $PartyFlagQuery['MAX(PARTYFLAG)'] + 1;
										
										$PartyBalanceQuery			= mysql_fetch_array(mysql_query("SELECT BALANCEAMOUNT FROM fna_partybill WHERE PARTYID = '".$PARTYID[$k]."' AND PARTYFLAG = '".$MaxPartyFlag."' AND PURSELLFLAG = 'Sell'"));
										$PartyBalanceAmount			= $PartyBalanceQuery['BALANCEAMOUNT'];
										$NowPartyBalanceAmount		= $PartyBalanceAmount + $TOTALPRICE[$k] ; 
										
										$insertPartyQuery 			= "
																		INSERT INTO 
																					fna_partybill
																									(
																										ENTRYSERIALNOID,
																										PARTYID,
																										PROJECTID,
																										SUBPROJECTID,
																										SELL_BILLAMOUNT,
																										PAYMENTAMOUNT,
																										RECEIVEAMOUNT,
																										BALANCEAMOUNT,
																										ENTRYDATE,
																										PARTYFLAG,
																										STATUS,
																										PURSELLFLAG,
																										ENTDATE,
																										ENTTIME,
																										USERID
																									) 
																								VALUES
																									(
																										'".$MaxEntrySlNo."',
																										'".$PARTYID[$k]."',
																										'".$PROJECTID."',
																										'".$SUBPROJECTID."',
																										'".$TOTALPRICE[$k]."',
																										'0',
																										'0',
																										'".$NowPartyBalanceAmount."',
																										'".$ESDATE."',
																										'".$NowMaxPartyFlag."',
																										'Sell',
																										'Sell',
																										'".$entDate."',
																										'".$entTime."',
																										'".$userId."'
																									)
																								"; 
										$insertPartyQueryStatement = mysql_query($insertPartyQuery);
										//Update Party Bill Table End
								}
							//Hatching Table Insert End
							$msg = "<span class='validMsg'>This Information [ $BATCHNO_ES ] added sucessfully</span>";
							}else{
								$msg = "<span class='errorMsg'>Sorry!...Last EP!</span>";
							}
						// Upadate Egg production Table End
						$k++;
				}
		
		return $msg;
	}
		// Insert Egg Sell Information  End
		
		// Insert Morog Murgi Sell Information Start
		function insertMurMorSellInfo($userId){
			
			$PROJECTID				= $_REQUEST["PROJECTID"];
			$SUBPROJECTID			= $_REQUEST["SUBPROJECTID"];
			$BATCHNO_MMS			= $_REQUEST["BATCHNO_MMS"];
			$STOCKINHAND_MOR		= $_REQUEST["STOCKINHAND_MOR"];
			$STOCKINHAND_MUR		= $_REQUEST["STOCKINHAND_MUR"];
			$MMSELLDATE				= insertDateMySQlFormat($_REQUEST["MMSELLDATE"]);
			
			$MorMur				= $_REQUEST["SCID"];
			$PARTYID			= $_REQUEST["PARTYID"];
			$QUANTITY 			= $_REQUEST["QUANTITY"];
			$RATE		 		= $_REQUEST["RATE"];
			$TOTALPRICE			= $_REQUEST["TOTALPRICE"];
			
			$TOTAL_PRODUCT_LIST	= $_REQUEST["TOTAL_PRODUCT_LIST"];
			
			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
				$Query		= "
									SELECT 
											BATCHNO,
											MMSELLDATE
									FROM 
											pal_morog_murgi_sell
									WHERE BATCHNO = '".$BATCHNO_MMS."'
									AND MMSELLDATE = '".$MMSELLDATE."'
							";
				$QueryStatement	= mysql_query($Query);
				if(mysql_num_rows($QueryStatement)>0) {
					$msg = "<span class='errorMsg'>Sorry, Today's This Batch Data . [ $BATCHNO_MMS ] already exist!</span>";
				}else{	
				
						$EntrySerial_Query_Flag = mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_entryserialno"));
						$MaxFlagEntrySl			= $EntrySerial_Query_Flag['MAX(FLAG)'];
						
						$EntrySerial_Query_No	= mysql_fetch_array(mysql_query("SELECT MAX(ENTRYSERIALNOID) FROM fna_entryserialno"));
						$MaxEntrySlNo			= $EntrySerial_Query_No['MAX(ENTRYSERIALNOID)'] + 1;
				
				
						$insertQueryEntrySl = "
												INSERT INTO 
															fna_entryserialno
																			(
																				ENTRYSERIALNO,
																				PROJECTID,
																				SUBPROJECTID,
																				ENTRYDATE,
																				FLAG,
																				STATUS,
																				ENTDATE,
																				ENTTIME,
																				USERID
																			) 
																	VALUES
																			(
																				'".$MaxEntrySlNo."',
																				'".$PROJECTID."',
																				'".$SUBPROJECTID."',
																				'".$ENTRYDATE."',
																				'".$MaxFlagEntrySl."',
																				'Active',
																				'".$entDate."',
																				'".$entTime."',
																				'".$userId."'
																			)
											";
						$insertQueryEntrySlStatement = mysql_query($insertQueryEntrySl);

					
					
							$k = 0;
							for($i = 1; $i < $TOTAL_PRODUCT_LIST; $i++ ){
								
								if($MorMur[$k] == 'Morog'){	
								
								$BatchFlag		  		= mysql_fetch_array(mysql_query("SELECT MAX(BATCHFLAG) FROM pal_morog_murgi_sell WHERE BATCHNO = '".$BATCHNO_MMS."'"));
								$MaxBatchFlag 			= $BatchFlag['MAX(BATCHFLAG)'];
								$NowMaxBatchFlag		= $BatchFlag['MAX(BATCHFLAG)'] + 1;
								
								$TOTQUANTITY_QUERY 		= mysql_fetch_array(mysql_query("SELECT * FROM pal_morog_murgi_sell WHERE BATCHNO = '".$BATCHNO_MMS."' AND BATCHFLAG = '".$MaxBatchFlag."'"));
								$TOTQUANTITY 			= $TOTQUANTITY_QUERY['TOTQUANTITY'];
								$NOW_TOTQUANTITY		= $TOTQUANTITY + $QUANTITY[$k] ; 
								
								$GRANDTOTALPRICE		= $TOTQUANTITY_QUERY['GRANDTOTPRICE'];
								$NOW_GRANDTOTALPRICE	= $GRANDTOTALPRICE + $TOTALPRICE[$k] ;
								 
								$insertMorSellQuery = "
														INSERT INTO 
																		pal_morog_murgi_sell
																			(
																				ENTRYSERIALNOID,
																				BATCHNO,
																				PROJECTID,
																				SUBPROJECTID,
																				PARTYID,
																				MURGIQNTY,
																				MOROGQNTY,
																				TOTQUANTITY,
																				RATE,
																				TOTPRICE,
																				GRANDTOTPRICE,
																				BATCHFLAG,
																				MMSELLDATE,
																				STATUS,
																				ENTDATE,
																				ENTTIME,
																				USERID
																			) 
																	VALUES
																			(
																				'".$MaxEntrySlNo."',
																				'".$BATCHNO_MMS."',
																				'".$PROJECTID."',
																				'".$SUBPROJECTID."',
																				'".$PARTYID[$k]."',
																				'0',
																				'".$QUANTITY[$k]."',
																				'".$NOW_TOTQUANTITY."',
																				'".$RATE[$k]."',
																				'".$TOTALPRICE[$k]."',
																				'".$NOW_GRANDTOTALPRICE."',
																				'".$NowMaxBatchFlag."',
																				'".$MMSELLDATE."',
																				'Active',
																				'".$entDate."',
																				'".$entTime."',
																				'".$userId."'
																			)
													";
							
								$insertMorSellQueryStatement = mysql_query($insertMorSellQuery);
								if($insertMorSellQueryStatement){
									//Update Egg Production Table Start
									$BatchFlag_EP		= mysql_fetch_array(mysql_query("SELECT MAX(BATCHFLAG) FROM pal_morog WHERE BATCHNO = '".$BATCHNO_MMS."'"));
									$MaxBatchFlag_EP	= $BatchFlag_EP['MAX(BATCHFLAG)'];
									$NowMaxBatchFlag_EP	= $BatchFlag_EP['MAX(BATCHFLAG)'] + 1;
									
									$EggProdQuery		= mysql_fetch_array(mysql_query("SELECT * FROM pal_morog WHERE BATCHNO = '".$BATCHNO_MMS."' AND BATCHFLAG = '".$MaxBatchFlag_EP."'"));
									$DOID				= $EggProdQuery['DOID'];
									$STOCKINHAND		= $EggProdQuery['STOCKINHAND'];
									$DEADSTOCK			= $EggProdQuery['DEADSTOCK'];
									$CANCELSTOCK		= $EggProdQuery['CANCELSTOCK'];
									$SELLSTOCK			= $EggProdQuery['SELLSTOCK'];
									$BATCHFLAG			= $EggProdQuery['BATCHFLAG'];
									
									$NowSTOCKINHAND		= $STOCKINHAND - $QUANTITY[$k] ; 
									
									$insertMorogQuery = "
															INSERT INTO 
																		pal_morog
																					(
																						ENTRYSERIALNOID,
																						DOID,
																						PROJECTID,
																						SUBPROJECTID,
																						PARTYID,
																						BATCHNO,
																						ENTRYDATE,
																						STOCKINHAND,
																						DEADSTOCK,
																						CANCELSTOCK,
																						SELLSTOCK,
																						SELLPRICE,
																						BATCHFLAG,
																						STATUS,
																						ENTDATE,
																						ENTTIME,
																						USERID
																					) 
																			VALUES
																					(
																						'".$MaxEntrySlNo."',
																						'".$DOID."',
																						'".$PROJECTID."',
																						'".$SUBPROJECTID."',
																						'".$PARTYID[$k]."',
																						'".$BATCHNO_MMS."',
																						'".$MMSELLDATE."',
																						'".$NowSTOCKINHAND."',
																						'".$DEADSTOCK."',
																						'".$CANCELSTOCK."',
																						'".$SELLSTOCK."',
																						'".$TOTALPRICE[$k]."',
																						'".$NowMaxBatchFlag_EP."',
																						'Out',
																						'".$entDate."',
																						'".$entTime."',
																						'".$userId."'
																					)
																				"; 
									$insertMorogQueryStatement = mysql_query($insertMorogQuery);
									
									//Update Party Bill Table Start
									$PartyFlagQuery				= mysql_fetch_array(mysql_query("SELECT MAX(PARTYFLAG) FROM fna_partybill WHERE PARTYID = '".$PARTYID[$k]."' AND PURSELLFLAG = 'Sell'"));
									$MaxPartyFlag				= $PartyFlagQuery['MAX(PARTYFLAG)'];
									$NowMaxPartyFlag			= $PartyFlagQuery['MAX(PARTYFLAG)'] + 1;
									
									$PartyBalanceQuery			= mysql_fetch_array(mysql_query("SELECT BALANCEAMOUNT FROM fna_partybill WHERE PARTYID = '".$PARTYID[$k]."' AND PARTYFLAG = '".$MaxPartyFlag."' AND PURSELLFLAG = 'Sell'"));
									$PartyBalanceAmount			= $PartyBalanceQuery['BALANCEAMOUNT'];
									$NowPartyBalanceAmount		= $PartyBalanceAmount + $TOTALPRICE[$k] ; 
									
									$insertPartyQuery 			= "
																	INSERT INTO 
																				fna_partybill
																								(
																									ENTRYSERIALNOID,
																									PARTYID,
																									PROJECTID,
																									SUBPROJECTID,
																									SELL_BILLAMOUNT,
																									PAYMENTAMOUNT,
																									RECEIVEAMOUNT,
																									BALANCEAMOUNT,
																									ENTRYDATE,
																									PARTYFLAG,
																									STATUS,
																									PURSELLFLAG,
																									ENTDATE,
																									ENTTIME,
																									USERID
																								) 
																							VALUES
																								(
																									'".$MaxEntrySlNo."',
																									'".$PARTYID[$k]."',
																									'".$PROJECTID."',
																									'".$SUBPROJECTID."',
																									'".$TOTALPRICE[$k]."',
																									'0',
																									'0',
																									'".$NowPartyBalanceAmount."',
																									'".$MMSELLDATE."',
																									'".$NowMaxPartyFlag."',
																									'Sell',
																									'Sell',
																									'".$entDate."',
																									'".$entTime."',
																									'".$userId."'
																								)
																							"; 
									$insertPartyQueryStatement = mysql_query($insertPartyQuery);
									//Update Party Bill Table End
									$msg = "<span class='validMsg'>This Information [ $BATCHNO_MMS ] added sucessfully</span>";
									}else{
										$msg = "<span class='errorMsg'>Sorry!...Last EP!</span>";
									}
								// Upadate Egg production Table End
								}else{
									$BatchFlag		  		= mysql_fetch_array(mysql_query("SELECT MAX(BATCHFLAG) FROM pal_morog_murgi_sell WHERE BATCHNO = '".$BATCHNO_MMS."'"));
									$MaxBatchFlag 			= $BatchFlag['MAX(BATCHFLAG)'];
									$NowMaxBatchFlag		= $BatchFlag['MAX(BATCHFLAG)'] + 1;
									
									$TOTQUANTITY_QUERY 		= mysql_fetch_array(mysql_query("SELECT * FROM pal_morog_murgi_sell WHERE BATCHNO = '".$BATCHNO_MMS."' AND BATCHFLAG = '".$MaxBatchFlag."'"));
									$TOTQUANTITY 			= $TOTQUANTITY_QUERY['TOTQUANTITY'];
									$NOW_TOTQUANTITY		= $TOTQUANTITY + $QUANTITY[$k] ; 
									
									$GRANDTOTALPRICE		= $TOTQUANTITY_QUERY['GRANDTOTPRICE'];
									$NOW_GRANDTOTALPRICE	= $GRANDTOTALPRICE + $TOTALPRICE[$k] ;
									 
									$insertMorSellQuery = "
															INSERT INTO 
																		pal_morog_murgi_sell
																			(
																				ENTRYSERIALNOID,
																				BATCHNO,
																				PROJECTID,
																				SUBPROJECTID,
																				PARTYID,
																				MURGIQNTY,
																				MOROGQNTY,
																				TOTQUANTITY,
																				RATE,
																				TOTPRICE,
																				GRANDTOTPRICE,
																				BATCHFLAG,
																				MMSELLDATE,
																				STATUS,
																				ENTDATE,
																				ENTTIME,
																				USERID
																			) 
																	VALUES
																			(
																				'".$MaxEntrySlNo."',
																				'".$BATCHNO_MMS."',
																				'".$PROJECTID."',
																				'".$SUBPROJECTID."',
																				'".$PARTYID[$k]."',
																				'".$QUANTITY[$k]."',
																				'0',
																				'".$NOW_TOTQUANTITY."',
																				'".$RATE[$k]."',
																				'".$TOTALPRICE[$k]."',
																				'".$NOW_GRANDTOTALPRICE."',
																				'".$NowMaxBatchFlag."',
																				'".$MMSELLDATE."',
																				'Active',
																				'".$entDate."',
																				'".$entTime."',
																				'".$userId."'
																			)
													";
							
									$insertMorSellQueryStatement = mysql_query($insertMorSellQuery);
									if($insertMorSellQueryStatement){
										//Update Egg Production Table Start
										$BatchFlag_EP		= mysql_fetch_array(mysql_query("SELECT MAX(BATCHFLAG) FROM pal_murgi WHERE BATCHNO = '".$BATCHNO_MMS."'"));
										$MaxBatchFlag_EP	= $BatchFlag_EP['MAX(BATCHFLAG)'];
										$NowMaxBatchFlag_EP	= $BatchFlag_EP['MAX(BATCHFLAG)'] + 1;
										
										$EggProdQuery		= mysql_fetch_array(mysql_query("SELECT * FROM pal_murgi WHERE BATCHNO = '".$BATCHNO_MMS."' AND BATCHFLAG = '".$MaxBatchFlag_EP."'"));
										$DOID				= $EggProdQuery['DOID'];
										$STOCKINHAND		= $EggProdQuery['STOCKINHAND'];
										$DEADSTOCK			= $EggProdQuery['DEADSTOCK'];
										$CANCELSTOCK		= $EggProdQuery['CANCELSTOCK'];
										$SELLSTOCK			= $EggProdQuery['SELLSTOCK'];
										$BATCHFLAG			= $EggProdQuery['BATCHFLAG'];
										
										$NowSTOCKINHAND		= $STOCKINHAND - $QUANTITY[$k] ; 
										
										$insertMurgiQuery = "
																INSERT INTO 
																			pal_murgi
																					(
																						ENTRYSERIALNOID,
																						DOID,
																						PROJECTID,
																						SUBPROJECTID,
																						PARTYID,
																						BATCHNO,
																						ENTRYDATE,
																						STOCKINHAND,
																						DEADSTOCK,
																						CANCELSTOCK,
																						SELLSTOCK,
																						SELLPRICE,
																						BATCHFLAG,
																						STATUS,
																						ENTDATE,
																						ENTTIME,
																						USERID
																					) 
																			VALUES
																					(
																						'".$MaxEntrySlNo."',
																						'".$DOID."',
																						'".$PROJECTID."',
																						'".$SUBPROJECTID."',
																						'".$PARTYID[$k]."',
																						'".$BATCHNO_MMS."',
																						'".$MMSELLDATE."',
																						'".$NowSTOCKINHAND."',
																						'".$DEADSTOCK."',
																						'".$CANCELSTOCK."',
																						'".$SELLSTOCK."',
																						'".$TOTALPRICE[$k]."',
																						'".$NowMaxBatchFlag_EP."',
																						'Out',
																						'".$entDate."',
																						'".$entTime."',
																						'".$userId."'
																					)
																				"; 
									$insertMurgiQueryStatement = mysql_query($insertMurgiQuery);
									
									//Update Party Bill Table Start
									$PartyFlagQuery				= mysql_fetch_array(mysql_query("SELECT MAX(PARTYFLAG) FROM fna_partybill WHERE PARTYID = '".$PARTYID[$k]."' AND PURSELLFLAG = 'Sell'"));
									$MaxPartyFlag				= $PartyFlagQuery['MAX(PARTYFLAG)'];
									$NowMaxPartyFlag			= $PartyFlagQuery['MAX(PARTYFLAG)'] + 1;
									
									$PartyBalanceQuery			= mysql_fetch_array(mysql_query("SELECT BALANCEAMOUNT FROM fna_partybill WHERE PARTYID = '".$PARTYID[$k]."' AND PARTYFLAG = '".$MaxPartyFlag."' AND PURSELLFLAG = 'Sell'"));
									$PartyBalanceAmount			= $PartyBalanceQuery['BALANCEAMOUNT'];
									$NowPartyBalanceAmount		= $PartyBalanceAmount + $TOTALPRICE[$k] ; 
									
									$insertPartyQuery 			= "
																	INSERT INTO 
																				fna_partybill
																								(
																									ENTRYSERIALNOID,
																									PARTYID,
																									PROJECTID,
																									SUBPROJECTID,
																									SELL_BILLAMOUNT,
																									PAYMENTAMOUNT,
																									RECEIVEAMOUNT,
																									BALANCEAMOUNT,
																									ENTRYDATE,
																									PARTYFLAG,
																									STATUS,
																									PURSELLFLAG,
																									ENTDATE,
																									ENTTIME,
																									USERID
																								) 
																							VALUES
																								(
																									'".$MaxEntrySlNo."',
																									'".$PARTYID[$k]."',
																									'".$PROJECTID."',
																									'".$SUBPROJECTID."',
																									'".$TOTALPRICE[$k]."',
																									'0',
																									'0',
																									'".$NowPartyBalanceAmount."',
																									'".$MMSELLDATE."',
																									'".$NowMaxPartyFlag."',
																									'Sell',
																									'Sell',
																									'".$entDate."',
																									'".$entTime."',
																									'".$userId."'
																								)
																							"; 
									$insertPartyQueryStatement = mysql_query($insertPartyQuery);
									//Update Party Bill Table End
									$msg = "<span class='validMsg'>This Information [ $BATCHNO_MMS ] added sucessfully</span>";
									}else{
										$msg = "<span class='errorMsg'>Sorry!...Last EP!</span>";
									}
								// Upadate Egg production Table End
								
								
								}
								$k++;
						}
				
		}
		return $msg;
	}
		// Insert Morog Murgi Sell Information  End
		
		// Insert Labour Bill Payment Information Start
		function InsertLabBillPaymentInfo($userId){
			
			$PROJECTID 			= $_REQUEST["PROJECTID"];
			$SUBPROJECTID		= $_REQUEST["SUBPROJECTID"];
			$EXPHID 			= $_REQUEST["EXPHID"];
			$LABOURID 			= $_REQUEST["LABOURID"];
			$ENTRYDATE	 		= insertDateMySQlFormat($_REQUEST["ENTRYDATE"]);
			$amount				= $_REQUEST["amount"];
			$DESCRIPTION		= $_REQUEST["DESCRIPTION"];
			
			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
				// Upadate FNA Labour Bill Table Start
				$MAXLABFLAG = mysql_fetch_array(mysql_query("SELECT MAX(LABOURFLAG) FROM fna_labourbill WHERE LABOURID = '".$LABOURID."'"));
				$MAXLABOUR_FLAG = $MAXLABFLAG['MAX(LABOURFLAG)'];
				$NOW_MAXLAB_FLAG = $MAXLABOUR_FLAG + 1;
				$BAL_AMOUNT = mysql_fetch_array(mysql_query("SELECT BALANCEAMOUNT FROM fna_labourbill WHERE LABOURID = '".$LABOURID."' AND LABOURFLAG = '".$MAXLABOUR_FLAG."'"));
				$LAB_BAL_AMOUNT = $BAL_AMOUNT['BALANCEAMOUNT'];
				
				if(($MAXLABOUR_FLAG == 0) or ($MAXLABOUR_FLAG ='')){
					$NOW_LAB_BALAMOUNT = $amount ;
				}else{
					$NOW_LAB_BALAMOUNT = $LAB_BAL_AMOUNT - $amount ;
				}
					
					$EntrySerial_Query_Flag = mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_entryserialno"));
					$MaxFlagEntrySl			= $EntrySerial_Query_Flag['MAX(FLAG)'];
					
					$EntrySerial_Query_No	= mysql_fetch_array(mysql_query("SELECT MAX(ENTRYSERIALNOID) FROM fna_entryserialno"));
					$MaxEntrySlNo			= $EntrySerial_Query_No['MAX(ENTRYSERIALNOID)'] + 1;
			
			
					$insertQueryEntrySl = "
											INSERT INTO 
														fna_entryserialno
																		(
																			ENTRYSERIALNO,
																			PROJECTID,
																			SUBPROJECTID,
																			ENTRYDATE,
																			FLAG,
																			STATUS,
																			ENTDATE,
																			ENTTIME,
																			USERID
																		) 
																VALUES
																		(
																			'".$MaxEntrySlNo."',
																			'".$PROJECTID."',
																			'".$SUBPROJECTID."',
																			'".$ENTRYDATE."',
																			'".$MaxFlagEntrySl."',
																			'Active',
																			'".$entDate."',
																			'".$entTime."',
																			'".$userId."'
																		)
										";
					$insertQueryEntrySlStatement = mysql_query($insertQueryEntrySl);
				
					$insertLabourBillQuery = "
											INSERT INTO 
														fna_labourbill
																(
																	ENTRYSERIALNOID,
																	PROJECTID,
																	SUBPROJECTID,
																	LABOURID,
																	EXPHID,
																	BILLAMOUNT,
																	PAYMENTAMOUNT,
																	BALANCEAMOUNT,
																	LABOURFLAG,
																	ENTRYDATE,
																	STATUS,
																	ENTDATE,
																	ENTTIME,
																	USERID
																) 
														VALUES
																(
																	'".$MaxEntrySlNo."',
																	'".$PROJECTID."',
																	'".$SUBPROJECTID."',
																	'".$LABOURID."',
																	'".$EXPHID."',
																	'0',
																	'".$amount."',
																	'".$NOW_LAB_BALAMOUNT."',
																	'".$NOW_MAXLAB_FLAG."',
																	'".$ENTRYDATE."',
																	'Active',
																	'".$entDate."',
																	'".$entTime."',
																	'".$userId."'
	
																)
						"; 
						
						
						$insertLabourBillQueryStatement = mysql_query($insertLabourBillQuery);
					
					if($insertLabourBillQueryStatement){
						
							$insertQueryExp = "
												INSERT INTO 
															fna_expanse
																			(
																				ENTRYSERIALNOID,
																				PROJECTID,
																				SUBPROJECTID,
																				EXPHID,
																				EXPSUBHID,
																				AMOUNT,
																				EXPDATE,
																				DESCRIPTION,
																				STATUS,
																				ENTDATE,
																				ENTTIME,
																				USERID
																			) 
																	VALUES
																			(
																				'".$MaxEntrySlNo."',
																				'".$PROJECTID."',
																				'".$SUBPROJECTID."',
																				'".$EXPHID."',
																				'0',
																				'".$amount."',
																				'".$ENTRYDATE."',
																				'".$DESCRIPTION."',
																				'Payment',
																				'".$entDate."',
																				'".$entTime."',
																				'".$userId."'
																			)
											";
							$insertQueryExpStatement = mysql_query($insertQueryExp);
							
							//Update FNA Balance Table Start
							$BALANCE_FLAG 			= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_balance"));
							$MAXBALANCE_FLAG 		= $BALANCE_FLAG['MAX(FLAG)'];
							$NOW_MAXBALANCE_FLAG 	= $MAXBALANCE_FLAG + 1;
							
							$BALANCE_QUERY		 	= mysql_fetch_array(mysql_query("SELECT * FROM fna_balance WHERE FLAG = '".$MAXBALANCE_FLAG."'"));
							$INCOME_AMOUNT 			= $BALANCE_QUERY['INCOME'];
							$EXPANSE_AMOUNT			= $BALANCE_QUERY['EXPANSE'];
							$BALANCE_AMOUNT 		= $BALANCE_QUERY['BALANCE'];
							
							$NOW_BALANCE_AMOUNT		= $BALANCE_AMOUNT - $amount ;
							
							$insertBalanceQuery = "
													INSERT INTO 
																fna_balance
																		(
																			ENTRYSERIALNOID,
																			PROJECTID,
																			SUBPROJECTID,
																			EXPANSE,
																			BALANCE,
																			FLAG,
																			BALDATE,
																			STATUS,
																			ENTDATE,
																			ENTTIME,
																			USERID
																		) 
																VALUES
																		(
																			'".$MaxEntrySlNo."',
																			'".$PROJECTID."',
																			'".$SUBPROJECTID."',
																			'".$amount."',
																			'".$NOW_BALANCE_AMOUNT."',
																			'".$NOW_MAXBALANCE_FLAG."',
																			'".$ENTRYDATE."',
																			'Active',
																			'".$entDate."',
																			'".$entTime."',
																			'".$userId."'
																		)
								";
								
								
								$insertBalanceQueryStatement = mysql_query($insertBalanceQuery);
							//Update FNA Balance Table End
						    //----------------------------------------------------Update Daily Income Expanse Table Start------------------------------------------------
								$INEX_FLAG	 			= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_daily_income_expanse"));
								$MAXINEX_FLAG	 		= $INEX_FLAG['MAX(FLAG)'];
								$NOW_MAXINEX_FLAG	 	= $MAXINEX_FLAG + 1;
								
								$LABNAME_QRY 			= mysql_fetch_array(mysql_query("SELECT LABOURNAME FROM fna_labour WHERE LABOURID = '".$LABOURID."'"));
								$LABOURNAME				= $LABNAME_QRY['LABOURNAME'];
								$NOW_DESCRIPTION		= 'Labour Bill Payment to  '.$LABOURNAME . '  (' .$DESCRIPTION. ')';
								

								$insertDailyInExQuery = "
														INSERT INTO 
																		fna_daily_income_expanse
																									(
																										ENTRYSERIALNOID,
																										PROJECTID,
																										SUBPROJECTID,
																										DATE,
																										EXPHID,
																										EXPANSE,
																										DESCRIPTION,
																										FLAG,
																										STATUS,
																										ENTDATE,
																										ENTTIME,
																										USERID
																									) 
																							VALUES
																									(
																										'".$MaxEntrySlNo."',
																										'".$PROJECTID."',
																										'".$SUBPROJECTID."',
																										'".$ENTRYDATE."',
																										'".$EXPHID."',
																										'".$amount."',
																										'".$NOW_DESCRIPTION."',
																										'".$NOW_MAXINEX_FLAG."',
																										'Payment',
																										'".$entDate."',
																										'".$entTime."',
																										'".$userId."'
																									)
															";
										
										
										$insertDailyInExQueryStatement = mysql_query($insertDailyInExQuery);
							
							//----------------------------------------------------Update Daily Income Expanse Table End ------------------------------------------------
							$msg = "<span class='validMsg'>This Information [ $amount ] added sucessfully</span>";
						}else{
							$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
							break;
						}
					
				// Upadate FNA Labour Bill Table End
				return $msg;
			}
		// Insert  Labour Bill Payment Information  End
		
		// Insert Party Payment Receive Information Start
		function InsertPartyPaymentReceiveInfo($userId){
			
			$PROJECTID 			= $_REQUEST["PROJECTID"];
			$SUBPROJECTID		= $_REQUEST["SUBPROJECTID"];
			$BATCHNO			= $_REQUEST["BATCHNO"];
			$PARTYID 			= $_REQUEST["PARTYID"];
			$INHID	 			= addslashes($_REQUEST["INHID"]);
			$FATHERNAME 		= $_REQUEST["FATHERNAME"];
			$ADDRESS 			= $_REQUEST["ADDRESS"];
			$MOBILE 			= $_REQUEST["MOBILE"];
			$BANKNAME 			= $_REQUEST["BANKNAME"];
			$BILLYEAR 			= $_REQUEST["BILLYEAR"];
			$PRODCATTYPEID		= $_REQUEST["PRODCATTYPEID"];
			$CHEQUENUMBER 		= $_REQUEST["CHEQUENUMBER"];
			$CHEQUEDATE 		= insertDateMySQlFormat($_REQUEST["CHEQUEDATE"]);
			$ENTRYDATE	 		= insertDateMySQlFormat($_REQUEST["ENTRYDATE"]);
			$amount				= $_REQUEST["amount"];
			$DESCRIPTION		= $_REQUEST["DESCRIPTION"];
			
			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
				// Upadate FNA Party Bill Table Start	
				
				$MAX_PARTY_FLAG = mysql_fetch_array(mysql_query("SELECT MAX(PARTYFLAG) FROM fna_partybill WHERE PARTYID = '".$PARTYID."'"));
				$MAXPARTY_FLAG = $MAX_PARTY_FLAG['MAX(PARTYFLAG)'];
				$NOW_MAX_PARTY_FLAG = $MAXPARTY_FLAG + 1;
				$BAL_AMOUNT_PARTY = mysql_fetch_array(mysql_query("SELECT BALANCEAMOUNT FROM fna_partybill WHERE PARTYFLAG = '".$MAXPARTY_FLAG."' AND PARTYID = '".$PARTYID."'"));
				$PARTY_BAL_AMOUNT = $BAL_AMOUNT_PARTY['BALANCEAMOUNT'];
				
				if(($MAXPARTY_FLAG == 0) or ($MAXPARTY_FLAG ='')){
					$NOW_PARTY_BALAMOUNT = 0 - $amount ;
				}else{
					if($PARTY_BAL_AMOUNT <0){
						if($PARTY_BAL_AMOUNT > $amount){
							$NOW_PARTY_BALAMOUNT = $PARTY_BAL_AMOUNT - $amount ;
						
						}elseif($PARTY_BAL_AMOUNT <= $amount){
							$NOW_PARTY_BALAMOUNT = $PARTY_BAL_AMOUNT - $amount ;
							
						}
						
						 
					}else{
						$NOW_PARTY_BALAMOUNT = $PARTY_BAL_AMOUNT - $amount ; 
					}
					
				}
					$EntrySerial_Query_Flag = mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_entryserialno"));
					$MaxFlagEntrySl			= $EntrySerial_Query_Flag['MAX(FLAG)'];
					
					$EntrySerial_Query_No	= mysql_fetch_array(mysql_query("SELECT MAX(ENTRYSERIALNOID) FROM fna_entryserialno"));
					$MaxEntrySlNo			= $EntrySerial_Query_No['MAX(ENTRYSERIALNOID)'] + 1;
			
			
					$insertQueryEntrySl = "
											INSERT INTO 
														fna_entryserialno
																		(
																			ENTRYSERIALNO,
																			PROJECTID,
																			SUBPROJECTID,
																			ENTRYDATE,
																			FLAG,
																			STATUS,
																			ENTDATE,
																			ENTTIME,
																			USERID
																		) 
																VALUES
																		(
																			'".$MaxEntrySlNo."',
																			'".$PROJECTID."',
																			'".$SUBPROJECTID."',
																			'".$ENTRYDATE."',
																			'".$MaxFlagEntrySl."',
																			'Active',
																			'".$entDate."',
																			'".$entTime."',
																			'".$userId."'
																		)
										";
					$insertQueryEntrySlStatement = mysql_query($insertQueryEntrySl);
				
				$insertPartyBillQuery = "
										INSERT INTO 
													fna_partybill
															(
																ENTRYSERIALNOID,
																PROJECTID,
																SUBPROJECTID,
																BATCHNO,
																PARTYID,
																PRODCATTYPEID,
																RECEIVENUMBER,
																PAYMENTAMOUNT,
																RECEIVEAMOUNT,
																BALANCEAMOUNT,
																ENTRYDATE,
																BILLYEAR,
																BANKNAME,
																CHEQUENUMBER,
																CHEQUEDATE,
																PARTYFLAG,
																STATUS,
																PURSELLFLAG,
																ENTDATE,
																ENTTIME,
																USERID
															) 
													VALUES
															(
																'".$MaxEntrySlNo."',
																'".$PROJECTID."',
																'".$SUBPROJECTID."',
																'".$BATCHNO."',
																'".$PARTYID."',
																'".$PRODCATTYPEID."',
																'0',
																'0',
																'".$amount."',
																'".$NOW_PARTY_BALAMOUNT."',
																'".$ENTRYDATE."',
																'".$BILLYEAR."',
																'".$BANKNAME."',
																'".$CHEQUENUMBER."',
																'".$CHEQUEDATE."',
																'".$NOW_MAX_PARTY_FLAG."',
																'Receive',
																'Sell',
																'".$entDate."',
																'".$entTime."',
																'".$userId."'
															)
					";
					
					
					$insertPartyBillQueryStatement = mysql_query($insertPartyBillQuery);
					if($insertPartyBillQueryStatement){
						
						//Update FNA Balance Table Start
						$BALANCE_FLAG 			= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_balance"));
						$MAXBALANCE_FLAG 		= $BALANCE_FLAG['MAX(FLAG)'];
						$NOW_MAXBALANCE_FLAG 	= $MAXBALANCE_FLAG + 1;
						
						$BALANCE_QUERY		 	= mysql_fetch_array(mysql_query("SELECT * FROM fna_balance WHERE FLAG = '".$MAXBALANCE_FLAG."'"));
						$INCOME_AMOUNT 			= $BALANCE_QUERY['INCOME'];
						$EXPANSE_AMOUNT			= $BALANCE_QUERY['EXPANSE'];
						$BALANCE_AMOUNT 		= $BALANCE_QUERY['BALANCE'];
						
						$NOW_BALANCE_AMOUNT		= $BALANCE_AMOUNT + $amount ;
						
						$insertBalanceQuery = "
												INSERT INTO 
															fna_balance
																	(
																		ENTRYSERIALNOID,
																		PROJECTID,
																		SUBPROJECTID,
																		INCOME,
																		BALANCE,
																		FLAG,
																		BALDATE,
																		STATUS,
																		ENTDATE,
																		ENTTIME,
																		USERID
																	) 
															VALUES
																	(
																		'".$MaxEntrySlNo."',
																		'".$PROJECTID."',
																		'".$SUBPROJECTID."',
																		'".$amount."',
																		'".$NOW_BALANCE_AMOUNT."',
																		'".$NOW_MAXBALANCE_FLAG."',
																		'".$ENTRYDATE."',
																		'Receive',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
							";
							
							
							$insertBalanceQueryStatement = mysql_query($insertBalanceQuery);
						//Update FNA Balance Table End
						//----------------------------------------------------Update Daily Income Expanse Table Start------------------------------------------------
								$INEX_FLAG	 			= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_daily_income_expanse"));
								$MAXINEX_FLAG	 		= $INEX_FLAG['MAX(FLAG)'];
								$NOW_MAXINEX_FLAG	 	= $MAXINEX_FLAG + 1;
								
								$PARTYNAME_QRY 			= mysql_fetch_array(mysql_query("SELECT PARTYNAME FROM fna_party WHERE PARTYID = '".$PARTYID."'"));
								$PARTYNAME				= $PARTYNAME_QRY['PARTYNAME'];
								$NOW_DESCRIPTION		= 'Payment Receive from '.$PARTYNAME . '  (' .$DESCRIPTION.'-'.$BATCHNO. ')';
								$insertDailyInExQuery = "
														INSERT INTO 
																		fna_daily_income_expanse
																									(
																										ENTRYSERIALNOID,
																										PROJECTID,
																										SUBPROJECTID,
																										DATE,
																										INHID,
																										INCOME,
																										DESCRIPTION,
																										FLAG,
																										STATUS,
																										ENTDATE,
																										ENTTIME,
																										USERID
																									) 
																							VALUES
																									(
																										'".$MaxEntrySlNo."',
																										'".$PROJECTID."',
																										'".$SUBPROJECTID."',
																										'".$ENTRYDATE."',
																										'".$INHID."',
																										'".$amount."',
																										'".$NOW_DESCRIPTION."',
																										'".$NOW_MAXINEX_FLAG."',
																										'Active',
																										'".$entDate."',
																										'".$entTime."',
																										'".$userId."'
																									)
															";
										
										
										$insertDailyInExQueryStatement = mysql_query($insertDailyInExQuery);
							
							//----------------------------------------------------Update Daily Income Expanse Table End ------------------------------------------------
							
							//----------------------------------------------------Update FNA Income Table Start ------------------------------------------------
							
							$FNA_Balance_Query_Flag = mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_balance"));
							$MaxFlag				= $FNA_Balance_Query_Flag['MAX(FLAG)'];
							
							$FNA_Balance_Query  	= mysql_fetch_array(mysql_query("SELECT BALANCE FROM fna_balance WHERE FLAG = '".$MaxFlag."'"));
							$BALANCE				= $FNA_Balance_Query['BALANCE'];
							
							
							$insertQueryExp = "
													INSERT INTO 
																fna_income
																				(
																					ENTRYSERIALNOID,
																					PROJECTID,
																					SUBPROJECTID,
																					INHID,
																					INSUBHID,
																					PARTYID,
																					AMOUNT,
																					INDATE,
																					VOUCHERNO,
																					BATCHNO,
																					DESCRIPTION,
																					STATUS,
																					ENTDATE,
																					ENTTIME,
																					USERID
																				) 
																		VALUES
																				(
																					'".$MaxEntrySlNo."',
																					'".$PROJECTID."',
																					'".$SUBPROJECTID."',
																					'".$INHID."',
																					'0',
																					'".$PARTYID."',
																					'".$amount."',
																					'".$ENTRYDATE."',
																					'',
																					'".$BATCHNO."',
																					'".$DESCRIPTION."',
																					'Receive',
																					'".$entDate."',
																					'".$entTime."',
																					'".$userId."'
																				)
												";
								$insertQueryExpStatement = mysql_query($insertQueryExp);
								
								//----------------------------------------------------Update FNA Income Table End ------------------------------------------------
						
							$msg = "<span class='validMsg'>This Information [ $amount ] added sucessfully</span>";
						}else{
							$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
							
						}
					
				// Upadate FNA Labour Bill Table End
				return $msg;
			}
		// Insert Party Payment Receive Information  End
		
		// Insert Party Payment Start
		function InsertPartyPaymentInfo($userId){
			
			$PROJECTID 			= $_REQUEST["PROJECTID"];
			$SUBPROJECTID		= $_REQUEST["SUBPROJECTID"];
			$BATCHNO			= $_REQUEST["BATCHNO"];
			$EXPHID 			= addslashes($_REQUEST["EXPHID"]);
			$PARTYID 			= $_REQUEST["PARTYID"];
			$FATHERNAME 		= $_REQUEST["FATHERNAME"];
			$ADDRESS 			= $_REQUEST["ADDRESS"];
			$MOBILE 			= $_REQUEST["MOBILE"];
			$ENTRYDATE	 		= insertDateMySQlFormat($_REQUEST["ENTRYDATE"]);
			$amount				= $_REQUEST["amount"];
			$DESCRIPTION		= $_REQUEST["DESCRIPTION"];
			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
				$FNA_Balance_Query_Flag = mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_balance"));
				$MaxFlag				= $FNA_Balance_Query_Flag['MAX(FLAG)'];
				
				$FNA_Balance_Query  	= mysql_fetch_array(mysql_query("SELECT BALANCE FROM fna_balance WHERE FLAG = '".$MaxFlag."'"));
				$BALANCE				= $FNA_Balance_Query['BALANCE'];
				
				if($BALANCE >= $amount){
				
					// Upadate FNA Party Bill Table Start	
					
					$MAX_PARTY_FLAG = mysql_fetch_array(mysql_query("SELECT MAX(PARTYFLAG) FROM fna_partybill WHERE PARTYID = '".$PARTYID."'"));
					$MAXPARTY_FLAG = $MAX_PARTY_FLAG['MAX(PARTYFLAG)'];
					$NOW_MAX_PARTY_FLAG = $MAXPARTY_FLAG + 1;
					$BAL_AMOUNT_PARTY = mysql_fetch_array(mysql_query("SELECT BALANCEAMOUNT FROM fna_partybill WHERE PARTYFLAG = '".$MAXPARTY_FLAG."' AND PARTYID = '".$PARTYID."'"));
					$PARTY_BAL_AMOUNT = $BAL_AMOUNT_PARTY['BALANCEAMOUNT'];
					if(($MAXPARTY_FLAG == 0) or ($MAXPARTY_FLAG ='')){
						$NOW_PARTY_BALAMOUNT = $amount ;
					}else{
						if($PARTY_BAL_AMOUNT <0){
							if($PARTY_BAL_AMOUNT > $amount){
								$NOW_PARTY_BALAMOUNT = abs($PARTY_BAL_AMOUNT) + $amount ;
								$NOW_PARTY_BALAMOUNT = $NOW_PARTY_BALAMOUNT;
							}elseif($PARTY_BAL_AMOUNT <= $amount){
								$NOW_PARTY_BALAMOUNT = $PARTY_BAL_AMOUNT + $amount ;
								
							}
							
							 
						}else{
							$NOW_PARTY_BALAMOUNT = $PARTY_BAL_AMOUNT + $amount ; 
						}
					}
					$EntrySerial_Query_Flag = mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_entryserialno"));
					$MaxFlagEntrySl			= $EntrySerial_Query_Flag['MAX(FLAG)'];
					
					$EntrySerial_Query_No	= mysql_fetch_array(mysql_query("SELECT MAX(ENTRYSERIALNOID) FROM fna_entryserialno"));
					$MaxEntrySlNo			= $EntrySerial_Query_No['MAX(ENTRYSERIALNOID)'] + 1;
			
			
					$insertQueryEntrySl = "
											INSERT INTO 
														fna_entryserialno
																		(
																			ENTRYSERIALNO,
																			PROJECTID,
																			SUBPROJECTID,
																			ENTRYDATE,
																			FLAG,
																			STATUS,
																			ENTDATE,
																			ENTTIME,
																			USERID
																		) 
																VALUES
																		(
																			'".$MaxEntrySlNo."',
																			'".$PROJECTID."',
																			'".$SUBPROJECTID."',
																			'".$ENTRYDATE."',
																			'".$MaxFlagEntrySl."',
																			'Active',
																			'".$entDate."',
																			'".$entTime."',
																			'".$userId."'
																		)
										";
					$insertQueryEntrySlStatement = mysql_query($insertQueryEntrySl);
					
					$insertPartyBillQuery = "
											INSERT INTO 
														fna_partybill
																(
																	ENTRYSERIALNOID,
																	PROJECTID,
																	SUBPROJECTID,
																	BATCHNO,
																	PARTYID,
																	RECEIVENUMBER,
																	PUR_BILLAMOUNT,
																	PAYMENTAMOUNT,
																	RECEIVEAMOUNT,
																	BALANCEAMOUNT,
																	ENTRYDATE,
																	PARTYFLAG,
																	STATUS,
																	PURSELLFLAG,
																	ENTDATE,
																	ENTTIME,
																	USERID
																) 
														VALUES
																(
																	'".$MaxEntrySlNo."',
																	'".$PROJECTID."',
																	'".$SUBPROJECTID."',
																	'".$BATCHNO."',
																	'".$PARTYID."',
																	'0',
																	'0',
																	'".$amount."',
																	'0',
																	'".$NOW_PARTY_BALAMOUNT."',
																	'".$ENTRYDATE."',
																	'".$NOW_MAX_PARTY_FLAG."',
																	'Payment',
																	'Purchase',
																	'".$entDate."',
																	'".$entTime."',
																	'".$userId."'
																)
						";
						
						
						$insertPartyBillQueryStatement = mysql_query($insertPartyBillQuery);
						if($insertPartyBillQueryStatement){
							
							//Update FNA Balance Table Start
							$BALANCE_FLAG 			= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_balance"));
							$MAXBALANCE_FLAG 		= $BALANCE_FLAG['MAX(FLAG)'];
							$NOW_MAXBALANCE_FLAG 	= $MAXBALANCE_FLAG + 1;
							
							$BALANCE_QUERY		 	= mysql_fetch_array(mysql_query("SELECT * FROM fna_balance WHERE FLAG = '".$MAXBALANCE_FLAG."'"));
							$INCOME_AMOUNT 			= $BALANCE_QUERY['INCOME'];
							$EXPANSE_AMOUNT			= $BALANCE_QUERY['EXPANSE'];
							$BALANCE_AMOUNT 		= $BALANCE_QUERY['BALANCE'];
							
							$NOW_BALANCE_AMOUNT		= $BALANCE_AMOUNT - $amount ;
							
							$insertBalanceQuery = "
													INSERT INTO 
																fna_balance
																		(
																			ENTRYSERIALNOID,
																			PROJECTID,
																			SUBPROJECTID,
																			EXPANSE,
																			BALANCE,
																			FLAG,
																			BALDATE,
																			STATUS,
																			ENTDATE,
																			ENTTIME,
																			USERID
																		) 
																VALUES
																		(
																			'".$MaxEntrySlNo."',
																			'".$PROJECTID."',
																			'".$SUBPROJECTID."',
																			'".$amount."',
																			'".$NOW_BALANCE_AMOUNT."',
																			'".$NOW_MAXBALANCE_FLAG."',
																			'".$ENTRYDATE."',
																			'Payment',
																			'".$entDate."',
																			'".$entTime."',
																			'".$userId."'
																		)
								";
								
								
								$insertBalanceQueryStatement = mysql_query($insertBalanceQuery);
							//Update FNA Balance Table End
							
							//----------------------------------------------------Update Daily Income Expanse Table Start------------------------------------------------
								$INEX_FLAG	 			= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_daily_income_expanse"));
								$MAXINEX_FLAG	 		= $INEX_FLAG['MAX(FLAG)'];
								$NOW_MAXINEX_FLAG	 	= $MAXINEX_FLAG + 1;
								
								$PARTYNAME_QRY 			= mysql_fetch_array(mysql_query("SELECT PARTYNAME FROM fna_party WHERE PARTYID = '".$PARTYID."'"));
								$PARTYNAME				= $PARTYNAME_QRY['PARTYNAME'];
								$NOW_DESCRIPTION		= 'Payment To '.$PARTYNAME . '  (' .$DESCRIPTION. ')';
								
								
								$insertDailyInExQuery = "
														INSERT INTO 
																		fna_daily_income_expanse
																									(
																										ENTRYSERIALNOID,
																										PROJECTID,
																										SUBPROJECTID,
																										DATE,
																										EXPHID,
																										EXPANSE,
																										DESCRIPTION,
																										FLAG,
																										STATUS,
																										ENTDATE,
																										ENTTIME,
																										USERID
																									) 
																							VALUES
																									(
																										'".$MaxEntrySlNo."',
																										'".$PROJECTID."',
																										'".$SUBPROJECTID."',
																										'".$ENTRYDATE."',
																										'".$EXPHID."',
																										'".$amount."',
																										'".$NOW_DESCRIPTION."',
																										'".$NOW_MAXINEX_FLAG."',
																										'Active',
																										'".$entDate."',
																										'".$entTime."',
																										'".$userId."'
																									)
															";
										
										
										$insertDailyInExQueryStatement = mysql_query($insertDailyInExQuery);
										
										
							
							//----------------------------------------------------Update Daily Income Expanse Table End ------------------------------------------------
							
							//----------------------------------------------------Update FNA Expanse Table Start ------------------------------------------------
							
							$insertQueryExp = "
												INSERT INTO 
															fna_expanse
																			(
																				ENTRYSERIALNOID,
																				PROJECTID,
																				SUBPROJECTID,
																				EXPHID,
																				EXPSUBHID,
																				PARTYID,
																				AMOUNT,
																				EXPDATE,
																				VOUCHERNO,
																				DESCRIPTION,
																				STATUS,
																				ENTDATE,
																				ENTTIME,
																				USERID
																			) 
																	VALUES
																			(
																				'".$MaxEntrySlNo."',
																				'".$PROJECTID."',
																				'".$SUBPROJECTID."',
																				'".$EXPHID."',
																				'0',
																				'".$PARTYID."',
																				'".$amount."',
																				'".$ENTRYDATE."',
																				'',
																				'".$DESCRIPTION."',
																				'Payment',
																				'".$entDate."',
																				'".$entTime."',
																				'".$userId."'
																			)
											";
							$insertQueryExpStatement = mysql_query($insertQueryExp);
							
							//----------------------------------------------------Update FNA Expanse Table End ------------------------------------------------
							
								$msg = "<span class='validMsg'>This Information [ $amount ] added sucessfully</span>";
							}else{
								$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
							}
					}else{
						$msg = "<span class='errorMsg'>Sorry! Insufficient Balance.......!</span>";
					}
				// Upadate FNA Labour Bill Table End
				return $msg;
			}
		// Insert Party Payment End
		
		// Insert Loan Payment Information Start 
		function InsertLoanPaymentInfo($userId){
			$CALDATE	 				= $_REQUEST["CALDATE"];
			$LOANID 					= $_REQUEST["LOANID"];
			$LOAN_PAYMENT_AMOUNT		= round($_REQUEST["amount2"]);
			$entDate 					= date('Y-m-d');
			$entTime 					= date('H:i:s A');
			
						
			$aQuery 	= "SELECT   LOANID,
									LOANTYPEID,
									PROJECTID,
									SUBPROJECTID,
									PARTYID,
									LOAN_NUMBER,
									LOTNO,
									LOANDATE,
									LOAN_PAYMENTDATE,
									LOANAMOUNT,
									PRINCIPALAMOUNT,
									RESTOFTHE_AMOUNT,
									LOANPAYMENT,
									INTERESTRATE,
									INTERESTAMOUNT,
									LOAN_BALANCE,
									ENTRYDATE,
									LOANFLAG,
									LOANPURPOSE										
								FROM `fna_loan` 
								WHERE `LOANID` = '".$LOANID."'
						";
			$aQueryStatement	= mysql_query($aQuery);
			$sl = 1;
			$glabalToatalBill = 0;
			$PAYMENTAMOUNT ='';
			$partyBalAmount ='';
			$INT_AMOUNT = '';
			$TOT_LOANAMOUNT = '';
			$LOANTYPEID		='';
			$INTERESTRATE	='';
			$LOANPURPOSE	='';
			while($aQueryStatementData	= mysql_fetch_array($aQueryStatement)){

			// Dynamic Row Start
			$LOANID 		= $aQueryStatementData['LOANID'];
			$LOANTYPEID 	= $aQueryStatementData['LOANTYPEID'];
			$PROJECTID 		= $aQueryStatementData['PROJECTID'];
			$SUBPROJECTID 	= $aQueryStatementData['SUBPROJECTID'];
			$PARTYID 		= $aQueryStatementData['PARTYID'];
			$LOAN_NUMBER	= $aQueryStatementData['LOAN_NUMBER'];
			$LOTNO			= $aQueryStatementData['LOTNO'];
			$LOANDATE 		= $aQueryStatementData['LOANDATE'];
			$LOAN_PAYMENTDATE	= $aQueryStatementData['LOAN_PAYMENTDATE'];
			$LOANAMOUNT 		= round($aQueryStatementData['LOANAMOUNT']);
			$PRINCIPALAMOUNT 	= round($aQueryStatementData['PRINCIPALAMOUNT']);
			$RESTOFTHE_AMOUNT 	= round($aQueryStatementData['RESTOFTHE_AMOUNT']);
			
			$INTERESTRATE 	= $aQueryStatementData['INTERESTRATE'];
			$INTERESTAMOUNT = round($aQueryStatementData['INTERESTAMOUNT']);
			$LOANPAYMENT	= round($aQueryStatementData['LOANPAYMENT']);
			$LOAN_BALANCE	= round($aQueryStatementData['LOAN_BALANCE']);
			$ENTRYDATE 		= $aQueryStatementData['ENTRYDATE'];
			$LOANFLAG 		= $aQueryStatementData['LOANFLAG'];
			$LOANPURPOSE 	= $aQueryStatementData['LOANPURPOSE'];
			
			
			$daylen = 60*60*24;

		   $date2 = $ENTRYDATE;
		   $date1 = $CALDATE;
		  			$days = (strtotime($date1)-strtotime($date2))/$daylen;
					$INT_AMOUNT_TEST = round(((($RESTOFTHE_AMOUNT * $INTERESTRATE)/100)/365) * $days) ;
					$TOT_LOANAMOUNT_TEST = $RESTOFTHE_AMOUNT + $INT_AMOUNT_TEST;
		   	
		   
		   if($LOAN_PAYMENT_AMOUNT == $TOT_LOANAMOUNT_TEST){
			  
			   	   $days = (strtotime($date1)-strtotime($date2))/$daylen;
					$INT_AMOUNT = round(((($RESTOFTHE_AMOUNT * $INTERESTRATE)/100)/365) * $days) ; 
					$TOT_LOANAMOUNT = round($RESTOFTHE_AMOUNT + $INT_AMOUNT) ;
				   
				   $NOW_PRINCIPAL_AMOUNT	= round($LOAN_PAYMENT_AMOUNT - $INT_AMOUNT) ;
				   $NOW_RESTOFTHE_AMOUNT	= round($RESTOFTHE_AMOUNT - $NOW_PRINCIPAL_AMOUNT) ;
			   
			  }else{
				 
				   $days = (strtotime($date1)-strtotime($date2))/$daylen;
				   $INT_AMOUNT = round((($LOAN_PAYMENT_AMOUNT * $INTERESTRATE)/100)/365) * $days ; 
				   $TOT_LOANAMOUNT = round($RESTOFTHE_AMOUNT + $INT_AMOUNT) ;
				   
				   $NOW_PRINCIPAL_AMOUNT	= round($LOAN_PAYMENT_AMOUNT - $INT_AMOUNT) ;
				   $NOW_RESTOFTHE_AMOUNT	= round($RESTOFTHE_AMOUNT - $NOW_PRINCIPAL_AMOUNT) ;
				 }
		   
			}
			
			if($TOT_LOANAMOUNT >= $LOAN_PAYMENT_AMOUNT){
					
					$BALANCE_AMOUNT = round($TOT_LOANAMOUNT - $LOAN_PAYMENT_AMOUNT) ;
					
						if($BALANCE_AMOUNT >= 0){
							
							
							$EntrySerial_Query_Flag = mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_entryserialno"));
							$MaxFlagEntrySl			= $EntrySerial_Query_Flag['MAX(FLAG)'];
							
							$EntrySerial_Query_No	= mysql_fetch_array(mysql_query("SELECT MAX(ENTRYSERIALNOID) FROM fna_entryserialno"));
							$MaxEntrySlNo			= $EntrySerial_Query_No['MAX(ENTRYSERIALNOID)'] + 1;
					
					
							$insertQueryEntrySl = "
													INSERT INTO 
																fna_entryserialno
																				(
																					ENTRYSERIALNO,
																					PROJECTID,
																					SUBPROJECTID,
																					ENTRYDATE,
																					FLAG,
																					STATUS,
																					ENTDATE,
																					ENTTIME,
																					USERID
																				) 
																		VALUES
																				(
																					'".$MaxEntrySlNo."',
																					'".$PROJECTID."',
																					'".$SUBPROJECTID."',
																					'".$ENTRYDATE."',
																					'".$MaxFlagEntrySl."',
																					'Active',
																					'".$entDate."',
																					'".$entTime."',
																					'".$userId."'
																				)
												";
							$insertQueryEntrySlStatement = mysql_query($insertQueryEntrySl);
							
							//------------------------------------------ Update Loan Table Start --------------------------------------------	
															
							$MAXPARTYFLAG 		= mysql_fetch_array(mysql_query("SELECT MAX(PARTYFLAG) FROM fna_loan WHERE PARTYID = '".$PARTYID."'"));
							$MAXPARTY_FLAG	 	= $MAXPARTYFLAG['MAX(PARTYFLAG)'];
							$NOW_MAXPARTY_FLAG 	= $MAXPARTY_FLAG + 1;
							
													
							$BALANCE_QRY		= mysql_fetch_array(mysql_query("SELECT LOAN_BALANCE FROM fna_loan WHERE PARTYID = '".$PARTYID."' AND PARTYFLAG = '".$MAXPARTY_FLAG."'"));
							$BALANCE		 	= $BALANCE_QRY['LOAN_BALANCE'];
							$NOW_LOAN_BALANCE	= round($BALANCE - $NOW_PRINCIPAL_AMOUNT);
						
							$insertQueryLoan = "
														INSERT INTO 
																	fna_loan
																			(
																				ENTRYSERIALNOID,
																				PROJECTID,
																				SUBPROJECTID,
																				LOANTYPEID,
																				PARTYID,
																				LOAN_NUMBER,
																				LOTNO,
																				LOANDATE,
																				LOAN_PAYMENTDATE,
																				LOANAMOUNT,
																				PRINCIPALAMOUNT,
																				RESTOFTHE_AMOUNT,
																				LOANPAYMENT,
																				INTERESTRATE,
																				INTERESTAMOUNT,
																				LOAN_BALANCE,
																				ENTRYDATE,
																				LOANPURPOSE,
																				PARTYFLAG,
																				LOANFLAG,
																				STATUS,
																				ENTDATE,
																				ENTTIME,
																				USERID
																			) 
																	VALUES
																			(
																				'".$MaxEntrySlNo."',
																				'".$PROJECTID."',
																				'".$SUBPROJECTID."',
																				'".$LOANTYPEID."',
																				'".$PARTYID."',
																				'".$LOAN_NUMBER."',
																				'".$LOTNO."',
																				'".$LOANDATE."',
																				'".$CALDATE."',
																				'0',
																				'".$NOW_PRINCIPAL_AMOUNT."',
																				'".$NOW_RESTOFTHE_AMOUNT."',
																				'".$LOAN_PAYMENT_AMOUNT."',
																				'".$INTERESTRATE."',
																				'".$INT_AMOUNT."',
																				'".$NOW_LOAN_BALANCE."',
																				'".$ENTRYDATE."',
																				'".$LOANPURPOSE."',
																				'".$NOW_MAXPARTY_FLAG."',
																				'".$LOANFLAG."',
																				'Active',
																				'".$entDate."',
																				'".$entTime."',
																				'".$userId."'
																			)
											";
								$insertQueryLoanStatement = mysql_query($insertQueryLoan);
								
								// Upadate FNA Party Bill Table Start	
								//$NEW_BALANCE	= $TOT_LOANAMOUNT - $PAYMENT_AMOUNT ;
								
								$UpdateQuery	= "UPDATE fna_loan 
																	SET 
																		STATUS 			='Inactive'
																	WHERE LOANID = '".$LOANID."'";
								$UpdateQueryStatement = mysql_query($UpdateQuery);
								
							//------------------------------------------ Update Loan Table End --------------------------------------------
							
							//Update FNA Balance Table Start
							$BALANCE_FLAG 			= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_balance"));
							$MAXBALANCE_FLAG 		= $BALANCE_FLAG['MAX(FLAG)'];
							$NOW_MAXBALANCE_FLAG 	= $MAXBALANCE_FLAG + 1;
							
							$BALANCE_QUERY_BALANCE		 	= mysql_fetch_array(mysql_query("SELECT * FROM fna_balance WHERE FLAG = '".$MAXBALANCE_FLAG."'"));
							$INCOME_AMOUNT_BALANCE 			= $BALANCE_QUERY_BALANCE['INCOME'];
							$EXPANSE_AMOUNT_BALANCE			= $BALANCE_QUERY_BALANCE['EXPANSE'];
							$BALANCE_AMOUNT_BALANCE 		= $BALANCE_QUERY_BALANCE['BALANCE'];
							
							$NOW_BALANCE_AMOUNT_BALANCE		= $BALANCE_AMOUNT_BALANCE + $LOAN_PAYMENT_AMOUNT ;
							
							$insertBalanceQuery = "
													INSERT INTO 
																fna_balance
																		(
																			ENTRYSERIALNOID,
																			PROJECTID,
																			SUBPROJECTID,
																			INCOME,
																			BALANCE,
																			FLAG,
																			BALDATE,
																			STATUS,
																			ENTDATE,
																			ENTTIME,
																			USERID
																		) 
																VALUES
																		(
																			'".$MaxEntrySlNo."',
																			'".$PROJECTID."',
																			'".$SUBPROJECTID."',
																			'".$LOAN_PAYMENT_AMOUNT."',
																			'".$NOW_BALANCE_AMOUNT_BALANCE."',
																			'".$NOW_MAXBALANCE_FLAG."',
																			'".$CALDATE."',
																			'Loan',
																			'".$entDate."',
																			'".$entTime."',
																			'".$userId."'
																		)
								";
								$insertBalanceQueryStatement = mysql_query($insertBalanceQuery);
							//Update FNA Balance Table End
							
							//Update FNA Daily Income Expanse Table  Start
							$INEX_FLAG	 			= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_daily_income_expanse"));
							$MAXINEX_FLAG	 		= $INEX_FLAG['MAX(FLAG)'];
							$NOW_MAXINEX_FLAG	 	= $MAXINEX_FLAG + 1;
							
							$PARTYNAME_QRY 			= mysql_fetch_array(mysql_query("SELECT PARTYNAME FROM fna_party WHERE PARTYID = '".$PARTYID."'"));
							$PARTYNAME				= $PARTYNAME_QRY['PARTYNAME'];
							$NOW_DESCRIPTION		= 'Loan Payment Receive from '.$PARTYNAME . '   Alu Normal Loan ' ;
							
							$insertDailyInExQuery = "
													INSERT INTO 
																	fna_daily_income_expanse
																								(
																									ENTRYSERIALNOID,
																									PROJECTID,
																									SUBPROJECTID,
																									DATE,
																									INHID,
																									INCOME,
																									DESCRIPTION,
																									FLAG,
																									STATUS,
																									ENTDATE,
																									ENTTIME,
																									USERID
																								) 
																						VALUES
																								(
																									'".$MaxEntrySlNo."',
																									'".$PROJECTID."',
																									'".$SUBPROJECTID."',
																									'".$CALDATE."',
																									'21',
																									'".$LOAN_PAYMENT_AMOUNT."',
																									'".$NOW_DESCRIPTION."',
																									'".$NOW_MAXINEX_FLAG."',
																									'Loan Payment Receive',
																									'".$entDate."',
																									'".$entTime."',
																									'".$userId."'
																								)
														";
									
									
									$insertDailyInExQueryStatement = mysql_query($insertDailyInExQuery);
							//Update FNA Daily Income Expanse Table End
							
							if($insertQueryLoanStatement){
								$msg = "<span class='validMsg'>This Information [ $LOAN_PAYMENT_AMOUNT ] added sucessfully</span>";
							}else{
								$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
								
							}
						}else
						{
							$msg = "<span class='validMsg'>Komol.........</span>";
							//update loan table	
						}
						
			}else
			{
				$msg = "<span class='errorMsg'>This Amount is greater than Total Loan Amount.........</span>";
			}
			
	return $msg;
	} 
	// Insert Loan Payment Information  End
	
	// Insert Data Processing Information Start
		function DataProcessing($userId){
			
			$PROJECTID 			= $_REQUEST["PROJECTID"];
			$SUBPROJECTID		= $_REQUEST["SUBPROJECTID"];
			$PRODCATTYPEID		= $_REQUEST["PRODCATTYPEID"];
			$SESSIONYEARID		= $_REQUEST["SESSIONYEARID"];
			
			$STARTDATE	 		= $_REQUEST["STARTDATE"];
			$ENDDATE	 		= $_REQUEST["ENDDATE"];
			
			
			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
			$DateExplode 		= explode('-', $STARTDATE);
			$Year				= $DateExplode[0];
			$NowYear			= $Year + 1;
			$Month				= $DateExplode[1];
			$Day				= $DateExplode[2];
			$YearList			= array($NowYear,$Month,$Day);
			$NowSTARTDATE		= implode('-',$YearList);
			
			$MaxTypeFlag_Query	= mysql_fetch_array(mysql_query("Select * from fna_session WHERE PROJECTID = '".$PROJECTID."' AND SUBPROJECTID = '".$SUBPROJECTID."' AND PRODCATTYPEID = '".$PRODCATTYPEID."' AND SESSIONYEARID = '".$SESSIONYEARID."'"));
			$SESSIONYEAR = $MaxTypeFlag_Query['SESSIONYEAR'];
			
			$ProdCatQry_Query	= mysql_fetch_array(mysql_query("Select * from fna_productcattype WHERE PROJECTID = '".$PROJECTID."' AND SUBPROJECTID = '".$SUBPROJECTID."' AND PRODCATTYPEID = '".$PRODCATTYPEID."'"));
			$CATEGORYTYPENAME = $ProdCatQry_Query['CATEGORYTYPENAME'];
			
				
			$Query		= "
							SELECT 
									*
									FROM 
											fna_session
									WHERE PROJECTID = '".$PROJECTID."'
										AND SUBPROJECTID = '".$SUBPROJECTID."'
										AND PRODCATTYPEID = '".$PRODCATTYPEID."'
										AND SESSIONYEARID = '".$SESSIONYEARID."'
							";
			$QueryStatement	= mysql_query($Query);
			if(mysql_num_rows($QueryStatement)>0) {
			
				$QueryCheck		= "
								SELECT 
										*
										FROM 
												fna_session
										WHERE PROJECTID = '".$PROJECTID."'
											AND SUBPROJECTID = '".$SUBPROJECTID."'
											AND PRODCATTYPEID = '".$PRODCATTYPEID."'
											AND SESSIONYEARID = '".$SESSIONYEARID."'
											AND YEARCOMPLETE = 'No'
								";
				$QueryCheckStatement	= mysql_query($QueryCheck);
				if(mysql_num_rows($QueryCheckStatement)>0) {
							
							
			
						$ProductIdQuery 	= "SELECT PRODUCTID
														FROM fna_product 
														WHERE PROJECTID = '".$PROJECTID."'
														AND SUBPROJECTID = '".$SUBPROJECTID."' 
														AND PRODCATTYPEID = '".$PRODCATTYPEID."'
														ORDER BY PRODUCTID ASC
													";
						$ProductIdQueryStatement					= mysql_query($ProductIdQuery);
						$i = 0;
						while($ProductIdQueryStatementData			= mysql_fetch_array($ProductIdQueryStatement)){	
							$PRODUCTID_ARRAY[] 						= $ProductIdQueryStatementData['PRODUCTID'];
							$i++;
						}
						
						$PRODUCTID_ARRAY_UNIQUE 	= array_unique($PRODUCTID_ARRAY);
						foreach($PRODUCTID_ARRAY_UNIQUE as $individualProductId){
							
							$PartyIdQuery 	= "SELECT 	DISTINCT 
															PARTYID
															FROM fna_productstock 
															WHERE PROJECTID = '".$PROJECTID."'
															AND SUBPROJECTID = '".$SUBPROJECTID."'
															AND PRODCATTYPEID = '".$PRODCATTYPEID."'
															AND PRODUCTID = '".$individualProductId."'
															ORDER BY PARTYID ASC
														";
														
							$PartyIdQueryStatement				= mysql_query($PartyIdQuery);
							while($PartyIdQueryStatementData	= mysql_fetch_array($PartyIdQueryStatement)){	
								$PartyId_Stock					= $PartyIdQueryStatementData['PARTYID'];
								
								
								$MaxProdFlagQry 	= "SELECT 	MAX(stock.PRODTYPEFLAG) ProdTypeFlag
																	FROM fna_productstock stock, fna_productloadunload loadUnl, fna_productloadunloadbkdn bkdn
																WHERE loadUnl.PRODUCTLOADUNLOADID = bkdn.PRODUCTLOADUNLOADID
																AND bkdn.PRODUCTLOADUNLOADBKDNID = stock.PRODUCTLOADUNLOADBKDNID
																AND stock.PROJECTID = '".$PROJECTID."'
																AND stock.SUBPROJECTID = '".$SUBPROJECTID."'
																AND stock.PRODCATTYPEID = '".$PRODCATTYPEID."'
																AND stock.PRODUCTID = '".$individualProductId."'
																AND stock.PARTYID = '".$PartyId_Stock."'
																ORDER BY stock.PRODTYPEFLAG ASC
															";
															
								$MaxProdFlagQryStatement				= mysql_query($MaxProdFlagQry);
								while($MaxProdFlagQryStatementData		= mysql_fetch_array($MaxProdFlagQryStatement)){	
									$MaxProdTypeFlag					= $MaxProdFlagQryStatementData['ProdTypeFlag'];
								}//while Loop Max Product Type Flag from Stock Table
								
								$ProductDetailsQuery 	= "SELECT 	*
																		FROM fna_productstock stock, fna_productloadunloadbkdn bkdn
																		WHERE stock.PRODUCTLOADUNLOADBKDNID = bkdn.PRODUCTLOADUNLOADBKDNID
																		AND stock.PROJECTID = '".$PROJECTID."'
																		AND stock.SUBPROJECTID = '".$SUBPROJECTID."'
																		AND stock.PRODCATTYPEID = '".$PRODCATTYPEID."'
																		AND stock.PRODUCTID = '".$individualProductId."'
																		AND stock.PARTYID = '".$PartyId_Stock."'
																		AND stock.PRODTYPEFLAG = '".$MaxProdTypeFlag."'
																		ORDER BY stock.PARTYID ASC
																	";
															
								$ProductDetailsQueryStatement				= mysql_query($ProductDetailsQuery);
								while($ProductDetailsQueryStatementData		= mysql_fetch_array($ProductDetailsQueryStatement)){	
									$PRODUCTLOADUNLOADBKDNID_STOCK			= $ProductDetailsQueryStatementData['PRODUCTLOADUNLOADBKDNID'];
									$LOTNO_STOCK							= $ProductDetailsQueryStatementData['LOTNO'];
									$QUANTITY_STOCK							= $ProductDetailsQueryStatementData['QUANTITY'];
									$WTQNTY_STOCK							= $ProductDetailsQueryStatementData['WTQNTY'];
									$TOTQUANTITY_STOCK						= $ProductDetailsQueryStatementData['TOTQUANTITY'];
									$LOADBASTA_STOCK						= $ProductDetailsQueryStatementData['LOADBASTA'];
									$UNLOADBASTA_STOCK						= $ProductDetailsQueryStatementData['UNLOADBASTA'];
									$BALBASTA_STOCK							= $ProductDetailsQueryStatementData['BALBASTA'];
									$LOADKG_STOCK							= $ProductDetailsQueryStatementData['LOADKG'];
									$UNLOADKG_STOCK							= $ProductDetailsQueryStatementData['UNLOADKG'];
									$BALKG_STOCK							= $ProductDetailsQueryStatementData['BALKG'];
									$LOADUNIT_STOCK							= $ProductDetailsQueryStatementData['LOADUNIT'];
									$UNLOADUNIT_STOCK						= $ProductDetailsQueryStatementData['UNLOADUNIT'];
									$AVGUNIT_STOCK							= $ProductDetailsQueryStatementData['AVGUNIT'];
									$PARTYFLAG_STOCK						= $ProductDetailsQueryStatementData['PARTYFLAG'];
									$PRODCATTYPEFLAG_STOCK					= $ProductDetailsQueryStatementData['PRODCATTYPEFLAG'];
									$PRODTYPEFLAG_STOCK						= $ProductDetailsQueryStatementData['PRODTYPEFLAG'];
									$WORKTYPEFLAG_STOCK						= $ProductDetailsQueryStatementData['WORKTYPEFLAG'];
									$PACKINGUNITID_STOCK					= $ProductDetailsQueryStatementData['PACKINGUNITID'];
									$CHID_STOCK								= $ProductDetailsQueryStatementData['CHID'];
								
								
								
	// ---------------------------------------------------------------Unload  Operation Start ---------------------------------------------------------------------------
								
										$queryCheckProdName = mysql_fetch_array(mysql_query("SELECT	* FROM fna_product WHERE PRODUCTID = '".$individualProductId."'"));
										$ProdName = $queryCheckProdName['PRODUCTNAME'];
											
																																							
										$MAXDELCHALLNO = mysql_fetch_array(mysql_query("SELECT MAX(IFNULL(DELIVERYCHALLANNUMBER,0)) FROM fna_productloadunload "));
										$maxNo = $MAXDELCHALLNO['MAX(IFNULL(DELIVERYCHALLANNUMBER,0))'];
										if($maxNo == 0 or $maxNo =''){
												$nowMAXDELCHALLNO = $maxNo + 1;
											}else{
												$nowMAXDELCHALLNO = $maxNo + 1;	
											}
										$insertQuery = "
															INSERT INTO 
																		fna_productloadunload
																							(
																								PROJECTID,
																								SUBPROJECTID,
																								PARTYID,
																								LABOURID,
																								ENTRYDATE,
																								DELIVERYCHALLANNUMBER,
																								STATUS,
																								ENTDATE,
																								ENTTIME,
																								USERID
																							) 
																					VALUES
																							(
																								'".$PROJECTID."',
																								'".$SUBPROJECTID."',
																								'".$PartyId_Stock."',
																								'',
																								'".$ENDDATE."',
																								'".$nowMAXDELCHALLNO."',
																								'Active',
																								'".$entDate."',
																								'".$entTime."',
																								'".$userId."'
																							)
															"; 
										if(mysql_query($insertQuery)){
											
											$loadCtId = mysql_insert_id();
											
											
											$k = 0;
											$globalLabourTotalBillAmount = 0;
											$globalPartyTotalBillAmount = 0;
												
												$insertbkdnQuery = "
																		INSERT INTO 
																					fna_productloadunloadbkdn
																									(
																										PRODUCTLOADUNLOADID,
																										PRODCATTYPEID,
																										PRODUCTID,
																										PACKINGUNITID,
																										QUANTITY,
																										CHID,
																										POCKET,
																										STATUS,
																										ENTDATE,
																										ENTTIME,
																										USERID
																									) 
																							VALUES
																									(
																										'".$loadCtId."',
																										'".$PRODCATTYPEID."',
																										'".$individualProductId."',
																										'".$PACKINGUNITID_STOCK."',
																										'".$TOTQUANTITY_STOCK."',
																										'".$CHID_STOCK."',
																										'',
																										'Active',
																										'".$entDate."',
																										'".$entTime."',
																										'".$userId."'
																									)
																	"; 
																	
															
															$insertbkdnQueryStatement = mysql_query($insertbkdnQuery);
															
	//-----------------------------------------------------------Update Product Stock table Start-------------------------------------------------------------------------------
																
																$loadUnloadBkdnIdCtId = mysql_insert_id();
																
																$partyFlag = mysql_fetch_array(mysql_query("SELECT MAX(IFNULL(PARTYFLAG,0)) FROM fna_productstock WHERE PARTYID = '".$PartyId_Stock."'"));
																$MAXpartyFlag = $partyFlag['MAX(IFNULL(PARTYFLAG,0))'];
																$NowMAXpartyFlag = $MAXpartyFlag + 1;
																
																$prodCatTypeFlag = mysql_fetch_array(mysql_query("SELECT MAX(IFNULL(PRODCATTYPEFLAG,0)) FROM fna_productstock WHERE PARTYID = '".$PartyId_Stock."' AND PRODCATTYPEID = '".$PRODCATTYPEID."'"));
																$MAXprodCatTypeFlag = $prodCatTypeFlag['MAX(IFNULL(PRODCATTYPEFLAG,0))'];
																$NowMaxprodCatTypeFlag = $MAXprodCatTypeFlag + 1;
																
																$prodTypeFlag = mysql_fetch_array(mysql_query("SELECT MAX(PRODTYPEFLAG) FROM fna_productstock WHERE PARTYID = '".$PartyId_Stock."' AND PRODUCTID = '".$individualProductId."'"));
																
																$MAXprodTypeFlag = $prodTypeFlag['MAX(PRODTYPEFLAG)'];
																
																if ($MAXprodTypeFlag == ''){
																		//$MAXprodTypeFlag = 0;
																		$NowTotQnty 	= $TOTQUANTITY_STOCK;
																		$NowTotBalBasta = $BALBASTA_STOCK;
																	}else
																	{
																		$prodQnty = mysql_fetch_array(mysql_query("SELECT TOTQUANTITY, BALBASTA, AVGUNIT, BALKG FROM fna_productstock WHERE PARTYID = '".$PartyId_Stock."' AND PRODUCTID = '".$individualProductId."' AND PRODTYPEFLAG = '".$MAXprodTypeFlag."'"));
																		$TotQnty = $prodQnty['TOTQUANTITY'];
																		$TotBalBasta = $prodQnty['BALBASTA'] ;
																		$AVGUNIT	 = $prodQnty['AVGUNIT'] ;
																		$BALKG		 = $prodQnty['BALKG'] ;
																		if ($TotQnty >= $BALBASTA_STOCK){
																				$NowTotQnty = $prodQnty['TOTQUANTITY'] - $TOTQUANTITY_STOCK;
																				$NowTotBalBasta = $prodQnty['BALBASTA'] - $BALBASTA_STOCK;
																				
																			}else
																			{
																				$msg = "<span class='errorMsg'>Sorry! Product Quantity is not Sufficient!</span>";
																				
																			}
																		//$NowTotQnty = $prodQnty['TOTQUANTITY'] + $quantity[$k];
																	}
																		
																		$NowMaxprodTypeFlag = $MAXprodTypeFlag + 1;
																		
																		$NowUnloadKG		= $TOTQUANTITY_STOCK * $AVGUNIT ;
																		$NowTotBalKG		= $BALKG - $NowUnloadKG ;
																		$UNLOADUNIT			= $AVGUNIT ;
																		
																		
																		$insertStockQuery = "
																							INSERT INTO 		
																										fna_productstock
																													(
																														PROJECTID,
																														SUBPROJECTID,
																														PRODUCTLOADUNLOADBKDNID,
																														PARTYID,
																														PRODCATTYPEID,
																														PRODUCTID,
																														QUANTITY,
																														TOTQUANTITY,
																														UNLOADBASTA,
																														BALBASTA,
																														UNLOADKG,
																														BALKG,
																														UNLOADUNIT,
																														AVGUNIT,
																														PARTYFLAG,
																														PRODCATTYPEFLAG,
																														PRODTYPEFLAG,
																														WORKTYPEFLAG,
																														STATUS,
																														ENTDATE,
																														ENTTIME,
																														USERID
																													) 
																											VALUES
																													(
																														'".$PROJECTID."',
																														'".$SUBPROJECTID."',
																														'".$loadUnloadBkdnIdCtId."',
																														'".$PartyId_Stock."',
																														'".$PRODCATTYPEID."',
																														'".$individualProductId."',
																														'".$TOTQUANTITY_STOCK."',
																														'".$NowTotQnty."',
																														'".$TOTQUANTITY_STOCK."',
																														'".$NowTotBalBasta."',
																														'".$NowUnloadKG."',
																														'".$NowTotBalKG."',
																														'".$UNLOADUNIT."',
																														'".$AVGUNIT."',
																														'".$NowMAXpartyFlag."',
																														'".$NowMaxprodCatTypeFlag."',
																														'".$NowMaxprodTypeFlag."',
																														'Unload',
																														'Active',
																														'".$ENDDATE."',
																														'".$entTime."',
																														'".$userId."'
																													)
																	"; 
																	
																	
																	$insertStockQueryStatement = mysql_query($insertStockQuery);
															
															
	//------------------------------------------------------------------Update Product Stock table End--------------------------------------------------------------
																							
											
										} else {
											$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
										}//if(mysql_query($insertQuery))
									
								
	// --------------------------------------------------------------------------------Unload  Operation End --------------------------------------------------------
	
	//--------------------------------------------------------------------------------Load Operation Start ----------------------------------------------------------
	
	
				
										$MAXRECNO = mysql_fetch_array(mysql_query("SELECT MAX(IFNULL(RECEIVENUMBER,0)) FROM fna_productloadunload "));
										$maxNo = $MAXRECNO['MAX(IFNULL(RECEIVENUMBER,0))'];
										if($maxNo == 0){
												$nowMAXRECNO = $maxNo + 1;
											}else{
												$nowMAXRECNO = $maxNo + 1;	
											}
											$insertQuery_Load = "
															INSERT INTO 
																		fna_productloadunload
																							(
																								PROJECTID,
																								SUBPROJECTID,
																								PARTYID,
																								LABOURID,
																								ENTRYDATE,
																								RECEIVENUMBER,
																								STATUS,
																								ENTDATE,
																								ENTTIME,
																								USERID
																							) 
																					VALUES
																							(
																								'".$PROJECTID."',
																								'".$SUBPROJECTID."',
																								'".$PartyId_Stock."',
																								'',
																								'".$NowSTARTDATE."',
																								'".$nowMAXRECNO."',
																								'Active',
																								'".$entDate."',
																								'".$entTime."',
																								'".$userId."'
																							)
															"; 
											if(mysql_query($insertQuery_Load)){
												
												$loadCtId = mysql_insert_id();
												
												
												//$k = 0;
												$globalLabourTotalBillAmount = 0;
												$globalPartyTotalBillAmount = 0;
												
												//for($i = 1; $i < $TOTAL_PRODUCT_LIST; $i++ ){
													
												$Load_Quantity	= $TOTQUANTITY_STOCK ; 
												$Load_WtQuantity = $TOTQUANTITY_STOCK * $AVGUNIT ;
												$Load_TotQuantity = $TOTQUANTITY_STOCK ;
												$Load_Basta   = $BALBASTA_STOCK ; 
												$Load_BalBasta = $BALBASTA_STOCK ;
												$Load_Kg = $BALBASTA_STOCK * $AVGUNIT ; 
												$Load_BalKg = $Load_Kg ;
												$Load_Unit = $AVGUNIT_STOCK ; 
												$Load_AvgUnit = $AVGUNIT_STOCK ;
												
												$insertbkdnQuery_Load = "
																INSERT INTO 
																			fna_productloadunloadbkdn
																							(
																								PRODUCTLOADUNLOADID,
																								PRODCATTYPEID,
																								PRODUCTID,
																								PACKINGUNITID,
																								CHALLANNO,
																								QUANTITY,
																								WTQNTY,
																								CHID,
																								POCKET,
																								STATUS,
																								ENTDATE,
																								ENTTIME,
																								USERID
																							) 
																					VALUES
																							(
																								'".$loadCtId."',
																								'".$PRODCATTYPEID."',
																								'".$individualProductId."',
																								'".$PACKINGUNITID_STOCK."',
																								'',
																								'".$Load_Quantity."',
																								'".$Load_WtQuantity."',
																								'".$CHID_STOCK."',
																								'',
																								'Active',
																								'".$entDate."',
																								'".$entTime."',
																								'".$userId."'
																							)
															"; 
															
															
															$insertbkdnQuery_LoadStatement = mysql_query($insertbkdnQuery_Load);
															if($insertbkdnQuery_LoadStatement){
																$msg = "<span class='validMsg'>Labour Information [$loadCtId] added sucessfully</span>";
															}else{
																$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
																break;
																}
																
																//Update Product Stock table Start
																$loadUnloadBkdnIdCtId = mysql_insert_id();
																
																$partyFlag_Load = mysql_fetch_array(mysql_query("SELECT MAX(IFNULL(PARTYFLAG,0)) FROM fna_productstock WHERE PARTYID = '".$PartyId_Stock."'"));
																$MAXpartyFlag_Load = $partyFlag_Load['MAX(IFNULL(PARTYFLAG,0))'];
																$NowMAXpartyFlag_Load = $MAXpartyFlag_Load + 1;
																
																$prodCatTypeFlag_Load = mysql_fetch_array(mysql_query("SELECT MAX(IFNULL(PRODCATTYPEFLAG,0)) FROM fna_productstock WHERE PARTYID = '".$PartyId_Stock."' AND PRODCATTYPEID = '".$PRODCATTYPEID."'"));
																$MAXprodCatTypeFlag_Load = $prodCatTypeFlag_Load['MAX(IFNULL(PRODCATTYPEFLAG,0))'];
																$NowMaxprodCatTypeFlag_Load = $MAXprodCatTypeFlag_Load + 1;
																
																$prodTypeFlag_Load = mysql_fetch_array(mysql_query("SELECT MAX(PRODTYPEFLAG) FROM fna_productstock WHERE PARTYID = '".$PartyId_Stock."' AND PRODUCTID = '".$individualProductId."'"));
																
																$MAXprodTypeFlag_Load = $prodTypeFlag_Load['MAX(PRODTYPEFLAG)'];
																
																//$MAXprodTypeFlag = 0;
																//$TotQnty_Load 		= $prodQnty['TOTQUANTITY'];
																$NowTotQnty_Load 	= $Load_Quantity;
																$NowBalBasta_Load 	= $Load_BalBasta;
																$NowBalKG_Load	 	= $Load_BalKg;
																		
																$LoadUnit_Load			= ($Load_Kg / $Load_Basta ) ; 
																$NowAVGUNIT_Load	 	= ($Load_BalKg / $Load_BalBasta ) ;	
																			
																$NowMaxprodTypeFlag_Load = $MAXprodTypeFlag_Load + 1;
																
																
																$insertStockQuery_Load = "
																					INSERT INTO 
																								fna_productstock
																											(
																												PROJECTID,
																												SUBPROJECTID,
																												PRODUCTLOADUNLOADBKDNID,
																												PARTYID,
																												PRODCATTYPEID,
																												PRODUCTID,
																												QUANTITY,
																												WTQNTY,
																												TOTQUANTITY,
																												LOADBASTA,
																												BALBASTA,
																												LOADKG,
																												BALKG,
																												LOADUNIT,
																												AVGUNIT,
																												PARTYFLAG,
																												PRODCATTYPEFLAG,
																												PRODTYPEFLAG,
																												WORKTYPEFLAG,
																												STATUS,
																												ENTDATE,
																												ENTTIME,
																												USERID
																											) 
																									VALUES
																											(
																												'".$PROJECTID."',
																												'".$SUBPROJECTID."',
																												'".$loadUnloadBkdnIdCtId."',
																												'".$PartyId_Stock."',
																												'".$PRODCATTYPEID."',
																												'".$individualProductId."',
																												'".$Load_Quantity."',
																												'".$Load_WtQuantity."',
																												'".$Load_TotQuantity."',
																												'".$Load_Basta."',
																												'".$Load_BalBasta."',
																												'".$Load_Kg."',
																												'".$Load_BalKg."',
																												'".$LoadUnit_Load."',
																												'".$NowAVGUNIT_Load."',
																												'".$NowMAXpartyFlag_Load."',
																												'".$NowMaxprodCatTypeFlag_Load."',
																												'".$NowMaxprodTypeFlag_Load."',
																												'Load',
																												'Active',
																												'".$NowSTARTDATE."',
																												'".$entTime."',
																												'".$userId."'
																											)
															"; 
															
															
															$insertStockQuery_LoadStatement = mysql_query($insertStockQuery_Load);
																//Update Product Stock table End
															/*	
																//Update Labour Work History Table Start
																$LABOURIDQUERY  =mysql_fetch_array(mysql_query("SELECT LABCONTACTID FROM fna_labourcontact WHERE LABOURID = '".$LABOURID."'"));
																$LABCONTACTID = $LABOURIDQUERY['LABCONTACTID'];
																$QUERYLOADPRICE = mysql_fetch_array(mysql_query("SELECT LOADPRICE FROM fna_labourcontact_bkdn WHERE LABCONTACTID = '".$LABCONTACTID."' AND CHAMBERIDTO = '".$CHID[$k]."' and CHAMBERIDFROM = '' and PACKINGUNITID = '".$packingUnit[$k]."'"));
																$LOADPRICE = $QUERYLOADPRICE['LOADPRICE'];
																$TOTBILLAMOUNT = ($quantity[$k] * $LOADPRICE) + $EXTRALABBILL[$k] ;
																$globalLabourTotalBillAmount = $globalLabourTotalBillAmount + $TOTBILLAMOUNT ;
																
																
																$insertLabWorkHistQuery = "
																					INSERT INTO 
																								fna_labourworkhistory
																											(
																												PROJECTID,
																												SUBPROJECTID,
																												LABOURID,
																												PARTYID,
																												PRODUCTLOADUNLOADBKDNID,
																												PRODCATTYPEID,
																												PRODUCTID,
																												PACKINGUNITID,
																												QUANTITY,
																												CHID,
																												POCKET,
																												BILLAMOUNT,
																												EXTRALABBILL,
																												TOTBILLAMOUNT,
																												RECEIVENUMBER,
																												WORKTYPEFLAG,
																												STATUS,
																												ENTDATE,
																												ENTTIME,
																												USERID
																											) 
																									VALUES
																											(
																												'".$PROJECTID."',
																												'".$SUBPROJECTID."',
																												'".$LABOURID."',
																												'".$PARTYID."',
																												'".$loadUnloadBkdnIdCtId."',
																												'".$PRODCATTYPEID."',
																												'".$PRODUCTID[$k]."',
																												'".$packingUnit[$k]."',
																												'".$quantity[$k]."',
																												'".$CHID[$k]."',
																												'',
																												'".$LOADPRICE."',
																												'".$EXTRALABBILL[$k]."',
																												'".$TOTBILLAMOUNT."',
																												'".$nowMAXRECNO."',
																												'Load',
																												'Active',
																												'".$ENTRYDATE."',
																												'".$entTime."',
																												'".$userId."'
																											)
															"; 
															
															
															$insertLabWorkHistQueryStatement = mysql_query($insertLabWorkHistQuery);
															
															//Update Labour Work History Table End
															*/
															// Update FNA Bill Table Start
															$MAX_PARTY_FLAG_BILL = mysql_fetch_array(mysql_query("SELECT MAX(IFNULL(PARTYFLAG,0)) FROM fna_bill WHERE PARTYID = '".$PartyId_Stock."'"));
															$MAXPARTY_FLAG_BILL 		= $MAX_PARTY_FLAG_BILL['MAX(IFNULL(PARTYFLAG,0))'];
															$NOW_MAX_PARTY_FLAG_BILL 	= $MAXPARTY_FLAG_BILL + 1 ;
															$TOT_AMOUNT_PARTY_BILL 		= mysql_fetch_array(mysql_query("SELECT TOTBILLAMOUNT FROM fna_bill WHERE PARTYID = '".$PartyId_Stock."' and PARTYFLAG = '".$MAXPARTY_FLAG_BILL."'"));
															$PARTY_TOT_AMOUNT_BILL = $TOT_AMOUNT_PARTY_BILL['TOTBILLAMOUNT'];
															
															$SESSIONID  =mysql_fetch_array(mysql_query("SELECT SESSIONID FROM fna_session WHERE PROJECTID = '".$PROJECTID."' AND   SUBPROJECTID = '".$SUBPROJECTID."' AND  PRODCATTYPEID = '".$PRODCATTYPEID."' AND YEARCOMPLETE = 'No'"));
															$NOWSESSIONID = $SESSIONID['SESSIONID'];
															$QUERYPACKINGUNITID = mysql_fetch_array(mysql_query("SELECT QID, WTID FROM fna_packingunit WHERE PACKINGUNITID = '".$PACKINGUNITID_STOCK."'"));
															$NOW_QID 			= $QUERYPACKINGUNITID['QID'];
															$NOW_WTID 			= $QUERYPACKINGUNITID['WTID'];
															
															$qvalue = mysql_fetch_array(mysql_query("SELECT QVALUE FROM fna_quantity WHERE QID = '".$NOW_QID."'"));
															$now_qvalue = $qvalue['QVALUE'];
															$TOTQUANTITY_PROD 	= $Load_Quantity * $now_qvalue ;
															$QUERYPRODFARE		= mysql_fetch_array(mysql_query("SELECT UNITFARE FROM fna_productfare WHERE PRODCATTYPEID = '".$PRODCATTYPEID."' AND PRODUCTID = '".$individualProductId."'"));
															$NOW_UNITFARE		= $QUERYPRODFARE['UNITFARE'];
															$NOW_BILLAMOUNT		= $Load_WtQuantity * $NOW_UNITFARE ; 
															$TOTBILLAMOUNT_PROD	= $NOW_BILLAMOUNT + $PARTY_TOT_AMOUNT_BILL ;
															
															$globalPartyTotalBillAmount = $globalPartyTotalBillAmount + $NOW_BILLAMOUNT ; 
															
															
															$insertFNABillQuery = "
																				INSERT INTO 
																							fna_bill
																										(
																											PROJECTID,
																											SUBPROJECTID,
																											SESSIONID,
																											PARTYID,
																											RECEIVENUMBER,
																											PRODCATTYPEID,
																											PRODUCTID,
																											PACKINGUNITID,
																											QUANTITY,
																											WTQNTY,
																											TOTQUANTITY,
																											BILLAMOUNT,
																											TOTBILLAMOUNT,
																											PARTYFLAG,
																											ENTRYDATE,
																											STATUS,
																											ENTDATE,
																											ENTTIME,
																											USERID
																										) 
																								VALUES
																										(
																											'".$PROJECTID."',
																											'".$SUBPROJECTID."',
																											'".$NOWSESSIONID."',
																											'".$PartyId_Stock."',
																											'".$nowMAXRECNO."',
																											'".$PRODCATTYPEID."',
																											'".$individualProductId."',
																											'".$PACKINGUNITID_STOCK."',
																											'".$Load_Quantity."',
																											'".$Load_WtQuantity."',
																											'".$Load_TotQuantity."',
																											'".$NOW_BILLAMOUNT."',
																											'".$TOTBILLAMOUNT_PROD."',
																											'".$NOW_MAX_PARTY_FLAG_BILL."',
																											'".$NowSTARTDATE."',
																											'Active',
																											'".$entDate."',
																											'".$entTime."',
																											'".$userId."'
																										)
														";
														
														
														$insertFNABillQueryStatement = mysql_query($insertFNABillQuery);
															// Update FNA Bill Table End
																
																
												//$k++;
											//}
										/*	
										// Upadate FNA Labour Bill Table Start
										$MAXLABFLAG = mysql_fetch_array(mysql_query("SELECT MAX(LABOURFLAG) FROM fna_labourbill WHERE LABOURID = '".$LABOURID."'"));
										$MAXLABOUR_FLAG = $MAXLABFLAG['MAX(LABOURFLAG)'];
										$NOW_MAXLAB_FLAG = $MAXLABOUR_FLAG + 1;
										$BAL_AMOUNT = mysql_fetch_array(mysql_query("SELECT BALANCEAMOUNT FROM fna_labourbill WHERE LABOURID = '".$LABOURID."' AND LABOURFLAG = '".$MAXLABOUR_FLAG."'"));
										$LAB_BAL_AMOUNT = $BAL_AMOUNT['BALANCEAMOUNT'];
										if(($MAXLABOUR_FLAG == 0) or ($MAXLABOUR_FLAG ='')){
											$NOW_LAB_BALAMOUNT = $globalLabourTotalBillAmount ;
										}else{
											$NOW_LAB_BALAMOUNT = $LAB_BAL_AMOUNT + $globalLabourTotalBillAmount ;
										}
										$insertLabourBillQuery = "
																INSERT INTO 
																			fna_labourbill
																					(
																						PROJECTID,
																						SUBPROJECTID,
																						LABOURID,
																						PARTYID,
																						PRODUCTLOADUNLOADID,
																						BILLAMOUNT,
																						PAYMENTAMOUNT,
																						BALANCEAMOUNT,
																						LABOURFLAG,
																						ENTRYDATE,
																						STATUS,
																						ENTDATE,
																						ENTTIME,
																						USERID
																					) 
																			VALUES
																					(
																						'".$PROJECTID."',
																						'".$SUBPROJECTID."',
																						'".$LABOURID."',
																						'".$PARTYID."',
																						'".$loadCtId."',
																						'".$globalLabourTotalBillAmount."',
																						'0',
																						'".$NOW_LAB_BALAMOUNT."',
																						'".$NOW_MAXLAB_FLAG."',
																						'".$ENTRYDATE."',
																						'Active',
																						'".$entDate."',
																						'".$entTime."',
																						'".$userId."'
																					)
											"; 
											
											
											$insertLabourBillQueryStatement = mysql_query($insertLabourBillQuery);
											
										// Upadate FNA Labour Bill Table End
										*/
										// Upadate FNA Party Bill Table Start	
										
										$MAX_PARTY_FLAG = mysql_fetch_array(mysql_query("SELECT MAX(PARTYFLAG) FROM fna_partybill WHERE PARTYID = '".$PartyId_Stock."' AND PURSELLFLAG = 'Load'"));
										$MAXPARTY_FLAG = $MAX_PARTY_FLAG['MAX(PARTYFLAG)'];
										$NOW_MAX_PARTY_FLAG = $MAXPARTY_FLAG + 1;
										$BAL_AMOUNT_PARTY = mysql_fetch_array(mysql_query("SELECT BALANCEAMOUNT FROM fna_partybill WHERE PARTYID = '".$PartyId_Stock."' AND PARTYFLAG = '".$MAXPARTY_FLAG."' AND PURSELLFLAG = 'Load'"));
										$PARTY_BAL_AMOUNT = $BAL_AMOUNT_PARTY['BALANCEAMOUNT'];
										
										if(($MAXPARTY_FLAG == 0) or ($MAXPARTY_FLAG ='')){
											$NOW_PARTY_BALAMOUNT = $globalPartyTotalBillAmount ;
										}else{
											$NOW_PARTY_BALAMOUNT = $PARTY_BAL_AMOUNT + $globalPartyTotalBillAmount ; 
										}
										$insertPartyBillQuery = "
																INSERT INTO 
																			fna_partybill
																					(
																						PROJECTID,
																						SUBPROJECTID,
																						PARTYID,
																						RECEIVENUMBER,
																						SELL_BILLAMOUNT,
																						PAYMENTAMOUNT,
																						RECEIVEAMOUNT,
																						BALANCEAMOUNT,
																						ENTRYDATE,
																						PARTYFLAG,
																						STATUS,
																						PURSELLFLAG,
																						ENTDATE,
																						ENTTIME,
																						USERID
																					) 
																			VALUES
																					(
																						'".$PROJECTID."',
																						'".$SUBPROJECTID."',
																						'".$PartyId_Stock."',
																						'".$nowMAXRECNO."',
																						'".$globalPartyTotalBillAmount."',
																						'0',
																						'0',
																						'".$NOW_PARTY_BALAMOUNT."',
																						'".$NowSTARTDATE."',
																						'".$NOW_MAX_PARTY_FLAG."',
																						'Active',
																						'Load',
																						'".$entDate."',
																						'".$entTime."',
																						'".$userId."'
																					)
											"; 
											
											
											$insertPartyBillQueryStatement = mysql_query($insertPartyBillQuery);
										// Upadate FNA Party Bill Table End
											
											
										} else {
											$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
										}
			
	
	//-------------------------------------------------------------------------------Load Operation End -------------------------------------------------------------
								}//while Loop Details Data from Stock Table
									
							}//while Loop  PartyId from Stock Table
						
						}//foreach Loop
	//---------------------------------------------------------------------Update Session Table Start ----------------------------------------------------------------
						$UpdateQry = "UPDATE fna_session 
										SET YEARCOMPLETE = 'Yes' 
										WHERE PROJECTID = '".$PROJECTID."'
										AND SUBPROJECTID = '".$SUBPROJECTID."'
										AND SESSIONYEARID = '".$SESSIONYEARID."'
										AND PRODCATTYPEID = '".$PRODCATTYPEID."'
										
									";
							$UpdateQryStatement = mysql_query($UpdateQry);
							if ($UpdateQryStatement){
								
								$msg = "<span class='errorMsg'> Record updated successfully for ( $CATEGORYTYPENAME ) Item in ( $SESSIONYEAR ) ...!</span>";
								
							} else {
								$msg = "<span class='errorMsg'> Error updating record...!</span>";
								
							}
	
	//---------------------------------------------------------------------Update Session Table End ------------------------------------------------------------------
						
						//$msg = "<span class='errorMsg'>Data Processing Successfully  Completed...!</span>";
					}else{
					$msg = "<span class='errorMsg'>Sorry, This Product Category Year End ( $SESSIONYEAR ) is Completed...!</span>";
					}
				}else{
				$msg = "<span class='errorMsg'>Sorry, Please  Enter for This Product Category Session First...!</span>";
			}
			
		return $msg;
	}
		// Insert Data Processing Information  End
	
}
?>