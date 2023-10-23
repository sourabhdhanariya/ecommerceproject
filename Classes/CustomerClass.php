<?php
/**
 * 
 */

class CustomerClass extends Database
{
    
    public function getCustomer()
    {
        $table = 'customer';
        $columns = '`customer_id`,`customer_name`, `customer_mobile`, `customer_email`, `customerbilling_address1`, `customerbilling_address2`, `customerbilling_city`, `customerbilling_state`, `customerbilling_country`, `customerbilling_zip`, `shipping_address1`, `shipping_address2`, `shipping_city`, `shipping_state`, `shipping_country`, `shipping_zip`, `status`, `customer_date`';
    
        $sql = "SELECT $columns FROM $table";
    
        return $sql;
    }
    public function updateCustomerStatus()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $categoryId = isset($_POST['id']) ? $_POST['id'] : 0;
            $newStatus = isset($_POST['active']) ? ($_POST['active'] == 'Active' ? 1 : 0) : 0;
        
            $updateParams = array('status' => $newStatus);
            $whereClause = "customer_id = $categoryId";
            $updateResult = $this->updateData('customer', $updateParams, $whereClause);
        
            if ($updateResult) {
                echo "Update successful!";
            } else {
                echo "Update failed. Error: " . implode(', ', $this->getResult());
            }
        }
        }

        public function customerById(int  $id)
     {
         $table = "customer";
         $columns = " `customer_name`, `customer_mobile`, `customer_email`, `customerbilling_address1`, `customerbilling_address2`, `customerbilling_city`, `customerbilling_state`, `customerbilling_country`, `customerbilling_zip`, `shipping_address1`, `shipping_address2`, `shipping_city`, `shipping_state`, `shipping_country`, `shipping_zip`, `status`, `customer_date`";
         $where = "customer_id = '$id'";
     
         return $this->selectData($table, $columns, null, $where);
     }
     public function updateCustomer($customername, $mobile_Name,$email, $billingAdd1, $billingAdd2,
     $billingCity,$billingState, $billingCountry,$billingZip,$shippingAdd1, $shippingAdd2, $shippingState,$shippingCity , $shippingCountry, $shippingZip)
{
    $id = $_POST["id"] ?? "";

    $updateParams = [
        'customer_name' => $customername,
        'customer_mobile' => $mobile_Name,
        'customer_email' => $email,
        'customerbilling_address1' => $billingAdd1,
        'customerbilling_address2' => $billingAdd2,
        'customerbilling_city' => $billingCity,
        'customerbilling_state' => $billingState,
        'customerbilling_country' => $billingCountry,
        'shipping_address1' => $shippingAdd1,
        'shipping_address2' => $shippingAdd2,
        'shipping_city' => $shippingCity,
        'shipping_state' => $shippingState,
        'shipping_country' => $shippingCountry,
        'shipping_zip' => $shippingZip
      ];

    $whereClause = "customer_id = $id";
    $updateResult = $this->updateData("customer", $updateParams, $whereClause);

    if ($updateResult) {
        return ["success" => true, "msg" => "Update Customer"];
    } else {
        return [
            "success" => false,
            "msg" => "Error Customer" . implode(", ", $this->getResult()),
        ];
    }
}
 
}
