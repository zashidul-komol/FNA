<?php
include('../config/dbinfo.inc.php');
	
function showDateMySQlFormat($date){
	
		$exp = explode("-",$date);				
		$mysqlDateF = $exp[2]."-".$exp[1]."-".$exp[0];
		
		return $mysqlDateF;
}
	$PROJECTID 		= $_REQUEST['PROJECTID'];
	$SUBPROJECTID 	= $_REQUEST['SUBPROJECTID'];
	$UNLOADBASTA	= $_REQUEST['UNLOADBASTA'];
	$LABOURID 		= $_REQUEST['LABOURID'];
	$CALDATE 		= showDateMySQlFormat($_REQUEST['ENTRYDATE']);
	$LOTNO	 		= $_REQUEST['LOTNO'];
	$DONO	 		= $_REQUEST['DONO'];
	$RECNAME 		= $_REQUEST['RECNAME'];
	$RECMOBNO 		= $_REQUEST['RECMOBNO'];
	$Labour_Extra_Charge	= $UNLOADBASTA * 5;
	
	$MaxSessionYear_Qry	= mysql_fetch_array(mysql_query("SELECT MAX(SESSIONYEARID) FROM fna_session WHERE PROJECTID = '".$PROJECTID."' AND SUBPROJECTID = '".$SUBPROJECTID."'"));
	$NowMaxSessionYearId = $MaxSessionYear_Qry['MAX(SESSIONYEARID)'];
	$Session_Qry	= "
						SELECT 	
								STARTDATE,
								ENDDATE
						FROM 	
								fna_session 
						WHERE	PROJECTID =".$PROJECTID." 
							AND SUBPROJECTID =".$SUBPROJECTID."
							AND SESSIONYEARID =".$NowMaxSessionYearId."
					 ";
	$Session_QryStatement				= mysql_query($Session_Qry);
	while($Session_QryStatementData	= mysql_fetch_array($Session_QryStatement)) {
		$SESSION_STARTDATE				= $Session_QryStatementData["STARTDATE"];
		$SESSION_ENDDATE 				= $Session_QryStatementData["ENDDATE"];
	}
	
	$LotNoQry			= mysql_fetch_array(mysql_query("SELECT MAX(LOTFLAG), PRODUCTID FROM fna_alustock WHERE PROJECTID = '".$PROJECTID."' AND SUBPROJECTID = '".$SUBPROJECTID."' AND LOTNO = '".$LOTNO."' AND ENTRYDATE BETWEEN '".$SESSION_STARTDATE."' AND '".$SESSION_ENDDATE."'"));
	$NowMaxLotFlag		= $LotNoQry['MAX(LOTFLAG)'];
	$PRODUCTID			= $LotNoQry['PRODUCTID'];
	
	$PartyIdQry			= mysql_fetch_array(mysql_query("SELECT PARTYID FROM fna_alustock WHERE PROJECTID = '".$PROJECTID."' AND SUBPROJECTID = '".$SUBPROJECTID."' AND LOTNO = '".$LOTNO."' AND ENTRYDATE BETWEEN '".$SESSION_STARTDATE."' AND '".$SESSION_ENDDATE."'"));
	$PARTYID			= $PartyIdQry['PARTYID'];
	
	
				
	$tableView = "";	
	$tableView .="<table width='100%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:85%; border: 1px dotted #000'>
					  <tr style='font-weight:bold;'>
						<td align='left' valign='top' style='font-weight:bold;border: 1px dotted #000'>LOT NO.</td>

						<td align='center' valign='top'  style='border: 1px dotted #000'>Date</td>

						<td align='right' valign='top' style='border: 1px dotted #000'>Load Quantity </td>

						<td align='right' valign='top' style='border: 1px dotted #000'>Unload Quantity</td>
						
						<td align='center' valign='top' style='border: 1px dotted #000'>Fare</td>
						
						<td align='right' valign='top' style='border: 1px dotted #000'>Fna Bill</td>
						
						<td align='center' valign='top' style='border: 1px dotted #000'>Basta Loan Amount</td>
						
						<td align='center' valign='top' style='border: 1px dotted #000'>Basta Loan Payment</td>
						
						<td align='center' valign='top' style='border: 1px dotted #000'>Car Loan</td>
						
						<td align='center' valign='top' style='border: 1px dotted #000'>Loan Payment</td>
						
						<td align='right' valign='top' style='border: 1px dotted #000'>Bill Received</td>
						
						<td align='right' valign='top' style='border: 1px dotted #000'>Total Taka</td>

						<td align='right' valign='top' style='border: 1px dotted #000'>Balance Quantity</td>

					</tr>";

// Query here.
						
						
						$aQuery 	= "SELECT	
												lc.LOTNO,
												lc.PROJECTID,
												lc.SUBPROJECTID,
												lc.PARTYID,
												lc.ENTRYDATE,
												alustck.PRODUCTID,
												alustck.LOTTOTQNTY,
												alustck.LOADQUANTITY,
												alustck.UNLOADQUANTITY,
												alustck.PARTYTOTQNTY,
												alustck.WORKTYPEFLAG,
												bkdn.PACKINGUNITID			
										FROM fna_productloadunload lc, fna_productloadunloadbkdn bkdn, fna_alustock alustck
										WHERE lc.PRODUCTLOADUNLOADID = bkdn.PRODUCTLOADUNLOADID
										AND bkdn.PRODUCTLOADUNLOADBKDNID = alustck.PRODUCTLOADUNLOADBKDNID
										AND lc.PARTYID = '".$PARTYID."' 
										AND lc.PROJECTID =  '".$PROJECTID."'
									    AND lc.SUBPROJECTID = '".$SUBPROJECTID."'
									    AND lc.LOTNO = '".$LOTNO."'
										AND alustck.PRODUCTID = '".$PRODUCTID."'
										AND lc.ENTRYDATE BETWEEN '".$SESSION_STARTDATE."' AND '".$SESSION_ENDDATE."'
										ORDER BY lc.PRODUCTLOADUNLOADID ASC
									";
						$aQueryStatement	= mysql_query($aQuery);
						$sl = 1;
						$glabalToatalBill = 0;
						$PAYMENTAMOUNT ='';
						$partyBalAmount ='';
						$INT_AMOUNT = '';
						$TOT_LOANAMOUNT = '';
						$LOANTYPEID		='';
						$INTERESTRATE	='';
						$LOANPURPOSE	='';
						$TOTAL_TAKA = 0;
						$Global_BillReceived = 0;
						$Global_FNA_Bill = 0;
						$LOTTOTQNTY = 0;
						$UNITFARE = 0;
						$FNA_UNLOAD_BILL = 0;
						$UNLOAD_BASTA_PAYMENT = 0;
						$UNLOAD_CARLOAN_PAYMENT = 0;
						$UNLOAD_BILL_RECEIVED_WITHOUT_BOOKING = 0;
						$UNLOAD_NOW_BILL_RECEIVED = 0;
						$PARTY_BOOKING_BALANCE = 0;
						$GLOBAL_LOAD_QNTY = 0;
						$GLOBAL_UNLOAD_QNTY = 0;
						$PACKINGUNITID = 0;
						
						while($aQueryStatementData	= mysql_fetch_array($aQueryStatement)){

 						// Dynamic Row Start
						$LOADQUANTITY_ALU 	= $aQueryStatementData['LOADQUANTITY'];
						$UNLOADQUANTITY_ALU = $aQueryStatementData['UNLOADQUANTITY'];
						$WORKTYPEFLAG 		= $aQueryStatementData['WORKTYPEFLAG'];
						$LOTTOTQNTY 		= $aQueryStatementData['LOTTOTQNTY'];
						$ENTRYDATE_ALU		= $aQueryStatementData['ENTRYDATE'];
						$PACKINGUNITID		= $aQueryStatementData['PACKINGUNITID'];
						
						
						
						$unitFare_qry		= "SELECT	
													UNITFARE			
												FROM fna_productfare 
												WHERE PROJECTID =  '".$PROJECTID."'
									    		AND SUBPROJECTID = '".$SUBPROJECTID."'
												AND PACKINGUNITID = '".$PACKINGUNITID."'
												AND PRODUCTID = '".$PRODUCTID."'
												AND '".$CALDATE."' BETWEEN STARTDATE AND ENDDATE
									    		ORDER BY UNITFARE ASC
											";
						$unitFare_qryStatement				= mysql_query($unitFare_qry);
						$UNITFARE = 0;
						while($unitFare_qryStatementData	= mysql_fetch_array($unitFare_qryStatement)){
								$UNITFARE		 			= $unitFare_qryStatementData['UNITFARE'];
						
						}
						
						
						$GLOBAL_LOAD_QNTY	= $GLOBAL_LOAD_QNTY + $LOADQUANTITY_ALU ; 
						$GLOBAL_UNLOAD_QNTY	= $GLOBAL_UNLOAD_QNTY + $UNLOADQUANTITY_ALU ; 
						$FNA_BILL_AMOUNT	= $LOADQUANTITY_ALU * $UNITFARE ; 
						$FNA_UNLOAD_BILL	= $UNITFARE * $UNLOADBASTA ; 
						$Global_FNA_Bill	= $Global_FNA_Bill + $FNA_BILL_AMOUNT ; 
						$bQuery 	= "SELECT	
											SUM(BILLAMOUNT) BILLAMOUNT,
											SUM(BILLRECEIVED) BILLRECEIVED			
										FROM fna_bill 
										WHERE PARTYID = '".$PARTYID."' 
										AND PROJECTID =  '".$PROJECTID."'
									    AND SUBPROJECTID = '".$SUBPROJECTID."'
									    AND LOTNO = '".$LOTNO."'
										AND ENTRYDATE BETWEEN '".$SESSION_STARTDATE."' AND '".$SESSION_ENDDATE."'
										ORDER BY LOTNO ASC
									";
						$bQueryStatement	= mysql_query($bQuery);
						$BILLAMOUNT = 0;
						while($bQueryStatementData	= mysql_fetch_array($bQueryStatement)){

 						//Dynamic Row Start
							$BILLAMOUNT 		= $bQueryStatementData['BILLAMOUNT'];
							$BILLRECEIVED 		= $bQueryStatementData['BILLRECEIVED'];
						
						}
						$Now_BillReceived		= $UNITFARE * $UNLOADQUANTITY_ALU;
						$Global_BillReceived	= $Global_BillReceived + $Now_BillReceived ;
						
						
						//------------------------------
						$LoanAmountQuery 	= "SELECT	
														SUM(LOANAMOUNT) LOANAMOUNT,
														SUM(LOANPAYMENT) LOANPAYMENT
											    FROM fna_loan 
													WHERE PARTYID = '".$PARTYID."' 
													AND PROJECTID =  '".$PROJECTID."'
													AND SUBPROJECTID = '".$SUBPROJECTID."'
													AND LOTNO = '".$LOTNO."'
													AND LOANDATE BETWEEN '".$SESSION_STARTDATE."' AND '".$SESSION_ENDDATE."'
													ORDER BY LOTNO ASC
												";
						$LoanAmountQueryStatement				= mysql_query($LoanAmountQuery);
						$LOANAMOUNT = 0;
						$LOANPAYMENT = 0;
						
						while($LoanAmountQueryStatementData		= mysql_fetch_array($LoanAmountQueryStatement)){

 						//Dynamic Row Start
							$LOANAMOUNT 						= $LoanAmountQueryStatementData['LOANAMOUNT'];
							$LOANPAYMENT 						= $LoanAmountQueryStatementData['LOANPAYMENT'];
													
						}
						//------------------------------
						
						$DQuery 	= "SELECT	
											SUM(SELLPRICE) SELLPRICE,
											SUM(RECEIVEDAMOUNT) RECEIVEDAMOUNT 			
										FROM fna_basta 
										WHERE PARTYID = '".$PARTYID."' 
										AND LOTNO = '".$LOTNO."'
										AND ENTRYDATE BETWEEN '".$SESSION_STARTDATE."' AND '".$SESSION_ENDDATE."' 
										ORDER BY LOTNO ASC
									";
						$DQueryStatement	= mysql_query($DQuery);
						$BASTA_SELLPRICE 		= 0;
						$BASTA_RECEIVEDAMOUNT 	= 0;
						while($DQueryStatementData	= mysql_fetch_array($DQueryStatement)){
							$BASTA_SELLPRICE 		= $DQueryStatementData['SELLPRICE'];
							$BASTA_RECEIVEDAMOUNT	= $DQueryStatementData['RECEIVEDAMOUNT'];
						
						}
						$BASTA_BALANCE_AMOUNT		= $BASTA_SELLPRICE - $BASTA_RECEIVEDAMOUNT ; 
						$UNLOAD_BASTA_PAYMENT		= round(($BASTA_BALANCE_AMOUNT / $LOTTOTQNTY ) * $UNLOADBASTA) ;
						
						$MAXPARTYFLAG 		= mysql_fetch_array(mysql_query("SELECT MAX(PARTYFLAG) FROM fna_loan WHERE PARTYID = '".$PARTYID."' AND LOTNO = '".$LOTNO."'"));
						$MAXPARTY_FLAG	 	= $MAXPARTYFLAG['MAX(PARTYFLAG)'];
						$NOW_MAXPARTY_FLAG 	= $MAXPARTY_FLAG + 1;
						$CQuery 	= "SELECT	
											RESTOFTHE_AMOUNT,
											INTERESTAMOUNT,
											LOANDATE,
											INTERESTRATE,
											LOANID		
										FROM fna_loan 
										WHERE PARTYID = '".$PARTYID."' 
										AND PROJECTID =  '".$PROJECTID."'
									    AND SUBPROJECTID = '".$SUBPROJECTID."'
									    AND LOTNO = '".$LOTNO."'
										AND PARTYFLAG = '".$MAXPARTY_FLAG."'
										ORDER BY LOTNO ASC
									";
						$CQueryStatement	= mysql_query($CQuery);
						$RESTOFTHE_AMOUNT = 0;
						$INTERESTAMOUNT = 0;
						$LOANID = 0;
						while($CQueryStatementData	= mysql_fetch_array($CQueryStatement)){

 						//Dynamic Row Start
							//$LOANAMOUNT 		= $CQueryStatementData['LOANAMOUNT'];
							$RESTOFTHE_AMOUNT	= $CQueryStatementData['RESTOFTHE_AMOUNT']; echo '</br>';
							//$LOANPAYMENT 		= $CQueryStatementData['LOANPAYMENT'];
							$INTERESTAMOUNT		= $CQueryStatementData['INTERESTAMOUNT'];
							$LOANDATE			= $CQueryStatementData['LOANDATE'];
							$INTERESTRATE		= $CQueryStatementData['INTERESTRATE'];
							$LOANID				= $CQueryStatementData['LOANID'];
							
						
						}
						
						$daylen = 60*60*24;

					  	$date2 = $ENTRYDATE_ALU;
					  	$date1 = $CALDATE;
						
						$days = (strtotime($date1)-strtotime($date2))/$daylen; 
						$INT_AMOUNT = round(((($RESTOFTHE_AMOUNT * $INTERESTRATE)/100)/365) * $days) ;
						$TOT_LOANAMOUNT = round($RESTOFTHE_AMOUNT + $INT_AMOUNT) ; 
						//echo $RESTOFTHE_AMOUNT; 
						
						
						
						$UNLOAD_CARLOAN_PAYMENT	= round(($TOT_LOANAMOUNT / $LOTTOTQNTY) * $UNLOADBASTA); 
					
						$TOTAL_TAKA			= ($BILLAMOUNT + $LOANAMOUNT + $BASTA_SELLPRICE ) -  ($LOANPAYMENT - $BILLRECEIVED ); 
						
						$UNLOAD_UNITFARE			=0;
						$UNLOAD_BILLAMOUNT			=0;
						$UNLOAD_BASTA_SELLPRICE		=0;
						$UNLOAD_LOANAMOUNT			=0;
						$UNLOAD_LOANPAYMENT			=0;
						$UNLOAD_BILLRECEIVED		=0;
						
						
						if($WORKTYPEFLAG == 'Unload'){
							//$UNITFARE	=0;
							//$BILLAMOUNT	=0;
							$BASTA_RECEIVEDAMOUNT = 0;
							$BASTA_SELLPRICE	=0;
							$LOANAMOUNT	=0;
							$LOANPAYMENT	=0;
							$TOTAL_TAKA = 0;
							$BILLAMOUNT = 0;
							//$BILLRECEIVED  = $BILLRECEIVED;
							}else{
								$BASTA_RECEIVEDAMOUNT = $BASTA_RECEIVEDAMOUNT ;
								//$BILLRECEIVED  = 0;
								$TOTAL_TAKA = $TOTAL_TAKA;
							
							}
							
							$PARTY_FLAG_QRY					= mysql_fetch_array(mysql_query("SELECT MAX(PARTYFLAG) FROM fna_alubooking WHERE PARTYID = '".$PARTYID."'"));
							$MAXPARTY_FLAG	 				= $PARTY_FLAG_QRY['MAX(PARTYFLAG)'];
							
							$BOOKING_QRY					= mysql_fetch_array(mysql_query("SELECT BALANCE FROM fna_alubooking WHERE PARTYID = '".$PARTYID."' AND PARTYFLAG = '".$MAXPARTY_FLAG."'"));
							$PARTY_BOOKING_BALANCE	 		= $BOOKING_QRY['BALANCE'];
						//$BALANCE_QUANTITY  = 
						
						$UNLOAD_NOW_BILL_RECEIVED					= ($FNA_UNLOAD_BILL + $UNLOAD_BASTA_PAYMENT + $UNLOAD_CARLOAN_PAYMENT) - $PARTY_BOOKING_BALANCE; 
						$UNLOAD_BILL_RECEIVED_WITHOUT_BOOKING		= $FNA_UNLOAD_BILL + $UNLOAD_BASTA_PAYMENT + $UNLOAD_CARLOAN_PAYMENT; 
						
						$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000'>$LOTNO</td>

											<td align='right' valign='top' style='border: 1px dotted #000'> $ENTRYDATE_ALU</td>
					
											<td align='right' valign='top'  style='border: 1px dotted #000'>$LOADQUANTITY_ALU</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>$UNLOADQUANTITY_ALU</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($UNITFARE,2)."</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($BILLAMOUNT,2)."</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'> ".number_format($BASTA_SELLPRICE,2)."</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'> ".number_format($BASTA_RECEIVEDAMOUNT,2)."</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'> ".number_format($LOANAMOUNT,2)."</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'> ".number_format($LOANPAYMENT,2)."</td>
					
											<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($Now_BillReceived,2)."</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($TOTAL_TAKA,2)."</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>$LOTTOTQNTY </td>
					
										</tr>

									 ";

								// Dynamic Row End		  

				$sl++;
				}
							

					$tableView .="

						<tr bgcolor='#CCCCCC'>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top'  style='border: 1px dotted #000'>&nbsp;</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>$GLOBAL_LOAD_QNTY</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>$GLOBAL_UNLOAD_QNTY</td>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top' style='border: 1px dotted #000'>".number_format($Global_FNA_Bill,2)."</td>
							
							<td align='left' valign='top'  style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_BillReceived,2)."</td>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>$LOTTOTQNTY </td>

						</tr>
						<tr>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top'  style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='left' valign='top'  style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp; </td>

						</tr>
						<tr bgcolor='#F63' style='font-weight:bold;'>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top'  style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>$UNLOADBASTA</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($UNITFARE,2)."</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($FNA_UNLOAD_BILL,2)."</td>
							
							<td align='right' valign='top'  style='border: 1px dotted #000'>&nbsp;</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($UNLOAD_BASTA_PAYMENT,2)."</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($UNLOAD_CARLOAN_PAYMENT,2)."</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($UNLOAD_BILL_RECEIVED_WITHOUT_BOOKING,2)."</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

						</tr>
						<tr>

							<td colspan='13' align='left' valign='top' style='border: 1px dotted #000'>
									<table width='100%' border='0' cellpadding='3' cellspacing='0'>	
										<tr valign='top'>
										  <td align='right'>Basta Quantity:</td>
										  <td height='26' align='left'><input type='text' readonly='readonly' name='BASTAQNTY' id='BASTAQNTY' value=$UNLOADBASTA style='width:167px;' /></td>
										  <td height='26' align='right'>Bill Amount:</td>
										  <td height='26' align='left'><input type='text' name='BILLAMOUNT' id='BILLAMOUNT' style='width:167px;' VALUE=$UNLOAD_NOW_BILL_RECEIVED /></td>
										</tr>
										<tr valign='top'>
										  <td align='right'>Basta Loan Amount:</td>
										  <td height='26' align='left'><input type='text' name='BASTALOANAMOUNT' id='BASTALOANAMOUNT' value=$UNLOAD_BASTA_PAYMENT style='width:167px;' /></td>
										  <td height='26' align='right'>Labour Charge:</td>
										  <td height='26' align='left'><input type='text' readonly='readonly' name='SERVICECHARGE' id='SERVICECHARGE'  value=$Labour_Extra_Charge style='width:167px;' /></td>
										</tr>
										<tr valign='top'>
										  <td align='right'>Others:</td>
										  <td height='26' align='left'><input type='text' name='OTHERSINCOME' id='OTHERSINCOME' style='width:167px;' /></td>
										  <td height='26' align='right'>Booking Money:</td>
										  <td height='26' align='left'><input type='text' readonly='readonly' name='BOOKINGMONEY' id='BOOKINGMONEY' value='{$PARTY_BOOKING_BALANCE}' style='width:167px;' /></td>
										</tr>
										<tr valign='top'>
										  <td align='right'>Car Loan Deduction:</td>
										  <td height='26' align='left'><input type='text' name='CARLOANDEDUCTION' id='CARLOANDEDUCTION' style='width:167px;' /></td>
										  
										</tr>
										<tr valign='top'>
										  <td height='26' align='left'><input type='hidden' readonly='readonly' name='UNLOAD_BILL_RECEIVED_WITHOUT_BOOKING' id='UNLOAD_BILL_RECEIVED_WITHOUT_BOOKING' value='{$UNLOAD_BILL_RECEIVED_WITHOUT_BOOKING}' style='width:167px;' /></td>
										</tr>
										<tr valign='top'>
										  <td align='right'>&nbsp;</td>
										  <td height='26' align='left'>
										  <input type='hidden' name='PROJECTID' id='PROJECTID' value='{$PROJECTID}'/>
										  <input type='hidden' name='SUBPROJECTID' id='SUBPROJECTID' value='{$SUBPROJECTID}'/>
										  <input type='hidden' name='PARTYID' id='PARTYID' value='{$PARTYID}'/>
										  <input type='hidden' name='LABOURID' id='LABOURID' value='{$LABOURID}'/>
										  <input type='hidden' name='UNITFARE' id='UNITFARE' value='{$UNITFARE}'/>
										  <input type='hidden' name='ENTRYDATE' id='ENTRYDATE' value='{$CALDATE}'/>
										  <input type='hidden' name='LOTNO' id='LOTNO' value='{$LOTNO}'/>
										  <input type='hidden' name='DONO' id='DONO' value='{$DONO}'/>
										  <input type='hidden' name='RECNAME' id='RECNAME' value='{$RECNAME}'/>
										  <input type='hidden' name='RECMOBNO' id='RECMOBNO' value='{$RECMOBNO}'/>
										  <input type='hidden' name='LOANID' id='LOANID' value='{$LOANID}'/>
										  <input type='hidden' name='TOTBILLRECEIVED' id='TOTBILLRECEIVED' value='{$UNLOAD_BILL_RECEIVED_WITHOUT_BOOKING}'/>
										  <input type='hidden' name='CARLOANPAYMENT' id='CARLOANPAYMENT' value='{$UNLOAD_CARLOAN_PAYMENT}'/>
										  <input type='hidden' name='UNLOADBILL' id='UNLOADBILL' value='{$FNA_UNLOAD_BILL}'/>
										  <input type='hidden' name='UNLOAD_BASTA_PAYMENT' id='UNLOAD_BASTA_PAYMENT' value='{$UNLOAD_BASTA_PAYMENT}'/>
										  <input align='center' type='submit' name='InsertAluUnloadInfo' value='Insert' class='FormSubmitBtn' />
										  <input align='right' name='btnClose' type='button' value='Close' onClick='return ShowHide('showLoad')'>
										  </td>
										  <td height='26' align='right'>&nbsp;</td>
										  <td height='26' align='left'>&nbsp;</td>
										</tr>	
								 </table>
							</td>

						</tr>
					</table>";
	echo $tableView;

?>