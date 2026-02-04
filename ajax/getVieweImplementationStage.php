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
        $packageID 					= $_REQUEST['packageIdImplementationStage'];    
		$userId 					= $_REQUEST['userIdImplementationStage'];
		$pi_4 						= $_REQUEST['pi_4ImplementationStage'];
		$pi_5 						= $_REQUEST['pi_5ImplementationStage'];
		$pi_6 						= $_REQUEST['pi_6ImplementationStage'];
		$packageName 				= $_REQUEST['packageNameImplementationStage'];

		
		$psSql	= "SELECT * FROM s_user WHERE USER_ID='".$userId."' ORDER BY USER_ID";
		$psSqlStatement		= mysql_query($psSql);
		$psSqlStatementData	= mysql_fetch_array($psSqlStatement);
		$userName       	= $psSqlStatementData["USER_NAME"];
		
		//  Change this only	end	 Start				
	$packageQuery = "
								SELECT
										adbs_contractmanagementstage.cms_71,
										adbs_contractmanagementstage.cms_72a,
										adbs_contractmanagementstage.cms_73,
										adbs_contractmanagementstage.cms_74,
										adbs_contractmanagementstage.cms_75,
										adbs_contractmanagementstage.cms_75a,
										adbs_contractmanagementstage.cms_107,
										adbs_contractmanagementstage.cms_108,
										adbs_contractmanagementstage.cms_109,
										adbs_contractmanagementstage.cms_10,
										adbs_contractmanagementstage.cms_12,
										adbs_contractmanagementstage.entDate
								FROM
										adbs_contractmanagementstage
								WHERE
										adbs_contractmanagementstage.pId='$packageID'
								ORDER BY
										adbs_contractmanagementstage.cmsId
							  ";	
	
		$packageView .= " <!-- Tab 8 Start -->
                            <div id='tabs{$packageID}-8'>
							  <div id='showResultsAImplementationStage{$packageID}'>
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
						
						$cms_72a		  = $packageStatementData["cms_72a"];
						$cms_72a_null = '';
						$cms_72a_date = '';
						if ($cms_72a=='0000-00-00'){
							$cms_72a_null = '';
						}
						else{$cms_72a_date = showDateFormat($packageStatementData["cms_72a"]);}
						
						$cms_71		  = $packageStatementData["cms_71"];
						$cms_71_null = '';
						$cms_71_date = '';
						if ($cms_71=='0000-00-00'){
							$cms_71_null = '';
						}
						else{$cms_71_date = showDateFormat($packageStatementData["cms_71"]);}
						
						$cms_73		  = $packageStatementData["cms_73"];
						$cms_73_null = '';
						$cms_73_date = '';
						if ($cms_73=='0000-00-00'){
							$cms_73_null = '';
						}
						else{$cms_73_date = showDateFormat($packageStatementData["cms_73"]);}
						
						$cms_74		  = $packageStatementData["cms_74"];
						$cms_74_null = '';
						$cms_74_date = '';
						if ($cms_74=='0000-00-00'){
							$cms_74_null = '';
						}
						else{$cms_74_date = showDateFormat($packageStatementData["cms_74"]);}
						
						$cms_75		  = $packageStatementData["cms_75"];
						$cms_75_null = '';
						$cms_75_date = '';
						if ($cms_75=='0000-00-00'){
							$cms_75_null = '';
						}
						else{$cms_75_date = showDateFormat($packageStatementData["cms_75"]);}
						
						$cms_75a		  = $packageStatementData["cms_75a"];
						$cms_75a_null = '';
						$cms_75a_date = '';
						if ($cms_75a=='0000-00-00'){
							$cms_75a_null = '';
						}
						else{$cms_75a_date = showDateFormat($packageStatementData["cms_75a"]);}
						
						
						$cms_107        = $packageStatementData["cms_107"];
						$cms_108        = $packageStatementData["cms_108"];
						$cms_109		= $packageStatementData["cms_109"];
						$cms_10         = $packageStatementData["cms_10"];
						$cms_12         = $packageStatementData["cms_12"];
						$entDatecms     = showDateFormat($packageStatementData["entDate"]);
						
						$packageView .= "
										<tr class='$packageClass'>
											<td colspan='5' style='text-align:left;background:#ffffff;'>
												<p style='font-size:17px;'>Contract Implementation :</p>	
											</td>
											<td colspan='2' style='text-align:right;background:#ffffff;padding-left: 24%;'>
											
											 <table style='text-align:right;background:#ffffff;'><tr>
													<td style='text-align:right;background:#ffffff;'>
													
													<script  type='text/javascript'>		
															$(document).ready(function() {			
																$('#viewImplementationStage{$packageID}').click(function(){					
																	var packageIdImplementationStage 			= $('#packageIdImplementationStage{$packageID}').val();
																	var userIdImplementationStage				= $('#userIdImplementationStage{$packageID}').val();	
																	var pi_4ImplementationStage					= $('#pi_4ImplementationStage{$packageID}').val();
																	var pi_5ImplementationStage					= $('#pi_5ImplementationStage{$packageID}').val();	
																	var pi_6ImplementationStage					= $('#pi_6ImplementationStage{$packageID}').val();	
																	var packageNameImplementationStage			= $('#packageNameImplementationStage{$packageID}').val();																							
																$('#viewImplementationStage{$packageID}').html();																	
																	$.post('ajax/getVieweImplementationStage.php',{'packageIdImplementationStage': packageIdImplementationStage, 'userIdImplementationStage': userIdImplementationStage, 'pi_4ImplementationStage': pi_4ImplementationStage, 'pi_5ImplementationStage': pi_5ImplementationStage, 'pi_6ImplementationStage': pi_6ImplementationStage, 'packageNameImplementationStage':packageNameImplementationStage},
																	function(data)
																	{  	
																		$('#showResultsAImplementationStage{$packageID}').html(data);
																	});
																})				 
															});		
													</script>
													
													<form method='post'>					
														<input type='hidden' name='packageIdImplementationStage' id='packageIdImplementationStage{$packageID}' value='$packageID' />
														<input type='hidden' name='userIdImplementationStage' id='userIdImplementationStage{$packageID}' value='$userId' />
														<input type='hidden' name='pi_4ImplementationStage' id='pi_4ImplementationStage{$packageID}' value='$pi_4' />
														<input type='hidden' name='pi_5ImplementationStage' id='pi_5ImplementationStage{$packageID}' value='$pi_5' />
														<input type='hidden' name='pi_6ImplementationStage' id='pi_6ImplementationStage{$packageID}' value='$pi_6' />
														<input type='hidden' name='packageNameImplementationStage' id='packageNameImplementationStage{$packageID}' value='$packageName' />
														<input type='button' name='viewImplementationtage{$packageID}' id='viewImplementationStage{$packageID}' value='Refresh' class='FormSubmitBtn' />	
													</form>		
													</td>
													<td style='text-align:right;background:#ffffff;'>
													<form action='contractingManagementStageEdit.php' method='post' target='_blank'>
														<input type='hidden' name='pi_4' value='$pi_4'/>
														<input type='hidden' name='pi_5' value='$pi_5'/>
														<input type='hidden' name='pi_6' value='$pi_6'/>
														<input type='hidden' name='packageId' value='$packageID'/>
														<input type='hidden' name='packageName' value='$packageName'/>
														<input type='submit' name='editSubmitContractingManagementStage'  value='Update Info'/>
													</form>
													</td>
												</tr>
											 </table>

											</td>
										</tr>
										
										<tr class='$packageClass'>
											<td>1.</td><td style='text-align:left;width:35%;padding-left:5px;'> Commencement Date:</td><td style='width: 13%; text-align:left;padding-left:5px;'> $cms_71_null $cms_71_date</td><td style=' background:#ffffff;'></td>
											<td>5.</td><td style='text-align:left;width:35%;padding-left:5px;'> Number of Contract Amendments /Variation Orders:</td><td style='width:13%;text-align:left;padding-left:5px;'> $cms_107</td>
										</tr>
										
										<tr style='background:#DDDDDD;'>
											<td>2.</td><td style='text-align:left;width:35%;padding-left:5px;'> Revised Planned Completion Date:</td><td style='width: 13%;text-align:left;padding-left:5px;'> $cms_73_null $cms_73_date</td><td style=' background:#ffffff;'></td>
											<td>6.</td><td style='text-align:left;width:35%;padding-left:5px;'> Revised Contract Price in Contract Currency or Currencies:</td><td style='width: 13%;text-align:left;padding-left:5px;'>$cms_10</td>
										</tr>
										
										<tr style='background:#DDDDDD;'>
											<td>3.</td><td style='text-align:left;width:35%;padding-left:5px;'> Actual Completion Date:</td><td style='width: 13%;text-align:left;padding-left:5px;'> $cms_74_null $cms_74_date</td><td style=' background:#ffffff;'></td>
											<td>7.</td><td style='text-align:left;width:35%;padding-left:5px;'>Revised Contract Price (Equiv. US$):</td><td style='width: 13%;text-align:left;padding-left:5px;'>".number_format($cms_12,2)."</td>
										</tr>
										
										<tr class='$packageClass'>
											<td>4.</td><td style='text-align:left;width:35%;padding-left:5px;'>Final Acceptance Date:</td><td style='width: 13%; text-align:left;padding-left:5px;'>$cms_75_null $cms_75_date</td><td style=' background:#ffffff;'></td>
											<td>8.</td><td style='text-align:left;width:35%;padding-left:5px;'> Defect Liability Period End Date:</td><td style='width:13%;text-align:left;padding-left:5px;'> $cms_75a_null $cms_75_date</td>
											
										</tr>
										
									
									
									
									
										<tr style='background:#ffffff;'>
											<td></td><td style='text-align:left;width:35%;padding-left:5px;'> &nbsp; </td><td style='width: 13%;text-align:left;padding-left:5px;'> &nbsp; </td><td style=' background:#ffffff;'></td>
											<td></td><td style='text-align:left;width:35%;padding-left:5px;'> &nbsp; </td><td style='width: 13%;text-align:left;padding-left:5px;'> &nbsp; </td>
										</tr>
										<tr style='background:#ffffff;'>
											<td style='text-align:left;width:100%;padding-left:5px;font-size:12px;' colspan='7'><center>Last Updated: <b>$entDatecms</b>, Updated By: <b>$userName</b></center></td>
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
										<form action='contractManagementStage.php' method='post' target='_blank'>
										<input type='hidden' name='packageId' value='$packageID'/>
										<input type='hidden' name='packageName' value='$packageName'/>
										<input type='hidden' name='pi_4' id='pi_4' value='$pi_4' />
										<input type='hidden' name='pi_5' id='pi_5' value='$pi_5' />
										<input type='hidden' name='pi_6' id='pi_6' value='$pi_6' />
										<input type='submit' name='contractManagementStageSubmit'  value='No Data Found Insert New Data'/>
										</form>
										</td>
										<td>
                                      <script  type='text/javascript'>		
															$(document).ready(function() {			
																$('#viewImplementationStage{$packageID}').click(function(){					
																	var packageIdImplementationStage 			= $('#packageIdImplementationStage{$packageID}').val();
																	var userIdImplementationStage				= $('#userIdImplementationStage{$packageID}').val();	
																	var pi_4ImplementationStage					= $('#pi_4ImplementationStage{$packageID}').val();
																	var pi_5ImplementationStage					= $('#pi_5ImplementationStage{$packageID}').val();	
																	var pi_6ImplementationStage					= $('#pi_6ImplementationStage{$packageID}').val();	
																	var packageNameImplementationStage			= $('#packageNameImplementationStage{$packageID}').val();																							
																$('#viewImplementationStage{$packageID}').html();																	
																	$.post('ajax/getVieweImplementationStage.php',{'packageIdImplementationStage': packageIdImplementationStage, 'userIdImplementationStage': userIdImplementationStage, 'pi_4ImplementationStage': pi_4ImplementationStage, 'pi_5ImplementationStage': pi_5ImplementationStage, 'pi_6ImplementationStage': pi_6ImplementationStage, 'packageNameImplementationStage':packageNameImplementationStage},
																	function(data)
																	{  	
																		$('#showResultsAImplementationStage{$packageID}').html(data);
																	});
																})				 
															});		
													</script>
													
													<form method='post'>					
														<input type='hidden' name='packageIdImplementationStage' id='packageIdImplementationStage{$packageID}' value='$packageID' />
														<input type='hidden' name='userIdImplementationStage' id='userIdImplementationStage{$packageID}' value='$userId' />
														<input type='hidden' name='pi_4ImplementationStage' id='pi_4ImplementationStage{$packageID}' value='$pi_4' />
														<input type='hidden' name='pi_5ImplementationStage' id='pi_5ImplementationStage{$packageID}' value='$pi_5' />
														<input type='hidden' name='pi_6ImplementationStage' id='pi_6ImplementationStage{$packageID}' value='$pi_6' />
														<input type='hidden' name='packageNameImplementationStage' id='packageNameImplementationStage{$packageID}' value='$packageName' />
														<input type='button' name='viewImplementationtage{$packageID}' id='viewImplementationStage{$packageID}' value='Refresh' class='FormSubmitBtn' />	
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
