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
	$PRODCATTYPEID		= $_REQUEST['PRODCATTYPEID'];
	$ENTRYDATE_FROM 	= showDateMySQlFormat($_REQUEST['ENTRYDATE']);
	$ENTRYDATE_TO 		= showDateMySQlFormat($_REQUEST['ENTRYDATE2']);
	$userId 			= $_REQUEST['userId'];
	$con = '';
	if ($PRODCATTYPEID == 'All'){
			$con = '';
		}else
		{
			$con = "AND b.PRODCATTYPEID='".$PRODCATTYPEID."' ";
			}

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
			
			if ($PRODCATTYPEID == 'All'){
					$PROD_CATEGORYTYPENAME = 'All';
				}else
				{
					$ProdCatNameSql 	= "
											SELECT pct.CATEGORYTYPENAME											
											FROM fna_productcattype pct
											WHERE pct.PRODCATTYPEID = $PRODCATTYPEID
										";
					$ProdCatNameSqlStatement				= mysql_query($ProdCatNameSql);
					while($ProdCatNameSqlStatementData		= mysql_fetch_array($ProdCatNameSqlStatement)){
						$PROD_CATEGORYTYPENAME        		= $ProdCatNameSqlStatementData["CATEGORYTYPENAME"];
					}
					//$PROD_CATEGORYTYPENAME  = $PROD_CATEGORYTYPENAME ; 
				}

			
			
			
			//Ministry/Division and Project/Programme Name View Report End
			
	$tableView = "";	
	$tableView .="<table width='80%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:85%; border: 1px dotted #000'>

					  <tr>
                            <td style='text-align:right;' colspan='13'>
                            <a href='javascript:Clickheretoprint()'><img border='0' src='images/print_icon.jpg' width='40' height='26' /></a>                        
                            </td>
                     </tr>
					  <tr>
						<td colspan='13' align='center' valign='middle' style='border: 1px dotted #000'>
							<center><b><font size=5>F N A Group Of Company</font></b></center>
							<center>&nbsp;</center>
							<center><b><font size=2>FNA Bill Information</FONT></b></center>
							<center><b><font size=2>Date : $ENTRYDATE_FROM to $ENTRYDATE_TO </font></b></center>
						</td>
					  </tr>
					  <tr>

						<td colspan='13' align='left' valign='top'>
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
								
									<td align='left' valign='top'>Product Cat Name</td>
									<td align='center' valign='top'>: </td>
								
									<td align='left' valign='top'>$PROD_CATEGORYTYPENAME</td>
									<td align='right' valign='top'>&nbsp;</td>
									<td align='center' valign='top'>&nbsp;</td>
									<td align='left' valign='top'>&nbsp;</td>
									<td align='left' valign='top'>&nbsp;</td>
								
								  </tr>
								
								</table>
							

						</td>

					  </tr>

					  <tr style='font-weight:bold;'>

						<td align='left' valign='top' style='font-weight:bold;border: 1px dotted #000'>SL No.</td>

						<td align='left' valign='top'  style='border: 1px dotted #000'>Product Category</td>

						<td align='left' valign='top' style='border: 1px dotted #000'>Product name </td>

						<td align='right' valign='top' style='border: 1px dotted #000'>Drum Qnty</td>

						<td align='right' valign='top' style='border: 1px dotted #000'>Cartoon Qnty </td>

						<td align='right' valign='top' style='border: 1px dotted #000'>Basta Qnty  </td>
						
						<td align='right' valign='top' style='border: 1px dotted #000'>Drum Unit</td>
						
						<td align='right' valign='top' style='border: 1px dotted #000'>Cartoon Unit</td>
						
						<td align='right' valign='top' style='border: 1px dotted #000'>Basta Unit</td>
						
						<td align='right' valign='top' style='border: 1px dotted #000'>Received KG</td>
						
						<td align='right' valign='top' style='border: 1px dotted #000'>Fare Per KG</td>
						
						<td align='right' valign='top' style='border: 1px dotted #000'>Taka (Fare)</td>
						
					</tr>";

// Query here.
						
							
						$aQuery 	= "SELECT distinct b.PRODUCTID
										FROM fna_bill b, fna_product p
										WHERE p.PRODUCTID = b.PRODUCTID
										AND b.PARTYID = '".$PARTYID."' 
										AND b.PROJECTID = '".$PROJECTID."'
										AND b.SUBPROJECTID = '".$SUBPROJECTID."'
										{$con}
										AND  b.ENTRYDATE between '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."' 
										ORDER BY p.PRODUCTNAME ASC
									";
						$aQueryStatement			= mysql_query($aQuery);
						$sl = 1;
						$BILLAMOUNT = 0;
						$TOTQUANTITY	=0;
						$TOTBILLAMOUNT = 0;
						$glabalToatalBill = 0;
						$RECEIVEAMOUNT = 0;
						$partyBalAmount = 0;
						$globalRecAmount = 0;
						$glabalBill = 0;
						$Global_Balance_Amount = 0;
						$Global_Drum_Qnty	= 0 ; 
						$Global_cortun_Qnty	= 0 ; 
						$Global_Basta_Qnty	= 0 ; 
						$Global_receive_KG	= 0;
						while($aQueryStatementData	= mysql_fetch_array($aQueryStatement)){
							
							// Package Information View Report Start 	 <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<		
							
							
								$CATEGORYTYPENAME 	= '';
								$PRODUCTNAME 	= '';
								$PACKINGUNITID   	= '';
								$QUANTITY 	= '';
								$WTQNTY		= 0;
								$aViewQuery 	= "SELECT 
												  		b.PARTYID,
														b.RECEIVENUMBER,
														cat.CATEGORYTYPENAME,
														pn.PRODUCTNAME,
														punt.PACKINGNAMEID,
														pname.PACKINGNAME,
														b.PRODUCTID,
														b.PACKINGUNITID,
														sum(b.QUANTITY) as QUANTITY,
														sum(b.TOTQUANTITY) as TOTQUANTITY,
														sum(b.BILLAMOUNT) as BILLAMOUNT,
														sum(b.TOTBILLAMOUNT) as TOTBILLAMOUNT,
														sum(b.WTQNTY) as WTQNTY
												FROM 
													fna_bill b, fna_productcattype cat, fna_product pn, fna_packingunit punt, fna_packingname pname
												WHERE b.PARTYID = '".$PARTYID."'
												AND b.PROJECTID = '".$PROJECTID."'
												AND b.SUBPROJECTID = '".$SUBPROJECTID."'
												AND cat.PRODCATTYPEID = b.PRODCATTYPEID
												{$con}
												AND pn.PRODUCTID = b.PRODUCTID
												AND b.PRODUCTID = '".$aQueryStatementData['PRODUCTID']."'
												AND b.PACKINGUNITID = punt.PACKINGUNITID
												AND pname.PACKINGNAMEID = punt.PACKINGNAMEID
												AND b.ENTRYDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
												ORDER BY b.PRODUCTID ASC
											";
								$aViewStatement			= mysql_query($aViewQuery);
								while($aViewStatementData	= mysql_fetch_array($aViewStatement)){ 
								
								 $PARTYID        		= $aViewStatementData["PARTYID"]; 
								 $RECEIVENUMBER        	= $aViewStatementData["RECEIVENUMBER"];
								 $CATEGORYTYPENAME      = $aViewStatementData["CATEGORYTYPENAME"]; 
								 $PRODUCTNAME      		= $aViewStatementData["PRODUCTNAME"];
								 $PACKINGNAME      		= $aViewStatementData["PACKINGNAME"];
								 $PRODUCTID       		= $aViewStatementData["PRODUCTID"]; 
								 $PACKINGUNITID       	= $aViewStatementData["PACKINGUNITID"]; 	
								 $QUANTITY         		= $aViewStatementData["QUANTITY"];
								 $TOTQUANTITY       	= $aViewStatementData["TOTQUANTITY"]; 
								 $BILLAMOUNT       		= $aViewStatementData["BILLAMOUNT"]; 	
								 $TOTBILLAMOUNT         = $aViewStatementData["TOTBILLAMOUNT"];
								 $WTQNTY		        = $aViewStatementData["WTQNTY"];
								
							// Package Information View Report End
							}
							$glabalToatalBill 	= $glabalToatalBill + $TOTBILLAMOUNT ;
							$glabalBill 		= $glabalBill + $BILLAMOUNT ;
							$Global_receive_KG	= $Global_receive_KG +  $WTQNTY ; 
							
							
											
							

							//-----------------------------------------------------------------
							
							if($SUBPROJECTID == '1' or $SUBPROJECTID == '3')
							{
								 $prodFare = "
														SELECT
																PRODUCTID,
																UNITFARE
														FROM
																fna_productfare 
														WHERE PRODUCTID = '".$PRODUCTID."'
														AND PACKINGUNITID = '".$PACKINGUNITID."'
													";
									$prodFareQueryStatement				= mysql_query($prodFare);
										while($prodFareQueryStatementData	= mysql_fetch_array($prodFareQueryStatement)) {
											$UNITFARE   		= $prodFareQueryStatementData["UNITFARE"];	
										}
										
									
							}else{
								$prodFare = "
													SELECT
															PRODUCTID,
															UNITFARE
													FROM
															fna_productfare 
													WHERE PRODUCTID = '".$PRODUCTID."'
													
												";
									$prodFareQueryStatement				= mysql_query($prodFare);
										while($prodFareQueryStatementData	= mysql_fetch_array($prodFareQueryStatement)) {
											$UNITFARE   		= $prodFareQueryStatementData["UNITFARE"];	
										}	
							}
								
								/*
								$packName = "
										SELECT
												PRODUCTID,
												UNITFARE
										FROM
												fna_productfare 
										WHERE PRODUCTID = $PRODUCTID
									";
							$packNameQueryStatement				= mysql_query($packName);
								while($packNameQueryStatementData	= mysql_fetch_array($packNameQueryStatement)) {
									$UNITFARE   		= $packNameQueryStatementData["UNITFARE"];	
								}*/
							if($QUANTITY > 0){	
							$packingNameVal 	= '';
							$packingViewQuery 	= "
													SELECT
															pu.PACKINGUNITID,
															pn.PACKINGNAME,
															q.QVALUE,
															w.WNAME
													FROM
															fna_packingunit pu , fna_packingname pn, fna_quantity q, fna_weight w
													WHERE pu.PACKINGUNITID = $PACKINGUNITID
													AND pu.PACKINGNAMEID = pn.PACKINGNAMEID
													AND pu.QID = q.QID
													AND pu.WTID = w.WTID
													ORDER BY PACKINGUNITID	ASC
												";
												
							$sv		= 1;
							$packingViewQueryStatement				= mysql_query($packingViewQuery);
							while($packingViewQueryStatementData	= mysql_fetch_array($packingViewQueryStatement)) {
								if($sv%2==0) {
									$class	= "evenRow";
								} else {
									$class	= "oddRow";
								}
								
								$PACKINGUNITID   		= $packingViewQueryStatementData["PACKINGUNITID"];
								$PACKINGNAME   			= $packingViewQueryStatementData["PACKINGNAME"];
								$QVALUE			   		= $packingViewQueryStatementData["QVALUE"];
								$WNAME			   		= $packingViewQueryStatementData["WNAME"];
								
								$Basta_QUANTITY= '';
								$Drum_QUANTITY= '';
								$cortun_QUANTITY= '';
								$Basta_QVALUE = '';
								$Drum_QVALUE = '';
								$Cartoon_QVALUE = '';
								$Avg_Basta_Unit		=	0;
								
								
									
								if ($PACKINGNAME == 'Basta')
								{
									$Basta_QUANTITY= $QUANTITY;
									$Drum_QUANTITY= '';
									$cortun_QUANTITY= '';
									$Basta_QVALUE = $QVALUE;
									$Drum_QVALUE = '';
									$Cartoon_QVALUE = '';
									$Avg_Basta_Unit		= $WTQNTY / $Basta_QUANTITY ;
									
								}elseif($PACKINGNAME == 'Drum')
								{	
									$Basta_QUANTITY= '';
									$Drum_QUANTITY= $QUANTITY;
									$cortun_QUANTITY= '';
									$Basta_QVALUE = '';
									$Drum_QVALUE = $QVALUE;
									$Cartoon_QVALUE = '';
									$Avg_Basta_Unit		= $WTQNTY / $Drum_QUANTITY ;
								}else
								{
									$Basta_QUANTITY= '';
									$Drum_QUANTITY= '';
									$cortun_QUANTITY= $QUANTITY;
									$Basta_QVALUE = '';
									$Drum_QVALUE = '';
									$Cartoon_QVALUE = $QVALUE;
									$Avg_Basta_Unit		= $WTQNTY / $cortun_QUANTITY ;
								}
								
							}
							
							//$systemParametersBody = str_replace('<!--%[PACKING_NAME]%-->',$packingNameVal,$systemParametersBody);
							$globalRecAmount 	= $globalRecAmount + $RECEIVEAMOUNT ; 
							$partyBalAmount 	= $glabalBill - $RECEIVEAMOUNT ; 	
							//$TOTALQUANTITY 		= $QVALUE * $QUANTITY ;
							
							$Global_Drum_Qnty	= $Global_Drum_Qnty + $Drum_QUANTITY ; 
							$Global_cortun_Qnty	= $Global_cortun_Qnty + $cortun_QUANTITY ; 
							$Global_Basta_Qnty	= $Global_Basta_Qnty + $Basta_QUANTITY ; 
							 
							//-----------------------------------------------------------------
						//if($Basta_QUANTITY != '' and $Drum_QUANTITY != '' and $cortun_QUANTITY != ''){
 // Dynamic Row Start

						$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000'>$sl</td>

											<td align='left' valign='top' style='border: 1px dotted #000'> $CATEGORYTYPENAME</td>
					
											<td align='left' valign='top'  style='border: 1px dotted #000'>$PRODUCTNAME</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'> $Drum_QUANTITY</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>$cortun_QUANTITY</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>$Basta_QUANTITY</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>$Drum_QVALUE </td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>$Cartoon_QVALUE </td>

											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Avg_Basta_Unit,2)."</td>
					
											<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($WTQNTY,2)."</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($UNITFARE,2)."</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($BILLAMOUNT,2)."</td>
					
											
										</tr>

									 ";
			
								// Dynamic Row End		  
						}
					
				$sl++;
				}

					$tableView .="

						<tr style='font-weight:bold;'>

							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='right' valign='top'  style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>$Global_Drum_Qnty</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>$Global_cortun_Qnty</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>$Global_Basta_Qnty</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='right' valign='top'  style='border: 1px dotted #000'>&nbsp;</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_receive_KG,2)."</td>

							<td align='right' valign='top' style='border: 1px dotted #000' bgcolor='#CCCCCC'>Total Bill :</td>

							<td align='right' valign='top' style='border: 1px dotted #000' bgcolor='#CCCCCC'>".number_format($glabalBill,2)."</td>

						</tr>
						
						<tr>

							<td colspan='12' align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

						</tr>";
						
						$tableViewReceive = "";
						$tableViewReceive .="<table width='80%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:85%; border: 1px dotted #000'>
												<tr style='font-weight:bold;'>
				
													<td align='center' valign='top' style='font-weight:bold;border: 1px dotted #000'>SL No.</td>
							
													<td align='center' valign='top'  style='border: 1px dotted #000'>Receive Date</td>
							
													<td align='center' valign='top' style='border: 1px dotted #000'>Category </td>
													
													<td align='center' valign='top' style='border: 1px dotted #000'>Bill Year</td>
							
													<td align='center' valign='top' style='border: 1px dotted #000'>Bank Name</td>
							
													<td align='center' valign='top' style='border: 1px dotted #000'>Cheque No.</td>
													
													<td align='center' valign='top' style='border: 1px dotted #000'>Cheque Date</td>
													
													<td align='center' valign='top' style='border: 1px dotted #000'>Receive Amount</td>
							
																
												</tr>";
						
						$partyReceiveAmount = "
														SELECT
																b.RECEIVEAMOUNT,
																b.ENTRYDATE,
																b.BANKNAME,
																b.CHEQUENUMBER,
																b.CHEQUEDATE,
																b.PRODCATTYPEID,
																b.BILLYEAR
														FROM
																fna_partybill b
														WHERE b.PARTYID = '".$PARTYID."'
														{$con}
														AND b.ENTRYDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."' 
														ORDER BY b.ENTRYDATE ASC
													";
							$partyReceiveAmountQueryStatement				= mysql_query($partyReceiveAmount);
							
								$RECEIVE_RECEIVEAMOUNT 	= '';
								$RECEIVE_ENTRYDATE 		= '';
								$BANKNAME 				= '';
								$CHEQUENUMBER 			= '';
								$CHEQUEDATE 			= '';
								$RECEIVE_PRODCATTYPEID 	= '';
								$slNo = 1;
								$Gloabal_Receive_Amount	= 0;
								while($partyReceiveAmountQueryStatementData	= mysql_fetch_array($partyReceiveAmountQueryStatement)) {
									$RECEIVE_RECEIVEAMOUNT 					= $partyReceiveAmountQueryStatementData["RECEIVEAMOUNT"];
									$RECEIVE_ENTRYDATE 						= $partyReceiveAmountQueryStatementData["ENTRYDATE"];
									$BANKNAME	 							= $partyReceiveAmountQueryStatementData["BANKNAME"];
									$CHEQUENUMBER 							= $partyReceiveAmountQueryStatementData["CHEQUENUMBER"];
									$CHEQUEDATE 							= $partyReceiveAmountQueryStatementData["CHEQUEDATE"];
									$RECEIVE_PRODCATTYPEID 					= $partyReceiveAmountQueryStatementData["PRODCATTYPEID"];
									$BILLYEAR			 					= $partyReceiveAmountQueryStatementData["BILLYEAR"];
									
									
									
								$ProductCatNameQry = "
														SELECT
																CATEGORYTYPENAME
														FROM
																fna_productcattype
														WHERE PRODCATTYPEID = '".$RECEIVE_PRODCATTYPEID."'
														ORDER BY PRODCATTYPEID ASC
													";
								$ProductCatNameQryStatement					= mysql_query($ProductCatNameQry);
								$RECEIVE_CATEGORYTYPENAME = '';
								while($ProductCatNameQryStatementData		= mysql_fetch_array($ProductCatNameQryStatement)) {
									$RECEIVE_CATEGORYTYPENAME				= $ProductCatNameQryStatementData["CATEGORYTYPENAME"];
									
								}
								
								if($RECEIVE_RECEIVEAMOUNT > 0){
								$Gloabal_Receive_Amount	= $Gloabal_Receive_Amount + $RECEIVE_RECEIVEAMOUNT ;
								$tableViewReceive .=" <tr>
						
															<td align='center' valign='top' style='border: 1px dotted #000'>$slNo</td>
			
															<td align='right' valign='top' style='border: 1px dotted #000'>$RECEIVE_ENTRYDATE </td>
															
															<td align='right' valign='top' style='border: 1px dotted #000'>$RECEIVE_CATEGORYTYPENAME </td>
															
															<td align='right' valign='top' style='border: 1px dotted #000'>$BILLYEAR </td>
				
															<td align='right' valign='top' style='border: 1px dotted #000'> $BANKNAME </td>
									
															<td align='right' valign='top'  style='border: 1px dotted #000'>$CHEQUENUMBER</td>
									
															<td align='right' valign='top' style='border: 1px dotted #000'>$CHEQUEDATE</td>
									
															<td align='right' valign='top' style='border: 1px dotted #000' >".number_format($RECEIVE_RECEIVEAMOUNT,2)."</td>
											
																				
														</tr> ";

								// Dynamic Row End	
								}

					
							$slNo++;
				
								
						}	
						$tableViewReceive .="
							
							<tr >

								<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
	
								<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
								
								<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
								
								<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
								
								<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
	
								<td align='left' valign='top'  style='border: 1px dotted #000'>&nbsp;</td>
	
								<td align='right' valign='top' style='border: 1px dotted #000' bgcolor='#CCCCCC'>Total Bill :</td>
	
								<td align='right' valign='top' style='border: 1px dotted #000' bgcolor='#CCCCCC'>".number_format($Gloabal_Receive_Amount,2)."</td>
	
							</tr>
							<tr>
						
								<td colspan='9' align='center' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							</tr>
						</table>";
							
						$Global_Balance_Amount	= $glabalBill - $Gloabal_Receive_Amount ;
						
						
						$tableViewFooter ="";
						$tableViewFooter .="<table width='80%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:85%; border: 1px dotted #000'>
						<tr>

							<td colspan='12' align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

						</tr>
						<tr>

							<td colspan='12' align='center' valign='top' >
								<table width='50%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:100%;'>
								  <tr>
									<td align='right' width='50%' style='border: 1px dotted #000'>Total Bill Amount</td>
									<td width='2%' style='border: 1px dotted #000'>:</td>
									<td width='48%' style='border: 1px dotted #000'>".number_format($glabalBill,2)."</td>
								  </tr>
								 <tr>
									<td align='right' width='50%' style='border: 1px dotted #000'>Total Bill Receive Amount</td>
									<td width='2%' style='border: 1px dotted #000'>:</td>
									<td width='48%' style='border: 1px dotted #000'>".number_format($Gloabal_Receive_Amount,2)."</td>
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