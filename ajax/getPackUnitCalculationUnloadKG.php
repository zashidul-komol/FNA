<?php
	include('../config/dbinfo.inc.php');
	$quantity			= $_REQUEST['quantity'];
	$PRODUCTID 			= $_REQUEST['PRODUCTID'];
	$PARTYID		 	= $_REQUEST['PARTYID'];
	$packingUnit		= $_REQUEST['packingUnit'];
	$PRODCATTYPEID		= $_REQUEST['PRODCATTYPEID'];
	
	$module_array 	= array();
	
	$partyFlag 				= mysql_fetch_array(mysql_query("SELECT MAX(IFNULL(PARTYFLAG,0)) FROM fna_productstock WHERE PARTYID = '".$PARTYID."'"));
								$MAXpartyFlag = $partyFlag['MAX(IFNULL(PARTYFLAG,0))'];
	$prodCatTypeFlag 		= mysql_fetch_array(mysql_query("SELECT MAX(IFNULL(PRODCATTYPEFLAG,0)) FROM fna_productstock WHERE PARTYID = '".$PARTYID."' AND PRODCATTYPEID = '".$PRODCATTYPEID."'"));
								$MAXprodCatTypeFlag = $prodCatTypeFlag['MAX(IFNULL(PRODCATTYPEFLAG,0))'];
	$prodTypeFlag 			= mysql_fetch_array(mysql_query("SELECT MAX(PRODTYPEFLAG) FROM fna_productstock WHERE PARTYID = '".$PARTYID."' AND PRODUCTID = '".$PRODUCTID."'"));
										
								$MAXprodTypeFlag = $prodTypeFlag['MAX(PRODTYPEFLAG)'];
								
	$prodQnty 				= mysql_fetch_array(mysql_query("SELECT AVGUNIT FROM fna_productstock WHERE PARTYID = '".$PARTYID."' AND PRODUCTID = '".$PRODUCTID."' AND PRODTYPEFLAG = '".$MAXprodTypeFlag."'"));
							$AVGUNIT	 	= $prodQnty['AVGUNIT'] ;
								
								
	$Quantity_KG		= $AVGUNIT * $quantity ; 
								
	
	echo number_format($Quantity_KG,2);
	//echo  '5';
?>