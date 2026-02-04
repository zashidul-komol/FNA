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
	$PURCHASEDATE_FROM 	= showDateMySQlFormat($_REQUEST['ENTRYDATE']);
	$PURCHASEDATE_TO	= showDateMySQlFormat($_REQUEST['ENTRYDATE2']);
	$userId 			= $_REQUEST['userId'];
	
		/*$Last_Date = date_create($ENTRYDATE_TO);
		date_sub($Last_Date, date_interval_create_from_date_string('1 days'));
		$LastDay = date_format($Last_Date, 'Y-m-d');*/

		//Ministry/Division and Project/Programme Name View Report Start				
	 	$projectSql 	= "
							SELECT  p.PROJECTNAME											
							FROM fna_project p
							WHERE p.PROJECTID = '".$PROJECTID."'
							
						";
			$projectSqlStatement				= mysql_query($projectSql);
			while($projectSqlStatementData		= mysql_fetch_array($projectSqlStatement)){
				$PROJECTNAME        			= $projectSqlStatementData["PROJECTNAME"];
				
			}
			
			//Ministry/Division and Project/Programme Name View Report End
			
	$tableView = "";	
	$tableView .="<table width='70%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:85%; border: 1px dotted #000'>
						<tr>
                            <td style='text-align:right;' colspan='18'>
                            <a href='javascript:Clickheretoprint()'><img border='0' src='images/print_icon.jpg' width='40' height='26' /></a>                        
                            </td>
                     </tr>
					  <tr>
						<td colspan='18' align='center' valign='middle' style='border: 1px dotted #000'>
							<center><b><font size=5>F N A Group Of Company</font></b></center>
							<center>&nbsp;</center>
							<center><b><font size=4>Feed Production Report</FONT></b></center>
							<center>&nbsp;</center>
							<center><b><font size=2>Date : $PURCHASEDATE_FROM to $PURCHASEDATE_TO </font></b></center>
						</td>
					  </tr>
					  <tr>

						<td colspan='18' align='left' valign='top'>
							<table width='100%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:100%;'>
								  <tr>
								
									<td width='14%' align='left' valign='top'>Project  Name<b></td>
									<td width='1%' align='center' valign='top'>:</td>
									<td width='34%' align='left' valign='top'><font size='+1'> $PROJECTNAME</font></td>
									<td width='18%' align='right' valign='top'>&nbsp;</td>
									<td width='1%' align='center' valign='top'>&nbsp;</td>
									<td width='20%' align='left' valign='top'>&nbsp;</td>
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
					  ";

// Query here.			
										

						$ProductionQuery 	= "SELECT prd.FOODID,
												  prd.PRODUCTIONID,
												  fi.FOODNAME
												FROM feed_production prd, feed_fooditem fi 
												WHERE prd.FOODID = fi.FOODID
												AND prd.PROJECTID 	= '".$PROJECTID."'
												AND prd.SUBPROJECTID 	= '".$SUBPROJECTID."'
												AND prd.PRODUCTIONDATE BETWEEN '".$PURCHASEDATE_FROM."' AND '".$PURCHASEDATE_TO."'
											"; 
						$ProductionQueryStatement				= mysql_query($ProductionQuery);
						$Grand_Total_Taka = 0;
						while($ProductionQueryStatementData		= mysql_fetch_array($ProductionQueryStatement)){	
							$FOODID								= $ProductionQueryStatementData['FOODID'];
							$PRODUCTIONID						= $ProductionQueryStatementData['PRODUCTIONID'];
							$FOODNAME							= $ProductionQueryStatementData['FOODNAME'];
							
							$tableView .="<tr style='font-weight:bold;'>
											<td colspan='6' align='left' valign='top' style='border: 1px dotted #000'>Name of Feed :  $FOODNAME</td>

										</tr>
										<tr>
											<td colspan='6' align='center' valign='middle'  style='border: 1px dotted #000'>&nbsp;</td>
										</tr>
										<tr style='font-weight:bold;'>

											<td align='center' valign='middle' style='font-weight:bold;border: 1px dotted #000'>SL No.</td>
					
											<td align='center' valign='middle'  style='border: 1px dotted #000'>Product Name</td>
					
											<td align='center' valign='middle'  style='border: 1px dotted #000'>Quantity</td>
											
											<td align='center' valign='middle'  style='border: 1px dotted #000'>Unit</td>
											
											<td align='center' valign='middle'  style='border: 1px dotted #000'>Unit Price</td>
											
										   <td align='center' valign='middle' style='border: 1px dotted #000'>Total Taka</td>
											
										</tr> 
										
										

									 ";
							
							$production_bkdn_qry	= "SELECT 	bkdn.PRODUCTIONID,
																bkdn.PRODUCTID,
																bkdn.QUANTITY,
																bkdn.WTID,
																bkdn.PRICE, 
																p.PRODUCTNAME,
																wt.WNAME 
															FROM feed_production_bkdn bkdn, fna_product p, fna_weight wt 
															WHERE bkdn.PRODUCTID = p.PRODUCTID
															AND bkdn.WTID = wt.WTID
															AND bkdn.PRODUCTIONID	= '".$PRODUCTIONID."'
														";
							$production_bkdn_qryStatement			= mysql_query($production_bkdn_qry);
							$SL = 1;
							$global_totQnty	= 0;
							$global_totTaka = 0;
							$UnitPrice = 0;
							 
							while($production_bkdn_qryStatementData	= mysql_fetch_array($production_bkdn_qryStatement)){	
								$PRODUCTID							= $production_bkdn_qryStatementData['PRODUCTID'];
								$PRODUCTIONID						= $production_bkdn_qryStatementData['PRODUCTIONID'];
								$QUANTITY							= $production_bkdn_qryStatementData['QUANTITY'];
								$WTID								= $production_bkdn_qryStatementData['WTID'];
								$PRICE								= $production_bkdn_qryStatementData['PRICE'];
								$PRODUCTNAME						= $production_bkdn_qryStatementData['PRODUCTNAME'];
								$WNAME								= $production_bkdn_qryStatementData['WNAME'];
						
						$UnitPrice		= $PRICE / $QUANTITY ; 
						
						$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000'>$SL</td>

											<td align='center' valign='top'  style='border: 1px dotted #000'>$PRODUCTNAME</td>
											
											<td align='center' valign='top' style='border: 1px dotted #000'>".number_format($QUANTITY,4)."</td>

											<td align='center' valign='top' style='border: 1px dotted #000'>$WNAME</td>
											
											<td align='center' valign='top' style='border: 1px dotted #000'>".number_format($UnitPrice,4)."</td>
					
											<td align='center' valign='top' style='border: 1px dotted #000'>".number_format($PRICE,4)."</td>
											
										</tr>

									 ";
									 $global_totQnty = $global_totQnty + $QUANTITY ;
									 $global_totTaka = $global_totTaka +  $PRICE ; 
									 $AvgPrice		 = $global_totTaka / $global_totQnty ; 
									  
									

								// Dynamic Row End		  

						$SL++;	
					}
					$Grand_Total_Taka = $Grand_Total_Taka + $global_totTaka ;
					$tableView .=" 	<tr style='font-weight:bold;'>

										<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
										
										<td align='right' valign='top' style='border: 1px dotted #000'>Total:</td>
										
										<td align='center' valign='top' style='border: 1px dotted #000'>".number_format($global_totQnty,4)."</td>
										
										<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
										
										<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
										
										<td align='center' valign='top' style='border: 1px dotted #000'>".number_format($global_totTaka,4)."</td>

									</tr>
									<tr style='font-weight:bold;'>

										<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
										
										<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
										
										<td align='right' valign='top' style='border: 1px dotted #000'>Average Price :</td>
										
										<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
										
										<td align='center' valign='top' style='border: 1px dotted #000'>".number_format($AvgPrice,4)."</td>
										
										<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

									</tr>
									<tr style='font-weight:bold;'>
										<td colspan='5' align='right' valign='top' style='border: 1px dotted #000'>Grand Total : </td>

										<td colspan='5' align='center' valign='top' style='border: 1px dotted #000'>".number_format($Grand_Total_Taka,4)."</td>

									</tr>
						";
						
				}
 
					$tableView .="

						<tr>

							<td colspan='6' align='right' valign='top' >&nbsp;</td>

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
									<td align='right' width='20%' valign='bottom' ><hr width='200' ></td>
									<td width='20%' valign='bottom' ><hr width='200' ></td>
									<td width='20%' valign='bottom' ><hr width='200' ></td>
									<td width='20%' valign='bottom' ><hr width='200' ></td>
									<td width='20%' valign='bottom' ><hr width='200' ></td>
								  </tr>
								  <tr>
									<td align='center' valign='top'  ><b>Manager (Feed Mill) Signature</b></td>
									<td  align='center' valign='top'  ><b>Computer Operator</b></td>
									<td align='center' valign='top'  ><b>Manager(Finance) Signature</b></td>
									<td  align='center' valign='top'  ><b>AGM(Finance) Signature</b></td>
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

?>