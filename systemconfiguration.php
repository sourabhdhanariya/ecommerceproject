<?php
//database 
define("HOST", "localhost"); 
define("USER", "root"); 
define("PASSWORD", ""); 
define("DATABASE", "projectdexbytes"); 

//image path 
define("CATEGORI_IMAGE", "images/category/"); 
define("PRODUCT_IMAGE", "images/product/"); 


//login 
define("CATEGORI_QUERY", "Query execution failed."); 


//success massage for category
define("CATEGORY_SUCCESS", "Category added successfully");
define("CATEGORY_NAME", "Category name already exists.");
define("CATEGORY_UPDATE", "Category Update successfully.");

//error massage for category 
define("CATEGORY_ERROR", "Category added not successfully");
define("CATEGORY_NAME_ERROR", "Can not be found category");
define("IMAGE_ERROR", "Please jpg and png formate");
define("CATEGORY_UPDATE_ERROR", "Category Update failed.");
define("CATEGORY_UPDATESTATUS_ERROR", "Update failed status. Error.");
define("IMAGE_ERROR_FAILED", "Image failed ");
define("IMAGE_SIZE", "Image size should be less than 3 MB.");


// valdiation massage for category 
define("CATEGORY_NAME_VALID", "Category Name is required.");
define("CATEGORY_DESC_VALID", "Category Description is required.");
define("CATEGORY_IMAGE_VALID", "Image is required.");

        // product 

//success massage for Prouduct
define("PRODUCT_SUCCESS", "product added successfully");

define("PRODUCT_UPDATE", "Product Update successfully");
//error massage for category 
define("PRODUCT_ERROR", "Product added not successfully");
define("IMAGE_ERROR_PRODUCT", "Please jpg and png formate");
define("PRODUCT_UPDATE_ERROR", "PRODUCT Update failed.");

//customer
//success massage for customer 
define("CUSTOMER_UPDATE", "Customer Update successfully");
//error massage for customer  
define("CUSTOMER_ERROR", "Customer Update unsuccessfully");
define("CUSTOMER_STATUS_ERROR", "Customer Status Unsuccessfully");


?>
