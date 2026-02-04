<?php
	include('../config/dbinfo.inc.php');
	$pcId 	= $_REQUEST['pcId'];
	$module_array 	= array();
	$getModuleQuery	= "
						SELECT 	
								PRODUCTID,
								PRODUCTNAME
						FROM 	
								fna_product 
						WHERE	
								PRODCATTYPEID =".$pcId." 
						ORDER BY 
								PRODUCTNAME ASC
					 ";
	$getModuleStatement				= mysql_query($getModuleQuery);
	while($getModuleStatementData	= mysql_fetch_array($getModuleStatement)) {
		$PRODUCTID 						= $getModuleStatementData["PRODUCTID"];
		$PRODUCTNAME 					= $getModuleStatementData["PRODUCTNAME"];
		$module_array[] 				= array('optionValue'=>$PRODUCTID,'optionDisplay'=>$PRODUCTNAME);
	}
	echo json_encode($module_array);
?>