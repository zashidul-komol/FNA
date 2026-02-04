<?php
	include('../config/dbinfo.inc.php');
	$subrole_id 		= $_POST['subrole_id'];
	$service_array 		= array();
	$module_array 		= array();
	$submodule_array 	= array();
	$userContId_array	= array();
	
	if(!empty($subrole_id)) {
		$getRoleSubmoduleQuery = "
									SELECT		
											s_service.SERVICE_ID,
											s_module.MODULE_ID,
											s_sub_module.SUB_MODULE_ID
									FROM		
											s_privilege_control,
											s_sub_module,
											s_module,
											s_service,
											s_user_role
									WHERE
											s_user_role.USER_ID= $subrole_id 
									AND		s_user_role.USER_ID = s_privilege_control.USER_ID
									AND 	s_privilege_control.SUB_MODULE_ID=s_sub_module.SUB_MODULE_ID
									AND 	s_sub_module.MODULE_ID=s_module.MODULE_ID
									AND 	s_module.SERVICE_ID=s_service.SERVICE_ID 
								";
		$i	= 0;
		$getRoleSubmoduleStatement	= mysql_query($getRoleSubmoduleQuery);
		while($getRoleSubmoduleStatementData	= mysql_fetch_array($getRoleSubmoduleStatement)) {
			$serv_id 	= $getRoleSubmoduleStatementData["SERVICE_ID"];
			$mod_id 	= $getRoleSubmoduleStatementData["MODULE_ID"];
			$sub_mod_id = $getRoleSubmoduleStatementData["SUB_MODULE_ID"];
			
			if(!in_array($serv_id, $service_array)) {
				$service_array[$i] = $serv_id;
			}
			if(!in_array($mod_id, $module_array)) {
				$module_array[$i] = $mod_id;
			}
			$submodule_array[$i] = $sub_mod_id;
			$i++;
		}
	} else {
		$getSubroleSubmoduleQuery =  "
										SELECT		
												service.SERVICEID,
												module.MODULEID,
												submodule.SUBMODULEID
										FROM		
												oppriviledge,
												submodule,
												module,
												service
										WHERE		
												oppriviledge.SUBMODULEID = submodule.SUBMODULEID
										AND		submodule.MODULEID = module.MODULEID 
										AND		module.SERVICEID = service.SERVICEID 
										AND		oppriviledge.SUBROLEID=$subrole_id
									";
		$i	= 0;
		$getSubroleSubmoduleStatement			= mysql_query($getSubroleSubmoduleQuery);
		while($getSubroleSubmoduleStatementData	= mysql_fetch_array($getSubroleSubmoduleStatement)) {
			$serv_id 	= $getSubroleSubmoduleStatementData["SERVICE_ID"];
			$mod_id 	= $getSubroleSubmoduleStatementData["MODULE_ID"];
			$sub_mod_id = $getSubroleSubmoduleStatementData["SUB_MODULE_ID"];
			
			if(!in_array($serv_id, $service_array)) {
				$service_array[$i] = $serv_id;
			}
			if(!in_array($mod_id, $module_array)) {
				$module_array[$i] = $mod_id;
			}
			$submodule_array[$i] = $sub_mod_id;
			$i++;
		}
	}
	
	$submodule_view='';
	$submodule_view .= "<fieldset><legend>All Link</legend><table border='0' width='100%' align='left' cellspacing='0' cellpadding='2' style='font-size:75%;'>";
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
	$submodule_view .= "</table></fieldset>";
	
	$submodule_view .= "<table border='0' width='100%' align='left' cellspacing='0' cellpadding='2' style='font-size:75%;'>";
	$submodule_view .= "<tr valign='bottom'>
							<td style='text-align:center; height:50px;'>
								<input type='submit' name='UpdateModulePrivilege' value='Update' />
								<input type='reset' name='Reset' value='Reset' />
							</td>
						</tr>";
	$submodule_view .= "</table>";
	echo $submodule_view;
?>