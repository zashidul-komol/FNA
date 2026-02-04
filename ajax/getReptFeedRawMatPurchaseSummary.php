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
							<center><b><font size=4>Raw Materials Purchase Summary Report</FONT></b></center>
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

						<td align='center' valign='middle'  style='border: 1px dotted #000'>AVG. Unit Price</td>
                        
                        <td align='center' valign='middle'  style='border: 1px dotted #000'>Quantity</td>

						<td align='center' valign='middle' style='border: 1px dotted #000'>Total Taka</td>
						
					</tr>";

// Query here.

						$PROD_ARRAY		  	= array();
						$ProdQuery	 		= "SELECT PRODUCTID
												FROM fna_product  
												WHERE 	PROJECTID = '".$PROJECTID."'
												AND 	SUBPROJECTID = '".$SUBPROJECTID."'
											"; 
						$ProdQueryStatement					= mysql_query($ProdQuery);
						$i = 0;
						while($ProdQueryStatementData		= mysql_fetch_array($ProdQueryStatement)){	
							$PRODUCTID_ARRAY[]				= $ProdQueryStatementData['PRODUCTID'];
							$i++;
						}
						$SL = 1;
						$Global_Quantity = 0;
						$Global_Amount	= 0;
								
						$PRODUCTID_ARRAY_UNIQUE 		= array_unique($PRODUCTID_ARRAY) ;
						foreach($PRODUCTID_ARRAY_UNIQUE as $individualProduct){
						
						
								//$TOTAL_RECEIVE_QNTY_KG ='';
								$BasicQuery 	= "SELECT 	SUM(p.QUANTITY) QUANTITY,
															SUM(p.AMOUNT) AMOUNT,
															p.PRODUCTID,
															p.UNITPRICE,
															p.PURCHASEDATE,
														  	prod.PRODUCTNAME
														FROM feed_purchaserawmat p, fna_product prod
														WHERE prod.PRODUCTID  = p.PRODUCTID
														AND p.PRODUCTID = '".$individualProduct."'
														AND	p.PROJECTID = '".$PROJECTID."'
														AND p.SUBPROJECTID = '".$SUBPROJECTID."'
														AND p.PURCHASEDATE BETWEEN '".$PURCHASEDATE_FROM."' AND '".$PURCHASEDATE_TO."'
														AND p.PRODUCTID NOT IN (159,160,161,162,163,164,165,166,167,200)
													";
								$BasicQueryStatement			= mysql_query($BasicQuery);
								while($BasicQueryStatementData	= mysql_fetch_array($BasicQueryStatement)){	
									$PRODUCTID		 			= $BasicQueryStatementData['PRODUCTID'];
									$UNITPRICE		 			= $BasicQueryStatementData['UNITPRICE'];
									$QUANTITY		 			= $BasicQueryStatementData['QUANTITY'];
									$AMOUNT			 			= $BasicQueryStatementData['AMOUNT'];
									$PURCHASEDATE	 			= $BasicQueryStatementData['PURCHASEDATE'];
									$PRODUCTNAME	 			= $BasicQueryStatementData['PRODUCTNAME'];
								}
									$Global_Quantity			= $Global_Quantity + $QUANTITY ; 
									$Global_Amount				= $Global_Amount + $AMOUNT ; 
									
									$AVG_UNIT_PRICE				= $AMOUNT/$QUANTITY ; 
									
									if($QUANTITY > 0){
									
								$tableView .=" <tr>
													<td align='center' valign='top' style='border: 1px dotted #000'>$SL</td>
		
													<td align='center' valign='top'  style='border: 1px dotted #000'>$PRODUCTNAME</td>
													
													<td align='center' valign='top' style='border: 1px dotted #000'>".number_format($AVG_UNIT_PRICE,2)."</td>
							
													<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($QUANTITY,2)."</td>
													
													<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($AMOUNT,2)."</td>
													
												</tr>
		
											 ";
		
										// Dynamic Row End		  
		
							$SL++;	
									
							}
						}

					$tableView .="

						<tr style='font-weight:bold;'>

							<td align='center' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='right' valign='top'  style='border: 1px dotted #000'>Total : </td>

							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_Quantity,2)."</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_Amount,2)."</td>
							
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
									<td align='right' width='20%' valign='bottom' ><hr width='200' ></td>
									<td width='20%' valign='bottom' ><hr width='200' ></td>
									<td width='20%' valign='bottom' ><hr width='200' ></td>
									<td width='20%' valign='bottom' ><hr width='200' ></td>
									<td width='20%' valign='bottom' ><hr width='200' ></td>
								  </tr>
								  <tr>
									<td align='center' valign='top'  ><b>Store Keeper Signature</b></td>
									<td  align='center' valign='top'  ><b>Computer Operator</b></td>
									<td align='center' valign='top'  ><b>Manager Signature</b></td>
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