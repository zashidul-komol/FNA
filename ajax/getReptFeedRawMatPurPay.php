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

	$PARTYID 			= $_REQUEST['PARTYID'];
	$PROJECTID 			= $_REQUEST['PROJECTID'];
	$SUBPROJECTID		= $_REQUEST['SUBPROJECTID'];
	$PURCHASEDATE_FROM 	= showDateMySQlFormat($_REQUEST['ENTRYDATE']);
	$PURCHASEDATE_TO	= showDateMySQlFormat($_REQUEST['ENTRYDATE2']);
	$userId 			= $_REQUEST['userId'];
	
	if ($PARTYID == 'All'){
		$con = '';
	}else
	{
		$con = "AND p.PARTYID='".$PARTYID."' ";
		}
		/*$Last_Date = date_create($ENTRYDATE_TO);
		date_sub($Last_Date, date_interval_create_from_date_string('1 days'));
		$LastDay = date_format($Last_Date, 'Y-m-d');*/

		//Ministry/Division and Project/Programme Name View Report Start				
	 	$projectSql 	= "
							SELECT  p.PROJECTNAME											
							FROM fna_project p
							WHERE p.PROJECTID = '".$PROJECTID."'
							
						";
			$projectSqlStatement				= mysql_query($projectSql);
			while($projectSqlStatementData		= mysql_fetch_array($projectSqlStatement)){
				$PROJECTNAME        			= $projectSqlStatementData["PROJECTNAME"];
				
			}
			
			$partyNameSql 	= "
							SELECT  p.PARTYNAME											
							FROM fna_party p
							WHERE p.PARTYID = '".$PARTYID."'
							
						";
			$partyNameSqlStatement					= mysql_query($partyNameSql);
			while($partyNameSqlStatementData		= mysql_fetch_array($partyNameSqlStatement)){
				$PARTYNAME	        				= $partyNameSqlStatementData["PARTYNAME"];
				
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
							<center><b><font size=4>$PROJECTNAME - Purchase Report</FONT></b></center>
							<center>&nbsp;</center>
							<center><b><font size=2>Date : $PURCHASEDATE_FROM to $PURCHASEDATE_TO </font></b></center>
						</td>
					  </tr>
					  <tr>

						<td colspan='18' align='left' valign='top'>
							<table width='100%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:100%;'>
								  <tr>
								
									<td width='14%' align='left' valign='top'>Project  Name<b></td>
									<td width='1%' align='center' valign='top'>:</td>
									<td width='30%' align='left' valign='top'><font size='+1'> $PROJECTNAME</font></td>
									<td width='10%' align='right' valign='top'>&nbsp;</td>
									<td width='15%' align='center' valign='top'>Party Name</td>
									<td width='2%' align='left' valign='top'>:</td>
									<td width='28%' align='left' valign='top'><font size='+1'> $PARTYNAME</font> </td>
								
								  </tr>
								
								  							
								  <tr>
								
									<td align='left' valign='top'>&nbsp; </td>
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

						<td align='center' valign='middle' style='font-weight:bold;border: 1px dotted #000'>SL No.</td>

						<td align='center' valign='middle'  style='border: 1px dotted #000'>Purchase Date </td>
						
						<td align='center' valign='middle'  style='border: 1px dotted #000'>Product Name</td>

						<td align='center' valign='middle'  style='border: 1px dotted #000'>Unit Price</td>
                        
                        <td align='center' valign='middle'  style='border: 1px dotted #000'>Quantity</td>

						<td align='center' valign='middle' style='border: 1px dotted #000'>Total Taka</td>
						
					</tr>";

// Query here.
						//---------------------Opening Entry Report End -----------------------------------------------	
						$SL				= 1;
						$Grand_Total_Amount_Opening	= 0;
						
						$OpeningQuery 	= "SELECT p.AMOUNT,
												  p.DATE,
												  p.DESCRIPTION
												FROM fna_opening_payable p
												WHERE 	p.STATUS = 'Opening'
												{$con}
												AND		p.PROJECTID 	= '".$PROJECTID."'
												AND 	p.SUBPROJECTID 	= '".$SUBPROJECTID."'
												AND 	p.DATE BETWEEN '".$PURCHASEDATE_FROM."' AND '".$PURCHASEDATE_TO."'
											";
						$OpeningQueryStatement				= mysql_query($OpeningQuery);
						while($OpeningQueryStatementData	= mysql_fetch_array($OpeningQueryStatement)){	
							$OPENING_AMOUNT	 				= $OpeningQueryStatementData['AMOUNT'];
							$OPENING_DATE					= $OpeningQueryStatementData['DATE'];
							$OPENING_DESCRIPTION			= $OpeningQueryStatementData['DESCRIPTION'];
							
							
							$Grand_Total_Amount_Opening		= $Grand_Total_Amount_Opening + $OPENING_AMOUNT ; 
														
							
						$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000'>$SL</td>

											<td align='center' valign='top' style='border: 1px dotted #000'>$OPENING_DATE</td>
											
											<td align='center' valign='top'  style='border: 1px dotted #000'>$OPENING_DESCRIPTION</td>
											
											<td align='center' valign='top' style='border: 1px dotted #000'></td>
					
											<td align='center' valign='top'  style='border: 1px dotted #000'></td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($OPENING_AMOUNT,2)."</td>
											
											
										</tr>

									 ";

								// Dynamic Row End		  

					$SL++;	
				
				}
				//echo $Grand_Total_Amount_Opening ;
						//---------------------Opening Entry Report End -----------------------------------------------	
						
						
						//$TOTAL_RECEIVE_QNTY_KG ='';
						$SL				= 1;
						$Global_Quantity = 0;
						$Global_Balance_Amount = 0;
						$Global_Amount	= 0;
						//$PAYMENTAMOUNT_NEW 	= '';
						//$PAYMENT_DATE		= '';
						
						$BasicQuery 	= "SELECT p.*,
												  prod.PRODUCTNAME,
												  par.PARTYNAME
												FROM feed_purchaserawmat p, fna_product prod, fna_party par
												WHERE 	prod.PRODUCTID  = p.PRODUCTID
												AND 	p.PARTYID		= par.PARTYID
												{$con}
												AND p.STATUS = 'Active'
												AND		p.PROJECTID 	= '".$PROJECTID."'
												AND 	p.SUBPROJECTID 	= '".$SUBPROJECTID."'
												AND 	p.PURCHASEDATE BETWEEN '".$PURCHASEDATE_FROM."' AND '".$PURCHASEDATE_TO."'
											";
						$BasicQueryStatement			= mysql_query($BasicQuery);
						while($BasicQueryStatementData	= mysql_fetch_array($BasicQueryStatement)){	
							$PARTYID_PUR	 			= $BasicQueryStatementData['PARTYID'];
							$PRODUCTID		 			= $BasicQueryStatementData['PRODUCTID'];
							$INVOICENO		 			= $BasicQueryStatementData['INVOICENO'];
							$UNITPRICE		 			= $BasicQueryStatementData['UNITPRICE'];
							$QUANTITY		 			= $BasicQueryStatementData['QUANTITY'];
							$WTID			 			= $BasicQueryStatementData['WTID'];
							$AMOUNT			 			= $BasicQueryStatementData['AMOUNT'];
							$PURCHASEDATE	 			= $BasicQueryStatementData['PURCHASEDATE'];
							$PRODUCTNAME	 			= $BasicQueryStatementData['PRODUCTNAME'];
							$PARTYNAME	 				= $BasicQueryStatementData['PARTYNAME'];
							//$PURBILLAMOUNT				= $BasicQueryStatementData['PUR_BILLAMOUNT'];
															
							$Global_Quantity			= $Global_Quantity + $QUANTITY ; 
							$Global_Amount				= $Global_Amount + $AMOUNT ; 
							/*
							$Party_Query 	= "SELECT 	sum(p.PUR_BILLAMOUNT) PURBILLAMOUNT,
																sum(p.SELL_BILLAMOUNT) SELLBILLAMOUNT,
																sum(p.PAYMENTAMOUNT) PAYMENTAMOUNT,
																sum(p.RECEIVEAMOUNT) RECEIVEAMOUNT,
																party.PARTYNAME
																	FROM fna_partybill p, fna_party party
																	WHERE party.PARTYID = p.PARTYID
																	AND p.PROJECTID = '".$PROJECTID."'
																	{$con}
																	AND p.ENTRYDATE BETWEEN '".$PURCHASEDATE_FROM."' AND '".$PURCHASEDATE_TO."'
																	
																";
								$Party_QueryStatement						= mysql_query($Party_Query);
								while($Party_QueryStatementData				= mysql_fetch_array($Party_QueryStatement)){	
									$PURBILLAMOUNT							= $Party_QueryStatementData['PURBILLAMOUNT'];
									$SELLBILLAMOUNT							= $Party_QueryStatementData['SELLBILLAMOUNT'];
									$PAYMENTAMOUNT							= $Party_QueryStatementData['PAYMENTAMOUNT'];
									$RECEIVEAMOUNT							= $Party_QueryStatementData['RECEIVEAMOUNT'];
									$PARTYNAME								= $Party_QueryStatementData['PARTYNAME'];
									
								}
								*/
							
						$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000'>$SL</td>

											<td align='center' valign='top' style='border: 1px dotted #000'>$PURCHASEDATE</td>
											
											<td align='center' valign='top'  style='border: 1px dotted #000'>$PRODUCTNAME</td>
											
											<td align='center' valign='top' style='border: 1px dotted #000'>$UNITPRICE</td>
					
											<td align='center' valign='top'  style='border: 1px dotted #000'>$QUANTITY</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($AMOUNT,2)."</td>
											
											
										</tr>

									 ";

								// Dynamic Row End		  

					$SL++;	
				
				}
				
				$Final_Global_Amount = $Global_Amount + $Grand_Total_Amount_Opening ;
				//echo $Final_Global_Amount ; 

					$tableView .="

						<tr style='font-weight:bold;'>

							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='center' valign='top'  style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='center' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='right' valign='top' style='border: 1px dotted #000' bgcolor='#CCCCCC'>Total : </td>

							<td align='center' valign='top' style='border: 1px dotted #000' bgcolor='#CCCCCC'>$Global_Quantity</td>

							<td align='right' valign='top' style='border: 1px dotted #000' bgcolor='#CCCCCC'>".number_format($Final_Global_Amount,2)."</td>
							
						</tr>
						
						<tr>

							<td colspan='6' align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

						</tr>";
						
						$tableViewReceive = "";
						$tableViewReceive .="<table width='70%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:85%; border: 1px dotted #000'>
												<tr style='font-weight:bold;'>
				
													<td align='center' valign='top' style='font-weight:bold;border: 1px dotted #000'>SL No.</td>
							
													<td align='center' valign='top'  style='border: 1px dotted #000'>Payment Date</td>
							
													<td align='center' valign='top' style='border: 1px dotted #000'>Party Name </td>
													
													<td align='center' valign='top' style='border: 1px dotted #000'>Amount</td>
							
																
												</tr>";
						
						$SLPay			= 1;
						$PartyBillQuery 	= "SELECT p.*, par.PARTYNAME
												FROM fna_partybill p, fna_party par
												WHERE p.PARTYID		= par.PARTYID
												{$con}
												AND p.PROJECTID 	= '".$PROJECTID."'
												AND p.SUBPROJECTID 	= '".$SUBPROJECTID."'
												AND p.ENTRYDATE BETWEEN '".$PURCHASEDATE_FROM."' AND '".$PURCHASEDATE_TO."'
												AND p.PAYMENTAMOUNT > 0
											";
						$PartyBillQueryStatement			= mysql_query($PartyBillQuery);
						$Gloabal_Payment_Amount	= 0;
						while($PartyBillQueryStatementData	= mysql_fetch_array($PartyBillQueryStatement)){	
							$ENTRYDATE_PAYMENT				= $PartyBillQueryStatementData['ENTRYDATE'];
							$PAYMENTAMOUNT_PAYMENT			= $PartyBillQueryStatementData['PAYMENTAMOUNT'];
							$PARTYNAME_PAYMENT 				= $PartyBillQueryStatementData['PARTYNAME'];
								
								//if($RECEIVE_RECEIVEAMOUNT > 0){
								$Gloabal_Payment_Amount	= $Gloabal_Payment_Amount + $PAYMENTAMOUNT_PAYMENT ;
								$tableViewReceive .=" <tr>

														<td align='center' valign='top' style='border: 1px dotted #000'>$SLPay</td>
							
														<td align='center' valign='top'  style='border: 1px dotted #000'>$ENTRYDATE_PAYMENT</td>
														
														<td align='center' valign='top' style='border: 1px dotted #000'>$PARTYNAME_PAYMENT</td>
							
														<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($PAYMENTAMOUNT_PAYMENT,2)."</td>
							
														
													</tr> ";

								// Dynamic Row End	
								//}

					
							$SLPay++;
				
								
						}	
						$tableViewReceive .="
							
							<tr >

								<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
	
								<td align='left' valign='top'  style='border: 1px dotted #000'>&nbsp;</td>
	
								<td align='right' valign='top' style='border: 1px dotted #000' bgcolor='#CCCCCC'>Total Bill :</td>
	
								<td align='right' valign='top' style='border: 1px dotted #000' bgcolor='#CCCCCC'>".number_format($Gloabal_Payment_Amount,2)."</td>
	
							</tr>
							<tr>
						
								<td colspan='4' align='center' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							</tr>
						</table>";
							
						$Global_Balance_Amount	= $Final_Global_Amount - $Gloabal_Payment_Amount ;
						
						
						$tableViewFooter ="";
						$tableViewFooter .="<table width='70%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:85%; border: 1px dotted #000'>
						<tr>

							<td colspan='12' align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

						</tr>
						<tr>

							<td colspan='12' align='center' valign='top' >
								<table width='50%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:100%;'>
								  <tr>
									<td align='right' width='50%' style='border: 1px dotted #000'>Total Bill Amount</td>
									<td width='2%' style='border: 1px dotted #000'>:</td>
									<td width='48%' style='border: 1px dotted #000'>".number_format($Final_Global_Amount,2)."</td>
								  </tr>
								 <tr>
									<td align='right' width='50%' style='border: 1px dotted #000'>Total Bill Payment Amount</td>
									<td width='2%' style='border: 1px dotted #000'>:</td>
									<td width='48%' style='border: 1px dotted #000'>".number_format($Gloabal_Payment_Amount,2)."</td>
								  </tr>
								  <tr>
									<td align='right' width='50%' style='border: 1px dotted #000'>Balance Bill Amount</td>
									<td width='2%' style='border: 1px dotted #000'>:</td>
									<td width='48%' style='border: 1px dotted #000'>".number_format($Global_Balance_Amount,2)."</td>
								  </tr>
								   
								</table>
							</td>

						</tr>	
						<tr>

							<td colspan='12' align='left' valign='top'>&nbsp;</td>

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

							<td colspan='12' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='12' align='left' valign='top' >
								<table width='100%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:100%;'>
								  <tr>
									<td align='right' width='34%' valign='bottom' ><hr width='200' ></td>
									<td width='33%' valign='bottom' ><hr width='200' ></td>
									<td width='33%' valign='bottom' ><hr width='200' ></td>
									<td width='33%' valign='bottom' ><hr width='200' ></td>
									<td width='33%' valign='bottom' ><hr width='200' ></td>
								  </tr>
								  <tr>
									<td align='center' valign='top'  ><b>Asst. General Manager </b></td>
									<td  align='center' valign='top'  ><b>General Manager </b></td>
									<td align='center' valign='top'  ><b>Chief Executive Officer</b></td>
									<td align='center' valign='top'  ><b>Head of IT </b></td>
									<td align='center' valign='top'  ><b>Managing Director</b></td>
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
	echo $tableViewReceive;
	echo $tableViewFooter ;

?>