<?php
include_once '../includes/inc_config.php'; //Making paging validation
include_once $inc_nocache; //Clearing the cache information
include_once $adm_session; //checking for session
include_once $inc_cnctn; //Making database Connection
include_once $inc_usr_fnctn; //checking for session	
include_once $inc_pgng_fnctns; //Making paging validation
include_once $inc_fldr_pth; //Making paging validation
/**********************************************************
Programm : edit_loc_usr.php 
Purpose : For Editing Location User Details
Created By : Bharath
Created On : 03-01-2022
Modified By : 
Modified On : 
Purpose : 
Company : Adroit
************************************************************/ 
/*****header link********/
$pagemncat = "Setup";
$pagecat = "Stores";
$pagenm = "Users";
/*****header link********/
global $id,$pg,$countstart;
$rd_vwpgnm = "view_all_users.php";
$rd_crntpgnm = "view_all_users.php";
$clspn_val = "4";
if(isset($_POST['btnelocusrsbmt']) && (trim($_POST['btnelocusrsbmt']) != "") && isset($_POST['lststrloc']) && (trim($_POST['lststrloc']) != "") && isset($_POST['txtname']) && (trim($_POST['txtname']) != "") && isset($_POST['txtcnfpwd']) && (trim($_POST['txtcnfpwd']) != ""))
{
	include_once "../database/uqry_loc_usr_mst.php";
}
if(isset($_REQUEST['edit']) && (trim($_REQUEST['edit'])!="") && isset($_REQUEST['pg']) && (trim($_REQUEST['pg'])!="") && isset($_REQUEST['countstart']) && (trim($_REQUEST['countstart'])!=""))
{
	$id = glb_func_chkvl($_REQUEST['edit']);
	$pg = glb_func_chkvl($_REQUEST['pg']);
	$countstart = glb_func_chkvl($_REQUEST['countstart']);
}
elseif(isset($_REQUEST['hdnlocusrid']) && (trim($_REQUEST['hdnlocusrid'])!="") && isset($_REQUEST['hdnpage']) && (trim($_REQUEST['hdnpage'])!="") && isset($_REQUEST['hdncnt']) && (trim($_REQUEST['hdncnt'])!=""))
{
	$id = glb_func_chkvl($_REQUEST['hdnlocusrid']);
	$pg = glb_func_chkvl($_REQUEST['hdnpage']);
	$countstart = glb_func_chkvl($_REQUEST['hdncnt']);
}
$sqrylocusr_mst = "SELECT lgnm_uid, lgnm_pwd, lgnm_store_id, lgnm_sts from lgn_mst where lgnm_id = $id";
$srslocusr_mst = mysqli_query($conn,$sqrylocusr_mst);
$cntrec = mysqli_num_rows($srslocusr_mst);
if($cntrec > 0)
{
	$rowslocusr_mst = mysqli_fetch_assoc($srslocusr_mst);
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
  rules[2]='txtpwd:Password|required|Enter Password';
	rules[3]='txtcnfpwd:Confirm Password|equal|$txtpwd|Passwords donot match';
	rules[4]='txtcnfpwd:Password|required|Enter Confirm Password';
  rules[5]='lststrloc:Store Location|required|Select Store Location';
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
		var strlocid = document.getElementById('lststrloc').value;
		id = <?php echo $id;?>;
		if(strlocid!="" && name != "")
		{
			var url = "chkduplicate.php?username="+name+"&strlocid="+strlocid+"&locusrid="+id;
			xmlHttp	= GetXmlHttpObject(stateChanged);
			xmlHttp.open("GET", url , true);
			xmlHttp.send(null);
		}
		else
		{
			document.getElementById('errorsDiv_txtname').innerHTML = "";
			document.getElementById('errorsDiv_lststrloc').innerHTML = "";
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
					<h1 class="m-0 text-dark">Edit Location User</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Edit Location User</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<form name="frmedtlocusr" id="frmedtlocusr" method="post" action="<?php $_SERVER['PHP_SELF'];?>" onSubmit="return performCheck('frmedtlocusr', rules, 'inline');" enctype="multipart/form-data">
		<input type="hidden" name="hdnlocusrid" value="<?php echo $id;?>">
		<input type="hidden" name="hdnpage" value="<?php echo $pg;?>">
		<input type="hidden" name="hdncnt" value="<?php echo $countstart?>">
		<input type="hidden" name="hdnloc" value="<?php echo $loc?>">
		<div class="card">
			<div class="card-body">
				<div class="row justify-content-center align-items-center">
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Location *</label>
							</div>
							<div class="col-sm-9">
								<?php
								$sqrystr_loc_mst = "SELECT strlocm_id, strlocm_name from store_loc_mst order by strlocm_name";
									$rsstore_loc_mst = mysqli_query($conn,$sqrystr_loc_mst);
									$cnt_str_loc = mysqli_num_rows($rsstore_loc_mst);
								?>
								<select name="lststrloc" id="lststrloc" onBlur="funcChkDupName()" class="form-control">
									<option value="">--Select Location--</option>
									<?php
									if($cnt_str_loc > 0)
									{
										while($rowsloc_usr_mst = mysqli_fetch_assoc($rsstore_loc_mst))
										{
											$strlocm_id = $rowsloc_usr_mst['strlocm_id'];
											$strlocm_name = $rowsloc_usr_mst['strlocm_name'];
											?>
											<option value="<?php echo $strlocm_id; ?>" <?php if($rowslocusr_mst['lgnm_store_id'] == $strlocm_id) echo 'selected';  ?>><?php echo $strlocm_name;?></option>
											<?php
										}
									}
									?>
								</select>
								<span id="errorsDiv_lststrloc"></span>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>user Name *</label>
							</div>
							<div class="col-sm-9">
								<input name="txtname" type="text" id="txtname" size="45" maxlength="40" onBlur="funcChkDupName()" class="form-control" value="<?php echo $rowslocusr_mst['lgnm_uid']; ?>">
								<span id="errorsDiv_txtname"></span>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Password *</label>
							</div>
							<div class="col-sm-9">
								<input name="txtpwd" type="password" id="txtpwd" size="45" maxlength="40" class="form-control" value="<?php echo $rowslocusr_mst['lgnm_pwd']; ?>">
								<span id="errorsDiv_txtpwd"></span>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Confirm Password *</label>
							</div>
							<div class="col-sm-9">
								<input name="txtcnfpwd" type="password" id="txtcnfpwd" size="45" maxlength="40" class="form-control" value="<?php echo $rowslocusr_mst['lgnm_pwd']; ?>">
								<span id="errorsDiv_txtcnfpwd"></span>
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
									<option value="a"<?php if($rowslocusr_mst['vehbrndm_sts']=='a') echo 'selected';?>>Active</option>
									<option value="i"<?php if($rowslocusr_mst['vehbrndm_sts']=='i') echo 'selected';?>>Inactive</option>
								</select>
								
							</div>
						</div>
					</div>
					<p class="text-center">
						<input type="Submit" class="btn btn-primary" name="btnelocusrsbmt" id="btnelocusrsbmt" value="Submit">
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