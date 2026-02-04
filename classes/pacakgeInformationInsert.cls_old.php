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
 				$pName  = "{$ptName} with PR,"." {$pmName},"." {$bpName},"." PQ,"." {$adbPSName}";
			}else if ((strtolower($piPriorReview) == 'yes') && (strtolower($piPrequalificationProcess) == 'no')) {
 				$pName  = "{$ptName} with PR,"." {$pmName},"." {$bpName},"." without PQ,"." {$adbPSName}";
			}else if ((strtolower($piPriorReview) == 'no') && (strtolower($piPrequalificationProcess) == 'yes')) {
 				$pName  = "{$ptName} without PR,"." {$pmName},"." {$bpName},"." PQ,"." {$adbPSName}";
			}else if ((strtolower($piPriorReview) == 'no') && (strtolower($piPrequalificationProcess) == 'no')) {
 				$pName  = "{$ptName} without PR,"." {$pmName},"." {$bpName},"." without PQ,"." {$adbPSName}";
			}
			
			
			
			
			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
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
				$msg = "<span class='errorMsg'>Sorry, Package Name [$pName] already exist!</span><br/><a href='index.php' style='text-decoration:none;font-size:16px;'>Go Home and Insert New Package</a>";
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
																		'null',
																		'".$piPriorReview."',
																		'".$piPrequalificationProcess."',
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									";
				$insertQueryStatement = mysql_query($insertQuery);
				if($insertQueryStatement){
					$msg = "<span class='validMsg'>Package Name [ $pName ] added sucessfully</span><br/><a href='index.php' style='text-decoration:none;font-size:16px;'>Go Home and View Package</a>";
				} else {
					$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
				}
			}
			return $msg;
			
			
			
			
		}
		// Insert Package Information End
		
		// Insert PQ Stage start <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
		
			
		
		function insertPQStage($userId){

			$pqs_20 			= insertDateMySQlFormat($_REQUEST["pqs_20"]);
		    $pqs_21 			= insertDateMySQlFormat($_REQUEST["pqs_21"]);
			$pqs_22 			= insertDateMySQlFormat($_REQUEST["pqs_22"]);
			$pqs_23 			= insertDateMySQlFormat($_REQUEST["pqs_23"]);
			$pqs_24 			= insertDateMySQlFormat($_REQUEST["pqs_24"]);
			
			$pqs_25 			= insertDateMySQlFormat($_REQUEST["pqs_25"]);
			$pqs_26			    = insertDateMySQlFormat($_REQUEST["pqs_26"]);
			$pqs_27			    = insertDateMySQlFormat($_REQUEST["pqs_27"]);
			$pqs_28			    = insertDateMySQlFormat($_REQUEST["pqs_28"]);
			
			$pqs_81 			= addslashes($_REQUEST["pqs_81"]);
			$pqs_82 			= addslashes($_REQUEST["pqs_82"]);
			$pqs_83 			= addslashes($_REQUEST["pqs_83"]);
			$pqs_102 			= addslashes($_REQUEST["pqs_102"]);
		
			
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
				$msg = "<span class='errorMsg'>Sorry, Insert Data Into [$pqs_pName] already exist!</span><br/><a href='index.php' style='text-decoration:none;font-size:16px;'>Go Home and Insert New Package Information</a>";
			} else {
				$insertQuery = "
										INSERT INTO 
													adbs_pqstage
																	(
																		pId,
																		pqs_20,
																		pqs_21,
																		pqs_22,
																		pqs_23,
																		pqs_24,
																		pqs_25,
																		pqs_26,
																		pqs_27,
																		pqs_28,
																		
																		pqs_81,
																		pqs_82,
																		pqs_83,
																		pqs_101,
																		pqs_102,
																		pqs_103,
																		
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
																		'".$pqs_23."',
																		'".$pqs_24."',
																		'".$pqs_25."',
																		'".$pqs_26."',
																		'".$pqs_27."',
																		'".$pqs_28."',
																		'".$pqs_81."',
																		'".$pqs_82."',
																		'".$pqs_83."',
																		'null',
																		'".$pqs_102."',
																		'null',
																		
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									";
				$insertQueryStatement = mysql_query($insertQuery);
				if($insertQueryStatement){
					$msg = "<span class='validMsg'>Insert Data Into [ $pqs_pName ] added sucessfully</span><br/><a href='index.php' style='text-decoration:none;font-size:16px;'>Go Home and View Package Information</a>";
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
			
			
			
			$biddingDPStgpackageId 		    = addslashes($_REQUEST["packageId"]);
			$biddingDPStg_pName 		        = addslashes($_REQUEST["packageName"]);

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
				$msg = "<span class='errorMsg'>Sorry, Insert Data Into [$biddingDPStg_pName] already exist!</span><br/><a href='index.php' style='text-decoration:none;font-size:16px;'>Go Home and Insert New Package Information</a>";
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
																		bdps_88,
																		bdps_89,
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
																		'Null',
																		'Null',
																		'Active',
																     	'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									";
				$insertQueryStatement = mysql_query($insertQuery);
				if($insertQueryStatement){
					$msg = "<span class='validMsg'>Insert Data Into [ $biddingDPStg_pName ] added sucessfully</span><br/><a href='index.php' style='text-decoration:none;font-size:16px;'>Go Home and View Package Information</a>";
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
			$bps_91 			= addslashes($_REQUEST["bps_91"]);
			$bps_92 			= addslashes($_REQUEST["bps_92"]);
		
			
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
				$msg = "<span class='errorMsg'>Sorry, Insert Data Into [$biddingProposalStage_pName] already exist!</span><br/><a href='index.php' style='text-decoration:none;font-size:16px;'>Go Home and Insert New Package Information</a>";
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
																		bps_101,
																		
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
																		'".$bps_91."',
																		'".$bps_92."',
																		'Null',
																		
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									";
				$insertQueryStatement = mysql_query($insertQuery);
				if($insertQueryStatement){
					$msg = "<span class='validMsg'>Insert Data Into [ $biddingProposalStage_pName ] added sucessfully</span><br/><a href='index.php' style='text-decoration:none;font-size:16px;'>Go Home and View Package Information</a>";
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
			$bpes_54a			= insertDateMySQlFormat($_REQUEST["bpes_54a"]);
			$bpes_56			= insertDateMySQlFormat($_REQUEST["bpes_56"]);
			$bpes_85			= addslashes($_REQUEST["bpes_85"]);
			
			$bpes_86			= addslashes($_REQUEST["bpes_86"]);
			$bpes_87			= addslashes($_REQUEST["bpes_87"]);
			$bpes_93			= addslashes($_REQUEST["bpes_93"]);
			$bpes_94 			= addslashes($_REQUEST["bpes_94"]);
			$bpes_97 			= str_replace(",", "",$_REQUEST["bpes_97"]);
			$bpes_98 			= str_replace(",", "",$_REQUEST["bpes_98"]);
			$bpes_100			= addslashes($_REQUEST["bpes_100"]);
			$bpes_103 			= addslashes($_REQUEST["bpes_103"]);
			$bpes_112 			= addslashes($_REQUEST["bpes_112"]);
			
			
	
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
				$msg = "<span class='errorMsg'>Sorry, Insert Data Into [$bPESpackageName] already exist!</span><br/><a href='index.php' style='text-decoration:none;font-size:16px;'>Go Home and Insert New Package Information</a>";
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
																		'".$bpes_100."',
																		'null',
																		'null',
																		'".$bpes_103."',
																		'".$bpes_112."',
																		
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									";
				$insertQueryStatement = mysql_query($insertQuery);
				if($insertQueryStatement){
					$msg = "<span class='validMsg'>Insert Data Into [ $bPESpackageName ] added sucessfully</span><br/><a href='index.php' style='text-decoration:none;font-size:16px;'>Go Home and View Package Information</a>";
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
			$eras_95 			= addslashes($_REQUEST["eras_95"]);
			$eras_96 			= addslashes($_REQUEST["eras_96"]);
			$eras_99 			= addslashes($_REQUEST["eras_99"]);
			$eras_101 			= addslashes($_REQUEST["eras_101"]);
		
			
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
				$msg = "<span class='errorMsg'>Sorry, Insert Data Into [$evaluationRASpackageName] already exist!</span><br/><a href='index.php' style='text-decoration:none;font-size:16px;'>Go Home and Insert New Package Information</a>";
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
																		'null',
																		'".$eras_95."',
																		'".$eras_96."',
																		'".$eras_99."',
																		'null',
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									";
				$insertQueryStatement = mysql_query($insertQuery);
				if($insertQueryStatement){
					$msg = "<span class='validMsg'>Insert Data Into [ $evaluationRASpackageName ] added sucessfully</span><br/><a href='index.php' style='text-decoration:none;font-size:16px;'>Go Home and View Package Information</a>";
				} else {
					$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
				}
			}
			return $msg;
			
			
			
			
		}
		// Insert Evaluation Report Approval Stage End
		
		// Insert Contracting Stage start <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
		
		function insertcontractingStage($userId){

			$cs_63a 		= insertDateMySQlFormat($_REQUEST["cs_63a"]);
			$cs_64 			= insertDateMySQlFormat($_REQUEST["cs_64"]);
		    $cs_66 			= insertDateMySQlFormat($_REQUEST["cs_66"]);
			
			$cs_67a 		= insertDateMySQlFormat($_REQUEST["cs_67a"]);
			$cs_68 			= insertDateMySQlFormat($_REQUEST["cs_68"]);
		    $cs_69 			= insertDateMySQlFormat($_REQUEST["cs_69"]);
			
			$cs_70 			= insertDateMySQlFormat($_REQUEST["cs_70"]);
		    $cs_9 			= addslashes($_REQUEST["cs_9"]);			
			$cs_11 			= str_replace(",", "",$_REQUEST["cs_11"]);
			$cs_72 			= insertDateMySQlFormat($_REQUEST["cs_72"]);
			
			$cs_104 		= addslashes($_REQUEST["cs_104"]);
			$cs_105 		= addslashes($_REQUEST["cs_105"]);
			$cs_106 		= addslashes($_REQUEST["cs_106"]);
			
			$cs_113 		= addslashes($_REQUEST["cs_113"]);
		
			
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
				$msg = "<span class='errorMsg'>Sorry, Insert Data Into [$contractingStagepackageName] already exist!</span><br/><a href='index.php' style='text-decoration:none;font-size:16px;'>Go Home and Insert New Package Information</a>";
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
																		
																		
																		status,
																		entDate,
																		entTime,
																		entUser
																	) 
															VALUES
																	(
																		'".$contractingStagepackageId."',
																		'".$cs_63a."',
																		'".$cs_64."',
																		'null',
																		'".$cs_66."',
																		'null',
																		'".$cs_67a."',
																		'".$cs_68."',
																		'".$cs_69."',
																		'".$cs_70."',
																		'".$cs_9."',
																		'".$cs_11."',
																		'".$cs_72."',
																		'".$cs_104."',
																		'".$cs_105."',
																		'".$cs_106."',
																		'".$cs_113."',

																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									";
				$insertQueryStatement = mysql_query($insertQuery);
				if($insertQueryStatement){
					$msg = "<span class='validMsg'>Insert Data Into [ $contractingStagepackageName ] added sucessfully</span><br/><a href='index.php' style='text-decoration:none;font-size:16px;'>Go Home and View Package Information</a>";
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
			$cms_72a 			= insertDateMySQlFormat($_REQUEST["cms_72a"]);
		    $cms_73 			= insertDateMySQlFormat($_REQUEST["cms_73"]);
			$cms_74 			= insertDateMySQlFormat($_REQUEST["cms_74"]);
		    $cms_75 			= insertDateMySQlFormat($_REQUEST["cms_75"]);
			$cms_107 			= addslashes($_REQUEST["cms_107"]);
		    $cms_108 			= addslashes($_REQUEST["cms_108"]);
			$cms_109 			= str_replace(",", "",$_REQUEST["cms_109"]);
			
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
				$msg = "<span class='errorMsg'>Sorry, Insert Data Into [$contractMSpackageName] already exist!</span><br/><a href='index.php' style='text-decoration:none;font-size:16px;'>Go Home and Insert New Package Information</a>";
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
																		
																		status,
																		entDate,
																		entTime,
																		entUser
																	) 
															VALUES
																	(
																		'".$contractMSpackageId."',

																		'".$cms_71."',
																		'".$cms_72a."',
																		'".$cms_73."',
																		'".$cms_74."',
																		'".$cms_75."',
																		'".$cms_107."',
																		'".$cms_108."',
																		'".$cms_109."',
																		'".$cms_10."',
																		'".$cms_12."',

																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									";
				$insertQueryStatement = mysql_query($insertQuery);
				if($insertQueryStatement){
					$msg = "<span class='validMsg'>Insert Data Into [ $contractMSpackageName ] added sucessfully</span><br/><a href='index.php' style='text-decoration:none;font-size:16px;'>Go Home and View Package Information</a>";
				} else {
					$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
				}
			}
			return $msg;
			
			
			
			
		}
		// Insert Contract Management Stage End
		
		// Insert Contract Concluding Stage start <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
		
		function insertcontractConcludingStage($userId){

			$ccs_76 			= insertDateMySQlFormat($_REQUEST["ccs_76"]);
		    $ccs_77 			= insertDateMySQlFormat($_REQUEST["ccs_77"]);
			$ccs_78 			= str_replace(",", "",$_REQUEST["ccs_78"]);
		    $ccs_79				= str_replace(",", "",$_REQUEST["ccs_79"]);
			$ccs_80 			= str_replace(",", "",$_REQUEST["ccs_80"]);
			
			$ccs_110 			= addslashes($_REQUEST["ccs_110"]);
			$ccs_111		    = addslashes($_REQUEST["ccs_111"]);

		
			
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
				$msg = "<span class='errorMsg'>Sorry, Insert Data Into [$contractCSpackageName] already exist!</span><br/><a href='index.php' style='text-decoration:none;font-size:16px;'>Go Home and Insert New Package Information</a>";
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

																		'".$ccs_76."',
																		'".$ccs_77."',
																		'".$ccs_78."',
																		'".$ccs_79."',
																		'".$ccs_80."',
																		'".$ccs_110."',
																		'".$ccs_111."',

																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									";
				$insertQueryStatement = mysql_query($insertQuery);
				if($insertQueryStatement){
					$msg = "<span class='validMsg'>Insert Data Into [ $contractCSpackageName ] added sucessfully</span><br/><a href='index.php' style='text-decoration:none;font-size:16px;'>Go Home and View Package Information</a>";
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
				$msg = "<span class='errorMsg'>Sorry, Insert Data Into [$othersIpackageName] already exist!</span><br/><a href='index.php' style='text-decoration:none;font-size:16px;'>Go Home and Insert New Package Information</a>";
			} else {
				$insertQuery = "
										INSERT INTO 
													adbs_othersinformation
																	(
																		pId,
																		oi_114,
																		oi_120,
																		oi_121,
																		
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
																		
																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									";
				$insertQueryStatement = mysql_query($insertQuery);
				if($insertQueryStatement){
					$msg = "<span class='validMsg'>Insert Data Into [ $othersIpackageName ] added sucessfully</span><br/><a href='index.php' style='text-decoration:none;font-size:16px;'>Go Home and View Package Information</a>";
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
				while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
				{
					/// $num = count($data); 
					if($chk == 0){
							$chk = 1;
					}else {
					$ministryDivision_csv = addslashes($data[0]);  $agency_csv = addslashes($data[1]);  $procuringEntityName_csv = addslashes($data[2]);
						$paName_csv = addslashes($data[3]);   
						  
						$pi_4_csv = addslashes($data[4]);   $pi_6_csv = addslashes($data[5]);
						$pi_7a_csv = addslashes($data[6]);  $pi_7b_csv = addslashes($data[7]);  $pi_13_csv = addslashes($data[8]);
						$pi_17_csv = addslashes($data[9]);  $pi_7c_csv = addslashes($data[10]);  $pi_7d_csv = addslashes($data[11]);
						$bps_38_csv = insertDateMySQlFormat($data[12]); 
						
						$bpes_50_csv = insertDateMySQlFormat($data[13]); 
						$bpes_51_csv = insertDateMySQlFormat($data[14]); $eras_63_csv = insertDateMySQlFormat($data[15]);  
						$cs_64_csv = insertDateMySQlFormat($data[16]);  
						$cs_68_csv = insertDateMySQlFormat($data[17]); $cms_74_csv = insertDateMySQlFormat($data[18]);  
						$test = insertDateMySQlFormat($data[19]);  
						
						$s = addslashes($data[20]);
						$t = addslashes($data[21]);  $u = addslashes($data[22]);  $v = addslashes($data[23]);
						$w = addslashes($data[24]);  $x = addslashes($data[25]); 
						
						$psIdQuery 	= "SELECT * FROM adbs_projectsetup WHERE adbProjectName='".$paName_csv."' ORDER BY psId"; 
						$psIdViewStatement			= mysql_query($psIdQuery);
						while($psIdViewStatementData	= mysql_fetch_array($psIdViewStatement)){ 
								
							 $psIdView_csv        = $psIdViewStatementData["psId"]; 
						}
						
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
																		'".$pi_7d_csv."',
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
																		bps_101,
																		
																		status,
																		entDate,
																		entTime,
																		entUser
																	) 
															VALUES
																	(
																		'".$maxPackageId."',
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
																		
																		status,
																		entDate,
																		entTime,
																		entUser
																	) 
															VALUES
																	(
																		'".$maxPackageId."',
																		'".$bpes_50_csv."', 
																		'".$bpes_51_csv."', 
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
																		'',
																		'',
																		'',
																		'".$eras_63_csv."',
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
																		
																		
																		status,
																		entDate,
																		entTime,
																		entUser
																	) 
															VALUES
																	(
																		'".$maxPackageId."',
																		'',
																		'".$cs_64_csv."',
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

																		'Active',
																		'".$entDate."',
																		'".$entTime."',
																		'".$userId."'
																	)
									";
									$insertQueryStatement = mysql_query($insertQuery);
						
					}
				}
				fclose($handle);
				
			  }

				if($insertQueryStatement){
					$msg = "<span class='validMsg'>Insert Data Into [ $paName_csv ] added sucessfully</span><br/><a href='index.php' style='text-decoration:none;font-size:16px;'>Go Home and View Package Information</a>";
				} else {
					$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
				}
			
			
			 }
			// echo  $msg ; die();
			 return $msg; 
		}
		// Data uplaod csv file End
	}
?>