<?php
	include('../config/dbinfo.inc.php');
	$pcId 	= $_REQUEST['pcId'];
	$module_array 	= array();
	$getModuleQuery	= "
						SELECT 	
								p.PRODUCTID,
								p.PRODUCTNAME,
								f.FOODID,
								f.FOODNAME
						FROM 	
								fna_product  p, feed_fooditem f
						WHERE	
								PRODCATTYPEID =".$pcId." 
							AND p.PRODUCTNAME = f.FOODNAME	
						ORDER BY 
								p.PRODUCTNAME ASC
					 ";
	$getModuleStatement				= mysql_query($getModuleQuery);
	while($getModuleStatementData	= mysql_fetch_array($getModuleStatement)) {
		$PRODUCTID 						= $getModuleStatementData["PRODUCTID"];
		$PRODUCTNAME 					= $getModuleStatementData["PRODUCTNAME"];
		$module_array[] 				= array('optionValue'=>$PRODUCTID,'optionDisplay'=>$PRODUCTNAME);
	}
	echo json_encode($module_array);
?>