<?php

class Default_IndexController extends App_Controller_Action_Default
{

    public function indexAction()
    {
        $mSport = new Application_Model_Sport();
        $mEvent = new Application_Model_Event();
        $this->view->selectedSport = $selectedSport = $this->_getParam('sport', 'football');
        $this->view->sports = $mSport->fetchAllHomePage();
        $events = $mEvent->listFullNames($selectedSport);
        $events = $this->offsetDates($events, 1);
        $this->view->eventsByDate = $this->groupByDate($events);
    }
    
    private function offsetDates($events, $offset){
        $ret = array();
        foreach($events as $k => $i){
            $timestamp = strtotime($i['dt']);
            $timestamp += ($offset * 60 * 60) ;
            $ret[$k] = $i;
            $ret[$k]['dt'] = date('Y-m-d H:i:s', $timestamp);
        };
        return $ret;
    }
    
    private function groupByDate($events){
        $eventsByDate = array();
        foreach($events as $item){
            $dt = $item['dt'];
            $dateArr = explode(' ', $dt);
            $date = $dateArr[0];
            if(!array_key_exists($date, $eventsByDate)){
                $eventsByDate[$date] = array();
            }
            $eventsByDate[$date][] = $item;
        }
        ksort($eventsByDate);
        return $eventsByDate;
    }
    
    public function getOptionsAction(){
        $mSource = new Application_Model_Source();
        $this->_helper->layout->disableLayout();
        $eid = $this->_getParam('ide');
        $this->view->sources = $mSource->getByEid($eid);
    }

    public function viewSourceAction(){
        $mSource = new Application_Model_Source();
        $sid = $this->_getParam('sid');
        if($sid=='0'){
            $this->view->source = '0';
        }else{
            $this->view->source = $mSource->fetchRow($mSource->select()->where('id=?', $sid))->toArray();
        }
    }

    public function contactUsAction()
    {
    }

    public function privacyPolicyAction()
    {
    }

    public function termsOfUseAction()
    {
    }


}

