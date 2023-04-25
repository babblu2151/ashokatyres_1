<?php
     error_reporting(0);      	
			include_once 'includes/inc_nocache.php'; // Clearing the cache information
            include_once 'includes/inc_connection.php';//Make connection with the database  	
            include_once "includes/inc_config.php";	//path config file
		    include_once "includes/inc_usr_functions.php";//Including user session value
			include_once "includes/inc_folder_path.php";//Including user session value
			
$page_title = "Ashoka Tyres | Home";
$page_seo_title = "Ashoka Tyres | Home";
$db_seokywrd = "";
$db_seodesc = "";
$current_page = "home";
$body_class = "homepage";
include('header.php');
?>






<div class="page-wraper">




	<div class="page-content bg-white">
		<!-- Slider -->
		<div class="main-slider style-two default-banner">
			<div class="tp-banner-container">
				<div class="tp-banner">
					<div id="rev_slider_1061_1_wrapper" class="rev_slider_wrapper fullscreen-container" data-alias="creative-freedom" data-source="gallery" style="background-color:#1f1d24;padding:0px;">
						<!-- START REVOLUTION SLIDER 5.4.1 fullscreen mode -->
						<div id="rev_slider_1061_1" class="rev_slider fullscreenbanner" style="display:none;" data-version="5.4.1">
							<ul>
								<!-- SLIDE  -->
								<li data-index="rs-2978" data-transition="fadethroughdark" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="default" data-easeout="default" data-masterspeed="2000" data-thumb="images/main-slider/slide2.jpg" data-rotate="0" data-saveperformance="off" data-title="Brands" data-param1="01" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
									<!-- MAIN IMAGE -->
									<img src="images/main-slider/slide2.jpg" alt="" data-bgposition="center center" data-bgfit="cover" data-bgparallax="3" class="rev-slidebg" data-no-retina>

									<!-- LAYER NR. 1 -->
									<div class="tp-caption tp-shape tp-shapewrapper " id="slide-2978-layer-1" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']" data-fontweight="['100','100','400','400']" data-width="full" data-height="full" data-whitespace="nowrap" data-type="shape" data-basealign="slide" data-responsive_offset="off" data-responsive="off" data-frames='[{"from":"opacity:0;","speed":1500,"to":"o:1;","delay":150,"ease":"Power2.easeInOut"},{"delay":"wait","speed":1500,"to":"opacity:0;","ease":"Power2.easeInOut"}]' data-textAlign="['left','left','left','left']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 5;border-color:rgba(0, 0, 0, 0);background-color: rgba(0,0,0,0.5);border-width:0px;">
									</div>

									<!-- LAYER NR. 4 -->
									<div class="tp-caption Creative-Title   tp-resizeme" id="slide-2978-layer-2" data-x="['right','right','right','center']" data-hoffset="['60','140','90','0']" data-y="['middle','middle','middle','middle']" data-voffset="['-91','-91','-120','-120']" data-fontsize="['80','80','60','60']" data-lineheight="['120','100','90','60']" data-width="['none','none','none','320']" data-height="none" data-whitespace="nowrap" data-type="text" data-responsive_offset="on" data-frames='[{"from":"y:50px;opacity:0;","speed":1500,"to":"o:1;","delay":2550,"ease":"Power3.easeOut"},{"delay":"wait","speed":1000,"to":"x:0;y:0;z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['right','right','right','center']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 8; white-space: nowrap;font-family:'Poppins', sans-serif; font-weight: 800">Excellence in Tyre
									</div>

									<!-- LAYER NR. 3 -->
									<div class="tp-caption Creative-SubTitle   tp-resizeme" id="slide-2978-layer-3" data-x="['right','right','right','center']" data-hoffset="['60','140','90','0']" data-y="['middle','middle','middle','center']" data-voffset="['-10','-10','-60','-55']" data-fontsize="['23','23','23','23']" data-lineheight="['23','23','23','23']" data-width="none" data-height="none" data-whitespace="nowrap" data-type="text" data-responsive_offset="on" data-frames='[{"from":"y:50px;opacity:0;","speed":1500,"to":"o:1;","delay":2350,"ease":"Power3.easeOut"},{"delay":"wait","speed":1000,"to":"x:0;y:0;z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['right','right','right','right']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 7; white-space: nowrap;color: #fff;font-family:'Poppins';font-weight: 600;">Friendly Service At Competitive Prices.
									</div>

								</li>
								<!-- SLIDE  -->
								<li data-index="rs-2979" data-transition="fadethroughdark" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="default" data-easeout="default" data-masterspeed="2000" data-thumb="images/main-slider/slide1.jpg" data-rotate="0" data-saveperformance="off" data-title="Quality" data-param1="02" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
									<!-- MAIN IMAGE -->
									<img src="images/main-slider/slide1.jpg" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="3" class="rev-slidebg" data-no-retina>
									<!-- LAYERS -->

									<!-- LAYER NR. 7 -->
									<div class="tp-caption tp-shape tp-shapewrapper " id="slide-2979-layer-1" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']" data-fontweight="['100','100','400','400']" data-width="full" data-height="full" data-whitespace="nowrap" data-type="shape" data-basealign="slide" data-responsive_offset="off" data-responsive="off" data-frames='[{"from":"opacity:0;","speed":1500,"to":"o:1;","delay":150,"ease":"Power2.easeInOut"},{"delay":"wait","speed":1500,"to":"opacity:0;","ease":"Power2.easeInOut"}]' data-textAlign="['left','left','left','left']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 5;border-color:rgba(0, 0, 0, 0);background-color: rgba(0,0,0,0.5);border-width:0px;">
									</div>

									<!-- LAYER NR. 10 -->
									<div class="tp-caption Creative-Title   tp-resizeme" id="slide-2979-layer-2" data-x="['right','right','right','center']" data-hoffset="['60','140','90','0']" data-y="['middle','middle','middle','middle']" data-voffset="['-91','-91','-120','-120']" data-fontsize="['80','80','90','60']" data-lineheight="['120','100','90','60']" data-width="['none','none','none','320']" data-height="none" data-whitespace="nowrap" data-type="text" data-responsive_offset="on" data-frames='[{"from":"y:50px;opacity:0;","speed":1500,"to":"o:1;","delay":2550,"ease":"Power3.easeOut"},{"delay":"wait","speed":1000,"to":"x:0;y:0;z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['right','right','right','center']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 8; white-space: nowrap;font-family:'Poppins', sans-serif; font-weight: 800">Bringing Joy of Every journey
									</div>

									<!-- LAYER NR. 9 -->
									<div class="tp-caption Creative-SubTitle   tp-resizeme" id="slide-2979-layer-3" data-x="['right','right','right','center']" data-hoffset="['60','140','90','0']" data-y="['middle','middle','middle','center']" data-voffset="['-10','-10','-60','-55']" data-fontsize="['23','23','23','23']" data-lineheight="['23','23','23','23']" data-width="none" data-height="none" data-whitespace="nowrap" data-type="text" data-responsive_offset="on" data-frames='[{"from":"y:50px;opacity:0;","speed":1500,"to":"o:1;","delay":2350,"ease":"Power3.easeOut"},{"delay":"wait","speed":1000,"to":"x:0;y:0;z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['right','right','right','right']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 7; white-space: nowrap;color: #fff;font-family:'Poppins';font-weight: 600;">Go where the moment takes you.
									</div>

								</li>


								<li data-index="rs-2980" data-transition="fadethroughdark" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="default" data-easeout="default" data-masterspeed="2000" data-thumb="images/main-slider/slide3.jpg" data-rotate="0" data-saveperformance="off" data-title="Quality" data-param1="03" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
									<!-- MAIN IMAGE -->
									<img src="images/main-slider/slide3.jpg" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="3" class="rev-slidebg" data-no-retina>
									<!-- LAYERS -->

									<!-- LAYER NR. 7 -->
									<div class="tp-caption tp-shape tp-shapewrapper " id="slide-2979-layer-1" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']" data-fontweight="['100','100','400','400']" data-width="full" data-height="full" data-whitespace="nowrap" data-type="shape" data-basealign="slide" data-responsive_offset="off" data-responsive="off" data-frames='[{"from":"opacity:0;","speed":1500,"to":"o:1;","delay":150,"ease":"Power2.easeInOut"},{"delay":"wait","speed":1500,"to":"opacity:0;","ease":"Power2.easeInOut"}]' data-textAlign="['left','left','left','left']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 5;border-color:rgba(0, 0, 0, 0);background-color: rgba(0,0,0,0.5);border-width:0px;">
									</div>

									<!-- LAYER NR. 10 -->
									<div class="tp-caption Creative-Title   tp-resizeme" id="slide-2979-layer-2" data-x="['right','right','right','center']" data-hoffset="['60','140','90','0']" data-y="['middle','middle','middle','middle']" data-voffset="['-91','-91','-120','-120']" data-fontsize="['80','80','90','60']" data-lineheight="['120','100','90','60']" data-width="['none','none','none','320']" data-height="none" data-whitespace="nowrap" data-type="text" data-responsive_offset="on" data-frames='[{"from":"y:50px;opacity:0;","speed":1500,"to":"o:1;","delay":2550,"ease":"Power3.easeOut"},{"delay":"wait","speed":1000,"to":"x:0;y:0;z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['right','right','right','center']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 8; white-space: nowrap;font-family:'Poppins', sans-serif; font-weight: 800">Next Century Tyre
									</div>

									<!-- LAYER NR. 9 -->
									<div class="tp-caption Creative-SubTitle   tp-resizeme" id="slide-2979-layer-3" data-x="['right','right','right','center']" data-hoffset="['60','140','90','0']" data-y="['middle','middle','middle','center']" data-voffset="['-10','-10','-60','-55']" data-fontsize="['23','23','23','23']" data-lineheight="['23','23','23','23']" data-width="none" data-height="none" data-whitespace="nowrap" data-type="text" data-responsive_offset="on" data-frames='[{"from":"y:50px;opacity:0;","speed":1500,"to":"o:1;","delay":2350,"ease":"Power3.easeOut"},{"delay":"wait","speed":1000,"to":"x:0;y:0;z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['right','right','right','right']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 7; white-space: nowrap;color: #fff;font-family:'Poppins';font-weight: 600;">Your Partner In Auto Service.
									</div>

								</li>
								<li data-index="rs-2981" data-transition="fadethroughdark" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="default" data-easeout="default" data-masterspeed="2000" data-thumb="images/main-slider/slide4.jpg" data-rotate="0" data-saveperformance="off" data-title="Quality" data-param1="04" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
									<!-- MAIN IMAGE -->
									<img src="images/main-slider/slide4.jpg" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="3" class="rev-slidebg" data-no-retina>
									<!-- LAYERS -->

									<!-- LAYER NR. 7 -->
									<div class="tp-caption tp-shape tp-shapewrapper " id="slide-2979-layer-1" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']" data-fontweight="['100','100','400','400']" data-width="full" data-height="full" data-whitespace="nowrap" data-type="shape" data-basealign="slide" data-responsive_offset="off" data-responsive="off" data-frames='[{"from":"opacity:0;","speed":1500,"to":"o:1;","delay":150,"ease":"Power2.easeInOut"},{"delay":"wait","speed":1500,"to":"opacity:0;","ease":"Power2.easeInOut"}]' data-textAlign="['left','left','left','left']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 5;border-color:rgba(0, 0, 0, 0);background-color: rgba(0,0,0,0.5);border-width:0px;">
									</div>

									<!-- LAYER NR. 10 -->
									<div class="tp-caption Creative-Title   tp-resizeme" id="slide-2979-layer-2" data-x="['right','right','right','center']" data-hoffset="['60','140','90','0']" data-y="['middle','middle','middle','middle']" data-voffset="['-91','-91','-120','-120']" data-fontsize="['80','80','90','60']" data-lineheight="['120','100','90','60']" data-width="['none','none','none','320']" data-height="none" data-whitespace="nowrap" data-type="text" data-responsive_offset="on" data-frames='[{"from":"y:50px;opacity:0;","speed":1500,"to":"o:1;","delay":2550,"ease":"Power3.easeOut"},{"delay":"wait","speed":1000,"to":"x:0;y:0;z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['right','right','right','center']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 8; white-space: nowrap;font-family:'Poppins', sans-serif; font-weight: 800">Lets you Drive Smoothly
									</div>

									<!-- LAYER NR. 9 -->
									<div class="tp-caption Creative-SubTitle   tp-resizeme" id="slide-2979-layer-3" data-x="['right','right','right','center']" data-hoffset="['60','140','90','0']" data-y="['middle','middle','middle','center']" data-voffset="['-10','-10','-60','-55']" data-fontsize="['23','23','23','23']" data-lineheight="['23','23','23','23']" data-width="none" data-height="none" data-whitespace="nowrap" data-type="text" data-responsive_offset="on" data-frames='[{"from":"y:50px;opacity:0;","speed":1500,"to":"o:1;","delay":2350,"ease":"Power3.easeOut"},{"delay":"wait","speed":1000,"to":"x:0;y:0;z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['right','right','right','right']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 7; white-space: nowrap;color: #fff;font-family:'Poppins';font-weight: 600;">Feel The Ultimate Performance.
									</div>

								</li>

							</ul>
							<div class="tp-bannertimer tp-bottom" style="visibility: hidden !important;"></div>

						</div>
					</div><!-- END REVOLUTION SLIDER -->
				</div>
			</div>
<?php  $sqlprdvechtyp_mst1="select  prodm_id, prodm_sku, prodm_code, prodm_name,
		             vehtypm_id,vehtypm_name
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
		
		  where 
		  
		prodm_id !='' and prodm_sts ='a' and vehtypm_sts='a' and vehbrndm_sts='a' and vehmodlm_sts='a' and
		vehvrntm_sts='a' and tyrprflm_sts='a' and tyrrmszm_sts='a' and tyrwdthm_sts='a' and tyrbrndm_sts='a'
		
		
		";
        	 $sqlprdvechtyp_mst1 .=" group by vehtypm_id  order by  vehtypm_prty desc";
        	 // echo $sqlprdvechtyp_mst1;
				$rwprdvechtyp_mst  = mysqli_query($conn,$sqlprdvechtyp_mst1);


		$cntrec_prodvechtyp_mst  = mysqli_num_rows($rwprdvechtyp_mst);
?>

			<!-- searching cars form -->
			<div class="car-searching text-white">
				<div class="container">
					<ul class="nav nav-tabs style-1">
						<li class="nav-item"><a data-bs-toggle="tab" class="nav-link active" aria-controls="new-car" href="#new-car">Vehicle Brand</a></li>
						<li class="nav-item"><a data-bs-toggle="tab" class="nav-link" aria-controls="popular" href="#used-car">Tyre Size</a></li>
					</ul>
				</div>


				<form  method="POST" class="searching-form tab-content">
					<div id="new-car" class="container tab-pane active clearfix">
						<div class="row search-row">
							<div class="col-lg-2 col-md-6">
								<div class="form-group">
									<label>Tyres For</label>
									<ul class="nav justify-content-evenly m-b20">
                                    <?php 
  if($cntrec_prodvechtyp_mst > 0){
		  $cnt = 0;
		  mysqli_data_seek($rwprdvechtyp_mst,0);
  
		  while($srowsprodvechtyp_mst=mysqli_fetch_assoc($rwprdvechtyp_mst)){ 
		  
		  $cntvechtyp1  += 1; ?>
										<li class="form-check">
											<input class="form-check-input" type="radio" name="vechtye" id="vechtye<?php echo $srowsprodvechtyp_mst['vehtypm_id']; ?>" onclick="funcfltvechtype('<?php echo trim($srowsprodvechtyp_mst['vehtypm_id']); ?>')" value="<?php echo ucwords($srowsprodvechtyp_mst['vehtypm_name']); ?>">
											<label class="form-check-label" for="vechtye<?php echo $srowsprodvechtyp_mst['vehtypm_id']; ?>" >
											<?php echo ucwords($srowsprodvechtyp_mst['vehtypm_name']); ?>
											</label>
										</li>
					<?php $cntvechtyp1++ ; }} ?>
									</ul>
								</div>
							</div>
    

                            <div class="col-lg-2 col-md-6">
								<div class="form-group">
									<label>Select Brand</label>
									<select class="form-control sm" id="getbrnd" name="getbrnd" onchange="funcfltvechbrnd()">
									 <option value="">Select</option>
							
									</select>
								</div>
							</div>
							<div class="col-lg-2 col-md-6">
								<div class="form-group">
									<label>Select Model</label>
									<select class="form-control sm select2-hidden-accessible" data-selector="model profile" tabindex="-1"  aria-hidden="true" data-select2-id="51" id="getmold" name="getmold" onchange="funcfltvechmold()">
                                        <option value="">Select</option>
                           </select>
								</div>
							</div>

							<div class="col-lg-2 col-md-6">
								<div class="form-group">
									<label>Select Variant</label>
									<select class="form-control sm   select2-hidden-accessible" data-selector="variant rim" tabindex="-1"  aria-hidden="true" data-select2-id="74" id="getvarnt" name="getvarnt" onchange="funcfltvechvarnt()"><option value="">Select</option></select>
								</div>
							</div>



							<div class="col-lg-3 col-md-6">
								<div class="form-group">
									<button type="button" onclick="suBmitvechbrnd()"  id="suBvechbrnd" class="btn d-block w-100 btn-primary btn-md">Search</button>
								</div>
							</div>
						</div>
					</div>
					<div id="used-car" class="container tab-pane clearfix">
						<div class="row search-row">
							<div class="col-lg-2 col-md-6">
								<div class="form-group">
									<label>Tyres For</label>
									<ul class="nav justify-content-evenly m-b20">
						<?php   if($cntrec_prodvechtyp_mst > 0){
		  $cnt = 0;
		  mysqli_data_seek($rwprdvechtyp_mst,0);
  
		  while($srowsprodvechtyp_mst=mysqli_fetch_assoc($rwprdvechtyp_mst)){ 
		  
		  $cntvechtyp1  += 1; ?>
						<li class="form-check">
											<input class="form-check-input" type="radio" name="tyrtyp" id="tyrtyp<?php echo $srowsprodvechtyp_mst['vehtypm_id']; ?>" onclick="funcflttyrtype('<?php echo trim($srowsprodvechtyp_mst['vehtypm_id']); ?>')" value="<?php echo ucwords($srowsprodvechtyp_mst['vehtypm_name']); ?>">
											<label class="form-check-label" for="vechtye<?php echo $srowsprodvechtyp_mst['vehtypm_id']; ?>" >
											<?php echo ucwords($srowsprodvechtyp_mst['vehtypm_name']); ?>
											</label>
										</li>
					<?php $cntvechtyp1++ ; }}  ?>
									</ul>
								</div>
							</div>



							<div class="col-lg-2 col-md-6">
								<div class="form-group">
									<label>Select Width</label>
									<select class="form-control sm" name="getwdth" id="getwdth" onchange="funprofle()">
										
									<option value="">Select</option>
							
									</select>
								</div>
							</div>
							<div class="col-lg-2 col-md-6">
								<div class="form-group">
									<label>Select Profile</label>
									<select class="form-control sm" id="getprofle" name="getprofle" onchange="funrim()"><option value="">Select</option>
										
										
									</select>
								</div>
							</div>
							<div class="col-lg-2 col-md-6">
								<div class="form-group">
									<label>Select Rim</label>
									<select class="form-control sm" name="getrim" id="getrim" onchange=" functyrrm()">
									<option value="">Select</option>
									</select>
								</div>
							</div>
                        
							<div class="col-lg-3 col-md-6">
								<div class="form-group">
									<button type="button" onclick="suBtyrszserch()" id="tyrszserch" class="btn d-block w-100 btn-primary btn-md">Search</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
			<!-- searching cars form end -->
		</div>
		<!-- Slider END -->

   <?php  $sqlvehbrnd_mst="SELECT vehtypm_id, vehtypm_name, vehtypm_desc,
					 vehbrndm_id, vehbrndm_name, vehbrndm_desc, vehbrndm_vehtypm_id, 
					 vehtypm_sts, vehtypm_prty
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
		
		  where 
		  
		prodm_id !='' and prodm_sts ='a' and vehtypm_sts='a' and vehbrndm_sts='a' and vehmodlm_sts='a' and
		vehvrntm_sts='a' and tyrprflm_sts='a' and tyrrmszm_sts='a' and tyrwdthm_sts='a' and tyrbrndm_sts='a'  ";

$rwsvehbrnd_mst=mysqli_query($conn,$sqlvehbrnd_mst);
$carbrndcnt=mysqli_num_rows($rwsvehbrnd_mst);
$arrvehid=array();
$arrvehnm=array();

while($rowsvehbrnd_mst=mysqli_fetch_assoc($rwsvehbrnd_mst)){
	$arrvehid[]=$vehbrndid=$rowsvehbrnd_mst['vehtypm_id'];
	$arrvehids[$vehbrndid]=$vehbrndid;
	$arrvehnm[$vehbrndid]=$rowsvehbrnd_mst['vehtypm_name'];
	
	}
	 $brndvehcnt=count($arrvehid);
	
?>
		<section class="content-inner-2">
			<div class="container-fluid">
				<div class="section-head mb-4 text-center">
					<h3 class="title">Tyres By Vehicle Brands</h3>
				</div>

				<div class="d-flex justify-content-center mb-2">
					<ul class="nav nav-tabs style-1 m-b20">
                    <?php for($vbrnd=0;$vbrnd<$brndvehcnt;$vbrnd++){
                    if($arrvehnm[$vbrnd] !=''){?>
						<li class="nav-item"><a data-bs-toggle="tab" class="nav-link <?php if( $arrvehids[$vbrnd]=='1'){ echo 'active'; } ?>" aria-controls="car-brand" href="#vhbrnd<?php echo $arrvehids[$vbrnd] ?>"><?php echo $arrvehnm[$vbrnd] ?></a></li>
                            <?php } }?>
					
					</ul>

				</div>


				<div class="tab-content brand-vehicles container">
                 <?php for($vbrnd=0;$vbrnd<$brndvehcnt;$vbrnd++){
					 if($arrvehnm[$vbrnd] !=''){ 
					 
					 
					 
$vehnmb=funcStrRplc($arrvehnm[$vbrnd]);?>
                 
					<div class="tab-pane <?php if( $arrvehids[$vbrnd]=='1'){ echo 'active'; } ?> clearfix" id="vhbrnd<?php echo $arrvehids[$vbrnd] ?>">
						<div class="swiper-container deal-swiper swiper-dots-1">
							<div class="swiper-wrapper">
   <?php     $sqlvehbrnd_mst2="SELECT vehbrndm_vehtypm_id,vehbrndm_name,vehbrndm_id,
					  vehbrndm_brndimg, 
					vehbrndm_sts, vehbrndm_prty, 
					  prodm_id, prodm_sku, prodm_code, prodm_name,
		             tyrprflm_id,prodm_tyrrmsz,tyrrmszm_name
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
		
		  where 
		  
		prodm_id !='' and prodm_sts ='a' and vehtypm_sts='a' and vehbrndm_sts='a' and vehmodlm_sts='a' and
		vehvrntm_sts='a' and tyrprflm_sts='a' and tyrrmszm_sts='a' and tyrwdthm_sts='a' and tyrbrndm_sts='a' and    vehbrndm_vehtypm_id= $arrvehids[$vbrnd] group by vehbrndm_id order by vehbrndm_prty desc";

$rwsvehbrnd_mst2=mysqli_query($conn,$sqlvehbrnd_mst2);
 $carbrndcnt2=mysqli_num_rows($rwsvehbrnd_mst2);

while($rowsvehbrnd_mst2=mysqli_fetch_assoc($rwsvehbrnd_mst2)){

	$vehbrndimgnm=$rowsvehbrnd_mst2['vehbrndm_brndimg'];
	$vehbrndimgpth=$gvehbrndimg_usrpth.$vehbrndimgnm;
	if($vehbrndimgnm !='' && file_exists($vehbrndimgpth) ){
		$vehbrndimgpth=$rtpth.$gvehbrndimg_usrpth.$vehbrndimgnm;
		}else{
			$vehbrndimgpth="images/no-image.png";
			}
	$vehbrndname=$rowsvehbrnd_mst2['vehbrndm_name'];
	$vehbrndid =$rowsvehbrnd_mst2['vehbrndm_id'];
	$sr_vehbrndname=funcStrRplc($vehbrndname);
	
	$sr_vchtype=funcStrRplc($arrvehnm[$vbrnd]);
?>
								<div class="swiper-slide">
									<!--<a href="<?php echo $rtpth.$vehnmb.'/'.$sr_vehbrndname?>">-->
                                   <a href="<?php echo $rtpth ; ?>products.php?type=<?php echo $sr_vchtype?>&vehbrnd=<?php echo $vehbrndname ?>">
                                    
										<div class="vehicle-brand-img w-100">
											<img src="<?php echo $vehbrndimgpth ?>" class="w-100" alt="">
											<p class="text-center"><?php echo $vehbrndname ?></p>
										</div>
									</a>
								</div>
			<?php }?>
					

							</div>
							<div class="slider-one-pagination m-t40 m-sm-t20">
								<!-- Add Navigation -->
								<div class="swiper-pagination"></div>
							</div>
						</div>
					</div>
                    <?php } }?>
                    
			





				</div>





			</div>
		</section>


		<section class="content-inner about-sc content-inner-1 overlay-black-middle " style="background-image: url(images/background/home-abt-bg.jpg);background-size:cover;background-position: center;background-repeat:no-repeat;">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12">
						<div class="section-head style-1 left light-gray opacity">
							<div class="title-sm text-uppercase text-white text-center">About Us</div>
							<h2 class="h2 text-white text-center">Ashoka Tyres</h2>
							<div class="sep"></div>
						</div>
						<div class="row">
							<div class="col-md-6 m-b60">
							<p class="text-white">You’ve built best of the products. You’ve created best systems and processes to deliver what your customers are expecting of you. You’ve built a website that’s best in class, style and substance with end-to-end processes to browse, select and pay. Your business is truly digital isn’t it? Sadly no. Your customers need to find you on the Wide World Web. </p>
							</div>
							<div class="col-md-6 m-b60">
								<blockquote>
									Search Engine is the doorway to your website. 80% of the customers use Google, Bing and other search engines to find what they need. For your prospects to be your customers they need to find you where they are looking.
								</blockquote>
							</div>
						</div>
					</div>
				</div>
				<div class="row about-des m-b30">
					<div class="col-lg-3 col-sm-6 m-b30">
						<div class="icon-bx-wraper box-hover active style-5 p-a30 ">
							<div class="icon-md text-primary m-b10"> <a href="#" class="icon-cell">
									<i class="bi bi-cone-striped"></i>
								</a> </div>
							<div class="icon-content">
								<h5 class="dlab-tilte">ENHANCE SAFETY</h5>
								<p>Might sound simple but is the most crucial & critical part of our strategy. Might sound simple but is the most crucial & critical.</p>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-sm-6 m-b30">
						<div class="icon-bx-wraper box-hover active style-5 p-a30 ">
							<div class="icon-md text-primary m-b10"> <a href="#" class="icon-cell">
							<i class="bi bi-hand-thumbs-up-fill"></i>
								</a> </div>
							<div class="icon-content">
								<h5 class="dlab-tilte">GRIPPING CAPABILITY</h5>
								<p>Might sound simple but is the most crucial & critical part of our.</p>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-sm-6 m-b30">
						<div class="icon-bx-wraper box-hover active style-5 p-a30 ">
							<div class="icon-md text-primary m-b10"> <a href="#" class="icon-cell">
							<i class="bi bi-check2-square"></i>
								</a> </div>
							<div class="icon-content">
								<h5 class="dlab-tilte">QUALITY</h5>
								<p>Might sound simple but is the most crucial & critical part of our strategy. Might sound simple but is the most crucial & critical.</p>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-sm-6 m-b30">
						<div class="icon-bx-wraper box-hover active style-5 p-a30 ">
							<div class="icon-md text-primary m-b10"> <a href="#" class="icon-cell">
							<i class="bi bi-emoji-smile"></i>
								</a> </div>
							<div class="icon-content">
								<h5 class="dlab-tilte">TRUST</h5>
								<p>Might sound simple but is the most crucial & critical part of our strategy. Might sound simple but is the most crucial & critical.</p>
							</div>
						</div>
					</div>


				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="about-des-link text-center">
							<a href="" class="btn btn-primary m-r15 m-b10">Read more</a>

						</div>
					</div>
				</div>
			</div>
		</section>




		<!-- About Us -->
		<section class="content-inner overflow-hidden bg-gray">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="section-head style-1">
							<div class="row justify-content-center display-align">
								<div class="col-lg-8 m-b0 m-lg-b20">
								
									<h2 class="h2 text-center">Advantages</h2>
									<p class="m-b0 text-center">Adroit Infoactive Services will collaborate with you in thinking like your customer and connect with them when they are looking for products like yours.</p>
								</div>
						
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-4 col-md-6">
						<div class="icon-bx-wraper style-4 active box-hover text-center m-b30">
							<div class="icon-lg m-b20 text-primary"> <a href="#" class="icon-cell">
									<svg xmlns="http://www.w3.org/2000/svg" fill="#007fc4" height="60" width="60" viewBox="0 0 50 50">
										<path d="M49 27c0-2.757-2.243-5-5-5h-2v-3c0-9.374-7.626-17-17-17S8 9.626 8 19v3H6c-2.757 0-5 2.243-5 5v6c0 2.757 2.243 5 5 5h6V22h-2v-3A15.02 15.02 0 0 1 25 4a15.02 15.02 0 0 1 15 15v3h-2v16h2v5c0 1.654-1.346 3-3 3H27v2h10c2.757 0 5-2.243 5-5v-5h2c2.757 0 5-2.243 5-5v-6zm-39 9H6c-1.654 0-3-1.346-3-3v-6c0-1.654 1.346-3 3-3h4v12zm37-3c0 1.654-1.346 3-3 3h-4V24h4c1.654 0 3 1.346 3 3v6z" />
									</svg>
								</a> </div>
							<div class="icon-content">
								<h4 class="dlab-tilte m-b20 text-capitalize">Customer Support</h4>
								
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6">
						<div class="icon-bx-wraper style-4 text-center box-hover m-b30">
							<div class="icon-lg m-b20 text-primary"> <a href="#" class="icon-cell">
									<svg xmlns="http://www.w3.org/2000/svg" height="60" width="60" viewBox="0 0 32 32" fill="#007fc4">
										<path d="M29.334 3H25V1a1 1 0 1 0-2 0v2h-6V1a1 1 0 1 0-2 0v2H9V1a1 1 0 1 0-2 0v2H2.667C1.194 3 0 4.193 0 5.666v23.667A2.67 2.67 0 0 0 2.667 32h26.667C30.807 32 32 30.806 32 29.333V5.666C32 4.193 30.807 3 29.334 3zM30 29.333c0 .368-.299.667-.666.667H2.667A.67.67 0 0 1 2 29.333V5.666C2 5.299 2.299 5 2.667 5H7v2a1 1 0 1 0 2 0V5h6v2a1 1 0 1 0 2 0V5h6v2a1 1 0 1 0 2 0V5h4.334c.367 0 .666.299.666.666v23.667zM7 12h4v3H7zm0 5h4v3H7zm0 5h4v3H7zm7 0h4v3h-4zm0-5h4v3h-4zm0-5h4v3h-4zm7 10h4v3h-4zm0-5h4v3h-4zm0-5h4v3h-4z" />
									</svg>
								</a> </div>
							<div class="icon-content">
								<h4 class="dlab-tilte m-b20 text-capitalize">Reservation any time</h4>
								
							</div>
						</div>
					</div>
				
					<div class="col-lg-4 col-md-6">
						<div class="icon-bx-wraper style-4 text-center box-hover m-b30">
							<div class="icon-lg m-b20 text-primary"> <a href="#" class="icon-cell">
									<svg height="60" version="1.1" viewBox="0 0 60 52" width="60" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
										<title />
										<desc />
										<defs />
										<g fill="none" fill-rule="evenodd" id="People" stroke="none" stroke-width="1">
											<g fill="#007fc4" id="Icon-17" transform="translate(0.000000, -8.000000)">
												<path d="M40,59 C40,59.552 39.552,60 39,60 L37,60 C36.448,60 36,59.552 36,59 C36,58.448 36.448,58 37,58 L39,58 C39.552,58 40,58.448 40,59 M60,59 C60,59.552 59.552,60 59,60 L43,60 C42.448,60 42,59.552 42,59 C42,58.448 42.448,58 43,58 L59,58 C59.552,58 60,58.448 60,59 M32,59 C32,59.552 31.552,60 31,60 L21,60 C20.448,60 20,59.552 20,59 C20,58.448 20.448,58 21,58 L31,58 C31.552,58 32,58.448 32,59 M16,59 C16,59.552 15.552,60 15,60 L1,60 C0.448,60 0,59.552 0,59 C0,58.448 0.448,58 1,58 L15,58 C15.552,58 16,58.448 16,59 M2,39 C2,38.448 2.448,38 3,38 L5.84,38 L5.417,35.147 C5.336,34.601 5.713,34.092 6.259,34.011 C6.809,33.934 7.315,34.307 7.396,34.853 L7.863,38 L15,38 C15.552,38 16,38.448 16,39 C16,39.552 15.552,40 15,40 L3,40 C2.448,40 2,39.552 2,39 M3,30 L4.559,30 L4.136,27.147 C4.055,26.601 4.432,26.092 4.978,26.011 C5.528,25.935 6.034,26.307 6.114,26.853 L6.582,30 L15,30 C15.552,30 16,30.448 16,31 C16,31.552 15.552,32 15,32 L3,32 C2.448,32 2,31.552 2,31 C2,30.448 2.448,30 3,30 M15,50 C14.449,50 14,49.551 14,49 C14,48.449 14.449,48 15,48 C15.551,48 16,48.449 16,49 C16,49.551 15.551,50 15,50 M15,46 C13.346,46 12,47.346 12,49 C12,50.654 13.346,52 15,52 C16.654,52 18,50.654 18,49 C18,47.346 16.654,46 15,46 M49,50 C48.449,50 48,49.551 48,49 C48,48.449 48.449,48 49,48 C49.551,48 50,48.449 50,49 C50,49.551 49.551,50 49,50 M49,46 C47.346,46 46,47.346 46,49 C46,50.654 47.346,52 49,52 C50.654,52 52,50.654 52,49 C52,47.346 50.654,46 49,46 M49,54 C46.243,54 44,51.757 44,49 C44,46.243 46.243,44 49,44 C51.757,44 54,46.243 54,49 C54,51.757 51.757,54 49,54 M58.707,33.293 L55.966,30.552 L55,19 C55,16.243 52.757,14 50,14 L43,14 C42.448,14 42,14.448 42,15 C42,15.552 42.448,16 43,16 L50,16 C51.626,16 53,17.374 53.003,19.083 L53.913,30 L50.618,30 L51.895,27.447 C52.142,26.953 51.941,26.353 51.447,26.105 C50.952,25.858 50.353,26.059 50.105,26.553 L48.382,30 L43,30 C42.448,30 42,30.448 42,31 C42,31.552 42.448,32 43,32 L54.586,32 L57.293,34.707 C57.863,35.277 57.998,36.588 58,37 L58,48 L55.92,48 C55.433,44.613 52.52,42 49,42 C45.14,42 42,45.14 42,49 C42,52.86 45.14,56 49,56 C52.52,56 55.433,53.387 55.92,50 L59,50 C59.552,50 60,49.552 60,49 L60,37 C60,36.753 59.964,34.549 58.707,33.293 M15,54 C12.243,54 10,51.757 10,49 C10,46.243 12.243,44 15,44 C17.757,44 20,46.243 20,49 C20,51.757 17.757,54 15,54 M39,8 L7,8 C4.243,8 2,10.243 2,13 C2,13.05 2.004,13.099 2.011,13.148 L3.339,22 L1,22 C0.448,22 0,22.448 0,23 C0,23.552 0.448,24 1,24 L15,24 C15.552,24 16,23.552 16,23 C16,22.448 15.552,22 15,22 L5.361,22 L4.001,12.931 C4.038,11.309 5.369,10 7,10 L38,10 L38,48 L21.92,48 C21.433,44.613 18.52,42 15,42 C11.14,42 8,45.14 8,49 C8,52.86 11.14,56 15,56 C18.52,56 21.433,53.387 21.92,50 L39,50 C39.552,50 40,49.552 40,49 L40,9 C40,8.448 39.552,8 39,8" id="truck" />
											</g>
										</g>
									</svg>
								</a> </div>
							<div class="icon-content">
								<h4 class="dlab-tilte m-b20 text-capitalize">All Tyre Brands</h4>
								
							</div>
						</div>
					</div>
				
				</div>
			</div>
		</section>
		<!-- About Us -->
<section>

		<div class="section-full bg-img-fix content-inner bg-gray" id="project">
			<div class="container">
				<div class="text-center head-style-2 wow fadeIn" data-wow-duration="2s" data-wow-delay="0.2s">
					<h3 class="title text-uppercase mb-4">Tyres By Brands</h3>
				</div>
				<div class="site-filters style-1 clearfix center  m-b40">
					<ul class="filters" data-toggle="buttons">
						<li data-filter="" class="btn active">
							<input type="radio">
							<a href="javascript:void(0);" class="site-button-secondry wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s"><span>Show All</span></a>
						</li>
						
                                       <?php for($vbrnd=0;$vbrnd<$brndvehcnt;$vbrnd++){
                    if($arrvehnm[$vbrnd] !=''){?>
					
                        		<li data-filter=".<?php echo $arrvehids[$vbrnd] ?>-filter" class="btn">
							<input type="radio">
							<a href="javascript:void(0);" class="site-button-secondry wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.6s"><span><?php echo $arrvehnm[$vbrnd] ?></span></a>
						</li>
                            <?php } }?>

					</ul>
				</div>
				<ul id="masonry" class="row justify-content-center dlab-gallery-listing gallery-grid-4 gallery lightgallery m-b0">
   <?php for($vbrnd=0;$vbrnd<$brndvehcnt;$vbrnd++){
					 if($arrvehnm[$vbrnd] !=''){ 
					 
					 
					 
$vehnmb=funcStrRplc($arrvehnm[$vbrnd]);?>
   <?php     $sqlvehbrnd_mst2="SELECT vehbrndm_vehtypm_id,tyrbrndm_id,tyrbrndm_name,
					  tyrbrndm_brndimg, 
					vehbrndm_sts, vehbrndm_prty, 
					  prodm_id, prodm_sku, prodm_code, prodm_name,
		             tyrprflm_id,prodm_tyrrmsz,tyrrmszm_name
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
		
		  where 
		  
		prodm_id !='' and prodm_sts ='a' and vehtypm_sts='a' and vehbrndm_sts='a' and vehmodlm_sts='a' and
		vehvrntm_sts='a' and tyrprflm_sts='a' and tyrrmszm_sts='a' and tyrwdthm_sts='a' and tyrbrndm_sts='a' and    vehbrndm_vehtypm_id= $arrvehids[$vbrnd] group by tyrbrndm_id order by tyrbrndm_prty desc";

$rwsvehbrnd_mst2=mysqli_query($conn,$sqlvehbrnd_mst2);
 $carbrndcnt2=mysqli_num_rows($rwsvehbrnd_mst2);

while($rowsvehbrnd_mst2=mysqli_fetch_assoc($rwsvehbrnd_mst2)){

	$vehbrndimgnm=$rowsvehbrnd_mst2['tyrbrndm_brndimg'];
	$vehbrndimgpth=$gtyrbrndimg_usrpth.$vehbrndimgnm;
	if($vehbrndimgnm !='' && file_exists($vehbrndimgpth) ){
		$vehbrndimgpth=$rtpth.$gtyrbrndimg_usrpth.$vehbrndimgnm;
		}else{
			$vehbrndimgpth="images/no-image.png";
			}
	$vehbrndname=$rowsvehbrnd_mst2['tyrbrndm_name'];
	$vehbrndid =$rowsvehbrnd_mst2['tyrbrndm_id'];
	$sr_vehbrndname=funcStrRplc($vehbrndname);
	$sr_vchtype=funcStrRplc($arrvehnm[$vbrnd]);
	
?>
					<li class="<?php echo $arrvehids[$vbrnd] ?>-filter card-container col-lg-2 col-md-3 col-sm-4 col-6 wow fadeInUp m-b30" data-wow-duration="2s" data-wow-delay="0.1s">
						<div class="dlab-box dlab-gallery-box">
							<div class="dlab-media dlab-img-overlay1 dlab-img-effect zoom-slow"> <a href="<?php echo $rtpth ?>products.php?type=<?php echo $sr_vchtype?>&tyrbrnd=<?php echo $vehbrndname ?>"> <img src="<?php echo $vehbrndimgpth ?>" alt="">
								</a>
								<div class="overlay-bx">
									<div class="overlay-icon">
										<a href="<?php echo $rtpth ?>products.php?type=<?php echo $sr_vchtype ?>&tyrbrnd=<?php echo $vehbrndname ?>"> <i class="fa fa-link icon-bx-xs check-km"></i> </a>
										<span data-exthumbimage="<?php echo $vehbrndimgpth ?>" data-src="<?php echo $vehbrndimgpth ?>" class="fas fa-image icon-bx-xs check-km lightimg" title="Tyre Brands"></span>
									</div>
								</div>
							</div>
						</div>
					</li>

				
<?php }}} ?>

				</ul>
			</div>
		</div>
</section>
				<!-- OUR SERVICES -->
				<div class="section-full bg-blue content-inner" id="our-service">
			<div class="container">
				<div class="text-center head-style-2 wow fadeIn" data-wow-duration="2s" data-wow-delay="0.2s">
					<h3 class="title text-center text-uppercase text-white mb-4">How It Works</h3>
					<p class="text-white">More than 100,000+ tyres fitted at the Doorstep!</p>
				</div>
				<div class="row">
					<div class="col-lg-4 col-md-6 col-sm-6 wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.2s">
						<div class="cs-item style-6 center m-b40">
							<img src="images/how-it-works/tyre.png" class="mb-40 bg-orange" alt="">

							<div class="icon-content">
								<h5 class="dlab-tilte text-uppercase text-center mt-4">Select Tyres for Your Bike or Car</h5>
								
								<p class="text-center">Marketing is reaching prospects. Strategic marketing is about converting prospects into customers</p>
							</div>
						</div>
					</div>

					<div class="col-lg-4 col-md-6 col-sm-6 wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.2s">
						<div class="cs-item style-6 center m-b40">
							<img src="images/how-it-works/clock.png" class="mb-40 bg-orange" alt="">

							<div class="icon-content">
								<h5 class="dlab-tilte text-uppercase text-center mt-4">Fix your time slot and share your address</h5>
								<p class="text-center">Marketing is reaching prospects. Strategic marketing is about converting prospects into customers</p>
							</div>
						</div>
					</div>

					<div class="col-lg-4 col-md-6 col-sm-6 wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.2s">
						<div class="cs-item style-6 center m-b40">
							<img src="images/how-it-works/fast-delivery.png" class="mb-40 bg-orange" alt="">

							<div class="icon-content">
								<h5 class="dlab-tilte text-uppercase text-center mt-4">Our tyre experts will change tyres at your doorstep</h5>
								<p class="text-center">Marketing is reaching prospects. Strategic marketing is about converting.</p>
							</div>
						</div>
					</div>


				</div>
			</div>
		</div>
		<!-- OUR SERVICES END-->


		<!-- What peolpe are saying style 3 -->
		<div class="section-full bg-gray content-inner-1" id="client">
			<div class="container">
				<div class="text-center head-style-2 wow fadeIn" data-wow-duration="2s" data-wow-delay="0.2s">
					<h3 class="title text-center text-uppercase mb-4">Customers Views</h3>
				</div>
				<div class="section-content">
					<div class="testimonial-one swiper-container">
						<div class="swiper-wrapper">
							<div class="swiper-slide">
								<div class="testimonial-1 wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.2s">
									<div class="testimonial-text">
										<p>I, Anand Agarwal, Director at Manik Advertisers, engaged in the business of Media Buying & Advertising services would like to acknowledge the amazing service provided by Mr. Pradeep Agarwal.</p>
									</div>
									<div class="testimonial-detail clearfix">
										<div class="testimonial-pic quote-left radius shadow"><img src="images/testimonials/pic1.jpg" width="100" height="100" alt=""></div>
										<strong class="testimonial-name">Anand Agarwal</strong> 
									</div>
								</div>
							</div>
							<div class="swiper-slide">
								<div class="testimonial-1 wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.4s">
									<div class="testimonial-text">
										<p>I, Sanjay C jain from Agromaech Industries, am extremely pleased to associate with Adroit Infoactive Services. for my web based software development</p>
									
									</div>
									<div class="testimonial-detail clearfix">
										<div class="testimonial-pic quote-left radius shadow"><img src="images/testimonials/pic2.jpg" width="100" height="100" alt=""></div>
										<strong class="testimonial-name">Sanjay C Jain</strong> 
									</div>
								</div>
							</div>
							<div class="swiper-slide">
								<div class="testimonial-1 wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.6s">
									<div class="testimonial-text">
									
										<p>Architect Pradeep Agarwal, from Location Aarchitect, Interiors and Design. We are in to the project Management Consultants Category in BNI Artha. Hyderabad.</p>
									
									</div>
									<div class="testimonial-detail clearfix">
										<div class="testimonial-pic quote-left radius shadow"><img src="images/testimonials/pic3.jpg" width="100" height="100" alt=""></div>
										<strong class="testimonial-name">Rajesh Mishara</strong> 
									</div>
								</div>
							</div>
						</div>
						<div class="testimonial-pagination text-center m-t50">
							<div class="btn-prev swiper-button-prev7"><i class="las la-arrow-left"></i></div>
							<div class="btn-next swiper-button-next7"><i class="las la-arrow-right"></i></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- What peolpe are saying style 3 END -->


		<section class="content-inner">
			<div class="container">
				<div class="row call-to-action-bx">
					<div class="col-xl-5 col-lg-6 me-auto">
						<div class="section-head">
							<h2 class="title text-white">Have any question about us?</h2>
						</div>
						<a href="tel:984 900 3100" class="btn btn-white me-3 mb-2"><i class="fas fa-phone-volume me-sm-3 me-0 shake"></i><span class="d-sm-inline-block d-none">984 900 3100</span></a>
						<a href="#" class="btn btn-outline-white effect-1  mb-2"><span>Contact
								Us</span></a>
					</div>
					<div class="col-lg-6">
						<div class="media-box">
							<img src="images/question-img-aside.jpg" class="main-img" alt="">
							<img src="images/pattern/pattern7.png" class="pt-img move-1" alt="">
						</div>
					</div>
				</div>
			</div>
		</section>







	</div>


</div>
<?php include_once('footer.php'); ?>

<script>
							
  function funcflttyrtype(tyrtype){

	
  var tyrtypnm,tyrtypid; 

			 tyrtypid= document.getElementsByName('tyrtyp');
			
	for(i=0;i<tyrtypid.length;i++){
		if(tyrtypid[i].checked){
		tyrtypnm = tyrtypid[i].value;
		}
		
		}
  	
   // alert(vehtypnm);
  	$.ajax({
  		type: "POST",
  		url: "prdserchflt.php",
  		data:'vechtyrtypnm='+tyrtypnm,
  		success: function(data){
			//debugger;
  		// alert(data);
  			$("#getwdth").html(data);
			$('#getprofle').empty().append('<option  value="">Select</option>');
			$('#getrim').empty().append('<option  value="">Select</option>');
  		}
  	});
  }
    function funprofle(){

	
  var tyrtypnm,tyrtypid; 

			 tyrtypid= document.getElementsByName('tyrtyp');
			
	for(i=0;i<tyrtypid.length;i++){
		if(tyrtypid[i].checked){
		tyrtypnm = tyrtypid[i].value;
		}
		
		}
		var tyrewidth=document.getElementById('getwdth').value;
  	
   // alert(tyrtypnm);
  	$.ajax({
  		type: "POST",
  		url: "prdserchflt.php",
  		data:'vechtyrtypnm1='+tyrtypnm+'&tyrewidth='+tyrewidth,
		
  		success: function(data){
			//debugger;
  		// alert(data);
  			$("#getprofle").html(data);
			$('#getrim').empty().append('<option  value="">Select</option>');
  		}
  	});
  }
 function  funrim(){

	
  var tyrtypnm,tyrtypid; 

			 tyrtypid= document.getElementsByName('tyrtyp');
			
	for(i=0;i<tyrtypid.length;i++){
		if(tyrtypid[i].checked){
		tyrtypnm = tyrtypid[i].value;
		}
		
		}
		var tyrewidth=document.getElementById('getwdth').value;
		var tyreprfile=document.getElementById('getprofle').value;
  	
   // alert(tyrtypnm);
  	$.ajax({
  		type: "POST",
  		url: "prdserchflt.php",
  		data:'vechtyrtypnm2='+tyrtypnm+'&tyrewidth1='+tyrewidth+'&tyreprfile='+tyreprfile,
		
  		success: function(data){
			//debugger;
  		// alert(data);
  			$("#getrim").html(data);
  		}
  	});
  }
  
     function functyrrm(){
		   
		   $("#tyrszserch").removeAttr('disabled');	
	  
	  }
  </script>
<script>
							
  function funcfltvechtype(vechtype)
  {
	//alert(typeof (vechtype))
  	// debugger;
	
  var vehtypnm,vehtypid; 

			 vehtypid= document.getElementsByName('vechtye');
			
	for(i=0;i<vehtypid.length;i++){
		if(vehtypid[i].checked){
		vehtypnm = vehtypid[i].value;
		}
		
		}
  	
   // alert(vehtypnm);
  	$.ajax({
  		type: "POST",
  		url: "prdserchflt.php",
  		data:'vechtypnm='+vehtypnm,
  		success: function(data){
			//debugger;
  		// alert(data);
  			$("#getbrnd").html(data);
			
			
			
			$('#getmold').empty().append('<option  value="">Select</option>');
			$('#getvarnt').empty().append('<option  value="">Select</option>');
			
  		}
  	});
  }
    function funcfltvechbrnd()
  {
	//alert(typeof (vechtype))
  	//debugger;
				 vehtypid= document.getElementsByName('vechtye');
			
	for(i=0;i<vehtypid.length;i++){
		if(vehtypid[i].checked){
		vehtypnm = vehtypid[i].value;
		}
		
		}
  	var vechbrnd = $('#getbrnd').val();
 // alert(vehtypnm);
  	$.ajax({
  		type: "POST",
  		url: "prdserchflt.php",
  		data:'vechtypnm1='+vehtypnm+'&vechbrnd='+vechbrnd,
  		success: function(data){
			//debugger;
  		// alert(data);
  			$("#getmold").html(data);
			
			$('#getvarnt').empty().append('<option  value="">Select</option>');
			
  		}
  	});
  }
  
      function funcfltvechmold()
  {
	//alert(typeof (vechtype))
  //	debugger;
				 vehtypid= document.getElementsByName('vechtye');
			
	for(i=0;i<vehtypid.length;i++){
		if(vehtypid[i].checked){
		vehtypnm = vehtypid[i].value;
		}
		
		}
  	var vechbrnd = $('#getbrnd').val();
		var vechmodle = $('#getmold').val();
 // alert(vehtypnm);
  	$.ajax({
  		type: "POST",
  		url: "prdserchflt.php",
  		data:'vechtypnm2='+vehtypnm+'&vechbrnd='+vechbrnd+'&vechmodle='+vechmodle,
  		success: function(data){
			//debugger;
  		 //alert(data);
  			$("#getvarnt").html(data);
			
  		}
  	});
  }
       function funcfltvechvarnt(){
		   
		   $("#suBvechbrnd").removeAttr('disabled');	
	  
	  }
	  
	
	  
function suBmitvechbrnd(){
	var serurl="";
	var vehtypnm,vehtypid,
	 vehtypid= document.getElementsByName('vechtye');
			
	for(i=0;i<vehtypid.length;i++){
		if(vehtypid[i].checked){
		vehtypnm = vehtypid[i].value;
		}
		
		}
  	var serchvechbrnd = $('#getbrnd').val();
		var serchvechmodle = $('#getmold').val();
		var serchvechvarnt = $('#getvarnt').val();
		//alert(vehtypnm);
		if(vehtypnm !=''){
			if(serurl !=''){
		serurl +="&type="+vehtypnm;
		}else{
			serurl +="type="+vehtypnm;
			}
		}
		
		if(serchvechbrnd !=''){
			if(serurl !=''){
		serurl +="&vehbrnd="+serchvechbrnd;}else{
			serurl +="vehbrnd="+serchvechbrnd;
			}
		}
			if(serchvechmodle !=''){
			if(serurl !=''){
		serurl +="&vehmodel="+serchvechmodle;}else{
			serurl +="vehmodel="+serchvechmodle;
			}
		}
			if(serchvechvarnt !=''){
			if(serurl !=''){
		serurl +="&vehvarent="+serchvechvarnt;}else{
			serurl +="vehvarent="+serchvechvarnt;
			}
		
		}
		if(serchvechvarnt !='' && serchvechmodle !='' && serchvechbrnd !='' && vehtypnm !='' ){
			location.href="<?php echo $rtpth ?>products.php?"+serurl;}else{
				document.getElementById('suBvechbrnd').disabled=true;
				
				}
	}
	
	
	function suBtyrszserch(){
		
		  var tyrtypnm,tyrtypid; 
var serurl='';
			 tyrtypid= document.getElementsByName('tyrtyp');
			
	for(i=0;i<tyrtypid.length;i++){
		if(tyrtypid[i].checked){
		tyrtypnm = tyrtypid[i].value;
		}
		
		}
		var tyrewidth=document.getElementById('getwdth').value;
		var tyreprfile=document.getElementById('getprofle').value;
		var tyrerimsz=document.getElementById('getrim').value;
		//alert(tyrerimsz);
  			if(tyrtypnm !=''){
			if(serurl !=''){
		serurl +="&type="+tyrtypnm;}else{
			serurl +="type="+tyrtypnm;
			}
		
		}
					if(tyrewidth !=''){
			if(serurl !=''){
		serurl +="&tyrwdth="+tyrewidth;}else{
			serurl +="tyrwdth="+tyrewidth;
			}
		
		}
						if(tyreprfile !=''){
			if(serurl !=''){
		serurl +="&tyrprfl="+tyreprfile;}else{
			serurl +="tyrprfl="+tyreprfile;
			}
		
		}
						if(tyrerimsz !=''){
			if(serurl !=''){
		serurl +="&rimsz="+tyrerimsz;}else{
			serurl +="rimsz="+tyrerimsz;
			}
		
		}
		if(tyrerimsz !='' && tyreprfile !='' && tyrewidth !='' && tyrtypnm !=''){
			//alert(serurl);
			location.href="<?php echo $rtpth ?>products.php?"+serurl;
			
		}else{
			document.getElementById('tyrszserch').disabled=true;
			}
		
		}
</script>