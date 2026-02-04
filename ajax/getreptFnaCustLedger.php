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
		$con = "AND plubkdn.PRODCATTYPEID='".$PRODCATTYPEID."' ";
		}

		$Last_Date = date_create($ENTRYDATE_TO);
		date_sub($Last_Date, date_interval_create_from_date_string('1 days'));
		$LastDay = date_format($Last_Date, 'Y-m-d');

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
	$tableView .="<table width='100%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:85%; border: 1px dotted #000'>

					  <tr>
                            <td style='text-align:right;' colspan='20'>
                            <a href='javascript:Clickheretoprint()'><img border='0' src='images/print_icon.jpg' width='40' height='26' /></a>                        
                            </td>
                     </tr>
					  <tr>
						<td colspan='20' align='center' valign='middle' style='border: 1px dotted #000'>
							<center><b><font size=5>F N A Group Of Company</font></b></center>
							<center>&nbsp;</center>
							<center><b><font size=4>Customer Ledger (Alu)</FONT></b></center>
							<center>&nbsp;</center>
							<center><b><font size=2>Date : $ENTRYDATE_FROM to $ENTRYDATE_TO </font></b></center>
						</td>
					  </tr>
					  <tr>

						<td colspan='20' align='left' valign='top'>
							<table width='100%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:100%;'>
								  <tr>
								
									<td width='14%' align='left' valign='top'>Party Name<b></td>
									<td width='1%' align='center' valign='top'>:</td>
									<td width='34%' align='left' valign='top'> $PARTYNAME</td>
									<td width='18%' align='right' valign='top'>&nbsp;</td>
									<td width='1%' align='center' valign='top'>&nbsp;</td>
									<td width='20%' align='left' valign='top'>&nbsp;</td>
									<td align='left' valign='top'>&nbsp;</td>
								
								  </tr>
								
								  <tr>
								
									<td align='left' valign='top'>Address</td>
									<td align='center' valign='top'>:</td>
								
									<td align='left' valign='top'> $ADDRESS </td>
									<td align='right' valign='top'>&nbsp;</td>
									<td align='center' valign='top'>&nbsp;</td>
									<td align='left' valign='top'>&nbsp;</td>
									<td align='left' valign='top'> &nbsp;</td>
								
								  </tr>
								
								  <tr>
								
									<td align='left' valign='top'>Party Father Name</td>
									<td align='center' valign='top'>:</td>
								
									<td align='left' valign='top'>$FATHERNAME </td>
									<td align='right' valign='top'>&nbsp;</td>
									<td align='center' valign='top'>&nbsp;</td>
									<td align='left' valign='top'>&nbsp;</td>
									<td align='left' valign='top'>&nbsp;</td>
								
								  </tr>
								
								  <tr>
								
									<td align='left' valign='top'>Mobile</td>
									<td align='center' valign='top'>:</td>
								
									<td align='left' valign='top'>$MOBILE </td>
									<td align='right' valign='top'>&nbsp;</td>
									<td align='center' valign='top'>&nbsp;</td>
									<td align='left' valign='top'>&nbsp;</td>
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

						<td align='center' valign='middle' style='font-weight:bold;border: 1px dotted #000'>SL No.</td>

						<td align='center' valign='middle'  style='border: 1px dotted #000'>Date</td>
                        
                        <td align='center' valign='middle'  style='border: 1px dotted #000'>Lot No</td>

						<td align='center' valign='middle' style='border: 1px dotted #000'>DO No</td>

						<td align='center' valign='middle' style='border: 1px dotted #000'>IN </td>

						<td align='center' valign='middle' style='border: 1px dotted #000'>OUT </td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Balance</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Unit Price</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Car Dr.</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Car Cr.</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Balance</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Basta</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Labour Unit Pr.</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Lab Dr.</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Lab Cr.</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Balance</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Total</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Taka</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Taka Cr.</td>
						
						<td align='center' valign='middle' style='border: 1px dotted #000'>Balance Taka</td>

					  </tr>";

// Query here.

						//$TOTAL_RECEIVE_QNTY_KG ='';
						$PREV_KG_LOAD_TODAY = '';
						$PREV_KG			= '';
						$PREV_KG_UNLOAD		= '';
						$PREV_KG_UNLOAD_TODAY = '';
						$PACKINGNAME_LOAD	=	'';
							
							echo 'komol';
							$basicQuery 	= "SELECT	
													DISTINCT lc.LOTNO,
													lc.PROJECTID,
													lc.SUBPROJECTID,
													lc.PARTYID,
													lc.ENTRYDATE,
													alustck.PRODUCTID,
													alustck.LOTTOTQNTY,
													alustck.QUANTITY,
													alustck.PARTYTOTQNTY,
													alustck.WORKTYPEFLAG,
													pf.UNITFARE			
											FROM fna_productloadunload lc, fna_alustock alustck, fna_productloadunloadbkdn bkdn, fna_productfare pf
											WHERE lc.LOTNO = alustck.LOTNO
											AND bkdn.PRODUCTLOADUNLOADID = lc.PRODUCTLOADUNLOADID
											AND bkdn.PRODUCTLOADUNLOADBKDNID = alustck.PRODUCTLOADUNLOADBKDNID
											AND alustck.PRODUCTID = pf.PRODUCTID
											AND lc.PARTYID = '".$PARTYID."' 
											AND lc.PROJECTID =  '".$PROJECTID."'
											AND lc.SUBPROJECTID = '".$SUBPROJECTID."'
											AND lc.ENTRYDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
											ORDER BY lc.ENTRYDATE ASC
										";
							$basicQueryStatement			= mysql_query($basicQuery);
							$sl = 1;
							$globalReceQnty = 0;
							$globalDelevQnty = 0;
							$RECEIVEAMOUNT ='';
							
							while($basicQueryStatementData	= mysql_fetch_array($basicQueryStatement)){
								
								$LotNo		 		= $basicQueryStatementData['LOTNO'];
								$QUANTITY_ALU 		= $basicQueryStatementData['QUANTITY'];
								$WORKTYPEFLAG 		= $basicQueryStatementData['WORKTYPEFLAG'];
								$LOTTOTQNTY 		= $basicQueryStatementData['LOTTOTQNTY'];
								$ENTRYDATE_ALU		= $basicQueryStatementData['ENTRYDATE'];
								$UNITFARE			= $basicQueryStatementData['UNITFARE'];
								
								
								
								$LOAD_QNTY		=0;
								$UNLOAD_QNTY	=0;
								
								$LOAD_QNTY_TODAY			=0;
								$UNLOAD_QNTY_TODAY			=0;
										
										
								if($WORKTYPEFLAG == 'Load'){
									$LOAD_QNTY		= $QUANTITY_ALU;
									$UNLOAD_QNTY	=0;
									}else{
									$LOAD_QNTY		=0;
									$UNLOAD_QNTY	= $QUANTITY_ALU;
									}
								$globalReceQnty 	= $globalReceQnty + $LOAD_QNTY ; 
								$globalDelevQnty 	= $globalDelevQnty + $UNLOAD_QNTY ; 
								$Balance_Qnty = $globalReceQnty - $globalDelevQnty ;
							
							 // Dynamic Row Start

						$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000'>$sl</td>

											<td align='center' valign='top' style='border: 1px dotted #000'> $ENTRYDATE_ALU </td>
					
											<td align='center' valign='top'  style='border: 1px dotted #000'>$LotNo</td>
											
											<td align='center' valign='top'  style='border: 1px dotted #000'>&nbsp;</td>
					
											<td align='center' valign='top' style='border: 1px dotted #000'>$LOAD_QNTY</td>
					
											<td align='center' valign='top' style='border: 1px dotted #000'>$UNLOAD_QNTY</td>
					
											<td align='center' valign='top' style='border: 1px dotted #000'>$LOTTOTQNTY</td>
					
											<td align='center' valign='top' style='border: 1px dotted #000'>$UNITFARE</td>
											
											<td align='center' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

											<td align='center' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
					
											<td align='center' valign='top'  style='border: 1px dotted #000'>&nbsp;</td>
					
											<td align='center' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
					
											<td align='center' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
					
											<td align='center' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
											
											<td align='center' valign='top'  style='border: 1px dotted #000'>&nbsp;</td>
					
											<td align='center' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
					
											<td align='center' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
					
											<td align='center' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
											
											<td align='center' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
					
											<td align='center' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
											
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
							
							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top'  style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>


						</tr>
						<tr>

							<td colspan='20' align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

						</tr>
							
						<tr>

							<td colspan='20' align='left' valign='top'>&nbsp;</td>

						</tr>
						<tr>

							<td colspan='20' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='20' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='20' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='20' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='20' align='left' valign='top' >
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

							<td colspan='20' align='left' valign='top' >&nbsp;</td>

						</tr>
						<tr>

							<td colspan='20' align='left' valign='top' >&nbsp;</td>

						</tr>					

					</table>";
	echo $tableView;

?>