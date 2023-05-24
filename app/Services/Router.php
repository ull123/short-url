<?php
    
 namespace App\Services;
 use App\Controllers;
 
    class Router
    {
        private  static  $list = [];
        //open page
        public static function page($uri, $page){
            self::$list[] = [
                "uri" => $uri,
                "page" => $page
            ];
        }
        public static function post($uri, $class, $method){
            self::$list[] = [
                "uri" => $uri,
                "class" => $class,
                "method" => $method,
                "post" => true
            ];
        }
        
        public static function uri($uri, $class, $method){
            self::$list[] = [
                "uri" => $uri,
                "class" => $class,
                "method" => $method,
                "post" => true
            ];
        }
    
        public static function admin($uri, $class, $method){
            self::$list[] = [
                "uri" => $uri,
                "page" => "admin",
                "class" => $class,
                "method" => $method,
                "admin_api" => true,
                "post" => true
            ];
        }
        public static function admin_redact($uri, $class, $method){
            self::$list[] = [
                "uri" => $uri,
                "page" => "redact",
                "class" => $class,
                "method" => $method,
                "admin_api" => true,
                "post" => true
            ];
        }
        public static function delete($uri, $class, $method){
            self::$list[] = [
                "uri" => $uri,
                "page" => "admin",
                "class" => $class,
                "method" => $method,
                "admin_api" => true,
                "post" => true
            ];
        }
        
        public  static  function enable(){
            $query = $_GET['q'];
            if(!isset($_POST["del"]) && (isset($_POST["redact"])))
            {
                $query = "admin/redact";
            }
            foreach (self::$list as $route) {
                if ($route["uri"] === '/' . $query) {
                    if($route["post"]===true && $_SERVER["REQUEST_METHOD"] === "POST"){
                        $action = new $route["class"];
                        $method = $route["method"];
                        $action->$method($_POST);
                        die();
                    }else{
                        /*if($route['page'] === "admin"){
                            sAdmin::getStartTabl();
                        }*/
                        require_once "views/pages/" . $route['page'] . ".php";
                        die();
                    }
                }
            }
           
            sURI::redirectURL($query);
            die();
        }
        
        public static function error($error){
            require_once "views/errors/" . $error . ".php";
        }
    
        public static function redirect($url){
            header('Location: '.$url);
        }
    }