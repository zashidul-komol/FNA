<?php
	include('../config/dbinfo.inc.php');
	$HATCHNO	 	= $_REQUEST['HATCHNO'];
	$module_array 	= array();
		
		
		$OHEFLAG_QUERY	= mysql_fetch_array(mysql_query("SELECT MAX(FLAG) FROM hatch_egg_settings_machine WHERE HATCHNO = '".$HATCHNO."'"));
		$MaxOHEFlag		= $OHEFLAG_QUERY['MAX(FLAG)'];
		$NowMaxFlag		= $MaxOHEFlag - 1;
		
		
		$getQuery	= "
										SELECT 	
												EGGQNTY
										FROM 	
												hatch_egg_settings_machine 
										WHERE HATCHNO = '".$HATCHNO."'	
											AND	FLAG = '".$MaxOHEFlag."' 
									";
	
		$getQueryStatement				= mysql_query($getQuery);
		while($getQueryStatementData	= mysql_fetch_array($getQueryStatement)) {
			$EGGQNTY				= $getQueryStatementData["EGGQNTY"];
			
			
			
			if($EGGQNTY == 0){
				echo '';
			}else{
				echo $EGGQNTY;
			}
			
	}
		
?>