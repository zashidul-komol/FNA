<?php
	include('../config/dbinfo.inc.php');
	$quantity		= $_REQUEST['quantity'];
	$LABOURID 		= $_REQUEST['LABOURID'];
	$CHID		 	= $_REQUEST['CHID'];
	$packingUnit	= $_REQUEST['packingUnit'];
	
	$module_array 	= array();
	$getModuleQuery	= "
						SELECT 	
								 DISTINCT lc_bkdn.PALOTPRICE
						FROM 	
								fna_labourcontact lc, fna_labourcontact_bkdn lc_bkdn
						WHERE	lc.LABCONTACTID = lc_bkdn.LABCONTACTID
						AND 	lc.LABOURID =".$LABOURID." 
						AND 	lc_bkdn.PACKINGUNITID =".$packingUnit."
						AND 	lc_bkdn.CHAMBERIDTO =".$CHID." 
						ORDER BY 
								lc_bkdn.PACKINGUNITID ASC
					 "; 
	$getModuleStatement				= mysql_query($getModuleQuery);
	while($getModuleStatementData	= mysql_fetch_array($getModuleStatement)) {
		$PALOTPRICE		 			= $getModuleStatementData["PALOTPRICE"];
		
	}
	$TotLabBill		= $quantity * $PALOTPRICE ;
	echo $PALOTPRICE. " = " .$TotLabBill;
	//echo  '5';
?>