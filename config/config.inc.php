<?php
	define("APP_URL", $server_location);
	
	#---------------------
	# Include System files
	#---------------------
	require_once($server_location.'classes/base.cls.php');
	
	require_once($server_location.'classes/structure.cls.php');

	require_once($server_location.'config/constants.inc.php');
	
	require_once($server_location.'config/dbinfo.inc.php');
	
	require_once($server_location.'config/wrapper.oci.inc.php');
	
	#---------------------
	# Project Setup Related Class
	#---------------------
	require_once($server_location.'classes/projectSetup.cls.php');
	
	require_once($server_location.'classes/package.cls.php');
	
	require_once($server_location.'classes/projectSetupInsert.cls.php');
	
	require_once($server_location.'classes/projectSetupUpdate.cls.php');
	
	#---------------------
	# Include Additional Class files
	#---------------------
	
	
	require_once($server_location.'classes/action.cls.php');
	
	require_once($server_location.'classes/insert.cls.php');
	
	require_once($server_location.'classes/update.cls.php');
	
	
	
	#---------------------
	# Start ADB Project Class
	#---------------------
	
	require_once($server_location.'classes/projectSetupInsertNew.cls.php');
	require_once($server_location.'classes/pacakgeInformationInsert.cls.php');
	require_once($server_location.'classes/pacakgeInformationEditInsert.cls.php');
	require_once($server_location.'classes/report.cls.php');
	require_once($server_location.'classes/procurementEdit.cls.php');
	require_once($server_location.'classes/PaultryInsertNew.cls.php');
	require_once($server_location.'classes/PaultrySetup.cls.php');
	require_once($server_location.'classes/HatcheryInsertNew.cls.php');
	require_once($server_location.'classes/HatcherySetup.cls.php');
	
?>

