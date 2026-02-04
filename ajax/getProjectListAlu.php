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
								AND SUBPROJECTID IN(1,54,75)
						ORDER BY 
								SUBPROJECTNAME ASC
					 ";
	$getModuleStatement				= mysql_query($getModuleQuery);
	while($getModuleStatementData	= mysql_fetch_array($getModuleStatement)) {
		$SUBPROJECTID 				= $getModuleStatementData["SUBPROJECTID"];
		$SUBPROJECTNAME 			= $getModuleStatementData["SUBPROJECTNAME"];
		$module_array[] 			= array('optionValue'=>$SUBPROJECTID,'optionDisplay'=>$SUBPROJECTNAME);
	}
	echo json_encode($module_array);
?>