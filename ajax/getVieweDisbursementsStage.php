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
        $packageID 					= $_REQUEST['packageIdDisbursementsStage'];    
		$userId 					= $_REQUEST['userIdDisbursementsStage'];
		$pi_4 						= $_REQUEST['pi_4DisbursementsStage'];
		$pi_5 						= $_REQUEST['pi_5DisbursementsStage'];
		$pi_6 						= $_REQUEST['pi_6DisbursementsStage'];
		$packageName 				= $_REQUEST['packageNameDisbursementsStage'];

		
		$psSql	= "SELECT * FROM s_user WHERE USER_ID='".$userId."' ORDER BY USER_ID";
		$psSqlStatement		= mysql_query($psSql);
		$psSqlStatementData	= mysql_fetch_array($psSqlStatement);
		$userName       	= $psSqlStatementData["USER_NAME"];
		$mv                 = '';
		
		//  Change this only	end	 Start				
	$psbkdnMaxIdSqlD	= "SELECT COUNT(*) FROM adbs_paymentstage_bkdn WHERE pId='".$packageID."'"; 
	$psbkdnMaxIdSqlDStatementD		= mysql_query($psbkdnMaxIdSqlD);
	$psbkdnMaxIdSqlDStatementDDataD	= mysql_fetch_array($psbkdnMaxIdSqlDStatementD);  
	$maxpsbkdn_flagD      			= $psbkdnMaxIdSqlDStatementDDataD[0]; 
	
	$flagOneSqlD	= "SELECT * FROM adbs_paymentstage_bkdn WHERE pId='".$packageID."' AND psbkdn_flag='".$maxpsbkdn_flagD."'"; 
	$flagOneSqlStatementD		= mysql_query($flagOneSqlD);
	$flagOneSqlStatementDataD	= mysql_fetch_array($flagOneSqlStatementD);  
	$advancePDateD      		= showDateFormat($flagOneSqlStatementDataD["psbkdn_1"]); 
	$advancePAmountD      		= $flagOneSqlStatementDataD["psbkdn_2"]; 
	
	
	

		
	$dpQuery = "
							SELECT
										adbs_paymentstage_bkdn.pId,
										adbs_paymentstage_bkdn.psbkdn_QuaterNo,
										adbs_paymentstage_bkdn.psbkdn_Year,
										adbs_paymentstage_bkdn.psbkdn_Actual
										
								FROM
										adbs_paymentstage_bkdn
								WHERE
										adbs_paymentstage_bkdn.pId='$packageID'
								ORDER BY
										adbs_paymentstage_bkdn.psbkdn_flag				
								LIMIT 0, 8		
								";

	$packageView .= "<!-- Tab 3 Start -->
						<div id='tabs{$packageID}-10'>
							<div id='showResultsDisbursementsStage{$packageID}'>
								<table border='0' width='100%' align='left' cellspacing='1' cellpadding='2' style='font-size:90%;'>";
				$dpQueryStatement			= mysql_query($dpQuery);
				$dpQueryStatementCount 		= mysql_num_rows($dpQueryStatement);
				if($dpQueryStatementCount>0) {
					
						  $dpQueryStatement			= mysql_query($dpQuery);
					while($dpQueryStatementData	    = mysql_fetch_array($dpQueryStatement)){	
											
					if($mv%2==0) {
							$packageClass="evenRow";
						} else {
							$packageClass="oddRow";
						}

						}
						$packageView .= "
										<tr class='$packageClass'>
											<td colspan='4' style='text-align:left;background:#ffffff;'>
												<p style='font-size:16px;'>Disbursements Stage:</p>	
											</td>
                                             
											<td colspan='1' style='text-align:right;background:#ffffff;padding-left:29%;'>
											
												<table style='text-align:right;background:#ffffff;'><tr>
													<td style='text-align:right;background:#ffffff;'>
													
													<script  type='text/javascript'>		
															$(document).ready(function() {			
																$('#viewDisbursementsStage{$packageID}').click(function(){					
																	var packageIdDisbursementsStage 			= $('#packageIdDisbursementsStage{$packageID}').val();
																	var userIdDisbursementsStage				= $('#userIdDisbursementsStage{$packageID}').val();	
																	var pi_4DisbursementsStage					= $('#pi_4DisbursementsStage{$packageID}').val();
																	var pi_5DisbursementsStage					= $('#pi_5DisbursementsStage{$packageID}').val();	
																	var pi_6DisbursementsStage					= $('#pi_6DisbursementsStage{$packageID}').val();	
																	var packageNameDisbursementsStage			= $('#packageNameDisbursementsStage{$packageID}').val();																							
																$('#viewDisbursementsStage{$packageID}').html();																	
																	$.post('ajax/getVieweDisbursementsStage.php',{'packageIdDisbursementsStage': packageIdDisbursementsStage, 'userIdDisbursementsStage': userIdDisbursementsStage, 'pi_4DisbursementsStage': pi_4DisbursementsStage,'pi_5DisbursementsStage': pi_5DisbursementsStage, 'pi_6DisbursementsStage': pi_6DisbursementsStage, 'packageNameDisbursementsStage':packageNameDisbursementsStage},
																	function(data)
																	{  	
																		$('#showResultsDisbursementsStage{$packageID}').html(data);
																	});
																})				 
															});		
													</script>
													
													<form method='post'>					
														<input type='hidden' name='packageIdDisbursementsStage' id='packageIdDisbursementsStage{$packageID}' value='$packageID' />
														<input type='hidden' name='userIdDisbursementsStage' id='userIdDisbursementsStage{$packageID}' value='$userId' />
														<input type='hidden' name='pi_4DisbursementsStage' id='pi_4DisbursementsStage{$packageID}' value='$pi_4' />
														<input type='hidden' name='pi_5DisbursementsStage' id='pi_5DisbursementsStage{$packageID}' value='$pi_5' />
														<input type='hidden' name='pi_6DisbursementsStage' id='pi_6DisbursementsStage{$packageID}' value='$pi_6' />
														<input type='hidden' name='packageNameDisbursementsStage' id='packageNameDisbursementsStage{$packageID}' value='$packageName' />
														<input type='button' name='viewDisbursementsStage{$packageID}' id='viewDisbursementsStage{$packageID}' value='Refresh' class='FormSubmitBtn' />	
													</form>		
													</td>
													<td style='text-align:right;background:#ffffff;'>
													<form action='disbursementsEdit.php' method='post' target='_blank'>
														<input type='hidden' name='pi_4' value='$pi_4'/>
														<input type='hidden' name='pi_5' value='$pi_5'/>
														<input type='hidden' name='pi_6' value='$pi_6'/>
														<input type='hidden' name='packageId' value='$packageID'/>
														<input type='hidden' name='packageName' value='$packageName'/>
														<input type='submit' name='editSubmitDisbursementsStage'  value='Update Info'/>
													</form>
													</td>
												</tr>
												</table>
											</td>
										</tr>				
										";	
					$psBkdnQuery = "
								SELECT
										adbs_disbursementproject_child.pId,
										adbs_disbursementproject_child.bpc_79h,
										adbs_disbursementproject_child.bpc_79i,
										adbs_disbursementproject_child.bpc_79j,
										adbs_disbursementproject_child.entDate
										
								FROM
										adbs_disbursementproject_child
								WHERE
										adbs_disbursementproject_child.pId='$packageID'
								ORDER BY
										adbs_disbursementproject_child.dpcId				
								LIMIT 0, 8 		
								";
							  
						$psBkdnQueryStatement			= mysql_query($psBkdnQuery);
						$paymentBkdnShow = '';
						while($packageStatementData	= mysql_fetch_array($psBkdnQueryStatement)){
							
						if($mv%2==0) {
							$packageClass="evenRow";
						} else {
							$packageClass="oddRow";
						}

							$bpc_79h        = $packageStatementData["bpc_79h"];
							$bpc_79i        = $packageStatementData["bpc_79i"];
							$bpc_79j        = $packageStatementData["bpc_79j"];
							$entDatedp      = showDateFormat($packageStatementData["entDate"]);
					
									$paymentBkdnShow .= "<tr class='$packageClass' >
															<td>{$bpc_79h}</td>
															<td>{$bpc_79i}</td>
															<td>".number_format($bpc_79j,2)."</td>
														</tr>						
															";						
						$mv++;
						}
						
						$packageView .= "
										<tr>
											<td colspan='5'>
												<table width='100%' >
												 	<tr style='background:#DDDDDD;'>
														<td style='width:33%;'>Quarter no</td>
														<td style='width:33%;'>Year</td>
														<td style='width:33%;'>Projection Amount</td>
													</tr>
													{$paymentBkdnShow}
													
												</table>
											</td>
										</tr>
													
										";					
					
				// View Actual Disbursements to Contractor / Supplier
				
					
					$psBkdnChileQuery = "
							SELECT
										adbs_paymentstage_bkdn.pId,
										adbs_paymentstage_bkdn.psbkdn_QuaterNo,
										adbs_paymentstage_bkdn.psbkdn_Year,
										adbs_paymentstage_bkdn.entDate,
										adbs_paymentstage_bkdn.psbkdn_Actual
										
								FROM
										adbs_paymentstage_bkdn
								WHERE
										adbs_paymentstage_bkdn.pId='$packageID'
								ORDER BY
										adbs_paymentstage_bkdn.psbkdn_flag				
							  ";
							  
						$psBkdnChileQueryStatement			= mysql_query($psBkdnChileQuery);
						$paymentBkdnChildShow = '';
						while($psBkdnChileQueryStatementData	= mysql_fetch_array($psBkdnChileQueryStatement)){
							
						if($mv%2==0) {
							$packageClass="evenRow";
						} else {
							$packageClass="oddRow";
						}

							$psbkdn_QuaterNo      = $psBkdnChileQueryStatementData["psbkdn_QuaterNo"]; 
							$psbkdn_Year          = $psBkdnChileQueryStatementData["psbkdn_Year"];
							$psbkdn_Actual        = $psBkdnChileQueryStatementData["psbkdn_Actual"];
							$entDatedp      	  = showDateFormat($psBkdnChileQueryStatementData["entDate"]);
						$mv++;
						}	
					
					$sqlYear = "Select distinct psbkdn_Year from adbs_paymentstage_bkdn WHERE pId='".$packageID."' order by psbkdn_Year";
					$sqlYearQuery = mysql_query($sqlYear);
					while($sqlYearQueryResult = mysql_fetch_array($sqlYearQuery)){			
						
					$sqlQuater = "Select distinct psbkdn_QuaterNo from adbs_paymentstage_bkdn WHERE pId='".$packageID."' AND psbkdn_Year='".$sqlYearQueryResult['psbkdn_Year']."' order by psbkdn_QuaterNo";
					$sqlQuaterQuery = mysql_query($sqlQuater);
					while($sqlQuaterQueryResult = mysql_fetch_array($sqlQuaterQuery)){
					$sqlAmount = "Select sum(psbkdn_Actual) from adbs_paymentstage_bkdn where psbkdn_QuaterNo='".$sqlQuaterQueryResult['psbkdn_QuaterNo']."' AND psbkdn_Year='".$sqlYearQueryResult['psbkdn_Year']."' AND pId='".$packageID."'";
					$sqlAmountQuery = mysql_query($sqlAmount);
					$sqlAmountQueryResult = mysql_fetch_array($sqlAmountQuery);
					
					$amount 		 = $sqlAmountQueryResult['sum(psbkdn_Actual)']; 
					$psbkdn_QuaterNo = $sqlQuaterQueryResult["psbkdn_QuaterNo"]; 
					$psbkdn_Year 	 = $sqlYearQueryResult["psbkdn_Year"]; 
					  
					if($psbkdn_Year != '1970') { 
					$paymentBkdnChildShow .= "<tr class='$packageClass' >
										<td>{$psbkdn_QuaterNo}</td>
										<td>{$psbkdn_Year}</td>
										<td>".number_format($amount,2)."</td>
									</tr>					
									";	
					$mv++;
					}
					} 
					}
						$packageView .= "
										<tr>
											<td colspan='5'>
												<table width='100%' >
													<tr style='background:#ffffff;'>
														<td style='width:100%;' colspan='3'><b>Actual Disbursements to Contractor / Supplier:</b></td>
													</tr>
												 	<tr style='background:#DDDDDD;'>
														<td style='width:33%;'>Quarter no</td>
														<td style='width:33%;'>Year</td>
														<td style='width:33%;'>Actual disbursement amount</td>
													</tr>
													{$paymentBkdnChildShow}
												</table>
											</td>
										</tr>
										<tr style='background:#ffffff;'>
											<td style='text-align:left;width:100%;padding-left:5px;font-size:12px;' colspan='5'><center>Last Updated: <b>$entDatedp</b>, Updated By: <b>$userName</b></center></td>
										</tr>
										";
						
						// View Disbursement Projection: 										
												
				} else {
					$packageView .= "
									<tr style='background:#F7F4F4'>
										<td colspan='2' style='text-align:center; color:red;'>&nbsp;</td>
									</tr>
									<tr style='background:#F7F4F4'>
										<td colspan='1' style='text-align:center; color:red;padding-left:25%;'> 
										
									<table>	
									  <tr>
										<td>
										<form action='disbursements.php' method='post' target='_blank'>
										<input type='hidden' name='pi_4' id='pi_4' value='$pi_4' />
										<input type='hidden' name='pi_5' id='pi_5' value='$pi_5' />
										<input type='hidden' name='pi_6' id='pi_6' value='$pi_6' />
										
										<input type='hidden' name='packageId' value='$packageID'/>
										<input type='hidden' name='packageName' value='$packageName'/>
										<input type='submit' name='disbursementsStage'  value='No Data Found Insert New Data'/>
										</form>
										</td>
										<td>
                                      	
													<script  type='text/javascript'>		
															$(document).ready(function() {			
																$('#viewDisbursementsStage{$packageID}').click(function(){					
																	var packageIdDisbursementsStage 			= $('#packageIdDisbursementsStage{$packageID}').val();
																	var userIdDisbursementsStage				= $('#userIdDisbursementsStage{$packageID}').val();	
																	var pi_4DisbursementsStage					= $('#pi_4DisbursementsStage{$packageID}').val();
																	var pi_5DisbursementsStage					= $('#pi_5DisbursementsStage{$packageID}').val();	
																	var pi_6DisbursementsStage					= $('#pi_6DisbursementsStage{$packageID}').val();	
																	var packageNameDisbursementsStage			= $('#packageNameDisbursementsStage{$packageID}').val();																							
																$('#viewDisbursementsStage{$packageID}').html();																	
																	$.post('ajax/getVieweDisbursementsStage.php',{'packageIdDisbursementsStage': packageIdDisbursementsStage, 'userIdDisbursementsStage': userIdDisbursementsStage, 'pi_4DisbursementsStage': pi_4DisbursementsStage,'pi_5DisbursementsStage': pi_5DisbursementsStage, 'pi_6DisbursementsStage': pi_6DisbursementsStage, 'packageNameDisbursementsStage':packageNameDisbursementsStage},
																	function(data)
																	{  	
																		$('#showResultsDisbursementsStage{$packageID}').html(data);
																	});
																})				 
															});		
													</script>
													
													<form method='post'>					
														<input type='hidden' name='packageIdDisbursementsStage' id='packageIdDisbursementsStage{$packageID}' value='$packageID' />
														<input type='hidden' name='userIdDisbursementsStage' id='userIdDisbursementsStage{$packageID}' value='$userId' />
														<input type='hidden' name='pi_4DisbursementsStage' id='pi_4DisbursementsStage{$packageID}' value='$pi_4' />
														<input type='hidden' name='pi_5DisbursementsStage' id='pi_5DisbursementsStage{$packageID}' value='$pi_5' />
														<input type='hidden' name='pi_6DisbursementsStage' id='pi_6DisbursementsStage{$packageID}' value='$pi_6' />
														<input type='hidden' name='packageNameDisbursementsStage' id='packageNameDisbursementsStage{$packageID}' value='$packageName' />
														<input type='button' name='viewDisbursementsStage{$packageID}' id='viewDisbursementsStage{$packageID}' value='Refresh' class='FormSubmitBtn' />	
													</form>					
										</td>
									  </tr>
									</table>
												
									</td>
							</tr>";
				}
				$packageView .= "</table>
			";									
	echo 	$packageView ;
?>
