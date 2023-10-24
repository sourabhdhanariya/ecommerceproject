<?php
include 'header.php';
include 'sidebar.php';
include 'Classes/Categori.php';
include 'Classes/Product.php';
$obj = new Database();
 
$successMessage = '';
$errorMessage = '';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_title = $_POST['product_title'];
    $categoriObj = new ProductClass();

    $product_description = $_POST['productDes'];
    $product_price = $_POST['productPrice'];
    $product_discount = $_POST['product_discount'];

    if ($product_price <= $product_discount) {
        echo "Price cannot be greater than the discount.";
        
    } else {
        $product_quantity = $_POST['prod_quantity'];
        $skuProduct = $_POST['skuProduct'];
        $category = $_POST['category'];
        $subcategory_id = $_POST['subcategoryid'];
        $productLaunchFormatted = date('Y-m-d', strtotime($_POST['launch']));
        $status = isset($_POST["status"]) && $_POST["status"] == "on" ? 1 : 0;
       
        $categoriObj = new ProductClass();
        $response =   $categoriObj->updateProduct($product_title, $product_description, $product_price, $product_discount, $product_quantity, $category, $subcategory_id, $skuProduct, $productLaunchFormatted, $status);
    
}}

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


 
// Performed select query  
$id = isset($_GET['updateid']) ? $_GET['updateid'] : '';


$obj = new ProductClass();
 
if (!empty($id)) {
    $results = $obj->selectProduct($id);

if (!empty($results)) {
    $product_title = $results[0]['product_title'];
    $product_price = $results[0]['product_price'];
    $product_discount = $results[0]['product_discount'];
    
    $product_quantity = $results[0]['product_quantity'];
    $sku = $results[0]['sku'];
    $launch_date = $results[0]['launch_date'];
    $product_description = $results[0]['product_description'];
    $category_productid = $results[0]['category_id'];
    $status = isset($_POST["status"]) && $_POST["status"] == "on" ? 1 : 0;
    
    $category_subproductid = $results[0]['subcategory_id'];
    

    $product_image = $results[0]['product_image']; 
    $obj->sqlData("SELECT product_image, image_path FROM media_master WHERE product_id = '$id'");
    $mediaResults = $obj->getResult();
    if (!empty($mediaResults)) {
        $product_images = $mediaResults;
        
    } else {
        $product_images = array(); 
    }
} else {
    $product_title = '';
    $product_price = '';
    $product_discount='';
    $product_quantity = '';
    $sku = '';
    $launch_date = '';
    $product_description = '';
    $status = '';
    $category_productid = '';
    $category_subproductid = '';
    
    $product_images = array();

}
}
?>


<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
<link rel="stylesheet" href="css/addprodyct.css">
    <style>

    </style>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  
<div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            <!-- Main-body start -->
                            <div class="main-body  tablesize">
                                <div class="page-wrapper">
									<!-- Page-header start -->
                                    <div class="page-header card">
                                        <div class="card-block">
                                            <h5 class="m-b-10">Update Product Management</h5>
                                            <!-- <p class="text-muted m-b-10">lorem ipsum dolor sit amet, consectetur adipisicing elit</p> -->
                                            <ul class="breadcrumb-title b-t-default p-t-10">
                                                <li class="breadcrumb-item">
                                                    <a href="index.html"> <i class="fa fa-home"></i> </a>
                                                </li>
                                               <li class="breadcrumb-item"><a href="#!">Dashboard</a>
                                                        </li>
                                                        <li class="breadcrumb-item " ><a href="#!">Update Product Management</a>
                                                        </li>
                                          <li class="float-end text-primary">         
                                            <form method="post" action="">
                                                
                                            <button type="button" class="btn btn-link buttonsize" id="previewButton" data-toggle="modal" data-target="#modelId">Product Preview</button>
                                            <!-- <button type="button" class="btn btn-link buttonsize" value="</?php echo htmlspecialchars($staus); ?>" id="previewButton" data-toggle="modal" data-target="#previewModal">Product Preview</button> -->
                                             </form>
                                        </li>
                                                 
                                                    </ul>
                                         
                                        </div>
                                    </div>
                                    <!-- Page-header end -->
                                    
                                <!-- Page-body start -->
                                <div class="page-body">
                                    <!-- Basic table card start -->
                                    <div class="card">
                                        <div class="">
                                           
                                        
          
                                            <form id="" method="post" enctype="multipart/form-data" class="row g-3 p-5 ">
  <div class="col-md-6">
    <label for="inputEmail4" class="form-label ">Product Name <span class="star">*</span></label>
    <input type="text" class="form-control tablesize" value="<?php echo htmlspecialchars($product_title); ?>" name="product_title" placeholder="Enter Name" id="productname" required>
    <input type="hidden" name="id" value="<?= $id ?>"> <!-- Add this hidden input for category ID -->
    
  </div>
  <div class="col-md-6">
  <div class="form-check form-switch float-end">
  <label>Public Now / Draft</label>
  <input class="form-check-input mtt-5 margincheckbox" style="margin-left:-72px" name="status" type="checkbox" <?php echo $status == 1 ? 'checked' : ''; ?> id="flexSwitchCheckDefault">
  <label class="form-check-label" for="flexSwitchCheckDefault"></label>
</div>

<!-- Rest of your HTML form code goes here -->



</div>
<div class="col-md-4">
<label for="parent_category_id" class="form-label"> Category </label>
  <select id="categoryId"  name="category" class="form-select">
    <?php 

    $obj = new CategoriClass();
    
    $categories = $obj->getCategories();
       
    if (!empty($categories)) {
      foreach ($categories as $row) {
        $category_id = $row['category_id'];
        $category_name = $row['category_name'];
 
        $selected = ($category_id == $category_productid) ? 'selected="selected"' : '';

        echo '<option value="' . $category_id . '.' . $category_name . '" ' . $selected . '>' . $category_name . '</option>';
       
       }
    } else {
      echo '<option value="0">No Parent Categories found</option>';
    }
    ?>
</select>
</div>
 
  <div class="col-md-4">
  <label for="parent_category_id" class="form-label">Sub Category <span class="star">*</span></label>
  <select id="subCategoryId" name="subcategoryid" class="form-select">
    <?php 
    
    $obj = new ProductClass();

    $results = $obj->getProductCategories();
    
    // $obj->sqlData('SELECT c1.category_id, c1.category_name, c1.parent_category_id,
    // c1.category_description, c1.category_image_path, c1.status,
    // c2.category_name AS parent_category_name
    // FROM categories c1
    // INNER JOIN categories c2 ON c1.parent_category_id = c2.category_id');
    
    // $results = $obj->getResult();
    
    if (!empty($results)) {

        
      foreach ($results as $row) {
        $category_id = $row['category_id'];
        $sub_category_name = $row['parent_category_name'];
        $selected = ($category_id == $category_subproductid) ? 'selected="selected"' : '';

        echo '<option value="' . $category_id . '.' . $sub_category_name . '" ' . $selected . '>' . $sub_category_name . '</option>';
       
       
       }
    } else {
      echo '<option value="0">No Parent Categories found</option>';
    }
    ?>
</select>
</div>
  
<div class="col-md-2">

<label for="inputEmail4" class="form-label">Price per Unit <span class="star">*</span></label>
    <input type="text" class="form-control tablesize" value="<?php echo htmlspecialchars($product_price); ?>" placeholder="Enter Product Price" id="productPrice" name="productPrice" id="inputEmail4" >
 
</div>

<div class="col-md-2">

<label for="inputEmail4" class="form-label">Discount<span class="star">*</span></label>
    <input type="text" class="form-control tablesize" value="<?php echo htmlspecialchars($product_discount); ?>" placeholder="Enter Product Price" id="productPrice" name="product_discount" id="productdiscount" >
 
</div>

<div class="col-md-4">

<label for="inputEmail4" class="form-label">Quantity<span class="star">*</span></label>
    <input type="text" class="form-control tablesize" value="<?php echo htmlspecialchars($product_quantity); ?>" placeholder="Enter Product Quantity" name="prod_quantity" id="inputEmail4" >
</div>
  
<div class="col-md-4">

<label for="inputEmail4" class="form-label">SKU <span class="star">*</span></label>
    <input type="text" class="form-control tablesize" value="<?php echo htmlspecialchars($sku); ?>" placeholder="Enter SKU" name="skuProduct" id="inputEmail4" >

</div>

<div class=" col-md-4 ">
<label for="inputEmail4" class="form-label">Launch Date      <span class="star">*</span></label>

<div class="input-group ">
  
<input placeholder="Select your date" type="text"  value="<?php echo htmlspecialchars($launch_date); ?>" name="launch" id="datepicker" value=""  class="form-control tablesize">
        <span class="input-group-text bg-white border-0 " id="basic-addon2"><img width="25px" height="21px" src="images/calender.png" alt="calendar--v1"/></span>
   
    </div>
  
</div>
   
      </div>
    
  <div class="col-12">
  
  <label for="">Product Description </label>
  <div class="form-floating tablesize">

  <textarea name="productDes" id="editor"    cols="30" rows="10">
  <?php echo htmlspecialchars($product_description); ?>
</textarea>
</div> 


</div>

<div class="col-md-12 mt-3 d-flex">
<div class="col-md-4">


    <label for="formFileSm" class="form-label">Update Images</label>
    <input type="file" name="imageFile[]" id="media-upload" class="form-control form-control-sm" accept="image/*" multiple >
</div>
<div class="col-md-2">
    <img src="images/product/<?php echo htmlspecialchars($product_image); ?>" style="width:100px" name="imageproducts" width="100px" height="100px" class="container-fluid d-flex flex-nowrap overflow-auto" alt="s">
    <div  class="container-fluid d-flex flex-nowrap overflow-auto"></div>
    <div>
 
</div>

</div>

<div class="col-md-4">

<?php
if (!empty($product_images)) {
    foreach ($product_images as $image) {
        $image_path = $image['image_path'];
        $product_image = $image['product_image'];

        echo '<img  src="' . $image_path .'" width="100px" alt="2333">';
    }
} else {

}
?>
</div>
</div>
  <div class="col-11 m-3">
    <a class="btn btn-outline-dark buttonsize" href="category.php" role="button"> 
       Cancel  
    </a>

    <button type="submit" name="submit" value="submit" class="btn btn-primary float-end buttonsize">Save</button>
  </div>
</form>
</div>
                                    
       

<!-- Modal -->

                       
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Preview</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
             
            <!-- <div class="previewImagesModelBox centerimage"></div>
              -->

              <div class="ag-format-container">
                    <div class="layout">
                        <ul class="slider">
                            <!-- Existing slide(s) -->
                            <li>
                            </li>
                        </ul>
                    </div>
                </div>

   
            <div class="d-flex mt-5 ml-5 pl-5">
            <div id="slickSlider" class="">
            </div>
                    </div>
          
                    <div class="col-md-12 d-flex mt-5">           
                               <div class=" col-md-12">
                <h4>
                  <strong id="previewEmail" >Category :</strong>      
            </h4>
            <div class=" d-flex col-md-12">
              
              <div class="col-md-4">
              <h6><strong>Category :</strong> </h6>
             
              </div>
              <div class="col-md-2 mpreviewCategoryId">
                <span id="previewCategoryId"></span>
                </div>
                 
            </div>

              
                </div>
</div>
              
                <div class=" d-flex col-md-12">
              
              <div class="col-md-4">
              <h6><strong>Sub-Category :</strong> </h6>
              
              </div>
                <div class="col-md-6">
                <span id="previewsubCategoryId"> </span>
                </div>
              
                </div>
                
                <div class=" d-flex col-md-12">
              
              <div class="col-md-4">
              <h6><strong>Price :</strong> </h6>
              </div>
                <div class="col-md-6">
                <span id="previewProduct"> $</span>
                </div>
              
                </div>
                <div class="mt-3 ml-3 col-md-12">
                    <h6><strong>Description :</strong> <span id="previewEditor"></span></h6>
                </div>


                <div class="col-md-12 d-flex mt-5">
                    <div class="col-md-4">
    <div class="form-group d-flex">
      <label for="quantity"><b class="me-5">QTY:</b></label>
      <input type="number" class="form-control" id="quantity" min="1" value="1">
    </div>

                    
                    </div>
                    <div class="col-md-4">
                        <a class="btn buynowcolor btn " href="#" role="button">Buy Now </a>
                    </div>
                    <div class="col-md-4">
                    <a class="btn playnowcolor btn " href="#" role="button">Play Now </a>
                        
                    </div>
                
                </div>
                <!-- end -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
            </div>
        </div>
    </div>
</div>
        <script src="./js/addproduct.js"></script><?php include 'footer.php' ?>

