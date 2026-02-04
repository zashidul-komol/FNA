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
	$ENTRYDATE_FROM 	= showDateMySQlFormat($_REQUEST['ENTRYDATE']);
	$ENTRYDATE_TO 		= showDateMySQlFormat($_REQUEST['ENTRYDATE2']);
	$userId 			= $_REQUEST['userId'];
	
		//Ministry/Division and Project/Programme Name View Report Start				
	 	$ProjSql 	= "
							SELECT p.PROJECTID, p.PROJECTNAME											
							FROM fna_project p
							WHERE p.PROJECTID = $PROJECTID
						";
			$ProjSqlStatement				= mysql_query($ProjSql);
			while($ProjSqlStatementData		= mysql_fetch_array($ProjSqlStatement)){
				$PROJECTID_NEW      		= $ProjSqlStatementData["PROJECTID"];
				$PROJECTNAME	       		= $ProjSqlStatementData["PROJECTNAME"];
			}
		
		$subProjSql 	= "
							SELECT sp.SUBPROJECTID, sp.SUBPROJECTNAME											
							FROM fna_subproject sp
							WHERE sp.SUBPROJECTID = $SUBPROJECTID
						";
			$subProjSqlStatement			= mysql_query($subProjSql);
			while($subProjSqlStatementData	= mysql_fetch_array($subProjSqlStatement)){
				$SUBPROJECTID_NEW      		= $subProjSqlStatementData["SUBPROJECTID"];
				$SUBPROJECTNAME       		= $subProjSqlStatementData["SUBPROJECTNAME"];
			}
			
			//Ministry/Division and Project/Programme Name View Report End
			
	$tableView = "";	
	$tableView .="<table width='100%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:85%; border: 1px dotted #000'>

					  <tr>
						<td colspan='13' align='center' valign='middle' style='border: 1px dotted #000'>
							<center><b><font size=5>F N A Group Of Company</font></b></center>
							<center>&nbsp;</center>
							<center><b><font size=2>FNA Bill Sub Project Wise Information</FONT></b></center>
							<center><b><font size=2>Date : $ENTRYDATE_FROM to $ENTRYDATE_TO </font></b></center>
						</td>
					  </tr>
					  <tr>

						<td colspan='13' align='left' valign='top'>
							<table width='100%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:100%;'>
								  <tr>
								
									<td width='14%' align='left' valign='top'>Project  Name<b></td>
									<td width='1%' align='center' valign='top'>:</td>
									<td width='34%' align='left' valign='top'> $PROJECTNAME</td>
									<td width='18%' align='right' valign='top'>&nbsp;</td>
									<td width='1%' align='center' valign='top'>&nbsp;</td>
									<td width='20%' align='left' valign='top'>&nbsp;</td>
									<td align='left' valign='top'>&nbsp;</td>
								
								  </tr>
								
								  
								  <tr>
								
									<td align='left' valign='top'>Sub Project Name</td>
									<td align='center' valign='top'>:</td>
								
									<td align='left' valign='top'>$SUBPROJECTNAME </td>
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

						<td align='left' valign='top' style='font-weight:bold;border: 1px dotted #000'>SL No.</td>

						<td align='left' valign='top'  style='border: 1px dotted #000'>Product Category</td>

						<td align='left' valign='top' style='border: 1px dotted #000'>Product name </td>

						<td align='right' valign='top' style='border: 1px dotted #000'>Drum Qnty</td>

						<td align='right' valign='top' style='border: 1px dotted #000'>Cartoon Qnty </td>

						<td align='right' valign='top' style='border: 1px dotted #000'>Basta Qnty  </td>
						
						<td align='right' valign='top' style='border: 1px dotted #000'>Drum Unit</td>
						
						<td align='right' valign='top' style='border: 1px dotted #000'>Cartoon Unit</td>
						
						<td align='right' valign='top' style='border: 1px dotted #000'>Basta Unit</td>
						
						<td align='right' valign='top' style='border: 1px dotted #000'>Received Qnty</td>
						
						<td align='right' valign='top' style='border: 1px dotted #000'>Unit Fare</td>
						
						<td align='right' valign='top' style='border: 1px dotted #000'>Taka (Fare)</td>
						
						<td align='right' valign='top' style='border: 1px dotted #000'>Total Taka</td>

					  </tr>";

// Query here.


						$aQuery 	= "SELECT distinct b.PRODUCTID
										FROM fna_bill b
										WHERE b.PROJECTID = '".$PROJECTID."'
										AND b.SUBPROJECTID = '".$SUBPROJECTID."'
										AND  b.ENTDATE between '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."' 
										ORDER BY b.PRODUCTID ASC
									";
						$aQueryStatement			= mysql_query($aQuery);
						$sl = 1;
						$BILLAMOUNT = 0;
						$TOTBILLAMOUNT = 0;
						$glabalToatalBill = 0;
						$RECEIVEAMOUNT = 0;
						$partyBalAmount = 0;
						$globalRecAmount = 0;
						while($aQueryStatementData	= mysql_fetch_array($aQueryStatement)){
							
							// Package Information View Report Start 	 <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<		
								$CATEGORYTYPENAME 	= '';
								$PRODUCTNAME 	= '';
								$PACKINGUNITID   	= '';
								$QUANTITY 	= '';
								$aViewQuery 	= "SELECT 
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
														sum(b.TOTBILLAMOUNT) as TOTBILLAMOUNT
												FROM 
													fna_bill b, fna_productcattype cat, fna_product pn, fna_packingunit punt, fna_packingname pname
												WHERE b.PROJECTID = '".$PROJECTID."'
												AND b.SUBPROJECTID = '".$SUBPROJECTID."'
												AND cat.PRODCATTYPEID = b.PRODCATTYPEID
												AND pn.PRODUCTID = b.PRODUCTID
												AND b.PRODUCTID = '".$aQueryStatementData['PRODUCTID']."'
												AND b.PACKINGUNITID = punt.PACKINGUNITID
												AND pname.PACKINGNAMEID = punt.PACKINGNAMEID
												AND b.ENTDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
												ORDER BY b.PRODUCTID ASC
											";
								$aViewStatement			= mysql_query($aViewQuery);
								while($aViewStatementData	= mysql_fetch_array($aViewStatement)){ 
								
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
								
							// Package Information View Report End
							
							$glabalToatalBill = $glabalToatalBill + $TOTBILLAMOUNT ;
							
							
							//-----------------------------------------------------------------
							
							$prodFare = "
										SELECT
												PRODUCTID,
												UNITFARE
										FROM
												fna_productfare 
										WHERE PRODUCTID = $PRODUCTID
									";
							$prodFareQueryStatement				= mysql_query($prodFare);
								while($prodFareQueryStatementData	= mysql_fetch_array($prodFareQueryStatement)) {
									$UNITFARE   		= $prodFareQueryStatementData["UNITFARE"];	
								}
								
								$partyReceiveAmount = "
														SELECT
																PROJECTID,
																SUBPROJECTID,
																RECEIVEAMOUNT
														FROM
																fna_partybill 
														WHERE SUBPROJECTID = $SUBPROJECTID
													";
							$partyReceiveAmountQueryStatement				= mysql_query($partyReceiveAmount);
								while($partyReceiveAmountQueryStatementData	= mysql_fetch_array($partyReceiveAmountQueryStatement)) {
									$RECEIVEAMOUNT 							= $partyReceiveAmountQueryStatementData["RECEIVEAMOUNT"];	
								}
								
								
								$globalRecAmount 	= $globalRecAmount + $RECEIVEAMOUNT ; 
								$partyBalAmount 	= $glabalToatalBill - $globalRecAmount ; 
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
													ORDER BY
															PACKINGUNITID
													ASC
												";
												
							$sv								= 1;
							$packingViewQueryStatement				= mysql_query($packingViewQuery);
							while($packingViewQueryStatementData	= mysql_fetch_array($packingViewQueryStatement)) {
								if($sv%2==0) {
									$class	= "evenRow";
								} else {
									$class	= "oddRow";
								}
								
								$PACKINGUNITID   		= $packingViewQueryStatementData["PACKINGUNITID"];
								$PACKINGNAME   		= $packingViewQueryStatementData["PACKINGNAME"];
								$QVALUE			   		= $packingViewQueryStatementData["QVALUE"];
								$WNAME			   		= $packingViewQueryStatementData["WNAME"];
								
								$Basta_QUANTITY= '';
								$Drum_QUANTITY= '';
								$cortun_QUANTITY= '';
								$Basta_QVALUE = '';
								$Drum_QVALUE = '';
								$Cartoon_QVALUE = '';
								
								
								if ($PACKINGNAME == 'Basta')
								{
									$Basta_QUANTITY= $QUANTITY;
									$Drum_QUANTITY= '';
									$cortun_QUANTITY= '';
									$Basta_QVALUE = $QVALUE;
									$Drum_QVALUE = '';
									$Cartoon_QVALUE = '';
									
								}elseif($PACKINGNAME == 'Drum')
								{	
									$Basta_QUANTITY= '';
									$Drum_QUANTITY= $QUANTITY;
									$cortun_QUANTITY= '';
									$Basta_QVALUE = '';
									$Drum_QVALUE = $QVALUE;
									$Cartoon_QVALUE = '';
								}else
								{
									$Basta_QUANTITY= '';
									$Drum_QUANTITY= '';
									$cortun_QUANTITY= $QUANTITY;
									$Basta_QVALUE = '';
									$Drum_QVALUE = '';
									$Cartoon_QVALUE = $QVALUE;
								}
								
							}
							
							//$systemParametersBody = str_replace('<!--%[PACKING_NAME]%-->',$packingNameVal,$systemParametersBody);
							
							$TOTALQUANTITY = $QVALUE * $QUANTITY ;
							//-----------------------------------------------------------------

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

											<td align='right' valign='top' style='border: 1px dotted #000'> $Basta_QVALUE </td>
					
											<td align='right' valign='top'  style='border: 1px dotted #000'>$TOTQUANTITY</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>$UNITFARE</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($BILLAMOUNT,2)."</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($TOTBILLAMOUNT,2)." </td>
											
										</tr>

									 ";

								// Dynamic Row End		  

					}	
				$sl++;
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

						</tr>
						<tr>

							<td colspan='13' align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

						</tr>
						<tr>

							<td colspan='13' align='center' valign='top' >
								<table width='50%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:100%;'>
								  <tr>
									<td align='right' width='50%' style='border: 1px dotted #000'>Total Bill Amount</td>
									<td width='2%' style='border: 1px dotted #000'>:</td>
									<td width='48%' style='border: 1px dotted #000'>".number_format($glabalToatalBill,2)."</td>
								  </tr>
								  <tr>
									<td align='right' width='50%' style='border: 1px dotted #000'>Total Bill Receive Amount</td>
									<td width='2%' style='border: 1px dotted #000'>:</td>
									<td width='48%' style='border: 1px dotted #000'>".number_format($globalRecAmount,2)."</td>
								  </tr>
								  <tr>
									<td align='right' width='50%' style='border: 1px dotted #000'>Balance Bill Amount</td>
									<td width='2%' style='border: 1px dotted #000'>:</td>
									<td width='48%' style='border: 1px dotted #000'>".number_format($partyBalAmount,2)."</td>
								  </tr>
								</table>
							</td>

						</tr>	
						<tr>

							<td colspan='13' align='left' valign='top'>&nbsp;</td>

						</tr>
						<tr>

							<td colspan='13' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='13' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='13' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='13' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='13' align='left' valign='top' >
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

							<td colspan='13' align='left' valign='top' >&nbsp;</td>

						</tr>
						<tr>

							<td colspan='13' align='left' valign='top' >&nbsp;</td>

						</tr>					

					</table>";
	echo $tableView;

?>