<?php
include_once '../includes/inc_config.php'; //Making paging validation
include_once $inc_nocache; //Clearing the cache information
include_once $adm_session; //checking for session
include_once $inc_cnctn; //Making database Connection
include_once $inc_usr_fnctn; //checking for session 
include_once $inc_pgng_fnctns; //Making paging validation
include_once $inc_fldr_pth; //Making paging validation
if(isset($_POST['btnaprod']) && ($_POST['btnaprod'] != "") && isset($_POST['txtsku']) && ($_POST['txtsku'] != "") && isset($_POST['txtcde']) && ($_POST['txtcde']!= "") && isset($_POST['txtname']) && ($_POST['txtname'] != "") && isset($_POST['lsttyrbrnd']) && ($_POST['lsttyrbrnd'] != "") && isset($_POST['lstvehtyp']) && ($_POST['lstvehtyp']!= "") && isset($_POST['txtsize']) && ($_POST['txtsize'] != "") && isset($_POST['txtptrn']) && ($_POST['txtptrn'] != "") && isset($_POST['txtcstprc']) && ($_POST['txtcstprc'] != "") && isset($_POST['txtsleprc']) && ($_POST['txtsleprc'] != "") && isset($_POST['txtprior']) && ($_POST['txtprior'] != ""))
{
	$sku = glb_func_chkvl($_POST['txtsku']);
	$code = glb_func_chkvl($_POST['txtcde']);
	$name = glb_func_chkvl($_POST['txtname']);
	$tyrbrnd = glb_func_chkvl($_POST['lsttyrbrnd']);
	$vehtyp = glb_func_chkvl($_POST['lstvehtyp']);
  $veh_slctd = glb_func_chkvl($_POST['slctdvrnts']);
  $slctd_arr = explode(",",$veh_slctd);
	$tyrwdth = glb_func_chkvl($_POST['lsttyrwdth']);
	$tyrprfl = glb_func_chkvl($_POST['lsttyrprfl']);
	$tyrrmsz = glb_func_chkvl($_POST['lsttyrrmsz']);
  $chkloc = $_POST['ckhloc'];
  $tyrtyp = glb_func_chkvl($_POST['tyrtyp']);
  $rdtub = glb_func_chkvl($_POST['rdtub']);
	$size = glb_func_chkvl($_POST['txtsize']);
	$ptrn = glb_func_chkvl($_POST['txtptrn']);
	$cstprc = glb_func_chkvl($_POST['txtcstprc']);
	$sleprc = glb_func_chkvl($_POST['txtsleprc']);
	$ofrprc = glb_func_chkvl($_POST['txtofrprc']);
	$desc = addslashes(trim($_POST['txtdesc']));
	$seottl = glb_func_chkvl($_POST['txtseotitle']);
  $seodesc = addslashes(trim($_POST['txtseodesc']));
  $seokywrd = addslashes(trim($_POST['txtkywrd']));
  $seoh1_tle = glb_func_chkvl($_POST['txtseoh1tle']);
  $seoh1_desc = glb_func_chkvl($_POST['txtseoh1desc']);
  $seoh2_tle = glb_func_chkvl($_POST['txtseoh2tle']);
  $seoh2_desc = glb_func_chkvl($_POST['txtseoh2desc']);
  $sts = glb_func_chkvl($_POST['lststs']);
	$prty = glb_func_chkvl($_POST['txtprior']);
  $cntcntrl = glb_func_chkvl($_POST['hdntotcntrl']);
	$dt = date('Y-m-d h:i:s');
	$sqryprod_mst	= "SELECT prodm_sku from prod_mst where prodm_code='$sku'";
  $srsprod_mst = mysqli_query($conn,$sqryprod_mst);
  $cntrec  = mysqli_num_rows($srsprod_mst);
  if($cntrec < 1)
  {
    $iqryprod_mst	="INSERT into prod_mst(prodm_sku, prodm_code, prodm_name, prodm_tyr_brnd, prodm_vehtyp, prodm_tyrwdth, prodm_tyrprfl, prodm_tyrrmsz, prodm_tyrtyp, prodm_tub_dtl, prodm_size, prodm_ptrn, prodm_cstprc, prodm_sleprc, prodm_ofrprc, prodm_dsc, prodm_st, prodm_sdsc, prodm_sky, prodm_sotl, prodm_sodsc, prodm_sttle, prodm_stdsc, prodm_sts, prodm_rnk, prodm_crton, prodm_crtby)values('$sku','$code','$name','$tyrbrnd', '$vehtyp', '$tyrwdth', '$tyrprfl', '$tyrrmsz', '$tyrtyp', '$rdtub', '$size','$ptrn','$cstprc','$sleprc','$ofrprc','$desc','$seottl','$seodesc','$seokywrd','$seoh1_tle','$seoh1_desc','$seoh2_tle','$seoh2_desc','$sts','$prty','$dt','$ses_admin')";
    // echo $iqryprod_mst;exit;
    $irsprod_mst = mysqli_query($conn,$iqryprod_mst) or die(mysqli_error());
    if($irsprod_mst==true)
    {
      $prod_id = mysqli_insert_id($conn);
      $i = 0;
      while ($i < count($slctd_arr))
      {
        $lst = $slctd_arr[$i];
        $ind_lst = explode('-', $lst);
        $brndid = $ind_lst[0];
        $modlid = $ind_lst[1];
        $vrntid = $ind_lst[2];
        $iqryprod_veh_dtl_mst = "INSERT into prod_veh_dtl (prodd_prodm_id, prodd_veh_typ, prodd_veh_brnd, prodd_veh_mdl, prodd_veh_vrnt, prodd_sts, prodd_crton, prodd_crtby) values ('$prod_id','$vehtyp','$brndid','$modlid','$vrntid','$sts','$dt','$ses_admin')";
        $irsprod_veh_dtl_mst = mysqli_query($conn,$iqryprod_veh_dtl_mst) or die(mysqli_error());
        $i++;
      }
      $store_cnt = count($chkloc);
      for ($store=0; $store < $store_cnt; $store++)
      {
        // echo "here2:".$prod_id."-".$vehtyp."-".$chkloc[$store]."<br>";
        $iqryprod_str_dtl = "INSERT into prod_store_dtl (prods_prodm_id, prods_store_id, prods_sts, prods_crton, prods_crtby) values ('$prod_id','$chkloc[$store]','$sts','$dt','$ses_admin')";
        $irsprod_str_dtl = mysqli_query($conn,$iqryprod_str_dtl) or die(mysqli_error());
      }
      if($prod_id != "" && $cntcntrl!="")
      {
        for($i=1;$i <= $cntcntrl;$i++)
        {
          $prior = glb_func_chkvl("txtphtprior".$i);
          $prior = glb_func_chkvl($_POST[$prior]);
          $phtname = glb_func_chkvl("txtphtname".$i);
          $phtname = glb_func_chkvl($_POST[$phtname]);
          $phtsts = "lstphtsts".$i;
          $sts = $_POST[$phtsts];
          if($phtname !="" && $prior !="")
          {
            //****************IMAGE UPLOADING START****************//
            //FOLDER THAT WILL CONTAIN THE IMAGES
            $simg='flesimg'.$i;
            $bimg='flebimg'.$i;
            /*----------------------Update images-------------------*/
            if(isset($_FILES[$simg]['tmp_name']) && ($_FILES[$simg]['tmp_name']!=""))
            {
              $simgval = funcUpldImg($simg,'prodsimg');
              if($simgval != "")
              {
                $simgary = explode(":",$simgval,2);
                $sdest = $simgary[0];
                $ssource = $simgary[1];
              }
            }
            $sdestval = explode('.',$sdest);
            $sdestimg =$sdestval[0];
            if(isset($_FILES[$bimg]['tmp_name']) && ($_FILES[$bimg]['tmp_name']!=""))
            {
              $bimgval = funcUpldImg($bimg,'prodbimg');
              if($bimgval != "")
              {
                $bimgary = explode(":",$bimgval,2);
                $bdest = $bimgary[0];
                $bsource = $bimgary[1];
              }
            }
            $bdestval = explode('.',$bdest);
            $bdestimg =$bdestval[0];
            $iqryprodimg_dtl ="INSERT into prodimg_dtl (prodimgd_title,prodimgd_simg, prodimgd_bimg, prodimgd_sts, prodimgd_prty, prodimgd_prodm_id, prodimgd_crtdon, prodimgd_crtdby) values ('$phtname', '$sdestimg', '$bdestimg', '$sts', '$prior', '$prod_id', '$dt', '$ses_admin')";
            $rsprod_dtl   = mysqli_query($conn,$iqryprodimg_dtl);
            if($rsprod_dtl == true)
            {
              if(($ssource!='none') && ($ssource!='') && ($sdest != ""))
              {
                move_uploaded_file($ssource,$gprodsimg_upldpth.$sdest);
              }
              if(($bsource!='none') && ($bsource!='') && ($bdest != ""))
              {
                move_uploaded_file($bsource,$gprodbimg_upldpth.$bdest);
              }
            }
          }
        }
      }
      $gmsg = "Record saved successfully";
    }
    else
    {
      $gmsg = "Record not saved";
    }
  }
  else
  {   
    $gmsg = "Duplicate name. Record not saved";
  }
}
?>