<?php

class Admin_EventController extends App_Controller_Action_Admin
{

    /**
     *
     * @var Application_Model_Event
     */
    protected $mEvent;
    protected $indexUrl;
    
    public function init() {
        parent::init();
        $this->mEvent = new Application_Model_Event();
        $this->indexUrl = $this->view->url(array('module'=>'admin','controller'=>'event','action'=>'index'),'default',true);
    }
    
    public function indexAction()
    {
        $this->view->events = $this->mEvent->listFullNames();
    }

    public function viewAction()
    {
        $mSource = new Application_Model_Source();
        $id = $this->_getParam('id');
        $this->view->row = $this->mEvent->getEventById($id);
        $form = new Admin_Form_Source();
        $form->setEid($id);
        if($this->_request->isPost()){
            $params = $this->_getAllParams();
            if($form->isValid($params)){
                $mSource->save($form->getValues());
                $url = $this->view->url(array('module'=>'admin','controller'=>'event','action'=>'view','id'=>$id),'default',true);
                $this->_redirect($url);
            }
        }
        if($this->_getParam('op')=='del-source'){
            $sourceId = (int) $this->_getParam('sid');
            $mSource->delete('id='.$sourceId);
            $url = $this->view->url(array('module'=>'admin','controller'=>'event','action'=>'view','id'=>$id),'default',true);
            $this->_redirect($url);
        }
        $this->view->sources = $mSource->getByEid($id);
        $this->view->eid = $id;
        $this->view->form = $form;
        
    }
    
    public function deleteAction(){
        $id = $this->_getParam('id');
        $this->mEvent->borrar($id);
        $this->_redirect($this->indexUrl);
    }

    public function newAction()
    {
        $form = new Admin_Form_Event();
        
        if($this->_request->isPost()){
            $params = $this->_getAllParams();
            if($form->isValid($params)){
                $values = $form->getValues();
                $this->mEvent->save($values);
                $this->_redirect($this->indexUrl);
            }
        }
        
        $this->view->form = $form;
    }



}

