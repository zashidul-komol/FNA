<?php
	include('../config/dbinfo.inc.php');
	$BATCHNOEP	 	= $_REQUEST['BATCHNOEP'];
	$module_array 	= array();
		$BatchFlag		= mysql_fetch_array(mysql_query("SELECT MAX(BATCHFLAG) FROM pal_murgi WHERE BATCHNO = '".$BATCHNOEP."'"));
		$MaxBatchFlag	= $BatchFlag['MAX(BATCHFLAG)'];
		$getModuleQuery	= "
							SELECT 	
									STOCKINHAND
							FROM 	
									pal_murgi 
							WHERE	
									BATCHNO = '".$BATCHNOEP."' 
									AND BATCHFLAG = '".$MaxBatchFlag."'
						";
	
		$getModuleStatement				= mysql_query($getModuleQuery);
		while($getModuleStatementData	= mysql_fetch_array($getModuleStatement)) {
			$STOCKINHAND 					= $getModuleStatementData["STOCKINHAND"];
			
			echo $STOCKINHAND;
	}
		
?>