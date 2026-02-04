<?php
	include('../config/dbinfo.inc.php');
	$BatchNo	 	= $_REQUEST['pcId'];
	$module_array 	= array();
	$BatchFlag		= mysql_fetch_array(mysql_query("SELECT MAX(BATCHFLAG) FROM pal_dailyoperation WHERE BATCHNO = '".$BatchNo."'"));
	$MAXFLAG		= $BatchFlag['MAX(BATCHFLAG)'];
	$getModuleQuery	= "
						SELECT 	
								STOCKINHAND,
								STATUS
						FROM 	
								pal_dailyoperation 
						WHERE	
								BATCHNO = '".$BatchNo."'
								AND BATCHFLAG = '".$MAXFLAG."'
					";
	
	$getModuleStatement				= mysql_query($getModuleQuery);
	$num_rows		=	mysql_num_rows($getModuleStatement);
	if($num_rows > 0){
		while($getModuleStatementData	= mysql_fetch_array($getModuleStatement)) {
		$STOCKINHAND 					= $getModuleStatementData["STOCKINHAND"];
		$STATUS		 					= $getModuleStatementData["STATUS"];
		}
		if($STATUS == 'Active'){
			echo $STOCKINHAND;
		}else{
			echo $STOCKINHAND = '';
		}
		
	}else{
		$getModuleQuery	= "
							SELECT 	
									SUM(BWISELIVESTOCK) LIVESTOCK
							FROM 	
									pal_batchopen 
							WHERE	
									BATCHNO = '".$BatchNo."' 
						";
	
		$getModuleStatement				= mysql_query($getModuleQuery);
		while($getModuleStatementData	= mysql_fetch_array($getModuleStatement)) {
		$BWISELIVESTOCK 				= $getModuleStatementData["LIVESTOCK"];
		}
		echo $BWISELIVESTOCK;
	}
	
?>