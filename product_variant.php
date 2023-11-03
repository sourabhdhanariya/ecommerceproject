<?php
include 'header.php';
include 'sidebar.php';
include 'Classes/Variant.php';

$obj = new Variant();
$obj->deleteVariant();;
?>
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page-header start -->
                <div class="page-header card">
                    <div class="card-block">
                        <h5 class="m-b-10">Product Variants</h5>
                        <ul class="breadcrumb-title b-t-default p-t-10">
                            <li class="breadcrumb-item">
                                <a href="index.html"> <i class="fa fa-home"></i> </a>
                            </li>
                            <li class="breadcrumb-item"><a href="#!">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item "><a href="#!">Product Variants </a>
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




                            </span>

                            <span> <a class="btn btn-primary btn-sm float-end " href="addvariant.php"  role="button"> + Add </a>
                            </span>
                            <div class="card-header-right">
                            </div>

                        </div>
                        <div class="card-block table-border-style">
                            <div class="table-responsive tablesize ">
                                <table id="example" class="table data-table ">
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
                                            <th>Variant Name</th>
                                            <th>Attributes</th>

                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php


                                        $obj = new Variant();

                                        $sqlResult = $obj->selectVariant($obj);



                                        if (is_string($sqlResult)) {
                                            echo "Invalid SQL query: $sqlResult";
                                        } else {
                                            $results = $sqlResult;
                                            $counter = 1;

                                            if (!empty($results)) {
                                                foreach ($results as $row) {
                                                    $name = $row['variatename'];
                                                    $id = $row['id'];
                                                    $attribute = $row['name'];
                                                    $name1=$row['variateatti'];
                                        
                                        ?>

                                                    <tr>

                                                        <td><?= $counter ?></td>
                                                        <td><?= $attribute ?> </td>

                                                        <td><?= $name1 ?>, <?= $name ?></td>
                                                        <td>
                                                            <div class="d-flex ">
                                                                <a class="btn btn-sm" href="updatevariant.php?id=<?= $id ?>" role="button">
                                                                    <img src="images/edit.png" class="imageweightview" alt="view">
                                                                </a>

                                                                <a class="btn btn-sm delete-link" data-id="<?= $id ?>" href="product_variant.php?id=<?= $id ?>" role="button">
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
                                        }

                                        ?>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>


                    <script src="./js/product_variant.js"></script>
                    <?php include 'footer.php' ?>