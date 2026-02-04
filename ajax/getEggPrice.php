<?php
	include('../config/dbinfo.inc.php');
	$EGGQNTY	 	= $_REQUEST['EGGQNTY'];
	$module_array 	= array();
		$OHEFLAG_QUERY	= mysql_fetch_array(mysql_query("SELECT MAX(OHEFLAG) FROM hatch_opening_hatching_egg"));
		$MaxOHEFlag		= $OHEFLAG_QUERY['MAX(OHEFLAG)'];
		$getModuleQuery	= "
										SELECT 	
												RATE
										FROM 	
												hatch_opening_hatching_egg 
										WHERE	
												OHEFLAG = '".$MaxOHEFlag."' 
									";
	
		$getModuleStatement				= mysql_query($getModuleQuery);
		while($getModuleStatementData	= mysql_fetch_array($getModuleStatement)) {
			$AVGRATEPEREGG 					= $getModuleStatementData["RATE"];
			
			$NOW_AVGRATEPEREGG		= $AVGRATEPEREGG * $EGGQNTY ; 
			
			echo $NOW_AVGRATEPEREGG;
	}
		
?>