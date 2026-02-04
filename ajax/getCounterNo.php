<?php
	include('../config/dbinfo.inc.php');
	$POCKETID				 	= $_REQUEST['pcId'];
	$CHID	 					= $_REQUEST['CHID2'];
	$FLOORID	 				= $_REQUEST['FLOORID2'];
	$module_array 				= array();
	$getModuleQuery	= "
						SELECT 	
								PRODUCTLOADUNLOADBKDNID
						FROM 	
								fna_pocketstock 
						WHERE	CHID = '".$CHID."'
							AND	FLOORID = '".$FLOORID."'
							AND POCKETID = '".$POCKETID."'
							AND POCKETBALANCE > 0
						ORDER BY 
								PRODUCTLOADUNLOADBKDNID ASC
					 ";
	$getModuleStatement				= mysql_query($getModuleQuery);
	while($getModuleStatementData	= mysql_fetch_array($getModuleStatement)) {
		$PRODUCTLOADUNLOADBKDNID	= $getModuleStatementData["PRODUCTLOADUNLOADBKDNID"];
		$module_array[] 			= array('optionValue'=>$PRODUCTLOADUNLOADBKDNID,'optionDisplay'=>$PRODUCTLOADUNLOADBKDNID);
	}
	echo json_encode($module_array);
	//echo $FLOORID;
?>