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
	$PROJECTID 		= $_REQUEST['projectId'];
	$SUBPROJECTID	= $_REQUEST['subProjectId'];
	$ENTRYDATE 		= insertDateMySQlFormat($_REQUEST['ENTRYDATE']);
	
	$sessionIDQuery	= "
						SELECT 	SESSIONID, 
								STARTDATE,
								ENDDATE
							FROM 	
								fna_session 
							WHERE	PROJECTID = '".$PROJECTID."'
								AND SUBPROJECTID = '".$SUBPROJECTID."'
								AND PRODCATTYPEID = '".$pcId."'
								AND '".$ENTRYDATE."' BETWEEN STARTDATE AND ENDDATE
							
					 ";
	$sessionIDQueryStatement				= mysql_query($sessionIDQuery);
	while($sessionIDQueryStatementData		= mysql_fetch_array($sessionIDQueryStatement)) {
		$SESSIONID 							= $sessionIDQueryStatementData["SESSIONID"];
		$STARTDATE 							= $sessionIDQueryStatementData["STARTDATE"];
		$ENDDATE 							= $sessionIDQueryStatementData["ENDDATE"];
		
	}
	
	
	
	$module_array 	= array(); 
	$getModuleQuery	= "
						SELECT 	DISTINCT
								p.PRODUCTID,
								p.PRODUCTNAME
						FROM 	
								fna_product p, fna_bill b
						WHERE	p.PRODUCTID = b.PRODUCTID
								AND b.PRODCATTYPEID = '".$pcId."'
								AND b.ENTRYDATE BETWEEN '".$STARTDATE."' AND '".$ENDDATE."'
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
	/*echo "SELECT 	DISTINCT
								p.PRODUCTID
						FROM 	
								fna_product p, fna_bill b
						WHERE	p.PRODUCTID = b.PRODUCTID
								AND b.PRODCATTYPEID = '".$pcId."'
								AND b.ENTRYDATE BETWEEN '".$STARTDATE."' AND '".$ENDDATE."'
						ORDER BY 
								p.PRODUCTNAME ASC
					 ";*/
	
?>