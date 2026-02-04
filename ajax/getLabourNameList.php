<?php
	include('../config/dbinfo.inc.php');
	$pcId 	= $_REQUEST['pcId'];
	$module_array 	= array();
	$getModuleQuery	= "
						SELECT 	
								LABOURID,
								LABOURNAME
						FROM 	
								fna_labour
						WHERE	
								PROJECTID =".$pcId." 
								AND STATUS = 'Active'
								ORDER BY 
								LABOURNAME ASC
					 ";
	$getModuleStatement				= mysql_query($getModuleQuery);
	while($getModuleStatementData	= mysql_fetch_array($getModuleStatement)) {
		$LABOURID 				= $getModuleStatementData["LABOURID"];
		$LABOURNAME 			= $getModuleStatementData["LABOURNAME"];
		$module_array[] 			= array('optionValue'=>$LABOURID,'optionDisplay'=>$LABOURNAME);
	}
	echo json_encode($module_array);
?>