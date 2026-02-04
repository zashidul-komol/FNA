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
	$userId 			= $_REQUEST['userId'];
	
	
	$ProjectSql 	= "
							SELECT PROJECTNAME											
							FROM fna_project
							WHERE PROJECTID = $PROJECTID
						";
			$ProjectSqlStatement				= mysql_query($ProjectSql);
			while($ProjectSqlStatementData		= mysql_fetch_array($ProjectSqlStatement)){
				$PROJECTNAME       				= $ProjectSqlStatementData["PROJECTNAME"];
			}
			
			$SubProjectSql 	= "
							SELECT SUBPROJECTNAME											
							FROM fna_subproject
							WHERE SUBPROJECTID = $SUBPROJECTID
						";
			$SubProjectSqlStatement				= mysql_query($SubProjectSql);
			while($SubProjectSqlStatementData	= mysql_fetch_array($SubProjectSqlStatement)){
				$SUBPROJECTNAME    				= $SubProjectSqlStatementData["SUBPROJECTNAME"];
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
							<center><b><font size=4> Product Fare Information </FONT></b></center>
							<center>&nbsp;</center>
							
						</td>
					  </tr>
					  <tr>

						<td colspan='9' align='left' valign='top'>
							<table width='100%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:100%;'>
								  <tr>
								
									<td width='14%' align='left' valign='top'>Project Name<b></td>
									<td width='1%' align='center' valign='top'>:</td>
									<td width='34%' align='left' valign='top'> $PROJECTNAME</td>
									<td width='18%' align='right' valign='top'>&nbsp;</td>
									<td width='1%' align='center' valign='top'>&nbsp;</td>
									<td width='20%' align='left' valign='top'>&nbsp;</td>
									<td align='left' valign='top'>&nbsp;</td>
								
								  </tr>
								
								  <tr>
								
									<td align='left' valign='top'>Sub Project Name</td>
									<td align='center' valign='top'>:</td>
								
									<td align='left' valign='top'> $SUBPROJECTNAME </td>
									<td align='right' valign='top'>&nbsp;</td>
									<td align='center' valign='top'>&nbsp;</td>
									<td align='left' valign='top'>&nbsp;</td>
									<td align='left' valign='top'> &nbsp;</td>
								
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

						<td align='center' valign='top' style='font-weight:bold;border: 1px dotted #000'>SL No.</td>

						<td align='center' valign='top'  style='border: 1px dotted #000'>Product Name</td>
						
						<td align='center' valign='top'  style='border: 1px dotted #000'>Packing Unit</td>
						
						<td align='center' valign='top'  style='border: 1px dotted #000'>Start Date</td>
						
						<td align='center' valign='top'  style='border: 1px dotted #000'>End Date</td>

						<td align='center' valign='top' style='border: 1px dotted #000'>Fare</td>
								
					  </tr>";

// Query here.


						//-----------------------------------------------------------------------------------------
								$ProductFareQuery 	= "
															SELECT
																	PRODCATTYPEID,
																	PRODUCTID,
																	PACKINGUNITID,
																	UNITFARE,
																	STARTDATE,
																	ENDDATE
															FROM
																	fna_productfare 
															WHERE PROJECTID = '".$PROJECTID."'
															AND SUBPROJECTID = '".$SUBPROJECTID."'
															ORDER BY PRODUCTID ASC
															
														";
													
									$sl	= 1;
									$ProductFareQueryStatement				= mysql_query($ProductFareQuery);
									while($ProductFareQueryStatementData		= mysql_fetch_array($ProductFareQueryStatement)) {
										
										$PRODCATTYPEID   			= $ProductFareQueryStatementData["PRODCATTYPEID"];
										$PRODUCTID   				= $ProductFareQueryStatementData["PRODUCTID"];
										$PACKINGUNITID		   		= $ProductFareQueryStatementData["PACKINGUNITID"];
										$UNITFARE				   	= $ProductFareQueryStatementData["UNITFARE"];
										$STARTDATE		   			= $ProductFareQueryStatementData["STARTDATE"];
										$ENDDATE			   		= $ProductFareQueryStatementData["ENDDATE"];
										
									
									
									$ProductQuery 	= "SELECT 	PRODUCTNAME 
													FROM fna_product 
													WHERE PROJECTID = '".$PROJECTID."' 
													AND SUBPROJECTID = '".$SUBPROJECTID."'
													AND PRODUCTID	= '".$PRODUCTID."'
												";
									$ProductQueryStatement				= mysql_query($ProductQuery);
									$PRODUCTNAME = '';
									while($ProductQueryStatementData	= mysql_fetch_array($ProductQueryStatement)){
										$PRODUCTNAME        			= $ProductQueryStatementData["PRODUCTNAME"]; 
								}
								//-----------------------------------------------------------------------------------------
								$packingNameVal 	= '';
								$packingViewQuery 	= "
														SELECT
																pu.PACKINGUNITID,
																pn.PACKINGNAME,
																q.QVALUE,
																w.WNAME
														FROM
																fna_packingunit pu , fna_packingname pn, fna_quantity q, fna_weight w
														WHERE pu.PACKINGUNITID = $PACKINGUNITID
														AND pu.PACKINGNAMEID = pn.PACKINGNAMEID
														AND pu.QID = q.QID
														AND pu.WTID = w.WTID
														ORDER BY
																pu.PACKINGUNITID
														ASC
													";
													
								$packingViewQueryStatement				= mysql_query($packingViewQuery);
								while($packingViewQueryStatementData	= mysql_fetch_array($packingViewQueryStatement)) {
									
									$PACKINGNAME   			= $packingViewQueryStatementData["PACKINGNAME"];
									$QVALUE			   		= $packingViewQueryStatementData["QVALUE"];
									$WNAME			   		= $packingViewQueryStatementData["WNAME"];
								}
								$Basta_QUANTITY= '';
								$Drum_QUANTITY= '';
								$cortun_QUANTITY= '';
								$Basta_QVALUE = '';
								$Drum_QVALUE = '';
								$Cartoon_QVALUE = '';
										
								
								if ($PACKINGNAME == 'Basta')
								{
									$PackNameSize = "$QVALUE"."-"."$WNAME"."-"."$PACKINGNAME";
									
								}elseif($PACKINGNAME == 'Drum')
								{	
									$PackNameSize = "$QVALUE"."-"."$WNAME"."-"."$PACKINGNAME";
								}else
								{
									$PackNameSize = "$QVALUE"."-"."$WNAME"."-"."$PACKINGNAME";
								}
							
							
						
							
							//-----------------------------------------------------------------

 // Dynamic Row Start

						$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000'>$sl</td>
											
											<td align='left' valign='top'  style='border: 1px dotted #000'>$PRODUCTNAME</td>
											
											<td align='left' valign='top' style='border: 1px dotted #000'>$PackNameSize</td>
					
											<td align='center' valign='top'  style='border: 1px dotted #000'>$STARTDATE</td>
											
											<td align='center' valign='top'  style='border: 1px dotted #000'>$ENDDATE</td>
					
											<td align='center' valign='top' style='border: 1px dotted #000'>$UNITFARE </td>
					
																					
										</tr>

									 ";

								// Dynamic Row End		  
					$sl++;
					}	
				
				
				

					$tableView .="
					
						<tr>

							<td colspan='9' align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

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