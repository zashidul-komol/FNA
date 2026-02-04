<?php
	include('../config/dbinfo.inc.php');
	
	function showDateMySQlFormat($date){
	
		$exp = explode("-",$date);				
		$mysqlDateF = $exp[2]."-".$exp[1]."-".$exp[0];
		
		return $mysqlDateF;
}

	$LotNo 			= $_REQUEST['LotNo'];
	$PROJECTID 		= $_REQUEST['PROJECTID'];
	$SUBPROJECTID 	= $_REQUEST['SUBPROJECTID'];
	$ENTRYDATE 		= showDateMySQlFormat($_REQUEST['ENTRYDATE']);
	$module_array 	= array();
	
	
	$MaxSessionYear_Qry	= mysql_fetch_array(mysql_query("SELECT MAX(SESSIONYEARID) FROM fna_session WHERE PROJECTID = '".$PROJECTID."' AND SUBPROJECTID = '".$SUBPROJECTID."'"));
	$NowMaxSessionYearId = $MaxSessionYear_Qry['MAX(SESSIONYEARID)'];
	$Session_Qry	= "
						SELECT 	
								STARTDATE,
								ENDDATE
						FROM 	
								fna_session 
						WHERE	PROJECTID =".$PROJECTID." 
							AND SUBPROJECTID =".$SUBPROJECTID."
							AND SESSIONYEARID =".$NowMaxSessionYearId."
					 ";
	$Session_QryStatement				= mysql_query($Session_Qry);
	while($Session_QryStatementData	= mysql_fetch_array($Session_QryStatement)) {
		$SESSION_STARTDATE				= $Session_QryStatementData["STARTDATE"];
		$SESSION_ENDDATE 				= $Session_QryStatementData["ENDDATE"];
	}
	
	
	$LotNoQry			= mysql_fetch_array(mysql_query("SELECT PARTYID, MAX(LOTFLAG) FROM fna_alustock WHERE LOTNO = '".$LotNo."' AND PROJECTID = '".$PROJECTID."' AND SUBPROJECTID = '".$SUBPROJECTID."' AND ENTRYDATE BETWEEN '".$SESSION_STARTDATE."' AND '".$SESSION_ENDDATE."'"));
	$NowMaxLotFlag		= $LotNoQry['MAX(LOTFLAG)'];
	$PARTYID			= $LotNoQry['PARTYID'];
	
	//echo "SELECT PARTYID, MAX(LOTFLAG) FROM fna_alustock WHERE LOTNO = '".$LotNo."' AND PROJECTID = '".$PROJECTID."' AND SUBPROJECTID = '".$SUBPROJECTID."' AND ENTRYDATE BETWEEN '".$SESSION_STARTDATE."' AND '".$SESSION_ENDDATE."'";
	$getModuleQuery	= "
						SELECT 	
								PARTYNAME,
								FATHERNAME,
								ADDRESS,
								MOBILE
						FROM 	
								fna_party 
						WHERE	
								PARTYID =".$PARTYID." 
					 ";
	$getModuleStatement				= mysql_query($getModuleQuery);
	while($getModuleStatementData	= mysql_fetch_array($getModuleStatement)) {
		$PARTYNAME 						= $getModuleStatementData["PARTYNAME"];
		$FATHERNAME 					= $getModuleStatementData["FATHERNAME"];
		$ADDRESS 					= $getModuleStatementData["ADDRESS"];
		$MOBILE 					= $getModuleStatementData["MOBILE"];
		$module_array[] 				= array('PARTYNAME'=>$PARTYNAME,'FATHERNAME'=>$FATHERNAME,'ADDRESS'=>$ADDRESS,'MOBILE'=>$MOBILE);
	}
	echo json_encode($module_array);
	
?>