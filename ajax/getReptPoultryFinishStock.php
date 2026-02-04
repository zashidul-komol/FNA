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
	$PURCHASEDATE_FROM 	= showDateMySQlFormat($_REQUEST['ENTRYDATE']);
	$PURCHASEDATE_TO	= showDateMySQlFormat($_REQUEST['ENTRYDATE2']);
	$userId 			= $_REQUEST['userId'];
	
		$Last_Date = date_create($PURCHASEDATE_TO);
		date_sub($Last_Date, date_interval_create_from_date_string('1 days'));
		$LastDay = date_format($Last_Date, 'Y-m-d');

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
							<center><b><font size=4>Poultry Firm Finished Goods Stock Report</FONT></b></center>
							<center>&nbsp;</center>
							<center><b><font size=2>Date : $PURCHASEDATE_FROM to $PURCHASEDATE_TO </font></b></center>
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

						<td align='center' valign='middle'  style='border: 1px dotted #000'>Feed Name</td>

						<td align='center' valign='middle'  style='border: 1px dotted #000'>Total Receive Qnty (KG)</td>
						
						<td align='center' valign='middle'  style='border: 1px dotted #000'>Total Receive Taka</td>
                        
                        <td align='center' valign='middle'  style='border: 1px dotted #000'>Total Use Quantity</td>

						<td align='center' valign='middle' style='border: 1px dotted #000'>Total Use Taka</td>
						
						<td align='center' valign='middle'  style='border: 1px dotted #000'>Balance Quantity</td>

						<td align='center' valign='middle' style='border: 1px dotted #000'>Balance Taka</td>
						
						
					</tr>";

// Query here.

						$FOOD_ARRAY		  	= array();
						$FoodQuery	 		= "SELECT f.FOODID
												FROM feed_fooditem f 
												WHERE 	f.PROJECTID 	= 2
												AND 	f.SUBPROJECTID 	= 6
											"; 
						$FoodQueryStatement					= mysql_query($FoodQuery);
						$i = 0;
						while($FoodQueryStatementData		= mysql_fetch_array($FoodQueryStatement)){	
							$FOOD_ARRAY[] 					= $FoodQueryStatementData['FOODID'];
							$i++;
						}
						$SL = 1;
						$Global_FOODTOTQNTY = 0;
						$Global_TOTAMOUNT_FINISH = 0;
						$Global_TOTQNTY = 0;
						$Global_TOTAMOUNT = 0;
						$FOODTOTQNTY      = 0;
						$BALANCE_QNTY = 0;
						$BALANCE_TAKA = 0;
						$Avg_Price	 = 0;
						$GLOBAL_BALANCE_TAKA = 0;
						$Global_BALANCE_QNTY = 0;
						$Global_PROD_QNTY	=0;
						$Global_TOTAL_COST		 	= 0 ; 
						$Global_USE_QNTY			= 0 ; 
						$Global_USE_COST		 	= 0 ; 
						$FOOD_ARRAY_UNIQUE 		= array_unique($FOOD_ARRAY) ;
						foreach($FOOD_ARRAY_UNIQUE as $individualFood){
							
							$food_flag 		= mysql_fetch_array(mysql_query("SELECT MAX(fs.FOODFLAG)
																					FROM feed_finishedstock fs, pal_fooddistribute fd
																					WHERE fd.FDID = fs.FDID
																					AND fs.FOODID = '".$individualFood."'
																					AND fd.FDDATE BETWEEN '".$PURCHASEDATE_FROM."' AND '".$PURCHASEDATE_TO."'
																					"));
							
							$MaxFoodFlag	= $food_flag['MAX(fs.FOODFLAG)'];
							//echo $individualFood;
							/*$food_flag_Today= mysql_fetch_array(mysql_query("SELECT MAX(fs.FOODFLAG)
																					FROM feed_finishedstock fs, pal_fooddistribute fd
																					WHERE fd.FDID = fs.FDID
																					AND fs.FOODID = '".$individualFood."'
																					AND fd.FDDATE = '".$PURCHASEDATE_TO."'"));
							$MaxFoodFlag_Today	= $food_flag_Today['MAX(fs.FOODFLAG)'];*/
							
							$Production_Qnty_Qry = "SELECT SUM(fp.PRODUCTIONQNTY) ProductionQnty,
														   SUM(fp.PRODUCTIONCOST) ProdCost
													FROM feed_production fp
													WHERE fp.FOODID = '".$individualFood."'
													AND fp.PRODUCTIONDATE BETWEEN '".$PURCHASEDATE_FROM."' AND '".$PURCHASEDATE_TO."'";
																					
							$ProdQnty_QueryStatement						= mysql_query($Production_Qnty_Qry);
							while($ProdQnty_QueryStatementData				= mysql_fetch_array($ProdQnty_QueryStatement)){	
									$Total_ProdQnty							= $ProdQnty_QueryStatementData['ProductionQnty'];
									$Total_Prod_Cost						= $ProdQnty_QueryStatementData['ProdCost'];
								
							}
							
							
							$FoodDist_Qnty_Qry = "SELECT SUM(fd.FOODWEIGHT) TotalFood,
														 SUM(fd.TOTALPRICE) FoodCost
													FROM pal_fooddistribute fd
													WHERE fd.FOODID = '".$individualFood."'
													AND fd.FDDATE BETWEEN '".$PURCHASEDATE_FROM."' AND '".$PURCHASEDATE_TO."'";
																					
							$FoodDistQnty_QueryStatement					= mysql_query($FoodDist_Qnty_Qry);
							while($FoodDistQnty_QueryStatementData			= mysql_fetch_array($FoodDistQnty_QueryStatement)){	
									$Total_FoodDistQnty						= $FoodDistQnty_QueryStatementData['TotalFood'];
									$Total_Food_Cost						= $FoodDistQnty_QueryStatementData['FoodCost'];
								
							}
							
								
							$FoodStock_Query = "SELECT   fi.FOODNAME
													FROM feed_fooditem fi
													WHERE fi.FOODID = '".$individualFood."'
													";
							$FoodStock_QueryStatement				= mysql_query($FoodStock_Query);
							while($FoodStock_QueryStatementData		= mysql_fetch_array($FoodStock_QueryStatement)){	
								$FOODNAME		 					= $FoodStock_QueryStatementData['FOODNAME'];
								
							}
							
							$food_flag_Finish= mysql_fetch_array(mysql_query("SELECT MAX(fs.FOODFLAG)
																					FROM feed_finishedstock fs
																					WHERE fs.FOODID = '".$individualFood."'"));
																					
							$MaxFoodFlag_Finish	= $food_flag_Finish['MAX(fs.FOODFLAG)'];
								
							/*$stock_Query 	= "SELECT   SUM(QUANTITY) quantity,
															SUM(AMOUNT) amount
													FROM feed_finishedstock
													WHERE FOODID = '".$individualFood."'
													
													
												";
							$stock_QueryStatement			= mysql_query($stock_Query);
							$FOODQNTY = 0;
							//$Global_FOODTOTQNTY = 0;
							$AMOUNT_FINISH = 0;
							while($stock_QueryStatementData	= mysql_fetch_array($stock_QueryStatement)){	
								$FOODQNTY					= $stock_QueryStatementData['quantity'];
								$AMOUNT_FINISH				= $stock_QueryStatementData['amount'];
								
							}*/
							
					
							/*$stock_Query_Today 	= "SELECT   fs.QUANTITY,
														fs.AMOUNT
													FROM feed_finishedstock fs
													WHERE fs.FOODID = '".$individualFood."'
													AND fs.FOODFLAG = '".$MaxFoodFlag_Today."'
												";
							$stock_Query_TodayStatement			= mysql_query($stock_Query_Today);
							$QUANTITY_TODAY = 0;
							$AMOUNT_FINISH_TODAY = 0;
							while($stock_Query_TodayStatementData	= mysql_fetch_array($stock_Query_TodayStatement)){	
								$QUANTITY_TODAY				= $stock_Query_TodayStatementData['QUANTITY'];
								$AMOUNT_FINISH_TODAY			= $stock_Query_TodayStatementData['AMOUNT'];
								
							}*/
							
							$BALANCE_QNTY				= $Total_FoodDistQnty - $Total_FoodDistQnty ; 
							$BALANCE_TAKA				= $Total_Food_Cost - $Total_Food_Cost ; 
							
							$GLOBAL_BALANCE_TAKA 		= $GLOBAL_BALANCE_TAKA + $BALANCE_TAKA ;
							
							$Global_PROD_QNTY			= $Global_PROD_QNTY + $Total_ProdQnty ; 
							$Global_TOTAL_COST		 	= $Global_TOTAL_COST + $Total_Food_Cost ; 
							
							$Global_USE_QNTY			= $Global_USE_QNTY + $Total_FoodDistQnty ; 
							$Global_USE_COST		 	= $Global_USE_COST + $Total_Food_Cost ; 
							
							$Global_BALANCE_QNTY		= $Global_BALANCE_QNTY + $BALANCE_QNTY ; 
							
							//$Avg_Price			= $BALANCE_TAKA / $BALANCE_QNTY ; 
							//$Global_TOTQNTY = $Global_TOTQNTY + $TOTQNTY_stock ; 
							//$Global_TOTAMOUNT = $Global_TOTAMOUNT + $TOTAMOUNT_stock ; 
							
						$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000'>$SL</td>

											<td align='center' valign='top'  style='border: 1px dotted #000'>$FOODNAME</td>
											
											<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($Total_FoodDistQnty,2)." KG</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Total_Food_Cost,2)."</td>
											
											<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($Total_FoodDistQnty,2)." KG</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Total_Food_Cost,2)."</td>
											
											<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($BALANCE_QNTY,2)."&nbsp;&nbsp;&nbsp;KG</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($BALANCE_TAKA,2)."</td>
											
											
										</tr>

									 ";

								// Dynamic Row End		  
							
						$SL++;	
					
				}

					$tableView .="

						<tr style='font-weight:bold;'>

							<td align='center' valign='top' style='border: 1px dotted #000'>Total Taka :</td>

							<td align='center' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_USE_QNTY,2)."&nbsp;&nbsp;&nbsp;KG</td>

							<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($Global_TOTAL_COST,2)."</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_USE_QNTY,2)."  KG</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_TOTAL_COST,2)."</td>
							
							<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($Global_BALANCE_QNTY,2)."&nbsp;&nbsp;&nbsp;KG</td>
											
							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($GLOBAL_BALANCE_TAKA,2)."</td>
							
							
						</tr>
						<tr>

							<td colspan='8' align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

						</tr>
							
						<tr>

							<td colspan='8' align='left' valign='top'>&nbsp;</td>

						</tr>
						<tr>

							<td colspan='8' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='8' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='8' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='8' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='8' align='left' valign='top' >
								<table width='100%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:100%;'>
								  <tr>
									<td align='right' width='20%' valign='bottom' ><hr width='200' ></td>
									<td width='20%' valign='bottom' ><hr width='200' ></td>
									<td width='20%' valign='bottom' ><hr width='200' ></td>
									<td width='20%' valign='bottom' ><hr width='200' ></td>
									<td width='20%' valign='bottom' ><hr width='200' ></td>
								  </tr>
								  <tr>
									<td align='center' valign='top'  ><b>Manager (Feed Mill) Signature</b></td>
									<td  align='center' valign='top'  ><b>Computer Operator</b></td>
									<td align='center' valign='top'  ><b>Manager(Finance) Signature</b></td>
									<td  align='center' valign='top'  ><b>AGM(Finance) Signature</b></td>
									<td align='center' valign='top'  ><b>GM Signature</b></td>
								  </tr>
								 </table>
							</td>

						</tr>
						<tr>

							<td colspan='8' align='left' valign='top' >&nbsp;</td>

						</tr>
						<tr>

							<td colspan='8' align='left' valign='top' >&nbsp;</td>

						</tr>					

					</table>";
	echo $tableView;

?>