<?php
	class packageSetup Extends BaseClass {
		function packageSetup() {
			$this->con	= $this->BaseClass();
		}
		
		//Index Content Start
		function getIndexContent($userId) {
			$indexbody 	= $this->getTemplateContent('index');
			$str 		= $this->generateTab($userId);
			$indexbody 	= str_replace('<!--%[TABS]%-->',$str,$indexbody);
			return $indexbody;
		}
		//Index Content End
		
		// Module Privilege Control Start
		function getModulePrivilege($emp_id) {
			$cpModulePrivilege = $this->getTemplateContent('ProjectPrivilegeControl');
			
			$service_array 		= array();
			$module_array 		= array();
			$submodule_array 	= array();
			
			$getRoleSubmoduleQuery = "
										SELECT		
												s_service_main.SERVICE_ID,
												s_module_main.MODULE_ID,
												s_sub_module_main.SUB_MODULE_ID
										FROM		
												s_privilege_control_main,
												s_sub_module_main,
												s_module_main,
												s_service_main
										WHERE
												s_privilege_control_main.SUB_MODULE_ID	= s_sub_module_main.SUB_MODULE_ID
										AND 	S_SUB_MODULE_MAIN.MODULE_ID				= s_module_main.MODULE_ID
										AND 	s_module_main.SERVICE_ID				= s_service_main.SERVICE_ID 
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
		
			
			$submodule_view='';
			$submodule_view .= "<fieldset><legend>All Link</legend><table border='0' width='100%' align='left' cellspacing='0' cellpadding='2' style='font-size:75%;'>";
			$submoduleServiceQuery = "
													SELECT		
																SERVICE_ID,
																SERVICE_NAME
													FROM
																s_service_main 
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
													s_module_main.MODULE_ID,
													s_module_main.MODULE_NAME,
													s_module_main.DESCRIPTION
											FROM
													s_module_main
											WHERE
													s_module_main.SERVICE_ID='$submodule_serviceID'
											ORDER BY
													s_module_main.MODULE_NAME
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
													s_sub_module_main.SUB_MODULE_ID,
													s_sub_module_main.SUB_MODULE_NAME,
													s_sub_module_main.DEFAULT_FILE,
													s_sub_module_main.DESCRIPTION
											FROM
													s_sub_module_main
											WHERE
													s_sub_module_main.MODULE_ID='$submodule_module_id'
											ORDER BY
													s_sub_module_main.SUB_MODULE_NAME
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
			
			$cpModulePrivilege = str_replace('<!--%[MODULE_LIST]%-->',$submodule_view,$cpModulePrivilege);
			
			return $cpModulePrivilege;
		}
		// Module Privilege Control End
		
		//System Parameters Setup Start
		function getSystemParameters($empId) {
			$systemParametersBody = $this->getTemplateContent('FileManagementMain');
			
			// Procurement Type View Start
			$ptView 		= '';
			$ptViewQuery 	= "
									SELECT
											ptName,
											ptDescription
									FROM
											adbs_procurementtype 
									ORDER BY
											ptName
									ASC
								";
			$sv								= 1;
			$ptViewStatement			= mysql_query($ptViewQuery);
			while($ptViewStatementData	= mysql_fetch_array($ptViewStatement)) {
				if($sv%2==0) {
					$class	= "evenRow";
				} else {
					$class	= "oddRow";
				}
				
				$ptName        		= $ptViewStatementData["ptName"];
				$ptDescription      = $ptViewStatementData["ptDescription"];
				
				$ptView .= "<tr valign='top' class='$class'>
									<td >{$sv}</td>
									<td >{$ptName}</td>
									<td >{$ptDescription}</td>
									<td align='center'>
									<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' />
									</td>
								</tr>";
				
				$sv++;
			}
			$systemParametersBody = str_replace('<!--%[PROCUREMENT_TYPE_VIEW]%-->',$ptView,$systemParametersBody);
			
			//Procurement Type View End
			
			
		//<td align='center'><a href='ServiceEdit.php?keepThis=true&TB_iframe=true&height=600&width=1200&serviceID={$serviceID}' class='thickbox'><img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' /></a>
			// Procurement Method View Start
			$pmView 		= '';
			$pmViewQuery 	= "
									SELECT
											pmName,
											pmDescription
									FROM
											adbs_procurementmethod 
									ORDER BY
											pmName
									ASC
								";
			$sv								= 1;
			$pmViewStatement			= mysql_query($pmViewQuery);
			while($pmViewStatementData	= mysql_fetch_array($pmViewStatement)) {
				if($sv%2==0) {
					$class	= "evenRow";
				} else {
					$class	= "oddRow";
				}
				
				$pmName        		= $pmViewStatementData["pmName"];
				$pmDescription      = $pmViewStatementData["pmDescription"];
				
				$pmView .= "<tr valign='top' class='$class'>
									<td >{$sv}</td>
									<td >{$pmName}</td>
									<td >{$pmDescription}</td>
									<td align='center'>
									<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' />
									</td>
								</tr>";
				
				$sv++;
			}
			$systemParametersBody = str_replace('<!--%[PROCUREMENT_METHOD_VIEW]%-->',$pmView,$systemParametersBody);
			
			//Procurement Method View End
			
			
			// Bidding Procedure View Start
			$bpView 		= '';
			$bpViewQuery 	= "
									SELECT
											bpName,
											bpDescription
									FROM
											adbs_biddingprocedure
									ORDER BY
											bpName
									ASC
								";
			$sv								= 1;
			$bpViewStatement			= mysql_query($bpViewQuery);
			while($bpViewStatementData	= mysql_fetch_array($bpViewStatement)) {
				if($sv%2==0) {
					$class	= "evenRow";
				} else {
					$class	= "oddRow";
				}
				
				$bpName        		= $bpViewStatementData["bpName"];
				$bpDescription      = $bpViewStatementData["bpDescription"];
				
				$bpView .= "<tr valign='top' class='$class'>
									<td >{$sv}</td>
									<td >{$bpName}</td>
									<td >{$bpDescription}</td>
									<td align='center'>
									<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' />
									</td>
								</tr>";
				
				$sv++;
			}
			$systemParametersBody = str_replace('<!--%[Bidding_Procedure_VIEW]%-->',$bpView,$systemParametersBody);
			
			//Bidding Procedure View End
			
			// Input Tab Head View Start
			$ithView 		= '';
			$ithViewQuery 	= "
									SELECT
											ithName,
											ithDescription
									FROM
											adbs_inputtabhead
									ORDER BY
											ithName
									ASC
								";
			$sv								= 1;
			$ithViewStatement			= mysql_query($ithViewQuery);
			while($ithViewStatementData	= mysql_fetch_array($ithViewStatement)) {
				if($sv%2==0) {
					$class	= "evenRow";
				} else {
					$class	= "oddRow";
				}
				
				$ithName        		= $ithViewStatementData["ithName"];
				$ithDescription      = $ithViewStatementData["ithDescription"];
				
				$ithView .= "<tr valign='top' class='$class'>
									<td >{$sv}</td>
									<td >{$ithName}</td>
									<td >{$ithDescription}</td>
									<td align='center'>
									<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' />
									</td>
								</tr>";
				
				$sv++;
			}
			$systemParametersBody = str_replace('<!--%[Input_Tab_Head_VIEW]%-->',$ithView,$systemParametersBody);
			
			//Input Tab Head View End
			
			// Input Tab Head List Start
			$ithList 					= '';
			$ithListQuery 				= "SELECT ithId, ithName FROM adbs_inputtabhead ORDER BY ithId ASC";
			$ithListStatement			= mysql_query($ithListQuery);
			while($ithListStatementData	= mysql_fetch_array($ithListStatement)) {
				$ithId					= $ithListStatementData["ithId"];
				$ithName				= $ithListStatementData["ithName"];
				$ithList 				.= "<option value='".$ithId."'>".$ithName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[INPUT_TAB_HEAD_LIST]%-->',$ithList,$systemParametersBody);
			// Input Tab Head List End
			
			
			// Input Tab Fields View Start
			$itfView 		= '';
			$itfViewQuery 	= "
									SELECT
											itf.itfName,
											ith.ithName
									FROM
											adbs_inputtabfields as itf,adbs_inputtabhead as ith
									WHERE itf.itfId = ith.ithId 
											
									ORDER BY
											itfName
									ASC
								";
			$sv								= 1;
			$itfViewStatement			= mysql_query($itfViewQuery);
			while($itfViewStatementData	= mysql_fetch_array($itfViewStatement)) {
				if($sv%2==0) {
					$class	= "evenRow";
				} else {
					$class	= "oddRow";
				}
				
				$itfName         = $itfViewStatementData["itfName"];
				$ithName         = $itfViewStatementData["ithName"];
				
				$itfView .= "<tr valign='top' class='$class'>
									<td >{$sv}</td>
									<td >{$ithName}</td>
									<td >{$itfName}</td>
									<td align='center'>
									<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' />
									</td>
								</tr>";
				
				$sv++;
			}
			$systemParametersBody = str_replace('<!--%[Input_Tab_Fields_VIEW]%-->',$itfView,$systemParametersBody);
			
			//Input Tab Fields View End
			
			// Procurement Type List Start
			$pProcurementTypeList 					= '';
			$pProcurementTypeListQuery 				= "SELECT ptId, ptName FROM adbs_procurementtype ORDER BY ptId ASC";
			$pProcurementTypeListStatement			= mysql_query($pProcurementTypeListQuery);
			while($pProcurementTypeListStatementData	= mysql_fetch_array($pProcurementTypeListStatement)) {
				$ptId					= $pProcurementTypeListStatementData["ptId"];
				$ptName				= $pProcurementTypeListStatementData["ptName"];
				$pProcurementTypeList 				.= "<option value='".$ptId."'>".$ptName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_PROCUREMENT_TYPE_LIST]%-->',$pProcurementTypeList,$systemParametersBody);
			// Input Tab Head List End
			
			// Input Tab Procurement Method  Start
			$pProcurementMethodList 					= '';
			$pProcurementMethodListQuery 				= "SELECT pmId, pmName FROM adbs_procurementmethod ORDER BY pmId ASC";
			$pProcurementMethodListStatement			= mysql_query($pProcurementMethodListQuery);
			while($pProcurementMethodListStatementData	= mysql_fetch_array($pProcurementMethodListStatement)) {
				$pmId					= $pProcurementMethodListStatementData["pmId"];
				$pmName				= $pProcurementMethodListStatementData["pmName"];
				$pProcurementMethodList 				.= "<option value='".$pmId."'>".$pmName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_PROCUREMENT_MATHOD_LIST]%-->',$pProcurementMethodList,$systemParametersBody);
			// Input Tab Procurement Method End
			
			// Input Bidding Procurement Start
			$pBiddingProcedureList 					= '';
			$pBiddingProcedureListQuery 				= "SELECT bpId, bpName FROM adbs_biddingprocedure ORDER BY bpId ASC";
			$pBiddingProcedureListStatement			= mysql_query($pBiddingProcedureListQuery);
			while($pBiddingProcedureListStatementData	= mysql_fetch_array($pBiddingProcedureListStatement)) {
				$bpId					= $pBiddingProcedureListStatementData["bpId"];
				$bpName				= $pBiddingProcedureListStatementData["bpName"];
				$pBiddingProcedureList				.= "<option value='".$bpId."'>".$bpName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_BIDDING_PROCEDURE_LIST]%-->',$pBiddingProcedureList,$systemParametersBody);
			// Input Bidding Procurement End
			
			
			// Project View Start
			$pView 		= '';
			$pViewQuery 	= "
									SELECT
											pt.ptName,
											pm.pmName,
											bp.bpName,
											p.pName
									FROM
											adbs_package as p,adbs_procurementtype as pt,adbs_procurementmethod as pm,adbs_biddingprocedure as bp
									WHERE p.ptId = pt.ptId AND p.pmId = pm.pmId AND p.bpId = bp.bpId
									ORDER BY
											pName
									ASC
								";
			$sv								= 1;
			$pViewStatement			= mysql_query($pViewQuery);
			while($pViewStatementData	= mysql_fetch_array($pViewStatement)) {
				if($sv%2==0) {
					$class	= "evenRow";
				} else {
					$class	= "oddRow";
				}
				
				$ptName        		= $pViewStatementData["ptName"];
				$pmName      		= $pViewStatementData["pmName"];
				$bpName        		= $pViewStatementData["bpName"];
				$pName     		    = $pViewStatementData["pName"];
				
				$pNameNew				= ''.$pViewStatementData["ptName"].','.$pViewStatementData["pmName"].','.$pViewStatementData["bpName"].'';
				
				$pView .= "<tr valign='top' class='$class'>
									<td >{$sv}</td>
									<td >{$ptName}</td>
									<td >{$pmName}</td>
									<td >{$bpName}</td>
									<td >{$pNameNew}</td>
									<td align='center'>
									<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' />
									</td>
								</tr>";
				
				$sv++;
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_VIEW]%-->',$pView,$systemParametersBody);
			
			//Project View End
			
			
			//Service View Start
			$serviceView 		= '';
			$serviceViewQuery 	= "
									SELECT
											SERVICE_ID,
											SERVICE_NAME,
											DESCRIPTION,
											ORDER_NO
									FROM
											s_service_main 
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
									<td align='center'>
									<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' />
									</td>
								</tr>";
				
				$sv++;
			}
			$systemParametersBody = str_replace('<!--%[SERVICE_VIEW]%-->',$serviceView,$systemParametersBody);
			//Service View Start
			
			//Service for Module Form Start
			$moduleService 						= '';
			$moduleServiceQuery 				= "SELECT DISTINCT SERVICE_ID,SERVICE_NAME FROM s_service_main ORDER BY SERVICE_NAME ASC";
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
											s_service_main 
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
										s_module_main.MODULE_ID,
										s_module_main.MODULE_NAME,
										s_module_main.DESCRIPTION,
										s_module_main.ORDER_NO
								FROM
										s_module_main
								WHERE
										s_module_main.SERVICE_ID='$moduleServiceID'
								ORDER BY
										s_module_main.ORDER_NO
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
												s_service_main 
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
													s_module_main.MODULE_ID,
													s_module_main.MODULE_NAME,
													s_module_main.DESCRIPTION
											FROM
													s_module_main
											WHERE
													s_module_main.SERVICE_ID='$submoduleServiceID'
											ORDER BY
													s_module_main.ORDER_NO
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
													s_sub_module_main.SUB_MODULE_ID,
													s_sub_module_main.SUB_MODULE_NAME,
													s_sub_module_main.DEFAULT_FILE,
													s_sub_module_main.DESCRIPTION,
													s_sub_module_main.ORDER_NO
											FROM
													s_sub_module_main
											WHERE
													s_sub_module_main.MODULE_ID='$submoduleModuleId'
											ORDER BY
													s_sub_module_main.ORDER_NO
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