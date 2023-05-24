<?php
    
    
    namespace App\Controllers;
    use App\Services\Router;
    use App\Services\sAdmin;
    use App\Services\sURI;
    
    class Admin
    {
        public static function delete(){
            if($_SESSION["user"]){
                sAdmin::delete_list($_POST);
                Router::redirect("/admin");
            }else{
                Router::error("500");
                die();
            }
        }
        public static function admin_menu(){
            if($_SESSION["user"]){
                sAdmin::geListURI($_POST);
                Router::redirect("/admin");
            }else{
                Router::error("500");
                die();
            }
        }
        
        public static function admin_redact(){
            if($_SESSION["user"]){
                sAdmin::openRedactLine($_POST);
                Router::redirect("/redact");
            }else{
                Router::error("500");
                die();
            }
        }
        
        public static function safe_changes(){
            if($_SESSION["user"]){
                sAdmin::redactLine($_POST);
                sAdmin::geListURI([
                    "sort" => "id",
                    "sort_way" => ASC,
                    "filter_users" => "3"
                ]);
                Router::redirect("/admin");
            }else{
                Router::error("500");
                die();
            }
        }
    }