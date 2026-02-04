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
        $packageID 					= $_REQUEST['packageIdOIStage'];     
		$userId 					= $_REQUEST['userIdOIStage'];
		$pi_4 						= $_REQUEST['pi_4OIStage'];
		$pi_5 						= $_REQUEST['pi_5OIStage'];
		$pi_6 						= $_REQUEST['pi_6OIStage']; 
		$packageName 				= $_REQUEST['packageNameOIStage'];

		
		$psSql	= "SELECT * FROM s_user WHERE USER_ID='".$userId."' ORDER BY USER_ID";
		$psSqlStatement		= mysql_query($psSql);
		$psSqlStatementData	= mysql_fetch_array($psSqlStatement);
		$userName       	= $psSqlStatementData["USER_NAME"];
		
		//  Change this only	end	 Start				
			$packageQuery = "
								SELECT
										adbs_othersinformation.oi_114,
										adbs_othersinformation.oi_120,
										adbs_othersinformation.oi_121,
										adbs_othersinformation.oi_111,
										adbs_othersinformation.oi_112,
										adbs_othersinformation.oi_118,
										adbs_othersinformation.oi_119,
										adbs_othersinformation.entDate
								FROM
										adbs_othersinformation
								WHERE
										adbs_othersinformation.pId='$packageID'
								ORDER BY
										adbs_othersinformation.oiId
							  ";	
	
		$packageView .= " <!-- Tab 10 Start -->
                            <div id='tabs{$packageID}-12'>
								<div id='showResultsOIStage{$packageID}'>
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
						$oi_114         = $packageStatementData["oi_114"];
						$oi_111			= $packageStatementData["oi_111"];
						$oi_112         = $packageStatementData["oi_112"];
						$oi_120         = $packageStatementData["oi_120"];
						$oi_121		    = $packageStatementData["oi_121"];
						$oi_118			= $packageStatementData["oi_118"];
						$oi_119			= $packageStatementData["oi_119"];
						$entDateoi      = showDateFormat($packageStatementData["entDate"]);
						
					
						
						$packageView .= "
										<tr class='$packageClass'>
										<td colspan='5' style='text-align:left;background:#ffffff;'>
												<p style='font-size:17px;'>Others Stage:</p>	
											</td>
											<td colspan='2' style='text-align:right;background:#ffffff;padding-left:24%;'>
												<table style='text-align:right;background:#ffffff;'><tr>
													<td style='text-align:right;background:#ffffff;'>
													
													<script  type='text/javascript'>		
															$(document).ready(function() {			
																$('#viewOIStage{$packageID}').click(function(){					
																	var packageIdOIStage 				= $('#packageIdOIStage{$packageID}').val();
																	var userIdOIStage					= $('#userIdOIStage{$packageID}').val();	
																	var pi_4OIStage						= $('#pi_4OIStage{$packageID}').val();	
																	var pi_5OIStage						= $('#pi_5OIStage{$packageID}').val();	
																	var pi_6OIStage						= $('#pi_6OIStage{$packageID}').val();	
																	var packageNameOIStage				= $('#packageNameOIStage{$packageID}').val();																							
																$('#viewOIStage{$packageID}').html();																	
																	$.post('ajax/getVieweOIStage.php',{'packageIdOIStage': packageIdOIStage, 'userIdOIStage': userIdOIStage, 'pi_4OIStage': pi_4OIStage,'pi_5OIStage': pi_5OIStage, 'pi_6OIStage': pi_6OIStage, 'packageNameOIStage':packageNameOIStage},
																	function(data)
																	{  	
																		$('#showResultsOIStage{$packageID}').html(data);
																	});
																})				 
															});		
													</script>
													
													<form method='post'>					
														<input type='hidden' name='packageIdOIStage' id='packageIdOIStage{$packageID}' value='$packageID' />
														<input type='hidden' name='userIdOIStage' id='userIdOIStage{$packageID}' value='$userId' />
														<input type='hidden' name='pi_4OIStage' id='pi_4OIStage{$packageID}' value='$pi_4' />
														<input type='hidden' name='pi_5OIStage' id='pi_5OIStage{$packageID}' value='$pi_5' />
														<input type='hidden' name='pi_6OIStage' id='pi_6OIStage{$packageID}' value='$pi_6' />
														<input type='hidden' name='packageNameOIStage' id='packageNameOIStage{$packageID}' value='$packageName' />
														<input type='button' name='viewOIStage{$packageID}' id='viewOIStage{$packageID}' value='Refresh' class='FormSubmitBtn' />	
													</form>		
													</td>
													<td style='text-align:right;background:#ffffff;'>
													<form action='othersInformationEdit.php' method='post' target='_blank'>
														<input type='hidden' name='pi_4' value='$pi_4'/>
														<input type='hidden' name='pi_5' value='$pi_5'/>
														<input type='hidden' name='pi_6' value='$pi_6'/>
														<input type='hidden' name='packageId' value='$packageID'/>
														<input type='hidden' name='packageName' value='$packageName'/>
														<input type='submit' name='editSubmitOthersInformation'  value='Update Info'/>
													</form>
													</td>
												</tr>
												</table>

											</td>
										</tr>
										
										
										<tr style='background:#DDDDDD;'>
											<td>1.</td><td style='text-align:left;width:30%;padding-left:5px;'>Number of Disputes Raised by the Parties :</td><td style='width: 18%; text-align:left;padding-left:5px;'>$oi_111</td><td style=' background:#ffffff;'></td>
											<td>2.</td><td style='text-align:left;width:30%;padding-left:5px;'>Number of Unresolved Disputes:</td><td style='width:18%;text-align:left;padding-left:5px;'>$oi_112</td>
										</tr>
										
										<tr style='background:#eeeeee;'>
											<td>3.</td><td style='text-align:left;width:30%;padding-left:5px;'>Dropped/Cancelled:</td><td style='width: 18%; text-align:left;padding-left:5px;'>$oi_118</td><td style=' background:#ffffff;'></td>
											<td>4.</td><td style='text-align:left;width:30%;padding-left:5px;'>Termination:</td><td style='width:18%;text-align:left;padding-left:5px;'>$oi_119</td>
										</tr>
										
										<tr style='background:#DDDDDD;'>
											<td>5.</td><td style='text-align:left;width:30%;padding-left:5px;'>Remarks, if any :</td><td style='width: 18%; text-align:left;padding-left:5px;'>$oi_114</td><td style=' background:#ffffff;'></td>
											<td>&nbsp;</td><td style='text-align:left;width:30%;padding-left:5px;'> &nbsp; </td><td style='width:18%;text-align:left;padding-left:5px;'> &nbsp; </td>
										</tr>
										
										
										
										
										
										<tr style='background:#ffffff;'>
											<td></td><td style='text-align:left;width:30%;padding-left:5px;'> &nbsp; </td><td style='width: 18%;text-align:left;padding-left:5px;'> &nbsp; </td><td style=' background:#ffffff;'></td>
											<td></td><td style='text-align:left;width:30%;padding-left:5px;'> &nbsp; </td><td style='width: 18%;text-align:left;padding-left:5px;'> &nbsp; </td>
										</tr>	
										<tr style='background:#ffffff;'>
											<td style='text-align:left;width:100%;padding-left:10px;font-size:12px;' colspan='7'><center>Last Updated: <b>$entDateoi</b>, Updated By: <b>$userName</b></center></td>
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
										<form action='othersInformation.php' method='post' target='_blank'>
										<input type='hidden' name='pi_4' id='pi_4' value='$pi_4' />
										<input type='hidden' name='pi_5' id='pi_5' value='$pi_5' />
										<input type='hidden' name='pi_6' id='pi_6' value='$pi_6' />
										<input type='hidden' name='packageId' value='$packageID'/>
										<input type='hidden' name='packageName' value='$packageName'/>
										<input type='submit' name='othersInformationSubmit'  value='No Data Found Insert New Data'/>
										</form>
										</td>
										<td>
                                      	
											<script  type='text/javascript'>		
															$(document).ready(function() {			
																$('#viewOIStage{$packageID}').click(function(){					
																	var packageIdOIStage 				= $('#packageIdOIStage{$packageID}').val();
																	var userIdOIStage					= $('#userIdOIStage{$packageID}').val();	
																	var pi_4OIStage						= $('#pi_4OIStage{$packageID}').val();	
																	var pi_5OIStage						= $('#pi_5OIStage{$packageID}').val();	
																	var pi_6OIStage						= $('#pi_6OIStage{$packageID}').val();	
																	var packageNameOIStage				= $('#packageNameOIStage{$packageID}').val();																							
																$('#viewOIStage{$packageID}').html();																	
																	$.post('ajax/getVieweOIStage.php',{'packageIdOIStage': packageIdOIStage, 'userIdOIStage': userIdOIStage, 'pi_4OIStage': pi_4OIStage,'pi_5OIStage': pi_5OIStage, 'pi_6OIStage': pi_6OIStage, 'packageNameOIStage':packageNameOIStage},
																	function(data)
																	{  	
																		$('#showResultsOIStage{$packageID}').html(data);
																	});
																})				 
															});		
													</script>
													
													<form method='post'>					
														<input type='hidden' name='packageIdOIStage' id='packageIdOIStage{$packageID}' value='$packageID' />
														<input type='hidden' name='userIdOIStage' id='userIdOIStage{$packageID}' value='$userId' />
														<input type='hidden' name='pi_4OIStage' id='pi_4OIStage{$packageID}' value='$pi_4' />
														<input type='hidden' name='pi_5OIStage' id='pi_5OIStage{$packageID}' value='$pi_5' />
														<input type='hidden' name='pi_6OIStage' id='pi_6OIStage{$packageID}' value='$pi_6' />
														<input type='hidden' name='packageNameOIStage' id='packageNameOIStage{$packageID}' value='$packageName' />
														<input type='button' name='viewOIStage{$packageID}' id='viewOIStage{$packageID}' value='Refresh' class='FormSubmitBtn' />	
													</form>					
										</td>
									  </tr>
									</table>
												
									</center></td>
							</tr>";					
				}
				$packageView .= "</table>
				
				</div></div>
			";	
									
								
	echo 	$packageView ;
?>
