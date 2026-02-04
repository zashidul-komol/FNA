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
							<center><b><font size=4>Alu Stock Summary Report</FONT></b></center>
							<center>&nbsp;</center>
							<center><b><font size=2>Date : $ENTRYDATE_FROM to $ENTRYDATE_TO </font></b></center>
						</td>
					  </tr>
					  
					  <tr style='font-weight:bold;'>

						<td align='center' valign='middle' style='font-weight:bold;border: 1px dotted #000'>Product Fare</td>

						<td align='center' valign='middle'  style='border: 1px dotted #000'>Load Basta</td>
						
						<td align='center' valign='middle'  style='border: 1px dotted #000'>Load Bill</td>
                        
                        <td align='center' valign='middle'  style='border: 1px dotted #000'>Unload Basta</td>
						
						<td align='center' valign='middle'  style='border: 1px dotted #000'>Unload Bill</td>
						
						<td align='center' valign='middle'  style='border: 1px dotted #000'>Avg. Rate </td>

						<td align='center' valign='middle' style='border: 1px dotted #000'>Balance Basta</td>
						
						<td align='center' valign='middle'  style='border: 1px dotted #000'>Balance Bill</td>
						
					</tr>";

// Query here.

						//$TOTAL_RECEIVE_QNTY_KG ='';
						$PACKINGUNITID_ARRAY  	= array();
						
						$PackUnitIdQuery 				= "SELECT 	DISTINCT p.PACKINGUNITID
																FROM fna_productfare p 
																WHERE 	p.PROJECTID 	= '".$PROJECTID."'
																AND 	p.SUBPROJECTID 	= '".$SUBPROJECTID."'
																ORDER BY p.PACKINGUNITID  ASC
															"; 
						$PackUnitIdQueryStatement			= mysql_query($PackUnitIdQuery);
						$i = 0;
						while($PackUnitIdQueryStatementData	= mysql_fetch_array($PackUnitIdQueryStatement)){	
							$PACKINGUNITID_ARRAY[] 			= $PackUnitIdQueryStatementData['PACKINGUNITID'];
							$i++;
						}
						$global_UnLoad_qnty 	= 0;
						$global_Load_qnty 		= 0;
						$QUANTITY_Load 			= 0;
						$QUANTITY_Unload 		= 0;
						$Global_Load_Bill		= 0;
						$Global_UnLoad_Bill		= 0;
						$Global_Balance_Bill	= 0;
						$Global_Avg_Rate		= 0;
						$PACKINGUNITID_ARRAY_UNIQUE 	= array_unique($PACKINGUNITID_ARRAY) ;
						foreach($PACKINGUNITID_ARRAY_UNIQUE as $individualPackUnit){
						
							/*$party_flag 		= mysql_fetch_array(mysql_query("SELECT MAX(PARTYFLAG) FROM fna_alustock WHERE PARTYID = '".$individualParty."'"));
							$MaxPartyFlag 		= $party_flag['MAX(PARTYFLAG)'];
								*/
							$ProductFare_Query 	= "SELECT   pf.UNITFARE
													FROM fna_productfare pf
													WHERE pf.PACKINGUNITID = '".$individualPackUnit."'
													AND pf.PROJECTID = '".$PROJECTID."'
													AND pf.SUBPROJECTID = '".$SUBPROJECTID."'
													";
							$ProductFare_QueryStatement					= mysql_query($ProductFare_Query);
							while($ProductFare_QueryStatementData		= mysql_fetch_array($ProductFare_QueryStatement)){	
								$UNITFARE 								= $ProductFare_QueryStatementData['UNITFARE'];
								
							}
							$Load_Query 	= "SELECT   SUM(als.LOADQUANTITY) LOADQUANTITY,
														SUM(als.UNLOADQUANTITY) UNLOADQUANTITY
															FROM fna_alustock als, fna_product p, fna_productloadunload pl, fna_productloadunloadbkdn bkdn
													WHERE p.PRODUCTID = als.PRODUCTID
													AND als.PRODUCTLOADUNLOADBKDNID = bkdn.PRODUCTLOADUNLOADBKDNID
													AND bkdn.PRODUCTLOADUNLOADID = pl.PRODUCTLOADUNLOADID
													AND als.PROJECTID = '".$PROJECTID."'
													AND als.SUBPROJECTID = '".$SUBPROJECTID."'
													AND als.PACKINGUNITID = '".$individualPackUnit."'
													AND pl.ENTRYDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."' 
												";
							$Load_QueryStatement			= mysql_query($Load_Query);
							$Load_Bill		= 0;
							$Unload_Bill	= 0;
							$Balance_Bill	= 0;
							$Avg_Rate		= 0;
							
							while($Load_QueryStatementData	= mysql_fetch_array($Load_QueryStatement)){	
								$QUANTITY_Load 				= $Load_QueryStatementData['LOADQUANTITY'];
								$QUANTITY_UnLoad			= $Load_QueryStatementData['UNLOADQUANTITY'];
								
							}	
							
							$Load_Bill					= $QUANTITY_Load * $UNITFARE ; 
							$Unload_Bill				= $QUANTITY_UnLoad * $UNITFARE ;
							$Balance_Bill				= $Load_Bill - $Unload_Bill ;
							
							$Avg_Rate					= $Load_Bill / $QUANTITY_Load ;
							$Global_Load_Bill			= $Global_Load_Bill + $Load_Bill;
							$Global_UnLoad_Bill			= $Global_UnLoad_Bill + $Unload_Bill;
							$Global_Balance_Bill		= $Global_Balance_Bill + $Balance_Bill;
							$global_Load_qnty 			= $global_Load_qnty + $QUANTITY_Load ;
							$global_UnLoad_qnty 		= $global_UnLoad_qnty + $QUANTITY_UnLoad ; 
							
							$Global_Avg_Rate			= $Global_Load_Bill / $global_Load_qnty ;  
							
							$Balance_Qnty 				= $QUANTITY_Load - $QUANTITY_UnLoad ;
							$Global_Balance_Qnty		= $global_Load_qnty - $global_UnLoad_qnty ; 
							
						if($QUANTITY_Load > 0)
						{	
						$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000'>$UNITFARE</td>

											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($QUANTITY_Load,2)."</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Load_Bill,2)."</td>
					
											<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($QUANTITY_UnLoad,2)."</td>
											
											<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($Unload_Bill,2)."</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Avg_Rate,2)."</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Balance_Qnty,2)."</td>
											
											<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($Balance_Bill,2)."</td>
											
										</tr>

									 ";
						}

								// Dynamic Row End		  

						
				
				}

					$tableView .="

						<tr style='font-weight:bold;'>

							<td align='right' valign='top' style='border: 1px dotted #000'>Grand Total : </td>

							<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($global_Load_qnty,2)."</td>
							
							<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($Global_Load_Bill,2)."</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($global_UnLoad_qnty,2)."</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_UnLoad_Bill,2)."</td>
							
							<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($Global_Avg_Rate,2)."</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_Balance_Qnty,2)."</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_Balance_Bill,2)."</td>
							
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
									<td align='right' width='34%' valign='bottom' ><hr width='200' ></td>
									<td width='33%' valign='bottom' ><hr width='200' ></td>
									<td width='33%' valign='bottom' ><hr width='200' ></td>
									<td width='33%' valign='bottom' ><hr width='200' ></td>
									<td width='33%' valign='bottom' ><hr width='200' ></td>
								  </tr>
								  <tr>
									<td align='center' valign='top'  ><b>Asst. General Manager </b></td>
									<td  align='center' valign='top'  ><b>General Manager </b></td>
									<td align='center' valign='top'  ><b>Chief Executive Officer</b></td>
									<td align='center' valign='top'  ><b>Head of IT </b></td>
									<td align='center' valign='top'  ><b>Managing Director</b></td>
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