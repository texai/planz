<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of League
 *
 * @author texai
 */
class Application_Model_ServiceEvent {

    public function getLeaguesBySportsForCbo(){
        $mSport = new Application_Model_Sport();
        $mLeague = new Application_Model_League();
        $ret = $sports = array();
        foreach($mSport->fetchAll() as $i){
            $ret[$i->name] = array();
            $sports[$i->id] = $i->name;
        }
        foreach($mLeague->fetchAll() as $i){
            $ret[$sports[$i->id_sport]][$i->id] = $i->name;
        }
        return $ret;
    }
    
}