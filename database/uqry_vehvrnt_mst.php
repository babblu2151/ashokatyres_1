<?php
include_once '../includes/inc_nocache.php'; // Clearing the cache information
include_once '../includes/inc_adm_session.php'; //checking for session
include_once '../includes/inc_usr_functions.php'; //Use function for validation and more	
include_once "../includes/inc_folder_path.php";	
if(isset($_POST['btnevrntsbmt']) && (trim($_POST['btnevrntsbmt']) != "") && isset($_POST['lstvehtyp']) && (trim($_POST['lstvehtyp']) != "") && isset($_POST['lstvehbrnd']) && (trim($_POST['lstvehbrnd']) != "") && isset($_POST['lstvehmdl']) && (trim($_POST['lstvehmdl']) != "") && isset($_POST['txtname']) && (trim($_POST['txtname']) != "") && isset($_POST['txtprior']) && (trim($_POST['txtprior']) != ""))
{
	$id = glb_func_chkvl($_POST['hdnvehvrntid']);
	$vehtypid = glb_func_chkvl($_POST['lstvehtyp']);
	$vehbrndid = glb_func_chkvl($_POST['lstvehbrnd']);
	$vehmdlid = glb_func_chkvl($_POST['lstvehmdl']);
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
	$sqryvehvrnt_mst = "SELECT vehvrntm_name from veh_vrnt_mst where vehvrntm_name = '$name' and vehvrntm_vehtypm_id = '$vehtypid' and vehvrntm_vehbrndm_id = '$vehbrndid' and vehvrntm_vehmdlm_id = '$vehmdlid' and vehvrntm_id != $id";
	$srsvehvrnt_mst = mysqli_query($conn,$sqryvehvrnt_mst);
	$cntvrntm = mysqli_num_rows($srsvehvrnt_mst);
	if($cntvrntm < 1)
	{
		$uqryvehvrnt_mst="UPDATE veh_vrnt_mst set vehvrntm_name = '$name', vehvrntm_desc = '$desc', vehvrntm_vehtypm_id='$vehtypid', vehvrntm_vehbrndm_id='$vehbrndid', vehvrntm_vehmdlm_id='$vehmdlid', vehvrntm_seotitle = '$title', vehvrntm_seodesc = '$seodesc', vehvrntm_seokywrd = '$kywrd', vehvrntm_seohonetitle = '$seoh1_tle', vehvrntm_seohonedesc = '$seoh1_desc', vehvrntm_seohtwotitle = '$seoh2_tle', vehvrntm_seohtwodesc = '$seoh2_desc', vehvrntm_sts = '$sts', vehvrntm_prty = '$prior', vehvrntm_mdfdon = '$curdt', vehvrntm_mdfdby = '$ses_admin' where vehvrntm_id = '$id'";
		// echo $uqryvehvrnt_mst; exit;
		$ursvehvrnt_mst = mysqli_query($conn,$uqryvehvrnt_mst);
		if($ursvehvrnt_mst == true)
		{ ?>
			<script>location.href="view_detail_veh_vrnt.php?vw=<?php echo $id;?>&sts=y&pg=<?php echo $pg;?>&countstart=<?php echo $countstart.$srchval;?>";</script>
			<?php
		}
		else
		{ ?>
			<script>location.href="view_detail_veh_vrnt.php?vw=<?php echo $id;?>&sts=n&pg=<?php echo $pg;?>&countstart=<?php echo $countstart.$srchval;?>";</script>
			<?php
		}
	}
	else
	{ ?>
		<script>location.href="view_detail_veh_vrnt.php?vw=<?php echo $id;?>&sts=d&pg=<?php echo $pg;?>&countstart=<?php echo $countstart;?>";
		</script>
		<?php
	}
}
?>