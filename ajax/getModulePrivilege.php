<?php
	include('../config/dbinfo.inc.php');
	$role_id = $_REQUEST['role_id'];
	$subrole_array = array();
	$getSubroleQuery = "
							SELECT 	
										s_user.USER_ID,
										s_user.USER_NAME
						FROM 	
										s_user,s_user_role 
						WHERE	
										s_user_role.ROLE_ID =".$role_id." 
						AND 			s_user_role.USER_ID = s_user.USER_ID
										ORDER BY s_user.USER_NAME ASC";
					
	$getSubroleStatement				= mysql_query($getSubroleQuery);
	while($getSubroleStatementData	= mysql_fetch_array($getSubroleStatement)) {
		$subrole_id = $getSubroleStatementData["USER_ID"];
		$subrole_name = $getSubroleStatementData["USER_NAME"];
		$subrole_array[] = array('optionValue'=>$subrole_id,'optionDisplay'=>$subrole_name);
	}
	echo json_encode($subrole_array);
?>