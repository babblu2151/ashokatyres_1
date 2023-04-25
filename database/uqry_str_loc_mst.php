<?php
include_once "../includes/inc_adm_session.php"; //checking for session
include_once "../includes/inc_connection.php"; //Making database Connection
include_once "../includes/inc_usr_functions.php"; //Use function for validation and more
if(isset($_POST['btnestrlocsbmt']) && (trim($_POST['btnestrlocsbmt']) != "") &&  isset($_POST['txtname']) && (trim($_POST['txtname']) != "") && isset($_POST['txtprior']) && (trim($_POST['txtprior']) != ""))
{
	$id = glb_func_chkvl($_POST['hdnstrlocid']);
	$name = glb_func_chkvl($_POST['txtname']);
	$prior = glb_func_chkvl($_POST['txtprior']);
	$hmprior = glb_func_chkvl($_POST['txthmprior']);
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
	$hdnsmlimg = glb_func_chkvl($_POST['hdnsmlimg']);
	$hdnbgimg	= glb_func_chkvl($_POST['hdnbgimg']);	
	$sts = glb_func_chkvl($_POST['lststs']);
	$srchval = glb_func_chkvl($_REQUEST['hdnval']);
  $chk = glb_func_chkvl($_REQUEST['hdnchk']);
	$cur_dt = date('Y-m-d h:i:s');
	$loc= "&val=$srchval";
	if($chk !='')
	{
		$loc .="&chk=y";
	}
	$sqrystr_loc_mst = "SELECT strlocm_name from store_loc_mst where strlocm_name='$name' and  strlocm_id != $id";
	$srsstore_loc_mst = mysqli_query($conn,$sqrystr_loc_mst);
	$rows_cnt = mysqli_num_rows($srsstore_loc_mst);
	if($rows_cnt > 0)
	{ ?>
		<script type="text/javascript">location.href="view_detail_str_loc.php?vw=<?php echo $id;?>&sts=d&pg=<?php echo $pg;?>&countstart=<?php echo $countstart.$loc;?>";</script>
		<?php
	}
	else
	{
		$uqrystr_loc_mst = "UPDATE store_loc_mst set strlocm_name='$name', strlocm_sts='$sts', strlocm_desc='$desc', strlocm_seotitle='$title', strlocm_seodesc='$seodesc', strlocm_seokywrd='$kywrd', strlocm_seohonetitle='$seoh1_tle', strlocm_seohonedesc='$seoh1_desc', strlocm_seohtwotitle='$seoh2_tle', strlocm_seohtwodesc='$seoh2_desc', strlocm_prty ='$prior', strlocm_mdfdon ='$cur_dt', strlocm_mdfdby='$ses_admin'";
		$uqrystr_loc_mst .= " where strlocm_id = $id";
		$ursstrloce_mst = mysqli_query($conn,$uqrystr_loc_mst);
		if($ursstrloce_mst == true)
		{ ?>
			<script type="text/javascript">location.href="view_detail_str_loc.php?vw=<?php echo $id;?>&sts=y&pg=<?php echo $pg;?>&countstart=<?php echo $countstart.$loc;?>";</script>
			<?php
		}
		else
		{ ?>
			<script type="text/javascript">location.href="view_detail_str_loc.php?vw=<?php echo $id;?>&sts=n&pg=<?php echo $pg;?>&countstart=<?php echo $countstart.$loc;?>";</script>
			<?php
		}
	}
}
?>