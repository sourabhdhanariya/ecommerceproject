<?php

/**
 * Class ProductClass
 *
 * addProduct, updateCategory, selectProduct, getProductCategories, updateProductStatus
 *
 * @author sourabh dhanariya <kuamwatsourabh65@gmail.com>
 */
// include 'mediaClass.php';


class ProductClass extends Database
{
    /**
     * Sync Batch Close Recode on QBO
     * @param string productname
     * @param string productDes
     * @param string category_id
     * @param string sub_category_id
     * @param int prod_quantity
     * @param float prod_price
     * @param float product_discount
     * @param string prod_sku
     * @param string productLaunchFormatted
     * @param const UPLOAD_DIR
     */

     public function addProduct(string $productname, string $productDes, string $category_id, string $sub_category_id, int $prod_quantity, float $prod_price, float $product_discount, string $prod_sku, string $productLaunchFormatted, $status, $obj)
     {
         $mediaIds = array();
         $validExtensions = array("jpg", "jpeg", "png", "mp4"); 
         for ($i = 0; $i < count($_FILES["media-upload"]["name"]); $i++) {
             $uploadedFile = PRODUCT_IMAGE . basename($_FILES["media-upload"]["name"][$i]);
             $fileExtension = strtolower(pathinfo($_FILES["media-upload"]["name"][$i], PATHINFO_EXTENSION));
     
             if ($_FILES["media-upload"]["size"][$i] <= 3 * 1024 * 1024 && in_array($fileExtension, $validExtensions)) {
                 if (move_uploaded_file($_FILES["media-upload"]["tmp_name"][$i], $uploadedFile)) {
                     if ($i === 0) {
                         $dataToInsert = [
                             'product_title' => $productname,
                             'product_description' => $productDes,
                             'category_id' => $category_id,
                             'subcategory_id' => $sub_category_id,
                             'product_quantity' => $prod_quantity,
                             'product_price' => $prod_price,
                             'product_discount' => $product_discount,
                             'sku' => $prod_sku,
                             'launch_date' => $productLaunchFormatted,
                             'product_image' => basename($_FILES["media-upload"]["name"][$i]),
                             'status' => $status
                         ];
     
                         $product_id = $obj->insertMutipleData('products', $dataToInsert);
     
                         if ($product_id !== false) {
                         } else {
                         }
                     } else {
                         if (isset($product_id)) {
                             $mediaDataToInsert = [
                                 'product_id' => $product_id,
                                 'product_image' => $uploadedFile,
                                 'image_path' => $uploadedFile,
                                 'image_name' => basename($_FILES["media-upload"]["name"][$i]),
                                 'status' => 'active'
                             ];
     
                             $mediaId = $obj->insertMutipleData('media_master', $mediaDataToInsert);
                             $mediaIds[] = $mediaId;
                         } else {
                             return ['success' => false, 'msg' => 'Product id Error'];
                         }
                     }
                 } else {
                     return ['success' => false, 'msg' => "Image/Video is not uploaded"];
                 }
             } else {
                 return ['success' => false, 'msg' => "Ony, mp4, png and jpg"];
             }
         }
         return ['success' => true, 'msg' => 'Product inserted successfully.'];
     }
     
     
    /**
     * Sync Batch Close Recode on QBO
     * @param string product_title
     * @param string product_description
     * @param float product_price
     * @param float product_discount
     * @param int product_quantity
     * @param string category
     * @param string subcategory_id
     * @param int status
     * @param string productLaunchFormatted
     * @param const UPLOAD_DIR
     */


    public function updateProduct( string $product_title, string  $product_description, float $product_price, float $product_discount, int  $product_quantity,string $category, string $subcategory_id, string $skuProduct, string $productLaunchFormatted, int $status)
    {
        $id = isset($_POST['id']) ? $_POST['id'] : '';
        $uploadedFiles = array(); 

        if (isset($_FILES['imageFile']) && is_array($_FILES['imageFile']['name'])) {
          

            for ($i = 0; $i < count($_FILES['imageFile']['name']); $i++) {
                $uploadFile = PRODUCT_IMAGE . basename($_FILES['imageFile']['name'][$i]);

                if (move_uploaded_file($_FILES['imageFile']['tmp_name'][$i], $uploadFile)) {
                    $uploadedFiles[] = $_FILES['imageFile']['name'][$i];
                }
            }
        }

        $updateParams = array(
            'product_title' => $product_title,
            'product_description' => $product_description,
            'product_price' => $product_price,
            'product_discount' => $product_discount,
            'product_quantity' => $product_quantity,
            'category_id' => $category,
            'subcategory_id' => $subcategory_id,
            'sku' => $skuProduct,
            'launch_date' => $productLaunchFormatted,
            'status' => $status,
        );

        if (!empty($uploadedFiles)) {
            $updateParams['product_image'] = $uploadedFiles[0];
        }

        $whereClause = "product_id = $id";
        $updateResult = $this->updateData('products', $updateParams, $whereClause);
        $this->deleteData('media_master', "product_id = $id");

        if ($updateResult) {
            for ($i = 1; $i < count($uploadedFiles); $i++) {
                $mediaUpdateParams = array(
                    'product_id' => $id,  
                    'image_path' => PRODUCT_IMAGE . $uploadedFiles[$i],
                    'image_name' => basename($_FILES['imageFile']['name'][$i]),
              
                );
                $mediaWhereClause = "product_id = $id";

                $this->insertMutipleData('media_master', $mediaUpdateParams, $mediaWhereClause);
            }
            $updatedProduct = $this->sqlData("SELECT * FROM products WHERE product_id = $id");
            return ["success" => true, "msg" => PRODUCT_UPDATE];
       
        } else {
            return ["success" => false, "msg" => PRODUCT_UPDATE_ERROR];
        }
     }
    
    /**
     * @param int  $id
     */
    public function selectProduct(int $id)
    {
        $table = "products";
        $columns = "`product_id`, `product_title`, `product_description`, `category_id`, `subcategory_id`, `product_image`, `product_price`, `product_discount`, `product_quantity`, `sku`, `launch_date`, `status`";
        $where = "product_id = '$id'";

        return $this->selectData($table, $columns, null, $where);
    }


    public function getProductCategories()
    {
        $table = 'categories c1';
        $columns = 'c1.category_id, c1.category_name, c1.parent_category_id, c1.category_description, c1.category_image_path, c1.status, c2.category_name AS parent_category_name';
        $join = 'INNER JOIN categories c2 ON c1.parent_category_id = c2.category_id';

        return $this->selectData($table, $columns, $join);
    }

    /**
     * Sync Batch Close Recode on QBO
     * @param int categoryIdFilter

     */
    public function getProductCategoriesFilter(string $categoryIdFilter)
    {
        $table = 'products p';
        $columns = 'p.product_id, p.product_title, p.product_quantity, p.product_price, p.status, c.category_id, c.category_name';
        $join = 'INNER JOIN categories c ON p.category_id = c.category_id';
        $where = $categoryIdFilter !== '0' ? "p.category_id = $categoryIdFilter" : null;

        return $this->selectData($table, $columns, $join, $where);
    }



    public function updateProductStatus()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $categoryId = isset($_POST['id']) ? $_POST['id'] : 0;
            $newStatus = isset($_POST['active']) ? ($_POST['active'] == 'Active' ? 1 : 0) : 0;

            $updateParams = array('status' => $newStatus);
            $whereClause = "product_id  = $categoryId";
            $updateResult = $this->updateData('products', $updateParams, $whereClause);

            if ($updateResult) {
         
            } else {
                echo "Update failed. Error: " . implode(', ', $this->getResult());
            }
        }
    }
    public function deleteProduct()
    {

        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $deleteResult = $this->deleteData('products', "product_id = $id");
            if ($deleteResult) {
                echo "Delete successful!";
            } else {
                echo "Delete failed. Error: " . implode(', ', $this->getResult());
            }
        }
    }
}
