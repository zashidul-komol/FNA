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
	$ENTRYDATE_FROM 	= showDateMySQlFormat($_REQUEST['ENTRYDATE']);
	$ENTRYDATE_TO 		= showDateMySQlFormat($_REQUEST['ENTRYDATE2']);
	$userId 			= $_REQUEST['userId'];
	
		$Last_Date = date_create($ENTRYDATE_TO);
		date_sub($Last_Date, date_interval_create_from_date_string('1 days'));
		$LastDay = date_format($Last_Date, 'Y-m-d');

		//Ministry/Division and Project/Programme Name View Report Start				
	 	$projectSql 	= "
							SELECT  p.PROJECTNAME											
							FROM fna_project p
							WHERE p.PROJECTID = '".$PROJECTID."'
							
						";
			$projectSqlStatement				= mysql_query($projectSql);
			while($projectSqlStatementData		= mysql_fetch_array($projectSqlStatement)){
				$PROJECTNAME        			= $projectSqlStatementData["PROJECTNAME"];
				
			}
			
			//Ministry/Division and Project/Programme Name View Report End
			
	$tableView = "";	
	$tableView .="<table width='70%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:85%; border: 1px dotted #000'>

					  <tr>
                            <td style='text-align:right;' colspan='13'>
                            <a href='javascript:Clickheretoprint()'><img border='0' src='images/print_icon.jpg' width='40' height='26' /></a>                        
                            </td>
                     </tr>
					  <tr>
						<td colspan='18' align='center' valign='middle' style='border: 1px dotted #000'>
							<center><b><font size=5>F N A Group Of Company</font></b></center>
							<center>&nbsp;</center>
							<center><b><font size=4>Project Wise Details Balance Report</FONT></b></center>
							<center>&nbsp;</center>
							<center><b><font size=2>Date : $ENTRYDATE_FROM to $ENTRYDATE_TO </font></b></center>
						</td>
					  </tr>
					  <tr>

						<td colspan='18' align='left' valign='top'>
							<table width='100%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:100%;'>
								  <tr>
								
									<td width='14%' align='left' valign='top'>Project  Name<b></td>
									<td width='1%' align='center' valign='top'>:</td>
									<td width='34%' align='left' valign='top'><font size='+1'> $PROJECTNAME</font></td>
									<td width='18%' align='right' valign='top'>&nbsp;</td>
									<td width='1%' align='center' valign='top'>&nbsp;</td>
									<td width='20%' align='left' valign='top'>&nbsp;</td>
									<td align='left' valign='top'>&nbsp;</td>
								
								  </tr>
								
								  							
								  <tr>
								
									<td align='left' valign='top'>&nbsp;</td>
									<td align='center' valign='top'>&nbsp;</td>
								
									<td align='left' valign='top'>&nbsp;</td>
									<td align='right' valign='top'>&nbsp;</td>
									<td align='center' valign='top'>&nbsp;</td>
									<td align='left' valign='top'>&nbsp;</td>
									<td align='left' valign='top'>&nbsp;</td>
								
								  </tr>
								
								</table>
							

						</td>

					  <tr style='font-weight:bold;'>

						<td align='center' valign='middle' style='font-weight:bold;border: 1px dotted #000'>Sub Project Name</td>

						<td align='center' valign='middle'  style='border: 1px dotted #000'>Income</td>
                        
                        <td align='center' valign='middle'  style='border: 1px dotted #000'>Expanse</td>

						<td align='center' valign='middle' style='border: 1px dotted #000'>Payable</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Receivable </td>

						<td align='center' valign='middle' style='border: 1px dotted #000'> Balance </td>
						
					</tr>";

// Query here.

						//$TOTAL_RECEIVE_QNTY_KG ='';
						$SUBPROJECTID_ARRAY = array();
						$ProjQuery 	= "SELECT sp.SUBPROJECTID
												FROM fna_subproject sp 
												WHERE sp.PROJECTID = '".$PROJECTID."'
											"; 
						$ProjQueryStatement				= mysql_query($ProjQuery);
						$i = 0;
						$Balance				= 0;
						$Global_Total_Expanse = 0;
						$Global_Total_Income = 0;
						$Global_Receive_Amount = 0;
						$Global_NetProfit = 0;
						$Global_Amount_Exp = 0;	
						$Global_Billamount_lab = 0;
						$AMOUNT_exp_DanKhat_global = 0;
						$Global_Balance = 0;
						$Expanse_Amount_Cold = 0;
						
						while($ProjQueryStatementData	= mysql_fetch_array($ProjQueryStatement)){	
							$SUBPROJECTID_ARRAY[] 		= $ProjQueryStatementData['SUBPROJECTID'];
							$i++;
						}
						
						
						$SUBPROJECTID_ARRAY_UNIQUE = array_unique($SUBPROJECTID_ARRAY) ;
						
						$GrandTotal_Rec_Amount	= 0;
						$GrandTotal_Pay_Amount	= 0;
						
						foreach($SUBPROJECTID_ARRAY_UNIQUE as $individualSubProj){
						$RECEIVEAMOUNT 		=0;
						$PAYMENTAMOUNT		=0;
						$PURBILLAMOUNT		=0;
						$SELLBILLAMOUNT		=0;
						$Global_Rec_Amount	=0;	
						$Global_Pay_Amount	=0;
						$Rec_Amount 		= 0;
						$Pay_Amount	 		= 0;
						$Balance_Amount 	= 0;
						
						$PartyBill_Query 	= "SELECT 
														sum(pb.PUR_BILLAMOUNT) PURBILLAMOUNT,
														sum(pb.SELL_BILLAMOUNT) SELLBILLAMOUNT,
														sum(pb.RECEIVEAMOUNT) RECEIVEAMOUNT,
													  	sum(pb.PAYMENTAMOUNT) PAYMENTAMOUNT
												FROM fna_partybill pb 
												WHERE pb.PROJECTID = '".$PROJECTID."'
												AND pb.SUBPROJECTID = '".$individualSubProj."'
												AND pb.ENTRYDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."' 
												
											";
						$PartyBill_QueryStatement			= mysql_query($PartyBill_Query);
						while($PartyBill_QueryStatementData	= mysql_fetch_array($PartyBill_QueryStatement)){	
							$RECEIVEAMOUNT = $PartyBill_QueryStatementData['RECEIVEAMOUNT'];
							$PAYMENTAMOUNT = $PartyBill_QueryStatementData['PAYMENTAMOUNT'];
							$PURBILLAMOUNT = $PartyBill_QueryStatementData['PURBILLAMOUNT'];
							$SELLBILLAMOUNT = $PartyBill_QueryStatementData['SELLBILLAMOUNT'];
						}	
						
						$Balance_Amount		= $SELLBILLAMOUNT + $PAYMENTAMOUNT  - $PURBILLAMOUNT - $RECEIVEAMOUNT ; 
						if($Balance_Amount <= 0){
							$Pay_Amount		= $RECEIVEAMOUNT + $PURBILLAMOUNT  - $SELLBILLAMOUNT - $PAYMENTAMOUNT;
						}else{
							$Rec_Amount	= $SELLBILLAMOUNT + $PAYMENTAMOUNT  - $PURBILLAMOUNT - $RECEIVEAMOUNT ;
						}
					
						$Global_Rec_Amount = $Global_Rec_Amount + $Rec_Amount ; 
						$Global_Pay_Amount = $Global_Pay_Amount + $Pay_Amount ; 
						
								
						$subProjName_Query 	= "SELECT SUBPROJECTNAME
												FROM fna_subproject 
												WHERE SUBPROJECTID = '".$individualSubProj."'
											";
						$subProjName_QueryStatement			= mysql_query($subProjName_Query);
						while($subProjName_QueryStatementData	= mysql_fetch_array($subProjName_QueryStatement)){	
							$SUBPROJECTNAME = $subProjName_QueryStatementData['SUBPROJECTNAME'];
							
						}	
						
						$BILLAMOUNT_lab = '';
						$Total_Expanse = '';
						$NetProfit = '';
						$LabBill_Query 	= "SELECT sum(lb.BILLAMOUNT) BILLAMOUNT,
						 						  sum(lb.PAYMENTAMOUNT) PAYMENTAMOUNT
												FROM fna_labourbill lb 
												WHERE lb.PROJECTID = '".$PROJECTID."'
												AND lb.SUBPROJECTID = '".$individualSubProj."'
												AND lb.ENTRYDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'  
												
											"; 
						$LabBill_QueryStatement				= mysql_query($LabBill_Query);
						while($LabBill_QueryStatementData	= mysql_fetch_array($LabBill_QueryStatement)){	
							$BILLAMOUNT_lab 				= $LabBill_QueryStatementData['BILLAMOUNT'];
							$PAYMENTAMOUNT_lab 				= $LabBill_QueryStatementData['PAYMENTAMOUNT'];
							
						}
						
						$AMOUNT_exp = '';	
						$Exp_Bill_Query 	= "SELECT sum(exp.AMOUNT) AMOUNT
												FROM fna_expanse exp 
												WHERE exp.PROJECTID = '".$PROJECTID."'
												AND exp.SUBPROJECTID = '".$individualSubProj."'
												AND exp.EXPDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
												AND exp.STATUS = 'Active'
												ORDER BY exp.EXPDATE ASC 
												
											"; 
						$Exp_Bill_QueryStatement			= mysql_query($Exp_Bill_Query);
						while($Exp_Bill_QueryStatementData	= mysql_fetch_array($Exp_Bill_QueryStatement)){	
							$AMOUNT_exp		 				= $Exp_Bill_QueryStatementData['AMOUNT'];
							
						}
						
						$Income_Bill_Query 	= "SELECT sum(inc.AMOUNT) amount
													FROM fna_income inc 
													WHERE inc.PROJECTID = '".$PROJECTID."'
													AND inc.SUBPROJECTID = '".$individualSubProj."'
													AND inc.INDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
													AND inc.STATUS = 'Active'
													ORDER BY inc.INDATE ASC
												"; 
						$Income_Bill_QueryStatement					= mysql_query($Income_Bill_Query);
						while($Income_Bill_QueryStatementData		= mysql_fetch_array($Income_Bill_QueryStatement)){	
							$Others_Income	 						= $Income_Bill_QueryStatementData['amount'];
							
						}
						//-------------------------------Dan Khat-------------------------------------------
						
						
							
							$Madrasa_Query 	= "SELECT sum(balance.INCOME) INCOME,
													  sum(balance.EXPANSE) EXPANSE
													FROM fna_balance balance
													WHERE balance.PROJECTID = '".$PROJECTID."'
													AND  balance.SUBPROJECTID= '".$individualSubProj."'
													AND balance.BALDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
													
													
												";
							$Madrasa_QueryStatement						= mysql_query($Madrasa_Query);
							while($Madrasa_QueryStatementData			= mysql_fetch_array($Madrasa_QueryStatement)){	
								$INCOME									= $Madrasa_QueryStatementData['INCOME'];
								$EXPANSE								= $Madrasa_QueryStatementData['EXPANSE'];
								
							}	
							
							
						//----------------------------------------------------------------------------------
						
						$Loan_Query 	= "SELECT 	  sum(l.LOANAMOUNT) LOANAMNT,
														  sum(l.INTERESTAMOUNT) INTAMNT,
														  sum(l.LOANPAYMENT) LOANPAYMENTAMNT
												FROM fna_loan l
												WHERE l.PROJECTID = '".$PROJECTID."'
												AND l.SUBPROJECTID = '".$individualSubProj."'
												AND l.ENTRYDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."' 
												
											";
							$Loan_QueryStatement				= mysql_query($Loan_Query);
							while($Loan_QueryStatementData		= mysql_fetch_array($Loan_QueryStatement)){	
								$LOANAMOUNT_ALU					= $Loan_QueryStatementData['LOANAMNT'];
								$INTERESTAMOUNT_ALU				= $Loan_QueryStatementData['INTAMNT'];
								$LOANPAYMENT_ALU				= $Loan_QueryStatementData['LOANPAYMENTAMNT'];
								
							}
							
							$TOTLOANAMOUNT			= ($LOANAMOUNT_ALU + $INTERESTAMOUNT_ALU) - $LOANPAYMENT_ALU ; 
							
							$Booking_Query 	= "SELECT 	sum(book.BOOKINGMONEY) BOOKINGMONEY,
														sum(book.ADJUSTMENTMONEY) ADJUSTMENTMONEY
													FROM fna_alubooking book 
													WHERE book.PROJECTID = '".$PROJECTID."'
													AND book.SUBPROJECTID = '".$individualSubProj."'
													AND book.BOOKINGDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'  
													
												"; 
							$Booking_QueryStatement				= mysql_query($Booking_Query);
							$BOOKINGMONEY_ALU		=0;
							$ADJUSTMENTMONEY_ALU	=0;
							while($Booking_QueryStatementData	= mysql_fetch_array($Booking_QueryStatement)){	
								$BOOKINGMONEY_ALU				= $Booking_QueryStatementData['BOOKINGMONEY'];
								$ADJUSTMENTMONEY_ALU			= $Booking_QueryStatementData['ADJUSTMENTMONEY'];
								
							}
							
							$Commission_Query 	= "SELECT 	sum(comm.TOTALCOMMISSION) TOTALCOMMISSION
														FROM fna_alucommission comm 
													WHERE comm.PROJECTID = '".$PROJECTID."'
													AND comm.SUBPROJECTID = '".$individualSubProj."'
													AND comm.COMMDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'  
													
												"; 
							$Commission_QueryStatement				= mysql_query($Commission_Query);
							$TOTALCOMMISSION_ALU	=0;
							while($Commission_QueryStatementData	= mysql_fetch_array($Commission_QueryStatement)){	
								$TOTALCOMMISSION_ALU				= $Commission_QueryStatementData['TOTALCOMMISSION'];
								
							}
							
							
							
						//-------------------------------Dan Khat-------------------------------------------
						$Expanse_Amount_Cold	= $PAYMENTAMOUNT + $PAYMENTAMOUNT_lab;
						
						$Total_Income			= $RECEIVEAMOUNT + $Others_Income + $LOANPAYMENT_ALU + $BOOKINGMONEY_ALU; 
						$Total_Expanse 			= $PAYMENTAMOUNT + $AMOUNT_exp + $PAYMENTAMOUNT_lab + $LOANAMOUNT_ALU + $ADJUSTMENTMONEY_ALU + $TOTALCOMMISSION_ALU;;
						
						$Balance				= $Total_Income - $Total_Expanse ;
						
						$Global_Balance				= $Global_Balance + $Balance ;
						$Global_Total_Income		= $Global_Total_Income + $Total_Income ; 
						
						$NetProfit 				= $Total_Income - $Total_Expanse ;
						$Global_Total_Expanse 	= $Global_Total_Expanse + $Total_Expanse ; 
						$Global_NetProfit		= $Global_NetProfit + $NetProfit ;
						$Global_Receive_Amount 	= $Global_Receive_Amount + $RECEIVEAMOUNT ; 
						$Global_Billamount_lab 	= $Global_Billamount_lab + $BILLAMOUNT_lab ; 
						$Global_Amount_Exp 		= $Global_Amount_Exp + $AMOUNT_exp ; 
						
						$GrandTotal_Rec_Amount	= $GrandTotal_Rec_Amount + $Global_Rec_Amount ; 
						$GrandTotal_Pay_Amount	= $GrandTotal_Pay_Amount + $Global_Pay_Amount ; 
						
						$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000'>$SUBPROJECTNAME</td>

											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Total_Income,2)."</td>
					
											<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($Total_Expanse,2)."</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_Pay_Amount,2)."</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_Rec_Amount,2)."</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Balance,2)."</td>
					
											
										</tr>

									 ";

								// Dynamic Row End		  

						
				
				}

					$tableView .="
					
						<tr>

							<td colspan='6' align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

						</tr>

						<tr style='font-weight:bold;'>

							<td align='right' valign='top' style='border: 1px dotted #000'>Total:</td>

							<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($Global_Total_Income,2)."</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_Total_Expanse,2)."</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($GrandTotal_Pay_Amount,2)."</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($GrandTotal_Rec_Amount,2)."</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_Balance,2)."</td>
							
							
						</tr>
						<tr>

							<td colspan='6' align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

						</tr>
							
						<tr>

							<td colspan='6' align='left' valign='top'>&nbsp;</td>

						</tr>
						<tr>

							<td colspan='6' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='6' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='6' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='6' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='6' align='left' valign='top' >
								<table width='100%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:100%;'>
								  <tr>
									<td align='right' width='34%' valign='bottom' ><hr width='200' ></td>
									<td width='33%' valign='bottom' ><hr width='200' ></td>
									<td width='33%' valign='bottom' ><hr width='200' ></td>
									<td width='33%' valign='bottom' ><hr width='200' ></td>
									<td width='33%' valign='bottom' ><hr width='200' ></td>
								  </tr>
								  <tr>
									<td align='center' valign='top'  ><b>Asst. General Manager </b></td>
									<td  align='center' valign='top'  ><b>General Manager </b></td>
									<td align='center' valign='top'  ><b>Chief Executive Officer</b></td>
									<td align='center' valign='top'  ><b>Head of IT </b></td>
									<td align='center' valign='top'  ><b>Managing Director</b></td>
								  </tr>
								 </table>
							</td>

						</tr>
						<tr>

							<td colspan='6' align='left' valign='top' >&nbsp;</td>

						</tr>
						<tr>

							<td colspan='6' align='left' valign='top' >&nbsp;</td>

						</tr>					

					</table>";
	echo $tableView;

?>