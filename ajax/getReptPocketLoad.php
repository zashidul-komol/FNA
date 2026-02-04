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
	$TYPE				= $_REQUEST['TYPE'];
	$ENTRYDATE_FROM 	= showDateMySQlFormat($_REQUEST['ENTRYDATE']);
	$ENTRYDATE_TO 		= showDateMySQlFormat($_REQUEST['ENTRYDATE2']);
	//$CHID				= $_REQUEST['CHID'];
	//$FLOORID			= $_REQUEST['FLOORID'];
	$userId 			= $_REQUEST['userId'];
		//$con = '';
		//if ($FLOORID == ''){
			//$con = '';
		//}else{
			//$con = "AND FLOORID='".$FLOORID."' ";
		//}
		
		
		//Ministry/Division and Project/Programme Name View Report Start				
	 	
			
			
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
							<center><b><font size=4>$TYPE Report</FONT></b></center>
							<center>&nbsp;</center>
							<center><b><font size=2>Date : ".showDateMySQlFormat($ENTRYDATE_FROM)." to ".showDateMySQlFormat($ENTRYDATE_TO)." </font></b></center>
							
						</td>
					  </tr>
					  <tr>

						<td colspan='11' align='left' valign='top'>
							<table width='100%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:100%;'>
								  <tr>
								
									<td width='14%' align='left' valign='top'>&nbsp;</td>
									<td width='1%' align='center' valign='top'>&nbsp;</td>
									<td width='34%' align='left' valign='top'> &nbsp;</td>
									<td width='18%' align='right' valign='top'>&nbsp;</td>
									<td width='1%' align='center' valign='top'>&nbsp;</td>
									<td width='20%' align='right' valign='top'>&nbsp;</td>
									<td width='1%' align='center' valign='top'>&nbsp;</td>
									<td align='left' valign='top'>&nbsp;</td>
								
								  </tr>
								
								  
								</table>
							

						</td>

					  </tr>

					  <tr style='font-weight:bold;'>

						<td align='center' valign='top' style='font-weight:bold;border: 1px dotted #000'>SL No.</td>

						<td align='center' valign='top' style='border: 1px dotted #000'>Entry Date</td>
						
						<td align='center' valign='top' style='border: 1px dotted #000'>Party Name</td>
						
						<td align='center' valign='top' style='border: 1px dotted #000'>Product name </td>
						
						<td align='center' valign='top' style='border: 1px dotted #000'>SR</td>
						
						<td align='center' valign='top' style='border: 1px dotted #000'>Packing Unit</td>

						<td align='center' valign='top' style='border: 1px dotted #000'>Chamber</td>

						<td align='center' valign='top' style='border: 1px dotted #000'>Floor</td>

						<td align='center' valign='top' style='border: 1px dotted #000'>Pocket</td>
						
						<td align='center' valign='top' style='border: 1px dotted #000'>$TYPE Qnty</td>
						
						<td align='center' valign='top' style='border: 1px dotted #000'>Manufacture Date</td>
						
						<td align='center' valign='top' style='border: 1px dotted #000'>Expire Date</td>
						
						
					</tr>";

// Query here.
						
							
						
								$sl 			= 1;
																
							// Package Information View Report Start 	 <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<		
							
							
								$CATEGORYTYPENAME 	= '';
								$PRODUCTNAME 	= '';
								$PACKINGUNITID   	= '';
								$QUANTITY 	= '';
								$WTQNTY		= 0;
								
								$Global_Load_KG		= 0 ; 
								$Global_Unload_KG	= 0 ;
								$NEW_STATUS = '';
								if($TYPE == 'Load'){
									$NEW_STATUS	= 'load';
								}elseif($TYPE == 'Unload'){
									$NEW_STATUS	= 'unload';	
								}elseif($TYPE == 'Transfer'){
									$NEW_STATUS	= 'transfer';	
								}elseif($TYPE == 'Palot'){
									$NEW_STATUS	= 'palot';	
								}							
								
								$aViewQuery 	= 	"SELECT  st.PROJECTID,
															 st.PARTYID,
															 st.CHALLANNO,
															 st.LOADQUANTITY,
															 det.ENTYRYDATE,
															 st.MANUFACTUREDATE,
															 st.EXPIREDATE,
															 det.PRODUCTID,
															 det.PACKINGUNITID,
															 det.CHID,
															 det.FLOORID,
															 det.POCKETID,
															 det.UNLOADQUANTITY,
															 det.STATUS
													FROM fna_pocketstock st, fna_pocketstockdetails det
												   		WHERE st.POCKETSTOCKID = det.POCKETSTOCKID
														AND st.PROJECTID = '".$PROJECTID."'
														AND det.STATUS = '".$NEW_STATUS."'
														AND det.ENTYRYDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
												   		ORDER BY det.PRODUCTID ASC, det.ENTYRYDATE ASC
												";
								$aViewStatement			= mysql_query($aViewQuery);
								$LOADQUANTITY				= '';
								$UNLOADQUANTITY				= '';
								$CHALLANNOSR				= '';
								//$LOADQUANTITY				= '';
								
								while($aViewStatementData	= mysql_fetch_array($aViewStatement)){ 
								
								 $PARTYID        		= $aViewStatementData["PARTYID"]; 
								 $PRODUCTID       		= $aViewStatementData["PRODUCTID"];
								 $CHALLANNOSR     		= $aViewStatementData["CHALLANNO"];
								 $PACKINGUNITID    		= $aViewStatementData["PACKINGUNITID"];  
								 $LOADQUANTITY     		= $aViewStatementData["LOADQUANTITY"];
								 $UNLOADQUANTITY      	= $aViewStatementData["UNLOADQUANTITY"]; 
								 $CHID			        = $aViewStatementData["CHID"];
								 $FLOORID		        = $aViewStatementData["FLOORID"];
								 $POCKETID		        = $aViewStatementData["POCKETID"];
								 $MANUFACTUREDATE       = $aViewStatementData["MANUFACTUREDATE"];
								 $EXPIREDATE	        = $aViewStatementData["EXPIREDATE"];
								 $ENTYRYDATE	        = $aViewStatementData["ENTYRYDATE"];
								 $STATUS		        = $aViewStatementData["STATUS"];
								
													
							//-----------------------------------------------------------------
							
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
							$NewPackingName = '';
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
							}
							
							$NewPackingName				= $QVALUE .'-'. $WNAME .'-'. $PACKINGNAME ; 
							
							$ProductNameQuery  = "SELECT PRODUCTNAME FROM fna_product
													WHERE PRODUCTID = '".$PRODUCTID."'";
													
									$ProductNameQueryStatement					= mysql_query($ProductNameQuery);
										while($ProductNameQueryStatementData	= mysql_fetch_array($ProductNameQueryStatement)){ 
											
											 	$PRODUCTNAME       				= $ProductNameQueryStatementData["PRODUCTNAME"]; 
										}
										
							$ChamberNameQuery  = "SELECT CHNAME FROM fna_chamber
													WHERE CHID = '".$CHID."'";
													
									$ChamberNameQueryStatement					= mysql_query($ChamberNameQuery);
										while($ChamberNameQueryStatementData	= mysql_fetch_array($ChamberNameQueryStatement)){ 
											
											 	$CHNAME       					= $ChamberNameQueryStatementData["CHNAME"]; 
										}
										
							$FloorQuery  = "SELECT FLOORNAME FROM fna_floor
													WHERE FLOORID = '".$FLOORID."'";
													
									$FloorQueryStatement				= mysql_query($FloorQuery);
										while($FloorQueryStatementData	= mysql_fetch_array($FloorQueryStatement)){ 
											
											 	$FLOORNAME       		= $FloorQueryStatementData["FLOORNAME"]; 
										}
										
							$PocketQuery  = "SELECT POCKETNAME FROM fna_pocket
													WHERE POCKETID = '".$POCKETID."'";
													
									$PocketQueryStatement				= mysql_query($PocketQuery);
										while($PocketQueryStatementData	= mysql_fetch_array($PocketQueryStatement)){ 
											
											 	$POCKETNAME       		= $PocketQueryStatementData["POCKETNAME"]; 
										}
										
							$PartyNameQuery  = "SELECT PARTYNAME FROM fna_party
													WHERE PARTYID = '".$PARTYID."'";
													
									$PartyNameQueryStatement				= mysql_query($PartyNameQuery);
										while($PartyNameQueryStatementData	= mysql_fetch_array($PartyNameQueryStatement)){ 
											
											 	$PARTYNAME       			= $PartyNameQueryStatementData["PARTYNAME"]; 
										}
										$NEW_QUANTITY = '';
										if($STATUS == 'load'){
											$NEW_QUANTITY	= $LOADQUANTITY;
										}elseif($STATUS == 'unload'){
											$NEW_QUANTITY	= $UNLOADQUANTITY;
										}elseif($STATUS == 'transfer'){
											$NEW_QUANTITY	= $UNLOADQUANTITY;
										}elseif($STATUS == 'palot'){
											$NEW_QUANTITY	= $UNLOADQUANTITY;
										}
										
										
								
						$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000' width='3%'>$sl</td>

											<td align='center' valign='top' style='border: 1px dotted #000' width='8%'> ".showDateMySQlFormat($ENTYRYDATE)."</td>
											
											<td align='center' valign='top' style='border: 1px dotted #000' width='8%'> $PARTYNAME</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000' width='11%'> $PRODUCTNAME</td>
											
											<td align='center' valign='top' style='border: 1px dotted #000' width='6%'> $CHALLANNOSR</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000' width='8%'> $NewPackingName </td>
					
											<td align='right' valign='top' style='border: 1px dotted #000' width='8%'>$CHNAME</td>
					
											<td align='center' valign='top' style='border: 1px dotted #000' width='6%'>$FLOORNAME</td>
					
											<td align='center' valign='top' style='border: 1px dotted #000' width='6%'>$POCKETNAME </td>
											
											<td align='center' valign='top' style='border: 1px dotted #000' width='7%'>$NEW_QUANTITY </td>

											<td align='center' valign='top'  style='border: 1px dotted #000' width='7%'>".showDateMySQlFormat($MANUFACTUREDATE)."</td>
											
											<td align='center' valign='top'  style='border: 1px dotted #000' width='7%'>".showDateMySQlFormat($EXPIREDATE)."</td>
					
											
										</tr>

									 ";
			
								$sl++;
					  
						}
					
				

					$tableView .="

						<tr style='font-weight:bold;'>

							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='right' valign='top'  style='border: 1px dotted #000'>&nbsp;</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

						</tr>
						
						<tr>

							<td colspan='12' align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

						</tr>";
						
						
							
						//$Global_Balance_Amount	= $glabalBill - $Gloabal_Receive_Amount ;
						
						
						$tableViewFooter ="";
						$tableViewFooter .="<table width='80%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:85%; border: 1px dotted #000'>
						<tr>

							<td colspan='12' align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

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
								  </tr>
								  <tr>
									<td align='center' valign='top'  ><b>Store Keeper Signature</b></td>
									<td  align='center' valign='top'  ><b>Computer Operator Signature</b></td>
									<td align='center' valign='top'  ><b>AGM Signature</b></td>
									<td align='center' valign='top'  ><b>GM Signature</b></td>
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
	//echo $tableViewReceive;
	echo $tableViewFooter ;

?>