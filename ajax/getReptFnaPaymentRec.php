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
	$PARTYID 			= $_REQUEST['PARTYID'];
	$PRODCATTYPEID		= $_REQUEST['PRODCATTYPEID'];
	$ENTRYDATE_FROM 	= showDateMySQlFormat($_REQUEST['ENTRYDATE']);
	$ENTRYDATE_TO 		= showDateMySQlFormat($_REQUEST['ENTRYDATE2']);
	$userId 			= $_REQUEST['userId'];
	$con = '';
	if ($PRODCATTYPEID == 'All'){
			$con = '';
		}else
		{
			$con = "AND pb.PRODCATTYPEID='".$PRODCATTYPEID."' ";
			}

		//Ministry/Division and Project/Programme Name View Report Start				
	 	$partySql 	= "
							SELECT p.PARTYNAME, p.FATHERNAME, p.ADDRESS, p.MOBILE											
							FROM fna_party p
							WHERE p.PARTYID = $PARTYID
						";
			$partySqlStatement				= mysql_query($partySql);
			while($partySqlStatementData	= mysql_fetch_array($partySqlStatement)){
				$PARTYNAME        		= $partySqlStatementData["PARTYNAME"];
				$FATHERNAME       		= $partySqlStatementData["FATHERNAME"];
				$ADDRESS       		= $partySqlStatementData["ADDRESS"];
				$MOBILE       			= $partySqlStatementData["MOBILE"];
			}
			
			//Ministry/Division and Project/Programme Name View Report End
			
	$tableView = "";	
	$tableView .="<table width='60%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:85%; border: 1px dotted #000'>

					  <tr>
						<td colspan='13' align='center' valign='middle' style='border: 1px dotted #000'>
							<center><b><font size=5>F N A Group Of Company</font></b></center>
							<center>&nbsp;</center>
							<center><b><font size=3>Payment Receive Information</FONT></b></center>
							<center>&nbsp;</center>
							<center><b><font size=2>Date : $ENTRYDATE_FROM to $ENTRYDATE_TO </font></b></center>
						</td>
					  </tr>
					  <tr>

						<td colspan='6' align='left' valign='top'>
							<table width='100%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:100%;'>
								  <tr>
								
									<td width='14%' align='left' valign='top'>Party Name<b></td>
									<td width='1%' align='center' valign='top'>:</td>
									<td width='34%' align='left' valign='top'> $PARTYNAME</td>
									<td width='18%' align='right' valign='top'>&nbsp;</td>
									
								  </tr>
								
								  <tr>
								
									<td align='left' valign='top'>Address</td>
									<td align='center' valign='top'>:</td>
								
									<td align='left' valign='top'> $ADDRESS </td>
									<td align='right' valign='top'>&nbsp;</td>
									
								  </tr>
								
								  <tr>
								
									<td align='left' valign='top'>Party Father Name</td>
									<td align='center' valign='top'>:</td>
								
									<td align='left' valign='top'>$FATHERNAME </td>
									<td align='right' valign='top'>&nbsp;</td>
									
								  </tr>
								
								  <tr>
								
									<td align='left' valign='top'>Mobile</td>
									<td align='center' valign='top'>:</td>
								
									<td align='left' valign='top'>$MOBILE </td>
									<td align='right' valign='top'>&nbsp;</td>
									
								  </tr>
								
								  <tr>
								
									<td align='left' valign='top'>&nbsp;</td>
									<td align='center' valign='top'>&nbsp;</td>
								
									<td align='left' valign='top'>&nbsp;</td>
									<td align='right' valign='top'>&nbsp;</td>
									
								  </tr>
								
								</table>
							

						</td>

					  </tr>

					  <tr style='font-weight:bold;'>

						<td align='center' valign='top' style='font-weight:bold;border: 1px dotted #000'>SL No.</td>

						<td align='center' valign='top'  style='border: 1px dotted #000'>Date</td>

						<td align='center' valign='top' style='border: 1px dotted #000'>Cheque Date </td>

						<td align='center' valign='top' style='border: 1px dotted #000'>Product Category</td>

						<td align='right' valign='top' style='border: 1px dotted #000'>Cheque Number </td>

						<td align='right' valign='top' style='border: 1px dotted #000'>Amount  </td>
						
					</tr>";

// Query here.


							
							// Package Information View Report Start 	 <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<		
								$CATEGORYTYPENAME 	= '';
								$glabalToatalBill = 0;
								$sl					=1;
								$aViewQuery 	= "SELECT 
												  		pb.PRODCATTYPEID,
														pb.RECEIVENUMBER,
														pb.RECEIVEAMOUNT,
														pb.ENTRYDATE,
														pb.CHEQUENUMBER,
														pb.CHEQUEDATE,
														cat.CATEGORYTYPENAME
												FROM 
													fna_partybill pb, fna_productcattype cat
												WHERE pb.PARTYID = '".$PARTYID."'
												AND pb.PROJECTID = '".$PROJECTID."'
												AND pb.SUBPROJECTID = '".$SUBPROJECTID."'
												AND cat.PRODCATTYPEID = pb.PRODCATTYPEID
												{$con}
												AND pb.ENTDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
												ORDER BY pb.PRODCATTYPEID ASC
											";
								$aViewStatement			= mysql_query($aViewQuery);
								while($aViewStatementData	= mysql_fetch_array($aViewStatement)){ 
								
								 $RECEIVEAMOUNT        	= $aViewStatementData["RECEIVEAMOUNT"];
								 $ENTRYDATE	        	= $aViewStatementData["ENTRYDATE"];
								 $CHEQUENUMBER        	= $aViewStatementData["CHEQUENUMBER"];
								 $CHEQUEDATE        	= $aViewStatementData["CHEQUEDATE"];
								 $RECEIVENUMBER        	= $aViewStatementData["RECEIVENUMBER"];
								 $CATEGORYTYPENAME      = $aViewStatementData["CATEGORYTYPENAME"]; 
								 
							// Package Information View Report End
							
							$glabalToatalBill = $glabalToatalBill + $RECEIVEAMOUNT ;
							
							
							//-----------------------------------------------------------------
							
 						// Dynamic Row Start

						$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000'>$sl</td>

											<td align='center' valign='top' style='border: 1px dotted #000'> $ENTRYDATE</td>
					
											<td align='center' valign='top'  style='border: 1px dotted #000'>$CHEQUEDATE</td>
					
											<td align='center' valign='top' style='border: 1px dotted #000'> $CATEGORYTYPENAME</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>$CHEQUENUMBER</td>
					
											<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($RECEIVEAMOUNT,2)."</td>
					
											
										</tr>

									 ";

								// Dynamic Row End		  
					$sl++;
					}	
				
				

					$tableView .="

						<tr>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top'  style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
							
							
						</tr>
						<tr>

							<td colspan='6' align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

						</tr>
						<tr>

							<td colspan='6' align='center' valign='top' >
								<table width='50%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:100%;'>
								  <tr>
									<td align='right' width='50%' style='border: 1px dotted #000'><b>Total Amount</b></td>
									<td width='2%' style='border: 1px dotted #000'>:</td>
									<td width='48%' style='border: 1px dotted #000'><b>".number_format($glabalToatalBill,2)."</b></td>
								  </tr>
								  
								</table>
							</td>

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
									<td align='center' valign='top'  ><b>Cashier Signature</b></td>
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