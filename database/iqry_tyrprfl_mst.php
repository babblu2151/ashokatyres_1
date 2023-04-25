<?php	
include_once '../includes/inc_config.php'; //Making paging validation
include_once $inc_nocache; //Clearing the cache information
include_once $adm_session; //checking for session
include_once $inc_cnctn; //Making database Connection
include_once $inc_usr_fnctn; //checking for session
if(isset($_POST['btntyrprflsbmt']) && (trim($_POST['btntyrprflsbmt']) != "") && isset($_POST['lstvehtyp']) && (trim($_POST['lstvehtyp']) != "") && isset($_POST['lsttyrwdth']) && (trim($_POST['lsttyrwdth']) != "") && isset($_POST['txtname']) && (trim($_POST['txtname']) != "") && isset($_POST['txtprior']) && (trim($_POST['txtprior']) != ""))
{
	$name = glb_func_chkvl($_POST['txtname']);
	$vehtyp = glb_func_chkvl($_POST['lstvehtyp']);
	$tyrwdth = glb_func_chkvl($_POST['lsttyrwdth']);
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
	$sqrytyrprfl_mst = "SELECT tyrprflm_name from tyr_prfl_mst where tyrprflm_name ='$name' and tyrprflm_vehtypm_id ='$vehtyp' and tyrprflm_tyrwdthm_id ='$tyrwdth'";
	$srstyrprfl_mst = mysqli_query($conn,$sqrytyrprfl_mst);
	$rows = mysqli_num_rows($srstyrprfl_mst);
	if($rows < 1)
	{
		$iqrytyrprfl_mst="INSERT into tyr_prfl_mst(tyrprflm_name, tyrprflm_desc, tyrprflm_vehtypm_id, tyrprflm_tyrwdthm_id, tyrprflm_seotitle, tyrprflm_seodesc, tyrprflm_seokywrd, tyrprflm_seohonetitle, tyrprflm_seohonedesc, tyrprflm_seohtwotitle, tyrprflm_seohtwodesc, tyrprflm_prty, tyrprflm_sts, tyrprflm_crtdon, tyrprflm_crtdby) values ('$name', '$desc', '$vehtyp', '$tyrwdth', '$title', '$seodesc', '$seokywrd', '$seoh1_tle', '$seoh1_desc', '$seoh2_tle', '$seoh2_desc', '$prior', '$sts', '$curdt', '$ses_admin')";
		$irstyrprfl_mst= mysqli_query($conn,$iqrytyrprfl_mst) or die(mysqli_error());
		// $irstyrprfl_mst= mysqli_query($conn, $iqrytyrprfl_mst) or die(mysqli_error());
		if($irstyrprfl_mst==true)
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