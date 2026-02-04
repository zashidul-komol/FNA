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
	
		$Last_Date = date_create($PURCHASEDATE_TO);
		date_sub($Last_Date, date_interval_create_from_date_string('1 days'));
		$LastDay = date_format($Last_Date, 'Y-m-d');

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
							<center><b><font size=4>Batch Wise Medicine Summary Report</FONT></b></center>
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

						<td align='center' valign='middle'  style='border: 1px dotted #000'>Batch No.</td>

						<td align='center' valign='middle'  style='border: 1px dotted #000'>Total Quantity</td>
						
						<td align='center' valign='middle'  style='border: 1px dotted #000'>Total Taka</td>
                        
                      </tr>";

// Query here.

						$BATCH_ARRAY	  	= array();
						$BatchQuery	 		= "SELECT DISTINCT m.BATCHNO
												FROM pal_medicine m 
												WHERE m.PROJECTID 	= '".$PROJECTID."'
												AND m.SUBPROJECTID 	= '".$SUBPROJECTID."'
												AND m.MDDATE BETWEEN '".$PURCHASEDATE_FROM."' AND '".$PURCHASEDATE_TO."'
											"; 
						$BatchQueryStatement				= mysql_query($BatchQuery);
						$i = 0;
						while($BatchQueryStatementData		= mysql_fetch_array($BatchQueryStatement)){	
							$BATCH_ARRAY[] 					= $BatchQueryStatementData['BATCHNO'];
							$i++;
						}
						$SL = 1;
						$Global_TOTQNTY = 0;
						$Global_TOTPRICE = 0;
						$GLOBAL_BALANCE_TAKA = 0;
						$Global_BALANCE_QNTY = 0;
						$BATCH_ARRAY_UNIQUE 		= array_unique($BATCH_ARRAY) ;
						foreach($BATCH_ARRAY_UNIQUE as $individualBatch){
							
							$Medicine_Qnty_Qry = "SELECT SUM(m.QUANTITY) QUANTITY,
														   SUM(m.TOTALPRICE) TOTALPRICE
													FROM pal_medicine m
													WHERE m.BATCHNO = '".$individualBatch."'
													AND m.MDDATE BETWEEN '".$PURCHASEDATE_FROM."' AND '".$PURCHASEDATE_TO."'";
																					
							$Medicine_Qnty_QryStatement						= mysql_query($Medicine_Qnty_Qry);
							while($Medicine_Qnty_QryStatementData			= mysql_fetch_array($Medicine_Qnty_QryStatement)){	
									$Total_QUANTITY							= $Medicine_Qnty_QryStatementData['QUANTITY'];
									$Total_TOTALPRICE						= $Medicine_Qnty_QryStatementData['TOTALPRICE'];
								
							}
							
							
							//echo $individualBatch;
							
							$Global_TOTQNTY				= $Global_TOTQNTY + $Total_QUANTITY ; 
							$Global_TOTPRICE			= $Global_TOTPRICE + $Total_TOTALPRICE ; 
							
							
						$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000'>$SL</td>

											<td align='center' valign='top'  style='border: 1px dotted #000'>$individualBatch</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Total_QUANTITY,2)."&nbsp;&nbsp;&nbsp;KG</td>

											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Total_TOTALPRICE,2)."</td>
					
												
										</tr>

									 ";

								// Dynamic Row End		  
							
						$SL++;	
					
				}

					$tableView .="

						<tr style='font-weight:bold;'>

							<td align='center' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='center' valign='top' style='border: 1px dotted #000'>Total :</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_TOTQNTY,2)."&nbsp;&nbsp;&nbsp;KG</td>

							<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($Global_TOTPRICE,2)."</td>

								
						</tr>
						<tr>

							<td colspan='4' align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

						</tr>
							
						<tr>

							<td colspan='4' align='left' valign='top'>&nbsp;</td>

						</tr>
						<tr>

							<td colspan='4' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='4' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='4' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='4' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='4' align='left' valign='top' >
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

							<td colspan='4' align='left' valign='top' >&nbsp;</td>

						</tr>
						<tr>

							<td colspan='4' align='left' valign='top' >&nbsp;</td>

						</tr>					

					</table>";
	echo $tableView;

?>