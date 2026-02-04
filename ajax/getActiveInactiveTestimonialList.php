<?php 
	include('../config/dbinfo.inc.php');
	$testimonialId 			= $_REQUEST['testimonialId'];
	$testimonialStatus 		= $_REQUEST['testimonialStatus'];
	if($testimonialStatus == 'active') {
		$testimonialStatus = 'inactive';		
	} else {
		$testimonialStatus = 'active';	
	}
	$msg			= '';
	if(!empty($testimonialId)){	
		$updateTestimonialQuery = "
									UPDATE 
											s_training_testimonials 
									SET
											STATUS		= '".$testimonialStatus."'
									WHERE	 
											TESTIMONIAL_ID = '".$testimonialId."'
							   ";
		$updateTestimonialStatement = mysql_query($updateTestimonialQuery);
		if($updateTestimonialStatement) {
			$msg = "<div class='valid_msg'>Testimonial {$testimonialStatus} successfully.</div>";	
		} else {
			$msg= "<div class='error_msg'>Process failed.</div>";
		}
	} 
	echo $msg;
?>