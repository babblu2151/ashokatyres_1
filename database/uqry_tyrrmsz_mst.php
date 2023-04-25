<?php
include_once '../includes/inc_nocache.php'; // Clearing the cache information
include_once '../includes/inc_adm_session.php'; //checking for session
include_once '../includes/inc_usr_functions.php'; //Use function for validation and more	
include_once "../includes/inc_folder_path.php";	
if(isset($_POST['btnetyrrmszsbmt']) && (trim($_POST['btnetyrrmszsbmt']) != "") && isset($_POST['lstvehtyp']) && (trim($_POST['lstvehtyp']) != "") && isset($_POST['lsttyrwdth']) && (trim($_POST['lsttyrwdth']) != "") && isset($_POST['lsttyrprfl']) && (trim($_POST['lsttyrprfl']) != "") && isset($_POST['txtname']) && (trim($_POST['txtname']) != "") && isset($_POST['txtprior']) && (trim($_POST['txtprior']) != ""))
{
	$id = glb_func_chkvl($_POST['hdntyrrmszid']);
	$vehtypid = glb_func_chkvl($_POST['lstvehtyp']);
	$tyrwdthid = glb_func_chkvl($_POST['lsttyrwdth']);
	$tyrprflid = glb_func_chkvl($_POST['lsttyrprfl']);
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
	$sqrytyrrmsz_mst = "SELECT tyrrmszm_name from tyr_rimsize_mst where tyrrmszm_name = '$name' and tyrrmszm_tyrprflm_id = '$vehtypid' and tyrrmszm_tyrwdthm_id = '$tyrwdthid' and tyrrmszm_vehmdlm_id = '$tyrprflid' and tyrrmszm_id != $id";
	$srstyrrmsz_mst = mysqli_query($conn,$sqrytyrrmsz_mst);
	$cnttyrrmszm = mysqli_num_rows($srstyrrmsz_mst);
	if($cnttyrrmszm < 1)
	{
		$uqrytyrrmsz_mst="UPDATE tyr_rimsize_mst set tyrrmszm_name = '$name', tyrrmszm_desc = '$desc', tyrrmszm_tyrprflm_id='$vehtypid', tyrrmszm_tyrwdthm_id='$tyrwdthid', tyrrmszm_tyrprflm_id='$tyrprflid', tyrrmszm_seotitle = '$title', tyrrmszm_seodesc = '$seodesc', tyrrmszm_seokywrd = '$kywrd', tyrrmszm_seohonetitle = '$seoh1_tle', tyrrmszm_seohonedesc = '$seoh1_desc', tyrrmszm_seohtwotitle = '$seoh2_tle', tyrrmszm_seohtwodesc = '$seoh2_desc', tyrrmszm_sts = '$sts', tyrrmszm_prty = '$prior', tyrrmszm_mdfdon = '$curdt', tyrrmszm_mdfdby = '$ses_admin' where tyrrmszm_id = '$id'";
		// echo $uqrytyrrmsz_mst; exit;
		$urstyrrmsz_mst = mysqli_query($conn,$uqrytyrrmsz_mst);
		if($urstyrrmsz_mst == true)
		{ ?>
			<script>location.href="view_detail_tyr_rmsize.php?vw=<?php echo $id;?>&sts=y&pg=<?php echo $pg;?>&countstart=<?php echo $countstart.$srchval;?>";</script>
			<?php
		}
		else
		{ ?>
			<script>location.href="view_detail_tyr_rmsize.php?vw=<?php echo $id;?>&sts=n&pg=<?php echo $pg;?>&countstart=<?php echo $countstart.$srchval;?>";</script>
			<?php
		}
	}
	else
	{ ?>
		<script>location.href="view_detail_tyr_rmsize.php?vw=<?php echo $id;?>&sts=d&pg=<?php echo $pg;?>&countstart=<?php echo $countstart;?>";
		</script>
		<?php
	}
}
?>