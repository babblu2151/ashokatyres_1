<?php
        session_start();
            include_once 'includes/inc_nocache.php'; // Clearing the cache information
            include_once 'includes/inc_connection.php';//Make connection with the database  	
            include_once "includes/inc_config.php";	//path config file
		    include_once "includes/inc_usr_functions.php";//Including user session value	
             
              if(isset($_POST['btnsbmtreg']) && (trim($_POST['btnsbmtreg']) != "") &&
                 isset($_POST['txtemail']) && (trim($_POST['txtemail']) != "") && 
                 isset($_POST['txtpwd']) && (trim($_POST['txtpwd']) != "") &&
                 isset($_POST['txtcpwd']) && (trim($_POST['txtcpwd']) != "") && 
                 (trim($_POST['txtpwd']) == trim($_POST['txtcpwd']))){	 
              $ip = $_SERVER['REMOTE_ADDR'];//ip address
              $fromemail		= glb_func_chkvl($_POST['txtemail']);
                      if(preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $fromemail)){	
                           
						   include_once "database/iqry_mbr_mst.php";
                     
					   }
                   }	
              
				  if(isset($_SESSION['sesmbremail']) && ($_SESSION['sesmbremail'] != "") ||
				  isset($_SESSION['sesmbrid']) && ($_SESSION['sesmbrid'] != "")){
			  
					   echo "<script>";
				echo "location.href='billing-shipping-details'";
				echo "</script>";
				 exit();
			  
				  }elseif(isset($_POST['txtsgnemail']) && isset($_POST['txtsgnpwd']) && 
			   (trim($_POST['txtsgnemail']) != "") && (trim($_POST['txtsgnpwd']) != "")){
			  $uid		 = glb_func_chkvl($_POST['txtsgnemail']);
			  $pwd		 = md5(trim($_POST['txtsgnpwd']));
			  $sqrymbr_mst = "select 
			  mbrm_id,mbrm_emailid,
			  mbrd_lstname,mbrd_badrs,mbrd_bmbrcntrym_id,
			  mbrd_bmbrcntym_id,mbrd_bzip,
			  mbrd_bdayphone,mbrd_dfltshp,mbrinfm_id,mbrinfm_email					
			  from 
			  vw_mbr_mst_bil 
			  left join mbrinf_mst on mbrm_id = mbrinfm_mbrm_id
			  where 
			   (  mbrm_name=binary('".mysqli_real_escape_string($conn,$uid)."') or
			   mbrm_usernm=binary('".mysqli_real_escape_string($conn,$uid)."') or
			  mbrm_emailid=binary('".mysqli_real_escape_string($conn,$uid)."'))
			  and mbrm_pwd=binary('".mysqli_real_escape_string($conn,$pwd)."')";
		 $sqrymbr_mst;
			  $srsmbr_mst	 =	mysqli_query($conn,$sqrymbr_mst); 
			  $cntrec  	 =	mysqli_num_rows($srsmbr_mst);
			  if($cntrec==0){
		  //if record is equal to zero
			  $gmsg = "<div class='alert alert-danger'>Either the email address or password entered is incorrect. 
			   <br>Enter the information again</div>";
			  }elseif($cntrec >= 1){	
			  while($srowmbr_mst = mysqli_fetch_assoc($srsmbr_mst)){
			  $_SESSION['sesmbremail']   = $srowmbr_mst['mbrm_emailid'];//assing value of user id to admin session
			  $_SESSION['sesmbrid']      = $srowmbr_mst['mbrm_id'];//assing value of user id to admin session	
			  $_SESSION['sesmbrphn']     = $srowmbr_mst['mbrd_bdayphone'];//assing value of user id to admin session
			  $_SESSION['sesmbrdname']   = $srowmbr_mst['mbrd_fstname']." ".$srowmbr_mst['mbrd_lstname'];
			  $mbrinfm_email  		   = $srowmbr_mst['mbrinfm_email'];
			  
				  if($srowmbr_mst['mbrd_dfltshp'] == "y"){
			  
								  $_SESSION['sesmbrdcity']   = $srowmbr_mst['mbrd_bcty_id'];				    
			  
								  $frstnm  = $srowmbr_mst['mbrd_fstname'];
								  $lstnm   = $srowmbr_mst['mbrd_lstname'];
									  $adrs    = $srowmbr_mst['mbrd_badrs'];
			  $cntry   = $srowmbr_mst['mbrd_bmbrcntrym_id'];
			  $cty     = $srowmbr_mst['mbrd_bcty_id'];
			  $cnty    = $srowmbr_mst['mbrd_bmbrcntym_id'];
			  $zip     = $srowmbr_mst['mbrd_bzip'];	
			  $mbrinfm_id    = $srowmbr_mst['mbrinfm_id'];				
			  }
			  }
      
          if(isset($_SESSION['prodid']) && (trim($_SESSION['prodid'] != ""))){
          if((trim($frstnm) != "")  && (trim($adrs) != "") &&
            (trim($cty) != "") && (trim($zip) != "")){					
          ?>
<script type="text/javascript">
              location.href = "<?php echo $rtpth;?>my-cart.php";
              </script>
<?php
          exit();
          
                          }else{ ?>
<script type="text/javascript">
          location.href = "<?php echo $rtpth;?>my-cart.php";
          </script>
<?php
              exit();						
          }
                      }else{
      
                      ?>
<script type="text/javascript">
              location.href = "<?php echo $rtpth;?>billing-shipping-details";
          </script>
<?php
          exit();		
  
                      }	
          }
          } 
            //////////////////login  ///////////////////
            $page_title = "Login Or Signup  ";
            $page_seo_title = "Login Or Signup ";
            $db_seokywrd = "";
            $db_seodesc = "";
            $current_page = "Login Or Signup ";
            $body_class = "homepage";
           include('header.php');
        ?>
<style>
.innerError {
	color: red;
}
</style>
<?php include_once("includes/inc_fnct_ajax_validation.php"); ?>
<script src="<?php echo $rtpth ;?>js/yav.js" type="text/javascript"></script>
<script src="<?php echo $rtpth ;?>js/yav-config.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript">
          var snrules=new Array();
             snrules[0]='txtsgnemail:User|required|Enter User Name';
             snrules[1]='txtsgnpwd:Password|required|Enter Password ';
          </script>
<script language="javascript" type="text/javascript"> 
			  var regrules=new Array();
			 regrules[0]='txtname:Name|required|Enter Name';
			 regrules[1]='txtusernm:User Name|required|Enter User Name';
			 regrules[2]='txtemail: Email|required|Enter Email';
			 regrules[3]='txtphono: Phone|required|Enter  Phone Number';
			 regrules[4]='txtphono: Phone|numeric|Enter Only Numbers';
			 regrules[5]='txtphono: Phone|maxlength|10|Enter Only 10 Digits Number ';
			 regrules[6]='txtpwd: Password|required|Enter Password ';
			 regrules[7]='txtcpwd: Confirm Password|required|Enter Confirm Password ';
			 
			 //regrules[8]='txtcpwd: Confirm Password|equal||Enter Password Not Matched ';
		</script>
<div class="page-wraper">
  <div class="page-content bg-white"> 
    
    <!-- Banner  -->
    <div class="dlab-bnr-inr short-banner style-1 overlay-black-middle" style="background-image: url(images/banner/bnr1.jpg);">
      <div class="container">
        <div class="dlab-bnr-inr-entry">
          <h1 class="text-white">Login Or Signup</h1>
          <div class="d-flex justify-content-center align-items-center">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Login Or Signup</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>
    <!-- Banner End -->
    
    <div class="section login-register py-5">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-6 col-md-6 col-sm-8 col-12">
            <div class="accordion" id="accordionExample">
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                  <button class="accordion-button lock-icon" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> Login to your Account </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    <form name="frmsgnin" id="frmsgnin" method="post"  onSubmit="return performCheck('frmsgnin',snrules,'inline');"   enctype="multipart/form-data" >
                      <div class="col-12 form-group">
                        <label for="txtsgnemail">Username:</label>
                        <input type="text"  name="txtsgnemail" id="txtsgnemail" class="form-control">
                        <span id="errorsDiv_txtsgnemail"></span> </div>
                      <div class="col-12 form-group">
                        <label for="txtsgnpwd">Password:</label>
                        <input type="text" id="txtsgnpwd" name="txtsgnpwd"  class="form-control">
                        <span id="errorsDiv_txtsgnpwd"></span> </div>
                      <div class="col-12 form-group d-flex justify-content-between"> 
                        <!--          <button type="submit" class="btn btn-primary m-0" id="btnsbmt" name="btnsbmt" value="login">Login</button>-->
                        <input type="submit" name="btnsbmt" id="btnsbmt" class="btn btn-primary m-0 btn-text-secondary" value="Log in" style="color:black;">
                        <a href="<?php echo $rtpth;?>forgot-pwd" class="float-right">Forgot Password?</a> </div>
                    </form>
                  </div>
               </div>
              </div>
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                  <button class="accordion-button user-icon collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"> New Signup? Register for an Account </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    <form name="frmrgst" id="frmrgst" enctype="multipart/form-data" method="post" 
		  onSubmit="return performCheck('frmrgst', regrules,'inline');" accept-charset="utf-8" >
                      <div class="col-12 form-group">
                        <label for="txtname">Name:</label>
                        <input type="text" id="txtname" name="txtname"  class="form-control">
                        <span id="errorsDiv_txtname"></span> </div>
                      <div class="col-12 form-group">
                        <label for="txtemail">Email Address:</label>
                        <input type="text" id="txtemail" name="txtemail"  class="form-control">
                        <span id="errorsDiv_txtemail"></span> </div>
                      <div class="col-12 form-group">
                        <label for="txtusernm">Choose a Username:</label>
                        <input type="text" id="txtusernm" name="txtusernm"  class="form-control">
                        <span id="errorsDiv_txtusernm"></span> </div>
                      <div class="col-12 form-group">
                        <label for="txtphono">Phone:</label>
                        <input type="text" id="txtphono" name="txtphono"  class="form-control">
                        <span id="errorsDiv_txtphono"></span> </div>
                      <div class="col-12 form-group">
                        <label for="txtpwd">Choose Password:</label>
                        <input type="password" id="txtpwd" name="txtpwd"  class="form-control">
                        <span id="errorsDiv_txtpwd"></span> </div>
                      <div class="col-12 form-group">
                        <label for="txtcpwd">Re-enter Password:</label>
                        <input type="password" id="txtcpwd" name="txtcpwd"  class="form-control">
                        <span id="errorsDiv_txtcpwd"></span> </div>
                      <div class="col-12 form-group">
                        <input  type="submit" class="btn btn-primary m-0" name="btnsbmtreg" id="btnsbmtreg" value="Sign up" style="color:black;"/>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include_once('footer.php'); ?>
