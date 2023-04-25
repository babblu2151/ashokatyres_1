<?php
include_once '../includes/inc_nocache.php'; // Clearing the cache information
include_once '../includes/inc_adm_session.php'; //checking for session
include_once '../includes/inc_usr_functions.php'; //Use function for validation and more	
include_once "../includes/inc_folder_path.php";	
if(isset($_POST['btnetyrbrndsbmt']) && (trim($_POST['btnetyrbrndsbmt']) != "") && isset($_POST['txtname']) && (trim($_POST['txtname']) != "") && isset($_POST['txtprior']) && (trim($_POST['txtprior']) != ""))
{
	$id = glb_func_chkvl($_POST['hdntyrbrndid']);
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
	$sqrytyrbrnd_mst = "SELECT tyrbrndm_name from tyr_brnd_mst where tyrbrndm_name = '$name' and tyrbrndm_vehtypm_id = '$vehtypid' and tyrbrndm_id != $id";
	$srstyrbrnd_mst = mysqli_query($conn,$sqrytyrbrnd_mst);
	$cnttyrbrndm = mysqli_num_rows($srstyrbrnd_mst);
	if($cnttyrbrndm < 1)
	{
		$uqrytyrbrnd_mst="UPDATE tyr_brnd_mst set tyrbrndm_name = '$name', tyrbrndm_desc = '$desc', tyrbrndm_seotitle = '$title', tyrbrndm_seodesc = '$seodesc', tyrbrndm_seokywrd = '$kywrd', tyrbrndm_seohonetitle = '$seoh1_tle', tyrbrndm_seohonedesc = '$seoh1_desc', tyrbrndm_seohtwotitle = '$seoh2_tle', tyrbrndm_seohtwodesc = '$seoh2_desc', tyrbrndm_sts = '$sts', tyrbrndm_prty = '$prior', tyrbrndm_mdfdon = '$curdt', tyrbrndm_mdfdby = '$ses_admin'";
		if(isset($_FILES['flebrndimg']['tmp_name']) && ($_FILES['flebrndimg']['tmp_name']!=""))
		{
			$brndmigval = funcUpldImg('flebrndimg','tyrbrndimg');
			if($brndmigval != "")
			{
				$brndimgary = explode(":",$brndmigval,2);
				$brnddest = $brndimgary[0];					
				$brndsource = $brndimgary[1];	
			}							
			$uqrytyrbrnd_mst .= ", tyrbrndm_brndimg = '$brnddest'";
 		}		 
		$uqrytyrbrnd_mst .= " where tyrbrndm_id = '$id'";
		$urstyrbrnd_mst = mysqli_query($conn,$uqrytyrbrnd_mst);
		if($urstyrbrnd_mst == true)
		{
			if(($brndsource!='none') && ($brndsource!='') && ($brnddest != ""))
			{
				$smlimgpth = $gtyrbrndimg_upldpth.$hdnbrndimg;
				if(($hdnbrndimg != '') && file_exists($smlimgpth))
				{
					unlink($smlimgpth);
				}
				move_uploaded_file($brndsource,$gtyrbrndimg_upldpth.$brnddest);
			}
			?>
			<script>location.href="view_detail_tyr_brnd.php?vw=<?php echo $id;?>&sts=y&pg=<?php echo $pg;?>&countstart=<?php echo $countstart.$srchval;?>";</script>
			<?php
		}
		else
		{ ?>
			<script>location.href="view_detail_tyr_brnd.php?vw=<?php echo $id;?>&sts=n&pg=<?php echo $pg;?>&countstart=<?php echo $countstart.$srchval;?>";</script>
			<?php
		}
	}
	else
	{ ?>
		<script>location.href="view_detail_tyr_brnd.php?vw=<?php echo $id;?>&sts=d&pg=<?php echo $pg;?>&countstart=<?php echo $countstart;?>";
		</script>
		<?php
	}
}
?>