<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    
    /**
     *
     * @var Zend_Config
     */
    protected $config;
    
    public function _initConfig() {
        $config = new Zend_Config($this->getOptions(), true);
//        $inifiles = array('app', 'cache', 'private', 'security');
//        foreach ($inifiles as $file) {
//            $inifile = APPLICATION_PATH . "/configs/$file.ini";
//            if (is_readable($inifile))
//                $config->merge(new Zend_Config_Ini($inifile));
//        }
        $this->setOptions($config->toArray());
        Zend_Registry::set('config', $config);
        $this->config = $config;
    }
    

    public function _initView(){
        $this->bootstrap('layout');
        $layout = $this->getResource('layout');
        $view = $layout->getView();
        $appTitle = $this->config->app->title;
        $view->addHelperPath('App/View/Helper','App_View_Helper');
        
        $view->headTitle($appTitle)->setSeparator(' | ');
        
        $view->headMeta('Sport Events','description');
        $view->headMeta($appTitle,'author');
        $view->headMeta('width=device-width, initial-scale=1.0','viewport');
        
        $view->headLink(array('href'=>$view->s('/css/bootstrap.css'),'rel'=>'stylesheet'));
        $view->headLink(array('href'=>$view->s('/css/default.css'),'rel'=>'stylesheet'));
        $view->headLink(array('href'=>$view->s('/css/bootstrap-responsive.css'),'rel'=>'stylesheet'));
        $view->headLink(array('href'=>$view->s('/css/bootstrap-datetimepicker.min.css'),'rel'=>'stylesheet'));
        
        $view->headScript()->appendFile($view->s('/js/html5shiv.js'),'javascript',array('conditional'=>'lt IE 9'));
        $view->headScript()->appendFile($view->s('/js/jquery-1.8.3.min.js'));
        $view->headScript()->appendFile($view->s('/js/bootstrap.min.js'));
        $view->headScript()->appendFile($view->s('/js/bootstrap-datetimepicker.min.js'));
        $view->headScript()->appendFile($view->s('/js/bootstrap-dropdown.js'));
        $view->headScript()->appendFile($view->s('/js/bootstrap-collapse.js'));
        $view->headScript()->appendFile($view->s('/js/global.js'));
        
    }
    
    public function _initPlugins(){

        Zend_Controller_Front::getInstance()->registerPlugin(
            new App_Controller_Plugin_Routes()
        );
        
    }
    

}

