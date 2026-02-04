<?php
	include('../config/dbinfo.inc.php');
	$pcId 	= $_REQUEST['pcId'];
	$module_array 	= array();
	$getModuleQuery	= "
						SELECT 	DISTINCT
								p.PRODUCTID,
								p.PRODUCTNAME
						FROM 	
								fna_product p, fna_productfare pf
						WHERE	p.PRODUCTID = pf.PRODUCTID
								AND pf.PRODCATTYPEID ='".$pcId."'
								AND p.STATUS = 'Active'
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
	//echo $pcId;
	
?>