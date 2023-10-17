
<?php 
include 'header.php';
include 'sidebar.php'; 
?>
<div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            <!-- Main-body start -->
                            <div class="main-body">
                                <div class="page-wrapper">
									<!-- Page-header start -->
                                    <div class="page-header card">
                                        <div class="card-block">
                                            <h5 class="m-b-10">Customer Management</h5>
                                            <!-- <p class="text-muted m-b-10">lorem ipsum dolor sit amet, consectetur adipisicing elit</p> -->
                                            <ul class="breadcrumb-title b-t-default p-t-10">
                                                <li class="breadcrumb-item">
                                                    <a href="dashboard.php"> <i class="fa fa-home"></i> </a>
                                                </li>
                                               <li class="breadcrumb-item"><a href="#!">Dashboard</a>
                                                        </li>
                                                        <li class="breadcrumb-item"><a href="#!">Customer Management</a>
                                                        </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- Page-header end -->                           
                                <!-- Page-body start -->
                                <div class="page-body">
                                    <!-- Basic table card start -->
                                    <div class="card">
                                        <div class="card-header">
                                          
                                          <div class="card-header-right">
												<ul class="list-unstyled card-option">
													<li><i class="fa fa-chevron-left"></i></li>
													<li><i class="fa fa-window-maximize full-card"></i></li>
													<li><i class="fa fa-minus minimize-card"></i></li>
													<li><i class="fa fa-refresh reload-card"></i></li>
													<li><i class="fa fa-times close-card"></i></li>
												</ul>
											</div>

                                        </div>
                                        <div class="card-block table-border-style">
                                            <div class="table-responsive tablesize " >
                                            <table id="example" class="table data-table " >
                        <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile No.</th>
                                <th>Reg. Date</th>     
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
$obj = new Database();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $categoryId = isset($_POST['id']) ? $_POST['id'] : 0;
    $newStatus = isset($_POST['active']) ? ($_POST['active'] == 'Active' ? 1 : 0) : 0;

    $updateParams = array('status' => $newStatus);
    $whereClause = "customer_id = $categoryId";
    $updateResult = $obj->updateData('customer', $updateParams, $whereClause);

    if ($updateResult) {
        echo "Update successful!";
    } else {
        echo "Update failed. Error: " . implode(', ', $obj->getResult());
    }
}

$sql = $obj->selectData(
 'customer'
);
if (is_string($sql)) {
    $obj->sqlData($sql);
    $results = $obj->getResult();
    $counter = 1;
} else {
    echo "Invalid SQL query: $sql";
}

if (!empty($results)) {
    foreach ($results as $row) {
        $name = $row['customer_name'];
        $customer_email = $row['customer_email'];
        $customer_mobile = $row['customer_mobile'];
        $reg_date = $row['customer_date'];
        $id = $row['customer_id'];
        $customer_billing = $row['customerbilling_address1'];
        $customer_shipping = $row['shipping_address1'];
        $status = $row['status'];
        $statusLabel = ($status == 1) ? 'Active' : 'Deactive';
?>

<tr>
    <td><?= $counter ?></td>
    <td>
        <button type="button" class="btn btn-link btn-sm view-btn" data-toggle="modal"
                data-category-id="<?= $id ?>" data-category-name="<?= $name ?>"
                data-customer-email="<?= $customer_email ?>"
                data-customer-mobile="<?= $customer_mobile ?>"
                data-customer-billing="<?= $customer_billing ?>"
                data-customer-shipping="<?= $customer_shipping ?>"
                data-target="#modelId">
            <?= $name ?>
        </button>
    </td>

    <td><?= $customer_email ?></td>
    <td><?= $customer_mobile ?></td>
    <td><?= $reg_date ?></td>

    <td>
        <div class="d-flex ">
            <a class="btn btn-sm" href="updatecustomer.php?updatecustomerid=<?= $id ?>" role="button">
                <img src="images/edit.png" class="imageweightview" alt="view">
            </a>
            
            <div class="form-check form-switch toggle">
                <form method="post">
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <input type="hidden" name="active" value="<?= ($status == 1) ? 'Active' : 'Deactivate' ?>">
                    <input class="form-check-input status-toggle imageweightview" style="margin-top: 11px;" name="active_checkbox" type="checkbox" value="1" id="flexSwitchCheckDefault_<?= $id ?>" <?= ($status == 1) ? 'checked' : '' ?>>
                </form>
            </div>

        </div>
    </td>
</tr>


<?php
$counter++;
}
} else {
?>
<tr>
    <td colspan="4">No data found.</td>
</tr>
<?php
}
?>


</tbody>
      
</table>                                            </div>
                                        </div>
                                    </div>


                                    <!-- Button trigger modal -->
                                  
                                    
                                    <!-- Modal -->
                                    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                    <div class="modal-header">
                                                            <h5 class="modal-title">Customer Details</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                        </div>
                                                        <div class="modal-body">
            <div class="modelbox d-flex">
   
            <div class="text p-3 w-100 ">
            <h6 class="fw-bold tables tablesize">Name: <span class="float-end fw-normal" id="categoryname">Ed J. McMillan</span></h6>
                <h6 class=" fw-bold tablesize" >Email: <span class="float-end fw-normal" id="customer_email">abc@xyz.com</span></h6>
   
        
                <h6 class="tablesize fw-bold ">Phone: <spanc class=" float-end fw-normal" id="category_mobile"> 9876543456</span></h6>
                <h6 class="tablesize fw-bold ">Billing Address: <spanc class=" float-end fw-normal" id="customer_billing"> 3076 Spring Avenue Norristown Pa 194403</span></h6>
                <h6 class="tablesize fw-bold ">Shipping Address: <spanc class="float-end fw-normal" id="customer_shiping"> 1830 Clarence Count Santa Fe Spring, CA 90670</span></h6>
              
                <p class="invisible">Category ID: <span id="category-id-placeholder"></span></p>

              </div>
      

</div>
  </div>          <div class="modal-footer">
                                                <button type="button" class="btn btn-primary d-flex m-auto buttonsize" data-dismiss="modal">ok</button>
    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
<script src="./js/product.js"></script>
<?php include 'footer.php' ?>
