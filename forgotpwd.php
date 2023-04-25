<?php
            include_once 'includes/inc_nocache.php'; // Clearing the cache information
            include_once 'includes/inc_connection.php';//Make connection with the database  	
            include_once "includes/inc_config.php";	//path config file
		    include_once "includes/inc_usr_functions.php";//Including user session value

if((isset($_POST['btnsmtfgtpwd']) && $_POST['btnsmtfgtpwd'] !='') &&
      (isset($_POST['txtemailfgpwd']) && $_POST['txtemailfgpwd'] !='' ) ){
		 
	$useremail=trim($_POST['txtemailfgpwd']);
	if(preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $useremail)){
	 $sqlmem_mst="select mbrm_name,mbrm_emailid,mbrm_id from mbr_mst where mbrm_emailid ='$useremail'";
	
	$rwsmem_mst=mysqli_query($conn,$sqlmem_mst);
	$memcnt=mysqli_num_rows($rwsmem_mst);
	if($memcnt =='1'){
		$rowsmem_mst=mysqli_fetch_assoc($rwsmem_mst);
		$memid=$rowsmem_mst['mbrm_id'];
		$usrnm=$rowsmem_mst['mbrm_name'];
		
	 	$nwpwd = substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 5);
		$updtpwd =md5($nwpwd);
		$curdt=date('Y-m-d');
						 $sqlupdtmem_mst 	= 	"update 
										mbr_mst 
									 set
										mbrm_pwd='$updtpwd',
										mbrm_mdfdon='$curdt',
										mbrm_mdfdby='$useremail'							 
									 where 					
										mbrm_emailid='$useremail' and
										mbrm_id='$memid' and 
										mbrm_sts = 'a' ";
										
				$rwsupdtmem_mst		=	mysqli_query($conn,$sqlupdtmem_mst);
				$afct_rows		= 	mysqli_affected_rows($conn);
				if($afct_rows == 1){		
					if($usrnm ==''){
						$usrnm ='Customer';
					}
		
		$hdimg    = "http://".$u_prjct_mnurl."/".$site_logo;//Return the URL
			
					$body = "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01//EN' 'http://www.w3.org/TR/html4/strict.dtd'>
								<html>
								<head>
								<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
								<meta name='viewport' content='width=device-width, initial-scale=1.0'/>
								<title>$usr_cmpny | Order Information</title>
								<style type='text/css'>
								#outlook a{padding:0}body{width:100% !important;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;margin:0;padding:0;background-color:#fdfbed;font-family:Arial,Helvetica,sans-serif;font-size:12px}p{margin-top:0;margin-bottom:10px}table td{border-collapse:collapse}table{border-collapse:collapse;mso-table-lspace:0pt;mso-table-rspace:0pt}img{outline:none;text-decoration:none;-ms-interpolation-mode:bicubic}a img{border:none}.image_fix{display:block}
								</style>
								</head>
								<body style='margin:0; background-color:#ffffff;' marginheight='0' topmargin='0' marginwidth='0' leftmargin='0'>
								<div style='background-color:#fff;'><table width='600'  border='0' align='center' cellpadding='0' cellspacing='0'>
												  <tr>
						<td colspan='2' align='center' bgcolor='#333333'>
						<a href='$pth' ><img src='$hdimg' alt='$usr_cmpny' hspace='10' vspace='15' width='200'></a>
						</td>
						
					  </tr>
					 
					</table>
					<table width='600'  border='0' align='center' cellpadding='6' cellspacing='0'>
					  <tr>
						<td><p><br>
						   Dear ". $usrnm .", <br/><br/>
						
Your temporary password is <b>$nwpwd</b> <br/><br/>

Please login with above temporary password. (We recommend to change this by Change Password option under My Account)<br/><br/>

For suggestions / support please feel free to email us at <a href='mailto:$u_prjct_email_info'>$u_prjct_email_info.</a><br/><br/>

With best wishes for your well being! <br/></p>
						
						  
						   <p>Sincerely, <br>

									Customer Service,<br>

									
						                 Ashoka Tyres
<br><br>

								  </p>
								  
						  </td>
					  </tr>
					</table>
					
					<table width='600'  border='0' align='center' cellpadding='0' cellspacing='0'>
					  <tr>
						<td height='1' bgcolor='#CCCCCC'></td>
					  </tr>
					  <tr>
						<td align='right'>&nbsp;</td>
					  </tr>
					</table>
					</div>
					</body></html>";
	
					
					$fromemail   = $u_prjct_email_info;		
					$headers 	 = 'MIME-Version: 1.0' . "\r\n";
					$headers 	.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					$headers 	.= "From: $fromemail" . "\r\n";
					$subject="Password Recovery System - Ashoka Tyres ";
					if (mail($usr_emailid,$subject,$body,$headers)){
						$msgstr="<div class='alert alert-success'>Mail Sent Successfully..</div>";
					}
					else{
						$msgstr= "<div class='alert alert-danger'>Unable To delivery The Mail</div>";
					}			
		
		
				}
		
		}else{
			$msgstr="<div class='alert alert-danger'>Account not Exist.Please Signup</div>";
			
			}
			
			}else{
			
				$msgstr="<div class='alert alert-danger'>Enter Valid Email Id</div>";	
			
				}
	
	
	}

$page_title = "Forgot Password | Home";
$page_seo_title = "Forgot Password | Home";
$db_seokywrd = "";
$db_seodesc = "";
$current_page = "home";
$body_class = "homepage";
include('header.php');
 ?>
 
<style>    
.frgt .accordion-button::after{
  background-image:unset !important;
}
</style>
<div class="page-wraper">



    <div class="page-content bg-white">

        <!-- Banner  -->
        <div class="dlab-bnr-inr short-banner style-1 overlay-black-middle" style="background-image: url(<?php echo $rtpth ?>images/banner/bnr1.jpg);">
            <div class="container">
                <div class="dlab-bnr-inr-entry">
                    <h1 class="text-white">Forgot Password</h1>
                    <div class="d-flex justify-content-center align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo $rtpth ?>">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Forgot Password</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- Banner End -->


        <div class="section login-register frgt py-5">
            <div class="container">

                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-6 col-sm-8 col-12">
                    <?php if($msgstr !=''){echo $msgstr;} ?>
                        <div class="" id="">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button lock-icon" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Forgot Password
                                    </button>
                                </h2>
                                <div id="" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="">
                                    <div class="accordion-body">
                                        <form id="frmforgotpwd" name="frmforgotpwd" class="row mb-0" onSubmit="return performCheck('frmforgotpwd',fgpwdrules,'inline');"   enctype="multipart/form-data"method="post">
                                       
                                           
                                            <div class="col-12 form-group">
                                                <label for="login-form-password">Email Id:</label>
                                                <input type="text" id="txtemailfgpwd" name="txtemailfgpwd"  class="form-control" placeholder="Enter Email Id">
                                                 <span id="errorsDiv_txtemailfgpwd"></span>
                                            </div>
                             

                                            <div class="col-12 form-group d-flex justify-content-between">
                                            <!--    <button class="btn btn-primary m-0" id="login-form-submit" name="login-form-submit" value="login">Submit</button>-->
                                               <input type="submit" value="Submit"  class="btn btn-primary m-0" id="btnsmtfgtpwd" name="btnsmtfgtpwd" />
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
<?php include_once("includes/inc_fnct_ajax_validation.php"); ?>
<script src="<?php echo $rtpth ;?>js/yav.js" type="text/javascript"></script>
<script src="<?php echo $rtpth ;?>js/yav-config.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript">
          var fgpwdrules=new Array();
             fgpwdrules[0]='txtemailfgpwd:Email|required|Enter Email Id';
			 fgpwdrules[1]='txtemailfgpwd:Email|email|Enter Valid Email Id';
          
          </script>





    </div>
</div>

<?php include_once('footer.php'); ?>