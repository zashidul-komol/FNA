<?php
	include('../config/dbinfo.inc.php');
	$PRODUCTLOADUNLOADBKDNID 	= $_REQUEST['pcId'];
	$CHID	 					= $_REQUEST['CHID2'];
	$FLOORID	 				= $_REQUEST['FLOORID2'];
	$module_array 				= array();
	$getModuleQuery	= "
						SELECT 	
								p.POCKETID,
								p.POCKETNAME
						FROM 	
								fna_pocket p, fna_pocketstock ps 
						WHERE	ps.POCKETID = p.POCKETID
							AND ps.PRODUCTLOADUNLOADBKDNID = '".$PRODUCTLOADUNLOADBKDNID."'
							AND	ps.CHID = '".$CHID."'
							AND ps.FLOORID = '".$FLOORID."'
						ORDER BY 
								p.POCKETID ASC
					 ";
	$getModuleStatement				= mysql_query($getModuleQuery);
	while($getModuleStatementData	= mysql_fetch_array($getModuleStatement)) {
		$POCKETID	 				= $getModuleStatementData["POCKETID"];
		$POCKETNAME		 			= $getModuleStatementData["POCKETNAME"];
		$module_array[] 			= array('optionValue'=>$POCKETID,'optionDisplay'=>$POCKETNAME);
	}
	echo json_encode($module_array);
	//echo $FLOORID;
?>