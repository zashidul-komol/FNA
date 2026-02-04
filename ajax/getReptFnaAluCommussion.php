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
	$con = '';
	
			//$con = '';
		$Last_Date = date_create($ENTRYDATE_TO);
		date_sub($Last_Date, date_interval_create_from_date_string('1 days'));
		$LastDay = date_format($Last_Date, 'Y-m-d');

		$projectSql 	= "
							SELECT  p.PROJECTNAME, 
									sp.SUBPROJECTNAME											
							FROM fna_project p, fna_subproject sp
							WHERE p.PROJECTID = sp.PROJECTID
							AND p.PROJECTID = '".$PROJECTID."'
							AND sp.SUBPROJECTID = '".$SUBPROJECTID."'
						";
			$projectSqlStatement				= mysql_query($projectSql);
			while($projectSqlStatementData		= mysql_fetch_array($projectSqlStatement)){
				$PROJECTNAME        			= $projectSqlStatementData["PROJECTNAME"];
				$SUBPROJECTNAME       			= $projectSqlStatementData["SUBPROJECTNAME"];
			}
			
		
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
							<center><b><font size=4>Alu Commission Report</FONT></b></center>
							<center>&nbsp;</center>
							<center><b><font size=2>Date : $ENTRYDATE_FROM to $ENTRYDATE_TO </font></b></center>
						</td>
					  </tr>
					  <tr>

						<td colspan='18' align='left' valign='top'>
							<table width='100%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:100%;'>
								  
								  <tr>
								
									<td width='14%' align='left' valign='top'>Project Name<b></td>
									<td width='1%' align='center' valign='top'>:</td>
									<td width='34%' align='left' valign='top'> $PROJECTNAME</td>
									<td width='18%' align='right' valign='top'>&nbsp;</td>
									<td width='20%' align='left' valign='top'>&nbsp;</td>
									<td align='left' valign='top'>&nbsp;</td>
								
								  </tr>
								  <tr>
								
									<td width='14%' align='left' valign='top'>Sub Project Name<b></td>
									<td width='1%' align='center' valign='top'>:</td>
									<td width='34%' align='left' valign='top'> $SUBPROJECTNAME</td>
									<td width='18%' align='right' valign='top'>&nbsp;</td>
									<td width='20%' align='left' valign='top'>&nbsp;</td>
									<td align='left' valign='top'>&nbsp;</td>
								
								  </tr>
								  
								
								</table>
							

						</td>

					  </tr>
					  <tr style='font-weight:bold;'>

						<td align='center' valign='middle' style='font-weight:bold;border: 1px dotted #000'>SL No.</td>
						
						<td align='center' valign='middle' style='font-weight:bold;border: 1px dotted #000'>Party Name</td>

						<td align='center' valign='middle'  style='border: 1px dotted #000'>Load Quantity</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Unload Quantity</td>

						<td align='center' valign='middle' style='border: 1px dotted #000'>Balance</td>

						<td align='center' valign='middle' style='border: 1px dotted #000'>Avg. Comm Rate </td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Total Commission </td>
						
					</tr>";

// Query here.

					$PARTY_ARRAY 	= array();
					$PartyQuery 	= "SELECT DISTINCT (p.PARTYID)
											FROM fna_party p
											WHERE p.PROJECTID 	= '".$PROJECTID."'
											AND p.SUBPROJECTID 	= '".$SUBPROJECTID."'
																						
										"; 
						$PartyQueryStatement				= mysql_query($PartyQuery);
						$i = 0;
						while($PartyQueryStatementData	= mysql_fetch_array($PartyQueryStatement)){	
							$PARTY_ARRAY[] 				= $PartyQueryStatementData['PARTYID'];
							$i++;
						}
						$SL = 1;
						
						$Global_Load_qnty = 0;
						$Global_Unload_qnty = 0;
						
						$Global_Total_Comm = 0;
						$Global_Balance_qnty = 0;
						
						$PARTY_ARRAY_UNIQUE 	= array_unique($PARTY_ARRAY) ;
						foreach($PARTY_ARRAY_UNIQUE as $individualParty){
							
							$stock_Query 	= "SELECT   sum( ast.LOADQUANTITY ) loadqnty, 
															sum( ast.UNLOADQUANTITY ) unloadqnty
													FROM fna_alustock ast, fna_productloadunload lul, fna_productloadunloadbkdn bkdn
													WHERE lul.PRODUCTLOADUNLOADID = bkdn.PRODUCTLOADUNLOADID
													AND bkdn.PRODUCTLOADUNLOADBKDNID = ast.PRODUCTLOADUNLOADBKDNID
													AND lul.ENTRYDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
													AND ast.PROJECTID = '".$PROJECTID."'
													AND ast.SUBPROJECTID = '".$SUBPROJECTID."'
													AND ast.PARTYID = '".$individualParty."'
													";
							$stock_QueryStatement			= mysql_query($stock_Query);
							$loadqnty = 0;
							$unloadqnty	=0;
							while($stock_QueryStatementData	= mysql_fetch_array($stock_QueryStatement)){	
								$loadqnty					= $stock_QueryStatementData['loadqnty'];
								$unloadqnty					= $stock_QueryStatementData['unloadqnty'];
							}
							
							$Global_Load_qnty = $Global_Load_qnty + $loadqnty;
							$Global_Unload_qnty = $Global_Unload_qnty + $unloadqnty ;
							
							$Balance_Qnty	= $loadqnty - $unloadqnty ; 
							$Global_Balance_qnty = $Global_Balance_qnty + $Balance_Qnty ; 
							
							$Comm_Query = "SELECT   SUM(com.TOTALCOMMISSION) TotalComm
													FROM fna_alucommission com
													WHERE com.PARTYID = '".$individualParty."'
													AND com.COMMDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
													";
							$Comm_QueryStatement					= mysql_query($Comm_Query);
							while($Comm_QueryStatementData			= mysql_fetch_array($Comm_QueryStatement)){	
								$TotalComm		 					= $Comm_QueryStatementData['TotalComm'];
								
							}
							
							$Global_Total_Comm = $Global_Total_Comm + $TotalComm;
							$AvgCommRate	= $TotalComm / $unloadqnty ; 
							
							$PartyName_Query = "SELECT   par.PARTYNAME
													FROM fna_party par
													WHERE par.PARTYID = '".$individualParty."'
													";
							$PartyName_QueryStatement				= mysql_query($PartyName_Query);
							while($PartyName_QueryStatementData		= mysql_fetch_array($PartyName_QueryStatement)){	
								$PARTYNAME		 					= $PartyName_QueryStatementData['PARTYNAME'];
								
							}
							
							if($TotalComm > 0){	
							
						$tableView .=" <tr>
											<td width='10%' align='center' valign='top' style='border: 1px dotted #000'>$sl</td>
											
											<td width='30%' align='center' valign='top' style='border: 1px dotted #000'>$PARTYNAME</td>

											<td width='15%' align='right' valign='top' style='border: 1px dotted #000'> $loadqnty</td>
											
											<td width='15%' align='right' valign='top'  style='border: 1px dotted #000'>$unloadqnty</td>
					
											<td width='10%' align='right' valign='top' style='border: 1px dotted #000'>$Balance_Qnty</td>
					
											<td width='10%' align='right' valign='top' style='border: 1px dotted #000'>".number_format($AvgCommRate,2)."</td>
											
											<td width='10%' align='right' valign='top' style='border: 1px dotted #000'>".number_format($TotalComm,2)."</td>
					
										</tr>

									 ";

								// Dynamic Row End		  
						
						
				$sl++;
					}
				}
		

					$tableView .="

						<tr>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='RIGHT' valign='top'  style='border: 1px dotted #000'>$Global_Load_qnty</td>
							
							<td align='RIGHT' valign='top' style='border: 1px dotted #000'>$Global_Unload_qnty</td>

							<td align='right' valign='top' style='border: 1px dotted #000'><b>$Global_Balance_qnty</b></td>

							<td align='RIGHT' valign='top' style='border: 1px dotted #000'><b>".number_format($TOTAL_AMOUNT,2)."</b></td>
							
							<td align='RIGHT' valign='top' style='border: 1px dotted #000'><b>".number_format($Global_Total_Comm,2)."</b></td>
							
						</tr>
						<tr>

							<td colspan='7' align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

						</tr>
							
						<tr>

							<td colspan='7' align='left' valign='top'>&nbsp;</td>

						</tr>
						<tr>

							<td colspan='7' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='7' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='7' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='7' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='7' align='left' valign='top' >
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

							<td colspan='7' align='left' valign='top' >&nbsp;</td>

						</tr>
						<tr>

							<td colspan='7' align='left' valign='top' >&nbsp;</td>

						</tr>					

					</table>";
	echo $tableView;

?>