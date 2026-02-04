<?php
	class Facilitator Extends BaseClass {
		function Training() {
			$this->con	= $this->BaseClass();
		}
		
		//User Registration View Start
		function getFacilitratorSetup($empId) {
			$systemParametersBody = $this->getTemplateContent('FacilitratorSetup');
			date_default_timezone_set("Asia/Dhaka");
						
			//Category View Start
			$facilitatorView	= '';
			$facilitatorQuery	= "
								SELECT
										S_CATEGORY.CATEGORY_ID,
										S_CATEGORY.CATEGORY
								FROM
										s_category
								ORDER BY
										CATEGORY ASC
							 ";
			$sv								= 1;
			$facilitatorStatement				= mysql_query($facilitatorQuery);
			while($facilitatorStatementData 	= mysql_fetch_array($facilitatorStatement)) {
				if($sv%2==0) {
					$class	= "evenRow";
				} else {
					$class	= "oddRow";
				}
				
				$facilitatorId		= $facilitatorStatementData["CATEGORY_ID"];
				$facilitatorName   = $facilitatorStatementData["CATEGORY"];
				
				$facilitatorView .= "<tr valign='top' class='$class'>
									<td align='center'>{$sv}.</td>
									<td align='left'>{$categoryName}</td>
									<td align='center'><a href='UserRoleNameEdit.php?keepThis=true&TB_iframe=true&height=600&width=1200&categoryId={$categoryId}' class='thickbox'>
									<img src='images/icon_edit.gif' alt='Edit' border='0' title='Edit' />&nbsp;</a>
									</td>
								 </tr>";
				$sv++;

			}
			$systemParametersBody = str_replace('<!--%[CATEGORY_VIEW]%-->',$facilitatorView,$systemParametersBody);
			//Category View Start
			
			return $systemParametersBody;
		}
		//User Registration View End		
	}
?>