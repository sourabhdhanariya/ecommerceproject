<?php
include 'header.php';
include 'sidebar.php';
include 'Classes/Categori.php';
include 'Classes/Product.php';
include 'Classes/Productvariate.php';
?>
<link rel="stylesheet" href="css/addprodyct.css">
<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://cdn.materialdesignicons.com/5.0.45/css/materialdesignicons.min.css">
<link rel="stylesheet" href="style1.css">

<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body  tablesize">
            <div class="page-wrapper">

                <!-- Page-body start -->
                <div class="page-body">
                    <!-- Basic table card start -->
                    <div class="card">
                        <div class="">
                            <form id="categoryForm" method="post" enctype="multipart/form-data" class="row g-3 p-5">

                        </div>
                        <div class="col-lg-5">
    <label for="category_id" class="form-label">Category</label>
    <input type="text" id="selectedCategoryId" name="category_id" value="" />
    <div class="form-select tablesize" id="categoryComboTree" placeholder="Category" autocomplete="off"></div>
</div>

<div class="col-12 mb-3">
    <button type="submit" name="submit" value="submit" class="btn btn-primary float-end buttonsize">Save</button>
</div>
</form>

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
                    if (values.length > 0) {
                        // Get the selected category ID
                        var selectedCategoryID = values[0];

                        // Update the input field value with the selected category ID
                        $('#selectedCategoryId').val(selectedCategoryID);
                    } else {
                        // Handle the case when no category is selected
                        $('#selectedCategoryId').val(''); // Clear the input field
                    }
                });
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });
</script>




                    <?php include 'footer.php' ?>
