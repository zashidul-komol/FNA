<?php
	include('../config/dbinfo.inc.php');
	$DONO 			= $_REQUEST['NEWDONO'];
	//$LotNo 			= $_REQUEST['LotNo'];
	$PROJECTID		= $_REQUEST['PROJECTID'];
	$SUBPROJECTID 	= $_REQUEST['SUBPROJECTID'];
	$module_array 	= array();
	
	$LotNoQry			= mysql_fetch_array(mysql_query("SELECT LOTNO, PARTYID FROM fna_productloadunload WHERE PROJECTID = '".$PROJECTID."' AND SUBPROJECTID = '".$SUBPROJECTID."' AND DONO = '".$DONO."' AND ENTRYDATE >='2022-01-01'"));
	$LotNo				= $LotNoQry['LOTNO'];
	$PARTYID			= $LotNoQry['PARTYID'];
	
	
	$getModuleQuery	= "
						SELECT 	
								p.PARTYNAME,
								p.FATHERNAME,
								p.ADDRESS,
								p.MOBILE,
								plu.LOTNO
						FROM 	
								fna_party p,  fna_productloadunload plu
						WHERE	p.PARTYID = plu.PARTYID	
								AND plu.DONO = '".$DONO."'
								AND p.PARTYID =".$PARTYID." 
					 ";
	$getModuleStatement				= mysql_query($getModuleQuery);
	while($getModuleStatementData	= mysql_fetch_array($getModuleStatement)) {
		$PARTYNAME 					= $getModuleStatementData["PARTYNAME"];
		$FATHERNAME 				= $getModuleStatementData["FATHERNAME"];
		$ADDRESS 					= $getModuleStatementData["ADDRESS"];
		$MOBILE 					= $getModuleStatementData["MOBILE"];
		$LOTNO	 					= $getModuleStatementData["LOTNO"];
		$module_array[] 			= array('PARTYNAME'=>$PARTYNAME,'FATHERNAME'=>$FATHERNAME,'ADDRESS'=>$ADDRESS,'MOBILE'=>$MOBILE,'LOTNO'=>$LOTNO);
	}
	echo json_encode($module_array);
?>