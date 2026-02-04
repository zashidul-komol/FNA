<?php
	include('../config/dbinfo.inc.php');
	$pcId 	= $_REQUEST['pcId'];
	$module_array 	= array();
	$getModuleQuery	= "
						SELECT 	
								ACCOUNTNO
						FROM 	
								fna_bankaccount 
						WHERE	
								BRANCHID =".$pcId." 
						ORDER BY 
								ACCOUNTNO ASC
					 ";
	$getModuleStatement				= mysql_query($getModuleQuery);
	while($getModuleStatementData	= mysql_fetch_array($getModuleStatement)) {
		$ACCOUNTNO	 				= $getModuleStatementData["ACCOUNTNO"];
		$module_array[] 			= array('optionValue'=>$ACCOUNTNO,'optionDisplay'=>$ACCOUNTNO);
	}
	echo json_encode($module_array);
?>