<?php	
include_once '../includes/inc_config.php'; //Making paging validation
include_once $inc_nocache; //Clearing the cache information
include_once $adm_session; //checking for session
include_once $inc_cnctn; //Making database Connection
include_once $inc_usr_fnctn; //checking for session
if(isset($_POST['btnrmszsbmt']) && (trim($_POST['btnrmszsbmt']) != "") && isset($_POST['lstvehtyp']) && (trim($_POST['lstvehtyp']) != "") && isset($_POST['lsttyrwdth']) && (trim($_POST['lsttyrwdth']) != "") && isset($_POST['lsttyrprfl']) && (trim($_POST['lsttyrprfl']) != "") && isset($_POST['txtname']) && (trim($_POST['txtname']) != "") && isset($_POST['txtprior']) && (trim($_POST['txtprior']) != ""))
{
	$name = glb_func_chkvl($_POST['txtname']);
	$vehtyp = glb_func_chkvl($_POST['lstvehtyp']);
	$tyrwdth = glb_func_chkvl($_POST['lsttyrwdth']);
	$tyrprfl = glb_func_chkvl($_POST['lsttyrprfl']);
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
	$sqrytyrrmsz_mst = "SELECT tyrrmszm_name from tyr_rimsize_mst where tyrrmszm_name ='$name' and tyrrmszm_vehtypm_id ='$vehtyp' and tyrrmszm_tyrwdthm_id ='$tyrwdth'";
	$srstyrrmsz_mst = mysqli_query($conn,$sqrytyrrmsz_mst);
	$rows = mysqli_num_rows($srstyrrmsz_mst);
	if($rows < 1)
	{
		$iqrytyrrmsz_mst="INSERT into tyr_rimsize_mst(tyrrmszm_name, tyrrmszm_desc, tyrrmszm_vehtypm_id, tyrrmszm_tyrwdthm_id, tyrrmszm_tyrprflm_id, tyrrmszm_seotitle, tyrrmszm_seodesc, tyrrmszm_seokywrd, tyrrmszm_seohonetitle, tyrrmszm_seohonedesc, tyrrmszm_seohtwotitle, tyrrmszm_seohtwodesc, tyrrmszm_prty, tyrrmszm_sts, tyrrmszm_crtdon, tyrrmszm_crtdby) values ('$name', '$desc', '$vehtyp', '$tyrwdth', '$tyrprfl', '$title', '$seodesc', '$seokywrd', '$seoh1_tle', '$seoh1_desc', '$seoh2_tle', '$seoh2_desc', '$prior', '$sts', '$curdt', '$ses_admin')";
		$irstyrrmsz_mst= mysqli_query($conn,$iqrytyrrmsz_mst) or die(mysqli_error());
		// $irstyrrmsz_mst= mysqli_query($conn, $iqrytyrrmsz_mst) or die(mysqli_error());
		if($irstyrrmsz_mst == true)
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