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

	
		
	$ENTRYDATE_FROM 	= showDateMySQlFormat($_REQUEST['ENTRYDATE']);
	$ENTRYDATE_TO 		= showDateMySQlFormat($_REQUEST['ENTRYDATE2']);
	$PROJECTID 			= $_REQUEST['PROJECTID'];
	$SUBPROJECTID		= $_REQUEST['SUBPROJECTID'];
	$BATCHNO			= $_REQUEST['BATCHNO'];

	$userId 			= $_REQUEST['userId'];
	
	if ($BATCHNO == 'All'){
		$con = '';
	}else{
		$con = "BATCHNO='".$BATCHNO."' ";
	}
		/*$Last_Date = date_create($ENTRYDATE_TO);
		date_sub($Last_Date, date_interval_create_from_date_string('1 days'));
		$LastDay = date_format($Last_Date, 'Y-m-d');
*/
		//Ministry/Division and Project/Programme Name View Report Start				
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
			
			//Ministry/Division and Project/Programme Name View Report End
			
	$tableView = "";	
	$tableView .="<table width='70%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:85%; border: 1px dotted #000'>

					  <tr>
                            <td style='text-align:right;' colspan='13'>
                            <a href='javascript:Clickheretoprint()'><img border='0' src='images/print_icon.jpg' width='40' height='26' /></a>                        
                            </td>
                     </tr>
					  <tr>
						<td colspan='18' align='center' valign='middle' style='border: 1px dotted #000'>
							<center><b><font size=5>F N A Group Of Company</font></b></center>
							<center>&nbsp;</center>
							<center><b><font size=4>Poultry Batch Wise Details Report </FONT></b></center>
							<center>&nbsp;</center>
							<center><b><font size=2>Batch No : $BATCHNO  </font></b></center>
						</td>
					  </tr>
					  <tr>

						<td colspan='18' align='left' valign='top'>
							<table width='100%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:100%;'>
								  <tr>
								
									<td width='14%' align='left' valign='top'>Project  Name<b></td>
									<td width='1%' align='center' valign='top'>:</td>
									<td width='34%' align='left' valign='top'> $PROJECTNAME</td>
									<td width='18%' align='right' valign='top'>&nbsp;</td>
									<td width='1%' align='center' valign='top'>&nbsp;</td>
									<td width='20%' align='left' valign='top'>&nbsp;</td>
									<td align='left' valign='top'>&nbsp;</td>
								
								  </tr>
								
								  <tr>
								
									<td align='left' valign='top'>Sub Project Name</td>
									<td align='center' valign='top'>:</td>
								
									<td align='left' valign='top'> $SUBPROJECTNAME </td>
									<td align='right' valign='top'>&nbsp;</td>
									<td align='center' valign='top'>&nbsp;</td>
									<td align='left' valign='top'>&nbsp;</td>
									<td align='left' valign='top'> &nbsp;</td>
								
								  </tr>
								 <tr>
								
									<td align='left' valign='top'>Batch No</td>
									<td align='center' valign='top'>:</td>
								
									<td align='left' valign='top'>$BATCHNO</td>
									<td align='right' valign='top'>&nbsp;</td>
									<td align='center' valign='top'>&nbsp;</td>
									<td align='left' valign='top'>&nbsp;</td>
									<td align='left' valign='top'>&nbsp;</td>
								
								  </tr>
								
								</table>
							

						</td>

					  </tr>
					  <tr style='font-weight:bold;'>

						<td align='center' valign='middle' style='font-weight:bold;border: 1px dotted #000'>SL.</td>

						<td align='center' valign='middle' style='border: 1px dotted #000'>Date</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'> Batch Live Stock</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Price</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Balance</td>
						
						</tr>";

// Query here.
						
						//$TOTAL_RECEIVE_QNTY_KG ='';
						$i = 0;
						
						//////////////////==============--------------------------------------
						$BatchOpenQuery 	= "SELECT bo.BATCHNO,
														bo.BWISELIVESTOCK,
														bo.BDATE,
														bo.PRICE
												FROM pal_batchopen bo
												WHERE bo.PROJECTID = '".$PROJECTID."'
												AND bo.SUBPROJECTID = '".$SUBPROJECTID."'
												AND bo.BATCHNO = '".$BATCHNO."'
												
												
											";
						$BatchOpenQueryStatement			= mysql_query($BatchOpenQuery);
						$sl = 1;
						while($BatchOpenQueryStatementData	= mysql_fetch_array($BatchOpenQueryStatement)){	
							$BWISELIVESTOCK	 				= $BatchOpenQueryStatementData['BWISELIVESTOCK'];
							$BDATE			 				= $BatchOpenQueryStatementData['BDATE'];
							$PRICE			 				= $BatchOpenQueryStatementData['PRICE'];
							$BATCHNO		 				= $BatchOpenQueryStatementData['BATCHNO'];
							
						
						$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000'>$sl</td>

											<td align='center' valign='top' style='border: 1px dotted #000'>$BDATE</td>
											
											<td align='center' valign='top' style='border: 1px dotted #000'>$BWISELIVESTOCK</td>
					
											<td align='center' valign='top' style='border: 1px dotted #000'>".number_format($PRICE,2)."</td>
					
											<td align='center' valign='top' style='border: 1px dotted #000'>$BWISELIVESTOCK</td>
											
											
										</tr>

									 ";

								// Dynamic Row End		  

						$sl++;		
						
						}
						//------------------------------------------------Daily Operation Start---------------------------------------------------------------
						$tableView .="

						<tr style='font-weight:bold;'>

							<td colspan='7' align='center' valign='top' style='border: 1px dotted #000'><font size='+1'>Daily Operation</font></td>
							
														
						</tr>";
						
						 //$tableView .= "<fieldset><legend><center>Daily Operation.</center></legend>";
						
						
						 $tableView .="
										<tr style='font-weight:bold;'>
	
											<td align='center' valign='middle' style='border: 1px dotted #000'>SL</td>
											
											<td align='center' valign='middle' style='border: 1px dotted #000'>DATE</td>
											
											<td align='center' valign='middle' style='border: 1px dotted #000'>Dead Quantity</td>
											
											<td align='center' valign='middle' style='border: 1px dotted #000'>Cancel Quantity</td>
											
											<td align='center' valign='middle' style='border: 1px dotted #000'>Sell Quantity</td>
											
											<td align='center' valign='middle' style='border: 1px dotted #000'>Sell Price</td>
											
											<td align='center' valign='middle' style='border: 1px dotted #000'>Stock in Hand</td>
											
																							
										</tr>";
						
						$BatchDailyOperQuery 	= "SELECT do.BATCHNO,
														  do.DODATE,
														  do.STOCKINHAND,
														  do.DEADSTOCK,
														  do.CANCELSTOCK,
														  do.SELLSTOCK,
														  do.SELLPRICE
												FROM pal_dailyoperation do
												WHERE do.PROJECTID = '".$PROJECTID."'
												AND do.SUBPROJECTID = '".$SUBPROJECTID."'
												AND do.BATCHNO = '".$BATCHNO."'
												AND do.DODATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
												
											";
						$BatchDailyOperQueryStatement			= mysql_query($BatchDailyOperQuery);
						$sl_DO = 1;
						while($BatchDailyOperQueryStatementData		= mysql_fetch_array($BatchDailyOperQueryStatement)){	
							$STOCKINHAND_DO	 				= $BatchDailyOperQueryStatementData['STOCKINHAND'];
							$DODATE			 				= $BatchDailyOperQueryStatementData['DODATE'];
							$BATCHNO_DO		 				= $BatchDailyOperQueryStatementData['BATCHNO'];
							$DEADSTOCK_DO	 				= $BatchDailyOperQueryStatementData['DEADSTOCK'];
							$CANCELSTOCK_DO	 				= $BatchDailyOperQueryStatementData['CANCELSTOCK'];
							$SELLSTOCK_DO	 				= $BatchDailyOperQueryStatementData['SELLSTOCK'];
							$SELLPRICE_DO	 				= $BatchDailyOperQueryStatementData['SELLPRICE'];
							
						$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000'>$sl_DO</td>

											<td align='center' valign='top' style='border: 1px dotted #000'>$DODATE</td>
											
											<td align='center' valign='top' style='border: 1px dotted #000'>$DEADSTOCK_DO</td>
					
											<td align='center' valign='top' style='border: 1px dotted #000'>$CANCELSTOCK_DO</td>
					
											<td align='center' valign='top' style='border: 1px dotted #000'>$SELLSTOCK_DO</td>
											
											<td align='center' valign='top' style='border: 1px dotted #000'>$SELLPRICE_DO</td>
											
											<td align='center' valign='top' style='border: 1px dotted #000'>$STOCKINHAND_DO</td>
											
											
										</tr>

									 ";

								// Dynamic Row End		  

						$sl_DO++;		
						
						}
						//------------------------------------------------Daily Operation End---------------------------------------------------------------
						
						//------------------------------------------------Morog Start---------------------------------------------------------------
						$tableView .="

						<tr style='font-weight:bold;'>

							<td colspan='7' align='center' valign='top' style='border: 1px dotted #000'><font size='+1'>Morog Details Information</font></td>
														
						</tr>";
						
						 //$tableView .= "<fieldset><legend><center>Daily Operation.</center></legend>";
						
						
						 $tableView .="
										<tr style='font-weight:bold;'>
	
											<td align='center' valign='middle' style='border: 1px dotted #000'>SL</td>
											
											<td align='center' valign='middle' style='border: 1px dotted #000'>DATE</td>
											
											<td align='center' valign='middle' style='border: 1px dotted #000'>Dead Quantity</td>
											
											<td align='center' valign='middle' style='border: 1px dotted #000'>Cancel Quantity</td>
											
											<td align='center' valign='middle' style='border: 1px dotted #000'>Sell Quantity</td>
											
											<td align='center' valign='middle' style='border: 1px dotted #000'>Sell Price</td>
											
											<td align='center' valign='middle' style='border: 1px dotted #000'>Stock in Hand</td>
											
																							
										</tr>";
						
						$BatchMorogQuery 	= "SELECT mor.BATCHNO,
														  mor.ENTRYDATE,
														  mor.STOCKINHAND,
														  mor.DEADSTOCK,
														  mor.CANCELSTOCK,
														  mor.SELLSTOCK,
														  mor.SELLPRICE
												FROM pal_morog mor
												WHERE mor.PROJECTID = '".$PROJECTID."'
												AND mor.SUBPROJECTID = '".$SUBPROJECTID."'
												AND mor.BATCHNO = '".$BATCHNO."'
												AND mor.ENTRYDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
												
											";
						$BatchMorogQueryStatement			= mysql_query($BatchMorogQuery);
						$sl_mor = 1;
						while($BatchMorogQueryStatementData		= mysql_fetch_array($BatchMorogQueryStatement)){	
							$STOCKINHAND_MOR	 				= $BatchMorogQueryStatementData['STOCKINHAND'];
							$ENTRYDATE_MOR		 				= $BatchMorogQueryStatementData['ENTRYDATE'];
							$BATCHNO_MOR		 				= $BatchMorogQueryStatementData['BATCHNO'];
							$DEADSTOCK_MOR	 					= $BatchMorogQueryStatementData['DEADSTOCK'];
							$CANCELSTOCK_MOR	 				= $BatchMorogQueryStatementData['CANCELSTOCK'];
							$SELLSTOCK_MOR	 					= $BatchMorogQueryStatementData['SELLSTOCK'];
							$SELLPRICE_MOR		 				= $BatchMorogQueryStatementData['SELLPRICE'];
							
						$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000'>$sl_mor</td>

											<td align='center' valign='top' style='border: 1px dotted #000'>$ENTRYDATE_MOR</td>
											
											<td align='center' valign='top' style='border: 1px dotted #000'>$DEADSTOCK_MOR</td>
					
											<td align='center' valign='top' style='border: 1px dotted #000'>$CANCELSTOCK_MOR</td>
					
											<td align='center' valign='top' style='border: 1px dotted #000'>$SELLSTOCK_MOR</td>
											
											<td align='center' valign='top' style='border: 1px dotted #000'>$SELLPRICE_MOR</td>
											
											<td align='center' valign='top' style='border: 1px dotted #000'>$STOCKINHAND_MOR</td>
											
											
										</tr>

									 ";

								// Dynamic Row End		  

						$sl_mor++;		
						
						}
						//------------------------------------------------Morog End---------------------------------------------------------------
						
						//------------------------------------------------Murgi Start---------------------------------------------------------------
						$tableView .="

						<tr style='font-weight:bold;'>

							<td colspan='7' align='center' valign='top' style='border: 1px dotted #000'><font size='+1'>Murgi Details Information</td>
							
														
						</tr>";
						
						 //$tableView .= "<fieldset><legend><center>Daily Operation.</center></legend>";
						
						
						 $tableView .="
										<tr style='font-weight:bold;'>
	
											<td align='center' valign='middle' style='border: 1px dotted #000'>SL</td>
											
											<td align='center' valign='middle' style='border: 1px dotted #000'>DATE</td>
											
											<td align='center' valign='middle' style='border: 1px dotted #000'>Dead Quantity</td>
											
											<td align='center' valign='middle' style='border: 1px dotted #000'>Cancel Quantity</td>
											
											<td align='center' valign='middle' style='border: 1px dotted #000'>Sell Quantity</td>
											
											<td align='center' valign='middle' style='border: 1px dotted #000'>Sell Price</td>
											
											<td align='center' valign='middle' style='border: 1px dotted #000'>Stock in Hand</td>
											
																							
										</tr>";
						
						$BatchMurgiQuery 	= "SELECT mur.BATCHNO,
														  mur.ENTRYDATE,
														  mur.STOCKINHAND,
														  mur.DEADSTOCK,
														  mur.CANCELSTOCK,
														  mur.SELLSTOCK,
														  mur.SELLPRICE
												FROM pal_murgi mur
												WHERE mur.PROJECTID = '".$PROJECTID."'
												AND mur.SUBPROJECTID = '".$SUBPROJECTID."'
												AND mur.BATCHNO = '".$BATCHNO."'
												AND mur.ENTRYDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
												
											";
						$BatchMurgiQueryStatement			= mysql_query($BatchMurgiQuery);
						$sl_mur = 1;
						while($BatchMurgiQueryStatementData		= mysql_fetch_array($BatchMurgiQueryStatement)){	
							$STOCKINHAND_MUR	 				= $BatchMurgiQueryStatementData['STOCKINHAND'];
							$ENTRYDATE_MUR		 				= $BatchMurgiQueryStatementData['ENTRYDATE'];
							$BATCHNO_MUR		 				= $BatchMurgiQueryStatementData['BATCHNO'];
							$DEADSTOCK_MUR	 					= $BatchMurgiQueryStatementData['DEADSTOCK'];
							$CANCELSTOCK_MUR	 				= $BatchMurgiQueryStatementData['CANCELSTOCK'];
							$SELLSTOCK_MUR	 					= $BatchMurgiQueryStatementData['SELLSTOCK'];
							$SELLPRICE_MUR		 				= $BatchMurgiQueryStatementData['SELLPRICE'];
							
						$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000'>$sl_mur</td>

											<td align='center' valign='top' style='border: 1px dotted #000'>$ENTRYDATE_MUR</td>
											
											<td align='center' valign='top' style='border: 1px dotted #000'>$DEADSTOCK_MUR</td>
					
											<td align='center' valign='top' style='border: 1px dotted #000'>$CANCELSTOCK_MUR</td>
					
											<td align='center' valign='top' style='border: 1px dotted #000'>$SELLSTOCK_MUR</td>
											
											<td align='center' valign='top' style='border: 1px dotted #000'>$SELLPRICE_MUR</td>
											
											<td align='center' valign='top' style='border: 1px dotted #000'>$STOCKINHAND_MUR</td>
											
											
										</tr>

									 ";

								// Dynamic Row End		  

						$sl_mur++;		
						
						}
						//------------------------------------------------Murgi End---------------------------------------------------------------
						
						//------------------------------------------------Murgi / Morog Sell Start---------------------------------------------------------------
						$tableView .="

						<tr style='font-weight:bold;'>

							<td colspan='7' align='center' valign='top' style='border: 1px dotted #000'><font size='+1'>Murgi / Morog Sell Information</td>
							
														
						</tr>";
						
						 //$tableView .= "<fieldset><legend><center>Daily Operation.</center></legend>";
						
						
						 $tableView .="
										<tr style='font-weight:bold;'>
	
											<td align='center' valign='middle' style='border: 1px dotted #000'>SL</td>
											
											<td align='center' valign='middle' style='border: 1px dotted #000'>DATE</td>
											
											<td align='center' valign='middle' style='border: 1px dotted #000'>Murgi Quantity</td>
											
											<td align='center' valign='middle' style='border: 1px dotted #000'>Morog Quantity</td>
											
											<td align='center' valign='middle' style='border: 1px dotted #000'>Total Quantity</td>
											
											<td align='center' valign='middle' style='border: 1px dotted #000'>Unit Price</td>
											
											<td align='center' valign='middle' style='border: 1px dotted #000'>Total Price</td>
											
																							
										</tr>";
						
						$BatchMUrMorSellQuery 	= "SELECT mms.BATCHNO,
														  mms.MMSELLDATE,
														  mms.MURGIQNTY,
														  mms.MOROGQNTY,
														  mms.TOTQUANTITY,
														  mms.RATE,
														  mms.TOTPRICE
												FROM pal_morog_murgi_sell mms
												WHERE mms.PROJECTID = '".$PROJECTID."'
												AND mms.SUBPROJECTID = '".$SUBPROJECTID."'
												AND mms.BATCHNO = '".$BATCHNO."'
												AND mms.MMSELLDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
												
											";
						$BatchMUrMorSellQueryStatement					= mysql_query($BatchMUrMorSellQuery);
						$sl_mms = 1;
						while($BatchMUrMorSellQueryStatementData		= mysql_fetch_array($BatchMUrMorSellQueryStatement)){	
							$MMSELLDATE_MMS				 				= $BatchMUrMorSellQueryStatementData['MMSELLDATE'];
							$MURGIQNTY_MMS		 						= $BatchMUrMorSellQueryStatementData['MURGIQNTY'];
							$MOROGQNTY_MMS	 							= $BatchMUrMorSellQueryStatementData['MOROGQNTY'];
							$TOTQUANTITY_MMS	 						= $BatchMUrMorSellQueryStatementData['TOTQUANTITY'];
							$RATE_MMS	 								= $BatchMUrMorSellQueryStatementData['RATE'];
							$TOTPRICE_MMS		 						= $BatchMUrMorSellQueryStatementData['TOTPRICE'];
							
						$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000'>$sl_mms</td>

											<td align='center' valign='top' style='border: 1px dotted #000'>$MMSELLDATE_MMS</td>
											
											<td align='center' valign='top' style='border: 1px dotted #000'>$MURGIQNTY_MMS</td>
					
											<td align='center' valign='top' style='border: 1px dotted #000'>$MOROGQNTY_MMS</td>
					
											<td align='center' valign='top' style='border: 1px dotted #000'>$TOTQUANTITY_MMS</td>
											
											<td align='center' valign='top' style='border: 1px dotted #000'>$RATE_MMS</td>
											
											<td align='center' valign='top' style='border: 1px dotted #000'>$TOTPRICE_MMS</td>
											
											
										</tr>

									 ";

								// Dynamic Row End		  

						$sl_mms++;		
						
						}
						//------------------------------------------------Murgi / Morog Sell End---------------------------------------------------------------
						$tableView .="

						<tr style='font-weight:bold;'>

							<td align='right' valign='top' style='border: 1px dotted #000'></td>

							<td align='right' valign='top' style='border: 1px dotted #000'></td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'></td>

							<td align='right' valign='top' style='border: 1px dotted #000'></td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'></td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'></td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'></td>
							
														
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

							<td colspan='5' align='left' valign='top' >&nbsp;</td>

						</tr>
						<tr>

							<td colspan='5' align='left' valign='top' >&nbsp;</td>

						</tr>					

					</table>";
	echo $tableView;
									
?>