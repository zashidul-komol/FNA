   
    <table width="70%" border="0" cellspacing="1" cellpadding="1" style="margin:0px auto 0px auto;">
        <tr>
            <td colspan="2" align="center"><h1> Edit Form</h1></td>
        </tr>
        <tr>
            <td colspan="2" align="center"><!--%[MSG]%--></td>
        </tr>
        <tr valign="top">
            <td width="60%" align="center">
                <table width="100%" height="329"  border="0" align="center" cellpadding="0" cellspacing="0">
                   
                    <!--  Start Load Entry Form -->
                    <tr valign="top">
                        <td align="left">
							<script  type="text/javascript">
								function confirmLoadSubmit() {
									if($("#PROJECTID").val() == ''){
											alert("Please Select Project name");
											$("#PROJECTID").focus();
											return false;
									}
									if($("#SUBPROJECTID").val() == ''){
											alert("Please Select Sub Project name");
											$("#SUBPROJECTID").focus();
											return false;
									}
									if($("#ENTRYDATE").val() == ''){
											alert("Please Select Date");
											$("#ENTRYDATE").focus();
											return false;
									}
									if($("#PARTYID").val() == ''){
											alert("Please Select Party name");
											$("#PARTYID").focus();
											return false;
									}
									
									if($("#LABOURID").val() == ''){
											alert("Please Select Labour name");
											$("#LABOURID").focus();
											return false;
									}
									
									var pList = $("#TOTAL_PRODUCT_LIST").val();
									for(i=1; i < pList; i++){
											if($("#PRODUCTID_"+i).val() == ''){
													alert("Please Select Product Name");
													$("#PRODUCTID_"+i).focus();
													return false;
											}
											if($("#quantity_"+i).val() == ''){
													alert("Please Insert Quantity");
													$("#quantity_"+i).focus();
													return false;
											}
											if($("#CHID2_"+i).val() == ''){
													alert("Please Select Chamber");
													$("#CHID2_"+i).focus();
													return false;
											}
											if($("#FLOORID2_"+i).val() == ''){
													alert("Please Select Floor");
													$("#FLOORID2_"+i).focus();
													return false;
											}
											if($("#POCKETID2_"+i).val() == ''){
													alert("Please Select Pocket");
													$("#POCKETID2_"+i).focus();
													return false;
											}
											
										
									}
																		
									if(!confirm('Are you sure, you want to proceed?')){
										return false;
									}
									return true;
								}
								
								
								function checkCalender(){
									var ENTRYDATE = String($("#ENTRYDATE").val());
									if(ENTRYDATE != ''){
										
										var tempENTRYDATE = ENTRYDATE.split('-'); 
										
										var a = tempENTRYDATE[1]+'/'+tempENTRYDATE[0]+'/'+tempENTRYDATE[2];
									}
								}
								
								function getProductNamebyCat(getCatIdName, pcId){
																			
										//var splitCatId = getCatIdName.split("_");										
										var options = '';
										var projectId = $("#PROJECTID").val();										
										var subProjectId = $("#SUBPROJECTID").val();										
										var ENTRYDATE = $("#ENTRYDATE").val();
										if(pcId == '' && getCatIdName == '') {
											options = '<option value="">No Product Found</option>';
											$("select#PRODUCTID_1").html('');
											$("select#PRODUCTID_1").html(options);
											return false;
										}
										$.getJSON("ajax/getProductListUnload.php",{pcId: pcId, projectId: projectId, subProjectId: subProjectId, ENTRYDATE: ENTRYDATE}, function(j) {
											//alert (ENTRYDATE);
											if(j.length>0) {
												
												options += '<option value="">Select</option>';
												for (var i = 0; i < j.length; i++) {
													options += '<option value="' + j[i].optionValue + '">' + j[i].optionDisplay + '</option>';
												}
												$("select#PRODUCTID_1").html('');
												$("select#PRODUCTID_1").html(options);
											}
											else {
												options = '<option value="">No Product Found</option>';
												$("select#PRODUCTID_1").html('');
												$("select#PRODUCTID_1").html(options);
											}
										})
									
									
								}
								
								
								$(document).ready(function(){
   																		
									$("select#PARTYID").change(function(){
										$.getJSON("ajax/getPartyInfo.php",{party_id: $(this).val()}, function(j) {
											if(j.length>0) {
												for (var i = 0; i < j.length; i++) {
												$("#FATHERNAME").val(j[i]['FATHERNAME']);
												$("#ADDRESS").val(j[i]['ADDRESS']);
												$("#MOBILE").val(j[i]['MOBILE']);
												
												}
											}
											else {
												$("#FATHERNAME").val('');
												$("#ADDRESS").val('');
												$("#MOBILE").val('');
											}
										})
									})
									
									
									
									
									var inputs = 2;	
									$('#btnAddMoreScripList').click(function() {		
										
										
										$('.btnDelMoreScripList:disabled').removeAttr('disabled');
										var c = $('.clonedInputForScripList:first').clone(true);
										
										
										c.find('input:hidden#PRODUCTLOADUNLOADBKDNID_1').attr({
																				'id':'PRODUCTLOADUNLOADBKDNID_'+inputs,
																				'value':''
																			});		
										c.find('select#PRODUCTID_1').attr({
																				'id':'PRODUCTID_'+inputs
																			});
										c.find('select#CHID2_1').attr({
																				'id':'CHID2_'+inputs
																			});
										c.find('select#FLOORID2_1').attr({
																				'id':'FLOORID2_'+inputs,
																				'value':''
																			});																																																																																															
										c.find('select#POCKETID2_1').attr({
																				'id':'POCKETID2_'+inputs,
																				'value':''
																			});																																																																																															
																												
										c.find('input:hidden#existingquantity_1').attr({
																				'id':'existingquantity_'+inputs,
																				'value':''
																			});
										c.find('input:hidden#quantity_1').attr({
																				'id':'quantity_'+inputs,
																				'value':''
																			});
										c.find('input:hidden#labourbill_1').attr({
																				'id':'labourbill_'+inputs,
																				'value':''
																			});
										c.find('input:hidden#closest_position1').attr({
																			'id':'closest_position'+inputs,
																			'value':inputs
																		});																		
																														
										$('.clonedInputForScripList:last').after(c);
										
										
										inputs++;
										$("#TOTAL_PRODUCT_LIST").attr('value',inputs);
									});
									
									$('.btnDelMoreScripList').click(function() {
										if (confirm('Continue Delete?')) {
											var colsest_pos = $(this).closest('.clonedInputForScripList').find('.closest_position').val();
											$(this).closest('.clonedInputForScripList').remove();
											var counter = 1;
											for(var i=1;i<inputs;i++) {
												if(i == colsest_pos)
												continue;
												$("#trade_file_view_details").find('input:hidden#PRODUCTLOADUNLOADBKDNID_'+i).attr({
																											'id':'PRODUCTLOADUNLOADBKDNID_'+counter,
																											'value':''
																										});
												$("#trade_file_view_details").find('select#PRODUCTID_'+i).attr({
																											'id':'PRODUCTID_'+counter
																										});
												$("#trade_file_view_details").find('select#CHID2_'+i).attr({
																											'id':'CHID2_'+counter
																										});
												$("#trade_file_view_details").find('select#FLOORID2_'+i).attr({
																											'id':'FLOORID2_'+counter,
																											'value':''
																										});
												$("#trade_file_view_details").find('select#POCKETID2_'+i).attr({
																											'id':'POCKETID2_'+counter,
																											'value':''
																										});
												$("#trade_file_view_details").find('input:hidden#existingquantity_'+i).attr({
																											'id':'existingquantity_'+counter,
																											'value':''
																										});
												$("#trade_file_view_details").find('input:hidden#quantity_'+i).attr({
																											'id':'quantity_'+counter,
																											'value':''
																										});
												$("#trade_file_view_details").find('input:hidden#labourbill_'+i).attr({
																											'id':'labourbill_'+counter,
																											'value':''
																										});
												$("#trade_file_view_details").find('input:text#closest_position'+i).attr({
																							'value':counter,
																							'id':'closest_position'+counter
																						});
												counter++;
											}
											--inputs;
											$("#TOTAL_PRODUCT_LIST").attr('value',inputs);
											$('.btnDelMoreScripList').attr('disabled',($('.clonedInputForScripList').length  < 2));
											return false;
										}
										else{
											return false;
										}
									});	
									  
  
								});
								
								function getProjectNameTrans(pcId){					
										var options = '';
										if(pcId == '') {
											options = '<option value="">No Product Found</option>';
											$("select#SUBPROJECTID").html('');
											$("select#SUBPROJECTID").html(options);
											return false;
										}
										$.getJSON("ajax/getProjectList.php",{pcId: pcId}, function(j) {
											if(j.length>0) {
												//alert (pcId);
												options += '<option value="">Select</option>';
												for (var i = 0; i < j.length; i++) {
													options += '<option value="' + j[i].optionValue + '">' + j[i].optionDisplay + '</option>';
												}
												$("select#SUBPROJECTID").html('');
												$("select#SUBPROJECTID").html(options);
											}
											else {
												options = '<option value="">No Product Found</option>';
												$("select#SUBPROJECTID").html('');
												$("select#SUBPROJECTID").html(options);
											}
										})
									
									
								}
								
								function PartyLabourName(pcId){					
										var projectId = $("#PROJECTID").val();
										var options = '';
										var jj = '';
										if(pcId == '') {
											options = '<option value="">No Product Found</option>';
											$("select#LABOURID").html('');
											$("select#LABOURID").html(options);
											return false;
										}
										$.getJSON("ajax/getLabourNameListTrans.php",{pcId: pcId, projectId: projectId}, function(j) {
											if(j.length>0) {
												//alert (pcId);
												options = '';
												options += '<option value="">Select</option>';
												for (var i = 0; i < j.length; i++) {
													options += '<option value="' + j[i].optionValue + '">' + j[i].optionDisplay + '</option>';
												}
												$("select#LABOURID").html('');
												$("select#LABOURID").html(options);
											}
											else {
												options = '<option value="">No Product Found</option>';
												$("select#LABOURID").html('');
												$("select#LABOURID").html(options);
											}
										});
										
										$.getJSON("ajax/getPartyName.php",{pcId: pcId}, function(jj) {
											if(jj.length>0) {
												var options = '';
												options += '<option value="">Select</option>';
												for (var ii = 0; ii < jj.length; ii++) {
													options += '<option value="' + jj[ii].optionValue + '">' + jj[ii].optionDisplay + '</option>';
												}
												$("select#PARTYID").html('');
												$("select#PARTYID").html(options);
											}
											else {
												options = '<option value="">No Product Found</option>';
												$("select#PARTYID").html('');
												$("select#PARTYID").html(options);
											}
										});
										
										$.getJSON("ajax/getProdCategoryList.php",{pcId: pcId}, function(j) {
											if(j.length>0) {
												//alert (pcId);
												var options = '';
												options += '<option value="">Select</option>';
												for (var i = 0; i < j.length; i++) {
													options += '<option value="' + j[i].optionValue + '">' + j[i].optionDisplay + '</option>';
												}
												$("select#PRODCATTYPEID").html('');
												$("select#PRODCATTYPEID").html(options);
											}
											else {
												options = '<option value="">No Product Found</option>';
												$("select#PRODCATTYPEID").html('');
												$("select#PRODCATTYPEID").html(options);
												
											}
										});
										
								}
								
								function getPackingUnitList(getCatIdName, chId){
																		
										var splitCatId = getCatIdName.split("_");
											
										var projectId = $("#PROJECTID").val();										
										var subProjectId = $("#SUBPROJECTID").val();										
										var labourId = $("#LABOURID").val();						
										var options = '';
										if(chId == '' && getCatIdName == '') {
											options = '<option value="">No Packing Unit Found</option>';
											$("select#packingUnit_"+splitCatId[1]).html('');
											$("select#packingUnit_"+splitCatId[1]).html(options);
											return false;
										}
										$.getJSON("ajax/getPackUnitList.php",{chId: chId, projectId: projectId, subProjectId: subProjectId, labourId: labourId}, function(j) {
											if(j.length>0) {
												options += '<option value="">Select</option>';
												for (var i = 0; i < j.length; i++) {
													options += '<option value="' + j[i].optionValue + '">' + j[i].optionDisplay + '</option>';
												}
												$("select#packingUnit_"+splitCatId[1]).html('');
												$("select#packingUnit_"+splitCatId[1]).html(options);
											}
											else {
												options = '<option value="">No Packing Unit Found</option>';
												$("select#packingUnit_"+splitCatId[1]).html('');
												$("select#packingUnit_"+splitCatId[1]).html(options);
											}
										})
									
									
								}
								
								function getProduct(getCatIdName, pid){
										//alert (getCatIdName);								
										var splitCatId = getCatIdName.split("_");
										var PROJECTID = $("#PROJECTID").val();
										var SUBPROJECTID = $("#SUBPROJECTID").val();	
										var PARTYID = $("#PARTYID").val();	
										//var PRODUCTID 	= $("#PRODUCTID_"+posId[1]).val();		
										var options = '';
										if(pid == '') {
											options = '<option value="">No Product Found</option>';
											$("select#packingUnit_"+splitCatId[1]).html('');
											$("select#packingUnit_"+splitCatId[1]).html(options);
											return false;
										}
										//alert (pid);
										
										$.getJSON("ajax/getProductListEntrySl.php",{'pid': pid, 'PROJECTID': PROJECTID, 'SUBPROJECTID': SUBPROJECTID, 'PARTYID': PARTYID}, function(j) {
											//alert (j);
											//alert ('komol');
											
											if(j.length>0) {
												options += '<option value="">Select</option>';
												for (var i = 0; i < j.length; i++) {
													options += '<option value="' + j[i].optionValue + '">' + j[i].optionDisplay + '</option>';
												}
												$("select#PRODUCTID_"+splitCatId[1]).html('');
												$("select#PRODUCTID_"+splitCatId[1]).html(options);
											}
											else {
												options = '<option value="">No Product Found</option>';
												$("select#PRODUCTID_"+splitCatId[1]).html('');
												$("select#PRODUCTID_"+splitCatId[1]).html(options);
											}
											
										});
										
										
								}
								
								
								function PackCalculation(quantityPosition, quantity){
									
									var posId = quantityPosition.split("_");
									//alert (j);
									var LABOURID 	= $("#LABOURID").val();										
									var CHID	 	= $("#CHID_"+posId[1]).val();	
									var CHID2	 	= $("#CHID2_"+posId[1]).val();									
									var packingUnit = $("#packingUnit_"+posId[1]).val();	
									
									if(quantity == '') {
											$("#Calculation_"+posId[1]).html('');
											$("#Calculation_"+posId[1]).html(j);
											return false;
										}
										$.post("ajax/getPackUnitCalculationTransfer.php",{quantity: quantity, LABOURID: LABOURID, CHID: CHID, CHID2: CHID2, packingUnit: packingUnit }, function(j) {
											//alert (j);
											if(j.length>0) {
												//var race = j.split("-"); 
												//alert (posId[1]);
												$("#Calculation_"+posId[1]).val(j);
												//$("#EMPLOYEEID_"+posId[1]).html(j);
											}
											else {
												$("#Calculation_"+posId[1]).html('');
											}
										})
										
																		
								}
								
								function getPackingUnit(getCatIdName, pcId){
										//alert (getCatIdName);									
										//var splitCatId = getCatIdName.split("_");	
										var projectId = $("#PROJECTID").val();										
										var subProjectId = $("#SUBPROJECTID").val();										
										var labourId = $("#LABOURID").val();		
										var ENTRYDATE = $("#ENTRYDATE").val();										
										var options = '';
										
										if(pcId == '' && getCatIdName == '') {
											options = '<option value="">No Product Found</option>';
											$("select#packingUnit_1").html('');
											$("select#packingUnit_1").html(options);
											return false;
										}
																			
										var jj = '';
										//alert ('komol');
										$.getJSON("ajax/getFloorList.php",{pcId: pcId}, function(jj) {
											//alert ('pcId');
											if(jj.length>0) {
												alert (jj);
												options = '';
												options += '<option value="">Select</option>';
												for (var i = 0; i < jj.length; i++) {
													options += '<option value="' + jj[i].optionValue + '">' + jj[i].optionDisplay + '</option>';
												}
												$("select#FLOORID_1").html('');
												$("select#FLOORID_1").html(options);
											}
											else {
												options = '<option value="">No Floor Found</option>';
												$("select#FLOORID_1").html('');
												$("select#FLOORID_1").html(options);
												
											}
										});
										
									
								}
								
								function getPocket(getCatIdName, pcId){
										//alert (FloorId);									
										//var splitCatId = getCatIdName.split("_");	
										var projectId = $("#PROJECTID").val();										
										var subProjectId = $("#SUBPROJECTID").val();										
										var labourId = $("#LABOURID").val();		
										var ENTRYDATE = $("#ENTRYDATE").val();										
										var options = '';
										
										if(pcId == '' && getCatIdName == '') {
											options = '<option value="">No Product Found</option>';
											$("select#packingUnit_1").html('');
											$("select#packingUnit_1").html(options);
											return false;
										}
										var j = '';
										//alert (pcId);
										$.getJSON("ajax/getPocketListTransfer.php",{pcId: pcId}, function(j) {
											if(j.length>0) {
												//alert (j);
												options = '';
												options += '<option value="">Select</option>';
												for (var i = 0; i < j.length; i++) {
													options += '<option value="' + j[i].optionValue + '">' + j[i].optionDisplay + '</option>';
												}
												$("select#POCKETID_1").html('');
												$("select#POCKETID_1").html(options);
											}
											else {
												options = '<option value="">No Pocket Found</option>';
												$("select#POCKETID_1").html('');
												$("select#POCKETID_1").html(options);
											}
										});
										
																		
									
								}
								
								function getPackingUnit2(getCatIdName, pcId){
										//alert (getCatIdName);									
										var splitCatId = getCatIdName.split("_");	
										var projectId = $("#PROJECTID").val();										
										var subProjectId = $("#SUBPROJECTID").val();										
										var labourId = $("#LABOURID").val();		
										var ENTRYDATE = $("#ENTRYDATE").val();										
										var options = '';
										
										if(pcId == '' && getCatIdName == '') {
											options = '<option value="">No Product Found</option>';
											$("select#packingUnit_"+splitCatId[1]).html('');
											$("select#packingUnit_"+splitCatId[1]).html(options);
											return false;
										}
																			
										var jj = '';
										//alert ('komol');
										$.getJSON("ajax/getFloorList.php",{pcId: pcId}, function(jj) {
											//alert ('pcId');
											if(jj.length>0) {
												//alert (jj);
												options = '';
												options += '<option value="">Select</option>';
												for (var i = 0; i < jj.length; i++) {
													options += '<option value="' + jj[i].optionValue + '">' + jj[i].optionDisplay + '</option>';
												}
												$("select#FLOORID2_"+splitCatId[1]).html('');
												$("select#FLOORID2_"+splitCatId[1]).html(options);
												
											}
											else {
												options = '<option value="">No Floor Found</option>';
												$("select#FLOORID2_"+splitCatId[1]).html('');
												$("select#FLOORID2_"+splitCatId[1]).html(options);
																							
											}
										});
										
									
								}
								
								function getPocket2(getCatIdName, pcId){
										//alert (FloorId);									
										var splitCatId = getCatIdName.split("_");	
										var projectId = $("#PROJECTID").val();										
										var subProjectId = $("#SUBPROJECTID").val();										
										var labourId = $("#LABOURID").val();		
										var ENTRYDATE = $("#ENTRYDATE").val();										
										var options = '';
										
										if(pcId == '' && getCatIdName == '') {
											options = '<option value="">No Product Found</option>';
											$("select#packingUnit_1").html('');
											$("select#packingUnit_1").html(options);
											return false;
										}
										var k = '';
										//alert (pcId);
										$.getJSON("ajax/getPocketListTransfer.php",{pcId: pcId}, function(k) {
											if(k.length>0) {
												//alert (j);
												options = '';
												options += '<option value="">Select</option>';
												for (var i = 0; i < k.length; i++) {
													options += '<option value="' + k[i].optionValue + '">' + k[i].optionDisplay + '</option>';
												}
												$("select#POCKETID2_"+splitCatId[1]).html('');
												$("select#POCKETID2_"+splitCatId[1]).html(options);
											}
											else {
												options = '<option value="">No Pocket Found</option>';
												$("select#POCKETID2_"+splitCatId[1]).html('');
												$("select#POCKETID2_"+splitCatId[1]).html(options);
											}
										});
										
																		
									
								}
								
								function getPocketBalance(quantityPosition, quantity){
									
									var posId = quantityPosition.split("_");
									//alert (quantity);
									var PROJECTID 		= $("#PROJECTID").val();	
									var SUBPROJECTID 	= $("#SUBPROJECTID").val();
									var PARTYID		 	= $("#PARTYID").val();											
									var PRODUCTLOADUNLOADBKDNID	= $("#PRODUCTLOADUNLOADBKDNID_"+posId[1]).val();
									
									if(quantity == '') {
											$("#existingquantity_"+posId[1]).html('');
											$("#existingquantity_"+posId[1]).html(j);
											return false;
										}
										$.post("ajax/getPocketBalanceUnload.php",{quantity: quantity, PROJECTID: PROJECTID, SUBPROJECTID: SUBPROJECTID, PARTYID: PARTYID, PRODUCTLOADUNLOADBKDNID: PRODUCTLOADUNLOADBKDNID }, function(j) {
											//alert (j);
											if(j.length>0) {
												//var race = j.split("-"); 
												//alert (posId[1]);
												$("#existingquantity_"+posId[1]).val(j);
												//$("#EMPLOYEEID_"+posId[1]).html(j);
											}
											else {
												$("#existingquantity_"+posId[1]).html('');
											}
										})
										
																		
								}
								
                            </script>
                                <?php
                                    //include('init.php');
                                    $get_id	= $_GET['POCKETSTOCKID'];
                                    echo $_GET['POCKETSTOCKID'] ; 
                                ?>
                            
                            <fieldset>
                                <legend style="color:#2C89B5; cursor:pointer;"  onClick="return ShowHide('showLoad')">Enter Transfer Edit Information</legend>
                                <div id="showLoad" style="display:">
                                  <form name="LoadForm" method="post" action="fnaTransfer.php" onsubmit="return confirmLoadSubmit();">
                                        <table width="100%" border="0" cellpadding="1" cellspacing="0">
                                            
                                             <tr valign="top">
                                                <td height="26" align="left" colspan="2">
                                                		<div id="trade_file_view_details">
                                                                <div style="margin-bottom:4px;width:100%; font-family:Tahoma, Geneva, sans-serif;" class="clonedInputForScripList">
                                                                    <table width="101%" class="frmTbl" border="0" style="font-family:Tahoma, Geneva, sans-serif;font-size:100%;">
                                                                           <tr valign="middle">
                                                                                <td width="15%" align="center" bgcolor="#990033" style="color:white">Count No.</td>
                                                                                <td width="10%" align="center" bgcolor="#990033" style="color:white">Product name</td>
                                                                                <td width="15%" align="center" bgcolor="#FFFF66">Chamber To</td>
                                                                                <td width="10%" align="center" bgcolor="#FFFF66">Floor</td>
                                                                                <td width="10%" align="center" bgcolor="#FFFF66">Pocket</td>
                                                                                <td width="10%" align="center" bgcolor="#CCFFFF">Bal Qnty</td>
                                                                                <td width="10%" align="center" bgcolor="#CCFFFF">Trans Qnty</td>
                                                                                <td width="10%" align="center" bgcolor="#CCFFFF">Labour Bill</td>
                                                                                <td width="10%" align="right" bgcolor="#CCFFFF">&nbsp;</td>
                                                                                
                                                                            </tr>
                                                                            <tr valign="middle">
                                                                            	<td width="15%" align="center"><input id="PRODUCTLOADUNLOADBKDNID_1" name="PRODUCTLOADUNLOADBKDNID[]" style="width:100px;" onchange="getProduct(this.id,this.value);"></td>
                                                                                <td width="15%" align="center"><select id="PRODUCTID_1" name="PRODUCTID[]" style="width:130px;" onchange="getPocketBalance(this.id,this.value);">
                                                                                <option value="">Select</option>
                                                                    			</select>
                                                                                </td>
                                                                                
                                                                                <td align="center"><select id="CHID2_1" name="CHID2[]" style="width:130px;" onchange="getPackingUnit2(this.id,this.value);">
                                                                                  <option value="">Select</option>
                                                                                  <!--%[CHAMBER_FROM]%-->
                                                                                </select></td>
                                                                                <td height="26" align="left"><select name="FLOORID2[]" id="FLOORID2_1"  style="width:130px;" onchange="getPocket2(this.id,this.value);">
                                                            					<option value=""> Select </option>
                                                          						</select></td>
                                                                                <td align="center" width="15%"><select name="POCKETID2[]" id="POCKETID2_1"  style="width:130px;">
                                                                                  <option value=""> Select </option>
                                                                                </select></td>
                                                                                <td align="center"><input id="existingquantity_1" name="existingquantity[]" style="width:100px;" readonly="readonly"/></td>
                                                                                <td align="center"><input id="quantity_1" name="quantity[]" style="width:100px;"/></td>
                                                                                <td align="center"><input id="labourbill_1" name="labourbill[]" style="width:100px;"/></td>
                                                                                <td align="right" valign="top"><input style="font-family:Tahoma, Geneva, sans-serif;font-size:100%;" class="btnDelMoreScripList"  disabled="disabled" type="image" src="../images/cancel.png"></td>
                                                                            </tr>
                                                                              
                                                                        </table>
                                                                    
                                                                </div>
                                                            </div>
                                                </td>
                                            </tr>
                                                <tr valign="top">
                                                    <td align="right" colspan="2">
                                                        <input name="TOTAL_PRODUCT_LIST" id="TOTAL_PRODUCT_LIST" type="hidden" value="2" />
                                                        <input style="font-family:Tahoma, Geneva, sans-serif;font-size:100%;" id="btnAddMoreScripList" value="Add More" type="button">
                                                    </td>
                                                </tr>                                       
                                            <tr valign="top">
                                                <td width="5%" height="26" align="right">&nbsp;</td>
                                                <td width="95%" height="26" align="center">
                                                    <input type="submit" name="InsertTransferInfo" value="Insert" class="FormSubmitBtn" style="width:180px;"/>
                                                    <input name="btnClose" type="button" value="Close" onClick="return ShowHide('showLoad')"  style="width:180px;">
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                              </div>
                          </fieldset>
                        </td>
                    </tr>
                    <!--  End Load Entry Form  --> 
                    
              </table>
            </td>
          </tr>
    </table>