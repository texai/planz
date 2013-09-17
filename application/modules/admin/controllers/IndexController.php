<?php

class Admin_IndexController extends App_Controller_Action_Admin
{

    public function indexAction()
    {
        $mSport = new Application_Model_Sport();
        $this->view->sports = $mSport->fetchAll();
    }

    public function loginAction()
    {
        $this->_helper->layout->setLayout('login');
        $this->view->headLink(array('href'=>$this->view->s('/css/login.css'),'rel'=>'stylesheet'));
        $form = new Admin_Form_Login();
        
        if($this->_request->isPost()){
            $params = $this->_getAllParams();
            if($form->isValid($params)){
                $auth = Zend_Auth::getInstance();
                $authAdapter = new Zend_Auth_Adapter_Digest(
                        APPLICATION_PATH.'/configs/digest.auth',
                        'admin',
                        $form->getValue('login'),
                        $form->getValue('pwd')
                );
                
                $result = $auth->authenticate($authAdapter);
                if($result->isValid()){
                    $auth->getStorage()->write(array('user'=>$authAdapter->getUsername()));
                    $this->_redirect('admin');
                }
            }
        }
        
        
        $this->view->form = $form;
    }
    
    public function logoutAction()
    {
        Zend_Auth::getInstance()->clearIdentity();
        return $this->_redirect('login');
    }


}

