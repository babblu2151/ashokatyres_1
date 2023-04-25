<?php
include_once '../includes/inc_config.php'; //Making paging validation
include_once $inc_nocache; //Clearing the cache information
include_once $adm_session; //checking for session
include_once $inc_cnctn; //Making database Connection
include_once $inc_usr_fnctn; //checking for session 
include_once $inc_pgng_fnctns; //Making paging validation
include_once $inc_fldr_pth; //Making paging validation
/**********************************************************
Programm : add_tyr_rmsize.php 
Purpose : For add Tyre Rim Size Details
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
$pagenm = "Tyre Rim Size";
/*****header link********/
global $gmsg; 
if(isset($_POST['btnrmszsbmt']) && (trim($_POST['btnrmszsbmt']) != "") && isset($_POST['lstvehtyp']) && (trim($_POST['lstvehtyp']) != "") && isset($_POST['lsttyrwdth']) && (trim($_POST['lsttyrwdth']) != "") && isset($_POST['lsttyrprfl']) && (trim($_POST['lsttyrprfl']) != "") && isset($_POST['txtname']) && (trim($_POST['txtname']) != "") && isset($_POST['txtprior']) && (trim($_POST['txtprior']) != ""))
{
	include_once "../database/iqry_tyrrmsz_mst.php";
}
$rd_crntpgnm = "view_tyr_rimsize.php";
$clspn_val = "4";
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
  rules[4]='lsttyrprfl:Tyre Profile|required|Select Tyre Profile';
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
		var tyrwdthid = document.getElementById('lsttyrwdth').value;
		var tyrprflid = document.getElementById('lsttyrprfl').value;
		if(vehtypid!="" && tyrwdthid!="" && name != "")
		{
			var url = "chkduplicate.php?vehvrntname="+name+"&vehtypid="+vehtypid+"&tyrwdthid="+tyrwdthid+"&tyrprflid="+tyrprflid;
			xmlHttp = GetXmlHttpObject(stateChanged);
			xmlHttp.open("GET", url , true);
			xmlHttp.send(null);
		}
		else
		{
			document.getElementById('errorsDiv_lstvehtyp').innerHTML = "";
			document.getElementById('errorsDiv_lsttyrwdth').innerHTML = "";
			document.getElementById('errorsDiv_lsttyrprfl').innerHTML = "";
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
  function get_tyr_prfl()
  {
  	// debugger;
  	var vehtypid = $("#lstvehtyp").val();
  	var tyrwdthid = $("#lsttyrwdth").val();
  	// alert(vehtypid+'-'tyrwdthid);
  	$.ajax({
  		type: "POST",
  		url: "../includes/inc_getStsk.php",
  		data:'vehtyp='+vehtypid+'&tyrwdthid='+tyrwdthid,
  		success: function(data){
  			// alert(data);
  			$("#lsttyrprfl").html(data);
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
					<h1 class="m-0 text-dark">Add Tyre Rim Size</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Add Tyre Rim Size</li>
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
			<form name="frmaddtyrrmsz" id="frmaddtyrrmsz" method="post" action="<?php $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data" onSubmit="return performCheck('frmaddtyrrmsz', rules, 'inline');">
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
									<label>Tyre Width *</label>
								</div>
								<div class="col-sm-9">
									<select name="lsttyrwdth" id="lsttyrwdth" onBlur="funcChkDupName()" onchange="get_tyr_prfl();" class="form-control">
										<option value="">--Select Width--</option>
									</select>
									<span id="errorsDiv_lsttyrwdth"></span>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="row mb-2 mt-2">
								<div class="col-sm-3">
									<label>Tyre Profile *</label>
								</div>
								<div class="col-sm-9">
									<select name="lsttyrprfl" id="lsttyrprfl" onBlur="funcChkDupName()" class="form-control">
										<option value="">--Select profile--</option>
									</select>
									<span id="errorsDiv_lsttyrprfl"></span>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="row mb-2 mt-2">
								<div class="col-sm-3">
									<label>Rim Size Name *</label>
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
							<input type="Submit" class="btn btn-primary" name="btnrmszsbmt" id="btnrmszsbmt" value="Submit">
							&nbsp;&nbsp;&nbsp;
							<input type="reset" class="btn btn-primary" name="btntyrrmszreset" value="Clear" id="btntyrrmszreset">
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