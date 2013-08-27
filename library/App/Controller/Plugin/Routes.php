<?php


class App_Controller_Plugin_Routes extends Zend_Controller_Plugin_Abstract {
    
    public function routeStartup(Zend_Controller_Request_Abstract $request) {
        parent::routeStartup($request);
        
        $rutas = array(
            'home-sport' => new Zend_Controller_Router_Route_Regex(
                'watch-live-([a-z-]*)', 
                array(
                    'module' => 'default',
                    'controller' => 'index',
                    'action' => 'index'
                ), 
                array(
                    1 => 'sport'
                ), 
                'watch-live-%s'
            ),
        );
        
        Zend_Controller_Front::getInstance()->getRouter()->addRoutes($rutas);
                
        
    }
    
    
}
