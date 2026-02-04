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
	//$tran	 			= $_REQUEST['all'];
	//echo "<pre>"; print_r($tran);
	$load	 			= $_REQUEST['tranLoad'];
	$unload	 			= $_REQUEST['tranUnload'];
	$transfer 			= $_REQUEST['tranTransfer'];
	$palot	 			= $_REQUEST['tranPalot'];
	$all	 			= $_REQUEST['tranAll'];
	$PC		 			= $_REQUEST['tranPC'];
	$whereQ = '';
	$whereQQ = '';	
	//echo rtrim($whereQ); die();
	//$whereQ = '';
	if($all!=''){
		$whereQ = "AND b.WORKTYPEFLAG IN ('Load','Unload', 'Transfer','Palot', 'PC')"; 
		
		}else{
					if($load != ''){
						$whereQQ .= "'Load',"; 	
					}if($unload != ''){
						$whereQQ .= "'Unload',"; 	
					}if($transfer != ''){
						$whereQQ .= "'Transfer',"; 	
					}if($palot != ''){
						$whereQQ .= "'Palot',"; 	
					}if($PC != ''){
						$whereQQ .= "'PC',"; 	
					}
					
					//echo $whereQQ;
				$exp = explode(",",$whereQQ);
				$count = sizeof($exp);
				
				$c = 1; 
				$count = $count-1;
				foreach($exp as $keyVal){
					if($count == $c){
						$whereQ .= $keyVal;
						break;
					}else{
						$whereQ .= $keyVal.",";
						}
					
					$c++;
				}
		  
		  $whereQ = "AND b.WORKTYPEFLAG IN ($whereQ)"; 
			
		}
	
	$LABOURID 			= $_REQUEST['LABOURID'];
	$PROJECTID 			= $_REQUEST['PROJECTID'];
	$SUBPROJECTID		= $_REQUEST['SUBPROJECTID'];
	$PRODCATTYPEID		= $_REQUEST['PRODCATTYPEID'];
	$ENTRYDATE_FROM 	= showDateMySQlFormat($_REQUEST['ENTRYDATE']);
	$ENTRYDATE_TO 		= showDateMySQlFormat($_REQUEST['ENTRYDATE2']);
	$userId 			= $_REQUEST['userId'];
	
		//Ministry/Division and Project/Programme Name View Report Start				
	 	$labourSql 	= "
							SELECT L.LABOURNAME, L.FATHERNAME, L.ADDRESS, L.MOBILE											
							FROM fna_labour L
							WHERE L.LABOURID = $LABOURID
						";
			$labourSqlStatement				= mysql_query($labourSql);
			while($labourSqlStatementData	= mysql_fetch_array($labourSqlStatement)){
				$LABOURNAME        			= $labourSqlStatementData["LABOURNAME"];
				$FATHERNAME       			= $labourSqlStatementData["FATHERNAME"];
				$ADDRESS       				= $labourSqlStatementData["ADDRESS"];
				$MOBILE       				= $labourSqlStatementData["MOBILE"];
			}
			
			//Ministry/Division and Project/Programme Name View Report End
			
			$SubProjSql 	= "
							SELECT sp.SUBPROJECTNAME											
							FROM fna_subproject sp
							WHERE sp.SUBPROJECTID = $SUBPROJECTID
						";
			$SubProjSqlStatement				= mysql_query($SubProjSql);
			while($SubProjSqlStatementData		= mysql_fetch_array($SubProjSqlStatement)){
				$SUBPROJECTNAME        			= $SubProjSqlStatementData["SUBPROJECTNAME"];
			}
			
			$ProdCatNameSql 	= "
											SELECT pct.CATEGORYTYPENAME											
											FROM fna_productcattype pct
											WHERE pct.PRODCATTYPEID = '".$PRODCATTYPEID."'
										";
					$ProdCatNameSqlStatement				= mysql_query($ProdCatNameSql);
					while($ProdCatNameSqlStatementData		= mysql_fetch_array($ProdCatNameSqlStatement)){
						$PROD_CATEGORYTYPENAME        		= $ProdCatNameSqlStatementData["CATEGORYTYPENAME"];
					}
			
	$tableView = "";	
	$tableView .="<table width='90%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:85%; border: 1px dotted #000'>

					  <tr>
                            <td style='text-align:right;' colspan='13'>
                            <a href='javascript:Clickheretoprint()'><img border='0' src='images/print_icon.jpg' width='40' height='26' /></a>                        
                            </td>
                     </tr>
					  <tr>
						<td colspan='13' align='center' valign='middle' style='border: 1px dotted #000'>
							<center><b><font size=5>F N A Group of Company</font></b></center>
							<center>&nbsp;</center>
							<center><b><font size=4> $SUBPROJECTNAME  --$whereQQ-- Labour Bill </FONT></b></center>
							<center>&nbsp;</center>
							<center><b><font size=2>Date : $ENTRYDATE_FROM to $ENTRYDATE_TO </font></b></center>
						</td>
					  </tr>
					  <tr>

						<td colspan='13' align='left' valign='top'>
							<table width='100%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:100%;'>
								  <tr>
								
									<td width='14%' align='left' valign='top'>Labour Name<b></td>
									<td width='1%' align='center' valign='top'>:</td>
									<td width='34%' align='left' valign='top'> $LABOURNAME</td>
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
								
									<td align='left' valign='top'>Father Name</td>
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
								
									<td align='left' valign='top'>Product Cat Name </td>
									<td align='center' valign='top'>: </td>
								
									<td align='left' valign='top'><font size='4'>$PROD_CATEGORYTYPENAME </font></td>
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

						<td align='left' valign='top'  style='border: 1px dotted #000'>Date</td>

						<td align='left' valign='top' style='border: 1px dotted #000'>Product name </td>

						<td align='right' valign='top' style='border: 1px dotted #000'>Drum Qnty</td>

						<td align='right' valign='top' style='border: 1px dotted #000'>Cartoon Qnty </td>

						<td align='right' valign='top' style='border: 1px dotted #000'>Basta Qnty  </td>
						
						<td align='right' valign='top' style='border: 1px dotted #000'>Drum Unit</td>
						
						<td align='right' valign='top' style='border: 1px dotted #000'>Cartoon Unit</td>
						
						<td align='right' valign='top' style='border: 1px dotted #000'>Basta Unit</td>
						
						<td align='right' valign='top' style='border: 1px dotted #000'>Unit Fare</td>
						
						<td align='right' valign='top' style='border: 1px dotted #000'>Total Taka</td>

					  </tr>";

// Query here.


						$aQuery 	= "SELECT distinct b.PRODUCTID 
										FROM fna_labourworkhistory b 
										WHERE b.LABOURID = '".$LABOURID."' 
										{$whereQ}
										AND  b.ENTDATE between '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."' 
										ORDER BY b.PRODUCTID ASC
									";
						$aQueryStatement			= mysql_query($aQuery);
						$sl = 1;
						$glabalToatalBill = 0;
						$glabalToatalBastaQnty = 0;
						$glabalToatalCartoonQnty = 0;
						$glabalToatalDrumQnty = 0;
						$labourBalAmount = 0;
						$PAYMENTAMOUNT =0;
						$partyBalAmount =0;
						while($aQueryStatementData	= mysql_fetch_array($aQueryStatement)){
							
							// Package Information View Report Start 	 <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<		
								$CATEGORYTYPENAME 	= '';
								$PRODUCTNAME 	= '';
								$PACKINGUNITID   	= '';
								$QUANTITY 	= '';
								$aViewQuery 	= "SELECT 
												  		b.LABOURID,
														cat.CATEGORYTYPENAME,
														pn.PRODUCTNAME,
														punt.PACKINGNAMEID,
														pname.PACKINGNAME,
														b.PRODUCTID,
														b.PACKINGUNITID,
														b.QUANTITY ,
														b.BILLAMOUNT,
														b.TOTBILLAMOUNT,
														b.PRODCATTYPEID,
														plul.ENTRYDATE
												FROM 
													fna_labourworkhistory b, fna_productloadunload plul, fna_productloadunloadbkdn bkdn, fna_productcattype cat, fna_product pn, fna_packingunit punt, fna_packingname pname
												WHERE b.LABOURID = '".$LABOURID."'
												AND b.PRODCATTYPEID = '".$PRODCATTYPEID."'
												{$whereQ}
												AND plul.PRODUCTLOADUNLOADID = bkdn.PRODUCTLOADUNLOADID
												AND bkdn.PRODUCTLOADUNLOADBKDNID = b.PRODUCTLOADUNLOADBKDNID
												AND cat.PRODCATTYPEID = b.PRODCATTYPEID
												AND pn.PRODUCTID = b.PRODUCTID
												AND b.PRODUCTID = '".$aQueryStatementData['PRODUCTID']."'
												AND b.PACKINGUNITID = punt.PACKINGUNITID
												AND pname.PACKINGNAMEID = punt.PACKINGNAMEID
												AND plul.ENTRYDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
												ORDER BY b.PRODUCTID, plul.ENTRYDATE ASC
											";
								$aViewStatement			= mysql_query($aViewQuery);
								while($aViewStatementData	= mysql_fetch_array($aViewStatement)){ 
								
								 $LABOURID        		= $aViewStatementData["LABOURID"]; 
								 $CATEGORYTYPENAME      = $aViewStatementData["CATEGORYTYPENAME"]; 
								 $PRODUCTNAME      		= $aViewStatementData["PRODUCTNAME"];
								 $PACKINGNAME      		= $aViewStatementData["PACKINGNAME"];
								 $PRODUCTID       		= $aViewStatementData["PRODUCTID"]; 
								 $PACKINGUNITID       	= $aViewStatementData["PACKINGUNITID"]; 	
								 $QUANTITY         		= $aViewStatementData["QUANTITY"];
								 $BILLAMOUNT       		= $aViewStatementData["BILLAMOUNT"]; 	
								 $TOTBILLAMOUNT         = $aViewStatementData["TOTBILLAMOUNT"];
								 $PRODCATTYPEID         = $aViewStatementData["PRODCATTYPEID"];
								 $ENTRYDATE_NEW         = $aViewStatementData["ENTRYDATE"];
								
							// Package Information View Report End
							
							$glabalToatalBill = $glabalToatalBill + $TOTBILLAMOUNT ;
							
							//echo  'komol';
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
								
								$labourPaymntAmount = "
														SELECT
																b.LABOURID,
																SUM(b.PAYMENTAMOUNT) PAYMENTAMOUNT
														FROM
																fna_labourbill b
														WHERE b.LABOURID = $LABOURID
														AND b.PROJECTID = '".$PROJECTID."'
														AND b.SUBPROJECTID = '".$SUBPROJECTID."'
														AND b.PRODCATTYPEID = '".$PRODCATTYPEID."'
														{$whereQ}
														AND b.ENTRYDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
														
													";
							$labourPaymntAmountQueryStatement				= mysql_query($labourPaymntAmount);
								while($labourPaymntAmountQueryStatementData	= mysql_fetch_array($labourPaymntAmountQueryStatement)) {
									$PAYMENTAMOUNT						= $labourPaymntAmountQueryStatementData["PAYMENTAMOUNT"];	
								}
								
								$labourBalAmount = $glabalToatalBill - $PAYMENTAMOUNT ; 
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
												
							$sv	= 1;
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
							$glabalToatalBastaQnty = $glabalToatalBastaQnty + $Basta_QUANTITY ; 
							$glabalToatalCartoonQnty = $glabalToatalCartoonQnty + $cortun_QUANTITY ;
							$glabalToatalDrumQnty = $glabalToatalDrumQnty +  $Drum_QUANTITY ; 
							//$systemParametersBody = str_replace('<!--%[PACKING_NAME]%-->',$packingNameVal,$systemParametersBody);
							
							$TOTALQUANTITY = $QVALUE * $QUANTITY ;
							//-----------------------------------------------------------------

 // Dynamic Row Start

						$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000'>$sl</td>

											<td align='left' valign='top' style='border: 1px dotted #000'> $ENTRYDATE_NEW</td>
					
											<td align='left' valign='top'  style='border: 1px dotted #000'>$PRODUCTNAME</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'> $Drum_QUANTITY</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>$cortun_QUANTITY</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>$Basta_QUANTITY</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>$Drum_QVALUE </td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>$Cartoon_QVALUE </td>

											<td align='right' valign='top' style='border: 1px dotted #000'> $Basta_QVALUE </td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>$BILLAMOUNT </td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($TOTBILLAMOUNT,2)." </td>
											
										</tr>

									 ";

								// Dynamic Row End		  
					$sl++;
					}	
				
				}
				

					$tableView .="
					
						<tr>

							<td colspan='11' align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

						</tr>

						<tr style='font-weight:bold;'>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top'  style='border: 1px dotted #000'>&nbsp;</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>Total:</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>$glabalToatalDrumQnty</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>$glabalToatalCartoonQnty</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>$glabalToatalBastaQnty</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='right' valign='top'  style='border: 1px dotted #000'>&nbsp;</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($glabalToatalBill,2)."</td>

						</tr>
						<tr>

							<td colspan='11' align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

						</tr>
						<tr style='font-weight:bold;'>

							<td colspan='11' align='center' valign='top' >
								<table width='50%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:100%;'>
								  <tr>
									<td align='right' width='50%' style='border: 1px dotted #000'>Total Bill Amount</td>
									<td width='2%' style='border: 1px dotted #000'>:</td>
									<td width='48%' style='border: 1px dotted #000'>".number_format($glabalToatalBill,2)."</td>
								  </tr>
								  <tr>
									<td align='right' width='50%' style='border: 1px dotted #000'>Total Bill Payment Amount</td>
									<td width='2%' style='border: 1px dotted #000'>:</td>
									<td width='48%' style='border: 1px dotted #000'>".number_format($PAYMENTAMOUNT,2)."</td>
								  </tr>
								  <tr>
									<td align='right' width='50%' style='border: 1px dotted #000'>Balance Bill Amount</td>
									<td width='2%' style='border: 1px dotted #000'>:</td>
									<td width='48%' style='border: 1px dotted #000'>".number_format($labourBalAmount,2)."</td>
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