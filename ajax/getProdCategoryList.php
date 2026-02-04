<?php
	include('../config/dbinfo.inc.php');
	$pcId 	= $_REQUEST['pcId'];
	$module_array 	= array();
	$getModuleQuery	= "
						SELECT 	
								PRODCATTYPEID,
								CATEGORYTYPENAME
						FROM 	
								fna_productcattype 
						WHERE	
								SUBPROJECTID =".$pcId." 
							AND STATUS = 'Active'
						ORDER BY 
								CATEGORYTYPENAME ASC
					 ";
	$getModuleStatement				= mysql_query($getModuleQuery);
	while($getModuleStatementData	= mysql_fetch_array($getModuleStatement)) {
		$PRODCATTYPEID 				= $getModuleStatementData["PRODCATTYPEID"];
		$CATEGORYTYPENAME 			= $getModuleStatementData["CATEGORYTYPENAME"];
		$module_array[] 			= array('optionValue'=>$PRODCATTYPEID,'optionDisplay'=>$CATEGORYTYPENAME);
	}
	echo json_encode($module_array);
?>