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
	$ENTRYDATE_FROM 	= showDateMySQlFormat($_REQUEST['ENTRYDATE']);
	$ENTRYDATE_TO 		= showDateMySQlFormat($_REQUEST['ENTRYDATE2']);
	$userId 			= $_REQUEST['userId'];

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
	$tableView .="<table width='70%' border='0' cellpadding='3' cellspacing='0' style='margin:0px auto 0px auto;font-size:85%; border: 1px dotted #000'>

					  <tr>
						<td colspan='7' align='center' valign='middle' style='border: 1px dotted #000'>
							<center><b><font size=5>F N A Group Of Company</font></b></center>
						</td>
					  </tr>
					  <tr>
						<td colspan='7' align='center' valign='middle' style='border: 1px dotted #000'>
							<center><b><font size=2>Product Receive Information</FONT></b></center>
						</td>
					  </tr>
					  <tr>
						<td colspan='7' align='center' valign='middle' style='border: 1px dotted #000'>
							<center><b><font size=3>Date : $ENTRYDATE_FROM &nbsp;&nbsp;&nbsp;   to  &nbsp;&nbsp;&nbsp; $ENTRYDATE_TO </font></b></center>
						</td>
					  </tr>

					  <tr>

						<td colspan='7' align='left' valign='top'>
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

					  <tr>

						<td align='left' valign='top' style='border: 1px dotted #000'>Date</td>

						<td align='left' valign='top'  style='border: 1px dotted #000'>Product Category</td>

						<td align='left' valign='top' style='border: 1px dotted #000'>Product name </td>

						<td align='left' valign='top' style='border: 1px dotted #000'>Receive Number</td>

						<td align='left' valign='top' style='border: 1px dotted #000'>Received Quantity </td>

						<td align='left' valign='top' style='border: 1px dotted #000'>Packing Unit  </td>
						
						<td align='left' valign='top' style='border: 1px dotted #000'>Total Quantity (KG)</td>

					  </tr>";

// Query here.
							
							// Package Information View Report Start 	 <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<		
								$CATEGORYTYPENAME 	= '';
								$PRODUCTNAME 	= '';
								$PACKINGUNITID   	= '';
								$QUANTITY 	= '';
								$aViewQuery 	= "SELECT 
												  		plu.PARTYID,
														plu.ENTRYDATE,
														plu.RECEIVENUMBER,
														pct.CATEGORYTYPENAME,
														p.PRODUCTNAME,
														plubkdn.PACKINGUNITID,
														plubkdn.QUANTITY
												FROM 
													fna_productloadunload plu, fna_productloadunloadbkdn plubkdn, fna_productcattype pct, fna_product p
												WHERE plu.PRODUCTLOADUNLOADID = plubkdn.PRODUCTLOADUNLOADID 
												AND plu.PARTYID = '".$PARTYID."'
												AND plu.PROJECTID = '".$PROJECTID."'
												AND plu.SUBPROJECTID = '".$SUBPROJECTID."'
												AND plu.RECEIVENUMBER != ''
											    AND plubkdn.PRODCATTYPEID = pct.PRODCATTYPEID 
												AND plubkdn.PRODUCTID = p.PRODUCTID 
												AND plu.ENTRYDATE BETWEEN '".$ENTRYDATE_FROM."' AND '".$ENTRYDATE_TO."'
												ORDER BY plubkdn.PRODCATTYPEID ASC";
								$aViewStatement			= mysql_query($aViewQuery);
								while($aViewStatementData	= mysql_fetch_array($aViewStatement)){ 
								
								 $PARTYID        		= $aViewStatementData["PARTYID"]; 
								 $ENTRYDATE        		= $aViewStatementData["ENTRYDATE"];
								 $RECEIVENUMBER        	= $aViewStatementData["RECEIVENUMBER"];  
								 $CATEGORYTYPENAME      = $aViewStatementData["CATEGORYTYPENAME"]; 
								 $PRODUCTNAME       	= $aViewStatementData["PRODUCTNAME"]; 
								 $PACKINGUNITID       	= $aViewStatementData["PACKINGUNITID"]; 	
								 $QUANTITY         		= $aViewStatementData["QUANTITY"];
								
							// Package Information View Report End
							
							//-----------------------------------------------------------------
							
							$packingNameVal 	= '';
							$packingViewQuery 	= "
													SELECT
															PACKINGUNITID,
															PACKINGNAMEID,
															QID,
															WTID
													FROM
															fna_packingunit 
													WHERE PACKINGUNITID = $PACKINGUNITID
													ORDER BY
															PACKINGUNITID
													ASC
												";
							$sv								= 1;
							$packingViewQueryStatement				= mysql_query($packingViewQuery);
							while($packingViewQueryStatementData	= mysql_fetch_array($packingViewQueryStatement)) {
								if($sv%2==0) {
									$class	= "evenRow";
								} else {
									$class	= "oddRow";
								}
								
								$PACKINGUNITID   		= $packingViewQueryStatementData["PACKINGUNITID"];
								$PACKINGNAMEID   		= $packingViewQueryStatementData["PACKINGNAMEID"];
								$QID			   		= $packingViewQueryStatementData["QID"];
								$WTID			   		= $packingViewQueryStatementData["WTID"];
								
								$packingNameQuery = "
													SELECT
															PACKINGNAMEID,
															PACKINGNAME
													FROM
															fna_packingname 
															WHERE PACKINGNAMEID = {$PACKINGNAMEID}
													";
								$packingNameQueryStatement				= mysql_query($packingNameQuery);
								while($packingNameQueryStatementData	= mysql_fetch_array($packingNameQueryStatement)) {
									$PACKINGNAMEID_NEW   		= $packingNameQueryStatementData["PACKINGNAMEID"];
									$PACKINGNAME_NEW   			= $packingNameQueryStatementData["PACKINGNAME"];
									
								}
								
								$QidQuery = "
													SELECT
															QVALUE
													FROM
															fna_quantity 
															WHERE QID = {$QID}
													";
								$QidQueryStatement				= mysql_query($QidQuery);
								while($QidQueryStatementData	= mysql_fetch_array($QidQueryStatement)) {
									$QVALUE   		= $QidQueryStatementData["QVALUE"];
									
								}
								
								$wtidQuery = "
													SELECT
															WNAME
													FROM
															fna_weight 
															WHERE WTID = {$WTID}
													";
								$wtidQueryStatement				= mysql_query($wtidQuery);
								while($wtidQueryStatementData	= mysql_fetch_array($wtidQueryStatement)) {
									$WNAME   		= $wtidQueryStatementData["WNAME"];
									
								}
							
							
							$packingNameVal 					.= "<option value='".$PACKINGUNITID."'>".$QVALUE.",".$WNAME."</option>";
							}
							
							//$systemParametersBody = str_replace('<!--%[PACKING_NAME]%-->',$packingNameVal,$systemParametersBody);
							
							$TOTALQUANTITY = $QVALUE * $QUANTITY ;
							//-----------------------------------------------------------------

 // Dynamic Row Start

						$tableView .=" <tr>
											<td align='left' valign='top' style='border: 1px dotted #000'>$ENTRYDATE </td>

											<td align='left' valign='top' style='border: 1px dotted #000'> $CATEGORYTYPENAME</td>
					
											<td align='left' valign='top'  style='border: 1px dotted #000'>$PRODUCTNAME</td>
					
											<td align='left' valign='top' style='border: 1px dotted #000'> $RECEIVENUMBER</td>
					
											<td align='left' valign='top' style='border: 1px dotted #000'>$QUANTITY</td>
					
											<td align='left' valign='top' style='border: 1px dotted #000'>$packingNameVal </td>
					
											<td align='left' valign='top' style='border: 1px dotted #000'>$TOTALQUANTITY </td>
											
											
					
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
							
							<td align='left' valign='top' style='border: 1px dotted #000'>&nbsp;</td>

						</tr>					

					</table>";
	echo $tableView;

?>