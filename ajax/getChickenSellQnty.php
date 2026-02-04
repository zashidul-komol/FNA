<?php
	include('../config/dbinfo.inc.php');
	$HATCHNO	 	= $_REQUEST['HATCHNO_CS'];
	$module_array 	= array();
		
		$OHEFLAG_QUERY	= mysql_fetch_array(mysql_query("SELECT MAX(HATCHFLAG) FROM hatch_chicken_production WHERE HATCHNO = '".$HATCHNO."'"));
		$MaxOHEFlag		= $OHEFLAG_QUERY['MAX(HATCHFLAG)'];
		$getQuery	= "
										SELECT 	
												TOTQUANTITY
										FROM 	
												hatch_chicken_production 
										WHERE HATCHNO = '".$HATCHNO."'	
											AND	HATCHFLAG = '".$MaxOHEFlag."' 
									";
	
		$getQueryStatement				= mysql_query($getQuery);
		while($getQueryStatementData	= mysql_fetch_array($getQueryStatement)) {
			$TOTQUANTITY 				= $getQueryStatementData["TOTQUANTITY"];
			
			if($TOTQUANTITY == 0){
				echo '';
			}else{
				echo $TOTQUANTITY;
			}
			
	}
		
?>