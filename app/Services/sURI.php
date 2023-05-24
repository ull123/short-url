<?php
    
    
    namespace App\Services;
    use App\Controllers;
    use App\Services;
    class sURI
    {
        private static $db;
    
        public static function updateUser(int $userID, int $userNow, $id){
            if($userNow < 3)
            {
                $userNow += $userID;
            }else{
                $userNow -= $userID;
            }
            $sql = "UPDATE 'uri_tabl'
                    SET user_id = '$userNow'
                    WHERE id = '$id'";
            
            self::request($sql);
        }
        
        //создает короткую ссылку в базе данных
        public static function createShortURI($data){
            $longURI = addslashes($data["long_uri"]);
            $user_id = $_SESSION["user"]["id"];
            $shortURI = self::generate_short_string(6);//всегда уникальное
           
            $sqlString = "INSERT INTO uri_tabl (longURI, shortURI, user_id)
                VALUES ('$longURI', '$shortURI', '$user_id')";
    
            self::request($sqlString);
            return $shortURI;
        }

        //получает длинный URI по короткому и наоборот
        public static function getURI($parameter, $uri, $tablName = "uri_tabl"){
            $sqlString = "SELECT * FROM $tablName WHERE $parameter = '$uri'";
            return self::request($sqlString);
        }
        
        //считает сколько раз встречается строка с параметром
        public static function countParameter($parametr, $uri): int{
            $sql = "SELECT COUNT(*)
                    FROM uri_tabl
                    WHERE $parametr = '".addslashes($uri)."'";
            $res = self::request($sql);
            return $res["COUNT(*)"];
        }
        
        //производит запрос к базе данных
        public static function request($sqlString){
            if(self::$db === null){
                self::$db = DB::getDB();
            }
 
            $res = self::$db->query($sqlString);
            if($res){
                $arr=[];
                while ($tmp_arr =$res->fetchArray(SQLITE3_ASSOC)){
                    $arr = $tmp_arr;
                }
                //var_dump($arr);die();
                return $arr;
            }
            else {return false;}
        }
        //производит запрос к базе данных
        public static function requestNoArray($sqlString){
            if(self::$db === null){
                self::$db = DB::getDB();
            }
        
            return self::$db->query($sqlString);
        }
        
        //увеличивает счетчик посещений коротких uri
        public static function redirectURL($shortURL){
            $strRequest = "UPDATE 'uri_tabl'
                            SET click_counter = click_counter + 1
                            WHERE shortURI = '$shortURL'";
            $arr = sURI::getURI('shortURI',$shortURL);
 
            if(isset($arr["longURI"])){
                self::requestNoArray($strRequest);
                Router::redirect(stripcslashes($arr["longURI"]));
            }else{
                Router::error("404");
            }
        }
        
        //генерирует строку из случайных символов
        private static function generate_short_string(): string {
            $random_string = self::generator_str(6);
            while (($random_string !== "") && (self::countParameter("shortURI", $random_string) > 0)){
                $random_string = self::generator_str(6);
            }
            return $random_string;
        }
        private static function generator_str($strength = 6){
            $permitted_chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $input_length = strlen($permitted_chars);
            $random_string = '';
            for($i = 0; $i < $strength; $i++) {
                $random_string .= $permitted_chars[mt_rand(0, $input_length - 1)];
            }
            return $random_string;
        }
    }