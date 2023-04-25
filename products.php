<?php
session_start();
include_once "includes/inc_config.php"; // site and  files confige
include_once "includes/inc_connection.php"; // database connection
include_once "includes/inc_usr_functions.php"; // user define functions(code reuse)
include_once "includes/inc_folder_path.php"; //  folder path confige
include_once "includes/inc_fnct_img_resize.php"; //image resize 
include_once "includes/inc_img_size.php"; //image size fix
include_once 'includes/inc_paging_functions.php'; //Making paging validation	
$rowsprpg = 4; //maximum rows per page		
$cntstart = 0;
include_once "includes/inc_paging1.php"; //Includes pagination
$loc = "";
error_reporting(0);
if (
	isset($_REQUEST['type']) && (trim($_REQUEST['type']) != "") or
	isset($_REQUEST['vehbrnd']) && (trim($_REQUEST['vehbrnd']) != "") or
	isset($_REQUEST['vehvarent']) && (trim($_REQUEST['vehvarent']) != "") or
	isset($_REQUEST['vehmodel']) && (trim($_REQUEST['vehmodel']) != "") or
	isset($_REQUEST['tyrbrnd']) && (trim($_REQUEST['tyrbrnd']) != "") or
	isset($_REQUEST['rimsz']) && (trim($_REQUEST['rimsz']) != "") or
	isset($_REQUEST['tyrprfl']) && (trim($_REQUEST['tyrprfl']) != "") or
	isset($_REQUEST['tyrwdth']) && (trim($_REQUEST['tyrwdth']) != "") or
	isset($_REQUEST['txtsrchval']) && (trim($_REQUEST['txtsrchval']) != '')
) {
	$sqlprd_mst1 = "SELECT prodm_id, prodm_sku, prodm_code, prodm_name, prodm_size, prodm_ptrn, prodm_cstprc, prodm_sleprc, prodm_ofrprc, prodm_dsc, prodm_sdsc, prodm_st, prodm_sky, prodm_sotl, prodm_sodsc, prodm_sttle, prodm_stdsc, prodm_sts, prodm_rnk,vehtypm_id, vehtypm_name, vehtypm_desc, vehtypm_seotitle, vehtypm_seodesc, vehtypm_seokywrd, vehtypm_seohonetitle, vehtypm_seohonedesc, vehtypm_seohtwotitle, vehtypm_seohtwodesc, vehtypm_sts, vehtypm_prty,vehbrndm_id, vehbrndm_name, vehbrndm_desc, vehbrndm_vehtypm_id, vehbrndm_brndimg, vehbrndm_sts, vehbrndm_prty, vehbrndm_seotitle, vehbrndm_seodesc, vehbrndm_seokywrd, vehbrndm_seohonetitle, vehbrndm_seohonedesc, vehbrndm_seohtwotitle, vehbrndm_seohtwodesc, vehmodlm_id, vehmodlm_name,vehvrntm_id, vehvrntm_name,tyrprflm_id,tyrprflm_name, tyrrmszm_id,tyrrmszm_name,tyrwdthm_id,tyrwdthm_name,tyrbrndm_id,tyrbrndm_name
	from prod_mst
		inner join prod_veh_dtl on prod_veh_dtl.prodd_prodm_id	= prod_mst.prodm_id
		LEFT join veh_type_mst on veh_type_mst.vehtypm_id=	prod_veh_dtl.prodd_veh_typ
		LEFT join veh_brnd_mst on veh_brnd_mst.vehbrndm_id=prod_veh_dtl.prodd_veh_brnd
		LEFT join veh_vrnt_mst on  veh_vrnt_mst.vehvrntm_id=prod_veh_dtl.prodd_veh_vrnt
		LEFT join veh_model_mst on veh_model_mst.vehmodlm_id=prod_veh_dtl.prodd_veh_mdl	
		inner join tyr_brnd_mst on tyr_brnd_mst.tyrbrndm_id = prod_mst.prodm_tyr_brnd
		inner join tyr_wdth_mst on tyr_wdth_mst.tyrwdthm_id = prod_mst.prodm_tyrwdth		
		inner join tyr_rimsize_mst on tyr_rimsize_mst.tyrrmszm_id = prod_mst.prodm_tyrrmsz
		inner join tyr_prfl_mst on tyr_prfl_mst.tyrprflm_id = prod_mst.prodm_tyrprfl
	where prodm_id !='' and prodm_sts ='a' and vehtypm_sts='a' and vehbrndm_sts='a' and vehmodlm_sts='a' and vehvrntm_sts='a' and tyrprflm_sts='a' and tyrrmszm_sts='a' and tyrwdthm_sts='a' and tyrbrndm_sts='a'";
	if (isset($_REQUEST['type']) && (trim($_REQUEST['type']) != "")) {
		$vehtypenm = glb_func_chkvl($_REQUEST['type']);
		$vehtypenm = funcStrUnRplc($vehtypenm);
		$sqlprd_mst1 .= "and vehtypm_name='$vehtypenm'";
		//$loc		 .= "&type=$vehtypenm";	
	}
	if (isset($_REQUEST['vehbrnd']) && (trim($_REQUEST['vehbrnd']) != "")) {
		$vehbrnd = glb_func_chkvl($_REQUEST['vehbrnd']);
		$vehbrnd = funcStrUnRplc($vehbrnd);
		$sqlprd_mst1 .= "and vehbrndm_name='$vehbrnd'";
		//$sqlprd_mst1 .="and '$vehbrnd' IN(vehbrndm_name)";
	}
	if (isset($_REQUEST['vehvarent']) && (trim($_REQUEST['vehvarent']) != "")) {
		$vehvent = glb_func_chkvl($_REQUEST['vehvarent']);
		$vehbrnd = funcStrUnRplc($vehvent);
		$sqlprd_mst1 .= "and vehvrntm_name='$vehvent'";
		//$sqlprd_mst1 .="and '$vehvent ' IN(vehvrntm_name)";
	}
	if (isset($_REQUEST['vehmodel']) && (trim($_REQUEST['vehmodel']) != "")) {
		$vehmodl = glb_func_chkvl($_REQUEST['vehmodel']);
		$vehmodl = funcStrUnRplc($vehmodl);
		$sqlprd_mst1 .= "and vehmodlm_name='$vehmodl'";
		//$sqlprd_mst1 .="and '$vehmodl' IN(vehmodlm_name)";
	}
	if (isset($_REQUEST['tyrbrnd']) && (trim($_REQUEST['tyrbrnd']) != "")) {
		$tyrbrnd = glb_func_chkvl($_REQUEST['tyrbrnd']);
		$tyrbrnd = funcStrUnRplc($tyrbrnd);
		$sqlprd_mst1 .= "and tyrbrndm_name='$tyrbrnd'";
	}
	if (isset($_REQUEST['rimsz']) && (trim($_REQUEST['rimsz']) != "")) {
		$tyrrimsz = glb_func_chkvl($_REQUEST['rimsz']);
		$tyrrimsz = funcStrUnRplc($tyrrimsz);
		$sqlprd_mst1 .= "and tyrrmszm_name='$tyrrimsz'";
	}
	if (isset($_REQUEST['tyrprfl']) && (trim($_REQUEST['tyrprfl']) != "")) {
		$tyrprf = glb_func_chkvl($_REQUEST['tyrprfl']);
		$tyrprf = funcStrUnRplc($tyrprf);
		$sqlprd_mst1 .= "and tyrprflm_name='$tyrprf'";
	}
	if (isset($_REQUEST['tyrwdth']) && (trim($_REQUEST['tyrwdth']) != "")) {
		$tyrwdth = glb_func_chkvl($_REQUEST['tyrwdth']);
		$tyrwdth = funcStrUnRplc($tyrwdth);
		$sqlprd_mst1 .= "and tyrwdthm_name='$tyrwdth'";
	}
	$sqlprd_mst2 = " group by prodm_id order by prodm_rnk ";
	$sqlprd_mst = $sqlprd_mst1 . $sqlprd_mst2;
	$_SESSION['sesprodqry'] = $sqlprd_mst1;
	$_SESSION['sesprodqry_load'] = $sqlprd_mst1;
}
$srsprod_mst = mysqli_query($conn, $sqlprd_mst);
$cntrec_prod = mysqli_num_rows($srsprod_mst);
$page_title = "Ashoka Tyres | Home";
$page_seo_title = "Ashoka Tyres | Home";
$db_seokywrd = "";
$db_seodesc = "";
$current_page = "home";
$body_class = "homepage";
if ($cntrec_prod == 1) {
	// $lnkname	  = "$rtpth$db_uprodcatnm/$db_uprodscatnm/$db_uprodnm/$prod_ucode";
	if ($rdvl != '') {
		$lnkname .= "/?$rdvl";
	}
	/*	  echo "<script>";
	echo "location.href='$lnkname'";
	echo "</script>";
	exit();*/
}
include('header.php');
?>
<div class="page-content bg-white">
	<!-- Banner  -->
	<div class="dlab-bnr-inr style-1 overlay-black-middle" style="background-image: url(images/banner/bnr1.jpg);">
		<div class="container">
			<div class="dlab-bnr-inr-entry">
				<h1 class="text-white">Car Tyres</h1>
				<div class="d-flex justify-content-center align-items-center">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item active" aria-current="page">Car Tyres</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
	</div>
	<section class="content-inner-2">
		<div class="container">
			<div class="row">
				<div class="col-xl-3 col-lg-3 m-b30">
					<aside class="side-bar sticky-top left">
						<div class="section-head">
							<h4 class="title">ADVANCED SEARCH</h4>
							<div class="dlab-separator style-1 text-primary mb-0"></div>
						</div>
						<form>
							<div class="widget widget_search">
								<input type="hidden" value="<?php echo trim($_REQUEST['type']); ?>" id="vechtye" name="vechtye" />
								<?php if (!isset($_REQUEST['vehbrnd']) && $_REQUEST['vehbrnd'] == "") { ?>
									<div class="form-group m-b20">
										<select class="form-control" id="vehbrndflt" onchange="funcfltvechtype(),funcfltvechbrnd()">
											<option value="">All Vehicle Brand</option>
											<?php
											$sqlprdtyrbrnd_mst1 = "SELECT prodm_id, prodm_sku, prodm_code, prodm_name,vehbrndm_id, vehbrndm_name from prod_mst
												inner join prod_veh_dtl on prod_veh_dtl.prodd_prodm_id	= prod_mst.prodm_id
												LEFT join veh_type_mst on veh_type_mst.vehtypm_id=	prod_veh_dtl.prodd_veh_typ
												LEFT join veh_brnd_mst on veh_brnd_mst.vehbrndm_id=prod_veh_dtl.prodd_veh_brnd
												LEFT join veh_vrnt_mst on  veh_vrnt_mst.vehvrntm_id=prod_veh_dtl.prodd_veh_vrnt
												LEFT join veh_model_mst on veh_model_mst.vehmodlm_id=prod_veh_dtl.prodd_veh_mdl	
												inner join tyr_brnd_mst on tyr_brnd_mst.tyrbrndm_id = prod_mst.prodm_tyr_brnd
												inner join tyr_wdth_mst on tyr_wdth_mst.tyrwdthm_id = prod_mst.prodm_tyrwdth		
												inner join tyr_rimsize_mst on tyr_rimsize_mst.tyrrmszm_id = prod_mst.prodm_tyrrmsz
												inner join tyr_prfl_mst on tyr_prfl_mst.tyrprflm_id = prod_mst.prodm_tyrprfl
											where prodm_id !='' and prodm_sts ='a' and vehtypm_sts='a' and vehbrndm_sts='a' and vehmodlm_sts='a' and vehvrntm_sts='a' and tyrprflm_sts='a' and tyrrmszm_sts='a' and tyrwdthm_sts='a' and tyrbrndm_sts='a'";
											if (isset($_REQUEST['type']) && (trim($_REQUEST['type']) != "")) {
												$vehtypenm = glb_func_chkvl($_REQUEST['type']);
												$vehtypenm = funcStrUnRplc($vehtypenm);
												$sqlprdtyrbrnd_mst1 .= "and vehtypm_name='$vehtypenm'";
												//$loc		 .= "&type=$vehtypenm";	
											}
											if (isset($_REQUEST['vehbrnd']) && (trim($_REQUEST['vehbrnd']) != "")) {
												$vehbrnd = glb_func_chkvl($_REQUEST['vehbrnd']);
												$vehbrnd = funcStrUnRplc($vehbrnd);
												$sqlprdtyrbrnd_mst1 .= "and vehbrndm_name='$vehbrnd'";
												//$sqlprdtyrbrnd_mst1 .="and '$vehbrnd' IN(vehbrndm_name)";
											}
											if (isset($_REQUEST['vehvarent']) && (trim($_REQUEST['vehvarent']) != "")) {
												$vehvent = glb_func_chkvl($_REQUEST['vehvarent']);
												$vehbrnd = funcStrUnRplc($vehvent);
												$sqlprdtyrbrnd_mst1 .= "and vehvrntm_name='$vehvent'";
												//$sqlprdtyrbrnd_mst1 .="and '$vehvent ' IN(vehvrntm_name)";
											}
											if (isset($_REQUEST['vehmodel']) && (trim($_REQUEST['vehmodel']) != "")) {
												$vehmodl = glb_func_chkvl($_REQUEST['vehmodel']);
												$vehmodl = funcStrUnRplc($vehmodl);
												$sqlprdtyrbrnd_mst1 .= "and vehmodlm_name='$vehmodl'";
												//$sqlprdtyrbrnd_mst1 .="and '$vehmodl' IN(vehmodlm_name)";
											}
											if (isset($_REQUEST['rimsz']) && (trim($_REQUEST['rimsz']) != "")) {
												$tyrrimsz = glb_func_chkvl($_REQUEST['rimsz']);
												$tyrrimsz = funcStrUnRplc($tyrrimsz);
												$sqlprdtyrbrnd_mst1 .= "and tyrrmszm_name='$tyrrimsz'";
											}
											if (isset($_REQUEST['tyrprfl']) && (trim($_REQUEST['tyrprfl']) != "")) {
												$tyrprf = glb_func_chkvl($_REQUEST['tyrprfl']);
												$tyrprf = funcStrUnRplc($tyrprf);
												$sqlprdtyrbrnd_mst1 .= "and tyrprflm_name='$tyrprf'";
											}
											if (isset($_REQUEST['tyrwdth']) && (trim($_REQUEST['tyrwdth']) != "")) {
												$tyrwdth = glb_func_chkvl($_REQUEST['tyrwdth']);
												$tyrwdth = funcStrUnRplc($tyrwdth);
												$sqlprd_mst1 .= "and tyrwdthm_name='$tyrwdth'";
											}
											$sqlprdtyrbrnd_mst1 .= " group by vehbrndm_id  order by  vehbrndm_prty desc";
											$sqlprdtyrbrnd_mst = mysqli_query($conn, $sqlprdtyrbrnd_mst1);
											$cntrec_prodtyrbrnd = mysqli_num_rows($sqlprdtyrbrnd_mst);
											if ($cntrec_prodtyrbrnd > 0) {
												$cnt = 0;
												mysqli_data_seek($sqlprdtyrbrnd_mst, 0);
												while ($srowsprodtyrbrnd_mst = mysqli_fetch_assoc($sqlprdtyrbrnd_mst)) {
													?>
													<option value="<?php echo $srowsprodtyrbrnd_mst['vehbrndm_name']; ?>"
														data-select2-id="<?php echo $srowsprodtyrbrnd_mst['vehbrndm_name']; ?>"><?php echo $srowsprodtyrbrnd_mst['vehbrndm_name']; ?></option>
												<?php }
											} ?>
										</select>
									</div>
								<?php } else { ?>
									<input type="hidden" value="<?php echo $_REQUEST['vehbrnd']; ?>" id="vehbrndflt" />
								<?php } ?>
								<?php if (isset($_REQUEST['vehbrnd']) && $_REQUEST['vehbrnd'] != "") { ?>
									<div class="form-group m-b20">
										<select class="form-control" id="tyrvehmodlflt" onchange="funcfltvechmold()">
											<option value=""> All Vehicle Models</option>
											<?php
											$sqlprdtyrbrnd_mst1 = "SELECT  prodm_id, prodm_sku, prodm_code, prodm_name, vehmodlm_id, vehmodlm_name from prod_mst
												inner join prod_veh_dtl on prod_veh_dtl.prodd_prodm_id	= prod_mst.prodm_id
												LEFT join veh_type_mst on veh_type_mst.vehtypm_id=	prod_veh_dtl.prodd_veh_typ
												LEFT join veh_brnd_mst on veh_brnd_mst.vehbrndm_id=prod_veh_dtl.prodd_veh_brnd
												LEFT join veh_vrnt_mst on  veh_vrnt_mst.vehvrntm_id=prod_veh_dtl.prodd_veh_vrnt
												LEFT join veh_model_mst on veh_model_mst.vehmodlm_id=prod_veh_dtl.prodd_veh_mdl	
												inner join tyr_brnd_mst on tyr_brnd_mst.tyrbrndm_id = prod_mst.prodm_tyr_brnd
												inner join tyr_wdth_mst on tyr_wdth_mst.tyrwdthm_id = prod_mst.prodm_tyrwdth		
												inner join tyr_rimsize_mst on tyr_rimsize_mst.tyrrmszm_id = prod_mst.prodm_tyrrmsz
												inner join tyr_prfl_mst on tyr_prfl_mst.tyrprflm_id = prod_mst.prodm_tyrprfl
											where prodm_id !='' and prodm_sts ='a' and vehtypm_sts='a' and vehbrndm_sts='a' and vehmodlm_sts='a' and vehvrntm_sts='a' and tyrprflm_sts='a' and tyrrmszm_sts='a' and tyrwdthm_sts='a' and tyrbrndm_sts='a'";
											if (isset($_REQUEST['type']) && (trim($_REQUEST['type']) != "")) {
												$vehtypenm = glb_func_chkvl($_REQUEST['type']);
												$vehtypenm = funcStrUnRplc($vehtypenm);
												$sqlprdtyrbrnd_mst1 .= "and vehtypm_name='$vehtypenm'";
												//$loc		 .= "&type=$vehtypenm";	
											}
											if (isset($_REQUEST['vehbrnd']) && (trim($_REQUEST['vehbrnd']) != "")) {
												$vehbrnd = glb_func_chkvl($_REQUEST['vehbrnd']);
												$vehbrnd = funcStrUnRplc($vehbrnd);
												$sqlprdtyrbrnd_mst1 .= "and vehbrndm_name='$vehbrnd'";
												//$sqlprdtyrbrnd_mst1 .="and '$vehbrnd' IN(vehbrndm_name)";
											}
											if (isset($_REQUEST['vehvarent']) && (trim($_REQUEST['vehvarent']) != "")) {
												$vehvent = glb_func_chkvl($_REQUEST['vehvarent']);
												$vehbrnd = funcStrUnRplc($vehvent);
												$sqlprdtyrbrnd_mst1 .= "and vehvrntm_name='$vehvent'";
												//$sqlprdtyrbrnd_mst1 .="and '$vehvent ' IN(vehvrntm_name)";
											}
											if (isset($_REQUEST['vehmodel']) && (trim($_REQUEST['vehmodel']) != "")) {
												$vehmodl = glb_func_chkvl($_REQUEST['vehmodel']);
												$vehmodl = funcStrUnRplc($vehmodl);
												$sqlprdtyrbrnd_mst1 .= "and vehmodlm_name='$vehmodl'";
												//$sqlprdtyrbrnd_mst1 .="and '$vehmodl' IN(vehmodlm_name)";
											}
											if (isset($_REQUEST['rimsz']) && (trim($_REQUEST['rimsz']) != "")) {
												$tyrrimsz = glb_func_chkvl($_REQUEST['rimsz']);
												$tyrrimsz = funcStrUnRplc($tyrrimsz);
												$sqlprdtyrbrnd_mst1 .= "and tyrrmszm_name='$tyrrimsz'";
											}
											if (isset($_REQUEST['tyrprfl']) && (trim($_REQUEST['tyrprfl']) != "")) {
												$tyrprf = glb_func_chkvl($_REQUEST['tyrprfl']);
												$tyrprf = funcStrUnRplc($tyrprf);
												$sqlprdtyrbrnd_mst1 .= "and tyrprflm_name='$tyrprf'";
											}
											if (isset($_REQUEST['tyrwdth']) && (trim($_REQUEST['tyrwdth']) != "")) {
												$tyrwdth = glb_func_chkvl($_REQUEST['tyrwdth']);
												$tyrwdth = funcStrUnRplc($tyrwdth);
												$sqlprd_mst1 .= "and tyrwdthm_name='$tyrwdth'";
											}
											$sqlprdtyrbrnd_mst1 .= " group by vehmodlm_id  order by  vehmodlm_prty desc";
											$sqlprdtyrbrnd_mst = mysqli_query($conn, $sqlprdtyrbrnd_mst1);
											$cntrec_prodtyrbrnd = mysqli_num_rows($sqlprdtyrbrnd_mst);
											if ($cntrec_prodtyrbrnd > 0) {
												$cnt = 0;
												mysqli_data_seek($sqlprdtyrbrnd_mst, 0);
												while ($srowsprodtyrbrnd_mst = mysqli_fetch_assoc($sqlprdtyrbrnd_mst)) {
													?>
													<option value="<?php echo $srowsprodtyrbrnd_mst['vehmodlm_name']; ?>"
														data-select2-id="<?php echo $srowsprodtyrbrnd_mst['vehmodlm_name']; ?>"><?php echo $srowsprodtyrbrnd_mst['vehmodlm_name']; ?></option>
												<?php }
											} ?>
										</select>
									</div>
								<?php } else { ?>
									<div class="form-group m-b20">
										<select class="form-control" id="tyrvehmodlflt" onchange="funcfltvechmold()">
											<option value=""> Vehicle Models</option>
										</select>
									</div>
								<?php } ?>
								<div class="form-group m-b20">
									<select class="form-control" id="tyrvehvarntflt" name="tyrvehvarntflt">
										<option value=""> Vehicle Varient</option>
									</select>
								</div>
								<div class="form-group m-b20">
									<select class="form-control" id="tyrbrndflt"
										onchange="funcfltvechtype('<?php echo $_REQUEST['type']; ?>');">
										<option value=""> All Tyre Brand</option>
										<?php
										$sqlprdtyrbrnd_mst1 = "SELECT prodm_id, prodm_sku, prodm_code, prodm_name,tyrbrndm_id,tyrbrndm_name from prod_mst
											inner join prod_veh_dtl on prod_veh_dtl.prodd_prodm_id	= prod_mst.prodm_id
											LEFT join veh_type_mst on veh_type_mst.vehtypm_id=	prod_veh_dtl.prodd_veh_typ
											LEFT join veh_brnd_mst on veh_brnd_mst.vehbrndm_id=prod_veh_dtl.prodd_veh_brnd
											LEFT join veh_vrnt_mst on  veh_vrnt_mst.vehvrntm_id=prod_veh_dtl.prodd_veh_vrnt
											LEFT join veh_model_mst on veh_model_mst.vehmodlm_id=prod_veh_dtl.prodd_veh_mdl	
											inner join tyr_brnd_mst on tyr_brnd_mst.tyrbrndm_id = prod_mst.prodm_tyr_brnd
											inner join tyr_wdth_mst on tyr_wdth_mst.tyrwdthm_id = prod_mst.prodm_tyrwdth		
											inner join tyr_rimsize_mst on tyr_rimsize_mst.tyrrmszm_id = prod_mst.prodm_tyrrmsz
											inner join tyr_prfl_mst on tyr_prfl_mst.tyrprflm_id = prod_mst.prodm_tyrprfl
										where prodm_id !='' and prodm_sts ='a' and vehtypm_sts='a' and vehbrndm_sts='a' and vehmodlm_sts='a' andvehvrntm_sts='a' and tyrprflm_sts='a' and tyrrmszm_sts='a' and tyrwdthm_sts='a' and tyrbrndm_sts='a'";
										if (isset($_REQUEST['type']) && (trim($_REQUEST['type']) != "")) {
											$vehtypenm = glb_func_chkvl($_REQUEST['type']);
											$vehtypenm = funcStrUnRplc($vehtypenm);
											$sqlprdtyrbrnd_mst1 .= "and vehtypm_name='$vehtypenm'";
											//$loc		 .= "&type=$vehtypenm";	
										}
										if (isset($_REQUEST['vehbrnd']) && (trim($_REQUEST['vehbrnd']) != "")) {
											$vehbrnd = glb_func_chkvl($_REQUEST['vehbrnd']);
											$vehbrnd = funcStrUnRplc($vehbrnd);
											$sqlprdtyrbrnd_mst1 .= "and vehbrndm_name='$vehbrnd'";
											//$sqlprdtyrbrnd_mst1 .="and '$vehbrnd' IN(vehbrndm_name)";
										}
										if (isset($_REQUEST['vehvarent']) && (trim($_REQUEST['vehvarent']) != "")) {
											$vehvent = glb_func_chkvl($_REQUEST['vehvarent']);
											$vehbrnd = funcStrUnRplc($vehvent);
											$sqlprdtyrbrnd_mst1 .= "and vehvrntm_name='$vehvent'";
											//$sqlprdtyrbrnd_mst1 .="and '$vehvent ' IN(vehvrntm_name)";
										}
										if (isset($_REQUEST['vehmodel']) && (trim($_REQUEST['vehmodel']) != "")) {
											$vehmodl = glb_func_chkvl($_REQUEST['vehmodel']);
											$vehmodl = funcStrUnRplc($vehmodl);
											$sqlprdtyrbrnd_mst1 .= "and vehmodlm_name='$vehmodl'";
											//$sqlprdtyrbrnd_mst1 .="and '$vehmodl' IN(vehmodlm_name)";
										}
										if (isset($_REQUEST['rimsz']) && (trim($_REQUEST['rimsz']) != "")) {
											$tyrrimsz = glb_func_chkvl($_REQUEST['rimsz']);
											$tyrrimsz = funcStrUnRplc($tyrrimsz);
											$sqlprdtyrbrnd_mst1 .= "and tyrrmszm_name='$tyrrimsz'";
										}
										if (isset($_REQUEST['tyrprfl']) && (trim($_REQUEST['tyrprfl']) != "")) {
											$tyrprf = glb_func_chkvl($_REQUEST['tyrprfl']);
											$tyrprf = funcStrUnRplc($tyrprf);
											$sqlprdtyrbrnd_mst1 .= "and tyrprflm_name='$tyrprf'";
										}
										if (isset($_REQUEST['tyrwdth']) && (trim($_REQUEST['tyrwdth']) != "")) {
											$tyrwdth = glb_func_chkvl($_REQUEST['tyrwdth']);
											$tyrwdth = funcStrUnRplc($tyrwdth);
											$sqlprd_mst1 .= "and tyrwdthm_name='$tyrwdth'";
										}
										$sqlprdtyrbrnd_mst1 .= " group by tyrbrndm_id  order by  tyrbrndm_prty desc";
										$sqlprdtyrbrnd_mst = mysqli_query($conn, $sqlprdtyrbrnd_mst1);
										$cntrec_prodtyrbrnd = mysqli_num_rows($sqlprdtyrbrnd_mst);
										if ($cntrec_prodtyrbrnd > 0) {
											$cnt = 0;
											mysqli_data_seek($sqlprdtyrbrnd_mst, 0);
											while ($srowsprodtyrbrnd_mst = mysqli_fetch_assoc($sqlprdtyrbrnd_mst)) {
												?>
												<option value="<?php echo $srowsprodtyrbrnd_mst['tyrbrndm_name']; ?>"
													data-select2-id="<?php echo $srowsprodtyrbrnd_mst['tyrbrndm_name']; ?>"><?php echo $srowsprodtyrbrnd_mst['tyrbrndm_name']; ?></option>
											<?php }
										} ?>
									</select>
								</div>
							</div>
							<div class="widget widget_price_range">
								<h5>Price </h5>
								<div class="price-slide range-slider">
									<div class="price">
										<label for="amount"></label>
										<input type="text" id="amount" class="amount me-auto" value="$200-$5000" />
										<div id="slider-range" class="mt-2"></div>
									</div>
								</div>
							</div>
							<div class="widget">
								<div class="form-group"> <a href="javascript:void(0);" class="btn btn-lg shadow-none btn-primary d-flex justify-content-between" onclick="funcchklprd()"> Find Tyres<i class="las la-long-arrow-alt-right"></i> </a> </div>
							</div>
						</form>
					</aside>
				</div>
				<div class="col-xl-9 col-lg-9" id="prodlist">
					<div class="catagory-result-row">
						<h5 class="serch-result">Showing <strong><?php echo $cntrec_prod; ?> products</strong></h5>
						<div>Sort by
							<select class="form-control custom-select ms-3" id="prdsort" onchange="funcchklprd()">
								<option value="">-select-</option>
								<option value="np">Newest</option>
								<option value="plp">Price: Lowest first</option>
								<option value="php">Price: Highest first </option>
								<option value="paz">Product Name: A to Z </option>
								<option value="pza">Product Name: Z to A </option>
								<option value="pis">In stock</option>
							</select>
						</div>
					</div>
					<div class="row lightgallery">
						<!----------------products start ------------>
						<?php
						if ($cntrec_prod > 0) {
							$cnt = 0;
							mysqli_data_seek($srsprod_mst, 0);
							while ($srowsprod_mst = mysqli_fetch_assoc($srsprod_mst)) {
								$prod_id = $srowsprod_mst['prodm_id'];
								$prodm_sku = $srowsprod_mst['prodm_sku'];
								$prod_code = $srowsprod_mst['prodm_code'];
								$prod_name = $srowsprod_mst['prodm_name'];
								$prod_desc = $srowsprod_mst['prodm_dsc'];
								$prod_size = $srowsprod_mst['prodm_size'];
								$prod_ptrn = $srowsprod_mst['prodm_ptrn'];
								$prod_cstprc = $srowsprod_mst['prodm_cstprc'];
								$prod_sleprc = $srowsprod_mst['prodm_sleprc'];
								$prod_ofrprc = $srowsprod_mst['prodm_ofrprc'];
								if ($prod_ofrprc != "" && $prod_ofrprc > 0)
								{
									$prod_fnlprc = $prod_ofrprc;
								}
								else
								{
									$prod_fnlprc = $prod_sleprc;
								}
								$prod_img = $srowsprod_mst['prodm_img'];
								$prod_st = $srowsprod_mst['prodm_st'];
								$prod_sdsc = $srowsprod_mst['prodm_sdsc'];
								$prod_sky = $srowsprod_mst['prodm_sky'];
								$prod_sotl = $srowsprod_mst['prodm_sotl'];
								$prod_sodsc = $srowsprod_mst['prodm_sodsc'];
								$prod_sttle = $srowsprod_mst['prodm_sttle'];
								$prod_stdsc = $srowsprod_mst['prodm_stdsc'];
								$vehtyp_name = $srowsprod_mst['vehtypm_name'];
								$vehtyp_desc = $srowsprod_mst['vehtypm_desc'];
								$vehtyp_seotitle = $srowsprod_mst['vehtypm_seotitle'];
								$vehtyp_seodesc = $srowsprod_mst['vehtypm_seodesc'];
								$vehtyp_seokywrd = $srowsprod_mst['vehtypm_seokywrd'];
								$vehbrnd_name = $srowsprod_mst['vehbrndm_name'];
								$vehbrnd_desc = $srowsprod_mst['vehbrndm_desc'];
								$vehbrnd_brndimg = $srowsprod_mst['vehbrndm_brndimg'];
								$vehbrnd_seotitle = $srowsprod_mst['vehbrndm_seotitle'];
								$vehbrnd_seodesc = $srowsprod_mst['vehbrndm_seodesc'];
								$vehbrnd_seokywrd = $srowsprod_mst['vehbrndm_seokywrd'];
								$vehvrnt_name = $srowsprod_mst['vehvrntm_name'];
								$vehmodl_name = $srowsprod_mst['vehmodlm_name'];
								$vehtyrebrnd_name = $srowsprod_mst['tyrbrndm_name'];
								$vehtyrebrnd_id = $srowsprod_mst['tyrbrndm_id'];
								$db_uprodnm = funcStrRplc($prod_name);
								if (preg_match('/[-]/', $srowsprod_mst['prodm_code'])) {
									$prod_ucode = funcStrRplcuscr($srowsprod_mst['prodm_code']);
								} else {
									$prod_ucode = funcStrRplc($srowsprod_mst['prodm_code']);
								}
								$db_uprodvehnm = funcStrRplc($vehtyp_name);
								$db_uprodvehbrndnm = funcStrRplc($vehbrnd_name);
								$lnkname = "$rtpth$db_uprodvehnm/$db_uprodvehbrndnm/$db_uprodnm/$prod_ucode";
								if ($rdvl != '') {
									$lnkname .= "/?$rdvl";
								}
								$sqlimgdtl = "SELECT prodimgd_simg from prodimg_dtl where prodimgd_prodm_id = $prod_id and prodimgd_sts = 'a' order by prodimgd_prty desc";
								$resimgdtl = mysqli_query($conn, $sqlimgdtl);
								$rwsimgdtl = mysqli_fetch_array($resimgdtl);
								$smlImgNm = $rwsimgdtl['prodimgd_simg'];
								$smlImgPth = $gprodsimg_usrpth . $smlImgNm . '.jpg';
								if (file_exists($smlImgPth))
								{
									$smlImgPth = $rtpth.$gprodsimg_usrpth . $smlImgNm . '.jpg';
								}
								else
								{
									$smlImgPth = $rtpth.'images/ashoka-no-image.jpg';
								}
								$sqry_loc = "SELECT strlocm_id, strlocm_name from store_loc_mst where strlocm_sts = 'a' order by strlocm_id ASC";
								$srslocdtls = mysqli_query($conn, $sqry_loc);
								$loc_cnt = mysqli_num_rows($srslocdtls);
								$loc_id = array();
								$loc_nm = array();
								$dat = date('Y-m-d');
								$prdinvt = 0;
								while ($rwslocdtls = mysqli_fetch_assoc($srslocdtls)) {
									$loc = $rwslocdtls['strlocm_id'];
									$loc_name = $rwslocdtls['strlocm_name'];
									$loc_id[] = $loc;
									$loc_nm[] = $loc_name;
									$sqryclsbls = "SELECT prdinvt_clsbls from product_inventory where prdinvt_prdid = $prod_id and prdinvt_dat <='$dat' and prdinvt_lcn = '$loc' order by prdinvt_id DESC limit 1";
									$srsclsbls = mysqli_query($conn, $sqryclsbls);
									$prod_clscnt = mysqli_num_rows($srsclsbls);
									$rwsclsbls = mysqli_fetch_assoc($srsclsbls);
									@$prdinvt += $rwsclsbls['prdinvt_clsbls'];
								}
								$prod_id;
								$clsbls = $prdinvt;
								// if($flitramt >=$minval && $flitramt <= $maxval){ ?>
								<div class="col-lg-4 col-md-4 col-sm-6 col-12 m-b30">
									<?php
									if ($clsbls < 1)
									{ ?>
										<div class="align-items-center bg-primary p-2 text-white text-center" width="100%"><strong>Out of stock</strong></div>
										<?php
									}
									?>
									<a href="product-display.php?vehtyp=<?php echo $vehtyp_name ?>&vehbrnd=<?php echo $vehbrnd_name ?>&vehmodel=<?php echo $vehmodl_name ?>&vechvarnt=<?php echo $vehvrnt_name ?>&prdcod=<?php echo $prod_code ?>">
										<div class="car-list-box list-view">
											<div class="media-box"> <img src="<?php echo $smlImgPth; ?>" alt="">
												<div class="overlay-bx"> <span data-exthumbimage="<?php echo $smlImgPth; ?>" data-src="<?php echo $smlImgPth; ?>" class="view-btn lightimg"> </span></div>
											</div>
											<div class="list-info">
												<h6 class="title mb-0"><a href="product-display.php?vehtyp=<?php echo $vehtyp_name ?>&vehbrnd=<?php echo $vehbrnd_name ?>&vehmodel=<?php echo $vehmodl_name ?>&vechvarnt=<?php echo $vehvrnt_name ?>&prdcod=<?php echo $prod_code ?>" data-splitting class="text-white"><?php echo $prod_name ?> </a></h6>
												<div class="car-type">Sku:
													<?php echo $prodm_sku ?><br />
													Tyre Brand:
													<?php echo $vehtyrebrnd_name ?>
													<br />
													<!--Vehicle Brand: <?php echo $vehbrnd_name ?>-->
												</div>
												<div class="d-flex justify-content-between align-items-center"> <span
														class="badge m-b10 mr-rt-5"><span>₹</span>
														<?php echo $prod_fnlprc ?>
													</span>
													<a href="product-display.php?vehtyp=<?php echo $vehtyp_name ?>&vehbrnd=<?php echo $vehbrnd_name ?>&vehmodel=<?php echo $vehmodl_name ?>&vechvarnt=<?php echo $vehvrnt_name ?>&prdcod=<?php echo $prod_code ?>"
														class="m-b10 view-details-btn btn btn-primary light phone-no shadow-none effect-1 w-100 text-center d-block"><span>Details</span></a>
												</div>
												<div class="prdt-prop mt-2">
													<div class="d-flex justify-content-stretch align-items-center">
														<div class="mr-rt-5">
															<div class="prop-container">
																<p>Low Noise</p>
																<i class="fas fa-volume-down"></i>
															</div>
														</div>
														<div class="mr-rt-5">
															<div class="prop-container">
																<p>Smooth Ride</p>
																<i class="fas fa-car-side"></i>
															</div>
														</div>
														<div class="">
															<div class="prop-container">
																<p>Dry & Wet Grip</p>
																<i class="fas fa-cloud"></i>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</a>
								</div>
							<?php //}
							}
						}
						?>
						<!----------------products------------>
					</div>
					<!--  <table>
					<?php
					$disppg = funcDispPag($conn, 'links', $loc, $sqlprd_mst1, $rowsprpg, $cntstart, $pgnum);
					$colspanval = $clspn_val + 6;
					if ($disppg != "") {
						$disppg = "<tr align='center'><td colspan='$colspanval' align='center' >$disppg</td></tr>";
						echo $disppg;
					}
					if ($msg != "") {
						$dispmsg = "<tr align='center'><td colspan='$colspanval' align='center' >$msg</td></tr>";
						echo $dispmsg;
					}
					?>
					</table>-->
					<nav aria-label="Blog Pagination">
						<ul class="pagination text-center m-b30">
							<!--<li class="page-item"><a class="page-link prev" href="javascript:void(0);"><i class="la la-angle-left"></i></a></li>
								<li class="page-item"><a class="page-link active" href="javascript:void(0);">1</a></li>
								<li class="page-item"><a class="page-link" href="javascript:void(0);">2</a></li>
								<li class="page-item"><a class="page-link" href="javascript:void(0);">3</a></li>
								<li class="page-item"><a class="page-link next" href="javascript:void(0);"><i class="la la-angle-right"></i></a></li>-->
						</ul>
					</nav>
				</div>
			</div>
		</div>
	</section>
</div>
</div>
<?php include_once('footer.php'); ?>
<script language="javascript" type="text/javascript">
	function funcchklprd() {
		var url = '';
		var prcflt = document.getElementById('amount').value;
		prcflt = prcflt.replace(/[$]/g, '');
		var vehbrnd = document.getElementById('vehbrndflt').value;
		var vehmodl = document.getElementById('tyrvehmodlflt').value;
		var tyrbrnd = document.getElementById('tyrbrndflt').value;
		var prdsort = document.getElementById('prdsort').value;
		var varntflt = document.getElementById('tyrvehvarntflt').value;
		if ((prdsort != '')) {
			if (url == "") {
				url += "prdsort=" + prdsort;
			} else {
				url += "&prdsort=" + prdsort;
			}
		}
		if ((prcflt != '')) {
			if (url == "") {
				url += "prdprice=" + prcflt;
			} else {
				url += "&prdprice=" + prcflt;
			}
		}
		if ((tyrbrnd != '')) {
			if (url == "") {
				url += "tyrbrnd=" + tyrbrnd;
			} else {
				url += "&tyrbrnd=" + tyrbrnd;
			}
		}
		if ((vehbrnd != '')) {
			if (url == "") {
				url += "vehbrnd=" + vehbrnd;
			} else {
				url += "&vehbrnd=" + vehbrnd;
			}
		}
		if ((vehmodl != '')) {
			if (url == "") {
				url += "vehmodel=" + vehmodl;
			} else {
				url += "&vehmodel=" + vehmodl;
			}
		}
		if ((varntflt != '')) {
			if (url == "") {
				url += "vehvarent=" + varntflt;
			} else {
				url += "&vehvarent=" + varntflt;
			}
		}
		url = "<?php echo $rtpth; ?>products-filter.php?" + url;
		//alert(url);
		xmlHttp = GetXmlHttpObject(srchprdchng);
		xmlHttp.open("GET", url, true);
		xmlHttp.send(null);
	}
	function srchprdchng() {
		if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
			var temp = xmlHttp.responseText;
			//alert(temp)
			/* document.getElementById('prodlist').style.display = 'none';
			document.getElementById('fltprodlist').style.display = 'block'; */
			document.getElementById('prodlist').innerHTML = temp;
		}
	} 
</script>
<script>
	function funcfltvechtype(vechtype) {
		// debugger;
		var vehtypnm = vechtype;
		//alert(vehtypnm);
		$.ajax({
			type: "POST",
			url: "prdserchflt.php",
			data: 'vechtypnm=' + vehtypnm,
			success: function (data) {
				//alert(data);
				$("#getmolnm").html(data);
			}
		});
	}
	function prdserchflt() {
		//alert('hi');
	}
</script>
<!--------------------------------------------->
<script>
	function funcfltvechbrnd() {
		var vehtypnm = document.getElementById('vechtye').value;
		var vechbrnd = $('#vehbrndflt').val();
		//alert(vehtypnm);
		$.ajax({
			type: "POST",
			url: "prdserchflt.php",
			data: 'vechtypnm1=' + vehtypnm + '&vechbrnd=' + vechbrnd,
			success: function (data) {
				$("#tyrvehmodlflt").html(data);
				$('#tyrvehvarntflt').empty().append('<option  value="">Select</option>');
			}
		});
	}
	function funcfltvechmold() {
		var vehtypnm = document.getElementById('vechtye').value;
		var vechbrnd = $('#vehbrndflt').val();
		var vechmodle = $('#tyrvehmodlflt').val();
		$.ajax({
			type: "POST",
			url: "prdserchflt.php",
			data: 'vechtypnm2=' + vehtypnm + '&vechbrnd=' + vechbrnd + '&vechmodle=' + vechmodle,
			success: function (data) {
				$("#tyrvehvarntflt").html(data);
			}
		});
	}
</script>
<!----------------------------------------->