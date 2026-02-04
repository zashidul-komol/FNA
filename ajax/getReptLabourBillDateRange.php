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
	/*//$tran	 			= $_REQUEST['all'];
	//echo "<pre>"; print_r($tran);
	$load	 			= $_REQUEST['tranLoad'];
	$unload	 			= $_REQUEST['tranUnload'];
	$transfer 			= $_REQUEST['tranTransfer'];
	$palot	 			= $_REQUEST['tranPalot'];
	$all	 			= $_REQUEST['tranAll'];
	$whereQ = '';
	$whereQQ = '';	
	//echo rtrim($whereQ); die();
	//$whereQ = '';
	if($all!=''){
		$whereQ = "AND b.WORKTYPEFLAG IN ('Load','Unload', 'Transfer','Palot')"; 
		
		}else{
					if($load != ''){
						$whereQQ .= "'Load',"; 	
					}if($unload != ''){
						$whereQQ .= "'Unload',"; 	
					}if($transfer != ''){
						$whereQQ .= "'Transfer',"; 	
					}if($palot != ''){
						$whereQQ .= "'Palot',"; 	
					}
				$exp = explode(",",$whereQQ);
				$count = sizeof($exp);
				
				$c = 1; 
				$count = $count-1;
				foreach($exp as $keyVal){
					if($count == $c){
						$whereQ .= $keyVal;
						break;
					}else{
						$whereQ .= $keyVal.",";
						}
					
					$c++;
				}
		  
		  $whereQ = "AND b.WORKTYPEFLAG IN ($whereQ)"; 
			
		}
	*/
	$PROJECTID 				= $_REQUEST['PROJECTID'];
	$SUBPROJECTID			= $_REQUEST['SUBPROJECTID'];
	$PRODCATTYPEID_FORM		= $_REQUEST['PRODCATTYPEID'];
	$LOADTYPE				= $_REQUEST['LOADTYPE'];
	$ENTRYDATE_FROM 		= showDateMySQlFormat($_REQUEST['ENTRYDATE']);
	$ENTRYDATE_TO 			= showDateMySQlFormat($_REQUEST['ENTRYDATE2']);
	$userId 				= $_REQUEST['userId'];
	
	if ($PROJECTID == 'All'){
		$con = '';
	}else
	{
		$con = "plu.PROJECTID='".$PROJECTID."' ";
		}
		
		$SubProjSql 	= "
							SELECT sp.SUBPROJECTNAME											
							FROM fna_subproject sp
							WHERE sp.SUBPROJECTID = '".$SUBPROJECTID."'
						";
			$SubProjSqlStatement				= mysql_query($SubProjSql);
			while($SubProjSqlStatementData		= mysql_fetch_array($SubProjSqlStatement)){
				$SUBPROJECTNAME        			= $SubProjSqlStatementData["SUBPROJECTNAME"];
			}
		
		$CatTypeNameQry = "
								SELECT
										CATEGORYTYPENAME
								FROM
										fna_productcattype 
								WHERE PRODCATTYPEID = '".$PRODCATTYPEID_FORM."'
							";
			$CatTypeNameQryStatement					= mysql_query($CatTypeNameQry);
				while($CatTypeNameQryStatementData		= mysql_fetch_array($CatTypeNameQryStatement)) {
					$CATEGORYTYPENAME					= $CatTypeNameQryStatementData["CATEGORYTYPENAME"];	
				}

	$tableView = "";	
	$tableView .="<table width='70%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:85%; border: 1px dotted #000'>

					  <tr>
                            <td style='text-align:right;' colspan='13'>
                            <a href='javascript:Clickheretoprint()'><img border='0' src='images/print_icon.jpg' width='40' height='26' /></a>                        
                            </td>
                     </tr>
					  <tr>
						<td colspan='9' align='center' valign='middle' style='border: 1px dotted #000'>
							<center><b><font size=5>F N A Group of Company</font></b></center>
							<center>&nbsp;</center>
							<center><b><font size=4> Labour Bill Information </FONT></b></center>
							<center>&nbsp;</center>
							<center><font size=3> Date : $ENTRYDATE_FROM  To   $ENTRYDATE_TO</FONT></center>
							<center>&nbsp;</center>
							<center><font size=3> $SUBPROJECTNAME </FONT></center>
							
							
						</td>
					  </tr>
					  <tr>
								
									<td colspan='7' align='Center' valign='top'><font size=4> Labour Bill :  $CATEGORYTYPENAME  : $LOADTYPE    </font></td>
									
								  </tr>
					  

					  <tr style='font-weight:bold;'>

						<td align='center' valign='top' style='font-weight:bold;border: 1px dotted #000'>SL No.</td>

						<td align='center' valign='top'  style='border: 1px dotted #000'>Date</td>
						
						<td align='center' valign='top'  style='border: 1px dotted #000'>Labour Bill</td>
						
						<td align='center' valign='top'  style='border: 1px dotted #000'>Payment Amount</td>

						<td align='center' valign='top' style='border: 1px dotted #000'>Balance Amount </td>

												
					  </tr>";

// Query here.

							$aQuery 	= "	SELECT 	lwh.TOTBILLAMOUNT,
													plu.ENTRYDATE,
													lwh.PRODCATTYPEID,
													lwh.WORKTYPEFLAG
												FROM fna_productloadunload plu, fna_productloadunloadbkdn bkdn, fna_labourworkhistory lwh
												WHERE plu.PRODUCTLOADUNLOADID = bkdn.PRODUCTLOADUNLOADID
												AND bkdn.PRODUCTLOADUNLOADBKDNID = lwh.PRODUCTLOADUNLOADBKDNID
												AND plu.PROJECTID = '".$PROJECTID."'
												AND plu.SUBPROJECTID = '".$SUBPROJECTID."'
												AND lwh.WORKTYPEFLAG = '".$LOADTYPE."'
												AND lwh.PRODCATTYPEID = '".$PRODCATTYPEID_FORM."'
												AND plu.ENTRYDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
												ORDER BY plu.ENTRYDATE ASC
											"; 
									$sl	= 1;
									$Global_BillAmount =0;
									$Global_PaymentAmount = 0;
									$PAYMENTAMOUNT = 0;
									$aQueryStatement				= mysql_query($aQuery);
									while($aQueryStatementData		= mysql_fetch_array($aQueryStatement)) {
										
										$PRODCATTYPEID 				= $aQueryStatementData["PRODCATTYPEID"];
										$PAYMENTAMOUNT 				= $aQueryStatementData["PAYMENTAMOUNT"];
										$WORKTYPEFLAG   			= $aQueryStatementData["WORKTYPEFLAG"];
										$TOTBILLAMOUNT   			= $aQueryStatementData["TOTBILLAMOUNT"];
										$ENTRYDATE		   			= $aQueryStatementData["ENTRYDATE"];
										
										
											

								$Global_BillAmount		=	$Global_BillAmount + $TOTBILLAMOUNT ; 	
								$Global_PaymentAmount	=	$Global_PaymentAmount + $PAYMENTAMOUNT ; 
							//----------------------------------------Dynamic Row Start----------------------------------------------------

						$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000'>$sl</td>

											<td align='center' valign='top' style='border: 1px dotted #000'>$ENTRYDATE</td>
					
											<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($TOTBILLAMOUNT,2)."</td>
											
											<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($PAYMENTAMOUNT,2)."</td>
											
											<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format(0,2)."</td>
					
											
										</tr>

									 ";

								// Dynamic Row End		  
					$sl++;
					}	
				
				
				

					$tableView .="
					
						<tr style='font-weight:bold;'>

							<td align='right' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='center' valign='top'  style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='right' valign='top'  style='border: 1px dotted #000'>".number_format($Global_BillAmount,2)."</td>

							<td align='right' valign='top' style='border: 1px dotted #000'>".number_format($Global_PaymentAmount,2)."</td>

							<td align='center' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
							
						</tr>

						
						<tr>

							<td colspan='9' align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

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

							<td colspan='9' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='9' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='9' align='left' valign='top' >
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

							<td colspan='9' align='left' valign='top' >&nbsp;</td>

						</tr>
						<tr>

							<td colspan='9' align='left' valign='top' >&nbsp;</td>

						</tr>					

					</table>";
	echo $tableView;

?>