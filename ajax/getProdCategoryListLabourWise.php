<?php
	include('../config/dbinfo.inc.php');
	
	function showDateMySQlFormat($date){
	
		$exp = explode("-",$date);				
		$mysqlDateF = $exp[2]."-".$exp[1]."-".$exp[0];
		
		return $mysqlDateF;
}
function insertDateMySQlFormat($date){
	
		$exp = explode("-",$date);				
		$mysqlDateFormate = $exp[2]."-".$exp[1]."-".$exp[0];
		
		return $mysqlDateFormate;
		
}

	$partyId 	= $_REQUEST['pcId'];
	$LABOURID 	= $_REQUEST['LABOURID'];
	$ENTRYDATE 	= showDateMySQlFormat($_REQUEST['ENTRYDATE']);
	$ENTRYDATE2	= showDateMySQlFormat($_REQUEST['ENTRYDATE2']);
	$module_array 	= array();
	$getModuleQuery	= "
						SELECT 	DISTINCT
								pc.PRODCATTYPEID,
								pc.CATEGORYTYPENAME
						FROM 	
								fna_productcattype pc, fna_productloadunload lu, fna_productloadunloadbkdn bkdn 
						WHERE	pc.PRODCATTYPEID = bkdn.PRODCATTYPEID
							AND	lu.PRODUCTLOADUNLOADID = bkdn.PRODUCTLOADUNLOADID
							AND	lu.PARTYID =".$partyId." 
							AND	lu.LABOURID =".$LABOURID." 
							AND lu.ENTRYDATE BETWEEN '".$ENTRYDATE."' AND '".$ENTRYDATE2."'
							AND pc.STATUS = 'Active'
						ORDER BY 
								pc.CATEGORYTYPENAME ASC
					 ";
	$getModuleStatement				= mysql_query($getModuleQuery);
	while($getModuleStatementData	= mysql_fetch_array($getModuleStatement)) {
		$PRODCATTYPEID 				= $getModuleStatementData["PRODCATTYPEID"];
		$CATEGORYTYPENAME 			= $getModuleStatementData["CATEGORYTYPENAME"];
		$module_array[] 			= array('optionValue'=>$PRODCATTYPEID,'optionDisplay'=>$CATEGORYTYPENAME);
	}
	echo json_encode($module_array);
?>