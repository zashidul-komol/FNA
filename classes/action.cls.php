<?php
	class Action Extends BaseClass {
		function Action() {
			$this->con	= $this->BaseClass();
		}
		//Index Content Start
		
		function getIndexContent($userId) {
			
			$indexbody 	= $this->getTemplateContent('index');
			$str 		= $this->generateTab($userId);
			
			$viewCreateNewButton = '';
			$uQuery = "
									SELECT
											u.psId
									FROM
											s_user u
											
									WHERE  u.psId is not null
									AND    u.psId != 0
									AND    u.USER_ID = $userId";
			$uQueryStatement			= mysql_query($uQuery);
			$uRowCount = mysql_num_rows($uQueryStatement);
			if($uRowCount > 0){
				if($userId == 1){
					$viewCreateNewButton = '';					
				}else{
					
					$viewCreateNewButton = '<a href="createNewPackage.php" style="font-size: 15px;border-radius: 0.3em;background-color:#069;text-decoration:none;color:#ffffff;padding:10px;">&nbsp;&nbsp;&nbsp;&nbsp;Create New Package&nbsp;&nbsp;&nbsp;&nbsp;</a>
					<br/><br/><br/>
					<a href="dataUpload.php" style="font-size: 15px;border-radius: 0.3em;background-color:#069;text-decoration:none;color:#ffffff;padding:10px;">&nbsp; Upload Data From APP &nbsp;</a>
					';
				
				}
			}
			
		
			
			
			
			$indexbody 	= str_replace('<!--%[TABS]%-->',$str,$indexbody);
			
			///////////////////////////////This code start by Masud. For Home Page Search Option. Start/////////////////////////////////////////////////////////////////////////
			
			
			
			
			
			
			///////////////////////////////This code start by Masud. For Home Page Search Option. End/////////////////////////////////////////////////////////////////////////
			
			
			
			
			
			
			return $indexbody;
		}					
		//Index Content End
		
		//Generate Dynamic Tab Start
		function generateTab($userId) {
			$businessDay 	= date('d-m-Y');
			$subroleIds 	= array();
			$roleId 		= '';
			$service_list 	= '';
			$module_list 	= '';
			if(!empty($userId)) {
				$getEmpRoleQuery = "
										SELECT 
												s_user_role.USER_ROLE_ID 
										FROM 
												s_user_role 
										WHERE 
												s_user_role.USER_ID = $userId
									";
			}
			$getEmpRoleStatement = mysql_query($getEmpRoleQuery);
			$numRows = mysql_num_rows($getEmpRoleStatement);
			while($getEmpRoleStatementData = mysql_fetch_array($getEmpRoleStatement)) {
				$roleId = $getEmpRoleStatementData["USER_ROLE_ID"];
			}
			
			 $getServiceQuery = "SELECT	
											s_service.SERVICE_NAME,
											s_service.DESCRIPTION,
											s_service.SERVICE_ID,
											s_service.ORDER_NO
								FROM 
											s_service,
											s_module,
											s_sub_module,
											s_privilege_control,
											s_user_role
								WHERE
											s_user_role.USER_ROLE_ID			= $roleId 
								AND			s_user_role.USER_ID 				= s_privilege_control.USER_ID
								AND 		s_privilege_control.SUB_MODULE_ID	= s_sub_module.SUB_MODULE_ID
								AND 		s_sub_module.MODULE_ID				= s_module.MODULE_ID
								AND 		s_module.SERVICE_ID					= s_service.SERVICE_ID 
								GROUP BY
											s_service.SERVICE_NAME,
											s_service.DESCRIPTION,
											s_service.SERVICE_ID,
											s_service.ORDER_NO
								ORDER BY
											s_service.ORDER_NO
								";
				$service_list 			.= "<ul id='nav'>";
				$active_service_count 	= 1;
				$getServiceStatement = mysql_query($getServiceQuery);
				while($getServiceStatementData = mysql_fetch_array($getServiceStatement)) {
					if($active_service_count == 1) {
						$active_service = "class='active'";
						$active_service_count++;
					} else {
						$active_service = "";
					}
					
					$service_name 	= $getServiceStatementData["SERVICE_NAME"];
					$service_id 	= $getServiceStatementData["SERVICE_ID"];
					$service_tab_id = str_replace("'",'',$service_name);
					$service_tab_id = str_replace('"','',$service_tab_id);
					$service_tab_id = str_replace('/','',$service_tab_id);
					$service_tab_id = str_replace(" ",'_',$service_tab_id);
					$service_list .= "<li $active_service><a href='#{$service_tab_id}'>$service_name</a>";
					
					$getModulesQuery = "SELECT	
													s_module.MODULE_NAME,
													s_module.DESCRIPTION,
													s_module.MODULE_ID,
													s_module.ORDER_NO
										FROM 
													s_module,
													s_sub_module,
													s_privilege_control,
													s_user_role
										WHERE
													s_user_role.USER_ROLE_ID			= $roleId 
										AND			s_user_role.USER_ID 				= s_privilege_control.USER_ID
										AND 		s_privilege_control.SUB_MODULE_ID	= s_sub_module.SUB_MODULE_ID
										AND 		s_sub_module.MODULE_ID				= s_module.MODULE_ID
										AND 		s_module.SERVICE_ID					= $service_id 
										GROUP BY
													s_module.MODULE_NAME,
													s_module.DESCRIPTION,
													s_module.MODULE_ID,
													s_module.ORDER_NO
										ORDER BY
													s_module.ORDER_NO
									";
					$getModulesStatement 	= mysql_query($getModulesQuery);
					$total_module 			= mysql_num_rows($getModulesStatement);
					if($total_module>0) {
						$service_list .= "<ul>";
						$getModulesStatement 	= mysql_query($getModulesQuery);
						while($getModulesStatementData = mysql_fetch_array($getModulesStatement)) {
							$module_name 	= $getModulesStatementData["MODULE_NAME"];
							$module_id	 	= $getModulesStatementData["MODULE_ID"];
							
							$getSubmodulesQuery = "	SELECT
															s_sub_module.SUB_MODULE_NAME,
															s_sub_module.DESCRIPTION,
															s_sub_module.DEFAULT_FILE,
															s_sub_module.SUB_MODULE_ID,
															s_sub_module.ORDER_NO
												FROM 
															s_sub_module,
															s_privilege_control,
															s_user_role
												WHERE
																	s_user_role.USER_ROLE_ID			= $roleId 
															AND		s_user_role.USER_ID 				= s_privilege_control.USER_ID
															AND 	s_privilege_control.SUB_MODULE_ID	= s_sub_module.SUB_MODULE_ID
															AND 	s_sub_module.MODULE_ID				= $module_id 
												GROUP BY
															s_sub_module.SUB_MODULE_NAME,
															s_sub_module.DESCRIPTION,
															s_sub_module.DEFAULT_FILE,
															s_sub_module.SUB_MODULE_ID,
															s_sub_module.ORDER_NO
												ORDER BY
															s_sub_module.ORDER_NO														
											";
							$getSubmodulesStatement 	= mysql_query($getSubmodulesQuery);
							$total_submodule 			= mysql_num_rows($getSubmodulesStatement);
							if($total_submodule>0) {
								$getSubmodulesStatement 			= mysql_query($getSubmodulesQuery);
								while($getSubmodulesStatementData 	= mysql_fetch_array($getSubmodulesStatement)) {
									$SUB_MODULE_NAME 				= $getSubmodulesStatementData["SUB_MODULE_NAME"];
									$submodule_files	 			= $getSubmodulesStatementData["DEFAULT_FILE"];
									if(strlen($submodule_files)>0) {
										$service_list .= "<li><a href='{$submodule_files}'>$SUB_MODULE_NAME</a></li>";
									} else {
										$service_list .= "<li><a href='javascript:void(0)'>$SUB_MODULE_NAME</a></li>";
									}
								}
								//$module_list .= "</table>";
							}
						}
						$service_list .= "</ul>";
					}
					$service_list .= "</li>";
				}
				
				$service_list .= "</ul>";
			return $service_list;
		}
		//Generate Dynamic Tab End
	
		//User Registration View Start
		function getUserRegistration($empId) {
			$systemParametersBody = $this->getTemplateContent('UserRegistrationSetup');
			date_default_timezone_set("Asia/Dhaka");
						
			//Role View Start
			$forwardName	= '';
			$roleView 		= '';
			$roleQuery 		= "
								SELECT
										s_role.ROLE_ID,
										s_role.ROLE_NAME,
										s_role.FORWARD_TO
								FROM
										s_role
								ORDER BY
										ROLE_NAME ASC
							 ";
			$sv				= 1;
			$roleStatement				= mysql_query($roleQuery);
			while($roleStatementData 	= mysql_fetch_array($roleStatement)) {
				if($sv%2==0) {
					$class	= "evenRow";
				} else {
					$class	= "oddRow";
				}
				
				$roleID 		= $roleStatementData["ROLE_ID"];
				$roleName       = $roleStatementData["ROLE_NAME"];
				$roleForwardTo  = $roleStatementData["FORWARD_TO"];
				
				$forwardName 			= '';
				if(!empty($roleForwardTo)) {
					$roleForwardQuery = "
											SELECT
													s_role.ROLE_NAME
											FROM
													s_role
											WHERE 
													s_role.ROLE_ID = $roleForwardTo
										";
					$roleForwardStatement				= mysql_query($roleForwardQuery);
					while($roleForwardStatementData 	= mysql_fetch_array($roleForwardStatement)) {
						$forwardName = $roleForwardStatementData["ROLE_NAME"];
					}
				
					$roleView .= "<tr valign='top' class='$class'>
									<td align='center'>{$sv}.</td>
									<td align='left'>{$roleName}</td>
									<td align='left'>{$forwardName}</td>
									<td align='center'><a href='UserRoleNameEdit.php?keepThis=true&TB_iframe=true&height=600&width=1200&userRoleID={$roleID}' class='thickbox'>
									<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' />&nbsp;</a>
									</td>
								</tr>";
					$sv++;
				}
			}
			$systemParametersBody = str_replace('<!--%[ROLE_FORWARD_TO_VIEW]%-->',$roleView,$systemParametersBody);
			//Role View End
			
			
			// Role List Start
			$rolList 					= '';
			$rolListQuery 				= "SELECT ROLE_ID, ROLE_NAME FROM s_role ORDER BY ROLE_NAME ASC";
			$rolListStatement			= mysql_query($rolListQuery);
			while($rolListStatementData	= mysql_fetch_array($rolListStatement)) {
				$rolID					= $rolListStatementData["ROLE_ID"];
				$rolName				= $rolListStatementData["ROLE_NAME"];
				$rolList 				.= "<option value='".$rolID."'>".$rolName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[FORWARD_TO_LIST]%-->',$rolList,$systemParametersBody);
			// Role List End
			
						
			
			//Get All Module Display Start
			$service_array 		= array();
			$module_array 		= array();
			$submodule_array 	= array();
	
			$submodule_view		= '';
			$submodule_view = "<table border='0' width='100%' align='left' cellspacing='0' cellpadding='2' style='font-size:75%;'>";
			$submoduleServiceQuery = "
											SELECT		
														SERVICE_ID,
														SERVICE_NAME
											FROM
														s_service 
											ORDER BY
														SERVICE_NAME
											ASC
										";
			$smsv									= 1;
			$submoduleServiceStatement				= mysql_query($submoduleServiceQuery);
			while($submoduleServiceStatementData	= mysql_fetch_array($submoduleServiceStatement)) {
				if($smsv%2==0) {
					$class	= "even_row";
				} else {
					$class	= "odd_row";
				}
					
				$submodule_serviceID	= $submoduleServiceStatementData["SERVICE_ID"];
				$submodule_service_name	= $submoduleServiceStatementData["SERVICE_NAME"];
				
				if(in_array($submodule_serviceID, $service_array)) {
					$serv_chk = "checked='checked'";
				} else {
					$serv_chk = '';
				}
				
				$submodule_view .= "<tr class='$class'>
										<td style='font-weight:bold;'>
											<input type='checkbox' name='service[]' id='service{$submodule_serviceID}' {$serv_chk} value='$submodule_serviceID' onclick='toggleS(\"service{$submodule_serviceID}\")'/>
											<span onclick=\"return ShowHide('viewsubModule_Module{$submodule_serviceID}')\" style='cursor:pointer;' >&nbsp;{$submodule_service_name}</span>
										</td>
									</tr>";
				$submoduleModuleQuery = 
										"
											SELECT
													s_module.MODULE_ID,
													s_module.MODULE_NAME,
													s_module.DESCRIPTION
											FROM
													s_module
											WHERE
													s_module.SERVICE_ID='$submodule_serviceID'
											ORDER BY
													s_module.MODULE_NAME
										";
				
				$submodule_view .= "<tr valign='top'>
										<td>
										<div id='viewsubModule_Module{$submodule_serviceID}' style='display:none;'>
											<table border='0' width='100%' align='left' cellspacing='0' cellpadding='2' style='font-size:95%;'>";
				
				$submoduleModuleStatement	= mysql_query($submoduleModuleQuery);
				$submodule_module_count 	= mysql_num_rows($submoduleModuleStatement);
				$smv 						= 1;
				if($submodule_module_count>0) {
					$submoduleModuleStatement				= mysql_query($submoduleModuleQuery);
					while($submoduleModuleStatementData		= mysql_fetch_array($submoduleModuleStatement)) {
				
						if($smv%2==0) {
							$module_class	= "even_row";
						} else {
							$module_class	= "odd_row";
						}
						$submodule_module_id 			= $submoduleModuleStatementData["MODULE_ID"];
						$submodule_module_name 			= $submoduleModuleStatementData["MODULE_NAME"];
						$submodule_module_description 	= $submoduleModuleStatementData["DESCRIPTION"];
						
						if(in_array($submodule_module_id, $module_array)) {
							$mod_chk = "checked='checked'";
						} else {
							$mod_chk = '';
						}
						
						$submodule_view .= "<tr class='$module_class'>
												<td  style='font-weight:bold; text-align:left;padding-left:60px;'>
													<input type='checkbox' name='module[]' id='module{$submodule_serviceID}{$smv}' {$mod_chk} value='$submodule_module_id' onclick='toggleChild(\"module{$submodule_serviceID}{$smv}\")'/>
													<span onclick=\"return ShowHide('view_Sub_Module{$submodule_module_id}')\" style='cursor:pointer;' >{$submodule_module_name}</span>
													</td>
											</tr>";
							
						$submoduleQuery =  "
											SELECT
													s_sub_module.SUB_MODULE_ID,
													s_sub_module.SUB_MODULE_NAME,
													s_sub_module.DEFAULT_FILE,
													s_sub_module.DESCRIPTION
											FROM
													s_sub_module
											WHERE
													s_sub_module.MODULE_ID='$submodule_module_id'
											ORDER BY
													s_sub_module.SUB_MODULE_NAME
										 ";
						$submodule_view .= "<tr valign='top'>
												<td>
												<div id='view_Sub_Module{$submodule_module_id}' style='display:none;'>
													<table border='0' width='100%' align='lect' cellspacing='1' cellpadding='2' style='font-size:100%;'>";
						
						$submoduleStatment	= mysql_query($submoduleQuery);
						$submodule_count 	= mysql_num_rows($submoduleStatment);
				
						if($submodule_count>0) {
							$sm 							= 1;
							$submoduleStatment				= mysql_query($submoduleQuery);
							while($submoduleStatmentData	= mysql_fetch_array($submoduleStatment)) {
								if($sm%2==0) {
									$submodule_class	= "even_row";
								} else {
									$submodule_class	= "odd_row";
								}
								$submodule_id 			= $submoduleStatmentData["SUB_MODULE_ID"];
								$submodule_name 		= $submoduleStatmentData["SUB_MODULE_NAME"];
								$submodule_file 		= $submoduleStatmentData["DEFAULT_FILE"];
								$submodule_description 	= $submoduleStatmentData["DESCRIPTION"];
								
								if(in_array($submodule_id, $submodule_array)) {
									$sub_mod_chk = "checked='checked'";
								} else {
									$sub_mod_chk = '';
								}
								
								$submodule_view .= "<tr>
														<td style=' text-align:left; padding-left:120px;'>
															<input type='checkbox' name='submodule[]' id='submodule{$submodule_module_id}{$sm}' {$sub_mod_chk} value='$submodule_id'/>&nbsp;$submodule_name
														</td>
													</tr>";
								$sm++;
							}
						} else {
							$sm 	= 0;
							$submodule_view .= "<tr>
													<td colspan='4' style='text-align:left; padding-left:120px; color:red;'>No Sub Module Found</td>
												</tr>";
						}
						$submodule_view .= "<tr><td><input type='hidden' name='hidModule{$submodule_module_id}' id='hidModule{$submodule_module_id}' value='{$sm}'></td></tr></table></div></td></tr>";		
						$smv++;
					}
				} else {
					$smv 	= 0;
					$submodule_view .= "<tr>
											<td colspan='3' style='text-align:left; padding-left:60px; color:red;'>No Module Found</td>
										</tr>";
				}
				$submodule_view .= "<tr><td><input type='hidden' name='hidService{$submodule_serviceID}' id='hidService{$submodule_serviceID}' value='{$smv}'></td></tr></table></div></td></tr>";
				
				$smsv++;
			}
			
			$submodule_view .= "</table>";
			
			$systemParametersBody = str_replace('<!--%[DISPLAY_MODULE]%-->',$submodule_view,$systemParametersBody);
			//Get All Module Display End
			
			//Positoin View Start
			$getPositonView 	= '';
			$positionQuery 		= "
									SELECT 
											POSITION_ID, 
											POSITION 
									FROM 
											s_position 
									ORDER BY 
											POSITION ASC
								  ";
			$sv					= 1;
			$positionStatement	= mysql_query($positionQuery);
			while($positionStatementData 	= mysql_fetch_array($positionStatement)) {
				if($sv%2==0) {
					$class="evenRow";
				}
				else {
					$class="oddRow";
				}
				
				$positionIiD 	= $positionStatementData["POSITION_ID"];
				$positionNamee 	= $positionStatementData["POSITION"];
				
				$getPositonView .= "<tr valign='top' class='$class'>
										<td align='center' >{$sv}.</td>
										<td >{$positionNamee}</td>
										<td align='center'><a href='PositionEdit.php?keepThis=true&TB_iframe=true&height=600&width=1200&positionIID={$positionIiD}' class='thickbox'>
										<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' /></a>
										</td>
									</tr>";
				
				$sv++;
			}
			$systemParametersBody = str_replace('<!--%[POSITION_VIEW]%-->',$getPositonView,$systemParametersBody);
			//Positoin View Start
			
			// Generate Position List Start
			$positionListView 					= '';
			$positionListQuery 					= "SELECT POSITION_ID, POSITION FROM s_position ORDER BY POSITION ASC";
			$positionListStatement				= mysql_query($positionListQuery);
			while($positionListStatementData 	= mysql_fetch_array($positionListStatement)) {
				$positionID						= $positionListStatementData["POSITION_ID"];
				$positionName					= $positionListStatementData["POSITION"];
				$positionListView 				.= "<option value='".$positionID."'>".$positionName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[POSITION_LIST]%-->',$positionListView,$systemParametersBody);
			// Generate Position List Start
			
			//User View Start
			$userView 	= '';
			$userQuery 	= "
							SELECT
									s_user.USER_ID,
									s_user.USER_NAME,
									s_user.EMAIL,
									s_position.POSITION,
									s_role.ROLE_NAME,
									s_operator.OPNAME
							FROM
									s_user,
									s_operator,
									s_role,
									s_position,
									s_user_role
							WHERE 
									s_operator.USER_ID = s_user.USER_ID 
							AND		s_user.POSITION_ID = s_position.POSITION_ID
							AND		s_user_role.ROLE_ID = s_role.ROLE_ID
							AND 	s_user_role.USER_ID = s_user.USER_ID
						";
			$sv							= 1;
			$userStatement				= mysql_query($userQuery);
			while($userStatementData	= mysql_fetch_array($userStatement)) {
				if($sv%2==0) {
					$class	= "evenRow";
				}
				else {
					$class	= "oddRow";
				}
				
				$userID			= $userStatementData["USER_ID"];
				$userName       = $userStatementData["USER_NAME"];
				$userEmail      = $userStatementData["EMAIL"];
				$userPosition   = $userStatementData["POSITION"];
				$userRole		= $userStatementData["ROLE_NAME"];
				$operatorName	= $userStatementData["OPNAME"];
				
				$userView .= "	<tr valign='top' class='$class'>
									<td align='center'>{$sv}.</td>
									<td >{$userName}</td>
									<td >{$userEmail}</td>
									<td >{$userPosition}</td>
									<td >{$userRole}</td>
									<td >{$operatorName}</td>
									<td align='center'><a href='UserRegistrationEdit.php?keepThis=true&TB_iframe=true&height=600&width=1200&userRegID={$userID}' class='thickbox'>
									<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' /></a>
									</td>
								</tr>
								";
				
				$sv++;
			}
			$systemParametersBody = str_replace('<!--%[USER_VIEW]%-->',$userView,$systemParametersBody);
			//User View End
			
			return $systemParametersBody;
		}
		//User Registration View End
		
		//User Registration Edit Start
		function getUserRegistrationEdit($userRegID) {
			$cpserviceedit 	= $this->getTemplateContent('UserRegistrationEdit');
			$userID 		= '';
			$userPositionId	= '';
			$userPOSId 		= '';
			$userType 		= '';
			$userName 		= '';
			$userEmail		= '';
			$userDOB 		= '';
			$userOPName 	= '';
			$userOPPass 	= '';
			$userRoleId 	= '';
			$typeSalesAgent = 'display:none';
			$typeEmployee 	= 'display:none';
			$userRegistrationEdit = "
										SELECT
												s_user.USER_ID,
												s_user.POSITION_ID,
												s_user.POS_ID,
												s_user.USER_TYPE,
												s_user.USER_NAME,
												s_user.EMAIL,
												to_char(S_USER.DATE_OF_BIRTH,'dd-mm-yyyy'),
												s_operator.OPNAME,
												s_operator.OPPASS,
												s_user_role.ROLE_ID
										FROM
												s_user,s_operator,s_user_role
										WHERE 
												s_user.USER_ID = $userRegID
										AND 	s_user.USER_ID = s_operator.USER_ID
										AND     s_user.USER_ID = s_operator.USER_ID
									";
						
			$userRegistrationEditStatement = oci_parse($this->con,$userRegistrationEdit);				
			oci_execute ($userRegistrationEditStatement);		
			if(oci_fetch($userRegistrationEditStatement)) {
				$userID             =oci_result($userRegistrationEditStatement,1);
				$userPositionId     =oci_result($userRegistrationEditStatement,2);
				$userPOSId          =oci_result($userRegistrationEditStatement,3);
				$userType           =oci_result($userRegistrationEditStatement,4);
				$userName           =oci_result($userRegistrationEditStatement,5);
				$userEmail          =oci_result($userRegistrationEditStatement,6);
				$userDOB            =oci_result($userRegistrationEditStatement,7);
				$userOPName         =oci_result($userRegistrationEditStatement,8);
				$userOPPass         =oci_result($userRegistrationEditStatement,9);
				$userRoleId         =oci_result($userRegistrationEditStatement,10);
			}
			
			if($userType == 'Employee'){
				$typeEmployee = 'display:';
			}else if($userType == 'Sales Agent'){
				$typeSalesAgent = 'display:';
			}
			

			$userTypeList = '';
			$userTypeName = array(
									""  => "Select", 
									"Employee"  => "Employee",
									"Sales Agent" => "Sales Agent"
								   );
			
			foreach ($userTypeName as $userTypeValue=>$useTypeName) {
				if($userTypeValue == $userType) {
					$userTypeList .= "<option value='".$userTypeValue."' selected='selected'>".$useTypeName."</option>";
				} else {
					$userTypeList .= "<option value='".$userTypeValue."'>".$useTypeName."</option>";
				}
			}
			
			// Country List
			$positionView = '';
			$positionQuery 		= "SELECT POSITION_ID, POSITION FROM s_position ORDER BY POSITION ASC";
			$positionQuerySstatement = oci_parse($this->con,$positionQuery);
			oci_execute ($positionQuerySstatement);		
			while(oci_fetch($positionQuerySstatement)) {
				$positionID		= oci_result($positionQuerySstatement,1);
				$positionName	= oci_result($positionQuerySstatement,2);
				if($positionID == $userPositionId) {
					$positionView .= "<option value='".$positionID."' selected='selected'>".$positionName."</option>";
				} else {
					$positionView .= "<option value='".$positionID."'>".$positionName."</option>";
				}
			}
			
			// Country List end
			
			// Role Forward To Start
			$rolForwardView = '';
			$rolForwardQuery = "SELECT ROLE_ID, ROLE_NAME FROM s_role ORDER BY ROLE_NAME ASC";
			$rolForwardQuerySstatement = oci_parse($this->con,$rolForwardQuery);
			oci_execute ($rolForwardQuerySstatement);		
			while(oci_fetch($rolForwardQuerySstatement)) {
				$rolForwardID		= oci_result($rolForwardQuerySstatement,1);
				$rolForwardName		= oci_result($rolForwardQuerySstatement,2);
				if($rolForwardID == $userRoleId) {
					$rolForwardView .= "<option value='".$rolForwardID."' selected='selected'>".$rolForwardName."</option>";
				} else {
					$rolForwardView .= "<option value='".$rolForwardID."'>".$rolForwardName."</option>";
				}
			}
			// Role Forward To End
			
			// POS View Start
			$POSListView = '';
			$POSQuery = "SELECT		
										s_pos.POS_ID,
										s_sales_agent.SC_NAME,
										s_pos_area.AREA_NAME,
										s_pos.POS_CODE
							FROM		
										s_pos,s_sales_agent,s_pos_area
							WHERE
										s_pos.SALES_AGENT_ID = s_sales_agent.SALES_AGENT_ID
							AND         s_pos.POS_AREA_ID = s_pos_area.POS_AREA_ID
							ORDER BY
										s_pos.POS_CODE ASC
						";
			$POSQuerystatement = oci_parse($this->con,$POSQuery);
			oci_execute ($POSQuerystatement);		
			while(oci_fetch($POSQuerystatement)) {
				$POSID			= oci_result($POSQuerystatement,1);
				$salesAgentName	= oci_result($POSQuerystatement,2);
				$salesAreaName	= oci_result($POSQuerystatement,3);
				$posCode		= oci_result($POSQuerystatement,4);
				if($POSID == $userPOSId) {
					$POSListView .= "<option value='".$POSID."' selected='selected'>".$posCode." - ".$salesAgentName." - ".$salesAreaName."</option>";
				} else {
					$POSListView .= "<option value='".$POSID."'>".$posCode." - ".$salesAgentName." - ".$salesAreaName."</option>";
				}
			}
			$cpserviceedit = str_replace('<!--%[POS_LIST]%-->',$POSListView,$cpserviceedit);
			// POS View End
			
			// POS View Start
			$exv 			= 1;
			$posPortList	= '';
			$posPortList .= "<table width='96%' border='0' cellpadding='3' cellspacing='0'>";
			$portfolioQuery = "SELECT		
										PORTFOLIO_ID,
										PORTFOLIO_NAME
							FROM		
										s_portfolio
						";
			$portfolioQueryStatement = oci_parse($this->con,$portfolioQuery);
			oci_execute ($portfolioQueryStatement);		
			while(oci_fetch($portfolioQueryStatement)) {
				$check 		= '';
				$disable 	= '';
				$portfID	= oci_result($portfolioQueryStatement,1);
				$poftfName	= oci_result($portfolioQueryStatement,2);
				
				$fundPosQuery = "
							select 
										SA_PORTFOLIO_ID
							from 
										s_sa_portfolio 
							WHERE 
										PORTFOLIO_ID = $portfID
							and			USER_ID = $userID
							and 		END_DATE is null
							";
				$fundPosQueryStatement = oci_parse($this->con,$fundPosQuery);				
				oci_execute ($fundPosQueryStatement);
				if(oci_fetch($fundPosQueryStatement)){
					$check = "checked = 'checked'";
				}
				if(!empty($userPOSId)){
					$fundPosQuery = "
								select 
											distinct PORTFOLIO_ID
								from 
											s_pos_commission 
								WHERE 
											POS_ID = $userPOSId
								and 		END_DATE is null
								and 		PORTFOLIO_ID = $portfID
								";
					$fundPosQueryStatement = oci_parse($this->con,$fundPosQuery);				
					oci_execute ($fundPosQueryStatement);
					if(!oci_fetch($fundPosQueryStatement)){
					$disable = " disabled='disabled'";
					}
				}
				
				$posPortList .= "
								<tr>
										<td width='10%'><input type='checkbox' name='portfolioId[]' id='portfolioId{$exv}' value='{$portfID}' class='FormCheckBoxTypeInput' {$check}{$disable}/>
										<td align='left'>$poftfName</td></td>
								   </tr>
								</tr>";
				$exv++;
				
			}
			$posPortList .= " </table>";
			
			$submodule_view = '';
			$service_array 		= array();
			$module_array 		= array();
			$submodule_array 	= array();
			$userRolIdArray 	= array();
			$roleNo = 1;
			$usrRoleExistIdArray 	= array();
			
			$userRolChkForwardQuery = "SELECT ROLE_ID FROM s_user_role WHERE USER_ID = $userRegID";
			$userRolChkForwardQueryStatement = oci_parse($this->con,$userRolChkForwardQuery);
			oci_execute ($userRolChkForwardQueryStatement);
			$a = 0;		
			while(oci_fetch($userRolChkForwardQueryStatement))
			{
				$usrRoleExistId 	= oci_result($userRolChkForwardQueryStatement,1);
				
				if(!in_array($usrRoleExistId, $usrRoleExistIdArray)) {
					$usrRoleExistIdArray[$a] = $usrRoleExistId;
				}
				$a++;
			}
			
			$submodule_view .= "<fieldset><legend>Role Name</legend><table>";
			$rolChkForwardQuery = "SELECT ROLE_ID, ROLE_NAME FROM s_role ORDER BY ROLE_NAME ASC";
			$rolChkForwardQuerySstatement = oci_parse($this->con,$rolChkForwardQuery);
			oci_execute ($rolChkForwardQuerySstatement);		
			while(oci_fetch($rolChkForwardQuerySstatement)) {
				$rolChkForwardID=oci_result($rolChkForwardQuerySstatement,1);
				$rolChkForwardName=oci_result($rolChkForwardQuerySstatement,2);
				
				if(in_array($rolChkForwardID, $usrRoleExistIdArray)) {
					$rolId_chk = "checked='checked'";
				} else {
					$rolId_chk = '';
				}
				
				$submodule_view .= "<tr>
									<td>
										<input type='checkbox' name='userRegRoleName[]' id='userRegRoleName{$roleNo}' {$rolId_chk} value='$rolChkForwardID' onclick='getRoleId($rolChkForwardID)'>  $rolChkForwardName
									</td>
								</tr>
								";
				$roleNo++;
			}
			$submodule_view .= "<tr><td><input type='hidden' name='hiduserRegRoleName' id='hiduserRegRoleName' value='{$roleNo}'></td></tr>";
			$submodule_view .= "</table></fieldset>";
			
			$roleIdQuery = "SELECT	DISTINCT	
								s_service.SERVICE_ID,
								s_module.MODULE_ID,
								s_sub_module.SUB_MODULE_ID
					FROM		
								s_default_role_privileage,
								s_service,
								s_module,
								s_sub_module
					WHERE
								s_default_role_privileage.ROLE_ID in (".implode(',',$usrRoleExistIdArray).")
					AND			s_default_role_privileage.SUB_MODULE_ID = s_sub_module.SUB_MODULE_ID
					AND 		s_sub_module.MODULE_ID=s_module.MODULE_ID
					AND 		s_module.SERVICE_ID=s_service.SERVICE_ID 
				";
			$roleIdQueryStatement = oci_parse($this->con,$roleIdQuery);
			oci_execute ($roleIdQueryStatement);
			$i = 0;		
			while(oci_fetch($roleIdQueryStatement))
			{
				$serv_id 	= oci_result($roleIdQueryStatement,1);
				$mod_id 	= oci_result($roleIdQueryStatement,2);
				$sub_mod_id = oci_result($roleIdQueryStatement,3);
				
				if(!in_array($serv_id, $service_array)) {
					$service_array[$i] = $serv_id;
				}
				if(!in_array($mod_id, $module_array)) {
					$module_array[$i] = $mod_id;
				}
				$submodule_array[$i] = $sub_mod_id;
				$i++;
			}
			
			
			
			$serviceUserArray 		= array();
			$moduleUserArray 		= array();
			$submoduleUserArray 	= array();
			
			$roleUserIdQuery = "SELECT	DISTINCT	
								s_service.SERVICE_ID,
								s_module.MODULE_ID,
								s_privilege_control.SUB_MODULE_ID
					FROM		
								s_privilege_control,
								s_service,
								s_module,
								s_sub_module
					WHERE
								s_privilege_control.USER_ID = $userRegID
					AND			s_privilege_control.SUB_MODULE_ID = s_sub_module.SUB_MODULE_ID
					AND 		s_sub_module.MODULE_ID = s_module.MODULE_ID
					AND 		s_module.SERVICE_ID = s_service.SERVICE_ID 
				";
			$roleUserIdQueryStatement = oci_parse($this->con,$roleUserIdQuery);
			oci_execute ($roleUserIdQueryStatement);
			$g = 0;		
			while(oci_fetch($roleUserIdQueryStatement))
			{
				$servUserId 		= oci_result($roleUserIdQueryStatement,1);
				$modUserId 			= oci_result($roleUserIdQueryStatement,2);
				$subModUserId 		= oci_result($roleUserIdQueryStatement,3);
				
				if(!in_array($servUserId, $serviceUserArray)) {
					$serviceUserArray[$g] = $servUserId;
				}
				if(!in_array($modUserId, $moduleUserArray)) {
					$moduleUserArray[$g] = $modUserId;
				}
				$submoduleUserArray[$g] = $subModUserId;
				$g++;
			}
			
			
			$submodule_view .= "<fieldset><legend>All Link</legend><table border='0' width='100%' align='left' cellspacing='0' cellpadding='2' style='font-size:75%;'>";
			$submodule_service_query = "
										SELECT		
													SERVICE_ID,
													INITCAP(SERVICE_NAME)
										FROM
													s_service 
										ORDER BY
													INITCAP(SERVICE_NAME)
										ASC
									";
			$submodule_service_statement = oci_parse($this->con,$submodule_service_query);				
			oci_execute ($submodule_service_statement);
			$smsv=1;
			while(oci_fetch($submodule_service_statement)) {
				if($smsv%2==0) {
					$class	= "even_row";
				} else {
					$class	= "odd_row";
				}
				$submodule_serviceID	= oci_result($submodule_service_statement,1);
				$submodule_service_name	= oci_result($submodule_service_statement,2);
				
				if(in_array($submodule_serviceID, $service_array)) {
					if(in_array($submodule_serviceID, $serviceUserArray)) {
						$serv_chk = "checked='checked'";
					} else {
						$serv_chk = '';
					}
					$submodule_view .= "<tr class='$class'>
											<td style='font-weight:bold;'>
												<input type='checkbox' name='userService[]' id='subMod{$submodule_serviceID}' {$serv_chk} value='$submodule_serviceID' onclick='totLink(\"subMod{$submodule_serviceID}\")'/>
												<span onclick=\"return ShowHide('viewSubMod{$submodule_serviceID}')\" style='cursor:pointer;' >&nbsp;{$submodule_service_name}</span>
											</td>
										</tr>";
					$submodule_module_query = "
												SELECT
														s_module.MODULE_ID,
														s_module.MODULE_NAME,
														s_module.DESCRIPTION
												FROM
														s_module
												WHERE
														s_module.SERVICE_ID='$submodule_serviceID'
												ORDER BY
														s_module.MODULE_NAME
											";
					$submodule_modulestatement = oci_parse($this->con,$submodule_module_query);				
					oci_execute ($submodule_modulestatement);
					$submodule_view .= "<tr valign='top'>
											<td>
											<div id='viewSubMod{$submodule_serviceID}' style='display:none;'>
												<table border='0' width='100%' align='left' cellspacing='0' cellpadding='2' style='font-size:95%;'>";
					
					while(oci_fetch($submodule_modulestatement));
					$submodule_module_count = oci_num_rows($submodule_modulestatement);
					$smv = 1;
					
					if($submodule_module_count>0) {
						oci_execute ($submodule_modulestatement);
						while(oci_fetch($submodule_modulestatement)) {
							if($smv%2==0) {
								$module_class	= "even_row";
							} else {
								$module_class	= "odd_row";
							}
							$submodule_module_id 			= oci_result($submodule_modulestatement,1);
							$submodule_module_name 			= oci_result($submodule_modulestatement,2);
							$submodule_module_description 	= oci_result($submodule_modulestatement,3);
							if(in_array($submodule_module_id, $module_array)) {
								if(in_array($submodule_module_id, $moduleUserArray)) {
									$mod_chk = "checked='checked'";
								} else {
									$mod_chk = '';
								}
								$submodule_view .= "<tr class='$module_class'>
														<td  style='font-weight:bold; text-align:left;padding-left:60px;'>
															<input type='checkbox' name='userModule[]' id='subSubMod{$submodule_serviceID}{$smv}'{$mod_chk} value='$submodule_module_id' onclick='totLinkChild(\"subSubMod{$submodule_serviceID}{$smv}\")'/>
															<span onclick=\"return ShowHide('viewSubSubmodule{$submodule_module_id}')\" style='cursor:pointer;' >{$submodule_module_name}</span>
															</td>
													</tr>";
								$submodule_query = 
												"
													SELECT
															s_sub_module.SUB_MODULE_ID,
															s_sub_module.SUB_MODULE_NAME,
															s_sub_module.DEFAULT_FILE,
															s_sub_module.DESCRIPTION
													FROM
															s_sub_module
													WHERE
															s_sub_module.MODULE_ID='$submodule_module_id'
													ORDER BY
															s_sub_module.SUB_MODULE_NAME
												";
								$submodule_statement = oci_parse($this->con,$submodule_query);
								oci_execute ($submodule_statement);				
								$submodule_view .= "<tr valign='top'>
												<td>
												<div id='viewSubSubmodule{$submodule_module_id}' style='display:none;'>
													<table border='0' width='100%' align='lect' cellspacing='1' cellpadding='2' style='font-size:100%;'>";
								while(oci_fetch($submodule_statement));
								$submodule_count = oci_num_rows($submodule_statement);
								if($submodule_count>0) {
									oci_execute ($submodule_statement);
									$sm = 1;
									while(oci_fetch($submodule_statement)) {
										if($sm%2==0) {
											$submodule_class	= "even_row";
										} else {
											$submodule_class	= "odd_row";
										}
										$submodule_id 			= oci_result($submodule_statement,1);
										$submodule_name 		= oci_result($submodule_statement,2);
										$submodule_file 		= oci_result($submodule_statement,3);
										$submodule_description 	= oci_result($submodule_statement,4);
										if(in_array($submodule_id, $submodule_array)) {
											if(in_array($submodule_id, $submoduleUserArray)) {
												$sub_mod_chk = "checked='checked'";
											} else {
												$sub_mod_chk = '';
											}
											$submodule_view .= "<tr style='background:#E8E1E1;'>
																<td style=' text-align:left; padding-left:120px;'>
																	<input type='checkbox' name='userSubmodule[]' id='subSubSubMod{$submodule_module_id}{$sm}' value='$submodule_id' {$sub_mod_chk} />&nbsp;$submodule_name
																</td>
															</tr>";
											$sm++;
										} 
										
									}
								}
								$submodule_view .= "<tr><td><input type='hidden' name='hidModule{$submodule_module_id}' id='hidSubSubMod{$submodule_module_id}' value='{$sm}'></td></tr></table></div></td></tr>";			
								$smv++;
							} 
						}
						$submodule_view .= "<tr><td><input type='hidden' name='hidService{$submodule_serviceID}' id='hidSubMod{$submodule_serviceID}' value='{$smv}'></td></tr></table></div></td></tr>";
					}
				}
				$smsv++;
			}
			$submodule_view .= "</table></fieldset>";
			
			$submodule_view .= "<fieldset><legend>All Control</legend><table border='0' width='100%' align='left' cellspacing='0' cellpadding='2' style='font-size:75%;'>";
			$existControlQuery = "
										SELECT		
													CONTROL_ID
										FROM
													s_default_control
										WHERE 
													ROLE_ID IN (".implode(',',$usrRoleExistIdArray).")
										ORDER BY
													CONTROL_ID
										ASC
									";
			$existControlQueryStatement = oci_parse($this->con,$existControlQuery);
			oci_execute ($existControlQueryStatement);
			$k = 0;	
			$existContidArray = array();	
			while(oci_fetch($existControlQueryStatement))
			{
				$existContid 	= oci_result($existControlQueryStatement,1);
				
				if(!in_array($existContid, $existContidArray)) {
					$existContidArray[$k] = $existContid;
				}
				$k++;
			}
			
			$existUserControlQuery = "
										SELECT		
													CONTROL_ID
										FROM
													s_user_control
										WHERE 
													USER_ID = $userRegID
										ORDER BY
													CONTROL_ID
										ASC
									";
			$existUserControlQueryStatement = oci_parse($this->con,$existUserControlQuery);
			oci_execute ($existUserControlQueryStatement);
			$d = 0;	
			$existUserContidArray = array();	
			while(oci_fetch($existUserControlQueryStatement))
			{
				$existUserContid 	= oci_result($existUserControlQueryStatement,1);
				
				if(!in_array($existUserContid, $existUserContidArray)) {
					$existUserContidArray[$d] = $existUserContid;
				}
				$d++;
			}
			$controlQuery = "
										SELECT		
													CONTROL_ID,
													CONTROL_NAME
										FROM
													s_control 
										ORDER BY
													CONTROL_NAME
										ASC
									";
			$controlQueryStatement = oci_parse($this->con,$controlQuery);				
			oci_execute ($controlQueryStatement);
			$smsv=1;
			while(oci_fetch($controlQueryStatement)) {
				if($smsv%2==0) {
					$class	= "even_row";
				} else {
					$class	= "odd_row";
				}
				$controlID	= oci_result($controlQueryStatement,1);
				$controlName	= oci_result($controlQueryStatement,2);
				if(in_array($controlID, $existContidArray)) {
					if(in_array($controlID, $existUserContidArray)) {
						$existchk = "checked='checked'";
					} else {
						$existchk = '';
					}
					$submodule_view .= "<tr class='$class'>
											<td style='font-weight:bold;'>
												<input type='checkbox' name='userControl[]' id='control{$controlID}' value='$controlID' {$existchk}/>&nbsp;&nbsp;{$controlName}
											</td>
										</tr>";
				} 
			}
			
			$submodule_view .= "</table></fieldset>";
			
			if($userType == 'Employee'){
				$cpserviceedit = str_replace('<!--%[CONTROL_MODUL_LINK_EMPLOYEE]%-->',$submodule_view,$cpserviceedit);
			}
			if($userType == 'Sales Agent'){
				$cpserviceedit = str_replace('<!--%[CONTROL_MODUL_LINK_SALES]%-->',$submodule_view,$cpserviceedit);
			}
			$cpserviceedit = str_replace('<!--%[POS_PORT]%-->',$posPortList,$cpserviceedit);
			$cpserviceedit = str_replace('<!--%[USER_TYPE_NAME]%-->',$userTypeList,$cpserviceedit);
			$cpserviceedit = str_replace('<!--%[EXISTING_USER_ROLE_ID]%-->',$userRoleId,$cpserviceedit);
			$cpserviceedit = str_replace('<!--%[USER_ID]%-->',$userRegID,$cpserviceedit);
			$cpserviceedit = str_replace('<!--%[USER_NAME]%-->',$userName,$cpserviceedit);
			$cpserviceedit = str_replace('<!--%[USER_EMAIL]%-->',$userEmail,$cpserviceedit);
			$cpserviceedit = str_replace('<!--%[USER_DOB]%-->',$userDOB,$cpserviceedit);
			$cpserviceedit = str_replace('<!--%[USER_TYPE]%-->',$userType,$cpserviceedit);
			$cpserviceedit = str_replace('<!--%[USER_OPNAME]%-->',$userOPName,$cpserviceedit);
			$cpserviceedit = str_replace('<!--%[USER_OPPASS]%-->',$userOPPass,$cpserviceedit);
			$cpserviceedit = str_replace('<!--%[ROLE_TO_LIST]%-->',$rolForwardView,$cpserviceedit);
			$cpserviceedit = str_replace('<!--%[ROLE_TO_LIST_SALESAGENT]%-->',$rolForwardView,$cpserviceedit);
			$cpserviceedit = str_replace('<!--%[POSITION_LIST]%-->',$positionView,$cpserviceedit);
			$cpserviceedit = str_replace('<!--%[TYPE_EMP]%-->',$typeEmployee,$cpserviceedit);
			$cpserviceedit = str_replace('<!--%[TYPE_AGENT]%-->',$typeSalesAgent,$cpserviceedit);
			$cpserviceedit = str_replace('<!--%[PORTFOLIO_TOTAL_NO]%-->',$exv,$cpserviceedit);
			
			return $cpserviceedit;
		}
		//User Registration Edit End
		 
		//My Information Edit Start
		function getMyInformationEdit($userRegID) {
			$cpserviceedit 	= $this->getTemplateContent('EditMyInformation');
			$userID 		= '';
			$userPositionId	= '';
			$userPOSId 		= '';
			$userType 		= '';
			$userName 		= '';
			$userEmail		= '';
			$userDOB 		= '';
			$userOPName 	= '';
			$userOPPass 	= '';
			$userRoleId 	= '';
			$typeSalesAgent = 'display:none';
			$typeEmployee 	= 'display:none';
			$userRegistrationEdit = "
							SELECT
									s_user.USER_ID,
									s_user.POSITION_ID,
									s_user.POS_ID,
									s_user.USER_TYPE,
									s_user.USER_NAME,
									s_user.EMAIL,
									to_char(S_USER.DATE_OF_BIRTH,'dd-mm-yyyy'),
									s_operator.OPNAME,
									s_operator.OPPASS,
									s_user_role.ROLE_ID
							FROM
									s_user,s_operator,s_user_role
							WHERE 
									s_user.USER_ID = $userRegID
							AND 	s_user.USER_ID = s_operator.USER_ID
							AND     s_user.USER_ID = s_user_role.USER_ID
								";
						
			$userRegistrationEditStatement = oci_parse($this->con,$userRegistrationEdit);				
			oci_execute ($userRegistrationEditStatement);		
			if(oci_fetch($userRegistrationEditStatement)) {
				$userID             =oci_result($userRegistrationEditStatement,1);
				$userPositionId     =oci_result($userRegistrationEditStatement,2);
				$userPOSId          =oci_result($userRegistrationEditStatement,3);
				$userType           =oci_result($userRegistrationEditStatement,4);
				$userName           =oci_result($userRegistrationEditStatement,5);
				$userEmail          =oci_result($userRegistrationEditStatement,6);
				$userDOB            =oci_result($userRegistrationEditStatement,7);
				$userOPName         =oci_result($userRegistrationEditStatement,8);
				$userOPPass         =oci_result($userRegistrationEditStatement,9);
				$userRoleId         =oci_result($userRegistrationEditStatement,10);
			}
			
			if($userType == 'Employee'){
				$typeEmployee = 'display:';
			}else if($userType == 'Sales Agent'){
				$typeSalesAgent = 'display:';
			}
			
			// Country List
			$positionView = '';
			$positionQuery 		= "SELECT POSITION_ID, POSITION FROM s_position WHERE POSITION_ID = $userPositionId";
			$positionQuerySstatement = oci_parse($this->con,$positionQuery);
			oci_execute ($positionQuerySstatement);		
			if(oci_fetch($positionQuerySstatement)) {
				$positionID		= oci_result($positionQuerySstatement,1);
				$positionView	= oci_result($positionQuerySstatement,2);
			}
			
			// Country List end
			
			// Role Forward To Start
			$rolForwardView = '';
			$rolForwardQuery = "SELECT ROLE_ID, ROLE_NAME FROM s_role ORDER BY ROLE_NAME ASC";
			$rolForwardQuerySstatement = oci_parse($this->con,$rolForwardQuery);
			oci_execute ($rolForwardQuerySstatement);		
			while(oci_fetch($rolForwardQuerySstatement)) {
				$rolForwardID		= oci_result($rolForwardQuerySstatement,1);
				$rolForwardName		= oci_result($rolForwardQuerySstatement,2);
				if($rolForwardID == $userRoleId) {
					$rolForwardView .= "<option value='".$rolForwardID."' selected='selected'>".$rolForwardName."</option>";
				} else {
					$rolForwardView .= "<option value='".$rolForwardID."'>".$rolForwardName."</option>";
				}
			}
			// Role Forward To End
			
			// POS View Start
			$POSListView = '';
			$POSQuery = "SELECT		
										s_pos.POS_ID,
										s_sales_agent.SC_NAME,
										s_pos_area.AREA_NAME,
										s_pos.POS_CODE
							FROM		
										s_pos,s_sales_agent,s_pos_area
							WHERE
										s_pos.SALES_AGENT_ID = s_sales_agent.SALES_AGENT_ID
							AND         s_pos.POS_AREA_ID = s_pos_area.POS_AREA_ID
							ORDER BY
										s_pos.POS_CODE ASC
						";
			$POSQuerystatement = oci_parse($this->con,$POSQuery);
			oci_execute ($POSQuerystatement);		
			while(oci_fetch($POSQuerystatement)) {
				$POSID			= oci_result($POSQuerystatement,1);
				$salesAgentName	= oci_result($POSQuerystatement,2);
				$salesAreaName	= oci_result($POSQuerystatement,3);
				$posCode		= oci_result($POSQuerystatement,4);
				if($POSID == $userPOSId) {
					$POSListView .= "<option value='".$POSID."' selected='selected'>".$posCode." - ".$salesAgentName." - ".$salesAreaName."</option>";
				} else {
					$POSListView .= "<option value='".$POSID."'>".$posCode." - ".$salesAgentName." - ".$salesAreaName."</option>";
				}
			}
			$cpserviceedit = str_replace('<!--%[POS_LIST]%-->',$POSListView,$cpserviceedit);
			// POS View End
			
			// POS View Start
			$exv 			= 1;
			$posPortList	= '';
			$posPortList .= "<table width='96%' border='0' cellpadding='3' cellspacing='0'>";
			$portfolioQuery = "SELECT		
											PORTFOLIO_ID,
											PORTFOLIO_NAME
								FROM		
											s_portfolio
							";
			$portfolioQueryStatement = oci_parse($this->con,$portfolioQuery);
			oci_execute ($portfolioQueryStatement);		
			while(oci_fetch($portfolioQueryStatement)) {
				$check 		= '';
				$disable 	= '';
				$portfID	= oci_result($portfolioQueryStatement,1);
				$poftfName	= oci_result($portfolioQueryStatement,2);
				
				$fundPosQuery = "
							select 
										SA_PORTFOLIO_ID
							from 
										s_sa_portfolio 
							WHERE 
										PORTFOLIO_ID = $portfID
							and			USER_ID = $userID
							and 		END_DATE is null
							";
				$fundPosQueryStatement = oci_parse($this->con,$fundPosQuery);				
				oci_execute ($fundPosQueryStatement);
				if(oci_fetch($fundPosQueryStatement)){
					$check = "checked = 'checked'";
				}
				if(!empty($userPOSId)){
					$fundPosQuery = "
								select 
											distinct PORTFOLIO_ID
								from 
											s_pos_commission 
								WHERE 
											POS_ID = $userPOSId
								and 		END_DATE is null
								and 		PORTFOLIO_ID = $portfID
								";
					$fundPosQueryStatement = oci_parse($this->con,$fundPosQuery);				
					oci_execute ($fundPosQueryStatement);
					if(!oci_fetch($fundPosQueryStatement)){
					$disable = " disabled='disabled'";
					}
				}
				
				$posPortList .= "
								<tr>
										<td width='10%'><input type='checkbox' name='portfolioId[]' id='portfolioId{$exv}' value='{$portfID}' class='FormCheckBoxTypeInput' {$check}{$disable}/>
										<td align='left'>$poftfName</td></td>
								   </tr>
								</tr>";
				$exv++;
				
			}
			$posPortList .= " </table>";
			
			
			$cpserviceedit = str_replace('<!--%[POS_PORT]%-->',$posPortList,$cpserviceedit);
			$cpserviceedit = str_replace('<!--%[USER_TYPE_NAME]%-->',$userType,$cpserviceedit);
			$cpserviceedit = str_replace('<!--%[USER_ID]%-->',$userRegID,$cpserviceedit);
			$cpserviceedit = str_replace('<!--%[USER_NAME]%-->',$userName,$cpserviceedit);
			$cpserviceedit = str_replace('<!--%[USER_EMAIL]%-->',$userEmail,$cpserviceedit);
			$cpserviceedit = str_replace('<!--%[USER_DOB]%-->',$userDOB,$cpserviceedit);
			$cpserviceedit = str_replace('<!--%[USER_TYPE]%-->',$userType,$cpserviceedit);
			$cpserviceedit = str_replace('<!--%[USER_OPNAME]%-->',$userOPName,$cpserviceedit);
			$cpserviceedit = str_replace('<!--%[USER_OPPASS]%-->',$userOPPass,$cpserviceedit);
			$cpserviceedit = str_replace('<!--%[ROLE_TO_LIST]%-->',$rolForwardView,$cpserviceedit);
			$cpserviceedit = str_replace('<!--%[ROLE_TO_LIST_SALESAGENT]%-->',$rolForwardView,$cpserviceedit);
			$cpserviceedit = str_replace('<!--%[POSITION_LIST]%-->',$positionView,$cpserviceedit);
			$cpserviceedit = str_replace('<!--%[TYPE_EMP]%-->',$typeEmployee,$cpserviceedit);
			$cpserviceedit = str_replace('<!--%[TYPE_AGENT]%-->',$typeSalesAgent,$cpserviceedit);
			$cpserviceedit = str_replace('<!--%[PORTFOLIO_TOTAL_NO]%-->',$exv,$cpserviceedit);
			
			return $cpserviceedit;
		}
		//My Information Edit End
		
		// Module Privilege Control Start
		function getModulePrivilege($emp_id) {
			$cpModulePrivilege = $this->getTemplateContent('PrivilegeControl');
			// Role List Start
			$rolList 					= '';
			$rolListQuery 				= "SELECT ROLE_ID, ROLE_NAME FROM s_role ORDER BY ROLE_NAME ASC";
			$rolListStatement			= mysql_query($rolListQuery);
			while($rolListStatementData	= mysql_fetch_array($rolListStatement)) {
				$rolID					= $rolListStatementData["ROLE_ID"];
				$rolName				= $rolListStatementData["ROLE_NAME"];
				$rolList 				.= "<option value='".$rolID."'>".$rolName."</option>";
			}
			$cpModulePrivilege = str_replace('<!--%[ROLE_MODULE]%-->',$rolList,$cpModulePrivilege);
			// Role List End
			
			return $cpModulePrivilege;
		}
		// Module Privilege Control End
		
		//System Parameters Setup Start
		function getSystemParameters($empId) {
			$systemParametersBody = $this->getTemplateContent('FileManagement');
			
			//Service View Start
			$serviceView 		= '';
			$serviceViewQuery 	= "
									SELECT
											SERVICE_ID,
											SERVICE_NAME,
											DESCRIPTION,
											ORDER_NO
									FROM
											s_service 
									ORDER BY
											ORDER_NO
									ASC
								";
			$sv								= 1;
			$serviceViewStatement			= mysql_query($serviceViewQuery);
			while($serviceViewStatementData	= mysql_fetch_array($serviceViewStatement)) {
				if($sv%2==0) {
					$class	= "evenRow";
				} else {
					$class	= "oddRow";
				}
				
				$serviceID        = $serviceViewStatementData["SERVICE_ID"];
				$serviceName      = $serviceViewStatementData["SERVICE_NAME"];
				$serviceDesc      = $serviceViewStatementData["DESCRIPTION"];
				$serviceOrder     = $serviceViewStatementData["ORDER_NO"];
				
				$serviceView .= "<tr valign='top' class='$class'>
									<td >{$serviceName}</td>
									<td >{$serviceDesc}</td>
									<td >{$serviceOrder}</td>
									<td align='center'><a href='ServiceEdit.php?keepThis=true&TB_iframe=true&height=600&width=1200&serviceID={$serviceID}' class='thickbox'>
									<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' /></a>
									</td>
								</tr>";
				
				$sv++;
			}
			$systemParametersBody = str_replace('<!--%[SERVICE_VIEW]%-->',$serviceView,$systemParametersBody);
			//Service View Start
			
			//Service for Module Form Start
			$moduleService 						= '';
			$moduleServiceQuery 				= "SELECT DISTINCT SERVICE_ID,SERVICE_NAME FROM s_service ORDER BY SERVICE_NAME ASC";
			$moduleServiceStatement				= mysql_query($moduleServiceQuery);
			while($moduleServiceStatementData	= mysql_fetch_array($moduleServiceStatement)) {
				$serviceId						= $moduleServiceStatementData["SERVICE_ID"];
				$serviceName					= $moduleServiceStatementData["SERVICE_NAME"];
				$moduleService 					.= "<option value='".$serviceId."'>".$serviceName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[MODULE_SERVICE]%-->',$moduleService,$systemParametersBody);
			//Service for Module Form End
			
			//Module View Start
			$moduleView = "<table border='0' width='100%' align='left' cellspacing='0' cellpadding='3' style='font-size:75%;'>";
			$moduleServQuery = "
									SELECT
											SERVICE_ID,
											SERVICE_NAME
									FROM
											s_service 
											
									ORDER BY
											ORDER_NO
									ASC
								";
			$msv							= 1;
			$moduleServStatement			= mysql_query($moduleServQuery);
			while($moduleServStatementData	= mysql_fetch_array($moduleServStatement)) {
				if($msv%2==0) {
					$class	= "evenRow";
				} else {
					$class	= "oddRow";
				}
				
				$moduleServiceID        = $moduleServStatementData["SERVICE_ID"];
				$moduleServiceName      = $moduleServStatementData["SERVICE_NAME"];
				
				$moduleView .= "<tr class='$class'><td style='font-weight:bold;'><span onclick=\"return ShowHide('viewModule{$moduleServiceID}')\" style='display:block;'>{$moduleServiceName}</span></td></tr>";
				
				$moduleQuery = "
								SELECT
										s_module.MODULE_ID,
										s_module.MODULE_NAME,
										s_module.DESCRIPTION,
										s_module.ORDER_NO
								FROM
										s_module
								WHERE
										s_module.SERVICE_ID='$moduleServiceID'
								ORDER BY
										s_module.ORDER_NO
							  ";
				$moduleView .= "<tr valign='top'>
									<td>
									<div id='viewModule{$moduleServiceID}' style='display:none;'>
									<table border='0' width='99%' align='left' cellspacing='1' cellpadding='2' style='font-size:90%;'>
									<tr style='background:#E8E1E1;text-align:center; font-weight:bold;'>
									<td>Module</td>
									<td>Description</td>
									<td>Order</td>
									<td>Action</td>
								</tr>";
				$moduleStatement	= mysql_query($moduleQuery);
				$moduleCount 		= mysql_num_rows($moduleStatement);
				if($moduleCount>0) {
					$mv 						= 1;
					$moduleStatement			= mysql_query($moduleQuery);
					while($moduleStatementData	= mysql_fetch_array($moduleStatement)) {
						if($mv%2==0) {
							$moduleClass="evenRow";
						} else {
							$moduleClass="oddRow";
						}
						$moduleId          = $moduleStatementData["MODULE_ID"];
						$moduleName        = $moduleStatementData["MODULE_NAME"];
						$moduleDescription = $moduleStatementData["DESCRIPTION"];
						$moduleOrder       = $moduleStatementData["ORDER_NO"];
						
						$moduleView .= "<tr class='$moduleClass'>
											<td>&nbsp;$moduleName</td>
											<td>&nbsp;$moduleDescription</td>
											<td style='text-align:center'>$moduleOrder</td>
											<td style='text-align:center;'><a href='ModuleEdit.php?keepThis=true&TB_iframe=true&height=600&width=1200&moduleID={$moduleId}' class='thickbox'>
											<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' /></td>
										</tr>";
						$mv++;
					}
				} else {
					$moduleView .= "<tr style='background:#F7F4F4'>
										<td colspan='3' style='text-align:center; color:red;'>No Module Found</td>
									</tr>";
				}
				$moduleView .= "</table></div></td></tr>";
				$msv++;
			}
			$moduleView .= "</table>";
			$systemParametersBody = str_replace('<!--%[MODULE_VIEW]%-->',$moduleView,$systemParametersBody);
			//Module View End
			
		
			
			//Sub Module View Start
			$submoduleView = "<table border='0' width='100%' align='left' cellspacing='0' cellpadding='2' style='font-size:75%;'>";
			$submoduleServiceQuery = "
										SELECT
												SERVICE_ID,
												SERVICE_NAME
										FROM
												s_service 
										ORDER BY
												ORDER_NO
										ASC
								    ";
			$smsv									= 1;
			$submoduleServiceStatement				= mysql_query($submoduleServiceQuery);
			while($submoduleServiceStatementData	= mysql_fetch_array($submoduleServiceStatement)) {
				if($smsv%2==0) {
					$class	= "evenRow";
				} else {
					$class	= "oddRow";
				}
				
				$submoduleServiceID		= $submoduleServiceStatementData["SERVICE_ID"];
				$submoduleServiceName	= $submoduleServiceStatementData["SERVICE_NAME"];
				
				$submoduleView .= "<tr class='$class'><td style='font-weight:bold;'><span onclick=\"return ShowHide('viewsubModuleModule{$submoduleServiceID}')\" style='display:block;'>{$submoduleServiceName}</span></td></tr>";
				$submoduleModuleQuery = "
											SELECT
													s_module.MODULE_ID,
													s_module.MODULE_NAME,
													s_module.DESCRIPTION
											FROM
													s_module
											WHERE
													s_module.SERVICE_ID='$submoduleServiceID'
											ORDER BY
													s_module.ORDER_NO
										";
				$submoduleView .= "<tr valign='top'>
									<td>
										<div id='viewsubModuleModule{$submoduleServiceID}' style='display:none;'>
											<table border='0' width='100%' align='left' cellspacing='0' cellpadding='2' style='font-size:95%;'>";
				$submoduleModuleStatement	= mysql_query($submoduleModuleQuery);
				$submoduleModuleCount 		= mysql_num_rows($submoduleModuleStatement);
				if($submoduleModuleCount>0) {
					$smv 								= 1;
					$submoduleModuleStatement			= mysql_query($submoduleModuleQuery);
					while($submoduleModuleStatementData	= mysql_fetch_array($submoduleModuleStatement)) {
						if($smv%2==0) {
							$moduleClass	= "evenRow";
						} else {
							$moduleClass	= "oddRow";
						}
						$submoduleModuleId           = $submoduleModuleStatementData["MODULE_ID"];
						$submoduleModuleName         = $submoduleModuleStatementData["MODULE_NAME"];
						$submoduleModuleDescription  = $submoduleModuleStatementData["DESCRIPTION"];
						
						$submoduleView .= "<tr class='$moduleClass'>
											<td  style='font-weight:bold; text-align:center;'><span onclick=\"return ShowHide('viewSubModule{$submoduleModuleId}')\" style='display:block;'>{$submoduleModuleName}</span></td>
										   </tr>";
						
						$subModuleQuery = "
											SELECT
													s_sub_module.SUB_MODULE_ID,
													s_sub_module.SUB_MODULE_NAME,
													s_sub_module.DEFAULT_FILE,
													s_sub_module.DESCRIPTION,
													s_sub_module.ORDER_NO
											FROM
													s_sub_module
											WHERE
													s_sub_module.MODULE_ID='$submoduleModuleId'
											ORDER BY
													s_sub_module.ORDER_NO
										  ";
						$submoduleView .= "<tr valign='top'>
												<td>
												<div id='viewSubModule{$submoduleModuleId}' style='display:none;'>
												<table border='0' width='100%' align='lect' cellspacing='1' cellpadding='2' style='font-size:100%;'>
												<tr style='background:#E8E1E1;text-align:center; font-weight:bold;'>
												<td>Submodule</td>
												<td>Defaultfile</td>
												<td>Description</td>
												<td>Order</td>
												<td>Action</td>
											</tr>";
						$subModuleStatement	= mysql_query($subModuleQuery);
						$submoduleCount 	= mysql_num_rows($subModuleStatement);
						if($submoduleCount>0) {
							$sm 							= 1;
							$subModuleStatement				= mysql_query($subModuleQuery);
							while($subModuleStatementData	= mysql_fetch_array($subModuleStatement)) {
								if($sm%2==0) {
									$submoduleClass	= "evenRow";
								} else {
									$submoduleClass	= "oddRow";
								}
								
								$submoduleId           = $subModuleStatementData["SUB_MODULE_ID"];
								$submoduleName         = $subModuleStatementData["SUB_MODULE_NAME"];
								$submoduleFile         = $subModuleStatementData["DEFAULT_FILE"];
								$submoduleDescription  = $subModuleStatementData["DESCRIPTION"];
								$submoduleOrder        = $subModuleStatementData["ORDER_NO"];
								
								$submoduleView .= "<tr class='$submoduleClass'>
														<td>&nbsp;$submoduleName</td>
														<td>&nbsp;$submoduleFile</td>
														<td>&nbsp;$submoduleDescription</td>
														<td style='text-align:center;'>$submoduleOrder</td>
														<td style='text-align:center;'><a href='SubModuleEdit.php?keepThis=true&TB_iframe=true&height=600&width=1200&submoduleID={$submoduleId}' class='thickbox'>
														<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' /></td>
													</tr>";
								$sm++;
							}
						} else {
							$submoduleView .= "<tr style='background:#F7F4F4'>
													<td colspan='4' style='text-align:center; color:red;'>No Sub Module Found</td>
											   </tr>";
						}
						$submoduleView .= "</table></div></td></tr>";		
						$smv++;
					}
				} else {
					$submoduleView .= "<tr style='background:#F7F4F4'>
											<td colspan='3' style='text-align:center; color:red;'>No Module Found</td>
									   </tr>";
				}
				$submoduleView .= "</table></div></td></tr>";
				
				$smsv++;
			}
			$submoduleView .= "</table>";
			$systemParametersBody = str_replace('<!--%[SUB_MODULE_VIEW]%-->',$submoduleView,$systemParametersBody);
	
			//Sub Module View End
	
			
			//Service for Sub Module Start
			$systemParametersBody = str_replace('<!--%[SUBMODULE_SERVICE]%-->',$moduleService,$systemParametersBody);
			//Service for Sub Module End
			
			return $systemParametersBody;
			
			
	
			
		}
		
		//System Parameters Setup End
		
		
		
	}
?>