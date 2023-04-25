<?php

	error_reporting(0);
	include_once 'includes/inc_nocache.php'; // Clearing the cache information
	//include_once "includes/inc_membr_session.php";//checking for session
	include_once "includes/inc_config.php";// site and  files confige	
	include_once "includes/inc_usr_sessions.php";
	include_once 'includes/inc_connection.php';//Make connection with the database
	include_once 'includes/inc_folder_path.php'; //Including Image resize function		
	include_once "includes/inc_config.php";
	include_once "includes/inc_usr_functions.php";

	/**********************Checking And Assigning Request Values *************************/
	if(isset($_REQUEST['action']) && (trim($_REQUEST['action']) != "")){
		$action	 = glb_func_chkvl($_REQUEST['action']); 	// Stores the action to be taken (add,update,delete)
	}
	
	/**********************Checking And Assigning *************************/	
	$ses_cart 	  = "";		
	$ses_cartcode = "";     // Stores the cartcode
 	$ses_prodqty  = "";    // Stores the session quantities
	$pgrval 	  =  $_SESSION['sesloc'];



	/**********************Assigning Values to Sessions *************************/

	if(isset($_SESSION['cart']) && (trim($_SESSION['cart'] != ""))){
		$ses_cart = $_SESSION['cart'];// Stores the cart detail
	}
	if(isset($_SESSION['cartcode']) && (trim($_SESSION['cartcode'] != ""))){
		$ses_cartcode = $_SESSION['cartcode'];// Stores the cartcode
	}
	if(isset($_SESSION['prodqty']) && (trim($_SESSION['prodqty'] != ""))){
		$ses_prodqty  = $_SESSION['prodqty'];    // Stores the session quantities
	}
	if(isset($_SESSION['prodid']) && (trim($_SESSION['prodid'] != ""))){
		$ses_prodid   = $_SESSION['prodid'];// Stores the session productid
	}
	if(isset($_SESSION['seschkcart']) && (trim($_SESSION['seschkcart'] != ""))){
		$ses_cartchk = $_SESSION['seschkcart'];// Stores the cartcode
	}
	if(isset($_SESSION['prodprc']) && (trim($_SESSION['prodprc']) != "")){
		$ses_prodprc = $_SESSION['prodprc'];	
	}
		
	 $regid    = $_SESSION['sesmbrid']; 
		
/*		if(!isset($_SESSION['cartcode']) || (trim($_SESSION['cartcode']) == ""))
	{
		header("Location:".$rtpth."index.php");
		exit();	
	}*/
	
	if(isset($_POST['btnSbmt']) && (trim($_POST['btnSbmt']) != "")){
	//var_dump($_POST);exit;
		include_once "database/iqry_cart_dtl.php";		
	}
$page_title = "My Cart";
$page_seo_title = "My Cart";
$db_seokywrd = "";
$db_seodesc = "";
$current_page = "about-us";
$body_class = "about-us-page";
include('header.php');
?>

<div class="page-content bg-white">
    <!-- Banner  -->
    <div class="dlab-bnr-inr short-banner style-1 overlay-black-middle"
        style="background-image: url(images/banner/bnr1.jpg);">
        <div class="container">
            <div class="dlab-bnr-inr-entry">
                <h1 class="text-white">My Cart</h1>
                <div class="d-flex justify-content-center align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">My Cart</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->
   <div class="row" id="carjax1">
 <form name="frmadrs" id="frmadrs" method="post" action="<?php $_SERVER['SCRIPT_NAME'];?>">
 <input type="hidden" value="<?php echo $regid;?>" id="mbrid" >
    <section class="my-cart-values">
        <div class="container">
            <!--Section: Block Content-->
            <section>

                <!--Grid row-->
                <div class="row">

                    <!--Grid column-->
                    <div class="col-lg-8">
	<?php if(isset($_SESSION['cartcode']) &&  (trim($_SESSION['cartcode']) != ""))
	{ ?>
                        <!-- Card -->
                        <div class="mb-3">
                                                 <?php			
				 $cartval    	= $_SESSION['cartcode'];
				 $prodidval  	= $_SESSION['prodid'];			 
				 $prodqtyval 	= $_SESSION['prodqty'];				 
				 if(($cartval != "") && ($prodidval != "") && ($prodqtyval != "")){
					$codearr	=	explode(",",$prodidval);
					$qtyarr		=	explode(",",$prodqtyval);	
					$newArray	=	$codearr;			
			  ?> 
                            <div class="pt-4 wish-list">

                                <h5 class="mb-4 text-primary">Cart (<span id="dsplyprodcnt"></span> items)</h5>
         
               <?php					
				
					$items 			= explode(',',$cartval);	
							
					$totqty    		= 0;
					$totxlcredits 	= 0;
					$totcartprc 	= 0;
					$totgrpprc  	= 0;
					$totdiscount 	= 0;
					
					$itmcnt = 0;
					$cntinc = 1;
					$totWt	   = 0;	
					
					$cnt=0;	
					foreach ($items as $items_id=>$items_val) 
					{		
																							
						$totuntprc = 0;
						$totbilprc = 0;	
															
					
						$cartcodeid  = ""; //For Storing the cart value id
						$cartcodeval = ""; //For Storing the cart code value
	
						$cartcodeid  = $items_id;
						$cartcodeval = $items_val; //  Stores the cart detail value
						$arr_cartcodeval  = explode("-",$cartcodeval);	
						
						 $cart_prodid	  = $arr_cartcodeval[0]; // Stores the product id 
						$cart_prcid	  = $arr_cartcodeval[1]; // Stores the product id 
						$cart_szid	  = $arr_cartcodeval[3];
					
						$untqty 		  = $qtyarr[$cartcodeid]; // Stores the unit quantities					
						if($cart_prodid != ""){					
							
												
												
											 	$sqryprod_dtl =    "select  prodm_id, prodm_sku, prodm_code, prodm_name, prodm_size, prodm_ptrn, prodm_cstprc,                       prodm_sleprc,  prodm_ofrprc, prodm_dsc, prodm_sdsc, prodm_st, prodm_sky, prodm_sotl,                       prodm_sodsc, prodm_sttle, prodm_stdsc, prodm_sts, prodm_rnk,vehtypm_id, vehtypm_name,prodd_id,
		              vehtypm_desc, vehtypm_seotitle, vehtypm_seodesc, vehtypm_seokywrd, vehtypm_seohonetitle,
		              vehtypm_seohonedesc, vehtypm_seohtwotitle, vehtypm_seohtwodesc, vehtypm_sts,
					  vehtypm_prty,vehbrndm_id, vehbrndm_name, vehbrndm_desc, vehbrndm_vehtypm_id, vehbrndm_brndimg,                       vehbrndm_sts, vehbrndm_prty, vehbrndm_seotitle, vehbrndm_seodesc, vehbrndm_seokywrd,                       vehbrndm_seohonetitle, vehbrndm_seohonedesc, vehbrndm_seohtwotitle, vehbrndm_seohtwodesc,
		              vehmodlm_id, vehmodlm_name,vehvrntm_id, vehvrntm_name,tyrprflm_id,tyrprflm_name,
		              tyrrmszm_id,tyrrmszm_name,tyrwdthm_id,tyrwdthm_name,tyrbrndm_id,tyrbrndm_name,
					    prodm_cstprc,
					   prodimgd_simg
				
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
		left join 	   prodimg_dtl on  prodimg_dtl.prodimgd_prodm_id= prod_mst.prodm_id
		  where 
		  
		prodm_id !='' and prodm_sts ='a' and vehtypm_sts='a' and vehbrndm_sts='a' and vehmodlm_sts='a' and
		vehvrntm_sts='a' and tyrprflm_sts='a' and tyrrmszm_sts='a' and tyrwdthm_sts='a' and tyrbrndm_sts='a'
												 and

												 prodm_id=' $cart_prodid' 

										

											"
										 ;
										 
						
							$srsprod_dtl  = mysqli_query($conn,$sqryprod_dtl);	
									
							$srowprod_dtl = mysqli_fetch_assoc($srsprod_dtl);
							 $cnt += 1;
						
      					    $crtprodid    	 = $srowprod_dtl['prodm_id'];
							$crtprodcode	 = $srowprod_dtl['prodm_code'];	
							$crtprodname	 = $srowprod_dtl['prodm_name'];	
                            $crtprodtyrbrndnm	 = $srowprod_dtl['tyrbrndm_name'];	
							$crtvechbrndid   	 = $srowprod_dtl['vehbrndm_id'];

					        $smlImgNm 	= $srowprod_dtl['prodimgd_simg'];
	    $smlImgPth 	= $rtpth.$gprodsimg_usrpth.$smlImgNm.'.jpg'; 
							$hsncode	 = $srowprod_dtl['prodm_hsn'];													
	
									$prc	 = $srowprod_dtl['prodm_cstprc'];	
									$totuntprc    = ($untqty * $prc);  
									$totcartprc   +=  $totuntprc; // Stores total cart price
			                        $totqty       += $untqty; // Stores total quantity
                $imgnm  = 	$srowprod_dtl['prodimgd_simg'];
                 $imgpth = 	$u_gsml_fldnm.$imgnm.'.jpg';	
               ?>
                                <div class="row mb-4">
                                    <div class="col-md-5 col-lg-3 col-xl-3">
                                        <div class="prdt-chk-side-img view zoom overlay z-depth-1 rounded mb-3 mb-md-0">
                                            <img class="img-fluid w-100 "  src="<?php echo  $smlImgPth ;?>" alt="Sample">
                                        </div>
                                    </div>
                                    <div class="col-md-7 col-lg-9 col-xl-9">
                                        <div>
       
                                            <div class="row d-flex justify-content-between">

                                                <div class="col-lg-8 col-md-8">
                                                    <h6><?php echo $crtprodname ; ?></h6>
                                                    
                                                    <p class="mb-2  text-uppercase small"><strong>Tyre Brand</strong> - <?php echo $crtprodtyrbrndnm ?></p>
                                                    
          
                                                                                                <p class="mb-2  text-uppercase small"><strong>Price</strong> - <?php echo $prc ?></p>
         
                                                    
                                                </div>
                                                <?php 

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
			$sqryclsbls = "SELECT prdinvt_clsbls from product_inventory where prdinvt_prdid = $crtprodid  and prdinvt_lcn = '$loc' order by prdinvt_id DESC limit 1";
			$srsclsbls = mysqli_query($conn,$sqryclsbls);
			$prod_clscnt = mysqli_num_rows($srsclsbls);
			$rwsclsbls = mysqli_fetch_assoc($srsclsbls);
			@$prdinvt += $rwsclsbls['prdinvt_clsbls'];
		}
	
		 $clsbls = $prdinvt; ?>
         <input type="hidden" value="<?php echo $crtvechbrndid ?>" id="vechbrndnid<?php echo $crtprodid ?>">
       
                                                <div class="col-lg-4 col-md-4">
                                                    <div class="d-flex">
                                                        <div class="number">
                                                        	<button class="minus" id="qntyinc<?php echo $crtprodid ?>" onclick ="cuntdec(<?php echo $untqty?>,<?php echo $crtprodid?>,<?php echo $clsbls?>)"  >-</button>
                                                      
                                                           
                                          <input type="text" name="txtqty"  id="txtqty<?php echo $crtprodid?>" value="<?php echo $untqty ?>" />
                                                         
                                                         
                                                            		<button class="plus"  id="qntydec<?php echo $crtprodid ?>" onclick ="cuntinc(<?php echo $untqty?>,<?php echo $crtprodid?>,<?php echo $clsbls?>,<?php echo $cntinc?>)" >+</button>
                                                        </div>
                                                    </div>
                                              
                                                    <small id="passwordHelpBlock w-100"
                                                        class="form-text text-muted text-center">
                                                        (Quantity)
                                                    </small>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="rm-wslists">
                                                    <a  type="button" onclick="funbDeletProd(<?php echo  $cartcodeid ;?>)"  class="card-link-secondary small text-capitalize mr-10px"><i class="fas fa-trash-alt mr-1"></i> Remove item </a>
                                                    
                                                    <a  type="button"  onclick="funprod(<?php echo  $crtprodid ;?>)" class="card-link-secondary small text-capitalize"><i class="fas fa-heart mr-1"></i> Move to wish list </a>
                                                </div>
                                                <p class="mb-0"><span><strong id="summary"><?php echo $totuntprc ;?></strong></span></p
                                                    class="mb-0">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <?php  }}  ?>    
                                
<input type="hidden" id="totlprodcnt" value="<?php echo  $cnt;?>" /> 
                                <hr class="mb-4">
                        
                            </div>
                            <?php } ?>
                        </div>
                        <!-- Card -->
     <?php if($regid !='' && isset($regid)){ ?>
                        <!-- Card -->
                        <div class="mb-3">
                          
                            <h5>Choose Delivery Type</h5>
                                       <div class="dl-option d-flex mt-4">
                                       
                            <div class=" mb-2 mr-2">
                            
                            <input type="radio" name="crtaddrsts" id="addrd" value="d" onclick="funChsdeltyp('d')" checked/><label for="addrd"><strong> Online Delivery</strong></label>
                            </div>
                            
                            <div class=" mb-2 mr-2">
                           
                            <input type="radio" name="crtaddrsts" id="addrdf" value="df"  onclick="funChsdeltyp('df')" /> <label for="addrdf"><strong>Doorstep Fitting</strong></label>
                            </div>
                            
                            <div class=" mb-2 mr-2 dropdown">
                           
                            <input type="radio"  name="crtaddrsts" id="addrfs" value="fs" onclick="funChsdeltyp('s')"  /> <label for="addrfs"><strong>Fitting At Store</strong></label>
                     
                            </div>

                            </div>
                           
                        </div>
                    
                         <div class ="row mult-addr" id="chkdeladd">
                           <div class="pt-4" >
       <h6 id="dchrg"  >Devilery Charges : 150 /- rs
         <input type="hidden" name="txtdevlrychrg" id="txtdevlrychrg" value="150"/></h6>
                         <h6 id="fchrgs" style="display:none" >Fitting Charges : 250 /- rs
                         
                         <input type="hidden" name="txtftngchrg" id="txtftngchrg" value="250"/>
                         
                         </h6>
                                <h5 class="">Expected shipping delivery</h5>

                                <p class="mb-0"> Thu., 12.03. - Mon., 16.03.</p>
                            </div>
                    
                       
                         
<?php 	 $sqrymbr_dtl =   "select mbrd_id,mbrd_fstname,mbrd_lstname, mbrd_badrs,mbrd_badrs2,mbrd_cmpny,ctym_name, mbrd_bzip,mbrd_bdayphone,cntrym_name, mbrd_ctynm,mbrd_bdayphone,mbrd_dfltbil,mbrd_dfltshp,mbrd_mbrm_id,mbrm_phno,mbrd_emailid,cntrym_name,cntym_name,cntntm_name,ctym_sts, cntym_sts,mbrm_emailid,mbrd_bmbrcntrym_id,mbrd_bmbrcntym_id,cntym_name,cntrym_name from vw_mbr_mst_dtl_bil 
	
	
	where mbrd_mbrm_id=$regid and mbrm_id = $regid order by mbrd_id   desc
				";


	  $srsmbr_mst	 =	mysqli_query($conn,$sqrymbr_dtl); 

       $cntrec    = @mysqli_num_rows($srsmbr_mst); 
	   if( $cntrec >0){?>
         <h6  >Select Delivery Address</h6>
   <?php 
                            		
	   }
$cnt=0;	 

	while($rowsmbr_dtl=mysqli_fetch_assoc($srsmbr_mst)){									
		$bilsts      = $rowsmbr_dtl['mbrd_dfltbil'];
		$shpsts      = $rowsmbr_dtl['mbrd_dfltshp'];
		$mbrmid       = $rowsmbr_dtl['mbrd_mbrm_id'];
		$mbrid       = $rowsmbr_dtl['mbrd_id'];
		$mbremail    = $rowsmbr_dtl['mbrd_emailid'];
		$mbrusername = $rowsmbr_dtl['mbrd_nckname'];
		$mbrname     = $rowsmbr_dtl['mbrd_fstname'];
		$mbraddr     = $rowsmbr_dtl['mbrd_badrs'];
		$mbrphno     = $rowsmbr_dtl['mbrd_bdayphone'];
		$mbrctynm    = $rowsmbr_dtl['mbrd_ctynm'];
		$mbrzip      = $rowsmbr_dtl['mbrd_bzip'];
		$mbrstateid     = $rowsmbr_dtl['mbrd_bmbrcntym_id'];
		$cntryname     = $rowsmbr_dtl['cntrym_name'];
		$statename      = $rowsmbr_dtl['cntym_name'];
		$billsts      = $rowsmbr_dtl['mbrd_dfltbil'];
		
		
		
		?>
                            <div class="col-md-12 " >
                            <div class="singl-add">
                             <input type="radio" name="addchk" value="<?php echo $mbrid;?>" id="chk<?php echo $mbrid;?>" <?php if($billsts =='y'){echo 'checked';}else{echo '';} ?> />   
                         <label for="chk<?php echo $mbrid; ?>"> 
                             <strong><?php echo $mbrname;  ?></strong> <?php echo '<br>'; ?><?php echo $mbraddr .',<br>'.$mbrctynm.','.$statename.','.$mbrzip ; ?>.
                           <?php echo '<br> Mobile No: '; ?>  <?php echo $mbrphno ?>
                             
                             </label></div>
                        
                              </div>
                              
                                <?php } ?>  
                              
                   
              
      
                                 </div>
                                   <div class ="row mult-addr" id="chkstr" style="display:none" >
                                 
                                                    <div class="col-md-6 " >
                                                    <label for="strloc">  <h6  >Select Nearest Store</h6></label>
                                   <select class="form-select" id="strloc" name="strloc"aria-label="Default select example" >
  <option value="" selected> Select Store</option>
  
  
  
  
  	<?php
											$sqrystr_loc_mst = "SELECT strlocm_id, strlocm_name from store_loc_mst order by strlocm_name";
											$srsstrloc_mst = mysqli_query($conn,$sqrystr_loc_mst);
											$cnt_str_loc = mysqli_num_rows($srsstrloc_mst);
										?>
									
											<?php
											while ($rowsstr_loc_mst = mysqli_fetch_array($srsstrloc_mst))
											{ ?>
										
											<option value="<?php echo $rowsstr_loc_mst["strlocm_id"]; ?>"><?php echo $rowsstr_loc_mst["strlocm_name"]; ?></option>
												<?php
											}
											?>
</select>  </div>  </div>
<?php }else{ ?>

								
                                        
<?php }?>
                        <!-- Card -->

                        <!-- Card -->
                        <div class="mb-3">
                            <div class="pt-2">

                                <h5 class="">We accept</h5>

                                <img class="mr-2" width="45px"
                                    src="https://mdbootstrap.com/wp-content/plugins/woocommerce-gateway-stripe/assets/images/visa.svg"
                                    alt="Visa">
                                <img class="mr-2" width="45px"
                                    src="https://mdbootstrap.com/wp-content/plugins/woocommerce-gateway-stripe/assets/images/amex.svg"
                                    alt="American Express">
                                <img class="mr-2" width="45px"
                                    src="https://mdbootstrap.com/wp-content/plugins/woocommerce-gateway-stripe/assets/images/mastercard.svg"
                                    alt="Mastercard">
                                <img class="mr-2" width="45px"
                                    src="https://mdbootstrap.com/wp-content/plugins/woocommerce/includes/gateways/paypal/assets/images/paypal.png"
                                    alt="PayPal acceptance mark">
                            </div>
                        </div>
                        <!-- Card -->
<?php }else{?>

										<a href="<?php $rtpth?>home" class="mt-3 view-details-btn btn btn-primary light phone-no shadow-none effect-1 w-100 text-center d-block"><span>Click Here to Add Products</span></a>
                                        
<?php } ?>
                    </div>
                    <!--Grid column-->

                    <!--Grid column-->
                    <div class="col-lg-4">

                        <!-- Card -->
                        <div class="mb-3">
                        		<div class="clearfix">
										<a href="<?php $rtpth?>home" class="mt-3 view-details-btn btn btn-primary light phone-no shadow-none effect-1 w-100 text-center d-block"><span>Continue Shopping</span></a>
                                          
									</div>
                            <div class="pt-4">

                                <h5 class="mb-3 text-primary">The total amount of</h5>

                                <ul class="list-group list-group-flush">
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                        Cart Value
                                        <span>$<?php  if($totcartprc >0){echo $totcartprc ;}else{
											
											echo '0.00';}; ?></span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                        Total Cart Value
                                        <span>$<?php  if($totcartprc >0){echo $totcartprc; }else{
											
											echo '0.00';}; ?></span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                        <div>
                                                              <input type="hidden" name="ntTogPrc" id="ntTogPrc" value="<?php echo $totcartprc; ?>" />
                                            <strong>The total amount of</strong>
                                            <strong>
                                                <p class="mb-0">(including GST)</p>
                                            </strong>
                                        </div>
                                        <span><strong>$<?php  if($totcartprc >0){echo $totcartprc; }else{
											
											echo '0.00';}; ?></strong></span>
                                    </li>
                                </ul>

                                

                              
									<div class="clearfix">
										<!--<a href="#" class="mt-3 view-details-btn btn btn-primary light phone-no shadow-none effect-1 w-100 text-center d-block"><span>Confirm to pay</span></a>-->
                                        <?php 
											 if(isset($_SESSION['cartcode']) &&  (trim($_SESSION['cartcode']) != ""))
	{ 
										if($regid !='' && isset($regid)){ ?>
                                           <button type="submit" name="btnSbmt" id="btnSbmt" value="Confirm Order" class=" view-details-btn btn btn-primary light phone-no shadow-none effect-1 w-100 text-center d-block p-5" /><span>Confirm Order</span></button>
                    <?php }else{ ?>                 		<a href="<?php $rtpth?>signin" class="mt-3 view-details-btn btn btn-primary light phone-no shadow-none effect-1 w-100 text-center d-block"><span>Login OR Register  To Continue</span></a>
								  <?php } } ?>
									</div>
								

                            </div>
                        </div>
                        <!-- Card -->

                        <!-- Card -->
                        <div class="mb-3">
                            <div class="pt-4">

                                <!-- <a class="dark-grey-text d-flex justify-content-between" data-toggle="collapse"
                                    href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                    Add a discount code (optional)
                                    <span><i class="fas fa-chevron-down pt-1"></i></span>
                                </a> -->

                                <a class="dark-grey-text d-flex justify-content-between" data-bs-toggle="collapse" href="#collapseExample"
                                    role="button" aria-expanded="false" aria-controls="collapseExample">
                                    Add a discount code (optional)<span><i class="fas fa-chevron-down pt-1"></i></span>
                                </a>

                                <div class="collapse" id="collapseExample">
                                    <div class="mt-3">
                                        <div class="cp-code md-form md-outline mb-0">
                                            <input type="text" id="discount-code" class="form-control font-weight-light"
                                                placeholder="Enter discount code">
                                        </div>
                                    </div>
                                </div>
                            </div>

                      
                        </div>
                        <!-- Card -->

                    </div>
                    <!--Grid column-->

                </div>
                <!-- Grid row -->

            </section>
            <!--Section: Block Content-->


        </div>
    </section>

 </form>

   </div>

</div>

  <script type="text/javascript">
  prdcnt ();	
   function prdcnt (){
var totlprdcnt=document.getElementById('totlprodcnt').value;
//alert(totlprdcnt);
document.getElementById('dsplyprodcnt').innerHTML =totlprdcnt;
   }
	 function cuntinc (incqty,prcid,totqty,cntinc){
	    prdid = prcid;
	   cnt = cntinc;
	  qty = parseInt( document.getElementById("txtqty"+prdid).value);
	  var count = qty;
				if(count >= totqty){

	       document.getElementById("qntydec"+cnt).disabled = true;

		}

		 if(count+1 <= totqty){

			   document.getElementById("txtqty"+prdid).value = count;
     
 

		}

      

	 }





	 function cuntdec (decqty,prcid,totqty,cntinc){

	 prdid = prcid;


	  cnt = cntinc;

	 dqty =document.getElementById("txtqty"+prdid).value;

	  var count = dqty;

	 if (count > 0) {

	  var button = document.getElementById("qntyinc"+cnt);

	   if( (count - 1) > 0) {

     document.getElementById("txtqty"+prdid).value = count;

   }



	  }

	 }





	function funbDeletProd(prdid){
	var cartcodeid=prdid;
	
		var delsts = confirm("Are you sure you want to delete this item ?.");

		if(delsts == true){

			

			
	
			var url = "<?php echo $rtpth; ?>manage_cart.php?cartaction=d&prodcode="+cartcodeid;


				xmlHttp = GetXmlHttpObject(stchng_UpdtCart);
				xmlHttp.open("GET", url, true);
				xmlHttp.send(null);
		}else{}
	
	}
	function stchng_UpdtCart() {
		if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
			var temp = xmlHttp.responseText;
			window.location = "<?php echo $rtpth; ?>my-cart.php";
		}}
		
	function funprod(prdid){
		//alert(prdid);
	var memid =document.getElementById('mbrid').value;
	//alert(memid);
 if(memid == ""){

				     mbrlgn();

					return false;

					}else{
var vehcbrndid=document.getElementById('vechbrndnid'+prdid).value;
//alert(vehcbrndid);
			var url = "<?php echo $rtpth;?>manage_wishlist.php?prodid="+prdid+"&memid="+memid+"&vehcbrndid="+vehcbrndid;
//alert(url);
			xmlHttp	= GetXmlHttpObject(stchng_UpdtWishList);

			xmlHttp.open("GET", url , true);

			xmlHttp.send(null);
					}
		

	}

	function stchng_UpdtWishList(){ 

		if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){ 					

			  var temp=xmlHttp.responseText;
 temp=temp.trim();

			  	if(temp == 'wy'){

			   prdadd();

			  }else{

			   prdalrdy();

				  }
		  	  
		}
	}		
	
function mbrlgn(){


$('#wishlistModal').modal('show'); 



}
	function prdadd(){



$('#wishlistprdModal').modal('show'); 



}



function prdalrdy(){



$('#wishlistalrdyModal').modal('show'); 



}
</script> 

<script>
   
function funChsdeltyp(sts){
	if(sts=='df'){
	document.getElementById('chkdeladd').style.display="block";
	document.getElementById('chkstr').style.display="none";
	document.getElementById('fchrgs').style.display="block";	
	document.getElementById('dchrg').style.display="none";
	}
	else if(sts=='d'){
		document.getElementById('chkdeladd').style.display="block";
	document.getElementById('chkstr').style.display="none";	
	document.getElementById('fchrgs').style.display="none";	
	document.getElementById('dchrg').style.display="block";
		
		}
	else{
		document.getElementById('chkdeladd').style.display="none";
	document.getElementById('chkstr').style.display="block";	
	document.getElementById('fchrgs').style.display="none";	
			document.getElementById('dchrg').style.display="none";
		}
	
	}
</script>
<?php include_once('footer.php'); ?>