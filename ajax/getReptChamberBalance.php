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
	//$CHID				= $_REQUEST['CHID'];
	$ENTRYDATE_FROM 	= showDateMySQlFormat($_REQUEST['ENTRYDATE']);
	$ENTRYDATE_TO 		= showDateMySQlFormat($_REQUEST['ENTRYDATE2']);
	//$CHID				= $_REQUEST['CHID'];
	//$FLOORID			= $_REQUEST['FLOORID'];
	$userId 			= $_REQUEST['userId'];
	/*echo $CHID;
		$con = '';
		if ($CHID == ''){
			$con = '';
		}else{
			$con = "AND CHID='".$CHID."' ";
		}
		
		if($CHID != ''){
			$partySql 	= "
							SELECT CHNAME									
							FROM fna_chamber 
							WHERE CHID = $CHID
						";
			$partySqlStatement				= mysql_query($partySql);
			while($partySqlStatementData	= mysql_fetch_array($partySqlStatement)){
				$CHNAME		        		= $partySqlStatementData["CHNAME"];
			}
		}else{
			$CHNAME = 'All Chamber.';
		}
			
		
		*/
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
							<center><b><font size=4>Chamber Wise Balance Report</FONT></b></center>
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

						<td align='center' valign='top' style='border: 1px dotted #000'>Chamber Name </td>
						
						<td align='center' valign='top' style='border: 1px dotted #000'>Load Qnty</td>
						
						<td align='center' valign='top' style='border: 1px dotted #000'>Transfer Load Qnty</td>
						
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
																
								$aViewQuery 	= 	"SELECT  	SUM(p.LOADQUANTITY) AS LOADQUANTITY,
																SUM(p.UNLOADQUANTITY) AS UNLOADQUANTITY,
																SUM(p.POCKETBALANCE) AS POCKETBALANCE,
																p.PARTYID,
																p.FLOORID,
																p.POCKETID,
																p.PRODUCTID,
																p.PACKINGUNITID,
																p.ENTYRYDATE,
																c.CHNAME, 
																c.CHID
														FROM fna_pocketstock p, fna_chamber c
												   		WHERE c.CHID = p.CHID
														AND p.PROJECTID = '".$PROJECTID."'
														AND p.ENTYRYDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
												   		GROUP BY p.CHID
														ORDER BY p.CHID ASC
													";
								$aViewStatement			= mysql_query($aViewQuery);
								$GLOBAL_LOADQUANTITY		= '';
								$GLOBAL_UNLOADQUANTITY		= '';
								$GLOBAL_BALANCE				= '';
								//$LOADQUANTITY				= '';
								$GLOBAL_TRANS_QNTY			= '';
								$TransferLoad				= '';
								
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
								 $CHNAME_NEW       		= $aViewStatementData["CHNAME"];
								 $CHID_NEW       		= $aViewStatementData["CHID"];
																	
							
							
							$aViewQueryT 	= 	"SELECT  	SUM(UNLOADQUANTITY) AS TransferLoad
														FROM fna_pocketstockdetails
												   		WHERE STATUS = 'transfer'
														AND CHID = '".$CHID_NEW."'
														GROUP BY CHID
														ORDER BY CHID ASC
													";
								$aViewQueryTStatement			= mysql_query($aViewQueryT);
								
								$TransferLoad				= '';
								while($aViewQueryTStatementData	= mysql_fetch_array($aViewQueryTStatement)){ 
								
								 $TransferLoad        		= $aViewQueryTStatementData["TransferLoad"]; 
								// $PRODUCTID       		= $aViewQueryTStatementData["PRODUCTID"];
							}
							
							$GLOBAL_UNLOADQUANTITY	= $GLOBAL_UNLOADQUANTITY + $UNLOADQUANTITY ; 
							$GLOBAL_BALANCE			= $GLOBAL_BALANCE + $POCKETBALANCE ; 
							
							$ActualLoadQnty			= ($UNLOADQUANTITY + $POCKETBALANCE) - $TransferLoad  ; 
							
							$GLOBAL_LOADQUANTITY    = $GLOBAL_LOADQUANTITY + $ActualLoadQnty ; 
							
							$GLOBAL_TRANS_QNTY			= $GLOBAL_TRANS_QNTY + $TransferLoad ; 
								
						$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000' width='10%'>$sl</td>

											<td align='center' valign='top' style='border: 1px dotted #000' width='20%'> $CHNAME_NEW</td>
											
											<td align='center' valign='top' style='border: 1px dotted #000' width='20%'>$ActualLoadQnty </td>
											
											<td align='center' valign='top' style='border: 1px dotted #000' width='20%'>$TransferLoad </td>

											<td align='center' valign='top'  style='border: 1px dotted #000' width='20%'>$UNLOADQUANTITY</td>
											
											<td align='center' valign='top'  style='border: 1px dotted #000' width='30%'>$POCKETBALANCE</td>
					
											
										</tr>

									 ";
				
								$sl++;
					  
						}
					
				

					$tableView .="

						<tr style='font-weight:bold;'>

							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>Total : </td>

							<td align='center' valign='top' style='border: 1px dotted #000'>$GLOBAL_LOADQUANTITY </td>
							
							<td align='center' valign='top' style='border: 1px dotted #000'>$GLOBAL_TRANS_QNTY </td>

							<td align='center' valign='top' style='border: 1px dotted #000'>$GLOBAL_UNLOADQUANTITY</td>
							
							<td align='center' valign='top' style='border: 1px dotted #000'>$GLOBAL_BALANCE	</td>

						</tr>
						
						<tr>

							<td colspan='6' align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

						</tr>";
						
						
							
						//$Global_Balance_Amount	= $glabalBill - $Gloabal_Receive_Amount ;
						
						
						$tableViewFooter ="";
						$tableViewFooter .="<table width='80%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:85%; border: 1px dotted #000'>
						<tr>

							<td colspan='6' align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

						</tr>
							
						<tr>

							<td colspan='6' align='left' valign='top'>&nbsp;</td>

						</tr>
						<tr>

							<td colspan='6' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='6' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='6' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='6' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='6' align='left' valign='top' >
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

							<td colspan='6' align='left' valign='top' >&nbsp;</td>

						</tr>
						<tr>

							<td colspan='6' align='left' valign='top' >&nbsp;</td>

						</tr>					

					</table>";
	echo $tableView;
	//echo $tableViewReceive;
	echo $tableViewFooter ;

?>