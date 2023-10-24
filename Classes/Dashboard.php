<?php
/**
 * Class DashboardClass
 *
 * countOrdersWithStatus, selectCustomerCount
 * 
 * @author sourabh dhanariya <kuamwatsourabh65@gmail.com>
 */

class Dashboard extends Database
{
    /**
     * @param int $status
     */
    private function countOrdersWithStatus(int $status)
    {
        $table = "customer_order";
        $columns = "COUNT(*) as order_count";
        $where = "status = $status";
        $result = $this->selectData($table, $columns, null, $where);

        if (is_array($result) && !empty($result) && isset($result[0]['order_count'])) {
            return $result[0]['order_count'];
        } else {
            return 0;
        }
    }

    public function selectCustomerCount()
    {
        $table = "customer";
        $columns = "COUNT(*) as customer_count";
        $result = $this->selectData($table, $columns, null);

        if (is_array($result) && !empty($result) && isset($result[0]['customer_count'])) {
            return $result[0]['customer_count'];
        } else {
            return 0;
        }
    }

    public function countOrders()
    {
        return $this->countOrdersWithStatus(0);
    }

    public function countCompletedOrders()
    {
        return $this->countOrdersWithStatus(1);
    }

    public function countCancelledOrders()
    {
        return $this->countOrdersWithStatus(2);
    }

    public function countActiveOrders()
    {
        return $this->countOrdersWithStatus(0);
    }
}
