
<?php 
include 'header.php';
include 'sidebar.php'; 


// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}


$obj = new Database();
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $deleteResult = $obj->deleteProduct('products', "product_id = $id");
    if ($deleteResult) {
        echo "Delete successful!";
        // Redirect or show a message if needed
    } else {
        echo "Delete failed. Error: " . implode(', ', $obj->getResult());
    }
}

?>

<style>
    div.dataTables_wrapper div.dataTables_info {
    padding-top: 0.85em;
    display: none;
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
                                            <h5 class="m-b-10">Product Table</h5>
                                            <!-- <p class="text-muted m-b-10">lorem ipsum dolor sit amet, consectetur adipisicing elit</p> -->
                                            <ul class="breadcrumb-title b-t-default p-t-10">
                                                <li class="breadcrumb-item">
                                                    <a href="dashboard.php"> <i class="fa fa-home"></i> </a>
                                                </li>
                                               <li class="breadcrumb-item"><a href="#!">Dashboard</a>
                                                        </li>
                                                        <li class="breadcrumb-item"><a href="#!">Product table</a>
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
                                            <h5>Product</h5>
                                            <span>     
                                                
                                            <?php
// Define $categoryIdFilter and initialize it to '0'
$categoryIdFilter = '0';

// Check if a category filter is selected from the URL query parameters
if (isset($_GET['category_id'])) {
    $categoryIdFilter = $_GET['category_id'];
}
?>

<div class="col-md-3">
    <select id="categoryFilter" class="form-select">
        <option value="0" <?php echo ($categoryIdFilter === '0') ? 'selected' : ''; ?>>All Categories</option>
        <?php
        $obj->sql('SELECT category_id, category_name FROM categories;');
        $categories = $obj->getResult();

        if (!empty($categories)) {
            foreach ($categories as $cat) {
                $categoryId = $cat['category_id'];
                $categoryName = $cat['category_name'];

                // Check if the current category matches the selected category and set "selected" attribute accordingly
                $selected = ($categoryId == $categoryIdFilter) ? 'selected' : '';

                echo '<option value="' . $categoryId . '" ' . $selected . '>' . $categoryName . '</option>';
            }
        }
        ?>
    </select>
</div>



                                        </span>
                                          
                                            <span>     <a class="btn btn-primary btn-sm float-end me-5" href="addproduct.php" role="button"> + Add </a>
                                       </span>
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
                                <th>Product</th>
                                <th>Category</th>

                                <th>Quantity</th>
                                <th>Price/Unit</th>
                                
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php

$obj = new Database();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $categoryId = isset($_POST['id']) ? $_POST['id'] : 0;
    $newStatus = isset($_POST['active']) ? ($_POST['active'] == 'Active' ? 1 : 0) : 0;

    // Update the status using the update method
    $updateParams = array('status' => $newStatus);
    $whereClause = "product_id  = $categoryId";
    $updateResult = $obj->updateData('products', $updateParams, $whereClause);

    if ($updateResult) {
        // echo "Update successful!";
    } else {
        echo "Update failed. Error: " . implode(', ', $obj->getResult());
    }
}

// category filter
$categoryIdFilter = isset($_GET['category_id']) ? $_GET['category_id'] : '0';
$obj = new Database();  // Replace with the appropriate SQL class you are using

$sql = $obj->select(
    'products p',
    'p.product_id, p.product_title, p.product_quantity, p.product_price, p.status, c.category_id, c.category_name',
    'INNER JOIN categories c ON p.category_id = c.category_id',  // Corrected JOIN clause
    $categoryIdFilter !== '0' ? "p.category_id = $categoryIdFilter" : null  // Optional WHERE clause
);
if (is_string($sql)) {
    $obj->sql($sql);
    $results = $obj->getResult();
    $counter = 1;
} else {
    echo "Invalid SQL query: $sql";
}
// $categoryIdFilter = isset($_GET['category_id']) ? $_GET['category_id'] : '0';

// // $sql = 'SELECT p.product_id, p.product_title, p.product_quantity, p.product_price, p.status, c.category_id, c.category_name
// //         FROM products p
// //         LEFT JOIN categories c ON p.category_id = c.category_id';

// if ($categoryIdFilter !== '0') {
//     $sql .= " WHERE p.category_id = $categoryIdFilter";
// }

// $obj->sql($sql);
// $results = $obj->getResult();
// $counter = 1;

if (!empty($results)) {
    foreach ($results as $row) {
        $name = $row['product_title'];
        $product_quantity = $row['product_quantity'];
        $product_price = $row['product_price'];
     
        
        $id = $row['product_id'];
        $category_id = $row['category_id'];
        $category_name = $row['category_name'];
        
        $status = $row['status'];
        $statusLabel = ($status == 1) ? 'Active' : 'Deactive';
?>

<tr>
    
<td><?= $counter ?></td> 
<td><?= $name ?> </td>
    
    <td><?= $category_name ?></td>
    <td><?= $product_quantity ?></td>
    <td><?= $product_price ?></td>
    <td>
        <form method="post">
            <input type="hidden" name="id" value="<?= $id ?>">
            <input type="hidden" name="active" value="<?= $statusLabel ?>">
            <button type="button" class="status-toggle btn btn-link tablesize tooglelineremove" data-categoryid="<?= $id ?>" data-status="<?= $statusLabel ?>"><?= $statusLabel ?></button>
        </form>
    </td>
    <td>
        <div class="d-flex ">
        <a class="btn btn-sm" href="updateproduct.php?updateid=<?= $id ?>" role="button">
    <img src="images/edit.png"  class="imageweightview" alt="view">
</a>

<div class="form-check form-switch toogle">
    <form method="post">
        <input type="hidden" name="id" value="<?= $id ?>">
        <input type="hidden" name="active" value="<?= ($status == 1) ? 'Active' : 'Deactive' ?>">
        <input class="form-check-input status-toggle imageweightview" style="margin-top: -3px;" name="active_checkbox" type="checkbox" value="1" id="flexSwitchCheckDefault_<?= $id ?>" <?= ($status == 1) ? 'checked' : '' ?>>
    </form>
</div>
<a class="btn btn-sm delete-link" data-id="<?= $id ?>" href="product.php?id=<?= $id ?>" role="button">
    <img src="images/delete1.png" class="imageweightview" alt="view">
</a>


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

                                    <script>
// JavaScript to handle category filter
document.addEventListener("DOMContentLoaded", function() {
    const categoryFilter = document.getElementById("categoryFilter");

    categoryFilter.addEventListener("change", function() {
        const selectedCategoryId = categoryFilter.value;

        // Redirect to the same page with the selected category as a query parameter
        window.location.href = 'product.php?category_id=' + selectedCategoryId;
    });
});

</script>


<script src="./js/product.js"></script>
<?php include 'footer.php' ?>
