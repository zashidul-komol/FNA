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
	$PARTYID 			= $_REQUEST['PARTYID'];
	
	$ENTRYDATE_FROM 	= showDateMySQlFormat($_REQUEST['ENTRYDATE']);
	$ENTRYDATE_TO 		= showDateMySQlFormat($_REQUEST['ENTRYDATE2']);
	$userId 			= $_REQUEST['userId'];
	$con = '';
		//Ministry/Division and Project/Programme Name View Report Start				
	 	$partySql 	= "
							SELECT p.PARTYNAME, p.FATHERNAME, p.ADDRESS, p.MOBILE											
							FROM fna_party p
							WHERE p.PARTYID = $PARTYID
						";
			$partySqlStatement				= mysql_query($partySql);
			while($partySqlStatementData	= mysql_fetch_array($partySqlStatement)){
				$PARTYNAME        		= $partySqlStatementData["PARTYNAME"];
				$FATHERNAME       		= $partySqlStatementData["FATHERNAME"];
				$ADDRESS       		= $partySqlStatementData["ADDRESS"];
				$MOBILE       			= $partySqlStatementData["MOBILE"];
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
	$tableView .="<table width='100%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:85%; border: 1px dotted #000'>

					  <tr>
                            <td style='text-align:right;' colspan='17'>
                            <a href='javascript:Clickheretoprint()'><img border='0' src='images/print_icon.jpg' width='40' height='26' /></a>                        
                            </td>
                     </tr>
					  <tr>
						<td colspan='18' align='center' valign='middle' style='border: 1px dotted #000'>
							<center><b><font size=5>F N A Group Of Company</font></b></center>
							<center>&nbsp;</center>
							<center><b><font size=2>Customer Ledger Report -- $SUBPROJECTNAME </FONT></b></center>
							<center><b><font size=2>Date : $ENTRYDATE_FROM to $ENTRYDATE_TO </font></b></center>
						</td>
					  </tr>
					  <tr>

						<td colspan='18' align='left' valign='top'>
							<table width='100%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:100%;'>
								  
								  <tr>
								
									<td colspan='7'  align='left' valign='top'><font size='+2'>Customer Ledger   :    </font><b></td>
									
								  </tr>
								  <tr>
								  	<td colspan='7' align='left' valign='top'><font size='+2'>-------------------------------------</font><b></td>
								  </tr>
								  <tr>
								
									<td width='14%' align='left' valign='top'>Party Name<b></td>
									<td width='1%' align='center' valign='top'>:</td>
									<td width='34%' align='left' valign='top'> $PARTYNAME</td>
									<td width='18%' align='right' valign='top'>&nbsp;</td>
									<td width='1%' align='center' valign='top'>&nbsp;</td>
									<td width='20%' align='left' valign='top'>&nbsp;</td>
									<td align='left' valign='top'>&nbsp;</td>
								
								  </tr>
								
								  <tr>
								
									<td align='left' valign='top'>Address</td>
									<td align='center' valign='top'>:</td>
								
									<td align='left' valign='top'> $ADDRESS </td>
									<td align='right' valign='top'>&nbsp;</td>
									<td align='center' valign='top'>&nbsp;</td>
									<td align='left' valign='top'>&nbsp;</td>
									<td align='left' valign='top'> &nbsp;</td>
								
								  </tr>
								
								  <tr>
								
									<td align='left' valign='top'>Party Father Name</td>
									<td align='center' valign='top'>:</td>
								
									<td align='left' valign='top'>$FATHERNAME </td>
									<td align='right' valign='top'>&nbsp;</td>
									<td align='center' valign='top'>&nbsp;</td>
									<td align='left' valign='top'>&nbsp;</td>
									<td align='left' valign='top'>&nbsp;</td>
								
								  </tr>
								
								  <tr>
								
									<td align='left' valign='top'>Mobile</td>
									<td align='center' valign='top'>:</td>
								
									<td align='left' valign='top'>$MOBILE </td>
									<td align='right' valign='top'>&nbsp;</td>
									<td align='center' valign='top'>&nbsp;</td>
									<td align='left' valign='top'>&nbsp;</td>
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

						<td align='center' valign='top' style='font-weight:bold;border: 1px dotted #000'>SL No.</td>

						<td align='center' valign='top'  style='border: 1px dotted #000'>Date</td>
						
						<td align='center' valign='top'  style='border: 1px dotted #000'>Product Name</td>
						
						<td align='center' valign='top'  style='border: 1px dotted #000'>Lot No.</td>

						<td align='center' valign='top' style='border: 1px dotted #000'>In.</td>

						<td align='center' valign='top' style='border: 1px dotted #000'>Out.</td>

						<td align='center' valign='top' style='border: 1px dotted #000'>Balance </td>

						<td align='center' valign='top' style='border: 1px dotted #000'>Unit Price</td>
						
						<td align='center' valign='top' style='border: 1px dotted #000'>Total Bill</td>
						
						<td align='center' valign='top' style='border: 1px dotted #000'>Payment</td>
						
						<td align='center' valign='top' style='border: 1px dotted #000'>Basta Loan</td>
						
						<td align='center' valign='top' style='border: 1px dotted #000'>Payment</td>
						
						<td align='center' valign='top' style='border: 1px dotted #000'>Car Loan</td>
						
						<td align='center' valign='top' style='border: 1px dotted #000'>Interest</td>
						
						<td align='center' valign='top' style='border: 1px dotted #000'>Payment</td>
						
						<td align='center' valign='top' style='border: 1px dotted #000'>Normal Loan</td>
						
						<td align='center' valign='top' style='border: 1px dotted #000'>Interest</td>
						
						<td align='center' valign='top' style='border: 1px dotted #000'>Payment</td>
						
						
					  </tr>";

// Query here.			
						$i = 0;
						
						
						$Global_TotalTaka = 0;
						$Global_BastaLoan = 0;
						$Global_CarLoan = 0;
						$Global_NormalLoan = 0;
						$Global_LotQuantity = 0;
						$Global_Quantity_Load = 0;
						$Global_Quantity_UnLoad = 0;
						$Global_PaymentFare 	= 0;
						
						$DateQuery 	= "SELECT  
													ENTRYDATE,
													PRODUCTLOADUNLOADID
												FROM fna_productloadunload
												WHERE PARTYID = '".$PARTYID."'
												AND ENTRYDATE between '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."' 
												AND STATUS != 'PC'
												ORDER BY ENTRYDATE ASC
											";
						$DateQueryStatement					= mysql_query($DateQuery);
						while($DateQueryStatementData		= mysql_fetch_array($DateQueryStatement)){	
							$ENTRYDATE_ARRAY[] 				= $DateQueryStatementData['ENTRYDATE'];
							$PRIMARYID_ARRAY[] 				= $DateQueryStatementData['PRODUCTLOADUNLOADID'];
							$i++;
						}
						$i = 0;
						$DateQuery 	= "SELECT  
													LOANDATE,
													LOANID
												FROM fna_loan
												WHERE PARTYID = '".$PARTYID."'
												AND LOANDATE between '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."' 
												ORDER BY ENTRYDATE ASC
											";
						$DateQueryStatement					= mysql_query($DateQuery);
						while($DateQueryStatementData		= mysql_fetch_array($DateQueryStatement)){	
							$ENTRYDATE_ARRAY[] 				= $DateQueryStatementData['LOANDATE'];
							$PRIMARYID_ARRAY[] 				= $DateQueryStatementData['LOANID'];
							$i++;
						}
						
						//$ENTRYDATE_ARRAY_UNIQUE 	= array_unique($ENTRYDATE_ARRAY);
						$k = 0;
						$sl = 1;
						$Global_Final_Balance = 0;
						
						
						foreach($ENTRYDATE_ARRAY as $individualDate){
						$PRIMARY_ID	= $PRIMARYID_ARRAY[$k] ;
						//$LOAN_ID	= $PRIMARYID_LOAN_ARRAY[$k] ;
						
						$aQuery 	= "SELECT 
												plu.LOTNO,
												bkdn.PRODUCTLOADUNLOADID,
												bkdn.PRODUCTID,
												bkdn.PACKINGUNITID,
												alus.LOADQUANTITY,
												alus.UNLOADQUANTITY,
												alus.LOTTOTQNTY,
												alus.PARTYTOTQNTY,
												alus.WORKTYPEFLAG
											FROM fna_productloadunload plu, fna_productloadunloadbkdn bkdn, fna_alustock alus
											WHERE plu.PRODUCTLOADUNLOADID = bkdn.PRODUCTLOADUNLOADID
											AND bkdn.PRODUCTLOADUNLOADBKDNID = alus.PRODUCTLOADUNLOADBKDNID
											AND plu.PRODUCTLOADUNLOADID = '".$PRIMARY_ID."'
											AND plu.PARTYID = '".$PARTYID."' 
											AND plu.PROJECTID = '".$PROJECTID."'
											AND plu.SUBPROJECTID = '".$SUBPROJECTID."'
											AND plu.ENTRYDATE = '".$individualDate."'
											ORDER BY $individualDate ASC
									";
						$aQueryStatement			= mysql_query($aQuery);
						
						$LotNo = 0;
						$PRODUCTID = 0;
						$PACKINGUNITID = 0;
						$LOADQUANTITY = 0;
						$UNLOADQUANTITY = 0;
						$LOTTOTQNTY	 = 0;
						$NowLotNo = 0;
						while($aQueryStatementData	= mysql_fetch_array($aQueryStatement)){
							$LotNo					= $aQueryStatementData['LOTNO'];
							$PRODUCTID				= $aQueryStatementData['PRODUCTID'];
							$PACKINGUNITID			= $aQueryStatementData['PACKINGUNITID'];
							$LOADQUANTITY			= $aQueryStatementData['LOADQUANTITY'];
							$UNLOADQUANTITY			= $aQueryStatementData['UNLOADQUANTITY'];
							$LOTTOTQNTY				= $aQueryStatementData['LOTTOTQNTY'];
							$WORKTYPEFLAG			= $aQueryStatementData['WORKTYPEFLAG'];
							$PARTYTOTQNTY			= $aQueryStatementData['PARTYTOTQNTY'];
							
						}
						
						$ProdFareQuery 			= "SELECT UNITFARE
															FROM fna_productfare
															WHERE PRODUCTID = '".$PRODUCTID."' 
															AND PACKINGUNITID = '".$PACKINGUNITID."'
															AND PROJECTID = '".$PROJECTID."'
															AND SUBPROJECTID = '".$SUBPROJECTID."'
															
														";
						$ProdFareQueryStatement					= mysql_query($ProdFareQuery);
						$TotalTakaFare = 0;
						$UNITFARE = 0;
						while($ProdFareQueryStatementData		= mysql_fetch_array($ProdFareQueryStatement)){	
							$UNITFARE							= $ProdFareQueryStatementData['UNITFARE'];
							
						}
						
						$ProdNameQuery 			= "SELECT PRODUCTNAME
															FROM fna_product
															WHERE PRODUCTID = '".$PRODUCTID."' 
															AND PROJECTID = '".$PROJECTID."'
															AND SUBPROJECTID = '".$SUBPROJECTID."'
															
														";
						$ProdNameQueryStatement					= mysql_query($ProdNameQuery);
						//$TotalTakaFare = 0;
						$PRODUCTNAME = '';
						while($ProdNameQueryStatementData		= mysql_fetch_array($ProdNameQueryStatement)){	
							$PRODUCTNAME						= $ProdNameQueryStatementData['PRODUCTNAME'];
							
						}
						
						
						
						$NowLotNo					=  $LotNo .'/'. $LOADQUANTITY ; 
						
						$Fna_Loan_Query				= "SELECT 
																l.LOANID,
																l.LOANTYPEID,
																l.LOANAMOUNT,
																l.INTERESTAMOUNT,
																l.LOANPAYMENT,
																l.LOAN_BALANCE,
																lt.LOANTYPENAME
															FROM fna_loan l, fna_loantype lt
															WHERE lt.LOANTYPEID = l.LOANTYPEID 
															AND l.LOANID = '".$PRIMARY_ID."'
															AND l.PARTYID = '".$PARTYID."'
															AND l.PROJECTID = '".$PROJECTID."'
															AND l.SUBPROJECTID = '".$SUBPROJECTID."'
															AND l.LOANDATE = '".$individualDate."'
															
															
														";
						$Fna_Loan_QueryStatement					= mysql_query($Fna_Loan_Query);
						$LOANTYPEID = 0;
						$LOANAMOUNT = 0;
						$INTERESTAMOUNT	 = 0;
						$LOANPAYMENT = 0;
						$BALANCE_LOAN = 0;
						$LOANTYPENAME = '';
						$TotalPaymentFare = 0;
						while($Fna_Loan_QueryStatementData			= mysql_fetch_array($Fna_Loan_QueryStatement)){	
							$LOANTYPEID								= $Fna_Loan_QueryStatementData['LOANTYPEID'];
							$LOANAMOUNT								= $Fna_Loan_QueryStatementData['LOANAMOUNT'];
							$INTERESTAMOUNT							= $Fna_Loan_QueryStatementData['INTERESTAMOUNT'];
							$LOANPAYMENT							= $Fna_Loan_QueryStatementData['LOANPAYMENT'];
							$BALANCE_LOAN							= $Fna_Loan_QueryStatementData['LOAN_BALANCE'];
							$LOANTYPENAME							= $Fna_Loan_QueryStatementData['LOANTYPENAME'];
							
						}
						
						$BastaQuery	 			= "SELECT 	SELLPRICE,
															RECEIVEDAMOUNT															
														FROM fna_basta
														WHERE PARTYID = '".$PARTYID."'
														AND ENTRYDATE = '".$individualDate."' 
														AND LOTNO = '".$LotNo."'
														
													";
						$BastaQueryStatement					= mysql_query($BastaQuery);
						$BASTA_SELLPRICE	=0;
						$BASTA_RECEIVEDAMOUNT	=0;
						while($BastaQueryStatementData			= mysql_fetch_array($BastaQueryStatement)){	
							$BASTA_SELLPRICE					= $BastaQueryStatementData['SELLPRICE'];
							$BASTA_RECEIVEDAMOUNT				= $BastaQueryStatementData['RECEIVEDAMOUNT'];
							//$BALANCE							= $BookingQueryStatementData['BALANCE'];
							
						}
						
						//$LOANTYPEID = 0;
						$LOANAMOUNT_CAR = 0;
						$INTERESTAMOUNT_CAR	=0;
						$LOANPAYMENT_CAR = 0;
						$LOANAMOUNT_BASTA = 0;
						$LOANPAYMENT_BASTA	= 0;
						$LOANAMOUNT_NORMAL = 0;
						$INTERESTAMOUNT_NORMAL = 0;
						$LOANPAYMENT_NORMAL	 = 0;
						
												
						if($LOANTYPEID == '1'){
							$LOANAMOUNT_CAR			= $LOANAMOUNT ; 
							$INTERESTAMOUNT_CAR		= $INTERESTAMOUNT ; 
							$LOANPAYMENT_CAR		= $LOANPAYMENT ;
							
						}elseif($LOANTYPEID == '2'){
							$LOANAMOUNT_BASTA			= $LOANAMOUNT ; 
							$LOANPAYMENT_BASTA			= $LOANPAYMENT ;
							
						}elseif($LOANTYPEID == '3'){
							$LOANAMOUNT_NORMAL			= $LOANAMOUNT ; 
							$INTERESTAMOUNT_NORMAL		= $INTERESTAMOUNT ; 
							$LOANPAYMENT_NORMAL			= $LOANPAYMENT ;
						}
						
						
						
						$BookingQuery	 			= "SELECT 	SUM(BOOKINGMONEY) BOOKINGMONEY,
																SUM(ADJUSTMENTMONEY) ADJUSTMENTMONEY
															FROM fna_alubooking
															WHERE PROJECTID = '".$PROJECTID."'
															AND SUBPROJECTID = '".$SUBPROJECTID."'
															AND PARTYID = '".$PARTYID."'
															AND BOOKINGDATE BETWEEN  '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
															
														";
						$BookingQueryStatement					= mysql_query($BookingQuery);
						$BOOKINGMONEY		= 0;
						$ADJUSTMENTMONEY	= 0;
						//$BALANCE			= 0;
						while($BookingQueryStatementData		= mysql_fetch_array($BookingQueryStatement)){	
							$BOOKINGMONEY						= $BookingQueryStatementData['BOOKINGMONEY'];
							$ADJUSTMENTMONEY					= $BookingQueryStatementData['ADJUSTMENTMONEY'];
							//$BALANCE							= $BookingQueryStatementData['BALANCE'];
							
						}
						
						$CommissionQuery	 			= "SELECT 	SUM(TOTALCOMMISSION) TOTALCOMMISSION
																FROM fna_alucommission
																WHERE PROJECTID = '".$PROJECTID."'
																AND SUBPROJECTID = '".$SUBPROJECTID."'
																AND PARTYID = '".$PARTYID."'
																AND COMMDATE BETWEEN  '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
																
															";
						$CommissionQueryStatement					= mysql_query($CommissionQuery);
						$TOTALCOMMISSION		= 0;
						while($CommissionQueryStatementData		= mysql_fetch_array($CommissionQueryStatement)){	
							$TOTALCOMMISSION					= $CommissionQueryStatementData['TOTALCOMMISSION'];
							
						}
						
						$TotalPaymentFare	= $UNITFARE * $UNLOADQUANTITY ;
						$TotalTakaFare		= $UNITFARE * $LOADQUANTITY ;
						$Final_Balance			= ($TotalTakaFare + $LOANAMOUNT_BASTA + $LOANAMOUNT_CAR + $LOANAMOUNT_NORMAL + $INTERESTAMOUNT_CAR + $INTERESTAMOUNT_NORMAL ) - ($LOANPAYMENT_CAR + $LOANPAYMENT_NORMAL + $LOANPAYMENT_BASTA );
						//$Final_Balance			= ($TotalPaymentFare + $LOANPAYMENT_CAR + $LOANPAYMENT_NORMAL + $LOANPAYMENT_BASTA );
												
						
						$Global_Final_Balance		= ($TotalTakaFare + $LOANAMOUNT_BASTA + $LOANAMOUNT_CAR + $LOANAMOUNT_NORMAL + $INTERESTAMOUNT_CAR + $INTERESTAMOUNT_NORMAL ) ; 
						$Global_TotalTaka			= $Global_TotalTaka + $TotalTakaFare ;
						$Global_PaymentFare			= $Global_PaymentFare + $TotalPaymentFare ; 
						$Global_BastaLoan			= $Global_BastaLoan + $BASTA_SELLPRICE ; 
						$Global_CarLoan				= $Global_CarLoan + $LOANAMOUNT_CAR ; 
						$Global_NormalLoan			= $Global_NormalLoan + $LOANAMOUNT_NORMAL ; 
						$Global_Quantity_Load		= $Global_Quantity_Load + $LOADQUANTITY ;
						$Global_Quantity_UnLoad		= $Global_Quantity_UnLoad + $UNLOADQUANTITY ; 
						$Global_LotQuantity			= $Global_LotQuantity + $LOTTOTQNTY ; 
						
						$Net_Payable_Amount			= $Global_TotalTaka - $TOTALCOMMISSION ;
 						$Total_Due					= $Global_TotalTaka - $Global_PaymentFare ;
						$Party_Balance_Basta		= $Global_Quantity_Load - $Global_Quantity_UnLoad ; 
						
						// Dynamic Row Start
						$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000'>$sl</td>

											<td align='center' valign='top' style='border: 1px dotted #000'>$individualDate </td>
											
											<td align='center' valign='top' style='border: 1px dotted #000'>$PRODUCTNAME </td>
					
											<td align='right' valign='top'  style='border: 1px dotted #000'>$NowLotNo</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>$LOADQUANTITY</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>$UNLOADQUANTITY</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>$LOTTOTQNTY</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($UNITFARE,2)."</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($TotalTakaFare,2)."</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($TotalPaymentFare,2)."</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'> ".number_format($BASTA_SELLPRICE,2)."</td>
					
											<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($BASTA_RECEIVEDAMOUNT,2)."</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($LOANAMOUNT_CAR,2)."</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($INTERESTAMOUNT_CAR,2)."</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($LOANPAYMENT_CAR,2)."</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($LOANAMOUNT_NORMAL,2)."</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($INTERESTAMOUNT_NORMAL,2)."</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($LOANPAYMENT_NORMAL,2)."</td>
											
										</tr>

									 ";

								// Dynamic Row End		  

							$sl++;
						
						
						$k++;
						}

					$tableView .="

						<tr style='font-weight:bold;'>

							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='right' valign='top'  style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='right' valign='top'  style='border: 1px dotted #000'>&nbsp;</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>$Global_Quantity_Load</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>$Global_Quantity_UnLoad</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>$Party_Balance_Basta</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_TotalTaka,2)."</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_PaymentFare,2)."</td>
							
							<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($Global_BastaLoan,2)."</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_CarLoan,2)."</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_NormalLoan,2)."</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							
						</tr>
						<tr>

							<td colspan='18' align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

						</tr>
						<tr>

							<td colspan='18' align='center' valign='top' >
								<table width='50%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:100%;'>
								  <tr style='background-color:lightgrey'>
									<td align='right' width='50%' style='border: 1px dotted #000'><b>Total Bill Amount</b></td>
									<td width='2%' style='border: 1px dotted #000'>:</td>
									<td width='48%' style='border: 1px dotted #000'><b>".number_format($Global_TotalTaka,2)."</b></td>
								  </tr>
								  <tr>
									<td align='right' width='50%' style='border: 1px dotted #000'>Total Bill Receive Amount</td>
									<td width='2%' style='border: 1px dotted #000'>:</td>
									<td width='48%' style='border: 1px dotted #000'>".number_format($Global_PaymentFare,2)."</td>
								  </tr>
								  <tr>
									<td align='right' width='50%' style='border: 1px dotted #000'>Total Due</td>
									<td width='2%' style='border: 1px dotted #000'>:</td>
									<td width='48%' style='border: 1px dotted #000'>".number_format($Total_Due,2)."</td>
								  </tr>
								  <tr>
									<td align='right' width='50%' style='border: 1px dotted #000'>Total Booking Money</td>
									<td width='2%' style='border: 1px dotted #000'>:</td>
									<td width='48%' style='border: 1px dotted #000'>".number_format($BOOKINGMONEY,2)."</td>
								  </tr>
								  <tr>
									<td align='right' width='50%' style='border: 1px dotted #000'>Booking Return Amount</td>
									<td width='2%' style='border: 1px dotted #000'>:</td>
									<td width='48%' style='border: 1px dotted #000'>".number_format($ADJUSTMENTMONEY,2)."</td>
								  </tr>
								  <tr>
									<td align='right' width='50%' style='border: 1px dotted #000'>Total Commission Amount</td>
									<td width='2%' style='border: 1px dotted #000'>:</td>
									<td width='48%' style='border: 1px dotted #000'>".number_format($TOTALCOMMISSION,2)."</td>
								  </tr>
								  <tr style='background-color:lightgrey'>
									<td align='right' width='50%' style='border: 1px dotted #000'><b>Net Payable Amount</b></td>
									<td width='2%' style='border: 1px dotted #000'>:</td>
									<td width='48%' style='border: 1px dotted #000'><b>".number_format($Net_Payable_Amount,2)."</b></td>
								  </tr>
								</table>
							</td>

						</tr>	
						<tr>

							<td colspan='18' align='left' valign='top'>&nbsp;</td>

						</tr>
						<tr>

							<td colspan='18' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='18' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='18' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='18' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='18' align='left' valign='top' >
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

							<td colspan='18' align='left' valign='top' >&nbsp;</td>

						</tr>
						<tr>

							<td colspan='18' align='left' valign='top' >&nbsp;</td>

						</tr>					

					</table>";
	echo $tableView;

?>