<?php
	include('../config/dbinfo.inc.php');
	$FOODID		 	= $_REQUEST['FOODID'];
	$module_array 	= array();
		$FoodFlag		= mysql_fetch_array(mysql_query("SELECT MAX(FOODFLAG) FROM feed_finishedstock WHERE FOODID = '".$FOODID."'"));
		$MaxFoodFlag	= $FoodFlag['MAX(FOODFLAG)'];
		$getModuleQuery	= "
							SELECT 	
									FOODTOTQNTY
							FROM 	
									feed_finishedstock 
							WHERE	
									FOODID = '".$FOODID."' 
									AND FOODFLAG = '".$MaxFoodFlag."'
						";
	
		$getModuleStatement				= mysql_query($getModuleQuery);
		while($getModuleStatementData	= mysql_fetch_array($getModuleStatement)) {
			$FOODTOTQNTY				= $getModuleStatementData["FOODTOTQNTY"];
			
			
			echo $FOODTOTQNTY;
	}
		
?>