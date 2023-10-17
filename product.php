
<?php 
include 'header.php';
include 'sidebar.php'; 

$obj = new Database();
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $deleteResult = $obj->deleteData('products', "product_id = $id");
    if ($deleteResult) {
        echo "Delete successful!";
    } else {
        echo "Delete failed. Error: " . implode(', ', $obj->getResult());
    }
}
?>
<div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            <!-- Main-body start -->
                            <div class="main-body">
                                <div class="page-wrapper">
									<!-- Page-header start -->
                                    <div class="page-header card">
                                        <div class="card-block">
                                            <h5 class="m-b-10">Product Management</h5>
                                            <ul class="breadcrumb-title b-t-default p-t-10">
              <li class="breadcrumb-item">
                <a href="index.html"> <i class="fa fa-home"></i> </a>
              </li>
              <li class="breadcrumb-item"><a href="#!">Dashboard</a>
              </li>
              <li class="breadcrumb-item "><a href="#!">Product Management </a>
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
                                          
                                            <span>     
                                                
                                            <?php
$categoryIdFilter = '0';

if (isset($_GET['category_id'])) {
    $categoryIdFilter = $_GET['category_id'];
}
?>


<div class="col-md-3">
    <select id="categoryFilter" class="form-select tablesize">
        <option value="0" <?php echo ($categoryIdFilter === '0') ? 'selected' : ''; ?>>All Categories</option>
        <?php
        $obj->sqlData('SELECT category_id, category_name FROM categories;');
        
        $categories = $obj->getResult();

        if (!empty($categories)) {
            foreach ($categories as $cat) {
                $categoryId = $cat['category_id'];
                $categoryName = $cat['category_name'];

                $selected = ($categoryId == $categoryIdFilter) ? 'selected' : '';

                echo '<option value="' . $categoryId . '" ' . $selected . '>' . $categoryName . '</option>';
            }
        }
        ?>
    </select>
</div>



                                        </span>
                                          
                                            <span>     <a class="btn btn-primary btn-sm float-end " href="addproduct.php" role="button"> + Add </a>
                                       </span>
                                            <div class="card-header-right">
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $categoryId = isset($_POST['id']) ? $_POST['id'] : 0;
    $newStatus = isset($_POST['active']) ? ($_POST['active'] == 'Active' ? 1 : 0) : 0;

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

$sql = $obj->selectData(
    'products p',
    'p.product_id, p.product_title, p.product_quantity, p.product_price, p.status, c.category_id, c.category_name',
    'INNER JOIN categories c ON p.category_id = c.category_id',  // Corrected JOIN clause
    $categoryIdFilter !== '0' ? "p.category_id = $categoryIdFilter" : null  // Optional WHERE clause
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
        <button type="button" class="status-toggle btn btn-link tablesize togglelineremove <?= ($statusLabel === 'Active') ? 'active' : 'deactive' ?>" data-categoryid="<?= $id ?>" data-status="<?= $statusLabel ?>"><?= $statusLabel ?></button>
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

<script src="./js/product.js"></script>
<?php include 'footer.php' ?>
