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
	$tableView .="<table width='85%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:85%; border: 1px dotted #000'>

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

						<td rowspan=1' align='center' valign='middle' style='border: 1px dotted #000'>&nbsp;</td>

						<td colspan=3' align='center' valign='middle' style='border: 1px dotted #000'>Income</td>
						
						<td colspan='3' align='center' valign='middle' style='border: 1px dotted #000'>Expanse</td>
						
						<td colspan='2' align='center' valign='middle' style='border: 1px dotted #000'>Total</td>
						
					  </tr>

					  <tr style='font-weight:bold;'>

						<td align='center' valign='middle' style='font-weight:bold;border: 1px dotted #000'>Date</td>

						<td align='center' valign='middle' style='border: 1px dotted #000'>Chicken sell</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'> Others Income </td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'> Vanga Eggsell </td>

						<td align='center' valign='middle' style='border: 1px dotted #000'>Head wise Exp</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Egg Buy</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Others Expanse</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Total Income</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Total Expanse</td>
						
						</tr>";

// Query here.
						
						//$TOTAL_RECEIVE_QNTY_KG ='';
						$ENTRYDATE_ARRAY = array();
						$batch_price_global = 0;	
						$price_chicksell_global = '';
						$OpenHatchEgg_price_global = 0;
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
						$i = 0;
						
						
						$ChickenSellQuery 	= "SELECT hcp.CPDATE
												FROM hatch_chicken_production hcp 
												WHERE hcp.PROJECTID = '".$PROJECTID."'
												AND hcp.SUBPROJECTID = '".$SUBPROJECTID."'
												AND hcp.CPDATE between '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."' 
												ORDER BY hcp.CPDATE ASC
											";
						$ChickenSellQueryStatement				= mysql_query($ChickenSellQuery);
						while($ChickenSellQueryStatementData	= mysql_fetch_array($ChickenSellQueryStatement)){	
							$ENTRYDATE_ARRAY[] 					= $ChickenSellQueryStatementData['CPDATE'];
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
						$OpenHatchQuery 	= "SELECT 	ohe.OPENDATE
												FROM hatch_opening_hatching_egg ohe 
												WHERE ohe.PROJECTID = '".$PROJECTID."'
												AND ohe.SUBPROJECTID = '".$SUBPROJECTID."'
												AND ohe.OPENDATE between '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."' 
												ORDER BY ohe.OPENDATE ASC
											"; 
						$OpenHatchQueryStatement			= mysql_query($OpenHatchQuery);
						$i = 0;
						while($OpenHatchQueryStatementData	= mysql_fetch_array($OpenHatchQueryStatement)){	
							$ENTRYDATE_ARRAY[]				= $OpenHatchQueryStatementData['OPENDATE'];
							$i++;
						}
						
						$ENTRYDATE_ARRAY_UNIQUE = array_unique($ENTRYDATE_ARRAY);
						foreach($ENTRYDATE_ARRAY_UNIQUE as $individualDate){
						$ChickenSell_Query 	= "SELECT sum(hcp.PRICE) price
												FROM hatch_chicken_production hcp 
												WHERE hcp.PROJECTID = '".$PROJECTID."'
												AND hcp.SUBPROJECTID = '".$SUBPROJECTID."'
												AND hcp.CPDATE = '".$individualDate."' 
												AND hcp.WORKSFLAG = 'Out'
												ORDER BY '".$individualDate."' ASC
											";
						$ChickenSell_QueryStatement				= mysql_query($ChickenSell_Query);
						while($ChickenSell_QueryStatementData	= mysql_fetch_array($ChickenSell_QueryStatement)){	
							$price_chicksell					= $ChickenSell_QueryStatementData['price'];
							
						}
						$price_chicksell_global = $price_chicksell_global + $price_chicksell ;
						
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
						
						$OpenHatch_Query 	= "SELECT sum(ohe.PRICE) price
												FROM hatch_opening_hatching_egg ohe
												WHERE ohe.PROJECTID = '".$PROJECTID."'
												AND ohe.SUBPROJECTID = '".$SUBPROJECTID."'
												AND ohe.OPENDATE = '".$individualDate."' 
												AND ohe.STATUS = 'In'
												ORDER BY '".$individualDate."' ASC
											"; 
						$OpenHatch_QueryStatement				= mysql_query($OpenHatch_Query);
						while($OpenHatch_QueryStatementData		= mysql_fetch_array($OpenHatch_QueryStatement)){	
							$OpenHatchEgg_price					= $OpenHatch_QueryStatementData['price'];
							
						}	
						$OpenHatchEgg_price_global = $OpenHatchEgg_price_global + $OpenHatchEgg_price ;
						
						$Total_Amount_income			= $price_chicksell + $price_vangaegg;
						$Total_Amount_income_global		= $Total_Amount_income_global + $Total_Amount_income ;
						
						$Total_Amount_Expanse		 	= $OpenHatchEgg_price + $AMOUNT_exp ; 
						$Total_Amount_Expanse_global	= $Total_Amount_Expanse_global + $Total_Amount_Expanse ;
						$Net_Profit						= $Total_Amount_income_global - $Total_Amount_Expanse_global ;
							
						$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000'>$individualDate</td>

											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($price_chicksell,2)."</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'></td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($price_vangaegg,2)."</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($AMOUNT_exp,2)."</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($OpenHatchEgg_price,2)."</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'></td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Total_Amount_income,2)."</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Total_Amount_Expanse,2)."</td>
											
											

										</tr>

									 ";

								// Dynamic Row End		  

						
				
				}

					$tableView .="

						<tr style='font-weight:bold;'>

							<td align='right' valign='top' style='border: 1px dotted #000'>Grand Total:</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($price_chicksell_global,2)."</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'></td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_price_vangaegg,2)."</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($AMOUNT_exp_global,2)."</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($OpenHatchEgg_price_global,2)."</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'></td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Total_Amount_income_global,2)."</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Total_Amount_Expanse_global,2)."</td>

							
						</tr>
						<tr>

							<td colspan='9' align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

						</tr>
							
						<tr>

							<td colspan='9' align='left' valign='top'>&nbsp;</td>

						</tr>
						<tr>

							<td colspan='9' align='center' valign='top' >
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

							<td colspan='9' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='9' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='9' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='9' align='left' valign='top' >
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

							<td colspan='9' align='left' valign='top' >&nbsp;</td>

						</tr>
						<tr>

							<td colspan='9' align='left' valign='top' >&nbsp;</td>

						</tr>					

					</table>";
	echo $tableView;
									
?>