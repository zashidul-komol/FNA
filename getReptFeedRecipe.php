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

	
		
	$FOODID 			= $_REQUEST['FOODID'];
	$ReqQnty 			= $_REQUEST['ReqQnty'];
	$userId 			= $_REQUEST['userId'];
	
		/*$Last_Date = date_create($ENTRYDATE_TO);
		date_sub($Last_Date, date_interval_create_from_date_string('1 days'));
		$LastDay = date_format($Last_Date, 'Y-m-d');*/

		//Ministry/Division and Project/Programme Name View Report Start				
	 $tableView = "";	
	$tableView .="<table width='50%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:85%; border: 1px dotted #000'>
					  <tr>
                            <td style='text-align:right;' colspan='18'>
                            <a href='javascript:Clickheretoprint()'><img border='0' src='images/print_icon.jpg' width='40' height='26' /></a>                        
                            </td>
                     </tr>
					  <tr>
						<td colspan='18' align='center' valign='middle' style='border: 1px dotted #000'>
							<center><b><font size=5>F N A Group Of Company</font></b></center>
							<center>&nbsp;</center>
							<center><b><font size=4>Feed Recipe Report</FONT></b></center>
							<center>&nbsp;</center>
							<center><b><font size=2>&nbsp;</font></b></center>
						</td>
					  </tr>
					  
					  <tr style='font-weight:bold;'>

						<td align='center' valign='middle' style='font-weight:bold;border: 1px dotted #000'>SL No.</td>

						<td align='center' valign='middle'  style='border: 1px dotted #000'>Product Name</td>
						
						<td align='center' valign='middle'  style='border: 1px dotted #000'>Qnty for 100 Kg</td>
						
						<td align='center' valign='middle'  style='border: 1px dotted #000'>Required Qnty </td>
						
						<td align='center' valign='middle'  style='border: 1px dotted #000'>Unit</td>
						
					</tr>";

// Query here.

							$Food_Name_Query = "SELECT   f.FOODNAME
													FROM feed_fooditem f
													WHERE f.FOODID = '".$FOODID."'
												";
							$Food_Name_QueryStatement			= mysql_query($Food_Name_Query);
							while($Food_Name_QueryStatementData	= mysql_fetch_array($Food_Name_QueryStatement)){	
								$FOODNAME	 					= $Food_Name_QueryStatementData['FOODNAME'];
								
							}	
							$recipe_Query 	= "SELECT   rec.RECIPIID,
															rbkdn.PRODUCTID,
															rbkdn.QUANTITY,
															rbkdn.WTID, 
															p.PRODUCTNAME, 
															wt.WNAME
													FROM feed_recipi rec, feed_recipi_bkdn rbkdn, fna_product p, fna_weight wt
													WHERE rec.RECIPIID = rbkdn.RECIPIID
													AND 	p.PRODUCTID = rbkdn.PRODUCTID
													AND wt.WTID = rbkdn.WTID
													AND rec.FOODID = '".$FOODID."'
												";
							$recipe_QueryStatement				= mysql_query($recipe_Query);
							$SL = 1;
							$Global_ReqQnty_Recepi	= 0;
							$Global_QUANTITY_recipe		= 0;
							while($recipe_QueryStatementData	= mysql_fetch_array($recipe_QueryStatement)){	
								$RECIPIID_recipe				= $recipe_QueryStatementData['RECIPIID'];
								$PRODUCTID_recipe				= $recipe_QueryStatementData['PRODUCTID'];
								$QUANTITY_recipe				= $recipe_QueryStatementData['QUANTITY'];
								$WTID_recipe					= $recipe_QueryStatementData['WTID'];
								$PRODUCTNAME_recipe				= $recipe_QueryStatementData['PRODUCTNAME'];
								$WNAME_recipe					= $recipe_QueryStatementData['WNAME'];
									
							    $ReqQnty_Recepi					= ($QUANTITY_recipe * $ReqQnty)/100 ;
								
								$Global_ReqQnty_Recepi			= $Global_ReqQnty_Recepi + $ReqQnty_Recepi ; 
								$Global_QUANTITY_recipe			= $Global_QUANTITY_recipe + $QUANTITY_recipe ; 
						$tableView .=" <tr>
											<td align='center' valign='top' style='border: 1px dotted #000'>$SL</td>

											<td align='center' valign='top'  style='border: 1px dotted #000'>$PRODUCTNAME_recipe</td>
											
											<td align='center' valign='top'  style='border: 1px dotted #000'>$QUANTITY_recipe</td>
											
											<td align='center' valign='top'  style='border: 1px dotted #000'>$ReqQnty_Recepi</td>
											
											<td align='center' valign='top'  style='border: 1px dotted #000'>$WNAME_recipe</td>
										</tr>

									 ";

								// Dynamic Row End		  

					$SL++;	
				
				}

					$tableView .="

						<tr style='font-weight:bold;'>

							<td align='center' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

							<td align='center' valign='top' style='border: 1px dotted #000'>&nbsp;</td>
							
							<td align='center' valign='top' style='border: 1px dotted #000'>$Global_QUANTITY_recipe</td>
							
							<td align='center' valign='top' style='border: 1px dotted #000'>$Global_ReqQnty_Recepi</td>
							
							<td align='right' valign='top' style='border: 1px dotted #000'>$WNAME_recipe</td>
							
						</tr>
						<tr>

							<td colspan='5' align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

						</tr>
							
						<tr>

							<td colspan='5' align='left' valign='top'>&nbsp;</td>

						</tr>
						<tr>

							<td colspan='5' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='5' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='5' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='5' align='left' valign='top' >&nbsp;</td>

						</tr>	
						<tr>

							<td colspan='5' align='left' valign='top' >
								<table width='100%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:100%;'>
								  <tr>
									<td align='right' width='20%' valign='bottom' ><hr width='200' ></td>
									<td width='20%' valign='bottom' ><hr width='200' ></td>
									<td width='20%' valign='bottom' ><hr width='200' ></td>
									<td width='20%' valign='bottom' ><hr width='200' ></td>
									<td width='20%' valign='bottom' ><hr width='200' ></td>
								  </tr>
								  <tr>
									<td align='center' valign='top'  ><b>Manager (Feed Mill) Signature</b></td>
									<td  align='center' valign='top'  ><b>Computer Operator</b></td>
									<td align='center' valign='top'  ><b>Manager(Finance) Signature</b></td>
									<td  align='center' valign='top'  ><b>AGM(Finance) Signature</b></td>
									<td align='center' valign='top'  ><b>GM Signature</b></td>
								  </tr>
								 </table>
							</td>

						</tr>
						<tr>

							<td colspan='5' align='left' valign='top' >&nbsp;</td>

						</tr>
						<tr>

							<td colspan='5' align='left' valign='top' >&nbsp;</td>

						</tr>					

					</table>";
	echo $tableView;

?>