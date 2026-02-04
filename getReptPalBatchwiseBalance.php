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
	$BATCHNO			= $_REQUEST['BATCHNO'];

	$ENTRYDATE_FROM 	= showDateMySQlFormat($_REQUEST['ENTRYDATE']);
	$ENTRYDATE_TO 		= showDateMySQlFormat($_REQUEST['ENTRYDATE2']);
	$userId 			= $_REQUEST['userId'];
	
	if ($BATCHNO == 'All'){
		$con = '';
	}else{
		$con = "AND es.BATCHNO='".$BATCHNO."' ";
	}
	
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
	$tableView .="<table width='70%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:85%; border: 1px dotted #000'>

					  <tr>
                            <td style='text-align:right;' colspan='13'>
                            <a href='javascript:Clickheretoprint()'><img border='0' src='images/print_icon.jpg' width='40' height='26' /></a>                        
                            </td>
                     </tr>
					  <tr>
						<td colspan='18' align='center' valign='middle' style='border: 1px dotted #000'>
							<center><b><font size=5>F N A Group Of Company</font></b></center>
							<center>&nbsp;</center>
							<center><b><font size=4>Batch Wise Balance Sheet Report   (Poultry Firm)</FONT></b></center>
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

						<td align='center' valign='middle' style='font-weight:bold;border: 1px dotted #000'>Batch No.</td>

						<td align='center' valign='middle' style='border: 1px dotted #000'>Prev. Income</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Today's Income </td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'> Total Income </td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Prev. Expanse</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Today's Expanse</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Total Expanse</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Today's Balance</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Profit / Loss </td>
						
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
						$Global_othersIncome = 0;
						$Global_othersExp = 0;
						$Global_Previous_Income = 0;
						$Global_Previous_Expanse = 0;
						$Global_Net_Profit = 0;
						$Global_Todays_Balance = 0;
						$Todays_Balance = 0;
						$Global_Total_Expanse = 0;
						$Global_Todays_Expanse = 0;
						$Total_Expanse = 0;
						$Todays_Expanse	 = 0;
						$Previous_Expanse = 0;
						$Global_Todays_Income = 0;
						$Global_Total_Income = 0;
						$Total_Income = 0;
						$Todays_Income = 0;
						$Previous_Income = 0;
						$i = 0;
						
						
						$EgSellQuery 	= "SELECT es.BATCHNO
												FROM pal_egg_sell es 
												WHERE es.PROJECTID = '".$PROJECTID."'
												AND es.SUBPROJECTID = '".$SUBPROJECTID."'
												{$con}
												
											";
						$EgSellQueryStatement				= mysql_query($EgSellQuery);
						while($EgSellQueryStatementData		= mysql_fetch_array($EgSellQueryStatement)){	
							$BATCHNO_ARRAY[] 				= $EgSellQueryStatementData['BATCHNO'];
							$i++;
						}
							
						if ($BATCHNO == 'All'){
							$con_mms = '';
						}else{
							$con_mms = "AND mms.BATCHNO='".$BATCHNO."' ";
						}
						$MMsellQuery 	= "SELECT mms.BATCHNO
												FROM pal_morog_murgi_sell mms 
												WHERE mms.PROJECTID = '".$PROJECTID."'
												AND mms.SUBPROJECTID = '".$SUBPROJECTID."'
												{$con_mms} 
												ORDER BY mms.BATCHNO ASC
											"; 
						$MMsellQueryStatement			= mysql_query($MMsellQuery);
						while($MMsellQueryStatementData	= mysql_fetch_array($MMsellQueryStatement)){	
							$BATCHNO_ARRAY[] 			= $MMsellQueryStatementData['BATCHNO'];
							$i++;
						}
						
						if ($BATCHNO == 'All'){
							$con_dop = '';
						}else{
							$con_dop = "AND dop.BATCHNO='".$BATCHNO."' ";
						}
						$DailyOpQuery 	= "SELECT dop.BATCHNO
												FROM pal_dailyoperation dop 
												WHERE dop.PROJECTID = '".$PROJECTID."'
												AND dop.SUBPROJECTID = '".$SUBPROJECTID."'
												{$con_dop} 
												ORDER BY dop.BATCHNO ASC
											"; 
						$DailyOpQueryStatement				= mysql_query($DailyOpQuery);
						while($DailyOpQueryStatementData	= mysql_fetch_array($DailyOpQueryStatement)){	
							$BATCHNO_ARRAY[] 				= $DailyOpQueryStatementData['BATCHNO'];
							$i++;
						}
						if ($BATCHNO == 'All'){
							$con_oin = '';
						}else{
							$con_oin = "AND oin.BATCHNO='".$BATCHNO."' ";
						}
						$OthersIncomeQuery 	= "SELECT oin.BATCHNO
												FROM pal_others_income_expanse oin 
												WHERE 1=1
												{$con_oin} 
												ORDER BY oin.BATCHNO ASC
											";
						$OthersIncomeQueryStatement				= mysql_query($OthersIncomeQuery);
						while($OthersIncomeQueryStatementData	= mysql_fetch_array($OthersIncomeQueryStatement)){	
							$BATCHNO_ARRAY[] 					= $OthersIncomeQueryStatementData['BATCHNO'];
							$i++;
						}
						/*if ($BATCHNO == 'All'){
							$con_ex = '';
						}else{
							$con_ex = "AND ex.BATCHNO='".$BATCHNO."' ";
						}
						$ExpQuery 	= "SELECT ex.BATCHNO
												FROM fna_expanse ex 
												WHERE ex.PROJECTID = '".$PROJECTID."'
												AND ex.SUBPROJECTID = '".$SUBPROJECTID."'
												{$con_ex} 
												ORDER BY ex.BATCHNO ASC
											"; 
						$ExpQueryStatement			= mysql_query($ExpQuery);
						while($ExpQueryStatementData	= mysql_fetch_array($ExpQueryStatement)){	
							$BATCHNO_ARRAY[] = $ExpQueryStatementData['BATCHNO'];
							$i++;
						}*/
						if ($BATCHNO == 'All'){
							$con_bo = '';
						}else{
							$con_bo = "AND bo.BATCHNO='".$BATCHNO."' ";
						}
						$BatchQuery 	= "SELECT 	bo.BATCHNO
												FROM pal_batchopen bo 
												WHERE bo.PROJECTID = '".$PROJECTID."'
												AND bo.SUBPROJECTID = '".$SUBPROJECTID."'
												{$con_bo}
												ORDER BY bo.BATCHNO ASC
											"; 
						$BatchQueryStatement			= mysql_query($BatchQuery);
						$i = 0;
						while($BatchQueryStatementData	= mysql_fetch_array($BatchQueryStatement)){	
							$BATCHNO_ARRAY[]			= $BatchQueryStatementData['BATCHNO'];
							$i++;
						}
						
						if ($BATCHNO == 'All'){
							$con_fd = '';
						}else{
							$con_fd = "AND fd.BATCHNO='".$BATCHNO."' ";
						}
						
						$FoodDistQuery 	= "SELECT fd.BATCHNO
												FROM pal_fooddistribute fd 
												WHERE fd.PROJECTID = '".$PROJECTID."'
												AND fd.SUBPROJECTID = '".$SUBPROJECTID."'
												{$con_fd} 
												ORDER BY fd.BATCHNO ASC
											"; 
						$FoodDistQueryStatement				= mysql_query($FoodDistQuery);
						while($FoodDistQueryStatementData	= mysql_fetch_array($FoodDistQueryStatement)){	
							$BATCHNO_ARRAY[] 				= $FoodDistQueryStatementData['BATCHNO'];
							$i++;
						}
						if ($BATCHNO == 'All'){
							$con_md = '';
						}else{
							$con_md = "AND md.BATCHNO='".$BATCHNO."' ";
						}
						$MedcinDistQuery 	= "SELECT md.BATCHNO
												FROM pal_medicine md 
												WHERE md.PROJECTID = '".$PROJECTID."'
												AND md.SUBPROJECTID = '".$SUBPROJECTID."'
												{$con_md}
												ORDER BY md.BATCHNO ASC
											"; 
						$MedcinDistQueryStatement				= mysql_query($MedcinDistQuery);
						while($MedcinDistQueryStatementData		= mysql_fetch_array($MedcinDistQueryStatement)){	
							$BATCHNO_ARRAY[] 					= $MedcinDistQueryStatementData['BATCHNO'];
							$i++;
						}
						
						$BATCHNO_ARRAY_UNIQUE = array_unique($BATCHNO_ARRAY);
						foreach($BATCHNO_ARRAY_UNIQUE as $individualBatch){
						$EggSell_Query 	= "SELECT sum(es.TOTPRICE) totprice
												FROM pal_egg_sell es
												WHERE es.PROJECTID = '".$PROJECTID."'
												AND es.SUBPROJECTID = '".$SUBPROJECTID."'
												AND es.ESDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$LastDay."'
												AND es.BATCHNO = '".$individualBatch."' 
												ORDER BY '".$individualBatch."' ASC
											";
						$EggSell_QueryStatement				= mysql_query($EggSell_Query);
						while($EggSell_QueryStatementData	= mysql_fetch_array($EggSell_QueryStatement)){	
							$totprice_eggsell				= $EggSell_QueryStatementData['totprice'];
							
						}
						$totprice_eggsell_global = $totprice_eggsell_global + $totprice_eggsell ;
						
						//--------------------------------Todays Query-----------------------------------------
						$EggSell_Query_Todays 	= "SELECT sum(es.TOTPRICE) totprice
															FROM pal_egg_sell es
															WHERE es.PROJECTID = '".$PROJECTID."'
															AND es.SUBPROJECTID = '".$SUBPROJECTID."'
															AND es.ESDATE ='".$ENTRYDATE_TO."'
															AND es.BATCHNO = '".$individualBatch."' 
															ORDER BY '".$individualBatch."' ASC
														";
						$EggSell_Query_TodaysStatement				= mysql_query($EggSell_Query_Todays);
						while($EggSell_Query_TodaysStatementData	= mysql_fetch_array($EggSell_Query_TodaysStatement)){	
							$totprice_eggsell_Today					= $EggSell_Query_TodaysStatementData['totprice'];
							
						}
						$totprice_eggsell_global = $totprice_eggsell_global + $totprice_eggsell ;
						//-----------------------------------------------------------------------------------------
						
						$mmSell_Query 	= "SELECT SUM(mms.TOTPRICE) totalprice
												FROM pal_morog_murgi_sell mms 
												WHERE mms.PROJECTID = '".$PROJECTID."'
												AND mms.SUBPROJECTID = '".$SUBPROJECTID."'
												AND mms.MMSELLDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$LastDay."'
												AND mms.BATCHNO = '".$individualBatch."' 
												ORDER BY '".$individualBatch."' ASC
											"; 
						$mmSell_QueryStatement					= mysql_query($mmSell_Query);
						while($mmSell_QueryStatementData		= mysql_fetch_array($mmSell_QueryStatement)){	
							$totalprice_mmsell					= $mmSell_QueryStatementData['totalprice'];
							
						}
						$totalprice_mmsell_global = $totalprice_mmsell_global + $totalprice_mmsell ; 
						
						//--------------------------------Todays Query-----------------------------------------
						
						$mmSell_Query_Today 	= "SELECT SUM(mms.TOTPRICE) totalprice
																FROM pal_morog_murgi_sell mms 
																WHERE mms.PROJECTID = '".$PROJECTID."'
																AND mms.SUBPROJECTID = '".$SUBPROJECTID."'
																AND mms.MMSELLDATE = '".$ENTRYDATE_TO."'
																AND mms.BATCHNO = '".$individualBatch."' 
																ORDER BY '".$individualBatch."' ASC
															"; 
						$mmSell_Query_TodayStatement				= mysql_query($mmSell_Query_Today);
						while($mmSell_Query_TodayStatementData		= mysql_fetch_array($mmSell_Query_TodayStatement)){	
							$totalprice_mmsell_Today				= $mmSell_Query_TodayStatementData['totalprice'];
							
						}
						$totalprice_mmsell_global = $totalprice_mmsell_global + $totalprice_mmsell ; 
						//-------------------------------------------------------------------------------------
						$DailyOp_Query 	= "SELECT sum(dop.SELLPRICE) sellprice
												FROM pal_dailyoperation dop
												WHERE dop.PROJECTID = '".$PROJECTID."'
												AND dop.SUBPROJECTID = '".$SUBPROJECTID."'
												AND dop.DODATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$LastDay."'
												AND dop.BATCHNO = '".$individualBatch."' 
												ORDER BY '".$individualBatch."'  ASC
											"; 
						$DailyOp_QueryStatement				= mysql_query($DailyOp_Query);
						while($DailyOp_QueryStatementData	= mysql_fetch_array($DailyOp_QueryStatement)){	
							$sellprice_doper 				= $DailyOp_QueryStatementData['sellprice'];
							
						}
						$sellprice_doper_global = $sellprice_doper_global + $sellprice_doper ;
						
						//--------------------------------Todays Query-----------------------------------------
						
						$DailyOp_Query_Today 	= "SELECT sum(dop.SELLPRICE) sellprice
															FROM pal_dailyoperation dop
															WHERE dop.PROJECTID = '".$PROJECTID."'
															AND dop.SUBPROJECTID = '".$SUBPROJECTID."'
															AND dop.DODATE = '".$ENTRYDATE_TO."' 
															AND dop.BATCHNO = '".$individualBatch."' 
															ORDER BY '".$individualBatch."'  ASC
														"; 
						$DailyOp_Query_TodayStatement				= mysql_query($DailyOp_Query_Today);
						while($DailyOp_Query_TodayStatementData		= mysql_fetch_array($DailyOp_Query_TodayStatement)){	
							$sellprice_doper_Today					= $DailyOp_Query_TodayStatementData['sellprice'];
							
						}
						$sellprice_doper_global = $sellprice_doper_global + $sellprice_doper ;
						//-------------------------------------------------------------------------------------
						
						$OthersIncome_Query 	= "SELECT sum(oin.INCOMEAMOUNT) INCOMEAMOUNT
												FROM pal_others_income_expanse oin
												WHERE oin.BATCHNO = '".$individualBatch."' 
												AND oin.ENTRYDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$LastDay."'
												ORDER BY '".$individualBatch."'  ASC
											"; 
						$OthersIncome_QueryStatement				= mysql_query($OthersIncome_Query);
						while($OthersIncome_QueryStatementData		= mysql_fetch_array($OthersIncome_QueryStatement)){	
							echo $INCOMEAMOUNT_othersIncome				= $OthersIncome_QueryStatementData['INCOMEAMOUNT'];echo '</br>';
							
						}
						$Global_othersIncome 	= $Global_othersIncome + $INCOMEAMOUNT_othersIncome ; 
						
						//--------------------------------Todays Query-----------------------------------------
						
						$OthersIncome_Query_Today 	= "SELECT sum(oin.INCOMEAMOUNT) INCOMEAMOUNT
																FROM pal_others_income_expanse oin
																WHERE oin.BATCHNO = '".$individualBatch."' 
																AND oin.ENTRYDATE = '".$ENTRYDATE_TO."' 
																ORDER BY '".$individualBatch."'  ASC
															"; 
						$OthersIncome_Query_TodayStatement					= mysql_query($OthersIncome_Query_Today);
						while($OthersIncome_Query_TodayStatementData		= mysql_fetch_array($OthersIncome_Query_TodayStatement)){	
							$INCOMEAMOUNT_othersIncome_Today				= $OthersIncome_Query_TodayStatementData['INCOMEAMOUNT'];
							
						}
						$Global_othersIncome 	= $Global_othersIncome + $INCOMEAMOUNT_othersIncome ; 
						//-------------------------------------------------------------------------------------
						$Previous_Income		= $totprice_eggsell + $totalprice_mmsell + $sellprice_doper + $INCOMEAMOUNT_othersIncome ; 
						$Todays_Income			= $totprice_eggsell_Today + $totalprice_mmsell_Today + $sellprice_doper_Today + $INCOMEAMOUNT_othersIncome_Today ; 
						$Total_Income			= $Previous_Income + $Todays_Income ; 
						
						$Global_Previous_Income	= $Global_Previous_Income + $Previous_Income ; 
						$Global_Todays_Income	= $Global_Todays_Income + $Todays_Income ; 
						$Global_Total_Income	= $Global_Total_Income + $Total_Income ; 
						
						$OthersExp_Query 	= "SELECT sum(oin.EXPANSEAMOUNT) EXPANSEAMOUNT
												FROM pal_others_income_expanse oin
												WHERE oin.BATCHNO = '".$individualBatch."' 
												AND oin.ENTRYDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$LastDay."'
												ORDER BY '".$individualBatch."'  ASC
											"; 
						$OthersExp_QueryStatement				= mysql_query($OthersExp_Query);
						while($OthersExp_QueryStatementData		= mysql_fetch_array($OthersExp_QueryStatement)){	
							$EXPANSEAMOUNT_othersExp			= $OthersExp_QueryStatementData['EXPANSEAMOUNT'];
							
						}
						$Global_othersExp	 = $Global_othersExp + $EXPANSEAMOUNT_othersExp ; 
						//--------------------------------Todays Expanse Query Start-----------------------------------------
						
						$OthersExp_Query_Todays 	= "SELECT sum(oin.EXPANSEAMOUNT) EXPANSEAMOUNT
																FROM pal_others_income_expanse oin
																WHERE oin.BATCHNO = '".$individualBatch."' 
																AND oin.ENTRYDATE = '".$ENTRYDATE_TO."'
																ORDER BY '".$individualBatch."'  ASC
															"; 
						$OthersExp_Query_TodaysStatement				= mysql_query($OthersExp_Query_Todays);
						while($OthersExp_Query_TodaysStatementData		= mysql_fetch_array($OthersExp_Query_TodaysStatement)){	
							$EXPANSEAMOUNT_othersExp_Todays				= $OthersExp_Query_TodaysStatementData['EXPANSEAMOUNT'];
							
						}
						$Global_othersExp	 = $Global_othersExp + $EXPANSEAMOUNT_othersExp ; 
						//--------------------------------------Todays Expanse Query End ----------------------------------
						/*$Exp_Bill_Query 	= "SELECT sum(exp.AMOUNT) amount
												FROM fna_expanse exp 
												WHERE exp.PROJECTID = '".$PROJECTID."'
												AND exp.SUBPROJECTID = '".$SUBPROJECTID."'
												AND exp.BATCHNO = '".$individualBatch."' 
												ORDER BY exp.BATCHNO ASC
											"; 
						$Exp_Bill_QueryStatement			= mysql_query($Exp_Bill_Query);
						while($Exp_Bill_QueryStatementData	= mysql_fetch_array($Exp_Bill_QueryStatement)){	
							$AMOUNT_exp		 				= $Exp_Bill_QueryStatementData['amount'];
							
						}
						$AMOUNT_exp_global = $AMOUNT_exp_global + $AMOUNT_exp ;*/
						
						$batch_price = '';
						
						$Batch_Query 	= "SELECT sum(bo.PRICE) price
												FROM pal_batchopen bo
												WHERE bo.BATCHNO = '".$individualBatch."' 
												AND bo.BDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$LastDay."'
												ORDER BY '".$individualBatch."' ASC
											"; 
						$Batch_QueryStatement				= mysql_query($Batch_Query);
						while($Batch_QueryStatementData		= mysql_fetch_array($Batch_QueryStatement)){	
							$batch_price 					= $Batch_QueryStatementData['price'];
							
						}	
						$batch_price_global = $batch_price_global + $batch_price ;
						
						//--------------------------------Todays Expanse Query Start-----------------------------------------
						$Batch_Query_Today 	= "SELECT sum(bo.PRICE) price
														FROM pal_batchopen bo
														WHERE bo.BATCHNO = '".$individualBatch."' 
														AND bo.BDATE = '".$ENTRYDATE_TO."'
														ORDER BY '".$individualBatch."' ASC
													"; 
						$Batch_Query_TodayStatement					= mysql_query($Batch_Query_Today);
						while($Batch_Query_TodayStatementData		= mysql_fetch_array($Batch_Query_TodayStatement)){	
							$batch_price_Today						= $Batch_Query_TodayStatementData['price'];
							
						}	
						$batch_price_global = $batch_price_global + $batch_price ;
						
						//--------------------------------------Todays Expanse Query End ----------------------------------
						
						$FoodDist_Query 	= "SELECT sum(fd.TOTALPRICE) totprice
														FROM pal_fooddistribute fd
														WHERE fd.PROJECTID = '".$PROJECTID."'
														AND fd.SUBPROJECTID = '".$SUBPROJECTID."'
														AND fd.FDDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$LastDay."'
														AND fd.BATCHNO = '".$individualBatch."' 
														ORDER BY '".$individualBatch."'  ASC
													";
						$FoodDist_QueryStatement				= mysql_query($FoodDist_Query);
						while($FoodDist_QueryStatementData		= mysql_fetch_array($FoodDist_QueryStatement)){	
							$totprice_foodDist 					= $FoodDist_QueryStatementData['totprice'];
							
						}
						$totprice_foodDist_global = $totprice_foodDist_global + $totprice_foodDist ;
						
						//--------------------------------Todays Expanse Query Start-----------------------------------------
						
						$FoodDist_Query_Today 	= "SELECT sum(fd.TOTALPRICE) totprice
														FROM pal_fooddistribute fd
														WHERE fd.PROJECTID = '".$PROJECTID."'
														AND fd.SUBPROJECTID = '".$SUBPROJECTID."'
														AND fd.FDDATE = '".$ENTRYDATE_TO."' 
														AND fd.BATCHNO = '".$individualBatch."' 
														ORDER BY '".$individualBatch."'  ASC
													";
						$FoodDist_Query_TodayStatement					= mysql_query($FoodDist_Query_Today);
						while($FoodDist_Query_TodayStatementData		= mysql_fetch_array($FoodDist_Query_TodayStatement)){	
							$totprice_foodDist_Today 					= $FoodDist_Query_TodayStatementData['totprice'];
							
						}
						$totprice_foodDist_global = $totprice_foodDist_global + $totprice_foodDist ;
						
						//-----------------------------------------------End ----------------------------------------------------
						
						$MedicinDist_Query 	= "SELECT sum(md.TOTALPRICE) totprice
												FROM pal_medicine md
												WHERE md.PROJECTID = '".$PROJECTID."'
												AND md.SUBPROJECTID = '".$SUBPROJECTID."'
												AND md.MDDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$LastDay."'
												AND md.BATCHNO = '".$individualBatch."' 
												ORDER BY '".$individualBatch."'  ASC
											"; 
						$MedicinDist_QueryStatement					= mysql_query($MedicinDist_Query);
						while($MedicinDist_QueryStatementData		= mysql_fetch_array($MedicinDist_QueryStatement)){	
							$totprice_medicineDist 					= $MedicinDist_QueryStatementData['totprice'];
							
						}
						$totprice_medicineDist_global = $totprice_medicineDist_global + $totprice_medicineDist ;
						
						//--------------------------------Todays Expanse Query Start-----------------------------------------
						
						$MedicinDist_Query_Today 	= "SELECT sum(md.TOTALPRICE) totprice
															FROM pal_medicine md
															WHERE md.PROJECTID = '".$PROJECTID."'
															AND md.SUBPROJECTID = '".$SUBPROJECTID."'
															AND md.MDDATE = '".$ENTRYDATE_TO."' 
															AND md.BATCHNO = '".$individualBatch."' 
															ORDER BY '".$individualBatch."'  ASC
														"; 
						$MedicinDist_Query_TodayStatement					= mysql_query($MedicinDist_Query_Today);
						while($MedicinDist_Query_TodayStatementData			= mysql_fetch_array($MedicinDist_Query_TodayStatement)){	
							$totprice_medicineDist_Today 					= $MedicinDist_Query_TodayStatementData['totprice'];
							
						}
						$totprice_medicineDist_global = $totprice_medicineDist_global + $totprice_medicineDist ;
						
						//--------------------------------------End --------------------------------------------------------------
						
						$Previous_Expanse		= $batch_price + $totprice_foodDist + $totprice_medicineDist + $EXPANSEAMOUNT_othersExp ; 
						$Todays_Expanse			= $batch_price_Today + $totprice_foodDist_Today + $totprice_medicineDist_Today + $EXPANSEAMOUNT_othersExp_Todays ; 
						$Total_Expanse			= $Previous_Expanse + $Todays_Expanse ; 
						
						$Global_Previous_Expanse 	= $Global_Previous_Expanse + $Previous_Expanse ; 
						$Global_Todays_Expanse		= $Global_Todays_Expanse + $Todays_Expanse ; 
						$Global_Total_Expanse		= $Global_Total_Expanse + $Total_Expanse ; 
						
						
						$Todays_Balance			= $Todays_Income - $Todays_Expanse ; 
						
						$Net_Profit				= $Total_Income - $Total_Expanse ; 
						
						$Global_Todays_Balance		= $Global_Todays_Balance + $Todays_Balance	;
						$Global_Net_Profit			= $Global_Net_Profit + $Net_Profit	;
							
						$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000'>$individualBatch</td>

											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Previous_Income,2)."</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Todays_Income,2)."</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Total_Income,2)."</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Previous_Expanse,2)."</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Todays_Expanse,2)."</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Total_Expanse,2)."</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Todays_Balance,2)."</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Net_Profit,2)."</td>
											
											
										</tr>

									 ";

								// Dynamic Row End		  

						
				
				}

					$tableView .="

						<tr style='font-weight:bold;'>

							<td align='right' valign='top' style='border: 1px dotted #000'>Grand Total:</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_Previous_Income,2)."</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_Todays_Income,2)."</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_Total_Income,2)."</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_Previous_Expanse,2)."</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_Todays_Expanse,2)."</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_Total_Expanse,2)."</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_Todays_Balance,2)."</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_Net_Profit,2)."</td>
							
							
						</tr>
						<tr>

							<td colspan='11' align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

						</tr>
							
						<tr>

							<td colspan='11' align='left' valign='top'>&nbsp;</td>

						</tr>
						<tr>

							<td colspan='11' align='center' valign='top' >
								<table width='50%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:100%;'>
								  <tr>
									<td align='right' width='50%' style='border: 1px dotted #000'>Total Income</td>
									<td width='2%' style='border: 1px dotted #000'>:</td>
									<td width='48%' style='border: 1px dotted #000'>".number_format($Global_Total_Income,2)."</td>
								  </tr>
								  <tr>
									<td align='right' width='50%' style='border: 1px dotted #000'>Total Expanse </td>
									<td width='2%' style='border: 1px dotted #000'>:</td>
									<td width='48%' style='border: 1px dotted #000'>".number_format($Global_Total_Expanse,2)."</td>
								  </tr>
								  <tr>
									<td align='right' width='50%' style='border: 1px dotted #000'>Net Profit / Loss</td>
									<td width='2%' style='border: 1px dotted #000'>:</td>
									<td width='48%' style='border: 1px dotted #000'>".number_format($Global_Net_Profit,2)."</td>
								  </tr>
								</table>
							</td>

						</tr>	
						<tr>

							<td colspan='11' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='11' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='11' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='11' align='left' valign='top' >
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