<?php
	include('../config/dbinfo.inc.php');
	$BatchNo	 	= $_REQUEST['BATCHNO_MMDO'];
	$MOROGMURGI	 	= $_REQUEST['MOROGMURGI'];
	$module_array 	= array();
	if($MOROGMURGI == 'Morog'){
		
		$BatchFlag		= mysql_fetch_array(mysql_query("SELECT MAX(BATCHFLAG) FROM pal_morog WHERE BATCHNO = '".$BatchNo."'"));
		$MaxBatchFlag	= $BatchFlag['MAX(BATCHFLAG)'];
		$getModuleQuery	= "
						SELECT 	
								STOCKINHAND
						FROM 	
								pal_morog 
						WHERE	
								BATCHNO = '".$BatchNo."' 
								AND BATCHFLAG = '".$MaxBatchFlag."'
					";
	
		$getModuleStatement				= mysql_query($getModuleQuery);
		while($getModuleStatementData	= mysql_fetch_array($getModuleStatement)) {
		$STOCKINHAND 					= $getModuleStatementData["STOCKINHAND"];
		echo $STOCKINHAND;
		}
		
	}else{
		$BatchFlag		= mysql_fetch_array(mysql_query("SELECT MAX(BATCHFLAG) FROM pal_murgi WHERE BATCHNO = '".$BatchNo."'"));
		$MaxBatchFlag	= $BatchFlag['MAX(BATCHFLAG)'];
		$getModuleQuery	= "
						SELECT 	
								STOCKINHAND
						FROM 	
								pal_murgi 
						WHERE	
								BATCHNO = '".$BatchNo."' 
								AND BATCHFLAG = '".$MaxBatchFlag."'
					";
	
		$getModuleStatement				= mysql_query($getModuleQuery);
		while($getModuleStatementData	= mysql_fetch_array($getModuleStatement)) {
		$STOCKINHAND 					= $getModuleStatementData["STOCKINHAND"];
		
		echo $STOCKINHAND;
	}
	
}
?>