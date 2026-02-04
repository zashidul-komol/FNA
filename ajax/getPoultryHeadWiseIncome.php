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

	
	$POINID				= $_REQUEST['POINID'];
	$BATCHNO			= $_REQUEST['BATCHNO'];
	$ENTRYDATE_FROM 	= showDateMySQlFormat($_REQUEST['ENTRYDATE']);
	$ENTRYDATE_TO 		= showDateMySQlFormat($_REQUEST['ENTRYDATE2']);
	$userId 			= $_REQUEST['userId'];
	$con = '';
	if ($POINID == 'all'){
		$con = '';
	}else{
		$con = "AND oiexp.POINID='".$POEXID."' ";
	}
	if ($BATCHNO == 'all'){
		$batchcon = '';
	}else{
		$batchcon = "AND oiexp.BATCHNO='".$BATCHNO."' ";
	}
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
			
		
		//Ministry/Division and Project/Programme Name View Report Start
		if($POEXID == 'all'){
			$EXPANSEHEAD = 'All Income Head,';
		}else{
			$expanseSql 	= "
							SELECT oiexp.INCOMEHEAD										
							FROM pal_others_income oiexp
							WHERE oiexp.POINID = '".$POINID."' 
						";
			$expanseSqlStatement			= mysql_query($expanseSql);
			while($expanseSqlStatementData	= mysql_fetch_array($expanseSqlStatement)){
				$INCOMEHEAD	        		= $expanseSqlStatementData["INCOMEHEAD"];
			}
			
		}				
	 	
		echo 'komol';	
			//Ministry/Division and Project/Programme Name View Report End
			
	$tableView = "";	
	$tableView .="<table width='50%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:85%; border: 1px dotted #000'>

					  <tr>
						<td colspan='18' align='center' valign='middle' style='border: 1px dotted #000'>
							<center><b><font size=5>F N A Group Of Company</font></b></center>
							<center>&nbsp;</center>
							<center><b><font size=4>Poultry Firms Income Head Wise Report</FONT></b></center>
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
									
								  </tr>
								  <tr>
								
									<td width='14%' align='left' valign='top'>Sub Project Name<b></td>
									<td width='1%' align='center' valign='top'>:</td>
									<td width='34%' align='left' valign='top'> $SUBPROJECTNAME</td>
									<td width='18%' align='right' valign='top'>&nbsp;</td>
									
								  </tr>
								  
								  <tr>
								
									<td width='14%' align='left' valign='top'>Income Head Name<b></td>
									<td width='1%' align='center' valign='top'>:</td>
									<td width='34%' align='left' valign='top'> $INCOMEHEAD </td>
									<td width='18%' align='right' valign='top'>&nbsp;</td>
									
								  </tr>
																
								  <tr>
								
									<td align='left' valign='top'>&nbsp;</td>
									<td align='center' valign='top'>&nbsp;</td>
								
									<td align='left' valign='top'>&nbsp;</td>
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

						<td align='center' valign='middle' style='font-weight:bold;border: 1px dotted #000'>SL No.</td>
						
						<td align='center' valign='middle'  style='border: 1px dotted #000'>Batch No.</td>
						
						<td align='center' valign='middle'  style='border: 1px dotted #000'>Date</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Income Head name </td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Amount </td>
						
					</tr>";

// Query here.

						//$TOTAL_RECEIVE_QNTY_KG ='';
						$TOTAL_AMOUNT		='';
						$AMOUNT 			= '';
						$INCOMEHEAD			= '';
						$TOTAL_BILLAMOUNT 	= '';
						echo $basicQuery 		= "SELECT oiexp.POEXID,
													  oiexp.BATCHNO,
													  oiexp.ENTRYDATE,
													  oiexp.INCOMEAMOUNT,
													  oinc.INCOMEHEAD
												FROM pal_others_income_expanse oiexp, pal_others_income oinc
												WHERE oinc.POINID = oiexp.POINID
												{$con}
												{$batchcon}
												AND oiexp.ENTRYDATE between '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."' 
												ORDER BY oiexp.ENTRYDATE ASC
											";die();
						$basicQueryStatement			= mysql_query($basicQuery);
						$sl = 1;
						$glabalToatalBill = 0;
						$RECEIVEAMOUNT ='';
						$TOTAL_AMOUNT = 0;
						while($basicQueryStatementData	= mysql_fetch_array($basicQueryStatement)){
								 $POEXID        		= $basicQueryStatementData["POEXID"]; 
								 $BATCHNO        		= $basicQueryStatementData["BATCHNO"];
								 $ENTRYDATE        		= $basicQueryStatementData["ENTRYDATE"]; 
								 $INCOMEAMOUNT    		= $basicQueryStatementData["INCOMEAMOUNT"];
								 $INCOMEHEAD	       	= $basicQueryStatementData["INCOMEHEAD"];
								 
								 $TOTAL_AMOUNT 		= $TOTAL_AMOUNT + $INCOMEAMOUNT ;
								

						$tableView .=" <tr>
											<td width='10%' align='center' valign='top' style='border: 1px dotted #000'>$sl</td>
											
											<td width='15%' align='center' valign='top' style='border: 1px dotted #000'> $BATCHNO</td>
											
											<td width='25%' align='center' valign='top' style='border: 1px dotted #000'> $ENTRYDATE</td>
											
											<td width='30%' align='center' valign='top' style='border: 1px dotted #000'>$INCOMEHEAD</td>
											
											<td width='20%' align='right' valign='top' style='border: 1px dotted #000'>".number_format($INCOMEAMOUNT,2)."</td>
					
										</tr>

									 ";

								// Dynamic Row End		  

						
				$sl++;
				}
		

					$tableView .="

						<tr>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='RIGHT' valign='top' style='border: 1px dotted #000'><b>Total Amount : </b></td>
							
							<td align='RIGHT' valign='top' style='border: 1px dotted #000'><b>".number_format($TOTAL_AMOUNT,2)."</b></td>
							
						</tr>
						<tr>

							<td colspan='5' align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

						</tr>
							
						<tr>

							<td colspan='5' align='left' valign='top'>&nbsp;</td>

						</tr>
						<tr>

							<td colspan='5' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='5' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='5' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='5' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='5' align='left' valign='top' >
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