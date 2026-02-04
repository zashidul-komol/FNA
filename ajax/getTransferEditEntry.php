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

	$ENTRYSERIALNO	= $_REQUEST['ENTRYSERIALNO'];
	
	//echo  $ENTRYSERIALNO ; 				
	$tableView = "";	
	$tableView .="<table width='100%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:85%; border: 1px dotted #000'>
					  <tr valign='middle'>
						<td width='15%' align='center' bgcolor='#990033' style='color:white'>Entry Serial No.</td>
						<td width='25%' align='center' bgcolor='#990033' style='color:white'>Product name</td>
						<td width='15%' align='center' bgcolor='#FFFF66'>Chamber To</td>
						<td width='10%' align='center' bgcolor='#FFFF66'>Floor</td>
						<td width='10%' align='center' bgcolor='#FFFF66'>Pocket</td>
						<td width='10%' align='center' bgcolor='#CCFFFF'>Quantity</td>
						<td width='15%' align='center' bgcolor='#CCFFFF'>Labour Bill</td>
						
					</tr>";

// Query here.
//----------------------------------------------Session Year---------------------------------------------------

						
						 $aQuery 	= "SELECT   *								
											FROM `fna_pocketstockdetails` 
											WHERE `ENTRYSERIALNOID` = '".$ENTRYSERIALNO."' 
											AND STATUS = 'transfer'
											ORDER BY ENTYRYDATE ASC
									";
						$aQueryStatement	= mysql_query($aQuery);
						$sl = 1;
						$glabalToatalIntAmount = 0;
						while($aQueryStatementData	= mysql_fetch_array($aQueryStatement)){

 						// Dynamic Row Start
						$ENTRYSERIALNOID 		= $aQueryStatementData['ENTRYSERIALNOID'];
						$ENTRYHISTRY 			= $aQueryStatementData['ENTRYHISTRY'];
						$ENTYRYDATE 			= $aQueryStatementData['ENTYRYDATE'];
						$PRODCATTYPEID 			= $aQueryStatementData['PRODCATTYPEID'];
						$PRODUCTID 				= $aQueryStatementData['PRODUCTID'];
						$PACKINGUNITID			= $aQueryStatementData['PACKINGUNITID'];
						$CHID					= $aQueryStatementData['CHID'];
						$FLOORID 				= $aQueryStatementData['FLOORID'];
						$POCKETID				= $aQueryStatementData['POCKETID'];
						$LOADQUANTITY 			= $aQueryStatementData['LOADQUANTITY'];
						$UNLOADQUANTITY 		= $aQueryStatementData['UNLOADQUANTITY'];
						$STATUS 				= $aQueryStatementData['STATUS'];
						
						$ProductNameQuery 	= "SELECT   PRODUCTNAME										
														FROM `fna_product` 
														WHERE `PRODUCTID` = '".$PRODUCTID."' 
														ORDER BY PRODUCTNAME ASC
												";
						$ProductNameQueryStatement				= mysql_query($ProductNameQuery);
						while($ProductNameQueryStatementData	= mysql_fetch_array($ProductNameQueryStatement)){
 							$PRODUCTNAME	 					= $ProductNameQueryStatementData['PRODUCTNAME'];
						}
						$ChamberNameQuery 	= "SELECT   CHNAME										
														FROM `fna_chamber` 
														WHERE `CHID` = '".$CHID."' 
														ORDER BY CHNAME ASC
												";
						$ChamberNameQueryStatement				= mysql_query($ChamberNameQuery);
						while($ChamberNameQueryStatementData	= mysql_fetch_array($ChamberNameQueryStatement)){
 							$CHNAME			 					= $ChamberNameQueryStatementData['CHNAME'];
						}
						$FloorNameQuery 	= "SELECT   FLOORNAME										
														FROM `fna_floor` 
														WHERE `FLOORID` = '".$FLOORID."' 
														ORDER BY FLOORNAME ASC
												";
						$FloorNameQueryStatement				= mysql_query($FloorNameQuery);
						while($FloorNameQueryStatementData		= mysql_fetch_array($FloorNameQueryStatement)){
 							$FLOORNAME		 					= $FloorNameQueryStatementData['FLOORNAME'];
						}
						$PocketNameQuery 	= "SELECT   POCKETNAME										
														FROM `fna_pocket` 
														WHERE `POCKETID` = '".$POCKETID."' 
														ORDER BY POCKETNAME ASC
												";
						$PocketNameQueryStatement				= mysql_query($PocketNameQuery);
						while($PocketNameQueryStatementData		= mysql_fetch_array($PocketNameQueryStatement)){
 							$POCKETNAME		 					= $PocketNameQueryStatementData['POCKETNAME'];
						}
						
											
						$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000'><input id='ENTRYSERIALNOID_1' name='ENTRYSERIALNOID[]' style='width:120px;' onchange='etProduct(this.id,this.value);' value = '{$ENTRYSERIALNOID}' readonly='true'></td>

											<td align='left' valign='top' style='border: 1px dotted #000'><input id='PRODUCTID_1' name='PRODUCTID[]' style='width:200px;' onchange='etProduct(this.id,this.value);' value = '{$PRODUCTNAME}' readonly='true'> </td>
											
											<td align='left' valign='top' style='border: 1px dotted #000'> <input id='CHID2_1' name='CHID2[]' style='width:120px;' onchange='etProduct(this.id,this.value);' value = '{$CHNAME}' readonly='true'></td>
											
											<td align='left' valign='top' style='border: 1px dotted #000'> <input id='FLOORID2_1' name='FLOORID2[]' style='width:120px;' onchange='etProduct(this.id,this.value);' value = '{$FLOORNAME}' readonly='true'></td>
					
											<td align='left' valign='top'  style='border: 1px dotted #000'><input id='POCKETID2_1' name='POCKETID2[]' style='width:120px;' onchange='etProduct(this.id,this.value);' value = '{$POCKETNAME}' readonly='true'></td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'><input id='quantity_1' name='quantity[]' style='width:120px;' onchange='etProduct(this.id,this.value);' value = '{$UNLOADQUANTITY}' readonly='true'></td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'><input id='labourbill_1' name='labourbill[]' style='width:120px;' onchange='etProduct(this.id,this.value);' value = ''></td>
											
												
										</tr>

									 ";

								// Dynamic Row End		  

				$sl++;
				}

					$tableView .="

						<tr bgcolor='#CCCCCC'>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top'  style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='left' valign='top'  style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
							
								
						</tr>
						<tr>

							<td colspan='15' align='left' valign='top' style='border: 1px dotted #000'>
									<table width='100%' border='0' cellpadding='3' cellspacing='0'>	
										<tr valign='top'>
										  <td align='right'>&nbsp;</td>
										  <td height='26' align='left'>
										  <input type='hidden' name='LOANTYPEID' id='LOANTYPEID' value='{}'/>
										  <input type='hidden' name='INTERESTRATE' id='INTERESTRATE' value=''/>
										  <input type='hidden' name='LOANPURPOSE' id='LOANPURPOSE' value=''/>
										  <input type='hidden' name='INT_AMOUNT' id='INT_AMOUNT' value=''/>
										  <input type='hidden' name='TOT_LOANAMOUNT' id='TOT_LOANAMOUNT' value=''/>
										  <input type='hidden' name='PROJECTID' id='PROJECTID' value=''/>
										  <input type='hidden' name='SUBPROJECTID' id='SUBPROJECTID' value=''/>
										  <input type='hidden' name='PARTYID' id='PARTYID' value=''/>
										  <input type='hidden' name='CALDATE' id='CALDATE' value=''/>
										  <input align='center' type='submit' name='InsertTransferEditInfo' value='Insert' class='FormSubmitBtn' />
										  <input align='center' name='btnClose' type='button' value='Close' onClick='return ShowHide('showLoad')'>
										  </td>
										  <td height='26' align='right'>&nbsp;</td>
										  <td height='26' align='left'>&nbsp;</td>
										</tr>	
								 </table>
							</td>

						</tr>
					</table>";
	echo $tableView;

?>