<?php

class Application_Model_Event extends Zend_Db_Table_Abstract {

    protected $_name = 'event';
    
    public function save($values){
        
        $eventNames = explode(PHP_EOL, trim($values['name']));
        
        foreach ($eventNames as $eventName) {
            if(strlen($eventName)>=2){
                $row = array(
                    'id_league' => $values['league'],
                    'name' => $eventName,
                    'dt' => $this->dateTimeAndTimeZone2dateTimeUTC($values['dt'],$values['timezone']),
                );
                $this->insert($row);
            }
        }
        
    }
    
    public function borrar($id){
        $mSource = new Application_Model_Source();
        $mSource->borrarPorEventoId($id);
        $this->delete(array('id=?'=>$id));
    }
    
    private function getSqlList($sport=null){
        
        $sql = $this->getAdapter()->select()
                ->from(array('e'=>'event'),array( 'ide'=>'id', 'event'=>'name','dt'))
                ->join(array('l'=>'league'), 'l.id=e.id_league',array('idl'=>'id','league'=>'name', 'show_icon'))
                ->join(array('s'=>'sport'), 's.id=l.id_sport',array('ids'=>'id','sport'=>'name'))
                //->joinLeft(array('so'=>'source'), 'so.id_event=e.id',array('n'=>new Zend_Db_Expr('COUNT(so.id)')))->group('so.id_event')
                //->where(new Zend_Db_Expr('dt + INTERVAL 3 HOUR >= now()'))
                ->order('e.dt ASC')
            ;
//        echo $sql->assemble();exit;
        if(!is_null($sport)){
            if($sport== 'others'){
                $sql->where('s.in_home=0');
            }else{
                $sql->where('s.slug=?',$sport);
            }
        }
        
        return $sql;
    }
    
    public function listFullNames($sport=null) {
        $sql = $this->getSqlList($sport);
        return $this->getAdapter()->fetchAll($sql);
    }
    
    public function getEventById($id){
        $sql = $this->getSqlList();
        $sql->where('e.id=?',$id);
        return $this->getAdapter()->fetchRow($sql);
    }
    
    private function dateTimeAndTimeZone2dateTimeUTC($dt, $timezone){
        $parts = explode(' ', $dt);
        $day_parts = explode('/', $parts[0]);
        $time_parts = explode(':', $parts[1]);
        $m = $parts[2];
        if($m == 'PM'){
            $time_parts[0]+=12;
        }
        $date = new Zend_Date();
        $date->setDay($day_parts[0]);
        $date->setMonth($day_parts[1]);
        $date->setYear($day_parts[2]);
        $date->setHour($time_parts[0]);
        $date->setMinute($time_parts[1]);
        $date->setSecond(0);
        
        $date->add( Application_Model_Timezone::getOffsetById($timezone) *(-1), Zend_Date::HOUR);
        return $date->get(Zend_Date::YEAR) . '-' .
               $date->get(Zend_Date::MONTH) . '-' .
               $date->get(Zend_Date::DAY) . ' ' .
               $date->get(Zend_Date::HOUR) . ':' .
               $date->get(Zend_Date::MINUTE) . ':' .
               $date->get(Zend_Date::SECOND);
                
    }
    
}