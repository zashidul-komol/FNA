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
        $packageID 					= $_REQUEST['packageIdAwardStage'];    
		$userId 					= $_REQUEST['userIdAwardStage'];
		$pi_4 						= $_REQUEST['pi_4AwardStage'];
		$pi_5 						= $_REQUEST['pi_5AwardStage'];
		$pi_6 						= $_REQUEST['pi_6AwardStage'];
		$packageName 				= $_REQUEST['packageNameAwardStage'];

		
		$psSql	= "SELECT * FROM s_user WHERE USER_ID='".$userId."' ORDER BY USER_ID";
		$psSqlStatement		= mysql_query($psSql);
		$psSqlStatementData	= mysql_fetch_array($psSqlStatement);
		$userName       	= $psSqlStatementData["USER_NAME"];
		
		//  Change this only	end	 Start				
		$priorReviewSql	= "SELECT * FROM adbs_package WHERE pId='".$packageID."' ORDER BY 	pId";
		$priorReviewSqlStatement			= mysql_query($priorReviewSql);
		$priorReviewSqlStatementData		= mysql_fetch_array($priorReviewSqlStatement);
		$pi_18Check      			    	=  $priorReviewSqlStatementData["pi_18"]; 
	
		$packageQuery = "
								SELECT
										adbs_contractingstage.cs_63a,
										adbs_contractingstage.cs_64,
										adbs_contractingstage.cs_65,
										adbs_contractingstage.cs_66,
										adbs_contractingstage.cs_67,
										adbs_contractingstage.cs_67a,
										adbs_contractingstage.cs_68,
										adbs_contractingstage.cs_69,
										adbs_contractingstage.cs_70,
										adbs_contractingstage.cs_9,
										adbs_contractingstage.cs_11,
										adbs_contractingstage.cs_72,
										adbs_contractingstage.cs_104,
										adbs_contractingstage.cs_105,
										adbs_contractingstage.cs_106,
										adbs_contractingstage.cs_113,
										adbs_contractingstage.cs_114a,
										adbs_contractingstage.cs_72a,
										adbs_contractingstage.entDate
								FROM
										adbs_contractingstage
								WHERE
										adbs_contractingstage.pId='$packageID'
								ORDER BY
										adbs_contractingstage.csId
							  ";	
	
		$packageView .= "<!-- Tab 7 Start --> 
                            <div id='tabs{$packageID}-7'>
								<div id='showResultsAwardStage{$packageID}'>
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
						$cs_63a         = $packageStatementData["cs_63a"];
						$cs_63a_null = '';
						$cs_63a_date = '';
						if ($cs_63a=='0000-00-00'){
							$cs_63a_null = '';
						}
						else{$cs_63a_date = showDateFormat($packageStatementData["cs_63a"]);}
						
						$cs_64         = $packageStatementData["cs_64"];
						$cs_64_null = '';
						$cs_64_date = '';
						if ($cs_64=='0000-00-00'){
							$cs_64_null = '';
						}
						else{$cs_64_date = showDateFormat($packageStatementData["cs_64"]);}
						
						$cs_65         = $packageStatementData["cs_65"];
						$cs_65_null = '';
						$cs_65_date = '';
						if ($cs_65=='0000-00-00'){
							$cs_65_null = '';
						}
						else{$cs_65_date = showDateFormat($packageStatementData["cs_65"]);}
						
						$cs_66         = $packageStatementData["cs_66"];
						$cs_66_null = '';
						$cs_66_date = '';
						if ($cs_66=='0000-00-00'){
							$cs_66_null = '';
						}
						else{$cs_66_date = showDateFormat($packageStatementData["cs_66"]);}
						
						$cs_67         = $packageStatementData["cs_67"];
						$cs_67_null = '';
						$cs_67_date = '';
						if ($cs_67=='0000-00-00'){
							$cs_67_null = '';
						}
						else{$cs_67_date = showDateFormat($packageStatementData["cs_67"]);}
						
						$cs_67a         = $packageStatementData["cs_67a"];
						$cs_67a_null = '';
						$cs_67a_date = '';
						if ($cs_67a=='0000-00-00'){
							$cs_67a_null = '';
						}
						else{$cs_67a_date = showDateFormat($packageStatementData["cs_67a"]);}
						
						$cs_68         = $packageStatementData["cs_68"];
						$cs_68_null = '';
						$cs_68_date = '';
						if ($cs_68=='0000-00-00'){
							$cs_68_null = '';
						}
						else{$cs_68_date = showDateFormat($packageStatementData["cs_68"]);}
						
						$cs_69         = $packageStatementData["cs_69"];
						$cs_69_null = '';
						$cs_69_date = '';
						if ($cs_69=='0000-00-00'){
							$cs_69_null = '';
						}
						else{$cs_69_date = showDateFormat($packageStatementData["cs_69"]);}
						
						$cs_70		  = $packageStatementData["cs_70"];
						$cs_70_null = '';
						$cs_70_date = '';
						if($pi_18Check == 'Yes'){
							if ($cs_70=='0000-00-00'){
								$cs_70_null = '';
							}
							else{$cs_70_date = showDateFormat($packageStatementData["cs_70"]);}
						}else{
							$cs_70_null = 'N/A';	
						}
						$cs_9         = $packageStatementData["cs_9"];
						$cs_11         = $packageStatementData["cs_11"];
						
						$cs_72		  = $packageStatementData["cs_72"];
						$cs_72_null = '';
						$cs_72_date = '';
						if ($cs_72=='0000-00-00'){
							$cs_72_null = '';
						}
						else{$cs_72_date = showDateFormat($packageStatementData["cs_72"]);}
						
						$cs_104		  = $packageStatementData["cs_104"];
						$cs_105        = $packageStatementData["cs_105"];
						$cs_106       = $packageStatementData["cs_106"];
						$cs_113		  = $packageStatementData["cs_113"];
						$cs_114a		  = $packageStatementData["cs_114a"];
						$cs_72a		  = $packageStatementData["cs_72a"];
						$entDatecs    = showDateFormat($packageStatementData["entDate"]);
						
						$packageView .= "
										<tr class='$packageClass'>
											<td colspan='5' style='text-align:left;background:#ffffff;'>
												<p style='font-size:17px;'>Contract Award:</p>	
											</td>
											<td colspan='2' style='text-align:right;background:#ffffff;padding-left: 24%;'>
												<table style='text-align:right;background:#ffffff;'><tr>
													<td style='text-align:right;background:#ffffff;'>
													
													<script  type='text/javascript'>		
															$(document).ready(function() {			
																$('#viewAwardStage{$packageID}').click(function(){					
																	var packageIdAwardStage 				= $('#packageIdAwardStage{$packageID}').val();
																	var userIdAwardStage					= $('#userIdAwardStage{$packageID}').val();	
																	var pi_4AwardStage					= $('#pi_4AwardStage{$packageID}').val();
																	var pi_5AwardStage					= $('#pi_5AwardStage{$packageID}').val();	
																	var pi_6AwardStage					= $('#pi_6AwardStage{$packageID}').val();	
																	var packageNameAwardStage			= $('#packageNameAwardStage{$packageID}').val();																							
																$('#viewAwardStage{$packageID}').html();																	
																	$.post('ajax/getVieweAwardStage.php',{'packageIdAwardStage': packageIdAwardStage, 'userIdAwardStage': userIdAwardStage, 'pi_4AwardStage': pi_4AwardStage,'pi_5AwardStage': pi_5AwardStage, 'pi_6AwardStage': pi_6AwardStage, 'packageNameAwardStage':packageNameAwardStage},
																	function(data)
																	{  	
																		$('#showResultsAwardStage{$packageID}').html(data);
																	});
																})				 
															});		
													</script>
													
													<form method='post'>					
														<input type='hidden' name='packageIdAwardStage' id='packageIdAwardStage{$packageID}' value='$packageID' />
														<input type='hidden' name='userIdAwardStage' id='userIdAwardStage{$packageID}' value='$userId' />
														<input type='hidden' name='pi_4AwardStage' id='pi_4AwardStage{$packageID}' value='$pi_4' />
														<input type='hidden' name='pi_5AwardStage' id='pi_5AwardStage{$packageID}' value='$pi_5' />
														<input type='hidden' name='pi_6AwardStage' id='pi_6AwardStage{$packageID}' value='$pi_6' />
														<input type='hidden' name='packageNameAwardStage' id='packageNameAwardStage{$packageID}' value='$packageName' />
														<input type='button' name='viewAwardStage{$packageID}' id='viewAwardStage{$packageID}' value='Refresh' class='FormSubmitBtn' />	
													</form>		
													</td>
													<td style='text-align:right;background:#ffffff;'>
														<form action='contractingStageEdit.php' method='post' target='_blank'>
															<input type='hidden' name='pi_4' value='$pi_4'/>
															<input type='hidden' name='pi_5' value='$pi_5'/>
															<input type='hidden' name='pi_6' value='$pi_6'/>

															<input type='hidden' name='packageId' value='$packageID'/>
															<input type='hidden' name='packageName' value='$packageName'/>
															<input type='submit' name='editSubmitContractingStage'  value='Update Info'/>
														</form>
													</td>
												</tr>
											 </table>
										
											</td>
										</tr>
										
										<tr class='$packageClass'>
											<td>1.</td><td style='text-align:left;width:35%;padding-left:5px;'> Date of Issuance of NOA to Successful Bidder:</td><td style='width: 13%; text-align:left;padding-left:5px;'>$cs_64_null $cs_64_date</td><td style=' background:#ffffff;'></td>
											<td>3.</td><td style='text-align:left;width:35%;padding-left:5px;'> Name of the Supplier/ Contractor :</td><td style='width:13%;text-align:left;padding-left:5px;'>$cs_113</td>
										</tr>
										
										<tr style='background:#DDDDDD;'>
											<td>2.</td><td style='text-align:left;width:35%;padding-left:5px;'>Date of Acceptance of NOA by Successful Bidder:</td><td style='width: 13%;text-align:left;padding-left:5px;'>$cs_65_null $cs_65_date</td><td style=' background:#ffffff;'></td>
											<td>4.</td><td style='text-align:left;width:35%;padding-left:5px;'> Country of the Supplier/ Contractor:</td><td style='width: 13%;text-align:left;padding-left:5px;'> $cs_114a</td><td style=' background:#ffffff;'></td>
										</tr>
                                        
                                        <tr style='background:#ffffff;'>
											<td></td><td style='text-align:left;width:35%;padding-left:5px;'> &nbsp; </td><td style='width: 13%;text-align:left;padding-left:5px;'> &nbsp; </td><td style=' background:#ffffff;'></td>
											<td></td><td style='text-align:left;width:35%;padding-left:5px;'> &nbsp; </td><td style='width: 13%;text-align:left;padding-left:5px;'> &nbsp; </td>
										</tr>
										
										<tr class='$packageClass'>
											<td>5.</td><td style='text-align:left;width:35%;padding-left:5px;'> Planned Date of Contract Signing:</td><td style='width: 13%; text-align:left;padding-left:5px;'> $cs_67a_null $cs_67a_date</td><td style=' background:#ffffff;'></td>
											<td>7.</td><td style='text-align:left;width:35%;padding-left:5px;'> Date of Issuance of Performance Security :</td><td style='width:13%;text-align:left;padding-left:5px;'>$cs_66_null $cs_66_date</td>
										</tr>
										
										
										<tr style='background:#DDDDDD;'>
											<td>6.</td><td style='text-align:left;width:35%;padding-left:5px;'> Date of Contract Signing:</td><td style='width: 13%;text-align:left;padding-left:5px;'> $cs_68_null $cs_68_date</td><td style=' background:#ffffff;'></td>
											<td>8.</td><td style='text-align:left;width:35%;padding-left:5px;'> Date of Expiry of Performance Security: </td><td style='width: 13%;text-align:left;padding-left:5px;'> $cs_67_null $cs_67_date</td>
										</tr>
										
                                        <tr style='background:#ffffff;'>
											<td></td><td style='text-align:left;width:35%;padding-left:5px;'> &nbsp; </td><td style='width: 13%;text-align:left;padding-left:5px;'> &nbsp; </td><td style=' background:#ffffff;'></td>
											<td></td><td style='text-align:left;width:35%;padding-left:5px;'> &nbsp; </td><td style='width: 13%;text-align:left;padding-left:5px;'> &nbsp; </td>
										</tr>
                                        
										<tr class='$packageClass'>
											<td>9.</td><td style='text-align:left;width:35%;padding-left:5px;'>Planned Completion Time (Days):</td><td style='width: 13%;text-align:left;padding-left:5px;'>$cs_72a</td><td style=' background:#ffffff;'></td>
											<td>10.</td><td style='text-align:left;width:35%;padding-left:5px;'> Planned Completion Date:</td><td style='width: 13%;text-align:left;padding-left:5px;'> $cs_72_null $cs_72_date</td>
										</tr>
										
										<tr style='background:#ffffff;'>
											<td></td><td style='text-align:left;width:35%;padding-left:5px;'> &nbsp; </td><td style='width: 13%;text-align:left;padding-left:5px;'> &nbsp; </td><td style=' background:#ffffff;'></td>
											<td></td><td style='text-align:left;width:35%;padding-left:5px;'> &nbsp; </td><td style='width: 13%;text-align:left;padding-left:5px;'> &nbsp; </td>
										</tr>
			
										<tr style='background:#DDDDDD;'>
											<td>11.</td><td style='text-align:left;width:35%;padding-left:5px;'>Date of Contract Award Information Published in ADB, CPTU & Entity's Website:</td><td style='width: 13%;text-align:left;padding-left:5px;'>$cs_69_null $cs_69_date</td><td style=' background:#ffffff;'></td>
											<td>14.</td><td style='text-align:left;width:35%;padding-left:5px;'> Original Contract Price in Contract Currency or Currencies :</td><td style='width: 13%;text-align:left;padding-left:5px;'>$cs_9</td>
										</tr>
										
										<tr class='$packageClass'>
											<td>12.</td><td style='text-align:left;width:35%;padding-left:5px;'> Date of Sending Copy of Final Contract to ADB:</td><td style='width: 13%;text-align:left;padding-left:5px;'>$cs_70_null $cs_70_date</td><td style=' background:#ffffff;'></td>
											<td>15.</td><td style='text-align:left;width:35%;padding-left:5px;'> Original Contract Price (Equiv. US$) :</td><td style='width: 13%;text-align:left;padding-left:5px;'>".number_format($cs_11,2)."</td>
										</tr>
										
										<tr style='background:#DDDDDD;'>
											<td>13.</td><td style='text-align:left;width:35%;padding-left:5px;'> Debriefing Held:</td><td style='width: 13%;text-align:left;padding-left:5px;'>$cs_104</td><td style=' background:#ffffff;'></td>
											<td>16.</td><td style='text-align:left;width:35%;padding-left:5px;'> Contract with Advance Payment Provision:</td><td style='width: 13%;text-align:left;padding-left:5px;'>$cs_105</td>
										</tr>
                                        
                                        <tr class='$packageClass'>
											<td></td><td style='text-align:left;width:35%;padding-left:5px;'></td><td style='width: 13%;text-align:left;padding-left:5px;'></td><td style=' background:#ffffff;'></td>
											<td>17.</td><td style='text-align:left;width:35%;padding-left:5px;'>Contract with Price Adjustment Provision  :</td><td style='width: 13%;text-align:left;padding-left:5px;'>$cs_106</td>
										</tr>
							
									
									
									
									
										<tr style='background:#ffffff;'>
											<td></td><td style='text-align:left;width:35%;padding-left:5px;'> &nbsp; </td><td style='width: 13%;text-align:left;padding-left:5px;'> &nbsp; </td><td style=' background:#ffffff;'></td>
											<td></td><td style='text-align:left;width:35%;padding-left:5px;'> &nbsp; </td><td style='width: 13%;text-align:left;padding-left:5px;'> &nbsp; </td>
										</tr>
										<tr style='background:#ffffff;'>
											<td style='text-align:left;width:100%;padding-left:5px;font-size:12px;' colspan='7'><center>Last Updated: <b>$entDatecs</b>, Updated By: <b>$userName</b></center></td>
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
										<form action='contractingStage.php' method='post' target='_blank'>
										<input type='hidden' name='pi_4' id='pi_4' value='$pi_4' />
										<input type='hidden' name='pi_5' id='pi_5' value='$pi_5' />
										<input type='hidden' name='pi_6' id='pi_6' value='$pi_6' />
										<input type='hidden' name='packageId' value='$packageID'/>
										<input type='hidden' name='packageName' value='$packageName'/>
										<input type='submit' name='contractingStageSubmit'  value='No Data Found Insert New Data'/>
										</form>
										</td>
										<td>
                                      		<script  type='text/javascript'>		
															$(document).ready(function() {			
																$('#viewAwardStage{$packageID}').click(function(){					
																	var packageIdAwardStage 				= $('#packageIdAwardStage{$packageID}').val();
																	var userIdAwardStage					= $('#userIdAwardStage{$packageID}').val();	
																	var pi_4AwardStage					= $('#pi_4AwardStage{$packageID}').val();
																	var pi_5AwardStage					= $('#pi_5AwardStage{$packageID}').val();	
																	var pi_6AwardStage					= $('#pi_6AwardStage{$packageID}').val();	
																	var packageNameAwardStage			= $('#packageNameAwardStage{$packageID}').val();																							
																$('#viewAwardStage{$packageID}').html();																	
																	$.post('ajax/getVieweAwardStage.php',{'packageIdAwardStage': packageIdAwardStage, 'userIdAwardStage': userIdAwardStage, 'pi_4AwardStage': pi_4AwardStage,'pi_5AwardStage': pi_5AwardStage, 'pi_6AwardStage': pi_6AwardStage, 'packageNameAwardStage':packageNameAwardStage},
																	function(data)
																	{  	
																		$('#showResultsAwardStage{$packageID}').html(data);
																	});
																})				 
															});		
													</script>
													
													<form method='post'>					
														<input type='hidden' name='packageIdAwardStage' id='packageIdAwardStage{$packageID}' value='$packageID' />
														<input type='hidden' name='userIdAwardStage' id='userIdAwardStage{$packageID}' value='$userId' />
														<input type='hidden' name='pi_4AwardStage' id='pi_4AwardStage{$packageID}' value='$pi_4' />
														<input type='hidden' name='pi_5AwardStage' id='pi_5AwardStage{$packageID}' value='$pi_5' />
														<input type='hidden' name='pi_6AwardStage' id='pi_6AwardStage{$packageID}' value='$pi_6' />
														<input type='hidden' name='packageNameAwardStage' id='packageNameAwardStage{$packageID}' value='$packageName' />
														<input type='button' name='viewAwardStage{$packageID}' id='viewAwardStage{$packageID}' value='Refresh' class='FormSubmitBtn' />	
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
