<?php
	class Insert Extends BaseClass {
		function Insert() {
			$this->con=$this->BaseClass();
		}
		
		//Insert User Role Start
		function insertUserRole() {
			$submodules 	= array();
			$roleName		= (isset($_REQUEST["roleName"])) ? $_REQUEST["roleName"]:'';
			$roleForwardTo	= (isset($_REQUEST["roleForwardTo"])) ? $_REQUEST["roleForwardTo"]:'';
			$submodules 	= (isset($_REQUEST["submodule"])) ? $_REQUEST["submodule"]:'';
			$roleName 		= addslashes($roleName);
			
			$existRoleQuery		= "
									SELECT 
											ROLE_NAME 
									FROM 
											s_role 
									WHERE 
											LOWER(ROLE_NAME) = '".strtolower($roleName)."'
								  ";
			$existRoleStatement	= mysql_query($existRoleQuery);
			if(mysql_num_rows($existRoleStatement)>0) {
				$msg = "<span class='errorMsg'>Sorry, role name [ $roleName ] already exist!</span>";
			} else {
				$insertRoleQuery = "
										INSERT 
												INTO 
														s_role 
																( 	
																	ROLE_NAME, 
																	FORWARD_TO 
																) 
														VALUES ( 
																'".$roleName."',
																'".$roleForwardTo."' 
																)
								   ";
				$insertRoleStatement = mysql_query($insertRoleQuery);
				if($insertRoleStatement){
					$maxRoleId 			= '';
					$maxRoleQuery 		= "SELECT MAX(ROLE_ID) AS MAX_ROLE_ID FROM s_role";
					$maxRoleStatement	= mysql_query($maxRoleQuery);			
					if(mysql_num_rows($maxRoleStatement)>0) {
						$maxRoleStatement			= mysql_query($maxRoleQuery);
						while($maxRoleStatementData	= mysql_fetch_array($maxRoleStatement)) {
							$maxRoleId 				= $maxRoleStatementData["MAX_ROLE_ID"];	
							
							// Default Privileage Module Setup Start
							if(sizeof($submodules)>0) {
								foreach($submodules as $subModule) {
								  $insertOpprivilegeQuery = "
								  								INSERT 
																		INTO 
																				s_default_role_privileage
																											(
																												ROLE_ID,
																												SUB_MODULE_ID
																											) 
																									VALUES (
																												".$maxRoleId.",
																												".$subModule."
																											)
															";
								 $insertOpprivilegeStatement = mysql_query($insertOpprivilegeQuery);
								}
							}
							// Default Privileage Modu;e Setup End
						}
					}
					$msg = "<span class='validMsg'>User role [ $roleName ] added sucessfully</span>";
				} else {
					$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
				}
			}
			return $msg;
		}
		//Insert User Role End
		
		//Insert Position Start
		function InsertPosition($userId) {
			$positionName 	= (isset($_REQUEST["positionName"])) ? $_REQUEST["positionName"]:'';
			$positionName 	= addslashes($positionName);
			
			$existPosQuery		= "
									SELECT 
											POSITION 
									FROM 
											s_position 
									WHERE 
											LOWER(POSITION) = '".strtolower($positionName)."'
								  ";
			$existPosStatement	= mysql_query($existPosQuery);
			if(mysql_num_rows($existPosStatement)>0) {
				$msg = "<span class='errorMsg'>Sorry, position [ $positionName ] already exist!</span>";
			} else {
				$insertPositionQuery = "
										INSERT INTO 
													s_position
															(
																POSITION
															) 
													VALUES
															(
																'".$positionName."'
															)
									";
				$insertPositionStatement = mysql_query($insertPositionQuery);
				if($insertPositionStatement){
					$msg = "<span class='validMsg'>Position [ $positionName ] added sucessfully!</span>";
				} else {
					$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
				}
			}
			return $msg;
		}
		//Insert Position End
		
		//Insert User Start
		function insertUserRegistration() {
			date_default_timezone_set("Asia/Dhaka");
			$current_date		= date("Y-m-d");
			$userStatus			= "active";
			$userName 			= (isset($_REQUEST["userName"])) ? $_REQUEST["userName"]:'';
			
			$emailAddress 		= (isset($_REQUEST["emailAddress"])) ? $_REQUEST["emailAddress"]:'';
			$loginName 			= (isset($_REQUEST["loginName"])) ? $_REQUEST["loginName"]:'';
			$loginPassword 		= (isset($_REQUEST["loginPassword"])) ? $_REQUEST["loginPassword"]:'';
			$userName 			= addslashes($userName);
			$emailAddress 		= addslashes($emailAddress);
			$loginName 			= addslashes($loginName);
			$loginPassword 		= addslashes($loginPassword);
			$userRegRole 		= (isset($_REQUEST["userRegRole"])) ? $_REQUEST["userRegRole"]:'';
			$userRegPosition 	= (isset($_REQUEST["userRegPosition"])) ? $_REQUEST["userRegPosition"]:'';
			
			$loginName 			= $this->check_injection($loginName);
			$loginPassword 		= $this->check_injection($loginPassword);


			$existingloginQuery = "
									SELECT
											OPERATOR_ID
									FROM
											s_operator
									WHERE 
											lower(OPNAME) = '".strtolower($loginName)."'
								";
			$existingloginStatement	= mysql_query($existingloginQuery);
			if(mysql_num_rows($existingloginStatement)>0) {
				$msg = "<span class='errorMsg'>Sorry, login name [ $loginName ] already exist!</span>";
			} else {
				$insertUserQuery = "
										INSERT INTO 
													s_user
															(
																POSITION_ID,
																USER_NAME,
																EMAIL,
																USER_STATUS
															) 
													VALUES
															(
																'$userRegPosition',
																'".$userName."',
																'".$emailAddress."',
																'".$userStatus."'
															)
									";
				$insertUserStatement = mysql_query($insertUserQuery);
				if($insertUserStatement){
					$maxUserId 			= '';
					$maxUserQuery 		= "SELECT MAX(USER_ID) AS MAX_USER_ID FROM s_user";
					$maxUserStatement	= mysql_query($maxUserQuery);			
					if(mysql_num_rows($maxUserStatement)>0) {
						$maxUserStatement			= mysql_query($maxUserQuery);
						while($maxUserStatementData	= mysql_fetch_array($maxUserStatement)) {
							$maxUserId 				= $maxUserStatementData["MAX_USER_ID"];	
							
							// Default Privileage Module Setup Start
							$insertOperator = "
												INSERT INTO 
															s_operator
																	(
																		USER_ID,
																		OPNAME,
																		OPPASS,
																		START_DATE
																	) 
															VALUES
																	(
																		'$maxUserId',
																		'".$loginName."',
																		'".$loginPassword."',
																		$current_date
																	)
											  ";
							$insertOperatorStatement = mysql_query($insertOperator);
							if($insertOperatorStatement) {
								$insertUserRoleQuery = "
														INSERT INTO 
																	s_user_role
																			(
																				ROLE_ID,
																				USER_ID
																			) 
																	VALUES
																			(
																				'".$userRegRole."',
																				'".$maxUserId."'
																			)
													";
								$insertUserRoleStatement = mysql_query($insertUserRoleQuery);
								if($insertUserRoleStatement) {
									$insertUserRolePrivileageQuery = "
																		INSERT INTO 
																					s_privilege_control
																							(
																								SUB_MODULE_ID,
																								USER_ID
																							) 
																					SELECT 
																							SUB_MODULE_ID,
																							$maxUserId 
																					FROM 
																							s_default_role_privileage 
																					WHERE 
																							ROLE_ID = '".$userRegRole."'																	
																	";
									$insertUserRolePrivileageStatement = mysql_query($insertUserRolePrivileageQuery);
									if($insertUserRolePrivileageStatement) {
										$msg = "<span class='validMsg'>User [ $userName ] added sucessfully!</span>";		
									} else {
										$msg = "<span class='errorMsg'>Error! privileage control insert failed.</span>";	
									}
								} else {
									$msg = "<span class='errorMsg'>Error! operator information insert failed.</span>";		
								}
								
							} else {
								$msg = "<span class='errorMsg'>Error! operator information insert failed.</span>";	
							}
							// Default Privileage Modu;e Setup End
						}
					} else {
						$msg = "<span class='errorMsg'>Error! user insert failed.</span>";
					}
				} else {
					$msg = "<span class='errorMsg'>Error! user insert failed.</span>";	
				}
			}
			return $msg;
		}
		//Insert User End
		
		//Module Privilege Insert Start
		function insertModulePrivilege() {
			$role 			= $_REQUEST['subrole_module'];
			$submodules 	= $_REQUEST['submodule'];
			//print_r($submodules); die();
			$msg 			= '';

			$emptyOpprivilegeQuery = "DELETE FROM s_privilege_control WHERE USER_ID=$role";
			$emptyOpprivilegeStatement = mysql_query($emptyOpprivilegeQuery);
			if($emptyOpprivilegeStatement) {
				if(sizeof($submodules)>0) {
					foreach($submodules as $subModule) {
					  $insertOpprivilegeQuery = "INSERT INTO s_privilege_control(USER_ID,SUB_MODULE_ID) VALUES (".$role.",".$subModule.")";
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
											s_service 
									WHERE 
											LOWER(SERVICE_NAME) = '".strtolower($service)."'
								  ";
			$serviceStatement	= mysql_query($serviceQuery);
			if(mysql_num_rows($serviceStatement)>0) {
				$msg = "<span class='errorMsg'>Sorry, service name [ $service ] already exist!</span>";
			} else {
				$insertServiceQuery = "
										INSERT INTO 
													s_service
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
											s_module 
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
													s_module
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
											s_sub_module 
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
													s_sub_module
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
	}
?>