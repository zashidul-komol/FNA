<?php
	include('../config/dbinfo.inc.php');
	$FloorId 	= $_REQUEST['pcId'];
	//$CHID	 	= $_REQUEST['CHID2'];
	$module_array 	= array();
	$getModuleQuery	= "
						SELECT 	
								POCKETID,
								POCKETNAME
						FROM 	
								fna_pocket 
						WHERE	
								FLOORID = '".$FloorId."'
						ORDER BY 
								POCKETID ASC
					 ";
	$getModuleStatement				= mysql_query($getModuleQuery);
	while($getModuleStatementData	= mysql_fetch_array($getModuleStatement)) {
		$POCKETID	 				= $getModuleStatementData["POCKETID"];
		$POCKETNAME		 			= $getModuleStatementData["POCKETNAME"];
		$module_array[] 			= array('optionValue'=>$POCKETID,'optionDisplay'=>$POCKETNAME);
	}
	echo json_encode($module_array);
	//echo $FloorId;
?>