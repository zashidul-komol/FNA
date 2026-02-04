<?php
	include('../config/dbinfo.inc.php');
	$quantity		= $_REQUEST['quantity'];
	$LABOURID 		= $_REQUEST['LABOURID'];
	$CHID		 	= $_REQUEST['CHID'];
	$CHID2		 	= $_REQUEST['CHID2'];
	$packingUnit	= $_REQUEST['packingUnit'];
	
	$module_array 	= array();
	$getModuleQuery	= "
						SELECT 	
								 DISTINCT lc_bkdn.TRANSFERPRICE
						FROM 	
								fna_labourcontact lc, fna_labourcontact_bkdn lc_bkdn
						WHERE	lc.LABCONTACTID = lc_bkdn.LABCONTACTID
						AND 	lc.LABOURID =".$LABOURID." 
						AND 	lc_bkdn.PACKINGUNITID =".$packingUnit."
						AND 	lc_bkdn.CHAMBERIDFROM =".$CHID." 
						AND 	lc_bkdn.CHAMBERIDTO =".$CHID2." 
						ORDER BY 
								lc_bkdn.PACKINGUNITID ASC
					 "; 
	$getModuleStatement				= mysql_query($getModuleQuery);
	while($getModuleStatementData	= mysql_fetch_array($getModuleStatement)) {
		$TRANSFERPRICE	 			= $getModuleStatementData["TRANSFERPRICE"];
		
	}
	$TotLabBill		= $quantity * $TRANSFERPRICE ;
	echo $TRANSFERPRICE. " = " .$TotLabBill;
	//echo  '5';
?>