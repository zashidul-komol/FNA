<?php
	include('../config/dbinfo.inc.php');
	$agency_id 	= $_REQUEST['agency_id'];
	$module_array 	= array();
	$agencyNameSql	= "
						SELECT 	
								aFName
						FROM 	
								adbs_agency 
						WHERE	
								aId =".$agency_id." 
						ORDER BY 
								aFName ASC
					 ";
	$agencyNameSqlStatement			= mysql_query($agencyNameSql);
	$agencyNameSqlStatementData		= mysql_fetch_array($agencyNameSqlStatement);
	$aFName 						= $agencyNameSqlStatementData["aFName"];
		
	echo $aFName;
?>