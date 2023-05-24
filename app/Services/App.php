<?php
    
    
    namespace App\Services;
    
    
    class App
    {
        public static function start(){
            self::libs();
        }
        
        public static function libs(){
            $config = require "controller/config/app.php";
            foreach ($config as $lib){
                require_once "controller/libs/".$lib.".php";
            }
        }
        
    }