<?php

class Admin_Form_Login extends Zend_Form {
    
    public function init() {
        
        $e = new Zend_Form_Element_Text('login');
        $e->setAttrib('class', 'input-block-level');
        $e->setAttrib('placeholder', 'login');
        $this->addElement($e);
        
        $e = new Zend_Form_Element_Password('pwd');
        $e->setAttrib('class', 'input-block-level');
        $e->setAttrib('placeholder', 'Password');
        $this->addElement($e);
        
        $e = new Zend_Form_Element_Submit('go');
        $e->setLabel('Sign In');
        $e->setAttrib('class', 'btn btn-large btn-primary');
        $this->addElement($e);
        
    }
    
}
