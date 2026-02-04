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
	//$BATCHNO 			= $_REQUEST['BATCHNO'];
	$userId 			= $_REQUEST['userId'];
	
	/*if ($BATCHNO == 'All'){
		$con = '';
	}else{
		$con = "AND es.BATCHNO='".$BATCHNO."' ";
	}
	*/	
	
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
							<center><b><font size=4>Egg Production Summary Report</FONT></b></center>
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
						
						<td align='center' valign='middle'  style='border: 1px dotted #000'>Month Opening Murgi Qnty</td>
						
						<td align='center' valign='middle'  style='border: 1px dotted #000'>Monthly Dead/Sell/Cancel Qnty</td>
						
						<td align='center' valign='middle'  style='border: 1px dotted #000'>Month Closing Murgi Qnty</td>
						
						<td align='center' valign='middle'  style='border: 1px dotted #000'>Egg Qnty</td>

						<td align='center' valign='middle' style='border: 1px dotted #000'>Percentage</td>
						
												
					</tr>";

// Query here.
						$BasicQueryA		= "SELECT BATCHNO
													FROM pal_egg_production
													WHERE EPDATE BETWEEN '".$OPENINGDATE_FROM."' AND '".$OPENINGDATE_TO."'
													ORDER BY BATCHNO ASC
											"; 
						$BasicQueryAStatement				= mysql_query($BasicQueryA);
						$i = 0;
						while($BasicQueryAStatementData		= mysql_fetch_array($BasicQueryAStatement)){	
							$BATCHNO_ARRAY[] 				= $BasicQueryAStatementData['BATCHNO'];
							$i++;
						}
						
						$BATCHNO_ARRAY_UNIQUE = array_unique($BATCHNO_ARRAY);
						$SL = 1;
						$Global_Murgi_Quantity 	= 0;
						$Global_Egg_Quantity 	= 0;
						$Global_Prod_Perc	 	= 0;
							
						foreach($BATCHNO_ARRAY_UNIQUE as $individualBatch){
						$BasicQuery_Hatch 		= "SELECT 	SUM(es.MURGIQNTY) MURGIQNTY,
													  		SUM(es.EGGQNTY) EGGQNTY
												FROM pal_egg_production es
												WHERE es.BATCHNO = '".$individualBatch."'
												AND es.EPDATE BETWEEN '".$OPENINGDATE_FROM."' AND '".$OPENINGDATE_TO."'
												AND es.STATUS != 'Out'
												ORDER BY es.EPDATE ASC
										"; 
						$BasicQuery_HatchStatement				= mysql_query($BasicQuery_Hatch);
						while($BasicQuery_HatchStatementData	= mysql_fetch_array($BasicQuery_HatchStatement)){	
							$MURGIQNTY		 					= $BasicQuery_HatchStatementData['MURGIQNTY'];
							$EGGQNTY		 					= $BasicQuery_HatchStatementData['EGGQNTY'];
							
						}
						
						
						$BasicQuery_Start 	= "SELECT 	ep.MURGIQNTY,
												  		ep.EPDATE
												FROM pal_egg_production ep
												WHERE ep.BATCHNO = '".$individualBatch."'
												AND ep.EPDATE = '".$OPENINGDATE_FROM."' 
												AND ep.STATUS != 'Out'
											"; 
						$BasicQuery_StartStatement				= mysql_query($BasicQuery_Start);
						$MURGIQNTY_START = 0;
						while($BasicQuery_StartStatementData	= mysql_fetch_array($BasicQuery_StartStatement)){	
							$MURGIQNTY_START 					= $BasicQuery_StartStatementData['MURGIQNTY'];
							
						}
						
						$Global_MURGIQNTY_START				= $Global_MURGIQNTY_START + $MURGIQNTY_START ; 
						
						$BasicQuery_End 	= "SELECT 	ep.MURGIQNTY,
												  		ep.EPDATE
												FROM pal_egg_production ep
												WHERE ep.BATCHNO = '".$individualBatch."'
												AND ep.EPDATE = '".$OPENINGDATE_TO."' 
												AND ep.STATUS != 'Out'
											"; 
						$BasicQuery_EndStatement				= mysql_query($BasicQuery_End);
						$MURGIQNTY_END = 0;
						while($BasicQuery_EndStatementData		= mysql_fetch_array($BasicQuery_EndStatement)){	
							$MURGIQNTY_END	 					= $BasicQuery_EndStatementData['MURGIQNTY'];
							
						}
						$Global_Murgi_End_Qnty					= $Global_Murgi_End_Qnty + $MURGIQNTY_END ; 
						
						$MURGI_STOCK_QNTY			= $MURGIQNTY_START - $MURGIQNTY_END ; 
						$Global_Murgi_Dead_Qnty		= $Global_Murgi_Dead_Qnty + $MURGI_STOCK_QNTY ; 
						
						$Global_Murgi_Quantity		= $Global_Murgi_Quantity + $MURGIQNTY ; 
						$Global_Egg_Quantity		= $Global_Egg_Quantity + $EGGQNTY ; 
						$Percentage					= ($EGGQNTY * 100)/$MURGIQNTY ; 
						$Global_Prod_Perc			= ($Global_Egg_Quantity * 100)/$Global_Murgi_Quantity ; 
							
						$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000'>$SL</td>

											<td align='center' valign='top'  style='border: 1px dotted #000'>$individualBatch</td>
											
											<td align='center' valign='top'  style='border: 1px dotted #000'>$MURGIQNTY_START</td>
											
											<td align='center' valign='top'  style='border: 1px dotted #000'>$MURGI_STOCK_QNTY</td>
											
											<td align='center' valign='top'  style='border: 1px dotted #000'>$MURGIQNTY_END</td>
											
											<td align='center' valign='top'  style='border: 1px dotted #000'>$EGGQNTY</td>
											
											<td align='center' valign='top'  style='border: 1px dotted #000'>".number_format($Percentage,2)."</td>
											
										</tr>

									 ";
							// Dynamic Row End		  

					$SL++;	
				
				}

					$tableView .="

						<tr style='font-weight:bold;' bgcolor='#CCCCCC'>

							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='center' valign='top'  style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='center' valign='top'  style='border: 1px dotted #000'>$Global_MURGIQNTY_START</td>
							
							<td align='center' valign='top'  style='border: 1px dotted #000'>$Global_Murgi_Dead_Qnty</td>

							<td align='center' valign='top'  style='border: 1px dotted #000'>$Global_Murgi_End_Qnty</td>
							
							<td align='center' valign='top' style='border: 1px dotted #000'>$Global_Egg_Quantity</td>
							
							<td align='center' valign='top' style='border: 1px dotted #000'>".number_format($Global_Prod_Perc,2)."</td>

						</tr>
						<tr>

							<td colspan='14' align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

						</tr>
							
						<tr>

							<td colspan='14' align='left' valign='top'>&nbsp;</td>

						</tr>
						<tr>

							<td colspan='14' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='14' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='14' align='left' valign='top' >&nbsp;</td>

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