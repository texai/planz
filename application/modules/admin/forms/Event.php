<?php

class Admin_Form_Event extends Zend_Form {
    
    public function init() {
        
        $this->setAttrib('id', 'frmEvent');
        
        $e = new Zend_Form_Element_Select('league');
        $e->setLabel('League');
        $e->addMultiOptions($this->_getLeaguesForCbo());
        $this->addElement($e);
        
//        $e = new Zend_Form_Element_Text('name');
//        $e->addValidator(new Zend_Validate_StringLength(array('min'=>2)));
//        $e->setRequired();
//        $e->setLabel('Name');
//        $this->addElement($e);
        $e = new Zend_Form_Element_Textarea('name');
        $e->setRequired();
        $e->setAttrib('rows', 6);
        $e->setLabel('Name');
        $this->addElement($e);
        
        $e = new Zend_Form_Element_Text('dt');
        $e->addValidator(new Zend_Validate_StringLength(array('min'=>2)));
        $e->setLabel('Date and Time');
        $e->setAttrib('data-format', 'dd/MM/yyyy HH:mm:ss PP');
        $e->setValue(date('d/m/Y H:00:00 A'));
        $e->setDescription('esta es la descripción');
        $e->setDisableLoadDefaultDecorators(true);
        $e->clearDecorators();
        $e  ->addDecorator('ViewHelper')
            ->addDecorator(new Admin_Form_Event_Dt_Decorator_TagSpan())
            ->addDecorator(new Admin_Form_Event_Dt_Decorator_TagDiv(array('id'=>'datetimepicker_dt')))
            ->addDecorator('Errors')
            ->addDecorator('HtmlTag', array(
                'tag' => 'dd',
                'id'  => array('callback' => array(get_class($e), 'resolveElementId'))
            ))
            ->addDecorator('Label', array('tag' => 'dt'));
        $v = new Zend_Validate_Regex('/^[0123][0-9]\/[01][0-9]\/201[0-9] [012][0-9]:[012345][0-9]:[012345][0-9] (A|P)M$/');
        $v->setMessage('Formato Incorrecto', Zend_Validate_Regex::NOT_MATCH);
        $e->addValidator($v);
        $this->addElement($e);
        
        $e = new Zend_Form_Element_Select('timezone');
        $e->addMultiOptions($this->_getTimeZonesFromCsv());
        $e->setValue(187); //32
        $e->setLabel('Time Zone');
        $this->addElement($e);
        
        $e = new Zend_Form_Element_Submit('go');
        $e->setLabel('Save');
        $e->setAttrib('class', 'btn btn-primary');
        $this->addElement($e);
        
    }
    
    private function _getTimeZonesFromCsv(){
        return Application_Model_Timezone::fetchAllForCbo();
    }
    
    private function _getLeaguesForCbo(){
        $sLeague = new Application_Model_ServiceEvent();
        return $sLeague->getLeaguesBySportsForCbo();
    }
    
}

class Admin_Form_Event_Dt_Decorator_TagDiv extends Zend_Form_Decorator_HtmlTag{
    public function __construct($options = null) {
        parent::__construct(array('tag' => 'div','class'=>'input-append','id'  => $options['id']));
    }
}

class Admin_Form_Event_Dt_Decorator_TagSpan extends Zend_Form_Decorator_Callback{
    public function __construct($options = null) {
        parent::__construct(array(
            'callback' => function(){
                return '
                    <span class="add-on">
                        <i class="icon-time" data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
                    </span>';
            },
            'placement' => 'APPEND'
        ));
    }
}