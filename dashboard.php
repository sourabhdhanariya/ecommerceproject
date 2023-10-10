


<?php include 'header.php' ?>
<?php include 'sidebar.php' ?>
<?php

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// Display dashboard content for logged-in users
?>

<div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">

                                    <div class="page-body">
                                      <div class="row">

                                            <!-- order-card start -->
                                            <div class="col-md-6 col-xl-2 margin">
                                                <div class="card bg-c-blue order-card width" >
                                                    <div class="card-block">
                                                        <h6 class="m-b-20">Active Customer </h6>
                                                        <h2 class="text-right"><i class="ti-tag f-left"></i><span>12</span></h2>
                                                        <p class="m-b-0 mt-3"> View Details<span class="f-right"></span></p>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6 col-xl-2 margin">
                                                <div class="card bg-c-blue order-card width">
                                                    <div class="card-block">
                                                        <h6 class="m-b-20">Total Orders</h6>
                                                        <h2 class="text-right"><i class="ti-shopping-cart f-left"></i><span>100</span></h2>
                                                        <p class="m-b-0 mt-3"> View Details<span class="f-right"></span></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xl-2 margin">
                                                <div class="card bg-c-green order-card width">
                                                    <div class="card-block">
                                                        <h6 class="m-b-20">Active Order</h6>
                                                        <h2 class="text-right"><i class="ti-package f-left"></i><span>10</span></h2>
                                                        <p class="m-b-0 mt-3"> View Details<span class="f-right"></span></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xl-2 margin">
                                                <div class="card bg-c-yellow order-card width">
                                                    <div class="card-block">
                                                        <h6 class="m-b-20">Complete Order</h6>
                                                        <h2 class="text-right"><i class="ti-reload f-left"></i><span>5</span></h2>
                                                        <p class="m-b-0 mt-3"> View Details<span class="f-right"></span></p>
                                                          </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xl-2 margin">
                                                <div class="card bg-c-pink order-card width">
                                                    <div class="card-block">
                                                        <h6 class="m-b-20">Cancelled Orders</h6>
                                                        <h2 class="text-right"><i class="ti-wallet f-left"></i><span>3</span></h2>
                                                        <p class="m-b-0 mt-3"> View Details<span class="f-right"></span></p>
                                                              </div>
                                                </div>
                                            </div>
                                            <!-- order-card end -->

                                            <!-- statustic and process start -->
                                            <div class="col-lg-12 col-md-12">
                                                <div class="card">
                                                <div class="card-header">
                <div class="col-md-3">                <select class="form-select" aria-label="Default select example">
  <option selected="">Monthly</option>
  <option value="1">Yearly</option>
  <option value="2">Weakly</option>
  <option value="2">Daily</option>

  
 
</select>
</div>

              </div>
                                                    <div class="card-header">
                  
  <section class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div id="bar-chart"></div>
      </div>
      
    </div>
  </section>
  
                   </div>                       </div>
                                            </div>
                                            <!-- statustic and process end -->
											<!-- tabs card start -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Warning Section Starts -->
        <!-- Older IE warning message -->
    <!--[if lt IE 9]>
<div class="ie-warning">
    <h1>Warning!!</h1>
    <p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers to access this website.</p>
    <div class="iew-container">
        <ul class="iew-download">
            <li>
                <a href="http://www.google.com/chrome/">
                    <img src="assets/images/browser/chrome.png" alt="Chrome">
                    <div>Chrome</div>
                </a>
            </li>
            <li>
                <a href="https://www.mozilla.org/en-US/firefox/new/">
                    <img src="assets/images/browser/firefox.png" alt="Firefox">
                    <div>Firefox</div>
                </a>
            </li>
            <li>
                <a href="http://www.opera.com">
                    <img src="assets/images/browser/opera.png" alt="Opera">
                    <div>Opera</div>
                </a>
            </li>
            <li>
                <a href="https://www.apple.com/safari/">
                    <img src="assets/images/browser/safari.png" alt="Safari">
                    <div>Safari</div>
                </a>
            </li>
            <li>
                <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                    <img src="assets/images/browser/ie.png" alt="">
                    <div>IE (9 & above)</div>
                </a>
            </li>
        </ul>
    </div>
    <p>Sorry for the inconvenience!</p>
</div>
<![endif]-->
<!-- Warning Section Ends -->
<?php include 'footer.php' ?>