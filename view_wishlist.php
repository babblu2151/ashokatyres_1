<?php
//session_start();
	include_once "includes/inc_nocache.php"; // Clearing the cache information
	include_once "includes/inc_config.php";
	include_once "includes/inc_membr_session.php";//checking for session
	include_once "includes/inc_connection.php";	
	include_once "includes/inc_usr_functions.php";//Use function for validation and more
	include_once "includes/inc_folder_path.php";
	global $msg;  
	$membrid   	    = $_SESSION['sesmbrid'];			
	if(isset($_SESSION['wishprodid']) && (trim($_SESSION['wishprodid'] != ""))){
		$wish_prodid   = $_SESSION['wishprodid'];	 // Stores the session productid
	}
	if(isset($_SESSION['wishprodqty']) && (trim($_SESSION['wishprodqty'] != ""))){
		$wish_prodqty  = $_SESSION['wishprodqty'];    // Stores the session quantities
	}
	if(isset($_SESSION['wishprodclr']) && (trim($_SESSION['wishprodclr'] != "")))
	{
		$wish_prodclr  = $_SESSION['wishprodclr'];    // Stores the session product colour
	}	
	if(isset($_SESSION['wishprodprcid']) && (trim($_SESSION['wishprodprcid'] != "")))
	{
		$wish_prodprcid   = $_SESSION['wishprodprcid'];     // Stores the session product size
	}
	if(isset($_SESSION['wishaction']) && (trim($_SESSION['wishaction'] != "")))
	{
		$wish_action   = $_SESSION['wishaction'];	 // Stores the session productid
	}
	if(isset($_SESSION['wishprdsz']) && (trim($_SESSION['wishprdsz'] != "")))
	{
		$wishprdsz   = $_SESSION['wishprdsz'];	 // Stores the session productid
	}
	if(isset($_SESSION['prodprcdid']) && (trim($_SESSION['prodprcdid'] != "")))
	{
		$prodprcdid   = $_SESSION['prodprcdid'];	 // Stores the session productid
	}
	$sessid         = session_id();
	$dt             = date('Y-m-d h:i:s');
	/*******************************************************************************/
 
		//echo $wish_action;//exit;
			  $sesdlrprc = $_SESSION['dlrprc'];

	   
		  if(isset($_POST['btnsbt']) && (trim($_POST['btnsbt'] != "")&&
		  isset($_POST['txteml']) && ($_POST['txteml'] != "")&&
		 isset($_POST['txtnm']) && ($_POST['txtnm'] != "")))
	   {
		 //echo "Heloo";exit;
		include_once "database/iqry_rfrns.php";
	   }
	
	
	
	
	
	
	if($wish_action == "add"){
			 $sqryusrwshlst_dtl="select 
		 						* 
		 					  from 
		 						usrwshlst_dtl 
							  where
								usrwshlstd_prodm_id='$wish_prodid' and
								usrwshlstd_prodprcd_id = '$prodprcdid' 
								 and
								usrwshlstd_mbrm_id='$membrid'";
								
		
	//echo $sqryusrwshlst_dtl;exit;
		$srsusrwshlst_dtl=mysqli_query($conn,$sqryusrwshlst_dtl);
		$norusrwshlst_dtl=mysqli_num_rows($srsusrwshlst_dtl);
		
		//echo $norusrwshlst_dtl;exit;
		if($norusrwshlst_dtl == 0){ 
			$iqryusrwshlst_dtl="insert into usrwshlst_dtl(
								usrwshlstd_sesid,usrwshlstd_prodm_id,
								usrwshlstd_untm_id,usrwshlstd_qty,
								usrwshlstd_cartsts,usrwshlstd_sendsts,
								usrwshlstd_mbrm_id,usrwshlstd_sts,
								usrwshlstd_clrm_id,usrwshlstd_crtdon,
								usrwshlstd_crtdby,usrwshlstd_szm_id,usrwshlstd_prodprcd_id) 
								values('$sessid','$wish_prodid',
								'$wish_prodprcid','$wish_prodqty','n','','$membrid','a',
								'$wish_prodclr','$dt','$membrid','$wishprdsz','$prodprcdid')";
			//echo $iqryusrwshlst_dtl;exit;
		
			$irsusrwshlst_dtl	=mysqli_query($conn,$iqryusrwshlst_dtl);
			$_SESSION['wishprodid']   = "";
			$_SESSION['wishprodqty']  = "";
			$_SESSION['wishprodclr']  = "";
			$_SESSION['wishprodsz']   = "";
			$_SESSION['wishaction']   = "";
			$_SESSION['pgname']       = "";	
			$_SESSION['wishprdsz']    = "";	
			$_SESSION['prodprcdid']   = "";	
		}else{
			
			
			
			
			}		
	}	
	if(isset($_REQUEST['wishid']) && (trim($_REQUEST['wishid']) != "")){
		$did1 	= glb_func_chkvl($_REQUEST['wishid']);
		$delsts1 = funcDelRec('usrwshlst_dtl','usrwshlstd_id',$did1,$conn);
		if($delsts1 == 'y'){
		    $msg = " <button aria-label='Close' data-dismiss='alert' class='close' type='button'><span aria-hidden='true'>×</span></button><strong>Product deleted successfully</strong>";
		}
		elseif($delsts == 'n')
		{
			$msg = "
      <button aria-label='Close' data-dismiss='alert' class='close' type='button'><span aria-hidden='true'>×</span></button><strong>Product can't be deleted(child records exist)</strong>";
		}
	}	
/*$sqryvw_usrwshlst_dtl="select 
					   usrwshlstd_id,usrwshlstd_prodm_id,usrwshlstd_untm_id,usrwshlstd_qty,
					usrwshlstd_clrm_id,prodm_name,prodm_crtdon,
					DATE_FORMAT(usrwshlstd_crtdon,'%d-%c-%Y') as usrwshlstd_crtdon,
					prodm_code,untm_name,concat(szd_name,' ',szm_name) as szd_name,
					(prodprcd_prc * untm_qty) as prodprcd_prc,(prodprcd_ofrprc * untm_qty) as prodprcd_ofrprc,(prodprcd_shpprc * untm_qty) as prodprcd_shpprc  
				from usrwshlst_dtl	
					inner join vw_prod_unt_dtl on (prodm_id=usrwshlstd_prodm_id and usrwshlstd_untm_id =untm_id)
				where									
					usrwshlstd_mbrm_id='$membrid' 
					group by usrwshlstd_id";
*/			
$sqryvw_usrwshlst_dtl=
					"select 
					   prodprcd_qnty,usrwshlstd_id,usrwshlstd_prodm_id,usrwshlstd_untm_id,usrwshlstd_qty,
					usrwshlstd_clrm_id,prodm_name,prodm_crtdon,
					DATE_FORMAT(usrwshlstd_crtdon,'%d-%c-%Y') as usrwshlstd_crtdon,
					prodm_code,prodprcd_prc,prodprcd_ofrprc,
					usrwshlstd_szm_id,usrwshlstd_prodprcd_id,prodprcd_sz_id,
					prodprcd_mkngprc,gldprcm_nm,gldprcm_prc,wstgm_id,wstgm_per,gldprcm_sts
				     from
				   usrwshlst_dtl	
					inner join prodprc_dtl on prodprcd_id = usrwshlst_dtl.usrwshlstd_prodprcd_id 
					inner join prod_mst on prod_mst.prodm_id = usrwshlst_dtl.usrwshlstd_prodm_id
				 LEFT join gldprc_mst  on gldprc_mst.gldprcm_nm = prodprc_dtl.prodprcd_gldprcm_id
				 left join wstg_mst  on wstg_mst.wstgm_id = prodprc_dtl.prodprcd_wstgm_id


				where 
				
				gldprcm_sts = 'a' and
				 
					usrwshlstd_mbrm_id='$membrid'  
					group by usrwshlstd_id";
					
				//	echo $sqryvw_usrwshlst_dtl;
					//exit;
	$srsvw_usrwshlst_dtl=mysqli_query($conn,$sqryvw_usrwshlst_dtl);
	$cntrecwshlst_dtl=mysqli_num_rows($srsvw_usrwshlst_dtl);
    $seopage_title="My Wishlist";
	$page_title="My Wishlist";
	$meta_key="";
	$meta_desc="";
	include_once('header.php');
?>
<script language="javascript">
function funcUpdtCart(prdid,action,prdqty,szid){

	var sz = szid;
	var qtyval = document.getElementById("lstqty").value;
		
		var prodidval,cartaction,prodqtyval;
		prodidval   = prdid;
		cartaction  = action;
		prodqtyval  = prdqty;
	
		if((prodidval != "")  && (cartaction != "") && (prodqtyval != ""))
		{
			var url = "<?php echo $rtpth;?>manage-cart?prodidval="+prodidval+"&cartaction="+cartaction+"&rqst_prodqty="+prodqtyval+"&szval="+sz+"&qtyval="+qtyval;
			xmlHttp	= GetXmlHttpObject(stchng_UpdtCart);
			xmlHttp.open("GET", url , true);
			xmlHttp.send(null);
		}
}
	
	
	function stchng_UpdtCart() 
	{ 
		if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){ 					
		   var temp=xmlHttp.responseText;
		   var crtval = new Array();
		   crtval = temp.split('->');
		   var addsts  		= crtval[0];
		   var dispval 		= crtval[1];
		   var disptopcart  = crtval[2];
		   var displstitm   = crtval[3];		   
		   if(addsts == 1){
				document.getElementById('divshopbag').innerHTML = dispval;
				document.getElementById('divcart_top').innerHTML = disptopcart;
				document.getElementById('dialog').innerHTML = displstitm;				
		   		showdiv();
		   }
		}
	}
	
</script>
<div class="page_headiing_block mb-5">

<div class="container">
<h4 class="pagetitle"><span><?php echo $page_title;?></span></h4>
<ul class="breadcrumb justify-content-center">

<li><a href="<?php echo $rtpth;?>home">Home</a></li>

<li class="active"><?php echo $page_title;?></li>

</ul>

</div>
</div>
<div class="clearfix"></div>

<section id="myaccount" class="page shLogin">
  <div class="container">
    <?php include_once('account-links.php');?>
    <?php
		/*	if(isset($msg))
			{	 
				echo "$msg";
			}*/	

		?>
        <div class="clearfix"></div>
<div class="marBtm"></div>
<div class="clearfix"></div>

<div class="row">
<div class="col-md-6">
<div class="table-responsive">
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="table table-sm table-bordered">
     
        <!--<thead>
          <tr>
           
            <?php /*?><th>S.No</th><?php */?>
            <th>View</th>
            <th>Code/Name</th>
           <?php /*?> <th>Date Added</th>
            <th>Price</th>
             <th>Action</th><?php */?>
          </tr>
        </thead>-->
        <?php

				if($cntrecwshlst_dtl > 0){
					$sn = 1;

					while ($srowvw_usrwshlst_dtl=mysqli_fetch_assoc($srsvw_usrwshlst_dtl)){

						$prod_qty  	  = ($srowvw_usrwshlst_dtl['usrwshlstd_qty']);
						
						$prodprcdkrt =  $srowvw_usrwshlst_dtl['gldprcm_nm'];
						//$prodofrprc   = ($srowvw_usrwshlst_dtl['prodprcd_ofrprc'] * $prod_qty);
					
			           /*  $prodprcdsz =  $srowvw_usrwshlst_dtl['prodprcd_sz_id'];
						 $mkngprc =  $srowvw_usrwshlst_dtl['prodprcd_mkngprc'];
						 $prodprcdkrt =  $srowvw_usrwshlst_dtl['gldprcm_nm'];
						 $prodprcdkrtprc =  $srowvw_usrwshlst_dtl['gldprcm_prc'];
                               
                        //  $mrpprc =  ($prodprcdsz*$prodprcdkrtprc)+$mkngprc;		
						  				
                          
						     $prdprc =  ($prodprcdsz*$prodprcdkrtprc);
				   //  $dlrmrpprc  =    number_format($prdprc/$sesdlrprc,2);
				     // $mrpprc  =  $dlrmrpprc+$mkngprc;
					
					
						    $dlrmrpprc  =    ($prdprc/$sesdlrprc);
						  	$mkngprc = ($mkngprc/$sesdlrprc);
						    $mrpprc  =  $dlrmrpprc+$mkngprc;
								$mrpprc = roundPrice($mrpprc);
					        $mrpprc  = number_format($mrpprc,2);
						    $prodprc   	  = ($mrpprc * $prod_qty); */
			$prdwht1 = $srowvw_usrwshlst_dtl['prodprcd_sz_id'];
		  $gldprc1 = $srowvw_usrwshlst_dtl['gldprcm_prc'];
		 $mkngprc1 =$srowvw_usrwshlst_dtl['prodprcd_mkngprc'];


			 $wstgval1 =$srowvw_usrwshlst_dtl['wstgm_per'];
                  $wstgper1 =  ($wstgval1/100);
                  $prdprcamt1 =   $prdwht1*$gldprc1;
				 $wstgamt1 = $prdprcamt1*$wstgper1;
				    
		 $prdprc1 = $wstgamt1+$prdprcamt1;
				 
				 
				 // $prdprc = number_format($prdprc/$sesdlrprc,2) ;    
				 
			//	 $ntprc = $prdprc+$mkngprc;
				 
			    $mkngprc1 = $mkngprc1;
			     @$prdprc1 = ($prdprc1) ;    
	  		      @$ntprc = $prdprc1+$mkngprc1 ;
				  
				  //echo $ntprc;
				  
				  //exit;
	             
				 $ntprc = roundPrice($ntprc);
				 
				 
				 
 
	           //   $srchprc = number_format($ntprc,2);
				 
				 // $sesdlrprc
				// $wstgper =  $srowsprod_mst['wstgm_per'];
				 
				 
				//$prdprc =  number_format($prdprc,2);
							
					
					   if(($ntprc > $prodofrprc)&&($prodofrprc >0)){
                        //$prc = $prodofrprc;
						   }else {
							   $prc = $ntprc;
							   
							   }
							   
							   
						?>
        <tr>
       <?php /*?> <td><?php echo $sn++; ?></td><?php */?>
          
          <td width="48">
<?php /*?>		  <input type="hidden" name="lstszid" id="lstszid" value="<?php echo $srowvw_usrwshlst_dtl['usrwshlstd_szm_id']; ?>"> 
<?php */?>          <input type="hidden" name="lstqty" id="lstqty" value="<?php echo $srowvw_usrwshlst_dtl['usrwshlstd_qty']; ?>"> 
		  <?php

						   $sqryprodimg_dtl="select 

												  prodimgd_simg

											  from

												 prodimg_dtl

											  where 

													prodimgd_prodm_id = '$srowvw_usrwshlst_dtl[usrwshlstd_prodm_id]'

													 order by prodimgd_prty desc limit 0,1";
													 
													 
													 

						   $srsprodimg_dtl    = mysqli_query($conn,$sqryprodimg_dtl);

							$cntrecprodimg_dtl = mysqli_num_rows($srsprodimg_dtl);

							$rowprodimg_dtl = mysqli_fetch_assoc($srsprodimg_dtl);

							$imgnm = $rowprodimg_dtl['prodimgd_simg'];

							 $imgpath = $u_gsml_fldnm.$imgnm;

						   if(($imgnm !="") && file_exists($imgpath)){ 

							  echo "<img src='$imgpath' width='48' height='53'>";

						   }else{
							   echo "<img src='images/noimage.jpg' width='48' height='53'>";
							   }

						?></td>
         
          
          <td><?php echo $srowvw_usrwshlst_dtl['prodm_code']; ?><br/>
            <span class="text-capitalize"><?php echo $srowvw_usrwshlst_dtl['prodm_name']; ?></span>
            <br/>
            <span class="text-capitalize"><?php echo $srowvw_usrwshlst_dtl['prodprcd_sz_id']; ?>(gms)</span>
            <br/>
            <span class="text-capitalize">INR <?php echo number_format($prc,2,'.',','); ?></span>
             <br/>
            <span class="text-capitalize"> <?php echo  $prodprcdkrt; ?> Karat</span></td>
            
         
         
        </tr>
        
        <tr>
        <td colspan="2" align="right">
        <?php if($srowvw_usrwshlst_dtl['prodprcd_qnty'] > 0){ ?>
        <a href="#" class="btn btn-link text-primary"   onClick="javascript:funcUpdtCart('<?php echo $srowvw_usrwshlst_dtl['usrwshlstd_prodm_id']; ?>','a','<?php echo $srowvw_usrwshlst_dtl['usrwshlstd_qty']; ?>','<?php echo $srowvw_usrwshlst_dtl['usrwshlstd_szm_id']; ?>')"><i class="fas fa-shopping-cart"></i> Add to cart</a>
          <?php } ?>
            <a href="<?php echo $rtpth;?>view-wishlist?wishid=<?php echo $srowvw_usrwshlst_dtl['usrwshlstd_id']; ?>"  class="btn btn-link text-black" onClick="return confirm('Are You Sure you want to Delete?')"><i class="fas fa-times-circle"></i> Remove</a></td></tr>
        
        <?php

					}

				}

				?>
                
      </table>
      
      <a href="<?php echo $rtpth;?>" class="btn btn-primary btn-lg">Explore Shop <i class="fas fa-chevron-right"></i></a>
</div>
</div>
<div class="col-md-6">

<?php
if($msg != ""){
?>
<div class="alert alert-success">
    <?php
echo $msg;
?>
  </div>
  <?php
}
  ?>



<h6 class="h6 title text-primary text-semibold">Send the wishlist to your loved one</h6>

<form name="frmref" id="frmref" method="post"  onSubmit="return yav.performCheck('frmsgnin',snrules,'inline');" action="<?php $_SERVER['PHP_SELF'];?>"   >

        <fieldset>
          <div class="form-group">
            <input class="form-control input-lg" placeholder="Your Friend name" name="txtnm" id="txtnm" type="text" required="required" >
            <span id="errorsDiv_txtnm"></span> </div>
          
          <div class="form-group">
            <input class="form-control input-lg" placeholder="Your Friend email" name="txteml" type="text"  id="txteml" autofocus required="required">
            <span id="errorsDiv_txteml"></span> </div>

          <div class="form-group">
          
          <input type="hidden" name="hdnmbr" id="hdnmbr" value="<?php echo $membrid ?>" />
          
          
            <input type="submit" name="btnsbt" id="btnsbt" class="btn btn-primary btn-lg" value="Send">
             </div>
          <?php
if($gmsg !=""){
echo "$gmsg";
}	
?>
          </fieldset>
      </form>
      
      
   <!--   <h6 class="h6 title text-primary text-semibold">Share your wishlist and tag your loved one</h6>
      
      
      <a href="#" class="btn btn-fb  btn-lg" id="signInGl"><i class="fab fa-facebook-f"></i>  Share on Fecbook</a><br /><br />
      
      
      <a href="#" class="btn btn-twit btn-lg" id="signInGl"><i class="fab fa-twitter"></i>  Share on Twitter</a>
      -->

</div>
</div>

    
</div>
</section>
<?php include_once('footer.php');?>
