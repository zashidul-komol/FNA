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
		$con = "AND BATCHNO='".$BATCHNO."' ";
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
							<center><b><font size=4>Batch Wise Food Distribute Summary Report</FONT></b></center>
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

						<td align='center' valign='middle'  style='border: 1px dotted #000'>Batch No.</td>
						
						<td align='center' valign='middle'  style='border: 1px dotted #000'>Food Name</td>
						
						<td align='center' valign='middle'  style='border: 1px dotted #000'>Total KG</td>

						<td align='center' valign='middle' style='border: 1px dotted #000'>Total Taka</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>AVG Price</td>
						
												
					</tr>";

// Query here.
						$BasicQueryA		= "SELECT FOODID
													FROM feed_fooditem
													
											"; 
						$BasicQueryAStatement				= mysql_query($BasicQueryA);
						$i = 0;
						while($BasicQueryAStatementData		= mysql_fetch_array($BasicQueryAStatement)){	
							$FOODID_ARRAY[] 				= $BasicQueryAStatementData['FOODID'];
							$i++;
						}
						
						$FOODID_ARRAY_UNIQUE = array_unique($FOODID_ARRAY);
						$SL 				=1;
						$Global_Food_Qnty	=0;	
						$Global_Total_Taka	=0;	
						$Avg_Price			=0;
						foreach($FOODID_ARRAY_UNIQUE as $individualFood){
						
						$BatchOpenQuery 		= "SELECT 	SUM(FOODWEIGHT) FOODWEIGHT,
															SUM(TOTALPRICE) TOTALPRICE,
															BATCHNO
														FROM pal_fooddistribute
														WHERE FDDATE BETWEEN '".$OPENINGDATE_FROM."' AND '".$OPENINGDATE_TO."'
														AND FOODID = '".$individualFood."'
														{$con}
														ORDER BY FOODID ASC
												"; 
						$BatchOpenQueryStatement				= mysql_query($BatchOpenQuery);
						while($BatchOpenQueryStatementData		= mysql_fetch_array($BatchOpenQueryStatement)){	
							$FOODWEIGHT		 					= $BatchOpenQueryStatementData['FOODWEIGHT'];
							$TOTALPRICE					 		= $BatchOpenQueryStatementData['TOTALPRICE'];
							$BATCHNO_FOOD				 		= $BatchOpenQueryStatementData['BATCHNO'];
						}
							
														
						$DailyOperation_Query 		= "SELECT 	FOODNAME
															FROM feed_fooditem
															WHERE FOODID = '".$individualFood."'
															ORDER BY FOODID ASC
													"; 
							$DailyOperation_QueryStatement				= mysql_query($DailyOperation_Query);
							while($DailyOperation_QueryStatementData	= mysql_fetch_array($DailyOperation_QueryStatement)){	
								$FOODNAME		 		 				= $DailyOperation_QueryStatementData['FOODNAME'];
								
							}
							
							if($FOODWEIGHT != NULL){
							$Global_Food_Qnty			= $Global_Food_Qnty + $FOODWEIGHT ;
							$Global_Total_Taka			= $Global_Total_Taka + $TOTALPRICE ; 
							$Avg_Price					= $TOTALPRICE / $FOODWEIGHT ; 
								
								
							$tableView .=" <tr>
												<td align='center' valign='top' style='border: 1px dotted #000'>$SL</td>
	
												<td align='center' valign='top'  style='border: 1px dotted #000'>$BATCHNO_FOOD</td>
												
												<td align='center' valign='top'  style='border: 1px dotted #000'>$FOODNAME</td>
												
												<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($FOODWEIGHT,2)."</td>
												
												<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($TOTALPRICE,2)."</td>
												
												<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($Avg_Price,2)."</td>
											
											</tr>

									 	";
							// Dynamic Row End	
							
	
						$SL++;	
						}
					}

					$tableView .="

						<tr style='font-weight:bold;' bgcolor='#CCCCCC'>

							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='center' valign='top'  style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='center' valign='top'  style='border: 1px dotted #000'>&nbsp;</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_Food_Qnty,2)."</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_Total_Taka,2)."</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
							
						</tr>
						<tr>

							<td colspan='6' align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

						</tr>
							
						<tr>

							<td colspan='6' align='left' valign='top'>&nbsp;</td>

						</tr>
						<tr>

							<td colspan='6' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='6' align='left' valign='top' >&nbsp;</td>

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

							<td colspan='6' align='left' valign='top' >&nbsp;</td>

						</tr>
						<tr>

							<td colspan='6' align='left' valign='top' >&nbsp;</td>

						</tr>					

					</table>";
	echo $tableView;

?>