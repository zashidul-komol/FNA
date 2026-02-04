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
						<td colspan='11' align='center' valign='middle' style='border: 1px dotted #000'>
							<center><b><font size=5>F N A Group Of Company</font></b></center>
							<center>&nbsp;</center>
							<center><b><font size=4>Category Wise Balance Report</FONT></b></center>
							<center>&nbsp;</center>
							<center><b><font size=2>Date : ".showDateMySQlFormat($ENTRYDATE_FROM)." to ".showDateMySQlFormat($ENTRYDATE_TO)." </font></b></center>
						</td>
					  </tr>
					  <tr>

						<td colspan='11' align='left' valign='top'>
							<table width='100%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:100%;'>
								  <tr>
								
									<td width='14%' align='left' valign='top'>Party Name<b></td>
									<td width='1%' align='center' valign='top'>:</td>
									<td width='34%' align='left' valign='top'> $PARTYNAME</td>
									<td width='18%' align='right' valign='top'>&nbsp;</td>
									<td width='1%' align='center' valign='top'>&nbsp;</td>
									<td width='20%' align='right' valign='top'>Product Category</td>
									<td width='1%' align='center' valign='top'>:</td>
									<td align='left' valign='top'>$PROD_CATEGORYTYPENAME</td>
								
								  </tr>
								
								  <tr>
								
									<td align='left' valign='top'>Address</td>
									<td align='center' valign='top'>:</td>
								
									<td align='left' valign='top'> $ADDRESS </td>
									<td align='right' valign='top'>&nbsp;</td>
									<td align='center' valign='top'>&nbsp;</td>
									<td align='right' valign='top'>&nbsp;</td>
									<td width='1%' align='center' valign='top'>&nbsp;</td>
									<td align='left' valign='top'> &nbsp;</td>
								
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

						<td align='center' valign='top' style='font-weight:bold;border: 1px dotted #000'>SL No.</td>

						<td align='center' valign='top' style='border: 1px dotted #000'>Category</td>
						
						<td align='center' valign='top' style='border: 1px dotted #000'>Product name </td>
						
						<td align='center' valign='top' style='border: 1px dotted #000'>Packing Unit</td>

						<td align='center' valign='top' style='border: 1px dotted #000'>Chamber</td>

						<td align='center' valign='top' style='border: 1px dotted #000'>Floor</td>

						<td align='center' valign='top' style='border: 1px dotted #000'>Pocket</td>
						
						<td align='center' valign='top' style='border: 1px dotted #000'>Load Qnty</td>
						
						<td align='center' valign='top' style='border: 1px dotted #000'>Transfer Load</td>
						
						<td align='center' valign='top' style='border: 1px dotted #000'>Unload Qnty</td>
						
						<td align='center' valign='top' style='border: 1px dotted #000'>Balance Qnty</td>
						
					</tr>";

// Query here.
						
							
						
								$sl 			= 1;
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
								
								
								$aViewQuery 	= "SELECT * FROM fna_pocketstock
												   WHERE PARTYID = '".$PARTYID."'
													AND PROJECTID = '".$PROJECTID."'
													AND SUBPROJECTID = '".$SUBPROJECTID."'
													AND PRODCATTYPEID = '".$PRODCATTYPEID."'
													AND ENTYRYDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
													ORDER BY ENTYRYDATE ASC
												";
								$aViewStatement			= mysql_query($aViewQuery);
								$GLOBAL_LOADQUANTITY		= '';
								$GLOBAL_UNLOADQUANTITY		= '';
								$GLOBAL_BALANCE				= '';
								$GLOBAL_TRANS_QNTY			= '';
								while($aViewStatementData	= mysql_fetch_array($aViewStatement)){ 
								
								 $PARTYID        		= $aViewStatementData["PARTYID"]; 
								 $ENTRYSERIALNOID  		= $aViewStatementData["ENTRYSERIALNOID"]; 
								 $PRODUCTID       		= $aViewStatementData["PRODUCTID"];
								 $CHALLANNOSR     		= $aViewStatementData["CHALLANNO"];
								 $PACKINGUNITID    		= $aViewStatementData["PACKINGUNITID"];  
								 $LOADQUANTITY     		= $aViewStatementData["LOADQUANTITY"];
								 $UNLOADQUANTITY      	= $aViewStatementData["UNLOADQUANTITY"]; 
								 $POCKETBALANCE   		= $aViewStatementData["POCKETBALANCE"]; 	
								 $CHID			        = $aViewStatementData["CHID"];
								 $FLOORID		        = $aViewStatementData["FLOORID"];
								 $POCKETID		        = $aViewStatementData["POCKETID"];
								 $MANUFACTUREDATE       = $aViewStatementData["MANUFACTUREDATE"];
								 $EXPIREDATE	        = $aViewStatementData["EXPIREDATE"];
								
								$aViewQueryT 	= 	"SELECT  UNLOADQUANTITY AS TransferLoad
														FROM fna_pocketstockdetails
												   		WHERE STATUS = 'transfer'
														AND FLOORID = '".$FLOORID."'
														AND CHID='".$CHID."'
														AND POCKETID = '".$POCKETID."'
														
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
								
								$GLOBAL_TRANS_QNTY		= $GLOBAL_TRANS_QNTY + $TransferLoad ; 
								
								//$GLOBAL_LOADQUANTITY    = $GLOBAL_LOADQUANTITY + $LOADQUANTITY ; 
								//$GLOBAL_UNLOADQUANTITY	= $GLOBAL_UNLOADQUANTITY + $UNLOADQUANTITY ; 
								//$GLOBAL_BALANCE			= $GLOBAL_BALANCE + $POCKETBALANCE ; 					
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
							
						$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000' width='5%'>$sl</td>

											<td align='center' valign='top' style='border: 1px dotted #000' width='10%'>$PROD_CATEGORYTYPENAME</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000' width='15%'> $PRODUCTNAME</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000' width='10%'> $NewPackingName </td>
					
											<td align='center' valign='top' style='border: 1px dotted #000' width='10%'>$CHNAME</td>
					
											<td align='center' valign='top' style='border: 1px dotted #000' width='10%'>$FLOORNAME</td>
					
											<td align='center' valign='top' style='border: 1px dotted #000' width='10%'>$POCKETNAME </td>
											
											<td align='center' valign='top' style='border: 1px dotted #000' width='10%'>$ActualLoadQnty </td>
											
											<td align='center' valign='top' style='border: 1px dotted #000' width='10%'>$TransferLoad </td>

											<td align='center' valign='top' style='border: 1px dotted #000' width='10%'>$UNLOADQUANTITY</td>
					
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

							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>Total : </td>

							<td align='center' valign='top' style='border: 1px dotted #000'>$GLOBAL_LOADQUANTITY </td>
							
							<td align='center' valign='top' style='border: 1px dotted #000'>$GLOBAL_TRANS_QNTY </td>

							<td align='center' valign='top' style='border: 1px dotted #000'>$GLOBAL_UNLOADQUANTITY</td>
							
							<td align='center' valign='top' style='border: 1px dotted #000'>$GLOBAL_BALANCE	</td>
							
						</tr>
						
						<tr>

							<td colspan='11' align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

						</tr>";
						
						
							
						//$Global_Balance_Amount	= $glabalBill - $Gloabal_Receive_Amount ;
						
						
						$tableViewFooter ="";
						$tableViewFooter .="<table width='80%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:85%; border: 1px dotted #000'>
						<tr>

							<td colspan='11' align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

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