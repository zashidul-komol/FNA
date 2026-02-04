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
	$ENTRYDATE			= insertDateMySQlFormat($_REQUEST["ENTRYDATE"]);
	$ENTRYDATE2			= insertDateMySQlFormat($_REQUEST["ENTRYDATE2"]);
	
	$userId 			= $_REQUEST['userId'];
	
	$ENTRYDATE_FIRST	= $_REQUEST["ENTRYDATE"];
	$ENTRYDATE_LAST		= $_REQUEST["ENTRYDATE2"];
	
	$Last_Date = date_create($ENTRYDATE);
	date_sub($Last_Date, date_interval_create_from_date_string('1 days'));
	$LastDay = date_format($Last_Date, 'Y-m-d');

	$WhereQ = '';
	$WhereQQ = '';
	
	if ($_REQUEST['PROJECTID']!=''){
		if($_REQUEST['PROJECTID']=='All'){
			$WhereQ .= '';
		}else{
			$WhereQ .= "AND PROJECTID = '".$PROJECTID."'";
		}
		
	}
	if ($_REQUEST['SUBPROJECTID']!=''){
		if($_REQUEST['SUBPROJECTID']=='All'){
			$WhereQQ .= '';
		}else{
			$WhereQQ .= "AND SUBPROJECTID = '".$SUBPROJECTID."'";
		}
		
	}
		
	
		
			//Ministry/Division and Project/Programme Name View Report End
			
	$tableView = "";	
	$tableView .="<table width='60%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:100%; border: 1px dotted #000'>
					<tr>
                            <td style='text-align:right;' colspan='18'>
                            <a href='javascript:Clickheretoprint()'><img border='0' src='images/print_icon.jpg' width='50' height='35' /></a>                        
                            </td>
                     </tr>
					  <tr>
						<td colspan='6' align='center' valign='middle' style='border: 1px dotted #000'>
							<center><b><font size=5>FNA COLD STORAGE.</font></b></center>
							<center>&nbsp;</center>
							<center><b><font size=4>All Income / Expanse Report</FONT></b></center>
							<center>&nbsp;</center>
							<center><b><font size=4>Date: $ENTRYDATE_FIRST To  $ENTRYDATE_LAST</FONT></b></center>
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
															WHERE STATUS = 'Active' 
															AND DATE BETWEEN '".$ENTRYDATE."' AND '".$ENTRYDATE2."'
															{$WhereQ}
															ORDER BY PROJECTID ASC
																														
														";
								$aViewQueryStatement				= mysql_query($aViewQuery);
								$GRANDTOTAL_GLOBAL_INCOME 	= 0;
								$GRANDTOTAL_GLOBAL_EXPANSE 	= 0;	
								
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
																AND DATE BETWEEN '".$ENTRYDATE."' AND '".$ENTRYDATE2."'
																{$WhereQQ}
																ORDER BY SUBPROJECTID ASC
																";
										$SubProjQueryStatement				= mysql_query($SubProjQuery);
										
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
				
															<td width='10%' align='center' valign='middle' style='font-weight:bold;border: 1px dotted #000'>Sl No.</td>
															
															<td width='30%' align='center' valign='middle' style='font-weight:bold;border: 1px dotted #000'>Head Name</td>

															<td width='15%' align='center' valign='middle' style='font-weight:bold;border: 1px dotted #000'>Project Name</td>

															<td width='15%' align='center' valign='middle' style='font-weight:bold;border: 1px dotted #000'>Sub Project Name</td>
															
															<td width='15%' align='center' valign='middle'  style='border: 1px dotted #000'>Income Amount</td>
															
															<td width='15%' align='center' valign='middle'  style='border: 1px dotted #000'>Expanse Amount</td>
									
																						
														</tr>";
										 
										  //$tableView .= "<fieldset><legend>Thana Name.{$THANAID}</legend>";
											$DailyIncomeQuery 	= "SELECT 	INHID,
											 								EXPHID,
																			SUM(INCOME) INCOMEAMNT,
																			SUM(EXPANSE) EXPAMNT
																		FROM fna_daily_income_expanse
																		WHERE PROJECTID = '".$PROJECTID_PRO."'
																		AND SUBPROJECTID = '".$SUBPROJECTID_Sub."'
																		AND DATE BETWEEN '".$ENTRYDATE."' AND '".$ENTRYDATE2."'
																		GROUP BY EXPHID,INHID  
																		
																	";
											$DailyIncomeQueryStatement				= mysql_query($DailyIncomeQuery);
											 $sl = 1;
											 $HeadName		= '';
											 $GLOBAL_INCOME	=	'';
											 $GLOBAL_EXPANSE =	'';
											 $GRANDTOTAL_INCOME = $GLOBAL_INCOME;
											
											while($DailyIncomeQueryStatementData	= mysql_fetch_array($DailyIncomeQueryStatement)){ 
											
											 $INHID		        				= $DailyIncomeQueryStatementData["INHID"];
											 $EXPHID		       				= $DailyIncomeQueryStatementData["EXPHID"];
											 $INCOME	        				= $DailyIncomeQueryStatementData["INCOMEAMNT"];
											 $EXPANSE	        				= $DailyIncomeQueryStatementData["EXPAMNT"];
											 
											 
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
											$GLOBAL_EXPANSE						= $GLOBAL_EXPANSE + $EXPANSE ; 
										
											
											 //$GRANDTOTAL_INCOME					= $GRANDTOTAL_INCOME + 	$GLOBAL_INCOME ; 
											 
											 if($INHID == '0'){
												 $INCHEADNAME  = '';
												 $HeadName		= $EXPHEADNAME; 
												
											}elseif($EXPHID == '0'){
												 $EXPHEADNAME  = '';
												 $HeadName		= $INCHEADNAME;
											}
											
																					 
											 $tableView .=" <tr>
																<td align='center' valign='top' style='border: 1px dotted #000'>$sl</td>
																
																<td align='left' valign='top' style='border: 1px dotted #000'>$HeadName</td>

																<td align='left' valign='top' style='border: 1px dotted #000'>$PROJECTNAME</td>

																<td align='left' valign='top' style='border: 1px dotted #000'>$SUBPROJECTNAME</td>
																
																<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($INCOME,2)." </td>
																
																<td align='right' valign='top' style='border: 1px dotted #000'> ".number_format($EXPANSE,2)." </td>
										
															</tr>";
												
											 $sl++;
											}//Retailer Close
											
											
												$GRANDTOTAL_GLOBAL_INCOME 	= $GRANDTOTAL_GLOBAL_INCOME + $GLOBAL_INCOME; 
												$GRANDTOTAL_GLOBAL_EXPANSE 	= $GRANDTOTAL_GLOBAL_EXPANSE + $GLOBAL_EXPANSE ;
												$GRANDTOTAL_GLOBAL_BALANCE	= $GRANDTOTAL_GLOBAL_INCOME - $GRANDTOTAL_GLOBAL_EXPANSE ; 
																			
															
											
											$tableView .=" <tr >
																<td align='center' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
																
																<td align='center' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

																<td align='center' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

																<td align='center' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
																
																<td align='right' valign='top' style='border: 1px dotted #000' bgcolor='#CCCCCC'>".number_format($GLOBAL_INCOME,2)." </td>
																
																<td align='right' valign='top' style='border: 1px dotted #000' bgcolor='#CCCCCC'> ".number_format($GLOBAL_EXPANSE,2)." </td>
										
															</tr>";
									 				
											$tableView .= " 
															</table>
															</fieldset>
															</td>
														</tr>
															";
															
															
															
															
																					
									}//div Close
									//$tableView .= "</fieldset>";
									
									
								}//while close
								
							
											
							

					$tableView .="
					
						<tr style='font-weight:bold;'>

							<td colspan='5' align='center' valign='top' >
								<table width='50%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:100%;'>
								  <tr>
									<td align='right' width='50%' style='border: 1px dotted #000'>Total Income Amount</td>
									<td width='2%' style='border: 1px dotted #000'>:</td>
									<td width='48%' style='border: 1px dotted #000'>".number_format($GRANDTOTAL_GLOBAL_INCOME,2)."</td>
								  </tr>
								  <tr>
									<td align='right' width='50%' style='border: 1px dotted #000'>Total Expanse Amount</td>
									<td width='2%' style='border: 1px dotted #000'>:</td>
									<td width='48%' style='border: 1px dotted #000'>".number_format($GRANDTOTAL_GLOBAL_EXPANSE,2)."</td>
								  </tr>
								  <tr>
									<td align='right' width='50%' style='border: 1px dotted #000'>Balance Amount</td>
									<td width='2%' style='border: 1px dotted #000'>:</td>
									<td width='48%' style='border: 1px dotted #000'>".number_format($GRANDTOTAL_GLOBAL_BALANCE,2)."</td>
								  </tr>
								</table>
							</td>

						</tr>
							
						
						<tr>

							<td colspan='13' align='center' valign='top' >&nbsp; </td>

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

							<td colspan='13' align='left' valign='top' >&nbsp;</td>

						</tr>
						<tr>

							<td colspan='13' align='left' valign='top' >&nbsp;</td>

						</tr>					

					</table>";
	echo $tableView;

?>