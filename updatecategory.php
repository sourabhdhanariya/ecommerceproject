<?php include 'header.php';
include 'sidebar.php';
include "Classes/Categori.php";

$successMessage = '';
$errorMessage = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $categoriObj = new CategoriClass();

    $categoryName = $_POST['categoryName'];
    $parent_category_id = $_POST['parent_category_id'];
    $categoryDescription = $_POST['categoryDes'];
    $response = $categoriObj->updateCategory($categoryName, $categoryDescription, $parent_category_id, $_FILES["categoryImage"], $categoriObj); // Pass $obj as an argument
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

                            $obj = new CategoriClass();

                            if (!empty($id)) {
                                $results = $obj->selectCategory($id);
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
                            }

                            $parentCategoryName = '';
                            if (!empty($parent_category_id)) {
                                $parentCategoryResult = $obj->selectCategory($parent_category_id);

                                if (!empty($parentCategoryResult)) {
                                    $parentCategoryName = $parentCategoryResult[0]['category_name'];
                                }
                            }
                            ?>
                            <form id="categoryUpdateForm" method="post" enctype="multipart/form-data" class="row g-3 p-5">

                                <div class="col-md-6">
                                    <label for="inputEmail4" class="form-label">Category Name <span class="star">*</span></label>
                                    <input type="text" class="form-control tablesize" value="<?php echo htmlspecialchars($category_name); ?>" name="categoryName" id="categoryName">
                                    <input type="hidden" name="id" value="<?= $id ?>">
                                    <!-- <span style="color:red;"></?php if ($categoryName != "") {
                                                                }  ?></span> -->
                                </div>
                                <div class="col-md-6">
                                    <label for="parent_category_id" class="form-label">Parent Category</label>
                                    <select id="parent_category_id" name="parent_category_id" class="form-select tablesize">

                                        <?php

                                        $obj = new CategoriClass();
                                        echo '<option value="0">No Parent Categories </option>';
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
                                    // Assuming $categoryImagePath is the path to the category image
                                    if (!empty($categoryImagePath)) {
                                        echo '<img class="imageborder" style="border:thick double #30464e;" src="images/category/' . htmlspecialchars($categoryImagePath) . '" width="60px" alt="image">';
                                    } else {
                                        // Display the default image
                                        echo '<img src="images/remove3.png" width="60px" alt="Default Image">';
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


                        <script>
                            $(document).ready(function() {
                                $('#categoryUpdateForm').validate({
                                    rules: {
                                        categoryName: {
                                            required: true
                                        }
                                    },
                                    messages: {
                                        categoryName: {
                                            required: "Name field can not be blank"
                                        }
                                    },
                                    submitHandler: function(form) {
                                        form.submit();
                                    }
                                });
                            });
                        </script>

                        <script src="./js/updatecategory.js"></script>
                        <?php include 'footer.php' ?>