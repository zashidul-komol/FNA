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
	$PARTYID 			= $_REQUEST['PARTYID'];
	$ENTRYDATE_FROM 	= showDateMySQlFormat($_REQUEST['ENTRYDATE']);
	$ENTRYDATE_TO 		= showDateMySQlFormat($_REQUEST['ENTRYDATE2']);
	$userId 			= $_REQUEST['userId'];
	$con = '';
	
	
	//Ministry/Division and Project/Programme Name View Report Start	
	
	if ($PARTYID == 'All'){
		$con = '';
	}else{
		$con = "AND PARTYID='".$PARTYID."' ";
	}
	
		if($PARTYID == 'All'){
			$PARTYNAME = 'All Party.';
			$FATHERNAME = '';
			$ADDRESS = '';
			$MOBILE = '';
		}else{
			$partySql 	= "
							SELECT PARTYNAME, FATHERNAME, ADDRESS, MOBILE											
							FROM fna_party 
							WHERE 1=1
							{$con}
						";
			$partySqlStatement				= mysql_query($partySql);
			while($partySqlStatementData	= mysql_fetch_array($partySqlStatement)){
				$PARTYNAME        		= $partySqlStatementData["PARTYNAME"];
				$FATHERNAME       		= $partySqlStatementData["FATHERNAME"];
				$ADDRESS       		= $partySqlStatementData["ADDRESS"];
				$MOBILE       			= $partySqlStatementData["MOBILE"];
			}
		}
		
			
	 	$projectSql 	= "
							SELECT PROJECTNAME											
							FROM fna_project 
							WHERE PROJECTID = '".$PROJECTID."'
							
						";
			$projectSqlStatement				= mysql_query($projectSql);
			while($projectSqlStatementData		= mysql_fetch_array($projectSqlStatement)){
				$PROJECTNAME       				= $projectSqlStatementData["PROJECTNAME"];
				
			}
			
			//Ministry/Division and Project/Programme Name View Report End
			
	$tableView = "";	
	$tableView .="<table width='90%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:85%; border: 1px dotted #000'>

					  <tr>
                            <td style='text-align:right;' colspan='13'>
                            <a href='javascript:Clickheretoprint()'><img border='0' src='images/print_icon.jpg' width='40' height='26' /></a>                        
                            </td>
                     </tr>
					  <tr>
						<td colspan='13' align='center' valign='middle' style='border: 1px dotted #000'>
							<center><b><font size=5>F N A Group Of Company</font></b></center>
							<center>&nbsp;</center>
							<center><b><font size=3>Basta Loan Summary Report</FONT></b></center>
							<center>&nbsp;</center>
							<center><b><font size=2>Date : $ENTRYDATE_FROM to $ENTRYDATE_TO </font></b></center>
						</td>
					  </tr> 
					  <tr>

						<td colspan='13' align='left' valign='top'>
							<table width='100%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:100%;'>
								  <tr style='font-weight:bold;'>
								
									<td width='14%' align='left' valign='top'>Project Name <b></td>
									<td width='1%' align='center' valign='top'>:</td>
									<td width='34%' align='left' valign='top'>$PROJECTNAME  </td>
									
								  </tr>
								
								  <tr>
								
									<td align='left' valign='top'>Party Name</td>
									<td align='center' valign='top'>:</td>
								
									<td align='left' valign='top'> $PARTYNAME </td>
									<td align='right' valign='top'>&nbsp;</td>
									
								  </tr>
								
								  <tr>
								
									<td align='left' valign='top'>Address</td>
									<td align='center' valign='top'>:</td>
								
									<td align='left' valign='top'>$ADDRESS </td>
									<td align='right' valign='top'>&nbsp;</td>
									
								  </tr>
								
								  <tr>
								
									<td align='left' valign='top'>Mobile</td>
									<td align='center' valign='top'>:</td>
								
									<td align='left' valign='top'>$MOBILE </td>
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

						<td align='center' valign='top' style='font-weight:bold;border: 1px dotted #000'>SL</td>

						<td align='center' valign='top'  style='border: 1px dotted #000'>Party Name</td>
						
						<td align='center' valign='top'  style='border: 1px dotted #000'>LOT No.</td>
						
						<td align='center' valign='top'  style='border: 1px dotted #000'>Basta Qnty</td>
						
						<td align='center' valign='top'  style='border: 1px dotted #000'>Unit Price</td>
						
						<td align='center' valign='top' style='border: 1px dotted #000'>Sell Price</td>
						
						<td align='center' valign='top' style='border: 1px dotted #000'>Receive Amount</td>
						
						<td align='center' valign='top' style='border: 1px dotted #000'>Balance Amount</td>

					</tr>";

// Query here.

								
								$PartyStatementQuery 	= "SELECT distinct LOTNO
																FROM fna_basta  
																WHERE ENTRYDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
																{$con}
																ORDER BY LOTNO ASC
															"; 
								$PartyStatementQueryStatement				= mysql_query($PartyStatementQuery);
								$i = 0;
								while($PartyStatementQueryStatementData		= mysql_fetch_array($PartyStatementQueryStatement)){	
									$LOTNO_ARRAY[] 						= $PartyStatementQueryStatementData['LOTNO'];
									$i++;
								}
								/*
								echo "SELECT distinct LOTNO
																FROM fna_basta  
																WHERE ENTRYDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
																{$con}
																ORDER BY LOTNO ASC";
																
								die();
								*/
								$LOTNO_ARRAY_UNIQUE = array_unique($LOTNO_ARRAY);
								$sl = 1;
								$Total_SELLQNTY = 0;
										$Total_SELLPRICE = 0;
										$Total_RECEIVEDAMOUNT = 0;
										$Total_BalanceAmount	= 0;	
								foreach($LOTNO_ARRAY_UNIQUE as $individualLotNo){
									
									
									$BastaLoanViewQuery 	= "SELECT 
																PARTYID,
																LOTNO,
																UNITPRICE,
																sum(SELLQNTY) as SELLQNTY,
																sum(SELLPRICE) as SELLPRICE,
																sum(RECEIVEDAMOUNT) as RECEIVEDAMOUNT
														FROM 
															fna_basta 
														WHERE ENTRYDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
														{$con}
														AND LOTNO = '".$individualLotNo."'
														";
										$BastaLoanViewQueryStatement				= mysql_query($BastaLoanViewQuery);
										
										while($BastaLoanViewQueryStatementData	= mysql_fetch_array($BastaLoanViewQueryStatement)){ 
										
										 $PARTYID_NEW  							= $BastaLoanViewQueryStatementData["PARTYID"]; 
										 $LOTNO      							= $BastaLoanViewQueryStatementData["LOTNO"];
										 $UNITPRICE    							= $BastaLoanViewQueryStatementData["UNITPRICE"];
										 $SELLQNTY     							= $BastaLoanViewQueryStatementData["SELLQNTY"];
										 $SELLPRICE    							= $BastaLoanViewQueryStatementData["SELLPRICE"];
										 $RECEIVEDAMOUNT						= $BastaLoanViewQueryStatementData["RECEIVEDAMOUNT"];
										 
										}
										
										$Total_SELLQNTY = $Total_SELLQNTY + $SELLQNTY ; 
										$Total_SELLPRICE = $Total_SELLPRICE + $SELLPRICE ; 
										$Total_RECEIVEDAMOUNT = $Total_RECEIVEDAMOUNT + $RECEIVEDAMOUNT ; 
										
										$BalanceAmount		= $SELLPRICE - $RECEIVEDAMOUNT ; 
										
										$Total_BalanceAmount = $Total_BalanceAmount + $BalanceAmount ; 
										
									$partyNameSql 	= "SELECT PARTYNAME											
															FROM fna_party 
															WHERE PARTYID = '".$PARTYID_NEW."'
															
														";
											$partyNameSqlStatement					= mysql_query($partyNameSql);
											while($partyNameSqlStatementData		= mysql_fetch_array($partyNameSqlStatement)){
												$PARTYNAME_NEW     					= $partyNameSqlStatementData["PARTYNAME"];
												
											}	
										
									if($SELLQNTY != '0' and $SELLPRICE !='0'){
									$tableView .=" <tr>
														<td align='center' valign='top' width='5%' style='border: 1px dotted #000'>$sl</td>
			
														<td align='center' valign='top' width='35%'  style='border: 1px dotted #000'> $PARTYNAME_NEW</td>
														
														<td align='center' valign='top' width='10%' style='border: 1px dotted #000'>$LOTNO</td>
														
														<td align='center' valign='top' width='10%' style='border: 1px dotted #000'>$SELLQNTY</td>
														
														<td align='center' valign='top' width='10%' style='border: 1px dotted #000'>$UNITPRICE</td>
								
														<td align='right' valign='top' width='10%' style='border: 1px dotted #000'>$SELLPRICE</td>
														
														<td align='right' valign='top' width='10%' style='border: 1px dotted #000'>$RECEIVEDAMOUNT</td>
														
														<td align='right' valign='top' width='10%' style='border: 1px dotted #000'>$BalanceAmount</td>
								
													</tr>
			
												 ";
									
											// Dynamic Row End		  
								$sl++;
									}
									
								}
							

							$tableView .="		
											<tr style='font-weight:bold;'>
					
												<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
												
												<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
												
												<td align='center' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
												
												<td align='center' valign='top' style='border: 1px dotted #000'>$Total_SELLQNTY</td>
					
												<td align='right' valign='top'  style='border: 1px dotted #000'>&nbsp;</td>
					
												<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Total_SELLPRICE,2)."</td>
					
												<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Total_RECEIVEDAMOUNT,2)."</td>
												
												<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Total_BalanceAmount,2)."</td>
					
											</tr>
											<tr>
					
												<td colspan='13' align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
					
											</tr>
											
											<tr>
					
												<td colspan='13' align='left' valign='top'>&nbsp;</td>
					
											</tr>
											<tr>

												<td colspan='13' align='center' valign='top' >
													<table width='50%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:100%;'>
													  <tr style='background-color:lightgrey'>
														<td align='right' width='50%' style='border: 1px dotted #000'><b>Total Basta Quantity :</b></td>
														<td align='right' width='5%' style='border: 1px dotted #000'>$Total_SELLQNTY</td>
														<td width='45%' style='border: 1px dotted #000'><b>&nbsp;</b></td> 
													  </tr>
													  <tr>
														<td align='right' width='50%' style='border: 1px dotted #000'>Total Basta Loan Amount :</td>
														<td align='right' width='5%' style='border: 1px dotted #000'>".number_format($Total_SELLPRICE,2)."</td>
														<td width='45%' style='border: 1px dotted #000'>&nbsp;</td>
													  </tr>
													  <tr>
														<td align='right' width='50%' style='border: 1px dotted #000'>Total Receive Amount :</td>
														<td align='right' width='5%' style='border: 1px dotted #000'>".number_format($Total_RECEIVEDAMOUNT,2)."</td>
														<td width='45%' style='border: 1px dotted #000'>&nbsp;</td>
													  </tr>
													  <tr>
														<td align='right' width='50%' style='border: 1px dotted #000'>Basta Loan Balance :</td>
														<td align='right' width='5%' style='border: 1px dotted #000'>".number_format($Total_BalanceAmount,2)."</td>
														<td width='45%' style='border: 1px dotted #000'>&nbsp;</td>
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
											<tr>
					
												<td colspan='13' align='left' valign='top' >&nbsp;</td>
					
											</tr>	
											<tr>
					
												<td colspan='13' align='left' valign='top' >
													<table width='100%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:100%;'>
													  <tr>
														<td align='right' width='34%' valign='bottom' ><hr width='200' ></td>
														<td width='33%' valign='bottom' ><hr width='200' ></td>
														<td width='33%' valign='bottom' ><hr width='200' ></td>
													  </tr>
													  <tr>
														<td align='center' valign='top'  ><b>Cashier Signature</b></td>
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