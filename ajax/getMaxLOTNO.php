<?php
	include('../config/dbinfo.inc.php');
	
	function showDateMySQlFormat($date){
	
		$exp = explode("-",$date);				
		$mysqlDateF = $exp[2]."-".$exp[1]."-".$exp[0];
		
		return $mysqlDateF;
}
	$SUBPROJECTID	= $_REQUEST['subProjectId'];
	$ENTRYDATE 		= showDateMySQlFormat($_REQUEST['ENTRYDATE']);
	$PRODCATTYPEID	= $_REQUEST['pcId'];
	$module_array 	= array();
	
	//echo "Select MAX(PRODCATTYPEFLAG) from fna_session WHERE SUBPROJECTID = '".$SUBPROJECTID."' AND PRODCATTYPEID = '".$PRODCATTYPEID."'";
	
	$MaxTypeFlag_Query	= mysql_fetch_array(mysql_query("Select MAX(PRODCATTYPEFLAG) from fna_session WHERE SUBPROJECTID = '".$SUBPROJECTID."' AND PRODCATTYPEID = '".$PRODCATTYPEID."'"));
	$MaxProdCatTypeFlag	= $MaxTypeFlag_Query['MAX(PRODCATTYPEFLAG)'];
	
	//echo "SELECT STARTDATE,	ENDDATE	FROM fna_session WHERE SUBPROJECTID = '".$SUBPROJECTID."' AND PRODCATTYPEID = '".$PRODCATTYPEID."' AND PRODCATTYPEFLAG = '".$MaxProdCatTypeFlag."'";
	
	$SessionQuery	= "
						SELECT 	
								STARTDATE,
								ENDDATE
						FROM 	
								fna_session
						WHERE SUBPROJECTID = '".$SUBPROJECTID."'
							AND PRODCATTYPEID = '".$PRODCATTYPEID."'
							AND PRODCATTYPEFLAG = '".$MaxProdCatTypeFlag."'
						";
	$SessionQueryStatement					= mysql_query($SessionQuery);
	while($SessionQueryStatementData		= mysql_fetch_array($SessionQueryStatement)) {
		$STARTDATE		 					= $SessionQueryStatementData["STARTDATE"];
		$ENDDATE		 					= $SessionQueryStatementData["ENDDATE"];
	}
	
	//echo $ENTRYDATE;
	//echo $STARTDATE;
	//echo $ENDDATE;
	$newSTARTDATE = $STARTDATE;
	$newENDDATE = $ENDDATE;
	
	if($ENTRYDATE <= $newENDDATE && $ENTRYDATE >= $newSTARTDATE){
		//echo 'Komol';
		if ($SUBPROJECTID == 54){
			
			$getModuleQuery	= "
								SELECT 	
										MAX(LOTNO)
								FROM 	
										fna_productloadunload 
								WHERE SUBPROJECTID =".$SUBPROJECTID." 
								ORDER BY LOTNO ASC
							 ";
			$getModuleStatement				= mysql_query($getModuleQuery);
			while($getModuleStatementData	= mysql_fetch_array($getModuleStatement)) {
				$LOTNO		 				= $getModuleStatementData["MAX(LOTNO)"];
				$module_array[] 			= array('optionValue'=>$LOTNO,'optionDisplay'=>$LOTNO);
			}
			
			$NowLOTNo						= $LOTNO + 1;
			echo $NowLOTNo ; 
			
		}else{
				$getModuleQuery	= "
								SELECT 	
										MAX(LOTNO)
								FROM 	
										fna_productloadunload 
								WHERE SUBPROJECTID =".$SUBPROJECTID." 
									AND ENTRYDATE BETWEEN '".$STARTDATE."' AND '".$ENDDATE."'
									ORDER BY LOTNO ASC
							 ";
			$getModuleStatement				= mysql_query($getModuleQuery);
			while($getModuleStatementData	= mysql_fetch_array($getModuleStatement)) {
				$LOTNO		 				= $getModuleStatementData["MAX(LOTNO)"];
				$module_array[] 			= array('optionValue'=>$LOTNO,'optionDisplay'=>$LOTNO);
			}
			
			$NowLOTNo						= $LOTNO + 1;
			echo $NowLOTNo ; 
			//echo json_encode($module_array);
		}
	}else{
		//echo  $ENTRYDATE;
		echo 'Null'; 
	//echo json_encode($module_array);
		
	}
	
	
?>