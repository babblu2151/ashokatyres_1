<?php
    $page_title = "Product  Tyre Brand | Home";
    $page_seo_title = "Product  Tyre Brand | Home";
    $db_seokywrd = "";
    $db_seodesc = "";
    $current_page = "home";
    $body_class = "homepage";
    include('header.php');
    ?>


<div class="page-content bg-white">
    <!-- Banner  -->
    <div class="dlab-bnr-inr style-1 overlay-black-middle" style="background-image: url(images/banner/bnr1.jpg);">
        <div class="container">
            <div class="dlab-bnr-inr-entry">
                <h1 class="text-white">Product Tyre Brand</h1>

                <div class="d-flex justify-content-center align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Product Tyre Brand</li>
                        </ol>
                    </nav>
                </div>

            </div>
        </div>
    </div>

    <section class="custom-selection py-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-10-col-12">
                    <h3>Tyre Brand</h3>
                    <p>You have selected <span>CEAT</span></p>

                    <form action="">
                        <div class="form-group m-b20">
                            <select class="form-control">
                                <option>Choose Vehicle Brand</option>
                                <option value="47" data-select2-id="391">Brand 1</option>
                                <option value="47" data-select2-id="391">Brand 2</option>
                                <option value="47" data-select2-id="391">Brand 3</option>
                                <option value="47" data-select2-id="391">Brand 4</option>
                                <option value="47" data-select2-id="391">Brand 5</option>
                            </select>
                        </div>

                        <div class="form-group m-b20">
                            <select class="form-control">
                                <option>Choose Size</option>
                                <option value="47" data-select2-id="391">Size 1</option>
                                <option value="47" data-select2-id="391">Size 2</option>
                                <option value="47" data-select2-id="391">Size 3</option>
                                <option value="47" data-select2-id="391">Size 4</option>
                                <option value="47" data-select2-id="391">Size 5</option>
                            </select>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </section>


    <section class="content-inner-2">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-3 m-b30">
                    <aside class="side-bar sticky-top left">
                        <div class="section-head">
                            <h4 class="title">ADVANCED SEARCH</h4>
                            <div class="dlab-separator style-1 text-primary mb-0"></div>
                        </div>
                        <form>
                            <div class="widget widget_search">
                                <div class="form-group search-bx m-b20">
                                    <div class="input-group">
                                        <input name="text" class="form-control" placeholder="Enter your keywords..."
                                            type="text">
                                        <span class="input-group-btn">
                                            <button type="submit" class="btn shadow-none"><i
                                                    class="la la-search scale3"></i></button>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group m-b20">
                                    <select class="form-control">
                                        <option>Choose by Brand</option>
                                        <option value="47" data-select2-id="391">Audi</option>
                                        <option value="2242" data-select2-id="392">BMW</option>
                                        <option value="2410" data-select2-id="393">Chevrolet</option>
                                        <option value="4417" data-select2-id="394">Citroen</option>
                                        <option value="2400" data-select2-id="395">Datsun</option>
                                        <option value="1548" data-select2-id="396">Fiat</option>
                                        <option value="2402" data-select2-id="397">Force</option>
                                        <option value="75" data-select2-id="398">Ford</option>
                                        <option value="101" data-select2-id="399">Honda</option>
                                        <option value="163" data-select2-id="400">Hyundai</option>
                                        <option value="3392" data-select2-id="401">Isuzu Motors</option>
                                        <option value="2389" data-select2-id="402">Jaguar</option>
                                        <option value="3137" data-select2-id="403">Jeep</option>
                                        <option value="2396" data-select2-id="404">KIA</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="form-control">
                                        <option>Choose by Vehicle</option>
                                        <option>First</option>
                                        <option>Luxury</option>
                                    </select>
                                </div>
                            </div>


                            <div class="widget widget_price_range">
                                <h5>Price range</h5>
                                <div class="price-slide range-slider">
                                    <div class="price">
                                        <label for="amount"></label>
                                        <input type="text" id="amount" class="amount me-auto" readonly=""
                                            value="$200 - $5000" />
                                        <div id="slider-range" class="mt-2"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="widget">

                                <div class="form-group">
                                    <a href="javascript:void(0);"
                                        class="btn btn-lg shadow-none btn-primary d-flex justify-content-between">
                                        Find Tyres<i class="las la-long-arrow-alt-right"></i>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </aside>
                </div>
                <div class="col-xl-9 col-lg-9">
                    <div class="catagory-result-row">
                        <h5 class="serch-result">Showing <strong>8 product from 40</strong></h5>
                        <div>Sort by
                            <select class="form-control custom-select ms-3">
                                <option>Newest</option>
                                <option>Price: Lowest first</option>
                                <option>Price: Highest first </option>
                                <option>Product Name: A to Z </option>
                                <option>Product Name: Z to A </option>
                                <option>In stock</option>
                            </select>
                        </div>
                    </div>
                    <div class="row lightgallery">

                        <div class="col-lg-4 col-md-4 col-sm-6 col-12 m-b30">
                            <div class="car-list-box list-view">
                                <div class="media-box">
                                    <img src="images/product/grid/pic1.jpg" alt="">
                                    <div class="overlay-bx">
                                        <span data-exthumbimage="images/product/grid/pic1.jpg"
                                            data-src="images/product/grid/pic1.jpg" class="view-btn lightimg">

                                        </span>
                                    </div>
                                </div>
                                <div class="list-info">
                                    <h6 class="title mb-0"><a href="product-display.php" data-splitting
                                            class="text-white">Goodyear 205/55 R16 Eagle NCT5 91V Tubeless Car Tyre</a>
                                    </h6>
                                    <div class="car-type">Sku: CE2356517ZATL</div>

                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="badge m-b10 mr-rt-5"><span>₹</span>8,299.00</span>
                                        <a href="product-display.php"
                                            class="m-b10 view-details-btn btn btn-primary light phone-no shadow-none effect-1 w-100 text-center d-block"><span>Details</span></a>

                                    </div>


                                    <!-- <div class="prdt-spec custom-bottom">
    										<div class="d-flex justify-content-between align-items-center custom-tooltip">
    											<div class="tooltip-main wrap-1 mr-rt-5">
    												<div class="pr-spec">
    													<span>Product Specifications</span>
    												</div>
    											</div>
    											<div class="tooltip-main wrap-2">
    												<div class="pr-spec">
    													<span>Vehicle Compatibility</span>
    												</div>
    											</div>
    										</div>
    									</div> -->
                                    <div class="prdt-prop mt-2">
                                        <div class="d-flex justify-content-stretch align-items-center">
                                            <div class="mr-rt-5">
                                                <div class="prop-container">
                                                    <p>Low Noise</p>
                                                    <i class="fas fa-volume-down"></i>
                                                </div>
                                            </div>
                                            <div class="mr-rt-5">
                                                <div class="prop-container">
                                                    <p>Smooth Ride</p>
                                                    <i class="fas fa-car-side"></i>
                                                </div>
                                            </div>
                                            <div class="">
                                                <div class="prop-container">
                                                    <p>Dry & Wet Grip</p>
                                                    <i class="fas fa-cloud"></i>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-6 col-12 m-b30">
                            <div class="car-list-box list-view">
                                <div class="media-box">
                                    <img src="images/product/grid/pic2.jpg" alt="">
                                    <div class="overlay-bx">
                                        <span data-exthumbimage="images/product/grid/pic2.jpg"
                                            data-src="images/product/grid/pic1.jpg" class="view-btn lightimg">

                                        </span>
                                    </div>
                                </div>
                                <div class="list-info">
                                    <h6 class="title mb-0"><a href="product-display.php" data-splitting
                                            class="text-white">Goodyear 205/55 R16 Eagle NCT5 91V Tubeless Car Tyre</a>
                                    </h6>
                                    <div class="car-type">Sku: CE2356517ZATL</div>

                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="badge m-b10 mr-rt-5"><span>₹</span>8,299.00</span>
                                        <a href="product-display.php"
                                            class="m-b10 view-details-btn btn btn-primary light phone-no shadow-none effect-1 w-100 text-center d-block"><span>Details</span></a>

                                    </div>


                                    <!-- <div class="prdt-spec custom-bottom">
    										<div class="d-flex justify-content-between align-items-center custom-tooltip">
    											<div class="tooltip-main wrap-1 mr-rt-5">
    												<div class="pr-spec">
    													<span>Product Specifications</span>
    												</div>
    											</div>
    											<div class="tooltip-main wrap-2">
    												<div class="pr-spec">
    													<span>Vehicle Compatibility</span>
    												</div>
    											</div>
    										</div>
    									</div> -->
                                    <div class="prdt-prop mt-2">
                                        <div class="d-flex justify-content-stretch align-items-center">
                                            <div class="mr-rt-5">
                                                <div class="prop-container">
                                                    <p>Low Noise</p>
                                                    <i class="fas fa-volume-down"></i>
                                                </div>
                                            </div>
                                            <div class="mr-rt-5">
                                                <div class="prop-container">
                                                    <p>Smooth Ride</p>
                                                    <i class="fas fa-car-side"></i>
                                                </div>
                                            </div>
                                            <div class="">
                                                <div class="prop-container">
                                                    <p>Dry & Wet Grip</p>
                                                    <i class="fas fa-cloud"></i>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-6 col-12 m-b30">
                            <div class="car-list-box list-view">
                                <div class="media-box">
                                    <img src="images/product/grid/pic3.jpg" alt="">
                                    <div class="overlay-bx">
                                        <span data-exthumbimage="images/product/grid/pic3.jpg"
                                            data-src="images/product/grid/pic1.jpg" class="view-btn lightimg">

                                        </span>
                                    </div>
                                </div>
                                <div class="list-info">
                                    <h6 class="title mb-0"><a href="product-display.php" data-splitting
                                            class="text-white">Goodyear 205/55 R16 Eagle NCT5 91V Tubeless Car Tyre</a>
                                    </h6>
                                    <div class="car-type">Sku: CE2356517ZATL</div>

                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="badge m-b10 mr-rt-5"><span>₹</span>8,299.00</span>
                                        <a href="product-display.php"
                                            class="m-b10 view-details-btn btn btn-primary light phone-no shadow-none effect-1 w-100 text-center d-block"><span>Details</span></a>

                                    </div>


                                    <!-- <div class="prdt-spec custom-bottom">
    										<div class="d-flex justify-content-between align-items-center custom-tooltip">
    											<div class="tooltip-main wrap-1 mr-rt-5">
    												<div class="pr-spec">
    													<span>Product Specifications</span>
    												</div>
    											</div>
    											<div class="tooltip-main wrap-2">
    												<div class="pr-spec">
    													<span>Vehicle Compatibility</span>
    												</div>
    											</div>
    										</div>
    									</div> -->
                                    <div class="prdt-prop mt-2">
                                        <div class="d-flex justify-content-stretch align-items-center">
                                            <div class="mr-rt-5">
                                                <div class="prop-container">
                                                    <p>Low Noise</p>
                                                    <i class="fas fa-volume-down"></i>
                                                </div>
                                            </div>
                                            <div class="mr-rt-5">
                                                <div class="prop-container">
                                                    <p>Smooth Ride</p>
                                                    <i class="fas fa-car-side"></i>
                                                </div>
                                            </div>
                                            <div class="">
                                                <div class="prop-container">
                                                    <p>Dry & Wet Grip</p>
                                                    <i class="fas fa-cloud"></i>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>


                        <div class="col-lg-4 col-md-4 col-sm-6 col-12 m-b30">
                            <div class="car-list-box list-view">
                                <div class="media-box">
                                    <img src="images/product/grid/pic1.jpg" alt="">
                                    <div class="overlay-bx">
                                        <span data-exthumbimage="images/product/grid/pic1.jpg"
                                            data-src="images/product/grid/pic1.jpg" class="view-btn lightimg">

                                        </span>
                                    </div>
                                </div>
                                <div class="list-info">
                                    <h6 class="title mb-0"><a href="product-display.php" data-splitting
                                            class="text-white">Goodyear 205/55 R16 Eagle NCT5 91V Tubeless Car Tyre</a>
                                    </h6>
                                    <div class="car-type">Sku: CE2356517ZATL</div>

                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="badge m-b10 mr-rt-5"><span>₹</span>8,299.00</span>
                                        <a href="product-display.php"
                                            class="m-b10 view-details-btn btn btn-primary light phone-no shadow-none effect-1 w-100 text-center d-block"><span>Details</span></a>

                                    </div>


                                    <!-- <div class="prdt-spec custom-bottom">
    										<div class="d-flex justify-content-between align-items-center custom-tooltip">
    											<div class="tooltip-main wrap-1 mr-rt-5">
    												<div class="pr-spec">
    													<span>Product Specifications</span>
    												</div>
    											</div>
    											<div class="tooltip-main wrap-2">
    												<div class="pr-spec">
    													<span>Vehicle Compatibility</span>
    												</div>
    											</div>
    										</div>
    									</div> -->
                                    <div class="prdt-prop mt-2">
                                        <div class="d-flex justify-content-stretch align-items-center">
                                            <div class="mr-rt-5">
                                                <div class="prop-container">
                                                    <p>Low Noise</p>
                                                    <i class="fas fa-volume-down"></i>
                                                </div>
                                            </div>
                                            <div class="mr-rt-5">
                                                <div class="prop-container">
                                                    <p>Smooth Ride</p>
                                                    <i class="fas fa-car-side"></i>
                                                </div>
                                            </div>
                                            <div class="">
                                                <div class="prop-container">
                                                    <p>Dry & Wet Grip</p>
                                                    <i class="fas fa-cloud"></i>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>


                        <div class="col-lg-4 col-md-4 col-sm-6 col-12 m-b30">
                            <div class="car-list-box list-view">
                                <div class="media-box">
                                    <img src="images/product/grid/pic2.jpg" alt="">
                                    <div class="overlay-bx">
                                        <span data-exthumbimage="images/product/grid/pic1.jpg"
                                            data-src="images/product/grid/pic1.jpg" class="view-btn lightimg">

                                        </span>
                                    </div>
                                </div>
                                <div class="list-info">
                                    <h6 class="title mb-0"><a href="product-display.php" data-splitting
                                            class="text-white">Goodyear 205/55 R16 Eagle NCT5 91V Tubeless Car Tyre</a>
                                    </h6>
                                    <div class="car-type">Sku: CE2356517ZATL</div>

                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="badge m-b10 mr-rt-5"><span>₹</span>8,299.00</span>
                                        <a href="product-display.php"
                                            class="m-b10 view-details-btn btn btn-primary light phone-no shadow-none effect-1 w-100 text-center d-block"><span>Details</span></a>

                                    </div>


                                    <!-- <div class="prdt-spec custom-bottom">
    										<div class="d-flex justify-content-between align-items-center custom-tooltip">
    											<div class="tooltip-main wrap-1 mr-rt-5">
    												<div class="pr-spec">
    													<span>Product Specifications</span>
    												</div>
    											</div>
    											<div class="tooltip-main wrap-2">
    												<div class="pr-spec">
    													<span>Vehicle Compatibility</span>
    												</div>
    											</div>
    										</div>
    									</div> -->
                                    <div class="prdt-prop mt-2">
                                        <div class="d-flex justify-content-stretch align-items-center">
                                            <div class="mr-rt-5">
                                                <div class="prop-container">
                                                    <p>Low Noise</p>
                                                    <i class="fas fa-volume-down"></i>
                                                </div>
                                            </div>
                                            <div class="mr-rt-5">
                                                <div class="prop-container">
                                                    <p>Smooth Ride</p>
                                                    <i class="fas fa-car-side"></i>
                                                </div>
                                            </div>
                                            <div class="">
                                                <div class="prop-container">
                                                    <p>Dry & Wet Grip</p>
                                                    <i class="fas fa-cloud"></i>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>


                        <div class="col-lg-4 col-md-4 col-sm-6 col-12 m-b30">
                            <div class="car-list-box list-view">
                                <div class="media-box">
                                    <img src="images/product/grid/pic3.jpg" alt="">
                                    <div class="overlay-bx">
                                        <span data-exthumbimage="images/product/grid/pic1.jpg"
                                            data-src="images/product/grid/pic1.jpg" class="view-btn lightimg">

                                        </span>
                                    </div>
                                </div>
                                <div class="list-info">
                                    <h6 class="title mb-0"><a href="product-display.php" data-splitting
                                            class="text-white">Goodyear 205/55 R16 Eagle NCT5 91V Tubeless Car Tyre</a>
                                    </h6>
                                    <div class="car-type">Sku: CE2356517ZATL</div>

                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="badge m-b10 mr-rt-5"><span>₹</span>8,299.00</span>
                                        <a href="product-display.php"
                                            class="m-b10 view-details-btn btn btn-primary light phone-no shadow-none effect-1 w-100 text-center d-block"><span>Details</span></a>

                                    </div>


                                    <!-- <div class="prdt-spec custom-bottom">
    										<div class="d-flex justify-content-between align-items-center custom-tooltip">
    											<div class="tooltip-main wrap-1 mr-rt-5">
    												<div class="pr-spec">
    													<span>Product Specifications</span>
    												</div>
    											</div>
    											<div class="tooltip-main wrap-2">
    												<div class="pr-spec">
    													<span>Vehicle Compatibility</span>
    												</div>
    											</div>
    										</div>
    									</div> -->
                                    <div class="prdt-prop mt-2">
                                        <div class="d-flex justify-content-stretch align-items-center">
                                            <div class="mr-rt-5">
                                                <div class="prop-container">
                                                    <p>Low Noise</p>
                                                    <i class="fas fa-volume-down"></i>
                                                </div>
                                            </div>
                                            <div class="mr-rt-5">
                                                <div class="prop-container">
                                                    <p>Smooth Ride</p>
                                                    <i class="fas fa-car-side"></i>
                                                </div>
                                            </div>
                                            <div class="">
                                                <div class="prop-container">
                                                    <p>Dry & Wet Grip</p>
                                                    <i class="fas fa-cloud"></i>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>


                        <div class="col-lg-4 col-md-4 col-sm-6 col-12 m-b30">
                            <div class="car-list-box list-view">
                                <div class="media-box">
                                    <img src="images/product/grid/pic1.jpg" alt="">
                                    <div class="overlay-bx">
                                        <span data-exthumbimage="images/product/grid/pic1.jpg"
                                            data-src="images/product/grid/pic1.jpg" class="view-btn lightimg">

                                        </span>
                                    </div>
                                </div>
                                <div class="list-info">
                                    <h6 class="title mb-0"><a href="product-display.php" data-splitting
                                            class="text-white">Goodyear 205/55 R16 Eagle NCT5 91V Tubeless Car Tyre</a>
                                    </h6>
                                    <div class="car-type">Sku: CE2356517ZATL</div>

                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="badge m-b10 mr-rt-5"><span>₹</span>8,299.00</span>
                                        <a href="product-display.php"
                                            class="m-b10 view-details-btn btn btn-primary light phone-no shadow-none effect-1 w-100 text-center d-block"><span>Details</span></a>

                                    </div>


                                    <!-- <div class="prdt-spec custom-bottom">
    										<div class="d-flex justify-content-between align-items-center custom-tooltip">
    											<div class="tooltip-main wrap-1 mr-rt-5">
    												<div class="pr-spec">
    													<span>Product Specifications</span>
    												</div>
    											</div>
    											<div class="tooltip-main wrap-2">
    												<div class="pr-spec">
    													<span>Vehicle Compatibility</span>
    												</div>
    											</div>
    										</div>
    									</div> -->
                                    <div class="prdt-prop mt-2">
                                        <div class="d-flex justify-content-stretch align-items-center">
                                            <div class="mr-rt-5">
                                                <div class="prop-container">
                                                    <p>Low Noise</p>
                                                    <i class="fas fa-volume-down"></i>
                                                </div>
                                            </div>
                                            <div class="mr-rt-5">
                                                <div class="prop-container">
                                                    <p>Smooth Ride</p>
                                                    <i class="fas fa-car-side"></i>
                                                </div>
                                            </div>
                                            <div class="">
                                                <div class="prop-container">
                                                    <p>Dry & Wet Grip</p>
                                                    <i class="fas fa-cloud"></i>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>




                    </div>

                    <nav aria-label="Blog Pagination">
                        <ul class="pagination text-center m-b30">
                            <li class="page-item"><a class="page-link prev" href="javascript:void(0);"><i
                                        class="la la-angle-left"></i></a></li>
                            <li class="page-item"><a class="page-link active" href="javascript:void(0);">1</a></li>
                            <li class="page-item"><a class="page-link" href="javascript:void(0);">2</a></li>
                            <li class="page-item"><a class="page-link" href="javascript:void(0);">3</a></li>
                            <li class="page-item"><a class="page-link next" href="javascript:void(0);"><i
                                        class="la la-angle-right"></i></a></li>
                        </ul>
                    </nav>

                </div>

            </div>
        </div>
</div>
</section>





</div>




<?php include_once('footer.php'); ?>