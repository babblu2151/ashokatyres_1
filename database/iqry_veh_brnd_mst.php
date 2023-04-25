<?php	
include_once '../includes/inc_config.php'; //Making paging validation
include_once $inc_nocache; //Clearing the cache information
include_once $adm_session; //checking for session
include_once $inc_cnctn; //Making database Connection
include_once $inc_usr_fnctn; //checking for session 
include_once $inc_pgng_fnctns; //Making paging validation
include_once $inc_fldr_pth; //Making paging validation
if(isset($_POST['btnbrndsbmt']) && (trim($_POST['btnbrndsbmt']) != "") && isset($_POST['lstvehtyp']) && (trim($_POST['lstvehtyp']) != "") && isset($_POST['txtname']) && (trim($_POST['txtname']) != "") && isset($_POST['txtprior']) && (trim($_POST['txtprior']) != ""))
{
	$name = glb_func_chkvl($_POST['txtname']);
	$vehtyp = glb_func_chkvl($_POST['lstvehtyp']);
	$desc = addslashes(trim($_POST['txtdesc']));
	$prior = glb_func_chkvl($_POST['txtprior']);
	$brndimg = glb_func_chkvl($_POST['txtbrndimg']);
	$title = glb_func_chkvl($_POST['txtseotitle']);
	$seodesc = glb_func_chkvl($_POST['txtseodesc']);
	$seokywrd = glb_func_chkvl($_POST['txtkywrd']);
	$seoh1_tle = glb_func_chkvl($_POST['txtseoh1tle']);
	$seoh2_tle = glb_func_chkvl($_POST['txtseoh2tle']);
	$seoh1_desc = glb_func_chkvl($_POST['txtseoh1desc']);
	$seoh2_desc = glb_func_chkvl($_POST['txtseoh2desc']);
	$sts = glb_func_chkvl($_POST['lststs']);
	$curdt = date('Y-m-d h-i-s');
	$sqryveh_brnd_mst = "SELECT vehbrndm_name from veh_brnd_mst where vehbrndm_name ='$name' and vehbrndm_vehtypm_id ='$vehtyp'";
	$srsvehbrnd_mst = mysqli_query($conn,$sqryveh_brnd_mst);
	$rows = mysqli_num_rows($srsvehbrnd_mst);
	if($rows < 1)
	{
		if(isset($_FILES['flebrndimg']['tmp_name']) && ($_FILES['flebrndimg']['tmp_name']!=""))
		{
			$brndimgval = funcUpldImg('flebrndimg','vehbrndimg');
			if($brndimgval != "")
			{
				$brndimgary = explode(":",$brndimgval,2);
				$brnddest = $brndimgary[0];
				$brndsource = $brndimgary[1];
			}
		}
		$iqryvehbrnd_mst="INSERT into veh_brnd_mst(vehbrndm_name, vehbrndm_desc, vehbrndm_vehtypm_id, vehbrndm_seotitle, vehbrndm_seodesc, vehbrndm_seokywrd, vehbrndm_seohonetitle, vehbrndm_seohonedesc, vehbrndm_seohtwotitle, vehbrndm_seohtwodesc, vehbrndm_prty, vehbrndm_sts, vehbrndm_brndimg, vehbrndm_crtdon, vehbrndm_crtdby) values ('$name', '$desc', '$vehtyp', '$title', '$seodesc', '$seokywrd', '$seoh1_tle', '$seoh1_desc', '$seoh2_tle', '$seoh2_desc', '$prior', '$sts', '$brnddest', '$curdt', '$ses_admin')";
		$irsvehbrnd_mst= mysqli_query($conn,$iqryvehbrnd_mst) or die(mysqli_error());
		if($irsvehbrnd_mst==true)
		{
			if(($brndsource!='none') && ($brndsource!='') && ($brnddest != ""))
			{ 			
				move_uploaded_file($brndsource,$gvehbrndimg_upldpth.$brnddest);					
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