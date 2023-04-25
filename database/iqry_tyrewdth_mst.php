<?php	
include_once '../includes/inc_config.php'; //Making paging validation
include_once $inc_nocache; //Clearing the cache information
include_once $adm_session; //checking for session
include_once $inc_cnctn; //Making database Connection
include_once $inc_usr_fnctn; //checking for session 
include_once $inc_pgng_fnctns; //Making paging validation
include_once $inc_fldr_pth; //Making paging validation
if(isset($_POST['btntyrwdthsbmt']) && (trim($_POST['btntyrwdthsbmt']) != "") && isset($_POST['txtname']) && (trim($_POST['txtname']) != "") && isset($_POST['lstvehtyp']) && (trim($_POST['lstvehtyp']) != "") && isset($_POST['txtprior']) && (trim($_POST['txtprior']) != ""))
{
	$name = glb_func_chkvl($_POST['txtname']);
	$vehtyp = glb_func_chkvl($_POST['lstvehtyp']);
	$desc = addslashes(trim($_POST['txtdesc']));
	$prior = glb_func_chkvl($_POST['txtprior']);
	$title = glb_func_chkvl($_POST['txtseotitle']);
	$seodesc = glb_func_chkvl($_POST['txtseodesc']);
	$seokywrd = glb_func_chkvl($_POST['txtkywrd']);
	$seoh1_tle = glb_func_chkvl($_POST['txtseoh1tle']);
	$seoh2_tle = glb_func_chkvl($_POST['txtseoh2tle']);
	$seoh1_desc = glb_func_chkvl($_POST['txtseoh1desc']);
	$seoh2_desc = glb_func_chkvl($_POST['txtseoh2desc']);
	$sts = glb_func_chkvl($_POST['lststs']);
	$curdt = date('Y-m-d h-i-s');
	$sqrytyrwdth_mst = "SELECT tyrwdthm_name from tyr_wdth_mst where tyrwdthm_name ='$name' and tyrwdthm_vehtypm_id ='$vehtyp'";
	$srstyrwdth_mst = mysqli_query($conn,$sqrytyrwdth_mst);
	$rows = mysqli_num_rows($srstyrwdth_mst);
	if($rows < 1)
	{
		$iqrytyrwdth_mst = "INSERT into tyr_wdth_mst(tyrwdthm_name, tyrwdthm_vehtypm_id, tyrwdthm_desc, tyrwdthm_seotitle, tyrwdthm_seodesc, tyrwdthm_seokywrd, tyrwdthm_seohonetitle, tyrwdthm_seohonedesc, tyrwdthm_seohtwotitle, tyrwdthm_seohtwodesc, tyrwdthm_prty, tyrwdthm_sts, tyrwdthm_crtdon, tyrwdthm_crtdby) values ('$name', '$vehtyp', '$desc', '$title', '$seodesc', '$seokywrd', '$seoh1_tle', '$seoh1_desc', '$seoh2_tle', '$seoh2_desc', '$prior', '$sts', '$curdt', '$ses_admin')";
		$irstyrwdth_mst= mysqli_query($conn,$iqrytyrwdth_mst) or die(mysqli_error());
		if($irstyrwdth_mst==true)
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