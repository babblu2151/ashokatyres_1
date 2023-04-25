<?php
           
			include_once "includes/inc_membr_session.php";//checking for session	
			include_once 'includes/inc_nocache.php'; // Clearing the cache information
            include_once 'includes/inc_connection.php';//Make connection with the database  	
            include_once "includes/inc_config.php";	//path config file
		    include_once "includes/inc_usr_functions.php";//Including user session value
	global $gmsg,$email;		
	

	 $membrid   = $_SESSION['sesmbrid'];	

	$msid 	   = trim($_REQUEST['hdnmsid']);

	$mdid 	   = trim($_REQUEST['hdnmdid']);

	$sqrymbr_dtl =   "select mbrd_id,mbrd_fstname,mbrd_lstname, mbrd_badrs,mbrd_badrs2,mbrd_cmpny,ctym_name, mbrd_bzip,mbrd_bdayphone,cntrym_name, mbrd_ctynm,mbrd_bdayphone,mbrd_dfltbil,mbrd_dfltshp,mbrd_mbrm_id,mbrm_phno,mbrd_emailid,cntrym_name,cntym_name,cntntm_name,ctym_sts, cntym_sts,mbrm_emailid,mbrd_bmbrcntrym_id,mbrd_bmbrcntym_id,cntym_name,cntrym_name from vw_mbr_mst_dtl_bil 
	
	
	where mbrd_mbrm_id=$membrid and mbrm_id = $membrid order by mbrd_dfltbil = 'y'  desc
				";


	  $srsmbr_mst	 =	mysqli_query($conn,$sqrymbr_dtl); 

       $cntrec    = @mysqli_num_rows($srsmbr_mst);

	


$page_title = "Billing & Shipping Address";
$page_seo_title = "Billing & Shipping Address";
$db_seokywrd = "";
$db_seodesc = "";
$current_page = "about-us";
$body_class = "about-us-page";
include('header.php');
?>
<style>
.innerError {
	color: red;
}

</style>
<script>

	function funcRdAdd(){

		location.href = "<?php echo $rtpth;?>add-address";

	}

	function ChngAdr(frmname){

	

	document.getElementById(frmname).action = "<?php echo $rtpth;?>my-account";

	document.getElementById(frmname).submit();

	}

</script>

<div class="page-content bg-white"> 
  <!-- Banner  -->
  <div class="dlab-bnr-inr short-banner style-1 overlay-black-middle"
        style="background-image: url(<?php echo $rtpth;?>images/banner/bnr1.jpg);">
    <div class="container">
      <div class="dlab-bnr-inr-entry">
        <h1 class="text-white">Billing & Shipping Address</h1>
        <div class="d-flex justify-content-center align-items-center">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo $rtpth;?>">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Billing & Shipping Address</li>
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
          <div class="tab-content" id="v-pills-tabContent">
            <div class="tab-pane fade shadow rounded bg-white show active p-3" id="v-pills-home"
                            role="tabpanel" aria-labelledby="v-pills-home-tab">
              <h4 class="mb-2">Address Details <a href="<?php $rtpth ?>add-address" class=" custom-btns-bot pull-right"><span><i class="far fa-plus-square mr-2"></i>ADD </span></a></h4>
              <div class="row">
                <?php 
                            		

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
                <div class="col-lg-6 col-md-6">
                  <div class="add-mul">
                    <h6 class="cs-name"><?php echo $mbrname  ?></h6>
                    <p><?php echo $mbraddr .',</br>'.$mbrctynm.','.$statename.',</br>'.$cntryname .','. $mbrzip  ?></p>
                    <p><strong>Contact No : </strong><span><?php echo $mbrphno  ?></span></p>
                    <p><strong>Email Id : </strong><span><?php echo $mbremail  ?></span></p>
                    <div class="row" >
                      <div class="col-4  "> <a href="#" class=" custom-btns-bot" data-toggle="modal"
                                            data-target="#exampleModal<?php echo $mbrid ?>"><span><i class="far fa-edit mr-2"></i>Edit </span></a></div>
                      <div class="col-5"> <a href="#" class=" custom-btns-bot" onclick="delmemdtl(<?php echo $mbrid ?>)"><span><i class="far fa-trash-alt mr-2"></i>Delete </span></a> </div>
                      <div class="col-3">
                        <?php if( $billsts =='y'){?>
                        <a class=" custom-btns-bot" ><span><i class="far fa-check-square "></i> </span></a>
                        <?php }else{ ?>
                        <input type="checkbox" name="sts" id="sts" onclick="memdtlsts(<?php echo $mbrid ?>,<?php echo $mbrmid ?>)" />
                        <?php } ?>
                      </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal<?php echo $mbrid ?>" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title" id="exampleModalLabel">Edit Address</h4>
                            <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                          </div>
                          <div class="modal-body edit-address-modal">
                            <form name="frmedtdtls" id="frmedtdtls" method="post"  onSubmit="return performCheck('frmedtdtls',snrules,'inline');"   enctype="multipart/form-data" >
                              <div class="row">
                                <input type="hidden" id="hsdnmemid<?php echo $mbrid  ?>" name="hsdnmemid<?php echo $mbrid ?>" value="<?php echo $mbrmid  ?>" >
                                <div class="col-lg-4 col-md-4 form-group">
                                  <label for="">Email</label>
                                  <input type="text"  value="<?php echo $mbremail  ?>" class="form-control" disabled>
                                  <input type="hidden" id="txtemail<?php echo $mbrid ?>" name="txtemail<?php echo $mbrid ?>" value="<?php echo $mbremail  ?>" class="form-control">
                                </div>
                                <div class="col-lg-4 col-md-4 form-group">
                                  <label for="">Name</label>
                                  <input type="text" id="txtname<?php echo $mbrid ?>" name="txtname<?php echo $mbrid ?>" value="<?php echo $mbrname  ?>"  class="form-control">
                                    <span id="errorsDiv_txtname<?php echo $mbrid ?>"></span>
                                </div>
                                <div class="col-lg-4 col-md-4 form-group">
                                  <label for="">Mobile No</label>
                                  <input type="text" id="txtphno<?php echo $mbrid ?>" name="txtphno<?php echo $mbrid ?>" value="<?php echo $mbrphno ?>"
                                                                        class="form-control">
                                <span id="errorsDiv_txtphno<?php echo $mbrid ?>"></span>
                                </div>
                                <div class="col-lg-4 col-md-4 form-group">
                                  <label for="">Address</label>
                                  <input type="text" id="txtaddr<?php echo $mbrid ?>" name="txtaddr<?php echo $mbrid ?>" value="<?php echo $mbraddr  ?>"  class="form-control">
                                                                                              <span id="errorsDiv_txtaddr<?php echo $mbrid ?>"></span>
                                </div>
                                <div class="col-lg-4 col-md-4 form-group">
                                  <label for="">Country</label>
                                  <select name="lstcntry<?php echo $mbrid ?>" id="lstcntry<?php echo $mbrid ?>"
                                                                        class="form-control" onchange="funcPopCnty()">
                                    <option value="2" selected=""> India</option>
                                  </select>
                                </div>
                                <div class="col-lg-4 col-md-4 form-group">
                                  <label for="">State</label>
                                  <select name="lststate<?php echo $mbrid ?>" id="lststate<?php echo $mbrid ?>"
                                                                        class="form-control">
                                    <?php   $sqrymbrcnty_mst =  "select 
								  cntym_id,cntym_name,cntym_sts
						     from 
							     cnty_mst 
							
						   where
							 	 (cntym_sts ='a' or cntym_sts ='u') and
							     cntym_cntrym_id = 2
						   group by 
							 	 cntym_id 
							order by 
								 cntym_name";
		$srsmbrcnty_mst	  = mysqli_query($conn,$sqrymbrcnty_mst) or die(mysql_error());
		$dispstr		  = "";
		while($srowmbrcnty_mst = mysqli_fetch_assoc($srsmbrcnty_mst)){
			$cntymid  = $srowmbrcnty_mst['cntym_id'];
			$cntymnm  = $srowmbrcnty_mst['cntym_name'];	
			$cntysts  = $srowmbrcnty_mst['cntym_sts'];	
           ?>
                                    <option value="<?php echo $cntymid ?>" <?php if($cntymid==$mbrstateid ){ echo 'selected';}else{echo '';}?>><?php echo $cntymnm ?></option>
                                    <?php } ?>
                                  </select>
                                                                              <span id="errorsDiv_lststate<?php echo $mbrid ?>"></span>
                                </div>
                                <div class="col-lg-4 col-md-4 form-group">
                                  <label for="">City</label>
                                  <input type="text" id="txtcty<?php echo $mbrid ?>" name="txtcty<?php echo $mbrid ?>" value="<?php echo $mbrctynm ; ?>"
                                                                        class="form-control">
                                                                                                                                   <span id="errorsDiv_txtcty<?php echo $mbrid ?>"></span>
                                </div>
                                <div class="col-lg-4 col-md-4 form-group">
                                  <label for="">Pin Code</label>
                                  <input type="text" id="txtpin<?php echo $mbrid ?>" name="txtpin<?php echo $mbrid ?>" value="<?php echo $mbrzip; ?>"
                                                                        class="form-control">
                                                                           <span id="errorsDiv_txtpin<?php echo $mbrid ?>"></span>
                                </div>
                                <div class="col-lg-4 col-md-4 form-group">
                                  <label for="">Status</label>
                                  <select name="lssts<?php echo $mbrid ?>" id="lssts<?php echo $mbrid ?>"
                                                                        class="form-control" >
                                    <option value="y" <?php if($billsts=='y'){echo 'selected';}else{} ?>> Active</option>
                                    <option value="n" <?php if($billsts=='n'){echo 'selected';}else{} ?>> Inactive </option>
                                  </select>
                                </div>
                              </div>
                            </form>
                          </div>
                          <div class="modal-footer">
                            <input type="submit" class="btn btn-primary" onclick="edituserdtl(<?php echo $mbrid ?>)" value="update">
                            </button>
                            <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Reset</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <?php } ?>
              </div>
            </div>
             <!-------------------------------Address End------------------------------------------>
            <!-------------------------------WishList Start------------------------------------------>
                <div class="tab-pane fade shadow rounded bg-white p-3" id="v-pills-profile" role="tabpanel"
                            aria-labelledby="v-pills-profile-tab">
              <div class="row lightgallery wis-items">
                <div class="col-lg-4 col-md-4 col-sm-6 col-12 m-b30">
                  <div class="car-list-box list-view">
                    <div class="media-box"> <img src="images/product/grid/pic1.jpg" alt="">
                      <div class="rm-wsh"><a href=""><i class="fas fa-times"></i></a></div>
                      <div class="overlay-bx"> <span data-exthumbimage="images/product/grid/pic1.jpg"
                                                    data-src="images/product/grid/pic1.jpg" class="view-btn lightimg"> </span> </div>
                    </div>
                    <div class="list-info">
                      <h6 class="title mb-0"><a href="product-display.php" data-splitting
                                                    class="text-white">Goodyear 205/55 R16 Eagle NCT5 91V Tubeless Car
                        Tyre</a></h6>
                      <div class="car-type">Sku: CE2356517ZATL</div>
                      <div class="d-flex justify-content-between align-items-center"> <span class="badge m-b10 mr-rt-5"><span>₹</span>8,299.00</span> <a href="product-display.php"
                                                    class="m-b10 view-details-btn btn btn-primary light phone-no shadow-none effect-1 w-100 text-center d-block"><span><i
                                                            class="fas fa-cart-plus"></i></span></a> </div>
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
                <div class="col-lg-4 col-md-4 col-sm-6 col-12 m-b30">
                  <div class="car-list-box list-view">
                    <div class="media-box"> <img src="images/product/grid/pic2.jpg" alt="">
                      <div class="rm-wsh"><a href=""><i class="fas fa-times"></i></a></div>
                      <div class="overlay-bx"> <span data-exthumbimage="images/product/grid/pic2.jpg"
                                                    data-src="images/product/grid/pic1.jpg" class="view-btn lightimg"> </span> </div>
                    </div>
                    <div class="list-info">
                      <h6 class="title mb-0"><a href="product-display.php" data-splitting
                                                    class="text-white">Goodyear 205/55 R16 Eagle NCT5 91V Tubeless Car
                        Tyre</a></h6>
                      <div class="car-type">Sku: CE2356517ZATL</div>
                      <div class="d-flex justify-content-between align-items-center"> <span class="badge m-b10 mr-rt-5"><span>₹</span>8,299.00</span> <a href="product-display.php"
                                                    class="m-b10 view-details-btn btn btn-primary light phone-no shadow-none effect-1 w-100 text-center d-block"><span><i
                                                            class="fas fa-cart-plus"></i></span></a> </div>
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
                <div class="col-lg-4 col-md-4 col-sm-6 col-12 m-b30">
                  <div class="car-list-box list-view">
                    <div class="media-box"> <img src="images/product/grid/pic3.jpg" alt="">
                      <div class="rm-wsh"><a href=""><i class="fas fa-times"></i></a></div>
                      <div class="overlay-bx"> <span data-exthumbimage="images/product/grid/pic3.jpg"
                                                    data-src="images/product/grid/pic1.jpg" class="view-btn lightimg"> </span> </div>
                    </div>
                    <div class="list-info">
                      <h6 class="title mb-0"><a href="product-display.php" data-splitting
                                                    class="text-white">Goodyear 205/55 R16 Eagle NCT5 91V Tubeless Car
                        Tyre</a></h6>
                      <div class="car-type">Sku: CE2356517ZATL</div>
                      <div class="d-flex justify-content-between align-items-center"> <span class="badge m-b10 mr-rt-5"><span>₹</span>8,299.00</span> <a href="product-display.php"
                                                    class="m-b10 view-details-btn btn btn-primary light phone-no shadow-none effect-1 w-100 text-center d-block"><span><i
                                                            class="fas fa-cart-plus"></i></span></a> </div>
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
              </div>
            </div>
            <!-------------------------------WishList End------------------------------------------>
             <!----------------------------------- change password Start-------------------------------------->
            <div class="tab-pane fade shadow rounded bg-white p-3" id="v-pills-messages" role="tabpanel"
                            aria-labelledby="v-pills-messages-tab">
              <div class="section login-register">
                <div class="row justify-content-center">
                  <div class="col-lg-8 col-md-8 col-sm-8 col-12">
                    <div class="" id="">
                      <div class="">
                        <div class="accordion-body car-body">
                        <script language="javascript" type="text/javascript"> 
          var chngpwd=new Array();
             chngpwd[0]='txtpwdold:OldPassword|required|Enter Old Password ';
             chngpwd[1]='txtpwd:Password|required|Enter New Password ';
			 chngpwd[2]='txtcpwd:Password|required|Enter Confirm Password ';
			 chngpwd[3]='txtsgnpwd:Password|required|Enter Password ';
          </script>
                            <form name="frmchngpwd" id="frmchngpwd" method="post" class="row mb-0"  onSubmit="return performCheck('frmchngpwd',chngpwd,'inline');"   enctype="multipart/form-data" >                             
                            <div class="col-12 form-group">
                              <label for="txtpwdold">Old Password:</label>
                              <input type="password" id="txtpwdold" name="txtpwdold" class="form-control">
                              <span id="errorsDiv_txtpwdold"></span>
                            </div>
                            <div class="col-12 form-group">
                              <label for="login-form-password">New Password:</label>
                              <input type="password" id="txtpwd" name="txtpwd"  class="form-control">
                              <span id="errorsDiv_txtpwd"></span>
                            </div>
                            <div class="col-12 form-group">
                              <label for="login-form-password">Confirm Password:</label>
                              <input type="password" id="txtcpwd"  name="txtcpwd"  class="form-control">
                              <span id="errorsDiv_txtcpwd"></span>
                            </div>
                            <div
                                                            class="col-12 form-group d-flex justify-content-start chnge-pas">
                              <input type="submit" class="btn btn-primary " id="btnchngpwd"  name="btnchngpwd" value="Update">
                              <button class="btn btn-secondary m-0" id="login-form-submit"
                                                                name="login-form-submit" value="login">Reset</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
               <!----------------------------------- change password End-------------------------------------->
             <!----------------------------------My Oders Start------------------------------------->
            <div class="tab-pane fade shadow rounded bg-white p-3" id="v-pills-settings" role="tabpanel"
                            aria-labelledby="v-pills-settings-tab">
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th class="">Order Id</th>
                      <th class="">Total Amount</th>
                      <th class="">Payment Mode</th>
                      <th class="">No. Items</th>
                      <th class="">Order Date</th>
                      <th class="">Payment status</th>
                      <th class="">Order status</th>
                      <th class="">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">1</th>
                      <td>400</td>
                      <td>Online</td>
                      <td>2</td>
                      <td>02-11-2021 05:09:06</td>
                      <td>Yes</td>
                      <td align="center"><a
                                                    class="btn btn-primary btn-sm text-white">Delivered</a></td>
                      <td align="center"><a class="btn btn-primary btn-sm" href="#">View</a></td>
                    </tr>
                    <tr>
                      <th scope="row">1</th>
                      <td>400</td>
                      <td>Online</td>
                      <td>2</td>
                      <td>02-11-2021 05:09:06</td>
                      <td>Yes</td>
                      <td align="center"><a
                                                    class="btn btn-primary btn-sm text-white">Delivered</a></td>
                      <td align="center"><a class="btn btn-primary btn-sm" href="#">View</a></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
              <!----------------------------------My Oders End------------------------------------->
            
          </div>
        </div>
      </div>
    </div>
  </section>
  
  <!-- <div class="container tog-btn my-4">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="accounts-pages collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <li class="nav-item"> <a class="nav-link" aria-current="page"
                                href="billing-shipping-address.php">Address Details</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Wishlists</a> </li>
                        <li class="nav-item"><a class="nav-link" href="#">Change Password</a> </li>
                        <li class="nav-item"><a class="nav-link" href="#">My Order</a> </li>
                    </ul>

                </div>
            </div>
        </nav>
    </div> --> 
  
</div>
<?php include_once("includes/inc_fnct_ajax_validation.php"); ?>
<script>
function memdtlsts(memdtlid,memid){

	 let sts = "Do You Want to Active Status for  this Address .";
	 if (confirm(sts) == true) {
   
 
			 url = "<?php echo $rtpth;?>edtuser_details.php?stsdtl=y&memdtlid="+memdtlid+"&memid="+memid;
			
			  } else {
   
  }			xmlHttp	= GetXmlHttpObject(stchng_deluserDtls);



			xmlHttp.open("GET", url , true);



			xmlHttp.send(null);
	}
function delmemdtl (memdid){
	  let text = "Do You Want Delete this Address Details.";
  if (confirm(text) == true) {
   
 
			 url = "<?php echo $rtpth;?>edtuser_details.php?delete=y&memdid="+memdid;
			  } else {
   
  }
			xmlHttp	= GetXmlHttpObject(stchng_deluserDtls);



			xmlHttp.open("GET", url , true);



			xmlHttp.send(null);
	
	}
	function stchng_deluserDtls(){
		if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){ 					



		   var delusertemp=xmlHttp.responseText;

delusertemp=delusertemp.trim();
//alert(delusertemp);
if(delusertemp =='y'){
	location.reload();
	}else{
		
		
		alert("Details Are Not Updated .PLease Try Again");
		location.reload();
		}
		}
		
		}
function edituserdtl(memdid){
	var flag="";
	flag=1;
	var url="";
	var edtemail=document.getElementById('txtemail'+memdid).value;

		var edtname=document.getElementById('txtname'+memdid).value;
			if(edtname==""){
				flag=0;
		
		  document.getElementById('errorsDiv_txtname'+memdid).innerHTML="Enter  Name";
		  document.getElementById('errorsDiv_txtname'+memdid).classList.add("innerError");
	
		}else{
			document.getElementById('errorsDiv_txtname'+memdid).innerHTML="";
			}
			var edtaddr=document.getElementById('txtaddr'+memdid).value;
					if(edtaddr==""){
						 flag=0;
		
		  document.getElementById('errorsDiv_txtaddr'+memdid).innerHTML="Enter  Address";
		    document.getElementById('errorsDiv_txtaddr'+memdid).classList.add("innerError");
	
		
		}else{
			document.getElementById('errorsDiv_txtaddr'+memdid).innerHTML="";
			}
				var edtcntry=document.getElementById('lstcntry'+memdid).value;
					var edtcnty=document.getElementById('lststate'+memdid).value;
									if(edtcnty==''){
										 flag=0;
		
		  document.getElementById('errorsDiv_lststate'+memdid).innerHTML="Enter  State";
	 document.getElementById('errorsDiv_lststate'+memdid).classList.add("innerError");
		}else{
			document.getElementById('errorsDiv_lststate'+memdid).innerHTML="";
			}
						var edtcty=document.getElementById('txtcty'+memdid).value;
													if(edtcty==''){
														flag=0;
	
		 document.getElementById('errorsDiv_txtcty'+memdid).innerHTML="Enter  City";
		  document.getElementById('errorsDiv_txtcty'+memdid).classList.add("innerError");
		}else{
			document.getElementById('errorsDiv_txtcty'+memdid).innerHTML="";
			}
						var edtpin=document.getElementById('txtpin'+memdid).value;
																		if(edtpin==''){
																			flag=0;
	
		document.getElementById('errorsDiv_txtpin'+memdid).innerHTML="Enter  Pin Code";
		 document.getElementById('errorsDiv_txtpin'+memdid).classList.add("innerError");
		}else{
			document.getElementById('errorsDiv_txtpin'+memdid).innerHTML="";
			}
						    var edtphno=document.getElementById('txtphno'+memdid).value;
																						if(edtphno==''){
																							flag=0;
	
		document.getElementById('errorsDiv_txtphno'+memdid).innerHTML="Enter  Mobile Number";
		 document.getElementById('errorsDiv_txtphno'+memdid).classList.add("innerError");
		}else{
			document.getElementById('errorsDiv_txtphno'+memdid).innerHTML="";
			}
							 var edtlssts=document.getElementById('lssts'+memdid).value;
							
							
							   var edtmembid=memdid;
							      var edtmemid= document.getElementById('hsdnmemid'+memdid).value;
						
							if(edtmembid !='' && edtmemid !='' && edtemail !="" && flag==1 ){
					
					
			 url = "<?php echo $rtpth;?>edtuser_details.php?edtemail="+edtemail+"&edtname="+edtname+"&edtaddr="+edtaddr+"&edtcntry="+edtcntry+"&edtcnty="+edtcnty+"&edtcty="+edtcty+"&edtpin="+edtpin+"&edtphno="+edtphno+"&edtmembid="+edtmembid+"&edtmemid="+edtmemid+"&edtlssts="+edtlssts;


			xmlHttp	= GetXmlHttpObject(stchng_UpdtuserDtls);



			xmlHttp.open("GET", url , true);



			xmlHttp.send(null);
	
								
								}
	
	}
	
	function stchng_UpdtuserDtls(){
		if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){ 					



		   var edtusertemp=xmlHttp.responseText;

edtusertemp=edtusertemp.trim();
//alert(edtusertemp);
if(edtusertemp =='y'){
	location.reload();
	}else{
		
		
		alert("Details Are Not Updated .PLease Try Again");
		location.reload();
		}
		}
		
		
		}
</script>
<?php include_once("includes/inc_fnct_ajax_validation.php"); ?>
 <script src="<?php echo $rtpth ;?>js/yav.js" type="text/javascript"></script>
<script src="<?php echo $rtpth ;?>js/yav-config.js" type="text/javascript"></script>

<?php include_once('footer.php'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>