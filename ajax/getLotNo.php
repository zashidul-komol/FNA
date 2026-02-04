<?php
	include('../config/dbinfo.inc.php');
	$pcId 	= $_REQUEST['pcId'];
	$module_array 	= array();
	$getModuleQuery	= mysql_fetch_array(mysql_query("SELECT MAX(LOTNO) FROM fna_productloadunload WHERE	SUBPROJECTID =".$pcId." ORDER BY LOTNO ASC "));
	$MaxLotNo		= $getModuleQuery['MAX(LOTNO)'];
	$NowMaxLotNo	= $MaxLotNo + 1 ;
	
	echo $NowMaxLotNo;
?>