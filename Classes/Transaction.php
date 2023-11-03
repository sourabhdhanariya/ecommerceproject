<?php

/**
 * Class DashboardClass
 *
 * updateStatusOrder, selectorder
 * 
 * @author sourabh dhanariya <kuamwatsourabh65@gmail.com>
 */
class Transaction extends Database
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
            $updateResult = $this->updateData('transaction', $updateParams, $whereClause);

            if ($updateResult) {
            } else {
                echo "Update failed. Error: " . implode(', ', $this->getResult());
            }
        }
    }
    public function selectorder()
    {
        $table = "transaction";
        $columns = "$table.id, $table.order_id, $table.transaction_id, $table.card_type, $table.date, $table.price, $table.status,
        t.order_id AS order_name";
    
        $where = "WHERE 1"; // If you want to select all records, you can use "WHERE 1" or simply omit the WHERE clause
        $join = "JOIN customer_order AS t ON $table.order_id = t.id"; // Use table aliases to specify the 'id' column
    
        return "SELECT $columns FROM $table $join $where";
    }
            
}
