<?php
	  include_once "includes/inc_nocache.php";// Includes no data cache
	  include_once "includes/inc_connection.php";//Making database Connection
	  include_once "includes/inc_usr_functions.php";//reusable code using functions
		  if(isset($_REQUEST['delete']) && (trim($_REQUEST['delete']) != "")&&
		  isset($_REQUEST['memdid']) && (trim($_REQUEST['memdid']) != "") ){
			   $membid=$_REQUEST['memdid'];///mem_dtl id to delete the member details 
			  $sqldelmem_dtl="DELETE FROM mbr_dtl WHERE mbrd_id='$membid'";
			  $srsdelmem_dtl  	   = mysqli_query($conn,$sqldelmem_dtl) or die(mysql_error());	
					  if($srsdelmem_dtl==true){
						 $result="y";
						}else{
						   $result="n";
						}
							echo $result;
			}

              if(isset($_REQUEST['stsdtl']) && (trim($_REQUEST['stsdtl']) != "")&&
              isset($_REQUEST['memdtlid']) && (trim($_REQUEST['memdtlid']) != "") &&
              isset($_REQUEST['memid']) && (trim($_REQUEST['memid']) != "")){
                    $memid=$_REQUEST['memid'];
                    $memdtlid=$_REQUEST['memdtlid'];///mem_dtl id to update  the  status of  member details 
                    $updtmbrsts_dtl="update mbr_dtl set mbrd_dfltbil ='n' where  mbrd_mbrm_id ='$memid'";
                    $rwsupdtmbrsts_mst=mysqli_query($conn,$updtmbrsts_dtl);
                    $updtmbrstss_dtl="update mbr_dtl set mbrd_dfltbil ='y' where  mbrd_id ='$memdtlid'";
                    $srsupdtmbrstss 	   = mysqli_query($conn,$updtmbrstss_dtl) or die(mysql_error());	
                        if($srsupdtmbrstss==true){
                            $result='y';
                        }else{
                            $result='n';
                        }
                    echo $result;
             }

                                    if(isset($_REQUEST['edtmemid']) && (trim($_REQUEST['edtmemid']) != "")&&
                                    isset($_REQUEST['edtmembid']) && (trim($_REQUEST['edtmembid']) != "") ){ 
                                    ///mem_dtl id to update  the    member details 
                                        $memid    = trim($_REQUEST['edtmemid']);
                                        $memdtlid = trim($_REQUEST['edtmembid']);
                                        $edtname  = trim($_REQUEST['edtname']);	
                                        $edtemail = trim($_REQUEST['edtemail']);	
                                        $edtaddr  = trim($_REQUEST['edtaddr']);	
                                        $edtphno   = trim($_REQUEST['edtphno']);	
                                        $edtpin   = trim($_REQUEST['edtpin']);
                                        $ctryid   = strip_tags(trim($_REQUEST['edtcntry']));	
                                        $stateid  = strip_tags(trim($_REQUEST['edtcnty']));		
                                        $edtcty   = trim($_REQUEST['edtcty']);	
                                        $edtlssts   = trim($_REQUEST['edtlssts']);	
                                        
                                                //////////////city/////////////////
                                                $sqrymbrcnty_mst = "select 
                                                                        ctym_id,ctym_name,ctym_sts
                                                                    from 
                                                                        cty_mst
                                                                    where 
                                                                        
                                                                        ctym_name = '$edtcty' and  ctym_cntym_id ='$stateid' 
                                                                    ";									
                                                $srsmbrcnty_mst	  	   = mysqli_query($conn,$sqrymbrcnty_mst) or die(mysql_error());
                                                $cntcty=mysqli_num_rows($srsmbrcnty_mst);
                                        
                                                if($cntcty >0){
                                                    $rowscnty=mysqli_fetch_assoc($srsmbrcnty_mst);
                                                    $ctyid=$rowscnty['ctym_id'];
                                                    $edtcty=$rowscnty['ctym_name'];
                                                }else{
                                                //////if city not exits in cty_mst table  insert new city
                                                $sqlcty_mst="insert into cty_mst (ctym_name,ctym_cntym_id,ctym_cntrym_id,ctym_sts,ctym_prty)values('$edtcty ','$stateid','$ctryid','a','1') ";
                                        
                                                $rwssqlcty_mst=mysqli_query($conn,$sqlcty_mst);
                                                $ctyid=mysqli_insert_id($conn);
                                        }
                                                    if($edtlssts =='y'){
                                                        $updtmbrsts_dtl="update mbr_dtl set mbrd_dfltbil ='n' where  mbrd_mbrm_id ='$memid'";
                                                        $rwsupdtmbrsts_mst=mysqli_query($conn,$updtmbrsts_dtl);
                                                        $edtlssts='y';
                                                    }else{
                                        
                                                        $edtlssts=$edtlssts;
                                                    }
                                                    $dt=date("Y-m-d");
                                        /////////////////////////////city////////////////////////
                                        ////update the members details 
                                        $sqlmemdtlupt="UPDATE mbr_dtl SET
                                        mbrd_emailid='$edtemail',
                                        mbrd_fstname='$edtname',
                                        mbrd_badrs='$edtaddr',
                                        mbrd_bmbrcntrym_id='$ctryid',
                                        mbrd_bmbrcntym_id='$stateid',
                                        mbrd_bcty_id='$ctyid',
                                        mbrd_bctym_id='$ctyid',
                                        mbrd_ctynm='$edtcty',
                                        mbrd_bmbrctym_name='',
                                        mbrd_bmbrcntym_name='',
                                        mbrd_bzip='$edtpin',
                                        mbrd_bdayphone='$edtphno',
                                        mbrd_dfltbil='$edtlssts',
                                        mbrd_mdfdon='$dt',
                                        mbrd_mdfdby='$edtemail'
                                            WHERE
                                            mbrd_id='$memdtlid' and mbrd_mbrm_id='$memid' "	;
                                            // echo $sqlmemdtlupt;
                                            $rowuptmemdtl=mysqli_query($conn,$sqlmemdtlupt);
                                            if($rowuptmemdtl==true){
                                                $result='y';
                                            }else{
                                                    $result='n';
                                            }
                                        echo $result;
                                    }

?>