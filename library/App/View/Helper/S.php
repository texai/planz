<?php

class App_View_Helper_S extends Zend_View_Helper_Abstract {
    public function s($s){
        $config = Zend_Registry::get('config');
        return $config->app->url->static.$s.'?v='.$config->app->version;
    }
}