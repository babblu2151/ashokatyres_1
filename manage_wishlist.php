<?php
error_reporting(0);
    session_start();
	        include_once "includes/inc_membr_session.php";//checking for session	
			include_once 'includes/inc_nocache.php'; // Clearing the cache information
            include_once 'includes/inc_connection.php';//Make connection with the database  	
            include_once "includes/inc_config.php";	//path config file
		    include_once "includes/inc_usr_functions.php";//Including user session value
			include_once "includes/inc_folder_path.php";//  folder path confige
			 $membrid   = $_SESSION['sesmbrid'];	
	/**********************Checking And Assigning Request Values *************************/
	if((isset($_REQUEST['prodid']) && $_REQUEST['prodid'] !='' )&& (isset($_REQUEST['memid']) && $_REQUEST['memid'] !='' )&& (isset($_REQUEST['vehcbrndid']) && $_REQUEST['vehcbrndid'] !='' )){
		
	$wshprdid=$_REQUEST['prodid'];
	$wshmemid=$_REQUEST['memid'];
	$email= $_SESSION['sesmbremail'];
	 $vehbrndid=$_REQUEST['vehcbrndid'] ;
	
$dt=date('Y-m-d');
			
				 $sqryusrwshlst_dtl="select 
		 						* 
		 					  from 
		 						usrwshlst_dtl 
							  where
								usrwshlstd_prodm_id='$wshprdid' and
								
								usrwshlstd_mbrm_id='$wshmemid' and usrwshlstd_vehbrnd_id='$vehbrndid'";
		$srsusrwshlst_dtl=mysqli_query($conn,$sqryusrwshlst_dtl);
		$norusrwshlst_dtl=mysqli_num_rows($srsusrwshlst_dtl);
		if($norusrwshlst_dtl == 0){ 
			 $iqryusrwshlst_dtl="		insert into usrwshlst_dtl ( usrwshlstd_sesid,usrwshlstd_prodm_id,usrwshlstd_untm_id, usrwshlstd_vehbrnd_id,usrwshlstd_qty,usrwshlstd_mbrm_id,usrwshlstd_sts,usrwshlstd_crtdon,usrwshlstd_crtdby) values ('$sessid', '$wshprdid', '1', '$vehbrndid', '1', '$membrid', 'a', '$dt', '$email')";

		
			$irsusrwshlst_dtl	=mysqli_query($conn,$iqryusrwshlst_dtl);	
			
			echo 'wy';
		}else{
			
			echo 'wn';
			}
			
								
	}
	
	if(isset($_REQUEST['wshlstprodid']) && $_REQUEST['wshlstprodid'] !=''&& isset($_REQUEST['wshlstacton']) && $_REQUEST['wshlstacton'] =='d'){
	$wshlstprdid=$_REQUEST['wshlstprodid'];
	$wshlstdel="delete from  usrwshlst_dtl where usrwshlstd_id='$wshlstprdid' and usrwshlstd_mbrm_id='$membrid'";
	$rwswshlstdel=mysqli_query($conn,$wshlstdel);
	if($rwswshlstdel == true){
		$sts='y';
		}else{
			$sts='n';
			}
			echo  $sts;
	}

?>