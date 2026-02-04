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
	$PARTYID			= $_REQUEST['PARTYID'];
	$ENTRYDATE_FROM 	= showDateMySQlFormat($_REQUEST['ENTRYDATE']);
	$ENTRYDATE_TO		= showDateMySQlFormat($_REQUEST['ENTRYDATE2']);
	$userId 			= $_REQUEST['userId'];
	
	if ($PARTYID == 'All'){
		$con = '';
	}else{
		$con = "AND PARTYID ='".$PARTYID."' ";
	}
		if($PARTYID == 'All'){ 
			$PARTYNAME = 'All Party';
			$FATHERNAME ='';
			$ADDRESS = '';
			$MOBILE  = '';
		}else{
		//Ministry/Division and Project/Programme Name View Report Start				
	 	$partySql 	= "
							SELECT p.PARTYNAME, p.FATHERNAME, p.ADDRESS, p.MOBILE											
							FROM fna_party p
							WHERE p.PARTYID = $PARTYID
						";
			$partySqlStatement				= mysql_query($partySql);
			while($partySqlStatementData	= mysql_fetch_array($partySqlStatement)){
				$PARTYNAME        		= $partySqlStatementData["PARTYNAME"];
				$FATHERNAME       		= $partySqlStatementData["FATHERNAME"];
				$ADDRESS       		= $partySqlStatementData["ADDRESS"];
				$MOBILE       			= $partySqlStatementData["MOBILE"];
			}
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
							<center><b><font size=4>Party Statement Report</FONT></b></center>
							<center>&nbsp;</center>
							<center><b><font size=4>Poultry Firm</FONT></b></center>
							<center><b><font size=2>Date : $ENTRYDATE_FROM to $ENTRYDATE_TO </font></b></center>
						</td>
					  </tr>
					  <tr>

						<td colspan='18' align='left' valign='top'>
							<table width='100%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:100%;'>
								  <tr>
								
									<td width='14%' align='left' valign='top'>Party Name<b></td>
									<td width='1%' align='center' valign='top'>:</td>
									<td width='34%' align='left' valign='top'> $PARTYNAME</td>
									<td width='18%' align='right' valign='top'>&nbsp;</td>
									<td width='1%' align='center' valign='top'>&nbsp;</td>
									<td width='20%' align='left' valign='top'>&nbsp;</td>
									<td align='left' valign='top'>&nbsp;</td>
								
								  </tr>
								
								  <tr>
								
									<td align='left' valign='top'>Address</td>
									<td align='center' valign='top'>:</td>
								
									<td align='left' valign='top'> $ADDRESS </td>
									<td align='right' valign='top'>&nbsp;</td>
									<td align='center' valign='top'>&nbsp;</td>
									<td align='left' valign='top'>&nbsp;</td>
									<td align='left' valign='top'> &nbsp;</td>
								
								  </tr>
								
								  <tr>
								
									<td align='left' valign='top'>Party Father Name</td>
									<td align='center' valign='top'>:</td>
								
									<td align='left' valign='top'>$FATHERNAME </td>
									<td align='right' valign='top'>&nbsp;</td>
									<td align='center' valign='top'>&nbsp;</td>
									<td align='left' valign='top'>&nbsp;</td>
									<td align='left' valign='top'>&nbsp;</td>
								
								  </tr>
								
								  <tr>
								
									<td align='left' valign='top'>Mobile</td>
									<td align='center' valign='top'>:</td>
								
									<td align='left' valign='top'>$MOBILE </td>
									<td align='right' valign='top'>&nbsp;</td>
									<td align='center' valign='top'>&nbsp;</td>
									<td align='left' valign='top'>&nbsp;</td>
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

						<td colspan='8' align='center' valign='middle' style='font-weight:bold;border: 1px dotted #000'><font size='+1'>Sales History</font></td>
										
					</tr>
					  <tr style='font-weight:bold;'>

						<td align='center' valign='middle' style='font-weight:bold;border: 1px dotted #000'>SL No.</td>
						
						<td align='center' valign='middle'  style='border: 1px dotted #000'>Date</td>

						<td align='center' valign='middle'  style='border: 1px dotted #000'>Product Name.</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Party Name</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Quantity</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Unit Price</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Total Price</td>
						
																	
					</tr>";

// Query here.
						//$TOTAL_RECEIVE_QNTY_KG ='';
						$TOTPRICE_EGGSELL_global = 0;
						$SELLPRICE_MOROG_global = 0;
						$SELLPRICE_MURGI_global = 0;
						$SELLPRICE_DAILY_global = 0;
						$globalRecAmount = 0;
						$SELLSTOCK_MURGI_global = 0;
						$SELLSTOCK_MOROG_global = 0;
						$Global_SELLSTOCK_Total = 0;
						$Global_SELLPRICE_Total = 0;
						
						$SL = 1;
							$MorogQuery 	= "SELECT ENTRYDATE
													FROM pal_morog 
													WHERE PROJECTID = '".$PROJECTID."'
													AND SUBPROJECTID = '".$SUBPROJECTID."'
													{$con}
													AND ENTRYDATE between '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."' 
													ORDER BY ENTRYDATE ASC
												"; 
							$MorogQueryStatement			= mysql_query($MorogQuery);
							$i = 0;
							while($MorogQueryStatementData	= mysql_fetch_array($MorogQueryStatement)){	
								$ENTRYDATE_ARRAY[]			= $MorogQueryStatementData['ENTRYDATE'];
								$i++;
							}
							
							$MurgiQuery 	= "SELECT ENTRYDATE
														FROM pal_murgi 
														WHERE PROJECTID = '".$PROJECTID."'
														AND SUBPROJECTID = '".$SUBPROJECTID."'
														{$con}
														AND ENTRYDATE between '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."' 
														ORDER BY ENTRYDATE ASC
												"; 
							$MurgiQueryStatement			= mysql_query($MurgiQuery);
							$i = 0;
							while($MurgiQueryStatementData	= mysql_fetch_array($MurgiQueryStatement)){	
								$ENTRYDATE_ARRAY[]			= $MurgiQueryStatementData['ENTRYDATE'];
								$i++;
							}
							
							$DailyQuery 	= "SELECT DODATE
														FROM pal_dailyoperation 
														WHERE PROJECTID = '".$PROJECTID."'
														AND SUBPROJECTID = '".$SUBPROJECTID."'
														{$con}
														AND DODATE between '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."' 
														ORDER BY DODATE ASC
												"; 
							$DailyQueryStatement			= mysql_query($DailyQuery);
							$i = 0;
							while($DailyQueryStatementData	= mysql_fetch_array($DailyQueryStatement)){	
								$ENTRYDATE_ARRAY[]			= $DailyQueryStatementData['DODATE'];
								$i++;
							}
							
							$EggSellQuery 	= "SELECT ESDATE
														FROM pal_egg_sell 
														WHERE PROJECTID = '".$PROJECTID."'
														AND SUBPROJECTID = '".$SUBPROJECTID."'
														{$con}
														AND ESDATE between '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."' 
														ORDER BY ESDATE ASC
												"; 
							$EggSellQueryStatement			= mysql_query($EggSellQuery);
							$i = 0;
							while($EggSellQueryStatementData	= mysql_fetch_array($EggSellQueryStatement)){	
								$ENTRYDATE_ARRAY[]				= $EggSellQueryStatementData['ESDATE'];
								$i++;
							}
							
							$PartyQuery 	= "SELECT ENTRYDATE
														FROM fna_partybill 
														WHERE PROJECTID = '".$PROJECTID."'
														AND SUBPROJECTID = '".$SUBPROJECTID."'
														{$con}
														AND ENTRYDATE between '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."' 
														ORDER BY ENTRYDATE ASC
												"; 
							$PartyQueryStatement				= mysql_query($PartyQuery);
							while($PartyQueryStatementData		= mysql_fetch_array($PartyQueryStatement)){	
								$ENTRYDATE_ARRAY[]				= $PartyQueryStatementData['ENTRYDATE'];
								$i++;
							}
							
							$ENTRYDATE_ARRAY_UNIQUE = array_unique($ENTRYDATE_ARRAY) ;
							foreach($ENTRYDATE_ARRAY_UNIQUE as $individualDate){
							if ($PARTYID == 'All'){
								$con_mor = '';
							}else{
								$con_mor = "AND mor.PARTYID ='".$PARTYID."' ";
							}
							$Morog_Query 	= "SELECT sum(mor.SELLPRICE) SELLPRICE,
													  sum(mor.SELLSTOCK) SELLSTOCK,
													  p.PARTYNAME
													FROM pal_morog mor, fna_party p 
													WHERE mor.PROJECTID = '".$PROJECTID."'
													AND mor.SUBPROJECTID = '".$SUBPROJECTID."'
													AND p.PARTYID = mor.PARTYID
													{$con_mor}
													AND mor.ENTRYDATE = '".$individualDate."' 
													ORDER BY '".$individualDate."' ASC
												";
							$Morog_QueryStatement			= mysql_query($Morog_Query);
							$Name = '';
							$SELLPRICE_MOROG = '';
							$SELLSTOCK_MOROG = '';
							while($Morog_QueryStatementData	= mysql_fetch_array($Morog_QueryStatement)){	
								$SELLPRICE_MOROG			= $Morog_QueryStatementData['SELLPRICE'];
								$SELLSTOCK_MOROG			= $Morog_QueryStatementData['SELLSTOCK'];
								$PARTYNAME_MOROG			= $Morog_QueryStatementData['PARTYNAME'];
								
								if($SELLSTOCK_MOROG > 0){
									$UnitPrice = $SELLPRICE_MOROG / $SELLSTOCK_MOROG ;
								$Name	= 'Morog Sell';	
								$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000'>$SL</td>
											<td align='center' valign='top'  style='border: 1px dotted #000'>$individualDate</td>
											<td align='center' valign='top'  style='border: 1px dotted #000'>$Name</td>
											<td align='center' valign='top'  style='border: 1px dotted #000'>$PARTYNAME_MOROG</td>
											<td align='center' valign='top'  style='border: 1px dotted #000'>$SELLSTOCK_MOROG</td>
											<td align='center' valign='top'  style='border: 1px dotted #000'>".number_format($UnitPrice,2)."</td>
											<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($SELLPRICE_MOROG,2)."</td>
									</tr> ";
								}
							}
							if ($PARTYID == 'All'){
								$con_mur = '';
							}else{
								$con_mur = "AND mur.PARTYID ='".$PARTYID."' ";
							}
							$Murgi_Query 	= "SELECT sum(mur.SELLPRICE) SELLPRICE,
													  sum(mur.SELLSTOCK) SELLSTOCK,
													  p.PARTYNAME
													FROM pal_murgi mur, fna_party p
													WHERE mur.PROJECTID = '".$PROJECTID."'
													AND mur.SUBPROJECTID = '".$SUBPROJECTID."'
													AND p.PARTYID = mur.PARTYID
													{$con_mur}
													AND mur.ENTRYDATE = '".$individualDate."' 
													ORDER BY '".$individualDate."' ASC
												"; 
							$Murgi_QueryStatement			= mysql_query($Murgi_Query);
							$Name	= '';
							while($Murgi_QueryStatementData	= mysql_fetch_array($Murgi_QueryStatement)){	
								$SELLPRICE_MURGI			= $Murgi_QueryStatementData['SELLPRICE'];
								$SELLSTOCK_MURGI			= $Murgi_QueryStatementData['SELLSTOCK'];
								$PARTYNAME_MURGI			= $Murgi_QueryStatementData['PARTYNAME'];
								
								if($SELLSTOCK_MURGI > 0){
									$UnitPrice 					= $SELLPRICE_MURGI / $SELLSTOCK_MURGI ;
								$Name	= 'Murgi Sell';	
								$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000'>$SL</td>
											<td align='center' valign='top'  style='border: 1px dotted #000'>$individualDate</td>
											<td align='center' valign='top'  style='border: 1px dotted #000'>$Name</td>
											<td align='center' valign='top'  style='border: 1px dotted #000'>$PARTYNAME_MURGI</td>
											<td align='center' valign='top'  style='border: 1px dotted #000'>$SELLSTOCK_MURGI</td>
											<td align='center' valign='top'  style='border: 1px dotted #000'>".number_format($UnitPrice,2)."</td>
											<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($SELLPRICE_MURGI,2)."</td>
									</tr> ";
									}	
							}
							if ($PARTYID == 'All'){
								$con_daily = '';
							}else{
								$con_daily = "AND daily.PARTYID ='".$PARTYID."' ";
							}	
							$Daily_Query 	= "SELECT sum(daily.SELLPRICE) SELLPRICE,
													  sum(daily.SELLSTOCK) SELLSTOCK,
													  p.PARTYNAME
													FROM pal_dailyoperation daily, fna_party p 
													WHERE daily.PROJECTID = '".$PROJECTID."'
													AND daily.SUBPROJECTID = '".$SUBPROJECTID."'
													AND p.PARTYID = daily.PARTYID
													{$con_daily}
													AND daily.DODATE = '".$individualDate."' 
													ORDER BY '".$individualDate."' ASC
												"; 
							$Daily_QueryStatement			= mysql_query($Daily_Query);
							while($Daily_QueryStatementData	= mysql_fetch_array($Daily_QueryStatement)){	
								$SELLPRICE_DAILY			= $Daily_QueryStatementData['SELLPRICE'];
								$SELLSTOCK_DAILY			= $Daily_QueryStatementData['SELLSTOCK'];
								$PARTYNAME_DAILY			= $Daily_QueryStatementData['PARTYNAME'];
								
								if($SELLSTOCK_DAILY > 0){
									$UnitPrice = $SELLPRICE_DAILY / $SELLSTOCK_DAILY ;
								$Name	= 'Chicken Sell';	
								$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000'>$SL</td>
											<td align='center' valign='top'  style='border: 1px dotted #000'>$individualDate</td>
											<td align='center' valign='top'  style='border: 1px dotted #000'>$Name</td>
											<td align='center' valign='top'  style='border: 1px dotted #000'>$PARTYNAME_DAILY</td>
											<td align='center' valign='top'  style='border: 1px dotted #000'>$SELLSTOCK_DAILY</td>
											<td align='center' valign='top'  style='border: 1px dotted #000'>".number_format($UnitPrice,2)."</td>
											<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($SELLPRICE_DAILY,2)."</td>
									</tr> ";
								}
							}
							if ($PARTYID == 'All'){
								$con_egg = '';
							}else{
								$con_egg = "AND egg.PARTYID ='".$PARTYID."' ";
							}	
							$EggSell_Query 	= "SELECT sum(egg.TOTPRICE) TOTPRICE,
													  sum(egg.QUANTITY) QUANTITY,
													  p.PARTYNAME
													FROM pal_egg_sell egg, fna_party p
													WHERE egg.PROJECTID = '".$PROJECTID."'
													AND egg.SUBPROJECTID = '".$SUBPROJECTID."'
													AND p.PARTYID = egg.PARTYID
													{$con_egg}
													AND egg.ESDATE = '".$individualDate."' 
													ORDER BY '".$individualDate."' ASC
												"; 
							$EggSell_QueryStatement				= mysql_query($EggSell_Query);
							while($EggSell_QueryStatementData	= mysql_fetch_array($EggSell_QueryStatement)){	
								$TOTPRICE_EGGSELL				= $EggSell_QueryStatementData['TOTPRICE'];
								$QUANTITY_EGGSELL				= $EggSell_QueryStatementData['QUANTITY'];
								$PARTYNAME_EGGSELL				= $EggSell_QueryStatementData['PARTYNAME'];
								
								if($QUANTITY_EGGSELL > 0){
									$UnitPrice = $TOTPRICE_EGGSELL / $QUANTITY_EGGSELL ;
								$Name	= 'Egg Sell';	
								$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000'>$SL</td>
											<td align='center' valign='top'  style='border: 1px dotted #000'>$individualDate</td>
											<td align='center' valign='top'  style='border: 1px dotted #000'>$Name</td>
											<td align='center' valign='top'  style='border: 1px dotted #000'>$PARTYNAME_EGGSELL</td>
											<td align='center' valign='top'  style='border: 1px dotted #000'>$QUANTITY_EGGSELL</td>
											<td align='center' valign='top'  style='border: 1px dotted #000'>".number_format($UnitPrice,2)."</td>
											<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($TOTPRICE_EGGSELL,2)."</td>
									</tr> ";
								}
								
							}	
							
							$SELLPRICE_Total = $SELLPRICE_MOROG + $SELLPRICE_MURGI + $SELLPRICE_DAILY + $TOTPRICE_EGGSELL ;
							$SELLSTOCK_Total = $SELLSTOCK_MOROG + $SELLSTOCK_MURGI + $SELLSTOCK_DAILY + $QUANTITY_EGGSELL ;
							
							$Global_SELLPRICE_Total = $Global_SELLPRICE_Total + $SELLPRICE_Total ; 
							$Global_SELLSTOCK_Total = $Global_SELLSTOCK_Total + $SELLSTOCK_Total ; 
							
							$partyReceiveAmount = "
														SELECT
																PARTYID,
																SUM(RECEIVEAMOUNT) AS RECAMOUNT
														FROM
																fna_partybill 
														WHERE PROJECTID = '".$PROJECTID."'
														AND SUBPROJECTID = '".$SUBPROJECTID."'
														{$con}
														AND ENTRYDATE = '".$individualDate."' 
													";
							$partyReceiveAmountQueryStatement				= mysql_query($partyReceiveAmount);
							while($partyReceiveAmountQueryStatementData		= mysql_fetch_array($partyReceiveAmountQueryStatement)) {
									$RECEIVEAMOUNT 							= $partyReceiveAmountQueryStatementData["RECAMOUNT"];	
								}
								$globalRecAmount 	= $globalRecAmount + $RECEIVEAMOUNT ; 
								$partyBalAmount 	= $Global_SELLPRICE_Total - $globalRecAmount ; 
						
														
							

								// Dynamic Row End		  

					$SL++;	
				
				}

					$tableView .="

						<tr style='font-weight:bold;'>

							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='center' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='center' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='center' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='center' valign='top' style='border: 1px dotted #000'>$Global_SELLSTOCK_Total</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($Global_SELLPRICE_Total,2)."</td>

							
						</tr>
						<tr>

							<td colspan='8' align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

						</tr>
						<tr>

							<td colspan='8' align='center' valign='top' style='border: 1px dotted #000'><font size='+1'>Purchase History Feed Mill</font></td>

						</tr>";
						if ($PARTYID == 'All'){
								$con_fs = '';
							}else{
								$con_fs = "AND fs.PARTYID ='".$PARTYID."' ";
							}	
						
				$PoultryExpQuery 	= "SELECT fs.FOODID,
											  fs.QUANTITY,
											  fs.AMOUNT,
											  fs.AVGPRICE,
											  fs.SELLAVGPRICE,
											  fs.FOODFLAG,
											  fs.STATUS,
											  fs.ENTDATE,
											  fi.FOODNAME,
											  p.PARTYNAME
											FROM feed_finishedstock fs, feed_fooditem fi, fna_party p
											WHERE fi.FOODID = fs.FOODID
											AND p.PARTYID = fs.PARTYID
											{$con_fs}
											AND fs.ENTDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
											AND fs.PROJECTID = '2'
											AND fs.SUBPROJECTID = '6'
											
								";
				$PoultryExpQueryStatement			= mysql_query($PoultryExpQuery);
				$SLF = 1;
				$Global_Quantity_Feed = 0;
				$Global_Total_Price_Feed = 0;
				$RECEIVEAMOUNT_FEED = 0;
				$GLOBAL_BALANCE_FEED = 0;
				$PAYMENTAMOUNT_FEED = 0;
				while($PoultryExpQueryStatementData		= mysql_fetch_array($PoultryExpQueryStatement)){	
					$FOODID			 					= $PoultryExpQueryStatementData['FOODID'];
					$QUANTITY_FEED	 					= $PoultryExpQueryStatementData['QUANTITY'];
					$AMOUNT_FEED	 					= $PoultryExpQueryStatementData['AMOUNT'];
					$SELLAVGPRICE	 					= $PoultryExpQueryStatementData['SELLAVGPRICE'];
					$FOODFLAG		 					= $PoultryExpQueryStatementData['FOODFLAG'];
					$ENTDATE		 					= $PoultryExpQueryStatementData['ENTDATE'];
					$FOODNAME		 					= $PoultryExpQueryStatementData['FOODNAME'];
					$PARTYNAME_POULTRY 					= $PoultryExpQueryStatementData['PARTYNAME'];
					
					$Global_Quantity_Feed		= $Global_Quantity_Feed + $QUANTITY_FEED ; 
					$Global_Total_Price_Feed	= $Global_Total_Price_Feed + $AMOUNT_FEED;
					
					if ($PARTYID == 'All'){
								$con_fp = '';
							}else{
								$con_fp = "AND fp.PARTYID ='".$PARTYID."' ";
							}	
					$partyReceiveAmountFeed = "
												SELECT
														SUM(RECEIVEAMOUNT) AS RECEIVEAMOUNT
												FROM
														fna_partybill fp
												WHERE fp.PROJECTID = '".$PROJECTID."'
												AND fp.SUBPROJECTID = '".$SUBPROJECTID."'
												{$con_fp}
												AND fp.ENTRYDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
										";
					$partyReceiveAmountFeedStatement				= mysql_query($partyReceiveAmountFeed);
					while($partyReceiveAmountFeedStatementData		= mysql_fetch_array($partyReceiveAmountFeedStatement)) {
							$RECEIVEAMOUNT_FEED						= $partyReceiveAmountFeedStatementData["RECEIVEAMOUNT"];	
						}
					
						
					$partyPaymentAmountFeed = "
												SELECT
														SUM(PAYMENTAMOUNT) AS PAYMENTAMOUNT
												FROM
														fna_partybill fp
												WHERE fp.PROJECTID = '".$PROJECTID."'
												AND fp.SUBPROJECTID = '".$SUBPROJECTID."'
												{$con_fp}
												AND fp.ENTRYDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
										";
					$partyPaymentAmountFeedStatement				= mysql_query($partyPaymentAmountFeed);
					while($partyPaymentAmountFeedStatementData		= mysql_fetch_array($partyPaymentAmountFeedStatement)) {
							$PAYMENTAMOUNT_FEED						= $partyPaymentAmountFeedStatementData["PAYMENTAMOUNT"];	
						}
								
						
				
					
							
					
				$tableView .="
							<tr>
								<td align='center' valign='top' style='border: 1px dotted #000'>$SLF</td>
								
								<td align='center' valign='top'  style='border: 1px dotted #000'>$ENTDATE</td>
								
								<td align='center' valign='top'  style='border: 1px dotted #000'>$FOODNAME</td>
								
								<td align='center' valign='top'  style='border: 1px dotted #000'>$PARTYNAME_POULTRY</td>
																			
								<td align='center' valign='top'  style='border: 1px dotted #000'>$QUANTITY_FEED</td>
								
								<td align='center' valign='top'  style='border: 1px dotted #000'>".number_format($SELLAVGPRICE,2)."</td>
								
								<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($AMOUNT_FEED,2)."</td>
																			
							 </tr>
							 
						  ";
							$SLF ++;
						}
						if ($PARTYID == 'All'){
								$con_pchksale = '';
							}else{
								$con_pchksale = "AND pchksale.PARTYID ='".$PARTYID."' ";
							}	
							$pchksale_Query 	= "SELECT 	pchksale.QUANTITY,
													  			pchksale.PRICE,
																pchksale.AVGRATE,
																pchksale.CHICKENPURDATE,
													  			p.PARTYNAME
													FROM pal_chicken_purchase pchksale, fna_party p 
													WHERE pchksale.PROJECTID = '".$PROJECTID."'
													AND pchksale.SUBPROJECTID = '".$SUBPROJECTID."'
													AND p.PARTYID = pchksale.PARTYID
													{$con_pchksale}
													AND pchksale.STATUS = 'Buy'
													AND pchksale.CHICKENPURDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
													
												"; 
							$pchksale_QueryStatement			= mysql_query($pchksale_Query);
							while($pchksale_QueryStatementData	= mysql_fetch_array($pchksale_QueryStatement)){	
								$QUANTITY_ChickenSale			= $pchksale_QueryStatementData['QUANTITY'];
								$PRICE_ChickenSale			    = $pchksale_QueryStatementData['PRICE'];
								$AVGRATE_ChickenSale			= $pchksale_QueryStatementData['AVGRATE'];
								$CHICKENPURDATE_ChickenSale		= $pchksale_QueryStatementData['CHICKENPURDATE'];
								$PARTYNAME_ChickenSale			= $pchksale_QueryStatementData['PARTYNAME'];
								
								$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000'>$SLF</td>
											<td align='center' valign='top'  style='border: 1px dotted #000'>$CHICKENPURDATE_ChickenSale</td>
											<td align='center' valign='top'  style='border: 1px dotted #000'>Chicken</td>
											<td align='center' valign='top'  style='border: 1px dotted #000'>$PARTYNAME_ChickenSale</td>
											<td align='center' valign='top'  style='border: 1px dotted #000'>$QUANTITY_ChickenSale</td>
											<td align='center' valign='top'  style='border: 1px dotted #000'>".number_format($AVGRATE_ChickenSale,2)."</td>
											<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($PRICE_ChickenSale,2)."</td>
									</tr> ";
								
							}
						
				$tableView .="
								<tr style='font-weight:bold;'>
				
									<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
		
									<td align='center' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
									
									<td align='center' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
		
									<td align='center' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
									
									<td align='center' valign='top' style='border: 1px dotted #000'>$Global_Quantity_Feed</td>
									
									<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
		
									<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($Global_Total_Price_Feed,2)."</td>
		
									
								</tr>
								<tr style='font-weight:bold;'>
				
									<td colspan='8' align='center' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
			
								</tr>
								
								<tr>

							<td colspan='8' align='center' valign='top' style='border: 1px dotted #000'><font size='+1'>Purchase History Medicine </font></td>

						</tr>";
						if ($PARTYID == 'All'){
								$con_fs = '';
							}else{
								$con_fs = "AND m.PARTYID ='".$PARTYID."' ";
							}	
						
				 $MedicineExpQuery 	= "SELECT m.MID,
											  m.PARTYID,
											  m.PRODUCTID,
											  m.QUANTITY,
											  m.PRICE,
											  m.TOTALPRICE,
											  m.MDDATE,
											  pr.PRODUCTNAME,
											  p.PARTYNAME
											FROM pal_medicine m, fna_product pr, fna_party p
											WHERE pr.PRODUCTID = m.PRODUCTID
											AND p.PARTYID = m.PARTYID
											{$con_fs}
											AND m.MDDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
											AND m.PROJECTID = '3'
											AND m.SUBPROJECTID = '8'
											
								";
				$MedicineExpQueryStatement			= mysql_query($MedicineExpQuery);
				$SLM = 1;
				$Global_Quantity_MEDICINE = 0;
				$Global_Total_Price_MEDICINE = 0;
				$RECEIVEAMOUNT_MEDICINE = 0;
				$GLOBAL_BALANCE_MEDICINE = 0;
				$PAYMENTAMOUNT_MEDICINE = 0;
				while($MedicineExpQueryStatementData		= mysql_fetch_array($MedicineExpQueryStatement)){	
					$MID			 					= $MedicineExpQueryStatementData['MID'];
					$PARTYID_MEDICINE 					= $MedicineExpQueryStatementData['PARTYID'];
					$PRODUCTID_MEDICINE 				= $MedicineExpQueryStatementData['PRODUCTID'];
					$QUANTITY_MEDICINE 					= $MedicineExpQueryStatementData['QUANTITY'];
					$UNIT_PRICE_MEDICINE 				= $MedicineExpQueryStatementData['PRICE'];
					$TOTALPRICE_MEDICINE 				= $MedicineExpQueryStatementData['TOTALPRICE'];
					$MDDATE_MEDICINE 					= $MedicineExpQueryStatementData['MDDATE'];
					$PRODUCTNAME_MEDICINE 				= $MedicineExpQueryStatementData['PRODUCTNAME'];
					$PARTYNAME_MEDICINE 				= $MedicineExpQueryStatementData['PARTYNAME'];
					
					$Global_Quantity_Medicine		= $Global_Quantity_Medicine + $QUANTITY_MEDICINE ; 
					$Global_Total_Price_Medicine	= $Global_Total_Price_Medicine + $TOTALPRICE_MEDICINE;
					
					
					$Final_Global_Total_Price			= $Global_Total_Price_Feed + $Global_Total_Price_Medicine ; 
					
					$FINAL_GLOBAL_BALANCE				= $Final_Global_Total_Price - $PAYMENTAMOUNT_FEED ;	
					
					
					if ($PARTYID == 'All'){
								$con_fp = '';
							}else{
								$con_fp = "AND fp.PARTYID ='".$PARTYID."' ";
							}	
					$partyReceiveAmountFeed = "
												SELECT
														SUM(RECEIVEAMOUNT) AS RECEIVEAMOUNT
												FROM
														fna_partybill fp
												WHERE fp.PROJECTID = '".$PROJECTID."'
												AND fp.SUBPROJECTID = '".$SUBPROJECTID."'
												{$con_fp}
												AND fp.ENTRYDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
										";
					$partyReceiveAmountFeedStatement				= mysql_query($partyReceiveAmountFeed);
					while($partyReceiveAmountFeedStatementData		= mysql_fetch_array($partyReceiveAmountFeedStatement)) {
							$RECEIVEAMOUNT_MEDICINE					= $partyReceiveAmountFeedStatementData["RECEIVEAMOUNT"];	
						}
					
						
					$partyPaymentAmountFeed = "
												SELECT
														SUM(PAYMENTAMOUNT) AS PAYMENTAMOUNT
												FROM
														fna_partybill fp
												WHERE fp.PROJECTID = '".$PROJECTID."'
												AND fp.SUBPROJECTID = '".$SUBPROJECTID."'
												{$con_fp}
												AND fp.ENTRYDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
										";
					$partyPaymentAmountFeedStatement				= mysql_query($partyPaymentAmountFeed);
					while($partyPaymentAmountFeedStatementData		= mysql_fetch_array($partyPaymentAmountFeedStatement)) {
							$PAYMENTAMOUNT_MEDICINE					= $partyPaymentAmountFeedStatementData["PAYMENTAMOUNT"];	
						}
								
					$GLOBAL_BALANCE_MEDICINE	= $GLOBAL_BALANCE_MEDICINE - $PAYMENTAMOUNT_MEDICINE ;	
					
						
				
					
							
					
				$tableView .="
							<tr>
								<td align='center' valign='top' style='border: 1px dotted #000'>$SLM</td>
								
								<td align='center' valign='top'  style='border: 1px dotted #000'>$MDDATE_MEDICINE</td>
								
								<td align='center' valign='top'  style='border: 1px dotted #000'>$PRODUCTNAME_MEDICINE</td>
								
								<td align='center' valign='top'  style='border: 1px dotted #000'>$PARTYNAME_MEDICINE</td>
																			
								<td align='center' valign='top'  style='border: 1px dotted #000'>$QUANTITY_MEDICINE</td>
								
								<td align='center' valign='top'  style='border: 1px dotted #000'>".number_format($UNIT_PRICE_MEDICINE,2)."</td>
								
								<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($TOTALPRICE_MEDICINE,2)."</td>
																			
							 </tr>
							 
						  ";
							$SLM ++;
						}
						if ($PARTYID == 'All'){
								$con_pchksale = '';
							}else{
								$con_pchksale = "AND pchksale.PARTYID ='".$PARTYID."' ";
							}	
							$pchksale_Query 	= "SELECT 	pchksale.QUANTITY,
													  			pchksale.PRICE,
																pchksale.AVGRATE,
																pchksale.CHICKENPURDATE,
													  			p.PARTYNAME
													FROM pal_chicken_purchase pchksale, fna_party p 
													WHERE pchksale.PROJECTID = '".$PROJECTID."'
													AND pchksale.SUBPROJECTID = '".$SUBPROJECTID."'
													AND p.PARTYID = pchksale.PARTYID
													{$con_pchksale}
													AND pchksale.STATUS = 'Buy'
													AND pchksale.CHICKENPURDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
													
												"; 
							$pchksale_QueryStatement			= mysql_query($pchksale_Query);
							while($pchksale_QueryStatementData	= mysql_fetch_array($pchksale_QueryStatement)){	
								$QUANTITY_ChickenSale			= $pchksale_QueryStatementData['QUANTITY'];
								$PRICE_ChickenSale			    = $pchksale_QueryStatementData['PRICE'];
								$AVGRATE_ChickenSale			= $pchksale_QueryStatementData['AVGRATE'];
								$CHICKENPURDATE_ChickenSale		= $pchksale_QueryStatementData['CHICKENPURDATE'];
								$PARTYNAME_ChickenSale			= $pchksale_QueryStatementData['PARTYNAME'];
								
								$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000'>$SLF</td>
											<td align='center' valign='top'  style='border: 1px dotted #000'>$CHICKENPURDATE_ChickenSale</td>
											<td align='center' valign='top'  style='border: 1px dotted #000'>Chicken</td>
											<td align='center' valign='top'  style='border: 1px dotted #000'>$PARTYNAME_ChickenSale</td>
											<td align='center' valign='top'  style='border: 1px dotted #000'>$QUANTITY_ChickenSale</td>
											<td align='center' valign='top'  style='border: 1px dotted #000'>".number_format($AVGRATE_ChickenSale,2)."</td>
											<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($PRICE_ChickenSale,2)."</td>
									</tr> ";
								
							}
						
				$tableView .="
								<tr style='font-weight:bold;'>
				
									<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
		
									<td align='center' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
									
									<td align='center' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
		
									<td align='center' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
									
									<td align='center' valign='top' style='border: 1px dotted #000'>$Global_Quantity_Medicine</td>
									
									<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
		
									<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($Global_Total_Price_Medicine,2)."</td>
		
									
								</tr>
								<tr style='font-weight:bold;'>
				
									<td colspan='8' align='center' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
			
								</tr>
								";
							
		$tableView .="
						<tr>

							<td colspan='8' align='left' valign='top' style='font-weight:bold;'>
								<table width='50%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:100%;'>
								  <tr>
									<td align='right' width='50%' style='border: 1px dotted #000'>Total Sales </td>
									<td width='2%' style='border: 1px dotted #000'>:</td>
									<td width='48%' style='border: 1px dotted #000'>".number_format($Global_SELLPRICE_Total,2)."</td>
								  </tr>
								  <tr>
									<td align='right' width='50%' style='border: 1px dotted #000'>Receive </td>
									<td width='2%' style='border: 1px dotted #000'>:</td>
									<td width='48%' style='border: 1px dotted #000'>".number_format($RECEIVEAMOUNT_FEED,2)."</td>
								  </tr>
									<td align='right' width='50%' style='border: 1px dotted #000'>Sales Balance </td>
									<td width='2%' style='border: 1px dotted #000'>:</td>
									<td width='48%' style='border: 1px dotted #000'>".number_format($partyBalAmount,2)."</td>
								  </tr>
								  <tr>
									<td colspan='3' align='right' width='100%' style='border: 1px dotted #000'>&nbsp;</td>
								  </tr>
								  <tr>
									<td align='right' width='50%' style='border: 1px dotted #000'>Total Purchase</td>
									<td width='2%' style='border: 1px dotted #000'>:</td>
									<td width='48%' style='border: 1px dotted #000'>".number_format($Final_Global_Total_Price,2)."</td>
								  </tr>
								   <tr>
									<td align='right' width='50%' style='border: 1px dotted #000'>Payment</td>
									<td width='2%' style='border: 1px dotted #000'>:</td>
									<td width='48%' style='border: 1px dotted #000'>".number_format($PAYMENTAMOUNT_FEED,2)."</td>
								  </tr>
								  <tr>
									<td align='right' width='50%' style='border: 1px dotted #000'>Purchase Balance </td>
									<td width='2%' style='border: 1px dotted #000'>:</td>
									<td width='48%' style='border: 1px dotted #000'>".number_format($FINAL_GLOBAL_BALANCE,2)."</td>
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