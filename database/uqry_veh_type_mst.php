<?php
include_once "../includes/inc_adm_session.php"; //checking for session
include_once "../includes/inc_connection.php"; //Making database Connection
include_once "../includes/inc_usr_functions.php"; //Use function for validation and more
if(isset($_POST['btnevehtypsbmt']) && (trim($_POST['btnevehtypsbmt']) != "") && isset($_POST['txtname']) && (trim($_POST['txtname']) != "") && isset($_POST['txtprior']) && (trim($_POST['txtprior']) != ""))
{
	$id = glb_func_chkvl($_POST['hdnvehtypid']);
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
	$sqryveh_type_mst = "SELECT vehtypm_name from veh_type_mst where vehtypm_name='$name' and  vehtypm_id != $id";
	$srsveh_type_mst = mysqli_query($conn,$sqryveh_type_mst);
	$rows_cnt = mysqli_num_rows($srsveh_type_mst);
	if($rows_cnt > 0)
	{ ?>
		<script type="text/javascript">location.href="view_detail_veh_type.php?vw=<?php echo $id;?>&sts=d&pg=<?php echo $pg;?>&countstart=<?php echo $countstart.$loc;?>";</script>
		<?php
	}
	else
	{
		$uqryveh_type_mst = "UPDATE veh_type_mst set vehtypm_name='$name', vehtypm_sts='$sts', vehtypm_desc='$desc', vehtypm_seotitle='$title', vehtypm_seodesc='$seodesc', vehtypm_seokywrd='$kywrd', vehtypm_seohonetitle='$seoh1_tle', vehtypm_seohonedesc='$seoh1_desc', vehtypm_seohtwotitle='$seoh2_tle', vehtypm_seohtwodesc='$seoh2_desc', vehtypm_prty ='$prior', vehtypm_mdfdon ='$cur_dt', vehtypm_mdfdby='$ses_admin'";
		$uqryveh_type_mst .= " where vehtypm_id = $id";
		$ursvehtype_mst = mysqli_query($conn,$uqryveh_type_mst);
		if($ursvehtype_mst == true)
		{ ?>
			<script type="text/javascript">location.href="view_detail_veh_type.php?vw=<?php echo $id;?>&sts=y&pg=<?php echo $pg;?>&countstart=<?php echo $countstart.$loc;?>";</script>
			<?php
		}
		else
		{ ?>
			<script type="text/javascript">location.href="view_detail_veh_type.php?vw=<?php echo $id;?>&sts=n&pg=<?php echo $pg;?>&countstart=<?php echo $countstart.$loc;?>";</script>
			<?php
		}
	}
}
?>