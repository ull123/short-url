<?php
    namespace App\Controllers;
    use App\Services\DB;
    use App\Services\Router;
    
    class Auth
    {
        public function logout(){
            unset($_SESSION["user"]);
            unset($_SESSION["short_uri"]);
            Router::redirect("/login");
        }
        public function auth($data){
            $login = $data["user_login"];
            $password = $data["user_password"];
            
            $res = DB::getDB()->querySingle("SELECT id,
                                                         login,
                                                         password,
                                                         users_group
                                                    FROM users
                                                    WHERE login = '$login'",
                                            true);
            if(!$res){
                die("Пользователь не найден");
            }
            
            if(password_verify($password, $res["password"])){
                session_start();
                $_SESSION["user"]["login"] = $res["login"];
                $_SESSION["user"]["id"] = $res["id"];
                $_SESSION["user"]["users_group"] = $res["users_group"];
                Router::redirect('/short_uri');
            }else{
                die("Не верный логин или пароль");
            }
        }
        
        /*Валидации нет, будет время - допишу*/
        public function register($data){
           $login = $data["user_login"];
           $password = password_hash($data["user_password"], PASSWORD_DEFAULT);
           
           if($login != "" && $password != ""){
               $db = DB::getDB();
               $res = $db->query("INSERT INTO users (login, password)
                VALUES ('$login', '$password')");
               Router::redirect("/login");
           }else{
               Router::error("500");
               die();
           }
        }
    }