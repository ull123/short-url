<?php
    
    
    namespace App\Services;
    
    
    use Exception;
 

    class  DB //extends \SQLite3
    {
        private static $db;
        private static $config;
        
    
        public function  __construct(){
        }
    
        public static function startDBConnection()
        {
            self::$config = require "controller/config/db.php";
            if (self::$db === null) {
                try{
                    self::$db = new \SQLite3(self::$config["db"].'.sqlite', SQLITE3_OPEN_READWRITE);
                }catch (Exception $e){
                    echo "Problems connected to BD <br>";
                    die('Error database: '.$e);
                }
            }
        }
        
        public static function getDB(): \SQLite3{
            return self::$db;
        }

    }