<?php
    
    
    namespace App\Controllers;
    use App\Services\DB;
    use App\Services\Router;
    use App\Services\sURI;
    
    class URI
    {
        private static $domen = "http://short-url/";
        public static function create($data){
            if($_SESSION["user"]){
                $userID = $_SESSION["user"]["id"];
                unset($_SESSION["short_uri"]["shortURI"]);
                
                if(!strpos($data["long_uri"], "short-url") && ($data["long_uri"] !== "")){//длинная ссылка
                    self::long($userID, $data);
                }
                else
                {//короткая ссылка
                    if($data["long_uri"] !== ""){
                        self::short($data);
                    }
                }
                Router::redirect("/short_uri");
            }else{
                Router::error("500");
                die();
            }
        }
        
        private static function long($userID, $data){
            $countLongURI = sURI::countParameter("longURI", $data["long_uri"]);
            if($countLongURI === 0){
                $shortURI = sURI::createShortURI($data);
                $_SESSION["short_uri"]["shortURI"] = self::$domen.$shortURI;
            }else{
                $arr = sURI::getURI('longURI', $data["long_uri"]);
                $_SESSION["short_uri"]["shortURI"] = self::$domen.$arr["shortURI"];
                if(($userID !== $arr["user_id"])&&($arr["user_id"] < "3")){
                    sURI::updateUser((int)$userID, (int)$arr["user_id"], $arr["id"]);
                }
            }
            $_SESSION["short_uri"]["longURI"] = $data["long_uri"];
        }
        
        private static function short($data){
            $subStr = substr($data["long_uri"], strlen($data["long_uri"])-6);
            $arr = sURI::getURI('shortURI',$subStr);
            if(isset($arr['longURI'])){
                $_SESSION["short_uri"]["shortURI"] = $arr['longURI'];
            }else{
                $_SESSION["short_uri"]["shortURI"] = "Этого короткого адреса нет в базе данных";
            }
    
            $_SESSION["short_uri"]["longURI"] = $data["long_uri"];
        }
    }