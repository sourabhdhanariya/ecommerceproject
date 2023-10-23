
<?php 
include 'header.php';
include 'sidebar.php'; 
include 'Classes/OrderClass.php'; 


?>
  <style>
    .custom-select {
      width: 200px;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .custom-select option[value="0"] {
      background-color: red;
      color: white;
    }

    .custom-select option[value="1"] {
      background-color: green;
      color: white;
    }

    .custom-select option[value="2"] {
      background-color: yellow;
    }
  </style>
<div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            <!-- Main-body start -->
                            <div class="main-body">
                                <div class="page-wrapper">
									<!-- Page-header start -->
                                    <div class="page-header card">
                                        <div class="card-block">
                                            <h5 class="m-b-10">Order Management</h5>
                                            <!-- <p class="text-muted m-b-10">lorem ipsum dolor sit amet, consectetur adipisicing elit</p> -->
                                            <ul class="breadcrumb-title b-t-default p-t-10">
                                                <li class="breadcrumb-item">
                                                    <a href="dashboard.php"> <i class="fa fa-home"></i> </a>
                                                </li>
                                               <li class="breadcrumb-item"><a href="#!">Dashboard</a>
                                                        </li>
                                                        <li class="breadcrumb-item"><a href="#!">Order Management</a>
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
                              
 <button type="button" class="btn-sm btn-primary" onclick="filterOrders('all')">All Orders</button>
<button type="button" class="btn-sm btn-primary" onclick="filterOrders('pending')">Pending</button>
<button type="button" class="btn-sm btn-primary" onclick="filterOrders('completed')">Completed</button>

<button type="button" class="btn-sm btn-primary" onclick="filterOrders('cancelled')">Cancelled</button>

<div class="col-md-3 float-right">
    <select id="timeFilter" class="form-select tablesize" aria-label="Default select example" onchange="filterByTime()">
        <option selected>Filter by Time</option>
        <option value="monthly">Monthly</option>
        <option value="yearly">Yearly</option>
        <option value="weekly">Weekly</option>
    </select>
</div>


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
                                <th>Order ID</th>
                                <th>Product Name</th>

                                <th>Address</th>
                                <th>Order Date</th>
                                <th>Price</th>
                                
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>


                        <?php
                        
                        
$obj = new OrderClass();

$obj->updateStatusOrder();



                        // $obj = new Database();

                        $selectedFilter = isset($_GET['filter']) ? $_GET['filter'] : 'all';
        
                        $obj = new OrderClass();
                    
                        $sql = $obj->selectorder();
    
                        $sql = "SELECT * FROM `customer_order` WHERE 1 ";
                        
                        if ($selectedFilter === 'completed') {
                            $sql .= "AND status = 1"; 
                        } elseif ($selectedFilter === 'pending') {
                            $sql .= "AND status = 0"; 
                        } elseif ($selectedFilter === 'cancelled') {
                            $sql .= "AND status = 2"; 
                        }
                        
                        $selectedTime = isset($_GET['time']) ? $_GET['time'] : 'all';  
                        
                        if ($selectedTime !== 'all') {
                            $sql .= " AND order_date BETWEEN ...";  
                        }
                        
                        
                        $obj = new Database();  
                        $obj->sqlData($sql);
                        $results = $obj->getResult();
                        $counter = 1;
                        
                        if (!empty($results)) {
                            foreach ($results as $row) {
        $product_name = $row['product_name'];
        $image = $row['product_image'];
        $id = $row['id'];
        $order_id = $row['order_id'];
        
        //customer address
        $customer_address = $row['customer_address'];
        $city = $row['city'];
        $state = $row['state'];
        
        $country = $row['country'];
        $zip = $row['zip'];
        
        
        $order_date = $row['order_date'];
        $status = $row['status'];
        $customername=$row['customer_name'];
        //shiping address 
        $shiping_address=$row['shiping_address'];
        $shiping_city=$row['shiping_city'];
        $shiping_state=$row['shiping_state'];
        $shiping_country=$row['shiping_country'];
        $shiping_zip=$row['shiping_zip'];
        $category=$row['category'];
     
     
        $price=$row['price'];
        $quantity=$row['quantity'];
?>

<tr class="order-row" data-status="<?= $status ?>"  data-order-date="<?= $order_date ?>"> 
    <td><?= $counter ?></td>
    <td>
        <button type="button" class="btn btn-link btn-sm view-btn" data-toggle="modal"
                data-product-id="<?= $id ?>" data-product-name="<?= $product_name ?>"
                data-price="<?= $price ?>"
                data-customerName="<?= $customername?>"
                data-biilingAddress="<?= $customer_address ?> <?= $city ?> <?= $state ?> <?= $country ?> <?= $zip ?>";
                data-status="<?= $status ?>"
                data-shipingAddress="<?= $shiping_address ?> <?= $shiping_city ?> <?= $shiping_state ?> <?= $shiping_country ?> <?= $shiping_zip ?>";
                
                data-image="images/<?= $image ?>"
                data-order="<?= $order_id ?>"
                data-customer-order="<?= $order_date ?>"
                data-quantity="<?= $quantity?>"

                data-category="<?= $category ?>"
                data-target="#modelId">
                <?= $order_id ?> 
        </button>
    </td>

    <td><?= $product_name ?>  </td>
    <td><?= $customer_address ?> <?= $city ?> <?= $state ?> 
    <?= $country ?> <?= $zip ?> </td> 
    <td><?= $order_date ?></td>
    <td><?= $price ?> </td>
    <td>
    <form method="POST" action="order.php"> 
        <input type="hidden" name="id" value="<?= $id ?>">
                <select  name="status"  id="statusSelect" class="custom-select" onchange="this.form.submit()">
            <option value="0" <?= $status == 0 ? 'selected' : '' ?>>Pending</option>
            <option value="1" <?= $status == 1 ? 'selected' : '' ?>>Completed</option>
            <option value="2" <?= $status == 2 ? 'selected' : '' ?>>Cancelled</option>
        </select>
    </form>
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

                                    <!-- Modal -->
                                    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                    <div class="modal-header">
                                                            <h5 class="modal-title">Order Details</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                        </div>
                                                        <div class="modal-body">
                                                        <div class="modelbox d-flex ">
   
   <img  id="image"  class=" mb-5  bg-body rounded w-25" alt="Product Image" src="" />
   
   <div class="text p-3 w-75 ">
   <h5 class="tablesize fw-bold" id="productname"></h5>
      
   <h6 class="fw-bold tables tablesize" id="category">Category: <span class=" fw-normal" id=""></span></h6>
 
   <div class="d-flex justify-content-between ">    
   <h6 class=" fw-bold tablesize" >Price: <span class=" fw-normal" id="productprice">$</span></h6>
   <h6 class=" fw-bold tablesize float-end" >Order Date: <span class=" fw-normal" id="customerorderdate"></span></h6> 
    </div>

<div class="d-flex justify-content-between ">    
   <h6 class=" fw-bold tablesize" >Quantity: <span class=" fw-normal" id="customerquantity"></span></h6>
   <h6 class=" fw-bold tablesize float-end" >Order Id: <span class=" fw-normal" id="uid">XYZ123456</span></h6> 
    </div>
       <p class="invisible">Category ID: <span id="category-id-placeholder"></span></p>
     </div>
</div>

            <div class="text p-3 w-100 marginordertop ">
            <h6 class="fw-bold tables tablesize">Name: <span class=" fw-normal" id="customername"></span></h6>

            <h6 class="tablesize fw-bold ">Billing Address: <spanc class="  fw-normal" id="customerbiilingaddress"> </span></h6>
                <h6 class="tablesize fw-bold ">Shipping Address: <spanc class=" fw-normal" id="shipingaddress"></span></h6>

   <div class="d-flex justify-content-between col-md-12">    
    <div class="d-flex marginleftorder">   
        <h6 class=" fw-bold tablesize w-75" >Order Staus: 
</h6>
<select  class="form-select tablesize " aria-label="Default select example">
 
<option id="status" selected="">Pending</option>

</select>
</div>
<div>

<button type="button" class="btn btn-primary d-flex m-auto buttonsize" data-dismiss="modal">Done</button>
</div>
</div>
</div>
  </div>          <div class="modal-footer">
                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
<script>
    

    function filterOrders(filter) {
    const rows = document.querySelectorAll('tr.order-row');

    rows.forEach(row => {
        const status = row.getAttribute('data-status');

        if (filter === 'all' || filter === status) {
            row.style.display = '';
        } else {
            row.style.display = 'none'; 
        }
    });
    window.location.href = '?filter=' + filter;
}




function filterByTime() {
    const selectedTimeFilter = document.getElementById('timeFilter').value;
    const rows = document.querySelectorAll('tr.order-row');
    
    rows.forEach(row => {
        const orderDate = row.getAttribute('data-order-date');


        if (selectedTimeFilter === 'all') {
            row.style.display = '';
        } else {
            const currentDate = new Date();
            const orderDateObj = new Date(orderDate);
            
            let showRow = false;
            if (selectedTimeFilter === 'monthly') {
                showRow = orderDateObj.getMonth() === currentDate.getMonth() && orderDateObj.getFullYear() === currentDate.getFullYear();
            } else if (selectedTimeFilter === 'yearly') {
                showRow = orderDateObj.getFullYear() === currentDate.getFullYear();
            } else if (selectedTimeFilter === 'weekly') {
            }
            
            if (showRow) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        }
    });
}

</script>

                <script src="./js/order.js"></script>

<?php include 'footer.php' ?>
