<?php
include_once '../includes/inc_nocache.php'; // Clearing the cache information
include_once '../includes/inc_adm_session.php'; //checking for session
include_once '../includes/inc_usr_functions.php'; //Use function for validation and more	
include_once "../includes/inc_folder_path.php";	
if(isset($_POST['btnemdlsbmt']) && (trim($_POST['btnemdlsbmt']) != "") && isset($_POST['lstvehtyp']) && (trim($_POST['lstvehtyp']) != "") && isset($_POST['lstvehbrnd']) && (trim($_POST['lstvehbrnd']) != "") && isset($_POST['txtname']) && (trim($_POST['txtname']) != "") && isset($_POST['txtprior']) && (trim($_POST['txtprior']) != ""))
{
	$id = glb_func_chkvl($_POST['hdnvehmdlid']);
	$vehtypid = glb_func_chkvl($_POST['lstvehtyp']);
	$vehbrndid = glb_func_chkvl($_POST['lstvehbrnd']);
	$name = glb_func_chkvl($_POST['txtname']);
	$prior = glb_func_chkvl($_POST['txtprior']);
	$desc = addslashes(trim($_POST['txtdesc']));
	$title = glb_func_chkvl($_POST['txtseotitle']);
	$seodesc = glb_func_chkvl($_POST['txtseodesc']);
	$kywrd = glb_func_chkvl($_POST['txtkywrd']);
	$seoh1_tle = glb_func_chkvl($_POST['txtseoh1tle']);
	$seoh2_tle = glb_func_chkvl($_POST['txtseoh2tle']);
	$seoh1_desc = glb_func_chkvl($_POST['txtseoh1desc']);
	$seoh2_desc = glb_func_chkvl($_POST['txtseoh2desc']);
	$pg = glb_func_chkvl($_REQUEST['hdnpage']);
	$countstart = glb_func_chkvl($_REQUEST['hdncnt']);
	$sts = glb_func_chkvl($_POST['lststs']);
	$srchval = addslashes(trim($_POST['hdnloc']));
	$curdt = date('Y-m-d h:i:s');
	$sqryveh_model_mst = "SELECT vehmodlm_name from veh_model_mst where vehmodlm_name = '$name' and vehmodlm_vehtypm_id = '$vehtypid' and vehmodlm_vehbrndm_id = '$vehbrndid' and vehmodlm_id != $id";
	$srsveh_model_mst = mysqli_query($conn,$sqryveh_model_mst);
	$cntmdlm = mysqli_num_rows($srsveh_model_mst);
	if($cntmdlm < 1)
	{
		$uqryveh_model_mst="UPDATE veh_model_mst set vehmodlm_name = '$name', vehmodlm_desc = '$desc', vehmodlm_vehtypm_id='$vehtypid', vehmodlm_vehbrndm_id='$vehbrndid', vehmodlm_seotitle = '$title', vehmodlm_seodesc = '$seodesc', vehmodlm_seokywrd = '$kywrd', vehmodlm_seohonetitle = '$seoh1_tle', vehmodlm_seohonedesc = '$seoh1_desc', vehmodlm_seohtwotitle = '$seoh2_tle', vehmodlm_seohtwodesc = '$seoh2_desc', vehmodlm_sts = '$sts', vehmodlm_prty = '$prior', vehmodlm_mdfdon = '$curdt', vehmodlm_mdfdby = '$ses_admin' where vehmodlm_id = '$id'";
		// echo $uqryveh_model_mst; exit;
		$ursveh_model_mst = mysqli_query($conn,$uqryveh_model_mst);
		if($ursveh_model_mst == true)
		{ ?>
			<script>location.href="view_detail_veh_mdl.php?vw=<?php echo $id;?>&sts=y&pg=<?php echo $pg;?>&countstart=<?php echo $countstart.$srchval;?>";</script>
			<?php
		}
		else
		{ ?>
			<script>location.href="view_detail_veh_mdl.php?vw=<?php echo $id;?>&sts=n&pg=<?php echo $pg;?>&countstart=<?php echo $countstart.$srchval;?>";</script>
			<?php
		}
	}
	else
	{ ?>
		<script>location.href="view_detail_veh_mdl.php?vw=<?php echo $id;?>&sts=d&pg=<?php echo $pg;?>&countstart=<?php echo $countstart;?>";
		</script>
		<?php
	}
}
?>