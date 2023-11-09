<?php

/**
 * Class CustomerClass
 *
 * 
 * @author sourabh dhanariya <kuamwatsourabh65@gmail.com>
 */

class Variant extends Database
{
    /**
     * Sync Batch Close Recode on QBO
     * @param string categoryName
     */
    public function addVariant($variantName)
    {
        $variant_id = null;
        $attribute = array();
        $attributeNames = $_POST["attribute"];
        for ($i = 0; $i < count($attributeNames); $i++) {
            $uploadedFile = $attributeNames[$i];
            if ($i === 0) {
                $dataToInsert = [
                    "name" => $variantName,
                    "attribute" => $uploadedFile
                ];
                $variant_id = $this->insertMutipleData("product_variants", $dataToInsert);
            } else {
                if (isset($variant_id)) {
                    $mediaDataToInsert = [
                        'variate_id' => $variant_id,
                        'name' => $uploadedFile
                    ];
                    $mediaId = $this->insertMutipleData('product_attribute', $mediaDataToInsert);
                    $attribute[] = $mediaId;
                } else {
                    return ['success' => false, 'msg' => "Error: variant_id is not set"];
                }
            }
        }
    }

    public function updateVariant($variantName)
    {
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $attributeNames = isset($_POST["attribute"]) ? $_POST["attribute"] : [];
        if (empty($id)) {
            return ["success" => false, "msg" => "ID is missing."];
        }
        if (!is_array($attributeNames)) {
            return ["success" => false, "msg" => "Attribute names must be provided as an array."];
        }
        $deleteSql = "DELETE FROM product_attribute WHERE variate_id = '$id'";
        if (!$this->executeQuery($deleteSql)) {
            return ["success" => false, "msg" => "Failed to delete existing attributes."];
        }
        foreach ($attributeNames as $uploadedFile) {
            $insertParams = [
                'variate_id' => $id,
                'name' => $uploadedFile,
            ];
            if (!$this->insertData('product_attribute', $insertParams)) {
                return ["success" => false, "msg" => "Failed to insert new attributes."];
            }
        }
        $updateParams = [
            "name" => $variantName,
        ];
        $whereClause = "id = $id";

        if ($this->updateData('product_variants', $updateParams, $whereClause)) {
            return ["success" => true, "msg" => "Variant and attributes updated successfully."];
        } else {
            return ["success" => false, "msg" => "Failed to update variant name."];
        }
    }
    public function executeQuery($sql)
    {
        $result = $this->mysqli->query($sql);

        if ($result) {
            return $result;
        } else {
            return false;
        }
    }
    public function selectVariant()
    {
        $query = "SELECT c1.id, c1.name, c1.attribute,
        GROUP_CONCAT(c2.name) AS variatename,
        (SELECT GROUP_CONCAT(attribute) FROM product_variants WHERE id = c1.id) AS variateatti
 FROM product_variants c1
 INNER JOIN product_attribute c2 ON c1.id = c2.variate_id
 GROUP BY c1.id, c1.name, c1.attribute;";
        $result = $this->mysqli->query($query);
        if (!$result) {
            return ("Query failed: " . $this->mysqli->error);
        }

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function selectVariantById($id)
    {
        $query = "SELECT attribute, name FROM product_variants WHERE id  = '$id'";
        $result = $this->mysqli->query($query);

        if (!$result) {
            return ("Query failed: " . $this->mysqli->error);
        }
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function deleteVariant()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $deleteResult = $this->deleteData('product_variants', "id = $id");
            if ($deleteResult) {
                echo "Delete successful!";
            } else {
                echo "Delete failed. Error: " . implode(', ', $this->getResult());
            }
        }
    }
}
