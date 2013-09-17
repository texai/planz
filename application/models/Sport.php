<?php

class Application_Model_Sport extends Zend_Db_Table_Abstract {

    protected $_name = 'sport';
    
    
    public function fetchAllHomePage(){
        $sql = $this->select()->where('in_home=?', 1);
        return $this->fetchAll($sql);
    }
    
    
}