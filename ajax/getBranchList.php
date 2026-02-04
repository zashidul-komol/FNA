<?php
	include('../config/dbinfo.inc.php');
	$pcId 	= $_REQUEST['pcId'];
	$module_array 	= array();
	$getModuleQuery	= "
						SELECT 	
								BRANCHID,
								BRANCHNAME
						FROM 	
								fna_branch 
						WHERE	
								BANKID =".$pcId." 
						ORDER BY 
								BRANCHNAME ASC
					 ";
	$getModuleStatement				= mysql_query($getModuleQuery);
	while($getModuleStatementData	= mysql_fetch_array($getModuleStatement)) {
		$BRANCHID	 				= $getModuleStatementData["BRANCHID"];
		$BRANCHNAME		 			= $getModuleStatementData["BRANCHNAME"];
		$module_array[] 			= array('optionValue'=>$BRANCHID,'optionDisplay'=>$BRANCHNAME);
	}
	echo json_encode($module_array);
?>