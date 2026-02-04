<?php
	include('../config/dbinfo.inc.php');
	$pcId 	= $_REQUEST['pcId'];
	$module_array 	= array();
	$getModuleQuery	= "
						SELECT 	
								SUBPROJECTID,
								SUBPROJECTNAME
						FROM 	
								fna_subproject 
						WHERE	
								PROJECTID = ".$pcId." 
								
						ORDER BY LOWER(TRIM(SUBPROJECTNAME)) ASC
					 ";
	$getModuleStatement				= mysql_query($getModuleQuery);
	while($getModuleStatementData	= mysql_fetch_array($getModuleStatement)) {
		$SUBPROJECTID 				= $getModuleStatementData["SUBPROJECTID"];
		$SUBPROJECTNAME 			= $getModuleStatementData["SUBPROJECTNAME"];
		$module_array[] 			= array('optionValue'=>$SUBPROJECTID,'optionDisplay'=>$SUBPROJECTNAME);
	}
	echo json_encode($module_array);
?>