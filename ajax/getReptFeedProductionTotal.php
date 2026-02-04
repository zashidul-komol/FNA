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
							<center><b><font size=4>Summary Feed Production Report</FONT></b></center>
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
										
						$BasicQueryA		= "SELECT feed.FOODID
													FROM feed_fooditem feed, feed_production prod
													WHERE feed.FOODID = prod.FOODID
													AND prod.PRODUCTIONDATE BETWEEN '".$PURCHASEDATE_FROM."' AND '".$PURCHASEDATE_TO."'
													
											"; 
						$BasicQueryAStatement				= mysql_query($BasicQueryA);
						$i = 0;
						while($BasicQueryAStatementData		= mysql_fetch_array($BasicQueryAStatement)){	
							$FOODID_ARRAY[] 				= $BasicQueryAStatementData['FOODID'];
							$i++;
						}
						
						$FOODID_ARRAY_UNIQUE = array_unique($FOODID_ARRAY);
						$Grand_Total_Taka 	=0;
								
						foreach($FOODID_ARRAY_UNIQUE as $individualFoodId){
						
						$FoodNameQuery 	= "SELECT 	fi.FOODNAME
												FROM feed_fooditem fi 
												WHERE fi.FOODID = '".$individualFoodId."'
											";
						$FoodNameQueryStatement					= mysql_query($FoodNameQuery);
						while($FoodNameQueryStatementData		= mysql_fetch_array($FoodNameQueryStatement)){	
							$FOODNAME							= $FoodNameQueryStatementData['FOODNAME'];
						}	
							$tableView .="<tr style='font-weight:bold;'>
											<td colspan='6' align='left' valign='top' style='border: 1px dotted #000'>Name of Feed :  $FOODNAME</td>

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
								
								
								$RecepiQry		= "SELECT 	rec.RECIPIID,
															bkdn.PRODUCTID,
															p.PRODUCTNAME
															FROM feed_recipi rec, feed_recipi_bkdn bkdn, fna_product p
															WHERE rec.RECIPIID = bkdn.RECIPIID
															AND p.PRODUCTID = bkdn.PRODUCTID
															AND rec.FOODID = '".$individualFoodId."'
														";
								$RecepiQryStatement						= mysql_query($RecepiQry);
								$global_totQnty 	=0;
								$global_totTaka		=0;
								 $AvgPrice			=0;
								 $SL = 1;
								while($RecepiQryStatementData			= mysql_fetch_array($RecepiQryStatement)){	
									$RECIPIID							= $RecepiQryStatementData['RECIPIID'];
									$PRODUCTID							= $RecepiQryStatementData['PRODUCTID'];
									$PRODUCTNAME						= $RecepiQryStatementData['PRODUCTNAME'];
							
								
									
								$production_bkdn_qry	= "SELECT 	SUM(bkdn.QUANTITY) QUANTITY,
																	SUM(bkdn.PRICE) PRICE,
																	feed.FOODNAME
															FROM  feed_production prod, feed_production_bkdn bkdn, feed_fooditem feed  
															WHERE feed.FOODID = prod.FOODID
															AND prod.PRODUCTIONID = bkdn.PRODUCTIONID
															AND bkdn.PRODUCTID = '".$PRODUCTID."'
															AND bkdn.RECIPIID = '".$RECIPIID."'
															AND prod.PRODUCTIONDATE BETWEEN '".$PURCHASEDATE_FROM."' AND '".$PURCHASEDATE_TO."'
															
														";
							$production_bkdn_qryStatement			= mysql_query($production_bkdn_qry);
							
							while($production_bkdn_qryStatementData	= mysql_fetch_array($production_bkdn_qryStatement)){	
								$QUANTITY							= $production_bkdn_qryStatementData['QUANTITY'];
								$PRICE								= $production_bkdn_qryStatementData['PRICE'];
								}		
						
						
						
						$UnitPrice		= $PRICE / $QUANTITY ; 
						$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000'>$SL</td>

											<td align='center' valign='top'  style='border: 1px dotted #000'>$PRODUCTNAME</td>
											
											<td align='center' valign='top' style='border: 1px dotted #000'>".number_format($QUANTITY,4)."</td>

											<td align='center' valign='top' style='border: 1px dotted #000'></td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($UnitPrice,4)."</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($PRICE,4)."</td>
											
										</tr>

									 ";
									 $global_totQnty = $global_totQnty + $QUANTITY ;
									 $global_totTaka = $global_totTaka +  $PRICE ; 
									 $AvgPrice		 = $global_totTaka / $global_totQnty ; 
									  
									

								// Dynamic Row End		  

						$SL++;	
						
					}
					$tableView .=" 	<tr style='font-weight:bold;'>

										<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
										
										<td align='right' valign='top' style='border: 1px dotted #000'>Total:</td>
										
										<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($global_totQnty,4)."</td>
										
										<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
										
										<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
										
										<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($global_totTaka,4)."</td>

									</tr>
									<tr style='font-weight:bold;'>

										<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
										
										<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
										
										<td align='right' valign='top' style='border: 1px dotted #000'>Average Price :</td>
										
										<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
										
										<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($AvgPrice,4)."</td>
										
										<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

									</tr>
									
						";
					$Grand_Total_Taka = $Grand_Total_Taka + $global_totTaka ;	
				}
 				
					
					$tableView .="
						<tr>

							<td colspan='6' align='left' valign='top' >&nbsp;</td>

						</tr>	
						
						<tr style='font-weight:bold;'>
							<td colspan='6' align='center' valign='top' style='border: 1px dotted #000'>Grand Total : ".number_format($Grand_Total_Taka,4)." Taka.</td>

						</tr>
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