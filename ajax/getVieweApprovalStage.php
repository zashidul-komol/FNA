
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
        $packageID 					= $_REQUEST['packageIdApprovalStage'];    
		$userId 					= $_REQUEST['userIdApprovalStage'];
		$pi_4 						= $_REQUEST['pi_4ApprovalStage'];
		$pi_5 						= $_REQUEST['pi_5ApprovalStage'];
		$pi_6 						= $_REQUEST['pi_6ApprovalStage'];
		$packageName 				= $_REQUEST['packageNameApprovalStage'];

		
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
										adbs_evaluationreportapprovalstage.eras_57,
										adbs_evaluationreportapprovalstage.eras_58,
										adbs_evaluationreportapprovalstage.eras_59,
										adbs_evaluationreportapprovalstage.eras_60,
										adbs_evaluationreportapprovalstage.eras_60a,
										adbs_evaluationreportapprovalstage.eras_61,
										adbs_evaluationreportapprovalstage.eras_62,
										adbs_evaluationreportapprovalstage.eras_62a,
										adbs_evaluationreportapprovalstage.eras_63,
										adbs_evaluationreportapprovalstage.eras_95,
										adbs_evaluationreportapprovalstage.eras_96,
										adbs_evaluationreportapprovalstage.eras_99,
										adbs_evaluationreportapprovalstage.eras_101,
										adbs_evaluationreportapprovalstage.eras_62b,
										adbs_evaluationreportapprovalstage.eras_104,
										adbs_evaluationreportapprovalstage.entDate
								FROM
										adbs_evaluationreportapprovalstage
								WHERE
										adbs_evaluationreportapprovalstage.pId='$packageID'
								ORDER BY
										adbs_evaluationreportapprovalstage.erasId
							  ";	
	
		$packageView .= " <!-- Tab 6 Start -->
                            <div id='tabs{$packageID}-6'>
							  <div id='showResultsApprovalStage{$packageID}'>
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
						
						$eras_60a        = $packageStatementData["eras_60a"];
						$eras_60a_null = '';
						$eras_60a_date = '';
						if($pi_18Check == 'Yes'){
							if ($eras_60a=='0000-00-00'){
								$eras_60a_null = '';
							}
							else{$eras_60a_date = showDateFormat($packageStatementData["eras_60a"]);}
						}else{
							$eras_60a_null = 'N/A';	
						}
						
						$eras_61        = $packageStatementData["eras_61"];
						$eras_61_null = '';
						$eras_61_date = '';
						
						if($pi_18Check == 'Yes'){
							if ($eras_61=='0000-00-00'){
								$eras_61_null = '';
							}
							else{$eras_61_date = showDateFormat($packageStatementData["eras_61"]);}
						}else{
							$eras_61_null = 'N/A';	
						}
						
						$eras_62        = $packageStatementData["eras_62"];
						$eras_62_null = '';
						$eras_62_date = '';
						if($pi_18Check == 'Yes'){
							if ($eras_62=='0000-00-00'){
								$eras_62_null = '';
							}
							else{$eras_62_date = showDateFormat($packageStatementData["eras_62"]);}
						}else{
							$eras_62_null = 'N/A';	
						}
						
						$eras_62a        = $packageStatementData["eras_62a"];
						$eras_62a_null = '';
						$eras_62a_date = '';
						if ($eras_62a=='0000-00-00'){
							$eras_62a_null = '';
						}
						else{$eras_62a_date = showDateFormat($packageStatementData["eras_62a"]);}
						
						$eras_63        = $packageStatementData["eras_63"];
						$eras_63_null = '';
						$eras_63_date = '';
						if ($eras_63=='0000-00-00'){
							$eras_63_null = '';
						}
						else{$eras_63_date = showDateFormat($packageStatementData["eras_63"]);}
						
						$eras_62b        = $packageStatementData["eras_62b"];
						$eras_62b_null = '';
						$eras_62b_date = '';
						if ($eras_62b=='0000-00-00'){
							$eras_62b_null = '';
						}
						else{$eras_62b_date = showDateFormat($packageStatementData["eras_62b"]);}
						
						$eras_95	    = $packageStatementData["eras_95"];
						
						$eras_96        = $packageStatementData["eras_96"];
						$eras_99        = $packageStatementData["eras_99"];
						$eras_101       = $packageStatementData["eras_101"];
						$eras_104       = $packageStatementData["eras_104"];
						$entDateeras    = showDateFormat($packageStatementData["entDate"]);
						
						$packageView .= "
										<tr class='$packageClass'>
										<td colspan='5' style='text-align:left;background:#ffffff;'>
												<p style='font-size:17px;'>Approval Process:</p>	
											</td>
											<td colspan='2' style='text-align:right;background:#ffffff;padding-left: 24%;'>
												<table style='text-align:right;background:#ffffff;'><tr>
													<td style='text-align:right;background:#ffffff;'>
													
													<script  type='text/javascript'>		
															$(document).ready(function() {			
																$('#viewApprovalStage{$packageID}').click(function(){					
																	var packageIdApprovalStage 				= $('#packageIdApprovalStage{$packageID}').val();
																	var userIdApprovalStage					= $('#userIdApprovalStage{$packageID}').val();	
																	var pi_4ApprovalStage					= $('#pi_4ApprovalStage{$packageID}').val();
																	var pi_5ApprovalStage					= $('#pi_5ApprovalStage{$packageID}').val();	
																	var pi_6ApprovalStage					= $('#pi_6ApprovalStage{$packageID}').val();	
																	var packageNameApprovalStage			= $('#packageNameApprovalStage{$packageID}').val();																							
																$('#viewApprovalStage{$packageID}').html();																	
																	$.post('ajax/getVieweApprovalStage.php',{'packageIdApprovalStage': packageIdApprovalStage, 'userIdApprovalStage': userIdApprovalStage, 'pi_4ApprovalStage': pi_4ApprovalStage, 'pi_5ApprovalStage': pi_5ApprovalStage, 'pi_6ApprovalStage': pi_6ApprovalStage, 'packageNameApprovalStage':packageNameApprovalStage},
																	function(data)
																	{  	
																		$('#showResultsApprovalStage{$packageID}').html(data);
																	});
																})				 
															});		
													</script>
													
													<form method='post'>					
														<input type='hidden' name='packageIdApprovalStage' id='packageIdApprovalStage{$packageID}' value='$packageID' />
														<input type='hidden' name='userIdApprovalStage' id='userIdApprovalStage{$packageID}' value='$userId' />
														<input type='hidden' name='pi_4ApprovalStage' id='pi_4ApprovalStage{$packageID}' value='$pi_4' />
														<input type='hidden' name='pi_5ApprovalStage' id='pi_5ApprovalStage{$packageID}' value='$pi_5' />
														<input type='hidden' name='pi_6ApprovalStage' id='pi_6ApprovalStage{$packageID}' value='$pi_6' />
														<input type='hidden' name='packageNameApprovalStage' id='packageNameApprovalStage{$packageID}' value='$packageName' />
														<input type='button' name='viewApprovalStage{$packageID}' id='viewApprovalStage{$packageID}' value='Refresh' class='FormSubmitBtn' />	
													</form>		
													</td>
													<td style='text-align:right;background:#ffffff;'>
													<form action='evaluationReportApprovalStageEdit.php' method='post' target='_blank'>
														<input type='hidden' name='pi_4' value='$pi_4'/>
														<input type='hidden' name='pi_5' value='$pi_5'/>
														<input type='hidden' name='pi_6' value='$pi_6'/>
														<input type='hidden' name='packageId' value='$packageID'/>
														<input type='hidden' name='packageName' value='$packageName'/>
														<input type='submit' name='editSubmitEvaluationReportApprovalStage'  value='Update Info'/>
													</form>
													</td>
												</tr>
											 </table>
											</td>
										</tr>				
																
										<tr class='$packageClass'>
											<td>1.</td><td style='text-align:left;width:35%;padding-left:5px;'>Planned Date of Sending Bid Evaluation Report (BER) to ADB:</td><td style='width: 13%;text-align:left;padding-left:5px;'> $eras_60a_null $eras_60a_date</td><td style=' background:#ffffff;'></td>
											<td>5.</td><td style='text-align:left;width:35%;padding-left:5px;'>Planned Date of EA's Approval on BER:</td><td style='width:13%;text-align:left;padding-left:5px;'> $eras_62a_null $eras_62a_date</td>
										</tr>
										
										<tr style='background:#DDDDDD;'>
											<td>2.</td><td style='text-align:left;width:35%;padding-left:5px;'>Date of Sending BER to ADB :</td><td style='width: 13%;text-align:left;padding-left:5px;'> $eras_61_null $eras_61_date</td><td style=' background:#ffffff;'></td>
											<td>6.</td><td style='text-align:left;width:35%;padding-left:5px;'>Number of Revisions/ Clarifications of BER/ TBER/ FBER Sought by Approving Authority:</td><td style='width: 13%;text-align:left;padding-left:5px;'> $eras_95</td>
										</tr>
										
										<tr class='$packageClass'>
											<td>3.</td><td style='text-align:left;width:35%;padding-left:5px;'>Number of Revisions/ Clarifications of BER/ TBER/ FBER Sought by ADB:</td><td style='width: 13%;text-align:left;padding-left:5px;'>$eras_96</td><td style=' background:#ffffff;'></td>
											<td>7.</td><td style='text-align:left;width:35%;padding-left:5px;'>Date of EA's Approval on BER:</td><td style='width: 13%;text-align:left;padding-left:5px;'>$eras_63_null $eras_63_date</td>
										</tr>

										<tr style='background:#DDDDDD;'>
											<td>4.</td><td style='text-align:left;width:35%;padding-left:5px;'>Date of ADB's NOL on Contract Award / BER:</td><td style='width: 13%;text-align:left;padding-left:5px;'>$eras_62_null $eras_62_date</td><td style=' background:#ffffff;'></td>
											<td>8.</td><td style='text-align:left;width:35%;padding-left:5px;'>Planned Date of Issuance of NOA in Favor of Recommended Bidder:</td><td style='width: 13%;text-align:left;padding-left:5px;'>$eras_62b_null $eras_62b_date</td>
										</tr>
                                        
                                        <tr style='background:#ffffff;'>
											<td></td><td style='text-align:left;width:35%;padding-left:5px;'> &nbsp; </td><td style='width: 13%;text-align:left;padding-left:5px;'> &nbsp; </td><td style=' background:#ffffff;'></td>
											<td></td><td style='text-align:left;width:35%;padding-left:5px;'> &nbsp; </td><td style='width: 13%;text-align:left;padding-left:5px;'> &nbsp; </td>
										</tr>
										
										<tr class='$packageClass'>
											<td>9.</td><td style='text-align:left;width:35%;padding-left:5px;'>Number of Complaints Received by EA:</td><td style='width: 13%;text-align:left;padding-left:5px;'> $eras_101</td><td style=' background:#ffffff;'></td>
											<td>10.</td><td style='text-align:left;width:35%;padding-left:5px;'>Short Description of Complaints/ F&C Detected:</td><td style='width: 13%;text-align:left;padding-left:5px;'>$eras_104</td>
										</tr>





									
										<tr style='background:#ffffff;'>
											<td></td><td style='text-align:left;width:35%;padding-left:5px;'> &nbsp; </td><td style='width: 13%;text-align:left;padding-left:5px;'> &nbsp; </td><td style=' background:#ffffff;'></td>
											<td></td><td style='text-align:left;width:35%;padding-left:5px;'> &nbsp; </td><td style='width: 13%;text-align:left;padding-left:5px;'> &nbsp; </td>
										</tr>
										<tr style='background:#ffffff;'>
											<td style='text-align:left;width:100%;padding-left:5px;font-size:12px;' colspan='7'><center>Last Updated: <b>$entDateeras</b>, Updated By: <b>$userName</b></center></td>
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
										<form action='evaluationReportApprovalStage.php' method='post' target='_blank'>
										<input type='hidden' name='pi_4' id='pi_4' value='$pi_4' />
										<input type='hidden' name='pi_5' id='pi_5' value='$pi_5' />
										<input type='hidden' name='pi_6' id='pi_6' value='$pi_6' />
										<input type='hidden' name='packageId' value='$packageID'/>
										<input type='hidden' name='packageName' value='$packageName'/>
										<input type='submit' name='evaluationPASsubmit'  value='No Data Found Insert New Data'/>
										</form>
										</td>
										<td>
                                    <script  type='text/javascript'>		
															$(document).ready(function() {			
																$('#viewApprovalStage{$packageID}').click(function(){					
																	var packageIdApprovalStage 				= $('#packageIdApprovalStage{$packageID}').val();
																	var userIdApprovalStage					= $('#userIdApprovalStage{$packageID}').val();	
																	var pi_4ApprovalStage					= $('#pi_4ApprovalStage{$packageID}').val();
																	var pi_5ApprovalStage					= $('#pi_5ApprovalStage{$packageID}').val();	
																	var pi_6ApprovalStage					= $('#pi_6ApprovalStage{$packageID}').val();	
																	var packageNameApprovalStage			= $('#packageNameApprovalStage{$packageID}').val();																							
																$('#viewApprovalStage{$packageID}').html();																	
																	$.post('ajax/getVieweApprovalStage.php',{'packageIdApprovalStage': packageIdApprovalStage, 'userIdApprovalStage': userIdApprovalStage, 'pi_4ApprovalStage': pi_4ApprovalStage, 'pi_5ApprovalStage': pi_5ApprovalStage, 'pi_6ApprovalStage': pi_6ApprovalStage, 'packageNameApprovalStage':packageNameApprovalStage},
																	function(data)
																	{  	
																		$('#showResultsApprovalStage{$packageID}').html(data);
																	});
																})				 
															});		
													</script>
													
													<form method='post'>					
														<input type='hidden' name='packageIdApprovalStage' id='packageIdApprovalStage{$packageID}' value='$packageID' />
														<input type='hidden' name='userIdApprovalStage' id='userIdApprovalStage{$packageID}' value='$userId' />
														<input type='hidden' name='pi_4ApprovalStage' id='pi_4ApprovalStage{$packageID}' value='$pi_4' />
														<input type='hidden' name='pi_5ApprovalStage' id='pi_5ApprovalStage{$packageID}' value='$pi_5' />
														<input type='hidden' name='pi_6ApprovalStage' id='pi_6ApprovalStage{$packageID}' value='$pi_6' />
														<input type='hidden' name='packageNameApprovalStage' id='packageNameApprovalStage{$packageID}' value='$packageName' />
														<input type='button' name='viewApprovalStage{$packageID}' id='viewApprovalStage{$packageID}' value='Refresh' class='FormSubmitBtn' />	
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
