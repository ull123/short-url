<?php
    
    
    namespace App\Services;
    
    
    class Page
    {
        public static function part(String $part_name){
            require_once "views/components/".$part_name.".php";
        }
    }