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
							<center><b><font size=4>Batch Wise Live Summary Report</FONT></b></center>
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
						
						<td align='center' valign='middle'  style='border: 1px dotted #000'>Batch Live Qnty</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Dead Qnty</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Cancel Qnty</td>
						
						<td align='center' valign='middle'  style='border: 1px dotted #000'>Sell Qnty</td>
                        
                        <td align='center' valign='middle'  style='border: 1px dotted #000'>Morog Qnty</td>
						
						<td align='center' valign='middle'  style='border: 1px dotted #000'>Murgi Qnty</td>

						<td align='center' valign='middle' style='border: 1px dotted #000'>Live Balance Qnty</td>

						
					</tr>";

// Query here.
						$BasicQueryA		= "SELECT DISTINCT BATCHNO
													FROM pal_batchopen
													WHERE PROJECTID = 3
													AND STATUS = 'Active'
													ORDER BY BATCHNO ASC
											"; 
						$BasicQueryAStatement				= mysql_query($BasicQueryA);
						$i = 0;
						while($BasicQueryAStatementData		= mysql_fetch_array($BasicQueryAStatement)){	
							$BATCHNO_ARRAY[] 				= $BasicQueryAStatementData['BATCHNO'];
							$i++;
						}
						
						$BATCHNO_ARRAY_UNIQUE = array_unique($BATCHNO_ARRAY);
						$SL 				=1;
						$DEAD_QUANTITY		=0;	
						$CANCEL_QUANTITY	=0;	
						$SELL_QUANTITY		=0;	
						$BALANCE_QUANTITY	=0;	
						$Global_LiveQnty	=0;	
						$Global_LivePrice	=0;	
						$Global_DeadQnty	=0;	
						$Global_CancelQnty	=0;	
						$Global_SellQnty	=0;	
						$Global_BalanceQnty	=0;	
						$Global_MurgiQnty	=0;	
						$Global_MorogQnty	=0;	
						foreach($BATCHNO_ARRAY_UNIQUE as $individualBatch){
						
						$BatchOpenQuery 		= "SELECT 	SUM(BWISELIVESTOCK) BWISELIVESTOCK,
															SUM(PRICE) PRICE
														FROM pal_batchopen
														WHERE PROJECTID = 3
														AND BATCHNO = '".$individualBatch."'
														ORDER BY BATCHNO ASC
												"; 
						$BatchOpenQueryStatement				= mysql_query($BatchOpenQuery);
						while($BatchOpenQueryStatementData		= mysql_fetch_array($BatchOpenQueryStatement)){	
							$BWISELIVESTOCK	 					= $BatchOpenQueryStatementData['BWISELIVESTOCK'];
							$BATCH_OPEN_PRICE			 		= $BatchOpenQueryStatementData['PRICE'];
						}
							
							
														
						$DailyOperation_Query 		= "SELECT 	SUM(DEADSTOCK) DEADSTOCK,
																SUM(CANCELSTOCK) CANCELSTOCK,
																SUM(SELLSTOCK) SELLSTOCK
															FROM pal_dailyoperation
															WHERE DODATE BETWEEN '".$OPENINGDATE_FROM."' AND '".$OPENINGDATE_TO."'
															AND BATCHNO = '".$individualBatch."'
															ORDER BY DODATE ASC
													"; 
							$DailyOperation_QueryStatement				= mysql_query($DailyOperation_Query);
							while($DailyOperation_QueryStatementData	= mysql_fetch_array($DailyOperation_QueryStatement)){	
								$DEADSTOCK_DAILY 		 				= $DailyOperation_QueryStatementData['DEADSTOCK'];
								$CANCELSTOCK_DAILY 		 				= $DailyOperation_QueryStatementData['CANCELSTOCK'];
								$SELLSTOCK_DAILY 						= $DailyOperation_QueryStatementData['SELLSTOCK'];
								
							}
							
							$Morog_Query 				= "SELECT 	SUM(DEADSTOCK) DEADSTOCK,
																	SUM(CANCELSTOCK) CANCELSTOCK,
																	SUM(SELLSTOCK) SELLSTOCK
															FROM pal_morog
															WHERE ENTRYDATE BETWEEN '".$OPENINGDATE_FROM."' AND '".$OPENINGDATE_TO."'
															AND BATCHNO = '".$individualBatch."'
															ORDER BY ENTRYDATE ASC
													"; 
							$Morog_QueryStatement						= mysql_query($Morog_Query);
							while($Morog_QueryStatementData				= mysql_fetch_array($Morog_QueryStatement)){	
								$DEADSTOCK_MOROG 		 				= $Morog_QueryStatementData['DEADSTOCK'];
								$CANCELSTOCK_MOROG 		 				= $Morog_QueryStatementData['CANCELSTOCK'];
								$SELLSTOCK_MOROG 						= $Morog_QueryStatementData['SELLSTOCK'];
								
							}
							
							$Morog_Live_Flag_Qry			=  mysql_fetch_array(mysql_query("SELECT MAX(BATCHFLAG) FROM pal_morog WHERE BATCHNO = '".$individualBatch."' AND ENTRYDATE BETWEEN '".$OPENINGDATE_FROM."' AND '".$OPENINGDATE_TO."'"));
							$MaxMorogFlag					= $Morog_Live_Flag_Qry['MAX(BATCHFLAG)'];
							
							$Live_Morog_Query 				= "SELECT 	STOCKINHAND
																	FROM pal_morog
																	WHERE BATCHNO = '".$individualBatch."'
																	AND BATCHFLAG = '".$MaxMorogFlag."'
																	ORDER BY ENTRYDATE ASC
															"; 
							$Live_Morog_QueryStatement					= mysql_query($Live_Morog_Query);
							$STOCKINHAND_MOROG = 0;
							while($Live_Morog_QueryStatementData		= mysql_fetch_array($Live_Morog_QueryStatement)){	
								$STOCKINHAND_MOROG 		 				= $Live_Morog_QueryStatementData['STOCKINHAND'];
								
							}
							
							$Murgi_Query 				= "SELECT 	SUM(DEADSTOCK) DEADSTOCK,
																	SUM(CANCELSTOCK) CANCELSTOCK,
																	SUM(SELLSTOCK) SELLSTOCK
															FROM pal_murgi
															WHERE ENTRYDATE BETWEEN '".$OPENINGDATE_FROM."' AND '".$OPENINGDATE_TO."'
															AND BATCHNO = '".$individualBatch."'
															ORDER BY ENTRYDATE ASC
													"; 
							$Murgi_QueryStatement						= mysql_query($Murgi_Query);
							while($Murgi_QueryStatementData				= mysql_fetch_array($Murgi_QueryStatement)){	
								$DEADSTOCK_MURGI 		 				= $Murgi_QueryStatementData['DEADSTOCK'];
								$CANCELSTOCK_MURGI 		 				= $Murgi_QueryStatementData['CANCELSTOCK'];
								$SELLSTOCK_MURGI 						= $Murgi_QueryStatementData['SELLSTOCK'];
								
							}
							
							$Murgi_Live_Flag_Qry			=  mysql_fetch_array(mysql_query("SELECT MAX(BATCHFLAG) FROM pal_murgi WHERE BATCHNO = '".$individualBatch."' AND ENTRYDATE BETWEEN '".$OPENINGDATE_FROM."' AND '".$OPENINGDATE_TO."'"));
							$MaxMurgiFlag					= $Murgi_Live_Flag_Qry['MAX(BATCHFLAG)'];
							
							
							$Murgi_Query_Live 				= "SELECT 	STOCKINHAND
															FROM pal_murgi
															WHERE BATCHNO = '".$individualBatch."'
															AND BATCHFLAG = '".$MaxMurgiFlag."'
															ORDER BY ENTRYDATE ASC
													"; 
							$Murgi_Query_LiveStatement					= mysql_query($Murgi_Query_Live);
							$STOCKINHAND_MURGI	= 0;
							while($Murgi_Query_LiveStatementData		= mysql_fetch_array($Murgi_Query_LiveStatement)){	
								$STOCKINHAND_MURGI 		 				= $Murgi_Query_LiveStatementData['STOCKINHAND'];
								
							}
							
							$MurgiMorogSell_Query 				= "SELECT 	SUM(MURGIQNTY) MURGIQNTY,
																			SUM(MOROGQNTY) MOROGQNTY
																	FROM pal_morog_murgi_sell
																	WHERE MMSELLDATE BETWEEN '".$OPENINGDATE_FROM."' AND '".$OPENINGDATE_TO."'
																	AND BATCHNO = '".$individualBatch."'
																	ORDER BY MMSELLDATE ASC
															"; 
							$MurgiMorogSell_QueryStatement					= mysql_query($MurgiMorogSell_Query);
							while($MurgiMorogSell_QueryStatementData		= mysql_fetch_array($MurgiMorogSell_QueryStatement)){	
								$MURGIQNTY_MURGI_MOROG 		 				= $MurgiMorogSell_QueryStatementData['MURGIQNTY'];
								$MOROGQNTY_MURGI_MOROG 		 				= $MurgiMorogSell_QueryStatementData['MOROGQNTY'];
								
							}
							
							$DEAD_QUANTITY			= 	$DEADSTOCK_DAILY + $DEADSTOCK_MOROG + $DEADSTOCK_MURGI ; 
							$CANCEL_QUANTITY		= 	$CANCELSTOCK_DAILY + $CANCELSTOCK_MOROG + $CANCELSTOCK_MURGI ;
							$SELL_QUANTITY			= 	$SELLSTOCK_DAILY + $SELLSTOCK_MOROG + $SELLSTOCK_MURGI + $MURGIQNTY_MURGI_MOROG + $MOROGQNTY_MURGI_MOROG ;
							$BALANCE_QUANTITY		= 	$BWISELIVESTOCK - ($SELL_QUANTITY + $DEAD_QUANTITY + $CANCEL_QUANTITY) ; 
							
							$Global_LiveQnty		= $Global_LiveQnty + $BWISELIVESTOCK ; 
							$Global_LivePrice		= $Global_LivePrice + $BATCH_OPEN_PRICE ;
							$Global_DeadQnty		= $Global_DeadQnty + $DEAD_QUANTITY ;
							$Global_CancelQnty		= $Global_CancelQnty + $CANCEL_QUANTITY ;
							$Global_SellQnty		= $Global_SellQnty + $SELL_QUANTITY ;
							$Global_BalanceQnty		= $Global_BalanceQnty + $BALANCE_QUANTITY ;
							//$Global_MurgiQnty		= $Global_MurgiQnty + $MURGIQNTY_MURGI_MOROG ;
							//$Global_MorogQnty		= $Global_MorogQnty + $MOROGQNTY_MURGI_MOROG ;
							$Global_MurgiQnty		= $Global_MurgiQnty + $STOCKINHAND_MURGI;
							$Global_MorogQnty		= $Global_MorogQnty + $STOCKINHAND_MOROG ;
								
						$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000'>$SL</td>

											<td align='center' valign='top'  style='border: 1px dotted #000'>$individualBatch</td>
											
											<td align='center' valign='top'  style='border: 1px dotted #000'>$BWISELIVESTOCK</td>
											
											<td align='right' valign='top'  style='border: 1px dotted #000'>$DEAD_QUANTITY</td>
											
											<td align='right' valign='top'  style='border: 1px dotted #000'>$CANCEL_QUANTITY</td>
											
											<td align='right' valign='top'  style='border: 1px dotted #000'>$SELL_QUANTITY</td>
											
											<td align='right' valign='top'  style='border: 1px dotted #000'>$STOCKINHAND_MOROG</td>
											
											<td align='right' valign='top'  style='border: 1px dotted #000'>$STOCKINHAND_MURGI</td>
											
											<td align='right' valign='top'  style='border: 1px dotted #000'>$BALANCE_QUANTITY</td>
											
											
										</tr>

									 ";
							// Dynamic Row End		  

					$SL++;	
				
				}

					$tableView .="

						<tr style='font-weight:bold;' bgcolor='#CCCCCC'>

							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='center' valign='top'  style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='center' valign='top'  style='border: 1px dotted #000'>$Global_LiveQnty</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>$Global_DeadQnty</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>$Global_CancelQnty</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>$Global_SellQnty</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>$Global_MorogQnty</td>

							<td align='right' valign='top'  style='border: 1px dotted #000'>$Global_MurgiQnty</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>$Global_BalanceQnty</td>
							
							
						</tr>
						<tr>

							<td colspan='9' align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

						</tr>
							
						<tr>

							<td colspan='9' align='left' valign='top'>&nbsp;</td>

						</tr>
						<tr>

							<td colspan='9' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='9' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='10' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='9' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='9' align='left' valign='top' >
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

							<td colspan='9' align='left' valign='top' >&nbsp;</td>

						</tr>
						<tr>

							<td colspan='9' align='left' valign='top' >&nbsp;</td>

						</tr>					

					</table>";
	echo $tableView;

?>