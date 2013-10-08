<?php

class Application_Model_Source extends Zend_Db_Table_Abstract {

    protected $_name = 'source';
    
    public function save($values){
        $row = array(
            'id_event' => $values['eid'],
            'code' => $values['code'],
            'order' => $this->getNextOrderByEid($values['eid'])
        );
        $this->insert($row);
    }
    
    public function borrarPorEventoId($eid){
        $this->delete(array('id_event=?'=>$eid));
    }
    
    public function getByEid($eid){
        return $this->getAdapter()->fetchAll($this->select()->from('source', array('id','code','order'))->where('id_event=?', $eid)->order('order ASC'));
    }
    
    private function getNextOrderByEid($eid){
        $sql = $this->getAdapter()->select()->from('source', array(new Zend_Db_Expr('max(`order`)')))->where('id_event=?', $eid);
        $max = $this->getAdapter()->fetchOne($sql);
        if($max==''){
           $max=0; 
        }
        return ++$max;
    }
    
    
}