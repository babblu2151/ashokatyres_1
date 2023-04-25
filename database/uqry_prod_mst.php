<?php
include_once '../includes/inc_config.php'; //Making paging validation
include_once $inc_nocache; //Clearing the cache information
include_once $adm_session; //checking for session
include_once $inc_cnctn; //Making database Connection
include_once $inc_usr_fnctn; //checking for session	
include_once $inc_pgng_fnctns; //Making paging validation
include_once $inc_fldr_pth; //Making paging validation
if(isset($_POST['btneprod']) && ($_POST['btneprod'] != "") && isset($_POST['txtsku']) && ($_POST['txtsku'] != "") && isset($_POST['txtcde']) && ($_POST['txtcde']!= "") && isset($_POST['txtname']) && ($_POST['txtname'] != "") && isset($_POST['txtcstprc']) && ($_POST['txtcstprc'] != "") && isset($_POST['txtsleprc']) && ($_POST['txtsleprc'] != "") && isset($_POST['txtprior']) && ($_POST['txtprior'] != ""))
{
	$id = glb_func_chkvl($_POST['hdnprodid']);
	$sku = glb_func_chkvl($_POST['txtsku']);
	$code = glb_func_chkvl($_POST['txtcde']);
	$name = glb_func_chkvl($_POST['txtname']);
	$tyrbrnd = glb_func_chkvl($_POST['lsttyrbrnd']);
	$vehtyp = glb_func_chkvl($_POST['lstvehtyp']);
	$veh_slctd = glb_func_chkvl($_POST['slctdvrnts']);
  $slctd_arr = explode(",",$veh_slctd);
	/*$vehbrnd = implode(",", $_POST['brndchk']);
	$vehmdl = implode(",", $_POST['modlchk']);
	$vehvrnt = implode(",", $_POST['vrntchk']);*/
	$tyrwdth = glb_func_chkvl($_POST['lsttyrwdth']);
	$tyrprfl = glb_func_chkvl($_POST['lsttyrprfl']);
	$tyrrmsz = glb_func_chkvl($_POST['lsttyrrmsz']);
	$tyrtyp = glb_func_chkvl($_POST['tyrtyp']);
	$rdtub = glb_func_chkvl($_POST['rdtub']);
	$chkloc = $_POST['ckhloc'];
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
	$pg = glb_func_chkvl($_REQUEST['hdnpage']);
	$countstart = glb_func_chkvl($_REQUEST['hdncnt']);
	$hdnbrndimg = glb_func_chkvl($_REQUEST['hdnbrndimg']);
	$cntcntrl = glb_func_chkvl($_POST['hdntotcntrl']);
	$srchval = addslashes(trim($_POST['hdnloc']));
	$curdt = date('Y-m-d h:i:s');
	$sqryprod_mst = "SELECT prodm_sku from prod_mst where prodm_code='$sku' and prodm_id != $id";
	$srsprod_mst = mysqli_query($conn,$sqryprod_mst);
	$cntprodm = mysqli_num_rows($srsprod_mst);
	if($cntprodm < 1)
	{
		$uqryprod_mst="UPDATE prod_mst set prodm_sku = '$sku', prodm_code = '$code', prodm_name='$name', prodm_tyr_brnd = '$tyrbrnd', prodm_vehtyp = '$vehtyp', prodm_tyrwdth = '$tyrwdth', prodm_tyrprfl = '$tyrprfl', prodm_tyrrmsz = '$tyrrmsz', prodm_tyrtyp = '$tyrtyp', prodm_tub_dtl = '$rdtub', prodm_size = '$size', prodm_ptrn = '$ptrn', prodm_cstprc = '$cstprc', prodm_sleprc = '$sleprc', prodm_ofrprc = '$ofrprc', prodm_dsc = '$desc', prodm_st = '$seottl', prodm_sdsc = '$seodesc', prodm_sky = '$seokywrd', prodm_sotl = '$seoh1_tle', prodm_sodsc = '$seoh1_desc', prodm_sttle = '$seoh2_tle', prodm_stdsc = '$seoh2_desc', prodm_sts = '$sts', prodm_rnk = '$prty', prodm_mdyon = '$curdt', prodm_mdfyby = '$ses_admin' where prodm_id = '$id'";
		// echo $uqryprod_mst; exit;
		$ursprod_mst = mysqli_query($conn,$uqryprod_mst);
		if($ursprod_mst == true)
		{
			$del_prod_vrnts = "DELETE from prod_veh_dtl where prodd_prodm_id = $id";
			if (mysqli_query($conn,$del_prod_vrnts))
			{
				$i = 0;
	      while ($i < count($slctd_arr))
	      {
	        $lst = $slctd_arr[$i];
	        $ind_lst = explode('-', $lst);
	        $brndid = $ind_lst[0];
	        $modlid = $ind_lst[1];
	        $vrntid = $ind_lst[2];
	        $iqryprod_veh_dtl_mst = "INSERT into prod_veh_dtl (prodd_prodm_id, prodd_veh_typ, prodd_veh_brnd, prodd_veh_mdl, prodd_veh_vrnt, prodd_sts, prodd_crton, prodd_crtby) values ('$id','$vehtyp','$brndid','$modlid','$vrntid','$sts','$curdt','$ses_admin')";
	        $irsprod_veh_dtl_mst = mysqli_query($conn,$iqryprod_veh_dtl_mst) or die(mysqli_error());
	        $i++;
	      }
	    }
			$del_prod_strs = "DELETE from prod_store_dtl where prods_prodm_id = $id";
			if (mysqli_query($conn,$del_prod_strs))
			{
				$store_cnt = count($chkloc);
	      for ($store = 0; $store < $store_cnt; $store++)
	      {
	        // echo "here2:".$prod_id."-".$vehtyp."-".$chkloc[$store]."<br>";
	        $iqryprod_str_dtl = "INSERT into prod_store_dtl (prods_prodm_id, prods_store_id, prods_sts, prods_crton, prods_crtby) values ('$id','$chkloc[$store]','$sts','$curdt','$ses_admin')";
	        $irsprod_str_dtl = mysqli_query($conn,$iqryprod_str_dtl) or die(mysqli_error());
	      }
	    }
	    // echo $cntcntrl; exit;
	    if($id != "" && $cntcntrl != "")
	    {
	    	for($i=1;$i<=$cntcntrl;$i++)
	    	{
					$cntrlid = glb_func_chkvl("hdnproddid".$i);
					$prodid = glb_func_chkvl($_POST[$cntrlid]);
					$cntsmlimg = glb_func_chkvl("hdnsmlimg".$i);
					$hdnsmlimg = glb_func_chkvl($_POST[$cntsmlimg]);
					$cntbgimg = glb_func_chkvl("hdnbgimg".$i);
					$hdnbgimg = glb_func_chkvl($_POST[$cntbgimg]);
					$phtcntrl_nm= glb_func_chkvl("txtphtname".$i);
					$phtval = glb_func_chkvl($_POST[$phtcntrl_nm]);
          $phtname = glb_func_chkvl("txtphtname".$i);
          $phtname = glb_func_chkvl($_POST[$phtname]);
          $phtsts = "lstphtsts".$i;
          $sts = $_POST[$phtsts];
          $prior = glb_func_chkvl("txtphtprior".$i);
          $prtyval = glb_func_chkvl($_POST[$prior]);
          if($phtname !="" && $prior !="")
          {
            //****************IMAGE UPLOADING START****************//
            //FOLDER THAT WILL CONTAIN THE IMAGES
            $simg='flesimg'.$i;
            $bimg='flebimg'.$i;
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
						if($prodid != '')
						{
							$uqryprodimgd_dtl = "UPDATE prodimg_dtl set prodimgd_title = '$phtname', prodimgd_sts = '$sts',prodimgd_prty = '$prtyval', prodimgd_mdfdon= '$curdt',prodimgd_mdfdby = '$ses_admin'";
							if(($ssource!='none') && ($ssource!='') && ($sdest != ""))
							{ 
								if(isset($_FILES[$simg]['tmp_name']) && ($_FILES[$simg]['tmp_name']!=""))
								{
									$smlimgpth = $gprodsimg_upldpth.$hdnsmlimg;
									if(($hdnsmlimg != '') && file_exists($smlimgpth))
									{
										unlink($smlimgpth);
									}
									$uqryprodimgd_dtl .= ", prodimgd_simg = '$sdestimg'";
								}
								move_uploaded_file($ssource,$gprodsimg_upldpth.$sdest);
							}
							if(($bsource!='none') && ($bsource!='') && ($bdest != ""))
							{
								if(isset($_FILES[$bimg]['tmp_name']) && ($_FILES[$bimg]['tmp_name']!=""))
								{
									$bgimgpth = $gprodbimg_upldpth.$hdnbgimg;
									if(($hdnbgimg != '') && file_exists($bgimgpth))
									{
										unlink($bgimgpth);
									}
									$uqryprodimgd_dtl .= ",prodimgd_bimg='$bdestimg'";
								}
								move_uploaded_file($bsource,$gprodbimg_upldpth.$bdest);
							}
							$uqryprodimgd_dtl .= " where prodimgd_prodm_id = '$id' and prodimgd_id = '$prodid'";
							$srprodimgd_dtl = mysqli_query($conn,$uqryprodimgd_dtl);
						}
						else
						{
							$iqryprod_dtl = "INSERT into prodimg_dtl(prodimgd_title, prodimgd_simg, prodimgd_bimg, prodimgd_sts, prodimgd_prty,prodimgd_prodm_id, prodimgd_crtdon, prodimgd_crtdby) values ('$phtname', '$sdestimg', '$bdestimg', '$sts', '$prtyval', $id, '$curdt', '$ses_admin')";
							$srprodimgd_dtl = mysqli_query($conn,$iqryprod_dtl) or die(mysqli_error());
						}
						if($srprodimgd_dtl)
						{
							if(($ssource!='none') && ($ssource!='') && ($sdest != ""))
							{
								move_uploaded_file($ssource,$gprodsimg_upldpth.$sdest);
								//$wtrmrkimgnm = funcWtrMrkSml($gprodsimg_upldpth,$sdest);
							}
							if(($bsource!='none') && ($bsource!='') && ($bdest != ""))
							{
								move_uploaded_file($bsource,$gprodbimg_upldpth.$bdest);
								// $wtrmrkimgnm = funcWtrMrkBg($gprodbimg_upldpth,$bdest);
							}
						}	
					}//End of For Loop
				}
			}															
			?>
			<script>location.href="view_detail_prod.php?vw=<?php echo $id;?>&sts=y&pg=<?php echo $pg;?>&countstart=<?php echo $countstart.$srchval;?>";</script>
			<?php
		}
		else
		{ ?>
			<script>location.href="view_detail_prod.php?vw=<?php echo $id;?>&sts=n&pg=<?php echo $pg;?>&countstart=<?php echo $countstart.$srchval;?>";</script>
			<?php
		}
	}
	else
	{ ?>
		<script>location.href="view_detail_prod.php?vw=<?php echo $id;?>&sts=d&pg=<?php echo $pg;?>&countstart=<?php echo $countstart;?>";
		</script>
		<?php
	}
}
?>