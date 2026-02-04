<?php
	include('../config/dbinfo.inc.php');
	function showDateMySQlFormat($date){
	
		$exp = explode("-",$date);				
		$mysqlDateF = $exp[2]."-".$exp[1]."-".$exp[0];
		
		return $mysqlDateF;
}
	$pcId 	= $_REQUEST['pcId'];
	
	//$ProjectID		=$_REQUEST['projectId'];
	//$SubProjectID	=$_REQUEST['subProjectId'];
	$EntryDate		= showDateMySQlFormat($_REQUEST['ENTRYDATE']);
	
	$module_array 	= array();
	$getModuleQuery	= "
						SELECT 	DISTINCT
								p.PRODUCTID,
								p.PRODUCTNAME
						FROM 	
								fna_product p, fna_productfare pf
						WHERE	p.PRODUCTID = pf.PRODUCTID
								AND pf.PRODCATTYPEID ='".$pcId."'
								AND '".$EntryDate."' BETWEEN pf.STARTDATE  AND pf.ENDDATE
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
	
?>