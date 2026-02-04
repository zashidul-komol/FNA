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
			
			//Ministry/Division and Project/Programme Name View Report End
			
	$tableView = "";	
	$tableView .="<table width='100%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:85%; border: 1px dotted #000'>

					  <tr>
                            <td style='text-align:right;' colspan='17'>
                            <a href='javascript:Clickheretoprint()'><img border='0' src='images/print_icon.jpg' width='40' height='26' /></a>                        
                            </td>
                     </tr>
					  <tr>
						<td colspan='17' align='center' valign='middle' style='border: 1px dotted #000'>
							<center><b><font size=5>F N A Group Of Company</font></b></center>
							<center>&nbsp;</center>
							<center><b><font size=2>Customer Ledger Report</FONT></b></center>
							<center><b><font size=2>Date : $ENTRYDATE_FROM to $ENTRYDATE_TO </font></b></center>
						</td>
					  </tr>
					  <tr>

						<td colspan='17' align='left' valign='top'>
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

						<td align='center' valign='top' style='font-weight:bold;border: 1px dotted #000'>SL No.</td>

						<td align='center' valign='top'  style='border: 1px dotted #000'>Date</td>
						
						<td align='center' valign='top'  style='border: 1px dotted #000'>Lot No.</td>

						<td align='center' valign='top' style='border: 1px dotted #000'>In.</td>

						<td align='center' valign='top' style='border: 1px dotted #000'>Out.</td>

						<td align='center' valign='top' style='border: 1px dotted #000'>Balance </td>

						<td align='center' valign='top' style='border: 1px dotted #000'>Unit Price</td>
						
						<td align='center' valign='top' style='border: 1px dotted #000'>Total</td>
						
						<td align='center' valign='top' style='border: 1px dotted #000'>Basta Loan</td>
						
						<td align='center' valign='top' style='border: 1px dotted #000'>Payment</td>
						
						<td align='center' valign='top' style='border: 1px dotted #000'>Car Loan</td>
						
						<td align='center' valign='top' style='border: 1px dotted #000'>Interest</td>
						
						<td align='center' valign='top' style='border: 1px dotted #000'>Payment</td>
						
						<td align='center' valign='top' style='border: 1px dotted #000'>Normal Loan</td>
						
						<td align='center' valign='top' style='border: 1px dotted #000'>Interest</td>
						
						<td align='center' valign='top' style='border: 1px dotted #000'>Payment</td>
						
						<td align='center' valign='top' style='border: 1px dotted #000'>Final Balance</td>

					  </tr>";

// Query here.			
						$i = 0;
						$DateQuery 	= "SELECT DISTINCT ENTRYDATE
												FROM fna_productloadunload
												WHERE ENTRYDATE between '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."' 
												ORDER BY ENTRYDATE ASC
											";
						$DateQueryStatement					= mysql_query($DateQuery);
						while($DateQueryStatementData		= mysql_fetch_array($DateQueryStatement)){	
							$ENTRYDATE_ARRAY[] 					= $DateQueryStatementData['ENTRYDATE'];
							$i++;
						}
						
						$DateQuery 	= "SELECT ENTRYDATE
												FROM fna_loan
												WHERE ENTRYDATE between '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."' 
												ORDER BY ENTRYDATE ASC
											";
						$DateQueryStatement					= mysql_query($DateQuery);
						while($DateQueryStatementData		= mysql_fetch_array($DateQueryStatement)){	
							$ENTRYDATE_ARRAY[] 					= $DateQueryStatementData['ENTRYDATE'];
							$i++;
						}
						
						$ENTRYDATE_ARRAY_UNIQUE 	= array_unique($ENTRYDATE_ARRAY);
						foreach($ENTRYDATE_ARRAY_UNIQUE as $individualDate){
						
						/*//$LOANTYPEID = 0;
						*/
						//echo $individualDate ;
						$aQuery 	= "SELECT 
												plu.LOTNO,
												bkdn.PRODUCTLOADUNLOADID,
												bkdn.PRODUCTID,
												bkdn.PACKINGUNITID,
												alus.QUANTITY,
												alus.LOTTOTQNTY,
												p.PARTYNAME
											FROM fna_productloadunload plu, fna_productloadunloadbkdn bkdn, fna_alustock alus, fna_party p
											WHERE plu.PRODUCTLOADUNLOADID = bkdn.PRODUCTLOADUNLOADID
											AND bkdn.PRODUCTLOADUNLOADBKDNID = alus.PRODUCTLOADUNLOADBKDNID
											AND p.PARTYID = alus.PARTYID
											AND plu.PARTYID = '".$PARTYID."' 
											AND plu.PROJECTID = '".$PROJECTID."'
											AND plu.SUBPROJECTID = '".$SUBPROJECTID."'
											AND plu.ENTRYDATE = '".$individualDate."'
											ORDER BY $individualDate ASC
									";
						$aQueryStatement			= mysql_query($aQuery);
						$sl = 1;
						while($aQueryStatementData	= mysql_fetch_array($aQueryStatement)){
							$LotNo					= $aQueryStatementData['LOTNO'];
							$PRODUCTID				= $aQueryStatementData['PRODUCTID'];
							$PACKINGUNITID			= $aQueryStatementData['PACKINGUNITID'];
							$QUANTITY				= $aQueryStatementData['QUANTITY'];
							$LOTTOTQNTY				= $aQueryStatementData['LOTTOTQNTY'];
							$PARTYNAME				= $aQueryStatementData['PARTYNAME'];
						
							
							$ProdFareQuery 			= "SELECT UNITFARE
															FROM fna_productfare
															WHERE PRODUCTID = '".$PRODUCTID."' 
															AND PACKINGUNITID = '".$PACKINGUNITID."'
															AND PARTYID = '".$PARTYID."'
															AND PROJECTID = '".$PROJECTID."'
															AND SUBPROJECTID = '".$SUBPROJECTID."'
															
														";
							$ProdFareQueryStatement					= mysql_query($ProdFareQuery);
							while($ProdFareQueryStatementData		= mysql_fetch_array($ProdFareQueryStatement)){	
								$UNITFARE							= $ProdFareQueryStatementData['UNITFARE'];
								
							}
							
						$TotalTakaFare				= $UNITFARE * $QUANTITY ;
						$NowLotNo					=  $LotNo .'/'. $QUANTITY ; 
						
						$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000'>$sl</td>

											<td align='center' valign='top' style='border: 1px dotted #000'>$individualDate </td>
					
											<td align='right' valign='top'  style='border: 1px dotted #000'>$NowLotNo</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>$QUANTITY </td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'></td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>$LOTTOTQNTY</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($UNITFARE,2)."</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($TotalTakaFare,2)."</td>

											<td align='right' valign='top' style='border: 1px dotted #000'></td>
					
											<td align='right' valign='top'  style='border: 1px dotted #000'></td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>0</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>0</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>0 </td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>0</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>0</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>0</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'></td>
											
										</tr>

									 ";
								}
								// Dynamic Row End		  

					
				$sl++;
					
						$Fna_Loan_Query				= "SELECT 
																l.LOANID,
																l.ENTRYDATE,
																l.LOANTYPEID,
																l.LOANAMOUNT,
																l.INTERESTAMOUNT,
																l.LOANPAYMENT,
																l.BALANCE,
																lt.LOANTYPENAME
															FROM fna_loan l, fna_loantype lt
															WHERE lt.LOANTYPEID = l.LOANTYPEID 
															AND PARTYID = '".$PARTYID."'
															AND PROJECTID = '".$PROJECTID."'
															AND SUBPROJECTID = '".$SUBPROJECTID."'
															AND ENTRYDATE = '".$individualDate."'
															
															
														";
						$Fna_Loan_QueryStatement					= mysql_query($Fna_Loan_Query);
						while($Fna_Loan_QueryStatementData			= mysql_fetch_array($Fna_Loan_QueryStatement)){	
							$ENTRYDATE								= $Fna_Loan_QueryStatementData['ENTRYDATE'];
							$LOANTYPEID								= $Fna_Loan_QueryStatementData['LOANTYPEID'];
							$LOANAMOUNT								= $Fna_Loan_QueryStatementData['LOANAMOUNT'];
							$INTERESTAMOUNT							= $Fna_Loan_QueryStatementData['INTERESTAMOUNT'];
							$LOANPAYMENT							= $Fna_Loan_QueryStatementData['LOANPAYMENT'];
							$BALANCE_LOAN							= $Fna_Loan_QueryStatementData['BALANCE'];
							$LOANTYPENAME							= $Fna_Loan_QueryStatementData['LOANTYPENAME'];
						
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
						
 // Dynamic Row Start
							$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000'>$sl</td>

											<td align='center' valign='top' style='border: 1px dotted #000'>$ENTRYDATE </td>
					
											<td align='right' valign='top'  style='border: 1px dotted #000'>0</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>0</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>0</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>0</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format(0,2)."</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format(0,2)."</td>

											<td align='right' valign='top' style='border: 1px dotted #000'></td>
					
											<td align='right' valign='top'  style='border: 1px dotted #000'></td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>$LOANAMOUNT_CAR</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>$INTERESTAMOUNT_CAR</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>$LOANPAYMENT_CAR </td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>$LOANAMOUNT_NORMAL</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>$INTERESTAMOUNT_NORMAL</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>$LOANPAYMENT_NORMAL</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'></td>
											
										</tr>

									 ";
						}
				
			
						}

					$tableView .="

						<tr>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top'  style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top'  style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>


						</tr>
						<tr>

							<td colspan='17' align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

						</tr>
						<tr>

							<td colspan='17' align='center' valign='top' >
								<table width='50%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:100%;'>
								  <tr>
									<td align='right' width='50%' style='border: 1px dotted #000'>Total Bill Amount</td>
									<td width='2%' style='border: 1px dotted #000'>:</td>
									<td width='48%' style='border: 1px dotted #000'></td>
								  </tr>
								  <tr>
									<td align='right' width='50%' style='border: 1px dotted #000'>Total Bill Receive Amount</td>
									<td width='2%' style='border: 1px dotted #000'>:</td>
									<td width='48%' style='border: 1px dotted #000'></td>
								  </tr>
								  <tr>
									<td align='right' width='50%' style='border: 1px dotted #000'>Balance Bill Amount</td>
									<td width='2%' style='border: 1px dotted #000'>:</td>
									<td width='48%' style='border: 1px dotted #000'></td>
								  </tr>
								</table>
							</td>

						</tr>	
						<tr>

							<td colspan='17 align='left' valign='top'>&nbsp;</td>

						</tr>
						<tr>

							<td colspan='17' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='17' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='17' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='17' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='17' align='left' valign='top' >
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

							<td colspan='17' align='left' valign='top' >&nbsp;</td>

						</tr>
						<tr>

							<td colspan='17' align='left' valign='top' >&nbsp;</td>

						</tr>					

					</table>";
	echo $tableView;

?>