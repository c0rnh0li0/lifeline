<?php
namespace Lifeline\Controller;

class LifelineHelper {
    public function __construct() {}
    
    public function csv_to_array($file_name) {
        $data = $header = array();
        $i = 0;
        
        $file = fopen($file_name, 'r');

        while (($line = fgetcsv($file)) !== FALSE) {
            if ($i == 0)
                $header = $line;
            else 
                $data[] = $line;        
            
            $i++;
        }

        fclose($file);

        foreach ($data as $key => $_value) {
            $new_item = array();
            
            foreach ($_value as $key => $value)
                $new_item[str_replace(' ', '', $header[$key])] =$value;
            
            $_data[] = (object) $new_item;
        }

        return $_data;
    }
}