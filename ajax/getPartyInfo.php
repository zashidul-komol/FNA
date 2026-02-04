<?php
	include('../config/dbinfo.inc.php');
	$party_id 	= $_REQUEST['party_id'];
	$module_array 	= array();
	$getModuleQuery	= "
						SELECT 	
								PARTYNAME,
								FATHERNAME,
								ADDRESS,
								MOBILE
						FROM 	
								fna_party 
						WHERE	
								PARTYID =".$party_id." 
						ORDER BY LOWER(TRIM(PARTYNAME)) ASC
					 ";
	$getModuleStatement				= mysql_query($getModuleQuery);
	while($getModuleStatementData	= mysql_fetch_array($getModuleStatement)) {
		$PARTYNAME 					= $getModuleStatementData["PARTYNAME"];
		$FATHERNAME 				= $getModuleStatementData["FATHERNAME"];
		$ADDRESS 					= $getModuleStatementData["ADDRESS"];
		$MOBILE 					= $getModuleStatementData["MOBILE"];
		$module_array[] 			= array('PARTYNAME'=>$PARTYNAME,'FATHERNAME'=>$FATHERNAME,'ADDRESS'=>$ADDRESS,'MOBILE'=>$MOBILE);
	}
	echo json_encode($module_array);
?>