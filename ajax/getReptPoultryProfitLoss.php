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

	$ENTRYDATE_FROM 	= showDateMySQlFormat($_REQUEST['ENTRYDATE']);
	$ENTRYDATE_TO 		= showDateMySQlFormat($_REQUEST['ENTRYDATE2']);
	$userId 			= $_REQUEST['userId'];
	
		$Last_Date = date_create($ENTRYDATE_TO);
		date_sub($Last_Date, date_interval_create_from_date_string('1 days'));
		$LastDay = date_format($Last_Date, 'Y-m-d');

		//Ministry/Division and Project/Programme Name View Report Start				
	 	$projectSql 	= "
							SELECT  p.PROJECTNAME, 
									sp.SUBPROJECTNAME											
							FROM fna_project p, fna_subproject sp
							WHERE p.PROJECTID = sp.PROJECTID
							AND p.PROJECTID = '".$PROJECTID."'
							AND sp.SUBPROJECTID = '".$SUBPROJECTID."'
						";
			$projectSqlStatement				= mysql_query($projectSql);
			while($projectSqlStatementData		= mysql_fetch_array($projectSqlStatement)){
				$PROJECTNAME        			= $projectSqlStatementData["PROJECTNAME"];
				$SUBPROJECTNAME       			= $projectSqlStatementData["SUBPROJECTNAME"];
			}
			
			//Ministry/Division and Project/Programme Name View Report End
			
	$tableView = "";	
	$tableView .="<table width='90%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:85%; border: 1px dotted #000'>

					  <tr>
                            <td style='text-align:right;' colspan='13'>
                            <a href='javascript:Clickheretoprint()'><img border='0' src='images/print_icon.jpg' width='40' height='26' /></a>                        
                            </td>
                     </tr>
					  <tr>
						<td colspan='18' align='center' valign='middle' style='border: 1px dotted #000'>
							<center><b><font size=5>F N A Group Of Company</font></b></center>
							<center>&nbsp;</center>
							<center><b><font size=4>Project Wise Profit or Loss Report</FONT></b></center>
							<center>&nbsp;</center>
							<center><b><font size=2>Date : $ENTRYDATE_FROM to $ENTRYDATE_TO </font></b></center>
						</td>
					  </tr>
					  <tr>

						<td colspan='18' align='left' valign='top'>
							<table width='100%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:100%;'>
								  <tr>
								
									<td width='14%' align='left' valign='top'>Project  Name<b></td>
									<td width='1%' align='center' valign='top'>:</td>
									<td width='34%' align='left' valign='top'> $PROJECTNAME</td>
									<td width='18%' align='right' valign='top'>&nbsp;</td>
									<td width='1%' align='center' valign='top'>&nbsp;</td>
									<td width='20%' align='left' valign='top'>&nbsp;</td>
									<td align='left' valign='top'>&nbsp;</td>
								
								  </tr>
								
								  <tr>
								
									<td align='left' valign='top'>Sub Project Name</td>
									<td align='center' valign='top'>:</td>
								
									<td align='left' valign='top'> $SUBPROJECTNAME </td>
									<td align='right' valign='top'>&nbsp;</td>
									<td align='center' valign='top'>&nbsp;</td>
									<td align='left' valign='top'>&nbsp;</td>
									<td align='left' valign='top'> &nbsp;</td>
								
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

						<td width='6%' rowspan=1' align='center' valign='middle' style='border: 1px dotted #000'>&nbsp;</td>

						<td  width='40%' colspan=5' align='center' valign='middle' style='border: 1px dotted #000'>Income</td>
						
						<td width='40%' colspan='5' align='center' valign='middle' style='border: 1px dotted #000'>Expanse</td>
						
						<td width='14%' colspan='2' align='center' valign='middle' style='border: 1px dotted #000'>Total</td>
						
					  </tr>

					  <tr style='font-weight:bold;'>

						<td width='6%' align='center' valign='middle' style='font-weight:bold;border: 1px dotted #000'>Date</td>

						<td width='6%' align='center' valign='middle' style='border: 1px dotted #000'>Egg sell</td>
						
						<td width='8%' align='center' valign='middle' style='border: 1px dotted #000'>Murgi/Morog sell </td>
						
						<td width='8%' align='center' valign='middle' style='border: 1px dotted #000'> Daily Income </td>
						
						<td width='8%' align='center' valign='middle' style='border: 1px dotted #000'> Vanga Eggsell </td>
						
						<td width='8%' align='center' valign='middle' style='border: 1px dotted #000'> Others Income </td>

						<td width='8%' align='center' valign='middle' style='border: 1px dotted #000'>Others Exp</td>
						
						<td width='8%' align='center' valign='middle' style='border: 1px dotted #000'>Head wise Exp</td>
						
						<td width='8%' align='center' valign='middle' style='border: 1px dotted #000'>Batch Opening</td>
						
						<td width='8%' align='center' valign='middle' style='border: 1px dotted #000'>Food dist.</td>
						
						<td width='8%' align='center' valign='middle' style='border: 1px dotted #000'>Medicine Dist.</td>
						
						<td width='8%' align='center' valign='middle' style='border: 1px dotted #000'>Total Income</td>
						
						<td width='8%' align='center' valign='middle' style='border: 1px dotted #000'>Total Expanse</td>
						
						</tr>";

// Query here.
						
						//$TOTAL_RECEIVE_QNTY_KG ='';
						$ENTRYDATE_ARRAY = array();
						$batch_price_global = 0;	
						$totprice_eggsell_global = '';
						$totalprice_mmsell_global = 0;
						$AMOUNT_exp = 0;
						$AMOUNT_exp_global = 0;	
						$sellprice_doper_global = '';
						$totprice_foodDist_global = 0;
						$totprice_medicineDist_global =0;
						$Total_Amount = '';	
						$Total_Amount_global = 0;
						$Total_Amount_Expanse_global = 0;
						$Total_Amount_income_global = 0;
						$Net_Profit				= 0;
						$Global_price_vangaegg = 0;
						$Global_Others_Income = 0;
						$Global_Others_Expanse = 0;
						$i = 0;
						
						
						$EgSellQuery 	= "SELECT es.ESDATE
												FROM pal_egg_sell es 
												WHERE es.PROJECTID = '".$PROJECTID."'
												AND es.SUBPROJECTID = '".$SUBPROJECTID."'
												AND es.ESDATE between '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."' 
												ORDER BY es.ESDATE ASC
											";
						$EgSellQueryStatement				= mysql_query($EgSellQuery);
						while($EgSellQueryStatementData		= mysql_fetch_array($EgSellQueryStatement)){	
							$ENTRYDATE_ARRAY[] 				= $EgSellQueryStatementData['ESDATE'];
							$i++;
						}
							
						
						$MMsellQuery 	= "SELECT mms.MMSELLDATE
												FROM pal_morog_murgi_sell mms 
												WHERE mms.PROJECTID = '".$PROJECTID."'
												AND mms.SUBPROJECTID = '".$SUBPROJECTID."'
												AND mms.MMSELLDATE between '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."' 
												ORDER BY mms.MMSELLDATE ASC
											"; 
						$MMsellQueryStatement			= mysql_query($MMsellQuery);
						while($MMsellQueryStatementData	= mysql_fetch_array($MMsellQueryStatement)){	
							$ENTRYDATE_ARRAY[] 			= $MMsellQueryStatementData['MMSELLDATE'];
							$i++;
						}
						$DailyOpQuery 	= "SELECT dop.DODATE
												FROM pal_dailyoperation dop 
												WHERE dop.PROJECTID = '".$PROJECTID."'
												AND dop.SUBPROJECTID = '".$SUBPROJECTID."'
												AND dop.DODATE between '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."' 
												ORDER BY dop.DODATE ASC
											"; 
						$DailyOpQueryStatement				= mysql_query($DailyOpQuery);
						while($DailyOpQueryStatementData	= mysql_fetch_array($DailyOpQueryStatement)){	
							$ENTRYDATE_ARRAY[] 				= $DailyOpQueryStatementData['DODATE'];
							$i++;
						}
						$VangaEggQuery 	= "SELECT ves.VESDATE
												FROM hatch_vangaeggsell ves 
												WHERE ves.VESDATE between '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."' 
												ORDER BY ves.VESDATE ASC
											";
						$VangaEggQueryStatement				= mysql_query($VangaEggQuery);
						while($VangaEggQueryStatementData	= mysql_fetch_array($VangaEggQueryStatement)){	
							$ENTRYDATE_ARRAY[] 				= $VangaEggQueryStatementData['VESDATE'];
							$i++;
						}
						
						$OthersIncomeQuery 	= "SELECT oin.ENTRYDATE
												FROM pal_others_income_expanse oin 
												WHERE oin.ENTRYDATE between '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
												ORDER BY oin.ENTRYDATE ASC
											";
						$OthersIncomeQueryStatement				= mysql_query($OthersIncomeQuery);
						while($OthersIncomeQueryStatementData	= mysql_fetch_array($OthersIncomeQueryStatement)){	
							$ENTRYDATE_ARRAY[] 					= $OthersIncomeQueryStatementData['ENTRYDATE'];
							$i++;
						}
						
						$ExpQuery 	= "SELECT ex.EXPDATE
												FROM fna_expanse ex 
												WHERE ex.PROJECTID = '".$PROJECTID."'
												AND ex.SUBPROJECTID = '".$SUBPROJECTID."'
												AND ex.EXPDATE between '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."' 
												ORDER BY ex.EXPDATE ASC
											"; 
						$ExpQueryStatement			= mysql_query($ExpQuery);
						while($ExpQueryStatementData	= mysql_fetch_array($ExpQueryStatement)){	
							$ENTRYDATE_ARRAY[] = $ExpQueryStatementData['EXPDATE'];
							$i++;
						}
						$BatchQuery 	= "SELECT 	bo.BDATE
												FROM pal_batchopen bo 
												WHERE bo.PROJECTID = '".$PROJECTID."'
												AND bo.SUBPROJECTID = '".$SUBPROJECTID."'
												AND bo.BDATE between '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."' 
												ORDER BY bo.BDATE ASC
											"; 
						$BatchQueryStatement			= mysql_query($BatchQuery);
						$i = 0;
						while($BatchQueryStatementData	= mysql_fetch_array($BatchQueryStatement)){	
							$ENTRYDATE_ARRAY[]			= $BatchQueryStatementData['BDATE'];
							$i++;
						}
						
						
						
						$FoodDistQuery 	= "SELECT fd.FDDATE
												FROM pal_fooddistribute fd 
												WHERE fd.PROJECTID = '".$PROJECTID."'
												AND fd.SUBPROJECTID = '".$SUBPROJECTID."'
												AND fd.FDDATE between '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."' 
												ORDER BY fd.FDDATE ASC
											"; 
						$FoodDistQueryStatement				= mysql_query($FoodDistQuery);
						while($FoodDistQueryStatementData	= mysql_fetch_array($FoodDistQueryStatement)){	
							$ENTRYDATE_ARRAY[] 				= $FoodDistQueryStatementData['FDDATE'];
							$i++;
						}
						
						$MedcinDistQuery 	= "SELECT md.MDDATE
												FROM pal_medicine md 
												WHERE md.PROJECTID = '".$PROJECTID."'
												AND md.SUBPROJECTID = '".$SUBPROJECTID."'
												AND md.MDDATE between '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."' 
												ORDER BY md.MDDATE ASC
											"; 
						$MedcinDistQueryStatement				= mysql_query($MedcinDistQuery);
						while($MedcinDistQueryStatementData		= mysql_fetch_array($MedcinDistQueryStatement)){	
							$ENTRYDATE_ARRAY[] 					= $MedcinDistQueryStatementData['MDDATE'];
							$i++;
						}
						
						$ENTRYDATE_ARRAY_UNIQUE = array_unique($ENTRYDATE_ARRAY);
						foreach($ENTRYDATE_ARRAY_UNIQUE as $individualDate){
						$EggSell_Query 	= "SELECT sum(es.TOTPRICE) totprice
												FROM pal_egg_sell es
												WHERE es.PROJECTID = '".$PROJECTID."'
												AND es.SUBPROJECTID = '".$SUBPROJECTID."'
												AND es.ESDATE = '".$individualDate."' 
												ORDER BY '".$individualDate."' ASC
											";
						$EggSell_QueryStatement				= mysql_query($EggSell_Query);
						while($EggSell_QueryStatementData	= mysql_fetch_array($EggSell_QueryStatement)){	
							$totprice_eggsell				= $EggSell_QueryStatementData['totprice'];
							
						}
						$totprice_eggsell_global = $totprice_eggsell_global + $totprice_eggsell ;
						
						$mmSell_Query 	= "SELECT SUM(mms.TOTPRICE) totalprice
												FROM pal_morog_murgi_sell mms 
												WHERE mms.PROJECTID = '".$PROJECTID."'
												AND mms.SUBPROJECTID = '".$SUBPROJECTID."'
												AND mms.MMSELLDATE = '".$individualDate."' 
												ORDER BY '".$individualDate."' ASC
											"; 
						$mmSell_QueryStatement					= mysql_query($mmSell_Query);
						while($mmSell_QueryStatementData		= mysql_fetch_array($mmSell_QueryStatement)){	
							$totalprice_mmsell					= $mmSell_QueryStatementData['totalprice'];
							
						}
						$totalprice_mmsell_global = $totalprice_mmsell_global + $totalprice_mmsell ; 
						
						$DailyOp_Query 	= "SELECT sum(dop.SELLPRICE) sellprice
												FROM pal_dailyoperation dop
												WHERE dop.PROJECTID = '".$PROJECTID."'
												AND dop.SUBPROJECTID = '".$SUBPROJECTID."'
												AND dop.DODATE = '".$individualDate."' 
												ORDER BY '".$individualDate."'  ASC
											"; 
						$DailyOp_QueryStatement				= mysql_query($DailyOp_Query);
						while($DailyOp_QueryStatementData	= mysql_fetch_array($DailyOp_QueryStatement)){	
							$sellprice_doper 				= $DailyOp_QueryStatementData['sellprice'];
							
						}
						$sellprice_doper_global = $sellprice_doper_global + $sellprice_doper ;
						
						$VangaEgg_Query 	= "SELECT sum(ves.PRICE) price
												FROM hatch_vangaeggsell ves
												WHERE ves.VESDATE = '".$individualDate."' 
												ORDER BY '".$individualDate."'  ASC
											"; 
						$VangaEgg_QueryStatement				= mysql_query($VangaEgg_Query);
						while($VangaEgg_QueryStatementData		= mysql_fetch_array($VangaEgg_QueryStatement)){	
							$price_vangaegg 					= $VangaEgg_QueryStatementData['price'];
							
						}
						$Global_price_vangaegg = $Global_price_vangaegg + $price_vangaegg ; 
						
						$Exp_Bill_Query 	= "SELECT sum(exp.AMOUNT) amount
												FROM fna_expanse exp 
												WHERE exp.PROJECTID = '".$PROJECTID."'
												AND exp.SUBPROJECTID = '".$SUBPROJECTID."'
												AND exp.EXPDATE = '".$individualDate."' 
												ORDER BY exp.EXPDATE ASC
											"; 
						$Exp_Bill_QueryStatement			= mysql_query($Exp_Bill_Query);
						while($Exp_Bill_QueryStatementData	= mysql_fetch_array($Exp_Bill_QueryStatement)){	
							$AMOUNT_exp		 				= $Exp_Bill_QueryStatementData['amount'];
							
						}
						$AMOUNT_exp_global = $AMOUNT_exp_global + $AMOUNT_exp ;
						
						$batch_price = '';
						
						$Batch_Query 	= "SELECT sum(bo.PRICE) price
												FROM pal_batchopen bo
												WHERE bo.BDATE = '".$individualDate."' 
												ORDER BY '".$individualDate."' ASC
											"; 
						$Batch_QueryStatement				= mysql_query($Batch_Query);
						while($Batch_QueryStatementData		= mysql_fetch_array($Batch_QueryStatement)){	
							$batch_price 					= $Batch_QueryStatementData['price'];
							
						}	
						$batch_price_global = $batch_price_global + $batch_price ;
					
						$FoodDist_Query 	= "SELECT sum(fd.TOTALPRICE) totprice
												FROM pal_fooddistribute fd
												WHERE fd.PROJECTID = '".$PROJECTID."'
												AND fd.SUBPROJECTID = '".$SUBPROJECTID."'
												AND fd.FDDATE = '".$individualDate."' 
												ORDER BY '".$individualDate."'  ASC
											";
						$FoodDist_QueryStatement				= mysql_query($FoodDist_Query);
						while($FoodDist_QueryStatementData		= mysql_fetch_array($FoodDist_QueryStatement)){	
							$totprice_foodDist 					= $FoodDist_QueryStatementData['totprice'];
							
						}
						$totprice_foodDist_global = $totprice_foodDist_global + $totprice_foodDist ;
						
						$MedicinDist_Query 	= "SELECT sum(md.TOTALPRICE) totprice
												FROM pal_medicine md
												WHERE md.PROJECTID = '".$PROJECTID."'
												AND md.SUBPROJECTID = '".$SUBPROJECTID."'
												AND md.MDDATE = '".$individualDate."' 
												ORDER BY '".$individualDate."'  ASC
											"; 
						$MedicinDist_QueryStatement					= mysql_query($MedicinDist_Query);
						while($MedicinDist_QueryStatementData		= mysql_fetch_array($MedicinDist_QueryStatement)){	
							$totprice_medicineDist 					= $MedicinDist_QueryStatementData['totprice'];
							
						}
						
						$OthersIncome_Query 	= "SELECT	sum(oin.INCOMEAMOUNT) INCOMEAMOUNT,
															sum(oin.EXPANSEAMOUNT) EXPANSEAMOUNT
														FROM pal_others_income_expanse oin
														WHERE oin.ENTRYDATE = '".$individualDate."'
														ORDER BY '".$individualDate."'  ASC
													";
						$OthersIncome_QueryStatement				= mysql_query($OthersIncome_Query);
						while($OthersIncome_QueryStatementData		= mysql_fetch_array($OthersIncome_QueryStatement)){	
							$INCOMEAMOUNT_othersIncome				= $OthersIncome_QueryStatementData['INCOMEAMOUNT'];
							$EXPANSEAMOUNT_othersExpanse			= $OthersIncome_QueryStatementData['EXPANSEAMOUNT'];
							
						}
						$Global_Others_Income			= $Global_Others_Income + $INCOMEAMOUNT_othersIncome ; 
						$Global_Others_Expanse			= $Global_Others_Expanse + $EXPANSEAMOUNT_othersExpanse	;
						
						$totprice_medicineDist_global = $totprice_medicineDist_global + $totprice_medicineDist ;
						
						$Total_Amount_income			= $totprice_eggsell + $totalprice_mmsell +  $sellprice_doper + $price_vangaegg + $INCOMEAMOUNT_othersIncome ;
						$Total_Amount_income_global		= $Total_Amount_income_global + $Total_Amount_income ;
						
						$Total_Amount_Expanse		 	= $batch_price + $AMOUNT_exp + $totprice_foodDist +  $totprice_medicineDist + $EXPANSEAMOUNT_othersExpanse ; 
						$Total_Amount_Expanse_global	= $Total_Amount_Expanse_global + $Total_Amount_Expanse ;
						$Net_Profit						= $Total_Amount_income_global - $Total_Amount_Expanse_global ;
							
						$tableView .=" <tr>
											<td width='6%' align='center' valign='top' style='border: 1px dotted #000'>$individualDate</td>

											<td width='6%' align='right' valign='top' style='border: 1px dotted #000'>".number_format($totprice_eggsell,2)."</td>
											
											<td width='8%' align='right' valign='top' style='border: 1px dotted #000'>".number_format($totalprice_mmsell,2)."</td>
					
											<td width='8%' align='right' valign='top' style='border: 1px dotted #000'>".number_format($sellprice_doper,2)."</td>
					
											<td width='8%' align='right' valign='top' style='border: 1px dotted #000'>".number_format($price_vangaegg,2)."</td>
											
											<td width='8%' align='right' valign='top' style='border: 1px dotted #000'>".number_format($INCOMEAMOUNT_othersIncome,2)."</td>
					
											<td width='8%' align='right' valign='top' style='border: 1px dotted #000'>".number_format($EXPANSEAMOUNT_othersExpanse,2)."</td>
											
											<td width='8%' align='right' valign='top' style='border: 1px dotted #000'>".number_format($AMOUNT_exp,2)."</td>
											
											<td width='8%' align='right' valign='top' style='border: 1px dotted #000'>".number_format($batch_price,2)."</td>
					
											<td width='8%' align='right' valign='top' style='border: 1px dotted #000'>".number_format($totprice_foodDist,2)."</td>
					
											<td width='8%' align='right' valign='top' style='border: 1px dotted #000'>".number_format($totprice_medicineDist,2)."</td>
											
											<td width='8%' align='right' valign='top' style='border: 1px dotted #000'>".number_format($Total_Amount_income,2)."</td>
											
											<td width='8%' align='right' valign='top' style='border: 1px dotted #000'>".number_format($Total_Amount_Expanse,2)."</td>
											
											

										</tr>

									 ";

								// Dynamic Row End		  

						
				
				}

					$tableView .="

						<tr style='font-weight:bold;'>

							<td align='right' valign='top' style='border: 1px dotted #000'>Grand Total:</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($totprice_eggsell_global,2)."</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($totalprice_mmsell_global,2)."</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($sellprice_doper_global,2)."</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_price_vangaegg,2)."</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_Others_Income,2)."</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_Others_Expanse,2)."</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($AMOUNT_exp_global,2)."</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($batch_price_global,2)."</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($totprice_foodDist_global,2)."</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($totprice_medicineDist_global,2)."</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Total_Amount_income_global,2)."</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Total_Amount_Expanse_global,2)."</td>

							
						</tr>
						<tr>

							<td colspan='13' align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

						</tr>
							
						<tr>

							<td colspan='13' align='left' valign='top'>&nbsp;</td>

						</tr>
						<tr>

							<td colspan='13' align='center' valign='top' >
								<table width='50%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:100%;'>
								  <tr>
									<td align='right' width='50%' style='border: 1px dotted #000'>Total Income</td>
									<td width='2%' style='border: 1px dotted #000'>:</td>
									<td width='48%' style='border: 1px dotted #000'>".number_format($Total_Amount_income_global,2)."</td>
								  </tr>
								  <tr>
									<td align='right' width='50%' style='border: 1px dotted #000'>Total Expanse </td>
									<td width='2%' style='border: 1px dotted #000'>:</td>
									<td width='48%' style='border: 1px dotted #000'>".number_format($Total_Amount_Expanse_global,2)."</td>
								  </tr>
								  <tr>
									<td align='right' width='50%' style='border: 1px dotted #000'>Net Profit / Loss</td>
									<td width='2%' style='border: 1px dotted #000'>:</td>
									<td width='48%' style='border: 1px dotted #000'>".number_format($Net_Profit,2)."</td>
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
						<tr>

							<td colspan='13' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='6' align='left' valign='top' >
								<table width='100%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:100%;'>
								  <tr>
									<td align='right' width='34%' valign='bottom' ><hr width='200' ></td>
									<td width='33%' valign='bottom' ><hr width='200' ></td>
									<td width='33%' valign='bottom' ><hr width='200' ></td>
								  </tr>
								  <tr>
									<td align='center' valign='top'  ><b>Store Keeper Signature</b></td>
									<td  align='center' valign='top'  ><b>AGM Signature</b></td>
									<td align='center' valign='top'  ><b>GM Signature</b></td>
								  </tr>
								 </table>
							</td>

						</tr>
						<tr>

							<td colspan='6' align='left' valign='top' >&nbsp;</td>

						</tr>
						<tr>

							<td colspan='6' align='left' valign='top' >&nbsp;</td>

						</tr>					

					</table>";
	echo $tableView;
									
?>