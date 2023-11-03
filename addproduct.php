<?php
include 'header.php';
include 'sidebar.php';
include 'Classes/Categori.php';
include 'Classes/Product.php';
include 'Classes/Productvariate.php';


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

if (isset($_POST["submit"])) {
  $obj = new Product();

  $productname = trim($_POST["productname"]);
  $prod_price = trim($_POST["productPrice"]);
  $product_discount = trim($_POST["productdiscount"]);
  $prod_quantity = trim($_POST["qtyProduct"]);
  $prod_sku = trim($_POST["skuProduct"]);
  $productDes = trim($_POST["productDes"]);


  $category_id = trim($_POST["category_id"]);
  $productLaunch = $_POST["launch"];
  $status = isset($_POST["status"]) && $_POST["status"] == "on" ? 1 : 0;
  $productLaunchFormatted = date('Y-m-d', strtotime($productLaunch));
  // product_manage_table
  
  $product_variate = trim($_POST["product_variate"]);
  $product_attribute = trim($_POST["product_attribute"]);
  $product_qty = trim($_POST["product_qty"]);
  
// end 


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


  if (
    empty($name_error) && empty($price_error) && empty($discount_error) && ($prod_price >= $product_discount)
    && empty($sku_error)
  ) {
    try {
      $categoriObj = new Product();
      $response = $categoriObj->addProduct(
        $productname,
        $productDes,
        $category_id,
        $prod_quantity,
        $prod_price,
        $product_discount,
        $prod_sku,
        $productLaunchFormatted,
        $status,
        $obj,
// product management table 
        $product_variate,
        $product_attribute,
        $product_qty

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
<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://cdn.materialdesignicons.com/5.0.45/css/materialdesignicons.min.css">
<link rel="stylesheet" href="style1.css">
<style>
  body {}

  .container {
    margin: 150px auto;
  }
</style>
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


                <?php
                $products = new Product();
                $categoryData = $products->fetchCategoryData(0);
                ?>
<div class="col-lg-5">
    <label for="category_id" class="form-label">Category</label>
    <input type="text" id="selectedCategoryId" name="category_id" value=""/>
    <input type="text" class="form-select tablesize" id="categoryComboTree" placeholder="Category" autocomplete="off" />
</div>



                <div class="col-md-3">
                  <label for="productPrice" class="form-label">Price per Unit <span class="star">*</span></label>
                  <input type="text" class="form-control tablesize" placeholder="Enter Product Price" id="productPrice" value="<?php echo $prod_price ?>" name="productPrice">
                  <span style="color:red;"><?php if (!empty($price_error)) {
                                              echo $price_error;
                                            } ?></span>
                </div>
                <div class="col-md-3">
                  <label for="productdiscount" class="form-label">Discount <span class="star">*</span></label>
                  <input type="text" class="form-control tablesize" placeholder="Enter Product Discount" id="productdiscount" value="<?php echo $product_discount ?>" name="productdiscount"> <!-- Changed 'name' to 'productdiscount' -->

                  <span style="color:red;"><?php if (!empty($discount_error)) {
                                              echo $discount_error;
                                            } ?></span>

                </div>

                <div class="col-md-4">
                  <label for="inputEmail4" class="form-label">Quantity <span class="star">*</span></label>
                  <input type="text" class="form-control tablesize" placeholder="Enter Product Quantity" name="qtyProduct" value="<?php echo $prod_quantity ?>" id="qtyProduct">
                  <span style="color:red;"><?php if ($prod_quantity != "") {
                                            } else {
                                              echo $quntity_error;
                                            } ?></span>

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

                <div class="col-md-12">
                <div class="customer_records">
            <div class="customer_records">
                
                <div class="col-md-12 d-flex" >
              
                <div class="col-md-4">
    <label for="customer_name">Select Variate</label>
    <select id="parent_category_id" name="product_variate" class="form-select tablesize" onchange="updateVariate()">
        <?php
        $obj = new Productvariate();
        // add categories
        $categories = $obj->productVariate1();
        if (!empty($categories)) {
            echo '<option value="0">No Select variate  </option>';
            foreach ($categories as $category) {
                echo '<option value="' . $category["id"] . '">' . $category["name"] . "</option>";
            }
        } else {
            echo '<option value="0">No Select variate </option>';
        }
        ?>
    </select>
    <br>
</div>

<div class="col-md-4">
    <div class="form-group">
        <label for="customer_name">Enter Variate</label>
        <input type="text" class="form-control" name="product_attribute" id="enter_variate" placeholder="Enter Variate">
    </div>
</div> 

            <div class="col-md-4">
                <div class="form-group">
                    <label for="qyt_name">Enter Quantity</label>
                    <input type="text" class="form-control" name="product_qty" id="qyt_name" placeholder="Enter Quantity" >
                </div>
            </div>
                
            </div>
<!-- 
                <a class="extra-fields-customer" href="#">Add More Customer</a> -->
            </div>
             <a name="" id="" class="btn btn-primary extra-fields-customer btn-sm  float-end " href="#" role="button">Add </a>
   <br><br><br><br>
            <div class="customer_records_dynamic">
                <div class="input_fields_wrap">
                    <!-- This is where dynamically added fields will go. -->
                </div>
            </div>
        </div>
                                          </div>                               </div>
            </div>

            <div class="col-12">

              <label for="">Product Description </label>
              <div id="productDes" class="form-floating tablesize">

                <textarea name="productDes" id="editor" cols="30" rows="10" value="<?php echo $productDes ?>">
                </textarea>
              </div>
            </div>
            <div class="col-md-12 mt-3 d-flex">
              <div class="col-md-4">
                <label for="formFileSm" class="form-label">Update Image <span class="star">*</span></label>
                <input type="file" name="media-upload[]" id="media-upload" class="form-control form-control-sm mediaupload" accept="image/*" multiple><br><br>

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
          <script>
            jQuery(document).ready(function() {
              jQuery('#datepicker').datepicker({
                dateFormat: 'yy-mm-dd',
                minDate: 0
              });
            });
          </script>

          <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
          <script src="comboTreePlugin.js" type="text/javascript"></script>
          <script type="text/javascript">
   $(document).ready(function() {
    $.ajax({
        url: 'Classes/get_categories.php',
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            $('#categoryComboTree').comboTree({
                source: data,
                isMultiple: false,
                cascadeSelect: false,
                collapse: true,
                selectName: 'title',
                selectValue: 'id',
            });

            // Add an event listener to handle changes in the comboTree selection
            $('#categoryComboTree').on('combotree:change', function(event, values) {
                // Get the selected category ID
                var selectedCategoryID = values[0];

                // Update the hidden input field's value with the selected category ID
                $('#selectedCategoryId').val(selectedCategoryID);
            });
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
});

  </script> 
<script>
    $(document).ready(function() {
        var max_fields = 10; // maximum input boxes allowed
        var wrapper = $(".input_fields_wrap"); // Fields wrapper
        var add_button = $(".extra-fields-customer"); // Add button ID
        var x = 1; // initial text box count

        $(add_button).click(function(e) {
            e.preventDefault();
            if (x < max_fields) {
                x++;

                var fieldHtml = `
                    <div>
                        <div class="form-row ms-5">
                            <div class="form-group col-md-3">
                                <select class="form-control" name="variate_name[${x}]" id="variate_name_${x}">
                                    <option>Color</option>
                                    <option>Size</option>
                                </select>
                            </div>
                            <div class="col-md-8">
                            <input type="checkbox"  class="enable-disable ms-5" name="mycheckbox[${x}]"/>
                            <input type="text" class="h-75"  name="mytext[${x}]" disabled/>
                            <input type="text" class="ms-5 h-75" placeholder="Please Enter Quality" name="mydate[${x}]" disabled/>
                        </div>
                      
          <a name="" id="" class="btn btn-danger remove_field" style="height:36px;" href="#" role="button">X</a>
                        </div>
                    </div>
                `;

                $(wrapper).append(fieldHtml);
            }
        });

        $(wrapper).on("click", ".remove_field", function(e) {
            e.preventDefault();
            $(this).closest('div').remove();
            x--;
        });

        // Add event listener for checkbox elements in dynamically added fields
        wrapper.on("change", ".enable-disable", function() {
            var textInputs = $(this).siblings("input[type='text']");
            textInputs.prop("disabled", !this.checked);
        });
    });
</script>
<script>
    function updateVariate() {
        var selectElement = document.getElementById("parent_category_id");
        var inputElement = document.getElementById("enter_variate");
        
        // Get the selected option's value
        var selectedValue = selectElement.value;

        // Get the attribute name associated with the selected value
        var attributeName = getAttributeName(selectedValue);

        // Set the value of the "Enter Variate" input field to the attribute name
        inputElement.value = attributeName;
    }

    // Function to retrieve the attribute name based on the selected value
    function getAttributeName(selectedValue) {
        <?php
        $obj = new Productvariate();
        $variate = $obj->productVariate1();
        if (!empty($variate)) {
            foreach ($variate as $item) {
                echo "if (selectedValue == " . $item["id"] . ") {
                        return '" . $item["attribute"] . "';
                    }";
            }
        }
        ?>
        return ''; // Return an empty string if no match is found
    }
</script>


          <script src="./js/addproduct.js"></script>
          <?php include 'footer.php' ?>