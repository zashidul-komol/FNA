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
							<center><b><font size=4>Project Wise Profit & Loss Report</FONT></b></center>
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

					  </tr>
					  <tr style='font-weight:bold;'>

						<td rowspan=1' align='center' valign='middle' style='border: 1px dotted #000'>Project</td>

						<td colspan=1' align='center' valign='middle' style='border: 1px dotted #000'>Income</td>
						
						<td colspan='3' align='center' valign='middle' style='border: 1px dotted #000'>Expanse</td>

						<td colspan='1' align='center' valign='middle' style='border: 1px dotted #000'>Net Profit</td>
						
					  </tr>

					  <tr style='font-weight:bold;'>

						<td align='center' valign='middle' style='font-weight:bold;border: 1px dotted #000'>Sub Project Name</td>

						<td align='center' valign='middle'  style='border: 1px dotted #000'>Income</td>
                        
                        <td align='center' valign='middle'  style='border: 1px dotted #000'>Labour Bill</td>

						<td align='center' valign='middle' style='border: 1px dotted #000'>Expanse  </td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Total Expanse </td>

						<td align='center' valign='middle' style='border: 1px dotted #000'> Profit</td>
						
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
						$Global_Total_Expanse = 0;
						$Global_Receive_Amount = 0;
						$Global_NetProfit = 0;
						$Global_Amount_Exp = 0;	
						$Global_Billamount_lab = 0;
						
						while($ProjQueryStatementData	= mysql_fetch_array($ProjQueryStatement)){	
							$SUBPROJECTID_ARRAY[] 		= $ProjQueryStatementData['SUBPROJECTID'];
							$i++;
						}
						
						
						$SUBPROJECTID_ARRAY_UNIQUE = array_unique($SUBPROJECTID_ARRAY) ;
						foreach($SUBPROJECTID_ARRAY_UNIQUE as $individualSubProj){
						$RECEIVEAMOUNT = '';
							
						$PartyBill_Query 	= "SELECT sum(pb.RECEIVEAMOUNT) RECEIVEAMOUNT
												FROM fna_partybill pb 
												WHERE pb.PROJECTID = '".$PROJECTID."'
												AND pb.SUBPROJECTID = '".$individualSubProj."'
												AND pb.ENTRYDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."' 
												
											";
						$PartyBill_QueryStatement			= mysql_query($PartyBill_Query);
						while($PartyBill_QueryStatementData	= mysql_fetch_array($PartyBill_QueryStatement)){	
							$RECEIVEAMOUNT = $PartyBill_QueryStatementData['RECEIVEAMOUNT'];
							
						}	
						
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
												
											"; 
						$Exp_Bill_QueryStatement			= mysql_query($Exp_Bill_Query);
						while($Exp_Bill_QueryStatementData	= mysql_fetch_array($Exp_Bill_QueryStatement)){	
							$AMOUNT_exp		 				= $Exp_Bill_QueryStatementData['AMOUNT'];
							
						}
						
						$Total_Expanse 			= $AMOUNT_exp + $PAYMENTAMOUNT_lab;
						$NetProfit 				= $RECEIVEAMOUNT - $Total_Expanse ;
						$Global_Total_Expanse 	= $Global_Total_Expanse + $Total_Expanse ; 
						$Global_NetProfit		= $Global_NetProfit + $NetProfit ;
						$Global_Receive_Amount 	= $Global_Receive_Amount + $RECEIVEAMOUNT ; 
						$Global_Billamount_lab 	= $Global_Billamount_lab + $PAYMENTAMOUNT_lab ; 
						$Global_Amount_Exp 		= $Global_Amount_Exp + $AMOUNT_exp ; 
						$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000'>$SUBPROJECTNAME</td>

											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($RECEIVEAMOUNT,2)."</td>
					
											<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($PAYMENTAMOUNT_lab,2)."</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($AMOUNT_exp,2)."</td>
											
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Total_Expanse,2)."</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($NetProfit,2)."</td>
					
											
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

							<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($Global_Receive_Amount,2)."</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_Billamount_lab,2)."</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_Amount_Exp,2)."</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_Total_Expanse,2)."</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_NetProfit,2)."</td>
							
							
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
								  </tr>
								  <tr>
									<td align='center' valign='top'  ><b>Store Keeper Signature</b></td>
									<td  align='center' valign='top'  ><b>AGM Signature</b></td>
									<td align='center' valign='top'  ><b>GM Signature</b></td>
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