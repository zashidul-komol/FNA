<?php
	include('../config/dbinfo.inc.php');
	$FOODID		 	= $_REQUEST['FOODID'];
	$module_array 	= array();
		$FoodFlag		= mysql_fetch_array(mysql_query("SELECT MAX(FOODFLAG) FROM feed_finishedstock WHERE FOODID = '".$FOODID."'"));
		$MaxFoodFlag	= $FoodFlag['MAX(FOODFLAG)'];
		$getModuleQuery	= "
							SELECT 	
									AVGPRICE
							FROM 	
									feed_finishedstock 
							WHERE	
									FOODID = '".$FOODID."' 
									AND FOODFLAG = '".$MaxFoodFlag."'
						";
	
		$getModuleStatement				= mysql_query($getModuleQuery);
		while($getModuleStatementData	= mysql_fetch_array($getModuleStatement)) {
			$AVGPRICE 					= $getModuleStatementData["AVGPRICE"];
			
			$ProfitFlag			= mysql_fetch_array(mysql_query("SELECT MAX(PROFITFLAG) FROM feed_profitamount"));
			$MaxProfitFlag		= $ProfitFlag['MAX(PROFITFLAG)'];
			
			$ProfitQuery	    = mysql_fetch_array(mysql_query("SELECT RATE FROM feed_profitamount WHERE PROFITFLAG = '".$MaxProfitFlag."'"));
			$NOWRATE			= $ProfitQuery['RATE'];
			
			$NOW_AVGPRICE		= $AVGPRICE + $NOWRATE ; 
			
			echo $NOW_AVGPRICE;
	}
		
?>