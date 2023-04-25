<?php
	 include_once '../includes/inc_config.php';       //Making paging validation	
	  include_once $inc_nocache;        //Clearing the cache information
	  include_once $adm_session;    //checking for session
	  include_once $inc_cnctn;     //Making database Connection
	  include_once $inc_usr_fnctn;  //checking for session	
	  include_once $inc_pgng_fnctns;//Making paging validation
	  include_once $inc_fldr_pth;//Making paging validation
	/***************************************************************
	Programm 	  : view_detail_product_subcategory.php	
	Purpose 	  : For Viewing Product SubCategory Details
	Created By    : Mallikarjuna
	Created On    :	31/10/2013
	Modified By   : Aradhana
	Modified On   :20-01-2014
	Purpose 	  : 
	Company 	  : Adroit
	************************************************************/
	global $id,$pg,$countstart;
	$rd_crntpgnm = "view_product_subcategory.php";
	$rd_edtpgnm  = "edit_product_subcategory.php";
	 $clspn_val   = "4";
	if(isset($_REQUEST['vw']) && (trim($_REQUEST['vw'])!="") &&
	   isset($_REQUEST['pg']) && (trim($_REQUEST['pg'])!="") &&
	   isset($_REQUEST['countstart']) && (trim($_REQUEST['countstart'])!="")){
		$id = glb_func_chkvl($_REQUEST['vw']);
		$pg = glb_func_chkvl($_REQUEST['pg']);
		$countstart = glb_func_chkvl($_REQUEST['countstart']);
		$valt = glb_func_chkvl($_REQUEST['valt']);
		$vala = glb_func_chkvl($_REQUEST['vala']);
		$chkt = glb_func_chkvl($_REQUEST['chkt']);
		$optn = glb_func_chkvl($_REQUEST['optn']);
		$loc = "&optn=".$optn."&valt=".$valt."&vala=".$vala."&chkt=".$chkt;
	}
	$sqryprodscat_mst="select 
						prodscatm_name,prodscatm_desc,prodscatm_prodcatm_id,
						if(prodscatm_sts = 'a', 'Active','Inactive') as prodscatm_sts,
						prodcatm_prty,prodscatm_prty,prodcatm_name,prodscatm_seotitle,
						prodscatm_seodesc,prodscatm_seokywrd,prodscatm_seohonetitle,
						prodscatm_seohonedesc,prodscatm_seohtwotitle,prodscatm_seohtwodesc,
						prodscatm_szchrtimg
					  from 
							prodscat_mst inner join prodcat_mst on prodcatm_id = prodscatm_prodcatm_id
	                  where 
						  	prodscatm_id=$id";
	$srsprodscat_mst  = mysqli_query($conn,$sqryprodscat_mst);
	$rowsprodscat_mst = mysqli_fetch_assoc($srsprodscat_mst);


	if(isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == "y"))	
	{
			$msg = "<font color=red>Record updated successfully</font>";
	}
	elseif(isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == "n"))
	{
			$msg = "<font color=red>Record not updated</font>";
	}
	elseif(isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == "d"))
	{
	    	$msg = "<font color=red>Duplicate Recored Name Exists & Record Not updated</font>";
	}
?>
<script language="javascript">	
function update1()  //for update download details
{
 document.frmedtprodscatid.action="<?php echo $rd_edtpgnm;?>?vw=<?php echo $id;?>&pg=<?php echo $pg;?>&countstart=<?php echo $countstart.$loc;?>";  
 document.frmedtprodscatid.submit();
}
</script>

	<?php   
	include_once $inc_adm_hdr;
	
?>
<section class="content"> 
 
 <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"> View Product SubCategory  </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"> View Product SubCategory  </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
  <form name="frmedtprodscatid" id="frmedtprodscatid" method="post" action="<?php $_SERVER['PHP_SELF'];?>" 
		   onSubmit="return performCheck('frmedtprodscatid', rules, 'inline');" enctype="multipart/form-data">
              <input type="hidden" name="hdnprodscatid" value="<?php echo $id;?>">
              <input type="hidden" name="hdnpage" value="<?php echo $pg;?>">
              <input type="hidden" name="hdncnt" value="<?php echo $countstart?>">
              <?php
				 if($msg !=''){
				 	echo "<tr bgcolor='#FFFFFF'>
					<td colspan='4' bgcolor='#F3F3F3' align='center'><strong>$msg</strong></td> 
					  </tr>";
				 }
			 ?>
              
            <div class="card">
                    		<div class="card-body">          
                            
                            
                            <div class="row justify-content-center">
                    <div class="col-sm-4">
<label for="txtname">Product Category </label><br />

<?php echo $rowsprodscat_mst['prodcatm_name'];?>

</div>
               
               
              <div class="col-sm-4"> <label>Name</label><br />

<?php echo $rowsprodscat_mst['prodscatm_name'];?>	</div>         
                        
                      
                       <div class="col-sm-4"><label>Description</label>
                            <br />
      <?php echo $rowsprodscat_mst['prodscatm_desc'];?>		  </div>

                        </div>
                        
                         
                       <div class="row justify-content-center form-group mt-3">
                       
                     <div class="col-sm-4">  <label>Size Chart</label><br />

                            
                            <?php
					   $szimgnm    = $rowsprodscat_mst['prodscatm_szchrtimg'];
					    $szimgpath  = $gszchrt_upldpth.$szimgnm;
					   if(($szimgnm !="") && file_exists($szimgpath)){
						  echo "<img src='$szimgpath' width='50pixel' height='50pixel'>";					 
					   }
					   else{
						  echo "Image not available";						 				  
					   }
					?>		
                    </div>
                    
                    <div class="col-sm-4"><label>SEO Title</label><br />
               
		                     <?php echo $rowsprodscat_mst['prodscatm_seotitle'];?></div>
                             
                     <div class="col-sm-4"> <label>SEO Keyword</label>                 
		                     <?php echo $rowsprodscat_mst['prodscatm_seokywrd'];?></div>
                    
                    </div>
                        
                        
                        
                        
                         
                        
                         
                        
                        
                         
                        
                         
                        
                         <div class="form-group row mt-3">
		                   
		                    <div class="col-sm-4">    
                             <label>SEO Description</label>        <br />
       
		                     <?php echo $rowsprodscat_mst['prodscatm_seodesc'];?>	
		                    </div>
                            
                            <div class="col-sm-4">    
                            <label>SEO H1 Title</label><br />

                                           
		                    </strong> <?php echo $rowsprodscat_mst['prodscatm_seohonetitle'];?>	 
		                    </div>
                            
                            <div class="col-sm-4">   
                            <label>SEO H1 Description</label>                
		                     <?php echo $rowsprodscat_mst['prodscatm_seohonedesc'];?>	 
		                    </div>
                            
                            
		                </div>
                        
                         
                        
                         <div class="form-group row">
		                    
		                    
		                </div>
                        
                         <div class="form-group row">
		                    
		                    <div class="col-sm-4">  
                            <label>SEO H2 Title</label>                 
		                     <?php echo $rowsprodscat_mst['prodscatm_seohtwotitle'];?>	 
		                    </div>
                            
                            <div class="col-sm-4">     
                            <label>SEO H2 Description</label>              
		                     <?php echo $rowsprodscat_mst['prodscatm_seohtwodesc'];?>	
		                    </div>
                            
                            <div class="col-sm-4">
                            <label>Rank</label> <br />
                  
		                      <?php echo $rowsprodscat_mst['prodscatm_prty'];?>	 
		                    </div>
                            
                            
		                </div>
                        
                         
                        
                         
                        	 
                   
				 		
              	<div class="form-group row">
		                  
		                    <div class="col-sm-4">
                              <label>Status  </label><br />
                   
		                                    <?php echo $rowsprodscat_mst['prodscatm_sts'];?>
		                    </div>
		                </div>
				
                
                
               
               
               
               
                
                
            
             
             
             
             
            
            
                
                
                 <p class="text-center"> <input type="Submit" class="btn btn-primary btn-cst"  name="frmedtprodscatid" id="frmedtprodscatid" value="Edit" 
						  onclick="update1()">
                  &nbsp;&nbsp;&nbsp;
                  <input type="reset" class="btn btn-primary btn-cst"  name="btnprodcatreset" value="Clear" id="btnprodcatreset">
                  &nbsp;&nbsp;&nbsp;
                  <input type="button"  name="btnBack" value="Back" class="btn btn-primary btn-cst" 
					  onclick="location.href='<?php echo $rd_crntpgnm;?>?<?php echo $loc;?>'">
                        
                         </p>
                         
                         
                         
                        
                          
		
          
                      
                       </form>
                      
                      
                          
                          
                          
                           
                </div>
                
                
                
                
             </div>
             </div>
             
             
             
             
             
             
             
             
             
             
             
             </div>
          </form>    
</section>





			
<?php include_once "../includes/inc_adm_footer.php";?>
