<?php
include_once '../includes/inc_config.php'; //Making paging validation
include_once $inc_nocache; //Clearing the cache information
include_once $adm_session; //checking for session
include_once $inc_cnctn; //Making database Connection
include_once $inc_usr_fnctn; //checking for session	
include_once $inc_pgng_fnctns; //Making paging validation
include_once $inc_fldr_pth; //Making paging validation
/**********************************************************
Programm : edit_products.php 
Purpose : For Editing product Details
Created By : Bharath
Created On : 04-01-2022
Modified By : 
Modified On : 
Purpose : 
Company : Adroit
************************************************************/ 
/*****header link********/
$pagemncat = "Products";
$pagecat = "Products";
$pagenm = "View Products";
/*****header link********/
global $id,$pg,$countstart;
$rd_vwpgnm = "view_detail_prod.php";
$rd_crntpgnm = "view_all_products.php";
$clspn_val = "4";
if(isset($_POST['btneprod']) && ($_POST['btneprod'] != "") && isset($_POST['txtsku']) && ($_POST['txtsku'] != "") && isset($_POST['txtcde']) && ($_POST['txtcde']!= "") && isset($_POST['txtname']) && ($_POST['txtname'] != "") && isset($_POST['txtcstprc']) && ($_POST['txtcstprc'] != "") && isset($_POST['txtsleprc']) && ($_POST['txtsleprc'] != "") && isset($_POST['txtprior']) && ($_POST['txtprior'] != ""))
{
	include_once "../includes/inc_fnct_fleupld.php"; // For uploading files
	include_once "../database/uqry_prod_mst.php";
}
if(isset($_REQUEST['edit']) && (trim($_REQUEST['edit'])!="") && isset($_REQUEST['pg']) && (trim($_REQUEST['pg'])!="") && isset($_REQUEST['countstart']) && (trim($_REQUEST['countstart'])!=""))
{
	$id = glb_func_chkvl($_REQUEST['edit']);
	$pg = glb_func_chkvl($_REQUEST['pg']);
	$countstart = glb_func_chkvl($_REQUEST['countstart']);
}
elseif(isset($_REQUEST['hdnprodid']) && (trim($_REQUEST['hdnprodid'])!="") && isset($_REQUEST['hdnpage']) && (trim($_REQUEST['hdnpage'])!="") && isset($_REQUEST['hdncnt']) && (trim($_REQUEST['hdncnt'])!=""))
{
	$id = glb_func_chkvl($_REQUEST['hdnprodid']);
	$pg = glb_func_chkvl($_REQUEST['hdnpage']);
	$countstart = glb_func_chkvl($_REQUEST['hdncnt']);
}
$sqryprod_mst = "SELECT prodm_id, prodm_sku, prodm_code, prodm_name, prodm_tyr_brnd, prodm_tyrwdth, prodm_tyrprfl, prodm_tyrrmsz, prodm_tyrtyp, prodm_tub_dtl, prodm_size, prodm_ptrn, prodm_cstprc, prodm_sleprc, prodm_ofrprc, prodm_dsc, prodm_sdsc, prodm_st, prodm_sky, prodm_sotl, prodm_sodsc, prodm_sttle, prodm_stdsc, prodm_sts, prodm_rnk, tyrbrndm_id, tyrbrndm_name, tyrtypm_name, vehtypm_id, vehtypm_name, tyrwdthm_id, tyrwdthm_name, tyrprflm_id, tyrprflm_name, tyrrmszm_id, tyrrmszm_name
	from prod_mst
	left join tyr_brnd_mst on tyr_brnd_mst.tyrbrndm_id = prod_mst.prodm_tyr_brnd
	left join tyr_type_mst on tyr_type_mst.tyrtypm_id = prod_mst.prodm_tyrtyp
	left join veh_type_mst on veh_type_mst.vehtypm_id = prod_mst.prodm_vehtyp
	left join tyr_wdth_mst on tyr_wdth_mst.tyrwdthm_id = prod_mst.prodm_tyrwdth
	left join tyr_prfl_mst on tyr_prfl_mst.tyrprflm_id = prod_mst.prodm_tyrprfl
	left join tyr_rimsize_mst on tyr_rimsize_mst.tyrrmszm_id = prod_mst.prodm_tyrrmsz
	where prodm_id = $id";
// echo $sqryprod_mst; exit;
$srsprod_mst = mysqli_query($conn,$sqryprod_mst);
$cntrec = mysqli_num_rows($srsprod_mst);
if($cntrec > 0)
{
	$rowsprod_mst = mysqli_fetch_assoc($srsprod_mst);
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
	rules[0]='txtsku:SKU|required|Enter SKU / Bar Code';
	rules[1]='txtcde:Code|required|Enter Product Code';
	rules[2]='txtname:Name|required|Enter Name';
	rules[3]='lsttyrbrnd:Brand|required|Select Tyre Brand';
	/*rules[4]='lstvehtyp:Type|required|Select Vehicle Type';
	rules[5]='brndchk:Brand|required|Select Vehicle Brand';
	rules[6]='modlchk:Model|required|Select Vehicle Model';
	rules[7]='vrntchk:Variant|required|Select Product';
	rules[8]='tyrwdth:Width|required|Select Tyre Width';
	rules[9]='tyrprfl:Profile|required|Select Tyre Profile';
	rules[10]='tyrrmsz:Rim Size|required|Select Tyre Rim Size';*/
	rules[11]='txtsize:Size|required|Enter Size';
	rules[12]='txtptrn:Pattern|required|Enter Pattern';
	rules[13]='txtcstprc:Cost Price|required|Enter Cost Price';
	rules[14]='txtcstprc:Cost Price|double|Enter Numeric Values';
	rules[15]='txtsleprc:Sale Price|required|Enter Sale Price';
	rules[16]='txtsleprc:Sale Price|double|Enter Numeric Values';
	rules[17]='txtprior:Priority|required|Enter Rank';
	rules[18]='txtprior:Priority|numeric|Enter Only Numbers';
  function setfocus()
  {
  	document.getElementById('txtsku').focus();
  }
</script>
<?php 
include_once ('script.php');
include_once ('../includes/inc_fnct_ajax_validation.php');	
?>
<script language="javascript" type="text/javascript">
	function funcChkDupSku()
	{
		var sku;
		sku = document.getElementById('txtsku').value;
		id = <?php echo $id;?>;
		if(sku != "")
		{
			var url = "chkduplicate.php?prodsku="+sku+"&prodid="+id;
			xmlHttp	= GetXmlHttpObject(stateChangedsku);
			xmlHttp.open("GET", url , true);
			xmlHttp.send(null);
		}
		else
		{
			document.getElementById('errorsDiv_txtsku').value = "";
		}	
	}
	function stateChangedsku()
	{
		if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
		{
			var temp=xmlHttp.responseText;
			document.getElementById("errorsDiv_txtsku").innerHTML = temp;
			// alert(temp);
			if(temp!= '')
			{
				//	document.getElementById('txtcode').focus();
			}
		}
	}
	function funcChkDupCode()
	{
		var code;
		code = document.getElementById('txtcde').value;
		id = <?php echo $id;?>;
		if(code != "")
		{
			var url = "chkduplicate.php?prodcode="+code+"&prodid="+id;
			xmlHttp	= GetXmlHttpObject(stateChanged);
			xmlHttp.open("GET", url , true);
			xmlHttp.send(null);
		}
		else
		{
			document.getElementById('errorsDiv_txtcde').value = "";
		}	
	}
	function stateChanged()
	{
		if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
		{
			var temp=xmlHttp.responseText;
			document.getElementById("errorsDiv_txtcde").innerHTML = temp;
			// alert(temp);
			if(temp!= '')
			{
				//	document.getElementById('txtcode').focus();
			}
		}
	}
	function get_tyr_wdth()
  {
  	$("#lsttyrwdth").val("");
  	$("#lsttyrprfl").val("");
  	$("#lsttyrrmsz").val("");
  	$("#slctdvrnts").val("");
  	$("#slctvrnts").html("");
  	$("#slctvrnts").html("<label>Selected Variants:</label><br><div class='row d-flex flex-row justify-content-center text-center'><div class='col-md-3'><b>Brand</b></div><div class='col-md-3'><b>Model</b></div><div class='col-md-3'><b>Variant</b></div><div class='col-md-3'><b>Remove</b></div></div>");
  	$("#slctvrnts").hide();
  	$("#lstvrnts").html("");
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
  function get_tyr_rmsz()
  {
  	var vehtypid = $("#lstvehtyp").val();
  	var tyrwdthid = $("#lsttyrwdth").val();
  	var tyrprflid = $("#lsttyrprfl").val();
  	// alert(vehtypid+'-'tyrwdthid);
  	$.ajax({
  		type: "POST",
  		url: "../includes/inc_getStsk.php",
  		data:'vehtyp1='+vehtypid+'&tyrwdthid1='+tyrwdthid+'&tyrprflid1='+tyrprflid,
  		success: function(data){
  			// alert(data);
  			$("#lsttyrrmsz").html(data);
  		}
  	});
  }
  function get_veh_brnds()
  {
  	var vehtypid = $("#lstvehtyp").val();
  	$.ajax({
  		type: "POST",
  		url: "../includes/inc_getStsk.php",
  		data:'veh_typ='+vehtypid,
  		success: function(data){
  			// alert(data)
  			$("#lstvrnts").html(data);
  		}
  	});
  }
  function get_veh_diff_vrnt()
  {
  	var vehtypid = $("#lstvehtyp").val();
  	var vehbrndid = $("#lstvehbrnd").val();
  	var vehmdlid = $("#lstvehmdl").val();
  	var vehvrntid = $("#lstvehvrnt").val();
  	$.ajax({
  		type: "POST",
  		url: "../includes/inc_getStsk.php",
  		data:'veh_typ_vrnts='+vehtypid+'&veh_brnd='+vehbrndid+'&veh_mdl='+vehmdlid+'&veh_vrnt='+vehvrntid,
  		success: function(data){
  			// alert(data)
  			$("#lstvrnts").html(data);
  		}
  	});
  }
  function add_vrnts()
  {
  	var slctdvrnts = $("#slctdvrnts").val();
  	var vehbrndid = $("#lstvehbrnd").val();
  	var vehmdlid = $("#lstvehmdl").val();
  	var vehvrntid = $("#lstvehvrnt").val();
  	var slcdarr = slctdvrnts.split(',');
  	if (slcdarr.includes(vehbrndid+"-"+vehmdlid+"-"+vehvrntid))
  	{
  		alert("Variant already added");
		}
		else
		{
			$.ajax({
	  		type: "POST",
	  		url: "../includes/inc_getStsk.php",
	  		data:'veh_brnd_slct='+vehbrndid+'&veh_mdl_slct='+vehmdlid+'&veh_vrnt_slct='+vehvrntid+'&al_slct='+slctdvrnts,
	  		success: function(data){
	  			// alert(data)
	  			var data2 = data.split('|');
	  			$("#slctvrnts").show();
	  			$("#slctvrnts").append(data2[0]);
	  			if(slctdvrnts == '')
	  			{
	  				$("#slctdvrnts").val(data2[1]);
	  			}
	  			else
	  			{
	  				$("#slctdvrnts").val(slctdvrnts+','+data2[1]);
	  			}
	  		}
	  	});
		}
  	var vehbrndid = $("#lstvehbrnd").val("");
  	var vehmdlid = $("#lstvehmdl").val("");
  	var vehvrntid = $("#lstvehvrnt").val("");
  	get_veh_diff_vrnt();
  }
  function remove_vrnts(brndid,mdlid,vrntid)
  {
  	var slctd = brndid+"-"+mdlid+"-"+vrntid;
  	$("#"+slctd).remove();
  	var slctdvrnts = $("#slctdvrnts").val();
  	var slcdarr = slctdvrnts.split(',');
  	if(slcdarr.includes(slctd))
  	{
  		var index = slcdarr.indexOf(slctd);
  		if (index > -1)
  		{
			  slcdarr.splice(index, 1);
			  $("#slctdvrnts").val(slcdarr);
			}
  	}/*
  	else
  	{
  		alert("Not found");
  	}*/
  }
  function del_vrnts(prod_dtl_id)
  {
  	var url = "../includes/inc_getStsk.php?prod_dtl_id="+prod_dtl_id;
		xmlHttp	= GetXmlHttpObject(prodstateChanged);
		xmlHttp.open("GET", url , true);
		xmlHttp.send(null);
	}
	function prodstateChanged()
	{
		if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
		{
			var temp=xmlHttp.responseText;
			// alert(temp);
			if(temp!= '')
			{
				var data2 = temp.split('|');
				$("#"+data2[1]).remove();
				var slctdvrnts = $("#slctdvrnts").val();
		  	var slcdarr = slctdvrnts.split(',');
		  	if(slcdarr.includes(data2[1]))
		  	{
		  		var index = slcdarr.indexOf(data2[1]);
		  		if (index > -1)
		  		{
					  slcdarr.splice(index, 1);
					  $("#slctdvrnts").val(slcdarr);
					}
		  	}
		  	alert("Removed Successfully.");
			}
		}
	}
  function get_tube_dtls()
  {
  	var slctdtyrtyp = $("#tyrtyp").val();
  	$.ajax({
  		type: "POST",
  		url: "../includes/inc_getStsk.php",
  		data:'tyr_typ='+slctdtyrtyp,
  		success: function(data){
  			// alert(data)
  			$("#rdtyp").html(data);
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
					<h1 class="m-0 text-dark">Edit Product</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Edit Product</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<form name="frmedtprodid" id="frmedtprodid" method="post" action="<?php $_SERVER['PHP_SELF'];?>" onSubmit="return performCheck('frmedtprodid', rules, 'inline');" enctype="multipart/form-data">
		<input type="hidden" name="hdnprodid" value="<?php echo $id;?>">
		<input type="hidden" name="hdnpage" value="<?php echo $pg;?>">
		<input type="hidden" name="hdncnt" value="<?php echo $countstart?>">
		<input type="hidden" name="hdnloc" value="<?php echo $loc?>">
		<!-- <input type="hidden" name="hdnbrndimg" id="hdnbrndimg" value="<?php echo $rowsprod_mst['prodm_img'];?>"> -->
		<div class="card">
			<div class="card-body">
				<div class="row justify-content-center align-items-center">
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>SKU / Bar Code *</label>
							</div>
							<div class="col-sm-9">
								<input name="txtsku" type="text" id="txtsku" size="45" maxlength="40" onBlur="funcChkDupSku()" class="form-control" value="<?php echo $rowsprod_mst['prodm_sku']; ?>">
								<span id="errorsDiv_txtsku"></span>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Code *</label>
							</div>
							<div class="col-sm-9">
								<input name="txtcde" type="text" id="txtcde" size="45" maxlength="40" onBlur="funcChkDupCode()" class="form-control" value="<?php echo $rowsprod_mst['prodm_code']; ?>">
								<span id="errorsDiv_txtcde"></span>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Name *</label>
							</div>
							<div class="col-sm-9">
								<input name="txtname" type="text" id="txtname" size="45" maxlength="40" class="form-control" value="<?php echo $rowsprod_mst['prodm_name']; ?>">
								<span id="errorsDiv_txtname"></span>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Tyre Brand *</label>
							</div>
							<div class="col-sm-9">
								<?php
								$sqrytyr_brnd_mst = "SELECT tyrbrndm_id, tyrbrndm_name from tyr_brnd_mst order by tyrbrndm_name";
								$rstyr_brnd_mst = mysqli_query($conn,$sqrytyr_brnd_mst);
								$cnt_tyr_brnd = mysqli_num_rows($rstyr_brnd_mst);
								?>
								<select name="lsttyrbrnd" id="lsttyrbrnd" class="form-control">
									<option value="">--Select--</option>
									<?php
									if($cnt_tyr_brnd > 0)
									{
										while($rowstyr_brnd_mst = mysqli_fetch_assoc($rstyr_brnd_mst))
										{
											$tyrbrndm_id = $rowstyr_brnd_mst['tyrbrndm_id'];
											$tyrbrndm_name = $rowstyr_brnd_mst['tyrbrndm_name'];
											?>
											<option value="<?php echo $tyrbrndm_id;?>"<?php if($rowsprod_mst['prodm_tyr_brnd'] == $tyrbrndm_id) echo 'selected';  ?>><?php echo $tyrbrndm_name;?></option>
											<?php
										}
									}
									?>
								</select>
								<span id="errorsDiv_lsttyrbrnd"></span>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Vehicle Type </label>
							</div>
							<div class="col-sm-9">
								<?php
								$sqryveh_type_mst = "SELECT vehtypm_id, vehtypm_name from veh_type_mst order by vehtypm_name";
								$rsveh_type_mst = mysqli_query($conn,$sqryveh_type_mst);
								$cnt_veh_typ = mysqli_num_rows($rsveh_type_mst);
								?>
								<select name="lstvehtyp" id="lstvehtyp" onchange="get_tyr_wdth();" class="form-control">
									<option value="">--Select--</option>
									<?php
									if($cnt_veh_typ > 0)
									{
										while($rowsveh_type_mst = mysqli_fetch_assoc($rsveh_type_mst))
										{
											$vehtypid = $rowsveh_type_mst['vehtypm_id'];
											$vehtypname = $rowsveh_type_mst['vehtypm_name'];
											?>
											<option value="<?php echo $vehtypid;?>" <?php if($rowsprod_mst['vehtypm_id'] == $vehtypid) echo 'selected';  ?>><?php echo $vehtypname;?></option>
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
								<?php
								$sqrytyrwdth_mst = "SELECT tyrwdthm_id, tyrwdthm_name from tyr_wdth_mst order by tyrwdthm_name";
								$rstyrwdth_mst = mysqli_query($conn,$sqrytyrwdth_mst);
								$cnt_tyr_wdth = mysqli_num_rows($rstyrwdth_mst);
								?>
								<select name="lsttyrwdth" id="lsttyrwdth" onchange="get_tyr_prfl()" class="form-control">
									<option value="">--Select width--</option>
									<?php
									if($cnt_tyr_wdth > 0)
									{
										while($rowstyr_wdth_mst = mysqli_fetch_assoc($rstyrwdth_mst))
										{
											$tyrwdthid = $rowstyr_wdth_mst['tyrwdthm_id'];
											$tyrwdthname = $rowstyr_wdth_mst['tyrwdthm_name'];
											?>
											<option value="<?php echo $tyrwdthid;?>" <?php if($rowsprod_mst['prodm_tyrwdth'] == $tyrwdthid) echo 'selected';  ?>><?php echo $tyrwdthname;?></option>
											<?php
										}
									}
									?>
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
								<?php
								$sqrytyrprfl_mst = "SELECT tyrprflm_id, tyrprflm_name from tyr_prfl_mst order by tyrprflm_name";
								$rstyrprfl_mst = mysqli_query($conn,$sqrytyrprfl_mst);
								$cnt_tyr_prfl = mysqli_num_rows($rstyrprfl_mst);
								?>
								<select name="lsttyrprfl" id="lsttyrprfl" onchange="get_tyr_rmsz()"  class="form-control">
									<option value="">--Select Profile--</option>
									<?php
									if($cnt_tyr_prfl > 0)
									{
										while($rowstyr_prfl_mst = mysqli_fetch_assoc($rstyrprfl_mst))
										{
											$tyrprflid = $rowstyr_prfl_mst['tyrprflm_id'];
											$tyrprflname = $rowstyr_prfl_mst['tyrprflm_name'];
											?>
											<option value="<?php echo $tyrprflid;?>" <?php if($rowsprod_mst['prodm_tyrprfl'] == $tyrprflid) echo 'selected';  ?>><?php echo $tyrprflname;?></option>
											<?php
										}
									}
									?>
								</select>
								<span id="errorsDiv_lsttyrprfl"></span>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Tyre Rim Size *</label>
							</div>
							<div class="col-sm-9">
								<?php
								$sqrytyrprfl_mst = "SELECT tyrrmszm_id, tyrrmszm_name from tyr_rimsize_mst order by tyrrmszm_name";
								$rstyremsz_mst = mysqli_query($conn,$sqrytyrprfl_mst);
								$cnt_tyr_rmsz = mysqli_num_rows($rstyremsz_mst);
								?>
								<select name="lsttyrrmsz" id="lsttyrrmsz" onchange="get_veh_brnds()" class="form-control">
									<option value="">--Select Rim Size--</option>
									<?php
									if($cnt_tyr_rmsz > 0)
									{
										while($rowstyr_rimsize_mst = mysqli_fetch_assoc($rstyremsz_mst))
										{
											$tyrrmszid = $rowstyr_rimsize_mst['tyrrmszm_id'];
											$tyrrmszname = $rowstyr_rimsize_mst['tyrrmszm_name'];
											?>
											<option value="<?php echo $tyrrmszid;?>" <?php if($rowsprod_mst['prodm_tyrrmsz'] == $tyrrmszid) echo 'selected';  ?>><?php echo $tyrrmszname;?></option>
											<?php
										}
									}
									?>
								</select>
								<span id="errorsDiv_lsttyrrmsz"></span>
							</div>
						</div>
					</div>
					<div>
						<label>Select Type: </label>&nbsp;&nbsp;
						<select name="lstvehtyp1" id="lstvehtyp1" onchange="get_veh_brnds();" class="form-control">
							<option value="">--Select Type--</option>
							<?php
							$vtypid = $rowsprod_mst['vehtypm_id'];
							$sqryvtyp_mst = "SELECT vehtypm_id, vehtypm_name from veh_type_mst where vehtypm_sts = 'a' and vehtypm_id = $vtypid group by vehtypm_id order by vehtypm_prty";
							// echo $sqryvtyp_mst;
							$srsvehtp_mst = mysqli_query($conn,$sqryvtyp_mst) or die(mysqli_error());
							$cntvehtp_inc = mysqli_num_rows($srsvehtp_mst);
							$i = 0;
							while ($rowsveh_tp_mst = mysqli_fetch_array($srsvehtp_mst))
							{ 
								$vehtpm_id = $rowsveh_tp_mst['vehtypm_id'];
								$vehtpm_name = $rowsveh_tp_mst['vehtypm_name'];
								?>
								<option value="<?php echo $vehtpm_id;?>"><?php echo $vehtpm_name;?></option>
								<?php
								$i++;
							}
							?>
						</select>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm">
								<div class="d-flex flex-column">
									<div id="lstvrnts" class="d-flex flex-row justify-content-around">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div id="slctvrnts" class="container">
						<?php
						$sqrydiff_vrnts = "SELECT prodd_id, vehvrntm_id, vehvrntm_name, vehmodlm_id, vehmodlm_name, vehbrndm_id, vehbrndm_name
							from prod_mst
							left join prod_veh_dtl on prod_veh_dtl.prodd_prodm_id = prod_mst.prodm_id
							left join veh_vrnt_mst on veh_vrnt_mst.vehvrntm_id = prod_veh_dtl.prodd_veh_vrnt
							left join veh_model_mst on veh_model_mst.vehmodlm_id = prod_veh_dtl.prodd_veh_mdl
							left join veh_brnd_mst on veh_brnd_mst.vehbrndm_id = prod_veh_dtl.prodd_veh_brnd
							where prodm_id = $id";
						$srsvehdiff_vrnts = mysqli_query($conn,$sqrydiff_vrnts);
						$cnt_diff_vrnts = mysqli_num_rows($srsvehdiff_vrnts);
						// echo $sqrydiff_vrnts; exit;
						$vt_id = array();
						?>
						<b>Selected Variants:</b>
						<div class='row d-flex flex-row justify-content-center text-center'><div class='col-md-3'><b>Brand</b></div><div class='col-md-3'><b>Model</b></div><div class='col-md-3'><b>Variant</b></div><div class='col-md-3'><b>Remove</b></div></div>
						<div id="slctvrnts" class="container text-center border-bottom border-top">
							<?php
							while($rowsveh_vrnts = mysqli_fetch_assoc($srsvehdiff_vrnts))
							{
								$prod_veh_dtl_id = $rowsveh_vrnts['prodd_id'];
								$brnd_id = $rowsveh_vrnts['vehbrndm_id'];
								$modl_id = $rowsveh_vrnts['vehmodlm_id'];
								$vrnt_id = $rowsveh_vrnts['vehvrntm_id'];
								$vt_id[] = $brnd_id."-".$modl_id."-".$vrnt_id;
								?>
								<div class='row d-flex flex-row justify-content-center text-center mb-1 mt-1' id="<?php echo $brnd_id."-".$modl_id."-".$vrnt_id;?>">
									<div class='col-md-3'><?php echo $rowsveh_vrnts['vehbrndm_name']; ?></div>
									<div class='col-md-3'><?php echo $rowsveh_vrnts['vehmodlm_name']; ?></div>
									<div class='col-md-3'><?php echo $rowsveh_vrnts['vehvrntm_name']; ?></div>
									<div class='col-md-3'><input name="btnremove" type="button" value="Remove" class=" btn btn-primary" id="btnremove" onclick="del_vrnts(<?php echo $prod_veh_dtl_id; ?>);"></div>
								</div>
								<?php
							}
							$v_ids = implode(",", $vt_id);
							?>
							<input type="hidden" name="slctdvrnts" id="slctdvrnts" value="<?php echo $v_ids ?>">
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Location *</label>
							</div>
							<div class="col-sm-9">
								<?php
								$sqry_loc = "SELECT strlocm_name, strlocm_id FROM store_loc_mst WHERE strlocm_sts ='a' group by strlocm_id order by strlocm_name";
								$srsloc = mysqli_query($conn,$sqry_loc);
								$num_rows = mysqli_num_rows($srsloc);
								while ($srowloc = mysqli_fetch_assoc($srsloc))
								{
									$locids = '';
									$locid= $srowloc['strlocm_id'];
										$locnm = $srowloc['strlocm_name'];
									$sqryprod_dtl = "SELECT prods_store_id
						      	from prod_store_dtl where prods_prodm_id ='$id'";
						      $srsprod_dtl = mysqli_query($conn,$sqryprod_dtl);
						      while($rowprod_dtl=mysqli_fetch_assoc($srsprod_dtl))
						      {
						      	$locids.=",".$rowprod_dtl['prods_store_id'];
						      }
						      $locids1=substr($locids,1);
									$locid1=explode(',',$locids1);
									// echo $cstmrid."<br>";
									// print_r($cstmid1);
									$cntid=count($locid1);
									if (in_array($locid, $locid1))
									{
										$slctchk = "checked";
									}
									else
									{
										$slctchk = "";
									}
									// echo $slctchk;
									?>
									<input name="ckhloc[]" type="checkbox" id="ckhloc<?php echo $locid; ?>" <?php echo $slctchk; ?> value="<?php echo $locid; ?>">&nbsp;<?php echo $locnm; ?>
									<span id="errorsDiv_ckhloc"></span>
									<?php
								}
								?>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Type *</label>
							</div>
							<div class="col-sm-9">
								<?php
								$sqrytyr_typ_mst = "SELECT tyrtypm_id, tyrtypm_name from tyr_type_mst order by tyrtypm_name";
								$srstyr_typ_mst = mysqli_query($conn,$sqrytyr_typ_mst);
								$cnt_tyr_typ = mysqli_num_rows($srstyr_typ_mst);
								?>
								<select name="tyrtyp" id="tyrtyp" class="form-control" onchange="get_tube_dtls();">
									<option value="">--Select--</option>
									<?php
									if($cnt_tyr_typ > 0)
									{
										while($rowstyr_typ_mst = mysqli_fetch_assoc($srstyr_typ_mst))
										{
											$tyrtypm_id = $rowstyr_typ_mst['tyrtypm_id'];
											$tyrtypm_name = $rowstyr_typ_mst['tyrtypm_name'];
											?>
											<option value="<?php echo $tyrtypm_id;?>" <?php if($rowsprod_mst['prodm_tyrtyp'] == $tyrtypm_id) echo 'selected';  ?>><?php echo $tyrtypm_name;?></option>
											<?php
										}
									}
									?>
								</select>
								<span id="errorsDiv_tyrtyp"></span>
							</div>
						</div>
					</div>
					<div id="rdtyp" class="col-md-12">
						<div class='row mb-2 mt-2'>
							<div class='col-sm-3'>
								<label>Tube included*</label>
							</div>
							<div class='col-sm-9'>
								<?php
								$slctd = $rowsprod_mst['prodm_tub_dtl'];
								?>
								<input type='radio' id='yes' name='rdtub' value='yes' <?php if ($slctd == "yes") {echo "checked"; }?>> Yes&nbsp;&nbsp;&nbsp;&nbsp;
								<input type='radio' id='no' name='rdtub' value='no' <?php if($slctd == "no") {echo "checked";} ?>> No
								<span id='errorsDiv_tyrtyp'></span>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Size *</label>
							</div>
							<div class="col-sm-9">
								<input name="txtsize" type="text" id="txtsize" size="45" maxlength="40" class="form-control" value="<?php echo $rowsprod_mst['prodm_size']; ?>">
								<span id="errorsDiv_txtsize"></span>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Pattern *</label>
							</div>
							<div class="col-sm-9">
								<input name="txtptrn" type="text" id="txtptrn" size="45" maxlength="40" class="form-control" value="<?php echo $rowsprod_mst['prodm_ptrn']; ?>">
								<span id="errorsDiv_txtptrn"></span>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Cost Price *</label>
							</div>
							<div class="col-sm-9">
								<input name="txtcstprc" type="text" id="txtcstprc" size="45" maxlength="40" class="form-control" value="<?php echo $rowsprod_mst['prodm_cstprc']; ?>">
								<span id="errorsDiv_txtcstprc"></span>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Sale Price *</label>
							</div>
							<div class="col-sm-9">
								<input name="txtsleprc" type="text" id="txtsleprc" size="45" maxlength="40" class="form-control" value="<?php echo $rowsprod_mst['prodm_sleprc']; ?>">
								<span id="errorsDiv_txtsleprc"></span>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Offer Price </label>
							</div>
							<div class="col-sm-9">
								<input name="txtofrprc" type="text" id="txtofrprc" size="45" maxlength="40" class="form-control" value="<?php echo $rowsprod_mst['prodm_ofrprc']; ?>">
								<span id="errorsDiv_txtofrprc"></span>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Description</label>
							</div>
							<div class="col-sm-9"> 
								<textarea name="txtdesc" cols="60" rows="3" id="txtdesc" class="form-control"><?php echo $rowsprod_mst['prodm_dsc']; ?></textarea>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>SEO Title</label>
							</div>
							<div class="col-sm-9"> 
								<input type="text" name="txtseotitle" id="txtseotitle" size="45" maxlength="250" class="form-control" value="<?php echo $rowsprod_mst['prodm_st']; ?>">
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>SEO Description</label>
							</div>
							<div class="col-sm-9">
								<textarea name="txtseodesc" rows="3" cols="60" id="txtseodesc" class="form-control"><?php echo $rowsprod_mst['prodm_sdsc']; ?></textarea>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>SEO Keyword</label>
							</div>
							<div class="col-sm-9">
								<textarea name="txtkywrd" rows="3" cols="60" id="txtkywrd" class="form-control"><?php echo $rowsprod_mst['prodm_sky']; ?></textarea>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>SEO H1 Title</label>
							</div>
							<div class="col-sm-9">
								<input type="text" name="txtseoh1tle" id="txtseoh1tle" size="45" maxlength="250" class="form-control" value="<?php echo $rowsprod_mst['prodm_sotl']; ?>">
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>SEO H1 Description</label>
							</div>
							<div class="col-sm-9">
								<textarea name="txtseoh1desc" rows="3" cols="60" id="txtseoh1desc" class="form-control"><?php echo $rowsprod_mst['prodm_sodsc']; ?></textarea>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>SEO H2 Title</label>
							</div>
							<div class="col-sm-9">
								<input type="text" name="txtseoh2tle" id="txtseoh2tle" size="45" maxlength="250" class="form-control" value="<?php echo $rowsprod_mst['prodm_sttle']; ?>">
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>SEO H2 Description</label>
							</div>
							<div class="col-sm-9">
								<textarea name="txtseoh2desc" rows="3" cols="60" id="txtseoh2desc" class="form-control"><?php echo $rowsprod_mst['prodm_stdsc']; ?></textarea>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Rank *</label>
							</div>
							<div class="col-sm-9"> 
								<input type="text" name="txtprior" id="txtprior" class="form-control" size="4" maxlength="3" value="<?php echo $rowsprod_mst['prodm_rnk']; ?>">
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
									<option value="a"<?php if($rowsprod_mst['prodm_sts']=='a') echo 'selected';?>>Active</option>
									<option value="i"<?php if($rowsprod_mst['prodm_sts']=='i') echo 'selected';?>>Inactive</option>
								</select>
							</div>
						</div>
					</div>
					<div class="table-responsive">
						<table width="100%"  border="0" cellspacing="1" cellpadding="1" class="table table-striped table-bordered">
							<tr bgcolor="#FFFFFF">
								<td width="1%"  align="center" ><strong>S.No.</strong></td>
								<td width="10%" align="center" ><strong>Name</strong></td>
								<td width="35%" colspan="2" align="center" ><strong>Small Image</strong></td>
								<td width="35%" colspan="2" align="center" ><strong>Big Image</strong></td>
								<td width="10%"  align="center" ><strong>Priority</strong></td>
								<td width="10%"  align="center" ><strong>Status</strong></td>
							</tr>
						</table>
					</div>
					<div class="table-responsive">
						<table width="100%"  border="0" cellspacing="1" cellpadding="1" class="table table-striped table-bordered">
							<?php
							$sqryimg_dtl="SELECT prodimgd_id,prodimgd_title,prodimgd_simg,prodimgd_bimg,prodimgd_prty, prodimgd_sts from prodimg_dtl where prodimgd_prodm_id ='$id' order by prodimgd_id";
							$srsimg_dtl	= mysqli_query($conn,$sqryimg_dtl);
							$cntprodimg_dtl  = mysqli_num_rows($srsimg_dtl);
							$nfiles = 0;
							if($cntprodimg_dtl > 0)
							{								
						  	while($rowsprodimgd_mdtl=mysqli_fetch_assoc($srsimg_dtl))
						  	{
									$prodimgdid = $rowsprodimgd_mdtl['prodimgd_id'];
									$db_prdimg = $rowsprodimgd_mdtl['prodimgd_title'];
									// $arytitle = explode("-",$db_prdimg);
									$nfiles++;
									// echo $nfiles;
									?>
									<input type="hidden" name="hdnsmlimg<?php echo $nfiles?>" class="select" value="<?php echo $rowsprodimgd_mdtl['prodimgd_simg'];?>">
                  <input type="hidden" name="hdnbgimg<?php echo $nfiles?>" class="select" value="<?php echo $rowsprodimgd_mdtl['prodimgd_bimg'];?>">
                  <input type="hidden" name="hdnproddid<?php echo $nfiles?>" class="select" value="<?php echo $prodimgdid;?>">
									<tr bgcolor="#FFFFFF">
										<td width="5%" align="center"><?php echo  $nfiles;?></td>
										<td width="15%" align="center">
											<input type="text" name="txtphtname<?php echo $nfiles?>" id="txtphtname<?php echo $nfiles?>" placeholder="Name" class="form-control" size="15" value="<?php echo $db_prdimg;?>"><br>
											<span id="errorsDiv_txtphtname<?php echo $nfiles?>" style="color:#FF0000"></span>
										</td>
										<td width="15%"  align="center" >
											<input type="file" name="flesimg<?php echo $nfiles;?>" class="form-control" id="flesimg<?php echo $nfiles;?>"><br/>
											<span id="errorsDiv_flesimg<?php echo $nfiles;?>" style="color:#FF0000"></span>
										</td>
										<td align="left" width='10%'>
                      <?php
                      $imgid = $rowsprodimgd_mdtl['prodimgd_id'];
											$simgnm = $rowsprodimgd_mdtl['prodimgd_simg'];
											//$imgpath = $gsml_fldnm.$imgnm;
											$simgpathjpeg = $gprodsimg_upldpth.$simgnm.".jpeg";
											$simgpathjpg = $gprodsimg_upldpth.$simgnm.".jpg";
											if(($simgnm != '') && file_exists($simgpathjpeg))
											{
												$simgpath = $simgpathjpeg;
											}
											else if(($simgnm != '') && file_exists($simgpathjpg))
											{
												$simgpath = $simgpathjpg;
											}
											if(($simgnm !="") && file_exists($simgpath))
											{
                      	echo "<img src='$simgpath' width='30pixel' height='30pixel'>";
                      }
                      else
                      {
                      	echo "No Image";
                      }
                      ?>
                      <span id="errorsDiv_flesmlimg1"></span>
                    </td>
										<td width="15%"  align="center" >
											<input type="file" name="flesimg<?php echo $nfiles;?>" class="form-control" id="flesimg<?php echo $nfiles;?>"><br/>
											<span id="errorsDiv_flesimg<?php echo $nfiles;?>" style="color:#FF0000"></span>
										</td>
										<td align="left" width='10%'>
                      <?php
                      $imgid = $rowsprodimgd_mdtl['prodimgd_id'];
											$bimgnm = $rowsprodimgd_mdtl['prodimgd_bimg'];
											//$imgpath = $gsml_fldnm.$imgnm;
											$bimgpathjpeg = $gprodbimg_upldpth.$bimgnm.".jpeg";
											$bimgpathjpg = $gprodbimg_upldpth.$bimgnm.".jpg";
											if(($bimgnm != '') && file_exists($bimgpathjpeg))
											{
												$bimgpath = $bimgpathjpeg;
											}
											else if(($bimgnm != '') && file_exists($bimgpathjpg))
											{
												$bimgpath = $bimgpathjpg;
											}
											if(($bimgnm !="") && file_exists($bimgpath))
											{
                      	echo "<img src='$bimgpath' width='30pixel' height='30pixel'>";
                      }
                      else
                      {
                      	echo "No Image";
                      }
                      ?>
                      <span id="errorsDiv_flebmlimg<?php echo $nfiles?>"></span>
                    </td>
										<td width="10%"  align="center">
											<input type="text" name="txtphtprior<?php echo $nfiles?>" id="txtphtprior<?php echo $nfiles?>" class="form-control" placeholder="Priority" size="5" maxlength="3" value="<?php echo $rowsprodimgd_mdtl['prodimgd_prty'];?>"><br>
											<span id="errorsDiv_txtphtprior<?php echo $nfiles?>" style="color:#FF0000"></span>
										</td>
										<td width="10%" align="center" >					
											<select name="lstphtsts<?php echo $nfiles?>" id="lstphtsts<?php echo $nfiles?>" class="form-control">
												<option value="a" <?php if($rowsprodimgd_mdtl['prodimgd_sts']=='a'){ echo 'selected'; }else{}  ?>>Active</option>
												<option value="i" <?php if($rowsprodimgd_mdtl['prodimgd_sts']=='i'){ echo 'selected'; }else{} ?>>Inactive</option>
											</select>
										</td>
									</tr>
									<?php
								}
							}
							else
							{ ?>
								<table width="100%" border="0" cellspacing="3" cellpadding="3">
									<tr bgcolor="#FFFFFF">
										<td width="5%" align="center">1</td>
										<td width="15%"  align="center">
											<input type="text" name="txtphtname1" id="txtphtname1" placeholder="Name" class="form-control" size="15"><br>
											<span id="errorsDiv_txtphtname1" style="color:#FF0000"></span>
										</td>
										<td width="30%"  align="center" >
											<input type="file" name="flesimg1" class="form-control" id="flesimg1"><br/>
											<span id="errorsDiv_flesimg1" style="color:#FF0000"></span>
										</td>
										<td width="30%"  align="center" >
											<input type="file" name="flebimg1" class="form-control" id="flebimg1"><br/>
											<span id="errorsDiv_flebimg1" style="color:#FF0000"></span>
										</td>
										<td width="10%"  align="center">
											<input type="text" name="txtphtprior1" id="txtphtprior1" class="form-control" placeholder="Priority" size="5" maxlength="3"><br>
											<span id="errorsDiv_txtphtprior1" style="color:#FF0000"></span>
										</td>
										<td width="10%" align="center" >					
											<select name="lstphtsts1" id="lstphtsts1" class="form-control">
												<option value="a" selected>Active</option>
												<option value="i">Inactive</option>
											</select>
										</td>
									</tr>
								</table>
								<?php
							}
							if($nfiles =="")
							{
								$nfiles = 1;
							}
							?>
						</table>
						<input type="hidden" name="hdntotcntrl" value="<?php echo $nfiles;?>">
						<div id="myDiv">
							<table width="100%" cellspacing='2' cellpadding='3'>
								<tr>
									<td align="center">
										<input name="btnadd" type="button" onClick="expand();" value="Add Another Image" class="btn btn-primary mb-3">
									</td>
								</tr>
							</table>
						</div>
					</div>
					<p class="text-center">
						<input type="Submit" class="btn btn-primary" name="btneprod" id="btneprod" value="Submit">
						&nbsp;&nbsp;&nbsp;
						<input type="reset" class="btn btn-primary" name="btnaddprodreset" value="Clear" id="btnaddprodreset">
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
	function expand()
	{
		var nfiles = document.frmedtprodid.hdntotcntrl.value;
		// var nfiles ="<?php echo $nfiles;?>";
		nfiles++;
		var htmlTxt = '<?php
		echo "<table border=0 cellpadding=3 cellspacing=1 width=100%>";
		echo "<tr >";
		echo "<td colspan=3 height=2 bgcolor=#f0f0f0 valign=middle></td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td colspan=3 height=4 valign=middle></td>";
		echo "</tr>";
		echo "</table><br>";
		echo "<table border=0 cellpadding=0 cellspacing=1 width=100%>";
		echo "<tr>";
		echo "<td align=center width=5%> ' + nfiles + '</td>";
		echo "<td align=center width=15%>";
		echo "<input type=text name=txtphtname' + nfiles + ' id=txtphtname' + nfiles + ' class=form-control size=15 placeholder=Name>";
		echo "</td>";
		echo "<td align=center width=30%>";
		echo "<input type=file name=flesimg' + nfiles + ' id=flesimg' + nfiles + ' class=form-control><br>";
		echo "</td>";
		echo "<td align=center width=30%>";
		echo "<input type=file name=flebimg' + nfiles + ' id=flebimg' + nfiles + ' class=form-control><br>";
		echo "</td>";
		echo "<td align=center width=10%>";
		echo "<input type=text name=txtphtprior' + nfiles + ' id=txtphtprior' + nfiles + ' class=form-control size=5 maxlength=3 placeholder=Priority>";
		echo "</td>";
		echo "<td align=center width=10%>";
		echo "<select name=lstphtsts' + nfiles + ' id=lstphtsts' + nfiles + ' class=form-control>";
		echo "<option value=a>Active</option>";
		echo "<option value=i>Inactive</option>";
		echo "</select>";
		echo "</td></tr></table><br>";
		?>';
		var Cntnt = document.getElementById ("myDiv");
		if (document.createRange)
		{
			//all browsers, except IE before version 9
			var rangeObj = document.createRange();
			Cntnt.insertAdjacentHTML('BeforeBegin' , htmlTxt);
			document.frmedtprodid.hdntotcntrl.value = nfiles;
			if (rangeObj.createContextualFragment)
			{
				// all browsers, except IE
				//var documentFragment = rangeObj.createContextualFragment (htmlTxt);
				//Cntnt.insertBefore (documentFragment, Cntnt.firstChild);	//Mozilla
			}
			else
			{
				//Internet Explorer from version 9
				Cntnt.insertAdjacentHTML('BeforeBegin' , htmlTxt);
			}
		}
		else
		{
			//Internet Explorer before version 9
			Cntnt.insertAdjacentHTML ("BeforeBegin", htmlTxt);
		}
		// document.getElementById('hdntotcntrl').value = nfiles;
		document.frmedtprodid.hdntotcntrl.value = nfiles;
	}
</script>