<?php
	error_reporting(0);
//echo "HHHH";exit;

	include_once 'includes/inc_nocache.php'; // Clearing the cache information
	//include_once "includes/inc_usr_sessions.php";		
	include_once 'includes/inc_connection.php';//Make connection with the database
	//include_once "includes/inc_usr_sessions.php";//Including user session value		  	
	//include_once 'includes/inc_fnct_img_resize.php';//Image Resize Code
	include_once 'includes/inc_usr_functions.php';
	include_once 'includes/inc_folder_path.php';			 	
	include_once "includes/inc_config.php";
	/**********************Checking And Assigning Request Values *************************/
	if(isset($_REQUEST['action']) && (trim($_REQUEST['action']) != "")){
		$action	 = glb_func_chkvl($_REQUEST['action']); 	// Stores the action to be taken (add,update,delete)
	}
	/**********************Checking And Assigning *************************/	
	$ses_cart 	  = "";		
	$ses_cartcode = "";     // Stores the cartcode
 	$ses_prodqty  = "";    // Stores the session quantities
	$pgrval 	  =  $_SESSION['sesloc'];

/*	if(isset($_REQUEST['prodid']) && (trim($_REQUEST['prodid']) != "")){
		$prdid	 = glb_func_chkvl($_REQUEST['prodid']); 	// Stores the requested productid
	}
*/
	//$ses_prodid   = "";	   // Stores the session productid	
	//$ses_prodclr  = "";    // Stores the session product colour
	//$ses_prodsbmn = "";    // Stores the session product submenu
	//$ses_prodsz   = "";    // Stores the session product size

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
		
	/***********************Check and execute the action****************************/
	/*switch ($action){
		case 'd':
			
			
			if(isset($ses_cartcode) && (trim($ses_cartcode) != "") && 
			   isset($ses_prodqty) && (trim($ses_prodqty) != "") && 
			   isset($_REQUEST['prodcode']) && (trim($_REQUEST['prodcode']) != "")){																						
			   
				$ary_crtcode_val  = explode(",",$ses_cartcode);								
				$ary_prodqty_val  = explode(",",$ses_prodqty);				
				$rmv_prodcode  	  = glb_func_chkvl($_REQUEST['prodcode']);												
				$ary_prodid_val   = explode(",",$ses_prodid);
				$ary_prodchk_val   = explode(",",$ses_cartchk);	
							
				$nw_prodqty_val  = "";
				$nw_crtcode_val  = "";				
				$nw_totqty		 = "";
				$nw_prodid_val  = "";
				$nw_prodchk_val  = "";
								
				if($rmv_prodcode != ""){
					for($cnt_cartval = 0; $cnt_cartval < count($ary_crtcode_val); $cnt_cartval++){					
						if($rmv_prodcode != $cnt_cartval){
							$nw_crtcode_val .= ",".$ary_crtcode_val[$cnt_cartval];	
							$nw_prodqty_val .= ",".$ary_prodqty_val[$cnt_cartval];	
							$nw_prodid_val  .= ",".$ary_prodid_val[$cnt_cartval];	
							$nw_totqty		+= $ary_prodqty_val[$cnt_cartval];	
							$nw_prodchk_val		.= $nw_prodchk_val[$ary_prodchk_val];												
						}					
					}
					$nw_crtcode_val = substr($nw_crtcode_val,1);					
					$nw_prodqty_val = substr($nw_prodqty_val,1);					
					$nw_prodid_val 	= substr($nw_prodid_val,1);
					$nw_prodchk_val 	= substr($nw_prodchk_val,1);

							
					
					
					$ses_cart 			  = $nw_crtcode_val;
					$_SESSION['prodqty']  = $nw_prodqty_val;
					$_SESSION['cartcode'] = $nw_crtcode_val;					
					$_SESSION["totqty"]	  = $nw_totqty;	
					$_SESSION["prodid"]	  = $nw_prodid_val;
					$_SESSION['seschkcart'] = $nw_prodchk_val;	
				}	
			}
			
		break;
		}
		$_SESSION['cart'] = $ses_cart;	*/
	include_once 'cart_calculation.php';			
?>
<?php
	$seopage_title = "My Account |$usr_cmpny";
	$page_title = "My Account |$usr_cmpny";
	$current_page = "viewcart";
	include_once('header.php'); 
	
?>

<script>
	function numOnly(evt) {
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 &&(charCode < 48 || charCode > 57))
		return false;		
		return true;
	}
</script>
<div class="container">
<div class="page_headiing_block">

<h3 class="pagetitle marginTop-0">My Cart</h3>
<ul class="breadcrumb justify-content-center">
<li><a href="<?php echo $rtpth;?>home">Home</a></li>
<li class="active">My Cart</li>
</ul>

</div>
</div>
<?php // include('process-links.php');?>
<div class="clearfix"></div>

<section id="myaccount" class="page">
<div class="container">

  <p class="text-primary d-md-none text-center"><strong>Swipe to view cart details</strong></p>
<form method="post"  name="cart" id="cart" action="manage-cart?cartaction=u">

<?php	 // print_r($_SESSION['cartaltr']);
		  if(isset($dispcart_cntshdr) && (trim($dispcart_cntshdr) != "")){
        		echo "<tr><td valign='top'>$dispcart_cntshdr</td></tr>"; 
		  }
		?>
  <?php
				//<a href='#' class='checkout_link'>Update</a> 
				if(isset($_SESSION['cartcode']) && (trim($_SESSION['cartcode']) != "")){
					echo "<div class='clearfix'></div>
					<div class='row justify-content-center'>
					
					<div class='col-sm-6 text-center'>
					<div>Not done yet?</div>
					<a href='".$rtpth."home' class='btn btn-primary'>Continue Shopping</a>
					</div>
					<div class='col-sm-6 text-center'>
					<div>Satisfied with your selection?</div>
					<!--<a href='#' onclick='cart.submit();'  class='btn btn-primary' >Update Cart</a>-->
					<a href='".$rtpth."signin' class='btn btn-primary'>Proceed to Checkout </a>
					</div>
					
					</div>
					";
				
				}
				else{
					echo "<div class='clearfix'></div><ul class='list-inline text-right'><li><a href='".$rtpth."' class='btn btn-primary'>Continue Shopping</a></li></ul>";				
				}
			?>
          

</form>




<form name="latrfrm" id="latrfrm" method="post" action="manage_cart.php?cartaction=al">

<?php
echo $lhnaltr;
echo $kuraltr;

?>
</form>
<script>
// Measure adding a product to a shopping cart by using an 'add' actionFieldObject
// and a list of productFieldObjects.
dataLayer.push({ ecommerce: null });  // Clear the previous ecommerce object.
dataLayer.push({
  'event': 'addToCart',
  'ecommerce': {
    'currencyCode': 'EUR',
    'add': {                                // 'add' actionFieldObject measures.
      'products': [{                        //  adding a product to a shopping cart.
        'name': 'Triblend Android T-Shirt',
        'id': '12345',
        'price': '15.25',
        'brand': 'Google',
        'category': 'Apparel',
        'variant': 'Gray',
        'quantity': 1
       }]
    }
  }
});
</script>

</section>
<?php include_once('footer.php');?>
