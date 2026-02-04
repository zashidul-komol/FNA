<?php
	include('../config/dbinfo.inc.php');
	$PRODUCTLOADUNLOADBKDNID	= $_REQUEST['pid'];
	$CHID		 				= $_REQUEST['CHID2'];
	$FLOORID	 				= $_REQUEST['FLOORID2'];
	$POCKETID				 	= $_REQUEST['POCKETID'];
	$module_array 				= array();
	$getModuleQuery	= "
						SELECT 	
								p.PRODUCTID,
								p.PRODUCTNAME
						FROM 	
								fna_pocketstock ps, fna_product p
						WHERE	p.PRODUCTID = ps.PRODUCTID
							AND ps.CHID =".$CHID." 
							AND ps.FLOORID =".$FLOORID." 
							AND ps.POCKETID =".$POCKETID." 
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