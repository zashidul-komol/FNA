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
	$con = '';
	
	
	//Ministry/Division and Project/Programme Name View Report Start	
	
		
	$tableView = "";	
	$tableView .="<table width='90%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:85%; border: 1px dotted #000'>

					  <tr>
                            <td style='text-align:right;' colspan='13'>
                            <a href='javascript:Clickheretoprint()'><img border='0' src='images/print_icon.jpg' width='40' height='26' /></a>                        
                            </td>
                     </tr>
					  <tr>
						<td colspan='13' align='center' valign='middle' style='border: 1px dotted #000'>
							<center><b><font size=5>F N A Group Of Company</font></b></center>
							<center>&nbsp;</center>
							<center><b><font size=3>Loan Summary Report</FONT></b></center>
							<center>&nbsp;</center>
							<center><b><font size=2>Date : $ENTRYDATE_FROM to $ENTRYDATE_TO </font></b></center>
						</td>
					  </tr> 
					  
					  <tr style='font-weight:bold;'>

						<td align='center' valign='top' style='font-weight:bold;border: 1px dotted #000'>SL</td>

						<td align='center' valign='top'  style='border: 1px dotted #000'>Party Name</td>
						
						<td align='center' valign='top' style='border: 1px dotted #000'>Car Loan </td>
						
						<td align='center' valign='top' style='border: 1px dotted #000'>Interest</td>
						
						<td align='center' valign='top' style='border: 1px dotted #000'>Principal</td>

						<td align='center' valign='top' style='border: 1px dotted #000'>Receive</td>
						
						<td align='center' valign='top' style='border: 1px dotted #000'>Principal Balance</td>

						<td align='right' valign='top' style='border: 1px dotted #000'>Nor Loan</td>

						<td align='right' valign='top' style='border: 1px dotted #000'>Interest</td>
						
						<td align='right' valign='top' style='border: 1px dotted #000'>Principal</td>
						
						<td align='right' valign='top' style='border: 1px dotted #000'>Receive</td>
						
						<td align='center' valign='top' style='border: 1px dotted #000'>Principal Balance</td>
						
					</tr>";

// Query here.


							
							// Package Information View Report Start 	 <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<	
							
							$GLOBAL_PARTY_BALANCE_AMOUNT = 0;
							$Pur_Bill_Balance 				= 0;
							$Sell_Bill_Balance				= 0;
							$GLOBAL_PARTY_PUR_BALANCE_AMOUNT	= 0;
							$GLOBAL_PARTY_SELL_BALANCE_AMOUNT	= 0;
							
								
								$PartyStatementQuery 	= "SELECT DISTINCT p.PARTYID
																FROM fna_loan p 
																WHERE p.PROJECTID = '".$PROJECTID."'
																AND p.SUBPROJECTID = '".$SUBPROJECTID."'
																AND p.LOANDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
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
								$Global_Car_Loan			= 0;
								$Global_Car_Loan_Int		= 0;
								$Global_Car_Loan_Pay		= 0;
								$Global_Normal_Loan			= 0;
								$Global_Normal_Loan_Int		= 0;
								$Global_Normal_Loan_Pay		= 0;
								$Global_Normal_Loan_Princ	=0;
								$Global_Car_Loan_Princ		= 0;
								$Global_Car_Loan_Balance	= 0;
								$Global_Nor_Loan_Balance	= 0;
								$Grand_Total_Principal		= 0;
									
								foreach($PARTYID_ARRAY_UNIQUE as $individualPartyID){
									
									
									$Loan_Query 	= "SELECT 	p.LOANDATE,
																p.PARTYID,
																p.LOANTYPEID,
																p.LOAN_PAYMENTDATE,
																sum(p.LOANAMOUNT) as LOANAMOUNT,
																sum(p.PRINCIPALAMOUNT) as PRINCIPALAMOUNT,
																sum(p.RESTOFTHE_AMOUNT) as RESTOFTHE_AMOUNT,
																sum(p.LOANPAYMENT) as LOANPAYMENT,
																sum(p.INTERESTAMOUNT) as INTERESTAMOUNT,
																p.LOAN_BALANCE,
																p.ENTRYDATE,
																p.LOTNO
															FROM fna_loan p
															WHERE p.PROJECTID = '".$PROJECTID."'
															AND p.SUBPROJECTID = '".$SUBPROJECTID."'
															AND p.PARTYID = '".$individualPartyID."'
															AND p.LOANTYPEID = 1
															AND p.ENTRYDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
															ORDER BY p.PARTYID, p.ENTRYDATE ASC
															
														";
									$Loan_QueryStatement						= mysql_query($Loan_Query);
									
									$Car_Loan_Balance	=	0;
									
									while($Loan_QueryStatementData				= mysql_fetch_array($Loan_QueryStatement)){	
										$LOANDATE								= $Loan_QueryStatementData['LOANDATE'];
										$PARTYID								= $Loan_QueryStatementData['PARTYID'];
										$LOANTYPEID								= $Loan_QueryStatementData['LOANTYPEID'];
										$LOAN_PAYMENTDATE						= $Loan_QueryStatementData['LOAN_PAYMENTDATE'];
										$LOANAMOUNT								= $Loan_QueryStatementData['LOANAMOUNT'];
										$PRINCIPALAMOUNT						= $Loan_QueryStatementData['PRINCIPALAMOUNT'];
										$RESTOFTHE_AMOUNT						= $Loan_QueryStatementData['RESTOFTHE_AMOUNT'];
										$LOANPAYMENT							= $Loan_QueryStatementData['LOANPAYMENT'];
										$INTERESTAMOUNT							= $Loan_QueryStatementData['INTERESTAMOUNT'];
										$LOAN_BALANCE							= $Loan_QueryStatementData['LOAN_BALANCE'];
										$ENTRYDATE								= $Loan_QueryStatementData['ENTRYDATE'];
										$LOTNO									= $Loan_QueryStatementData['LOTNO'];
										
									}
									
									$Car_Loan_Balance		= $LOANAMOUNT - $PRINCIPALAMOUNT ; 
									
									$Loan_Query_Nor 	= "SELECT 	p.LOANDATE,
																p.PARTYID,
																p.LOANTYPEID,
																p.LOAN_PAYMENTDATE,
																sum(p.LOANAMOUNT) as LOANAMOUNT,
																sum(p.PRINCIPALAMOUNT) as PRINCIPALAMOUNT,
																sum(p.RESTOFTHE_AMOUNT) as RESTOFTHE_AMOUNT,
																sum(p.LOANPAYMENT) as LOANPAYMENT,
																sum(p.INTERESTAMOUNT) as INTERESTAMOUNT,
																p.LOAN_BALANCE,
																p.ENTRYDATE,
																p.LOTNO
															FROM fna_loan p
															WHERE p.PROJECTID = '".$PROJECTID."'
															AND p.SUBPROJECTID = '".$SUBPROJECTID."'
															AND p.PARTYID = '".$individualPartyID."'
															AND p.LOANTYPEID = 3
															AND p.ENTRYDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
															ORDER BY p.PARTYID, p.ENTRYDATE ASC
															
														";
									$Loan_Query_NorStatement						= mysql_query($Loan_Query_Nor);
									$Nor_Loan_Balance	=	0;
									while($Loan_Query_NorStatementData			= mysql_fetch_array($Loan_Query_NorStatement)){	
										$LOANAMOUNT_NOR							= $Loan_Query_NorStatementData['LOANAMOUNT'];
										$PRINCIPALAMOUNT_NOR					= $Loan_Query_NorStatementData['PRINCIPALAMOUNT'];
										$RESTOFTHE_AMOUNT_NOR					= $Loan_Query_NorStatementData['RESTOFTHE_AMOUNT'];
										$LOANPAYMENT_NOR						= $Loan_Query_NorStatementData['LOANPAYMENT'];
										$INTERESTAMOUNT_NOR						= $Loan_Query_NorStatementData['INTERESTAMOUNT'];
										$LOAN_BALANCE_NOR						= $Loan_QueryStatementData['LOAN_BALANCE'];
										
									}
									
									$Nor_Loan_Balance		= $LOANAMOUNT_NOR - $PRINCIPALAMOUNT_NOR ; 
									
										$partySql 	= "
														SELECT PARTYNAME											
															FROM fna_party 
															WHERE PARTYID = '".$individualPartyID."'
															
													";
										$partySqlStatement				= mysql_query($partySql);
										while($partySqlStatementData	= mysql_fetch_array($partySqlStatement)){
											$PARTYNAME        		= $partySqlStatementData["PARTYNAME"];
										}
									
									/*
									$CAR_LOAN				=0;
									$CAR_LOAN_PAYMENT		=0;
									$CAR_LOAN_INT			=0;
									$NORMAL_LOAN			=0;
									$NORMAL_LOAN_PAYMENT	=0;
									$NORMAL_LOAN_INT		=0;
									$NOR_LOAN_PRINCIPAL		=0;
									$CAR_LOAN_PRINCIPAL		=0;
									
									
									if ($LOANTYPEID==1){
										
										$CAR_LOAN			= $LOANAMOUNT;
										$CAR_LOAN_PAYMENT	= $LOANPAYMENT;
										$CAR_LOAN_INT		= $INTERESTAMOUNT;
										$CAR_LOAN_PRINCIPAL	= $PRINCIPALAMOUNT ; 
										
									}elseif($LOANTYPEID==3){
										
										$NORMAL_LOAN			= $LOANAMOUNT;
										$NORMAL_LOAN_PAYMENT	= $LOANPAYMENT;
										$NORMAL_LOAN_INT		= $INTERESTAMOUNT;
										$NOR_LOAN_PRINCIPAL		= $PRINCIPALAMOUNT ; 
										
									}else{
										$NORMAL_LOAN			= $LOANAMOUNT;
										$NORMAL_LOAN_PAYMENT	= $LOANPAYMENT;
										$NORMAL_LOAN_INT		= $INTERESTAMOUNT;
										$NOR_LOAN_PRINCIPAL		= $PRINCIPALAMOUNT ; 
										
									}
									*/
									
									$Global_Car_Loan_Balance	= $Global_Car_Loan_Balance + $Car_Loan_Balance ; 
									$Global_Nor_Loan_Balance	= $Global_Nor_Loan_Balance + $Nor_Loan_Balance ;
									$Global_Car_Loan			= $Global_Car_Loan + $LOANAMOUNT ;
									$Global_Car_Loan_Int		= $Global_Car_Loan_Int + $INTERESTAMOUNT ; 
									$Global_Car_Loan_Pay		= $Global_Car_Loan_Pay + $LOANPAYMENT;
									$Global_Normal_Loan			= $Global_Normal_Loan + $LOANAMOUNT_NOR;
									$Global_Normal_Loan_Int		= $Global_Normal_Loan_Int + $INTERESTAMOUNT_NOR;
									$Global_Normal_Loan_Princ	= $Global_Normal_Loan_Princ + $PRINCIPALAMOUNT_NOR;
									$Global_Normal_Loan_Pay		= $Global_Normal_Loan_Pay + $LOANPAYMENT_NOR ;
									
									$Global_Car_Loan_Princ		= $Global_Car_Loan_Princ + $PRINCIPALAMOUNT;
									
									$Grand_Total_Principal		= $Global_Normal_Loan_Princ + $Global_Car_Loan_Princ ; 
									
									$Grand_Total_Loan			= $Global_Car_Loan + $Global_Normal_Loan ;
									$Grand_Total_Loan_Rec		= $Global_Car_Loan_Pay + $Global_Normal_Loan_Pay ;
									$Grand_Total_Int_Amnt		= $Global_Car_Loan_Int + $Global_Normal_Loan_Int ;
									$Grand_Total_Loan_Balance	= $Grand_Total_Loan - $Grand_Total_Principal;
									
									//$totprice_eggsell_global = $totprice_eggsell_global + $totprice_eggsell ;	
									//-----------------------------------------------------------------
									
									//if($Pur_Bill_Balance == 0 and $Sell_Bill_Balance == 0){
									//if ($LOANAMOUNT !=0 and $LOANAMOUNT_NOR !=0){
									$tableView .=" <tr>
														<td align='center' valign='top' width='4%' style='border: 1px dotted #000'>$sl</td>
			
														<td align='center' valign='top' width='16%' style='border: 1px dotted #000'> $PARTYNAME</td>
														
														<td align='right' valign='top' width='8%' style='border: 1px dotted #000'>".number_format($LOANAMOUNT,2)."</td>
														
														<td align='right' valign='top' width='8%' style='border: 1px dotted #000'>".number_format($INTERESTAMOUNT,2)."</td>
														
														<td align='right' valign='top' width='8%' style='border: 1px dotted #000'>".number_format($PRINCIPALAMOUNT,2)."</td>
								
														<td align='right' valign='top' width='8%' style='border: 1px dotted #000'>".number_format($LOANPAYMENT,2)." </td>
														
														<td align='right' valign='top' width='8%' style='border: 1px dotted #000'>".number_format($Car_Loan_Balance,2)." </td>
								
														<td align='right' valign='top' width='8%' style='border: 1px dotted #000'>".number_format($LOANAMOUNT_NOR,2)."</td>
														
														<td align='right' valign='top' width='8%' style='border: 1px dotted #000'>".number_format($INTERESTAMOUNT_NOR,2)."</td>
														
														<td align='right' valign='top' width='8%' style='border: 1px dotted #000'>".number_format($PRINCIPALAMOUNT_NOR,2)."</td>
								
														<td align='right' valign='top' width='8%' style='border: 1px dotted #000'>".number_format($LOANPAYMENT_NOR,2)."</td>
														
														<td align='right' valign='top' width='8%' style='border: 1px dotted #000'>".number_format($Nor_Loan_Balance,2)." </td>
								
														
													</tr>
			
												 ";
									//}
											// Dynamic Row End		  
								$sl++;
								}	
				
							

							$tableView .="		
											<tr style='font-weight:bold;'>
					
												<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
												
												<td align='right' valign='top'  style='border: 1px dotted #000'>&nbsp;</td>
					
												<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_Car_Loan,2)."</td>
					
												<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_Car_Loan_Int,2)."</td>
												
												<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_Car_Loan_Princ,2)."</td>
					
												<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_Car_Loan_Pay,2)."</td>
												
												<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_Car_Loan_Balance,2)."</td>
					
												<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_Normal_Loan,2)."</td>
												
												<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_Normal_Loan_Int,2)."</td>
												
												<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_Normal_Loan_Princ,2)."</td>
												
												<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_Normal_Loan_Pay,2)."</td>
												
												<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_Nor_Loan_Balance,2)."</td>
												
												
											</tr>
											<tr>
					
												<td colspan='12' align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
					
											</tr>
											
											<tr>
					
												<td colspan='12' align='left' valign='top'>&nbsp;</td>
					
											</tr>
											<tr>

												<td colspan='12' align='center' valign='top' >
													<table width='50%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:100%;'>
													  <tr style='background-color:lightgrey'>
														<td align='right' width='50%' style='border: 1px dotted #000'><b>Total Loan Amount</b></td>
														<td width='2%' style='border: 1px dotted #000'>:</td>
														<td width='48%' style='border: 1px dotted #000'><b>".number_format($Grand_Total_Loan,2)."</b></td>
													  </tr>
													  <tr>
														<td align='right' width='50%' style='border: 1px dotted #000'>Total Receive Amount</td>
														<td width='2%' style='border: 1px dotted #000'>:</td>
														<td width='48%' style='border: 1px dotted #000'>".number_format($Grand_Total_Loan_Rec,2)."</td>
													  </tr>
													  <tr>
														<td align='right' width='50%' style='border: 1px dotted #000'>Total Principal Receive</td>
														<td width='2%' style='border: 1px dotted #000'>:</td>
														<td width='48%' style='border: 1px dotted #000'>".number_format($Grand_Total_Principal,2)."</td>
													  </tr>
													  <tr>
														<td align='right' width='50%' style='border: 1px dotted #000'>Total Interest Amount</td>
														<td width='2%' style='border: 1px dotted #000'>:</td>
														<td width='48%' style='border: 1px dotted #000'>".number_format($Grand_Total_Int_Amnt,2)."</td>
													  </tr>
													  <tr>
														<td align='right' width='50%' style='border: 1px dotted #000'>Loan Principal Balance</td>
														<td width='2%' style='border: 1px dotted #000'>:</td>
														<td width='48%' style='border: 1px dotted #000'>".number_format($Grand_Total_Loan_Balance,2)."</td>
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
					
												<td colspan='12' align='left' valign='top' >
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
					
												<td colspan='12' align='left' valign='top' >&nbsp;</td>
					
											</tr>
											<tr>
					
												<td colspan='12' align='left' valign='top' >&nbsp;</td>
					
											</tr>					
					
										</table>";
			echo $tableView;

?>