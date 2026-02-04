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
		$con = "AND fp.PARTYID ='".$PARTYID."' ";
	}
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
							<center><b><font size=4>Party Statement Report</FONT></b></center>
							<center>&nbsp;</center>
							<center><b><font size=4>Feed Mill</FONT></b></center>
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
					  <tr>

							<td colspan='8' align='center' valign='top' style='border: 1px dotted #000'><b><font size='+1'>Purchase History</font></b></td>

					  </tr>
					  <tr style='font-weight:bold;'>

						<td align='center' valign='middle' style='font-weight:bold;border: 1px dotted #000'>SL No.</td>
						
						<td align='center' valign='middle'  style='border: 1px dotted #000'>Date</td>

						<td align='center' valign='middle'  style='border: 1px dotted #000'>Product Name.</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Party Name</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Quantity</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Unit Price</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Total Price</td>
						
																	
					</tr>
					";

// Query here.
						//$TOTAL_RECEIVE_QNTY_KG ='';
						$BasicQuery 	= "SELECT fp.PRODUCTID,
												  fp.QUANTITY,
												  fp.UNITPRICE,
												  fp.AMOUNT,
												  fp.PURCHASEDATE,
												  fp.PARTYID,
												  p.PARTYNAME,
												  prd.PRODUCTNAME
												FROM feed_purchaserawmat fp, fna_party p, fna_product prd
												WHERE p.PARTYID = fp.PARTYID
												{$con}
												AND prd.PRODUCTID = fp.PRODUCTID
												AND fp.PURCHASEDATE BETWEEN '".$OPENINGDATE_FROM."' AND '".$OPENINGDATE_TO."'
												AND fp.PROJECTID = '".$PROJECTID."'
												AND fp.SUBPROJECTID = '".$SUBPROJECTID."'
												
										";
						$BasicQueryStatement			= mysql_query($BasicQuery);
						$SL = 1;
						$Global_Quantity = 0;
						$Global_Total_Price = 0;
						$globalRecAmount = 0;
						$RECEIVEAMOUNT = 0;
						$partyBalAmount = 0;
						$BILLAMOUNT = 0;
						$PAYMENTAMOUNT = 0;
						
						while($BasicQueryStatementData	= mysql_fetch_array($BasicQueryStatement)){	
							$PRODUCTID		 			= $BasicQueryStatementData['PRODUCTID'];
							$QUANTITY		 			= $BasicQueryStatementData['QUANTITY'];
							$UNITPRICE		 			= $BasicQueryStatementData['UNITPRICE'];
							$AMOUNT			 			= $BasicQueryStatementData['AMOUNT'];
							$PURCHASEDATE	 			= $BasicQueryStatementData['PURCHASEDATE'];
							$PARTYID_CP		 			= $BasicQueryStatementData['PARTYID'];
							$PARTYNAME		 			= $BasicQueryStatementData['PARTYNAME'];
							$PRODUCTNAME	 			= $BasicQueryStatementData['PRODUCTNAME'];
							
							$Global_Quantity			= $Global_Quantity + $QUANTITY ; 
							$Global_Total_Price			= $Global_Total_Price + $AMOUNT;
							
							$partyReceiveAmount = "
														SELECT
																fp.PARTYID,
																SUM(fp.RECEIVEAMOUNT) AS RECAMOUNT
														FROM
																fna_partybill fp
														WHERE fp.PROJECTID = '".$PROJECTID."'
														AND fp.SUBPROJECTID = '".$SUBPROJECTID."'
														{$con}
														AND fp.ENTRYDATE BETWEEN '".$OPENINGDATE_FROM."' AND '".$OPENINGDATE_TO."'
													";
							$partyReceiveAmountQueryStatement				= mysql_query($partyReceiveAmount);
							while($partyReceiveAmountQueryStatementData	= mysql_fetch_array($partyReceiveAmountQueryStatement)) {
									$RECEIVEAMOUNT 							= $partyReceiveAmountQueryStatementData["RECAMOUNT"];	
								}
								
							$partyPaymentAmount = "
														SELECT
																fp.PARTYID,
																SUM(fp.PAYMENTAMOUNT) AS PAYMENTAMOUNT
														FROM
																fna_partybill fp
														WHERE fp.PROJECTID = '".$PROJECTID."'
														AND fp.SUBPROJECTID = '".$SUBPROJECTID."'
														{$con}
														AND fp.ENTRYDATE BETWEEN '".$OPENINGDATE_FROM."' AND '".$OPENINGDATE_TO."'
													";
							$partyPaymentAmountStatement					= mysql_query($partyPaymentAmount);
							$PAYMENTAMOUNT = 0;
							while($partyPaymentAmountStatementData			= mysql_fetch_array($partyPaymentAmountStatement)) {
									$PAYMENTAMOUNT 							= $partyPaymentAmountStatementData["PAYMENTAMOUNT"];	
								}
							
								$globalRecAmount 	= $globalRecAmount + $RECEIVEAMOUNT ; 
								$partyBalAmount 	= $Global_Total_Price - $PAYMENTAMOUNT ; 
						
														
							$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000'>$SL</td>
											
											<td align='center' valign='top'  style='border: 1px dotted #000'>$PURCHASEDATE</td>
											
											<td align='center' valign='top'  style='border: 1px dotted #000'>$PRODUCTNAME</td>
											
											<td align='center' valign='top'  style='border: 1px dotted #000'>$PARTYNAME</td>
																						
											<td align='center' valign='top'  style='border: 1px dotted #000'>$QUANTITY</td>
											
											<td align='center' valign='top'  style='border: 1px dotted #000'>".number_format($UNITPRICE,2)."</td>
											
											<td align='center' valign='top'  style='border: 1px dotted #000'>".number_format($AMOUNT,2)."</td>
											
											
																							
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

							<td align='center' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='center' valign='top' style='border: 1px dotted #000'>$Global_Quantity</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='center' valign='top'  style='border: 1px dotted #000'>".number_format($Global_Total_Price,2)."</td>

							
						</tr>
						<tr>

							<td colspan='8' align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

						</tr>
						<tr>

							<td colspan='8' align='center' valign='top' style='border: 1px dotted #000'><b><font size='+1'>Sales History</font></b></td>

						</tr>
						<tr>

							<td colspan='8' align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

						</tr>
						";
						
				$FeedSellQuery 	= "SELECT fs.PARTYID,
										  fs.FOODID,
										  fs.QUANTITY,
										  fs.AMOUNT,
										  fs.AVGPRICE,
										  fs.FOODFLAG,
										  fs.STATUS,
										  fs.ENTDATE,
										  fi.FOODNAME,
										  p.PARTYNAME
										FROM feed_finishedstock fp, feed_fooditem fi, fna_party p
										WHERE fi.FOODID = fp.FOODID
										AND p.PARTYID = fp.PARTYID
										{$con}
										AND fp.ENTDATE BETWEEN '".$OPENINGDATE_FROM."' AND '".$OPENINGDATE_TO."'
										AND fp.PROJECTID = '2'
										AND fp.SUBPROJECTID = '6'
										
								";
				$FeedSellQueryStatement			= mysql_query($FeedSellQuery);
				$SLF = 1;
				$Global_Quantity_Feed = 0;
				$Global_Total_Price_Feed = 0;
				$RECEIVEAMOUNT_FEED = 0;
				$GLOBAL_BALANCE_FEED = 0;
				while($FeedSellQueryStatementData	= mysql_fetch_array($FeedSellQueryStatement)){	
					$PARTYID_FEED	 			= $FeedSellQueryStatementData['PARTYID'];
					$FOODID			 			= $FeedSellQueryStatementData['FOODID'];
					$QUANTITY_FEED	 			= $FeedSellQueryStatementData['QUANTITY'];
					$AMOUNT_FEED	 			= $FeedSellQueryStatementData['AMOUNT'];
					$SELLAVGPRICE	 			= $FeedSellQueryStatementData['AVGPRICE'];
					$FOODFLAG		 			= $FeedSellQueryStatementData['FOODFLAG'];
					$ENTDATE		 			= $FeedSellQueryStatementData['ENTDATE'];
					$FOODNAME		 			= $FeedSellQueryStatementData['FOODNAME'];
					$PARTYNAME_FEED	 			= $FeedSellQueryStatementData['PARTYNAME'];
					
					$Global_Quantity_Feed		= $Global_Quantity_Feed + $QUANTITY_FEED ; 
					$Global_Total_Price_Feed	= $Global_Total_Price_Feed + $AMOUNT_FEED;
					
					$partyReceiveAmountFeed = "
												SELECT
														SUM(RECEIVEAMOUNT) AS RECEIVEAMOUNT
												FROM
														fna_partybill fp
												WHERE fp.PROJECTID = '".$PROJECTID."'
												AND fp.SUBPROJECTID = '".$SUBPROJECTID."'
												{$con}
												AND fp.ENTRYDATE BETWEEN '".$OPENINGDATE_FROM."' AND '".$OPENINGDATE_TO."' 
										";
					$partyReceiveAmountFeedStatement				= mysql_query($partyReceiveAmountFeed);
					while($partyReceiveAmountFeedStatementData		= mysql_fetch_array($partyReceiveAmountFeedStatement)) {
							$RECEIVEAMOUNT_FEED						= $partyReceiveAmountFeedStatementData["RECEIVEAMOUNT"];	
						}
								
					$GLOBAL_BALANCE_FEED	= $Global_Total_Price_Feed - $RECEIVEAMOUNT_FEED ;		
					
				$tableView .="
							<tr>
								<td align='center' valign='top' style='border: 1px dotted #000'>$SLF</td>
								
								<td align='center' valign='top'  style='border: 1px dotted #000'>$ENTDATE</td>
								
								<td align='center' valign='top'  style='border: 1px dotted #000'>$FOODNAME</td>
								
								<td align='center' valign='top'  style='border: 1px dotted #000'>Poultry Firm</td>
																			
								<td align='center' valign='top'  style='border: 1px dotted #000'>$QUANTITY_FEED</td>
								
								<td align='center' valign='top'  style='border: 1px dotted #000'>".number_format($SELLAVGPRICE,2)."</td>
								
								<td align='center' valign='top'  style='border: 1px dotted #000'>".number_format($AMOUNT_FEED,2)."</td>
																			
							 </tr>
						  ";
							$SLF ++;
						}
						
						
			$tableView .="

						<tr style='font-weight:bold;'>

							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='center' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='center' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='center' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='center' valign='top' style='border: 1px dotted #000'>$Global_Quantity_Feed</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='center' valign='top'  style='border: 1px dotted #000'>".number_format($Global_Total_Price_Feed,2)."</td>

							
						</tr>";		
				
				$tableView .="  
						<tr>

							<td colspan='8' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='8' align='left' valign='top' >&nbsp;</td>

						</tr>
						
						<tr>

							<td colspan='8' align='left' valign='top'>
								<table width='50%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:100%;'>
								  <tr>
									<td align='right' width='50%' style='border: 1px dotted #000'>Total Purchase</td>
									<td width='2%' style='border: 1px dotted #000'>:</td>
									<td width='48%' style='border: 1px dotted #000'>".number_format($Global_Total_Price,2)."</td>
								  </tr>
								  <tr>
									<td align='right' width='50%' style='border: 1px dotted #000'>Total Payment</td>
									<td width='2%' style='border: 1px dotted #000'>:</td>
									<td width='48%' style='border: 1px dotted #000'>".number_format($PAYMENTAMOUNT,2)."</td>
								  </tr>
								  <tr>
									<td align='right' width='50%' style='border: 1px dotted #000'>Purchase Balance</td>
									<td width='2%' style='border: 1px dotted #000'>:</td>
									<td width='48%' style='border: 1px dotted #000'>".number_format($partyBalAmount,2)."</td>
								  </tr>
								  <tr>
									<td colspan='3' align='right' width='100%' style='border: 1px dotted #000'>&nbsp;</td>
								  </tr>
								  <tr>
									<td align='right' width='50%' style='border: 1px dotted #000'>Total Sales</td>
									<td width='2%' style='border: 1px dotted #000'>:</td>
									<td width='48%' style='border: 1px dotted #000'>".number_format($Global_Total_Price_Feed,2)."</td>
								  </tr>
								   <tr>
									<td align='right' width='50%' style='border: 1px dotted #000'>Receive</td>
									<td width='2%' style='border: 1px dotted #000'>:</td>
									<td width='48%' style='border: 1px dotted #000'>".number_format($RECEIVEAMOUNT_FEED,2)."</td>
								  </tr>
								  <tr>
									<td align='right' width='50%' style='border: 1px dotted #000'>Sales Balance </td>
									<td width='2%' style='border: 1px dotted #000'>:</td>
									<td width='48%' style='border: 1px dotted #000'>".number_format($GLOBAL_BALANCE_FEED,2)."</td>
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