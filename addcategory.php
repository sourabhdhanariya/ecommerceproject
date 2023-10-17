<?php
include "header.php";
include "sidebar.php";

$successMessage = "";
$errorMessage = "";

if (isset($_POST["submit"])) {
    $obj = new Database();
    $categoryName = $_POST["categoryName"];
    $categoryDes = $_POST["categoryDes"];
    $parent_category_id = !empty($_POST["parent_category_id"])
        ? $_POST["parent_category_id"]
        : null;

    if ($parent_category_id === "") {
        $parent_category_id = "";
    }

    if (
        isset($_FILES["categoryImage"]) &&
        $_FILES["categoryImage"]["error"] === UPLOAD_ERR_OK
    ) {
        $uploadDir = "images/";
        $uploadedFile = $uploadDir . basename($_FILES["categoryImage"]["name"]);

        if (
            move_uploaded_file(
                $_FILES["categoryImage"]["tmp_name"],
                $uploadedFile
            )
        ) {
            $dataToInsert = [
                "category_name" => $categoryName,
                "category_description" => $categoryDes,
                "category_image_path" => $uploadedFile,
                "parent_category_id" => $parent_category_id,
            ];

            try {
                $result = $obj->insertData("categories", $dataToInsert);
                if ($result === true) {
                    $successMessage = "Form added successfully";
                } else {
                    $errorMessage =
                        "Error: " . implode(", ", $obj->getResult());
                }
            } catch (mysqli_sql_exception $e) {
                if ($e->getCode() === 1062) {
                    $errorMessage = "Category name already exists.";
                } else {
                    $errorMessage = "Error: " . $e->getMessage();
                }
            }
        } else {
            $errorMessage = "Error: File upload failed";
        }
    } else {
        $errorMessage = "Error: No file uploaded";
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
                        <h5 class="m-b-10">Add Category Management</h5>
                        <!-- <p class="text-muted m-b-10">lorem ipsum dolor sit amet, consectetur adipisicing elit</p> -->
                        <ul class="breadcrumb-title b-t-default p-t-10">
              <li class="breadcrumb-item">
                <a href="index.html"> <i class="fa fa-home"></i> </a>
              </li>
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a>
              </li>
              <li class="breadcrumb-item "><a href="#!">Add Category Management</a>
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
                            <form id="categoryForm" method="post" enctype="multipart/form-data" class="row g-3 p-5 ">
                                <div class="col-md-6">
                                    <label for="inputEmail4" class="form-label">Category Name <span class="star">*</span></label>
                                    <input type="text" class="form-control tablesize text-capitalize" name="categoryName" id="categoryName" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="parent_category_id" class="form-label">Parent Category </label>
                                    <select id="parent_category_id" name="parent_category_id" class="form-select tablesize">
                                        <?php
                                        $obj = new Categories();
                                        //add categories
                                        $categories = $obj->getCategories();
                                        if (!empty($categories)) {
                                            foreach ($categories as $category) {
                                                echo '<option value="' .
                                                    $category["category_id"] .
                                                    '">' .
                                                    $category["category_name"] .
                                                    "</option>";
                                            }
                                        } else {
                                            echo '<option value="0">No Parent Categories found</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-12">

                                    <label for="">Category Description <span class="star">*</span> </label>
                                    <div class="form-floating">
                                        <textarea name="categoryDes" class="tablesize" id="editor" cols="30" rows="10" required>
                                        </textarea>
                                    </div>
                                </div>

                                <div class="col-md-6">

                                    <label for="">Category Image  <span class="star">*</span></label>

                                    <input type="file" name="categoryImage" id="img-upload">
                                </div>

                                <div class="col-md-4">

                                    <img src="images/remove3.png" class="categoryimage" id="img-upload-tag" alt="category" width="60px" />
                                </div>
                                <div class="col-12">
                                    <a class="btn btn-outline-dark buttonsize" href="category.php" role="button">
                                        Cancel
                                    </a>

                                    <button type="submit" name="submit" id="submitButton" value="submit" class="btn btn-primary float-end buttonsize">Save</button>
                                </div>
                            </form>
</div>
<script src="./js/addcategory.js"></script>
<?php include "footer.php"; ?>
                  