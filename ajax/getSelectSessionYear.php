<?php
	include('../config/dbinfo.inc.php');
	$PROJECTID 		= $_REQUEST['PROJECTID'];
	$SUBPROJECTID 	= $_REQUEST['SUBPROJECTID'];
	$PRODCATTYPEID 	= $_REQUEST['ProdCatId'];
	
	$module_array 	= array();
	$getModuleQuery	= "
						SELECT 	SESSIONYEARID,
								SESSIONYEAR
							FROM 	
								fna_session 
						WHERE	PROJECTID = '".$PROJECTID."'
						AND SUBPROJECTID = '".$SUBPROJECTID."'
						AND PRODCATTYPEID = '".$PRODCATTYPEID."'
							
						ORDER BY 
								SESSIONYEAR ASC
					 ";
	$getModuleStatement				= mysql_query($getModuleQuery);
	while($getModuleStatementData	= mysql_fetch_array($getModuleStatement)) {
		$SESSIONYEARID				= $getModuleStatementData["SESSIONYEARID"];
		$SESSIONYEAR				= $getModuleStatementData["SESSIONYEAR"];
		$module_array[] 			= array('optionValue'=>$SESSIONYEARID,'optionDisplay'=>$SESSIONYEAR);
	}
	echo json_encode($module_array);
	//echo $STARTDATE ;
?>