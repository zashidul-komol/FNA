<?php
	class ProjectSetup Extends BaseClass {
		function ProjectSetup() {
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
										AND 	s_sub_module_main.MODULE_ID				= s_module_main.MODULE_ID
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
													S_SUB_MODULE_MAIN.SUB_MODULE_ID,
													S_SUB_MODULE_MAIN.SUB_MODULE_NAME,
													S_SUB_MODULE_MAIN.DEFAULT_FILE,
													S_SUB_MODULE_MAIN.DESCRIPTION
											FROM
													s_sub_module_main
											WHERE
													S_SUB_MODULE_MAIN.MODULE_ID='$submodule_module_id'
											ORDER BY
													S_SUB_MODULE_MAIN.SUB_MODULE_NAME
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
			
			// Expanse Head View  Start
			
			$ExpHeadNameVal 					= '';
			$ExpHeadQuery 						= "SELECT EXPHID, EXPHEADNAME FROM fna_expense_head ORDER BY EXPHEADNAME ASC";
			$ExpHeadQueryStatement				= mysql_query($ExpHeadQuery);
			while($ExpHeadQueryStatementData	= mysql_fetch_array($ExpHeadQueryStatement)) {
				$EXPHID							= $ExpHeadQueryStatementData["EXPHID"];
				$EXPHEADNAME					= $ExpHeadQueryStatementData["EXPHEADNAME"];
				$ExpHeadNameVal 					.= "<option value='".$EXPHID."'>".$EXPHEADNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[EXPANSE_HEAD_NAME]%-->',$ExpHeadNameVal,$systemParametersBody);
			// Expanse Head View  End
			
			// Labour View Start
			$ptView 		= '';
			$ptViewQuery 	= "
									SELECT
											PROJECTID,
											SUBPROJECTID,
											LABOURNAME,
											FATHERNAME,
											ADDRESS,
											MOBILE
									FROM
											fna_labour 
									ORDER BY
											LABOURNAME
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
				
				$PROJECTID	  = $ptViewStatementData["PROJECTID"];
				$SUBPROJECTID = $ptViewStatementData["SUBPROJECTID"];
				$LABOURNAME   = $ptViewStatementData["LABOURNAME"];
				$FATHERNAME   = $ptViewStatementData["FATHERNAME"];
				$ADDRESS      = $ptViewStatementData["ADDRESS"];
				$MOBILE       = $ptViewStatementData["MOBILE"];
				
				$QueryProject = " SELECT PROJECTNAME FROM fna_project WHERE PROJECTID = '".$PROJECTID."'";
				$QueryProjectStatement = mysql_query($QueryProject);
				while($QueryProjectStatementData = mysql_fetch_array($QueryProjectStatement)){
					$PROJECTNAME	  = $QueryProjectStatementData["PROJECTNAME"];
				}
				
				$QuerySubProject = " SELECT SUBPROJECTNAME FROM fna_subproject WHERE SUBPROJECTID = '".$SUBPROJECTID."'";
				$QuerySubProjectStatement 	= mysql_query($QuerySubProject);
				while($QuerySubProjectStatementData 	= mysql_fetch_array($QuerySubProjectStatement)){
					$SUBPROJECTNAME	  					= $QuerySubProjectStatementData["SUBPROJECTNAME"];
				}
				
				$ptView .= "<tr valign='top' class='$class'>
									<td >{$sv}</td>
									<td >{$PROJECTNAME}</td>
									<td >{$SUBPROJECTNAME}</td>
									<td >{$LABOURNAME}</td>
									<td >{$FATHERNAME}</td>
									<td >{$ADDRESS}</td>
									<td >{$MOBILE}</td>
									<td align='center'>
									<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' />
									</td>
								</tr>";
				
				$sv++;
			}
			$systemParametersBody = str_replace('<!--%[LABOUR_VIEW]%-->',$ptView,$systemParametersBody);
			
			//Labour View End
			
			// Party View Start
			$partyView 		= '';
			$partyViewQuery 	= "
									SELECT
											PROJECTID,
											SUBPROJECTID,
											PARTYNAME,
											FATHERNAME,
											ADDRESS,
											MOBILE
									FROM
											fna_party 
									ORDER BY
											PARTYNAME
									ASC
								";
			$sv								= 1;
			$partyViewQueryStatement			= mysql_query($partyViewQuery);
			while($partyViewQueryStatementData	= mysql_fetch_array($partyViewQueryStatement)) {
				if($sv%2==0) {
					$class	= "evenRow";
				} else {
					$class	= "oddRow";
				}
				$PROJECTID	  = $partyViewQueryStatementData["PROJECTID"];
				$SUBPROJECTID = $partyViewQueryStatementData["SUBPROJECTID"];
				$PARTYNAME    = $partyViewQueryStatementData["PARTYNAME"];
				$FATHERNAME   = $partyViewQueryStatementData["FATHERNAME"];
				$ADDRESS      = $partyViewQueryStatementData["ADDRESS"];
				$MOBILE       = $partyViewQueryStatementData["MOBILE"];
				
				$QueryProject = " SELECT PROJECTNAME FROM fna_project WHERE PROJECTID = '".$PROJECTID."'";
				$QueryProjectStatement = mysql_query($QueryProject);
				while($QueryProjectStatementData = mysql_fetch_array($QueryProjectStatement)){
					$PROJECTNAME	  			 = $QueryProjectStatementData["PROJECTNAME"];
				}
				
				$QuerySubProject = " SELECT SUBPROJECTNAME FROM fna_subproject WHERE SUBPROJECTID = '".$SUBPROJECTID."'";
				$QuerySubProjectStatement 	= mysql_query($QuerySubProject);
				while($QuerySubProjectStatementData 	= mysql_fetch_array($QuerySubProjectStatement)){
					$SUBPROJECTNAME	  					= $QuerySubProjectStatementData["SUBPROJECTNAME"];
				}
				
				$partyView .= "<tr valign='top' class='$class'>
									<td >{$sv}</td>
									<td >{$PROJECTNAME}</td>
									<td >{$SUBPROJECTNAME}</td>
									<td >{$PARTYNAME}</td>
									<td >{$FATHERNAME}</td>
									<td >{$ADDRESS}</td>
									<td >{$MOBILE}</td>
									<td align='center'>
									<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' />
									</td>
								</tr>";
				
				$sv++;
			}
			$systemParametersBody = str_replace('<!--%[PARTY_VIEW]%-->',$partyView,$systemParametersBody);
			
			//Party View End
			
			
			// Packing Name View  Start
			$ptView 		= '';
			$ptViewQuery 	= "
									SELECT
											PACKINGNAME
									FROM
											fna_packingname 
									ORDER BY
											PACKINGNAME
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
				
				$PACKINGNAME   = $ptViewStatementData["PACKINGNAME"];
				
				$ptView .= "<tr valign='top' class='$class'>
									<td >{$sv}</td>
									<td >{$PACKINGNAME}</td>
									<td align='center'>
									<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' />
									</td>
								</tr>";
				
				$sv++;
			}
			$systemParametersBody = str_replace('<!--%[PACKING_NAME_VIEW]%-->',$ptView,$systemParametersBody);
			
			//Packing Name View End
			
			// Loan Type View  Start
			$ltView 		= '';
			$ltViewQuery 	= "
									SELECT
											LOANTYPENAME
									FROM
											fna_loantype 
									ORDER BY
											LOANTYPENAME
									ASC
								";
			$sv								= 1;
			$ltViewQueryStatement			= mysql_query($ltViewQuery);
			while($ltViewQueryStatementData	= mysql_fetch_array($ltViewQueryStatement)) {
				if($sv%2==0) {
					$class	= "evenRow";
				} else {
					$class	= "oddRow";
				}
				
				$LOANTYPENAME   = $ltViewQueryStatementData["LOANTYPENAME"];
				
				$ltView .= "<tr valign='top' class='$class'>
									<td >{$sv}</td>
									<td >{$LOANTYPENAME}</td>
									<td align='center'>
									<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' />
									</td>
								</tr>";
				
				$sv++;
			}
			$systemParametersBody = str_replace('<!--%[LOAN_TYPE_VIEW]%-->',$ltView,$systemParametersBody);
			
			//Loan Type View End
			
			// Quantity View  Start
			$ptView 		= '';
			$ptViewQuery 	= "
									SELECT
											QVALUE
									FROM
											fna_quantity 
									ORDER BY
											QVALUE
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
				
				$QVALUE   = $ptViewStatementData["QVALUE"];
				
				$ptView .= "<tr valign='top' class='$class'>
									<td >{$sv}</td>
									<td >{$QVALUE}</td>
									<td align='center'>
									<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' />
									</td>
								</tr>";
				
				$sv++;
			}
			$systemParametersBody = str_replace('<!--%[QUANTITY_VIEW]%-->',$ptView,$systemParametersBody);
			
			//Quantity View End
			
			// Weight View  Start
			$ptView 		= '';
			$ptViewQuery 	= "
									SELECT
											WNAME
									FROM
											fna_weight 
									ORDER BY
											WNAME
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
				
				$WNAME   = $ptViewStatementData["WNAME"];
				
				$ptView .= "<tr valign='top' class='$class'>
									<td >{$sv}</td>
									<td >{$WNAME}</td>
									<td align='center'>
									<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' />
									</td>
								</tr>";
				
				$sv++;
			}
			$systemParametersBody = str_replace('<!--%[WEIGHT_VIEW]%-->',$ptView,$systemParametersBody);
			
			//Weight View End
			
			// Chamber View  Start
			$chmView 		= '';
			$chmViewQuery 	= "
									SELECT
											CHNAME
									FROM
											fna_chamber 
									ORDER BY
											CHNAME
									ASC
								";
			$sv								= 1;
			$chmViewQueryStatement			= mysql_query($chmViewQuery);
			while($chmViewQueryStatementData	= mysql_fetch_array($chmViewQueryStatement)) {
				if($sv%2==0) {
					$class	= "evenRow";
				} else {
					$class	= "oddRow";
				}
				
				$CHNAME   = $chmViewQueryStatementData["CHNAME"];
				
				$chmView .= "<tr valign='top' class='$class'>
									<td >{$sv}</td>
									<td >{$CHNAME}</td>
									<td align='center'>
									<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' />
									</td>
								</tr>";
				
				$sv++;
			}
			$systemParametersBody = str_replace('<!--%[CHAMBER_VIEW]%-->',$chmView,$systemParametersBody);
			
			//Chamber View End
			
			// Product Cat Type View  Start
			$pctView 		= '';
			$prodCatTypViewQuery 	= "
										SELECT
												PROJECTID,
												SUBPROJECTID,
												CATEGORYTYPENAME
										FROM
												fna_productcattype 
										ORDER BY
												CATEGORYTYPENAME
										ASC
									";
			$sv	= 1;
			$prodCatTypViewQueryStatement				= mysql_query($prodCatTypViewQuery);
			while($prodCatTypViewQueryStatementData		= mysql_fetch_array($prodCatTypViewQueryStatement)) {
				
				$PROJECTID_PRODCAT	  = $prodCatTypViewQueryStatementData["PROJECTID"];
				$SUBPROJECTID_PRODCAT = $prodCatTypViewQueryStatementData["SUBPROJECTID"];
				$CATEGORYTYPENAME     = $prodCatTypViewQueryStatementData["CATEGORYTYPENAME"];
				
				$QueryProject = " SELECT PROJECTNAME FROM fna_project WHERE PROJECTID = '".$PROJECTID_PRODCAT."'";
				$QueryProjectStatement = mysql_query($QueryProject);
				while($QueryProjectStatementData = mysql_fetch_array($QueryProjectStatement)){
					$PROJECTNAME_PRODCAT	  	 = $QueryProjectStatementData["PROJECTNAME"];
				}
				
				$QuerySubProject = " SELECT SUBPROJECTNAME FROM fna_subproject WHERE SUBPROJECTID = '".$SUBPROJECTID_PRODCAT."'";
				$QuerySubProjectStatement 				= mysql_query($QuerySubProject);
				$SUBPROJECTNAME_PRODCAT = '';
				while($QuerySubProjectStatementData 	= mysql_fetch_array($QuerySubProjectStatement)){
					$SUBPROJECTNAME_PRODCAT	  			= $QuerySubProjectStatementData["SUBPROJECTNAME"];
				}
				
				$pctView .= "<tr valign='top' class='$class'>
									<td >{$sv}</td>
									<td >{$PROJECTNAME_PRODCAT}</td>
									<td >{$SUBPROJECTNAME_PRODCAT}</td>
									<td >{$CATEGORYTYPENAME}</td>
									<td align='center'>
									<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' />
									</td>
								</tr>";
				
				$sv++;
			}
			$systemParametersBody = str_replace('<!--%[PROD_CAT_TYPE_VIEW]%-->',$pctView,$systemParametersBody);
			
			//Product Cat Type View End
			
			// Bank View  Start
			$BankView 		= '';
			$BankViewQuery 	= "
										SELECT
												BANKNAME,
												ADDRESS
										FROM
												fna_bank 
										ORDER BY
												BANKNAME
										ASC
									";
			$sv	= 1;
			$BankViewQueryStatement				= mysql_query($BankViewQuery);
			while($BankViewQueryStatementData	= mysql_fetch_array($BankViewQueryStatement)) {
				$BANKNAME   					= $BankViewQueryStatementData["BANKNAME"];
				$ADDRESS	   					= $BankViewQueryStatementData["ADDRESS"];
				
				$BankView .= "<tr valign='top' class='$class'>
									<td >{$sv}</td>
									<td >{$BANKNAME}</td>
									<td >{$ADDRESS}</td>
									<td align='center'>
									<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' />
									</td>
								</tr>";
				
				$sv++;
			}
			$systemParametersBody = str_replace('<!--%[BANK_VIEW]%-->',$BankView,$systemParametersBody);
			
			//Bank View End
			
			// Bank Branch View  Start
			$BankBranchView 		= '';
			$BankBranchViewQuery 	= "
										SELECT
												b.BANKNAME,
												br.BRANCHNAME,
												br.ADDRESS
										FROM
												fna_bank b, fna_branch br
										WHERE b.BANKID = br.BANKID
										ORDER BY
												b.BANKNAME
										ASC
									";
			$sv	= 1;
			$BankBranchViewQueryStatement				= mysql_query($BankBranchViewQuery);
			while($BankBranchViewQueryStatementData		= mysql_fetch_array($BankBranchViewQueryStatement)) {
				$BANKNAME   							= $BankBranchViewQueryStatementData["BANKNAME"];
				$BRANCHNAME   							= $BankBranchViewQueryStatementData["BRANCHNAME"];
				$ADDRESS	   							= $BankBranchViewQueryStatementData["ADDRESS"];
				
				$BankBranchView .= "<tr valign='top' class='$class'>
									<td >{$sv}</td>
									<td >{$BANKNAME}</td>
									<td >{$BRANCHNAME}</td>
									<td >{$ADDRESS}</td>
									<td align='center'>
									<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' />
									</td>
								</tr>";
				
				$sv++;
			}
			$systemParametersBody = str_replace('<!--%[BANK_BRANCH_VIEW]%-->',$BankBranchView,$systemParametersBody);
			
			//Bank Branch View End
			
			// Bank Account No View  Start
			$BankAccView 		= '';
			$BankAccViewQuery 	= "
										SELECT
												acc.ACCOUNTNO,
												b.BANKNAME,
												br.BRANCHNAME,
												acc.DESCRIPTION
										FROM
												fna_bankaccount acc, fna_bank b, fna_branch br
										WHERE b.BANKID = br.BANKID
										AND br.BRANCHID = acc.BRANCHID
										ORDER BY
												b.BANKNAME
										ASC
									";
			$sv	= 1;
			$BankAccViewQueryStatement					= mysql_query($BankAccViewQuery);
			while($BankAccViewQueryStatementData		= mysql_fetch_array($BankAccViewQueryStatement)) {
				$ACCOUNTNO   							= $BankAccViewQueryStatementData["ACCOUNTNO"];
				$BANKNAME   							= $BankAccViewQueryStatementData["BANKNAME"];
				$BRANCHNAME   							= $BankAccViewQueryStatementData["BRANCHNAME"];
				$DESCRIPTION   							= $BankAccViewQueryStatementData["DESCRIPTION"];
				
				$BankAccView .= "<tr valign='top' class='$class'>
									<td >{$sv}</td>
									<td >{$BANKNAME}</td>
									<td >{$BRANCHNAME}</td>
									<td >{$ACCOUNTNO}</td>
									<td >{$DESCRIPTION}</td>
									<td align='center'>
									<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' />
									</td>
								</tr>";
				
				$sv++;
			}
			$systemParametersBody = str_replace('<!--%[BANK_ACCOUNT_VIEW]%-->',$BankAccView,$systemParametersBody);
			
			//Bank Account No View End
			
			// Project View  Start
			$projView 		= '';
			$projViewQuery 	= "
										SELECT
												PROJECTNAME
										FROM
												fna_project 
										ORDER BY
												PROJECTNAME
										ASC
									";
			$sv	= 1;
			$projViewQueryStatement				= mysql_query($projViewQuery);
			while($projViewQueryStatementData	= mysql_fetch_array($projViewQueryStatement)) {
				if($sv%2==0) {
					$class	= "evenRow";
				} else {
					$class	= "oddRow";
				}
				
				$PROJECTNAME   = $projViewQueryStatementData["PROJECTNAME"];
				
				$projView .= "<tr valign='top' class='$class'>
									<td >{$sv}</td>
									<td >{$PROJECTNAME}</td>
									<td align='center'>
									<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' />
									</td>
								</tr>";
				
				$sv++;
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_VIEW]%-->',$projView,$systemParametersBody);
			
			//Project View End
			
			//Sub Project View  Start
			$SubProjView 		= '';
			$SubProjViewQuery 	= "
										SELECT
												PROJECTID, PROJECTNAME
										FROM
												fna_project 
										ORDER BY
												PROJECTNAME
										ASC
									";
			$sv								= 1;
			$SubProjViewQueryStatement				= mysql_query($SubProjViewQuery);
			while($SubProjViewQueryStatementData		= mysql_fetch_array($SubProjViewQueryStatement)) {
				if($sv%2==0) {
					$class	= "evenRow";
				} else {
					$class	= "oddRow";
				}
						$PROJECTID 			= $SubProjViewQueryStatementData["PROJECTID"];
						$PROJECTNAME   		= $SubProjViewQueryStatementData["PROJECTNAME"];
						$querySubProj	 	= "
												SELECT
														SUBPROJECTNAME
												FROM
														fna_subproject 
												WHERE PROJECTID = {$PROJECTID}
											";
											
						$querySubProjStatement					= mysql_query($querySubProj);
						while($querySubProjStatementData		= mysql_fetch_array($querySubProjStatement)) {
							$SUBPROJECTNAME   					= $querySubProjStatementData["SUBPROJECTNAME"];
							
						
						$SubProjView .= "<tr valign='top' class='$class'>
											<td >{$sv}</td>
											<td >{$PROJECTNAME}</td>
											<td >{$SUBPROJECTNAME}</td>
											<td align='center'>
											<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' />
											</td>
										</tr>";
						
						$sv++;
					}
			}
			$systemParametersBody = str_replace('<!--%[SUB_PROJECT_VIEW]%-->',$SubProjView,$systemParametersBody);
			
			//Sub Project View End
			
			// Expanse Head View  Start
			$pctView 		= '';
			$prodCatTypViewQuery 	= "
										SELECT
												EXPHEADNAME
										FROM
												fna_expense_head 
										ORDER BY
												EXPHEADNAME
										ASC
									";
			$sv								= 1;
			$prodCatTypViewQueryStatement				= mysql_query($prodCatTypViewQuery);
			while($prodCatTypViewQueryStatementData		= mysql_fetch_array($prodCatTypViewQueryStatement)) {
				if($sv%2==0) {
					$class	= "evenRow";
				} else {
					$class	= "oddRow";
				}
				
				$EXPHEADNAME   = $prodCatTypViewQueryStatementData["EXPHEADNAME"];
				
				$pctView .= "<tr valign='top' class='$class'>
									<td >{$sv}</td>
									<td >{$EXPHEADNAME}</td>
									<td align='center'>
									<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' />
									</td>
								</tr>";
				
				$sv++;
			}
			$systemParametersBody = str_replace('<!--%[EXPANSE_HEAD_VIEW]%-->',$pctView,$systemParametersBody);
			
			//Expanse Head View End
			
			// Income Head View  Start
			$pctView 		= '';
			$prodCatTypViewQuery 	= "
										SELECT
												INCHEADNAME
										FROM
												fna_income_head 
										ORDER BY
												INCHEADNAME
										ASC
									";
			$sv								= 1;
			$prodCatTypViewQueryStatement				= mysql_query($prodCatTypViewQuery);
			while($prodCatTypViewQueryStatementData		= mysql_fetch_array($prodCatTypViewQueryStatement)) {
				if($sv%2==0) {
					$class	= "evenRow";
				} else {
					$class	= "oddRow";
				}
				
				$INCHEADNAME   = $prodCatTypViewQueryStatementData["INCHEADNAME"];
				
				$pctView .= "<tr valign='top' class='$class'>
									<td >{$sv}</td>
									<td >{$INCHEADNAME}</td>
									<td align='center'>
									<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' />
									</td>
								</tr>";
				
				$sv++;
			}
			$systemParametersBody = str_replace('<!--%[INCOME_HEAD_VIEW]%-->',$pctView,$systemParametersBody);
			
			//Income Head View End
			
			//Expanse Sub Head View  Start
			$expSubHeadView 		= '';
			$ExpSubHeadViewQuery 	= "
										SELECT
												EXPHID, EXPHEADNAME
										FROM
												fna_expense_head 
										ORDER BY
												EXPHEADNAME
										ASC
									";
			$sv								= 1;
			$ExpSubHeadViewQueryStatement				= mysql_query($ExpSubHeadViewQuery);
			while($ExpSubHeadViewQueryStatementData		= mysql_fetch_array($ExpSubHeadViewQueryStatement)) {
				if($sv%2==0) {
					$class	= "evenRow";
				} else {
					$class	= "oddRow";
				}
						$EXPHID   			= $ExpSubHeadViewQueryStatementData["EXPHID"];
						$EXPHEADNAME   		= $ExpSubHeadViewQueryStatementData["EXPHEADNAME"];
						$queryExpSubHead 	= "
												SELECT
														SUBHEADNAME
												FROM
														fna_expsubhead 
												WHERE EXPHID = {$EXPHID}
											";
											
						$queryExpSubHeadStatement					= mysql_query($queryExpSubHead);
						while($queryExpSubHeadStatementData		= mysql_fetch_array($queryExpSubHeadStatement)) {
							$SUBHEADNAME   = $queryExpSubHeadStatementData["SUBHEADNAME"];
							
						
						$expSubHeadView .= "<tr valign='top' class='$class'>
											<td >{$sv}</td>
											<td >{$EXPHEADNAME}</td>
											<td >{$SUBHEADNAME}</td>
											<td align='center'>
											<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' />
											</td>
										</tr>";
						
						$sv++;
					}
			}
			$systemParametersBody = str_replace('<!--%[EXPANSE_SUB_HEAD_VIEW]%-->',$expSubHeadView,$systemParametersBody);
			
			//Expanse Sub Head View End
			
			//Alu Fare View  Start
			$aluFareView 		= '';
			$aluFareViewQuery 	= "
										SELECT
												pf.PRODUCTID, 
												pf.PROJECTID, 
												pf.SUBPROJECTID, 
												pf.PACKINGUNITID, 
												pf.UNITFARE,
												p.PRODUCTNAME,
												proj.PROJECTNAME,
												sproj.SUBPROJECTNAME
										FROM
												fna_productfare pf, fna_product p, fna_project proj, fna_subproject sproj
										WHERE 	pf.PRODUCTID = p.PRODUCTID
										AND p.PROJECTID = proj.PROJECTID
										AND proj.PROJECTID = sproj.PROJECTID
											AND p.PRODUCTID = 71 
											AND sproj.SUBPROJECTID = 1
										ORDER BY
												p.PRODUCTNAME
										ASC
									";
			$sv											= 1;
			$aluFareViewQueryStatement					= mysql_query($aluFareViewQuery);
			while($aluFareViewQueryStatementData		= mysql_fetch_array($aluFareViewQueryStatement)) {
				  $PRODUCTNAME   						= $aluFareViewQueryStatementData["PRODUCTNAME"];
				  $PROJECTNAME   						= $aluFareViewQueryStatementData["PROJECTNAME"];
				  $SUBPROJECTNAME  						= $aluFareViewQueryStatementData["SUBPROJECTNAME"];
				  $UNITFARE		   						= $aluFareViewQueryStatementData["UNITFARE"];
				  $PACKINGUNITID   						= $aluFareViewQueryStatementData["PACKINGUNITID"];
						
			$aluFareView .= "<tr valign='top' class='$class'>
									<td >{$sv}</td>
									<td >{$PROJECTNAME}</td>
									<td >{$SUBPROJECTNAME}</td>
									<td >{$PRODUCTNAME}</td>
									<td >{$PACKINGUNITID}</td>
									<td >{$UNITFARE}</td>
									<td align='center'>
									<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' />
									</td>
								</tr>";
				
			$sv++;
		}
		
			$systemParametersBody = str_replace('<!--%[ALU_FARE_VIEW]%-->',$aluFareView,$systemParametersBody);
			
			//Alu Fare View End
			
			//Product Fare View  Start
			$ProdFareView 		= '';
			$ProdFareViewQuery 	= "
										SELECT
												pf.PRODUCTID, 
												pf.PROJECTID, 
												pf.SUBPROJECTID, 
												pf.PRODCATTYPEID, 
												pf.UNITFARE,
												p.PRODUCTNAME,
												proj.PROJECTNAME
										FROM
												fna_productfare pf, fna_product p, fna_project proj
										WHERE 	pf.PRODUCTID = p.PRODUCTID
										AND p.PROJECTID = proj.PROJECTID
										AND p.PRODUCTID != 71 
										ORDER BY
												pf.PRODCATTYPEID
										ASC
									";
			$sv											= 1;
			$ProdFareViewQueryStatement					= mysql_query($ProdFareViewQuery);
			while($ProdFareViewQueryStatementData		= mysql_fetch_array($ProdFareViewQueryStatement)) {
				  $PRODUCTNAME   						= $ProdFareViewQueryStatementData["PRODUCTNAME"];
				  $PROJECTNAME   						= $ProdFareViewQueryStatementData["PROJECTNAME"];
				  $UNITFARE		   						= $ProdFareViewQueryStatementData["UNITFARE"];
				  $PROJECTID	   						= $ProdFareViewQueryStatementData["PROJECTID"];
				  $PRODCATTYPEID   						= $ProdFareViewQueryStatementData["PRODCATTYPEID"];
				  
				  
			$querySubProjName 	= "
									SELECT
											CATEGORYTYPENAME
									FROM
											fna_productcattype 
									WHERE PRODCATTYPEID = {$PRODCATTYPEID}
								";
								
			$querySubProjNameStatement					= mysql_query($querySubProjName);
			while($querySubProjNameStatementData		= mysql_fetch_array($querySubProjNameStatement)) {
				$CATEGORYTYPENAME							= $querySubProjNameStatementData["CATEGORYTYPENAME"];
				  
			}
				  	
			$ProdFareView .= "<tr valign='top' class='$class'>
									<td >{$sv}</td>
									<td >{$PROJECTNAME}</td>
									<td >{$CATEGORYTYPENAME}</td>
									<td >{$PRODUCTNAME}</td>
									<td >".number_format($UNITFARE,2)."</td>
									<td align='center'>
									<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' />
									</td>
								</tr>";
				
				
				
				$sv++;
			}
			$systemParametersBody = str_replace('<!--%[PROD_FARE_VIEW]%-->',$ProdFareView,$systemParametersBody);
			
			//Product Fare View End
			
			// Product View  Start
			$prodView 		= '';
			$prodViewQuery 	= "
										SELECT
												PROJECTID,
												SUBPROJECTID,
												PRODCATTYPEID, 
												CATEGORYTYPENAME
										FROM
												fna_productcattype 
										ORDER BY
												CATEGORYTYPENAME
										ASC
									";
			$sv								= 1;
			$prodViewQueryStatement				= mysql_query($prodViewQuery);
			while($prodViewQueryStatementData		= mysql_fetch_array($prodViewQueryStatement)) {
				if($sv%2==0) {
					$class	= "evenRow";
				} else {
					$class	= "oddRow";
				}
						$PROJECTID_PROD	  	= $prodViewQueryStatementData["PROJECTID"];
						$SUBPROJECTID_PROD	= $prodViewQueryStatementData["SUBPROJECTID"];
						$PRODCATTYPEID   	= $prodViewQueryStatementData["PRODCATTYPEID"];
						$CATEGORYTYPENAME   = $prodViewQueryStatementData["CATEGORYTYPENAME"];
						$queryProduct = "
												SELECT
														PRODUCTNAME
												FROM
														fna_product 
												WHERE PRODCATTYPEID = {$PRODCATTYPEID}
											";
											
						$queryProductStatement					= mysql_query($queryProduct);
						while($queryProductStatementData		= mysql_fetch_array($queryProductStatement)) {
							$PRODUCTNAME   = $queryProductStatementData["PRODUCTNAME"];
						
						
						$QueryProject = " SELECT PROJECTNAME FROM fna_project WHERE PROJECTID = '".$PROJECTID_PROD."'";
						$QueryProjectStatement = mysql_query($QueryProject);
						while($QueryProjectStatementData 	= mysql_fetch_array($QueryProjectStatement)){
							$PROJECTNAME_PROD	  	 		= $QueryProjectStatementData["PROJECTNAME"];
						}
						
						$QuerySubProject = " SELECT SUBPROJECTNAME FROM fna_subproject WHERE SUBPROJECTID = '".$SUBPROJECTID_PROD."'";
						$QuerySubProjectStatement 				= mysql_query($QuerySubProject);
						while($QuerySubProjectStatementData 	= mysql_fetch_array($QuerySubProjectStatement)){
							$SUBPROJECTNAME_PROD	  			= $QuerySubProjectStatementData["SUBPROJECTNAME"];
						}	
						
						$prodView .= "<tr valign='top' class='$class'>
											<td >{$sv}</td>
											<td >{$PROJECTNAME_PROD}</td>
											<td >{$SUBPROJECTNAME_PROD}</td>
											<td >{$CATEGORYTYPENAME}</td>
											<td >{$PRODUCTNAME}</td>
											<td align='center'>
											<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' />
											</td>
										</tr>";
						
						$sv++;
					}
			}
			$systemParametersBody = str_replace('<!--%[PROD_VIEW]%-->',$prodView,$systemParametersBody);
			
			//Product View End
			
			// Paltry Others Income View  Start
			
			$paltryOthersIncomeView 		= '';
			$palOthersInViewQuery 	= "
										SELECT
												PROJECTID,
												SUBPROJECTID,
												INCOMEHEAD, 
												REMARKS
										FROM
												pal_others_income 
										ORDER BY
												INCOMEHEAD
										ASC
									";
			$sv								= 1;
			$palOthersInViewQueryStatement				= mysql_query($palOthersInViewQuery);
			while($palOthersInViewQueryStatementData		= mysql_fetch_array($palOthersInViewQueryStatement)) {
				if($sv%2==0) {
					$class	= "evenRow";
				} else {
					$class	= "oddRow";
				}
						$PROJECTID_PROD	  	= $palOthersInViewQueryStatementData["PROJECTID"];
						$SUBPROJECTID_PROD	= $palOthersInViewQueryStatementData["SUBPROJECTID"];
						$INCOMEHEAD		   	= $palOthersInViewQueryStatementData["INCOMEHEAD"];
						$REMARKS		   = $palOthersInViewQueryStatementData["REMARKS"];
						
						$paltryOthersIncomeView .= "<tr valign='top' class='$class'>
											<td >{$sv}</td>
											<td >{$INCOMEHEAD}</td>
											<td >{$REMARKS}</td>
											<td align='center'>
											<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' />
											</td>
										</tr>";
						
						$sv++;
					}
			
			$systemParametersBody = str_replace('<!--%[PALTRY_OTHERS_INCOME_VIEW]%-->',$paltryOthersIncomeView,$systemParametersBody);
			
			//Paltry Others Income View End
			
			// Paltry Others Income View  Start
			
			$paltryOthersExpView 		= '';
			$palOthersExpViewQuery 	= "
										SELECT
												PROJECTID,
												SUBPROJECTID,
												EXPANSEHEAD, 
												REMARKS
										FROM
												pal_others_expanse 
										ORDER BY
												EXPANSEHEAD
										ASC
									";
			$sv								= 1;
			$palOthersExpViewQueryStatement					= mysql_query($palOthersExpViewQuery);
			while($palOthersExpViewQueryStatementData		= mysql_fetch_array($palOthersExpViewQueryStatement)) {
				if($sv%2==0) {
					$class	= "evenRow";
				} else {
					$class	= "oddRow";
				}
						$PROJECTID_PROD	  	= $palOthersExpViewQueryStatementData["PROJECTID"];
						$SUBPROJECTID_PROD	= $palOthersExpViewQueryStatementData["SUBPROJECTID"];
						$EXPANSEHEAD	   	= $palOthersExpViewQueryStatementData["EXPANSEHEAD"];
						$REMARKS		    = $palOthersExpViewQueryStatementData["REMARKS"];
						
						$paltryOthersExpView .= "<tr valign='top' class='$class'>
											<td >{$sv}</td>
											<td >{$EXPANSEHEAD}</td>
											<td >{$REMARKS}</td>
											<td align='center'>
											<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' />
											</td>
										</tr>";
						
						$sv++;
					}
			
			$systemParametersBody = str_replace('<!--%[PALTRY_OTHERS_EXPANSE_VIEW]%-->',$paltryOthersExpView,$systemParametersBody);
			
			//Paltry Others Income View End
			
			/*// Packing Unit View  Start
			$ptView 		= '';
			$ptViewQuery 	= "
									SELECT
											PACKINGNAMEID, QID, WTID
									FROM
											fna_packingunit 
									ORDER BY
											PACKINGNAMEID
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
				
				$PACKINGNAMEID   	= $ptViewStatementData["PACKINGNAMEID"];
				$QID			   	= $ptViewStatementData["QID"];
				$WTID			   	= $ptViewStatementData["WTID"];
				
				$queryName = "
									SELECT
											PACKINGNAME
									FROM
											fna_packingname 
									WHERE PACKINGNAMEID = {$PACKINGNAMEID}
								";
				
				$ptView .= "<tr valign='top' class='$class'>
									<td >{$sv}</td>
									<td >{$WNAME}</td>
									<td align='center'>
									<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' />
									</td>
								</tr>";
				
				$sv++;
			}
			$systemParametersBody = str_replace('<!--%[PACKING_UNIT_VIEW_KOMOL]%-->',$ptView,$systemParametersBody);
			
			//Packing Unit View End*/
			
			// Packing Unit Start
			$packingNameVal 					= '';
			$PackingQuery 						= "SELECT PACKINGNAMEID,PACKINGNAME FROM fna_packingname ORDER BY PACKINGNAME ASC";
			$PackingQueryStatement				= mysql_query($PackingQuery);
			while($PackingQueryStatementData	= mysql_fetch_array($PackingQueryStatement)) {
				$packingId						= $PackingQueryStatementData["PACKINGNAMEID"];
				$packingName					= $PackingQueryStatementData["PACKINGNAME"];
				$packingNameVal 					.= "<option value='".$packingId."'>".$packingName."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PACKING_NAME_NEW]%-->',$packingNameVal,$systemParametersBody);
			
			$packingNameVal 	= '';
			$packingViewQuery 	= "
									SELECT
											PACKINGUNITID,
											PACKINGNAMEID,
											QID,
											WTID
									FROM
											fna_packingunit 
									ORDER BY
											PACKINGUNITID
									ASC
								";
			$sv								= 1;
			$packingViewQueryStatement				= mysql_query($packingViewQuery);
			while($packingViewQueryStatementData	= mysql_fetch_array($packingViewQueryStatement)) {
				if($sv%2==0) {
					$class	= "evenRow";
				} else {
					$class	= "oddRow";
				}
				
				$PACKINGUNITID   		= $packingViewQueryStatementData["PACKINGUNITID"];
				$PACKINGNAMEID   		= $packingViewQueryStatementData["PACKINGNAMEID"];
				$QID			   		= $packingViewQueryStatementData["QID"];
				$WTID			   		= $packingViewQueryStatementData["WTID"];
				
				$packingNameQuery = "
									SELECT
											PACKINGNAMEID,
											PACKINGNAME
									FROM
											fna_packingname 
											WHERE PACKINGNAMEID = {$PACKINGNAMEID}
											ORDER BY PACKINGNAME ASC
									";
				$packingNameQueryStatement				= mysql_query($packingNameQuery);
				while($packingNameQueryStatementData	= mysql_fetch_array($packingNameQueryStatement)) {
					$PACKINGNAMEID_NEW   		= $packingNameQueryStatementData["PACKINGNAMEID"];
					$PACKINGNAME_NEW   			= $packingNameQueryStatementData["PACKINGNAME"];
					
				}
				
				$QidQuery = "
									SELECT
											QVALUE
									FROM
											fna_quantity 
											WHERE QID = {$QID}
									";
				$QidQueryStatement				= mysql_query($QidQuery);
				while($QidQueryStatementData	= mysql_fetch_array($QidQueryStatement)) {
					$QVALUE   		= $QidQueryStatementData["QVALUE"];
					
				}
				
				$wtidQuery = "
									SELECT
											WNAME
									FROM
											fna_weight 
											WHERE WTID = {$WTID}
									";
				$wtidQueryStatement				= mysql_query($wtidQuery);
				while($wtidQueryStatementData	= mysql_fetch_array($wtidQueryStatement)) {
					$WNAME   		= $wtidQueryStatementData["WNAME"];
					
				}
			
			
			$packingNameVal 					.= "<option value='".$PACKINGUNITID."'>".$PACKINGNAME_NEW.", ".$QVALUE.",".$WNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PACKING_NAME]%-->',$packingNameVal,$systemParametersBody);
			
			$QuantityVal 						= '';
			$quantityQuery 						= "SELECT QID,QVALUE FROM fna_quantity ORDER BY QVALUE ASC";
			$quantityQueryStatement				= mysql_query($quantityQuery);
			while($quantityQueryStatementData	= mysql_fetch_array($quantityQueryStatement)) {
				$qId							= $quantityQueryStatementData["QID"];
				$qValue							= $quantityQueryStatementData["QVALUE"];
				$QuantityVal 					.= "<option value='".$qId."'>".$qValue."</option>";
			}
			$systemParametersBody = str_replace('<!--%[QUANTITY]%-->',$QuantityVal,$systemParametersBody);
			
			$weightTypeVal 							= '';
			$weightTypeQuery 						= "SELECT WTID,WNAME FROM fna_weight ORDER BY WNAME ASC";
			$weightTypeQueryStatement				= mysql_query($weightTypeQuery);
			while($weightTypeQueryStatementData		= mysql_fetch_array($weightTypeQueryStatement)) {
				$wtId								= $weightTypeQueryStatementData["WTID"];
				$wtName								= $weightTypeQueryStatementData["WNAME"];
				$weightTypeVal 						.= "<option value='".$wtId."'>".$wtName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[WEIGHTTYPE]%-->',$weightTypeVal,$systemParametersBody);
			
			
			$packingUnitView 		= '';
			$packingViewQuery 	= "
									SELECT
											PACKINGUNITID,
											PACKINGNAMEID,
											QID,
											WTID
									FROM
											fna_packingunit 
									ORDER BY
											PACKINGUNITID
									ASC
								";
			$sv								= 1;
			$packingViewQueryStatement				= mysql_query($packingViewQuery);
			while($packingViewQueryStatementData	= mysql_fetch_array($packingViewQueryStatement)) {
				if($sv%2==0) {
					$class	= "evenRow";
				} else {
					$class	= "oddRow";
				}
				
				$PACKINGUNITID   		= $packingViewQueryStatementData["PACKINGUNITID"];
				$PACKINGNAMEID   		= $packingViewQueryStatementData["PACKINGNAMEID"];
				$QID			   		= $packingViewQueryStatementData["QID"];
				$WTID			   		= $packingViewQueryStatementData["WTID"];
				
				$packingNameQuery = "
									SELECT
											PACKINGNAME
									FROM
											fna_packingname 
											WHERE PACKINGNAMEID = {$PACKINGNAMEID}
									";
				$packingNameQueryStatement				= mysql_query($packingNameQuery);
				while($packingNameQueryStatementData	= mysql_fetch_array($packingNameQueryStatement)) {
					$PACKINGNAME_NEW   		= $packingNameQueryStatementData["PACKINGNAME"];
					
				}
				
				$QidQuery = "
									SELECT
											QVALUE
									FROM
											fna_quantity 
											WHERE QID = {$QID}
									";
				$QidQueryStatement				= mysql_query($QidQuery);
				while($QidQueryStatementData	= mysql_fetch_array($QidQueryStatement)) {
					$QVALUE   		= $QidQueryStatementData["QVALUE"];
					
				}
				
				$wtidQuery = "
									SELECT
											WNAME
									FROM
											fna_weight 
											WHERE WTID = {$WTID}
									";
				$wtidQueryStatement				= mysql_query($wtidQuery);
				while($wtidQueryStatementData	= mysql_fetch_array($wtidQueryStatement)) {
					$WNAME   		= $wtidQueryStatementData["WNAME"];
					
				}
				
				$packingUnitView .= "<tr valign='top' class='$class'>
									<td >{$sv}</td>
									<td >{$PACKINGNAME_NEW}</td>
									<td >{$QVALUE }</td>
									<td >{$WNAME}</td>
									<td align='center'>
									<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' />
									</td>
								</tr>";
				
				$sv++;
			}
			$systemParametersBody = str_replace('<!--%[PACKING_UNIT_VIEW]%-->',$packingUnitView,$systemParametersBody);
			
			//Packing Unit View End
			
			// Product View  Start
			
			$prodNameVal 				= '';
			$prodQuery 				= "SELECT PRODCATTYPEID, CATEGORYTYPENAME FROM fna_productcattype ORDER BY CATEGORYTYPENAME ASC";
			$prodQueryStatement				= mysql_query($prodQuery);
			while($prodQueryStatementData	= mysql_fetch_array($prodQueryStatement)) {
				$productCatTypeId				= $prodQueryStatementData["PRODCATTYPEID"];
				$catName						= $prodQueryStatementData["CATEGORYTYPENAME"];
				$prodNameVal 					.= "<option value='".$productCatTypeId."'>".$catName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT_NAME]%-->',$prodNameVal,$systemParametersBody);
			// Product View  End
			
			// Bank View  Start
			
			$BankNameVal 				= '';
			$BankQuery 				= "SELECT BANKID, BANKNAME FROM fna_bank ORDER BY BANKNAME ASC";
			$BankQueryStatement				= mysql_query($BankQuery);
			while($BankQueryStatementData	= mysql_fetch_array($BankQueryStatement)) {
				$BANKID						= $BankQueryStatementData["BANKID"];
				$BANKNAME					= $BankQueryStatementData["BANKNAME"];
				$BankNameVal 				.= "<option value='".$BANKID."'>".$BANKNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[BANK_NAME]%-->',$BankNameVal,$systemParametersBody);
			// Bank View  End
			
			// Floor View  Start
			
			$FloorVal 						= '';
			$FloorQuery 					= "SELECT CHID, CHNAME FROM fna_chamber ORDER BY CHNAME ASC";
			$FloorQueryStatement			= mysql_query($FloorQuery);
			while($FloorQueryStatementData	= mysql_fetch_array($FloorQueryStatement)) {
				$CHID						= $FloorQueryStatementData["CHID"];
				$CHNAME						= $FloorQueryStatementData["CHNAME"];
				$FloorVal	 				.= "<option value='".$CHID."'>".$CHNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[CHAMBER_NAME]%-->',$FloorVal,$systemParametersBody);
			// Floor View  End
			
			// Project View  Start
			
			$projNameVal 				= '';
			$projQuery 				= "SELECT PROJECTID, PROJECTNAME FROM fna_project ORDER BY PROJECTNAME ASC";
			$projQueryStatement				= mysql_query($projQuery);
			while($projQueryStatementData	= mysql_fetch_array($projQueryStatement)) {
				$PROJECTID					= $projQueryStatementData["PROJECTID"];
				$PROJECTNAME				= $projQueryStatementData["PROJECTNAME"];
				$projNameVal 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$projNameVal,$systemParametersBody);
			// Project View  End
			
			// Session Year View  Start
			
			$SessionYearVal			= '';
			$SessionYearQuery 						= "SELECT SESSIONYEARID, SESSIONYEAR FROM fna_sessionyear ORDER BY SESSIONYEAR ASC";
			$SessionYearQueryStatement				= mysql_query($SessionYearQuery);
			while($SessionYearQueryStatementData	= mysql_fetch_array($SessionYearQueryStatement)) {
				$SESSIONYEARID						= $SessionYearQueryStatementData["SESSIONYEARID"];
				$SESSIONYEAR						= $SessionYearQueryStatementData["SESSIONYEAR"];
				$SessionYearVal 					.= "<option value='".$SESSIONYEARID."'>".$SESSIONYEAR."</option>";
			}
			$systemParametersBody = str_replace('<!--%[SESSION_YEAR]%-->',$SessionYearVal,$systemParametersBody);
			// Session Year View  End
			
			
			// Expanse Head View  Start
			
			$ExpHeadNameVal 					= '';
			$ExpHeadQuery 						= "SELECT EXPHID, EXPHEADNAME FROM fna_expense_head ORDER BY EXPHEADNAME ASC";
			$ExpHeadQueryStatement				= mysql_query($ExpHeadQuery);
			while($ExpHeadQueryStatementData	= mysql_fetch_array($ExpHeadQueryStatement)) {
				$EXPHID							= $ExpHeadQueryStatementData["EXPHID"];
				$EXPHEADNAME					= $ExpHeadQueryStatementData["EXPHEADNAME"];
				$ExpHeadNameVal 					.= "<option value='".$EXPHID."'>".$EXPHEADNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[EXPANSE_HEAD_NAME]%-->',$ExpHeadNameVal,$systemParametersBody);
			// Expanse Head View  End
			
			// PROJECT View  Start
			
			$ProjNameVal 						= '';
			$ProjQuery 							= "SELECT PROJECTID, PROJECTNAME FROM fna_project ORDER BY PROJECTNAME ASC";
			$ProjQueryStatement					= mysql_query($ProjQuery);
			while($ProjQueryStatementData		= mysql_fetch_array($ProjQueryStatement)) {
				$PROJECTID						= $ProjQueryStatementData["PROJECTID"];
				$PROJECTNAME					= $ProjQueryStatementData["PROJECTNAME"];
				$ProjNameVal	 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$ProjNameVal,$systemParametersBody);
			// PROJECT View  End
			
			//Labour Name View
			$labourNameVal 				= '';
			$labourQuery 				= "SELECT LABOURID, LABOURNAME FROM fna_labour ORDER BY LABOURNAME ASC";
			$labourQueryStatement				= mysql_query($labourQuery);
			while($labourQueryStatementData	= mysql_fetch_array($labourQueryStatement)) {
				$labourId						= $labourQueryStatementData["LABOURID"];
				$labourName						= $labourQueryStatementData["LABOURNAME"];
				$labourNameVal 					.= "<option value='".$labourId."'>".$labourName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[LABOUR_NAME]%-->',$labourNameVal,$systemParametersBody);
			
			$prodCatTypeVal						= '';
			$prodCatQuery 						= "SELECT PRODUCTID,PRODUCTNAME FROM fna_product ORDER BY PRODUCTNAME ASC";
			$prodCatQueryStatement				= mysql_query($prodCatQuery);
			while($prodCatQueryStatementData	= mysql_fetch_array($prodCatQueryStatement)) {
				$PRODUCTID						= $prodCatQueryStatementData["PRODUCTID"];
				$PRODUCTNAME					= $prodCatQueryStatementData["PRODUCTNAME"];
				$prodCatTypeVal					.= "<option value='".$PRODUCTID."'>".$PRODUCTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT]%-->',$prodCatTypeVal,$systemParametersBody);
			
			$QuantityVal 						= '';
			$quantityQuery 						= "SELECT QID,QVALUE FROM fna_quantity ORDER BY QVALUE ASC";
			$quantityQueryStatement				= mysql_query($quantityQuery);
			while($quantityQueryStatementData	= mysql_fetch_array($quantityQueryStatement)) {
				$qId							= $quantityQueryStatementData["QID"];
				$qValue							= $quantityQueryStatementData["QVALUE"];
				$QuantityVal 					.= "<option value='".$qId."'>".$qValue."</option>";
			}
			$systemParametersBody = str_replace('<!--%[QUANTITY]%-->',$QuantityVal,$systemParametersBody);
			
			$weightTypeVal 							= '';
			$weightTypeQuery 						= "SELECT WTID,WNAME FROM fna_weight ORDER BY WNAME ASC";
			$weightTypeQueryStatement				= mysql_query($weightTypeQuery);
			while($weightTypeQueryStatementData		= mysql_fetch_array($weightTypeQueryStatement)) {
				$wtId								= $weightTypeQueryStatementData["WTID"];
				$wtName								= $weightTypeQueryStatementData["WNAME"];
				$weightTypeVal 						.= "<option value='".$wtId."'>".$wtName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[WEIGHTTYPE]%-->',$weightTypeVal,$systemParametersBody);
			
			
			//Product View End
			
			//Chamber From Start
			$chamberFromVal							= '';
			$chamberFromQuery 						= "SELECT CHID, CHNAME FROM fna_chamber ORDER BY CHNAME ASC";
			$chamberFromQueryStatement				= mysql_query($chamberFromQuery);
			while($chamberFromQueryStatementData	= mysql_fetch_array($chamberFromQueryStatement)) {
				$chamberId							= $chamberFromQueryStatementData["CHID"];
				$chamberName						= $chamberFromQueryStatementData["CHNAME"];
				$chamberFromVal 					.= "<option value='".$chamberId."'>".$chamberName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[CHAMBER_FROM]%-->',$chamberFromVal,$systemParametersBody);
			//Chamber From End
			
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
		
		//System Bank Transaction  Entry Start
		function getBankTransaction($empId) {
			$systemParametersBody = $this->getTemplateContent('fnaBankTransaction');
			
			// Project View  Start
			
			$projNameVal 				= '';
			$projQuery 				= "SELECT PROJECTID, PROJECTNAME FROM fna_project WHERE PROJECTID = 8 ORDER BY PROJECTNAME ASC";
			$projQueryStatement				= mysql_query($projQuery);
			while($projQueryStatementData	= mysql_fetch_array($projQueryStatement)) {
				$PROJECTID					= $projQueryStatementData["PROJECTID"];
				$PROJECTNAME				= $projQueryStatementData["PROJECTNAME"];
				$projNameVal 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$projNameVal,$systemParametersBody);
			// Project View  End
			
			// Bank View  Start
			
			$BankNameVal 				= '';
			$BankQuery 				= "SELECT BANKID, BANKNAME FROM fna_bank ORDER BY BANKNAME ASC";
			$BankQueryStatement				= mysql_query($BankQuery);
			while($BankQueryStatementData	= mysql_fetch_array($BankQueryStatement)) {
				$BANKID						= $BankQueryStatementData["BANKID"];
				$BANKNAME					= $BankQueryStatementData["BANKNAME"];
				$BankNameVal 				.= "<option value='".$BANKID."'>".$BANKNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[BANK_NAME]%-->',$BankNameVal,$systemParametersBody);
			// Bank View  End
					
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
		//System Bank Transaction Entry  End
		
		//System Load Entry Start
		function getLoadEntry($empId) {
			$systemParametersBody = $this->getTemplateContent('fnaLoad');
			/*
			// Project View  Start
			$DB_HOST = "203.76.109.92";		
			$DB_NAME = "employee_info";
			$DB_USER = "devuser";
			$DB_PASSW = "$dpuseR";
			$Database2 = mysql_connect($DB_HOST, $DB_USER, $DB_PASSW) or die("ERROR: MYSQL CONNECTION ERROR...");
			mysql_select_db($DB_NAME, $Database2) or die(mysql_error($Database2));
			
			$projNameVal 				= '';
			$projQuery 				= "SELECT id, name FROM employees ORDER BY name ASC";
			$projQueryStatement				= mysql_query($projQuery);
			while($projQueryStatementData	= mysql_fetch_array($projQueryStatement)) {
				$id					= $projQueryStatementData["id"];
				$name				= $projQueryStatementData["name"];
				$projNameVal 				.= "<option value='".$id."'>".$name."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME1]%-->',$projNameVal,$systemParametersBody);
			// Project View  End
			*/
			// Project View  Start
			
			$projNameVal 				= '';
			$projQuery 				= "SELECT PROJECTID, PROJECTNAME FROM fna_project ORDER BY PROJECTNAME ASC";
			$projQueryStatement				= mysql_query($projQuery);
			while($projQueryStatementData	= mysql_fetch_array($projQueryStatement)) {
				$PROJECTID					= $projQueryStatementData["PROJECTID"];
				$PROJECTNAME				= $projQueryStatementData["PROJECTNAME"];
				$projNameVal 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$projNameVal,$systemParametersBody);
			// Project View  End
			
			// Product Load Unload No  Start
			
			$maxLoadNo		= mysql_fetch_array(mysql_query("SELECT MAX(PRODUCTLOADUNLOADID) FROM fna_productloadunload"));
			$NowmaxLoadNo	= $maxLoadNo['MAX(PRODUCTLOADUNLOADID)'] + 1;
			$systemParametersBody = str_replace('<!--%[LOADUNLOAD_VIEW]%-->',$NowmaxLoadNo,$systemParametersBody);
			// Product Load Unload No  End
			
			// Labour View Start
			$ptView 		= '';
			$ptViewQuery 	= "
									SELECT
											LABOURNAME,
											FATHERNAME,
											ADDRESS,
											MOBILE
									FROM
											fna_labour 
									ORDER BY
											LABOURNAME
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
				
				$LABOURNAME   = $ptViewStatementData["LABOURNAME"];
				$FATHERNAME   = $ptViewStatementData["FATHERNAME"];
				$ADDRESS      = $ptViewStatementData["ADDRESS"];
				$MOBILE       = $ptViewStatementData["MOBILE"];
				
				$ptView .= "<tr valign='top' class='$class'>
									<td >{$sv}</td>
									<td >{$LABOURNAME}</td>
									<td >{$FATHERNAME}</td>
									<td >{$ADDRESS}</td>
									<td >{$MOBILE}</td>
									<td align='center'>
									<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' />
									</td>
								</tr>";
				
				$sv++;
			}
			$systemParametersBody = str_replace('<!--%[LABOUR_VIEW]%-->',$ptView,$systemParametersBody);
			
			//Labour View End
			
			// Product View  Start
			
			$prodNameVal 				= '';
			$prodQuery 				= "SELECT PRODCATTYPEID, CATEGORYTYPENAME FROM fna_productcattype ORDER BY CATEGORYTYPENAME ASC";
			$prodQueryStatement				= mysql_query($prodQuery);
			while($prodQueryStatementData	= mysql_fetch_array($prodQueryStatement)) {
				$productCatTypeId				= $prodQueryStatementData["PRODCATTYPEID"];
				$catName						= $prodQueryStatementData["CATEGORYTYPENAME"];
				$prodNameVal 					.= "<option value='".$productCatTypeId."'>".$catName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT_NAME]%-->',$prodNameVal,$systemParametersBody);
			
			
			//Labour Name View
			$labourNameVal 				= '';
			$labourQuery 				= "SELECT LABOURID, LABOURNAME FROM fna_labour ORDER BY LABOURNAME ASC";
			$labourQueryStatement				= mysql_query($labourQuery);
			while($labourQueryStatementData	= mysql_fetch_array($labourQueryStatement)) {
				$labourId						= $labourQueryStatementData["LABOURID"];
				$labourName						= $labourQueryStatementData["LABOURNAME"];
				$labourNameVal 					.= "<option value='".$labourId."'>".$labourName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[LABOUR_NAME]%-->',$labourNameVal,$systemParametersBody);
			
			$PartyNameVal 				= '';
			$PartyQuery 				= "SELECT PARTYID, PARTYNAME FROM fna_party ORDER BY PARTYNAME ASC";
			$PartyQueryStatement				= mysql_query($PartyQuery);
			while($PartyQueryStatementData	= mysql_fetch_array($PartyQueryStatement)) {
				$PartyId						= $PartyQueryStatementData["PARTYID"];
				$PartyName						= $PartyQueryStatementData["PARTYNAME"];
				$PartyNameVal 					.= "<option value='".$PartyId."'>".$PartyName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$PartyNameVal,$systemParametersBody);
			
			$prodCatTypeVal						= '';
			$prodCatQuery 						= "SELECT PRODCATTYPEID,PRODUCTNAME FROM fna_product ORDER BY PRODUCTNAME ASC";
			$prodCatQueryStatement				= mysql_query($prodCatQuery);
			while($prodCatQueryStatementData	= mysql_fetch_array($prodCatQueryStatement)) {
				$PRODCATTYPEID					= $prodCatQueryStatementData["PRODCATTYPEID"];
				$PRODUCTNAME					= $prodCatQueryStatementData["PRODUCTNAME"];
				$prodCatTypeVal					.= "<option value='".$PRODCATTYPEID."'>".$PRODUCTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT]%-->',$prodCatTypeVal,$systemParametersBody);
			
			$QuantityVal 						= '';
			$quantityQuery 						= "SELECT QID,QVALUE FROM fna_quantity ORDER BY QVALUE ASC";
			$quantityQueryStatement				= mysql_query($quantityQuery);
			while($quantityQueryStatementData	= mysql_fetch_array($quantityQueryStatement)) {
				$qId							= $quantityQueryStatementData["QID"];
				$qValue							= $quantityQueryStatementData["QVALUE"];
				$QuantityVal 					.= "<option value='".$qId."'>".$qValue."</option>";
			}
			$systemParametersBody = str_replace('<!--%[QUANTITY]%-->',$QuantityVal,$systemParametersBody);
			
			$weightTypeVal 							= '';
			$weightTypeQuery 						= "SELECT WTID,WNAME FROM fna_weight ORDER BY WNAME ASC";
			$weightTypeQueryStatement				= mysql_query($weightTypeQuery);
			while($weightTypeQueryStatementData		= mysql_fetch_array($weightTypeQueryStatement)) {
				$wtId								= $weightTypeQueryStatementData["WTID"];
				$wtName								= $weightTypeQueryStatementData["WNAME"];
				$weightTypeVal 						.= "<option value='".$wtId."'>".$wtName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[WEIGHTTYPE]%-->',$weightTypeVal,$systemParametersBody);
			
			// Packing Unit Start
			$packingNameVal 					= '';
			$PackingQuery 						= "SELECT PACKINGNAMEID,PACKINGNAME FROM fna_packingname ORDER BY PACKINGNAME ASC";
			$PackingQueryStatement				= mysql_query($PackingQuery);
			while($PackingQueryStatementData	= mysql_fetch_array($PackingQueryStatement)) {
				$packingId						= $PackingQueryStatementData["PACKINGNAMEID"];
				$packingName					= $PackingQueryStatementData["PACKINGNAME"];
				$packingNameVal 					.= "<option value='".$packingId."'>".$packingName."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PACKING_NAME_NEW]%-->',$packingNameVal,$systemParametersBody);
			$packingNameVal 	= '';
			$packingViewQuery 	= "
									SELECT
											PACKINGUNITID,
											PACKINGNAMEID,
											QID,
											WTID
									FROM
											fna_packingunit 
									ORDER BY
											PACKINGUNITID
									ASC
								";
			$sv								= 1;
			$packingViewQueryStatement				= mysql_query($packingViewQuery);
			while($packingViewQueryStatementData	= mysql_fetch_array($packingViewQueryStatement)) {
				
				$PACKINGUNITID   		= $packingViewQueryStatementData["PACKINGUNITID"];
				$PACKINGNAMEID   		= $packingViewQueryStatementData["PACKINGNAMEID"];
				$QID			   		= $packingViewQueryStatementData["QID"];
				$WTID			   		= $packingViewQueryStatementData["WTID"];
				
				$packingNameQuery = "
									SELECT
											PACKINGNAMEID,
											PACKINGNAME
									FROM
											fna_packingname 
											WHERE PACKINGNAMEID = {$PACKINGNAMEID}
									";
				$packingNameQueryStatement				= mysql_query($packingNameQuery);
				while($packingNameQueryStatementData	= mysql_fetch_array($packingNameQueryStatement)) {
					$PACKINGNAMEID_NEW   		= $packingNameQueryStatementData["PACKINGNAMEID"];
					$PACKINGNAME_NEW   			= $packingNameQueryStatementData["PACKINGNAME"];
					
				}
				
				$QidQuery = "
									SELECT
											QVALUE
									FROM
											fna_quantity 
											WHERE QID = {$QID}
									";
				$QidQueryStatement				= mysql_query($QidQuery);
				while($QidQueryStatementData	= mysql_fetch_array($QidQueryStatement)) {
					$QVALUE   		= $QidQueryStatementData["QVALUE"];
					
				}
				
				$wtidQuery = "
									SELECT
											WNAME
									FROM
											fna_weight 
											WHERE WTID = {$WTID}
									";
				$wtidQueryStatement				= mysql_query($wtidQuery);
				while($wtidQueryStatementData	= mysql_fetch_array($wtidQueryStatement)) {
					$WNAME   		= $wtidQueryStatementData["WNAME"];
					
				}
			
			
			$packingNameVal 					.= "<option value='".$PACKINGUNITID."'>".$PACKINGNAME_NEW.", ".$QVALUE.",".$WNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PACKING_NAME]%-->',$packingNameVal,$systemParametersBody);
			
			//Product View End
			
			//Chamber From Start
			$chamberFromVal							= '';
			$chamberFromQuery 						= "SELECT CHID, CHNAME FROM fna_chamber ORDER BY CHID ASC";
			$chamberFromQueryStatement				= mysql_query($chamberFromQuery);
			while($chamberFromQueryStatementData	= mysql_fetch_array($chamberFromQueryStatement)) {
				$chamberId							= $chamberFromQueryStatementData["CHID"];
				$chamberName						= $chamberFromQueryStatementData["CHNAME"];
				$chamberFromVal 					.= "<option value='".$chamberId."'>".$chamberName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[CHAMBER_FROM]%-->',$chamberFromVal,$systemParametersBody);
			//Chamber From End
					
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
		//System Load Entry  End
		
		//System Load Entry Jaber Start
		function getLoadEntryJaber($empId) {
			$systemParametersBody = $this->getTemplateContent('fnaLoad070725');
			/*
			// Project View  Start
			$DB_HOST = "203.76.109.92";		
			$DB_NAME = "employee_info";
			$DB_USER = "devuser";
			$DB_PASSW = "$dpuseR";
			$Database2 = mysql_connect($DB_HOST, $DB_USER, $DB_PASSW) or die("ERROR: MYSQL CONNECTION ERROR...");
			mysql_select_db($DB_NAME, $Database2) or die(mysql_error($Database2));
			
			$projNameVal 				= '';
			$projQuery 				= "SELECT id, name FROM employees ORDER BY name ASC";
			$projQueryStatement				= mysql_query($projQuery);
			while($projQueryStatementData	= mysql_fetch_array($projQueryStatement)) {
				$id					= $projQueryStatementData["id"];
				$name				= $projQueryStatementData["name"];
				$projNameVal 				.= "<option value='".$id."'>".$name."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME1]%-->',$projNameVal,$systemParametersBody);
			// Project View  End
			*/
			// Project View  Start
			
			$projNameVal 				= '';
			$projQuery 				= "SELECT PROJECTID, PROJECTNAME FROM fna_project ORDER BY PROJECTNAME ASC";
			$projQueryStatement				= mysql_query($projQuery);
			while($projQueryStatementData	= mysql_fetch_array($projQueryStatement)) {
				$PROJECTID					= $projQueryStatementData["PROJECTID"];
				$PROJECTNAME				= $projQueryStatementData["PROJECTNAME"];
				$projNameVal 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$projNameVal,$systemParametersBody);
			// Project View  End
			
			// Product Load Unload No  Start
			
			$maxLoadNo		= mysql_fetch_array(mysql_query("SELECT MAX(PRODUCTLOADUNLOADID) FROM fna_productloadunload"));
			$NowmaxLoadNo	= $maxLoadNo['MAX(PRODUCTLOADUNLOADID)'] + 1;
			$systemParametersBody = str_replace('<!--%[LOADUNLOAD_VIEW]%-->',$NowmaxLoadNo,$systemParametersBody);
			// Product Load Unload No  End
			
			// Labour View Start
			$ptView 		= '';
			$ptViewQuery 	= "
									SELECT
											LABOURNAME,
											FATHERNAME,
											ADDRESS,
											MOBILE
									FROM
											fna_labour 
									ORDER BY
											LABOURNAME
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
				
				$LABOURNAME   = $ptViewStatementData["LABOURNAME"];
				$FATHERNAME   = $ptViewStatementData["FATHERNAME"];
				$ADDRESS      = $ptViewStatementData["ADDRESS"];
				$MOBILE       = $ptViewStatementData["MOBILE"];
				
				$ptView .= "<tr valign='top' class='$class'>
									<td >{$sv}</td>
									<td >{$LABOURNAME}</td>
									<td >{$FATHERNAME}</td>
									<td >{$ADDRESS}</td>
									<td >{$MOBILE}</td>
									<td align='center'>
									<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' />
									</td>
								</tr>";
				
				$sv++;
			}
			$systemParametersBody = str_replace('<!--%[LABOUR_VIEW]%-->',$ptView,$systemParametersBody);
			
			//Labour View End
			
			// Product View  Start
			
			$prodNameVal 				= '';
			$prodQuery 				= "SELECT PRODCATTYPEID, CATEGORYTYPENAME FROM fna_productcattype ORDER BY CATEGORYTYPENAME ASC";
			$prodQueryStatement				= mysql_query($prodQuery);
			while($prodQueryStatementData	= mysql_fetch_array($prodQueryStatement)) {
				$productCatTypeId				= $prodQueryStatementData["PRODCATTYPEID"];
				$catName						= $prodQueryStatementData["CATEGORYTYPENAME"];
				$prodNameVal 					.= "<option value='".$productCatTypeId."'>".$catName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT_NAME]%-->',$prodNameVal,$systemParametersBody);
			
			
			//Labour Name View
			$labourNameVal 				= '';
			$labourQuery 				= "SELECT LABOURID, LABOURNAME FROM fna_labour ORDER BY LABOURNAME ASC";
			$labourQueryStatement				= mysql_query($labourQuery);
			while($labourQueryStatementData	= mysql_fetch_array($labourQueryStatement)) {
				$labourId						= $labourQueryStatementData["LABOURID"];
				$labourName						= $labourQueryStatementData["LABOURNAME"];
				$labourNameVal 					.= "<option value='".$labourId."'>".$labourName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[LABOUR_NAME]%-->',$labourNameVal,$systemParametersBody);
			
			$PartyNameVal 				= '';
			$PartyQuery 				= "SELECT PARTYID, PARTYNAME FROM fna_party ORDER BY PARTYNAME ASC";
			$PartyQueryStatement				= mysql_query($PartyQuery);
			while($PartyQueryStatementData	= mysql_fetch_array($PartyQueryStatement)) {
				$PartyId						= $PartyQueryStatementData["PARTYID"];
				$PartyName						= $PartyQueryStatementData["PARTYNAME"];
				$PartyNameVal 					.= "<option value='".$PartyId."'>".$PartyName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$PartyNameVal,$systemParametersBody);
			
			$prodCatTypeVal						= '';
			$prodCatQuery 						= "SELECT PRODCATTYPEID,PRODUCTNAME FROM fna_product ORDER BY PRODUCTNAME ASC";
			$prodCatQueryStatement				= mysql_query($prodCatQuery);
			while($prodCatQueryStatementData	= mysql_fetch_array($prodCatQueryStatement)) {
				$PRODCATTYPEID					= $prodCatQueryStatementData["PRODCATTYPEID"];
				$PRODUCTNAME					= $prodCatQueryStatementData["PRODUCTNAME"];
				$prodCatTypeVal					.= "<option value='".$PRODCATTYPEID."'>".$PRODUCTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT]%-->',$prodCatTypeVal,$systemParametersBody);
			
			$QuantityVal 						= '';
			$quantityQuery 						= "SELECT QID,QVALUE FROM fna_quantity ORDER BY QVALUE ASC";
			$quantityQueryStatement				= mysql_query($quantityQuery);
			while($quantityQueryStatementData	= mysql_fetch_array($quantityQueryStatement)) {
				$qId							= $quantityQueryStatementData["QID"];
				$qValue							= $quantityQueryStatementData["QVALUE"];
				$QuantityVal 					.= "<option value='".$qId."'>".$qValue."</option>";
			}
			$systemParametersBody = str_replace('<!--%[QUANTITY]%-->',$QuantityVal,$systemParametersBody);
			
			$weightTypeVal 							= '';
			$weightTypeQuery 						= "SELECT WTID,WNAME FROM fna_weight ORDER BY WNAME ASC";
			$weightTypeQueryStatement				= mysql_query($weightTypeQuery);
			while($weightTypeQueryStatementData		= mysql_fetch_array($weightTypeQueryStatement)) {
				$wtId								= $weightTypeQueryStatementData["WTID"];
				$wtName								= $weightTypeQueryStatementData["WNAME"];
				$weightTypeVal 						.= "<option value='".$wtId."'>".$wtName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[WEIGHTTYPE]%-->',$weightTypeVal,$systemParametersBody);
			
			// Packing Unit Start
			$packingNameVal 					= '';
			$PackingQuery 						= "SELECT PACKINGNAMEID,PACKINGNAME FROM fna_packingname ORDER BY PACKINGNAME ASC";
			$PackingQueryStatement				= mysql_query($PackingQuery);
			while($PackingQueryStatementData	= mysql_fetch_array($PackingQueryStatement)) {
				$packingId						= $PackingQueryStatementData["PACKINGNAMEID"];
				$packingName					= $PackingQueryStatementData["PACKINGNAME"];
				$packingNameVal 					.= "<option value='".$packingId."'>".$packingName."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PACKING_NAME_NEW]%-->',$packingNameVal,$systemParametersBody);
			$packingNameVal 	= '';
			$packingViewQuery 	= "
									SELECT
											PACKINGUNITID,
											PACKINGNAMEID,
											QID,
											WTID
									FROM
											fna_packingunit 
									ORDER BY
											PACKINGUNITID
									ASC
								";
			$sv								= 1;
			$packingViewQueryStatement				= mysql_query($packingViewQuery);
			while($packingViewQueryStatementData	= mysql_fetch_array($packingViewQueryStatement)) {
				
				$PACKINGUNITID   		= $packingViewQueryStatementData["PACKINGUNITID"];
				$PACKINGNAMEID   		= $packingViewQueryStatementData["PACKINGNAMEID"];
				$QID			   		= $packingViewQueryStatementData["QID"];
				$WTID			   		= $packingViewQueryStatementData["WTID"];
				
				$packingNameQuery = "
									SELECT
											PACKINGNAMEID,
											PACKINGNAME
									FROM
											fna_packingname 
											WHERE PACKINGNAMEID = {$PACKINGNAMEID}
									";
				$packingNameQueryStatement				= mysql_query($packingNameQuery);
				while($packingNameQueryStatementData	= mysql_fetch_array($packingNameQueryStatement)) {
					$PACKINGNAMEID_NEW   		= $packingNameQueryStatementData["PACKINGNAMEID"];
					$PACKINGNAME_NEW   			= $packingNameQueryStatementData["PACKINGNAME"];
					
				}
				
				$QidQuery = "
									SELECT
											QVALUE
									FROM
											fna_quantity 
											WHERE QID = {$QID}
									";
				$QidQueryStatement				= mysql_query($QidQuery);
				while($QidQueryStatementData	= mysql_fetch_array($QidQueryStatement)) {
					$QVALUE   		= $QidQueryStatementData["QVALUE"];
					
				}
				
				$wtidQuery = "
									SELECT
											WNAME
									FROM
											fna_weight 
											WHERE WTID = {$WTID}
									";
				$wtidQueryStatement				= mysql_query($wtidQuery);
				while($wtidQueryStatementData	= mysql_fetch_array($wtidQueryStatement)) {
					$WNAME   		= $wtidQueryStatementData["WNAME"];
					
				}
			
			
			$packingNameVal 					.= "<option value='".$PACKINGUNITID."'>".$PACKINGNAME_NEW.", ".$QVALUE.",".$WNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PACKING_NAME]%-->',$packingNameVal,$systemParametersBody);
			
			//Product View End
			
			//Chamber From Start
			$chamberFromVal							= '';
			$chamberFromQuery 						= "SELECT CHID, CHNAME FROM fna_chamber ORDER BY CHID ASC";
			$chamberFromQueryStatement				= mysql_query($chamberFromQuery);
			while($chamberFromQueryStatementData	= mysql_fetch_array($chamberFromQueryStatement)) {
				$chamberId							= $chamberFromQueryStatementData["CHID"];
				$chamberName						= $chamberFromQueryStatementData["CHNAME"];
				$chamberFromVal 					.= "<option value='".$chamberId."'>".$chamberName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[CHAMBER_FROM]%-->',$chamberFromVal,$systemParametersBody);
			//Chamber From End
					
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
		//System Load Entry Jaber End
		
		//System Load Entry Start
		function getLoadOpeningEntry($empId) {
			$systemParametersBody = $this->getTemplateContent('fnaLoadOpening');
			
			// Project View  Start
			
			$projNameVal 				= '';
			$projQuery 				= "SELECT PROJECTID, PROJECTNAME FROM fna_project ORDER BY PROJECTNAME ASC";
			$projQueryStatement				= mysql_query($projQuery);
			while($projQueryStatementData	= mysql_fetch_array($projQueryStatement)) {
				$PROJECTID					= $projQueryStatementData["PROJECTID"];
				$PROJECTNAME				= $projQueryStatementData["PROJECTNAME"];
				$projNameVal 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$projNameVal,$systemParametersBody);
			// Project View  End
			
			// Product Load Unload No  Start
			
			$maxLoadNo		= mysql_fetch_array(mysql_query("SELECT MAX(PRODUCTLOADUNLOADID) FROM fna_productloadunload"));
			$NowmaxLoadNo	= $maxLoadNo['MAX(PRODUCTLOADUNLOADID)'] + 1;
			$systemParametersBody = str_replace('<!--%[LOADUNLOAD_VIEW]%-->',$NowmaxLoadNo,$systemParametersBody);
			// Product Load Unload No  End
			
			// Labour View Start
			$ptView 		= '';
			$ptViewQuery 	= "
									SELECT
											LABOURNAME,
											FATHERNAME,
											ADDRESS,
											MOBILE
									FROM
											fna_labour 
									ORDER BY
											LABOURNAME
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
				
				$LABOURNAME   = $ptViewStatementData["LABOURNAME"];
				$FATHERNAME   = $ptViewStatementData["FATHERNAME"];
				$ADDRESS      = $ptViewStatementData["ADDRESS"];
				$MOBILE       = $ptViewStatementData["MOBILE"];
				
				$ptView .= "<tr valign='top' class='$class'>
									<td >{$sv}</td>
									<td >{$LABOURNAME}</td>
									<td >{$FATHERNAME}</td>
									<td >{$ADDRESS}</td>
									<td >{$MOBILE}</td>
									<td align='center'>
									<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' />
									</td>
								</tr>";
				
				$sv++;
			}
			$systemParametersBody = str_replace('<!--%[LABOUR_VIEW]%-->',$ptView,$systemParametersBody);
			
			//Labour View End
			
			// Product View  Start
			
			$prodNameVal 				= '';
			$prodQuery 				= "SELECT PRODCATTYPEID, CATEGORYTYPENAME FROM fna_productcattype ORDER BY CATEGORYTYPENAME ASC";
			$prodQueryStatement				= mysql_query($prodQuery);
			while($prodQueryStatementData	= mysql_fetch_array($prodQueryStatement)) {
				$productCatTypeId				= $prodQueryStatementData["PRODCATTYPEID"];
				$catName						= $prodQueryStatementData["CATEGORYTYPENAME"];
				$prodNameVal 					.= "<option value='".$productCatTypeId."'>".$catName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT_NAME]%-->',$prodNameVal,$systemParametersBody);
			
			
			//Labour Name View
			$labourNameVal 				= '';
			$labourQuery 				= "SELECT LABOURID, LABOURNAME FROM fna_labour ORDER BY LABOURNAME ASC";
			$labourQueryStatement				= mysql_query($labourQuery);
			while($labourQueryStatementData	= mysql_fetch_array($labourQueryStatement)) {
				$labourId						= $labourQueryStatementData["LABOURID"];
				$labourName						= $labourQueryStatementData["LABOURNAME"];
				$labourNameVal 					.= "<option value='".$labourId."'>".$labourName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[LABOUR_NAME]%-->',$labourNameVal,$systemParametersBody);
			
			$PartyNameVal 				= '';
			$PartyQuery 				= "SELECT PARTYID, PARTYNAME FROM fna_party ORDER BY PARTYNAME ASC";
			$PartyQueryStatement				= mysql_query($PartyQuery);
			while($PartyQueryStatementData	= mysql_fetch_array($PartyQueryStatement)) {
				$PartyId						= $PartyQueryStatementData["PARTYID"];
				$PartyName						= $PartyQueryStatementData["PARTYNAME"];
				$PartyNameVal 					.= "<option value='".$PartyId."'>".$PartyName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$PartyNameVal,$systemParametersBody);
			
			$prodCatTypeVal						= '';
			$prodCatQuery 						= "SELECT PRODCATTYPEID,PRODUCTNAME FROM fna_product ORDER BY PRODUCTNAME ASC";
			$prodCatQueryStatement				= mysql_query($prodCatQuery);
			while($prodCatQueryStatementData	= mysql_fetch_array($prodCatQueryStatement)) {
				$PRODCATTYPEID					= $prodCatQueryStatementData["PRODCATTYPEID"];
				$PRODUCTNAME					= $prodCatQueryStatementData["PRODUCTNAME"];
				$prodCatTypeVal					.= "<option value='".$PRODCATTYPEID."'>".$PRODUCTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT]%-->',$prodCatTypeVal,$systemParametersBody);
			
			$QuantityVal 						= '';
			$quantityQuery 						= "SELECT QID,QVALUE FROM fna_quantity ORDER BY QVALUE ASC";
			$quantityQueryStatement				= mysql_query($quantityQuery);
			while($quantityQueryStatementData	= mysql_fetch_array($quantityQueryStatement)) {
				$qId							= $quantityQueryStatementData["QID"];
				$qValue							= $quantityQueryStatementData["QVALUE"];
				$QuantityVal 					.= "<option value='".$qId."'>".$qValue."</option>";
			}
			$systemParametersBody = str_replace('<!--%[QUANTITY]%-->',$QuantityVal,$systemParametersBody);
			
			$weightTypeVal 							= '';
			$weightTypeQuery 						= "SELECT WTID,WNAME FROM fna_weight ORDER BY WNAME ASC";
			$weightTypeQueryStatement				= mysql_query($weightTypeQuery);
			while($weightTypeQueryStatementData		= mysql_fetch_array($weightTypeQueryStatement)) {
				$wtId								= $weightTypeQueryStatementData["WTID"];
				$wtName								= $weightTypeQueryStatementData["WNAME"];
				$weightTypeVal 						.= "<option value='".$wtId."'>".$wtName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[WEIGHTTYPE]%-->',$weightTypeVal,$systemParametersBody);
			
			// Packing Unit Start
			$packingNameVal 					= '';
			$PackingQuery 						= "SELECT PACKINGNAMEID,PACKINGNAME FROM fna_packingname ORDER BY PACKINGNAME ASC";
			$PackingQueryStatement				= mysql_query($PackingQuery);
			while($PackingQueryStatementData	= mysql_fetch_array($PackingQueryStatement)) {
				$packingId						= $PackingQueryStatementData["PACKINGNAMEID"];
				$packingName					= $PackingQueryStatementData["PACKINGNAME"];
				$packingNameVal 					.= "<option value='".$packingId."'>".$packingName."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PACKING_NAME_NEW]%-->',$packingNameVal,$systemParametersBody);
			$packingNameVal 	= '';
			$packingViewQuery 	= "
									SELECT
											PACKINGUNITID,
											PACKINGNAMEID,
											QID,
											WTID
									FROM
											fna_packingunit 
									ORDER BY
											PACKINGUNITID
									ASC
								";
			$sv								= 1;
			$packingViewQueryStatement				= mysql_query($packingViewQuery);
			while($packingViewQueryStatementData	= mysql_fetch_array($packingViewQueryStatement)) {
				
				$PACKINGUNITID   		= $packingViewQueryStatementData["PACKINGUNITID"];
				$PACKINGNAMEID   		= $packingViewQueryStatementData["PACKINGNAMEID"];
				$QID			   		= $packingViewQueryStatementData["QID"];
				$WTID			   		= $packingViewQueryStatementData["WTID"];
				
				$packingNameQuery = "
									SELECT
											PACKINGNAMEID,
											PACKINGNAME
									FROM
											fna_packingname 
											WHERE PACKINGNAMEID = {$PACKINGNAMEID}
									";
				$packingNameQueryStatement				= mysql_query($packingNameQuery);
				while($packingNameQueryStatementData	= mysql_fetch_array($packingNameQueryStatement)) {
					$PACKINGNAMEID_NEW   		= $packingNameQueryStatementData["PACKINGNAMEID"];
					$PACKINGNAME_NEW   			= $packingNameQueryStatementData["PACKINGNAME"];
					
				}
				
				$QidQuery = "
									SELECT
											QVALUE
									FROM
											fna_quantity 
											WHERE QID = {$QID}
									";
				$QidQueryStatement				= mysql_query($QidQuery);
				while($QidQueryStatementData	= mysql_fetch_array($QidQueryStatement)) {
					$QVALUE   		= $QidQueryStatementData["QVALUE"];
					
				}
				
				$wtidQuery = "
									SELECT
											WNAME
									FROM
											fna_weight 
											WHERE WTID = {$WTID}
									";
				$wtidQueryStatement				= mysql_query($wtidQuery);
				while($wtidQueryStatementData	= mysql_fetch_array($wtidQueryStatement)) {
					$WNAME   		= $wtidQueryStatementData["WNAME"];
					
				}
			
			
			$packingNameVal 					.= "<option value='".$PACKINGUNITID."'>".$PACKINGNAME_NEW.", ".$QVALUE.",".$WNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PACKING_NAME]%-->',$packingNameVal,$systemParametersBody);
			
			//Product View End
			
			//Chamber From Start
			$chamberFromVal							= '';
			$chamberFromQuery 						= "SELECT CHID, CHNAME FROM fna_chamber ORDER BY CHID ASC";
			$chamberFromQueryStatement				= mysql_query($chamberFromQuery);
			while($chamberFromQueryStatementData	= mysql_fetch_array($chamberFromQueryStatement)) {
				$chamberId							= $chamberFromQueryStatementData["CHID"];
				$chamberName						= $chamberFromQueryStatementData["CHNAME"];
				$chamberFromVal 					.= "<option value='".$chamberId."'>".$chamberName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[CHAMBER_FROM]%-->',$chamberFromVal,$systemParametersBody);
			//Chamber From End
					
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
		//System Load Entry  End
		
		//System Data Processing  Entry Start
		function getDataProcessing($empId) {
			$systemParametersBody = $this->getTemplateContent('dataProcessing');
			
			// Project View  Start
			
			$projNameVal 				= '';
			$projQuery 				= "SELECT PROJECTID, PROJECTNAME FROM fna_project ORDER BY PROJECTNAME ASC";
			$projQueryStatement				= mysql_query($projQuery);
			while($projQueryStatementData	= mysql_fetch_array($projQueryStatement)) {
				$PROJECTID					= $projQueryStatementData["PROJECTID"];
				$PROJECTNAME				= $projQueryStatementData["PROJECTNAME"];
				$projNameVal 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$projNameVal,$systemParametersBody);
			// Project View  End
			
			// Labour View Start
			$ptView 		= '';
			$ptViewQuery 	= "
									SELECT
											LABOURNAME,
											FATHERNAME,
											ADDRESS,
											MOBILE
									FROM
											fna_labour 
									ORDER BY
											LABOURNAME
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
				
				$LABOURNAME   = $ptViewStatementData["LABOURNAME"];
				$FATHERNAME   = $ptViewStatementData["FATHERNAME"];
				$ADDRESS      = $ptViewStatementData["ADDRESS"];
				$MOBILE       = $ptViewStatementData["MOBILE"];
				
				$ptView .= "<tr valign='top' class='$class'>
									<td >{$sv}</td>
									<td >{$LABOURNAME}</td>
									<td >{$FATHERNAME}</td>
									<td >{$ADDRESS}</td>
									<td >{$MOBILE}</td>
									<td align='center'>
									<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' />
									</td>
								</tr>";
				
				$sv++;
			}
			$systemParametersBody = str_replace('<!--%[LABOUR_VIEW]%-->',$ptView,$systemParametersBody);
			
			//Labour View End
			
			// Product View  Start
			
			$prodNameVal 				= '';
			$prodQuery 				= "SELECT PRODCATTYPEID, CATEGORYTYPENAME FROM fna_productcattype ORDER BY CATEGORYTYPENAME ASC";
			$prodQueryStatement				= mysql_query($prodQuery);
			while($prodQueryStatementData	= mysql_fetch_array($prodQueryStatement)) {
				$productCatTypeId				= $prodQueryStatementData["PRODCATTYPEID"];
				$catName						= $prodQueryStatementData["CATEGORYTYPENAME"];
				$prodNameVal 					.= "<option value='".$productCatTypeId."'>".$catName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT_NAME]%-->',$prodNameVal,$systemParametersBody);
			
			
			// Session Year View  Start
			
			$SessionYearVal			= '';
			$SessionYearQuery 						= "SELECT SESSIONYEARID, SESSIONYEAR FROM fna_sessionyear ORDER BY SESSIONYEAR ASC";
			$SessionYearQueryStatement				= mysql_query($SessionYearQuery);
			while($SessionYearQueryStatementData	= mysql_fetch_array($SessionYearQueryStatement)) {
				$SESSIONYEARID						= $SessionYearQueryStatementData["SESSIONYEARID"];
				$SESSIONYEAR						= $SessionYearQueryStatementData["SESSIONYEAR"];
				$SessionYearVal 					.= "<option value='".$SESSIONYEARID."'>".$SESSIONYEAR."</option>";
			}
			$systemParametersBody = str_replace('<!--%[SESSION_YEAR]%-->',$SessionYearVal,$systemParametersBody);
			// Session Year View  End
			
			
			$PartyNameVal 				= '';
			$PartyQuery 				= "SELECT PARTYID, PARTYNAME FROM fna_party ORDER BY PARTYNAME ASC";
			$PartyQueryStatement				= mysql_query($PartyQuery);
			while($PartyQueryStatementData	= mysql_fetch_array($PartyQueryStatement)) {
				$PartyId						= $PartyQueryStatementData["PARTYID"];
				$PartyName						= $PartyQueryStatementData["PARTYNAME"];
				$PartyNameVal 					.= "<option value='".$PartyId."'>".$PartyName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$PartyNameVal,$systemParametersBody);
			
			$prodCatTypeVal						= '';
			$prodCatQuery 						= "SELECT PRODCATTYPEID,PRODUCTNAME FROM fna_product ORDER BY PRODUCTNAME ASC";
			$prodCatQueryStatement				= mysql_query($prodCatQuery);
			while($prodCatQueryStatementData	= mysql_fetch_array($prodCatQueryStatement)) {
				$PRODCATTYPEID					= $prodCatQueryStatementData["PRODCATTYPEID"];
				$PRODUCTNAME					= $prodCatQueryStatementData["PRODUCTNAME"];
				$prodCatTypeVal					.= "<option value='".$PRODCATTYPEID."'>".$PRODUCTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT]%-->',$prodCatTypeVal,$systemParametersBody);
			
			$QuantityVal 						= '';
			$quantityQuery 						= "SELECT QID,QVALUE FROM fna_quantity ORDER BY QVALUE ASC";
			$quantityQueryStatement				= mysql_query($quantityQuery);
			while($quantityQueryStatementData	= mysql_fetch_array($quantityQueryStatement)) {
				$qId							= $quantityQueryStatementData["QID"];
				$qValue							= $quantityQueryStatementData["QVALUE"];
				$QuantityVal 					.= "<option value='".$qId."'>".$qValue."</option>";
			}
			$systemParametersBody = str_replace('<!--%[QUANTITY]%-->',$QuantityVal,$systemParametersBody);
			
			$weightTypeVal 							= '';
			$weightTypeQuery 						= "SELECT WTID,WNAME FROM fna_weight ORDER BY WNAME ASC";
			$weightTypeQueryStatement				= mysql_query($weightTypeQuery);
			while($weightTypeQueryStatementData		= mysql_fetch_array($weightTypeQueryStatement)) {
				$wtId								= $weightTypeQueryStatementData["WTID"];
				$wtName								= $weightTypeQueryStatementData["WNAME"];
				$weightTypeVal 						.= "<option value='".$wtId."'>".$wtName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[WEIGHTTYPE]%-->',$weightTypeVal,$systemParametersBody);
			
			// Packing Unit Start
			$packingNameVal 					= '';
			$PackingQuery 						= "SELECT PACKINGNAMEID,PACKINGNAME FROM fna_packingname ORDER BY PACKINGNAME ASC";
			$PackingQueryStatement				= mysql_query($PackingQuery);
			while($PackingQueryStatementData	= mysql_fetch_array($PackingQueryStatement)) {
				$packingId						= $PackingQueryStatementData["PACKINGNAMEID"];
				$packingName					= $PackingQueryStatementData["PACKINGNAME"];
				$packingNameVal 					.= "<option value='".$packingId."'>".$packingName."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PACKING_NAME_NEW]%-->',$packingNameVal,$systemParametersBody);
			$packingNameVal 	= '';
			$packingViewQuery 	= "
									SELECT
											PACKINGUNITID,
											PACKINGNAMEID,
											QID,
											WTID
									FROM
											fna_packingunit 
									ORDER BY
											PACKINGUNITID
									ASC
								";
			$sv								= 1;
			$packingViewQueryStatement				= mysql_query($packingViewQuery);
			while($packingViewQueryStatementData	= mysql_fetch_array($packingViewQueryStatement)) {
				
				$PACKINGUNITID   		= $packingViewQueryStatementData["PACKINGUNITID"];
				$PACKINGNAMEID   		= $packingViewQueryStatementData["PACKINGNAMEID"];
				$QID			   		= $packingViewQueryStatementData["QID"];
				$WTID			   		= $packingViewQueryStatementData["WTID"];
				
				$packingNameQuery = "
									SELECT
											PACKINGNAMEID,
											PACKINGNAME
									FROM
											fna_packingname 
											WHERE PACKINGNAMEID = {$PACKINGNAMEID}
									";
				$packingNameQueryStatement				= mysql_query($packingNameQuery);
				while($packingNameQueryStatementData	= mysql_fetch_array($packingNameQueryStatement)) {
					$PACKINGNAMEID_NEW   		= $packingNameQueryStatementData["PACKINGNAMEID"];
					$PACKINGNAME_NEW   			= $packingNameQueryStatementData["PACKINGNAME"];
					
				}
				
				$QidQuery = "
									SELECT
											QVALUE
									FROM
											fna_quantity 
											WHERE QID = {$QID}
									";
				$QidQueryStatement				= mysql_query($QidQuery);
				while($QidQueryStatementData	= mysql_fetch_array($QidQueryStatement)) {
					$QVALUE   		= $QidQueryStatementData["QVALUE"];
					
				}
				
				$wtidQuery = "
									SELECT
											WNAME
									FROM
											fna_weight 
											WHERE WTID = {$WTID}
									";
				$wtidQueryStatement				= mysql_query($wtidQuery);
				while($wtidQueryStatementData	= mysql_fetch_array($wtidQueryStatement)) {
					$WNAME   		= $wtidQueryStatementData["WNAME"];
					
				}
			
			
			$packingNameVal 					.= "<option value='".$PACKINGUNITID."'>".$PACKINGNAME_NEW.", ".$QVALUE.",".$WNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PACKING_NAME]%-->',$packingNameVal,$systemParametersBody);
			
			//Product View End
			
			//Chamber From Start
			$chamberFromVal							= '';
			$chamberFromQuery 						= "SELECT CHID, CHNAME FROM fna_chamber ORDER BY CHNAME ASC";
			$chamberFromQueryStatement				= mysql_query($chamberFromQuery);
			while($chamberFromQueryStatementData	= mysql_fetch_array($chamberFromQueryStatement)) {
				$chamberId							= $chamberFromQueryStatementData["CHID"];
				$chamberName						= $chamberFromQueryStatementData["CHNAME"];
				$chamberFromVal 					.= "<option value='".$chamberId."'>".$chamberName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[CHAMBER_FROM]%-->',$chamberFromVal,$systemParametersBody);
			//Chamber From End
					
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
		//System Data Processing Entry  End
		
		//System Egg Sell Entry Start
		function getEggSellEntry($empId) {
			$systemParametersBody = $this->getTemplateContent('PalEggSell');
			//Batch Select start
			
			$BatchVal 							= '';
			$BatchQuery 						= "SELECT BATCHNO FROM pal_batchopen ORDER BY BATCHNO DESC";
			$BatchQueryStatement				= mysql_query($BatchQuery);
			while($BatchQueryStatementData		= mysql_fetch_array($BatchQueryStatement)) {
				$BATCHNO						= $BatchQueryStatementData["BATCHNO"];
				$BatchVal 						.= "<option value='".$BATCHNO."'>".$BATCHNO."</option>";
			}
			$systemParametersBody = str_replace('<!--%[BATCH_NO]%-->',$BatchVal,$systemParametersBody);
			
			//Batch Select End 
			
			//Egg Category start
			$EggSellVal							= '';
			$EggSellQuery 						= "SELECT SCID, SCNAME FROM pal_sellcategory ORDER BY SCNAME ASC";
			$EggSellQueryStatement				= mysql_query($EggSellQuery);
			while($EggSellQueryStatementData	= mysql_fetch_array($EggSellQueryStatement)) {
				$SCID							= $EggSellQueryStatementData["SCID"];
				$SCNAME							= $EggSellQueryStatementData["SCNAME"];
				$EggSellVal						.= "<option value='".$SCID."'>".$SCNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[EGG_SELL]%-->',$EggSellVal,$systemParametersBody);
			
			//Egg Category End 
			
			// Project View  Start
			
			$projNameVal 				= '';
			$projQuery 				= "SELECT PROJECTID, PROJECTNAME FROM fna_project WHERE PROJECTID = 3 ORDER BY PROJECTNAME ASC";
			$projQueryStatement				= mysql_query($projQuery);
			while($projQueryStatementData	= mysql_fetch_array($projQueryStatement)) {
				$PROJECTID					= $projQueryStatementData["PROJECTID"];
				$PROJECTNAME				= $projQueryStatementData["PROJECTNAME"];
				$projNameVal 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$projNameVal,$systemParametersBody);
			// Project View  End
			
			// Labour View Start
			$ptView 		= '';
			$ptViewQuery 	= "
									SELECT
											LABOURNAME,
											FATHERNAME,
											ADDRESS,
											MOBILE
									FROM
											fna_labour 
									ORDER BY
											LABOURNAME
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
				
				$LABOURNAME   = $ptViewStatementData["LABOURNAME"];
				$FATHERNAME   = $ptViewStatementData["FATHERNAME"];
				$ADDRESS      = $ptViewStatementData["ADDRESS"];
				$MOBILE       = $ptViewStatementData["MOBILE"];
				
				$ptView .= "<tr valign='top' class='$class'>
									<td >{$sv}</td>
									<td >{$LABOURNAME}</td>
									<td >{$FATHERNAME}</td>
									<td >{$ADDRESS}</td>
									<td >{$MOBILE}</td>
									<td align='center'>
									<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' />
									</td>
								</tr>";
				
				$sv++;
			}
			$systemParametersBody = str_replace('<!--%[LABOUR_VIEW]%-->',$ptView,$systemParametersBody);
			
			//Labour View End
			
			// Product View  Start
			
			$prodNameVal 				= '';
			$prodQuery 				= "SELECT PRODCATTYPEID, CATEGORYTYPENAME FROM fna_productcattype ORDER BY CATEGORYTYPENAME ASC";
			$prodQueryStatement				= mysql_query($prodQuery);
			while($prodQueryStatementData	= mysql_fetch_array($prodQueryStatement)) {
				$productCatTypeId				= $prodQueryStatementData["PRODCATTYPEID"];
				$catName						= $prodQueryStatementData["CATEGORYTYPENAME"];
				$prodNameVal 					.= "<option value='".$productCatTypeId."'>".$catName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT_NAME]%-->',$prodNameVal,$systemParametersBody);
			
			
			//Labour Name View
			$labourNameVal 				= '';
			$labourQuery 				= "SELECT LABOURID, LABOURNAME FROM fna_labour ORDER BY LABOURNAME ASC";
			$labourQueryStatement				= mysql_query($labourQuery);
			while($labourQueryStatementData	= mysql_fetch_array($labourQueryStatement)) {
				$labourId						= $labourQueryStatementData["LABOURID"];
				$labourName						= $labourQueryStatementData["LABOURNAME"];
				$labourNameVal 					.= "<option value='".$labourId."'>".$labourName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[LABOUR_NAME]%-->',$labourNameVal,$systemParametersBody);
			
			$PartyNameVal 				= '';
			$PartyQuery 				= "SELECT PARTYID, PARTYNAME FROM fna_party ORDER BY PARTYNAME ASC";
			$PartyQueryStatement				= mysql_query($PartyQuery);
			while($PartyQueryStatementData	= mysql_fetch_array($PartyQueryStatement)) {
				$PartyId						= $PartyQueryStatementData["PARTYID"];
				$PartyName						= $PartyQueryStatementData["PARTYNAME"];
				$PartyNameVal 					.= "<option value='".$PartyId."'>".$PartyName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$PartyNameVal,$systemParametersBody);
			
			$prodCatTypeVal						= '';
			$prodCatQuery 						= "SELECT PRODCATTYPEID,PRODUCTNAME FROM fna_product ORDER BY PRODUCTNAME ASC";
			$prodCatQueryStatement				= mysql_query($prodCatQuery);
			while($prodCatQueryStatementData	= mysql_fetch_array($prodCatQueryStatement)) {
				$PRODCATTYPEID					= $prodCatQueryStatementData["PRODCATTYPEID"];
				$PRODUCTNAME					= $prodCatQueryStatementData["PRODUCTNAME"];
				$prodCatTypeVal					.= "<option value='".$PRODCATTYPEID."'>".$PRODUCTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT]%-->',$prodCatTypeVal,$systemParametersBody);
			
			$QuantityVal 						= '';
			$quantityQuery 						= "SELECT QID,QVALUE FROM fna_quantity ORDER BY QVALUE ASC";
			$quantityQueryStatement				= mysql_query($quantityQuery);
			while($quantityQueryStatementData	= mysql_fetch_array($quantityQueryStatement)) {
				$qId							= $quantityQueryStatementData["QID"];
				$qValue							= $quantityQueryStatementData["QVALUE"];
				$QuantityVal 					.= "<option value='".$qId."'>".$qValue."</option>";
			}
			$systemParametersBody = str_replace('<!--%[QUANTITY]%-->',$QuantityVal,$systemParametersBody);
			
			$weightTypeVal 							= '';
			$weightTypeQuery 						= "SELECT WTID,WNAME FROM fna_weight ORDER BY WNAME ASC";
			$weightTypeQueryStatement				= mysql_query($weightTypeQuery);
			while($weightTypeQueryStatementData		= mysql_fetch_array($weightTypeQueryStatement)) {
				$wtId								= $weightTypeQueryStatementData["WTID"];
				$wtName								= $weightTypeQueryStatementData["WNAME"];
				$weightTypeVal 						.= "<option value='".$wtId."'>".$wtName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[WEIGHTTYPE]%-->',$weightTypeVal,$systemParametersBody);
			
			// Packing Unit Start
			$packingNameVal 					= '';
			$PackingQuery 						= "SELECT PACKINGNAMEID,PACKINGNAME FROM fna_packingname ORDER BY PACKINGNAME ASC";
			$PackingQueryStatement				= mysql_query($PackingQuery);
			while($PackingQueryStatementData	= mysql_fetch_array($PackingQueryStatement)) {
				$packingId						= $PackingQueryStatementData["PACKINGNAMEID"];
				$packingName					= $PackingQueryStatementData["PACKINGNAME"];
				$packingNameVal 					.= "<option value='".$packingId."'>".$packingName."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PACKING_NAME_NEW]%-->',$packingNameVal,$systemParametersBody);
			$packingNameVal 	= '';
			$packingViewQuery 	= "
									SELECT
											PACKINGUNITID,
											PACKINGNAMEID,
											QID,
											WTID
									FROM
											fna_packingunit 
									ORDER BY
											PACKINGUNITID
									ASC
								";
			$sv								= 1;
			$packingViewQueryStatement				= mysql_query($packingViewQuery);
			while($packingViewQueryStatementData	= mysql_fetch_array($packingViewQueryStatement)) {
				
				$PACKINGUNITID   		= $packingViewQueryStatementData["PACKINGUNITID"];
				$PACKINGNAMEID   		= $packingViewQueryStatementData["PACKINGNAMEID"];
				$QID			   		= $packingViewQueryStatementData["QID"];
				$WTID			   		= $packingViewQueryStatementData["WTID"];
				
				$packingNameQuery = "
									SELECT
											PACKINGNAMEID,
											PACKINGNAME
									FROM
											fna_packingname 
											WHERE PACKINGNAMEID = {$PACKINGNAMEID}
									";
				$packingNameQueryStatement				= mysql_query($packingNameQuery);
				while($packingNameQueryStatementData	= mysql_fetch_array($packingNameQueryStatement)) {
					$PACKINGNAMEID_NEW   		= $packingNameQueryStatementData["PACKINGNAMEID"];
					$PACKINGNAME_NEW   			= $packingNameQueryStatementData["PACKINGNAME"];
					
				}
				
				$QidQuery = "
									SELECT
											QVALUE
									FROM
											fna_quantity 
											WHERE QID = {$QID}
									";
				$QidQueryStatement				= mysql_query($QidQuery);
				while($QidQueryStatementData	= mysql_fetch_array($QidQueryStatement)) {
					$QVALUE   		= $QidQueryStatementData["QVALUE"];
					
				}
				
				$wtidQuery = "
									SELECT
											WNAME
									FROM
											fna_weight 
											WHERE WTID = {$WTID}
									";
				$wtidQueryStatement				= mysql_query($wtidQuery);
				while($wtidQueryStatementData	= mysql_fetch_array($wtidQueryStatement)) {
					$WNAME   		= $wtidQueryStatementData["WNAME"];
					
				}
			
			
			$packingNameVal 					.= "<option value='".$PACKINGUNITID."'>".$PACKINGNAME_NEW.", ".$QVALUE.",".$WNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PACKING_NAME]%-->',$packingNameVal,$systemParametersBody);
			
			//Product View End
			
			//Chamber From Start
			$chamberFromVal							= '';
			$chamberFromQuery 						= "SELECT CHID, CHNAME FROM fna_chamber ORDER BY CHNAME ASC";
			$chamberFromQueryStatement				= mysql_query($chamberFromQuery);
			while($chamberFromQueryStatementData	= mysql_fetch_array($chamberFromQueryStatement)) {
				$chamberId							= $chamberFromQueryStatementData["CHID"];
				$chamberName						= $chamberFromQueryStatementData["CHNAME"];
				$chamberFromVal 					.= "<option value='".$chamberId."'>".$chamberName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[CHAMBER_FROM]%-->',$chamberFromVal,$systemParametersBody);
			//Chamber From End
					
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
		//System Egg Sell Entry  End
		
		//System Morog Murgi Sell Entry Start
		function getMurMorSellEntry($empId) {
			$systemParametersBody = $this->getTemplateContent('PalMorogMurgiSell');
			//Batch Select start
			
			$BatchVal 							= '';
			$BatchQuery 						= "SELECT BATCHNO FROM pal_batchopen ORDER BY BATCHNO DESC";
			$BatchQueryStatement				= mysql_query($BatchQuery);
			while($BatchQueryStatementData		= mysql_fetch_array($BatchQueryStatement)) {
				$BATCHNO						= $BatchQueryStatementData["BATCHNO"];
				$BatchVal 						.= "<option value='".$BATCHNO."'>".$BATCHNO."</option>";
			}
			$systemParametersBody = str_replace('<!--%[BATCH_NO]%-->',$BatchVal,$systemParametersBody);
			
			//Batch Select End 
			
			//Egg Category start
			$EggSellVal							= '';
			$EggSellQuery 						= "SELECT SCID, SCNAME FROM pal_sellcategory ORDER BY SCNAME ASC";
			$EggSellQueryStatement				= mysql_query($EggSellQuery);
			while($EggSellQueryStatementData	= mysql_fetch_array($EggSellQueryStatement)) {
				$SCID							= $EggSellQueryStatementData["SCID"];
				$SCNAME							= $EggSellQueryStatementData["SCNAME"];
				$EggSellVal						.= "<option value='".$SCID."'>".$SCNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[EGG_SELL]%-->',$EggSellVal,$systemParametersBody);
			
			//Egg Category End 
			
			// Project View  Start
			
			$projNameVal 				= '';
			$projQuery 				= "SELECT PROJECTID, PROJECTNAME FROM fna_project WHERE PROJECTID = 3 ORDER BY PROJECTNAME ASC";
			$projQueryStatement				= mysql_query($projQuery);
			while($projQueryStatementData	= mysql_fetch_array($projQueryStatement)) {
				$PROJECTID					= $projQueryStatementData["PROJECTID"];
				$PROJECTNAME				= $projQueryStatementData["PROJECTNAME"];
				$projNameVal 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$projNameVal,$systemParametersBody);
			// Project View  End
			
			// Labour View Start
			$ptView 		= '';
			$ptViewQuery 	= "
									SELECT
											LABOURNAME,
											FATHERNAME,
											ADDRESS,
											MOBILE
									FROM
											fna_labour 
									ORDER BY
											LABOURNAME
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
				
				$LABOURNAME   = $ptViewStatementData["LABOURNAME"];
				$FATHERNAME   = $ptViewStatementData["FATHERNAME"];
				$ADDRESS      = $ptViewStatementData["ADDRESS"];
				$MOBILE       = $ptViewStatementData["MOBILE"];
				
				$ptView .= "<tr valign='top' class='$class'>
									<td >{$sv}</td>
									<td >{$LABOURNAME}</td>
									<td >{$FATHERNAME}</td>
									<td >{$ADDRESS}</td>
									<td >{$MOBILE}</td>
									<td align='center'>
									<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' />
									</td>
								</tr>";
				
				$sv++;
			}
			$systemParametersBody = str_replace('<!--%[LABOUR_VIEW]%-->',$ptView,$systemParametersBody);
			
			//Labour View End
			
			// Product View  Start
			
			$prodNameVal 				= '';
			$prodQuery 				= "SELECT PRODCATTYPEID, CATEGORYTYPENAME FROM fna_productcattype ORDER BY CATEGORYTYPENAME ASC";
			$prodQueryStatement				= mysql_query($prodQuery);
			while($prodQueryStatementData	= mysql_fetch_array($prodQueryStatement)) {
				$productCatTypeId				= $prodQueryStatementData["PRODCATTYPEID"];
				$catName						= $prodQueryStatementData["CATEGORYTYPENAME"];
				$prodNameVal 					.= "<option value='".$productCatTypeId."'>".$catName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT_NAME]%-->',$prodNameVal,$systemParametersBody);
			
			
			//Labour Name View
			$labourNameVal 				= '';
			$labourQuery 				= "SELECT LABOURID, LABOURNAME FROM fna_labour ORDER BY LABOURNAME ASC";
			$labourQueryStatement				= mysql_query($labourQuery);
			while($labourQueryStatementData	= mysql_fetch_array($labourQueryStatement)) {
				$labourId						= $labourQueryStatementData["LABOURID"];
				$labourName						= $labourQueryStatementData["LABOURNAME"];
				$labourNameVal 					.= "<option value='".$labourId."'>".$labourName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[LABOUR_NAME]%-->',$labourNameVal,$systemParametersBody);
			
			$PartyNameVal 				= '';
			$PartyQuery 				= "SELECT PARTYID, PARTYNAME FROM fna_party ORDER BY PARTYNAME ASC";
			$PartyQueryStatement				= mysql_query($PartyQuery);
			while($PartyQueryStatementData	= mysql_fetch_array($PartyQueryStatement)) {
				$PartyId						= $PartyQueryStatementData["PARTYID"];
				$PartyName						= $PartyQueryStatementData["PARTYNAME"];
				$PartyNameVal 					.= "<option value='".$PartyId."'>".$PartyName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$PartyNameVal,$systemParametersBody);
			
			$prodCatTypeVal						= '';
			$prodCatQuery 						= "SELECT PRODCATTYPEID,PRODUCTNAME FROM fna_product ORDER BY PRODUCTNAME ASC";
			$prodCatQueryStatement				= mysql_query($prodCatQuery);
			while($prodCatQueryStatementData	= mysql_fetch_array($prodCatQueryStatement)) {
				$PRODCATTYPEID					= $prodCatQueryStatementData["PRODCATTYPEID"];
				$PRODUCTNAME					= $prodCatQueryStatementData["PRODUCTNAME"];
				$prodCatTypeVal					.= "<option value='".$PRODCATTYPEID."'>".$PRODUCTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT]%-->',$prodCatTypeVal,$systemParametersBody);
			
			$QuantityVal 						= '';
			$quantityQuery 						= "SELECT QID,QVALUE FROM fna_quantity ORDER BY QVALUE ASC";
			$quantityQueryStatement				= mysql_query($quantityQuery);
			while($quantityQueryStatementData	= mysql_fetch_array($quantityQueryStatement)) {
				$qId							= $quantityQueryStatementData["QID"];
				$qValue							= $quantityQueryStatementData["QVALUE"];
				$QuantityVal 					.= "<option value='".$qId."'>".$qValue."</option>";
			}
			$systemParametersBody = str_replace('<!--%[QUANTITY]%-->',$QuantityVal,$systemParametersBody);
			
			$weightTypeVal 							= '';
			$weightTypeQuery 						= "SELECT WTID,WNAME FROM fna_weight ORDER BY WNAME ASC";
			$weightTypeQueryStatement				= mysql_query($weightTypeQuery);
			while($weightTypeQueryStatementData		= mysql_fetch_array($weightTypeQueryStatement)) {
				$wtId								= $weightTypeQueryStatementData["WTID"];
				$wtName								= $weightTypeQueryStatementData["WNAME"];
				$weightTypeVal 						.= "<option value='".$wtId."'>".$wtName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[WEIGHTTYPE]%-->',$weightTypeVal,$systemParametersBody);
			
			// Packing Unit Start
			$packingNameVal 					= '';
			$PackingQuery 						= "SELECT PACKINGNAMEID,PACKINGNAME FROM fna_packingname ORDER BY PACKINGNAME ASC";
			$PackingQueryStatement				= mysql_query($PackingQuery);
			while($PackingQueryStatementData	= mysql_fetch_array($PackingQueryStatement)) {
				$packingId						= $PackingQueryStatementData["PACKINGNAMEID"];
				$packingName					= $PackingQueryStatementData["PACKINGNAME"];
				$packingNameVal 					.= "<option value='".$packingId."'>".$packingName."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PACKING_NAME_NEW]%-->',$packingNameVal,$systemParametersBody);
			$packingNameVal 	= '';
			$packingViewQuery 	= "
									SELECT
											PACKINGUNITID,
											PACKINGNAMEID,
											QID,
											WTID
									FROM
											fna_packingunit 
									ORDER BY
											PACKINGUNITID
									ASC
								";
			$sv								= 1;
			$packingViewQueryStatement				= mysql_query($packingViewQuery);
			while($packingViewQueryStatementData	= mysql_fetch_array($packingViewQueryStatement)) {
				
				$PACKINGUNITID   		= $packingViewQueryStatementData["PACKINGUNITID"];
				$PACKINGNAMEID   		= $packingViewQueryStatementData["PACKINGNAMEID"];
				$QID			   		= $packingViewQueryStatementData["QID"];
				$WTID			   		= $packingViewQueryStatementData["WTID"];
				
				$packingNameQuery = "
									SELECT
											PACKINGNAMEID,
											PACKINGNAME
									FROM
											fna_packingname 
											WHERE PACKINGNAMEID = {$PACKINGNAMEID}
									";
				$packingNameQueryStatement				= mysql_query($packingNameQuery);
				while($packingNameQueryStatementData	= mysql_fetch_array($packingNameQueryStatement)) {
					$PACKINGNAMEID_NEW   		= $packingNameQueryStatementData["PACKINGNAMEID"];
					$PACKINGNAME_NEW   			= $packingNameQueryStatementData["PACKINGNAME"];
					
				}
				
				$QidQuery = "
									SELECT
											QVALUE
									FROM
											fna_quantity 
											WHERE QID = {$QID}
									";
				$QidQueryStatement				= mysql_query($QidQuery);
				while($QidQueryStatementData	= mysql_fetch_array($QidQueryStatement)) {
					$QVALUE   		= $QidQueryStatementData["QVALUE"];
					
				}
				
				$wtidQuery = "
									SELECT
											WNAME
									FROM
											fna_weight 
											WHERE WTID = {$WTID}
									";
				$wtidQueryStatement				= mysql_query($wtidQuery);
				while($wtidQueryStatementData	= mysql_fetch_array($wtidQueryStatement)) {
					$WNAME   		= $wtidQueryStatementData["WNAME"];
					
				}
			
			
			$packingNameVal 					.= "<option value='".$PACKINGUNITID."'>".$PACKINGNAME_NEW.", ".$QVALUE.",".$WNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PACKING_NAME]%-->',$packingNameVal,$systemParametersBody);
			
			//Product View End
			
			//Chamber From Start
			$chamberFromVal							= '';
			$chamberFromQuery 						= "SELECT CHID, CHNAME FROM fna_chamber ORDER BY CHNAME ASC";
			$chamberFromQueryStatement				= mysql_query($chamberFromQuery);
			while($chamberFromQueryStatementData	= mysql_fetch_array($chamberFromQueryStatement)) {
				$chamberId							= $chamberFromQueryStatementData["CHID"];
				$chamberName						= $chamberFromQueryStatementData["CHNAME"];
				$chamberFromVal 					.= "<option value='".$chamberId."'>".$chamberName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[CHAMBER_FROM]%-->',$chamberFromVal,$systemParametersBody);
			//Chamber From End
					
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
		//System Morog Murgi Sell Entry  End
		
		//System Load Alu Entry Start
		function getLoadAluEntry($empId) {
			$systemParametersBody = $this->getTemplateContent('fnaLoadAlu');
			
			//Max Lot No Alu Start
			$SessionYearID		= '8';
			$StartDate			= '2018-01-01';
			$EndDate			= '2018-12-31';
			$maxFlagQry			= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM fna_productloadunload"));
			$maxFlag			= $maxFlagQry['MAX(FLAG)'];
			$maxLotNoQry		= mysql_fetch_array(mysql_query("SELECT MAX(LOTNO) FROM fna_productloadunload"));
			$MaxLotNo			= $maxLotNoQry['MAX(LOTNO)'];
			$NowMaxLotNo		= $MaxLotNo + 1;
			$systemParametersBody = str_replace('<!--%[MAX_LOT_NO]%-->',$NowMaxLotNo,$systemParametersBody);
			
			//Max Lot No Alu End
			
			// Product Load Unload No  Start
			
			$maxLoadNo		= mysql_fetch_array(mysql_query("SELECT MAX(PRODUCTLOADUNLOADID) FROM fna_productloadunload"));
			$NowmaxLoadNo	= $maxLoadNo['MAX(PRODUCTLOADUNLOADID)'] + 1;
			$systemParametersBody = str_replace('<!--%[LOADUNLOAD_VIEW]%-->',$NowmaxLoadNo,$systemParametersBody);
			// Product Load Unload No  End
			
			// Project View  Start
			
			$projNameVal 				= '';
			$projQuery 				= "SELECT PROJECTID, PROJECTNAME FROM fna_project ORDER BY PROJECTNAME ASC";
			$projQueryStatement				= mysql_query($projQuery);
			while($projQueryStatementData	= mysql_fetch_array($projQueryStatement)) {
				$PROJECTID					= $projQueryStatementData["PROJECTID"];
				$PROJECTNAME				= $projQueryStatementData["PROJECTNAME"];
				$projNameVal 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$projNameVal,$systemParametersBody);
			// Project View  End
			
			// Labour View Start
			$ptView 		= '';
			$ptViewQuery 	= "
									SELECT
											LABOURNAME,
											FATHERNAME,
											ADDRESS,
											MOBILE
									FROM
											fna_labour 
									ORDER BY
											LABOURNAME
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
				
				$LABOURNAME   = $ptViewStatementData["LABOURNAME"];
				$FATHERNAME   = $ptViewStatementData["FATHERNAME"];
				$ADDRESS      = $ptViewStatementData["ADDRESS"];
				$MOBILE       = $ptViewStatementData["MOBILE"];
				
				$ptView .= "<tr valign='top' class='$class'>
									<td >{$sv}</td>
									<td >{$LABOURNAME}</td>
									<td >{$FATHERNAME}</td>
									<td >{$ADDRESS}</td>
									<td >{$MOBILE}</td>
									<td align='center'>
									<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' />
									</td>
								</tr>";
				
				$sv++;
			}
			$systemParametersBody = str_replace('<!--%[LABOUR_VIEW]%-->',$ptView,$systemParametersBody);
			
			//Labour View End
			
			// Product View  Start
			
			$prodNameVal 				= '';
			$prodQuery 				= "SELECT PRODCATTYPEID, CATEGORYTYPENAME FROM fna_productcattype ORDER BY CATEGORYTYPENAME ASC";
			$prodQueryStatement				= mysql_query($prodQuery);
			while($prodQueryStatementData	= mysql_fetch_array($prodQueryStatement)) {
				$productCatTypeId				= $prodQueryStatementData["PRODCATTYPEID"];
				$catName						= $prodQueryStatementData["CATEGORYTYPENAME"];
				$prodNameVal 					.= "<option value='".$productCatTypeId."'>".$catName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT_NAME]%-->',$prodNameVal,$systemParametersBody);
			
			
			//Labour Name View
			$labourNameVal 				= '';
			$labourQuery 				= "SELECT LABOURID, LABOURNAME FROM fna_labour ORDER BY LABOURNAME ASC";
			$labourQueryStatement				= mysql_query($labourQuery);
			while($labourQueryStatementData	= mysql_fetch_array($labourQueryStatement)) {
				$labourId						= $labourQueryStatementData["LABOURID"];
				$labourName						= $labourQueryStatementData["LABOURNAME"];
				$labourNameVal 					.= "<option value='".$labourId."'>".$labourName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[LABOUR_NAME]%-->',$labourNameVal,$systemParametersBody);
			
			$PartyNameVal 				= '';
			$PartyQuery 				= "SELECT PARTYID, PARTYNAME FROM fna_party ORDER BY PARTYNAME ASC";
			$PartyQueryStatement				= mysql_query($PartyQuery);
			while($PartyQueryStatementData	= mysql_fetch_array($PartyQueryStatement)) {
				$PartyId						= $PartyQueryStatementData["PARTYID"];
				$PartyName						= $PartyQueryStatementData["PARTYNAME"];
				$PartyNameVal 					.= "<option value='".$PartyId."'>".$PartyName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$PartyNameVal,$systemParametersBody);
			
			$prodCatTypeVal						= '';
			$prodCatQuery 						= "SELECT PRODCATTYPEID,PRODUCTNAME FROM fna_product ORDER BY PRODUCTNAME ASC";
			$prodCatQueryStatement				= mysql_query($prodCatQuery);
			while($prodCatQueryStatementData	= mysql_fetch_array($prodCatQueryStatement)) {
				$PRODCATTYPEID					= $prodCatQueryStatementData["PRODCATTYPEID"];
				$PRODUCTNAME					= $prodCatQueryStatementData["PRODUCTNAME"];
				$prodCatTypeVal					.= "<option value='".$PRODCATTYPEID."'>".$PRODUCTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT]%-->',$prodCatTypeVal,$systemParametersBody);
			
			$QuantityVal 						= '';
			$quantityQuery 						= "SELECT QID,QVALUE FROM fna_quantity ORDER BY QVALUE ASC";
			$quantityQueryStatement				= mysql_query($quantityQuery);
			while($quantityQueryStatementData	= mysql_fetch_array($quantityQueryStatement)) {
				$qId							= $quantityQueryStatementData["QID"];
				$qValue							= $quantityQueryStatementData["QVALUE"];
				$QuantityVal 					.= "<option value='".$qId."'>".$qValue."</option>";
			}
			$systemParametersBody = str_replace('<!--%[QUANTITY]%-->',$QuantityVal,$systemParametersBody);
			
			$weightTypeVal 							= '';
			$weightTypeQuery 						= "SELECT WTID,WNAME FROM fna_weight ORDER BY WNAME ASC";
			$weightTypeQueryStatement				= mysql_query($weightTypeQuery);
			while($weightTypeQueryStatementData		= mysql_fetch_array($weightTypeQueryStatement)) {
				$wtId								= $weightTypeQueryStatementData["WTID"];
				$wtName								= $weightTypeQueryStatementData["WNAME"];
				$weightTypeVal 						.= "<option value='".$wtId."'>".$wtName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[WEIGHTTYPE]%-->',$weightTypeVal,$systemParametersBody);
			
			// Packing Unit Start
			$packingNameVal 					= '';
			$PackingQuery 						= "SELECT PACKINGNAMEID,PACKINGNAME FROM fna_packingname ORDER BY PACKINGNAME ASC";
			$PackingQueryStatement				= mysql_query($PackingQuery);
			while($PackingQueryStatementData	= mysql_fetch_array($PackingQueryStatement)) {
				$packingId						= $PackingQueryStatementData["PACKINGNAMEID"];
				$packingName					= $PackingQueryStatementData["PACKINGNAME"];
				$packingNameVal 					.= "<option value='".$packingId."'>".$packingName."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PACKING_NAME_NEW]%-->',$packingNameVal,$systemParametersBody);
			$packingNameVal 	= '';
			$packingViewQuery 	= "
									SELECT
											PACKINGUNITID,
											PACKINGNAMEID,
											QID,
											WTID
									FROM
											fna_packingunit 
									ORDER BY
											PACKINGUNITID
									ASC
								";
			$sv								= 1;
			$packingViewQueryStatement				= mysql_query($packingViewQuery);
			while($packingViewQueryStatementData	= mysql_fetch_array($packingViewQueryStatement)) {
				if($sv%2==0) {
					$class	= "evenRow";
				} else {
					$class	= "oddRow";
				}
				
				$PACKINGUNITID   		= $packingViewQueryStatementData["PACKINGUNITID"];
				$PACKINGNAMEID   		= $packingViewQueryStatementData["PACKINGNAMEID"];
				$QID			   		= $packingViewQueryStatementData["QID"];
				$WTID			   		= $packingViewQueryStatementData["WTID"];
				
				$packingNameQuery = "
									SELECT
											PACKINGNAMEID,
											PACKINGNAME
									FROM
											fna_packingname 
											WHERE PACKINGNAMEID = {$PACKINGNAMEID}
									";
				$packingNameQueryStatement				= mysql_query($packingNameQuery);
				while($packingNameQueryStatementData	= mysql_fetch_array($packingNameQueryStatement)) {
					$PACKINGNAMEID_NEW   		= $packingNameQueryStatementData["PACKINGNAMEID"];
					$PACKINGNAME_NEW   			= $packingNameQueryStatementData["PACKINGNAME"];
					
				}
				
				$QidQuery = "
									SELECT
											QVALUE
									FROM
											fna_quantity 
											WHERE QID = {$QID}
									";
				$QidQueryStatement				= mysql_query($QidQuery);
				while($QidQueryStatementData	= mysql_fetch_array($QidQueryStatement)) {
					$QVALUE   		= $QidQueryStatementData["QVALUE"];
					
				}
				
				$wtidQuery = "
									SELECT
											WNAME
									FROM
											fna_weight 
											WHERE WTID = {$WTID}
									";
				$wtidQueryStatement				= mysql_query($wtidQuery);
				while($wtidQueryStatementData	= mysql_fetch_array($wtidQueryStatement)) {
					$WNAME   		= $wtidQueryStatementData["WNAME"];
					
				}
			
			
			$packingNameVal 					.= "<option value='".$PACKINGUNITID."'>".$PACKINGNAME_NEW.", ".$QVALUE.",".$WNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PACKING_NAME]%-->',$packingNameVal,$systemParametersBody);
			
			//Product View End
			
			//Chamber From Start
			$chamberFromVal							= '';
			$chamberFromQuery 						= "SELECT CHID, CHNAME FROM fna_chamber ORDER BY CHNAME ASC";
			$chamberFromQueryStatement				= mysql_query($chamberFromQuery);
			while($chamberFromQueryStatementData	= mysql_fetch_array($chamberFromQueryStatement)) {
				$chamberId							= $chamberFromQueryStatementData["CHID"];
				$chamberName						= $chamberFromQueryStatementData["CHNAME"];
				$chamberFromVal 					.= "<option value='".$chamberId."'>".$chamberName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[CHAMBER_FROM]%-->',$chamberFromVal,$systemParametersBody);
			//Chamber From End
					
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
		//System Load Alu Entry  End
		
		//System Purchase Raw Materials Entry Start
		function getPurRawMatEntry($empId) {
			$systemParametersBody = $this->getTemplateContent('feedPurchaseRawMat');
			
			// Project View  Start
			$projNameVal 				= '';
			$projQuery 				= "SELECT PROJECTID, PROJECTNAME FROM fna_project ORDER BY PROJECTNAME ASC";
			$projQueryStatement				= mysql_query($projQuery);
			while($projQueryStatementData	= mysql_fetch_array($projQueryStatement)) {
				$PROJECTID					= $projQueryStatementData["PROJECTID"];
				$PROJECTNAME				= $projQueryStatementData["PROJECTNAME"];
				$projNameVal 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$projNameVal,$systemParametersBody);
			// Project View  End
			
			
			
			//Weight Start
			$weightVal								= '';
			$weightQuery 							= "SELECT WTID, WNAME FROM fna_weight ORDER BY WNAME ASC";
			$weightQueryStatement					= mysql_query($weightQuery);
			while($weightQueryStatementData			= mysql_fetch_array($weightQueryStatement)) {
				$weightId							= $weightQueryStatementData["WTID"];
				$weightName							= $weightQueryStatementData["WNAME"];
				$weightVal		 					.= "<option value='".$weightId."'>".$weightName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[WEIGHT]%-->',$weightVal,$systemParametersBody);
			//Weight End
					
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
		//System Purchase Raw Materials Entry  End
		
		//System Purchase Raw Materials Entry Start
		function getPurRawMatOpening($empId) {
			$systemParametersBody = $this->getTemplateContent('feedPurchaseRawMatOpening');
			
			// Project View  Start
			$projNameVal 				= '';
			$projQuery 				= "SELECT PROJECTID, PROJECTNAME FROM fna_project ORDER BY PROJECTNAME ASC";
			$projQueryStatement				= mysql_query($projQuery);
			while($projQueryStatementData	= mysql_fetch_array($projQueryStatement)) {
				$PROJECTID					= $projQueryStatementData["PROJECTID"];
				$PROJECTNAME				= $projQueryStatementData["PROJECTNAME"];
				$projNameVal 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$projNameVal,$systemParametersBody);
			// Project View  End
			
			
			
			//Weight Start
			$weightVal								= '';
			$weightQuery 							= "SELECT WTID, WNAME FROM fna_weight ORDER BY WNAME ASC";
			$weightQueryStatement					= mysql_query($weightQuery);
			while($weightQueryStatementData			= mysql_fetch_array($weightQueryStatement)) {
				$weightId							= $weightQueryStatementData["WTID"];
				$weightName							= $weightQueryStatementData["WNAME"];
				$weightVal		 					.= "<option value='".$weightId."'>".$weightName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[WEIGHT]%-->',$weightVal,$systemParametersBody);
			//Weight End
					
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
		//System Purchase Raw Materials Entry  End
		
		//System Purchase Raw Materials Entry Start
		function getReadyFeedPurEntry($empId) {
			$systemParametersBody = $this->getTemplateContent('ReadyFeedPurchase');
			
			// Project View  Start
			$projNameVal 				= '';
			$projQuery 				= "SELECT PROJECTID, PROJECTNAME FROM fna_project ORDER BY PROJECTNAME ASC";
			$projQueryStatement				= mysql_query($projQuery);
			while($projQueryStatementData	= mysql_fetch_array($projQueryStatement)) {
				$PROJECTID					= $projQueryStatementData["PROJECTID"];
				$PROJECTNAME				= $projQueryStatementData["PROJECTNAME"];
				$projNameVal 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$projNameVal,$systemParametersBody);
			// Project View  End
			
			
			
			//Weight Start
			$weightVal								= '';
			$weightQuery 							= "SELECT WTID, WNAME FROM fna_weight ORDER BY WNAME ASC";
			$weightQueryStatement					= mysql_query($weightQuery);
			while($weightQueryStatementData			= mysql_fetch_array($weightQueryStatement)) {
				$weightId							= $weightQueryStatementData["WTID"];
				$weightName							= $weightQueryStatementData["WNAME"];
				$weightVal		 					.= "<option value='".$weightId."'>".$weightName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[WEIGHT]%-->',$weightVal,$systemParametersBody);
			//Weight End
			
			// Food Name View  Start
			
			$recipeVal 						= '';
			$recipeQuery					= "SELECT FOODID, FOODNAME FROM feed_fooditem ORDER BY FOODNAME ASC";
			$recipeQueryStatement			= mysql_query($recipeQuery);
			while($recipeQueryStatementData	= mysql_fetch_array($recipeQueryStatement)) {
				$FOODID						= $recipeQueryStatementData["FOODID"];
				$FOODNAME					= $recipeQueryStatementData["FOODNAME"];
				$recipeVal	 				.= "<option value='".$FOODID."'>".$FOODNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[FOOD_NAME]%-->',$recipeVal,$systemParametersBody);
			// Food Name View  End
					
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
		//System Purchase Raw Materials Entry  End
		
		//System Recipi Entry Start 
		function getRecipiEntry($empId) {
			$systemParametersBody = $this->getTemplateContent('feedRecipi');
			
			// Food Name View  Start
			
			$recipeVal 						= '';
			$recipeQuery					= "SELECT FOODID, FOODNAME FROM feed_fooditem ORDER BY FOODNAME ASC";
			$recipeQueryStatement			= mysql_query($recipeQuery);
			while($recipeQueryStatementData	= mysql_fetch_array($recipeQueryStatement)) {
				$FOODID						= $recipeQueryStatementData["FOODID"];
				$FOODNAME					= $recipeQueryStatementData["FOODNAME"];
				$recipeVal	 				.= "<option value='".$FOODID."'>".$FOODNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[FOOD_NAME]%-->',$recipeVal,$systemParametersBody);
			// Food Name View  End
			
			// Food Product Name View  Start
			$ProductVal							= '';
			$ProductQuery						= "SELECT PRODUCTID, PRODUCTNAME FROM fna_product WHERE SUBPROJECTID = '6' ORDER BY PRODUCTNAME ASC";
			$ProductQueryStatement				= mysql_query($ProductQuery);
			while($ProductQueryStatementData	= mysql_fetch_array($ProductQueryStatement)) {
				$PRODUCTID						= $ProductQueryStatementData["PRODUCTID"];
				$PRODUCTNAME					= $ProductQueryStatementData["PRODUCTNAME"];
				$ProductVal	 					.= "<option value='".$PRODUCTID."'>".$PRODUCTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[FEED_PRODUCT]%-->',$ProductVal,$systemParametersBody);
			// Food Product Name View  End
			
			//Weight Start
			$weightVal								= '';
			$weightQuery 							= "SELECT WTID, WNAME FROM fna_weight ORDER BY WNAME ASC";
			$weightQueryStatement					= mysql_query($weightQuery);
			while($weightQueryStatementData			= mysql_fetch_array($weightQueryStatement)) {
				$weightId							= $weightQueryStatementData["WTID"];
				$weightName							= $weightQueryStatementData["WNAME"];
				$weightVal		 					.= "<option value='".$weightId."'>".$weightName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[WEIGHT]%-->',$weightVal,$systemParametersBody);
			//Weight End
			
			
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
		//System Recipi Entry  End
		
		//System Production Entry Start 
		function getProductionEntry($empId) {
			$systemParametersBody = $this->getTemplateContent('feedProduction_new');
			
			// Food Name View  Start
			
			$recipeVal 						= '';
			$recipeQuery					= "SELECT f.FOODID, 
													  f.FOODNAME 
												FROM feed_fooditem f, feed_recipi r
												WHERE f.FOODID = r.FOODID
												
												ORDER BY FOODNAME ASC";
			$recipeQueryStatement			= mysql_query($recipeQuery);
			while($recipeQueryStatementData	= mysql_fetch_array($recipeQueryStatement)) {
				$FOODID						= $recipeQueryStatementData["FOODID"];
				$FOODNAME					= $recipeQueryStatementData["FOODNAME"];
				$recipeVal	 				.= "<option value='".$FOODID."'>".$FOODNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[FOOD_NAME_PROD]%-->',$recipeVal,$systemParametersBody);
			// Food Name View  End
			
			// Food Product Name View  Start
			$ProductVal							= '';
			$ProductQuery						= "SELECT PRODUCTID, PRODUCTNAME FROM fna_product WHERE SUBPROJECTID = '6' ORDER BY PRODUCTNAME ASC";
			$ProductQueryStatement				= mysql_query($ProductQuery);
			while($ProductQueryStatementData	= mysql_fetch_array($ProductQueryStatement)) {
				$PRODUCTID						= $ProductQueryStatementData["PRODUCTID"];
				$PRODUCTNAME					= $ProductQueryStatementData["PRODUCTNAME"];
				$ProductVal	 					.= "<option value='".$PRODUCTID."'>".$PRODUCTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[FEED_PRODUCT]%-->',$ProductVal,$systemParametersBody);
			// Food Product Name View  End
			
			//Weight Start
			$weightVal								= '';
			$weightQuery 							= "SELECT WTID, WNAME FROM fna_weight ORDER BY WNAME ASC";
			$weightQueryStatement					= mysql_query($weightQuery);
			while($weightQueryStatementData			= mysql_fetch_array($weightQueryStatement)) {
				$weightId							= $weightQueryStatementData["WTID"];
				$weightName							= $weightQueryStatementData["WNAME"];
				$weightVal		 					.= "<option value='".$weightId."'>".$weightName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[WEIGHT]%-->',$weightVal,$systemParametersBody);
			//Weight End
			
			
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
		//System Production Entry  End
		
		//System Profit Amount Entry Start 
		function getProfitEntry($empId) {
			$systemParametersBody = $this->getTemplateContent('feedProfitAmount');
			
			// Food Name View  Start
			
			$recipeVal 						= '';
			$recipeQuery					= "SELECT f.FOODID, 
													  f.FOODNAME 
												FROM feed_fooditem f, feed_recipi r
												WHERE f.FOODID = r.FOODID
												
												ORDER BY FOODNAME ASC";
			$recipeQueryStatement			= mysql_query($recipeQuery);
			while($recipeQueryStatementData	= mysql_fetch_array($recipeQueryStatement)) {
				$FOODID						= $recipeQueryStatementData["FOODID"];
				$FOODNAME					= $recipeQueryStatementData["FOODNAME"];
				$recipeVal	 				.= "<option value='".$FOODID."'>".$FOODNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[FOOD_NAME]%-->',$recipeVal,$systemParametersBody);
			// Food Name View  End
			
			// Food Product Name View  Start
			$ProductVal							= '';
			$ProductQuery						= "SELECT PRODUCTID, PRODUCTNAME FROM fna_product WHERE SUBPROJECTID = '6' ORDER BY PRODUCTNAME ASC";
			$ProductQueryStatement				= mysql_query($ProductQuery);
			while($ProductQueryStatementData	= mysql_fetch_array($ProductQueryStatement)) {
				$PRODUCTID						= $ProductQueryStatementData["PRODUCTID"];
				$PRODUCTNAME					= $ProductQueryStatementData["PRODUCTNAME"];
				$ProductVal	 					.= "<option value='".$PRODUCTID."'>".$PRODUCTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[FEED_PRODUCT]%-->',$ProductVal,$systemParametersBody);
			// Food Product Name View  End
			
			//Weight Start
			$weightVal								= '';
			$weightQuery 							= "SELECT WTID, WNAME FROM fna_weight ORDER BY WNAME ASC";
			$weightQueryStatement					= mysql_query($weightQuery);
			while($weightQueryStatementData			= mysql_fetch_array($weightQueryStatement)) {
				$weightId							= $weightQueryStatementData["WTID"];
				$weightName							= $weightQueryStatementData["WNAME"];
				$weightVal		 					.= "<option value='".$weightId."'>".$weightName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[WEIGHT]%-->',$weightVal,$systemParametersBody);
			//Weight End
			
			
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
		//System Profit Amount Entry  End
		
		//System Load Entry Pending Start
		function getLoadPendingEntry($empId) {
			$systemParametersBody = $this->getTemplateContent('fnaLoadPending');
			
			// Project View  Start
			
			$projNameVal 				= '';
			$projQuery 				= "SELECT PROJECTID, PROJECTNAME FROM fna_project ORDER BY PROJECTNAME ASC";
			$projQueryStatement				= mysql_query($projQuery);
			while($projQueryStatementData	= mysql_fetch_array($projQueryStatement)) {
				$PROJECTID					= $projQueryStatementData["PROJECTID"];
				$PROJECTNAME				= $projQueryStatementData["PROJECTNAME"];
				$projNameVal 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$projNameVal,$systemParametersBody);
			// Project View  End
			
			// Labour View Start
			$ptView 		= '';
			$ptViewQuery 	= "
									SELECT
											LABOURNAME,
											FATHERNAME,
											ADDRESS,
											MOBILE
									FROM
											fna_labour 
									ORDER BY
											LABOURNAME
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
				
				$LABOURNAME   = $ptViewStatementData["LABOURNAME"];
				$FATHERNAME   = $ptViewStatementData["FATHERNAME"];
				$ADDRESS      = $ptViewStatementData["ADDRESS"];
				$MOBILE       = $ptViewStatementData["MOBILE"];
				
				$ptView .= "<tr valign='top' class='$class'>
									<td >{$sv}</td>
									<td >{$LABOURNAME}</td>
									<td >{$FATHERNAME}</td>
									<td >{$ADDRESS}</td>
									<td >{$MOBILE}</td>
									<td align='center'>
									<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' />
									</td>
								</tr>";
				
				$sv++;
			}
			$systemParametersBody = str_replace('<!--%[LABOUR_VIEW]%-->',$ptView,$systemParametersBody);
			
			//Labour View End
			
			// Product View  Start
			
			$prodNameVal 				= '';
			$prodQuery 				= "SELECT PRODCATTYPEID, CATEGORYTYPENAME FROM fna_productcattype ORDER BY CATEGORYTYPENAME ASC";
			$prodQueryStatement				= mysql_query($prodQuery);
			while($prodQueryStatementData	= mysql_fetch_array($prodQueryStatement)) {
				$productCatTypeId				= $prodQueryStatementData["PRODCATTYPEID"];
				$catName						= $prodQueryStatementData["CATEGORYTYPENAME"];
				$prodNameVal 					.= "<option value='".$productCatTypeId."'>".$catName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT_NAME]%-->',$prodNameVal,$systemParametersBody);
			
			
			//Labour Name View
			$labourNameVal 				= '';
			$labourQuery 				= "SELECT LABOURID, LABOURNAME FROM fna_labour ORDER BY LABOURNAME ASC";
			$labourQueryStatement				= mysql_query($labourQuery);
			while($labourQueryStatementData	= mysql_fetch_array($labourQueryStatement)) {
				$labourId						= $labourQueryStatementData["LABOURID"];
				$labourName						= $labourQueryStatementData["LABOURNAME"];
				$labourNameVal 					.= "<option value='".$labourId."'>".$labourName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[LABOUR_NAME]%-->',$labourNameVal,$systemParametersBody);
			
			$PartyNameVal 				= '';
			$PartyQuery 				= "SELECT PARTYID, PARTYNAME FROM fna_party ORDER BY PARTYNAME ASC";
			$PartyQueryStatement				= mysql_query($PartyQuery);
			while($PartyQueryStatementData	= mysql_fetch_array($PartyQueryStatement)) {
				$PartyId						= $PartyQueryStatementData["PARTYID"];
				$PartyName						= $PartyQueryStatementData["PARTYNAME"];
				$PartyNameVal 					.= "<option value='".$PartyId."'>".$PartyName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$PartyNameVal,$systemParametersBody);
			
			$prodCatTypeVal						= '';
			$prodCatQuery 						= "SELECT PRODCATTYPEID,PRODUCTNAME FROM fna_product ORDER BY PRODUCTNAME ASC";
			$prodCatQueryStatement				= mysql_query($prodCatQuery);
			while($prodCatQueryStatementData	= mysql_fetch_array($prodCatQueryStatement)) {
				$PRODCATTYPEID					= $prodCatQueryStatementData["PRODCATTYPEID"];
				$PRODUCTNAME					= $prodCatQueryStatementData["PRODUCTNAME"];
				$prodCatTypeVal					.= "<option value='".$PRODCATTYPEID."'>".$PRODUCTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT]%-->',$prodCatTypeVal,$systemParametersBody);
			
			$QuantityVal 						= '';
			$quantityQuery 						= "SELECT QID,QVALUE FROM fna_quantity ORDER BY QVALUE ASC";
			$quantityQueryStatement				= mysql_query($quantityQuery);
			while($quantityQueryStatementData	= mysql_fetch_array($quantityQueryStatement)) {
				$qId							= $quantityQueryStatementData["QID"];
				$qValue							= $quantityQueryStatementData["QVALUE"];
				$QuantityVal 					.= "<option value='".$qId."'>".$qValue."</option>";
			}
			$systemParametersBody = str_replace('<!--%[QUANTITY]%-->',$QuantityVal,$systemParametersBody);
			
			$weightTypeVal 							= '';
			$weightTypeQuery 						= "SELECT WTID,WNAME FROM fna_weight ORDER BY WNAME ASC";
			$weightTypeQueryStatement				= mysql_query($weightTypeQuery);
			while($weightTypeQueryStatementData		= mysql_fetch_array($weightTypeQueryStatement)) {
				$wtId								= $weightTypeQueryStatementData["WTID"];
				$wtName								= $weightTypeQueryStatementData["WNAME"];
				$weightTypeVal 						.= "<option value='".$wtId."'>".$wtName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[WEIGHTTYPE]%-->',$weightTypeVal,$systemParametersBody);
			
			// Packing Unit Start
			$packingNameVal 					= '';
			$PackingQuery 						= "SELECT PACKINGNAMEID,PACKINGNAME FROM fna_packingname ORDER BY PACKINGNAME ASC";
			$PackingQueryStatement				= mysql_query($PackingQuery);
			while($PackingQueryStatementData	= mysql_fetch_array($PackingQueryStatement)) {
				$packingId						= $PackingQueryStatementData["PACKINGNAMEID"];
				$packingName					= $PackingQueryStatementData["PACKINGNAME"];
				$packingNameVal 					.= "<option value='".$packingId."'>".$packingName."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PACKING_NAME_NEW]%-->',$packingNameVal,$systemParametersBody);
			$packingNameVal 	= '';
			$packingViewQuery 	= "
									SELECT
											PACKINGUNITID,
											PACKINGNAMEID,
											QID,
											WTID
									FROM
											fna_packingunit 
									ORDER BY
											PACKINGUNITID
									ASC
								";
			$sv								= 1;
			$packingViewQueryStatement				= mysql_query($packingViewQuery);
			while($packingViewQueryStatementData	= mysql_fetch_array($packingViewQueryStatement)) {
				if($sv%2==0) {
					$class	= "evenRow";
				} else {
					$class	= "oddRow";
				}
				
				$PACKINGUNITID   		= $packingViewQueryStatementData["PACKINGUNITID"];
				$PACKINGNAMEID   		= $packingViewQueryStatementData["PACKINGNAMEID"];
				$QID			   		= $packingViewQueryStatementData["QID"];
				$WTID			   		= $packingViewQueryStatementData["WTID"];
				
				$packingNameQuery = "
									SELECT
											PACKINGNAMEID,
											PACKINGNAME
									FROM
											fna_packingname 
											WHERE PACKINGNAMEID = {$PACKINGNAMEID}
									";
				$packingNameQueryStatement				= mysql_query($packingNameQuery);
				while($packingNameQueryStatementData	= mysql_fetch_array($packingNameQueryStatement)) {
					$PACKINGNAMEID_NEW   		= $packingNameQueryStatementData["PACKINGNAMEID"];
					$PACKINGNAME_NEW   			= $packingNameQueryStatementData["PACKINGNAME"];
					
				}
				
				$QidQuery = "
									SELECT
											QVALUE
									FROM
											fna_quantity 
											WHERE QID = {$QID}
									";
				$QidQueryStatement				= mysql_query($QidQuery);
				while($QidQueryStatementData	= mysql_fetch_array($QidQueryStatement)) {
					$QVALUE   		= $QidQueryStatementData["QVALUE"];
					
				}
				
				$wtidQuery = "
									SELECT
											WNAME
									FROM
											fna_weight 
											WHERE WTID = {$WTID}
									";
				$wtidQueryStatement				= mysql_query($wtidQuery);
				while($wtidQueryStatementData	= mysql_fetch_array($wtidQueryStatement)) {
					$WNAME   		= $wtidQueryStatementData["WNAME"];
					
				}
			
			
			$packingNameVal 					.= "<option value='".$PACKINGUNITID."'>".$PACKINGNAME_NEW.", ".$QVALUE.",".$WNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PACKING_NAME]%-->',$packingNameVal,$systemParametersBody);
			
			//Product View End
			
			//Chamber From Start
			$chamberFromVal							= '';
			$chamberFromQuery 						= "SELECT CHID, CHNAME FROM fna_chamber ORDER BY CHNAME ASC";
			$chamberFromQueryStatement				= mysql_query($chamberFromQuery);
			while($chamberFromQueryStatementData	= mysql_fetch_array($chamberFromQueryStatement)) {
				$chamberId							= $chamberFromQueryStatementData["CHID"];
				$chamberName						= $chamberFromQueryStatementData["CHNAME"];
				$chamberFromVal 					.= "<option value='".$chamberId."'>".$chamberName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[CHAMBER_FROM]%-->',$chamberFromVal,$systemParametersBody);
			//Chamber From End
					
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
		//System Load Entry Pending End
		
		//System UnLoad Entry Start
		function getUnLoadEntry($empId) {
			$systemParametersBody = $this->getTemplateContent('fnaunLoad');
			
			// Project View  Start
			
			$projNameVal 				= '';
			$projQuery 				= "SELECT PROJECTID, PROJECTNAME FROM fna_project ORDER BY PROJECTNAME ASC";
			$projQueryStatement				= mysql_query($projQuery);
			while($projQueryStatementData	= mysql_fetch_array($projQueryStatement)) {
				$PROJECTID					= $projQueryStatementData["PROJECTID"];
				$PROJECTNAME				= $projQueryStatementData["PROJECTNAME"];
				$projNameVal 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$projNameVal,$systemParametersBody);
			// Project View  End
			
			
			// Product Load Unload No  Start
			
			$maxLoadNo		= mysql_fetch_array(mysql_query("SELECT MAX(PRODUCTLOADUNLOADID) FROM fna_productloadunload"));
			$NowmaxLoadNo	= $maxLoadNo['MAX(PRODUCTLOADUNLOADID)'] + 1;
			$systemParametersBody = str_replace('<!--%[LOADUNLOAD_VIEW]%-->',$NowmaxLoadNo,$systemParametersBody);
			// Product Load Unload No  End
			
			//Chamber From Start
			$chamberFromVal							= '';
			$chamberFromQuery 						= "SELECT CHID, CHNAME FROM fna_chamber ORDER BY CHNAME ASC";
			$chamberFromQueryStatement				= mysql_query($chamberFromQuery);
			while($chamberFromQueryStatementData	= mysql_fetch_array($chamberFromQueryStatement)) {
				$chamberId							= $chamberFromQueryStatementData["CHID"];
				$chamberName						= $chamberFromQueryStatementData["CHNAME"];
				$chamberFromVal 					.= "<option value='".$chamberId."'>".$chamberName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[CHAMBER_FROM]%-->',$chamberFromVal,$systemParametersBody);
			//Chamber From End
			
			// Labour View Start
			$ptView 		= '';
			$ptViewQuery 	= "
									SELECT
											LABOURNAME,
											FATHERNAME,
											ADDRESS,
											MOBILE
									FROM
											fna_labour 
									ORDER BY
											LABOURNAME
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
				
				$LABOURNAME   = $ptViewStatementData["LABOURNAME"];
				$FATHERNAME   = $ptViewStatementData["FATHERNAME"];
				$ADDRESS      = $ptViewStatementData["ADDRESS"];
				$MOBILE       = $ptViewStatementData["MOBILE"];
				
				$ptView .= "<tr valign='top' class='$class'>
									<td >{$sv}</td>
									<td >{$LABOURNAME}</td>
									<td >{$FATHERNAME}</td>
									<td >{$ADDRESS}</td>
									<td >{$MOBILE}</td>
									<td align='center'>
									<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' />
									</td>
								</tr>";
				
				$sv++;
			}
			$systemParametersBody = str_replace('<!--%[LABOUR_VIEW]%-->',$ptView,$systemParametersBody);
			
			//Labour View End
			
			// Product View  Start
			
			$prodNameVal 				= '';
			$prodQuery 				= "SELECT PRODCATTYPEID, CATEGORYTYPENAME FROM fna_productcattype ORDER BY CATEGORYTYPENAME ASC";
			$prodQueryStatement				= mysql_query($prodQuery);
			while($prodQueryStatementData	= mysql_fetch_array($prodQueryStatement)) {
				$productCatTypeId				= $prodQueryStatementData["PRODCATTYPEID"];
				$catName						= $prodQueryStatementData["CATEGORYTYPENAME"];
				$prodNameVal 					.= "<option value='".$productCatTypeId."'>".$catName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT_NAME]%-->',$prodNameVal,$systemParametersBody);
			
			
			//Labour Name View
			$labourNameVal 				= '';
			$labourQuery 				= "SELECT LABOURID, LABOURNAME FROM fna_labour ORDER BY LABOURNAME ASC";
			$labourQueryStatement				= mysql_query($labourQuery);
			while($labourQueryStatementData	= mysql_fetch_array($labourQueryStatement)) {
				$labourId						= $labourQueryStatementData["LABOURID"];
				$labourName						= $labourQueryStatementData["LABOURNAME"];
				$labourNameVal 					.= "<option value='".$labourId."'>".$labourName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[LABOUR_NAME]%-->',$labourNameVal,$systemParametersBody);
			
			$PartyNameVal 				= '';
			$PartyQuery 				= "SELECT PARTYID, PARTYNAME FROM fna_party ORDER BY PARTYNAME ASC";
			$PartyQueryStatement				= mysql_query($PartyQuery);
			while($PartyQueryStatementData	= mysql_fetch_array($PartyQueryStatement)) {
				$PartyId						= $PartyQueryStatementData["PARTYID"];
				$PartyName						= $PartyQueryStatementData["PARTYNAME"];
				$PartyNameVal 					.= "<option value='".$PartyId."'>".$PartyName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$PartyNameVal,$systemParametersBody);
			
			$prodCatTypeVal						= '';
			$prodCatQuery 						= "SELECT PRODCATTYPEID,PRODUCTNAME FROM fna_product ORDER BY PRODUCTNAME ASC";
			$prodCatQueryStatement				= mysql_query($prodCatQuery);
			while($prodCatQueryStatementData	= mysql_fetch_array($prodCatQueryStatement)) {
				$PRODCATTYPEID					= $prodCatQueryStatementData["PRODCATTYPEID"];
				$PRODUCTNAME					= $prodCatQueryStatementData["PRODUCTNAME"];
				$prodCatTypeVal					.= "<option value='".$PRODCATTYPEID."'>".$PRODUCTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT]%-->',$prodCatTypeVal,$systemParametersBody);
			
			$QuantityVal 						= '';
			$quantityQuery 						= "SELECT QID,QVALUE FROM fna_quantity ORDER BY QVALUE ASC";
			$quantityQueryStatement				= mysql_query($quantityQuery);
			while($quantityQueryStatementData	= mysql_fetch_array($quantityQueryStatement)) {
				$qId							= $quantityQueryStatementData["QID"];
				$qValue							= $quantityQueryStatementData["QVALUE"];
				$QuantityVal 					.= "<option value='".$qId."'>".$qValue."</option>";
			}
			$systemParametersBody = str_replace('<!--%[QUANTITY]%-->',$QuantityVal,$systemParametersBody);
			
			$weightTypeVal 							= '';
			$weightTypeQuery 						= "SELECT WTID,WNAME FROM fna_weight ORDER BY WNAME ASC";
			$weightTypeQueryStatement				= mysql_query($weightTypeQuery);
			while($weightTypeQueryStatementData		= mysql_fetch_array($weightTypeQueryStatement)) {
				$wtId								= $weightTypeQueryStatementData["WTID"];
				$wtName								= $weightTypeQueryStatementData["WNAME"];
				$weightTypeVal 						.= "<option value='".$wtId."'>".$wtName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[WEIGHTTYPE]%-->',$weightTypeVal,$systemParametersBody);
			
			// Packing Unit Start
			$packingNameVal 					= '';
			$PackingQuery 						= "SELECT PACKINGNAMEID,PACKINGNAME FROM fna_packingname ORDER BY PACKINGNAME ASC";
			$PackingQueryStatement				= mysql_query($PackingQuery);
			while($PackingQueryStatementData	= mysql_fetch_array($PackingQueryStatement)) {
				$packingId						= $PackingQueryStatementData["PACKINGNAMEID"];
				$packingName					= $PackingQueryStatementData["PACKINGNAME"];
				$packingNameVal 					.= "<option value='".$packingId."'>".$packingName."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PACKING_NAME_NEW]%-->',$packingNameVal,$systemParametersBody);
			$packingNameVal 	= '';
			$packingViewQuery 	= "
									SELECT
											PACKINGUNITID,
											PACKINGNAMEID,
											QID,
											WTID
									FROM
											fna_packingunit 
									ORDER BY
											PACKINGUNITID
									ASC
								";
			$sv								= 1;
			$packingViewQueryStatement				= mysql_query($packingViewQuery);
			while($packingViewQueryStatementData	= mysql_fetch_array($packingViewQueryStatement)) {
				if($sv%2==0) {
					$class	= "evenRow";
				} else {
					$class	= "oddRow";
				}
				
				$PACKINGUNITID   		= $packingViewQueryStatementData["PACKINGUNITID"];
				$PACKINGNAMEID   		= $packingViewQueryStatementData["PACKINGNAMEID"];
				$QID			   		= $packingViewQueryStatementData["QID"];
				$WTID			   		= $packingViewQueryStatementData["WTID"];
				
				$packingNameQuery = "
									SELECT
											PACKINGNAMEID,
											PACKINGNAME
									FROM
											fna_packingname 
											WHERE PACKINGNAMEID = {$PACKINGNAMEID}
									";
				$packingNameQueryStatement				= mysql_query($packingNameQuery);
				while($packingNameQueryStatementData	= mysql_fetch_array($packingNameQueryStatement)) {
					$PACKINGNAMEID_NEW   		= $packingNameQueryStatementData["PACKINGNAMEID"];
					$PACKINGNAME_NEW   			= $packingNameQueryStatementData["PACKINGNAME"];
					
				}
				
				$QidQuery = "
									SELECT
											QVALUE
									FROM
											fna_quantity 
											WHERE QID = {$QID}
									";
				$QidQueryStatement				= mysql_query($QidQuery);
				while($QidQueryStatementData	= mysql_fetch_array($QidQueryStatement)) {
					$QVALUE   		= $QidQueryStatementData["QVALUE"];
					
				}
				
				$wtidQuery = "
									SELECT
											WNAME
									FROM
											fna_weight 
											WHERE WTID = {$WTID}
									";
				$wtidQueryStatement				= mysql_query($wtidQuery);
				while($wtidQueryStatementData	= mysql_fetch_array($wtidQueryStatement)) {
					$WNAME   		= $wtidQueryStatementData["WNAME"];
					
				}
			
			
			$packingNameVal 					.= "<option value='".$PACKINGUNITID."'>".$PACKINGNAME_NEW.", ".$QVALUE.",".$WNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PACKING_NAME]%-->',$packingNameVal,$systemParametersBody);
			
			//Product View End
			
			//Chamber From Start
			$chamberFromVal							= '';
			$chamberFromQuery 						= "SELECT CHID, CHNAME FROM fna_chamber ORDER BY CHNAME ASC";
			$chamberFromQueryStatement				= mysql_query($chamberFromQuery);
			while($chamberFromQueryStatementData	= mysql_fetch_array($chamberFromQueryStatement)) {
				$chamberId							= $chamberFromQueryStatementData["CHID"];
				$chamberName						= $chamberFromQueryStatementData["CHNAME"];
				$chamberFromVal 					.= "<option value='".$chamberId."'>".$chamberName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[CHAMBER_FROM]%-->',$chamberFromVal,$systemParametersBody);
			//Chamber From End
					
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
		//System UnLoad Entry  End
		
		//System UnLoad Entry Jaber Start
		function getUnLoadEntryJaber($empId) {
			$systemParametersBody = $this->getTemplateContent('fnaunLoad070725');
			
			// Project View  Start
			
			$projNameVal 				= '';
			$projQuery 				= "SELECT PROJECTID, PROJECTNAME FROM fna_project ORDER BY PROJECTNAME ASC";
			$projQueryStatement				= mysql_query($projQuery);
			while($projQueryStatementData	= mysql_fetch_array($projQueryStatement)) {
				$PROJECTID					= $projQueryStatementData["PROJECTID"];
				$PROJECTNAME				= $projQueryStatementData["PROJECTNAME"];
				$projNameVal 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$projNameVal,$systemParametersBody);
			// Project View  End
			
			
			// Product Load Unload No  Start
			
			$maxLoadNo		= mysql_fetch_array(mysql_query("SELECT MAX(PRODUCTLOADUNLOADID) FROM fna_productloadunload"));
			$NowmaxLoadNo	= $maxLoadNo['MAX(PRODUCTLOADUNLOADID)'] + 1;
			$systemParametersBody = str_replace('<!--%[LOADUNLOAD_VIEW]%-->',$NowmaxLoadNo,$systemParametersBody);
			// Product Load Unload No  End
			
			//Chamber From Start
			$chamberFromVal							= '';
			$chamberFromQuery 						= "SELECT CHID, CHNAME FROM fna_chamber ORDER BY CHNAME ASC";
			$chamberFromQueryStatement				= mysql_query($chamberFromQuery);
			while($chamberFromQueryStatementData	= mysql_fetch_array($chamberFromQueryStatement)) {
				$chamberId							= $chamberFromQueryStatementData["CHID"];
				$chamberName						= $chamberFromQueryStatementData["CHNAME"];
				$chamberFromVal 					.= "<option value='".$chamberId."'>".$chamberName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[CHAMBER_FROM]%-->',$chamberFromVal,$systemParametersBody);
			//Chamber From End
			
			// Labour View Start
			$ptView 		= '';
			$ptViewQuery 	= "
									SELECT
											LABOURNAME,
											FATHERNAME,
											ADDRESS,
											MOBILE
									FROM
											fna_labour 
									ORDER BY
											LABOURNAME
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
				
				$LABOURNAME   = $ptViewStatementData["LABOURNAME"];
				$FATHERNAME   = $ptViewStatementData["FATHERNAME"];
				$ADDRESS      = $ptViewStatementData["ADDRESS"];
				$MOBILE       = $ptViewStatementData["MOBILE"];
				
				$ptView .= "<tr valign='top' class='$class'>
									<td >{$sv}</td>
									<td >{$LABOURNAME}</td>
									<td >{$FATHERNAME}</td>
									<td >{$ADDRESS}</td>
									<td >{$MOBILE}</td>
									<td align='center'>
									<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' />
									</td>
								</tr>";
				
				$sv++;
			}
			$systemParametersBody = str_replace('<!--%[LABOUR_VIEW]%-->',$ptView,$systemParametersBody);
			
			//Labour View End
			
			// Product View  Start
			
			$prodNameVal 				= '';
			$prodQuery 				= "SELECT PRODCATTYPEID, CATEGORYTYPENAME FROM fna_productcattype ORDER BY CATEGORYTYPENAME ASC";
			$prodQueryStatement				= mysql_query($prodQuery);
			while($prodQueryStatementData	= mysql_fetch_array($prodQueryStatement)) {
				$productCatTypeId				= $prodQueryStatementData["PRODCATTYPEID"];
				$catName						= $prodQueryStatementData["CATEGORYTYPENAME"];
				$prodNameVal 					.= "<option value='".$productCatTypeId."'>".$catName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT_NAME]%-->',$prodNameVal,$systemParametersBody);
			
			
			//Labour Name View
			$labourNameVal 				= '';
			$labourQuery 				= "SELECT LABOURID, LABOURNAME FROM fna_labour ORDER BY LABOURNAME ASC";
			$labourQueryStatement				= mysql_query($labourQuery);
			while($labourQueryStatementData	= mysql_fetch_array($labourQueryStatement)) {
				$labourId						= $labourQueryStatementData["LABOURID"];
				$labourName						= $labourQueryStatementData["LABOURNAME"];
				$labourNameVal 					.= "<option value='".$labourId."'>".$labourName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[LABOUR_NAME]%-->',$labourNameVal,$systemParametersBody);
			
			$PartyNameVal 				= '';
			$PartyQuery 				= "SELECT PARTYID, PARTYNAME FROM fna_party ORDER BY PARTYNAME ASC";
			$PartyQueryStatement				= mysql_query($PartyQuery);
			while($PartyQueryStatementData	= mysql_fetch_array($PartyQueryStatement)) {
				$PartyId						= $PartyQueryStatementData["PARTYID"];
				$PartyName						= $PartyQueryStatementData["PARTYNAME"];
				$PartyNameVal 					.= "<option value='".$PartyId."'>".$PartyName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$PartyNameVal,$systemParametersBody);
			
			$prodCatTypeVal						= '';
			$prodCatQuery 						= "SELECT PRODCATTYPEID,PRODUCTNAME FROM fna_product ORDER BY PRODUCTNAME ASC";
			$prodCatQueryStatement				= mysql_query($prodCatQuery);
			while($prodCatQueryStatementData	= mysql_fetch_array($prodCatQueryStatement)) {
				$PRODCATTYPEID					= $prodCatQueryStatementData["PRODCATTYPEID"];
				$PRODUCTNAME					= $prodCatQueryStatementData["PRODUCTNAME"];
				$prodCatTypeVal					.= "<option value='".$PRODCATTYPEID."'>".$PRODUCTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT]%-->',$prodCatTypeVal,$systemParametersBody);
			
			$QuantityVal 						= '';
			$quantityQuery 						= "SELECT QID,QVALUE FROM fna_quantity ORDER BY QVALUE ASC";
			$quantityQueryStatement				= mysql_query($quantityQuery);
			while($quantityQueryStatementData	= mysql_fetch_array($quantityQueryStatement)) {
				$qId							= $quantityQueryStatementData["QID"];
				$qValue							= $quantityQueryStatementData["QVALUE"];
				$QuantityVal 					.= "<option value='".$qId."'>".$qValue."</option>";
			}
			$systemParametersBody = str_replace('<!--%[QUANTITY]%-->',$QuantityVal,$systemParametersBody);
			
			$weightTypeVal 							= '';
			$weightTypeQuery 						= "SELECT WTID,WNAME FROM fna_weight ORDER BY WNAME ASC";
			$weightTypeQueryStatement				= mysql_query($weightTypeQuery);
			while($weightTypeQueryStatementData		= mysql_fetch_array($weightTypeQueryStatement)) {
				$wtId								= $weightTypeQueryStatementData["WTID"];
				$wtName								= $weightTypeQueryStatementData["WNAME"];
				$weightTypeVal 						.= "<option value='".$wtId."'>".$wtName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[WEIGHTTYPE]%-->',$weightTypeVal,$systemParametersBody);
			
			// Packing Unit Start
			$packingNameVal 					= '';
			$PackingQuery 						= "SELECT PACKINGNAMEID,PACKINGNAME FROM fna_packingname ORDER BY PACKINGNAME ASC";
			$PackingQueryStatement				= mysql_query($PackingQuery);
			while($PackingQueryStatementData	= mysql_fetch_array($PackingQueryStatement)) {
				$packingId						= $PackingQueryStatementData["PACKINGNAMEID"];
				$packingName					= $PackingQueryStatementData["PACKINGNAME"];
				$packingNameVal 					.= "<option value='".$packingId."'>".$packingName."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PACKING_NAME_NEW]%-->',$packingNameVal,$systemParametersBody);
			$packingNameVal 	= '';
			$packingViewQuery 	= "
									SELECT
											PACKINGUNITID,
											PACKINGNAMEID,
											QID,
											WTID
									FROM
											fna_packingunit 
									ORDER BY
											PACKINGUNITID
									ASC
								";
			$sv								= 1;
			$packingViewQueryStatement				= mysql_query($packingViewQuery);
			while($packingViewQueryStatementData	= mysql_fetch_array($packingViewQueryStatement)) {
				if($sv%2==0) {
					$class	= "evenRow";
				} else {
					$class	= "oddRow";
				}
				
				$PACKINGUNITID   		= $packingViewQueryStatementData["PACKINGUNITID"];
				$PACKINGNAMEID   		= $packingViewQueryStatementData["PACKINGNAMEID"];
				$QID			   		= $packingViewQueryStatementData["QID"];
				$WTID			   		= $packingViewQueryStatementData["WTID"];
				
				$packingNameQuery = "
									SELECT
											PACKINGNAMEID,
											PACKINGNAME
									FROM
											fna_packingname 
											WHERE PACKINGNAMEID = {$PACKINGNAMEID}
									";
				$packingNameQueryStatement				= mysql_query($packingNameQuery);
				while($packingNameQueryStatementData	= mysql_fetch_array($packingNameQueryStatement)) {
					$PACKINGNAMEID_NEW   		= $packingNameQueryStatementData["PACKINGNAMEID"];
					$PACKINGNAME_NEW   			= $packingNameQueryStatementData["PACKINGNAME"];
					
				}
				
				$QidQuery = "
									SELECT
											QVALUE
									FROM
											fna_quantity 
											WHERE QID = {$QID}
									";
				$QidQueryStatement				= mysql_query($QidQuery);
				while($QidQueryStatementData	= mysql_fetch_array($QidQueryStatement)) {
					$QVALUE   		= $QidQueryStatementData["QVALUE"];
					
				}
				
				$wtidQuery = "
									SELECT
											WNAME
									FROM
											fna_weight 
											WHERE WTID = {$WTID}
									";
				$wtidQueryStatement				= mysql_query($wtidQuery);
				while($wtidQueryStatementData	= mysql_fetch_array($wtidQueryStatement)) {
					$WNAME   		= $wtidQueryStatementData["WNAME"];
					
				}
			
			
			$packingNameVal 					.= "<option value='".$PACKINGUNITID."'>".$PACKINGNAME_NEW.", ".$QVALUE.",".$WNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PACKING_NAME]%-->',$packingNameVal,$systemParametersBody);
			
			//Product View End
			
			//Chamber From Start
			$chamberFromVal							= '';
			$chamberFromQuery 						= "SELECT CHID, CHNAME FROM fna_chamber ORDER BY CHNAME ASC";
			$chamberFromQueryStatement				= mysql_query($chamberFromQuery);
			while($chamberFromQueryStatementData	= mysql_fetch_array($chamberFromQueryStatement)) {
				$chamberId							= $chamberFromQueryStatementData["CHID"];
				$chamberName						= $chamberFromQueryStatementData["CHNAME"];
				$chamberFromVal 					.= "<option value='".$chamberId."'>".$chamberName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[CHAMBER_FROM]%-->',$chamberFromVal,$systemParametersBody);
			//Chamber From End
					
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
		//System UnLoad Entry Jaber End
		
		//System Pocket UnLoad Entry Start
		function getPocketUnLoadEntry($empId) {
			$systemParametersBody = $this->getTemplateContent('fnaPocketUnLoad');
			
			// Project View  Start
			
			$projNameVal 				= '';
			$projQuery 				= "SELECT PROJECTID, PROJECTNAME FROM fna_project ORDER BY PROJECTNAME ASC";
			$projQueryStatement				= mysql_query($projQuery);
			while($projQueryStatementData	= mysql_fetch_array($projQueryStatement)) {
				$PROJECTID					= $projQueryStatementData["PROJECTID"];
				$PROJECTNAME				= $projQueryStatementData["PROJECTNAME"];
				$projNameVal 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$projNameVal,$systemParametersBody);
			// Project View  End
			
			
			// Product Load Unload No  Start
			
			$maxLoadNo		= mysql_fetch_array(mysql_query("SELECT MAX(PRODUCTLOADUNLOADID) FROM fna_productloadunload"));
			$NowmaxLoadNo	= $maxLoadNo['MAX(PRODUCTLOADUNLOADID)'] + 1;
			$systemParametersBody = str_replace('<!--%[LOADUNLOAD_VIEW]%-->',$NowmaxLoadNo,$systemParametersBody);
			// Product Load Unload No  End
			
			//Chamber From Start
			$chamberFromVal							= '';
			$chamberFromQuery 						= "SELECT CHID, CHNAME FROM fna_chamber ORDER BY CHNAME ASC";
			$chamberFromQueryStatement				= mysql_query($chamberFromQuery);
			while($chamberFromQueryStatementData	= mysql_fetch_array($chamberFromQueryStatement)) {
				$chamberId							= $chamberFromQueryStatementData["CHID"];
				$chamberName						= $chamberFromQueryStatementData["CHNAME"];
				$chamberFromVal 					.= "<option value='".$chamberId."'>".$chamberName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[CHAMBER_FROM]%-->',$chamberFromVal,$systemParametersBody);
			//Chamber From End
			
			// Labour View Start
			$ptView 		= '';
			$ptViewQuery 	= "
									SELECT
											LABOURNAME,
											FATHERNAME,
											ADDRESS,
											MOBILE
									FROM
											fna_labour 
									ORDER BY
											LABOURNAME
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
				
				$LABOURNAME   = $ptViewStatementData["LABOURNAME"];
				$FATHERNAME   = $ptViewStatementData["FATHERNAME"];
				$ADDRESS      = $ptViewStatementData["ADDRESS"];
				$MOBILE       = $ptViewStatementData["MOBILE"];
				
				$ptView .= "<tr valign='top' class='$class'>
									<td >{$sv}</td>
									<td >{$LABOURNAME}</td>
									<td >{$FATHERNAME}</td>
									<td >{$ADDRESS}</td>
									<td >{$MOBILE}</td>
									<td align='center'>
									<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' />
									</td>
								</tr>";
				
				$sv++;
			}
			$systemParametersBody = str_replace('<!--%[LABOUR_VIEW]%-->',$ptView,$systemParametersBody);
			
			//Labour View End
			
			// Product View  Start
			
			$prodNameVal 				= '';
			$prodQuery 				= "SELECT PRODCATTYPEID, CATEGORYTYPENAME FROM fna_productcattype ORDER BY CATEGORYTYPENAME ASC";
			$prodQueryStatement				= mysql_query($prodQuery);
			while($prodQueryStatementData	= mysql_fetch_array($prodQueryStatement)) {
				$productCatTypeId				= $prodQueryStatementData["PRODCATTYPEID"];
				$catName						= $prodQueryStatementData["CATEGORYTYPENAME"];
				$prodNameVal 					.= "<option value='".$productCatTypeId."'>".$catName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT_NAME]%-->',$prodNameVal,$systemParametersBody);
			
			
			//Labour Name View
			$labourNameVal 				= '';
			$labourQuery 				= "SELECT LABOURID, LABOURNAME FROM fna_labour ORDER BY LABOURNAME ASC";
			$labourQueryStatement				= mysql_query($labourQuery);
			while($labourQueryStatementData	= mysql_fetch_array($labourQueryStatement)) {
				$labourId						= $labourQueryStatementData["LABOURID"];
				$labourName						= $labourQueryStatementData["LABOURNAME"];
				$labourNameVal 					.= "<option value='".$labourId."'>".$labourName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[LABOUR_NAME]%-->',$labourNameVal,$systemParametersBody);
			
			$PartyNameVal 				= '';
			$PartyQuery 				= "SELECT PARTYID, PARTYNAME FROM fna_party ORDER BY PARTYNAME ASC";
			$PartyQueryStatement				= mysql_query($PartyQuery);
			while($PartyQueryStatementData	= mysql_fetch_array($PartyQueryStatement)) {
				$PartyId						= $PartyQueryStatementData["PARTYID"];
				$PartyName						= $PartyQueryStatementData["PARTYNAME"];
				$PartyNameVal 					.= "<option value='".$PartyId."'>".$PartyName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$PartyNameVal,$systemParametersBody);
			
			$prodCatTypeVal						= '';
			$prodCatQuery 						= "SELECT PRODCATTYPEID,PRODUCTNAME FROM fna_product ORDER BY PRODUCTNAME ASC";
			$prodCatQueryStatement				= mysql_query($prodCatQuery);
			while($prodCatQueryStatementData	= mysql_fetch_array($prodCatQueryStatement)) {
				$PRODCATTYPEID					= $prodCatQueryStatementData["PRODCATTYPEID"];
				$PRODUCTNAME					= $prodCatQueryStatementData["PRODUCTNAME"];
				$prodCatTypeVal					.= "<option value='".$PRODCATTYPEID."'>".$PRODUCTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT]%-->',$prodCatTypeVal,$systemParametersBody);
			
			$QuantityVal 						= '';
			$quantityQuery 						= "SELECT QID,QVALUE FROM fna_quantity ORDER BY QVALUE ASC";
			$quantityQueryStatement				= mysql_query($quantityQuery);
			while($quantityQueryStatementData	= mysql_fetch_array($quantityQueryStatement)) {
				$qId							= $quantityQueryStatementData["QID"];
				$qValue							= $quantityQueryStatementData["QVALUE"];
				$QuantityVal 					.= "<option value='".$qId."'>".$qValue."</option>";
			}
			$systemParametersBody = str_replace('<!--%[QUANTITY]%-->',$QuantityVal,$systemParametersBody);
			
			$weightTypeVal 							= '';
			$weightTypeQuery 						= "SELECT WTID,WNAME FROM fna_weight ORDER BY WNAME ASC";
			$weightTypeQueryStatement				= mysql_query($weightTypeQuery);
			while($weightTypeQueryStatementData		= mysql_fetch_array($weightTypeQueryStatement)) {
				$wtId								= $weightTypeQueryStatementData["WTID"];
				$wtName								= $weightTypeQueryStatementData["WNAME"];
				$weightTypeVal 						.= "<option value='".$wtId."'>".$wtName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[WEIGHTTYPE]%-->',$weightTypeVal,$systemParametersBody);
			
			// Packing Unit Start
			$packingNameVal 					= '';
			$PackingQuery 						= "SELECT PACKINGNAMEID,PACKINGNAME FROM fna_packingname ORDER BY PACKINGNAME ASC";
			$PackingQueryStatement				= mysql_query($PackingQuery);
			while($PackingQueryStatementData	= mysql_fetch_array($PackingQueryStatement)) {
				$packingId						= $PackingQueryStatementData["PACKINGNAMEID"];
				$packingName					= $PackingQueryStatementData["PACKINGNAME"];
				$packingNameVal 					.= "<option value='".$packingId."'>".$packingName."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PACKING_NAME_NEW]%-->',$packingNameVal,$systemParametersBody);
			$packingNameVal 	= '';
			$packingViewQuery 	= "
									SELECT
											PACKINGUNITID,
											PACKINGNAMEID,
											QID,
											WTID
									FROM
											fna_packingunit 
									ORDER BY
											PACKINGUNITID
									ASC
								";
			$sv								= 1;
			$packingViewQueryStatement				= mysql_query($packingViewQuery);
			while($packingViewQueryStatementData	= mysql_fetch_array($packingViewQueryStatement)) {
				if($sv%2==0) {
					$class	= "evenRow";
				} else {
					$class	= "oddRow";
				}
				
				$PACKINGUNITID   		= $packingViewQueryStatementData["PACKINGUNITID"];
				$PACKINGNAMEID   		= $packingViewQueryStatementData["PACKINGNAMEID"];
				$QID			   		= $packingViewQueryStatementData["QID"];
				$WTID			   		= $packingViewQueryStatementData["WTID"];
				
				$packingNameQuery = "
									SELECT
											PACKINGNAMEID,
											PACKINGNAME
									FROM
											fna_packingname 
											WHERE PACKINGNAMEID = {$PACKINGNAMEID}
									";
				$packingNameQueryStatement				= mysql_query($packingNameQuery);
				while($packingNameQueryStatementData	= mysql_fetch_array($packingNameQueryStatement)) {
					$PACKINGNAMEID_NEW   		= $packingNameQueryStatementData["PACKINGNAMEID"];
					$PACKINGNAME_NEW   			= $packingNameQueryStatementData["PACKINGNAME"];
					
				}
				
				$QidQuery = "
									SELECT
											QVALUE
									FROM
											fna_quantity 
											WHERE QID = {$QID}
									";
				$QidQueryStatement				= mysql_query($QidQuery);
				while($QidQueryStatementData	= mysql_fetch_array($QidQueryStatement)) {
					$QVALUE   		= $QidQueryStatementData["QVALUE"];
					
				}
				
				$wtidQuery = "
									SELECT
											WNAME
									FROM
											fna_weight 
											WHERE WTID = {$WTID}
									";
				$wtidQueryStatement				= mysql_query($wtidQuery);
				while($wtidQueryStatementData	= mysql_fetch_array($wtidQueryStatement)) {
					$WNAME   		= $wtidQueryStatementData["WNAME"];
					
				}
			
			
			$packingNameVal 					.= "<option value='".$PACKINGUNITID."'>".$PACKINGNAME_NEW.", ".$QVALUE.",".$WNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PACKING_NAME]%-->',$packingNameVal,$systemParametersBody);
			
			//Product View End
			
			//Chamber From Start
			$chamberFromVal							= '';
			$chamberFromQuery 						= "SELECT CHID, CHNAME FROM fna_chamber ORDER BY CHNAME ASC";
			$chamberFromQueryStatement				= mysql_query($chamberFromQuery);
			while($chamberFromQueryStatementData	= mysql_fetch_array($chamberFromQueryStatement)) {
				$chamberId							= $chamberFromQueryStatementData["CHID"];
				$chamberName						= $chamberFromQueryStatementData["CHNAME"];
				$chamberFromVal 					.= "<option value='".$chamberId."'>".$chamberName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[CHAMBER_FROM]%-->',$chamberFromVal,$systemParametersBody);
			//Chamber From End
					
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
		//System Pocket UnLoad Entry  End
		
		//System Pocket UnLoad Entry Jaber Start
		function getPocketUnLoadEntryJaber($empId) {
			$systemParametersBody = $this->getTemplateContent('fnaPocketUnLoad070725');
			
			// Project View  Start
			
			$projNameVal 				= '';
			$projQuery 				= "SELECT PROJECTID, PROJECTNAME FROM fna_project ORDER BY PROJECTNAME ASC";
			$projQueryStatement				= mysql_query($projQuery);
			while($projQueryStatementData	= mysql_fetch_array($projQueryStatement)) {
				$PROJECTID					= $projQueryStatementData["PROJECTID"];
				$PROJECTNAME				= $projQueryStatementData["PROJECTNAME"];
				$projNameVal 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$projNameVal,$systemParametersBody);
			// Project View  End
			
			
			// Product Load Unload No  Start
			
			$maxLoadNo		= mysql_fetch_array(mysql_query("SELECT MAX(PRODUCTLOADUNLOADID) FROM fna_productloadunload"));
			$NowmaxLoadNo	= $maxLoadNo['MAX(PRODUCTLOADUNLOADID)'] + 1;
			$systemParametersBody = str_replace('<!--%[LOADUNLOAD_VIEW]%-->',$NowmaxLoadNo,$systemParametersBody);
			// Product Load Unload No  End
			
			//Chamber From Start
			$chamberFromVal							= '';
			$chamberFromQuery 						= "SELECT CHID, CHNAME FROM fna_chamber ORDER BY CHNAME ASC";
			$chamberFromQueryStatement				= mysql_query($chamberFromQuery);
			while($chamberFromQueryStatementData	= mysql_fetch_array($chamberFromQueryStatement)) {
				$chamberId							= $chamberFromQueryStatementData["CHID"];
				$chamberName						= $chamberFromQueryStatementData["CHNAME"];
				$chamberFromVal 					.= "<option value='".$chamberId."'>".$chamberName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[CHAMBER_FROM]%-->',$chamberFromVal,$systemParametersBody);
			//Chamber From End
			
			// Labour View Start
			$ptView 		= '';
			$ptViewQuery 	= "
									SELECT
											LABOURNAME,
											FATHERNAME,
											ADDRESS,
											MOBILE
									FROM
											fna_labour 
									ORDER BY
											LABOURNAME
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
				
				$LABOURNAME   = $ptViewStatementData["LABOURNAME"];
				$FATHERNAME   = $ptViewStatementData["FATHERNAME"];
				$ADDRESS      = $ptViewStatementData["ADDRESS"];
				$MOBILE       = $ptViewStatementData["MOBILE"];
				
				$ptView .= "<tr valign='top' class='$class'>
									<td >{$sv}</td>
									<td >{$LABOURNAME}</td>
									<td >{$FATHERNAME}</td>
									<td >{$ADDRESS}</td>
									<td >{$MOBILE}</td>
									<td align='center'>
									<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' />
									</td>
								</tr>";
				
				$sv++;
			}
			$systemParametersBody = str_replace('<!--%[LABOUR_VIEW]%-->',$ptView,$systemParametersBody);
			
			//Labour View End
			
			// Product View  Start
			
			$prodNameVal 				= '';
			$prodQuery 				= "SELECT PRODCATTYPEID, CATEGORYTYPENAME FROM fna_productcattype ORDER BY CATEGORYTYPENAME ASC";
			$prodQueryStatement				= mysql_query($prodQuery);
			while($prodQueryStatementData	= mysql_fetch_array($prodQueryStatement)) {
				$productCatTypeId				= $prodQueryStatementData["PRODCATTYPEID"];
				$catName						= $prodQueryStatementData["CATEGORYTYPENAME"];
				$prodNameVal 					.= "<option value='".$productCatTypeId."'>".$catName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT_NAME]%-->',$prodNameVal,$systemParametersBody);
			
			
			//Labour Name View
			$labourNameVal 				= '';
			$labourQuery 				= "SELECT LABOURID, LABOURNAME FROM fna_labour ORDER BY LABOURNAME ASC";
			$labourQueryStatement				= mysql_query($labourQuery);
			while($labourQueryStatementData	= mysql_fetch_array($labourQueryStatement)) {
				$labourId						= $labourQueryStatementData["LABOURID"];
				$labourName						= $labourQueryStatementData["LABOURNAME"];
				$labourNameVal 					.= "<option value='".$labourId."'>".$labourName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[LABOUR_NAME]%-->',$labourNameVal,$systemParametersBody);
			
			$PartyNameVal 				= '';
			$PartyQuery 				= "SELECT PARTYID, PARTYNAME FROM fna_party ORDER BY PARTYNAME ASC";
			$PartyQueryStatement				= mysql_query($PartyQuery);
			while($PartyQueryStatementData	= mysql_fetch_array($PartyQueryStatement)) {
				$PartyId						= $PartyQueryStatementData["PARTYID"];
				$PartyName						= $PartyQueryStatementData["PARTYNAME"];
				$PartyNameVal 					.= "<option value='".$PartyId."'>".$PartyName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$PartyNameVal,$systemParametersBody);
			
			$prodCatTypeVal						= '';
			$prodCatQuery 						= "SELECT PRODCATTYPEID,PRODUCTNAME FROM fna_product ORDER BY PRODUCTNAME ASC";
			$prodCatQueryStatement				= mysql_query($prodCatQuery);
			while($prodCatQueryStatementData	= mysql_fetch_array($prodCatQueryStatement)) {
				$PRODCATTYPEID					= $prodCatQueryStatementData["PRODCATTYPEID"];
				$PRODUCTNAME					= $prodCatQueryStatementData["PRODUCTNAME"];
				$prodCatTypeVal					.= "<option value='".$PRODCATTYPEID."'>".$PRODUCTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT]%-->',$prodCatTypeVal,$systemParametersBody);
			
			$QuantityVal 						= '';
			$quantityQuery 						= "SELECT QID,QVALUE FROM fna_quantity ORDER BY QVALUE ASC";
			$quantityQueryStatement				= mysql_query($quantityQuery);
			while($quantityQueryStatementData	= mysql_fetch_array($quantityQueryStatement)) {
				$qId							= $quantityQueryStatementData["QID"];
				$qValue							= $quantityQueryStatementData["QVALUE"];
				$QuantityVal 					.= "<option value='".$qId."'>".$qValue."</option>";
			}
			$systemParametersBody = str_replace('<!--%[QUANTITY]%-->',$QuantityVal,$systemParametersBody);
			
			$weightTypeVal 							= '';
			$weightTypeQuery 						= "SELECT WTID,WNAME FROM fna_weight ORDER BY WNAME ASC";
			$weightTypeQueryStatement				= mysql_query($weightTypeQuery);
			while($weightTypeQueryStatementData		= mysql_fetch_array($weightTypeQueryStatement)) {
				$wtId								= $weightTypeQueryStatementData["WTID"];
				$wtName								= $weightTypeQueryStatementData["WNAME"];
				$weightTypeVal 						.= "<option value='".$wtId."'>".$wtName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[WEIGHTTYPE]%-->',$weightTypeVal,$systemParametersBody);
			
			// Packing Unit Start
			$packingNameVal 					= '';
			$PackingQuery 						= "SELECT PACKINGNAMEID,PACKINGNAME FROM fna_packingname ORDER BY PACKINGNAME ASC";
			$PackingQueryStatement				= mysql_query($PackingQuery);
			while($PackingQueryStatementData	= mysql_fetch_array($PackingQueryStatement)) {
				$packingId						= $PackingQueryStatementData["PACKINGNAMEID"];
				$packingName					= $PackingQueryStatementData["PACKINGNAME"];
				$packingNameVal 					.= "<option value='".$packingId."'>".$packingName."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PACKING_NAME_NEW]%-->',$packingNameVal,$systemParametersBody);
			$packingNameVal 	= '';
			$packingViewQuery 	= "
									SELECT
											PACKINGUNITID,
											PACKINGNAMEID,
											QID,
											WTID
									FROM
											fna_packingunit 
									ORDER BY
											PACKINGUNITID
									ASC
								";
			$sv								= 1;
			$packingViewQueryStatement				= mysql_query($packingViewQuery);
			while($packingViewQueryStatementData	= mysql_fetch_array($packingViewQueryStatement)) {
				if($sv%2==0) {
					$class	= "evenRow";
				} else {
					$class	= "oddRow";
				}
				
				$PACKINGUNITID   		= $packingViewQueryStatementData["PACKINGUNITID"];
				$PACKINGNAMEID   		= $packingViewQueryStatementData["PACKINGNAMEID"];
				$QID			   		= $packingViewQueryStatementData["QID"];
				$WTID			   		= $packingViewQueryStatementData["WTID"];
				
				$packingNameQuery = "
									SELECT
											PACKINGNAMEID,
											PACKINGNAME
									FROM
											fna_packingname 
											WHERE PACKINGNAMEID = {$PACKINGNAMEID}
									";
				$packingNameQueryStatement				= mysql_query($packingNameQuery);
				while($packingNameQueryStatementData	= mysql_fetch_array($packingNameQueryStatement)) {
					$PACKINGNAMEID_NEW   		= $packingNameQueryStatementData["PACKINGNAMEID"];
					$PACKINGNAME_NEW   			= $packingNameQueryStatementData["PACKINGNAME"];
					
				}
				
				$QidQuery = "
									SELECT
											QVALUE
									FROM
											fna_quantity 
											WHERE QID = {$QID}
									";
				$QidQueryStatement				= mysql_query($QidQuery);
				while($QidQueryStatementData	= mysql_fetch_array($QidQueryStatement)) {
					$QVALUE   		= $QidQueryStatementData["QVALUE"];
					
				}
				
				$wtidQuery = "
									SELECT
											WNAME
									FROM
											fna_weight 
											WHERE WTID = {$WTID}
									";
				$wtidQueryStatement				= mysql_query($wtidQuery);
				while($wtidQueryStatementData	= mysql_fetch_array($wtidQueryStatement)) {
					$WNAME   		= $wtidQueryStatementData["WNAME"];
					
				}
			
			
			$packingNameVal 					.= "<option value='".$PACKINGUNITID."'>".$PACKINGNAME_NEW.", ".$QVALUE.",".$WNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PACKING_NAME]%-->',$packingNameVal,$systemParametersBody);
			
			//Product View End
			
			//Chamber From Start
			$chamberFromVal							= '';
			$chamberFromQuery 						= "SELECT CHID, CHNAME FROM fna_chamber ORDER BY CHNAME ASC";
			$chamberFromQueryStatement				= mysql_query($chamberFromQuery);
			while($chamberFromQueryStatementData	= mysql_fetch_array($chamberFromQueryStatement)) {
				$chamberId							= $chamberFromQueryStatementData["CHID"];
				$chamberName						= $chamberFromQueryStatementData["CHNAME"];
				$chamberFromVal 					.= "<option value='".$chamberId."'>".$chamberName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[CHAMBER_FROM]%-->',$chamberFromVal,$systemParametersBody);
			//Chamber From End
					
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
		//System Pocket UnLoad Entry Jaber End
		
		//System UnLoad Entry Start
		function getOpeningPocketUnLoadEntry($empId) {
			$systemParametersBody = $this->getTemplateContent('fnaOpeningPocketUnLoad');
			
			// Project View  Start
			
			$projNameVal 				= '';
			$projQuery 				= "SELECT PROJECTID, PROJECTNAME FROM fna_project ORDER BY PROJECTNAME ASC";
			$projQueryStatement				= mysql_query($projQuery);
			while($projQueryStatementData	= mysql_fetch_array($projQueryStatement)) {
				$PROJECTID					= $projQueryStatementData["PROJECTID"];
				$PROJECTNAME				= $projQueryStatementData["PROJECTNAME"];
				$projNameVal 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$projNameVal,$systemParametersBody);
			// Project View  End
			
			
			// Product Load Unload No  Start
			
			$maxLoadNo		= mysql_fetch_array(mysql_query("SELECT MAX(PRODUCTLOADUNLOADID) FROM fna_productloadunload"));
			$NowmaxLoadNo	= $maxLoadNo['MAX(PRODUCTLOADUNLOADID)'] + 1;
			$systemParametersBody = str_replace('<!--%[LOADUNLOAD_VIEW]%-->',$NowmaxLoadNo,$systemParametersBody);
			// Product Load Unload No  End
			
			//Chamber From Start
			$chamberFromVal							= '';
			$chamberFromQuery 						= "SELECT CHID, CHNAME FROM fna_chamber ORDER BY CHNAME ASC";
			$chamberFromQueryStatement				= mysql_query($chamberFromQuery);
			while($chamberFromQueryStatementData	= mysql_fetch_array($chamberFromQueryStatement)) {
				$chamberId							= $chamberFromQueryStatementData["CHID"];
				$chamberName						= $chamberFromQueryStatementData["CHNAME"];
				$chamberFromVal 					.= "<option value='".$chamberId."'>".$chamberName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[CHAMBER_FROM]%-->',$chamberFromVal,$systemParametersBody);
			//Chamber From End
			
			// Labour View Start
			$ptView 		= '';
			$ptViewQuery 	= "
									SELECT
											LABOURNAME,
											FATHERNAME,
											ADDRESS,
											MOBILE
									FROM
											fna_labour 
									ORDER BY
											LABOURNAME
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
				
				$LABOURNAME   = $ptViewStatementData["LABOURNAME"];
				$FATHERNAME   = $ptViewStatementData["FATHERNAME"];
				$ADDRESS      = $ptViewStatementData["ADDRESS"];
				$MOBILE       = $ptViewStatementData["MOBILE"];
				
				$ptView .= "<tr valign='top' class='$class'>
									<td >{$sv}</td>
									<td >{$LABOURNAME}</td>
									<td >{$FATHERNAME}</td>
									<td >{$ADDRESS}</td>
									<td >{$MOBILE}</td>
									<td align='center'>
									<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' />
									</td>
								</tr>";
				
				$sv++;
			}
			$systemParametersBody = str_replace('<!--%[LABOUR_VIEW]%-->',$ptView,$systemParametersBody);
			
			//Labour View End
			
			// Product View  Start
			
			$prodNameVal 				= '';
			$prodQuery 				= "SELECT PRODCATTYPEID, CATEGORYTYPENAME FROM fna_productcattype ORDER BY CATEGORYTYPENAME ASC";
			$prodQueryStatement				= mysql_query($prodQuery);
			while($prodQueryStatementData	= mysql_fetch_array($prodQueryStatement)) {
				$productCatTypeId				= $prodQueryStatementData["PRODCATTYPEID"];
				$catName						= $prodQueryStatementData["CATEGORYTYPENAME"];
				$prodNameVal 					.= "<option value='".$productCatTypeId."'>".$catName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT_NAME]%-->',$prodNameVal,$systemParametersBody);
			
			
			//Labour Name View
			$labourNameVal 				= '';
			$labourQuery 				= "SELECT LABOURID, LABOURNAME FROM fna_labour ORDER BY LABOURNAME ASC";
			$labourQueryStatement				= mysql_query($labourQuery);
			while($labourQueryStatementData	= mysql_fetch_array($labourQueryStatement)) {
				$labourId						= $labourQueryStatementData["LABOURID"];
				$labourName						= $labourQueryStatementData["LABOURNAME"];
				$labourNameVal 					.= "<option value='".$labourId."'>".$labourName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[LABOUR_NAME]%-->',$labourNameVal,$systemParametersBody);
			
			$PartyNameVal 				= '';
			$PartyQuery 				= "SELECT PARTYID, PARTYNAME FROM fna_party ORDER BY PARTYNAME ASC";
			$PartyQueryStatement				= mysql_query($PartyQuery);
			while($PartyQueryStatementData	= mysql_fetch_array($PartyQueryStatement)) {
				$PartyId						= $PartyQueryStatementData["PARTYID"];
				$PartyName						= $PartyQueryStatementData["PARTYNAME"];
				$PartyNameVal 					.= "<option value='".$PartyId."'>".$PartyName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$PartyNameVal,$systemParametersBody);
			
			$prodCatTypeVal						= '';
			$prodCatQuery 						= "SELECT PRODCATTYPEID,PRODUCTNAME FROM fna_product ORDER BY PRODUCTNAME ASC";
			$prodCatQueryStatement				= mysql_query($prodCatQuery);
			while($prodCatQueryStatementData	= mysql_fetch_array($prodCatQueryStatement)) {
				$PRODCATTYPEID					= $prodCatQueryStatementData["PRODCATTYPEID"];
				$PRODUCTNAME					= $prodCatQueryStatementData["PRODUCTNAME"];
				$prodCatTypeVal					.= "<option value='".$PRODCATTYPEID."'>".$PRODUCTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT]%-->',$prodCatTypeVal,$systemParametersBody);
			
			$QuantityVal 						= '';
			$quantityQuery 						= "SELECT QID,QVALUE FROM fna_quantity ORDER BY QVALUE ASC";
			$quantityQueryStatement				= mysql_query($quantityQuery);
			while($quantityQueryStatementData	= mysql_fetch_array($quantityQueryStatement)) {
				$qId							= $quantityQueryStatementData["QID"];
				$qValue							= $quantityQueryStatementData["QVALUE"];
				$QuantityVal 					.= "<option value='".$qId."'>".$qValue."</option>";
			}
			$systemParametersBody = str_replace('<!--%[QUANTITY]%-->',$QuantityVal,$systemParametersBody);
			
			$weightTypeVal 							= '';
			$weightTypeQuery 						= "SELECT WTID,WNAME FROM fna_weight ORDER BY WNAME ASC";
			$weightTypeQueryStatement				= mysql_query($weightTypeQuery);
			while($weightTypeQueryStatementData		= mysql_fetch_array($weightTypeQueryStatement)) {
				$wtId								= $weightTypeQueryStatementData["WTID"];
				$wtName								= $weightTypeQueryStatementData["WNAME"];
				$weightTypeVal 						.= "<option value='".$wtId."'>".$wtName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[WEIGHTTYPE]%-->',$weightTypeVal,$systemParametersBody);
			
			// Packing Unit Start
			$packingNameVal 					= '';
			$PackingQuery 						= "SELECT PACKINGNAMEID,PACKINGNAME FROM fna_packingname ORDER BY PACKINGNAME ASC";
			$PackingQueryStatement				= mysql_query($PackingQuery);
			while($PackingQueryStatementData	= mysql_fetch_array($PackingQueryStatement)) {
				$packingId						= $PackingQueryStatementData["PACKINGNAMEID"];
				$packingName					= $PackingQueryStatementData["PACKINGNAME"];
				$packingNameVal 					.= "<option value='".$packingId."'>".$packingName."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PACKING_NAME_NEW]%-->',$packingNameVal,$systemParametersBody);
			$packingNameVal 	= '';
			$packingViewQuery 	= "
									SELECT
											PACKINGUNITID,
											PACKINGNAMEID,
											QID,
											WTID
									FROM
											fna_packingunit 
									ORDER BY
											PACKINGUNITID
									ASC
								";
			$sv								= 1;
			$packingViewQueryStatement				= mysql_query($packingViewQuery);
			while($packingViewQueryStatementData	= mysql_fetch_array($packingViewQueryStatement)) {
				if($sv%2==0) {
					$class	= "evenRow";
				} else {
					$class	= "oddRow";
				}
				
				$PACKINGUNITID   		= $packingViewQueryStatementData["PACKINGUNITID"];
				$PACKINGNAMEID   		= $packingViewQueryStatementData["PACKINGNAMEID"];
				$QID			   		= $packingViewQueryStatementData["QID"];
				$WTID			   		= $packingViewQueryStatementData["WTID"];
				
				$packingNameQuery = "
									SELECT
											PACKINGNAMEID,
											PACKINGNAME
									FROM
											fna_packingname 
											WHERE PACKINGNAMEID = {$PACKINGNAMEID}
									";
				$packingNameQueryStatement				= mysql_query($packingNameQuery);
				while($packingNameQueryStatementData	= mysql_fetch_array($packingNameQueryStatement)) {
					$PACKINGNAMEID_NEW   		= $packingNameQueryStatementData["PACKINGNAMEID"];
					$PACKINGNAME_NEW   			= $packingNameQueryStatementData["PACKINGNAME"];
					
				}
				
				$QidQuery = "
									SELECT
											QVALUE
									FROM
											fna_quantity 
											WHERE QID = {$QID}
									";
				$QidQueryStatement				= mysql_query($QidQuery);
				while($QidQueryStatementData	= mysql_fetch_array($QidQueryStatement)) {
					$QVALUE   		= $QidQueryStatementData["QVALUE"];
					
				}
				
				$wtidQuery = "
									SELECT
											WNAME
									FROM
											fna_weight 
											WHERE WTID = {$WTID}
									";
				$wtidQueryStatement				= mysql_query($wtidQuery);
				while($wtidQueryStatementData	= mysql_fetch_array($wtidQueryStatement)) {
					$WNAME   		= $wtidQueryStatementData["WNAME"];
					
				}
			
			
			$packingNameVal 					.= "<option value='".$PACKINGUNITID."'>".$PACKINGNAME_NEW.", ".$QVALUE.",".$WNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PACKING_NAME]%-->',$packingNameVal,$systemParametersBody);
			
			//Product View End
			
			//Chamber From Start
			$chamberFromVal							= '';
			$chamberFromQuery 						= "SELECT CHID, CHNAME FROM fna_chamber ORDER BY CHNAME ASC";
			$chamberFromQueryStatement				= mysql_query($chamberFromQuery);
			while($chamberFromQueryStatementData	= mysql_fetch_array($chamberFromQueryStatement)) {
				$chamberId							= $chamberFromQueryStatementData["CHID"];
				$chamberName						= $chamberFromQueryStatementData["CHNAME"];
				$chamberFromVal 					.= "<option value='".$chamberId."'>".$chamberName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[CHAMBER_FROM]%-->',$chamberFromVal,$systemParametersBody);
			//Chamber From End
					
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
		//System UnLoad Entry  End
		
		//System UnLoad Opening Entry Start
		function getUnLoadOpeningEntry($empId) {
			$systemParametersBody = $this->getTemplateContent('fnaunLoadOpening');
			
			// Project View  Start
			
			$projNameVal 				= '';
			$projQuery 				= "SELECT PROJECTID, PROJECTNAME FROM fna_project ORDER BY PROJECTNAME ASC";
			$projQueryStatement				= mysql_query($projQuery);
			while($projQueryStatementData	= mysql_fetch_array($projQueryStatement)) {
				$PROJECTID					= $projQueryStatementData["PROJECTID"];
				$PROJECTNAME				= $projQueryStatementData["PROJECTNAME"];
				$projNameVal 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$projNameVal,$systemParametersBody);
			// Project View  End
			
			
			// Product Load Unload No  Start
			
			$maxLoadNo		= mysql_fetch_array(mysql_query("SELECT MAX(PRODUCTLOADUNLOADID) FROM fna_productloadunload"));
			$NowmaxLoadNo	= $maxLoadNo['MAX(PRODUCTLOADUNLOADID)'] + 1;
			$systemParametersBody = str_replace('<!--%[LOADUNLOAD_VIEW]%-->',$NowmaxLoadNo,$systemParametersBody);
			// Product Load Unload No  End
			
			//Chamber From Start
			$chamberFromVal							= '';
			$chamberFromQuery 						= "SELECT CHID, CHNAME FROM fna_chamber ORDER BY CHNAME ASC";
			$chamberFromQueryStatement				= mysql_query($chamberFromQuery);
			while($chamberFromQueryStatementData	= mysql_fetch_array($chamberFromQueryStatement)) {
				$chamberId							= $chamberFromQueryStatementData["CHID"];
				$chamberName						= $chamberFromQueryStatementData["CHNAME"];
				$chamberFromVal 					.= "<option value='".$chamberId."'>".$chamberName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[CHAMBER_FROM]%-->',$chamberFromVal,$systemParametersBody);
			//Chamber From End
			
			// Labour View Start
			$ptView 		= '';
			$ptViewQuery 	= "
									SELECT
											LABOURNAME,
											FATHERNAME,
											ADDRESS,
											MOBILE
									FROM
											fna_labour 
									ORDER BY
											LABOURNAME
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
				
				$LABOURNAME   = $ptViewStatementData["LABOURNAME"];
				$FATHERNAME   = $ptViewStatementData["FATHERNAME"];
				$ADDRESS      = $ptViewStatementData["ADDRESS"];
				$MOBILE       = $ptViewStatementData["MOBILE"];
				
				$ptView .= "<tr valign='top' class='$class'>
									<td >{$sv}</td>
									<td >{$LABOURNAME}</td>
									<td >{$FATHERNAME}</td>
									<td >{$ADDRESS}</td>
									<td >{$MOBILE}</td>
									<td align='center'>
									<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' />
									</td>
								</tr>";
				
				$sv++;
			}
			$systemParametersBody = str_replace('<!--%[LABOUR_VIEW]%-->',$ptView,$systemParametersBody);
			
			//Labour View End
			
			// Product View  Start
			
			$prodNameVal 				= '';
			$prodQuery 				= "SELECT PRODCATTYPEID, CATEGORYTYPENAME FROM fna_productcattype ORDER BY CATEGORYTYPENAME ASC";
			$prodQueryStatement				= mysql_query($prodQuery);
			while($prodQueryStatementData	= mysql_fetch_array($prodQueryStatement)) {
				$productCatTypeId				= $prodQueryStatementData["PRODCATTYPEID"];
				$catName						= $prodQueryStatementData["CATEGORYTYPENAME"];
				$prodNameVal 					.= "<option value='".$productCatTypeId."'>".$catName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT_NAME]%-->',$prodNameVal,$systemParametersBody);
			
			
			//Labour Name View
			$labourNameVal 				= '';
			$labourQuery 				= "SELECT LABOURID, LABOURNAME FROM fna_labour ORDER BY LABOURNAME ASC";
			$labourQueryStatement				= mysql_query($labourQuery);
			while($labourQueryStatementData	= mysql_fetch_array($labourQueryStatement)) {
				$labourId						= $labourQueryStatementData["LABOURID"];
				$labourName						= $labourQueryStatementData["LABOURNAME"];
				$labourNameVal 					.= "<option value='".$labourId."'>".$labourName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[LABOUR_NAME]%-->',$labourNameVal,$systemParametersBody);
			
			$PartyNameVal 				= '';
			$PartyQuery 				= "SELECT PARTYID, PARTYNAME FROM fna_party ORDER BY PARTYNAME ASC";
			$PartyQueryStatement				= mysql_query($PartyQuery);
			while($PartyQueryStatementData	= mysql_fetch_array($PartyQueryStatement)) {
				$PartyId						= $PartyQueryStatementData["PARTYID"];
				$PartyName						= $PartyQueryStatementData["PARTYNAME"];
				$PartyNameVal 					.= "<option value='".$PartyId."'>".$PartyName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$PartyNameVal,$systemParametersBody);
			
			$prodCatTypeVal						= '';
			$prodCatQuery 						= "SELECT PRODCATTYPEID,PRODUCTNAME FROM fna_product ORDER BY PRODUCTNAME ASC";
			$prodCatQueryStatement				= mysql_query($prodCatQuery);
			while($prodCatQueryStatementData	= mysql_fetch_array($prodCatQueryStatement)) {
				$PRODCATTYPEID					= $prodCatQueryStatementData["PRODCATTYPEID"];
				$PRODUCTNAME					= $prodCatQueryStatementData["PRODUCTNAME"];
				$prodCatTypeVal					.= "<option value='".$PRODCATTYPEID."'>".$PRODUCTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT]%-->',$prodCatTypeVal,$systemParametersBody);
			
			$QuantityVal 						= '';
			$quantityQuery 						= "SELECT QID,QVALUE FROM fna_quantity ORDER BY QVALUE ASC";
			$quantityQueryStatement				= mysql_query($quantityQuery);
			while($quantityQueryStatementData	= mysql_fetch_array($quantityQueryStatement)) {
				$qId							= $quantityQueryStatementData["QID"];
				$qValue							= $quantityQueryStatementData["QVALUE"];
				$QuantityVal 					.= "<option value='".$qId."'>".$qValue."</option>";
			}
			$systemParametersBody = str_replace('<!--%[QUANTITY]%-->',$QuantityVal,$systemParametersBody);
			
			$weightTypeVal 							= '';
			$weightTypeQuery 						= "SELECT WTID,WNAME FROM fna_weight ORDER BY WNAME ASC";
			$weightTypeQueryStatement				= mysql_query($weightTypeQuery);
			while($weightTypeQueryStatementData		= mysql_fetch_array($weightTypeQueryStatement)) {
				$wtId								= $weightTypeQueryStatementData["WTID"];
				$wtName								= $weightTypeQueryStatementData["WNAME"];
				$weightTypeVal 						.= "<option value='".$wtId."'>".$wtName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[WEIGHTTYPE]%-->',$weightTypeVal,$systemParametersBody);
			
			// Packing Unit Start
			$packingNameVal 					= '';
			$PackingQuery 						= "SELECT PACKINGNAMEID,PACKINGNAME FROM fna_packingname ORDER BY PACKINGNAME ASC";
			$PackingQueryStatement				= mysql_query($PackingQuery);
			while($PackingQueryStatementData	= mysql_fetch_array($PackingQueryStatement)) {
				$packingId						= $PackingQueryStatementData["PACKINGNAMEID"];
				$packingName					= $PackingQueryStatementData["PACKINGNAME"];
				$packingNameVal 					.= "<option value='".$packingId."'>".$packingName."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PACKING_NAME_NEW]%-->',$packingNameVal,$systemParametersBody);
			$packingNameVal 	= '';
			$packingViewQuery 	= "
									SELECT
											PACKINGUNITID,
											PACKINGNAMEID,
											QID,
											WTID
									FROM
											fna_packingunit 
									ORDER BY
											PACKINGUNITID
									ASC
								";
			$sv								= 1;
			$packingViewQueryStatement				= mysql_query($packingViewQuery);
			while($packingViewQueryStatementData	= mysql_fetch_array($packingViewQueryStatement)) {
				if($sv%2==0) {
					$class	= "evenRow";
				} else {
					$class	= "oddRow";
				}
				
				$PACKINGUNITID   		= $packingViewQueryStatementData["PACKINGUNITID"];
				$PACKINGNAMEID   		= $packingViewQueryStatementData["PACKINGNAMEID"];
				$QID			   		= $packingViewQueryStatementData["QID"];
				$WTID			   		= $packingViewQueryStatementData["WTID"];
				
				$packingNameQuery = "
									SELECT
											PACKINGNAMEID,
											PACKINGNAME
									FROM
											fna_packingname 
											WHERE PACKINGNAMEID = {$PACKINGNAMEID}
									";
				$packingNameQueryStatement				= mysql_query($packingNameQuery);
				while($packingNameQueryStatementData	= mysql_fetch_array($packingNameQueryStatement)) {
					$PACKINGNAMEID_NEW   		= $packingNameQueryStatementData["PACKINGNAMEID"];
					$PACKINGNAME_NEW   			= $packingNameQueryStatementData["PACKINGNAME"];
					
				}
				
				$QidQuery = "
									SELECT
											QVALUE
									FROM
											fna_quantity 
											WHERE QID = {$QID}
									";
				$QidQueryStatement				= mysql_query($QidQuery);
				while($QidQueryStatementData	= mysql_fetch_array($QidQueryStatement)) {
					$QVALUE   		= $QidQueryStatementData["QVALUE"];
					
				}
				
				$wtidQuery = "
									SELECT
											WNAME
									FROM
											fna_weight 
											WHERE WTID = {$WTID}
									";
				$wtidQueryStatement				= mysql_query($wtidQuery);
				while($wtidQueryStatementData	= mysql_fetch_array($wtidQueryStatement)) {
					$WNAME   		= $wtidQueryStatementData["WNAME"];
					
				}
			
			
			$packingNameVal 					.= "<option value='".$PACKINGUNITID."'>".$PACKINGNAME_NEW.", ".$QVALUE.",".$WNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PACKING_NAME]%-->',$packingNameVal,$systemParametersBody);
			
			//Product View End
			
			//Chamber From Start
			$chamberFromVal							= '';
			$chamberFromQuery 						= "SELECT CHID, CHNAME FROM fna_chamber ORDER BY CHNAME ASC";
			$chamberFromQueryStatement				= mysql_query($chamberFromQuery);
			while($chamberFromQueryStatementData	= mysql_fetch_array($chamberFromQueryStatement)) {
				$chamberId							= $chamberFromQueryStatementData["CHID"];
				$chamberName						= $chamberFromQueryStatementData["CHNAME"];
				$chamberFromVal 					.= "<option value='".$chamberId."'>".$chamberName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[CHAMBER_FROM]%-->',$chamberFromVal,$systemParametersBody);
			//Chamber From End
					
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
		//System UnLoad Opening Entry  End
		
		//System UnLoad To PC Entry Start
		function getUnLoadToPCEntry($empId) {
			$systemParametersBody = $this->getTemplateContent('fnaUnloadToPC');
			
			// Project View  Start
			
			$projNameVal 				= '';
			$projQuery 				= "SELECT PROJECTID, PROJECTNAME FROM fna_project WHERE PROJECTID = 18 ORDER BY PROJECTNAME ASC";
			$projQueryStatement				= mysql_query($projQuery);
			while($projQueryStatementData	= mysql_fetch_array($projQueryStatement)) {
				$PROJECTID					= $projQueryStatementData["PROJECTID"];
				$PROJECTNAME				= $projQueryStatementData["PROJECTNAME"];
				$projNameVal 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$projNameVal,$systemParametersBody);
			// Project View  End
			
			// Product Unload To PC No  Start
			
			$maxUnloadToPcNo			= mysql_fetch_array(mysql_query("SELECT MAX(UNLOADTOPCID) FROM fna_unloadtopc"));
			$NowmaxUnloadToPcNo			= $maxUnloadToPcNo['MAX(UNLOADTOPCID)'] + 1;
			$systemParametersBody		= str_replace('<!--%[UNLOADTOPC_VIEW]%-->',$NowmaxUnloadToPcNo,$systemParametersBody);
			// Product Unload To PC No  End
			
			//Chamber From Start
			$chamberFromVal							= '';
			$chamberFromQuery 						= "SELECT CHID, CHNAME FROM fna_chamber WHERE CHID = 9 ORDER BY CHNAME ASC";
			$chamberFromQueryStatement				= mysql_query($chamberFromQuery);
			while($chamberFromQueryStatementData	= mysql_fetch_array($chamberFromQueryStatement)) {
				$chamberId							= $chamberFromQueryStatementData["CHID"];
				$chamberName						= $chamberFromQueryStatementData["CHNAME"];
				$chamberFromVal 					.= "<option value='".$chamberId."'>".$chamberName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[CHAMBER_FROM]%-->',$chamberFromVal,$systemParametersBody);
			//Chamber From End
					
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
		//System UnLoad To PC Entry  End
		
		//System Transfer Entry Start
		function getTransferEntry($empId) {
			$systemParametersBody = $this->getTemplateContent('fnaTransfer');
			
			// Project View  Start
			
			$projNameVal 				= '';
			$projQuery 				= "SELECT PROJECTID, PROJECTNAME FROM fna_project ORDER BY PROJECTNAME ASC";
			$projQueryStatement				= mysql_query($projQuery);
			while($projQueryStatementData	= mysql_fetch_array($projQueryStatement)) {
				$PROJECTID					= $projQueryStatementData["PROJECTID"];
				$PROJECTNAME				= $projQueryStatementData["PROJECTNAME"];
				$projNameVal 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$projNameVal,$systemParametersBody);
			// Project View  End
			
			// Labour View Start
			$ptView 		= '';
			$ptViewQuery 	= "
									SELECT
											LABOURNAME,
											FATHERNAME,
											ADDRESS,
											MOBILE
									FROM
											fna_labour 
									ORDER BY
											LABOURNAME
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
				
				$LABOURNAME   = $ptViewStatementData["LABOURNAME"];
				$FATHERNAME   = $ptViewStatementData["FATHERNAME"];
				$ADDRESS      = $ptViewStatementData["ADDRESS"];
				$MOBILE       = $ptViewStatementData["MOBILE"];
				
				$ptView .= "<tr valign='top' class='$class'>
									<td >{$sv}</td>
									<td >{$LABOURNAME}</td>
									<td >{$FATHERNAME}</td>
									<td >{$ADDRESS}</td>
									<td >{$MOBILE}</td>
									<td align='center'>
									<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' />
									</td>
								</tr>";
				
				$sv++;
			}
			$systemParametersBody = str_replace('<!--%[LABOUR_VIEW]%-->',$ptView,$systemParametersBody);
			
			//Labour View End
			
			// Product View  Start
			
			$prodNameVal 				= '';
			$prodQuery 				= "SELECT PRODCATTYPEID, CATEGORYTYPENAME FROM fna_productcattype ORDER BY CATEGORYTYPENAME ASC";
			$prodQueryStatement				= mysql_query($prodQuery);
			while($prodQueryStatementData	= mysql_fetch_array($prodQueryStatement)) {
				$productCatTypeId				= $prodQueryStatementData["PRODCATTYPEID"];
				$catName						= $prodQueryStatementData["CATEGORYTYPENAME"];
				$prodNameVal 					.= "<option value='".$productCatTypeId."'>".$catName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT_NAME]%-->',$prodNameVal,$systemParametersBody);
			
			
			//Labour Name View
			$labourNameVal 				= '';
			$labourQuery 				= "SELECT LABOURID, LABOURNAME FROM fna_labour ORDER BY LABOURNAME ASC";
			$labourQueryStatement				= mysql_query($labourQuery);
			while($labourQueryStatementData	= mysql_fetch_array($labourQueryStatement)) {
				$labourId						= $labourQueryStatementData["LABOURID"];
				$labourName						= $labourQueryStatementData["LABOURNAME"];
				$labourNameVal 					.= "<option value='".$labourId."'>".$labourName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[LABOUR_NAME]%-->',$labourNameVal,$systemParametersBody);
			
			$PartyNameVal 				= '';
			$PartyQuery 				= "SELECT PARTYID, PARTYNAME FROM fna_party ORDER BY PARTYNAME ASC";
			$PartyQueryStatement				= mysql_query($PartyQuery);
			while($PartyQueryStatementData	= mysql_fetch_array($PartyQueryStatement)) {
				$PartyId						= $PartyQueryStatementData["PARTYID"];
				$PartyName						= $PartyQueryStatementData["PARTYNAME"];
				$PartyNameVal 					.= "<option value='".$PartyId."'>".$PartyName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$PartyNameVal,$systemParametersBody);
			
			$prodCatTypeVal						= '';
			$prodCatQuery 						= "SELECT PRODCATTYPEID,PRODUCTNAME FROM fna_product ORDER BY PRODUCTNAME ASC";
			$prodCatQueryStatement				= mysql_query($prodCatQuery);
			while($prodCatQueryStatementData	= mysql_fetch_array($prodCatQueryStatement)) {
				$PRODCATTYPEID					= $prodCatQueryStatementData["PRODCATTYPEID"];
				$PRODUCTNAME					= $prodCatQueryStatementData["PRODUCTNAME"];
				$prodCatTypeVal					.= "<option value='".$PRODCATTYPEID."'>".$PRODUCTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT]%-->',$prodCatTypeVal,$systemParametersBody);
			
			$QuantityVal 						= '';
			$quantityQuery 						= "SELECT QID,QVALUE FROM fna_quantity ORDER BY QVALUE ASC";
			$quantityQueryStatement				= mysql_query($quantityQuery);
			while($quantityQueryStatementData	= mysql_fetch_array($quantityQueryStatement)) {
				$qId							= $quantityQueryStatementData["QID"];
				$qValue							= $quantityQueryStatementData["QVALUE"];
				$QuantityVal 					.= "<option value='".$qId."'>".$qValue."</option>";
			}
			$systemParametersBody = str_replace('<!--%[QUANTITY]%-->',$QuantityVal,$systemParametersBody);
			
			$weightTypeVal 							= '';
			$weightTypeQuery 						= "SELECT WTID,WNAME FROM fna_weight ORDER BY WNAME ASC";
			$weightTypeQueryStatement				= mysql_query($weightTypeQuery);
			while($weightTypeQueryStatementData		= mysql_fetch_array($weightTypeQueryStatement)) {
				$wtId								= $weightTypeQueryStatementData["WTID"];
				$wtName								= $weightTypeQueryStatementData["WNAME"];
				$weightTypeVal 						.= "<option value='".$wtId."'>".$wtName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[WEIGHTTYPE]%-->',$weightTypeVal,$systemParametersBody);
			
			// Packing Unit Start
			$packingNameVal 					= '';
			$PackingQuery 						= "SELECT PACKINGNAMEID,PACKINGNAME FROM fna_packingname ORDER BY PACKINGNAME ASC";
			$PackingQueryStatement				= mysql_query($PackingQuery);
			while($PackingQueryStatementData	= mysql_fetch_array($PackingQueryStatement)) {
				$packingId						= $PackingQueryStatementData["PACKINGNAMEID"];
				$packingName					= $PackingQueryStatementData["PACKINGNAME"];
				$packingNameVal 					.= "<option value='".$packingId."'>".$packingName."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PACKING_NAME_NEW]%-->',$packingNameVal,$systemParametersBody);
			$packingNameVal 	= '';
			$packingViewQuery 	= "
									SELECT
											PACKINGUNITID,
											PACKINGNAMEID,
											QID,
											WTID
									FROM
											fna_packingunit 
									ORDER BY
											PACKINGUNITID
									ASC
								";
			$sv								= 1;
			$packingViewQueryStatement				= mysql_query($packingViewQuery);
			while($packingViewQueryStatementData	= mysql_fetch_array($packingViewQueryStatement)) {
				if($sv%2==0) {
					$class	= "evenRow";
				} else {
					$class	= "oddRow";
				}
				
				$PACKINGUNITID   		= $packingViewQueryStatementData["PACKINGUNITID"];
				$PACKINGNAMEID   		= $packingViewQueryStatementData["PACKINGNAMEID"];
				$QID			   		= $packingViewQueryStatementData["QID"];
				$WTID			   		= $packingViewQueryStatementData["WTID"];
				
				$packingNameQuery = "
									SELECT
											PACKINGNAMEID,
											PACKINGNAME
									FROM
											fna_packingname 
											WHERE PACKINGNAMEID = {$PACKINGNAMEID}
									";
				$packingNameQueryStatement				= mysql_query($packingNameQuery);
				while($packingNameQueryStatementData	= mysql_fetch_array($packingNameQueryStatement)) {
					$PACKINGNAMEID_NEW   		= $packingNameQueryStatementData["PACKINGNAMEID"];
					$PACKINGNAME_NEW   			= $packingNameQueryStatementData["PACKINGNAME"];
					
				}
				
				$QidQuery = "
									SELECT
											QVALUE
									FROM
											fna_quantity 
											WHERE QID = {$QID}
									";
				$QidQueryStatement				= mysql_query($QidQuery);
				while($QidQueryStatementData	= mysql_fetch_array($QidQueryStatement)) {
					$QVALUE   		= $QidQueryStatementData["QVALUE"];
					
				}
				
				$wtidQuery = "
									SELECT
											WNAME
									FROM
											fna_weight 
											WHERE WTID = {$WTID}
									";
				$wtidQueryStatement				= mysql_query($wtidQuery);
				while($wtidQueryStatementData	= mysql_fetch_array($wtidQueryStatement)) {
					$WNAME   		= $wtidQueryStatementData["WNAME"];
					
				}
			
			
			$packingNameVal 					.= "<option value='".$PACKINGUNITID."'>".$PACKINGNAME_NEW.", ".$QVALUE.",".$WNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PACKING_NAME]%-->',$packingNameVal,$systemParametersBody);
			
			//Product View End
			
			//Chamber From Start
			$chamberFromVal							= '';
			$chamberFromQuery 						= "SELECT CHID, CHNAME FROM fna_chamber ORDER BY CHID ASC";
			$chamberFromQueryStatement				= mysql_query($chamberFromQuery);
			while($chamberFromQueryStatementData	= mysql_fetch_array($chamberFromQueryStatement)) {
				$chamberId							= $chamberFromQueryStatementData["CHID"];
				$chamberName						= $chamberFromQueryStatementData["CHNAME"];
				$chamberFromVal 					.= "<option value='".$chamberId."'>".$chamberName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[CHAMBER_FROM]%-->',$chamberFromVal,$systemParametersBody);
			//Chamber From End
					
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
		//System Transfer Entry  End
		
		//System Palot Entry Start
		function getPalotEntry($empId) {
			$systemParametersBody = $this->getTemplateContent('fnaPalot');
			
			// Project View  Start
			
			$projNameVal 				= '';
			$projQuery 				= "SELECT PROJECTID, PROJECTNAME FROM fna_project ORDER BY PROJECTNAME ASC";
			$projQueryStatement				= mysql_query($projQuery);
			while($projQueryStatementData	= mysql_fetch_array($projQueryStatement)) {
				$PROJECTID					= $projQueryStatementData["PROJECTID"];
				$PROJECTNAME				= $projQueryStatementData["PROJECTNAME"];
				$projNameVal 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$projNameVal,$systemParametersBody);
			// Project View  End
			
			// Labour View Start
			$ptView 		= '';
			$ptViewQuery 	= "
									SELECT
											LABOURNAME,
											FATHERNAME,
											ADDRESS,
											MOBILE
									FROM
											fna_labour 
									ORDER BY
											LABOURNAME
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
				
				$LABOURNAME   = $ptViewStatementData["LABOURNAME"];
				$FATHERNAME   = $ptViewStatementData["FATHERNAME"];
				$ADDRESS      = $ptViewStatementData["ADDRESS"];
				$MOBILE       = $ptViewStatementData["MOBILE"];
				
				$ptView .= "<tr valign='top' class='$class'>
									<td >{$sv}</td>
									<td >{$LABOURNAME}</td>
									<td >{$FATHERNAME}</td>
									<td >{$ADDRESS}</td>
									<td >{$MOBILE}</td>
									<td align='center'>
									<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' />
									</td>
								</tr>";
				
				$sv++;
			}
			$systemParametersBody = str_replace('<!--%[LABOUR_VIEW]%-->',$ptView,$systemParametersBody);
			
			//Labour View End
			
			// Product View  Start
			
			$prodNameVal 				= '';
			$prodQuery 				= "SELECT PRODCATTYPEID, CATEGORYTYPENAME FROM fna_productcattype ORDER BY CATEGORYTYPENAME ASC";
			$prodQueryStatement				= mysql_query($prodQuery);
			while($prodQueryStatementData	= mysql_fetch_array($prodQueryStatement)) {
				$productCatTypeId				= $prodQueryStatementData["PRODCATTYPEID"];
				$catName						= $prodQueryStatementData["CATEGORYTYPENAME"];
				$prodNameVal 					.= "<option value='".$productCatTypeId."'>".$catName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT_NAME]%-->',$prodNameVal,$systemParametersBody);
			
			
			//Labour Name View
			$labourNameVal 				= '';
			$labourQuery 				= "SELECT LABOURID, LABOURNAME FROM fna_labour ORDER BY LABOURNAME ASC";
			$labourQueryStatement				= mysql_query($labourQuery);
			while($labourQueryStatementData	= mysql_fetch_array($labourQueryStatement)) {
				$labourId						= $labourQueryStatementData["LABOURID"];
				$labourName						= $labourQueryStatementData["LABOURNAME"];
				$labourNameVal 					.= "<option value='".$labourId."'>".$labourName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[LABOUR_NAME]%-->',$labourNameVal,$systemParametersBody);
			
			$PartyNameVal 				= '';
			$PartyQuery 				= "SELECT PARTYID, PARTYNAME FROM fna_party ORDER BY PARTYNAME ASC";
			$PartyQueryStatement				= mysql_query($PartyQuery);
			while($PartyQueryStatementData	= mysql_fetch_array($PartyQueryStatement)) {
				$PartyId						= $PartyQueryStatementData["PARTYID"];
				$PartyName						= $PartyQueryStatementData["PARTYNAME"];
				$PartyNameVal 					.= "<option value='".$PartyId."'>".$PartyName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$PartyNameVal,$systemParametersBody);
			
			$prodCatTypeVal						= '';
			$prodCatQuery 						= "SELECT PRODCATTYPEID,PRODUCTNAME FROM fna_product ORDER BY PRODUCTNAME ASC";
			$prodCatQueryStatement				= mysql_query($prodCatQuery);
			while($prodCatQueryStatementData	= mysql_fetch_array($prodCatQueryStatement)) {
				$PRODCATTYPEID					= $prodCatQueryStatementData["PRODCATTYPEID"];
				$PRODUCTNAME					= $prodCatQueryStatementData["PRODUCTNAME"];
				$prodCatTypeVal					.= "<option value='".$PRODCATTYPEID."'>".$PRODUCTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT]%-->',$prodCatTypeVal,$systemParametersBody);
			
			$QuantityVal 						= '';
			$quantityQuery 						= "SELECT QID,QVALUE FROM fna_quantity ORDER BY QVALUE ASC";
			$quantityQueryStatement				= mysql_query($quantityQuery);
			while($quantityQueryStatementData	= mysql_fetch_array($quantityQueryStatement)) {
				$qId							= $quantityQueryStatementData["QID"];
				$qValue							= $quantityQueryStatementData["QVALUE"];
				$QuantityVal 					.= "<option value='".$qId."'>".$qValue."</option>";
			}
			$systemParametersBody = str_replace('<!--%[QUANTITY]%-->',$QuantityVal,$systemParametersBody);
			
			$weightTypeVal 							= '';
			$weightTypeQuery 						= "SELECT WTID,WNAME FROM fna_weight ORDER BY WNAME ASC";
			$weightTypeQueryStatement				= mysql_query($weightTypeQuery);
			while($weightTypeQueryStatementData		= mysql_fetch_array($weightTypeQueryStatement)) {
				$wtId								= $weightTypeQueryStatementData["WTID"];
				$wtName								= $weightTypeQueryStatementData["WNAME"];
				$weightTypeVal 						.= "<option value='".$wtId."'>".$wtName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[WEIGHTTYPE]%-->',$weightTypeVal,$systemParametersBody);
			
			// Packing Unit Start
			$packingNameVal 					= '';
			$PackingQuery 						= "SELECT PACKINGNAMEID,PACKINGNAME FROM fna_packingname ORDER BY PACKINGNAME ASC";
			$PackingQueryStatement				= mysql_query($PackingQuery);
			while($PackingQueryStatementData	= mysql_fetch_array($PackingQueryStatement)) {
				$packingId						= $PackingQueryStatementData["PACKINGNAMEID"];
				$packingName					= $PackingQueryStatementData["PACKINGNAME"];
				$packingNameVal 					.= "<option value='".$packingId."'>".$packingName."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PACKING_NAME_NEW]%-->',$packingNameVal,$systemParametersBody);
			$packingNameVal 	= '';
			$packingViewQuery 	= "
									SELECT
											PACKINGUNITID,
											PACKINGNAMEID,
											QID,
											WTID
									FROM
											fna_packingunit 
									ORDER BY
											PACKINGUNITID
									ASC
								";
			$sv								= 1;
			$packingViewQueryStatement				= mysql_query($packingViewQuery);
			while($packingViewQueryStatementData	= mysql_fetch_array($packingViewQueryStatement)) {
				if($sv%2==0) {
					$class	= "evenRow";
				} else {
					$class	= "oddRow";
				}
				
				$PACKINGUNITID   		= $packingViewQueryStatementData["PACKINGUNITID"];
				$PACKINGNAMEID   		= $packingViewQueryStatementData["PACKINGNAMEID"];
				$QID			   		= $packingViewQueryStatementData["QID"];
				$WTID			   		= $packingViewQueryStatementData["WTID"];
				
				$packingNameQuery = "
									SELECT
											PACKINGNAMEID,
											PACKINGNAME
									FROM
											fna_packingname 
											WHERE PACKINGNAMEID = {$PACKINGNAMEID}
									";
				$packingNameQueryStatement				= mysql_query($packingNameQuery);
				while($packingNameQueryStatementData	= mysql_fetch_array($packingNameQueryStatement)) {
					$PACKINGNAMEID_NEW   		= $packingNameQueryStatementData["PACKINGNAMEID"];
					$PACKINGNAME_NEW   			= $packingNameQueryStatementData["PACKINGNAME"];
					
				}
				
				$QidQuery = "
									SELECT
											QVALUE
									FROM
											fna_quantity 
											WHERE QID = {$QID}
									";
				$QidQueryStatement				= mysql_query($QidQuery);
				while($QidQueryStatementData	= mysql_fetch_array($QidQueryStatement)) {
					$QVALUE   		= $QidQueryStatementData["QVALUE"];
					
				}
				
				$wtidQuery = "
									SELECT
											WNAME
									FROM
											fna_weight 
											WHERE WTID = {$WTID}
									";
				$wtidQueryStatement				= mysql_query($wtidQuery);
				while($wtidQueryStatementData	= mysql_fetch_array($wtidQueryStatement)) {
					$WNAME   		= $wtidQueryStatementData["WNAME"];
					
				}
			
			
			$packingNameVal 					.= "<option value='".$PACKINGUNITID."'>".$PACKINGNAME_NEW.", ".$QVALUE.",".$WNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PACKING_NAME]%-->',$packingNameVal,$systemParametersBody);
			
			//Product View End
			
			//Chamber From Start
			$chamberFromVal							= '';
			$chamberFromQuery 						= "SELECT CHID, CHNAME FROM fna_chamber ORDER BY CHID ASC";
			$chamberFromQueryStatement				= mysql_query($chamberFromQuery);
			while($chamberFromQueryStatementData	= mysql_fetch_array($chamberFromQueryStatement)) {
				$chamberId							= $chamberFromQueryStatementData["CHID"];
				$chamberName						= $chamberFromQueryStatementData["CHNAME"];
				$chamberFromVal 					.= "<option value='".$chamberId."'>".$chamberName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[CHAMBER_FROM]%-->',$chamberFromVal,$systemParametersBody);
			//Chamber From End
					
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
		//System Palot Entry  End
		
		//System Palot Entry Start
		function getShadeEntry($empId) {
			$systemParametersBody = $this->getTemplateContent('fnaShade');
			
			// Project View  Start
			
			$projNameVal 				= '';
			$projQuery 				= "SELECT PROJECTID, PROJECTNAME FROM fna_project ORDER BY PROJECTNAME ASC";
			$projQueryStatement				= mysql_query($projQuery);
			while($projQueryStatementData	= mysql_fetch_array($projQueryStatement)) {
				$PROJECTID					= $projQueryStatementData["PROJECTID"];
				$PROJECTNAME				= $projQueryStatementData["PROJECTNAME"];
				$projNameVal 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$projNameVal,$systemParametersBody);
			// Project View  End
			
			// Labour View Start
			$ptView 		= '';
			$ptViewQuery 	= "
									SELECT
											LABOURNAME,
											FATHERNAME,
											ADDRESS,
											MOBILE
									FROM
											fna_labour 
									ORDER BY
											LABOURNAME
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
				
				$LABOURNAME   = $ptViewStatementData["LABOURNAME"];
				$FATHERNAME   = $ptViewStatementData["FATHERNAME"];
				$ADDRESS      = $ptViewStatementData["ADDRESS"];
				$MOBILE       = $ptViewStatementData["MOBILE"];
				
				$ptView .= "<tr valign='top' class='$class'>
									<td >{$sv}</td>
									<td >{$LABOURNAME}</td>
									<td >{$FATHERNAME}</td>
									<td >{$ADDRESS}</td>
									<td >{$MOBILE}</td>
									<td align='center'>
									<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' />
									</td>
								</tr>";
				
				$sv++;
			}
			$systemParametersBody = str_replace('<!--%[LABOUR_VIEW]%-->',$ptView,$systemParametersBody);
			
			//Labour View End
			
			// Product View  Start
			
			$prodNameVal 				= '';
			$prodQuery 				= "SELECT PRODCATTYPEID, CATEGORYTYPENAME FROM fna_productcattype ORDER BY CATEGORYTYPENAME ASC";
			$prodQueryStatement				= mysql_query($prodQuery);
			while($prodQueryStatementData	= mysql_fetch_array($prodQueryStatement)) {
				$productCatTypeId				= $prodQueryStatementData["PRODCATTYPEID"];
				$catName						= $prodQueryStatementData["CATEGORYTYPENAME"];
				$prodNameVal 					.= "<option value='".$productCatTypeId."'>".$catName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT_NAME]%-->',$prodNameVal,$systemParametersBody);
			
			
			//Labour Name View
			$labourNameVal 				= '';
			$labourQuery 				= "SELECT LABOURID, LABOURNAME FROM fna_labour ORDER BY LABOURNAME ASC";
			$labourQueryStatement				= mysql_query($labourQuery);
			while($labourQueryStatementData	= mysql_fetch_array($labourQueryStatement)) {
				$labourId						= $labourQueryStatementData["LABOURID"];
				$labourName						= $labourQueryStatementData["LABOURNAME"];
				$labourNameVal 					.= "<option value='".$labourId."'>".$labourName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[LABOUR_NAME]%-->',$labourNameVal,$systemParametersBody);
			
			$PartyNameVal 				= '';
			$PartyQuery 				= "SELECT PARTYID, PARTYNAME FROM fna_party ORDER BY PARTYNAME ASC";
			$PartyQueryStatement				= mysql_query($PartyQuery);
			while($PartyQueryStatementData	= mysql_fetch_array($PartyQueryStatement)) {
				$PartyId						= $PartyQueryStatementData["PARTYID"];
				$PartyName						= $PartyQueryStatementData["PARTYNAME"];
				$PartyNameVal 					.= "<option value='".$PartyId."'>".$PartyName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$PartyNameVal,$systemParametersBody);
			
			$prodCatTypeVal						= '';
			$prodCatQuery 						= "SELECT PRODCATTYPEID,PRODUCTNAME FROM fna_product ORDER BY PRODUCTNAME ASC";
			$prodCatQueryStatement				= mysql_query($prodCatQuery);
			while($prodCatQueryStatementData	= mysql_fetch_array($prodCatQueryStatement)) {
				$PRODCATTYPEID					= $prodCatQueryStatementData["PRODCATTYPEID"];
				$PRODUCTNAME					= $prodCatQueryStatementData["PRODUCTNAME"];
				$prodCatTypeVal					.= "<option value='".$PRODCATTYPEID."'>".$PRODUCTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT]%-->',$prodCatTypeVal,$systemParametersBody);
			
			$QuantityVal 						= '';
			$quantityQuery 						= "SELECT QID,QVALUE FROM fna_quantity ORDER BY QVALUE ASC";
			$quantityQueryStatement				= mysql_query($quantityQuery);
			while($quantityQueryStatementData	= mysql_fetch_array($quantityQueryStatement)) {
				$qId							= $quantityQueryStatementData["QID"];
				$qValue							= $quantityQueryStatementData["QVALUE"];
				$QuantityVal 					.= "<option value='".$qId."'>".$qValue."</option>";
			}
			$systemParametersBody = str_replace('<!--%[QUANTITY]%-->',$QuantityVal,$systemParametersBody);
			
			$weightTypeVal 							= '';
			$weightTypeQuery 						= "SELECT WTID,WNAME FROM fna_weight ORDER BY WNAME ASC";
			$weightTypeQueryStatement				= mysql_query($weightTypeQuery);
			while($weightTypeQueryStatementData		= mysql_fetch_array($weightTypeQueryStatement)) {
				$wtId								= $weightTypeQueryStatementData["WTID"];
				$wtName								= $weightTypeQueryStatementData["WNAME"];
				$weightTypeVal 						.= "<option value='".$wtId."'>".$wtName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[WEIGHTTYPE]%-->',$weightTypeVal,$systemParametersBody);
			
			// Packing Unit Start
			$packingNameVal 					= '';
			$PackingQuery 						= "SELECT PACKINGNAMEID,PACKINGNAME FROM fna_packingname ORDER BY PACKINGNAME ASC";
			$PackingQueryStatement				= mysql_query($PackingQuery);
			while($PackingQueryStatementData	= mysql_fetch_array($PackingQueryStatement)) {
				$packingId						= $PackingQueryStatementData["PACKINGNAMEID"];
				$packingName					= $PackingQueryStatementData["PACKINGNAME"];
				$packingNameVal 					.= "<option value='".$packingId."'>".$packingName."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PACKING_NAME_NEW]%-->',$packingNameVal,$systemParametersBody);
			$packingNameVal 	= '';
			$packingViewQuery 	= "
									SELECT
											PACKINGUNITID,
											PACKINGNAMEID,
											QID,
											WTID
									FROM
											fna_packingunit 
									ORDER BY
											PACKINGUNITID
									ASC
								";
			$sv								= 1;
			$packingViewQueryStatement				= mysql_query($packingViewQuery);
			while($packingViewQueryStatementData	= mysql_fetch_array($packingViewQueryStatement)) {
				if($sv%2==0) {
					$class	= "evenRow";
				} else {
					$class	= "oddRow";
				}
				
				$PACKINGUNITID   		= $packingViewQueryStatementData["PACKINGUNITID"];
				$PACKINGNAMEID   		= $packingViewQueryStatementData["PACKINGNAMEID"];
				$QID			   		= $packingViewQueryStatementData["QID"];
				$WTID			   		= $packingViewQueryStatementData["WTID"];
				
				$packingNameQuery = "
									SELECT
											PACKINGNAMEID,
											PACKINGNAME
									FROM
											fna_packingname 
											WHERE PACKINGNAMEID = {$PACKINGNAMEID}
									";
				$packingNameQueryStatement				= mysql_query($packingNameQuery);
				while($packingNameQueryStatementData	= mysql_fetch_array($packingNameQueryStatement)) {
					$PACKINGNAMEID_NEW   		= $packingNameQueryStatementData["PACKINGNAMEID"];
					$PACKINGNAME_NEW   			= $packingNameQueryStatementData["PACKINGNAME"];
					
				}
				
				$QidQuery = "
									SELECT
											QVALUE
									FROM
											fna_quantity 
											WHERE QID = {$QID}
									";
				$QidQueryStatement				= mysql_query($QidQuery);
				while($QidQueryStatementData	= mysql_fetch_array($QidQueryStatement)) {
					$QVALUE   		= $QidQueryStatementData["QVALUE"];
					
				}
				
				$wtidQuery = "
									SELECT
											WNAME
									FROM
											fna_weight 
											WHERE WTID = {$WTID}
									";
				$wtidQueryStatement				= mysql_query($wtidQuery);
				while($wtidQueryStatementData	= mysql_fetch_array($wtidQueryStatement)) {
					$WNAME   		= $wtidQueryStatementData["WNAME"];
					
				}
			
			
			$packingNameVal 					.= "<option value='".$PACKINGUNITID."'>".$PACKINGNAME_NEW.", ".$QVALUE.",".$WNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PACKING_NAME]%-->',$packingNameVal,$systemParametersBody);
			
			//Product View End
			
			//Chamber From Start
			$chamberFromVal							= '';
			$chamberFromQuery 						= "SELECT CHID, CHNAME FROM fna_chamber ORDER BY CHNAME ASC";
			$chamberFromQueryStatement				= mysql_query($chamberFromQuery);
			while($chamberFromQueryStatementData	= mysql_fetch_array($chamberFromQueryStatement)) {
				$chamberId							= $chamberFromQueryStatementData["CHID"];
				$chamberName						= $chamberFromQueryStatementData["CHNAME"];
				$chamberFromVal 					.= "<option value='".$chamberId."'>".$chamberName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[CHAMBER_FROM]%-->',$chamberFromVal,$systemParametersBody);
			//Chamber From End
					
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
		//System Palot Entry  End
		
		//System Labour Bill Payment Entry Start
		function getLabourBillPaymentEntry($empId) {
			$systemParametersBody = $this->getTemplateContent('fnaLabourBillPayment');
			
			// Project View  Start
			
			$projNameVal 				= '';
			$projQuery 				= "SELECT PROJECTID, PROJECTNAME FROM fna_project where STATUS = 'Active' ORDER BY PROJECTNAME ASC";
			$projQueryStatement				= mysql_query($projQuery);
			while($projQueryStatementData	= mysql_fetch_array($projQueryStatement)) {
				$PROJECTID					= $projQueryStatementData["PROJECTID"];
				$PROJECTNAME				= $projQueryStatementData["PROJECTNAME"];
				$projNameVal 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$projNameVal,$systemParametersBody);
			// Project View  End
			//Batch Select start
			
			$BatchVal 							= '';
			$BatchQuery 						= "SELECT BATCHNO FROM pal_batchopen ORDER BY BATCHNO DESC";
			$BatchQueryStatement				= mysql_query($BatchQuery);
			while($BatchQueryStatementData		= mysql_fetch_array($BatchQueryStatement)) {
				$BATCHNO						= $BatchQueryStatementData["BATCHNO"];
				$BatchVal 						.= "<option value='".$BATCHNO."'>".$BATCHNO."</option>";
			}
			$systemParametersBody = str_replace('<!--%[BATCH_NO]%-->',$BatchVal,$systemParametersBody);
			
			//Batch Select End 
			
			// Labour View Start
			$ptView 		= '';
			$ptViewQuery 	= "
									SELECT
											LABOURNAME,
											FATHERNAME,
											ADDRESS,
											MOBILE
									FROM
											fna_labour 
									ORDER BY
											LABOURNAME
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
				
				$LABOURNAME   = $ptViewStatementData["LABOURNAME"];
				$FATHERNAME   = $ptViewStatementData["FATHERNAME"];
				$ADDRESS      = $ptViewStatementData["ADDRESS"];
				$MOBILE       = $ptViewStatementData["MOBILE"];
				
				$ptView .= "<tr valign='top' class='$class'>
									<td >{$sv}</td>
									<td >{$LABOURNAME}</td>
									<td >{$FATHERNAME}</td>
									<td >{$ADDRESS}</td>
									<td >{$MOBILE}</td>
									<td align='center'>
									<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' />
									</td>
								</tr>";
				
				$sv++;
			}
			$systemParametersBody = str_replace('<!--%[LABOUR_VIEW]%-->',$ptView,$systemParametersBody);
			
			//Labour View End
			
			// Product View  Start
			
			$prodNameVal 				= '';
			$prodQuery 				= "SELECT PRODCATTYPEID, CATEGORYTYPENAME FROM fna_productcattype ORDER BY CATEGORYTYPENAME ASC";
			$prodQueryStatement				= mysql_query($prodQuery);
			while($prodQueryStatementData	= mysql_fetch_array($prodQueryStatement)) {
				$productCatTypeId				= $prodQueryStatementData["PRODCATTYPEID"];
				$catName						= $prodQueryStatementData["CATEGORYTYPENAME"];
				$prodNameVal 					.= "<option value='".$productCatTypeId."'>".$catName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT_NAME]%-->',$prodNameVal,$systemParametersBody);
			
			// Expanse Head View  Start
			
			$ExpHeadNameVal 					= '';
			$ExpHeadQuery 						= "SELECT EXPHID, EXPHEADNAME FROM fna_expense_head ORDER BY EXPHEADNAME ASC";
			$ExpHeadQueryStatement				= mysql_query($ExpHeadQuery);
			while($ExpHeadQueryStatementData	= mysql_fetch_array($ExpHeadQueryStatement)) {
				$EXPHID							= $ExpHeadQueryStatementData["EXPHID"];
				$EXPHEADNAME					= $ExpHeadQueryStatementData["EXPHEADNAME"];
				$ExpHeadNameVal 					.= "<option value='".$EXPHID."'>".$EXPHEADNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[EXPANSE_HEAD_NAME]%-->',$ExpHeadNameVal,$systemParametersBody);
			// Expanse Head View  End
			
			//Labour Name View
			$labourNameVal 				= '';
			$labourQuery 				= "SELECT LABOURID, LABOURNAME FROM fna_labour ORDER BY LABOURNAME ASC";
			$labourQueryStatement				= mysql_query($labourQuery);
			while($labourQueryStatementData	= mysql_fetch_array($labourQueryStatement)) {
				$labourId						= $labourQueryStatementData["LABOURID"];
				$labourName						= $labourQueryStatementData["LABOURNAME"];
				$labourNameVal 					.= "<option value='".$labourId."'>".$labourName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[LABOUR_NAME]%-->',$labourNameVal,$systemParametersBody);
			
			$PartyNameVal 				= '';
			$PartyQuery 				= "SELECT PARTYID, PARTYNAME FROM fna_party ORDER BY PARTYNAME ASC";
			$PartyQueryStatement				= mysql_query($PartyQuery);
			while($PartyQueryStatementData	= mysql_fetch_array($PartyQueryStatement)) {
				$PartyId						= $PartyQueryStatementData["PARTYID"];
				$PartyName						= $PartyQueryStatementData["PARTYNAME"];
				$PartyNameVal 					.= "<option value='".$PartyId."'>".$PartyName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$PartyNameVal,$systemParametersBody);
			
			$prodCatTypeVal						= '';
			$prodCatQuery 						= "SELECT PRODCATTYPEID,PRODUCTNAME FROM fna_product ORDER BY PRODUCTNAME ASC";
			$prodCatQueryStatement				= mysql_query($prodCatQuery);
			while($prodCatQueryStatementData	= mysql_fetch_array($prodCatQueryStatement)) {
				$PRODCATTYPEID					= $prodCatQueryStatementData["PRODCATTYPEID"];
				$PRODUCTNAME					= $prodCatQueryStatementData["PRODUCTNAME"];
				$prodCatTypeVal					.= "<option value='".$PRODCATTYPEID."'>".$PRODUCTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT]%-->',$prodCatTypeVal,$systemParametersBody);
			
			$QuantityVal 						= '';
			$quantityQuery 						= "SELECT QID,QVALUE FROM fna_quantity ORDER BY QVALUE ASC";
			$quantityQueryStatement				= mysql_query($quantityQuery);
			while($quantityQueryStatementData	= mysql_fetch_array($quantityQueryStatement)) {
				$qId							= $quantityQueryStatementData["QID"];
				$qValue							= $quantityQueryStatementData["QVALUE"];
				$QuantityVal 					.= "<option value='".$qId."'>".$qValue."</option>";
			}
			$systemParametersBody = str_replace('<!--%[QUANTITY]%-->',$QuantityVal,$systemParametersBody);
			
			$weightTypeVal 							= '';
			$weightTypeQuery 						= "SELECT WTID,WNAME FROM fna_weight ORDER BY WNAME ASC";
			$weightTypeQueryStatement				= mysql_query($weightTypeQuery);
			while($weightTypeQueryStatementData		= mysql_fetch_array($weightTypeQueryStatement)) {
				$wtId								= $weightTypeQueryStatementData["WTID"];
				$wtName								= $weightTypeQueryStatementData["WNAME"];
				$weightTypeVal 						.= "<option value='".$wtId."'>".$wtName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[WEIGHTTYPE]%-->',$weightTypeVal,$systemParametersBody);
			
			// Packing Unit Start
			$packingNameVal 					= '';
			$PackingQuery 						= "SELECT PACKINGNAMEID,PACKINGNAME FROM fna_packingname ORDER BY PACKINGNAME ASC";
			$PackingQueryStatement				= mysql_query($PackingQuery);
			while($PackingQueryStatementData	= mysql_fetch_array($PackingQueryStatement)) {
				$packingId						= $PackingQueryStatementData["PACKINGNAMEID"];
				$packingName					= $PackingQueryStatementData["PACKINGNAME"];
				$packingNameVal 					.= "<option value='".$packingId."'>".$packingName."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PACKING_NAME_NEW]%-->',$packingNameVal,$systemParametersBody);
			$packingNameVal 	= '';
			$packingViewQuery 	= "
									SELECT
											PACKINGUNITID,
											PACKINGNAMEID,
											QID,
											WTID
									FROM
											fna_packingunit 
									ORDER BY
											PACKINGUNITID
									ASC
								";
			$sv								= 1;
			$packingViewQueryStatement				= mysql_query($packingViewQuery);
			while($packingViewQueryStatementData	= mysql_fetch_array($packingViewQueryStatement)) {
				if($sv%2==0) {
					$class	= "evenRow";
				} else {
					$class	= "oddRow";
				}
				
				$PACKINGUNITID   		= $packingViewQueryStatementData["PACKINGUNITID"];
				$PACKINGNAMEID   		= $packingViewQueryStatementData["PACKINGNAMEID"];
				$QID			   		= $packingViewQueryStatementData["QID"];
				$WTID			   		= $packingViewQueryStatementData["WTID"];
				
				$packingNameQuery = "
									SELECT
											PACKINGNAMEID,
											PACKINGNAME
									FROM
											fna_packingname 
											WHERE PACKINGNAMEID = {$PACKINGNAMEID}
									";
				$packingNameQueryStatement				= mysql_query($packingNameQuery);
				while($packingNameQueryStatementData	= mysql_fetch_array($packingNameQueryStatement)) {
					$PACKINGNAMEID_NEW   		= $packingNameQueryStatementData["PACKINGNAMEID"];
					$PACKINGNAME_NEW   			= $packingNameQueryStatementData["PACKINGNAME"];
					
				}
				
				$QidQuery = "
									SELECT
											QVALUE
									FROM
											fna_quantity 
											WHERE QID = {$QID}
									";
				$QidQueryStatement				= mysql_query($QidQuery);
				while($QidQueryStatementData	= mysql_fetch_array($QidQueryStatement)) {
					$QVALUE   		= $QidQueryStatementData["QVALUE"];
					
				}
				
				$wtidQuery = "
									SELECT
											WNAME
									FROM
											fna_weight 
											WHERE WTID = {$WTID}
									";
				$wtidQueryStatement				= mysql_query($wtidQuery);
				while($wtidQueryStatementData	= mysql_fetch_array($wtidQueryStatement)) {
					$WNAME   		= $wtidQueryStatementData["WNAME"];
					
				}
			
			
			$packingNameVal 					.= "<option value='".$PACKINGUNITID."'>".$PACKINGNAME_NEW.", ".$QVALUE.",".$WNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PACKING_NAME]%-->',$packingNameVal,$systemParametersBody);
			
			//Product View End
			
			//Chamber From Start
			$chamberFromVal							= '';
			$chamberFromQuery 						= "SELECT CHID, CHNAME FROM fna_chamber ORDER BY CHNAME ASC";
			$chamberFromQueryStatement				= mysql_query($chamberFromQuery);
			while($chamberFromQueryStatementData	= mysql_fetch_array($chamberFromQueryStatement)) {
				$chamberId							= $chamberFromQueryStatementData["CHID"];
				$chamberName						= $chamberFromQueryStatementData["CHNAME"];
				$chamberFromVal 					.= "<option value='".$chamberId."'>".$chamberName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[CHAMBER_FROM]%-->',$chamberFromVal,$systemParametersBody);
			//Chamber From End
					
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
		//System Labour Bill Payment Entry  End
		
		//System Party Payment Receive Entry Start
		function getPartyPaymentReceiveEntry($empId) {
			$systemParametersBody = $this->getTemplateContent('fnaPartyPaymentReceive');
			
			// Project View  Start
			
			$projNameVal 				= '';
			$projQuery 				= "SELECT PROJECTID, PROJECTNAME FROM fna_project ORDER BY PROJECTNAME ASC";
			$projQueryStatement				= mysql_query($projQuery);
			while($projQueryStatementData	= mysql_fetch_array($projQueryStatement)) {
				$PROJECTID					= $projQueryStatementData["PROJECTID"];
				$PROJECTNAME				= $projQueryStatementData["PROJECTNAME"];
				$projNameVal 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$projNameVal,$systemParametersBody);
			// Project View  End
			
			//Batch Select start
			
			$BatchVal 							= '';
			$BatchQuery 						= "SELECT BATCHNO FROM pal_batchopen ORDER BY BATCHNO DESC";
			$BatchQueryStatement				= mysql_query($BatchQuery);
			while($BatchQueryStatementData		= mysql_fetch_array($BatchQueryStatement)) {
				$BATCHNO						= $BatchQueryStatementData["BATCHNO"];
				$BatchVal 						.= "<option value='".$BATCHNO."'>".$BATCHNO."</option>";
			}
			$systemParametersBody = str_replace('<!--%[BATCH_NO]%-->',$BatchVal,$systemParametersBody);
			
			//Batch Select End 
			
			// Labour View Start
			$ptView 		= '';
			$ptViewQuery 	= "
									SELECT
											LABOURNAME,
											FATHERNAME,
											ADDRESS,
											MOBILE
									FROM
											fna_labour 
									ORDER BY
											LABOURNAME
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
				
				$LABOURNAME   = $ptViewStatementData["LABOURNAME"];
				$FATHERNAME   = $ptViewStatementData["FATHERNAME"];
				$ADDRESS      = $ptViewStatementData["ADDRESS"];
				$MOBILE       = $ptViewStatementData["MOBILE"];
				
				$ptView .= "<tr valign='top' class='$class'>
									<td >{$sv}</td>
									<td >{$LABOURNAME}</td>
									<td >{$FATHERNAME}</td>
									<td >{$ADDRESS}</td>
									<td >{$MOBILE}</td>
									<td align='center'>
									<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' />
									</td>
								</tr>";
				
				$sv++;
			}
			$systemParametersBody = str_replace('<!--%[LABOUR_VIEW]%-->',$ptView,$systemParametersBody);
			
			//Labour View End
			
			// Product View  Start
			
			$prodNameVal 				= '';
			$prodQuery 				= "SELECT PRODCATTYPEID, CATEGORYTYPENAME FROM fna_productcattype ORDER BY CATEGORYTYPENAME ASC";
			$prodQueryStatement				= mysql_query($prodQuery);
			while($prodQueryStatementData	= mysql_fetch_array($prodQueryStatement)) {
				$productCatTypeId				= $prodQueryStatementData["PRODCATTYPEID"];
				$catName						= $prodQueryStatementData["CATEGORYTYPENAME"];
				$prodNameVal 					.= "<option value='".$productCatTypeId."'>".$catName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT_NAME]%-->',$prodNameVal,$systemParametersBody);
			
			
			//Labour Name View
			$labourNameVal 				= '';
			$labourQuery 				= "SELECT LABOURID, LABOURNAME FROM fna_labour ORDER BY LABOURNAME ASC";
			$labourQueryStatement				= mysql_query($labourQuery);
			while($labourQueryStatementData	= mysql_fetch_array($labourQueryStatement)) {
				$labourId						= $labourQueryStatementData["LABOURID"];
				$labourName						= $labourQueryStatementData["LABOURNAME"];
				$labourNameVal 					.= "<option value='".$labourId."'>".$labourName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[LABOUR_NAME]%-->',$labourNameVal,$systemParametersBody);
			
			$PartyNameVal 				= '';
			$PartyQuery 				= "SELECT PARTYID, PARTYNAME FROM fna_party ORDER BY PARTYNAME ASC";
			$PartyQueryStatement				= mysql_query($PartyQuery);
			while($PartyQueryStatementData	= mysql_fetch_array($PartyQueryStatement)) {
				$PartyId						= $PartyQueryStatementData["PARTYID"];
				$PartyName						= $PartyQueryStatementData["PARTYNAME"];
				$PartyNameVal 					.= "<option value='".$PartyId."'>".$PartyName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$PartyNameVal,$systemParametersBody);
			
			$PoductCatVal 				= '';
			$ProductCatQuery 				= "SELECT PRODCATTYPEID, CATEGORYTYPENAME FROM fna_productcattype ORDER BY CATEGORYTYPENAME ASC";
			$ProductCatQueryStatement				= mysql_query($ProductCatQuery);
			while($ProductCatQueryStatementData	= mysql_fetch_array($ProductCatQueryStatement)) {
				 $ProductCatId						= $ProductCatQueryStatementData["PRODCATTYPEID"];
				 $ProductCatName						= $ProductCatQueryStatementData["CATEGORYTYPENAME"];
				$PoductCatVal 					.= "<option value='".$ProductCatId."'>".$ProductCatName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT_CATEGORY_NAME]%-->',$PoductCatVal,$systemParametersBody);
			
			$prodCatTypeVal						= '';
			$prodCatQuery 						= "SELECT PRODCATTYPEID,PRODUCTNAME FROM fna_product ORDER BY PRODUCTNAME ASC";
			$prodCatQueryStatement				= mysql_query($prodCatQuery);
			while($prodCatQueryStatementData	= mysql_fetch_array($prodCatQueryStatement)) {
				$PRODCATTYPEID					= $prodCatQueryStatementData["PRODCATTYPEID"];
				$PRODUCTNAME					= $prodCatQueryStatementData["PRODUCTNAME"];
				$prodCatTypeVal					.= "<option value='".$PRODCATTYPEID."'>".$PRODUCTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT]%-->',$prodCatTypeVal,$systemParametersBody);
			
			$QuantityVal 						= '';
			$quantityQuery 						= "SELECT QID,QVALUE FROM fna_quantity ORDER BY QVALUE ASC";
			$quantityQueryStatement				= mysql_query($quantityQuery);
			while($quantityQueryStatementData	= mysql_fetch_array($quantityQueryStatement)) {
				$qId							= $quantityQueryStatementData["QID"];
				$qValue							= $quantityQueryStatementData["QVALUE"];
				$QuantityVal 					.= "<option value='".$qId."'>".$qValue."</option>";
			}
			$systemParametersBody = str_replace('<!--%[QUANTITY]%-->',$QuantityVal,$systemParametersBody);
			
			$weightTypeVal 							= '';
			$weightTypeQuery 						= "SELECT WTID,WNAME FROM fna_weight ORDER BY WNAME ASC";
			$weightTypeQueryStatement				= mysql_query($weightTypeQuery);
			while($weightTypeQueryStatementData		= mysql_fetch_array($weightTypeQueryStatement)) {
				$wtId								= $weightTypeQueryStatementData["WTID"];
				$wtName								= $weightTypeQueryStatementData["WNAME"];
				$weightTypeVal 						.= "<option value='".$wtId."'>".$wtName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[WEIGHTTYPE]%-->',$weightTypeVal,$systemParametersBody);
			
			// Packing Unit Start
			$packingNameVal 					= '';
			$PackingQuery 						= "SELECT PACKINGNAMEID,PACKINGNAME FROM fna_packingname ORDER BY PACKINGNAME ASC";
			$PackingQueryStatement				= mysql_query($PackingQuery);
			while($PackingQueryStatementData	= mysql_fetch_array($PackingQueryStatement)) {
				$packingId						= $PackingQueryStatementData["PACKINGNAMEID"];
				$packingName					= $PackingQueryStatementData["PACKINGNAME"];
				$packingNameVal 					.= "<option value='".$packingId."'>".$packingName."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PACKING_NAME_NEW]%-->',$packingNameVal,$systemParametersBody);
			$packingNameVal 	= '';
			$packingViewQuery 	= "
									SELECT
											PACKINGUNITID,
											PACKINGNAMEID,
											QID,
											WTID
									FROM
											fna_packingunit 
									ORDER BY
											PACKINGUNITID
									ASC
								";
			$sv								= 1;
			$packingViewQueryStatement				= mysql_query($packingViewQuery);
			while($packingViewQueryStatementData	= mysql_fetch_array($packingViewQueryStatement)) {
				if($sv%2==0) {
					$class	= "evenRow";
				} else {
					$class	= "oddRow";
				}
				
				$PACKINGUNITID   		= $packingViewQueryStatementData["PACKINGUNITID"];
				$PACKINGNAMEID   		= $packingViewQueryStatementData["PACKINGNAMEID"];
				$QID			   		= $packingViewQueryStatementData["QID"];
				$WTID			   		= $packingViewQueryStatementData["WTID"];
				
				$packingNameQuery = "
									SELECT
											PACKINGNAMEID,
											PACKINGNAME
									FROM
											fna_packingname 
											WHERE PACKINGNAMEID = {$PACKINGNAMEID}
									";
				$packingNameQueryStatement				= mysql_query($packingNameQuery);
				while($packingNameQueryStatementData	= mysql_fetch_array($packingNameQueryStatement)) {
					$PACKINGNAMEID_NEW   		= $packingNameQueryStatementData["PACKINGNAMEID"];
					$PACKINGNAME_NEW   			= $packingNameQueryStatementData["PACKINGNAME"];
					
				}
				
				$QidQuery = "
									SELECT
											QVALUE
									FROM
											fna_quantity 
											WHERE QID = {$QID}
									";
				$QidQueryStatement				= mysql_query($QidQuery);
				while($QidQueryStatementData	= mysql_fetch_array($QidQueryStatement)) {
					$QVALUE   		= $QidQueryStatementData["QVALUE"];
					
				}
				
				$wtidQuery = "
									SELECT
											WNAME
									FROM
											fna_weight 
											WHERE WTID = {$WTID}
									";
				$wtidQueryStatement				= mysql_query($wtidQuery);
				while($wtidQueryStatementData	= mysql_fetch_array($wtidQueryStatement)) {
					$WNAME   		= $wtidQueryStatementData["WNAME"];
					
				}
			
			
			$packingNameVal 					.= "<option value='".$PACKINGUNITID."'>".$PACKINGNAME_NEW.", ".$QVALUE.",".$WNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PACKING_NAME]%-->',$packingNameVal,$systemParametersBody);
			
			//Product View End
			
			
			//Chamber From Start
			$chamberFromVal							= '';
			$chamberFromQuery 						= "SELECT CHID, CHNAME FROM fna_chamber ORDER BY CHNAME ASC";
			$chamberFromQueryStatement				= mysql_query($chamberFromQuery);
			while($chamberFromQueryStatementData	= mysql_fetch_array($chamberFromQueryStatement)) {
				$chamberId							= $chamberFromQueryStatementData["CHID"];
				$chamberName						= $chamberFromQueryStatementData["CHNAME"];
				$chamberFromVal 					.= "<option value='".$chamberId."'>".$chamberName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[CHAMBER_FROM]%-->',$chamberFromVal,$systemParametersBody);
			//Chamber From End
					
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
			
			// Income Head View  Start
			
			$IncHeadNameVal 					= '';
			$IncHeadQuery 						= "SELECT INHID, INCHEADNAME FROM fna_income_head ORDER BY INCHEADNAME ASC";
			$IncHeadQueryStatement				= mysql_query($IncHeadQuery);
			while($IncHeadQueryStatementData	= mysql_fetch_array($IncHeadQueryStatement)) {
				$INHID							= $IncHeadQueryStatementData["INHID"];
				$INCHEADNAME					= $IncHeadQueryStatementData["INCHEADNAME"];
				$IncHeadNameVal 					.= "<option value='".$INHID."'>".$INCHEADNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[INCOME_HEAD_NAME]%-->',$IncHeadNameVal,$systemParametersBody);
			// Income Head View  End
			
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
		//System Party Payment Receive Entry  End
		
		//System Party Payment Receive Entry Start
		function getPartyPaymentReceiveEntryOpening($empId) {
			$systemParametersBody = $this->getTemplateContent('fnaPartyPaymentReceiveOpening');
			
			// Project View  Start
			
			$projNameVal 				= '';
			$projQuery 				= "SELECT PROJECTID, PROJECTNAME FROM fna_project ORDER BY PROJECTNAME ASC";
			$projQueryStatement				= mysql_query($projQuery);
			while($projQueryStatementData	= mysql_fetch_array($projQueryStatement)) {
				$PROJECTID					= $projQueryStatementData["PROJECTID"];
				$PROJECTNAME				= $projQueryStatementData["PROJECTNAME"];
				$projNameVal 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$projNameVal,$systemParametersBody);
			// Project View  End
			
			//Batch Select start
			
			$BatchVal 							= '';
			$BatchQuery 						= "SELECT BATCHNO FROM pal_batchopen ORDER BY BATCHNO DESC";
			$BatchQueryStatement				= mysql_query($BatchQuery);
			while($BatchQueryStatementData		= mysql_fetch_array($BatchQueryStatement)) {
				$BATCHNO						= $BatchQueryStatementData["BATCHNO"];
				$BatchVal 						.= "<option value='".$BATCHNO."'>".$BATCHNO."</option>";
			}
			$systemParametersBody = str_replace('<!--%[BATCH_NO]%-->',$BatchVal,$systemParametersBody);
			
			//Batch Select End 
			
			// Labour View Start
			$ptView 		= '';
			$ptViewQuery 	= "
									SELECT
											LABOURNAME,
											FATHERNAME,
											ADDRESS,
											MOBILE
									FROM
											fna_labour 
									ORDER BY
											LABOURNAME
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
				
				$LABOURNAME   = $ptViewStatementData["LABOURNAME"];
				$FATHERNAME   = $ptViewStatementData["FATHERNAME"];
				$ADDRESS      = $ptViewStatementData["ADDRESS"];
				$MOBILE       = $ptViewStatementData["MOBILE"];
				
				$ptView .= "<tr valign='top' class='$class'>
									<td >{$sv}</td>
									<td >{$LABOURNAME}</td>
									<td >{$FATHERNAME}</td>
									<td >{$ADDRESS}</td>
									<td >{$MOBILE}</td>
									<td align='center'>
									<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' />
									</td>
								</tr>";
				
				$sv++;
			}
			$systemParametersBody = str_replace('<!--%[LABOUR_VIEW]%-->',$ptView,$systemParametersBody);
			
			//Labour View End
			
			// Product View  Start
			
			$prodNameVal 				= '';
			$prodQuery 				= "SELECT PRODCATTYPEID, CATEGORYTYPENAME FROM fna_productcattype ORDER BY CATEGORYTYPENAME ASC";
			$prodQueryStatement				= mysql_query($prodQuery);
			while($prodQueryStatementData	= mysql_fetch_array($prodQueryStatement)) {
				$productCatTypeId				= $prodQueryStatementData["PRODCATTYPEID"];
				$catName						= $prodQueryStatementData["CATEGORYTYPENAME"];
				$prodNameVal 					.= "<option value='".$productCatTypeId."'>".$catName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT_NAME]%-->',$prodNameVal,$systemParametersBody);
			
			
			//Labour Name View
			$labourNameVal 				= '';
			$labourQuery 				= "SELECT LABOURID, LABOURNAME FROM fna_labour ORDER BY LABOURNAME ASC";
			$labourQueryStatement				= mysql_query($labourQuery);
			while($labourQueryStatementData	= mysql_fetch_array($labourQueryStatement)) {
				$labourId						= $labourQueryStatementData["LABOURID"];
				$labourName						= $labourQueryStatementData["LABOURNAME"];
				$labourNameVal 					.= "<option value='".$labourId."'>".$labourName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[LABOUR_NAME]%-->',$labourNameVal,$systemParametersBody);
			
			$PartyNameVal 				= '';
			$PartyQuery 				= "SELECT PARTYID, PARTYNAME FROM fna_party ORDER BY PARTYNAME ASC";
			$PartyQueryStatement				= mysql_query($PartyQuery);
			while($PartyQueryStatementData	= mysql_fetch_array($PartyQueryStatement)) {
				$PartyId						= $PartyQueryStatementData["PARTYID"];
				$PartyName						= $PartyQueryStatementData["PARTYNAME"];
				$PartyNameVal 					.= "<option value='".$PartyId."'>".$PartyName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$PartyNameVal,$systemParametersBody);
			
			$PoductCatVal 				= '';
			$ProductCatQuery 				= "SELECT PRODCATTYPEID, CATEGORYTYPENAME FROM fna_productcattype ORDER BY CATEGORYTYPENAME ASC";
			$ProductCatQueryStatement				= mysql_query($ProductCatQuery);
			while($ProductCatQueryStatementData	= mysql_fetch_array($ProductCatQueryStatement)) {
				 $ProductCatId						= $ProductCatQueryStatementData["PRODCATTYPEID"];
				 $ProductCatName						= $ProductCatQueryStatementData["CATEGORYTYPENAME"];
				$PoductCatVal 					.= "<option value='".$ProductCatId."'>".$ProductCatName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT_CATEGORY_NAME]%-->',$PoductCatVal,$systemParametersBody);
			
			$prodCatTypeVal						= '';
			$prodCatQuery 						= "SELECT PRODCATTYPEID,PRODUCTNAME FROM fna_product ORDER BY PRODUCTNAME ASC";
			$prodCatQueryStatement				= mysql_query($prodCatQuery);
			while($prodCatQueryStatementData	= mysql_fetch_array($prodCatQueryStatement)) {
				$PRODCATTYPEID					= $prodCatQueryStatementData["PRODCATTYPEID"];
				$PRODUCTNAME					= $prodCatQueryStatementData["PRODUCTNAME"];
				$prodCatTypeVal					.= "<option value='".$PRODCATTYPEID."'>".$PRODUCTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT]%-->',$prodCatTypeVal,$systemParametersBody);
			
			$QuantityVal 						= '';
			$quantityQuery 						= "SELECT QID,QVALUE FROM fna_quantity ORDER BY QVALUE ASC";
			$quantityQueryStatement				= mysql_query($quantityQuery);
			while($quantityQueryStatementData	= mysql_fetch_array($quantityQueryStatement)) {
				$qId							= $quantityQueryStatementData["QID"];
				$qValue							= $quantityQueryStatementData["QVALUE"];
				$QuantityVal 					.= "<option value='".$qId."'>".$qValue."</option>";
			}
			$systemParametersBody = str_replace('<!--%[QUANTITY]%-->',$QuantityVal,$systemParametersBody);
			
			$weightTypeVal 							= '';
			$weightTypeQuery 						= "SELECT WTID,WNAME FROM fna_weight ORDER BY WNAME ASC";
			$weightTypeQueryStatement				= mysql_query($weightTypeQuery);
			while($weightTypeQueryStatementData		= mysql_fetch_array($weightTypeQueryStatement)) {
				$wtId								= $weightTypeQueryStatementData["WTID"];
				$wtName								= $weightTypeQueryStatementData["WNAME"];
				$weightTypeVal 						.= "<option value='".$wtId."'>".$wtName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[WEIGHTTYPE]%-->',$weightTypeVal,$systemParametersBody);
			
			// Packing Unit Start
			$packingNameVal 					= '';
			$PackingQuery 						= "SELECT PACKINGNAMEID,PACKINGNAME FROM fna_packingname ORDER BY PACKINGNAME ASC";
			$PackingQueryStatement				= mysql_query($PackingQuery);
			while($PackingQueryStatementData	= mysql_fetch_array($PackingQueryStatement)) {
				$packingId						= $PackingQueryStatementData["PACKINGNAMEID"];
				$packingName					= $PackingQueryStatementData["PACKINGNAME"];
				$packingNameVal 					.= "<option value='".$packingId."'>".$packingName."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PACKING_NAME_NEW]%-->',$packingNameVal,$systemParametersBody);
			$packingNameVal 	= '';
			$packingViewQuery 	= "
									SELECT
											PACKINGUNITID,
											PACKINGNAMEID,
											QID,
											WTID
									FROM
											fna_packingunit 
									ORDER BY
											PACKINGUNITID
									ASC
								";
			$sv								= 1;
			$packingViewQueryStatement				= mysql_query($packingViewQuery);
			while($packingViewQueryStatementData	= mysql_fetch_array($packingViewQueryStatement)) {
				if($sv%2==0) {
					$class	= "evenRow";
				} else {
					$class	= "oddRow";
				}
				
				$PACKINGUNITID   		= $packingViewQueryStatementData["PACKINGUNITID"];
				$PACKINGNAMEID   		= $packingViewQueryStatementData["PACKINGNAMEID"];
				$QID			   		= $packingViewQueryStatementData["QID"];
				$WTID			   		= $packingViewQueryStatementData["WTID"];
				
				$packingNameQuery = "
									SELECT
											PACKINGNAMEID,
											PACKINGNAME
									FROM
											fna_packingname 
											WHERE PACKINGNAMEID = {$PACKINGNAMEID}
									";
				$packingNameQueryStatement				= mysql_query($packingNameQuery);
				while($packingNameQueryStatementData	= mysql_fetch_array($packingNameQueryStatement)) {
					$PACKINGNAMEID_NEW   		= $packingNameQueryStatementData["PACKINGNAMEID"];
					$PACKINGNAME_NEW   			= $packingNameQueryStatementData["PACKINGNAME"];
					
				}
				
				$QidQuery = "
									SELECT
											QVALUE
									FROM
											fna_quantity 
											WHERE QID = {$QID}
									";
				$QidQueryStatement				= mysql_query($QidQuery);
				while($QidQueryStatementData	= mysql_fetch_array($QidQueryStatement)) {
					$QVALUE   		= $QidQueryStatementData["QVALUE"];
					
				}
				
				$wtidQuery = "
									SELECT
											WNAME
									FROM
											fna_weight 
											WHERE WTID = {$WTID}
									";
				$wtidQueryStatement				= mysql_query($wtidQuery);
				while($wtidQueryStatementData	= mysql_fetch_array($wtidQueryStatement)) {
					$WNAME   		= $wtidQueryStatementData["WNAME"];
					
				}
			
			
			$packingNameVal 					.= "<option value='".$PACKINGUNITID."'>".$PACKINGNAME_NEW.", ".$QVALUE.",".$WNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PACKING_NAME]%-->',$packingNameVal,$systemParametersBody);
			
			//Product View End
			
			
			//Chamber From Start
			$chamberFromVal							= '';
			$chamberFromQuery 						= "SELECT CHID, CHNAME FROM fna_chamber ORDER BY CHNAME ASC";
			$chamberFromQueryStatement				= mysql_query($chamberFromQuery);
			while($chamberFromQueryStatementData	= mysql_fetch_array($chamberFromQueryStatement)) {
				$chamberId							= $chamberFromQueryStatementData["CHID"];
				$chamberName						= $chamberFromQueryStatementData["CHNAME"];
				$chamberFromVal 					.= "<option value='".$chamberId."'>".$chamberName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[CHAMBER_FROM]%-->',$chamberFromVal,$systemParametersBody);
			//Chamber From End
					
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
			
			// Income Head View  Start
			
			$IncHeadNameVal 					= '';
			$IncHeadQuery 						= "SELECT INHID, INCHEADNAME FROM fna_income_head ORDER BY INCHEADNAME ASC";
			$IncHeadQueryStatement				= mysql_query($IncHeadQuery);
			while($IncHeadQueryStatementData	= mysql_fetch_array($IncHeadQueryStatement)) {
				$INHID							= $IncHeadQueryStatementData["INHID"];
				$INCHEADNAME					= $IncHeadQueryStatementData["INCHEADNAME"];
				$IncHeadNameVal 					.= "<option value='".$INHID."'>".$INCHEADNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[INCOME_HEAD_NAME]%-->',$IncHeadNameVal,$systemParametersBody);
			// Income Head View  End
			
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
		//System Party Payment Receive Entry  End
		
		//System Party Payment Entry Start
		function getPartyPaymentEntry($empId) {
			$systemParametersBody = $this->getTemplateContent('fnaPartyPayment');
			
			// Project View  Start
			
			$projNameVal 				= '';
			$projQuery 				= "SELECT PROJECTID, PROJECTNAME FROM fna_project ORDER BY PROJECTNAME ASC";
			$projQueryStatement				= mysql_query($projQuery);
			while($projQueryStatementData	= mysql_fetch_array($projQueryStatement)) {
				$PROJECTID					= $projQueryStatementData["PROJECTID"];
				$PROJECTNAME				= $projQueryStatementData["PROJECTNAME"];
				$projNameVal 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$projNameVal,$systemParametersBody);
			// Project View  End
			
			//Batch Select start
			
			$BatchVal 							= '';
			$BatchQuery 						= "SELECT BATCHNO FROM pal_batchopen ORDER BY BATCHNO DESC";
			$BatchQueryStatement				= mysql_query($BatchQuery);
			while($BatchQueryStatementData		= mysql_fetch_array($BatchQueryStatement)) {
				$BATCHNO						= $BatchQueryStatementData["BATCHNO"];
				$BatchVal 						.= "<option value='".$BATCHNO."'>".$BATCHNO."</option>";
			}
			$systemParametersBody = str_replace('<!--%[BATCH_NO]%-->',$BatchVal,$systemParametersBody);
			
			//Batch Select End 
			
			// Expanse Head View  Start
			
			$ExpHeadNameVal 					= '';
			$ExpHeadQuery 						= "SELECT EXPHID, EXPHEADNAME FROM fna_expense_head ORDER BY EXPHEADNAME ASC";
			$ExpHeadQueryStatement				= mysql_query($ExpHeadQuery);
			while($ExpHeadQueryStatementData	= mysql_fetch_array($ExpHeadQueryStatement)) {
				$EXPHID							= $ExpHeadQueryStatementData["EXPHID"];
				$EXPHEADNAME					= $ExpHeadQueryStatementData["EXPHEADNAME"];
				$ExpHeadNameVal 					.= "<option value='".$EXPHID."'>".$EXPHEADNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[EXPANSE_HEAD_NAME]%-->',$ExpHeadNameVal,$systemParametersBody);
			// Expanse Head View  End
			
			// Labour View Start
			$ptView 		= '';
			$ptViewQuery 	= "
									SELECT
											LABOURNAME,
											FATHERNAME,
											ADDRESS,
											MOBILE
									FROM
											fna_labour 
									ORDER BY
											LABOURNAME
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
				
				$LABOURNAME   = $ptViewStatementData["LABOURNAME"];
				$FATHERNAME   = $ptViewStatementData["FATHERNAME"];
				$ADDRESS      = $ptViewStatementData["ADDRESS"];
				$MOBILE       = $ptViewStatementData["MOBILE"];
				
				$ptView .= "<tr valign='top' class='$class'>
									<td >{$sv}</td>
									<td >{$LABOURNAME}</td>
									<td >{$FATHERNAME}</td>
									<td >{$ADDRESS}</td>
									<td >{$MOBILE}</td>
									<td align='center'>
									<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' />
									</td>
								</tr>";
				
				$sv++;
			}
			$systemParametersBody = str_replace('<!--%[LABOUR_VIEW]%-->',$ptView,$systemParametersBody);
			
			//Labour View End
			
			// Product View  Start
			
			$prodNameVal 				= '';
			$prodQuery 				= "SELECT PRODCATTYPEID, CATEGORYTYPENAME FROM fna_productcattype ORDER BY CATEGORYTYPENAME ASC";
			$prodQueryStatement				= mysql_query($prodQuery);
			while($prodQueryStatementData	= mysql_fetch_array($prodQueryStatement)) {
				$productCatTypeId				= $prodQueryStatementData["PRODCATTYPEID"];
				$catName						= $prodQueryStatementData["CATEGORYTYPENAME"];
				$prodNameVal 					.= "<option value='".$productCatTypeId."'>".$catName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT_NAME]%-->',$prodNameVal,$systemParametersBody);
			
			
			//Labour Name View
			$labourNameVal 				= '';
			$labourQuery 				= "SELECT LABOURID, LABOURNAME FROM fna_labour ORDER BY LABOURNAME ASC";
			$labourQueryStatement				= mysql_query($labourQuery);
			while($labourQueryStatementData	= mysql_fetch_array($labourQueryStatement)) {
				$labourId						= $labourQueryStatementData["LABOURID"];
				$labourName						= $labourQueryStatementData["LABOURNAME"];
				$labourNameVal 					.= "<option value='".$labourId."'>".$labourName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[LABOUR_NAME]%-->',$labourNameVal,$systemParametersBody);
			
			$PartyNameVal 				= '';
			$PartyQuery 				= "SELECT PARTYID, PARTYNAME FROM fna_party ORDER BY PARTYNAME ASC";
			$PartyQueryStatement				= mysql_query($PartyQuery);
			while($PartyQueryStatementData	= mysql_fetch_array($PartyQueryStatement)) {
				$PartyId						= $PartyQueryStatementData["PARTYID"];
				$PartyName						= $PartyQueryStatementData["PARTYNAME"];
				$PartyNameVal 					.= "<option value='".$PartyId."'>".$PartyName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$PartyNameVal,$systemParametersBody);
			
			$PoductCatVal 				= '';
			$ProductCatQuery 				= "SELECT PRODCATTYPEID, CATEGORYTYPENAME FROM fna_productcattype ORDER BY CATEGORYTYPENAME ASC";
			$ProductCatQueryStatement				= mysql_query($ProductCatQuery);
			while($ProductCatQueryStatementData	= mysql_fetch_array($ProductCatQueryStatement)) {
				 $ProductCatId						= $ProductCatQueryStatementData["PRODCATTYPEID"];
				 $ProductCatName						= $ProductCatQueryStatementData["CATEGORYTYPENAME"];
				$PoductCatVal 					.= "<option value='".$ProductCatId."'>".$ProductCatName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT_CATEGORY_NAME]%-->',$PoductCatVal,$systemParametersBody);
			
			$prodCatTypeVal						= '';
			$prodCatQuery 						= "SELECT PRODCATTYPEID,PRODUCTNAME FROM fna_product ORDER BY PRODUCTNAME ASC";
			$prodCatQueryStatement				= mysql_query($prodCatQuery);
			while($prodCatQueryStatementData	= mysql_fetch_array($prodCatQueryStatement)) {
				$PRODCATTYPEID					= $prodCatQueryStatementData["PRODCATTYPEID"];
				$PRODUCTNAME					= $prodCatQueryStatementData["PRODUCTNAME"];
				$prodCatTypeVal					.= "<option value='".$PRODCATTYPEID."'>".$PRODUCTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT]%-->',$prodCatTypeVal,$systemParametersBody);
			
			$QuantityVal 						= '';
			$quantityQuery 						= "SELECT QID,QVALUE FROM fna_quantity ORDER BY QVALUE ASC";
			$quantityQueryStatement				= mysql_query($quantityQuery);
			while($quantityQueryStatementData	= mysql_fetch_array($quantityQueryStatement)) {
				$qId							= $quantityQueryStatementData["QID"];
				$qValue							= $quantityQueryStatementData["QVALUE"];
				$QuantityVal 					.= "<option value='".$qId."'>".$qValue."</option>";
			}
			$systemParametersBody = str_replace('<!--%[QUANTITY]%-->',$QuantityVal,$systemParametersBody);
			
			$weightTypeVal 							= '';
			$weightTypeQuery 						= "SELECT WTID,WNAME FROM fna_weight ORDER BY WNAME ASC";
			$weightTypeQueryStatement				= mysql_query($weightTypeQuery);
			while($weightTypeQueryStatementData		= mysql_fetch_array($weightTypeQueryStatement)) {
				$wtId								= $weightTypeQueryStatementData["WTID"];
				$wtName								= $weightTypeQueryStatementData["WNAME"];
				$weightTypeVal 						.= "<option value='".$wtId."'>".$wtName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[WEIGHTTYPE]%-->',$weightTypeVal,$systemParametersBody);
			
			// Packing Unit Start
			$packingNameVal 					= '';
			$PackingQuery 						= "SELECT PACKINGNAMEID,PACKINGNAME FROM fna_packingname ORDER BY PACKINGNAME ASC";
			$PackingQueryStatement				= mysql_query($PackingQuery);
			while($PackingQueryStatementData	= mysql_fetch_array($PackingQueryStatement)) {
				$packingId						= $PackingQueryStatementData["PACKINGNAMEID"];
				$packingName					= $PackingQueryStatementData["PACKINGNAME"];
				$packingNameVal 					.= "<option value='".$packingId."'>".$packingName."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PACKING_NAME_NEW]%-->',$packingNameVal,$systemParametersBody);
			$packingNameVal 	= '';
			$packingViewQuery 	= "
									SELECT
											PACKINGUNITID,
											PACKINGNAMEID,
											QID,
											WTID
									FROM
											fna_packingunit 
									ORDER BY
											PACKINGUNITID
									ASC
								";
			$sv								= 1;
			$packingViewQueryStatement				= mysql_query($packingViewQuery);
			while($packingViewQueryStatementData	= mysql_fetch_array($packingViewQueryStatement)) {
				if($sv%2==0) {
					$class	= "evenRow";
				} else {
					$class	= "oddRow";
				}
				
				$PACKINGUNITID   		= $packingViewQueryStatementData["PACKINGUNITID"];
				$PACKINGNAMEID   		= $packingViewQueryStatementData["PACKINGNAMEID"];
				$QID			   		= $packingViewQueryStatementData["QID"];
				$WTID			   		= $packingViewQueryStatementData["WTID"];
				
				$packingNameQuery = "
									SELECT
											PACKINGNAMEID,
											PACKINGNAME
									FROM
											fna_packingname 
											WHERE PACKINGNAMEID = {$PACKINGNAMEID}
									";
				$packingNameQueryStatement				= mysql_query($packingNameQuery);
				while($packingNameQueryStatementData	= mysql_fetch_array($packingNameQueryStatement)) {
					$PACKINGNAMEID_NEW   		= $packingNameQueryStatementData["PACKINGNAMEID"];
					$PACKINGNAME_NEW   			= $packingNameQueryStatementData["PACKINGNAME"];
					
				}
				
				$QidQuery = "
									SELECT
											QVALUE
									FROM
											fna_quantity 
											WHERE QID = {$QID}
									";
				$QidQueryStatement				= mysql_query($QidQuery);
				while($QidQueryStatementData	= mysql_fetch_array($QidQueryStatement)) {
					$QVALUE   		= $QidQueryStatementData["QVALUE"];
					
				}
				
				$wtidQuery = "
									SELECT
											WNAME
									FROM
											fna_weight 
											WHERE WTID = {$WTID}
									";
				$wtidQueryStatement				= mysql_query($wtidQuery);
				while($wtidQueryStatementData	= mysql_fetch_array($wtidQueryStatement)) {
					$WNAME   		= $wtidQueryStatementData["WNAME"];
					
				}
			
			
			$packingNameVal 					.= "<option value='".$PACKINGUNITID."'>".$PACKINGNAME_NEW.", ".$QVALUE.",".$WNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PACKING_NAME]%-->',$packingNameVal,$systemParametersBody);
			
			//Product View End
			
			
			//Chamber From Start
			$chamberFromVal							= '';
			$chamberFromQuery 						= "SELECT CHID, CHNAME FROM fna_chamber ORDER BY CHNAME ASC";
			$chamberFromQueryStatement				= mysql_query($chamberFromQuery);
			while($chamberFromQueryStatementData	= mysql_fetch_array($chamberFromQueryStatement)) {
				$chamberId							= $chamberFromQueryStatementData["CHID"];
				$chamberName						= $chamberFromQueryStatementData["CHNAME"];
				$chamberFromVal 					.= "<option value='".$chamberId."'>".$chamberName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[CHAMBER_FROM]%-->',$chamberFromVal,$systemParametersBody);
			//Chamber From End
					
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
		//System Party Payment Entry  End
		
		//System Party Payment Entry Start
		function getPartyPaymentOpeningEntry($empId) {
			$systemParametersBody = $this->getTemplateContent('fnaPartyPaymentOpening');
			
			// Project View  Start
			
			$projNameVal 				= '';
			$projQuery 				= "SELECT PROJECTID, PROJECTNAME FROM fna_project ORDER BY PROJECTNAME ASC";
			$projQueryStatement				= mysql_query($projQuery);
			while($projQueryStatementData	= mysql_fetch_array($projQueryStatement)) {
				$PROJECTID					= $projQueryStatementData["PROJECTID"];
				$PROJECTNAME				= $projQueryStatementData["PROJECTNAME"];
				$projNameVal 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$projNameVal,$systemParametersBody);
			// Project View  End
			
			//Batch Select start
			
			$BatchVal 							= '';
			$BatchQuery 						= "SELECT BATCHNO FROM pal_batchopen ORDER BY BATCHNO DESC";
			$BatchQueryStatement				= mysql_query($BatchQuery);
			while($BatchQueryStatementData		= mysql_fetch_array($BatchQueryStatement)) {
				$BATCHNO						= $BatchQueryStatementData["BATCHNO"];
				$BatchVal 						.= "<option value='".$BATCHNO."'>".$BATCHNO."</option>";
			}
			$systemParametersBody = str_replace('<!--%[BATCH_NO]%-->',$BatchVal,$systemParametersBody);
			
			//Batch Select End 
			
			// Expanse Head View  Start
			
			$ExpHeadNameVal 					= '';
			$ExpHeadQuery 						= "SELECT EXPHID, EXPHEADNAME FROM fna_expense_head ORDER BY EXPHEADNAME ASC";
			$ExpHeadQueryStatement				= mysql_query($ExpHeadQuery);
			while($ExpHeadQueryStatementData	= mysql_fetch_array($ExpHeadQueryStatement)) {
				$EXPHID							= $ExpHeadQueryStatementData["EXPHID"];
				$EXPHEADNAME					= $ExpHeadQueryStatementData["EXPHEADNAME"];
				$ExpHeadNameVal 					.= "<option value='".$EXPHID."'>".$EXPHEADNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[EXPANSE_HEAD_NAME]%-->',$ExpHeadNameVal,$systemParametersBody);
			// Expanse Head View  End
			
			// Labour View Start
			$ptView 		= '';
			$ptViewQuery 	= "
									SELECT
											LABOURNAME,
											FATHERNAME,
											ADDRESS,
											MOBILE
									FROM
											fna_labour 
									ORDER BY
											LABOURNAME
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
				
				$LABOURNAME   = $ptViewStatementData["LABOURNAME"];
				$FATHERNAME   = $ptViewStatementData["FATHERNAME"];
				$ADDRESS      = $ptViewStatementData["ADDRESS"];
				$MOBILE       = $ptViewStatementData["MOBILE"];
				
				$ptView .= "<tr valign='top' class='$class'>
									<td >{$sv}</td>
									<td >{$LABOURNAME}</td>
									<td >{$FATHERNAME}</td>
									<td >{$ADDRESS}</td>
									<td >{$MOBILE}</td>
									<td align='center'>
									<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' />
									</td>
								</tr>";
				
				$sv++;
			}
			$systemParametersBody = str_replace('<!--%[LABOUR_VIEW]%-->',$ptView,$systemParametersBody);
			
			//Labour View End
			
			// Product View  Start
			
			$prodNameVal 				= '';
			$prodQuery 				= "SELECT PRODCATTYPEID, CATEGORYTYPENAME FROM fna_productcattype ORDER BY CATEGORYTYPENAME ASC";
			$prodQueryStatement				= mysql_query($prodQuery);
			while($prodQueryStatementData	= mysql_fetch_array($prodQueryStatement)) {
				$productCatTypeId				= $prodQueryStatementData["PRODCATTYPEID"];
				$catName						= $prodQueryStatementData["CATEGORYTYPENAME"];
				$prodNameVal 					.= "<option value='".$productCatTypeId."'>".$catName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT_NAME]%-->',$prodNameVal,$systemParametersBody);
			
			
			//Labour Name View
			$labourNameVal 				= '';
			$labourQuery 				= "SELECT LABOURID, LABOURNAME FROM fna_labour ORDER BY LABOURNAME ASC";
			$labourQueryStatement				= mysql_query($labourQuery);
			while($labourQueryStatementData	= mysql_fetch_array($labourQueryStatement)) {
				$labourId						= $labourQueryStatementData["LABOURID"];
				$labourName						= $labourQueryStatementData["LABOURNAME"];
				$labourNameVal 					.= "<option value='".$labourId."'>".$labourName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[LABOUR_NAME]%-->',$labourNameVal,$systemParametersBody);
			
			$PartyNameVal 				= '';
			$PartyQuery 				= "SELECT PARTYID, PARTYNAME FROM fna_party ORDER BY PARTYNAME ASC";
			$PartyQueryStatement				= mysql_query($PartyQuery);
			while($PartyQueryStatementData	= mysql_fetch_array($PartyQueryStatement)) {
				$PartyId						= $PartyQueryStatementData["PARTYID"];
				$PartyName						= $PartyQueryStatementData["PARTYNAME"];
				$PartyNameVal 					.= "<option value='".$PartyId."'>".$PartyName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$PartyNameVal,$systemParametersBody);
			
			$PoductCatVal 				= '';
			$ProductCatQuery 				= "SELECT PRODCATTYPEID, CATEGORYTYPENAME FROM fna_productcattype ORDER BY CATEGORYTYPENAME ASC";
			$ProductCatQueryStatement				= mysql_query($ProductCatQuery);
			while($ProductCatQueryStatementData	= mysql_fetch_array($ProductCatQueryStatement)) {
				 $ProductCatId						= $ProductCatQueryStatementData["PRODCATTYPEID"];
				 $ProductCatName						= $ProductCatQueryStatementData["CATEGORYTYPENAME"];
				$PoductCatVal 					.= "<option value='".$ProductCatId."'>".$ProductCatName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT_CATEGORY_NAME]%-->',$PoductCatVal,$systemParametersBody);
			
			$prodCatTypeVal						= '';
			$prodCatQuery 						= "SELECT PRODCATTYPEID,PRODUCTNAME FROM fna_product ORDER BY PRODUCTNAME ASC";
			$prodCatQueryStatement				= mysql_query($prodCatQuery);
			while($prodCatQueryStatementData	= mysql_fetch_array($prodCatQueryStatement)) {
				$PRODCATTYPEID					= $prodCatQueryStatementData["PRODCATTYPEID"];
				$PRODUCTNAME					= $prodCatQueryStatementData["PRODUCTNAME"];
				$prodCatTypeVal					.= "<option value='".$PRODCATTYPEID."'>".$PRODUCTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT]%-->',$prodCatTypeVal,$systemParametersBody);
			
			$QuantityVal 						= '';
			$quantityQuery 						= "SELECT QID,QVALUE FROM fna_quantity ORDER BY QVALUE ASC";
			$quantityQueryStatement				= mysql_query($quantityQuery);
			while($quantityQueryStatementData	= mysql_fetch_array($quantityQueryStatement)) {
				$qId							= $quantityQueryStatementData["QID"];
				$qValue							= $quantityQueryStatementData["QVALUE"];
				$QuantityVal 					.= "<option value='".$qId."'>".$qValue."</option>";
			}
			$systemParametersBody = str_replace('<!--%[QUANTITY]%-->',$QuantityVal,$systemParametersBody);
			
			$weightTypeVal 							= '';
			$weightTypeQuery 						= "SELECT WTID,WNAME FROM fna_weight ORDER BY WNAME ASC";
			$weightTypeQueryStatement				= mysql_query($weightTypeQuery);
			while($weightTypeQueryStatementData		= mysql_fetch_array($weightTypeQueryStatement)) {
				$wtId								= $weightTypeQueryStatementData["WTID"];
				$wtName								= $weightTypeQueryStatementData["WNAME"];
				$weightTypeVal 						.= "<option value='".$wtId."'>".$wtName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[WEIGHTTYPE]%-->',$weightTypeVal,$systemParametersBody);
			
			// Packing Unit Start
			$packingNameVal 					= '';
			$PackingQuery 						= "SELECT PACKINGNAMEID,PACKINGNAME FROM fna_packingname ORDER BY PACKINGNAME ASC";
			$PackingQueryStatement				= mysql_query($PackingQuery);
			while($PackingQueryStatementData	= mysql_fetch_array($PackingQueryStatement)) {
				$packingId						= $PackingQueryStatementData["PACKINGNAMEID"];
				$packingName					= $PackingQueryStatementData["PACKINGNAME"];
				$packingNameVal 					.= "<option value='".$packingId."'>".$packingName."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PACKING_NAME_NEW]%-->',$packingNameVal,$systemParametersBody);
			$packingNameVal 	= '';
			$packingViewQuery 	= "
									SELECT
											PACKINGUNITID,
											PACKINGNAMEID,
											QID,
											WTID
									FROM
											fna_packingunit 
									ORDER BY
											PACKINGUNITID
									ASC
								";
			$sv								= 1;
			$packingViewQueryStatement				= mysql_query($packingViewQuery);
			while($packingViewQueryStatementData	= mysql_fetch_array($packingViewQueryStatement)) {
				if($sv%2==0) {
					$class	= "evenRow";
				} else {
					$class	= "oddRow";
				}
				
				$PACKINGUNITID   		= $packingViewQueryStatementData["PACKINGUNITID"];
				$PACKINGNAMEID   		= $packingViewQueryStatementData["PACKINGNAMEID"];
				$QID			   		= $packingViewQueryStatementData["QID"];
				$WTID			   		= $packingViewQueryStatementData["WTID"];
				
				$packingNameQuery = "
									SELECT
											PACKINGNAMEID,
											PACKINGNAME
									FROM
											fna_packingname 
											WHERE PACKINGNAMEID = {$PACKINGNAMEID}
									";
				$packingNameQueryStatement				= mysql_query($packingNameQuery);
				while($packingNameQueryStatementData	= mysql_fetch_array($packingNameQueryStatement)) {
					$PACKINGNAMEID_NEW   		= $packingNameQueryStatementData["PACKINGNAMEID"];
					$PACKINGNAME_NEW   			= $packingNameQueryStatementData["PACKINGNAME"];
					
				}
				
				$QidQuery = "
									SELECT
											QVALUE
									FROM
											fna_quantity 
											WHERE QID = {$QID}
									";
				$QidQueryStatement				= mysql_query($QidQuery);
				while($QidQueryStatementData	= mysql_fetch_array($QidQueryStatement)) {
					$QVALUE   		= $QidQueryStatementData["QVALUE"];
					
				}
				
				$wtidQuery = "
									SELECT
											WNAME
									FROM
											fna_weight 
											WHERE WTID = {$WTID}
									";
				$wtidQueryStatement				= mysql_query($wtidQuery);
				while($wtidQueryStatementData	= mysql_fetch_array($wtidQueryStatement)) {
					$WNAME   		= $wtidQueryStatementData["WNAME"];
					
				}
			
			
			$packingNameVal 					.= "<option value='".$PACKINGUNITID."'>".$PACKINGNAME_NEW.", ".$QVALUE.",".$WNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PACKING_NAME]%-->',$packingNameVal,$systemParametersBody);
			
			//Product View End
			
			
			//Chamber From Start
			$chamberFromVal							= '';
			$chamberFromQuery 						= "SELECT CHID, CHNAME FROM fna_chamber ORDER BY CHNAME ASC";
			$chamberFromQueryStatement				= mysql_query($chamberFromQuery);
			while($chamberFromQueryStatementData	= mysql_fetch_array($chamberFromQueryStatement)) {
				$chamberId							= $chamberFromQueryStatementData["CHID"];
				$chamberName						= $chamberFromQueryStatementData["CHNAME"];
				$chamberFromVal 					.= "<option value='".$chamberId."'>".$chamberName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[CHAMBER_FROM]%-->',$chamberFromVal,$systemParametersBody);
			//Chamber From End
					
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
		//System Party Payment Entry  End
		
		//System Loan Payment Entry Start 
		function getLoanPaymentEntry($empId) {
			$systemParametersBody = $this->getTemplateContent('fnaLoanPayment');
			
			// Project View  Start
			
			$projNameVal 				= '';
			$projQuery 				= "SELECT PROJECTID, PROJECTNAME FROM fna_project ORDER BY PROJECTNAME ASC";
			$projQueryStatement				= mysql_query($projQuery);
			while($projQueryStatementData	= mysql_fetch_array($projQueryStatement)) {
				$PROJECTID					= $projQueryStatementData["PROJECTID"];
				$PROJECTNAME				= $projQueryStatementData["PROJECTNAME"];
				$projNameVal 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$projNameVal,$systemParametersBody);
			// Project View  End
			
			// Labour View Start
			$ptView 		= '';
			$ptViewQuery 	= "
									SELECT
											LABOURNAME,
											FATHERNAME,
											ADDRESS,
											MOBILE
									FROM
											fna_labour 
									ORDER BY
											LABOURNAME
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
				
				$LABOURNAME   = $ptViewStatementData["LABOURNAME"];
				$FATHERNAME   = $ptViewStatementData["FATHERNAME"];
				$ADDRESS      = $ptViewStatementData["ADDRESS"];
				$MOBILE       = $ptViewStatementData["MOBILE"];
				
				$ptView .= "<tr valign='top' class='$class'>
									<td >{$sv}</td>
									<td >{$LABOURNAME}</td>
									<td >{$FATHERNAME}</td>
									<td >{$ADDRESS}</td>
									<td >{$MOBILE}</td>
									<td align='center'>
									<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' />
									</td>
								</tr>";
				
				$sv++;
			}
			$systemParametersBody = str_replace('<!--%[LABOUR_VIEW]%-->',$ptView,$systemParametersBody);
			
			//Labour View End
			
			// Product View  Start
			
			$prodNameVal 				= '';
			$prodQuery 				= "SELECT PRODCATTYPEID, CATEGORYTYPENAME FROM fna_productcattype ORDER BY CATEGORYTYPENAME ASC";
			$prodQueryStatement				= mysql_query($prodQuery);
			while($prodQueryStatementData	= mysql_fetch_array($prodQueryStatement)) {
				$productCatTypeId				= $prodQueryStatementData["PRODCATTYPEID"];
				$catName						= $prodQueryStatementData["CATEGORYTYPENAME"];
				$prodNameVal 					.= "<option value='".$productCatTypeId."'>".$catName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT_NAME]%-->',$prodNameVal,$systemParametersBody);
			
			
			//Labour Name View
			$labourNameVal 				= '';
			$labourQuery 				= "SELECT LABOURID, LABOURNAME FROM fna_labour ORDER BY LABOURNAME ASC";
			$labourQueryStatement				= mysql_query($labourQuery);
			while($labourQueryStatementData	= mysql_fetch_array($labourQueryStatement)) {
				$labourId						= $labourQueryStatementData["LABOURID"];
				$labourName						= $labourQueryStatementData["LABOURNAME"];
				$labourNameVal 					.= "<option value='".$labourId."'>".$labourName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[LABOUR_NAME]%-->',$labourNameVal,$systemParametersBody);
			
			$PartyNameVal 				= '';
			$PartyQuery 				= "SELECT PARTYID, PARTYNAME FROM fna_party ORDER BY PARTYNAME ASC";
			$PartyQueryStatement				= mysql_query($PartyQuery);
			while($PartyQueryStatementData	= mysql_fetch_array($PartyQueryStatement)) {
				$PartyId						= $PartyQueryStatementData["PARTYID"];
				$PartyName						= $PartyQueryStatementData["PARTYNAME"];
				$PartyNameVal 					.= "<option value='".$PartyId."'>".$PartyName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$PartyNameVal,$systemParametersBody);
			
			$PoductCatVal 				= '';
			$ProductCatQuery 				= "SELECT PRODCATTYPEID, CATEGORYTYPENAME FROM fna_productcattype ORDER BY CATEGORYTYPENAME ASC";
			$ProductCatQueryStatement				= mysql_query($ProductCatQuery);
			while($ProductCatQueryStatementData	= mysql_fetch_array($ProductCatQueryStatement)) {
				 $ProductCatId						= $ProductCatQueryStatementData["PRODCATTYPEID"];
				 $ProductCatName						= $ProductCatQueryStatementData["CATEGORYTYPENAME"];
				$PoductCatVal 					.= "<option value='".$ProductCatId."'>".$ProductCatName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT_CATEGORY_NAME]%-->',$PoductCatVal,$systemParametersBody);
			
			$prodCatTypeVal						= '';
			$prodCatQuery 						= "SELECT PRODCATTYPEID,PRODUCTNAME FROM fna_product ORDER BY PRODUCTNAME ASC";
			$prodCatQueryStatement				= mysql_query($prodCatQuery);
			while($prodCatQueryStatementData	= mysql_fetch_array($prodCatQueryStatement)) {
				$PRODCATTYPEID					= $prodCatQueryStatementData["PRODCATTYPEID"];
				$PRODUCTNAME					= $prodCatQueryStatementData["PRODUCTNAME"];
				$prodCatTypeVal					.= "<option value='".$PRODCATTYPEID."'>".$PRODUCTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT]%-->',$prodCatTypeVal,$systemParametersBody);
			
			$QuantityVal 						= '';
			$quantityQuery 						= "SELECT QID,QVALUE FROM fna_quantity ORDER BY QVALUE ASC";
			$quantityQueryStatement				= mysql_query($quantityQuery);
			while($quantityQueryStatementData	= mysql_fetch_array($quantityQueryStatement)) {
				$qId							= $quantityQueryStatementData["QID"];
				$qValue							= $quantityQueryStatementData["QVALUE"];
				$QuantityVal 					.= "<option value='".$qId."'>".$qValue."</option>";
			}
			$systemParametersBody = str_replace('<!--%[QUANTITY]%-->',$QuantityVal,$systemParametersBody);
			
			$weightTypeVal 							= '';
			$weightTypeQuery 						= "SELECT WTID,WNAME FROM fna_weight ORDER BY WNAME ASC";
			$weightTypeQueryStatement				= mysql_query($weightTypeQuery);
			while($weightTypeQueryStatementData		= mysql_fetch_array($weightTypeQueryStatement)) {
				$wtId								= $weightTypeQueryStatementData["WTID"];
				$wtName								= $weightTypeQueryStatementData["WNAME"];
				$weightTypeVal 						.= "<option value='".$wtId."'>".$wtName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[WEIGHTTYPE]%-->',$weightTypeVal,$systemParametersBody);
			
			// Packing Unit Start
			$packingNameVal 					= '';
			$PackingQuery 						= "SELECT PACKINGNAMEID,PACKINGNAME FROM fna_packingname ORDER BY PACKINGNAME ASC";
			$PackingQueryStatement				= mysql_query($PackingQuery);
			while($PackingQueryStatementData	= mysql_fetch_array($PackingQueryStatement)) {
				$packingId						= $PackingQueryStatementData["PACKINGNAMEID"];
				$packingName					= $PackingQueryStatementData["PACKINGNAME"];
				$packingNameVal 					.= "<option value='".$packingId."'>".$packingName."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PACKING_NAME_NEW]%-->',$packingNameVal,$systemParametersBody);
			$packingNameVal 	= '';
			$packingViewQuery 	= "
									SELECT
											PACKINGUNITID,
											PACKINGNAMEID,
											QID,
											WTID
									FROM
											fna_packingunit 
									ORDER BY
											PACKINGUNITID
									ASC
								";
			$sv								= 1;
			$packingViewQueryStatement				= mysql_query($packingViewQuery);
			while($packingViewQueryStatementData	= mysql_fetch_array($packingViewQueryStatement)) {
				if($sv%2==0) {
					$class	= "evenRow";
				} else {
					$class	= "oddRow";
				}
				
				$PACKINGUNITID   		= $packingViewQueryStatementData["PACKINGUNITID"];
				$PACKINGNAMEID   		= $packingViewQueryStatementData["PACKINGNAMEID"];
				$QID			   		= $packingViewQueryStatementData["QID"];
				$WTID			   		= $packingViewQueryStatementData["WTID"];
				
				$packingNameQuery = "
									SELECT
											PACKINGNAMEID,
											PACKINGNAME
									FROM
											fna_packingname 
											WHERE PACKINGNAMEID = {$PACKINGNAMEID}
									";
				$packingNameQueryStatement				= mysql_query($packingNameQuery);
				while($packingNameQueryStatementData	= mysql_fetch_array($packingNameQueryStatement)) {
					$PACKINGNAMEID_NEW   		= $packingNameQueryStatementData["PACKINGNAMEID"];
					$PACKINGNAME_NEW   			= $packingNameQueryStatementData["PACKINGNAME"];
					
				}
				
				$QidQuery = "
									SELECT
											QVALUE
									FROM
											fna_quantity 
											WHERE QID = {$QID}
									";
				$QidQueryStatement				= mysql_query($QidQuery);
				while($QidQueryStatementData	= mysql_fetch_array($QidQueryStatement)) {
					$QVALUE   		= $QidQueryStatementData["QVALUE"];
					
				}
				
				$wtidQuery = "
									SELECT
											WNAME
									FROM
											fna_weight 
											WHERE WTID = {$WTID}
									";
				$wtidQueryStatement				= mysql_query($wtidQuery);
				while($wtidQueryStatementData	= mysql_fetch_array($wtidQueryStatement)) {
					$WNAME   		= $wtidQueryStatementData["WNAME"];
					
				}
			
			
			$packingNameVal 					.= "<option value='".$PACKINGUNITID."'>".$PACKINGNAME_NEW.", ".$QVALUE.",".$WNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PACKING_NAME]%-->',$packingNameVal,$systemParametersBody);
			
			//Product View End
			
			
			//Chamber From Start
			$chamberFromVal							= '';
			$chamberFromQuery 						= "SELECT CHID, CHNAME FROM fna_chamber ORDER BY CHNAME ASC";
			$chamberFromQueryStatement				= mysql_query($chamberFromQuery);
			while($chamberFromQueryStatementData	= mysql_fetch_array($chamberFromQueryStatement)) {
				$chamberId							= $chamberFromQueryStatementData["CHID"];
				$chamberName						= $chamberFromQueryStatementData["CHNAME"];
				$chamberFromVal 					.= "<option value='".$chamberId."'>".$chamberName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[CHAMBER_FROM]%-->',$chamberFromVal,$systemParametersBody);
			//Chamber From End
					
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
		//System Loan Payment Entry  End
		
		//System Loan Payment Entry Start 
		function getTransferEditEntry($empId) {
			$systemParametersBody = $this->getTemplateContent('editTransferEntry');
			
			// Project View  Start
			
			$projNameVal 				= '';
			$projQuery 				= "SELECT PROJECTID, PROJECTNAME FROM fna_project ORDER BY PROJECTNAME ASC";
			$projQueryStatement				= mysql_query($projQuery);
			while($projQueryStatementData	= mysql_fetch_array($projQueryStatement)) {
				$PROJECTID					= $projQueryStatementData["PROJECTID"];
				$PROJECTNAME				= $projQueryStatementData["PROJECTNAME"];
				$projNameVal 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$projNameVal,$systemParametersBody);
			// Project View  End
			
			// Labour View Start
			$ptView 		= '';
			$ptViewQuery 	= "
									SELECT
											LABOURNAME,
											FATHERNAME,
											ADDRESS,
											MOBILE
									FROM
											fna_labour 
									ORDER BY
											LABOURNAME
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
				
				$LABOURNAME   = $ptViewStatementData["LABOURNAME"];
				$FATHERNAME   = $ptViewStatementData["FATHERNAME"];
				$ADDRESS      = $ptViewStatementData["ADDRESS"];
				$MOBILE       = $ptViewStatementData["MOBILE"];
				
				$ptView .= "<tr valign='top' class='$class'>
									<td >{$sv}</td>
									<td >{$LABOURNAME}</td>
									<td >{$FATHERNAME}</td>
									<td >{$ADDRESS}</td>
									<td >{$MOBILE}</td>
									<td align='center'>
									<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' />
									</td>
								</tr>";
				
				$sv++;
			}
			$systemParametersBody = str_replace('<!--%[LABOUR_VIEW]%-->',$ptView,$systemParametersBody);
			
			//Labour View End
			
			// Product View  Start
			
			$prodNameVal 				= '';
			$prodQuery 				= "SELECT PRODCATTYPEID, CATEGORYTYPENAME FROM fna_productcattype ORDER BY CATEGORYTYPENAME ASC";
			$prodQueryStatement				= mysql_query($prodQuery);
			while($prodQueryStatementData	= mysql_fetch_array($prodQueryStatement)) {
				$productCatTypeId				= $prodQueryStatementData["PRODCATTYPEID"];
				$catName						= $prodQueryStatementData["CATEGORYTYPENAME"];
				$prodNameVal 					.= "<option value='".$productCatTypeId."'>".$catName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT_NAME]%-->',$prodNameVal,$systemParametersBody);
			
			
			//Labour Name View
			$labourNameVal 				= '';
			$labourQuery 				= "SELECT LABOURID, LABOURNAME FROM fna_labour ORDER BY LABOURNAME ASC";
			$labourQueryStatement				= mysql_query($labourQuery);
			while($labourQueryStatementData	= mysql_fetch_array($labourQueryStatement)) {
				$labourId						= $labourQueryStatementData["LABOURID"];
				$labourName						= $labourQueryStatementData["LABOURNAME"];
				$labourNameVal 					.= "<option value='".$labourId."'>".$labourName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[LABOUR_NAME]%-->',$labourNameVal,$systemParametersBody);
			
			$PartyNameVal 				= '';
			$PartyQuery 				= "SELECT PARTYID, PARTYNAME FROM fna_party ORDER BY PARTYNAME ASC";
			$PartyQueryStatement				= mysql_query($PartyQuery);
			while($PartyQueryStatementData	= mysql_fetch_array($PartyQueryStatement)) {
				$PartyId						= $PartyQueryStatementData["PARTYID"];
				$PartyName						= $PartyQueryStatementData["PARTYNAME"];
				$PartyNameVal 					.= "<option value='".$PartyId."'>".$PartyName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$PartyNameVal,$systemParametersBody);
			
			$PoductCatVal 				= '';
			$ProductCatQuery 				= "SELECT PRODCATTYPEID, CATEGORYTYPENAME FROM fna_productcattype ORDER BY CATEGORYTYPENAME ASC";
			$ProductCatQueryStatement				= mysql_query($ProductCatQuery);
			while($ProductCatQueryStatementData	= mysql_fetch_array($ProductCatQueryStatement)) {
				 $ProductCatId						= $ProductCatQueryStatementData["PRODCATTYPEID"];
				 $ProductCatName						= $ProductCatQueryStatementData["CATEGORYTYPENAME"];
				$PoductCatVal 					.= "<option value='".$ProductCatId."'>".$ProductCatName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT_CATEGORY_NAME]%-->',$PoductCatVal,$systemParametersBody);
			
			$prodCatTypeVal						= '';
			$prodCatQuery 						= "SELECT PRODCATTYPEID,PRODUCTNAME FROM fna_product ORDER BY PRODUCTNAME ASC";
			$prodCatQueryStatement				= mysql_query($prodCatQuery);
			while($prodCatQueryStatementData	= mysql_fetch_array($prodCatQueryStatement)) {
				$PRODCATTYPEID					= $prodCatQueryStatementData["PRODCATTYPEID"];
				$PRODUCTNAME					= $prodCatQueryStatementData["PRODUCTNAME"];
				$prodCatTypeVal					.= "<option value='".$PRODCATTYPEID."'>".$PRODUCTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT]%-->',$prodCatTypeVal,$systemParametersBody);
			
			$QuantityVal 						= '';
			$quantityQuery 						= "SELECT QID,QVALUE FROM fna_quantity ORDER BY QVALUE ASC";
			$quantityQueryStatement				= mysql_query($quantityQuery);
			while($quantityQueryStatementData	= mysql_fetch_array($quantityQueryStatement)) {
				$qId							= $quantityQueryStatementData["QID"];
				$qValue							= $quantityQueryStatementData["QVALUE"];
				$QuantityVal 					.= "<option value='".$qId."'>".$qValue."</option>";
			}
			$systemParametersBody = str_replace('<!--%[QUANTITY]%-->',$QuantityVal,$systemParametersBody);
			
			$weightTypeVal 							= '';
			$weightTypeQuery 						= "SELECT WTID,WNAME FROM fna_weight ORDER BY WNAME ASC";
			$weightTypeQueryStatement				= mysql_query($weightTypeQuery);
			while($weightTypeQueryStatementData		= mysql_fetch_array($weightTypeQueryStatement)) {
				$wtId								= $weightTypeQueryStatementData["WTID"];
				$wtName								= $weightTypeQueryStatementData["WNAME"];
				$weightTypeVal 						.= "<option value='".$wtId."'>".$wtName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[WEIGHTTYPE]%-->',$weightTypeVal,$systemParametersBody);
			
			// Packing Unit Start
			$packingNameVal 					= '';
			$PackingQuery 						= "SELECT PACKINGNAMEID,PACKINGNAME FROM fna_packingname ORDER BY PACKINGNAME ASC";
			$PackingQueryStatement				= mysql_query($PackingQuery);
			while($PackingQueryStatementData	= mysql_fetch_array($PackingQueryStatement)) {
				$packingId						= $PackingQueryStatementData["PACKINGNAMEID"];
				$packingName					= $PackingQueryStatementData["PACKINGNAME"];
				$packingNameVal 					.= "<option value='".$packingId."'>".$packingName."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PACKING_NAME_NEW]%-->',$packingNameVal,$systemParametersBody);
			$packingNameVal 	= '';
			$packingViewQuery 	= "
									SELECT
											PACKINGUNITID,
											PACKINGNAMEID,
											QID,
											WTID
									FROM
											fna_packingunit 
									ORDER BY
											PACKINGUNITID
									ASC
								";
			$sv								= 1;
			$packingViewQueryStatement				= mysql_query($packingViewQuery);
			while($packingViewQueryStatementData	= mysql_fetch_array($packingViewQueryStatement)) {
				if($sv%2==0) {
					$class	= "evenRow";
				} else {
					$class	= "oddRow";
				}
				
				$PACKINGUNITID   		= $packingViewQueryStatementData["PACKINGUNITID"];
				$PACKINGNAMEID   		= $packingViewQueryStatementData["PACKINGNAMEID"];
				$QID			   		= $packingViewQueryStatementData["QID"];
				$WTID			   		= $packingViewQueryStatementData["WTID"];
				
				$packingNameQuery = "
									SELECT
											PACKINGNAMEID,
											PACKINGNAME
									FROM
											fna_packingname 
											WHERE PACKINGNAMEID = {$PACKINGNAMEID}
									";
				$packingNameQueryStatement				= mysql_query($packingNameQuery);
				while($packingNameQueryStatementData	= mysql_fetch_array($packingNameQueryStatement)) {
					$PACKINGNAMEID_NEW   		= $packingNameQueryStatementData["PACKINGNAMEID"];
					$PACKINGNAME_NEW   			= $packingNameQueryStatementData["PACKINGNAME"];
					
				}
				
				$QidQuery = "
									SELECT
											QVALUE
									FROM
											fna_quantity 
											WHERE QID = {$QID}
									";
				$QidQueryStatement				= mysql_query($QidQuery);
				while($QidQueryStatementData	= mysql_fetch_array($QidQueryStatement)) {
					$QVALUE   		= $QidQueryStatementData["QVALUE"];
					
				}
				
				$wtidQuery = "
									SELECT
											WNAME
									FROM
											fna_weight 
											WHERE WTID = {$WTID}
									";
				$wtidQueryStatement				= mysql_query($wtidQuery);
				while($wtidQueryStatementData	= mysql_fetch_array($wtidQueryStatement)) {
					$WNAME   		= $wtidQueryStatementData["WNAME"];
					
				}
			
			
			$packingNameVal 					.= "<option value='".$PACKINGUNITID."'>".$PACKINGNAME_NEW.", ".$QVALUE.",".$WNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PACKING_NAME]%-->',$packingNameVal,$systemParametersBody);
			
			//Product View End
			
			
			//Chamber From Start
			$chamberFromVal							= '';
			$chamberFromQuery 						= "SELECT CHID, CHNAME FROM fna_chamber ORDER BY CHNAME ASC";
			$chamberFromQueryStatement				= mysql_query($chamberFromQuery);
			while($chamberFromQueryStatementData	= mysql_fetch_array($chamberFromQueryStatement)) {
				$chamberId							= $chamberFromQueryStatementData["CHID"];
				$chamberName						= $chamberFromQueryStatementData["CHNAME"];
				$chamberFromVal 					.= "<option value='".$chamberId."'>".$chamberName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[CHAMBER_FROM]%-->',$chamberFromVal,$systemParametersBody);
			//Chamber From End
					
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
		//System Loan Payment Entry  End
		
		//System Alu Unload Entry Start 
		function getAluUnloadEntry($empId) {
			$systemParametersBody = $this->getTemplateContent('fnaAluUnload');
			
			// Project View  Start
			
			$projNameVal 				= '';
			$projQuery 				= "SELECT PROJECTID, PROJECTNAME FROM fna_project ORDER BY PROJECTNAME ASC";
			$projQueryStatement				= mysql_query($projQuery);
			while($projQueryStatementData	= mysql_fetch_array($projQueryStatement)) {
				$PROJECTID					= $projQueryStatementData["PROJECTID"];
				$PROJECTNAME				= $projQueryStatementData["PROJECTNAME"];
				$projNameVal 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$projNameVal,$systemParametersBody);
			// Project View  End
			
			// Labour View Start
			$ptView 		= '';
			$ptViewQuery 	= "
									SELECT
											LABOURNAME,
											FATHERNAME,
											ADDRESS,
											MOBILE
									FROM
											fna_labour 
									ORDER BY
											LABOURNAME
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
				
				$LABOURNAME   = $ptViewStatementData["LABOURNAME"];
				$FATHERNAME   = $ptViewStatementData["FATHERNAME"];
				$ADDRESS      = $ptViewStatementData["ADDRESS"];
				$MOBILE       = $ptViewStatementData["MOBILE"];
				
				$ptView .= "<tr valign='top' class='$class'>
									<td >{$sv}</td>
									<td >{$LABOURNAME}</td>
									<td >{$FATHERNAME}</td>
									<td >{$ADDRESS}</td>
									<td >{$MOBILE}</td>
									<td align='center'>
									<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' />
									</td>
								</tr>";
				
				$sv++;
			}
			$systemParametersBody = str_replace('<!--%[LABOUR_VIEW]%-->',$ptView,$systemParametersBody);
			
			//Labour View End
			
			// Product View  Start
			
			$prodNameVal 				= '';
			$prodQuery 				= "SELECT PRODCATTYPEID, CATEGORYTYPENAME FROM fna_productcattype ORDER BY CATEGORYTYPENAME ASC";
			$prodQueryStatement				= mysql_query($prodQuery);
			while($prodQueryStatementData	= mysql_fetch_array($prodQueryStatement)) {
				$productCatTypeId				= $prodQueryStatementData["PRODCATTYPEID"];
				$catName						= $prodQueryStatementData["CATEGORYTYPENAME"];
				$prodNameVal 					.= "<option value='".$productCatTypeId."'>".$catName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT_NAME]%-->',$prodNameVal,$systemParametersBody);
			
			
			//Labour Name View
			$labourNameVal 				= '';
			$labourQuery 				= "SELECT LABOURID, LABOURNAME FROM fna_labour ORDER BY LABOURNAME ASC";
			$labourQueryStatement				= mysql_query($labourQuery);
			while($labourQueryStatementData	= mysql_fetch_array($labourQueryStatement)) {
				$labourId						= $labourQueryStatementData["LABOURID"];
				$labourName						= $labourQueryStatementData["LABOURNAME"];
				$labourNameVal 					.= "<option value='".$labourId."'>".$labourName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[LABOUR_NAME]%-->',$labourNameVal,$systemParametersBody);
			
			$PartyNameVal 				= '';
			$PartyQuery 				= "SELECT PARTYID, PARTYNAME FROM fna_party ORDER BY PARTYNAME ASC";
			$PartyQueryStatement				= mysql_query($PartyQuery);
			while($PartyQueryStatementData	= mysql_fetch_array($PartyQueryStatement)) {
				$PartyId						= $PartyQueryStatementData["PARTYID"];
				$PartyName						= $PartyQueryStatementData["PARTYNAME"];
				$PartyNameVal 					.= "<option value='".$PartyId."'>".$PartyName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$PartyNameVal,$systemParametersBody);
			
			$PoductCatVal 				= '';
			$ProductCatQuery 				= "SELECT PRODCATTYPEID, CATEGORYTYPENAME FROM fna_productcattype ORDER BY CATEGORYTYPENAME ASC";
			$ProductCatQueryStatement				= mysql_query($ProductCatQuery);
			while($ProductCatQueryStatementData	= mysql_fetch_array($ProductCatQueryStatement)) {
				 $ProductCatId						= $ProductCatQueryStatementData["PRODCATTYPEID"];
				 $ProductCatName						= $ProductCatQueryStatementData["CATEGORYTYPENAME"];
				$PoductCatVal 					.= "<option value='".$ProductCatId."'>".$ProductCatName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT_CATEGORY_NAME]%-->',$PoductCatVal,$systemParametersBody);
			
			$prodCatTypeVal						= '';
			$prodCatQuery 						= "SELECT PRODCATTYPEID,PRODUCTNAME FROM fna_product ORDER BY PRODUCTNAME ASC";
			$prodCatQueryStatement				= mysql_query($prodCatQuery);
			while($prodCatQueryStatementData	= mysql_fetch_array($prodCatQueryStatement)) {
				$PRODCATTYPEID					= $prodCatQueryStatementData["PRODCATTYPEID"];
				$PRODUCTNAME					= $prodCatQueryStatementData["PRODUCTNAME"];
				$prodCatTypeVal					.= "<option value='".$PRODCATTYPEID."'>".$PRODUCTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT]%-->',$prodCatTypeVal,$systemParametersBody);
			
			$QuantityVal 						= '';
			$quantityQuery 						= "SELECT QID,QVALUE FROM fna_quantity ORDER BY QVALUE ASC";
			$quantityQueryStatement				= mysql_query($quantityQuery);
			while($quantityQueryStatementData	= mysql_fetch_array($quantityQueryStatement)) {
				$qId							= $quantityQueryStatementData["QID"];
				$qValue							= $quantityQueryStatementData["QVALUE"];
				$QuantityVal 					.= "<option value='".$qId."'>".$qValue."</option>";
			}
			$systemParametersBody = str_replace('<!--%[QUANTITY]%-->',$QuantityVal,$systemParametersBody);
			
			$weightTypeVal 							= '';
			$weightTypeQuery 						= "SELECT WTID,WNAME FROM fna_weight ORDER BY WNAME ASC";
			$weightTypeQueryStatement				= mysql_query($weightTypeQuery);
			while($weightTypeQueryStatementData		= mysql_fetch_array($weightTypeQueryStatement)) {
				$wtId								= $weightTypeQueryStatementData["WTID"];
				$wtName								= $weightTypeQueryStatementData["WNAME"];
				$weightTypeVal 						.= "<option value='".$wtId."'>".$wtName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[WEIGHTTYPE]%-->',$weightTypeVal,$systemParametersBody);
			
			// Packing Unit Start
			$packingNameVal 					= '';
			$PackingQuery 						= "SELECT PACKINGNAMEID,PACKINGNAME FROM fna_packingname ORDER BY PACKINGNAME ASC";
			$PackingQueryStatement				= mysql_query($PackingQuery);
			while($PackingQueryStatementData	= mysql_fetch_array($PackingQueryStatement)) {
				$packingId						= $PackingQueryStatementData["PACKINGNAMEID"];
				$packingName					= $PackingQueryStatementData["PACKINGNAME"];
				$packingNameVal 					.= "<option value='".$packingId."'>".$packingName."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PACKING_NAME_NEW]%-->',$packingNameVal,$systemParametersBody);
			$packingNameVal 	= '';
			$packingViewQuery 	= "
									SELECT
											PACKINGUNITID,
											PACKINGNAMEID,
											QID,
											WTID
									FROM
											fna_packingunit 
									ORDER BY
											PACKINGUNITID
									ASC
								";
			$sv								= 1;
			$packingViewQueryStatement				= mysql_query($packingViewQuery);
			while($packingViewQueryStatementData	= mysql_fetch_array($packingViewQueryStatement)) {
				if($sv%2==0) {
					$class	= "evenRow";
				} else {
					$class	= "oddRow";
				}
				
				$PACKINGUNITID   		= $packingViewQueryStatementData["PACKINGUNITID"];
				$PACKINGNAMEID   		= $packingViewQueryStatementData["PACKINGNAMEID"];
				$QID			   		= $packingViewQueryStatementData["QID"];
				$WTID			   		= $packingViewQueryStatementData["WTID"];
				
				$packingNameQuery = "
									SELECT
											PACKINGNAMEID,
											PACKINGNAME
									FROM
											fna_packingname 
											WHERE PACKINGNAMEID = {$PACKINGNAMEID}
									";
				$packingNameQueryStatement				= mysql_query($packingNameQuery);
				while($packingNameQueryStatementData	= mysql_fetch_array($packingNameQueryStatement)) {
					$PACKINGNAMEID_NEW   		= $packingNameQueryStatementData["PACKINGNAMEID"];
					$PACKINGNAME_NEW   			= $packingNameQueryStatementData["PACKINGNAME"];
					
				}
				
				$QidQuery = "
									SELECT
											QVALUE
									FROM
											fna_quantity 
											WHERE QID = {$QID}
									";
				$QidQueryStatement				= mysql_query($QidQuery);
				while($QidQueryStatementData	= mysql_fetch_array($QidQueryStatement)) {
					$QVALUE   		= $QidQueryStatementData["QVALUE"];
					
				}
				
				$wtidQuery = "
									SELECT
											WNAME
									FROM
											fna_weight 
											WHERE WTID = {$WTID}
									";
				$wtidQueryStatement				= mysql_query($wtidQuery);
				while($wtidQueryStatementData	= mysql_fetch_array($wtidQueryStatement)) {
					$WNAME   		= $wtidQueryStatementData["WNAME"];
					
				}
			
			
			$packingNameVal 					.= "<option value='".$PACKINGUNITID."'>".$PACKINGNAME_NEW.", ".$QVALUE.",".$WNAME."</option>";
			}
			
			$systemParametersBody = str_replace('<!--%[PACKING_NAME]%-->',$packingNameVal,$systemParametersBody);
			
			//Product View End
			
			
			//Chamber From Start
			$chamberFromVal							= '';
			$chamberFromQuery 						= "SELECT CHID, CHNAME FROM fna_chamber WHERE CHID = 2 ORDER BY CHNAME ASC";
			$chamberFromQueryStatement				= mysql_query($chamberFromQuery);
			while($chamberFromQueryStatementData	= mysql_fetch_array($chamberFromQueryStatement)) {
				$chamberId							= $chamberFromQueryStatementData["CHID"];
				$chamberName						= $chamberFromQueryStatementData["CHNAME"];
				$chamberFromVal 					.= "<option value='".$chamberId."'>".$chamberName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[CHAMBER_FROM]%-->',$chamberFromVal,$systemParametersBody);
			//Chamber From End
					
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
		//System Alu Unload Entry  End
		
		//System Expanse Entry Start
		function getExpanseEntry($empId) {
			$systemParametersBody = $this->getTemplateContent('fnaExpanse');
			
			// Project View  Start
			
			$projNameVal 				= '';
			$projQuery 				= "SELECT PROJECTID, PROJECTNAME FROM fna_project ORDER BY PROJECTNAME ASC";
			$projQueryStatement				= mysql_query($projQuery);
			while($projQueryStatementData	= mysql_fetch_array($projQueryStatement)) {
				$PROJECTID					= $projQueryStatementData["PROJECTID"];
				$PROJECTNAME				= $projQueryStatementData["PROJECTNAME"];
				$projNameVal 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$projNameVal,$systemParametersBody);
			// Project View  End
			
			// Expanse Head View  Start
			
			$ExpHeadNameVal 					= '';
			$ExpHeadQuery 						= "SELECT EXPHID, EXPHEADNAME FROM fna_expense_head ORDER BY EXPHEADNAME ASC";
			$ExpHeadQueryStatement				= mysql_query($ExpHeadQuery);
			while($ExpHeadQueryStatementData	= mysql_fetch_array($ExpHeadQueryStatement)) {
				$EXPHID							= $ExpHeadQueryStatementData["EXPHID"];
				$EXPHEADNAME					= $ExpHeadQueryStatementData["EXPHEADNAME"];
				$ExpHeadNameVal 					.= "<option value='".$EXPHID."'>".$EXPHEADNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[EXPANSE_HEAD_NAME]%-->',$ExpHeadNameVal,$systemParametersBody);
			// Expanse Head View  End
			
			$PartyNameVal 				= '';
			$PartyQuery 				= "SELECT PARTYID, PARTYNAME FROM fna_party ORDER BY PARTYNAME ASC";
			$PartyQueryStatement				= mysql_query($PartyQuery);
			while($PartyQueryStatementData	= mysql_fetch_array($PartyQueryStatement)) {
				$PartyId						= $PartyQueryStatementData["PARTYID"];
				$PartyName						= $PartyQueryStatementData["PARTYNAME"];
				$PartyNameVal 					.= "<option value='".$PartyId."'>".$PartyName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$PartyNameVal,$systemParametersBody);
			
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
			
			
			//Batch Select start
			
			$BatchVal 							= '';
			$BatchQuery 						= "SELECT DISTINCT BATCHNO FROM pal_batchopen ORDER BY BATCHNO DESC";
			$BatchQueryStatement				= mysql_query($BatchQuery);
			while($BatchQueryStatementData		= mysql_fetch_array($BatchQueryStatement)) {
				$BATCHNO						= $BatchQueryStatementData["BATCHNO"];
				$BatchVal 						.= "<option value='".$BATCHNO."'>".$BATCHNO."</option>";
			}
			$systemParametersBody = str_replace('<!--%[BATCH_NO]%-->',$BatchVal,$systemParametersBody);
			
			//Batch Select End 
			
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
		//System Expanse Entry  End
		
		//Alu Booking Money Entry Start
		function getAluBookingMoneyEntry($empId) {
			$systemParametersBody = $this->getTemplateContent('fnaBookingMoney');
			
			// Project View  Start
			
			$projNameVal 				= '';
			$projQuery 				= "SELECT PROJECTID, PROJECTNAME FROM fna_project WHERE PROJECTID = 1 ORDER BY PROJECTNAME ASC";
			$projQueryStatement				= mysql_query($projQuery);
			while($projQueryStatementData	= mysql_fetch_array($projQueryStatement)) {
				$PROJECTID					= $projQueryStatementData["PROJECTID"];
				$PROJECTNAME				= $projQueryStatementData["PROJECTNAME"];
				$projNameVal 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$projNameVal,$systemParametersBody);
			// Project View  End
			
			// Expanse Head View  Start
			
			$ExpHeadNameVal 					= '';
			$ExpHeadQuery 						= "SELECT EXPHID, EXPHEADNAME FROM fna_expense_head ORDER BY EXPHEADNAME ASC";
			$ExpHeadQueryStatement				= mysql_query($ExpHeadQuery);
			while($ExpHeadQueryStatementData	= mysql_fetch_array($ExpHeadQueryStatement)) {
				$EXPHID							= $ExpHeadQueryStatementData["EXPHID"];
				$EXPHEADNAME					= $ExpHeadQueryStatementData["EXPHEADNAME"];
				$ExpHeadNameVal 					.= "<option value='".$EXPHID."'>".$EXPHEADNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[EXPANSE_HEAD_NAME]%-->',$ExpHeadNameVal,$systemParametersBody);
			// Expanse Head View  End
			
			$PartyNameVal 				= '';
			$PartyQuery 				= "SELECT PARTYID, PARTYNAME FROM fna_party ORDER BY PARTYNAME ASC";
			$PartyQueryStatement				= mysql_query($PartyQuery);
			while($PartyQueryStatementData	= mysql_fetch_array($PartyQueryStatement)) {
				$PartyId						= $PartyQueryStatementData["PARTYID"];
				$PartyName						= $PartyQueryStatementData["PARTYNAME"];
				$PartyNameVal 					.= "<option value='".$PartyId."'>".$PartyName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$PartyNameVal,$systemParametersBody);
			
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
			
			// Income Head View  Start
			
			$IncHeadNameVal 					= '';
			$IncHeadQuery 						= "SELECT INHID, INCHEADNAME FROM fna_income_head ORDER BY INCHEADNAME ASC";
			$IncHeadQueryStatement				= mysql_query($IncHeadQuery);
			while($IncHeadQueryStatementData	= mysql_fetch_array($IncHeadQueryStatement)) {
				$INHID							= $IncHeadQueryStatementData["INHID"];
				$INCHEADNAME					= $IncHeadQueryStatementData["INCHEADNAME"];
				$IncHeadNameVal 					.= "<option value='".$INHID."'>".$INCHEADNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[INCOME_HEAD_NAME]%-->',$IncHeadNameVal,$systemParametersBody);
			// Income Head View  End
			
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
		//Alu Booking Money  Entry  End
		
		//Alu Booking Money Refund Entry Start
		function getAluBookingMoneyRefundEntry($empId) {
			$systemParametersBody = $this->getTemplateContent('fnaBookingMoneyRefund');
			
			// Project View  Start
			
			$projNameVal 				= '';
			$projQuery 				= "SELECT PROJECTID, PROJECTNAME FROM fna_project WHERE PROJECTID = 1 ORDER BY PROJECTNAME ASC";
			$projQueryStatement				= mysql_query($projQuery);
			while($projQueryStatementData	= mysql_fetch_array($projQueryStatement)) {
				$PROJECTID					= $projQueryStatementData["PROJECTID"];
				$PROJECTNAME				= $projQueryStatementData["PROJECTNAME"];
				$projNameVal 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$projNameVal,$systemParametersBody);
			// Project View  End
			
			// Expanse Head View  Start
			
			$ExpHeadNameVal 					= '';
			$ExpHeadQuery 						= "SELECT EXPHID, EXPHEADNAME FROM fna_expense_head ORDER BY EXPHEADNAME ASC";
			$ExpHeadQueryStatement				= mysql_query($ExpHeadQuery);
			while($ExpHeadQueryStatementData	= mysql_fetch_array($ExpHeadQueryStatement)) {
				$EXPHID							= $ExpHeadQueryStatementData["EXPHID"];
				$EXPHEADNAME					= $ExpHeadQueryStatementData["EXPHEADNAME"];
				$ExpHeadNameVal 					.= "<option value='".$EXPHID."'>".$EXPHEADNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[EXPANSE_HEAD_NAME]%-->',$ExpHeadNameVal,$systemParametersBody);
			// Expanse Head View  End
			
			$PartyNameVal 				= '';
			$PartyQuery 				= "SELECT PARTYID, PARTYNAME FROM fna_party ORDER BY PARTYNAME ASC";
			$PartyQueryStatement				= mysql_query($PartyQuery);
			while($PartyQueryStatementData	= mysql_fetch_array($PartyQueryStatement)) {
				$PartyId						= $PartyQueryStatementData["PARTYID"];
				$PartyName						= $PartyQueryStatementData["PARTYNAME"];
				$PartyNameVal 					.= "<option value='".$PartyId."'>".$PartyName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$PartyNameVal,$systemParametersBody);
			
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
			
			// Income Head View  Start
			
			$IncHeadNameVal 					= '';
			$IncHeadQuery 						= "SELECT INHID, INCHEADNAME FROM fna_income_head ORDER BY INCHEADNAME ASC";
			$IncHeadQueryStatement				= mysql_query($IncHeadQuery);
			while($IncHeadQueryStatementData	= mysql_fetch_array($IncHeadQueryStatement)) {
				$INHID							= $IncHeadQueryStatementData["INHID"];
				$INCHEADNAME					= $IncHeadQueryStatementData["INCHEADNAME"];
				$IncHeadNameVal 					.= "<option value='".$INHID."'>".$INCHEADNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[INCOME_HEAD_NAME]%-->',$IncHeadNameVal,$systemParametersBody);
			// Income Head View  End
			
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
		//Alu Booking Money Refund Entry  End
		
		//Alu Commission Entry Start
		function getAluCommissionEntry($empId) {
			$systemParametersBody = $this->getTemplateContent('fnaAluCommission');
			
			// Project View  Start
			
			$projNameVal 				= '';
			$projQuery 				= "SELECT PROJECTID, PROJECTNAME FROM fna_project WHERE PROJECTID = 18 ORDER BY PROJECTNAME ASC";
			$projQueryStatement				= mysql_query($projQuery);
			while($projQueryStatementData	= mysql_fetch_array($projQueryStatement)) {
				$PROJECTID					= $projQueryStatementData["PROJECTID"];
				$PROJECTNAME				= $projQueryStatementData["PROJECTNAME"];
				$projNameVal 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$projNameVal,$systemParametersBody);
			// Project View  End
			
			// Expanse Head View  Start
			
			$ExpHeadNameVal 					= '';
			$ExpHeadQuery 						= "SELECT EXPHID, EXPHEADNAME FROM fna_expense_head ORDER BY EXPHEADNAME ASC";
			$ExpHeadQueryStatement				= mysql_query($ExpHeadQuery);
			while($ExpHeadQueryStatementData	= mysql_fetch_array($ExpHeadQueryStatement)) {
				$EXPHID							= $ExpHeadQueryStatementData["EXPHID"];
				$EXPHEADNAME					= $ExpHeadQueryStatementData["EXPHEADNAME"];
				$ExpHeadNameVal 					.= "<option value='".$EXPHID."'>".$EXPHEADNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[EXPANSE_HEAD_NAME]%-->',$ExpHeadNameVal,$systemParametersBody);
			// Expanse Head View  End
			
			$PartyNameVal 				= '';
			$PartyQuery 				= "SELECT PARTYID, PARTYNAME FROM fna_party ORDER BY PARTYNAME ASC";
			$PartyQueryStatement				= mysql_query($PartyQuery);
			while($PartyQueryStatementData	= mysql_fetch_array($PartyQueryStatement)) {
				$PartyId						= $PartyQueryStatementData["PARTYID"];
				$PartyName						= $PartyQueryStatementData["PARTYNAME"];
				$PartyNameVal 					.= "<option value='".$PartyId."'>".$PartyName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$PartyNameVal,$systemParametersBody);
			
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
			
			// Income Head View  Start
			
			$IncHeadNameVal 					= '';
			$IncHeadQuery 						= "SELECT INHID, INCHEADNAME FROM fna_income_head ORDER BY INCHEADNAME ASC";
			$IncHeadQueryStatement				= mysql_query($IncHeadQuery);
			while($IncHeadQueryStatementData	= mysql_fetch_array($IncHeadQueryStatement)) {
				$INHID							= $IncHeadQueryStatementData["INHID"];
				$INCHEADNAME					= $IncHeadQueryStatementData["INCHEADNAME"];
				$IncHeadNameVal 					.= "<option value='".$INHID."'>".$INCHEADNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[INCOME_HEAD_NAME]%-->',$IncHeadNameVal,$systemParametersBody);
			// Income Head View  End
			
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
		//Alu Commission Entry  End
		
		//System Expanse Entry Start
		function getIncomeEntry($empId) {
			$systemParametersBody = $this->getTemplateContent('fnaIncome');
			
			// Project View  Start
			
			$projNameVal 				= '';
			$projQuery 				= "SELECT PROJECTID, PROJECTNAME FROM fna_project ORDER BY PROJECTNAME ASC";
			$projQueryStatement				= mysql_query($projQuery);
			while($projQueryStatementData	= mysql_fetch_array($projQueryStatement)) {
				$PROJECTID					= $projQueryStatementData["PROJECTID"];
				$PROJECTNAME				= $projQueryStatementData["PROJECTNAME"];
				$projNameVal 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$projNameVal,$systemParametersBody);
			// Project View  End
			
			// Income Head View  Start
			
			$IncHeadNameVal 					= '';
			$IncHeadQuery 						= "SELECT INHID, INCHEADNAME FROM fna_income_head ORDER BY INCHEADNAME ASC";
			$IncHeadQueryStatement				= mysql_query($IncHeadQuery);
			while($IncHeadQueryStatementData	= mysql_fetch_array($IncHeadQueryStatement)) {
				$INHID							= $IncHeadQueryStatementData["INHID"];
				$INCHEADNAME					= $IncHeadQueryStatementData["INCHEADNAME"];
				$IncHeadNameVal 					.= "<option value='".$INHID."'>".$INCHEADNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[INCOME_HEAD_NAME]%-->',$IncHeadNameVal,$systemParametersBody);
			// Income Head View  End
			
			$PartyNameVal 				= '';
			$PartyQuery 				= "SELECT PARTYID, PARTYNAME FROM fna_party ORDER BY PARTYNAME ASC";
			$PartyQueryStatement				= mysql_query($PartyQuery);
			while($PartyQueryStatementData	= mysql_fetch_array($PartyQueryStatement)) {
				$PartyId						= $PartyQueryStatementData["PARTYID"];
				$PartyName						= $PartyQueryStatementData["PARTYNAME"];
				$PartyNameVal 					.= "<option value='".$PartyId."'>".$PartyName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$PartyNameVal,$systemParametersBody);
			
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
			
			//Batch Select start
			
			$BatchVal 							= '';
			$BatchQuery 						= "SELECT DISTINCT BATCHNO FROM pal_batchopen ORDER BY BATCHNO DESC";
			$BatchQueryStatement				= mysql_query($BatchQuery);
			while($BatchQueryStatementData		= mysql_fetch_array($BatchQueryStatement)) {
				$BATCHNO						= $BatchQueryStatementData["BATCHNO"];
				$BatchVal 						.= "<option value='".$BATCHNO."'>".$BATCHNO."</option>";
			}
			$systemParametersBody = str_replace('<!--%[BATCH_NO]%-->',$BatchVal,$systemParametersBody);
			
			//Batch Select End 
			
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
		//System Expanse Entry  End
		
		//System Loan Entry Start
		function getLoanEntry($empId) {
			$systemParametersBody = $this->getTemplateContent('fnaLoan');
			
			// Project View  Start
			
			$projNameVal 				= '';
			$projQuery 				= "SELECT PROJECTID, PROJECTNAME FROM fna_project ORDER BY PROJECTNAME ASC";
			$projQueryStatement				= mysql_query($projQuery);
			while($projQueryStatementData	= mysql_fetch_array($projQueryStatement)) {
				$PROJECTID					= $projQueryStatementData["PROJECTID"];
				$PROJECTNAME				= $projQueryStatementData["PROJECTNAME"];
				$projNameVal 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$projNameVal,$systemParametersBody);
			// Project View  End
			
			// Loan View  Start
			
			$loanNameVal 				= '';
			$loanQuery 				= "SELECT LOANTYPEID, LOANTYPENAME FROM fna_loantype WHERE LOANTYPEID = 3 ORDER BY LOANTYPENAME ASC";
			$loanQueryStatement				= mysql_query($loanQuery);
			while($loanQueryStatementData	= mysql_fetch_array($loanQueryStatement)) {
				$LOANTYPEID					= $loanQueryStatementData["LOANTYPEID"];
				$LOANTYPENAME				= $loanQueryStatementData["LOANTYPENAME"];
				$loanNameVal 				.= "<option value='".$LOANTYPEID."'>".$LOANTYPENAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[LOAN_TYPE]%-->',$loanNameVal,$systemParametersBody);
			// Loan View  End
			
			// Expanse Head View  Start
			
			$ExpHeadNameVal 					= '';
			$ExpHeadQuery 						= "SELECT EXPHID, EXPHEADNAME FROM fna_expense_head ORDER BY EXPHEADNAME ASC";
			$ExpHeadQueryStatement				= mysql_query($ExpHeadQuery);
			while($ExpHeadQueryStatementData	= mysql_fetch_array($ExpHeadQueryStatement)) {
				$EXPHID							= $ExpHeadQueryStatementData["EXPHID"];
				$EXPHEADNAME					= $ExpHeadQueryStatementData["EXPHEADNAME"];
				$ExpHeadNameVal 					.= "<option value='".$EXPHID."'>".$EXPHEADNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[EXPANSE_HEAD_NAME]%-->',$ExpHeadNameVal,$systemParametersBody);
			// Expanse Head View  End
			
			$PartyNameVal 				= '';
			$PartyQuery 				= "SELECT PARTYID, PARTYNAME FROM fna_party ORDER BY PARTYNAME ASC";
			$PartyQueryStatement				= mysql_query($PartyQuery);
			while($PartyQueryStatementData	= mysql_fetch_array($PartyQueryStatement)) {
				$PartyId						= $PartyQueryStatementData["PARTYID"];
				$PartyName						= $PartyQueryStatementData["PARTYNAME"];
				$PartyNameVal 					.= "<option value='".$PartyId."'>".$PartyName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$PartyNameVal,$systemParametersBody);
			
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
		//System Loan Entry  End
		
		//System Basta Entry Start
		function getBastaEntry($empId) {
			$systemParametersBody = $this->getTemplateContent('fnaBasta');
			
			
			// Project View  Start
			
			$projNameVal 				= '';
			$projQuery 				= "SELECT PROJECTID, PROJECTNAME FROM fna_project ORDER BY PROJECTNAME ASC";
			$projQueryStatement				= mysql_query($projQuery);
			while($projQueryStatementData	= mysql_fetch_array($projQueryStatement)) {
				$PROJECTID					= $projQueryStatementData["PROJECTID"];
				$PROJECTNAME				= $projQueryStatementData["PROJECTNAME"];
				$projNameVal 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$projNameVal,$systemParametersBody);
			// Project View  End
			
			// Expanse Head View  Start
			
			$ExpHeadNameVal 					= '';
			$ExpHeadQuery 						= "SELECT EXPHID, EXPHEADNAME FROM fna_expense_head ORDER BY EXPHEADNAME ASC";
			$ExpHeadQueryStatement				= mysql_query($ExpHeadQuery);
			while($ExpHeadQueryStatementData	= mysql_fetch_array($ExpHeadQueryStatement)) {
				$EXPHID							= $ExpHeadQueryStatementData["EXPHID"];
				$EXPHEADNAME					= $ExpHeadQueryStatementData["EXPHEADNAME"];
				$ExpHeadNameVal 					.= "<option value='".$EXPHID."'>".$EXPHEADNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[EXPANSE_HEAD_NAME]%-->',$ExpHeadNameVal,$systemParametersBody);
			// Expanse Head View  End
			
			$PartyNameVal 				= '';
			$PartyQuery 				= "SELECT PARTYID, PARTYNAME FROM fna_party ORDER BY PARTYNAME ASC";
			$PartyQueryStatement				= mysql_query($PartyQuery);
			while($PartyQueryStatementData	= mysql_fetch_array($PartyQueryStatement)) {
				$PartyId						= $PartyQueryStatementData["PARTYID"];
				$PartyName						= $PartyQueryStatementData["PARTYNAME"];
				$PartyNameVal 					.= "<option value='".$PartyId."'>".$PartyName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PARTY_NAME]%-->',$PartyNameVal,$systemParametersBody);
			
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
		//System Basta Entry  End
		
		//System Food Item  Entry Start
		function getFoodItemEntry($empId) {
			$systemParametersBody = $this->getTemplateContent('feedFoodItem');
			
			
			// Project View  Start
			$projNameVal 				= '';
			$projQuery 				= "SELECT PROJECTID, PROJECTNAME FROM fna_project  WHERE PROJECTID = 2 ORDER BY PROJECTNAME ASC";
			$projQueryStatement				= mysql_query($projQuery);
			while($projQueryStatementData	= mysql_fetch_array($projQueryStatement)) {
				$PROJECTID					= $projQueryStatementData["PROJECTID"];
				$PROJECTNAME				= $projQueryStatementData["PROJECTNAME"];
				$projNameVal 				.= "<option value='".$PROJECTID."'>".$PROJECTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PROJECT_NAME]%-->',$projNameVal,$systemParametersBody);
			// Project View  End
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
		//System Food Item  Entry  End
		
		//System Parameters Setup Start 
		function getFNAOperationEntry($empId) {
			$systemParametersBody = $this->getTemplateContent('fnaEntryForm');
			
			// Labour View Start
			$ptView 		= '';
			$ptViewQuery 	= "
									SELECT
											LABOURNAME,
											FATHERNAME,
											ADDRESS,
											MOBILE
									FROM
											fna_labour 
									ORDER BY
											LABOURNAME
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
				
				$LABOURNAME   = $ptViewStatementData["LABOURNAME"];
				$FATHERNAME   = $ptViewStatementData["FATHERNAME"];
				$ADDRESS      = $ptViewStatementData["ADDRESS"];
				$MOBILE       = $ptViewStatementData["MOBILE"];
				
				$ptView .= "<tr valign='top' class='$class'>
									<td >{$sv}</td>
									<td >{$LABOURNAME}</td>
									<td >{$FATHERNAME}</td>
									<td >{$ADDRESS}</td>
									<td >{$MOBILE}</td>
									<td align='center'>
									<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' />
									</td>
								</tr>";
				
				$sv++;
			}
			$systemParametersBody = str_replace('<!--%[LABOUR_VIEW]%-->',$ptView,$systemParametersBody);
			
			//Labour View End
			
			// Party View Start
			$partyView 		= '';
			$partyViewQuery 	= "
									SELECT
											PARTYNAME,
											FATHERNAME,
											ADDRESS,
											MOBILE
									FROM
											fna_party 
									ORDER BY
											PARTYNAME
									ASC
								";
			$sv								= 1;
			$partyViewQueryStatement			= mysql_query($partyViewQuery);
			while($partyViewQueryStatementData	= mysql_fetch_array($partyViewQueryStatement)) {
				if($sv%2==0) {
					$class	= "evenRow";
				} else {
					$class	= "oddRow";
				}
				
				$PARTYNAME   = $partyViewQueryStatementData["PARTYNAME"];
				$FATHERNAME   = $partyViewQueryStatementData["FATHERNAME"];
				$ADDRESS      = $partyViewQueryStatementData["ADDRESS"];
				$MOBILE       = $partyViewQueryStatementData["MOBILE"];
				
				$partyView .= "<tr valign='top' class='$class'>
									<td >{$sv}</td>
									<td >{$PARTYNAME}</td>
									<td >{$FATHERNAME}</td>
									<td >{$ADDRESS}</td>
									<td >{$MOBILE}</td>
									<td align='center'>
									<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' />
									</td>
								</tr>";
				
				$sv++;
			}
			$systemParametersBody = str_replace('<!--%[PARTY_VIEW]%-->',$partyView,$systemParametersBody);
			
			//Party View End
			
			
			// Packing Name View  Start
			$ptView 		= '';
			$ptViewQuery 	= "
									SELECT
											PACKINGNAME
									FROM
											fna_packingname 
									ORDER BY
											PACKINGNAME
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
				
				$PACKINGNAME   = $ptViewStatementData["PACKINGNAME"];
				
				$ptView .= "<tr valign='top' class='$class'>
									<td >{$sv}</td>
									<td >{$PACKINGNAME}</td>
									<td align='center'>
									<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' />
									</td>
								</tr>";
				
				$sv++;
			}
			$systemParametersBody = str_replace('<!--%[PACKING_NAME_VIEW]%-->',$ptView,$systemParametersBody);
			
			//Packing Name View End
			
			// Quantity View  Start
			$ptView 		= '';
			$ptViewQuery 	= "
									SELECT
											QVALUE
									FROM
											fna_quantity 
									ORDER BY
											QVALUE
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
				
				$QVALUE   = $ptViewStatementData["QVALUE"];
				
				$ptView .= "<tr valign='top' class='$class'>
									<td >{$sv}</td>
									<td >{$QVALUE}</td>
									<td align='center'>
									<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' />
									</td>
								</tr>";
				
				$sv++;
			}
			$systemParametersBody = str_replace('<!--%[QUANTITY_VIEW]%-->',$ptView,$systemParametersBody);
			
			//Quantity View End
			
			// Weight View  Start
			$ptView 		= '';
			$ptViewQuery 	= "
									SELECT
											WNAME
									FROM
											fna_weight 
									ORDER BY
											WNAME
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
				
				$WNAME   = $ptViewStatementData["WNAME"];
				
				$ptView .= "<tr valign='top' class='$class'>
									<td >{$sv}</td>
									<td >{$WNAME}</td>
									<td align='center'>
									<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' />
									</td>
								</tr>";
				
				$sv++;
			}
			$systemParametersBody = str_replace('<!--%[WEIGHT_VIEW]%-->',$ptView,$systemParametersBody);
			
			//Weight View End
			
			// Chamber View  Start
			$chmView 		= '';
			$chmViewQuery 	= "
									SELECT
											CHNAME
									FROM
											fna_chamber 
									ORDER BY
											CHNAME
									ASC
								";
			$sv								= 1;
			$chmViewQueryStatement			= mysql_query($chmViewQuery);
			while($chmViewQueryStatementData	= mysql_fetch_array($chmViewQueryStatement)) {
				if($sv%2==0) {
					$class	= "evenRow";
				} else {
					$class	= "oddRow";
				}
				
				$CHNAME   = $chmViewQueryStatementData["CHNAME"];
				
				$chmView .= "<tr valign='top' class='$class'>
									<td >{$sv}</td>
									<td >{$CHNAME}</td>
									<td align='center'>
									<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' />
									</td>
								</tr>";
				
				$sv++;
			}
			$systemParametersBody = str_replace('<!--%[CHAMBER_VIEW]%-->',$chmView,$systemParametersBody);
			
			//Chamber View End
			
			// Product Cat Type View  Start
			$pctView 		= '';
			$prodCatTypViewQuery 	= "
										SELECT
												CATEGORYTYPENAME
										FROM
												fna_productcattype 
										ORDER BY
												CATEGORYTYPENAME
										ASC
									";
			$sv								= 1;
			$prodCatTypViewQueryStatement				= mysql_query($prodCatTypViewQuery);
			while($prodCatTypViewQueryStatementData		= mysql_fetch_array($prodCatTypViewQueryStatement)) {
				if($sv%2==0) {
					$class	= "evenRow";
				} else {
					$class	= "oddRow";
				}
				
				$CATEGORYTYPENAME   = $prodCatTypViewQueryStatementData["CATEGORYTYPENAME"];
				
				$pctView .= "<tr valign='top' class='$class'>
									<td >{$sv}</td>
									<td >{$CATEGORYTYPENAME}</td>
									<td align='center'>
									<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' />
									</td>
								</tr>";
				
				$sv++;
			}
			$systemParametersBody = str_replace('<!--%[PROD_CAT_TYPE_VIEW]%-->',$pctView,$systemParametersBody);
			
			//Product Cat Type View End
			
			// Product View  Start
			$prodView 		= '';
			$prodViewQuery 	= "
										SELECT
												PRODCATTYPEID, CATEGORYTYPENAME
										FROM
												fna_productcattype 
										ORDER BY
												CATEGORYTYPENAME
										ASC
									";
			$sv								= 1;
			$prodViewQueryStatement				= mysql_query($prodViewQuery);
			while($prodViewQueryStatementData		= mysql_fetch_array($prodViewQueryStatement)) {
				if($sv%2==0) {
					$class	= "evenRow";
				} else {
					$class	= "oddRow";
				}
						$PRODCATTYPEID   	= $prodViewQueryStatementData["PRODCATTYPEID"];
						$CATEGORYTYPENAME   = $prodViewQueryStatementData["CATEGORYTYPENAME"];
						$queryProduct = "
												SELECT
														PRODUCTNAME
												FROM
														fna_product 
												WHERE PRODCATTYPEID = {$PRODCATTYPEID}
											";
											
						$queryProductStatement					= mysql_query($queryProduct);
						while($queryProductStatementData		= mysql_fetch_array($queryProductStatement)) {
							$PRODUCTNAME   = $queryProductStatementData["PRODUCTNAME"];
							
						
						$prodView .= "<tr valign='top' class='$class'>
											<td >{$sv}</td>
											<td >{$CATEGORYTYPENAME}</td>
											<td >{$PRODUCTNAME}</td>
											<td align='center'>
											<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' />
											</td>
										</tr>";
						
						$sv++;
					}
			}
			$systemParametersBody = str_replace('<!--%[PROD_VIEW]%-->',$prodView,$systemParametersBody);
			
			//Product View End
			
					
			// Product View  Start
			
			$prodNameVal 				= '';
			$prodQuery 				= "SELECT PRODCATTYPEID, CATEGORYTYPENAME FROM fna_productcattype ORDER BY CATEGORYTYPENAME ASC";
			$prodQueryStatement				= mysql_query($prodQuery);
			while($prodQueryStatementData	= mysql_fetch_array($prodQueryStatement)) {
				$productCatTypeId				= $prodQueryStatementData["PRODCATTYPEID"];
				$catName						= $prodQueryStatementData["CATEGORYTYPENAME"];
				$prodNameVal 					.= "<option value='".$productCatTypeId."'>".$catName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT_NAME]%-->',$prodNameVal,$systemParametersBody);
			
			
			//Labour Name View
			$labourNameVal 				= '';
			$labourQuery 				= "SELECT LABOURID, LABOURNAME FROM fna_labour ORDER BY LABOURNAME ASC";
			$labourQueryStatement				= mysql_query($labourQuery);
			while($labourQueryStatementData	= mysql_fetch_array($labourQueryStatement)) {
				$labourId						= $labourQueryStatementData["LABOURID"];
				$labourName						= $labourQueryStatementData["LABOURNAME"];
				$labourNameVal 					.= "<option value='".$labourId."'>".$labourName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[LABOUR_NAME]%-->',$labourNameVal,$systemParametersBody);
			
			$chamberFromVal							= '';
			$chamberFromQuery 						= "SELECT CHID, CHNAME FROM fna_chamber ORDER BY CHNAME ASC";
			$chamberFromQueryStatement				= mysql_query($chamberFromQuery);
			while($chamberFromQueryStatementData	= mysql_fetch_array($chamberFromQueryStatement)) {
				$chamberId							= $chamberFromQueryStatementData["CHID"];
				$chamberName						= $chamberFromQueryStatementData["CHNAME"];
				$chamberFromVal 					.= "<option value='".$chamberId."'>".$chamberName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[CHAMBER_FROM]%-->',$chamberFromVal,$systemParametersBody);
			
			$prodCatTypeVal						= '';
			$prodCatQuery 						= "SELECT PRODCATTYPEID,PRODUCTNAME FROM fna_product ORDER BY PRODUCTNAME ASC";
			$prodCatQueryStatement				= mysql_query($prodCatQuery);
			while($prodCatQueryStatementData	= mysql_fetch_array($prodCatQueryStatement)) {
				$PRODCATTYPEID					= $prodCatQueryStatementData["PRODCATTYPEID"];
				$PRODUCTNAME					= $prodCatQueryStatementData["PRODUCTNAME"];
				$prodCatTypeVal					.= "<option value='".$PRODCATTYPEID."'>".$PRODUCTNAME."</option>";
			}
			$systemParametersBody = str_replace('<!--%[PRODUCT]%-->',$prodCatTypeVal,$systemParametersBody);
			
			$QuantityVal 						= '';
			$quantityQuery 						= "SELECT QID,QVALUE FROM fna_quantity ORDER BY QVALUE ASC";
			$quantityQueryStatement				= mysql_query($quantityQuery);
			while($quantityQueryStatementData	= mysql_fetch_array($quantityQueryStatement)) {
				$qId							= $quantityQueryStatementData["QID"];
				$qValue							= $quantityQueryStatementData["QVALUE"];
				$QuantityVal 					.= "<option value='".$qId."'>".$qValue."</option>";
			}
			$systemParametersBody = str_replace('<!--%[QUANTITY]%-->',$QuantityVal,$systemParametersBody);
			
			$weightTypeVal 							= '';
			$weightTypeQuery 						= "SELECT WTID,WNAME FROM fna_weight ORDER BY WNAME ASC";
			$weightTypeQueryStatement				= mysql_query($weightTypeQuery);
			while($weightTypeQueryStatementData		= mysql_fetch_array($weightTypeQueryStatement)) {
				$wtId								= $weightTypeQueryStatementData["WTID"];
				$wtName								= $weightTypeQueryStatementData["WNAME"];
				$weightTypeVal 						.= "<option value='".$wtId."'>".$wtName."</option>";
			}
			$systemParametersBody = str_replace('<!--%[WEIGHTTYPE]%-->',$weightTypeVal,$systemParametersBody);
			
			
			//Product View End
			
			
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