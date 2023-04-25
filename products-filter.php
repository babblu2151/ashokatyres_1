<?php
error_reporting(0);
session_start();
include_once "includes/inc_config.php"; // site and  files confige
include_once "includes/inc_connection.php"; // database connection
include_once "includes/inc_usr_functions.php"; // user define functions(code reuse)
include_once "includes/inc_folder_path.php"; //  folder path confige
include_once "includes/inc_fnct_img_resize.php"; //image resize 
include_once "includes/inc_img_size.php"; //image size fix
include_once 'includes/inc_paging_functions.php'; //Making paging validation	
global $rowsprpg, $cntstart;
$rowsprpg = 20; //maximum rows per page		
$cntstart = 0;
include_once "includes/inc_paging1.php"; //Includes pagination
$loc = "";
$sqlprd_mst1 = $_SESSION['sesprodqry'];
if (isset($_REQUEST['type']) && (trim($_REQUEST['type']) != "")) {
	$vehtypenm = glb_func_chkvl($_REQUEST['type']);
	$vehtypenm = funcStrUnRplc($vehtypenm);
	$sqlprd_mst1 .= "and vehtypm_id='$vehtypenm'";
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
	$sqlprd_mst1 .= "and tyrprflm_name='$tyrwdth'";
}
if (isset($_REQUEST['prdprice']) && (trim($_REQUEST['prdprice']) != "")) {
	$prdprice = glb_func_chkvl($_REQUEST['prdprice']);
	$secvalarys = explode('-', $prdprice);
	$minprc = $secvalarys[0];
	$maxprc = $secvalarys[1];
	$sqlprd_mst1 .= "and  prodm_cstprc between $minprc and $maxprc ";
}
if (isset($_REQUEST['prdsort']) && (trim($_REQUEST['prdsort']) != "")) {
	$prdsortflt = trim($_REQUEST['prdsort']);
	if ($prdsortflt == "plp") {
		$sqlprd_mst2 = "  order by prodm_sleprc asc ";
	} elseif ($prdsortflt == "php") {
		$sqlprd_mst2 = "  order by prodm_sleprc desc ";
	} elseif ($prdsortflt == "paz") {
		$sqlprd_mst2 = "  order by prodm_name desc ";
	} elseif ($prdsortflt == "pza") {
		$sqlprd_mst2 = "  order by prodm_name asc ";
	} elseif ($prdsortflt == "pis") {
		$sqlprd_mst2 = "  order by prodm_name desc ";
	}
	else {
		$slct = "";
	}
} else {
	$sqlprd_mst2 = "  order by prodm_name asc ";
}
//$sqlprd_mst2="  order by prodm_rnk limit $offset,   $rowsprpg";
$sqlprd_mst = $sqlprd_mst1 . 'group by prodm_id' . $sqlprd_mst2;
$srsprod_mst = mysqli_query($conn, $sqlprd_mst);
$cntrec_prod = mysqli_num_rows($srsprod_mst);
?>
<!----------------products start ------------>
<div class="catagory-result-row">
	<h5 class="serch-result">Showing <strong>
			<?php echo $cntrec_prod; ?> products
		</strong></h5>
	<div>Sort by
		<select class="form-control custom-select ms-3" id="prdsort" onchange="funcchklprd()">
			<option value="">-Select-</option>
			<option value="np" <?php if ($prdsortflt == "np") { echo "selected"; } else{ echo ""; } ?>>Newest</option>
			<option value="plp" <?php if ($prdsortflt == "plp") { echo "selected"; } else { echo ""; } ?>>Price: Lowest first</option>
			<option value="php" <?php if ($prdsortflt == "php") { echo "selected"; } else{ echo ""; } ?>>Price: Highest first </option>
			<option value="paz" <?php if ($prdsortflt == "paz") { echo "selected"; } else{ echo ""; } ?>>Product Name: A to Z </option>
			<option value="pza" <?php if ($prdsortflt == "pza") { echo "selected"; } else{ echo ""; } ?>>Product Name: Z to A </option>
			<option value="pis" <?php if ($prdsortflt == "pis") { echo "selected"; } else{ echo ""; } ?>>In stock</option>
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
			if ($prod_ofrprc != "" && $prod_ofrprc > 0) {
				$prod_fnlprc = $prod_ofrprc;
			} else {
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
			if (file_exists($smlImgPth)) {
				$smlImgPth = $rtpth . $gprodsimg_usrpth . $smlImgNm . '.jpg';
			} else {
				$smlImgPth = $rtpth . 'images/ashoka-no-image.jpg';
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
				if ($clsbls < 1) { ?>
					<div class="align-items-center bg-primary p-2 text-white text-center" width="100%"><strong>Out of stock</strong>
					</div>
					<?php
				}
				?>
				<a href="product-display.php?vehtyp=<?php echo $vehtyp_name ?>&vehbrnd=<?php echo $vehbrnd_name ?>&vehmodel=<?php echo $vehmodl_name ?>&vechvarnt=<?php echo $vehvrnt_name ?>&prdcod=<?php echo $prod_code ?>">
					<div class="car-list-box list-view">
						<div class="media-box"> <img src="<?php echo $smlImgPth; ?>" alt="">
							<div class="overlay-bx"> <span data-exthumbimage="<?php echo $smlImgPth; ?>"
									data-src="<?php echo $smlImgPth; ?>" class="view-btn lightimg"> </span></div>
						</div>
						<div class="list-info">
							<h6 class="title mb-0"><a href="product-display.php?vehtyp=<?php echo $vehtyp_name ?>&vehbrnd=<?php echo $vehbrnd_name ?>&vehmodel=<?php echo $vehmodl_name ?>&vechvarnt=<?php echo $vehvrnt_name ?>&prdcod=<?php echo $prod_code ?>"
									data-splitting class="text-white"><?php echo $prod_name ?> </a></h6>
							<div class="car-type">Sku:
								<?php echo $prodm_sku ?><br />
								Tyre Brand:
								<?php echo $vehtyrebrnd_name ?>
								<br />
								<!--Vehicle Brand: <?php echo $vehbrnd_name ?>-->
							</div>
							<div class="d-flex justify-content-between align-items-center"> <span class="badge m-b10 mr-rt-5"><span>₹</span>
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