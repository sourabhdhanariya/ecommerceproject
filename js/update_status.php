<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $orderId = isset($_POST['id']) ? $_POST['id'] : 0;
    $newStatus = isset($_POST['status']) ? $_POST['status'] : 0;

    $allowedStatusValues = [0, 1, 2];
    if (!in_array($newStatus, $allowedStatusValues)) {
        echo 'Invalid status value!';
    } else {
        // Perform the database update here using your Database class
        // Replace the following line with your database update logic
        $updateResult = $obj->updateData('customer_order', ['status' => $newStatus], "id = $orderId");

        if ($updateResult) {
            echo 'success';
        } else {
            echo 'error';
        }
    }
}
?>
