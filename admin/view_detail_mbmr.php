<?php
include_once '../includes/inc_config.php'; //Making paging validation	
include_once $inc_nocache; //Clearing the cache information
include_once $adm_session; //checking for session
include_once $inc_cnctn; //Making database Connection
include_once $inc_usr_fnctn; //checking for session	
include_once $inc_pgng_fnctns; //Making paging validation
include_once $inc_fldr_pth; //Making paging validation
/***************************************************************
Programm : view_detail_mbmr.php	
Purpose : For Viewing Banner Details
Created By : Bharath
Created On :	27-12-2021
Modified By : 
Modified On :
Purpose : 
Company : Adroit
************************************************************/
global $id,$pg,$countstart;
$rd_crntpgnm = "view_all_members.php";
$clspn_val = "4";
/*****header link********/
$pagemncat = "Setup";
$pagecat = "Members";
$pagenm = "Members"; 
/*****header link********/
if(isset($_REQUEST['vw']) && (trim($_REQUEST['vw'])!="") && isset($_REQUEST['pg']) && (trim($_REQUEST['pg'])!="") && isset($_REQUEST['countstart']) && (trim($_REQUEST['countstart'])!=""))
{
	$id = glb_func_chkvl($_REQUEST['vw']);
	$pg = glb_func_chkvl($_REQUEST['pg']);
	$countstart = glb_func_chkvl($_REQUEST['countstart']);
	$srchval = glb_func_chkvl($_REQUEST['val']);
}
$sqrymbr_mst = "SELECT mbrd_id,mbrd_fstname,mbrd_lstname, mbrd_badrs,mbrd_badrs2,mbrd_cmpny,ctym_name, mbrd_bzip,mbrd_bdayphone,cntrym_name, mbrd_ctynm,mbrd_bdayphone,mbrd_dfltbil,mbrd_dfltshp,mbrd_mbrm_id,mbrm_phno,mbrd_emailid,cntrym_name,cntym_name,cntntm_name,ctym_sts, cntym_sts,mbrm_emailid,mbrd_bmbrcntrym_id,mbrd_bmbrcntym_id,cntym_name,cntrym_name from vw_mbr_mst_dtl_bil where mbrm_id = $id";
$srsmbr_mst = mysqli_query($conn,$sqrymbr_mst);
$loc= "&val=$srchval";
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
?>
<!-- <script language="javascript">	
	function update1() //for update download details
	{
		document.frmmbr.action="<?php echo $rd_edtpgnm;?>?vw=<?php echo $id;?>&pg=<?php echo $pg;?>&countstart=<?php echo $countstart.$loc;?>";
		document.frmmbr.submit();
	}
</script> -->
<?php include_once $inc_adm_hdr; ?>
<section class="content">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">View Member</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">View Member</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<form name="frmmbr" id="frmmbr" method="post" action="<?php $_SERVER['PHP_SELF'];?>" onSubmit="return performCheck('frmmbr', rules, 'inline');">
		<input type="hidden" name="hdnmbrid" value="<?php echo $id;?>">
		<input type="hidden" name="hdnpage" value="<?php echo $pg;?>">
		<input type="hidden" name="hdncnt" value="<?php echo $countstart?>">
		<?php
		if($msg !='')
		{
	 		echo "<center><tr bgcolor='#FFFFFF'>
				<td colspan='4' bgcolor='#F3F3F3' align='center'><strong>$msg</strong></td> 
			 </tr></center>";
		}
		?>
		<div class="card">
			<div class="card-body">
				<div class="row justify-content-center">
					<?php
					while($rowsmbr_mst = mysqli_fetch_assoc($srsmbr_mst))
					{
						$mbraddr = $rowsmbr_mst['mbrd_badrs'];
						$mbrctynm = $rowsmbr_mst['mbrd_ctynm'];
						$mbrzip = $rowsmbr_mst['mbrd_bzip'];
						$cntryname = $rowsmbr_mst['cntrym_name'];
						$statename = $rowsmbr_mst['cntym_name'];
						?>
						<div class="col-sm-6 mb-4">
							<div class="card">
								<div class="card-body">
									<p><strong><?php echo $rowsmbr_mst['mbrd_fstname']." ".$rowsmbr_mst1['mbrd_lstname'];?></strong>
										<br>
										<?php echo $rowsmbr_mst['mbrm_emailid'];?>
										<br>
										<?php echo $rowsmbr_mst['mbrm_phno'];?>
										<br>
										<?php echo $mbraddr.", ".$mbrctynm; ?>
										<br>
										<?php echo $statename.", ".$cntryname.", ".$mbrzip; ?>
									</p>
								</div>
							</div>
						</div>
						<?php
					}
					?>
				</div>
				<div class="row justify-content-center">
					<input type="button" name="btnBack" value="Back" class="btn btn-primary btn-cst" onclick="location.href='<?php echo $rd_crntpgnm;?>?<?php echo $loc;?>'">
				</div>
			</div>
		</div>
	</form> 
</section>
<?php include_once "../includes/inc_adm_footer.php";?>