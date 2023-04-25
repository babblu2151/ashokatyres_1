<?php
           
			include_once "includes/inc_membr_session.php";//checking for session	
			include_once 'includes/inc_nocache.php'; // Clearing the cache information
            include_once 'includes/inc_connection.php';//Make connection with the database  	
            include_once "includes/inc_config.php";	//path config file
		    include_once "includes/inc_usr_functions.php";//Including user session value
	global $gmsg,$email;		
	

	 $membrid   = $_SESSION['sesmbrid'];	

	


$page_title = "Order List";
$page_seo_title = "Oder List";
$db_seokywrd = "";
$db_seodesc = "";
$current_page = "oder-list";
$body_class = "oder-list";
include('header.php');
?>


<div class="page-content bg-white"> 
  <!-- Banner  -->
  <div class="dlab-bnr-inr short-banner style-1 overlay-black-middle"
        style="background-image: url(<?php echo $rtpth;?>images/banner/bnr1.jpg);">
    <div class="container">
      <div class="dlab-bnr-inr-entry">
        <h1 class="text-white"><?php echo $page_title  ?></h1>
        <div class="d-flex justify-content-center align-items-center">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo $rtpth;?>">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page"><?php echo $page_title  ?></li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
  <!-- Banner End --> 
  
  <!-- Demo header-->
  <section class="py-4 header ac-pages-style">
    <div class="container py-4">
      <div class="row">
        <div class="col-md-3"> 
          <!-- Tabs nav -->
        <?php  include('acc_leftlinks.php'); ?>
        </div>
        <div class="col-md-9"> 
          <!-- Tabs content -->
         
         
        
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th class="">Order Id</th>
                      <th class="">Total Amount</th>
                      <th class="">Payment Mode</th>
                      <th class="">No. Items</th>
                      <th class="">Order Date</th>
                      <th class="">Payment status</th>
                      <th class="">Order status</th>
                      <th class="">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">1</th>
                      <td>400</td>
                      <td>Online</td>
                      <td>2</td>
                      <td>02-11-2021 05:09:06</td>
                      <td>Yes</td>
                      <td align="center"><a
                                                    class="btn btn-primary btn-sm text-white">Delivered</a></td>
                      <td align="center"><a class="btn btn-primary btn-sm" href="#">View</a></td>
                    </tr>
                    <tr>
                      <th scope="row">1</th>
                      <td>400</td>
                      <td>Online</td>
                      <td>2</td>
                      <td>02-11-2021 05:09:06</td>
                      <td>Yes</td>
                      <td align="center"><a
                                                    class="btn btn-primary btn-sm text-white">Delivered</a></td>
                      <td align="center"><a class="btn btn-primary btn-sm" href="#">View</a></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
         
       
      </div>
    </div>
  </section>
  

  
</div>

<?php include_once('footer.php'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>