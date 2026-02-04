<?php
	session_start();
	include('../config/dbinfo.inc.php');
	date_default_timezone_set("Asia/Dhaka");
	$businessDate  		= $_SESSION['BUSINESS_DATE'];
	echo $registrationId 	= $_REQUEST['registrationId']; 
	/*$query = "
				SELECT 
						U_INVESTOR_INFO.PORTFOLIO_ID,
						S_PORTFOLIO.PORTFOLIO_NAME,
						S_PORTFOLIO.PORTFOLIO_CODE,
						U_UNITAPP.NO_OF_UNITS,
						U_UNITAPP.RATE,
						U_UNITAPP.TOTAL_AMOUNT,
						to_char(U_UNITAPP.BUSINESS_DATE,'dd-mm-yyyy'),
						U_UNITAPP.POS_COMMISSION_ID,
						U_UNITAPP.NAV_ID,
						U_UNITAPP.INVESTOR_INFO_ID, 
						U_UNITAPP.UNITAPP_ID,
						lower(U_INVESTOR_INFO.INVESTMENT_TYPE),
						LOWER(U_UNITAPP.PAY_MODE), 
						U_UNITAPP.CHEQUE_NO,
						to_char(U_UNITAPP.CHEQUE_DATE,'dd-mm-yyyy'),
						U_UNITAPP.PO_NO,
						to_char(U_UNITAPP.PO_DATE,'dd-mm-yyyy'),
						U_UNITAPP.DD_NO,
						to_char(U_UNITAPP.DD_DATE,'dd-mm-yyyy'),
						U_UNITAPP.RECEIPT_NO,
						to_char(U_UNITAPP.RECEIPT_DATE,'dd-mm-yyyy')
				FROM
						U_UNITAPP,
						U_UNIT_APP_MSG_ROUTE,
						U_INVESTOR_INFO,
						S_PORTFOLIO
				WHERE
						U_UNITAPP.UNITAPP_ID 						= U_UNIT_APP_MSG_ROUTE.UNITAPP_ID 
				AND     U_INVESTOR_INFO.PORTFOLIO_ID 				= S_PORTFOLIO.PORTFOLIO_ID 												
				AND     U_INVESTOR_INFO.INVESTOR_INFO_ID 			= U_UNITAPP.INVESTOR_INFO_ID 
				AND		U_UNIT_APP_MSG_ROUTE.UNIT_APP_MSG_ROUTE_ID 	= '".$registrationId."'
				AND 	lower(U_UNITAPP.SELL_SURR_FLAG)				= 'sell' 
				ORDER BY
						U_UNITAPP.BUSINESS_DATE ASC  
			";
	$statement_query=oci_parse($con,$query);
	oci_execute ($statement_query);
	while(oci_fetch($statement_query)) {
		$portfolioID 		= oci_result($statement_query,1);
		$portfolioName  	= oci_result($statement_query,2);
		$portfolioCode  	= oci_result($statement_query,3);
		$units 				= oci_result($statement_query,4);
		$rate 				= oci_result($statement_query,5);
		$total_amnt 		= oci_result($statement_query,6);
		$unitPurRecDate 	= oci_result($statement_query,7);
		$PosCommissionID 	= oci_result($statement_query,8);
		$navID			  	= oci_result($statement_query,9);
		$unit_pur_id 		= oci_result($statement_query,10);
		$unitAppID			= oci_result($statement_query,11);
		$investmentType 	= oci_result($statement_query,12);
		
		$mode_pay 			= oci_result($statement_query,13);
		$cheque_no 			= oci_result($statement_query,14);			
		$cheque_date		= oci_result($statement_query,15);
		$po_no 				= oci_result($statement_query,16);			
		$po_date 			= oci_result($statement_query,17);
		$dd_no 				= oci_result($statement_query,18);		
		$dd_date 			= oci_result($statement_query,19);				
		$receipt_no 		= oci_result($statement_query,20);		
		$receipt_date 		= oci_result($statement_query,21);
		
		if(!empty($cheque_no)) {
			$instrmentNumber 	= strtoupper($mode_pay)."-".$cheque_no;
			$instrmentDate 		= $cheque_date;
		} elseif(!empty($po_no)) {
			$instrmentNumber 	= strtoupper($mode_pay)."-".$po_no;
			$instrmentDate 		= $po_date;
		} elseif(!empty($dd_no)) {
			$instrmentNumber 	= strtoupper($mode_pay)."-".$dd_no;
			$instrmentDate 		= $dd_date;
		}elseif(!empty($receipt_no)) {
			$instrmentNumber 	= strtoupper($mode_pay)."-".$receipt_no;
			$instrmentDate 		= $receipt_date;
		}*/
	
		$pending_list = "
					<div style='display:none'>
						<div class='contact-top'></div>
						<div class='contact-content'>
							<table class='motherTbl' style='border:0px;'>
								<tr>
									<td style='border:0px;'>
										<form name='InvestorPendingPaymentForm' id='InvestorPendingPaymentForm' method='post' action='#'>
											<h1 class='contact-title'></h1>
											<div class='contact-loading' style='display:none'></div>
											<div class='contact-message' style='display:none'></div>
											<table class='vtblHeader'>
												<tr valign='top'>
													<td align='center'colspan='3' style='font-weight:bold;'>Receipt Voucher</td>
												</tr>
												<tr valign='top'>
													<td align='right' width='47%'>Fund</td>
													<td align='center'>:</td>
													<td align='left'>{$portfolioName}</td>
												</tr>
												<tr valign='top'>
													<td align='right'>Transaction Date</td>
													<td align='center'>:</td>
													<td align='left'>
														{$businessDate}
														<input name='transectionDate{$registrationId}' type='hidden'  id='transectionDate{$registrationId}' value='{$businessDate}'/>
													</td>
												</tr>
											</table>
										</form>
									</td>
								</tr>
							</table>	
						</div>
						<div class='contact-bottom'>&nbsp;</div>
					</div>
				";
		echo $pending_list;
?>
<script type="text/javascript">
	var suggestionData = {};
	suggestionData.coaCodes = {};
	
	/*function chkButtonClose() {
		if(!confirm("Are you sure, you want to go back to home?")){
			return false;
		}
		$('#preloader').fadeIn('slow');
		window.location.href="PendingSellPayment.php";
	}*/
	
	function blankAllFields() {
		var numOfRows = $("#NumberOfRows").val();
		for(var i = 1; i< numOfRows; i++) {
			$('#coa_head'+i).attr('value','');
			$('#coa_codeshow'+i).html('');
			$('#coa_code'+i).attr('value','');
			$('#amount'+i).attr('value','0.00');
		}
		$('#particulars').attr('value','');
		
		var fundCode = $('#portfolioCode').val();
		if(fundCode != '') {
			var frm = 'p';												 
			//$.getJSON("ajax/suggestCOAPaymentRceipt.php", {frm : frm, fundCode : fundCode}, function(data) {
			$.getJSON("ajax/suggestCOAPaymentRceipt.php", {frm : frm, fundCode : fundCode}, function(data) {
				if(data.length >0) {
					suggestionData.coaCodes = JSON.stringify(data);
					//alert(suggestionData.coaCodes);
					reassignTabOrders();
				} else {
					suggestionData = {};
				}
			});
		}
	}
	
	function AddTabRow() {
		var numOfRows 	= $("#NumberOfRows").val();
		var numOfRowsId = numOfRows - 1;
		var coaCode 	= $("#coa_code"+numOfRowsId).val();
		var amount		= $("#amount"+numOfRowsId).val();
		amount			= Number(amount.replace(/[^\d\.\-\ ]/g, ''));
		coaCode 		= coaCode.substr(0,3);
		
		if(amount == 0) {
				return false;
		} else {
			// clone the last row in the table
			var $tr = '';//$("#ClosingBalTab").find("tbody tr:last").clone();
			
			if((coaCode == 303) || (coaCode == 304)) {
				//alert(coaCode);
				$tr = $("#ClosingBalTab").find("#transDetails"+numOfRowsId).prev('tr').clone();
				
				//$('#maintable tbody>tr:last').prev('tr')
			} else {
				$tr = $("#ClosingBalTab").find("tbody tr:last").clone();
			}
			
			$tr.find("#coa_head"+numOfRowsId).attr("name", function() {
				// break the field name and it's number into two parts
				var parts = this.name.match(/(\D+)(\d+)$/);
				// create a unique name for the new field by incrementing
				// the number for the previous field by 1
				return parts[1] + ++parts[2];
			// repeat for id attributes
			}).attr("id", function(){
				var parts = this.id.match(/(\D+)(\d+)$/);
				return parts[1] + ++parts[2];
			}).attr("value", function(){
				return "";
			});
			
			$tr.find("#coa_codeshow"+numOfRowsId).attr("id", function(){
				var parts = this.id.match(/(\D+)(\d+)$/);
				return parts[1] + ++parts[2];
			});
			
			$tr.find("#coa_code"+numOfRowsId).attr("name", function() {
				// break the field name and it's number into two parts
				var parts = this.name.match(/(\D+)(\d+)$/);
				// create a unique name for the new field by incrementing
				// the number for the previous field by 1
				return parts[1] + ++parts[2];
			// repeat for id attributes
			}).attr("id", function(){
				var parts = this.id.match(/(\D+)(\d+)$/);
				return parts[1] + ++parts[2];
			}).attr("value", function(){
				return "";
			}).attr("checked", function(){
				return false;
			});
			
			$tr.find("#accountTypeDebit"+numOfRowsId).attr("name", function() {
				// break the field name and it's number into two parts
				var parts = this.name.match(/(\D+)(\d+)$/);
				// create a unique name for the new field by incrementing
				// the number for the previous field by 1
				return parts[1] + ++parts[2];
			// repeat for id attributes
			}).attr("id", function(){
				var parts = this.id.match(/(\D+)(\d+)$/);
				return parts[1] + ++parts[2];
			}).attr("value", function(){
				return "D";
			}).attr("checked", function(){
				return false;
			}).attr("onClick", function(){
				var parts = this.id.match(/(\D+)(\d+)$/);
				return "DrCrAmountAlign("+ parts[2] +");totalDRCRShow();";
			});
			
			$tr.find("#accountTypeCredit"+numOfRowsId).attr("name", function() {
				// break the field name and it's number into two parts
				var parts = this.name.match(/(\D+)(\d+)$/);
				// create a unique name for the new field by incrementing
				// the number for the previous field by 1
				return parts[1] + ++parts[2];
			// repeat for id attributes
			}).attr("id", function(){
				var parts = this.id.match(/(\D+)(\d+)$/);
				return parts[1] + ++parts[2];
			}).attr("value", function(){
				return "C";
			}).attr("checked", function(){
				return false;
			}).attr("onClick", function(){
				var parts = this.id.match(/(\D+)(\d+)$/);
				return "DrCrAmountAlign("+ parts[2] +");totalDRCRShow();";
			});
			
			$tr.find("#amount"+numOfRowsId).attr("name", function() {
				// break the field name and it's number into two parts
				var parts = this.name.match(/(\D+)(\d+)$/);
				// create a unique name for the new field by incrementing
				// the number for the previous field by 1
				return parts[1] + ++parts[2];
			// repeat for id attributes
			}).attr("id", function(){
				var parts = this.id.match(/(\D+)(\d+)$/);
				return parts[1] + ++parts[2];
			}).attr("onBlur", function(){
				return "numberFormat(\"amount"+numOfRows+"\",this.value,2,\",\",\".\"); if((this.value==\"\") || (this.value==0)) this.value=\"0.00\"; AddTabRow();totalDRCRShow();";
			}).attr("value", function(){
				return "0.00";
			});
			
			$("#ClosingBalTab").find("tbody tr:last").after($tr);
			$("#coa_codeshow"+numOfRows).html('');
			$("#NumberOfRows").attr("value",Number(numOfRows)+1);
			reassignTabOrders();
			bindKeyPress();
		}
	}
	
	function addRemoveTransDetails(coaCode,id) {
		var instrmentNumber = $("#instrmentNumber").val();
		var instrmentDate	= $("#instrmentDate").val();
		coaCode = coaCode.substr(0,3);
		if((coaCode == 303) || (coaCode == 304)) {
			//$("#ClosingBalTab").find("tbody tr:gt(2)").remove();
			//$("#NumberOfRows").attr("value",2);
			var tranDetails = '';
			if(coaCode == 303) {
				if($('#transDetails'+id).length > 0) {
					$('#transDetails'+id).html('');
					$('#transDetails'+id).html('<td colspan="4">Drawn on : <input name="drawnOn" class="FormTextTypeInput" id="drawnOn" style="width:150px;" type="text"/></td>');
				} else {
					tranDetails = '<tr id="transDetails'+id+'"><td colspan="4">Drawn on : <input name="drawnOn" class="FormTextTypeInput" id="drawnOn" style="width:150px;" type="text"/></td></tr>';
				}
				
			} else {
				if($('#transDetails'+id).length > 0) {
					$('#transDetails'+id).html('');
					$('#transDetails'+id).html('<td colspan="4">Instrument No. : <input maxlength="20" class="FormNumericTypeInput" type="text"  id="chequeNo" name="chequeNo" style="text-align:left;" value="'+instrmentNumber+'"/>&nbsp;&nbsp;&nbsp;Date : <input name="chq_date" class="FormDateTypeInput" id="chq_date" type="text" readonly="readonly" onclick="showCalender(\'chq_date\',\'chq_date\')" value="'+instrmentDate+'"/>&nbsp;&nbsp;&nbsp;Drawn on : <input name="drawnOn" class="FormTextTypeInput" id="drawnOn" style="width:150px;" type="text"/></td>');
				} else {
					tranDetails = '<tr id="transDetails'+id+'"><td colspan="4">Instrument No. : <input maxlength="20" class="FormNumericTypeInput" type="text"  id="chequeNo" name="chequeNo" style="text-align:left;" value="'+instrmentNumber+'"/>&nbsp;&nbsp;&nbsp;Date : <input name="chq_date" class="FormDateTypeInput" id="chq_date" type="text" readonly="readonly" onclick="showCalender(\'chq_date\',\'chq_date\')" value="'+instrmentDate+'"/>&nbsp;&nbsp;&nbsp;Drawn on : <input name="drawnOn" class="FormTextTypeInput" id="drawnOn" style="width:150px;" type="text"/></td></tr>';
				}
			}
			$("#ClosingBalTab").find("tbody tr:last").after(tranDetails);
			reassignTabOrders();
			bindKeyPress();
		} else {
			if($('#transDetails'+id).length > 0) {
				$('#transDetails'+id).remove();
				reassignTabOrders();
				bindKeyPress();
			}
		}
	}
		
	function callback(item,no) {
		var coaCodeHead = item.text;
		var coaCode		= item.id
		
		$('#coa_head'+no).attr('value',coaCodeHead);
		$('#coa_codeshow'+no).html(coaCode);
		$('#coa_code'+no).attr('value',coaCode);
	   
		var frm      = 'p';
		var fundCode = $('#portfolioCode').val();
		$.post("ajax/trialBalPaymentRceiptAmount.php", {coaCode: coaCode, frm : frm, fundCode : fundCode }, 
			function(data) {
				document.getElementById('amount'+no).value = data;
			});
		addRemoveTransDetails(coaCode,no);
		return false;
	}
	
	$(document).ready(function() {
		reassignTabOrders();
		bindKeyPress();
		blankAllFields();
	});
	
	function bindKeyPress() {
		$('#InvestorPendingPaymentForm input,select,textarea').unbind("keypress");
		$('#InvestorPendingPaymentForm input,select,textarea').bind('keypress',function (event){
			var currentElementId = $(this).attr('id');
			var tabindex = Number($('#'+currentElementId).attr('tabindex'));
			var parts = (currentElementId.match(/(\D+)(\d+)$/) != null) ? currentElementId.match(/(\D+)(\d+)$/) : '';
			if (event.keyCode === 13) {
				if(currentElementId == 'insertPayment') {
					if(doValidationPaymentEntry()) {
						return true;
					} else {
						return false;
					}
					return false;
					
				} else {
					//alert('hell');
					var newTabIndex = tabindex + 1;
					if(parts[1] == 'coa_head') {
						//var nextElementId = $('[tabindex=' + newTabIndex + ']').attr('id');
						//$('#'+nextElementId).focus();
						//return true;
						//alert('helllllllllllll');
					} else if(parts[1] == 'amount') {
						$('#'+currentElementId).trigger('blur');
						var nextElementId = $('[tabindex=' + newTabIndex + ']').attr('id');
						$('#'+nextElementId).focus();
					} else {
						var nextElementId = $('[tabindex=' + newTabIndex + ']').attr('id');
						if($('#'+nextElementId).attr('type') == 'radio') {
							$('#'+nextElementId).trigger('click');
							$('#'+nextElementId).focus();
						} else {
							$('#'+nextElementId).focus();
						}
					}
					//alert('hell');
					return false;
				}
			} else {
				return true;
			}
		});
	}
	
	function reassignTabOrders(){
		var tabindex = 1;
		$('.jsonSuggestResults').remove();
		$('#InvestorPendingPaymentForm input:not(input[type=hidden]),select,textarea').each(function() {
			var $input = $(this);
			$input.attr("tabindex", tabindex);
			var coaElementId = $('[tabindex=' + tabindex + ']').attr('id');
			//alert(coaElementId);
			var parts = (coaElementId.match(/(\D+)(\d+)$/) != null) ? coaElementId.match(/(\D+)(\d+)$/) : '';
			//alert(parts);
			if($.isArray(parts)){
				if(parts[1] == 'coa_head') {
					//alert('yessssssss');
					$('input#coa_head'+parts[2]).unbind("keyup");
					$('input#coa_head'+parts[2]).unbind("blur");
					$('input#coa_head'+parts[2]).unbind("focus");
					$('input#coa_head'+parts[2]).jsonSuggest(suggestionData.coaCodes, {defaultId:parts[2],onSelect:callback});
				}
			}
			tabindex++;
			
		});
	}
	
	function DrCrAmountAlign(e){
		//alert(e);
		if(document.getElementById('accountTypeDebit'+e).checked==true){	
			document.getElementById('amount'+e).style.textAlign = 'left'
			
		}
		if(document.getElementById('accountTypeCredit'+e).checked==true){
			document.getElementById('amount'+e).style.textAlign = 'right'
		}
		return true;
	}
	
	function totalDRCRShow() {
		var numOfRows 			= $("#NumberOfRows").val();
		
		var previousTotalDebit 	= $('#previousTotalDebit').val();
		previousTotalDebit 		= Number(previousTotalDebit.replace(/\,/g,""));
		
		var previousTotalCredit 	= $('#previousTotalCredit').val();
		previousTotalCredit 		= Number(previousTotalCredit.replace(/\,/g,""));
		
		var k=0;
		var i=0;
		var Totaldebit = 0;
		var TotalCredit = 0;
		for(i = 1; i < numOfRows; i++){
			if((document.getElementById('accountTypeDebit'+i).checked==true) || (document.getElementById('accountTypeCredit'+i).checked==true)){
				if((document.getElementById('accountTypeDebit'+i).checked==true) && (document.getElementById('amount'+i).value !="")){
					var debitAmount 	= $('#amount'+i).val();
					debitAmount 		= Number(debitAmount.replace(/\,/g,""));
					Totaldebit      	= Totaldebit + debitAmount;
				}if((document.getElementById('accountTypeCredit'+i).checked==true) && (document.getElementById('amount'+i).value !="")){
					var creditAmount 	= $('#amount'+i).val();
					creditAmount 		= Number(creditAmount.replace(/\,/g,""));
					TotalCredit 		= TotalCredit + creditAmount;
				}									
			}	
		}
		Totaldebit 	= Number(Totaldebit + previousTotalDebit);
		TotalCredit = Number(TotalCredit + previousTotalCredit);
		
		$("#DRTOTAL").html(numberFormat('',Totaldebit,2,',','.'));
		$("#CRTOTAL").html(numberFormat('',TotalCredit,2,',','.'));
		
		$("#totalDrAmount").attr('value',Totaldebit);
		$("#totalCrAmount").attr('value',TotalCredit);
	}
</script>