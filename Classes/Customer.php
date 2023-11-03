<?php

/**
 * updateCustomer, getCustomer, customerById,updateCustomerStatus 
 */

class Customer extends Database
{
    /**
     * @param string customername
     * @param string mobile_Name
     * @param string email
     * @param string billingAdd1
     * @param string billingAdd2
     * @param string  billingCity
     * @param string billingState
     * @param string billingCountry
     * @param int billingZip
     * @param string shippingAdd1
     * @param string shippingAdd2
     * @param string  shippingState
     * @param string billingState
     * @param string shippingCity
     * @param int shippingZip
     */
    public function updateCustomer(
        string    $customername,
        int       $mobile_Name,
        string    $email,
        string    $billingAdd1,
        string    $billingAdd2,
        string    $billingCity,
        string    $billingState,
        string    $billingCountry,
        int       $billingZip,
        string    $shippingAdd1,
        string    $shippingAdd2,
        string    $shippingState,
        string    $shippingCity,
        string    $shippingCountry,
        int    $shippingZip
    ) {
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
            'customerbilling_zip' => $billingZip,

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
            return ["success" => true, "msg" => CUSTOMER_UPDATE];
        } else {
            return [
                "success" => false,
                "msg" => CUSTOMER_ERROR . implode(", ", $this->getResult()),
            ];
        }
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
            } else {
                echo CUSTOMER_STATUS_ERROR . implode(', ', $this->getResult());
            }
        }
    }
    public function getCustomer()
    {
        $table = 'customer';
        $columns = '`customer_id`,`customer_name`, `customer_mobile`, `customer_email`, `customerbilling_address1`, `customerbilling_address2`, `customerbilling_city`, `customerbilling_state`, `customerbilling_country`, `customerbilling_zip`, `shipping_address1`, `shipping_address2`, `shipping_city`, `shipping_state`, `shipping_country`, `shipping_zip`, `status`, `customer_date`';

        $sql = "SELECT $columns FROM $table";

        return $sql;
    }
    /**
     * @param int $id 
     */


    public function customerById(int  $id)
    {
        $table = "customer";
        $columns = " `customer_name`, `customer_mobile`, `customer_email`, `customerbilling_address1`, `customerbilling_address2`, `customerbilling_city`, `customerbilling_state`, `customerbilling_country`, `customerbilling_zip`, `shipping_address1`, `shipping_address2`, `shipping_city`, `shipping_state`, `shipping_country`, `shipping_zip`, `status`, `customer_date`";
        $where = "customer_id = '$id'";

        return $this->selectData($table, $columns, null, $where);
    }
}
