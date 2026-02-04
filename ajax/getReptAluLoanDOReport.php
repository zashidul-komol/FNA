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
	$LOANID	 			= $_REQUEST['LOANID'];
	$PayAmount 			= $_REQUEST['PayAmount'];
	$ENTRYDATE_FROM		= showDateMySQlFormat($_REQUEST['ENTRYDATE']);
	$userId 			= $_REQUEST['userId'];
	$con = '';
	
	
	$Party_Query 		= "SELECT 	PARTYID
							FROM fna_loan 
							WHERE PROJECTID = '".$PROJECTID."' 
							AND SUBPROJECTID = '".$SUBPROJECTID."'
							AND LOANID = '".$LOANID."'
							
						";
	$Party_QueryStatement					= mysql_query($Party_Query);
	$PARTYID	='';
	while($Party_QueryStatementData			= mysql_fetch_array($Party_QueryStatement)){	
		$PARTYID							= $Party_QueryStatementData['PARTYID'];
	}
	
		
	 	$partySql 	= "
						SELECT PARTYNAME,
								ADDRESS,
								MOBILE											
							FROM fna_party 
							WHERE PARTYID = '".$PARTYID."'
							
					";
		$partySqlStatement				= mysql_query($partySql);
		$PARTYNAME	='';
		$ADDRESS 	='';
		$MOBILE		='';
		while($partySqlStatementData	= mysql_fetch_array($partySqlStatement)){
			$PARTYNAME        			= $partySqlStatementData["PARTYNAME"];
			$ADDRESS        			= $partySqlStatementData["ADDRESS"];
			$MOBILE	        			= $partySqlStatementData["MOBILE"];
		}
		
		$SubProjectSql 	= "
							SELECT  sp.SUBPROJECTNAME											
							FROM fna_subproject sp
							WHERE sp.SUBPROJECTID = '".$SUBPROJECTID."'
							
						";
			$SubProjectSqlStatement				= mysql_query($SubProjectSql);
			while($SubProjectSqlStatementData	= mysql_fetch_array($SubProjectSqlStatement)){
				$SUBPROJECTNAME        			= $SubProjectSqlStatementData["SUBPROJECTNAME"];
				
			}
			
					
	$tableView = "";	
	$tableView .="<table width='75%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:85%; border: 1px dotted #000'>

					  <tr>
                            <td style='text-align:right;' colspan='18'>
                            <a href='javascript:Clickheretoprint()'><img border='0' src='images/print_icon.jpg' width='40' height='26' /></a>                        
                            </td>
                     </tr>
					  <tr>
						<td colspan='9' align='center' valign='middle' style='border: 1px dotted #000'>
							<center><b><font size=4>F N A Group Of Company</font></b></center>
							<center><b><font size=3>LOAN DO Report</FONT></b></center>
							<center><b><font size=2>Date : $ENTRYDATE_FROM </font></b></center>
						</td>
					  </tr> 
					  <tr>
						<td colspan='9' align='right' valign='middle' style='border: 1px dotted #000'>
							<center><b><font>LOAN ID: $LOANID </b></center>
							<right><b><font>Office Copy ....... </b></right>
						</td>
					  </tr>
					  <tr>
						<td colspan='9' align='right' valign='middle' style='border: 1px dotted #000'>
							<center><b><font>&nbsp; </b></center>
							<right><b><font>&nbsp; </b></right>
						</td>
					  </tr>
					  <tr>

						<td colspan='9' align='left' valign='top'>
							<table width='100%' border='0' cellpadding='1' cellspacing='0' style='margin:0px auto 0px auto;font-size:100%;'>
								  <tr style='font-weight:bold;'>
								
									<td width='15%' align='left' valign='top'>Party Name <b></td>
									<td width='1%' align='center' valign='top'>:</td>
									<td width='34%' align='left' valign='top'>$PARTYNAME</td>
								  </tr>
								  <tr style='font-weight:bold;'>
								
									<td width='15%' align='left' valign='top'>Address <b></td>
									<td width='1%' align='center' valign='top'>:</td>
									<td width='34%' align='left' valign='top'>$ADDRESS</td>
								  </tr>
								  <tr style='font-weight:bold;'>
								
									<td width='15%' align='left' valign='top'>Mobile No <b></td>
									<td width='1%' align='center' valign='top'>:</td>
									<td width='34%' align='left' valign='top'>$MOBILE </td>
								</tr>
								</table>
							

						</td>

					  </tr> ";


									$Lot_Query 		= "SELECT 	LOANDATE,
																LOAN_PAYMENTDATE,
																LOANAMOUNT,
																RESTOFTHE_AMOUNT,
																LOANPAYMENT,
																INTERESTRATE,
																INTERESTAMOUNT,
																LOTNO
															FROM fna_loan 
															WHERE LOANID = '".$LOANID."'
															
														";
									$Lot_QueryStatement							= mysql_query($Lot_Query);
									while($Lot_QueryStatementData				= mysql_fetch_array($Lot_QueryStatement)){	
										$LOANDATE								= $Lot_QueryStatementData['LOANDATE'];
										$LOAN_PAYMENTDATE						= $Lot_QueryStatementData['LOAN_PAYMENTDATE'];
										$LOANAMOUNT								= $Lot_QueryStatementData['LOANAMOUNT'];
										$RESTOFTHE_AMOUNT						= $Lot_QueryStatementData['RESTOFTHE_AMOUNT'];
										$LOANPAYMENT							= $Lot_QueryStatementData['LOANPAYMENT'];
										$INTERESTRATE							= $Lot_QueryStatementData['INTERESTRATE'];
										$INTERESTAMOUNT							= $Lot_QueryStatementData['INTERESTAMOUNT'];
										$LOTNO									= $Lot_QueryStatementData['LOTNO'];
										
									}
									if($LOTNO !='0'){
										
										$Loan_Cal_Query 		= "SELECT 	SUM(LOANAMOUNT) TOT_LOANAMOUNT,
																			SUM(LOANPAYMENT) TOT_LOANPAYMENT,
																			SUM(INTERESTAMOUNT) TOT_INTERESTAMOUNT
																		FROM fna_loan 
																		WHERE LOTNO = '".$LOTNO."'
																		AND LOANDATE >= '".$LOANDATE."'
																		
																	";
										$Loan_Cal_QueryStatement					= mysql_query($Loan_Cal_Query);
										while($Loan_Cal_QueryStatementData			= mysql_fetch_array($Loan_Cal_QueryStatement)){	
											$TOT_LOANAMOUNT							= $Loan_Cal_QueryStatementData['TOT_LOANAMOUNT'];
											$TOT_LOANPAYMENT						= $Loan_Cal_QueryStatementData['TOT_LOANPAYMENT'];
											$TOT_INTERESTAMOUNT						= $Loan_Cal_QueryStatementData['TOT_INTERESTAMOUNT'];
											
										}
										
										$RestAmount_Query 		= "SELECT 	RESTOFTHE_AMOUNT
																		FROM fna_loan 
																		WHERE LOTNO = '".$LOTNO."'
																		AND LOANDATE >= '".$LOANDATE."'
																		AND STATUS = 'Active'
																		
																	";
										$RestAmount_QueryStatement					= mysql_query($RestAmount_Query);
										while($RestAmount_QueryStatementData		= mysql_fetch_array($RestAmount_QueryStatement)){	
											$TOT_RESTAMOUNT							= $RestAmount_QueryStatementData['RESTOFTHE_AMOUNT'];
											
										}
									}else{
										$TOT_LOANAMOUNT			= $LOANAMOUNT ;
										$TOT_LOANPAYMENT		= $LOANPAYMENT ;
										$TOT_INTERESTAMOUNT		= $INTERESTAMOUNT ;
										$TOT_RESTAMOUNT			= $RESTOFTHE_AMOUNT - $PayAmount ; 
																				
									}
									
									
									$daylen = 60*60*24;

								   $date2 = $LOANDATE;
								   $date1 = $ENTRYDATE_FROM;
											$days = (strtotime($date1)-strtotime($date2))/$daylen;
											$INT_AMOUNT_TEST = round(((($PayAmount * $INTERESTRATE)/100)/365) * $days) ;
											$TOT_LOANAMOUNT_TEST = $TOT_RESTAMOUNT + $INT_AMOUNT_TEST;
											//echo $days ; 
											
									$Total_Payble_Amount	= $PayAmount + $INT_AMOUNT_TEST ; 
									$Rest_Loan_Balance		= ($TOT_RESTAMOUNT + $INT_AMOUNT_TEST) - ($Total_Payble_Amount); 
									
								   /*
								   if($LOAN_PAYMENT_AMOUNT == $TOT_LOANAMOUNT_TEST){
									  
										   $days = (strtotime($date1)-strtotime($date2))/$daylen;
											$INT_AMOUNT = round(((($RESTOFTHE_AMOUNT * $INTERESTRATE)/100)/365) * $days) ; 
											$TOT_LOANAMOUNT = round($RESTOFTHE_AMOUNT + $INT_AMOUNT) ;
										   
										   $NOW_PRINCIPAL_AMOUNT	= round($LOAN_PAYMENT_AMOUNT - $INT_AMOUNT) ;
										   $NOW_RESTOFTHE_AMOUNT	= round($RESTOFTHE_AMOUNT - $NOW_PRINCIPAL_AMOUNT) ;
									   
									  }else{
										 
										   $days = (strtotime($date1)-strtotime($date2))/$daylen;
										   $INT_AMOUNT = round((($LOAN_PAYMENT_AMOUNT * $INTERESTRATE)/100)/365) * $days ; 
										   $TOT_LOANAMOUNT = round($RESTOFTHE_AMOUNT + $INT_AMOUNT) ;
										   
										   $NOW_PRINCIPAL_AMOUNT	= round($LOAN_PAYMENT_AMOUNT - $INT_AMOUNT) ;
										   $NOW_RESTOFTHE_AMOUNT	= round($RESTOFTHE_AMOUNT - $NOW_PRINCIPAL_AMOUNT) ;
										 }
								   
									*/
									
							$tableView .="		
											<tr>
					
												<td colspan='9' align='center' valign='top' style='border: 1px dotted #000'>
													<table width='80%'>
														  <tr align='center' style='font-weight:bold;'>
															<td style='border: 1px dotted #000'>Description</td>
															<td style='border: 1px dotted #000'>Amount</td>
														  </tr>
														  <tr>
															<td style='border: 1px dotted #000'>Loan Date</td>
															<td align='right' style='border: 1px dotted #000'>$LOANDATE</td>
														  </tr>
														  <tr>
															<td style='border: 1px dotted #000'>Loan Amount</td>
															<td align='right' style='border: 1px dotted #000'>".number_format($TOT_LOANAMOUNT,2)."</td>
														  </tr>
														  <tr>
															<td style='border: 1px dotted #000'>Loan Paid Amount</td>
															<td align='right' style='border: 1px dotted #000'>".number_format($TOT_LOANPAYMENT,2)."</td>
														  </tr>
														  <tr>
															<td style='border: 1px dotted #000'>Loan Interest Paid</td>
															<td align='right' style='border: 1px dotted #000'>".number_format($TOT_INTERESTAMOUNT,2)."</td>
														  </tr>
														  <tr>
															<td style='border: 1px dotted #000'>Rest of The Amount</td>
															<td align='right' style='border: 1px dotted #000'>".number_format($TOT_RESTAMOUNT,2)."</td>
														  </tr>
														  
														  <tr>
															<td style='border: 1px dotted #000'>Due Interest Amount</td>
															<td align='right' style='border: 1px dotted #000'>".number_format($INT_AMOUNT_TEST,2)."</td>
														  </tr>
														  <tr>
															<td style='border: 1px dotted #000'>Payment Amount</td>
															<td align='right' style='border: 1px dotted #000'>".number_format($PayAmount,2)."</td>
														  </tr>
														  <tr>
															<td style='border: 1px dotted #000'>Total Payble Amount</td>
															<td align='right' style='border: 1px dotted #000'>".number_format($Total_Payble_Amount,2)."</td>
														  </tr>
														  <tr style='font-weight:bold;'>
															<td colspan='1' align='right' style='border: 1px dotted #000'>Net Payable:</td>
															<td align='right' style='border: 1px dotted #000'>".number_format($Total_Payble_Amount,2)."</td>
														  </tr>
														</table>
												</td>
					
											</tr>
											<tr>
					
												<td colspan='9' align='left' valign='top'>&nbsp;</td>
					
											</tr>
												
											<tr>
					
												<td colspan='9' align='left' valign='top' >&nbsp;</td>
					
											</tr>	
											<tr>
					
												<td colspan='9' align='left' valign='top' >&nbsp;</td>
					
											</tr>	
											<tr>
					
												<td colspan='9' align='left' valign='top' >
													<table width='100%' border='0' cellpadding='1' cellspacing='0' style='margin:0px auto 0px auto;font-size:100%;'>
													  <tr>
														<td align='right' width='20%' valign='bottom' ><hr width='150' ></td>
														<td align='right' width='20%' valign='bottom' ><hr width='150' ></td>
														<td width='20%' valign='bottom' ><hr width='150' ></td>
														<td width='20%' valign='bottom' ><hr width='150' ></td>
													  </tr>
													  <tr>
														<td align='center' valign='top'  ><b>Receiver Signature</b></td>
														<td align='center' valign='top'  ><b>Computer Operator</b></td>
														<td  align='center' valign='top'  ><b>AGM Signature</b></td>
														<td align='center' valign='top'  ><b>GM Signature</b></td>
													  </tr>
													 </table>
												</td>
					
											</tr>
											<tr>
					
												<td colspan='9' align='left' valign='top' >&nbsp;</td>
					
											</tr>
																							   
										 ";
										 
										 $tableView .="<table width='75%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:85%; border: 1px dotted #000'>

														  <tr>
																<td style='text-align:right;' colspan='18'>
																<a href='javascript:Clickheretoprint()'><img border='0' src='images/print_icon.jpg' width='40' height='26' /></a>                        
																</td>
														 </tr>
														  <tr>
															<td colspan='9' align='center' valign='middle' style='border: 1px dotted #000'>
																<center><b><font size=4>F N A Group Of Company</font></b></center>
																<center><b><font size=3>LOAN DO Report</FONT></b></center>
																<center><b><font size=2>Date : $ENTRYDATE_FROM </font></b></center>
															</td>
														  </tr> 
														  <tr>
															<td colspan='9' align='right' valign='middle' style='border: 1px dotted #000'>
																<center><b><font>LOAN ID: $LOANID </b></center>
																<right><b><font>Customer Copy .......</b></right>
															</td>
														  </tr>
														 <tr>
															<td colspan='9' align='right' valign='middle' style='border: 1px dotted #000'>
																<center><b><font>&nbsp; </b></center>
																<right><b><font>&nbsp; </b></right>
															</td>
														  </tr>
														  <tr>
									
															<td colspan='9' align='left' valign='top'>
																<table width='100%' border='0' cellpadding='1' cellspacing='0' style='margin:0px auto 0px auto;font-size:100%;'>
																	  <tr style='font-weight:bold;'>
																	
																		<td width='15%' align='left' valign='top'>Party Name <b></td>
																		<td width='1%' align='center' valign='top'>:</td>
																		<td width='34%' align='left' valign='top'>$PARTYNAME</td>
																	  </tr>
																	  <tr style='font-weight:bold;'>
																	
																		<td width='15%' align='left' valign='top'>Address <b></td>
																		<td width='1%' align='center' valign='top'>:</td>
																		<td width='34%' align='left' valign='top'>$ADDRESS</td>
																	  </tr>
																	  <tr style='font-weight:bold;'>
																	
																		<td width='15%' align='left' valign='top'>Mobile No <b></td>
																		<td width='1%' align='center' valign='top'>:</td>
																		<td width='34%' align='left' valign='top'>$MOBILE </td>
																	</tr>
																	</table>
																
									
															</td>
									
														  </tr> ";
														  
														  $tableView .="		
											<tr>
					
												<td colspan='9' align='center' valign='top' style='border: 1px dotted #000'>
													<table width='80%'>
														  <tr align='center' style='font-weight:bold;'>
															<td style='border: 1px dotted #000'>Description</td>
															<td style='border: 1px dotted #000'>Amount</td>
														  </tr>
														  <tr>
															<td style='border: 1px dotted #000'>Loan Date</td>
															<td align='right' style='border: 1px dotted #000'>$LOANDATE</td>
														  </tr>
														  <tr>
															<td style='border: 1px dotted #000'>Loan Amount</td>
															<td align='right' style='border: 1px dotted #000'>".number_format($TOT_LOANAMOUNT,2)."</td>
														  </tr>
														  <tr>
															<td style='border: 1px dotted #000'>Loan Paid Amount</td>
															<td align='right' style='border: 1px dotted #000'>".number_format($TOT_LOANPAYMENT,2)."</td>
														  </tr>
														  <tr>
															<td style='border: 1px dotted #000'>Loan Interest Paid</td>
															<td align='right' style='border: 1px dotted #000'>".number_format($TOT_INTERESTAMOUNT,2)."</td>
														  </tr>
														  <tr>
															<td style='border: 1px dotted #000'>Rest of The Amount</td>
															<td align='right' style='border: 1px dotted #000'>".number_format($TOT_RESTAMOUNT,2)."</td>
														  </tr>
														  
														  <tr>
															<td style='border: 1px dotted #000'>Due Interest Amount</td>
															<td align='right' style='border: 1px dotted #000'>".number_format($INT_AMOUNT_TEST,2)."</td>
														  </tr>
														  <tr>
															<td style='border: 1px dotted #000'>Payment Amount</td>
															<td align='right' style='border: 1px dotted #000'>".number_format($PayAmount,2)."</td>
														  </tr>
														  <tr>
															<td style='border: 1px dotted #000'>Total Payble Amount</td>
															<td align='right' style='border: 1px dotted #000'>".number_format($Total_Payble_Amount,2)."</td>
														  </tr>
														  <tr style='font-weight:bold;'>
															<td colspan='1' align='right' style='border: 1px dotted #000'>Net Payable:</td>
															<td align='right' style='border: 1px dotted #000'>".number_format($Total_Payble_Amount,2)."</td>
														  </tr>
														</table>
												</td>
					
											</tr>
											<tr>
					
												<td colspan='9' align='left' valign='top'>&nbsp;</td>
					
											</tr>
												
											<tr>
					
												<td colspan='9' align='left' valign='top' >&nbsp;</td>
					
											</tr>	
											<tr>
					
												<td colspan='9' align='left' valign='top' >&nbsp;</td>
					
											</tr>	
											<tr>
					
												<td colspan='9' align='left' valign='top' >
													<table width='100%' border='0' cellpadding='1' cellspacing='0' style='margin:0px auto 0px auto;font-size:100%;'>
													  <tr>
														<td align='right' width='20%' valign='bottom' ><hr width='150' ></td>
														<td align='right' width='20%' valign='bottom' ><hr width='150' ></td>
														<td width='20%' valign='bottom' ><hr width='150' ></td>
														<td width='20%' valign='bottom' ><hr width='150' ></td>
													  </tr>
													  <tr>
														<td align='center' valign='top'  ><b>Receiver Signature</b></td>
														<td align='center' valign='top'  ><b>Computer Operator</b></td>
														<td  align='center' valign='top'  ><b>AGM Signature</b></td>
														<td align='center' valign='top'  ><b>GM Signature</b></td>
													  </tr>
													 </table>
												</td>
					
											</tr>
											<tr>
					
												<td colspan='9' align='left' valign='top' >&nbsp;</td>
					
											</tr>
																							   
										 ";
											
																
					echo $tableView;
					//echo $LOANID ; 

?>