<?php	
	  session_start();
	  include_once "includes/inc_usr_functions.php";//Including user session value		
  
	  if(isset($_POST['txtemail']) && (trim($_POST['txtemail']) != "") && 	
  
		 isset($_POST['txtpwd']) && (trim($_POST['txtpwd']) != "") &&
  
		 isset($_POST['txtcpwd']) && (trim($_POST['txtcpwd']) != "") && 
  
		 (trim($_POST['txtpwd']) == trim($_POST['txtcpwd']))){
  
		  $email     	= glb_func_chkvl($_POST['txtemail']);
		   $name       = glb_func_chkvl($_POST['txtname']);
			$username   = glb_func_chkvl($_POST['txtusernm']);
			 $phno       = glb_func_chkvl($_POST['txtphono']);
			  $password  =      glb_func_chkvl($_POST['txtpwd']);
			  
  
		  if(preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email)){	
  
			  $ipadrs		  = $_SERVER['REMOTE_ADDR'];
			  $pwd      	  = md5($_POST['txtpwd']);
			  $dt        	  = date('Y-m-d h:i:s');
			  $sts       	  = 'a';
			  $sqrymbr_mst = "select 
  
								  mbrm_emailid
  
							   from  mbr_mst
  
							   where  
  
								  mbrm_emailid = '$email'";
  
			  $srsmbr_mst = mysqli_query($conn,$sqrymbr_mst);
			  $cntmbr_mst = mysqli_num_rows($srsmbr_mst);
			  if($cntmbr_mst > 0){
				  $greg_msg = "Duplicate email id, account not created";
			  }
			  else{
				  $iqrymbr_mst="insert into mbr_mst(
  
								mbrm_emailid,mbrm_usernm,mbrm_name,mbrm_phno,mbrm_pwd,mbrm_ipadrs,
  
								mbrm_sts,mbrm_crtdon,mbrm_crtdby)values(
  
								'$email','$username','$name','$phno','$pwd','$ipadrs',
  
								'$sts','$dt','$email')";					 
				  $irsmbr_mst = mysqli_query($conn,$iqrymbr_mst);				
				  if($irsmbr_mst==true){				
					   $hdimg    = "http://".$u_prjct_mnurl."/".$site_logo; //Return the URL 
					  $subject = "Account Information - $usr_cmpny"; 
					  $body ="<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01//EN' 'http://www.w3.org/TR/html4/strict.dtd'>
								  <html>
								  <head><meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
								  <meta name='viewport' content='width=device-width, initial-scale=1.0'/>
								  <title>$usr_cmpny | Order Information</title>
								  <style type='text/css'>
								  #outlook a{padding:0}body{width:100% !important;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;margin:0;padding:0;background-color:#fdfbed;font-family:Arial,Helvetica,sans-serif;font-size:12px}p{margin-top:0;margin-bottom:10px}table td{border-collapse:collapse}table{border-collapse:collapse;mso-table-lspace:0pt;mso-table-rspace:0pt}img{outline:none;text-decoration:none;-ms-interpolation-mode:bicubic}a img{border:none}.image_fix{display:block} a{color:#109547; text-decoration:none;} a:hover{color:#ea7724; text-decoration:none;}
								  </style>
								  </head>
								  <body style='margin:0; background-color:#ffffff;' marginheight='0' topmargin='0' marginwidth='0' leftmargin='0'>
								  <div style='background-color:#fff;'>
								  <table width='600'  border='0' align='center' cellpadding='5' cellspacing='1' bordercolor='#4A2E2D' style='font-family:Verdana, Arial, Helvetica, sans-serif;font-size:12px; color:#333333'>
					<tr>
					  <td align='center' bgcolor='#333333'>
						  <img src='$hdimg' alt='$usr_cmpny' hspace='10' vspace='15' width='200'></td>
					</tr>	
				  </table>
  
				  <table width='600'  border='0' align='center' cellpadding='6' cellspacing='0'>
  
						<tr>
  
						  <td><p><br>
  
							Dear Customer, 
  
							<p>Thank you for registering with us and choosing products from <em>$usr_cmpny</em>.</p>
  
							<p>Your User Name <em>$email </em>.</p>
  
							<p>Your Password <em>$password</em>.</p>
							<p>We would like to welcome you as a new member of <a href='http://$u_prjct_mnurl' target='_blank'>$u_prjct_url</a>
							<p>For suggestions / support please feel free to email us at <a href='mailto:$u_prjct_url1s' class='style:color-000'>$u_prjct_url1s.</a></p>

							<p>Sincerely, <br>
									  Customer Service,<br><br>
									  Support &amp; Answer Center,<br>
 
							<a href='http://".$u_prjct_mnurl."'>Ashoka Tyres &amp; Jewellers<br>
									</p>
							</td>
  
						</tr>
  
					  </table>
  
				  </div>
  
					  </body></html>";
	
		  $to  = $fromemail;
		  $fromemail = $u_prjct_email;			
		  $headers 	 = 'MIME-Version: 1.0' . "\r\n";
		  $headers 	.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		  $headers 	.= "From: $fromemail" . "\r\n";
		
		  mail($to,$subject,$body,$headers);
					  $id = mysqli_insert_id($conn);				
					  $_SESSION['sesmbremail']   = $email;//assing value of user id to admin session
					  $_SESSION['sesmbrid']      = $id;//assing value of user id to admin session										
					  if(isset($_SESSION['cartcode']) && (trim($_SESSION['cartcode']) != "")){
						  ?>
                       <script type="text/javascript">
							  location.href = "<?php echo $rtpth;?>add-address";
						 </script>
               <?php 
					  } elseif(isset($_SESSION['pgname']) && ($_SESSION['pgname'] == "y") ){
						  $_SESSION['sesmbrmenu'] = "wshlst";
						  ?>
                       <script type="text/javascript">
							  location.href = "<?php echo $rtpth;?>wishlist";
							  </script>
                <?php
								  exit();	
                        }else{
  
					  ?>
                 <script language="javascript" type="text/javascript">
  
						  alert("Congratulations \n Your account has been created successfully");
  
						  location.href = "<?php echo $rtpth.'add-address'?>";
  
						  </script>
<?php				 }
  
					  exit();								
  
				
				  } else{
  
					  $greg_msg = "Your account hasn't been created";
				  }
			  }
		  }
  
		  else{
			  $greg_msg =  "Invalid email id. Record not saved";
		  }
	  }
  
  ?>