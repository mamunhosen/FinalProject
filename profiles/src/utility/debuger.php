<?php
namespace app\utility;

class Debuger{

	static public function debug($data){
        
        echo "<pre>";
        print_r($data);
        echo "</pre>";

        die();

	}
}

?>