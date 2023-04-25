<?php



	include_once 'includes/inc_folder_path.php';



	include_once "includes/inc_connection.php";//Make connection with the database



	include_once "includes/inc_usr_functions.php";



 	//include_once "admin/script.php";



	 	include_once "manage_cart.php";

	

	

	if($_POST['crncyval'] != ""){

	  $curcytyp =   $_POST['crncyval'];

	   $_SESSION['curtyp']=$curcytyp;

		}else{

			

	 $curcytyp =    $_SESSION['curtyp'];

			}



	

		  $sesdlrprc = $_SESSION['dlrprc'];






	$crncynm	= funcCrncyNm($_SESSION['sescrncy']);//Currency Name	



			$hdnlaltrtyp = $_SESSION['laltrtyp'];

			$hdnkaltrtyp = $_SESSION['kaltrtyp'];



//	$dispcart_cntshdr = "<p class='text-right'><span class='label'>All Price(s) are in $crncynm only</span></p><div class='table-responsive'><table width='100%' cellpadding='0' cellspacing='0' class='table table-striped shTable'>";	



	$dispcart_cntshdr = "<p class='text-right'><span class='label'></span></p><div class='table-responsive'><table width='100%' cellpadding='0' cellspacing='0' class='table table-striped shTable'>";	



	$totqty    		= 0;



	$totxlcredits 	= 0;



	$totcartprc 	= 0;



	$carttotamt     =0;	



	$incrmtval      =0;



	$_SESSION["totamt"] = 0;				



	$_SESSION["totqty"]	= 0; //Stores the total bill price



	



	



	



	$cartval    	= $_SESSION['cartcode'];



	

//print_r($cartval);
 $prodpckstrl 	= $_SESSION['pckstr'];	
	$prodqtyval 	= $_SESSION['prodqty'];			

	

	 $prodaltrval 	=$_SESSION['prodaltr'];

	

//echo "-----Altr----->". $prodaltrval;

//	echo  "---Qty------->". $prodqtyval;



	if(($cartval != "") && ($prodqtyval != "")){				



		$qtyarr		=	explode(",",$prodqtyval);	

		$altrarr		=	explode(",",$prodaltrval);	



		//print_r($qtyarr);

		//print_r($altrarr);

		

		$newArray	=	$codearr;



		$incrmtval 	= 	count($qtyarr);



	



		



		$dispcart_cntshdr .= "<thead class='bg-dark text-white'><tr>



									<th width='3%' align='center' class='text-center'>S.no.</th>



									<th width='7%' align='center'>&nbsp;</th>



									<th width='26%' align='center'>Product</th>



									<th width='10%' align='center' class='text-center'>Unit Price";

			//$dispcart_cntshdr .= "adfadsfasdf".$curcytyp;						

		if(($curcytyp == '') || ($curcytyp == 'i')){							

									

		$dispcart_cntshdr  .= " &nbsp;&nbsp;&nbsp;&nbsp;(INR)</th>";

		

		}else{

		

		$dispcart_cntshdr  .= " &nbsp;&nbsp;&nbsp;&nbsp;(INR)</th>";	

			

			}

		

		



			$dispcart_cntshdr .= "<th width='11%' align='center' >Qty.</th>									



									<th width='10%' align='center' class='text-center'>Net Price (INR)</th>																		



									<th width='3%' align='center'>&nbsp;</th>



									</tr>



								  </thead>";	



								  		

	

			

			$items = explode(',',$cartval);	

//print_r($items);		

			$dispcart_cntsdtl = '';



			$cntinc = 1;	



			$bgclr = '#171717';



			$dispcart_mini = '';



			$totWt	   = 0; 



			$dispcart_mini 	 .= "<table width='100%' class='table table-sm text-white'><thead><th width='40%'>Name</th><th width='20%'  >Qty</th><th width='20%'  >Price</th></thead>";	





			foreach ($items as $items_id=>$items_val){					



				if($cntinc % 2 == 0){



					$bgclr = '#171717';	



					$mncrtbgclr = '#333333';					



				}



				else{



					$bgclr = '#0C0C0C';					



					$mncrtbgclr = '#272727';										



				}



				$totuntprc = 0;



				$totbilprc = 0;



															



				



				$cartcodeid  = ""; //For Storing the cart value id



				$cartcodeval = ""; //For Storing the cart code value







				 $cartcodeid  = $items_id;



				$cartcodeval = $items_val; //  Stores the cart detail value



				



				$arr_cartcodeval  = explode("-",$cartcodeval);



			



				$cart_prodid	  = $arr_cartcodeval[0]; // Stores the product id 



				$cart_prcid	  	  = $arr_cartcodeval[1]; // Stores the product id 



				$cart_szid	  	  = $arr_cartcodeval[3]; // Stores the product id 





				

				$untqty 		  = $qtyarr[$cartcodeid]; // Stores the unit quantities

		       

			//echo "------------->". print_r($qtyarr);

			 

			   $untsz 		  = $cart_szid; // Stores the unit quantities

			

			  // print_r($altrarr);

			   

			    $prdaltr 		  = $altrarr[$cartcodeid]; // Stores the unit quantities



				



				//echo $prdaltr;



						



		



				if($cart_prodid != ""){					



					$sqryprod_dtl = 

									"select  prodm_id, prodm_sku, prodm_code, prodm_name, prodm_size, prodm_ptrn, prodm_cstprc,                       prodm_sleprc,  prodm_ofrprc, prodm_dsc, prodm_sdsc, prodm_st, prodm_sky, prodm_sotl,                       prodm_sodsc, prodm_sttle, prodm_stdsc, prodm_sts, prodm_rnk,vehtypm_id, vehtypm_name,
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
		vehvrntm_sts='a' and tyrprflm_sts='a' and tyrrmszm_sts='a' and tyrwdthm_sts='a' and tyrbrndm_sts='a'
												 and

												 prodm_id=' $cart_prodid' 

												 
												 
												 
												 ";

					$srsprod_dtl  = mysqli_query($conn,$sqryprod_dtl);				



					$srowprod_dtl = mysqli_fetch_assoc($srsprod_dtl);										


 

				    $db_uprodnm     = funcStrRplc($srowprod_dtl['prodm_name']);	 	

			        $prod_ucode     = funcStrRplc($srowprod_dtl['prodm_code']);	
		  if (preg_match('/[-]/', $srowprod_dtl['prodm_code']))
            {
			$prod_ucode     = funcStrRplcuscr($srowprod_dtl['prodm_code']);	
            }else{
			$prod_ucode     = funcStrRplc($srowprod_dtl['prodm_code']);	
			
	        }
			$untprc     = $srowprod_dtl['prodm_fnlprc'];	
$totuntprc    	= ($untqty * $untprc); //Stores inr price
$prodprc    = number_format($totuntprc,2,".",",");	

		$lnkname	  = "$rtpth$prod_ucode";

/*******************************Size****************************************************************************/				

    $resprodsz_mst = mysqli_query($conn,$sqryprodsz_mst);

	$rwprdsz_mst = mysqli_fetch_array($resprodsz_mst);


					
					$dispcart_cntsdtl .= "<tr><td align='center'>$cntinc</td><td valign='top' class='prod-img'>";					

					$imgnm  	= 	$srowprod_dtl['prodimgd_simg'];
					$imgpth 	= 	$u_gsml_fldnm .$imgnm;	
				    $totprdwt =  $dbProdWt*$untqty;
					if(($imgnm != "") && file_exists($imgpth)){
						$dispcart_cntsdtl .= "<a href=' $lnkname'><img src=\"$rtpth$imgpth\" style=\"max-width:78px; display:block\"  border=\"0\" alt=\"\" /></a>";
					}
					else{
						$dispcart_cntsdtl .="<a href=' $lnkname'><img src=\"".$rtpth."images/noimage.jpg\" style=\"max-width:78px; display:block\"  alt=\"\" border=\"0\" /></a>"; 
					}	
								
					$dispcart_cntsdtl .="</td><td align=\"left\" ><span style='line-height:21px; font-weight:500; text-transform:capitalize;'>$srowprod_dtl[prodm_name]<br/></span>
					<span style='font-size:12px; margin-right:15px;'>Code: $srowprod_dtl[prodm_code]</span>
					 <span style='font-size:12px; margin-right:15px;'>Weight: $untsz (gms)</span> <br>$stck
				
					";
			

	


$dispcart_cntsdtl .="</td>	"; 



					$tot_untqty = 20;



									$dispcart_cntsdtl .= "</td><td align='center' class='shMiddle'>";



					



					 if($untprc < 1){



						$dispcart_cntsdtl .= "N.A";



					 }else{	  			

					 

					  if($curcytyp == 'u'){

						$dispcart_cntsdtl .= funcDlrprc($untprc,$conn);

						  }else{

					 	 					 



					 	$dispcart_cntsdtl .=number_format($untprc,2);

						  }

					 }



					$unt_shpprc 	= 0;	



					$dispcart_cntsdtl .="</td>



					<td align='center' class='shMiddle'>

					

					

					<div class='input-group input-group-sm mb-3'>

					<div class='input-group-prepend'>

  

	<button type='button' class='btn btn-outline-secondary id='qntyinc$cntinc' onclick ='cuntdec($untqty,$db_prcid,$prdqty),cart.submit();'>

                  <span class='fas fa-minus'></span>

                </button>

  </div>

					

 

  

 <input type='text' name='txtqty".$db_prcid."' id='txtqty".$db_prcid."' value='$untqty' class='form-control border border-secondary' size='3' maxlength='3'>


  
<div class='input-group-append'>

    

	<button type='button' class='btn btn-outline-secondary' id='qntydec$cntinc' onclick='cuntinc($untqty,$db_prcid,$prdqty,$cntinc),cart.submit();'> 

                  <span class='fas fa-plus'></span>

                </button>

	



  </div>



       

    </div>

					

					</td><td align='center' class='shMiddle'>";

					

                        if($curcytyp == 'u'){

						$untprc = funcDlrprc($untprc,$conn);

						  }else{

					 	 					 

					 	$untprc =$untprc;

						  }

					$totuntprc    	= ($untqty * $untprc); //Stores inr price



					

					$bx_totcartprc  = ($totuntprc + $unt_shpprc);



				$totcartprc   	= ($totcartprc + $totuntprc + $unt_shpprc );						



				



					$totqty            = $totqty + $untqty;



					



					$prodwt = $untqty * $dbProdWt;



			         $totWt		   = $totWt + $prodwt;



				







					//$totWt			   = $totWt + $dbProdWt; 



					$untbx_prc 	= ($untprc + $srowprod_dtl['prodprcd_shpprc']);



					$frmt_totuntprc    = number_format($untbx_prc,2,".",",");									



					$prodprc    = number_format($totuntprc,2,".",",");									







					



					//$frmt_totuntprc    = "N.A.";



					 if($frmt_totuntprc < 1){



						$dispcart_cntsdtl .="N.A";



					 }else{	  



						$dispcart_cntsdtl .= "&nbsp;$prodprc";



					 }



					 //<td>".number_format($bx_totcartprc,2,".",",")."</td>



					$dispcart_cntsdtl .= "</td>									



					 <td align='center' style='font-size:18px;' class='shMiddle'>



					 	<!--<a href=\"".$rtpth."manage_cart.php?cartaction=d&amp;prodcode=$cartcodeid\" class='btn btn-primary btn-sm' onclick='funbDeletProd(d,$cartcodeid)'><i class='fas fa-trash-alt'></i> </a>	-->	 

				 

				    <a href=\"".$rtpth."manage_cart.php?cartaction=d&amp;prodcode=$cartcodeid\"  id='proddel' onclick='funbDeletProd()'><i class='fas fa-trash-alt'></i> </a>

				 



					 </td></tr>";      					 



					 







					/*--------------------Change---------------------------------*/		



					



					$mncrt_scat_nm 		= $srowprod_dtl['prodscatm_name'];		 



					$mncrt_cat_nm  		= $srowprod_dtl['prodcatm_name'];



					$mncrt_prod_name 	= $srowprod_dtl['prodm_name'];



					$mncrt_prod_code	= $srowprod_dtl['prodm_code'];



					



					$mncrt_uprodnm		= funcStrRplc($mncrt_prod_name);					



					$mncrt_uprodcatnm	= funcStrRplc($mncrt_cat_nm);	 



					$mncrt_uprodscatnm	= funcStrRplc($mncrt_scat_nm);	 



					



					



					



					$mncrt_lnkname = "$mncrt_uprodcatnm/$mncrt_uprodscatnm/$mncrt_uprodnm/$mncrt_prod_code";



					



					



					



					$dispcart_mini 	 .= "<tr><td><div class='miniBag'>$mncrt_prod_name</div></td><td><span>$untqty</span></td><td>";



					if($untprc < 1){



						$dispcart_mini .="<span>N.A</span>";



					}else{

						$totprc = number_format($bx_totcartprc,2,".",",");

						if($curcytyp == 'u'){

						    $dispcart_mini .="<span>".$totprc." USD"."</span>";

						  }else{

					 	    $dispcart_mini .="<span>".$totprc." INR"."</span>";

						  }	

						  

						  //echo $bx_totcartprc; exit;



					



					}



					$dispcart_mini 	 .= "</td></tr>";				



					/*--------------------Change---------------------------------*/														







					}

						

?>



<?php





		

		

					//$shpurl = "products.php?gid=".$_SESSION['sesmncatid']."&id=".$cart_prodsbnm."&sbmnu=".$submenu;		



					$cntinc++;



				}

				

				

				

				

				// End of For each



				//$pq = substr($pq,1);



				//$_SESSION["prodqty"]=  $pq;







				$frmtTotWt		   = $totWt."&nbsp"."Gms";																										



				$_SESSION["totamt"]			= $totcartprc; //Stores the total bill price						



				$_SESSION["totqty"]			= $totqty; //Stores the total bill price



				//$_SESSION["totxlcredits"] 	= $totxlcredits;//Stores the total xl credits



				//$_SESSION["prodcode"]=  $_SESSION["cart"]; // Check the variable required or not



				//$_SESSION["sestotwt"]	  	= $totwt; //Stores the total bill price



				//$_SESSION["sestothndlchrg"] = $totbilusdhndl;	



				$carttotamt 	   = number_format($_SESSION['totamt'],2,".",",");



				$dispcart_cntsdtl .= "<tr class='bg-dark text-white'>



				<td colspan='5' align='right' valign='top' style='padding-right:30px;'>Total (INR)</td>";//<td align='left' valign='top' style='padding-right:30px;'></td>



				//<td align='left' valign='top' style='padding-right:30px;'><strong></strong></td>



				



				if($carttotamt <= 0){



					$carttotamt ='N.A';



				}







				/*----------------------------------change----------------------------------*/				



				/*<td>Total Amount</td>



				<td >".number_format($totcartprc,2,".",",")."</td><td></td></tr>";	*/	



				/*----------------------------------change----------------------------------*/	

                 

				$dispcart_cntsdtl .= "<td align='left'>&nbsp;$crncyval&nbsp;$carttotamt</td>";



				if($curcytyp == 'u'){

				$dispcart_cntsdtl .="<td align='left'>USD</td>";

				}else{

					$dispcart_cntsdtl .="<td align='left'>INR</td>";

					}



				//echo 	$dispcart_mini;			



			}



			else{



				$dispcart_cntsdtl .= "<b>Please add products to your cart</b>";



			}	



			



			//$carttotxlcrdt     = number_format($_SESSION['totxlcredits'],2,".",",");



			$carttotqty = $_SESSION["totqty"];			







			if(isset($_SESSION['cartordpos'])){



				$cartposval = $_SESSION['cartordpos'];



				if($cartposval == 4){



					$shprdval = "/confirmandpay" ; // Shopping cart redirect value 					



				}



				/*elseif($cartposval == 3)



				{



					$shprdval = "payment.php" ; // Shopping cart redirect value 				



				}*/



				else{



					$shprdval = "/my-account" ; // Shopping cart redirect value 				



				}



			} 										  



		  $dispcart_cntshdr .= $dispcart_cntsdtl."</table></div>";		  	  		  



		  



		  if(trim($dispcart_mini) != ''){	







		  $dispcart_mini .= "<tr><td>Total</td><td>$totqty</td><td></div>";

		  

		  if($curcytyp == 'u'){

			    $carttotamt =   $carttotamt." USD";

			  }else{

			  $carttotamt = $carttotamt." INR";

			  }

		  

		  

		  $dispcart_mini .="$carttotamt</td></tr>



		  <tr><td colspan='3' align='right'><div class='clearfix'></div><a href='".$rtpth."viewcart' class='btn btn-block btn btn-primary'>VIEW CART</a></td></tr>";		  



		  



		  }



		  $dispcart_mini 	 .= "</table>";



		//$disptop_cart = "[$carttotqty]&nbsp;Item&nbsp;&nbsp;&nbsp;$crncyval:&nbsp;$carttotamt";



		/*-------------------------------Change----------------------------------*/



		$disptop_cart = "<span class='cartIcon'> <i class='fas fa-shopping-cart'></i></span> <span class='fence-cart'> (<span class='cartVal'>$incrmtval</span>)</span>";



?>

<div class="prdtaltr">

</div>



<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<script type="text/javascript">

 function checkedval (val) {

  var  lstschk =  '#customCheckL'+val;



  var  lstschkK =  '#customCheckK'+val;

  //alert(lstschkK)

	 if ($('#customCheckL'+val).not(':checked').length) {

           $('#aslvsL'+val).hide();

		  $('#Laltrtyp'+val).val('i');

	    $('#atchslL'+val).val('');

		}else{ 

            $('#aslvsL'+val).show ();

	    $('#Laltrtyp'+val).val('l');

		

	    $('#atchslL'+val).val('l');

		

		

	

		}

		

			 if ($('#customCheckK'+val).not(':checked').length) {

             $('#aslvsK'+val).hide();

		     $('#Kaltrtyp'+val).val('i');

	    	 $('#atchslK'+val).val('');

		  }else{ 

            $('#aslvsK'+val).show ();

			  $('#Kaltrtyp'+val).val('k');

				$('#atchslK'+val).val('k');

 

			  



		}

		

		

		

		

		}

	

/*	  $('#customCheckK').change(function () {

        if (!this.checked) {

           $('#aslvsK').hide();

		  $('#chkvalK').val("n");

	

		}else{ 

            $('#aslvsK').show ();

				  $('#chkvalK').val("y");

	

		}

	});*/

	

</script>

  <script type="text/javascript">

     

	 function cuntinc (incqty,prcid,totqty,cntinc){
	    prdid = prcid;
	   cnt = cntinc;
	  qty = parseInt( document.getElementById("txtqty"+prdid).value);
	  var count = qty;
				if(count >= totqty){

	       document.getElementById("qntydec"+cnt).disabled = true;

		}

		 if(count+1 <= totqty){

			   document.getElementById("txtqty"+prdid).value = count+1;

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

     document.getElementById("txtqty"+prdid).value = count - 1;

   }



	  }

	 }

    </script>

    <script>

   function latfrm() {

	//	alert("Heloo")

    document.getElementById('latrsbmt').onclick = function() {

        document.getElementById('latrfrm').submit();

        return false;

    };

};

    </script>

    <script>

	function funbDeletProd(){

		var delsts = confirm("Are you sure you want to delete this item?");

		if(delsts == true){

			return true;

			}

			else{

				var a = document.getElementById('proddel');

                 a.href = ""

				return false;

				}

		}

	</script>