
public function updateProduct($product_title, $product_description, $product_price, $product_discount, $product_quantity, $category, $subcategory_id, $skuProduct, $productLaunchFormatted, $status)
    {
        $id = isset($_POST['id']) ? $_POST['id'] : '';
        $uploadedFiles = array();
        $validExtensions = array("jpg", "jpeg", "png", "mp4");

        if (isset($_FILES['imageFile']) && is_array($_FILES['imageFile']['name'])) {
            for ($i = 0; $i < count($_FILES['imageFile']['name']); $i++) {
                $uploadFile = PRODUCT_IMAGE . basename($_FILES['imageFile']['name'][$i]);
                $fileExtension = strtolower(pathinfo($_FILES['imageFile']['name'][$i], PATHINFO_EXTENSION));

                if ($_FILES['imageFile']['size'][$i] <= 3 * 1024 * 1024 && in_array($fileExtension, $validExtensions)) {
                    if (move_uploaded_file($_FILES['imageFile']['tmp_name'][$i], $uploadFile)) {
                        $uploadedFiles[] = $_FILES['imageFile']['name'][$i];
                    }
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
                    'image_path' => $uploadedFiles,
                    'image_name' => basename($_FILES['imageFile']['name'][$i]),
                );

                $mediaWhereClause = "product_id = $id";

                $this->insertMutipleData('media_master', $mediaUpdateParams, $mediaWhereClause);
            }
            // $updatedProduct = $this->sqlData("SELECT * FROM products WHERE product_id = $id");
            return ["success" => true, "msg" => PRODUCT_UPDATE];
        } else {
            return ["success" => false, "msg" => PRODUCT_UPDATE_ERROR];
        }
    }