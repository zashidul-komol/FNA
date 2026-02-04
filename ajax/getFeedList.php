<?php
	include('../config/dbinfo.inc.php');
	$pcId 	= $_REQUEST['pcId'];
	$module_array 	= array();
	$getModuleQuery	= "
						SELECT 	
								FOODID,
								FOODNAME
						FROM 	
								feed_fooditem 
						WHERE	
								SUBPROJECTID =".$pcId." 
						ORDER BY 
								FOODNAME ASC
					 ";
	$getModuleStatement				= mysql_query($getModuleQuery);
	while($getModuleStatementData	= mysql_fetch_array($getModuleStatement)) {
		$FOODID		 				= $getModuleStatementData["FOODID"];
		$FOODNAME		 			= $getModuleStatementData["FOODNAME"];
		$module_array[] 			= array('optionValue'=>$FOODID,'optionDisplay'=>$FOODNAME);
	}
	echo json_encode($module_array);
?>