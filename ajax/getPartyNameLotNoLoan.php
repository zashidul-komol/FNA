<?php
	include('../config/dbinfo.inc.php');
	$LOANID			= $_REQUEST['LOANID'];
	$PROJECTID		= $_REQUEST['PROJECTID'];
	$SUBPROJECTID 	= $_REQUEST['SUBPROJECTID'];
	$module_array 	= array();
	
	$LoanNoQry			= mysql_fetch_array(mysql_query("SELECT PARTYID FROM fna_loan WHERE PROJECTID = '".$PROJECTID."' AND SUBPROJECTID = '".$SUBPROJECTID."' AND LOANID = '".$LOANID."'"));
	//echo "SELECT PARTYID FROM fna_loan WHERE PROJECTID = '".$PROJECTID."' AND SUBPROJECTID = '".$SUBPROJECTID."' AND LOANID = '".$LOANID."'";
	$PARTYID			= $LotNoQry['PARTYID'];
	
	
	$getModuleQuery	= "
						SELECT 	
								p.PARTYNAME,
								p.FATHERNAME,
								p.ADDRESS,
								p.MOBILE
						FROM 	
								fna_party p
						WHERE	p.PARTYID =".$PARTYID." 
					 ";
	$getModuleStatement				= mysql_query($getModuleQuery);
	while($getModuleStatementData	= mysql_fetch_array($getModuleStatement)) {
		$PARTYNAME 					= $getModuleStatementData["PARTYNAME"];
		$FATHERNAME 				= $getModuleStatementData["FATHERNAME"];
		$ADDRESS 					= $getModuleStatementData["ADDRESS"];
		$MOBILE 					= $getModuleStatementData["MOBILE"];
		$module_array[] 			= array('PARTYNAME'=>$PARTYNAME,'FATHERNAME'=>$FATHERNAME,'ADDRESS'=>$ADDRESS,'MOBILE'=>$MOBILE);
	}
	echo json_encode($module_array);
	//echo $LOANID;
?>