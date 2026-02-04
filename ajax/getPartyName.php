<?php
	include('../config/dbinfo.inc.php');
	$pcId = intval($_REQUEST['pcId']); // safe
	$module_array = array();

	$getModuleQuery = "
	    SELECT PARTYID, PARTYNAME
	    FROM fna_party
	    WHERE SUBPROJECTID = $pcId
	    ORDER BY LOWER(TRIM(PARTYNAME)) ASC
	";

	$getModuleStatement = mysql_query($getModuleQuery);

	while ($getModuleStatementData = mysql_fetch_array($getModuleStatement)) {
	    $PARTYID = $getModuleStatementData["PARTYID"];
	    $PARTYNAME = $getModuleStatementData["PARTYNAME"];
	    $module_array[] = array(
	        'optionValue' => $PARTYID,
	        'optionDisplay' => $PARTYNAME
	    );
	}

	echo json_encode($module_array);


?>