<?php	
include_once "../includes/inc_adm_session.php"; //checking for session
include_once "../includes/inc_connection.php"; //Making database Connection	
include_once "../includes/inc_usr_functions.php"; //Use function for validation and more
if(isset($_POST['btnvehtypsbmt']) && (trim($_POST['btnvehtypsbmt']) != "") && isset($_POST['txtname']) && (trim($_POST['txtname']) != "") && isset($_POST['txtprior']) && (trim($_POST['txtprior']) != ""))
{
	$name = glb_func_chkvl($_POST['txtname']);
	$desc = addslashes(trim($_POST['txtdesc']));
	$prior = glb_func_chkvl($_POST['txtprior']);
	$hmprior = glb_func_chkvl($_POST['txthmprior']);
	$title = glb_func_chkvl($_POST['txtseotitle']);
	$seodesc = glb_func_chkvl($_POST['txtseodesc']);
	$seokywrd = glb_func_chkvl($_POST['txtkywrd']);
	$seoh1_tle = glb_func_chkvl($_POST['txtseoh1tle']);
	$seoh2_tle = glb_func_chkvl($_POST['txtseoh2tle']);
	$seoh1_desc = glb_func_chkvl($_POST['txtseoh1desc']);
	$seoh2_desc = glb_func_chkvl($_POST['txtseoh2desc']);
	$sts = glb_func_chkvl($_POST['lststs']);
	$cur_dt = date('Y-m-d h:i:s');
	$sqryveh_type_mst ="SELECT vehtypm_name from veh_type_mst where vehtypm_name ='$name'";
	$srsveh_type_mst = mysqli_query($conn,$sqryveh_type_mst);
	$rows = mysqli_num_rows($srsveh_type_mst);
	if($rows < 1)
	{
		$iqryveh_type_mst ="INSERT into veh_type_mst(vehtypm_name, vehtypm_sts,vehtypm_desc, vehtypm_seotitle, vehtypm_seodesc, vehtypm_seokywrd, vehtypm_seohonetitle, vehtypm_seohonedesc, vehtypm_seohtwotitle, vehtypm_seohtwodesc, vehtypm_prty, vehtypm_crtdon, vehtypm_crtdby) values ( '$name', '$sts', '$desc', '$title', '$seodesc', '$seokywrd', '$seoh1_tle', '$seoh1_desc', '$seoh2_tle', '$seoh2_desc', '$prior', '$cur_dt', '$ses_admin')";
		$irsveh_type_mst = mysqli_query($conn,$iqryveh_type_mst) or die (mysqli_error());
		if($irsveh_type_mst == true)
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