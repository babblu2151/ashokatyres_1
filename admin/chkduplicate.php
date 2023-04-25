<?php
//include_once "../includes/inc_adm_session.php"; //checking for session
include_once "../includes/inc_connection.php"; //Making database Connection
include_once "../includes/inc_usr_functions.php"; //Use function for validation and more

/***************************************************************
Programm : chkduplicate.php
Company : Adroit
************************************************************/
// ------------------------ To check duplcate vehicle type---------------
if(isset($_REQUEST['vehtypnm']) && (trim($_REQUEST['vehtypnm']) != ""))
{
	$name = glb_func_chkvl($_REQUEST['vehtypnm']);
	$sqryvehtyp_mst = "SELECT vehtypm_name from veh_type_mst where vehtypm_name='$name'";
	if(isset($_REQUEST['vehtypid']) && ($_REQUEST['vehtypid']!= ""))
	{
		$id =glb_func_chkvl($_REQUEST['vehtypid']);
      $sqryvehtyp_mst .= " and vehtypm_id!=$id";
	}
	$srsvehtyp_mst = mysqli_query($conn,$sqryvehtyp_mst);
	$cnt = mysqli_num_rows($srsvehtyp_mst);
	if($cnt > 0)
	{
		echo "<font color=red><strong>Duplicate Name</strong></font>";
	}
}
// ------------------- end duplicate vehicle type -------------------------
// ------------------------ To check duplcate vehicle Brand---------------
if(isset($_REQUEST['vehbrndname']) && (trim($_REQUEST['vehbrndname']) != "") && isset($_REQUEST['vehtypid']) && (trim($_REQUEST['vehtypid']) != ""))
{
	$name = glb_func_chkvl($_REQUEST['vehbrndname']);
	$vehtypid = glb_func_chkvl($_REQUEST['vehtypid']);
	$sqryvehbrndmst = "SELECT vehbrndm_name from veh_brnd_mst where vehbrndm_vehtypm_id = '$vehtypid' and vehbrndm_name = '$name'";
   if(isset($_REQUEST['brndid']) && ($_REQUEST['brndid']!= ""))
   {
      $id = glb_func_chkvl($_REQUEST['brndid']);
      $sqryvehbrndmst .= " and vehbrndm_id != $id";
   }
   // echo $sqryvehbrndmst;exit;
   $srsvehbrnd_mst = mysqli_query($conn,$sqryvehbrndmst);
   $cnt = mysqli_num_rows($srsvehbrnd_mst);
   if($cnt > 0)
   {
      echo "<font color=red><strong>Duplicate Combination Of Type & Name</strong></font>";
   }
}
// ------------------- end duplicate vehicle Brand ------------------------
// ------------------------ To check duplcate vehicle model---------------
if(isset($_REQUEST['vehmdlname']) && (trim($_REQUEST['vehmdlname']) != "") && isset($_REQUEST['vehtypid']) && (trim($_REQUEST['vehtypid']) != "") && isset($_REQUEST['vehbrndid']) && (trim($_REQUEST['vehbrndid']) != ""))
{
   $name = glb_func_chkvl($_REQUEST['vehmdlname']);
   $vehtypid = glb_func_chkvl($_REQUEST['vehtypid']);
   $vehbrndid = glb_func_chkvl($_REQUEST['vehbrndid']);
   $sqryvehmdlmst = "SELECT vehmodlm_name from veh_model_mst where vehmodlm_vehtypm_id = '$vehtypid' and vehmodlm_vehbrndm_id = '$vehbrndid' and vehmodlm_name = '$name'";
   if(isset($_REQUEST['mdlid']) && ($_REQUEST['mdlid']!= ""))
   {
      $id = glb_func_chkvl($_REQUEST['mdlid']);
      $sqryvehmdlmst .= " and vehmodlm_id != $id";
   }
   // echo $sqryvehmdlmst;exit;
   $srsvehbrnd_mst = mysqli_query($conn,$sqryvehmdlmst);
   $cnt = mysqli_num_rows($srsvehbrnd_mst);
   if($cnt > 0)
   {
      echo "<font color=red><strong>Duplicate Combination Of Type & Name</strong></font>";
   }
}
// ------------------- end duplicate vehicle model ------------------------
// ------------------------ To check duplcate vehicle variant---------------
if(isset($_REQUEST['vehvrntname']) && (trim($_REQUEST['vehvrntname']) != "") && isset($_REQUEST['vehtypid']) && (trim($_REQUEST['vehtypid']) != "") && isset($_REQUEST['vehbrndid']) && (trim($_REQUEST['vehbrndid']) != "") && isset($_REQUEST['vehmdlid']) && (trim($_REQUEST['vehmdlid']) != ""))
{
   $name = glb_func_chkvl($_REQUEST['vehvrntname']);
   $vehtypid = glb_func_chkvl($_REQUEST['vehtypid']);
   $vehbrndid = glb_func_chkvl($_REQUEST['vehbrndid']);
   $vehmdlid = glb_func_chkvl($_REQUEST['vehmdlid']);
   $sqryvehvrntmst = "SELECT vehvrntm_name from veh_vrnt_mst where vehvrntm_vehtypm_id = '$vehtypid' and vehvrntm_vehbrndm_id = '$vehbrndid' and vehvrntm_vehmdlm_id = '$vehmdlid' and vehvrntm_name = '$name'";
   if(isset($_REQUEST['vrntid']) && ($_REQUEST['vrntid']!= ""))
   {
      $id = glb_func_chkvl($_REQUEST['vrntid']);
      $sqryvehvrntmst .= " and vehvrntm_id != $id";
   }
   // echo $sqryvehvrntmst;exit;
   $srsvehvrnt_mst = mysqli_query($conn,$sqryvehvrntmst);
   $cnt = mysqli_num_rows($srsvehvrnt_mst);
   if($cnt > 0)
   {
      echo "<font color=red><strong>Duplicate Combination Of Type & Name</strong></font>";
   }
}
// ------------------- end duplicate vehicle variant ------------------------
// ------------------------ To check duplcate tyre brand---------------
if(isset($_REQUEST['tyrbrndname']) && (trim($_REQUEST['tyrbrndname']) != ""))
{
   $name = glb_func_chkvl($_REQUEST['tyrbrndname']);
   $sqrytyrtyp_mst = "SELECT tyrbrndm_name from tyr_brnd_mst where tyrbrndm_name='$name'";
   if(isset($_REQUEST['tyrbrndm_id']) && ($_REQUEST['tyrbrndm_id']!= ""))
   {
      $id =glb_func_chkvl($_REQUEST['tyrbrndm_id']);
      $sqrytyrtyp_mst .= " and tyrbrndm_id != $id";
   }      
   $srstyrtyp_mst = mysqli_query($conn,$sqrytyrtyp_mst);
   $cnt = mysqli_num_rows($srstyrtyp_mst);
   if($cnt > 0)
   {
      echo "<font color=red><strong>Duplicate Name</strong></font>";
   }
}
// ------------------- end duplicate tyre brand -------------------------
// ------------------------ To check duplcate Tyre Width---------------
if(isset($_REQUEST['tyrwdthname']) && (trim($_REQUEST['tyrwdthname']) != "") && isset($_REQUEST['vehtypid']) && (trim($_REQUEST['vehtypid']) != ""))
{
  $name = glb_func_chkvl($_REQUEST['tyrwdthname']);
  $vehtypid = glb_func_chkvl($_REQUEST['vehtypid']);
  $sqrytyrwdthmst = "SELECT tyrwdthm_name from tyr_wdth_mst where tyrwdthm_vehtypm_id = '$vehtypid' and tyrwdthm_name = '$name'";
  if(isset($_REQUEST['tyrwdthid']) && ($_REQUEST['tyrwdthid']!= ""))
  {
    $id = glb_func_chkvl($_REQUEST['tyrwdthid']);
    $sqrytyrwdthmst .= " and tyrwdthm_id != $id";
  }
  // echo $sqrytyrwdthmst;exit;
  $srstyrwdth_mst = mysqli_query($conn,$sqrytyrwdthmst);
  $cnt = mysqli_num_rows($srstyrwdth_mst);
  if($cnt > 0)
  {
    echo "<font color=red><strong>Duplicate Combination Of Type & Name</strong></font>";
  }
}
// ------------------- end duplicate tyre width ------------------------
// ------------------------ To check duplcate tyre profile---------------
if(isset($_REQUEST['tyrprflname']) && (trim($_REQUEST['tyrprflname']) != "") && isset($_REQUEST['vehtypid']) && (trim($_REQUEST['vehtypid']) != "") && isset($_REQUEST['tyrwdthid']) && (trim($_REQUEST['tyrwdthid']) != ""))
{
  $name = glb_func_chkvl($_REQUEST['tyrprflname']);
  $vehtypid = glb_func_chkvl($_REQUEST['vehtypid']);
  $tyrwdthid = glb_func_chkvl($_REQUEST['tyrwdthid']);
  $sqrytyrprflmst = "SELECT tyrprflm_name from tyr_prfl_mst where tyrprflm_vehtypm_id = '$vehtypid' and tyrprflm_tyrwdthm_id = '$tyrwdthid' and tyrprflm_name = '$name'";
  if(isset($_REQUEST['tyrpfrlid']) && ($_REQUEST['tyrpfrlid']!= ""))
  {
    $id = glb_func_chkvl($_REQUEST['tyrpfrlid']);
    $sqrytyrprflmst .= " and tyrprflm_id != $id";
  }
  // echo $sqrytyrprflmst;exit;
  $srstyrprfl_mst = mysqli_query($conn,$sqrytyrprflmst);
  $cnt = mysqli_num_rows($srstyrprfl_mst);
  if($cnt > 0)
  {
    echo "<font color=red><strong>Duplicate Combination Of Type & Name</strong></font>";
  }
}
// ------------------- end duplicate tyre profile ------------------------
// ------------------------ To check duplcate Tyre rim size---------------
if(isset($_REQUEST['vehvrntname']) && (trim($_REQUEST['vehvrntname']) != "") && isset($_REQUEST['vehtypid']) && (trim($_REQUEST['vehtypid']) != "") && isset($_REQUEST['tyrwdthid']) && (trim($_REQUEST['tyrwdthid']) != "") && isset($_REQUEST['tyrprflid']) && (trim($_REQUEST['tyrprflid']) != ""))
{
   $name = glb_func_chkvl($_REQUEST['vehvrntname']);
   $vehtypid = glb_func_chkvl($_REQUEST['vehtypid']);
   $tyrwdthid = glb_func_chkvl($_REQUEST['tyrwdthid']);
   $tyrprflid = glb_func_chkvl($_REQUEST['tyrprflid']);
   $sqrytyrrmsz_mst = "SELECT tyrrmszm_name from tyr_rimsize_mst where tyrrmszm_vehtypm_id = '$vehtypid' and tyrrmszm_tyrwdthm_id = '$tyrwdthid' and tyrrmszm_tyrprflm_id = '$tyrprflid' and tyrrmszm_name = '$name'";
   if(isset($_REQUEST['tyrrmszid']) && ($_REQUEST['tyrrmszid']!= ""))
   {
      $id = glb_func_chkvl($_REQUEST['tyrrmszid']);
      $sqrytyrrmsz_mst .= " and tyrrmszm_id != $id";
   }
   // echo $sqrytyrrmsz_mst;exit;
   $srstyrrmsz_mst = mysqli_query($conn,$sqrytyrrmsz_mst);
   $cnt = mysqli_num_rows($srstyrrmsz_mst);
   if($cnt > 0)
   {
      echo "<font color=red><strong>Duplicate Combination Of Type & Name</strong></font>";
   }
}
// ------------------- end duplicate Tyre rim size ------------------------
// ------------------------ To check duplcate Tyre type name---------------
if(isset($_REQUEST['tyrtypnm']) && (trim($_REQUEST['tyrtypnm']) != ""))
{
  $name = glb_func_chkvl($_REQUEST['tyrtypnm']);
  $sqrytyrtyp_mst = "SELECT tyrtypm_name from tyr_type_mst where tyrtypm_name='$name'";
  if(isset($_REQUEST['tyrtyp']) && ($_REQUEST['tyrtyp']!= ""))
  {
    $id =glb_func_chkvl($_REQUEST['tyrtyp']);
    $sqrytyrtyp_mst .= " and tyrtypm_id!=$id";
  }      
  $srstyrtyp_mst = mysqli_query($conn,$sqrytyrtyp_mst);
  $cnt = mysqli_num_rows($srstyrtyp_mst);
  if($cnt > 0)
  {
    echo "<font color=red><strong>Duplicate Name</strong></font>";
  }
}
// ------------------- end duplicate Tyre type name-------------------------
// ------------------------ To check duplcate Tyre type code---------------
if(isset($_REQUEST['tyrtypcde']) && (trim($_REQUEST['tyrtypcde']) != ""))
{
  $code = glb_func_chkvl($_REQUEST['tyrtypcde']);
  $sqrytyrtyp_mst = "SELECT tyrtypm_cde from tyr_type_mst where tyrtypm_cde='$code'";
  if(isset($_REQUEST['tyrtyp']) && ($_REQUEST['tyrtyp']!= ""))
  {
    $id =glb_func_chkvl($_REQUEST['tyrtyp']);
    $sqrytyrtyp_mst .= " and tyrtypm_id!=$id";
  }      
  $srstyrtyp_mst = mysqli_query($conn,$sqrytyrtyp_mst);
  $cnt = mysqli_num_rows($srstyrtyp_mst);
  if($cnt > 0)
  {
    echo "<font color=red><strong>Duplicate Name</strong></font>";
  }
}
// ------------------- end duplicate Tyre type code-------------------------
// ------------------------ To check duplcate Store Location---------------
if(isset($_REQUEST['strlocnm']) && (trim($_REQUEST['strlocnm']) != ""))
{
   $name = glb_func_chkvl($_REQUEST['strlocnm']);
   $sqrystrloc_mst = "SELECT strlocm_name from store_loc_mst where strlocm_name='$name'";
   if(isset($_REQUEST['strlocid']) && ($_REQUEST['strlocid']!= ""))
   {
      $id =glb_func_chkvl($_REQUEST['strlocid']);
    $sqrystrloc_mst .= " and strlocm_id!=$id";
   }      
   $srsstrloc_mst = mysqli_query($conn,$sqrystrloc_mst);
   $cnt = mysqli_num_rows($srsstrloc_mst);
   if($cnt > 0)
   {
      echo "<font color=red><strong>Duplicate Name</strong></font>";
   }
}
// ------------------- end duplicate Store Location -------------------------
// ------------------------ To check duplcate location user---------------
if(isset($_REQUEST['username']) && (trim($_REQUEST['username']) != "") && isset($_REQUEST['strlocid']) && (trim($_REQUEST['strlocid']) != ""))
{
   $name = glb_func_chkvl($_REQUEST['username']);
   $strlocid = glb_func_chkvl($_REQUEST['strlocid']);
   $sqrylocusrmst = "SELECT lgnm_uid from lgn_mst where lgnm_store_id = '$strlocid' and lgnm_uid = '$name'";
   if(isset($_REQUEST['locusrid']) && ($_REQUEST['locusrid']!= ""))
   {
      $id = glb_func_chkvl($_REQUEST['locusrid']);
      $sqrylocusrmst .= " and lgnm_id != $id";
   }
   // echo $sqrylocusrmst;exit;
   $srslocusr_mst = mysqli_query($conn,$sqrylocusrmst);
   $cnt = mysqli_num_rows($srslocusr_mst);
   if($cnt > 0)
   {
      echo "<font color=red><strong>Duplicate Combination Of Type & Name</strong></font>";
   }
}
// ------------------- end duplicate location user ------------------------
// ------------------------ To check duplcate product sku---------------
if(isset($_REQUEST['prodsku']) && (trim($_REQUEST['prodsku']) != ""))
{
  $name = glb_func_chkvl($_REQUEST['prodsku']);
  $sqryprod_mst = "SELECT prodm_sku from prod_mst where prodm_sku='$name'";
  if(isset($_REQUEST['prodid']) && ($_REQUEST['prodid']!= ""))
  {
    $id =glb_func_chkvl($_REQUEST['prodid']);
    $sqryprod_mst .= " and prodm_id!=$id";
  }      
  $srsprod_mst = mysqli_query($conn,$sqryprod_mst);
  $cnt = mysqli_num_rows($srsprod_mst);
  if($cnt > 0)
  {
    echo "<font color=red><strong>Duplicate SKU</strong></font>";
  }
}
// ------------------- end duplicate product sku -------------------------
// ------------------------ To check duplcate product code---------------
if(isset($_REQUEST['prodcode']) && (trim($_REQUEST['prodcode']) != ""))
{
  $name = glb_func_chkvl($_REQUEST['prodcode']);
  $sqryprod_mst = "SELECT prodm_code from prod_mst where prodm_code='$name'";
  if(isset($_REQUEST['prodid']) && ($_REQUEST['prodid']!= ""))
  {
    $id =glb_func_chkvl($_REQUEST['prodid']);
    $sqryprod_mst .= " and prodm_id!=$id";
  }  
  // echo $sqryprod_mst; exit;    
  $srsprod_mst = mysqli_query($conn,$sqryprod_mst);
  $cnt = mysqli_num_rows($srsprod_mst);
  if($cnt > 0)
  {
    echo "<font color=red><strong>Duplicate Code</strong></font>";
  }
}
// ------------------- end duplicate product code -------------------------
// ------------------------ To check duplcate banner name---------------
if(isset($_REQUEST['bnrnm']) && (trim($_REQUEST['bnrnm']) != ""))
{
   $name = glb_func_chkvl($_REQUEST['bnrnm']);
   $sqrybnr_mst = "SELECT bnrm_name from bnr_mst where bnrm_name='$name'";
   if(isset($_REQUEST['bnrid']) && ($_REQUEST['bnrid']!= ""))
   {
      $id =glb_func_chkvl($_REQUEST['bnrid']);
    $sqrybnr_mst .= " and bnrm_id!=$id";
   }      
   $srsbnr_mst = mysqli_query($conn,$sqrybnr_mst);
   $cnt = mysqli_num_rows($srsbnr_mst);
   if($cnt > 0)
   {
      echo "<font color=red><strong>Duplicate Name</strong></font>";
   }
}
// ------------------- end duplicate banner name -------------------------


// ------------------------ To check duplcate product features name---------------
if(isset($_REQUEST['profetr']) && (trim($_REQUEST['profetr']) != ""))
{
   $name = glb_func_chkvl($_REQUEST['profetr']);
   $sqrybnr_mst = "SELECT prodfetrm_name from prodfetr_mst where prodfetrm_name='$name'";
   if(isset($_REQUEST['prodfetrmid']) && ($_REQUEST['prodfetrmid']!= ""))
   {
      $id =glb_func_chkvl($_REQUEST['prodfetrmid']);
    $sqrybnr_mst .= " and prodfetrm_id!=$id";
   }      
   $srsbnr_mst = mysqli_query($conn,$sqrybnr_mst);
   $cnt = mysqli_num_rows($srsbnr_mst);
   if($cnt > 0)
   {
      echo "<font color=red><strong>Duplicate Name</strong></font>";
   }
}
// ------------------- end duplicate product features name -------------------------














  if(isset($_REQUEST['prodscatname']) && (trim($_REQUEST['prodscatname']) != "") &&
     isset($_REQUEST['prodcatid']) && (trim($_REQUEST['prodcatid']) != "")){
     
   $name = glb_func_chkvl($_REQUEST['prodscatname']);
   $prodcat     = glb_func_chkvl($_REQUEST['prodcatid']);
     
   $sqryprodscat_mst = "select prodscatm_name
    from 
     prodscat_mst
    where 
  prodscatm_prodcatm_id='$prodcat' and          
     prodscatm_name='$name'";
   if(isset($_REQUEST['subdid']) && ($_REQUEST['subdid']!= "")){
   
    $id =glb_func_chkvl($_REQUEST['subdid']);
    $sqryprodscat_mst .= " and prodscatm_id!=$id";
   }      
          
   $srsprodscat_mst = mysqli_query($conn,$sqryprodscat_mst);
   $cnt = mysqli_num_rows($srsprodscat_mst);
   if($cnt > 0){
   
    echo "<font color=red><strong>Duplicate Combination Of Category&Name</strong></font>";
   }     
  } 
  
     if(isset($_REQUEST['prodcatname']) && (trim($_REQUEST['prodcatname']) != "")){
   $name = glb_func_chkvl($_REQUEST['prodcatname']);
     
   $sqryprodcat_mst = "select prodcatm_name
    from 
     prodcat_mst
    where 
     prodcatm_name='$name'";
   if(isset($_REQUEST['prodid']) && ($_REQUEST['prodid']!= "")){
   
    $id =glb_func_chkvl($_REQUEST['prodid']);
    $sqryprodcat_mst .= " and prodcatm_id!=$id";
   }       
          
   $srsprodcat_mst = mysqli_query($conn,$sqryprodcat_mst);
   $cnt = mysqli_num_rows($srsprodcat_mst);
   if($cnt > 0){
   
    echo "<font color=red><strong>Duplicate Name</strong></font>";
   }     
  } 
  if(isset($_REQUEST['prodscatname']) && (trim($_REQUEST['prodscatname']) != "") &&
     isset($_REQUEST['prodcatid']) && (trim($_REQUEST['prodcatid']) != "")){
     
   $name = glb_func_chkvl($_REQUEST['prodscatname']);
   $prodcat     = glb_func_chkvl($_REQUEST['prodcatid']);
     
   $sqryprodscat_mst = "select prodscatm_name
    from 
     prodscat_mst
    where 
  prodscatm_prodcatm_id='$prodcat' and          
     prodscatm_name='$name'";
   if(isset($_REQUEST['subdid']) && ($_REQUEST['subdid']!= "")){
   
    $id =glb_func_chkvl($_REQUEST['subdid']);
    $sqryprodscat_mst .= " and prodscatm_id!=$id";
   }      
          
   $srsprodscat_mst = mysqli_query($conn,$sqryprodscat_mst);
   $cnt = mysqli_num_rows($srsprodscat_mst);
   if($cnt > 0){
   
    echo "<font color=red><strong>Duplicate Combination Of Category&Name</strong></font>";
   }     
  } 
  if(isset($_REQUEST['ordsts']) && (trim($_REQUEST['ordsts']) != "") &&
   isset($_REQUEST['ordid']) && (trim($_REQUEST['ordid']) != "") &&
   isset($_REQUEST['stsdt']) && (trim($_REQUEST['stsdt']) != "")
   ){
   $ordsts = glb_func_chkvl($_REQUEST['ordsts']);   
   $ordid = glb_func_chkvl($_REQUEST['ordid']);
      $stsdt = glb_func_chkvl($_REQUEST['stsdt']);
   //$newordts = date("d-m-Y", strtotime($stsdt)); 
   $sqryprod_mst = "SELECT 
         ordstsd_id,ordstsd_ordstsm_id,ordstsd_dttm,
         ordstsd_desc,ordstsd_crtordm_id,ordstsm_name
        FROM 
         ordsts_mst,ordsts_dtl,(SELECT MAX(ordstsd_id) AS oid FROM ordsts_dtl
        WHERE ordstsd_crtordm_id='$ordid' GROUP BY ordstsd_ordstsm_id) AS o_dtl
         WHERE ordstsd_crtordm_id='$ordid'
         AND ordstsm_id=ordstsd_ordstsm_id
         AND ordstsd_id=oid
         GROUP BY ordstsm_name
         order by ordstsm_id desc limit 0,1";         
   $srsprod_mst = mysqli_query($conn,$sqryprod_mst);
   $cnt        = mysqli_num_rows($srsprod_mst);
   $srsprod_mst = mysqli_fetch_assoc($srsprod_mst);
   $orddates = $srsprod_mst['ordstsd_dttm'];
    //$date1 = new DateTime($stsdt);
    //$date2 = new DateTime($orddates);
   //var_dump($date1 >= $date2); 
   if((strtotime($stsdt) >= strtotime($orddates))!= true){   
    echo "Date Should Be After Order Date";
   }
   /* if(($date1 >= $date2)!= true){   
    echo "Date Should Be After Order Date";
   } */
   /*else{
    echo "1";
   }*/   
  }   
?>