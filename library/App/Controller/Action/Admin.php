<?php

class App_Controller_Action_Admin extends App_Controller_Action {

    public function init() {
        
        $public = array(
            'index/login'
        );
        $current = $this->_request->getControllerName().'/'.$this->_request->getActionName();
        
        if(!Zend_Auth::getInstance()->hasIdentity()){
            if(!in_array($current, $public)){
                $this->_redirect('login');
            }
        }
        
        if(Zend_Auth::getInstance()->hasIdentity()){
            $this->authData = $this->view->authData = Zend_Auth::getInstance()->getStorage()->read();
        }
        
        parent::init();
    }
    
}