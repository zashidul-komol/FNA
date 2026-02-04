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
	$ENTRYDATE			= showDateMySQlFormat($_REQUEST['ENTRYDATE']);
	$userId 			= $_REQUEST['userId'];
	$con = '';
	
	
	//Ministry/Division and Project/Programme Name View Report Start	
	
	
	 	$projectSql 	= "
							SELECT PROJECTNAME											
							FROM fna_project 
							WHERE PROJECTID = '".$PROJECTID."'
							
						";
			$projectSqlStatement				= mysql_query($projectSql);
			while($projectSqlStatementData		= mysql_fetch_array($projectSqlStatement)){
				$PROJECTNAME       				= $projectSqlStatementData["PROJECTNAME"];
				
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
			
			//Ministry/Division and Project/Programme Name View Report End
			
	$tableView = "";	
	$tableView .="<table width='80%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:85%; border: 1px dotted #000'>

					  <tr>
                            <td style='text-align:right;' colspan='18'>
                            <a href='javascript:Clickheretoprint()'><img border='0' src='images/print_icon.jpg' width='40' height='26' /></a>                        
                            </td>
                     </tr>
					  <tr>
						<td colspan='16' align='center' valign='middle' style='border: 1px dotted #000'>
							<center><b><font size=5>F N A Group Of Company</font></b></center>
							<center>&nbsp;</center>
							<center><b><font size=3>$SUBPROJECTNAME Summary DO  Report</FONT></b></center>
							<center>&nbsp;</center>
							<center><b><font size=2>Date : $ENTRYDATE </font></b></center>
						</td>
					  </tr> 
					  

					  <tr style='font-weight:bold;'>

						<td align='center' valign='top' style='font-weight:bold;border: 1px dotted #000'>D.O No.</td>

						<td align='center' valign='top'  style='border: 1px dotted #000'>Party Name</td>
						
						<td align='center' valign='top'  style='border: 1px dotted #000'>Rec. Name</td>
						
						<td align='center' valign='top'  style='border: 1px dotted #000'>Lot No.</td>

						<td align='center' valign='top' style='border: 1px dotted #000'>Load </td>
						
						<td align='center' valign='top' style='border: 1px dotted #000'>Rate </td>

						<td align='right' valign='top' style='border: 1px dotted #000'>Unload</td>
						
						<td align='right' valign='top' style='border: 1px dotted #000'>Bill Received</td>
						
						<td align='right' valign='top' style='border: 1px dotted #000'>Labour Charge</td>
						
						<td align='right' valign='top' style='border: 1px dotted #000'>Basta Loan </td>
						
						<td align='center' valign='top' style='border: 1px dotted #000'>Received</td>

						<td align='right' valign='top' style='border: 1px dotted #000'>Car Loan</td>

						<td align='right' valign='top' style='border: 1px dotted #000'>Received</td>
						
						<td align='right' valign='top' style='border: 1px dotted #000'>Normal Loan </td>
						
						<td align='right' valign='top' style='border: 1px dotted #000'>Received</td>
						
						<td align='center' valign='top' style='border: 1px dotted #000'>Total Received</td>

											
					</tr>";

// Query here.


							
							// Package Information View Report Start 	 <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<	
							
							$GLOBAL_PARTY_BALANCE_AMOUNT = 0;
							$Pur_Bill_Balance 				= 0;
							$Sell_Bill_Balance				= 0;
							$GLOBAL_PARTY_PUR_BALANCE_AMOUNT	= 0;
							$GLOBAL_PARTY_SELL_BALANCE_AMOUNT	= 0;
							
								
								/*$PartyStatementQuery 	= "SELECT p.PARTYID
																FROM fna_party p 
																WHERE p.PROJECTID = '".$PROJECTID."'
																AND p.SUBPROJECTID = '".$SUBPROJECTID."'
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
								
								foreach($PARTYID_ARRAY_UNIQUE as $individualParty){
								
								*/
								$aQuery 	= "SELECT 
														plu.PARTYID,
														plu.DONO,
														plu.REC_NAME,
														plu.REC_MOB,
														plu.ENTRYSERIALNOID,
														bkdn.PRODUCTID,
														bkdn.PACKINGUNITID,
														alus.LOADQUANTITY,
														alus.UNLOADQUANTITY,
														alus.LOTNO
														
													FROM fna_productloadunload plu, fna_productloadunloadbkdn bkdn, fna_alustock alus
													WHERE plu.PRODUCTLOADUNLOADID = bkdn.PRODUCTLOADUNLOADID
													AND bkdn.PRODUCTLOADUNLOADBKDNID = alus.PRODUCTLOADUNLOADBKDNID
													AND plu.PROJECTID = '".$PROJECTID."'
													AND plu.SUBPROJECTID = '".$SUBPROJECTID."'
													AND plu.ENTRYDATE = '".$ENTRYDATE."'
													ORDER BY plu.DONO ASC
											";
								$aQueryStatement			= mysql_query($aQuery);
								
								$BASTA_SELLPRICE	=0;
								$BASTA_RECEIVEDAMOUNT	=0;
															
								$PRODUCTID = 0;
								$PACKINGUNITID = 0;
								$QUANTITY = 0;
								$QUANTITY_LOAD = 0;
								$QUANTITY_UNLOAD = 0;
								$Global_Total_Load	=	0;
								$Global_Labour_Charge = 0;
								$Global_Total_UnLoad	=0;
								$Global_Total_LoadBill	=0;
								$Global_Total_Bill_Rec	=0;
								$Global_Total_Basta_Rec	=0;
								$Global_Total_Car_Rec	=0;
								$Global_Total_Normal_Rec	=0;
								$Grand_Total_Receive = 0;
								//$Total_Bill_Received	= 0;
								$Global_Tot_Bill_Received	=	0;
								$sl = 1;
								while($aQueryStatementData	= mysql_fetch_array($aQueryStatement)){
									$PARTYID				= $aQueryStatementData['PARTYID'];
									$PRODUCTID				= $aQueryStatementData['PRODUCTID'];
									$PACKINGUNITID			= $aQueryStatementData['PACKINGUNITID'];
									$LOADQUANTITY			= $aQueryStatementData['LOADQUANTITY'];
									$UNLOADQUANTITY			= $aQueryStatementData['UNLOADQUANTITY'];
									$ENTRYSERIALNOID		= $aQueryStatementData['ENTRYSERIALNOID'];
									$LOTNO					= $aQueryStatementData['LOTNO'];
									$DONO					= $aQueryStatementData['DONO'];
									$REC_NAME				= $aQueryStatementData['REC_NAME'];
									$REC_MOB				= $aQueryStatementData['REC_MOB'];
									
									$Labour_Charge			= $UNLOADQUANTITY * 5;
								
								$Lot_LoadQnty 		= "SELECT 		LOADQUANTITY
																FROM fna_alustock
																WHERE PROJECTID = '".$PROJECTID."'
																AND SUBPROJECTID = '".$SUBPROJECTID."'
																AND LOTNO = '".$LOTNO."'
																AND WORKTYPEFLAG = 'Load'
																
															";
									$Lot_LoadQntyStatement					= mysql_query($Lot_LoadQnty);
									while($Lot_LoadQntyStatementData		= mysql_fetch_array($Lot_LoadQntyStatement)){	
										$LOADQUANTITY_LOT					= $Lot_LoadQntyStatementData['LOADQUANTITY'];
									}
									
									$NowLotNo					=  $LOTNO .'/'. $LOADQUANTITY_LOT ; 
								
								
								
								$ProdFareQuery 			= "SELECT UNITFARE
																	FROM fna_productfare
																	WHERE PRODUCTID = '".$PRODUCTID."' 
																	AND PACKINGUNITID = '".$PACKINGUNITID."'
																	AND PROJECTID = '".$PROJECTID."'
																	AND SUBPROJECTID = '".$SUBPROJECTID."'
																	
																";
								$ProdFareQueryStatement					= mysql_query($ProdFareQuery);
								$TotalTakaFare = 0;
								$TotalPaymentFare = 0;
								$UNITFARE = 0;
								while($ProdFareQueryStatementData		= mysql_fetch_array($ProdFareQueryStatement)){	
									$UNITFARE							= $ProdFareQueryStatementData['UNITFARE'];
									
								}
								
								
								$PartyNameQuery 			= "SELECT PARTYNAME
																	FROM fna_party
																	WHERE PROJECTID = '".$PROJECTID."'
																	AND SUBPROJECTID = '".$SUBPROJECTID."'
																	AND PARTYID = '".$PARTYID."'
																	
																";
								$PartyNameQueryStatement				= mysql_query($PartyNameQuery);
								while($PartyNameQueryStatementData		= mysql_fetch_array($PartyNameQueryStatement)){	
									$PARTYNAME							= $PartyNameQueryStatementData['PARTYNAME'];
									
								}
								
								//$Load_Bill			= $LOADQUANTITY * $UNITFARE ;
								$TotalTakaFare		= $UNITFARE * $LOADQUANTITY ;
								$TotalPaymentFare	= $UNITFARE * $UNLOADQUANTITY ;
								
								$Fna_Loan_Query				= "SELECT 
																	l.LOANID,
																	l.LOANTYPEID,
																	l.LOANAMOUNT,
																	l.INTERESTAMOUNT,
																	l.LOANPAYMENT,
																	l.LOANDATE,
																	l.LOTNO,
																	l.RESTOFTHE_AMOUNT,
																	l.LOAN_BALANCE,
																	lt.LOANTYPENAME
																FROM fna_loan l, fna_loantype lt
																WHERE lt.LOANTYPEID = l.LOANTYPEID 
																AND l.PARTYID = '".$PARTYID."'
																AND l.PROJECTID = '".$PROJECTID."'
																AND l.SUBPROJECTID = '".$SUBPROJECTID."'
																AND l.LOAN_PAYMENTDATE = '".$ENTRYDATE."'
																AND l.LOTNO = '".$LOTNO."'
																AND l.ENTRYSERIALNOID = '".$ENTRYSERIALNOID."'
																
																
															";
								$Fna_Loan_QueryStatement					= mysql_query($Fna_Loan_Query);
								$LOANTYPEID = 0;
								$LOANAMOUNT = 0;
								$INTERESTAMOUNT	 = 0;
								$LOANPAYMENT = 0;
								$BALANCE_LOAN = 0;
								$LOANTYPENAME = '';
								//$TotalPaymentFare = 0;
								while($Fna_Loan_QueryStatementData			= mysql_fetch_array($Fna_Loan_QueryStatement)){	
									$LOANTYPEID								= $Fna_Loan_QueryStatementData['LOANTYPEID'];
									$LOANAMOUNT								= $Fna_Loan_QueryStatementData['LOANAMOUNT'];
									$INTERESTAMOUNT							= $Fna_Loan_QueryStatementData['INTERESTAMOUNT'];
									$LOANPAYMENT							= $Fna_Loan_QueryStatementData['LOANPAYMENT'];
									$LOANDATE								= $Fna_Loan_QueryStatementData['LOANDATE'];
									$LOTNO									= $Fna_Loan_QueryStatementData['LOTNO'];
									$RESTOFTHE_AMOUNT						= $Fna_Loan_QueryStatementData['RESTOFTHE_AMOUNT'];
									$BALANCE_LOAN							= $Fna_Loan_QueryStatementData['LOAN_BALANCE'];
									$LOANTYPENAME							= $Fna_Loan_QueryStatementData['LOANTYPENAME'];
									
								}
								$TOTAL_LOANPAYMENT							= $LOANPAYMENT + $INTERESTAMOUNT;
								//---------------------------------------New Query Start for Total Load/Unload Find--------------
								$Load_Query 	= "SELECT   SUM(als.LOADQUANTITY) LOADQUANTITY,
															SUM(als.UNLOADQUANTITY) UNLOADQUANTITY
																FROM fna_alustock als, fna_product p, fna_productloadunload pl, fna_productloadunloadbkdn bkdn
														WHERE p.PRODUCTID = als.PRODUCTID
														AND als.PRODUCTLOADUNLOADBKDNID = bkdn.PRODUCTLOADUNLOADBKDNID
														AND bkdn.PRODUCTLOADUNLOADID = pl.PRODUCTLOADUNLOADID
														AND als.PROJECTID = '".$PROJECTID."'
														AND als.SUBPROJECTID = '".$SUBPROJECTID."'
														AND pl.ENTRYDATE BETWEEN '2022-01-01' AND '".$ENTRYDATE."' 
													";
								$Load_QueryStatement			= mysql_query($Load_Query);
								while($Load_QueryStatementData	= mysql_fetch_array($Load_QueryStatement)){	
									$QUANTITY_Load_New			= $Load_QueryStatementData['LOADQUANTITY'];
									$QUANTITY_UnLoad_New		= $Load_QueryStatementData['UNLOADQUANTITY'];
									
								}	
								$Balance_Basta_New				= $QUANTITY_Load_New - $QUANTITY_UnLoad_New ;
								
								//---------------------------------------New Query End for Total Load/Unload Find----------------
								
								$LOANAMOUNT_CAR = 0;
								$INTERESTAMOUNT_CAR	=0;
								$LOANPAYMENT_CAR = 0;
								$RESTOFTHE_AMOUNT_CAR = 0;
								$LOANAMOUNT_BASTA = 0;
								$LOANPAYMENT_BASTA	= 0;
								$LOANAMOUNT_NORMAL = 0;
								$INTERESTAMOUNT_NORMAL = 0;
								$LOANPAYMENT_NORMAL	 = 0;
								$LOANAMOUNT_NORMAL_TOT	=0;
								$LOANPAYMENT_CAR_TOT	=0;
								
								
														
								if($LOANTYPEID == '1'){
									$LOANAMOUNT_CAR			= $RESTOFTHE_AMOUNT ; 
									$INTERESTAMOUNT_CAR		= $INTERESTAMOUNT ; 
									$LOANPAYMENT_CAR		= $TOTAL_LOANPAYMENT ;
									$LOANPAYMENT_CAR_TOT	= $INTERESTAMOUNT_CAR + $RESTOFTHE_AMOUNT ; 
									
								}elseif($LOANTYPEID == '2'){
									$LOANAMOUNT_BASTA			= $RESTOFTHE_AMOUNT ; 
									$LOANPAYMENT_BASTA			= $TOTAL_LOANPAYMENT ;
									//$LOANAMOUNT_BASTA_TOT		= $LOANPAYMENT_BASTA + $LOANPAYMENT_BASTA ; 
									
								}elseif($LOANTYPEID == '3'){
									$LOANAMOUNT_NORMAL			= $RESTOFTHE_AMOUNT ; 
									$INTERESTAMOUNT_NORMAL		= $INTERESTAMOUNT ; 
									$LOANPAYMENT_NORMAL			= $TOTAL_LOANPAYMENT ;
									$LOANAMOUNT_NORMAL_TOT		= $INTERESTAMOUNT_NORMAL + $LOANPAYMENT_NORMAL ; 
								}
								$BastaQuery	 			= "SELECT 	SELLPRICE,
																	RECEIVEDAMOUNT															
																FROM fna_basta
																WHERE PARTYID = '".$PARTYID."'
																AND ENTRYDATE = '".$ENTRYDATE."' 
																
															";
								$BastaQueryStatement					= mysql_query($BastaQuery);
								while($BastaQueryStatementData			= mysql_fetch_array($BastaQueryStatement)){	
									$BASTA_SELLPRICE					= $BastaQueryStatementData['SELLPRICE'];
									$BASTA_RECEIVEDAMOUNT				= $BastaQueryStatementData['RECEIVEDAMOUNT'];
									//$BALANCE							= $BookingQueryStatementData['BALANCE'];
									
								}
								
								$Total_Bill_Received			= $BASTA_RECEIVEDAMOUNT + $LOANPAYMENT_NORMAL + $LOANPAYMENT_CAR + $TotalPaymentFare + $Labour_Charge; 
								$Global_Labour_Charge			= $Global_Labour_Charge + $Labour_Charge ;
								$Global_Total_Load				= $Global_Total_Load + $LOADQUANTITY ;
								$Global_Total_UnLoad			= $Global_Total_UnLoad + $UNLOADQUANTITY ;
								$Global_Total_LoadBill			= $Global_Total_LoadBill + $TotalTakaFare ;
								$Global_Total_Bill_Rec			= $Global_Total_Bill_Rec + $TotalPaymentFare ;
								$Global_Total_Basta_Rec			= $Global_Total_Basta_Rec + $LOANPAYMENT_BASTA ;
								$Global_Total_Car_Rec			= $Global_Total_Car_Rec + $TOTAL_LOANPAYMENT ;
								$Global_Total_Normal_Rec		= $Global_Total_Normal_Rec + $LOANAMOUNT_NORMAL_TOT ;
								$Grand_Total_Receive			= $Global_Total_Bill_Rec + $Global_Total_Basta_Rec + $Global_Total_Car_Rec + $Global_Total_Normal_Rec ;
								$Global_Tot_Bill_Received		= $Global_Tot_Bill_Received + $Total_Bill_Received ; 
								
								 
						$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000'>$DONO</td>

											<td align='center' valign='top' style='border: 1px dotted #000'> $PARTYNAME</td>
											
											<td align='center' valign='top' style='border: 1px dotted #000'> $REC_NAME</td>
											
											<td align='center' valign='top' style='border: 1px dotted #000'> $NowLotNo</td>
					
											<td align='right' valign='top'  style='border: 1px dotted #000'>$LOADQUANTITY_LOT</td>
											
											<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($UNITFARE,2)."</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>$UNLOADQUANTITY</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($TotalPaymentFare,2)."</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>$Labour_Charge</td>
																
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($BASTA_SELLPRICE,2)."</td>
											
											<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($BASTA_RECEIVEDAMOUNT,2)."</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($LOANAMOUNT_CAR,2)." </td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($TOTAL_LOANPAYMENT,2)."</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($LOANAMOUNT_NORMAL,2)."</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($LOANAMOUNT_NORMAL_TOT,2)."</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Total_Bill_Received,2)." </td>
					
																						
										</tr>

									 ";
						//}
								// Dynamic Row End		  
					$sl++;
				}	
				
				

					$tableView .="

						<tr style='font-weight:bold;'>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top'  style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='left' valign='top'  style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='left' valign='top'  style='border: 1px dotted #000'>&nbsp;</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>$Global_Total_Load</td>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>$Global_Total_UnLoad</td>
							
							<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($Global_Total_Bill_Rec,2)."</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>$Global_Labour_Charge</td>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_Total_Basta_Rec,2)."</td>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_Total_Car_Rec,2)."</td>
							
							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_Total_Normal_Rec,2)."</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_Tot_Bill_Received,2)."</td>
							
						</tr>
						<tr>

							<td colspan='16' align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

						</tr>
						
						<tr>
							<td colspan='18' align='center' valign='top' >
								<table width='50%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:100%;'>
								  <tr style='background-color:lightgrey'>
									<td align='right' width='50%' style='border: 1px dotted #000'><b>Total Load</b></td>
									<td width='2%' style='border: 1px dotted #000'>:</td>
									<td width='48%' style='border: 1px dotted #000'><b>".number_format($QUANTITY_Load_New,2)."</b></td>
								  </tr>
								  <tr>
									<td align='right' width='50%' style='border: 1px dotted #000'>Total Unload</td>
									<td width='2%' style='border: 1px dotted #000'>:</td>
									<td width='48%' style='border: 1px dotted #000'>".number_format($QUANTITY_UnLoad_New,2)."</td>
								  </tr>
								  <tr style='background-color:lightgrey'>
									<td align='right' width='50%' style='border: 1px dotted #000'><b>Today's Unload</b></td>
									<td width='2%' style='border: 1px dotted #000'>:</td>
									<td width='48%' style='border: 1px dotted #000'><b>".number_format($Global_Total_UnLoad,2)."</b></td>
								  </tr>
								  <tr>
									<td align='right' width='50%' style='border: 1px dotted #000'>Balance </td>
									<td width='2%' style='border: 1px dotted #000'>:</td>
									<td width='48%' style='border: 1px dotted #000'>".number_format($Balance_Basta_New,2)."</td>
								  </tr>
								  
								</table>
							</td>

						</tr>
						<tr>

							<td colspan='16' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='16' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='16' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='16' align='left' valign='top' >
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

							<td colspan='16' align='left' valign='top' >&nbsp;</td>

						</tr>
						<tr>

							<td colspan='16' align='left' valign='top' >&nbsp;</td>

						</tr>					

					</table>";
	echo $tableView;

?>