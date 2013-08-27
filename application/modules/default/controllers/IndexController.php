<?php

class Default_IndexController extends App_Controller_Action_Default
{

    public function indexAction()
    {
        $mSport = new Application_Model_Sport();
        $this->view->selectedSport = $this->_getParam('sport', 'home');
        
        $this->view->sports = $mSport->fetchAll();
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

