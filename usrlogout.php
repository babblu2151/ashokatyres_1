<?php
error_reporting(0);	
	include_once 'includes/inc_nocache.php'; // Clearing the cache information  	
	include_once "includes/inc_membr_session.php";//checking for session	
	include_once "includes/inc_config.php";//checking for session
	error_reporting(0);	
	//*****************************************//
	//Program     	: logout.php
	//Purpose     	: User Logout Page
	//Created By  	: sravan
	//Created On    : 03-01-2022
	//Modified By 	: 
	//Modified On 	: 	
	//Company     	: Adroit 	 
	//*****************************************//		
	session_unset();
	session_destroy();
	?>
	 <script type="text/javascript">

					location.href = "<?php echo $rtpth;?>signin";

					</script>
	<?php
	exit();
?>
