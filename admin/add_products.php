<?php
include_once '../includes/inc_config.php'; //Making paging validation
include_once $inc_nocache; //Clearing the cache information
include_once $adm_session; //checking for session
include_once $inc_cnctn; //Making database Connection
include_once $inc_usr_fnctn; //checking for session
include_once $inc_pgng_fnctns; //Making paging validation
include_once $inc_fldr_pth; //Making paging validation
/**************************************************************
Programm : add_products.php	
Purpose : For adding new Products
Created By : Bharath
Created On :	31-12-2021
Modified By : 
Modified On : 
Company : Adroit
***********************************************************/
/*****header link********/
$pagemncat = "Products";
$pagecat = "Products";
$pagenm = "View Products";
/*****header link********/
global $gmsg;		 
$rd_crntpgnm = "view_all_products.php";
$clspn_val = "4";
if(isset($_POST['btnaprod']) && ($_POST['btnaprod'] != "") && isset($_POST['txtsku']) && ($_POST['txtsku'] != "") && isset($_POST['txtcde']) && ($_POST['txtcde']!= "") && isset($_POST['txtname']) && ($_POST['txtname'] != "") && isset($_POST['lsttyrbrnd']) && ($_POST['lsttyrbrnd'] != "") && isset($_POST['lstvehtyp']) && ($_POST['lstvehtyp']!= "") && isset($_POST['txtsize']) && ($_POST['txtsize'] != "") && isset($_POST['txtptrn']) && ($_POST['txtptrn'] != "") && isset($_POST['txtcstprc']) && ($_POST['txtcstprc'] != "") && isset($_POST['txtsleprc']) && ($_POST['txtsleprc'] != "") && isset($_POST['txtprior']) && ($_POST['txtprior'] != ""))
{
	include_once "../includes/inc_fnct_fleupld.php"; // For uploading files		
	include_once "../database/iqry_prod_mst.php";
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<title><?php echo $pgtl;?></title>
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
			rules[4]='lstvehtyp:Type|required|Select Vehicle Type';
			rules[5]='brndchk:Brand|required|Select Vehicle Brand';
			rules[6]='modlchk:Model|required|Select Vehicle Model';
			rules[7]='vrntchk:Variant|required|Select Vehicle Variant';
			rules[8]='lsttyrwdth:Width|required|Select Tyre Width';
			rules[9]='lsttyrprfl:Profile|required|Select Tyre Profile';
			rules[10]='lsttyrrmsz:Rim Size|required|Select Tyre Rim Size';
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
				if(sku != "")
				{
					var url = "chkduplicate.php?prodsku="+sku;
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
				if(code != "")
				{
					var url = "chkduplicate.php?prodcode="+code;
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
					//alert(temp);
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
		  /********************Multiple Image Upload******************************/
		  var nfiles=1;
		  function expand()
		  {
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
		  		document.frmprod.hdntotcntrl.value = nfiles;
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
		  	document.getElementById('hdntotcntrl').value = nfiles;
		  	document.frmprod.hdntotcntrl.value = nfiles;
		  }
		</script>
	</head>
	<body onLoad="setfocus()">
		<?php include_once ('../includes/inc_adm_header.php'); ?>
		<section class="content">
			<div class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1 class="m-0 text-dark">Add Product</h1>
						</div><!-- /.col -->
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="#">Home</a></li>
								<li class="breadcrumb-item active">Add Product</li>
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
					<form name="frmprod" id="frmprod" method="post" action="<?php $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data" onSubmit="return performCheck('frmprod', rules, 'inline');">
						<div class="col-md-12">
							<div class="row justify-content-center align-items-center">
								<div class="col-md-12">
									<div class="row mb-2 mt-2">
										<div class="col-sm-3">
											<label>SKU / Bar Code *</label>
										</div>
										<div class="col-sm-9">
											<input name="txtsku" type="text" id="txtsku" size="45" maxlength="40" onBlur="funcChkDupSku()" class="form-control">
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
											<input name="txtcde" type="text" id="txtcde" size="45" maxlength="40" onBlur="funcChkDupCode()" class="form-control">
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
											<input name="txtname" type="text" id="txtname" size="45" maxlength="40" class="form-control">
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
														<option value="<?php echo $tyrbrndm_id;?>"><?php echo $tyrbrndm_name;?></option>
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
											<label>Vehicle Type *</label>
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
											<select name="lsttyrwdth" id="lsttyrwdth" onchange="get_tyr_prfl()" class="form-control">
												<option value="">--Select width--</option>
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
											<select name="lsttyrprfl" id="lsttyrprfl" onchange="get_tyr_rmsz()" class="form-control">
												<option value="">--Select Profile--</option>
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
											<select name="lsttyrrmsz" id="lsttyrrmsz" onchange="get_veh_brnds()" class="form-control">
												<option value="">--Select Rim Size--</option>
											</select>
											<span id="errorsDiv_lsttyrrmsz"></span>
										</div>
									</div>
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
								<input type="hidden" name="slctdvrnts" id="slctdvrnts" value="">
								<div id="slctvrnts" class="container text-center border-bottom border-top" style="display:none;">
								</div>
								<div class="col-md-12">
									<div class="row mb-2 mt-2">
										<div class="col-sm-3">
											<label>Location *</label>
										</div>
										<?php
											$sqrystr_loc_mst = "SELECT strlocm_id, strlocm_name from store_loc_mst order by strlocm_name";
											$srsstrloc_mst = mysqli_query($conn,$sqrystr_loc_mst);
											$cnt_str_loc = mysqli_num_rows($srsstrloc_mst);
										?>
										<div class="col-sm-9">
											<?php
											while ($rowsstr_loc_mst = mysqli_fetch_array($srsstrloc_mst))
											{ ?>
												<input name="ckhloc[]" type="checkbox" id="ckhloc" value="<?php echo $rowsstr_loc_mst["strlocm_id"]; ?>">&nbsp;<?php echo $rowsstr_loc_mst["strlocm_name"]; ?>
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
											<label>Product Features *</label>
										</div>
										<?php
										$sqryprodft_mst = "SELECT prodfetrm_id, prodfetrm_name from prodfetr_mst order by prodfetrm_name";
										$srsprdft_mst = mysqli_query($conn, $sqryprodft_mst);
										$cnt_prdft = mysqli_num_rows($srsprdft_mst);
										?>
										<div class="col-sm-9">
											<?php
											while ($rowsprdft_mst = mysqli_fetch_array($srsprdft_mst)) { ?>
												<input name="chkprdft[]" type="checkbox" id="chkprdft" value="<?php echo $rowsprdft_mst["prodfetrm_id"]; ?>">&nbsp;<?php echo $rowsprdft_mst["prodfetrm_name"]; ?>
												<span id="errorsDiv_chkprdft"></span>
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
														<option value="<?php echo $tyrtypm_id;?>"><?php echo $tyrtypm_name;?></option>
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
								</div>
								<div class="col-md-12">
									<div class="row mb-2 mt-2">
										<div class="col-sm-3">
											<label>Size *</label>
										</div>
										<div class="col-sm-9">
											<input name="txtsize" type="text" id="txtsize" size="45" maxlength="40" class="form-control">
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
											<input name="txtptrn" type="text" id="txtptrn" size="45" maxlength="40" class="form-control">
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
											<input name="txtcstprc" type="text" id="txtcstprc" size="45" maxlength="40" class="form-control">
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
											<input name="txtsleprc" type="text" id="txtsleprc" size="45" maxlength="40" class="form-control">
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
											<input name="txtofrprc" type="text" id="txtofrprc" size="45" maxlength="40" class="form-control">
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
								<div class="table-responsive">
									<table width="100%"  border="0" cellspacing="1" cellpadding="1" class="table table-striped table-bordered">
										<tr bgcolor="#FFFFFF">
											<td width="1%"  align="center" ><strong>S.No.</strong></td>
											<td width="10%" align="center" ><strong>Name</strong></td>
											<td width="35%"  align="center" ><strong>Small Image</strong></td>
											<td width="35%"  align="center" ><strong>Big Image</strong></td>
											<td width="10%"  align="center" ><strong>Priority</strong></td>
											<td width="10%"  align="center" ><strong>Status</strong></td>
										</tr>
									</table>
								</div>
								<div class="table-responsive">
									<table width="100%"  border="0" cellspacing="1" cellpadding="1" class="table table-striped table-bordered" >
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
									</table>
									<input type="hidden" name="hdntotcntrl" value="1">
									<div id="myDiv">
										<table width="100%" cellspacing='2' cellpadding='3'>
											<tr>
												<td align="center">
													<input name="btnadd" type="button" onClick="expand()" value="Add Another Image" class="btn btn-primary mb-3">
												</td>
											</tr>
										</table>
									</div>
								</div>
								<p class="text-center">
									<input type="Submit" class="btn btn-primary" name="btnaprod" id="btnaprod" value="Submit">
									&nbsp;&nbsp;&nbsp;
									<input type="reset" class="btn btn-primary" name="btnaddprodreset" value="Clear" id="btnaddprodreset">
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
		<?php include_once '../includes/inc_adm_footer.php';?>
	</body>
</html>
<script language="javascript" type="text/javascript">
	CKEDITOR.replace('txtdesc');
</script>
<script language="javascript" type="text/javascript">
	CKEDITOR.replace('txtdlvry');
</script>

<!--<script language="javascript" type="text/javascript">
	generate_wysiwyg('txtseodesc');
</script>-->