<?php
error_reporting(0);
	session_start();
	include_once "includes/inc_nocache.php"; // Clearing the cache information
	include_once "includes/inc_connection.php";//Make connection with the database
	include_once "includes/inc_usr_functions.php";		  	
	include_once 'includes/inc_folder_path.php';
	include_once "includes/inc_config.php"; // Clearing the cache information


	if(isset($_REQUEST['cartaction']) && (trim($_REQUEST['cartaction']) != "")){  

		$action	 = glb_func_chkvl($_REQUEST['cartaction']); 	// Stores the action to be taken (add,update,delete)

		if(isset($_REQUEST['prodidval']) && (trim($_REQUEST['prodidval']) != "")){

			$prdid	 = glb_func_chkvl($_REQUEST['prodidval']); 	// Stores the requested productid

		}
	
		if(isset($_REQUEST['rqst_prodqty']) && (trim($_REQUEST['rqst_prodqty']) != "")){

			$prdqty	 = glb_func_chkvl($_REQUEST['rqst_prodqty']); 	// Stores the requested productid

		}

		if(isset($_REQUEST['vechbrnd']) && (trim($_REQUEST['vechbrnd']) != "")){

	 		$vechbrnd	 = glb_func_chkvl($_REQUEST['vechbrnd']); 	// Stores the requested productid 

		}


		/**********************Checking And Assigning *************************/
		$ses_cart 		  	  = "";		

		$ses_cartcode 	  = "";    // Stores the cartcode

		$ses_prodid   	  = "";	   // Stores the session productid

		$ses_prodqty  	  = "";    // Stores the session quantities
       
		$flg		      = 0;	   // Stores 0 if record not added or updated and 1 if record added successfully

		/**********************Assigning Values to Sessions *************************/

		if(isset($_SESSION['cart']) && (trim($_SESSION['cart'] != ""))){

			$ses_cart = $_SESSION['cart'];// Stores the cart detail

		}

		if(isset($_SESSION['cartcode']) && (trim($_SESSION['cartcode'] != ""))){

			$ses_cartcode = $_SESSION['cartcode'];// Stores the cartcode

		}

		if(isset($_SESSION['prodid']) && (trim($_SESSION['prodid'] != ""))){

			$ses_prodid   = $_SESSION['prodid'];// Stores the session productid

		}

		if(isset($_SESSION['prodqty']) && (trim($_SESSION['prodqty']) != "")){

			 $ses_prodqty = $_SESSION['prodqty'];	

		}	


	if(isset($_SESSION['prodvechbrnd']) && (trim($_SESSION['prodvechbrnd']) != "")){

			$ses_prodvechbrnd = $_SESSION['prodvechbrnd'];	

		}	

		if(isset($_SESSION['seschkcart']) && (trim($_SESSION['seschkcart'] != ""))){

			$ses_cartchk = $_SESSION['seschkcart'];// Stores the cartcode

		}

		/*******************************************************************************/	
		/***********************Check and execute the action****************************/
		switch ($action){
			/*************Adding new items to the prodid and prodqty session*****************/
			case 'a':	

			if(($ses_prodid == "") && ($ses_prodqty == "") && ($prdid != "")){													
 
				$_SESSION['prodid']	  	  = $prdid;
				$_SESSION['prodqty']   	  = $prdqty;
				$_SESSION['prodvechbrnd'] = $vechbrnd;
			 	$_SESSION['cartcode'] 	  = $prdid."-".$prdqty."-".$vechbrnd;  
				//$_SESSION['seschkcart']   = $prdid."-".$vechbrnd;
                $_SESSION['seschkcart']   = $prdid;
				$flg = 1;				

			}elseif(($ses_prodid != "") && ($ses_prodqty != "") && ($prdid != "")){
		
				 $arycartcode	 = explode(",",$_SESSION['cartcode']);

				 $arycartchk	 = explode(",",$_SESSION['seschkcart']);
/*print_r( $arycartchk);
echo '<br>';*/
				$cartcodeval	 = $prdid."-".$prdqty."-".$vechbrnd;
				 //$chk_cartcodeval	 = $prdid."-".$vechbrnd;
			 	$chk_cartcodeval	 = $prdid;

				if(in_array($chk_cartcodeval,$arycartchk)== false){			

					$_SESSION['prodid']   = $_SESSION['prodid'].",".$prdid;			

					$_SESSION['prodqty']  = $_SESSION['prodqty'].",".$prdqty;
				
					$_SESSION['prodvechbrnd']  = $_SESSION['prodvechbrnd'].",".$prodvechbrnd;

					$_SESSION['cartcode'] = $_SESSION['cartcode'].",".$cartcodeval;

					$_SESSION['seschkcart'] = $_SESSION['seschkcart'].",".$chk_cartcodeval;

					$flg = 1;



				}



			}						



			if($ses_cart){

				$ses_cart .= ','.$prdid;					

			}else{

				$ses_cart = $prdid;

			}	

			/*************************************************************************/			

		break;		



		case 'd':	



			/********* Deleting the item from prodid and prodqty session*************/



			if(isset($ses_cartcode) && (trim($ses_cartcode) != "") && 



			   isset($ses_prodqty) && (trim($ses_prodqty) != "") && 



			   isset($_REQUEST['prodcode']) && (trim($_REQUEST['prodcode']) != "")){																						


error_reporting(0);
			   



				$ary_crtcode_val  = explode(",",$ses_cartcode);								
				$ary_prodqty_val  = explode(",",$ses_prodqty);				            
				$ary_prodvechbrnd_val  = explode(",",$ses_prodvechbrnd);
				
				$rmv_prodcode  	  = glb_func_chkvl($_REQUEST['prodcode']);												

				$ary_prodid_val   = explode(",",$ses_prodid);

				$ary_prodchk_val   = explode(",",$ses_cartchk);	

				$nw_prodqty_val  = "";
				$nw_prodvechbrnd_val  = "";
				$nw_crtcode_val  = "";				
				$nw_totqty		 = "";
				$nw_prodid_val  = "";
				$nw_prodchk_val  = "";



								



				if($rmv_prodcode != ""){



					for($cnt_cartval = 0; $cnt_cartval < count($ary_crtcode_val); $cnt_cartval++){					



						if($rmv_prodcode != $cnt_cartval){



							$nw_crtcode_val .= ",".$ary_crtcode_val[$cnt_cartval];	
							$nw_prodqty_val .= ",".$ary_prodqty_val[$cnt_cartval];	
							$nw_prodvechbrnd_val .= ",".$ary_prodvechbrnd_val[$cnt_cartval];	
							$nw_prodid_val  .= ",".$ary_prodid_val[$cnt_cartval];	
							$nw_totqty		+= $ary_prodqty_val[$cnt_cartval];	
							$nw_prodchk_val	.= ",".$nw_prodchk_val[$cnt_cartval];												



						}					

					}



					$nw_crtcode_val = substr($nw_crtcode_val,1);					
					$nw_prodqty_val = substr($nw_prodqty_val,1);					
					$nw_prodvechbrnd_val = substr($nw_prodvechbrnd_val,1);					
					$nw_prodid_val 	= substr($nw_prodid_val,1);
					$nw_prodchk_val 	= substr($nw_prodchk_val,1);

					$ses_cart 			  = $nw_crtcode_val;
					$_SESSION['prodqty']  = $nw_prodqty_val;
					$_SESSION['prodvechbrnd']  = $nw_prodvechbrnd_val;
					$_SESSION['cartcode'] = $nw_crtcode_val;					
					$_SESSION["totqty"]	  = $nw_totqty;	
					$_SESSION["prodid"]	  = $nw_prodid_val;
					$_SESSION['seschkcart'] = $nw_prodchk_val;	



				}	



			}



			/************************************************************************/			



	//	header("Location:".$rtpth."viewcart");
//echo "Heloo";exit;
echo "<script>";
echo "location.href='my-cart.php'";
echo "</script>";


		break;



		case 'u':



				/********* Updating the item from prodid and prodqty session*************/



			if (isset($ses_cartcode) && ($ses_cartcode != "") && 



			   isset($ses_prodid) && ($ses_prodid != "") && 			



			   isset($ses_prodqty) && ($ses_prodqty != "")){	



				$newcart 	= '';
                $updqty  	= ''; 
       


				foreach ($_POST as $key=>$value){						


					if($updqty == ""){


					 $updqty = trim($value);


					}// End of if($updqty)



					else{



					 	$updqty = $updqty.",".trim($value);

					}	
			

				}// End of foreach



			}// end of if



			$ses_cart = $newcart;

$_SESSION['pckstr'] = $updpckstr;

		    $_SESSION['prodqty'] = $updqty;	



			//$qty = $updqty;					



		//	header("Location:".$rtpth."viewcart");
echo "<script>";
//echo "location.href='".$rtpth."'viewcart";
echo "location.href='my-cart.php'";

echo "</script>";


			break;






		}



		$_SESSION['cart'] = $ses_cart;		

		//print_r($_SESSION['prodqty']);				

		/********************Display of cart in div ******************/

		 $cartval    		= $_SESSION['cartcode'];
		 $prodidval  		= $_SESSION['prodid'];			 
		 $prodqtyval 		= $_SESSION['prodqty'];
		 $prodvechbrnd 		= $_SESSION['prodvechbrnd'];
			 			 		 		 

		 if(($cartval != "") && ($prodidval != "") && ($prodqtyval != "")){		 

			$codearr	=	explode(",",$prodidval);
			$qtyarr		=	explode(",",$prodqtyval);	
			$newArray	=	$codearr;
			$items 		= 	explode(',',$cartval);				
			$incrmtval 	= 	count($codearr);	
			$totqty    = 0;
			$totxlcredits = 0;
			$dispbag 	= "";

			$dispbag 	 .= "<table width='100%' class='table table-sm text-white'><thead><th width='40%'  >Name</th><th width='20%'  >Qty</th><th width='20%'  >Price</th></thead>";	



			foreach($items as $items_id=>$items_val){					



				$totuntprc = 0;



				$totbilprc = 0;											



				



				$cartcodeid  = ""; //For Storing the cart value id



				$cartcodeval = ""; //For Storing the cart code value







				$cartcodeid  = $items_id;



				$cartcodeval = $items_val; //  Stores the cart detail value



				



				$arr_cartcodeval = explode("-",$cartcodeval);



				$cart_prodid	 = $arr_cartcodeval[0]; // Stores the product id 



				$cart_prcid	  	 = $arr_cartcodeval[1]; // Stores the product id 



				$untqty 		 = $qtyarr[$cartcodeid]; // Stores the unit quantities



				



				if($cart_prodid != ""){					




											

											

		
						$sqryhdr_prod_dtl = "select  prodm_id, prodm_sku, prodm_code, prodm_name, prodm_size, prodm_ptrn, prodm_cstprc,                       prodm_sleprc,  prodm_ofrprc, prodm_dsc, prodm_sdsc, prodm_st, prodm_sky, prodm_sotl,                       prodm_sodsc, prodm_sttle, prodm_stdsc, prodm_sts, prodm_rnk,vehtypm_id, vehtypm_name,
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
		  
		prodm_id !='' and prodm_sts ='a' and vehtypm_sts='a' and vehbrndm_sts='a' and vehmodlm_sts='a' and
		vehvrntm_sts='a' and tyrprflm_sts='a' and tyrrmszm_sts='a' and tyrwdthm_sts='a' and tyrbrndm_sts='a'and
											prodm_id='$cart_prodid'
										
											
											";

					
					$srshdr_prod_dtl  = mysqli_query($conn,$sqryhdr_prod_dtl);				



					



					$srowhdr_prod_dtl = mysqli_fetch_assoc($srshdr_prod_dtl);		



					



					$hdr_prodm_id	= $srowhdr_prod_dtl['prodm_id'];



					$hdr_prodm_code = $srowhdr_prod_dtl['prodm_code'];	



					$hdr_prod_name 	= $srowhdr_prod_dtl['prodm_name'];

					$hdr_uprodnm	= funcStrRplc($hdr_prod_name);					


					$hdr_lnkname = "$hdr_uprodnm/$hdr_prodm_code";
                      $untprc 	= $srowhdr_prod_dtl['prodm_fnlprc'];



					$totuntprc    	= (($untqty * $untprc)); //Stores inr price



					$tothndlchrg  	= (($untqty * $hndlchrg)); //Stores usd price



					$totcartprc   	= $totcartprc + $totuntprc;					



					$totxlcredits 	= $totxlcredits + $unt_crdt;// Stores total xl credits



					$totqty       	= $totqty + $untqty;


					



					$dispbag 	 .= "<tr><td><div class='miniBag'><a href='".$rtpth."$hdr_lnkname' class='signout'>$hdr_prod_name</a></div></td><td><span>$untqty</span></td><td>";



					if($untprc <= 0){



						$dispbag .="<span>N.A</span>";



					}else{	



					$dispbag .="<span>$totuntprc</span>";



					}



					$dispbag 	 .= "</td></tr>";



		


					/*---------------------------------------Change---------------------------------------------*/					



				

			}						



		}// End of For each



	}	



	//$_SESSION["totamt"] = $totcartprc;	



	$_SESSION["totqty"] = $totqty;



	



	if($totcartprc <= 0){



		$totcartprc = 'N.A';



	}

	

	

	$totbagqty = $_SESSION["totqty"];



	$_SESSION["totcnt"] = $incrmtval;





		$dispbag .= "<tr><td><strong>Total</strong></td><td>$totqty</td><td></div>$totcartprc</td></tr>



		  <tr><td colspan='3' align='right'><div class='clearfix'></div><a href='".$rtpth."my-cart.php' class='btn btn-primary btn-block'>VIEW CART</a></td></tr>";		



	



		



	 $dispcart_mini 	 .= "</table>";



	/*



	UNCOMMENT WHEN SHOPPING CART ENABLED



	<div style='display:block;  float:left; width:100px;'>Subtotal</div>



	<div style='display:block;  float:left; width:60px; text-align:right;'>$totbagamt</div>		



	*/



	



	/*----------------------------Change-------------------------------*/



	//$disp_topcart = "[$totbagqty]&nbsp;Item&nbsp;&nbsp;&nbsp;$crncyval:&nbsp;$totbagamt";



	$disp_topcart = "<span class='cartIcon'> <i class='fas fa-shopping-cart'></i></span> <span class='fence-cart'> <span class='cartVal'>($incrmtval)</span></span>";



	/*----------------------------Change-------------------------------*/					



	



	$imgnm 		= $srowhdr_prod_dtl['prodimgd_simg'];	



	$imgpth 	= $u_gsml_fldnm.$imgnm;	



	if(($imgnm != "") && file_exists($imgpth)){



		$imgpth = $imgpth;



	}else{



		$imgpth = "images/noimage.jpg";



	}



	$prodcode 	= trim($srowhdr_prod_dtl['prodm_code']);



	$prodname	= trim($srowhdr_prod_dtl['prodm_name']);



	



	$lastprod_div = "<div class='popBag'>

					<h4>$incrmtval Item(s) in Your Cart </h4>

					<div class='popcnt'>

					<h4>Name - $prodname</h4>

					<img src='$rtpth$imgpth' width='80' height='80' />

					<p>

Code - $prodcode</p></div>

					

<div class='clearfix'></div><a href='".$rtpth."my-cart.php' class='btn btn-primary btn-block'>View Cart</a>	

					</div>";	



		/*



		<td width='30%' align='center'>Remove<br />



	  		<input type='checkbox' name='checkbox' value='checkbox' onclick='funcRmvItm($cartcodeid)'/>



		</td>*/	  		  			



	/*************************************************************/			



	echo $flg.'->'.$dispbag.'->'.$disp_topcart.'->'.$lastprod_div.'->'.$atchslvs.'->'.$altrned.'->'.$altrtyp.'->'.$incrmtval;		



	}		



?>