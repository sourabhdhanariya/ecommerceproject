<?php
include "header.php";
include "sidebar.php";
include "Classes/Variant.php";

if (isset($_POST["submit"])) {
    $variantName = $_POST["variantName"]; 
    $variant = new Variant();
   
        $response = $variant->addVariant($variantName);
   
}
?>
<?php if (!empty($response) && $response["success"] === true) : ?>
    <script>
        toastr.success('<?php echo $response["msg"]; ?>', 'Success');
    </script>
<?php elseif (!empty($response)) : ?>
    <script>
        toastr.error('<?php echo $response["msg"]; ?>', 'Error');
    </script>
<?php endif; ?>
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body tablesize">
            <div class="page-wrapper">
                <!-- Page-header start -->
                <div class="page-header card">
                    <div class="card-block">
                        <h5 class="m-b-10">Add Variants Management</h5>
                        <!-- <p class="text-muted m-b-10">lorem ipsum dolor sit amet, consectetur adipisicing elit</p> -->
                        <ul class="breadcrumb-title b-t-default p-t-10">
                            <li class="breadcrumb-item">
                                <a href="index.html"> <i class="fa fa-home"></i> </a>
                            </li>
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item "><a href="#!">Add Variants Management</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="page-body">
                    <!-- Basic table card start -->
                    <div class="card">
                        <div class="">
                            <form method="post" enctype="multipart/form-data" class="row g-3 p-5 ">
                                <div class="col-md-6">
                                    <label for="inputEmail4" class="form-label">Variant Name <span class="star">*</span></label>
                                    <input type="text" class="form-control tablesize text-capitalize" name="variantName" placeholder="Variant Name">
                                </div>
                                <div class="col-md-12">

                                <div class="col-md-12">

                                    <label>Attribute</label>
                                    <div class="multi-field-wrapper">    
                                <div class="multi-fields d-flex">
                                            <div class="multi-field d-flex pl-3">
                                                <input type="text" name="attribute[]" class="form-control tablesize text-capitalize">      
                                              
                                                <button type="button" class="btn btn-outline-dark buttonsize remove-field">x</button>
                                            
                                            </div>
                                        </div>
                        
                                        <button type="button" class="add-field mt-3 bg-danger"> <i class="ti-plus"></i></button>
                                    </div>
                                </div>
                                </div>                        
                                <div class="col-12">
                                    <a class="btn btn-outline-dark buttonsize" href="product_variant.php" role="button">
                                        Cancel
                                    </a>
                                    <button type="submit" name="submit" id="submitButton" value="submit" class="btn btn-primary float-end buttonsize">Save</button>
                                </div>
                            </form>
                        </div>
                        
                        <script src="./js/addvariate.js"></script>
                        <?php include "footer.php"; ?>