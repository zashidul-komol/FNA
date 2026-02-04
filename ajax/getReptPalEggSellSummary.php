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
							<center><b><font size=4>Summary Egg Sell Report</FONT></b></center>
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
						
						<td align='center' valign='middle'  style='border: 1px dotted #000'>Egg Production</td>
						
						<td align='center' valign='middle'  style='border: 1px dotted #000'>Haching</td>

						<td align='center' valign='middle' style='border: 1px dotted #000'>Haching Price</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Commercial</td>
						
						<td align='center' valign='middle'  style='border: 1px dotted #000'>Comm Price </td>
                        
                        <td align='center' valign='middle'  style='border: 1px dotted #000'>Vanga</td>
						
						<td align='center' valign='middle'  style='border: 1px dotted #000'>Vanga Price</td>

						<td align='center' valign='middle' style='border: 1px dotted #000'>Cancel</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Cancel Price</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Total Quantity</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Total Taka</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Egg Balance</td>
						
					</tr>";

// Query here.
						$BasicQueryA		= "SELECT BATCHNO
													FROM pal_egg_sell
													WHERE ESDATE BETWEEN '".$OPENINGDATE_FROM."' AND '".$OPENINGDATE_TO."'
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
						$Global_Quantity = 0;
						$Grand_Total_egg = 0;
						$Grand_Total_Taka	= 0;
						$Global_Hatching_Qnty = 0;
						$Global_Hatching_Price	= 0 ; 
						$Global_Comm_Qnty		= 0 ; 
						$Global_Comm_Price		= 0 ; 
						$Global_Vanga_Qnty		= 0 ; 
						$Global_Vanga_Price		= 0 ; 
						$Global_Cancel_Qnty		= 0 ; 
						$Global_Cancel_Price	= 0 ;
						$Global_Grand_Total_egg = 0;
						$Global_Grand_Total_Taka = 0;
						$Global_Egg_Balance		= 0;
						$Global_Egg_Production	= 0;
							
						foreach($BATCHNO_ARRAY_UNIQUE as $individualBatch){
						$BasicQuery_Hatch 		= "SELECT es.SCID,
													  SUM(es.QUANTITY) QUANTITY,
													  SUM(es.TOTPRICE) TOTPRICE,
													  sc.SCNAME
												FROM pal_egg_sell es, pal_sellcategory sc
												WHERE es.SCID = sc.SCID
												AND es.SCID =  1
												AND es.ESDATE BETWEEN '".$OPENINGDATE_FROM."' AND '".$OPENINGDATE_TO."'
												AND es.BATCHNO = '".$individualBatch."'
												ORDER BY es.ESDATE ASC
										"; 
						$BasicQuery_HatchStatement				= mysql_query($BasicQuery_Hatch);
						while($BasicQuery_HatchStatementData	= mysql_fetch_array($BasicQuery_HatchStatement)){	
							$SCID			 					= $BasicQuery_HatchStatementData['SCID'];
							$Haching_QUANTITY 					= $BasicQuery_HatchStatementData['QUANTITY'];
							$Haching_TOTPRICE 					= $BasicQuery_HatchStatementData['TOTPRICE'];
							$SCNAME			 					= $BasicQuery_HatchStatementData['SCNAME'];
							
						}
						
						$BasicQuery_Comm 		= "SELECT es.SCID,
													  SUM(es.QUANTITY) QUANTITY,
													  SUM(es.TOTPRICE) TOTPRICE,
													  sc.SCNAME
												FROM pal_egg_sell es, pal_sellcategory sc
												WHERE es.SCID = sc.SCID
												AND es.SCID =  2
												AND es.ESDATE BETWEEN '".$OPENINGDATE_FROM."' AND '".$OPENINGDATE_TO."'
												AND es.BATCHNO = '".$individualBatch."'
												ORDER BY es.ESDATE ASC
										"; 
						$BasicQuery_CommStatement			= mysql_query($BasicQuery_Comm);
						while($BasicQuery_CommStatementData	= mysql_fetch_array($BasicQuery_CommStatement)){	
							$SCID			 				= $BasicQuery_CommStatementData['SCID'];
							$Comm_QUANTITY	 				= $BasicQuery_CommStatementData['QUANTITY'];
							$Comm_TOTPRICE	 				= $BasicQuery_CommStatementData['TOTPRICE'];
							$SCNAME			 				= $BasicQuery_CommStatementData['SCNAME'];
							
						}
						
						$BasicQuery_Vanga 		= "SELECT es.SCID,
													  SUM(es.QUANTITY) QUANTITY,
													  SUM(es.TOTPRICE) TOTPRICE,
													  sc.SCNAME
												FROM pal_egg_sell es, pal_sellcategory sc
												WHERE es.SCID = sc.SCID
												AND es.SCID =  3
												AND es.ESDATE BETWEEN '".$OPENINGDATE_FROM."' AND '".$OPENINGDATE_TO."'
												AND es.BATCHNO = '".$individualBatch."'
												ORDER BY es.ESDATE ASC
										"; 
						$BasicQuery_VangaStatement			= mysql_query($BasicQuery_Vanga);
						while($BasicQuery_VangaStatementData	= mysql_fetch_array($BasicQuery_VangaStatement)){	
							$SCID			 					= $BasicQuery_VangaStatementData['SCID'];
							$Vanga_QUANTITY	 					= $BasicQuery_VangaStatementData['QUANTITY'];
							$Vanga_TOTPRICE	 					= $BasicQuery_VangaStatementData['TOTPRICE'];
							$SCNAME			 					= $BasicQuery_VangaStatementData['SCNAME'];
							
						}
						
												
						$BasicQuery_Cancel 		= "SELECT es.SCID,
													  SUM(es.QUANTITY) QUANTITY,
													  SUM(es.TOTPRICE) TOTPRICE,
													  sc.SCNAME
												FROM pal_egg_sell es, pal_sellcategory sc
												WHERE es.SCID = sc.SCID
												AND es.SCID =  4
												AND es.ESDATE BETWEEN '".$OPENINGDATE_FROM."' AND '".$OPENINGDATE_TO."'
												AND es.BATCHNO = '".$individualBatch."'
												ORDER BY es.ESDATE ASC
										"; 
						$BasicQuery_CancelStatement			= mysql_query($BasicQuery_Cancel);
						while($BasicQuery_CancelStatementData	= mysql_fetch_array($BasicQuery_CancelStatement)){	
							$SCID			 					= $BasicQuery_CancelStatementData['SCID'];
							$Cancel_QUANTITY 					= $BasicQuery_CancelStatementData['QUANTITY'];
							$Cancel_TOTPRICE 					= $BasicQuery_CancelStatementData['TOTPRICE'];
							$SCNAME			 					= $BasicQuery_CancelStatementData['SCNAME'];
							
						}
						
						
							
							//$Global_Quantity			= $Global_Quantity + $QUANTITY ; 
							
							/*$Haching_QUANTITY = 0;
							$Haching_TOTPRICE = 0;
							$Comm_QUANTITY = 0;
							$Comm_TOTPRICE = 0;
							$Vanga_QUANTITY = 0;
							$Vanga_TOTPRICE = 0;
							$Cancel_QUANTITY = 0;
							$Cancel_TOTPRICE = 0;
							
							
							if($SCID == '1'){
								$Haching_QUANTITY = $QUANTITY;
								$Haching_TOTPRICE = $TOTPRICE;
							}elseif($SCID == '2'){
								$Comm_QUANTITY = $QUANTITY;
								$Comm_TOTPRICE = $TOTPRICE;
							}elseif($SCID == '3'){
								$Vanga_QUANTITY = $QUANTITY;
								$Vanga_TOTPRICE = $TOTPRICE;
							}else{
								$Cancel_QUANTITY = $QUANTITY;
								$Cancel_TOTPRICE = $TOTPRICE;
							}
							*/
							$Global_Hatching_Qnty	= $Global_Hatching_Qnty + $Haching_QUANTITY ; 
							$Global_Hatching_Price	= $Global_Hatching_Price + $Haching_TOTPRICE ; 
							$Global_Comm_Qnty		= $Global_Comm_Qnty + $Comm_QUANTITY ; 
							$Global_Comm_Price		= $Global_Comm_Price + $Comm_TOTPRICE ; 
							$Global_Vanga_Qnty		= $Global_Vanga_Qnty + $Vanga_QUANTITY ; 
							$Global_Vanga_Price		= $Global_Vanga_Price + $Vanga_TOTPRICE ; 
							$Global_Cancel_Qnty		= $Global_Cancel_Qnty + $Cancel_QUANTITY ; 
							$Global_Cancel_Price	= $Global_Cancel_Price + $Cancel_TOTPRICE ; 
							
							$Grand_Total_egg  = $Haching_QUANTITY + $Comm_QUANTITY + $Vanga_QUANTITY + $Cancel_QUANTITY ;
							$Grand_Total_Taka  = $Haching_TOTPRICE + $Comm_TOTPRICE + $Vanga_TOTPRICE + $Cancel_TOTPRICE ;
							
							$Global_Grand_Total_egg = $Global_Grand_Total_egg + $Grand_Total_egg ; 
							$Global_Grand_Total_Taka = $Global_Grand_Total_Taka + $Grand_Total_Taka ; 
							
							$EggProd_Query 		= "SELECT SUM(EGGQNTY) EGGQNTY
														FROM pal_egg_production
													WHERE EPDATE BETWEEN '".$OPENINGDATE_FROM."' AND '".$OPENINGDATE_TO."'
													AND BATCHNO = '".$individualBatch."'
													AND STATUS != 'Out'
													ORDER BY EPDATE ASC
											"; 
							$EggProd_QueryStatement				= mysql_query($EggProd_Query);
							while($EggProd_QueryStatementData	= mysql_fetch_array($EggProd_QueryStatement)){	
								$EGGQNTY		 				= $EggProd_QueryStatementData['EGGQNTY'];
								
							}
							
						$Global_Egg_Production 	= $Global_Egg_Production + $EGGQNTY ; 
							
						$EggBalance		= $EGGQNTY - $Grand_Total_egg ; 
						
						$Global_Egg_Balance		= $Global_Egg_Balance + $EggBalance ; 
							
						$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000'>$SL</td>

											<td align='center' valign='top'  style='border: 1px dotted #000'>$individualBatch</td>
											
											<td align='center' valign='top'  style='border: 1px dotted #000'>$EGGQNTY</td>
											
											<td align='right' valign='top'  style='border: 1px dotted #000'>$Haching_QUANTITY</td>
											
											<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($Haching_TOTPRICE,2)."</td>
											
											<td align='right' valign='top'  style='border: 1px dotted #000'>$Comm_QUANTITY</td>
											
											<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($Comm_TOTPRICE,2)."</td>
											
											<td align='right' valign='top'  style='border: 1px dotted #000'>$Vanga_QUANTITY</td>
											
											<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($Vanga_TOTPRICE,2)."</td>
											
											<td align='right' valign='top'  style='border: 1px dotted #000'>$Cancel_QUANTITY</td>
											
											<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($Cancel_TOTPRICE,2)."</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Grand_Total_egg,2)."</td>
											
											<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($Grand_Total_Taka,2)."</td>
											
											<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($EggBalance,2)."</td>
											
										</tr>

									 ";
							// Dynamic Row End		  

					$SL++;	
				
				}

					$tableView .="

						<tr style='font-weight:bold;' bgcolor='#CCCCCC'>

							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='center' valign='top'  style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='center' valign='top'  style='border: 1px dotted #000'>$Global_Egg_Production</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>$Global_Hatching_Qnty</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_Hatching_Price,2)."</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>$Global_Comm_Qnty</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_Comm_Price,2)."</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>$Global_Vanga_Qnty</td>

							<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($Global_Vanga_Price,2)."</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>$Global_Cancel_Qnty</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_Cancel_Price,2)."</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_Grand_Total_egg,2)."</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_Grand_Total_Taka,2)."</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_Egg_Balance,2)."</td>
							
							
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