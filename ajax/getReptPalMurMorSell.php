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
		$con = "AND mms.BATCHNO='".$BATCHNO."' ";
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
							<center><b><font size=4>Murgi Morog Sell Report</FONT></b></center>
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
						
						<td align='center' valign='middle'  style='border: 1px dotted #000'>Sell Rate</td>
						
						<td align='center' valign='middle'  style='border: 1px dotted #000'>Murgi Quantity</td>

						<td align='center' valign='middle' style='border: 1px dotted #000'>Price</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Morog Quantity</td>
						
						<td align='center' valign='middle'  style='border: 1px dotted #000'>Price </td>
                        
                        
						
					</tr>";

// Query here.

						//$TOTAL_RECEIVE_QNTY_KG ='';
						$SL				= 1;
						$Global_Quantity = 0;
						$Global_Price	= 0;
						$BasicQuery 	= "SELECT mms.BATCHNO,
												  mms.MURGIQNTY,
												  mms.MOROGQNTY,
												  mms.RATE,
												  mms.TOTPRICE,
												  mms.MMSELLDATE
												FROM pal_morog_murgi_sell mms
												WHERE mms.MMSELLDATE BETWEEN '".$OPENINGDATE_FROM."' AND '".$OPENINGDATE_TO."'
												{$con}
										"; 
						$BasicQueryStatement			= mysql_query($BasicQuery);
						$Grand_TotalPrice_Murgi = 0;
						$Grand_TotalPrice_Morog = 0;
						$Grand_Total_Murgi		= 0;
						$Grand_Total_Morog		= 0;
						while($BasicQueryStatementData	= mysql_fetch_array($BasicQueryStatement)){	
							$BATCHNO		 			= $BasicQueryStatementData['BATCHNO'];
							$MURGIQNTY		 			= $BasicQueryStatementData['MURGIQNTY'];
							$MOROGQNTY		 			= $BasicQueryStatementData['MOROGQNTY'];
							$RATE			 			= $BasicQueryStatementData['RATE'];
							$TOTPRICE		 			= $BasicQueryStatementData['TOTPRICE'];
							$MMSELLDATE		 			= $BasicQueryStatementData['MMSELLDATE'];
							
							//$Global_Quantity			= $Global_Quantity + $QUANTITY ; 
							$MURGI_TOTPRICE = 0;
							$MOROG_TOTPRICE = 0;
							
							if(($MURGIQNTY != '') and ($MURGIQNTY != 0)){
								$MURGI_TOTPRICE = $TOTPRICE;
							}elseif(($MOROGQNTY != '') and ($MOROGQNTY != 0)){
								$MOROG_TOTPRICE = $TOTPRICE;
							}
							$Grand_TotalPrice_Murgi	= $Grand_TotalPrice_Murgi + $MURGI_TOTPRICE ; 
							$Grand_TotalPrice_Morog	= $Grand_TotalPrice_Morog + $MOROG_TOTPRICE ; 
							$Grand_Total_Murgi		= $Grand_Total_Murgi + $MURGIQNTY ; 
							$Grand_Total_Morog		= $Grand_Total_Morog + $MOROGQNTY ; 
							$Total_Murgi_Morog_Sell_Price	= $Total_Murgi_Morog_Sell_Price + $TOTPRICE ; 
							
							
							$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000'>$SL</td>

											<td align='center' valign='top' style='border: 1px dotted #000'>$MMSELLDATE</td>
					
											<td align='center' valign='top'  style='border: 1px dotted #000'>$BATCHNO</td>
											
											<td align='center' valign='top'  style='border: 1px dotted #000'>$RATE</td>
											
											<td align='center' valign='top'  style='border: 1px dotted #000'>$MURGIQNTY</td>
											
											<td align='center' valign='top'  style='border: 1px dotted #000'>$MURGI_TOTPRICE</td>
											
											<td align='center' valign='top'  style='border: 1px dotted #000'>$MOROGQNTY</td>
											
											<td align='center' valign='top'  style='border: 1px dotted #000'>$MOROG_TOTPRICE</td>
											
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
							
							<td align='center' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='center' valign='top' style='border: 1px dotted #000'>$Grand_Total_Murgi</td>

							<td align='center' valign='top' style='border: 1px dotted #000'>$Grand_TotalPrice_Murgi</td>
							
							<td align='center' valign='top' style='border: 1px dotted #000'>$Grand_Total_Morog</td>
							
							<td align='center' valign='top' style='border: 1px dotted #000'>$Grand_TotalPrice_Morog</td>

							
						</tr>
						<tr>

							<td colspan='8' align='center' valign='top' style='border: 1px dotted #000'>Total Murgi + Morog Sell Price : $Total_Murgi_Morog_Sell_Price </td>

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