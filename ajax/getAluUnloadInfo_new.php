<?php
include('../config/dbinfo.inc.php');
	
function showDateMySQlFormat($date){
	
		$exp = explode("-",$date);				
		$mysqlDateF = $exp[2]."-".$exp[1]."-".$exp[0];
		
		return $mysqlDateF;
}
	$PROJECTID 		= $_REQUEST['PROJECTID'];
	$SUBPROJECTID 	= $_REQUEST['SUBPROJECTID'];
	//$PARTYID 		= $_REQUEST['PARTYID'];
	$LABOURID 		= $_REQUEST['LABOURID'];
	$ENTRYDATE 		= showDateMySQlFormat($_REQUEST['ENTRYDATE']);
	$LOTNO	 		= $_REQUEST['LOTNO'];
	
	$LotNoQry			= mysql_fetch_array(mysql_query("SELECT MAX(LOTFLAG) FROM fna_alustock WHERE LOTNO = '".$LOTNO."'"));
	$NowMaxLotFlag		= $LotNoQry['MAX(LOTFLAG)'];
	
	$PartyIdQry			= mysql_fetch_array(mysql_query("SELECT PARTYID FROM fna_alustock WHERE LOTFLAG = '".$NowMaxLotFlag."'"));
	$PARTYID			= $PartyIdQry['PARTYID'];
	
	
				
	$tableView = "";	
	$tableView .="<table width='100%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:85%; border: 1px dotted #000'>
					  <tr style='font-weight:bold;'>
						<td align='left' valign='top' style='font-weight:bold;border: 1px dotted #000'>LOT NO.</td>

						<td align='center' valign='top'  style='border: 1px dotted #000'>Date</td>

						<td align='right' valign='top' style='border: 1px dotted #000'>Load Quantity </td>

						<td align='right' valign='top' style='border: 1px dotted #000'>Unload Quantity</td>
						
						<td align='right' valign='top' style='border: 1px dotted #000'>Fna Bill</td>
						
						<td align='center' valign='top' style='border: 1px dotted #000'>Car Loan</td>
						
						<td align='right' valign='top' style='border: 1px dotted #000'>Interest</td>
						
						<td align='right' valign='top' style='border: 1px dotted #000'>Total Taka</td>

						<td align='right' valign='top' style='border: 1px dotted #000'>Balance Quantity</td>

					</tr>";

// Query here.

						$aQuery 	= "SELECT	
												lc.LOTNO,
												lc.PROJECTID,
												lc.SUBPROJECTID,
												lc.PARTYID,
												lc.ENTRYDATE,
												alustck.PRODUCTID,
												alustck.LOTTOTQNTY,
												alustck.QUANTITY,
												alustck.PARTYTOTQNTY,
												alustck.WORKTYPEFLAG			
										FROM fna_productloadunload lc, fna_productloadunloadbkdn bkdn, fna_alustock alustck
										WHERE lc.PRODUCTLOADUNLOADID = bkdn.PRODUCTLOADUNLOADID
										AND bkdn.PRODUCTLOADUNLOADBKDNID = alustck.PRODUCTLOADUNLOADBKDNID
										AND lc.PARTYID = '".$PARTYID."' 
										AND lc.PROJECTID =  '".$PROJECTID."'
									    AND lc.SUBPROJECTID = '".$SUBPROJECTID."'
									    AND lc.LOTNO = '".$LOTNO."'
										ORDER BY lc.LOTNO ASC
									";
						$aQueryStatement	= mysql_query($aQuery);
						$sl = 1;
						$glabalToatalBill = 0;
						$PAYMENTAMOUNT ='';
						$partyBalAmount ='';
						$INT_AMOUNT = '';
						$TOT_LOANAMOUNT = '';
						$LOANTYPEID		='';
						$INTERESTRATE	='';
						$LOANPURPOSE	='';
						while($aQueryStatementData	= mysql_fetch_array($aQueryStatement)){

 						// Dynamic Row Start
						$QUANTITY_ALU 		= $aQueryStatementData['QUANTITY'];
						$WORKTYPEFLAG 		= $aQueryStatementData['WORKTYPEFLAG'];
						$LOTTOTQNTY 		= $aQueryStatementData['LOTTOTQNTY'];
						$ENTRYDATE_ALU		= $aQueryStatementData['ENTRYDATE'];
						
						$LOAD_QNTY		=0;
						$UNLOAD_QNTY	=0;
						if($WORKTYPEFLAG == 'Load'){
							$LOAD_QNTY		= $QUANTITY_ALU;
							$UNLOAD_QNTY	=0;
							}else{
							$LOAD_QNTY		=0;
							$UNLOAD_QNTY	= $QUANTITY_ALU;
							}
						//$BALANCE_QUANTITY  = 
						$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000'>$LOTNO</td>

											<td align='right' valign='top' style='border: 1px dotted #000'> $ENTRYDATE_ALU</td>
					
											<td align='right' valign='top'  style='border: 1px dotted #000'>$LOAD_QNTY</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>$UNLOAD_QNTY</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>$LOTTOTQNTY </td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'> $ENTRYDATE_ALU</td>
					
											<td align='right' valign='top'  style='border: 1px dotted #000'>$LOAD_QNTY</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>$UNLOAD_QNTY</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>$LOTTOTQNTY </td>
					
										</tr>

									 ";

								// Dynamic Row End		  

				$sl++;
				}

					$tableView .="

						<tr>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top'  style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='left' valign='top'  style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

						</tr>
						<tr>

							<td colspan='9' align='left' valign='top' style='border: 1px dotted #000'>
									<table width='100%' border='0' cellpadding='3' cellspacing='0'>	
										<tr valign='top'>
										  <td align='right'>Basta Quantity:</td>
										  <td height='26' align='left'><input type='text' name='amount2' id='amount2' style='width:167px;' /></td>
										  <td height='26' align='right'>&nbsp;</td>
										  <td height='26' align='left'>&nbsp;</td>
										</tr>
										<tr valign='top'>
										  <td align='right'>&nbsp;</td>
										  <td height='26' align='left'>
										  <input type='hidden' name='PROJECTID' id='PROJECTID' value='{$PROJECTID}'/>
										  <input type='hidden' name='SUBPROJECTID' id='SUBPROJECTID' value='{$SUBPROJECTID}'/>
										  <input type='hidden' name='PARTYID' id='PARTYID' value='{$PARTYID}'/>
										  <input type='hidden' name='LABOURID' id='LABOURID' value='{$LABOURID}'/>
										  <input type='hidden' name='ENTRYDATE' id='ENTRYDATE' value='{$ENTRYDATE}'/>
										  <input type='hidden' name='LOTNO' id='LOTNO' value='{$LOTNO}'/>
										  <input type='submit' name='InsertAluUnloadInfo' value='Insert' class='FormSubmitBtn' />
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