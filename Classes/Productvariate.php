<?php

class Productvariate extends Database
{
    public function productVariate() {
        $table = 'product_variants AS pv';
        $columns = 'pv.id,  pa.name AS attribute';
        $join = 'product_attribute AS pa ON pa.variate_id = pv.id';
        return $this->selectData1($table, $columns, $join);
    }
    public function productVariate1()
    {
        $table = 'product_variants ';
        $columns = '`id`, `name`, `attribute`';

        return $this->selectData($table, $columns);
    }
    
}
