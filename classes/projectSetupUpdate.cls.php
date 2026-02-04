<?php
	class ProjectSetupUpdate Extends BaseClass {
		function ProjectSetupUpdate() {
			$this->con=$this->BaseClass();
		}
		
		//Service View for Update Start
		function getServiceEdit($serviceId) {
			$cpserviceedit = $this->getTemplateContent('ServiceEdit');
			$serviceID        = '';
			$service          = '';
			$serviceDesc      = '';
			$serviceOrder     = '';
			$serviceEditQuery = "
									SELECT
											SERVICE_ID,
											INITCAP(SERVICE_NAME),
											INITCAP(DESCRIPTION),
											ORDER_NO
									FROM
											s_service
									WHERE
											SERVICE_ID=$serviceId
								";
						
			$serviceEditStatement = oci_parse($this->con,$serviceEditQuery);				
			oci_execute ($serviceEditStatement);		
			if(oci_fetch($serviceEditStatement)) {
				$serviceID          =oci_result($serviceEditStatement,1);
				$service            =oci_result($serviceEditStatement,2);
				$serviceDesc        =oci_result($serviceEditStatement,3);
				$serviceOrder       =oci_result($serviceEditStatement,4);
			}
			$cpserviceedit = str_replace('<!--%[SERVICE_ID]%-->',$serviceID,$cpserviceedit);
			$cpserviceedit = str_replace('<!--%[SERVICE_NAME]%-->',$service,$cpserviceedit);
			$cpserviceedit = str_replace('<!--%[SERVICE_DESC]%-->',$serviceDesc,$cpserviceedit);
			$cpserviceedit = str_replace('<!--%[SERVICE_ORDER]%-->',$serviceOrder,$cpserviceedit);
			
			return $cpserviceedit;
		}
	
		//Service View for Update End
	
		//Service Update Start
	
		function updateServices() {
			$service 		= $_REQUEST['service'];
			$description 	= $_REQUEST['serviceDescription'];
			$order 			= $_REQUEST['serviceOrder'];
			$serviceId 		= $_REQUEST['serviceId'];
			
			if(empty($service)){
				$msg = "<span class='errorMsg'>Service name can not be empty!</span>";
			} else{
				$serviceQuery = "SELECT SERVICE_ID FROM s_service WHERE SERVICE_NAME=q'[".$service."]'";
				$serviceQueryStatement = oci_parse($this->con,$serviceQuery);
				oci_execute ($serviceQueryStatement);
				oci_fetch($serviceQueryStatement);
				$kk = oci_result($serviceQueryStatement,1);
				if(!empty($kk)) {
					$msg = "<span class='errorMsg'>Service Name Already Exist</span>";
				} else{
					$updateServiceQuery =   " UPDATE
														s_service
												SET
														SERVICE_NAME=q'[".$service."]',
														DESCRIPTION =q'[".$description."]',
														ORDER_NO ='".$order."'
												WHERE
														SERVICE_ID =$serviceId
											";
			
					$updateServiceStatement = oci_parse($this->con,$updateServiceQuery);
					oci_execute ($updateServiceStatement);
					$msg = "<span class='validMsg'>Service updated successfully</span>";
				}
			}
			
			return $msg;
		}
	
		//Service Update End
	
		//Module View for Update Start
		
		function getModuleEdit($moduleId) {
			$cpmoduleedit = $this->getTemplateContent('ModuleEdit');
			$moduleID 		= '';
			$module 		= '';
			$moduleOrder 	= '';
			$moduleDesc 	= '';
			$moduleService 	= '';
			
			$moduleEditQuery = "
									SELECT
											MODULE_ID,
											SERVICE_ID,
											INITCAP(MODULE_NAME),
											initcap(DESCRIPTION),
											ORDER_NO
									FROM
											s_module
									WHERE
											MODULE_ID=$moduleId
								";
	
			$moduleEditStatement = oci_parse($this->con,$moduleEditQuery);				
			oci_execute ($moduleEditStatement);		
			if(oci_fetch($moduleEditStatement)) {
				$moduleID           = oci_result($moduleEditStatement,1);
				$moduleServiceID    = oci_result($moduleEditStatement,2);
				$module             = oci_result($moduleEditStatement,3);
				$moduleDesc         = oci_result($moduleEditStatement,4);
				$moduleOrder        = oci_result($moduleEditStatement,5);
			}
			
			$allServicesQuery =  "
									SELECT
											SERVICE_ID,
											INITCAP(SERVICE_NAME)
									FROM
											s_service
								";
	
			$allServicesStatement = oci_parse($this->con,$allServicesQuery);
			oci_execute ($allServicesStatement);		
			while(oci_fetch($allServicesStatement)) {
				$serviceID    =oci_result($allServicesStatement,1);
				$service      =oci_result($allServicesStatement,2);
				if($serviceID == $moduleServiceID) {
					$moduleService .= "<option value='".$serviceID."' selected='selected'>".$service."</option>";
				} else {
					$moduleService .= "<option value='".$serviceID."'>".$service."</option>";
				}
			}
	
			$cpmoduleedit = str_replace('<!--%[MODULE_ID]%-->',$moduleID,$cpmoduleedit);
			$cpmoduleedit = str_replace('<!--%[MODULE_SERVICE]%-->',$moduleService,$cpmoduleedit);
			$cpmoduleedit = str_replace('<!--%[MODULE_NAME]%-->',$module,$cpmoduleedit);
			$cpmoduleedit = str_replace('<!--%[MODULE_DESC]%-->',$moduleDesc,$cpmoduleedit);
			$cpmoduleedit = str_replace('<!--%[MODULE_ORDER]%-->',$moduleOrder,$cpmoduleedit);
			
			return $cpmoduleedit;
		}
		//Module View for Update End
		
		//Sub Module View for Update Start
		
		function getSubModuleEdit($submoduleID) {
			$cpmoduleedit 	= $this->getTemplateContent('SubModuleEdit');
			$moduleID 		= '';
			$module 		= '';
			$moduleOrder 	= '';
			$moduleDesc 	= '';
			$moduleService 	= '';
			$moduleModule 	= '';
			
			$moduleEditQuery = "
									SELECT
											s_sub_module.SUB_MODULE_ID,
											s_sub_module.MODULE_ID,
											s_sub_module.SUB_MODULE_NAME,
											s_sub_module.DEFAULT_FILE,
											s_sub_module.DESCRIPTION,
											s_sub_module.ORDER_NO,
											s_module.SERVICE_ID
											
									FROM
											s_sub_module,s_module
									WHERE
											s_sub_module.SUB_MODULE_ID=$submoduleID
									AND 	s_sub_module.MODULE_ID = S_MODULE.MODULE_ID
								";
	
			$moduleEditStatement = oci_parse($this->con,$moduleEditQuery);				
			oci_execute ($moduleEditStatement);		
			if(oci_fetch($moduleEditStatement)) {
				$subModuleID             = oci_result($moduleEditStatement,1);
				$moduleID                = oci_result($moduleEditStatement,2);
				$subModuleName           = oci_result($moduleEditStatement,3);
				$subModuleDefaultFile    = oci_result($moduleEditStatement,4);
				$subModuleDesc           = oci_result($moduleEditStatement,5);
				$subModuleOrderNo        = oci_result($moduleEditStatement,6);
				$subModuleService        = oci_result($moduleEditStatement,7);
			}
			
			$allModuleQuery =  "
									SELECT
											S_MODULE.MODULE_ID,
											INITCAP(S_MODULE.MODULE_NAME)
									FROM
											s_module
									WHERE 
											s_module.SERVICE_ID = $subModuleService
								";
	
			$allModuleQueryStatement = oci_parse($this->con,$allModuleQuery);
			oci_execute ($allModuleQueryStatement);		
			while(oci_fetch($allModuleQueryStatement)) {
				$moduleeID		= oci_result($allModuleQueryStatement,1);
				$moduleName     = oci_result($allModuleQueryStatement,2);
				if($moduleeID == $moduleID) {
					$moduleModule .= "<option value='".$moduleeID."' selected='selected'>".$moduleName."</option>";
				} else {
					$moduleModule .= "<option value='".$moduleeID."'>".$moduleName."</option>";
				}
			}
			
			$allServiceQuery =  "
									SELECT
											SERVICE_ID,
											INITCAP(SERVICE_NAME)
									FROM
											s_service
								";
	
			$allServiceQueryStatement = oci_parse($this->con,$allServiceQuery);
			oci_execute ($allServiceQueryStatement);		
			while(oci_fetch($allServiceQueryStatement)) {
				$serviceID    =oci_result($allServiceQueryStatement,1);
				$serviceName      =oci_result($allServiceQueryStatement,2);
				if($serviceID == $subModuleService) {
					$moduleService .= "<option value='".$serviceID."' selected='selected'>".$serviceName."</option>";
				} else {
					$moduleService .= "<option value='".$serviceID."'>".$serviceName."</option>";
				}
			}
	
			$cpmoduleedit = str_replace('<!--%[SUB_MODULE_ID]%-->',$subModuleID,$cpmoduleedit);
			$cpmoduleedit = str_replace('<!--%[SUB_MODULE_NAME]%-->',$subModuleName,$cpmoduleedit);
			$cpmoduleedit = str_replace('<!--%[SUB_MODULE_DEFAULT]%-->',$subModuleDefaultFile,$cpmoduleedit);
			$cpmoduleedit = str_replace('<!--%[SUB_MODULE_DESC]%-->',$subModuleDesc,$cpmoduleedit);
			$cpmoduleedit = str_replace('<!--%[SUB_MODULE_ORDER]%-->',$subModuleOrderNo,$cpmoduleedit);
			$cpmoduleedit = str_replace('<!--%[SERVICE_NAME]%-->',$moduleService,$cpmoduleedit);
			$cpmoduleedit = str_replace('<!--%[MODULE_NMAE]%-->',$moduleModule,$cpmoduleedit);
			
			return $cpmoduleedit;
		}
		//Sub Module View for Update End
	
		//Module Update Start
	
		function updateModule() {
			$serviceModule 	= $_REQUEST['serviceModule'];
			$module 		= $_REQUEST['moduleName'];
			$modOrder 		= $_REQUEST['modOrder'];
			$description 	= $_REQUEST['moduleDescription'];
			$moduleId 		= $_REQUEST['moduleId'];
	
			if(empty($serviceModule)){
				$msg = "<span class='errorMsg'>Please, select a service</span>";
			} else if(empty($module)){
				$msg = "<span class='errorMsg'>Module name can not be empty</span>";
			} else {
				$updateModuleQuery =   "
											UPDATE
													s_module
											SET
													DESCRIPTION =q'[".$description."]',
													ORDER_NO ='".$modOrder."'
											WHERE
													MODULE_ID =$moduleId
										";
		
				$updateModuleStatement = oci_parse($this->con,$updateModuleQuery);
				if(oci_execute ($updateModuleStatement)){
					$selectQuery = "SELECT MODULE_ID FROM S_MODULE WHERE SERVICE_ID ='".$serviceModule."' AND MODULE_NAME=q'[".$module."]'";
					$selectQueryStatement = oci_parse($this->con,$selectQuery);
					oci_execute ($selectQueryStatement);
					if(oci_fetch($selectQueryStatement)){
						$msg = "<span class='errorMsg'>Already Exist!!!</span>";
					} else {
						$updateModQuery =   "
												UPDATE
														s_module
												SET
														SERVICE_ID ='".$serviceModule."',
														MODULE_NAME=q'[".$module."]',
														DESCRIPTION =q'[".$description."]',
														ORDER_NO ='".$modOrder."'
												WHERE
														MODULE_ID =$moduleId
											";
			
						$updateModQueryStatement = oci_parse($this->con,$updateModQuery);
						if(oci_execute ($updateModQueryStatement)){
							$msg = "<span class='valid_msg'>Module updated successfully</span>";
						}
					}
				}
			}
			
			return $msg;
		}
	
		//Module Update End
		
		//Sub Module Update Start
	
		function UpdateSubModule() {
			$serviceModule 			= $_REQUEST['serviceModule'];
			$ModuleModule 			= $_REQUEST['ModuleModule'];
			$subModuleName 			= $_REQUEST['subModuleName'];
			$subModuleDefault 		= $_REQUEST['subModuleDefault'];
			$SubModOrder 			= $_REQUEST['SubModOrder'];
			$subModuleDescription 	= $_REQUEST['subModuleDescription'];
			$subModuleId 			= $_REQUEST['subModuleId'];
	
			if(empty($serviceModule)){
				$msg = "<span class='errorMsg'>Please, select a service</span>";
			} else if(empty($ModuleModule)){
				$msg = "<span class='errorMsg'>Please, select a Module</span>";
			} else{
				$updateModuleQuery =   "
											UPDATE
													s_sub_module
											SET
													MODULE_ID ='".$ModuleModule."',
													SUB_MODULE_NAME=q'[".$subModuleName."]',
													DEFAULT_FILE ='".$subModuleDefault."',
													DESCRIPTION =q'[".$subModuleDescription."]',
													ORDER_NO ='".$SubModOrder."'
											WHERE
													SUB_MODULE_ID =$subModuleId
										";
				$updateModuleStatement = oci_parse($this->con,$updateModuleQuery);
				oci_execute ($updateModuleStatement);
				$msg = "<span class='valid_msg'>Sub Module updated successfully</span>";
			}
			
			return $msg;
		}
	
		//Sub Module Update End
		
		//Module Privilege Update Start
		function update_module_privilege() {
			$role 			= $_REQUEST['subrole_module'];
			$submodules 	= $_REQUEST['submodule'];
			//print_r($controls); die();
			$msg 			= '';

			$empty_opprivilege = "DELETE FROM s_privilege_control WHERE USER_ID=$role";
			$empty_opprivilege_statement = oci_parse($this->con,$empty_opprivilege);
			oci_execute ($empty_opprivilege_statement);
			if(sizeof($submodules)>0) {
				foreach($submodules as $subModule) {
				  $insert_opprivilege_query = "INSERT INTO s_privilege_control(USER_ID,SUB_MODULE_ID) VALUES (".$role.",".$subModule.")";
				  $insert_opprivilege_statement = oci_parse($this->con,$insert_opprivilege_query);
				  oci_execute ($insert_opprivilege_statement);
				}
				$msg = "<span class='valid_msg'>Module Privilege updated successfully</span>";
				
			} else {
				$msg = "<span class='error_msg'>No Sub Module Selected</span>";
			}
			
			
			return $msg;
		}
		//Module Privilege Update End
		
		//Update User Start
		function updateUserRegistration(){			
			$userType 			= trim(str_replace("\'","''",$_REQUEST['userType']));
			$current_date 		= "to_date('".date("d-m-Y G:i:s")."','dd-mm-yyyy HH24:MI:SS')";
			$current_date_t 	= "to_date('".date("d-m-Y")."','dd-mm-yyyy')";
			$userRegPOS 		= '';
			$userDOBB 			= "to_date('','dd-mm-yyyy')";
			$userRegPosition 	= '';
			$userControle 		= array();
			$userRegRoleName 	= array();
			$userSubmodulee 	= array();
			$UserNameId 		= trim(str_replace("\'","''",$_REQUEST['UserNameId']));
			$existingUserRoleId = $_REQUEST['existingUserRoleId'];
			if($userType == 'Employee'){
				$userRegName 		= trim($_REQUEST['userRegNameE']);
				$userRegEmail 		= trim(str_replace("\'","''",$_REQUEST['userRegEmailE']));
				$userRegDOB 		= $_REQUEST['userRegDOBE'];
				$userDOBB 			= "to_date('$userRegDOB','dd-mm-yyyy')";
				$userRegPosition 	= trim(str_replace("\'","''",$_REQUEST['userRegPositionE']));
				if(isset($_REQUEST['userRegRoleName'])){
					$userRegRoleName	 	= $_REQUEST['userRegRoleName'];
				}
				if(isset($_REQUEST['userSubmodule'])){
					$userSubmodulee	 	= $_REQUEST['userSubmodule'];
				}
				if(isset($_REQUEST['userControl'])){
					$userControle	 	= $_REQUEST['userControl'];
				}
				
				
				$userRegLoginName 	= $this->check_injection(trim($_REQUEST['userRegLoginNameE']));
				$userRegPassword 	= $this->check_injection($_REQUEST['userRegPasswordE']);
			}
			if($userType == 'Sales Agent'){
				$userRegName 		= trim($_REQUEST['userRegName']);
				$userRegEmail 		= trim(str_replace("\'","''",$_REQUEST['userRegEmail']));
				if(isset($_REQUEST['userRegRoleName'])){
					$userRegRoleName	 	= $_REQUEST['userRegRoleName'];
				}
				if(isset($_REQUEST['userSubmodule'])){
					$userSubmodulee	 	= $_REQUEST['userSubmodule'];
				}
				if(isset($_REQUEST['userControl'])){
					$userControle	 	= $_REQUEST['userControl'];
				}
				$userRegPosition 	= trim(str_replace("\'","''",$_REQUEST['userRegPosition']));
				$userRegLoginName 	= $this->check_injection(trim($_REQUEST['userRegLoginName']));
				$userRegPassword 	= $this->check_injection($_REQUEST['userRegPass']);
				$userRegPOS 		= trim(str_replace("\'","''",$_REQUEST['userRegPOS']));
				$portfolioIds 		= $_REQUEST['portfolioId'];
			}
			$insertUserQuery = "
									UPDATE 
											s_user 
									SET
											POSITION_ID = '$userRegPosition',
											POS_ID = '$userRegPOS',
											USER_TYPE = '".$userType."',
											USER_NAME = q'[".$userRegName."]',
											EMAIL = '".$userRegEmail."',
											DATE_OF_BIRTH = $userDOBB
									WHERE  
											USER_ID = $UserNameId
								";
			$insertUserQueryStatement = oci_parse($this->con,$insertUserQuery);
			if(oci_execute($insertUserQueryStatement)) {
				$emptyUserRole = "DELETE FROM s_user_role WHERE USER_ID = $UserNameId";
				$emptyUserRoleStatement = oci_parse($this->con,$emptyUserRole);
				oci_execute ($emptyUserRoleStatement);
				if(sizeof($userRegRoleName)>0) {
					foreach($userRegRoleName as $userRegRoleNam) {
					  $insertUserRoleQuery = "INSERT INTO s_user_role(ROLE_ID,USER_ID) VALUES (".$userRegRoleNam.",".$UserNameId.")";
					  $insertUserRoleQueryStatement = oci_parse($this->con,$insertUserRoleQuery);
					  oci_execute ($insertUserRoleQueryStatement);
					}
				} 
				
				$emptyUserControl = "DELETE FROM s_user_control WHERE USER_ID = $UserNameId";
				$emptyUserControlStatement = oci_parse($this->con,$emptyUserControl);
				oci_execute ($emptyUserControlStatement);
				if(sizeof($userControle)>0) {
					foreach($userControle as $userControl) {
					  $insertUserControlQuery = "INSERT INTO s_user_control(CONTROL_ID,USER_ID) VALUES (".$userControl.",".$UserNameId.")";
					  $insertUserControlQueryStatement = oci_parse($this->con,$insertUserControlQuery);
					  oci_execute ($insertUserControlQueryStatement);
					}
				} 
				
				$emptyUserPrivilize = "DELETE FROM s_privilege_control WHERE USER_ID = $UserNameId";
				$emptyUserPrivilizeStatement = oci_parse($this->con,$emptyUserPrivilize);
				oci_execute ($emptyUserPrivilizeStatement);
				if(sizeof($userSubmodulee)>0) {
					foreach($userSubmodulee as $userSubmodule) {
					  $insertUserPrivilizeQuery = "INSERT INTO s_privilege_control(SUB_MODULE_ID,USER_ID) VALUES (".$userSubmodule.",".$UserNameId.")";
					  $insertUserPrivilizeQueryStatement = oci_parse($this->con,$insertUserPrivilizeQuery);
					  oci_execute ($insertUserPrivilizeQueryStatement);
					}
				} 
				
				$logQuery = "SELECT USER_ID FROM s_operator WHERE OPNAME = q'[".$userRegLoginName."]'";
				$logQueryStatement = oci_parse($this->con,$logQuery);
				oci_execute($logQueryStatement);
				if(oci_fetch($logQueryStatement)){
					$userID = oci_result($logQueryStatement,1);
					if($userID==$UserNameId) {
						$insertOperator = "
											UPDATE 
													s_operator 
											SET
													OPNAME = q'[".$userRegLoginName."]',
													OPPASS = '".$userRegPassword."'
											WHERE 
													USER_ID = $UserNameId
										  ";
						$insertOperatorStatement = oci_parse($this->con,$insertOperator);
						oci_execute($insertOperatorStatement);
					} else {
						$msg = "<span class='errorMsg'>Login Name Already Exist</span>";
					}
				} else {
					$insertOperator = "
										UPDATE 
												s_operator 
										SET
												OPNAME = q'[".$userRegLoginName."]',
												OPPASS = '".$userRegPassword."'
										WHERE 
												USER_ID = $UserNameId
									";
					$insertOperatorStatement = oci_parse($this->con,$insertOperator);
					if(oci_execute($insertOperatorStatement)){
						$msg = "<span class='validMsg'>User Update Sucessfully</span>";
					}
				}
				$userPort = "SELECT SA_PORTFOLIO_ID FROM s_sa_portfolio WHERE USER_ID = $UserNameId AND END_DATE IS NULL";
				$userPortStatement = oci_parse($this->con,$userPort);
				oci_execute($userPortStatement);
				while(oci_fetch($userPortStatement)){
					$userPortId = oci_result($userPortStatement,1);
					$updateUserPort = "
										UPDATE 
												s_sa_portfolio 
										SET
												END_DATE = $current_date_t
										WHERE 
												SA_PORTFOLIO_ID = $userPortId
									  ";
					$updateUserPortStatement = oci_parse($this->con,$updateUserPort);
					oci_execute($updateUserPortStatement);
				}
				if($userType == 'Sales Agent'){
					for($i = 0;$i<sizeof($portfolioIds);$i++){
						$portfolioId = $portfolioIds[$i];
						$insertPortfolio = "
											INSERT INTO 
														s_sa_portfolio
																(
																	USER_ID,
																	PORTFOLIO_ID,
																	START_DATE
																) 
														VALUES
																(
																	'$UserNameId',
																	'$portfolioId',
																	$current_date_t
																)
										";
						$insertPortfolioStatement = oci_parse($this->con,$insertPortfolio);
						if(oci_execute($insertPortfolioStatement)){
							$msg = "<span class='validMsg'>User Updated Sucessfully</span>";
						}
					}
				}
				$msg = "<span class='validMsg'>User Update Sucessfully</span>";
			} else {
				$msg = "<span class='errorMsg'>System Error!</span>";
			}
			return $msg;
		}
		//Update User End
		
		//Update User Start
		function updateUserRole() {
			$userRoleName 	= trim(str_replace("\'","''",$_REQUEST['userRoleName']));
			$userForwardTo 	= trim(str_replace("\'","''",$_REQUEST['userForwardTo']));
			$userRoleID 	= trim(str_replace("\'","''",$_REQUEST['userRoleID']));
			$submodules = array();
			$controls = array();
			
			if(isset($_REQUEST['submodule'])){
				$submodules = $_REQUEST['submodule'];
			}
			if(isset($_REQUEST['control'])){
				$controls = $_REQUEST['control'];
			}
			
			$roleQuery = "SELECT ROLE_ID, ROLE_NAME FROM s_role WHERE LOWER(ROLE_NAME) = q'[".strtolower($userRoleName)."]'";
			$roleStatement = oci_parse($this->con,$roleQuery);				
			oci_execute ($roleStatement);
			$chkRoleExist = oci_fetch_all($roleStatement,$roleInfo);

			$rName 	= $roleInfo['ROLE_NAME'][0];
			$rID 	= $roleInfo['ROLE_ID'][0];			
			
			if(($chkRoleExist>0) && ($userRoleID != $rID)) {
				$msg = "<span class='errorMsg'>Sorry, role [ $rName ] already exist!</span>";
			} else {
				$updateUserRole = "
									UPDATE 
											s_role 
									SET
											ROLE_NAME = q'[".$userRoleName."]',
											FORWARD_TO = '".$userForwardTo."'
									WHERE	 
											ROLE_ID = $userRoleID
							";
				$updateUserRoleStatement = oci_parse($this->con,$updateUserRole);
				if(oci_execute ($updateUserRoleStatement)) {
					//Insert Default Privileage Control Start
					$empty_opprivilege = "DELETE FROM s_default_role_privileage WHERE ROLE_ID = $userRoleID";
					$empty_opprivilege_statement = oci_parse($this->con,$empty_opprivilege);
					oci_execute ($empty_opprivilege_statement);
					if(sizeof($submodules)>0) {
						foreach($submodules as $subModule) {
						  $insertOpprivilegeQuery = "INSERT INTO s_default_role_privileage(ROLE_ID, SUB_MODULE_ID) VALUES (".$userRoleID.", ".$subModule.")";
						  $insertOpprivilegeStatement = oci_parse($this->con,$insertOpprivilegeQuery);
						  oci_execute ($insertOpprivilegeStatement);
						}
					}
					
					$emptyUserControl = "DELETE FROM s_default_control WHERE ROLE_ID=$userRoleID";
					$emptyUserControlStatement = oci_parse($this->con,$emptyUserControl);
					oci_execute ($emptyUserControlStatement);
					
					if(sizeof($controls)>0) {
						foreach($controls as $control) {
						  $insertControlQuery = "INSERT INTO s_default_control(CONTROL_ID,ROLE_ID) VALUES (".$control.",".$userRoleID.")";
						  $insertControlQueryStatement = oci_parse($this->con,$insertControlQuery);
						  oci_execute ($insertControlQueryStatement);
						}
					}
					//Insert Default Privileage Control End			
					$msg = "<span class='validMsg'>Role [ $rName ] updated successfully</span>";
				} else {
					$msg = "<span class='errorMsg'>Sorry! system error.</span>";
				}
			}
		return $msg;
		}
		//Update User End
		
		//Update User Start
		function updateMyInformation(){
			$userType 			= trim(str_replace("\'","''",$_REQUEST['UserTypes']));
			$current_date 		= "to_date('".date("d-m-Y G:i:s")."','dd-mm-yyyy HH24:MI:SS')";
			$current_date_t 	= "to_date('".date("d-m-Y")."','dd-mm-yyyy')";
			$userRegPOS 		= '';
			$userDOBB 			= "to_date('','dd-mm-yyyy')";
			$userRegPosition 	= '';
			$UserNameId 		= trim(str_replace("\'","''",$_REQUEST['UserNameId']));
			if($userType == 'Employee'){
				$userRegName 		= trim($_REQUEST['userRegNameE']);
				$userRegEmail 		= trim(str_replace("\'","''",$_REQUEST['userRegEmailE']));
				$userRegDOB 		= $_REQUEST['userRegDOBE'];
				$userDOBB 			= "to_date('$userRegDOB','dd-mm-yyyy')";
				$userRegLoginName 	= $this->check_injection(trim($_REQUEST['userRegLoginNameE']));
				$userRegPassword 	= $this->check_injection($_REQUEST['userRegPasswordE']);
			}
			if($userType == 'Sales Agent'){
				$userRegName 		= trim($_REQUEST['userRegName']);
				$userRegEmail 		= trim(str_replace("\'","''",$_REQUEST['userRegEmail']));
				$userRegLoginName 	= $this->check_injection(trim($_REQUEST['userRegLoginName']));
				$userRegPassword 	= $this->check_injection($_REQUEST['userRegPass']);
			}
			
			$insertUserQuery = "
								UPDATE 
											s_user 
								SET
											USER_NAME = q'[".$userRegName."]',
											EMAIL = '".$userRegEmail."',
											DATE_OF_BIRTH = $userDOBB
								WHERE  
											USER_ID = $UserNameId
								";
			$insertUserQueryStatement = oci_parse($this->con,$insertUserQuery);
			if(oci_execute($insertUserQueryStatement)){
				$logQuery = "SELECT USER_ID FROM S_OPERATOR WHERE OPNAME = q'[".$userRegLoginName."]'";
				$logQueryStatement = oci_parse($this->con,$logQuery);
				oci_execute($logQueryStatement);
				if(oci_fetch($logQueryStatement)){
					$userID = oci_result($logQueryStatement,1);
					$insertOperator = "
										UPDATE 
													s_operator 
										SET
													OPPASS = '".$userRegPassword."'
										WHERE 
													USER_ID = $UserNameId
									  ";
					$insertOperatorStatement = oci_parse($this->con,$insertOperator);
					oci_execute($insertOperatorStatement);
				}
			  $msg = "<span class='validMsg'>User Information Updated Successfully.</span>";	
			} else {
				$msg = "<span class='errorMsg'>System Error!</span>";
			}
			return $msg;
		}
		//Update User End
	}
?>
