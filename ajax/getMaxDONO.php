<?php
	include('../config/dbinfo.inc.php');
	$pcId 	= $_REQUEST['pcId'];
	$module_array 	= array();
	$getModuleQuery	= "
						SELECT 	
								MAX(DONO)
						FROM 	
								fna_productloadunload 
						WHERE	SUBPROJECTID =".$pcId." 
							AND ENTRYDATE > '2022-01-01'
						ORDER BY 
								DONO ASC
					 ";
	$getModuleStatement				= mysql_query($getModuleQuery);
	while($getModuleStatementData	= mysql_fetch_array($getModuleStatement)) {
		$DONO		 				= $getModuleStatementData["MAX(DONO)"];
		$module_array[] 			= array('optionValue'=>$DONO,'optionDisplay'=>$DONO);
	}
	
	$NowDONo						= $DONO + 1;
	echo $NowDONo ; 
	//echo json_encode($module_array);
?>