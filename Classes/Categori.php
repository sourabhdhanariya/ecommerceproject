<?php

/**
 * Class CustomerClass
 *
 * addCategory, updateCategory, selectCategory, categoryFilter, parentCategory, getCategories, updateCategoryStatus
 * 
 * @author sourabh dhanariya <kuamwatsourabh65@gmail.com>
 */
include './systemconfiguration.php';
class CategoriClass extends Database
{
    /**
     * Sync Batch Close Recode on QBO
     * @param string categoryName
     * @param string categoryDes
     * @param string parent_category_id
     * @param array categoryImage
     * @param const UPLOAD_DIR
     */

    public function addCategory(string $categoryName, string $categoryDes, string $parent_category_id = null, array $categoryImage)
    {

        $allowedExtensions = ["png", "jpg", "jpeg"];
        $maxFileSize = 3 * 1024 * 1024;

        $uploadedFileName = basename($categoryImage["name"]);

        $fileExtension = strtolower(pathinfo($uploadedFileName, PATHINFO_EXTENSION));

        if (!in_array($fileExtension, $allowedExtensions)) {
            return ["success" => false, "msg" => IMAGE_ERROR];
        }

        if ($categoryImage["size"] > $maxFileSize) {
            return ["success" => false, "msg" => IMAGE_SIZE];
        }

        if (move_uploaded_file($categoryImage["tmp_name"], CATEGORI_IMAGE . $uploadedFileName)) {
            $dataToInsert = [
                "category_name" => $categoryName,
                "category_description" => $categoryDes,
                "category_image_path" => $uploadedFileName,
                "parent_category_id" => $parent_category_id,
            ];

            try {
                $result = $this->insertData("categories", $dataToInsert);

                if ($result === true) {
                    return ["success" => true, "msg" => CATEGORY_SUCCESS];
                } else {
                    return ["success" => false, "msg" => CATEGORY_ERROR . implode(", ", $this->getResult())];
                }
            } catch (mysqli_sql_exception $e) {
                if ($e->getCode() === 1062) {
                    return ["success" => false, "msg" => CATEGORY_NAME];
                } else {
                    return ["success" => false, "msg" => CATEGORY_NAME_ERROR . $e->getMessage()];
                }
            }
        } else {
            return ["success" => false, "msg" => IMAGE_ERROR];
        }
    }

    /**
     * Sync Batch Close Recode on QBO
     * @param string categoryName
     * @param string categoryDes
     * @param string parent_category_id
     * @param array categoryImage
     */
    public function updateCategory(string $categoryName, string $categoryDescription, string $parentCategoryId, array $categoryImage, $obj)
    {
        $id = $_POST["id"] ?? "";
        $uploadedFileName = "";

        if (isset($_FILES["categoryImage"]) && $_FILES["categoryImage"]["error"] === UPLOAD_ERR_OK) {
            $fileExtension = pathinfo($_FILES["categoryImage"]["name"], PATHINFO_EXTENSION);

            $allowedExtensions = ["png", "jpg", "jpeg"];
            $maxFileSize = 3 * 1024 * 1024;

            if (in_array($fileExtension, $allowedExtensions) && $_FILES["categoryImage"]["size"] <= $maxFileSize) {
                $uploadedFileName = basename($_FILES["categoryImage"]["name"]);

                if (move_uploaded_file($_FILES["categoryImage"]["tmp_name"], CATEGORI_IMAGE . $uploadedFileName)) {
                    $uploadedFile = CATEGORI_IMAGE . $uploadedFileName;
                } else {
                    return ["success" => false, "msg" => IMAGE_ERROR_FAILED];
                }
            } else {
                return ["success" => false, "msg" => IMAGE_ERROR];
            }
        }

        $updateParams = [
            "category_name" => $categoryName,
            "category_description" => $categoryDescription,
            "parent_category_id" => $parentCategoryId,
        ];

        if (!empty($uploadedFileName)) {
            $updateParams["category_image_path"] = $uploadedFileName;
        }

        $whereClause = "category_id = $id";

        $updateResult = $obj->updateData("categories", $updateParams, $whereClause);

        if ($updateResult) {
            return ["success" => true, "msg" => CATEGORY_UPDATE];
        } else {
            return [
                "success" => false,
                "msg" => CATEGORY_UPDATE_ERROR . implode(", ", $this->getResult()),
            ];
        }
    }


    /**
     * Sync Batch Close Recode on QBO
     * @param int id 
     */

    public function selectCategory(int $id)
    {
        $table = "categories";
        $columns = "category_name, category_description, category_image_path,category_image_path, parent_category_id";
        $where = "category_id = '$id'";

        return $this->selectData($table, $columns, null, $where);
    }

    public function categoryFilter()
    {
        $table = "categories";
        $columns = "category_name, category_id";

        return $this->selectData($table, $columns, null);
    }

    /**
     * Sync Batch Close Recode on QBO
     * @param int parent_category_id 
     */


    public function parentCategory(int $parent_category_id)
    {
        $table = "categories";
        $columns = "category_name";
        $where = "category_id = '$parent_category_id'";

        return $this->selectData($table, $columns, null, $where);
    }

    public function getCategories()
    {
        $table = 'categories c1';
        $columns = 'c1.category_id, c1.category_name, c1.parent_category_id, c1.category_description, c1.category_image_path, c1.status, (SELECT c2.category_name FROM categories c2 WHERE c2.category_id = c1.parent_category_id) AS parent_category_name';

        return $this->selectData($table, $columns);
    }

    public function updateCategoryStatus()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $categoryId = isset($_POST["id"]) ? $_POST["id"] : 0;
            $newStatus = isset($_POST["active"]) ? ($_POST["active"] == "Active" ? 1 : 0) : 0;

            $updateParams = ["status" => $newStatus];
            $whereClause = "category_id = $categoryId";
            $updateResult = $this->updateData("categories", $updateParams, $whereClause);

            if ($updateResult == 1) {
            } else {
                echo CATEGORY_UPDATESTATUS_ERROR . implode(", ", $this->getResult());
            }
        }
    }
}
