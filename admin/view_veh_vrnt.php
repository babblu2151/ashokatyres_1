<?php
include_once '../includes/inc_config.php'; //Making paging validation 
include_once $inc_nocache; //Clearing the cache information
include_once $adm_session; //checking for session
include_once $inc_cnctn; //Making database Connection
include_once $inc_usr_fnctn; //checking for session 
include_once $inc_pgng_fnctns; //Making paging validation 
include_once $inc_fldr_pth; //Making paging validation
/***************************************************************
Programm : view_veh_vrnt.php
Purpose : For Viewing Vehicle Brands
Created By : Bharath
Created On : 27-12-2021
Modified By : 
Modified On :
Company : Adroit
************************************************************/
global $msg,$loc,$rowsprpg,$dispmsg,$disppg;
$clspn_val = "7";
$rd_adpgnm = "add_vehicle_vrnt.php";
$rd_edtpgnm = "edit_vehicle_vrnt.php";
$rd_crntpgnm = "view_veh_vrnt.php";
$rd_vwpgnm = "view_detail_veh_vrnt.php";
$loc = "";
/*****header link********/
$pagemncat = "Setup";
$pagecat = "Vehicle";
$pagenm = "Vehicle Variant"; 
/*****header link********/
if(isset($_POST['hdnchksts']) && (trim($_POST['hdnchksts'])!="") || isset($_POST['hdnallval']) && (trim($_POST['hdnallval'])!=""))
{
	$dchkval = substr($_POST['hdnchksts'],1);
	$id = glb_func_chkvl($dchkval);  
	$chkallval = glb_func_chkvl($_POST['hdnallval']);
	$updtsts = funcUpdtAllRecSts($conn,'veh_vrnt_mst','vehvrntm_id',$id,'vehvrntm_sts',$chkallval);  
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
	$delsts = funcDelAllRec($conn,'veh_vrnt_mst','vehvrntm_id',$did);
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
$sqryvehvrnt_mst1 = "SELECT vehvrntm_id, vehvrntm_name, vehvrntm_sts, vehvrntm_prty, vehvrntm_vehtypm_id, vehvrntm_vehbrndm_id, vehvrntm_vehmdlm_id, vehtypm_name, vehtypm_id, vehbrndm_id, vehbrndm_name, vehmodlm_id, vehmodlm_name from veh_vrnt_mst inner join veh_type_mst on vehvrntm_vehtypm_id = vehtypm_id inner join veh_brnd_mst on vehvrntm_vehbrndm_id = vehbrndm_id inner join veh_model_mst on vehvrntm_vehmdlm_id = vehmodlm_id";
if(isset($_REQUEST['lstvehtyp']) && (trim($_REQUEST['lstvehtyp'])!=""))
{
	$lstvehtyp = glb_func_chkvl($_REQUEST['lstvehtyp']);
	$loc .= "&lstvehtyp=".$lstvehtyp;
	if(isset($_REQUEST['chk']) && (trim($_REQUEST['chk'])=='y'))
	{
		$sqryvehvrnt_mst2.=" and vehvrntm_vehtypm_id = '$lstvehtyp'";
	}
	else
	{
		$sqryvehvrnt_mst2.=" and vehvrntm_vehtypm_id like '%$lstvehtyp%'";
	}
}
if(isset($_REQUEST['lstvehbrnd']) && (trim($_REQUEST['lstvehbrnd'])!=""))
{
	$lstvehbrnd = glb_func_chkvl($_REQUEST['lstvehbrnd']);
	$loc .= "&lstvehbrnd=".$lstvehbrnd;
	if(isset($_REQUEST['chk']) && (trim($_REQUEST['chk'])=='y'))
	{
		$sqryvehvrnt_mst2.=" and vehvrntm_vehbrndm_id = '$lstvehbrnd'";
	}
	else
	{
		$sqryvehvrnt_mst2.=" and vehvrntm_vehbrndm_id like '%$lstvehbrnd%'";
	}
}
if(isset($_REQUEST['lstvehmdl']) && (trim($_REQUEST['lstvehmdl'])!=""))
{
	$lstvehmdl = glb_func_chkvl($_REQUEST['lstvehmdl']);
	$loc .= "&lstvehmdl = ".$lstvehbrnd;
	if(isset($_REQUEST['chk']) && (trim($_REQUEST['chk'])=='y'))
	{
		$sqryvehvrnt_mst2.=" and vehvrntm_vehmdlm_id = '$lstvehmdl'";
	}
	else
	{
		$sqryvehvrnt_mst2.=" and vehvrntm_vehmdlm_id like '%$lstvehmdl%'";
	}
}
if(isset($_REQUEST['txtname']) && (trim($_REQUEST['txtname'])!=""))
{
	$txtname = glb_func_chkvl($_REQUEST['txtname']);
	$loc .= "&txtname=".$txtname;
	if(isset($_REQUEST['chk']) && (trim($_REQUEST['chk'])=='y'))
	{
		$sqryvehvrnt_mst2.=" and vehvrntm_name ='$txtname'";
	}
	else
	{
		$sqryvehvrnt_mst2.=" and vehvrntm_name like '%$txtname%'";
	}
}
$sqryvehvrnt_mst1 = $sqryvehvrnt_mst1.$sqryvehvrnt_mst2;
$sqryvehvrnt_mst = $sqryvehvrnt_mst1." order by vehvrntm_name limit $offset, $rowsprpg";
// echo $sqryvehvrnt_mst;
$srsvehvrnt_mst = mysqli_query($conn,$sqryvehvrnt_mst);
$cnt_recs = mysqli_num_rows($srsvehvrnt_mst);
include_once 'script.php';
?>
<script language="javascript">
	function addnew()
	{
		document.frmvrntmst.action = "<?php echo $rd_adpgnm; ?>";
		document.frmvrntmst.submit();
	}
	function srch()
	{
		//alert("");
		var urlval="";
		if((document.frmvrntmst.lstvehtyp.value == "") && (document.frmvrntmst.lstvehbrnd.value == "") && (document.frmvrntmst.lstvehmdl.value == "") && (document.frmvrntmst.txtname.value == ""))
		{
			alert("Select Search Criteria");
			document.frmvrntmst.lstvehtyp.focus();
			return false;
		}
		var lstvehtyp = document.frmvrntmst.lstvehtyp.value;
		var lstvehbrnd = document.frmvrntmst.lstvehbrnd.value;
		var lstvehmdl = document.frmvrntmst.lstvehmdl.value;
		var txtname = document.frmvrntmst.txtname.value;
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
		if(lstvehbrnd !='')
		{
			if(urlval == "")
			{
				urlval +="lstvehbrnd="+lstvehbrnd;
			}
			else
			{
				urlval +="&lstvehbrnd="+lstvehbrnd;
			}
		}
		if(lstvehmdl !='')
		{
			if(urlval == "")
			{
				urlval +="lstvehmdl="+lstvehmdl;
			}
			else
			{
				urlval +="&lstvehmdl="+lstvehmdl;
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
		if(document.frmvrntmst.chkexact.checked==true)
		{
			document.frmvrntmst.action="<?php echo $rd_crntpgnm; ?>?"+urlval+"&chk=y";
			document.frmvrntmst.submit();
		}
		else
		{
			document.frmvrntmst.action="<?php echo $rd_crntpgnm; ?>?"+urlval;
			document.frmvrntmst.submit();
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
						<h1 class="m-0 text-dark">View All Vehicle Varaiants</h1>
					</div><!-- /.col -->
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item active">View All Vehicle Varaiants</li>
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
				<form method="post" action="<?php $_SERVER['SCRIPT_FILENAME'];?>" name="frmvrntmst" id="frmvrntmst">
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
									$sqryvehbrnd_mst = "SELECT vehbrndm_id, vehbrndm_name from veh_brnd_mst where vehbrndm_id != ''";
									$srsvehbrnd_mst = mysqli_query($conn,$sqryvehbrnd_mst);
									$cnt_vehbrnd = mysqli_num_rows($srsvehbrnd_mst);
									?>
									<select name="lstvehbrnd" class="form-control" >
										<option value="">--Select Brand--</option>
										<?php
										if($cnt_vehbrnd > 0)
										{
											while($rowsvehbrnd_mst=mysqli_fetch_assoc($srsvehbrnd_mst))
											{
												$vehbrndm_id =$rowsvehbrnd_mst['vehbrndm_id'];
												$vehbrndm_name =$rowsvehbrnd_mst['vehbrndm_name'];
												?>
												<option value="<?php echo $vehbrndm_id;?>"<?php if(isset($_REQUEST['lstvehbrnd']) && trim($_REQUEST['lstvehbrnd']) == $vehbrndm_id){echo 'selected';}?>><?php echo $vehbrndm_name;?></option>
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
									$sqryvehmdl_mst = "SELECT vehmodlm_id, vehmodlm_name from veh_model_mst where vehmodlm_id != ''";
									$srsvehmdl_mst = mysqli_query($conn,$sqryvehmdl_mst);
									$cnt_vehmdl = mysqli_num_rows($srsvehmdl_mst);
									?>
									<select name="lstvehmdl" class="form-control" >
										<option value="">--Select Model--</option>
										<?php
										if($cnt_vehmdl > 0)
										{
											while($rowsvehmdl_mst=mysqli_fetch_assoc($srsvehmdl_mst))
											{
												$vehmodlm_id =$rowsvehmdl_mst['vehmodlm_id'];
												$vehmodlm_name =$rowsvehmdl_mst['vehmodlm_name'];
												?>
												<option value="<?php echo $vehmodlm_id;?>"<?php if(isset($_REQUEST['lstvehmdl']) && trim($_REQUEST['lstvehmdl']) == $vehmodlm_id){echo 'selected';}?>><?php echo $vehmodlm_name;?></option>
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
											<input name="btnsts" id="btnsts" type="button" class="btn btn-xs btn-primary" value="Status" onClick="updatests('hdnchksts','frmvrntmst','chksts')">
										</div>
									</td>
									<td width="7%" align="right" valign="bottom">
										<div align="right">
											<input name="btndel" id="btndel" type="button" class="btn btn-xs btn-primary" value="Delete" onClick="deleteall('hdnchkval','frmvrntmst','chkdlt');">
										</div>
									</td>
								</tr>
								<tr>
									<td width="8%" class="td_bg"><strong>SL.No.</strong></td>
									<td width="28%" class="td_bg"><strong>Name</strong></td>
									<td width="24%" class="td_bg"><strong>Vehicle Type</strong></td>
									<td width="15%" class="td_bg"><strong>Brand</strong></td>    
									<td width="15%" class="td_bg"><strong>Model</strong></td>    
									<td width="6%" align="center" class="td_bg"><strong>Rank</strong></td>
									<td width="7%" align="center" class="td_bg"><strong>Edit</strong></td>
									<td width="7%" class="td_bg" align="center"><strong>
									<input type="checkbox" name="Check_ctr" id="Check_ctr" value="yes"onClick="Check(document.frmvrntmst.chksts,'Check_ctr','hdnallval')"></strong></td>
									<td width="7%" class="td_bg" align="center"><strong>
									<input type="checkbox" name="Check_dctr" id="Check_dctr" value="yes" onClick="Check(document.frmvrntmst.chkdlt,'Check_dctr')"></strong></td>
								</tr>
								<?php
								$cnt = $offset;
								if($cnt_recs > 0)
								{
									while($srowvehvrnt_mst=mysqli_fetch_assoc($srsvehvrnt_mst))
									{
										$cnt+=1;
										$pgval_srch = $pgnum.$loc;
										$db_subid = $srowvehvrnt_mst['vehvrntm_id'];
										$db_subname = $srowvehvrnt_mst['vehvrntm_name'];
										$db_typname = $srowvehvrnt_mst['vehtypm_name'];
										$db_brndname = $srowvehvrnt_mst['vehbrndm_name'];
										$db_mdlname = $srowvehvrnt_mst['vehmodlm_name'];
										$db_prty = $srowvehvrnt_mst['vehvrntm_prty'];
										$db_sts  = $srowvehvrnt_mst['vehvrntm_sts'];
										$db_szchrt = $srowvehvrnt_mst['vehvrntm_brndimg'];
										$db_todt = $srowvehvrnt_mst['vehvrntm_todt'];
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
												<input type="checkbox" name="chksts" id="chksts" value="<?php echo $srowvehvrnt_mst['vehvrntm_id'];?>" <?php if($srowvehvrnt_mst['vehvrntm_sts'] =='a') { echo "checked";}?> onClick="addchkval(<?php echo $srowvehvrnt_mst['vehvrntm_id'];?>,'hdnchksts','frmvrntmst','chksts');">
											</td>
											<td align="center">
												<input type="checkbox" name="chkdlt" id="chkdlt" value="<?php echo $srowvehvrnt_mst['vehvrntm_id'];?>">
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
											<input name="btnsts" id="btnsts" type="button" value="Status" onClick="updatests('hdnchksts','frmvrntmst','chksts')" class="btn btn-xs btn-primary">
										</div>
									</td>
									<td width="7%" align="right" valign="bottom">
										<div align="right">
											<input name="btndel" id="btndel" type="button" value="Delete" onClick="deleteall('hdnchkval','frmvrntmst','chkdlt');" class="btn btn-xs btn-primary">
										</div>
									</td>
								</tr>
								<?php    
								$disppg = funcDispPag($conn,'links',$loc,$sqryvehvrnt_mst1,$rowsprpg,$cntstart,$pgnum);     
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
