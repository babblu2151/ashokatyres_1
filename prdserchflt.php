<?php 
error_reporting(0);
include_once 'includes/inc_nocache.php'; // Clearing the cache information
            include_once 'includes/inc_connection.php';//Make connection with the database  	
            include_once "includes/inc_config.php";	//path config file
		    include_once "includes/inc_usr_functions.php";//Including user session value
			include_once "includes/inc_folder_path.php";//Including user session value
			/***********************************************************/
		
			if(isset($_REQUEST['vechtypnm2']) && (trim($_REQUEST['vechtypnm2']) != "") && isset($_REQUEST['vechbrnd']) && (trim($_REQUEST['vechbrnd']) != "") &&
			isset($_REQUEST['vechmodle']) && (trim($_REQUEST['vechmodle']) != "")  )
{
	
	
	$vechbrndnm=trim($_REQUEST['vechbrnd']);
	$vechtypenm=trim($_REQUEST['vechtypnm2']);
	$vechmodle=trim($_REQUEST['vechmodle']);
	
	  $sqlprdcechbrnd_mst1="select  prodm_id, prodm_sku, prodm_code, prodm_name,
		             vehvrntm_id,vehvrntm_name
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
		and vehtypm_name='$vechtypenm' and vehbrndm_name ='$vechbrndnm' and vehmodlm_name='$vechmodle'
		
		";
        	 $sqlprdcechbrnd_mst1 .=" group by vehvrntm_id  order by  vehvrntm_prty desc";
				$sqlprdcechbrnd_mst   = mysqli_query($conn,$sqlprdcechbrnd_mst1);


		$cntrec_prodvechbrnd   = mysqli_num_rows($sqlprdcechbrnd_mst);

  if($cntrec_prodvechbrnd > 0){
		  $cnt = 0;
		  mysqli_data_seek($sqlprdcechbrnd_mst,0);
   $vechbrn .= "<option value='' data-select2-id=''> --Select Variant--</option>";
		  while($srowsprodvechbrnd_mst=mysqli_fetch_assoc($sqlprdcechbrnd_mst)){ 
          $vechbrn .= "<option value='$srowsprodvechbrnd_mst[vehvrntm_name]' data-select2-id='$srowsprodvechbrnd_mst[vehvrntm_name]'> $srowsprodvechbrnd_mst[vehvrntm_name]</option>";
                                       }}

echo $vechbrn;
}
			/******************************************************/
if(isset($_REQUEST['vechtypnm1']) && (trim($_REQUEST['vechtypnm1']) != "") && isset($_REQUEST['vechbrnd']) && (trim($_REQUEST['vechbrnd']) != "") )
{
	
	
	$vechbrndnm=trim($_REQUEST['vechbrnd']);
	$vechtypenm=trim($_REQUEST['vechtypnm1']);
	  $sqlprdcechbrnd_mst1="select  prodm_id, prodm_sku, prodm_code, prodm_name,
		             vehmodlm_id,vehmodlm_name
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
		and vehtypm_name='$vechtypenm' and vehbrndm_name ='$vechbrndnm'
		
		";
        	 $sqlprdcechbrnd_mst1 .=" group by vehmodlm_id  order by  vehmodlm_prty desc";
				$sqlprdcechbrnd_mst   = mysqli_query($conn,$sqlprdcechbrnd_mst1);


		$cntrec_prodvechbrnd   = mysqli_num_rows($sqlprdcechbrnd_mst);

  if($cntrec_prodvechbrnd > 0){
		  $cnt = 0;
		  mysqli_data_seek($sqlprdcechbrnd_mst,0);
   $vechbrn .= "<option value='' data-select2-id=''> --Select Model-- </option>";
		  while($srowsprodvechbrnd_mst=mysqli_fetch_assoc($sqlprdcechbrnd_mst)){ 
          $vechbrn .= "<option value='$srowsprodvechbrnd_mst[vehmodlm_name]' data-select2-id='$srowsprodvechbrnd_mst[vehmodlm_name]'> $srowsprodvechbrnd_mst[vehmodlm_name]</option>";
                                       }}

echo $vechbrn;
}
if(isset($_REQUEST['vechtypnm']) && (trim($_REQUEST['vechtypnm']) != "") )
{
	$vechtypenm=trim($_REQUEST['vechtypnm']);
	  $sqlprdcechbrnd_mst1="select  prodm_id, prodm_sku, prodm_code, prodm_name,
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

  if($cntrec_prodvechbrnd > 0){
		  $cnt = 0;
		  mysqli_data_seek($sqlprdcechbrnd_mst,0);
   $vechbrn .= "<option value='' data-select2-id=''> Select Brand</option>";
		  while($srowsprodvechbrnd_mst=mysqli_fetch_assoc($sqlprdcechbrnd_mst)){ 
          $vechbrn .= "<option value='$srowsprodvechbrnd_mst[vehbrndm_name]' data-select2-id='$srowsprodvechbrnd_mst[vehbrndm_name]'> $srowsprodvechbrnd_mst[vehbrndm_name]</option>";
                                       }}

echo $vechbrn;
}


/************************************** tyre width**********************************/


if(isset($_REQUEST['vechtyrtypnm']) && (trim($_REQUEST['vechtyrtypnm']) != "") )
{
	  $vechtyrtypnm=trim($_REQUEST['vechtyrtypnm']);
	    $sqlprdtypewdth_mst1="select  prodm_id, prodm_sku, prodm_code, prodm_name,
		             tyrwdthm_id,prodm_tyrwdth,tyrwdthm_name
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
		and vehtypm_name='$vechtyrtypnm' group by tyrwdthm_id  order by  tyrwdthm_prty desc
		
		";
        	 
				$sqlprdtypewdth_mst   = mysqli_query($conn,$sqlprdtypewdth_mst1);


		  $cntrec_vechtypwdth   = mysqli_num_rows($sqlprdtypewdth_mst);
$vechtypwdth="";
  if($cntrec_vechtypwdth > 0){
		  $cnt = 0;
		  mysqli_data_seek($sqlprdtypewdth_mst,0);
   $vechtypwdth.= "<option value='' data-select2-id=''> Select Width</option>";
		  while($srowsprodtypewdth_mst=mysqli_fetch_assoc($sqlprdtypewdth_mst)){ 
          $vechtypwdth .= "<option value='$srowsprodtypewdth_mst[tyrwdthm_name]' data-select2-id='$srowsprodtypewdth_mst[tyrwdthm_name]'> $srowsprodtypewdth_mst[tyrwdthm_name]</option>";
                                       }
									  }

echo $vechtypwdth;
}




if((isset($_REQUEST['vechtyrtypnm1']) && (trim($_REQUEST['vechtyrtypnm1']) != ""))&&
(isset($_REQUEST['tyrewidth']) && (trim($_REQUEST['tyrewidth']) != ""))){
	
	  $vechtyrtypnm=trim($_REQUEST['vechtyrtypnm1']);
	   $tyrewidth=trim($_REQUEST['tyrewidth']);
	     $sqlprdtypeprofle_mst1="select  prodm_id, prodm_sku, prodm_code, prodm_name,
		             tyrprflm_id,prodm_tyrprfl,tyrprflm_name
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
		and vehtypm_name='$vechtyrtypnm' and tyrwdthm_name='$tyrewidth' group by tyrprflm_id  order by  tyrprflm_prty desc
		
		";
        	 
				$sqlprdtypeprofle_mst   = mysqli_query($conn,$sqlprdtypeprofle_mst1);


		  $cntrec_vechtypprofle   = mysqli_num_rows($sqlprdtypeprofle_mst);
$vechtypprofle="";
  if($cntrec_vechtypprofle  > 0){
		  $cnt = 0;
		  mysqli_data_seek($sqlprdtypeprofle_mst,0);
   $vechtypprofle.= "<option value='' data-select2-id=''> Select Profile</option>";
		  while($srowsprodtypeprofle_mst=mysqli_fetch_assoc($sqlprdtypeprofle_mst)){ 
          $vechtypprofle .= "<option value='$srowsprodtypeprofle_mst[tyrprflm_name]' data-select2-id='$srowsprodtypeprofle_mst[tyrprflm_name]'> $srowsprodtypeprofle_mst[tyrprflm_name]</option>";
                                       }
									  }

echo $vechtypprofle;
}




if((isset($_REQUEST['vechtyrtypnm2']) && (trim($_REQUEST['vechtyrtypnm2']) != ""))&&
(isset($_REQUEST['tyrewidth1']) && (trim($_REQUEST['tyrewidth1']) != ""))&&
(isset($_REQUEST['tyreprfile']) && (trim($_REQUEST['tyreprfile']) != ""))){
	
	  $vechtyrtypnm=trim($_REQUEST['vechtyrtypnm2']);
	   $tyrewidth=trim($_REQUEST['tyrewidth1']);
	      $tyreprfile=trim($_REQUEST['tyreprfile']);
	   
	     $sqlprdtypeprofle_mst1="select  prodm_id, prodm_sku, prodm_code, prodm_name,
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
		vehvrntm_sts='a' and tyrprflm_sts='a' and tyrrmszm_sts='a' and tyrwdthm_sts='a' and tyrbrndm_sts='a'
		and vehtypm_name='$vechtyrtypnm' and tyrwdthm_name='$tyrewidth' and tyrprflm_name='$tyreprfile' group by tyrprflm_id  order by  tyrprflm_prty desc
		
		";
        	 
				$sqlprdtypeprofle_mst   = mysqli_query($conn,$sqlprdtypeprofle_mst1);


		  $cntrec_vechtypprofle   = mysqli_num_rows($sqlprdtypeprofle_mst);
$vechtypprofle="";
  if($cntrec_vechtypprofle  > 0){
		  $cnt = 0;
		  mysqli_data_seek($sqlprdtypeprofle_mst,0);
   $vechtypprofle.= "<option value='' data-select2-id=''> Select Rim</option>";
		  while($srowsprodtypeprofle_mst=mysqli_fetch_assoc($sqlprdtypeprofle_mst)){ 
          $vechtypprofle .= "<option value='$srowsprodtypeprofle_mst[tyrrmszm_name]' data-select2-id='$srowsprodtypeprofle_mst[prodm_tyrrmsz]'> $srowsprodtypeprofle_mst[tyrrmszm_name]</option>";
                                       }
									  }

echo $vechtypprofle;
}










?>