<?php

class App_Controller_Action extends Zend_Controller_Action {
    
    /**
     *
     * @var Zend_Config
     */
    protected $config;
    
    public function init() {
        Zend_Layout::getMvcInstance()->setLayoutPath(APPLICATION_PATH.'/modules/'.$this->_getParam('module').'/layouts');
        $this->config = Zend_Registry::get('config');
        $this->view->appTitle = $this->config->app->title;
        $this->view->params = $this->_getAllParams();
        
        
    }

    
}