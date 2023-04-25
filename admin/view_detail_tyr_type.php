<?php
include_once '../includes/inc_config.php'; //Making paging validation	
include_once $inc_nocache; //Clearing the cache information
include_once $adm_session; //checking for session
include_once $inc_cnctn; //Making database Connection
include_once $inc_usr_fnctn; //checking for session	
include_once $inc_pgng_fnctns; //Making paging validation
include_once $inc_fldr_pth; //Making paging validation
/***************************************************************
Programm : view_detail_tyr_type.php	
Purpose : For Viewing Vehicle type Details
Created By : Bharath
Created On : 25-12-2021
Modified By : 
Modified On :
Purpose : 
Company : Adroit
************************************************************/
global $id,$pg,$countstart;
$rd_crntpgnm = "view_tyre_type.php";
$rd_edtpgnm = "edit_tyre_type.php";
$clspn_val = "4";
/*****header link********/
$pagemncat = "Setup";
$pagecat = "Tyre";
$pagenm = "Tyre Type";
/*****header link********/
if(isset($_REQUEST['vw']) && (trim($_REQUEST['vw'])!="") && isset($_REQUEST['pg']) && (trim($_REQUEST['pg'])!="") && isset($_REQUEST['countstart']) && (trim($_REQUEST['countstart'])!=""))
{
	$id = glb_func_chkvl($_REQUEST['vw']);
	$pg = glb_func_chkvl($_REQUEST['pg']);
	$countstart = glb_func_chkvl($_REQUEST['countstart']);
	$srchval = glb_func_chkvl($_REQUEST['val']);
	$chk = glb_func_chkvl($_REQUEST['chk']);
}
$sqrytyrtyp_mst = "SELECT tyrtypm_name, tyrtypm_cde, tyrtypm_desc, tyrtypm_seotitle, tyrtypm_seodesc, tyrtypm_seokywrd, tyrtypm_seohonetitle, tyrtypm_seohonedesc, tyrtypm_seohtwotitle, tyrtypm_seohtwodesc, if(tyrtypm_sts = 'a', 'Active','Inactive') as tyrtypm_sts, tyrtypm_prty from tyr_type_mst where tyrtypm_id = $id";
$srstyrtyp_mst = mysqli_query($conn,$sqrytyrtyp_mst);
$rowsvehtyp_mst = mysqli_fetch_assoc($srstyrtyp_mst);
$loc= "&val=$srchval";
if($chk !='')
{
	$loc .="&chk=y";
}
if(isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == "y"))	
{
	$msg = "<center><font color=red>Record updated successfully</font></center>";
}
elseif(isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == "n"))
{
	$msg = "<center><font color=red>Record not updated</font></center>";
}
elseif(isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == "d"))
{
	$msg = "<center><font color=red>Duplicate Recored Name Exists & Recor</center>d Not updated</font>";
}
?>
<script language="javascript">
function update1() //for update download details
{
	document.frmedttyrtypid.action="<?php echo $rd_edtpgnm;?>?vw=<?php echo $id;?>&pg=<?php echo $pg;?>&countstart=<?php echo $countstart.$loc;?>";
	document.frmedttyrtypid.submit();
}
</script>
<?php 
include_once $inc_adm_hdr;
include_once $inc_adm_lftlnk;
?>
<section class="content">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">View Tyre Type</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">View Tyre Type</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<form name="frmedttyrtypid" id="frmedttyrtypid" method="post" action="<?php $_SERVER['PHP_SELF'];?>" onSubmit="return performCheck('frmedttyrtypid', rules, 'inline');">
		<input type="hidden" name="hdntyrtypid" value="<?php echo $id;?>">
		<input type="hidden" name="hdnpage" value="<?php echo $pg;?>">
		<input type="hidden" name="hdncnt" value="<?php echo $countstart?>">
		<?php
		if($msg !='')
		{
	 		echo "<tr bgcolor='#FFFFFF'>
				<td colspan='4' bgcolor='#F3F3F3' align='center'><strong>$msg</strong></td> 
			 </tr>";
		}
		?>
		<div class="card">
			<div class="card-body">
				<div class="row justify-content-center">
					<div class="col-md-12">
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Name</label>
							<div class="col-sm-8">
								<?php echo $rowsvehtyp_mst['tyrtypm_name'];?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Description</label>
							<div class="col-sm-8">
								<?php echo $rowsvehtyp_mst['tyrtypm_desc'];?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">SEO Title</label>
							<div class="col-sm-8">
								<?php echo $rowsvehtyp_mst['tyrtypm_seotitle'];?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">SEO Keyword</label>
							<div class="col-sm-8">
								<?php echo $rowsvehtyp_mst['tyrtypm_seokywrd'];?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">SEO Description</label>
							<div class="col-sm-8">
								<?php echo $rowsvehtyp_mst['tyrtypm_seodesc'];?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">SEO H1 Title</label>
							<div class="col-sm-8">
								<?php echo $rowsvehtyp_mst['tyrtypm_seohonetitle'];?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">SEO H1 Description</label>
							<div class="col-sm-8">
								<?php echo $rowsvehtyp_mst['tyrtypm_seohonedesc'];?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">SEO H2 Title</label>
							<div class="col-sm-8">
								<?php echo $rowsvehtyp_mst['tyrtypm_seohtwotitle'];?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">SEO H2 Description </label>
							<div class="col-sm-8">
								<?php echo $rowsvehtyp_mst['tyrtypm_seohtwodesc'];?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Rank</label>
							<div class="col-sm-8">
								<?php echo $rowsvehtyp_mst['tyrtypm_prty'];?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Status</label>
							<div class="col-sm-8"> 
								<?php echo $rowsvehtyp_mst['tyrtypm_sts'];?>
							</div>
						</div>
						<p class="text-center">
							<input type="Submit" class="btn btn-primary btn-cst" name="frmedttyrtypid" id="frmedttyrtypid" value="Edit" 
							onclick="update1()">
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