<?php
	include('../config/dbinfo.inc.php');
	$PROJECTID 		= $_REQUEST['PROJECTID'];
	$SUBPROJECTID 	= $_REQUEST['SUBPROJECTID'];
	$PRODCATTYPEID 	= $_REQUEST['PRODCATTYPEID'];
	$SESSIONYEARID 	= $_REQUEST['SessionYear'];
	
	$module_array 	= array();
	$getModuleQuery	= "
						SELECT 	STARTDATE
								FROM 	
								fna_session 
						WHERE	PROJECTID = '".$PROJECTID."'
						AND SUBPROJECTID = '".$SUBPROJECTID."'
						AND PRODCATTYPEID = '".$PRODCATTYPEID."'
						AND	SESSIONYEARID = '".$SESSIONYEARID."' 
								
						ORDER BY 
								STARTDATE ASC
					 ";
	$getModuleStatement				= mysql_query($getModuleQuery);
	while($getModuleStatementData	= mysql_fetch_array($getModuleStatement)) {
		$STARTDATE 						= $getModuleStatementData["STARTDATE"];
	}
	//echo json_encode($module_array);
	echo $STARTDATE ;
?>