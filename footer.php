<!-- <div id="loading-area" class="loading-page-1">
		<div class="spinner">
			<div class="ball"></div>
			<p>LOADING</p>
		</div>
	</div> -->
<!--------------------------------------------model signin---------->
<div class="modal " id="wishlistModal">

    <div class="modal-dialog ">

        <div class="modal-content text-center">

            <!-- Modal Header -->

            <div class="modal-header">

                <h4 class="modal-title"><i class="fas fa-heart"></i> Wishlist</h4>

                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>

            </div>

            <!-- Modal body -->

            <div class="modal-body">

                <span class="text-red2">You need to login to acccess your Wishlist. </span><br />

                <a class="btn btn-link text-dark btn-sm text-semibold" href="<?php echo $rtpth;?>signin">Login Now</a>
                <div class="clearfix"></div>

            </div>

            <!-- Modal footer -->

            <div class="modal-footer">

            </div>

        </div>

    </div>

</div>
<!---------------------------------------->
<div class="modal sh-modal" id="wishlistprdModal">

    <div class="modal-dialog modal-sm">

        <div class="modal-content text-center">

            <!-- Modal Header -->

            <div class="modal-header">

                <h4 class="modal-title"><i class="fas fa-heart"></i> Wishlist</h4>

                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>

            </div>

            <!-- Modal body -->

            <div class="modal-body">

                <div class="clearfix"></div>

                <span class="text-red2">Product Successfully added to <a
                        class="btn btn-link text-dark btn-sm text-semibold" href="<?php echo $rtpth;?>wishlist"
                        ;>your Wishlist</a> </span>

                <div class="clearfix"></div>

            </div>

            <div class="modal-footer">

            </div>

        </div>

    </div>

</div>



<div class="modal sh-modal" id="wishlistalrdyModal">



    <div class="modal-dialog modal-sm">



        <div class="modal-content text-center">







            <!-- Modal Header -->



            <div class="modal-header">



                <h4 class="modal-title"><i class="fas fa-heart"></i> Wishlist</h4>



                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>



            </div>







            <!-- Modal body -->



            <div class="modal-body">



                <span class="text-red2">This product is already in <a
                        class="btn btn-link text-dark btn-sm text-semibold" href="<?php echo $rtpth;?>wishlist"
                        ;>your Wishlist</a> </span>











                <div class="clearfix"></div>



            </div>







            <!-- Modal footer -->



            <div class="modal-footer">


            </div>







        </div>



    </div>



</div>

    <footer class="site-footer style-1" id="footer">
			<div class="footer-top">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-lg-3 col-md-6 col-sm-12 ">
							<div class="widget widget_about">
								<div class="footer-logo">
									<img src="images/logo.png" alt="">
								</div>
								<p>You’ve built best of the products. You’ve created best systems and processes to deliver what your customers are expecting of you.</p>
								<ul class="social-list style-1">
									<li><a href="https://www.youtube.com/" target="_blank"><i class="fab fa-youtube"></i></a></li>
									<li><a href="https://www.linkedin.com/" target="_blank"><i class="fab fa-linkedin"></i></a></li>
									<li><a href="https://twitter.com/" target="_blank"><i class="fab fa-twitter"></i></a></li>
									<li><a href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
									<li><a href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram"></i></a></li>
								</ul>
							</div>
						</div>
						<div class="col-lg-3 col-md-6 col-sm-6">
							<div class="widget widget_categories p-l50">
								<div class="widget-title">
									<h5 class="title">Quick Links</h5>
								</div>
								<ul>
									<li class="cat-item"><a href="<?php echo $rtpth ?>about-us">About us</a></li>
									<li class="cat-item"><a href="<?php echo $rtpth ?>">Car Tyres</a></li>
									<li class="cat-item"><a href="<?php echo $rtpth ?>">Bike Tyres</a></li>
									<li class="cat-item"><a href="<?php echo $rtpth ?>contact-us">Contact Us</a></li>
									
								</ul>
							</div>
						</div>
						<div class="col-lg-3 col-md-6 col-sm-6">
							<div class="widget widget_categories">
								<div class="widget-title">
									<h5 class="title">Policies</h5>
								</div>
								<ul>
								
								<li class="cat-item"><a href="<?php echo $rtpth ?>terms-and-conditions.php">Terms and Conditions</a></li>
								<li class="cat-item"><a href="<?php echo $rtpth ?>cancellation-and-refund-policy.php">Cancellation & Refund Policy</a></li>
								<li class="cat-item"><a href="<?php echo $rtpth ?>privacy-policy.php">Privacy Policy</a></li>
								<li class="cat-item"><a href="<?php echo $rtpth ?>disclaimer.php">Disclaimer</a></li>
								
								
								

								
								
									<!-- <li class="cat-item"><a href="<?php echo $rtpth ?>cancellation-policy.php">Cancellation Policy</a></li>
									<li class="cat-item"><a href="<?php echo $rtpth ?>privacy-policy.php">Privacy Policy</a></li>
									<li class="cat-item"><a href="<?php echo $rtpth ?>legal-disclaimer.php">Legal Disclaimer</a></li> -->
								</ul>
							</div>
						</div>
						<div class="col-lg-3 col-md-6 col-sm-12">
							<div class="widget">
								<div class="widget-title">
									<h5 class="title">Contact</h5>
								</div>
								<div class="icon-bx-wraper style-2 m-b20">
									<div class="icon-bx-sm radius">
										<span class="icon-cell">
											<svg width="23" height="25" viewBox="0 0 23 25" fill="none"
												xmlns="http://www.w3.org/2000/svg">
												<path
													d="M21.6675 23.3511H20.6854V1.97607C20.6854 1.35475 20.1578 0.851074 19.5068 0.851074H3.00684C2.35592 0.851074 1.82826 1.35475 1.82826 1.97607V23.3511H0.846122C0.520689 23.3511 0.256836 23.6029 0.256836 23.9136V24.8511H22.2568V23.9136C22.2568 23.6029 21.993 23.3511 21.6675 23.3511ZM6.54255 4.41357C6.54255 4.10293 6.8064 3.85107 7.13184 3.85107H9.09612C9.42155 3.85107 9.68541 4.10293 9.68541 4.41357V6.28857C9.68541 6.59922 9.42155 6.85107 9.09612 6.85107H7.13184C6.8064 6.85107 6.54255 6.59922 6.54255 6.28857V4.41357ZM6.54255 8.91357C6.54255 8.60293 6.8064 8.35107 7.13184 8.35107H9.09612C9.42155 8.35107 9.68541 8.60293 9.68541 8.91357V10.7886C9.68541 11.0992 9.42155 11.3511 9.09612 11.3511H7.13184C6.8064 11.3511 6.54255 11.0992 6.54255 10.7886V8.91357ZM9.09612 15.8511H7.13184C6.8064 15.8511 6.54255 15.5992 6.54255 15.2886V13.4136C6.54255 13.1029 6.8064 12.8511 7.13184 12.8511H9.09612C9.42155 12.8511 9.68541 13.1029 9.68541 13.4136V15.2886C9.68541 15.5992 9.42155 15.8511 9.09612 15.8511ZM12.8283 23.3511H9.68541V19.4136C9.68541 19.1029 9.94926 18.8511 10.2747 18.8511H12.239C12.5644 18.8511 12.8283 19.1029 12.8283 19.4136V23.3511ZM15.9711 15.2886C15.9711 15.5992 15.7073 15.8511 15.3818 15.8511H13.4176C13.0921 15.8511 12.8283 15.5992 12.8283 15.2886V13.4136C12.8283 13.1029 13.0921 12.8511 13.4176 12.8511H15.3818C15.7073 12.8511 15.9711 13.1029 15.9711 13.4136V15.2886ZM15.9711 10.7886C15.9711 11.0992 15.7073 11.3511 15.3818 11.3511H13.4176C13.0921 11.3511 12.8283 11.0992 12.8283 10.7886V8.91357C12.8283 8.60293 13.0921 8.35107 13.4176 8.35107H15.3818C15.7073 8.35107 15.9711 8.60293 15.9711 8.91357V10.7886ZM15.9711 6.28857C15.9711 6.59922 15.7073 6.85107 15.3818 6.85107H13.4176C13.0921 6.85107 12.8283 6.59922 12.8283 6.28857V4.41357C12.8283 4.10293 13.0921 3.85107 13.4176 3.85107H15.3818C15.7073 3.85107 15.9711 4.10293 15.9711 4.41357V6.28857Z"
													fill="white"></path>
											</svg>
										</span>
									</div>
									<div class="icon-content">
										<p>2-3-7, MG Road Secunderabad - 500 003</p>
									</div>
								</div>
								<div class="icon-bx-wraper style-2">
									<div class="icon-bx-sm radius">
										<span class="icon-cell">
											<svg width="22" height="24" viewBox="0 0 22 24" fill="none"
												xmlns="http://www.w3.org/2000/svg">
												<path
													d="M21.3722 16.9589L16.5597 14.7089C16.3541 14.6134 16.1257 14.5932 15.9087 14.6515C15.6917 14.7099 15.4979 14.8435 15.3566 15.0324L13.2254 17.873C9.88055 16.1526 7.18876 13.2161 5.61172 9.56722L8.21562 7.24222C8.38908 7.08832 8.51185 6.87696 8.56535 6.64014C8.61884 6.40331 8.60015 6.15392 8.51211 5.92972L6.44961 0.67973C6.35298 0.438047 6.18207 0.240721 5.96636 0.121777C5.75065 0.00283366 5.50366 -0.0302721 5.26797 0.0281687L0.799219 1.15317C0.571987 1.21041 0.36925 1.34999 0.224097 1.54911C0.0789444 1.74824 -5.2345e-05 1.99516 2.60228e-08 2.24957C2.60228e-08 14.273 8.9332 23.9995 19.9375 23.9995C20.1708 23.9997 20.3972 23.9136 20.5799 23.7552C20.7625 23.5969 20.8905 23.3756 20.943 23.1277L21.9742 18.2527C22.0274 17.9943 21.9965 17.7238 21.8866 17.4877C21.7767 17.2515 21.5948 17.0646 21.3722 16.9589Z"
													fill="white"></path>
											</svg>
										</span>
									</div>
									<div class="icon-content">
										<p>984 900 3100</p>
									</div>
								</div>

								
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Footer Bottom -->
			<div class="footer-bottom">
				<div class="container">
					<div class="row align-items-center fb-inner spno">
						<div class="col-12 text-center">
							<span class="copyright-text">Copyright © 2021 <a href="<?php echo $rtpth ?>"
									class="text-primary" target="_blank">Ashoka Tyres</a> All rights reserved.</span>
						</div>
					</div>
				</div>
			</div>
		</footer>
		<!-- Footer End -->
		<button class="scroltop icon-up" type="button"><i class="fas fa-arrow-up"></i></button>

<!-- JAVASCRIPT FILES ========================================= -->
<script src="<?php echo $rtpth ?>js/jquery.min.js"></script><!-- JQUERY.MIN JS -->
<script src="<?php echo $rtpth ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script><!-- BOOTSTRAP.MIN JS -->

<?php /*?><script src="<?php echo $rtpth ?>vendor/bootstrap-select/js/bootstrap-select.min.js"></script><?php */?><!-- BOOTSTRAP.MIN JS -->
<script src="<?php echo $rtpth ?>vendor/rangeslider/rangeslider.js"></script><!-- RANGESLIDER -->
<script src="<?php echo $rtpth ?>vendor/magnific-popup/magnific-popup.js"></script><!-- MAGNIFIC POPUP JS -->
<script src="<?php echo $rtpth ?>vendor/lightgallery/js/lightgallery-all.min.js"></script><!-- LIGHTGALLERY -->
<script src="<?php echo $rtpth ?>vendor/splitting/dist/splitting.min.js"></script><!-- Splitting -->
<script src="<?php echo $rtpth ?>vendor/counter/waypoints-min.js"></script><!-- WAYPOINTS JS -->
<script src="<?php echo $rtpth ?>vendor/counter/counterup.min.js"></script><!-- COUNTERUP JS -->
<script src="<?php echo $rtpth ?>vendor/swiper/swiper-bundle.min.js"></script><!-- OWL-CAROUSEL -->
<script src="<?php echo $rtpth ?>vendor/aos/aos.js"></script><!-- AOS -->

<!-- revolution JS FILES -->
<script src="<?php echo $rtpth ?>vendor/revolution/v5.4.3/js/jquery.themepunch.tools.min.js"></script>
<script src="<?php echo $rtpth ?>vendor/revolution/v5.4.3/js/jquery.themepunch.revolution.min.js"></script>
<!-- Slider revolution 5.0 Extensions  (Load Extensions only on Local File Systems !  The following part can be removed on Server for On Demand Loading) -->
<script src="<?php echo $rtpth ?>vendor/revolution/v5.4.3/js/extensions/revolution.extension.actions.min.js"></script>
<script src="<?php echo $rtpth ?>vendor/revolution/v5.4.3/js/extensions/revolution.extension.carousel.min.js"></script>
<script src="<?php echo $rtpth ?>vendor/revolution/v5.4.3/js/extensions/revolution.extension.kenburn.min.js"></script>
<script src="<?php echo $rtpth ?>vendor/revolution/v5.4.3/js/extensions/revolution.extension.layeranimation.min.js"></script>
<script src="<?php echo $rtpth ?>vendor/revolution/v5.4.3/js/extensions/revolution.extension.migration.min.js"></script>
<script src="<?php echo $rtpth ?>vendor/revolution/v5.4.3/js/extensions/revolution.extension.parallax.min.js"></script>
<script src="<?php echo $rtpth ?>vendor/revolution/v5.4.3/js/extensions/revolution.extension.video.min.js"></script>
<script src="<?php echo $rtpth ?>vendor/revolution/v5.4.3/js/extensions/revolution.extension.slideanims.min.js"></script>

<script src="<?php echo $rtpth ?>vendor/masonry/isotope.pkgd.min.js"></script><!-- ISOTOPE -->
<script  src="<?php echo $rtpth ?>js/rev.slider.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="<?php echo $rtpth ?>js/dlab.carousel.js"></script><!-- OWL-CAROUSEL -->
<script src="<?php echo $rtpth ?>js/dlab.ajax.js"></script><!-- AJAX -->
<script src="<?php echo $rtpth ?>js/custom.js"></script><!-- CUSTOM JS -->
<?php /*?><script src="<?php echo $rtpth ?>vendor/bootstrap-select/js/bootstrap-select.min.js"></script><?php */?><!-- BOOTSTRAP.MIN JS -->
	<script src="<?php echo $rtpth ?>vendor/rangeslider/rangeslider.js"></script><!-- RANGESLIDER -->
	<script src="<?php echo $rtpth ?>vendor/magnific-popup/magnific-popup.js"></script><!-- MAGNIFIC POPUP JS -->
	<script src="<?php echo $rtpth ?>vendor/masonry/isotope.pkgd.min.js"></script><!-- ISOTOPE -->
	<script src="<?php echo $rtpth ?>vendor/imagesloaded/imagesloaded.js"></script><!-- IMAGESLOADED -->
	<script src="<?php echo $rtpth ?>vendor/masonry/masonry-4.2.2.js"></script><!-- MASONRY -->
	<script src="<?php echo $rtpth ?>vendor/lightgallery/js/lightgallery-all.min.js"></script><!-- LIGHTGALLERY -->
	<script src="<?php echo $rtpth ?>vendor/splitting/dist/splitting.min.js"></script><!-- Splitting -->
	<script src="<?php echo $rtpth ?>vendor/counter/waypoints-min.js"></script><!-- WAYPOINTS JS -->
	<script src="<?php echo $rtpth ?>vendor/counter/counterup.min.js"></script><!-- COUNTERUP JS -->
	<script src="<?php echo $rtpth ?>vendor/swiper/swiper-bundle.min.js"></script><!-- OWL-CAROUSEL -->
	<script src="<?php echo $rtpth ?>vendor/aos/aos.js"></script><!-- AOS -->
	<script src="<?php echo $rtpth ?>js/dlab.carousel.js"></script><!-- OWL-CAROUSEL -->
	<script src="<?php echo $rtpth ?>js/dlab.ajax.js"></script><!-- AJAX -->
	<script src="<?php echo $rtpth ?>js/custom.js"></script><!-- CUSTOM JS -->

<?php include('includes/inc_fnct_ajax_validation.php') ;?>

<script>
	jQuery(document).ready(function() {
		'use strict';
		dz_rev_slider_4();	
	});	/*ready*/
</script>

<script type="text/javascript">
	$('.prdt-views-owl').owlCarousel({
    loop:true,
    margin:10,
    nav:false,
    dots:true,
     autoPlay: true,
  singleItem: true,
  animateIn: 'fadeIn', 
  animateOut: 'fadeOut' ,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    }
})
</script>

<script type="text/javascript">
	$('.also-like-owl').owlCarousel({
    loop:true,
    margin:10,
    nav:false,
    dots:true,
     autoPlay: true,
  singleItem: true,
  animateIn: 'fadeIn', 
  animateOut: 'fadeOut' ,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        1000:{
            items:3
        }
    }
})
</script>

<script type="text/javascript">
		$(document).ready(function() {
			$('.minus').click(function () {
				var $input = $(this).parent().find('input');
				var count = parseInt($input.val()) - 1;
				count = count < 1 ? 1 : count;
				$input.val(count);
				$input.change();
				return false;
			});
			$('.plus').click(function () {
				var $input = $(this).parent().find('input');
				$input.val(parseInt($input.val()) + 1);
				$input.change();
				return false;
			});
		});
</script>