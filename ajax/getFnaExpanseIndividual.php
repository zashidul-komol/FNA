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
	$EXPHID				= $_REQUEST['EXPHID'];
	$VOUCHERNO			= $_REQUEST['VOUCHERNO'];
	$ENTRYDATE_FROM 	= showDateMySQlFormat($_REQUEST['ENTRYDATE']);
	$ENTRYDATE_TO 		= showDateMySQlFormat($_REQUEST['ENTRYDATE2']);
	$userId 			= $_REQUEST['userId'];

	$WhereQ = '';
	$WhereQQ = '';
	$WhereExp = '';
	$WhereVouc = '';
	
	if ($_REQUEST['PROJECTID']!=''){
		if($_REQUEST['PROJECTID']=='All'){
			$WhereQ .= '';
		}else{
			$WhereQ .= "AND exp.PROJECTID = '".$PROJECTID."'";
		}
		
	}
	if ($_REQUEST['SUBPROJECTID']!=''){
		if($_REQUEST['SUBPROJECTID']=='All'){
			$WhereQQ .= '';
		}else{
			$WhereQQ .= "AND exp.SUBPROJECTID = '".$SUBPROJECTID."'";
		}
		
	}

	if ($_REQUEST['VOUCHERNO']!=''){
		if($_REQUEST['VOUCHERNO']==''){
			$WhereVouc .= '';
		}else{
			$WhereVouc .= "AND exp.VOUCHERNO = '".$VOUCHERNO."'";
		}
		
	}
	if ($EXPHID != '') {
		if ($EXPHID == 'all') {
			$WhereExp .= '';
		} else {
			$WhereExp .= " AND exp.EXPHID = '.$EXPHID.' ";
		}
	}
		
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
	 	$expanseSql 	= "
							SELECT e.EXPHEADNAME										
							FROM fna_expense_head e
						";
			$expanseSqlStatement			= mysql_query($expanseSql);
			while($expanseSqlStatementData	= mysql_fetch_array($expanseSqlStatement)){
				$EXPHEADNAME        		= $expanseSqlStatementData["EXPHEADNAME"];
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
							<center><b><font size=4>Expanse Head Wise Report</FONT></b></center>
							<center>&nbsp;</center>
							<center><b><font size=2>Date : $ENTRYDATE_FROM to $ENTRYDATE_TO </font></b></center>
						</td>
					  </tr>
					  <tr>

						<td colspan='18' align='left' valign='top'>
						</td>

					  </tr>
					  <tr style='font-weight:bold;'>

						<td align='center' valign='middle' style='font-weight:bold;border: 1px dotted #000'>SL No.</td>
						
						<td align='center' valign='middle' style='font-weight:bold;border: 1px dotted #000'>Expanse Date</td>

						<td align='center' valign='middle'  style='border: 1px dotted #000'>Project Name</td>

						<td align='center' valign='middle'  style='border: 1px dotted #000'>Sub Project Name</td>

						<td align='center' valign='middle'  style='border: 1px dotted #000'>Expanse Head name</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Description</td>

						<td align='center' valign='middle' style='border: 1px dotted #000'>Voucher No: </td>

						<td align='center' valign='middle' style='border: 1px dotted #000'>Amount </td>
						
					</tr>";

// Query here.

						//$TOTAL_RECEIVE_QNTY_KG ='';
						$TOTAL_AMOUNT		='';
						$AMOUNT 			= '';
						$EXPDATE			= '';
						$VOUCHERNO			= '';
						$DESCRIPTION 		= '';
						$EXPHEADNAME		= '';
						$basicQuery 		= "SELECT 	exp.EXPHID,
														exp.ENTRYSERIALNOID,
														exp.AMOUNT,
														exp.EXPDATE,
														exp.VOUCHERNO,
														exp.DESCRIPTION,
														ehn.EXPHEADNAME,
														proj.PROJECTNAME,
														subproj.SUBPROJECTNAME
													FROM fna_expanse exp
													JOIN fna_expense_head ehn 
														ON ehn.EXPHID = exp.EXPHID
													JOIN fna_project proj 
														ON proj.PROJECTID = exp.PROJECTID
													JOIN fna_subproject subproj 
														ON subproj.SUBPROJECTID = exp.SUBPROJECTID
													WHERE exp.EXPDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
													{$WhereQ}
													{$WhereQQ}
													{$WhereExp}
													{$WhereVouc}
													ORDER BY ehn.EXPHEADNAME ASC";
						$basicQueryStatement			= mysql_query($basicQuery);
						$sl = 1;
						$glabalToatalBill = 0;
						$RECEIVEAMOUNT ='';
						while($basicQueryStatementData	= mysql_fetch_array($basicQueryStatement)){
								 $EXPHID        		= $basicQueryStatementData["EXPHID"];
								 $ENTRYSERIALNOID  		= $basicQueryStatementData["ENTRYSERIALNOID"];  
								 $AMOUNT        		= $basicQueryStatementData["AMOUNT"];
								 $EXPDATE        		= $basicQueryStatementData["EXPDATE"];  
								 $VOUCHERNO      		= $basicQueryStatementData["VOUCHERNO"]; 
								 $DESCRIPTION       	= $basicQueryStatementData["DESCRIPTION"];
								 $EXPHEADNAME       	= $basicQueryStatementData["EXPHEADNAME"];
								 $NEW_PROJECTNAME      	= $basicQueryStatementData["PROJECTNAME"];
								 $NEW_SUBPROJECTNAME   	= $basicQueryStatementData["SUBPROJECTNAME"];
								// $EXPSUBHEADNAME       	= $basicQueryStatementData["SUBHEADNAME"];	
								 
								 $TOTAL_AMOUNT = $TOTAL_AMOUNT + $AMOUNT ;
							
						$tableView .=" <tr>
											<td width='7%' align='center' valign='top' style='border: 1px dotted #000'>$ENTRYSERIALNOID</td>
											
											<td width='8%' align='center' valign='top' style='border: 1px dotted #000'>$EXPDATE</td>

											<td width='15%' align='left' valign='top' style='border: 1px dotted #000'> $NEW_PROJECTNAME</td>

											<td width='15%' align='left' valign='top' style='border: 1px dotted #000'> $NEW_SUBPROJECTNAME</td>

											<td width='15%' align='left' valign='top' style='border: 1px dotted #000'> $EXPHEADNAME</td>
											
											<td width='25%' align='left' valign='top'  style='border: 1px dotted #000'>$DESCRIPTION</td>
					
											<td width='8%' align='right' valign='top' style='border: 1px dotted #000'>$VOUCHERNO</td>
					
											<td width='7%' align='right' valign='top' style='border: 1px dotted #000'>".number_format($AMOUNT,2)."</td>
					
										</tr>

									 ";

								// Dynamic Row End		  

						
				$sl++;
				}

					$tableView .="

						<tr>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top'  style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top'  style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='right' valign='top' style='border: 1px dotted #000'><b>Total Amount : </b></td>

							<td align='RIGHT' valign='top' style='border: 1px dotted #000'><b>".number_format($TOTAL_AMOUNT,2)."</b></td>
							
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
									<td align='center' valign='top'  ><b>Store Keeper Signature</b></td>
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