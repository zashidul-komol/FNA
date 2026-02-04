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
	//$PARTYID 			= $_REQUEST['PARTYID'];
	
	$ENTRYDATE_FROM 	= showDateMySQlFormat($_REQUEST['ENTRYDATE']);
	$ENTRYDATE_TO 		= showDateMySQlFormat($_REQUEST['ENTRYDATE2']);
	$userId 			= $_REQUEST['userId'];
	$con = '';
		
		
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
						<td colspan='11' align='center' valign='middle' style='border: 1px dotted #000'>
							<center><b><font size=5>F N A Group Of Company</font></b></center>
							<center>&nbsp;</center>
							<center><b><font size=2>Customer Ledger Report -- $SUBPROJECTNAME </FONT></b></center>
							<center><b><font size=2>Date : $ENTRYDATE_FROM to $ENTRYDATE_TO </font></b></center>
						</td>
					  </tr>
					  <tr>

						<td colspan='11' align='left' valign='top'>
							<table width='100%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:100%;'>
								  
								  <tr>
								
									<td colspan='7'  align='left' valign='top'><font size='+2'>Customer Ledger   :    </font><b></td>
									
								  </tr>
								  <tr>
								  	<td colspan='7' align='left' valign='top'><font size='+2'>-------------------------------------</font><b></td>
								  </tr>
								 
								
								</table>
							

						</td>

					  </tr>

					  <tr style='font-weight:bold;'>

						<td align='center' valign='top' style='font-weight:bold;border: 1px dotted #000'>SL No.</td>

						<td align='center' valign='top'  style='border: 1px dotted #000'>Party Name</td>
						
						<td align='center' valign='top'  style='border: 1px dotted #000'>Product Name</td>
						
						<td align='center' valign='top'  style='border: 1px dotted #000'>Lot No.</td>

						<td align='center' valign='top' style='border: 1px dotted #000'>In.</td>

						<td align='center' valign='top' style='border: 1px dotted #000'>Out.</td>

						<td align='center' valign='top' style='border: 1px dotted #000'>Balance </td>

						<td align='center' valign='top' style='border: 1px dotted #000'>Unit Price</td>
						
						<td align='center' valign='top' style='border: 1px dotted #000'>Total Bill</td>
						
						<td align='center' valign='top' style='border: 1px dotted #000'>Payment</td>
						
						<td align='center' valign='top' style='border: 1px dotted #000'>Balance Bill</td>
						
												
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
													DISTINCT LOTNO
												FROM fna_productloadunload
												WHERE PROJECTID = '".$PROJECTID."'
												AND SUBPROJECTID = '".$SUBPROJECTID."'
												AND LOTNO != 0
												AND ENTRYDATE between '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."' 
												ORDER BY LOTNO ASC
											";
						$DateQueryStatement					= mysql_query($DateQuery);
						while($DateQueryStatementData		= mysql_fetch_array($DateQueryStatement)){	
							$LOTNO_ARRAY[] 					= $DateQueryStatementData['LOTNO'];
							//$PRIMARYID_ARRAY[] 				= $DateQueryStatementData['PRODUCTLOADUNLOADID'];
							$i++;
						}
						$i = 0;
						/*$DateQuery 	= "SELECT  
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
						}*/
						
						//$ENTRYDATE_ARRAY_UNIQUE 	= array_unique($ENTRYDATE_ARRAY);
						$k = 0;
						$sl = 1;
						$Global_Final_Balance = 0;
						foreach($LOTNO_ARRAY as $individualLOT){
						//$PRIMARY_ID	= $PRIMARYID_ARRAY[$k] ;
						//$LOAN_ID	= $PRIMARYID_LOAN_ARRAY[$k] ;
						
						$aQuery 	= "SELECT 
												plu.LOTNO,
												plu.PARTYID,
												bkdn.PRODUCTLOADUNLOADID,
												bkdn.PRODUCTID,
												bkdn.PACKINGUNITID,
												SUM(alus.LOADQUANTITY) LOADQUANTITY,
												SUM(alus.UNLOADQUANTITY) UNLOADQUANTITY,
												alus.LOTTOTQNTY,
												alus.PARTYTOTQNTY,
												alus.WORKTYPEFLAG
											FROM fna_productloadunload plu, fna_productloadunloadbkdn bkdn, fna_alustock alus
											WHERE plu.PRODUCTLOADUNLOADID = bkdn.PRODUCTLOADUNLOADID
											AND bkdn.PRODUCTLOADUNLOADBKDNID = alus.PRODUCTLOADUNLOADBKDNID
											AND plu.LOTNO = '".$individualLOT."'
											AND plu.PROJECTID = '".$PROJECTID."'
											AND plu.SUBPROJECTID = '".$SUBPROJECTID."'
											AND plu.ENTRYDATE between '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
											
									";
						$aQueryStatement			= mysql_query($aQuery);
						
						$LotNo = 0;
						$PRODUCTID = 0;
						$PACKINGUNITID = 0;
						$LOADQUANTITY = 0;
						$UNLOADQUANTITY = 0;
						while($aQueryStatementData	= mysql_fetch_array($aQueryStatement)){
							$LotNo					= $aQueryStatementData['LOTNO'];
							$PARTYID				= $aQueryStatementData['PARTYID'];
							$PRODUCTID				= $aQueryStatementData['PRODUCTID'];
							$PACKINGUNITID			= $aQueryStatementData['PACKINGUNITID'];
							$LOADQUANTITY			= $aQueryStatementData['LOADQUANTITY'];
							$UNLOADQUANTITY			= $aQueryStatementData['UNLOADQUANTITY'];
							$LOTTOTQNTY				= $aQueryStatementData['LOTTOTQNTY'];
							$WORKTYPEFLAG			= $aQueryStatementData['WORKTYPEFLAG'];
							$PARTYTOTQNTY			= $aQueryStatementData['PARTYTOTQNTY'];
							
						}
						
						$Product_Balance			= $LOADQUANTITY - $UNLOADQUANTITY ; 
						$partySql 	= "
											SELECT p.PARTYNAME, p.FATHERNAME, p.ADDRESS, p.MOBILE											
											FROM fna_party p
											WHERE p.PARTYID = '".$PARTYID."'
										";
							$partySqlStatement				= mysql_query($partySql);
							while($partySqlStatementData	= mysql_fetch_array($partySqlStatement)){
								$PARTYNAME        		= $partySqlStatementData["PARTYNAME"];
								$FATHERNAME       		= $partySqlStatementData["FATHERNAME"];
								$ADDRESS       		= $partySqlStatementData["ADDRESS"];
								$MOBILE       			= $partySqlStatementData["MOBILE"];
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
						
						$TotalPaymentFare	= $UNITFARE * $UNLOADQUANTITY ;
						$TotalTakaFare		= $UNITFARE * $LOADQUANTITY ;
						$Balance_Bill		= $TotalTakaFare - $TotalPaymentFare ; 
						
						$Global_TotalTaka			= $Global_TotalTaka + $TotalTakaFare ;
						$Global_PaymentFare			= $Global_PaymentFare + $TotalPaymentFare ; 
						//$Global_BastaLoan			= $Global_BastaLoan + $BASTA_SELLPRICE ; 
						//$Global_CarLoan				= $Global_CarLoan + $LOANAMOUNT_CAR ; 
						//$Global_NormalLoan			= $Global_NormalLoan + $LOANAMOUNT_NORMAL ; 
						$Global_Quantity_Load		= $Global_Quantity_Load + $LOADQUANTITY ;
						$Global_Quantity_UnLoad		= $Global_Quantity_UnLoad + $UNLOADQUANTITY ; 
						//$Global_LotQuantity			= $Global_LotQuantity + $LOTTOTQNTY ; 
						
						//$Net_Payable_Amount			= $Global_TotalTaka - $TOTALCOMMISSION ;
 						$Total_Due					= $Global_TotalTaka - $Global_PaymentFare ;
						$Party_Balance_Basta		= $Global_Quantity_Load - $Global_Quantity_UnLoad ; 
						
						// Dynamic Row Start
						$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000'>$sl</td>

											<td align='center' valign='top' style='border: 1px dotted #000'> $PARTYNAME</td>
											
											<td align='center' valign='top' style='border: 1px dotted #000'>$PRODUCTNAME </td>
					
											<td align='right' valign='top'  style='border: 1px dotted #000'>$NowLotNo</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>$LOADQUANTITY</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>$UNLOADQUANTITY</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>$Product_Balance</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($UNITFARE,2)."</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($TotalTakaFare,2)."</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($TotalPaymentFare,2)."</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'> ".number_format($Balance_Bill,2)."</td>
					
											
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

							
						</tr>
						<tr>

							<td colspan='11' align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

						</tr>
						<tr>

							<td colspan='11' align='center' valign='top' >
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
								  <tr style='background-color:lightgrey'>
									<td align='right' width='50%' style='border: 1px dotted #000'><b>Net Payable Amount</b></td>
									<td width='2%' style='border: 1px dotted #000'>:</td>
									<td width='48%' style='border: 1px dotted #000'><b>".number_format(0,2)."</b></td>
								  </tr>
								</table>
							</td>

						</tr>	
						<tr>

							<td colspan='11' align='left' valign='top'>&nbsp;</td>

						</tr>
						<tr>

							<td colspan='11' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='11' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='11' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='11' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='11' align='left' valign='top' >
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

							<td colspan='11' align='left' valign='top' >&nbsp;</td>

						</tr>
						<tr>

							<td colspan='11' align='left' valign='top' >&nbsp;</td>

						</tr>					

					</table>";
	echo $tableView;

?>