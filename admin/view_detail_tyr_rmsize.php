<?php
include_once '../includes/inc_config.php'; //Making paging validation	
include_once $inc_nocache; //Clearing the cache information
include_once $adm_session; //checking for session
include_once $inc_cnctn; //Making database Connection
include_once $inc_usr_fnctn; //checking for session	
include_once $inc_pgng_fnctns; //Making paging validation
include_once $inc_fldr_pth; //Making paging validation
/***************************************************************
Programm : view_detail_tyr_rmsize.php	
Purpose : For Viewing Tyre rim size Details
Created By : Bharath
Created On :	30-12-2021
Modified By : 
Modified On :
Purpose : 
Company : Adroit
************************************************************/
global $id,$pg,$countstart;
$rd_crntpgnm = "view_tyr_rimsize.php";
$rd_edtpgnm = "edit_tyr_rmsize.php";
$clspn_val = "4";
/*****header link********/
$pagemncat = "Setup";
$pagecat = "Tyre";
$pagenm = "Tyre Rim Size"; 
/*****header link********/
if(isset($_REQUEST['vw']) && (trim($_REQUEST['vw'])!="") && isset($_REQUEST['pg']) && (trim($_REQUEST['pg'])!="") && isset($_REQUEST['countstart']) && (trim($_REQUEST['countstart'])!=""))
{
	$id = glb_func_chkvl($_REQUEST['vw']);
	$pg = glb_func_chkvl($_REQUEST['pg']);
	$countstart = glb_func_chkvl($_REQUEST['countstart']);
	$srchval = glb_func_chkvl($_REQUEST['val']);
}
$sqrytyrrmsz_mst = "SELECT tyrrmszm_name, tyrrmszm_desc, if(tyrrmszm_sts = 'a', 'Active','Inactive') as tyrrmszm_sts, vehtypm_prty, tyrrmszm_prty, vehtypm_name, tyrwdthm_name, tyrprflm_name, tyrrmszm_seotitle, tyrrmszm_seodesc, tyrrmszm_seokywrd, tyrrmszm_seohonetitle, tyrrmszm_seohonedesc, tyrrmszm_seohtwotitle, tyrrmszm_seohtwodesc
	from tyr_rimsize_mst
	inner join veh_type_mst on vehtypm_id = tyrrmszm_vehtypm_id
	inner join tyr_wdth_mst on tyrwdthm_id = tyrrmszm_tyrwdthm_id
	inner join tyr_prfl_mst on tyrprflm_id = tyrrmszm_tyrprflm_id
	where tyrrmszm_id = $id";
// echo $sqrytyrrmsz_mst;
$srsvehvrnt_mst = mysqli_query($conn,$sqrytyrrmsz_mst);
$rowsvehvrnt_mst = mysqli_fetch_assoc($srsvehvrnt_mst);
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
<script language="javascript">	
	function update1() //for update download details
	{
		document.frmedttyrrmszid.action="<?php echo $rd_edtpgnm;?>?vw=<?php echo $id;?>&pg=<?php echo $pg;?>&countstart=<?php echo $countstart.$loc;?>";
		document.frmedttyrrmszid.submit();
	}
</script>
<?php include_once $inc_adm_hdr; ?>
<section class="content">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">View Tyre Rime Size</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">View Tyre Rime Size</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<form name="frmedttyrrmszid" id="frmedttyrrmszid" method="post" action="<?php $_SERVER['PHP_SELF'];?>" onSubmit="return performCheck('frmedttyrrmszid', rules, 'inline');">
		<input type="hidden" name="hdntyrrmszid" value="<?php echo $id;?>">
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
					<div class="col-md-12">
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Vehicle Type</label>
							<div class="col-sm-8">
								<?php echo $rowsvehvrnt_mst['vehtypm_name'];?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Tyre Width</label>
							<div class="col-sm-8">
								<?php echo $rowsvehvrnt_mst['tyrwdthm_name'];?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Tyre Profile</label>
							<div class="col-sm-8">
								<?php echo $rowsvehvrnt_mst['tyrprflm_name'];?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Name</label>
							<div class="col-sm-8">
								<?php echo $rowsvehvrnt_mst['tyrrmszm_name'];?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Description</label>
							<div class="col-sm-8">
								<?php echo $rowsvehvrnt_mst['tyrrmszm_desc'];?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">SEO Title</label>
							<div class="col-sm-8">
								<?php echo $rowsvehvrnt_mst['tyrrmszm_seotitle'];?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">SEO Keyword</label>
							<div class="col-sm-8">
								<?php echo $rowsvehvrnt_mst['tyrrmszm_seokywrd'];?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">SEO Description</label>
							<div class="col-sm-8">
								<?php echo $rowsvehvrnt_mst['tyrrmszm_seodesc'];?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">SEO H1 Title</label>
							<div class="col-sm-8">
								<?php echo $rowsvehvrnt_mst['tyrrmszm_seohonetitle'];?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">SEO H1 Description</label>
							<div class="col-sm-8">
								<?php echo $rowsvehvrnt_mst['tyrrmszm_seohonedesc'];?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">SEO H2 Title</label>
							<div class="col-sm-8">
								<?php echo $rowsvehvrnt_mst['tyrrmszm_seohtwotitle'];?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">SEO H2 Description </label>
							<div class="col-sm-8">
								<?php echo $rowsvehvrnt_mst['tyrrmszm_seohtwodesc'];?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Rank</label>
							<div class="col-sm-8">
								<?php echo $rowsvehvrnt_mst['tyrrmszm_prty'];?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Status</label>
							<div class="col-sm-8"> 
								<?php echo $rowsvehvrnt_mst['tyrrmszm_sts'];?>
							</div>
						</div>
						<p class="text-center">
							<input type="Submit" class="btn btn-primary btn-cst" name="frmedttyrrmszid" id="frmedttyrrmszid" value="Edit" 
							onclick="update1();">
							&nbsp;&nbsp;&nbsp;
							<input type="button" name="btnBack" value="Back" class="btn btn-primary btn-cst" onclick="location.href='<?php echo $rd_crntpgnm;?>?<?php echo $loc;?>'">
						</p>
					</div>
				</div>
			</div>
		</div>
	</form> 
</section>
<?php include_once "../includes/inc_adm_footer.php";?>