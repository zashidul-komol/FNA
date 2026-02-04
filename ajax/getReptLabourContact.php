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
	/*//$tran	 			= $_REQUEST['all'];
	//echo "<pre>"; print_r($tran);
	$load	 			= $_REQUEST['tranLoad'];
	$unload	 			= $_REQUEST['tranUnload'];
	$transfer 			= $_REQUEST['tranTransfer'];
	$palot	 			= $_REQUEST['tranPalot'];
	$all	 			= $_REQUEST['tranAll'];
	$whereQ = '';
	$whereQQ = '';	
	//echo rtrim($whereQ); die();
	//$whereQ = '';
	if($all!=''){
		$whereQ = "AND b.WORKTYPEFLAG IN ('Load','Unload', 'Transfer','Palot')"; 
		
		}else{
					if($load != ''){
						$whereQQ .= "'Load',"; 	
					}if($unload != ''){
						$whereQQ .= "'Unload',"; 	
					}if($transfer != ''){
						$whereQQ .= "'Transfer',"; 	
					}if($palot != ''){
						$whereQQ .= "'Palot',"; 	
					}
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
	*/
	$LABOURID 			= $_REQUEST['LABOURID'];
	//$ENTRYDATE_FROM 	= showDateMySQlFormat($_REQUEST['ENTRYDATE']);
	//$ENTRYDATE_TO 		= showDateMySQlFormat($_REQUEST['ENTRYDATE2']);
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
			
	$tableView = "";	
	$tableView .="<table width='70%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:85%; border: 1px dotted #000'>

					  <tr>
                            <td style='text-align:right;' colspan='13'>
                            <a href='javascript:Clickheretoprint()'><img border='0' src='images/print_icon.jpg' width='40' height='26' /></a>                        
                            </td>
                     </tr>
					  <tr>
						<td colspan='9' align='center' valign='middle' style='border: 1px dotted #000'>
							<center><b><font size=5>F N A Group of Company</font></b></center>
							<center>&nbsp;</center>
							<center><b><font size=4> Labour Contact Information </FONT></b></center>
							<center>&nbsp;</center>
							
						</td>
					  </tr>
					  <tr>

						<td colspan='9' align='left' valign='top'>
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

						<td align='center' valign='top' style='font-weight:bold;border: 1px dotted #000'>SL No.</td>

						<td align='center' valign='top'  style='border: 1px dotted #000'>Packing Unit</td>
						
						<td align='center' valign='top'  style='border: 1px dotted #000'>Start Date</td>
						
						<td align='center' valign='top'  style='border: 1px dotted #000'>End Date</td>
						
						<td align='center' valign='top'  style='border: 1px dotted #000'>Chamber To</td>

						<td align='center' valign='top' style='border: 1px dotted #000'>Load Price </td>

						<td align='center' valign='top' style='border: 1px dotted #000'>Unload Price</td>

						<td align='center' valign='top' style='border: 1px dotted #000'>Transfer Price </td>

						<td align='center' valign='top' style='border: 1px dotted #000'>Palot Price </td>
						
						<td align='center' valign='top' style='border: 1px dotted #000'>Shade Price</td>
						
												
					  </tr>";

// Query here.


						$aQuery 	= "SELECT l.LABOURID,
											  l.LABCONTACTID 
										FROM fna_labourcontact l 
										WHERE l.LABOURID = '".$LABOURID."' 
										ORDER BY l.LABOURID ASC
									";
						$aQueryStatement				= mysql_query($aQuery);
						$sl = 1;
						while($aQueryStatementData		= mysql_fetch_array($aQueryStatement)){
							$LABCONTACTID        		= $aQueryStatementData["LABCONTACTID"]; 
						}
							// Package Information View Report Start 	 <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<		
								/*$CATEGORYTYPENAME 	= '';
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
														b.TOTBILLAMOUNT
												FROM 
													fna_labourworkhistory b, fna_productcattype cat, fna_product pn, fna_packingunit punt, fna_packingname pname
												WHERE b.LABOURID = '".$LABOURID."'
												AND cat.PRODCATTYPEID = b.PRODCATTYPEID
												AND pn.PRODUCTID = b.PRODUCTID
												AND b.PRODUCTID = '".$aQueryStatementData['PRODUCTID']."'
												AND b.PACKINGUNITID = punt.PACKINGUNITID
												AND pname.PACKINGNAMEID = punt.PACKINGNAMEID
												
												ORDER BY b.PRODUCTID ASC
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
								
							// Package Information View Report End
							
							$glabalToatalBill = $glabalToatalBill + $TOTBILLAMOUNT ;*/
							
							
							//-----------------------------------------------------------------
							
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
								
							/*$packingNameVal 	= '';
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
								
								$PACKINGUNITID   		= $packingViewQueryStatementData["PACKINGUNITID"];
								$PACKINGNAME   			= $packingViewQueryStatementData["PACKINGNAME"];
								$QVALUE			   		= $packingViewQueryStatementData["QVALUE"];
								$WNAME			   		= $packingViewQueryStatementData["WNAME"];*/
								
								//-----------------------------------------------------------------------------------------
								$LabourContactQuery 	= "
															SELECT
																	lc.LABOURID,
																	lc.LABCONTACTID,
																	lc.STARTDATE,
																	lc.ENDDATE,
																	lc_bkdn.CHAMBERIDFROM,
																	lc_bkdn.CHAMBERIDTO,
																	lc_bkdn.PACKINGUNITID,
																	lc_bkdn.LOADPRICE,
																	lc_bkdn.UNLOADPRICE,
																	lc_bkdn.TRANSFERPRICE,
																	lc_bkdn.SHADEPRICE,
																	lc_bkdn.PALOTPRICE
															FROM
																	fna_labourcontact lc , fna_labourcontact_bkdn lc_bkdn
															WHERE lc.LABCONTACTID = lc_bkdn.LABCONTACTID
															AND lc_bkdn.LABCONTACTID = ".$LABCONTACTID."
															AND lc.LABOURID = ".$LABOURID."
															ORDER BY lc_bkdn.PACKINGUNITID ASC
															
														";
													
									$sv	= 1;
									$LabourContactQueryStatement				= mysql_query($LabourContactQuery);
									while($LabourContactQueryStatementData		= mysql_fetch_array($LabourContactQueryStatement)) {
										
										$STARTDATE		   			= $LabourContactQueryStatementData["STARTDATE"];
										$ENDDATE		   			= $LabourContactQueryStatementData["ENDDATE"];
										$CHAMBERIDTO   				= $LabourContactQueryStatementData["CHAMBERIDTO"];
										$LOADPRICE			   		= $LabourContactQueryStatementData["LOADPRICE"];
										$UNLOADPRICE			   	= $LabourContactQueryStatementData["UNLOADPRICE"];
										$TRANSFERPRICE   			= $LabourContactQueryStatementData["TRANSFERPRICE"];
										$SHADEPRICE			   		= $LabourContactQueryStatementData["SHADEPRICE"];
										$PALOTPRICE			   		= $LabourContactQueryStatementData["PALOTPRICE"];
										$PACKINGUNITID			   	= $LabourContactQueryStatementData["PACKINGUNITID"];
										
									
									
									$ChamberQuery 	= "SELECT 	chm.CHID,
														  		chm.CHNAME 
													FROM fna_chamber chm 
													WHERE chm.CHID = '".$CHAMBERIDFROM."' 
												";
									$ChamberQueryStatement				= mysql_query($ChamberQuery);
									$CHNAME_From = '';
									while($ChamberQueryStatementData	= mysql_fetch_array($ChamberQueryStatement)){
										$CHNAME_From        			= $ChamberQueryStatementData["CHNAME"]; 
								}
								$ChamberQuery_To 	= "SELECT 	chm.CHID,
														  		chm.CHNAME 
													FROM fna_chamber chm 
													WHERE chm.CHID = '".$CHAMBERIDTO."' 
												";
									$ChamberQuery_ToStatement				= mysql_query($ChamberQuery_To);
									$CHNAME_To = '';
									while($ChamberQuery_ToStatementData	= mysql_fetch_array($ChamberQuery_ToStatement)){
										$CHNAME_To	        			= $ChamberQuery_ToStatementData["CHNAME"]; 
								}
								//-----------------------------------------------------------------------------------------
								$packingNameVal 	= '';
								$packingViewQuery 	= "
														SELECT
																pu.PACKINGUNITID,
																pn.PACKINGNAME,
																q.QVALUE,
																w.WNAME
														FROM
																fna_packingunit pu , fna_packingname pn, fna_quantity q, fna_weight w
														WHERE pu.PACKINGUNITID = ".$PACKINGUNITID."
														AND pu.PACKINGNAMEID = pn.PACKINGNAMEID
														AND pu.QID = q.QID
														AND pu.WTID = w.WTID
														ORDER BY
																pu.PACKINGUNITID
														ASC
													";
													
								$sv	= 1;
								$packingViewQueryStatement				= mysql_query($packingViewQuery);
								while($packingViewQueryStatementData	= mysql_fetch_array($packingViewQueryStatement)) {
									
									$PACKINGNAME   			= $packingViewQueryStatementData["PACKINGNAME"];
									$QVALUE			   		= $packingViewQueryStatementData["QVALUE"];
									$WNAME			   		= $packingViewQueryStatementData["WNAME"];
								}
								$Basta_QUANTITY= '';
								$Drum_QUANTITY= '';
								$cortun_QUANTITY= '';
								$Basta_QVALUE = '';
								$Drum_QVALUE = '';
								$Cartoon_QVALUE = '';
										
								
								if ($PACKINGNAME == 'Basta')
								{
									$PackNameSize = "$QVALUE"."-"."$WNAME"."-"."$PACKINGNAME";
									
								}elseif($PACKINGNAME == 'Drum')
								{	
									$PackNameSize = "$QVALUE"."-"."$WNAME"."-"."$PACKINGNAME";
								}else
								{
									$PackNameSize = "$QVALUE"."-"."$WNAME"."-"."$PACKINGNAME";
								}
							
							
						
							
							//-----------------------------------------------------------------

 // Dynamic Row Start

						$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000'>$sl</td>

											<td align='left' valign='top' style='border: 1px dotted #000'>$PackNameSize</td>
					
											<td align='left' valign='top'  style='border: 1px dotted #000'>$STARTDATE</td>
											
											<td align='left' valign='top'  style='border: 1px dotted #000'>$ENDDATE</td>
											
											<td align='left' valign='top'  style='border: 1px dotted #000'>$CHNAME_To</td>
											
											<td align='right' valign='top'  style='border: 1px dotted #000'>$LOADPRICE</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>$UNLOADPRICE </td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>$TRANSFERPRICE</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>$SHADEPRICE</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>$PALOTPRICE</td>
											
											
										</tr>

									 ";

								// Dynamic Row End		  
					$sl++;
					}	
				
				
				

					$tableView .="
					
						<tr>

							<td colspan='10' align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

						</tr>

						
						<tr>

							<td colspan='10' align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

						</tr>
							
						<tr>

							<td colspan='10' align='left' valign='top'>&nbsp;</td>

						</tr>
						<tr>

							<td colspan='10' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='10' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='10' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='10' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='10' align='left' valign='top' >
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

							<td colspan='10' align='left' valign='top' >&nbsp;</td>

						</tr>
						<tr>

							<td colspan='10' align='left' valign='top' >&nbsp;</td>

						</tr>					

					</table>";
	echo $tableView;

?>