<?php

	class pacakgeInformationInsert Extends BaseClass {
		function pacakgeInformationInsert() {
			$this->con=$this->BaseClass();
		}	
		
		
			
		// Insert Package Information start <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
		function insertPacakgeInformation($userId){

			$psId 			= addslashes($_REQUEST["psId"]);
			$pi_4 			= addslashes($_REQUEST["pi_4"]);
			
			$pi_5 			= addslashes($_REQUEST["pi_5"]);
			$pi_6 			= addslashes($_REQUEST["pi_6"]);
			
			$pi_7			= addslashes($_REQUEST["pi_7"]);
			$pi_7a			= addslashes($_REQUEST["pi_7a"]);
			$pi_7b			= addslashes($_REQUEST["pi_7b"]);
			$pi_7c			= addslashes($_REQUEST["pi_7c"]);
			$pi_7d			= str_replace(",", "",$_REQUEST["pi_7d"]);
			
			$pi_8 			= str_replace(",", "",$_REQUEST["pi_8"]);
			$pi_16			= addslashes($_REQUEST["pi_16"]);
			$pi_17			= addslashes($_REQUEST["pi_17"]);
			
		    $Query		= "
									SELECT 
											adbProjectName
									FROM 
											adbs_projectsetup
									WHERE psId = '".$psId."'
								  ";
			$QueryStatement	= mysql_query($Query);
		 	$adbPSResult =	mysql_fetch_array($QueryStatement);
		 	$adbPSName = $adbPSResult['adbProjectName']; 
			 
			
			
			$piProcurementType 			= addslashes($_REQUEST["piProcurementType"]);
			$piProcurementMethod 		= addslashes($_REQUEST["piProcurementMethod"]);
			$piBiddingProcedure 		= addslashes($_REQUEST["piBiddingProcedure"]);
			$piPriorReview 		        = addslashes($_REQUEST["piPriorReview"]); 
			$piPrequalificationProcess 	= addslashes($_REQUEST["piPrequalificationProcess"]); 
			
			$Query		= "
									SELECT 
											ptName
									FROM 
											adbs_procurementtype
									WHERE ptId = '".$piProcurementType."'
								  ";
			$QueryStatement	= mysql_query($Query);
		 	$ptNameResult =	mysql_fetch_array($QueryStatement);
		 	$ptName = $ptNameResult['ptName']; 
			
			$Query		= "
									SELECT 
											pmName
									FROM 
											adbs_procurementmethod
									WHERE pmId = '".$piProcurementMethod."'
								  ";
			$QueryStatement	= mysql_query($Query);
		 	$pmNameResult =	mysql_fetch_array($QueryStatement);
		 	$pmName = $pmNameResult['pmName']; 
			
			$Query		= "
									SELECT 
											bpName
									FROM 
											adbs_biddingprocedure
									WHERE bpId = '".$piBiddingProcedure."'
								  ";
			$QueryStatement	= mysql_query($Query);
		 	$bpNameResult =	mysql_fetch_array($QueryStatement);
		    $bpName = $bpNameResult['bpName'];  

			if ((strtolower($piPriorReview) == 'yes') && (strtolower($piPrequalificationProcess) == 'yes')) {
 		
				$pName  = "{$ptName} with PR,"." {$pmName},"." {$bpName},"." PQ,"." {$adbPSName}, "." {$pi_4}";
			}else if ((strtolower($piPriorReview) == 'yes') && (strtolower($piPrequalificationProcess) == 'no')) {
 				$pName  = "{$ptName} with PR,"." {$pmName},"." {$bpName},"." without PQ,"." {$adbPSName}, "." {$pi_4}";
			}else if ((strtolower($piPriorReview) == 'no') && (strtolower($piPrequalificationProcess) == 'yes')) {
 				$pName  = "{$ptName} without PR,"." {$pmName},"." {$bpName},"." PQ,"." {$adbPSName}, "." {$pi_4}";
			}else if ((strtolower($piPriorReview) == 'no') && (strtolower($piPrequalificationProcess) == 'no')) {
 				$pName  = "{$ptName} without PR,"." {$pmName},"." {$bpName},"." without PQ,"." {$adbPSName}, "." {$pi_4}";
			}
			
			
			$checkDate 			= date('Y-m-d');
			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			$maxPackageId       = '';
			
			$Query		= "
									SELECT 
											pName,
											entUser 
									FROM 
											adbs_package
									WHERE 
											pName = '".$pName."' and
											entUser  = '".$userId."'
									
								  ";
			$QueryStatement	= mysql_query($Query);
			if(mysql_num_rows($QueryStatement)>0) {
				$msg = "
				<span class='errorMsg'>Sorry, Package Name [$pName] already exist!</span><br/><a href='index.php' style='text-decoration:none;font-size:16px;'>Go Home and Insert New Package</a>
		
				";
			} else {
				$insertQuery = "
										INSERT INTO 
													adbs_package
																	(
																		ptId,
																		pmId,
																		bpId,
																		pName,
																		psId,
																		adbPackageName,
																		pi_4,
																		pi_5,
																		pi_6,
																		pi_7,
																		pi_7a,
																		pi_7b,
																		pi_7c,
																		pi_7d,
																		pi_8,
																		pi_13,
																		pi_14,
																		pi_15,
																		pi_16,
																		pi_17,
																		pi_18,
																		pi_19,
																		status,
																		entDate,
																		entTime,
																		entUser
																	) 
															VALUES
																	(
																		'".$piProcurementType."',
																		'".$piProcurementMethod."',
																		'".$piBiddingProcedure."',
																		'".$pName."',
																		'".$psId."',
																		'".$adbPSName."',																		
																		
																		'".$pi_4."',
																		'".$pi_5."',
																		'".$pi_6."',
																		'".$pi_7."',
																		'".$pi_7a."',
																		'".$pi_7b."',
																		'".$pi_7c."',
																		'".$pi_7d."',
																		'".$pi_8."',
																		'".$ptName."',
																		'".$pmName."',
																		'".$bpName."',
																		'".$pi_16."',
																		'".$pi_17."',
																		'".$piPriorReview."',
																		'".$piPrequalificationProcess."',
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									";
				$insertQueryStatement = mysql_query($insertQuery);
				$maxPackageId = mysql_insert_id();
				if($insertQueryStatement){
					$msg = "
			<fieldset>
           <legend style='color:#2C89B5; cursor:pointer;' >Enter Planned Date</legend>	
			<center><form name='inputTabFieldsForm' method='post' action='packageInformation.php' onsubmit='return confirmInputTabFieldsSubmit();'>
			<table> 	
				<tr valign='top' class='rowcolor'>
                    <td width='1%' height='26' align='right'>&nbsp;</td>
                    <td width='58%' height='26' align='right'>
                        Planned Date of Procurement Notice :
                    </td>
                    <td width='41%' height='26' align='left'>
                        <input type='text' id='bps_38a' name='bps_38a' class='FormDateTypeInput' value='' autocomplete='off'>

                    </td>
                </tr>
                
               <tr valign='top' class='rowcolor'>
                    <td width='1%' height='26' align='right'>&nbsp;</td>
                    <td width='58%' height='26' align='right'>
                        Planned Date of Bids Opening:
                    </td>
                    <td width='41%' height='26' align='left'>
                        <input type='text' id='bpes_54a' name='bpes_54a' class='FormDateTypeInput' value='' autocomplete='off'>

                    </td>
                </tr>
                
                <tr valign='top' class='rowcolor'>
                    <td width='1%' height='26' align='right'>&nbsp;</td>
                    <td width='58%' height='26' align='right'>
                       Planned Date of BER Sent to ADB:
                    </td>
                    <td width='41%' height='26' align='left'>
                        <input type='text' id='eras_60a' name='eras_60a' class='FormDateTypeInput' value='' autocomplete='off'>

                    </td>
                </tr>
                
                <tr valign='top' class='rowcolor'>
                    <td width='1%' height='26' align='right'>&nbsp;</td>
                    <td width='58%' height='26' align='right'>
                        Planned Date of EA's Approval on BER (all) :
                    </td>
                    <td width='41%' height='26' align='left'>
                        <input type='text' id='eras_62a' name='eras_62a' class='FormDateTypeInput' value='' autocomplete='off'>

                    </td>
                </tr>
                
               <tr valign='top' class='rowcolor'>
                    <td width='1%' height='26' align='right'>&nbsp;</td>
                    <td width='58%' height='26' align='right'>
                        Planned Date of Contract Signing :
                    </td>
                    <td width='41%' height='26' align='left'>
                        <input type='text' id='cs_67a' name='cs_67a' class='FormDateTypeInput' value='' autocomplete='off'>

                    </td>
                </tr>
                
                <tr valign='top' class='rowcolor'>
                    <td width='1%' height='26' align='right'>&nbsp;</td>
                    <td width='58%' height='26' align='right'>
                       Original Scheduled Completion Date:
                    </td>
                    <td width='41%' height='26' align='left'>
                        <input type='text' id='cs_72' name='cs_72' class='FormDateTypeInput' value='' autocomplete='off'>

                    </td>
                </tr>
				<tr> 
				  <td colspan='2'>
				  </td><td>
						 <input type='hidden' name='checkDate' id='checkDate' value='$checkDate' />
						 <input type='hidden' name='packageId' value='$maxPackageId' />
						 <input type='hidden' name='packageName' value='$pName' />
						 <input type='submit' name='insertActualStage' value='Insert' class='FormSubmitBtn' />
						 <input type='reset'  name='Reset' value='Reset' class='FormResetBtn'>
				   </td>
				 </tr>
			</form>	
			</table>	</center>
		</fieldset>
					";
				} else {
					$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
				}
			}
			return $msg;
			
			
			
			
		}
		// Insert Package Information End
		
		
		// Insert Actual Date Insert start <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
		
		
		function actualStageInsert($userId){

			$bps_38a 			= insertDateMySQlFormat($_REQUEST["bps_38a"]);  
		    $bpes_54a 			= insertDateMySQlFormat($_REQUEST["bpes_54a"]); 
			$eras_60a 			= insertDateMySQlFormat($_REQUEST["eras_60a"]);
			$eras_62a 			= insertDateMySQlFormat($_REQUEST["eras_62a"]);  
			$cs_67a 			= insertDateMySQlFormat($_REQUEST["cs_67a"]);
			$cs_72 			    = insertDateMySQlFormat($_REQUEST["cs_72"]);  
			
			$pQpackageId 		= addslashes($_REQUEST["packageId"]); 
			$pqs_pName 		    = addslashes($_REQUEST["packageName"]); 

			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
			$Query		= "
									SELECT 
											pId 
									FROM 
											adbs_biddingproposalstage
									WHERE LOWER(pId) = '".strtolower($pQpackageId)."'
								  ";
			$QueryStatement	= mysql_query($Query);
			if(mysql_num_rows($QueryStatement)>0) {
				$msg = "<span class='errorMsg'>Sorry, Insert Data Into [$pqs_pName] already exist!</span><br/>
				<a href='index.php' style='text-decoration:none;font-size:16px;'>Go Home and Insert New Package Information</a><br/><br/>
				<input type='button' value='Back' onclick='window.close();' class='FormResetBtn'>";
			} else {
				$insertQuery = " 
												INSERT INTO 
													adbs_biddingproposalstage
																	(
																		pId,
																		bps_38,
																		bps_38a,
																		bps_39,
																		bps_40,
																		bps_41,
																		bps_42,
																		bps_43,
																		bps_44,
																		bps_45,
																		bps_46,
																		bps_47,
																		bps_48,
																		bps_49,
																		bps_84,
																		bps_90,
																		bps_91,
																		bps_92,
																		bps_102,
																		

																		status,
																		entDate,
																		entTime,
																		entUser
																	) 
															VALUES
																	(
																		'".$pQpackageId."',
																		'',
																		'".$bps_38a."',
																		'',
																		'',
																		'',
																		'',
																		'',
																		'',
																		'',
																		'',
																		'',
																		'',
																		'',
																		'',
																		'',
																		'',
																		'',
																		'',
																		
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									";
									$insertQueryStatement = mysql_query($insertQuery);
									
									$insertQuery = " 
									
										INSERT INTO 
													adbs_bidproposalevaluationstage
																	(
																		pId,
																		bpes_50,
																		bpes_51,
																		bpes_52,
																		bpes_53,
																		bpes_54,
																		bpes_54a,
																		bpes_55,
																		bpes_56,
																		bpes_85,
																		bpes_86,
																		bpes_87,
																		bpes_93,
																		bpes_94,
																		bpes_97,
																		bpes_98,
																		bpes_100,
																		bpes_101,
																		bpes_102,
																		bpes_103,
																		bpes_112,
																		bpes_50a,
																		bpes_51a,
																		bpes_56a,
																		bpes_95a,
																		bpes_104,
																		bpes_113,
																		
																		status,
																		entDate,
																		entTime,
																		entUser
																	) 
															VALUES
																	(
																		'".$pQpackageId."',
																		'', 
																		'', 
																		'',
																		'',
																		'',
																		'".$bpes_54a."',
																		'',
																		'',
																		'',
																		'',
																		'',
																		'',
																		'',
																		
																		'',
																		'',
																		'',
																		'',
																		'',
																		'',
																		'',
																		'',
																		'',
																		'',
																		'',
																		'',
																		'',
																		
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									";
									$insertQueryStatement = mysql_query($insertQuery);
									
									$insertQuery = "
										INSERT INTO 
													adbs_evaluationreportapprovalstage
																	(
																		pId,
																		eras_57,
																		eras_58,
																		eras_59,
																		eras_60,
																		eras_60a,
																		eras_61,
																		eras_62,
																		eras_62a,
																		eras_63,
																		eras_95,
																		eras_96,
																		eras_99,
																		eras_101,
																		eras_62b,
																		eras_104,
																		
																		status,
																		entDate,
																		entTime,
																		entUser
																	) 
															VALUES
																	(
																		'".$pQpackageId."',
																		'',
																		'',
																		'',
																		'',
																		'".$eras_60a."',
																		'',
																		'',
																		'".$eras_62a."',
																		'',
																		'',
																		'',
																		'',
																		'',
																		'',
																		'',
																		
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									";
									$insertQueryStatement = mysql_query($insertQuery);
									
									$insertQuery = " 
									
											INSERT INTO 
													adbs_contractingstage
																	(
																		pId,
																		cs_63a,
																		cs_64,
																		cs_65,
																		cs_66,
																		cs_67,
																		cs_67a,
																		cs_68,
																		cs_69,
																		cs_70,
																		cs_9,
																		cs_11,
																		cs_72,
																		cs_104,
																		cs_105,
																		cs_106,
																		cs_113,
																		cs_114a,
																		cs_72a,
																		
																		
																		status,
																		entDate,
																		entTime,
																		entUser
																	) 
															VALUES
																	(
																		'".$pQpackageId."',
																		'',
																		'',
																		'',
																		'',
																		'',
																		'".$cs_67a."',
																		'',
																		'',
																		'',
																		'',
																		'',
																		'".$cs_72."',
																		'',
																		'',
																		'',
																		'',
																		'',
																		'',

																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									";
				$insertQueryStatement = mysql_query($insertQuery);
				if($insertQueryStatement){
					$msg = "<span class='validMsg'>Insert Data Into [ $pqs_pName ] added sucessfully</span><br/>
					<a href='index.php' style='text-decoration:none;font-size:16px;'>Go Home and View Package Information</a><br/><br/>
					";
				} else {
					$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
				}
			}
			return $msg;
		
		}
		// Insert Actual Date Insert End
		
		
		
		// Insert PQ Stage start <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
		
			
		
		function insertPQStage($userId){

			$pqs_20 			= insertDateMySQlFormat($_REQUEST["pqs_20"]);
		    $pqs_21 			= insertDateMySQlFormat($_REQUEST["pqs_21"]);
			$pqs_22 			= insertDateMySQlFormat($_REQUEST["pqs_22"]);
			$pqs_22a 			= insertDateMySQlFormat($_REQUEST["pqs_22a"]);
			$pqs_23 			= insertDateMySQlFormat($_REQUEST["pqs_23"]);
			$pqs_24 			= insertDateMySQlFormat($_REQUEST["pqs_24"]);
			
			$pqs_25 			= insertDateMySQlFormat($_REQUEST["pqs_25"]);
			$pqs_26			    = insertDateMySQlFormat($_REQUEST["pqs_26"]);
			$pqs_27			    = insertDateMySQlFormat($_REQUEST["pqs_27"]);
			$pqs_27a			= insertDateMySQlFormat($_REQUEST["pqs_27a"]); 
			$pqs_28			    = insertDateMySQlFormat($_REQUEST["pqs_28"]);
			
			$pqs_81 			= addslashes($_REQUEST["pqs_81"]);
			$pqs_82 			= addslashes($_REQUEST["pqs_82"]);
			$pqs_83 			= addslashes($_REQUEST["pqs_83"]);
			$pqs_102 			= addslashes($_REQUEST["pqs_102"]);
			$pqs_103			= addslashes($_REQUEST["pqs_103"]);
			$pqs_104			= addslashes($_REQUEST["pqs_104"]);
		
			
			$pQpackageId 		= addslashes($_REQUEST["packageId"]); 
			$pqs_pName 		    = addslashes($_REQUEST["packageName"]); 

			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
			$Query		= "
									SELECT 
											pId 
									FROM 
											adbs_pqstage
									WHERE LOWER(pId) = '".strtolower($pQpackageId)."'
								  ";
			$QueryStatement	= mysql_query($Query);
			if(mysql_num_rows($QueryStatement)>0) {
				$msg = "<span class='errorMsg'>Sorry, Insert Data Into [$pqs_pName] already exist!</span><br/>
				<a href='index.php' style='text-decoration:none;font-size:16px;'>Go Home and Insert New Package Information</a><br/><br/>
				<input type='button' value='Back' onclick='window.close();' class='FormResetBtn'>";
			} else {
				$insertQuery = "
										INSERT INTO 
													adbs_pqstage
																	(
																		pId,
																		pqs_20,
																		pqs_21,
																		pqs_22,
																		pqs_22a,
																		pqs_23,
																		pqs_24,
																		pqs_25,
																		pqs_26,
																		pqs_27,
																		pqs_27a,
																		pqs_28,
																		
																		pqs_81,
																		pqs_82,
																		pqs_83,
																		pqs_101,
																		pqs_102,
																		pqs_103,
																		pqs_104,
																		
																		status,
																		entDate,
																		entTime,
																		entUser
																	) 
															VALUES
																	(
																		'".$pQpackageId."',
																		'".$pqs_20."',
																		'".$pqs_21."',
																		'".$pqs_22."',
																		'".$pqs_22a."',
																		'".$pqs_23."',
																		'".$pqs_24."',
																		'".$pqs_25."',
																		'".$pqs_26."',
																		'".$pqs_27."',
																		'".$pqs_27a."',
																		'".$pqs_28."',
																		'".$pqs_81."',
																		'".$pqs_82."',
																		'".$pqs_83."',
																		'null',
																		'".$pqs_102."',
																		'".$pqs_103."',
																		'".$pqs_104."',
																		
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									";
				$insertQueryStatement = mysql_query($insertQuery);
				if($insertQueryStatement){
					$msg = "<span class='validMsg'>Insert Data Into [ $pqs_pName ] added sucessfully</span><br/>
					<a href='index.php' style='text-decoration:none;font-size:16px;'>Go Home and View Package Information</a><br/><br/>
					<input type='button' value='Back' onclick='window.close();' class='FormResetBtn'>
					";
				} else {
					$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
				}
			}
			return $msg;
		
		}
		// Insert PQ Stage End
		
		// Insert biddingDPStage start <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
		function insertbiddingDPStg($userId){

			$bdps_29 			= insertDateMySQlFormat($_REQUEST["bdps_29"]);
			$bdps_30 			= insertDateMySQlFormat($_REQUEST["bdps_30"]);
			$bdps_31 			= insertDateMySQlFormat($_REQUEST["bdps_31"]);
			$bdps_32 			= insertDateMySQlFormat($_REQUEST["bdps_32"]);
			$bdps_89 			= addslashes($_REQUEST["bdps_89"]);
			$bdps_90 			= addslashes($_REQUEST["bdps_90"]);
			
			
			
			$biddingDPStgpackageId 		    = addslashes($_REQUEST["packageId"]);
			$biddingDPStg_pName 		    = addslashes($_REQUEST["packageName"]);

			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
			$Query		= "
									SELECT 
											pId 
									FROM 
											adbs_biddingdocumentpreparationstage
									WHERE LOWER(pId) = '".strtolower($biddingDPStgpackageId)."'
								  ";
			$QueryStatement	= mysql_query($Query);
			if(mysql_num_rows($QueryStatement)>0) {
				$msg = "<span class='errorMsg'>Sorry, Insert Data Into [$biddingDPStg_pName] already exist!</span><br/>
				<a href='index.php' style='text-decoration:none;font-size:16px;'>Go Home and Insert New Package Information</a><br/><br/>
				<input type='button' value='Back' onclick='window.close();' class='FormResetBtn'>";
			} else {
				$insertQuery = "
										INSERT INTO 
													adbs_biddingdocumentpreparationstage
																	(
																		pId,
																		bdps_29,
																		bdps_30,
																		bdps_31,
																		bdps_32,
																		bdps_33,
																		bdps_34,
																		bdps_35,
																		bdps_36,
																		bdps_37,
																		bdps_89,
																		bdps_90,
															        	status,
																		entDate,
																		entTime,
																		entUser
																	) 
															VALUES
																	(
																		'".$biddingDPStgpackageId."',
																		'".$bdps_29."',
																		'".$bdps_30."',
																		'".$bdps_31."',
																		'".$bdps_32."',
																		'Null',
																		'Null',
																		'Null',
																		'Null',
																		'Null',
																		'".$bdps_89."',
																		'".$bdps_90."',
																		
																		'Active',
																     	'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									";
				$insertQueryStatement = mysql_query($insertQuery);
				if($insertQueryStatement){
					$msg = "<span class='validMsg'>Insert Data Into [ $biddingDPStg_pName ] added sucessfully</span><br/>
					<a href='index.php' style='text-decoration:none;font-size:16px;'>Go Home and View Package Information</a><br/><br/>
					<input type='button' value='Back' onclick='window.close();' class='FormResetBtn'><br/><br/>";
				} else {
					$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
				}
			}
			return $msg;
			
			
			
			
		}
		// Insert biddingDPStage Stage End
		
		
		// Insert Bidding / Proposal Stage start <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
		
			
		
		function insertbiddingProposalStage($userId){

			$bps_38 			= insertDateMySQlFormat($_REQUEST["bps_38"]);
			$bps_38a 			= insertDateMySQlFormat($_REQUEST["bps_38a"]);
		    $bps_39 			= insertDateMySQlFormat($_REQUEST["bps_39"]);
			$bps_40 			= insertDateMySQlFormat($_REQUEST["bps_40"]);
			$bps_41 			= insertDateMySQlFormat($_REQUEST["bps_41"]);
			$bps_42 			= insertDateMySQlFormat($_REQUEST["bps_42"]);
			$bps_43			    = insertDateMySQlFormat($_REQUEST["bps_43"]);
			$bps_44			    = insertDateMySQlFormat($_REQUEST["bps_44"]);
			$bps_45			    = insertDateMySQlFormat($_REQUEST["bps_45"]);
			$bps_46			    = insertDateMySQlFormat($_REQUEST["bps_46"]);
			$bps_48 			= insertDateMySQlFormat($_REQUEST["bps_48"]);
			$bps_49 			= insertDateMySQlFormat($_REQUEST["bps_49"]);
			$bps_84 			= addslashes($_REQUEST["bps_84"]);
			$bps_90 			= addslashes($_REQUEST["bps_90"]);
		
			
			$biddingProposalStagepackageId 		= addslashes($_REQUEST["packageId"]);
			$biddingProposalStage_pName 		    = addslashes($_REQUEST["packageName"]);

			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
			$Query		= "
									SELECT 
											pId 
									FROM 
											adbs_biddingproposalstage
									WHERE LOWER(pId) = '".strtolower($biddingProposalStagepackageId)."'
								  ";
			$QueryStatement	= mysql_query($Query);
			if(mysql_num_rows($QueryStatement)>0) {
				$msg = "<span class='errorMsg'>Sorry, Insert Data Into [$biddingProposalStage_pName] already exist!</span><br/>
				<a href='index.php' style='text-decoration:none;font-size:16px;'>Go Home and Insert New Package Information</a><br/><br/>
				<input type='button' value='Back' onclick='window.close();' class='FormResetBtn'>";
			} else {
				$insertQuery = "
										INSERT INTO 
													adbs_biddingproposalstage
																	(
																		pId,
																		bps_38,
																		bps_38a,
																		bps_39,
																		bps_40,
																		bps_41,
																		bps_42,
																		bps_43,
																		bps_44,
																		bps_45,
																		bps_46,
																		bps_47,
																		bps_48,
																		bps_49,
																		bps_84,
																		bps_90,
																		bps_91,
																		bps_92,
																		bps_102,
																		
																		status,
																		entDate,
																		entTime,
																		entUser
																	) 
															VALUES
																	(
																		'".$biddingProposalStagepackageId."',
																		'".$bps_38."',
																		'".$bps_38a."',
																		'".$bps_39."',
																		'".$bps_40."',
																		'".$bps_41."',
																		'".$bps_42."',
																		'".$bps_43."',
																		'".$bps_44."',
																		'".$bps_45."',
																		'".$bps_46."',
																		'Null',
																		'".$bps_48."',
																		'".$bps_49."',
																		'".$bps_84."',
																		'".$bps_90."',
																		'',
																		'',
																		'',
																		
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									";
				$insertQueryStatement = mysql_query($insertQuery);
				if($insertQueryStatement){
					$msg = "<span class='validMsg'>Insert Data Into [ $biddingProposalStage_pName ] added sucessfully</span><br/>
					<a href='index.php' style='text-decoration:none;font-size:16px;'>Go Home and View Package Information</a><br/><br/>
					<input type='button' value='Back' onclick='window.close();' class='FormResetBtn'>";
				} else {
					$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
				}
			}
			return $msg;
			
			
			
			
		}
		// Insert Bidding / Proposal Stage End
		
		// Insert Bid / Proposal Evaluation Stage start <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
		
			
		
		function insertBidProposalEvaluationStage($userId){
			
			$bpes_50 			= insertDateMySQlFormat($_REQUEST["bpes_50"]);
			$bpes_50a 			= insertDateMySQlFormat($_REQUEST["bpes_50a"]);
			$bpes_51a 			= insertDateMySQlFormat($_REQUEST["bpes_51a"]);
			$bpes_54a			= insertDateMySQlFormat($_REQUEST["bpes_54a"]);
			$bpes_56			= insertDateMySQlFormat($_REQUEST["bpes_56"]);
			$bpes_85			= addslashes($_REQUEST["bpes_85"]);
			
			$bpes_86			= addslashes($_REQUEST["bpes_86"]);
			$bpes_87			= addslashes($_REQUEST["bpes_87"]);
			$bpes_93			= addslashes($_REQUEST["bpes_93"]);
			$bpes_94 			= addslashes($_REQUEST["bpes_94"]);
			$bpes_97 			= str_replace(",", "",$_REQUEST["bpes_97"]);
			$bpes_98 			= str_replace(",", "",$_REQUEST["bpes_98"]);
			$bpes_103 			= addslashes($_REQUEST["bpes_103"]);
			$bpes_95a 			= addslashes($_REQUEST["bpes_95a"]);
			$bpes_102 			= addslashes($_REQUEST["bpes_102"]);
			$bpes_104 			= addslashes($_REQUEST["bpes_104"]);
			$bpes_113 			= addslashes($_REQUEST["bpes_113"]);
			$bpes_56a 			= addslashes($_REQUEST["bpes_56a"]);
			
			
	
			$bPESpackageId 		= addslashes($_REQUEST["bPESpackageId"]);
			$bPESpackageName 	= addslashes($_REQUEST["bPESpackageName"]);

			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
			$Query		= "
									SELECT 
											pId 
									FROM 
											adbs_bidproposalevaluationstage
									WHERE LOWER(pId) = '".strtolower($bPESpackageId)."'
								  ";
			$QueryStatement	= mysql_query($Query);
			if(mysql_num_rows($QueryStatement)>0) {
				$msg = "<span class='errorMsg'>Sorry, Insert Data Into [$bPESpackageName] already exist!</span><br/>
				<a href='index.php' style='text-decoration:none;font-size:16px;'>Go Home and Insert New Package Information</a><br/><br/>
				<input type='button' value='Back' onclick='window.close();' class='FormResetBtn'>";
			} else {
				$insertQuery = "
										INSERT INTO 
													adbs_bidproposalevaluationstage
																	(
																		pId,
																		bpes_50,
																		bpes_51,
																		bpes_52,
																		bpes_53,
																		bpes_54,
																		bpes_54a,
																		bpes_55,
																		bpes_56,
																		bpes_85,
																		bpes_86,
																		bpes_87,
																		bpes_93,
																		bpes_94,
																		bpes_97,
																		bpes_98,
																		bpes_100,
																		bpes_101,
																		bpes_102,
																		bpes_103,
																		bpes_112,
																		bpes_50a,
																		bpes_51a,
																		bpes_56a,
																		bpes_95a,
																		bpes_104,
																		bpes_113,
																		
																		status,
																		entDate,
																		entTime,
																		entUser
																	) 
															VALUES
																	(
																		'".$bPESpackageId."',
																		'".$bpes_50."',
																		'null',
																		'null',
																		'null',
																		'null',
																		'".$bpes_54a."',
																		'null',
																		'".$bpes_56."',
																		'".$bpes_85."',
																		'".$bpes_86."',
																		'".$bpes_87."',
																		'".$bpes_93."',
																		'".$bpes_94."',
																		
																		'".$bpes_97."',
																		'".$bpes_98."',
																		'',
																		'null',
																		'".$bpes_102."',
																		'".$bpes_103."',
																		'',
																		'".$bpes_50a."',
																		'".$bpes_51a."',
																		'".$bpes_56a."',
																		'".$bpes_95a."',
																		'".$bpes_104."',
																		'".$bpes_113."',
																		
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									";
				$insertQueryStatement = mysql_query($insertQuery);
				if($insertQueryStatement){
					$msg = "<span class='validMsg'>Insert Data Into [ $bPESpackageName ] added sucessfully</span><br/>
					<a href='index.php' style='text-decoration:none;font-size:16px;'>Go Home and View Package Information</a><br/><br/>
					<input type='button' value='Back' onclick='window.close();' class='FormResetBtn'>";
				} else {
					$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
				}
			}
			return $msg;
			
			
			
			
		}
		// Insert Bid / Proposal Evaluation Stage End
		
		
		
		// Insert Evaluation Report Approval Stagee start <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
		
		function evaluationPASInsert($userId){
        
	        $eras_60a 			= insertDateMySQlFormat($_REQUEST["eras_60a"]);
			$eras_61 			= insertDateMySQlFormat($_REQUEST["eras_61"]);
		    $eras_62 			= insertDateMySQlFormat($_REQUEST["eras_62"]);
			$eras_62a 			= insertDateMySQlFormat($_REQUEST["eras_62a"]);
			$eras_62b 			= insertDateMySQlFormat($_REQUEST["eras_62b"]);
			$eras_63 			= insertDateMySQlFormat($_REQUEST["eras_63"]);
			$eras_95 			= addslashes($_REQUEST["eras_95"]);
			$eras_96 			= addslashes($_REQUEST["eras_96"]);
			$eras_101 			= addslashes($_REQUEST["eras_101"]);
			$eras_104 			= addslashes($_REQUEST["eras_104"]);
		
			
			$evaluationRASpackageId 		= addslashes($_REQUEST["evaluationRASpackageId"]);
			$evaluationRASpackageName 	= addslashes($_REQUEST["evaluationRASpackageName"]);

			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
			$Query		= "
									SELECT 
											pId 
									FROM 
											adbs_evaluationreportapprovalstage
									WHERE LOWER(pId) = '".strtolower($evaluationRASpackageId)."'
								  ";
			$QueryStatement	= mysql_query($Query);
			if(mysql_num_rows($QueryStatement)>0) {
				$msg = "<span class='errorMsg'>Sorry, Insert Data Into [$evaluationRASpackageName] already exist!</span><br/>
				<a href='index.php' style='text-decoration:none;font-size:16px;'>Go Home and Insert New Package Information</a><br/><br/>
				<input type='button' value='Back' onclick='window.close();' class='FormResetBtn'>";
			} else {
				$insertQuery = "
										INSERT INTO 
													adbs_evaluationreportapprovalstage
																	(
																		pId,
																		eras_57,
																		eras_58,
																		eras_59,
																		eras_60,
																		eras_60a,
																		eras_61,
																		eras_62,
																		eras_62a,
																		eras_63,
																		eras_95,
																		eras_96,
																		eras_99,
																		eras_101,
																		eras_62b,
																		eras_104,
																		
																		status,
																		entDate,
																		entTime,
																		entUser
																	) 
															VALUES
																	(
																		'".$evaluationRASpackageId."',
																		'null',
																		'null',
																		'null',
																		'null',
																		'".$eras_60a."',
																		'".$eras_61."',
																		'".$eras_62."',
																		'".$eras_62a."',
																		'".$eras_63."',
																		'".$eras_95."',
																		'".$eras_96."',
																		'',
																		'".$eras_101."',
																		'".$eras_62b."',
																		'".$eras_104."',
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									";
				$insertQueryStatement = mysql_query($insertQuery);
				if($insertQueryStatement){
					$msg = "<span class='validMsg'>Insert Data Into [ $evaluationRASpackageName ] added sucessfully</span><br/>
					<a href='index.php' style='text-decoration:none;font-size:16px;'>Go Home and View Package Information</a><br/><br/>
					<input type='button' value='Back' onclick='window.close();' class='FormResetBtn'>";
				} else {
					$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
				}
			}
			return $msg;
			
			
			
			
		}
		// Insert Evaluation Report Approval Stage End
		
		// Insert Contracting Stage start <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
		
		function insertcontractingStage($userId){

			$cs_64 			= insertDateMySQlFormat($_REQUEST["cs_64"]);
			$cs_65 			= insertDateMySQlFormat($_REQUEST["cs_65"]);
		    $cs_66 			= insertDateMySQlFormat($_REQUEST["cs_66"]);
			$cs_67 			= insertDateMySQlFormat($_REQUEST["cs_67"]);
			
			$cs_67a 		= insertDateMySQlFormat($_REQUEST["cs_67a"]);
			$cs_67aCal 		= showDateMySQlFormat($_REQUEST["cs_67a"]);
			$cs_68 			= insertDateMySQlFormat($_REQUEST["cs_68"]);
		    $cs_69 			= insertDateMySQlFormat($_REQUEST["cs_69"]);
			
			$cs_70 			= insertDateMySQlFormat($_REQUEST["cs_70"]);
		    $cs_9 			= addslashes($_REQUEST["cs_9"]);			
			$cs_11 			= str_replace(",", "",$_REQUEST["cs_11"]);
			$cs_72 			= insertDateMySQlFormat($_REQUEST["cs_72"]);
			$cs_72a 		= addslashes($_REQUEST["cs_72a"]);
			
			$cs_104 		= addslashes($_REQUEST["cs_104"]);
			$cs_105 		= addslashes($_REQUEST["cs_105"]);
			$cs_106 		= addslashes($_REQUEST["cs_106"]);
			
			$cs_113 		= addslashes($_REQUEST["cs_113"]);
			$cs_114a 		= addslashes($_REQUEST["cs_114a"]);
			
			$date = "$cs_67aCal"; 
			$date = strtotime($date);
			$date = strtotime("+$cs_72a day", $date);
			$cs_72Result =  insertDateMySQlFormat(date('d-m-Y', $date)); 
		
			
			$contractingStagepackageId 	= addslashes($_REQUEST["contractingStagepackageId"]);
			$contractingStagepackageName 	= addslashes($_REQUEST["contractingStagepackageName"]);

			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
			$Query		= "
									SELECT 
											pId 
									FROM 
											adbs_contractingstage
									WHERE LOWER(pId) = '".strtolower($contractingStagepackageId)."'
								  ";
			$QueryStatement	= mysql_query($Query);
			if(mysql_num_rows($QueryStatement)>0) {
				$msg = "<span class='errorMsg'>Sorry, Insert Data Into [$contractingStagepackageName] already exist!</span><br/>
				<a href='index.php' style='text-decoration:none;font-size:16px;'>Go Home and Insert New Package Information</a><br/><br/>
				<input type='button' value='Back' onclick='window.close();' class='FormResetBtn'>";
			} else {
				$insertQuery = "
										INSERT INTO 
													adbs_contractingstage
																	(
																		pId,
																		cs_63a,
																		cs_64,
																		cs_65,
																		cs_66,
																		cs_67,
																		cs_67a,
																		cs_68,
																		cs_69,
																		cs_70,
																		cs_9,
																		cs_11,
																		cs_72,
																		cs_104,
																		cs_105,
																		cs_106,
																		cs_113,
																		cs_114a,
																		cs_72a,
																		
																		
																		status,
																		entDate,
																		entTime,
																		entUser
																	) 
															VALUES
																	(
																		'".$contractingStagepackageId."',
																		'',
																		'".$cs_64."',
																		'".$cs_65."',
																		'".$cs_66."',
																		'".$cs_67."',
																		'".$cs_67a."',
																		'".$cs_68."',
																		'".$cs_69."',
																		'".$cs_70."',
																		'".$cs_9."',
																		'".$cs_11."',
																		'".$cs_72Result."',
																		'".$cs_104."',
																		'".$cs_105."',
																		'".$cs_106."',
																		'".$cs_113."',
																		'".$cs_114a."',
																		'".$cs_72a."',

																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									";
				$insertQueryStatement = mysql_query($insertQuery);
				if($insertQueryStatement){
					$msg = "<span class='validMsg'>Insert Data Into [ $contractingStagepackageName ] added sucessfully</span><br/>
					<a href='index.php' style='text-decoration:none;font-size:16px;'>Go Home and View Package Information</a><br/><br/>
					<input type='button' value='Back' onclick='window.close();' class='FormResetBtn'>";
				} else {
					$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
				}
			}
			return $msg;
			
			
			
			
		}
		// Insert Contracting Stage End
		
		// Insert Contract Management Stage start <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
		
		function insertcontractManagementStage($userId){

			$cms_71 			= insertDateMySQlFormat($_REQUEST["cms_71"]);
		    $cms_73 			= insertDateMySQlFormat($_REQUEST["cms_73"]);
			$cms_74 			= insertDateMySQlFormat($_REQUEST["cms_74"]);
		    $cms_75 			= insertDateMySQlFormat($_REQUEST["cms_75"]);
			$cms_75a 			= insertDateMySQlFormat($_REQUEST["cms_75a"]);
			$cms_107 			= addslashes($_REQUEST["cms_107"]);
			
			$cms_10 			= str_replace(",", "",$_REQUEST["cms_10"]);
			$cms_12 		    = str_replace(",", "",$_REQUEST["cms_12"]);

		
			
			$contractMSpackageId 	= addslashes($_REQUEST["contractMSpackageId"]);
			$contractMSpackageName 	= addslashes($_REQUEST["contractMSpackageName"]);

			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
			$Query		= "
									SELECT 
											pId 
									FROM 
											adbs_contractmanagementstage
									WHERE LOWER(pId) = '".strtolower($contractMSpackageId)."'
								  ";
			$QueryStatement	= mysql_query($Query);
			if(mysql_num_rows($QueryStatement)>0) {
				$msg = "<span class='errorMsg'>Sorry, Insert Data Into [$contractMSpackageName] already exist!</span><br/>
				<a href='index.php' style='text-decoration:none;font-size:16px;'>Go Home and Insert New Package Information</a><br/><br/>
				<input type='button' value='Back' onclick='window.close();' class='FormResetBtn'>";
			} else {
				$insertQuery = "
										INSERT INTO 
													adbs_contractmanagementstage
																	(
																		pId,
																		cms_71,
																		cms_72a,
																		cms_73,
																		cms_74,
																		cms_75,
																		cms_107,
																		cms_108,
																		cms_109,
																		cms_10,
																		cms_12,
																		cms_75a,
																		
																		status,
																		entDate,
																		entTime,
																		entUser
																	) 
															VALUES
																	(
																		'".$contractMSpackageId."',

																		'".$cms_71."',
																		'',
																		'".$cms_73."',
																		'".$cms_74."',
																		'".$cms_75."',
																		'".$cms_107."',
																		'',
																		'',
																		'".$cms_10."',
																		'".$cms_12."',
																		'".$cms_75a."',

																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									";
				$insertQueryStatement = mysql_query($insertQuery);
				if($insertQueryStatement){
					$msg = "<span class='validMsg'>Insert Data Into [ $contractMSpackageName ] added sucessfully</span><br/>
					<a href='index.php' style='text-decoration:none;font-size:16px;'>Go Home and View Package Information</a><br/><br/>
					<input type='button' value='Back' onclick='window.close();' class='FormResetBtn'>";
				} else {
					$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
				}
			}
			return $msg;
			
			
			
			
		}
		// Insert Contract Management Stage End
		
		
		// Insert Disbursements start <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
		function insertDisbursementsStage($userId){

			$bpc_79h 			= addslashes($_REQUEST["bpc_79h"]);
			$bpc_79i 			= addslashes($_REQUEST["bpc_79i"]);
			$bpc_79j 			= str_replace(",", "",$_REQUEST["bpc_79j"]); 
			
		    $pi_4 		= addslashes($_REQUEST["pi_4"]);
			$pi_5 		= addslashes($_REQUEST["pi_5"]); 
			$pi_6 		= addslashes($_REQUEST["pi_6"]); 
			$paymentStageId 		= addslashes($_REQUEST["packageId"]);  
			$paymentStage_pName 	= addslashes($_REQUEST["packageName"]); 
			

			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
			
			$psSql	= "SELECT * FROM adbs_disbursementproject_child
									WHERE   bpc_79h = '".$bpc_79h."'
									AND 	pId 	=  '".$paymentStageId."'
									AND 	bpc_79i =  '".$bpc_79i."'
									
									";
			$psSqlStatement			= mysql_query($psSql);
			$psSqlStatementData		= mysql_fetch_array($psSqlStatement);
			$dpcId       				= $psSqlStatementData["dpcId"]; 
			$pIdview       				= $psSqlStatementData["pId"]; 
			$bpc_79hview       			= $psSqlStatementData["bpc_79h"]; 
			$bpc_79iview       			= $psSqlStatementData["bpc_79i"]; 
			$bpc_79jview       			= $psSqlStatementData["bpc_79j"]; 
			$bpc_79jTotal       		= $bpc_79jview  +  $bpc_79j; 

			 $Query		= "
									SELECT 
											pId 
									FROM 
										  adbs_disbursementproject_child
									WHERE   bpc_79h = '".$bpc_79h."'
									AND 	pId 	=  '".$paymentStageId."'
									AND 	bpc_79i =  '".$bpc_79i."'
									
								  "; 
			$QueryStatement	= mysql_query($Query);
			$numRows = mysql_num_rows($QueryStatement);
			if($numRows>0) {									
					
				$updateQuery = "UPDATE 
										  `adbs_disbursementproject_child`
										  SET
												bpc_79h				 	= '".$bpc_79hview."',
												bpc_79i 				= '".$bpc_79iview."',
												bpc_79j 				= '".$bpc_79jTotal."',
												
												status  	= 'active',
												entDate 	= '".$entDate."',
												entTime 	= '".$entTime."',
												entUser 	= '".$userId."'
									  WHERE
											dpcId       = '".$dpcId."' 
											";
																
				$updateQueryStatement = mysql_query($updateQuery);						
				if($updateQueryStatement){
					$msg = "<span class='validMsg'>Update your data into [ $paymentStage_pName ] added sucessfully</span>
					<br/><a href='index.php' style='text-decoration:none;font-size:16px;'>Go Home and View Package Information</a><br/><br/>
					<form action='disbursementsEdit.php' method='post'>
						<input type='hidden' name='pi_4' value='$pi_4'/>
						<input type='hidden' name='pi_5' value='$pi_5'/>
						<input type='hidden' name='pi_6' value='$pi_6'/>
						<input type='hidden' name='packageId' value='$paymentStageId'/>
						<input type='hidden' name='packageName' value='$paymentStage_pName'/>
						<input type='submit' name='editSubmitDisbursementsStage'  value='Again Insert'/>
						<input type='button' value='Back' onclick='window.close();' class='FormResetBtn'>
					</form>";
				} else {
					$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
				}			
				
			} else {
				$insertQuery = "
										INSERT INTO 
													adbs_disbursementproject_child
																	(
																		pId,
																		bpc_79h,
																		bpc_79i,
																		bpc_79j,
																		
															        	status,
																		entDate,
																		entTime,
																		entUser
																	) 
															VALUES
																	(
																		'".$paymentStageId."',
																		'".$bpc_79h."',
																		'".$bpc_79i."',
																		'".$bpc_79j."',

																		'Active',
																     	'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									";
				$insertQueryStatement = mysql_query($insertQuery);						
				if($insertQueryStatement){
					$msg = "<span class='validMsg'>Insert Data Into [ $paymentStage_pName ] added sucessfully</span>
					<br/><a href='index.php' style='text-decoration:none;font-size:16px;'>Go Home and View Package Information</a><br/><br/>
					<form action='disbursementsEdit.php' method='post'>
						<input type='hidden' name='pi_4' value='$pi_4'/>
						<input type='hidden' name='pi_5' value='$pi_5'/>
						<input type='hidden' name='pi_6' value='$pi_6'/>
						<input type='hidden' name='packageId' value='$paymentStageId'/>
						<input type='hidden' name='packageName' value='$paymentStage_pName'/>
						<input type='submit' name='editSubmitDisbursementsStage'  value='Again Insert'/>
						<input type='button' value='Back' onclick='window.close();' class='FormResetBtn'>
					</form>";
				} else {
					$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
				}
			}
			return $msg;		
			
		}
		// Insert Disbursements Stage End
		
		
		// Insert Payment start <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
		function insertPaymentStage($userId){

			$psbkdn_1 							= insertDateMySQlFormat($_REQUEST["psbkdn_1"]); 
			$psbkdn_2 							= str_replace(",", "",$_REQUEST["psbkdn_2"]);
			$psbkdn_2a 							= str_replace(",", "",$_REQUEST["psbkdn_2a"]);
			$psbkdn_2b 							= '';
			$psbkdn_78b 						= addslashes($_REQUEST["psbkdn_78b"]); 
			$psbkdn_3 							= addslashes($_REQUEST["psbkdn_3"]); 
			$psbkdn_4 							= insertDateMySQlFormat($_REQUEST["psbkdn_4"]); 
			$psbkdn_5 							= insertDateMySQlFormat($_REQUEST["psbkdn_5"]); 
			$psbkdn_6 							= insertDateMySQlFormat($_REQUEST["psbkdn_6"]); 
			$psbkdn_7 							= str_replace(",", "",$_REQUEST["psbkdn_7"]); 
			$psbkdn_8 							= str_replace(",", "",$_REQUEST["psbkdn_8"]);
			$psbkdn_9 							= str_replace(",", "",$_REQUEST["psbkdn_9"]); 
			$psbkdn_10 							= str_replace(",", "",$_REQUEST["psbkdn_10"]); 
			$psbkdn_12 							= str_replace(",", "",$_REQUEST["psbkdn_12"]); 
			
			
			$a_P_AdjustmentFirst                = $psbkdn_2 - $psbkdn_12; 
			$net_paymentFirst                   = $psbkdn_8 + $psbkdn_9;
			$net_paymentSecond                  = $net_paymentFirst - $psbkdn_10;
			$net_paymentFinal                   = $net_paymentSecond - $a_P_AdjustmentFirst; 
			
			
			$yearBillClaimDate 						= date("Y",strtotime($psbkdn_6)); 
			$monthPaymentDate   					= date("m",strtotime($psbkdn_6));
			
			$monthBillClaimDateQ = '';	
			if($monthPaymentDate == '01' || $monthPaymentDate == '02' || $monthPaymentDate == '03'){
				$monthBillClaimDateQ = 'Q1';
			}  
			if($monthPaymentDate == '04' || $monthPaymentDate == '05' || $monthPaymentDate == '06'){
				$monthBillClaimDateQ = 'Q2';
			}
			if($monthPaymentDate == '07' || $monthPaymentDate == '08' || $monthPaymentDate == '09'){
				$monthBillClaimDateQ = 'Q3';
			}
			if($monthPaymentDate == '10' || $monthPaymentDate == '11' || $monthPaymentDate == '12'){
				$monthBillClaimDateQ = 'Q4';
			}

			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
			$pi_4 					= addslashes($_REQUEST["pi_4"]); 
			$pi_6 					= addslashes($_REQUEST["pi_6"]); 
			$paymentStageId 		= addslashes($_REQUEST["packageId"]);  
			$paymentStage_pName 	= addslashes($_REQUEST["packageName"]); 
			
			$psbkdn_3  = '';
			$psbkdnMaxIdSql	= "SELECT COUNT(*) FROM adbs_paymentstage_bkdn WHERE pId='".$paymentStageId."'"; 
			$psbkdnMaxIdSqllStatement		= mysql_query($psbkdnMaxIdSql);
			$psbkdnMaxIdSqllStatementData	= mysql_fetch_array($psbkdnMaxIdSqllStatement);  
			$maxpsbkdn_3      			= $psbkdnMaxIdSqllStatementData[0]; 
			$maxpsbkdn_3Result 			= $maxpsbkdn_3 + 1; 
			
			$psbkdn_flag  = '';
			$psbkdnMaxIdSql	= "SELECT COUNT(*) FROM adbs_paymentstage_bkdn WHERE pId='".$paymentStageId."'"; 
			$psbkdnMaxIdSqllStatement		= mysql_query($psbkdnMaxIdSql);
			$psbkdnMaxIdSqllStatementData	= mysql_fetch_array($psbkdnMaxIdSqllStatement);  
			$maxpsbkdn_flag      			= $psbkdnMaxIdSqllStatementData[0]; 
			$maxpsbkdn_flagResult 			= $maxpsbkdn_flag + 1; 
			
			if($maxpsbkdn_flagResult == 1){
				$actual                		= $psbkdn_2 + $net_paymentFinal;
			}elseif($maxpsbkdn_flagResult > 1){
				$actual             		= $net_paymentFinal + $a_P_AdjustmentFirst;
			}
			
			
			$Query		= "
									SELECT 
											pId 
									FROM 
											adbs_paymentstage_bkdn
								WHERE pId 	= '".$paymentStageId."'
							      AND 	psbkdn_1 			= '".$psbkdn_1."'	
								  AND 	psbkdn_2 			= '".$psbkdn_2."'	
								  AND 	psbkdn_3 			= '".$psbkdn_3."'	
								  AND 	psbkdn_4 			= '".$psbkdn_4."'	
								  AND 	psbkdn_QuaterNo 	= '".$monthBillClaimDateQ."'
								  AND 	psbkdn_Year 	    = '".$yearBillClaimDate."'								
								  "; 
			$QueryStatement	= mysql_query($Query);
			$numRows = mysql_num_rows($QueryStatement);
			if($numRows>0) {
				
				$msg = "<span class='errorMsg'>Sorry, Insert Data Into [$paymentStage_pName] already exist!</span>
				<br/><a href='index.php' style='text-decoration:none;font-size:16px;'>Go Home and Insert New Package Information</a> <br/><br/>
				<form action='paymentStageEdit.php' method='post'>
						<input type='hidden' name='pi_4' value='$pi_4'/>
						<input type='hidden' name='pi_6' value='$pi_6'/>
						<input type='hidden' name='packageId' value='$paymentStageId'/>
						<input type='hidden' name='packageName' value='$paymentStage_pName'/>
						<input type='submit' name='editSubmitPaymentStage'  value='Again Insert'/>
						<input type='button' value='Back' onclick='window.close();' class='FormResetBtn'>
				</form>
				";
							
		} else 
			{
				$insertQuery = "INSERT INTO 
													`adbs_paymentstage_bkdn`
																	(
																		psId,
																		pId,
																		psbkdn_1,
																		psbkdn_2,
																		psbkdn_2a,
																		psbkdn_2b,
																		psbkdn_78b,
																		psbkdn_3,
																		psbkdn_4,
																		psbkdn_5,
																		psbkdn_6,
																		psbkdn_7,
																		psbkdn_8,
																		psbkdn_9,
																		psbkdn_10,
																		psbkdn_12,
																		net_payment,
																		a_p_Adjustment,
																		psbkdn_QuaterNo,
																		psbkdn_Year,
																		psbkdn_Actual,
																		psbkdn_flag,
																		
															        	status,
																		entDate,
																		entTime,
																		entUser
																	) 
															VALUES
																	(
																		'',
																		'".$paymentStageId."',
																		'".$psbkdn_1."',	
																		'".$psbkdn_2."',
																		'".$psbkdn_2a."',
																		'".$psbkdn_2b."',
																		'".$psbkdn_78b."',
																		'".$maxpsbkdn_3Result."',
																		'".$psbkdn_4."',
																		'".$psbkdn_5."',
																		'".$psbkdn_6."',
																		'".$psbkdn_7."',
																		'".$psbkdn_8."',
																		'".$psbkdn_9."',
																		'".$psbkdn_10."',
																		'".$psbkdn_12."',
																		'".$net_paymentFinal."',
																		'".$a_P_AdjustmentFirst."',
																		'".$monthBillClaimDateQ."',
																		'".$yearBillClaimDate."',
																		'".$actual."',
																		'".$maxpsbkdn_flagResult."',

																		
																		'Active',
																     	'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									";
				$insertQueryStatement = mysql_query($insertQuery);						
				if($insertQueryStatement){
					$msg = "<span class='validMsg'>Insert Data Into [ $paymentStage_pName ] added sucessfully</span><br/><a href='index.php' style='text-decoration:none;font-size:16px;'>Go Home and View Package Information</a><br/><br/>
					<form action='paymentStageEdit.php' method='post'>
						<input type='hidden' name='pi_4' value='$pi_4'/>
						<input type='hidden' name='pi_6' value='$pi_6'/>
						<input type='hidden' name='packageId' value='$paymentStageId'/>
						<input type='hidden' name='packageName' value='$paymentStage_pName'/>
						<input type='submit' name='editSubmitPaymentStage'  value='Again Insert'/>
						<input type='button' value='Back' onclick='window.close();' class='FormResetBtn'>
					</form>";
				} else {
					$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
				}
 
			
			}
			return $msg;
		}
		// Insert Payment Stage End
		
		
				// Insert Payment start <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
		function insertPaymentStageEdit($userId){

			$psbkdn_1 							= $_REQUEST["psbkdn_1"]; 
			$psbkdn_2 							= str_replace(",", "",$_REQUEST["psbkdn_2"]);
			$psbkdn_3 							= addslashes($_REQUEST["psbkdn_3"]); 
			$psbkdn_4 							= insertDateMySQlFormat($_REQUEST["psbkdn_4"]); 
			$psbkdn_5 							= insertDateMySQlFormat($_REQUEST["psbkdn_5"]); 
			$psbkdn_6 							= insertDateMySQlFormat($_REQUEST["psbkdn_6"]); 
			$psbkdn_7 							= str_replace(",", "",$_REQUEST["psbkdn_7"]); 
			$psbkdn_8 							= str_replace(",", "",$_REQUEST["psbkdn_8"]);
			$psbkdn_9 							= str_replace(",", "",$_REQUEST["psbkdn_9"]); 
			$psbkdn_10 							= str_replace(",", "",$_REQUEST["psbkdn_10"]); 
			$psbkdn_12 							= str_replace(",", "",$_REQUEST["psbkdn_12"]); 
			
			
			
			$yearBillClaimDate 						= date("Y",strtotime($psbkdn_6)); 
			$monthPaymentDate   					= date("m",strtotime($psbkdn_6));
			
			$monthBillClaimDateQ = '';	
			if($monthPaymentDate == '01' || $monthPaymentDate == '02' || $monthPaymentDate == '03'){
				$monthBillClaimDateQ = 'Q1';
			}  
			if($monthPaymentDate == '04' || $monthPaymentDate == '05' || $monthPaymentDate == '06'){
				$monthBillClaimDateQ = 'Q2';
			}
			if($monthPaymentDate == '07' || $monthPaymentDate == '08' || $monthPaymentDate == '09'){
				$monthBillClaimDateQ = 'Q3';
			}
			if($monthPaymentDate == '10' || $monthPaymentDate == '11' || $monthPaymentDate == '12'){
				$monthBillClaimDateQ = 'Q4';
			}

			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
			$pi_4 					= addslashes($_REQUEST["pi_4"]);
			$pi_5					= addslashes($_REQUEST["pi_5"]); 
			$pi_6 					= addslashes($_REQUEST["pi_6"]); 
			$paymentStageId 		= addslashes($_REQUEST["packageId"]);  
			$paymentStage_pName 	= addslashes($_REQUEST["packageName"]); 
			
			$psbkdn_3  = '';
			$psbkdnMaxIdSql	= "SELECT COUNT(*) FROM adbs_paymentstage_bkdn WHERE pId='".$paymentStageId."'"; 
			$psbkdnMaxIdSqllStatement		= mysql_query($psbkdnMaxIdSql);
			$psbkdnMaxIdSqllStatementData	= mysql_fetch_array($psbkdnMaxIdSqllStatement);  
			$maxpsbkdn_3      			= $psbkdnMaxIdSqllStatementData[0]; 
			$maxpsbkdn_3Result 			= $maxpsbkdn_3 + 1; 
			
			$psbkdn_flag  = '';
			$psbkdnMaxIdSql	= "SELECT COUNT(*) FROM adbs_paymentstage_bkdn WHERE pId='".$paymentStageId."'"; 
			$psbkdnMaxIdSqllStatement		= mysql_query($psbkdnMaxIdSql);
			$psbkdnMaxIdSqllStatementData	= mysql_fetch_array($psbkdnMaxIdSqllStatement);  
			$maxpsbkdn_flag      			= $psbkdnMaxIdSqllStatementData[0]; 
			$maxpsbkdn_flagResult 			= $maxpsbkdn_flag + 1; 
			
			$maxRemainigSql	= "SELECT * FROM adbs_paymentstage_bkdn WHERE pId='".$paymentStageId."' AND psbkdn_flag='".$maxpsbkdn_flag."'"; 
			$maxRemainigSqlStatement		= mysql_query($maxRemainigSql);
			$maxRemainigSqlStatementData	= mysql_fetch_array($maxRemainigSqlStatement); 
			$psbkdn_12Old            		= $maxRemainigSqlStatementData["psbkdn_12"]; 
			
			$psbkdn_8Old              = $maxRemainigSqlStatementData["psbkdn_8"];
			$psbkdn_9Old              = $maxRemainigSqlStatementData["psbkdn_9"];
			$psbkdn_10Old             = $maxRemainigSqlStatementData["psbkdn_10"];
			$psbkdn_12Old             = $maxRemainigSqlStatementData["psbkdn_12"];
			
			$a_P_AdjustmentEdit       = $psbkdn_12Old - $psbkdn_12;  
			
			$net_paymentFinalEdit	  = ($psbkdn_8 - $psbkdn_8Old)+($psbkdn_9 - $psbkdn_9Old)-($psbkdn_10 - $psbkdn_10Old)-($psbkdn_12Old - $psbkdn_12);
			
			$actualEdit       		  = $a_P_AdjustmentEdit + $net_paymentFinalEdit;
			
					
			$quaterSql	= "	  SELECT 
											* 
									FROM 
											adbs_paymentstage_bkdn
								WHERE pId 	= '".$paymentStageId."'	
								  AND 	psbkdn_QuaterNo 	= '".$monthBillClaimDateQ."'
								  AND 	psbkdn_Year 	    = '".$yearBillClaimDate."'									
								  "; 
			$quaterSqlStatement		= mysql_query($quaterSql);
			$quaterSqlStatementData	= mysql_fetch_array($quaterSqlStatement);  
			
	 		$oldpsId      				= $quaterSqlStatementData["psId"]; 
			$oldpsbkdn_1      			= $quaterSqlStatementData["psbkdn_1"]; 
			$oldpsbkdn_2      			= $quaterSqlStatementData["psbkdn_2"];
			$oldpsbkdn_3      			= $quaterSqlStatementData["psbkdn_3"];
			$oldpsbkdn_4      			= $quaterSqlStatementData["psbkdn_4"];
			$oldpsbkdn_5      			= $quaterSqlStatementData["psbkdn_5"];
			$oldpsbkdn_6      			= $quaterSqlStatementData["psbkdn_6"];
			$oldpsbkdn_7      			= $quaterSqlStatementData["psbkdn_7"];
			$oldpsbkdn_8      			= $quaterSqlStatementData["psbkdn_8"];
			$oldpsbkdn_9      			= $quaterSqlStatementData["psbkdn_9"];
			$oldpsbkdn_10      			= $quaterSqlStatementData["psbkdn_10"];
			$oldpsbkdn_12      			= $quaterSqlStatementData["psbkdn_12"];
			$oldnet_payment      		= $quaterSqlStatementData["net_payment"];
			$olda_p_Adjustment      	= $quaterSqlStatementData["a_p_Adjustment"];
			$oldpsbkdn_Actual      		= $quaterSqlStatementData["psbkdn_Actual"];
			$oldpsbkdn_QuaterNo      	= $quaterSqlStatementData["psbkdn_QuaterNo"];  
			$oldpsbkdn_Year      		= $quaterSqlStatementData["psbkdn_Year"];
			$oldpsbkdn_flag      		= $quaterSqlStatementData["psbkdn_flag"]; 

			$Newpsbkdn_7        = $oldpsbkdn_7 + $psbkdn_7; 
			$Newpsbkdn_8        = $oldpsbkdn_8 + $psbkdn_8; 
			$Newpsbkdn_9        = $oldpsbkdn_9 + $psbkdn_9; 
			$Newpsbkdn_10       = $oldpsbkdn_10 + $psbkdn_10;
			$Newpsbkdn_12       = $oldpsbkdn_12 + $psbkdn_12; 
			
			$Newoldnet_payment         = $oldnet_payment + $net_paymentFinalEdit;
			$Newolda_p_Adjustment      = $olda_p_Adjustment + $a_P_AdjustmentEdit; 
			$NewactualEdit      	   = $oldpsbkdn_Actual + $actualEdit;
			 
			
			$Query		= "
									SELECT 
											pId 
									FROM 
											adbs_paymentstage_bkdn
								WHERE pId 	= '".$paymentStageId."'	
								  AND 	psbkdn_QuaterNo 	= '".$monthBillClaimDateQ."'
								  AND 	psbkdn_Year 	    = '".$yearBillClaimDate."'
								  AND 	psbkdn_1 	   		= '".$psbkdn_1."'
								  AND 	psbkdn_2 	    	= '".$psbkdn_2."'
								  AND 	psbkdn_3 	    	= '".$psbkdn_3."'
								  AND 	psbkdn_4 	    	= '".$psbkdn_4."'								
								  "; 
			$QueryStatement	= mysql_query($Query);
			$numRows = mysql_num_rows($QueryStatement);
			if($numRows>0) {			
				$msg = "<span class='errorMsg'>Sorry, Insert Data Into [$paymentStage_pName] already exist!</span><br/>
				<a href='index.php' style='text-decoration:none;font-size:16px;'>Go Home and Insert New Package Information</a><br/><br/>
				<input type='button' value='Back' onclick='window.close();' class='FormResetBtn'>";			
			} else 
			{
			if($psbkdn_8 > 0){
				$insertQuery = "INSERT INTO 
													`adbs_paymentstage_bkdn`
																	(
																		psId,
																		pId,
																		psbkdn_1,
																		psbkdn_2,
																		psbkdn_2a,
																		psbkdn_2b,
																		psbkdn_78b,
																		psbkdn_3,
																		psbkdn_4,
																		psbkdn_5,
																		psbkdn_6,
																		psbkdn_7,
																		psbkdn_8,
																		psbkdn_9,
																		psbkdn_10,
																		psbkdn_12,
																		net_payment,
																		a_p_Adjustment,
																		psbkdn_QuaterNo,
																		psbkdn_Year,
																		psbkdn_Actual,
																		psbkdn_flag,
																		
															        	status,
																		entDate,
																		entTime,
																		entUser
																	) 
															VALUES
																	(
																		'',
																		'".$paymentStageId."',
																		'".$psbkdn_1."',	
																		'".$psbkdn_2."',
																		'',
																		'',
																		'',
																		'".$maxpsbkdn_3Result."',
																		'".$psbkdn_4."',
																		'".$psbkdn_5."',
																		'".$psbkdn_6."',
																		'".$psbkdn_7."',
																		'".$psbkdn_8."',
																		'".$psbkdn_9."',
																		'".$psbkdn_10."',
																		'".$psbkdn_12."',
																		'".$net_paymentFinalEdit."',
																		'".$a_P_AdjustmentEdit."',
																		'".$monthBillClaimDateQ."',
																		'".$yearBillClaimDate."',
																		'".$actualEdit."',
																		'".$maxpsbkdn_flagResult."',

																		
																		'Active',
																     	'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									";
				$insertQueryStatement = mysql_query($insertQuery);						
				if($insertQueryStatement){
					$msg = "<span class='validMsg'>Insert Data Into [ $paymentStage_pName ] added sucessfully</span><br/><a href='index.php' style='text-decoration:none;font-size:16px;'>Go Home and View Package Information</a><br/><br/>
					<form action='paymentStageEdit.php' method='post'>
						<input type='hidden' name='pi_4' value='$pi_4'/>
						<input type='hidden' name='pi_5' value='$pi_5'/>
						<input type='hidden' name='pi_6' value='$pi_6'/>
						<input type='hidden' name='packageId' value='$paymentStageId'/>
						<input type='hidden' name='packageName' value='$paymentStage_pName'/>
						<input type='submit' name='editSubmitPaymentStage'  value='Again Insert'/>
						<input type='button' value='Back' onclick='window.close();' class='FormResetBtn'>
					</form>";
				} else {
					$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
				}
				}else{
				$msg = "<span class='errorMsg'>Sorry! Cumulative Total Amount Must Be Greter Then Minumum 1</span><br/><br/>
						<form action='paymentStageEdit.php' method='post'>
						<input type='hidden' name='pi_4' value='$pi_4'/>
						<input type='hidden' name='pi_5' value='$pi_5'/>
						<input type='hidden' name='pi_6' value='$pi_6'/>
						<input type='hidden' name='packageId' value='$paymentStageId'/>
						<input type='hidden' name='packageName' value='$paymentStage_pName'/>
						<input type='submit' name='editSubmitPaymentStage'  value='Again Insert'/>
						<input type='button' value='Back' onclick='window.close();' class='FormResetBtn'>
					</form>
				";	 
			}
			}
			return $msg;
		}
		// Insert Payment Stage End
		
		
		// Insert Contract Concluding Stage start <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
		
		function insertcontractConcludingStage($userId){

		    $ccs_79				= str_replace(",", "",$_REQUEST["ccs_79"]);
			$ccs_80 			= str_replace(",", "",$_REQUEST["ccs_80"]);

		
			
			$contractCSpackageId 	= addslashes($_REQUEST["contractCSpackageId"]);
			$contractCSpackageName 	= addslashes($_REQUEST["contractCSpackageName"]);

			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
			$Query		= "
									SELECT 
											pId 
									FROM 
											adbs_contractconcludingstage
									WHERE LOWER(pId) = '".strtolower($contractCSpackageId)."'
								  ";
			$QueryStatement	= mysql_query($Query);
			if(mysql_num_rows($QueryStatement)>0) {
				$msg = "<span class='errorMsg'>Sorry, Insert Data Into [$contractCSpackageName] already exist!</span><br/>
				<a href='index.php' style='text-decoration:none;font-size:16px;'>Go Home and Insert New Package Information</a><br/><br/>
				<input type='button' value='Back' onclick='window.close();' class='FormResetBtn'>";
			} else {
				$insertQuery = "
										INSERT INTO 
													adbs_contractconcludingstage
																	(
																		pId,
																		ccs_76,
																		ccs_77,
																		ccs_78,
																		ccs_79,
																		ccs_80,
																		ccs_110,
																		ccs_111,
																		
																		status,
																		entDate,
																		entTime,
																		entUser
																	) 
															VALUES
																	(
																		'".$contractCSpackageId."',

																		'',
																		'',
																		'',
																		'".$ccs_79."',
																		'".$ccs_80."',
																		'',
																		'',

																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									";
				$insertQueryStatement = mysql_query($insertQuery);
				if($insertQueryStatement){
					$msg = "<span class='validMsg'>Insert Data Into [ $contractCSpackageName ] added sucessfully</span><br/>
					<a href='index.php' style='text-decoration:none;font-size:16px;'>Go Home and View Package Information</a><br/><br/>
					<input type='button' value='Back' onclick='window.close();' class='FormResetBtn'>";
				} else {
					$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
				}
			}
			return $msg;
			
			
			
			
		}
		// Insert Contract Concluding Stage End
		
		
		// Insert Others Information start <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
		
		function insertothersInformation($userId){


			$oi_114 			= addslashes($_REQUEST["oi_114"]);
			$oi_111 			= addslashes($_REQUEST["oi_111"]);
			$oi_112 			= addslashes($_REQUEST["oi_112"]);
			$oi_118 			= addslashes($_REQUEST["oi_118"]);
			$oi_119 			= addslashes($_REQUEST["oi_119"]);

		
			
			$othersIpackageId 	= addslashes($_REQUEST["othersIpackageId"]);
			$othersIpackageName 	= addslashes($_REQUEST["othersIpackageName"]);

			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
			$Query		= "
									SELECT 
											pId 
									FROM 
											adbs_othersinformation
									WHERE LOWER(pId) = '".strtolower($othersIpackageId)."'
								  ";
			$QueryStatement	= mysql_query($Query);
			if(mysql_num_rows($QueryStatement)>0) {
				$msg = "<span class='errorMsg'>Sorry, Insert Data Into [$othersIpackageName] already exist!</span><br/>
				<a href='index.php' style='text-decoration:none;font-size:16px;'>Go Home and Insert New Package Information</a><br/><br/>
				<input type='button' value='Back' onclick='window.close();' class='FormResetBtn'>";
			} else {
				$insertQuery = "
										INSERT INTO 
													adbs_othersinformation
																	(
																		pId,
																		oi_114,
																		oi_120,
																		oi_121,
																		oi_111,
																		oi_112,
																		oi_118,
																		oi_119,
																		
																		status,
																		entDate,
																		entTime,
																		entUser
																	) 
															VALUES
																	(
																		'".$othersIpackageId."',
																		'".$oi_114."',
																		'Null',
																		'Nulll',
																		'".$oi_111."',
																		'".$oi_112."',
																		'".$oi_118."',
																		'".$oi_119."',
																		
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									";
				$insertQueryStatement = mysql_query($insertQuery);
				if($insertQueryStatement){
					$msg = "<span class='validMsg'>Insert Data Into [ $othersIpackageName ] added sucessfully</span><br/>
					<a href='index.php' style='text-decoration:none;font-size:16px;'>Go Home and View Package Information</a><br/><br/>
					<input type='button' value='Back' onclick='window.close();' class='FormResetBtn'>";
				} else {
					$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
				}
			}
			return $msg;
			
		}
		// Insert Others Information End
		
		// Data uplaod csv file start
		function insertdataUpload($userId){
			
			$piProcurementType 	= addslashes($_REQUEST["piProcurementType"]);
		    $pName 	            = addslashes($_REQUEST["pName"]); 
				
			
			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			

			 if ($_FILES[csv][size] > 0) { 
			
				$file = $_FILES[csv][tmp_name]; 
			
				if (($handle = fopen($file, "r")) !== FALSE) {
				$chk = 0;
				$ministryDivision_csv = '';
				$agency_csv = '';
				$procuringEntityName_csv = '';
				$paName_csv = '';
				while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
				{
					//$num = count($data); 
					if($chk <= 24){
						if($chk == 22){
						 $endInsert = $data[4]; 
						}	
					}
					
					if($chk <= 11){
						
							if($chk == 3){
							 		$ministryDivision_csv = $data[2]; 
							}elseif($chk == 4){
									$agency_csv = $data[2]; 
							}elseif($chk == 5){
									$procuringEntityName_csv = $data[2]; 
							}elseif($chk == 6){
									$paName_csv = $data[2];  
							}
							$chk++;
					}else  {
						$insertQueryStatement = '';
						if($data[0] == 'END'){
							//End Operation.';
							if($insertQueryStatement){
								$msgSuccess = "<span class='validMsg'>Insert Data Into [ $paName_csv ] added sucessfully</span><br/>
								<a href='index.php' style='text-decoration:none;font-size:16px;'>Go Home and View Package Information</a>
								<input type='button' value='Back' onclick='window.close();' class='FormResetBtn'>";
							} 
							break;
						}else{
							
						$pi_4_csv = addslashes($data[0]);   $pi_6_csv = addslashes($data[1]); 
						$pi_7a_csv = addslashes($data[2]);  $pi_7b_csv = addslashes($data[3]);  $pi_13_csv = addslashes($data[4]);
						$pi_17_csv = addslashes($data[5]);  $pi_7c_csv = addslashes($data[6]);  $pi_7d_csv = str_replace(",", "",$data[7]);
						$pi_7d_calculation  = ($pi_7d_csv * 100000);
						
						$used_for_works = '';
						if($piProcurementType == 2){
							$used_for_works = insertDateMySQlFormat($data[8]); 
						}
						$bps_38_csv = insertDateMySQlFormat($data[9]); 
						$cs_68_csv  = insertDateMySQlFormat($data[10]); $cms_74_csv = insertDateMySQlFormat($data[11]);

						$psIdQuery 			= "SELECT * FROM adbs_projectsetup WHERE adbProjectName='".$paName_csv."'"; 
						$psIdViewStatement	= mysql_query($psIdQuery);
						$countRows			= mysql_num_rows($psIdViewStatement);  
						while($psIdViewStatementData	= mysql_fetch_array($psIdViewStatement)){ 
								
						 $psIdView_csv        = $psIdViewStatementData["psId"];  
						}
						$userIdQuery 			= "SELECT * FROM s_user WHERE USER_ID='".$userId."'"; 
						$userIdViewStatement	= mysql_query($userIdQuery); 
						while($userIdViewStatementData	= mysql_fetch_array($userIdViewStatement)){ 
								
							 $psId_Check        = $userIdViewStatementData["psId"];  
						}
						
							if($psIdView_csv == $psId_Check){
									$insertQuery = " 
											INSERT INTO 
													adbs_package
																	(
																		ptId,
																		pmId,
																		bpId,
																		pName,
																		psId,
																		adbPackageName,
																		pi_4,
																		pi_5,
																		pi_6,
																		pi_7,
																		pi_7a,
																		pi_7b,
																		pi_7c,
																		pi_7d,
																		pi_8,
																		pi_13,
																		pi_14,
																		pi_15,
																		pi_16,
																		pi_17,
																		pi_18,
																		pi_19,
																		status,
																		entDate,
																		entTime,
																		entUser
																	) 
															VALUES
																	(
																		
																		'".$piProcurementType."',
																		'',
																		'',
																		'".$pName."',
																		'".$psIdView_csv."',
																		'".$paName_csv."',																	
																		
																		'".$pi_4_csv."',
																		'',
																		'".$pi_6_csv."',
																		'',
																		'".$pi_7a_csv."',
																		'".$pi_7b_csv."',
																		'".$pi_7c_csv."',
																		'".$pi_7d_calculation."',
																		'',
																		'".$pi_13_csv."',
																		'',
																		'',
																		'',
																		'".$pi_17_csv."',
																		'',
																		'',
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									";
									$insertQueryStatement = mysql_query($insertQuery);
		
							$maxPackageId = mysql_insert_id();		
							
									$insertQuery = " 
												INSERT INTO 
													adbs_biddingproposalstage
																	(
																		pId,
																		bps_38,
																		bps_38a,
																		bps_39,
																		bps_40,
																		bps_41,
																		bps_42,
																		bps_43,
																		bps_44,
																		bps_45,
																		bps_46,
																		bps_47,
																		bps_48,
																		bps_49,
																		bps_84,
																		bps_90,
																		bps_91,
																		bps_92,
																		bps_102,
																		

																		status,
																		entDate,
																		entTime,
																		entUser
																	) 
															VALUES
																	(
																		'".$maxPackageId."',
																		'',
																		'".$bps_38_csv."',
																		'',
																		'',
																		'',
																		'',
																		'',
																		'',
																		'',
																		'',
																		'',
																		'',
																		'',
																		'',
																		'',
																		'',
																		'',
																		'',
																		
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									";
									$insertQueryStatement = mysql_query($insertQuery);
									$insertQuery = " 
									
											INSERT INTO 
													adbs_contractingstage
																	(
																		pId,
																		cs_63a,
																		cs_64,
																		cs_65,
																		cs_66,
																		cs_67,
																		cs_67a,
																		cs_68,
																		cs_69,
																		cs_70,
																		cs_9,
																		cs_11,
																		cs_72,
																		cs_104,
																		cs_105,
																		cs_106,
																		cs_113,
																		cs_114a,
																		cs_72a,
																		
																		
																		status,
																		entDate,
																		entTime,
																		entUser
																	) 
															VALUES
																	(
																		'".$maxPackageId."',
																		'',
																		'',
																		'',
																		'',
																		'',
																		'".$cs_68_csv."',
																		'',
																		'',
																		'',
																		'',
																		'',
																		'',
																		'',
																		'',
																		'',
																		'',
																		'',
																		'',

																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									";
									$insertQueryStatement = mysql_query($insertQuery);
									
									
									$insertQuery = " 
									     INSERT INTO 
													adbs_contractmanagementstage
																	(
																		pId,
																		cms_71,
																		cms_72a,
																		cms_73,
																		cms_74,
																		cms_75,
																		cms_107,
																		cms_108,
																		cms_109,
																		cms_10,
																		cms_12,
																		cms_75a,
																		
																		status,
																		entDate,
																		entTime,
																		entUser
																	) 
															VALUES
																	(
																		'".$maxPackageId."',
																		'',
																		'',
																		'',
																		'".$cms_74_csv."',
																		'',
																		'',
																		'',
																		'',
																		'',
																		'',
																		'',

																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									";
									$insertQueryStatement = mysql_query($insertQuery);
									if($insertQueryStatement){
										$msgSuccess = "<span class='validMsg'>Insert Data Into [ $paName_csv ] added sucessfully</span><br/><a href='index.php' style='text-decoration:none;font-size:16px;'>Go Home and View Package Information</a>";
									} else {
										$msgSuccess = "<span class='errorMsg'>Sorry! System Error!</span>";
									}
							
							}else{
									$msgSuccess = "<span class='errorMsg'>Sorry! Project Name Not Found!</span><br/><a href='index.php' style='text-decoration:none;font-size:16px;'>Go Home and Try Again.</a>";
								}
						}						
					}
				}
				fclose($handle);
				
			  }

				
			
			
			 }
			// echo  $msg ; die();
			 return $msgSuccess; 
		}
		// Data uplaod csv file End
	}
?>