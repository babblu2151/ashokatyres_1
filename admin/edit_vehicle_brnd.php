<?php
include_once '../includes/inc_config.php'; //Making paging validation
include_once $inc_nocache; //Clearing the cache information
include_once $adm_session; //checking for session
include_once $inc_cnctn; //Making database Connection
include_once $inc_usr_fnctn; //checking for session	
include_once $inc_pgng_fnctns; //Making paging validation
include_once $inc_fldr_pth; //Making paging validation
/**********************************************************
Programm : edit_vehicle_brnd.php 
Purpose : For Editing Vehicle Brand Details
Created By : Bharath
Created On : 27-12-2021
Modified By : 
Modified On : 
Purpose : 
Company : Adroit
************************************************************/ 
/*****header link********/
$pagemncat = "Setup";
$pagecat = "Vehicle";
$pagenm = "Vehicle Brand";
/*****header link********/
global $id,$pg,$countstart;
$rd_vwpgnm = "view_detail_veh_brnd.php";
$rd_crntpgnm = "view_veh_brand.php";
$clspn_val = "4";
if(isset($_POST['btnebrndsbmt']) && (trim($_POST['btnebrndsbmt']) != "") && isset($_POST['lstvehtyp']) && (trim($_POST['lstvehtyp']) != "") && isset($_POST['txtname']) && (trim($_POST['txtname']) != "") && isset($_POST['txtprior']) && (trim($_POST['txtprior']) != ""))
{
	include_once "../includes/inc_fnct_fleupld.php"; // For uploading files 
	include_once "../database/uqry_vehbrnd_mst.php";
}
if(isset($_REQUEST['edit']) && (trim($_REQUEST['edit'])!="") && isset($_REQUEST['pg']) && (trim($_REQUEST['pg'])!="") && isset($_REQUEST['countstart']) && (trim($_REQUEST['countstart'])!=""))
{
	$id = glb_func_chkvl($_REQUEST['edit']);
	$pg = glb_func_chkvl($_REQUEST['pg']);
	$countstart = glb_func_chkvl($_REQUEST['countstart']);
}
elseif(isset($_REQUEST['hdnvehbrndid']) && (trim($_REQUEST['hdnvehbrndid'])!="") && isset($_REQUEST['hdnpage']) && (trim($_REQUEST['hdnpage'])!="") && isset($_REQUEST['hdncnt']) && (trim($_REQUEST['hdncnt'])!=""))
{
	$id = glb_func_chkvl($_REQUEST['hdnvehbrndid']);
	$pg = glb_func_chkvl($_REQUEST['hdnpage']);
	$countstart = glb_func_chkvl($_REQUEST['hdncnt']);
}
$sqryvehbrnd_mst = "SELECT vehbrndm_name, vehbrndm_desc, vehbrndm_vehtypm_id, vehbrndm_sts, vehbrndm_prty, vehbrndm_seotitle,vehbrndm_seodesc, vehbrndm_seokywrd, vehbrndm_seohonetitle, vehbrndm_seohonedesc, vehbrndm_seohtwotitle, vehbrndm_seohtwodesc, vehbrndm_brndimg from veh_brnd_mst where vehbrndm_id = $id";
$srsvehbrnd_mst = mysqli_query($conn,$sqryvehbrnd_mst);
$cntrec = mysqli_num_rows($srsvehbrnd_mst);
if($cntrec > 0)
{
	$rowsvehbrnd_mst = mysqli_fetch_assoc($srsvehbrnd_mst);
}
else
{ ?>
	<script>location.href = "<?php echo $rd_crntpgnm; ?>";</script>
	<?php
	exit();
}
?>
<script language="javaScript" type="text/javascript" src="js/ckeditor.js"></script>
<script language="javascript" src="../includes/yav.js"></script>
<script language="javascript" src="../includes/yav-config.js"></script>
<link rel="stylesheet" type="text/css" href="../includes/yav-style1.css">
<script language="javascript" type="text/javascript">
	var rules=new Array();
	rules[0]='txtname:Name|required|Enter Name';
  rules[1]='txtname:Name|alphaspace|Name only characters and numbers';
  rules[2]='lstvehtyp:Category|required|Select Category';
  rules[3]='txtprior:Priority|required|Enter Rank';
  function setfocus()
  {
  	document.getElementById('txtname').focus();
  }
</script>
<?php 
include_once ('script.php');
include_once ('../includes/inc_fnct_ajax_validation.php');	
?>
<script language="javascript" type="text/javascript">
	function funcChkDupName()
	{
		var name = document.getElementById('txtname').value;
		var vehtypid = document.getElementById('lstvehtyp').value; 
		id = <?php echo $id;?>;
		if(vehtypid!="" && name != "")
		{
			var url = "chkduplicate.php?vehbrndname="+name+"&vehtypid="+vehtypid+"&brndid="+id;
			xmlHttp	= GetXmlHttpObject(stateChanged);
			xmlHttp.open("GET", url , true);
			xmlHttp.send(null);
		}
		else
		{
			document.getElementById('errorsDiv_txtname').innerHTML = "";
			document.getElementById('errorsDiv_lstvehtyp').innerHTML = "";
		}
	}
	function stateChanged()
	{
		if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
		{
			var temp=xmlHttp.responseText;
			// alert(temp);
			document.getElementById("errorsDiv_txtname").innerHTML = temp;
			if(temp!=0)
			{
				document.getElementById('txtname').focus();
			}
		}
	}
</script>
<?php include_once $inc_adm_hdr; ?>
<section class="content">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Edit Vehicle Brand</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Edit Vehicle Brand</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<form name="frmedtvehbrndid" id="frmedtvehbrndid" method="post" action="<?php $_SERVER['PHP_SELF'];?>" onSubmit="return performCheck('frmedtvehbrndid', rules, 'inline');" enctype="multipart/form-data">
		<input type="hidden" name="hdnvehbrndid" value="<?php echo $id;?>">
		<input type="hidden" name="hdnpage" value="<?php echo $pg;?>">
		<input type="hidden" name="hdncnt" value="<?php echo $countstart?>">
		<input type="hidden" name="hdnloc" value="<?php echo $loc?>">
		<input type="hidden" name="hdnbrndimg" id="hdnbrndimg" value="<?php echo $rowsvehbrnd_mst['vehbrndm_brndimg'];?>">
		<div class="card">
			<div class="card-body">
				<div class="row justify-content-center align-items-center">
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Vehicle Type *</label>
							</div>
							<div class="col-sm-9">
								<?php
								$sqryveh_type_mst = "SELECT vehtypm_id, vehtypm_name from veh_type_mst order by vehtypm_name";
								$rsveh_type_mst = mysqli_query($conn,$sqryveh_type_mst);
								$cnt_veh_typ = mysqli_num_rows($rsveh_type_mst);
								?>
								<select name="lstvehtyp" id="lstvehtyp" onBlur="funcChkDupName()" class="form-control">
									<option value="">--Select--</option>
									<?php
									if($cnt_veh_typ > 0)
									{
										while($rowsveh_type_mst = mysqli_fetch_assoc($rsveh_type_mst))
										{
											$vehtypid = $rowsveh_type_mst['vehtypm_id'];
											$vehtypname = $rowsveh_type_mst['vehtypm_name'];
											?>
											<option value="<?php echo $vehtypid; ?>" <?php if($rowsvehbrnd_mst['vehbrndm_vehtypm_id'] == $vehtypid) echo 'selected';  ?>><?php echo $vehtypname;?></option>
											<?php
										}
									}
									?>
								</select>
								<span id="errorsDiv_lstvehtyp"></span>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Name *</label>
							</div>
							<div class="col-sm-9">
								<input name="txtname" type="text" id="txtname" size="45" maxlength="40" onBlur="funcChkDupName()" class="form-control" value="<?php echo $rowsvehbrnd_mst['vehbrndm_name']; ?>">
								<span id="errorsDiv_txtname"></span>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Description</label>
							</div>
							<div class="col-sm-9"> 
								<textarea name="txtdesc" cols="60" rows="3" id="txtdesc" class="form-control"><?php echo $rowsvehbrnd_mst['vehbrndm_desc']; ?></textarea>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Brand Image</label>
							</div>
							<div class="col-sm-9">
								<div class="custom-file">
									<input name="flebrndimg" type="file" class="form-control" id="flebrndimg">
								</div>
								<?php
								$brndimgnm = $rowsvehbrnd_mst['vehbrndm_brndimg'];
								$brndimgpath  = $gvehbrndimg_upldpth.$brndimgnm;
								if(($brndimgnm !="") && file_exists($brndimgpath))
								{
									echo "<img src='$brndimgpath' width='50pixel' height='50pixel'>";
								}
								else
								{
									echo "Image not available";
								}
								?>	
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>SEO Title</label>
							</div>
							<div class="col-sm-9"> 
								<input type="text" name="txtseotitle" id="txtseotitle" size="45" maxlength="250" class="form-control" value="<?php echo $rowsvehbrnd_mst['vehbrndm_seotitle']; ?>">
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>SEO Description</label>
							</div>
							<div class="col-sm-9">
								<textarea name="txtseodesc" rows="3" cols="60" id="txtseodesc" class="form-control"><?php echo $rowsvehbrnd_mst['vehbrndm_seodesc']; ?></textarea>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>SEO Keyword</label>
							</div>
							<div class="col-sm-9">
								<textarea name="txtkywrd" rows="3" cols="60" id="txtkywrd" class="form-control"><?php echo $rowsvehbrnd_mst['vehbrndm_seokywrd']; ?></textarea>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>SEO H1 Title</label>
							</div>
							<div class="col-sm-9">
								<input type="text" name="txtseoh1tle" id="txtseoh1tle" size="45" maxlength="250" class="form-control" value="<?php echo $rowsvehbrnd_mst['vehbrndm_seohonetitle']; ?>">
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>SEO H1 Description</label>
							</div>
							<div class="col-sm-9">
								<textarea name="txtseoh1desc" rows="3" cols="60" id="txtseoh1desc" class="form-control"><?php echo $rowsvehbrnd_mst['vehbrndm_seohonedesc']; ?></textarea>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>SEO H2 Title</label>
							</div>
							<div class="col-sm-9">
								<input type="text" name="txtseoh2tle" id="txtseoh2tle" size="45" maxlength="250" class="form-control" value="<?php echo $rowsvehbrnd_mst['vehbrndm_seohtwotitle']; ?>">
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>SEO H2 Description</label>
							</div>
							<div class="col-sm-9">
								<textarea name="txtseoh2desc" rows="3" cols="60" id="txtseoh2desc" class="form-control"><?php echo $rowsvehbrnd_mst['vehbrndm_seohtwodesc']; ?></textarea>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Rank *</label>
							</div>
							<div class="col-sm-9"> 
								<input type="text" name="txtprior" id="txtprior" class="form-control" size="4" maxlength="3" value="<?php echo $rowsvehbrnd_mst['vehbrndm_prty']; ?>">
								<span id="errorsDiv_txtprior"></span>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Status</label>
							</div>
							<div class="col-sm-9">
								<select name="lststs" id="lststs" class="form-control">
									<option value="a"<?php if($rowsvehbrnd_mst['vehbrndm_sts']=='a') echo 'selected';?>>Active</option>
									<option value="i"<?php if($rowsvehbrnd_mst['vehbrndm_sts']=='i') echo 'selected';?>>Inactive</option>
								</select>
								
							</div>
						</div>
					</div>
					<p class="text-center">
						<input type="Submit" class="btn btn-primary" name="btnebrndsbmt" id="btnebrndsbmt" value="Submit">
						&nbsp;&nbsp;&nbsp;
						<input type="reset" class="btn btn-primary" name="btnbrndreset" value="Clear" id="btnbrndreset">
						&nbsp;&nbsp;&nbsp;
						<input type="button" name="btnBack" value="Back" class="btn btn-primary" onClick="location.href='<?php echo $rd_crntpgnm ;?>'">
					</p>
				</div>
			</div>
		</div>
 	</form>
</section>
<?php include_once "../includes/inc_adm_footer.php";?>
<script language="javascript" type="text/javascript">
	CKEDITOR.replace('txtdesc');
</script>