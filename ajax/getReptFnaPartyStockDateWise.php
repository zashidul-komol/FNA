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
	$userId 			= $_REQUEST['userId'];
	$con = '';
	if ($PRODCATTYPEID == 'All'){
		$con = '';
	}else
	{
		$con = "AND plubkdn.PRODCATTYPEID='".$PRODCATTYPEID."' ";
		}

		$Last_Date = date_create($ENTRYDATE_TO);
		date_sub($Last_Date, date_interval_create_from_date_string('1 days'));
		$LastDay = date_format($Last_Date, 'Y-m-d');

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
                            <td style='text-align:right;' colspan='18'>
                            <a href='javascript:Clickheretoprint()'><img border='0' src='images/print_icon.jpg' width='40' height='26' /></a>                        
                            </td>
                     </tr>
					  <tr>
						<td colspan='18' align='center' valign='middle' style='border: 1px dotted #000'>
							<center><b><font size=5>F N A Group Of Company</font></b></center>
							<center>&nbsp;</center>
							<center><b><font size=4>Date Wise Product Stock Report</FONT></b></center>
							<center>&nbsp;</center>
							<center><b><font size=2>Date : $ENTRYDATE_FROM to $ENTRYDATE_TO </font></b></center>
						</td>
					  </tr>
					  <tr>

						<td colspan='18' align='left' valign='top'>
							<table width='100%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:100%;'>
								  <tr>
								
									<td width='14%' align='left' valign='top'>Party Name<b></td>
									<td width='1%' align='center' valign='top'>:</td>
									<td width='34%' align='left' valign='top'> $PARTYNAME</td>
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
								
									<td align='left' valign='top'>Party Father Name</td>
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

						<td align='center' valign='middle' style='font-weight:bold;border: 1px dotted #000'>SL No.</td>

						<td align='center' valign='middle'  style='border: 1px dotted #000'>Date</td>
						
						<td align='center' valign='middle'  style='border: 1px dotted #000'>Product Category</td>
                        
                        <td align='center' valign='middle'  style='border: 1px dotted #000'>Product Name</td>

						<td align='center' valign='middle' style='border: 1px dotted #000'>Unit</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Receive Qnty</td>

						<td align='center' valign='middle' style='border: 1px dotted #000'>Delivery Qnty</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Balance Qnty</td>
						
					</tr>";

// Query here.

						//$TOTAL_RECEIVE_QNTY_KG ='';
						$PREV_KG_LOAD_TODAY = '';
						$PREV_KG			= '';
						$PREV_KG_UNLOAD		= '';
						$PREV_KG_UNLOAD_TODAY = '';
						$PACKINGNAME_LOAD	=	'';
						
						$basicQuery 	= "SELECT distinct plubkdn.PRODUCTID,
													  plu.PARTYID
												FROM fna_productloadunloadbkdn plubkdn, fna_productloadunload plu 
												WHERE plu.PRODUCTLOADUNLOADID = plubkdn.PRODUCTLOADUNLOADID
												AND plu.PARTYID = '".$PARTYID."' 
												{$con}
												AND plu.PROJECTID = '".$PROJECTID."'
												AND plu.SUBPROJECTID = '".$SUBPROJECTID."'
												AND  plu.ENTRYDATE between '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."' 
												ORDER BY plubkdn.PRODUCTID ASC
											"; 
						$basicQueryStatement			= mysql_query($basicQuery);
						$glabalToatalBill = 0;
						$RECEIVEAMOUNT ='';
						$QUANTITY	   = 0;
						$i = 0;
						while($basicQueryStatementData	= mysql_fetch_array($basicQueryStatement)){
							
							$BASICPRODUCTID_ARRAY[] = $basicQueryStatementData['PRODUCTID'];
							$i++;
							
						}
						
						$BASICPRODUCTID_ARRAY_UNIQUE = array_unique($BASICPRODUCTID_ARRAY);
						$GLOBALGRANDTOTALRECEIVEQNTY = '';
						$GLOBALGRANDTOTALRECEIVEKG = '';
						$GLOBALGRANDTOTALDELIVERYQNTY = '';
						$GLOBALGRANDTOTALDELIVERYKG = '';		
						foreach($BASICPRODUCTID_ARRAY_UNIQUE as $individualProdId){
							
							$ProdName_Qry		= "SELECT 	p.PRODUCTNAME
												FROM fna_product p 
												WHERE p.PRODUCTID = '".$individualProdId."'
											";
							$ProdName_QryStatement					= mysql_query($ProdName_Qry);
							while($ProdName_QryStatementData		= mysql_fetch_array($ProdName_QryStatement)){	
								$PRODUCTNAME_NEW					= $ProdName_QryStatementData['PRODUCTNAME'];
							}
							
							$CATEGORYTYPENAME		 	= '';
							$PRODUCTNAME		 		= '';
							$PACKINGUNITID			   	= '';
							
							
							$UnloadViewQuery 	= "SELECT 
												  		plu.PARTYID,
														plu.ENTRYDATE,
														plu.RECEIVENUMBER,
														plu.DELIVERYCHALLANNUMBER,
														pct.CATEGORYTYPENAME,
														p.PRODUCTNAME,
														plubkdn.PACKINGUNITID,
														plubkdn.QUANTITY,
														plubkdn.WTQNTY
												FROM 
													fna_productloadunload plu, fna_productloadunloadbkdn plubkdn, fna_productcattype pct, fna_product p
												WHERE plu.PRODUCTLOADUNLOADID = plubkdn.PRODUCTLOADUNLOADID 
												AND plubkdn.PRODCATTYPEID = pct.PRODCATTYPEID 
												AND plubkdn.PRODUCTID = p.PRODUCTID
												AND plu.PARTYID = '".$PARTYID."'
												AND plu.PROJECTID = '".$PROJECTID."'
												AND plu.SUBPROJECTID = '".$SUBPROJECTID."'
												AND plu.STATUS != 'Transfer'
												{$con}
												AND plubkdn.PRODUCTID = '".$individualProdId."' 
												AND plu.ENTRYDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
												ORDER BY plu.ENTRYDATE ASC";
								$UnloadViewQueryStatement			= mysql_query($UnloadViewQuery);
								
								$tableView .="<tr style='font-weight:bold;'>
												<td colspan='8' align='left' valign='top' style='border: 1px dotted #000'>Name of Product : $PRODUCTNAME_NEW</td>
											</tr>
								";
								$sl = 1;
						
								$QUANTITY	   		= 0;
								$QUANTITY_LOAD		= 0;
								$QUANTITY_UNLOAD	= 0;
								$QUANTITY_KG_LOAD	= 0;
								$BALANCE_QNTY		= 0;
								$BALANCE_KG			= 0;
								$Grand_Total_Load	= 0;
								$Grand_Total_UnLoad	= 0;
								$Grand_Total_Load_KG	= 0;
								$Grand_Total_UnLoad_KG	= 0;
								while($UnloadViewQueryStatementData	= mysql_fetch_array($UnloadViewQueryStatement)){ 
								
								 $PARTYID		        			= $UnloadViewQueryStatementData["PARTYID"]; 
								 $ENTRYDATE		        			= $UnloadViewQueryStatementData["ENTRYDATE"];
								 $RECEIVENUMBER		        		= $UnloadViewQueryStatementData["RECEIVENUMBER"];
								 $DELIVERYCHALLANNUMBER		     	= $UnloadViewQueryStatementData["DELIVERYCHALLANNUMBER"];  
								 $CATEGORYTYPENAME		      		= $UnloadViewQueryStatementData["CATEGORYTYPENAME"]; 
								 $PRODUCTNAME		       			= $UnloadViewQueryStatementData["PRODUCTNAME"]; 
								 $PACKINGUNITID			       		= $UnloadViewQueryStatementData["PACKINGUNITID"]; 	
								 $QUANTITY		        			= $UnloadViewQueryStatementData["QUANTITY"];
								 $WTQNTY		        			= $UnloadViewQueryStatementData["WTQNTY"];
								
								
								$packingNameVal 	= '';
								$packingViewQuery_UNLOAD 	= "
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
															pu.PACKINGUNITID
													ASC
												";
												
							$sv	= 1;
							$packingViewQuery_UNLOADStatement			= mysql_query($packingViewQuery_UNLOAD);
							while($packingViewQuery_UNLOADStatementData	= mysql_fetch_array($packingViewQuery_UNLOADStatement)) {
								
								$PACKINGUNITID			   	= $packingViewQuery_UNLOADStatementData["PACKINGUNITID"];
								$PACKINGNAME		   		= $packingViewQuery_UNLOADStatementData["PACKINGNAME"];
								$QVALUE					   	= $packingViewQuery_UNLOADStatementData["QVALUE"];
								$WNAME					   	= $packingViewQuery_UNLOADStatementData["WNAME"];
								
								
																
							}
							
							
								//$BALANCE_QNTY 	= $TOTAL_RECEIVE_QNTY - $TOTAL_DELIVERY_QNTY ; 
								//$BALANCE_KG		= $TOTAL_RECEIVE_QNTY_KG - $TOTAL_DELIVERY_QNTY_KG ; 
							
							
							//Unload End ----------------------------------------------------------------------------------
							$AVG_UNIT_KG	= '';
							$AVG_UNIT		= '';
							if($QUANTITY != 0){
							
							if($DELIVERYCHALLANNUMBER == ''){
								$QUANTITY_LOAD		= $QUANTITY;
								//$QUANTITY_KG_LOAD 	= $QUANTITY_LOAD * $QVALUE ;
								$QUANTITY_KG_LOAD 	= $WTQNTY ;
								
								
								$QUANTITY_UNLOAD	= '';
								$QUANTITY_KG_UNLOAD	= '';
								
								$BALANCE_QNTY 	= $BALANCE_QNTY + $QUANTITY_LOAD ; 
								$BALANCE_KG		= $BALANCE_KG + $QUANTITY_KG_LOAD ; 
								
									
								}elseif($RECEIVENUMBER == ''){
									
								$QUANTITY_UNLOAD	= $QUANTITY;
								//$QUANTITY_KG_UNLOAD = $QUANTITY_UNLOAD * $QVALUE ;
								$QUANTITY_KG_UNLOAD = $WTQNTY ;
								
								$QUANTITY_LOAD		= '';
								$QUANTITY_KG_LOAD	= '';
								
								$BALANCE_QNTY 			= $BALANCE_QNTY - $QUANTITY_UNLOAD; 
								$BALANCE_KG				= $BALANCE_KG - $QUANTITY_KG_UNLOAD; 
								 
								
								
							}
							
							$Grand_Total_Load		= $Grand_Total_Load + $QUANTITY_LOAD ; 
							$Grand_Total_UnLoad		= $Grand_Total_UnLoad + $QUANTITY_UNLOAD ;
							$Grand_Total_Load_KG	= $Grand_Total_Load_KG + $QUANTITY_KG_LOAD ;
							
								//$BALANCE_QNTY 	= $BALANCE_QNTY + $QUANTITY_LOAD ; 
								//$BALANCE_KG		= $TOTAL_RECEIVE_QNTY_KG - $TOTAL_DELIVERY_QNTY_KG ; 
							
							 // Dynamic Row Start
							 $AVG_UNIT				= number_format(($Grand_Total_Load_KG / $Grand_Total_Load),2) ; 
							 $QNTY_UNLOAD_KG		= $AVG_UNIT * $QUANTITY_UNLOAD ; 
							 $Grand_Total_UnLoad_KG	= $Grand_Total_UnLoad_KG + $QNTY_UNLOAD_KG ;
							 $Grand_Total_Qnty		= $Grand_Total_Load - $Grand_Total_UnLoad ; 
							 
							 
							 $GLOBALGRANDTOTALRECEIVEQNTY	= $GLOBALGRANDTOTALRECEIVEQNTY + $QUANTITY_LOAD ; 
							 $GLOBALGRANDTOTALRECEIVEKG		= $GLOBALGRANDTOTALRECEIVEKG + $QUANTITY_KG_LOAD ; 
							 $GLOBALGRANDTOTALDELIVERYQNTY	= $GLOBALGRANDTOTALDELIVERYQNTY + $QUANTITY_UNLOAD ; 
							 $GLOBALGRANDTOTALDELIVERYKG	= $GLOBALGRANDTOTALDELIVERYKG + $QNTY_UNLOAD_KG ; 
							 
							//$UNIT					= $QUANTITY_KG_LOAD / $QUANTITY_LOAD ; 
							//$AVG_Unit				= $QUANTITY_UNLOAD * $UNIT ; 

						$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000'>$sl</td>

											<td align='left' valign='top' style='border: 1px dotted #000'> $ENTRYDATE</td>
											
											<td align='left' valign='top' style='border: 1px dotted #000'> $CATEGORYTYPENAME</td>
					
											<td align='left' valign='top'  style='border: 1px dotted #000'>$PRODUCTNAME</td>
											
											<td align='left' valign='top'  style='border: 1px dotted #000'>$PACKINGNAME</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>$QUANTITY_LOAD</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>$QUANTITY_UNLOAD</td>

											<td align='right' valign='top' style='border: 1px dotted #000'>$BALANCE_QNTY</td>
					
											
										</tr>
										

									 ";
							}// if($QUANTITY != 0){
								// Dynamic Row End		  
						$sl++;
					}// while($UnloadViewQueryStatementData	
					
					$Loop_Total		= $Grand_Total_Load + $Grand_Total_UnLoad ; 
					if($Loop_Total != 0 ){
					$tableView .="<tr style='font-weight:bold;'>

											<td colspan='5' align='right' valign='top' style='border: 1px dotted #000'>Total:</td>
				
											<td align='right' valign='top' style='border: 1px dotted #000'>$Grand_Total_Load</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>$Grand_Total_UnLoad</td>
				
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Grand_Total_Qnty,2)."</td>
				
											
										</tr>";
					}
				
				}

					$tableView .="

						<tr style='font-weight:bold;'>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top'  style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='RIGHT' valign='top' style='border: 1px dotted #000'>GRAND TOTAL:</td>

							<td align='RIGHT' valign='top' style='border: 1px dotted #000'>".number_format($GLOBALGRANDTOTALRECEIVEQNTY,2)."</td>
							
							<td align='RIGHT' valign='top' style='border: 1px dotted #000'>".number_format($GLOBALGRANDTOTALDELIVERYQNTY,2)."</td>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

						</tr>
						<tr>

							<td colspan='8' align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

						</tr>
							
						<tr>

							<td colspan='8' align='left' valign='top'>&nbsp;</td>

						</tr>
						<tr>

							<td colspan='8' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='8' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='8' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='8' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='8' align='left' valign='top' >
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

							<td colspan='8' align='left' valign='top' >&nbsp;</td>

						</tr>
						<tr>

							<td colspan='8' align='left' valign='top' >&nbsp;</td>

						</tr>					

					</table>";
	echo $tableView;

?>