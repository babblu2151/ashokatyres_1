<?php
include_once '../includes/inc_config.php'; //Making paging validation
include_once $inc_nocache; //Clearing the cache information
include_once $adm_session; //checking for session
include_once $inc_cnctn; //Making database Connection
include_once $inc_usr_fnctn; //checking for session	
include_once $inc_pgng_fnctns; //Making paging validation
include_once $inc_fldr_pth; //Making paging validation
if(isset($_POST['btnebnrsbmt']) && (trim($_POST['btnebnrsbmt']) != "") && isset($_POST['txtname']) && (trim($_POST['txtname']) != "") && isset($_POST['txtprior']) && (trim($_POST['txtprior']) != ""))
{
	$id = glb_func_chkvl($_POST['hdnbnrid']);
	$name = glb_func_chkvl($_POST['txtname']);
	$prior = glb_func_chkvl($_POST['txtprior']);
	$desc = addslashes(trim($_POST['txtdesc']));
	$link = glb_func_chkvl($_POST['txtlnk']);
	$pg = glb_func_chkvl($_REQUEST['hdnpage']);
	$countstart = glb_func_chkvl($_REQUEST['hdncnt']);
	$sts = glb_func_chkvl($_POST['lststs']);
	$hdnbnrimg = glb_func_chkvl($_REQUEST['hdnbnrimg']);
	$srchval = addslashes(trim($_POST['hdnloc']));
	$curdt = date('Y-m-d h:i:s');
	$sqrybnr_mst = "SELECT prodfetrm_name from prodfetr_mst where prodfetrm_name = '$name' and prodfetrm_id != $id";
	$srsbnr_mst = mysqli_query($conn,$sqrybnr_mst);
	$cntprodfetrm = mysqli_num_rows($srsbnr_mst);
	if($cntprodfetrm < 1)
	{
		$uqrybnr_mst="UPDATE prodfetr_mst set prodfetrm_name = '$name', prodfetrm_desc = '$desc', prodfetrm_lnk = '$link', prodfetrm_sts = '$sts', prodfetrm_prty = '$prior', prodfetrm_mdfdon = '$curdt', prodfetrm_mdfdby = '$ses_admin'";
		if(isset($_FILES['flebnrimg']['tmp_name']) && ($_FILES['flebnrimg']['tmp_name']!=""))
		{
			$brndmigval = funcUpldImg('flebnrimg','bnrimg');
			if($brndmigval != "")
			{
				$bnrimgary = explode(":",$brndmigval,2);
				$bnrdest = $bnrimgary[0];					
				$bnrsource = $bnrimgary[1];	
			}							
			$uqrybnr_mst .= ", prodfetrm_imgnm = '$bnrdest'";
 		}		 
		$uqrybnr_mst .= " where prodfetrm_id = '$id'";
		$ursbnr_mst = mysqli_query($conn,$uqrybnr_mst);
		if($ursbnr_mst == true)
		{
			if(($bnrsource!='none') && ($bnrsource!='') && ($bnrdest != ""))
			{
				$smlimgpth = $gprodfetr_fldnm.$hdnbnrimg;
				if(($hdnbnrimg != '') && file_exists($smlimgpth))
				{
					unlink($smlimgpth);
				}
				move_uploaded_file($bnrsource,$gprodfetr_fldnm.$bnrdest);
			}
			?>
			<script>location.href="view_detail_prod_features.php?vw=<?php echo $id;?>&sts=y&pg=<?php echo $pg;?>&countstart=<?php echo $countstart.$srchval;?>";</script>
			<?php
		}
		else
		{ ?>
			<script>location.href="view_detail_prod_features.php?vw=<?php echo $id;?>&sts=n&pg=<?php echo $pg;?>&countstart=<?php echo $countstart.$srchval;?>";</script>
			<?php
		}
	}
	else
	{ ?>
		<script>location.href="view_detail_prod_features.php?vw=<?php echo $id;?>&sts=d&pg=<?php echo $pg;?>&countstart=<?php echo $countstart;?>";
		</script>
		<?php
	}
}
?>