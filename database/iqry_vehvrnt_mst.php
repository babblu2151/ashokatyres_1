<?php	
include_once '../includes/inc_config.php'; //Making paging validation
include_once $inc_nocache; //Clearing the cache information
include_once $adm_session; //checking for session
include_once $inc_cnctn; //Making database Connection
include_once $inc_usr_fnctn; //checking for session
if(isset($_POST['btnvrntsbmt']) && (trim($_POST['btnvrntsbmt']) != "") && isset($_POST['lstvehtyp']) && (trim($_POST['lstvehtyp']) != "") && isset($_POST['lstvehbrnd']) && (trim($_POST['lstvehbrnd']) != "") && isset($_POST['lstvehmdl']) && (trim($_POST['lstvehmdl']) != "") && isset($_POST['txtname']) && (trim($_POST['txtname']) != "") && isset($_POST['txtprior']) && (trim($_POST['txtprior']) != ""))
{
	$name = glb_func_chkvl($_POST['txtname']);
	$vehtyp = glb_func_chkvl($_POST['lstvehtyp']);
	$vehbrnd = glb_func_chkvl($_POST['lstvehbrnd']);
	$vehmdl = glb_func_chkvl($_POST['lstvehmdl']);
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
	$sqryveh_vrnt_mst = "SELECT vehvrntm_name from veh_vrnt_mst where vehvrntm_name ='$name' and vehvrntm_vehtypm_id ='$vehtyp' and vehvrntm_vehbrndm_id ='$vehbrnd'";
	$srsvehvrnt_mst = mysqli_query($conn,$sqryveh_vrnt_mst);
	$rows = mysqli_num_rows($srsvehvrnt_mst);
	if($rows < 1)
	{
		$iqryvehvrnt_mst="INSERT into veh_vrnt_mst(vehvrntm_name, vehvrntm_desc, vehvrntm_vehtypm_id, vehvrntm_vehbrndm_id, vehvrntm_vehmdlm_id, vehvrntm_seotitle, vehvrntm_seodesc, vehvrntm_seokywrd, vehvrntm_seohonetitle, vehvrntm_seohonedesc, vehvrntm_seohtwotitle, vehvrntm_seohtwodesc, vehvrntm_prty, vehvrntm_sts, vehvrntm_crtdon, vehvrntm_crtdby) values ('$name', '$desc', '$vehtyp', '$vehbrnd', '$vehmdl', '$title', '$seodesc', '$seokywrd', '$seoh1_tle', '$seoh1_desc', '$seoh2_tle', '$seoh2_desc', '$prior', '$sts', '$curdt', '$ses_admin')";
		$irsvehvrnt_mst= mysqli_query($conn,$iqryvehvrnt_mst) or die(mysqli_error());
		// $irsvehvrnt_mst= mysqli_query($conn, $iqryvehvrnt_mst) or die(mysqli_error());
		if($irsvehvrnt_mst == true)
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