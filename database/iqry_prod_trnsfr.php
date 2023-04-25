<?php
include_once '../includes/inc_config.php'; //Making paging validation
include_once $inc_nocache; //Clearing the cache information
include_once $adm_session; //checking for session
include_once $inc_cnctn; //Making database Connection
include_once $inc_usr_fnctn; //checking for session 
include_once $inc_pgng_fnctns; //Making paging validation
include_once $inc_fldr_pth; //Making paging validation
if(isset($_POST['btntrnsfrstk']) && ($_POST['btntrnsfrstk'] != "") && isset($_POST['txtsku']) && ($_POST['txtsku'] != ""))
{
  $prod_id = glb_func_chkvl($_POST['prodid']);
  $date = date('Y-m-d');
  $frmloc = glb_func_chkvl($_POST['lstfrmloc']);
  $toloc = glb_func_chkvl($_POST['lsttoloc']);
  $qty = glb_func_chkvl($_POST['txtqty']);
  $sts = 'a';
	$curdt = date('Y-m-d h:i:s');
  // -------------------------- get price details -----------------------------
  $sqryindprc = "SELECT prdprchsind_id, prdprchsind_prc from prdprchsind_inventory where prdprchsind_sts = 'a' and prdprchsind_lcn = $frmloc and prdprchsind_prdid = $prod_id order by prdprchsind_id asc limit 0,$qty";
  $resindprc = mysqli_query($conn,$sqryindprc); 
  $nmprchrws = mysqli_num_rows($resindprc);
  $ind_id = array();
  $prc_arr = array();
  while($rwsindprc = mysqli_fetch_array($resindprc))
  {
    $ind_id[] = $rwsindprc['prdprchsind_id'];
    $prc_arr[] = $rwsindprc['prdprchsind_prc'];
  }
  $same_prc_cnt = array_count_values($prc_arr);
  $output = implode(', ', array_map(function ($v, $k) { return sprintf("%s|%s", $k, $v); }, $same_prc_cnt, array_keys($same_prc_cnt)));
  $a = explode(",", $output);
  $j = 0;
  while ($j < count($a))
  {
    $b = explode("|", $a[$j]);
    $prc = $b[0];
    $cnt = $b[1];
    $ntprc = $prc * $cnt;
    // ------------------------- insert into purchase --------------------------
    $insrtsql = "INSERT into prdprchs_inventory(prdprchs_prdid, prdprchs_dat,prdprchs_lcn, prdprchs_prc, prdprchs_ntprc, prdprchs_trns_in, prdprchs_sts, prdprchs_crton, prdprchs_crtby) values ('$prod_id', '$date', '$toloc', '$prc', '$ntprc', '$cnt', '$sts', '$curdt', '$ses_admin')";
    $resinsrtsql=mysqli_query($conn,$insrtsql);
    $prchsid=mysqli_insert_id($conn);
    if($resinsrtsql ==true)
    {
      for($i= 0; $i<$cnt;$i++)
      {
        // --------------- insert into individual purchase---------------------
        $insrtindsql="INSERT into prdprchsind_inventory (prdprchsind_prdprchs_id,prdprchsind_prdid, prdprchsind_dat, prdprchsind_lcn, prdprchsind_in,prdprchsind_prc, prdprchsind_sts, prdprchsind_trns_sts, prdprchsind_crton, prdprchsind_crtby) values ('$prchsid','$prod_id','$date','$toloc','1','$prc','a','r','$curdt','$ses_admin')";
        $resindsql=mysqli_query($conn,$insrtindsql);
      }
    }
    /*****************************To Location Data******************************/
    $sqlinvdata = "SELECT prdinvt_id, prdinvt_prdprchs_in, prdinvt_prdprchs_trns_in, prdinvt_prdsle_sleqty, prdinvt_prdsle_trns_out, prdinvt_clsbls, prdinvt_prdprchs_id from product_inventory where date_format(prdinvt_dat,'%Y-%m-%d') = '$date' and prdinvt_prdid ='$prod_id' and prdinvt_lcn ='$toloc' order by prdinvt_prdprchs_id desc";
    $resinvdata = mysqli_query($conn,$sqlinvdata);
    $nmrws = mysqli_num_rows($resinvdata);
    if($nmrws > 0)
    {
      $rwsinv = mysqli_fetch_array($resinvdata); 
      $prchs_in = $rwsinv['prdinvt_prdprchs_in'];   
      $sle_sleqty = $rwsinv['prdinvt_prdsle_sleqty'];   
      $trns_in = $rwsinv['prdinvt_prdprchs_trns_in'];   
      $trns_out = $rwsinv['prdinvt_prdsle_trns_out'];   
      $invid = $rwsinv['prdinvt_id'];  
      $prchsid = $rwsinv['prdinvt_prdprchs_id'];  
      $opnbls = $rwsinv['prdinvt_clsbls'];
      $tottrnsin = $trns_in + $cnt;
      $clsbls = ($opnbls) + ($cnt);
      // prdinvt_cstprc = '$prc', 
      $updtinv_mst = "UPDATE product_inventory set prdinvt_prdprchs_trns_in = '$tottrnsin', prdinvt_clsbls = '$clsbls', prdinvt_updton = '$curdt', prdinvt_updtby = '$ses_admin' where prdinvt_id = $invid ";
      $resupdtinv_mst = mysqli_query($conn,$updtinv_mst);
    }
    else
    {
      //---------------------------Previous Date-------------------------------//
      $sqryprevdt_mst  = "SELECT prdinvt_id, prdinvt_prdid, date_format(prdinvt_dat,'%Y-%m-%d') as prdinvt_dat, prdinvt_clsbls, prdinvt_cstprc from product_inventory
        LEFT join prdprchs_inventory on prdprchs_inventory.prdprchs_id = prdinvt_prdprchs_id
        where prdinvt_dat <= '$date' and prdinvt_lcn = '$toloc' and prdinvt_prdid = $prod_id order by prdinvt_dat DESC limit 1";
      $srsprevdt_mst = mysqli_query($conn,$sqryprevdt_mst);
      $rwsprevdt_mst = mysqli_fetch_array($srsprevdt_mst);
      $prevdt = $rwsprevdt_mst['prdinvt_dat'];
      $topnbls = $rwsprevdt_mst['prdinvt_clsbls'];
      $clsbls = ($topnbls)+($cnt);
      // echo $sqryprevdt_mst;exit;
      /******************************Inventory******************************/
      $insinvntry_mst = "INSERT into product_inventory (prdinvt_prdprchs_id, prdinvt_dat, prdinvt_prdprchs_trns_in, prdinvt_lcn, prdinvt_prdid,prdinvt_cstprc, prdinvt_opnbls, prdinvt_clsbls, prdinvt_sts, prdinvt_crton, prdinvt_crtby) values ('$prchsid','$date','$cnt','$toloc', '$prod_id','$prc','$topnbls','$clsbls','a','$curdt','$ses_admin')";
      $resinvntry_mst = mysqli_query($conn,$insinvntry_mst);
    }
    /*************************From Location Data********************************/
    $insrtsfrmql = "INSERT into prdsle_inventory(prdsle_prdid, prdsle_dat,prdsle_lcn, prdsle_trns_out,prdsle_crton, prdsle_crtby) values ('$prod_id','$date','$frmloc', '$cnt','$curdt','$ses_admin')";
    $resinsrtsql = mysqli_query($conn,$insrtsfrmql);
    $sleid = mysqli_insert_id($conn);
    /*************************Purchase ind update******************************/
    $prchsindid = implode(',',$ind_id);
    $updtprdinv_mst = "UPDATE prdprchsind_inventory set prdprchsind_sts = 'i', prdprchsind_trns_sts = 's', prdprchsind_prdsle_id = '$sleid', prdprchsind_updton = '$curdt', prdprchsind_updtby = '$ses_admin' where prdprchsind_id in($prchsindid)";
    //echo $updtprdinv_mst;exit;
    $resupdtprdinv_mst = mysqli_query($conn,$updtprdinv_mst);
    /************************From Location Data********************************/
    $sqlinvdata = "SELECT prdinvt_id, prdinvt_prdprchs_in, prdinvt_prdprchs_trns_in, prdinvt_prdsle_sleqty, prdinvt_prdsle_trns_out, prdinvt_clsbls, prdinvt_prdprchs_id, prdinvt_prdsle_id from product_inventory where date_format(prdinvt_dat,'%Y-%m-%d') = '$date' and prdinvt_prdid ='$prod_id' and prdinvt_lcn ='$frmloc' order by prdinvt_prdsle_id desc";
    $resinvdata = mysqli_query($conn,$sqlinvdata);
    $nmrws = mysqli_num_rows($resinvdata);
    if($nmrws > 0)
    {
      $rwsinv = mysqli_fetch_array($resinvdata);
      $prchs_in = $rwsinv['prdinvt_prdprchs_in'];
      $sle_sleqty = $rwsinv['prdinvt_prdsle_sleqty'];
      $trns_in = $rwsinv['prdinvt_prdprchs_trns_in'];
      $trns_out = $rwsinv['prdinvt_prdsle_trns_out'];
      $invid = $rwsinv['prdinvt_id'];
      $sleid = $rwsinv['prdinvt_prdsle_id'];
      $opnbls = $rwsinv['prdinvt_clsbls'];
      $tottrnsout = $trns_out+$cnt;
      $clsbls = ($opnbls)-($cnt);
      // prdinvt_cstprc = '$prc', 
      $updtinv_mst = "UPDATE product_inventory set prdinvt_prdsle_id = '$sleid', prdinvt_prdsle_trns_out = '$tottrnsout', prdinvt_clsbls = '$clsbls', prdinvt_updton = '$curdt', prdinvt_updtby = '$ses_admin' where prdinvt_id = $invid ";
      $resupdtinv_mst = mysqli_query($conn,$updtinv_mst);
    }
    else
    {
      //---------------------------Previous Date--------------------------------
      $sqryprevdt_mst  = "SELECT prdinvt_id, prdinvt_prdid, date_format(prdinvt_dat,'%Y-%m-%d') as prdinvt_dat, prdinvt_clsbls, prdinvt_cstprc from product_inventory
        LEFT join prdprchs_inventory on prdprchs_inventory.prdprchs_id = prdinvt_prdprchs_id
        where prdinvt_dat <= '$date' and prdinvt_lcn = '$frmloc' and prdinvt_prdid = $prod_id order by prdinvt_dat DESC limit 1";         
      $srsprevdt_mst = mysqli_query($conn,$sqryprevdt_mst);
      $rwsprevdt_mst = mysqli_fetch_array($srsprevdt_mst);
      $prevdt = $rwsprevdt_mst['prdinvt_dat'];
      $frmopnbls = $rwsprevdt_mst['prdinvt_clsbls'];
      //------------------------------ Open Balance ---------------------------
      $clsbls = ($frmopnbls)-($cnt);
      $insinvout_mst = "INSERT into product_inventory (prdinvt_prdsle_id, prdinvt_dat, prdinvt_prdsle_trns_out, prdinvt_lcn, prdinvt_prdid, prdinvt_cstprc, prdinvt_opnbls, prdinvt_clsbls, prdinvt_sts, prdinvt_crton,prdinvt_crtby) values ('$sleid', '$date', '$cnt','$frmloc', '$prod_id','$prc','$frmopnbls','$clsbls','a','$curdt','$ses_admin')";
      $resupdtinv_mst = mysqli_query($conn,$insinvout_mst);
    }
    /*************************To Data Update**********************************/
    $trnsfrsts = "a";
    $qrytrsfr = "INSERT into trnsfr_inventory(trnsfr_prdid, trnsfr_dat, trnsfr_frm_lcn, trnsfr_to_lcn, trnsfr_bls, trnsfr_sts,trnsfr_crton, trnsfr_crtby) values ('$prod_id','$date','$frmloc', '$toloc', '$cnt', '$trnsfrsts', '$curdt', '$ses_admin')";
    $restrnsfrsql=mysqli_query($conn,$qrytrsfr);
    if( $restrnsfrsql == true)
    {
      $gmsg = "Transaction Success";
    }
    else
    {
      $gmsg = "Transaction Un Success";
    }
    $j++;
  }
}
?>