<?php
include 'header.php';
include 'sidebar.php';
include 'Classes/Categori.php';
include 'Classes/Product.php';

$successMessage = '';
$errorMessage = '';
$name_error = '';
$price_error = '';
$discount_error = '';
$productname = '';
$prod_price = '';
$product_discount = '';
$sku_error = '';
$prod_sku = '';
$prod_quantity = '';
$quntity_error = '';
$img_error = '';
$productDes = '';
$des_error = '';

if (isset($_POST["submit"])) {
  $obj = new Product();

  $productname = trim($_POST["productname"]);
  $prod_price = trim($_POST["productPrice"]);
  $product_discount = trim($_POST["productdiscount"]);
  $prod_quantity = trim($_POST["qtyProduct"]);
  $prod_sku = trim($_POST["skuProduct"]);
  $productDes = trim($_POST["productDes"]);
  $category_id = trim($_POST["category_id"]);
  $sub_category_id = $_POST["sub_category_id"];
  $productLaunch = $_POST["launch"];
  $status = isset($_POST["status"]) && $_POST["status"] == "on" ? 1 : 0;
  $productLaunchFormatted = date('Y-m-d', strtotime($productLaunch));

  if (empty($productname)) {
    $name_error = "Please Enter Name";
  }

  if (empty($prod_price)) {
    $price_error = "Please Enter price";
  } elseif (!is_numeric($prod_price)) {
    $price_error = "Price must be a valid number";
  }

  if (empty($product_discount)) {
    $discount_error = "Please Enter discount";
  } elseif (!is_numeric($product_discount)) {
    $discount_error = "Discount must be a valid number";
  }

  if (empty($prod_sku)) {
    $sku_error = "Please Enter Sku";
  }

  if (empty($prod_quantity)) {
    $quntity_error = "Please Enter Quantity";
  }

  if (empty($productDes)) {
    $des_error = "Please Enter Des";
  }


  if (empty($name_error) && empty($price_error) && empty($discount_error) && ($prod_price >= $product_discount)
    && empty($sku_error)  && empty($des_error)) {
    try {
      $categoriObj = new Product();
      $response = $categoriObj->addProduct(
        $productname,
        $productDes,
        $category_id,
        $sub_category_id,
        $prod_quantity,
        $prod_price,
        $product_discount,
        $prod_sku,
        $productLaunchFormatted,
        $status,
        $obj
      );
      $successMessage = 'Product added successfully';
    } catch (Exception $e) {
      $errorMessage = 'Error: ' . $e->getMessage();
    }
  } elseif ($prod_price < $product_discount) {
    $price_error = "Price must be greater than or equal to the discount.";
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
              <form id="categoryForm" method="post" enctype="multipart/form-data" class="row g-3 p-5">
                <div class="col-md-6">
                  <label for="inputEmail4" class="form-label ">Product Name <span class="star">*</span></label>
                  <input type="text" class="form-control tablesize" name="productname" placeholder="Enter Name" value="<?php echo $productname ?>" id="productname">
                  <span style="color:red;"><?php if ($productname != "") {
                                            } else {
                                              echo $name_error;
                                            } ?></span>
                </div>
                <div class="col-md-6">
                  <div class="form-check form-switch  float-end">
                    <label>Public Now / Draft</label>

                    <input class="form-check-input  mtt-5 margincheckbox" name="status" style="margin-left:-72px" type="checkbox" id="flexSwitchCheckDefault">
                    <label class="form-check-label" for="flexSwitchCheckDefault"></label>
                  </div>


                </div>
                <div class="col-md-4">
                  <label for="parent_category_id" class="form-label"> Category </label>

                  <select name="category_id" id="categoryId" class="form-select">
                    <?php
                    $obj = new Categori();
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
                  <label for="parent_category_id" class="form-label">Sub Category </label>
                  <select id="subCategoryId" name="sub_category_id" class="form-select">
                    <?php

                    $obj = new Product();

                    $results = $obj->getProductCategories();

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
                  <input type="text" class="form-control tablesize" placeholder="Enter Product Price" id="productPrice" value="<?php echo $prod_price ?>" name="productPrice">
                  <span style="color:red;"><?php if (!empty($price_error)) {
                                              echo $price_error;
                                            } ?></span>
                </div>
                <div class="col-md-2">
                  <label for="productdiscount" class="form-label">Discount <span class="star">*</span></label>
                  <input type="text" class="form-control tablesize" placeholder="Enter Product Discount" id="productdiscount" value="<?php echo $product_discount ?>" name="productdiscount"> <!-- Changed 'name' to 'productdiscount' -->

                  <span style="color:red;"><?php if (!empty($discount_error)) {
                                              echo $discount_error;
                                            } ?></span>

                </div>

                <div class="col-md-4">
                  <label for="inputEmail4" class="form-label">Quantity <span class="star">*</span></label>
                  <input type="text" class="form-control tablesize" placeholder="Enter Product Quantity" name="qtyProduct" value="<?php echo $prod_quantity ?>"  id="qtyProduct">
                  <span style="color:red;"><?php if ($prod_quantity != "") {} else {echo $quntity_error;} ?></span>
               
                </div>
                

                <div class="col-md-4">

                  <label for="inputEmail4" class="form-label">SKU <span class="star">*</span></label>
                  <input type="text" class="form-control tablesize" placeholder="Enter SKU" name="skuProduct" value="<?php echo $prod_sku ?>" id="skuProduct">
                  <span style="color:red;"><?php if ($prod_sku != "") {
                                            } else {
                                              echo $sku_error;
                                            } ?></span>
               
                </div>
                <div class=" col-md-4 ">
                  <label for="inputEmail4" class="form-label">Launch Date</label>

                  <div class="input-group ">

                    <input placeholder="Select your date" type="text" name="launch" id="datepicker" value="" class="form-control tablesize">
                    <span class="input-group-text bg-white border-0 " id="basic-addon2"><img width="25px" height="21px" src="images/calender.png" alt="calendar--v1" /></span>
                  </div>

                </div>

            </div>

            <div class="col-12">

              <label for="">Product Description </label>
              <div id="productDes" class="form-floating tablesize">

                <textarea name="productDes"  id="editor" cols="30" rows="10" value="<?php echo $productDes ?>">
                </textarea>
                <span style="color:red;"><?php if ($productDes != "") {
                                            } else {
                                              echo $des_error;
                                            } ?></span>
              
              </div>
            </div>
            <div class="col-md-12 mt-3 d-flex">
              <div class="col-md-4">
                <label for="formFileSm" class="form-label">Update Image <span class="star">*</span></label>
                <input type="file" name="media-upload[]" id="media-upload" class="form-control form-control-sm mediaupload" accept="image/*" multiple><br><br>
   <!-- <span style="color:red;"></?php if ($_FILES["media-upload"]["name"] != "") {
                                            } else {
                                              echo $img_error;
                                            } ?></span>
                -->
               
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
                        <strong id="previewEmail">Category :</strong>
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