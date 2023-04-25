<?php
include_once '../includes/inc_nocache.php'; // Clearing the cache information
include_once '../includes/inc_adm_session.php'; //checking for session
include_once '../includes/inc_usr_functions.php'; //Use function for validation and more	
include_once "../includes/inc_folder_path.php";	
if(isset($_POST['btnetyrprflsbmt']) && (trim($_POST['btnetyrprflsbmt']) != "") && isset($_POST['lstvehtyp']) && (trim($_POST['lstvehtyp']) != "") && isset($_POST['lsttyrwdth']) && (trim($_POST['lsttyrwdth']) != "") && isset($_POST['txtname']) && (trim($_POST['txtname']) != "") && isset($_POST['txtprior']) && (trim($_POST['txtprior']) != ""))
{
	$id = glb_func_chkvl($_POST['hdntyrprflid']);
	$vehtypid = glb_func_chkvl($_POST['lstvehtyp']);
	$tyrwdthid = glb_func_chkvl($_POST['lsttyrwdth']);
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
	$sqrytyrprfl_mst = "SELECT tyrprflm_name from tyr_prfl_mst where tyrprflm_name = '$name' and tyrprflm_vehtypm_id = '$vehtypid' and tyrprflm_vehbrndm_id = '$tyrwdthid' and tyrprflm_id != $id";
	$srstyrprfl_mst = mysqli_query($conn,$sqrytyrprfl_mst);
	$cnttyrprfl = mysqli_num_rows($srstyrprfl_mst);
	if($cnttyrprfl < 1)
	{
		$uqrytyrprfl_mst = "UPDATE tyr_prfl_mst set tyrprflm_name = '$name', tyrprflm_desc = '$desc', tyrprflm_vehtypm_id='$vehtypid', tyrprflm_tyrwdthm_id='$tyrwdthid', tyrprflm_seotitle = '$title', tyrprflm_seodesc = '$seodesc', tyrprflm_seokywrd = '$kywrd', tyrprflm_seohonetitle = '$seoh1_tle', tyrprflm_seohonedesc = '$seoh1_desc', tyrprflm_seohtwotitle = '$seoh2_tle', tyrprflm_seohtwodesc = '$seoh2_desc', tyrprflm_sts = '$sts', tyrprflm_prty = '$prior', tyrprflm_mdfdon = '$curdt', tyrprflm_mdfdby = '$ses_admin' where tyrprflm_id = '$id'";
		// echo $uqrytyrprfl_mst; exit;
		$urstyrprfl_mst = mysqli_query($conn,$uqrytyrprfl_mst);
		if($urstyrprfl_mst == true)
		{ ?>
			<script>location.href="view_detail_tyr_prfl.php?vw=<?php echo $id;?>&sts=y&pg=<?php echo $pg;?>&countstart=<?php echo $countstart.$srchval;?>";</script>
			<?php
		}
		else
		{ ?>
			<script>location.href="view_detail_tyr_prfl.php?vw=<?php echo $id;?>&sts=n&pg=<?php echo $pg;?>&countstart=<?php echo $countstart.$srchval;?>";</script>
			<?php
		}
	}
	else
	{ ?>
		<script>location.href="view_detail_tyr_prfl.php?vw=<?php echo $id;?>&sts=d&pg=<?php echo $pg;?>&countstart=<?php echo $countstart;?>";
		</script>
		<?php
	}
}
?>