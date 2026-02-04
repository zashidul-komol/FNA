<?php

include('init.php');
/*
$SQL = "SELECT pId FROM `adbs_package` WHERE entUser not in (3) ORDER BY pId";
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
	mysql_query("DELETE FROM `adbs_paymentstage` WHERE pId = $pId");
	mysql_query("DELETE FROM `adbs_paymentstage_bkdn` WHERE pId = $pId");
	
	
	$success = 1;
	}
if($success){
	
	echo "Successfully Delete it";
	
}else {echo "Not Successfully Delete.";}*/

/*
$SQL = "SELECT USER_ID FROM `s_user` WHERE USER_ID not in (1) ORDER BY USER_ID ASC";
$QUERY = mysql_query($SQL);
$success = 0;
while($queryResult = mysql_fetch_array($QUERY)){
	$USER_ID = $queryResult['USER_ID'];
	
	
	mysql_query("DELETE FROM `s_privilege_control` WHERE USER_ID = $USER_ID");
	mysql_query("DELETE FROM `s_operator` WHERE USER_ID = $USER_ID");
	mysql_query("DELETE FROM `s_user_role` WHERE USER_ID = $USER_ID");
	mysql_query("DELETE FROM `s_user` WHERE USER_ID = $USER_ID");
	
	
	
	$success = 1;
	}
if($success){
	
	echo "Successfully Delete it";
	
}else {echo "Not Successfully Delete.";}*/

?>