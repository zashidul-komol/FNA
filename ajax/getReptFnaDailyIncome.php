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

	$PROJECTID			= $_REQUEST['PROJECTID'];
	$SUBPROJECTID		= $_REQUEST['SUBPROJECTID'];
	$ENTRYDATE			= insertDateMySQlFormat($_REQUEST["ENTRYDATE"]);echo '</br>';
	
 	/*//$date = "1998-08-14";
	$newdate = strtotime ( '-1 day' , strtotime ( $ENTRYDATE ) ) ;
	$newdate = date ( 'Y-m-j' , $newdate );
	 
	//echo $newdate;
	$k = 5;
	for ($i= $newdate;   $i < $newdate; $i-- )
	{
		echo $newdate;
		$k--;
	}
	echo 'komol';*/
	$userId 			= $_REQUEST['userId'];

	$sql = "SELECT ENTRYDATE 
			FROM fna_cashinhand
			WHERE user_id = '$userId'
			AND ENTRYDATE < '$ENTRYDATE'
			ORDER BY ENTRYDATE DESC
			LIMIT 1	";

	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);

	$LastDay = $row['ENTRYDATE'];
	//$LastDay = date_format($LastDayFinal, 'Y-m-d');
	
	$Last_Date = date_create($ENTRYDATE);
	date_sub($Last_Date, date_interval_create_from_date_string('1 days'));
	//$LastDay = date_format($Last_Date, 'Y-m-d');

	$WhereQ = '';
	
	if ($_REQUEST['PROJECTID']!=''){
		if($_REQUEST['PROJECTID']=='All'){
			$WhereQ .= '';
		}else{
			$WhereQ .= "AND PROJECTID = '".$PROJECTID."'";
		}
		
	}
	if ($_REQUEST['SUBPROJECTID']!=''){
		if($_REQUEST['SUBPROJECTID']=='All'){
			$WhereQ .= '';
		}else{
			$WhereQ .= "AND SUBPROJECTID = '".$SUBPROJECTID."'";
		}
		
	}
	
	
	
	//$YESTERDAY_BALANCE;
			//Ministry/Division and Project/Programme Name View Report End
			
	$tableView = "";	
	$tableView .="<table width='70%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:85%; border: 1px dotted #000'>
					<tr>
                            <td style='text-align:right;' colspan='18'>
                            <a href='javascript:Clickheretoprint()'><img border='0' src='images/print_icon.jpg' width='40' height='26' /></a>                        
                            </td>
                     </tr>
					  <tr>
						<td colspan='6' align='center' valign='middle' style='border: 1px dotted #000'>
							<center><b><font size=5>FNA COLD STORAGE.</font></b></center>
							<center>&nbsp;</center>
							<center><b><font size=4>Daily Income / Expanse Report</FONT></b></center>
							<center>&nbsp;</center>
							<center><b><font size=4>Date: $ENTRYDATE</FONT></b></center>
							<center><b><font size=2>&nbsp;</font></b></center>
						</td>
					  </tr>
					  <tr>

						<td colspan='6' align='left' valign='top'>&nbsp;</td>

					  </tr>
					  ";

// Query here.
						//$TOTAL_RECEIVE_QNTY_KG ='';
						
							
							// Package Information View Report Start 	 <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<		
								$aViewQuery 	= "SELECT DISTINCT PROJECTID
															FROM fna_daily_income_expanse
															WHERE DATE = '".$ENTRYDATE."'
															{$WhereQ}
															
														";
								$aViewQueryStatement				= mysql_query($aViewQuery);
								$GRANDTOTAL_GLOBAL_INCOME 	= 0;
								$GRANDTOTAL_GLOBAL_EXPANSE 	= 0;	
								$GRANDTOTAL_BALANCE_INCASH	= 0;
								$GRANDTOTAL_CASH	=	0;	
								$YESTERDAY_BALANCE	=	0;								
								while($aViewQueryStatementData		= mysql_fetch_array($aViewQueryStatement)){ 
								
								$PROJECTID_PRO       				= $aViewQueryStatementData["PROJECTID"];
								 
								 
								 $ProjectNameQry					= mysql_fetch_array(mysql_query("SELECT * FROM fna_project WHERE PROJECTID = '".$PROJECTID_PRO."'"));
								 $PROJECTNAME						= $ProjectNameQry['PROJECTNAME'];
								 $tableView .= "<tr>
															<td colspan='6' align='left' valign='top' style='border: 1px dotted #000'><font size='+1'>Project Name : {$PROJECTNAME}</font></td>
														</tr>";
								 //$tableView .= "<fieldset><legend>Division Name.{$DIVISIONID}</legend>";
								//$tableView .= "<fieldset><legend>District Name.{$DISTRICTID}</legend>";
										$SubProjQuery 	= "SELECT DISTINCT SUBPROJECTID
																FROM fna_daily_income_expanse
																WHERE PROJECTID = '".$PROJECTID_PRO."'
																AND DATE = '".$ENTRYDATE."'
																{$WhereQ}
																";
										$SubProjQueryStatement				= mysql_query($SubProjQuery);
										
										$GRANDTOTAL_EXPANSE = 0;
										//$GRANDTOTAL_CASH	= 0;
										while($SubProjQueryStatementData	= mysql_fetch_array($SubProjQueryStatement)){ 
										
										  $SUBPROJECTID_Sub        			= $SubProjQueryStatementData["SUBPROJECTID"];
										 
										  $SubProjNameQry					= mysql_fetch_array(mysql_query("SELECT * FROM fna_subproject WHERE SUBPROJECTID = '".$SUBPROJECTID_Sub."'"));
										  $SUBPROJECTNAME					= $SubProjNameQry['SUBPROJECTNAME'];
										  
										 $tableView .= "<tr>
															<td colspan='6' align='left' valign='top' style='border: 1px dotted #000'>
															<fieldset><legend>Sub Project :{$SUBPROJECTNAME}</legend>
																<table width='100%'>";
										 $tableView .= "
														 <tr style='font-weight:bold;'>
				
															<td width='10%' align='center' valign='middle' style='font-weight:bold;border: 1px dotted #000'><font size='+1'>Entry Sl No.</font></td>
															
															<td width='20%' align='center' valign='middle' style='font-weight:bold;border: 1px dotted #000'><font size='+1'>Head Name</font></td>
															
															<td width='40%' align='center' valign='middle' style='font-weight:bold;border: 1px dotted #000'><font size='+1'>Description</font></td>
															
															<td width='15%' align='center' valign='middle'  style='border: 1px dotted #000'><font size='+1'>Income Amount</font></td>
															
															<td width='15%' align='center' valign='middle'  style='border: 1px dotted #000'><font size='+1'>Expanse Amount</font></td>
									
																						
														</tr>";
										 
										  //$tableView .= "<fieldset><legend>Thana Name.{$THANAID}</legend>";
											$DailyIncomeQuery 	= "SELECT *
																		FROM fna_daily_income_expanse
																		WHERE PROJECTID = '".$PROJECTID_PRO."'
																		AND SUBPROJECTID = '".$SUBPROJECTID_Sub."'
																		AND DATE = '".$ENTRYDATE."'
																		{$WhereQ}
																	";
											$DailyIncomeQueryStatement				= mysql_query($DailyIncomeQuery);
											$sl = 1;
											$GLOBAL_INCOME = 0;
											$GLOBAL_EXPANSE = 0;											
											$BALANCE_INCOME	=0;
											$NOW_DESCRIPTION = '';
											$BANK_DESCRIPTION	= '';
											$GRANDTOTAL_INCOME = $GLOBAL_INCOME;
											$HeadName		= '';
											
											while($DailyIncomeQueryStatementData	= mysql_fetch_array($DailyIncomeQueryStatement)){ 
											
											 $ENTRYSERIALNOID      				= $DailyIncomeQueryStatementData["ENTRYSERIALNOID"];
											 $DESCRIPTION        				= $DailyIncomeQueryStatementData["DESCRIPTION"];
											 $INHID		        				= $DailyIncomeQueryStatementData["INHID"];
											 $EXPHID		       				= $DailyIncomeQueryStatementData["EXPHID"];
											 $INCOME	        				= $DailyIncomeQueryStatementData["INCOME"];
											 $EXPANSE	        				= $DailyIncomeQueryStatementData["EXPANSE"];
											 $DATE	        					= $DailyIncomeQueryStatementData["DATE"];
											 
											
											 
											 
											 if($SUBPROJECTID_Sub == 11){
												 
												    $BankDescQuery 	= "SELECT *
																		FROM fna_banktransaction
																		WHERE PROJECTID = '".$PROJECTID_PRO."'
																		AND SUBPROJECTID = '".$SUBPROJECTID_Sub."'
																		AND BTDATE = '".$ENTRYDATE."'
																		
																	";
													$BankDescQueryStatement				= mysql_query($BankDescQuery);
													$BANK_DESCRIPTION	= '';
													while($BankDescQueryStatementData	= mysql_fetch_array($BankDescQueryStatement)){ 
													
													$BANK_DESCRIPTION      				= $BankDescQueryStatementData["DESCRIPTION"];
													}
												 
												 	$NOW_DESCRIPTION 					= $DESCRIPTION ;
											 }else{
											 $NOW_DESCRIPTION	= $DESCRIPTION ; 
											 }
											 $IncomeIdQuery 	= "SELECT *
																		FROM fna_income_head
																		WHERE INHID = '".$INHID."'
																	";
											$IncomeIdQueryStatement				= mysql_query($IncomeIdQuery);
											$INCHEADNAME	='';
											while($IncomeIdQueryStatementData	= mysql_fetch_array($IncomeIdQueryStatement)){ 
											
											$INCHEADNAME        				= $IncomeIdQueryStatementData["INCHEADNAME"];
											}
											
											$ExpanseIdQuery 	= "SELECT *
																		FROM fna_expense_head
																		WHERE EXPHID = '".$EXPHID."'
																	";
											$ExpanseIdQueryStatement				= mysql_query($ExpanseIdQuery);
											$EXPHEADNAME	='';
											while($ExpanseIdQueryStatementData		= mysql_fetch_array($ExpanseIdQueryStatement)){ 
											
											 $EXPHEADNAME        					= $ExpanseIdQueryStatementData["EXPHEADNAME"];
											}
											
											 $GLOBAL_INCOME						= $GLOBAL_INCOME + $INCOME ; 
											 $GLOBAL_EXPANSE					= $GLOBAL_EXPANSE + $EXPANSE ; 
											 //$GRANDTOTAL_INCOME					= $GRANDTOTAL_INCOME + 	$INCOME ; 
											 if($INHID == '0'){
												 $INCHEADNAME  = '';
												 $HeadName		= $EXPHEADNAME; 
												
											}elseif($EXPHID == '0'){
												 $EXPHEADNAME  = '';
												 $HeadName		= $INCHEADNAME;
											}
											
											
																				 
											 $tableView .=" <tr>
																<td align='center' valign='top' style='border: 1px dotted #000'><font size='+1'>$ENTRYSERIALNOID</font></td>
																
																<td align='center' valign='top' style='border: 1px dotted #000'><font size='+1'>$HeadName</font></td>
																
																<td align='left' valign='top' style='border: 1px dotted #000'><font size='+1'>$NOW_DESCRIPTION</font></td>
					
																<td align='right' valign='top' style='border: 1px dotted #000'><font size='+1'>".number_format($INCOME,2)." </font></td>
																
																<td align='right' valign='top' style='border: 1px dotted #000'><font size='+1'> ".number_format($EXPANSE,2)." </font></td>
										
															</tr>";
											 $sl++;
											}//Retailer Close
											
											$DailyIncomeQueryA 			= "SELECT 	SUM(INCOME) INCOME,
																					SUM(EXPANSE) EXPANSE
																				FROM fna_daily_income_expanse
																				WHERE DATE != '".$ENTRYDATE."'
																			";
											$DailyIncomeQueryAStatement				= mysql_query($DailyIncomeQueryA);
											while($DailyIncomeQueryAStatementData	= mysql_fetch_array($DailyIncomeQueryAStatement)){ 
											
											 $INCOME_Total        				= $DailyIncomeQueryAStatementData["INCOME"];
											 $EXPANSE_Total        				= $DailyIncomeQueryAStatementData["EXPANSE"];
											 }
											 $BALANCE_INCOME 					= $INCOME_Total - $EXPANSE_Total;
											 
											 	
											$tableView .=" <tr >
																<td align='center' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
																
																<td align='center' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
																
																<td align='center' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
					
																<td align='right' valign='top' style='border: 1px dotted #000' bgcolor='#CCCCCC'><font size='+1'>".number_format($GLOBAL_INCOME,2)." </font></td>
																
																<td align='right' valign='top' style='border: 1px dotted #000' bgcolor='#CCCCCC'><font size='+1'> ".number_format($GLOBAL_EXPANSE,2)." </font></td>
										
															</tr>
															";
															
															$Yesterday_Query 	= "SELECT 	CASHINHAND
																						FROM fna_cashinhand 
																						WHERE ENTRYDATE = '".$LastDay."'
																							
																					"; 
																$Yesterday_QueryStatement				= mysql_query($Yesterday_Query);
																while($Yesterday_QueryStatementData		= mysql_fetch_array($Yesterday_QueryStatement)){	
																	 $YESTERDAY_BALANCE					= $Yesterday_QueryStatementData['CASHINHAND'];
																	
																}	
															
											$GRANDTOTAL_GLOBAL_INCOME 	= $GRANDTOTAL_GLOBAL_INCOME + $GLOBAL_INCOME;
											$GRANDTOTAL_GLOBAL_EXPANSE 	= $GRANDTOTAL_GLOBAL_EXPANSE + $GLOBAL_EXPANSE;
											$GRANDTOTAL_CASH			= $YESTERDAY_BALANCE + $GRANDTOTAL_GLOBAL_INCOME ; 
											$GRANDTOTAL_BALANCE_INCASH	= $GRANDTOTAL_CASH - $GRANDTOTAL_GLOBAL_EXPANSE ;
									 				
											$tableView .= " 
															</table>
															</fieldset>
															</td>
														</tr>
															";
											 
											
										
									}//div Close
									//$tableView .= "</fieldset>";
									
								}//while close
								
							
											
					$tableView .=" <tr >
										<td colspan='3' align='center' valign='top' >
											<table width='97%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:100%;'>
											  <tr>
													<td width='70%' align='right' valign='top' style='border: 1px dotted #000'><font size='+1'>Grand Total :</font></td>
			
													<td width='15%' align='right' valign='top' style='border: 1px dotted #000' bgcolor='#CCCCCC'><font size='+1'>".number_format($GRANDTOTAL_GLOBAL_INCOME,2)." </font></td>
													
													<td width='15%' align='right' valign='top' style='border: 1px dotted #000' bgcolor='#CCCCCC'><font size='+1'> ".number_format($GRANDTOTAL_GLOBAL_EXPANSE,2)." </font></td>
											   </tr>
										   
											</table>
										</td>
				
									</tr>
									";	
									
									

					$tableView .="<tr>

									<td colspan='12' align='center' valign='top' >
										<table width='50%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:100%;'>
										  <tr style='font-size:16px;'>
											<td align='right' width='50%' style='border: 1px dotted #000'><b>Previous/Last Day Cash </b></td>
											<td width='2%' style='border: 1px dotted #000'>:</td>
											<td width='48%' style='border: 1px dotted #000'><b>".number_format($YESTERDAY_BALANCE,2)."</b></td>
										  </tr>
										 <tr style='font-size:16px;'>
											<td align='right' width='50%' style='border: 1px dotted #000'><b>Today's Income</b></td>
											<td width='2%' style='border: 1px dotted #000'>:</td>
											<td width='48%' style='border: 1px dotted #000'><b>".number_format($GRANDTOTAL_GLOBAL_INCOME,2)."</b></td>
										  </tr>
										  <tr style='font-size:16px;'>
											<td align='right' width='50%' style='border: 1px dotted #000'><b>Total Income</b></td>
											<td width='2%' style='border: 1px dotted #000'>:</td>
											<td width='48%' style='border: 1px dotted #000'><b>".number_format($GRANDTOTAL_CASH,2)."</b></td>
										  </tr>
										  <tr style='font-size:16px;'>
											<td align='right' width='50%' style='border: 1px dotted #000'><b>Today's Expanse</b></td>
											<td width='2%' style='border: 1px dotted #000'>:</td>
											<td width='48%' style='border: 1px dotted #000'><b>".number_format($GRANDTOTAL_GLOBAL_EXPANSE,2)."</b></td>
										  </tr>
										  <tr style='font-size:16px;'>
											<td align='right' width='50%' style='border: 1px dotted #000'><b>Balance Cash in Hand</b></td>
											<td width='2%' style='border: 1px dotted #000'>:</td>
											<td width='48%' style='border: 1px dotted #000'><b>".number_format($GRANDTOTAL_BALANCE_INCASH,2)."</b></td>
										  </tr>
										   
										</table>
									</td>
		
								</tr>
							
						
						<tr>

							<td colspan='12' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='12' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='12' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='12' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='12' align='left' valign='top' >
								<table width='100%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:100%;'>
								  <tr>
									<td align='right' width='34%' valign='bottom' ><hr width='200' ></td>
									<td width='33%' valign='bottom' ><hr width='200' ></td>
									<td width='33%' valign='bottom' ><hr width='200' ></td>
									<td width='33%' valign='bottom' ><hr width='200' ></td>
									<td width='33%' valign='bottom' ><hr width='200' ></td>
								  </tr>
								  <tr>
									<td align='center' valign='top'  ><b>Asst. General Manager </b></td>
									<td  align='center' valign='top'  ><b>General Manager </b></td>
									<td align='center' valign='top'  ><b>Chief Executive Officer</b></td>
									<td align='center' valign='top'  ><b>Head of IT </b></td>
									<td align='center' valign='top'  ><b>Managing Director</b></td>
								  </tr>
								 </table>
							</td>

						</tr>
						<tr>

							<td colspan='12' align='left' valign='top' >&nbsp;</td>

						</tr>
						<tr>

							<td colspan='12' align='left' valign='top' >&nbsp;</td>

						</tr>					

					</table>";
	echo $tableView;

?>