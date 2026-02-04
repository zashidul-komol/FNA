<?php
	include('../config/dbinfo.inc.php');
	$BatchNo	 	= $_REQUEST['BatchNo'];
	$chk			= '';
	$module_array 	= array();
		$BatchFlag		= mysql_fetch_array(mysql_query("SELECT MAX(BATCHFLAG) FROM pal_dailyoperation WHERE BATCHNO = '".$BatchNo."'"));
		$MaxBatchFlag	= $BatchFlag['MAX(BATCHFLAG)'];
		$getModuleQuery	= "
							SELECT 	
									DOID,
									STOCKINHAND,
									STATUS
							FROM 	
									pal_dailyoperation 
							WHERE	
									BATCHNO = '".$BatchNo."' 
									AND BATCHFLAG = '".$MaxBatchFlag."'
						";
	
		$getModuleStatement				= mysql_query($getModuleQuery);
		$STOCKINHAND = 0;
		$DOID		= 0;
		$STATUS		= 0;
		while($getModuleStatementData	= mysql_fetch_array($getModuleStatement)) {
			$DOID 							= $getModuleStatementData["DOID"];
			$STOCKINHAND				= $getModuleStatementData["STOCKINHAND"];
			$STATUS		 					= $getModuleStatementData["STATUS"];
			$chk							= 'd';
			//echo $STOCKINHAND;
		}
		
		if($STATUS == 'Inactive'){
		
			$BatchFlag_murgi			= mysql_fetch_array(mysql_query("SELECT MAX(BATCHFLAG) FROM pal_murgi WHERE BATCHNO = '".$BatchNo."'"));
			$MaxBatchFlag_murgi			= $BatchFlag_murgi['MAX(BATCHFLAG)'];
			$getModuleQuery_murgi		= "
											SELECT 	
													MURID,
													STOCKINHAND
											FROM 	
													pal_murgi 
											WHERE	
													BATCHNO = '".$BatchNo."' 
													AND BATCHFLAG = '".$MaxBatchFlag_murgi."'
										";
		
			$getModuleQuery_murgiStatement				= mysql_query($getModuleQuery_murgi);
			$MURID	= 0;
			$STOCKINHAND_MURGI = 0;
			while($getModuleQuery_murgiStatementData	= mysql_fetch_array($getModuleQuery_murgiStatement)) {
				$MURID									= $getModuleQuery_murgiStatementData["MURID"];
				$STOCKINHAND_MURGI						= $getModuleQuery_murgiStatementData["STOCKINHAND"];
			}
			
			$BatchFlag_morog			= mysql_fetch_array(mysql_query("SELECT MAX(BATCHFLAG) FROM pal_morog WHERE BATCHNO = '".$BatchNo."'"));
			$MaxBatchFlag_morog			= $BatchFlag_morog['MAX(BATCHFLAG)'];
			$getModuleQuery_morog		= "
											SELECT 	
													MORID,
													STOCKINHAND
											FROM 	
													pal_morog 
											WHERE	
													BATCHNO = '".$BatchNo."' 
													AND BATCHFLAG = '".$MaxBatchFlag_morog."'
										";
		
			$getModuleQuery_morogStatement				= mysql_query($getModuleQuery_morog);
			$MORID = 0;
			$STOCKINHAND_MOROG = 0;
			while($getModuleQuery_morogStatementData	= mysql_fetch_array($getModuleQuery_morogStatement)) {
				$MORID									= $getModuleQuery_morogStatementData["MORID"];
				$STOCKINHAND_MOROG						= $getModuleQuery_morogStatementData["STOCKINHAND"];
			}
			
			$TOTAL_STOCKINHAND   = $STOCKINHAND_MURGI + $STOCKINHAND_MOROG ; 
			$chk				 = 'm';
			echo $chk.",".$TOTAL_STOCKINHAND.",".$MURID.",".$MORID;
		
			
	}else{
		
		echo $chk.",".$STOCKINHAND.",".$DOID;
		//echo $chk.",".$TOTAL_STOCKINHAND.",".$DOID;
	
}
?>