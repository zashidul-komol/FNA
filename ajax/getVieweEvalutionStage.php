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
        $packageID 					= $_REQUEST['packageIdEvalutionStage'];    
		$userId 					= $_REQUEST['userIdEvalutionStage'];
		$pi_4 						= $_REQUEST['pi_4BEvalutionStage'];
		$pi_5						= $_REQUEST['pi_5BEvalutionStage'];
		$pi_6 						= $_REQUEST['pi_6EvalutionStage'];
		$packageName 				= $_REQUEST['packageNameEvalutionStage'];

		
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
										adbs_bidproposalevaluationstage.bpes_50,
										adbs_bidproposalevaluationstage.bpes_51,
										adbs_bidproposalevaluationstage.bpes_52,
										adbs_bidproposalevaluationstage.bpes_53,
										adbs_bidproposalevaluationstage.bpes_54,
										adbs_bidproposalevaluationstage.bpes_54a,
										adbs_bidproposalevaluationstage.bpes_55,
										adbs_bidproposalevaluationstage.bpes_56,
										adbs_bidproposalevaluationstage.bpes_85,
										adbs_bidproposalevaluationstage.bpes_86,
										adbs_bidproposalevaluationstage.bpes_87,
										adbs_bidproposalevaluationstage.bpes_93,
										adbs_bidproposalevaluationstage.bpes_94,
										adbs_bidproposalevaluationstage.bpes_97,
										adbs_bidproposalevaluationstage.bpes_98,
										adbs_bidproposalevaluationstage.bpes_100,
										adbs_bidproposalevaluationstage.bpes_101,
										adbs_bidproposalevaluationstage.bpes_102,
										adbs_bidproposalevaluationstage.bpes_103,
										adbs_bidproposalevaluationstage.bpes_112,
										adbs_bidproposalevaluationstage.bpes_50a,
										adbs_bidproposalevaluationstage.bpes_51a,
										adbs_bidproposalevaluationstage.bpes_56a,
										adbs_bidproposalevaluationstage.bpes_95a,
										adbs_bidproposalevaluationstage.bpes_104,
										adbs_bidproposalevaluationstage.bpes_113,
										adbs_bidproposalevaluationstage.entDate
								FROM
										adbs_bidproposalevaluationstage
								WHERE
										adbs_bidproposalevaluationstage.pId='$packageID'
								ORDER BY
										adbs_bidproposalevaluationstage.bpes_50
							  ";	
	
		$packageView .= " <!-- Tab 5 Start -->
                            <div id='tabs{$packageID}-5'>
							  <div id='showResultsEvalutionStage{$packageID}'>
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
						$bpes_50        = $packageStatementData["bpes_50"];
						$bpes_50_null = '';
						$bpes_50_date = '';
						if ($bpes_50=='0000-00-00'){
							$bpes_50_null = '';
						}
						else{$bpes_50_date = showDateFormat($packageStatementData["bpes_50"]);}
						
						$bpes_51a        = $packageStatementData["bpes_51a"];
						$bpes_51a_null = '';
						$bpes_51a_date = '';
						if ($bpes_51a=='0000-00-00'){
							$bpes_51a_null = '';
						}
						else{$bpes_51a_date = showDateFormat($packageStatementData["bpes_51a"]);}
						
						$bpes_51        = $packageStatementData["bpes_51"];
						$bpes_52		= $packageStatementData["bpes_52"];
						$bpes_53        = $packageStatementData["bpes_53"];
						$bpes_54        = $packageStatementData["bpes_54"];
						$bpes_56a        = $packageStatementData["bpes_56a"];
						
						$bpes_54a        = $packageStatementData["bpes_54a"];
						$bpes_54a_null = '';
						$bpes_54a_date = '';
						if ($bpes_54a=='0000-00-00'){
							$bpes_54a_null = '';
						}
						else{$bpes_54a_date = showDateFormat($packageStatementData["bpes_54a"]);}
						
						$bpes_55        = $packageStatementData["bpes_55"];
						$bpes_56	    = $packageStatementData["bpes_56"];
						$bpes_56_null = '';
						$bpes_56_date = '';
						if ($bpes_56=='0000-00-00'){
							$bpes_56_null = '';
						}
						else{$bpes_56_date = showDateFormat($packageStatementData["bpes_56"]);}
						
						$bpes_85        = $packageStatementData["bpes_85"];
						$bpes_86        = $packageStatementData["bpes_86"];
						$bpes_87        = $packageStatementData["bpes_87"];
						$bpes_93		= $packageStatementData["bpes_93"];
						$bpes_94        = $packageStatementData["bpes_94"];
						$bpes_95a       = $packageStatementData["bpes_95a"];
						$bpes_97        = $packageStatementData["bpes_97"];
						$bpes_98		= $packageStatementData["bpes_98"];
						$bpes_100       = $packageStatementData["bpes_100"];
						$bpes_101       = $packageStatementData["bpes_101"];
						$bpes_102       = $packageStatementData["bpes_102"];
						$bpes_103		= $packageStatementData["bpes_103"];
						$bpes_112       = $packageStatementData["bpes_112"];
						$bpes_51a       = showDateFormat($packageStatementData["bpes_51a"]);
						$bpes_104       = $packageStatementData["bpes_104"];
						$bpes_113       = $packageStatementData["bpes_113"];
						$entDatebpes    = showDateFormat($packageStatementData["entDate"]);
						
						$bpes_50a       = $packageStatementData["bpes_50a"];
						$bpes_50a_null  = '';
						$bpes_50a_date  = '';
						if($pi_18Check == 'Yes'){
							if ($bpes_50a=='0000-00-00'){
								$bpes_50a_null = '';
							}
							else{$bpes_50a_date = showDateFormat($packageStatementData["bpes_50a"]);}
						}else{
							$bpes_50a_null = 'N/A';	
						}
						
						
						$biddingStageQuery 		= "SELECT * FROM adbs_biddingproposalstage WHERE pId='".$packageID."'"; 
						$biddingStageQueryStatement	= mysql_query($biddingStageQuery); 
						while($biddingStageQueryStatementData	= mysql_fetch_array($biddingStageQueryStatement)){ 
								
						 $bps_48Old        = $biddingStageQueryStatementData["bps_48"];  
						 $bps_49Old        = $biddingStageQueryStatementData["bps_49"];    
						}
						$bps_48Cal 					= date("Ymd",strtotime($bps_48Old));
						$bps_49Cal 					= date("Ymd",strtotime($bps_49Old)); 
						$bpes_50Cal 				= date("Ymd",strtotime($bpes_50)); 
						
						if($bps_48Cal > $bps_49Cal){
							if($bps_48Cal == $bpes_50Cal){
								$bpes_50_Red = "<font color='#000000'>$bpes_50_null $bpes_50_date</font>";	
							}else{
								$bpes_50_Red = "<font color='#F03'>$bpes_50_null $bpes_50_date</font>";
							}	
						}else{
							if($bps_49Cal == $bpes_50Cal){
								$bpes_50_Red = "<font color='#000000'>$bpes_50_null $bpes_50_date</font>";	
							}else{
								$bpes_50_Red = "<font color='#F03'>$bpes_50_null $bpes_50_date</font>";
							}		
						}
						
						
						$packageView .= "
										<tr class='$packageClass'>
											<td colspan='5' style='text-align:left;background:#ffffff;'>
												<p style='font-size:17px;'>Bid Opening & Evaluation:</p>	
											</td>
											<td colspan='2' style='text-align:right;background:#ffffff;padding-left:23%;'>
												<table style='text-align:right;background:#ffffff;'><tr>
													<td style='text-align:right;background:#ffffff;'>
													<script  type='text/javascript'>		
														$(document).ready(function() {			
															$('#viewEvalutionStage{$packageID}').click(function(){					
																var packageIdEvalutionStage 			= $('#packageIdEvalutionStage{$packageID}').val();
																var userIdEvalutionStage				= $('#userIdEvalutionStage{$packageID}').val();	
																var pi_4BEvalutionStage					= $('#pi_4BEvalutionStage{$packageID}').val();
																var pi_5BEvalutionStage					= $('#pi_5BEvalutionStage{$packageID}').val();	
																var pi_6EvalutionStage					= $('#pi_6EvalutionStage{$packageID}').val();	
																var packageNameEvalutionStage			= $('#packageNameEvalutionStage{$packageID}').val();																							
															$('#viewEvalutionStage{$packageID}').html();																	
																$.post('ajax/getVieweEvalutionStage.php',{'packageIdEvalutionStage': packageIdEvalutionStage, 'userIdEvalutionStage': userIdEvalutionStage, 'pi_4BEvalutionStage': pi_4BEvalutionStage,'pi_5BEvalutionStage': pi_5BEvalutionStage, 'pi_6EvalutionStage': pi_6EvalutionStage, 'packageNameEvalutionStage':packageNameEvalutionStage},
																function(data)
																{  	
																	$('#showResultsEvalutionStage{$packageID}').html(data);
																});
															})				 
														});		
												</script>
													
													<form method='post'>					
														<input type='hidden' name='packageIdEvalutionStage' id='packageIdEvalutionStage{$packageID}' value='$packageID' />
														<input type='hidden' name='userIdEvalutionStage' id='userIdEvalutionStage{$packageID}' value='$userId' />
														<input type='hidden' name='pi_4EvalutionStage' id='pi_4BEvalutionStage{$packageID}' value='$pi_4' />
														<input type='hidden' name='pi_5EvalutionStage' id='pi_5BEvalutionStage{$packageID}' value='$pi_5' />
														<input type='hidden' name='pi_6EvalutionStage' id='pi_6EvalutionStage{$packageID}' value='$pi_6' />
														<input type='hidden' name='packageNameEvalutionStage' id='packageNameEvalutionStage{$packageID}' value='$packageName' />
														<input type='button' name='viewEvalutionStage{$packageID}' id='viewEvalutionStage{$packageID}' value='Refresh' class='FormSubmitBtn' />	
													</form>		
													</td>
													
													<td style='text-align:right;background:#ffffff;'>
													<form action='biddingProposalEvaluationStageEdit.php' method='post' target='_blank'>
														<input type='hidden' name='pi_4' value='$pi_4'/>
														<input type='hidden' name='pi_5' value='$pi_5'/>
														<input type='hidden' name='pi_6' value='$pi_6'/>
														<input type='hidden' name='packageId' value='$packageID'/>
														<input type='hidden' name='packageName' value='$packageName'/>
														<input type='submit' name='editSubmitBiddingEvaluationlStage'  value='Update Info'/>
													</form>
													</td>
												</tr>
											 </table>
											
											</td>
										</tr>
										
										<tr class='$packageClass'>
											<td>1.</td><td style='text-align:left;width:35%;padding-left:5px;'> Planned Date of Bids Opening :</td><td style='width: 13%; text-align:left;padding-left:5px;'> $bpes_54a_null $bpes_54a_date</td><td style=' background:#ffffff;'></td>
											<td>2.</td><td style='text-align:left;width:35%;padding-left:5px;'> Date of Bids Opening :</td><td style='width:13%;text-align:left;padding-left:5px;'> $bpes_50_Red </td>
										</tr>
                                        
                                       <tr style='background:#DDDDDD;'>
											<td>3.</td><td style='text-align:left;width:35%;padding-left:5px;'>Original Bid Validity Period (days):</td><td style='width: 13%;text-align:left;padding-left:5px;'> $bpes_56a</td><td style=' background:#ffffff;'></td>
											<td>6.</td><td style='text-align:left;width:35%;padding-left:5px;'>Date of Sending Bid Opening Records to ADB:</td><td style='width: 13%;text-align:left;padding-left:5px;'>$bpes_50a_null $bpes_50a_date</td>
										</tr>
										
										<tr class='$packageClass'>
											<td>4.</td><td style='text-align:left;width:35%;padding-left:5px;'> Number of Extension of Bid Validity Period:</td><td style='width: 13%;text-align:left;padding-left:5px;'> $bpes_94</td><td style=' background:#ffffff;'></td>
											<td>7.</td><td style='text-align:left;width:35%;padding-left:5px;'> Number of Bids Received:</td><td style='width: 13%;text-align:left;padding-left:5px;'> $bpes_85</td>
										</tr>
										
										<tr style='background:#DDDDDD;'>
											<td>5.</td><td style='text-align:left;width:35%;padding-left:5px;'> Revised  Bid Validity Period (days):</td><td style='width: 13%;text-align:left;padding-left:5px;'>$bpes_93 </td><td style=' background:#ffffff;'></td>
											<td>8.</td><td style='text-align:left;width:35%;padding-left:5px;'> Number of Responsive Bids:</td><td style='width: 13%;text-align:left;padding-left:5px;'> $bpes_86</td>
										</tr>
										
										<tr style='background:#ffffff;'>
											<td></td><td style='text-align:left;width:35%;padding-left:5px;'> &nbsp; </td><td style='width: 13%;text-align:left;padding-left:5px;'></td><td style=' background:#ffffff;'></td>
											<td></td><td style='text-align:left;width:35%;padding-left:5px;'> &nbsp; </td><td style='width: 13%;text-align:left;padding-left:5px;'></td>
										</tr>
                                        
                                        <tr class='$packageClass'>
											<td>9. </td><td style='text-align:left;width:35%;padding-left:5px;'>Planned Date of Bid Evaluation Report:</td><td style='width: 13%; text-align:left;padding-left:5px;'>$bpes_51a_null $bpes_51a_date</td><td style=' background:#ffffff;'></td>
											<td></td><td style='text-align:left;width:35%;padding-left:5px;'> </td><td style='width:13%;text-align:left;padding-left:5px;'></td>
										</tr>
										
										<tr style='background:#DDDDDD;'>
											<td>10.</td><td style='text-align:left;width:35%;padding-left:5px;'>Date of Bid Evaluation Report:</td><td style='width: 13%; text-align:left;padding-left:5px;'>$bpes_56_null $bpes_56_date</td><td style=' background:#ffffff;'></td>
											<td>11.</td><td style='text-align:left;width:35%;padding-left:5px;'> Recommended for Awarding the 1st Lowest Evaluated Responsive Bidder?:</td><td style='width:13%;text-align:left;padding-left:5px;'>$bpes_87 </td>
										</tr>
										
										<tr class='$packageClass'>
											<td>12</td><td style='text-align:left;width:35%;padding-left:5px;'> Recommended Price of 1st Lowest Evaluated Responsive Bidder (in evaluation currency):</td><td style='width: 13%;text-align:left;padding-left:5px;'>".number_format($bpes_95a,2)." </td><td style=' background:#ffffff;'></td>
											<td>15.</td><td style='text-align:left;width:35%;padding-left:5px;'> Recommendation for Re-invitation for Bids:</td><td style='width:13%;text-align:left;padding-left:5px;'>$bpes_113</td>
										</tr>
										
										<tr style='background:#DDDDDD;'>
											<td>13.</td><td style='text-align:left;width:35%;padding-left:5px;'>Evaluated Bid Price of 1st Lowest Evaluated Responsive Bidder (Equiv. US$):</td><td style='width: 13%; text-align:left;padding-left:5px;'>".number_format($bpes_97,2)."</td><td style=' background:#ffffff;'></td>
											<td>16.</td><td style='text-align:left;width:35%;padding-left:5px;'> Number of Complaints Received by EA : </td><td style='width:13%;text-align:left;padding-left:5px;'>$bpes_102 </td>
										</tr>
                                        
                                      <tr class='$packageClass'>
											<td>14.</td><td style='text-align:left;width:35%;padding-left:5px;'>Evaluated Bid Price of 2nd Lowest Evaluated Responsive Bidder (Equiv. US$):</td><td style='width: 13%;text-align:left;padding-left:5px;'>".number_format($bpes_98,2)." </td><td style=' background:#ffffff;'></td>
											<td>17.</td><td style='text-align:left;width:35%;padding-left:5px;'> Fraud and Corruption Detected by EA:</td><td style='width:13%;text-align:left;padding-left:5px;'>$bpes_103</td>
										</tr>

										<tr style='background:#DDDDDD;'>
											<td></td><td style='text-align:left;width:35%;padding-left:5px;'></td><td style='width: 13%;text-align:left;padding-left:5px;'> </td><td style=' background:#ffffff;'></td>
											<td>18.</td><td style='text-align:left;width:35%;padding-left:5px;'> Short Description of F&C Detected:</td><td style='width:13%;text-align:left;padding-left:5px;'>$bpes_104</td>
										</tr>
										
					
					
					
					
					
										<tr style='background:#ffffff;'>
											<td></td><td style='text-align:left;width:35%;padding-left:5px;'> &nbsp; </td><td style='width: 13%;text-align:left;padding-left:5px;'> &nbsp; </td><td style=' background:#ffffff;'></td>
											<td></td><td style='text-align:left;width:35%;padding-left:5px;'> &nbsp; </td><td style='width: 13%;text-align:left;padding-left:5px;'> &nbsp; </td>
										</tr>
									
										<tr style='background:#ffffff;'>
											<td style='text-align:left;width:100%;padding-left:5px;font-size:12px;' colspan='7'><center>Last Updated: <b>$entDatebpes</b>, Updated By: <b>$userName</b></center></td>
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
										<form action='bidProposalEvaluationStage.php' method='post' target='_blank'>
										<input type='hidden' name='pi_4' id='pi_4' value='$pi_4' />
										<input type='hidden' name='pi_5' id='pi_5' value='$pi_5' />
										<input type='hidden' name='pi_6' id='pi_6' value='$pi_6' />
										<input type='hidden' name='packageId' value='$packageID'/>
										<input type='hidden' name='packageName' value='$packageName'/>
										<input type='submit' name='bidProposalEvaluationStageSubmit'  value='No Data Found Insert New Data'/>
										</form>
										</td>
										<td>
                                      <script  type='text/javascript'>		
														$(document).ready(function() {			
															$('#viewEvalutionStage{$packageID}').click(function(){					
																var packageIdEvalutionStage 			= $('#packageIdEvalutionStage{$packageID}').val();
																var userIdEvalutionStage				= $('#userIdEvalutionStage{$packageID}').val();	
																var pi_4BEvalutionStage					= $('#pi_4BEvalutionStage{$packageID}').val();
																var pi_5BEvalutionStage					= $('#pi_5BEvalutionStage{$packageID}').val();	
																var pi_6EvalutionStage					= $('#pi_6EvalutionStage{$packageID}').val();	
																var packageNameEvalutionStage			= $('#packageNameEvalutionStage{$packageID}').val();																							
															$('#viewEvalutionStage{$packageID}').html();																	
																$.post('ajax/getVieweEvalutionStage.php',{'packageIdEvalutionStage': packageIdEvalutionStage, 'userIdEvalutionStage': userIdEvalutionStage, 'pi_4BEvalutionStage': pi_4BEvalutionStage,'pi_5BEvalutionStage': pi_5BEvalutionStage, 'pi_6EvalutionStage': pi_6EvalutionStage, 'packageNameEvalutionStage':packageNameEvalutionStage},
																function(data)
																{  	
																	$('#showResultsEvalutionStage{$packageID}').html(data);
																});
															})				 
														});		
												</script>
													
													<form method='post'>					
														<input type='hidden' name='packageIdEvalutionStage' id='packageIdEvalutionStage{$packageID}' value='$packageID' />
														<input type='hidden' name='userIdEvalutionStage' id='userIdEvalutionStage{$packageID}' value='$userId' />
														<input type='hidden' name='pi_4EvalutionStage' id='pi_4BEvalutionStage{$packageID}' value='$pi_4' />
														<input type='hidden' name='pi_5EvalutionStage' id='pi_5BEvalutionStage{$packageID}' value='$pi_5' />
														<input type='hidden' name='pi_6EvalutionStage' id='pi_6EvalutionStage{$packageID}' value='$pi_6' />
														<input type='hidden' name='packageNameEvalutionStage' id='packageNameEvalutionStage{$packageID}' value='$packageName' />
														<input type='button' name='viewEvalutionStage{$packageID}' id='viewEvalutionStage{$packageID}' value='Refresh' class='FormSubmitBtn' />	
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
