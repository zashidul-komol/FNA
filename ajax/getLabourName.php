<?php
	include('../config/dbinfo.inc.php');
	$pcId 	= $_REQUEST['pcId'];
	$module_array 	= array();
	$getModuleQuery	= "
						SELECT 	
								l.LABOURID,
								l.LABOURNAME
						FROM 	
								fna_labour l, fna_labourcontact lc
						WHERE	
								l.SUBPROJECTID =".$pcId." 
								AND l.LABOURID = lc.LABOURID
						ORDER BY 
								l.LABOURNAME ASC
					 ";
	$getModuleStatement				= mysql_query($getModuleQuery);
	while($getModuleStatementData	= mysql_fetch_array($getModuleStatement)) {
		$LABOURID 				= $getModuleStatementData["LABOURID"];
		$LABOURNAME 			= $getModuleStatementData["LABOURNAME"];
		$module_array[] 			= array('optionValue'=>$LABOURID,'optionDisplay'=>$LABOURNAME);
	}
	echo json_encode($module_array);
?>