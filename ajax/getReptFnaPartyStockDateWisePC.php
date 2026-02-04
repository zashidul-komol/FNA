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

	$PRODCATTYPEID		= $_REQUEST['PRODCATTYPEID'];
	$ENTRYDATE_FROM 	= showDateMySQlFormat($_REQUEST['ENTRYDATE']);
	$ENTRYDATE_TO 		= showDateMySQlFormat($_REQUEST['ENTRYDATE2']);
	$userId 			= $_REQUEST['userId'];
	$con = '';
	if ($PRODCATTYPEID == 'All'){
		$con = '';
	}else
	{
		$con = "AND PRODCATTYPEID='".$PRODCATTYPEID."' ";
		}

		$Last_Date = date_create($ENTRYDATE_TO);
		date_sub($Last_Date, date_interval_create_from_date_string('1 days'));
		$LastDay = date_format($Last_Date, 'Y-m-d');

		
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
							<center><b><font size=4>Date Wise PC Load Report</FONT></b></center>
							<center>&nbsp;</center>
							<center><b><font size=2>Date : $ENTRYDATE_FROM to $ENTRYDATE_TO </font></b></center>
						</td>
					  </tr>
					  <tr>

						

					 <tr style='font-weight:bold;'>

						<td align='center' valign='middle' style='font-weight:bold;border: 1px dotted #000'>SL No.</td>

						<td align='center' valign='middle'  style='border: 1px dotted #000'>Date</td>
						
						<td align='center' valign='middle'  style='border: 1px dotted #000'>Party Name</td>
                        
                        <td align='center' valign='middle'  style='border: 1px dotted #000'>Category</td>

						<td align='center' valign='middle' style='border: 1px dotted #000'>Product Name</td>

						<td align='center' valign='middle' style='border: 1px dotted #000'>Packing Name</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Packing Unit</td>

						<td align='center' valign='middle' style='border: 1px dotted #000'>Load Qnty</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Unload Qnty</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Balance Qnty</td>
						
						
					  </tr>";

// Query here.
							$UnloadViewQuery 	= "SELECT 
												  		pc.PARTYID,
														pc.PRODCATTYPEID,
														pc.PACKINGUNITID,
														pc.PRODUCTID,
														pc.LOAD_QUANTITY,
														pc.UNLOAD_QUANTITY,
														pc.ENTRYDATE,
														pr.PRODUCTNAME,
														p.PARTYNAME
												FROM 
													fna_unloadtopc pc, fna_party p, fna_product pr 
												WHERE pc.PROJECTID = '".$PROJECTID."'
												AND pc.SUBPROJECTID = '".$SUBPROJECTID."'
												AND p.PARTYID = pc.PARTYID
												AND pr.PRODUCTID = pc.PRODUCTID
												AND pc.ENTRYDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
												ORDER BY pc.ENTRYDATE ASC";
								$UnloadViewQueryStatement			= mysql_query($UnloadViewQuery);
								$sl = 1;
								$Toatal_Load_Qnty					= 0;
								$Toatal_UnLoad_Qnty					= 0 ; 
								$Toatal_Load_Qnty					= 0 ;
								
								while($UnloadViewQueryStatementData	= mysql_fetch_array($UnloadViewQueryStatement)){ 
								
								 $PARTYID		        			= $UnloadViewQueryStatementData["PARTYID"]; 
								 $ENTRYDATE		        			= $UnloadViewQueryStatementData["ENTRYDATE"];
								 $PRODCATTYPEID			      		= $UnloadViewQueryStatementData["PRODCATTYPEID"]; 
								 $PARTYNAME			       			= $UnloadViewQueryStatementData["PARTYNAME"]; 
								 $PRODUCTNAME		       			= $UnloadViewQueryStatementData["PRODUCTNAME"]; 
								 $PACKINGUNITID			       		= $UnloadViewQueryStatementData["PACKINGUNITID"]; 	
								 $LOAD_QUANTITY	        			= $UnloadViewQueryStatementData["LOAD_QUANTITY"];
								 $UNLOAD_QUANTITY        			= $UnloadViewQueryStatementData["UNLOAD_QUANTITY"];
								
								
								
								$Balance_Qnty						= $LOAD_QUANTITY - $UNLOAD_QUANTITY ; 
								
								$Toatal_Load_Qnty					= $Toatal_Load_Qnty + $LOAD_QUANTITY ;
								$Toatal_UnLoad_Qnty					= $Toatal_UnLoad_Qnty + $UNLOAD_QUANTITY ; 
								$Toatal_Load_Qnty					= $Toatal_Load_Qnty + $Balance_Qnty ;
								
								
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
							
							/*$QidQuery = "
												SELECT
														QVALUE
												FROM
														fna_quantity 
														WHERE QID = {$QID}
												";
							$QidQueryStatement				= mysql_query($QidQuery);
							while($QidQueryStatementData	= mysql_fetch_array($QidQueryStatement)) {
								$QVALUE   		= $QidQueryStatementData["QVALUE"];
								
							}
							
							$wtidQuery = "
												SELECT
														WNAME
												FROM
														fna_weight 
														WHERE WTID = {$WTID}
												";
							$wtidQueryStatement				= mysql_query($wtidQuery);
							while($wtidQueryStatementData	= mysql_fetch_array($wtidQueryStatement)) {
								$WNAME   		= $wtidQueryStatementData["WNAME"];
								
							}
					*/
					
							$packingUnitList  = $QVALUE."-".$WNAME;
							
							
								//$BALANCE_QNTY 	= $TOTAL_RECEIVE_QNTY - $TOTAL_DELIVERY_QNTY ; 
								//$BALANCE_KG		= $TOTAL_RECEIVE_QNTY_KG - $TOTAL_DELIVERY_QNTY_KG ; 
							
							
							//Unload End ----------------------------------------------------------------------------------
							$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000'>$sl</td>
											
											<td align='center' valign='top' style='border: 1px dotted #000'>$ENTRYDATE</td>

											<td align='left' valign='top' style='border: 1px dotted #000'> $PARTYNAME</td>
											
											<td align='center' valign='top' style='border: 1px dotted #000'> $PRODUCTNAME</td>
					
											<td align='center' valign='top'  style='border: 1px dotted #000'>$PRODUCTNAME</td>
											
											<td align='center' valign='top'  style='border: 1px dotted #000'>$PACKINGNAME</td>
											
											<td align='center' valign='top' style='border: 1px dotted #000'>$packingUnitList</td>
																
											<td align='center' valign='top' style='border: 1px dotted #000'>$LOAD_QUANTITY</td>
					
											<td align='center' valign='top' style='border: 1px dotted #000'>$UNLOAD_QUANTITY</td>

											<td align='center' valign='top' style='border: 1px dotted #000'>$Balance_Qnty</td>
					
											
										</tr>
										
								
									 ";
									 
									 $sl++;
								// Dynamic Row End		  
					}

					$tableView .="

						<tr style='font-weight:bold;'>

							<td colspan='7' align='right' valign='top' style='border: 1px dotted #000'>Total:</td>
							
							<td align='center' valign='top' style='border: 1px dotted #000'>$Toatal_Load_Qnty</td>

							<td align='center' valign='top'  style='border: 1px dotted #000'>$Toatal_UnLoad_Qnty</td>

							<td align='center' valign='top' style='border: 1px dotted #000'>$Toatal_Load_Qnty</td>

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