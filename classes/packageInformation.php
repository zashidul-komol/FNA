    <table width="85%" border="0" cellspacing="1" cellpadding="10" style="margin:0px auto 0px auto;">
        <tr>
            <td colspan="2" align="center"><h4>File Management for Package Initialization</h4></td>
        </tr>
        <tr>
            <td colspan="2" align="center"><!--%[MSG]%--></td>
        </tr>
        <tr valign="top">
            <td width="50%" align="left">
                <table width="100%"  border="0" cellspacing="0" cellpadding="0" align="center">
                   <!-- <tr valign="top">
                        <td align="left">
							<script type="text/javascript">
                            function confirmServiceSubmit() {
								if(!confirm('Are you sure, you want to proceed?')){
									return false;
								}
								return true;
                            }
                            </script>

                            <fieldset>
                                <legend style="color:#2C89B5; cursor:pointer;" onClick="return ShowHide('showService')">Enter Service Main</legend>
                                <div id="showService" style="display:none;">
                                    <form name="ServiceForm" method="post" action="ProjectFileManagement.php" onSubmit="return confirmServiceSubmit();">
                                        <table width="96%" border="0" cellpadding="3" cellspacing="0">
                                            <tr valign="top">
                                                <td width="30%" height="26" align="right">
                                                    Service Name
                                                </td>
                                                <td height="26" align="left">
                                                    <input type="text" id="service" name="service" autocomplete="off" required="" autofocus="" placeholder="Service Name" class="FormTextTypeInput">
                                                    <sup style="color:red;">*</sup>
                                                </td>
                                            </tr>
                                            <tr valign="top">
                                                <td width="30%" height="26" align="right">
                                                    Order No.
                                                </td>
                                                <td height="26" align="left">
                                                    <input type="text" id="serviceOrder" name="serviceOrder" autocomplete="off" required="" autofocus="" placeholder="Order" class="FormTextTypeInput" onkeyup="removeChar(this)">
                                                    <sup style="color:red;">*</sup>
                                                </td>
                                            </tr>
                                            <tr valign="top">
                                                <td height="26" align="right">
                                                    Description
                                                </td>
                                                <td height="26" align="left">
                                                    <input type="text" id="serviceDescription" name="serviceDescription" autocomplete="off" placeholder="Description" class="FormTextTypeInput">                             
                                                </td>
                                            </tr>
                                            <tr valign="top">
                                                <td height="26" align="right">&nbsp;</td>
                                                <td height="26" align="left">
                                                    <input type="submit" name="InsertService" value="Insert" class="FormSubmitBtn"/>
                                                    <input type="reset"  name="Reset" value="Reset" class="FormResetBtn">
                                                    <input type="button" name="btnClose" value="Close" onClick="return ShowHide('showService')">
                                                </td>
                                            </tr>
                                        </table>
                                    </form>	
                                </div>
                            </fieldset>
                        </td>
                    </tr>
                    <tr valign="top">
                        <td align="left">
							<script type="text/javascript">
								function confirmModuleSubmit() {
									if(!confirm('Are you sure, you want to proceed?')){
										return false;
									}
									return true;
								}
                            </script>
                            <fieldset>
                                <legend style="color:#2C89B5; cursor:pointer;" onClick="return ShowHide('showModule')">Enter Module Main</legend>
                                <div id="showModule" style="display:none;">
                                    <form name="moduleForm" method="post" action="ProjectFileManagement.php" onSubmit="return confirmModuleSubmit();">
                                        <table width="96%" border="0" cellpadding="3" cellspacing="0">
                                            <tr valign="top">
                                                <td width="30%" align="right">
                                                    Service
                                                </td>
                                                <td height="26" align="left">
                                                    <select name="serviceModule" id="serviceModule" class="FormSelectTypeInput" required="" autofocus="">
                                                        <option value="">Select</option>
                                                        <!--%[MODULE_SERVICE]%-->
                                                    </select>
                                                     <sup style="color:red;">*</sup>
                                                </td>
                                            </tr>
                                            <tr valign="top">
                                                <td align="right">
                                                    Module Name
                                                </td>
                                                <td height="26" align="left">
                                                    <input type="text" id="moduleName" name="moduleName" autocomplete="off" required="" autofocus="" placeholder="Module Name" class="FormTextTypeInput">
                                                    <sup style="color:red;">*</sup>
                                                </td>
                                            </tr>
                                            <tr valign="top">
                                                <td width="30%" height="26" align="right">
                                                    Order No.
                                                </td>
                                                <td height="26" align="left">
                                                    <input type="text" id="modOrder" name="modOrder" autocomplete="off" required="" autofocus="" placeholder="Order" class="FormTextTypeInput" onkeyup="removeChar(this)">
                                                    <sup style="color:red;">*</sup>
                                                </td>
                                            </tr>							
                                            <tr valign="top">
                                                <td height="26" align="right">
                                                    Description
                                                </td>
                                                <td height="26" align="left">
                                                    <input type="text" id="moduleDescription" name="moduleDescription" autocomplete="off" placeholder="Description" class="FormTextTypeInput">
                                                </td>
                                            </tr>
                                            <tr valign="top">
                                                <td height="26" align="right">&nbsp;</td>
                                                <td height="26" align="left">
                                                    <input type="submit" name="InsertModule" value="Insert" class="FormSubmitBtn" />
                                                    <input type="reset"  name="Reset" value="Reset" class="FormResetBtn">
                                                    <input name="btnClose" type="button" value="Close" onClick="return ShowHide('showModule')">
                                                </td>
                                            </tr>
                                        </table>	
                                    </form>
                                </div>
                            </fieldset>
                        </td>
                    </tr>
                    <tr valign="top">
                        <td align="left">
							<script  type="text/javascript">
								function confirmSubModuleSubmit() {
									if(!confirm('Are you sure, you want to proceed?')){
										return false;
									}
									return true;
								}
								
								$(document).ready(function() {
									$("select#serviceSubModule").change(function(){
										var options = '';
										if($(this).val() == '') {
											options = '<option value="">No Module Found</option>';
											$("select#subModuleModule").html('');
											$("select#subModuleModule").html(options);
											return false;
										}
										$.getJSON("ajax/getModuleMain.php",{service_id: $(this).val()}, function(j) {
											if(j.length>0) {
												options += '<option value="">Select</option>';
												for (var i = 0; i < j.length; i++) {
													options += '<option value="' + j[i].optionValue + '">' + j[i].optionDisplay + '</option>';
												}
												$("select#subModuleModule").html('');
												$("select#subModuleModule").html(options);
											}
											else {
												options = '<option value="">No Module Found</option>';
												$("select#subModuleModule").html('');
												$("select#subModuleModule").html(options);
											}
										})
									})
								});
                            </script>
                            <fieldset>
                                <legend style="color:#2C89B5; cursor:pointer;"  onClick="return ShowHide('showSubModule')">Enter Sub Module Main</legend>
                                <div id="showSubModule" style="display:none;">
                                  <form name="SubModuleForm" method="post" action="ProjectFileManagement.php" onsubmit="return confirmSubModuleSubmit();">
                                        <table width="96%" border="0" cellpadding="3" cellspacing="0">
                                            <tr valign="top">
                                                <td width="30%" align="right">
                                                    Service
                                                </td>
                                                <td align="left">
                                                    <select name="serviceSubModule" id="serviceSubModule" class="FormSelectTypeInput" required="" autofocus="">
                                                        <option value="">Select</option>
                                                        <!--%[SUBMODULE_SERVICE]%-->
                                                    </select>
                                                    <sup style="color:red;">*</sup>
                                                </td>
                                            </tr>
                                            <tr valign="top">
                                                <td width="30%" align="right">
                                                    Module
                                                </td>
                                                <td align="left">
                                                    <select name="subModuleModule" id="subModuleModule" class="FormSelectTypeInput" required="" autofocus="">
                                                        <option value="">Select</option>
                                                    </select>
                                                    <sup style="color:red;">*</sup>
                                                </td>
                                            </tr>
                                            <tr valign="top">
                                                <td align="right">
                                                    Sub Module
                                                </td>
                                                <td align="left">
                                                    <input type="text" id="subModule" name="subModule" autocomplete="off" required="" autofocus="" placeholder="Sub Module Name" class="FormTextTypeInput">
                                                    <sup style="color:red;">*</sup>
                                                </td>
                                            </tr>
                                            <tr valign="top">
                                                <td align="right">
                                                    Default File
                                                </td>
                                                <td align="left">
                                                    <input type="text" id="defaultFile" name="defaultFile" autocomplete="off" required="" autofocus="" placeholder="Default File" class="FormTextTypeInput">
                                                    <sup style="color:red;">*</sup>
                                                </td>
                                            </tr>
                                            <tr valign="top">
                                                <td width="30%" height="26" align="right">
                                                    Order
                                                </td>
                                                <td height="26" align="left">
                                                    <input type="text" id="subModOrder" name="subModOrder" autocomplete="off" required="" autofocus="" placeholder="Order" class="FormTextTypeInput" onkeyup="removeChar(this)">
                                                    <sup style="color:red;">*</sup>
                                                </td>
                                            </tr>
                                            <tr valign="top">
                                                <td height="26" align="right">
                                                    Description
                                                </td>
                                                <td height="26" align="left">
                                                    <input type="text" id="subModuleDescription" name="subModuleDescription" autocomplete="off" placeholder="Description" class="FormTextTypeInput">
                                                </td>
                                            </tr>
                                            <tr valign="top">
                                                <td height="26" align="right">&nbsp;</td>
                                                <td height="26" align="left">
                                                    <input type="submit" name="InsertSubModule" value="Insert" class="FormSubmitBtn" />
                                                    <input type="reset"  name="Reset" value="Reset" class="FormResetBtn">
                                                    <input name="btnClose" type="button" value="Close" onClick="return ShowHide('showSubModule')">
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                              </div>
                          </fieldset>
                        </td>
                    </tr>-->
                    <!--  Start Procurement Type -->
                    <tr valign="top">
                        <td align="left">
							<script  type="text/javascript">
								function confirmProcurementTypeSubmit() {
									if($("#ptName").val() == ''){
											alert("Please enter procurement type");
											$("#ptName").focus();
											return false;
									}
									if(!confirm('Are you sure, you want to proceed?')){
										return false;
									}
									return true;
								}
                            </script>
                            <fieldset>
                                <legend style="color:#2C89B5; cursor:pointer;"  onClick="return ShowHide('showProcurementType')">Enter Procurement Type</legend>
                                <div id="showProcurementType" style="display:none;">
                                  <form name="procurementTypeForm" method="post" action="ProjectFileManagement.php" onsubmit="return confirmProcurementTypeSubmit();">
                                        <table width="96%" border="0" cellpadding="3" cellspacing="0">
                                            <tr valign="top">
                                                <td height="26" align="right">
                                                    Procurement Type :
                                                </td>
                                                <td height="26" align="left">
                                                    <input type="text" id="ptName" name="ptName" autocomplete="off" placeholder="Procurement Type" class="FormTextTypeInput" />
                                                </td>
                                            </tr>
                                            <tr valign="top">
                                                <td height="26" align="right">
                                                    Description :
                                                </td>
                                                <td height="26" align="left">
                                                    <textarea name="ptDescription" id="ptDescription" autocomplete="off" class="FormTextAreaTypeInput"> </textarea>
                                                </td>
                                            </tr>
                                            <tr valign="top">
                                                <td height="26" align="right">&nbsp;</td>
                                                <td height="26" align="left">
                                                    <input type="submit" name="InsertProcurementType" value="Insert" class="FormSubmitBtn" />
                                                    <input type="reset"  name="Reset" value="Reset" class="FormResetBtn">
                                                    <input name="btnClose" type="button" value="Close" onClick="return ShowHide('showProcurementType')">
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                              </div>
                          </fieldset>
                        </td>
                    </tr>
                    <!--  End Procurement Type  -->
                    
                    <!--  Start Procurement Method -->
                    <tr valign="top">
                        <td align="left">
							<script  type="text/javascript">
								function confirmProcurementMethodSubmit() {
									if($("#pmName").val() == ''){
											alert("Please enter procurement Method");
											$("#pmName").focus();
											return false;
									}
									if(!confirm('Are you sure, you want to proceed?')){
										return false;
									}
									return true;
								}
                            </script>
                            <fieldset>
                                <legend style="color:#2C89B5; cursor:pointer;"  onClick="return ShowHide('showProcurementMethod')">Enter Procurement Method</legend>
                                <div id="showProcurementMethod" style="display:none;">
                                  <form name="procurementMethodForm" method="post" action="ProjectFileManagement.php" onsubmit="return confirmProcurementMethodSubmit();">
                                        <table width="96%" border="0" cellpadding="3" cellspacing="0">
                                            <tr valign="top">
                                                <td height="26" align="right">
                                                    Procurement Method :
                                                </td>
                                                <td height="26" align="left">
                                                    <input type="text" id="pmName" name="pmName" autocomplete="off" placeholder="Procurement Method" class="FormTextTypeInput" />
                                                </td>
                                            </tr>
                                            <tr valign="top">
                                                <td height="26" align="right">
                                                    Description :
                                                </td>
                                                <td height="26" align="left">
                                                    <textarea name="pmDescription" id="pmDescription" autocomplete="off" class="FormTextAreaTypeInput"> </textarea>
                                                </td>
                                            </tr>
                                            <tr valign="top">
                                                <td height="26" align="right">&nbsp;</td>
                                                <td height="26" align="left">
                                                    <input type="submit" name="InsertProcurementMethod" value="Insert" class="FormSubmitBtn" />
                                                    <input type="reset"  name="Reset" value="Reset" class="FormResetBtn">
                                                    <input name="btnClose" type="button" value="Close" onClick="return ShowHide('showProcurementMethod')">
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                              </div>
                          </fieldset>
                        </td>
                    </tr>
                    <!--  End Procurement Method  -->
                    
                    <!--  Start Bidding Procedure -->
                    <tr valign="top">
                        <td align="left">
							<script  type="text/javascript">
								function confirmBiddingProcedureSubmit() {
									if($("#bpName").val() == ''){
											alert("Please enter Bidding Procedure");
											$("#bpName").focus();
											return false;
									}
									if(!confirm('Are you sure, you want to proceed?')){
										return false;
									}
									return true;
								}
                            </script>
                            <fieldset>
                                <legend style="color:#2C89B5; cursor:pointer;"  onClick="return ShowHide('showBiddingProcedure')">Enter Bidding Procedure</legend>
                                <div id="showBiddingProcedure" style="display:none;">
                                  <form name="biddingProcedureForm" method="post" action="ProjectFileManagement.php" onsubmit="return confirmBiddingProcedureSubmit();">
                                        <table width="96%" border="0" cellpadding="3" cellspacing="0">
                                            <tr valign="top">
                                                <td height="26" align="right">
                                                    Bidding Procedure :
                                                </td>
                                                <td height="26" align="left">
                                                    <input type="text" id="bpName" name="bpName" autocomplete="off" placeholder="Bidding Procedure" class="FormTextTypeInput" />
                                                </td>
                                            </tr>
                                            <tr valign="top">
                                                <td height="26" align="right">
                                                    Description :
                                                </td>
                                                <td height="26" align="left">
                                                    <textarea name="bpDescription" id="bpDescription" autocomplete="off" class="FormTextAreaTypeInput"> </textarea>
                                                </td>
                                            </tr>
                                            <tr valign="top">
                                                <td height="26" align="right">&nbsp;</td>
                                                <td height="26" align="left">
                                                    <input type="submit" name="InsertBiddingProcedure" value="Insert" class="FormSubmitBtn" />
                                                    <input type="reset"  name="Reset" value="Reset" class="FormResetBtn">
                                                    <input name="btnClose" type="button" value="Close" onClick="return ShowHide('showBiddingProcedure')">
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                              </div>
                          </fieldset>
                        </td>
                    </tr>
                    <!--  End Bidding Procedure  -->
                    
                    <!--  Start Input Tab Head -->
                    <tr valign="top">
                        <td align="left">
							<script  type="text/javascript">
								function confirmInputTabHeadSubmit() {
									if($("#ithName").val() == ''){
											alert("Please enter Input Tab Head Name");
											$("#ithName").focus();
											return false;
									}
									if(!confirm('Are you sure, you want to proceed?')){
										return false;
									}
									return true;
								}
                            </script>
                            <fieldset>
                                <legend style="color:#2C89B5; cursor:pointer;"  onClick="return ShowHide('showInputTabHead')">Enter Input Tab Head Name</legend>
                                <div id="showInputTabHead" style="display:none;">
                                  <form name="inputTabHeadForm" method="post" action="ProjectFileManagement.php" onsubmit="return confirmInputTabHeadSubmit();">
                                        <table width="96%" border="0" cellpadding="3" cellspacing="0">
                                            <tr valign="top">
                                                <td height="26" align="right">
                                                    Input Tab Head :
                                                </td>
                                                <td height="26" align="left">
                                                    <input type="text" id="ithName" name="ithName" autocomplete="off" placeholder="Input Tab Head Name" class="FormTextTypeInput" />
                                                </td>
                                            </tr>
                                            <tr valign="top">
                                                <td height="26" align="right">
                                                    Description :
                                                </td>
                                                <td height="26" align="left">
                                                    <textarea name="ithDescription" id="ithDescription" autocomplete="off" class="FormTextAreaTypeInput"> </textarea>
                                                </td>
                                            </tr>
                                            <tr valign="top">
                                                <td height="26" align="right">&nbsp;</td>
                                                <td height="26" align="left">
                                                    <input type="submit" name="InsertInputTabHead" value="Insert" class="FormSubmitBtn" />
                                                    <input type="reset"  name="Reset" value="Reset" class="FormResetBtn">
                                                    <input name="btnClose" type="button" value="Close" onClick="return ShowHide('showInputTabHead')">
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                              </div>
                          </fieldset>
                        </td>
                    </tr>
                    <!--  End Input Tab Head -->
                    
                    <!--  Start Input Tab Fields -->
                    <tr valign="top">
                        <td align="left">
							<script  type="text/javascript">
								function confirmInputTabFieldsSubmit() {
									if($("#itfName").val() == ''){
											alert("Please enter Input Tab Fields Name");
											$("#itfName").focus();
											return false;
									}
									if(!confirm('Are you sure, you want to proceed?')){
										return false;
									}
									return true;
								}
                            </script>
                            <fieldset>
                                <legend style="color:#2C89B5; cursor:pointer;"  onClick="return ShowHide('showInputTabFields')">Enter Input Tab Fields Name</legend>
                                <div id="showInputTabFields" style="display:none;">
                                  <form name="inputTabFieldsForm" method="post" action="ProjectFileManagement.php" onsubmit="return confirmInputTabFieldsSubmit();">
                                        <table width="96%" border="0" cellpadding="3" cellspacing="0">
                                            <tr valign="top">
                                                <td height="26" align="right">
                                                    Input Tab Head :
                                                </td>
                                                <td height="26" align="left">
                                                <select name="itfhId" id="itfhId"  class="FormSelectTypeInput" required="" autofocus="">
												<option value="">Select Head</option>
												<!--%[INPUT_TAB_HEAD_LIST]%-->
												</select>
                            <sup style="color:red;">*</sup>
                                                </td>
                                            </tr>
                                            <tr valign="top">
                                                <td height="26" align="right">
                                                    Input Tab Fields :
                                                </td>
                                                <td height="26" align="left">
                                                    <input type="text" id="itfName" name="itfName" autocomplete="off" placeholder="Input Tab Fields Name" class="FormTextTypeInput" />
                                                </td>
                                            </tr>
                                            <tr valign="top">
                                                <td height="26" align="right">
                                                    Fields Nature:
                                                </td>
                                                <td height="26" align="left">
                                                <select name="itfNature" id="itfNature"  class="FormSelectTypeInput" required="" autofocus="">
												<option value="">Select Nature</option>
												<option value="text">Text</option>
                                                <option value="textarea">Textarea</option>
												</select>
                            					<sup style="color:red;">*</sup>
                                                </td>
                                            </tr>
                                            <tr valign="top">
                                                <td height="26" align="right">&nbsp;</td>
                                                <td height="26" align="left">
                                                    <input type="submit" name="InsertInputTabFields" value="Insert" class="FormSubmitBtn" />
                                                    <input type="reset"  name="Reset" value="Reset" class="FormResetBtn">
                                                    <input name="btnClose" type="button" value="Close" onClick="return ShowHide('showInputTabFields')">
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                              </div>
                          </fieldset>
                        </td>
                    </tr>
                    <!--  End Input Tab Field -->
                    
                    <!--  Start Project Form -->
                  <!--  <tr valign="top">
                        <td align="left">
							<script  type="text/javascript">
								function confirmProjectSubmit() {
									if($("#pName").val() == ''){
											alert("Please enter Project Name");
											$("#pName").focus();
											return false;
									}
									if(!confirm('Are you sure, you want to proceed?')){
										return false;
									}
									return true;
								}
                            </script>
                            <fieldset>
                                <legend style="color:#2C89B5; cursor:pointer;"  onClick="return ShowHide('showProject')">Enter Package Name</legend>
                                <div id="showProject" style="display:none;">
                                  <form name="ProjectForm" method="post" action="ProjectFileManagement.php" onsubmit="return confirmProjectSubmit();">
                                        <table width="96%" border="0" cellpadding="3" cellspacing="0">
                                            <tr valign="top">
                                                <td height="26" align="right">
                                                    Procurement Type :
                                                </td>
                                                <td height="26" align="left">
                                                <select name="pProcurementType" id="pProcurementType"  class="FormSelectTypeInput" required="" autofocus="">
												<option value="">Select Procurement Type</option>
												<!--%[PROJECT_PROCUREMENT_TYPE_LIST]%-->
												</select>
                         					    <sup style="color:red;">*</sup>
                                                </td>
                                            </tr>
                                             <tr valign="top">
                                                <td height="26" align="right">
                                                    Procurement Method :
                                                </td>
                                                <td height="26" align="left">
                                                <select name="pProcurementMethod" id="pProcurementMethod"  class="FormSelectTypeInput" required="" autofocus="">
												<option value="">Select Procurement Method</option>
												<!--%[PROJECT_PROCUREMENT_MATHOD_LIST]%-->
												</select>
                            					<sup style="color:red;">*</sup>
                                                </td>
                                            </tr>
                                             <tr valign="top">
                                                <td height="26" align="right">
                                                    Bidding Procedure :
                                                </td>
                                                <td height="26" align="left">
                                                <select name="pBiddingProcedure" id="pBiddingProcedure"  class="FormSelectTypeInput" required="" autofocus="">
												<option value="">Select Bidding Procedure</option>
												<!--%[PROJECT_BIDDING_PROCEDURE_LIST]%-->
												</select>
                            					<sup style="color:red;">*</sup>
                                                </td>
                                            </tr>
                                            <tr valign="top">
                                                <td height="26" align="right">&nbsp;</td>
                                                <td height="26" align="left">
                                                    <input type="submit" name="InsertProject" value="Insert" class="FormSubmitBtn" />
                                                    <input type="reset"  name="Reset" value="Reset" class="FormResetBtn">
                                                    <input name="btnClose" type="button" value="Close" onClick="return ShowHide('showProject')">
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                              </div>
                          </fieldset>
                        </td>
                    </tr>-->
                    <!--  End Project Form -->
                    
                    <!--  Start Project Fields Form -->
                   <!-- <tr valign="top">
                        <td align="left">
							<script  type="text/javascript">
								function confirmProjectFieldsSubmit() {
									if($("#pfName").val() == ''){
											alert("Please enter Project Fields Name");
											$("#pfName").focus();
											return false;
									}
									if(!confirm('Are you sure, you want to proceed?')){
										return false;
									}
									return true;
								}
                            </script>
                            <fieldset>
                                <legend style="color:#2C89B5; cursor:pointer;"  onClick="return ShowHide('showProjectFields')">Enter Project Fields Name</legend>
                                <div id="showProjectFields" style="display:none;">
                                  <form name="ProjectFieldsForm" method="post" action="ProjectFileManagement.php" onsubmit="return confirmProjectFieldsSubmit();">
                                        <table width="96%" border="0" cellpadding="3" cellspacing="0">
                                            <tr valign="top">
                                                <td height="26" align="right">
                                                    Project Name :
                                                </td>
                                                <td height="26" align="left">
                                                <select name="pfProjectName" id="pfProjectName"  class="FormSelectTypeInput" required="" autofocus="">
												<option value="">Select Project Name</option>
												<!--%[PROJECT_PROCUREMENT_TYPE_LIST]%-->
												</select>
                         					    <sup style="color:red;">*</sup>
                                                </td>
                                            </tr>
                                             <tr valign="top">
                                                <td height="26" align="right">
                                                    Input Tabs Fields :
                                                </td>
                                                <td height="26" align="left">
                                                <select name="pfInputTabsFields" id="pfInputTabsFields"  class="FormSelectTypeInput" required="" autofocus="">
												<option value="">Select Input Tabs Fields</option>
												<!--%[PROJECT_PROCUREMENT_MATHOD_LIST]%-->
												</select>
                            					<sup style="color:red;">*</sup>
                                                </td>
                                            </tr>
                                            
                                            <tr valign="top">
                                                <td height="26" align="right">&nbsp;</td>
                                                <td height="26" align="left">
                                                    <input type="submit" name="InsertProjectFields" value="Insert" class="FormSubmitBtn" />
                                                    <input type="reset"  name="Reset" value="Reset" class="FormResetBtn">
                                                    <input name="btnClose" type="button" value="Close" onClick="return ShowHide('showProjectFields')">
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                              </div>
                          </fieldset>
                        </td>
                    </tr>-->
                    <!--  End Project Form -->
                    
                    
                </table>
                
            </td>
            <td width="50%" align="right">
                <table border="0" align="center" cellpadding="0" cellspacing="0" width="100%">
                    <!--<tr valign="top">
                        <td align="left">
                            <fieldset>
                                <legend style="color:#2C89B5; cursor:pointer;" onclick="return ShowHide('viewService')">View Services Main</legend>
                                <div id="viewService" style="display:none;height:200px;overflow:auto;">
                                <table class="tablesorter" border="0" width="100%" align="left" cellspacing="1" cellpadding="3" style="font-size:75%;">
                                    <thead>
                                        <tr valign="top" style="font-weight:bold; text-align:center; background:#E8E1E1;">
                                            <th style="width:30%;">Services</th>
                                            <th style="width:40%;">Description</th>
                                            <th style="width:10%;">Order</th>
                                            <th style="width:20%;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!--%[SERVICE_VIEW]%-->
                                   <!-- </tbody>
                                </table>
                                </div>
                            </fieldset>
                        </td>
                    </tr>
                    <tr valign="top">
                        <td align="left">
                            <fieldset>
                                <legend style="color:#2C89B5; cursor:pointer;"  onclick="return ShowHide('viewModule')">View Modules Main</legend>
                                <div id="viewModule" style="display:none;height:200px;overflow:auto;">
                                    <!--%[MODULE_VIEW]%-->
                                </div>
                            </fieldset>
                      <!--  </td>
                    </tr>
                    <tr valign="top">
                        <td align="left">
                            <fieldset>
                                <legend style="color:#2C89B5; cursor:pointer;" onclick="return ShowHide('viewSubModule')">View Sub Modules Main</legend>
                                <div id="viewSubModule" style="display:none;height:250px;overflow:auto;">
                                    <!--%[SUB_MODULE_VIEW]%-->
                                </div>
                            </fieldset>
                    <!--    </td>
                    </tr>-->
                    
                    <!-- View Procurement Type Start -->
                    <tr valign="top">
                        <td align="left">
                            <fieldset>
                                <legend style="color:#2C89B5; cursor:pointer;" onclick="return ShowHide('viewProcurementType')">View Procurement Type</legend>
                                <div id="viewProcurementType" style="display:none;height:200px;overflow:auto;">
                                <table class="tablesorter" border="0" width="100%" align="left" cellspacing="1" cellpadding="3" style="font-size:75%;">
                                    <thead>
                                        <tr valign="top" style="font-weight:bold; text-align:center; background:#E8E1E1;">
                                            <th style="width:10%;">SL#</th>
                                            <th style="width:40%;">Procurement Type</th>
                                            <th style="width:40%;">Description</th>
                                            <th style="width:10%;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!--%[PROCUREMENT_TYPE_VIEW]%-->
                                    </tbody>
                                </table>
                                </div>
                            </fieldset>
                        </td>
                    </tr>
                    <!-- View Procurement Type End -->
                    
                    <!-- View Procurement Method Start -->
                    <tr valign="top">
                        <td align="left">
                            <fieldset>
                                <legend style="color:#2C89B5; cursor:pointer;" onclick="return ShowHide('viewProcurementMethod')">View Procurement Method</legend>
                                <div id="viewProcurementMethod" style="display:none;height:200px;overflow:auto;">
                                <table class="tablesorter" border="0" width="100%" align="left" cellspacing="1" cellpadding="3" style="font-size:75%;">
                                    <thead>
                                        <tr valign="top" style="font-weight:bold; text-align:center; background:#E8E1E1;">
                                            <th style="width:10%;">SL#</th>
                                            <th style="width:40%;">Procurement Method</th>
                                            <th style="width:40%;">Description</th>
                                            <th style="width:10%;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!--%[PROCUREMENT_METHOD_VIEW]%-->
                                    </tbody>
                                </table>
                                </div>
                            </fieldset>
                        </td>
                    </tr>
                    <!-- View Procurement Method End -->
                    
                    <!-- View Bidding Procedure Start -->
                    <tr valign="top">
                        <td align="left">
                            <fieldset>
                                <legend style="color:#2C89B5; cursor:pointer;" onclick="return ShowHide('viewBiddingProcedure')">View Bidding Procedure</legend>
                                <div id="viewBiddingProcedure" style="display:none;height:200px;overflow:auto;">
                                <table class="tablesorter" border="0" width="100%" align="left" cellspacing="1" cellpadding="3" style="font-size:75%;">
                                    <thead>
                                        <tr valign="top" style="font-weight:bold; text-align:center; background:#E8E1E1;">
                                            <th style="width:10%;">SL#</th>
                                            <th style="width:40%;">Bidding Procedure</th>
                                            <th style="width:40%;">Description</th>
                                            <th style="width:10%;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!--%[Bidding_Procedure_VIEW]%-->
                                    </tbody>
                                </table>
                                </div>
                            </fieldset>
                        </td>
                    </tr>
                    <!-- View Bidding Procedure End -->
                    
                    <!-- View Input Tab Head Start -->
                    <tr valign="top">
                        <td align="left">
                            <fieldset>
                                <legend style="color:#2C89B5; cursor:pointer;" onclick="return ShowHide('viewInputTabHead')">View Input Tab Head</legend>
                                <div id="viewInputTabHead" style="display:none;height:200px;overflow:auto;">
                                <table class="tablesorter" border="0" width="100%" align="left" cellspacing="1" cellpadding="3" style="font-size:75%;">
                                    <thead>
                                        <tr valign="top" style="font-weight:bold; text-align:center; background:#E8E1E1;">
                                            <th style="width:10%;">SL#</th>
                                            <th style="width:40%;">Input Tab Head</th>
                                            <th style="width:40%;">Description</th>
                                            <th style="width:10%;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <!--%[Input_Tab_Head_VIEW]%-->
                                    </tbody>
                                </table>
                                </div>
                            </fieldset>
                        </td>
                    </tr>
                    <!-- View Input Tab Head End -->
                    
                    <!-- View Input Tab Fields Start -->
                    <tr valign="top">
                        <td align="left">
                            <fieldset>

                                <legend style="color:#2C89B5; cursor:pointer;" onclick="return ShowHide('viewInputTabFields')">View Input Tab Fields</legend>
                                <div id="viewInputTabFields" style="display:none;height:200px;overflow:auto;">
                                <table class="tablesorter" border="0" width="100%" align="left" cellspacing="1" cellpadding="3" style="font-size:75%;">
                                    <thead>
                                        <tr valign="top" style="font-weight:bold; text-align:center; background:#E8E1E1;">
                                            <th style="width:10%;">SL#</th>
                                            <th style="width:40%;">Input Tab Head</th>
                                            <th style="width:40%;">Fields</th>
                                            <th style="width:10%;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <!--%[Input_Tab_Fields_VIEW]%-->
                                    </tbody>
                                </table>
                                </div>
                            </fieldset>
                        </td>
                    </tr>
                    <!-- View Input Tab Fields End -->
                    
                    <!-- Project Start -->
                  <!--  <tr valign="top">
                        <td align="left">
                            <fieldset>
                                <legend style="color:#2C89B5; cursor:pointer;" onclick="return ShowHide('viewProject')">View Package Name</legend>
                                <div id="viewProject" style="display:none;height:200px;overflow:auto;">
                                <table class="tablesorter" border="0" width="100%" align="left" cellspacing="1" cellpadding="3" style="font-size:75%;">
                                    <thead>
                                        <tr valign="top" style="font-weight:bold; text-align:center; background:#E8E1E1;">
                                            <th style="width:10%;">SL#</th>
                                            <th style="width:20%;">Procurement Type</th>
                                            <th style="width:20%;">Procurement Method</th>
                                            <th style="width:20%;">Bidding Procedure</th>
                                            <th style="width:20%;">Package</th>
                                            <th style="width:10%;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <!--%[PROJECT_VIEW]%-->
                                    </tbody>
                                </table>
                                </div>
                            </fieldset>
                        </td>
                    </tr>-->
                    <!-- Project End -->
                    
                    
                </table>
            </td>
        </tr>
    </table>