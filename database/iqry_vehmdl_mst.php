<?php	
include_once '../includes/inc_config.php'; //Making paging validation
include_once $inc_nocache; //Clearing the cache information
include_once $adm_session; //checking for session
include_once $inc_cnctn; //Making database Connection
include_once $inc_usr_fnctn; //checking for session
if(isset($_POST['btnmdlsbmt']) && (trim($_POST['btnmdlsbmt']) != "") && isset($_POST['lstvehtyp']) && (trim($_POST['lstvehtyp']) != "") && isset($_POST['lstvehbrnd']) && (trim($_POST['lstvehbrnd']) != "") && isset($_POST['txtname']) && (trim($_POST['txtname']) != "") && isset($_POST['txtprior']) && (trim($_POST['txtprior']) != ""))
{
	$name = glb_func_chkvl($_POST['txtname']);
	$vehtyp = glb_func_chkvl($_POST['lstvehtyp']);
	$vehbrnd = glb_func_chkvl($_POST['lstvehbrnd']);
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
	$sqryveh_model_mst = "SELECT vehmodlm_name from veh_model_mst where vehmodlm_name ='$name' and vehmodlm_vehtypm_id ='$vehtyp' and vehmodlm_vehbrndm_id ='$vehbrnd'";
	$srsvehmdl_mst = mysqli_query($conn,$sqryveh_model_mst);
	$rows = mysqli_num_rows($srsvehmdl_mst);
	if($rows < 1)
	{
		$iqryvehmdl_mst="INSERT into veh_model_mst(vehmodlm_name, vehmodlm_desc, vehmodlm_vehtypm_id, vehmodlm_vehbrndm_id, vehmodlm_seotitle, vehmodlm_seodesc, vehmodlm_seokywrd, vehmodlm_seohonetitle, vehmodlm_seohonedesc, vehmodlm_seohtwotitle, vehmodlm_seohtwodesc, vehmodlm_prty, vehmodlm_sts, vehmodlm_crtdon, vehmodlm_crtdby) values ('$name', '$desc', '$vehtyp', '$vehbrnd', '$title', '$seodesc', '$seokywrd', '$seoh1_tle', '$seoh1_desc', '$seoh2_tle', '$seoh2_desc', '$prior', '$sts', '$curdt', '$ses_admin')";
		$irsvehmdl_mst= mysqli_query($conn,$iqryvehmdl_mst) or die(mysqli_error());
		// $irsvehmdl_mst= mysqli_query($conn, $iqryvehmdl_mst) or die(mysqli_error());
		if($irsvehmdl_mst==true)
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