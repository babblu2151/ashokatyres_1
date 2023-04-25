<ul id="nav">
  <li><a href="main.php">Home</a></li>
  <li><a href="#">Setup</a>
    <ul>
      <li><a href="#">Product Group</a>
        <ul>
          <!--   <li><a href="view_product_main.php">Main Category</a></li>-->
          <li><a href="view_product_category.php">Category</a></li>
          <li><a href="view_product_subcategory.php">Subcategory</a></li>
          <li><a href="view_all_clrmaster.php">Color</a></li>
          <!--	<li><a href="view_all_mtrlmaster.php">Material</a></li>-->
          <li><a href="view_all_fabric.php">Farbic</a></li>
          <li><a href="view_all_sizemaster.php">Size</a></li>
          <!--  <li><a href="view_all_sizedtl.php">Size Details</a></li>-->
          <li><a href="view_all_pincode.php">Pin Codes</a></li>
        </ul>
      </li>
      <!--<li><a href="#">Shop Category Images</a>
        <ul>
          <li><a href="vw_all_cat.php?cat=1">Category 1</a></li>
          <li><a href="vw_all_cat.php?cat=2">Category 2</a></li>
          <li><a href="vw_all_cat.php?cat=3">Category 3</a></li>
          <li><a href="vw_all_cat.php?cat=4">Category 4</a></li>
        </ul>
      </li>
      <li><a href="#">Shop Category Images</a>
        <ul>
          <li><a href="vw_all_cat.php?cat=1">Category 1</a></li>
          <li><a href="vw_all_cat.php?cat=2">Category 2</a></li>
          <li><a href="vw_all_cat.php?cat=3">Category 3</a></li>
          <li><a href="vw_all_cat.php?cat=4">Category 4</a></li>
        </ul>
      </li>
      <li><a href="vw_all_pooja.php">Pooja Details</a></li>
      <li><a href="vw_all_publishers.php">Publishers</a></li>-->
      <li><a href="view_all_shpng.php">Shipping</a></li>
      <!--<li><a href="view_all_cod.php">COD</a></li>-->
      <li><a href="#">Location</a>
        <ul>
          <li><a href="vw_all_country.php">Country</a></li>
          <li><a href="vw_all_county.php">State</a>
            <!--<ul>
              <li><a href="vw_all_county.php">Verified</a></li>
              <li><a href="vw_all_verifycounty.php">Not Verified</a></li>
            </ul>-->
          </li>
          <li><a href="vw_all_city.php">City</a>
            <!--<ul>
              <li><a href="vw_all_city.php">Verified</a></li>
              <li><a href="vw_all_verifycity.php">Not Verified</a></li>
            </ul>-->
          </li>
          <!--<li><a href="vw_all_pincodes.php">Pin Code</a></li>-->
        </ul>
      </li>
      <li><a href="view_all_alteration.php">Alteration</a></li>
      <li><a href="view_all_dolr.php">Dollar</a></li>
      <li><a href="vw_all_banners.php">Banner</a></li>
      <li><a href="vw_all_testimonial.php">Testimonials</a></li>
      <!-- <li><a href="vw_all_photos.php">Photo Gallery</a></li> -->
      <li><a href="view_all_ordsts.php">Order Status</a></li>
    </ul>
  </li>	
  <!--<li><a href="vw_all_products.php">Products</a></li>-->
  <li><a href="#">Products</a>
    <ul>
      <li><a href="vw_all_products.php">Products</a></li>
      <li><a href="add-prdprc-bulk.php">Product Add Bulk</a></li>
      <li><a href="edit-prdprc-bulk.php">Product Edit Bulk</a></li>
    </ul>
  </li>
  <!--  <li><a href="vw_all_photos.php">Gallery</a>
    <ul>
      <li><a href="vw_all_photos.php">Photo Gallery</a></li>
      <li><a href="vw_all_videos.php">Video Gallery</a></li>
    </ul>-->
  </li>
  <li><a href="#">Coupons</a>
    <ul>
      <li><a href="vw_all_cupns.php">Coupons</a></li>
      <!--  <li><a href="vw_all_odr_cupns.php">Order Coupons</a></li> -->
    </ul>
  </li>
  <!-- <li><a href="view_all_notify.php">Notify</a></li>-->
  <li><a href="#">Members</a>
    <ul>
      <li><a href="vw_all_members.php">Members</a></li>
      <li><a href="vw_all_nwsltr.php">Subscribers</a></li>
    </ul>
  </li>
  <li><a href="#">Reports</a>
    <ul>
      <li><a href="#">Orders Report</a>
        <ul>
          <?php
          $ordall= "";
          $ord_main ='';
          $sqryordsts_mst="SELECT ordstsm_id,ordstsm_name from ordsts_mst where ordstsm_sts='a' group by ordstsm_id order by ordstsm_prty desc";
          $srsordsts_mst = mysqli_query($conn,$sqryordsts_mst);
          $cntrecordsts_mst	= mysqli_num_rows($srsordsts_mst);
          if($cntrecordsts_mst > 0)
          {
            echo "<li>";
            while($rowordsts_mst=mysqli_fetch_assoc($srsordsts_mst))
            {
              $ordstsm_id	= $rowordsts_mst['ordstsm_id'];
              $ordstsm_name	= $rowordsts_mst['ordstsm_name'];
              echo "<li><a href='vw_all_orders.php?ststyp=$ordstsm_id'>$ordstsm_name</a></li>";
            }
            echo "</li>";
          }
          ?>
        </ul>
      </li>
      <!-- <li><a href="vw_all_ord_products.php">Product Sale Report</a></li> -->
    </ul>
  </li>
  <!--<li><a href="#">Orders</a>
    <?php
    $ordall= "";
    $ord_main ='';
    $sqryordsts_mst="SELECT ordstsm_id,ordstsm_name from ordsts_mst where ordstsm_sts='a' group by ordstsm_id order by ordstsm_prty desc";
    $srsordsts_mst = mysqli_query($conn,$sqryordsts_mst);
    $cntrecordsts_mst	= mysqli_num_rows($srsordsts_mst);
    if($cntrecordsts_mst > 0)
    {
      echo "<ul>";
      while($rowordsts_mst=mysqli_fetch_assoc($srsordsts_mst))
      {
        $ordstsm_id	= $rowordsts_mst['ordstsm_id'];
        $ordstsm_name	= $rowordsts_mst['ordstsm_name'];
        echo "<li><a href='vw_all_orders.php?ststyp=$ordstsm_id'>$ordstsm_name</a></li>";
      }
      echo "</ul>";
    }
    ?>
  </li>-->
  <!--<li><a href="size-grid.php">Size Grid</a></li>-->
  <li>
    <a href="#">My&nbsp;Account</a>
    <ul>
      <li><a href="change_password.php">Change Password</a></li>
      <li><a href="logout.php">Logout</a></li>
    </ul>
  </li>
  <!-- <li><a href="size-grid.php">Sizes Grid</a></li>	-->
</ul>