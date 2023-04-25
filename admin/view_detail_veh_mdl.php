<?php
include_once '../includes/inc_config.php'; //Making paging validation	
include_once $inc_nocache; //Clearing the cache information
include_once $adm_session; //checking for session
include_once $inc_cnctn; //Making database Connection
include_once $inc_usr_fnctn; //checking for session	
include_once $inc_pgng_fnctns; //Making paging validation
include_once $inc_fldr_pth; //Making paging validation
/***************************************************************
Programm : view_detail_veh_brnd.php	
Purpose : For Viewing Vehicle Model Details
Created By : Bharath
Created On :	27-12-2021
Modified By : 
Modified On :
Purpose : 
Company : Adroit
************************************************************/
global $id,$pg,$countstart;
$rd_crntpgnm = "view_veh_model.php";
$rd_edtpgnm = "edit_vehicle_model.php";
$clspn_val = "4";
/*****header link********/
$pagemncat = "Setup";
$pagecat = "Vehicle";
$pagenm = "Vehicle Model"; 
/*****header link********/
if(isset($_REQUEST['vw']) && (trim($_REQUEST['vw'])!="") && isset($_REQUEST['pg']) && (trim($_REQUEST['pg'])!="") && isset($_REQUEST['countstart']) && (trim($_REQUEST['countstart'])!=""))
{
	$id = glb_func_chkvl($_REQUEST['vw']);
	$pg = glb_func_chkvl($_REQUEST['pg']);
	$countstart = glb_func_chkvl($_REQUEST['countstart']);
	$srchval = glb_func_chkvl($_REQUEST['val']);
}
$sqryvehmdl_mst = "SELECT vehmodlm_name, vehmodlm_desc, if(vehmodlm_sts = 'a', 'Active','Inactive') as vehmodlm_sts, vehmodlm_prty, vehtypm_name, vehbrndm_name, vehmodlm_seotitle, vehmodlm_seodesc, vehmodlm_seokywrd, vehmodlm_seohonetitle, vehmodlm_seohonedesc, vehmodlm_seohtwotitle, vehmodlm_seohtwodesc
	from veh_model_mst
	inner join veh_type_mst on vehtypm_id = vehmodlm_vehtypm_id
	inner join veh_brnd_mst on vehbrndm_id = vehmodlm_vehbrndm_id
	where vehmodlm_id = $id";
// echo $sqryvehmdl_mst;
$srsvehmdl_mst = mysqli_query($conn,$sqryvehmdl_mst);
$rowsvehmdl_mst = mysqli_fetch_assoc($srsvehmdl_mst);
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
		document.frmedtvehmdlid.action="<?php echo $rd_edtpgnm;?>?vw=<?php echo $id;?>&pg=<?php echo $pg;?>&countstart=<?php echo $countstart.$loc;?>";
		document.frmedtvehmdlid.submit();
	}
</script>
<?php include_once $inc_adm_hdr; ?>
<section class="content">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">View Vehicle Model</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">View Vehicle Model</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<form name="frmedtvehmdlid" id="frmedtvehmdlid" method="post" action="<?php $_SERVER['PHP_SELF'];?>" onSubmit="return performCheck('frmedtvehmdlid', rules, 'inline');">
		<input type="hidden" name="hdnvehmdlid" value="<?php echo $id;?>">
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
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Type</label>
							<div class="col-sm-8">
								<?php echo $rowsvehmdl_mst['vehtypm_name'];?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Brand</label>
							<div class="col-sm-8">
								<?php echo $rowsvehmdl_mst['vehbrndm_name'];?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Name</label>
							<div class="col-sm-8">
								<?php echo $rowsvehmdl_mst['vehmodlm_name'];?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Description</label>
							<div class="col-sm-8">
								<?php echo $rowsvehmdl_mst['vehmodlm_desc'];?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">SEO Title</label>
							<div class="col-sm-8">
								<?php echo $rowsvehmdl_mst['vehmodlm_seotitle'];?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">SEO Keyword</label>
							<div class="col-sm-8">
								<?php echo $rowsvehmdl_mst['vehmodlm_seokywrd'];?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">SEO Description</label>
							<div class="col-sm-8">
								<?php echo $rowsvehmdl_mst['vehmodlm_seodesc'];?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">SEO H1 Title</label>
							<div class="col-sm-8">
								<?php echo $rowsvehmdl_mst['vehmodlm_seohonetitle'];?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">SEO H1 Description</label>
							<div class="col-sm-8">
								<?php echo $rowsvehmdl_mst['vehmodlm_seohonedesc'];?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">SEO H2 Title</label>
							<div class="col-sm-8">
								<?php echo $rowsvehmdl_mst['vehmodlm_seohtwotitle'];?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">SEO H2 Description </label>
							<div class="col-sm-8">
								<?php echo $rowsvehmdl_mst['vehmodlm_seohtwodesc'];?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Rank</label>
							<div class="col-sm-8">
								<?php echo $rowsvehmdl_mst['vehmodlm_prty'];?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Status</label>
							<div class="col-sm-8"> 
								<?php echo $rowsvehmdl_mst['vehmodlm_sts'];?>
							</div>
						</div>
						<p class="text-center">
							<input type="Submit" class="btn btn-primary btn-cst" name="frmedtvehmdlid" id="frmedtvehmdlid" value="Edit" 
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