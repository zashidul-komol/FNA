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
	$ENTRYDATE_FROM 	= showDateMySQlFormat($_REQUEST['ENTRYDATE']);
	$ENTRYDATE_TO 		= showDateMySQlFormat($_REQUEST['ENTRYDATE2']);
	$userId 			= $_REQUEST['userId'];
	
		$Last_Date = date_create($ENTRYDATE_TO);
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
			
			$SubProjectSql 	= "
							SELECT  sp.SUBPROJECTNAME											
							FROM fna_subproject sp
							WHERE sp.SUBPROJECTID = '".$SUBPROJECTID."'
							
						";
			$SubProjectSqlStatement				= mysql_query($SubProjectSql);
			while($SubProjectSqlStatementData	= mysql_fetch_array($SubProjectSqlStatement)){
				$SUBPROJECTNAME        			= $SubProjectSqlStatementData["SUBPROJECTNAME"];
				
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
							<center><b><font size=4>LOT Wise $SUBPROJECTNAME Stock Report</FONT></b></center>
							<center>&nbsp;</center>
							<center><b><font size=2>Date : $ENTRYDATE_FROM to $ENTRYDATE_TO </font></b></center>
						</td>
					  </tr>
					  
					  <tr style='font-weight:bold;'>

						<td align='center' valign='middle' style='font-weight:bold;border: 1px dotted #000'>SL No.</td>
						
						<td align='center' valign='middle'  style='border: 1px dotted #000'>LOT NO. </td>

						<td align='center' valign='middle'  style='border: 1px dotted #000'>Party Name</td>
						
						<td align='center' valign='middle'  style='border: 1px dotted #000'>Load Quantity</td>
                        
                        <td align='center' valign='middle'  style='border: 1px dotted #000'>Unload Quantity</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Balance Basta</td>
						
					</tr>";

// Query here.

						//$TOTAL_RECEIVE_QNTY_KG ='';
						$LOTNO_ARRAY  				= array();
						$SL = 1;
						$AluLotQuery 				= "SELECT 	DISTINCT als.LOTNO
																FROM fna_alustock als 
																WHERE als.PROJECTID 	= '".$PROJECTID."'
																AND als.SUBPROJECTID 	= '".$SUBPROJECTID."'
																AND als.ENTRYDATE BETWEEN '".$ENTRYDATE_FROM."' and '".$ENTRYDATE_TO."'
															"; 
						$AluLotQueryStatement				= mysql_query($AluLotQuery);
						$i = 0;
						while($AluLotQueryStatementData		= mysql_fetch_array($AluLotQueryStatement)){	
							$LOTNO_ARRAY[] 					= $AluLotQueryStatementData['LOTNO'];
							$i++;
						}
						
						
						$global_UnLoad_qnty 	= 0;
						$global_Load_qnty 		= 0;
						$QUANTITY_Load 			= 0;
						$QUANTITY_Unload 		= 0;
						$Global_Load_Bill	=	0;
						$Global_Avg_Rate	=	0;
						$LOTNO_ARRAY_UNIQUE 		= array_unique($LOTNO_ARRAY) ;
						foreach($LOTNO_ARRAY_UNIQUE as $individualLotNo){
						
							
							$Load_Query 	= "SELECT   SUM(als.LOADQUANTITY) LOADQUANTITY,
														SUM(als.UNLOADQUANTITY) UNLOADQUANTITY,
														p.PARTYNAME
															FROM fna_alustock als, fna_party p
													WHERE p.PARTYID = als.PARTYID
													AND als.PROJECTID = '".$PROJECTID."'
													AND als.SUBPROJECTID = '".$SUBPROJECTID."'
													AND als.LOTNO = '".$individualLotNo."'
													AND als.ENTRYDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."' 
												";
							$Load_QueryStatement			= mysql_query($Load_Query);
							
							while($Load_QueryStatementData	= mysql_fetch_array($Load_QueryStatement)){	
								$QUANTITY_Load 				= $Load_QueryStatementData['LOADQUANTITY'];
								$QUANTITY_UnLoad			= $Load_QueryStatementData['UNLOADQUANTITY'];
								$PARTYNAME					= $Load_QueryStatementData['PARTYNAME'];
								
							}	
							
							$global_Load_qnty 			= $global_Load_qnty + $QUANTITY_Load ;
							$global_UnLoad_qnty 		= $global_UnLoad_qnty + $QUANTITY_UnLoad ; 
							
							//$Global_Avg_Rate			= $Global_Load_Bill / $global_Load_qnty ;  
							
							$Balance_Qnty 				= $QUANTITY_Load - $QUANTITY_UnLoad ;
							$Global_Balance_Qnty		= $global_Load_qnty - $global_UnLoad_qnty ; 
							
							if($Balance_Qnty > 0){
							
						$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000'>$SL</td>

											<td align='right' valign='top' style='border: 1px dotted #000'>$individualLotNo</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>$PARTYNAME</td>
					
											<td align='center' valign='top'  style='border: 1px dotted #000'>$QUANTITY_Load</td>
											
											<td align='center' valign='top' style='border: 1px dotted #000'>$QUANTITY_UnLoad</td>
											
											<td align='center' valign='top' style='border: 1px dotted #000'>$Balance_Qnty</td>
											
										</tr>

									 ";
							}
								// Dynamic Row End		  
					$SL++;
						
				
				}

					$tableView .="

						<tr style='font-weight:bold;'>

							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='right' valign='top'  style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='right' valign='top'  style='border: 1px dotted #000'>Total Balance : </td>

							<td align='center' valign='top' style='border: 1px dotted #000'>".number_format($global_Load_qnty)."</td>
							
							<td align='center' valign='top'  style='border: 1px dotted #000'>".number_format($global_UnLoad_qnty)."</td>

							<td align='center' valign='top' style='border: 1px dotted #000'>".number_format($Global_Balance_Qnty)."</td>
							
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
									<td align='right' width='34%' valign='bottom' ><hr width='200' ></td>
									<td width='33%' valign='bottom' ><hr width='200' ></td>
									<td width='33%' valign='bottom' ><hr width='200' ></td>
								  </tr>
								  <tr>
									<td align='center' valign='top'  ><b>Store Keeper Signature</b></td>
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