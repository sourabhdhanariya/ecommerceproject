<?php
include 'header.php';
include 'sidebar.php';
include 'Classes/Dashboard.php';
?>
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">

                <div class="page-body">
                    <div class="row">
                        <!-- order-card start -->
                        <?php
                        $categoriObj = new DashboardClass();
                        ?>

                        <div class="col-md-6 col-xl-2 margin">
                            <div class="card bg-c-blue order-card width">
                                <div class="card-block">
                                    <h6 class="m-b-20">Active Customer</h6>
                                    <h2 class="text-right"><i class="ti-tag f-left"></i><span><?php echo $categoriObj->selectCustomerCount(); ?></span></h2>
                                    <p class="m-b-0 mt-3">View Details<span class="f-right"></span></p>
                                </div>
                            </div>
                        </div>



                        <div class="col-md-6 col-xl-2 margin">
                            <div class="card bg-c-blue order-card width">
                                <div class="card-block">
                                    <h6 class="m-b-20">Total Orders</h6>
                                    <h2 class="text-right"><i class="ti-shopping-cart f-left"></i><span><?php echo $categoriObj->countOrders(); ?></span></h2>
                                    <p class="m-b-0 mt-3"> View Details<span class="f-right"></span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-2 margin">
                            <div class="card bg-c-green order-card width">
                                <div class="card-block">
                                    <h6 class="m-b-20">Active Order</h6>
                                    <h2 class="text-right"><i class="ti-package f-left"></i><span><?php echo $categoriObj->countActiveOrders(); ?></span></h2>
                                    <p class="m-b-0 mt-3"> View Details<span class="f-right"></span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-2 margin">
                            <div class="card bg-c-yellow order-card width">
                                <div class="card-block">
                                    <h6 class="m-b-20">Complete Order</h6>
                                    <h2 class="text-right"><i class="ti-reload f-left"></i><span><?php echo $categoriObj->countCompletedOrders(); ?></span></h2>
                                    <p class="m-b-0 mt-3"> View Details<span class="f-right"></span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-2 margin">
                            <div class="card bg-c-pink order-card width">
                                <div class="card-block">
                                    <h6 class="m-b-20">Cancelled Orders</h6>
                                    <h2 class="text-right"><i class="ti-wallet f-left"></i><span><?php echo $categoriObj->countCancelledOrders(); ?></span></h2>
                                    <p class="m-b-0 mt-3"> View Details<span class="f-right"></span></p>
                                </div>
                            </div>
                        </div>
                        <!-- order-card end -->
                        <!-- statustic and process start -->
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="col-md-3"> <select class="form-select" aria-label="Default select example">
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

                                </div>
                            </div>
                        </div>
                        <!-- statustic and process end -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php include 'footer.php' ?>