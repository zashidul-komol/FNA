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
	$ENTRYDATE_TO		= showDateMySQlFormat($_REQUEST['ENTRYDATE2']);
	$LOADTYPE	 		= $_REQUEST['LOADTYPE'];
	$userId 			= $_REQUEST['userId'];
	$con = '';
	if ($PRODCATTYPEID == 'All'){
			$con = '';
		}else
		{
			$con = "AND bkdn.PRODCATTYPEID='".$PRODCATTYPEID."' ";
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
							<center><b><font size=4>Load / Unload Report</FONT></b></center>
							<center><b><font size=2>Date : $ENTRYDATE_FROM  To $ENTRYDATE_TO</font></b></center>
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
									<td width='20%' align='right' valign='top'>Product Cat Name</td>
									<td width='1%' align='center' valign='top'>:</td>
									<td align='left' valign='top'>$PROD_CATEGORYTYPENAME</td>
								
								  </tr>
								
								  <tr>
								
									<td align='left' valign='top'>Address</td>
									<td align='center' valign='top'>:</td>
								
									<td align='left' valign='top'> $ADDRESS </td>
									<td align='right' valign='top'>&nbsp;</td>
									<td align='center' valign='top'>&nbsp;</td>
									<td align='right' valign='top'>Load Type</td>
									<td width='1%' align='center' valign='top'>:</td>
									<td align='left' valign='top'> $LOADTYPE</td>
								
								  </tr>
								
								  <tr>
								
									<td align='left' valign='top'>Mobile</td>
									<td align='center' valign='top'>:</td>
								
									<td align='left' valign='top'>$MOBILE </td>
									<td align='right' valign='top'>&nbsp;</td>
									<td align='center' valign='top'>&nbsp;</td>
									<td align='left' valign='top'>&nbsp;</td>
									<td width='1%' align='center' valign='top'>&nbsp;</td>
									<td align='left' valign='top'>&nbsp;</td>
								
								  </tr>
								
								  
								</table>
							

						</td>

					  </tr>

					  <tr style='font-weight:bold;'>

						<td align='left' valign='top' style='font-weight:bold;border: 1px dotted #000'>SL No.</td>

						<td align='left' valign='top' style='border: 1px dotted #000'>Product name </td>

						<td align='right' valign='top' style='border: 1px dotted #000'>Drum Qnty</td>

						<td align='right' valign='top' style='border: 1px dotted #000'>Cartoon Qnty </td>

						<td align='right' valign='top' style='border: 1px dotted #000'>Basta Qnty  </td>
						
						<td align='right' valign='top' style='border: 1px dotted #000'>Drum Unit</td>
						
						<td align='right' valign='top' style='border: 1px dotted #000'>Cartoon Unit</td>
						
						<td align='right' valign='top' style='border: 1px dotted #000'>Basta Unit</td>
						
						<td align='right' valign='top' style='border: 1px dotted #000'>Load KG</td>
						
						<td align='right' valign='top' style='border: 1px dotted #000'>Unload KG</td>
						
						
					</tr>";

// Query here.
						
							
						
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
						$LOADBASTA		='';
								$UNLOADBASTA	='';
								$LOADKG			='';
								$UNLOADKG		='';
								$AVGUNIT		='';
								$WORKTYPEFLAG	='';
								$PRODUCTNAME	='';
								$QUANTITY 		='';
								
							// Package Information View Report Start 	 <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<		
							
							
								$CATEGORYTYPENAME 	= '';
								$PRODUCTNAME 	= '';
								$PACKINGUNITID   	= '';
								$QUANTITY 	= '';
								$WTQNTY		= 0;
								
								$Global_Load_KG		= 0 ; 
								$Global_Unload_KG	= 0 ;
								
								
								$aViewQuery 	= "SELECT 
												  		plu.ENTRYDATE,
														plu.PARTYID,
														stock.PRODCATTYPEID,
														bkdn.PACKINGUNITID,
														stock.PRODUCTID,
														stock.QUANTITY,
														stock.LOADBASTA,
														stock.UNLOADBASTA,
														stock.LOADKG,
														stock.UNLOADKG,
														stock.AVGUNIT,
														stock.WORKTYPEFLAG,
														p.PRODUCTNAME
												FROM 
													fna_productloadunload plu, fna_productloadunloadbkdn bkdn, fna_productstock stock, fna_product p
												WHERE plu.PRODUCTLOADUNLOADID = bkdn.PRODUCTLOADUNLOADID
												AND bkdn.PRODUCTLOADUNLOADBKDNID = stock.PRODUCTLOADUNLOADBKDNID
												AND p.PRODUCTID = stock.PRODUCTID
												AND plu.PARTYID = '".$PARTYID."'
												AND plu.PROJECTID = '".$PROJECTID."'
												AND plu.SUBPROJECTID = '".$SUBPROJECTID."'
												{$con}
												AND stock.WORKTYPEFLAG = '".$LOADTYPE."'
												AND plu.ENTRYDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
												ORDER BY stock.PRODUCTID ASC
											";
								$aViewStatement			= mysql_query($aViewQuery);
								while($aViewStatementData	= mysql_fetch_array($aViewStatement)){ 
								
								 $PARTYID        		= $aViewStatementData["PARTYID"]; 
								 $PRODUCTID       		= $aViewStatementData["PRODUCTID"]; 
								 $PRODCATTYPEID_NEW    	= $aViewStatementData["PRODCATTYPEID"];
								 $PACKINGUNITID       	= $aViewStatementData["PACKINGUNITID"]; 	
								 $QUANTITY         		= $aViewStatementData["QUANTITY"];
								 $LOADBASTA		       	= $aViewStatementData["LOADBASTA"]; 
								 $UNLOADBASTA      		= $aViewStatementData["UNLOADBASTA"]; 	
								 $LOADKG		        = $aViewStatementData["LOADKG"];
								 $UNLOADKG		        = $aViewStatementData["UNLOADKG"];
								 $AVGUNIT		        = $aViewStatementData["AVGUNIT"];
								 $WORKTYPEFLAG	        = $aViewStatementData["WORKTYPEFLAG"];
								 $PRODUCTNAME	        = $aViewStatementData["PRODUCTNAME"];
								
							// Package Information View Report End
							
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
											echo $UNITFARE   		= $prodFareQueryStatementData["UNITFARE"];	
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
							$Global_Load_KG		= $Global_Load_KG + $LOADKG ; 
							$Global_Unload_KG	= $Global_Unload_KG + $UNLOADKG ;
							 
							//-----------------------------------------------------------------
						//if($Basta_QUANTITY != '' and $Drum_QUANTITY != '' and $cortun_QUANTITY != ''){
 // Dynamic Row Start

						$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000'>$sl</td>

											<td align='left' valign='top'  style='border: 1px dotted #000'>$PRODUCTNAME</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'> $Drum_QUANTITY</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>$cortun_QUANTITY</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>$Basta_QUANTITY</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>$Drum_QVALUE </td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>$Cartoon_QVALUE </td>

											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($AVGUNIT,2)."</td>
					
											<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($LOADKG,2)."</td>
											
											<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($UNLOADKG,2)."</td>
					
											
										</tr>

									 ";
			
								// Dynamic Row End		  
						}
					
				$sl++;
				}

					$tableView .="

						<tr style='font-weight:bold;'>

							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>$Global_Drum_Qnty</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>$Global_cortun_Qnty</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>$Global_Basta_Qnty</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='right' valign='top'  style='border: 1px dotted #000'>&nbsp;</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_Load_KG,2)."</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_Unload_KG,2)."</td>

						</tr>
						
						<tr>

							<td colspan='10' align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

						</tr>";
						
						
							
						//$Global_Balance_Amount	= $glabalBill - $Gloabal_Receive_Amount ;
						
						
						$tableViewFooter ="";
						$tableViewFooter .="<table width='80%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:85%; border: 1px dotted #000'>
						<tr>

							<td colspan='10' align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

						</tr>
							
						<tr>

							<td colspan='10' align='left' valign='top'>&nbsp;</td>

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
	//echo $tableViewReceive;
	echo $tableViewFooter ;

?>