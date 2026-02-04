<?php
	//error_reporting(0);
	session_start();
	$server_location	= "";
	require_once($server_location.'config/config.inc.php');
	
	#---------------
	# Creates the Instance of the Structure
	#---------------
	
	$struc			= new Structure();
	$loginMsg 		= '';
	if(isset($_POST['btnLogin'])) {
		$loginMsg 	= $struc->checkLogin();
		//$struc->pageRedirect(HOMEPAGE);
	}
	
	#---------------
	# Code for Logout 
	#---------------
	$logout 		= false;
	if(isset($_REQUEST['logout'])) {
		if(strtolower($_REQUEST['logout']) == 'y') {
			$logout = true;
		}
	} else if(isset($_POST['btnLogout'])) {
		$logout 	= true;
	}
	
	if($logout) {
		unset($_SESSION['fmOperatorId']);
		unset($_SESSION['fmUserId']);
		unset($_SESSION['fmRole']);
		$struc->pageRedirect(HOMEPAGE);
	}
	
	
function insertDateMySQlFormat($date){
	
		$exp = explode("-",$date);				
		$mysqlDateF = $exp[2]."-".$exp[1]."-".$exp[0];
		
		return $mysqlDateF;
		
}
function showDateMySQlFormat($date){	
		$exp = explode("-",$date);				
		$mysqlDateF = $exp[2]."-".$exp[1]."-".$exp[0];		
		return $mysqlDateF;
}
function showDateFormat($date){
		
		$newDate = date("d M Y", strtotime($date));
		return $newDate;		
}
	
?>