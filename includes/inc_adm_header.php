<?php
include_once '../includes/inc_connection.php';
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo $pgtl;?></title>
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  </head>
  <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/ashokatyres-logo.png" class="elevation-2" alt="Ekta">
        </div>
        <div class="info">
          <a href="#" class="d-block"></a>
        </div>
      </div>
      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
              <li class="nav-item has-treeview menu-open">
                <a href="./main.php" class="nav-link active">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>Dashboard</p>
                </a>
              </li>
              <li class="nav-item has-treeview <?php if($pagemncat == "Setup" ){echo "menu-open";} ?>">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-circle"></i>
                  <p>Setup<i class="right fas fa-angle-left"></i></p>
                </a>
                <ul class="nav nav-treeview <?php if($pagemncat == "Setup" ){echo "menu-open";} ?>">
                  <li class="nav-item has-treeview <?php if($pagecat == "Vehicle" ){echo "menu-open";} ?>">
                    <a href="#" class="nav-link ">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Vehicle<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview <?php if($pagecat == "Vehicle" ){echo "menu-open";} ?>">
                      <li class="nav-item">
                        <a href="view_veh_type.php" class="nav-link <?php if($pagenm == "Vehicle Type"){echo "active";} ?>">
                          <i class="far fa-dot-circle nav-icon"></i>
                          <p>Type</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="view_veh_brand.php" class="nav-link <?php if($pagenm == "Vehicle Brand"){echo "active";} ?>"><i class="far fa-dot-circle nav-icon"></i>
                          <p>Brand</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="view_veh_model.php" class="nav-link <?php if($pagenm == "Vehicle Model"){echo "active";} ?>">
                          <i class="far fa-dot-circle nav-icon"></i>
                          <p>Model</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="view_veh_vrnt.php" class="nav-link <?php if($pagenm == "Vehicle Variant"){echo "active";} ?>">
                          <i class="far fa-dot-circle nav-icon"></i>
                          <p>Variant</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-item has-treeview <?php if($pagecat == "Tyre" ){echo "menu-open";} ?>">
                    <a href="#" class="nav-link ">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Tyre<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview <?php if($pagemncat == "Setup" ){echo "menu-open";} ?>">
                      <li class="nav-item">
                        <a href="view_tyre_brand.php" class="nav-link <?php if($pagenm == "Tyre Brand"){echo "active";} ?>">
                          <i class="far fa-dot-circle nav-icon"></i>
                          <p>Brand</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="view_tyre_type.php" class="nav-link <?php if($pagenm == "Tyre Type"){echo "active";} ?>">
                          <i class="far fa-dot-circle nav-icon"></i>
                          <p>Type</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="view_tyre_width.php" class="nav-link <?php if($pagenm == "Tyre Width"){echo "active";} ?>">
                          <i class="far fa-dot-circle nav-icon"></i>
                          <p>Width size</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="view_tyre_profile.php" class="nav-link <?php if($pagenm == "Tyre profile"){echo "active";} ?>">
                          <i class="far fa-dot-circle nav-icon"></i>
                          <p>Profile size</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="view_tyr_rimsize.php" class="nav-link <?php if($pagenm == "Tyre Rim Size"){echo "active";} ?>">
                          <i class="far fa-dot-circle nav-icon"></i>
                          <p>Rim Size</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-item has-treeview <?php if($pagecat == "Stores" ){echo "menu-open";} ?>">
                    <a href="#" class="nav-link ">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Stores<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview <?php if($pagemncat == "Setup" ){echo "menu-open";} ?>">
                      <li class="nav-item">
                        <a href="view_all_locations.php" class="nav-link <?php if($pagenm == "Locations"){echo "active";} ?>">
                          <i class="far fa-dot-circle nav-icon"></i>
                          <p>Locations</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="view_all_users.php" class="nav-link <?php if($pagenm == "Users"){echo "active";} ?>">
                          <i class="far fa-dot-circle nav-icon"></i>
                          <p>Users</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-item">
                    <a href="view_all_banner.php" class="nav-link <?php if($pagenm == "Banner"){echo "active";} ?>">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Banner</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="view_all_members.php" class="nav-link <?php if($pagenm == "Members"){echo "active";} ?>">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Members</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="view_all_prod_features.php" class="nav-link <?php if($pagenm == "Product features"){echo "active";} ?>">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Product Features</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item has-treeview <?php if($pagemncat == "Products" ){echo "menu-open";} ?>">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-circle"></i>
                  <p>Products<i class="right fas fa-angle-left"></i></p>
                </a>
                <ul class="nav nav-treeview <?php if($pagemncat == "Products" ){echo "menu-open";} ?>">
                  <li class="nav-item">
                    <a href="view_all_products.php" class="nav-link <?php if($pagenm == "View Products"){echo "active";} ?>">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>View Products</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item has-treeview <?php if($pagemncat == "Stock" ){echo "menu-open";} ?>">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-circle"></i>
                  <p>Stock<i class="right fas fa-angle-left"></i></p>
                </a>
                <ul class="nav nav-treeview <?php if($pagemncat == "Stock" ){echo "menu-open";} ?>">
                  <li class="nav-item">
                    <a href="stock_purchase.php" class="nav-link <?php if($pagenm == "Purchase"){echo "active";} ?>">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Purchase</p>
                    </a>
                  </li>
                </ul>
                <ul class="nav nav-treeview <?php if($pagemncat == "Stock" ){echo "menu-open";} ?>">
                  <li class="nav-item">
                    <a href="stock_transfer.php" class="nav-link <?php if($pagenm == "Transfer"){echo "active";} ?>">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Transfer</p>
                    </a>
                  </li>
                </ul>
              </li>
                
                
              <!-- <li class="nav-item has-treeview ">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                  Location
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="vw_all_country.php" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Country</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="vw_all_county.php" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>State</p>
                    </a>
                  </li>
                 
                </ul>
                
                
                
                
                <ul class="nav nav-treeview">
                                <li class="nav-item"><a href='vw_all_continent.php' class="nav-link">
                                <i class="far fa-dot-circle nav-icon"></i><p>Continents</p></a></li>
                                
                               
                  <li class="nav-item"><a href="view_all_county.php" class="nav-link">
                                <i class="far fa-dot-circle nav-icon"></i><p>County Verified</p></a></li>
                                    <li class="nav-item"><a href="vw_all_verifycnty.php" class="nav-link">
                                <i class="far fa-dot-circle nav-icon"></i><p>County Not Verified</p></a></li>	
                         
                               
                                  <li class="nav-item"><a href="view_all_city.php" class="nav-link">
                                <i class="far fa-dot-circle nav-icon"></i><p> City Verified</p></a></li>
                                      <li class="nav-item"><a href="vw_all_verifycity.php"class="nav-link">
                                <i class="far fa-dot-circle nav-icon"></i><p>City Not Verified </p></a></li>
                                
                </ul>
                
               
                
              </li> -->
              
              <?php// }if((in_array(2,$sesvalary))|| $ses_admtyp == 'a'){ ?>

             <!--- <li class="nav-item">
                <a href="vw_all_exhbtn.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Exhibition</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="view_all_shpng.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Shipping</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="view_all_cod.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Express Shipping</p>
                </a>
              </li>
 
              <li class="nav-item">
                <a href="view_all_dolr.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dollar</p>
                </a>
              </li>--->
              
              
                        
                       <!--  <li class="nav-item">
                <a href="view_all_ordsts.php" class="nav-link <?php if($pagenm == "order" ){echo "active";} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  Order Status</a></li>		
                        
                        <li class="nav-item">
                <a href="vw_all_ads.php" class="nav-link <?php if($pagenm == "ads" ){echo "active";} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  Ads</a></li>		
                        
                 <li class="nav-item">
                <a href="vw_all_banners.php" class="nav-link <?php if($pagenm == "Banner" ){echo "active";} ?>">
                  <i class="far fa-circle nav-icon"></i>Banner</a></li>		
                        
              
            </ul>
          </li>



<li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                  Products
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                
         <li class="nav-item">
                    <a href="view_all_products.php" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>View Products</p>
                    </a>
                  </li>
                  
                  
                   <li class="nav-item">
                    <a href="view_all_products.php" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Add New</p>
                    </a>
                  </li>
                
                   <li class="nav-item">
                    <a href="add_blkprdcts.php" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Product Bulk Add</p>
                    </a>
                  </li>
                   <li class="nav-item">
                    <a href="add_clrimgs.php" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Color Image Bulk Add</p>
                    </a>
                  </li>
                  
                  <li class="nav-item">
                    <a href="add_prdimgs.php" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Image Bulk Sheet Add</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="add_blkimgs.php" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Product Image Bulk Add</p>
                    </a>
                  </li>
            
                 <li class="nav-item">
                    <a href="edit_prdcts_blk.php" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Products Bulk Edit</p>
                    </a>
                  </li> 
                  <li class="nav-item">
                    <a href="view_all_products.php?prdsts=p" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Confirm</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="view_all_products.php?prdsts=s" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Suspended</p>
                    </a>
                  </li> -->
                  
                  
                  
                  
                  
                  <?php /*?>
				  <li class="nav-item">
                    <a href="view_all_products.php?prdsts=n" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Add New</p>
                    </a>
                  </li>
                
                  
                  <li class="nav-item">
                    <a href="iew_all_products.php?prdsts=p" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Confirm</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="view_all_products.php?prdsts=s" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Suspended</p>
                    </a>
                  </li>
				  <?php */?>
                 
                <!-- </ul>
              </li>
              
              
             
                  
                  <li class="nav-item">
            <a href="vw_all_photos.php" class="nav-link">
              <i class="nav-icon far fa-image"></i>
              <p>Photo Gallery</p>
            </a>
          </li>
          
          
          
          <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                  Supplier
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                
         
                
                  <li class="nav-item">
                    <a href="vendors.php" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Registered Supplier</p>
                    </a>
                  </li>
                  
                 
                </ul>
              </li>
              
              
              
                  <li class="nav-item has-treeview"> <a href="#" class="nav-link"> <i class="far fa-dot-circle nav-icon"></i><p>ORDER MANAGEMENT</p></a>
                      <?php
                        $sqryordsts_mst="select 
											ordstsm_id,ordstsm_name
										 from
											ordsts_mst
										 where
											ordstsm_sts='a'
										 order by 
										 	ordstsm_prty";
                        $srsordsts_mst		= mysqli_query($conn,$sqryordsts_mst);
                        $cntrecordsts_mst	= mysqli_num_rows($srsordsts_mst);
                        if($cntrecordsts_mst > 0){
                            echo "<ul class='nav nav-treeview'>";
                            while($rowordsts_mst=mysqli_fetch_assoc($srsordsts_mst)){
                             $ordstsm_id	= $rowordsts_mst['ordstsm_id'];
                            $ordstsm_name	= $rowordsts_mst['ordstsm_name'];
                            ?>
                              
                              <li><a href='vw_all_orders.php?ststyp=<?php echo $ordstsm_id; ?>' class="nav-link"> <i class="far fa-dot-circle nav-icon"></i> <p><?php echo $ordstsm_name; ?></p></a></li>
                              <?php
                            }
                            echo "</ul>";
                        }
                        ?>
                <li>
          
          

          <?php// }if((in_array(2,$sesvalary))|| $ses_admtyp == 'a'){ ?>
		   


          <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="far fa-user nav-icon"></i>
                  <p>
                  Members
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="view_all_members.php" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Members</p>
                    </a>
                  </li>
                  
                     <li class="nav-item">
                    <a href="view_all_crtprdcts.php" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Members Cart Products</p>
                    </a>
                  </li> -->
                  
                  
                  <!----<li class="nav-item">
                    <a href="vw_all_nwsltr.php" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Subscribers</p>
                    </a>
                  </li>--->
                 
               <!--  </ul>
              </li> -->
              <?php 		//if((in_array(3,$sesvalary))|| $ses_admtyp == 'a'){ ?>                              

          

              

              <?php //}if((in_array(4,$sesvalary))|| $ses_admtyp == 'a'){ ?>

          
          <?php //}if((in_array(4,$sesvalary))|| $ses_admtyp == 'a'){ ?>

          
          <?php //}} ?>

          
          
          
         
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                  My&nbsp;Account
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="change_password.php" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Change Password</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="logout.php" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Logout</p>
                    </a>
                  </li>
                 
                </ul>
              </li>
         
        <!--  <li class="nav-header">LABELS</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-danger"></i>
              <p class="text">Important</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-warning"></i>
              <p>Warning</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-info"></i>
              <p>Informational</p>
            </a>
          </li>-->
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
    <!-- /.content-header -->