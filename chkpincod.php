<?php 
 include_once "includes/inc_config.php";// site and  files confige
	include_once "includes/inc_connection.php";// database connection
if(isset($_REQUEST['chklctnpncd']) && (trim($_REQUEST['chklctnpncd']) != "")){
		// checking Duplicate name for Brand name
		
		$result 	  = "";
		$chklctnpncd 		  	= strtolower(trim($_REQUEST['chklctnpncd']));
		$dlvrtyp 		  		= strtolower(trim($_REQUEST['typval']));
		$pncd_result = '';
		$sqrypncd_mst = "select 
							pinm_id,pinm_cty,pinm_code
									from
									pin_mst where pinm_sts ='a'
								
							and
							pinm_code = '$chklctnpncd'";
								
		/*if($dlvrtyp == 2){
			$sqrypncd_mst .= " and pncdm_dlvrtyp = '$dlvrtyp'";
		}elseif($dlvrtyp == 1){
			$sqrypncd_mst .= " and (pncdm_dlvrtyp = '1' or pncdm_dlvrtyp = '2')";
		}
		if($dlvrtyp == 1){
			$sqrypncd_mst .= " and (pncdm_dlvrtyp = '1' or pncdm_dlvrtyp = '2')";
		}else{
			$sqrypncd_mst .= " and pncdm_dlvrtyp = '$dlvrtyp'";
		}*/
		
				$sqrypncd_mst .= " group by pinm_id";
		 $srspncd_mst = mysqli_query($conn,$sqrypncd_mst);
		 $cntpncd_mst = mysqli_num_rows($srspncd_mst);
		
		echo $sqrypncd_mst;


$currentDateTime = date('d-m-Y');

    

  $shippingfromdate=strftime("%d-%m-%Y", strtotime("$currentDateTime +3 day"));

 

  
        
    $timestamp1 = strtotime($currentDateTime);
     $timestamp2 = strtotime($shippingfromdate);
    
    $sundays    = array();
    $oneDay     = 60*60*24;

    for($i = $timestamp1; $i <= $timestamp2; $i += $oneDay) {
        $day = date('N', $i);

        // If sunday
        if($day == 7) {
            // Save sunday in format YYYY-MM-DD, if you need just timestamp
            // save only $i
            $sundays[] = date('d-m-Y', $i);

            // Since we know it is sunday, we can simply skip 
            // next 6 days so we get right to next sunday
            $i += 6 * $oneDay;
            $j=1;
        }
        else{
        	$j=0;
        }

        
    }
if($j == "1"){
     $shippingfromdate=strftime("%d-%m-%Y", strtotime("$currentDateTime +3 day"));

  
    }else {
    	 $shippingfromdate;
    }
    


 $shippingtodate = strftime("%d-%m-%Y", strtotime("$shippingfromdate +2 day"));


 $timestamp3 = strtotime($shippingfromdate);
     $timestamp4 = strtotime($shippingtodate);
    
    $sundays    = array();
    $oneDay     = 60*60*24;

    for($k = $timestamp3; $k <= $timestamp4; $k += $oneDay) {
        $day = date('N', $k);

        // If sunday
        if($day == 7) {
            // Save sunday in format YYYY-MM-DD, if you need just timestamp
            // save only $i
            $sundays[] = date('d-m-Y', $k);

            // Since we know it is sunday, we can simply skip 
            // next 6 days so we get right to next sunday
            $k += 6 * $oneDay;
            $m=1;
        }
        else{
        	$m=0;
        }

        
    }
if($m == "1"){
     $shippingtodate=strftime("%d-%m-%Y", strtotime("$shippingtodate +1 day"));

  
    }else {
    	 $shippingtodate;
    }
		 if($cntpncd_mst > 0){
		 	while($rowspncd_mst = mysqli_fetch_assoc($srspncd_mst)){
				$db_areanm 		= $rowspncd_mst['pinm_code'];
				$db_ctynm 		= $rowspncd_mst['pinm_cty'];
				$db_pncdnm 		= $rowspncd_mst['pinm_code'];
			}
	
				$pncd_result = "y<<->><span class='label label-success'>Item delivery available at pin code: $chklctnpncd
		<a class='btn btn-dark' href='javascript:;' onClick='funcPncdchng($chklctnpncd)'>&nbsp;Change</a></span>
			<div class='alert alert-warning show-grid text-left' style='margin-bottom:0'><strong>$db_ctynm</strong><br><small>$db_pncdnm <br>
			Expected Delivery Date :  $shippingfromdate to $shippingtodate.
			</small></div>";
		 }else{
		 	$pncd_result = "n<<->><span class='label label-danger'>Item delivery not available at pin code: $chklctnpncd</span>";
		 }
		 echo $pncd_result;
	} 	?>