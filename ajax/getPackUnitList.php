<?php
	include('../config/dbinfo.inc.php');
	
function showDateMySQlFormat($date){
	
		$exp = explode("-",$date);				
		$mysqlDateF = $exp[2]."-".$exp[1]."-".$exp[0];
		
		return $mysqlDateF;
}

	$chId 			= $_REQUEST['pcId'];
	$projectId 		= $_REQUEST['projectId'];
	$subProjectId 	= $_REQUEST['subProjectId'];
	$labourId 		= $_REQUEST['labourId'];
	$entryDate2		= showDateMySQlFormat($_REQUEST['ENTRYDATE']);
	//$entryDate2		= $_REQUEST['ENTRYDATE'];
	$module_array 	= array();
	
	$getModuleQuery	= "
						SELECT 	
								 DISTINCT lc_bkdn.PACKINGUNITID,
								pu.PACKINGNAMEID,
								pu.QID,
								pu.WTID
						FROM 	
								fna_labourcontact lc, fna_labourcontact_bkdn lc_bkdn, fna_packingunit pu
						WHERE	lc.LABCONTACTID = lc_bkdn.LABCONTACTID
						AND     lc_bkdn.PACKINGUNITID = pu.PACKINGUNITID
						AND 	lc.LABOURID =".$labourId." 
						AND 	lc.PROJECTID =".$projectId." 
						AND		lc.STATUS = 'Active'
						AND 	'".$entryDate2."' BETWEEN lc.STARTDATE AND lc.ENDDATE
						ORDER BY 
								lc_bkdn.PACKINGUNITID ASC
					 "; 
					 
	$getModuleStatement				= mysql_query($getModuleQuery);
	while($getModuleStatementData	= mysql_fetch_array($getModuleStatement)) {
		$PACKINGUNITID 			= $getModuleStatementData["PACKINGUNITID"];
		$PACKINGNAMEID 			= $getModuleStatementData["PACKINGNAMEID"];
		$QID 					= $getModuleStatementData["QID"];
		$WTID 					= $getModuleStatementData["WTID"];
		
		
		$packingNameQuery = "
									SELECT
											PACKINGNAMEID,
											PACKINGNAME
									FROM
											fna_packingname 
											WHERE PACKINGNAMEID = {$PACKINGNAMEID}
									";
				$packingNameQueryStatement				= mysql_query($packingNameQuery);
				while($packingNameQueryStatementData	= mysql_fetch_array($packingNameQueryStatement)) {
					$PACKINGNAMEID_NEW   		= $packingNameQueryStatementData["PACKINGNAMEID"];
					$PACKINGNAME_NEW   			= $packingNameQueryStatementData["PACKINGNAME"];
					
				}
				
				$QidQuery = "
									SELECT
											QVALUE
									FROM
											fna_quantity 
											WHERE QID = {$QID}
									";
				$QidQueryStatement				= mysql_query($QidQuery);
				while($QidQueryStatementData	= mysql_fetch_array($QidQueryStatement)) {
					$QVALUE   		= $QidQueryStatementData["QVALUE"];
					
				}
				
				$wtidQuery = "
									SELECT
											WNAME
									FROM
											fna_weight 
											WHERE WTID = {$WTID}
									";
				$wtidQueryStatement				= mysql_query($wtidQuery);
				while($wtidQueryStatementData	= mysql_fetch_array($wtidQueryStatement)) {
					$WNAME   		= $wtidQueryStatementData["WNAME"];
					
				}
		
		
				$packingUnitList  = $PACKINGNAME_NEW.", ".$QVALUE.",".$WNAME;
		
		
		$module_array[] 				= array('optionValue'=>$PACKINGUNITID,'optionDisplay'=>$packingUnitList);
	}
	//echo $queryCheck;
	echo json_encode($module_array);
?>