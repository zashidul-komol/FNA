<?php
	include('../config/dbinfo.inc.php');
	$BatchNo	 	= $_REQUEST['pcId'];
	$module_array 	= array();
	$BatchFlag		= mysql_fetch_array(mysql_query("SELECT MAX(BATCHFLAG) FROM pal_dailyoperation WHERE BATCHNO = '".$BatchNo."'"));
	$MAXFLAG		= $BatchFlag['MAX(BATCHFLAG)'];
	$getModuleQuery	= "
						SELECT 	
								STOCKINHAND
						FROM 	
								pal_dailyoperation 
						WHERE	
								BATCHNO = '".$BatchNo."'
								AND BATCHFLAG = '".$MAXFLAG."' 
								AND STATUS = 'Active'
					";
	
		$getModuleStatement				= mysql_query($getModuleQuery);
		while($getModuleStatementData	= mysql_fetch_array($getModuleStatement)) {
		$STOCKINHAND 					= $getModuleStatementData["STOCKINHAND"];
		
		echo $STOCKINHAND;
}
?>