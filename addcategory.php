<?php
include "header.php";
include "sidebar.php";
include "Classes/Categori.php";
$name_error = '';
$categoryName = '';
if (isset($_POST["submit"])) {
    $categoryName = trim($_POST["categoryName"]);
    $categoryDes = $_POST["categoryDes"];
    $parent_category_id = !empty($_POST["parent_category_id"]) ? $_POST["parent_category_id"] : "";
    if (!empty($categoryName)) {
        $categoriObj = new Categori();
        $response = $categoriObj->addCategory(
            $categoryName,
            $categoryDes,
            $parent_category_id,
            $_FILES["categoryImage"]
        );
    } else {
        if (empty($categoryName)) {
            $name_error = "Please Enter Name";
        }
    }
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
                <div class="page-body">
                    <div class="card">
                        <div class="">
                            <form id="categoryForm" method="post" enctype="multipart/form-data" class="row g-3 p-5 ">
                                <div class="col-md-6">
                                    <label for="inputEmail4" class="form-label">Category Name <span class="star">*</span></label>

                                    <input type="text" class="form-control tablesize text-capitalize" name="categoryName" placeholder="Category Name" value="<?php echo $categoryName ?>" id="categoryName">
                                    <span style="color:red;"><?php if ($categoryName != "") {
                                                                } else {
                                                                    echo $name_error;
                                                                } ?></span>

                                </div>
                                <div class="col-md-6">
                                    <label for="parent_category_id" class="form-label">Parent Category </label>
                                    <select id="parent_category_id" name="parent_category_id" class="form-select tablesize">
                                        <?php
                                        $obj = new Categori();
                                        //add categories
                                        $categories = $obj->getCategories();
                                        if (!empty($categories)) {
                                            echo '<option value="0">No Parent Categories </option>';

                                            foreach ($categories as $category) {

                                                echo
                                                '<option value="' .
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

                                    <label for="">Category Image <span class="star">*</span></label>

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