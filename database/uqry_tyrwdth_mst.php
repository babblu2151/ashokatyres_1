<?php
include_once '../includes/inc_nocache.php'; // Clearing the cache information
include_once '../includes/inc_adm_session.php'; //checking for session
include_once '../includes/inc_usr_functions.php'; //Use function for validation and more	
include_once "../includes/inc_folder_path.php";	
if(isset($_POST['btnetyrwdthsbmt']) && (trim($_POST['btnetyrwdthsbmt']) != "") && isset($_POST['txtname']) && (trim($_POST['txtname']) != "") && isset($_POST['lstvehtyp']) && (trim($_POST['lstvehtyp']) != "") && isset($_POST['txtprior']) && (trim($_POST['txtprior']) != ""))
{
	$id = glb_func_chkvl($_POST['hdntyrwdthid']);
	$name = glb_func_chkvl($_POST['txtname']);
	$vehtypid = glb_func_chkvl($_POST['lstvehtyp']);
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
	$sqrytyrwdth_mst = "SELECT tyrwdthm_name from tyr_wdth_mst where tyrwdthm_name = '$name' and tyrwdthm_vehtypm_id = '$vehtypid' and tyrwdthm_id != $id";
	$srstyrwdth_mst = mysqli_query($conn,$sqrytyrwdth_mst);
	$cnttyrwdthm = mysqli_num_rows($srstyrwdth_mst);
	if($cnttyrwdthm < 1)
	{
		$uqrytyrwdth_mst="UPDATE tyr_wdth_mst set tyrwdthm_name = '$name', tyrwdthm_desc = '$desc', tyrwdthm_vehtypm_id = '$vehtypid', tyrwdthm_seotitle = '$title', tyrwdthm_seodesc = '$seodesc', tyrwdthm_seokywrd = '$kywrd', tyrwdthm_seohonetitle = '$seoh1_tle', tyrwdthm_seohonedesc = '$seoh1_desc', tyrwdthm_seohtwotitle = '$seoh2_tle', tyrwdthm_seohtwodesc = '$seoh2_desc', tyrwdthm_sts = '$sts', tyrwdthm_prty = '$prior', tyrwdthm_mdfdon = '$curdt', tyrwdthm_mdfdby = '$ses_admin' where tyrwdthm_id = '$id'";
		// echo $uqrytyrwdth_mst; exit;
		$urstyrwdth_mst = mysqli_query($conn,$uqrytyrwdth_mst);
		if($urstyrwdth_mst == true)
		{ ?>
			<script>location.href="view_detail_tyr_wdth.php?vw=<?php echo $id;?>&sts=y&pg=<?php echo $pg;?>&countstart=<?php echo $countstart.$srchval;?>";</script>
			<?php
		}
		else
		{ ?>
			<script>location.href="view_detail_tyr_wdth.php?vw=<?php echo $id;?>&sts=n&pg=<?php echo $pg;?>&countstart=<?php echo $countstart.$srchval;?>";</script>
			<?php
		}
	}
	else
	{ ?>
		<script>location.href="view_detail_tyr_wdth.php?vw=<?php echo $id;?>&sts=d&pg=<?php echo $pg;?>&countstart=<?php echo $countstart;?>";
		</script>
		<?php
	}
}
?>