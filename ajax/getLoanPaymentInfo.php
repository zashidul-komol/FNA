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

	$PROJECTID 		= $_REQUEST['PROJECTID'];
	$SUBPROJECTID 	= $_REQUEST['SUBPROJECTID'];
	$PARTYID 		= $_REQUEST['PARTYID'];
	$CALDATE 		= insertDateMySQlFormat($_REQUEST['CALDATE']); 
	
				
	$tableView = "";	
	$tableView .="<table width='100%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:85%; border: 1px dotted #000'>
					  <tr style='font-weight:bold;'>
						<td align='left' valign='top' style='font-weight:bold;border: 1px dotted #000'>LoanID</td>

						<td align='left' valign='top'  style='border: 1px dotted #000'>Loan No.</td>
						
						<td align='left' valign='top'  style='border: 1px dotted #000'>Lot No.</td>
						
						<td align='left' valign='top'  style='border: 1px dotted #000'>Purpose</td>

						<td align='left' valign='top' style='border: 1px dotted #000'>Loan Date </td>

						<td align='right' valign='top' style='border: 1px dotted #000'>Loan Pay Date</td>

						<td align='right' valign='top' style='border: 1px dotted #000'>Loan Amount</td>
						
						<td align='right' valign='top' style='border: 1px dotted #000'>Loan Payment</td>

						<td align='right' valign='top' style='border: 1px dotted #000'>Principal Amnt </td>
						
						<td align='right' valign='top' style='border: 1px dotted #000'>Rest of amnt</td>
						
						<td align='right' valign='top' style='border: 1px dotted #000'>Int. Rate</td>
						
						<td align='right' valign='top' style='border: 1px dotted #000'>Int. Amount</td>
						
						<td align='right' valign='top' style='border: 1px dotted #000'>Tot. Amount</td>
						
						<td align='right' valign='top' style='border: 1px dotted #000'>Loan Balance</td>
						
						<td align='right' valign='top' style='border: 1px dotted #000'>Status</td>

					  </tr>";

// Query here.
//----------------------------------------------Session Year---------------------------------------------------

						$MaxSession_Query	= mysql_fetch_array(mysql_query("Select MAX(SESSIONYEARID) from fna_session WHERE PROJECTID = '".$PROJECTID."'"));
						$MaxProjSessionYearID	= $MaxSession_Query['MAX(SESSIONYEARID)'];
	
	//echo "SELECT STARTDATE,	ENDDATE	FROM fna_session WHERE SUBPROJECTID = '".$SUBPROJECTID."' AND PRODCATTYPEID = '".$PRODCATTYPEID."' AND PRODCATTYPEFLAG = '".$MaxProdCatTypeFlag."'";
	
						$SessionQuery	= "
											SELECT 	
													STARTDATE,
													ENDDATE
											FROM 	
													fna_session
											WHERE PROJECTID = '".$PROJECTID."'
											AND SESSIONYEARID = '".$MaxProjSessionYearID."'
											";
						$SessionQueryStatement					= mysql_query($SessionQuery);
						while($SessionQueryStatementData		= mysql_fetch_array($SessionQueryStatement)) {
							$STARTDATE		 					= $SessionQueryStatementData["STARTDATE"]; 
							$ENDDATE		 					= $SessionQueryStatementData["ENDDATE"];
						}
//----------------------------------------------Session Year End-----------------------------------------------
						

						 $aQuery 	= "SELECT   LOANID,
												LOANTYPEID,
												PROJECTID,
												SUBPROJECTID,
												PARTYID,
												LOAN_NUMBER,
												LOTNO,
												LOANDATE,
												LOAN_PAYMENTDATE,
												LOANAMOUNT,
												PRINCIPALAMOUNT,
												RESTOFTHE_AMOUNT,
												LOANPAYMENT,
												INTERESTRATE,
												INTERESTAMOUNT,
												LOAN_BALANCE,
												ENTRYDATE,
												LOANPURPOSE, 
												STATUS										
											FROM `fna_loan` 
											WHERE `PARTYID` = '".$PARTYID."' 
											AND  `PROJECTID` =  '".$PROJECTID."'
											AND `SUBPROJECTID` = '".$SUBPROJECTID."'
											AND LOANDATE BETWEEN '".$STARTDATE."' AND '".$ENDDATE."'
											ORDER BY LOTNO , LOANID ASC
									";
						$aQueryStatement	= mysql_query($aQuery);
						$sl = 1;
						$glabalToatalIntAmount = 0;
						$glabalToatalLoanAmount = 0;
						$GrandTotalLoan			= 0;
						$glabalToatalLoanPayment = 0;
						$PAYMENTAMOUNT ='';
						$partyBalAmount ='';
						$INT_AMOUNT = '';
						$TOT_LOANAMOUNT = '';
						$LOANTYPEID		='';
						$INTERESTRATE	='';
						$LOANPURPOSE	='';
						while($aQueryStatementData	= mysql_fetch_array($aQueryStatement)){

 						// Dynamic Row Start
						$LOANID 		= $aQueryStatementData['LOANID'];
						$LOANTYPEID 	= $aQueryStatementData['LOANTYPEID'];
						$PROJECTID 		= $aQueryStatementData['PROJECTID'];
						$SUBPROJECTID 	= $aQueryStatementData['SUBPROJECTID'];
						$PARTYID 		= $aQueryStatementData['PARTYID'];
						$LOAN_NUMBER	= $aQueryStatementData['LOAN_NUMBER'];
						$LOTNO			= $aQueryStatementData['LOTNO'];
						$LOANDATE 		= $aQueryStatementData['LOANDATE'];
						$LOAN_PAYMENTDATE	= $aQueryStatementData['LOAN_PAYMENTDATE'];
						$LOANAMOUNT 	= round($aQueryStatementData['LOANAMOUNT']);
						$PRINCIPALAMOUNT 	= round($aQueryStatementData['PRINCIPALAMOUNT']);
						$RESTOFTHE_AMOUNT 	= round($aQueryStatementData['RESTOFTHE_AMOUNT']);
						
						$INTERESTRATE 	= $aQueryStatementData['INTERESTRATE'];
						$INTERESTAMOUNT = round($aQueryStatementData['INTERESTAMOUNT']);
						$LOANPAYMENT	= round($aQueryStatementData['LOANPAYMENT']);
						$LOAN_BALANCE	= round($aQueryStatementData['LOAN_BALANCE']);
						$ENTRYDATE 		= $aQueryStatementData['ENTRYDATE'];
						$LOANPURPOSE 	= $aQueryStatementData['LOANPURPOSE'];
						$STATUS		 	= $aQueryStatementData['STATUS'];
						
						
						$LoanTypeNameQuery 	= "SELECT   LOANTYPENAME										
														FROM `fna_loantype` 
														WHERE `LOANTYPEID` = '".$LOANTYPEID."' 
														ORDER BY LOANTYPENAME ASC
												";
						$LoanTypeNameQueryStatement				= mysql_query($LoanTypeNameQuery);
						while($LoanTypeNameQueryStatementData	= mysql_fetch_array($LoanTypeNameQueryStatement)){
 							$LOANTYPENAME	 					= $LoanTypeNameQueryStatementData['LOANTYPENAME'];
						}
						
						$daylen = 60*60*24;

					   $date2 = $ENTRYDATE;
					   $date1 = $CALDATE;
					   
					   
					   if($STATUS == 'Inactive'){
						   	$days = (strtotime($date1)-strtotime($date2))/$daylen;
					   		$INT_AMOUNT = 0; 
					  		$TOT_LOANAMOUNT = round($RESTOFTHE_AMOUNT + $INT_AMOUNT) ;
						  }else{
							$days = (strtotime($date1)-strtotime($date2))/$daylen;
						   	$INT_AMOUNT = round(((($RESTOFTHE_AMOUNT * $INTERESTRATE)/100)/365) * $days) ; 
						   	$TOT_LOANAMOUNT = round($RESTOFTHE_AMOUNT + $INT_AMOUNT) ;
						}
					
					   $glabalToatalIntAmount 	= $glabalToatalIntAmount + $INTERESTAMOUNT ;
					   $glabalToatalLoanAmount 	= $glabalToatalLoanAmount + $LOANAMOUNT ; 
					   $GrandTotalLoan			= $glabalToatalIntAmount +  $LOAN_BALANCE ;
					   $glabalToatalLoanPayment	= $glabalToatalLoanPayment + $LOANPAYMENT ; 
						
						$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000'>$LOANID</td>

											<td align='left' valign='top' style='border: 1px dotted #000'> $LOAN_NUMBER</td>
											
											<td align='left' valign='top' style='border: 1px dotted #000'> $LOTNO</td>
											
											<td align='left' valign='top' style='border: 1px dotted #000'> $LOANTYPENAME</td>
					
											<td align='left' valign='top'  style='border: 1px dotted #000'>$LOANDATE</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>$LOAN_PAYMENTDATE</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($LOANAMOUNT,2)."</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($LOANPAYMENT,2)."</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($PRINCIPALAMOUNT,2)."</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($RESTOFTHE_AMOUNT,2)." </td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($INTERESTRATE,2)."</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($INTERESTAMOUNT,2)."</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($TOT_LOANAMOUNT,2)."</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($LOAN_BALANCE,2)." </td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>$STATUS</td>
											
										</tr>

									 ";

								// Dynamic Row End		  

				$sl++;
				}

					$tableView .="

						<tr bgcolor='#CCCCCC'>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top'  style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='left' valign='top'  style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($glabalToatalLoanAmount,2)."</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($glabalToatalLoanPayment,2)."</td>
							
							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($glabalToatalIntAmount,2)."</td>
							
							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($GrandTotalLoan,2)."</td>
							
							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
							

						</tr>
						<tr>

							<td colspan='15' align='left' valign='top' style='border: 1px dotted #000'>
									<table width='100%' border='0' cellpadding='3' cellspacing='0'>	
										<tr valign='top'>
										  <td align='right'>Loan ID:</td>
										  <td height='26' align='left'><input type='text' name='LOANID' id='LOANID' style='width:167px;' /></td>
										  <td height='26' align='right'>&nbsp;</td>
										  <td height='26' align='left'>&nbsp;</td>
										</tr>
										<tr valign='top'>
										  <td align='right'>Loan Amount:</td>
										  <td height='26' align='left'><input type='text' name='amount2' id='amount2' style='width:167px;' /></td>
										  <td height='26' align='right'>&nbsp;</td>
										  <td height='26' align='left'>&nbsp;</td>
										</tr>
										<tr valign='top'>
										  <td align='right'>Int. Amount:</td>
										  <td height='26' align='left'><input type='text' name='intAmount' id='intAmount' style='width:167px;' /></td>
										  <td height='26' align='right'>&nbsp;</td>
										  <td height='26' align='left'>&nbsp;</td>
										</tr>
										<tr valign='top'>
										  <td align='right'>&nbsp;</td>
										  <td height='26' align='left'>
										  <input type='hidden' name='LOANTYPEID' id='LOANTYPEID' value='{$LOANTYPEID}'/>
										  <input type='hidden' name='INTERESTRATE' id='INTERESTRATE' value='{$INTERESTRATE}'/>
										  <input type='hidden' name='LOANPURPOSE' id='LOANPURPOSE' value='{$LOANPURPOSE}'/>
										  <input type='hidden' name='INT_AMOUNT' id='INT_AMOUNT' value='{$INT_AMOUNT}'/>
										  <input type='hidden' name='TOT_LOANAMOUNT' id='TOT_LOANAMOUNT' value='{$TOT_LOANAMOUNT}'/>
										  <input type='hidden' name='PROJECTID' id='PROJECTID' value='{$PROJECTID}'/>
										  <input type='hidden' name='SUBPROJECTID' id='SUBPROJECTID' value='{$SUBPROJECTID}'/>
										  <input type='hidden' name='PARTYID' id='PARTYID' value='{$PARTYID}'/>
										  <input type='hidden' name='CALDATE' id='CALDATE' value='{$CALDATE}'/>
										  <input type='submit' name='InsertLoanPaymentInfo' value='Insert' class='FormSubmitBtn' />
										  <input name='btnClose' type='button' value='Close' onClick='return ShowHide('showLoad')'>
										  </td>
										  <td height='26' align='right'>&nbsp;</td>
										  <td height='26' align='left'>&nbsp;</td>
										</tr>	
								 </table>
							</td>

						</tr>
					</table>";
	echo $tableView;

?>