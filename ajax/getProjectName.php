<?php
	include('../config/dbinfo.inc.php');
	$agency_id 	= $_REQUEST['agency_id'];
	$module_array 	= array();
	$getModuleQuery	= "
						SELECT 	
								psId,
								adbProjectName
						FROM 	
								adbs_projectsetup 
						WHERE	
								aId =".$agency_id." 
						ORDER BY 
								adbProjectName ASC
					 ";
	$getModuleStatement				= mysql_query($getModuleQuery);
	while($getModuleStatementData	= mysql_fetch_array($getModuleStatement)) {
		$psId 								= $getModuleStatementData["psId"];
		$adbProjectName 					= $getModuleStatementData["adbProjectName"];
		$module_array[] 				= array('inputValue'=>$adbProjectName,'inputDisplay'=>$adbProjectName);
	}
	echo json_encode($module_array);
?>