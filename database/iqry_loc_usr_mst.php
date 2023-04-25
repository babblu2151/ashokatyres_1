<?php	
include_once '../includes/inc_config.php'; //Making paging validation
include_once $inc_nocache; //Clearing the cache information
include_once $adm_session; //checking for session
include_once $inc_cnctn; //Making database Connection
include_once $inc_usr_fnctn; //checking for session 
include_once $inc_pgng_fnctns; //Making paging validation
if(isset($_POST['btnlocusrsbmt']) && (trim($_POST['btnlocusrsbmt']) != "") && isset($_POST['lststrloc']) && (trim($_POST['lststrloc']) != "") && isset($_POST['txtname']) && (trim($_POST['txtname']) != "") && isset($_POST['txtcnfpwd']) && (trim($_POST['txtcnfpwd']) != ""))
{
	$name = glb_func_chkvl($_POST['txtname']);
	$strloc = glb_func_chkvl($_POST['lststrloc']);
	$pwd = md5(glb_func_chkvl($_POST['txtcnfpwd']));
	$sts = glb_func_chkvl($_POST['lststs']);
	$curdt = date('Y-m-d h-i-s');
	$sqryloc_usr_mst = "SELECT lgnm_name from lgn_mst where lgnm_name ='$name' and lgnm_store_id ='$strloc'";
	$srslgn_mst = mysqli_query($conn,$sqryloc_usr_mst);
	$rows = mysqli_num_rows($srslgn_mst);
	if($rows < 1)
	{
		$iqrylgn_mst="INSERT into lgn_mst(lgnm_uid, lgnm_pwd, lgnm_typ, lgnm_store_id, lgnm_sts, lgnm_crtdon, lgnm_crtdby) values ('$name', '$pwd', 'u', '$strloc', '$sts', '$curdt', '$ses_admin')";
		$irslgn_mst= mysqli_query($conn,$iqrylgn_mst) or die(mysqli_error());
		if($irslgn_mst==true)
		{
			$gmsg = "Record saved successfully";
		}
		else
		{
			$gmsg = "Record not saved";
		}
	}
	else
	{		
		$gmsg = "Duplicate name. Record not saved";
	}
}
?>