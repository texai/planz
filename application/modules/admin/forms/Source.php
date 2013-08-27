<?php

class Admin_Form_Source extends Zend_Form {
    
    public function init() {
        
        $e = new Zend_Form_Element_Textarea('code');
        $e->setLabel('Code');
        $e->setAttrib('rows', 3);
        $this->addElement($e);
        
        $e = new Zend_Form_Element_Hidden('eid');
        $this->addElement($e);
        
        $e = new Zend_Form_Element_Submit('go');
        $e->setLabel('Add Source');
        $e->setAttrib('class', 'btn btn-primary');
        $this->addElement($e);
        
    }
    
    public function setEid($value){
        $this->getElement('eid')->setValue($value);
        return $this;
    }
    
}
