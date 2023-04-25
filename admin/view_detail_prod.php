<?php
include_once '../includes/inc_config.php'; //Making paging validation	
include_once $inc_nocache; //Clearing the cache information
include_once $adm_session; //checking for session
include_once $inc_cnctn; //Making database Connection
include_once $inc_usr_fnctn; //checking for session	
include_once $inc_pgng_fnctns; //Making paging validation
include_once $inc_fldr_pth; //Making paging validation
/***************************************************************
Programm : view_detail_prod.php	
Purpose : For Viewing Product Details
Created By : Bharath
Created On : 05-01-2022
Modified By : 
Modified On :
Purpose : 
Company : Adroit
************************************************************/
global $id,$pg,$countstart;
$rd_crntpgnm = "view_all_products.php";
$rd_edtpgnm = "edit_products.php";
$clspn_val = "4";
/*****header link********/
$pagemncat = "Products";
$pagecat = "Products";
$pagenm = "View Products";
/*****header link********/
if(isset($_REQUEST['vw']) && (trim($_REQUEST['vw'])!="") && isset($_REQUEST['pg']) && (trim($_REQUEST['pg'])!="") && isset($_REQUEST['countstart']) && (trim($_REQUEST['countstart'])!=""))
{
	$id = glb_func_chkvl($_REQUEST['vw']);
	$pg = glb_func_chkvl($_REQUEST['pg']);
	$countstart = glb_func_chkvl($_REQUEST['countstart']);
	$srchval = glb_func_chkvl($_REQUEST['val']);
	$chk = glb_func_chkvl($_REQUEST['chk']);
}
$sqryprod_mst="SELECT prodm_id, prodm_sku, prodm_code, prodm_name, prodm_tyr_brnd, prodm_vehtyp, prodm_size, prodm_tyrtyp, prodm_tub_dtl, prodm_ptrn, prodm_cstprc, prodm_sleprc, prodm_ofrprc, prodm_dsc, prodm_sdsc, prodm_st, prodm_sky, prodm_sotl, prodm_sodsc, prodm_sttle, prodm_stdsc, if(prodm_sts = 'a', 'Active','Inactive') as prodm_sts, prodm_rnk, tyrbrndm_id, tyrbrndm_name, vehtypm_name, vehtypm_id, tyrwdthm_name, tyrprflm_name, tyrrmszm_name, tyrtypm_name
	from prod_mst
	inner join veh_type_mst on prodm_vehtyp = vehtypm_id
	inner join tyr_brnd_mst on prodm_tyr_brnd = tyrbrndm_id
	inner join tyr_wdth_mst on tyrwdthm_id = prodm_tyrwdth
	inner join tyr_prfl_mst on tyrprflm_id = prodm_tyrprfl
	inner join tyr_rimsize_mst on tyrrmszm_id = prodm_tyrrmsz
	inner join tyr_type_mst on tyrtypm_id = prodm_tyrtyp
	where prodm_id = $id group by prodm_id";
// echo $sqryprod_mst;
$srsprod_mst = mysqli_query($conn,$sqryprod_mst);
$rowsprod_mst = mysqli_fetch_assoc($srsprod_mst);
$loc= "&val=$srchval";
if($chk !='')
{
	$loc .="&chk=y";
}
if(isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == "y"))	
{
	$msg = "<center><font color=red>Record updated successfully</font></center>";
}
elseif(isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == "n"))
{
	$msg = "<center><font color=red>Record not updated</font></center>";
}
elseif(isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == "d"))
{
	$msg = "<center><font color=red>Duplicate Recored Name Exists & Recor</center>d Not updated</font>";
}
?>
<script language="javascript">
function update1() //for update download details
{
	document.frmedtprodid.action="<?php echo $rd_edtpgnm;?>?vw=<?php echo $id;?>&pg=<?php echo $pg;?>&countstart=<?php echo $countstart.$loc;?>";
	document.frmedtprodid.submit();
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
					<h1 class="m-0 text-dark">View Product</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">View Product</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<form name="frmedtprodid" id="frmedtprodid" method="post" action="<?php $_SERVER['PHP_SELF'];?>" onSubmit="return performCheck('frmedtprodid', rules, 'inline');">
		<input type="hidden" name="hdnprodid" value="<?php echo $id;?>">
		<input type="hidden" name="hdnpage" value="<?php echo $pg;?>">
		<input type="hidden" name="hdncnt" value="<?php echo $countstart?>">
		<?php
		if($msg !='')
		{
	 		echo "<tr bgcolor='#FFFFFF'>
				<td colspan='4' bgcolor='#F3F3F3' align='center'><strong>$msg</strong></td> 
			 </tr>";
		}
		?>
		<div class="card">
			<div class="card-body">
				<div class="row justify-content-center">
					<div class="col-md-12">
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-3 col-form-label">SKU / Barcode</label>
							<div class="col-sm-8">
								<?php echo $rowsprod_mst['prodm_sku'];?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-3 col-form-label">Code</label>
							<div class="col-sm-8">
								<?php echo $rowsprod_mst['prodm_code'];?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-3 col-form-label">Name</label>
							<div class="col-sm-8">
								<?php echo $rowsprod_mst['prodm_name'];?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-3 col-form-label">Brand</label>
							<div class="col-sm-8">
								<?php echo $rowsprod_mst['tyrbrndm_name'];?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-3 col-form-label">Vehicle type</label>
							<div class="col-sm-8">
								<?php echo $rowsprod_mst['vehtypm_name'];?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-3 col-form-label">Width / profile / rim size</label>
							<div class="col-sm-8">
								<?php echo $rowsprod_mst['tyrwdthm_name']." / ".$rowsprod_mst['tyrprflm_name']." / ".$rowsprod_mst['tyrrmszm_name']; ?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-3 col-form-label">Suitable vehicles</label>
							<div class="col-sm-8">
								<?php
								$sqry_vrnts = "SELECT vehbrndm_name, vehmodlm_name, vehvrntm_name from prod_veh_dtl
									inner join veh_brnd_mst on veh_brnd_mst.vehbrndm_id = prod_veh_dtl.prodd_veh_brnd
									inner join veh_model_mst on veh_model_mst.vehmodlm_id = prod_veh_dtl.prodd_veh_mdl
									inner join veh_vrnt_mst on veh_vrnt_mst.vehvrntm_id = prod_veh_dtl.prodd_veh_vrnt
									where prodd_prodm_id = $id";
								// echo $sqry_vrnts;
								$srsprod_vrnt = mysqli_query($conn,$sqry_vrnts);
								$cnt_vrnt = mysqli_num_rows($srsprod_vrnt);
								if ($cnt_vrnt > 0)
								{
									$veh_dspl = array();
									while($rowsprodvrnt_mst = mysqli_fetch_assoc($srsprod_vrnt))
									{
										$brndnm = $rowsprodvrnt_mst['vehbrndm_name'];
										$modlnm = $rowsprodvrnt_mst['vehmodlm_name'];
										$vrntnm = $rowsprodvrnt_mst['vehvrntm_name'];
										$veh_dspl[] = "&nbsp; ".$brndnm."&nbsp; ".$modlnm."&nbsp; ".$vrntnm;
									}
								}
								echo implode(",", $veh_dspl);
								?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-3 col-form-label">Locations</label>
							<div class="col-sm-8">
								<?php
								$sqryloc = "SELECT strlocm_name from prod_store_dtl
									inner join store_loc_mst on prod_store_dtl.prods_store_id = store_loc_mst.strlocm_id where prods_prodm_id = $id";
								// echo $sqryloc;
								$srsloc = mysqli_query($conn,$sqryloc);
								$cnt_loc = mysqli_num_rows($srsloc);
								if ($cnt_loc > 0)
								{
									$loc_dspl = array();
									while($rowloc_mst = mysqli_fetch_assoc($srsloc))
									{
										$locnm = $rowloc_mst['strlocm_name'];
										$loc_dspl[] = "&nbsp; ".$locnm;
									}
								}
								echo implode(",", $loc_dspl);
								?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-3 col-form-label">Type</label>
							<div class="col-sm-8">
								<?php echo $rowsprod_mst['tyrtypm_name'];?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-3 col-form-label">Tube included</label>
							<div class="col-sm-8">
								<?php
								if ($rowsprod_mst['prodm_tub_dtl'] == "")
								{
									echo "No";
								}
								else
								{
									echo $rowsprod_mst['prodm_tub_dtl'];
								}
								?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-3 col-form-label">Size</label>
							<div class="col-sm-8">
								<?php echo $rowsprod_mst['prodm_size'];?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-3 col-form-label">Pattern</label>
							<div class="col-sm-8">
								<?php echo $rowsprod_mst['prodm_ptrn'];?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-3 col-form-label">Cost Price</label>
							<div class="col-sm-8">
								<?php echo $rowsprod_mst['prodm_cstprc'];?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-3 col-form-label">Sale Price</label>
							<div class="col-sm-8">
								<?php echo $rowsprod_mst['prodm_sleprc'];?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-3 col-form-label">Offer Price</label>
							<div class="col-sm-8">
								<?php echo $rowsprod_mst['prodm_ofrprc'];?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-3 col-form-label">Description</label>
							<div class="col-sm-8">
								<?php echo $rowsprod_mst['prodm_dsc'];?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-3 col-form-label">SEO Title</label>
							<div class="col-sm-8">
								<?php echo $rowsprod_mst['prodm_st'];?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-3 col-form-label">SEO Keyword</label>
							<div class="col-sm-8">
								<?php echo $rowsprod_mst['prodm_sky'];?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-3 col-form-label">SEO Description</label>
							<div class="col-sm-8">
								<?php echo $rowsprod_mst['prodm_sdsc'];?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-3 col-form-label">SEO H1 Title</label>
							<div class="col-sm-8">
								<?php echo $rowsprod_mst['prodm_sotl'];?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-3 col-form-label">SEO H1 Description</label>
							<div class="col-sm-8">
								<?php echo $rowsprod_mst['prodm_sodsc'];?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-3 col-form-label">SEO H2 Title</label>
							<div class="col-sm-8">
								<?php echo $rowsprod_mst['prodm_sttle'];?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-3 col-form-label">SEO H2 Description </label>
							<div class="col-sm-8">
								<?php echo $rowsprod_mst['prodm_stdsc'];?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-3 col-form-label">Rank</label>
							<div class="col-sm-8">
								<?php echo $rowsprod_mst['prodm_rnk'];?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-3 col-form-label">Status</label>
							<div class="col-sm-8"> 
								<?php echo $rowsprod_mst['prodm_sts'];?>
							</div>
						</div>
						<div class="table-responsive">
							<table width="100%" border="0" cellspacing="1" cellpadding="3" class="table table-striped projects">
								<tr>
	                <td width="5%"  ><strong>SL.No.</strong></td>
	                <td width="20%" ><strong>Name</strong></td>
									<td width="20%"  align="center"><strong>Small Image</strong></td>
									<td width="20%"  align="center"><strong>Big Image</strong></td>
									<td width="20%"  ><strong>Priorty</strong></td>
									<td width="20%"   ><strong>Status</strong></td>
				  			</tr>
				  			<?php
				  			$sqryimg_dtl="SELECT prodimgd_id, prodimgd_title, prodimgd_simg, prodimgd_bimg, prodimgd_prty, if(prodimgd_sts = 'a', 'Active','Inactive') as prodimgd_sts from prodimg_dtl where prodimgd_prodm_id  ='$id' order by prodimgd_id";
				  			$srsimg_dtl	= mysqli_query($conn,$sqryimg_dtl);
				  			$cntprodimg_dtl  = mysqli_num_rows($srsimg_dtl);
				  			$cnt = $offset;
				  			if($cntprodimg_dtl > 0 )
				  			{
				  				while($rowprodimg_dtl=mysqli_fetch_assoc($srsimg_dtl))
				  				{
				  					$cnt+=1;
										$clrnm = "";
										if($cnt%2==0)
										{
											$clrnm = "";
										}
										else
										{
											$clrnm = "";
										}
										?>
										<tr>
											<td><?php echo $cnt; ?></td>
											<td><?php echo $rowprodimg_dtl['prodimgd_title']; ?></td>
											<td align='center'>
												<?php
												$imgid = $rowprodimg_dtl['prodimgd_id'];
												$simgnm = $rowprodimg_dtl['prodimgd_simg'];
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
													echo "<a href='$simgpath' class='fancybox' rel='gall[]'><img src='$simgpath' width='100pixel' height='100pixel'></a>";
												}
												else
												{
													echo "Image not available";
												}
												?>
											</td>
											<td align='center'>
												<?php
												$imgid = $rowprodimg_dtl['prodimgd_id'];
												$bimgnm = $rowprodimg_dtl['prodimgd_bimg'];
												//$imgpath = $gsml_fldnm.$imgnm;
												$bimgpathjpeg = $gprodbimg_upldpth.$bimgnm.".jpeg";
												$bimgpathjpg = $gprodbimg_upldpth.$bimgnm.".jpg";
												if(($bimgnm != '') && file_exists($bimgpathjpeg))
												{
													$bimgpath = $bimgpathjpeg;
												}
												else if(($simgnm != '') && file_exists($simgpathjpg))
												{
													$bimgpath = $bimgpathjpg;
												}
												if(($bimgnm !="") && file_exists($bimgpath))
												{
													echo "<a href='$bimgpath' class='fancybox' rel='gall[]'><img src='$bimgpath' width='100pixel' height='100pixel'></a>";
												}
												else
												{
													echo "Image not available";
												}
												?>
											</td>
											<td><?php echo $rowprodimg_dtl['prodimgd_prty']; ?></td>
											<td><?php echo $rowprodimg_dtl['prodimgd_sts']; ?></td>
										</tr>
										<div id='divordflw<?php echo $imgid;?>' style="display:none">
											<?php
											echo "<img src='$imgpath' width='500pixel' height='500pixel'>";
											?>
										</div>
										<?php
									}
								}
								else
								{
									echo "<tr>
									<td colspan='6' align='center'>Image not available</td>
									</tr>";
								}
								?>
							</table>
						</div>
						<p class="text-center">
							<input type="Submit" class="btn btn-primary btn-cst" name="frmedtprodid" id="frmedtprodid" value="Edit" 
							onclick="update1()">
							&nbsp;&nbsp;&nbsp;
							<input type="button" name="btnBack" value="Back" class="btn btn-primary btn-cst" onclick="location.href='<?php echo $rd_crntpgnm;?>?<?php echo $loc;?>'">
						</p>
					</div>
				</div>
			</div>
		</div>
	</form> 
</section>
<?php include_once "../includes/inc_adm_footer.php";?>