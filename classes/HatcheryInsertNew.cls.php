<?php
	class HatcheryInsertNew Extends BaseClass {
		function HatcheryInsertNew() {
			$this->con=$this->BaseClass();
		}		
			
		// Insert Opening Batch start 
		function insertOpenHatchEggInfo($userId){
			$TOTEGGQNTY_STOCK	= addslashes($_REQUEST["TOTEGGQNTY"]);
			$EGGQUANTITY_CANCEL	= addslashes($_REQUEST["EGGQUANTITY"]);
			$VANGAEGGQNTY_ENTRY	= addslashes($_REQUEST["VANGAEGGQNTY"]);
			$OPENDATE_New		= insertDateMySQlFormat($_REQUEST["OPENDATE"]);
			
			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
			$Query		= "
									SELECT 
											EGGQUANTITY,
											OPENDATE 
									FROM 
											hatch_opening_hatching_egg
									WHERE EGGQUANTITY = '".$EGGQUANTITY_CANCEL."'
									AND OPENDATE = '".$OPENDATE_New."'
								  ";
			$QueryStatement	= mysql_query($Query);
			if(mysql_num_rows($QueryStatement)>0) {
				$msg = "<span class='errorMsg'>Sorry, Today's This Cancel Egg Quantity [ $EGGQUANTITY_CANCEL ] already exist!</span>";
			} else {
				
				$EntrySerial_Query_Flag_Hatch 		= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_entryserialno"));
				$MaxFlagEntrySl_Hatch				= $EntrySerial_Query_Flag_Hatch['MAX(FLAG)'];
				
				$EntrySerial_Query_No_Hatch		= mysql_fetch_array(mysql_query("SELECT MAX(ENTRYSERIALNOID) FROM fna_entryserialno"));
				$MaxEntrySlNo_Hatch				= $EntrySerial_Query_No_Hatch['MAX(ENTRYSERIALNOID)'] + 1;
		
		
				$insertQueryEntrySl_Hatch = "
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
																		'".$MaxEntrySlNo_Hatch."',
																		'".$PROJECTID."',
																		'".$SUBPROJECTID."',
																		'".$CPDATE_CS."',
																		'".$MaxFlagEntrySl_Hatch."',
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									";
				$insertQueryEntrySl_HatchStatement = mysql_query($insertQueryEntrySl_Hatch);
				
				if($TOTEGGQNTY_STOCK >= $EGGQUANTITY_CANCEL){
					
				
					$OHEFLAG_QUERY		= mysql_fetch_array(mysql_query("SELECT MAX(OHEFLAG) FROM hatch_opening_hatching_egg "));
					$MaxOHEFLAG			= $OHEFLAG_QUERY['MAX(OHEFLAG)'];
					$NowMaxOHEFLAG		= $OHEFLAG_QUERY['MAX(OHEFLAG)'] + 1;
					
					$OpenHatchQuery		= mysql_fetch_array(mysql_query("SELECT * FROM hatch_opening_hatching_egg WHERE OHEFLAG = '".$MaxOHEFLAG."'"));
					$TOTEGGQNTY			= $OpenHatchQuery['TOTEGGQNTY'];
					$TOTPRICE_EGG		= $OpenHatchQuery['TOTPRICE'];
					$AVGRATEPEREGG		= $OpenHatchQuery['AVGRATEPEREGG'];
					$ESID				= $OpenHatchQuery['ESID'];
					$PROJECTID			= $OpenHatchQuery['PROJECTID'];
					$SUBPROJECTID		= $OpenHatchQuery['SUBPROJECTID'];
					$BATCHNO			= $OpenHatchQuery['BATCHNO'];
					$OPENDATE			= $OpenHatchQuery['OPENDATE'];
					$EGGQUANTITY		= $OpenHatchQuery['EGGQUANTITY'];
					
					$VANGAEGGQNTY		= $OpenHatchQuery['VANGAEGGQNTY'];
					$TOTVANGAEGGQNTY	= $OpenHatchQuery['TOTVANGAEGGQNTY'];
					
					$TOTEGGQNTY			= $OpenHatchQuery['TOTEGGQNTY'];
					$PRICE				= $OpenHatchQuery['PRICE'];
					$TOTPRICE			= $OpenHatchQuery['TOTPRICE'];
					$RATE				= $OpenHatchQuery['RATE'];
					$AVGRATEPEREGG		= $OpenHatchQuery['AVGRATEPEREGG'];
					
					$Now_TOTEGGQNTY		= $TOTEGGQNTY - ($EGGQUANTITY_CANCEL + $VANGAEGGQNTY_ENTRY) ; 
					$NowAVGRATEPEREGG	= $TOTPRICE_EGG / $Now_TOTEGGQNTY ; 
					$Now_TOTVANGAEGGQNTY	= $TOTVANGAEGGQNTY + $VANGAEGGQNTY_ENTRY ; 
					
					$insertOpenHatchEggQuery = "
													INSERT INTO 
																hatch_opening_hatching_egg
																				(
																					ENTRYSERIALNOID,
																					ESID,
																					PROJECTID,
																					SUBPROJECTID,
																					BATCHNO,
																					OPENDATE,
																					EGGQUANTITY,
																					VANGAEGGQNTY,
																					TOTVANGAEGGQNTY,
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
																					'".$MaxEntrySlNo_Hatch."',
																					'".$ESID."',
																					'".$PROJECTID."',
																					'".$SUBPROJECTID."',
																					'".$BATCHNO."',
																					'".$OPENDATE_New."',
																					'".$EGGQUANTITY_CANCEL."',
																					'".$VANGAEGGQNTY_ENTRY."',
																					'".$Now_TOTVANGAEGGQNTY."',
																					'".$Now_TOTEGGQNTY."',
																					'".$PRICE."',
																					'".$TOTPRICE."',
																					'".$RATE."',
																					'".$NowAVGRATEPEREGG."',
																					'".$NowMaxOHEFLAG."',
																					'Cancel',
																					'".$entDate."',
																					'".$entTime."',
																					'".$userId."'
																				)
																			"; 
					$insertOpenHatchEggQueryStatement = mysql_query($insertOpenHatchEggQuery);
					if($insertOpenHatchEggQueryStatement){
						$msg = "<span class='validMsg'>This Egg Cancel Quantity. [ $EGGQUANTITY_CANCEL ] added sucessfully</span>";
					} else {
						$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
					}
				}else{
					$msg = "<span class='errorMsg'>Sorry! Stock Quantity is not Lower Then Cancel Quantity!</span>";
				}
			}
			return $msg;
			
			
			
			
		}
		// Insert Opening Batch End
		
		// Insert Opening Batch start 
		function insertEggSettingInfo($userId){
			$HATCHNO_ES			= addslashes($_REQUEST["HATCHNO_ES"]);
			$EGGQNTY			= addslashes($_REQUEST["EGGQNTY"]);
			$EGGPRICE			= addslashes($_REQUEST["EGGPRICE"]);
			$ESIMDATE			= insertDateMySQlFormat($_REQUEST["ESIMDATE"]);
			
			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
			$Query		= "
									SELECT 
											HATCHNO,
											EGGQNTY,
											EGGPRICE,
											ESIMDATE 
									FROM 
											hatch_egg_settings_machine
									WHERE HATCHNO = '".$HATCHNO_ES."'
									AND EGGQNTY = '".$EGGQNTY."'
									AND EGGPRICE = '".$EGGPRICE."'
									AND ESIMDATE = '".$ESIMDATE."'
								  ";
			$QueryStatement	= mysql_query($Query);
			if(mysql_num_rows($QueryStatement)>0) {
				$msg = "<span class='errorMsg'>Sorry, Today's This Hatch No Egg Quantity [ $HATCHNO ] already exist!</span>";
			} else {
				
				$EntrySerial_Query_Flag_Egg 		= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_entryserialno"));
				$MaxFlagEntrySl_Egg					= $EntrySerial_Query_Flag_Egg['MAX(FLAG)'];
				
				$EntrySerial_Query_No_Egg		= mysql_fetch_array(mysql_query("SELECT MAX(ENTRYSERIALNOID) FROM fna_entryserialno"));
				$MaxEntrySlNo_Egg				= $EntrySerial_Query_No_Egg['MAX(ENTRYSERIALNOID)'] + 1;
		
		
				$insertQueryEntrySl_Egg = "
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
																		'".$MaxEntrySlNo_Egg."',
																		'".$PROJECTID."',
																		'".$SUBPROJECTID."',
																		'".$CPDATE_CS."',
																		'".$MaxFlagEntrySl_Egg."',
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									";
				$insertQueryEntrySl_EggStatement = mysql_query($insertQueryEntrySl_Egg);
				
				$OHEFLAG_QUERY_FIRST		= mysql_fetch_array(mysql_query("SELECT MAX(OHEFLAG) FROM hatch_opening_hatching_egg "));
				$MaxOHEFLAG_FIRST			= $OHEFLAG_QUERY_FIRST['MAX(OHEFLAG)'];
				$NowMaxOHEFLAG_FIRST		= $OHEFLAG_QUERY_FIRST['MAX(OHEFLAG)'] + 1;
				
							
				$OpenHatchQuery_FIRST		= mysql_fetch_array(mysql_query("SELECT * FROM hatch_opening_hatching_egg WHERE OHEFLAG = '".$MaxOHEFLAG_FIRST."'"));
				$TOTEGGQNTY_FIRST			= $OpenHatchQuery_FIRST['TOTEGGQNTY'];
				$PARTYID_FIRST				= $OpenHatchQuery_FIRST['PARTYID'];
				$OHEID						= $OpenHatchQuery_FIRST['OHEID'];
				$ESID_FIRST					= $OpenHatchQuery_FIRST['ESID'];
				$PROJECTID_FIRST			= $OpenHatchQuery_FIRST['PROJECTID'];
				$SUBPROJECTID_FIRST			= $OpenHatchQuery_FIRST['SUBPROJECTID'];
				$BATCHNO_FIRST				= $OpenHatchQuery_FIRST['BATCHNO'];
				$EGGQUANTITY_FIRST			= $OpenHatchQuery_FIRST['EGGQUANTITY'];
				$PRICE_FIRST				= $OpenHatchQuery_FIRST['PRICE'];
				$TOTPRICE_FIRST				= $OpenHatchQuery_FIRST['TOTPRICE'];
				$RATE_FIRST					= $OpenHatchQuery_FIRST['RATE'];
				$AVGRATEPEREGG_FIRST		= $OpenHatchQuery_FIRST['AVGRATEPEREGG'];
				
				$Now_TOTEGGQNTY 			= $TOTEGGQNTY_FIRST - $EGGQNTY ; 
				
				if($TOTEGGQNTY_FIRST >= $EGGQNTY){
					
				
					$EggSett_QUERY		= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM hatch_egg_settings_machine "));
					$MaxFLAG			= $EggSett_QUERY['MAX(FLAG)'];
					$NowMaxFLAG			= $EggSett_QUERY['MAX(FLAG)'] + 1;
					
					$hatch_QUERY				= mysql_fetch_array(mysql_query("SELECT MAX(HATCHFLAG) FROM hatch_egg_settings_machine WHERE HATCHNO = '".$HATCHNO_ES."'"));
					$Max_HATCHFLAG				= $hatch_QUERY['MAX(HATCHFLAG)'];
					$NowMax_HATCHFLAG			= $hatch_QUERY['MAX(HATCHFLAG)'] + 1;
				
					$SettinMachinQuery			= mysql_fetch_array(mysql_query("SELECT * FROM hatch_egg_settings_machine WHERE FLAG = '".$MaxFLAG."'"));
					$EGGQNTY_SETTINGS			= $SettinMachinQuery['EGGQNTY'];
					$TOTALEGGQNTY_SETTINGS		= $SettinMachinQuery['TOTALEGGQNTY'];
					$EGGTOTPRICE				= $SettinMachinQuery['EGGTOTPRICE'];
					
					$Now_EGGTOTPRICE			= $EGGTOTPRICE + $EGGPRICE ; 
					$NOWTOTALEGHGQNTY			= $TOTALEGGQNTY_SETTINGS + $EGGQNTY ; 
					
					$insertEggSettingQuery = "
												INSERT INTO 
															hatch_egg_settings_machine
																				(
																					ENTRYSERIALNOID,
																					OHEID,
																					HATCHNO,
																					PROJECTID,
																					SUBPROJECTID,
																					EGGQNTY,
																					TOTALEGGQNTY,
																					EGGPRICE,
																					EGGTOTPRICE,
																					HATCHFLAG,
																					ESIMDATE,
																					FLAG,
																					STATUS,
																					ENTDATE,
																					ENTTIME,
																					USERID
																				) 
																			VALUES
																				(
																					'".$MaxEntrySlNo_Egg."',
																					'".$OHEID."',
																					'".$HATCHNO_ES."',
																					'4',
																					'9',
																					'".$EGGQNTY."',
																					'".$NOWTOTALEGHGQNTY."',
																					'".$EGGPRICE."',
																					'".$Now_EGGTOTPRICE."',
																					'".$NowMax_HATCHFLAG."',
																					'".$ESIMDATE."',
																					'".$NowMaxFLAG."',
																					'In',
																					'".$entDate."',
																					'".$entTime."',
																					'".$userId."'
																				)
																			"; 
						$insertEggSettingQueryStatement = mysql_query($insertEggSettingQuery);
						if($insertEggSettingQueryStatement){
						
						//Update Opening Hatching Table Start
						
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
																					'".$MaxEntrySlNo_Egg."',
																					'".$ESID_FIRST."',
																				
																					'".$PARTYID_FIRST."',
																					'".$PROJECTID_FIRST."',
																					'".$SUBPROJECTID_FIRST."',
																					'".$BATCHNO_FIRST."',
																					'".$ESIMDATE."',
																					'".$EGGQNTY."',
																					'".$Now_TOTEGGQNTY."',
																					'".$PRICE_FIRST."',
																					'".$TOTPRICE_FIRST."',
																					'".$RATE_FIRST."',
																					'".$AVGRATEPEREGG_FIRST."',
																					'".$NowMaxOHEFLAG_FIRST."',
																					'Out',
																					'".$entDate."',
																					'".$entTime."',
																					'".$userId."'
																				)
																			"; 
							$insertOpenHatchEggQueryStatement = mysql_query($insertOpenHatchEggQuery);
							
							//Update Opening Hatching Table End
						
						$msg = "<span class='validMsg'>This Egg Cancel Quantity. [ $EGGQNTY ] added sucessfully</span>";
					} else {
						$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
					}
				}else{
					$msg = "<span class='errorMsg'>Sorry! Stock Quantity is not Lower Then Egg Setting in Machine Quantity!</span>";
				}
			}
			return $msg;
			
			
			
			
		}
		// Insert Opening Batch End
		
		// Insert Chicken Production start 
		function insertChickProdInfo($userId){
			
			$HATCHNO_CP			= addslashes($_REQUEST["HATCHNO"]);
			$EGGSETTQUANTITY	= addslashes($_REQUEST["EGGSETTQUANTITY"]);
			$PROD_QUANTITY		= addslashes($_REQUEST["QUANTITY"]);
			$PERCENTAGE			= addslashes($_REQUEST["PERCENTAGE"]);
			$CPDATE				= insertDateMySQlFormat($_REQUEST["CPDATE"]);
			
			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
			$Query		= "
									SELECT 
											HATCHNO,
											QUANTITY,
											CPDATE 
									FROM 
											hatch_chicken_production
											
									WHERE HATCHNO = '".$HATCHNO_CP."'
									AND QUANTITY = '".$PROD_QUANTITY."'
									AND CPDATE = '".$CPDATE."'
								  ";
			$QueryStatement	= mysql_query($Query);
			if(mysql_num_rows($QueryStatement)>0) {
				$msg = "<span class='errorMsg'>Sorry, Today's This Hatch No Quantity [ $HATCHNO_CP ] already exist!</span>";
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
																		'".$CPDATE."',
																		'".$MaxFlagEntrySl."',
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									";
				$insertQueryEntrySlStatement = mysql_query($insertQueryEntrySl);
				
				if($EGGSETTQUANTITY >= $PROD_QUANTITY){
					
					$FLAG_QUERY			= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM hatch_egg_settings_machine "));
					$ESIM_FLAG			= $FLAG_QUERY['MAX(FLAG)'];
					
					$EggSett_Query		= mysql_fetch_array(mysql_query("SELECT * FROM hatch_egg_settings_machine WHERE HATCHNO = '".$HATCHNO_CP."' AND FLAG = '".$ESIM_FLAG."'"));
					$ESIMID_ESIM		= $EggSett_Query['ESIMID'];
					$EGGQNTY_ESIM		= $EggSett_Query['EGGQNTY'];
					$EGGPRICE_ESIM		= $EggSett_Query['EGGPRICE'];
					
					$AVG_CHICKPRICE		= $EGGPRICE_ESIM / $PROD_QUANTITY; 
					
					
					$CHICKFLAG_QUERY	= mysql_fetch_array(mysql_query("SELECT MAX(HATCHFLAG) FROM hatch_chicken_production WHERE HATCHNO = '".$HATCHNO_CP."'"));
					$MaxCHICKFLAG		= $CHICKFLAG_QUERY['MAX(HATCHFLAG)'];
					$NowMaxCHICKFLAG	= $CHICKFLAG_QUERY['MAX(HATCHFLAG)'] + 1;
					
					$ChickQuery			= mysql_fetch_array(mysql_query("SELECT * FROM hatch_chicken_production WHERE HATCHNO = '".$HATCHNO_CP."' AND HATCHFLAG = '".$MaxCHICKFLAG."'"));
					$CHICK_TOTQUANTITY	= $ChickQuery['TOTQUANTITY'];
					
					$Now_CHICK_TOTQUANTITY		= $CHICK_TOTQUANTITY + $PROD_QUANTITY ; 
					
					$insertChickProdQuery = "
												INSERT INTO 
															hatch_chicken_production
																				(
																					ENTRYSERIALNOID,
																					ESIMID,
																					PROJECTID,
																					SUBPROJECTID,
																					HATCHNO,
																					QUANTITY,
																					TOTQUANTITY,
																					CHICKPRICEPERPCS,
																					PERCENTAGE,
																					CPDATE,
																					HATCHFLAG,
																					WORKSFLAG,
																					STATUS,
																					ENTDATE,
																					ENTTIME,
																					USERID
																				) 
																			VALUES
																				(
																					'".$MaxEntrySlNo."',
																					'".$ESIMID_ESIM."',
																					'4',
																					'9',
																					'".$HATCHNO_CP."',
																					'".$PROD_QUANTITY."',
																					'".$Now_CHICK_TOTQUANTITY."',
																					'".$AVG_CHICKPRICE."',
																					'".$PERCENTAGE."',
																					'".$CPDATE."',
																					'".$NowMaxCHICKFLAG."',
																					'In',
																					'Active',
																					'".$entDate."',
																					'".$entTime."',
																					'".$userId."'
																				)
																			"; 
					$insertChickProdQueryStatement = mysql_query($insertChickProdQuery);
					if($insertChickProdQueryStatement){
						//Update Egg Settingt Table Start
						$UpdateEggSett				= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM hatch_egg_settings_machine "));
						$UpdateMaxFLAG				= $UpdateEggSett['MAX(FLAG)'];
						$UpdateNowMaxFLAG			= $UpdateEggSett['MAX(FLAG)'] + 1;
						
						$Updatehatch_QUERY			= mysql_fetch_array(mysql_query("SELECT MAX(HATCHFLAG) FROM hatch_egg_settings_machine WHERE HATCHNO = '".$HATCHNO_CP."'"));
						$UpdateMax_HATCHFLAG		= $Updatehatch_QUERY['MAX(HATCHFLAG)'];
						$UpdateNowMax_HATCHFLAG		= $Updatehatch_QUERY['MAX(HATCHFLAG)'] + 1;
					
						$UpdateSettinMachinQuery	= mysql_fetch_array(mysql_query("SELECT * FROM hatch_egg_settings_machine WHERE FLAG = '".$UpdateMaxFLAG."'"));
						$UpdateEGGQNTY_SETTINGS		= $UpdateSettinMachinQuery['EGGQNTY'];
						$UpdateOHEID_SETTINGS		= $UpdateSettinMachinQuery['OHEID'];
						$UpdateTOTALEGGQNTY_SETTINGS= $UpdateSettinMachinQuery['TOTALEGGQNTY'];
						$UpdateEGGTOTPRICE			= $UpdateSettinMachinQuery['EGGTOTPRICE'];
						$UpdatePROJECTID_SETTINGS	= $UpdateSettinMachinQuery['PROJECTID'];
						$UpdateSUBPROJECTID_SETTINGS= $UpdateSettinMachinQuery['SUBPROJECTID'];
						$UpdateEGGPRICE				= $UpdateSettinMachinQuery['EGGPRICE'];
						
						$UpdateNow_EGGTOTPRICE		= $UpdateEGGTOTPRICE - $UpdateEGGPRICE ; 
						$UpdateNOWTOTALEGHGQNTY		= $UpdateTOTALEGGQNTY_SETTINGS - $EGGSETTQUANTITY ; 
						
						$UpdateEggSettingQuery = "
													INSERT INTO 
																hatch_egg_settings_machine
																					(
																						ENTRYSERIALNOID,
																						OHEID,
																						HATCHNO,
																						PROJECTID,
																						SUBPROJECTID,
																						EGGQNTY,
																						TOTALEGGQNTY,
																						EGGPRICE,
																						EGGTOTPRICE,
																						HATCHFLAG,
																						ESIMDATE,
																						FLAG,
																						STATUS,
																						ENTDATE,
																						ENTTIME,
																						USERID
																					) 
																				VALUES
																					(
																						'".$MaxEntrySlNo."',
																						'".$UpdateOHEID_SETTINGS."',
																						'".$HATCHNO_CP."',
																						'".$UpdatePROJECTID_SETTINGS."',
																						'".$UpdateSUBPROJECTID_SETTINGS."',
																						'".$EGGSETTQUANTITY."',
																						'".$UpdateNOWTOTALEGHGQNTY."',
																						'".$UpdateEGGPRICE."',
																						'".$UpdateNow_EGGTOTPRICE."',
																						'".$UpdateNowMax_HATCHFLAG."',
																						'".$CPDATE."',
																						'".$UpdateNowMaxFLAG."',
																						'Out',
																						'".$entDate."',
																						'".$entTime."',
																						'".$userId."'
																					)
																				"; 
							$UpdateEggSettingQueryStatement = mysql_query($UpdateEggSettingQuery);
						//Update Egg Settingt Table End
						
						$msg = "<span class='validMsg'>This Egg Cancel Quantity. [ $HATCHNO_CP ] added sucessfully</span>";
					} else {
						$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
					}
				}else{
					$msg = "<span class='errorMsg'>Sorry! Stock Quantity is not Lower Then Production Quantity!</span>";
				}
			}
			return $msg;
			
			
			
			
		}
		// Insert Chicken Production End
		
		// Insert Chicken Sell start 
		function insertChickSellInfo($userId){
			$HATCHNO_CS			= addslashes($_REQUEST["HATCHNO_CS"]);
			$CHICKENSTOCKQNTY	= addslashes($_REQUEST["CHICKENSTOCKQNTY"]);
			$PARTYID			= addslashes($_REQUEST["PARTYID"]);
			$QUANTITY_CS		= addslashes($_REQUEST["QUANTITY_CS"]);
			$RATE_CSPARTY		= addslashes($_REQUEST["RATE_CS"]);
			$TOTALPRICE_CS		= addslashes($_REQUEST["TOTALPRICE_CS"]);
			$CPDATE_CS			= insertDateMySQlFormat($_REQUEST["CPDATE_CS"]);
			
			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
			$Query		= "
									SELECT 
											HATCHNO,
											PARTYID,
											QUANTITY,
											RATE,
											CPDATE 
									FROM 
											hatch_chicken_production
											
									WHERE HATCHNO = '".$HATCHNO_CS."'
									AND PARTYID = '".$PARTYID."'
									AND QUANTITY = '".$QUANTITY_CS."'
									AND RATE = '".$RATE_CSPARTY."'
									AND CPDATE = '".$CPDATE_CS."'
								  ";
			$QueryStatement	= mysql_query($Query);
			if(mysql_num_rows($QueryStatement)>0) {
				$msg = "<span class='errorMsg'>Sorry, Today's This Hatch No Quantity [ $HATCHNO_CS ] already exist!</span>";
			} else {
				
				$EntrySerial_Query_Flag_CS 		= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_entryserialno"));
				$MaxFlagEntrySl_CS				= $EntrySerial_Query_Flag_CS['MAX(FLAG)'];
				
				$EntrySerial_Query_No_CS		= mysql_fetch_array(mysql_query("SELECT MAX(ENTRYSERIALNOID) FROM fna_entryserialno"));
				$MaxEntrySlNo_CS				= $EntrySerial_Query_No_CS['MAX(ENTRYSERIALNOID)'] + 1;
		
		
				$insertQueryEntrySl_CS = "
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
																		'".$MaxEntrySlNo_CS."',
																		'".$PROJECTID."',
																		'".$SUBPROJECTID."',
																		'".$CPDATE_CS."',
																		'".$MaxFlagEntrySl_CS."',
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									";
				$insertQueryEntrySl_CSStatement = mysql_query($insertQueryEntrySl_CS);
				
				if($CHICKENSTOCKQNTY >= $QUANTITY_CS){
					
					$FLAG_QUERY_CS		= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM hatch_chicken_production "));
					$MAXFLAG_CS			= $FLAG_QUERY_CS['MAX(FLAG)'];
					$NOWMAXFLAG_CS		= $FLAG_QUERY_CS['MAX(FLAG)'] + 1;
					
					
					$HATCHFLAG_QUERY	= mysql_fetch_array(mysql_query("SELECT MAX(HATCHFLAG) FROM hatch_chicken_production WHERE HATCHNO = '".$HATCHNO_CS."'"));
					$MaxHATCHFLAG		= $HATCHFLAG_QUERY['MAX(HATCHFLAG)'];
					$NowMaxHATCHFLAG	= $HATCHFLAG_QUERY['MAX(HATCHFLAG)'] + 1;
					
					$ChickSellQuery		= mysql_fetch_array(mysql_query("SELECT * FROM hatch_chicken_production WHERE HATCHNO = '".$HATCHNO_CS."' AND HATCHFLAG = '".$MaxHATCHFLAG."'"));
					$ESIMID_CS			= $ChickSellQuery['ESIMID'];
					$PROJECTID_CS		= $ChickSellQuery['PROJECTID'];
					$SUBPROJECTID_CS	= $ChickSellQuery['SUBPROJECTID'];
					$TOTQUANTITY_CS		= $ChickSellQuery['TOTQUANTITY'];
					$CHICKPRICEPERPCS_CS	= $ChickSellQuery['CHICKPRICEPERPCS'];
					$RATE_CS			= $ChickSellQuery['RATE'];
					$PRICE_CS			= $ChickSellQuery['PRICE'];
					$TOTPRICE_CS		= $ChickSellQuery['TOTPRICE'];
					$PERCENTAGE_CS		= $ChickSellQuery['PERCENTAGE'];
					
					if($TOTPRICE_CS <= 0){
						$NOW_TOTPRICE_CS		= $TOTALPRICE_CS ; 
					}else{
						$NOW_TOTPRICE_CS		= $TOTPRICE_CS - $TOTALPRICE_CS ; 
					}
					$Now_TOTQUANTITY_CS		= $TOTQUANTITY_CS - $QUANTITY_CS ; 
					
					
					$insertChickSellQuery = "
												INSERT INTO 
															hatch_chicken_production
																				(
																					ENTRYSERIALNOID,
																					ESIMID,
																					PROJECTID,
																					SUBPROJECTID,
																					PARTYID,
																					HATCHNO,
																					QUANTITY,
																					TOTQUANTITY,
																					CHICKPRICEPERPCS,
																					RATE,
																					PRICE,
																					TOTPRICE,
																					PERCENTAGE,
																					CPDATE,
																					HATCHFLAG,
																					WORKSFLAG,
																					STATUS,
																					ENTDATE,
																					ENTTIME,
																					USERID
																				) 
																			VALUES
																				(
																					'".$MaxEntrySlNo_CS."',
																					'".$ESIMID_CS."',
																					'".$PROJECTID_CS."',
																					'".$SUBPROJECTID_CS."',
																					'".$PARTYID."',
																					'".$HATCHNO_CS."',
																					'".$QUANTITY_CS."',
																					'".$Now_TOTQUANTITY_CS."',
																					'".$CHICKPRICEPERPCS_CS."',
																					'".$RATE_CSPARTY."',
																					'".$TOTALPRICE_CS."',
																					'".$NOW_TOTPRICE_CS."',
																					'".$PERCENTAGE_CS."',
																					'".$CPDATE_CS."',
																					'".$NowMaxHATCHFLAG."',
																					'Out',
																					'Active',
																					'".$entDate."',
																					'".$entTime."',
																					'".$userId."'
																				)
																			"; 
					$insertChickSellQueryStatement = mysql_query($insertChickSellQuery);
					if($insertChickSellQueryStatement){
						
						
						if($PARTYID == '4'){
							
						
						//Update  Poultry Chicken Purchase table Start
						$PalChickPurFlagQuery			= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM pal_chicken_purchase"));
						$PalChickPurFlag				= $PalChickPurFlagQuery['MAX(FLAG)'];
						$MaxPalChickPurFlag				= $PalChickPurFlagQuery['MAX(FLAG)'] + 1;
						
						$PalChickQry					= mysql_fetch_array(mysql_query("SELECT * FROM pal_chicken_purchase WHERE FLAG = '".$PalChickPurFlag."'"));
						$PalChickTotQnty				= $PalChickQry['TOTQUANTITY'];
						$PalChickTotPrice				= $PalChickQry['TOTPRICE'];
						$PalChickTotAvgRate				= $PalChickQry['AVGRATE'];
						
						$NowPalChickTotQnty				= $PalChickTotQnty + $QUANTITY_CS ; 
						$NowPalChickTotPrice			= $PalChickTotPrice + $TOTALPRICE_CS ; 
						$NowAvgRate						= $NowPalChickTotPrice / $NowPalChickTotQnty ; 
						
						$insertPalChickPurQuery 		= "
																INSERT INTO 
																			pal_chicken_purchase
																							(
																								ENTRYSERIALNOID,
																								PARTYID,
																								PROJECTID,
																								SUBPROJECTID,
																								HATCHNO,
																								QUANTITY,
																								TOTQUANTITY,
																								RATE,
																								AVGRATE,
																								PRICE,
																								TOTPRICE,
																								CHICKENPURDATE,
																								FLAG,
																								ENTDATE,
																								ENTTIME,
																								USERID
																							) 
																						VALUES
																							(
																								'".$MaxEntrySlNo_CS."',
																								'3',
																								'3',
																								'8',
																								'".$HATCHNO_CS."',
																								'".$QUANTITY_CS."',
																								'".$NowPalChickTotQnty."',
																								'".$RATE_CSPARTY."',
																								'".$NowAvgRate."',
																								'".$TOTALPRICE_CS."',
																								'".$NowPalChickTotPrice."',
																								'".$CPDATE_CS."',
																								'".$MaxPalChickPurFlag."',
																								'".$entDate."',
																								'".$entTime."',
																								'".$userId."'
																							)
																						"; 
							$insertPalChickPurQueryStatement = mysql_query($insertPalChickPurQuery);
						
						//Update Poultry Chicken Purchase table End
						
						
						//--------------------------------------------------Internal Transaction Start ---------------------------------------------------------
						
						//Update Party Bill Table Start
										$PartyFlagQueryPoult			= mysql_fetch_array(mysql_query("SELECT MAX(PARTYFLAG) FROM fna_partybill WHERE PARTYID = '".$PARTYID."' AND PURSELLFLAG = 'Sell' "));
										$MaxPartyFlagPoult				= $PartyFlagQueryPoult['MAX(PARTYFLAG)'];
										$NowMaxPartyFlagPoult			= $PartyFlagQueryPoult['MAX(PARTYFLAG)'] + 1;
										
										$PartyBalanceQueryPoult			= mysql_fetch_array(mysql_query("SELECT BALANCEAMOUNT FROM fna_partybill WHERE PARTYID = '".$PARTYID."' AND PARTYFLAG = '".$MaxPartyFlagPoult."' AND PURSELLFLAG = 'Sell'"));
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
																										'".$PARTYID."',
																										'".$PROJECTID_CS."',
																										'".$SUBPROJECTID_CS."',
																										'".$TOTALPRICE_CS."',
																										'0',
																										'".$TOTALPRICE_CS."',
																										'".$NowPartyBalanceAmountPoult."',
																										'".$CPDATE_CS."',
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
										$NOW_DESCRIPTION		= 'Payment Receive from Poultry. Hatch No: '.' '.$HATCHNO_CS.', Qnty : '.$QUANTITY_CS.' * '.$RATE_CSPARTY.'';
										
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
																												'".$PROJECTID_CS."',
																												'".$SUBPROJECTID_CS."',
																												'".$CPDATE_CS."',
																												'18',
																												'".$TOTALPRICE_CS."',
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
										
										$PartyFlagQueryHatch			= mysql_fetch_array(mysql_query("SELECT MAX(PARTYFLAG) FROM fna_partybill WHERE PARTYID = '3' AND PURSELLFLAG = 'Purchase'"));
										$MaxPartyFlagHatch				= $PartyFlagQueryHatch['MAX(PARTYFLAG)'];
										$NowMaxPartyFlagHatch			= $PartyFlagQueryHatch['MAX(PARTYFLAG)'] + 1;
										
										$PartyBalanceQueryHatch			= mysql_fetch_array(mysql_query("SELECT BALANCEAMOUNT FROM fna_partybill WHERE PARTYID = '3' AND PARTYFLAG = '".$MaxPartyFlagHatch."' AND PURSELLFLAG = 'Purchase'"));
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
																										'3',
																										'3',
																										'8',
																										'".$TOTALPRICE_CS."',
																										'".$TOTALPRICE_CS."',
																										'0',
																										'".$NowPartyBalanceAmountHatch."',
																										'".$CPDATE_CS."',
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
										
										$DESCRIPTION_NOW		= 'Payment to Hatchery. Hatch No: '.' '.$HATCHNO_CS.' , Qnty : '.$QUANTITY_CS.' * '.$RATE_CSPARTY.'';
										
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
																												'".$CPDATE_CS."',
																												'158',
																												'".$TOTALPRICE_CS."',
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
						
						//-------------------------------------------------Internal Transaction  End ------------------------------------------------------------
						}else{
							//Update Hatchery Table Start
						$PartyFlagQuery				= mysql_fetch_array(mysql_query("SELECT MAX(PARTYFLAG) FROM fna_partybill WHERE PARTYID = '".$PARTYID."' AND PURSELLFLAG = 'Sell'"));
						$MaxPartyFlag				= $PartyFlagQuery['MAX(PARTYFLAG)'];
						$NowMaxPartyFlag			= $PartyFlagQuery['MAX(PARTYFLAG)'] + 1;
						
						$PartyBalanceQuery			= mysql_fetch_array(mysql_query("SELECT BALANCEAMOUNT FROM fna_partybill WHERE PARTYID = '".$PARTYID."' AND PARTYFLAG = '".$MaxPartyFlag."' AND PURSELLFLAG = 'Sell'"));
						$PartyBalanceAmount			= $PartyBalanceQuery['BALANCEAMOUNT'];
						$NowPartyBalanceAmount		= $PartyBalanceAmount + $TOTALPRICE_CS ; 
						
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
																						'".$MaxEntrySlNo_CS."',
																						'".$PARTYID."',
																						'".$PROJECTID_CS."',
																						'".$SUBPROJECTID_CS."',
																						'".$TOTALPRICE_CS."',
																						'0',
																						'0',
																						'".$NowPartyBalanceAmount."',
																						'".$CPDATE_CS."',
																						'".$NowMaxPartyFlag."',
																						'Sell',
																						'Sell',
																						'".$entDate."',
																						'".$entTime."',
																						'".$userId."'
																					)
																				"; 
							$insertPartyQueryStatement = mysql_query($insertPartyQuery);
						//Update Hatchery Table End	
						
						
						}
						
						if($CHICKENSTOCKQNTY == $QUANTITY_CS){
							
							$UpdateQuery	=" UPDATE hatch_chicken_production SET
												STATUS = 'Inactive'
												WHERE HATCHNO = '".$HATCHNO_CS."'
												AND  HATCHFLAG = '".$MaxHATCHFLAG."'
											 ";
							
						}
						
						$msg = "<span class='validMsg'>This Chicken Sell  Quantity. [ $ESIMID_CS ] added sucessfully</span>";
					} else {
						$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
					}
				}else{
					$msg = "<span class='errorMsg'>Sorry! Stock Quantity is not Lower Then Production Quantity!</span>";
				}
			}
			return $msg;
			
			
			
			
		}
		// Insert Chicken Sell End
		
		// Insert Vanga Egg Sell start 
		function insertVangaEggSellInfo($userId){
			$VABGAEGGSTOCKQNTY	= addslashes($_REQUEST["VABGAEGGSTOCKQNTY"]);
			$PARTYID_VES		= addslashes($_REQUEST["PARTYID_VES"]);
			$QUANTITY_VES		= addslashes($_REQUEST["QUANTITY_VES"]);
			$RATE_VES			= addslashes($_REQUEST["RATE_VES"]);
			$PRICE_VES			= addslashes($_REQUEST["PRICE_VES"]);
			$VESDATE			= insertDateMySQlFormat($_REQUEST["VESDATE"]);
			
			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
			$Query		= "
									SELECT 
											PARTYID,
											QUANTITY,
											RATE,
											PRICE,
											VESDATE 
									FROM 
											hatch_vangaeggsell
											
									WHERE PARTYID = '".$PARTYID_VES."'
									AND QUANTITY = '".$QUANTITY_VES."'
									AND RATE = '".$RATE_VES."'
									AND PRICE = '".$PRICE_VES."'
									AND VESDATE = '".$VESDATE."'
								  ";
			$QueryStatement	= mysql_query($Query);
			if(mysql_num_rows($QueryStatement)>0) {
				$msg = "<span class='errorMsg'>Sorry, Today's This Vanga Egg Quantity [ $QUANTITY ] already exist!</span>";
			} else {
				
				$EntrySerial_Query_Flag_VEgg 		= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_entryserialno"));
				$MaxFlagEntrySl_VEgg				= $EntrySerial_Query_Flag_VEgg['MAX(FLAG)'];
				
				$EntrySerial_Query_No_VEgg		= mysql_fetch_array(mysql_query("SELECT MAX(ENTRYSERIALNOID) FROM fna_entryserialno"));
				$MaxEntrySlNo_VEgg				= $EntrySerial_Query_No_VEgg['MAX(ENTRYSERIALNOID)'] + 1;
		
		
				$insertQueryEntrySl_VEgg = "
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
																		'".$MaxEntrySlNo_VEgg."',
																		'".$PROJECTID."',
																		'".$SUBPROJECTID."',
																		'".$CPDATE_CS."',
																		'".$MaxFlagEntrySl_VEgg."',
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									";
				$insertQueryEntrySl_VEggStatement = mysql_query($insertQueryEntrySl_VEgg);
				
				if($VABGAEGGSTOCKQNTY >= $QUANTITY_VES){
					
					$FlagQuery				= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM hatch_vangaeggsell"));
					$MaxFlag				= $FlagQuery['MAX(FLAG)'];
					$NowMaxFlag				= $FlagQuery['MAX(FLAG)'] + 1;
					
					$VangaQuery				= mysql_fetch_array(mysql_query("SELECT * FROM hatch_vangaeggsell"));
					$TOTQUANTITY_VES		= $VangaQuery['TOTQUANTITY'];
					$TOTALPRICE_VES			= $VangaQuery['TOTALPRICE'];
					
					$NOW_TOTQUANTITY_VES	= $TOTQUANTITY_VES + $QUANTITY_VES ;
					$NOW_TOTALPRICE_VES		= $TOTALPRICE_VES + $PRICE_VES ;
					
					$insertVangaQuery		= "
														INSERT INTO 
																	hatch_vangaeggsell
																					(
																						ENTRYSERIALNOID,
																						PARTYID,
																						QUANTITY,
																						TOTQUANTITY,
																						RATE,
																						PRICE,
																						TOTALPRICE,
																						VESDATE,
																						FLAG,
																						STATUS,
																						ENTDATE,
																						ENTTIME,
																						USERID
																					) 
																				VALUES
																					(
																						'".$MaxEntrySlNo_VEgg."',
																						'".$PARTYID_VES."',
																						'".$QUANTITY_VES."',
																						'".$NOW_TOTQUANTITY_VES."',
																						'".$RATE_VES."',
																						'".$PRICE_VES."',
																						'".$NOW_TOTALPRICE_VES."',
																						'".$VESDATE."',
																						'".$NowMaxFlag."',
																						'VangaSell',
																						'".$entDate."',
																						'".$entTime."',
																						'".$userId."'
																					)
																				"; 
					$insertVangaQueryStatement = mysql_query($insertVangaQuery);
					
					if($insertVangaQueryStatement){
						//UPDATE HATCHING OPENING EGG TABLE STATRT
						$OHEFLAG_QUERY		= mysql_fetch_array(mysql_query("SELECT MAX(OHEFLAG) FROM hatch_opening_hatching_egg "));
						$MaxOHEFLAG			= $OHEFLAG_QUERY['MAX(OHEFLAG)'];
						$NowMaxOHEFLAG		= $OHEFLAG_QUERY['MAX(OHEFLAG)'] + 1;
						
						$OpenHatchQuery		= mysql_fetch_array(mysql_query("SELECT * FROM hatch_opening_hatching_egg WHERE OHEFLAG = '".$MaxOHEFLAG."'"));
						$TOTEGGQNTY			= $OpenHatchQuery['TOTEGGQNTY'];
						$TOTPRICE_EGG		= $OpenHatchQuery['TOTPRICE'];
						$AVGRATEPEREGG		= $OpenHatchQuery['AVGRATEPEREGG'];
						$ESID				= $OpenHatchQuery['ESID'];
						$PROJECTID			= $OpenHatchQuery['PROJECTID'];
						$SUBPROJECTID		= $OpenHatchQuery['SUBPROJECTID'];
						$BATCHNO			= $OpenHatchQuery['BATCHNO'];
						$OPENDATE			= $OpenHatchQuery['OPENDATE'];
						$EGGQUANTITY		= $OpenHatchQuery['EGGQUANTITY'];
						
						$VANGAEGGQNTY		= $OpenHatchQuery['VANGAEGGQNTY'];
						$TOTVANGAEGGQNTY	= $OpenHatchQuery['TOTVANGAEGGQNTY'];
						
						$TOTEGGQNTY			= $OpenHatchQuery['TOTEGGQNTY'];
						$PRICE				= $OpenHatchQuery['PRICE'];
						$TOTPRICE			= $OpenHatchQuery['TOTPRICE'];
						$RATE				= $OpenHatchQuery['RATE'];
						$AVGRATEPEREGG		= $OpenHatchQuery['AVGRATEPEREGG'];
						
						$Now_TOTVANGAEGGQNTY	= $TOTVANGAEGGQNTY - $QUANTITY_VES ; 
						
						$insertOpenHatchEggQuery = "
														INSERT INTO 
																	hatch_opening_hatching_egg
																					(
																						ENTRYSERIALNOID,
																						ESID,
																						PROJECTID,
																						SUBPROJECTID,
																						BATCHNO,
																						OPENDATE,
																						EGGQUANTITY,
																						VANGAEGGQNTY,
																						TOTVANGAEGGQNTY,
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
																						'".$MaxEntrySlNo_VEgg."',
																						'".$ESID."',
																						'".$PROJECTID."',
																						'".$SUBPROJECTID."',
																						'".$BATCHNO."',
																						'".$VESDATE."',
																						'".$EGGQUANTITY."',
																						'".$QUANTITY_VES."',
																						'".$Now_TOTVANGAEGGQNTY."',
																						'".$TOTEGGQNTY."',
																						'".$PRICE_VES."',
																						'".$TOTPRICE."',
																						'".$RATE."',
																						'".$AVGRATEPEREGG."',
																						'".$NowMaxOHEFLAG."',
																						'VangaSell',
																						'".$entDate."',
																						'".$entTime."',
																						'".$userId."'
																					)
																				"; 
						$insertOpenHatchEggQueryStatement = mysql_query($insertOpenHatchEggQuery);
						
						//UPDATE HATCHING OPENING EGG TABLE END
						
						//Update PARTY BILL Table Start
						$PartyFlagQuery				= mysql_fetch_array(mysql_query("SELECT MAX(PARTYFLAG) FROM fna_partybill WHERE PARTYID = '".$PARTYID_VES."' AND PURSELLFLAG = 'Sell'"));
						$MaxPartyFlag				= $PartyFlagQuery['MAX(PARTYFLAG)'];
						$NowMaxPartyFlag			= $PartyFlagQuery['MAX(PARTYFLAG)'] + 1;
						
						$PartyBalanceQuery			= mysql_fetch_array(mysql_query("SELECT BALANCEAMOUNT FROM fna_partybill WHERE PARTYID = '".$PARTYID_VES."' AND PARTYFLAG = '".$MaxPartyFlag."' AND PURSELLFLAG = 'Sell'"));
						$PartyBalanceAmount			= $PartyBalanceQuery['BALANCEAMOUNT'];
						$NowPartyBalanceAmount		= $PartyBalanceAmount + $PRICE_VES ; 
						
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
																						'".$MaxEntrySlNo_VEgg."',
																						'".$PARTYID_VES."',
																						'4',
																						'9',
																						'".$PRICE_VES."',
																						'0',
																						'0',
																						'".$NowPartyBalanceAmount."',
																						'".$VESDATE."',
																						'".$NowMaxPartyFlag."',
																						'Sell',
																						'Sell',
																						'".$entDate."',
																						'".$entTime."',
																						'".$userId."'
																					)
																				"; 
							$insertPartyQueryStatement = mysql_query($insertPartyQuery);
						//Update PARTY BILL Table End
						
					$msg = "<span class='validMsg'>This Chicken Sell  Quantity. [ $PARTYID_VES ] added sucessfully</span>";
					} else {
						$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
					}
				}else{
					$msg = "<span class='errorMsg'>Sorry! Stock Quantity is not Lower Then Production Quantity!</span>";
				}
			}
			return $msg;
			
			
			
			
		}
		// Insert Vanga Egg Sell End
		
}
?>