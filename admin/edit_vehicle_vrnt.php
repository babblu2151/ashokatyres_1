<?php
include_once '../includes/inc_config.php'; //Making paging validation
include_once $inc_nocache; //Clearing the cache information
include_once $adm_session; //checking for session
include_once $inc_cnctn; //Making database Connection
include_once $inc_usr_fnctn; //checking for session	
include_once $inc_pgng_fnctns; //Making paging validation
include_once $inc_fldr_pth; //Making paging validation
/**********************************************************
Programm : edit_vehicle_vrnt.php 
Purpose : For Editing Vehicle Variant Details
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
$pagenm = "Vehicle Variant";
/*****header link********/
global $id,$pg,$countstart;
$rd_vwpgnm = "view_detail_veh_vrnt.php";
$rd_crntpgnm = "view_veh_vrnt.php";
$clspn_val = "4";
if(isset($_POST['btnevrntsbmt']) && (trim($_POST['btnevrntsbmt']) != "") && isset($_POST['lstvehtyp']) && (trim($_POST['lstvehtyp']) != "") && isset($_POST['lstvehbrnd']) && (trim($_POST['lstvehbrnd']) != "") && isset($_POST['lstvehmdl']) && (trim($_POST['lstvehmdl']) != "") && isset($_POST['txtname']) && (trim($_POST['txtname']) != "") && isset($_POST['txtprior']) && (trim($_POST['txtprior']) != ""))
{
	include_once "../database/uqry_vehvrnt_mst.php";
}
if(isset($_REQUEST['edit']) && (trim($_REQUEST['edit'])!="") && isset($_REQUEST['pg']) && (trim($_REQUEST['pg'])!="") && isset($_REQUEST['countstart']) && (trim($_REQUEST['countstart'])!=""))
{
	$id = glb_func_chkvl($_REQUEST['edit']);
	$pg = glb_func_chkvl($_REQUEST['pg']);
	$countstart = glb_func_chkvl($_REQUEST['countstart']);
}
elseif(isset($_REQUEST['hdnvehvrntid']) && (trim($_REQUEST['hdnvehvrntid'])!="") && isset($_REQUEST['hdnpage']) && (trim($_REQUEST['hdnpage'])!="") && isset($_REQUEST['hdncnt']) && (trim($_REQUEST['hdncnt'])!=""))
{
	$id = glb_func_chkvl($_REQUEST['hdnvehvrntid']);
	$pg = glb_func_chkvl($_REQUEST['hdnpage']);
	$countstart = glb_func_chkvl($_REQUEST['hdncnt']);
}
$sqryvehvrnt_mst = "SELECT vehvrntm_name, vehvrntm_desc, vehvrntm_vehtypm_id, vehvrntm_vehbrndm_id, vehvrntm_vehmdlm_id, vehvrntm_sts, vehvrntm_prty, vehvrntm_seotitle, vehvrntm_seodesc, vehvrntm_seokywrd, vehvrntm_seohonetitle, vehvrntm_seohonedesc, vehvrntm_seohtwotitle, vehvrntm_seohtwodesc, vehbrndm_name, vehbrndm_id, vehmodlm_id, vehmodlm_name
	from veh_vrnt_mst
	inner join veh_type_mst on vehvrntm_vehtypm_id = vehtypm_id
	inner join veh_brnd_mst on vehvrntm_vehbrndm_id = vehbrndm_id
	inner join veh_model_mst on vehvrntm_vehmdlm_id = vehmodlm_id
	where vehvrntm_id = $id";
// echo $sqryvehvrnt_mst; exit;
$srsvehvrnt_mst = mysqli_query($conn,$sqryvehvrnt_mst);
$cntrec = mysqli_num_rows($srsvehvrnt_mst);
if($cntrec > 0)
{
	$rowsvehvrnt_mst = mysqli_fetch_assoc($srsvehvrnt_mst);
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
  rules[3]='lstvehbrnd:Vehicle Brand|required|Select Vehicle Brand';
  rules[4]='lstvehmdl:Vehicle Model|required|Select Vehicle Model';
  rules[5]='txtprior:Priority|required|Enter Rank';
  function setfocus()
  {
  	document.getElementById('txtname').focus();
  }
  function get_brnd()
  {
  	var vehtypid = $("#lstvehtyp").val();
  	$.ajax({
  		type: "POST",
  		url: "../includes/inc_getStsk.php",
  		data:'vehtypval='+vehtypid,
  		success: function(data){
  			// alert(data)
  			$("#lstvehbrnd").html(data);
  		}
  	});
  }
  function get_mdl()
  {
  	// debugger;
  	var vehtypid = $("#lstvehtyp").val();
  	var vehbrndid = $("#lstvehbrnd").val();
  	// alert(vehtypid+'-'vehbrndid);
  	$.ajax({
  		type: "POST",
  		url: "../includes/inc_getStsk.php",
  		data:'vehtypid='+vehtypid+'&vehbrndid='+vehbrndid,
  		success: function(data){
  			// alert(data);
  			$("#lstvehmdl").html(data);
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
		var vehbrndid = document.getElementById('lstvehbrnd').value;  
		var vehmdlid = document.getElementById('lstvehmdl').value;
		id = <?php echo $id;?>; 
		if(vehtypid!="" && vehbrndid!="" && name != "" && vehmdlid != "")
		{
			var url = "chkduplicate.php?vehvrntname="+name+"&vehtypid="+vehtypid+"&vehbrndid="+vehbrndid+"&vehmdlid="+vehmdlid+"&vrntid="+id;
			xmlHttp = GetXmlHttpObject(stateChanged);
			xmlHttp.open("GET", url , true);
			xmlHttp.send(null);
		}
		else
		{
			document.getElementById('errorsDiv_lstvehtyp').innerHTML = "";
			document.getElementById('errorsDiv_lstvehbrnd').innerHTML = "";
			document.getElementById('errorsDiv_lstvehmdl').innerHTML = "";
			document.getElementById('errorsDiv_lstvehvrnt').innerHTML = "";
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
					<h1 class="m-0 text-dark">Edit Vehicle Variant</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Edit Vehicle Variant</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<form name="frmedtvehvrntid" id="frmedtvehvrntid" method="post" action="<?php $_SERVER['PHP_SELF'];?>" onSubmit="return performCheck('frmedtvehvrntid', rules, 'inline');" enctype="multipart/form-data">
		<input type="hidden" name="hdnvehvrntid" value="<?php echo $id;?>">
		<input type="hidden" name="hdnpage" value="<?php echo $pg;?>">
		<input type="hidden" name="hdncnt" value="<?php echo $countstart?>">
		<input type="hidden" name="hdnloc" value="<?php echo $loc?>">
		<input type="hidden" name="hdnbrndimg" id="hdnbrndimg" value="<?php echo $rowsvehvrnt_mst['vehvrntm_brndimg'];?>">
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
								<select name="lstvehtyp" id="lstvehtyp" onBlur="funcChkDupName();" onchange="get_brnd();" class="form-control">
									<option value="">--Select--</option>
									<?php
									if($cnt_veh_typ > 0)
									{
										while($rowsveh_type_mst = mysqli_fetch_assoc($rsveh_type_mst))
										{
											$vehtypid = $rowsveh_type_mst['vehtypm_id'];
											$vehtypname = $rowsveh_type_mst['vehtypm_name'];
											?>
											<option value="<?php echo $vehtypid;?>"<?php if($rowsvehvrnt_mst['vehvrntm_vehtypm_id'] == $vehtypid) echo 'selected';  ?>><?php echo $vehtypname;?></option>
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
								<label>Vehicle Brand *</label>
							</div>
							<div class="col-sm-9">
								<select name="lstvehbrnd" id="lstvehbrnd" onBlur="funcChkDupName()" onchange="get_mdl();" class="form-control">
									<option value="<?php echo $rowsvehvrnt_mst['vehvrntm_vehbrndm_id']; ?>"><?php echo $rowsvehvrnt_mst['vehbrndm_name']; ?></option>
								</select>
								<span id="errorsDiv_lstvehbrnd"></span>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Vehicle Model *</label>
							</div>
							<div class="col-sm-9">
								<select name="lstvehmdl" id="lstvehmdl" onBlur="funcChkDupName()" class="form-control">
									<option value="<?php echo $rowsvehvrnt_mst['vehvrntm_vehmdlm_id']; ?>"><?php echo $rowsvehvrnt_mst['vehmodlm_name']; ?></option>
								</select>
								<span id="errorsDiv_lstvehmdl"></span>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Variant Name *</label>
							</div>
							<div class="col-sm-9">
								<input name="txtname" type="text" id="txtname" size="45" maxlength="40" onBlur="funcChkDupName()" class="form-control" value="<?php echo $rowsvehvrnt_mst['vehvrntm_name']; ?>">
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
								<textarea name="txtdesc" cols="60" rows="3" id="txtdesc" class="form-control"><?php echo $rowsvehvrnt_mst['vehvrntm_desc']; ?></textarea>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>SEO Title</label>
							</div>
							<div class="col-sm-9"> 
								<input type="text" name="txtseotitle" id="txtseotitle" size="45" maxlength="250" class="form-control" value="<?php echo $rowsvehvrnt_mst['vehvrntm_seotitle']; ?>">
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>SEO Description</label>
							</div>
							<div class="col-sm-9">
								<textarea name="txtseodesc" rows="3" cols="60" id="txtseodesc" class="form-control"><?php echo $rowsvehvrnt_mst['vehvrntm_seodesc']; ?></textarea>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>SEO Keyword</label>
							</div>
							<div class="col-sm-9">
								<textarea name="txtkywrd" rows="3" cols="60" id="txtkywrd" class="form-control"><?php echo $rowsvehvrnt_mst['vehvrntm_seokywrd']; ?></textarea>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>SEO H1 Title</label>
							</div>
							<div class="col-sm-9">
								<input type="text" name="txtseoh1tle" id="txtseoh1tle" size="45" maxlength="250" class="form-control" value="<?php echo $rowsvehvrnt_mst['vehvrntm_seohonetitle']; ?>">
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>SEO H1 Description</label>
							</div>
							<div class="col-sm-9">
								<textarea name="txtseoh1desc" rows="3" cols="60" id="txtseoh1desc" class="form-control"><?php echo $rowsvehvrnt_mst['vehvrntm_seohonedesc']; ?></textarea>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>SEO H2 Title</label>
							</div>
							<div class="col-sm-9">
								<input type="text" name="txtseoh2tle" id="txtseoh2tle" size="45" maxlength="250" class="form-control" value="<?php echo $rowsvehvrnt_mst['vehvrntm_seohtwotitle']; ?>">
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>SEO H2 Description</label>
							</div>
							<div class="col-sm-9">
								<textarea name="txtseoh2desc" rows="3" cols="60" id="txtseoh2desc" class="form-control"><?php echo $rowsvehvrnt_mst['vehvrntm_seohtwodesc']; ?></textarea>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Rank *</label>
							</div>
							<div class="col-sm-9"> 
								<input type="text" name="txtprior" id="txtprior" class="form-control" size="4" maxlength="3" value="<?php echo $rowsvehvrnt_mst['vehvrntm_prty']; ?>">
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
									<option value="a"<?php if($rowsvehbrnd_mst['vehvrntm_sts']=='a') echo 'selected';?>>Active</option>
									<option value="i"<?php if($rowsvehbrnd_mst['vehvrntm_sts']=='i') echo 'selected';?>>Inactive</option>
								</select>
							</div>
						</div>
					</div>
					<p class="text-center">
						<input type="Submit" class="btn btn-primary" name="btnevrntsbmt" id="btnevrntsbmt" value="Submit">
						&nbsp;&nbsp;&nbsp;
						<input type="reset" class="btn btn-primary" name="btndmlreset" value="Clear" id="btndmlreset">
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