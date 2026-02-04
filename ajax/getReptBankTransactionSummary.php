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
							<center><b><font size=4>Bank Transaction Summary Report</FONT></b></center>
							<center>&nbsp;</center>
							<center><b><font size=2>Date : $ENTRYDATE_FROM to $ENTRYDATE_TO </font></b></center>
						</td>
					  </tr>
					  <tr>

						<td colspan='18' align='left' valign='top'>
							<table width='100%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:100%;'>
								 
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

						<td align='center' valign='middle' style='font-weight:bold;border: 1px dotted #000'>Bank Name</td>

						<td align='center' valign='middle' style='border: 1px dotted #000'>Account Name</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Branch Name</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Withdraw</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Deposit</td>

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
						
						
						$BankTransQuery 	= "SELECT DISTINCT bt.BANKACCOUNTID
												FROM fna_banktransaction bt
												WHERE bt.PROJECTID = '".$PROJECTID."'
												AND bt.SUBPROJECTID = '".$SUBPROJECTID."'
												AND bt.BTDATE between '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."' 
												ORDER BY bt.BTDATE ASC
											";
						$BankTransQueryStatement				= mysql_query($BankTransQuery);
						while($BankTransQueryStatementData		= mysql_fetch_array($BankTransQueryStatement)){	
							$BANKACCOUNTID_ARRAY[] 				= $BankTransQueryStatementData['BANKACCOUNTID'];
							$i++;
						}
						
						$BANKACCOUNTID_ARRAY_UNIQUE = array_unique($BANKACCOUNTID_ARRAY);
						foreach($BANKACCOUNTID_ARRAY_UNIQUE as $individualBankAccID){
						
						$BankTrans_Query 	= "SELECT SUM(bt.DEPOSIT) DEPOSIT,
													  SUM(bt.WITHDRAW) WITHDRAW,
													  bt.ACCOUNTNO,
													  bt.BANKACCOUNTID,
													  bt.BANKID,
													  bt.BRANCHID,
													  bt.ACCOUNTBALANCE,
													  bt.BTDATE,
													  br.BRANCHNAME,
													  bac.ACCOUNTNAME,
													  b.BANKNAME
												FROM fna_banktransaction bt, fna_bankaccount bac, fna_bank b, fna_branch br
												WHERE b.BANKID = br.BANKID
												AND br.BRANCHID = bac.BRANCHID
												AND bt.BANKACCOUNTID = bac.BANKACCOUNTID
												AND bt.PROJECTID = '".$PROJECTID."'
												AND bt.SUBPROJECTID = '".$SUBPROJECTID."'
												AND bt.BANKACCOUNTID = '".$individualBankAccID."'
												AND bt.BTDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
												ORDER BY bt.BTDATE ASC
											";
						$BankTrans_QueryStatement				= mysql_query($BankTrans_Query);
						while($BankTrans_QueryStatementData		= mysql_fetch_array($BankTrans_QueryStatement)){	
							$DEPOSIT							= $BankTrans_QueryStatementData['DEPOSIT'];
							$WITHDRAW							= $BankTrans_QueryStatementData['WITHDRAW'];
							$ACCOUNTNO							= $BankTrans_QueryStatementData['ACCOUNTNO'];
							$BANKACCOUNTID						= $BankTrans_QueryStatementData['BANKACCOUNTID'];
							$BRANCHNAME							= $BankTrans_QueryStatementData['BRANCHNAME'];
							$ACCOUNTNAME						= $BankTrans_QueryStatementData['ACCOUNTNAME'];
							$BANKNAME							= $BankTrans_QueryStatementData['BANKNAME'];
							$ACCOUNTBALANCE						= $BankTrans_QueryStatementData['ACCOUNTBALANCE'];
							$DESCRIPTION						= $BankTrans_QueryStatementData['DESCRIPTION'];
							$BTDATE								= $BankTrans_QueryStatementData['BTDATE'];
						}
						
						$Now_AccBalance		= $DEPOSIT - $WITHDRAW ; 
						$DEPOSIT_global 	= $DEPOSIT_global + $DEPOSIT ;
						$WITHDRAW_global 	= $WITHDRAW_global + $WITHDRAW ;
						$Global_Balance		= $DEPOSIT_global - $WITHDRAW_global ; 
						
						
						$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000'>$BANKNAME</td>

											<td align='right' valign='top' style='border: 1px dotted #000'>$ACCOUNTNAME</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>$BRANCHNAME</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($WITHDRAW,2)."</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($DEPOSIT,2)."</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Now_AccBalance,2)."</td>
											
											
										</tr>

									 ";
							
								// Dynamic Row End		  
							
					}	
				
				

					$tableView .="

						<tr style='font-weight:bold;'>

							<td align='right' valign='top' style='border: 1px dotted #000'>Grand Total:</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($WITHDRAW_global,2)."</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($DEPOSIT_global,2)."</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_Balance,2)."</td>
							
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
									<td width='48%' style='border: 1px dotted #000'>".number_format($Global_Balance,2)."</td>
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