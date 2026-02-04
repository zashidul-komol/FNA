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
        $packageID 					= $_REQUEST['packageIdBiddingStage'];    
		$userId 					= $_REQUEST['userIdBiddingStage'];
		$pi_4 						= $_REQUEST['pi_4BiddingStage'];
		$pi_5 						= $_REQUEST['pi_5BiddingStage'];
		$pi_6 						= $_REQUEST['pi_6BiddingStage'];
		$packageName 				= $_REQUEST['packageNameBiddingStage'];

		
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
										adbs_biddingproposalstage.bps_38,
										adbs_biddingproposalstage.bps_38a,
										adbs_biddingproposalstage.bps_39,
										adbs_biddingproposalstage.bps_40,
										adbs_biddingproposalstage.bps_41,
										adbs_biddingproposalstage.bps_42,
										adbs_biddingproposalstage.bps_43,
										adbs_biddingproposalstage.bps_44,
										adbs_biddingproposalstage.bps_45,
										adbs_biddingproposalstage.bps_46,
										adbs_biddingproposalstage.bps_48,
										adbs_biddingproposalstage.bps_49,
										adbs_biddingproposalstage.bps_84,
										adbs_biddingproposalstage.bps_90,
										adbs_biddingproposalstage.bps_91,
										adbs_biddingproposalstage.bps_92,
										adbs_biddingproposalstage.bps_102,
										adbs_biddingproposalstage.entDate
								FROM
										adbs_biddingproposalstage
								WHERE
										adbs_biddingproposalstage.pId='$packageID'
								ORDER BY
										adbs_biddingproposalstage.bps_42
							  ";	
	
		$packageView .= " <!-- Tab 4 Start -->
						
                            <div id='tabs{$packageID}-4'>	
							 <div id='showResultsBiddingStage{$packageID}'>	
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
						
						$bps_38        = $packageStatementData["bps_38"];
						$bps_38_null = '';
						$bps_38_date = '';
						if ($bps_38=='0000-00-00'){
							$bps_38_null = '';
						}
						else{$bps_38_date = showDateFormat($packageStatementData["bps_38"]);}
						
						$bps_38a        = $packageStatementData["bps_38a"];
						$bps_38a_null = '';
						$bps_38a_date = '';
						if ($bps_38a=='0000-00-00'){
							$bps_38a_null = '';
						}
						else{$bps_38a_date = showDateFormat($packageStatementData["bps_38a"]);}
						
						$bps_39        = $packageStatementData["bps_39"];
						$bps_39_null = '';
						$bps_39_date = '';
						if ($bps_39=='0000-00-00'){
							$bps_39_null = '';
						}
						else{$bps_39_date = showDateFormat($packageStatementData["bps_39"]);}
						
						$bps_40		   = $packageStatementData["bps_40"];
						$bps_40_null = '';
						$bps_40_date = '';
						if ($bps_40=='0000-00-00'){
							$bps_40_null = '';
						}
						else{$bps_40_date = showDateFormat($packageStatementData["bps_40"]);}
						
						$bps_41        = $packageStatementData["bps_41"];
						$bps_41_null = '';
						$bps_41_date = '';
						if ($bps_41=='0000-00-00'){
							$bps_41_null = '';
						}
						else{$bps_41_date = showDateFormat($packageStatementData["bps_41"]);}
						
						$bps_42        = $packageStatementData["bps_42"];
						$bps_42_null = '';
						$bps_42_date = '';
						if($pi_18Check == 'Yes'){
							if ($bps_42=='0000-00-00'){
								$bps_42_null = '';
							}
							else{$bps_42_date = showDateFormat($packageStatementData["bps_42"]);}
						}else{
							$bps_42_null = 'N/A';	
						}
						
						$bps_43        = $packageStatementData["bps_43"];
						$bps_43_null = '';
						$bps_43_date = '';
						if ($bps_43=='0000-00-00'){
							$bps_43_null = '';
						}
						else{$bps_43_date = showDateFormat($packageStatementData["bps_43"]);}
						
						$bps_44		   = $packageStatementData["bps_44"];
						$bps_44_null = '';
						$bps_44_date = '';
						if($pi_18Check == 'Yes'){
							if ($bps_44=='0000-00-00'){
								$bps_44_null = '';
							}
							else{$bps_44_date = showDateFormat($packageStatementData["bps_44"]);}
						}else{
							$bps_44_null = 'N/A';	
						}
						
						$bps_45        = $packageStatementData["bps_45"];
						$bps_45_null = '';
						$bps_45_date = '';
						if($pi_18Check == 'Yes'){
							if ($bps_45=='0000-00-00'){
								$bps_45_null = '';
							}
							else{$bps_45_date = showDateFormat($packageStatementData["bps_45"]);}
						}else{
							$bps_45_null = 'N/A';	
						}
						
						$bps_46        = $packageStatementData["bps_46"];
						$bps_46_null = '';
						$bps_46_date = '';
						if ($bps_46=='0000-00-00'){
							$bps_46_null = '';
						}
						else{$bps_46_date = showDateFormat($packageStatementData["bps_46"]);}
						
						$bps_48		   = $packageStatementData["bps_48"];
						$bps_48_null = '';
						$bps_48_date = '';
						if ($bps_48=='0000-00-00'){
							$bps_48_null = '';
						}
						else{$bps_48_date = showDateFormat($packageStatementData["bps_48"]);}
						
						$bps_49        = $packageStatementData["bps_49"];
						$bps_49_null = '';
						$bps_49_date = '';
						if ($bps_49=='0000-00-00'){
							$bps_49_null = '';
						}
						else{$bps_49_date = showDateFormat($packageStatementData["bps_49"]);}
						
						$bps_84        = $packageStatementData["bps_84"];
						$bps_90		   = $packageStatementData["bps_90"];
						$bps_91        = $packageStatementData["bps_91"];
						$bps_92		   = $packageStatementData["bps_92"];
						$bps_102	   = $packageStatementData["bps_102"];
						$entDatebps    = showDateFormat($packageStatementData["entDate"]);
						
						$packageView .= "
										<tr class='$packageClass'>
										<td colspan='5' style='text-align:left;background:#ffffff;'>
												<p style='font-size:17px;'>Bidding Process:</p>	
											</td>
											<td colspan='2' style='text-align:right;background:#ffffff;padding-left: 21%;'>
											
											<table style='text-align:right;background:#ffffff;'><tr>
												<td style='text-align:right;background:#ffffff;'>

												<script  type='text/javascript'>		
														$(document).ready(function() {			
															$('#viewBiddingStage{$packageID}').click(function(){					
																var packageIdBiddingStage 				= $('#packageIdBiddingStage{$packageID}').val();
																var userIdBiddingStage					= $('#userIdBiddingStage{$packageID}').val();	
																var pi_4BiddingStage					= $('#pi_4BiddingStage{$packageID}').val();	
																var pi_5BiddingStage					= $('#pi_5BiddingStage{$packageID}').val();	
																var pi_6BiddingStage					= $('#pi_6BiddingStage{$packageID}').val();	
																var packageNameBiddingStage				= $('#packageNameBiddingStage{$packageID}').val();																							
															$('#viewBiddingStage{$packageID}').html();																	
																$.post('ajax/getVieweBiddingStage.php',{'packageIdBiddingStage': packageIdBiddingStage, 'userIdBiddingStage': userIdBiddingStage, 'pi_4BiddingStage': pi_4BiddingStage, 'pi_5BiddingStage': pi_5BiddingStage, 'pi_6BiddingStage': pi_6BiddingStage, 'packageNameBiddingStage':packageNameBiddingStage},
																function(data)
																{  	
																	$('#showResultsBiddingStage{$packageID}').html(data);
																});
															})				 
														});		
												</script>
												
												<form method='post'>					
													<input type='hidden' name='packageIdBiddingStage' id='packageIdBiddingStage{$packageID}' value='$packageID' />
													<input type='hidden' name='userIdBiddingStage' id='userIdBiddingStage{$packageID}' value='$userId' />
													<input type='hidden' name='pi_4BiddingStage' id='pi_4BiddingStage{$packageID}' value='$pi_4' />
													<input type='hidden' name='pi_5BiddingStage' id='pi_5BiddingStage{$packageID}' value='$pi_5' />
													<input type='hidden' name='pi_6BiddingStage' id='pi_6BiddingStage{$packageID}' value='$pi_6' />
													<input type='hidden' name='packageNameBiddingStage' id='packageNameBiddingStage{$packageID}' value='$packageName' />
													<input type='button' name='viewBiddingStage{$packageID}' id='viewBiddingStage{$packageID}' value='Refresh' class='FormSubmitBtn' />	
												</form>		
												</td>
												
												<td style='text-align:right;background:#ffffff;'>
												<form action='biddingProposalStageEdit.php' method='post' target='_blank'>
													<input type='hidden' name='pi_4' value='$pi_4'/>
													<input type='hidden' name='pi_5' value='$pi_5'/>
													<input type='hidden' name='pi_6' value='$pi_6'/>
													<input type='hidden' name='packageId' value='$packageID'/>
													<input type='hidden' name='packageName' value='$packageName'/>
													<input type='submit' name='editSubmitBiddingProposalStage'  value='Update Info'/>
												</form>
												</td>
											</tr></table>
											</td>
										</tr>
										<tr class='$packageClass'>
											<td>1.</td><td style='text-align:left;width:35%;padding-left:5px;'> Planned Date of Procurement Notice:</td><td style='width: 13%; text-align:left;padding-left:5px;'> $bps_38a_null $bps_38a_date</td><td style=' background:#ffffff;'></td>
											<td>2.</td><td style='text-align:left;width:35%;padding-left:5px;'> Date of Issuance of Invitation for Bids (IFB)/Quotation/DC :</td><td style='width: 13%; text-align:left;padding-left:5px;'> $bps_38_null $bps_38_date</td><td style=' background:#ffffff;'></td>
										</tr>
										
										<tr style='background:#ffffff;'>
											<td></td><td style='text-align:left;width:30%;padding-left:5px;'>&nbsp;  </td><td style='width: 18%;text-align:left;padding-left:5px;'>&nbsp;  </td><td style=' background:#ffffff;'></td>
											<td></td><td style='text-align:left;width:30%;padding-left:5px;'>&nbsp;  </td><td style='width: 18%;text-align:left;padding-left:5px;'>&nbsp;  </td>
										</tr>
										
										<tr style='background:#DDDDDD;'>
											<td>3.</td><td style='text-align:left;width:35%;padding-left:5px;'>Date of Publication of Procurement Notice (IFPQ/ IFB) in National Newspaper in Bangla:</td><td style='width: 13%;text-align:left;padding-left:5px;'>$bps_39_null $bps_39_date</td><td style=' background:#ffffff;'></td>
											<td>5.</td><td style='text-align:left;width:35%;padding-left:5px;'>Date of Publication of Procurement Notice (IFPQ/IFB) in CPTU Website:</td><td style='width: 13%;text-align:left;padding-left:5px;'> $bps_41_null $bps_41_date</td>
										</tr>
										
										<tr class='$packageClass'>
											<td>4.</td><td style='text-align:left;width:35%;padding-left:5px;'>Date of Publication of Procurement Notice (IFPQ/ IFB) in National Newspaper in English:</td><td style='width: 13%;text-align:left;padding-left:5px;'> $bps_40_null $bps_40_date</td><td style=' background:#ffffff;'></td>
											<td>6.</td><td style='text-align:left;width:35%;padding-left:5px;'>Date of Publication of Procurement Notice (IFPQ/IFB) in ADB Website :</td><td style='width: 13%;text-align:left;padding-left:5px;'> $bps_42_null $bps_42_date</td>
										</tr>
										
										<tr style='background:#ffffff;'>
											<td></td><td style='text-align:left;width:30%;padding-left:5px;'>&nbsp;  </td><td style='width: 18%;text-align:left;padding-left:5px;'>&nbsp;  </td><td style=' background:#ffffff;'></td>
											<td></td><td style='text-align:left;width:30%;padding-left:5px;'>&nbsp;  </td><td style='width: 18%;text-align:left;padding-left:5px;'>&nbsp;  </td>
										</tr>
										
										<tr style='background:#DDDDDD;'>
											<td>7.</td><td style='text-align:left;width:35%;padding-left:5px;'> Date of Pre-bid Conference :</td><td style='width: 13%;text-align:left;padding-left:5px;'> $bps_43_null $bps_43_date</td><td style=' background:#ffffff;'></td>
											<td>11.</td><td style='text-align:left;width:35%;padding-left:5px;'> Original Date of Bid Submission Deadline:</td><td style='width: 13%;text-align:left;padding-left:5px;'> $bps_48_null $bps_48_date</td>
										</tr>
										
										<tr class='$packageClass'>
											<td>8.</td><td style='text-align:left;width:35%;padding-left:5px;'> Date of Sending Pre-bid Meeting Minutes, Clarifications &Proposed Amendments (if any) to ADB:</td><td style='width: 13%; text-align:left;padding-left:5px;'>$bps_44_null $bps_44_date</td><td style=' background:#ffffff;'></td>
											<td>12.</td><td style='text-align:left;width:35%;padding-left:5px;'>Revised Date of Bid Submission Deadline:</td><td style='width:13%;text-align:left;padding-left:5px;'>$bps_49_null $bps_49_date</td>
										</tr>
										
										<tr style='background:#DDDDDD;'>
											<td>9.</td><td style='text-align:left;width:35%;padding-left:5px;'>Date of ADB's NOL on Clarifications &Proposed Amendments (if any) Pre-bid Meeting Minutes:</td><td style='width: 13%;text-align:left;padding-left:5px;'> $bps_45_null $bps_45_date</td><td style=' background:#ffffff;'></td>
											<td>13.</td><td style='text-align:left;width:35%;padding-left:5px;'>Number of Bid Documents Sold/ Issued:</td><td style='width: 13%;text-align:left;padding-left:5px;'>$bps_84</td>
										</tr>
										
										<tr class='$packageClass'>
											<td>10.</td><td style='text-align:left;width:35%;padding-left:5px;'> Date of Sending Pre-bid Meeting Minutes, Clarifications & Amendments (if any) to Bidders:</td><td style='width: 13%;text-align:left;padding-left:5px;'>$bps_46_null $bps_46_date</td><td style=' background:#ffffff;'></td>
											<td>14.</td><td style='text-align:left;width:35%;padding-left:5px;'> Number of Amendments to BD:</td><td style='width: 13%;text-align:left;padding-left:5px;'> $bps_90</td>
										</tr>
										
									
									
									
									
									
										<tr style='background:#ffffff;'>
											<td></td><td style='text-align:left;width:35%;padding-left:5px;'> &nbsp; </td><td style='width: 13%;text-align:left;padding-left:5px;'> &nbsp; </td><td style=' background:#ffffff;'></td>
											<td></td><td style='text-align:left;width:35%;padding-left:5px;'> &nbsp; </td><td style='width: 13%;text-align:left;padding-left:5px;'> &nbsp; </td>
										</tr>
									
										<tr style='background:#ffffff;'>
											<td style='text-align:left;width:100%;padding-left:5px;font-size:12px;' colspan='7'><center>Last Updated: <b>$entDatebps</b>, Updated By: <b>$userName</b></center></td>
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
										<form action='biddingProposalStage.php' method='post' target='_blank'>
										<input type='hidden' name='packageId' value='$packageID'/>
										<input type='hidden' name='packageName' value='$packageName'/>
										<input type='hidden' name='pi_4' id='pi_4' value='$pi_4' />
										<input type='hidden' name='pi_5' id='pi_5' value='$pi_5' />
										<input type='hidden' name='pi_6' id='pi_6' value='$pi_6' />
										<input type='submit' name='biddingProposalStageSubmit'  value='No Data Found Insert New Data'/>
										</form>
										</td>
										<td>
                                      <script  type='text/javascript'>		
														$(document).ready(function() {			
															$('#viewBiddingStage{$packageID}').click(function(){					
																var packageIdBiddingStage 				= $('#packageIdBiddingStage{$packageID}').val();
																var userIdBiddingStage					= $('#userIdBiddingStage{$packageID}').val();	
																var pi_4BiddingStage					= $('#pi_4BiddingStage{$packageID}').val();	
																var pi_5BiddingStage					= $('#pi_5BiddingStage{$packageID}').val();	
																var pi_6BiddingStage					= $('#pi_6BiddingStage{$packageID}').val();	
																var packageNameBiddingStage				= $('#packageNameBiddingStage{$packageID}').val();																							
															$('#viewBiddingStage{$packageID}').html();																	
																$.post('ajax/getVieweBiddingStage.php',{'packageIdBiddingStage': packageIdBiddingStage, 'userIdBiddingStage': userIdBiddingStage, 'pi_4BiddingStage': pi_4BiddingStage, 'pi_5BiddingStage': pi_5BiddingStage, 'pi_6BiddingStage': pi_6BiddingStage, 'packageNameBiddingStage':packageNameBiddingStage},
																function(data)
																{  	
																	$('#showResultsBiddingStage{$packageID}').html(data);
																});
															})				 
														});		
												</script>
												
												<form method='post'>					
													<input type='hidden' name='packageIdBiddingStage' id='packageIdBiddingStage{$packageID}' value='$packageID' />
													<input type='hidden' name='userIdBiddingStage' id='userIdBiddingStage{$packageID}' value='$userId' />
													<input type='hidden' name='pi_4BiddingStage' id='pi_4BiddingStage{$packageID}' value='$pi_4' />
													<input type='hidden' name='pi_5BiddingStage' id='pi_5BiddingStage{$packageID}' value='$pi_5' />
													<input type='hidden' name='pi_6BiddingStage' id='pi_6BiddingStage{$packageID}' value='$pi_6' />
													<input type='hidden' name='packageNameBiddingStage' id='packageNameBiddingStage{$packageID}' value='$packageName' />
													<input type='button' name='viewBiddingStage{$packageID}' id='viewBiddingStage{$packageID}' value='Refresh' class='FormSubmitBtn' />	
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
