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
	$ENTRYDATE_FROM 	= showDateMySQlFormat($_REQUEST['ENTRYDATE']);
	$userId 			= $_REQUEST['userId'];
	
		
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
							<center><b><font size=2>Date : $ENTRYDATE_FROM</font></b></center>
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

						<td align='center' valign='middle' style='font-weight:bold;border: 1px dotted #000'>Income</td>

						<td align='center' valign='middle' style='border: 1px dotted #000'>Expanse  </td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Payable  </td>

						<td align='center' valign='middle' style='border: 1px dotted #000'>Receivable</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Balance </td>
						
					 </tr>";

// Query here.
						
						//$TOTAL_RECEIVE_QNTY_KG ='';
						$RMP_AMOUNT_global = 0;
						$RECEIVEAMOUNT_party_global = 0;
						$amount_finishStock_global = 0;
						$AMOUNT_exp_global = 0;
						$Total_Amount_global = 0;
						$RMP_Query 	= "SELECT sum(rmp.AMOUNT) amount
												FROM feed_purchaserawmat rmp
												WHERE rmp.PROJECTID = '".$PROJECTID."'
												AND rmp.PURCHASEDATE <= '".$ENTRYDATE_FROM."' 
												ORDER BY '".$ENTRYDATE_FROM."' ASC
											"; 
						$RMP_QueryStatement				= mysql_query($RMP_Query);
						while($RMP_QueryStatementData	= mysql_fetch_array($RMP_QueryStatement)){	
							$RMP_AMOUNT 				= $RMP_QueryStatementData['amount'];
							
						}	
						$RMP_AMOUNT_global = $RMP_AMOUNT_global + $RMP_AMOUNT ;
											
							
						$PartyBill_Query 	= "SELECT sum(pb.RECEIVEAMOUNT) receiveamount
												FROM fna_partybill pb 
												WHERE pb.PROJECTID = '".$PROJECTID."'
												AND pb.ENTRYDATE <= '".$ENTRYDATE_FROM."' 
												ORDER BY pb.ENTRYDATE ASC
											";
						$PartyBill_QueryStatement			= mysql_query($PartyBill_Query);
						while($PartyBill_QueryStatementData	= mysql_fetch_array($PartyBill_QueryStatement)){	
							$RECEIVEAMOUNT_party			= $PartyBill_QueryStatementData['receiveamount'];
							
						}
						$RECEIVEAMOUNT_party_global = $RECEIVEAMOUNT_party_global + $RECEIVEAMOUNT_party ;
						
						
							
						$FinishStk_Query 	= "SELECT SUM(fgs.AMOUNT) amount
												FROM feed_finishedstock fgs 
												WHERE fgs.PROJECTID = '".$PROJECTID."'
												AND fgs.ENTDATE <= '".$ENTRYDATE_FROM."' 
												AND fgs.WORKFLAG = 'Out'
												ORDER BY fgs.ENTDATE ASC
											"; 
						$FinishStk_QueryStatement				= mysql_query($FinishStk_Query);
						while($FinishStk_QueryStatementData		= mysql_fetch_array($FinishStk_QueryStatement)){	
							$amount_finishStock					= $FinishStk_QueryStatementData['amount'];
							
						}
						$amount_finishStock_global = $amount_finishStock_global + $amount_finishStock ; 
						
						
						$Exp_Bill_Query 	= "SELECT sum(exp.AMOUNT) amount
												FROM fna_expanse exp 
												WHERE exp.PROJECTID = '".$PROJECTID."'
												AND exp.EXPDATE <= '".$ENTRYDATE_FROM."' 
												ORDER BY exp.EXPDATE ASC
											"; 
						$Exp_Bill_QueryStatement			= mysql_query($Exp_Bill_Query);
						while($Exp_Bill_QueryStatementData	= mysql_fetch_array($Exp_Bill_QueryStatement)){	
							$AMOUNT_exp		 				= $Exp_Bill_QueryStatementData['amount'];
							
						}
						$AMOUNT_exp_global = $AMOUNT_exp_global + $AMOUNT_exp ;
						
						
						$Total_Amount 			= $RMP_AMOUNT + $AMOUNT_exp ;
						$Total_Amount_global 	= $Total_Amount_global + $Total_Amount ; 
						$FeedBalance			= $RECEIVEAMOUNT_party_global - $Total_Amount_global ;
						
						$tableView .=" <tr>
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($RECEIVEAMOUNT_party_global,2)."</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Total_Amount_global,2)."</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Total_Amount_global,2)."</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($amount_finishStock_global,2)."</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($FeedBalance,2)."</td>
											
											

										</tr>

									 ";

								// Dynamic Row End		  

						
				
				

					$tableView .="

						<tr>

							<td colspan='5' align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

						</tr>
							
						<tr>

							<td colspan='5' align='left' valign='top'>&nbsp;</td>

						</tr>
						<tr>

							<td colspan='5' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='5' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='5' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='5' align='left' valign='top' >
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

							<td colspan='5' align='left' valign='top' >&nbsp;</td>

						</tr>
						<tr>

							<td colspan='5' align='left' valign='top' >&nbsp;</td>

						</tr>					

					</table>";
	echo $tableView;
									
?>