<?php 
	include('../config/dbinfo.inc.php');
	$trainingGalleryId 	= $_REQUEST['trainingGalleryId'];
	$imageStatus 		= $_REQUEST['imageStatus'];
	if($imageStatus == 'active') {
		$imageStatus = 'inactive';		
	} else {
		$imageStatus = 'active';	
	}
	$msg			= '';
	if(!empty($trainingGalleryId)){	
		$updateTrainingImageQuery = "
										UPDATE 
												s_training_image_gallery 
										SET
												STATUS		= '".$imageStatus."'
										WHERE	 
												GALLERY_ID = '".$trainingGalleryId."'
								   ";
		$updateTrainingImageStatement = mysql_query($updateTrainingImageQuery);
		if($updateTrainingImageStatement) {
			$msg = "<div class='valid_msg'>Training image {$imageStatus} successfully.</div>";	
		} else {
			$msg= "<div class='error_msg'>Process failed.</div>";
		}
	} 
	echo $msg;
?>
