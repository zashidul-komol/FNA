<?php
	include('../config/dbinfo.inc.php');
	$PRODUCTLOADUNLOADBKDNID		= $_REQUEST['pid'];
	$PROJECTID 						= $_REQUEST['PROJECTID'];
	$SUBPROJECTID		 			= $_REQUEST['SUBPROJECTID'];
	$PARTYID		 				= $_REQUEST['PARTYID'];
	$PRODUCTID						= $_REQUEST['PRODUCTID'];
	
	$module_array 	= array();
	$getModuleQuery	= "
						SELECT 	
								 POCKETBALANCE
						FROM 	
								fna_pocketstock ps, fna_productloadunload pl, fna_productloadunloadbkdn bkdn
						WHERE	pl.PRODUCTLOADUNLOADID = bkdn.PRODUCTLOADUNLOADID
						AND 	bkdn.PRODUCTLOADUNLOADBKDNID = ps.PRODUCTLOADUNLOADBKDNID
						AND 	ps.PROJECTID = ".$PROJECTID."
						AND 	ps.SUBPROJECTID =".$SUBPROJECTID." 
						AND 	ps.PARTYID =".$PARTYID."
						AND 	ps.PRODUCTID =".$PRODUCTID." 
						AND 	ps.PRODUCTLOADUNLOADBKDNID =".$PRODUCTLOADUNLOADBKDNID." 
						
					 "; 
	$getModuleStatement				= mysql_query($getModuleQuery);
	$POCKETBALANCE = '';
	while($getModuleStatementData	= mysql_fetch_array($getModuleStatement)) {
		$POCKETBALANCE	 			= $getModuleStatementData["POCKETBALANCE"];
		
	}
	//$TotLabBill		= $quantity * $TRANSFERPRICE ;
	echo $POCKETBALANCE ;
	//echo  '5';
?>