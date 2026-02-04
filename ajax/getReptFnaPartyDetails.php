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
	$PARTYID 			= $_REQUEST['PARTYID'];
	$ENTRYDATE_FROM 	= showDateMySQlFormat($_REQUEST['ENTRYDATE']);
	$ENTRYDATE_TO 		= showDateMySQlFormat($_REQUEST['ENTRYDATE2']);
	$userId 			= $_REQUEST['userId'];
	$con = '';
	
	
	//Ministry/Division and Project/Programme Name View Report Start	
	
	
		$con = "AND p.PARTYID='".$PARTYID."' ";

		$partySql 	= "
							SELECT p.PARTYNAME, p.FATHERNAME, p.ADDRESS, p.MOBILE											
							FROM fna_party p
							WHERE 1=1
							{$con}
							ORDER BY p.PARTYNAME ASC
						";
			$partySqlStatement				= mysql_query($partySql);
			while($partySqlStatementData	= mysql_fetch_array($partySqlStatement)){
				$PARTYNAME        			= $partySqlStatementData["PARTYNAME"];
				$FATHERNAME       			= $partySqlStatementData["FATHERNAME"];
				$ADDRESS       				= $partySqlStatementData["ADDRESS"];
				$MOBILE       				= $partySqlStatementData["MOBILE"];
			}
		
			
	 	$projectSql 	= "
							SELECT PROJECTNAME											
							FROM fna_project 
							WHERE PROJECTID = '".$PROJECTID."'
							
						";
			$projectSqlStatement				= mysql_query($projectSql);
			while($projectSqlStatementData		= mysql_fetch_array($projectSqlStatement)){
				$PROJECTNAME       				= $projectSqlStatementData["PROJECTNAME"];
				
			}
			
			//Ministry/Division and Project/Programme Name View Report End
			
	$tableView = "";	
	$tableView .="<table width='60%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:85%; border: 1px dotted #000'>
					<tr>
                            <td style='text-align:right;' colspan='18'>
                            <a href='javascript:Clickheretoprint()'><img border='0' src='images/print_icon.jpg' width='40' height='26' /></a>                        
                            </td>
                     </tr>
					  <tr>
						<td colspan='13' align='center' valign='middle' style='border: 1px dotted #000'>
							<center><b><font size=5>F N A Group Of Company</font></b></center>
							<center>&nbsp;</center>
							<center><b><font size=3>FNA Party Details Report</FONT></b></center>
							<center>&nbsp;</center>
							<center><b><font size=2>Date : $ENTRYDATE_FROM to $ENTRYDATE_TO </font></b></center>
						</td>
					  </tr> 
					  <tr>

						<td colspan='8' align='left' valign='top'>
							<table width='100%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:100%;'>
								  <tr style='font-weight:bold;'>
								
									<td width='14%' align='left' valign='top'>Project Name <b></td>
									<td width='1%' align='center' valign='top'>:</td>
									<td width='34%' align='left' valign='top'>$PROJECTNAME  </td>
									
								  </tr>
								
								  <tr>
								
									<td align='left' valign='top'>Party Name</td>
									<td align='center' valign='top'>:</td>
								
									<td align='left' valign='top'> $PARTYNAME </td>
									<td align='right' valign='top'>&nbsp;</td>
									
								  </tr>
								
								  <tr>
								
									<td align='left' valign='top'>Address</td>
									<td align='center' valign='top'>:</td>
								
									<td align='left' valign='top'>$ADDRESS </td>
									<td align='right' valign='top'>&nbsp;</td>
									
								  </tr>
								
								  <tr>
								
									<td align='left' valign='top'>Mobile</td>
									<td align='center' valign='top'>:</td>
								
									<td align='left' valign='top'>$MOBILE </td>
									<td align='right' valign='top'>&nbsp;</td>
									
								  </tr>
								
								  <tr>
								
									<td align='left' valign='top'>&nbsp;</td>
									<td align='center' valign='top'>&nbsp;</td>
								
									<td align='left' valign='top'>&nbsp;</td>
									<td align='right' valign='top'>&nbsp;</td>
									
								  </tr>
								
								</table>
							

						</td>

					  </tr>

					  <tr style='font-weight:bold;'>

						<td align='center' valign='top' style='font-weight:bold;border: 1px dotted #000'>SL No.</td>
						
						<td align='center' valign='top'  style='border: 1px dotted #000'>Date</td>

						<td align='center' valign='top'  style='border: 1px dotted #000'>Party Name</td>

						<td align='center' valign='top' style='border: 1px dotted #000'>Pur Bill Amount </td>
						
						<td align='center' valign='top' style='border: 1px dotted #000'>Sell Bill Amount </td>

						<td align='center' valign='top' style='border: 1px dotted #000'>Payment Amount</td>

						<td align='right' valign='top' style='border: 1px dotted #000'>Receive Amount</td>

						<td align='right' valign='top' style='border: 1px dotted #000'>Balance Amount  </td>
						
					</tr>";

// Query here.


							
							// Party Details Information View Report Start 	 <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<		
								
								
								$Party_Query 	= "SELECT 	p.PUR_BILLAMOUNT,
																p.SELL_BILLAMOUNT,
																p.PAYMENTAMOUNT,
																p.RECEIVEAMOUNT,
																p.BALANCEAMOUNT,
																p.ENTRYDATE,
																p.PROJECTID,
																party.PARTYNAME
															FROM fna_partybill p, fna_party party
															WHERE party.PARTYID = p.PARTYID
															AND p.PROJECTID = '".$PROJECTID."'
															AND p.SUBPROJECTID = '".$SUBPROJECTID."'
															{$con}
															AND p.ENTRYDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
															ORDER BY p.ENTRYDATE ASC
															
															
														";
								$Party_QueryStatement						= mysql_query($Party_Query);
								$sl = 1;
								
								$Global_PURBILLAMOUNT = 0;
								$Global_SELLBILLAMOUNT = 0;
								$Global_PAYMENTAMOUNT = 0;
								$Global_RECEIVEAMOUNT = 0;
								$Global_BALANCEAMOUNT = 0;
								$FinalBalance = 0;
								$Balance = 0;
								
								while($Party_QueryStatementData				= mysql_fetch_array($Party_QueryStatement)){	
									$PURBILLAMOUNT							= $Party_QueryStatementData['PUR_BILLAMOUNT'];
									$SELLBILLAMOUNT							= $Party_QueryStatementData['SELL_BILLAMOUNT'];
									$PAYMENTAMOUNT							= $Party_QueryStatementData['PAYMENTAMOUNT'];
									$RECEIVEAMOUNT							= $Party_QueryStatementData['RECEIVEAMOUNT'];
									$BALANCEAMOUNT							= $Party_QueryStatementData['BALANCEAMOUNT'];
									$ENTRYDATE								= $Party_QueryStatementData['ENTRYDATE'];
									$PARTYNAME								= $Party_QueryStatementData['PARTYNAME'];
									
							
								//echo 'komol';
							//-----------------------------------------------------------------
							$Balance				= $SELLBILLAMOUNT + $PAYMENTAMOUNT - $PURBILLAMOUNT - $RECEIVEAMOUNT ; 
							$FinalBalance			= $FinalBalance + $Balance ; 
							//echo  $FinalBalance	;
							//echo 'komol';
 						// Dynamic Row Start
						
						$Global_PURBILLAMOUNT	=	$Global_PURBILLAMOUNT + $PURBILLAMOUNT ;
						$Global_SELLBILLAMOUNT	=	$Global_SELLBILLAMOUNT + $SELLBILLAMOUNT ;
						$Global_PAYMENTAMOUNT	=	$Global_PAYMENTAMOUNT + $PAYMENTAMOUNT ;
						$Global_RECEIVEAMOUNT	=	$Global_RECEIVEAMOUNT + $RECEIVEAMOUNT ;
						$Global_BALANCEAMOUNT	=	$Global_BALANCEAMOUNT + $FinalBalance ;

						$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000'>$sl</td>

											<td align='center' valign='top' style='border: 1px dotted #000'> $ENTRYDATE</td>
											
											<td align='center' valign='top' style='border: 1px dotted #000'> $PARTYNAME</td>
					
											<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($PURBILLAMOUNT,2)."</td>
											
											<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($SELLBILLAMOUNT,2)."</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($PAYMENTAMOUNT,2)." </td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($RECEIVEAMOUNT,2)."</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($FinalBalance,2)."</td>
					
											
										</tr>

									 ";
									 $sl++;
								}

								// Dynamic Row End		  
					/*echo 
					}	
				*/
				

					$tableView .="

						<tr style='font-weight:bold;'>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top'  style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='right' valign='top'  style='border: 1px dotted #000'>Total:</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_PURBILLAMOUNT,2)."</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_SELLBILLAMOUNT,2)."</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_PAYMENTAMOUNT,2)."</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_RECEIVEAMOUNT,2)."</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
							
							
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
								  </tr>
								  <tr>
									<td align='center' valign='top'  ><b>Cashier Signature</b></td>
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