<?php	
include_once "../includes/inc_adm_session.php"; //checking for session
include_once "../includes/inc_connection.php"; //Making database Connection	
include_once "../includes/inc_usr_functions.php"; //Use function for validation and more
if(isset($_POST['btntyrtypsbmt']) && (trim($_POST['btntyrtypsbmt']) != "") && isset($_POST['txtname']) && (trim($_POST['txtname']) != "") && isset($_POST['txtcde']) && (trim($_POST['txtcde']) != "") && isset($_POST['txtprior']) && (trim($_POST['txtprior']) != ""))
{
	$name = glb_func_chkvl($_POST['txtname']);
	$code = glb_func_chkvl($_POST['txtcde']);
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
	$sqrytyr_type_mst ="SELECT tyrtypm_name from tyr_type_mst where tyrtypm_name ='$name' and tyrtypm_cde = '$code'";
	$srstyr_type_mst = mysqli_query($conn,$sqrytyr_type_mst);
	$rows = mysqli_num_rows($srstyr_type_mst);
	if($rows < 1)
	{
		$iqrytyr_type_mst ="INSERT into tyr_type_mst(tyrtypm_name, tyrtypm_cde, tyrtypm_sts,tyrtypm_desc, tyrtypm_seotitle, tyrtypm_seodesc, tyrtypm_seokywrd, tyrtypm_seohonetitle, tyrtypm_seohonedesc, tyrtypm_seohtwotitle, tyrtypm_seohtwodesc, tyrtypm_prty, tyrtypm_crtdon, tyrtypm_crtdby) values ('$name', '$code', '$sts', '$desc', '$title', '$seodesc', '$seokywrd', '$seoh1_tle', '$seoh1_desc', '$seoh2_tle', '$seoh2_desc', '$prior', '$cur_dt', '$ses_admin')";
		$irstyr_type_mst = mysqli_query($conn,$iqrytyr_type_mst) or die (mysqli_error());
		if($irstyr_type_mst == true)
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