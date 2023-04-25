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
Purpose : For Editing Tyre Profile Details
Created By : Bharath
Created On : 30-12-2021
Modified By : 
Modified On : 
Purpose : 
Company : Adroit
************************************************************/ 
/*****header link********/
$pagemncat = "Setup";
$pagecat = "Tyre";
$pagenm = "Tyre profile";
/*****header link********/
global $id,$pg,$countstart;
$rd_vwpgnm = "view_detail_tyr_prfl.php";
$rd_crntpgnm = "view_tyre_profile.php";
$clspn_val = "4";
if(isset($_POST['btnetyrprflsbmt']) && (trim($_POST['btnetyrprflsbmt']) != "") && isset($_POST['lstvehtyp']) && (trim($_POST['lstvehtyp']) != "") && isset($_POST['lsttyrwdth']) && (trim($_POST['lsttyrwdth']) != "") && isset($_POST['txtname']) && (trim($_POST['txtname']) != "") && isset($_POST['txtprior']) && (trim($_POST['txtprior']) != ""))
{
	include_once "../database/uqry_tyrprfl_mst.php";
}
if(isset($_REQUEST['edit']) && (trim($_REQUEST['edit'])!="") && isset($_REQUEST['pg']) && (trim($_REQUEST['pg'])!="") && isset($_REQUEST['countstart']) && (trim($_REQUEST['countstart'])!=""))
{
	$id = glb_func_chkvl($_REQUEST['edit']);
	$pg = glb_func_chkvl($_REQUEST['pg']);
	$countstart = glb_func_chkvl($_REQUEST['countstart']);
}
elseif(isset($_REQUEST['hdntyrprflid']) && (trim($_REQUEST['hdntyrprflid'])!="") && isset($_REQUEST['hdnpage']) && (trim($_REQUEST['hdnpage'])!="") && isset($_REQUEST['hdncnt']) && (trim($_REQUEST['hdncnt'])!=""))
{
	$id = glb_func_chkvl($_REQUEST['hdntyrprflid']);
	$pg = glb_func_chkvl($_REQUEST['hdnpage']);
	$countstart = glb_func_chkvl($_REQUEST['hdncnt']);
}
$sqrytyrprfl_mst = "SELECT tyrprflm_name, tyrprflm_desc, tyrprflm_vehtypm_id, tyrprflm_tyrwdthm_id, tyrprflm_sts, tyrprflm_prty, tyrprflm_seotitle, tyrprflm_seodesc, tyrprflm_seokywrd, tyrprflm_seohonetitle, tyrprflm_seohonedesc, tyrprflm_seohtwotitle, tyrprflm_seohtwodesc, tyrwdthm_name, tyrwdthm_id, vehtypm_id, vehtypm_name
	from tyr_prfl_mst
	inner join veh_type_mst on tyrprflm_vehtypm_id = vehtypm_id
	inner join tyr_wdth_mst on tyrprflm_tyrwdthm_id = tyrwdthm_id
	where tyrprflm_id = $id";
// echo $sqrytyrprfl_mst; exit;
$srstyrprfl_mst = mysqli_query($conn,$sqrytyrprfl_mst);
$cntrec = mysqli_num_rows($srstyrprfl_mst);
if($cntrec > 0)
{
	$rowstyrprfl_mst = mysqli_fetch_assoc($srstyrprfl_mst);
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
  rules[2]='lstvehtyp:Vehicle Type|required|Select Vehicle Type';
  rules[3]='lsttyrwdth:Tyre Width|required|Select Tyre Width';
  rules[4]='txtprior:Priority|required|Enter Rank';
  function setfocus()
  {
  	document.getElementById('txtname').focus();
  }
   function get_tyr_wdth()
  {
  	var vehtypid = $("#lstvehtyp").val();
  	$.ajax({
  		type: "POST",
  		url: "../includes/inc_getStsk.php",
  		data:'vehtypid1='+vehtypid,
  		success: function(data){
  			// alert(data)
  			$("#lsttyrwdth").html(data);
  		}
  	});
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
		var tyrwdthid = document.getElementById('lsttyrwdth').value;
		id = <?php echo $id;?>; 
		if(vehtypid!="" && tyrwdthid!="" && name != "")
		{
			var url = "chkduplicate.php?tyrprflname="+name+"&vehtypid="+vehtypid+"&tyrwdthid="+tyrwdthid+"&tyrpfrlid="+id;
			xmlHttp = GetXmlHttpObject(stateChanged);
			xmlHttp.open("GET", url , true);
			xmlHttp.send(null);
		}
		else
		{
			document.getElementById('errorsDiv_lstvehtyp').innerHTML = "";
			document.getElementById('errorsDiv_lsttyrwdth').innerHTML = "";
			document.getElementById('errorsDiv_txtname').innerHTML = "";
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
					<h1 class="m-0 text-dark">Edit Tyre Profile</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Edit Tyre Profile</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<form name="frmedttyrprflid" id="frmedttyrprflid" method="post" action="<?php $_SERVER['PHP_SELF'];?>" onSubmit="return performCheck('frmedttyrprflid', rules, 'inline');" enctype="multipart/form-data">
		<input type="hidden" name="hdntyrprflid" value="<?php echo $id;?>">
		<input type="hidden" name="hdnpage" value="<?php echo $pg;?>">
		<input type="hidden" name="hdncnt" value="<?php echo $countstart?>">
		<input type="hidden" name="hdnloc" value="<?php echo $loc?>">
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
								<select name="lstvehtyp" id="lstvehtyp" onBlur="funcChkDupName();" onchange="get_tyr_wdth();" class="form-control">
									<option value="">--Select--</option>
									<?php
									if($cnt_veh_typ > 0)
									{
										while($rowsveh_type_mst = mysqli_fetch_assoc($rsveh_type_mst))
										{
											$vehtypid = $rowsveh_type_mst['vehtypm_id'];
											$vehtypname = $rowsveh_type_mst['vehtypm_name'];
											?>
											<option value="<?php echo $vehtypid;?>"<?php if($rowstyrprfl_mst['tyrprflm_vehtypm_id'] == $vehtypid) echo 'selected';  ?>><?php echo $vehtypname;?></option>
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
								<label>Tyre Width *</label>
							</div>
							<div class="col-sm-9">
								<select name="lsttyrwdth" id="lsttyrwdth" onBlur="funcChkDupName()" class="form-control">
									<option value="<?php echo $rowstyrprfl_mst['tyrprflm_tyrwdthm_id']; ?>"><?php echo $rowstyrprfl_mst['tyrwdthm_name']; ?></option>
								</select>
								<span id="errorsDiv_lsttyrwdth"></span>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Profile Name *</label>
							</div>
							<div class="col-sm-9">
								<input name="txtname" type="text" id="txtname" size="45" maxlength="40" onBlur="funcChkDupName()" class="form-control" value="<?php echo $rowstyrprfl_mst['tyrprflm_name']; ?>">
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
								<textarea name="txtdesc" cols="60" rows="3" id="txtdesc" class="form-control"><?php echo $rowstyrprfl_mst['tyrprflm_desc']; ?></textarea>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>SEO Title</label>
							</div>
							<div class="col-sm-9"> 
								<input type="text" name="txtseotitle" id="txtseotitle" size="45" maxlength="250" class="form-control" value="<?php echo $rowstyrprfl_mst['tyrprflm_seotitle']; ?>">
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>SEO Description</label>
							</div>
							<div class="col-sm-9">
								<textarea name="txtseodesc" rows="3" cols="60" id="txtseodesc" class="form-control"><?php echo $rowstyrprfl_mst['tyrprflm_seodesc']; ?></textarea>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>SEO Keyword</label>
							</div>
							<div class="col-sm-9">
								<textarea name="txtkywrd" rows="3" cols="60" id="txtkywrd" class="form-control"><?php echo $rowstyrprfl_mst['tyrprflm_seokywrd']; ?></textarea>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>SEO H1 Title</label>
							</div>
							<div class="col-sm-9">
								<input type="text" name="txtseoh1tle" id="txtseoh1tle" size="45" maxlength="250" class="form-control" value="<?php echo $rowstyrprfl_mst['tyrprflm_seohonetitle']; ?>">
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>SEO H1 Description</label>
							</div>
							<div class="col-sm-9">
								<textarea name="txtseoh1desc" rows="3" cols="60" id="txtseoh1desc" class="form-control"><?php echo $rowstyrprfl_mst['tyrprflm_seohonedesc']; ?></textarea>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>SEO H2 Title</label>
							</div>
							<div class="col-sm-9">
								<input type="text" name="txtseoh2tle" id="txtseoh2tle" size="45" maxlength="250" class="form-control" value="<?php echo $rowstyrprfl_mst['tyrprflm_seohtwotitle']; ?>">
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>SEO H2 Description</label>
							</div>
							<div class="col-sm-9">
								<textarea name="txtseoh2desc" rows="3" cols="60" id="txtseoh2desc" class="form-control"><?php echo $rowstyrprfl_mst['tyrprflm_seohtwodesc']; ?></textarea>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Rank *</label>
							</div>
							<div class="col-sm-9"> 
								<input type="text" name="txtprior" id="txtprior" class="form-control" size="4" maxlength="3" value="<?php echo $rowstyrprfl_mst['tyrprflm_prty']; ?>">
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
									<option value="a"<?php if($rowsvehbrnd_mst['tyrprflm_sts']=='a') echo 'selected';?>>Active</option>
									<option value="i"<?php if($rowsvehbrnd_mst['tyrprflm_sts']=='i') echo 'selected';?>>Inactive</option>
								</select>
							</div>
						</div>
					</div>
					<p class="text-center">
						<input type="Submit" class="btn btn-primary" name="btnetyrprflsbmt" id="btnetyrprflsbmt" value="Submit">
						&nbsp;&nbsp;&nbsp;
						<input type="reset" class="btn btn-primary" name="btntyrprflreset" value="Clear" id="btntyrprflreset">
						&nbsp;&nbsp;&nbsp;
						<input type="button" name="btnBack" value="Back" class="btn btn-primary" onClick="location.href='<?php echo $rd_crntpgnm; ?>'">
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