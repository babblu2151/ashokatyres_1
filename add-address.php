<?php

session_start();
	
			include_once 'includes/inc_nocache.php'; // Clearing the cache information
            include_once 'includes/inc_connection.php';//Make connection with the database  	
            include_once "includes/inc_config.php";	//path config file
		    include_once "includes/inc_usr_functions.php";//Including user session value
	global $gmsg,$email;
	
	if(isset($_POST['hnsname']) && (trim($_POST['hnsname']) != "") && 
	   isset($_POST['hnsemail']) && (trim($_POST['hnsemail']) != "") && 
	   isset($_POST['txtaddr']) && (trim($_POST['txtaddr']) != "")&&
	   isset($_POST['txtpin']) && (trim($_POST['txtpin']) != "") && 
	   isset($_POST['txtphno']) && (trim($_POST['txtphno']) != "")&&
	   isset($_POST['lststate']) && (trim($_POST['lststate']) != "")&&
	   isset($_POST['txtcty']) && (trim($_POST['txtcty']) != "")
	   ){
 
	  // var_dump($_POST);exit;
		include_once "database/iqry_mbr_dtl.php";			
	}
	$membrid   = $_SESSION['sesmbrid'];
	$seopage_title = "Add  Address";
	$page_title = "Add  Address";
	$current_page = "addmember";
	
 
  $sqlmbr_mst= "select mbrm_id,mbrm_name,mbrm_phno,mbrm_emailid
                     from 
					        mbr_mst
				where 	
				mbrm_id = 	$membrid	
							";  
 
   $resmbr_mst= mysqli_query($conn,$sqlmbr_mst);
   $cntadr = mysqli_num_rows($resmbr_mst);
   $rowmemb_mst=mysqli_fetch_assoc($resmbr_mst);
  $membname= $rowmemb_mst['mbrm_name'];
    $memid= $rowmemb_mst['mbrm_id'];
  $membphno= $rowmemb_mst['mbrm_phno'];
  $membemail= $rowmemb_mst['mbrm_emailid'];

?>

   
    
    <?php 
	if($gmsg != ''){
		echo"<div class='alert alert-success'>$gmsg</div>";
	}
?>
    <?php include_once ("includes/inc_fnct_ajax_validation.php");
$page_title = "Ashoka Tyres | Add Address";
$page_seo_title = "Ashoka Tyres | Add Address";
$db_seokywrd = "";
$db_seodesc = "";
$current_page = "enquiry";
$body_class = "enquirypage";
include('header.php');
?>

<div class="page-content bg-white">
    <!-- Banner  -->
    <div class="dlab-bnr-inr style-1 overlay-black-middle" style="background-image: url(<?php echo $rtpth ?>images/banner/bnr1.jpg);">
        <div class="container">
            <div class="dlab-bnr-inr-entry">
                <h1 class="text-white">Add Address</h1>
                <div class="d-flex justify-content-center align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add Address</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->

<?php include_once("includes/inc_fnct_ajax_validation.php"); ?>
<script src="<?php echo $rtpth ;?>js/yav.js" type="text/javascript"></script>
<script src="<?php echo $rtpth ;?>js/yav-config.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript"> 
			  var addrrules=new Array();
			
			 addrrules[0]='txtaddr: Address|required|Enter Address ';
			  addrrules[1]='lststate: State|required|Enter State ';
			  
			 addrrules[2]='txtcty: City|required|Enter City ';
			  addrrules[3]='txtpin: Pin Code|required|Enter Pin Code ';
			 
			
		</script>
        <style>
.innerError {
	color: red;
}
</style>
    <section class="content-inner bg-gray bottom-shape conact-section">
        <div class="container">
            <div class="row justify-content-center">
   
                <div class="col-xl-12 m-b40">
                    <div class="contact-area1 add-address">
                        <form name="frmaddbilngdtl" id="frmaddbilngdtl" action="<?php $_SERVER['PHP_SELF'];?>" method="post" onSubmit="return performCheck('frmaddbilngdtl', addrrules, 'inline');" >
                     
                    <input type="hidden" class="form-control" name="hnsname"  value="<?php echo $membname ;?>">
                   
                    <input type="hidden" class="form-control" name="hnsemail"  value="<?php echo $membemail;?>">
                    <input type="hidden" class="form-control" name="hnsmembid"  value="<?php echo $memid;?>">
                            <div class="dlabFormMsg"></div>

                            <div class="row sp10">


                                <div class="col-sm-4">
                                    <div class="form-group">
        <label>Name</label> <input type="text" class="form-control" placeholder="Name" name="txtname" id="txtname" value="<?php echo $membname ;?>" disabled>
                                  
                                    </div>
                                </div>




                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Phone</label>
           <input type="text" class="form-control" placeholder="Mobile Number" name="txtphno"  id="txtphno" value="<?php echo $membphno;?>" >
       
                                    </div>
                                </div>



                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Email</label>
                                  <input type="text" class="form-control" placeholder="Email" name="txtemail" id="txtemail" value="<?php echo $membemail;?>" disabled>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Address</label>
                              
                                            <textarea name="txtaddr"  id="txtaddr" rows="2" placeholder="Address" class="form-control"></textarea>
                                            <span id="errorsDiv_txtaddr"></span>
                                    </div>
                                </div>
<div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Country</label>
                                       <select name="lstcntry" id="lstcntry"
                                                                        class="form-control" onchange="funcPopCnty()">
                                                                       
                                                                        <option value="2" selected="">
                                                                            India</option>
                                                                       
                                                                    </select>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>State</label>
                       <select name="lststate" id="lststate"
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
           ?>                                                          <option value="<?php echo $cntymid ?>" <?php if($cntymid=='28' ){ echo 'selected';}else{echo '';}?>><?php echo $cntymnm ?></option>
                                                                       <?php } ?>
                                                                    </select>  
                                                                      <span id="errorsDiv_lststate"></span>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>City</label>
                               <input type="text" class="form-control" placeholder="City" name="txtcty" id="txtcty" >
                                      <span id="errorsDiv_txtcty"></span>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Pin code</label>
                          <input type="text" class="form-control" placeholder="Pin code" name="txtpin" id="txtpin">
                                   <span id="errorsDiv_txtpin"></span>
                                    </div>
                                </div>

                       




                         <!--       <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="g-recaptcha" data-sitekey="6LefsVUUAAAAADBPsLZzsNnETChealv6PYGzv3ZN"
                                            data-callback="verifyRecaptchaCallback"
                                            data-expired-callback="expiredRecaptchaCallback">
                                            <div style="width: 304px; height: 78px;">
                                                <div><iframe title="reCAPTCHA"
                                                        src="https://www.google.com/recaptcha/api2/anchor?ar=1&amp;k=6LefsVUUAAAAADBPsLZzsNnETChealv6PYGzv3ZN&amp;co=aHR0cHM6Ly9tb2JoaWwuZGV4aWdubGFiLmNvbTo0NDM.&amp;hl=en&amp;v=rPvs0Nyx3sANE-ZHUN-0nM85&amp;size=normal&amp;cb=uufyj2kfui6"
                                                        role="presentation" name="a-z69twgyrg81r" scrolling="no"
                                                        sandbox="allow-forms allow-popups allow-same-origin allow-scripts allow-top-navigation allow-modals allow-popups-to-escape-sandbox allow-storage-access-by-user-activation"
                                                        width="304" height="78" frameborder="0"></iframe></div><textarea
                                                    id="g-recaptcha-response" name="g-recaptcha-response"
                                                    class="g-recaptcha-response"
                                                    style="width: 250px; height: 40px; border: 1px solid rgb(193, 193, 193); margin: 10px 25px; padding: 0px; resize: none; display: none;"></textarea>
                                            </div><iframe style="display: none;"></iframe>
                                        </div>
                                        <input class="form-control d-none" style="display:none;" data-recaptcha="true"
                                            required="" data-error="Please complete the Captcha">
                                    </div>
                                </div>

-->
                                <div class="col-sm-12">
                                    <input name="btnsubmtadd" type="submit" id="btnsubmtadd" value="Submit"
                                        class="btn btn-primary  btn-rounded"/> 
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>





</div>













<?php include_once('footer.php'); ?>