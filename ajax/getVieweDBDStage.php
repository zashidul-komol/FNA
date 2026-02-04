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
        $packageID 					= $_REQUEST['packageIdDBDStage'];    
		$userId 					= $_REQUEST['userIdDBDStage'];
		$pi_4 						= $_REQUEST['pi_4DBDStage'];
		$pi_5						= $_REQUEST['pi_5DBDStage'];
		$pi_6 						= $_REQUEST['pi_6DBDStage']; 
		$packageName 			   = $_REQUEST['packageNameDBDStage'];

		
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
										adbs_biddingdocumentpreparationstage.bdps_29,
										adbs_biddingdocumentpreparationstage.bdps_30,
										adbs_biddingdocumentpreparationstage.bdps_31,
										adbs_biddingdocumentpreparationstage.bdps_89,
										adbs_biddingdocumentpreparationstage.bdps_90,
										adbs_biddingdocumentpreparationstage.bdps_32,
										adbs_biddingdocumentpreparationstage.entDate
								FROM
										adbs_biddingdocumentpreparationstage
								WHERE
										adbs_biddingdocumentpreparationstage.pId='$packageID'
								ORDER BY
										adbs_biddingdocumentpreparationstage.bdpsId
							  ";	
	
	$packageView .= "<!-- Tab 3 Start -->
				
						<div id='tabs{$packageID}-3'>
						    <div id='showResultsDBDStage{$packageID}'>
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
						
						$bdps_29         = $packageStatementData["bdps_29"];
						$bdps_29_null = '';
						$bdps_29_date = '';
						
						if($pi_18Check =='Yes'){
							if ($bdps_29=='0000-00-00'){
								$bdps_29_null = '';
							}
							else{$bdps_29_date = showDateFormat($packageStatementData["bdps_29"]);
							}
						}else{
							$bdps_29_null = 'N/A';
						}
						
							$bdps_30         = $packageStatementData["bdps_30"];
							$bdps_30_null = '';
							$bdps_30_date = '';
							
						if($pi_18Check =='Yes'){	
							if ($bdps_30=='0000-00-00'){
								$bdps_30_null = '';
							}
							else{$bdps_30_date = showDateFormat($packageStatementData["bdps_30"]);}
						}else{
							$bdps_30_date = 'N/A';
						}
						
						$bdps_31         = $packageStatementData["bdps_31"];
						$bdps_31_null = '';
						$bdps_31_date = '';
						if ($bdps_31=='0000-00-00'){
							$bdps_31_null = '';
						}
						else{$bdps_31_date = showDateFormat($packageStatementData["bdps_31"]);}
						
						$bdps_32         = $packageStatementData["bdps_32"];
						$bdps_32_null = '';
						$bdps_32_date = '';
						if ($bdps_32=='0000-00-00'){
							$bdps_32_null = '';
						}
						else{$bdps_32_date = showDateFormat($packageStatementData["bdps_32"]);}

						if($pi_18Check =='Yes'){
					    	$bdps_89   = $packageStatementData["bdps_89"];
						}else{
							$bdps_89 = 'N/A';
						}
						
						if($pi_18Check =='Yes'){
						$bdps_90        = $packageStatementData["bdps_90"];
						}else{
							$bdps_90 = 'N/A';
						}
						$entDatebdps              = showDateFormat($packageStatementData["entDate"]);
						
						$packageView .= "
										<tr class='$packageClass'>
											<td colspan='5' style='text-align:left;background:#ffffff;'>
												<p style='font-size:16px;'>DBD Stage:</p>	
											</td>
                                             
											<td colspan='2' style='text-align:right;background:#ffffff;padding-left: 24%;'>
											
											<table style='text-align:right;background:#ffffff;'><tr>
												<td style='text-align:right;background:#ffffff;'>
												
												<script  type='text/javascript'>		
														$(document).ready(function() {			
															$('#viewDBDStage{$packageID}').click(function(){					
																var packageIdDBDStage 				= $('#packageIdDBDStage{$packageID}').val();
																var userIdDBDStage					= $('#userIdDBDStage{$packageID}').val();	
																var pi_4DBDStage					= $('#pi_4DBDStage{$packageID}').val();	
																var pi_5DBDStage					= $('#pi_5DBDStage{$packageID}').val();	
																var pi_6DBDStage					= $('#pi_6DBDStage{$packageID}').val();	
																var packageNameDBDStage				= $('#packageNameDBDStage{$packageID}').val();																							
															$('#viewDBDStage{$packageID}').html();																	
																$.post('ajax/getVieweDBDStage.php',{'packageIdDBDStage': packageIdDBDStage, 'pi_4DBDStage': pi_4DBDStage, 'pi_5DBDStage': pi_5DBDStage, 'pi_6DBDStage': pi_6DBDStage, 'packageNameDBDStage': packageNameDBDStage, 'userIdDBDStage':userIdDBDStage},
																function(data)
																{  	
																	$('#showResultsDBDStage{$packageID}').html(data);
																});
															})				 
														});		
												</script>
												
												<form method='post'>					
												<input type='hidden' name='packageIdDBDStage' id='packageIdDBDStage{$packageID}' value='$packageID' />
												<input type='hidden' name='userIdDBDStage' id='userIdDBDStage{$packageID}' value='$userId' />
												<input type='hidden' name='pi_4DBDStage' id='pi_4DBDStage{$packageID}' value='$pi_4' />
												<input type='hidden' name='pi_5DBDStage' id='pi_5DBDStage{$packageID}' value='$pi_5' />
												<input type='hidden' name='pi_6DBDStage' id='pi_6DBDStage{$packageID}' value='$pi_6' />
												<input type='hidden' name='packageNameDBDStage' id='packageNameDBDStage{$packageID}' value='$packageName' />
												<input type='button' name='viewDBDStage{$packageID}' id='viewDBDStage{$packageID}' value='Refresh' class='FormSubmitBtn' />	
												</form>		
												</td>
												
												<td style='text-align:right;background:#ffffff;'>
												<form action='biddingDPStageEdit.php' method='post' target='_blank'>
													<input type='hidden' name='packageId' value='$packageID'/>
													<input type='hidden' name='packageName' value='$packageName'/>
													<input type='hidden' name='pi_4' value='$pi_4'/>
													<input type='hidden' name='pi_5' value='$pi_5'/>
													<input type='hidden' name='pi_6' value='$pi_6'/>
													<input type='submit' name='editSubmitBiddingDPStage'  value='Update Info'/>
												</form>
												</td>
											</tr></table>

											</td>
										</tr>
										
										<tr class='$packageClass'>
											<td>1.</td><td style='text-align:left;width:30%;padding-left:5px;'> Date of DBD sent to ADB :</td><td style='width: 18%; text-align:left;padding-left:5px;'> $bdps_29_null $bdps_29_date</td><td style=' background:#ffffff;'></td>
											<td>4.</td><td style='text-align:left;width:30%;padding-left:5px;'> Date of BD/ 1st Stage BD Availability :</td><td style='width: 18%; text-align:left;padding-left:5px;'> $bdps_32_null $bdps_32_date</td><td style=' background:#ffffff;'></td>
										</tr>
										
										<tr style='background:#DDDDDD;'>
											<td>2.</td><td style='text-align:left;width:30%;padding-left:5px;'>Date of ADB's NO on DBD : </td><td style='width: 18%; text-align:left;padding-left:5px;'>$bdps_30_null $bdps_30_date</td><td style=' background:#ffffff;'></td>
											<td>5.</td><td style='text-align:left;width:30%;padding-left:5px;'>Times of Clarification Sought by ADB on DPQD/DBD :</td><td style='width: 18%;text-align:left;padding-left:5px;'>$bdps_89</td>
										</tr>
										
										<tr class='$packageClass'>
											<td>3.</td><td style='text-align:left;width:30%;padding-left:5px;'>Date of EA's Approval on BD :</td><td style='width: 18%; text-align:left;padding-left:5px;'>$bdps_31_null $bdps_31_date</td><td style=' background:#ffffff;'></td>
											<td>6.</td><td style='text-align:left;width:30%;padding-left:5px;'> Number of Revision Sought by ADB on DPQD/DBD :</td><td style='width: 18%; text-align:left;padding-left:5px;'>  $bdps_90 </td><td style=' background:#ffffff;'></td>											
										</tr>
			
			
										<tr style='background:#ffffff;'>
											<td></td><td style='text-align:left;width:30%;padding-left:5px;'> &nbsp; </td><td style='width: 18%;text-align:left;padding-left:5px;'> &nbsp; </td><td style=' background:#ffffff;'></td>
											<td></td><td style='text-align:left;width:30%;padding-left:5px;'> &nbsp; </td><td style='width: 18%;text-align:left;padding-left:5px;'> &nbsp; </td>
										</tr>
									
										<tr style='background:#ffffff;'>
											<td style='text-align:left;width:100%;padding-left:5px;font-size:12px;' colspan='7'><center>Last Updated: <b>$entDatebdps</b>, Updated By: <b>$userName</b></center></td>
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
											<form action='biddingDPStage.php' method='post' target='_blank'>
											<input type='hidden' name='pi_4' id='pi_4' value='$pi_4' />
											<input type='hidden' name='pi_5' id='pi_5' value='$pi_5' />
											<input type='hidden' name='pi_6' id='pi_6' value='$pi_6' />
											<input type='hidden' name='packageId' value='$packageID'/>
											<input type='hidden' name='packageName' value='$packageName'/>
											<input type='submit' name='submitBiddingDPStage'  value='No Data Found Insert New Data'/>
											</form>
										</td>
										<td>
												<script  type='text/javascript'>		
														$(document).ready(function() {			
															$('#viewDBDStage{$packageID}').click(function(){					
																var packageIdDBDStage 				= $('#packageIdDBDStage{$packageID}').val();
																var userIdDBDStage					= $('#userIdDBDStage{$packageID}').val();	
																var pi_4DBDStage					= $('#pi_4DBDStage{$packageID}').val();	
																var pi_5DBDStage					= $('#pi_5DBDStage{$packageID}').val();	
																var pi_6DBDStage					= $('#pi_6DBDStage{$packageID}').val();	
																var packageNameDBDStage				= $('#packageNameDBDStage{$packageID}').val();																							
															$('#viewDBDStage{$packageID}').html();																	
																$.post('ajax/getVieweDBDStage.php',{'packageIdDBDStage': packageIdDBDStage, 'pi_4DBDStage': pi_4DBDStage, 'pi_5DBDStage': pi_5DBDStage, 'pi_6DBDStage': pi_6DBDStage, 'packageNameDBDStage': packageNameDBDStage, 'userIdDBDStage':userIdDBDStage},
																function(data)
																{  	
																	$('#showResultsDBDStage{$packageID}').html(data);
																});
															})				 
														});		
												</script>
												
												<form method='post'>					
												<input type='hidden' name='packageIdDBDStage' id='packageIdDBDStage{$packageID}' value='$packageID' />
												<input type='hidden' name='userIdDBDStage' id='userIdDBDStage{$packageID}' value='$userId' />
												<input type='hidden' name='pi_4DBDStage' id='pi_4DBDStage{$packageID}' value='$pi_4' />
												<input type='hidden' name='pi_5DBDStage' id='pi_5DBDStage{$packageID}' value='$pi_5' />
												<input type='hidden' name='pi_6DBDStage' id='pi_6DBDStage{$packageID}' value='$pi_6' />
												<input type='hidden' name='packageNameDBDStage' id='packageNameDBDStage{$packageID}' value='$packageName' />
												<input type='button' name='viewDBDStage{$packageID}' id='viewDBDStage{$packageID}' value='Refresh' class='FormSubmitBtn' />	
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
