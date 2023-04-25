<?php	
include_once "../includes/inc_adm_session.php"; //checking for session
include_once "../includes/inc_connection.php"; //Making database Connection	
include_once "../includes/inc_usr_functions.php"; //Use function for validation and more
if(isset($_POST['btnstrlocsbmt']) && (trim($_POST['btnstrlocsbmt']) != "") && isset($_POST['txtname']) && (trim($_POST['txtname']) != "") && isset($_POST['txtprior']) && (trim($_POST['txtprior']) != ""))
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
	$sqrystr_loc_mst ="SELECT strlocm_name from store_loc_mst where strlocm_name ='$name'";
	$srsstore_loc_mst = mysqli_query($conn,$sqrystr_loc_mst);
	$rows = mysqli_num_rows($srsstore_loc_mst);
	if($rows < 1)
	{
		$iqrystore_loc_mst ="INSERT into store_loc_mst(strlocm_name, strlocm_sts,strlocm_desc, strlocm_seotitle, strlocm_seodesc, strlocm_seokywrd, strlocm_seohonetitle, strlocm_seohonedesc, strlocm_seohtwotitle, strlocm_seohtwodesc, strlocm_prty, strlocm_crtdon, strlocm_crtdby) values ( '$name', '$sts', '$desc', '$title', '$seodesc', '$seokywrd', '$seoh1_tle', '$seoh1_desc', '$seoh2_tle', '$seoh2_desc', '$prior', '$cur_dt', '$ses_admin')";
		$irsstore_loc_mst = mysqli_query($conn,$iqrystore_loc_mst) or die (mysqli_error());
		$insert_id = mysqli_insert_id($conn);
		if($irsstore_loc_mst == true)
		{
			$sqrystr_prods ="SELECT prodm_id from prod_mst";
			$srsstore_prods = mysqli_query($conn,$sqrystr_prods);
			$cnt = mysqli_num_rows($srsstore_prods);
			if ($cnt > 0)
			{
				while($rwsstr_prods = mysqli_fetch_assoc($srsstore_prods))
				{
					$prod_id = $rwsstr_prods['prodm_id'];
					$iqry_str_prds = "INSERT into prod_store_dtl (prods_prodm_id, prods_store_id, prods_sts, prods_crton, prods_crtby) values ('$prod_id','$insert_id','$sts','$cur_dt','$ses_admin')";
					$irsstore_prod = mysqli_query($conn,$iqry_str_prds) or die (mysqli_error());
				}
			}
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