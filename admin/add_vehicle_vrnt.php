<?php
include_once '../includes/inc_config.php'; //Making paging validation
include_once $inc_nocache; //Clearing the cache information
include_once $adm_session; //checking for session
include_once $inc_cnctn; //Making database Connection
include_once $inc_usr_fnctn; //checking for session 
include_once $inc_pgng_fnctns; //Making paging validation
include_once $inc_fldr_pth; //Making paging validation
/**********************************************************
Programm : add_vehicle_vrnt.php 
Purpose : For add Vehicle Variant Details
Created By : Bharath
Created On : 28-12-2021
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
global $gmsg; 
if(isset($_POST['btnvrntsbmt']) && (trim($_POST['btnvrntsbmt']) != "") && isset($_POST['lstvehtyp']) && (trim($_POST['lstvehtyp']) != "") && isset($_POST['lstvehbrnd']) && (trim($_POST['lstvehbrnd']) != "") && isset($_POST['lstvehmdl']) && (trim($_POST['lstvehmdl']) != "") && isset($_POST['txtname']) && (trim($_POST['txtname']) != "") && isset($_POST['txtprior']) && (trim($_POST['txtprior']) != ""))
{
	include_once "../database/iqry_vehvrnt_mst.php";
}
$rd_crntpgnm = "view_veh_vrnt.php";
$clspn_val = "4";
?>
<script language="javaScript" type="text/javascript" src="js/ckeditor.js"></script>
<script language="javascript" src="../includes/yav.js"></script>
<script language="javascript" src="../includes/yav-config.js"></script>	
<link rel="stylesheet" type="text/css" href="../includes/yav-style1.css">
<script language="javascript" type="text/javascript">
 	var rules=new Array();
 	rules[0]='txtname:Name|required|Enter Name';
  // rules[1]='txtname:Name|alphaspace|Name only characters and numbers';
  rules[2]='lstvehtyp:Vehicle Type|required|Select Vehicle Type';
  rules[3]='lstvehbrnd:Vehicle Brand|required|Select Vehicle Brand';
  rules[4]='lstvehmdl:Vehicle Model|required|Select Vehicle Model';
  rules[5]='txtprior:Priority|required|Enter Rank';
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
		var vehbrndid = document.getElementById('lstvehbrnd').value;  
		var vehmdlid = document.getElementById('lstvehmdl').value;  
		if(vehtypid!="" && vehbrndid!="" && name != "")
		{
			var url = "chkduplicate.php?vehvrntname="+name+"&vehtypid="+vehtypid+"&vehbrndid="+vehbrndid+"&vehmdlid="+vehmdlid;
			xmlHttp = GetXmlHttpObject(stateChanged);
			xmlHttp.open("GET", url , true);
			xmlHttp.send(null);
		}
		else
		{
			document.getElementById('errorsDiv_lstvehtyp').innerHTML = "";
			document.getElementById('errorsDiv_lstvehbrnd').innerHTML = "";
			document.getElementById('errorsDiv_lstvehmdl').innerHTML = "";
			document.getElementById('errorsDiv_txtname').innerHTML = "";
  	}
  }
  function stateChanged()
  {
  	if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete")
  	{
  		var temp = xmlHttp.responseText;
  		document.getElementById("errorsDiv_txtname").innerHTML = temp;
  		if(temp!=0)
  		{
  			document.getElementById('txtname').focus();
  		}
  	}
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
<?php include_once $inc_adm_hdr; ?>
<section class="content">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Add Vehicle Variant</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Add Vehicle Variant</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- Default box -->
	<div class="card">
		<?php
		if($gmsg != "")
		{
			echo "<center><div class='col-12'>
			<font face='Arial' size='2' color = 'red'>$gmsg</font>
			</div></center>";
		}
		if(isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == "y"))
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
			<form name="frmaddvehvrnt" id="frmaddvehvrnt" method="post" action="<?php $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data" onSubmit="return performCheck('frmaddvehvrnt', rules, 'inline');">
				<div class="col-md-12">
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
												<option value="<?php echo $vehtypid;?>"><?php echo $vehtypname;?></option>
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
										<option value="">--Select brand--</option>
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
										<option value="">--Select model--</option>
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
									<input name="txtname" type="text" id="txtname" size="45" maxlength="40" onBlur="funcChkDupName()" class="form-control">
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
									<textarea name="txtdesc" cols="60" rows="3" id="txtdesc" class="form-control"></textarea>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="row mb-2 mt-2">
								<div class="col-sm-3">
									<label>SEO Title</label>
								</div>
								<div class="col-sm-9"> 
									<input type="text" name="txtseotitle" id="txtseotitle" size="45" maxlength="250" class="form-control">
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="row mb-2 mt-2">
								<div class="col-sm-3">
									<label>SEO Description</label>
								</div>
								<div class="col-sm-9">
									<textarea name="txtseodesc" rows="3" cols="60" id="txtseodesc" class="form-control"></textarea>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="row mb-2 mt-2">
								<div class="col-sm-3">
									<label>SEO Keyword</label>
								</div>
								<div class="col-sm-9">
									<textarea name="txtkywrd" rows="3" cols="60" id="txtkywrd" class="form-control"></textarea>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="row mb-2 mt-2">
								<div class="col-sm-3">
									<label>SEO H1 Title</label>
								</div>
								<div class="col-sm-9">
									<input type="text" name="txtseoh1tle" id="txtseoh1tle" size="45" maxlength="250" class="form-control">
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="row mb-2 mt-2">
								<div class="col-sm-3">
									<label>SEO H1 Description</label>
								</div>
								<div class="col-sm-9">
									<textarea name="txtseoh1desc" rows="3" cols="60" id="txtseoh1desc" class="form-control"></textarea>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="row mb-2 mt-2">
								<div class="col-sm-3">
									<label>SEO H2 Title</label>
								</div>
								<div class="col-sm-9">
									<input type="text" name="txtseoh2tle" id="txtseoh2tle" size="45" maxlength="250" class="form-control">
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="row mb-2 mt-2">
								<div class="col-sm-3">
									<label>SEO H2 Description</label>
								</div>
								<div class="col-sm-9">
									<textarea name="txtseoh2desc" rows="3" cols="60" id="txtseoh2desc" class="form-control"></textarea>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="row mb-2 mt-2">
								<div class="col-sm-3">
									<label>Rank *</label>
								</div>
								<div class="col-sm-9"> 
									<input type="text" name="txtprior" id="txtprior" class="form-control" size="4" maxlength="3">
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
										<option value="a" selected>Active</option>
										<option value="i">Inactive</option>
									</select>
									
								</div>
							</div>
						</div>
						<p class="text-center">
							<input type="Submit" class="btn btn-primary" name="btnvrntsbmt" id="btnvrntsbmt" value="Submit">
							&nbsp;&nbsp;&nbsp;
							<input type="reset" class="btn btn-primary" name="btnbrndreset" value="Clear" id="btnbrndreset">
							&nbsp;&nbsp;&nbsp;
							<input type="button" name="btnBack" value="Back" class="btn btn-primary" onClick="location.href='<?php echo $rd_crntpgnm; ?>'">
						</p>
					</div>
				</div>
			</form>
		</div>
		<!-- /.card-body -->
	</div>
	<!-- /.card -->
</section>
<?php include_once "../includes/inc_adm_footer.php";?>
<script language="javascript" type="text/javascript">
	CKEDITOR.replace('txtdesc');
</script>