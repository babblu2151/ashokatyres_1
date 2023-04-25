<?php
include_once '../includes/inc_config.php'; //Making paging validation 
include_once $inc_nocache; //Clearing the cache information
include_once $adm_session; //checking for session
include_once $inc_cnctn; //Making database Connection
include_once $inc_usr_fnctn; //checking for session 
include_once $inc_pgng_fnctns; //Making paging validation 
include_once $inc_fldr_pth; //Making paging validation
/***************************************************************
Programm : view_all_users.php
Purpose : For Viewing Store Users
Created By : Bharath
Created On : 03-01-2022
Modified By : 
Modified On :
Company : Adroit
************************************************************/
global $msg,$loc,$rowsprpg,$dispmsg,$disppg;
$clspn_val = "4";
$rd_adpgnm = "add_loc_usr.php";
$rd_edtpgnm = "edit_loc_usr.php";
$rd_crntpgnm = "view_all_users.php";
// $rd_vwpgnm = "view_detail_veh_brnd.php";
$loc = "";
/*****header link********/
$pagemncat = "Setup";
$pagecat = "Stores";
$pagenm = "Users";
/*****header link********/
if(isset($_POST['hdnchksts']) && (trim($_POST['hdnchksts'])!="") || isset($_POST['hdnallval']) && (trim($_POST['hdnallval'])!=""))
{
	$dchkval = substr($_POST['hdnchksts'],1);
	$id = glb_func_chkvl($dchkval);  
	$chkallval = glb_func_chkvl($_POST['hdnallval']);
	$updtsts = funcUpdtAllRecSts($conn,'lgn_mst','lgnm_id',$id,'lgnm_sts',$chkallval);  
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
	$delsts = funcDelAllRec($conn,'lgn_mst','lgnm_id',$did);
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
$sqrystrusr_mst1 = "SELECT lgnm_id, lgnm_uid, lgnm_sts, lgnm_store_id, strlocm_name, strlocm_id from lgn_mst inner join store_loc_mst on lgnm_store_id = strlocm_id";
if(isset($_REQUEST['lststrloc']) && (trim($_REQUEST['lststrloc'])!=""))
{
	$lststrloc = glb_func_chkvl($_REQUEST['lststrloc']);
	$loc .= "&lststrloc=".$lststrloc;
	if(isset($_REQUEST['chk']) && (trim($_REQUEST['chk'])=='y'))
	{
		$sqrystrusr_mst2.=" and lgnm_store_id = '$lststrloc'";
	}
	else
	{
		$sqrystrusr_mst2.=" and lgnm_store_id like '%$lststrloc%'";
	}
}
if(isset($_REQUEST['txtname']) && (trim($_REQUEST['txtname'])!=""))
{
	$txtname = glb_func_chkvl($_REQUEST['txtname']);
	$loc .= "&txtname=".$txtname;
	if(isset($_REQUEST['chk']) && (trim($_REQUEST['chk'])=='y'))
	{
		$sqrystrusr_mst2.=" and lgnm_uid ='$txtname'";
	}
	else
	{
		$sqrystrusr_mst2.=" and lgnm_uid like '%$txtname%'";
	}
}
$sqrystrusr_mst1 = $sqrystrusr_mst1.$sqrystrusr_mst2;
$sqrystrusr_mst = $sqrystrusr_mst1." order by lgnm_uid limit $offset, $rowsprpg";
// echo $sqrystrusr_mst;
$srsstrusr_mst = mysqli_query($conn,$sqrystrusr_mst);
$cnt_recs = mysqli_num_rows($srsstrusr_mst);
include_once 'script.php';
?>
<script language="javascript">
	function addnew()
	{
		document.frmstrusrmst.action = "<?php echo $rd_adpgnm; ?>";
		document.frmstrusrmst.submit();
	}
	function srch()
	{
		//alert("");
		var urlval="";
		if((document.frmstrusrmst.lststrloc.value=="") && (document.frmstrusrmst.txtname.value==""))
		{
			alert("Select Search Criteria");
			document.frmstrusrmst.lststrloc.focus();
			return false;
		}
		var lststrloc = document.frmstrusrmst.lststrloc.value;
		var txtname = document.frmstrusrmst.txtname.value;
		if(lststrloc !='')
		{
			if(urlval == "")
			{
				urlval +="lststrloc="+lststrloc;
			}
			else
			{
				urlval +="&lststrloc="+lststrloc;
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
		if(document.frmstrusrmst.chkexact.checked==true)
		{
			document.frmstrusrmst.action="<?php echo $rd_crntpgnm; ?>?"+urlval+"&chk=y";
			document.frmstrusrmst.submit();
		}
		else
		{
			document.frmstrusrmst.action="<?php echo $rd_crntpgnm; ?>?"+urlval;
			document.frmstrusrmst.submit();
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
						<h1 class="m-0 text-dark">View All Store Users</h1>
					</div><!-- /.col -->
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item active">View All Store Users</li>
						</ol>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.container-fluid -->
		</div>
		<!-- Default box -->
		<div class="card">
			<!-- <?php if(isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == "y"))
			{ ?>
				<div class="alert alert-danger alert-dismissible fade show" role="alert" id="delids">
					<strong>Deleted Successfully !</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<?php
			}
			?> -->
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
				<form method="post" action="<?php $_SERVER['SCRIPT_FILENAME'];?>" name="frmstrusrmst" id="frmstrusrmst">
					<input type="hidden" name="hdnchkval" id="hdnchkval">
					<input type="hidden" name="hdnchksts" id="hdnchksts">
					<input type="hidden" name="hdnallval" id="hdnallval">
					<div class="col-md-12">
						<div class="row justify-content-left align-items-center mt-3">
							<div class="col-sm-3">
								<div class="form-group">
									<?php
									$sqrystrloc_mst = "SELECT strlocm_id, strlocm_name from store_loc_mst where strlocm_id != ''";
									$srsstrloc_mst = mysqli_query($conn,$sqrystrloc_mst);
									$cnt_strloc = mysqli_num_rows($srsstrloc_mst);
									?>
									<select name="lststrloc" class="form-control" >
										<option value="">--Select Location--</option>
										<?php
										if($cnt_strloc > 0)
										{
											while($rowsstrloc_mst=mysqli_fetch_assoc($srsstrloc_mst))
											{
												$strlocm_id =$rowsstrloc_mst['strlocm_id'];
												$strlocm_name =$rowsstrloc_mst['strlocm_name'];
												?>
												<option value="<?php echo $strlocm_id;?>"<?php if(isset($_REQUEST['lststrloc']) && trim($_REQUEST['lststrloc'])==$strlocm_id){echo 'selected';}?>><?php echo $strlocm_name;?></option>
												<?php
											}
										}
										?>
									</select>
								</div>
							</div>
							<div class="col-sm-5">
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
								<?php
								if($msg != "")
								{
									$dispmsg = "<tr><td align='center' colspan='6'>$msg</td></tr>";
									echo $dispmsg;
								}
								?>
								<tr>
									<td colspan="<?php echo $clspn_val;?>">&nbsp;</td>
									<td width="7%" align="right" valign="bottom">
										<div align="right">
											<input name="btnsts" id="btnsts" type="button" class="btn btn-xs btn-primary" value="Status" onClick="updatests('hdnchksts','frmstrusrmst','chksts')">
										</div>
									</td>
									<td width="7%" align="right" valign="bottom">
										<div align="right">
											<input name="btndel" id="btndel" type="button" class="btn btn-xs btn-primary" value="Delete" onClick="deleteall('hdnchkval','frmstrusrmst','chkdlt');">
										</div>
									</td>
								</tr>
								<tr>
									<td width="8%" class="td_bg"><strong>SL.No.</strong></td>
									<td width="28%" class="td_bg"><strong>Name</strong></td>
									<td width="24%" class="td_bg"><strong>Location</strong></td>
									<td width="7%" align="center" class="td_bg"><strong>Edit</strong></td>
									<td width="7%" class="td_bg" align="center"><strong>
									<input type="checkbox" name="Check_ctr" id="Check_ctr" value="yes"onClick="Check(document.frmstrusrmst.chksts,'Check_ctr','hdnallval')"></strong></td>
									<td width="7%" class="td_bg" align="center"><strong>
									<input type="checkbox" name="Check_dctr" id="Check_dctr" value="yes" onClick="Check(document.frmstrusrmst.chkdlt,'Check_dctr')"></strong></td>
								</tr>
								<?php
								$cnt = $offset;
								if($cnt_recs > 0)
								{
									while($srowlgn_mst=mysqli_fetch_assoc($srsstrusr_mst))
									{
										$cnt+=1;
										$pgval_srch = $pgnum.$loc;
										$db_subid = $srowlgn_mst['lgnm_id'];
										$db_subname = $srowlgn_mst['lgnm_uid'];
										$db_catname = $srowlgn_mst['strlocm_name'];
										$db_prty = $srowlgn_mst['strusrm_prty'];
										$db_sts  = $srowlgn_mst['lgnm_sts'];
										?>
										<tr <?php if($cnt%2==0){echo "";}else{echo "";}?>>
											<td><?php echo $cnt;?></td>
											<!-- <td><?php echo $db_subid;?></td> -->
											<td>
												<!-- <a href="<?php echo $rd_vwpgnm;?>?vw=<?php echo $db_subid;?>&pg=<?php echo $pgnum;?>&countstart=<?php echo $cntstart.$loc;?>" class="links"> --><?php echo $db_subname;?><!-- </a> -->
											</td>
											<td align="left"><?php echo $db_catname;?></td>
											<td align="center">
												<a href="<?php echo $rd_edtpgnm; ?>?edit=<?php echo $db_subid;?>&pg=<?php echo $pgnum;?>&countstart=<?php echo $cntstart.$loc;?>" class="orongelinks">Edit</a>
											</td>
											<td align="center">
												<input type="checkbox" name="chksts" id="chksts" value="<?php echo $srowlgn_mst['lgnm_id'];?>" <?php if($srowlgn_mst['lgnm_sts'] =='a') { echo "checked";}?> onClick="addchkval(<?php echo $srowlgn_mst['lgnm_id'];?>,'hdnchksts','frmstrusrmst','chksts');">
											</td>
											<td align="center">
												<input type="checkbox" name="chkdlt" id="chkdlt" value="<?php echo $srowlgn_mst['lgnm_id'];?>">
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
											<input name="btnsts" id="btnsts" type="button" value="Status" onClick="updatests('hdnchksts','frmstrusrmst','chksts')" class="btn btn-xs btn-primary">
										</div>
									</td>
									<td width="7%" align="right" valign="bottom">
										<div align="right">
											<input name="btndel" id="btndel" type="button" value="Delete" onClick="deleteall('hdnchkval','frmstrusrmst','chkdlt');" class="btn btn-xs btn-primary">
										</div>
									</td>
								</tr>
								<?php    
								$disppg = funcDispPag($conn,'links',$loc,$sqrystrusr_mst1,$rowsprpg,$cntstart,$pgnum);     
								$colspanval = $clspn_val+2;            
								if($disppg != "")
								{
									$disppg = "<br><tr><td colspan='$colspanval' align='center' >$disppg</td></tr>";
									echo $disppg;
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
