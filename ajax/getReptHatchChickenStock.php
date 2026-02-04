<?php

	include('../config/dbinfo.inc.php');
	
function showDateMySQlFormat($date){
	
		$exp = explode("-",$date);				
		$mysqlDateF = $exp[2]."-".$exp[1]."-".$exp[0];
		
		return $mysqlDateF;
}
function insertDateMySQlFormat($date){
	
		$exp = explode("-",$date);				
		$mysqlDateFormate = $exp[2]."-".$exp[1]."-".$exp[0];
		
		return $mysqlDateFormate;
		
}

	
		

	$PROJECTID 			= $_REQUEST['PROJECTID'];
	$SUBPROJECTID		= $_REQUEST['SUBPROJECTID'];
	$OPENINGDATE_FROM 	= showDateMySQlFormat($_REQUEST['ENTRYDATE']);
	$OPENINGDATE_TO		= showDateMySQlFormat($_REQUEST['ENTRYDATE2']);
	$userId 			= $_REQUEST['userId'];
	
	/*if ($HATCHNO == 'All'){
		$con = '';
	}else{
		$con = "AND HATCHNO ='".$HATCHNO."' ";
	}
		
	*/
		/*$Last_Date = date_create($ENTRYDATE_TO);
		date_sub($Last_Date, date_interval_create_from_date_string('1 days'));
		$LastDay = date_format($Last_Date, 'Y-m-d');*/

		//Ministry/Division and Project/Programme Name View Report Start				
	 	$projectSql 	= "
							SELECT  p.PROJECTNAME											
							FROM fna_project p
							WHERE p.PROJECTID = '".$PROJECTID."'
							
						";
			$projectSqlStatement				= mysql_query($projectSql);
			while($projectSqlStatementData		= mysql_fetch_array($projectSqlStatement)){
				$PROJECTNAME        			= $projectSqlStatementData["PROJECTNAME"];
				
			}
			
			//Ministry/Division and Project/Programme Name View Report End
			
	$tableView = "";	
	$tableView .="<table width='70%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:85%; border: 1px dotted #000'>
					<tr>
                            <td style='text-align:right;' colspan='18'>
                            <a href='javascript:Clickheretoprint()'><img border='0' src='images/print_icon.jpg' width='40' height='26' /></a>                        
                            </td>
                     </tr>
					  <tr>
						<td colspan='18' align='center' valign='middle' style='border: 1px dotted #000'>
							<center><b><font size=5>F N A Group Of Company</font></b></center>
							<center>&nbsp;</center>
							<center><b><font size=4>Chicken, Egg Setting Stock Report</FONT></b></center>
							<center>&nbsp;</center>
							<center><b><font size=2>Date : $OPENINGDATE_FROM to $OPENINGDATE_TO </font></b></center>
						</td>
					  </tr>
					  <tr>

						<td colspan='18' align='left' valign='top'>
							<table width='100%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:100%;'>
								  <tr>
								
									<td width='14%' align='left' valign='top'>Project  Name<b></td>
									<td width='1%' align='center' valign='top'>:</td>
									<td width='34%' align='left' valign='top'><font size='+1'> $PROJECTNAME</font></td>
									<td width='18%' align='right' valign='top'>&nbsp;</td>
									<td width='1%' align='center' valign='top'>&nbsp;</td>
									<td width='20%' align='left' valign='top'>&nbsp;</td>
									<td align='left' valign='top'>&nbsp;</td>
								
								  </tr>
								
								  							
								  <tr>
								
									<td align='left' valign='top'>&nbsp;</td>
									<td align='center' valign='top'>&nbsp;</td>
								
									<td align='left' valign='top'>&nbsp;</td>
									<td align='right' valign='top'>&nbsp;</td>
									<td align='center' valign='top'>&nbsp;</td>
									<td align='left' valign='top'>&nbsp;</td>
									<td align='left' valign='top'>&nbsp;</td>
								
								  </tr>
								
								</table>
							

						</td>

					  </tr>
					  <tr style='font-weight:bold;'>

						<td align='center' valign='middle' style='font-weight:bold;border: 1px dotted #000'>SL No.</td>

						<td align='center' valign='middle'  style='border: 1px dotted #000'>Hatch No.</td>
						
						<td align='center' valign='middle'  style='border: 1px dotted #000'>Setting in Machine.</td>
						
						<td align='center' valign='middle'  style='border: 1px dotted #000'>Setting Price.</td>
						
						<td align='center' valign='middle'  style='border: 1px dotted #000'>Setting Avg. Price.</td>
						
						<td align='center' valign='middle'  style='border: 1px dotted #000'>Chick Prod Quantity</td>

						<td align='center' valign='middle' style='border: 1px dotted #000'>Prod Avg Price</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Sales Qnty</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Sales Avg Rate</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Total Price</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Sell Balance</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Setting Balance</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Setting Price Balance</td>
											
					</tr>";

// Query here.
						$HATCH_ARRAY		= array();
						$HatchQuery	 		= "SELECT HATCHNO
															FROM hatch_egg_settings_machine 
															WHERE 	PROJECTID 	= '".$PROJECTID."'
															AND 	SUBPROJECTID 	= '".$SUBPROJECTID."'
															ORDER BY HATCHNO ASC
														"; 
						$HatchQueryStatement					= mysql_query($HatchQuery);
						$i = 0;
						while($HatchQueryStatementData		= mysql_fetch_array($HatchQueryStatement)){	
							$HATCH_ARRAY[] 					= $HatchQueryStatementData['HATCHNO'];
							$i++;
						}
						$SL = 1;
						$Global_Quantity = 0;
						$Global_Sales_qnty = 0;
						$Global_Total_Price = 0;
						$Global_Present_Stock = 0;
						$Global_Setting_qnty	= 0;
						$Global_Setting_Price	= 0;
						$Global_Prod_Qnty	=0;
						$GLOBAL_EGGQNTY_SETTING_BALANCE = 0;
						$GLOBAL_EGGPRICE_SETTING_BALANCE = 0;
							
						$HATCH_ARRAY_UNIQUE 		= array_unique($HATCH_ARRAY) ;
						foreach($HATCH_ARRAY_UNIQUE as $individualHatch){
							
							
						$BasicQuery 	= "SELECT HATCHNO,
												  QUANTITY,
												  CHICKPRICEPERPCS,
												  PERCENTAGE
												FROM hatch_chicken_production 
												WHERE CPDATE BETWEEN '".$OPENINGDATE_FROM."' AND '".$OPENINGDATE_TO."'
												AND HATCHNO = '".$individualHatch."'
												AND PROJECTID = '".$PROJECTID."'
												AND SUBPROJECTID = '".$SUBPROJECTID."'
												AND WORKSFLAG = 'In'
												ORDER BY CPDATE ASC
												
										";
						$BasicQueryStatement			= mysql_query($BasicQuery);
						$QUANTITY_PROD	=0;
						
						
						while($BasicQueryStatementData	= mysql_fetch_array($BasicQueryStatement)){	
							$HATCHNO_PROD	 			= $BasicQueryStatementData['HATCHNO'];
							$QUANTITY_PROD		 		= $BasicQueryStatementData['QUANTITY'];
							$CHICKPRICEPERPCS_PROD		= $BasicQueryStatementData['CHICKPRICEPERPCS'];
							$PERCENTAGE_PROD 			= $BasicQueryStatementData['PERCENTAGE'];
						}
						$Global_Prod_Qnty		= 	$Global_Prod_Qnty + $QUANTITY_PROD;
							
						$SaleQuery 	= "SELECT HATCHNO,
											  SUM(QUANTITY) AS QNTY,
											  RATE,
											  SUM(PRICE) PRICE,
											  WORKSFLAG,
											  HATCHFLAG
											FROM hatch_chicken_production 
											WHERE CPDATE BETWEEN '".$OPENINGDATE_FROM."' AND '".$OPENINGDATE_TO."'
											AND HATCHNO = '".$individualHatch."'
											AND PROJECTID = '".$PROJECTID."'
											AND SUBPROJECTID = '".$SUBPROJECTID."'
											AND WORKSFLAG = 'Out'
											
										";
							$SaleQueryStatement			= mysql_query($SaleQuery);
							$SaleAvgPrice	= 0;
							while($SaleQueryStatementData	= mysql_fetch_array($SaleQueryStatement)){	
								$HATCHNO_SALE	 			= $SaleQueryStatementData['HATCHNO'];
								$QUANTITY_SALE	 			= $SaleQueryStatementData['QNTY'];
								$RATE_SALE		 			= $SaleQueryStatementData['RATE'];
								$PRICE_SALE		 			= $SaleQueryStatementData['PRICE'];
							}
								//$Global_Quantity			= $Global_Quantity + $QUANTITY ; 
								
							$PRESENT_CHICK_STOCK	= $QUANTITY_PROD - $QUANTITY_SALE ; 
															
							$SettingQuery 	= "SELECT SUM(EGGQNTY) AS EGGQNTY,
													  SUM(EGGPRICE) EGGPRICE,
													  HATCHNO
													FROM hatch_egg_settings_machine 
													WHERE HATCHNO = '".$individualHatch."'
													AND ESIMDATE BETWEEN '".$OPENINGDATE_FROM."' AND '".$OPENINGDATE_TO."'
													AND STATUS = 'In'
													
											";
							$SettingQueryStatement			= mysql_query($SettingQuery);
							$SettingAvgPrice	= 0;
							
							while($SettingQueryStatementData	= mysql_fetch_array($SettingQueryStatement)){	
								$EGGQNTY_SETTING	 			= $SettingQueryStatementData['EGGQNTY'];
								$EGGPRICE_SETTING	 			= $SettingQueryStatementData['EGGPRICE'];
								$HATCHNO_SETTING	 			= $SettingQueryStatementData['HATCHNO'];
							}	
							$Global_Setting_qnty 	= $Global_Setting_qnty + $EGGQNTY_SETTING ;
							$Global_Setting_Price 	= $Global_Setting_Price + $EGGPRICE_SETTING ;
							
							$Global_Sales_qnty		= $Global_Sales_qnty + $QUANTITY_SALE ; 
							$Global_Total_Price		= $Global_Total_Price + $PRICE_SALE ; 	
							$Global_Present_Stock	= $Global_Present_Stock + $PRESENT_CHICK_STOCK ; 
							
							if ($QUANTITY_PROD <= 0){
									$EGGQNTY_SETTING_BALANCE 	= $EGGQNTY_SETTING ;
									$EGGPRICE_SETTING_BALANCE	= $EGGPRICE_SETTING ;
								}else{
									$EGGQNTY_SETTING_BALANCE 	= 0 ;
									$EGGPRICE_SETTING_BALANCE	= 0 ;
								}
							$GLOBAL_EGGQNTY_SETTING_BALANCE		= $GLOBAL_EGGQNTY_SETTING_BALANCE + $EGGQNTY_SETTING_BALANCE ;
							$GLOBAL_EGGPRICE_SETTING_BALANCE	= $GLOBAL_EGGPRICE_SETTING_BALANCE + $EGGPRICE_SETTING_BALANCE ;	
							
							
							if($EGGQNTY_SETTING != NULL){
							$SaleAvgPrice			= $PRICE_SALE / $QUANTITY_SALE ;
							$SettingAvgPrice		= $EGGPRICE_SETTING / $EGGQNTY_SETTING ;
							
							$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000'>$SL</td>

											<td align='center' valign='top'  style='border: 1px dotted #000'>$HATCHNO_SETTING</td>
											
											<td align='center' valign='top'  style='border: 1px dotted #000'>$EGGQNTY_SETTING</td>
											
											<td align='center' valign='top'  style='border: 1px dotted #000'>".number_format($EGGPRICE_SETTING,2)."</td>
											
											<td align='center' valign='top'  style='border: 1px dotted #000'>".number_format($SettingAvgPrice,2)."</td>
											
											<td align='center' valign='top'  style='border: 1px dotted #000'>$QUANTITY_PROD</td>
											
											<td align='center' valign='top'  style='border: 1px dotted #000'>".number_format($CHICKPRICEPERPCS_PROD,2)."</td>
											
											<td align='center' valign='top'  style='border: 1px dotted #000'>$QUANTITY_SALE</td>
											
											<td align='center' valign='top'  style='border: 1px dotted #000'>".number_format($SaleAvgPrice,2)."</td>
											
											<td align='center' valign='top'  style='border: 1px dotted #000'>".number_format($PRICE_SALE,2)."</td>
											
											<td align='center' valign='top'  style='border: 1px dotted #000'>".number_format($PRESENT_CHICK_STOCK,2)."</td>
											
											<td align='center' valign='top'  style='border: 1px dotted #000'>$EGGQNTY_SETTING_BALANCE</td>
											
											<td align='center' valign='top'  style='border: 1px dotted #000'>".number_format($EGGPRICE_SETTING_BALANCE,2)."</td>
											
																							
										</tr>

									 ";

								// Dynamic Row End		  

					$SL++;	
					}
				}

					$tableView .="

						<tr style='font-weight:bold;'>

							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='center' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='center' valign='top' style='border: 1px dotted #000'>$Global_Setting_qnty</td>
							
							<td align='center' valign='top' style='border: 1px dotted #000'>".number_format($Global_Setting_Price,2)."</td>
							
							<td align='center' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='center' valign='top' style='border: 1px dotted #000'>$Global_Prod_Qnty</td>
							
							<td align='center' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='center' valign='top' style='border: 1px dotted #000'>$Global_Sales_qnty</td>

							<td align='center' valign='top' style='border: 1px dotted #000'></td>
							
							<td align='center' valign='top' style='border: 1px dotted #000'>".number_format($Global_Total_Price,2)."</td>
							
							<td align='center' valign='top' style='border: 1px dotted #000'>$Global_Present_Stock</td>

							<td align='center' valign='top'  style='border: 1px dotted #000'>$GLOBAL_EGGQNTY_SETTING_BALANCE</td>

							<td align='center' valign='top' style='border: 1px dotted #000'>".number_format($GLOBAL_EGGPRICE_SETTING_BALANCE,2)."</td>
							
							
							
						</tr>
						<tr>

							<td colspan='13' align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

						</tr>
							
						<tr>

							<td colspan='13' align='left' valign='top'>&nbsp;</td>

						</tr>
						<tr>

							<td colspan='13' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='13' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='13' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='13' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='13' align='left' valign='top' >
								<table width='100%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:100%;'>
								  <tr>
									<td align='right' width='20%' valign='bottom' ><hr width='200' ></td>
									<td width='20%' valign='bottom' ><hr width='200' ></td>
									<td width='20%' valign='bottom' ><hr width='200' ></td>
									<td width='20%' valign='bottom' ><hr width='200' ></td>
									<td width='20%' valign='bottom' ><hr width='200' ></td>
								  </tr>
								  <tr>
									<td align='center' valign='top'  ><b>Store Keeper Signature</b></td>
									<td  align='center' valign='top'  ><b>Computer Operator</b></td>
									<td align='center' valign='top'  ><b>Manager Signature</b></td>
									<td  align='center' valign='top'  ><b>AGM Signature</b></td>
									<td align='center' valign='top'  ><b>GM Signature</b></td>
								  </tr>
								 </table>
							</td>

						</tr>
						<tr>

							<td colspan='13' align='left' valign='top' >&nbsp;</td>

						</tr>
						<tr>

							<td colspan='13' align='left' valign='top' >&nbsp;</td>

						</tr>					

					</table>";
	echo $tableView;

?>