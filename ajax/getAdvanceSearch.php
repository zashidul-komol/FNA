<style>
.re{
		font-weight:bold;background:#069;color:#ffffff;padding:7px;
}
.packageViewTD{
		font-weight:bold;background:#069;color:#ffffff;padding:0px;
}
td.paymentStage{
	text-align:left;width:20%;padding-left:5px;
	}
</style>

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
		$packageView                = '';
        $userId 	= $_REQUEST['userId']; 
		//Ministry/Division and Project/Programme Name View Report Start				
	 	$psSql 	= "
							SELECT adbs_projectsetup.ministryDivision, adbs_projectsetup.eaName, adbs_projectsetup.adbProjectName											
							FROM adbs_projectsetup, s_user
							WHERE adbs_projectsetup.psId = s_user.psId
							and s_user.USER_ID = $userId
							ORDER BY adbs_projectsetup.psId
						"; 
			$psSqlStatement				= mysql_query($psSql);
			while($psSqlStatementData	= mysql_fetch_array($psSqlStatement)){
			$eaName        				= $psSqlStatementData["eaName"];
			$ministryDivision      		= $psSqlStatementData["ministryDivision"];
			$adbProjectName       		= $psSqlStatementData["adbProjectName"];
			}
			

			
			//Ministry/Division and Project/Programme Name View Report End
			
			$ptId 				= $_REQUEST['ptIdAdvance']; 
			$pmId 				= $_REQUEST['piProcurementMethod']; 
			$bpId 				= $_REQUEST['piBiddingProcedure']; 
			$pi_18 				= $_REQUEST['piPriorReview']; 
			$pi_19 				= $_REQUEST['piPrequalificationProcess']; 
			$pi_6 				= $_REQUEST['contractName']; 
			

			
			$psId = '';
			$test = '';
			$psSql	= "SELECT * FROM s_user WHERE USER_ID='".$userId."' ORDER BY USER_ID";
			$psSqlStatement		= mysql_query($psSql);
			$psSqlStatementData	= mysql_fetch_array($psSqlStatement);
			$psId       			= $psSqlStatementData["psId"];
			
			$whereQue		 = '';

			if(!empty($ptId) && ($ptId !='')){
				$whereQue .= " AND ptId = $ptId";
			}
			
			if(!empty($pmId) && ($pmId !='')){
				$whereQue .= " AND pmId = $pmId";
			}
			if(!empty($bpId) && ($bpId !='')){
				$whereQue .= " AND bpId = $bpId";
			}
			if(!empty($pi_18) && ($pi_18 !='')){
				$whereQue .= " AND pi_18 = '".$pi_18."'";
			}
			if(!empty($pi_19) && ($pi_19 !='')){
				$whereQue .= " AND pi_19 = '".$pi_19."'";
			}
			if(!empty($pi_6) && ($pi_6 !='')){
				$whereQue .= " AND pi_6 LIKE '%{$pi_6}%' OR  pi_4 LIKE '%{$pi_6}%'";
			}
			$allFieldsBlank = 1;
			if(($ptId == '') && ($pmId == '') && ($bpId == '') && ($pi_18 == '') && ($pi_19 == '') && ($pi_6 == '')){
				$allFieldsBlank = 0;
			}		
	// View Package in home page >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>   Search Results  start  <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
		$userName  		   = '';
		$packageServQuery2 = "
									SELECT
											p.pId,
											p.pName,
											p.entUser,
											u.USER_NAME,
											o.OPNAME
									FROM
											adbs_package p, s_user u, s_operator o
											
									WHERE  p.psId = u.psId
									AND    u.USER_ID = $userId
									AND    o.USER_ID = $userId										
									ORDER BY pId ASC";
			$packageServStatement2				= mysql_query($packageServQuery2);
			while($packageServStatementData2	= mysql_fetch_array($packageServStatement2)) {

				$userName      		= $packageServStatementData2["OPNAME"];
				
				}

			$packageView = "<table border='0' width='100%' align='left' cellspacing='0' cellpadding='3' style='font-size:13px;'>";
			$admin = 1; 
						
			$packageServQuery = "SELECT * FROM adbs_package WHERE psId='$psId' AND entUser='$userId' {$whereQue}"; 
										
			$msv							= 1;
						
			$packageServStatement			= mysql_query($packageServQuery);
			$countRows						= mysql_num_rows($packageServStatement);
			if(($countRows > 0) && ($allFieldsBlank == 1)){
			while($packageServStatementData	= mysql_fetch_array($packageServStatement)) {
				if($msv%2==0) {
					$class	= "evenRow";
				} else {
					$class	= "oddRow";
				}
				
				$packageID        = $packageServStatementData["pId"];
				$entUserId        = $packageServStatementData["entUser"];
				$packageName      = $packageServStatementData["adbPackageName"];
				$status           = $packageServStatementData["status"];
				$pi_19            = $packageServStatementData["pi_19"]; 
				$pi_4             = $packageServStatementData["pi_4"]; 
				$pi_5             = $packageServStatementData["pi_5"]; 
				$pi_6             = substr($packageServStatementData["pi_6"],0, 80);
				


				// View Package Name:
/*<!--													<script>
										$('.re').click(function() {
										$('.re').removeClass('active');
										$(this).addClass('active');
										});
										
										$('#pacakgeView{$packageID}').click(function() {
											$('#navigation').stop().animate({'backgroundColor':'#fff'}, 800);
											$('.active').stop().animate({'backgroundColor':'#8fc83c'}, 800);   
										});
									</script>-->*/
				$packageView .= "<tr class='$class'><td class='packageViewTD'>
									
								<div id='navigation'>
									<div id='pacakgeView{$packageID}'  class='re'>
											<span onclick=\"return ShowHide('viewPackageInformation{$packageID}')\" style='display:block;cursor:pointer'>$pi_4, $pi_5, $pi_6 .....</span>
									</div>
								</div>
								</td></tr>";
					
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
			$show    = '';
			$notShow = '';
			if($pi_19 != 'No'){
				$show = "<li><a href='#tabs{$packageID}-2'>Prequalification</a></li>";
				}
			else{
				$notShow = ' ';
				}					  

				$packageView .= " 
				
									</tr><td style='border:solid 1px #069;'>									
									<div id='viewPackageInformation{$packageID}' style='display:none;'>
									<script>
										$(function() {
										$( '#tabs{$packageID}').tabs();
										});
									</script>
									 <!-- Details main body  -->
										<div id='tabs{$packageID}' style='width:100%px; font-family:Arial, Helvetica, sans-serif; font-size:12px; border: 0;'>
											<ul>
												<li><a href='#tabs{$packageID}-1'>Basic Information</a></li>
												$show
												<li><a href='#tabs{$packageID}-3'>DBD Stage</a></li>
												<li><a href='#tabs{$packageID}-4'>Bidding Stage</a></li>
												<li><a href='#tabs{$packageID}-5'>Evaluation Stage</a></li>
												<li><a href='#tabs{$packageID}-6'>Approval Stage</a></li>
												<li><a href='#tabs{$packageID}-7'>Award Stage</a></li>
												<li><a href='#tabs{$packageID}-8'>Implementation Stage</a></li>
												<li><a href='#tabs{$packageID}-11'>Payment Stage</a></li>
												<li><a href='#tabs{$packageID}-10'>Disbursements Stage</a></li>
												<li><a href='#tabs{$packageID}-12'>Others</a></li>
											</ul>
											<!-- Tab 1 Stert  -->
										
											<div id='tabs{$packageID}-1' >
											   <div id='showResultsPacakge{$packageID}'>
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
																					<td colspan='2' style='text-align:right;background:#ffffff;padding-left:23%;'>
																					
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
																							<input type='hidden' name='pi_5' value='$pi_5'/>
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
																
															}
														} else {
															$packageView .= "<tr style='background:#F7F4F4'>
																				<td colspan='3' style='text-align:center; color:red;'>No Data Found</td>
																			</tr>";
														}
														$packageView .= "</table>
																		</div>
																	</div>
																		<!--  Tab 1 End  -->";
														$msv++;
	// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> End Package Information<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<				
				
	// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Start PQ Stage <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
	
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
	if($pi_19 != 'No'){
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
				$packageView .= "</table>     
                            </div>
						 </div>	
                            <!-- Tab 2 End -->";
				$msv++;
			}
    // >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> End PQ Stage <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<	
	

	
	
	// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Start Bidding Document Preparation Stage <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
	
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
                            </div>
						</div>	
                            <!--  Tab 3 End -->";
				$msv++;
			
    // >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> End Bidding Document Preparation Stage <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
	
		
	
	// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Start Bidding / Proposal Stage <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
	
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
										<input type='hidden' name='pi_4' id='pi_4' value='$pi_4' />
										<input type='hidden' name='pi_5' id='pi_5' value='$pi_5' />
										<input type='hidden' name='pi_6' id='pi_6' value='$pi_6' />
										<input type='hidden' name='packageId' value='$packageID'/>
										<input type='hidden' name='packageName' value='$packageName'/>
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
								</div>
							</div>
									<!--  Tab 4 End -->";
				$msv++;
			
    // >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> End Bidding / Proposal Stage <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
	
	
	// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Start Bid / Proposal Evaluation Stage <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
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
                            </div>
						</div>
                            <!--  Tab 5 End -->";
				$msv++;
			
    // >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> End Bid / Proposal Evaluation Stage <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
	
	
	// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Start Evaluation Report Approval Stage <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
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
                            </div>
						</div>	
                            <!--  Tab 6 End -->";
				$msv++;
			
    // >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> End Evaluation Report Approval Stage <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
	
	
	// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Start Contracting Stage <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
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
							</div>
						</div>	
									<!--  Tab 7 End -->";
				$msv++;
			
    // >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> End Contracting Stage <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
	
	
	
	
	
	
	// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Start Contract Management Stage <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
	
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
										<input type='hidden' name='pi_4' id='pi_4' value='$pi_4' />
										<input type='hidden' name='pi_5' id='pi_5' value='$pi_5' />
										<input type='hidden' name='pi_6' id='pi_6' value='$pi_6' />
										<input type='hidden' name='packageId' value='$packageID'/>
										<input type='hidden' name='packageName' value='$packageName'/>
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
							</div>
						</div>
									<!--  Tab 8 End --> ";
				$msv++;
			
    // >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> End Contract Management Stage <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
	
	// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Start Payment Stage <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
	$psbkdn_flag  = '';
	$psbkdnMaxIdSql	= "SELECT COUNT(*) FROM adbs_paymentstage_bkdn WHERE pId='".$packageID."'"; 
	$psbkdnMaxIdSqllStatement		= mysql_query($psbkdnMaxIdSql);
	$psbkdnMaxIdSqllStatementData	= mysql_fetch_array($psbkdnMaxIdSqllStatement);  
	$maxpsbkdn_flag      			= $psbkdnMaxIdSqllStatementData[0]; 
	
	$flagOne = 1;
	$flagOneSql	= "SELECT * FROM adbs_paymentstage_bkdn WHERE pId='".$packageID."' AND psbkdn_flag='".$flagOne."'"; 
	$flagOneSqlStatement		= mysql_query($flagOneSql);
	$flagOneSqlStatementData	= mysql_fetch_array($flagOneSqlStatement);  
	$advancePAmount      		= $flagOneSqlStatementData["psbkdn_2"]; 
	$psbkdn_2a    			    = $flagOneSqlStatementData["psbkdn_2a"];
	$psbkdn_2b   			    = $flagOneSqlStatementData["psbkdn_2b"];
	
	$advancePDate      			= $flagOneSqlStatementData["psbkdn_1"];
	$advancePDate_null = '';
	$advancePDate_date = '';
	if ($advancePDate=='0000-00-00'){
		$advancePDate_null = '';
	}
	else{$advancePDate_date = showDateFormat($flagOneSqlStatementData["psbkdn_1"]);}
	
	
	$originalPrice  = '';
	$originalPriceSql	= "SELECT * FROM adbs_contractingstage WHERE pId='".$packageID."'"; 
	$originalPriceSqlStatement		= mysql_query($originalPriceSql);
	$originalPriceSqlStatementData	= mysql_fetch_array($originalPriceSqlStatement);  
	$originalPrice 					= $originalPriceSqlStatementData["cs_11"];
	
	$packageQuery = "
								SELECT
										adbs_paymentstage_bkdn.psId,
										adbs_paymentstage_bkdn.pId,
										adbs_paymentstage_bkdn.psbkdn_1,
										adbs_paymentstage_bkdn.psbkdn_2,
										adbs_paymentstage_bkdn.psbkdn_2a,
										adbs_paymentstage_bkdn.psbkdn_2b,
										adbs_paymentstage_bkdn.psbkdn_78b,
										adbs_paymentstage_bkdn.psbkdn_3,
										adbs_paymentstage_bkdn.psbkdn_4,
										adbs_paymentstage_bkdn.psbkdn_5,
										adbs_paymentstage_bkdn.psbkdn_6,
										adbs_paymentstage_bkdn.psbkdn_7,
										adbs_paymentstage_bkdn.psbkdn_8,
										adbs_paymentstage_bkdn.psbkdn_9,
										adbs_paymentstage_bkdn.psbkdn_10,
										adbs_paymentstage_bkdn.psbkdn_12,
										adbs_paymentstage_bkdn.psbkdn_flag,

										adbs_paymentstage_bkdn.entDate
										
										
								FROM
										adbs_paymentstage_bkdn 
								WHERE adbs_paymentstage_bkdn.pId='$packageID'
								AND   adbs_paymentstage_bkdn.psbkdn_flag='$maxpsbkdn_flag'
							  ";
							  
	
	$packageView .= "<!-- Tab 3 Start -->
						<div id='tabs{$packageID}-11'>
							<div id='showResultsPaymentStage{$packageID}'>
								<table border='0' width='100%' align='left' cellspacing='1' cellpadding='2' style='font-size:90%;'>";
				$packageStatement	= mysql_query($packageQuery);
				$packageCount 		= mysql_num_rows($packageStatement);
				if($packageCount>0) {
					$packageStatement			= mysql_query($packageQuery);
					$packageStatementData	= mysql_fetch_array($packageStatement);		
										
						$psbkdn_1        				= showDateFormat($packageStatementData["psbkdn_1"]);
						$psbkdn_2    			    	= $packageStatementData["psbkdn_2"];

						$psbkdn_78b   			    	= $packageStatementData["psbkdn_78b"];
						$psbkdn_3       				= $packageStatementData["psbkdn_3"];

						
						$psbkdn_4		  				= $packageStatementData["psbkdn_4"];
						$psbkdn_4_null = '';
						$psbkdn_4_date = '';
						if ($psbkdn_4=='0000-00-00'){
							$psbkdn_4_null = '';
						}
						else{$psbkdn_4_date = showDateFormat($packageStatementData["psbkdn_4"]);}
						
						$psbkdn_5		  				= $packageStatementData["psbkdn_5"];
						$psbkdn_5_null = '';
						$psbkdn_5_date = '';
						if ($psbkdn_5=='0000-00-00'){
							$psbkdn_5_null = '';
						}
						else{$psbkdn_5_date = showDateFormat($packageStatementData["psbkdn_5"]);}
						
						
						$psbkdn_7       				= $packageStatementData["psbkdn_7"];
						$psbkdn_8        				= $packageStatementData["psbkdn_8"];
						$psbkdn_9    			    	= $packageStatementData["psbkdn_9"];
						$psbkdn_10       				= $packageStatementData["psbkdn_10"];
						$psbkdn_11       				= $originalPrice - $psbkdn_8;
						$psbkdn_12        				= $packageStatementData["psbkdn_12"];
						$entDateps       				= showDateFormat($packageStatementData["entDate"]);
					
						$psbkdn_6		  				= $packageStatementData["psbkdn_6"];
						$psbkdn_6_null = '';
						$psbkdn_6_date = '';
						if ($psbkdn_6=='0000-00-00'){
							$psbkdn_6_null = '';
						}
						else{$psbkdn_6_date = showDateFormat($packageStatementData["psbkdn_6"]);}
						
						$packageView .= "
										<tr class='$packageClass'>
											<td colspan='5' style='text-align:left;background:#ffffff;'>
												<p style='font-size:17px;'>Payments Stage:</p>	
											</td>
                                             
											<td colspan='2' style='text-align:right;background:#ffffff;padding-left: 23%;'>
												<table style='text-align:right;background:#ffffff;'><tr>
													<td style='text-align:right;background:#ffffff;'>
													
													<script  type='text/javascript'>		
															$(document).ready(function() {			
																$('#viewPaymentStage{$packageID}').click(function(){					
																	var packageIdPaymentStage 				= $('#packageIdPaymentStage{$packageID}').val();
																	var userIdPaymentStage					= $('#userIdPaymentStage{$packageID}').val();	
																	var pi_4PaymentStage					= $('#pi_4PaymentStage{$packageID}').val();	
																	var pi_5PaymentStage					= $('#pi_5PaymentStage{$packageID}').val();	
																	var pi_6PaymentStage					= $('#pi_6PaymentStage{$packageID}').val();	
																	var packageNamePaymentStage				= $('#packageNamePaymentStage{$packageID}').val();																							
																$('#viewPaymentStage{$packageID}').html();																	
																	$.post('ajax/getViewePaymentStage.php',{'packageIdPaymentStage': packageIdPaymentStage, 'userIdPaymentStage': userIdPaymentStage, 'pi_4PaymentStage': pi_4PaymentStage,'pi_5PaymentStage': pi_5PaymentStage, 'pi_6PaymentStage': pi_6PaymentStage, 'packageNamePaymentStage':packageNamePaymentStage},
																	function(data)
																	{  	
																		$('#showResultsPaymentStage{$packageID}').html(data);
																	});
																})				 
															});		
													</script>
													
													<form method='post'>					
														<input type='hidden' name='packageIdPaymentStage' id='packageIdPaymentStage{$packageID}' value='$packageID' />
														<input type='hidden' name='userIdPaymentStage' id='userIdPaymentStage{$packageID}' value='$userId' />
														<input type='hidden' name='pi_4PaymentStage' id='pi_4PaymentStage{$packageID}' value='$pi_4' />
														<input type='hidden' name='pi_5PaymentStage' id='pi_5PaymentStage{$packageID}' value='$pi_5' />
														<input type='hidden' name='pi_6PaymentStage' id='pi_6PaymentStage{$packageID}' value='$pi_6' />
														<input type='hidden' name='packageNamePaymentStage' id='packageNamePaymentStage{$packageID}' value='$packageName' />
														<input type='button' name='viewPaymentStage{$packageID}' id='viewPaymentStage{$packageID}' value='Refresh' class='FormSubmitBtn' />	
													</form>		
													</td>
													<td style='text-align:right;background:#ffffff;'>
													<form action='paymentStageEdit.php' method='post' target='_blank'>
														<input type='hidden' name='pi_4' value='$pi_4'/>
														<input type='hidden' name='pi_5' value='$pi_5'/>
														<input type='hidden' name='pi_6' value='$pi_6'/>
														<input type='hidden' name='packageId' value='$packageID'/>
														<input type='hidden' name='packageName' value='$packageName'/>
														<input type='submit' name='editSubmitPaymentStage'  value='Update Info'/>
													</form>
													</td>
												</tr>
												</table>
												
											</td>
										</tr>
										
										<tr style='background:#DDDDDD;'>
											<td>1.</td><td style='text-align:left;width:30%;padding-left:5px;'>Contractual Advance Payment Date (Cheque Date), if any: </td><td style='width: 18%;text-align:left;padding-left:5px;'> $advancePDate_null $advancePDate_date</td><td style='background:#ffffff;'></td>
											<td>2.</td><td style='text-align:left;width:30%;padding-left:5px;'>Contractual Advance Payment Amount(Equiv. US$),if any:</td><td style='width: 18%;text-align:left;padding-left:5px;'>".number_format($advancePAmount,2)."</td>	
										</tr>
										
										<tr style='background:#eeeeee;'>
											<td>3.</td><td style='text-align:left;width:30%;padding-left:5px;'>Advance Payment amount (in contract currency or currencies):</td><td style='width: 18%;text-align:left;padding-left:5px;'> $psbkdn_2a</td><td style=' background:#ffffff;'></td>
											<td>4.</td><td style='text-align:left;width:30%;padding-left:5px;'>Remaining Advance Amount after Adjustment in Last IPC payment(equiv. US$):</td><td style='width: 18%;text-align:left;padding-left:5px;'>$psbkdn_2b</td>
										</tr>
                                        
                                        <tr style='background:#ffffff;'>
											<td></td><td style='text-align:left;width:30%;padding-left:5px;'>&nbsp;  </td><td style='width: 18%;text-align:left;padding-left:5px;'>&nbsp;  </td><td style='background:#ffffff;'></td>
											<td></td><td style='text-align:left;width:30%;padding-left:5px;'>&nbsp;  </td><td style='width: 18%;text-align:left;padding-left:5px;'>&nbsp;  </td>	
										</tr>
                                        
                                        <tr style='background:#eeeeee;'>
											<td>5.</td><td style='text-align:left;width:30%;padding-left:5px;'>ADB Financing (percentage):</td><td style='width: 18%;text-align:left;padding-left:5px;'> $psbkdn_78b</td><td style=' background:#ffffff;'></td>
											<td>10.</td><td style='text-align:left;width:30%;padding-left:5px;'>Cumulative Total Amount Certified & Paid up to Last IPC (In contract currency or currencies):</td><td style='width: 18%;text-align:left;padding-left:5px;'>$psbkdn_7</td>
		
										</tr>
										
										<tr style='background:#DDDDDD;'>
											<td>6.</td><td style='text-align:left;width:30%;padding-left:5px;'>Last Interim Payment Date (Cheque Date):</td><td style='width: 18%;text-align:left;padding-left:5px;'>$psbkdn_6_null $psbkdn_6_date</td><td style=' background:#ffffff;'></td>
											<td>11.</td><td style='text-align:left;width:30%;padding-left:5px;'>Cumulative Total Amount Certified & Paid up to Last IPC (Equiv. US$):</td><td style='width: 18%;text-align:left;padding-left:5px;'>".number_format($psbkdn_8,2)."</td>
											
										</tr>
										
										<tr style='background:#eeeeee;'>
											<td>7.</td><td style='text-align:left;width:30%;padding-left:5px;'>Last IPCSubmissionDate:</td><td style='width: 18%;text-align:left;padding-left:5px;'>$psbkdn_4_null $psbkdn_4_date</td><td style=' background:#ffffff;'></td>
											<td>12.</td><td style='text-align:left;width:30%;padding-left:5px;'>Cumulative Total ADB Financing Amount up to last  IPC (Equiv. US$):</td><td style='width: 18%;text-align:left;padding-left:5px;'>$psbkdn_2b</td>
										</tr>
										
										<tr style='background:#DDDDDD;'>
											<td>8.</td><td style='text-align:left;width:30%;padding-left:5px;'>Last IPC Certification / AcceptanceDate (by Employer/ Purchaser):</td><td style='width: 18%;text-align:left;padding-left:5px;'>$psbkdn_5_null $psbkdn_5_date</td><td style=' background:#ffffff;'></td>
											<td>13.</td><td style='text-align:left;width:30%;padding-left:5px;'>Cumulative Total Amount (up to Last IPC)Imposed on Employer for Late Payment (Equiv. US$) :</td><td style='width: 18%;text-align:left;padding-left:5px;'>".number_format($psbkdn_9,2)."</td>
										</tr>
										
										<tr style='background:#eeeeee;'>
											<td>9.</td><td style='text-align:left;width:30%;padding-left:5px;'>Last Interim Payment Claim(IPC) No.:</td><td style='width: 18%;text-align:left;padding-left:5px;'>$psbkdn_3</td><td style=' background:#ffffff;'></td>
											<td>14.</td><td style='text-align:left;width:30%;padding-left:5px;'>Cumulative Total Liquidated Damage(up to Last IPC) imposed on Supplier/ Contractor (Equiv. US$):</td><td style='width: 18%;text-align:left;padding-left:5px;'>".number_format($psbkdn_10,2)."</td>																						
																			
										</tr>
                                        
                                        <tr style='background:#ffffff;'>
											<td></td><td style='text-align:left;width:30%;padding-left:5px;'>&nbsp;  </td><td style='width: 18%;text-align:left;padding-left:5px;'>&nbsp;  </td><td style='background:#ffffff;'></td>
											<td></td><td style='text-align:left;width:30%;padding-left:5px;'>&nbsp;  </td><td style='width: 18%;text-align:left;padding-left:5px;'>&nbsp;  </td>	
										</tr>
                                        
                                        <tr style='background:#DDDDDD;'>
											<td>15.</td><td style='text-align:left;width:30%;padding-left:5px;'>Remaining Contract Amount after Certified Last IPC (equiv. US$):</td><td style='width: 18%;text-align:left;padding-left:5px;'>".number_format($psbkdn_11,2)."</td><td style=' background:#ffffff;'></td>
											<td></td><td style='text-align:left;width:30%;padding-left:5px;'></td><td style='width: 18%;text-align:left;padding-left:5px;'></td>																						
										</tr>


										<tr style='background:#ffffff;'>
											<td></td><td style='text-align:left;width:30%;padding-left:5px;'> &nbsp; </td><td style='width: 18%;text-align:left;padding-left:5px;'> &nbsp; </td><td style='background:#ffffff;'></td>
											<td></td><td style='text-align:left;width:30%;padding-left:5px;'> &nbsp; </td><td style='width: 18%;text-align:left;padding-left:5px;'> &nbsp; </td>	
										</tr>										
										<tr style='background:#ffffff;'>
											<td style='text-align:left;width:100%;padding-left:5px;font-size:12px;' colspan='7'><center>Last Updated: <b>$entDateps</b>, Updated By: <b>$userName</b></center></td>
										</tr>															
										";					
		
					
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
										<form action='paymentStage.php' method='post' target='_blank'>
										<input type='hidden' name='pi_4' id='pi_4' value='$pi_4' />
										<input type='hidden' name='pi_5' id='pi_5' value='$pi_5' />
										<input type='hidden' name='pi_6' id='pi_6' value='$pi_6' />
										<input type='hidden' name='pi_4' value='$pi_4'/>
										<input type='hidden' name='pi_6' value='$pi_6'/>
										<input type='hidden' name='packageId' value='$packageID'/>
										<input type='hidden' name='packageName' value='$packageName'/>
										<input type='submit' name='submitPaymentStage'  value='No Data Found Insert New Data'/>
										</form>
										</td>
										<td>
                                      <script  type='text/javascript'>		
															$(document).ready(function() {			
																$('#viewPaymentStage{$packageID}').click(function(){					
																	var packageIdPaymentStage 				= $('#packageIdPaymentStage{$packageID}').val();
																	var userIdPaymentStage					= $('#userIdPaymentStage{$packageID}').val();	
																	var pi_4PaymentStage					= $('#pi_4PaymentStage{$packageID}').val();	
																	var pi_5PaymentStage					= $('#pi_5PaymentStage{$packageID}').val();	
																	var pi_6PaymentStage					= $('#pi_6PaymentStage{$packageID}').val();	
																	var packageNamePaymentStage				= $('#packageNamePaymentStage{$packageID}').val();																							
																$('#viewPaymentStage{$packageID}').html();																	
																	$.post('ajax/getViewePaymentStage.php',{'packageIdPaymentStage': packageIdPaymentStage, 'userIdPaymentStage': userIdPaymentStage, 'pi_4PaymentStage': pi_4PaymentStage,'pi_5PaymentStage': pi_5PaymentStage, 'pi_6PaymentStage': pi_6PaymentStage, 'packageNamePaymentStage':packageNamePaymentStage},
																	function(data)
																	{  	
																		$('#showResultsPaymentStage{$packageID}').html(data);
																	});
																})				 
															});		
													</script>
													
													<form method='post'>					
														<input type='hidden' name='packageIdPaymentStage' id='packageIdPaymentStage{$packageID}' value='$packageID' />
														<input type='hidden' name='userIdPaymentStage' id='userIdPaymentStage{$packageID}' value='$userId' />
														<input type='hidden' name='pi_4PaymentStage' id='pi_4PaymentStage{$packageID}' value='$pi_4' />
														<input type='hidden' name='pi_5PaymentStage' id='pi_5PaymentStage{$packageID}' value='$pi_5' />
														<input type='hidden' name='pi_6PaymentStage' id='pi_6PaymentStage{$packageID}' value='$pi_6' />
														<input type='hidden' name='packageNamePaymentStage' id='packageNamePaymentStage{$packageID}' value='$packageName' />
														<input type='button' name='viewPaymentStage{$packageID}' id='viewPaymentStage{$packageID}' value='Refresh' class='FormSubmitBtn' />	
													</form>				
										</td>
									  </tr>
									</table>
												
									</center></td>
							</tr>";
				}
				$packageView .= "</table>  
                            </div>
						</div>	
                            <!--  Tab 3 End -->";
				$msv++;
			
    // >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> End Payment Stage <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
	
	
	// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Start Disbursements Stage <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
	$psbkdnMaxIdSqlD	= "SELECT COUNT(*) FROM adbs_paymentstage_bkdn WHERE pId='".$packageID."'"; 
	$psbkdnMaxIdSqlDStatementD		= mysql_query($psbkdnMaxIdSqlD);
	$psbkdnMaxIdSqlDStatementDDataD	= mysql_fetch_array($psbkdnMaxIdSqlDStatementD);  
	$maxpsbkdn_flagD      			= $psbkdnMaxIdSqlDStatementDDataD[0]; 
	
	$flagOneSqlD	= "SELECT * FROM adbs_paymentstage_bkdn WHERE pId='".$packageID."' AND psbkdn_flag='".$maxpsbkdn_flagD."'"; 
	$flagOneSqlStatementD		= mysql_query($flagOneSqlD);
	$flagOneSqlStatementDataD	= mysql_fetch_array($flagOneSqlStatementD);  
	$advancePDateD      		= showDateFormat($flagOneSqlStatementDataD["psbkdn_1"]); 
	$advancePAmountD      		= $flagOneSqlStatementDataD["psbkdn_2"]; 
	
	
	

		
	$dpQuery = "
							SELECT
										adbs_paymentstage_bkdn.pId,
										adbs_paymentstage_bkdn.psbkdn_QuaterNo,
										adbs_paymentstage_bkdn.psbkdn_Year,
										adbs_paymentstage_bkdn.psbkdn_Actual
										
								FROM
										adbs_paymentstage_bkdn
								WHERE
										adbs_paymentstage_bkdn.pId='$packageID'
								ORDER BY
										adbs_paymentstage_bkdn.psbkdn_flag				
								LIMIT 0, 8		
								";

	$packageView .= "<!-- Tab 3 Start -->
						<div id='tabs{$packageID}-10'>
							<div id='showResultsDisbursementsStage{$packageID}'>
								<table border='0' width='100%' align='left' cellspacing='1' cellpadding='2' style='font-size:90%;'>";
				$dpQueryStatement			= mysql_query($dpQuery);
				$dpQueryStatementCount 		= mysql_num_rows($dpQueryStatement);
				if($dpQueryStatementCount>0) {
					
						  $dpQueryStatement			= mysql_query($dpQuery);
					while($dpQueryStatementData	    = mysql_fetch_array($dpQueryStatement)){	
											
					if($mv%2==0) {
							$packageClass="evenRow";
						} else {
							$packageClass="oddRow";
						}

						}
						$packageView .= "
										<tr class='$packageClass'>
											<td colspan='4' style='text-align:left;background:#ffffff;'>
												<p style='font-size:16px;'>Disbursements Stage:</p>	
											</td>
                                             
											<td colspan='1' style='text-align:right;background:#ffffff;padding-left:29%;'>
											
												<table style='text-align:right;background:#ffffff;'><tr>
													<td style='text-align:right;background:#ffffff;'>
													
													<script  type='text/javascript'>		
															$(document).ready(function() {			
																$('#viewDisbursementsStage{$packageID}').click(function(){					
																	var packageIdDisbursementsStage 			= $('#packageIdDisbursementsStage{$packageID}').val();
																	var userIdDisbursementsStage				= $('#userIdDisbursementsStage{$packageID}').val();	
																	var pi_4DisbursementsStage					= $('#pi_4DisbursementsStage{$packageID}').val();
																	var pi_5DisbursementsStage					= $('#pi_5DisbursementsStage{$packageID}').val();	
																	var pi_6DisbursementsStage					= $('#pi_6DisbursementsStage{$packageID}').val();	
																	var packageNameDisbursementsStage			= $('#packageNameDisbursementsStage{$packageID}').val();																							
																$('#viewDisbursementsStage{$packageID}').html();																	
																	$.post('ajax/getVieweDisbursementsStage.php',{'packageIdDisbursementsStage': packageIdDisbursementsStage, 'userIdDisbursementsStage': userIdDisbursementsStage, 'pi_4DisbursementsStage': pi_4DisbursementsStage,'pi_5DisbursementsStage': pi_5DisbursementsStage, 'pi_6DisbursementsStage': pi_6DisbursementsStage, 'packageNameDisbursementsStage':packageNameDisbursementsStage},
																	function(data)
																	{  	
																		$('#showResultsDisbursementsStage{$packageID}').html(data);
																	});
																})				 
															});		
													</script>
													
													<form method='post'>					
														<input type='hidden' name='packageIdDisbursementsStage' id='packageIdDisbursementsStage{$packageID}' value='$packageID' />
														<input type='hidden' name='userIdDisbursementsStage' id='userIdDisbursementsStage{$packageID}' value='$userId' />
														<input type='hidden' name='pi_4DisbursementsStage' id='pi_4DisbursementsStage{$packageID}' value='$pi_4' />
														<input type='hidden' name='pi_5DisbursementsStage' id='pi_5DisbursementsStage{$packageID}' value='$pi_5' />
														<input type='hidden' name='pi_6DisbursementsStage' id='pi_6DisbursementsStage{$packageID}' value='$pi_6' />
														<input type='hidden' name='packageNameDisbursementsStage' id='packageNameDisbursementsStage{$packageID}' value='$packageName' />
														<input type='button' name='viewDisbursementsStage{$packageID}' id='viewDisbursementsStage{$packageID}' value='Refresh' class='FormSubmitBtn' />	
													</form>		
													</td>
													<td style='text-align:right;background:#ffffff;'>
													<form action='disbursementsEdit.php' method='post' target='_blank'>
														<input type='hidden' name='pi_4' value='$pi_4'/>
														<input type='hidden' name='pi_5' value='$pi_5'/>
														<input type='hidden' name='pi_6' value='$pi_6'/>
														<input type='hidden' name='packageId' value='$packageID'/>
														<input type='hidden' name='packageName' value='$packageName'/>
														<input type='submit' name='editSubmitDisbursementsStage'  value='Update Info'/>
													</form>
													</td>
												</tr>
												</table>
											</td>
										</tr>				
										";	
					$psBkdnQuery = "
								SELECT
										adbs_disbursementproject_child.pId,
										adbs_disbursementproject_child.bpc_79h,
										adbs_disbursementproject_child.bpc_79i,
										adbs_disbursementproject_child.bpc_79j,
										adbs_disbursementproject_child.entDate
										
								FROM
										adbs_disbursementproject_child
								WHERE
										adbs_disbursementproject_child.pId='$packageID'
								ORDER BY
										adbs_disbursementproject_child.dpcId				
								LIMIT 0, 8 		
								";
							  
						$psBkdnQueryStatement			= mysql_query($psBkdnQuery);
						$paymentBkdnShow = '';
						while($packageStatementData	= mysql_fetch_array($psBkdnQueryStatement)){
							
						if($mv%2==0) {
							$packageClass="evenRow";
						} else {
							$packageClass="oddRow";
						}

							$bpc_79h        = $packageStatementData["bpc_79h"];
							$bpc_79i        = $packageStatementData["bpc_79i"];
							$bpc_79j        = $packageStatementData["bpc_79j"];
							$entDatedp      = showDateFormat($packageStatementData["entDate"]);
					
									$paymentBkdnShow .= "<tr class='$packageClass' >
															<td>{$bpc_79h}</td>
															<td>{$bpc_79i}</td>
															<td>".number_format($bpc_79j,2)."</td>
														</tr>						
															";						
						$mv++;
						}
						
						$packageView .= "
										<tr>
											<td colspan='5'>
												<table width='100%' >
												 	<tr style='background:#DDDDDD;'>
														<td style='width:33%;'>Quarter no</td>
														<td style='width:33%;'>Year</td>
														<td style='width:33%;'>Projection Amount</td>
													</tr>
													{$paymentBkdnShow}
													
												</table>
											</td>
										</tr>
													
										";					
					
				// View Actual Disbursements to Contractor / Supplier
				
					
					$psBkdnChileQuery = "
							SELECT
										adbs_paymentstage_bkdn.pId,
										adbs_paymentstage_bkdn.psbkdn_QuaterNo,
										adbs_paymentstage_bkdn.psbkdn_Year,
										adbs_paymentstage_bkdn.entDate,
										adbs_paymentstage_bkdn.psbkdn_Actual
										
								FROM
										adbs_paymentstage_bkdn
								WHERE
										adbs_paymentstage_bkdn.pId='$packageID'
								ORDER BY
										adbs_paymentstage_bkdn.psbkdn_flag				
							  ";
							  
						$psBkdnChileQueryStatement			= mysql_query($psBkdnChileQuery);
						$paymentBkdnChildShow = '';
						while($psBkdnChileQueryStatementData	= mysql_fetch_array($psBkdnChileQueryStatement)){
							
						if($mv%2==0) {
							$packageClass="evenRow";
						} else {
							$packageClass="oddRow";
						}

							$psbkdn_QuaterNo      = $psBkdnChileQueryStatementData["psbkdn_QuaterNo"]; 
							$psbkdn_Year          = $psBkdnChileQueryStatementData["psbkdn_Year"];
							$psbkdn_Actual        = $psBkdnChileQueryStatementData["psbkdn_Actual"];
							$entDatedp      	  = showDateFormat($psBkdnChileQueryStatementData["entDate"]);
						$mv++;
						}	
					
					$sqlYear = "Select distinct psbkdn_Year from adbs_paymentstage_bkdn WHERE pId='".$packageID."' order by psbkdn_Year";
					$sqlYearQuery = mysql_query($sqlYear);
					while($sqlYearQueryResult = mysql_fetch_array($sqlYearQuery)){			
						
					$sqlQuater = "Select distinct psbkdn_QuaterNo from adbs_paymentstage_bkdn WHERE pId='".$packageID."' AND psbkdn_Year='".$sqlYearQueryResult['psbkdn_Year']."' order by psbkdn_QuaterNo";
					$sqlQuaterQuery = mysql_query($sqlQuater);
					while($sqlQuaterQueryResult = mysql_fetch_array($sqlQuaterQuery)){
					$sqlAmount = "Select sum(psbkdn_Actual) from adbs_paymentstage_bkdn where psbkdn_QuaterNo='".$sqlQuaterQueryResult['psbkdn_QuaterNo']."' AND psbkdn_Year='".$sqlYearQueryResult['psbkdn_Year']."' AND pId='".$packageID."'";
					$sqlAmountQuery = mysql_query($sqlAmount);
					$sqlAmountQueryResult = mysql_fetch_array($sqlAmountQuery);
					
					$amount 		 = $sqlAmountQueryResult['sum(psbkdn_Actual)']; 
					$psbkdn_QuaterNo = $sqlQuaterQueryResult["psbkdn_QuaterNo"]; 
					$psbkdn_Year 	 = $sqlYearQueryResult["psbkdn_Year"];
					 
					if($psbkdn_Year != '1970') { 
					$paymentBkdnChildShow .= "<tr class='$packageClass' >
										<td>{$psbkdn_QuaterNo}</td>
										<td>{$psbkdn_Year}</td>
										<td>".number_format($amount,2)."</td>
									</tr>					
									";	
					$mv++;
					}
					} 
					}
						$packageView .= "
										<tr>
											<td colspan='5'>
												<table width='100%' >
													<tr style='background:#ffffff;'>
														<td style='width:100%;' colspan='3'><b>Actual Disbursements to Contractor / Supplier:</b></td>
													</tr>
												 	<tr style='background:#DDDDDD;'>
														<td style='width:33%;'>Quarter no</td>
														<td style='width:33%;'>Year</td>
														<td style='width:33%;'>Actual disbursement amount</td>
													</tr>
													{$paymentBkdnChildShow}
												</table>
											</td>
										</tr>
										<tr style='background:#ffffff;'>
											<td style='text-align:left;width:100%;padding-left:5px;font-size:12px;' colspan='5'><center>Last Updated: <b>$entDatedp</b>, Updated By: <b>$userName</b></center></td>
										</tr>
										";
						
						// View Disbursement Projection: 										
												
				} else {
					$packageView .= "
									<tr style='background:#F7F4F4'>
										<td colspan='2' style='text-align:center; color:red;'>&nbsp;</td>
									</tr>
									<tr style='background:#F7F4F4'>
										<td colspan='1' style='text-align:center; color:red;padding-left:25%;'> 
										
									<table>	
									  <tr>
										<td>
										<form action='disbursements.php' method='post' target='_blank'>
										<input type='hidden' name='pi_4' id='pi_4' value='$pi_4' />
										<input type='hidden' name='pi_5' id='pi_5' value='$pi_5' />
										<input type='hidden' name='pi_6' id='pi_6' value='$pi_6' />
										<input type='hidden' name='packageId' value='$packageID'/>
										<input type='hidden' name='packageName' value='$packageName'/>
										<input type='submit' name='disbursementsStage'  value='No Data Found Insert New Data'/>
										</form>
										</td>
										<td>
                                      	
													<script  type='text/javascript'>		
															$(document).ready(function() {			
																$('#viewDisbursementsStage{$packageID}').click(function(){					
																	var packageIdDisbursementsStage 			= $('#packageIdDisbursementsStage{$packageID}').val();
																	var userIdDisbursementsStage				= $('#userIdDisbursementsStage{$packageID}').val();	
																	var pi_4DisbursementsStage					= $('#pi_4DisbursementsStage{$packageID}').val();
																	var pi_5DisbursementsStage					= $('#pi_5DisbursementsStage{$packageID}').val();	
																	var pi_6DisbursementsStage					= $('#pi_6DisbursementsStage{$packageID}').val();	
																	var packageNameDisbursementsStage			= $('#packageNameDisbursementsStage{$packageID}').val();																							
																$('#viewDisbursementsStage{$packageID}').html();																	
																	$.post('ajax/getVieweDisbursementsStage.php',{'packageIdDisbursementsStage': packageIdDisbursementsStage, 'userIdDisbursementsStage': userIdDisbursementsStage, 'pi_4DisbursementsStage': pi_4DisbursementsStage,'pi_5DisbursementsStage': pi_5DisbursementsStage, 'pi_6DisbursementsStage': pi_6DisbursementsStage, 'packageNameDisbursementsStage':packageNameDisbursementsStage},
																	function(data)
																	{  	
																		$('#showResultsDisbursementsStage{$packageID}').html(data);
																	});
																})				 
															});		
													</script>
													
													<form method='post'>					
														<input type='hidden' name='packageIdDisbursementsStage' id='packageIdDisbursementsStage{$packageID}' value='$packageID' />
														<input type='hidden' name='userIdDisbursementsStage' id='userIdDisbursementsStage{$packageID}' value='$userId' />
														<input type='hidden' name='pi_4DisbursementsStage' id='pi_4DisbursementsStage{$packageID}' value='$pi_4' />
														<input type='hidden' name='pi_5DisbursementsStage' id='pi_5DisbursementsStage{$packageID}' value='$pi_5' />
														<input type='hidden' name='pi_6DisbursementsStage' id='pi_6DisbursementsStage{$packageID}' value='$pi_6' />
														<input type='hidden' name='packageNameDisbursementsStage' id='packageNameDisbursementsStage{$packageID}' value='$packageName' />
														<input type='button' name='viewDisbursementsStage{$packageID}' id='viewDisbursementsStage{$packageID}' value='Refresh' class='FormSubmitBtn' />	
													</form>				
										</td>
									  </tr>
									</table>
												
									</td>
							</tr>";
				}
				$packageView .= "</table>  
                            </div>
						</div>	
                            <!--  Tab 3 End -->";
				$msv++;
	
	
    // >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> End Disbursements Stage <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
	

		
	// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Start Contract Concluding Stage <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
	
    // >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> End Contract Concluding Stage <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
	
	
	// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Start Others Information <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
	
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
								</div>
							</div>
									<!--  Tab 10 End --> 
								</div>
					  	<!-- end of details -->	
				</div><br/></td></tr>";
				$msv++;
	
    // >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> End Others Information <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
			}
				
		
			
			}else{
				 $packageView .= "<tr><td style='font-weight:bold;background:#069;margin-top:20px;color:#ffffff;padding:7px;'><center>Sorry! No Data Found.</center></td></tr>";

			}
			$packageView .= "</table>";


  echo $packageView ;

				

?>
