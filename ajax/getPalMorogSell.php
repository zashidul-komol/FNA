<?php
	include('../config/dbinfo.inc.php');
	$BATCHNO_ES		= $_REQUEST['BATCHNO_MMS'];
	$module_array 	= array();
		$BatchFlag		= mysql_fetch_array(mysql_query("SELECT MAX(BATCHFLAG) FROM pal_morog WHERE BATCHNO = '".$BATCHNO_ES."'"));
		$MaxBatchFlag	= $BatchFlag['MAX(BATCHFLAG)'];
		$getModuleQuery	= "
							SELECT 	
									STOCKINHAND
							FROM 	
									pal_morog 
							WHERE	
									BATCHNO = '".$BATCHNO_ES."' 
									AND BATCHFLAG = '".$MaxBatchFlag."'
						";
	
		$getModuleStatement				= mysql_query($getModuleQuery);
		while($getModuleStatementData	= mysql_fetch_array($getModuleStatement)) {
			$STOCKINHAND 					= $getModuleStatementData["STOCKINHAND"];
			
		echo $STOCKINHAND;
	}
		
?>