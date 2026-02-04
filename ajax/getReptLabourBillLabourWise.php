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
	$LABOURID_FORM 			= $_REQUEST['LABOURID'];
	$PARTYID_FORM 			= $_REQUEST['PARTYID'];
	$LOADTYPE				= $_REQUEST['LOADTYPE'];
	$PRODCATTYPEID_FORM		= $_REQUEST['PRODCATTYPEID'];
	$ENTRYDATE_FROM 		= showDateMySQlFormat($_REQUEST['ENTRYDATE']);
	$ENTRYDATE_TO 			= showDateMySQlFormat($_REQUEST['ENTRYDATE2']);
	$userId 				= $_REQUEST['userId'];
	
	
	if ($PRODCATTYPEID_FORM == 'All'){
		$con = '';
	}else{
		$con = "AND b.PRODCATTYPEID = '".$PRODCATTYPEID_FORM."' ";
	}
	
	
	
		//Ministry/Division and Project/Programme Name View Report Start				
	 	$labourSql 	= "
							SELECT L.LABOURNAME, L.FATHERNAME, L.ADDRESS, L.MOBILE											
							FROM fna_labour L
							WHERE L.LABOURID = '".$LABOURID_FORM."'
						";
			$labourSqlStatement				= mysql_query($labourSql);
			while($labourSqlStatementData	= mysql_fetch_array($labourSqlStatement)){
				$LABOURNAME        			= $labourSqlStatementData["LABOURNAME"];
				$FATHERNAME       			= $labourSqlStatementData["FATHERNAME"];
				$ADDRESS       				= $labourSqlStatementData["ADDRESS"];
				$MOBILE       				= $labourSqlStatementData["MOBILE"];
			}
			
			$PartySql 	= "
							SELECT PARTYNAME, FATHERNAME, ADDRESS, MOBILE											
							FROM fna_party
							WHERE PARTYID = '".$PARTYID_FORM."'
						";
			$PartySqlStatement				= mysql_query($PartySql);
			while($PartySqlStatementData	= mysql_fetch_array($PartySqlStatement)){
				$PARTYNAME_PARTY  			= $PartySqlStatementData["PARTYNAME"];
				$FATHERNAME_PARTY  			= $PartySqlStatementData["FATHERNAME"];
				$ADDRESS_PARTY 				= $PartySqlStatementData["ADDRESS"];
				$MOBILE_PARTY  				= $PartySqlStatementData["MOBILE"];
			}
			
			$CatTypeNameQry = "
												SELECT
														CATEGORYTYPENAME
												FROM
														fna_productcattype 
												WHERE PRODCATTYPEID = '".$PRODCATTYPEID_FORM."'
											";
							$CatTypeNameQryStatement					= mysql_query($CatTypeNameQry);
								while($CatTypeNameQryStatementData		= mysql_fetch_array($CatTypeNameQryStatement)) {
									$CATEGORYTYPENAME					= $CatTypeNameQryStatementData["CATEGORYTYPENAME"];	
								}
			
			//Ministry/Division and Project/Programme Name View Report End
			
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
							<center><b><font size=4> Party Wise -- Labour Bill </FONT></b></center>
							<center>&nbsp;</center>
							<center><b><font size=2>Date : ".$_REQUEST['ENTRYDATE']." to ".$_REQUEST['ENTRYDATE2']." </font></b></center>
						</td>
					  </tr>
					  <tr>

						<td colspan='13' align='left' valign='top'>
							<table width='100%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:100%;'>
								  <tr>
								
									<td width='14%' align='left' valign='top'>Labour Name<b></td>
									<td width='1%' align='center' valign='top'>:</td>
									<td width='34%' align='left' valign='top'> $LABOURNAME</td>
									<td width='18%' align='right' valign='top'>Party Name</td>
									<td width='1%' align='center' valign='top'>:</td>
									<td width='20%' align='left' valign='top'>$PARTYNAME_PARTY</td>
									<td align='left' valign='top'>&nbsp;</td>
								
								  </tr>
								
								  <tr>
								
									<td align='left' valign='top'>Address</td>
									<td align='center' valign='top'>:</td>
								
									<td align='left' valign='top'> $ADDRESS </td>
									<td align='right' valign='top'>Address</td>
									<td align='center' valign='top'>:</td>
									<td align='left' valign='top'>$ADDRESS_PARTY</td>
									<td align='left' valign='top'> &nbsp;</td>
								
								  </tr>
								
								  <tr>
								
									<td align='left' valign='top'>Father Name</td>
									<td align='center' valign='top'>:</td>
								
									<td align='left' valign='top'>$FATHERNAME </td>
									<td align='right' valign='top'>Father Name</td>
									<td align='center' valign='top'>:</td>
									<td align='left' valign='top'>$FATHERNAME_PARTY</td>
									<td align='left' valign='top'>&nbsp;</td>
								
								  </tr>
								
								  <tr>
								
									<td align='left' valign='top'>Mobile</td>
									<td align='center' valign='top'>:</td>
								
									<td align='left' valign='top'>$MOBILE </td>
									<td align='right' valign='top'>Mobile</td>
									<td align='center' valign='top'>:</td>
									<td align='left' valign='top'>$MOBILE_PARTY</td>
									<td align='left' valign='top'>&nbsp;</td>
								
								  </tr>
								
								  <tr>
								
									<td colspan='7' align='Center' valign='top'><font size=4> Labour Bill :  $CATEGORYTYPENAME  : $LOADTYPE    </font></td>
									
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
						
						<td align='right' valign='top' style='border: 1px dotted #000'>Labour Fare</td>
						
						<td align='right' valign='top' style='border: 1px dotted #000'>Total Taka</td>

					  </tr>";

// Query here.


						/*$aQuery 	= "SELECT distinct b.PRODUCTID 
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
						while($aQueryStatementData	= mysql_fetch_array($aQueryStatement)){*/
						
						$PROD_ARRAY		  	= array();
						$ProdQuery	 		= "SELECT PRODUCTID
												FROM fna_product  
												WHERE PRODCATTYPEID = '".$PRODCATTYPEID_FORM."'
											"; 
						$ProdQueryStatement					= mysql_query($ProdQuery);
						$i = 0;
						while($ProdQueryStatementData		= mysql_fetch_array($ProdQueryStatement)){	
							$PRODUCTID_ARRAY[]				= $ProdQueryStatementData['PRODUCTID'];
							$i++;
						}
						$SL = 1;
						//$glabalToatalBill			= 0;
						$glabalToatalBastaQnty 		= 0 ; 
						$glabalToatalCartoonQnty 	= 0 ;
						$glabalToatalDrumQnty 		= 0 ; 
						$QUANTITY					= 0;
						$Global_TotalBillAmount 	= 0;
			
						
						$PRODUCTID_ARRAY_UNIQUE 		= array_unique($PRODUCTID_ARRAY) ;
						foreach($PRODUCTID_ARRAY_UNIQUE as $individualProduct){
							
							// Package Information View Report Start 	 <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<		
								$CATEGORYTYPENAME 	= '';
								$PRODUCTNAME 	= '';
								$PACKINGUNITID   	= '';
								$QUANTITY 	= '';
								$glabalToatalBill	=0;
								
								/*echo "SELECT 
												  		b.LABOURID,
														b.PRODUCTID,
														b.PACKINGUNITID,
														SUM(b.QUANTITY) QUANTITY,
														b.BILLAMOUNT,
														SUM(b.TOTBILLAMOUNT) TOTBILLAMOUNT,
														b.PRODCATTYPEID,
														plu.ENTRYDATE
												FROM 
													fna_labourworkhistory b, fna_productloadunload plu, fna_productloadunloadbkdn bkdn
												WHERE b.LABOURID = '".$LABOURID_FORM."'
												AND plu.PRODUCTLOADUNLOADID = bkdn.PRODUCTLOADUNLOADID
												AND bkdn.PRODUCTLOADUNLOADBKDNID = b.PRODUCTLOADUNLOADBKDNID
												AND b.WORKTYPEFLAG = '".$LOADTYPE."'
												AND b.PRODUCTID = '".$individualProduct."'
												AND plu.ENTRYDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
												ORDER BY b.PRODUCTID ASC
											"; */
								
								
								
								$aViewQuery 	= "SELECT 
												  		b.LABOURID,
														b.PRODUCTID,
														b.PACKINGUNITID,
														SUM(b.QUANTITY) QUANTITY,
														b.BILLAMOUNT,
														SUM(b.TOTBILLAMOUNT) TOTBILLAMOUNT,
														b.PRODCATTYPEID,
														plu.ENTRYDATE
												FROM 
													fna_labourworkhistory b, fna_productloadunload plu, fna_productloadunloadbkdn bkdn
												WHERE b.LABOURID = '".$LABOURID_FORM."'
												AND plu.PRODUCTLOADUNLOADID = bkdn.PRODUCTLOADUNLOADID
												AND bkdn.PRODUCTLOADUNLOADBKDNID = b.PRODUCTLOADUNLOADBKDNID
												AND b.WORKTYPEFLAG = '".$LOADTYPE."'
												AND bkdn.PRODCATTYPEID = '".$PRODCATTYPEID_FORM."'
												AND b.PRODUCTID = '".$individualProduct."'
												AND plu.ENTRYDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
												ORDER BY b.PRODUCTID ASC
											";
								$aViewStatement			= mysql_query($aViewQuery);
								$QUANTITY	=0;
								$Basta_QUANTITY= '';
								$Drum_QUANTITY= '';
								$cortun_QUANTITY= '';
								$Basta_QVALUE = '';
								$Drum_QVALUE = '';
								$Cartoon_QVALUE = '';
								$PAYMENTAMOUNT	= 0;
								$labourBalAmount	= 0;
								
								while($aViewStatementData	= mysql_fetch_array($aViewStatement)){ 
								
								 $LABOURID        		= $aViewStatementData["LABOURID"]; 
								 $PRODUCTID       		= $aViewStatementData["PRODUCTID"]; 
								 $PACKINGUNITID       	= $aViewStatementData["PACKINGUNITID"]; 	
								 $QUANTITY         		= $aViewStatementData["QUANTITY"];
								 $BILLAMOUNT       		= $aViewStatementData["BILLAMOUNT"]; 	
								 $TOTBILLAMOUNT         = $aViewStatementData["TOTBILLAMOUNT"];
								 $PRODCATTYPEID         = $aViewStatementData["PRODCATTYPEID"];
								 $ENTRYDATE_PLU         = $aViewStatementData["ENTRYDATE"];
								// $PAYMENTAMOUNT_PLU     = $aViewStatementData["PAYMENTAMOUNT"];
								 
							}	
								 // Package Information View Report End
							
							$Global_TotalBillAmount		= $Global_TotalBillAmount + $TOTBILLAMOUNT ; 
							
							
							
							//echo  'komol'; echo '</br>';
							//-----------------------------------------------------------------
							$prodNameQry = "
												SELECT
														PRODUCTNAME
												FROM
														fna_product 
												WHERE PRODUCTID = '".$individualProduct."'
											";
							$prodNameQryStatement					= mysql_query($prodNameQry);
								while($prodNameQryStatementData		= mysql_fetch_array($prodNameQryStatement)) {
									$PRODUCTNAME   					= $prodNameQryStatementData["PRODUCTNAME"];	
								}
							
							$CatTypeNameQry = "
												SELECT
														CATEGORYTYPENAME
												FROM
														fna_productcattype 
												WHERE PRODCATTYPEID = '".$PRODCATTYPEID_FORM."'
											";
							$CatTypeNameQryStatement					= mysql_query($CatTypeNameQry);
								while($CatTypeNameQryStatementData		= mysql_fetch_array($CatTypeNameQryStatement)) {
									$CATEGORYTYPENAME					= $CatTypeNameQryStatementData["CATEGORYTYPENAME"];	
								}
							
							$prodFare = "
										SELECT
												PRODUCTID,
												UNITFARE
										FROM
												fna_productfare 
										WHERE PRODUCTID = '".$individualProduct."'
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
														WHERE b.LABOURID = '".$LABOURID_FORM."'
														AND b.PARTYID = '".$PARTYID_FORM."'
														AND b.PRODCATTYPEID = '".$PRODCATTYPEID_FORM."'
														AND b.WORKTYPEFLAG = '".$LOADTYPE."'
														AND b.ENTRYDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
														
													";
							$labourPaymntAmountQueryStatement				= mysql_query($labourPaymntAmount);
								while($labourPaymntAmountQueryStatementData	= mysql_fetch_array($labourPaymntAmountQueryStatement)) {
									$PAYMENTAMOUNT						= $labourPaymntAmountQueryStatementData["PAYMENTAMOUNT"];	
								}
								
								$labourBalAmount = $Global_TotalBillAmount - $PAYMENTAMOUNT ; 
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
													WHERE pu.PACKINGUNITID = '".$PACKINGUNITID."'
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
								$PACKINGNAME   			= $packingViewQueryStatementData["PACKINGNAME"];
								$QVALUE			   		= $packingViewQueryStatementData["QVALUE"];
								$WNAME			   		= $packingViewQueryStatementData["WNAME"];
								
								
								if($QUANTITY > 0){
								
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
							$glabalToatalBastaQnty 		= $glabalToatalBastaQnty + $Basta_QUANTITY ; 
							$glabalToatalCartoonQnty 	= $glabalToatalCartoonQnty + $cortun_QUANTITY ;
							$glabalToatalDrumQnty 		= $glabalToatalDrumQnty +  $Drum_QUANTITY ; 
							
							//$systemParametersBody = str_replace('<!--%[PACKING_NAME]%-->',$packingNameVal,$systemParametersBody);
							
							$TOTALQUANTITY = $QVALUE * $QUANTITY ;
							//-----------------------------------------------------------------

 // Dynamic Row Start
 						

						$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000'>$SL</td>

											<td align='left' valign='top' style='border: 1px dotted #000'> $CATEGORYTYPENAME</td>
					
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
									 
									 $SL++;
						}
						
								// Dynamic Row End		  
					
					
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

							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_TotalBillAmount,2)."</td>

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
									<td width='48%' style='border: 1px dotted #000'>".number_format($Global_TotalBillAmount,2)."</td>
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