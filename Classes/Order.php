<?php

/**
 * Class DashboardClass
 *
 * updateStatusOrder, selectorder
 * 
 * @author sourabh dhanariya <kuamwatsourabh65@gmail.com>
 */
class OrderClass extends Database
{
    public function updateStatusOrder()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = isset($_POST['id']) ? $_POST['id'] : 0;
            $newStatus = isset($_POST['status']) ? $_POST['status'] : 0;

            $allowedStatusValues = [0, 1, 2];
            if (!in_array($newStatus, $allowedStatusValues)) {
                echo "Invalid status value!";
                exit;
            }

            $updateParams = array('status' => $newStatus);
            $whereClause = "id  = $id";
            $updateResult = $this->updateData('customer_order', $updateParams, $whereClause);

            if ($updateResult) {
            } else {
                echo "Update failed. Error: " . implode(', ', $this->getResult());
            }
        }
    }
    public function selectorder()
    {
        $table = "customer_order";
        $columns = "`id`, `order_id`, `product_id`, `product_name`, `product_image`, `category`, `customer_name`, `customer_address`, `shiping_address`, `city`, `state`, `country`, `zip`, `order_date`, `shiping_city`, `shiping_state`, `shiping_country`, `shiping_zip`, `price`, `quantity`, `status`";
        $where = "id = 1";

        return $this->selectData($table, $columns, null, $where);
    }
}
