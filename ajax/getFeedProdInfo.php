<?php
include('../config/dbinfo.inc.php');
	
function showDateMySQlFormat($date){
	
		$exp = explode("-",$date);				
		$mysqlDateF = $exp[2]."-".$exp[1]."-".$exp[0];
		
		return $mysqlDateF;
}
	$FOODID 				= $_REQUEST['FOODID'];
	$PRODUCTIONQNTY 		= $_REQUEST['PRODUCTIONQNTY'];
	$PRODUCTIONDATE 		= showDateMySQlFormat($_REQUEST['PRODUCTIONDATE']);
	
	
					
	$tableView = "";	
	$tableView .="<table width='100%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:85%; border: 1px dotted #000'>
					  <tr style='font-weight:bold;'>
						<td align='center' valign='top' style='font-weight:bold;border: 1px dotted #000'>Product Name.</td>

						<td align='center' valign='top'  style='border: 1px dotted #000'>Formula Quantity</td>
						
						<td align='center' valign='top'  style='border: 1px dotted #000'>Need Quantity</td>

						<td align='center' valign='top' style='border: 1px dotted #000'>Balance Quantity </td>

						<td align='center' valign='top' style='border: 1px dotted #000'>Production Yes/No</td>
						
						
					</tr>";

// Query here.
						$RecipiQry			= mysql_fetch_array(mysql_query("SELECT RECIPIID FROM feed_recipi WHERE FOODID = '".$FOODID."'"));
						$Recipi_ID			= $RecipiQry['RECIPIID'];
	
						$aQuery 	= "SELECT	
												PRODUCTID,
												QUANTITY			
										FROM feed_recipi_bkdn
										WHERE RECIPIID = '".$Recipi_ID."'
										ORDER BY PRODUCTID ASC
									";
						$aQueryStatement	= mysql_query($aQuery);
						$sl = 1;
						while($aQueryStatementData	= mysql_fetch_array($aQueryStatement)){

 						// Dynamic Row Start
						$PRODUCTID	 		= $aQueryStatementData['PRODUCTID'];
						$QUANTITY	 		= $aQueryStatementData['QUANTITY'];
												
						
						$unitFare_qry		= "SELECT	
													PRODUCTNAME			
												FROM fna_product 
												WHERE PRODUCTID =  '".$PRODUCTID."'
									    		ORDER BY PRODUCTID ASC
											";
						$unitFare_qryStatement				= mysql_query($unitFare_qry);
						
						while($unitFare_qryStatementData	= mysql_fetch_array($unitFare_qryStatement)){
								$PRODUCTNAME		 			= $unitFare_qryStatementData['PRODUCTNAME'];
						
						}
						$FORMULATED_QUANTITY		= 100;
						$PROD_NEED_QNTY				= ($QUANTITY * $PRODUCTIONQNTY)/$FORMULATED_QUANTITY ; 
						
						$MAXFLAG_Raw			= mysql_fetch_array(mysql_query("SELECT MAX(PRODFLAG) FROM feed_rawmatstock WHERE PRODUCTID = '".$PRODUCTID."'"));
						$MAXPROD_FLAG_Raw		= $MAXFLAG_Raw['MAX(PRODFLAG)'];
						$rawMatStkQry			= mysql_fetch_array(mysql_query("SELECT * FROM feed_rawmatstock WHERE PRODUCTID = '".$PRODUCTID."' AND PRODFLAG = '".$MAXPROD_FLAG_Raw."'"));
						$TOTQNTY_RawStk			= $rawMatStkQry['TOTQNTY'];
						
						if($PROD_NEED_QNTY > $TOTQNTY_RawStk){
							
							$PRODUCTION		= 'Not Possible.....';
							
						}else{
							$PRODUCTION		= 'YES';
							
						}
					
						$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000'>$PRODUCTNAME</td>

											<td align='right' valign='top' style='border: 1px dotted #000'> $QUANTITY</td>
					
											<td align='right' valign='top'  style='border: 1px dotted #000'>$PROD_NEED_QNTY</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'> $TOTQNTY_RawStk</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>$PRODUCTION</td>
											
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

							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

						</tr>
						
						<tr>

							<td colspan='13' align='left' valign='top' style='border: 1px dotted #000'>
									<table width='100%' border='0' cellpadding='3' cellspacing='0'>	
										<tr valign='top'>
										  <td align='right'>&nbsp;</td>
										  <td height='26' align='left'>
										   <input type='hidden' name='FOODID' id='FOODID' value='{$FOODID}'/>
										  <input type='hidden' name='PRODUCTIONQNTY' id='PRODUCTIONQNTY' value='{$PRODUCTIONQNTY}'/>
										  <input type='hidden' name='PRODUCTIONDATE' id='PRODUCTIONDATE' value='{$PRODUCTIONDATE}'/>
										  <input type='submit' name='insertProductionInfo' value='Insert' class='FormSubmitBtn' />
										  <input name='btnClose' type='button' value='Close' onClick='return ShowHide('showLoad')'>
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