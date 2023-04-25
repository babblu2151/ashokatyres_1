<?php
include_once '../includes/inc_config.php'; //Making paging validation
include_once $inc_nocache; //Clearing the cache information
include_once $adm_session; //checking for session
include_once $inc_cnctn; //Making database Connection
include_once $inc_usr_fnctn; //checking for session 
include_once $inc_pgng_fnctns; //Making paging validation
include_once $inc_fldr_pth; //Making paging validation
/**********************************************************
Programm : add_loc_usr.php 
Purpose : For add Users to locations
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
global $gmsg; 
if(isset($_POST['btnlocusrsbmt']) && (trim($_POST['btnlocusrsbmt']) != "") && isset($_POST['lststrloc']) && (trim($_POST['lststrloc']) != "") && isset($_POST['txtname']) && (trim($_POST['txtname']) != "") && isset($_POST['txtcnfpwd']) && (trim($_POST['txtcnfpwd']) != ""))
{
  include_once "../database/iqry_loc_usr_mst.php";
}
$rd_crntpgnm = "view_all_users.php";
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
		if(strlocid!="" && name != "")
		{
			var url = "chkduplicate.php?username="+name+"&strlocid="+strlocid;
			xmlHttp = GetXmlHttpObject(stateChanged);
			xmlHttp.open("GET", url , true);
			xmlHttp.send(null);
		}
		else
		{
			document.getElementById('errorsDiv_lststrloc').innerHTML = "";
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
</script>
<?php include_once $inc_adm_hdr; ?>
<section class="content">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Add Location User</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Add Location User</li>
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
			<form name="frmaddlocusr" id="frmaddlocusr" method="post" action="<?php $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data" onSubmit="return performCheck('frmaddlocusr', rules, 'inline');">
				<div class="col-md-12">
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
										<option value="">--Select--</option>
										<?php
										if($cnt_str_loc > 0)
										{
											while($rowsstore_loc_mst = mysqli_fetch_assoc($rsstore_loc_mst))
											{
												$strlocid = $rowsstore_loc_mst['strlocm_id'];
												$strlocname = $rowsstore_loc_mst['strlocm_name'];
												?>
												<option value="<?php echo $strlocid;?>"><?php echo $strlocname;?></option>
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
									<label>User Name *</label>
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
									<label>Password *</label>
								</div>
								<div class="col-sm-9">
									<input name="txtpwd" type="password" id="txtpwd" size="45" maxlength="40" class="form-control">
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
									<input name="txtcnfpwd" type="password" id="txtcnfpwd" size="45" maxlength="40" class="form-control">
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
										<option value="a" selected>Active</option>
										<option value="i">Inactive</option>
									</select>
								</div>
							</div>
						</div>
						<p class="text-center">
							<input type="Submit" class="btn btn-primary" name="btnlocusrsbmt" id="btnlocusrsbmt" value="Submit">
							&nbsp;&nbsp;&nbsp;
							<input type="reset" class="btn btn-primary" name="btnlocusrreset" value="Clear" id="btnlocusrreset">
							&nbsp;&nbsp;&nbsp;
							<input type="button" name="btnBack" value="Back" class="btn btn-primary" onClick="location.href='<?php echo $rd_crntpgnm ;?>'">
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