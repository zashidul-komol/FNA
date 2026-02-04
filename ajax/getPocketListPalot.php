<?php
	include('../config/dbinfo.inc.php');
	$CHID 				= $_REQUEST['CHID2'];
	$FLOORID			= $_REQUEST['pcId'];
	//$ENTRYSERIALNOID	 	= $_REQUEST['ENTRYSERIALNOID'];
	$module_array 	= array();
	$getModuleQuery	= "
						SELECT 	
								POCKETID,
								POCKETNAME
						FROM 	
								fna_pocket
						WHERE	CHID = '".$CHID."'
							AND FLOORID = '".$FLOORID."'
						ORDER BY 
								POCKETNAME ASC
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