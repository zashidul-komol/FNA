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

	
	$EXPHID				= $_REQUEST['EXPHID'];
	$INHID				= $_REQUEST['INHID'];
	$ENTRYDATE_FROM 	= showDateMySQlFormat($_REQUEST['ENTRYDATE']);
	$ENTRYDATE_TO 		= showDateMySQlFormat($_REQUEST['ENTRYDATE2']);
	$userId 			= $_REQUEST['userId'];
	$con = '';
	if ($EXPHID == 'all'){
			//$con = '';
			$Last_Date = date_create($ENTRYDATE_TO);
		date_sub($Last_Date, date_interval_create_from_date_string('1 days'));
		$LastDay = date_format($Last_Date, 'Y-m-d');

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
			
		
		//Ministry/Division and Project/Programme Name View Report Start				
	 	$expanseSql 	= "
							SELECT e.EXPHEADNAME										
							FROM fna_expense_head e
						";
			$expanseSqlStatement			= mysql_query($expanseSql);
			while($expanseSqlStatementData	= mysql_fetch_array($expanseSqlStatement)){
				$EXPHEADNAME        		= $expanseSqlStatementData["EXPHEADNAME"];
			}
			
			//Ministry/Division and Project/Programme Name View Report End
			
	$tableView = "";	
	$tableView .="<table width='50%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:85%; border: 1px dotted #000'>

					  <tr>
						<td colspan='18' align='center' valign='middle' style='border: 1px dotted #000'>
							<center><b><font size=5>F N A Group Of Company</font></b></center>
							<center>&nbsp;</center>
							<center><b><font size=4>Expanse Head Wise Report</FONT></b></center>
							<center>&nbsp;</center>
							<center><b><font size=2>Date : $ENTRYDATE_FROM to $ENTRYDATE_TO </font></b></center>
						</td>
					  </tr>
					  <tr>

						<td colspan='18' align='left' valign='top'>
							<table width='100%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:100%;'>
								  
								  <tr>
								
									<td width='14%' align='left' valign='top'>Project Name<b></td>
									<td width='1%' align='center' valign='top'>:</td>
									<td width='34%' align='left' valign='top'> $PROJECTNAME</td>
									<td width='18%' align='right' valign='top'>&nbsp;</td>
									
								  </tr>
								  <tr>
								
									<td width='14%' align='left' valign='top'>Sub Project Name<b></td>
									<td width='1%' align='center' valign='top'>:</td>
									<td width='34%' align='left' valign='top'> $SUBPROJECTNAME</td>
									<td width='18%' align='right' valign='top'>&nbsp;</td>
									
								  </tr>
								  
								  <tr>
								
									<td width='14%' align='left' valign='top'>Expanse Head Name<b></td>
									<td width='1%' align='center' valign='top'>:</td>
									<td width='34%' align='left' valign='top'> All Expanse Head</td>
									<td width='18%' align='right' valign='top'>&nbsp;</td>
									
								  </tr>
																
								  <tr>
								
									<td align='left' valign='top'>&nbsp;</td>
									<td align='center' valign='top'>&nbsp;</td>
								
									<td align='left' valign='top'>&nbsp;</td>
									<td align='right' valign='top'>&nbsp;</td>
									
								  </tr>
								  
								  <tr>
								
									<td align='left' valign='top'>&nbsp;</td>
									<td align='center' valign='top'>&nbsp;</td>
								
									<td align='left' valign='top'>&nbsp;</td>
									<td align='right' valign='top'>&nbsp;</td>
									
								  </tr>
								
								</table>
							

						</td>

					  </tr>
					  <tr style='font-weight:bold;'>

						<td align='center' valign='middle' style='font-weight:bold;border: 1px dotted #000'>SL No.</td>
						
						<td align='center' valign='middle'  style='border: 1px dotted #000'>Expanse Head name</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Expanse Amount </td>
						
						<td align='center' valign='middle'  style='border: 1px dotted #000'>Income Head name</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Income Amount </td>
						
						
					</tr>";

// Query here.

						//$TOTAL_RECEIVE_QNTY_KG ='';
						$TOTAL_AMOUNT		='';
						$AMOUNT 			= '';
						$EXPHEADNAME		= '';
						$TOTAL_BILLAMOUNT = '';
						$basicQuery 		= "SELECT exp.EXPHID,
													  sum(exp.AMOUNT) AMOUNT,
													  ehn.EXPHEADNAME
												FROM fna_expanse exp, fna_expense_head ehn
												WHERE ehn.EXPHID = exp.EXPHID
												AND exp.PROJECTID = '".$PROJECTID."'
												AND exp.SUBPROJECTID = '".$SUBPROJECTID."'
												AND exp.EXPDATE between '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."' 
												GROUP BY ehn.EXPHEADNAME
											";
						$basicQueryStatement			= mysql_query($basicQuery);
						$sl = 1;
						$glabalToatalBill = 0;
						$RECEIVEAMOUNT ='';
						while($basicQueryStatementData	= mysql_fetch_array($basicQueryStatement)){
								 $EXPHID        		= $basicQueryStatementData["EXPHID"]; 
								 $AMOUNT        		= $basicQueryStatementData["AMOUNT"];
								 $EXPHEADNAME       	= $basicQueryStatementData["EXPHEADNAME"];
								 
								 $TOTAL_AMOUNT 		= $TOTAL_AMOUNT + $AMOUNT ;
								 //$TOTAL_BILLAMOUNT 	= $TOTAL_BILLAMOUNT + $BILLAMOUNT ;
						$LabBillQuery 		= "SELECT sum(lb.BILLAMOUNT) BILLAMOUNT
												FROM fna_labourbill lb
												WHERE lb.PROJECTID = '".$PROJECTID."'
												AND lb.SUBPROJECTID = '".$SUBPROJECTID."'
												AND lb.ENTRYDATE between '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."' 
												
											";
						$LabBillQueryStatement			= mysql_query($LabBillQuery);
						while($LabBillQueryStatementData	= mysql_fetch_array($LabBillQueryStatement)){
								$BILLAMOUNT    		= $LabBillQueryStatementData["BILLAMOUNT"];
								
						}
						
						//-----------------------------------------------------------------------------------------------
						
						$basicIncQuery 		= "SELECT inh.INHID,
													  sum(inc.AMOUNT) AMOUNT,
													  inh.INCHEADNAME
												FROM fna_income inc, fna_income_head inh
												WHERE inc.INHID = inh.INHID
												AND inc.PROJECTID = '".$PROJECTID."'
												AND inc.SUBPROJECTID = '".$SUBPROJECTID."'
												AND inc.INDATE between '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."' 
												GROUP BY inh.INCHEADNAME
											";
						$basicIncQueryStatement			= mysql_query($basicIncQuery);
						$sl = 1;
						$glabalToatalBill = 0;
						$RECEIVEAMOUNT ='';
						while($basicIncQueryStatementData	= mysql_fetch_array($basicIncQueryStatement)){
								 $INHID	        			= $basicIncQueryStatementData["INHID"]; 
								 $INCOME_AMOUNT    			= $basicIncQueryStatementData["AMOUNT"];
								 $INCHEADNAME       		= $basicIncQueryStatementData["INCHEADNAME"];
								 
								// $TOTAL_AMOUNT 		= $TOTAL_AMOUNT + $AMOUNT ;
						
						//-----------------------------------------------------------------------------------------------
						//$TOTAL_AMOUNT_LAB_BILL 		= $TOTAL_AMOUNT_LAB_BILL + $BILLAMOUNT ;

						$tableView .=" <tr>
											<td width='10%' align='center' valign='top' style='border: 1px dotted #000'>$sl</td>
											
											<td width='25%' align='left' valign='top' style='border: 1px dotted #000'> $EXPHEADNAME</td>
											
											<td width='15%' align='right' valign='top' style='border: 1px dotted #000'>".number_format($AMOUNT,2)."</td>
											
											<td width='25%' align='left' valign='top' style='border: 1px dotted #000'> $INCHEADNAME</td>
											
											<td width='15%' align='right' valign='top' style='border: 1px dotted #000'>".number_format($INCOME_AMOUNT,2)."</td>
											
											
										</tr>

									 ";

						}		// Dynamic Row End		  

						
				$sl++;
				}
		}else
		{
			//$con = "AND exp.EXPHID = '".$EXPHID."' ";
			

		$Last_Date = date_create($ENTRYDATE_TO);
		date_sub($Last_Date, date_interval_create_from_date_string('1 days'));
		$LastDay = date_format($Last_Date, 'Y-m-d');

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
			
		
		//Ministry/Division and Project/Programme Name View Report Start				
	 	$expanseSql 	= "
							SELECT e.EXPHEADNAME										
							FROM fna_expense_head e
							WHERE e.EXPHID = {$_REQUEST['EXPHID']}
						";
			$expanseSqlStatement			= mysql_query($expanseSql);
			while($expanseSqlStatementData	= mysql_fetch_array($expanseSqlStatement)){
				$EXPHEADNAME        		= $expanseSqlStatementData["EXPHEADNAME"];
			}
			
			//Ministry/Division and Project/Programme Name View Report End
			
	$tableView = "";	
	$tableView .="<table width='50%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:85%; border: 1px dotted #000'>

					  <tr>
						<td colspan='18' align='center' valign='middle' style='border: 1px dotted #000'>
							<center><b><font size=5>F N A Group Of Company</font></b></center>
							<center>&nbsp;</center>
							<center><b><font size=4>Expanse Head Wise Report</FONT></b></center>
							<center>&nbsp;</center>
							<center><b><font size=2>Date : $ENTRYDATE_FROM to $ENTRYDATE_TO </font></b></center>
						</td>
					  </tr>
					  <tr>

						<td colspan='18' align='left' valign='top'>
							<table width='100%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:100%;'>
								  
								  <tr>
								
									<td width='14%' align='left' valign='top'>Project Name<b></td>
									<td width='1%' align='center' valign='top'>:</td>
									<td width='34%' align='left' valign='top'> $PROJECTNAME</td>
									<td width='18%' align='right' valign='top'>&nbsp;</td>
									
								  </tr>
								  <tr>
								
									<td width='14%' align='left' valign='top'>Sub Project Name<b></td>
									<td width='1%' align='center' valign='top'>:</td>
									<td width='34%' align='left' valign='top'> $SUBPROJECTNAME</td>
									<td width='18%' align='right' valign='top'>&nbsp;</td>
									
								  </tr>
								  <tr>
								
									<td width='14%' align='left' valign='top'>Expanse Head Name<b></td>
									<td width='1%' align='center' valign='top'>:</td>
									<td width='34%' align='left' valign='top'> $EXPHEADNAME</td>
									<td width='18%' align='right' valign='top'>&nbsp;</td>
									
								  </tr>
																
								  <tr>
								
									<td align='left' valign='top'>&nbsp;</td>
									<td align='center' valign='top'>&nbsp;</td>
								
									<td align='left' valign='top'>&nbsp;</td>
									<td align='right' valign='top'>&nbsp;</td>
									
								  </tr>
								
								</table>
							

						</td>

					  </tr>
					  <tr style='font-weight:bold;'>

						<td align='center' valign='middle' style='font-weight:bold;border: 1px dotted #000'>SL No.</td>
						
						<td align='center' valign='middle'  style='border: 1px dotted #000'>Expanse Head name</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Amount </td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Labour Bill </td>
						
					</tr>";

// Query here.

						//$TOTAL_RECEIVE_QNTY_KG ='';
						$TOTAL_AMOUNT		='';
						$AMOUNT 			= '';
						$EXPHEADNAME		= '';
						$BILLAMOUNT = '';
						
						$basicQuery 		= "SELECT exp.AMOUNT,
													  ehn.EXPHEADNAME
												FROM fna_expanse exp, fna_expense_head ehn
												WHERE exp.EXPHID = '".$EXPHID."'
												AND exp.PROJECTID = '".$PROJECTID."'
												AND exp.SUBPROJECTID = '".$SUBPROJECTID."'
												AND exp.EXPHID = ehn.EXPHID
												AND  exp.EXPDATE between '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."' 
												GROUP BY ehn.EXPHEADNAME
											";
						$basicQueryStatement			= mysql_query($basicQuery);
						$sl = 1;
						while($basicQueryStatementData	= mysql_fetch_array($basicQueryStatement)){
								 $AMOUNT        		= $basicQueryStatementData["AMOUNT"];
								 $EXPHEADNAME       	= $basicQueryStatementData["EXPHEADNAME"];	
								 
								 $TOTAL_AMOUNT = $TOTAL_AMOUNT + $AMOUNT ;
								 
						$LabBillQuery 		= "SELECT sum(lb.BILLAMOUNT) BILLAMOUNT
												FROM fna_labourbill lb
												WHERE lb.PROJECTID = '".$PROJECTID."'
												AND lb.SUBPROJECTID = '".$SUBPROJECTID."'
												AND lb.ENTRYDATE between '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."' 
												
											";
						$LabBillQueryStatement			= mysql_query($LabBillQuery);
						while($LabBillQueryStatementData	= mysql_fetch_array($LabBillQueryStatement)){
								$BILLAMOUNT    		= $LabBillQueryStatementData["BILLAMOUNT"];
								
						}
						
						$tableView .=" <tr>
											<td width='5%' align='center' valign='top' style='border: 1px dotted #000'>$sl</td>
											
											<td width='15%' align='left' valign='top' style='border: 1px dotted #000'> $EXPHEADNAME</td>
											
											<td width='10%' align='right' valign='top' style='border: 1px dotted #000'>".number_format($AMOUNT,2)."</td>
											
											<td width='10%' align='right' valign='top' style='border: 1px dotted #000'>0.00</td>
					
										</tr>

									 ";

								// Dynamic Row End		  

						
				$sl++;
				}
				}

					$tableView .="

						<tr>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='right' valign='top' style='border: 1px dotted #000'><b>Total Amount : </b></td>

							<td align='RIGHT' valign='top' style='border: 1px dotted #000'><b>".number_format($TOTAL_AMOUNT,2)."</b></td>
							
							<td align='RIGHT' valign='top' style='border: 1px dotted #000'><b>".number_format($TOTAL_AMOUNT,2)."</b></td>
							
							<td align='RIGHT' valign='top' style='border: 1px dotted #000'><b>".number_format($TOTAL_AMOUNT,2)."</b></td>
							
							<td align='RIGHT' valign='top' style='border: 1px dotted #000'><b>".number_format($BILLAMOUNT,2)."</b></td>
							
						</tr>
						<tr>

							<td colspan='6' align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

						</tr>
							
						<tr>

							<td colspan='6' align='left' valign='top'>&nbsp;</td>

						</tr>
						<tr>

							<td colspan='6' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='6' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='6' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='6' align='left' valign='top' >&nbsp;</td>

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