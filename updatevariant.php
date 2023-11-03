<?php
include "header.php";
include "sidebar.php";
include "Classes/Variant.php";
$obj = new Database();
 
$successMessage = '';
$errorMessage = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $categoriObj = new Variant();
    
    $product_title = $_POST['variantName'];
    $response = $categoriObj->updateVariant($product_title); 
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

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];


    if ($deletionWasSuccessful) {
        echo "Delete successful!";
    } else {
        echo "Delete failed. Error: " . $errorDetails;
    }
}
?>

<?php


 
// Performed select query  
$id = isset($_GET['id']) ? $_GET['id'] : '';

$obj = new Variant();

$product_images = array(); // Initialize an array to hold the product images

if (!empty($id)) {
    $results = $obj->selectVariantById($id);

    if (!empty($results)) {
        $product_title = $results[0]['name'];

        // Assuming 'attribute' is an array of attribute values, loop through it
        if (isset($results[0]['attribute'])) {
            $product_images = $results[0]['attribute'];
        }

        $sql = "SELECT id, name FROM product_attribute WHERE variate_id = '$id'";
        $obj->sqlData($sql);

        $mediaResults = $obj->getResult();
        if (!empty($mediaResults)) {
            $product_images = $mediaResults;
        }
    } else {
        $product_title = '';
        $product_images = array();
    }
}
?>
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body tablesize">
            <div class="page-wrapper">
                <!-- Page-header start -->
                <div class="page-header card">
                    <div class="card-block">
                        <h5 class="m-b-10">Update Variants Management</h5>
                        <!-- <p class="text-muted m-b-10">lorem ipsum dolor sit amet, consectetur adipisicing elit</p> -->
                        <ul class="breadcrumb-title b-t-default p-t-10">
                            <li class="breadcrumb-item">
                                <a href="index.html"> <i class="fa fa-home"></i> </a>
                            </li>
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item "><a href="#!">Update Variants Management</a>
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
                                    <input type="text" class="form-control tablesize text-capitalize" name="variantName" value="<?php echo htmlspecialchars($product_title); ?>" placeholder="Variant Name">
                                </div>
                                <div class="col-md-12">

                                <div class="col-md-12">

                                    <label>Attribute</label>
                                    <div class="multi-field-wrapper">

                                
                                    <div class="multi-fields d-flex">
    <?php foreach ($product_images as $image) : ?>
        <div class="multi-field d-flex pl-3">
            <input type="text" name="attribute[]" value="<?php echo htmlspecialchars($image['name']); ?> " class="form-control tablesize text-capitalize">
            <button type="button" name="delete" class="btn btn-outline-dark buttonsize remove-field">x</button>
        </div>
    <?php endforeach; ?>
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
                        <script>
    $('.multi-field-wrapper').each(function () {
        var $wrapper = $('.multi-fields', this);
        $(".add-field", $(this)).click(function (e) {
            $('.multi-field:first-child', $wrapper).clone(true).appendTo($wrapper).find('input').val('').focus();
        });
        $('.multi-field .remove-field', $wrapper).click(function () {
            if ($('.multi-field', $wrapper).length > 1)
                $(this).parent('.multi-field').remove();
        });
    });
</script>
                        <?php include "footer.php"; ?>