<?php
	include('../config/dbinfo.inc.php');
	$party_id 	= $_REQUEST['party_id'];
	$module_array 	= array();
	$getModuleQuery	= "
						SELECT 	
								p.PARTYNAME,
								p.FATHERNAME,
								p.ADDRESS,
								p.MOBILE,
								SUM(alu.LOADQUANTITY) QUANTITY
						FROM 	
								fna_party p, fna_alustock alu 
						WHERE   p.PARTYID = alu.PARTYID
							AND	p.PARTYID = '".$party_id."' 
							AND alu.WORKTYPEFLAG = 'Load'
					 ";
	$getModuleStatement				= mysql_query($getModuleQuery);
	while($getModuleStatementData	= mysql_fetch_array($getModuleStatement)) {
		$PARTYNAME 					= $getModuleStatementData["PARTYNAME"];
		$FATHERNAME 				= $getModuleStatementData["FATHERNAME"];
		$ADDRESS 					= $getModuleStatementData["ADDRESS"];
		$MOBILE 					= $getModuleStatementData["MOBILE"];
		$QUANTITY 					= $getModuleStatementData["QUANTITY"];
		$module_array[] 			= array('PARTYNAME'=>$PARTYNAME,'FATHERNAME'=>$FATHERNAME,'ADDRESS'=>$ADDRESS,'MOBILE'=>$MOBILE,'QUANTITY'=>$QUANTITY);
	}
	echo json_encode($module_array);
?>