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

	$pcId 			= $_REQUEST['pcId'];
	$LABOURID 		= $_REQUEST['LABOURID'];
	$ENTRYDATE 		= showDateMySQlFormat($_REQUEST['ENTRYDATE']);
	$ENTRYDATE2 	= showDateMySQlFormat($_REQUEST['ENTRYDATE2']);
	$module_array 	= array();
	$getModuleQuery	= "
						SELECT 	DISTINCT
								p.PARTYID,
								p.PARTYNAME
						FROM 	
								fna_party p, fna_labourbill l
						WHERE	p.PARTYID = l.PARTYID	
							AND l.LABOURID = ".$LABOURID." 
							AND l.ENTRYDATE BETWEEN '".$ENTRYDATE."' AND '".$ENTRYDATE2."'
						ORDER BY 
								p.PARTYNAME ASC
					 ";
	$getModuleStatement				= mysql_query($getModuleQuery);
	while($getModuleStatementData	= mysql_fetch_array($getModuleStatement)) {
		$PARTYID 				= $getModuleStatementData["PARTYID"];
		$PARTYNAME	 			= $getModuleStatementData["PARTYNAME"];
		$module_array[] 			= array('optionValue'=>$PARTYID,'optionDisplay'=>$PARTYNAME);
	}
	echo json_encode($module_array);
?>