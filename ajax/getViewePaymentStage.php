<?php
	include('../config/dbinfo.inc.php');
	function showDateMySQlFormat($date){
		
			$exp = explode("-",$date);				
			$mysqlDateF = $exp[2]."-".$exp[1]."-".$exp[0];
			
			return $mysqlDateF;
	}
	function showDateFormat($date){
			
			$newDate = date("d M Y", strtotime($date));
			return $newDate;		
	}

		$packageView        		= '';
        $packageID 					= $_REQUEST['packageIdPaymentStage'];    
		$userId 					= $_REQUEST['userIdPaymentStage'];
		$pi_4 						= $_REQUEST['pi_4PaymentStage'];
		$pi_5 						= $_REQUEST['pi_5PaymentStage'];
		$pi_6 						= $_REQUEST['pi_6PaymentStage'];
		$packageName 				= $_REQUEST['packageNamePaymentStage'];

		
		$psSql	= "SELECT * FROM s_user WHERE USER_ID='".$userId."' ORDER BY USER_ID";
		$psSqlStatement		= mysql_query($psSql);
		$psSqlStatementData	= mysql_fetch_array($psSqlStatement);
		$userName       	= $psSqlStatementData["USER_NAME"];
		
	$packageClass  = '';
		
		//  Change this only	end	 Start				
$psbkdn_flag  = '';
	$psbkdnMaxIdSql	= "SELECT COUNT(*) FROM adbs_paymentstage_bkdn WHERE pId='".$packageID."'"; 
	$psbkdnMaxIdSqllStatement		= mysql_query($psbkdnMaxIdSql);
	$psbkdnMaxIdSqllStatementData	= mysql_fetch_array($psbkdnMaxIdSqllStatement);  
	$maxpsbkdn_flag      			= $psbkdnMaxIdSqllStatementData[0]; 
	
	$flagOne = 1;
	$flagOneSql	= "SELECT * FROM adbs_paymentstage_bkdn WHERE pId='".$packageID."' AND psbkdn_flag='".$flagOne."'"; 
	$flagOneSqlStatement		= mysql_query($flagOneSql);
	$flagOneSqlStatementData	= mysql_fetch_array($flagOneSqlStatement);  
	$advancePAmount      		= $flagOneSqlStatementData["psbkdn_2"]; 
	$psbkdn_2a    			    = $flagOneSqlStatementData["psbkdn_2a"];
	$psbkdn_2b   			    = $flagOneSqlStatementData["psbkdn_2b"];
	
	$advancePDate      			= $flagOneSqlStatementData["psbkdn_1"];
	$advancePDate_null = '';
	$advancePDate_date = '';
	if ($advancePDate=='0000-00-00'){
		$advancePDate_null = '';
	}
	else{$advancePDate_date = showDateFormat($flagOneSqlStatementData["psbkdn_1"]);}
	
	
	$originalPrice  = '';
	$originalPriceSql	= "SELECT * FROM adbs_contractingstage WHERE pId='".$packageID."'"; 
	$originalPriceSqlStatement		= mysql_query($originalPriceSql);
	$originalPriceSqlStatementData	= mysql_fetch_array($originalPriceSqlStatement);  
	$originalPrice 					= $originalPriceSqlStatementData["cs_11"];
	
	$packageQuery = "
								SELECT
										adbs_paymentstage_bkdn.psId,
										adbs_paymentstage_bkdn.pId,
										adbs_paymentstage_bkdn.psbkdn_1,
										adbs_paymentstage_bkdn.psbkdn_2,
										adbs_paymentstage_bkdn.psbkdn_2a,
										adbs_paymentstage_bkdn.psbkdn_2b,
										adbs_paymentstage_bkdn.psbkdn_78b,
										adbs_paymentstage_bkdn.psbkdn_3,
										adbs_paymentstage_bkdn.psbkdn_4,
										adbs_paymentstage_bkdn.psbkdn_5,
										adbs_paymentstage_bkdn.psbkdn_6,
										adbs_paymentstage_bkdn.psbkdn_7,
										adbs_paymentstage_bkdn.psbkdn_8,
										adbs_paymentstage_bkdn.psbkdn_9,
										adbs_paymentstage_bkdn.psbkdn_10,
										adbs_paymentstage_bkdn.psbkdn_12,
										adbs_paymentstage_bkdn.psbkdn_flag,

										adbs_paymentstage_bkdn.entDate
										
										
								FROM
										adbs_paymentstage_bkdn 
								WHERE adbs_paymentstage_bkdn.pId='$packageID'
								AND   adbs_paymentstage_bkdn.psbkdn_flag='$maxpsbkdn_flag'
							  ";
							  
	
	$packageView .= "<!-- Tab 3 Start -->
						<div id='tabs{$packageID}-11'>
							<div id='showResultsPaymentStage{$packageID}'>
								<table border='0' width='100%' align='left' cellspacing='1' cellpadding='2' style='font-size:90%;'>";
				$packageStatement	= mysql_query($packageQuery);
				$packageCount 		= mysql_num_rows($packageStatement);
				if($packageCount>0) {
					$packageStatement			= mysql_query($packageQuery);
					$packageStatementData	= mysql_fetch_array($packageStatement);		
										
						$psbkdn_1        				= showDateFormat($packageStatementData["psbkdn_1"]);
						$psbkdn_2    			    	= $packageStatementData["psbkdn_2"];
						$psbkdn_78b   			    	= $packageStatementData["psbkdn_78b"];
						$psbkdn_3       				= $packageStatementData["psbkdn_3"];

						
						$psbkdn_4		  				= $packageStatementData["psbkdn_4"];
						$psbkdn_4_null = '';
						$psbkdn_4_date = '';
						if ($psbkdn_4=='0000-00-00'){
							$psbkdn_4_null = '';
						}
						else{$psbkdn_4_date = showDateFormat($packageStatementData["psbkdn_4"]);}
						
						$psbkdn_5		  				= $packageStatementData["psbkdn_5"];
						$psbkdn_5_null = '';
						$psbkdn_5_date = '';
						if ($psbkdn_5=='0000-00-00'){
							$psbkdn_5_null = '';
						}
						else{$psbkdn_5_date = showDateFormat($packageStatementData["psbkdn_5"]);}
						
						
						$psbkdn_7       				= $packageStatementData["psbkdn_7"];
						$psbkdn_8        				= $packageStatementData["psbkdn_8"];
						$psbkdn_9    			    	= $packageStatementData["psbkdn_9"];
						$psbkdn_10       				= $packageStatementData["psbkdn_10"];
						$psbkdn_11       				= $originalPrice - $psbkdn_8;
						$psbkdn_12        				= $packageStatementData["psbkdn_12"];
						$entDateps       				= showDateFormat($packageStatementData["entDate"]);
					
						$psbkdn_6		  				= $packageStatementData["psbkdn_6"];
						$psbkdn_6_null = '';
						$psbkdn_6_date = '';
						if ($psbkdn_6=='0000-00-00'){
							$psbkdn_6_null = '';
						}
						else{$psbkdn_6_date = showDateFormat($packageStatementData["psbkdn_6"]);}
						
						$packageView .= "
										<tr class='$packageClass'>
											<td colspan='5' style='text-align:left;background:#ffffff;'>
												<p style='font-size:17px;'>Payments Stage:</p>	
											</td>
                                             
											<td colspan='2' style='text-align:right;background:#ffffff;padding-left: 23%;'>
												<table style='text-align:right;background:#ffffff;'><tr>
													<td style='text-align:right;background:#ffffff;'>
													
													<script  type='text/javascript'>		
															$(document).ready(function() {			
																$('#viewPaymentStage{$packageID}').click(function(){					
																	var packageIdPaymentStage 				= $('#packageIdPaymentStage{$packageID}').val();
																	var userIdPaymentStage					= $('#userIdPaymentStage{$packageID}').val();	
																	var pi_4PaymentStage					= $('#pi_4PaymentStage{$packageID}').val();	
																	var pi_5PaymentStage					= $('#pi_5PaymentStage{$packageID}').val();	
																	var pi_6PaymentStage					= $('#pi_6PaymentStage{$packageID}').val();	
																	var packageNamePaymentStage				= $('#packageNamePaymentStage{$packageID}').val();																							
																$('#viewPaymentStage{$packageID}').html();																	
																	$.post('ajax/getViewePaymentStage.php',{'packageIdPaymentStage': packageIdPaymentStage, 'userIdPaymentStage': userIdPaymentStage, 'pi_4PaymentStage': pi_4PaymentStage,'pi_5PaymentStage': pi_5PaymentStage, 'pi_6PaymentStage': pi_6PaymentStage, 'packageNamePaymentStage':packageNamePaymentStage},
																	function(data)
																	{  	
																		$('#showResultsPaymentStage{$packageID}').html(data);
																	});
																})				 
															});		
													</script>
													
													<form method='post'>					
														<input type='hidden' name='packageIdPaymentStage' id='packageIdPaymentStage{$packageID}' value='$packageID' />
														<input type='hidden' name='userIdPaymentStage' id='userIdPaymentStage{$packageID}' value='$userId' />
														<input type='hidden' name='pi_4PaymentStage' id='pi_4PaymentStage{$packageID}' value='$pi_4' />
														<input type='hidden' name='pi_5PaymentStage' id='pi_5PaymentStage{$packageID}' value='$pi_5' />
														<input type='hidden' name='pi_6PaymentStage' id='pi_6PaymentStage{$packageID}' value='$pi_6' />
														<input type='hidden' name='packageNamePaymentStage' id='packageNamePaymentStage{$packageID}' value='$packageName' />
														<input type='button' name='viewPaymentStage{$packageID}' id='viewPaymentStage{$packageID}' value='Refresh' class='FormSubmitBtn' />	
													</form>		
													</td>
													<td style='text-align:right;background:#ffffff;'>
													<form action='paymentStageEdit.php' method='post' target='_blank'>
														<input type='hidden' name='pi_4' value='$pi_4'/>
														<input type='hidden' name='pi_5' value='$pi_5'/>
														<input type='hidden' name='pi_6' value='$pi_6'/>
														<input type='hidden' name='packageId' value='$packageID'/>
														<input type='hidden' name='packageName' value='$packageName'/>
														<input type='submit' name='editSubmitPaymentStage'  value='Update Info'/>
													</form>
													</td>
												</tr>
												</table>
												
											</td>
										</tr>
										
										<tr style='background:#DDDDDD;'>
											<td>1.</td><td style='text-align:left;width:30%;padding-left:5px;'>Contractual Advance Payment Date (Cheque Date), if any: </td><td style='width: 18%;text-align:left;padding-left:5px;'> $advancePDate_null $advancePDate_date</td><td style='background:#ffffff;'></td>
											<td>2.</td><td style='text-align:left;width:30%;padding-left:5px;'>Contractual Advance Payment Amount(Equiv. US$),if any:</td><td style='width: 18%;text-align:left;padding-left:5px;'>".number_format($advancePAmount,2)."</td>	
										</tr>
										
										<tr style='background:#eeeeee;'>
											<td>3.</td><td style='text-align:left;width:30%;padding-left:5px;'>Advance Payment amount (in contract currency or currencies):</td><td style='width: 18%;text-align:left;padding-left:5px;'> $psbkdn_2a</td><td style=' background:#ffffff;'></td>
											<td>4.</td><td style='text-align:left;width:30%;padding-left:5px;'>Remaining Advance Amount after Adjustment in Last IPC payment(equiv. US$):</td><td style='width: 18%;text-align:left;padding-left:5px;'>$psbkdn_2b</td>
										</tr>
                                        
                                        <tr style='background:#ffffff;'>
											<td></td><td style='text-align:left;width:30%;padding-left:5px;'>&nbsp;  </td><td style='width: 18%;text-align:left;padding-left:5px;'>&nbsp;  </td><td style='background:#ffffff;'></td>
											<td></td><td style='text-align:left;width:30%;padding-left:5px;'>&nbsp;  </td><td style='width: 18%;text-align:left;padding-left:5px;'>&nbsp;  </td>	
										</tr>
                                        
                                        <tr style='background:#eeeeee;'>
											<td>5.</td><td style='text-align:left;width:30%;padding-left:5px;'>ADB Financing (percentage):</td><td style='width: 18%;text-align:left;padding-left:5px;'> $psbkdn_78b</td><td style=' background:#ffffff;'></td>
											<td>10.</td><td style='text-align:left;width:30%;padding-left:5px;'>Cumulative Total Amount Certified & Paid up to Last IPC (In contract currency or currencies):</td><td style='width: 18%;text-align:left;padding-left:5px;'>$psbkdn_7</td>
		
										</tr>
										
										<tr style='background:#DDDDDD;'>
											<td>6.</td><td style='text-align:left;width:30%;padding-left:5px;'>Last Interim Payment Date (Cheque Date):</td><td style='width: 18%;text-align:left;padding-left:5px;'>$psbkdn_6_null $psbkdn_6_date</td><td style=' background:#ffffff;'></td>
											<td>11.</td><td style='text-align:left;width:30%;padding-left:5px;'>Cumulative Total Amount Certified & Paid up to Last IPC (Equiv. US$):</td><td style='width: 18%;text-align:left;padding-left:5px;'>".number_format($psbkdn_8,2)."</td>
											
										</tr>
										
										<tr style='background:#eeeeee;'>
											<td>7.</td><td style='text-align:left;width:30%;padding-left:5px;'>Last IPCSubmissionDate:</td><td style='width: 18%;text-align:left;padding-left:5px;'>$psbkdn_4_null $psbkdn_4_date</td><td style=' background:#ffffff;'></td>
											<td>12.</td><td style='text-align:left;width:30%;padding-left:5px;'>Cumulative Total ADB Financing Amount up to last  IPC (Equiv. US$):</td><td style='width: 18%;text-align:left;padding-left:5px;'>$psbkdn_2b</td>
										</tr>
										
										<tr style='background:#DDDDDD;'>
											<td>8.</td><td style='text-align:left;width:30%;padding-left:5px;'>Last IPC Certification / AcceptanceDate (by Employer/ Purchaser):</td><td style='width: 18%;text-align:left;padding-left:5px;'>$psbkdn_5_null $psbkdn_5_date</td><td style=' background:#ffffff;'></td>
											<td>13.</td><td style='text-align:left;width:30%;padding-left:5px;'>Cumulative Total Amount (up to Last IPC)Imposed on Employer for Late Payment (Equiv. US$) :</td><td style='width: 18%;text-align:left;padding-left:5px;'>".number_format($psbkdn_9,2)."</td>
										</tr>
										
										<tr style='background:#eeeeee;'>
											<td>9.</td><td style='text-align:left;width:30%;padding-left:5px;'>Last Interim Payment Claim(IPC) No.:</td><td style='width: 18%;text-align:left;padding-left:5px;'>$psbkdn_3</td><td style=' background:#ffffff;'></td>
											<td>14.</td><td style='text-align:left;width:30%;padding-left:5px;'>Cumulative Total Liquidated Damage(up to Last IPC) imposed on Supplier/ Contractor (Equiv. US$):</td><td style='width: 18%;text-align:left;padding-left:5px;'>".number_format($psbkdn_10,2)."</td>																						
																			
										</tr>
                                        
                                        <tr style='background:#ffffff;'>
											<td></td><td style='text-align:left;width:30%;padding-left:5px;'>&nbsp;  </td><td style='width: 18%;text-align:left;padding-left:5px;'>&nbsp;  </td><td style='background:#ffffff;'></td>
											<td></td><td style='text-align:left;width:30%;padding-left:5px;'>&nbsp;  </td><td style='width: 18%;text-align:left;padding-left:5px;'>&nbsp;  </td>	
										</tr>
                                        
                                        <tr style='background:#DDDDDD;'>
											<td>15.</td><td style='text-align:left;width:30%;padding-left:5px;'>Remaining Contract Amount after Certified Last IPC (equiv. US$):</td><td style='width: 18%;text-align:left;padding-left:5px;'>".number_format($psbkdn_11,2)."</td><td style=' background:#ffffff;'></td>
											<td></td><td style='text-align:left;width:30%;padding-left:5px;'></td><td style='width: 18%;text-align:left;padding-left:5px;'></td>																						
										</tr>


										<tr style='background:#ffffff;'>
											<td></td><td style='text-align:left;width:30%;padding-left:5px;'> &nbsp; </td><td style='width: 18%;text-align:left;padding-left:5px;'> &nbsp; </td><td style='background:#ffffff;'></td>
											<td></td><td style='text-align:left;width:30%;padding-left:5px;'> &nbsp; </td><td style='width: 18%;text-align:left;padding-left:5px;'> &nbsp; </td>	
										</tr>										
										<tr style='background:#ffffff;'>
											<td style='text-align:left;width:100%;padding-left:5px;font-size:12px;' colspan='7'><center>Last Updated: <b>$entDateps</b>, Updated By: <b>$userName</b></center></td>
										</tr>															
										";					
		
					
				} else {
					$packageView .= "
									<tr style='background:#F7F4F4'>
										<td colspan='2' style='text-align:center; color:red;'>&nbsp;</td>
									</tr>
									<tr style='background:#F7F4F4'>
										<td colspan='1' style='text-align:center; color:red;'><center> 
										
									<table>	
									  <tr>
										<td>
										<form action='paymentStage.php' method='post' target='_blank'>
										<input type='hidden' name='pi_4' id='pi_4' value='$pi_4' />
										<input type='hidden' name='pi_5' id='pi_5' value='$pi_5' />
										<input type='hidden' name='pi_6' id='pi_6' value='$pi_6' />
										<input type='hidden' name='pi_4' value='$pi_4'/>
										<input type='hidden' name='pi_6' value='$pi_6'/>
										<input type='hidden' name='packageId' value='$packageID'/>
										<input type='hidden' name='packageName' value='$packageName'/>
										<input type='submit' name='submitPaymentStage'  value='No Data Found Insert New Data'/>
										</form>
										</td>
										<td>
                                      <script  type='text/javascript'>		
															$(document).ready(function() {			
																$('#viewPaymentStage{$packageID}').click(function(){					
																	var packageIdPaymentStage 				= $('#packageIdPaymentStage{$packageID}').val();
																	var userIdPaymentStage					= $('#userIdPaymentStage{$packageID}').val();	
																	var pi_4PaymentStage					= $('#pi_4PaymentStage{$packageID}').val();	
																	var pi_5PaymentStage					= $('#pi_5PaymentStage{$packageID}').val();	
																	var pi_6PaymentStage					= $('#pi_6PaymentStage{$packageID}').val();	
																	var packageNamePaymentStage				= $('#packageNamePaymentStage{$packageID}').val();																							
																$('#viewPaymentStage{$packageID}').html();																	
																	$.post('ajax/getViewePaymentStage.php',{'packageIdPaymentStage': packageIdPaymentStage, 'userIdPaymentStage': userIdPaymentStage, 'pi_4PaymentStage': pi_4PaymentStage,'pi_5PaymentStage': pi_5PaymentStage, 'pi_6PaymentStage': pi_6PaymentStage, 'packageNamePaymentStage':packageNamePaymentStage},
																	function(data)
																	{  	
																		$('#showResultsPaymentStage{$packageID}').html(data);
																	});
																})				 
															});		
													</script>
													
													<form method='post'>					
														<input type='hidden' name='packageIdPaymentStage' id='packageIdPaymentStage{$packageID}' value='$packageID' />
														<input type='hidden' name='userIdPaymentStage' id='userIdPaymentStage{$packageID}' value='$userId' />
														<input type='hidden' name='pi_4PaymentStage' id='pi_4PaymentStage{$packageID}' value='$pi_4' />
														<input type='hidden' name='pi_5PaymentStage' id='pi_5PaymentStage{$packageID}' value='$pi_5' />
														<input type='hidden' name='pi_6PaymentStage' id='pi_6PaymentStage{$packageID}' value='$pi_6' />
														<input type='hidden' name='packageNamePaymentStage' id='packageNamePaymentStage{$packageID}' value='$packageName' />
														<input type='button' name='viewPaymentStage{$packageID}' id='viewPaymentStage{$packageID}' value='Refresh' class='FormSubmitBtn' />	
													</form>				
										</td>
									  </tr>
									</table>
												
									</center></td>
							</tr>";
				}
				$packageView .= "</table> 
			";	
									
								
	echo 	$packageView ;
?>
