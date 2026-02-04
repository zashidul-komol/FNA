<?php
	include('../config/dbinfo.inc.php');
	$chid 	= $_REQUEST['pcId'];
	$module_array 	= array();
	$getModuleQuery	= "
						SELECT 	
								FLOORID,
								FLOORNAME
						FROM 	
								fna_floor 
						WHERE	
								CHID =".$chid." 
						ORDER BY 
								FLOORNAME ASC
					 ";
	$getModuleStatement				= mysql_query($getModuleQuery);
	while($getModuleStatementData	= mysql_fetch_array($getModuleStatement)) {
		$FLOORID	 				= $getModuleStatementData["FLOORID"];
		$FLOORNAME		 			= $getModuleStatementData["FLOORNAME"];
		$module_array[] 			= array('optionValue'=>$FLOORID,'optionDisplay'=>$FLOORNAME);
	}
	echo json_encode($module_array);
?>