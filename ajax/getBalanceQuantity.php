<?php
	include('../config/dbinfo.inc.php');
    $productId		= $_REQUEST['productId'];
	
	$module_array 	= array();
	
	$ProdQuery			= mysql_fetch_array(mysql_query("SELECT MAX(PRODFLAG) FROM feed_rawmatstock WHERE PRODUCTID = '".$productId."'"));
	$MAXProdFlag 		= $ProdQuery['MAX(PRODFLAG)'];
	$getModuleQuery	= "
						SELECT 	
								 TOTQNTY
						FROM 	
								feed_rawmatstock 
						WHERE PRODUCTID = '".$productId."'
						AND PRODFLAG = '".$MAXProdFlag."'
						ORDER BY 
								PRODUCTID ASC
					 "; 
	$getModuleStatement				= mysql_query($getModuleQuery);
	while($getModuleStatementData	= mysql_fetch_array($getModuleStatement)) {
		$TOTQNTY		 			= $getModuleStatementData["TOTQNTY"];
		
	}
	echo $TOTQNTY;
	//echo  '5';
?>