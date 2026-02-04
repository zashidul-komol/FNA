 $updateQuery = "UPDATE 
										  `adbs_disbursementproject_child`
										  SET
												bpc_79h				 	= '".$bpc_79h."',
												bpc_79i 				= '".$bpc_79i."',
												bpc_79j 				= '".$bpc_79jTotal."',
												
												status  	= 'active',
												entDate 	= '".$entDate."',
												entTime 	= '".$entTime."',
												entUser 	= '".$userId."'
									  WHERE
											pId       = '".$pId."'";
																
				$updateQueryStatement = mysql_query($updateQuery);						
				if($updateQueryStatement){
					$msg = "<span class='validMsg'>Update your data into [ $paymentStage_pName ] added sucessfully</span>
					<br/><a href='index.php' style='text-decoration:none;font-size:16px;'>Go Home and View Package Information</a><br/><br/>
					<form action='disbursementsEdit.php' method='post'>
						<input type='hidden' name='packageId' value='$paymentStageId'/>
						<input type='hidden' name='packageName' value='$paymentStage_pName'/>
						<input type='submit' name='editSubmitDisbursementsStage'  value='Again Insert'/>
					</form>";
				} else {
					$msg = "<span class='errorMsg'>Sorry! System Error!</span>";
				}
			