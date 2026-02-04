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
	$ENTRYDATE_TO 		= showDateMySQlFormat($_REQUEST['ENTRYDATE2']);
	$userId 			= $_REQUEST['userId'];
	$con = '';
	
	
	//Ministry/Division and Project/Programme Name View Report Start	
	
	if ($PROJECTID == 'All'){
		$con = '';
	}else{
		$con = "AND p.PROJECTID='".$PROJECTID."' ";
	}
	
				
	 	$projectSql 	= "
							SELECT p.PROJECTNAME											
							FROM fna_project p
							WHERE p.PROJECTID = '".$PROJECTID."'
							{$con}
							
						";
			$projectSqlStatement				= mysql_query($projectSql);
			while($projectSqlStatementData		= mysql_fetch_array($projectSqlStatement)){
				$PROJECTNAME       				= $projectSqlStatementData["PROJECTNAME"];
				
			}
			
			//Ministry/Division and Project/Programme Name View Report End
			
	$tableView = "";	
	$tableView .="<table width='80%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:85%; border: 1px dotted #000'>

					  <tr>
                            <td style='text-align:right;' colspan='18'>
                            <a href='javascript:Clickheretoprint()'><img border='0' src='images/print_icon.jpg' width='40' height='26' /></a>                        
                            </td>
                     </tr>
					  <tr>
						<td colspan='13' align='center' valign='middle' style='border: 1px dotted #000'>
							<center><b><font size=5>F N A Group Of Company</font></b></center>
							<center>&nbsp;</center>
							<center><b><font size=3>FNA Party Statement Report</FONT></b></center>
							<center>&nbsp;</center>
							<center><b><font size=2>Date : $ENTRYDATE_FROM to $ENTRYDATE_TO </font></b></center>
						</td>
					  </tr> 
					  <tr>

						<td colspan='6' align='left' valign='top'>
							<table width='100%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:100%;'>
								  <tr style='font-weight:bold;'>
								
									<td width='14%' align='left' valign='top'>Project Name <b></td>
									<td width='1%' align='center' valign='top'>:</td>
									<td width='34%' align='left' valign='top'>$PROJECTNAME  </td>
									
								  </tr>
								
								  <tr>
								
									<td align='left' valign='top'>&nbsp;</td>
									<td align='center' valign='top'>&nbsp;</td>
								
									<td align='left' valign='top'> &nbsp;</td>
									<td align='right' valign='top'>&nbsp;</td>
									
								  </tr>
								
								 
								
								</table>
							

						</td>

					  </tr>

					  <tr style='font-weight:bold;'>

						<td align='center' valign='top' style='font-weight:bold;border: 1px dotted #000'>SL No.</td>

						<td align='center' valign='top'  style='border: 1px dotted #000'>Project Name</td>
						
						<td align='center' valign='top'  style='border: 1px dotted #000'>Party Name</td>

						<td align='center' valign='top' style='border: 1px dotted #000'>Pur Bill Amount </td>
						
						<td align='center' valign='top' style='border: 1px dotted #000'>Sell Bill Amount </td>

						<td align='center' valign='top' style='border: 1px dotted #000'>Payment Amount</td>

						<td align='right' valign='top' style='border: 1px dotted #000'>Receive Amount</td>

						<td align='right' valign='top' style='border: 1px dotted #000'>Balance Amount  </td>
						
					</tr>";

// Query here.


							
							// Package Information View Report Start 	 <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<	
							
							$GLOBAL_PARTY_BALANCE_AMOUNT = 0;
								
								$PartyStatementQuery 	= "SELECT p.PARTYID
																FROM fna_party p 
																WHERE p.PROJECTID = '".$PROJECTID."'
																{$con}
																ORDER BY p.PARTYID ASC
															"; 
								$PartyStatementQueryStatement				= mysql_query($PartyStatementQuery);
								$i = 0;
								while($PartyStatementQueryStatementData		= mysql_fetch_array($PartyStatementQueryStatement)){	
									$PARTYID_ARRAY[] 						= $PartyStatementQueryStatementData['PARTYID'];
									$i++;
								}
								
								$PARTYID_ARRAY_UNIQUE = array_unique($PARTYID_ARRAY);
								$sl = 1;	
								$Global_PurchaseBillAmount	= 0;
								$Global_SellBillAmount		= 0;
								$Global_PaymentAmount		= 0;
								$Global_receiveAmount		= 0;
								
								foreach($PARTYID_ARRAY_UNIQUE as $individualParty){
									$Party_Query 	= "SELECT 	sum(p.PUR_BILLAMOUNT) PURBILLAMOUNT,
																sum(p.SELL_BILLAMOUNT) SELLBILLAMOUNT,
																sum(p.PAYMENTAMOUNT) PAYMENTAMOUNT,
																sum(p.RECEIVEAMOUNT) RECEIVEAMOUNT,
																party.PARTYNAME
																	FROM fna_partybill p, fna_party party
																	WHERE party.PARTYID = p.PARTYID
																	AND p.PROJECTID = '".$PROJECTID."'
																	AND p.PARTYID = '".$individualParty."'
																	AND p.ENTRYDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
																	
																";
								$Party_QueryStatement						= mysql_query($Party_Query);
								while($Party_QueryStatementData				= mysql_fetch_array($Party_QueryStatement)){	
									$PURBILLAMOUNT							= $Party_QueryStatementData['PURBILLAMOUNT'];
									$SELLBILLAMOUNT							= $Party_QueryStatementData['SELLBILLAMOUNT'];
									$PAYMENTAMOUNT							= $Party_QueryStatementData['PAYMENTAMOUNT'];
									$RECEIVEAMOUNT							= $Party_QueryStatementData['RECEIVEAMOUNT'];
									$PARTYNAME								= $Party_QueryStatementData['PARTYNAME'];
									
								}
								//$totprice_eggsell_global = $totprice_eggsell_global + $totprice_eggsell ;	
							//-----------------------------------------------------------------
							 $PartyFlag				= mysql_fetch_array(mysql_query("SELECT MAX(PARTYFLAG) FROM fna_partybill WHERE PARTYID = '".$individualParty."'"));
							$MAXPARTYFLAG			= $PartyFlag['MAX(PARTYFLAG)'];
							$PARTY_BALANCE			= mysql_fetch_array(mysql_query("SELECT BALANCEAMOUNT FROM fna_partybill WHERE PARTYID = '".$individualParty."' AND PARTYFLAG = '".$MAXPARTYFLAG."'"));
							
							
							$Global_PurchaseBillAmount	= $Global_PurchaseBillAmount + $PURBILLAMOUNT ; 
							$Global_SellBillAmount		= $Global_SellBillAmount + $SELLBILLAMOUNT ; 
							$Global_PaymentAmount		= $Global_PaymentAmount + $PAYMENTAMOUNT ; 
							$Global_receiveAmount		= $Global_receiveAmount + $RECEIVEAMOUNT ; 
							$NOW_PARTY_BALANCE_AMOUNT	= $SELLBILLAMOUNT + $PAYMENTAMOUNT - $PURBILLAMOUNT - $RECEIVEAMOUNT ;
							$GLOBAL_PARTY_BALANCE_AMOUNT	= $GLOBAL_PARTY_BALANCE_AMOUNT + $NOW_PARTY_BALANCE_AMOUNT ;
 						// Dynamic Row Start

						$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000'>$sl</td>

											<td align='center' valign='top' style='border: 1px dotted #000'> $PROJECTNAME</td>
											
											<td align='center' valign='top' style='border: 1px dotted #000'> $PARTYNAME</td>
					
											<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($PURBILLAMOUNT,2)."</td>
											
											<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($SELLBILLAMOUNT,2)."</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($PAYMENTAMOUNT,2)." </td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($RECEIVEAMOUNT,2)."</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($NOW_PARTY_BALANCE_AMOUNT,2)."</td>
					
											
										</tr>

									 ";

								// Dynamic Row End		  
					$sl++;
					}	
				
				

					$tableView .="

						<tr style='font-weight:bold;'>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top'  style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='left' valign='top'  style='border: 1px dotted #000'>&nbsp;</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_PurchaseBillAmount,2)."</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_SellBillAmount,2)."</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_PaymentAmount,2)."</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_receiveAmount,2)."</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($GLOBAL_PARTY_BALANCE_AMOUNT,2)."</td>
							
							
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
									<td align='right' width='34%' valign='bottom' ><hr width='200' ></td>
									<td width='33%' valign='bottom' ><hr width='200' ></td>
									<td width='33%' valign='bottom' ><hr width='200' ></td>
								  </tr>
								  <tr>
									<td align='center' valign='top'  ><b>Cashier Signature</b></td>
									<td  align='center' valign='top'  ><b>AGM Signature</b></td>
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