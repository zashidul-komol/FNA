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
	$HATCHNO 			= $_REQUEST['HATCHNO'];
	$userId 			= $_REQUEST['userId'];
	
	if ($HATCHNO == 'All'){
		$con = '';
	}else{
		$con = "AND HATCHNO ='".$HATCHNO."' ";
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
							<center><b><font size=4>Chicken Production Report</FONT></b></center>
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

						<td align='center' valign='middle'  style='border: 1px dotted #000'>Chicken Prod. Date </td>
                        
                        <td align='center' valign='middle'  style='border: 1px dotted #000'>Hatch No.</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Setting Qnty.</td>
						
						<td align='center' valign='middle'  style='border: 1px dotted #000'>Chicken Prod. Quantity</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Prod. Percentage</td>
						
						<td align='center' valign='middle'  style='border: 1px dotted #000'>Cancel Quantity</td>
						
						<td align='center' valign='middle'  style='border: 1px dotted #000'>Cancel Percentage % </td>

						
						
											
					</tr>";

// Query here.

						//$TOTAL_RECEIVE_QNTY_KG ='';
						$SL				= 1;
						$Global_Quantity = 0;
						$Global_Price	= 0;
						$Global_Sett_Quantity	=0;
						$Global_Prod_Qnty		=0;
						$Global_Cancel_Qnty		=0;
						$Cancel_Qnty_Percentage	=0;
						$Global_Cancel_Qnty_Perc	=	0;
						$Global_Prod_Perc		=0;
						
						$BasicQuery 	= "SELECT HATCHNO,
												  QUANTITY,
												  CHICKPRICEPERPCS,
												  CPDATE,
												  PERCENTAGE
												FROM hatch_chicken_production 
												WHERE CPDATE BETWEEN '".$OPENINGDATE_FROM."' AND '".$OPENINGDATE_TO."'
												{$con}
												AND PROJECTID = '".$PROJECTID."'
												AND SUBPROJECTID = '".$SUBPROJECTID."'
												AND WORKSFLAG = 'In'
												ORDER BY CPDATE ASC
										";
						$BasicQueryStatement			= mysql_query($BasicQuery);
						while($BasicQueryStatementData	= mysql_fetch_array($BasicQueryStatement)){	
							$HATCHNO		 			= $BasicQueryStatementData['HATCHNO'];
							$QUANTITY		 			= $BasicQueryStatementData['QUANTITY'];
							$CHICKPRICEPERPCS 			= $BasicQueryStatementData['CHICKPRICEPERPCS'];
							$CPDATE			 			= $BasicQueryStatementData['CPDATE'];
							$PERCENTAGE		 			= $BasicQueryStatementData['PERCENTAGE'];
							
							
							
							
							$EggSettingQuery 	= "SELECT EGGQNTY
													FROM hatch_egg_settings_machine 
													WHERE HATCHNO = '".$HATCHNO."'
													AND STATUS = 'In'
													ORDER BY HATCHNO ASC
											";
							$EggSettingQueryStatement				= mysql_query($EggSettingQuery);
							while($EggSettingQueryStatementData		= mysql_fetch_array($EggSettingQueryStatement)){	
								$SETTING_EGGQNTY		 			= $EggSettingQueryStatementData['EGGQNTY'];
							}
								
							$Global_Sett_Quantity		= $Global_Sett_Quantity + $SETTING_EGGQNTY ; 
							$Global_Prod_Qnty			= $Global_Prod_Qnty + $QUANTITY ; 
							$CancelQnty					= $SETTING_EGGQNTY - $QUANTITY ;
							$Global_Cancel_Qnty			= $Global_Cancel_Qnty + $CancelQnty ; 
							$Cancel_Qnty_Percentage		= ($CancelQnty * 100)/$SETTING_EGGQNTY ; 
							$Global_Cancel_Qnty_Perc	= ($Global_Cancel_Qnty * 100 ) / $Global_Sett_Quantity ; 
							$Global_Prod_Perc			=  ($Global_Prod_Qnty * 100 ) / $Global_Sett_Quantity ;
							
							$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000'>$SL</td>

											<td align='center' valign='top' style='border: 1px dotted #000'>$CPDATE</td>
					
											<td align='center' valign='top'  style='border: 1px dotted #000'>$HATCHNO</td>
											
											<td align='center' valign='top'  style='border: 1px dotted #000'>$SETTING_EGGQNTY</td>
											
											<td align='center' valign='top'  style='border: 1px dotted #000'>$QUANTITY</td>
											
											<td align='center' valign='top'  style='border: 1px dotted #000'>".number_format($PERCENTAGE,2)."&nbsp;&nbsp;%</td>
											
											<td align='center' valign='top'  style='border: 1px dotted #000'>$CancelQnty</td>
											
											<td align='center' valign='top'  style='border: 1px dotted #000'>".number_format($Cancel_Qnty_Percentage,2)."&nbsp;&nbsp;%</td>
											
											
											
																							
										</tr>

									 ";

								// Dynamic Row End		  

					$SL++;	
				
				}

					$tableView .="

						<tr style='font-weight:bold;'>

							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='center' valign='top'  style='border: 1px dotted #000'>&nbsp;</td>

							<td align='center' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='center' valign='top' style='border: 1px dotted #000'>$Global_Sett_Quantity</td>

							<td align='center' valign='top' style='border: 1px dotted #000'>".number_format($Global_Prod_Qnty)."</td>
							
							<td align='center' valign='top' style='border: 1px dotted #000'>".number_format($Global_Prod_Perc,2)."&nbsp;&nbsp;%</td>
							
							<td align='center' valign='top' style='border: 1px dotted #000'>$Global_Cancel_Qnty</td>
							
							<td align='center' valign='top' style='border: 1px dotted #000'>".number_format($Global_Cancel_Qnty_Perc,2)."&nbsp;&nbsp;%</td>
							
							
							
							
							
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