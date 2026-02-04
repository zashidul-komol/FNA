<?php

	include('../config/dbinfo.inc.php');
	
function showDateMySQlFormat($date){
	
		$exp = explode("-",$date);				
		$mysqlDateF = $exp[2]."-".$exp[1]."-".$exp[0];
		
		return $mysqlDateF;
}
function insertDateMySQlFormat($date){
	
		$exp = explode("-",$date);				
		$mysqlDateFormate = $exp[2]."-".$exp[1]."-".$exp[0];
		
		return $mysqlDateFormate;
		
}

	$PROJECTID 			= $_REQUEST['PROJECTID'];
	$SUBPROJECTID		= $_REQUEST['SUBPROJECTID'];
	$LOTNO	 			= $_REQUEST['LOTNO'];
	$DONO	 			= $_REQUEST['DONO'];
	//$ReceiverName		= $_REQUEST['ReceiverName'];
	//$ReceiverMobile		= $_REQUEST['ReceiverMobile'];
	$ENTRYDATE_FROM		= showDateMySQlFormat($_REQUEST['ENTRYDATE']);
	//$ENTRYDATE_TO 		= showDateMySQlFormat($_REQUEST['ENTRYDATE2']);
	$userId 			= $_REQUEST['userId'];
	$con = '';
	
	
	//Ministry/Division and Project/Programme Name View Report Start	
	
	/*$LotFlag_Qry	= mysql_fetch_array(mysql_query("SELECT MAX(LOTFLAG) FROM fna_alustock WHERE PROJECTID = '".$PROJECTID."' AND SUBPROJECTID = '".$SUBPROJECTID."' AND LOTNO = '".$LOTNO."'"));
	$MaxLotFlag		= $LotFlag_Qry['MAX(LOTFLAG)'];*/
	
	
	$Lot_Query 		= "SELECT 	ast.PARTYID,
								ast.ENTRYSERIALNOID,
								plu.REC_NAME,
								plu.REC_MOB
							FROM fna_alustock ast, fna_productloadunload plu, fna_productloadunloadbkdn bkdn
							WHERE plu.PRODUCTLOADUNLOADID = bkdn.PRODUCTLOADUNLOADID
							AND bkdn.PRODUCTLOADUNLOADBKDNID = ast.PRODUCTLOADUNLOADBKDNID
							AND ast.PROJECTID = '".$PROJECTID."'
							AND ast.SUBPROJECTID = '".$SUBPROJECTID."'
							AND ast.LOTNO = '".$LOTNO."'
							AND plu.DONO = '".$DONO."'
							AND plu.ENTRYDATE >= '2022-01-01' 
							ORDER BY plu.DONO ASC
							
						";
	$Lot_QueryStatement						= mysql_query($Lot_Query);
	$PARTYID	='';
	while($Lot_QueryStatementData			= mysql_fetch_array($Lot_QueryStatement)){	
		$PARTYID							= $Lot_QueryStatementData['PARTYID'];
		$ENTRYSERIALNOID					= $Lot_QueryStatementData['ENTRYSERIALNOID'];
		$REC_NAME							= $Lot_QueryStatementData['REC_NAME'];
		$REC_MOB							= $Lot_QueryStatementData['REC_MOB'];
	}
	
	$Lot_LoadQnty 		= "SELECT 	LOADQUANTITY
								FROM fna_alustock
								WHERE PROJECTID = '".$PROJECTID."'
								AND SUBPROJECTID = '".$SUBPROJECTID."'
								AND LOTNO = '".$LOTNO."'
								AND WORKTYPEFLAG = 'Load'
								
							";
		$Lot_LoadQntyStatement					= mysql_query($Lot_LoadQnty);
		while($Lot_LoadQntyStatementData		= mysql_fetch_array($Lot_LoadQntyStatement)){	
			$LOADQUANTITY_LOT					= $Lot_LoadQntyStatementData['LOADQUANTITY'];
		}
	
			
	 	$partySql 	= "
						SELECT PARTYNAME,
								ADDRESS,
								MOBILE											
							FROM fna_party 
							WHERE PARTYID = '".$PARTYID."'
							
					";
		$partySqlStatement				= mysql_query($partySql);
		$PARTYNAME	='';
		$ADDRESS 	='';
		$MOBILE		='';
		while($partySqlStatementData	= mysql_fetch_array($partySqlStatement)){
			$PARTYNAME        			= $partySqlStatementData["PARTYNAME"];
			$ADDRESS        			= $partySqlStatementData["ADDRESS"];
			$MOBILE	        			= $partySqlStatementData["MOBILE"];
		}
		
		$SubProjectSql 	= "
							SELECT  sp.SUBPROJECTNAME											
							FROM fna_subproject sp
							WHERE sp.SUBPROJECTID = '".$SUBPROJECTID."'
							
						";
			$SubProjectSqlStatement				= mysql_query($SubProjectSql);
			while($SubProjectSqlStatementData	= mysql_fetch_array($SubProjectSqlStatement)){
				$SUBPROJECTNAME        			= $SubProjectSqlStatementData["SUBPROJECTNAME"];
				
			}
			
			/*$DONOSql 	= "
							SELECT  plu.DONO,
									plu.REC_NAME,
									plu.REC_MOB												
								FROM fna_productloadunload plu
							WHERE plu.ENTRYSERIALNOID = '".$ENTRYSERIALNOID."'
							
						";
			$DONOSqlStatement					= mysql_query($DONOSql);
			while($DONOSqlStatementData			= mysql_fetch_array($DONOSqlStatement)){
				$DONO		        			= $DONOSqlStatementData["DONO"];
				$REC_NAME	        			= $DONOSqlStatementData["REC_NAME"];
				$REC_MOB	        			= $DONOSqlStatementData["REC_MOB"];
				
			}*/
		
			
			//Ministry/Division and Project/Programme Name View Report End
			
	$tableView = "";	
	$tableView .="<table width='75%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:85%; border: 1px dotted #000'>

					  <tr>
                            <td style='text-align:right;' colspan='18'>
                            <a href='javascript:Clickheretoprint()'><img border='0' src='images/print_icon.jpg' width='40' height='26' /></a>                        
                            </td>
                     </tr>
					  <tr>
						<td colspan='9' align='center' valign='middle' style='border: 1px dotted #000'>
							<center><b><font size=4>F N A Group Of Company</font></b></center>
							<center><b><font size=3>$SUBPROJECTNAME DO Report</FONT></b></center>
							<center><b><font size=2>Date : $ENTRYDATE_FROM </font></b></center>
						</td>
					  </tr> 
					  <tr>
						<td colspan='9' align='right' valign='middle' style='border: 1px dotted #000'>
							<right><b><font>Store Keeper Copy..</b></center>
							<center><b><font>DO No: $DONO </b></center>
						</td>
					  </tr>
					  <tr>

						<td colspan='9' align='left' valign='top'>
							<table width='100%' border='0' cellpadding='1' cellspacing='0' style='margin:0px auto 0px auto;font-size:100%;'>
								  <tr style='font-weight:bold;'>
								
									<td width='15%' align='left' valign='top'>Party Name <b></td>
									<td width='1%' align='center' valign='top'>:</td>
									<td width='34%' align='left' valign='top'>$PARTYNAME</td>
									<td width='20%' align='right' valign='top'>Lot No. <b></td>
									<td width='1%' align='center' valign='top'>:</td>
									<td width='29%' align='left' valign='top'>$LOTNO  /  $LOADQUANTITY_LOT</td>
									
								  </tr>
								  <tr style='font-weight:bold;'>
								
									<td width='15%' align='left' valign='top'>Address <b></td>
									<td width='1%' align='center' valign='top'>:</td>
									<td width='34%' align='left' valign='top'>$ADDRESS</td>
									<td width='20%' align='right' valign='top'>Receiver Name <b></td>
									<td width='1%' align='center' valign='top'>:</td>
									<td width='29%' align='left' valign='top'>$REC_NAME</td>
									
								  </tr>
								  <tr style='font-weight:bold;'>
								
									<td width='15%' align='left' valign='top'>Mobile No <b></td>
									<td width='1%' align='center' valign='top'>:</td>
									<td width='34%' align='left' valign='top'>$MOBILE </td>
									<td width='20%' align='right' valign='top'>Rec. Mobile <b></td>
									<td width='1%' align='center' valign='top'>:</td>
									<td width='29%' align='left' valign='top'>$REC_MOB</td>
									
								  </tr>
								</table>
							

						</td>

					  </tr> ";

// Query here.


							
							// Package Information View Report Start 	 <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<	
							
								/*
								$PartyStatementQuery 	= "SELECT p.LOANDATE
																FROM fna_loan p 
																WHERE p.PROJECTID = '".$PROJECTID."'
																AND p.SUBPROJECTID = '".$SUBPROJECTID."'
																{$con}
																AND p.LOANDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
																ORDER BY p.LOANDATE ASC
															"; 
								$PartyStatementQueryStatement				= mysql_query($PartyStatementQuery);
								$i = 0;
								while($PartyStatementQueryStatementData		= mysql_fetch_array($PartyStatementQueryStatement)){	
									$LOANDATE_ARRAY[] 						= $PartyStatementQueryStatementData['LOANDATE'];
									$i++;
								}
								
								$LOANDATE_ARRAY_UNIQUE = array_unique($LOANDATE_ARRAY);
								$sl = 1;	
								foreach($LOANDATE_ARRAY_UNIQUE as $individualDate){*/
									
									$LotFlag_Qry	= mysql_fetch_array(mysql_query("SELECT MAX(LOTFLAG) FROM fna_alustock WHERE LOTNO = '".$LOTNO."' AND WORKTYPEFLAG = 'Unload'"));
									$MaxLotFlag		= $LotFlag_Qry['MAX(LOTFLAG)'];
									
									
									$Lot_Query 		= "SELECT 	ast.PARTYID,
																ast.PACKINGUNITID,
																ast.PRODUCTID,
																ast.ENTRYDATE,
																ast.LOADQUANTITY,
																ast.UNLOADQUANTITY,
																ast.LOTTOTQNTY
															FROM fna_alustock ast, fna_productloadunload plu, fna_productloadunloadbkdn bkdn
															WHERE plu.PRODUCTLOADUNLOADID = bkdn.PRODUCTLOADUNLOADID
															AND bkdn.PRODUCTLOADUNLOADBKDNID = ast.PRODUCTLOADUNLOADBKDNID
															AND ast.PROJECTID = '".$PROJECTID."'
															AND ast.SUBPROJECTID = '".$SUBPROJECTID."'
															AND ast.LOTNO = '".$LOTNO."'
															AND plu.DONO = '".$DONO."'
															AND plu.ENTRYDATE >= '2021-01-01' 
															ORDER BY plu.DONO ASC
															
														";
									$Lot_QueryStatement						= mysql_query($Lot_Query);
									$PARTYID	='';
									$PACKINGUNITID	='';
									$PRODUCTID	='';
									$UNLOADQUANTITY	='';
									while($Lot_QueryStatementData				= mysql_fetch_array($Lot_QueryStatement)){	
										$PARTYID								= $Lot_QueryStatementData['PARTYID'];
										$PACKINGUNITID							= $Lot_QueryStatementData['PACKINGUNITID'];
										$PRODUCTID								= $Lot_QueryStatementData['PRODUCTID'];
										$ENTRYDATE_LOT							= $Lot_QueryStatementData['ENTRYDATE'];
										$LOADQUANTITY							= $Lot_QueryStatementData['LOADQUANTITY'];
										$UNLOADQUANTITY							= $Lot_QueryStatementData['UNLOADQUANTITY'];
										$LOTTOTQNTY								= $Lot_QueryStatementData['LOTTOTQNTY'];
										//$LOTFLAG								= $Lot_QueryStatementData['LOTFLAG'];
										//$WORKTYPEFLAG							= $Lot_QueryStatementData['WORKTYPEFLAG'];
										
									}
									
									$LoanFlag_Qry	= mysql_fetch_array(mysql_query("SELECT MAX(LOANID) FROM fna_loan WHERE LOTNO = '".$LOTNO."'"));
									$MaxLoanFlag	= $LoanFlag_Qry['MAX(LOANID)'];
									
									
									$Loan_Query 	= "SELECT 	p.LOANDATE,
																p.PARTYID,
																p.LOANTYPEID,
																p.LOAN_PAYMENTDATE,
																p.LOANAMOUNT,
																p.PRINCIPALAMOUNT,
																p.RESTOFTHE_AMOUNT,
																p.LOANPAYMENT,
																p.INTERESTAMOUNT,
																p.LOAN_BALANCE,
																p.ENTRYDATE
															FROM fna_loan p
															WHERE p.PROJECTID = '".$PROJECTID."'
															AND p.ENTRYSERIALNOID = '".$ENTRYSERIALNOID."'
															ORDER BY p.LOANID DESC
															
														";
									$Loan_QueryStatement						= mysql_query($Loan_Query);
									$sl = 1;
									$LOANAMOUNT			= 0;
									$PRINCIPALAMOUNT		= 0;
									$RESTOFTHE_AMOUNT		= 0;
									$LOANPAYMENT			= 0;
									$INTERESTAMOUNT		= 0;
									$LOANTYPEID		= 0;
									while($Loan_QueryStatementData				= mysql_fetch_array($Loan_QueryStatement)){	
										$LOANDATE								= $Loan_QueryStatementData['LOANDATE'];
										$PARTYID								= $Loan_QueryStatementData['PARTYID'];
										$LOANTYPEID								= $Loan_QueryStatementData['LOANTYPEID'];
										$LOAN_PAYMENTDATE						= $Loan_QueryStatementData['LOAN_PAYMENTDATE'];
										$LOANAMOUNT								= $Loan_QueryStatementData['LOANAMOUNT'];
										$PRINCIPALAMOUNT						= $Loan_QueryStatementData['PRINCIPALAMOUNT'];
										$RESTOFTHE_AMOUNT						= $Loan_QueryStatementData['RESTOFTHE_AMOUNT'];
										$LOANPAYMENT							= $Loan_QueryStatementData['LOANPAYMENT'];
										$INTERESTAMOUNT							= $Loan_QueryStatementData['INTERESTAMOUNT'];
										$LOAN_BALANCE							= $Loan_QueryStatementData['LOAN_BALANCE'];
										$ENTRYDATE								= $Loan_QueryStatementData['ENTRYDATE'];
									}
									
									$CAR_LOAN				=0;
									$CAR_LOAN_PAYMENT		=0;
									$CAR_LOAN_INT			=0;
									$NORMAL_LOAN			=0;
									$NORMAL_LOAN_PAYMENT	=0;
									$NORMAL_LOAN_INT		=0;
									$NOR_LOAN_PRINCIPAL		=0;
									$CAR_LOAN_PRINCIPAL		=0;
									
									if ($LOANTYPEID==1){
										
										$CAR_LOAN			= $LOANAMOUNT;
										$CAR_LOAN_PAYMENT	= $LOANPAYMENT;
										$CAR_LOAN_PRINCIPAL	= $PRINCIPALAMOUNT;
										$CAR_LOAN_INT		= $INTERESTAMOUNT;
										
									}elseif($LOANTYPEID==3){
										
										$NORMAL_LOAN			= $LOANAMOUNT;
										$NORMAL_LOAN_PAYMENT	= $LOANPAYMENT;
										$NOR_LOAN_PRINCIPAL		= $PRINCIPALAMOUNT;
										$NORMAL_LOAN_INT		= $INTERESTAMOUNT;
										
									}else{
										$NORMAL_LOAN			= $LOANAMOUNT;
										$NORMAL_LOAN_PAYMENT	= $LOANPAYMENT;
										$NOR_LOAN_PRINCIPAL		= $PRINCIPALAMOUNT;
										$NORMAL_LOAN_INT		= $INTERESTAMOUNT;
										
									}
									
									$partySql 	= "
													SELECT PARTYNAME											
														FROM fna_party 
														WHERE PARTYID = '".$PARTYID."'
														
												";
									$partySqlStatement				= mysql_query($partySql);
									while($partySqlStatementData	= mysql_fetch_array($partySqlStatement)){
										$PARTYNAME        		= $partySqlStatementData["PARTYNAME"];
									}
									
									$ProdFareQry		 	= "
																SELECT UNITFARE											
																	FROM fna_productfare 
																	WHERE PROJECTID = '".$PROJECTID."'
																	AND SUBPROJECTID = '".$SUBPROJECTID."'
																	AND PRODUCTID = '".$PRODUCTID."'
																	AND PACKINGUNITID = '".$PACKINGUNITID."'
																	AND '".$ENTRYDATE_FROM."' BETWEEN STARTDATE AND ENDDATE
																";
									$ProdFareQryStatement				= mysql_query($ProdFareQry);
									$UNITFARE	=0;
									while($ProdFareQryStatementData		= mysql_fetch_array($ProdFareQryStatement)){
										$UNITFARE	        			= $ProdFareQryStatementData["UNITFARE"];
									}
									
									$BastaFlag_Qry	= mysql_fetch_array(mysql_query("SELECT MAX(BASTAID) FROM fna_basta WHERE LOTNO = '".$LOTNO."'"));
									$MaxBastaFlag	= $BastaFlag_Qry['MAX(BASTAID)'];
									
									$BastaQry		 	= "
																SELECT RECEIVEDAMOUNT											
																	FROM fna_basta 
																	WHERE LOTNO = '".$LOTNO."'
																	AND BASTAID = '".$MaxBastaFlag."'
																";
									$BastaQryStatement					= mysql_query($BastaQry);
									$RECEIVEDAMOUNT	=0;
									while($BastaQryStatementData		= mysql_fetch_array($BastaQryStatement)){
										$RECEIVEDAMOUNT       			= $BastaQryStatementData["RECEIVEDAMOUNT"];
									}
									
									$Total_Fare				= $UNLOADQUANTITY * $UNITFARE ; 
									$Labpur_Extra_Charge	= $UNLOADQUANTITY * 5;
									$Net_Payable			= $Total_Fare + $CAR_LOAN_PRINCIPAL + $CAR_LOAN_INT + $NOR_LOAN_PRINCIPAL + $NORMAL_LOAN_INT + $RECEIVEDAMOUNT + $Labpur_Extra_Charge ; 
									
									//$totprice_eggsell_global = $totprice_eggsell_global + $totprice_eggsell ;	
									//-----------------------------------------------------------------
									
									//if($Pur_Bill_Balance == 0 and $Sell_Bill_Balance == 0){
			/*
									$tableView .=" <tr>
														<td align='center' valign='top' style='border: 1px dotted #000'>$sl</td>
			
														<td align='center' valign='top' style='border: 1px dotted #000'> $PARTYNAME</td>
														
														<td align='center' valign='top' style='border: 1px dotted #000'> $ENTRYDATE</td>
								
														<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($CAR_LOAN,2)."</td>
														
														<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($CAR_LOAN_INT,2)."</td>
								
														<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($CAR_LOAN_PAYMENT,2)." </td>
								
														<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($NORMAL_LOAN,2)."</td>
														
														<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($NORMAL_LOAN_INT,2)."</td>
								
														<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($NORMAL_LOAN_PAYMENT,2)."</td>
								
														
													</tr>
			
												 ";
									
											// Dynamic Row End		  
								$sl++;
								}	*/
				
				

							$tableView .="		
											<tr>
					
												<td colspan='9' align='center' valign='top' style='border: 1px dotted #000'>
													<table width='80%'>
														  <tr align='center' style='font-weight:bold;'>
															<td style='border: 1px dotted #000'>Description</td>
															<td style='border: 1px dotted #000'>Quantity</td>
															<td style='border: 1px dotted #000'>Rate</td>
															<td style='border: 1px dotted #000'>Total Amount</td>
														  </tr>
														  <tr>
															<td style='border: 1px dotted #000'>Store Fare :</td>
															<td align='center' style='border: 1px dotted #000'>$UNLOADQUANTITY</td>
															<td align='right' style='border: 1px dotted #000'>".number_format($UNITFARE,2)."</td>
															<td align='right' style='border: 1px dotted #000'>".number_format($Total_Fare,2)."</td>
														  </tr>
														  <tr>
															<td style='border: 1px dotted #000'>Car Loan</td>
															<td style='border: 1px dotted #000'>&nbsp;</td>
															<td style='border: 1px dotted #000'>&nbsp;</td>
															<td align='right' style='border: 1px dotted #000'>".number_format($CAR_LOAN_PAYMENT,2)."</td>
														  </tr>
														  <tr>
															<td style='border: 1px dotted #000'>Car Loan Interest Amount:</td>
															<td style='border: 1px dotted #000'>&nbsp;</td>
															<td style='border: 1px dotted #000'>&nbsp;</td>
															<td align='right' style='border: 1px dotted #000'>".number_format($CAR_LOAN_INT,2)."</td>
														  </tr>
														  <tr>
															<td style='border: 1px dotted #000'>Basta Price:</td>
															<td style='border: 1px dotted #000'>&nbsp;</td>
															<td style='border: 1px dotted #000'>&nbsp;</td>
															<td align='right' style='border: 1px dotted #000'>".number_format($RECEIVEDAMOUNT,2)."</td>
														  </tr>
														  <tr>
															<td style='border: 1px dotted #000'>Labour Charge:</td>
															<td style='border: 1px dotted #000'>&nbsp;</td>
															<td style='border: 1px dotted #000'>&nbsp;</td>
															<td align='right' style='border: 1px dotted #000'>".number_format(($UNLOADQUANTITY * 5),2)."</td>
														  </tr>
														  <tr>
															<td style='border: 1px dotted #000'>Service Charge:</td>
															<td style='border: 1px dotted #000'>&nbsp;</td>
															<td style='border: 1px dotted #000'>&nbsp;</td>
															<td style='border: 1px dotted #000'>&nbsp;</td>
														  </tr>
														  <tr>
															<td style='border: 1px dotted #000'>Loan Amount:</td>
															<td style='border: 1px dotted #000'>&nbsp;</td>
															<td style='border: 1px dotted #000'>&nbsp;</td>
															<td align='right' style='border: 1px dotted #000'>".number_format($NORMAL_LOAN_PAYMENT,2)."</td>
														  </tr>
														  <tr>
															<td style='border: 1px dotted #000'>Loan Interest Amount:</td>
															<td style='border: 1px dotted #000'>&nbsp;</td>
															<td style='border: 1px dotted #000'>&nbsp;</td>
															<td align='right' style='border: 1px dotted #000'>".number_format($NORMAL_LOAN_INT,2)."</td>
														  </tr>
														  <tr>
															<td style='border: 1px dotted #000'>Commission:</td>
															<td style='border: 1px dotted #000'>&nbsp;</td>
															<td style='border: 1px dotted #000'>&nbsp;</td>
															<td style='border: 1px dotted #000'>&nbsp;</td>
														  </tr>
														  <tr>
															<td colspan='3' align='right' style='border: 1px dotted #000'>Net Payable:</td>
															<td align='right' style='border: 1px dotted #000'>".number_format($Net_Payable,2)."</td>
														  </tr>
														</table>
												</td>
					
											</tr>
											<tr>
					
												<td colspan='9' align='left' valign='top'>&nbsp;</td>
					
											</tr>
												
											<tr>
					
												<td colspan='9' align='left' valign='top' >&nbsp;</td>
					
											</tr>	
											<tr>
					
												<td colspan='9' align='left' valign='top' >&nbsp;</td>
					
											</tr>	
											<tr>
					
												<td colspan='9' align='left' valign='top' >
													<table width='100%' border='0' cellpadding='1' cellspacing='0' style='margin:0px auto 0px auto;font-size:100%;'>
													  <tr>
														<td align='right' width='20%' valign='bottom' ><hr width='150' ></td>
														<td align='right' width='20%' valign='bottom' ><hr width='150' ></td>
														<td align='right' width='20%' valign='bottom' ><hr width='150' ></td>
														<td width='20%' valign='bottom' ><hr width='150' ></td>
														<td width='20%' valign='bottom' ><hr width='150' ></td>
													  </tr>
													  <tr>
														<td align='center' valign='top'  ><b>Receiver Signature</b></td>
														<td align='center' valign='top'  ><b>Store Keeper</b></td>
														<td align='center' valign='top'  ><b>Cashier Signature</b></td>
														<td  align='center' valign='top'  ><b>AGM Signature</b></td>
														<td align='center' valign='top'  ><b>GM Signature</b></td>
													  </tr>
													 </table>
												</td>
					
											</tr>
											<tr>
					
												<td colspan='9' align='left' valign='top' >&nbsp;</td>
					
											</tr>
											";
											$tableView .="<table width='75%' border='0' cellpadding='1' cellspacing='0' style='margin:0px auto 0px auto;font-size:85%; border: 1px dotted #000'>
												<tr>
					
												<td colspan='9' align='left' valign='top' >&nbsp;</td>
					
												</tr>
												<tr>
					
												<td colspan='9' align='left' valign='top' >&nbsp;</td>
					
												</tr>
												 <tr>
													<td colspan='9' align='center' valign='middle' style='border: 1px dotted #000'>
														<center><b><font size=4>F N A Group Of Company</font></b></center>
														<center><b><font size=3>$SUBPROJECTNAME DO Report</FONT></b></center>
														<center><b><font size=2>Date : $ENTRYDATE_FROM </font></b></center>
													</td>
												  </tr> 
												   <tr>
														<td colspan='9' align='right' valign='middle' style='border: 1px dotted #000'>
															<center><b><font>Office Mob: 01718-058857 </b></center>
															<right><b><font>Customer Copy..</b></right>
															<center><b><font>DO No: $DONO </b></center>
														</td>
													  </tr>
													  <tr>
								
														<td colspan='9' align='left' valign='top'>
															<table width='100%' border='0' cellpadding='1' cellspacing='0' style='margin:0px auto 0px auto;font-size:100%;'>
																  <tr style='font-weight:bold;'>
																
																	<td width='15%' align='left' valign='top'>Party Name <b></td>
																	<td width='1%' align='center' valign='top'>:</td>
																	<td width='34%' align='left' valign='top'>$PARTYNAME</td>
																	<td width='20%' align='right' valign='top'>Lot No. <b></td>
																	<td width='1%' align='center' valign='top'>:</td>
																	<td width='29%' align='left' valign='top'>$LOTNO  /  $LOADQUANTITY_LOT</td>
																	
																  </tr>
																  <tr style='font-weight:bold;'>
																
																	<td width='15%' align='left' valign='top'>Address <b></td>
																	<td width='1%' align='center' valign='top'>:</td>
																	<td width='34%' align='left' valign='top'>$ADDRESS</td>
																	<td width='20%' align='right' valign='top'>Receiver Name <b></td>
																	<td width='1%' align='center' valign='top'>:</td>
																	<td width='29%' align='left' valign='top'>$REC_NAME</td>
																	
																  </tr>
																  <tr style='font-weight:bold;'>
																
																	<td width='15%' align='left' valign='top'>Mobile No <b></td>
																	<td width='1%' align='center' valign='top'>:</td>
																	<td width='34%' align='left' valign='top'>$MOBILE </td>
																	<td width='20%' align='right' valign='top'>Rec. Mobile <b></td>
																	<td width='1%' align='center' valign='top'>:</td>
																	<td width='29%' align='left' valign='top'>$REC_MOB</td>
																	
																  </tr>
																</table>
															
								
														</td>
								
													  </tr> ";
											
											$tableView .="		
											<tr>
					
												<td colspan='9' align='center' valign='top' style='border: 1px dotted #000'>
													<table width='80%'>
														  <tr align='center' style='font-weight:bold;'>
															<td style='border: 1px dotted #000'>Description</td>
															<td style='border: 1px dotted #000'>Quantity</td>
															<td style='border: 1px dotted #000'>Rate</td>
															<td style='border: 1px dotted #000'>Total Amount</td>
														  </tr>
														  <tr>
															<td style='border: 1px dotted #000'>Store Fare :</td>
															<td align='center' style='border: 1px dotted #000'>$UNLOADQUANTITY</td>
															<td align='right' style='border: 1px dotted #000'>".number_format($UNITFARE,2)."</td>
															<td align='right' style='border: 1px dotted #000'>".number_format($Total_Fare,2)."</td>
														  </tr>
														  <tr>
															<td style='border: 1px dotted #000'>Car Loan</td>
															<td style='border: 1px dotted #000'>&nbsp;</td>
															<td style='border: 1px dotted #000'>&nbsp;</td>
															<td align='right' style='border: 1px dotted #000'>".number_format($CAR_LOAN_PRINCIPAL,2)."</td>
														  </tr>
														  <tr>
															<td style='border: 1px dotted #000'>Car Loan Interest Amount:</td>
															<td style='border: 1px dotted #000'>&nbsp;</td>
															<td style='border: 1px dotted #000'>&nbsp;</td>
															<td align='right' style='border: 1px dotted #000'>".number_format($CAR_LOAN_INT,2)."</td>
														  </tr>
														  <tr>
															<td style='border: 1px dotted #000'>Basta Price:</td>
															<td style='border: 1px dotted #000'>&nbsp;</td>
															<td style='border: 1px dotted #000'>&nbsp;</td>
															<td align='right' style='border: 1px dotted #000'>".number_format($RECEIVEDAMOUNT,2)."</td>
														  </tr>
														  <tr>
															<td style='border: 1px dotted #000'>Labour Charge:</td>
															<td style='border: 1px dotted #000'>&nbsp;</td>
															<td style='border: 1px dotted #000'>&nbsp;</td>
															<td align='right' style='border: 1px dotted #000'>".number_format(($UNLOADQUANTITY * 5),2)."</td>
														  </tr>
														  <tr>
															<td style='border: 1px dotted #000'>Service Charge:</td>
															<td style='border: 1px dotted #000'>&nbsp;</td>
															<td style='border: 1px dotted #000'>&nbsp;</td>
															<td style='border: 1px dotted #000'>&nbsp;</td>
														  </tr>
														  <tr>
															<td style='border: 1px dotted #000'>Loan Amount:</td>
															<td style='border: 1px dotted #000'>&nbsp;</td>
															<td style='border: 1px dotted #000'>&nbsp;</td>
															<td align='right' style='border: 1px dotted #000'>".number_format($NOR_LOAN_PRINCIPAL,2)."</td>
														  </tr>
														  <tr>
															<td style='border: 1px dotted #000'>Loan Interest Amount:</td>
															<td style='border: 1px dotted #000'>&nbsp;</td>
															<td style='border: 1px dotted #000'>&nbsp;</td>
															<td align='right' style='border: 1px dotted #000'>".number_format($NORMAL_LOAN_INT,2)."</td>
														  </tr>
														  <tr>
															<td style='border: 1px dotted #000'>Commission:</td>
															<td style='border: 1px dotted #000'>&nbsp;</td>
															<td style='border: 1px dotted #000'>&nbsp;</td>
															<td style='border: 1px dotted #000'>&nbsp;</td>
														  </tr>
														  <tr>
															<td colspan='3' align='right' style='border: 1px dotted #000'>Net Payable:</td>
															<td align='right' style='border: 1px dotted #000'>".number_format($Net_Payable,2)."</td>
														  </tr>
														</table>
												</td>
					
											</tr>
											
											<tr>
					
												<td colspan='9' align='left' valign='top'>&nbsp;</td>
					
											</tr>
												
											<tr>
					
												<td colspan='9' align='left' valign='top' >&nbsp;</td>
					
											</tr>	
											<tr>
					
												<td colspan='9' align='left' valign='top' >&nbsp;</td>
					
											</tr>	
											<tr>
					
												<td colspan='9' align='left' valign='top' >
													<table width='100%' border='0' cellpadding='1' cellspacing='0' style='margin:0px auto 0px auto;font-size:100%;'>
													  <tr>
														<td align='right' width='20%' valign='bottom' ><hr width='150' ></td>
														<td align='right' width='20%' valign='bottom' ><hr width='150' ></td>
														<td align='right' width='20%' valign='bottom' ><hr width='150' ></td>
														<td width='20%' valign='bottom' ><hr width='150' ></td>
														<td width='20%' valign='bottom' ><hr width='150' ></td>
													  </tr>
													  <tr>
														<td align='center' valign='top'  ><b>Receiver Signature</b></td>
														<td align='center' valign='top'  ><b>Store Keeper</b></td>
														<td align='center' valign='top'  ><b>Cashier Signature</b></td>
														<td  align='center' valign='top'  ><b>AGM Signature</b></td>
														<td align='center' valign='top'  ><b>GM Signature</b></td>
													  </tr>
													 </table>
												</td>
					
											</tr>
											<tr>
					
												<td colspan='9' align='left' valign='top' >&nbsp;</td>
					
											</tr>
											
										</table>";
			echo $tableView;

?>