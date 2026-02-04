<?php
	class BaseClass {
	
		var $con;
		var $db;
		var	$admTheme;
	
		var	$app_url 	= APP_URL;
		var $maxsize	= MAXFILESIZE;
	
		var $adminEmail = '"Alliance Capital Asset Management Limited" <info@acaml.com.bd>';
		var $adminEm = 'info@acaml.com.bd';
		var $pageTitle="Alliance Capital Asset Management Ltd. ~ Fund Manager";
		var $clientWeb="www.acaml.com.bd";
	
		var $imgExt = array("0"=>"jpeg","1"=>"JPEG","2"=>"jpg","3"=>"JPG","4"=>"gif","5"=>"GIF","6"=>"png","7"=>"PNG");
		var $fileExt = array("0"=>"csv","1"=>"CSV","2"=>"pdf","3"=>"PDF","4"=>"doc","5"=>"DOC","6"=>"docx","7"=>"DOCX");
		
		
		#------------------------#
		# Base Class Constructor
		#------------------------#
	
		function BaseClass() {
			$this->DB_HOST = "localhost";		
			$this->DB_NAME = "polarbd_fna";
			$this->DB_USER = "polarbd_polard";
			$this->DB_PASSW = "polar123";
			$this->DB_LINK = mysql_connect($this->DB_HOST, $this->DB_USER, $this->DB_PASSW) or die("ERROR: MYSQL CONNECTION ERROR...PROJECT FNA");
			mysql_select_db($this->DB_NAME, $this->DB_LINK) or die(mysql_error($this->DB_LINK));
		}
		
		#----------------------
		# Check Login
		#----------------------
	
		function checkLogin() {
			$logMsg 	= '';
			$a_name 	= strtolower($this->check_injection($_REQUEST['userId'])); 
			$a_pass 	= $this->check_injection($_REQUEST['password']); 
			
			$chkUserQuery= "SELECT 	
									s_operator.OPERATOR_ID, 
									s_operator.USER_ID, 
									s_role.ROLE_NAME
							FROM 	
									s_operator,
									s_user,
									s_user_role,
									s_role
							WHERE 	
									s_operator.USER_ID = s_user.USER_ID 
							AND 	LOWER(s_user.USER_STATUS) = 'active'
							AND 	s_user.USER_ID  = s_user_role.USER_ID 
							AND 	s_user_role.ROLE_ID = s_role.ROLE_ID
							AND 	LOWER(s_operator.OPNAME) = '$a_name' 
							AND 	s_operator.OPPASS = '$a_pass'";
			$chkUserStatement	= mysql_query($chkUserQuery);
			$chkUserFound		= mysql_num_rows($chkUserStatement); 
			
			if($chkUserFound == 1) {
				$opId 			= '';
				$userId 		= '';
				$role 			= '';
				$chkUserStatement	= mysql_query($chkUserQuery);
				while($chkUserStatementData = mysql_fetch_array($chkUserStatement)) {
					$opId 		= $chkUserStatementData["OPERATOR_ID"];
					$userId 	= $chkUserStatementData["USER_ID"];
					$role 		= $chkUserStatementData["ROLE_NAME"]; 
					
					$_SESSION['fmOperatorId'] = $opId;
					$_SESSION['fmUserId'] = $userId;
					$_SESSION['fmRole'] = $role;
				}
			} else {
				$logMsg = "<span class='errorMsg'>Unauthorized username or password!</span>";
			}
		
			return $logMsg;
		}
		
		function check_injection($target) {
			$constraints = array('|',',','-',' ','"',"'",'<','>');
			for($i=0;$i<sizeof($constraints);$i++) {
				$target = str_replace($constraints[$i],'',$target);
			}
			return $target;
		}
		
		
		#----------------------#
		# Page Redirect Method #
		#----------------------#
	
		function pageRedirect($pageRedirect) {
			print("<script>location.replace (\"$pageRedirect\");</script>");
		}
		
		function getTemplateContent($subpage='',$tpl='') {
			if($subpage!="") {
				if($tpl=='t') {
					$htmlFolder= 'tpl';
				}  else {
					$htmlFolder= 'html';
				}
				$contentFile 		= $this->app_url."$htmlFolder/$subpage.html";
				if(is_file($contentFile)) {
					$fh 			= fopen($contentFile, 'r');
					$contentData 	= fread($fh, filesize($contentFile));
					fclose($fh);	
					$contentData 	= str_replace("../","$this->app_url",$contentData);
				} else {
					$contentData 	= "";
				}
			}
			return $contentData;
		}
		
		#-----------------------#
		# File Extension Method #
		#-----------------------#
	
		function getFileExtension($strr)  {
			$i = strrpos($strr,".");
			if (!$i) { return ""; }
			$l = strlen($strr) - $i;
			$ext = substr($strr,$i+1,$l);
			return $ext;
		}
		
		#--------------------#
		# File Upload Method #
		#--------------------#
		
		function uploadFile($fieldName, $path) {
			if(move_uploaded_file($_FILES[$fieldName]['tmp_name'], $path)) {
				return true;
			} else {
				return false;
			}
		}
	
		function uploadImage($UploaderName, $imgName, $cat='', $typ='') {
			$dir_path = $this->getUploadDir($cat,$typ);
			if ($imgName && $UploaderName[tmp_name] && $UploaderName[size] < $this->maxsize) {
				$name = $imgName.".jpg";
				if(file_exists($dir_path.$name)) {
					unlink($dir_path.$name);
				}
				$str = $this->uploadResizeImage($UploaderName, $name, $cat, $typ);
				return $str;
			}
		}
	
		function uploadResizeImage($fileCtrl, $name, $cat = '', $typ = '') {
			$uploadedfile = $fileCtrl['tmp_name'];
			$filePath = $this->getUploadDir($cat,$typ).$name;
			list($width, $height) = getimagesize($uploadedfile);
			if($width>100) {
				$percent = 70/$width; 
			} else { 
				$percent = 1; 
			}
			$new_width = $width * $percent;
			$new_height = $height * $percent;
			$tempArr = explode(".", $fileCtrl["name"]);
			$ext = strtolower($tempArr[sizeof($tempArr) -1]);
			if(sizeof($tempArr) > 1 && in_array($ext,$this->imgExt)) {
				$tmpImg = imagecreatetruecolor($new_width,$new_height) or die('Problem In Creating image');
				if($ext ==$this->imgExt[0] || $ext ==$this->imgExt[1] || $ext ==$this->imgExt[2] || $ext ==$this->imgExt[3]) {
					$srcimg = imagecreatefromjpeg($uploadedfile);
				} elseif($ext ==$this->imgExt[4] || $ext ==$this->imgExt[5]) {
					$srcimg = imagecreatefromgif($uploadedfile);
				} elseif($ext == $this->imgExt[6] || $ext == $this->imgExt[7]) {
					$srcimg = imagecreatefrompng($uploadedfile);
				}
				
				if(function_exists('imagecopyresampled')) {
					imagecopyresampled($tmpImg,$srcimg,0,0,0,0,$new_width,$new_height,ImageSX($srcimg),ImageSY($srcimg)) or die('Problem In resizing');
				} else {
					Imagecopyresized($tmpImg,$srcimg,0,0,0,0,$new_width,$new_height,ImageSX($srcimg),ImageSY($srcimg)) or die('Problem In resizing');
				}
				ImageJPEG($tmpImg,$filePath,90) or die('Problem In saving');
				imagedestroy($tmpImg);
			} else {
				echo $str = "This type of file is not allowed.";
			}
			return $str;
		}
		
		function getUploadDir($cat='', $typ='') {
			$sub_dir= APP_URL."uploaddir/";
			if ($cat == 'c') {	
				$path = $sub_dir."clientele/";
			}
			return $path;
		}		
	}
?>
