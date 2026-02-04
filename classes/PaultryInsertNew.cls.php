<?php
	class PaultryInsertNew Extends BaseClass {
		function PaultryInsertNew() {
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
									WHERE LOWER(LABOURNAME) = '".strtolower($name)."' AND LOWER(FATHERNAME) = '".strtolower($fName)."'
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
		
		// Insert Egg Sell Category start
		function insertEggSellInfo($userId){
			$SCNAME				= addslashes($_REQUEST["SCNAME"]);
			$DESCRIPTION		= addslashes($_REQUEST["DESCRIPTION"]);
			
			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
			$Query		= "
									SELECT 
											SCNAME 
									FROM 
											pal_sellcategory
									WHERE SCNAME = '".$SCNAME."'
								  ";
			$QueryStatement	= mysql_query($Query);
			if(mysql_num_rows($QueryStatement)>0) {
				$msg = "<span class='errorMsg'>Sorry, This Egg Category Name. [ $SCNAME ] already exist!</span>";
			} else {
				
				
				$insertQuery = "
										INSERT INTO 
													pal_sellcategory
																	(
																		SCNAME,
																		DESCRIPTION,
																		STATUS,
																		ENTDATE,
																		ENTTIME,
																		USERID
																	) 
															VALUES
																	(
																		'".$SCNAME."',
																		'".$DESCRIPTION."',
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									"; 
				$insertQueryStatement = mysql_query($insertQuery);
				if($insertQueryStatement){
					$msg = "<span class='validMsg'>This Category Name [ $SCNAME ] added sucessfully</span>";
				} else {
					$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
				}
			}
			return $msg;
			
			
			
			
		}
		// Insert Egg Sell Category End
		
		// Insert Opening Batch start
		function insertOpeningBatchInfo($userId){
			$BATCHNO			= addslashes($_REQUEST["BATCHNO"]);
			$PRICE_LIVESTOCK	= addslashes($_REQUEST["PRICE"]);
			$BWISELIVESTOCK		= addslashes($_REQUEST["BWISELIVESTOCK"]);
			$StockInHand		= addslashes($_REQUEST["Stock"]);
			$AvgRate			= addslashes($_REQUEST["AvgRate"]);
			$BDATE				= insertDateMySQlFormat($_REQUEST["BDATE"]);
						
			$PARTYID_PAL		= addslashes($_REQUEST["PARTYID_OPEN"]);
			$SOURCEID			= addslashes($_REQUEST["SOURCEID"]);
			
			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
			$EntrySerial_Query_Flag_BO			= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_entryserialno"));
			$MaxFlagEntrySl_BO					= $EntrySerial_Query_Flag_BO['MAX(FLAG)'];
			
			$EntrySerial_Query_No_BO			= mysql_fetch_array(mysql_query("SELECT MAX(ENTRYSERIALNOID) FROM fna_entryserialno"));
			$MaxEntrySlNo_BO					= $EntrySerial_Query_No_BO['MAX(ENTRYSERIALNOID)'] + 1;
	
	
			$insertQueryEntrySl_BO = "
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
																	'".$MaxEntrySlNo_BO."',
																	'".$PROJECTID."',
																	'".$SUBPROJECTID."',
																	'".$ENTRYDATE."',
																	'".$MaxFlagEntrySl_BO."',
																	'Active',
																	'".$entDate."',
																	'".$entTime."',
																	'".$userId."'
																)
								";
			$insertQueryEntrySl_BOStatement = mysql_query($insertQueryEntrySl_BO);
			
			if ($SOURCEID == 'Hatchery'){
				
					$Query		= "
											SELECT 
													BATCHNO 
											FROM 
													pal_batchopen
											WHERE BATCHNO = '".$BATCHNO."'
										  ";
					$QueryStatement	= mysql_query($Query);
					if(mysql_num_rows($QueryStatement)>0) {
						$msg = "<span class='errorMsg'>Sorry, This Batch No. [ $BATCHNO ] already exist!</span>";
					} else {
						
						if($BWISELIVESTOCK <= $StockInHand){
							
							$MaxFlagQry  	= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM pal_batchopen WHERE BATCHNO = '".$BATCHNO."'"));
							$MaxFlag		= $MaxFlagQry['MAX(FLAG)'] + 1;
							$insertQuery = "
													INSERT INTO 
																pal_batchopen
																				(
																					ENTRYSERIALNOID,
																					PROJECTID,
																					SUBPROJECTID,
																					BATCHNO,
																					BWISELIVESTOCK,
																					PRICE,
																					BDATE,
																					STATUS,
																					FLAG,
																					ENTDATE,
																					ENTTIME,
																					USERID
																				) 
																		VALUES
																				(
																					'".$MaxEntrySlNo_BO."',
																					'3',
																					'8',
																					'".$BATCHNO."',
																					'".$BWISELIVESTOCK."',
																					'".$PRICE_LIVESTOCK."',
																					'".$BDATE."',
																					'Active',
																					'".$MaxFlag."',
																					'".$entDate."',
																					'".$entTime."',
																					'".$userId."'
																				)
												"; 
							$insertQueryStatement = mysql_query($insertQuery);
							
							if($insertQueryStatement){
								
								//Update  Poultry Chicken Purchase table Start
								$PalChickPurFlagQuery			= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM pal_chicken_purchase"));
								$PalChickPurFlag				= $PalChickPurFlagQuery['MAX(FLAG)'];
								$MaxPalChickPurFlag				= $PalChickPurFlagQuery['MAX(FLAG)'] + 1;
								
								$PalChickQry					= mysql_fetch_array(mysql_query("SELECT * FROM pal_chicken_purchase WHERE FLAG = '".$PalChickPurFlag."'"));
								$PalChickTotQnty				= $PalChickQry['TOTQUANTITY'];
								$PalChickTotPrice				= $PalChickQry['TOTPRICE'];
								$PalChickTotAvgRate				= $PalChickQry['AVGRATE'];
								
								$NowPalChickTotQnty				= $PalChickTotQnty - $BWISELIVESTOCK ; 
								$NowPalChickTotPrice			= $PalChickTotPrice - $PRICE_LIVESTOCK ; 
								$NowAvgRate						= $NowPalChickTotPrice / $NowPalChickTotQnty ; 
								
								$insertPalChickPurQuery 			= "
																		INSERT INTO 
																					pal_chicken_purchase
																									(
																										ENTRYSERIALNOID,
																										PARTYID,
																										PROJECTID,
																										SUBPROJECTID,
																										QUANTITY,
																										TOTQUANTITY,
																										RATE,
																										AVGRATE,
																										PRICE,
																										TOTPRICE,
																										CHICKENPURDATE,
																										STATUS,
																										FLAG,
																										ENTDATE,
																										ENTTIME,
																										USERID
																									) 
																								VALUES
																									(
																										'".$MaxEntrySlNo_BO."',
																										'3',
																										'3',
																										'8',
																										'".$BWISELIVESTOCK."',
																										'".$NowPalChickTotQnty."',
																										'".$AvgRate."',
																										'".$NowAvgRate."',
																										'".$PRICE_LIVESTOCK."',
																										'".$NowPalChickTotPrice."',
																										'".$BDATE."',
																										'Buy',
																										'".$MaxPalChickPurFlag."',
																										'".$entDate."',
																										'".$entTime."',
																										'".$userId."'
																									)
																								"; 
									$insertPalChickPurQueryStatement = mysql_query($insertPalChickPurQuery);
								
								//Update Poultry Chicken Purchase table End
								
								//Update Poultry Party Bill Start
								$PartyFlagQueryPal				= mysql_fetch_array(mysql_query("SELECT MAX(PARTYFLAG) FROM fna_partybill WHERE PARTYID = '3'"));
								$MaxPartyFlagPal				= $PartyFlagQueryPal['MAX(PARTYFLAG)'];
								$NowMaxPartyFlagPal 			= $PartyFlagQueryPal['MAX(PARTYFLAG)'] + 1;
								
								$PartyBalanceQueryPal			= mysql_fetch_array(mysql_query("SELECT BALANCEAMOUNT FROM fna_partybill WHERE PARTYID = '3' AND PARTYFLAG = '".$MaxPartyFlagPal."'"));
								$PartyBalanceAmountPal			= $PartyBalanceQueryPal['BALANCEAMOUNT'];
								$NowPartyBalanceAmountPal		= $PartyBalanceAmountPal - $PRICE_LIVESTOCK ; 
								
								$insertPartyQueryPal 			= "
																INSERT INTO 
																			fna_partybill
																							(
																								ENTRYSERIALNOID,
																								PARTYID,
																								PROJECTID,
																								SUBPROJECTID,
																								BATCHNO,
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
																								'".$MaxEntrySlNo_BO."',
																								'3',
																								'3',
																								'8',
																								'".$BATCHNO."',
																								'".$PRICE_LIVESTOCK."',
																								'0',
																								'0',
																								'".$NowPartyBalanceAmountPal."',
																								'".$BDATE."',
																								'".$NowMaxPartyFlagPal."',
																								'Buy',
																								'Purchase',
																								'".$entDate."',
																								'".$entTime."',
																								'".$userId."'
																							)
																						"; 
									$insertPartyQueryStatementPal = mysql_query($insertPartyQueryPal);
								//Update Poultry Party Bill End
								$msg = "<span class='validMsg'>This Batch No. [ $BATCHNO ] added sucessfully</span>";
							} else {
								$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
							}
						
						}else{
							$msg = "<span class='errorMsg'>Sorry! Batch Live Stock Quantity is not greater then Stock in Hand Quantity.....!</span>";	
						}
					}
				
				}else{
					
							$Query		= "
													SELECT 
															BATCHNO 
													FROM 
															pal_batchopen
													WHERE BATCHNO = '".$BATCHNO."'
												  ";
							$QueryStatement	= mysql_query($Query);
							if(mysql_num_rows($QueryStatement)>0) {
								
									$MaxFlagQry  	= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM pal_batchopen WHERE BATCHNO = '".$BATCHNO."'"));
									$MaxFlag		= $MaxFlagQry['MAX(FLAG)'] + 1;
									
									
									$insertQuery = "
															INSERT INTO 
																		pal_batchopen
																						(
																							ENTRYSERIALNOID,
																							PROJECTID,
																							SUBPROJECTID,
																							BATCHNO,
																							BWISELIVESTOCK,
																							PRICE,
																							BDATE,
																							STATUS,
																							FLAG,
																							ENTDATE,
																							ENTTIME,
																							USERID
																						) 
																				VALUES
																						(
																							'".$MaxEntrySlNo_BO."',
																							'3',
																							'8',
																							'".$BATCHNO."',
																							'".$BWISELIVESTOCK."',
																							'".$PRICE_LIVESTOCK."',
																							'".$BDATE."',
																							'Active',
																							'".$MaxFlag."',
																							'".$entDate."',
																							'".$entTime."',
																							'".$userId."'
																						)
														"; 
									$insertQueryStatement = mysql_query($insertQuery);
									
									if($insertQueryStatement){
										
										//Update Poultry Party Bill Start
										$PartyFlagQueryPal				= mysql_fetch_array(mysql_query("SELECT MAX(PARTYFLAG) FROM fna_partybill WHERE PARTYID = '".$PARTYID_PAL."' "));
										$MaxPartyFlagPal				= $PartyFlagQueryPal['MAX(PARTYFLAG)'];
										$NowMaxPartyFlagPal 			= $PartyFlagQueryPal['MAX(PARTYFLAG)'] + 1;
										
										$PartyBalanceQueryPal			= mysql_fetch_array(mysql_query("SELECT BALANCEAMOUNT FROM fna_partybill WHERE PARTYID = '".$PARTYID_PAL."' AND PARTYFLAG = '".$MaxPartyFlagPal."' "));
										$PartyBalanceAmountPal			= $PartyBalanceQueryPal['BALANCEAMOUNT'];
										$NowPartyBalanceAmountPal		= $PartyBalanceAmountPal - $PRICE_LIVESTOCK ; 
										
										$insertPartyQueryPal 			= "
																		INSERT INTO 
																					fna_partybill
																									(
																										ENTRYSERIALNOID,
																										PARTYID,
																										PROJECTID,
																										SUBPROJECTID,
																										BATCHNO,
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
																										'".$MaxEntrySlNo_BO."',
																										'".$PARTYID_PAL."',
																										'3',
																										'8',
																										'".$BATCHNO."',
																										'".$PRICE_LIVESTOCK."',
																										'0',
																										'0',
																										'".$NowPartyBalanceAmountPal."',
																										'".$BDATE."',
																										'".$NowMaxPartyFlagPal."',
																										'Buy',
																										'Purchase',
																										'".$entDate."',
																										'".$entTime."',
																										'".$userId."'
																									)
																								"; 
											$insertPartyQueryStatementPal = mysql_query($insertPartyQueryPal);
										//Update Poultry Party Bill End
										$msg = "<span class='validMsg'>This Batch No. [ $BATCHNO ] added sucessfully</span>";
									} else {
										$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
									}
										//$msg = "<span class='errorMsg'>Sorry, This Batch No. [ $BATCHNO ] already exist!</span>";
					} else {
						
							$MaxFlagQry  	= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM pal_batchopen WHERE BATCHNO = '".$BATCHNO."'"));
							$MaxFlag		= $MaxFlagQry['MAX(FLAG)'] + 1;
							
							
							$insertQuery = "
													INSERT INTO 
																pal_batchopen
																				(
																					ENTRYSERIALNOID,
																					PROJECTID,
																					SUBPROJECTID,
																					BATCHNO,
																					BWISELIVESTOCK,
																					PRICE,
																					BDATE,
																					STATUS,
																					FLAG,
																					ENTDATE,
																					ENTTIME,
																					USERID
																				) 
																		VALUES
																				(
																					'".$MaxEntrySlNo_BO."',
																					'3',
																					'8',
																					'".$BATCHNO."',
																					'".$BWISELIVESTOCK."',
																					'".$PRICE_LIVESTOCK."',
																					'".$BDATE."',
																					'Active',
																					'".$MaxFlag."',
																					'".$entDate."',
																					'".$entTime."',
																					'".$userId."'
																				)
												"; 
							$insertQueryStatement = mysql_query($insertQuery);
							
							if($insertQueryStatement){
								
								//Update Poultry Party Bill Start
								$PartyFlagQueryPal				= mysql_fetch_array(mysql_query("SELECT MAX(PARTYFLAG) FROM fna_partybill WHERE PARTYID = '".$PARTYID_PAL."'"));
								$MaxPartyFlagPal				= $PartyFlagQueryPal['MAX(PARTYFLAG)'];
								$NowMaxPartyFlagPal 			= $PartyFlagQueryPal['MAX(PARTYFLAG)'] + 1;
								
								$PartyBalanceQueryPal			= mysql_fetch_array(mysql_query("SELECT BALANCEAMOUNT FROM fna_partybill WHERE PARTYID = '".$PARTYID_PAL."' AND PARTYFLAG = '".$MaxPartyFlagPal."'"));
								$PartyBalanceAmountPal			= $PartyBalanceQueryPal['BALANCEAMOUNT'];
								$NowPartyBalanceAmountPal		= $PartyBalanceAmountPal - $PRICE_LIVESTOCK ; 
								
								$insertPartyQueryPal 			= "
																INSERT INTO 
																			fna_partybill
																							(
																								ENTRYSERIALNOID,
																								PARTYID,
																								PROJECTID,
																								SUBPROJECTID,
																								BATCHNO,
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
																								'".$MaxEntrySlNo_BO."',
																								'".$PARTYID_PAL."',
																								'3',
																								'8',
																								'".$BATCHNO."',
																								'".$PRICE_LIVESTOCK."',
																								'0',
																								'0',
																								'".$NowPartyBalanceAmountPal."',
																								'".$BDATE."',
																								'".$NowMaxPartyFlagPal."',
																								'Buy',
																								'Purchase',
																								'".$entDate."',
																								'".$entTime."',
																								'".$userId."'
																							)
																						"; 
									$insertPartyQueryStatementPal = mysql_query($insertPartyQueryPal);
								//Update Poultry Party Bill End
								$msg = "<span class='validMsg'>This Batch No. [ $BATCHNO ] added sucessfully</span>";
							} else {
								$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
							}
						
						
					}
					
				}
			return $msg;
		
			
			
			
		}
		// Insert Opening Batch End
		
		// Insert Daily Operation start 
		function insertDailyOperInfo($userId){ 
			$BATCHNO_DO			= addslashes($_REQUEST["BATCHNO_DO"]);
			$STOCKINHAND_DO		= addslashes($_REQUEST["STOCKINHAND_DO"]);
			$DEADSTOCK			= addslashes($_REQUEST["DEADSTOCK"]);
			$CANCELSTOCK		= addslashes($_REQUEST["CANCELSTOCK"]);
			$SELLSTOCK_DO		= addslashes($_REQUEST["SELLSTOCK_DO"]);
			$PARTYID_DO			= addslashes($_REQUEST["PARTYID_PAL"]);
			$TOTALPRICE_DO		= addslashes($_REQUEST["TOTALPRICE_DO"]);
			
			$DODATE				= insertDateMySQlFormat($_REQUEST["DODATE"]);
			
			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
			$Query		= "
									SELECT 	BATCHNO,
											DEADSTOCK,
											CANCELSTOCK,
											SELLSTOCK,
											DODATE
									FROM 
											pal_dailyoperation
									WHERE BATCHNO 	= '".$BATCHNO_DO."'
									AND DEADSTOCK 	= '".$DEADSTOCK."'
									AND CANCELSTOCK = '".$CANCELSTOCK."'
									AND SELLSTOCK 	= '".$SELLSTOCK_DO."'
									AND DODATE 		= '".$DODATE."'
								  ";
			$QueryStatement	= mysql_query($Query);
			if(mysql_num_rows($QueryStatement)>0) {
				$msg = "<span class='errorMsg'>Sorry,  Today's This Batch No. Data [ $BATCHNO_DO ] already Inserted!</span>";
			} else {
				
				$EntrySerial_Query_Flag_DO			= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_entryserialno"));
				$MaxFlagEntrySl_DO					= $EntrySerial_Query_Flag_DO['MAX(FLAG)'];
				
				$EntrySerial_Query_No_DO			= mysql_fetch_array(mysql_query("SELECT MAX(ENTRYSERIALNOID) FROM fna_entryserialno"));
				$MaxEntrySlNo_DO					= $EntrySerial_Query_No_DO['MAX(ENTRYSERIALNOID)'] + 1;
		
		
				$insertQueryEntrySl_DO = "
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
																		'".$MaxEntrySlNo_DO."',
																		'".$PROJECTID."',
																		'".$SUBPROJECTID."',
																		'".$ENTRYDATE."',
																		'".$MaxFlagEntrySl_DO."',
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									";
				$insertQueryEntrySl_DOStatement = mysql_query($insertQueryEntrySl_DO);
				
				$Batchflag		= mysql_fetch_array(mysql_query("SELECT MAX(BATCHFLAG) FROM pal_dailyoperation WHERE BATCHNO = '".$BATCHNO_DO."'"));
				$MaxBatchFlag	= $Batchflag['MAX(BATCHFLAG)'] + 1;
				
				$BatchOpenId	= mysql_fetch_array(mysql_query("SELECT BOID FROM pal_batchopen WHERE BATCHNO = '".$BATCHNO_DO."'"));
				$BOID			= $BatchOpenId['BOID']; 
				$NowSTOCKINHAND	= $STOCKINHAND_DO - ($DEADSTOCK + $CANCELSTOCK + $SELLSTOCK_DO) ; 	
				$insertQuery = "
										INSERT INTO 
													pal_dailyoperation
																	(
																		ENTRYSERIALNOID,
																		BOID,
																		PROJECTID,
																		SUBPROJECTID,
																		PARTYID,
																		BATCHNO,
																		DODATE,
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
																		'".$MaxEntrySlNo_DO."',
																		'".$BOID."',
																		'3',
																		'8',
																		'".$PARTYID_DO."',
																		'".$BATCHNO_DO."',
																		'".$DODATE."',
																		'".$NowSTOCKINHAND."',
																		'".$DEADSTOCK."',
																		'".$CANCELSTOCK."',
																		'".$SELLSTOCK_DO."',
																		'".$TOTALPRICE_DO."',
																		'".$MaxBatchFlag."',
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									"; 
				$insertQueryStatement = mysql_query($insertQuery);
				if($insertQueryStatement){
					//Update Party Bill Table Start
						$PartyFlagQuery				= mysql_fetch_array(mysql_query("SELECT MAX(PARTYFLAG) FROM fna_partybill WHERE PARTYID = '".$PARTYID_DO."' AND PURSELLFLAG = 'Sell'"));
						$MaxPartyFlag				= $PartyFlagQuery['MAX(PARTYFLAG)'];
						$NowMaxPartyFlag			= $PartyFlagQuery['MAX(PARTYFLAG)'] + 1;
						
						$PartyBalanceQuery			= mysql_fetch_array(mysql_query("SELECT BALANCEAMOUNT FROM fna_partybill WHERE PARTYID = '".$PARTYID_DO."' AND PARTYFLAG = '".$MaxPartyFlag."' AND PURSELLFLAG = 'Sell'"));
						$PartyBalanceAmount			= $PartyBalanceQuery['BALANCEAMOUNT'];
						$NowPartyBalanceAmount		= $PartyBalanceAmount + $TOTALPRICE_DO ; 
						
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
																						'".$MaxEntrySlNo_DO."',
																						'".$PARTYID_DO."',
																						'3',
																						'8',
																						'".$TOTALPRICE_DO."',
																						'0',
																						'0',
																						'".$NowPartyBalanceAmount."',
																						'".$DODATE."',
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
					
					$msg = "<span class='validMsg'>This Batch No. [ $PARTYID_DO ] added sucessfully</span>";
				} else {
					$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
				}
			}
			return $msg;
			
			
			
			
		}
		// Insert Daily Operation  End
		
		// Insert Divide Morog Murgi start 
		function insertDivMMInfo($userId){
			$BATCHNO_MM			= addslashes($_REQUEST["BATCHNO_MM"]);
			$STOCKINHAND_MM		= addslashes($_REQUEST["STOCKINHAND_MM"]);
			$MOROG_MM_QNTY		= addslashes($_REQUEST["MOROG_MM"]);
			$MURGI_MM_QNTY		= addslashes($_REQUEST["MURGI_MM"]);
			
			$ENTRYDATE			= insertDateMySQlFormat($_REQUEST["ENTRYDATE"]);
			
			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
			$Query		= "
									SELECT 	mor.BATCHNO,
											mor.ENTRYDATE,
											mor.STOCKINHAND AS MORQNTY,
											mur.STOCKINHAND AS MURQNTY
									FROM 
											pal_morog mor, pal_murgi mur
									WHERE mor.BATCHNO 	= '".$BATCHNO_MM."'
									AND mor.ENTRYDATE 	= '".$ENTRYDATE."'
									AND mor.STOCKINHAND = '".$MOROG_MM_QNTY."'
									AND mur.STOCKINHAND	= '".$MURGI_MM_QNTY."'
							";
			$QueryStatement	= mysql_query($Query);
			if(mysql_num_rows($QueryStatement)>0) {
				$msg = "<span class='errorMsg'>Sorry,  Today's This Batch No. Data [ $BATCHNO_MM ] already Inserted!</span>";
			} else {
				
				$EntrySerial_Query_Flag_DIV			= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_entryserialno"));
				$MaxFlagEntrySl_DIV					= $EntrySerial_Query_Flag_DIV['MAX(FLAG)'];
				
				$EntrySerial_Query_No_DIV			= mysql_fetch_array(mysql_query("SELECT MAX(ENTRYSERIALNOID) FROM fna_entryserialno"));
				$MaxEntrySlNo_DIV					= $EntrySerial_Query_No_DIV['MAX(ENTRYSERIALNOID)'] + 1;
		
		
				$insertQueryEntrySl_DIV = "
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
																		'".$MaxEntrySlNo_DIV."',
																		'".$PROJECTID."',
																		'".$SUBPROJECTID."',
																		'".$ENTRYDATE."',
																		'".$MaxFlagEntrySl_DIV."',
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									";
				$insertQueryEntrySl_DIVStatement = mysql_query($insertQueryEntrySl_DIV);
				
				$TotalMorogMurgiQnty	= $MOROG_MM_QNTY + $MURGI_MM_QNTY ; 
				if($TotalMorogMurgiQnty <= $STOCKINHAND_MM){
					
					$Batchflag		= mysql_fetch_array(mysql_query("SELECT MAX(BATCHFLAG) FROM pal_dailyoperation WHERE BATCHNO = '".$BATCHNO_MM."'"));
					$MaxBatchFlag	= $Batchflag['MAX(BATCHFLAG)'];
					
					$DailyOperId	= mysql_fetch_array(mysql_query("SELECT DOID FROM pal_dailyoperation WHERE BATCHNO = '".$BATCHNO_MM."' AND BATCHFLAG = '".$MaxBatchFlag."'"));
					$DOID			= $DailyOperId['DOID']; 
					
					$Batchflag_MOR	= mysql_fetch_array(mysql_query("SELECT MAX(BATCHFLAG) FROM pal_morog WHERE BATCHNO = '".$BATCHNO_MM."'"));
					$MaxBatchFlag_MOR	= $Batchflag_MOR['MAX(BATCHFLAG)'] + 1;
					//$NowSTOCKINHAND	= $STOCKINHAND_DO - ($DEADSTOCK + $CANCELSTOCK + $SELLSTOCK) ; 	
					$insertQuery_MOR = "
											INSERT INTO 
														pal_morog
																		(
																			ENTRYSERIALNOID,
																			DOID,
																			BATCHNO,
																			ENTRYDATE,
																			STOCKINHAND,
																			BATCHFLAG,
																			STATUS,
																			ENTDATE,
																			ENTTIME,
																			USERID
																		) 
																VALUES
																		(
																			'".$MaxEntrySlNo_DIV."',
																			'".$DOID."',
																			'".$BATCHNO_MM."',
																			'".$ENTRYDATE."',
																			'".$MOROG_MM_QNTY."',
																			'".$MaxBatchFlag_MOR."',
																			'Active',
																			'".$entDate."',
																			'".$entTime."',
																			'".$userId."'
																		)
										"; 
					$insertQuery_MORStatement = mysql_query($insertQuery_MOR);
					if($insertQuery_MORStatement){
						$msg = "<span class='validMsg'>This Batch No. [ $BATCHNO_MM ] added sucessfully</span>";
					} else {
						$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
					}
					
					$Batchflag_MUR	= mysql_fetch_array(mysql_query("SELECT MAX(BATCHFLAG) FROM pal_murgi WHERE BATCHNO = '".$BATCHNO_MM."'"));
					$MaxBatchFlag_MUR	= $Batchflag_MUR['MAX(BATCHFLAG)'] + 1;
					//$NowSTOCKINHAND	= $STOCKINHAND_DO - ($DEADSTOCK + $CANCELSTOCK + $SELLSTOCK) ; 	
					$insertQuery_MUR = "
											INSERT INTO 
														pal_murgi
																		(
																			ENTRYSERIALNOID,
																			DOID,
																			BATCHNO,
																			ENTRYDATE,
																			STOCKINHAND,
																			BATCHFLAG,
																			STATUS,
																			ENTDATE,
																			ENTTIME,
																			USERID
																		) 
																VALUES
																		(
																			'".$MaxEntrySlNo_DIV."',
																			'".$DOID."',
																			'".$BATCHNO_MM."',
																			'".$ENTRYDATE."',
																			'".$MURGI_MM_QNTY."',
																			'".$MaxBatchFlag_MUR."',
																			'Active',
																			'".$entDate."',
																			'".$entTime."',
																			'".$userId."'
																		)
										"; 
					$insertQuery_MURStatement = mysql_query($insertQuery_MUR);
					if($insertQuery_MURStatement){
						$DailyOperFlag = mysql_fetch_array(mysql_query("SELECT MAX(BATCHFLAG) FROM pal_dailyoperation WHERE BATCHNO = '".$BATCHNO_MM."'"));
						$MaxBatchFlag_Daily = $DailyOperFlag['MAX(BATCHFLAG)'];
						$DailyStatus		= mysql_fetch_array(mysql_query("SELECT STATUS FROM pal_dailyoperation WHERE BATCHNO = '".$BATCHNO_MM."' AND BATCHFLAG = '".$MaxBatchFlag_Daily."'"));
						$STATUS				= $DailyStatus['STATUS'];
						$UpdateDailyOper	= "UPDATE pal_dailyoperation SET
												STATUS = 'Inactive'
												WHERE BATCHNO = '".$BATCHNO_MM."'
												AND BATCHFLAG = '".$MaxBatchFlag_Daily."'
												
						";
						$SubmitUpdate = mysql_query($UpdateDailyOper);
						
						$UpdateDailyBatchOpen	= "UPDATE pal_batchopen SET
													STATUS = 'Inactive'
													WHERE BATCHNO = '".$BATCHNO_MM."'
													
						";
						$BatchOpenSubmitUpdate = mysql_query($UpdateDailyBatchOpen);
						$msg = "<span class='validMsg'>This Batch No. [ $BATCHNO_MM ] added sucessfully</span>";
					} else {
						$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
					}
			
					
				}else{
					$msg = "<span class='errorMsg'>Sorry,  Morog + Murgi Quantity is Greater then Total Stock Quantity.....Please Check....!</span>";
				}
				
			}
			return $msg;
			
			
			
			
		}
		// Insert Divide Morog Murgi  End
		
		// Insert Standandard Food Item start 
		function InsertStandardFoodInfo($userId){
			$FOODID_STANDARD	= addslashes($_REQUEST["FOODID_STANDARD"]);
			$STANDARD_QUANTITY	= addslashes($_REQUEST["STANDARD_QUANTITY"]);
			$STANDARD_WEIGHT	= addslashes($_REQUEST["STANDARD_WEIGHT"]);
			$FSDATE				= insertDateMySQlFormat($_REQUEST["FSDATE"]);
			
			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
				
				$Standard_Query_Flag				= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM feed_standardfood"));
				$MaxStandard_Query_Flag				= $Standard_Query_Flag['MAX(FLAG)']+1;
				
				$InsertStandardFood = "
										INSERT INTO 
													feed_standardfood
																	(
																		FOODID,
																		QUANTITY,
																		WTID,
																		FLAG,
																		STATUS,
																		FSDATE
																	) 
															VALUES
																	(
																		'".$FOODID_STANDARD."',
																		'".$STANDARD_QUANTITY."',
																		'".$STANDARD_WEIGHT."',
																		'".$MaxStandard_Query_Flag."',
																		'Active',
																		'".$FSDATE."'
																	)
									";
				$InsertStandardFoodStatement = mysql_query($InsertStandardFood);
				
				if($InsertStandardFoodStatement){
						$msg = "<span class='validMsg'>Standard Quantity for : [ $FOODID_STANDARD ] added sucessfully</span>";
					} else {
						$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
					}
				
			return $msg;
			
			
			
			
		}
		// Insert Standandard Food Item End
		
		// Insert Daily Operation Morog Murgi start 
		function insertDailyOperMurMorInfo($userId){
			$BATCHNO_MMDO		= addslashes($_REQUEST["BATCHNO_MMDO"]);
			$STOCKINHAND_MMDO	= addslashes($_REQUEST["STOCKINHAND_MMDO"]);
			$DEADSTOCK_MMDO		= addslashes($_REQUEST["DEADSTOCK_MMDO"]);
			$CANCELSTOCK_MMDO	= addslashes($_REQUEST["CANCELSTOCK_MMDO"]);
			//$SELLSTOCK_DOMM		= addslashes($_REQUEST["SELLSTOCK_DOMM"]);
			//$TOTALPRICE_DOMM	= addslashes($_REQUEST["TOTALPRICE_DOMM"]);
			//$PARTYID_DOPAL		= addslashes($_REQUEST["PARTYID_DOPAL"]);
			
			$MOROGMURGI			= addslashes($_REQUEST["MOROGMURGI"]);
			
			$ENTRYDATE_MMDO		= insertDateMySQlFormat($_REQUEST["ENTRYDATE_MMDO"]);
			
			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
			$EntrySerial_Query_Flag_DOMM		= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_entryserialno"));
			$MaxFlagEntrySl_DOMM					= $EntrySerial_Query_Flag_DOMM['MAX(FLAG)'];
			
			$EntrySerial_Query_No_DOMM			= mysql_fetch_array(mysql_query("SELECT MAX(ENTRYSERIALNOID) FROM fna_entryserialno"));
			$MaxEntrySlNo_DOMM					= $EntrySerial_Query_No_DOMM['MAX(ENTRYSERIALNOID)'] + 1;
	
	
			$insertQueryEntrySl_DOMM = "
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
																	'".$MaxEntrySlNo_DOMM."',
																	'".$PROJECTID."',
																	'".$SUBPROJECTID."',
																	'".$ENTRYDATE."',
																	'".$MaxFlagEntrySl_DOMM."',
																	'Active',
																	'".$entDate."',
																	'".$entTime."',
																	'".$userId."'
																)
								";
			$insertQueryEntrySl_DOMMStatement = mysql_query($insertQueryEntrySl_DOMM);
			
			
			if ($MOROGMURGI == 'Morog'){
					
					$Query		= "
									SELECT 	BATCHNO,
											DEADSTOCK,
											CANCELSTOCK,
											SELLSTOCK,
											ENTRYDATE
									FROM 
											pal_morog
									WHERE BATCHNO 	= '".$BATCHNO_MMDO."'
									AND DEADSTOCK 	= '".$DEADSTOCK_MMDO."'
									AND CANCELSTOCK = '".$CANCELSTOCK_MMDO."'
									AND ENTRYDATE	= '".$ENTRYDATE_MMDO."'
								  ";
					$QueryStatement	= mysql_query($Query);
					if(mysql_num_rows($QueryStatement)>0) {
						$msg = "<span class='errorMsg'>Sorry,  Today's This Batch No. Data [ $BATCHNO_MMDO ] already Inserted!</span>";
					} else {
						
						$TotalMorogMurgiQnty_MMDO		= $DEADSTOCK_MMDO + $CANCELSTOCK_MMDO ; 
						if($TotalMorogMurgiQnty_MMDO <= $STOCKINHAND_MMDO){
							
							$Batchflag_do		= mysql_fetch_array(mysql_query("SELECT MAX(BATCHFLAG) FROM pal_dailyoperation WHERE BATCHNO = '".$BATCHNO_MMDO."'"));
							$MaxBatchFlag_do	= $Batchflag_do['MAX(BATCHFLAG)'];
							
							$DailyOperId	= mysql_fetch_array(mysql_query("SELECT DOID FROM pal_dailyoperation WHERE BATCHNO = '".$BATCHNO_MMDO."' AND BATCHFLAG = '".$MaxBatchFlag_do."'"));
							$DOID			= $DailyOperId['DOID']; 
							
							$Batchflag_morog		= mysql_fetch_array(mysql_query("SELECT MAX(BATCHFLAG) FROM pal_morog WHERE BATCHNO = '".$BATCHNO_MMDO."'"));
							$MaxBatchFlag_morog		= $Batchflag_morog['MAX(BATCHFLAG)'] + 1;
							$NowSTOCKINHAND_morog	= $STOCKINHAND_MMDO - ($DEADSTOCK_MMDO + $CANCELSTOCK_MMDO ) ; 	
							$insertQuery_morog		= "
															INSERT INTO 
																		pal_morog
																				(
																					ENTRYSERIALNOID,
																					DOID,
																					PROJECTID,
																					SUBPROJECTID,
																					BATCHNO,
																					ENTRYDATE,
																					STOCKINHAND,
																					DEADSTOCK,
																					CANCELSTOCK,
																					BATCHFLAG,
																					STATUS,
																					ENTDATE,
																					ENTTIME,
																					USERID
																				) 
																		VALUES
																				(
																					'".$MaxEntrySlNo_DOMM."',
																					'".$DOID."',
																					'3',
																					'8',
																					'".$BATCHNO_MMDO."',
																					'".$ENTRYDATE_MMDO."',
																					'".$NowSTOCKINHAND_morog."',
																					'".$DEADSTOCK_MMDO."',
																					'".$CANCELSTOCK_MMDO."',
																					'".$MaxBatchFlag_morog."',
																					'Active',
																					'".$entDate."',
																					'".$entTime."',
																					'".$userId."'
																				)
												"; 
							$insertQuery_morogStatement = mysql_query($insertQuery_morog);
							
						}else{
							$msg = "<span class='errorMsg'>Sorry,  Morog + Murgi Quantity is Greater then Total Stock Quantity.....Please Check....!</span>";
						}
						
					}
				}else{
					
						$Query		= "
										SELECT 	BATCHNO,
												DEADSTOCK,
												CANCELSTOCK,
												SELLSTOCK,
												ENTRYDATE
										FROM 
												pal_murgi
										WHERE BATCHNO 	= '".$BATCHNO_MMDO."'
										AND DEADSTOCK 	= '".$DEADSTOCK_MMDO."'
										AND CANCELSTOCK = '".$CANCELSTOCK_MMDO."'
										AND ENTRYDATE	= '".$ENTRYDATE_MMDO."'
									  ";
						$QueryStatement	= mysql_query($Query);
						if(mysql_num_rows($QueryStatement)>0) {
							$msg = "<span class='errorMsg'>Sorry,  Today's This Batch No. Data [ $BATCHNO_MMDO ] already Inserted!</span>";
						} else {
							
							$TotalMorogMurgiQnty_MMDO		= $DEADSTOCK_MMDO + $CANCELSTOCK_MMDO ; 
							if($TotalMorogMurgiQnty_MMDO <= $STOCKINHAND_MMDO){
								
								$Batchflag_do		= mysql_fetch_array(mysql_query("SELECT MAX(BATCHFLAG) FROM pal_dailyoperation WHERE BATCHNO = '".$BATCHNO_MMDO."'"));
								$MaxBatchFlag_do	= $Batchflag_do['MAX(BATCHFLAG)'];
								
								$DailyOperId	= mysql_fetch_array(mysql_query("SELECT DOID FROM pal_dailyoperation WHERE BATCHNO = '".$BATCHNO_MMDO."' AND BATCHFLAG = '".$MaxBatchFlag_do."'"));
								$DOID			= $DailyOperId['DOID']; 
								
								$Batchflag_murgi		= mysql_fetch_array(mysql_query("SELECT MAX(BATCHFLAG) FROM pal_murgi WHERE BATCHNO = '".$BATCHNO_MMDO."'"));
								$MaxBatchFlag_murgi		= $Batchflag_murgi['MAX(BATCHFLAG)'] + 1;
								$NowSTOCKINHAND_murgi	= $STOCKINHAND_MMDO - ($DEADSTOCK_MMDO + $CANCELSTOCK_MMDO ) ; 	
								$insertQuery_murgi		= "
																INSERT INTO 
																			pal_murgi
																					(
																						ENTRYSERIALNOID,
																						DOID,
																						PROJECTID,
																						SUBPROJECTID,
																						BATCHNO,
																						ENTRYDATE,
																						STOCKINHAND,
																						DEADSTOCK,
																						CANCELSTOCK,
																						SELLPRICE,
																						BATCHFLAG,
																						STATUS,
																						ENTDATE,
																						ENTTIME,
																						USERID
																					) 
																			VALUES
																					(
																						'".$MaxEntrySlNo_DOMM."',
																						'".$DOID."',
																						'3',
																						'8',
																						'".$BATCHNO_MMDO."',
																						'".$ENTRYDATE_MMDO."',
																						'".$NowSTOCKINHAND_murgi."',
																						'".$DEADSTOCK_MMDO."',
																						'".$CANCELSTOCK_MMDO."',
																						'0',
																						'".$MaxBatchFlag_murgi."',
																						'Active',
																						'".$entDate."',
																						'".$entTime."',
																						'".$userId."'
																					)
													"; 
								$insertQuery_murgiStatement = mysql_query($insertQuery_murgi);
									
							}else{
								$msg = "<span class='errorMsg'>Sorry,  Morog + Murgi Quantity is Greater then Total Stock Quantity.....Please Check....!</span>";
							}
							
						}
			}
			
			
			return $msg;
		}
		// Insert Daily Operation Morog Murgi  End
		
		// Insert Food Distribution start 
		function insertFoodDistInfo($userId){
			$DOID_FD			= addslashes($_REQUEST["DOID"]);
			$MORID_FD			= addslashes($_REQUEST["MORID"]);
			$MURID_FD			= addslashes($_REQUEST["MURID"]);
			$UNITPRICE			= addslashes($_REQUEST["UNITPRICE"]);
			$BATCHNO_FD			= addslashes($_REQUEST["BATCHNO_FD"]);
			$STOCKINHAND_FD		= addslashes($_REQUEST["STOCKINHAND_FD"]);
			$FOOD_NEED_MUR_MOR	= addslashes($_REQUEST["FOOD_NEED_MUR_MOR"]);
			$FOODWEIGHT			= addslashes($_REQUEST["FOODWEIGHT"]);
			$TOTALPRICE			= addslashes($_REQUEST["TOTALPRICE"]);
			
			$FOODID				= addslashes($_REQUEST["FOODID"]);
			
			$FDDATE				= insertDateMySQlFormat($_REQUEST["FDDATE"]);
			
			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
			
					
					$Query		= "
									SELECT 	FOODID,
											BATCHNO,
											MUR_MOR_QNTY,
											FOOD_NEED_MUR_MOR,
											FOODWEIGHT,
											TOTALPRICE,
											FDDATE
									FROM 
											pal_fooddistribute
									WHERE FOODID 	= '".$FOODID."'
									AND BATCHNO 	= '".$BATCHNO_FD."'
									AND MUR_MOR_QNTY = '".$STOCKINHAND_FD."'
									AND FOOD_NEED_MUR_MOR = '".$FOOD_NEED_MUR_MOR."'
									AND FOODWEIGHT	= '".$FOODWEIGHT."'
									AND TOTALPRICE	= '".$TOTALPRICE."'
									AND FDDATE	= '".$FDDATE."'
								  ";
					$QueryStatement	= mysql_query($Query);
					if(mysql_num_rows($QueryStatement)>0) {
						$msg = "<span class='errorMsg'>Sorry,  Today's This Batch No. Data [ $BATCHNO_FD ] already Inserted!</span>";
					} else {
						
						$EntrySerial_Query_Flag_FD 			= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_entryserialno"));
						$MaxFlagEntrySl_FD					= $EntrySerial_Query_Flag_FD['MAX(FLAG)'];
						
						$EntrySerial_Query_No_FD			= mysql_fetch_array(mysql_query("SELECT MAX(ENTRYSERIALNOID) FROM fna_entryserialno"));
						$MaxEntrySlNo_FD					= $EntrySerial_Query_No_FD['MAX(ENTRYSERIALNOID)'] + 1;
				
				
						$insertQueryEntrySl_FD = "
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
																				'".$MaxEntrySlNo_FD."',
																				'".$PROJECTID."',
																				'".$SUBPROJECTID."',
																				'".$ENTRYDATE."',
																				'".$MaxFlagEntrySl_FD."',
																				'Active',
																				'".$entDate."',
																				'".$entTime."',
																				'".$userId."'
																			)
											";
						$insertQueryEntrySl_FDStatement = mysql_query($insertQueryEntrySl_FD);
						
						$Batchflag_FGoods		= mysql_fetch_array(mysql_query("SELECT MAX(FOODFLAG) FROM feed_finishedstock WHERE FOODID = '".$FOODID."'"));
						$MaxBatchFlag_FGoods	= $Batchflag_FGoods['MAX(FOODFLAG)'];
						
						$FOODTOTQNTY_FGoods		= mysql_fetch_array(mysql_query("SELECT FOODTOTQNTY FROM feed_finishedstock WHERE FOODID = '".$FOODID."' AND FOODFLAG = '".$MaxBatchFlag_FGoods."'"));
						$FOODTOTQNTY_FG			= $FOODTOTQNTY_FGoods['FOODTOTQNTY'];
						
						if($FOODTOTQNTY_FG >= $FOODWEIGHT){
							
							/*$Batchflag_do		= mysql_fetch_array(mysql_query("SELECT MAX(BATCHFLAG) FROM pal_dailyoperation WHERE BATCHNO = '".$BATCHNO_MMDO."'"));
							$MaxBatchFlag_do	= $Batchflag_do['MAX(BATCHFLAG)'];
							
							$DailyOperId	= mysql_fetch_array(mysql_query("SELECT DOID FROM pal_dailyoperation WHERE BATCHNO = '".$BATCHNO_MMDO."' AND BATCHFLAG = '".$MaxBatchFlag_do."'"));
							$DOID			= $DailyOperId['DOID']; 
							*/
							$Batchflag_fd		= mysql_fetch_array(mysql_query("SELECT MAX(BATCHFLAG) FROM pal_fooddistribute WHERE BATCHNO = '".$BATCHNO_FD."'"));
							$MaxBatchFlag_fd	= $Batchflag_fd['MAX(BATCHFLAG)'];
							$NowMaxBatchFlag_fd	= $Batchflag_fd['MAX(BATCHFLAG)'] + 1;
							
							$TOTFOODWEIGHT_FGoods		= mysql_fetch_array(mysql_query("SELECT TOTFOODWEIGHT FROM pal_fooddistribute WHERE BATCHNO = '".$BATCHNO_FD."' AND BATCHFLAG = '".$MaxBatchFlag_fd."'"));
							$TOTFOODWEIGHT_FG			= $TOTFOODWEIGHT_FGoods['TOTFOODWEIGHT'];
							
							$TOTAL_FOODWEIGHT = $TOTFOODWEIGHT_FG + $FOODWEIGHT ; 
							
							$insertQuery_fd		= "
														INSERT INTO 
																	pal_fooddistribute
																				(
																					ENTRYSERIALNOID,
																					FOODID,
																					PROJECTID,
																					SUBPROJECTID,
																					BATCHNO,
																					DOID,
																					MURID,
																					MORID,
																					MUR_MOR_QNTY,
																					FOOD_NEED_MUR_MOR,
																					FOODWEIGHT,
																					TOTFOODWEIGHT,
																					PRICE,
																					TOTALPRICE,
																					BATCHFLAG,
																					FDDATE,
																					STATUS,
																					ENTDATE,
																					ENTTIME,
																					USERID
																				) 
																		VALUES
																				(
																					'".$MaxEntrySlNo_FD."',
																					'".$FOODID."',
																					'3',
																					'8',
																					'".$BATCHNO_FD."',
																					'".$DOID_FD."',
																					'".$MURID_FD."',
																					'".$MORID_FD."',
																					'".$STOCKINHAND_FD."',
																					'".$FOOD_NEED_MUR_MOR."',
																					'".$FOODWEIGHT."',
																					'".$TOTAL_FOODWEIGHT."',
																					'".$UNITPRICE."',
																					'".$TOTALPRICE."',
																					'".$NowMaxBatchFlag_fd."',
																					'".$FDDATE."',
																					'Active',
																					'".$entDate."',
																					'".$entTime."',
																					'".$userId."'
																				)
												"; 
							$insertQuery_fdStatement = mysql_query($insertQuery_fd);
							$Last_FDID	=	mysql_insert_id();
							if($insertQuery_fdStatement){
								
								//Update Finished goods Table Start
								
								$MAXFLAG_FinishStck				= mysql_fetch_array(mysql_query("SELECT MAX(FOODFLAG) FROM feed_finishedstock WHERE FOODID = '".$FOODID."'"));
								$MAXFOOD_Flag					= $MAXFLAG_FinishStck['MAX(FOODFLAG)'];
								$Now_MAXFOOD_Flag_Finishstk		= $MAXFLAG_FinishStck['MAX(FOODFLAG)'] + 1;
								
								$FinishStkQry					= mysql_fetch_array(mysql_query("SELECT * FROM feed_finishedstock WHERE FOODID = '".$FOODID."' AND FOODFLAG = '".$MAXFOOD_Flag."'"));
								$FOODTOTQNTY					= $FinishStkQry['FOODTOTQNTY'];
								$AMOUNT_FINISH					= $FinishStkQry['AMOUNT'];
								$TOTAMOUNT_FINISH				= $FinishStkQry['TOTAMOUNT'];
								$AVGPRICE_FINISH				= $FinishStkQry['AVGPRICE'];
								
								$Now_FOODTOTQNTY				= $FOODTOTQNTY - $FOODWEIGHT ; 
								
								//$Now_AMOUNT_FINISH				= $AMOUNT_FINISH + $PRODUCTIONQNTY ;
						
								$Now_TOTAMOUNT_FINISH			= $TOTAMOUNT_FINISH - $TOTALPRICE ;
								
								//$Now_AVGPRICE_FINISH			= $Now_TOTAMOUNT_FINISH / $Now_FOODTOTQNTY ;
								
								
								
								
								$insertQueryFinishStock = "
														INSERT INTO 
																	feed_finishedstock
																					(
																						ENTRYSERIALNOID,
																						PARTYID,
																						PROJECTID,
																						SUBPROJECTID,
																						FDID,
																						FOODID,
																						QUANTITY,
																						FOODTOTQNTY,
																						AMOUNT,
																						TOTAMOUNT,
																						AVGPRICE,
																						SELLAVGPRICE,
																						FOODFLAG,
																						WORKFLAG,
																						STATUS,
																						ENTDATE,
																						ENTTIME,
																						USERID
																					) 
																			VALUES
																					(
																						'".$MaxEntrySlNo_FD."',
																						'2',
																						'2',
																						'6',
																						'".$Last_FDID."',
																						'".$FOODID."',
																						'".$FOODWEIGHT."',
																						'".$Now_FOODTOTQNTY."',
																						'".$TOTALPRICE."',
																						'".$Now_TOTAMOUNT_FINISH."',
																						'".$AVGPRICE_FINISH."',
																						'".$UNITPRICE."',
																						'".$Now_MAXFOOD_Flag_Finishstk."',
																						'Out',
																						'Active',
																						'".$FDDATE."',
																						'".$entTime."',
																						'".$userId."'
																					)
														"; 
								$queryStatementSubmitFinishStock = mysql_query($insertQueryFinishStock);
							
								if($queryStatementSubmitFinishStock){
									//Update Party Bill Table Start
										$PartyFlagQuery				= mysql_fetch_array(mysql_query("SELECT MAX(PARTYFLAG) FROM fna_partybill WHERE PARTYID = '2' AND PURSELLFLAG = 'Purchase'"));
										$MaxPartyFlag				= $PartyFlagQuery['MAX(PARTYFLAG)'];
										$NowMaxPartyFlag			= $PartyFlagQuery['MAX(PARTYFLAG)'] + 1;
										
										$PartyBalanceQuery			= mysql_fetch_array(mysql_query("SELECT BALANCEAMOUNT FROM fna_partybill WHERE PARTYID = '2' AND PARTYFLAG = '".$MaxPartyFlag."' AND PURSELLFLAG = 'Purchase'"));
										$PartyBalanceAmount			= $PartyBalanceQuery['BALANCEAMOUNT'];
										$NowPartyBalanceAmount		= $PartyBalanceAmount - $TOTALPRICE ; 
										
										$insertPartyQuery 			= "
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
																										'".$MaxEntrySlNo_FD."',
																										'2',
																										'3',
																										'8',
																										'".$TOTALPRICE."',
																										'".$TOTALPRICE."',
																										'0',
																										'".$PartyBalanceAmount."',
																										'".$FDDATE."',
																										'".$NowMaxPartyFlag."',
																										'Buy',
																										'Purchase',
																										'".$entDate."',
																										'".$entTime."',
																										'".$userId."'
																									)
																								"; 
										$insertPartyQueryStatement = mysql_query($insertPartyQuery);
										
										//--------------------------------Update Daily Income Expanse Table Start----------------------------------------
										$INEX_FLAG	 			= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_daily_income_expanse"));
										$MAXINEX_FLAG	 		= $INEX_FLAG['MAX(FLAG)'];
										$NOW_MAXINEX_FLAG	 	= $MAXINEX_FLAG + 1;
										
										$FOODNAME_QRY 			= mysql_fetch_array(mysql_query("SELECT FOODNAME FROM feed_fooditem where FOODID = '".$FOODID."'"));
										$FOOD_NAME				= $FOODNAME_QRY['FOODNAME'];
										
										$DESCRIPTION_NOW		= 'Payment to Feed Mill. Batch No: '.''.$BATCHNO_FD.', Food Name : '.$FOOD_NAME.',  Qnty : '.$FOODWEIGHT.' * '.number_format($UNITPRICE,4).'';
										
										$insertDailyInExQuery = "
																INSERT INTO 
																				fna_daily_income_expanse
																											(
																												ENTRYSERIALNOID,
																												PROJECTID,
																												SUBPROJECTID,
																												DATE,
																												INHID,
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
																												'".$MaxEntrySlNo_FD."',
																												'3',
																												'8',
																												'".$FDDATE."',
																												'',
																												'157',
																												'".$TOTALPRICE."',
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
										
										
										$PartyFlagQueryFeed				= mysql_fetch_array(mysql_query("SELECT MAX(PARTYFLAG) FROM fna_partybill WHERE PARTYID = '1' AND PURSELLFLAG = 'Sell'"));
										$MaxPartyFlagFeed				= $PartyFlagQueryFeed['MAX(PARTYFLAG)'];
										$NowMaxPartyFlagFeed			= $PartyFlagQueryFeed['MAX(PARTYFLAG)'] + 1;
										
										$PartyBalanceQueryFeed			= mysql_fetch_array(mysql_query("SELECT BALANCEAMOUNT FROM fna_partybill WHERE PARTYID = '1' AND PARTYFLAG = '".$MaxPartyFlagFeed."' AND PURSELLFLAG = 'Sell'"));
										$PartyBalanceAmountFeed			= $PartyBalanceQueryFeed['BALANCEAMOUNT'];
										$NowPartyBalanceAmountFeed		= $PartyBalanceAmountFeed + $TOTALPRICE ; 
										
										$insertPartyQueryFeed 			= "
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
																										'".$MaxEntrySlNo_FD."',
																										'1',
																										'2',
																										'6',
																										'".$TOTALPRICE."',
																										'0',
																										'".$TOTALPRICE."',
																										'".$PartyBalanceAmountFeed."',
																										'".$FDDATE."',
																										'".$NowMaxPartyFlagFeed."',
																										'Sell',
																										'Sell',
																										'".$entDate."',
																										'".$entTime."',
																										'".$userId."'
																									)
																								"; 
										$insertPartyQueryFeedStatement = mysql_query($insertPartyQueryFeed);
										//Update Party Bill Table End
										
										//-----------------------------Update Daily Income Expanse Table Start-----------------------------
										$INEX_FLAG	 			= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_daily_income_expanse"));
										$MAXINEX_FLAG	 		= $INEX_FLAG['MAX(FLAG)'];
										$NOW_MAXINEX_FLAG	 	= $MAXINEX_FLAG + 1;
										
										//$PARTYNAME_QRY 			= mysql_fetch_array(mysql_query("SELECT PARTYNAME FROM fna_party WHERE PARTYID = '".$PARTYID."'"));
										//$PARTYNAME				= $PARTYNAME_QRY['PARTYNAME'];
										$NOW_DESCRIPTION		= 'Payment Receive from Poultry Firm. Batch No: '.''.$BATCHNO_FD.', Food Name : '.$FOOD_NAME.',  Qnty : '.$FOODWEIGHT.' * '.number_format($UNITPRICE,4).'';
										
										$insertDailyInExQuery = "
																INSERT INTO 
																				fna_daily_income_expanse
																											(
																												ENTRYSERIALNOID,
																												PROJECTID,
																												SUBPROJECTID,
																												DATE,
																												INHID,
																												EXPHID,
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
																												'".$MaxEntrySlNo_FD."',
																												'2',
																												'6',
																												'".$FDDATE."',
																												'18',
																												'',
																												'".$TOTALPRICE."',
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
									$msg = "<span class='validMsg'>This Information (Finish Stock)  added sucessfully</span>";
								}else{
									$msg = "<span class='errorMsg'>Sorry! System Error Finished Stock...!</span>";
									
								}
								//Update Finished goods Table End
								$msg = "<span class='validMsg'>This Batch No. [ $BATCHNO_FD ] added sucessfully</span>";
							} else {
								$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
							}
						}else{
							$msg = "<span class='errorMsg'>Sorry,  Food Quantoty is Lower then  Total Stock Quantity.....Please Check....!</span>";
						}
						
					}
				
			
			
			return $msg;
		}
		// Insert  Food Distribution  End
		
		// Insert Medicine Distribution start 
		function insertMedicinDistInfo($userId){
			$BATCHNO_MD				= $_REQUEST["BATCHNO_MD"];
			$PRODUCTID_MD			= $_REQUEST["PRODUCTIDMD"];
			$QUANTITY_MD			= $_REQUEST["QUANTITY_MD"];
			$BALANCE_QUANTITY_MD	= $_REQUEST["BALANCE_QUANTITY_MD"];
			//$WTID_MD				= $_REQUEST["WTID_MD"];
			
			$TOTAL_PRODUCT_LIST	= $_REQUEST["TOTAL_PRODUCT_LIST"];
			
			$MDDATE				= insertDateMySQlFormat($_REQUEST["MDDATE"]);
			
			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
			
			$EntrySerial_Query_Flag_MD 			= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_entryserialno"));
			$MaxFlagEntrySl_MD					= $EntrySerial_Query_Flag_MD['MAX(FLAG)'];
			
			$EntrySerial_Query_No_MD			= mysql_fetch_array(mysql_query("SELECT MAX(ENTRYSERIALNOID) FROM fna_entryserialno"));
			$MaxEntrySlNo_MD					= $EntrySerial_Query_No_MD['MAX(ENTRYSERIALNOID)'] + 1;
	
	
			$insertQueryEntrySl_MD = "
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
																	'".$MaxEntrySlNo_MD."',
																	'5',
																	'7',
																	'".$MDDATE."',
																	'".$MaxFlagEntrySl_MD."',
																	'Active',
																	'".$entDate."',
																	'".$entTime."',
																	'".$userId."'
																)
								";
			$insertQueryEntrySl_MDStatement = mysql_query($insertQueryEntrySl_MD);
			
								
					$k = 0;	
					for($i = 1; $i < $TOTAL_PRODUCT_LIST; $i++ ){
						
						$Prodflag_Medicin		= mysql_fetch_array(mysql_query("SELECT MAX(PRODFLAG) FROM feed_rawmatstock WHERE PRODUCTID = '".$PRODUCTID_MD[$k]."'"));
						$MaxProdFlag_Medicin	= $Prodflag_Medicin['MAX(PRODFLAG)'];
						
						$TOTQNTY_Query			= mysql_fetch_array(mysql_query("SELECT * FROM feed_rawmatstock WHERE PRODUCTID = '".$PRODUCTID_MD[$k]."' AND PRODFLAG = '".$MaxProdFlag_Medicin."'"));
						$TOTQNTY_Medicin		= $TOTQNTY_Query['TOTQNTY'];
						$AVGPRICE_Medicin		= $TOTQNTY_Query['AVGPRICE'];
						$UNITPRICE_Medicin		= $TOTQNTY_Query['UNITPRICE'];
						$TOTALPRICE				= $AVGPRICE_Medicin * $QUANTITY_MD[$k] ;
						
						$queryCheckProdName = mysql_fetch_array(mysql_query("SELECT	* FROM fna_product WHERE PRODUCTID = '".$PRODUCTID_MD[$k]."'"));
						$ProdName = $queryCheckProdName['PRODUCTNAME'];
						
						if($TOTQNTY_Medicin >= $QUANTITY_MD[$k]){
							
							$Batchflag_query	= mysql_fetch_array(mysql_query("SELECT MAX(BATCHFLAG) FROM pal_medicine WHERE BATCHNO = '".$BATCHNO_MD[$k]."'"));
							$MaxBatchFlag_md	= $Batchflag_query['MAX(BATCHFLAG)'];
							$NowMaxBatchFlag_md	= $Batchflag_query['MAX(BATCHFLAG)'] + 1;
							
							
							$insertQuery_md		= "
														INSERT INTO 
																	pal_medicine
																				(
																					ENTRYSERIALNOID,
																					PARTYID,
																					PROJECTID,
																					SUBPROJECTID,
																					BATCHNO,
																					PRODUCTID,
																					QUANTITY,
																					PRICE,
																					TOTALPRICE,
																					BATCHFLAG,
																					MDDATE,
																					STATUS,
																					ENTDATE,
																					ENTTIME,
																					USERID
																				) 
																		VALUES
																				(
																					'".$MaxEntrySlNo_MD."',
																					'5',
																					'3',
																					'8',
																					'".$BATCHNO_MD[$k]."',
																					'".$PRODUCTID_MD[$k]."',
																					'".$QUANTITY_MD[$k]."',
																					'".$AVGPRICE_Medicin."',
																					'".$TOTALPRICE."',
																					'".$NowMaxBatchFlag_md."',
																					'".$MDDATE."',
																					'Active',
																					'".$entDate."',
																					'".$entTime."',
																					'".$userId."'
																				)
												"; 
							$insertQuery_mdStatement = mysql_query($insertQuery_md);
							if($insertQuery_mdStatement){
								
								//Update Raw Materials stock Table Start
								
								$MAXFLAG_Raw			= mysql_fetch_array(mysql_query("SELECT MAX(PRODFLAG) FROM feed_rawmatstock WHERE PRODUCTID = '".$PRODUCTID_MD[$k]."'"));
								$MAXPROD_FLAG_Raw		= $MAXFLAG_Raw['MAX(PRODFLAG)'];
								$Now_MAXPROD_FLAG_Raw	= $MAXFLAG_Raw['MAX(PRODFLAG)'] + 1;
								
								$rawMatStkQry			= mysql_fetch_array(mysql_query("SELECT * FROM feed_rawmatstock WHERE PRODUCTID = '".$PRODUCTID_MD[$k]."' AND PRODFLAG = '".$MAXPROD_FLAG_Raw."'"));
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
								
								$Now_TOTQNTY			= $TOTQNTY_RawStk - $QUANTITY_MD[$k] ; 
								$Now_TOTAMOUNT			= $TOTAMOUNT_RawStk - $TOTALPRICE ; 
								$Now_PARTYFLAG			= $PARTYFLAG_RawStk + 1;
								
								//$Global_ProductionCost 	= $Global_ProductionCost + $ProductionCost ;
								//$prodAvgPrice			= $ProductionCost / $CalculatedQnty ;
								
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
																								'".$MaxEntrySlNo_MD."',
																								'".$PRMID_RawStk."',
																								'".$PROJECTID_RawStk."',
																								'".$SUBPROJECTID_RawStk."',
																								'".$PARTYID_RawStk."',
																								'".$PRODCATTYPEID_RawStk."',
																								'".$PRODUCTID_MD[$k]."',
																								'".$QUANTITY_MD[$k]."',
																								'".$Now_TOTQNTY."',
																								'".$TOTALPRICE."',
																								'".$Now_TOTAMOUNT."',
																								'".$UNITPRICE_RawStk."',
																								'".$AVGPRICE_RawStk."',
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
									//Update Party Bill Table Start
										$PartyFlagQuery				= mysql_fetch_array(mysql_query("SELECT MAX(PARTYFLAG) FROM fna_partybill WHERE PARTYID = '5' AND PURSELLFLAG = 'Purchase'"));
										$MaxPartyFlag				= $PartyFlagQuery['MAX(PARTYFLAG)'];
										$NowMaxPartyFlag			= $PartyFlagQuery['MAX(PARTYFLAG)'] + 1;
										
										$PartyBalanceQuery			= mysql_fetch_array(mysql_query("SELECT BALANCEAMOUNT FROM fna_partybill WHERE PARTYID = '5' AND PARTYFLAG = '".$MaxPartyFlag."' AND PURSELLFLAG = 'Purchase'"));
										$PartyBalanceAmount			= $PartyBalanceQuery['BALANCEAMOUNT'];
										$NowPartyBalanceAmount		= $PartyBalanceAmount - $TOTALPRICE ; 
										
										$insertPartyQuery 			= "
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
																										'".$MaxEntrySlNo_MD."',
																										'5',
																										'3',
																										'8',
																										'".$TOTALPRICE."',
																										'".$TOTALPRICE."',
																										'0',
																										'".$PartyBalanceAmount."',
																										'".$MDDATE."',
																										'".$NowMaxPartyFlag."',
																										'Buy',
																										'Purchase',
																										'".$entDate."',
																										'".$entTime."',
																										'".$userId."'
																									)
																								"; 
										$insertPartyQueryStatement = mysql_query($insertPartyQuery);
										
										//--------------------------------Update Daily Income Expanse Table Start----------------------------------------
										$INEX_FLAG	 			= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_daily_income_expanse"));
										$MAXINEX_FLAG	 		= $INEX_FLAG['MAX(FLAG)'];
										$NOW_MAXINEX_FLAG	 	= $MAXINEX_FLAG + 1;
										
										$MEDNAME_QRY 			= mysql_fetch_array(mysql_query("SELECT PRODUCTNAME FROM fna_product where PRODUCTID = '".$PRODUCTID_MD[$k]."'"));
										$MEDICINE_NAME			= $MEDNAME_QRY['PRODUCTNAME'];
										
										$DESCRIPTION_NOW		= 'Payment to Medicine. Batch No: '.''.$BATCHNO_MD[$k].', Medicine Name : '.$MEDICINE_NAME.',  Qnty : '.$QUANTITY_MD[$k].' * '.number_format($AVGPRICE_Medicin,4).'';
										
										$insertDailyInExQuery = "
																INSERT INTO 
																				fna_daily_income_expanse
																											(
																												ENTRYSERIALNOID,
																												PROJECTID,
																												SUBPROJECTID,
																												DATE,
																												INHID,
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
																												'".$MaxEntrySlNo_MD."',
																												'3',
																												'8',
																												'".$MDDATE."',
																												'',
																												'159',
																												'".$TOTALPRICE."',
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
										
										
										$PartyFlagQueryFeed				= mysql_fetch_array(mysql_query("SELECT MAX(PARTYFLAG) FROM fna_partybill WHERE PARTYID = '6' AND PURSELLFLAG = 'Sell'"));
										$MaxPartyFlagFeed				= $PartyFlagQueryFeed['MAX(PARTYFLAG)'];
										$NowMaxPartyFlagFeed			= $PartyFlagQueryFeed['MAX(PARTYFLAG)'] + 1;
										
										$PartyBalanceQueryFeed			= mysql_fetch_array(mysql_query("SELECT BALANCEAMOUNT FROM fna_partybill WHERE PARTYID = '6' AND PARTYFLAG = '".$MaxPartyFlagFeed."' AND PURSELLFLAG = 'Sell'"));
										$PartyBalanceAmountFeed			= $PartyBalanceQueryFeed['BALANCEAMOUNT'];
										$NowPartyBalanceAmountFeed		= $PartyBalanceAmountFeed + $TOTALPRICE ; 
										
										$insertPartyQueryFeed 			= "
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
																										'".$MaxEntrySlNo_MD."',
																										'6',
																										'5',
																										'7',
																										'".$TOTALPRICE."',
																										'0',
																										'".$TOTALPRICE."',
																										'".$PartyBalanceAmountFeed."',
																										'".$MDDATE."',
																										'".$NowMaxPartyFlagFeed."',
																										'Sell',
																										'Sell',
																										'".$entDate."',
																										'".$entTime."',
																										'".$userId."'
																									)
																								"; 
										$insertPartyQueryFeedStatement = mysql_query($insertPartyQueryFeed);
										//Update Party Bill Table End
										
										//-----------------------------Update Daily Income Expanse Table Start-----------------------------
										$INEX_FLAG	 			= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_daily_income_expanse"));
										$MAXINEX_FLAG	 		= $INEX_FLAG['MAX(FLAG)'];
										$NOW_MAXINEX_FLAG	 	= $MAXINEX_FLAG + 1;
										
										$PARTYNAME_QRY 			= mysql_fetch_array(mysql_query("SELECT PARTYNAME FROM fna_party WHERE PARTYID = '".$PARTYID_RawStk."'"));
										$PARTYNAME				= $PARTYNAME_QRY['PARTYNAME'];
										$NOW_DESCRIPTION		= 'Payment Receive from Poultry Firm. Batch No: '.''.$BATCHNO_MD[$k].', Medicine Name : '.$MEDICINE_NAME.',  Qnty : '.$QUANTITY_MD[$k].' * '.number_format($AVGPRICE_Medicin,4).'';
										
										$insertDailyInExQuery = "
																INSERT INTO 
																				fna_daily_income_expanse
																											(
																												ENTRYSERIALNOID,
																												PROJECTID,
																												SUBPROJECTID,
																												DATE,
																												INHID,
																												EXPHID,
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
																												'".$MaxEntrySlNo_MD."',
																												'".$PROJECTID_RawStk."',
																												'".$SUBPROJECTID_RawStk."',
																												'".$MDDATE."',
																												'18',
																												'',
																												'".$TOTALPRICE."',
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
									$msg = "<span class='validMsg'>This Information (Stock)  added sucessfully</span>";
								}else{
									$msg = "<span class='errorMsg'>Sorry! System Error ( Raw Materials Stock)!</span>";
								}
								//Update Raw Materials stock Table End
								$msg = "<span class='validMsg'>This Batch No. [ $BATCHNO_MD[$k] ] added sucessfully</span>";
							} else {
								$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
							}
						}else{
							$msg = "<span class='errorMsg'>Sorry,  Food Quantoty  [$ProdName :  $TOTQNTY_Medicin] is Lower then  Total Stock Quantity.....Please Check....!</span>";
						}
						
						$k++;
						}
					
							
			
			return $msg;
		}
		// Insert  Medicine Distribution  End
		
		// Insert Others Income start 
		function InsertOthersIncomeInfo($userId){
			$BATCHNO_OTHERSINCOME			= addslashes($_REQUEST["BATCHNO_OTHERSINCOME"]);
			$POINID							= addslashes($_REQUEST["POINID"]);
			$INCOMEAMOUNT					= addslashes($_REQUEST["INCOMEAMOUNT"]);
			$PARTYID_OTHERSINCOME			= addslashes($_REQUEST["PARTYID_OTHERSINCOME"]);
			$REMARKS_OIN					= addslashes($_REQUEST["REMARKS"]);
			$INVOICENO						= addslashes($_REQUEST["INVOICENO"]);
			
			$ENTRYDATE_OIN		= insertDateMySQlFormat($_REQUEST["ENTRYDATE_OIN"]);
			
			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
			
					
					$Query		= "
									SELECT 	BATCHNO,
											PARTYID,
											INCOMEAMOUNT,
											ENTRYDATE
									FROM 
											pal_others_income_expanse
									WHERE BATCHNO 	= '".$BATCHNO_OTHERSINCOME."'
									AND PARTYID 	= '".$PARTYID_OTHERSINCOME."'
									AND INCOMEAMOUNT = '".$INCOMEAMOUNT."'
									AND ENTRYDATE	= '".$ENTRYDATE_OIN."'
								";
					$QueryStatement	= mysql_query($Query);
					if(mysql_num_rows($QueryStatement)>0) {
						$msg = "<span class='errorMsg'>Sorry,  Today's This Batch No. Data [ $BATCHNO_OTHERSINCOME ] already Inserted!</span>";
					} else {
						
							
							$insertQuery_OIn	= "
													INSERT INTO 
															pal_others_income_expanse
																				(
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
																					'".$POINID."',
																					'".$BATCHNO_OTHERSINCOME."',
																					'".$PARTYID_OTHERSINCOME."',
																					'".$INCOMEAMOUNT."',
																					'".$INVOICENO."',
																					'".$REMARKS_OIN."',
																					'".$ENTRYDATE_OIN."',
																					'Active',
																					'".$entDate."',
																					'".$entTime."',
																					'".$userId."'
																				)
												"; 
							$insertQuery_OInStatement = mysql_query($insertQuery_OIn);
							if($insertQuery_OInStatement){
								
								//Update Party Bill Table Start
										$PartyFlagQuery				= mysql_fetch_array(mysql_query("SELECT MAX(PARTYFLAG) FROM fna_partybill WHERE PARTYID = '".$PARTYID_OTHERSINCOME."' AND PURSELLFLAG = 'Sell'"));
										$MaxPartyFlag				= $PartyFlagQuery['MAX(PARTYFLAG)'];
										$NowMaxPartyFlag			= $PartyFlagQuery['MAX(PARTYFLAG)'] + 1;
										
										$PartyBalanceQuery			= mysql_fetch_array(mysql_query("SELECT BALANCEAMOUNT FROM fna_partybill WHERE PARTYID = '".$PARTYID_OTHERSINCOME."' AND PARTYFLAG = '".$MaxPartyFlag."' AND PURSELLFLAG = 'Sell'"));
										$PartyBalanceAmount			= $PartyBalanceQuery['BALANCEAMOUNT'];
										$NowPartyBalanceAmount		= $PartyBalanceAmount + $INCOMEAMOUNT ; 
										
										$insertPartyQuery 			= "
																		INSERT INTO 
																					fna_partybill
																									(
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
																										'".$PARTYID_OTHERSINCOME."',
																										'3',
																										'8',
																										'".$BATCHNO_OTHERSINCOME."',
																										'".$INCOMEAMOUNT."',
																										'0',
																										'0',
																										'".$NowPartyBalanceAmount."',
																										'".$ENTRYDATE_OIN."',
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
									
									$NOW_BALANCE_IN_AMOUNT		= $BALANCE_IN_AMOUNT + $INCOMEAMOUNT ;
									
									$insertBalanceInQuery = "
															INSERT INTO 
																		fna_balance
																				(
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
																					'3',
																					'8',
																					'".$INCOMEAMOUNT."',
																					'".$NOW_BALANCE_IN_AMOUNT."',
																					'".$NOW_MAXBALANCE_IN_FLAG."',
																					'".$ENTRYDATE_OIN."',
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
										
										$insertDailyInQuery = "
																INSERT INTO 
																				fna_daily_income_expanse
																											(
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
																												'3',
																												'8',
																												'".$ENTRYDATE_OIN."',
																												'".$INCOMEAMOUNT."',
																												'".$REMARKS_OIN."',
																												'".$NOW_MAXINEX_FLAG."',
																												'Active',
																												'".$entDate."',
																												'".$entTime."',
																												'".$userId."'
																											)
																	";
												
												
												$insertDailyInQueryStatement = mysql_query($insertDailyInQuery);
							
							//----------------------------------------------------Update Daily Income Expanse Table End ------------------------------------------------
									$msg = "<span class='validMsg'>This Batch No Information ($BATCHNO_OTHERSINCOME)  added sucessfully</span>";
								
							} else {
								$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
							}
						
					}
				
			
			
			return $msg;
		}
		// Insert  Others Income  End
		
		// Insert Others Expanse start 
		function InsertOthersExpanseInfo($userId){
			$BATCHNO_OTHERSEXP				= addslashes($_REQUEST["BATCHNO_OTHERSEXP"]);
			$POEXID							= addslashes($_REQUEST["POEXID"]);
			$EXPANSEAMOUNT					= addslashes($_REQUEST["EXPANSEAMOUNT"]);
			$PARTYID_OTHERSEXP				= addslashes($_REQUEST["PARTYID_OTHERSEXP"]);
			$REMARKS_OEXP					= addslashes($_REQUEST["REMARKS_OEXP"]);
			$INVOICENO						= addslashes($_REQUEST["INVOICENO"]);
			
			$ENTRYDATE_OEXP		= insertDateMySQlFormat($_REQUEST["ENTRYDATE_OEXP"]);
			
			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
			
					
					$QueryOExp		= "
									SELECT 	BATCHNO,
											PARTYID,
											EXPANSEAMOUNT,
											ENTRYDATE
									FROM 
											pal_others_income_expanse
									WHERE BATCHNO 	= '".$BATCHNO_OTHERSEXP."'
									AND PARTYID 	= '".$PARTYID_OTHERSEXP."'
									AND EXPANSEAMOUNT = '".$EXPANSEAMOUNT."'
									AND ENTRYDATE	= '".$ENTRYDATE_OEXP."'
								";
					$QueryOExpStatement	= mysql_query($QueryOExp);
					if(mysql_num_rows($QueryOExpStatement)>0) {
						$msg = "<span class='errorMsg'>Sorry,  Today's This Batch No. Data [ $BATCHNO_OTHERSEXP ] already Inserted!</span>";
					} else {
						
							
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
																					'".$POEXID."',
																					'".$BATCHNO_OTHERSEXP."',
																					'".$PARTYID_OTHERSEXP."',
																					'".$EXPANSEAMOUNT."',
																					'".$INVOICENO."',
																					'".$REMARKS_OEXP."',
																					'".$ENTRYDATE_OEXP."',
																					'Active',
																					'".$entDate."',
																					'".$entTime."',
																					'".$userId."'
																				)
												"; 
							$insertQuery_OInStatement = mysql_query($insertQuery_OIn);
							if($insertQuery_OInStatement){
								
							//Update FNA Balance Table Start
									$BALANCE_FLAG 			= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_balance"));
									$MAXBALANCE_FLAG 		= $BALANCE_FLAG['MAX(FLAG)'];
									$NOW_MAXBALANCE_FLAG 	= $MAXBALANCE_FLAG + 1;
									
									$BALANCE_QUERY		 	= mysql_fetch_array(mysql_query("SELECT * FROM fna_balance WHERE FLAG = '".$MAXBALANCE_FLAG."'"));
									$INCOME_AMOUNT 			= $BALANCE_QUERY['INCOME'];
									$EXPANSE_AMOUNT			= $BALANCE_QUERY['EXPANSE'];
									$BALANCE_AMOUNT 		= $BALANCE_QUERY['BALANCE'];
									
									$NOW_BALANCE_AMOUNT		= $BALANCE_AMOUNT - $EXPANSEAMOUNT ;
									
									$insertBalanceQuery = "
															INSERT INTO 
																		fna_balance
																				(
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
																					'3',
																					'8',
																					'".$EXPANSEAMOUNT."',
																					'".$NOW_BALANCE_AMOUNT."',
																					'".$NOW_MAXBALANCE_FLAG."',
																					'".$ENTRYDATE_OEXP."',
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
										
										$insertDailyInExQuery = "
																INSERT INTO 
																				fna_daily_income_expanse
																											(
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
																												'3',
																												'8',
																												'".$ENTRYDATE_OEXP."',
																												'".$EXPANSEAMOUNT."',
																												'".$REMARKS_OEXP."',
																												'".$NOW_MAXINEX_FLAG."',
																												'Active',
																												'".$entDate."',
																												'".$entTime."',
																												'".$userId."'
																											)
																	";
												
												
												$insertDailyInExQueryStatement = mysql_query($insertDailyInExQuery);
							
							//----------------------------------------------------Update Daily Income Expanse Table End ------------------------------------------------
							
								if($insertBalanceQueryStatement){
									$msg = "<span class='validMsg'>This Voucher Number  added sucessfully</span>";
								} else {
									$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
								}
								
							} else {
								$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
							}
						
					}
				
			
			
			return $msg;
		}
		// Insert  Others Expanse  End
		
		// Insert Egg Production start 
		function insertEggProdInfo($userId){
			$BATCHNO_EP			= $_REQUEST["BATCHNOEP"];
			$MURGIQNTY			= $_REQUEST["MURGIQNTYEP"];
			$EGGQNTY			= $_REQUEST["EGGQNTYEP"];
			$EGGPERCENTAGE		= $_REQUEST["EGGPERCENTAGEEP"];
			
			$EPDATE				= insertDateMySQlFormat($_REQUEST["EPDATE"]);
			$TOTAL_PRODUCT_LIST	= $_REQUEST["TOTAL_PRODUCT_LIST_EP"];
			
			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
			
			
			$EntrySerial_Query_Flag_EP 			= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_entryserialno"));
			$MaxFlagEntrySl_EP					= $EntrySerial_Query_Flag_EP['MAX(FLAG)'];
			
			$EntrySerial_Query_No_EP			= mysql_fetch_array(mysql_query("SELECT MAX(ENTRYSERIALNOID) FROM fna_entryserialno"));
			$MaxEntrySlNo_EP					= $EntrySerial_Query_No_EP['MAX(ENTRYSERIALNOID)'] + 1;
	
	
			$insertQueryEntrySl_EP = "
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
																	'".$MaxEntrySlNo_EP."',
																	'".$PROJECTID."',
																	'".$SUBPROJECTID."',
																	'".$ENTRYDATE."',
																	'".$MaxFlagEntrySl_EP."',
																	'Active',
																	'".$entDate."',
																	'".$entTime."',
																	'".$userId."'
																)
								";
			$insertQueryEntrySl_EPStatement = mysql_query($insertQueryEntrySl_EP);
						
						$k = 0;	
						for($i = 1; $i < $TOTAL_PRODUCT_LIST; $i++ ){
						
						if($MURGIQNTY[$k] > $EGGQNTY[$k]){
						
						$Batchflag_EP			= mysql_fetch_array(mysql_query("SELECT MAX(BATCHFLAG) FROM pal_egg_production WHERE BATCHNO = '".$BATCHNO_EP[$k]."'"));
						$MaxBatchFlag_EP		= $Batchflag_EP['MAX(BATCHFLAG)'];
						$NowMaxBatchFlag_EP		= $Batchflag_EP['MAX(BATCHFLAG)'] + 1;
						
						$EggProd_Query			= mysql_fetch_array(mysql_query("SELECT * FROM pal_egg_production WHERE BATCHNO = '".$BATCHNO_EP[$k]."' AND BATCHFLAG = '".$MaxBatchFlag_EP."'"));
						$EGGTOTQNTY				= $EggProd_Query['EGGTOTQNTY'];
						$NowEGGTOTQNTY			= $EGGTOTQNTY + $EGGQNTY[$k] ;
						
							$insertQuery_ep		= "
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
																					'".$MaxEntrySlNo_EP."',
																					'3',
																					'8',
																					'".$BATCHNO_EP[$k]."',
																					'".$MURGIQNTY[$k]."',
																					'".$EGGQNTY[$k]."',
																					'".$NowEGGTOTQNTY."',
																					'".$EGGPERCENTAGE[$k]."',
																					'".$EPDATE."',
																					'".$NowMaxBatchFlag_EP."',
																					'Active',
																					'".$entDate."',
																					'".$entTime."',
																					'".$userId."'
																				)
												"; 
							$insertQuery_epStatement = mysql_query($insertQuery_ep);
							if($insertQuery_epStatement){
								$msg = "<span class='validMsg'>This Batch No. [ $BATCHNO_EP[$k]] added sucessfully</span>";
							}else{
								$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
							}
							
						
						
					
						}else{
							$msg = "<span class='errorMsg'>Egg Quantity is not Greater then Murgi Quantity..... </span>";
						}
					$k++;
					}
			
			return $msg;
		}
		// Insert  Egg Production  End
		
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
		
}
?>