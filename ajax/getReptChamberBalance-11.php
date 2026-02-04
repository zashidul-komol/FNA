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
	$CHID				= $_REQUEST['CHID'];
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
		$partySql 	= "
							SELECT CHNAME									
							FROM fna_chamber 
							WHERE CHID = $CHID
						";
			$partySqlStatement				= mysql_query($partySql);
			while($partySqlStatementData	= mysql_fetch_array($partySqlStatement)){
				$CHNAME		        		= $partySqlStatementData["CHNAME"];
			}
		
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
							<center><b><font size=4>Load, Unload & Balance Report</FONT></b></center>  
							<center>&nbsp;</center>
							<center><b><font size=4>Chamber-$CHNAME</FONT></b></center>
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

						<td align='center' valign='top' style='border: 1px dotted #000'>Party Name</td>
						
						<td align='center' valign='top' style='border: 1px dotted #000'>Product name </td>
						
						<td align='center' valign='top' style='border: 1px dotted #000'>Packing Unit</td>

						<td align='center' valign='top' style='border: 1px dotted #000'>Floor</td>

						<td align='center' valign='top' style='border: 1px dotted #000'>Pocket</td>
						
						<td align='center' valign='top' style='border: 1px dotted #000'>Load Qnty</td>
						
						<td align='center' valign='top' style='border: 1px dotted #000'>Unload Qnty</td>
						
						<td align='center' valign='top' style='border: 1px dotted #000'>Balance Qnty</td>
						
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
								
								$aViewQuery 	= 	"SELECT  * FROM fna_pocketstock 
												   		WHERE PROJECTID = '".$PROJECTID."'
														AND CHID = '".$CHID."'
														AND ENTYRYDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
												   		ORDER BY FLOORID ASC
												";
								$aViewStatement			= mysql_query($aViewQuery);
								$GLOBAL_LOADQUANTITY		= '';
								$GLOBAL_UNLOADQUANTITY		= '';
								$GLOBAL_BALANCE				= '';
								//$LOADQUANTITY				= '';
								
								while($aViewStatementData	= mysql_fetch_array($aViewStatement)){ 
								
								 $PARTYID        		= $aViewStatementData["PARTYID"]; 
								 $PRODUCTID       		= $aViewStatementData["PRODUCTID"];
								 $PACKINGUNITID    		= $aViewStatementData["PACKINGUNITID"];  
								 $LOADQUANTITY     		= $aViewStatementData["LOADQUANTITY"];
								 $UNLOADQUANTITY      	= $aViewStatementData["UNLOADQUANTITY"]; 
								 $FLOORID		        = $aViewStatementData["FLOORID"];
								 $POCKETID		        = $aViewStatementData["POCKETID"];
								 $ENTYRYDATE	        = $aViewStatementData["ENTYRYDATE"];
								 $POCKETBALANCE	        = $aViewStatementData["POCKETBALANCE"];
								
								
								
								$GLOBAL_LOADQUANTITY    = $GLOBAL_LOADQUANTITY + $LOADQUANTITY ; 
								$GLOBAL_UNLOADQUANTITY	= $GLOBAL_UNLOADQUANTITY + $UNLOADQUANTITY ; 
								$GLOBAL_BALANCE			= $GLOBAL_BALANCE + $POCKETBALANCE ; 
													
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
										
								
						$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000' width='5%'>$sl</td>

											<td align='center' valign='top' style='border: 1px dotted #000' width='15%'> $PARTYNAME</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000' width='20%'> $PRODUCTNAME</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000' width='15%'> $NewPackingName </td>
					
											<td align='center' valign='top' style='border: 1px dotted #000' width='7%'>$FLOORNAME</td>
					
											<td align='center' valign='top' style='border: 1px dotted #000' width='8%'>$POCKETNAME </td>
											
											<td align='center' valign='top' style='border: 1px dotted #000' width='10%'>$LOADQUANTITY </td>

											<td align='center' valign='top'  style='border: 1px dotted #000' width='10%'>$UNLOADQUANTITY</td>
											
											<td align='center' valign='top'  style='border: 1px dotted #000' width='10%'>$POCKETBALANCE</td>
					
											
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

							<td align='right' valign='top' style='border: 1px dotted #000'>Total : </td>

							<td align='center' valign='top' style='border: 1px dotted #000'>$GLOBAL_LOADQUANTITY </td>

							<td align='center' valign='top' style='border: 1px dotted #000'>$GLOBAL_UNLOADQUANTITY</td>
							
							<td align='center' valign='top' style='border: 1px dotted #000'>$GLOBAL_BALANCE	</td>

						</tr>
						
						<tr>

							<td colspan='9' align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

						</tr>";
						
						
							
						//$Global_Balance_Amount	= $glabalBill - $Gloabal_Receive_Amount ;
						
						
						$tableViewFooter ="";
						$tableViewFooter .="<table width='80%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:85%; border: 1px dotted #000'>
						<tr>

							<td colspan='9' align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

						</tr>
							
						<tr>

							<td colspan='9' align='left' valign='top'>&nbsp;</td>

						</tr>
						<tr>

							<td colspan='9' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='9' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='9' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='9' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='9' align='left' valign='top' >
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

							<td colspan='9' align='left' valign='top' >&nbsp;</td>

						</tr>
						<tr>

							<td colspan='9' align='left' valign='top' >&nbsp;</td>

						</tr>					

					</table>";
	echo $tableView;
	//echo $tableViewReceive;
	echo $tableViewFooter ;

?>