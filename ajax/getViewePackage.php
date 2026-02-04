<script  type="text/javascript">		
		$(document).ready(function() {			
			$("#viewPacakge").click(function(){					
				var packageId 				= $("#packageId").val();
				var userId 					= $("#userId").val();																								
			$("#viewPacakge").html();																	
				$.post("ajax/getViewePackage.php",{'packageId': packageId, 'userId':userId},
				function(data)
				{  	
					$("#showResultsPacakge").html(data);
				});
			})				 
		});		
</script>
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
	
			
		$packageView        = '';
        $packageID 			= $_REQUEST['packageId']; 
		$userId 			= $_REQUEST['userId'];
		
		$psSql	= "SELECT * FROM s_user WHERE USER_ID='".$userId."' ORDER BY USER_ID";
		$psSqlStatement		= mysql_query($psSql);
		$psSqlStatementData	= mysql_fetch_array($psSqlStatement);
		$userName       	= $psSqlStatementData["USER_NAME"];
		//Ministry/Division and Project/Programme Name View Report Start				
			
			$packageQuery = "
								SELECT
										adbs_package.adbPackageName,
										adbs_package.pi_4,
										adbs_package.pi_5,
										adbs_package.pi_6,
										adbs_package.pi_7,
										adbs_package.pi_7a,
										adbs_package.pi_7b,
										adbs_package.pi_7c,
										adbs_package.pi_7d,
										adbs_package.pi_8,
										adbs_package.pi_13,
										adbs_package.pi_14,
										adbs_package.pi_15,
										adbs_package.pi_16,
										adbs_package.pi_17,
										adbs_package.pi_18,
										adbs_package.pi_19,
										adbs_package.entDate
								FROM
										adbs_package
								WHERE
										adbs_package.pId='$packageID'
								ORDER BY
										adbs_package.pId
							  ";
			// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Start Package Information <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<	
			
		$packageView .= "	
			<table border='0' width='100%' align='left' cellspacing='1' cellpadding='2' style='font-size:90%;'>";
														$packageStatement	= mysql_query($packageQuery);
														$packageCount 		= mysql_num_rows($packageStatement);
														if($packageCount>0) {
															$mv 						= 1;
															$packageStatement			= mysql_query($packageQuery);
															$packageStatementData	= mysql_fetch_array($packageStatement);
																if($mv%2==0) {
																	$packageClass="evenRow";
																} else {
																	$packageClass="oddRow";
																}
																$adbPackageName         = $packageStatementData["adbPackageName"];
																$pi_4		  			= $packageStatementData["pi_4"];
																$pi_5      				= $packageStatementData["pi_5"];
																$pi_6         			= $packageStatementData["pi_6"];
																$pi_7		 			= $packageStatementData["pi_7"];
																$pi_7a					= $packageStatementData["pi_7a"];
																$pi_7b		            = $packageStatementData["pi_7b"];
																$pi_7c		            = $packageStatementData["pi_7c"];
																$pi_7d					= $packageStatementData["pi_7d"];
																$pi_8                   = $packageStatementData["pi_8"];
																$pi_13                  = $packageStatementData["pi_13"];
																$pi_14                  = $packageStatementData["pi_14"];
																$pi_15                  = $packageStatementData["pi_15"];
																$pi_16                  = $packageStatementData["pi_16"];
																$pi_17                  = $packageStatementData["pi_17"];
																$pi_18                  = $packageStatementData["pi_18"];
																$pi_19                  = $packageStatementData["pi_19"];
																$entDatePI              = showDateFormat($packageStatementData["entDate"]);  
																
															$packageView .= "
																				<tr class='$packageClass'>
																					<td colspan='5' style='text-align:left;background:#ffffff;'>
																					<p style='font-size:17px;'>Package Information:</p>	
																					</td>
																					<td colspan='2' style='text-align:right;background:#ffffff;padding-left: 23%;'>
																					
																						<table style='text-align:right;background:#ffffff;'><tr>
																							<td style='text-align:right;background:#ffffff;'>
																							
																							<script  type='text/javascript'>		
																									$(document).ready(function() {			
																										$('#viewPacakge{$packageID}').click(function(){					
																											var packageId 				= $('#packageId{$packageID}').val();
																											var userId 					= $('#userId{$packageID}').val();																								
																										$('#viewPacakge{$packageID}').html();																	
																											$.post('ajax/getViewePackage.php',{'packageId': packageId, 'userId':userId},
																											function(data)
																											{  	
																												$('#showResultsPacakge{$packageID}').html(data);
																											});
																										})				 
																									});		
																							</script>
																																														
																							<form method='post'>					
																							<input type='hidden' name='packageId' id='packageId{$packageID}' value='$packageID' />
																							<input type='hidden' name='userId' id='userId{$packageID}' value='$userId' />
																							<input type='button' name='viewPacakge{$packageID}' id='viewPacakge{$packageID}' value='Refresh' class='FormSubmitBtn' />	
																							</form>		
																							</td>
																							
																							<td style='text-align:right;background:#ffffff;'>
																							<form action='procurementEdit.php' method='post' target='_blank'>
																							<input type='hidden' name='packageId' value='$packageID'/>
																							<input type='hidden' name='adbPackageName' value='$adbPackageName'/>
																							<input type='hidden' name='pi_4' value='$pi_4'/>
																							<input type='hidden' name='pi_6' value='$pi_6'/>
																							<input type='submit' name='editSubmitProcurement'  value='Update Info'/>
																							</form>	
																						    </td>
																						</tr></table>
																																													
																					</td>
																				</tr>
																			<tr style='background:#DDDDDD;'>
																					<td>1.</td><td style='text-align:left;width:20%;padding-left:5px;'>Package No: </td><td style='width: 28%;text-align:left;padding-left:5px;'> $pi_4</td><td style='background:#ffffff;'></td>
																					<td>2.</td><td style='text-align:left;width:20%;padding-left:5px;'>Lot No:</td><td style='width: 28%;text-align:left;padding-left:5px;'>$pi_5</td>    
																				</tr>
																				
																				<tr class='$packageClass'>
																					<td>3.</td><td style='text-align:left;width:20%;padding-left:5px;'>Contract Name:</td><td style='width: 28%;text-align:left;padding-left:5px;'> $pi_6</td><td style=' background:#ffffff;'></td>
																					<td>4.</td><td style='text-align:left;width:20%;padding-left:5px;'>Short Description of Contract:</td><td style='width: 28%;text-align:left;padding-left:5px;'> $pi_7</td>
																				
																				</tr>
																				
																				<tr style='background:#DDDDDD;'>
																					<td>5.</td><td style='text-align:left;width:20%;padding-left:5px;'>Unit:</td><td style='width: 28%;text-align:left;padding-left:5px;'> $pi_7a</td><td style=' background:#ffffff;'></td>
																					<td>6.</td><td style='text-align:left;width:20%;padding-left:5px;'>Quantity :</td><td style='width: 28;text-align:left;padding-left:5px;'> $pi_7b</td>
																					
																				</tr>
																				
																				<tr class='$packageClass'>
																					<td>7.</td><td style='text-align:left;width:20%;padding-left:5px;'>Procurement Type:</td><td style='width: 28%;text-align:left;padding-left:5px;'>$pi_13 </td><td style=' background:#ffffff;'></td>
																					<td>12.</td><td style='text-align:left;width:20%;padding-left:5px;'>Cost Estimate (BDT) :</td><td style='width: 28%;text-align:left;padding-left:5px;'> ".number_format($pi_7d,2)."</td>
																				</tr>
																				
																				<tr style='background:#DDDDDD;'>
																					<td>8.</td><td style='text-align:left;width:20%;padding-left:5px;'>Procurement Method :</td><td style='width: 28%;text-align:left;padding-left:5px;'>$pi_14</td><td style=' background:#ffffff;'></td>
																					<td>13.</td><td style='text-align:left;width:20%;padding-left:5px;'>Cost Estimate (Equiv. US$) :</td><td style='width: 28%;text-align:left;padding-left:5px;'>".number_format($pi_8,2)."</td>
																				</tr>
																				
																				<tr class='$packageClass'>
																					<td>9.</td><td style='text-align:left;width:20%;padding-left:5px;'>Bidding Procedures:</td><td style='width: 28%;text-align:left;padding-left:5px;'> $pi_15</td><td style=' background:#ffffff;'></td>
																					<td>14.</td><td style='text-align:left;width:20%;padding-left:5px;'>Source of Funds :</td><td style='width: 28%;text-align:left;padding-left:5px;'> $pi_7c</td>																						
																													
																				</tr>
																				
																				<tr style='background:#DDDDDD;'>
																					 <td>10.</td><td style='text-align:left;width:20%;padding-left:5px;'>Applicability of Guidelines :</td><td style='width: 28%;text-align:left;padding-left:5px;'> $pi_16 </td><td style=' background:#ffffff;'></td>
																					 <td>15.</td><td style='text-align:left;width:20%;padding-left:5px;'>Approving Authority :</td><td style='width: 28%;text-align:left;padding-left:5px;'> $pi_17 </td>	
																				</tr>
																				
																				<tr class='$packageClass'>
																					<td>11.</td><td style='text-align:left;width:20%;padding-left:5px;'>Prior Review :</td><td style='width: 28%;text-align:left;padding-left:5px;'> $pi_18</td><td style='background:#ffffff;'></td>
																					<td>16.</td><td style='text-align:left;width:20%;padding-left:5px;'>Prequalification Process :</td><td style='width: 28%;text-align:left;padding-left:5px;'> $pi_19</td>
																				</tr>
																				



																				
																				<tr style='background:#ffffff;'>
																					<td></td><td style='text-align:left;width:20%;padding-left:5px;'> &nbsp; </td><td style='width: 28%;text-align:left;padding-left:5px;'> &nbsp; </td><td style=' background:#ffffff;'></td>
																					<td></td><td style='text-align:left;width:20%;padding-left:5px;'> &nbsp; </td><td style='width: 28%;text-align:left;padding-left:5px;'> &nbsp; </td>
																				</tr>
																				
																				<tr style='background:#ffffff;'>
																					<td style='text-align:left;width:100%;padding-left:5px;font-size:12px;' colspan='7'><center>Last Updated: <b>$entDatePI</b>, Updated By: <b>$userName</b></center></td>
																				</tr>				
																				";
																$mv++;
																
															
														} else {
															$packageView .= "<tr style='background:#F7F4F4'>
																				<td colspan='3' style='text-align:center; color:red;'>No Data Found</td>
																			</tr>";
														}
														$packageView .= "</table>	
									";	
														
							echo 	$packageView ;
?>
