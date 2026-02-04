<?php
	class Structure Extends BaseClass {
		var $strAll, $strMain, $strInner;
		
		#-----------------
		#  Constructor
		#------------------
	
		function Structure() {
			$this->con=$this->BaseClass();
			$this->strMain = $this->getTemplateContent('index_template','t');
			$this->strInner = $this->getTemplateContent('thickb_template','t');
		}


		function loadStructure($body, $isIndex = 0) {
			$opId   		= '';
			$userId 		= '';
			$role  			= '';
			$welcomeMessage = '';
			$agencyName     = '';
			$adbPackageName = '';
			$businessDate  	= date('d-m-Y');
			if(isset($_SESSION['fmOperatorId'])) {
				$opId   = $_SESSION['fmOperatorId'];
				$userId = $_SESSION['fmUserId'];
			
			$check = 1;
			if($userId != $check){	
				//Get User Information Start
				
				
				$userName = '';
				$oPNAME   = '';
				$userInfoQuery = "
									SELECT
											s_role.ROLE_NAME,
											s_user.USER_NAME,
											s_position.POSITION,
											s_operator.OPNAME
									FROM 
											s_role,
											s_position,
											s_user,
											s_user_role,
											s_operator
									WHERE
											s_role.ROLE_ID 			= s_user_role.ROLE_ID
									AND		s_user_role.USER_ID 	= s_user.USER_ID
									AND		s_user.POSITION_ID		= s_position.POSITION_ID
									AND		s_user.USER_ID 			= $userId
									AND		s_operator.USER_ID 		= $userId
								";
				$userInfoStatement = mysql_query($userInfoQuery);
				while($userInfoStatementData 	= mysql_fetch_array($userInfoStatement)) {
					$userRoleName 	= $userInfoStatementData["ROLE_NAME"];
					$userName 		= $userInfoStatementData["USER_NAME"];
					$oPNAME 		= $userInfoStatementData["OPNAME"];
					$userPosition 	= $userInfoStatementData["POSITION"];
				}
				$welcomeMessage = " Welcome, <a href='#' title=\"Edit ".$userName."'s Information(Profile)\">".$oPNAME."</a><br /><a style='font-size:12px;color:#2b2d93;'><br />";
				//Get User Information End
				
				if(isset($_SESSION['fmRole'])) {
					$role   = $_SESSION['fmRole'];
				}
			}
				
			}
			if(isset($opId) && (strlen($opId)>0)) {
				if($isIndex == '0') {
					$getTab = new Action();
					$tab 	= $getTab->generateTab($userId);
					$this->strInner = str_replace('<!--%[BODY_CONTENT]%-->',$tab,$this->strInner);
					
					$body 		= str_replace('<!--%[PAGE_CONTENT]%-->',$body,$this->strInner);
					$body 		= str_replace('<!--%[BUSINESS_DATE]%-->',date("l, F j, Y", strtotime($businessDate)),$body);
					$body 		= str_replace('<!--%[WELCOME_MESSAGE]%-->',$welcomeMessage,$body);
					$u_name 	= '';
					$u_photo 	= '';
					$u_job_dur 	= '';
					$u_dept 	= '';
					$u_pos 		= '';
				} else {
					$main_tpl 	= str_replace('<!--%[PAGETITLE]%-->',$this->pageTitle,$this->strMain);
					$body 		= str_replace('<!--%[BODY_CONTENT]%-->',$body,$main_tpl);
					$body 		= str_replace('<!--%[BUSINESS_DATE]%-->',date("l, F j, Y", strtotime($businessDate)),$body);
					$body 		= str_replace('<!--%[WELCOME_MESSAGE]%-->',$welcomeMessage,$body);
				}
				echo $body;
			} else {
				echo $body;
			}
		}
	
		function loadAdminStructure($body='') { 
			if(!$_SESSION[user_id]){
				$body = $this->getTemplateContent('login','t');
				$menu = "";
			} else {
				$body = $body;	
				$menu = $this->strAll[5];
			}
			
			$strs = $this->strAll[2];
	
			$strs = str_replace('<!--%[PAGETITLE]%-->',$this->pageTitle,$strs);
	
			$strs = str_replace('<!--%[LOGIN]%-->',$log,$strs);
			
	
			$strs = str_replace('<!--%[BODY]%-->',$this->strAll[4],$strs);
	
			$strs = str_replace('<!--%[FILL_AREA]%-->',$body,$strs);
	
			$strs = str_replace('<!--%[MENU]%-->',$menu,$strs);
			
	
			$strs = str_replace('<!--%[ALL_FOOTER]%-->',$this->strAll[3],$strs);
	
			$strs = str_replace('<!--%[ERROR_SMS]%-->',$_SESSION["msgVar"],$strs);
	
			print_r($strs);
		}
	
		function getHomePageContent() {
			$clnt = new Clients();
			$str = $this->getTemplateContent('index');
			$str = str_replace("<!--%[CLIST]%-->",$clnt->ClientsList_Home(500),$str);
			return $str;
	
		}
	}
?>