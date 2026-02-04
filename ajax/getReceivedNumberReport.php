<?php

	include('../config/dbinfo.inc.php');
	
function showDateMySQlFormat($date){
	
		$exp = explode("-",$date);				
		$mysqlDateF = $exp[2]."-".$exp[1]."-".$exp[0];
		
		return $mysqlDateF;
}

	$receivedNumber 	= $_REQUEST['receivedNumber'];
	$userId 			= $_REQUEST['userId'];

		//Ministry/Division and Project/Programme Name View Report Start				
	 	$psSql 	= "
							SELECT p.PARTYNAME, p.FATHERNAME, p.ADDRESS, p.MOBILE, plu.ENTRYDATE											
							FROM fna_productloadunload plu, fna_party p
							WHERE plu.PARTYID = p.PARTYID
							and plu.RECEIVENUMBER = $receivedNumber
						"; 
			$psSqlStatement			= mysql_query($psSql);
			while($psSqlStatementData	= mysql_fetch_array($psSqlStatement)){
				$PARTYNAME        			= $psSqlStatementData["PARTYNAME"];
				$FATHERNAME       = $psSqlStatementData["FATHERNAME"];
				$ADDRESS       = $psSqlStatementData["ADDRESS"];
				$MOBILE       = $psSqlStatementData["MOBILE"];
				$ENTRYDATE       = $psSqlStatementData["ENTRYDATE"];
			}
			
			//Ministry/Division and Project/Programme Name View Report End
			

	$tableView = "";	
	$tableView .="<table width='100%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:85%; border: 1px dotted #000'>

					  <tr>

						<td colspan='6' align='center' valign='middle' style='border: 1px dotted #000'>

							<center><b>FNA Received Information</b></center>

						</td>

					  </tr>

					  <tr>

						<td colspan='6' align='left' valign='top'>
							<table width='100%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:85%;'>
								  <tr>
								
									<td width='14%' align='left' valign='top'>Party Name<b></td>
									<td width='1%' align='center' valign='top'>:</td>
								
									<td width='34%' align='left' valign='top'> $PARTYNAME</td>
									<td width='18%' align='right' valign='top'>&nbsp;</td>
									<td width='1%' align='center' valign='top'>&nbsp;</td>
								
									<td width='32%' align='left' valign='top'>&nbsp;</td>
								
								  </tr>
								
								  <tr>
								
									<td align='left' valign='top'>Address</td>
									<td align='center' valign='top'>:</td>
								
									<td align='left' valign='top'> $ADDRESS </td>
									<td align='right' valign='top'>Received Date</td>
									<td align='center' valign='top'>:</td>
								
									<td align='left' valign='top'>$ENTRYDATE </td>
								
								  </tr>
								
								  <tr>
								
									<td align='left' valign='top'>Party Father Name</td>
									<td align='center' valign='top'>:</td>
								
									<td align='left' valign='top'>$FATHERNAME </td>
									<td align='right' valign='top'>&nbsp;</td>
									<td align='center' valign='top'>&nbsp;</td>
								
									<td align='left' valign='top'>&nbsp;</td>
								
								  </tr>
								
								  <tr>
								
									<td align='left' valign='top'>Mobile</td>
									<td align='center' valign='top'>:</td>
								
									<td align='left' valign='top'>$MOBILE </td>
									<td align='right' valign='top'>&nbsp;</td>
									<td align='center' valign='top'>&nbsp;</td>
								
									<td align='left' valign='top'>&nbsp;</td>
								
								  </tr>
								
								  <tr>
								
									<td align='left' valign='top'>&nbsp;</td>
									<td align='center' valign='top'>&nbsp;</td>
								
									<td align='left' valign='top'>&nbsp;</td>
									<td align='right' valign='top'>&nbsp;</td>
									<td align='center' valign='top'>&nbsp;</td>
								
									<td align='left' valign='top'>&nbsp;</td>
								
								  </tr>
								
								</table>
							

						</td>

					  </tr>

					  <tr>

						<td align='left' valign='top' style='border: 1px dotted #000'>Product Cat</td>

						<td align='left' valign='top'  style='border: 1px dotted #000'>Product name</td>

						<td align='left' valign='top' style='border: 1px dotted #000'>Quantity </td>

						<td align='left' valign='top' style='border: 1px dotted #000'>Packing Name</td>

						<td align='left' valign='top' style='border: 1px dotted #000'>Chamber </td>

						<td align='left' valign='top' style='border: 1px dotted #000'>Pocket </td>

					  </tr>";

// Query here.
							
							// Package Information View Report Start 	 <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<		
								$PARTYID 	= '';
								$ENTRYDATE 	= '';
								$CATEGORYTYPENAME 	= '';
								$PRODUCTNAME 	= '';
								$PACKINGUNITID   	= '';
								$QUANTITY 	= '';
								$CHNAME 	= '';
								$POCKET 	= '';
								$aViewQuery 	= "SELECT 
												  		plu.PARTYID,
														plu.ENTRYDATE,
														pct.CATEGORYTYPENAME,
														p.PRODUCTNAME,
														plubkdn.PACKINGUNITID,
														plubkdn.QUANTITY,
														c.CHNAME,
														plubkdn.POCKET
												FROM 
													fna_productloadunload plu, fna_productloadunloadbkdn plubkdn, fna_productcattype pct, fna_product p, fna_chamber c
												WHERE plu.PRODUCTLOADUNLOADID = plubkdn.PRODUCTLOADUNLOADID 
											    AND plu.RECEIVENUMBER = $receivedNumber
												AND plubkdn.PRODCATTYPEID = pct.PRODCATTYPEID 
												AND plubkdn.PRODUCTID = p.PRODUCTID 
												AND plubkdn.CHID = c.CHID 
												ORDER BY plubkdn.PRODCATTYPEID ASC";
								$aViewStatement			= mysql_query($aViewQuery);
								while($aViewStatementData	= mysql_fetch_array($aViewStatement)){ 
								
								 $PARTYID        		= $aViewStatementData["PARTYID"]; 
								 $ENTRYDATE        		= $aViewStatementData["ENTRYDATE"]; 
								 $CATEGORYTYPENAME      = $aViewStatementData["CATEGORYTYPENAME"]; 
								 $PRODUCTNAME       	= $aViewStatementData["PRODUCTNAME"]; 
								 $PACKINGUNITID       	= $aViewStatementData["PACKINGUNITID"]; 	
								 $QUANTITY         		= $aViewStatementData["QUANTITY"];
								 $CHNAME       			= $aViewStatementData["CHNAME"];
								 $POCKET       			= $aViewStatementData["POCKET"];
							
							// Package Information View Report End

 // Dynamic Row Start

						$tableView .=" <tr>

											<td align='left' valign='top' style='border: 1px dotted #000'> $CATEGORYTYPENAME</td>
					
											<td align='left' valign='top'  style='border: 1px dotted #000'>$PRODUCTNAME</td>
					
											<td align='left' valign='top' style='border: 1px dotted #000'>$QUANTITY </td>
					
											<td align='left' valign='top' style='border: 1px dotted #000'>$PACKINGUNITID</td>
					
											<td align='left' valign='top' style='border: 1px dotted #000'>$CHNAME </td>
					
											<td align='left' valign='top' style='border: 1px dotted #000'>$POCKET </td>
					
										  </tr>

									 ";

								// Dynamic Row End		  

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

					</table>";
	echo $tableView;

?>