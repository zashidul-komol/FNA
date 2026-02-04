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
	$PARTYID			= $_REQUEST['PARTYID'];
	$OPENINGDATE_FROM 	= showDateMySQlFormat($_REQUEST['ENTRYDATE']);
	$OPENINGDATE_TO		= showDateMySQlFormat($_REQUEST['ENTRYDATE2']);
	$userId 			= $_REQUEST['userId'];
	
	if ($PARTYID == 'All'){
		$con = '';
	}else{
		$con = "AND cp.PARTYID ='".$PARTYID."' ";
	}
		
	
		/*$Last_Date = date_create($ENTRYDATE_TO);
		date_sub($Last_Date, date_interval_create_from_date_string('1 days'));
		$LastDay = date_format($Last_Date, 'Y-m-d');*/

		//Ministry/Division and Project/Programme Name View Report Start				
	 		if($PARTYID == 'All'){ 
			$PARTYNAME = 'All Party';
			$FATHERNAME ='';
			$ADDRESS = '';
			$MOBILE  = '';
		}else{
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
							<center><b><font size=4>Party Statement Details Report</FONT></b></center>
							<center>&nbsp;</center>
							<center><b><font size=2>Date : $OPENINGDATE_FROM to $OPENINGDATE_TO </font></b></center>
						</td>
					  </tr>
					  <tr>

						<td colspan='18' align='left' valign='top'>
							<table width='100%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:100%;'>
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

						<td colspan='9' align='center' valign='middle' style='font-weight:bold;border: 1px dotted #000'><font size='+1'>Sales History</font></td>
										
					</tr>
					  <tr style='font-weight:bold;'>

						<td align='center' valign='middle' style='font-weight:bold;border: 1px dotted #000'>SL No.</td>

						<td align='center' valign='middle'  style='border: 1px dotted #000'>Date</td>
						
						<td align='center' valign='middle'  style='border: 1px dotted #000'>Hatch No.</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Quantity</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Avg Price</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Sell Amount</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Receive Amount</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Balance Amount</td>
						
																	
					</tr>";

// Query here.
						//$TOTAL_RECEIVE_QNTY_KG ='';
						$BasicQuery 	= "SELECT cp.HATCHNO,
												  cp.QUANTITY,
												  cp.RATE,
												  cp.PRICE,
												  cp.CPDATE,
												  cp.PARTYID,
												  p.PARTYNAME
												FROM hatch_chicken_production cp, fna_party p
												WHERE p.PARTYID = cp.PARTYID
												{$con}
												AND cp.CPDATE BETWEEN '".$OPENINGDATE_FROM."' AND '".$OPENINGDATE_TO."'
												AND cp.PROJECTID = '".$PROJECTID."'
												AND cp.SUBPROJECTID = '".$SUBPROJECTID."'
												AND cp.WORKSFLAG = 'Out'
												
										";
						$BasicQueryStatement			= mysql_query($BasicQuery);
						$SL = 1;
						$Global_Quantity = 0;
						$Global_Total_Price = 0;
						$globalRecAmount = 0;
						$partyBalAmount = 0;
						$RECEIVEAMOUNT = 0;
						$NOW_PARTY_BALANCE_AMOUNT= 0;
						$SellPartyBalanceAmount = 0;
						$Global_Balance_Amount = 0;
						while($BasicQueryStatementData	= mysql_fetch_array($BasicQueryStatement)){	
							$HATCHNO		 			= $BasicQueryStatementData['HATCHNO'];
							$QUANTITY		 			= $BasicQueryStatementData['QUANTITY'];
							$RATE			 			= $BasicQueryStatementData['RATE'];
							$PRICE			 			= $BasicQueryStatementData['PRICE'];
							$CPDATE			 			= $BasicQueryStatementData['CPDATE'];
							$PARTYID_CP		 			= $BasicQueryStatementData['PARTYID'];
							$PARTYNAME		 			= $BasicQueryStatementData['PARTYNAME'];
							
							$Global_Quantity			= $Global_Quantity + $QUANTITY ; 
							$Global_Total_Price			= $Global_Total_Price + $PRICE;
							
							$partyReceiveAmount = "
														SELECT
																PARTYID,
																SUM(SELL_BILLAMOUNT) AS SELLBILLAMOUNT,
																SUM(RECEIVEAMOUNT) AS RECAMOUNT
														FROM
																fna_partybill 
														WHERE PARTYID = '".$PARTYID_CP."'
														AND PURSELLFLAG = 'Sell'
													";
							$partyReceiveAmountQueryStatement				= mysql_query($partyReceiveAmount);
								while($partyReceiveAmountQueryStatementData	= mysql_fetch_array($partyReceiveAmountQueryStatement)) {
									$SELLBILLAMOUNT							= $partyReceiveAmountQueryStatementData["SELLBILLAMOUNT"];
									$RECEIVEAMOUNT_SUM						= $partyReceiveAmountQueryStatementData["RECAMOUNT"];
																			
								}
								
								$partyReceiveAmountDateWise = "
																	SELECT
																			PARTYID,
																			SELL_BILLAMOUNT,
																			RECEIVEAMOUNT,
																			ENTRYDATE
																	FROM
																			fna_partybill 
																	WHERE PARTYID = '".$PARTYID_CP."'
																	AND ENTRYDATE = '".$CPDATE."'
																	AND PURSELLFLAG = 'Sell'
																";
							$partyReceiveAmountDateWiseStatement					= mysql_query($partyReceiveAmountDateWise);
								while($partyReceiveAmountDateWiseStatementData		= mysql_fetch_array($partyReceiveAmountDateWiseStatement)) {
									$SELL_BILLAMOUNT								= $partyReceiveAmountDateWiseStatementData["SELL_BILLAMOUNT"];
									$RECEIVEAMOUNT									= $partyReceiveAmountDateWiseStatementData["RECEIVEAMOUNT"];
																			
								}
								$Balance_Amount				= $PRICE - $RECEIVEAMOUNT ; 
								$globalRecAmount 			= $globalRecAmount + $RECEIVEAMOUNT ; 
								$SellPartyBalanceAmount		= $Global_Total_Price - $globalRecAmount;
								
								$Global_Balance_Amount		= $Global_Balance_Amount + $Balance_Amount ; 
								
						    $PartyFlag				= mysql_fetch_array(mysql_query("SELECT MAX(PARTYFLAG) FROM fna_partybill WHERE PARTYID = '".$PARTYID_CP."' AND PURSELLFLAG = 'Sell'"));
							$MAXPARTYFLAG			= $PartyFlag['MAX(PARTYFLAG)'];
							$PARTY_BALANCE			= mysql_fetch_array(mysql_query("SELECT BALANCEAMOUNT FROM fna_partybill WHERE PARTYID = '".$PARTYID_CP."' AND PARTYFLAG = '".$MAXPARTYFLAG."' AND PURSELLFLAG = 'Sell'"));
							$NOW_PARTY_BALANCE_AMOUNT	= $PARTY_BALANCE['BALANCEAMOUNT'];
														
							$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000'>$SL</td>

											<td align='center' valign='top'  style='border: 1px dotted #000'>$CPDATE</td>
											
											<td align='center' valign='top'  style='border: 1px dotted #000'>$HATCHNO</td>
											
											<td align='center' valign='top'  style='border: 1px dotted #000'>$QUANTITY</td>
											
											<td align='center' valign='top'  style='border: 1px dotted #000'>".number_format($RATE,2)."</td>
											
											<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($PRICE,2)."</td>
											
											<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($RECEIVEAMOUNT,2)."</td>
											
											<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($Balance_Amount,2)."</td>
											
											
																							
										</tr>

									 ";

								// Dynamic Row End		  

					$SL++;	
				
				}

					$tableView .="

						<tr style='font-weight:bold;'>

							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='center' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='center' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='center' valign='top' style='border: 1px dotted #000'>$Global_Quantity</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($Global_Total_Price,2)."</td>
							
							<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($globalRecAmount,2)."</td>
							
							<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($Global_Balance_Amount,2)."</td>

							
						</tr>
						<tr>

							<td colspan='8' align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

						</tr>";
						
						

						
				$tableView .="<tr>

								<td colspan='8' align='center' valign='top' style='border: 1px dotted #000'><font size='+1'>Purchase History</font></td>

							</tr>";
						
						$BasicQueryPurch 	= "SELECT cp.PARTYID,
													  cp.BATCHNO,
													  cp.EGGQUANTITY,
													  cp.RATE,
													  cp.PRICE,
													  cp.OPENDATE,
													  p.PARTYNAME
													FROM hatch_opening_hatching_egg cp, fna_party p
													WHERE p.PARTYID = cp.PARTYID
													{$con}
													AND cp.OPENDATE BETWEEN '".$OPENINGDATE_FROM."' AND '".$OPENINGDATE_TO."'
													AND cp.STATUS = 'In'
												
										";
						$BasicQueryPurchStatement				= mysql_query($BasicQueryPurch);
						$SL = 1;
						$Global_Quantity_Pur = 0;
						$Global_Total_Price_Pur = 0;
						$globalRecAmount_Pur = 0;
						$purBalAmount = 0;
						$PAYMENTAMOUNT_PUR = 0;
						$RECEIVEAMOUNT_PUR = 0;
						$PurBillBalAmount = 0;
						while($BasicQueryPurchStatementData		= mysql_fetch_array($BasicQueryPurchStatement)){	
							$BATCHNO		 					= $BasicQueryPurchStatementData['BATCHNO'];
							$EGGQUANTITY	 					= $BasicQueryPurchStatementData['EGGQUANTITY'];
							$RATE_PUR		 					= $BasicQueryPurchStatementData['RATE'];
							$PRICE_PUR		 					= $BasicQueryPurchStatementData['PRICE'];
							$OPENDATE		 					= $BasicQueryPurchStatementData['OPENDATE'];
							$PARTYID_PUR	 					= $BasicQueryPurchStatementData['PARTYID'];
							$PARTYNAME_PUR	 					= $BasicQueryPurchStatementData['PARTYNAME'];
							
							$Global_Quantity_Pur				= $Global_Quantity_Pur + $EGGQUANTITY ; 
							$Global_Total_Price_Pur				= $Global_Total_Price_Pur + $PRICE_PUR;
							
							$partyReceiveAmount_Pur = "
														SELECT
																
																SUM(PAYMENTAMOUNT) AS PAYMENTAMOUNT,
																SUM(RECEIVEAMOUNT) AS RECAMOUNT
														FROM
																fna_partybill 
														WHERE PARTYID = '".$PARTYID_PUR."'
														AND PURSELLFLAG = 'Purchase'
														AND ENTRYDATE BETWEEN '".$OPENINGDATE_FROM."' AND '".$OPENINGDATE_TO."'
													";
							$partyReceiveAmount_PurStatement				= mysql_query($partyReceiveAmount_Pur);
								while($partyReceiveAmount_PurStatementData	= mysql_fetch_array($partyReceiveAmount_PurStatement)) {
									$PAYMENTAMOUNT_PUR						= $partyReceiveAmount_PurStatementData["PAYMENTAMOUNT"];
									$RECEIVEAMOUNT_PUR						= $partyReceiveAmount_PurStatementData["RECAMOUNT"];
										
								}
								$globalRecAmount_Pur 	= $globalRecAmount_Pur + $RECEIVEAMOUNT_PUR ; 
								$partyBalAmount_Pur 	= $Global_Total_Price_Pur - $RECEIVEAMOUNT_PUR ; 
								$purBalAmount			= $Global_Total_Price_Pur - $PAYMENTAMOUNT_PUR ;
								$PurBillBalAmount		= $Global_Total_Price - $RECEIVEAMOUNT_PUR	;
						
														
							$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000'>$SL</td>
											
											<td align='center' valign='top'  style='border: 1px dotted #000'>$OPENDATE</td>
											
											<td align='center' valign='top'  style='border: 1px dotted #000'>$BATCHNO</td>
											
											<td align='center' valign='top'  style='border: 1px dotted #000'>$EGGQUANTITY</td>
											
											<td align='center' valign='top'  style='border: 1px dotted #000'>".number_format($RATE_PUR,2)."</td>
											
											<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($PRICE_PUR,2)."</td>
											
											<td align='center' valign='top'  style='border: 1px dotted #000'>".number_format($RATE_PUR,2)."</td>
											
											<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($PRICE_PUR,2)."</td>
											
											
																							
										</tr>

									 ";

								// Dynamic Row End		  

					$SL++;	
				
				}

					$tableView .="

						<tr style='font-weight:bold;'>

							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='center' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='center' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='center' valign='top' style='border: 1px dotted #000'>$Global_Quantity_Pur</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($Global_Total_Price_Pur,2)."</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($Global_Total_Price_Pur,2)."</td>

							
						</tr>
						<tr>

							<td colspan='8' align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

						</tr>";
								
						
							
						$tableView .="<tr>

							<td colspan='8' align='left' valign='top'>
								<table width='50%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:100%;'>
								  <tr>
									<td align='right' width='50%' style='border: 1px dotted #000'>Total Bill Amount</td>
									<td width='2%' style='border: 1px dotted #000'>:</td>
									<td width='48%' style='border: 1px dotted #000'>".number_format($Global_Total_Price,2)."</td>
								  </tr>
								  <tr>
									<td align='right' width='50%' style='border: 1px dotted #000'>Total Bill Receive Amount</td>
									<td width='2%' style='border: 1px dotted #000'>:</td>
									<td width='48%' style='border: 1px dotted #000'>".number_format($globalRecAmount,2)."</td>
								  </tr>
								  <tr>
									<td align='right' width='50%' style='border: 1px dotted #000'>Balance Bill Amount</td>
									<td width='2%' style='border: 1px dotted #000'>:</td>
									<td width='48%' style='border: 1px dotted #000'>".number_format($SellPartyBalanceAmount,2)."</td>
								  </tr>
								   <tr>
									<td colspan='3' align='right' width='50%' style='border: 1px dotted #000'>&nbsp;</td>
									
								  </tr>
								   <tr>
									<td align='right' width='50%' style='border: 1px dotted #000'>Total Purchase Amount</td>
									<td width='2%' style='border: 1px dotted #000'>:</td>
									<td width='48%' style='border: 1px dotted #000'>".number_format($Global_Total_Price_Pur,2)."</td>
								  </tr>
								   <tr>
									<td align='right' width='50%' style='border: 1px dotted #000'>Payment Amount</td>
									<td width='2%' style='border: 1px dotted #000'>:</td>
									<td width='48%' style='border: 1px dotted #000'>".number_format($PAYMENTAMOUNT_PUR,2)."</td>
								  </tr>
								   <tr>
									<td align='right' width='50%' style='border: 1px dotted #000'>Balance Amount</td>
									<td width='2%' style='border: 1px dotted #000'>:</td>
									<td width='48%' style='border: 1px dotted #000'>".number_format($purBalAmount,2)."</td>
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
									<td align='right' width='20%' valign='bottom' ><hr width='200' ></td>
									<td width='20%' valign='bottom' ><hr width='200' ></td>
									<td width='20%' valign='bottom' ><hr width='200' ></td>
									<td width='20%' valign='bottom' ><hr width='200' ></td>
									<td width='20%' valign='bottom' ><hr width='200' ></td>
								  </tr>
								  <tr>
									<td align='center' valign='top'  ><b>Store Keeper Signature</b></td>
									<td  align='center' valign='top'  ><b>Computer Operator</b></td>
									<td align='center' valign='top'  ><b>Manager Signature</b></td>
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