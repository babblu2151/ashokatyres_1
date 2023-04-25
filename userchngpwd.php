<?php
           
			include_once "includes/inc_membr_session.php";//checking for session	
			include_once 'includes/inc_nocache.php'; // Clearing the cache information
            include_once 'includes/inc_connection.php';//Make connection with the database  	
            include_once "includes/inc_config.php";	//path config file
		    include_once "includes/inc_usr_functions.php";//Including user session value
	global $gmsg,$email;		
	

	 $membrid   = $_SESSION['sesmbrid'];	

	if((isset($_POST['txtpwdold']) && $_POST['txtpwdold'] !='')&&
	(isset($_POST['txtpwd']) && $_POST['txtpwd'] !='')&&
	(isset($_POST['txtcpwd']) && $_POST['txtcpwd'] !='') &&
	trim($_POST['txtpwd'])==trim($_POST['txtcpwd'])
	
	 ){
		
		$oldpwd=md5(trim($_POST['txtpwdold']));
		$pwd=md5(trim($_POST['txtpwd']));
		$cpwd=$_POST['txtcpwd'];
		
		$sqlmemb_mst=" select mbrm_id,mbrm_pwd,mbrm_emailid from mbr_mst where mbrm_id='$membrid' and mbrm_pwd='$oldpwd'";
		$rwsmemb_mst=mysqli_query($conn,$sqlmemb_mst);
			$cntrws=mysqli_num_rows($rwsmemb_mst);
	if($cntrws >0){
		
		$updtmemb_mst="update mbr_mst set mbrm_pwd='$pwd' where  mbrm_id='$membrid' and mbrm_pwd='$oldpwd'  ";
		$rwsupdtmemb_mst=mysqli_query($conn,$updtmemb_mst);
		if($rwsupdtmemb_mst==true){
			$msg="Password Updated Successfully";
			}else{
				$msg="Password NoT Updated ";
				}
		}else{
			
			$msg="Enter Correct Old Password";
			}
		}

$page_title = "Change Password";
$page_seo_title = "Change Password";
$db_seokywrd = "";
$db_seodesc = "";
$current_page = "change-pwd";
$body_class = "change-pwd";
include('header.php');
?>
<style>
.innerError {
	color: red;
}

</style>


<div class="page-content bg-white"> 
  <!-- Banner  -->
  <div class="dlab-bnr-inr short-banner style-1 overlay-black-middle"
        style="background-image: url(<?php echo $rtpth;?>images/banner/bnr1.jpg);">
    <div class="container">
      <div class="dlab-bnr-inr-entry">
        <h1 class="text-white">Change Password</h1>
        <div class="d-flex justify-content-center align-items-center">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo $rtpth;?>">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Change Password</li>
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
       <?php 
	   $activepage="4";
	   
	    include('acc_leftlinks.php'); ?>
        </div>
        <div class="col-md-9"> 
          <!-- Tabs content -->
        
          

             <!-------------------------------tab End------------------------------------------>

             <!----------------------------------- change password Start-------------------------------------->
          
              <div class="section login-register">
                <div class="row justify-content-center">
                  <div class="col-lg-8 col-md-8 col-sm-8 col-12">
                    <div class="" id="">
                      <div class="">
                        <div class="accordion-body car-body">
                        <p class="text-danger font-weight-bold ">
     <?php if($msg !=''){echo $msg;} ?></p>
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
                              <button type="submit" class="btn btn-primary " id="btnchngpwd"  name="btnchngpwd" value="Update">Update</button>
                              <button class="btn btn-primary" onclick="funrest();" >Reset</button>
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
          
          </div>
       
      
    </div>
  </section>
  
<script>
function funrest(){

	 document.getElementById("frmchngpwd").reset();
		
	}
</script>
  
          
<?php include_once("includes/inc_fnct_ajax_validation.php"); ?>
 <script src="<?php echo $rtpth ;?>js/yav.js" type="text/javascript"></script>
<script src="<?php echo $rtpth ;?>js/yav-config.js" type="text/javascript"></script>
         <script language="javascript" type="text/javascript"> 
          var chngpwd=new Array();
             chngpwd[0]='txtpwdold:OldPassword|required|Enter Old Password ';
             chngpwd[1]='txtpwd:Password|required|Enter New Password ';
			 chngpwd[2]='txtcpwd:Password|required|Enter Confirm Password ';
			 chngpwd[3]='txtsgnpwd:Password|required|Enter Password ';
          </script>
<?php include_once('footer.php'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>