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
			$psSqlStatement			= mysql_query($psSql);
			while($psSqlStatementData	= mysql_fetch_array($psSqlStatement)){
			$eaName        			= $psSqlStatementData["eaName"];
			$ministryDivision       = $psSqlStatementData["ministryDivision"];
			$adbProjectName       = $psSqlStatementData["adbProjectName"];
			}
			
			//Ministry/Division and Project/Programme Name View Report End
			
			$ptIdAdvance 	='';
			
			$ptId 				= $_REQUEST['ptId'];
			$ptIdAdvance 		= $_REQUEST['ptIdAdvance']; 
			$pmId 				= $_REQUEST['piProcurementMethod']; 
			$bpId 				= $_REQUEST['piBiddingProcedure']; 
			$pi_18 				= $_REQUEST['piPriorReview']; 
			$pi_19 				= $_REQUEST['piPrequalificationProcess']; 
			$pi_6 				= $_REQUEST['contractName']; 
			

			
			$psId = '';
			$psSql	= "SELECT * FROM s_user WHERE USER_ID='".$userId."' ORDER BY USER_ID";
			$psSqlStatement		= mysql_query($psSql);
			$psSqlStatementData	= mysql_fetch_array($psSqlStatement);
			$psId       			= $psSqlStatementData["psId"];
			
			$whereQue		 = '';

			if(!empty($ptId) && ($ptId !='')){
				$whereQue .= " AND ptId = $ptId";
			}
			if(!empty($ptIdAdvance) && ($ptIdAdvance !='')){
				$whereQue .= " AND ptId = $ptIdAdvance";
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
				$whereQue .= " AND pi_6 = '".$pi_6."'";
			}
			
			

	// View Package in home page >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>   Search Results  start  <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
	

			$packageView = "<table border='0' width='100%' align='left' cellspacing='0' cellpadding='3' style='font-size:13px;'>";
			$admin = 1; 
						
			$packageServQuery = "SELECT * FROM adbs_package WHERE psId='$psId' {$whereQue}"; 
										
			$msv							= 1;
						
			$packageServStatement			= mysql_query($packageServQuery);
			$countRows						= mysql_num_rows($packageServStatement);
			if($countRows > 0){
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
				$pi_4            = $packageServStatementData["pi_4"]; 
				$pi_5            = $packageServStatementData["pi_5"]; 
				$pi_6            = substr($packageServStatementData["pi_6"],0, 35);
				
				$packageView .= "<tr class='$class'><td style='font-weight:bold;background:#069;margin-top:20px;color:#ffffff;padding:7px;'><span onclick=\"return ShowHide('viewPackageInformation{$packageID}')\" style='display:block;cursor:pointer'>$pi_4, $pi_5, $pi_6 .....</span></td></tr>";
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
				$show = "<li><a href='#tabs{$packageID}-2'>PQ Stage</a></li>";
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
												<li><a href='#tabs{$packageID}-1'>Package Information</a></li>
												$show
												<li><a href='#tabs{$packageID}-3'>DBD Stage</a></li>
												<li><a href='#tabs{$packageID}-4'>Bidding Stage</a></li>
												<li><a href='#tabs{$packageID}-5'>Evaluation Stage</a></li>
												<li><a href='#tabs{$packageID}-6'>Bid Approval Stage</a></li>
												<li><a href='#tabs{$packageID}-7'>Contracting</a></li>
												<li><a href='#tabs{$packageID}-8'>CM Stage</a></li>
												<li><a href='#tabs{$packageID}-9'>CC Stage</a></li>
												<li><a href='#tabs{$packageID}-10'>Others</a></li>
											</ul>
											<!-- Tab 1 Stert  -->
											<div id='tabs{$packageID}-1' >
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
																
															$packageView .= "
																				<tr class='$packageClass'>
																					<td colspan='3' style='text-align:left;background:#ffffff;'>
																					<p style='font-size:17px;'>Package Information:</p>	
																					</td>
																					<td colspan='2' style='text-align:right;background:#ffffff;'>
																						<form action='procurementEdit.php' method='post' target='_blank'>
																							<input type='hidden' name='packageId' value='$packageID'/>
																							<input type='hidden' name='adbPackageName' value='$adbPackageName'/>
																							<input type='submit' name='editSubmitProcurement'  value='Update Info'/>
																						</form>
																					</td>
																				</tr>
																				
																				<tr style='background:#DDDDDD;'>
																					<td style='text-align:left;width:20%;padding-left:10px;'> Package No: </td><td style='width: 28%;text-align:left;padding-left:10px;'> $pi_4</td><td style='width:1%; background:#ffffff;'></td>
																					<td style='text-align:left;width:20%;padding-left:10px;'> Lot No:</td><td style='width: 28%;text-align:left;padding-left:10px;'>$pi_5</td>
																					
																				</tr>
																				
																				<tr class='$packageClass'>
																				<td style='text-align:left;width:20%;padding-left:10px;'> Contract Name:</td><td style='width: 28%;text-align:left;padding-left:10px;'> $pi_6</td><td style='width:1%; background:#ffffff;'></td>
																				<td style='text-align:left;width:20%;padding-left:10px;'> Short Description of Contract:</td><td style='width: 28%;text-align:left;padding-left:10px;'> $pi_7</td>

																				</tr>
																				
																				<tr style='background:#DDDDDD;'>
																					<td style='text-align:left;width:20%;padding-left:10px;'>  Unit:</td><td style='width: 28%;text-align:left;padding-left:10px;'> $pi_7a</td><td style='width:1%; background:#ffffff;'></td>
																					<td style='text-align:left;width:20%;padding-left:10px;'> Quantity :</td><td style='width: 28;text-align:left;padding-left:10px;'> $pi_7b</td>
																					
																				</tr>
																				
																				<tr class='$packageClass'>
																				    <td style='text-align:left;width:20%;padding-left:10px;'> Source of Funds :</td><td style='width: 28%;text-align:left;padding-left:10px;'> $pi_7c</td><td style='width:1%; background:#ffffff;'></td>
																								<td style='text-align:left;width:20%;padding-left:10px;'> Cost Estimate (BDT) :</td><td style='width: 28%;text-align:left;padding-left:10px;'> ".number_format($pi_7d,2)."</td>
																				</tr>
																				
																				<tr style='background:#DDDDDD;'>
																					<td style='text-align:left;width:20%;padding-left:10px;'> Cost Estimate (US$) :</td><td style='width: 28%;text-align:left;padding-left:10px;'> ".number_format($pi_8,2)."</td><td style='width:1%; background:#ffffff;'></td>
																					<td style='text-align:left;width:20%;padding-left:10px;'> Procurement Type :</td><td style='width: 28%;text-align:left;padding-left:10px;'>$pi_13</td>
																				</tr>
																				
																				<tr class='$packageClass'>
																				<td style='text-align:left;width:20%;padding-left:10px;'> Procurement Method :</td><td style='width: 28%;text-align:left;padding-left:10px;'> $pi_14</td><td style='width:1%; background:#ffffff;'></td>
																				<td style='text-align:left;width:20%;padding-left:10px;'> Bidding Procedures  :</td><td style='width: 28%;text-align:left;padding-left:10px;'> $pi_15</td>																						
																					   								
																				</tr>
																				
																				<tr style='background:#DDDDDD;'>
													                                 <td style='text-align:left;width:20%;padding-left:10px;'> Applicability of Guidelines :</td><td style='width: 28%;text-align:left;padding-left:10px;'> $pi_16 </td><td style='width:1%; background:#ffffff;'></td>
                                                                                     <td style='text-align:left;width:20%;padding-left:10px;'> Approving Authority :</td><td style='width: 28%;text-align:left;padding-left:10px;'> $pi_17 </td>	
																				</tr>
																				
																				<tr class='$packageClass'>
																					<td style='text-align:left;width:20%;padding-left:10px;'> Prior Review :</td><td style='width: 28%;text-align:left;padding-left:10px;'> $pi_18</td><td style='width:1%; background:#ffffff;'></td>
																					<td style='text-align:left;width:20%;padding-left:10px;'> Prequalification Process :</td><td style='width: 28%;text-align:left;padding-left:10px;'> $pi_19</td>
																				</tr>
																				

																				
																				
																				
																				
																				
																				
																				<tr style='background:#ffffff;'>
																					<td style='text-align:left;width:20%;padding-left:10px;'> &nbsp; </td><td style='width: 28%;text-align:left;padding-left:10px;'> &nbsp; </td><td style='width:1%; background:#ffffff;'></td>
																					<td style='text-align:left;width:20%;padding-left:10px;'> &nbsp; </td><td style='width: 28%;text-align:left;padding-left:10px;'> &nbsp; </td>
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
																		<!--  Tab 1 End  -->";
														$msv++;
	// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> End Package Information<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<				
				
	// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Start PQ Stage <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
	
		$packageQuery = "
								SELECT
										adbs_pqstage.pqs_20,
										adbs_pqstage.pqs_21,
										adbs_pqstage.pqs_22,
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
						
						$pqs_28         = $packageStatementData["pqs_28"];
						$pqs_28_null = '';
						$pqs_28_date = '';
						if ($pqs_28=='0000-00-00'){
							$pqs_28_null = '';
						}
						else{$pqs_28_date = showDateFormat($packageStatementData["pqs_28"]);}
						
						$pqs_27a		= $packageStatementData["pqs_27a"];
						$pqs_81		    = $packageStatementData["pqs_81"];
						$pqs_82		    = $packageStatementData["pqs_82"];
						$pqs_83		    = $packageStatementData["pqs_83"];
						$pqs_102        = $packageStatementData["pqs_102"];
						$pqs_103        = $packageStatementData["pqs_103"];
						$pqs_104        = $packageStatementData["pqs_104"];
						
						
						
						$packageView .= "
										<tr class='$packageClass'>
											<td colspan='3' style='text-align:left;background:#ffffff;'>
												<p style='font-size:17px;'>Pre Qualification Stage Information:</p>	
											</td>
											<td colspan='2' style='text-align:right;background:#ffffff;'>
												<form action='pqStageEdit.php' method='post' target='_blank'>
													<input type='hidden' name='packageId' value='$packageID'/>
													<input type='hidden' name='packageName' value='$adbPackageName'/>
													<input type='submit' name='editSubmitPQStage'  value='Update Info'/>
												</form>
											</td>
										</tr>
										
							 			<tr class='$packageClass'>
										<td style='text-align:left;width:30%;padding-left:10px;'> Date of DPQD sent to ADB:</td><td style='width: 18%; text-align:left'> &nbsp; $pqs_20_null $pqs_20_date</td><td style='width:1%; background:#ffffff;'></td>
										<td style='text-align:left;width:30%;padding-left:10px;'> Date of ADB's NO on DPQD:</td><td style='width:18%;text-align:left;'> &nbsp; $pqs_21_null $pqs_21_date </td>
										</tr>
										
										<tr style='background:#DDDDDD;'>
										   <td style='text-align:left;width:30%;padding-left:10px;'> Date of EA's Approval on PQD :</td><td style='width: 18%; text-align:left;padding-left:10px;'> $pqs_22_null $pqs_22_date </td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:30%;padding-left:10px;'> Date of Original PQ Submission Deadline:</td><td style='width: 18%;text-align:left;padding-left:10px;'> $pqs_23_null $pqs_23_date</td><td style='width:1%; background:#ffffff;'></td>
											

										</tr>
										
										<tr class='$packageClass'>
											<td style='text-align:left;width:30%;padding-left:10px;'> Date of Revised PQ Submission Deadline:</td><td style='width: 18%;text-align:left;padding-left:10px;'> $pqs_24_null $pqs_24_date</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:30%;padding-left:10px;'> Date of PQ Evaluation Report:</td><td style='width: 18%;text-align:left;padding-left:10px;'> $pqs_25_null $pqs_25_date</td>
										</tr>
										
										<tr style='background:#DDDDDD;'>
											<td style='text-align:left;width:30%;padding-left:10px;'> Date of PQ Evaluation Report Sent to ADB:</td><td style='width: 18%;text-align:left;padding-left:10px;'> $pqs_26_null $pqs_26_date</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:30%;padding-left:10px;'> Date of ADB's NO on PQ Evaluation Report:</td><td style='width: 18%;text-align:left;padding-left:10px;'> $pqs_27_null $pqs_27_date</td>
										</tr>
										
										<tr class='$packageClass'>
											<td style='text-align:left;width:30%;padding-left:10px;'> EA's Approval on PQ Evaluation Report:</td><td style='width: 18%; text-align:left;padding-left:10px;'>$pqs_27a</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:30%;padding-left:10px;'>Date Notifying PQ Bidders:</td><td style='width:18%;text-align:left;padding-left:10px;'>$pqs_28_null $pqs_28_date</td>
										</tr>
										
										<tr style='background:#DDDDDD;'>
											<td style='text-align:left;width:30%;padding-left:10px;'> Number of PQD sold/ Issued:</td><td style='width: 18%;text-align:left;padding-left:10px;'>$pqs_81</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:30%;padding-left:10px;'> Number of PQ Applications:</td><td style='width: 18%;text-align:left;padding-left:10px;'> $pqs_82</td>
										</tr>
										
										<tr class='$packageClass'>
											<td style='text-align:left;width:30%;padding-left:10px;'> Number of Prequalified Bidders:</td><td style='width: 18%;text-align:left;padding-left:10px;'> $pqs_83</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:30%;padding-left:10px;'> Number of Complaints Received by EA : </td><td style='width:18%;text-align:left;padding-left:10px;'>$pqs_102</td>
										</tr>
										
										<tr style='background:#DDDDDD;'>
											<td style='text-align:left;width:30%;padding-left:10px;'> Fraud and Corruption Detected by EA (Yes/ No):</td><td style='width: 18%;text-align:left;padding-left:10px;'> $pqs_103</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:30%;padding-left:10px;'>Short Description of F&C Detected:</td><td style='width:18%;text-align:left;padding-left:10px;'>$pqs_104</td>
										</tr>
										
										
										
										
										
										
										<tr style='background:#ffffff;'>
											<td style='text-align:left;width:30%;padding-left:10px;'> &nbsp; </td><td style='width: 18%;text-align:left;padding-left:10px;'> &nbsp; </td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:30%;padding-left:10px;'> &nbsp; </td><td style='width: 18%;text-align:left;padding-left:10px;'> &nbsp; </td>
										</tr>	
										";
						$mv++;

						}
					}
				 else {
					$packageView .= "
									<tr style='background:#F7F4F4'>
										<td colspan='1' style='text-align:center; color:red;'>&nbsp;</td>
									</tr>
									<tr style='background:#F7F4F4'>
										<td colspan='1' style='text-align:center; color:red;'> 
										<form action='pqStage.php' method='post'>
										<input type='hidden' name='packageId' value='$packageID'/>
										<input type='hidden' name='packageName' value='$adbPackageName'/>
										<input type='submit' name='submitPQStage'  value='No Data Found Insert New Data'/>
										</form>
									</td></tr>";
				 }
				$packageView .= "</table>     
                            </div>
                            <!-- Tab 2 End -->";
				$msv++;
			}
    // >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> End PQ Stage <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<	
	

	
	
	// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Start Bidding Document Preparation Stage <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
	
		$packageQuery = "
								SELECT
										adbs_biddingdocumentpreparationstage.bdps_29,
										adbs_biddingdocumentpreparationstage.bdps_30,
										adbs_biddingdocumentpreparationstage.bdps_31,
										adbs_biddingdocumentpreparationstage.bdps_89,
										adbs_biddingdocumentpreparationstage.bdps_90,
										adbs_biddingdocumentpreparationstage.bdps_32
								FROM
										adbs_biddingdocumentpreparationstage
								WHERE
										adbs_biddingdocumentpreparationstage.pId='$packageID'
								ORDER BY
										adbs_biddingdocumentpreparationstage.bdpsId
							  ";	
	
	$packageView .= "<!-- Tab 3 Start -->
						<div id='tabs{$packageID}-3'>
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
						if ($bdps_29=='0000-00-00'){
							$bdps_29_null = '';
						}
						else{$bdps_29_date = showDateFormat($packageStatementData["bdps_29"]);
						}
						
						$bdps_30         = $packageStatementData["bdps_30"];
						$bdps_30_null = '';
						$bdps_30_date = '';
						if ($bdps_30=='0000-00-00'){
							$bdps_30_null = '';
						}
						else{$bdps_30_date = showDateFormat($packageStatementData["bdps_30"]);}
						
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

					    $bdps_89        = $packageStatementData["bdps_89"];
						$bdps_90        = $packageStatementData["bdps_90"];
						
						$packageView .= "
										<tr class='$packageClass'>
											<td colspan='2' style='text-align:left;background:#ffffff;'>
												<p style='font-size:17px;'>Bidding Document Preparation Stage Information:</p>	
											</td>
                                             
											<td colspan='3' style='text-align:right;background:#ffffff;'>
												<form action='biddingDPStageEdit.php' method='post' target='_blank'>
													<input type='hidden' name='packageId' value='$packageID'/>
													<input type='hidden' name='packageName' value='$packageName'/>
													<input type='submit' name='editSubmitBiddingDPStage'  value='Update Info'/>
												</form>
											</td>
										</tr>
										<tr class='$packageClass'>
											<td style='text-align:left;width:30%;padding-left:10px;'> Date of DBD sent to ADB :</td><td style='width: 18%; text-align:left;padding-left:10px;'> $bdps_29_null $bdps_29_date</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:30%;padding-left:10px;'> Date of ADB's NO on DBD :</td><td style='width: 18%; text-align:left;padding-left:10px;'>  $bdps_30_null $bdps_30_date</td><td style='width:1%; background:#ffffff;'></td>
											
										</tr>
										<tr style='background:#DDDDDD;'>
											<td style='text-align:left;width:30%;padding-left:10px;'>Date of EA's Approval on BD : </td><td style='width: 18%; text-align:left;padding-left:10px;'> $bdps_31_null $bdps_31_date</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:30%;padding-left:10px;'>Date of BD/ 1st Stage BD Availability : </td><td style='width: 18%;text-align:left;padding-left:10px;'> $bdps_32_null $bdps_32_date </td>
										</tr>
										
										<tr class='$packageClass'>
											<td style='text-align:left;width:30%;padding-left:10px;'> Times of Clarification Sought by ADB on DPQD/DBD :</td><td style='width: 18%; text-align:left;padding-left:10px;'> $bdps_89 </td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:30%;padding-left:10px;'> Number of Revision Sought by ADB on DPQD/DBD :</td><td style='width: 18%; text-align:left;padding-left:10px;'>  $bdps_90 </td><td style='width:1%; background:#ffffff;'></td>
											
										</tr>
										
			
			
			
			
			
										<tr style='background:#ffffff;'>
											<td style='text-align:left;width:30%;padding-left:10px;'> &nbsp; </td><td style='width: 18%;text-align:left;padding-left:10px;'> &nbsp; </td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:30%;padding-left:10px;'> &nbsp; </td><td style='width: 18%;text-align:left;padding-left:10px;'> &nbsp; </td>
										</tr>
									
										";
						$mv++;
						
					}
				} else {
					$packageView .= "
									<tr style='background:#F7F4F4'>
										<td colspan='1' style='text-align:center; color:red;'>&nbsp;</td>
									</tr>
									<tr style='background:#F7F4F4'>
										<td colspan='1' style='text-align:center; color:red;'> 
										<form action='biddingDPStage.php' method='post'>
										<input type='hidden' name='packageId' value='$packageID'/>
										<input type='hidden' name='packageName' value='$packageName'/>
										<input type='submit' name='submitBiddingDPStage'  value='No Data Found Insert New Data'/>
										</form>
									</td></tr>";
				}
				$packageView .= "</table>  
                            </div>
                            <!--  Tab 3 End -->";
				$msv++;
			
    // >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> End Bidding Document Preparation Stage <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
	
		
	
	// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Start Bidding / Proposal Stage <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
	
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
						if ($bps_42=='0000-00-00'){
							$bps_42_null = '';
						}
						else{$bps_42_date = showDateFormat($packageStatementData["bps_42"]);}
						
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
						if ($bps_44=='0000-00-00'){
							$bps_44_null = '';
						}
						else{$bps_44_date = showDateFormat($packageStatementData["bps_44"]);}
						
						$bps_45        = $packageStatementData["bps_45"];
						$bps_45_null = '';
						$bps_45_date = '';
						if ($bps_45=='0000-00-00'){
							$bps_45_null = '';
						}
						else{$bps_45_date = showDateFormat($packageStatementData["bps_45"]);}
						
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
						$bps_102		   = $packageStatementData["bps_102"];
						
						$packageView .= "
										<tr class='$packageClass'>
										<td colspan='3' style='text-align:left;background:#ffffff;'>
												<p style='font-size:17px;'>Bidding Stage Information:</p>	
											</td>
											<td colspan='2' style='text-align:right;background:#ffffff;'>
												<form action='biddingProposalStageEdit.php' method='post' target='_blank'>
													<input type='hidden' name='packageId' value='$packageID'/>
													<input type='hidden' name='packageName' value='$packageName'/>
													<input type='submit' name='editSubmitBiddingProposalStage'  value='Update Info'/>
												</form>
											</td>
										</tr>
										<tr class='$packageClass'>
											<td style='text-align:left;width:35%;padding-left:10px;'> Date Inviting Bids from PQ Bidders:</td><td style='width: 13%; text-align:left;padding-left:10px;'> $bps_38_null $bps_38_date</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'>Actual Date of Procurement Notice (PQ/ IFB) Published in National Newspapers (Bangla):</td><td style='width:13%;text-align:left;padding-left:10px;'> $bps_39_null $bps_39_date</td>
										</tr>
										
										<tr style='background:#DDDDDD;'>
											<td style='text-align:left;width:35%;padding-left:10px;'> Date of Procurement Notice (PQ/ IFB) Published in National Newspapers (English):</td><td style='width: 13%;text-align:left;padding-left:10px;'>$bps_40_null $bps_40_date</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'> Date of Procurement Notice (PQ/ IFB) Published in CPTU Website:</td><td style='width: 13%;text-align:left;padding-left:10px;'> $bps_41_null $bps_41_date</td>
										</tr>
										
										<tr class='$packageClass'>
											<td style='text-align:left;width:35%;padding-left:10px;'> Date of Procurement Notice (PQ/ IFB) Published in ADB Website	:</td><td style='width: 13%;text-align:left;padding-left:10px;'> $bps_42_null $bps_42_date</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'> Date of Pre-bid Conference Held :</td><td style='width: 13%;text-align:left;padding-left:10px;'> $bps_43_null $bps_43_date</td>
										</tr>
										
										<tr style='background:#DDDDDD;'>
											<td style='text-align:left;width:35%;padding-left:10px;'> Date of Pre-bid Meeting Minutes Sent to ADB:</td><td style='width: 13%;text-align:left;padding-left:10px;'> $bps_44_null $bps_44_date</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'> Date of ADB's NO on Pre-bid Meeting Minutes:</td><td style='width: 13%;text-align:left;padding-left:10px;'> $bps_45_null $bps_45_date</td>
										</tr>
										
										<tr class='$packageClass'>
											<td style='text-align:left;width:35%;padding-left:10px;'> Date of Pre-bid Meeting Minutes Sent to Bidders:</td><td style='width: 13%; text-align:left;padding-left:10px;'> $bps_46_null $bps_46_date</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'> Date of Original BSD:</td><td style='width:13%;text-align:left;padding-left:10px;'> $bps_48_null $bps_48_date</td>
										</tr>
										
										<tr style='background:#DDDDDD;'>
											<td style='text-align:left;width:35%;padding-left:10px;'> Date of Revised BSD:</td><td style='width: 13%;text-align:left;padding-left:10px;'> $bps_49_null $bps_49_date</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'> Number of BD Sold/ Issued:</td><td style='width: 13%;text-align:left;padding-left:10px;'> $bps_84</td>
										</tr>
										
										<tr class='$packageClass'>
											<td style='text-align:left;width:35%;padding-left:10px;'> Number of Amendments for BD:</td><td style='width: 13%;text-align:left;padding-left:10px;'> $bps_90</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'> Number of Amendments for Technical Specifications:</td><td style='width: 13%;text-align:left;padding-left:10px;'> $bps_91</td>
										</tr>
										
										<tr style='background:#DDDDDD;'>
											<td style='text-align:left;width:35%;padding-left:10px;'> Original Bid Validity Period (days):</td><td style='width: 13%;text-align:left;padding-left:10px;'> $bps_92</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'> Planned Date of Procurement Notice:</td><td style='width: 13%; text-align:left;padding-left:10px;'> $bps_38a_null $bps_38a_date</td><td style='width:1%; background:#ffffff;'></td>

										</tr>
										<tr class='$packageClass'>
											<td style='text-align:left;width:35%;padding-left:10px;'> Number of Complaints Received by EA :</td><td style='width: 13%;text-align:left;padding-left:10px;'> $bps_102</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'> </td><td style='width: 13%;text-align:left;padding-left:10px;'></td>
										</tr>
										
									
									
									
									
									
										<tr style='background:#ffffff;'>
											<td style='text-align:left;width:35%;padding-left:10px;'> &nbsp; </td><td style='width: 13%;text-align:left;padding-left:10px;'> &nbsp; </td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'> &nbsp; </td><td style='width: 13%;text-align:left;padding-left:10px;'> &nbsp; </td>
										</tr>
									
										";
						$mv++;
						
					}
				} else {
					$packageView .= "
									<tr style='background:#F7F4F4'>
										<td colspan='1' style='text-align:center; color:red;'>&nbsp;</td>
									</tr>
									<tr style='background:#F7F4F4'>
										<td colspan='1' style='text-align:center; color:red;'> 
										<form action='biddingProposalStage.php' method='post'>
										<input type='hidden' name='packageId' value='$packageID'/>
										<input type='hidden' name='packageName' value='$packageName'/>
										<input type='submit' name='biddingProposalStageSubmit'  value='No Data Found Insert New Data'/>
										</form>
									</td></tr>";				
				}
				$packageView .= "</table>
									</div>
									<!--  Tab 4 End -->";
				$msv++;
			
    // >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> End Bidding / Proposal Stage <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
	
	
	// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Start Bid / Proposal Evaluation Stage <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
	
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
						
						$bpes_51        = $packageStatementData["bpes_51"];
						$bpes_52		= $packageStatementData["bpes_52"];
						$bpes_53        = $packageStatementData["bpes_53"];
						$bpes_54        = $packageStatementData["bpes_54"];
						
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
						$bpes_97        = $packageStatementData["bpes_97"];
						$bpes_98		= $packageStatementData["bpes_98"];
						$bpes_100       = $packageStatementData["bpes_100"];
						$bpes_101       = $packageStatementData["bpes_101"];
						$bpes_102       = $packageStatementData["bpes_102"];
						$bpes_103		= $packageStatementData["bpes_103"];
						$bpes_112       = $packageStatementData["bpes_112"];
						
						$packageView .= "
										<tr class='$packageClass'>
											<td colspan='3' style='text-align:left;background:#ffffff;'>
												<p style='font-size:17px;'>Bid Evalution Stage Information:</p>	
											</td>
											<td colspan='2' style='text-align:right;background:#ffffff;'>
												<form action='biddingProposalEvaluationStageEdit.php' method='post' target='_blank'>
													<input type='hidden' name='packageId' value='$packageID'/>
													<input type='hidden' name='packageName' value='$packageName'/>
													<input type='submit' name='editSubmitBiddingEvaluationlStage'  value='Update Info'/>
												</form>
											</td>
										</tr>
										
										<tr class='$packageClass'>
											<td style='text-align:left;width:35%;padding-left:10px;'> Date of Bids Opening :</td><td style='width: 13%; text-align:left;padding-left:10px;'> $bpes_50_null $bpes_50_date</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'> Planned Date of Bids Opening :</td><td style='width:13%;text-align:left;padding-left:10px;'> $bpes_54a_null $bpes_54a_date</td>
										</tr>
										
										<tr style='background:#DDDDDD;'>
											<td style='text-align:left;width:35%;padding-left:10px;'> Date of BER:</td><td style='width: 13%;text-align:left;padding-left:10px;'> $bpes_56_null $bpes_56_date</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'> Number of Bids Received:</td><td style='width: 13%;text-align:left;padding-left:10px;'> $bpes_85</td>
										</tr>
										
										<tr class='$packageClass'>
											<td style='text-align:left;width:35%;padding-left:10px;'> Number of Responsive Bids:</td><td style='width: 13%;text-align:left;padding-left:10px;'> $bpes_86</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'> BOS Sent to ADB (Yes/ No):</td><td style='width: 13%;text-align:left;padding-left:10px;'> $bpes_87</td>
										</tr>
										
										<tr style='background:#DDDDDD;'>
											<td style='text-align:left;width:35%;padding-left:10px;'> Revised  Bid Validity Period (days):</td><td style='width: 13%;text-align:left;padding-left:10px;'> $bpes_93</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'> Number of Extension of Bid Validity Period:</td><td style='width: 13%;text-align:left;padding-left:10px;'> $bpes_94</td>
										</tr>
										
										<tr class='$packageClass'>
											<td style='text-align:left;width:35%;padding-left:10px;'> 1st Ranked Bidder's Evaluated Bid Price (Equiv. US$):</td><td style='width: 13%; text-align:left;padding-left:10px;'>".number_format($bpes_97,2)."</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'> 2nd Ranked Bidder's Evaluated Bid Price (Equiv. US$):</td><td style='width:13%;text-align:left;padding-left:10px;'>".number_format($bpes_98,2)." </td>
										</tr>
										
										<tr style='background:#DDDDDD;'>
											<td style='text-align:left;width:35%;padding-left:10px;'> Confidentiality Provision Maintained in Bid Evaluation (Yes/ No):</td><td style='width: 13%;text-align:left;padding-left:10px;'>$bpes_100 </td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'> Short Description of F&C Detected:</td><td style='width:13%;text-align:left;padding-left:10px;'>$bpes_103</td>
										</tr>
										
										<tr class='$packageClass'>
											<td style='text-align:left;width:35%;padding-left:10px;'> Recommendation for Re-invitation for Bids (Yes/ No):</td><td style='width: 13%; text-align:left;padding-left:10px;'>$bpes_112</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'> </td><td style='width:13%;text-align:left;padding-left:10px;'></td>
										</tr>
										
					
					
					
					
					
										<tr style='background:#ffffff;'>
											<td style='text-align:left;width:35%;padding-left:10px;'> &nbsp; </td><td style='width: 13%;text-align:left;padding-left:10px;'> &nbsp; </td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'> &nbsp; </td><td style='width: 13%;text-align:left;padding-left:10px;'> &nbsp; </td>
										</tr>
									
										";
						$mv++;
						
					}
				} else {
					$packageView .= "
									<tr style='background:#F7F4F4'>
										<td colspan='1' style='text-align:center; color:red;'>&nbsp;</td>
									</tr>
									<tr style='background:#F7F4F4'>
										<td colspan='1' style='text-align:center; color:red;'> 
										<form action='bidProposalEvaluationStage.php' method='post'>
										<input type='hidden' name='packageId' value='$packageID'/>
										<input type='hidden' name='packageName' value='$packageName'/>
										<input type='submit' name='bidProposalEvaluationStageSubmit'  value='No Data Found Insert New Data'/>
										</form>
									</td></tr>";	
				}
				$packageView .= "</table>
                            </div>
                            <!--  Tab 5 End -->";
				$msv++;
			
    // >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> End Bid / Proposal Evaluation Stage <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
	
	
	// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Start Evaluation Report Approval Stage <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
	
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
						if ($eras_60a=='0000-00-00'){
							$eras_60a_null = '';
						}
						else{$eras_60a_date = showDateFormat($packageStatementData["eras_60a"]);}
						
						$eras_61        = $packageStatementData["eras_61"];
						$eras_61_null = '';
						$eras_61_date = '';
						if ($eras_61=='0000-00-00'){
							$eras_61_null = '';
						}
						else{$eras_61_date = showDateFormat($packageStatementData["eras_61"]);}
						
						$eras_62        = $packageStatementData["eras_62"];
						$eras_62_null = '';
						$eras_62_date = '';
						if ($eras_62=='0000-00-00'){
							$eras_62_null = '';
						}
						else{$eras_62_date = showDateFormat($packageStatementData["eras_62"]);}
						
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
						
						$eras_95	    = $packageStatementData["eras_95"];
						
						$eras_96        = $packageStatementData["eras_96"];
						$eras_99        = $packageStatementData["eras_99"];
						$eras_101        = $packageStatementData["eras_101"];
						
						$packageView .= "
										<tr class='$packageClass'>
										<td colspan='3' style='text-align:left;background:#ffffff;'>
												<p style='font-size:17px;'>Evaluation Report Approval Stage Information:</p>	
											</td>
											<td colspan='2' style='text-align:right;background:#ffffff;'>
												<form action='evaluationReportApprovalStageEdit.php' method='post' target='_blank'>
													<input type='hidden' name='packageId' value='$packageID'/>
													<input type='hidden' name='packageName' value='$packageName'/>
													<input type='submit' name='editSubmitEvaluationReportApprovalStage'  value='Update Info'/>
												</form>
											</td>
										</tr>
										
										<tr class='$packageClass'>
											<td style='text-align:left;width:35%;padding-left:10px;'> Planned Date of BER Sent to ADB:</td><td style='width: 13%;text-align:left;padding-left:10px;'> $eras_60a_null $eras_60a_date</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'> Actual Date of BER Sent to ADB :</td><td style='width:13%;text-align:left;padding-left:10px;'> $eras_61_null $eras_61_date</td>
										</tr>
										
										<tr style='background:#DDDDDD;'>
											<td style='text-align:left;width:35%;padding-left:10px;'> Date of ADB's NO on BER:</td><td style='width: 13%;text-align:left;padding-left:10px;'> $eras_62_null $eras_62_date</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'> Planned Date of EA's Approval on BER (all):</td><td style='width: 13%;text-align:left;padding-left:10px;'> $eras_62a_null $eras_62a_date</td>
										</tr>
										
										<tr class='$packageClass'>
											<td style='text-align:left;width:35%;padding-left:10px;'> Date of EA's Approval on BER (all):</td><td style='width: 13%;text-align:left;padding-left:10px;'> $eras_63</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'> Times of Clarification Sought by ADB and/or Approving Authority on BER/ TBER/FBER:</td><td style='width: 13%;text-align:left;padding-left:10px;'> $eras_95</td>
										</tr>
										


										<tr style='background:#DDDDDD;'>
											<td style='text-align:left;width:35%;padding-left:10px;'> Number of Revision of BER/ TBER/ FBER Sought by ADB and/or Approving Authority:</td><td style='width: 13%;text-align:left;padding-left:10px;'> $eras_96</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'> NOA in Favour of 1st Ranked Bidder (Yes/ No):</td><td style='width: 13%;text-align:left;padding-left:10px;'>$eras_99</td>
										</tr>
										
										<tr class='$packageClass'>
											<td style='text-align:left;width:35%;padding-left:10px;'> Number of Complaints Received by EA:</td><td style='width: 13%;text-align:left;padding-left:10px;'> $eras_101</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'> </td><td style='width: 13%;text-align:left;padding-left:10px;'></td>
										</tr>





									
										<tr style='background:#ffffff;'>
											<td style='text-align:left;width:35%;padding-left:10px;'> &nbsp; </td><td style='width: 13%;text-align:left;padding-left:10px;'> &nbsp; </td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'> &nbsp; </td><td style='width: 13%;text-align:left;padding-left:10px;'> &nbsp; </td>
										</tr>
										";
						$mv++;
						
					}
				} else {
					$packageView .= "
									<tr style='background:#F7F4F4'>
										<td colspan='1' style='text-align:center; color:red;'>&nbsp;</td>
									</tr>
									<tr style='background:#F7F4F4'>
										<td colspan='1' style='text-align:center; color:red;'> 
										<form action='evaluationReportApprovalStage.php' method='post'>
										<input type='hidden' name='packageId' value='$packageID'/>
										<input type='hidden' name='packageName' value='$packageName'/>
										<input type='submit' name='evaluationPASsubmit'  value='No Data Found Insert New Data'/>
										</form>
									</td></tr>";
				}
				$packageView .= "</table>
                            </div>
                            <!--  Tab 6 End -->";
				$msv++;
			
    // >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> End Evaluation Report Approval Stage <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
	
	
	// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Start Contracting Stage <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
	
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
						if ($cs_70=='0000-00-00'){
							$cs_70_null = '';
						}
						else{$cs_70_date = showDateFormat($packageStatementData["cs_70"]);}
						
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
						
						$packageView .= "
										<tr class='$packageClass'>
											<td colspan='3' style='text-align:left;background:#ffffff;'>
												<p style='font-size:17px;'>Contracting Stage Information:</p>	
											</td>
											<td colspan='2' style='text-align:right;background:#ffffff;'>
												<form action='contractingStageEdit.php' method='post' target='_blank'>
													<input type='hidden' name='packageId' value='$packageID'/>
													<input type='hidden' name='packageName' value='$packageName'/>
													<input type='submit' name='editSubmitContractingStage'  value='Update Info'/>
												</form>
											</td>
										</tr>
										
										<tr class='$packageClass'>
											<td style='text-align:left;width:35%;padding-left:10px;'> Original Contract Price in Contract Currency or Currencies:</td><td style='width: 13%; text-align:left;padding-left:10px;'> ".number_format($cs_9,2)."</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'> Original Contract Price (Equiv. US$:</td><td style='width:13%;text-align:left;padding-left:10px;'>".number_format($cs_11,2)."</td>
										</tr>
										
										<tr style='background:#DDDDDD;'>
											<td style='text-align:left;width:35%;padding-left:10px;'> Planned Date of NOA Issued to Successful Bidder:</td><td style='width: 13%;text-align:left;padding-left:10px;'> $cs_63a_null $cs_63a_date</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'> Actual Date of NOA Issued to Successful Bidder:</td><td style='width: 13%;text-align:left;padding-left:10px;'> $cs_64_null $cs_64_date </td><td style='width:1%; background:#ffffff;'></td>
										</tr>
										
										<tr class='$packageClass'>
											<td style='text-align:left;width:35%;padding-left:10px;'> Acceptance Date of NOA by Successful Bidder:</td><td style='width: 13%; text-align:left;padding-left:10px;'> $cs_65_null $cs_65_date</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'> Issued Date of Performance Security :</td><td style='width:13%;text-align:left;padding-left:10px;'> $cs_66_null $cs_66_date</td>
										</tr>
										
										
										<tr style='background:#DDDDDD;'>
											<td style='text-align:left;width:35%;padding-left:10px;'> Expiry Date of Performance Security:</td><td style='width: 13%;text-align:left;padding-left:10px;'> $cs_67_null $cs_67_date</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'> Planned Date of Contract Signing: </td><td style='width: 13%;text-align:left;padding-left:10px;'> $cs_67a_null $cs_67a_date</td>
										</tr>
										
										<tr class='$packageClass'>
											<td style='text-align:left;width:35%;padding-left:10px;'> Actual Date of Contract Signing:</td><td style='width: 13%;text-align:left;padding-left:10px;'>$cs_68_null $cs_68_date</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'> Date of Contract Award Notification Published into ADB/ CPTU/ Entity's Website:</td><td style='width: 13%;text-align:left;padding-left:10px;'> $cs_69_null $cs_69_date</td>

										</tr>
			
										<tr style='background:#DDDDDD;'>
											<td style='text-align:left;width:35%;padding-left:10px;'> Date of Final Contract Sent to ADB:</td><td style='width: 13%;text-align:left;padding-left:10px;'>$cs_70_null $cs_70_date</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'> Original Scheduled Completion Date:</td><td style='width: 13%;text-align:left;padding-left:10px;'> $cs_72_null $cs_72_date</td>
										</tr>
										
										<tr class='$packageClass'>
											<td style='text-align:left;width:35%;padding-left:10px;'> Debriefing Held (Yes/ No):</td><td style='width: 13%;text-align:left;padding-left:10px;'>$cs_104</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'> Contract with Advance Payment Provision (Yes/ No):</td><td style='width: 13%;text-align:left;padding-left:10px;'>$cs_105</td>
										</tr>
										
										<tr class='$packageClass'>
											<td style='text-align:left;width:35%;padding-left:10px;'>Contract with Price Adjustment Provision  (Yes/ No): </td><td style='width: 13%;text-align:left;padding-left:10px;'>$cs_106</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'> Name of the Supplier/ Contractor (with Country):</td><td style='width: 13%;text-align:left;padding-left:10px;'>$cs_113 </td>
										</tr>
							
									
									
									
									
										<tr style='background:#ffffff;'>
											<td style='text-align:left;width:35%;padding-left:10px;'> &nbsp; </td><td style='width: 13%;text-align:left;padding-left:10px;'> &nbsp; </td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'> &nbsp; </td><td style='width: 13%;text-align:left;padding-left:10px;'> &nbsp; </td>
										</tr>
										";
						$mv++;
						
					}
				} else {
					$packageView .= "
									<tr style='background:#F7F4F4'>
										<td colspan='1' style='text-align:center; color:red;'>&nbsp;</td>
									</tr>
									<tr style='background:#F7F4F4'>
										<td colspan='1' style='text-align:center; color:red;'> 
										<form action='contractingStage.php' method='post'>
										<input type='hidden' name='packageId' value='$packageID'/>
										<input type='hidden' name='packageName' value='$packageName'/>
										<input type='submit' name='contractingStageSubmit'  value='No Data Found Insert New Data'/>
										</form>
									</td></tr>";				
									
				}
				$packageView .= "</table>
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
						
						
						$cms_107        = $packageStatementData["cms_107"];
						$cms_108        = $packageStatementData["cms_108"];
						$cms_109		= $packageStatementData["cms_109"];
						$cms_10         = $packageStatementData["cms_10"];
						$cms_12         = $packageStatementData["cms_12"];
						
						$packageView .= "
										<tr class='$packageClass'>
											<td colspan='3' style='text-align:left;background:#ffffff;'>
												<p style='font-size:17px;'>Contract Management Stage Information:</p>	
											</td>
											<td colspan='2' style='text-align:right;background:#ffffff;'>
												<form action='contractingManagementStageEdit.php' method='post' target='_blank'>
													<input type='hidden' name='packageId' value='$packageID'/>
													<input type='hidden' name='packageName' value='$packageName'/>
													<input type='submit' name='editSubmitContractingManagementStage'  value='Update Info'/>
												</form>
											</td>
										</tr>
										<tr class='$packageClass'>
											<td style='text-align:left;width:35%;padding-left:10px;'> Revised Contract Price in Contract Currency or Currencies:</td><td style='width: 13%; text-align:left;padding-left:10px;'>".number_format($cms_10,2)."</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'> Revised Contract Price (Equiv. US$:</td><td style='width:13%;text-align:left;padding-left:10px;'>".number_format($cms_12,2)."</td>
										</tr>
										
										<tr style='background:#DDDDDD;'>
											<td style='text-align:left;width:35%;padding-left:10px;'> Commencement Date:</td><td style='width: 13%;text-align:left;padding-left:10px;'>$cms_71_null $cms_71_date</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'> Planned date: </td><td style='width:13%;text-align:left;padding-left:10px;'> $cms_72a_null $cms_72a_date </td>
										</tr>
										
										<tr class='$packageClass'>
											<td style='text-align:left;width:35%;padding-left:10px;'> Revised Scheduled Completion Date:</td><td style='width: 13%;text-align:left;padding-left:10px;'> $cms_73_null $cms_73_date</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'> Actual Completion Date:</td><td style='width: 13%;text-align:left;padding-left:10px;'> $cms_74_null $cms_74_date</td>
										</tr>
										
										<tr style='background:#DDDDDD;'>
											<td style='text-align:left;width:35%;padding-left:10px;'> Final Acceptance Date:</td><td style='width: 13%;text-align:left;padding-left:10px;'> $cms_75_null $cms_75_date</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'>Number of Contract Amendments:</td><td style='width: 13%;text-align:left;padding-left:10px;'>$cms_107</td>
										</tr>
										
										<tr class='$packageClass'>
											<td style='text-align:left;width:35%;padding-left:10px;'> Number of Variation Order:</td><td style='width: 13%; text-align:left;padding-left:10px;'>$cms_108</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'>Variation Order Amount (Equiv. US$:</td><td style='width: 13%;text-align:left;padding-left:10px;'>  ".number_format($cms_109,2)."</td>
											
										</tr>

										
									
									
									
									
										<tr style='background:#ffffff;'>
											<td style='text-align:left;width:35%;padding-left:10px;'> &nbsp; </td><td style='width: 13%;text-align:left;padding-left:10px;'> &nbsp; </td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'> &nbsp; </td><td style='width: 13%;text-align:left;padding-left:10px;'> &nbsp; </td>
										</tr>
										";
						$mv++;
						
					}
				} else {
					$packageView .= "
									<tr style='background:#F7F4F4'>
										<td colspan='1' style='text-align:center; color:red;'>&nbsp;</td>
									</tr>
									<tr style='background:#F7F4F4'>
										<td colspan='1' style='text-align:center; color:red;'> 
										<form action='contractManagementStage.php' method='post'>
										<input type='hidden' name='packageId' value='$packageID'/>
										<input type='hidden' name='packageName' value='$packageName'/>
										<input type='submit' name='contractManagementStageSubmit'  value='No Data Found Insert New Data'/>
										</form>
									</td></tr>";				
				}
				$packageView .= "</table>
									</div>
									<!--  Tab 8 End --> ";
				$msv++;
			
    // >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> End Contract Management Stage <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
	
		
	// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Start Contract Concluding Stage <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
	
		$packageQuery = "
								SELECT
										adbs_contractconcludingstage.ccs_76,
										adbs_contractconcludingstage.ccs_77,
										adbs_contractconcludingstage.ccs_78,
										adbs_contractconcludingstage.ccs_79,
										adbs_contractconcludingstage.ccs_80,
										adbs_contractconcludingstage.ccs_110,
										adbs_contractconcludingstage.ccs_111,
										adbs_contractconcludingstage.entDate
								FROM
										adbs_contractconcludingstage
								WHERE
										adbs_contractconcludingstage.pId='$packageID'
								ORDER BY
										adbs_contractconcludingstage.ccsId
							  ";	
	
		$packageView .= " <!-- Tab 9 Start -->
                            <div id='tabs{$packageID}-9'>
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
						$ccs_76         = $packageStatementData["ccs_76"];
						$ccs_76_null = '';
						$ccs_76_date = '';
						if ($ccs_76=='0000-00-00'){
							$ccs_76_null = '';
						}
						else{$ccs_76_date = showDateFormat($packageStatementData["ccs_76"]);}
						
						$ccs_77         = $packageStatementData["ccs_77"];
						$ccs_77_null = '';
						$ccs_77_date = '';
						if ($ccs_77=='0000-00-00'){
							$ccs_77_null = '';
						}
						else{$ccs_77_date = showDateFormat($packageStatementData["ccs_77"]);}
						
						$ccs_78		 = $packageStatementData["ccs_78"];
						$ccs_79         = $packageStatementData["ccs_79"];
						$ccs_80         = $packageStatementData["ccs_80"];
						$ccs_110         = $packageStatementData["ccs_110"];
						$ccs_111		 = $packageStatementData["ccs_111"];
						
						$packageView .= "
										<tr class='$packageClass'>
										<td colspan='2' style='text-align:left;background:#ffffff;'>
												<p style='font-size:17px;'>Contract Concluding Stage Information:</p>	
											</td>
											<td colspan='3' style='text-align:right;background:#ffffff;'>
												<form action='contractConcludingStageEdit.php' method='post' target='_blank'>
													<input type='hidden' name='packageId' value='$packageID'/>
													<input type='hidden' name='packageName' value='$packageName'/>
													<input type='submit' name='editSubmitContractConcludingStage'  value='Update Info'/>
												</form>
											</td>
										</tr>
										<tr class='$packageClass'>
											<td style='text-align:left;width:35%;padding-left:10px;'> Final Bill Date :</td><td style='width: 13%; text-align:left;padding-left:10px;'> $ccs_76_null $ccs_76_date</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'> Final Bill Payment Date (Cheque Date):</td><td style='width:13%;text-align:left;padding-left:10px;'> $ccs_77_null $ccs_77_date</td>
										</tr>
										

										<tr style='background:#DDDDDD;'>
											<td style='text-align:left;width:35%;padding-left:10px;'> Total Payments Paid to Supplier/ Contractor/ Consultant (Equiv. US$) :</td><td style='width: 13%;text-align:left;padding-left:10px;'>".number_format($ccs_78,2)."</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'> Amounts Paid for Late Payment (Equiv. US$):</td><td style='width: 13%;text-align:left;padding-left:10px;'>".number_format($ccs_79,2)."</td>
										</tr>
										
										<tr class='$packageClass'>
											<td style='text-align:left;width:35%;padding-left:10px;'> LDs imposed on Supplier/ Contractor/ Consultant (Equiv. US$):</td><td style='width: 13%;text-align:left;padding-left:10px;'>".number_format($ccs_80,2)."</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'> Number of Disputes Raised by the Parties:</td><td style='width: 13%;text-align:left;padding-left:10px;'> $ccs_110</td>
										</tr>
										
										<tr style='background:#DDDDDD;'>
											<td style='text-align:left;width:35%;padding-left:10px;'> Number of Unresolved Disputes:</td><td style='width: 13%;text-align:left;padding-left:10px;'> $ccs_111</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'> </td><td style='width: 13%;text-align:left;padding-left:10px;'>  </td>
										</tr>
									
									
									
									
										<tr style='background:#ffffff;'>
											<td style='text-align:left;width:35%;padding-left:10px;'> &nbsp; </td><td style='width: 13%;text-align:left;padding-left:10px;'> &nbsp; </td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:35%;padding-left:10px;'> &nbsp; </td><td style='width: 13%;text-align:left;padding-left:10px;'> &nbsp; </td>
										</tr>	
										";
						$mv++;
						
					}
				} else {
				    $packageView .= "
									<tr style='background:#F7F4F4'>
										<td colspan='1' style='text-align:center; color:red;'>&nbsp;</td>
									</tr>
									<tr style='background:#F7F4F4'>
										<td colspan='1' style='text-align:center; color:red;'> 
										<form action='contractConcludingStage.php' method='post'>
										<input type='hidden' name='packageId' value='$packageID'/>
										<input type='hidden' name='packageName' value='$packageName'/>
										<input type='submit' name='contractConcludingStageSubmit'  value='No Data Found Insert New Data'/>
										</form>
									</td></tr>";					
									
				}
				$packageView .= "</table>
										</div>
										<!--  Tab 9 End --> ";
				$msv++;
			
    // >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> End Contract Concluding Stage <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
	
	
	// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Start Others Information <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
	
		$packageQuery = "
								SELECT
										adbs_othersinformation.oi_114,
										adbs_othersinformation.oi_120,
										adbs_othersinformation.oi_121,
										adbs_othersinformation.entDate
								FROM
										adbs_othersinformation
								WHERE
										adbs_othersinformation.pId='$packageID'
								ORDER BY
										adbs_othersinformation.oiId
							  ";	
	
		$packageView .= " <!-- Tab 10 Start -->
                            <div id='tabs{$packageID}-10'>
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
						$oi_120         = $packageStatementData["oi_120"];
						$oi_121		  = $packageStatementData["oi_121"];
					
						
						$packageView .= "
										<tr class='$packageClass'>
										<td colspan='3' style='text-align:left;background:#ffffff;'>
												<p style='font-size:17px;'>Others Information:</p>	
											</td>
											<td colspan='5' style='text-align:right;background:#ffffff;'>
												<form action='othersInformationEdit.php' method='post' target='_blank'>
													<input type='hidden' name='packageId' value='$packageID'/>
													<input type='hidden' name='packageName' value='$packageName'/>
													<input type='submit' name='editSubmitOthersInformation'  value='Update Info'/>
												</form>
											</td>
										</tr>
										<tr class='$packageClass'>
											<td style='text-align:left;width:30%;'> &nbsp; Remarks, if any :</td><td style='width: 18%; text-align:left'> &nbsp; $oi_114</td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:30%;'> &nbsp; </td><td style='width:18%;text-align:left;'> &nbsp; </td>
										</tr>
										
										
										
										
										
										<tr style='background:#ffffff;'>
											<td style='text-align:left;width:30%;padding-left:10px;'> &nbsp; </td><td style='width: 18%;text-align:left;padding-left:10px;'> &nbsp; </td><td style='width:1%; background:#ffffff;'></td>
											<td style='text-align:left;width:30%;padding-left:10px;'> &nbsp; </td><td style='width: 18%;text-align:left;padding-left:10px;'> &nbsp; </td>
										</tr>	
										";
						$mv++;
						
					}
				} else {
					$packageView .= "
									<tr style='background:#F7F4F4'>
										<td colspan='1' style='text-align:center; color:red;'>&nbsp;</td>
									</tr>
									<tr style='background:#F7F4F4'>
										<td colspan='1' style='text-align:center; color:red;'> 
										<form action='othersInformation.php' method='post'>
										<input type='hidden' name='packageId' value='$packageID'/>
										<input type='hidden' name='packageName' value='$packageName'/>
										<input type='submit' name='othersInformationSubmit'  value='No Data Found Insert New Data'/>
										</form>
									</td></tr>";					
				}
				$packageView .= "</table>
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