<?php
include_once "../includes/inc_adm_session.php"; //checking for session
include_once "../includes/inc_connection.php"; //Making database Connection
include_once "../includes/inc_usr_functions.php"; //Use function for validation and more
if(isset($_POST['btnetyrtypsbmt']) && (trim($_POST['btnetyrtypsbmt']) != "") && isset($_POST['txtname']) && (trim($_POST['txtname']) != "") && isset($_POST['txtcde']) && (trim($_POST['txtcde']) != "") && isset($_POST['txtprior']) && (trim($_POST['txtprior']) != ""))
{
	$id = glb_func_chkvl($_POST['hdntyrtypid']);
	$name = glb_func_chkvl($_POST['txtname']);
	$code = glb_func_chkvl($_POST['txtcde']);
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
	$srchval = glb_func_chkvl($_REQUEST['hdnval']);
  $chk = glb_func_chkvl($_REQUEST['hdnchk']);
	$cur_dt = date('Y-m-d h:i:s');
	$loc = "&val=$srchval";
	if($chk !='')
	{
		$loc .="&chk=y";
	}
	$sqrytyr_type_mst = "SELECT tyrtypm_name from tyr_type_mst where tyrtypm_name = '$name' and tyrtypm_cde = '$code' and  tyrtypm_id != $id";
	$srstyr_type_mst = mysqli_query($conn,$sqrytyr_type_mst);
	$rows_cnt = mysqli_num_rows($srstyr_type_mst);
	if($rows_cnt > 0)
	{ ?>
		<script type="text/javascript">location.href="view_detail_tyr_type.php?vw=<?php echo $id;?>&sts=d&pg=<?php echo $pg;?>&countstart=<?php echo $countstart.$loc;?>";</script>
		<?php
	}
	else
	{
		$uqrytyr_type_mst = "UPDATE tyr_type_mst set tyrtypm_name='$name', tyrtypm_cde='$code', tyrtypm_sts='$sts', tyrtypm_desc='$desc', tyrtypm_seotitle='$title', tyrtypm_seodesc='$seodesc', tyrtypm_seokywrd='$kywrd', tyrtypm_seohonetitle='$seoh1_tle', tyrtypm_seohonedesc='$seoh1_desc', tyrtypm_seohtwotitle='$seoh2_tle', tyrtypm_seohtwodesc='$seoh2_desc', tyrtypm_prty ='$prior', tyrtypm_mdfdon ='$cur_dt', tyrtypm_mdfdby='$ses_admin'";
		$uqrytyr_type_mst .= " where tyrtypm_id = $id";
		// echo $uqrytyr_type_mst; exit;
		$urstyrtype_mst = mysqli_query($conn,$uqrytyr_type_mst);
		if($urstyrtype_mst == true)
		{ ?>
			<script type="text/javascript">location.href="view_detail_tyr_type.php?vw=<?php echo $id;?>&sts=y&pg=<?php echo $pg;?>&countstart=<?php echo $countstart.$loc;?>";</script>
			<?php
		}
		else
		{ ?>
			<script type="text/javascript">location.href="view_detail_tyr_type.php?vw=<?php echo $id;?>&sts=n&pg=<?php echo $pg;?>&countstart=<?php echo $countstart.$loc;?>";</script>
			<?php
		}
	}
}
?>