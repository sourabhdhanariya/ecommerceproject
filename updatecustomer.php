
<?php include 'header.php';
include 'sidebar.php';

?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <!-- Include toastr.css for styling -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

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
            <h5 class="m-b-10">Update Customer Management </h5>
            <!-- <p class="text-muted m-b-10">lorem ipsum dolor sit amet, consectetur adipisicing elit</p> -->
            <ul class="breadcrumb-title b-t-default p-t-10">
              <li class="breadcrumb-item">
                <a href="index.html"> <i class="fa fa-home"></i> </a>
              </li>
              <li class="breadcrumb-item"><a href="#!">Dashboard</a>
              </li>
              <li class="breadcrumb-item "><a href="#!">Update Customer Management </a>
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
              
$obj = new Database();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


  $customername = $_POST['customername'];
  $mobile_Name = $_POST['mobile_name'];
  $email = $_POST['email_address'];
  // Billing Address
  $billingAdd1 = $_POST['biladdress1'];
  $billingAdd2 = $_POST['biladdress2'];
  $billingCity = $_POST['bilcity'];
  $billingState = $_POST['bilstate'];
  $billingCity = $_POST['billcountry'];
  $billingZip = $_POST['billzip'];
  // Shipping Address 
  $shippingAdd1 = $_POST['shipaddress1'];
  $shippingAdd2 = $_POST['shipaddress2'];
  $shippingCity = $_POST['shipcity'];
  $shippingState = $_POST['shipstate'];
  $shippingCountry = $_POST['shipcountry'];
  $shippingZip = $_POST['shipzip'];

  $id = isset($_POST['id']) ? $_POST['id'] : '';
  $uploadedFile = '';  // Initialize uploadedFile
  $updateParams = array(
    'customer_name' => $customername,
    'customer_mobile' => $mobile_Name,
    'customer_email' => $email,
    'customerbilling_address1' => $billingAdd1,
    'customerbilling_address2' => $billingAdd2,
    'customerbilling_city' => $billingCity,
    'customerbilling_state' => $billingState,
    'customerbilling_country' => $billingCity,
    'shipping_address1' => $shippingAdd1,
    'shipping_address2' => $shippingAdd2,
    'shipping_city' => $shippingCity,
    'shipping_state' => $shippingState,
    'shipping_country' => $shippingCountry,
    'shipping_zip' => $shippingZip

  );

  if (!empty($uploadedFile)) {
    // Only update the image path if a new image was uploaded
    $updateParams['category_image_path'] = $uploadedFile;
  }

  $whereClause = "customer_id  = $id"; // Assuming $id contains the category ID
  $updateResult = $obj->updateData('customer', $updateParams, $whereClause);

  if ($updateResult) {
    // Fetch the updated category information
    $updatedCategory = $obj->sqlData("SELECT * FROM customer WHERE customer_id = $id");
    $selectedCategoryID = isset($updatedCategory[0]['customer_id']) ? $updatedCategory[0]['category_id'] : '';
    //  $categoryImagePath = isset($updatedCategory[0]['category_image_path']) ? $updatedCategory[0]['category_image_path'] : '';

    echo "<script>
    toastr.success('Form Updated successfully', 'Success');
    toastr.options = {
      positionClass: 'toast-top-right', 
      progressBar: true, 
  };

</script>";
  
} else {
    echo "Failed to update category. Error: " . implode(', ', $obj->getResult());
  }
}
              $id = isset($_GET['updatecustomerid']) ? $_GET['updatecustomerid'] : '';

              $obj = new Database();
              $obj->sqlData("SELECT * FROM customer WHERE customer_id = '$id'");
              $results = $obj->getResult();

              if (!empty($results)) {
                $customer_name = $results[0]['customer_name'];
                $customer_mobile = $results[0]['customer_mobile'];
                $customer_email = $results[0]['customer_email'];
                //Billing Address
                $customerbilling = $results[0]['customerbilling_address1'];
                $customerbilling2 = $results[0]['customerbilling_address2'];
                $customerCity = $results[0]['customerbilling_city'];
                $customerState = $results[0]['customerbilling_state'];
                $customerCountry = $results[0]['customerbilling_country'];
                $customerZip = $results[0]['customerbilling_zip'];
                //Shipping Address
                $shippingAddress = $results[0]['shipping_address1'];
                $shippingAddress2 = $results[0]['shipping_address2'];
                $shippingCity = $results[0]['shipping_city'];
                $shippingState = $results[0]['shipping_state'];
                $shippingCountry = $results[0]['shipping_country'];
                $shippingZip = $results[0]['shipping_zip'];
              } else {
                $category_name = '';
                $customer_mobile = '';
                $customer_email = '';
                //Billing Address
                $customerbilling = '';
                $customerbilling2 = '';
                $customerCity = '';
                $customerState = '';
                $customerCountry = '';
                $customerZip = '';
                //Shipping Address
                $shippingAddress = '';
                $shippingAddress2 = '';
                $shippingCity = '';
                $shippingState = '';
                $shippingCountry = '';
                $shippingZip = '';
              }

              ?>

          
<form id="customerform" method="post" class="row g-3 p-5 myForm">
  <div class="col-md-6">
    <label for="customerName" class="form-label">Customer Name <span class="star">*</span></label>
    <input type="text" class="form-control tablesize" name="customername" placeholder="Enter Name" value="<?php echo isset($customer_name) ? htmlspecialchars($customer_name) : ''; ?>" id="customerName" required>
    <input type="hidden" name="id" value="<?= $id ?>"> <!-- Add this hidden input for category ID -->
  </div>
  <div class="col-md-4">
    <label for="mobileName" class="form-label">Mobile Number <span class="star">*</span></label>
    <input type="text" class="form-control tablesize" name="mobile_name" value="<?php echo htmlspecialchars($customer_mobile); ?>" placeholder="Enter Mobile Name" id="mobileName" required>
  </div>


                <div class="col-md-6">
                  <label for="productPrice" class="form-label">Email Address <span class="star">*</span></label>

                  <input type="email" class="form-control tablesize" placeholder="Enter Email Address" value="<?php echo htmlspecialchars($customer_email); ?>" id="emailAddress" name="email_address" required>
                </div>

                <h5> Billing Address</h5>




                <div class="col-12">

                  <label for="">Address Line 1 </label>
                  <div class="form-floating tablesize">

                    <textarea name="biladdress1" id="editor1" cols="30" rows="10">
                    <?php echo htmlspecialchars($customerbilling); ?>"</textarea>
                  </div>


                </div>

                <div class="col-12">

                  <label for="">Address Line 2 </label>
                  <div class="form-floating tablesize">

                    <textarea name="biladdress2" id="editor2" cols="30" rows="10">
                 <?php echo htmlspecialchars($customerbilling2); ?>"</textarea>
                  </div>

                </div>

                <div class="col-md-6">
                  <label for="inputEmail4" class="form-label ">City <span class="star">*</span></label>
                  <input type="text" class="form-control tablesize" name="bilcity" value="<?php echo htmlspecialchars($customerCity); ?>" placeholder="Enter City" id="customerCity">

                </div>

                <div class="col-md-6">

                  <label for="inputEmail4" class="form-label ">State <span class="star">*</span></label>
                  <input type="text" class="form-control tablesize" name="bilstate" value="<?php echo htmlspecialchars($customerState); ?>" placeholder="Enter State" id="customer_state">

                </div>


                <div class="col-md-6">
                  <label for="inputEmail4" class="form-label ">Country <span class="star">*</span></label>
                  <input type="text" class="form-control tablesize" name="billcountry" value="<?php echo htmlspecialchars($customerCountry); ?>" placeholder="Enter Countery" id="customerCountery">
                </div>

                <div class="col-md-6">

                  <label for="inputEmail4" class="form-label ">Zip <span class="star">*</span></label>
                  <input type="number" class="form-control tablesize" name="billzip" value="<?php echo htmlspecialchars($customerZip); ?>" placeholder="Enter Zip" id="customer_zip">

                </div>

                <h5> Shipping Address</h5>

                <div class="col-12">

                  <label for="">Address Line 1 </label>
                  <div class="form-floating tablesize">

            <textarea name="shipaddress1" id="editor3" cols="30" rows="10">
              <?php echo htmlspecialchars($shippingAddress); ?></textarea>
                  </div>

                </div>

                <div class="col-12">

                  <label for="">Address Line 2 </label>
                  <div class="form-floating tablesize">

            <textarea name="shipaddress2" id="editor4" cols="30" rows="10">
            <?php echo htmlspecialchars($shippingAddress2); ?></textarea>
                  </div>

                </div>

                <div class="col-md-6">
                  <label for="inputEmail4" class="form-label ">City <span class="star">*</span></label>
                  <input type="text" class="form-control tablesize" name="shipcity" value="<?php echo htmlspecialchars($shippingCity); ?>" placeholder="Enter City" id="customerCity">

                </div>

                <div class="col-md-6">

                  <label for="inputEmail4" class="form-label ">State <span class="star">*</span></label>
                  <input type="text" class="form-control tablesize" name="shipstate" value="<?php echo htmlspecialchars($shippingState); ?>" placeholder="Enter State" id="customer_state">

                </div>


                <div class="col-md-6">
                  <label for="inputEmail4" class="form-label ">Country <span class="star">*</span></label>
                  <input type="text" class="form-control tablesize" name="shipcountry" value="<?php echo htmlspecialchars($shippingCountry); ?>" placeholder="Enter Countery" id="customerCountery">
                </div>

                <div class="col-md-6">

                  <label for="inputEmail4" class="form-label ">Zip <span class="star">*</span></label>
                  <input type="number" class="form-control tablesize" name="shipzip" value="<?php echo htmlspecialchars($shippingZip); ?>" placeholder="Enter Zip" id="customer_zip">

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
  $(document).ready(function() {
    $('#customerform').validate({
      rules: {
        customername: { // Use 'customername' instead of 'customerName'
          required: true
        },
        mobile_name: { // Use 'mobile_name' instead of 'mobileName'
          required: true,
          minlength: 10
        },
      },
      messages: {
        customername: { // Use 'customername' instead of 'customerName'
          required: "Customer field cannot be blank"
        },
        mobile_name: { // Use 'mobile_name' instead of 'mobileName'
          required: "Mobile field cannot be blank",
          minlength: "Mobile number must be at least 10 characters"
        }
      },
      submitHandler: function(form) {
        form.submit();
      }
    });
  });
  
</script>

          <script src="./js/updatecustomer.js"></script>
          <?php include 'footer.php' ?>