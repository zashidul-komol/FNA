<?php

	class pacakgeInformationEditInsert Extends BaseClass {
		function pacakgeInformationEditInsert() {
			$this->con=$this->BaseClass();
		}	
		
		
			
		// Insert Package Information start <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
		function insertPacakgeInformationEidt($userId){
			
			$piId 			= addslashes($_REQUEST["piId"]);
			$pmId 			= addslashes($_REQUEST["pmId"]);
			$bpId 			= addslashes($_REQUEST["bpId"]);
			$p_pName 		= addslashes($_REQUEST["packageName"]);
			$agency 		= addslashes($_REQUEST["agency"]);
			$agencyName 	= addslashes($_REQUEST["agencyName"]);
			$psId 			= addslashes($_REQUEST["psId"]);
			$adbPackageName = addslashes($_REQUEST["adbPackageName"]);

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
			$pi_18			= addslashes($_REQUEST["pi_18"]); 
			$pi_19			= addslashes($_REQUEST["pi_19"]);
			
			$packageId 		= addslashes($_REQUEST["packageId"]);
			
			$piProcurementType 			= addslashes($_REQUEST["piId"]);
			$piProcurementMethod 		= addslashes($_REQUEST["pmId"]);
			$piBiddingProcedure 		= addslashes($_REQUEST["bpId"]);
			
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

			
			$entDate 		= date('Y-m-d');
			$entTime 		= date('H:i:s A');  

			$insertQuery = "UPDATE 
								  `adbs_package`
								  SET
								        ptId 			 = '".$piId."',
										pmId 			 = '".$pmId."',
										bpId 			 = '".$bpId."',
										pName 			 = '".$p_pName."',
										agency 			 = '".$agency."',
										agencyName 		 = '".$agencyName."',
										psId 		     = '".$psId."',
										adbPackageName 	 = '".$adbPackageName."',
										
										pi_4 		= '".$pi_4."',
										pi_5 		= '".$pi_5."',
										pi_6 		= '".$pi_6."',
										pi_7 		= '".$pi_7."',
										pi_7a 		= '".$pi_7a."',
										pi_7b 		= '".$pi_7b."',
										pi_7c 		= '".$pi_7c."',
										pi_7d 		= '".$pi_7d."',
										pi_8 		= '".$pi_8."',
										
										pi_13 		= '".$ptName."',
										pi_14 		= '".$pmName."',
										pi_15 		= '".$bpName."',
										pi_16 	    = '".$pi_16."',
										pi_17 	    = '".$pi_17."',
										pi_18 	    = '".$pi_18."',
										pi_19 	    = '".$pi_19."',
										
										status  	= 'active',
										entDate 	= '".$entDate."',
										entTime 	= '".$entTime."',
 										entUser 	= '".$userId."'
								  WHERE
										pId       = '".$packageId."'
											
										";
				$insertQueryStatement = mysql_query($insertQuery);
				if($insertQueryStatement){
					$msg = "<span class='validMsg'>Update Data Into [ $adbPackageName ] added sucessfully</span><br/><a href='index.php' style='text-decoration:none;font-size:16px;'>Go Home and View Package Information</a><br/><br/>
					<input type='button' value='Back' onclick='window.close();' class='FormResetBtn'>";
				} else {
					$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
				}
			return $msg;
			
		}
		// Insert Package Information End
		
		// Insert PQ Stage start <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
		
			
		
		function editPQStageEidt($userId){

			$pqs_20 			= insertDateMySQlFormat($_REQUEST["pqs_20"]);
		    $pqs_21 			= insertDateMySQlFormat($_REQUEST["pqs_21"]);
			$pqs_22 			= insertDateMySQlFormat($_REQUEST["pqs_22"]);
			$pqs_22a 			= insertDateMySQlFormat($_REQUEST["pqs_22a"]);
			$pqs_23 			= insertDateMySQlFormat($_REQUEST["pqs_23"]);
			$pqs_24 			= insertDateMySQlFormat($_REQUEST["pqs_24"]);
			
			$pqs_25 			= insertDateMySQlFormat($_REQUEST["pqs_25"]);
			$pqs_26			    = insertDateMySQlFormat($_REQUEST["pqs_26"]);
			$pqs_27			    = insertDateMySQlFormat($_REQUEST["pqs_27"]);
			$pqs_27a 			= insertDateMySQlFormat($_REQUEST["pqs_27a"]);
			$pqs_28			    = insertDateMySQlFormat($_REQUEST["pqs_28"]);
			
			$pqs_81 			= addslashes($_REQUEST["pqs_81"]);
			$pqs_82 			= addslashes($_REQUEST["pqs_82"]);
			$pqs_83 			= addslashes($_REQUEST["pqs_83"]);
			$pqs_102 			= addslashes($_REQUEST["pqs_102"]);
			$pqs_103 			= addslashes($_REQUEST["pqs_103"]);
			$pqs_104 			= addslashes($_REQUEST["pqs_104"]);
		
			
			$pQpackageId 		= addslashes($_REQUEST["packageId"]);
			$pqs_pName 		    = addslashes($_REQUEST["packageName"]);

			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			$status 			= "active";

            $insertQuery = "UPDATE 
								  `adbs_pqstage`
								  SET
										pqs_20 		= '".$pqs_20."',
										pqs_21 		= '".$pqs_21."',
										pqs_22 		= '".$pqs_22."',
										pqs_22a 	= '".$pqs_22a."',
										pqs_23 		= '".$pqs_23."',
										pqs_24 		= '".$pqs_24."',
										pqs_25 		= '".$pqs_25."',
										pqs_26 		= '".$pqs_26."',
										pqs_27 		= '".$pqs_27."',
										pqs_27a		= '".$pqs_27a."',
										pqs_28 		= '".$pqs_28."',
										pqs_81 		= '".$pqs_81."',
										pqs_82 		= '".$pqs_82."',
										pqs_83 		= '".$pqs_83."',
										pqs_101 	= 'null',
										pqs_102 	= '".$pqs_102."',
										pqs_103 	= '".$pqs_103."',
										pqs_104 	= '".$pqs_104."',
										status  	= 'active',
										entDate 	= '".$entDate."',
										entTime 	= '".$entTime."',
 										entUser 	= '".$userId."'
								  WHERE
										pId       = '".$pQpackageId."'
											
										";
				$insertQueryStatement = mysql_query($insertQuery);
				if($insertQueryStatement){
					$msg = "<span class='validMsg'>Update Data Into [ $pqs_pName ] added sucessfully</span><br/><a href='index.php' style='text-decoration:none;font-size:16px;'>Go Home and View Package Information</a><br/><br/>
					<input type='button' value='Back' onclick='window.close();' class='FormResetBtn'>";
				} else {
					$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
				}
			return $msg;			
			
		}
		// Insert PQ Stage End
		
			// Insert biddingDPStage start <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
		function biddingDPStageEidt($userId){

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
			
			 $insertQuery = "UPDATE 
								  `adbs_biddingdocumentpreparationstage`
								  SET
										bdps_29	 		= '".$bdps_29."',
										bdps_30 		= '".$bdps_30."',
										bdps_31 		= '".$bdps_31."',
										bdps_32 		= '".$bdps_32."',
										bdps_33 		= 'null',
										bdps_34 		= 'null',
										bdps_35 		= 'null',
										bdps_36 		= 'null',
										bdps_37 		= 'null',
										bdps_89 		= '".$bdps_89."',
										bdps_90		    = '".$bdps_90."',
										
										status  	= 'active',
										entDate 	= '".$entDate."',
										entTime 	= '".$entTime."',
 										entUser 	= '".$userId."'
								  WHERE
										pId       = '".$biddingDPStgpackageId."'
											
										";
				$insertQueryStatement = mysql_query($insertQuery);
				if($insertQueryStatement){
					$msg = "<span class='validMsg'>Update Data Into [ $biddingDPStg_pName ] added sucessfully</span><br/><a href='index.php' style='text-decoration:none;font-size:16px;'>Go Home and View Package Information</a><br/><br/>
					<input type='button' value='Back' onclick='window.close();' class='FormResetBtn'>";
				} else {
					$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
				}
			return $msg;	
			
		}
		// Insert biddingDPStage Stage End
		
		
		// Insert Bidding / Proposal Stage start <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
		
			
		
		function biddingProposalStageEidt($userId){

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
			$biddingProposalStage_pName 		= addslashes($_REQUEST["packageName"]);

			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			$status 			= "active";
			
			$insertQuery = "UPDATE 
								  `adbs_biddingproposalstage`
								  SET
										bps_38 		= '".$bps_38."',
										bps_38a	 	= '".$bps_38a."',
										bps_39 		= '".$bps_39."',
										bps_40 		= '".$bps_40."',
										bps_41 		= '".$bps_41."',
										bps_42 		= '".$bps_42."',
										bps_43 		= '".$bps_43."',
										bps_44 		= '".$bps_44."',
										bps_45 		= '".$bps_45."',
										bps_46 		= '".$bps_46."',
										bps_47 		= 'null',
										bps_48 		= '".$bps_48."',
										bps_49 		= '".$bps_49."',
										bps_84 	    = '".$bps_84."',
										bps_90 	    = '".$bps_90."',
										bps_91   	= '',
										bps_92 	    = '',
										bps_102 	= '',
										status  	= 'active',
										entDate 	= '".$entDate."',
										entTime 	= '".$entTime."',
 										entUser 	= '".$userId."'
								  WHERE
										pId       = '".$biddingProposalStagepackageId."'
											
										";
				$insertQueryStatement = mysql_query($insertQuery);
				if($insertQueryStatement){
					$msg = "<span class='validMsg'>Update Data Into [ $biddingProposalStage_pName ] added sucessfully</span><br/><a href='index.php' style='text-decoration:none;font-size:16px;'>Go Home and View Package Information</a><br/><br/>
					<input type='button' value='Back' onclick='window.close();' class='FormResetBtn'>";
				} else {
					$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
				}
			return $msg;	
			
		}
		// Insert Bidding / Proposal Stage End
		
		// Insert Bid / Proposal Evaluation Stage start <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
		
			
		
		function bidProposalEvaluationStageEidt($userId){
			
			$bpes_50 			= insertDateMySQlFormat($_REQUEST["bpes_50"]);
			$bpes_50a 			= insertDateMySQlFormat($_REQUEST["bpes_50a"]);
			$bpes_51a 			= insertDateMySQlFormat($_REQUEST["bpes_51a"]);
			$bpes_54a 			= insertDateMySQlFormat($_REQUEST["bpes_54a"]);  
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
			$status 			= "active";
			
			$insertQuery = "UPDATE 
								  `adbs_bidproposalevaluationstage`
								  
								  SET
										bpes_50 		= '".$bpes_50."',
										bpes_51 		= 'null',
										bpes_52 		= 'null',
										bpes_53 		= 'null',
										bpes_54 		= 'null',
										bpes_54a 		= '".$bpes_54a."',
										bpes_55 		= 'null',
										bpes_56 		= '".$bpes_56."',
										bpes_85 		= '".$bpes_85."',
										bpes_86 		= '".$bpes_86."',
										bpes_87 		= '".$bpes_87."',
										bpes_93 		= '".$bpes_93."',
										bpes_94 		= '".$bpes_94."',
										bpes_97 		= '".$bpes_97."',
										bpes_98 		= '".$bpes_98."',
										bpes_100	 	= '',
										bpes_101 		= 'null',
										bpes_102	 	= '".$bpes_102."',
										bpes_103 		= '".$bpes_103."',
										bpes_112 		= '',
										bpes_50a 		= '".$bpes_50a."',
										bpes_51a 		= '".$bpes_51a."',
										bpes_56a 		= '".$bpes_56a."',
										bpes_95a 		= '".$bpes_95a."',
										bpes_104 		= '".$bpes_104."',
										bpes_113 		= '".$bpes_113."',
										
										
										status  	= 'active',
										entDate 	= '".$entDate."',
										entTime 	= '".$entTime."',
 										entUser 	= '".$userId."'
								  WHERE
										pId       = '".$bPESpackageId."'
											
										";
				$insertQueryStatement = mysql_query($insertQuery);
				if($insertQueryStatement){
					$msg = "<span class='validMsg'>Update Data Into [ $bPESpackageName ] added sucessfully</span><br/><a href='index.php' style='text-decoration:none;font-size:16px;'>Go Home and View Package Information</a><br/><br/>
					<input type='button' value='Back' onclick='window.close();' class='FormResetBtn'>";
				} else {
					$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
				}
			return $msg;	
			
		}
		// Insert Bid / Proposal Evaluation Stage End
		
		
		
		// Insert Evaluation Report Approval Stagee start <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
		
		function evaluationPASEidt($userId){

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
			
			$insertQuery = "UPDATE 
								  `adbs_evaluationreportapprovalstage`
								  
								  SET
										eras_57 		= 'null',
										eras_58 		= 'null',
										eras_59 		= 'null',
										eras_60 		= 'null',
										eras_60a 		= '".$eras_60a."',
										eras_61 		= '".$eras_61."',
										eras_62 		= '".$eras_62."',
										eras_62a 		= '".$eras_62a."',
										eras_63 		= '".$eras_63."',
										eras_95 		= '".$eras_95."',
										eras_96 		= '".$eras_96."',
										eras_99 		= '',
										eras_101 		= '".$eras_101."',
										eras_62b 		= '".$eras_62b."',
										eras_104 		= '".$eras_104."',
										
										status  	= 'active',
										entDate 	= '".$entDate."',
										entTime 	= '".$entTime."',
 										entUser 	= '".$userId."'
								  WHERE
										pId       = '".$evaluationRASpackageId."'
											
										";
				$insertQueryStatement = mysql_query($insertQuery);
				if($insertQueryStatement){
					$msg = "<span class='validMsg'>Update Data Into [ $evaluationRASpackageName ] added sucessfully</span><br/><a href='index.php' style='text-decoration:none;font-size:16px;'>Go Home and View Package Information</a><br/><br/>
					<input type='button' value='Back' onclick='window.close();' class='FormResetBtn'>";
				} else {
					$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
				}
			return $msg;	
			
		}
		// Insert Evaluation Report Approval Stage End
		
		// Insert Contracting Stage start <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
		
		function contractingStageEidt($userId){
			
			$cs_64 			= insertDateMySQlFormat($_REQUEST["cs_64"]);
			$cs_65 			= insertDateMySQlFormat($_REQUEST["cs_65"]);
		    $cs_66 			= insertDateMySQlFormat($_REQUEST["cs_66"]);
			
			$cs_67 			= insertDateMySQlFormat($_REQUEST["cs_67"]);
			$cs_67a 		= insertDateMySQlFormat($_REQUEST["cs_67a"]);
			$cs_67aCal 		= showDateMySQlFormat($_REQUEST["cs_67a"]);
			$cs_68 			= insertDateMySQlFormat($_REQUEST["cs_68"]);
		    $cs_69 			= insertDateMySQlFormat($_REQUEST["cs_69"]);
			
			$cs_70 			= insertDateMySQlFormat($_REQUEST["cs_70"]);
		    $cs_9 			= str_replace(",", "",$_REQUEST["cs_9"]);			
			$cs_11 			= str_replace(",", "",$_REQUEST["cs_11"]);
			$cs_72 			= insertDateMySQlFormat($_REQUEST["cs_72"]);
			$cs_72a 		= addslashes($_REQUEST["cs_72a"]);
			
			$cs_104 		= addslashes($_REQUEST["cs_104"]);
			$cs_105 		= addslashes($_REQUEST["cs_105"]);
			$cs_106 		= addslashes($_REQUEST["cs_106"]);
			
			$cs_113 		= addslashes($_REQUEST["cs_113"]);
			$cs_114a		= addslashes($_REQUEST["cs_114a"]);
			
			$date = "$cs_67aCal"; 
			$date = strtotime($date);
			$date = strtotime("+$cs_72a day", $date);
			$cs_72Result =  insertDateMySQlFormat(date('d-m-Y', $date)); 
		
			
			$contractingStagepackageId 	    = addslashes($_REQUEST["contractingStagepackageId"]);
			$contractingStagepackageName 	= addslashes($_REQUEST["contractingStagepackageName"]);

			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
			$insertQuery = "UPDATE 
								  `adbs_contractingstage`
								  
								  SET
										cs_63a 		= '',
										cs_64 		= '".$cs_64."',
										cs_65 		= '".$cs_65."',
										cs_66 		= '".$cs_66."',
										cs_67 		= '".$cs_67."',
										cs_67a 		= '".$cs_67a."',
										cs_68 		= '".$cs_68."',
										cs_69 		= '".$cs_69."',
										cs_70 		= '".$cs_70."',
										
										cs_9 		= '".$cs_9."',
										cs_11 		= '".$cs_11."',
										cs_72 		= '".$cs_72Result."',
										cs_104 		= '".$cs_104."',
										cs_105 		= '".$cs_105."',
										cs_106 		= '".$cs_106."',
										cs_113 		= '".$cs_113."',
										cs_114a 	= '".$cs_114a."',
										cs_72a 		= '".$cs_72a."',
										
										status  	= 'active',
										entDate 	= '".$entDate."',
										entTime 	= '".$entTime."',
 										entUser 	= '".$userId."'
								  WHERE
										pId       = '".$contractingStagepackageId."'
											
										";
				$insertQueryStatement = mysql_query($insertQuery);
				if($insertQueryStatement){
					$msg = "<span class='validMsg'>Update Data Into [ $contractingStagepackageName ] added sucessfully</span><br/><a href='index.php' style='text-decoration:none;font-size:16px;'>Go Home and View Package Information</a><br/><br/>
					<input type='button' value='Back' onclick='window.close();' class='FormResetBtn'>";
				} else {
					$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
				}
			return $msg;	
			
		}
		// Insert Contracting Stage End
		
		// Insert Contract Management Stage start <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
		
		function contractManagementStageEidt($userId){

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
			
			$insertQuery = "UPDATE 
								  `adbs_contractmanagementstage`
								  
								  SET
										cms_71 		= '".$cms_71."',
										cms_72a 	= '',
										cms_73 		= '".$cms_73."',
										cms_74 		= '".$cms_74."',
										cms_75 		= '".$cms_75."',
										cms_107 	= '".$cms_107."',
										cms_108 	= '',
										cms_109 	= '',
										cms_10 		= '".$cms_10."',
										cms_12 		= '".$cms_12."',
										cms_75a 	= '".$cms_75a."',
										
										status  	= 'active',
										entDate 	= '".$entDate."',
										entTime 	= '".$entTime."',
 										entUser 	= '".$userId."'
								  WHERE
										pId       = '".$contractMSpackageId."'
											
										";
				$insertQueryStatement = mysql_query($insertQuery);
				if($insertQueryStatement){
					$msg = "<span class='validMsg'>Update Data Into [ $contractMSpackageName ] added sucessfully</span><br/><a href='index.php' style='text-decoration:none;font-size:16px;'>Go Home and View Package Information</a><br/><br/>
					<input type='button' value='Back' onclick='window.close();' class='FormResetBtn'>";
				} else {
					$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
				}
			return $msg;
			
			
		}
		// Insert Contract Management Stage End
		
		
		// Insert Payment start <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
		function insertPaymentStageEdit($userId){

			$psbkdn_79a 			= insertDateMySQlFormat($_REQUEST["psbkdn_79a"]); 
			$psbkdn_79b 			= insertDateMySQlFormat($_REQUEST["psbkdn_79b"]);
			$psbkdn_79c 			= str_replace(",", "",$_REQUEST["psbkdn_79c"]);
			$psbkdn_79d 			= addslashes($_REQUEST["psbkdn_79d"]);
			
			$paymentStageId 		    = addslashes($_REQUEST["packageId"]);
			$paymentStage_pName 		= addslashes($_REQUEST["packageName"]);
			
			$cs_11 = '';
			$csSql	= "SELECT * FROM adbs_contractingstage WHERE pId='".$paymentStageId."' ORDER BY csId";
			$csSqlStatement		= mysql_query($csSql);
			$csSqlStatementData	= mysql_fetch_array($csSqlStatement);
			$cs_11       			= $csSqlStatementData["cs_11"]; 
			
			$ps_76 = '';
			$psSql	= "SELECT * FROM adbs_paymentstage WHERE pId='".$paymentStageId."' ORDER BY psId";
			$psSqlStatement		= mysql_query($psSql);
			$psSqlStatementData	= mysql_fetch_array($psSqlStatement);
			$ps_76       			= $psSqlStatementData["ps_76"];
			
			$paymentOne = ($psbkdn_79c + $ps_76);
			
			$paymentTotal = ($cs_11 - $paymentOne);

			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
			 $insertQuery = "UPDATE 
								  `adbs_paymentStage_bkdn`
								  SET
										psbkdn_79a	 	= '".$psbkdn_79a."',
										psbkdn_79b 		= '".$psbkdn_79b."',
										psbkdn_79c 		= '".$psbkdn_79c."',
										psbkdn_79d 		= '".$psbkdn_79d."',
										
										status  	= 'active',
										entDate 	= '".$entDate."',
										entTime 	= '".$entTime."',
 										entUser 	= '".$userId."'
								  WHERE
										pId       = '".$paymentStageId."'
											
										";
				$insertQueryStatement = mysql_query($insertQuery);
				
				 $insertQuery = "UPDATE 
									  `adbs_paymentstage`
									  SET
											ps_76	 	= '".$paymentOne."',
											ps_77 		= '".$psbkdn_79d."',
											ps_78 		= '".$paymentTotal."',
											ps_79 		= '',
											
											status  	= 'active',
											entDate 	= '".$entDate."',
											entTime 	= '".$entTime."',
											entUser 	= '".$userId."'
									  WHERE
											pId       = '".$paymentStageId."'";
					$insertQueryStatement = mysql_query($insertQuery);
				
				if($insertQueryStatement){
					$msg = "<span class='validMsg'>Update Data Into [ $paymentStage_pName ] added sucessfully</span><br/><a href='index.php' style='text-decoration:none;font-size:16px;'>Go Home and View Package Information</a><br/><br/>
					<input type='button' value='Back' onclick='window.close();' class='FormResetBtn'>";
				} else {
					$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
				}
			return $msg;	
			
		}
		// Insert Payment Stage End
		
		// Insert Disbursements start <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
		function insertDisbursementsStage($userId){

			$bpc_79h 			= addslashes($_REQUEST["bpc_79h"]);
			$bpc_79i 			= addslashes($_REQUEST["bpc_79i"]);
			$bpc_79j 			= str_replace(",", "",$_REQUEST["bpc_79j"]); 
			
		    $pi_4 		= addslashes($_REQUEST["pi_4"]); 
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
		
		
	   // Update Payment start <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
		function updatePaymentStage($userId){

			$psbkdn_1 						    = insertDateMySQlFormat($_REQUEST["psbkdn_1"]);
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
			
			
			$a_P_AdjustmentFirst                = $psbkdn_2 - $psbkdn_12; 
			$net_paymentFirst                   = $psbkdn_8 + $psbkdn_9;
			$net_paymentSecond                  = $net_paymentFirst - $psbkdn_10;
			$net_paymentFinal                   = $net_paymentSecond - $a_P_AdjustmentFirst;  
			
			
			$yearBillClaimDate 					= date("Y",strtotime($psbkdn_6)); 
			$monthPaymentDate   				= date("m",strtotime($psbkdn_6)); 
			
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
			
			
			
			$psbkdn_flag 			= addslashes($_REQUEST["psbkdn_flag"]);  
			$psbkdn_3OLD 			= addslashes($_REQUEST["psbkdn_3"]); 
			$pi_4 					= addslashes($_REQUEST["pi_4"]); 
			$pi_6 					= addslashes($_REQUEST["pi_6"]); 
			$paymentStageId 		= addslashes($_REQUEST["packageId"]);  
			$paymentStage_pName 	= addslashes($_REQUEST["packageName"]); 

			
			
			if($psbkdn_flag == 1){
				$actual                		= $psbkdn_2 + $net_paymentFinal;
			}elseif($psbkdn_flag > 1){
				$actual             		= $net_paymentFinal + $a_P_AdjustmentFirst;
			}

				$updateInsertQuery ="UPDATE 
											`adbs_paymentstage_bkdn`
													SET

														psId		 			= '',
														psbkdn_1		 		= '".$psbkdn_1."',
														psbkdn_2		 		= '".$psbkdn_2."',
														psbkdn_4		 		= '".$psbkdn_4."',
														psbkdn_5		 		= '".$psbkdn_5."',
														psbkdn_6		 		= '".$psbkdn_6."',
														psbkdn_7		 		= '".$psbkdn_7."',
														psbkdn_8		 		= '".$psbkdn_8."',
														psbkdn_9		 		= '".$psbkdn_9."',
														psbkdn_10		 		= '".$psbkdn_10."',
														psbkdn_12		 		= '".$psbkdn_12."',
														net_payment		 		= '".$net_paymentFinal."',
														a_p_Adjustment		 	= '".$a_P_AdjustmentFirst."',
														psbkdn_QuaterNo		 	= '".$monthBillClaimDateQ."',
														psbkdn_Year		 		= '".$yearBillClaimDate."',
														psbkdn_Actual		 	= '".$actual."',
														
														status		 			= 'Active',
														entDate		 			= '".$entDate."',
														entTime		 			= '".$entTime."',
														entUser		 			= '".$userId."'
														
											 WHERE
														pId       				= '".$paymentStageId."' 
												AND     psbkdn_3  				= '".$psbkdn_3OLD."'
												AND     psbkdn_flag  			= '".$psbkdn_flag."'		
											";			

				$updateInsertQueryStatement = mysql_query($updateInsertQuery);						
				if($updateInsertQueryStatement){
					$msg = "<span class='validMsg'>Update Data Into [ $paymentStage_pName ] added sucessfully</span><br/><a href='index.php' style='text-decoration:none;font-size:16px;'>Go Home and View Package Information</a><br/><br/>
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
			return $msg;
		}
		// Update Payment Stage End
		
		
		// Insert Contract Concluding Stage start <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
		
		function contractConcludingStageEidt($userId){

		    $ccs_79				= str_replace(",", "",$_REQUEST["ccs_79"]);
			$ccs_80 			= str_replace(",", "",$_REQUEST["ccs_80"]);


		
			
			$contractCSpackageId 	= addslashes($_REQUEST["contractCSpackageId"]);
			$contractCSpackageName 	= addslashes($_REQUEST["contractCSpackageName"]);

			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
			$insertQuery = "UPDATE 
								  `adbs_contractconcludingstage`
								  
								  SET
										ccs_76 		= '',
										ccs_77   	= '',
										ccs_78 		= '',
										ccs_79 		= '".$ccs_79."',
										ccs_80 		= '".$ccs_80."',
										ccs_110 	= '',
										ccs_111 	= '',
										
										status  	= 'active',
										entDate 	= '".$entDate."',
										entTime 	= '".$entTime."',
 										entUser 	= '".$userId."'
								  WHERE
										pId       = '".$contractCSpackageId."'
											
										";
				$insertQueryStatement = mysql_query($insertQuery);
				if($insertQueryStatement){
					$msg = "<span class='validMsg'>Update Data Into [ $contractCSpackageName ] added sucessfully</span><br/><a href='index.php' style='text-decoration:none;font-size:16px;'>Go Home and View Package Information</a><br/><br/>
					<input type='button' value='Back' onclick='window.close();' class='FormResetBtn'>";
				} else {
					$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
				}
			return $msg;
			
			
		}
		// Insert Contract Concluding Stage End
		
		
		// Insert Others Information start <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
		
		function othersInformationEidt($userId){


			$oi_114 			= addslashes($_REQUEST["oi_114"]); 
			$oi_111 			= addslashes($_REQUEST["oi_111"]);
			$oi_112 			= addslashes($_REQUEST["oi_112"]);
			$oi_118 			= addslashes($_REQUEST["oi_118"]);
			$oi_119 			= addslashes($_REQUEST["oi_119"]);

		
			
			$othersIpackageId 	= addslashes($_REQUEST["othersIpackageId"]);
			$othersIpackageName 	= addslashes($_REQUEST["othersIpackageName"]);

			$entDate 			= date('Y-m-d');
			$entTime 			= date('H:i:s A');
			
			$insertQuery = "UPDATE 
								  `adbs_othersinformation`
								  
								  SET
										oi_114 		= '".$oi_114."',
										oi_120   	= 'null',
										oi_121 		= 'null',
										oi_111 		= '".$oi_111."',
										oi_112 		= '".$oi_112."',
										oi_118 		= '".$oi_118."',
										oi_119 		= '".$oi_119."',
																				
										status  	= 'active',
										entDate 	= '".$entDate."',
										entTime 	= '".$entTime."',
 										entUser 	= '".$userId."'
								  WHERE
										pId       = '".$othersIpackageId."'
											
										";
				$insertQueryStatement = mysql_query($insertQuery);
				if($insertQueryStatement){
					$msg = "<span class='validMsg'>Update Data Into [ $othersIpackageName ] added sucessfully</span><br/><a href='index.php' style='text-decoration:none;font-size:16px;'>Go Home and View Package Information</a><br/><br/>
					<input type='button' value='Back' onclick='window.close();' class='FormResetBtn'>";
				} else {
					$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
				}
			return $msg;
			
		}
		// Insert Others Information End
		
	}
?>