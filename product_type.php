<?php
	        include_once 'includes/inc_nocache.php'; // Clearing the cache information
            include_once 'includes/inc_connection.php';//Make connection with the database  	
            include_once "includes/inc_config.php";	//path config file
		    include_once "includes/inc_usr_functions.php";//Including user session value
			include_once "includes/inc_folder_path.php";//Including user session value
			$vechtypenm=$_REQUEST['type'];
$page_title = "Ashoka Tyres | Car Tyres";
$page_seo_title = "Ashoka Tyres | Car Tyres";
$db_seokywrd = "";
$db_seodesc = "";
$current_page = "about-us";
$body_class = "about-us-page";
include('header.php');
?>

<div class="page-content bg-white">
    <!-- Banner  -->
    <div class="dlab-bnr-inr style-1 overlay-black-middle" style="background-image: url(images/banner/bnr1.jpg);">
        <div class="container">
            <div class="dlab-bnr-inr-entry">
                <h1 class="text-white"><?php echo $vechtypenm ?>  Tyres</h1>
                <div class="d-flex justify-content-center align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo $rtpth ?>">Home</a></li>
                          
                            <li class="breadcrumb-item active" aria-current="page"><?php echo ucwords($vechtypenm); ?>  Tyres</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->


    <section class="content-inner-2 py-5">
        <div class="container">
            <form class="searching-form tab-content bg-white">
            <input type="hidden" name="vechtye" id="vechtye" value="<?php echo ucwords($vechtypenm); ?>" />
                <div id="new-car" class="container tab-pane active clearfix">
                    <div class="row search-row">

                                      <div class="col-lg-2 col-md-6">
								<div class="form-group">
                                	<?php   $sqlprdcechbrnd_mst1="select  prodm_id, prodm_sku, prodm_code, prodm_name,
		             vehbrndm_id,vehbrndm_name
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
		and vehtypm_name='$vechtypenm'
		
		";
        	 $sqlprdcechbrnd_mst1 .=" group by vehbrndm_id  order by  vehbrndm_prty desc";
				$sqlprdcechbrnd_mst   = mysqli_query($conn,$sqlprdcechbrnd_mst1);


		$cntrec_prodvechbrnd   = mysqli_num_rows($sqlprdcechbrnd_mst);


  ?><label>Select Brand</label>
  <select class="form-control sm" id="getbrnd" name="getbrnd" onchange="funcfltvechbrnd()">
									
  
  <?php
    if($cntrec_prodvechbrnd > 0){?>
	 <option value="">Select</option>
	<?php
		  $cnt = 0;
		  mysqli_data_seek($sqlprdcechbrnd_mst,0);
		  while($srowsprodvechbrnd_mst=mysqli_fetch_assoc($sqlprdcechbrnd_mst)){ ?>
          
          <option data-select2-id="<?php echo $srowsprodvechbrnd_mst['vehbrndm_name'];?>" value="<?php echo $srowsprodvechbrnd_mst['vehbrndm_name']?>" ><?php echo $srowsprodvechbrnd_mst['vehbrndm_name']?></option>
									
									<?php } }?>
							
									</select>
								</div>
							</div>
							<div class="col-lg-2 col-md-6">
								<div class="form-group">
									<label>Select Model</label>
									<select class="form-control sm select2-hidden-accessible" data-selector="model profile" tabindex="-1"  aria-hidden="true" data-select2-id="51" id="getmold" name="getmold" onchange="funcfltvechmold()">
                                        <option value="">Select</option>
                           </select>
								</div>
							</div>

							<div class="col-lg-2 col-md-6">
								<div class="form-group">
									<label>Select Variant</label>
									<select class="form-control sm   select2-hidden-accessible" data-selector="variant rim" tabindex="-1"  aria-hidden="true" data-select2-id="74" id="getvarnt" name="getvarnt" onchange="funcfltvechvarnt()"><option value="">Select</option></select>
								</div>
							</div>



							<div class="col-lg-3 col-md-6">
								<div class="form-group">
									<button type="button" onclick="suBmitvechbrnd()"  id="suBvechbrnd" class="btn d-block w-100 btn-primary btn-md">Search</button>
								</div>
							</div>
                    </div>
                </div>
           
            </form>

        </div>


        <div class="container">
            <div class="car-brds">
                <h4><?php echo ucwords($vechtypenm) ?> Brands</h4>
                <div class="row">
                 <?php     $sqlvehbrnd_mst2="SELECT vehbrndm_vehtypm_id,vehbrndm_name,vehbrndm_id,
					  vehbrndm_brndimg, 
					vehbrndm_sts, vehbrndm_prty, 
					  prodm_id, prodm_sku, prodm_code, prodm_name,
		             tyrprflm_id,prodm_tyrrmsz,tyrrmszm_name
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
		vehvrntm_sts='a' and tyrprflm_sts='a' and tyrrmszm_sts='a' and tyrwdthm_sts='a' and tyrbrndm_sts='a' and    vehtypm_name= '$vechtypenm' group by vehbrndm_id order by vehbrndm_prty desc";

$rwsvehbrnd_mst2=mysqli_query($conn,$sqlvehbrnd_mst2);
 $carbrndcnt2=mysqli_num_rows($rwsvehbrnd_mst2);

while($rowsvehbrnd_mst2=mysqli_fetch_assoc($rwsvehbrnd_mst2)){

	$vehbrndimgnm=$rowsvehbrnd_mst2['vehbrndm_brndimg'];
	$vehbrndimgpth=$gvehbrndimg_usrpth.$vehbrndimgnm;
	if($vehbrndimgnm !='' && file_exists($vehbrndimgpth) ){
		$vehbrndimgpth=$rtpth.$gvehbrndimg_usrpth.$vehbrndimgnm;
		}else{
			$vehbrndimgpth="images/no-image.png";
			}
	$vehbrndname=$rowsvehbrnd_mst2['vehbrndm_name'];
	$vehbrndid =$rowsvehbrnd_mst2['vehbrndm_id'];
	$sr_vehbrndname=funcStrRplc($vehbrndname);
	
	$sr_vchtype=funcStrRplc($vechtypenm);
?>
	
                    <div class="col-lg-2">
                        <div class="cr-b">
                            <a href="<?php echo $rtpth ; ?>products.php?type=<?php echo $sr_vchtype?>&vehbrnd=<?php echo $vehbrndname ?>"><img src="<?php echo $vehbrndimgpth ?>" class="w-100" alt=""></a>
                        </div>
                    </div>
                    <?php } ?>
                   
                </div>
            </div>
        </div>

        <div class="container">
        <br>
        <hr>
        <br>
        </div>
        
          <div class="container">
            <div class="car-brds">
                <h4><?php echo ucwords($vechtypenm) ?> Tyre Brands</h4>
                <div class="row">
                 <?php     $sqlvehbrnd_mst2="SELECT vehbrndm_vehtypm_id,tyrbrndm_id,tyrbrndm_name,
					  tyrbrndm_brndimg, 
					vehbrndm_sts, vehbrndm_prty, 
					  prodm_id, prodm_sku, prodm_code, prodm_name,
		             tyrprflm_id,prodm_tyrrmsz,tyrrmszm_name
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
		vehvrntm_sts='a' and tyrprflm_sts='a' and tyrrmszm_sts='a' and tyrwdthm_sts='a' and tyrbrndm_sts='a' and    vehtypm_name= '$vechtypenm' group by tyrbrndm_id order by tyrbrndm_prty desc";

$rwsvehbrnd_mst2=mysqli_query($conn,$sqlvehbrnd_mst2);
 $carbrndcnt2=mysqli_num_rows($rwsvehbrnd_mst2);

while($rowsvehbrnd_mst2=mysqli_fetch_assoc($rwsvehbrnd_mst2)){

	$vehbrndimgnm=$rowsvehbrnd_mst2['tyrbrndm_brndimg'];
	$vehbrndimgpth=$gtyrbrndimg_usrpth.$vehbrndimgnm;
	if($vehbrndimgnm !='' && file_exists($vehbrndimgpth) ){
		$vehbrndimgpth=$rtpth.$gtyrbrndimg_usrpth.$vehbrndimgnm;
		}else{
			$vehbrndimgpth="images/no-image.png";
			}
	$vehbrndname=$rowsvehbrnd_mst2['tyrbrndm_name'];
	$vehbrndid =$rowsvehbrnd_mst2['tyrbrndm_id'];
	$sr_vehbrndname=funcStrRplc($vehbrndname);
	$sr_vchtype=funcStrRplc($vechtypenm);
	?>
                    <div class="col-lg-2">
                        <div class="cr-b">
                            <a href="<?php echo $rtpth ?>products.php?type=<?php echo $sr_vchtype?>&tyrbrnd=<?php echo $vehbrndname ?>"><img src="<?php echo $vehbrndimgpth ?>" class="w-100" alt=""></a>
                        </div>
                    </div>
                    <?php } ?>
                   
                </div>
            </div>
        </div>

        


    </section>




</div>
<script>
 function funcfltvechbrnd()
  {
	//alert(typeof (vechtype))
  	//debugger;
		var vehtypnm=$('#vechtye').val();
  	var vechbrnd = $('#getbrnd').val();
 // alert(vehtypnm);
  	$.ajax({
  		type: "POST",
  		url: "prdserchflt.php",
  		data:'vechtypnm1='+vehtypnm+'&vechbrnd='+vechbrnd,
  		success: function(data){
			//debugger;
  		// alert(data);
  			$("#getmold").html(data);
			
			$('#getvarnt').empty().append('<option  value="">Select</option>');
			
  		}
  	});
  }
  
      function funcfltvechmold()
  {
	var vehtypnm=$('#vechtye').val();
  	var vechbrnd = $('#getbrnd').val();
		var vechmodle = $('#getmold').val();
 // alert(vehtypnm);
  	$.ajax({
  		type: "POST",
  		url: "prdserchflt.php",
  		data:'vechtypnm2='+vehtypnm+'&vechbrnd='+vechbrnd+'&vechmodle='+vechmodle,
  		success: function(data){
			//debugger;
  		 //alert(data);
  			$("#getvarnt").html(data);
			
  		}
  	});
  }
       function funcfltvechvarnt(){
		   
		   $("#suBvechbrnd").removeAttr('disabled');	
	  
	  }
	  
	
	  
function suBmitvechbrnd(){
	var serurl="";
	var vehtypnm=$('#vechtye').val();
  	var serchvechbrnd = $('#getbrnd').val();
		var serchvechmodle = $('#getmold').val();
		var serchvechvarnt = $('#getvarnt').val();
		//alert(vehtypnm);
		if(vehtypnm !=''){
			if(serurl !=''){
		serurl +="&type="+vehtypnm;
		}else{
			serurl +="type="+vehtypnm;
			}
		}
		
		if(serchvechbrnd !=''){
			if(serurl !=''){
		serurl +="&vehbrnd="+serchvechbrnd;}else{
			serurl +="vehbrnd="+serchvechbrnd;
			}
		}
			if(serchvechmodle !=''){
			if(serurl !=''){
		serurl +="&vehmodel="+serchvechmodle;}else{
			serurl +="vehmodel="+serchvechmodle;
			}
		}
			if(serchvechvarnt !=''){
			if(serurl !=''){
		serurl +="&vehvarent="+serchvechvarnt;}else{
			serurl +="vehvarent="+serchvechvarnt;
			}
		
		}
		if(serchvechvarnt !='' && serchvechmodle !='' && serchvechbrnd !='' && vehtypnm !='' ){
			location.href="<?php echo $rtpth ?>products.php?"+serurl;}else{
				document.getElementById('suBvechbrnd').disabled=true;
				
				}
	}
	</script>
<!----------------------->
  <script>
 function funcfltvechbrnd()
  {

		
		var vehtypnm=$('#vechtye').val();
  	var vechbrnd = $('#getbrnd').val();
 // alert(vehtypnm);
  	$.ajax({
  		type: "POST",
  		url: "prdserchflt.php",
  		data:'vechtypnm1='+vehtypnm+'&vechbrnd='+vechbrnd,
  		success: function(data){
			//debugger;
  		// alert(data);
  			$("#getmold").html(data);
			
			$('#getvarnt').empty().append('<option  value="">Select</option>');
			
  		}
  	});
  }
  
      function funcfltvechmold()
  {
	//alert(typeof (vechtype))
  //	debugger;
			var vehtypnm=$('#vechtye').val();
  	var vechbrnd = $('#getbrnd').val();
		var vechmodle = $('#getmold').val();
 // alert(vehtypnm);
  	$.ajax({
  		type: "POST",
  		url: "prdserchflt.php",
  		data:'vechtypnm2='+vehtypnm+'&vechbrnd='+vechbrnd+'&vechmodle='+vechmodle,
  		success: function(data){
			//debugger;
  		 //alert(data);
  			$("#getvarnt").html(data);
			
  		}
  	});
  }
       function funcfltvechvarnt(){
		   
		   $("#suBvechbrnd").removeAttr('disabled');	
	  
	  }
	  </script>










<?php include_once('footer.php'); ?>