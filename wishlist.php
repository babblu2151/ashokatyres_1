<?php
           
			include_once "includes/inc_membr_session.php";//checking for session	
			include_once 'includes/inc_nocache.php'; // Clearing the cache information
            include_once 'includes/inc_connection.php';//Make connection with the database  	
            include_once "includes/inc_config.php";	//path config file
		    include_once "includes/inc_usr_functions.php";//Including user session value
			include_once "includes/inc_folder_path.php";//  folder path confige
	global $gmsg,$email;		
	

	 $membrid   = $_SESSION['sesmbrid'];	



$page_title = "wish List";
$page_seo_title = "wish List";
$db_seokywrd = "";
$db_seodesc = "";
$current_page = "wish-list";
$body_class = "wish-list";
include('header.php');
?>


<div class="page-content bg-white"> 
  <!-- Banner  -->
  <div class="dlab-bnr-inr short-banner style-1 overlay-black-middle"
        style="background-image: url(<?php echo $rtpth;?>images/banner/bnr1.jpg);">
    <div class="container">
      <div class="dlab-bnr-inr-entry">
        <h1 class="text-white"><?php echo $page_title ?></h1>
        <div class="d-flex justify-content-center align-items-center">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo $rtpth;?>">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page"><?php echo $page_title ?></li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
  <!-- Banner End --> 
  
  <!-- Demo header-->
  <section class="py-4 header ac-pages-style">
    <div class="container py-4">
      <div class="row">
        <div class="col-md-3"> 
          <!-- Tabs nav -->
       <?php  include('acc_leftlinks.php'); ?>
        </div>
        <div class="col-md-9"> 
          <!-- Tabs content -->
       
            <!-------------------------------WishList Start------------------------------------------>
              
              <div class="row lightgallery wis-items">
              <?php
			  $sqlwshlst="select usrwshlstd_id, usrwshlstd_sesid, usrwshlstd_prodm_id, usrwshlstd_untm_id, usrwshlstd_vehbrnd_id, usrwshlstd_qty, usrwshlstd_mbrm_id, usrwshlstd_sts from usrwshlst_dtl where usrwshlstd_mbrm_id='$membrid' order by usrwshlstd_id";
			  $srswshlst  = mysqli_query($conn,$sqlwshlst);

		$cntwshlst  = mysqli_num_rows($srswshlst);
			 while( $srowwshlst=mysqli_fetch_assoc($srswshlst)){
				 $wshlst_id  =$srowwshlst['usrwshlstd_id'];
				 
			  $wshlstprodid  =$srowwshlst['usrwshlstd_prodm_id'];
				$wshlstvechbrndid =$srowwshlst['usrwshlstd_vehbrnd_id'];
				$wshlstmembrid =$srowwshlst['usrwshlstd_mbrm_id'];
			    	 $sqlprd_mst1="select  prodm_id, prodm_sku, prodm_code, prodm_name, prodm_size, prodm_ptrn, prodm_cstprc,                       prodm_sleprc,  prodm_ofrprc, prodm_dsc, prodm_sdsc, prodm_st, prodm_sky, prodm_sotl,                       prodm_sodsc, prodm_sttle, prodm_stdsc, prodm_sts, prodm_rnk,vehtypm_id, vehtypm_name,
		              vehtypm_desc, vehtypm_seotitle, vehtypm_seodesc, vehtypm_seokywrd, vehtypm_seohonetitle,
		              vehtypm_seohonedesc, vehtypm_seohtwotitle, vehtypm_seohtwodesc, vehtypm_sts,
					  vehtypm_prty,vehbrndm_id, vehbrndm_name, vehbrndm_desc, vehbrndm_vehtypm_id, vehbrndm_brndimg,                       vehbrndm_sts, vehbrndm_prty, vehbrndm_seotitle, vehbrndm_seodesc, vehbrndm_seokywrd,                       vehbrndm_seohonetitle, vehbrndm_seohonedesc, vehbrndm_seohtwotitle, vehbrndm_seohtwodesc,
		              vehmodlm_id, vehmodlm_name,vehvrntm_id, vehvrntm_name,tyrprflm_id,tyrprflm_name,
		              tyrrmszm_id,tyrrmszm_name,tyrwdthm_id,tyrwdthm_name,tyrbrndm_id,tyrbrndm_name,
					   if(prodm_sleprc > 10,prodm_sleprc, prodm_cstprc) as prodm_fnlprc
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
		  
		  prodm_sts ='a' and vehtypm_sts='a' and vehbrndm_sts='a' and vehmodlm_sts='a' and
		vehvrntm_sts='a' and tyrprflm_sts='a' and tyrrmszm_sts='a' and tyrwdthm_sts='a' and tyrbrndm_sts='a'
		and prodm_id='$wshlstprodid' and  vehbrndm_id='$wshlstvechbrndid' 
		
		";
		
		$srsprod_mst   = mysqli_query($conn,$sqlprd_mst1);

		$cntrec_prod   = mysqli_num_rows($srsprod_mst);

  if($cntrec_prod > 0){
		  $cnt = 0;
		  mysqli_data_seek($srsprod_mst,0);
  
		  $srowsprod_mst=mysqli_fetch_assoc($srsprod_mst);
  
				$prod_id	          = $srowsprod_mst['prodm_id'];
				$prodm_sku 	      = $srowsprod_mst['prodm_sku'];
				$prod_code 	      = $srowsprod_mst['prodm_code'];
				$prod_name 	      = $srowsprod_mst['prodm_name'];
				$prod_desc          = $srowsprod_mst['prodm_dsc'];	
				$prod_size          = $srowsprod_mst['prodm_size'];
				$prod_ptrn          = $srowsprod_mst['prodm_ptrn'];	
				$prod_cstprc        = $srowsprod_mst['prodm_cstprc'];	
				$prod_sleprc	      = $srowsprod_mst['prodm_sleprc'];
				$prod_fnlprc          = $srowsprod_mst['prodm_fnlprc'];
				$prod_ofrprc        = $srowsprod_mst['prodm_ofrprc'];
				$prod_img  	      = $srowsprod_mst['prodm_img']; 
				$prod_st	   	      = $srowsprod_mst['prodm_st'];
				$prod_sdsc	      = $srowsprod_mst['prodm_sdsc'];
				$prod_sky	          = $srowsprod_mst['prodm_sky'];
				$prod_sotl	      = $srowsprod_mst['prodm_sotl'];
				$prod_sodsc	      = $srowsprod_mst['prodm_sodsc'];
				$prod_sttle	      = $srowsprod_mst['prodm_sttle'];
				$prod_stdsc	      = $srowsprod_mst['prodm_stdsc'];
				$vehtyp_name	      = $srowsprod_mst['vehtypm_name'];
				$vehtyp_desc	      = $srowsprod_mst['vehtypm_desc'];
				$vehtyp_seotitle	  = $srowsprod_mst['vehtypm_seotitle'];
				$vehtyp_seodesc	  = $srowsprod_mst['vehtypm_seodesc'];
				$vehtyp_seokywrd	  = $srowsprod_mst['vehtypm_seokywrd'];
				$vehbrnd_name	      = $srowsprod_mst['vehbrndm_name'];
				$vehbrnd_desc	      = $srowsprod_mst['vehbrndm_desc'];
				$vehbrnd_brndimg	  = $srowsprod_mst['vehbrndm_brndimg'];
				$vehbrnd_seotitle	  = $srowsprod_mst['vehbrndm_seotitle'];
				$vehbrnd_seodesc	  = $srowsprod_mst['vehbrndm_seodesc'];
				$vehbrnd_seokywrd	  = $srowsprod_mst['vehbrndm_seokywrd'];
				$vehvrnt_name	      = $srowsprod_mst['vehvrntm_name'];
				$vehmodl_name	      = $srowsprod_mst['vehmodlm_name'];
				$vehtyrebrnd_name	      = $srowsprod_mst['tyrbrndm_name'];
				$vehtyrebrnd_id	      = $srowsprod_mst['tyrbrndm_id'];
			
			  $db_uprodnm	  = funcStrRplc($prod_name);
			  if (preg_match('/[-]/', $srowsprod_mst['prodm_code'])){
			  $prod_ucode     = funcStrRplcuscr($srowsprod_mst['prodm_code']);	
  
			  }else{
			  $prod_ucode     = funcStrRplc($srowsprod_mst['prodm_code']);	
   }
			  $db_uprodvehnm        = funcStrRplc($vehtyp_name);
			  $db_uprodvehbrndnm	  = funcStrRplc($vehbrnd_name);
  
			  $lnkname	  = "$rtpth$db_uprodvehnm/$db_uprodvehbrndnm/$db_uprodnm/$prod_ucode";
  
			  if($rdvl != ''){
  
				  $lnkname .= "/?$rdvl"; 
  }
	   $sqlimgdtl = "select prodimgd_simg
					  from prodimg_dtl where
					  prodimgd_prodm_id = $prod_id
					  order by  prodimgd_prty  desc  ";
		 $resimgdtl =mysqli_query($conn,$sqlimgdtl);
		 $rwsimgdtl = mysqli_fetch_array($resimgdtl);
		  $smlImgNm 	= $rwsimgdtl['prodimgd_simg'];
		
	       $smlImgPth 	= $rtpth.$gprodsimg_usrpth.$smlImgNm.'.jpg';
		 
			                                
		$sqry_loc = "SELECT strlocm_id, strlocm_name from store_loc_mst where strlocm_sts = 'a' order by strlocm_id ASC";
		$srslocdtls = mysqli_query($conn,$sqry_loc);
		$loc_cnt = mysqli_num_rows($srslocdtls);
		$loc_id = array();
		$loc_nm = array();
		
		while($rwslocdtls = mysqli_fetch_assoc($srslocdtls))
		{
			$loc = $rwslocdtls['strlocm_id'];
			$loc_name = $rwslocdtls['strlocm_name'];
			$loc_id[] = $loc;
			$loc_nm[] = $loc_name;
			$sqryclsbls = "SELECT prdinvt_clsbls from product_inventory where prdinvt_prdid = $wshlstprodid  and prdinvt_lcn = '$loc' order by prdinvt_id DESC limit 1";
			$srsclsbls = mysqli_query($conn,$sqryclsbls);
			$prod_clscnt = mysqli_num_rows($srsclsbls);
			$rwsclsbls = mysqli_fetch_assoc($srsclsbls);
			@$prdinvt += $rwsclsbls['prdinvt_clsbls'];
		}
	
		  $clsbls = $prdinvt;
			  
			   ?>
                <div class="col-lg-4 col-md-4 col-sm-6 col-12 m-b30">
                  <div class="car-list-box list-view">
                                  <?php if($clsbls <1){?>
                    <div class="align-items-center bg-primary p-2 text-white text-center" width="100%" ><strong>Out of stock</strong></div><?php }?>
                    <div class="media-box">
                   
                     <img src="<?php echo $smlImgPth ;?>" alt="">
      
                      <div class="rm-wsh"><span onclick=remvwshlstprd(<?php echo $wshlst_id ?>)><i class="fas fa-times"></i></span></div>
                      <div class="overlay-bx"> <span data-exthumbimage="<?php echo $smlImgPth ;?>"
                                                    data-src="<?php echo $smlImgPth ;?>" class="view-btn lightimg"> </span> </div>
                    </div>
                    <div class="list-info">
                      <h6 class="title mb-0"><a href="product-display.php" data-splitting
                                                    class="text-white"><?php echo $prod_name; ?></a></h6>
                      <div class="car-type">Sku:<?php echo $prodm_sku ;?><br/>
                       Tyre Brand: <?php echo $vehtyrebrnd_name ;?>
               
              </div>
                      <div class="d-flex justify-content-between align-items-center"> <span class="badge m-b10 mr-rt-5"><span>₹</span><?php echo $prod_fnlprc ; ?></span>
                          <?php if($clsbls >=1){?>
                      
                       <a href="javascript:;" onClick="javascript:frmprdsub('<?php echo $prod_id;?>','a')"
                                                    class="m-b10 view-details-btn btn btn-primary light phone-no shadow-none effect-1 w-100 text-center d-block"><span ><i
                                                            class="fas fa-cart-plus"></i></span></a><?php }
															
															
														/*	else{ ?>
                                  <a href=""
                                                    class="m-b10 view-details-btn btn btn-primary light phone-no shadow-none effect-1 w-100 text-center d-block"><span>Remove</span></a><?php }*/ ?>                            
                                                            
                                                            
                                                             </div>
                      <div class="prdt-prop mt-2">
                        <div class="d-flex justify-content-stretch align-items-center">
                          <div class="mr-rt-5">
                            <div class="prop-container">
                              <p>Low Noise</p>
                              <i class="fas fa-volume-down"></i> </div>
                          </div>
                          <div class="mr-rt-5">
                            <div class="prop-container">
                              <p>Smooth Ride</p>
                              <i class="fas fa-car-side"></i> </div>
                          </div>
                          <div class="">
                            <div class="prop-container">
                              <p>Dry & Wet Grip</p>
                              <i class="fas fa-cloud"></i> </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
           <?php }}?>
              </div>
            </div>
            <!-------------------------------WishList End------------------------------------------>
          
        </div>
      </div>
   
  </section>
  

  
</div>

<?php include_once("includes/inc_fnct_ajax_validation.php"); ?>
 <script src="<?php echo $rtpth ;?>js/yav.js" type="text/javascript"></script>
<script src="<?php echo $rtpth ;?>js/yav-config.js" type="text/javascript"></script>

<?php include_once('footer.php'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<script>
function remvwshlstprd(wshlstproid){
	

	if (confirm("Are you sure.Do you want to remove this product from wishlist") == true) {
	url="<?php echo $rtpth;?>manage_wishlist.php?wshlstprodid="+wshlstproid+"&wshlstacton=d";
		//alert(url);
	xmlHttp	= GetXmlHttpObject(stchng_Updtwshlst);
				xmlHttp.open("GET", url , true);
				xmlHttp.send(null);}else{
					
					}

	}
	function stchng_Updtwshlst(){
		
		if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){ 					

			  var temp=xmlHttp.responseText;
			  temp=temp.trim();

if(temp=='y'){
	location.reload();
	
	}else{
		alert("Product not Deleted from wishlist");
		
		}

		}
		
		
		
		}
</script>
<script>
function frmprdsub(pcode,crtactn){	

		 		var qtyval = 1;		  	

			if(crtactn == 'a'){		
							

				var url = "<?php echo $rtpth;?>manage_cart.php?prodidval="+pcode+"&cartaction="+crtactn+"&rqst_prodqty="+qtyval;
				//alert(url);
				xmlHttp	= GetXmlHttpObject(stchng_UpdtCart);
				xmlHttp.open("GET", url , true);
				xmlHttp.send(null);

			}



		



	}





	function stchng_UpdtCart(){ 



		if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){ 					



		   var temp=xmlHttp.responseText;



		   var crtval = new Array();



		   crtval = temp.split('->');

//alert(temp)

		   var addsts  		= crtval[0];



		   var dispval 		= crtval[1];



		   var disptopcart  = crtval[2];



		   var displstitm   = crtval[3];		   



		   var atchslvs   = crtval[4];		   



		   var altrned   = crtval[5];



		  var altrtyp   = crtval[6];		   



		  var incval   = crtval[7];		   



		  var prdnm   = crtval[8];		   



		  var prdqty   = crtval[9];		   



		  var prdsz  = crtval[10];		   



            



//	alert(addsts)



		 



		   if(addsts == 1){



		               location.href="<?php echo $rtpth;?>my-cart.php";



				document.getElementById('divshopbag').innerHTML = dispval;



				document.getElementById('divcart_top').innerHTML = disptopcart;



				document.getElementById('dialog').innerHTML = displstitm;				



			    document.getElementById('prdqty').innerHTML = prdqty;	



				document.getElementById('prdnm').innerHTML = prdnm;	



				document.getElementById('prdsz').innerHTML = prdsz;	



		   }else{



			   document.getElementById("prdext").style.display="inline-block";



			   document.getElementById("discrt").style.display="inline-block";



			   document.getElementById("addcrt").style.display="none";







			   



			   }



		}



	}
</script>