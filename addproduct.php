
<?php include 'header.php';
 include 'sidebar.php';

 $successMessage = '';
 $errorMessage = '';
 
if (isset($_POST["submit"])) {
    $obj = new Database();
    $productname = $_POST["productname"];
    $prod_price = $_POST["productPrice"];
    $prod_quantity = $_POST["qtyProduct"];
    $prod_sku = $_POST["skuProduct"];
    $productDes = $_POST["productDes"];
    $category_id = $_POST["category_id"];
    $sub_category_id = $_POST["sub_category_id"];
    $productLaunch = $_POST["launch"];
    $product_discount = $_POST["productdiscount"];
   
    
    $status = isset($_POST["status"]) && $_POST["status"] == "on" ? 1 : 0;
  
    $productLaunchFormatted = date('Y-m-d', strtotime($productLaunch));
    
    $mediaIds = array(); 
    $uploadDir = "images/";


    $product_id = null;
  for ($i = 0; $i < count($_FILES["media-upload"]["name"]); $i++) {
        $uploadedFile = $uploadDir . basename($_FILES["media-upload"]["name"][$i]);
        if (move_uploaded_file($_FILES["media-upload"]["tmp_name"][$i], $uploadedFile)) {
            if ($i === 0) {
                $dataToInsert = [
                    'product_title' => $productname,
                    'product_description' => $productDes,
                    'category_id' => $category_id,
                    'subcategory_id' => $sub_category_id,
                    'product_quantity' => $prod_quantity,
                    'product_price' => $prod_price,
                    'product_discount' => $product_discount,  
                    'sku' => $prod_sku,
                    'launch_date' => $productLaunchFormatted,
                    'product_image' => $uploadedFile,
                    'status' => $status
                ];

                    $product_id = $obj->insertMutipleData('products', $dataToInsert);

                if ($product_id !== false) {
                    $successMessage = 'Form Add Successfully';
         
                } else {
                    $errorMessage = 'products is not add';
                }
            } else {
         
                if (isset($product_id)) {
                    $mediaDataToInsert = [
                        'product_id' => $product_id,  
                        'product_image' => $uploadedFile,
                        'image_path' => $uploadedFile,
                        'image_name' => basename($_FILES["media-upload"]["name"][$i]),
                        'status' => 'active'
                    ];


                    $mediaId = $obj->insertMutipleData('media_master', $mediaDataToInsert);
                    $mediaIds[] = $mediaId;
                } else {
                    $errorMessage = 'Error: Product ID is not set';
                }
            }
        } else {
            $errorMessage = 'Error: Image could not be uploaded.';
        }
    }
}
?>

<?php if (!empty($successMessage)): ?>
    <script>
        toastr.success('<?php echo $successMessage; ?>', 'Success');
    </script>
<?php endif; ?>

<?php if (!empty($errorMessage)): ?>
    <script>
        toastr.error('<?php echo $errorMessage; ?>', 'Error');
    </script>
<?php endif; ?>


<link rel="stylesheet" href="css/addprodyct.css">
   
<div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            <!-- Main-body start -->
                            <div class="main-body  tablesize">
                                <div class="page-wrapper">
									<!-- Page-header start -->
                                    <div class="page-header card">
                                        <div class="card-block">
                                            <h5 class="m-b-10">Add Product Management</h5>
                                            <ul class="breadcrumb-title b-t-default p-t-10">
              <li class="breadcrumb-item">
                <a href="index.html"> <i class="fa fa-home"></i> </a>
              </li>
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a>
              </li>
              <li class="breadcrumb-item "><a href="#!">Add Product Management </a>
              </li>
            </ul>
                                            <!-- <p class="text-muted m-b-10">lorem ipsum dolor sit amet, consectetur adipisicing elit</p> -->
                                            <ul class="breadcrumb-title b-t-default p-t-10">
                                              <li class="float-end text-primary">         
                                             <button type="button" class="btn btn-link buttonsize" id="previewButton" data-toggle="modal" data-target="#modelId">Product Preview</button>

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
                                            <form id="categoryForm" method="post"  enctype="multipart/form-data" class="row g-3 p-5">
  <div class="col-md-6">
    <label for="inputEmail4" class="form-label ">Product Name <span class="star">*</span></label>
    <input type="text" class="form-control tablesize" name="productname" placeholder="Enter Name" id="productname" >
  
  </div>
  
  <div class="col-md-6">
   
  <div class="form-check form-switch  float-end">
  <label >Public Now  / Draft</label>
  
  <input class="form-check-input  mtt-5 margincheckbox" name="status" style="margin-left:-72px"  type="checkbox" id="flexSwitchCheckDefault">
  <label class="form-check-label" for="flexSwitchCheckDefault"></label>
</div>


</div>
<div class="col-md-4">
<label for="parent_category_id" class="form-label"> Category </label>

  <select  name="category_id" id="categoryId" class="form-select">
    <?php 
    $obj = new Categories();
           //add categories 
           $categories = $obj->getCategories();
        
    if (!empty($categories)) {
    
      foreach ($categories as $row) {
        $category_id = $row['category_id'];
        $category_name = $row['category_name'];
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
  <select id="subCategoryId" name="sub_category_id" class="form-select">
    <?php 
    $obj = new Database();
    $obj->sqlData('SELECT category_id, parent_category_name
    FROM (
        SELECT DISTINCT
            c1.category_id,
            c2.category_name AS parent_category_name,
            COUNT(*) OVER (PARTITION BY c2.category_name) AS count
        FROM categories c1
        LEFT JOIN categories c2 ON c1.parent_category_id = c2.category_id
        WHERE c1.parent_category_id IS NOT NULL
    ) AS subquery
    WHERE count = 1;');
    
    $results = $obj->getResult();
    
    
    if (!empty($results)) {


      foreach ($results as $row) {
        $category_id = $row['category_id'];
        $sub_category_name = $row['parent_category_name'];
        echo '<option value="' . $category_id . '.' . $sub_category_name . '" ' . $selected . '>' . $sub_category_name . '</option>';

       }
    } else {
      echo '<option value="0">No Parent Categories found</option>';
    }
    ?>
</select>

</div>
<div class="col-md-2">
    <label for="productPrice" class="form-label">Price per Unit <span class="star">*</span></label>
    <input type="text" class="form-control tablesize" placeholder="Enter Product Price" id="productPrice" name="productPrice">
</div>
<div class="col-md-2">
    <label for="productdiscount" class="form-label">Discount <span class="star">*</span></label>
    <input type="text" class="form-control tablesize" placeholder="Enter Product Discount" id="productdiscount" name="productdiscount"> <!-- Changed 'name' to 'productdiscount' -->
</div>
 
<div class="col-md-4">

<label for="inputEmail4" class="form-label">Quantity <span class="star">*</span></label>
    <input type="text" class="form-control tablesize" placeholder="Enter Product Quantity" name="qtyProduct" id="qty" >
</div>
  
<div class="col-md-4">

<label for="inputEmail4" class="form-label">SKU <span class="star">*</span></label>
    <input type="text" class="form-control tablesize" placeholder="Enter SKU" name="skuProduct" id="inputEmail4" >

</div>
<div class=" col-md-4 ">
<label for="inputEmail4" class="form-label">Launch Date<span class="star" >*</span></label>

<div class="input-group ">
  
<input placeholder="Select your date" type="text" name="launch" id="datepicker" value=""  class="form-control tablesize" required>
        <span class="input-group-text bg-white border-0 " id="basic-addon2"><img width="25px" height="21px" src="images/calender.png" alt="calendar--v1"/></span>
    </div>
  
</div>
   
      </div>
    
  <div class="col-12">
  
  <label for="">Product Description </label>
  <div class="form-floating tablesize">

  <textarea name="productDes" id="editor"  cols="30" rows="10">
</textarea>
</div> 


</div>
<div class="col-md-12 mt-3 d-flex">
<div class="col-md-4">
<label for="formFileSm" class="form-label">Update Image</label>
  <input type="file" name="media-upload[]" id="media-upload"  class="form-control form-control-sm" accept="image/*" multiple required><br><br>

</div>
<div class="col-md-8">
<div id="media-container" class="container-fluid d-flex flex-nowrap overflow-auto"></div>

</div>
</div>
  <div class="col-12 mb-3">
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
             
          
              <div class="ag-format-container">
                    <div class="layout">
                        <ul class="slider">
                    
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

        <script src="./js/addproduct.js"></script>
<?php include 'footer.php' ?>
