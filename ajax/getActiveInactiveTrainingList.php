<?php 
	include('../config/dbinfo.inc.php');
	$trainingId 	= $_REQUEST['trainingId'];
	$trainingStatus = $_REQUEST['trainingStatus'];
	if($trainingStatus != '') {
		$trainingStatus = '';		
	} else {
		$trainingStatus = 'active';	
	}
	$msg			= '';
	if(!empty($trainingId)){	
		$updateTrainingPostQuery = "
										UPDATE 
												s_training_calender 
										SET
												TRAINING_STATUS		= '".$trainingStatus."'
										WHERE	 
												TRAINING_ID = '".$trainingId."'
								   ";
		$updateTrainingPostStatement = mysql_query($updateTrainingPostQuery);
		if($updateTrainingPostStatement) {
			$msg = "<div class='valid_msg'>Training active successfully.</div>";	
		} else {
			$msg= "<div class='error_msg'>Process failed.</div>";
		}
	} 
	echo $msg;
?>
