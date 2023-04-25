<?php
$pagetitle = "View All Vehicle Type";
include_once '../includes/inc_config.php'; //Making paging validation
include_once $inc_nocache; //Clearing the cache information
include_once $adm_session; //checking for session
include_once $inc_cnctn; //Making database Connection
include_once $inc_usr_fnctn; //checking for session	
include_once $inc_pgng_fnctns; //Making paging validation 
include_once $inc_fldr_pth; //Making paging validation
/***************************************************************
Programm : view_veh_type.php	
Purpose : For Viewing all vehicle types
Created By : Bharath
Created On :	25/12/2021
Modified By : 
Modified On : 
Purpose : 
Company : Adroit
************************************************************/
global $msg,$loc,$rowsprpg,$dispmsg,$disppg;
$clspn_val = "6";
$rd_adpgnm = "add_vehicle_typ.php";
$rd_edtpgnm = "edit_veh_type.php";
$rd_crntpgnm = "view_veh_type.php";
$rd_vwpgnm = "view_detail_veh_type.php";
$loc = "";
/*****header link********/
$pagemncat = "Setup";
$pagecat = "Vehicle";
$pagenm = "Vehicle Type"; 
/*****header link********/
if(isset($_POST['hdnchksts']) && (trim($_POST['hdnchksts'])!="") || isset($_POST['hdnallval']) && (trim($_POST['hdnallval'])!=""))
{
	$dchkval = substr($_POST['hdnchksts'],1);
	$id = glb_func_chkvl($dchkval);
	$chkallval	= glb_func_chkvl($_POST['hdnallval']);
	$updtsts = funcUpdtAllRecSts($conn,'veh_type_mst','vehtypm_id',$id,'vehtypm_sts',$chkallval);
	if($updtsts == 'y')
	{
		$msg = "<font color=red>Record updated successfully</font>";
	}
	elseif($updtsts == 'n')
	{
		$msg = "<font color=red>Record not updated</font>";
	}
}
if(($_POST['hdnchkval']!="") && isset($_REQUEST['hdnchkval']))
{
	$dchkval = substr($_POST['hdnchkval'],1);
	$did = glb_func_chkvl($dchkval);
	$del = explode(',',$did);
	$count = sizeof($del);
	$delsts = funcDelAllRec($conn,'veh_type_mst','vehtypm_id',$did);
	if($delsts == 'y')
	{
		$msg = "<font color=red>Record deleted successfully</font>";
	}
	elseif($delsts == 'n')
	{
		$msg = "<font color=red>Record can't be deleted(child records exist)</font>";
	}
}
if(isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == "y"))	
{
	$msg = "<font color=red>Record updated successfully</font>";
}
elseif(isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == "n"))
{
	$msg = "<font color=red>Record not updated</font>";
}
elseif(isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == "d"))
{
	$msg = "<font color=red>Duplicate Recored Name Exists & Record Not updated</font>";
}
$rowsprpg = 20;//maximum rows per page
include_once "../includes/inc_paging1.php"; //Includes pagination
include_once 'script.php'; ?>
<script language="javascript">
	function addnew()
	{
		document.frmvehtypmst.action="<?php echo $rd_adpgnm;?>";
		document.frmvehtypmst.submit();
	}
	function chng()
	{
		var div1 = document.getElementById("div1");
		var div2 = document.getElementById("div2");
		if(document.frmvehtypmst.lstsrchby.value=='n')
		{
			div1.style.display="block";
			div2.style.display="none";
		}
		else if(document.frmvehtypmst.lstsrchby.value=='t')
		{
			div1.style.display="none";
			div2.style.display="block";
		}
	}
	function onload()
	{
		<?php
		if(isset($_POST['lstsrchby']) && $_POST['lstsrchby']=='n')
		{ ?>
			div1.style.display="block";
			div2.style.display="none";
			<?php
		}
		elseif(isset($_POST['lstsrchby']) && $_POST['lstsrchby']=='t')
		{ ?>
			div1.style.display="none";
			div2.style.display="block";
			<?php
		}
		?>
	}
	function srch()
	{
		if(document.frmvehtypmst.txtsrchval.value=="")
		{
			alert("Please Enter Name");
			document.frmvehtypmst.txtsrchval.focus();
			return false;
		}
		var val=document.frmvehtypmst.txtsrchval.value;
		if(document.frmvehtypmst.chkexact.checked==true)
		{
			document.frmvehtypmst.action="<?php echo $rd_crntpgnm ;?>?val="+val+"&chk=y";
			document.frmvehtypmst.submit();
		}
		else
		{
			document.frmvehtypmst.action="<?php echo $rd_crntpgnm ;?>?val="+val;
			document.frmvehtypmst.submit();
		}
	}
</script>
<script language="javascript" type="text/javascript" src="../includes/chkbxvalidate.js"></script>
<?php 
	include_once $inc_adm_hdr;
	//include_once $inc_adm_lftlnk;
?>
<section class="content">
	<div class="content-header">
 <div class="container-fluid">
 	<div class="row mb-2">
  		<div class="col-sm-6">
  			<h1 class="m-0 text-dark">View All Vehicle Types</h1>
  		</div><!-- /.col -->
  		<div class="col-sm-6">
  			<ol class="breadcrumb float-sm-right">
  				<li class="breadcrumb-item"><a href="#">Home</a></li>
  				<li class="breadcrumb-item active">View All Vehicle Types</li>
  			</ol>
  		</div><!-- /.col -->
  	</div><!-- /.row -->
  </div><!-- /.container-fluid -->
  </div>
  <!-- Default box -->
  <div class="card">
  <!-- <div class="card-header">
  	<?php /*?><h2 class="card-title h1">View All Category</h2><?php */?>
  	<div class="card-tools">
  		<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
  			<i class="fas fa-minus"></i>
  		</button>
 			<button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
 				<i class="fas fa-times"></i>
 			</button>
 		</div>
 	</div> -->
 	<?php if(isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == "y"))
 	{ ?>
 		<div class="alert alert-danger alert-dismissible fade show" role="alert" id="delids"> 
 			<strong>Deleted Successfully!</strong>
 			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
 				<span aria-hidden="true">&times;</span>
 			</button>
 		</div>	
 		<?php
 	}
 	?>
 	<div class="alert alert-warning alert-dismissible fade show" role="alert" id="updid" style="display:none">
 		<strong>Updated Successfully !</strong>
 		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
 			<span aria-hidden="true">&times;</span>
 		</button>
 	</div>
 	<div class="alert alert-info alert-dismissible fade show" role="alert" id="sucid" style="display:none">
 		<strong>Added Successfully !</strong>
 		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
 			<span aria-hidden="true">&times;</span>
 		</button>
 	</div>
 	<div class="card-body p-0">
 		<form method="post" action="<?php $_SERVER['SCRIPT_NAME'];?>" name="frmvehtypmst" id="frmvehtypmst">
				<input type="hidden" name="hdnchkval" id="hdnchkval">
				<input type="hidden" name="hdnchksts" id="hdnchksts">
				<input type="hidden" name="hdnallval" id="hdnallval">
				<div class="col-md-12">
					<div class="row justify-content-left align-items-center">
						<div class="col-sm-6">
							<div class="form-group">
							 <label for="txtsrchval"></label>
								<div id="div1" style="display:block">
									<input type="text" name="txtsrchval" class="form-control" value="<?php if(isset($_POST['txtsrchval']) && ($_POST['txtsrchval']!="")){echo $_POST['txtsrchval'];}elseif(isset($_REQUEST['val']) && ($_REQUEST['val']!="")){echo $_REQUEST['val'];}?>" placeholder="Search By Name">
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">Exact
								<input type="checkbox" name="chkexact" value="1"<?php if(isset($_POST['chkexact']) && ($_POST['chkexact']==1)){echo 'checked';}elseif(isset($_REQUEST['chk']) && ($_REQUEST['chk']=='y')){echo 'checked';}?>>
								&nbsp;&nbsp;&nbsp;
								<input name="button" type="button" class="btn btn-primary" onClick="srch()" value="Search">
								<a href="<?php echo $rd_crntpgnm; ?>" class="btn btn-primary">Refresh</a>
								<button type="submit" class="btn btn-primary" onClick="addnew();">+ Add</button>
							</div>
						</div>
					</div>
				</div>
				<div class="card-body p-0">
					<div class="table-responsive">
						<table width="100%" border="0" cellpadding="3" cellspacing="1" class="table table-striped projects">
							<tr>
								<td >&nbsp;</td>
								<td >&nbsp;</td>
								<td align="center" >&nbsp;</td>
								<td align="center">&nbsp;</td>
								<td align="center">
									<input name="btnsts" id="btnsts" type="button" value="Status" class="btn btn-xs btn-primary" onClick="updatests('hdnchksts','frmvehtypmst','chksts')">
								</td>
								<td align="center">
									<input name="btndel" id="btndel" type="button" value="Delete" class="btn btn-xs btn-primary" onClick="deleteall('hdnchkval','frmvehtypmst','chkdlt');" >
								</td>
							</tr>
							<tr>
						  <td width="7%" ><strong>SL.No.</strong></td>
						  <td width="21%" ><strong>Vehicle Type</strong></td>
								<!--<td width="16%" ><strong>Home Image</strong></td>
 						<td width="16%" ><strong>Banner Image</strong></td>-->
								<td width="9%" align="center" ><strong>Rank</strong></td>
								<!--<td width="11%" align="center" ><strong>Home Rank </strong></td> -->  
						  <td width="6%" align="center"><strong>Edit</strong></td>
						  <td width="7%" align="center"><strong>
						  <input type="checkbox" name="Check_ctr" id="Check_ctr" value="yes"onClick="Check(document.frmvehtypmst.chksts,'Check_ctr','hdnallval')"></strong>
						  </td>
					  <td width="7%" align="center"><strong>
					  	<input type="checkbox" name="Check_dctr" id="Check_dctr" value="yes" onClick="Check(document.frmvehtypmst.chkdlt,'Check_dctr')"></strong>
					  </td>
					  </tr>
					  <?php
					  $sqryveh_type_mst1 ="SELECT vehtypm_id, vehtypm_name, vehtypm_sts, vehtypm_prty from veh_type_mst";
					  if(isset($_REQUEST['val']) && $_REQUEST['val']!="")
					  {
					  $val = glb_func_chkvl($_REQUEST['val']);
					  if(isset($_REQUEST['chk']) && $_REQUEST['chk']=='y')
					  {
					  	$loc = "&val=".$val."&chk=y";
					  	$sqryveh_type_mst1.=" where vehtypm_name='$val'";
					  }
					  else
					  {
					  	$loc = "&val=".$val;
					  	$sqryveh_type_mst1.=" where vehtypm_name like '%$val%'";
					  }
					  }
					  $sqryveh_type_mst=$sqryveh_type_mst1." order by vehtypm_name asc limit $offset,$rowsprpg";
					  $srsveh_type_mst = mysqli_query($conn,$sqryveh_type_mst);
						$cnt_recs  = mysqli_num_rows($srsveh_type_mst);
						$cnt = $offset;
						if($cnt_recs > 0)
						{
							while($srowveh_type_mst=mysqli_fetch_assoc($srsveh_type_mst))
							{
								$cnt+=1;
								$pgval_srch	= $pgnum.$loc;
								$db_vehid	= $srowveh_type_mst['vehtypm_id'];
								$db_vehname	= $srowveh_type_mst['vehtypm_name'];
								$db_prty = $srowveh_type_mst['vehtypm_prty'];
								$db_sts	= $srowveh_type_mst['vehtypm_sts'];
								$db_hmprty = $srowveh_type_mst['vehtypm_hmprty'];
								?>
								<tr <?php if($cnt%2==0){echo "";}else{echo "";}?>>
									<td><?php echo $cnt;?></td>
									<td>
										<a href="<?php echo $rd_vwpgnm; ?>?vw=<?php echo $db_vehid;?>&pg=<?php echo $pgnum;?>&countstart=<?php echo $cntstart.$loc;?>" class="links"><?php echo $db_vehname;?></a>
									</td>
									<!-- <td align="center">
										<?php
										$imgnm = $srowveh_type_mst['vehtypm_smlimg']; $imgpath = $gadmcatsml_upldpth.$imgnm;
										if(($imgnm !="") && file_exists($imgpath))
										{
											echo "<img src='$imgpath' width='50pixel' height='50pixel'>";
										}
										else
										{
											echo "Image not available";
										}
										?>
									</td>
									<td align="center">
										<?php
										$imgnm = $srowveh_type_mst['vehtypm_bnrimg'];
										$imgpath = $gadmcatbnr_upldpth.$imgnm;
										if(($imgnm !="") && file_exists($imgpath))
										{
											echo "<img src='$imgpath' width='50pixel' height='50pixel'>";					 
										}
										else
										{
											echo "Image not available";
										}
										?>
									</td>-->
									<td align="center"><?php echo $db_prty;?></td>
									<td align="center">
										<a href="<?php echo $rd_edtpgnm;?>?edit=<?php echo $db_vehid;?>&pg=<?php echo $pgnum;?>&countstart=<?php echo $cntstart.$loc;?>" class="orongelinks">Edit</a>
									</td>
									<td align="center">
										<input type="checkbox" name="chksts" id="chksts" value="<?php echo $srowveh_type_mst['vehtypm_id'];?>" <?php if($srowveh_type_mst['vehtypm_sts'] =='a') { echo "checked";}?> onClick="addchkval(<?php echo $srowveh_type_mst['vehtypm_id'];?>,'hdnchksts','frmvehtypmst','chksts');">
									</td>
									<td align="center">
										<input type="checkbox" name="chkdlt" id="chkdlt" value="<?php echo $srowveh_type_mst['vehtypm_id'];?>">
									</td>
								</tr>
								<?php
							}
						}
						else
						{
							$msg="<font color=red>No Records In Database</font>";
						}
						?>
						<tr>
							<td colspan="<?php echo $clspn_val-2;?>">&nbsp;</td>
							<td width="7%" align="center" valign="bottom">
								<input name="btnsts" id="btnsts" type="button" value="Status" onClick="updatests('hdnchksts','frmvehtypmst','chksts')" class="btn btn-xs btn-primary">
							</td>
							<td width="7%" align="center" valign="bottom">
								<input name="btndel" id="btndel" type="button" value="Delete" onClick="deleteall('hdnchkval','frmvehtypmst','chkdlt');" class="btn btn-xs btn-primary">
							</td>
						</tr>
						<?php
						$disppg = funcDispPag($conn,'links',$loc,$sqryveh_type_mst1,$rowsprpg,$cntstart,$pgnum);
						$colspanval = $clspn_val;
						if($disppg != "")
						{
							$disppg = "<br><tr><td colspan='$colspanval' align='center' >$disppg</td></tr>";
							echo $disppg;
						}				
						if($msg != "")
						{
							$dispmsg = "<tr><td colspan='$colspanval' align='center' >$msg</td></tr>";
							echo $dispmsg;
						}
						?>
					</table>
				</div>
			</div>
		</form>
	</div>
	<!-- /.card-body -->
</div>
<!-- /.card -->
</section>
<?php include_once "../includes/inc_adm_footer.php"; ?>
