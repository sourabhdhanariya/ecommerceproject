
<?php include 'header.php';
 include 'sidebar.php';

 $obj = new Database();

 if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     $customername = $_POST['customername'];
    
     $id = isset($_POST['id']) ? $_POST['id'] : '';  
     $uploadedFile = '';  // Initialize uploadedFile
 
     if (isset($_FILES["id"]) && $_FILES["id"]["error"] === UPLOAD_ERR_OK) {
         // Handle image upload
         $uploadDir = "images/";
         $uploadedFileName = basename($_FILES["categoryImage"]["name"]);
         $uploadedFile = $uploadDir . $uploadedFileName;
 
         if (move_uploaded_file($_FILES["categoryImage"]["tmp_name"], $uploadedFile)) {
             echo "Image uploaded successfully.";
         } else {
             echo "Failed to upload image.";
             $uploadedFile = '';  // Reset uploadedFile in case of failure
         }
     }
 
     // Update the category information in the database
     // Only update image path if a new image was uploaded
     $updateParams = array(
         'customer_name' => $customername
     );
 
     if (!empty($uploadedFile)) {
         // Only update the image path if a new image was uploaded
         $updateParams['category_image_path'] = $uploadedFile;
     }
 
     $whereClause = "customer_id  = $id"; // Assuming $id contains the category ID
     $updateResult = $obj->updateData('customer', $updateParams, $whereClause);
 
     if ($updateResult) {
         // Fetch the updated category information
         $updatedCategory = $obj->sql("SELECT * FROM customer WHERE customer_id = $id");
         $selectedCategoryID = isset($updatedCategory[0]['customer_id']) ? $updatedCategory[0]['category_id'] : '';
        //  $categoryImagePath = isset($updatedCategory[0]['category_image_path']) ? $updatedCategory[0]['category_image_path'] : '';
 
         echo "Category updated successfully! Selected category ID: $selectedCategoryID";
     } else {
         echo "Failed to update category. Error: " . implode(', ', $obj->getResult());
     }
 }
 ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

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
                                            <h5 class="m-b-10">Edit Customer </h5>
                                            <!-- <p class="text-muted m-b-10">lorem ipsum dolor sit amet, consectetur adipisicing elit</p> -->
                                            <ul class="breadcrumb-title b-t-default p-t-10">
                                                <li class="breadcrumb-item">
                                                    <a href="index.html"> <i class="fa fa-home"></i> </a>
                                                </li>
                                               <li class="breadcrumb-item"><a href="#!">Dashboard</a>
                                                        </li>
                                                        <li class="breadcrumb-item " ><a href="#!">Edit Customer </a>
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
                                        <?php
$id = isset($_GET['updatecustomerid']) ? $_GET['updatecustomerid'] : '';

$obj = new Database();
$obj->sql("SELECT * FROM customer WHERE customer_id = '$id'");
$results = $obj->getResult();

if (!empty($results)) {
    $customer_name = $results[0]['customer_name'];
    $customer_mobile = $results[0]['customer_mobile'];
    $customer_email = $results[0]['customer_email'];
    $customerbilling = $results[0]['customerbilling_address1'];  // Added parent_category_id
} else {
    $category_name = '';
    $customer_mobile = '';
    $customer_email = '';
    $customerbilling = '';  // Set a default value for parent_category_id
}

?>                               
                                        <form id="categoryForm" method="post"  enctype="multipart/form-data" class="row g-3 p-5">
                                        <div class="col-md-6">
    <label for="inputEmail4" class="form-label">Customer Name <span class="star">*</span></label>
    <input type="text" class="form-control tablesize" name="customername" placeholder="Enter Name" value="<?php echo isset($customer_name) ? htmlspecialchars($customer_name) : ''; ?>" id="customerName">
    <input type="hidden" name="id" value="<?= $id ?>"> <!-- Add this hidden input for category ID -->
   
  </div>
  <div class="col-md-4">
   
  <label for="inputEmail4" class="form-label ">Mobile Number <span class="star">*</span></label>
    <input type="number" class="form-control tablesize" name="mobile_name"  value="<?php echo htmlspecialchars($customer_mobile); ?>" placeholder="Enter Mobile Name" id="mobileName" >

</div>

<div class="col-md-6">
    <label for="productPrice" class="form-label">Email Address <span class="star">*</span></label>
    
    <input type="email" class="form-control tablesize" placeholder="Enter Email Address"   value="<?php echo htmlspecialchars($customer_email); ?>" id="emailAddress" name="email_address">
</div>

<h5> Billing Address</h5>

    


  <div class="col-12">
  
  <label for="">Address Line 1 </label>
  <div class="form-floating tablesize">

  <textarea name="productDes" id="editor1"  cols="30" rows="10">
  <?php echo htmlspecialchars($customerbilling); ?>"
</textarea>
</div> 

</div>

<div class="col-12">
  
  <label for="">Address Line 2 </label>
  <div class="form-floating tablesize">

  <textarea name="productDes" id="editor2"  cols="30" rows="10">
</textarea>
</div> 

</div>

<div class="col-md-6">
    <label for="inputEmail4" class="form-label ">City <span class="star">*</span></label>
    <input type="text" class="form-control tablesize" name="customer_city" placeholder="Enter City" id="customerCity" >
  
  </div>
  
  <div class="col-md-6">
   
  <label for="inputEmail4" class="form-label ">State <span class="star">*</span></label>
    <input type="text" class="form-control tablesize" name="customer_state" placeholder="Enter State" id="customer_state" >

</div>

    
<div class="col-md-6">
    <label for="inputEmail4" class="form-label ">Country <span class="star">*</span></label>
    <input type="text" class="form-control tablesize" name="customer_country" placeholder="Enter Countery" id="customerCountery" >
  </div>
  
  <div class="col-md-6">
   
  <label for="inputEmail4" class="form-label ">Zip <span class="star">*</span></label>
    <input type="number" class="form-control tablesize" name="customer_zip" placeholder="Enter Zip" id="customer_zip" >

</div>

<h5> Shipping Address</h5>

  <div class="col-12">
  
  <label for="">Address Line 1 </label>
  <div class="form-floating tablesize">

  <textarea name="productDes" id="editor3"  cols="30" rows="10">
</textarea>
</div> 

</div>

<div class="col-12">
  
  <label for="">Address Line 2 </label>
  <div class="form-floating tablesize">

  <textarea name="productDes" id="editor4"  cols="30" rows="10">
</textarea>
</div> 

</div>

<div class="col-md-6">
    <label for="inputEmail4" class="form-label ">City <span class="star">*</span></label>
    <input type="text" class="form-control tablesize" name="customer_city" placeholder="Enter City" id="customerCity" >
  
  </div>
  
  <div class="col-md-6">
   
  <label for="inputEmail4" class="form-label ">State <span class="star">*</span></label>
    <input type="text" class="form-control tablesize" name="customer_state" placeholder="Enter State" id="customer_state" >

</div>

    
<div class="col-md-6">
    <label for="inputEmail4" class="form-label ">Country <span class="star">*</span></label>
    <input type="text" class="form-control tablesize" name="customer_country" placeholder="Enter Countery" id="customerCountery" >
  </div>
  
  <div class="col-md-6">
   
  <label for="inputEmail4" class="form-label ">Zip <span class="star">*</span></label>
    <input type="number" class="form-control tablesize" name="customer_zip" placeholder="Enter Zip" id="customer_zip" >

</div>



<div class="col-md-8">
<div id="media-container" class="container-fluid d-flex flex-nowrap overflow-auto"></div>

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
                                    
       

<script>
     CKEDITOR.replace('editor1', {
  skin: 'moono',
  enterMode: CKEDITOR.ENTER_BR,
  shiftEnterMode:CKEDITOR.ENTER_P,
  toolbar: [{ name: 'basicstyles', groups: [ 'basicstyles' ], items: [ 'Bold', 'Italic', 'Underline', "-", 'TextColor', 'BGColor' ] },
             { name: 'styles', items: [ 'Format', 'Font', 'FontSize' ] },
             { name: 'scripts', items: [ 'Subscript', 'Superscript' ] },
             { name: 'justify', groups: [ 'blocks', 'align' ], items: [ 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
             { name: 'paragraph', groups: [ 'list', 'indent' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent'] },
             { name: 'links', items: [ 'Link', 'Unlink' ] },
             { name: 'insert', items: [ 'Image'] },
             { name: 'spell', items: [ 'jQuerySpellChecker' ] },
             { name: 'table', items: [ 'Table' ] }
             ],
});

CKEDITOR.replace('editor2', {
  skin: 'moono',
  enterMode: CKEDITOR.ENTER_BR,
  shiftEnterMode:CKEDITOR.ENTER_P,
  toolbar: [{ name: 'basicstyles', groups: [ 'basicstyles' ], items: [ 'Bold', 'Italic', 'Underline', "-", 'TextColor', 'BGColor' ] },
             { name: 'styles', items: [ 'Format', 'Font', 'FontSize' ] },
             { name: 'scripts', items: [ 'Subscript', 'Superscript' ] },
             { name: 'justify', groups: [ 'blocks', 'align' ], items: [ 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
             { name: 'paragraph', groups: [ 'list', 'indent' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent'] },
             { name: 'links', items: [ 'Link', 'Unlink' ] },
             { name: 'insert', items: [ 'Image'] },
             { name: 'spell', items: [ 'jQuerySpellChecker' ] },
             { name: 'table', items: [ 'Table' ] }
             ],
});
CKEDITOR.replace('editor3', {
  skin: 'moono',
  enterMode: CKEDITOR.ENTER_BR,
  shiftEnterMode:CKEDITOR.ENTER_P,
  toolbar: [{ name: 'basicstyles', groups: [ 'basicstyles' ], items: [ 'Bold', 'Italic', 'Underline', "-", 'TextColor', 'BGColor' ] },
             { name: 'styles', items: [ 'Format', 'Font', 'FontSize' ] },
             { name: 'scripts', items: [ 'Subscript', 'Superscript' ] },
             { name: 'justify', groups: [ 'blocks', 'align' ], items: [ 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
             { name: 'paragraph', groups: [ 'list', 'indent' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent'] },
             { name: 'links', items: [ 'Link', 'Unlink' ] },
             { name: 'insert', items: [ 'Image'] },
             { name: 'spell', items: [ 'jQuerySpellChecker' ] },
             { name: 'table', items: [ 'Table' ] }
             ],
});

CKEDITOR.replace('editor4', {
  skin: 'moono',
  enterMode: CKEDITOR.ENTER_BR,
  shiftEnterMode:CKEDITOR.ENTER_P,
  toolbar: [{ name: 'basicstyles', groups: [ 'basicstyles' ], items: [ 'Bold', 'Italic', 'Underline', "-", 'TextColor', 'BGColor' ] },
             { name: 'styles', items: [ 'Format', 'Font', 'FontSize' ] },
             { name: 'scripts', items: [ 'Subscript', 'Superscript' ] },
             { name: 'justify', groups: [ 'blocks', 'align' ], items: [ 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
             { name: 'paragraph', groups: [ 'list', 'indent' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent'] },
             { name: 'links', items: [ 'Link', 'Unlink' ] },
             { name: 'insert', items: [ 'Image'] },
             { name: 'spell', items: [ 'jQuerySpellChecker' ] },
             { name: 'table', items: [ 'Table' ] }
             ],
});

</script>

        <script src="./js/addproduct.js"></script>
<?php include 'footer.php' ?>
