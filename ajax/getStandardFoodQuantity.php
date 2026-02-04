<?php
	include('../config/dbinfo.inc.php');
	$FOODID		 	= $_REQUEST['FOODID'];
	$module_array 	= array();
		$FoodFlag		= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM feed_standardfood WHERE FOODID = '".$FOODID."'"));
		$MaxFoodFlag	= $FoodFlag['MAX(FLAG)'];
		$getModuleQuery	= "
							SELECT 	
									QUANTITY
							FROM 	
									feed_standardfood 
							WHERE	
									FOODID = '".$FOODID."' 
									AND FLAG = '".$MaxFoodFlag."'
						";
	
		$getModuleStatement				= mysql_query($getModuleQuery);
		while($getModuleStatementData	= mysql_fetch_array($getModuleStatement)) {
			$QUANTITY 					= $getModuleStatementData["QUANTITY"];
			
			echo $QUANTITY;
	}
		
?>