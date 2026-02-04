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

						<td colspan=1' align='center' valign='middle' style='border: 1px dotted #000'>Expected Income</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Payment Received</td>

						<td colspan='3' align='center' valign='middle' style='border: 1px dotted #000'>Expanse</td>
						
					  </tr>

					  <tr style='font-weight:bold;'>

						<td align='center' valign='middle' style='font-weight:bold;border: 1px dotted #000'>Date</td>

						<td align='center' valign='middle' style='border: 1px dotted #000'>Amount  </td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Amount  </td>

						<td align='center' valign='middle' style='border: 1px dotted #000'>Head wise Expanse</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Labour Bill </td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Total Expanse Amount</td>
						
						</tr>";

// Query here.
						
						//$TOTAL_RECEIVE_QNTY_KG ='';
						$ENTRYDATE_ARRAY = array();
						$BILLAMOUNT_global = 0;	
						$RECEIVEAMOUNT_party = '';
						$RECEIVEAMOUNT_party_global = 0;
						$AMOUNT_exp = 0;
						$AMOUNT_exp_global = 0;	
						$BILLAMOUNT_lab = '';
						$BILLAMOUNT_lab_global = 0;
						$Total_Amount = '';	
						$Total_Amount_global = 0;
						$Net_Profit				= 0;
						$BillQuery 	= "SELECT b.ENTRYDATE
												FROM fna_bill b 
												WHERE b.PROJECTID = '".$PROJECTID."'
												AND b.SUBPROJECTID = '".$SUBPROJECTID."'
												AND b.ENTRYDATE between '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."' 
												ORDER BY b.ENTRYDATE ASC
											"; 
						$BillQueryStatement			= mysql_query($BillQuery);
						$i = 0;
						while($BillQueryStatementData	= mysql_fetch_array($BillQueryStatement)){	
							$ENTRYDATE_ARRAY[] = $BillQueryStatementData['ENTRYDATE'];
							$i++;
						}
						
						$LabBillQuery 	= "SELECT lb.ENTRYDATE
												FROM fna_labourbill lb 
												WHERE lb.PROJECTID = '".$PROJECTID."'
												AND lb.SUBPROJECTID = '".$SUBPROJECTID."'
												AND lb.ENTRYDATE between '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."' 
												ORDER BY lb.ENTRYDATE ASC
											";
						$LabBillQueryStatement			= mysql_query($LabBillQuery);
						while($LabBillQueryStatementData	= mysql_fetch_array($LabBillQueryStatement)){	
							$ENTRYDATE_ARRAY[] = $LabBillQueryStatementData['ENTRYDATE'];
							$i++;
						}
						
						$PartyBillQuery 	= "SELECT pb.ENTRYDATE
												FROM fna_partybill pb 
												WHERE pb.PROJECTID = '".$PROJECTID."'
												AND pb.SUBPROJECTID = '".$SUBPROJECTID."'
												AND pb.ENTRYDATE between '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."' 
												ORDER BY pb.ENTRYDATE ASC
											"; 
						$PartyBillQueryStatement			= mysql_query($PartyBillQuery);
						while($PartyBillQueryStatementData	= mysql_fetch_array($PartyBillQueryStatement)){	
							$ENTRYDATE_ARRAY[] = $PartyBillQueryStatementData['ENTRYDATE'];
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
						$ENTRYDATE_ARRAY_UNIQUE = array_unique($ENTRYDATE_ARRAY) ;
						foreach($ENTRYDATE_ARRAY_UNIQUE as $individualDate){
						$BILLAMOUNT = '';
						
						$Bill_Query 	= "SELECT sum(b.BILLAMOUNT) billamount
												FROM fna_bill b 
												WHERE b.PROJECTID = '".$PROJECTID."'
												AND b.SUBPROJECTID = '".$SUBPROJECTID."'
												AND b.ENTRYDATE = '".$individualDate."' 
												ORDER BY '".$individualDate."' ASC
											"; 
						$Bill_QueryStatement			= mysql_query($Bill_Query);
						while($Bill_QueryStatementData	= mysql_fetch_array($Bill_QueryStatement)){	
							$BILLAMOUNT = $Bill_QueryStatementData['billamount'];
							
						}	
						$BILLAMOUNT_global = $BILLAMOUNT_global + $BILLAMOUNT ;
											
							
						$PartyBill_Query 	= "SELECT sum(pb.RECEIVEAMOUNT) receiveamount
												FROM fna_partybill pb 
												WHERE pb.PROJECTID = '".$PROJECTID."'
												AND pb.SUBPROJECTID = '".$SUBPROJECTID."'
												AND pb.ENTRYDATE = '".$individualDate."' 
												ORDER BY pb.ENTRYDATE ASC
											"; 
						$PartyBill_QueryStatement			= mysql_query($PartyBill_Query);
						while($PartyBill_QueryStatementData	= mysql_fetch_array($PartyBill_QueryStatement)){	
							$RECEIVEAMOUNT_party			= $PartyBill_QueryStatementData['receiveamount'];
							
						}
						$RECEIVEAMOUNT_party_global = $RECEIVEAMOUNT_party_global + $RECEIVEAMOUNT_party ;
						
						
							
						$LabBill_Query 	= "SELECT sum(lb.BILLAMOUNT) billamount,
												  sum(lb.PAYMENTAMOUNT) PAYMENTAMOUNT
												FROM fna_labourbill lb 
												WHERE lb.PROJECTID = '".$PROJECTID."'
												AND lb.SUBPROJECTID = '".$SUBPROJECTID."'
												AND lb.ENTRYDATE = '".$individualDate."' 
												ORDER BY lb.ENTRYDATE ASC
											"; 
						$LabBill_QueryStatement				= mysql_query($LabBill_Query);
						while($LabBill_QueryStatementData	= mysql_fetch_array($LabBill_QueryStatement)){	
							$BILLAMOUNT_lab 				= $LabBill_QueryStatementData['billamount'];
							$PAYMENTAMOUNT_lab 				= $LabBill_QueryStatementData['PAYMENTAMOUNT'];
							
						}
						$BILLAMOUNT_lab_global = $BILLAMOUNT_lab_global + $PAYMENTAMOUNT_lab ; 
						
						
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
						
						
						$Total_Amount 			= $PAYMENTAMOUNT_lab + $AMOUNT_exp ;
						$Total_Amount_global 	= $Total_Amount_global + $Total_Amount ; 
						$Net_Profit				= $RECEIVEAMOUNT_party_global - $Total_Amount_global ; 
							
						$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000'>$individualDate</td>

											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($BILLAMOUNT,2)."</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($RECEIVEAMOUNT_party,2)."</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($AMOUNT_exp,2)."</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($PAYMENTAMOUNT_lab,2)."</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Total_Amount,2)."</td>
											
											

										</tr>

									 ";

								// Dynamic Row End		  

						
				
				}

					$tableView .="

						<tr style='font-weight:bold;'>

							<td align='right' valign='top' style='border: 1px dotted #000'>Grand Total:</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($BILLAMOUNT_global,2)."</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($RECEIVEAMOUNT_party_global,2)."</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($AMOUNT_exp_global,2)."</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($BILLAMOUNT_lab_global,2)."</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Total_Amount_global,2)."</td>

							
						</tr>
						<tr>

							<td colspan='6' align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

						</tr>
							
						<tr>

							<td colspan='6' align='left' valign='top'>&nbsp;</td>

						</tr>
						<tr>

							<td colspan='11' align='center' valign='top' >
								<table width='50%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:100%;'>
								  <tr>
									<td align='right' width='50%' style='border: 1px dotted #000'>Total Expected Income</td>
									<td width='2%' style='border: 1px dotted #000'>:</td>
									<td width='48%' style='border: 1px dotted #000'>".number_format($BILLAMOUNT_global,2)."</td>
								  </tr>
								  <tr>
									<td align='right' width='50%' style='border: 1px dotted #000'>Total Received Amount</td>
									<td width='2%' style='border: 1px dotted #000'>:</td>
									<td width='48%' style='border: 1px dotted #000'>".number_format($RECEIVEAMOUNT_party_global,2)."</td>
								  </tr>
								  <tr>
									<td align='right' width='50%' style='border: 1px dotted #000'>Total Expanse Amount</td>
									<td width='2%' style='border: 1px dotted #000'>:</td>
									<td width='48%' style='border: 1px dotted #000'>".number_format($Total_Amount_global,2)."</td>
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