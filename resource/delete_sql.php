<?php

$SQL = "SELECT pId FROM `adbs_package` WHERE pi_4 not in ('G-01','G-02','G-03','G-04','G-05','G-06','G-07','PEDPIII/DPE/G050') ORDER BY pId";
$QUERY = mysql_query($SQL);
$success = 0;
while($queryResult = mysql_fetch_array($QUERY)){
	$pId = $queryResult['pId'];
	
	
	mysql_query("DELETE FROM `adbs_biddingdocumentpreparationstage` WHERE pId = $pId");
	mysql_query("DELETE FROM `adbs_biddingproposalstage` WHERE pId = $pId");
	mysql_query("DELETE FROM `adbs_bidproposalevaluationstage` WHERE pId = $pId");
	mysql_query("DELETE FROM `adbs_contractconcludingstage` WHERE pId = $pId");
	mysql_query("DELETE FROM `adbs_contractingstage` WHERE pId = $pId");
	mysql_query("DELETE FROM `adbs_contractmanagementstage` WHERE pId = $pId");
	mysql_query("DELETE FROM `adbs_evaluationreportapprovalstage` WHERE pId = $pId");
	mysql_query("DELETE FROM `adbs_othersinformation` WHERE pId = $pId");
	mysql_query("DELETE FROM `adbs_pqstage` WHERE pId = $pId");	
	mysql_query("DELETE FROM `adbs_package` WHERE pId = $pId");
	
	$success = 1;
	}
if($success){
	
	echo "Successfully Delete it";
	
}else {echo "Not Successfully Delete.";}

?>