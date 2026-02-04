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
        $packageID 					= $_REQUEST['packageIdContractConcludingStage'];    
		$userId 					= $_REQUEST['userIdContractConcludingStage'];
		$pi_4 						= $_REQUEST['pi_4ContractConcludingStage'];
		$pi_5 						= $_REQUEST['pi_5ContractConcludingStage'];
		$pi_6 						= $_REQUEST['pi_6ContractConcludingStage'];
		$packageName 				= $_REQUEST['packageNameContractConcludingStage'];

		
		$psSql	= "SELECT * FROM s_user WHERE USER_ID='".$userId."' ORDER BY USER_ID";
		$psSqlStatement		= mysql_query($psSql);
		$psSqlStatementData	= mysql_fetch_array($psSqlStatement);
		$userName       	= $psSqlStatementData["USER_NAME"];
		
		//  Change this only	end	 Start				
		$packageQuery = "
								SELECT
										adbs_contractconcludingstage.ccs_76,
										adbs_contractconcludingstage.ccs_77,
										adbs_contractconcludingstage.ccs_78,
										adbs_contractconcludingstage.ccs_79,
										adbs_contractconcludingstage.ccs_80,
										adbs_contractconcludingstage.ccs_110,
										adbs_contractconcludingstage.ccs_111,
										adbs_contractconcludingstage.entDate
								FROM
										adbs_contractconcludingstage
								WHERE
										adbs_contractconcludingstage.pId='$packageID'
								ORDER BY
										adbs_contractconcludingstage.ccsId
							  ";	
	
		$packageView .= " <!-- Tab 9 Start -->
                            <div id='tabs{$packageID}-9'>
								<div id='showResultsContractConcludingStage{$packageID}'>
									<table border='0' width='100%' align='left' cellspacing='1' cellpadding='2' style='font-size:90%;'>";
				$packageStatement	= mysql_query($packageQuery);
				$packageCount 		= mysql_num_rows($packageStatement);
				if($packageCount>0) {
					$mv 						= 1;
					$packageStatement			= mysql_query($packageQuery);
					while($packageStatementData	= mysql_fetch_array($packageStatement)) {
						if($mv%2==0) {
							$packageClass="evenRow";
						} else {
							$packageClass="oddRow";
						}
						$ccs_76         = $packageStatementData["ccs_76"];
						$ccs_76_null = '';
						$ccs_76_date = '';
						if ($ccs_76=='0000-00-00'){
							$ccs_76_null = '';
						}
						else{$ccs_76_date = showDateFormat($packageStatementData["ccs_76"]);}
						
						$ccs_77         = $packageStatementData["ccs_77"];
						$ccs_77_null = '';
						$ccs_77_date = '';
						if ($ccs_77=='0000-00-00'){
							$ccs_77_null = '';
						}
						else{$ccs_77_date = showDateFormat($packageStatementData["ccs_77"]);}
						
						$ccs_78		 = $packageStatementData["ccs_78"];
						$ccs_79         = $packageStatementData["ccs_79"];
						$ccs_80         = $packageStatementData["ccs_80"];
						$ccs_110         = $packageStatementData["ccs_110"];
						$ccs_111		 = $packageStatementData["ccs_111"];
						$entDateccs  = showDateFormat($packageStatementData["entDate"]);
						
						$packageView .= "
										<tr class='$packageClass'>
										<td colspan='5' style='text-align:left;background:#ffffff;'>
												<p style='font-size:17px;'>Contract Concluding Stage:</p>	
											</td>
											<td colspan='2' style='text-align:right;background:#ffffff;padding-left:24%;'>
											
											<table style='text-align:right;background:#ffffff;'><tr>
													<td style='text-align:right;background:#ffffff;'>
													
													<script  type='text/javascript'>		
															$(document).ready(function() {			
																$('#viewContractConcludingStage{$packageID}').click(function(){					
																	var packageIdContractConcludingStage 				= $('#packageIdContractConcludingStage{$packageID}').val();
																	var userIdContractConcludingStage					= $('#userIdContractConcludingStage{$packageID}').val();	
																	var pi_4ContractConcludingStage						= $('#pi_4ContractConcludingStage{$packageID}').val();
																	var pi_5ContractConcludingStage						= $('#pi_5ContractConcludingStage{$packageID}').val();	
																	var pi_6ContractConcludingStage						= $('#pi_6ContractConcludingStage{$packageID}').val();	
																	var packageNameContractConcludingStage				= $('#packageNameContractConcludingStage{$packageID}').val();																							
																$('#viewContractConcludingStage{$packageID}').html();																	
																	$.post('ajax/getVieweContractConcludingStage.php',{'packageIdContractConcludingStage': packageIdContractConcludingStage, 'userIdContractConcludingStage': userIdContractConcludingStage, 'pi_4ContractConcludingStage': pi_4ContractConcludingStage,'pi_5ContractConcludingStage': pi_5ContractConcludingStage, 'pi_6ContractConcludingStage': pi_6ContractConcludingStage, 'packageNameContractConcludingStage':packageNameContractConcludingStage},
																	function(data)
																	{  	
																		$('#showResultsContractConcludingStage{$packageID}').html(data);
																	});
																})				 
															});		
													</script>
													
													<form method='post'>					
														<input type='hidden' name='packageIdContractConcludingStage' id='packageIdContractConcludingStage{$packageID}' value='$packageID' />
														<input type='hidden' name='userIdContractConcludingStage' id='userIdContractConcludingStage{$packageID}' value='$userId' />
														<input type='hidden' name='pi_4ContractConcludingStage' id='pi_4ContractConcludingStage{$packageID}' value='$pi_4' />
														<input type='hidden' name='pi_5ContractConcludingStage' id='pi_5ContractConcludingStage{$packageID}' value='$pi_5' />
														<input type='hidden' name='pi_6ContractConcludingStage' id='pi_6ContractConcludingStage{$packageID}' value='$pi_6' />
														<input type='hidden' name='packageNameContractConcludingStage' id='packageNameContractConcludingStage{$packageID}' value='$packageName' />
														<input type='button' name='viewContractConcludingStage{$packageID}' id='viewContractConcludingStage{$packageID}' value='Refresh' class='FormSubmitBtn' />	
													</form>		
													</td>
													<td style='text-align:right;background:#ffffff;'>
													<form action='contractConcludingStageEdit.php' method='post' target='_blank'>
														<input type='hidden' name='pi_4' value='$pi_4'/>
														<input type='hidden' name='pi_5' value='$pi_5'/>
														<input type='hidden' name='pi_6' value='$pi_6'/>
														<input type='hidden' name='packageId' value='$packageID'/>
														<input type='hidden' name='packageName' value='$packageName'/>
														<input type='submit' name='editSubmitContractConcludingStage'  value='Update Info'/>
													</form>
													</td>
												</tr>
												</table>

											</td>
										</tr>
										

										<tr style='background:#DDDDDD;'>
											<td>1.</td><td style='text-align:left;width:35%;padding-left:5px;'> Amounts Paid for Late Payment (Equiv. US$) :</td><td style='width: 13%;text-align:left;padding-left:5px;'>".number_format($ccs_79,2)."</td><td style=' background:#ffffff;'></td>
											<td>2.</td><td style='text-align:left;width:35%;padding-left:5px;'> LDs imposed on Supplier/ Contractor/ Consultant (Equiv. US$) :</td><td style='width: 13%;text-align:left;padding-left:5px;'>".number_format($ccs_80,2)."</td>
										</tr>
								
										<tr style='background:#ffffff;'>
											<td></td><td style='text-align:left;width:35%;padding-left:5px;'> &nbsp; </td><td style='width: 13%;text-align:left;padding-left:5px;'> &nbsp; </td><td style=' background:#ffffff;'></td>
											<td></td><td style='text-align:left;width:35%;padding-left:5px;'> &nbsp; </td><td style='width: 13%;text-align:left;padding-left:5px;'> &nbsp; </td>
										</tr>	
										<tr style='background:#ffffff;'>
											<td style='text-align:left;width:100%;padding-left:5px;font-size:12px;' colspan='7'><center>Last Updated: <b>$entDateccs</b>, Updated By: <b>$userName</b></center></td>
										</tr>
																
										";
						$mv++;
						
					}
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
										<form action='contractConcludingStage.php' method='post' target='_blank'>
										<input type='hidden' name='packageId' value='$packageID'/>
										<input type='hidden' name='packageName' value='$packageName'/>
										<input type='submit' name='contractConcludingStageSubmit'  value='No Data Found Insert New Data'/>
										</form>
										</td>
										<td>
                                      	
											<script  type='text/javascript'>		
															$(document).ready(function() {			
																$('#viewContractConcludingStage{$packageID}').click(function(){					
																	var packageIdContractConcludingStage 				= $('#packageIdContractConcludingStage{$packageID}').val();
																	var userIdContractConcludingStage					= $('#userIdContractConcludingStage{$packageID}').val();	
																	var pi_4ContractConcludingStage						= $('#pi_4ContractConcludingStage{$packageID}').val();	
																	var pi_6ContractConcludingStage						= $('#pi_6ContractConcludingStage{$packageID}').val();	
																	var packageNameContractConcludingStage				= $('#packageNameContractConcludingStage{$packageID}').val();																							
																$('#viewContractConcludingStage{$packageID}').html();																	
																	$.post('ajax/getVieweContractConcludingStage.php',{'packageIdContractConcludingStage': packageIdContractConcludingStage, 'userIdContractConcludingStage': userIdContractConcludingStage, 'pi_4ContractConcludingStage': pi_4ContractConcludingStage, 'pi_6ContractConcludingStage': pi_6ContractConcludingStage, 'packageNameContractConcludingStage':packageNameContractConcludingStage},
																	function(data)
																	{  	
																		$('#showResultsContractConcludingStage{$packageID}').html(data);
																	});
																})				 
															});		
													</script>
													
													<form method='post'>					
														<input type='hidden' name='packageIdContractConcludingStage' id='packageIdContractConcludingStage{$packageID}' value='$packageID' />
														<input type='hidden' name='userIdContractConcludingStage' id='userIdContractConcludingStage{$packageID}' value='$userId' />
														<input type='hidden' name='pi_4ContractConcludingStage' id='pi_4ContractConcludingStage{$packageID}' value='$pi_4' />
														<input type='hidden' name='pi_6ContractConcludingStage' id='pi_6ContractConcludingStage{$packageID}' value='$pi_6' />
														<input type='hidden' name='packageNameContractConcludingStage' id='packageNameContractConcludingStage{$packageID}' value='$packageName' />
														<input type='button' name='viewContractConcludingStage{$packageID}' id='viewContractConcludingStage{$packageID}' value='Refresh' class='FormSubmitBtn' />	
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
