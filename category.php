<?php include 'header.php';
include 'sidebar.php';

include 'Classes/Categori.php';
?>
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page-header start -->
                <div class="page-header card">
                    <div class="card-block">
                        <h5 class="m-b-10">Category Management</h5>
                        <ul class="breadcrumb-title b-t-default p-t-10">
                            <li class="breadcrumb-item">
                                <a href="index.html"> <i class="fa fa-home"></i> </a>
                            </li>
                            <li class="breadcrumb-item"><a href="#!">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item "><a href="#!">Category Management </a>
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
                            <span> <a class="btn btn-primary btn-sm float-end" href="addcategory.php" role="button"> + Add </a>
                            </span>
                        </div>
                        <div class="card-block table-border-style">
                            <div class="table-responsive tablesize ">
                                <table id="example" class="table  data-table ">
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>

                                            <th>Category</th>
                                            <th>Parent Category</th>
                                            <th>Status</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                   <tbody>
                                        <?php
                                        $obj = new Categori();
                                        $obj->updateCategoryStatus();
                                        // Fetch and display the updated data
                                        $categories = $obj->getCategories();
                                        $counter = 1;
                                        if (!empty($categories)) {
                                            foreach ($categories as $row) {
                                                $name = $row["category_name"];
                                                $parent_id = $row["parent_category_name"];
                                                $id = $row["category_id"];
                                                $desciption = $row["category_description"];
                                                $image_path = $row ["category_image_path"];
                                                $status = $row["status"];
                                                $statusLabel = $status == 1 ? "Active" : "Inactive";
                                        ?>
                                                <tr>
                                                    <td><?= $counter ?></td>
                                                    <td class="capitalize"><?= $name ?></td>
                                                    <td><?= $parent_id ?></td>
                                                    <td>
                                                        <form method="post">
                                                            <input type="hidden" name="id" value="<?= $id ?>">
                                                            <input type="hidden" name="active" value="<?= $statusLabel ?>">
                                                            <button type="button" style="font-size:9px" class="status-toggle btn btn-link tablesize togglelineremove tooglesize <?= $statusLabel ===                                                                                                                                              "Active" ? "active-button" : "inactive-button" ?>" data-categoryid="<?= $id ?>" data-status="<?= $statusLabel ?>"><?= $statusLabel ?></button>
                                                        </form>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex ms-5 ml-1">
                                                            <button type="button" class="btn view-btn" data-bs-toggle="modal" data-bs-target="#exampleModal" data-category-id="<?= $id ?>" data-category-name="<?= $name ?>" data-category-description="<?= $desciption ?>" data-category-path="images/category/<?= $image_path ?>" data-category-parent="<?= $parent_id ?>">
                                                                <img src="images/view1.png " class="imageweightview" alt="view">

                                                            </button>

                                                            <a class="btn btn-sm" href="updatecategory.php?id=<?= $id ?>" role="button">
                                                                <img src="images/edit.png" class="imageweightview" alt="view">
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>

                                            <?php $counter++;
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
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-center" id="exampleModalLabel">Category</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="modelbox d-flex">
                                        <img id="category-image" class=" p-3 mb-5 bg-body rounded w-25" alt="Category Image" src="images/remove3.png" />
                                        <div class="text p-3 w-75 ">
                                            <h6 class="fw-bold tables tablesize">Category: <span class="float-end fw-normal" id="categoryname"></span></h6>
                                            <h6 class=" fw-bold tablesize">Parent Category: <span class="float-end fw-normal" id="category-parent"></span></h6>
                                            <h6 class="tablesize fw-bold ">Descrition : <spanc class="fw-normal" id="category-description"> </spanc>
                                            </h6>
                                            <p class="invisible">Category ID: <span id="category-id-placeholder"></span></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary d-flex m-auto buttonsize" data-bs-dismiss="modal">ok</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script src="./js/category.js"></script>
                    <?php include 'footer.php' ?>