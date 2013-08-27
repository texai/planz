<?php

class Application_Model_Timezone {

    static public function fetchAll(){
        $filename = APPLICATION_PATH.'/configs/timezones.csv';
        $filestring = file_get_contents($filename);
        $filearr = explode(PHP_EOL, $filestring);
        $timezones = array();
        foreach ($filearr as $value) {
            $fields = explode(',', $value);
            $code = str_replace('"', '', $fields[0]);
            $name = str_replace('"', '', $fields[2]);
            $utc_offset = str_replace('"', '', $fields[3]);
            $offset = $fields[5];
            $timezones[$code] = array(
                'name' => $name,
                'utc_offset' => $utc_offset,
                'offset' => $offset,
            );
        }
        return $timezones;
    }
    
    static public function fetchAllForCbo(){
        $data = self::fetchAll();
        $arr = array();
        foreach($data as $key => $value){
            $arr[$key] = $value['utc_offset'].' '.$value['name'];
        }
        asort($arr);
        return $arr;
    }
    
    static public function getOffsetById($id){
        $data = self::fetchAll();
        return $data[$id]['offset'];
    }
    
    
}