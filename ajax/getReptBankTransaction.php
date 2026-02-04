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
	
	$BANKID 			= $_REQUEST['BANKID'];
	$BRANCHID			= $_REQUEST['BRANCHID'];
	$ACCOUNTNO 			= $_REQUEST['ACCOUNTNO'];
	
	$ENTRYDATE_FROM 	= showDateMySQlFormat($_REQUEST['ENTRYDATE']);
	$ENTRYDATE_TO 		= showDateMySQlFormat($_REQUEST['ENTRYDATE2']);
	$userId 			= $_REQUEST['userId'];
	
	if ($ACCOUNTNO == 'All'){
		$con = '';
	}else{
		$con = "AND bt.ACCOUNTNO='".$ACCOUNTNO."' ";
	}
	
		$Last_Date = date_create($ENTRYDATE_TO);
		date_sub($Last_Date, date_interval_create_from_date_string('1 days'));
		$LastDay = date_format($Last_Date, 'Y-m-d');

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
			
			$BankSql 	= "
							SELECT  b.BANKNAME, 
									br.BRANCHNAME,
									bac.ACCOUNTNO,
									bac.ACCOUNTNAME											
							FROM fna_bank b, fna_branch br, fna_bankaccount bac
							WHERE b.BANKID = br.BANKID
							AND br.BRANCHID = bac.BRANCHID
							AND bac.ACCOUNTNO = '".$ACCOUNTNO."'
						";
			$BankSqlStatement					= mysql_query($BankSql);
			$BANKNAME = '';
			$BRANCHNAME	= '';
			$ACCOUNTNO = '';
			$ACCOUNTNAME = '';
			while($BankSqlStatementData			= mysql_fetch_array($BankSqlStatement)){
				$BANKNAME	        			= $BankSqlStatementData["BANKNAME"];
				$BRANCHNAME		       			= $BankSqlStatementData["BRANCHNAME"];
				$ACCOUNTNO		       			= $BankSqlStatementData["ACCOUNTNO"];
				$ACCOUNTNAME	       			= $BankSqlStatementData["ACCOUNTNAME"];
			}
			
			//Ministry/Division and Project/Programme Name View Report End
			
	$tableView = "";	
	$tableView .="<table width='65%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:85%; border: 1px dotted #000'>

					  <tr>
                            <td style='text-align:right;' colspan='13'>
                            <a href='javascript:Clickheretoprint()'><img border='0' src='images/print_icon.jpg' width='40' height='26' /></a>                        
                            </td>
                     </tr>
					  <tr>
						<td colspan='18' align='center' valign='middle' style='border: 1px dotted #000'>
							<center><b><font size=5>F N A Group Of Company</font></b></center>
							<center>&nbsp;</center>
							<center><b><font size=4>Bank Transaction Report</FONT></b></center>
							<center>&nbsp;</center>
							<center><b><font size=2>Date : $ENTRYDATE_FROM to $ENTRYDATE_TO </font></b></center>
						</td>
					  </tr>
					  <tr>

						<td colspan='18' align='left' valign='top'>
							<table width='100%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:100%;'>
								  <tr>
								
									<td width='14%' align='left' valign='top'>Project  Name<b></td>
									<td width='1%' align='center' valign='top'>:</td>
									<td width='35%' align='left' valign='top'> $PROJECTNAME</td>
									<td width='20%' align='right' valign='top'>Bank Name:</td>
									<td width='20%' align='left' valign='top'>$BANKNAME</td>
									<td width='10%' align='left' valign='top'>&nbsp;</td>
									<td align='left' valign='top'>&nbsp;</td>
								
								  </tr>
								
								  <tr>
								
									<td width='14%' align='left' valign='top'>Sub Project Name</td>
									<td width='1%' align='center' valign='top'>:</td>
									<td width='35%' align='left' valign='top'> $SUBPROJECTNAME </td>
									<td width='20%' align='right' valign='top'>Branch Name:</td>
									<td width='20%' align='left' valign='top'>$BRANCHNAME</td>
									<td width='10%' align='left' valign='top'>&nbsp;</td>
									<td align='left' valign='top'> &nbsp;</td>
								
								  </tr>
								   <tr>
								
									<td width='14%' align='left' valign='top'>&nbsp;</td>
									<td width='1%' align='center' valign='top'>&nbsp;</td>
									<td width='35%' align='left' valign='top'>&nbsp;</td>
									<td width='20%' align='right' valign='top'>Account Name:</td>
									<td width='20%' align='left' valign='top'>$ACCOUNTNAME</td>
									<td width='10%' align='left' valign='top'>&nbsp;</td>
									<td align='left' valign='top'> &nbsp;</td>
								
								  </tr>
								  <tr>
								
									<td width='14%' align='left' valign='top'>&nbsp;</td>
									<td width='1%' align='center' valign='top'>&nbsp;</td>
									<td width='35%' align='left' valign='top'>&nbsp;</td>
									<td width='20%' align='right' valign='top'>Account No:</td>
									<td width='20%' align='left' valign='top'>$ACCOUNTNO</td>
									<td width='10%' align='left' valign='top'>&nbsp;</td>
									<td align='left' valign='top'> &nbsp;</td>
								
								  </tr>
								  <tr>
								  	<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								  </tr>
								  							
								 </table>
							

						</td>

					  </tr>
					  <tr style='font-weight:bold;'>

						<td align='center' valign='middle' style='font-weight:bold;border: 1px dotted #000'>Date</td>

						<td align='center' valign='middle' style='border: 1px dotted #000'>Account Number</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Withdraw</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Deposit</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Description</td>

						<td align='center' valign='middle' style='border: 1px dotted #000'>Balance</td>
						
					</tr>";

// Query here.
						
						//$TOTAL_RECEIVE_QNTY_KG ='';
						$ENTRYDATE_ARRAY = array();
						$BALANCE_global = 0;
						$DEPOSIT_global = 0;
						$WITHDRAW_global = 0;
						$BALANCE = 0;	
						$ACCOUNTBALANCE = 0;
						$i = 0;
						
						
						$BankTransQuery 	= "SELECT bt.BTDATE
												FROM fna_banktransaction bt
												WHERE bt.PROJECTID = '".$PROJECTID."'
												AND bt.SUBPROJECTID = '".$SUBPROJECTID."'
												{$con}
												AND bt.BTDATE between '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."' 
												ORDER BY bt.BTDATE ASC
											";
						$BankTransQueryStatement				= mysql_query($BankTransQuery);
						while($BankTransQueryStatementData		= mysql_fetch_array($BankTransQueryStatement)){	
							$ENTRYDATE_ARRAY[] 					= $BankTransQueryStatementData['BTDATE'];
							$i++;
						}
						
						//$ENTRYDATE_ARRAY_UNIQUE = array_unique($ENTRYDATE_ARRAY);
						
						$BankTrans_Query 	= "SELECT bt.DEPOSIT,
													  bt.WITHDRAW,
													  bt.ACCOUNTNO,
													  bt.BALANCE,
													  bt.DESCRIPTION,
													  bt.ACCOUNTBALANCE,
													  bt.BTDATE,
													  bt.ACCFLAG
												FROM fna_banktransaction bt, fna_bankaccount bac
												WHERE bt.BANKACCOUNTID = bac.BANKACCOUNTID
												AND bt.PROJECTID = '".$PROJECTID."'
												AND bt.SUBPROJECTID = '".$SUBPROJECTID."'
												AND bt.BANKID = '".$BANKID."'
												AND bt.BRANCHID = '".$BRANCHID."'
												{$con}
												AND bt.BTDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
												ORDER BY bt.ACCFLAG ASC
											";
						$BankTrans_QueryStatement				= mysql_query($BankTrans_Query);
						while($BankTrans_QueryStatementData		= mysql_fetch_array($BankTrans_QueryStatement)){	
							$DEPOSIT							= $BankTrans_QueryStatementData['DEPOSIT'];
							$WITHDRAW							= $BankTrans_QueryStatementData['WITHDRAW'];
							$BALANCE							= $BankTrans_QueryStatementData['BALANCE'];
							$ACCOUNTNO							= $BankTrans_QueryStatementData['ACCOUNTNO'];
							$ACCOUNTBALANCE						= $BankTrans_QueryStatementData['ACCOUNTBALANCE'];
							$DESCRIPTION						= $BankTrans_QueryStatementData['DESCRIPTION'];
							$BTDATE								= $BankTrans_QueryStatementData['BTDATE'];
							$ACCFLAG							= $BankTrans_QueryStatementData['ACCFLAG'];
							
						$DEPOSIT_global = $DEPOSIT_global + $DEPOSIT ;
						$WITHDRAW_global = $WITHDRAW_global + $WITHDRAW ;
						$ACCBALANCE		 = $DEPOSIT_global - $WITHDRAW_global ; 
						
						
						$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000'>$BTDATE</td>

											<td align='right' valign='top' style='border: 1px dotted #000'>$ACCOUNTNO</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($WITHDRAW,2)."</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($DEPOSIT,2)."</td>
											
											<td align='center' valign='top' style='border: 1px dotted #000'>$DESCRIPTION</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($ACCOUNTBALANCE,2)."</td>
											
											
										</tr>

									 ";
							
								// Dynamic Row End		  
							
					}	
				
				

					$tableView .="

						<tr style='font-weight:bold;'>

							<td align='right' valign='top' style='border: 1px dotted #000'>Grand Total:</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($WITHDRAW_global,2)."</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($DEPOSIT_global,2)."</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
							
						</tr>
						<tr>

							<td colspan='6' align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

						</tr>
							
						<tr>

							<td colspan='6' align='left' valign='top'>&nbsp;</td>

						</tr>
						<tr>

							<td colspan='6' align='center' valign='top' style='font-weight:bold;' >
								<table width='50%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:100%;'>
								  <tr>
									<td align='right' width='50%' style='border: 1px dotted #000'>Total Deposit</td>
									<td width='2%' style='border: 1px dotted #000'>:</td>
									<td width='48%' style='border: 1px dotted #000'>".number_format($DEPOSIT_global,2)."</td>
								  </tr>
								  <tr>
									<td align='right' width='50%' style='border: 1px dotted #000'>Total Withdraw </td>
									<td width='2%' style='border: 1px dotted #000'>:</td>
									<td width='48%' style='border: 1px dotted #000'>".number_format($WITHDRAW_global,2)."</td>
								  </tr>
								  <tr>
									<td align='right' width='50%' style='border: 1px dotted #000'>Balance</td>
									<td width='2%' style='border: 1px dotted #000'>:</td>
									<td width='48%' style='border: 1px dotted #000'>".number_format($ACCOUNTBALANCE,2)."</td>
								  </tr>
								</table>
							</td>

						</tr>	
						<tr>

							<td colspan='6' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='6' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='6' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='6' align='left' valign='top' >
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

							<td colspan='6' align='left' valign='top' >&nbsp;</td>

						</tr>
						<tr>

							<td colspan='6' align='left' valign='top' >&nbsp;</td>

						</tr>					

					</table>";
	echo $tableView;
									
?>