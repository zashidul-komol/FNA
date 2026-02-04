<?php
	include('../config/dbinfo.inc.php');
	$pcId 	= $_REQUEST['pcId'];
	$module_array 	= array();
	$getModuleQuery	= "
						SELECT 	
								EXPSUBHID,
								SUBHEADNAME
						FROM 	
								fna_expsubhead 
						WHERE	
								EXPHID =".$pcId." 
						ORDER BY 
								SUBHEADNAME ASC
					 ";
	$getModuleStatement				= mysql_query($getModuleQuery);
	while($getModuleStatementData	= mysql_fetch_array($getModuleStatement)) {
		$EXPSUBHID 						= $getModuleStatementData["EXPSUBHID"];
		$SUBHEADNAME 					= $getModuleStatementData["SUBHEADNAME"];
		$module_array[] 				= array('optionValue'=>$EXPSUBHID,'optionDisplay'=>$SUBHEADNAME);
	}
	echo json_encode($module_array);
?>