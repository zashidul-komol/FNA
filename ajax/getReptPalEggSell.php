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
	$OPENINGDATE_FROM 	= showDateMySQlFormat($_REQUEST['ENTRYDATE']);
	$OPENINGDATE_TO		= showDateMySQlFormat($_REQUEST['ENTRYDATE2']);
	$BATCHNO 			= $_REQUEST['BATCHNO'];
	$userId 			= $_REQUEST['userId'];
	
	if ($BATCHNO == 'All'){
		$con = '';
	}else{
		$con = "AND es.BATCHNO='".$BATCHNO."' ";
	}
		
	
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
							<center><b><font size=4>Egg Sell Report</FONT></b></center>
							<center>&nbsp;</center>
							<center><b><font size=2>Date : $OPENINGDATE_FROM to $OPENINGDATE_TO </font></b></center>
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

						<td align='center' valign='middle'  style='border: 1px dotted #000'>Date </td>
                        
                        <td align='center' valign='middle'  style='border: 1px dotted #000'>Batch No.</td>
						
						<td align='center' valign='middle'  style='border: 1px dotted #000'>Haching</td>

						<td align='center' valign='middle' style='border: 1px dotted #000'>Haching Price</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Commercial</td>
						
						<td align='center' valign='middle'  style='border: 1px dotted #000'>Comm Price </td>
                        
                        <td align='center' valign='middle'  style='border: 1px dotted #000'>Vanga</td>
						
						<td align='center' valign='middle'  style='border: 1px dotted #000'>Vanga Price</td>

						<td align='center' valign='middle' style='border: 1px dotted #000'>Cancel</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Cancel Price</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Total Quantity</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Total Taka</td>
						
					</tr>";

// Query here.

						//$TOTAL_RECEIVE_QNTY_KG ='';
						$SL				= 1;
						$Global_Quantity = 0;
						$Global_Price	= 0;
						$BasicQuery 	= "SELECT es.SCID,
												  es.BATCHNO,
												  es.QUANTITY,
												  es.TOTPRICE,
												  es.ESDATE,
												  sc.SCNAME
												FROM pal_egg_sell es, pal_sellcategory sc
												WHERE sc.SCID = es.SCID
												AND es.ESDATE BETWEEN '".$OPENINGDATE_FROM."' AND '".$OPENINGDATE_TO."'
												{$con}
												ORDER BY es.ESDATE ASC
										"; 
						$BasicQueryStatement			= mysql_query($BasicQuery);
						$Grand_Total_egg = 0;
						$Grand_Total_Taka	= 0;
						while($BasicQueryStatementData	= mysql_fetch_array($BasicQueryStatement)){	
							$SCID			 			= $BasicQueryStatementData['SCID'];
							$BATCHNO		 			= $BasicQueryStatementData['BATCHNO'];
							$QUANTITY		 			= $BasicQueryStatementData['QUANTITY'];
							$TOTPRICE		 			= $BasicQueryStatementData['TOTPRICE'];
							$ESDATE			 			= $BasicQueryStatementData['ESDATE'];
							$SCNAME			 			= $BasicQueryStatementData['SCNAME'];
							
							$Global_Quantity			= $Global_Quantity + $QUANTITY ; 
							$Haching_QUANTITY = 0;
							$Haching_TOTPRICE = 0;
							$Comm_QUANTITY = 0;
							$Comm_TOTPRICE = 0;
							$Vanga_QUANTITY = 0;
							$Vanga_TOTPRICE = 0;
							$Cancel_QUANTITY = 0;
							$Cancel_TOTPRICE = 0;
							
							
							if($SCID == '1'){
								$Haching_QUANTITY = $QUANTITY;
								$Haching_TOTPRICE = $TOTPRICE;
							}elseif($SCID == '2'){
								$Comm_QUANTITY = $QUANTITY;
								$Comm_TOTPRICE = $TOTPRICE;
							}elseif($SCID == '3'){
								$Vanga_QUANTITY = $QUANTITY;
								$Vanga_TOTPRICE = $TOTPRICE;
							}else{
								$Cancel_QUANTITY = $QUANTITY;
								$Cancel_TOTPRICE = $TOTPRICE;
							}
							$Grand_Total_egg  = $Haching_QUANTITY + $Comm_QUANTITY + $Vanga_QUANTITY + $Cancel_QUANTITY ;
							$Grand_Total_Taka  = $Haching_TOTPRICE + $Comm_TOTPRICE + $Vanga_TOTPRICE + $Cancel_TOTPRICE ;
							
							
							$Global_Hatch_Qnty	= $Global_Hatch_Qnty + $Haching_QUANTITY ; 
							$Global_Hatch_Price	= $Global_Hatch_Price + $Haching_TOTPRICE ; 
							
							$Global_Comm_QUANTITY	= $Global_Comm_QUANTITY + $Comm_QUANTITY ; 
							$Global_Comm_TOTPRICE	= $Global_Comm_TOTPRICE + $Comm_TOTPRICE ; 
							
							$Global_Vanga_QUANTITY	= $Global_Vanga_QUANTITY + $Vanga_QUANTITY ; 
							$Global_Vanga_TOTPRICE	= $Global_Vanga_TOTPRICE + $Vanga_TOTPRICE ; 
							
							$Global_Cancel_QUANTITY	= $Global_Cancel_QUANTITY + $Cancel_QUANTITY ; 
							$Global_Cancel_TOTPRICE	= $Global_Cancel_TOTPRICE + $Cancel_TOTPRICE ; 
							
							$Global_Total_Qnty		= $Global_Total_Qnty + $Grand_Total_egg ; 
							$Global_Total_Price		= $Global_Total_Price + $Grand_Total_Taka ; 
							
							
						$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000'>$SL</td>

											<td align='center' valign='top' style='border: 1px dotted #000'>$ESDATE</td>
					
											<td align='center' valign='top'  style='border: 1px dotted #000'>$BATCHNO</td>
											
											<td align='right' valign='top'  style='border: 1px dotted #000'>$Haching_QUANTITY</td>
											
											<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($Haching_TOTPRICE,2)."</td>
											
											<td align='right' valign='top'  style='border: 1px dotted #000'>$Comm_QUANTITY</td>
											
											<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($Comm_TOTPRICE,2)."</td>
											
											<td align='right' valign='top'  style='border: 1px dotted #000'>$Vanga_QUANTITY</td>
											
											<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($Vanga_TOTPRICE,2)."</td>
											
											<td align='right' valign='top'  style='border: 1px dotted #000'>$Cancel_QUANTITY</td>
											
											<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($Cancel_TOTPRICE,2)."</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>$Grand_Total_egg</td>
											
											<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($Grand_Total_Taka,2)."</td>
											
										</tr>

									 ";

								// Dynamic Row End		  

					$SL++;	
				
				}

					$tableView .="

						<tr style='font-weight:bold;'>

							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='center' valign='top'  style='border: 1px dotted #000'>&nbsp;</td>

							<td align='center' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>$Global_Hatch_Qnty</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_Hatch_Price,2)."</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>$Global_Comm_QUANTITY</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_Comm_TOTPRICE,2)."</td>

							<td align='right' valign='top'  style='border: 1px dotted #000'>$Global_Vanga_QUANTITY</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_Vanga_TOTPRICE,2)."</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>$Global_Cancel_QUANTITY</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_Cancel_TOTPRICE,2)."</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>$Global_Total_Qnty</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_Total_Price,2)."</td>
						</tr>
						<tr>

							<td colspan='13' align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

						</tr>
							
						<tr>

							<td colspan='13' align='left' valign='top'>&nbsp;</td>

						</tr>
						<tr>

							<td colspan='13' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='13' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='13' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='13' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='13' align='left' valign='top' >
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

							<td colspan='13' align='left' valign='top' >&nbsp;</td>

						</tr>
						<tr>

							<td colspan='13' align='left' valign='top' >&nbsp;</td>

						</tr>					

					</table>";
	echo $tableView;

?>