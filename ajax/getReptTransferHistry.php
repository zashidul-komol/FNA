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
	$PRODUCTID			= $_REQUEST['PRODUCTID'];
	$ENTRYDATEFROM		= insertDateMySQlFormat($_REQUEST['ENTRYDATE']);
	$ENTRYDATETO		= insertDateMySQlFormat($_REQUEST['ENTRYDATE2']);
	$userId 			= $_REQUEST['userId'];
	
		$con = '';
		if ($PRODUCTID == 'All'){
			$con = '';
		}else{
			$con = "AND th.PRODUCTID ='".$PRODUCTID."' ";
		}
		$SubCon = '';
		if ($SUBPROJECTID == 'All'){
			$SubCon = '';
		}else{
			$SubCon = "AND SUBPROJECTID ='".$SUBPROJECTID."' ";
		}
		$PartyCon = '';
		if ($PARTYID == 'All'){
			$PartyCon = '';
		}else{
			$PartyCon = "AND PARTYID ='".$PARTYID."' ";
		}
		$CatCon = '';
		if ($PRODCATTYPEID == 'All'){
			$CatCon = '';
		}else{
			$CatCon = "AND p.PRODCATTYPEID ='".$PRODCATTYPEID."' ";
		}
		
		
				
	$tableView = "";	
	$tableView .="<table width='80%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:85%; border: 1px dotted #000'>

					  <tr>
                            <td style='text-align:right;' colspan='13'>
                            <a href='javascript:Clickheretoprint()'><img border='0' src='images/print_icon.jpg' width='40' height='26' /></a>                        
                            </td>
                     </tr>
					  <tr>
						<td colspan='14' align='center' valign='middle' style='border: 1px dotted #000'>
							<center><b><font size=5>F N A Group Of Company</font></b></center>
							<center>&nbsp;</center>
							<center><b><font size=4>Transfer Histry Report</FONT></b></center>
							
						</td>
					  </tr>
					  <tr style='font-weight:bold;'>

						<td align='center' valign='top' style='font-weight:bold;border: 1px dotted #000'>SL No.</td>

						<td align='center' valign='top' style='border: 1px dotted #000'>Entry Date</td>
						
						<td align='center' valign='top' style='border: 1px dotted #000'>Entry Serial</td>
						
						<td align='center' valign='top' style='border: 1px dotted #000'>Party Name </td>
						
						<td align='center' valign='top' style='border: 1px dotted #000'>Product Name </td>
						
						<td align='center' valign='top' style='border: 1px dotted #000'>Packing Unit</td>
						
						<td align='center' valign='top' style='border: 1px dotted #000'>Quantity</td>

						<td align='center' valign='top' style='border: 1px dotted #000'>Chamber From</td>

						<td align='center' valign='top' style='border: 1px dotted #000'>Floor From</td>

						<td align='center' valign='top' style='border: 1px dotted #000'>Pocket From</td>
						
						<td align='center' valign='top' style='border: 1px dotted #000'>Chamber To</td>

						<td align='center' valign='top' style='border: 1px dotted #000'>Floor To</td>

						<td align='center' valign='top' style='border: 1px dotted #000'>Pocket To</td>
						
						<td align='center' valign='top' style='border: 1px dotted #000'>Action</td>
						
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
								
								/*echo "SELECT * FROM fna_transferhistry th, fna_product p
												   WHERE p.PRODUCTID = th.PRODUCTID
												   AND th.ENTYRYDATE BETWEEN '".$ENTRYDATEFROM."' AND '".$ENTRYDATETO."'
												   AND th.PARTYID = '".$PARTYID."'
												   {$con}
												   ORDER BY th.PRODUCTID ASC
												"; */
								
								$aViewQuery 	= "SELECT * FROM fna_transferhistry th, fna_product p
												   WHERE p.PRODUCTID = th.PRODUCTID
												   AND th.ENTYRYDATE BETWEEN '".$ENTRYDATEFROM."' AND '".$ENTRYDATETO."'
												   AND th.PARTYID = '".$PARTYID."'
												   {$con}
												   {$CatCon}
												   ORDER BY th.PRODUCTID ASC
												";
								$aViewStatement			= mysql_query($aViewQuery);
								$GLOBAL_QUANTITY		= '';
								while($aViewStatementData	= mysql_fetch_array($aViewStatement)){ 
								
								 $POCKETSTOCKID    		= $aViewStatementData["POCKETSTOCKID"]; 
								 $PARTYID        		= $aViewStatementData["PARTYID"]; 
								 $ENTRYSERIALNOID  		= $aViewStatementData["ENTRYSERIALNOID"]; 
								 $ENTRYHISTRY	  		= $aViewStatementData["ENTRYHISTRY"]; 
								 $PRODUCTID       		= $aViewStatementData["PRODUCTID"];
								 $PACKINGUNITID    		= $aViewStatementData["PACKINGUNITID"];  
								 $TRANSFERQUANTITY     	= $aViewStatementData["TRANSFERQUANTITY"]; 
								 $CHIDFROM		        = $aViewStatementData["CHIDFROM"];
								 $FLOORIDFROM	        = $aViewStatementData["FLOORIDFROM"];
								 $POCKETIDFROM	        = $aViewStatementData["POCKETIDFROM"];
								 $CHIDTO		        = $aViewStatementData["CHIDTO"];
								 $FLOORIDTO		        = $aViewStatementData["FLOORIDTO"];
								 $POCKETIDTO	        = $aViewStatementData["POCKETIDTO"];
								 $STATUS		        = $aViewStatementData["STATUS"];
								 $ENTYRYDATE	        = $aViewStatementData["ENTYRYDATE"];
								 
								$GLOBAL_QUANTITY		= $GLOBAL_QUANTITY + $TRANSFERQUANTITY ; 				
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
										
							$PartyNameQuery  = "SELECT PARTYNAME FROM fna_party
													WHERE PARTYID = '".$PARTYID."'";
													
									$PartyNameQueryStatement					= mysql_query($PartyNameQuery);
										while($PartyNameQueryStatementData		= mysql_fetch_array($PartyNameQueryStatement)){ 
											
											 	$PARTYNAME       				= $PartyNameQueryStatementData["PARTYNAME"]; 
										}
										
							$ChamberFromNameQuery  = "SELECT CHNAME FROM fna_chamber
													WHERE CHID = '".$CHIDFROM."'";
													
									$ChamberFromNameQueryStatement					= mysql_query($ChamberFromNameQuery);
										while($ChamberFromNameQueryStatementData	= mysql_fetch_array($ChamberFromNameQueryStatement)){ 
											
											 	$CHNAMEFROM    						= $ChamberFromNameQueryStatementData["CHNAME"]; 
										}
										
							$FloorFromQuery  = "SELECT FLOORNAME FROM fna_floor
													WHERE FLOORID = '".$FLOORIDFROM."'";
													
									$FloorFromQueryStatement				= mysql_query($FloorFromQuery);
										while($FloorFromQueryStatementData	= mysql_fetch_array($FloorFromQueryStatement)){ 
											
											 	$FLOORNAMEFROM     			= $FloorFromQueryStatementData["FLOORNAME"]; 
										}
										
							$PocketFromQuery  = "SELECT POCKETNAME FROM fna_pocket
													WHERE POCKETID = '".$POCKETIDFROM."'";
													
									$PocketFromQueryStatement				= mysql_query($PocketFromQuery);
										while($PocketFromQueryStatementData	= mysql_fetch_array($PocketFromQueryStatement)){ 
											
											 	$POCKETNAMEFROM       		= $PocketFromQueryStatementData["POCKETNAME"]; 
										}
										
							$ChamberToNameQuery  = "SELECT CHNAME FROM fna_chamber
													WHERE CHID = '".$CHIDTO."'";
													
							$ChamberToNameQueryStatement					= mysql_query($ChamberToNameQuery);
								while($ChamberToNameQueryStatementData		= mysql_fetch_array($ChamberToNameQueryStatement)){ 
									
										$CHNAMETO    						= $ChamberToNameQueryStatementData["CHNAME"]; 
								}
										
							$FloorToQuery  = "SELECT FLOORNAME FROM fna_floor
													WHERE FLOORID = '".$FLOORIDTO."'";
													
							$FloorToQueryStatement					= mysql_query($FloorToQuery);
								while($FloorToQueryStatementData	= mysql_fetch_array($FloorToQueryStatement)){ 
									
										$FLOORNAMETO     			= $FloorToQueryStatementData["FLOORNAME"]; 
								}
										
							$PocketToQuery  = "SELECT POCKETNAME FROM fna_pocket
													WHERE POCKETID = '".$POCKETIDTO."'";
													
							$PocketToQueryStatement				= mysql_query($PocketToQuery);
								while($PocketToQueryStatementData	= mysql_fetch_array($PocketToQueryStatement)){ 
									
										$POCKETNAMETO       		= $PocketToQueryStatementData["POCKETNAME"]; 
								}
					
						$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000' width='5%'>$sl</td>

											<td align='right' valign='top' style='border: 1px dotted #000' width='7%'> $ENTYRYDATE</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000' width='7%'> $ENTRYSERIALNOID</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000' width='15%'> $PARTYNAME</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000' width='10%'> $PRODUCTNAME</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000' width='8%'> $NewPackingName </td>
					
											<td align='right' valign='top' style='border: 1px dotted #000' width='5%'>$TRANSFERQUANTITY</td>
					
											<td align='center' valign='top' style='border: 1px dotted #000' width='8%'>$CHNAMEFROM</td>
					
											<td align='center' valign='top' style='border: 1px dotted #000' width='8%'>$FLOORNAMEFROM </td>
											
											<td align='center' valign='top' style='border: 1px dotted #000' width='8%'>$POCKETNAMEFROM </td>

											<td align='center' valign='top' style='border: 1px dotted #000' width='6%'>$CHNAMETO</td>
					
											<td align='center' valign='top'  style='border: 1px dotted #000' width='7%'>$FLOORNAMETO</td>
											
											<td align='center' valign='top'  style='border: 1px dotted #000' width='6%'>$POCKETNAMETO</td>
											
											<td align='center' valign='top'  style='border: 1px dotted #000' width='6%'><a href = 'fnaTransferEditCheck.php?'> Edit </a></td>
											<input type='hidden' name='POCKETSTOCKID' id='POCKETSTOCKID' value='{$POCKETSTOCKID}'/>
											
												
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

							<td align='right' valign='top' style='border: 1px dotted #000'>Total: </td>

							<td align='right' valign='top' style='border: 1px dotted #000'>$GLOBAL_QUANTITY</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='right' valign='top'  style='border: 1px dotted #000'>&nbsp;</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
							
						</tr>
						
						<tr>

							<td colspan='14' align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

						</tr>";
						
						
							
						//$Global_Balance_Amount	= $glabalBill - $Gloabal_Receive_Amount ;
						
						
						$tableViewFooter ="";
						$tableViewFooter .="<table width='80%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:85%; border: 1px dotted #000'>
						<tr>

							<td colspan='14' align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

						</tr>
							
						<tr>

							<td colspan='14' align='left' valign='top'>&nbsp;</td>

						</tr>
						<tr>

							<td colspan='14' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='14' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='14' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='14' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='14' align='left' valign='top' >
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

							<td colspan='14' align='left' valign='top' >&nbsp;</td>

						</tr>
						<tr>

							<td colspan='14' align='left' valign='top' >&nbsp;</td>

						</tr>					

					</table>";
	echo $tableView;
	//echo $tableViewReceive;
	echo $tableViewFooter ;

?>