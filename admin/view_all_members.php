<?php
include_once '../includes/inc_config.php'; //Making paging validation
include_once $inc_nocache; //Clearing the cache information
include_once $adm_session; //checking for session
include_once $inc_cnctn; //Making database Connection
include_once $inc_usr_fnctn; //checking for session	
include_once $inc_pgng_fnctns; //Making paging validation 
include_once $inc_fldr_pth; //Making paging validation
// include_once "../includes/inc_adm_mdlprvlg.php";//Making paging validation
/***************************************************************
Programm : view_all_members.php	
Purpose : For Viewing all Members
Created By : Bharath
Created On :	06-01-2022
Modified By : 
Modified On : 
Purpose : 
Company : Adroit
************************************************************/
global $msg,$loc,$rowsprpg,$dispmsg,$disppg;
$clspn_val = "4";
$rd_crntpgnm = "view_all_members.php";
$rd_vwpgnm = "view_detail_mbmr.php";
$loc = "";
/*****header link********/
$pagemncat = "Setup";
$pagecat = "Members";
$pagenm = "Members"; 
/*****header link********/
if(isset($_POST['hdnchksts']) && (trim($_POST['hdnchksts'])!="") || isset($_POST['hdnallval']) && (trim($_POST['hdnallval'])!=""))
{
	$dchkval = substr($_POST['hdnchksts'],1);
	$id  	 = glb_func_chkvl($dchkval);		
	$chkallval	=  glb_func_chkvl($_POST['hdnallval']);			
	$updtsts = funcUpdtAllRecSts($conn,'mbr_mst','mbrm_id',$id,'mbrm_sts',$chkallval);		
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
	$did 	= glb_func_chkvl($dchkval);			
	$delsts = funcDelAllRec($conn,'mbr_mst','mbrm_id',$did);	
	if($delsts == 'y')
	{
		$msg = "<font color=red>Record deleted successfully</font>";
	}
	elseif($delsts == 'n')
	{
		$msg = "<font color=red>Record can't be deleted(child records exist)</font>";
	}
}
if(isset($_REQUEST['sts']) && (trim($_REQUEST['sts'])=='y'))
{
	$msg = "<font color=red>Record updated successfully</font>";
}
if(isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == 'n'))
{
	$msg = "<font color=red>Record not updated</font>";
}
if(isset($_REQUEST['sts']) && (trim($_REQUEST['sts'])=='d'))
{
	$msg = "<font color=red>Duplicate Recored Name Exists ,Record Not updated</font>";
}	
$rowsprpg  = 20;//maximum rows per page
include_once "../includes/inc_paging1.php"; //Includes pagination
include_once 'script.php';
$sqrymbr_mst1="SELECT mbrm_id, mbrm_emailid, mbrm_phno, mbrd_fstname, mbrd_lstname, mbrm_sts, date_format(mbrm_crtdon,'%d-%m-%Y') as mbrm_crtdon from vw_mbr_mst_dtl_bil where mbrm_sts != ''";
if(isset($_REQUEST['txtphno']) && (trim($_REQUEST['txtphno'])!=""))
{
	$txtphno = glb_func_chkvl($_REQUEST['txtphno']);
	$loc .= "&txtphno=".$txtphno;
	if(isset($_REQUEST['chk']) && (trim($_REQUEST['chk'])=='y'))
	{
		$sqrymbr_mst2 .=" and mbrm_phno = '$txtphno'";
	}
	else
	{
		$sqrymbr_mst2 .=" and mbrm_phno like '%$txtphno%'";
	}
}
if(isset($_REQUEST['txtemail']) && (trim($_REQUEST['txtemail'])!=""))
{
	$txtemail = glb_func_chkvl($_REQUEST['txtemail']);
	$loc .= "&txtemail=".$txtemail;
	if(isset($_REQUEST['chk']) && (trim($_REQUEST['chk'])=='y'))
	{
		$sqrymbr_mst2 .=" and mbrm_emailid = '$txtemail'";
	}
	else
	{
		$sqrymbr_mst2 .=" and mbrm_emailid like '%$txtemail%'";
	}
}
if(isset($_REQUEST['txtname']) && (trim($_REQUEST['txtname'])!=""))
{
	$txtname = glb_func_chkvl($_REQUEST['txtname']);
	$loc .= "&txtname=".$txtname;
	if(isset($_REQUEST['chk']) && (trim($_REQUEST['chk'])=='y'))
	{
		$sqrymbr_mst2 .=" and (mbrd_fstname ='$txtname' or mbrd_lstname ='$txtname')";
	}
	else
	{
		$sqrymbr_mst2 .=" and (mbrd_fstname like '%$txtname%' or mbrd_lstname like '%$txtname%')";
	}
}
$sqrymbr_mst1 = $sqrymbr_mst1.$sqrymbr_mst2;
$sqrymbr_mst = $sqrymbr_mst1." group by mbrm_id order by mbrm_id desc limit $offset,$rowsprpg";
// echo $sqrymbr_mst;
$srsmbr_mst = mysqli_query($conn,$sqrymbr_mst);
$serchres=mysqli_num_rows($srsmbr_mst);
if($serchres==0)
{
	$msg = "<font color=red>Record Not Found</font>";
}
?>
<script language="javascript">
	function srch()
	{
		//alert("");
		var urlval="";
		if((document.frmmbr.txtemail.value=="") && (document.frmmbr.txtphno.value=="") && (document.frmmbr.txtname.value==""))
		{
			alert("Select Search Criteria");
			document.frmmbr.txtname.focus();
			return false;
		}
		var txtphno = document.frmmbr.txtphno.value;
		var txtemail = document.frmmbr.txtemail.value;
		var txtname = document.frmmbr.txtname.value;
		if(txtphno !='')
		{
			if(urlval == "")
			{
				urlval +="txtphno="+txtphno;
			}
			else
			{
				urlval +="&txtphno="+txtphno;
			}
		}
		if(txtemail !='')
		{
			if(urlval == "")
			{
				urlval +="txtemail="+txtemail;
			}
			else
			{
				urlval +="&txtemail="+txtemail;
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
		if(document.frmmbr.chkexact.checked==true)
		{
			document.frmmbr.action="<?php echo $rd_crntpgnm; ?>?"+urlval+"&chk=y";
			document.frmmbr.submit();
		}
		else
		{
			document.frmmbr.action="<?php echo $rd_crntpgnm; ?>?"+urlval;
			document.frmmbr.submit();
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
            <h1 class="m-0 text-dark">Registered Members </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Registered Members </li>
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
				<form method="post" action="<?php $_SERVER['SCRIPT_FILENAME'];?>" name="frmmbr" id="frmmbr">
					<input type="hidden" name="hdnchkval" id="hdnchkval">
					<input type="hidden" name="hdnchksts" id="hdnchksts">
					<input type="hidden" name="hdnallval" id="hdnallval">
					<div class="col-md-12">
						<div class="row justify-content-left align-items-left mt-3">
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
							<div class="col-sm-5">
								<div class="form-group">
									<div class="col-8">
										<div class="row">
											<div class="col-10">
												<input type="text" name="txtemail" placeholder="Search by Email" id="txtemail" class="form-control"  value="<?php if(isset($_REQUEST['txtemail']) && $_REQUEST['txtemail']!=""){echo $_REQUEST['txtemail'];}?>">
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-5">
								<div class="form-group">
									<div class="col-10">
										<div class="row">
											<div class="col-8">
												<input type="text" name="txtphno" placeholder="Search by Phone" id="txtphno" class="form-control"  value="<?php if(isset($_REQUEST['txtphno']) && $_REQUEST['txtphno']!=""){echo $_REQUEST['txtphno'];}?>">
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
									<!-- <button type="submit" class="btn btn-primary" onClick="addnew();">+ Add</button> -->
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
											<input name="btnsts" id="btnsts" type="button" class="btn btn-xs btn-primary" value="Status" onClick="updatests('hdnchksts','frmmbr','chksts')">
										</div>
									</td>
									<td width="7%" align="right" valign="bottom">
										<div align="right">
											<input name="btndel" id="btndel" type="button" class="btn btn-xs btn-primary" value="Delete" onClick="deleteall('hdnchkval','frmmbr','chkdlt');">
										</div>
									</td>
								</tr>
								<tr>
									<td width="8%" class="td_bg"><strong>SL.No.</strong></td>
									<td width="28%" class="td_bg"><strong>Name</strong></td>
									<td width="24%" class="td_bg"><strong>Email</strong></td>
									<td width="15%" class="td_bg"><strong>Phone</strong></td>
									<!-- <td width="7%" align="center" class="td_bg"><strong>Edit</strong></td> -->
									<td width="7%" class="td_bg" align="center"><strong>
									<input type="checkbox" name="Check_ctr" id="Check_ctr" value="yes"onClick="Check(document.frmmbr.chksts,'Check_ctr','hdnallval')"></strong></td>
									<td width="7%" class="td_bg" align="center"><strong>
									<input type="checkbox" name="Check_dctr" id="Check_dctr" value="yes" onClick="Check(document.frmmbr.chkdlt,'Check_dctr')"></strong></td>
								</tr>
								<?php
								$cnt = $offset;
								if($serchres > 0)
								{
									while($srowmbr_mst=mysqli_fetch_assoc($srsmbr_mst))
									{
										$cnt+=1;
										$pgval_srch = $pgnum.$loc;
										$db_subid = $srowmbr_mst['mbrm_id'];
										$db_subname = $srowmbr_mst['mbrd_fstname']." ".$srowmbr_mst['mbrd_lstname'];
										$db_email = $srowmbr_mst['mbrm_emailid'];
										$db_phno = $srowmbr_mst['mbrm_phno'];
										$db_sts  = $srowmbr_mst['mbrm_sts'];
										?>
										<tr <?php if($cnt%2==0){echo "";}else{echo "";}?>>
											<td><?php echo $cnt;?></td>
											<!-- <td><?php echo $db_subid;?></td> -->
											<td>
												<a href="<?php echo $rd_vwpgnm;?>?vw=<?php echo $db_subid;?>&pg=<?php echo $pgnum;?>&countstart=<?php echo $cntstart.$loc;?>" class="links"><?php echo $db_subname;?></a>
											</td>
											<td align="left"><?php echo $db_email;?></td>
											<td align="left"><?php echo $db_phno;?></td> 
											<!-- <td align="center">
												<a href="<?php echo $rd_edtpgnm; ?>?edit=<?php echo $db_subid;?>&pg=<?php echo $pgnum;?>&countstart=<?php echo $cntstart.$loc;?>" class="orongelinks">Edit</a>
											</td> -->
											<td align="center">
												<input type="checkbox" name="chksts" id="chksts" value="<?php echo $srowmbr_mst['mbrm_id'];?>" <?php if($srowmbr_mst['mbrm_sts'] =='a') { echo "checked";}?> onClick="addchkval(<?php echo $srowmbr_mst['mbrm_id'];?>,'hdnchksts','frmmbr','chksts');">
											</td>
											<td align="center">
												<input type="checkbox" name="chkdlt" id="chkdlt" value="<?php echo $srowmbr_mst['mbrm_id'];?>">
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
											<input name="btnsts" id="btnsts" type="button" value="Status" onClick="updatests('hdnchksts','frmmbr','chksts')" class="btn btn-xs btn-primary">
										</div>
									</td>
									<td width="7%" align="right" valign="bottom">
										<div align="right">
											<input name="btndel" id="btndel" type="button" value="Delete" onClick="deleteall('hdnchkval','frmmbr','chkdlt');" class="btn btn-xs btn-primary">
										</div>
									</td>
								</tr>
								<?php    
								$disppg = funcDispPag($conn,'links',$loc,$sqrymbr_mst1,$rowsprpg,$cntstart,$pgnum);     
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
					</form><br>
          </td>
        <td width="6" valign="top" background="images/content_right_line.gif"><img src="images/content_corow_top_r.gif" width="6" height="8"></td>
      </tr>
    </table></td>
  </tr>
</table>
<?php include_once "../includes/inc_adm_footer.php";?>
</body>
</html>
