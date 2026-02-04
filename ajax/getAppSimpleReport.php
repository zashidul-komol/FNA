<?php

	include('../config/dbinfo.inc.php');
	
function showDateMySQlFormat($date){
	
		$exp = explode("-",$date);				
		$mysqlDateF = $exp[2]."-".$exp[1]."-".$exp[0];
		
		return $mysqlDateF;
}

	$ptId 	= $_REQUEST['ptId'];
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
			

	$tableView = "";	
	$tableView .="<table width='100%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:85%; border: 1px dotted #000'>

					  <tr>

						<td colspan='18' align='center' valign='middle' style='border: 1px dotted #000'>

							<center><b>ADB Procurement Automation Software<br/>Annual Procurement Plan</b></center>

						</td>

					  </tr>

					  <tr>

						<td colspan='18' align='left' valign='top'>

							<table width='100%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:85%;'>

							  <tr>

								<td width='54%' align='left' valign='top'>Ministry/Division: <b> $ministryDivision </td>

								<td width='21%'>&nbsp;</td>

								<td width='25%'>&nbsp;</td>

							  </tr>

							  <tr>

								<td align='left' valign='top'>Agency: <b> $eaName </td>

								<td>&nbsp;</td>

								<td align='right' valign='top'>Date: ".date('d-m-Y H:i:s A')."</td>

							  </tr>

							  <tr>

								<td align='left' valign='top'>Procuring Entity Name & Code:</td>

								<td>&nbsp;</td>

								<td>&nbsp;</td>

							  </tr>

							  <tr>

								<td align='left' valign='top'>Project/Programme Name & Code:<b> $adbProjectName </td>

								<td>&nbsp;</td>

								<td>&nbsp;</td>

							  </tr>

							  <tr>

								<td align='left' valign='top'>&nbsp;</td>

								<td>&nbsp;</td>

								<td>&nbsp;</td>

							  </tr>

							</table>

						</td>

					  </tr>

					  <tr>

						<td align='left' valign='top' style='border: 1px dotted #000'>Package No</td>

						<td align='left' valign='top'  style='border: 1px dotted #000'>Contract Name</td>

						<td align='left' valign='top' style='border: 1px dotted #000'>Unit</td>

						<td align='left' valign='top' style='border: 1px dotted #000'>Quantity</td>

						<td align='left' valign='top' style='border: 1px dotted #000'>Procurement Method &amp; Type</td>

						<td align='left' valign='top' style='border: 1px dotted #000'>Contract Approving Authority</td>

						<td align='left' valign='top' style='border: 1px dotted #000'>Sources Of Fund</td>

						<td align='left' valign='top' style='border: 1px dotted #000'>Estd. Cost in Million Tk</td>

						<td align='left' valign='top' style='border: 1px dotted #000'>Time Code For Process</td>

						<td align='left' valign='top' style='border: 1px dotted #000'>Not used in Goods</td>

						<td align='left' valign='top' style='border: 1px dotted #000'>Invite/Advertise Tender</td>

						<td align='left' valign='top' style='border: 1px dotted #000'>Tender Opening</td>

						<td align='left' valign='top' style='border: 1px dotted #000'>Tender Evaluation</td>

						<td align='left' valign='top' style='border: 1px dotted #000'>Approval to Award</td>

						<td align='left' valign='top' style='border: 1px dotted #000'>Notification of Award</td>

						<td align='left' valign='top' style='border: 1px dotted #000'>Signing Of Contract</td>

						<td align='left' valign='top' style='border: 1px dotted #000'>Total time of Contract Signature</td>

						<td align='left' valign='top' style='border: 1px dotted #000'>Time for Completion of Contract</td>

					  </tr>
					 
					  
					  
					    <tr>

						<td align='left' valign='top' style='border: 1px dotted #000'>1</td>

						<td align='left' valign='top'  style='border: 1px dotted #000'>2</td>

						<td align='left' valign='top' style='border: 1px dotted #000'>3</td>

						<td align='left' valign='top' style='border: 1px dotted #000'>4</td>

						<td align='left' valign='top' style='border: 1px dotted #000'>5</td>

						<td align='left' valign='top' style='border: 1px dotted #000'>6</td>

						<td align='left' valign='top' style='border: 1px dotted #000'>7</td>

						<td align='left' valign='top' style='border: 1px dotted #000'>8</td>

						<td align='left' valign='top' style='border: 1px dotted #000'>9</td>

						<td align='left' valign='top' style='border: 1px dotted #000'>10</td>

						<td align='left' valign='top' style='border: 1px dotted #000'>11</td>

						<td align='left' valign='top' style='border: 1px dotted #000'>12</td>

						<td align='left' valign='top' style='border: 1px dotted #000'>13</td>

						<td align='left' valign='top' style='border: 1px dotted #000'>14</td>

						<td align='left' valign='top' style='border: 1px dotted #000'>15</td>

						<td align='left' valign='top' style='border: 1px dotted #000'>16</td>

						<td align='left' valign='top' style='border: 1px dotted #000'>17</td>

						<td align='left' valign='top' style='border: 1px dotted #000'>18</td>

					  </tr>"
					 
					  ;

// Query here.
							
							// Package Information View Report Start 	 <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<		
								$pi_14 	= '';
								$pi_6 	= '';
								$pi_13 	= '';
								$pi_17 	= '';
								$pId   	= '';
								$pi_4 	= '';
								$pi_7a 	= '';
								$pi_7b 	= '';
								$pi_7c 	= '';
								$pi_7d 	= '';
								$aViewQuery 	= "SELECT 
												  		p.pi_6,
														p.pi_4,
														p.pi_13,
														p.pi_14,
														p.pi_17,
														p.pId,
														p.pi_7a,
														p.pi_7b,
														p.pi_7c,
														p.pi_7d
												FROM 
													adbs_package p, s_user u 
												WHERE p.psId = u.psId 
											    AND u.USER_ID = $userId
												AND p.ptId = $ptId
												ORDER BY p.pId ASC";
								$aViewStatement			= mysql_query($aViewQuery);
								while($aViewStatementData	= mysql_fetch_array($aViewStatement)){ 
								
								 $pi_6        = $aViewStatementData["pi_6"]; 
								 $pi_4        = $aViewStatementData["pi_4"]; 
								 $pi_14       = $aViewStatementData["pi_13"]; 
								 $pi_13       = $aViewStatementData["pi_14"]; 
								 $pi_17       = $aViewStatementData["pi_17"]; 	
								 $pId         = $aViewStatementData["pId"];
								 $pi_7a       = $aViewStatementData["pi_7a"];
								 $pi_7b       = $aViewStatementData["pi_7b"];
								 $pi_7c       = $aViewStatementData["pi_7c"];
								 $pi_7d       = $aViewStatementData["pi_7d"];
								 $pi_7d_calculation = ($pi_7d/100000);
							
							// Package Information View Report End
							
							

							/*$start = '2014-07-01';
							$end = '2014-07-22';
							$diff = (strtotime($end)- strtotime($start))/24/3600; 
							echo $diff;*/


							
							// adbs_biddingproposalstage View Report Start bps_38	 <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<	
								
								
								$bps_38 = '';
								$bpsSql	= "SELECT * FROM adbs_biddingproposalstage WHERE pId='".$pId."' ORDER BY bpsId";
								$bpsSqlStatement		= mysql_query($bpsSql);
								$bpsSqlStatementData	= mysql_fetch_array($bpsSqlStatement);
								$bps_38       			= showDateMySQlFormat($bpsSqlStatementData["bps_38"]);
								
								
								
								$bpes_38 = '';
								$bpes_51 = '';
								$bpesSql	= "SELECT * FROM adbs_bidproposalevaluationstage WHERE pId='".$pId."' ORDER BY bpesId";
								$bpesSqlStatement		= mysql_query($bpesSql);
								$bpesSqlStatementData	= mysql_fetch_array($bpesSqlStatement);
								$bpes_50       			= $bpesSqlStatementData["bpes_50"];
								$bpes_51       			= $bpesSqlStatementData["bpes_51"];
								
								// adbs_evaluationreportapprovalstage
								
								$eras_63 = '';
								$erasSql	= "SELECT * FROM adbs_evaluationreportapprovalstage WHERE pId='".$pId."' ORDER BY erasId";
								$erasSqlStatement		= mysql_query($erasSql);
								$erasSqlStatementData	= mysql_fetch_array($erasSqlStatement);
								$eras_63       			= $erasSqlStatementData["eras_63"];
							
								$cs_64 = '';
								$cs_68 = '';
								$csSql	= "SELECT * FROM adbs_contractingstage WHERE pId='".$pId."' ORDER BY csId";
								$csSqlStatement		= mysql_query($csSql);
								$csSqlStatementData	= mysql_fetch_array($csSqlStatement);
								$cs_64       			= $csSqlStatementData["cs_64"];
								$cs_68       			= showDateMySQlFormat($csSqlStatementData["cs_68"]);
								
								$cms_38 = '';
								$cmsSql	= "SELECT * FROM adbs_contractmanagementstage WHERE pId='".$pId."' ORDER BY cmsId";
								$cmsSqlStatement		= mysql_query($cmsSql);
								$cmsSqlStatementData	= mysql_fetch_array($cmsSqlStatement);
								$cms_74       			= showDateMySQlFormat($cmsSqlStatementData["cms_74"]);
								
								// calculation calender 
								
								$firstResult = (strtotime($bpes_50)- strtotime($bps_38))/24/3600; 
								$secoundResult = (strtotime($bpes_51)- strtotime($bpes_50))/24/3600;
								$therdResult = (strtotime($eras_63)- strtotime($bpes_51))/24/3600;
								$fourthResult = (strtotime($cs_64)- strtotime($eras_63))/24/3600;
								$fifthResult = (strtotime($cs_68)- strtotime($cs_64))/24/3600;
								$sixthResult = (strtotime($cms_74)- strtotime($cs_68))/24/3600;
								
								$totalFirst = ($firstResult) + ($secoundResult) + ($therdResult) + ($fourthResult) + ($fifthResult) ;
							
							// Package NO PI_17  View Report End

 // Dynamic Row Start

						$tableView .="<tr>

										<td rowspan='3' align='left' valign='top' style='border: 1px dotted #000'> $pi_4 </td>

										<td rowspan='3' align='left' valign='top'  style='border: 1px dotted #000'> $pi_6 </td>

										<td rowspan='3' align='left' valign='top' style='border: 1px dotted #000'> $pi_7a </td>

										<td rowspan='3' align='left' valign='top' style='border: 1px dotted #000'> $pi_7b </td>

										<td rowspan='3' align='left' valign='top' style='border: 1px dotted #000'> $pi_13, $pi_14  </td>

										<td rowspan='3' align='left' valign='top' style='border: 1px dotted #000'> $pi_17 </td>

										<td rowspan='3' align='left' valign='top' style='border: 1px dotted #000'>  $pi_7c </td>

										<td rowspan='3' align='left' valign='top' style='border: 1px dotted #000'>".number_format($pi_7d_calculation ,2)."</td>

										<td align='left' valign='top' style='border: 1px dotted #000'>Planned Dates</td>

										<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

										<td align='left' valign='top' style='border: 1px dotted #000'> $bps_38 </td>

										<td align='left' valign='top' style='border: 1px dotted #000'> $bpes_50 </td>

										<td align='left' valign='top' style='border: 1px dotted #000'> $bpes_51 </td>

										<td align='left' valign='top' style='border: 1px dotted #000'> $eras_63 </td>

										<td align='left' valign='top' style='border: 1px dotted #000'> $cs_64 </td>

										<td align='left' valign='top' style='border: 1px dotted #000'> $cs_68 </td>

										<td rowspan='3' align='' valign='' style='border: 1px dotted #000'>".number_format($totalFirst,2)."</td>

										<td align='left' valign='top' style='border: 1px dotted #000'> $cms_74 </td>

									</tr>

									  <tr>

										<td align='left' valign='top' style='border: 1px dotted #000'>Planned Days</td>

										<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

										<td align='left' valign='top' style='border: 1px dotted #000'> 0 </td>

										<td align='left' valign='top' style='border: 1px dotted #000'>".number_format($firstResult,2)."</td>

										<td align='left' valign='top' style='border: 1px dotted #000'>".number_format($secoundResult,2)."</td>

										<td align='left' valign='top' style='border: 1px dotted #000'>".number_format($therdResult,2)."</td>

										<td align='left' valign='top' style='border: 1px dotted #000'>".number_format($fourthResult,2)."</td>

										<td align='left' valign='top' style='border: 1px dotted #000'>".number_format($fifthResult,2)."</td>

										<td align='left' valign='top' style='border: 1px dotted #000'>".number_format($sixthResult,2)."</td>

									</tr>

									  <tr>

										<td align='left' valign='top' style='border: 1px dotted #000'>Actual Dates</td>

										<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

										<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

										<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

										<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

										<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

										<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

										<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

										<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

									</tr>";

								// Dynamic Row End		  

					}								  

					$tableView .="

						<tr>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top'  style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

						</tr>					

					</table>";

	

	

	

	

	

	echo $tableView;

?>