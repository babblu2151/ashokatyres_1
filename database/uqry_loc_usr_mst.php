<?php
include_once '../includes/inc_nocache.php'; // Clearing the cache information
include_once '../includes/inc_adm_session.php'; //checking for session
include_once '../includes/inc_usr_functions.php'; //Use function for validation and more	
include_once "../includes/inc_folder_path.php";	
if(isset($_POST['btnelocusrsbmt']) && (trim($_POST['btnelocusrsbmt']) != "") && isset($_POST['lststrloc']) && (trim($_POST['lststrloc']) != "") && isset($_POST['txtname']) && (trim($_POST['txtname']) != "") && isset($_POST['txtcnfpwd']) && (trim($_POST['txtcnfpwd']) != ""))
{
	$id = glb_func_chkvl($_POST['hdnlocusrid']);
	$name = glb_func_chkvl($_POST['txtname']);
	$strloc = glb_func_chkvl($_POST['lststrloc']);
	$pwd = md5(glb_func_chkvl($_POST['txtcnfpwd']));
	$sts = glb_func_chkvl($_POST['lststs']);
	$pg = glb_func_chkvl($_REQUEST['hdnpage']);
	$countstart = glb_func_chkvl($_REQUEST['hdncnt']);
	$srchval = addslashes(trim($_POST['hdnloc']));
	$curdt = date('Y-m-d h:i:s');
	$sqryloc_usr_mst = "SELECT lgnm_uid from lgn_mst where lgnm_uid = '$name' and lgnm_store_id = '$strloc' and lgnm_id != $id";
	$srsloc_usr_mst = mysqli_query($conn,$sqryloc_usr_mst);
	$cntlocusr = mysqli_num_rows($srsloc_usr_mst);
	if($cntlocusr < 1)
	{
		$uqryloc_usr_mst="UPDATE lgn_mst set lgnm_uid = '$name', lgnm_store_id = '$strloc', lgnm_pwd='$pwd', lgnm_sts = '$sts', lgnm_mdfdon = '$curdt', lgnm_mdfdby = '$ses_admin'";
		$uqryloc_usr_mst .= " where lgnm_id = '$id'";
		$ursveh_brnd_mst = mysqli_query($conn,$uqryloc_usr_mst);
		if($ursveh_brnd_mst == true)
		{ ?>
			<script>location.href="view_all_users.php?vw=<?php echo $id;?>&sts=y&pg=<?php echo $pg;?>&countstart=<?php echo $countstart.$srchval;?>";</script>
			<?php
		}
		else
		{ ?>
			<script>location.href="view_all_users.php?vw=<?php echo $id;?>&sts=n&pg=<?php echo $pg;?>&countstart=<?php echo $countstart.$srchval;?>";</script>
			<?php
		}
	}
	else
	{ ?>
		<script>location.href="view_all_users.php?vw=<?php echo $id;?>&sts=d&pg=<?php echo $pg;?>&countstart=<?php echo $countstart;?>";
		</script>
		<?php
	}
}
?>