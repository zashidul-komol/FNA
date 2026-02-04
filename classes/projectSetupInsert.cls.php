<?php
	class ProjectSetupInsert Extends BaseClass {
		function ProjectSetupInsert() {
			$this->con=$this->BaseClass();
		}
		
		//Insert Services Start
		function insertServices() {
			$service 			= (isset($_REQUEST["service"])) ? $_REQUEST["service"]:'';
			$order 				= (isset($_REQUEST["serviceOrder"])) ? $_REQUEST["serviceOrder"]:'';
			$description 		= (isset($_REQUEST["serviceDescription"])) ? $_REQUEST["serviceDescription"]:'';
			
			$service 			= addslashes($service);
			$order 				= addslashes($order);
			$description 		= addslashes($description);
			
			$serviceQuery		= "
									SELECT 
											SERVICE_NAME 
									FROM 
											s_service_main 
									WHERE 
											LOWER(SERVICE_NAME) = '".strtolower($service)."'
								  ";
			$serviceStatement	= mysql_query($serviceQuery);
			if(mysql_num_rows($serviceStatement)>0) {
				$msg = "<span class='errorMsg'>Sorry, service name [ $service ] already exist!</span>";
			} else {
				$insertServiceQuery = "
										INSERT INTO 
													s_service_main
																(
																	SERVICE_NAME,
																	DESCRIPTION,
																	ORDER_NO
																) 
														VALUES
																(
																	'".$service."',
																	'".$description."',
																	'".$order."'
																)
									";
				$insertServiceStatement = mysql_query($insertServiceQuery);
				if($insertServiceStatement){
					$msg = "<span class='validMsg'>Service name [ $service ] added sucessfully</span>";
				} else {
					$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
				}
			}
			return $msg;
		}
		//Insert Services End
		
		//Insert Module Start
		function insertModule() {
			$module 			= (isset($_REQUEST["moduleName"])) ? $_REQUEST["moduleName"]:'';
			$moduleOrder 		= (isset($_REQUEST["modOrder"])) ? $_REQUEST["modOrder"]:'';
			$description 		= (isset($_REQUEST["moduleDescription"])) ? $_REQUEST["moduleDescription"]:'';

			$serviceModule 		= (isset($_REQUEST["serviceModule"])) ? $_REQUEST["serviceModule"]:'';
			$module 			= addslashes($module);
			$moduleOrder 		= addslashes($moduleOrder);
			$description 		= addslashes($description);
	
			$moduleQuery		= "
									SELECT 
											MODULE_NAME 
									FROM 
											s_module_main 
									WHERE
											SERVICE_ID			= $serviceModule 
									AND		LOWER(MODULE_NAME) = '".strtolower($module)."'
								  ";
			$moduleStatement	= mysql_query($moduleQuery);
			if(mysql_num_rows($moduleStatement)>0) {
				$msg = "<span class='errorMsg'>Sorry, module name [ $module ] already exist!</span>";
			} else {
				$insertModuleQuery = "
										INSERT INTO 
													s_module_main
																(
																	SERVICE_ID,
																	MODULE_NAME,
																	DESCRIPTION,
																	ORDER_NO
																) 
														VALUES
																(
																	'".$serviceModule."',
																	'".$module."',
																	'".$description."',
																	'".$moduleOrder."'
																)
									";
				$insertModuleStatement = mysql_query($insertModuleQuery);
				if($insertModuleStatement){
					$msg = "<span class='validMsg'>Module name [ $module ] added sucessfully</span>";
				} else {
					$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
				}
			}
			return $msg;
		}
		//Insert Module End
		
		//Insert Sub Module Start
		function insertSubModule() {
			$defaultFile 		= (isset($_REQUEST["defaultFile"])) ? $_REQUEST["defaultFile"]:'';
			$description 		= (isset($_REQUEST["subModuleDescription"])) ? $_REQUEST["subModuleDescription"]:'';
			$subModOrder 		= (isset($_REQUEST["subModOrder"])) ? $_REQUEST["subModOrder"]:'';

			$subModuleModule 	= (isset($_REQUEST["subModuleModule"])) ? $_REQUEST["subModuleModule"]:'';
			$subModule 			= (isset($_REQUEST["subModule"])) ? $_REQUEST["subModule"]:'';
			$defaultFile 		= addslashes($defaultFile);
			$description 		= addslashes($description);
			$subModOrder 		= addslashes($subModOrder);
			
			$subModuleQuery		= "
									SELECT 
											SUB_MODULE_NAME 
									FROM 
											s_sub_module_main
									WHERE
											MODULE_ID			= $subModuleModule 
									AND		LOWER(SUB_MODULE_NAME) = '".strtolower($subModule)."'
								  ";
			$subModuleStatement	= mysql_query($subModuleQuery);
			if(mysql_num_rows($subModuleStatement)>0) {
				$msg = "<span class='errorMsg'>Sorry, sub module name [ $subModule ] already exist!</span>";
			} else {
				$insertSubModuleQuery = "
										INSERT INTO 
													s_sub_module_main
																	(
																		MODULE_ID,
																		SUB_MODULE_NAME,
																		DEFAULT_FILE,
																		DESCRIPTION,
																		ORDER_NO
																	) 
															VALUES
																	(
																		'".$subModuleModule."',
																		'".$subModule."',
																		'".$defaultFile."',
																		'".$description."',
																		'".$subModOrder."'
																	)
									";
				$insertSubModuleStatement = mysql_query($insertSubModuleQuery);
				if($insertSubModuleStatement){
					$msg = "<span class='validMsg'>Sub module name [ $subModule ] added sucessfully</span>";
				} else {
					$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
				}
			}
			return $msg;
		}
		//Insert Sub Module End
		
		//Module Privilege Insert Start
		function insertModulePrivilege() {
			$submodules 	= $_REQUEST['submodule'];
			//print_r($submodules); die();
			$msg 			= '';

			$emptyOpprivilegeQuery = "DELETE FROM s_privilege_control_main";
			$emptyOpprivilegeStatement = mysql_query($emptyOpprivilegeQuery);
			if($emptyOpprivilegeStatement) {
				if(sizeof($submodules)>0) {
					foreach($submodules as $subModule) {
					  $insertOpprivilegeQuery = "INSERT INTO s_privilege_control_main(SUB_MODULE_ID) VALUES (".$subModule.")";
					  $insertOpprivilegeQuery = mysql_query($insertOpprivilegeQuery);
					}
					$msg = "<span class='valid_msg'>Module Privilege updated successfully</span>";
				} else {
					$msg = "<span class='error_msg'>No Sub Module Selected</span>";
				}		
			} else {
				$msg = "<span class='error_msg'>System error.!</span>";	
			}
			return $msg;
		}
		//Module Privilege Insert End
	}
?>