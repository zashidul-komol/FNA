<?php
	include('../config/dbinfo.inc.php');
	$service_id 	= $_REQUEST['service_id'];
	$module_array 	= array();
	$getModuleQuery	= "
						SELECT 	
								MODULE_ID,
								MODULE_NAME
						FROM 	
								s_module_main
						WHERE	
								SERVICE_ID =".$service_id." 
						ORDER BY 
								MODULE_NAME ASC
					 ";
	$getModuleStatement				= mysql_query($getModuleQuery);
	while($getModuleStatementData	= mysql_fetch_array($getModuleStatement)) {
		$module_id 						= $getModuleStatementData["MODULE_ID"];
		$module_name 					= $getModuleStatementData["MODULE_NAME"];
		$module_array[] 				= array('optionValue'=>$module_id,'optionDisplay'=>$module_name);
	}
	echo json_encode($module_array);
?>