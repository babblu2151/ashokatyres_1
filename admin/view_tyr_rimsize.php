<?php
include_once '../includes/inc_config.php'; //Making paging validation 
include_once $inc_nocache; //Clearing the cache information
include_once $adm_session; //checking for session
include_once $inc_cnctn; //Making database Connection
include_once $inc_usr_fnctn; //checking for session 
include_once $inc_pgng_fnctns; //Making paging validation 
include_once $inc_fldr_pth; //Making paging validation
/***************************************************************
Programm : view_tyr_rimsize.php
Purpose : For Viewing Tyre Rim Size
Created By : Bharath
Created On : 30-12-2021
Modified By : 
Modified On :
Company : Adroit
************************************************************/
global $msg,$loc,$rowsprpg,$dispmsg,$disppg;
$clspn_val = "7";
$rd_adpgnm = "add_tyr_rmsize.php";
$rd_edtpgnm = "edit_tyr_rmsize.php";
$rd_crntpgnm = "view_tyr_rimsize.php";
$rd_vwpgnm = "view_detail_tyr_rmsize.php";
$loc = "";
/*****header link********/
$pagemncat = "Setup";
$pagecat = "Tyre";
$pagenm = "Tyre Rim Size"; 
/*****header link********/
if(isset($_POST['hdnchksts']) && (trim($_POST['hdnchksts'])!="") || isset($_POST['hdnallval']) && (trim($_POST['hdnallval'])!=""))
{
	$dchkval = substr($_POST['hdnchksts'],1);
	$id = glb_func_chkvl($dchkval);  
	$chkallval = glb_func_chkvl($_POST['hdnallval']);
	$updtsts = funcUpdtAllRecSts($conn,'tyr_rimsize_mst','tyrrmszm_id',$id,'tyrrmszm_sts',$chkallval);  
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
	$delsts = funcDelAllRec($conn,'tyr_rimsize_mst','tyrrmszm_id',$did);
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
$rowsprpg = 20; //maximum rows per page
include_once "../includes/inc_paging1.php"; //Includes pagination
$sqrytyrrmsz_mst1 = "SELECT tyrrmszm_id, tyrrmszm_name, tyrrmszm_sts, tyrrmszm_prty, tyrrmszm_vehtypm_id, tyrrmszm_tyrwdthm_id, tyrrmszm_tyrprflm_id, vehtypm_name, vehtypm_id, tyrwdthm_id, tyrwdthm_name, tyrprflm_id, tyrprflm_name from tyr_rimsize_mst inner join veh_type_mst on tyrrmszm_vehtypm_id = vehtypm_id inner join tyr_wdth_mst on tyrrmszm_tyrwdthm_id = tyrwdthm_id inner join tyr_prfl_mst on tyrrmszm_tyrprflm_id = tyrprflm_id";
if(isset($_REQUEST['lstvehtyp']) && (trim($_REQUEST['lstvehtyp'])!=""))
{
	$lstvehtyp = glb_func_chkvl($_REQUEST['lstvehtyp']);
	$loc .= "&lstvehtyp=".$lstvehtyp;
	if(isset($_REQUEST['chk']) && (trim($_REQUEST['chk'])=='y'))
	{
		$sqrytyrrmsz_mst2.=" and tyrrmszm_vehtypm_id = '$lstvehtyp'";
	}
	else
	{
		$sqrytyrrmsz_mst2.=" and tyrrmszm_vehtypm_id like '%$lstvehtyp%'";
	}
}
if(isset($_REQUEST['lsttyrwdth']) && (trim($_REQUEST['lsttyrwdth'])!=""))
{
	$lsttyrwdth = glb_func_chkvl($_REQUEST['lsttyrwdth']);
	$loc .= "&lsttyrwdth=".$lsttyrwdth;
	if(isset($_REQUEST['chk']) && (trim($_REQUEST['chk'])=='y'))
	{
		$sqrytyrrmsz_mst2.=" and tyrrmszm_tyrwdthm_id = '$lsttyrwdth'";
	}
	else
	{
		$sqrytyrrmsz_mst2.=" and tyrrmszm_tyrwdthm_id like '%$lsttyrwdth%'";
	}
}
if(isset($_REQUEST['lsttyrprfl']) && (trim($_REQUEST['lsttyrprfl'])!=""))
{
	$lsttyrprfl = glb_func_chkvl($_REQUEST['lsttyrprfl']);
	$loc .= "&lsttyrprfl = ".$lsttyrwdth;
	if(isset($_REQUEST['chk']) && (trim($_REQUEST['chk'])=='y'))
	{
		$sqrytyrrmsz_mst2.=" and tyrrmszm_tyrprflm_id = '$lsttyrprfl'";
	}
	else
	{
		$sqrytyrrmsz_mst2.=" and tyrrmszm_tyrprflm_id like '%$lsttyrprfl%'";
	}
}
if(isset($_REQUEST['txtname']) && (trim($_REQUEST['txtname'])!=""))
{
	$txtname = glb_func_chkvl($_REQUEST['txtname']);
	$loc .= "&txtname=".$txtname;
	if(isset($_REQUEST['chk']) && (trim($_REQUEST['chk'])=='y'))
	{
		$sqrytyrrmsz_mst2.=" and tyrrmszm_name ='$txtname'";
	}
	else
	{
		$sqrytyrrmsz_mst2.=" and tyrrmszm_name like '%$txtname%'";
	}
}
$sqrytyrrmsz_mst1 = $sqrytyrrmsz_mst1.$sqrytyrrmsz_mst2;
$sqrytyrrmsz_mst = $sqrytyrrmsz_mst1." order by tyrrmszm_name limit $offset, $rowsprpg";
// echo $sqrytyrrmsz_mst;
$srstyrrmsz_mst = mysqli_query($conn,$sqrytyrrmsz_mst);
$cnt_recs = mysqli_num_rows($srstyrrmsz_mst);
include_once 'script.php';
?>
<script language="javascript">
	function addnew()
	{
		document.frmtyrrmszmst.action = "<?php echo $rd_adpgnm; ?>";
		document.frmtyrrmszmst.submit();
	}
	function srch()
	{
		//alert("");
		var urlval="";
		if((document.frmtyrrmszmst.lstvehtyp.value == "") && (document.frmtyrrmszmst.lsttyrwdth.value == "") && (document.frmtyrrmszmst.lsttyrprfl.value == "") && (document.frmtyrrmszmst.txtname.value == ""))
		{
			alert("Select Search Criteria");
			document.frmtyrrmszmst.lstvehtyp.focus();
			return false;
		}
		var lstvehtyp = document.frmtyrrmszmst.lstvehtyp.value;
		var lsttyrwdth = document.frmtyrrmszmst.lsttyrwdth.value;
		var lsttyrprfl = document.frmtyrrmszmst.lsttyrprfl.value;
		var txtname = document.frmtyrrmszmst.txtname.value;
		if(lstvehtyp !='')
		{
			if(urlval == "")
			{
				urlval +="lstvehtyp="+lstvehtyp;
			}
			else
			{
				urlval +="&lstvehtyp="+lstvehtyp;
			}
		}
		if(lsttyrwdth !='')
		{
			if(urlval == "")
			{
				urlval +="lsttyrwdth="+lsttyrwdth;
			}
			else
			{
				urlval +="&lsttyrwdth="+lsttyrwdth;
			}
		}
		if(lsttyrprfl !='')
		{
			if(urlval == "")
			{
				urlval +="lsttyrprfl="+lsttyrprfl;
			}
			else
			{
				urlval +="&lsttyrprfl="+lsttyrprfl;
			}
		}
		if(txtname !='')
		{
			if(urlval == "")
			{
				urlval +="txtname="+txtname;
			}
			else
			{
				urlval +="&txtname="+txtname;
			}
		}
		if(document.frmtyrrmszmst.chkexact.checked==true)
		{
			document.frmtyrrmszmst.action="<?php echo $rd_crntpgnm; ?>?"+urlval+"&chk=y";
			document.frmtyrrmszmst.submit();
		}
		else
		{
			document.frmtyrrmszmst.action="<?php echo $rd_crntpgnm; ?>?"+urlval;
			document.frmtyrrmszmst.submit();
		}
		return true;
	}
</script>
<script language="javascript" type="text/javascript" src="../includes/chkbxvalidate.js"></script>
<link href="docstyle.css" rel="stylesheet" type="text/css">
<body>
	<?php include_once $inc_adm_hdr; ?>
	<section class="content">
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0 text-dark">View All Tyre Rim Sizes</h1>
					</div><!-- /.col -->
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item active">View All Tyre Rim Sizes</li>
						</ol>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.container-fluid -->
		</div>
		<!-- Default box -->
		<div class="card">
			<?php if(isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == "y"))
			{ ?>
				<div class="alert alert-danger alert-dismissible fade show" role="alert" id="delids">
					<strong>Deleted Successfully !</strong>
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
				<form method="post" action="<?php $_SERVER['SCRIPT_FILENAME'];?>" name="frmtyrrmszmst" id="frmtyrrmszmst">
					<input type="hidden" name="hdnchkval" id="hdnchkval">
					<input type="hidden" name="hdnchksts" id="hdnchksts">
					<input type="hidden" name="hdnallval" id="hdnallval">
					<div class="col-md-12">
						<div class="row justify-content-left align-items-center mt-3">
							<div class="col-sm-2">
								<div class="form-group">
									<?php
									$sqryvehtyp_mst = "SELECT vehtypm_id, vehtypm_name from veh_type_mst where vehtypm_id != ''";
									$srsvehtyp_mst = mysqli_query($conn,$sqryvehtyp_mst);
									$cnt_vehtyp = mysqli_num_rows($srsvehtyp_mst);
									?>
									<select name="lstvehtyp" class="form-control" >
										<option value="">--Select Type--</option>
										<?php
										if($cnt_vehtyp > 0)
										{
											while($rowsvehtyp_mst=mysqli_fetch_assoc($srsvehtyp_mst))
											{
												$vehtypm_id =$rowsvehtyp_mst['vehtypm_id'];
												$vehtypm_name =$rowsvehtyp_mst['vehtypm_name'];
												?>
												<option value="<?php echo $vehtypm_id;?>"<?php if(isset($_REQUEST['lstvehtyp']) && trim($_REQUEST['lstvehtyp']) == $vehtypm_id){echo 'selected';}?>><?php echo $vehtypm_name;?></option>
												<?php
											}
										}
										?>
									</select>
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group">
									<?php
									$sqrytyrwdth_mst = "SELECT tyrwdthm_id, tyrwdthm_name from tyr_wdth_mst where tyrwdthm_id != ''";
									$srstyrwdth_mst = mysqli_query($conn,$sqrytyrwdth_mst);
									$cnt_tyrwdth = mysqli_num_rows($srstyrwdth_mst);
									?>
									<select name="lsttyrwdth" class="form-control" >
										<option value="">--Select Width--</option>
										<?php
										if($cnt_tyrwdth > 0)
										{
											while($rowstyrwdth_mst=mysqli_fetch_assoc($srstyrwdth_mst))
											{
												$tyrwdthm_id =$rowstyrwdth_mst['tyrwdthm_id'];
												$tyrwdthm_name =$rowstyrwdth_mst['tyrwdthm_name'];
												?>
												<option value="<?php echo $tyrwdthm_id;?>"<?php if(isset($_REQUEST['lsttyrwdth']) && trim($_REQUEST['lsttyrwdth']) == $tyrwdthm_id){echo 'selected';}?>><?php echo $tyrwdthm_name;?></option>
												<?php
											}
										}
										?>
									</select>
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group">
									<?php
									$sqrytyrprfl_mst = "SELECT tyrprflm_id, tyrprflm_name from tyr_prfl_mst where tyrprflm_id != ''";
									$srstyrprfl_mst = mysqli_query($conn,$sqrytyrprfl_mst);
									$cnt_tyrprfl = mysqli_num_rows($srstyrprfl_mst);
									?>
									<select name="lsttyrprfl" class="form-control" >
										<option value="">--Select Profile--</option>
										<?php
										if($cnt_tyrprfl > 0)
										{
											while($rowstyrprfl_mst=mysqli_fetch_assoc($srstyrprfl_mst))
											{
												$tyrprflm_id =$rowstyrprfl_mst['tyrprflm_id'];
												$tyrprflm_name =$rowstyrprfl_mst['tyrprflm_name'];
												?>
												<option value="<?php echo $tyrprflm_id;?>"<?php if(isset($_REQUEST['lsttyrprfl']) && trim($_REQUEST['lsttyrprfl']) == $tyrprflm_id){echo 'selected';}?>><?php echo $tyrprflm_name;?></option>
												<?php
											}
										}
										?>
									</select>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<div class="col-8">
										<div class="row">
											<div class="col-10">
												<input type="text" name="txtname" placeholder="Search by name" id="txtname" class="form-control"  value="<?php if(isset($_REQUEST['txtname']) && $_REQUEST['txtname']!=""){echo $_REQUEST['txtname'];}?>">
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">Exact
									<input type="checkbox" name="chkexact" value="1" <?php if(isset($_POST['chkexact']) && ($_POST['chkexact']==1)){echo 'checked';}elseif(isset($_REQUEST['chk']) && ($_REQUEST['chk']=='y')){echo 'checked';}?>>
									&nbsp;&nbsp;&nbsp;
									<input type="submit" value="Search" class="btn btn-primary" name="btnsbmt" onClick="srch();">
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
									<td colspan="<?php echo $clspn_val;?>">&nbsp;</td>
									<td width="7%" align="right" valign="bottom">
										<div align="right">
											<input name="btnsts" id="btnsts" type="button" class="btn btn-xs btn-primary" value="Status" onClick="updatests('hdnchksts','frmtyrrmszmst','chksts')">
										</div>
									</td>
									<td width="7%" align="right" valign="bottom">
										<div align="right">
											<input name="btndel" id="btndel" type="button" class="btn btn-xs btn-primary" value="Delete" onClick="deleteall('hdnchkval','frmtyrrmszmst','chkdlt');">
										</div>
									</td>
								</tr>
								<tr>
									<td width="8%" class="td_bg"><strong>SL.No.</strong></td>
									<td width="28%" class="td_bg"><strong>Name</strong></td>
									<td width="24%" class="td_bg"><strong>Vehicle Type</strong></td>
									<td width="15%" class="td_bg"><strong>Tyre Width</strong></td>    
									<td width="15%" class="td_bg"><strong>Tyre Profile</strong></td>    
									<td width="6%" align="center" class="td_bg"><strong>Rank</strong></td>
									<td width="7%" align="center" class="td_bg"><strong>Edit</strong></td>
									<td width="7%" class="td_bg" align="center"><strong>
									<input type="checkbox" name="Check_ctr" id="Check_ctr" value="yes"onClick="Check(document.frmtyrrmszmst.chksts,'Check_ctr','hdnallval')"></strong></td>
									<td width="7%" class="td_bg" align="center"><strong>
									<input type="checkbox" name="Check_dctr" id="Check_dctr" value="yes" onClick="Check(document.frmtyrrmszmst.chkdlt,'Check_dctr')"></strong></td>
								</tr>
								<?php
								$cnt = $offset;
								if($cnt_recs > 0)
								{
									while($srowvehvrnt_mst=mysqli_fetch_assoc($srstyrrmsz_mst))
									{
										$cnt+=1;
										$pgval_srch = $pgnum.$loc;
										$db_subid = $srowvehvrnt_mst['tyrrmszm_id'];
										$db_subname = $srowvehvrnt_mst['tyrrmszm_name'];
										$db_typname = $srowvehvrnt_mst['vehtypm_name'];
										$db_brndname = $srowvehvrnt_mst['tyrwdthm_name'];
										$db_mdlname = $srowvehvrnt_mst['tyrprflm_name'];
										$db_prty = $srowvehvrnt_mst['tyrrmszm_prty'];
										$db_sts  = $srowvehvrnt_mst['tyrrmszm_sts'];
										$db_szchrt = $srowvehvrnt_mst['tyrrmszm_brndimg'];
										?>
										<tr <?php if($cnt%2==0){echo "";}else{echo "";}?>>
											<td><?php echo $cnt;?></td>
											<!-- <td><?php echo $db_subid;?></td> -->
											<td>
												<a href="<?php echo $rd_vwpgnm;?>?vw=<?php echo $db_subid;?>&pg=<?php echo $pgnum;?>&countstart=<?php echo $cntstart.$loc;?>" class="links"><?php echo $db_subname;?></a>
											</td>
											<td align="left"><?php echo $db_typname;?></td>
											<td align="left"><?php echo $db_brndname;?></td>
											<td align="left"><?php echo $db_mdlname;?></td>
											<td align="center"><?php echo $db_prty;?></td> 
											<td align="center">
												<a href="<?php echo $rd_edtpgnm; ?>?edit=<?php echo $db_subid;?>&pg=<?php echo $pgnum;?>&countstart=<?php echo $cntstart.$loc;?>" class="orongelinks">Edit</a>
											</td>
											<td align="center">
												<input type="checkbox" name="chksts" id="chksts" value="<?php echo $srowvehvrnt_mst['tyrrmszm_id'];?>" <?php if($srowvehvrnt_mst['tyrrmszm_sts'] =='a') { echo "checked";}?> onClick="addchkval(<?php echo $srowvehvrnt_mst['tyrrmszm_id'];?>,'hdnchksts','frmtyrrmszmst','chksts');">
											</td>
											<td align="center">
												<input type="checkbox" name="chkdlt" id="chkdlt" value="<?php echo $srowvehvrnt_mst['tyrrmszm_id'];?>">
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
									<td colspan="<?php echo $clspn_val;?>">&nbsp;</td>
									<td width="7%" align="right" valign="bottom">
										<div align="right">
											<input name="btnsts" id="btnsts" type="button" value="Status" onClick="updatests('hdnchksts','frmtyrrmszmst','chksts')" class="btn btn-xs btn-primary">
										</div>
									</td>
									<td width="7%" align="right" valign="bottom">
										<div align="right">
											<input name="btndel" id="btndel" type="button" value="Delete" onClick="deleteall('hdnchkval','frmtyrrmszmst','chkdlt');" class="btn btn-xs btn-primary">
										</div>
									</td>
								</tr>
								<?php    
								$disppg = funcDispPag($conn,'links',$loc,$sqrytyrrmsz_mst1,$rowsprpg,$cntstart,$pgnum);     
								$colspanval = $clspn_val+2;            
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
</body>
<?php include_once "../includes/inc_adm_footer.php"; ?>
