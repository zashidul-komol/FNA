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
        $packageID 					= $_REQUEST['packageIdPQStage'];  
		$userId 					= $_REQUEST['userIdPQStage'];
		$pi_4 						= $_REQUEST['pi_4PQStage'];
		$pi_5 						= $_REQUEST['pi_5PQStage'];
		$pi_6 						= $_REQUEST['pi_6PQStage']; 
		$adbPackageName 		= $_REQUEST['adbPackageNamePQStage'];
		
		$psSql	= "SELECT * FROM s_user WHERE USER_ID='".$userId."' ORDER BY USER_ID";
		$psSqlStatement		= mysql_query($psSql);
		$psSqlStatementData	= mysql_fetch_array($psSqlStatement);
		$userName       	= $psSqlStatementData["USER_NAME"];
		
		//  Change this only	end	 Start				
			
		$packageQuery = "
								SELECT
										adbs_pqstage.pqs_20,
										adbs_pqstage.pqs_21,
										adbs_pqstage.pqs_22,
										adbs_pqstage.pqs_22a,
										adbs_pqstage.pqs_23,
										adbs_pqstage.pqs_24,
										adbs_pqstage.pqs_25,
										adbs_pqstage.pqs_26,
										adbs_pqstage.pqs_27,
										adbs_pqstage.pqs_27a,
										adbs_pqstage.pqs_28,
										
										adbs_pqstage.pqs_81,
										adbs_pqstage.pqs_82,
										adbs_pqstage.pqs_83,
										adbs_pqstage.pqs_102,
										adbs_pqstage.pqs_103,
										adbs_pqstage.pqs_104,
										adbs_pqstage.entDate
								FROM
										adbs_pqstage
								WHERE
										adbs_pqstage.pId='$packageID'
								ORDER BY
										adbs_pqstage.pqsId 
							  ";	
			$packageView .= " 
							<!-- Tab 2 Start -->
							
                            <div id='tabs{$packageID}-2'>
							    <div id='showResultsPQStage{$packageID}'>
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
						
						$pqs_20_null = '';
						$pqs_20_date = '';
						$pqs_20         = $packageStatementData["pqs_20"];
						if ($pqs_20=='0000-00-00'){
							$pqs_20_null = '';
						}
						else{$pqs_20_date = showDateFormat($packageStatementData["pqs_20"]);}
						
						$pqs_22a_null = '';
						$pqs_22a_date = '';
						$pqs_22a         = $packageStatementData["pqs_22a"];
						if ($pqs_22a=='0000-00-00'){
							$pqs_22a_null = '';
						}
						else{$pqs_22a_date = showDateFormat($packageStatementData["pqs_22a"]);}
						
						$pqs_21         = $packageStatementData["pqs_21"];
						$pqs_21_null = '';
						$pqs_21_date = '';
						if ($pqs_21=='0000-00-00'){
							$pqs_21_null = '';
						}
						else{$pqs_21_date = showDateFormat($packageStatementData["pqs_21"]);}
						
						$pqs_22         = $packageStatementData["pqs_22"];
						$pqs_22_null = '';
						$pqs_22_date = '';
						if ($pqs_22=='0000-00-00'){
							$pqs_22_null = '';
						}
						else{$pqs_22_date = showDateFormat($packageStatementData["pqs_22"]);}
						
						$pqs_23         = $packageStatementData["pqs_23"];
						$pqs_23_null = '';
						$pqs_23_date = '';
						if ($pqs_23=='0000-00-00'){
							$pqs_23_null = '';
						}
						else{$pqs_23_date = showDateFormat($packageStatementData["pqs_23"]);}
						
						$pqs_24         = $packageStatementData["pqs_24"];
						$pqs_24_null = '';
						$pqs_24_date = '';
						if ($pqs_24=='0000-00-00'){
							$pqs_24_null = '';
						}
						else{$pqs_24_date = showDateFormat($packageStatementData["pqs_24"]);}
						
						$pqs_25         = $packageStatementData["pqs_25"];
						$pqs_25_null = '';
						$pqs_25_date = '';
						if ($pqs_25=='0000-00-00'){
							$pqs_25_null = '';
						}
						else{$pqs_25_date = showDateFormat($packageStatementData["pqs_25"]);}
						
						$pqs_26		    = $packageStatementData["pqs_26"];
						$pqs_26_null = '';
						$pqs_26_date = '';
						if ($pqs_26=='0000-00-00'){
							$pqs_26_null = '';
						}
						else{$pqs_26_date = showDateFormat($packageStatementData["pqs_26"]);}
						
						$pqs_27         = $packageStatementData["pqs_27"];
						$pqs_27_null = '';
						$pqs_27_date = '';
						if ($pqs_27=='0000-00-00'){
							$pqs_27_null = '';
						}
						else{$pqs_27_date = showDateFormat($packageStatementData["pqs_27"]);}
						
						$pqs_27a         = $packageStatementData["pqs_27a"];
						$pqs_27a_null = '';
						$pqs_27a_date = '';
						if ($pqs_27a=='0000-00-00'){
							$pqs_27a_null = '';
						}
						else{$pqs_27a_date = showDateFormat($packageStatementData["pqs_27a"]);}
						
						$pqs_28         = $packageStatementData["pqs_28"];
						$pqs_28_null = '';
						$pqs_28_date = '';
						if ($pqs_28=='0000-00-00'){
							$pqs_28_null = '';
						}
						else{$pqs_28_date = showDateFormat($packageStatementData["pqs_28"]);}
						
						$pqs_81		    = $packageStatementData["pqs_81"];
						$pqs_82		    = $packageStatementData["pqs_82"];
						$pqs_83		    = $packageStatementData["pqs_83"];
						$pqs_102        = $packageStatementData["pqs_102"];
						$pqs_103        = $packageStatementData["pqs_103"];
						$pqs_104        = $packageStatementData["pqs_104"];
						$entDatePQ      = showDateFormat($packageStatementData["entDate"]);
						
						
						
						$packageView .= "
										<tr class='$packageClass'>
											<td colspan='5' style='text-align:left;background:#ffffff;'>
												<p style='font-size:17px;'>Prequalification Stage:</p>	
											</td>
											<td colspan='2' style='text-align:right;background:#ffffff;padding-left: 24%;'>
											<table style='text-align:right;background:#ffffff;'><tr>
												<td style='text-align:right;background:#ffffff;'>
												
												<script  type='text/javascript'>		
														$(document).ready(function() {			
															$('#viewPQStage{$packageID}').click(function(){					
																var packageIdPQStage 				= $('#packageIdPQStage{$packageID}').val();
																var userIdPQStage					= $('#userIdPQStage{$packageID}').val();
																var pi_4PQStage						= $('#pi_4PQStage{$packageID}').val();
																var pi_5PQStage						= $('#pi_5PQStage{$packageID}').val();
																var pi_6PQStage						= $('#pi_6PQStage{$packageID}').val();
																var adbPackageNamePQStage			= $('#adbPackageNamePQStage{$packageID}').val();																								
															$('#viewPQStage{$packageID}').html();																	
																$.post('ajax/getViewePQStage.php',{'packageIdPQStage': packageIdPQStage, 'pi_4PQStage':pi_4PQStage, 'pi_5PQStage':pi_5PQStage, 'pi_6PQStage':pi_6PQStage, 'adbPackageNamePQStage':adbPackageNamePQStage, 'userIdPQStage':userIdPQStage},
																function(data)
																{  	
																	$('#showResultsPQStage{$packageID}').html(data);
																});
															})				 
														});		
												</script>
												
												<form method='post'>					
												<input type='hidden' name='packageIdPQStage' id='packageIdPQStage{$packageID}' value='$packageID' />
												<input type='hidden' name='userIdPQStage' id='userIdPQStage{$packageID}' value='$userId' />
												<input type='hidden' name='pi_4PQStage' id='pi_4PQStage{$packageID}' value='$pi_4' />
												<input type='hidden' name='pi_5PQStage' id='pi_5PQStage{$packageID}' value='$pi_5' />
												<input type='hidden' name='pi_6PQStage' id='pi_6PQStage{$packageID}' value='$pi_6' />
												<input type='hidden' name='adbPackageNamePQStage' id='adbPackageNamePQStage{$packageID}' value='$adbPackageName' />
												<input type='button' name='viewPQStage{$packageID}' id='viewPQStage{$packageID}' value='Refresh' class='FormSubmitBtn' />	
												</form>		
												</td>
												
												<td style='text-align:right;background:#ffffff;'>
												<form action='pqStageEdit.php' method='post' target='_blank'>
													<input type='hidden' name='pi_4' value='$pi_4'/>
													<input type='hidden' name='pi_5' value='$pi_5'/>
													<input type='hidden' name='pi_6' value='$pi_6'/>
													<input type='hidden' name='packageId' value='$packageID'/>
													<input type='hidden' name='packageName' value='$adbPackageName'/>
													<input type='submit' name='editSubmitPQStage'  value='Update Info'/>
												</form>
												</td>
											</tr></table>
											</td>
										</tr>
										
							 			<tr class='$packageClass'>
											<td>1.</td><td style='text-align:left;width:30%;padding-left:5px;'> Date of Sending DPQD to ADB:</td><td style='width: 18%; text-align:left;padding-left:5px;'> $pqs_20_null $pqs_20_date</td><td style=' background:#ffffff;'></td>
											<td>4.</td><td style='text-align:left;width:30%;padding-left:5px;'> Date of Issuance of Invitation for PQ (IFPQ):</td><td style='width:18%;text-align:left;padding-left:5px;'>  $pqs_22a_null $pqs_22a_date</td>
										</tr>
										
										<tr style='background:#DDDDDD;'>
										   	<td>2.</td><td style='text-align:left;width:30%;padding-left:5px;'> Date of ADB's NOL on DPQD:</td><td style='width: 18%; text-align:left;padding-left:5px;'> $pqs_21_null $pqs_21_date </td><td style=' background:#ffffff;'></td>
											<td>5.</td><td style='text-align:left;width:30%;padding-left:5px;'> Original Date of PQ Submission Deadline:</td><td style='width: 18%;text-align:left;padding-left:5px;'>$pqs_23_null $pqs_23_date</td>
										</tr>
										
										<tr class='$packageClass'>
											<td>3.</td><td style='text-align:left;width:30%;padding-left:5px;'>Date of EA's Approval on PQD :</td><td style='width: 18%;text-align:left;padding-left:5px;'>$pqs_22_null $pqs_22_date</td><td style=' background:#ffffff;'></td>
											<td>6.</td><td style='text-align:left;width:30%;padding-left:5px;'> Revised Date of PQ Submission Deadline:</td><td style='width: 18%;text-align:left;padding-left:5px;'> $pqs_24_null $pqs_24_date</td>
										</tr>
                                        
										<tr style='background:#ffffff;'>
											<td></td><td style='text-align:left;width:30%;padding-left:5px;'>&nbsp;  </td><td style='width: 18%;text-align:left;padding-left:5px;'>&nbsp;  </td><td style=' background:#ffffff;'></td>
											<td></td><td style='text-align:left;width:30%;padding-left:5px;'>&nbsp;  </td><td style='width: 18%;text-align:left;padding-left:5px;'>&nbsp;  </td>
										</tr>
                                        
										<tr style='background:#DDDDDD;'>
											<td>7.</td><td style='text-align:left;width:30%;padding-left:5px;'> Date of PQ Evaluation Report:</td><td style='width: 18%;text-align:left;padding-left:5px;'> $pqs_25_null $pqs_25_date</td><td style=' background:#ffffff;'></td>
											<td>12.</td><td style='text-align:left;width:30%;padding-left:5px;'>Number of PQD sold/ Issued:</td><td style='width: 18%;text-align:left;padding-left:5px;'>$pqs_81</td>
										</tr>
										
										<tr class='$packageClass'>
											<td>8.</td><td style='text-align:left;width:30%;padding-left:5px;'> Date of Sending PQ Evaluation Report to ADB:</td><td style='width: 18%;text-align:left;padding-left:5px;'>$pqs_26_null $pqs_26_date</td><td style=' background:#ffffff;'></td>
											<td>13.</td><td style='text-align:left;width:30%;padding-left:5px;'> Number of PQ Applications:</td><td style='width: 18%;text-align:left;padding-left:5px;'>$pqs_82</td>
										</tr>
										
										<tr style='background:#DDDDDD;'>
											<td>9.</td><td style='text-align:left;width:30%;padding-left:5px;'>Date of ADB's NOL on PQ Evaluation Report:</td><td style='width: 18%;text-align:left;padding-left:5px;'>$pqs_27_null $pqs_27_date</td><td style=' background:#ffffff;'></td>
											<td>14.</td><td style='text-align:left;width:30%;padding-left:5px;'> Number of Prequalified Bidders:</td><td style='width:18%;text-align:left;padding-left:5px;'>$pqs_83</td>
										</tr>
                                        
										<tr class='$packageClass'>
											<td>10.</td><td style='text-align:left;width:30%;padding-left:5px;'>Date of EA's Approval on PQ Evaluation Report:</td><td style='width: 18%;text-align:left;padding-left:5px;'>$pqs_27a_null $pqs_27a_date</td><td style=' background:#ffffff;'></td>
											<td>15.</td><td style='text-align:left;width:30%;padding-left:5px;'>Number of Complaints Received by EA :</td><td style='width:18%;text-align:left;padding-left:5px;'>$pqs_102</td>
										</tr>                                        
										
										<tr style='background:#DDDDDD;'>
											<td>11.</td><td style='text-align:left;width:30%;padding-left:5px;'>Date of Notifying PQ Bidders:</td><td style='width: 18%;text-align:left;padding-left:5px;'>$pqs_28_null $pqs_28_date</td><td style=' background:#ffffff;'></td>
											<td>16.</td><td style='text-align:left;width:30%;padding-left:5px;'>Fraud and Corruption (F&C) Detected by EA:</td><td style='width:18%;text-align:left;padding-left:5px;'>$pqs_103</td>
										</tr>
										
										<tr class='$packageClass'>
											<td></td><td style='text-align:left;width:30%;padding-left:5px;'></td><td style='width: 18%;text-align:left;padding-left:5px;'></td><td style=' background:#ffffff;'></td>
											<td>17.</td><td style='text-align:left;width:30%;padding-left:5px;'>Short description of Complaints/  F&C Detected:</td><td style='width:18%;text-align:left;padding-left:5px;'>$pqs_104</td>
										</tr>
										
										
										
										
										
										
										<tr style='background:#ffffff;'>
											<td></td><td style='text-align:left;width:30%;padding-left:5px;'> &nbsp; </td><td style='width: 18%;text-align:left;padding-left:5px;'> &nbsp; </td><td style=' background:#ffffff;'></td>
											<td></td><td style='text-align:left;width:30%;padding-left:5px;'> &nbsp; </td><td style='width: 18%;text-align:left;padding-left:5px;'> &nbsp; </td>
										</tr>	
										
										<tr style='background:#ffffff;'>
											<td style='text-align:left;width:100%;padding-left:5px;font-size:12px;' colspan='7'><center>Last Updated: <b>$entDatePQ</b>, Updated By: <b>$userName</b></center></td>
										</tr>																
										";
						$mv++;

						}
					}
				 else {
					$packageView .= "
									<tr style='background:#F7F4F4'>
										<td colspan='2' style='text-align:center; color:red;'>&nbsp;</td>
									</tr>
									<tr style='background:#F7F4F4'>
										<td colspan='1' style='text-align:center; color:red;'><center> 
										
									<table>	
									  <tr>
										<td>
											<form action='pqStage.php' method='post' target='_blank'>
											<input type='hidden' name='pi_4' id='pi_4' value='$pi_4' />
											<input type='hidden' name='pi_5' id='pi_5' value='$pi_5' />
											<input type='hidden' name='pi_6' id='pi_6' value='$pi_6' />
											<input type='hidden' name='packageId' value='$packageID'/>
											<input type='hidden' name='packageName' value='$adbPackageName'/>
											<input type='submit' name='submitPQStage'  value='No Data Found Insert New Data'/>
											</form>
										</td>
										<td>
											<script  type='text/javascript'>		
														$(document).ready(function() {			
															$('#viewPQStage{$packageID}').click(function(){					
																var packageIdPQStage 				= $('#packageIdPQStage{$packageID}').val();
																var userIdPQStage					= $('#userIdPQStage{$packageID}').val();
																var pi_4PQStage						= $('#pi_4PQStage{$packageID}').val();
																var pi_5PQStage						= $('#pi_5PQStage{$packageID}').val();
																var pi_6PQStage						= $('#pi_6PQStage{$packageID}').val();
																var adbPackageNamePQStage			= $('#adbPackageNamePQStage{$packageID}').val();																								
															$('#viewPQStage{$packageID}').html();																	
																$.post('ajax/getViewePQStage.php',{'packageIdPQStage': packageIdPQStage, 'pi_4PQStage':pi_4PQStage, 'pi_5PQStage':pi_5PQStage, 'pi_6PQStage':pi_6PQStage, 'adbPackageNamePQStage':adbPackageNamePQStage, 'userIdPQStage':userIdPQStage},
																function(data)
																{  	
																	$('#showResultsPQStage{$packageID}').html(data);
																});
															})				 
														});		
												</script>
												
												<form method='post'>					
												<input type='hidden' name='packageIdPQStage' id='packageIdPQStage{$packageID}' value='$packageID' />
												<input type='hidden' name='userIdPQStage' id='userIdPQStage{$packageID}' value='$userId' />
												<input type='hidden' name='pi_4PQStage' id='pi_4PQStage{$packageID}' value='$pi_4' />
												<input type='hidden' name='pi_5PQStage' id='pi_5PQStage{$packageID}' value='$pi_5' />
												<input type='hidden' name='pi_6PQStage' id='pi_6PQStage{$packageID}' value='$pi_6' />
												<input type='hidden' name='adbPackageNamePQStage' id='adbPackageNamePQStage{$packageID}' value='$adbPackageName' />
												<input type='button' name='viewPQStage{$packageID}' id='viewPQStage{$packageID}' value='Refresh' class='FormSubmitBtn' />	
												</form>	
										
											</td>
										  </tr>
										</table>
												
										</center></td>
									</tr>";
				 }
				$packageView .= "</table> ";
				
				
									
								
	echo 	$packageView ;
?>
