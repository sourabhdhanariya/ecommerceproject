
<?php include 'header.php';
 include 'sidebar.php'; 
$obj = new Database();

$successMessage = '';
$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $categoryName = $_POST['categoryName'];
    $parent_category_id = $_POST['parent_category_id'];
    $categoryDescription = $_POST['categoryDes'];

    $id = isset($_POST['id']) ? $_POST['id'] : '';  
    $uploadedFile = '';  // Initialize uploadedFile

    if (isset($_FILES["categoryImage"]) && $_FILES["categoryImage"]["error"] === UPLOAD_ERR_OK) {
        // Handle image upload
        $uploadDir = "images/";
        $uploadedFileName = basename($_FILES["categoryImage"]["name"]);
        $uploadedFile = $uploadDir . $uploadedFileName;

        if (move_uploaded_file($_FILES["categoryImage"]["tmp_name"], $uploadedFile)) {
            echo "Image uploaded successfully.";
        } else {
            echo "Failed to upload image.";
            $uploadedFile = '';  
        }
    }

    $updateParams = array(
        'category_name' => $categoryName,
        'category_description' => $categoryDescription,
        'parent_category_id' => $parent_category_id,
    );

    if (!empty($uploadedFile)) {
        $updateParams['category_image_path'] = $uploadedFile;
    }

    $whereClause = "category_id = $id";
    $updateResult = $obj->updateData('categories', $updateParams, $whereClause);

    if ($updateResult) {
        $updatedCategory = $obj->sqlData("SELECT category_id, category_name, category_image_path FROM categories WHERE category_id = $id");
        $selectedCategoryID = isset($updatedCategory[0]['category_id']) ? $updatedCategory[0]['category_id'] : '';
        $categoryImagePath = isset($updatedCategory[0]['category_image_path']) ? $updatedCategory[0]['category_image_path'] : '';

        $successMessage = ' Update Successfully';
            
    } else {
        $errorMessage = 'Update Unsuccessfully';
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

<div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            <!-- Main-body start -->
                            <div class="main-body tablesize">
                                <div class="page-wrapper">
									<!-- Page-header start -->
                                    <div class="page-header card">
                                        <div class="card-block">
                                            <h5 class="m-b-10">Update Category Management </h5>
                                            <!-- <p class="text-muted m-b-10">lorem ipsum dolor sit amet, consectetur adipisicing elit</p> -->
                                            <ul class="breadcrumb-title b-t-default p-t-10">
              <li class="breadcrumb-item">
                <a href="index.html"> <i class="fa fa-home"></i> </a>
              </li>
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a>
              </li>
              <li class="breadcrumb-item "><a href="#!">Update Category Management</a>
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
$id = isset($_GET['id']) ? $_GET['id'] : '';

$obj = new Database();
$obj->sqlData("SELECT * FROM categories WHERE category_id = '$id'");
$results = $obj->getResult();

if (!empty($results)) {
    $category_name = $results[0]['category_name'];
    $categoryDescription = $results[0]['category_description'];
    $categoryImagePath = $results[0]['category_image_path'];
    $parent_category_id = $results[0]['parent_category_id'];  
} else {
    $category_name = '';
    $categoryDescription = '';
    $categoryImagePath = '';
    $parent_category_id = '';  
}

// Fetch parent category name
$parentCategoryName = '';
if (!empty($parent_category_id)) {
    $obj->sqlData("SELECT category_name FROM categories WHERE category_id = '$parent_category_id'");
    $parentCategoryResult = $obj->getResult();
    if (!empty($parentCategoryResult)) {
        $parentCategoryName = $parentCategoryResult[0]['category_name'];
    }
}
?>
<form method="post" enctype="multipart/form-data" class="row g-3 p-5">
  <div class="col-md-6">
    <label for="inputEmail4" class="form-label">Category Name <span class="star">*</span></label>
    <input type="text" class="form-control tablesize" value="<?php echo htmlspecialchars($category_name); ?>" name="categoryName" id="inputEmail4">
    <input type="hidden" name="id" value="<?= $id ?>"> 
    
</div>
<div class="col-md-6">
    <label for="parent_category_id" class="form-label">Parent Category</label>
    <select id="parent_category_id" name="parent_category_id" class="form-select tablesize">
  
        <?php
        
        $obj = new Categories();
        $parentCategories = $obj->getCategories();
        foreach ($parentCategories as $category) {
            $category_id = $category['category_id'];
            $category_name = $category['category_name'];
            $selected = ($category_id == $parent_category_id) ? 'selected="selected"' : '';
            echo '<option value="' . $category_id . '" ' . $selected . '>' . $category_name . '</option>';
        }
        ?>
    </select>
</div>

<div class="col-12">
    <label for="">Category Description <span class="star">*</span></label>
    <div class="form-floating tablesize">
      <textarea name="categoryDes" id="editor" cols="30" rows="10">
      <?php echo htmlspecialchars($categoryDescription); ?>
    </textarea>

    </div>

  </div>
  <div class="col-md-6">
    <label for="categoryImage">Category Image <span class="star">*</span></label>
    <input type="file" name="categoryImage" id="categoryImage">
</div>

<div class="col-md-4">
    <?php

    $imageSrc = (!empty($_FILES["categoryImage"]["name"])) ? "images/" . htmlspecialchars($_FILES["categoryImage"]["name"]) : $categoryImagePath;

 
    if (!empty($imageSrc) && file_exists($imageSrc)) {
        echo '<img src="' . $imageSrc . '" class="categoryimage" id="img-upload-tag" alt="category" width="60px" />';
    } else {
        echo '<img src="images/remove3.png" class="categoryimage" id="img-upload-tag" alt="category" width="60px" />';
    }
    ?>
</div>

 <div class="col-md-12 ">
    <a class="btn btn-outline-dark buttonsize" href="category.php" role="button">
      Cancel
    </a>
    <button type="submit" name="submit" value="submit" class="btn btn-primary float-end buttonsize">Save</button>
  </div>
</form>
</div>
           


                        <script src="./js/updatecategory.js"></script>
<?php include 'footer.php' ?>
