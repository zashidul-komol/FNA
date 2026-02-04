<?php
	include('../config/dbinfo.inc.php');
	$PRODUCTID					= $_REQUEST['quantity'];
	$CHID2						= $_REQUEST['CHID2'];
	$FLOORID2 					= $_REQUEST['FLOORID2'];
	$POCKETID		 			= $_REQUEST['POCKETID'];
	$PRODUCTLOADUNLOADBKDNID	= $_REQUEST['PRODUCTLOADUNLOADBKDNID'];
	
	$module_array 	= array();
	$getModuleQuery	= "
						SELECT 	
								 POCKETBALANCE
						FROM 	
								fna_pocketstock 
						WHERE	PRODUCTID =".$PRODUCTID." 
							AND CHID =".$CHID2." 
							AND FLOORID =".$FLOORID2." 
							AND POCKETID =".$POCKETID." 
							AND PRODUCTLOADUNLOADBKDNID = '".$PRODUCTLOADUNLOADBKDNID."'
						
					 "; 
	$getModuleStatement				= mysql_query($getModuleQuery);
	while($getModuleStatementData	= mysql_fetch_array($getModuleStatement)) {
		$POCKETBALANCE	 			= $getModuleStatementData["POCKETBALANCE"];
		
	}
	//$TotLabBill		= $quantity * $TRANSFERPRICE ;
	echo $POCKETBALANCE ;
	//echo  '5';
?>