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
							<center><b><font size=4>$PROJECTNAME Stock Report</FONT></b></center>
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
					  <tr style='font-weight:bold;'>

						<td align='center' valign='middle' style='font-weight:bold;border: 1px dotted #000'>SL No.</td>

						<td align='center' valign='middle'  style='border: 1px dotted #000'>Product Name</td>
						
						<td align='center' valign='middle'  style='border: 1px dotted #000'>Purchase Qnty</td>
						
						<td align='center' valign='middle'  style='border: 1px dotted #000'>Amount</td>
						
						<td align='center' valign='middle'  style='border: 1px dotted #000'>Use Qnty</td>
						
						<td align='center' valign='middle'  style='border: 1px dotted #000'>Amount</td>

						<td align='center' valign='middle'  style='border: 1px dotted #000'>Stock Quantity</td>
						
						<td align='center' valign='middle'  style='border: 1px dotted #000'>Unit</td>
                        
                        <td align='center' valign='middle'  style='border: 1px dotted #000'>Avg Price</td>

						<td align='center' valign='middle' style='border: 1px dotted #000'>Total Taka</td>
						
					</tr>";

// Query here.

						$PRODUCT_ARRAY  = array();
						//echo 'komol';
						$ProductQuery 	= "SELECT p.PRODUCTID
												FROM fna_product p, feed_purchaserawmat pr, feed_rawmatstock stck
												WHERE p.PRODUCTID = stck.PRODUCTID
												AND p.PRODUCTID = pr.PRODUCTID
												AND p.PROJECTID 	= '".$PROJECTID."'
												AND p.SUBPROJECTID 	= '".$SUBPROJECTID."'
												AND pr.PURCHASEDATE BETWEEN '".$PURCHASEDATE_FROM."' AND '".$PURCHASEDATE_TO."'
												AND p.PRODUCTID NOT IN (159,160,161,162,163,164,165,166,167,200)
												
											"; 
						$ProductQueryStatement				= mysql_query($ProductQuery);
						$i = 0;
						while($ProductQueryStatementData	= mysql_fetch_array($ProductQueryStatement)){	
							$PRODUCT_ARRAY[] 				= $ProductQueryStatementData['PRODUCTID'];
							$i++;
						}
						$SL = 1;
						$Global_TOTQNTY = 0;
						$Global_TOTAMOUNT = 0;
						$TOTQNTY_stock = 0;
						$TOTAMOUNT_stock = 0;
						$WEIGHTNAME_stock = 0;
						$AVGPRICE_stock	 = 0;
						
						$Global_use_qnty = 0;
						$Global_use_price = 0;
						
						$Global_pur_qnty = 0;
						$Global_pur_price = 0;
						
						$Global_Stock_Qnty = 0;
						$Global_Stock_Price	=0;
						
						$PRODUCT_ARRAY_UNIQUE 	= array_unique($PRODUCT_ARRAY) ;
						foreach($PRODUCT_ARRAY_UNIQUE as $individualProduct){
							//echo "SELECT MAX(PRODFLAG) FROM feed_rawmatstock WHERE PRODUCTID = '".$individualProduct."'";die();
							$product_flag 		= mysql_fetch_array(mysql_query("SELECT MAX(rms.PRODFLAG) FROM feed_rawmatstock  rms, feed_purchaserawmat pr WHERE rms.PRMID = pr.PRMID AND pr.PURCHASEDATE BETWEEN '".$PURCHASEDATE_FROM."' AND '".$PURCHASEDATE_TO."' AND rms.PRODUCTID = '".$individualProduct."'"));
							$MaxproductFlag		= $product_flag['MAX(rms.PRODFLAG)'];
								
							$ProductStock_Query = "SELECT   p.PRODUCTNAME
													FROM fna_product p
													WHERE p.PRODUCTID = '".$individualProduct."'
													";
							$ProductStock_QueryStatement			= mysql_query($ProductStock_Query);
							while($ProductStock_QueryStatementData	= mysql_fetch_array($ProductStock_QueryStatement)){	
								$PRODUCTNAME	 					= $ProductStock_QueryStatementData['PRODUCTNAME'];
								
							}	
							$stock_Query 	= "SELECT   rms.PRODUCTID,
															rms.TOTQNTY,
															rms.TOTAMOUNT,
															rms.AVGPRICE,
															pr.WTID,
															wt.WNAME
													FROM feed_rawmatstock rms, feed_purchaserawmat pr, fna_weight wt
													WHERE rms.PRMID = pr.PRMID
													AND pr.WTID = wt.WTID
													AND rms.PRODUCTID = '".$individualProduct."'
													AND rms.PROJECTID = '".$PROJECTID."'
													AND rms.SUBPROJECTID = '".$SUBPROJECTID."'
													AND rms.PRODFLAG = '".$MaxproductFlag."'
													AND pr.PURCHASEDATE BETWEEN '".$PURCHASEDATE_FROM."' AND '".$PURCHASEDATE_TO."'
												";
							$stock_QueryStatement			= mysql_query($stock_Query);
							$TOTQNTY_stock = 0;
							$TOTAMOUNT_stock = 0;
							$WEIGHTNAME_stock = 0;
							$AVGPRICE_stock	 = 0;
							
							
							while($stock_QueryStatementData	= mysql_fetch_array($stock_QueryStatement)){	
								$TOTQNTY_stock				= $stock_QueryStatementData['TOTQNTY'];
								$PRODUCTID_stock			= $stock_QueryStatementData['PRODUCTID'];
								$TOTAMOUNT_stock			= $stock_QueryStatementData['TOTAMOUNT'];
								$AVGPRICE_stock				= $stock_QueryStatementData['AVGPRICE'];
								$WEIGHTNAME_stock			= $stock_QueryStatementData['WNAME'];
								
							}	
							$Global_TOTQNTY = $Global_TOTQNTY + $TOTQNTY_stock ; 
							$Global_TOTAMOUNT = $Global_TOTAMOUNT + $TOTAMOUNT_stock ; 
							
														
							$ProductPurc_Query = "SELECT   SUM(pr.QUANTITY) AS PUR_QNTY,
															SUM(pr.AMOUNT) AS SUM_PRICE
													FROM feed_purchaserawmat pr
													WHERE pr.PRODUCTID = '".$individualProduct."'
													AND pr.PURCHASEDATE BETWEEN '".$PURCHASEDATE_FROM."' AND '".$PURCHASEDATE_TO."'
													";
							$ProductPurc_QueryStatement			= mysql_query($ProductPurc_Query);
							while($ProductPurc_QueryStatementData	= mysql_fetch_array($ProductPurc_QueryStatement)){	
								$PRODUCT_PUR_QNTY 					= $ProductPurc_QueryStatementData['PUR_QNTY'];
								$PRODUCT_SUM_PRICE 					= $ProductPurc_QueryStatementData['SUM_PRICE'];
								
							}	
							
							$Global_pur_qnty	=	$Global_pur_qnty + $PRODUCT_PUR_QNTY ;
							$Global_pur_price	=	$Global_pur_price + $PRODUCT_SUM_PRICE ; 
							
							
							if($PROJECTID == 5){
								$PRODUCT_USE_QNTY 	= '';
								$PRODUCT_USE_PRICE	= '';
								$ProductUse_Query = "SELECT SUM(prms.QUANTITY) AS USE_QNTY,
															SUM(prms.TOTALPRICE) AS USE_SUM_PRICE
														FROM pal_medicine prms
														WHERE prms.PRODUCTID = '".$individualProduct."'
														AND prms.MDDATE BETWEEN '".$PURCHASEDATE_FROM."' AND '".$PURCHASEDATE_TO."'
														
														";
								$ProductUse_QueryStatement			= mysql_query($ProductUse_Query);
								
								
								
								while($ProductUse_QueryStatementData	= mysql_fetch_array($ProductUse_QueryStatement)){	
									$PRODUCT_USE_QNTY 					= $ProductUse_QueryStatementData['USE_QNTY'];
									$PRODUCT_USE_PRICE 					= $ProductUse_QueryStatementData['USE_SUM_PRICE'];
									
								}
							}else{
								
								$PRODUCT_USE_QNTY 	= '';
								$PRODUCT_USE_PRICE	= '';
								
								$ProductUse_Query = "SELECT   	SUM(bkdn.QUANTITY) AS USE_QNTY,
																SUM(bkdn.PRICE) AS USE_SUM_PRICE
														FROM feed_production pr, feed_production_bkdn bkdn
														WHERE pr.PRODUCTIONID = bkdn.PRODUCTIONID
														AND bkdn.PRODUCTID = '".$individualProduct."'
														AND pr.PRODUCTIONDATE BETWEEN '".$PURCHASEDATE_FROM."' AND '".$PURCHASEDATE_TO."'
														";
								$ProductUse_QueryStatement			= mysql_query($ProductUse_Query);
								
								
								
								while($ProductUse_QueryStatementData	= mysql_fetch_array($ProductUse_QueryStatement)){	
									$PRODUCT_USE_QNTY 					= $ProductUse_QueryStatementData['USE_QNTY'];
									$PRODUCT_USE_PRICE 					= $ProductUse_QueryStatementData['USE_SUM_PRICE'];
									
								}
								/*$ProductUse_Query = "SELECT   	SUM(prms.QUANTITY) AS PUR_QNTY,
																SUM(prms.AMOUNT) AS SUM_PRICE
														FROM feed_rawmatstock prms, feed_purchaserawmat pr
														WHERE prms.PRMID = pr.PRMID
														AND prms.PRODUCTID = '".$individualProduct."'
														AND prms.WORKFLAG = 'Out'
														AND pr.PURCHASEDATE BETWEEN '".$PURCHASEDATE_FROM."' AND '".$PURCHASEDATE_TO."'
														";
								$ProductUse_QueryStatement			= mysql_query($ProductUse_Query);
								
								
								
								while($ProductUse_QueryStatementData	= mysql_fetch_array($ProductUse_QueryStatement)){	
									$PRODUCT_USE_QNTY 					= $ProductUse_QueryStatementData['PUR_QNTY'];
									$PRODUCT_USE_PRICE 					= $ProductUse_QueryStatementData['SUM_PRICE'];
									
								}*/
								
								
							}
							$Global_use_qnty		=	$Global_use_qnty + $PRODUCT_USE_QNTY ; 
							$Global_use_price		=	$Global_use_price + $PRODUCT_USE_PRICE ;
							//$Global_purchase_price	=	$Global_purchase_price + $PRODUCT_SUM_PRICE ;
							
							//if($TOTQNTY_stock > 0){
								
							$Present_Stock_Qnty		= $PRODUCT_PUR_QNTY - $PRODUCT_USE_QNTY ; 
							$Present_Stock_Price	= $PRODUCT_SUM_PRICE - $PRODUCT_USE_PRICE ; 
							
							$Global_Stock_Qnty		= $Global_Stock_Qnty + $Present_Stock_Qnty;
							$Global_Stock_Price		= $Global_Stock_Price + $Present_Stock_Price;
							
							//$Global_TOTQNTY 		= $Global_TOTQNTY + $TOTQNTY_stock ; 
							
						$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000'>$SL</td>

											<td align='center' valign='top'  style='border: 1px dotted #000'>$PRODUCTNAME</td>
											
											<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($PRODUCT_PUR_QNTY,4)."</td>
											
											<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($PRODUCT_SUM_PRICE,4)."</td>
											
											<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($PRODUCT_USE_QNTY,4)."</td>
											
											<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($PRODUCT_USE_PRICE,4)."</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Present_Stock_Qnty,4)."</td>
											
											<td align='center' valign='top' style='border: 1px dotted #000'>$WEIGHTNAME_stock</td>
					
											<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($AVGPRICE_stock,4)."</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Present_Stock_Price,4)."</td>
											
										</tr>

									 ";

								// Dynamic Row End		  
							//}
					$SL++;	
				
				}

					$tableView .="

						<tr style='font-weight:bold;'>

							<td align='center' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='center' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_pur_qnty,4)."</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_pur_price,4)."</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_use_qnty,4)."</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_use_price,4)."</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_Stock_Qnty,4)."</td>
							
							<td align='right' valign='top'  style='border: 1px dotted #000'>&nbsp;</td>

							<td align='center' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_Stock_Price,4)."</td>
							
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

							<td colspan='10' align='left' valign='top' >&nbsp;</td>

						</tr>
						<tr>

							<td colspan='10' align='left' valign='top' >&nbsp;</td>

						</tr>					

					</table>";
	echo $tableView;

?>