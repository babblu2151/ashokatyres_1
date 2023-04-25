<?php
include_once '../includes/inc_config.php'; //Making paging validation
include_once $inc_nocache; //Clearing the cache information
include_once $adm_session; //checking for session
include_once $inc_cnctn; //Making database Connection
include_once $inc_usr_fnctn; //checking for session	
include_once $inc_pgng_fnctns; //Making paging validation
include_once $inc_fldr_pth; //Making paging validation
if(isset($_POST['btnebrndsbmt']) && (trim($_POST['btnebrndsbmt']) != "") && isset($_POST['lstvehtyp']) && (trim($_POST['lstvehtyp']) != "") && isset($_POST['txtname']) && (trim($_POST['txtname']) != "") && isset($_POST['txtprior']) && (trim($_POST['txtprior']) != ""))
{
	$id = glb_func_chkvl($_POST['hdnvehbrndid']);
	$vehtypid = glb_func_chkvl($_POST['lstvehtyp']);
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
	$hdnbrndimg = glb_func_chkvl($_REQUEST['hdnbrndimg']);
	$srchval = addslashes(trim($_POST['hdnloc']));
	$curdt = date('Y-m-d h:i:s');
	$sqryveh_brnd_mst = "SELECT vehbrndm_name from veh_brnd_mst where vehbrndm_name = '$name' and vehbrndm_vehtypm_id = '$vehtypid' and vehbrndm_id != $id";
	$srsveh_brnd_mst = mysqli_query($conn,$sqryveh_brnd_mst);
	$cntbrndm = mysqli_num_rows($srsveh_brnd_mst);
	if($cntbrndm < 1)
	{
		$uqryveh_brnd_mst="UPDATE veh_brnd_mst set vehbrndm_name = '$name', vehbrndm_desc = '$desc', vehbrndm_vehtypm_id='$vehtypid', vehbrndm_seotitle = '$title', vehbrndm_seodesc = '$seodesc', vehbrndm_seokywrd = '$kywrd', vehbrndm_seohonetitle = '$seoh1_tle', vehbrndm_seohonedesc = '$seoh1_desc', vehbrndm_seohtwotitle = '$seoh2_tle', vehbrndm_seohtwodesc = '$seoh2_desc', vehbrndm_sts = '$sts', vehbrndm_prty = '$prior', vehbrndm_mdfdon = '$curdt', vehbrndm_mdfdby = '$ses_admin'";
		if(isset($_FILES['flebrndimg']['tmp_name']) && ($_FILES['flebrndimg']['tmp_name']!=""))
		{
			$brndmigval = funcUpldImg('flebrndimg','brndimg');
			if($brndmigval != "")
			{
				$brndimgary = explode(":",$brndmigval,2);
				$brnddest = $brndimgary[0];					
				$brndsource = $brndimgary[1];	
			}							
			$uqryveh_brnd_mst .= ", vehbrndm_brndimg = '$brnddest'";
 		}		 
		$uqryveh_brnd_mst .= " where vehbrndm_id = '$id'";
		$ursveh_brnd_mst = mysqli_query($conn,$uqryveh_brnd_mst);
		if($ursveh_brnd_mst == true)
		{
			if(($brndsource!='none') && ($brndsource!='') && ($brnddest != ""))
			{
				$smlimgpth = $gvehbrndimg_upldpth.$hdnbrndimg;
				if(($hdnbrndimg != '') && file_exists($smlimgpth))
				{
					unlink($smlimgpth);
				}
				move_uploaded_file($brndsource,$gvehbrndimg_upldpth.$brnddest);
			}
			?>
			<script>location.href="view_detail_veh_brnd.php?vw=<?php echo $id;?>&sts=y&pg=<?php echo $pg;?>&countstart=<?php echo $countstart.$srchval;?>";</script>
			<?php
		}
		else
		{ ?>
			<script>location.href="view_detail_veh_brnd.php?vw=<?php echo $id;?>&sts=n&pg=<?php echo $pg;?>&countstart=<?php echo $countstart.$srchval;?>";</script>
			<?php
		}
	}
	else
	{ ?>
		<script>location.href="view_detail_veh_brnd.php?vw=<?php echo $id;?>&sts=d&pg=<?php echo $pg;?>&countstart=<?php echo $countstart;?>";
		</script>
		<?php
	}
}
?>