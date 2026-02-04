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

	
	$INHID				= $_REQUEST['INHID'];
	$ENTRYDATE_FROM 	= showDateMySQlFormat($_REQUEST['ENTRYDATE']);
	$ENTRYDATE_TO 		= showDateMySQlFormat($_REQUEST['ENTRYDATE2']);
	$userId 			= $_REQUEST['userId'];
	$con = '';
	if ($INHID == 'all'){
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
	 	$incomeHeadSql 	= "
							SELECT e.INCHEADNAME										
							FROM fna_income_head e
						";
			$incomeHeadSqlStatement				= mysql_query($incomeHeadSql);
			while($incomeHeadSqlStatementData	= mysql_fetch_array($incomeHeadSqlStatement)){
				$INCHEADNAME_FRONT     			= $incomeHeadSqlStatementData["INCHEADNAME"];
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
							<center><b><font size=4>Income Head Wise Report</FONT></b></center>
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
									<td width='20%' align='left' valign='top'>&nbsp;</td>
									<td align='left' valign='top'>&nbsp;</td>
								
								  </tr>
								  <tr>
								
									<td width='14%' align='left' valign='top'>Sub Project Name<b></td>
									<td width='1%' align='center' valign='top'>:</td>
									<td width='34%' align='left' valign='top'> $SUBPROJECTNAME</td>
									<td width='18%' align='right' valign='top'>&nbsp;</td>
									<td width='20%' align='left' valign='top'>&nbsp;</td>
									<td align='left' valign='top'>&nbsp;</td>
								
								  </tr>
								  
								  <tr>
								
									<td width='14%' align='left' valign='top'>Income Head Name<b></td>
									<td width='1%' align='center' valign='top'>:</td>
									<td width='34%' align='left' valign='top'> All Income Head</td>
									<td width='1%' align='center' valign='top'>&nbsp;</td>
									<td width='20%' align='left' valign='top'>&nbsp;</td>
									<td align='left' valign='top'>&nbsp;</td>
								
								  </tr>
																
								  <tr>
								
									<td align='left' valign='top'>&nbsp;</td>
									<td align='center' valign='top'>&nbsp;</td>
								
									<td align='left' valign='top'>&nbsp;</td>
									<td align='center' valign='top'>&nbsp;</td>
									<td align='left' valign='top'>&nbsp;</td>
									<td align='left' valign='top'>&nbsp;</td>
								
								  </tr>
								  
								  <tr>
								
									<td align='left' valign='top'>&nbsp;</td>
									<td align='center' valign='top'>&nbsp;</td>
								
									<td align='left' valign='top'>&nbsp;</td>
									<td align='center' valign='top'>&nbsp;</td>
									<td align='left' valign='top'>&nbsp;</td>
									<td align='left' valign='top'>&nbsp;</td>
								
								  </tr>
								
								</table>
							

						</td>

					  </tr>
					  <tr style='font-weight:bold;'>

						<td align='center' valign='middle' style='font-weight:bold;border: 1px dotted #000'>SL No.</td>
						
						<td align='center' valign='middle' style='font-weight:bold;border: 1px dotted #000'>Income Date</td>

						<td align='center' valign='middle'  style='border: 1px dotted #000'>Income Head name</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Description</td>

						<td align='center' valign='middle' style='border: 1px dotted #000'>Voucher No: </td>

						<td align='center' valign='middle' style='border: 1px dotted #000'>Amount </td>
						
					</tr>";

// Query here.

						//$TOTAL_RECEIVE_QNTY_KG ='';
						$TOTAL_AMOUNT		='';
						$AMOUNT 			= '';
						$INDATE				= '';
						$VOUCHERNO			= '';
						$DESCRIPTION 		= '';
						$INCHEADNAME		= '';
						$basicQuery 		= "SELECT inc.INHID,
													  inc.AMOUNT,
													  inc.INDATE,
													  inc.VOUCHERNO,
													  inc.DESCRIPTION,
													  ihn.INCHEADNAME
												FROM fna_income inc, fna_income_head ihn
												WHERE ihn.INHID = inc.INHID
												AND inc.PROJECTID = '".$PROJECTID."'
												AND inc.SUBPROJECTID = '".$SUBPROJECTID."'
												AND  inc.INDATE between '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."' 
												ORDER BY inc.INDATE ASC
											";
						$basicQueryStatement			= mysql_query($basicQuery);
						$sl = 1;
						$glabalToatalBill = 0;
						$RECEIVEAMOUNT ='';
						$INCHEADNAME ='';
						while($basicQueryStatementData	= mysql_fetch_array($basicQueryStatement)){
								 $INHID        			= $basicQueryStatementData["INHID"]; 
								 $AMOUNT        		= $basicQueryStatementData["AMOUNT"];
								 $INDATE        		= $basicQueryStatementData["INDATE"];  
								 $VOUCHERNO      		= $basicQueryStatementData["VOUCHERNO"]; 
								 $DESCRIPTION       	= $basicQueryStatementData["DESCRIPTION"];
								 $INCHEADNAME       	= $basicQueryStatementData["INCHEADNAME"];
								// $EXPSUBHEADNAME       	= $basicQueryStatementData["SUBHEADNAME"];	
								 
								 $TOTAL_AMOUNT = $TOTAL_AMOUNT + $AMOUNT ;
							
						$tableView .=" <tr>
											<td width='10%' align='center' valign='top' style='border: 1px dotted #000'>$sl</td>
											
											<td width='10%' align='center' valign='top' style='border: 1px dotted #000'>$INDATE</td>

											<td width='15%' align='left' valign='top' style='border: 1px dotted #000'> $INCHEADNAME</td>
											
											<td width='30%' align='left' valign='top'  style='border: 1px dotted #000'>$DESCRIPTION</td>
					
											<td width='10%' align='right' valign='top' style='border: 1px dotted #000'>$VOUCHERNO</td>
					
											<td width='10%' align='right' valign='top' style='border: 1px dotted #000'>".number_format($AMOUNT,2)."</td>
					
										</tr>

									 ";

								// Dynamic Row End		  

						
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
	 	$IncomeSql 	= "
							SELECT e.INCHEADNAME										
							FROM fna_income_head e
							WHERE e.INHID = {$_REQUEST['INHID']}
						";
			$IncomeSqlStatement			= mysql_query($IncomeSql);
			while($IncomeSqlStatementData	= mysql_fetch_array($IncomeSqlStatement)){
				$INCHEADNAME        		= $IncomeSqlStatementData["INCHEADNAME"];
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
							<center><b><font size=4>Income Head Wise Report</FONT></b></center>
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
									<td width='1%' align='center' valign='top'>&nbsp;</td>
									<td width='20%' align='left' valign='top'>&nbsp;</td>
									<td align='left' valign='top'>&nbsp;</td>
								
								  </tr>
								  <tr>
								
									<td width='14%' align='left' valign='top'>Sub Project Name<b></td>
									<td width='1%' align='center' valign='top'>:</td>
									<td width='34%' align='left' valign='top'> $SUBPROJECTNAME</td>
									<td width='18%' align='right' valign='top'>&nbsp;</td>
									<td width='1%' align='center' valign='top'>&nbsp;</td>
									<td width='20%' align='left' valign='top'>&nbsp;</td>
									<td align='left' valign='top'>&nbsp;</td>
								
								  </tr>
								  <tr>
								
									<td width='14%' align='left' valign='top'>Income Head Name<b></td>
									<td width='1%' align='center' valign='top'>:</td>
									<td width='34%' align='left' valign='top'> $INCHEADNAME</td>
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
						
						<td align='center' valign='middle' style='font-weight:bold;border: 1px dotted #000'>Income Date</td>

						<td align='center' valign='middle'  style='border: 1px dotted #000'>Income Head name</td>
						
						 <td align='center' valign='middle' style='border: 1px dotted #000'>Description</td>

						<td align='center' valign='middle' style='border: 1px dotted #000'>Voucher No: </td>

						<td align='center' valign='middle' style='border: 1px dotted #000'>Amount </td>
						
					</tr>";

// Query here.

						//$TOTAL_RECEIVE_QNTY_KG ='';
						$TOTAL_AMOUNT		= '';
						$AMOUNT 			= '';
						$EXPDATE			= '';
						$VOUCHERNO			= '';
						$DESCRIPTION 		= '';
						$EXPHEADNAME		= '';
											   
						$basicQuery 		= "SELECT inc.INHID,
													  inc.AMOUNT,
													  inc.INDATE,
													  inc.VOUCHERNO,
													  inc.DESCRIPTION,
													  ihn.INCHEADNAME
												FROM fna_income inc, fna_income_head ihn
												WHERE ihn.INHID = '".$INHID."'
												AND inc.PROJECTID = '".$PROJECTID."'
												AND inc.SUBPROJECTID = '".$SUBPROJECTID."'
												AND inc.INHID = ihn.INHID
												AND  inc.INDATE between '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."' 
												ORDER BY inc.INDATE ASC
											";
						$basicQueryStatement			= mysql_query($basicQuery);
						$sl = 1;
						while($basicQueryStatementData	= mysql_fetch_array($basicQueryStatement)){
								 $INHID        			= $basicQueryStatementData["INHID"]; 
								 $AMOUNT        		= $basicQueryStatementData["AMOUNT"];
								 $INDATE        		= $basicQueryStatementData["INDATE"];  
								 $VOUCHERNO      		= $basicQueryStatementData["VOUCHERNO"]; 
								 $DESCRIPTION       	= $basicQueryStatementData["DESCRIPTION"];
								 $INCHEADNAME       	= $basicQueryStatementData["INCHEADNAME"];
								 //$EXPSUBHEADNAME       	= $basicQueryStatementData["SUBHEADNAME"];
								 
								 $TOTAL_AMOUNT = $TOTAL_AMOUNT + $AMOUNT ;
								 

						$tableView .=" <tr>
											<td width='5%' align='center' valign='top' style='border: 1px dotted #000'>$sl</td>
											
											<td width='10%' align='center' valign='top' style='border: 1px dotted #000'>$INDATE</td>

											<td width='15%' align='left' valign='top' style='border: 1px dotted #000'> $INCHEADNAME</td>
											
											<td width='25%' align='left' valign='top'  style='border: 1px dotted #000'>$DESCRIPTION</td>
					
											<td width='10%' align='right' valign='top' style='border: 1px dotted #000'>$VOUCHERNO</td>
					
											<td width='10%' align='right' valign='top' style='border: 1px dotted #000'>".number_format($AMOUNT,2)."</td>
					
										</tr>

									 ";

								// Dynamic Row End		  

						
				$sl++;
				}
				}

					$tableView .="

						<tr>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top'  style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='right' valign='top' style='border: 1px dotted #000'><b>Total Amount : </b></td>

							<td align='RIGHT' valign='top' style='border: 1px dotted #000'><b>".number_format($TOTAL_AMOUNT,2)."</b></td>
							
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