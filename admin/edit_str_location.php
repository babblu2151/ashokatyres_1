<?php
include_once '../includes/inc_config.php'; //Making paging validation	
include_once $inc_nocache; //Clearing the cache information
include_once $adm_session; //checking for session
include_once $inc_cnctn; //Making database Connection
include_once $inc_usr_fnctn; //checking for session	
include_once $inc_pgng_fnctns; //Making paging validation
include_once $inc_fldr_pth; //Making paging validation
/***********************************************************
Programm : edit_str_location.php	
Package : 
Purpose : For Edit Store Location
Created By : Bharath
Created On : 03-01-2022
Modified By : 
Modified On : 
Purpose : 
Company : Adroit
************************************************************/
global $id,$pg,$countstart;
$rd_vwpgnm = "view_detail_str_loc.php";
$clspn_val = "4";
/*****header link********/
$pagemncat = "Setup";
$pagecat = "Stores";
$pagenm = "Locations"; 
/*****header link********/
if(isset($_POST['btnestrlocsbmt']) && (trim($_POST['btnestrlocsbmt']) != "") &&  isset($_POST['txtname']) && (trim($_POST['txtname']) != "") && isset($_POST['txtprior']) && (trim($_POST['txtprior']) != ""))
{
	include_once "../database/uqry_str_loc_mst.php";
}
if(isset($_REQUEST['edit']) && (trim($_REQUEST['edit'])!="") && isset($_REQUEST['pg']) && (trim($_REQUEST['pg'])!="") && isset($_REQUEST['countstart']) && (trim($_REQUEST['countstart'])!=""))
{
	$id = glb_func_chkvl($_REQUEST['edit']);
	$pg = glb_func_chkvl($_REQUEST['pg']);
	$countstart = glb_func_chkvl($_REQUEST['countstart']);
	$srchval = glb_func_chkvl($_REQUEST['val']);
}
elseif(isset($_REQUEST['hdnstrlocid']) && (trim($_REQUEST['hdnstrlocid'])!="") && isset($_REQUEST['hdnpage']) && (trim($_REQUEST['hdnpage'])!="") && isset($_REQUEST['hdncnt']) && (trim($_REQUEST['hdncnt'])!=""))
{
	$id = glb_func_chkvl($_REQUEST['hdnstrlocid']);
	$pg = glb_func_chkvl($_REQUEST['hdnpage']);
	$countstart = glb_func_chkvl($_REQUEST['hdncnt']);
	$srchval = glb_func_chkvl($_REQUEST['val']);
	$chk = glb_func_chkvl($_REQUEST['chk']);
}
$sqrystr_loc_mst = "SELECT strlocm_name, strlocm_desc, strlocm_seotitle, strlocm_seodesc, strlocm_seokywrd, strlocm_seohonetitle, strlocm_seohonedesc, strlocm_seohtwotitle, strlocm_seohtwodesc, strlocm_sts, strlocm_prty from store_loc_mst where strlocm_id=$id";
$srsstr_loc_mst = mysqli_query($conn,$sqrystr_loc_mst);
$rowsstr_loc_mst = mysqli_fetch_assoc($srsstr_loc_mst);
$loc= "&val=$srchval";
$pagetitle ="Edit Store Location";
?>
<script language="javaScript" type="text/javascript" src="js/ckeditor.js"></script>
<script language="javascript" src="../includes/yav.js"></script>
<script language="javascript" src="../includes/yav-config.js"></script>
<link rel="stylesheet" type="text/css" href="../includes/yav-style1.css">
<script language="javascript" type="text/javascript">
 	var rules=new Array();
 	rules[0]='txtname:Name|required|Enter Name';
 	rules[1]='txtprior:Priority|required|Enter Rank';
	rules[2]='txtprior:Priority|numeric|Enter Only Numbers';
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
		var name;
		name = document.getElementById('txtname').value;
		id = <?php echo $id;?>;		
		if((name != "") && (id != ""))
		{
			var url = "chkduplicate.php?strlocnm="+name+"&strlocid="+id;
			xmlHttp	= GetXmlHttpObject(stateChanged);
			xmlHttp.open("GET", url , true);
			xmlHttp.send(null);
		}
		else
		{
			document.getElementById('errorsDiv_txtname').innerHTML = "";
		}
	}
	function stateChanged()
	{
		if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
		{
			var temp=xmlHttp.responseText;
			document.getElementById("errorsDiv_txtname").innerHTML = temp;
			if(temp!=0)
			{
				document.getElementById('txtname').focus();
			}
		}
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
					<h1 class="m-0 text-dark">Edit Store Location</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Edit Store Location</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<form name="frmedtstrlocid" id="frmedtstrlocid" method="post" action="<?php $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data" onSubmit="return performCheck('frmedtstrlocid', rules, 'inline');">
		<input type="hidden" name="hdnstrlocid" value="<?php echo $id;?>">
		<input type="hidden" name="hdnpage" value="<?php echo $pg;?>">
		<input type="hidden" name="hdnval" value="<?php echo $srchval;?>">
		<input type="hidden" name="hdnchk" value="<?php echo $chk;?>">
		<input type="hidden" name="hdncnt" value="<?php echo $countstart?>">
		<input type="hidden" name="hdnsmlimg" value="<?php echo $rowsstr_loc_mst['strlocm_smlimg'];?>">
		<input type="hidden" name="hdnbgimg" value="<?php echo $rowsstr_loc_mst['strlocm_bnrimg'];?>">
		<div class="card">
			<div class="card-body">
				<div class="row justify-content-center">
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Name *</label>
							</div>
							<div class="col-sm-9">
								<input name="txtname" type="text" id="txtname" size="45" maxlength="40" onBlur="funcChkDupName()" class="form-control" value="<?php echo $rowsstr_loc_mst['strlocm_name'];?>">
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
								<textarea name="txtdesc" cols="60" rows="3" id="txtdesc" class="form-control"><?php echo stripslashes($rowsstr_loc_mst['strlocm_desc']);?></textarea>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>SEO Title</label>
							</div>
							<div class="col-sm-9"> 
								<input type="text" name="txtseotitle" id="txtseotitle" size="45" maxlength="250" class="form-control" value="<?php echo $rowsstr_loc_mst['strlocm_seotitle'];?>">
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>SEO Description</label>
							</div>
							<div class="col-sm-9">
								<textarea name="txtseodesc" rows="3" cols="60" id="txtseodesc" class="form-control"><?php echo stripslashes($rowsstr_loc_mst['strlocm_seodesc']);?></textarea>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>SEO Keyword</label>
							</div>
							<div class="col-sm-9">
								<textarea name="txtkywrd" rows="3" cols="60" id="txtkywrd" class="form-control"><?php echo stripslashes($rowsstr_loc_mst['strlocm_seokywrd']);?></textarea>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>SEO H1 Title</label>
							</div>
							<div class="col-sm-9">
								<input type="text" name="txtseoh1tle" id="txtseoh1tle" size="45" maxlength="250" class="form-control" value="<?php echo $rowsstr_loc_mst['strlocm_seohonetitle'];?>">
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>SEO H1 Description</label>
							</div>
							<div class="col-sm-9">
								<textarea name="txtseoh1desc" rows="3" cols="60" id="txtseoh1desc" class="form-control"><?php echo stripslashes($rowsstr_loc_mst['strlocm_seohonedesc']);?></textarea>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>SEO H2 Title</label>
							</div>
							<div class="col-sm-9">
								<input type="text" name="txtseoh2tle" id="txtseoh2tle" size="45" maxlength="250" class="form-control" value="<?php echo $rowsstr_loc_mst['strlocm_seohtwotitle'];?>">
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>SEO H2 Description</label>
							</div>
							<div class="col-sm-9">
								<textarea name="txtseoh2desc" rows="3" cols="60" id="txtseoh2desc" class="form-control"><?php echo stripslashes($rowsstr_loc_mst['strlocm_seohtwodesc']);?></textarea>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Rank *</label>
							</div>
							<div class="col-sm-9"> 
								<input type="text" name="txtprior" id="txtprior" class="form-control" size="4" maxlength="3" value="<?php echo $rowsstr_loc_mst['strlocm_prty'];?>">
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
									<option value="a"<?php if($rowsstr_loc_mst['strlocm_sts']=='a') echo 'selected';?>>Active</option>
									<option value="i"<?php if($rowsstr_loc_mst['strlocm_sts']=='i') echo 'selected';?>>Inactive</option>
								</select>
							</div>
						</div>
					</div>
					<p class="text-center">
						<input type="Submit" class="btn btn-primary btn-cst" name="btnestrlocsbmt" id="btnestrlocsbmt" value="Submit">
						&nbsp;&nbsp;&nbsp;
						<input type="reset" class="btn btn-primary btn-cst" name="btnstrlocreset" value="Clear" id="btnstrlocreset">
						&nbsp;&nbsp;&nbsp;
						<input type="button" name="btnBack" value="Back" class="btn btn-primary btn-cst" onclick="location.href='<?php echo $rd_vwpgnm;?>?vw=<?php echo $id;?>&pg=<?php echo $pg;?>&countstart=<?php echo $countstart.$loc;?>'">
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