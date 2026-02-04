<?php
	include('../config/dbinfo.inc.php');
	$PRODUCTLOADUNLOADBKDNID 			= $_REQUEST['pid'];
	$PROJECTID	 						= $_REQUEST['PROJECTID'];
	$SUBPROJECTID 						= $_REQUEST['SUBPROJECTID'];
	$PARTYID	 						= $_REQUEST['PARTYID'];
	$module_array 						= array();
	$getModuleQuery	= "
						SELECT 	
								ps.PRODUCTID,
								p.PRODUCTNAME
						FROM 	
								fna_pocketstock ps, fna_product p
						WHERE	p.PRODUCTID = ps.PRODUCTID
							AND ps.PROJECTID = ".$PROJECTID."
							AND ps.SUBPROJECTID = ".$SUBPROJECTID."
							AND ps.PARTYID = ".$PARTYID."
							AND ps.PRODUCTLOADUNLOADBKDNID =".$PRODUCTLOADUNLOADBKDNID." 
						ORDER BY 
								p.PRODUCTID ASC
					 ";
	$getModuleStatement				= mysql_query($getModuleQuery);
	while($getModuleStatementData	= mysql_fetch_array($getModuleStatement)) {
		$PRODUCTID 						= $getModuleStatementData["PRODUCTID"];
		$PRODUCTNAME 					= $getModuleStatementData["PRODUCTNAME"];
		$module_array[] 				= array('optionValue'=>$PRODUCTID,'optionDisplay'=>$PRODUCTNAME);
	}
	echo json_encode($module_array);
	//echo $pid;
?>