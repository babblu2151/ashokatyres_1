<?php
include_once "includes/inc_config.php"; // site and  files confige
include_once "includes/inc_connection.php"; // database connection
include_once "includes/inc_usr_functions.php"; // user define functions(code reuse)
include_once "includes/inc_folder_path.php"; //  folder path confige
include_once "includes/inc_usr_sessions.php";
$regid = $_SESSION['sesmbrid'];
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
	$sqlprd_mst1 = "SELECT prodm_id, prodm_sku, prodm_code, prodm_name, prodm_size, prodm_ptrn, prodm_cstprc, prodm_sleprc,  prodm_ofrprc, prodm_dsc,prodm_tub_dtl,prodm_tyrtyp, prodm_sdsc, prodm_st, prodm_sky, prodm_sotl, prodm_sodsc, prodm_sttle, prodm_stdsc, prodm_sts, prodm_rnk,vehtypm_id, vehtypm_name, vehtypm_desc, vehtypm_seotitle, vehtypm_seodesc, vehtypm_seokywrd, vehtypm_seohonetitle, vehtypm_seohonedesc, vehtypm_seohtwotitle, vehtypm_seohtwodesc, vehtypm_sts, vehtypm_prty,vehbrndm_id, vehbrndm_name, vehbrndm_desc, vehbrndm_vehtypm_id, vehbrndm_brndimg, vehbrndm_sts, vehbrndm_prty, vehbrndm_seotitle, vehbrndm_seodesc, vehbrndm_seokywrd, vehbrndm_seohonetitle, vehbrndm_seohonedesc, vehbrndm_seohtwotitle, vehbrndm_seohtwodesc, vehmodlm_id, vehmodlm_name,vehvrntm_id, vehvrntm_name,tyrprflm_id,tyrprflm_name, tyrrmszm_id,tyrrmszm_name,tyrwdthm_id,tyrwdthm_name,tyrbrndm_id,tyrbrndm_name
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
	if (isset($_REQUEST['prdcod']) && (trim($_REQUEST['prdcod']) != "")) {
		$prdcod = glb_func_chkvl($_REQUEST['prdcod']);
		$prdcod = funcStrUnRplc($prdcod);
		$sqlprd_mst1 .= "and prodm_code='$prdcod'";
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
		$sqlprd_mst1 .= "and tyrprflm_name='$tyrwdth'";
	}
	//$sqlprd_mst2="  order by prodm_rnk limit $offset,   $rowsprpg";
	$sqlprd_mst2 = "  order by prodm_rnk ";
	$sqlprd_mst = $sqlprd_mst1 . $sqlprd_mst2;
	$srsprod_mst = mysqli_query($conn, $sqlprd_mst);
	$cntrec_prod = mysqli_num_rows($srsprod_mst);
	if ($cntrec_prod > 0) {
		$cnt = 0;
		mysqli_data_seek($srsprod_mst, 0);
		$srowsprod_mst = mysqli_fetch_assoc($srsprod_mst);
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
		$vehbrnd_id = $srowsprod_mst['vehbrndm_id'];
		$vehbrnd_name = $srowsprod_mst['vehbrndm_name'];
		$vehbrnd_desc = $srowsprod_mst['vehbrndm_desc'];
		$vehbrnd_brndimg = $srowsprod_mst['vehbrndm_brndimg'];
		$vehbrnd_seotitle = $srowsprod_mst['vehbrndm_seotitle'];
		$vehbrnd_seodesc = $srowsprod_mst['vehbrndm_seodesc'];
		$vehbrnd_seokywrd = $srowsprod_mst['vehbrndm_seokywrd'];
		$vehvrnt_name = $srowsprod_mst['vehvrntm_name'];
		$vehmodl_name = $srowsprod_mst['vehmodlm_name'];
		$vehtyrwdthm_name = $srowsprod_mst['tyrwdthm_name'];
		$vehtyrrmszm_name = $srowsprod_mst['tyrrmszm_name'];
		$vehtyrwdthm_id = $srowsprod_mst['tyrwdthm_id'];
		$vehtyrrmszm_id = $srowsprod_mst['tyrrmszm_id'];
		$vehtyrprflm_name = $srowsprod_mst['tyrprflm_name'];
		$vehtyrtyp = $srowsprod_mst['prodm_tyrtyp'];
		$vehtyrtub = $srowsprod_mst['prodm_tub_dtl'];
		$vehtyrebrnd_name = $srowsprod_mst['tyrbrndm_name'];
		$vehtyrebrnd_id = $srowsprod_mst['tyrbrndm_id'];
	} else {
	}
}
$page_title = "Product Display | Home";
$page_seo_title = "Product Display | Home";
$db_seokywrd = "";
$db_seodesc = "";
$current_page = "home";
$body_class = "homepage";
include('header.php');
?>
<input type="hidden" value="<?php echo $_SESSION['sesmbrid']; ?>" id="mbrid">
<div class="page-wraper">
	<div class="page-content bg-white">
		<!-- Banner  -->
		<div class="dlab-bnr-inr short-banner style-1 overlay-black-middle"
			style="background-image: url(images/banner/bnr1.jpg);">
			<div class="container">
				<div class="dlab-bnr-inr-entry">
					<h1 class="text-white">
						<?php echo $prod_name ?>
					</h1>
					<div class="d-flex justify-content-center align-items-center">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">
									<?php echo $prod_name ?>
								</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</div>
		<section class="content-inner-2">
			<div class="container">
				<div class="row">
					<div class=" col-xl-6 col-lg-6 col-md-6 m-b0 m-md-b50">
						<div class="product-gallery on-show-slider lightgallery m-b40" id="lightgallery">
							<div class="swiper-container sync1">
								<div class="swiper-wrapper">
									<?php
									$sqlbimgdtl = "SELECT prodimgd_bimg from prodimg_dtl where prodimgd_prodm_id = $prod_id order by prodimgd_prty desc";
									$resbimgdtl = mysqli_query($conn, $sqlbimgdtl);
									$cntbgimg = mysqli_num_rows($resbimgdtl);
									if ($cntbgimg > 0)
									{
										while ($rwsimgdtl = mysqli_fetch_array($resimgdtl)) {
											$bgImgNm = $rwsimgdtl['prodimgd_bimg'];
											// $bgImgPth = $rtpth . $gprodbimg_usrpth . $bgImgNm . '.jpg';
											$bgImgPth = $gprodbimg_usrpth . $bgImgNm . '.jpg';
											if (file_exists($bgImgPth)) {
												$bgImgPth = $rtpth . $gprodbimg_usrpth . $bgImgNm . '.jpg';
											} else {
												$bgImgPth = $rtpth . 'images/ashoka-no-image.jpg';
											}
											?>
											<!------big image------>
											<div class="swiper-slide">
												<div class="dlab-thum-bx">
													<img src="<?php echo $bgImgPth ?>" alt="">
													<div class="overlay-bx">
														<div class="overlay-icon">
															<span data-exthumbimage="<?php echo $bgImgPth ?>" data-src="<?php echo $bgImgPth ?>"
																class="view-btn lightimg">
																<svg width="75" height="74" viewBox="0 0 75 74" fill="none"
																	xmlns="http://www.w3.org/2000/svg">
																	<path
																		d="M44.5334 27.7473V32.3718C44.5334 33.3257 43.7424 34.106 42.7755 34.106H34.572V42.199C34.572 43.1528 33.7809 43.9332 32.8141 43.9332H28.1264C27.1595 43.9332 26.3685 43.1528 26.3685 42.199V34.106H18.1649C17.1981 34.106 16.4071 33.3257 16.4071 32.3718V27.7473C16.4071 26.7935 17.1981 26.0131 18.1649 26.0131H26.3685V17.9201C26.3685 16.9663 27.1595 16.1859 28.1264 16.1859H32.8141C33.7809 16.1859 34.572 16.9663 34.572 17.9201V26.0131H42.7755C43.7424 26.0131 44.5334 26.7935 44.5334 27.7473ZM73.9782 68.8913L69.8325 72.9812C68.4555 74.3396 66.2288 74.3396 64.8664 72.9812L50.2466 58.5728C49.5874 57.9225 49.2212 57.0409 49.2212 56.116V53.7604C44.05 57.749 37.5458 60.1191 30.4702 60.1191C13.6384 60.1191 0 46.6646 0 30.0596C0 13.4545 13.6384 0 30.4702 0C47.3021 0 60.9405 13.4545 60.9405 30.0596C60.9405 37.0397 58.538 43.4563 54.4949 48.5578H56.8827C57.8202 48.5578 58.7138 48.9191 59.373 49.5694L73.9782 63.9777C75.3406 65.3362 75.3406 67.5329 73.9782 68.8913ZM50.3931 30.0596C50.3931 19.1919 41.4864 10.4052 30.4702 10.4052C19.4541 10.4052 10.5474 19.1919 10.5474 30.0596C10.5474 40.9273 19.4541 49.7139 30.4702 49.7139C41.4864 49.7139 50.3931 40.9273 50.3931 30.0596Z"
																		fill="white" fill-opacity="0.66" />
																</svg>
															</span>
														</div>
													</div>
												</div>
											</div>
										<?php }
									}
									else
									{
										$bgImgPth = $rtpth . 'images/ashoka-no-image.jpg';
										?>
										<div class="swiper-slide">
											<div class="dlab-thum-bx">
												<img src="<?php echo $bgImgPth ?>" alt="">
												<div class="overlay-bx">
													<div class="overlay-icon">
														<span data-exthumbimage="<?php echo $bgImgPth ?>" data-src="<?php echo $bgImgPth ?>"
															class="view-btn lightimg">
															<svg width="75" height="74" viewBox="0 0 75 74" fill="none"
																xmlns="http://www.w3.org/2000/svg">
																<path
																	d="M44.5334 27.7473V32.3718C44.5334 33.3257 43.7424 34.106 42.7755 34.106H34.572V42.199C34.572 43.1528 33.7809 43.9332 32.8141 43.9332H28.1264C27.1595 43.9332 26.3685 43.1528 26.3685 42.199V34.106H18.1649C17.1981 34.106 16.4071 33.3257 16.4071 32.3718V27.7473C16.4071 26.7935 17.1981 26.0131 18.1649 26.0131H26.3685V17.9201C26.3685 16.9663 27.1595 16.1859 28.1264 16.1859H32.8141C33.7809 16.1859 34.572 16.9663 34.572 17.9201V26.0131H42.7755C43.7424 26.0131 44.5334 26.7935 44.5334 27.7473ZM73.9782 68.8913L69.8325 72.9812C68.4555 74.3396 66.2288 74.3396 64.8664 72.9812L50.2466 58.5728C49.5874 57.9225 49.2212 57.0409 49.2212 56.116V53.7604C44.05 57.749 37.5458 60.1191 30.4702 60.1191C13.6384 60.1191 0 46.6646 0 30.0596C0 13.4545 13.6384 0 30.4702 0C47.3021 0 60.9405 13.4545 60.9405 30.0596C60.9405 37.0397 58.538 43.4563 54.4949 48.5578H56.8827C57.8202 48.5578 58.7138 48.9191 59.373 49.5694L73.9782 63.9777C75.3406 65.3362 75.3406 67.5329 73.9782 68.8913ZM50.3931 30.0596C50.3931 19.1919 41.4864 10.4052 30.4702 10.4052C19.4541 10.4052 10.5474 19.1919 10.5474 30.0596C10.5474 40.9273 19.4541 49.7139 30.4702 49.7139C41.4864 49.7139 50.3931 40.9273 50.3931 30.0596Z"
																	fill="white" fill-opacity="0.66" />
															</svg>
														</span>
													</div>
												</div>
											</div>
										</div>
										<?php
									}
									?>
								</div>
							</div>
							<div class="swiper-container thumb-slider sync2">
								<div class="swiper-wrapper">
									<?php $sqlsimgdtl = "SELECT prodimgd_simg from prodimg_dtl where prodimgd_prodm_id = $prod_id order by prodimgd_prty desc";
									$resimgdtl = mysqli_query($conn, $sqlsimgdtl);
									$cntsimg = mysqli_num_rows($resimgdtl);
									if ($cntsimg > 0)
									{
										while ($rwsimgdtl = mysqli_fetch_array($resimgdtl)) {
											$smlImgNm = $rwsimgdtl['prodimgd_simg'];
											// $smlImgPth = $rtpth . $gprodsimg_usrpth . $smlImgNm . '.jpg';
											$smlImgPth = $gprodsimg_usrpth . $smlImgNm . '.jpg';
											if (file_exists($smlImgPth)) {
												$smlImgPth = $rtpth . $gprodsimg_usrpth . $smlImgNm . '.jpg';
											} else {
												$smlImgPth = $rtpth . 'images/ashoka-no-image.jpg';
											}
											?>
											<div class="swiper-slide">
												<div class="dlab-media">
													<img src="<?php echo $smlImgPth ?>" alt="">
												</div>
											</div>
										<?php }
									}
									else
									{
										$smlImgPth = $rtpth . 'images/ashoka-no-image.jpg';
										?>
										<div class="swiper-slide">
											<div class="dlab-media">
												<img src="<?php echo $smlImgPth ?>" alt="">
											</div>
										</div>
										<?php
									}
									?>
								</div>
							</div>
						</div>
						<div class="product-description">
							<ul class="nav nav-tabs style-1 m-b20">
								<li><a data-bs-toggle="tab" href="#specifications" class="nav-link active">More Information</a></li>
								<li><a data-bs-toggle="tab" href="#presentation" class="nav-link">FAQ's</a></li>
							</ul>
							<div class="tab-content">
								<div id="specifications" class="tab-pane active">
									<div class="icon-bx-wraper bx-style-1 p-2">
										<div class="additional-attributes-wrapper table-wrapper">
											<?php echo $prod_desc; ?>
											<!--<table class="data table additional-attributes" id="product-attribute-specs-table">
												<tbody>
													<tr>
														<td class="col data" data-th="Description">
															<ul>
																<ul>
																	<li><strong>Benefits</strong>: Good traction, confident braking and better dry handling. </li>
																	<li><strong>Functions</strong>: Best wet gripping, stability on all kinds of roads and enhanced grip.</li>
																	<li><strong>Features</strong>: Wide centre rib, wider shoulder blocks and circumferential grooves, innovative tread compound and asymmetric tyre design.</li>
																	<p></p>
																	<strong>Basic Description</strong>
																	<li>Owing to a strong carcass and robust construction, get a high-quality and high-performance tyre. </li>
																	<li>Ceat Czar possesses a rim protector that ensures the safety of the rim on rough tarmac. </li>
																	<li>Enjoy the superior driving courtesy, a 2-D teeth tread design. </li>
																	<li>With a wide centre rib, it offers improved handling. </li>
																	<li>Having strong and rigid shoulder blocks, it delivers a good dry grip and improves cornering capabilities.</li>
																	<p></p>
																	<p><br><strong>Compatible with</strong><br>
																		Audi Q5, Chevrolet Captiva, Land Rover Discovery Sport, Land Rover Freelander 2, Mahindra Scorpio, Mahindra XUV500, Mercedes-Benz M-Class, Tata Aria, Volvo XC 90, Volvo XC60</p>
																</ul>
															</ul>
														</td>
													</tr>
												</tbody>
											</table>-->
										</div>
									</div>
								</div>
								<div id="presentation" class="tab-pane">
									<div class="icon-bx-wraper bx-style-1 p-4">
										<div class="dlab-accordion" id="accordion1">
											<div class="panel">
												<div class="acod-head">
													<h6 class="acod-title">
														<a data-bs-toggle="collapse" href="#car-specifications" class="">
															Q1. When will my order for tyres reach my location?
														</a>
													</h6>
												</div>
												<div id="car-specifications" class="acod-body collapse show in">
													<div class="acod-content p-2">
														<p>We have experts with tyre changing equipment in the Tyresnmore Vans and they will reach
															your location , in Hyderabad , Bangalore , Delhi NCR to change tyres at your doorstep.</p>
														<p>Orders placed before 3 PM will be fulfilled today* Orders placed after 3 PM will be
															fulfilled tomorrow *The order fulfillment on same day is subject to availability of tyres
															in our warehouse. Our team will call you to fix an appointment for changing tyres at your
															location.</p>
														<p>For cities other than those mentioned above , our tyre experts will inform you about the
															time of delivery and additional shipping charges if any.</p>
													</div>
												</div>
											</div>
											<div class="panel">
												<div class="acod-head">
													<h5 class="acod-title">
														<a data-bs-toggle="collapse" href="#engine-specifications" class="collapsed">
															Q2. How long does it take to change tyres?
														</a>
													</h5>
												</div>
												<div id="engine-specifications" class="acod-body collapse">
													<div class="acod-content p-2">
														<p>Once our team reaches your location we need parking space for our van next to your
															vehicle , we have the equipment to change 1 tyre in 20 to 30 minutes and up to 4 tyres in
															30 to 60 minutes</p>
													</div>
												</div>
											</div>
											<div class="panel">
												<div class="acod-head">
													<h5 class="acod-title">
														<a data-bs-toggle="collapse" href="#car-dimensions" class="collapsed">
															Q3. How do I get my tyre manufacturer warranty registered?
														</a>
													</h5>
												</div>
												<div id="car-dimensions" class="acod-body collapse">
													<div class="acod-content p-2">
														<p>You can speak to our tyre expert on 984 900 3100 , and they will guide you to get the
															tyre manufacturer's warranty registered.</p>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-6  col-lg-6 col-md-6">
						<div class="sticky-top nav-tabs-top">
							<div class="car-dl-info icon-bx-wraper style-1 m-b50">
								<div class="tittle_head">
									<a class="product-item-link" href="#">
										<h3>
											<?php echo $prod_name ?>
										</h3>
									</a>
								</div>
								<div class="m-b30">
									<div class="">
										<h5 class="post-title"><a href="javascript:void(0);">Sku:
												<?php echo $prodm_sku ?>
											</a></h5>
										<div class="inclu-info">
											<ul>
												<li>
													<?php if ($vehtyrwdthm_name != '') {
														echo "<strong>Width:</strong> $vehtyrwdthm_name " . '<br />';
													} ?>
													<?php if ($vehtyrprflm_name != '') {
														echo "<strong>Aspect Ratio:</strong> $vehtyrprflm_name " . '<br />';
													} ?>
													<?php if ($vehtyrrmszm_name != '') {
														echo "<strong>Rim Diameter:</strong> $vehtyrrmszm_name " . '<br />';
													} ?>
													<?php if ($vehtyrtyp != '') {
														$sqrytyr_typ_mst = "SELECT tyrtypm_id, tyrtypm_name from tyr_type_mst where tyrtypm_id='$vehtyrtyp' order by tyrtypm_name";
														$srstyr_typ_mst = mysqli_query($conn, $sqrytyr_typ_mst);
														$cnt_tyr_typ = mysqli_num_rows($srstyr_typ_mst);
														$rowstyr_typ_mst = mysqli_fetch_assoc($srstyr_typ_mst);
														$tyrtypm_id = $rowstyr_typ_mst['tyrtypm_id'];
														$tyrtypm_name = $rowstyr_typ_mst['tyrtypm_name'];
														echo "<strong>Tyre Type:</strong> $tyrtypm_name " . '<br />';
													} ?>
													<?php if ($vehtyrtub != '') {
														echo "<strong>Tube included:</strong> $vehtyrtub " . '<br />';
													} ?>
												</li>
												<?php
												$sqlvehcompblty_mst1 = "SELECT prodm_id,vehtypm_id, vehtypm_name,vehbrndm_id, vehbrndm_name, vehbrndm_desc, vehbrndm_vehtypm_id, vehbrndm_brndimg,  vehmodlm_id, vehmodlm_name,vehvrntm_id, vehvrntm_name
												from prod_mst
													inner join prod_veh_dtl on prod_veh_dtl.prodd_prodm_id	= prod_mst.prodm_id
													LEFT join veh_type_mst on veh_type_mst.vehtypm_id=	prod_veh_dtl.prodd_veh_typ
													LEFT join veh_brnd_mst on veh_brnd_mst.vehbrndm_id=prod_veh_dtl.prodd_veh_brnd
													LEFT join veh_vrnt_mst on  veh_vrnt_mst.vehvrntm_id=prod_veh_dtl.prodd_veh_vrnt
													LEFT join veh_model_mst on veh_model_mst.vehmodlm_id=prod_veh_dtl.prodd_veh_mdl	
												where prodm_id !='' and prodm_sts ='a' and vehtypm_sts='a' and vehbrndm_sts='a' and vehmodlm_sts='a' and vehvrntm_sts='a' and prodm_id='$prod_id' group  by vehbrndm_name,vehmodlm_name";
												$srsvehcompblty_mst = mysqli_query($conn, $sqlvehcompblty_mst1);
												$cntrec_vehcompblty = mysqli_num_rows($srsvehcompblty_mst);
												if ($cntrec_vehcompblty > 0) {
													?>
													<li><strong>Vehicle Compatibility: </strong>
														<?php
														while ($srowsvehcompblty_mst = mysqli_fetch_assoc($srsvehcompblty_mst)) {
															$cntvehcompblty += 1;
															?>
															<?php echo $srowsvehcompblty_mst['vehbrndm_name'] . ' ' . $srowsvehcompblty_mst['vehmodlm_name'];
															if ($cntvehcompblty < $cntrec_vehcompblty) {
																echo ',';
															} else {
																echo ' .';
															}
															;
														} ?><br />
													</li>
												<?php } ?>
												<li>- Doorstep fitment includes Product Installation, Toe Alignment, Wheel balancing and
													Rotation. Consumables charged as per actuals.</li>
											</ul>
										</div>
									</div>
									<!--			<div class="ch-avl mt-2">
										<form action="">
											<div class="input-group mb-3">
												<input type="text" class="form-control" placeholder="Enter pincode to check availability" aria-label="Recipient's username" aria-describedby="button-addon2">
												<button class="btn btn-success text-white" type="button" id="button-addon2">Check</button>
											</div>
										</form>
									</div>
								</div>-->
									<div class="amount-div mb-2">
										<h4 class="m-0"><span>&#8377;</span>
											<?php echo $prod_fnlprc ?>
										</h4>
										<p class="tax">(inclusive of all taxes)</p>
									</div>
									<?php
									$sqry_loc = "SELECT strlocm_id, strlocm_name from store_loc_mst where strlocm_sts = 'a' order by strlocm_id ASC";
									$srslocdtls = mysqli_query($conn, $sqry_loc);
									$loc_cnt = mysqli_num_rows($srslocdtls);
									$loc_id = array();
									$loc_nm = array();
									$dat = date('Y-m-d');
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
									?>
									<input type="hidden" value="<?php echo $vehbrnd_id ?>" id="vechbrndnid">
									<input type="hidden" id='prdqnty' name="prdqnty" value="<?php echo $clsbls; ?>" />
									<?php if ($clsbls > 0) { ?>
										<div class="d-flex">
											<div class="number">
												<button class="minus" id="qntyinc<?php echo $prod_id ?>"
													onclick="cuntdec(<?php echo $prod_id ?>)">-</button>
												<input type="text" id="lstqty" name="lstqty" value="1" />
												<button class="plus" id="qntydec<?php echo $prod_id ?>"
													onclick="cuntinc(<?php echo $prod_id ?>)">+</button>
											</div>
										</div>
									<?php } else { ?>
										<div class="d-flex" style="color:red;">
											Out Of Stock
										</div>
									<?php } ?>
									<div class="clearfix">
										<?php if ($clsbls > 0) { ?>
											<button type="button" onclick="frmprdsub('<?php echo $prod_id; ?>','a');"
												class="mt-3 view-details-btn btn btn-primary light phone-no shadow-none effect-1 w-100 text-center d-block"><span>Add
													To Cart</span></button>
										<?php } ?>
									</div>
									<div class="clearfix">
										<button type="button" id="formwshlst" onclick="frmprdsub('<?php echo $prod_id; ?>','w')"
											class="mt-3 view-details-btn btn btn-primary light phone-no shadow-none effect-1 w-100 text-center d-block"><span><i
													class="fas fa-heart mr-1"></i> Add to Wish List</span></button>
									</div>
								</div>
								<div class="used-car-features clearfix m-b50">
									<div class="car-features">
										<i class="bi bi-volume-down"></i>
										<h6>Low Noise</h6>
									</div>
									<div class="car-features">
										<i class="fas fa-car-side"></i>
										<h6>Smooth Riding</h6>
									</div>
									<div class="car-features">
										<i class="bi bi-cloud-haze2"></i>
										<h6>Dry & Wet Grip</h6>
									</div>
									<div class="car-features">
										<i class="bi bi-stoplights"></i>
										<h6>Excellent Braking</h6>
									</div>
									<div class="car-features">
										<i class="far fa-check-circle"></i>
										<h6>Long Life</h6>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
		</section>
		<section class="content-inner-2">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="section-head row">
							<div class="col-sm-8">
								<h3 class="title">FOR YOUR QUICK LOOK</h3>
							</div>
							<div class="col-sm-4 text-sm-end">
								<div class="portfolio-pagination d-inline-block">
									<div class="btn-prev swiper-button-prev2"><i class="las la-arrow-left"></i></div>
									<div class="btn-next swiper-button-next2"><i class="las la-arrow-right"></i></div>
								</div>
							</div>
						</div>
						<div class="swiper-container similar-slider lightgallery">
							<div class="swiper-wrapper">
								<?php $sqlquklookprd_mst1 = "SELECT prodm_id, prodm_sku, prodm_code, prodm_name, prodm_size, prodm_ptrn, prodm_cstprc, prodm_sleprc,  prodm_ofrprc, prodm_dsc, prodm_sdsc, prodm_st, prodm_sky, prodm_sotl, prodm_sodsc, prodm_sttle, prodm_stdsc, prodm_sts, prodm_rnk,vehtypm_id, vehtypm_name, vehtypm_desc, vehtypm_seotitle, vehtypm_seodesc, vehtypm_seokywrd, vehtypm_seohonetitle, vehtypm_seohonedesc, vehtypm_seohtwotitle, vehtypm_seohtwodesc, vehtypm_sts, vehtypm_prty,vehbrndm_id, vehbrndm_name, vehbrndm_desc, vehbrndm_vehtypm_id, vehbrndm_brndimg, vehbrndm_sts, vehbrndm_prty, vehbrndm_seotitle, vehbrndm_seodesc,  vehbrndm_seokywrd, vehbrndm_seohonetitle, vehbrndm_seohonedesc, vehbrndm_seohtwotitle, vehbrndm_seohtwodesc, vehmodlm_id, vehmodlm_name,vehvrntm_id, vehvrntm_name,tyrprflm_id,tyrprflm_name, tyrrmszm_id,tyrrmszm_name,tyrwdthm_id,tyrwdthm_name,tyrbrndm_id,tyrbrndm_name
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
								$sqlquklookprd_mst2 = " and tyrbrndm_id !='$vehtyrebrnd_id' and tyrwdthm_id='$vehtyrwdthm_id' and tyrrmszm_id='$vehtyrrmszm_id'";
								$sqlquklookprd_mst3 = "and vehbrndm_id !='$vehbrnd_id' ";
								$sqlquklookprd_mst = $sqlquklookprd_mst1 . $sqlquklookprd_mst2 . "group by prodm_id order by prodm_rnk";
								$srsquklookprod_mst = mysqli_query($conn, $sqlquklookprd_mst);
								$cntrec_quklookprod = mysqli_num_rows($srsquklookprod_mst);
								if ($cntrec_quklookprod < 1) {
									$sqlquklookprd_mst = $sqlquklookprd_mst1 . $sqlquklookprd_mst3 . "group by prodm_id order by prodm_rnk";
									$srsquklookprod_mst = mysqli_query($conn, $sqlquklookprd_mst);
									$cntrec_quklookprod = mysqli_num_rows($srsquklookprod_mst);
								}
								if ($cntrec_quklookprod > 0) {
									$cnt = 0;
									mysqli_data_seek($srsquklookprod_mst, 0);
									while ($srowsquklookprod_mst = mysqli_fetch_assoc($srsquklookprod_mst)) {
										$quklookprod_id = $srowsquklookprod_mst['prodm_id'];
										$quklookprodm_sku = $srowsquklookprod_mst['prodm_sku'];
										$quklookprod_code = $srowsquklookprod_mst['prodm_code'];
										$quklookprod_name = $srowsquklookprod_mst['prodm_name'];
										$quklookprod_desc = $srowsquklookprod_mst['prodm_dsc'];
										$quklookprod_size = $srowsquklookprod_mst['prodm_size'];
										$quklookprod_ptrn = $srowsquklookprod_mst['prodm_ptrn'];
										$quklookprod_cstprc = $srowsquklookprod_mst['prodm_cstprc'];
										$quklookprod_sleprc = $srowsquklookprod_mst['prodm_sleprc'];
										$quklookprod_ofrprc = $srowsquklookprod_mst['prodm_ofrprc'];
										if ($quklookprod_ofrprc != "" && $quklookprod_ofrprc > 0)
										{
											$quklookprod_fnlprc = $quklookprod_ofrprc;
										}
										else
										{
											$quklookprod_fnlprc = $quklookprod_sleprc;
										}
										// $quklookprod_fnlprc = $srowsquklookprod_mst['prodm_fnlprc'];
										$quklookprod_st = $srowsquklookprod_mst['prodm_st'];
										$quklookprod_sdsc = $srowsquklookprod_mst['prodm_sdsc'];
										$quklookprod_sky = $srowsquklookprod_mst['prodm_sky'];
										$quklookprod_sotl = $srowsquklookprod_mst['prodm_sotl'];
										$quklookprod_sodsc = $srowsquklookprod_mst['prodm_sodsc'];
										$quklookprod_sttle = $srowsquklookprod_mst['prodm_sttle'];
										$quklookprod_stdsc = $srowsquklookprod_mst['prodm_stdsc'];
										$quklookvehtyp_name = $srowsquklookprod_mst['vehtypm_name'];
										$quklookvehtyp_desc = $srowsquklookprod_mst['vehtypm_desc'];
										$quklookvehtyp_seotitle = $srowsquklookprod_mst['vehtypm_seotitle'];
										$quklookvehtyp_seodesc = $srowsquklookprod_mst['vehtypm_seodesc'];
										$quklookvehtyp_seokywrd = $srowsquklookprod_mst['vehtypm_seokywrd'];
										$quklookvehbrnd_name = $srowsquklookprod_mst['vehbrndm_name'];
										$quklookvehbrnd_desc = $srowsquklookprod_mst['vehbrndm_desc'];
										$quklookvehbrnd_brndimg = $srowsquklookprod_mst['vehbrndm_brndimg'];
										$quklookvehbrnd_seotitle = $srowsquklookprod_mst['vehbrndm_seotitle'];
										$quklookvehbrnd_seodesc = $srowsquklookprod_mst['vehbrndm_seodesc'];
										$quklookvehbrnd_seokywrd = $srowsquklookprod_mst['vehbrndm_seokywrd'];
										$quklookvehvrnt_name = $srowsquklookprod_mst['vehvrntm_name'];
										$quklookvehmodl_name = $srowsquklookprod_mst['vehmodlm_name'];
										$quklooklnk = $rtpth . "product-display.php?vehtyp=$quklookvehtyp_name	&vehbrnd=$quklookvehbrnd_name&vehvarent=$quklookvehvrnt_name&prdcod=$quklookprod_code";
										$sqlquklookimgdtl = "SELECT prodimgd_simg from prodimg_dtl where prodimgd_prodm_id = $quklookprod_id order by prodimgd_prty desc";
										$resquklookimgdtl = mysqli_query($conn, $sqlquklookimgdtl);
										$rwsquklookimgdtl = mysqli_fetch_array($resquklookimgdtl);
										$smlImgNm = $rwsquklookimgdtl['prodimgd_simg'];
										$smlImgPth = $gprodsimg_usrpth . $smlImgNm . '.jpg';
										if (file_exists($smlImgPth)) {
											$smlImgPth = $rtpth . $gprodsimg_usrpth . $smlImgNm . '.jpg';
										} else {
											$smlImgPth = $rtpth . 'images/ashoka-no-image.jpg';
										}
										?>
										<div class="swiper-slide">
											<div class="car-list-box border shadow-none">
												<div class="media-box">
													<img src="<?php echo $smlImgPth ?>" alt="">
													<div class="overlay-bx">
														<span data-exthumbimage="<?php echo $smlImgPth ?>" data-src="<?php echo $smlImgPth ?>"
															class="view-btn lightimg">
															<svg width="75" height="74" viewBox="0 0 75 74" fill="none"
																xmlns="http://www.w3.org/2000/svg">
																<path
																	d="M44.5334 27.7473V32.3718C44.5334 33.3257 43.7424 34.106 42.7755 34.106H34.572V42.199C34.572 43.1528 33.7809 43.9332 32.8141 43.9332H28.1264C27.1595 43.9332 26.3685 43.1528 26.3685 42.199V34.106H18.1649C17.1981 34.106 16.4071 33.3257 16.4071 32.3718V27.7473C16.4071 26.7935 17.1981 26.0131 18.1649 26.0131H26.3685V17.9201C26.3685 16.9663 27.1595 16.1859 28.1264 16.1859H32.8141C33.7809 16.1859 34.572 16.9663 34.572 17.9201V26.0131H42.7755C43.7424 26.0131 44.5334 26.7935 44.5334 27.7473ZM73.9782 68.8913L69.8325 72.9812C68.4555 74.3396 66.2288 74.3396 64.8664 72.9812L50.2466 58.5728C49.5874 57.9225 49.2212 57.0409 49.2212 56.116V53.7604C44.05 57.749 37.5458 60.1191 30.4702 60.1191C13.6384 60.1191 0 46.6646 0 30.0596C0 13.4545 13.6384 0 30.4702 0C47.3021 0 60.9405 13.4545 60.9405 30.0596C60.9405 37.0397 58.538 43.4563 54.4949 48.5578H56.8827C57.8202 48.5578 58.7138 48.9191 59.373 49.5694L73.9782 63.9777C75.3406 65.3362 75.3406 67.5329 73.9782 68.8913ZM50.3931 30.0596C50.3931 19.1919 41.4864 10.4052 30.4702 10.4052C19.4541 10.4052 10.5474 19.1919 10.5474 30.0596C10.5474 40.9273 19.4541 49.7139 30.4702 49.7139C41.4864 49.7139 50.3931 40.9273 50.3931 30.0596Z"
																	fill="white" fill-opacity="0.66" />
															</svg>
														</span>
													</div>
												</div>
												<div class="list-info">
													<h6 class="title mb-0"><a href="<?php echo $quklooklnk; ?>" data-splitting class="text-white"><?php echo $quklookprod_name; ?></a></h6>
													<span class="badge m-b30"><span>₹</span>
														<?php echo $quklookprod_fnlprc; ?>
													</span>
												</div>
											</div>
										</div>
									<?php }
								} ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<script type="text/javascript">
			function frmprdsub(pcode, crtactn) {
				if (crtactn == 'a') {
					var qtyval = document.getElementById("lstqty").value;
					var url = "<?php echo $rtpth; ?>manage_cart.php?prodidval=" + pcode + "&cartaction=" + crtactn + "&rqst_prodqty=" + qtyval;
					xmlHttp = GetXmlHttpObject(stchng_UpdtCart);
					xmlHttp.open("GET", url, true);
					xmlHttp.send(null);
				} else if (crtactn == 'w') {
					prdid = pcode;
					var memid = document.getElementById('mbrid').value;
					if (memid == "") {
						mbrlgn();
						return false;
					} else {
						var vehcbrndid = document.getElementById('vechbrndnid').value;
						var url = "<?php echo $rtpth; ?>manage_wishlist.php?prodid=" + prdid + "&memid=" + memid + "&vehcbrndid=" + vehcbrndid;
						//alert(url);
						xmlHttp = GetXmlHttpObject(stchng_UpdtWishList);
						xmlHttp.open("GET", url, true);
						xmlHttp.send(null);
					}
				}
			}
			function mbrlgn() {
				$('#wishlistModal').modal('show');
			}
			function stchng_UpdtWishList() {
				if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
					var temp = xmlHttp.responseText;
					temp = temp.trim();
					if (temp == 'wy') {
						prdadd();
					} else {
						prdalrdy();
					}
					// window.location="<?php echo $rtpth; ?>view-wishlist";		  	  
				}
			}
			function prdadd() {
				$('#wishlistprdModal').modal('show');
			}
			function prdalrdy() {
				$('#wishlistalrdyModal').modal('show');
			}
			function stchng_UpdtCart() {
				if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
					var temp = xmlHttp.responseText;
					var crtval = new Array();
					crtval = temp.split('->');
					//alert(temp)
					var addsts = crtval[0];
					var dispval = crtval[1];
					var disptopcart = crtval[2];
					var displstitm = crtval[3];
					var atchslvs = crtval[4];
					var altrned = crtval[5];
					var altrtyp = crtval[6];
					var incval = crtval[7];
					var prdnm = crtval[8];
					var prdqty = crtval[9];
					var prdsz = crtval[10];
					//	alert(addsts)
					if (addsts == 1) {
						location.href = "<?php echo $rtpth; ?>my-cart.php";
						document.getElementById('divshopbag').innerHTML = dispval;
						document.getElementById('divcart_top').innerHTML = disptopcart;
						document.getElementById('dialog').innerHTML = displstitm;
						document.getElementById('prdqty').innerHTML = prdqty;
						document.getElementById('prdnm').innerHTML = prdnm;
						document.getElementById('prdsz').innerHTML = prdsz;
					} else {
						document.getElementById("prdext").style.display = "inline-block";
						document.getElementById("discrt").style.display = "inline-block";
						document.getElementById("addcrt").style.display = "none";
					}
				}
			}
		</script>
		<script type="text/javascript">
			function cuntinc(prcid) {
				prdid = prcid;
				qty = parseInt(document.getElementById("lstqty").value);
				var count = qty;
				var prdqty = document.getElementById("prdqnty").value;
				prdqty = parseInt(prdqty) - 1;
				// alert(count);
				if ((prdqty == count) || (prdqty <= count)) {
					document.getElementById("qntydec" + prdid).disabled = true;
					//document.getElementById("hello1").innerHTML = prdqty ;
					//document.getElementById("hello").style.display = "block";
				} else {
					var qnttest = document.getElementById("lstqty").value = count;
				}
			}
			function cuntdec(prcid) {
				prdid = prcid;
				dqty = document.getElementById("lstqty").value;
				var count = dqty;
				var prdqty = document.getElementById("prdqnty").value;
				if (count <= prdqty) {
					document.getElementById("qntydec" + prdid).disabled = false;
				}
				if (count > 0) {
					// var button = document.getElementById("qntyinc");
					if ((count - 1) > 0) {
						document.getElementById("lstqty").value = count - 1;
					}
				}
			}
		</script>
		<?php include_once('footer.php'); ?>