`<?php

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

	
		

	
	
	$ENTRYDATE_FROM 	= showDateMySQlFormat($_REQUEST['ENTRYDATE']);
	$ENTRYDATE_TO	 	= showDateMySQlFormat($_REQUEST['ENTRYDATE2']);
	$userId 			= $_REQUEST['userId'];
	
		$Last_Date = date_create($ENTRYDATE_TO);
		date_sub($Last_Date, date_interval_create_from_date_string('1 days'));
		$LastDay = date_format($Last_Date, 'Y-m-d');

		//Ministry/Division and Project/Programme Name View Report Start				
	 	
	$tableView = "";	
	$tableView .="<table width='65%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:85%; border: 1px dotted #000'>

					  <tr>
                            <td style='text-align:right;' colspan='13'>
                            <a href='javascript:Clickheretoprint()'><img border='0' src='images/print_icon.jpg' width='40' height='26' /></a>                        
                            </td>
                     </tr>
					  <tr>
						<td colspan='18' align='center' valign='middle' style='border: 1px dotted #000'>
							<center><b><font size=5>F N A Group Of Company</font></b></center>
							<center>&nbsp;</center>
							<center><b><font size=4>Balance Sheet Report</FONT></b></center>
							<center>&nbsp;</center>
							<center><b><font size=2>Date : $ENTRYDATE_FROM  To  $ENTRYDATE_TO </font></b></center>
						</td>
					  </tr>
					  <tr style='font-weight:bold;'>

						<td align='center' valign='middle' style='font-weight:bold;border: 1px dotted #000'>Project Name</td>

						<td align='center' valign='middle' style='border: 1px dotted #000'>Income</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Expanse</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Payable</td>

						<td align='center' valign='middle' style='border: 1px dotted #000'>Receivable</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Balance</td>
						
					</tr>";

// Query here.
						
						//$TOTAL_RECEIVE_QNTY_KG ='';
						$PROJECT_ARRAY = array();
					
						$RMP_AMOUNT_global = 0;
						$RECEIVEAMOUNT_party_global = 0;
						$amount_finishStock_global = 0;
						$AMOUNT_exp_global = 0;
						$Total_Amount_global = 0;
						$Global_Balance = 0;
						$Global_Balance_Income = 0;
						$Global_Balance_Expanse = 0;
						$Global_Balance_Payable = 0;
						$Global_Balance_Receiable = 0;
						$Global_Grand_Total_Income = 0;
						$Global_Grand_Total_Expanse = 0;
						$Total_Amount_Payable = 0;
						$Total_Amount_Payable_Feed = 0;
						$i = 0;
						
						
						$ProjectQuery 	= "SELECT PROJECTID
												FROM fna_project 
												ORDER BY PROJECTID ASC
											";
						$ProjectQueryStatement					= mysql_query($ProjectQuery);
						while($ProjectQueryStatementData		= mysql_fetch_array($ProjectQueryStatement)){	
							$PROJECT_ARRAY[] 					= $ProjectQueryStatementData['PROJECTID'];
							$i++;
						}
						
						$PROJECT_ARRAY_UNIQUE 	= array_unique($PROJECT_ARRAY);
						foreach($PROJECT_ARRAY_UNIQUE as $individualProject){
						
						$ProjectNameQuery 	= "SELECT 	PROJECTNAME
														FROM fna_project 
														WHERE PROJECTID = '".$individualProject."'
														ORDER BY PROJECTID ASC
													";
						$ProjectNameQueryStatement					= mysql_query($ProjectNameQuery);
						while($ProjectNameQueryStatementData		= mysql_fetch_array($ProjectNameQueryStatement)){	
							$PROJECTNAME							= $ProjectNameQueryStatementData['PROJECTNAME'];
							
						}	
						if($individualProject == 2){
							
							
							//------------------------------------------------------------------------
							$PartyStatementQuery 	= "SELECT p.PARTYID
																FROM fna_party p 
																WHERE p.PROJECTID = '".$individualProject."'
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
								$Global_Rec_Amount = 0;
								$Global_Pay_Amount = 0;
								foreach($PARTYID_ARRAY_UNIQUE as $individualParty){
								
								$Party_Query 	= "SELECT 	sum(p.PUR_BILLAMOUNT) PURBILLAMOUNT,
															sum(p.SELL_BILLAMOUNT) SELLBILLAMOUNT,
															sum(p.PAYMENTAMOUNT) PAYMENTAMOUNT,
															sum(p.RECEIVEAMOUNT) RECEIVEAMOUNT,
															party.PARTYNAME
																FROM fna_partybill p, fna_party party
																WHERE party.PARTYID = p.PARTYID
																AND p.PROJECTID = '".$individualProject."'
																AND p.PARTYID = '".$individualParty."'
																AND p.ENTRYDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
																
															";
								$Party_QueryStatement						= mysql_query($Party_Query);
								$Rec_Amount = 0;
								$Pay_Amount	 = 0;
								$Balance_Amount = 0;
								while($Party_QueryStatementData				= mysql_fetch_array($Party_QueryStatement)){	
									$PURBILLAMOUNT							= $Party_QueryStatementData['PURBILLAMOUNT'];
									$SELLBILLAMOUNT							= $Party_QueryStatementData['SELLBILLAMOUNT'];
									$PAYMENTAMOUNT							= $Party_QueryStatementData['PAYMENTAMOUNT'];
									$RECEIVEAMOUNT							= $Party_QueryStatementData['RECEIVEAMOUNT'];
									$PARTYNAME								= $Party_QueryStatementData['PARTYNAME'];
									
								}
								
									$Balance_Amount		= $SELLBILLAMOUNT + $PAYMENTAMOUNT  - $PURBILLAMOUNT - $RECEIVEAMOUNT ; 
									if($Balance_Amount <= 0){
										$Pay_Amount		= $RECEIVEAMOUNT + $PURBILLAMOUNT  - $SELLBILLAMOUNT - $PAYMENTAMOUNT;
									}else{
										$Rec_Amount	= $SELLBILLAMOUNT + $PAYMENTAMOUNT  - $PURBILLAMOUNT - $RECEIVEAMOUNT ;
									}
								
								
								$Global_Rec_Amount = $Global_Rec_Amount + $Rec_Amount ; 
								$Global_Pay_Amount = $Global_Pay_Amount + $Pay_Amount ; 
								
								}
								//$FinalBalance						= $SELLBILLAMOUNT + $PAYMENTAMOUNT  - $PURBILLAMOUNT - $RECEIVEAMOUNT ;
								
								
							//------------------------------------------------------------------------
							
							$RMP_Query 	= "SELECT sum(rmp.AMOUNT) amount
													FROM feed_purchaserawmat rmp
													WHERE rmp.PROJECTID = '".$individualProject."'
													AND rmp.PURCHASEDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
													ORDER BY '".$ENTRYDATE_FROM."' ASC
												"; 
							$RMP_QueryStatement				= mysql_query($RMP_Query);
							while($RMP_QueryStatementData	= mysql_fetch_array($RMP_QueryStatement)){	
								$EXPANSE_Feed_Pur			= $RMP_QueryStatementData['amount'];
								
							}
							
							$Exp_Bill_Query 	= "SELECT sum(exp.AMOUNT) amount
													FROM fna_expanse exp 
													WHERE exp.PROJECTID = '".$individualProject."'
													AND exp.EXPDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
													ORDER BY exp.EXPDATE ASC
												"; 
							$Exp_Bill_QueryStatement			= mysql_query($Exp_Bill_Query);
							while($Exp_Bill_QueryStatementData	= mysql_fetch_array($Exp_Bill_QueryStatement)){	
								$Expanse_Expanse 				= $Exp_Bill_QueryStatementData['amount'];
								
							}
							
							$Income_Bill_Query 	= "SELECT sum(inc.AMOUNT) amount
														FROM fna_income inc 
														WHERE inc.PROJECTID = '".$individualProject."'
														AND inc.INDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
														ORDER BY inc.INDATE ASC
													"; 
							$Income_Bill_QueryStatement					= mysql_query($Income_Bill_Query);
							while($Income_Bill_QueryStatementData		= mysql_fetch_array($Income_Bill_QueryStatement)){	
								$Others_Income	 						= $Income_Bill_QueryStatementData['amount'];
								
							}
							
									
									
							$PartyBill_Query 	= "SELECT sum(pb.RECEIVEAMOUNT) receiveamount,
														  sum(pb.PAYMENTAMOUNT) PAYMENTAMOUNT
													FROM fna_partybill pb 
													WHERE pb.PROJECTID = '".$individualProject."'
													AND pb.ENTRYDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."' 
													ORDER BY pb.ENTRYDATE ASC
												";
							$PartyBill_QueryStatement			= mysql_query($PartyBill_Query);
							while($PartyBill_QueryStatementData	= mysql_fetch_array($PartyBill_QueryStatement)){	
								$RECEIVEAMOUNT_party_Income		= $PartyBill_QueryStatementData['receiveamount'];
								$PAYMENTAMOUNT_party_Expanse	= $PartyBill_QueryStatementData['PAYMENTAMOUNT'];
								
							}
								
							$FinishStk_Query 	= "SELECT SUM(fgs.AMOUNT) amount
													FROM feed_finishedstock fgs 
													WHERE fgs.PROJECTID = '".$individualProject."'
													AND fgs.ENTDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."' 
													AND fgs.WORKFLAG = 'Out'
													ORDER BY fgs.ENTDATE ASC
												"; 
							$FinishStk_QueryStatement				= mysql_query($FinishStk_Query);
							while($FinishStk_QueryStatementData		= mysql_fetch_array($FinishStk_QueryStatement)){	
								$Amount_Recvable					= $FinishStk_QueryStatementData['amount'];
								
							}
							
							$Income_Amount				= $RECEIVEAMOUNT_party_Income + $Others_Income ;  
							
							$Expanse_Amount				= $PAYMENTAMOUNT_party_Expanse + $Expanse_Expanse ;
							$Total_Amount_Payable_Feed	= $EXPANSE_Feed_Pur - $PAYMENTAMOUNT_party_Expanse;
							$Total_Amount_global 		= $Total_Amount_global + $Total_Amount_Payable ; 
							//$FeedBalance				= $RECEIVEAMOUNT_party_global - $Total_Amount_global ;
							$Receivable_Amount			= $Amount_Recvable - $RECEIVEAMOUNT_party_Income ; 
							 
							$Balance					= $Income_Amount - $Expanse_Amount ;
							$Global_Balance				= $Global_Balance + $Balance ;
							$Global_Balance_Income		= $Global_Balance_Income + $Income_Amount ; 
							$Global_Balance_Expanse		= $Global_Balance_Expanse + $Expanse_Amount ; 
							$Global_Balance_Payable 	= $Global_Balance_Payable + $Global_Pay_Amount ; 
							$Global_Balance_Receiable	= $Global_Balance_Receiable + $Global_Rec_Amount ; 
							
							$Global_Grand_Total_Income = $Global_Grand_Total_Income + $RECEIVEAMOUNT_party_Income ; 
							
							$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000'>$PROJECTNAME</td>

											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Income_Amount,2)."</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Expanse_Amount,2)."</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_Pay_Amount,2)."</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_Rec_Amount,2)."</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Balance,2)."</td>
											
											
										</tr>

									 ";

							
						}elseif($individualProject == 1){
							
							$Expanse_Amount	 = 0;
							$PartyBill_Query 	= "SELECT sum(pb.RECEIVEAMOUNT) RECEIVEAMOUNT,
														  sum(pb.PAYMENTAMOUNT) PAYMENTAMOUNT
												FROM fna_partybill pb 
												WHERE pb.PROJECTID = '".$individualProject."'
												AND pb.ENTRYDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."' 
												
											";
							$PartyBill_QueryStatement			= mysql_query($PartyBill_Query);
							while($PartyBill_QueryStatementData	= mysql_fetch_array($PartyBill_QueryStatement)){	
								$RECEIVEAMOUNT_COLD				= $PartyBill_QueryStatementData['RECEIVEAMOUNT'];
								$PAYMENTAMOUNT_COLD				= $PartyBill_QueryStatementData['PAYMENTAMOUNT'];
								
							}
							
							$Loan_Query 	= "SELECT 	  sum(l.LOANAMOUNT) LOANAMNT,
														  sum(l.INTERESTAMOUNT) INTAMNT,
														  sum(l.LOANPAYMENT) LOANPAYMENTAMNT
												FROM fna_loan l
												WHERE l.PROJECTID = '".$individualProject."'
												AND l.ENTRYDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."' 
												
											";
							$Loan_QueryStatement				= mysql_query($Loan_Query);
							while($Loan_QueryStatementData		= mysql_fetch_array($Loan_QueryStatement)){	
								$LOANAMOUNT_ALU					= $Loan_QueryStatementData['LOANAMNT'];
								$INTERESTAMOUNT_ALU				= $Loan_QueryStatementData['INTAMNT'];
								$LOANPAYMENT_ALU				= $Loan_QueryStatementData['LOANPAYMENTAMNT'];
								
							}
							
							$TOTLOANAMOUNT			= ($LOANAMOUNT_ALU + $INTERESTAMOUNT_ALU) - $LOANPAYMENT_ALU ; 
							
							
							$BILLAMOUNT_lab = '';
							$Total_Expanse = '';
							$NetProfit = '';
							$LabBill_Query 	= "SELECT 	sum(lb.BILLAMOUNT) BILLAMOUNT,
														sum(lb.PAYMENTAMOUNT) PAYMENTAMOUNT
													FROM fna_labourbill lb 
													WHERE lb.PROJECTID = '".$individualProject."'
													AND lb.ENTRYDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'  
													
												"; 
							$LabBill_QueryStatement				= mysql_query($LabBill_Query);
							while($LabBill_QueryStatementData	= mysql_fetch_array($LabBill_QueryStatement)){	
								$AMOUNT_LAB_BILL 				= $LabBill_QueryStatementData['BILLAMOUNT'];
								$PAYMENTAMOUNT_LAB_BILL 		= $LabBill_QueryStatementData['PAYMENTAMOUNT'];
								
							}
							$Lab_Bill_Payable	= $AMOUNT_LAB_BILL - $PAYMENTAMOUNT_LAB_BILL ;
							
							$AMOUNT_exp = '';	
							$Exp_Bill_Query 	= "SELECT sum(exp.AMOUNT) AMOUNT
													FROM fna_expanse exp 
													WHERE exp.PROJECTID = '".$individualProject."'
													AND exp.EXPDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'  
													
												"; 
							$Exp_Bill_QueryStatement			= mysql_query($Exp_Bill_Query);
							while($Exp_Bill_QueryStatementData	= mysql_fetch_array($Exp_Bill_QueryStatement)){	
								$Expanse_Head_Cold			= $Exp_Bill_QueryStatementData['AMOUNT'];
								
							}
							
							$FNA_Bill_Query 	= "SELECT sum(fb.BILLAMOUNT) BILLAMOUNT
													FROM fna_bill fb
													WHERE fb.PROJECTID = '".$individualProject."'
													AND fb.ENTRYDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'  
													
												"; 
							$FNA_Bill_QueryStatement			= mysql_query($FNA_Bill_Query);
							while($FNA_Bill_QueryStatementData	= mysql_fetch_array($FNA_Bill_QueryStatement)){	
								$BILLAMOUNT_FNA	 				= $FNA_Bill_QueryStatementData['BILLAMOUNT'];
								
							}
							
							
							//$RECEIVEAMOUNT_party_Income 		= $RECEIVEAMOUNT ;
							
							//$Total_Amount_Payable				= ($AMOUNT_LAB_BILL) - ($PAYMENTAMOUNT_LAB_BILL + $RECEIVEAMOUNT_COLD) ;
							
							
							
							
							
							//$NetProfit 				= $RECEIVEAMOUNT - $Total_Expanse ;
							//$Global_Total_Expanse 	= $Global_Total_Expanse + $Total_Expanse ; 
							
							//$Global_NetProfit		= $Global_NetProfit + $NetProfit ;
							//$Global_Receive_Amount 	= $Global_Receive_Amount + $RECEIVEAMOUNT ; 
							//$Global_Billamount_lab 	= $Global_Billamount_lab + $BILLAMOUNT_lab ; 
							//$Global_Amount_Exp 		= $Global_Amount_Exp + $AMOUNT_exp ; 
							
							
							//$FeedBalance			= $RECEIVEAMOUNT_party_global - $Total_Amount_global ;
							
							//$Income_Amount_Cold		= $RECEIVEAMOUNT_COLD + $LOANPAYMENT_ALU ; 
							//$Expanse_Amount_Cold	= $PAYMENTAMOUNT_COLD + $Expanse_Head_Cold	+ $PAYMENTAMOUNT_LAB_BILL + $LOANAMOUNT_ALU ; 
							
							$Income_Amount_Cold		= $RECEIVEAMOUNT_COLD ; 
							$Expanse_Amount_Cold	= $PAYMENTAMOUNT_COLD + $Expanse_Head_Cold	+ $PAYMENTAMOUNT_LAB_BILL ; 
							$Receivable_Cold		= ($BILLAMOUNT_FNA - $RECEIVEAMOUNT_COLD) ; 
							$Total_Amount_Payable	= ($AMOUNT_LAB_BILL) - ($PAYMENTAMOUNT_LAB_BILL) ;
							$Balance_Cold			= $Income_Amount_Cold - $Expanse_Amount_Cold ;
							
							$Global_Balance			= $Global_Balance + $Balance_Cold ;
							$Global_Balance_Income	= $Global_Balance_Income + $Income_Amount_Cold ; 
							$Global_Balance_Expanse	= $Global_Balance_Expanse + $Expanse_Amount_Cold ; 
							$Global_Balance_Payable = $Global_Balance_Payable + $Total_Amount_Payable ; 
							
							$Global_Balance_Receiable	= $Global_Balance_Receiable + $Receivable_Cold ; 
							$Global_Grand_Total_Income = $Global_Grand_Total_Income + $RECEIVEAMOUNT_COLD; 
							
							$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000'>$PROJECTNAME</td>

											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Income_Amount_Cold,2)."</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Expanse_Amount_Cold,2)."</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Total_Amount_Payable,2)."</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Receivable_Cold,2)."</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Balance_Cold,2)."</td>
											
											
										</tr>

									 ";

						}elseif($individualProject == 3){
							
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
							$Global_Others_Income = 0;
							$Global_Others_Expanse = 0;
							
							
							//------------------------------------------------------------------------
							$PartyStatementQuery_Pal 	= "SELECT p.PARTYID
																FROM fna_party p 
																WHERE p.PROJECTID = '".$individualProject."'
																ORDER BY p.PARTYID ASC
															"; 
								$PartyStatementQuery_PalStatement				= mysql_query($PartyStatementQuery_Pal);
								$i = 0;
								while($PartyStatementQuery_PalStatementData		= mysql_fetch_array($PartyStatementQuery_PalStatement)){	
									$PARTYID_ARRAY_PAL[]						= $PartyStatementQuery_PalStatementData['PARTYID'];
									$i++;
								}
								
								$PARTYID_ARRAY_UNIQUE_PAL = array_unique($PARTYID_ARRAY_PAL);
								$sl = 1;	
								$Global_PurchaseBillAmount	= 0;
								$Global_SellBillAmount		= 0;
								$Global_PaymentAmount		= 0;
								$Global_receiveAmount		= 0;
								$Global_Rec_Amount_Pal = 0;
								$Global_Pay_Amount_Pal = 0;
									foreach($PARTYID_ARRAY_UNIQUE_PAL as $individualPartyPal){
									
									$Party_Query_Pal 	= "SELECT 	sum(p.PUR_BILLAMOUNT) PURBILLAMOUNT,
																sum(p.SELL_BILLAMOUNT) SELLBILLAMOUNT,
																sum(p.PAYMENTAMOUNT) PAYMENTAMOUNT,
																sum(p.RECEIVEAMOUNT) RECEIVEAMOUNT,
																party.PARTYNAME
																	FROM fna_partybill p, fna_party party
																	WHERE party.PARTYID = p.PARTYID
																	AND p.PROJECTID = '".$individualProject."'
																	AND p.PARTYID = '".$individualPartyPal."'
																	AND p.ENTRYDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
																	
																";
								$Party_Query_PalStatement						= mysql_query($Party_Query_Pal);
								$Rec_Amount_Pal = 0;
								$Pay_Amount_Pal	 = 0;
								$Balance_Amount_Pal = 0;
								while($Party_Query_PalStatementData				= mysql_fetch_array($Party_Query_PalStatement)){	
									$PURBILLAMOUNT_PAL							= $Party_Query_PalStatementData['PURBILLAMOUNT'];
									$SELLBILLAMOUNT_PAL							= $Party_Query_PalStatementData['SELLBILLAMOUNT'];
									$PAYMENTAMOUNT_PAL							= $Party_Query_PalStatementData['PAYMENTAMOUNT'];
									$RECEIVEAMOUNT_PAL							= $Party_Query_PalStatementData['RECEIVEAMOUNT'];
									$PARTYNAME_PAL								= $Party_Query_PalStatementData['PARTYNAME'];
									
								}
									
									$Balance_Amount_Pal			 = $SELLBILLAMOUNT_PAL + $PAYMENTAMOUNT_PAL  - $PURBILLAMOUNT_PAL - $RECEIVEAMOUNT_PAL ; 
									if($Balance_Amount_Pal <= 0){
										$Rec_Amount_Pal		= $RECEIVEAMOUNT_PAL + $PURBILLAMOUNT_PAL  - $SELLBILLAMOUNT_PAL - $PAYMENTAMOUNT_PAL;
									}else{
										$Pay_Amount_Pal		= $SELLBILLAMOUNT_PAL + $PAYMENTAMOUNT_PAL  - $PURBILLAMOUNT_PAL - $RECEIVEAMOUNT_PAL ;
									}
								
								
								$Global_Rec_Amount_Pal = $Global_Rec_Amount_Pal + $Rec_Amount_Pal ; 
								$Global_Pay_Amount_Pal = $Global_Pay_Amount_Pal + $Pay_Amount_Pal ; 
								
								}
								//$FinalBalance						= $SELLBILLAMOUNT + $PAYMENTAMOUNT  - $PURBILLAMOUNT - $RECEIVEAMOUNT ;
								
								
							//------------------------------------------------------------------------
							
							$PartyBill_Query 	= "SELECT sum(pb.RECEIVEAMOUNT) RECEIVEAMOUNT,
														  sum(pb.PAYMENTAMOUNT) PAYMENTAMOUNT
												FROM fna_partybill pb 
												WHERE pb.PROJECTID = '".$individualProject."'
												AND pb.ENTRYDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."' 
												
											";
							$PartyBill_QueryStatement			= mysql_query($PartyBill_Query);
							while($PartyBill_QueryStatementData	= mysql_fetch_array($PartyBill_QueryStatement)){	
								$RECEIVEAMOUNT_POUL				= $PartyBill_QueryStatementData['RECEIVEAMOUNT'];
								$PAYMENTAMOUNT_POUL				= $PartyBill_QueryStatementData['PAYMENTAMOUNT'];
								
							}
							
							//----------------------
							$OthersIncome_Query 	= "SELECT	sum(oin.INCOMEAMOUNT) INCOMEAMOUNT,
															sum(oin.EXPANSEAMOUNT) EXPANSEAMOUNT
														FROM pal_others_income_expanse oin
														WHERE oin.ENTRYDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
													";
						$OthersIncome_QueryStatement				= mysql_query($OthersIncome_Query);
						while($OthersIncome_QueryStatementData		= mysql_fetch_array($OthersIncome_QueryStatement)){	
							$INCOMEAMOUNT_othersIncome				= $OthersIncome_QueryStatementData['INCOMEAMOUNT'];
							$EXPANSEAMOUNT_othersExpanse			= $OthersIncome_QueryStatementData['EXPANSEAMOUNT'];
							
						}
						
						$Poultry_Total_Income = $RECEIVEAMOUNT_POUL + $INCOMEAMOUNT_othersIncome ;
							//---------------------	
							
							$EggSell_Query 	= "SELECT sum(es.TOTPRICE) totprice
												FROM pal_egg_sell es
												WHERE es.PROJECTID = '".$individualProject."'
												AND es.ESDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
												
											";
							$EggSell_QueryStatement				= mysql_query($EggSell_Query);
							while($EggSell_QueryStatementData	= mysql_fetch_array($EggSell_QueryStatement)){	
								$totprice_eggsell				= $EggSell_QueryStatementData['totprice'];
								
							}
							$totprice_eggsell_global = $totprice_eggsell_global + $totprice_eggsell ;
							
							$mmSell_Query 	= "SELECT SUM(mms.TOTPRICE) totalprice
													FROM pal_morog_murgi_sell mms 
													WHERE mms.PROJECTID = '".$individualProject."'
													AND mms.MMSELLDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
													
												"; 
							$mmSell_QueryStatement					= mysql_query($mmSell_Query);
							while($mmSell_QueryStatementData		= mysql_fetch_array($mmSell_QueryStatement)){	
								$totalprice_mmsell					= $mmSell_QueryStatementData['totalprice'];
								
							}
							$totalprice_mmsell_global = $totalprice_mmsell_global + $totalprice_mmsell ; 
							
							$DailyOp_Query 	= "SELECT sum(dop.SELLPRICE) sellprice
													FROM pal_dailyoperation dop
													WHERE dop.PROJECTID = '".$individualProject."'
													AND dop.DODATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
													
												"; 
							$DailyOp_QueryStatement				= mysql_query($DailyOp_Query);
							while($DailyOp_QueryStatementData	= mysql_fetch_array($DailyOp_QueryStatement)){	
								$sellprice_doper 				= $DailyOp_QueryStatementData['sellprice'];
								
							}
							$sellprice_doper_global = $sellprice_doper_global + $sellprice_doper ;
							
							$VangaEgg_Query 	= "SELECT sum(ves.PRICE) price
													FROM hatch_vangaeggsell ves
													WHERE ves.VESDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
													
												"; 
							$VangaEgg_QueryStatement				= mysql_query($VangaEgg_Query);
							while($VangaEgg_QueryStatementData		= mysql_fetch_array($VangaEgg_QueryStatement)){	
								$price_vangaegg 					= $VangaEgg_QueryStatementData['price'];
								
							}
							$Global_price_vangaegg = $Global_price_vangaegg + $price_vangaegg ; 
							
							$Exp_Bill_Query 	= "SELECT sum(exp.AMOUNT) amount
													FROM fna_expanse exp 
													WHERE exp.PROJECTID = '".$individualProject."'
													AND exp.EXPDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
													
												"; 
							$Exp_Bill_QueryStatement			= mysql_query($Exp_Bill_Query);
							while($Exp_Bill_QueryStatementData	= mysql_fetch_array($Exp_Bill_QueryStatement)){	
								$Expanse_Head_Poul 				= $Exp_Bill_QueryStatementData['amount'];
								
							}
							//$AMOUNT_exp_global = $AMOUNT_exp_global + $AMOUNT_exp ;
							
							$batch_price = '';
							
							$Batch_Query 	= "SELECT sum(bo.PRICE) price
													FROM pal_batchopen bo
													WHERE bo.BDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
													
												"; 
							$Batch_QueryStatement				= mysql_query($Batch_Query);
							while($Batch_QueryStatementData		= mysql_fetch_array($Batch_QueryStatement)){	
								$batch_price 					= $Batch_QueryStatementData['price'];
								
							}	
							$batch_price_global = $batch_price_global + $batch_price ;
						
							$FoodDist_Query 	= "SELECT sum(fd.TOTALPRICE) totprice
													FROM pal_fooddistribute fd
													WHERE fd.PROJECTID = '".$individualProject."'
													AND fd.FDDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
													
												";
							$FoodDist_QueryStatement				= mysql_query($FoodDist_Query);
							while($FoodDist_QueryStatementData		= mysql_fetch_array($FoodDist_QueryStatement)){	
								$totprice_foodDist 					= $FoodDist_QueryStatementData['totprice'];
								
							}
							$totprice_foodDist_global = $totprice_foodDist_global + $totprice_foodDist ;
							
							$MedicinDist_Query 	= "SELECT sum(md.TOTALPRICE) totprice
													FROM pal_medicine md
													WHERE md.PROJECTID = '".$individualProject."'
													AND md.MDDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
													
												"; 
							$MedicinDist_QueryStatement					= mysql_query($MedicinDist_Query);
							while($MedicinDist_QueryStatementData		= mysql_fetch_array($MedicinDist_QueryStatement)){	
								$totprice_medicineDist 					= $MedicinDist_QueryStatementData['totprice'];
								
							}
							
							$OthersIncome_Query 	= "SELECT	sum(oin.INCOMEAMOUNT) INCOMEAMOUNT,
																sum(oin.EXPANSEAMOUNT) EXPANSEAMOUNT
															FROM pal_others_income_expanse oin
															WHERE oin.ENTRYDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
															
														";
							$OthersIncome_QueryStatement				= mysql_query($OthersIncome_Query);
							while($OthersIncome_QueryStatementData		= mysql_fetch_array($OthersIncome_QueryStatement)){	
								//$INCOMEAMOUNT_othersIncome				= $OthersIncome_QueryStatementData['INCOMEAMOUNT'];
								$EXPANSEAMOUNT_othersExpanse			= $OthersIncome_QueryStatementData['EXPANSEAMOUNT'];
								
							}
							$Global_Others_Income			= $Global_Others_Income + $INCOMEAMOUNT_othersIncome ; 
							$Global_Others_Expanse			= $Global_Others_Expanse + $EXPANSEAMOUNT_othersExpanse	;
							
							
							$totprice_medicineDist_global = $totprice_medicineDist_global + $totprice_medicineDist ;
							
							$Expanse_Poultry				= $PAYMENTAMOUNT_POUL + $Expanse_Head_Poul + $EXPANSEAMOUNT_othersExpanse; 
							
							$Total_Amount_income_Poul		= $totprice_eggsell + $totalprice_mmsell +  $sellprice_doper + $price_vangaegg + $INCOMEAMOUNT_othersIncome ;
							//$Total_Amount_income_global		= $Total_Amount_income_global + $Total_Amount_income ;
							
							//$Total_Amount_Expanse_Poul	 	= $batch_price  + $totprice_foodDist +  $totprice_medicineDist + $EXPANSEAMOUNT_othersExpanse ; 
							//$Total_Amount_Expanse_global	= $Total_Amount_Expanse_global + $Total_Amount_Expanse ;
							//$Net_Profit						= $Total_Amount_income_global - $Total_Amount_Expanse_global ;
							
							
							$Receivable_Poul				= abs($totprice_eggsell + $totalprice_mmsell + $sellprice_doper +  $price_vangaegg) - $RECEIVEAMOUNT_POUL ; 
							$Balance_Poul					= $Poultry_Total_Income - $Expanse_Poultry ;
							$Global_Balance_Income			= $Global_Balance_Income + $Poultry_Total_Income;
							$Global_Balance_Expanse			= $Global_Balance_Expanse + $Expanse_Poultry ; 
							
							$Global_Balance_Receiable		= $Global_Balance_Receiable + $Receivable_Poul ; 
							
							$Total_Amount_Payable_Poul		= abs($batch_price  + $totprice_foodDist +  $totprice_medicineDist ) - $PAYMENTAMOUNT_POUL ; 
							$Global_Balance_Payable 		= $Global_Balance_Payable + $Total_Amount_Payable_Poul ;
							$Global_Balance					= $Global_Balance + $Balance_Poul ;
							$Global_Grand_Total_Income = $Global_Grand_Total_Income + $RECEIVEAMOUNT_POUL;
							
							$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000'>$PROJECTNAME</td>

											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Poultry_Total_Income,2)."</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Expanse_Poultry,2)."</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Total_Amount_Payable_Poul,2)."</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Receivable_Poul,2)."</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Balance_Poul,2)."</td>
											
											
										</tr>

									 ";
								
						}elseif($individualProject == 4){
							
							$batch_price_global = 0;	
							$price_chicksell_global = '';
							$OpenHatchEgg_price_global = 0;
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
							//------------------------------------------------------------------------
							$PartyStatementQuery 	= "SELECT p.PARTYID
																FROM fna_party p 
																WHERE p.PROJECTID = '".$individualProject."'
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
								$Global_Rec_Amount = 0;
								$Global_Pay_Amount = 0;
									foreach($PARTYID_ARRAY_UNIQUE as $individualParty){
									
									$Party_Query 	= "SELECT 	sum(p.PUR_BILLAMOUNT) PURBILLAMOUNT,
																sum(p.SELL_BILLAMOUNT) SELLBILLAMOUNT,
																sum(p.PAYMENTAMOUNT) PAYMENTAMOUNT,
																sum(p.RECEIVEAMOUNT) RECEIVEAMOUNT,
																party.PARTYNAME
																	FROM fna_partybill p, fna_party party
																	WHERE party.PARTYID = p.PARTYID
																	AND p.PROJECTID = '".$individualProject."'
																	AND p.PARTYID = '".$individualParty."'
																	AND p.ENTRYDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
																	
																";
								$Party_QueryStatement						= mysql_query($Party_Query);
								$Rec_Amount = 0;
								$Pay_Amount	 = 0;
								$Balance_Amount = 0;
								while($Party_QueryStatementData				= mysql_fetch_array($Party_QueryStatement)){	
									$PURBILLAMOUNT							= $Party_QueryStatementData['PURBILLAMOUNT'];
									$SELLBILLAMOUNT							= $Party_QueryStatementData['SELLBILLAMOUNT'];
									$PAYMENTAMOUNT							= $Party_QueryStatementData['PAYMENTAMOUNT'];
									$RECEIVEAMOUNT							= $Party_QueryStatementData['RECEIVEAMOUNT'];
									$PARTYNAME								= $Party_QueryStatementData['PARTYNAME'];
									
								}
								
									$Balance_Amount			 = $SELLBILLAMOUNT + $PAYMENTAMOUNT  - $PURBILLAMOUNT - $RECEIVEAMOUNT ; 
									if($Balance_Amount <= 0){
										$Pay_Amount		= $RECEIVEAMOUNT + $PURBILLAMOUNT  - $SELLBILLAMOUNT - $PAYMENTAMOUNT;
									}else{
										$Rec_Amount	= $SELLBILLAMOUNT + $PAYMENTAMOUNT  - $PURBILLAMOUNT - $RECEIVEAMOUNT ;
									}
								
								
								$Global_Rec_Amount = $Global_Rec_Amount + $Rec_Amount ; 
								$Global_Pay_Amount = $Global_Pay_Amount + $Pay_Amount ; 
								
								}
								//$FinalBalance						= $SELLBILLAMOUNT + $PAYMENTAMOUNT  - $PURBILLAMOUNT - $RECEIVEAMOUNT ;
								
								
							//------------------------------------------------------------------------
							
							$PartyBill_Query 	= "SELECT sum(pb.RECEIVEAMOUNT) RECEIVEAMOUNT,
														  sum(pb.PAYMENTAMOUNT) PAYMENTAMOUNT,
														  sum(pb.PUR_BILLAMOUNT) PUR_BILLAMOUNT,
														  sum(pb.SELL_BILLAMOUNT) SELL_BILLAMOUNT
												FROM fna_partybill pb 
												WHERE pb.PROJECTID = '".$individualProject."'
												AND pb.ENTRYDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."' 
												
											";
							$PartyBill_QueryStatement			= mysql_query($PartyBill_Query);
							while($PartyBill_QueryStatementData	= mysql_fetch_array($PartyBill_QueryStatement)){	
								echo $RECEIVEAMOUNT_Hatch			= $PartyBill_QueryStatementData['RECEIVEAMOUNT'];
								$PAYMENTAMOUNT_Hatch			= $PartyBill_QueryStatementData['PAYMENTAMOUNT'];
								$PUR_BILLAMOUNT_Hatch			= $PartyBill_QueryStatementData['PUR_BILLAMOUNT'];
								$SELL_BILLAMOUNT_Hatch			= $PartyBill_QueryStatementData['SELL_BILLAMOUNT'];
								
								
								
							}	
							
							
							
							
							
								
							$ChickenSell_Query 	= "SELECT sum(hcp.PRICE) price
												FROM hatch_chicken_production hcp 
												WHERE hcp.PROJECTID = '".$individualProject."'
												AND hcp.CPDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
												AND hcp.WORKSFLAG = 'Out'
												
											";
							$ChickenSell_QueryStatement				= mysql_query($ChickenSell_Query);
							while($ChickenSell_QueryStatementData	= mysql_fetch_array($ChickenSell_QueryStatement)){	
							 	$price_chicksell					= $ChickenSell_QueryStatementData['price'];
								
							}
							$price_chicksell_global = $price_chicksell_global + $price_chicksell ;
							
							$VangaEgg_Query 	= "SELECT sum(ves.PRICE) price
													FROM hatch_vangaeggsell ves
													WHERE ves.VESDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
													
												"; 
							$VangaEgg_QueryStatement				= mysql_query($VangaEgg_Query);
							while($VangaEgg_QueryStatementData		= mysql_fetch_array($VangaEgg_QueryStatement)){	
								$price_vangaegg 					= $VangaEgg_QueryStatementData['price'];
								
							}
							$Global_price_vangaegg = $Global_price_vangaegg + $price_vangaegg ; 
							
							$Exp_Bill_Query 	= "SELECT sum(exp.AMOUNT) amount
													FROM fna_expanse exp 
													WHERE exp.PROJECTID = '".$individualProject."'
													AND exp.EXPDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
													
												"; 
							$Exp_Bill_QueryStatement			= mysql_query($Exp_Bill_Query);
							while($Exp_Bill_QueryStatementData	= mysql_fetch_array($Exp_Bill_QueryStatement)){	
								$AMOUNT_exp_Hatch 				= $Exp_Bill_QueryStatementData['amount'];
								
							}
							$AMOUNT_exp_global = $AMOUNT_exp_global + $AMOUNT_exp_Hatch ;
							
							$batch_price = '';
							
							$OpenHatch_Query 	= "SELECT sum(ohe.PRICE) price
													FROM hatch_opening_hatching_egg ohe
													WHERE ohe.PROJECTID = '".$individualProject."'
													AND ohe.OPENDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
													AND ohe.STATUS = 'In'
													
												"; 
							$OpenHatch_QueryStatement				= mysql_query($OpenHatch_Query);
							while($OpenHatch_QueryStatementData		= mysql_fetch_array($OpenHatch_QueryStatement)){	
								$OpenHatchEgg_price					= $OpenHatch_QueryStatementData['price'];
								
							}	
							$OpenHatchEgg_price_global 			= $OpenHatchEgg_price_global + $OpenHatchEgg_price ;
							
							$Total_Amount_income_Hatch			= $price_chicksell + $price_vangaegg;
							//$Total_Amount_income_global			= $Total_Amount_income_global + $Total_Amount_income_Hatch ;
							
							$Total_Amount_Expanse_Hatch		 	= $OpenHatchEgg_price + $AMOUNT_exp_Hatch ; 
							//$Total_Amount_Expanse_global		= $Total_Amount_Expanse_global + $Total_Amount_Expanse_Hatch ;
							//$Net_Profit							= $Total_Amount_income_global - $Total_Amount_Expanse_global ;
							
							
							
							$Receivable_Hatch					= abs(($price_chicksell + $price_vangaegg) -  $RECEIVEAMOUNT_Hatch) ; 
							$Balance_Hatch						= $price_chicksell - $Total_Amount_Expanse_Hatch ;
							$Total_Amount_Payable_Hatch			= abs($OpenHatchEgg_price - $PAYMENTAMOUNT_Hatch)  ;
							
							$Global_Balance						= $Global_Balance + $Balance_Hatch ;
							$Global_Balance_Income				= $Global_Balance_Income + $price_chicksell ;
							$Global_Balance_Expanse				= $Global_Balance_Expanse + $Total_Amount_Expanse_Hatch ; 
							$Global_Balance_Payable 			= $Global_Balance_Payable + $Global_Pay_Amount ; 
							$Global_Balance_Receiable			= $Global_Balance_Receiable + $Global_Rec_Amount ; 
							
							$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000'>$PROJECTNAME</td>

											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($price_chicksell,2)."</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Total_Amount_Expanse_Hatch,2)."</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_Pay_Amount,2)."</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_Rec_Amount,2)."</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Balance_Hatch,2)."</td>
											
											
										</tr>

									 ";
						
						}elseif($individualProject == 5){
							
										//------------------------------------------------------------------------
										$PartyStatementQuery 	= "SELECT p.PARTYID
																			FROM fna_party p 
																			WHERE p.PROJECTID = '".$individualProject."'
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
											$Global_Rec_Amount = 0;
											$Global_Pay_Amount = 0;
												foreach($PARTYID_ARRAY_UNIQUE as $individualParty){
												
												$Party_Query 	= "SELECT 	sum(p.PUR_BILLAMOUNT) PURBILLAMOUNT,
																			sum(p.SELL_BILLAMOUNT) SELLBILLAMOUNT,
																			sum(p.PAYMENTAMOUNT) PAYMENTAMOUNT,
																			sum(p.RECEIVEAMOUNT) RECEIVEAMOUNT,
																			party.PARTYNAME
																				FROM fna_partybill p, fna_party party
																				WHERE party.PARTYID = p.PARTYID
																				AND p.PROJECTID = '".$individualProject."'
																				AND p.PARTYID = '".$individualParty."'
																				AND p.ENTRYDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
																				
																			";
											$Party_QueryStatement						= mysql_query($Party_Query);
											$Rec_Amount = 0;
											$Pay_Amount	 = 0;
											$Balance_Amount = 0;
											while($Party_QueryStatementData				= mysql_fetch_array($Party_QueryStatement)){	
												$PURBILLAMOUNT							= $Party_QueryStatementData['PURBILLAMOUNT'];
												$SELLBILLAMOUNT							= $Party_QueryStatementData['SELLBILLAMOUNT'];
												$PAYMENTAMOUNT							= $Party_QueryStatementData['PAYMENTAMOUNT'];
												$RECEIVEAMOUNT							= $Party_QueryStatementData['RECEIVEAMOUNT'];
												$PARTYNAME								= $Party_QueryStatementData['PARTYNAME'];
												
											}
											
												$Balance_Amount			 = $SELLBILLAMOUNT + $PAYMENTAMOUNT  - $PURBILLAMOUNT - $RECEIVEAMOUNT ; 
												if($Balance_Amount <= 0){
													$Pay_Amount		= $RECEIVEAMOUNT + $PURBILLAMOUNT  - $SELLBILLAMOUNT - $PAYMENTAMOUNT;
												}else{
													$Rec_Amount	= $SELLBILLAMOUNT + $PAYMENTAMOUNT  - $PURBILLAMOUNT - $RECEIVEAMOUNT ;
												}
											
											
											$Global_Rec_Amount = $Global_Rec_Amount + $Rec_Amount ; 
											$Global_Pay_Amount = $Global_Pay_Amount + $Pay_Amount ; 
											
											}
											//$FinalBalance						= $SELLBILLAMOUNT + $PAYMENTAMOUNT  - $PURBILLAMOUNT - $RECEIVEAMOUNT ;
											
											
										//------------------------------------------------------------------------
										$RMP_Query_Med 	= "SELECT sum(rmp.AMOUNT) amount
																FROM feed_purchaserawmat rmp
																WHERE rmp.PROJECTID = '".$individualProject."'
																AND rmp.PURCHASEDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
																ORDER BY '".$ENTRYDATE_FROM."' ASC
															"; 
										$RMP_Query_MedStatement				= mysql_query($RMP_Query_Med);
										while($RMP_Query_MedStatementData	= mysql_fetch_array($RMP_Query_MedStatement)){	
											$EXPANSE_Purc_Medicine			= $RMP_Query_MedStatementData['amount'];
											
										}
										
										$Exp_Bill_Query_Med 	= "SELECT sum(exp.AMOUNT) amount
																		FROM fna_expanse exp 
																		WHERE exp.PROJECTID = '".$individualProject."'
																		AND exp.EXPDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
																		ORDER BY exp.EXPDATE ASC
																	"; 
										$Exp_Bill_Query_MedStatement			= mysql_query($Exp_Bill_Query_Med);
										while($Exp_Bill_Query_MedStatementData	= mysql_fetch_array($Exp_Bill_Query_MedStatement)){	
											$Expanse_Medicine	 				= $Exp_Bill_Query_MedStatementData['amount'];
											
										}
										
												
										 
										
																			
										$PartyBill_Query_Med 	= "SELECT sum(pb.RECEIVEAMOUNT) receiveamount,
																		  sum(pb.PAYMENTAMOUNT) PAYMENTAMOUNT,
																		  sum(pb.SELL_BILLAMOUNT) SELL_BILLAMOUNT,
																		  sum(pb.PUR_BILLAMOUNT) PUR_BILLAMOUNT
																	FROM fna_partybill pb 
																	WHERE pb.PROJECTID = '".$individualProject."'
																	AND pb.ENTRYDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."' 
																	ORDER BY pb.ENTRYDATE ASC
																";
										$PartyBill_Query_MedStatement				= mysql_query($PartyBill_Query_Med);
										while($PartyBill_Query_MedStatementData		= mysql_fetch_array($PartyBill_Query_MedStatement)){	
											$RECEIVEAMOUNT_party_Medicine			= $PartyBill_Query_MedStatementData['receiveamount'];
											$PAYMENTAMOUNT_party_Medicine			= $PartyBill_Query_MedStatementData['PAYMENTAMOUNT'];
											$Sell_BillAmount_Medicine				= $PartyBill_Query_MedStatementData['SELL_BILLAMOUNT'];
											$Pur_BillAmount_Medicine				= $PartyBill_Query_MedStatementData['PUR_BILLAMOUNT'];
											
										}
											
										$Balance_Amount_Medicine		= $RECEIVEAMOUNT_party_Medicine - $PAYMENTAMOUNT_party_Medicine ; 
										$Medicine_Expanse_Receivable	= $Sell_BillAmount_Medicine - $RECEIVEAMOUNT_party_Medicine ;
										$Medicine_Expanse_Payable		= $Pur_BillAmount_Medicine - $PAYMENTAMOUNT_party_Medicine ;
										$Global_Balance					= $Global_Balance + $Balance_Amount_Medicine ;
										$Global_Balance_Income			= $Global_Balance_Income + $RECEIVEAMOUNT_party_Medicine ;
										$Global_Balance_Expanse			= $Global_Balance_Expanse + $PAYMENTAMOUNT_party_Medicine ; 
										$Global_Balance_Payable 		= $Global_Balance_Payable + $Global_Pay_Amount ; 
										$Global_Balance_Receiable		= $Global_Balance_Receiable + $Global_Rec_Amount ; 
							
										
										$tableView .=" <tr>
														<td align='center' valign='top' style='border: 1px dotted #000'>$PROJECTNAME</td>
			
														<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($RECEIVEAMOUNT_party_Medicine,2)."</td>
														
														<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($PAYMENTAMOUNT_party_Medicine,2)."</td>
								
														<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_Pay_Amount,2)."</td>
								
														<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_Rec_Amount,2)."</td>
														
														<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Balance_Amount_Medicine,2)."</td>
														
														
													</tr>
			
												 ";
							
						
						}elseif($individualProject == 6){
							
							$Masjid_Query 	= "SELECT sum(balance.INCOME) INCOME,
													  sum(balance.EXPANSE) EXPANSE
													FROM fna_balance balance
													WHERE balance.PROJECTID = '".$individualProject."'
													AND balance.BALDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
													
													
												"; 
							$Masjid_QueryStatement						= mysql_query($Masjid_Query);
							while($Masjid_QueryStatementData			= mysql_fetch_array($Masjid_QueryStatement)){	
								$INCOME_MASJID							= $Masjid_QueryStatementData['INCOME'];
								$EXPANSE_MASJID							= $Masjid_QueryStatementData['EXPANSE'];
								
							}	
							
							
							$Masjid_Balance			= $INCOME_MASJID - $EXPANSE_MASJID ;
							$Global_Balance			= $Global_Balance + $Masjid_Balance ;
							$Global_Balance_Income			= $Global_Balance_Income + $INCOME_MASJID ; 
							$Global_Balance_Expanse			= $Global_Balance_Expanse + $EXPANSE_MASJID ; 
							
							
							$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000'>$PROJECTNAME</td>

											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($INCOME_MASJID,2)."</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($EXPANSE_MASJID,2)."</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format(0,2)."</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format(0,2)."</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Masjid_Balance,2)."</td>
											
											
										</tr>

									 ";
						
						
						
						}elseif($individualProject == 7){
							
							$Masjid_Query 	= "SELECT sum(balance.INCOME) INCOME,
													  sum(balance.EXPANSE) EXPANSE
													FROM fna_balance balance
													WHERE balance.PROJECTID = '".$individualProject."'
													AND balance.BALDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
													
													
												"; 
							$Masjid_QueryStatement						= mysql_query($Masjid_Query);
							while($Masjid_QueryStatementData			= mysql_fetch_array($Masjid_QueryStatement)){	
								$INCOME_MASJID							= $Masjid_QueryStatementData['INCOME'];
								$EXPANSE_MASJID							= $Masjid_QueryStatementData['EXPANSE'];
								
							}	
							
							
							$Masjid_Balance			= $INCOME_MASJID - $EXPANSE_MASJID ;
							$Global_Balance			= $Global_Balance + $Masjid_Balance ;
							$Global_Balance_Income			= $Global_Balance_Income + $INCOME_MASJID ;
							$Global_Balance_Expanse			= $Global_Balance_Expanse + $EXPANSE_MASJID ; 
							
							$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000'>$PROJECTNAME</td>

											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($INCOME_MASJID,2)."</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($EXPANSE_MASJID,2)."</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format(0,2)."</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format(0,2)."</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Masjid_Balance,2)."</td>
											
											
										</tr>

									 ";
						
						
						
						}elseif($individualProject == 8){
							
							$Bank_Query 	= "SELECT sum(bank.DEPOSIT) DEPOSIT,
													  sum(bank.WITHDRAW) WITHDRAW
													FROM fna_banktransaction bank
													WHERE bank.PROJECTID = '".$individualProject."'
													AND bank.BTDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
													
													
												"; 
							$Bank_QueryStatement					= mysql_query($Bank_Query);
							while($Bank_QueryStatementData			= mysql_fetch_array($Bank_QueryStatement)){	
								$DEPOSIT							= $Bank_QueryStatementData['DEPOSIT'];
								$WITHDRAW							= $Bank_QueryStatementData['WITHDRAW'];
								
							}	
							
							$Bank_FLAG_Query		= mysql_fetch_array(mysql_query("SELECT MAX(BANKFLAG) FROM fna_banktransaction"));
							$Bank_FLAG				= $Bank_FLAG_Query['MAX(BANKFLAG)'];
							
							$Bank_Balance_Query		= mysql_fetch_array(mysql_query("SELECT BALANCE FROM fna_banktransaction WHERE BANKFLAG = '".$Bank_FLAG."'"));
							$Bank_Balance			= $Bank_Balance_Query['BALANCE'];
							
							$Total_Bank_Balance		=  $DEPOSIT - $WITHDRAW; 
							$Global_Balance			= $Global_Balance - $Total_Bank_Balance ;
							$Global_Balance_Income			= $Global_Balance_Income + $WITHDRAW ;
							$Global_Balance_Expanse			= $Global_Balance_Expanse + $DEPOSIT ; 
							
							$tableView .=" <tr style='font-weight:bold;'>
											<td align='center' valign='top' style='border: 1px dotted #000'>$PROJECTNAME</td>

											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($WITHDRAW,2)."</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($DEPOSIT,2)."</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format(0,2)."</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format(0,2)."</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Total_Bank_Balance,2)."</td>
											
											
										</tr>

									 ";
						
						}elseif($individualProject == 9){
							
							$RMP_Query_DanKhat 	= "SELECT sum(rmp.AMOUNT) amount
																FROM feed_purchaserawmat rmp
																WHERE rmp.PROJECTID = '".$individualProject."'
																AND rmp.PURCHASEDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
																ORDER BY '".$ENTRYDATE_FROM."' ASC
															"; 
										$RMP_Query_DanKhatStatement				= mysql_query($RMP_Query_DanKhat);
										while($RMP_Query_DanKhatStatementData	= mysql_fetch_array($RMP_Query_DanKhatStatement)){	
											$EXPANSE_Purc_DanKhat				= $RMP_Query_DanKhatStatementData['amount'];
											
										}
																				
																			
										$PartyBill_Query_DanKhat 	= "SELECT sum(pb.RECEIVEAMOUNT) receiveamount,
																		  sum(pb.PAYMENTAMOUNT) PAYMENTAMOUNT,
																		  sum(pb.SELL_BILLAMOUNT) SELL_BILLAMOUNT,
																		  sum(pb.PUR_BILLAMOUNT) PUR_BILLAMOUNT
																	FROM fna_partybill pb 
																	WHERE pb.PROJECTID = '".$individualProject."'
																	AND pb.ENTRYDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."' 
																	ORDER BY pb.ENTRYDATE ASC
																";
										$PartyBill_Query_DanKhatStatement				= mysql_query($PartyBill_Query_DanKhat);
										while($PartyBill_Query_DanKhatStatementData		= mysql_fetch_array($PartyBill_Query_DanKhatStatement)){	
											$RECEIVEAMOUNT_party_DanKhat				= $PartyBill_Query_DanKhatStatementData['receiveamount'];
											$PAYMENTAMOUNT_party_DanKhat				= $PartyBill_Query_DanKhatStatementData['PAYMENTAMOUNT'];
											$Sell_BillAmount_DanKhat					= $PartyBill_Query_DanKhatStatementData['SELL_BILLAMOUNT'];
											$Pur_BillAmount_DanKhat						= $PartyBill_Query_DanKhatStatementData['PUR_BILLAMOUNT'];
											
										}
											
										$Balance_Amount_DanKhat			= $RECEIVEAMOUNT_party_Medicine - $PAYMENTAMOUNT_party_Medicine ; 
										$DanKhat_Expanse_Receivable		= $Sell_BillAmount_Medicine - $RECEIVEAMOUNT_party_Medicine ;
										$DanKhat_Expanse_Payable		= $EXPANSE_Purc_DanKhat - $PAYMENTAMOUNT_party_DanKhat ;
										
							$AMOUNT_exp_DanKhat_global = 0;
							
							$Madrasa_Query 	= "SELECT sum(balance.INCOME) INCOME,
													  sum(balance.EXPANSE) EXPANSE
													FROM fna_balance balance
													WHERE balance.PROJECTID = '".$individualProject."'
													AND balance.BALDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
													
													
												"; 
							$Madrasa_QueryStatement						= mysql_query($Madrasa_Query);
							while($Madrasa_QueryStatementData			= mysql_fetch_array($Madrasa_QueryStatement)){	
								$INCOME									= $Madrasa_QueryStatementData['INCOME'];
								$EXPANSE								= $Madrasa_QueryStatementData['EXPANSE'];
								
							}	
							
							
							
							$Exp_Bill_Query_DanKhat 	= "SELECT sum(exp.AMOUNT) amount
																FROM fna_expanse exp 
																WHERE exp.PROJECTID = '".$individualProject."'
																AND exp.EXPDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
																
															"; 
							$Exp_Bill_Query_DanKhatStatement			= mysql_query($Exp_Bill_Query_DanKhat);
							while($Exp_Bill_Query_DanKhatStatementData	= mysql_fetch_array($Exp_Bill_Query_DanKhatStatement)){	
								$AMOUNT_exp_DanKhat						= $Exp_Bill_Query_DanKhatStatementData['amount'];
								
							}
							$DanKhat_Expanse			= $AMOUNT_exp_DanKhat + $PAYMENTAMOUNT_party_DanKhat ;
							$Madrasa_Balance			= $INCOME - $DanKhat_Expanse ;
							$Global_Balance				= $Global_Balance + $Madrasa_Balance ;
							$Global_Balance_Income			= $Global_Balance_Income + $INCOME ; 
							$Global_Balance_Expanse			= $Global_Balance_Expanse + $DanKhat_Expanse ; 
							$Global_Balance_Payable 		= $Global_Balance_Payable + $DanKhat_Expanse_Payable ; 
							
							$AMOUNT_exp_DanKhat_global  = abs(($AMOUNT_exp_DanKhat_global + $AMOUNT_exp_DanKhat) -  ($EXPANSE + $EXPANSE_Purc_DanKhat));
							
							
							$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000'>$PROJECTNAME</td>

											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($INCOME,2)."</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($DanKhat_Expanse,2)."</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($DanKhat_Expanse_Payable,2)."</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format(0,2)."</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Madrasa_Balance,2)."</td>
											
											
										</tr>

									 ";
						
						
						
						}/*elseif($individualProject == 10){
							
							$Masjid_Query 	= "SELECT sum(balance.INCOME) INCOME,
													  sum(balance.EXPANSE) EXPANSE
													FROM fna_balance balance
													WHERE balance.PROJECTID = '".$individualProject."'
													AND balance.BALDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
													
													
												"; 
							$Masjid_QueryStatement						= mysql_query($Masjid_Query);
							while($Masjid_QueryStatementData			= mysql_fetch_array($Masjid_QueryStatement)){	
								$INCOME_MASJID							= $Masjid_QueryStatementData['INCOME'];
								$EXPANSE_MASJID							= $Masjid_QueryStatementData['EXPANSE'];
								
							}	
							
							
							$Masjid_Balance			= $INCOME_MASJID - $EXPANSE_MASJID ;
							$Global_Balance			= $Global_Balance + $Masjid_Balance ;
							
							$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000'>$PROJECTNAME</td>

											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($INCOME_MASJID,2)."</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($EXPANSE_MASJID,2)."</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format(0,2)."</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format(0,2)."</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Masjid_Balance,2)."</td>
											
											
										</tr>

									 ";
						
						
						
						}*/elseif($individualProject == 11){
							
							$Masjid_Query 	= "SELECT sum(balance.INCOME) INCOME,
													  sum(balance.EXPANSE) EXPANSE
													FROM fna_balance balance
													WHERE balance.PROJECTID = '".$individualProject."'
													AND balance.BALDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
													
													
												"; 
							$Masjid_QueryStatement						= mysql_query($Masjid_Query);
							while($Masjid_QueryStatementData			= mysql_fetch_array($Masjid_QueryStatement)){	
								$INCOME_MASJID							= $Masjid_QueryStatementData['INCOME'];
								$EXPANSE_MASJID							= $Masjid_QueryStatementData['EXPANSE'];
								
							}	
							
							
							$Masjid_Balance			= $INCOME_MASJID - $EXPANSE_MASJID ;
							$Global_Balance			= $Global_Balance + $Masjid_Balance ;
							$Global_Balance_Income			= $Global_Balance_Income + $INCOME_MASJID ; 
							$Global_Balance_Expanse			= $Global_Balance_Expanse + $EXPANSE_MASJID ; 
							
							$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000'>$PROJECTNAME</td>

											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($INCOME_MASJID,2)."</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($EXPANSE_MASJID,2)."</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format(0,2)."</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format(0,2)."</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Masjid_Balance,2)."</td>
											
											
										</tr>

									 ";
						
						
						
						}elseif($individualProject == 13){
							
							$Masjid_Query 	= "SELECT sum(balance.INCOME) INCOME,
													  sum(balance.EXPANSE) EXPANSE
													FROM fna_balance balance
													WHERE balance.PROJECTID = '".$individualProject."'
													AND balance.BALDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
													
													
												"; 
							$Masjid_QueryStatement						= mysql_query($Masjid_Query);
							while($Masjid_QueryStatementData			= mysql_fetch_array($Masjid_QueryStatement)){	
								$INCOME_MASJID							= $Masjid_QueryStatementData['INCOME'];
								$EXPANSE_MASJID							= $Masjid_QueryStatementData['EXPANSE'];
								
							}	
							
							
							$Masjid_Balance					= $INCOME_MASJID - $EXPANSE_MASJID ;
							$Global_Balance					= $Global_Balance + $Masjid_Balance ;
							$Global_Balance_Income			= $Global_Balance_Income + $INCOME_MASJID ; 
							$Global_Balance_Expanse			= $Global_Balance_Expanse + $EXPANSE_MASJID ; 
							
							$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000'>$PROJECTNAME</td>

											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($INCOME_MASJID,2)."</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($EXPANSE_MASJID,2)."</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format(0,2)."</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format(0,2)."</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Masjid_Balance,2)."</td>
											
											
										</tr>

									 ";
						
						
						
						}elseif($individualProject == 14){
							
							$Masjid_Query 	= "SELECT sum(balance.INCOME) INCOME,
													  sum(balance.EXPANSE) EXPANSE
													FROM fna_balance balance
													WHERE balance.PROJECTID = '".$individualProject."'
													AND balance.BALDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
													
													
												"; 
							$Masjid_QueryStatement						= mysql_query($Masjid_Query);
							while($Masjid_QueryStatementData			= mysql_fetch_array($Masjid_QueryStatement)){	
								$INCOME_MASJID							= $Masjid_QueryStatementData['INCOME'];
								$EXPANSE_MASJID							= $Masjid_QueryStatementData['EXPANSE'];
								
							}	
							
							
							$Masjid_Balance					= $INCOME_MASJID - $EXPANSE_MASJID ;
							$Global_Balance					= $Global_Balance + $Masjid_Balance ;
							$Global_Balance_Income			= $Global_Balance_Income + $INCOME_MASJID ; 
							$Global_Balance_Expanse			= $Global_Balance_Expanse + $EXPANSE_MASJID ; 
							
							$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000'>$PROJECTNAME</td>

											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($INCOME_MASJID,2)."</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($EXPANSE_MASJID,2)."</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format(0,2)."</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format(0,2)."</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Masjid_Balance,2)."</td>
											
											
										</tr>

									 ";
						
						
						
						}elseif($individualProject == 12){
							
							$Masjid_Query 	= "SELECT sum(balance.INCOME) INCOME,
													  sum(balance.EXPANSE) EXPANSE
													FROM fna_balance balance
													WHERE balance.PROJECTID = '".$individualProject."'
													AND balance.BALDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
													
													
												"; 
							$Masjid_QueryStatement						= mysql_query($Masjid_Query);
							while($Masjid_QueryStatementData			= mysql_fetch_array($Masjid_QueryStatement)){	
								$INCOME_MASJID							= $Masjid_QueryStatementData['INCOME'];
								$EXPANSE_MASJID							= $Masjid_QueryStatementData['EXPANSE'];
								
							}	
							//-------------------------------------------------------------------------------------------------------------------
							
							$RMP_Query 	= "SELECT sum(rmp.AMOUNT) amount
													FROM feed_purchaserawmat rmp
													WHERE rmp.PROJECTID = '".$individualProject."'
													AND rmp.PURCHASEDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
													ORDER BY '".$ENTRYDATE_FROM."' ASC
												"; 
							$RMP_QueryStatement				= mysql_query($RMP_Query);
							while($RMP_QueryStatementData	= mysql_fetch_array($RMP_QueryStatement)){	
								$EXPANSE_Pur_ComDev			= $RMP_QueryStatementData['amount'];
								
							}
							
							$Exp_Bill_Query 	= "SELECT sum(exp.AMOUNT) amount
													FROM fna_expanse exp 
													WHERE exp.PROJECTID = '".$individualProject."'
													AND exp.EXPDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
													ORDER BY exp.EXPDATE ASC
												"; 
							$Exp_Bill_QueryStatement			= mysql_query($Exp_Bill_Query);
							while($Exp_Bill_QueryStatementData	= mysql_fetch_array($Exp_Bill_QueryStatement)){	
								$Expanse_ComDev 				= $Exp_Bill_QueryStatementData['amount'];
								
							}
							
									
									
							$PartyBill_Query 	= "SELECT sum(pb.RECEIVEAMOUNT) receiveamount,
														  sum(pb.PAYMENTAMOUNT) PAYMENTAMOUNT
													FROM fna_partybill pb 
													WHERE pb.PROJECTID = '".$individualProject."'
													AND pb.ENTRYDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."' 
													ORDER BY pb.ENTRYDATE ASC
												";
							$PartyBill_QueryStatement			= mysql_query($PartyBill_Query);
							while($PartyBill_QueryStatementData	= mysql_fetch_array($PartyBill_QueryStatement)){	
								$RECEIVEAMOUNT_party_Income		= $PartyBill_QueryStatementData['receiveamount'];
								$PAYMENTAMOUNT_party_Expanse	= $PartyBill_QueryStatementData['PAYMENTAMOUNT'];
								
							}
							
							$LabBill_Query 	= "SELECT sum(lb.BILLAMOUNT) BILLAMOUNT,
						 						  sum(lb.PAYMENTAMOUNT) PAYMENTAMOUNT
												FROM fna_labourbill lb 
												WHERE lb.PROJECTID = '".$individualProject."'
												AND lb.ENTRYDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'  
												
											"; 
							$LabBill_QueryStatement				= mysql_query($LabBill_Query);
							while($LabBill_QueryStatementData	= mysql_fetch_array($LabBill_QueryStatement)){	
								$BILLAMOUNT_lab 				= $LabBill_QueryStatementData['BILLAMOUNT'];
								$PAYMENTAMOUNT_lab 				= $LabBill_QueryStatementData['PAYMENTAMOUNT'];
								
							}
							
							$Expanse_Amount_Cold				= $PAYMENTAMOUNT_party_Expanse + $Expanse_ComDev	+ $PAYMENTAMOUNT_lab;
								
							/*$FinishStk_Query 	= "SELECT SUM(fgs.AMOUNT) amount
													FROM feed_finishedstock fgs 
													WHERE fgs.PROJECTID = '".$individualProject."'
													AND fgs.ENTDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."' 
													AND fgs.WORKFLAG = 'Out'
													ORDER BY fgs.ENTDATE ASC
												"; 
							$FinishStk_QueryStatement				= mysql_query($FinishStk_Query);
							while($FinishStk_QueryStatementData		= mysql_fetch_array($FinishStk_QueryStatement)){	
								$Amount_Recvable					= $FinishStk_QueryStatementData['amount'];
								
							}*/
							
							//-------------------------------------------------------------------------------------------------------------------
							$Payable_Amount_ComDev			= ($EXPANSE_Pur_ComDev + $RECEIVEAMOUNT_party_Income) - $PAYMENTAMOUNT_party_Expanse ;  	
							$Masjid_Balance					= $INCOME_MASJID - $Expanse_Amount_Cold ;
							$Global_Balance					= $Global_Balance + $Masjid_Balance ;
							$Global_Balance_Income			= $Global_Balance_Income + $INCOME_MASJID ; 
							$Global_Balance_Expanse			= $Global_Balance_Expanse + $Expanse_Amount_Cold ; 
							$Global_Balance_Payable 		= $Global_Balance_Payable + $Payable_Amount_ComDev ; 
							
							$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000'>$PROJECTNAME</td>

											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($INCOME_MASJID,2)."</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Expanse_Amount_Cold,2)."</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Payable_Amount_ComDev,2)."</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format(0,2)."</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Masjid_Balance,2)."</td>
											
											
										</tr>

									 ";
						
						
						
						}elseif($individualProject == 15){
							
							$Masjid_Query 	= "SELECT sum(balance.INCOME) INCOME,
													  sum(balance.EXPANSE) EXPANSE
													FROM fna_balance balance
													WHERE balance.PROJECTID = '".$individualProject."'
													AND balance.BALDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
													
													
												"; 
							$Masjid_QueryStatement						= mysql_query($Masjid_Query);
							while($Masjid_QueryStatementData			= mysql_fetch_array($Masjid_QueryStatement)){	
								$INCOME_MASJID							= $Masjid_QueryStatementData['INCOME'];
								$EXPANSE_MASJID							= $Masjid_QueryStatementData['EXPANSE'];
								
							}	
							
							
							$Masjid_Balance					= $INCOME_MASJID - $EXPANSE_MASJID ;
							$Global_Balance					= $Global_Balance + $Masjid_Balance ;
							$Global_Balance_Income			= $Global_Balance_Income + $INCOME_MASJID ; 
							$Global_Balance_Expanse			= $Global_Balance_Expanse + $EXPANSE_MASJID ; 
							
							$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000'>$PROJECTNAME</td>

											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($INCOME_MASJID,2)."</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($EXPANSE_MASJID,2)."</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format(0,2)."</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format(0,2)."</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Masjid_Balance,2)."</td>
											
											
										</tr>

									 ";
						
						
						
						}elseif($individualProject == 16){
							
							$Masjid_Query 	= "SELECT sum(balance.INCOME) INCOME,
													  sum(balance.EXPANSE) EXPANSE
													FROM fna_balance balance
													WHERE balance.PROJECTID = '".$individualProject."'
													AND balance.BALDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
													
													
												"; 
							$Masjid_QueryStatement						= mysql_query($Masjid_Query);
							while($Masjid_QueryStatementData			= mysql_fetch_array($Masjid_QueryStatement)){	
								$INCOME_MASJID							= $Masjid_QueryStatementData['INCOME'];
								$EXPANSE_MASJID							= $Masjid_QueryStatementData['EXPANSE'];
								
							}	
							
							
							$Masjid_Balance					= $INCOME_MASJID - $EXPANSE_MASJID ;
							$Global_Balance					= $Global_Balance + $Masjid_Balance ;
							$Global_Balance_Income			= $Global_Balance_Income + $INCOME_MASJID ; 
							$Global_Balance_Expanse			= $Global_Balance_Expanse + $EXPANSE_MASJID ; 
							
							$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000'>$PROJECTNAME</td>

											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($INCOME_MASJID,2)."</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($EXPANSE_MASJID,2)."</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format(0,2)."</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format(0,2)."</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Masjid_Balance,2)."</td>
											
											
										</tr>

									 ";
						
						
						
						}
						
						
						
								// Dynamic Row End		  

						
				
				}

					$tableView .="

						<tr style='font-weight:bold;'>

							<td align='right' valign='top' style='border: 1px dotted #000'>Grand Total:</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_Balance_Income,2)."</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_Balance_Expanse,2)."</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_Balance_Payable,2)."</td>
							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_Balance_Receiable,2)."</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_Balance,2)."</td>
							
						</tr>
						<tr style='font-weight:bold;'>

							<td colspan='6' align='center' valign='top' style='border: 1px dotted #000'>Cash in Hand      : ".number_format($Global_Balance,2)."</td>

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

							<td colspan='6' align='left' valign='top' >
								<table width='100%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:100%;'>
								  <tr>
									<td align='right' width='34%' valign='bottom' ><hr width='200' ></td>
									<td width='33%' valign='bottom' ><hr width='200' ></td>
									<td width='33%' valign='bottom' ><hr width='200' ></td>
								  </tr>
								  <tr>
									<td align='center' valign='top'  ><b>Manager's Signature</b></td>
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