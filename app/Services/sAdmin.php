<?php
    
    
    namespace App\Services;
    use App\Services\Router;
    use App\Services\sURI;
    use App\Services\sCurl;
    
    class sAdmin
    {
        public static function delete_list($data){
            
            $del_str = "";
            for ($i = 0, $iMax = count($data["del"]); $i < $iMax; $i++){
                $del_str .= "'" . $data["del"][$i] . "'";
                if($i < $iMax - 1)
                    $del_str .= ", ";
            }

            $sql = "DELETE
                    FROM uri_tabl
                    WHERE id IN ($del_str)";
            
            sURI::requestNoArray($sql);
            unset($_SESSION["user"]["uri_table"]);
            self::getStartTabl();
        }
        
        public static function getStartTabl(){
            self::geListURI([
                "sort" => "id",
                "sort_way" => "ASC",
                "filter_users" => "3"
            ]);
        }
        public static function geListURI($data){
            
            $sort = $data["sort"];
            $sort_way = $data["sort_way"];
            $table = "";
            $sql = "";
            if($data["filter_users"] === "3"){
                $sql="SELECT id, longURI, shortURI, user_id, click_counter FROM uri_tabl ORDER BY $sort $sort_way";
            }
            else{
                $id_user = $data["filter_users"];
                $sql = "SELECT id, longURI, shortURI, user_id, click_counter
                        FROM uri_tabl
                        WHERE user_id IN ('$id_user', '3')
                        ORDER BY $sort $sort_way";
            }
            
            $res = sURI::requestNoArray($sql);
  
            if($res)
            {
                while ($arr = $res->fetchArray(SQLITE3_ASSOC)){
                        $id = $arr["id"];
    
                        switch ($arr['user_id']) {
                            case "1":
                                $arr['user_id'] = "Администратор";
                                break;
                            case "2":
                                $arr['user_id'] = "Пользователь";
                                break;
                            case "3":
                                $arr['user_id'] = "Администратор, Пользователь";
                                break;
                        }
                        $table .= '<tr>';
    
                        foreach ($arr as $item) {
                            $table .= '<td>' . $item . '</td>';
                        }
    
                        $form = $form = "<td>
                                <form action='/admin/redact' method='post'>
                                <input name='redact_id' type='hidden' value= '" . $id . "' id = '" . $id . "'>
                                <input type='hidden' name='redact' class='form-control' value='/admin/redact'>
                                <button type='submit' class='btn btn-light'>Редактировать</button>
                                </form>
                             </td>";
                        $delChek = "<td><input type='checkbox' class='form-check-input' name='del[]' value='$id'></td>";
                        $table .= $form . $delChek . '</tr>';
                }
                $_SESSION["user"]["uri_table"]=$table;
            }else{
                Router::error("500");
                die();
            }
            
        }
        
        public static function openRedactLine($data){
            $sql="SELECT id, longURI, shortURI, user_id, click_counter FROM uri_tabl WHERE id = ".$data["redact_id"];
            $res = sURI::request($sql);
            if($res){
                $_SESSION["user"]["table"]=$res;
            }else{
                Router::error("500");
                die();
            }
        }
        
        public static function redactLine($data){

            $id = $data["id"];
            $longURI = $data["longURI"];
            $shortURI = $data["shortURI"];
            $user_id = $data["user_id"];
            $click_counter = $data["click_counter"];
            $sql="UPDATE uri_tabl
            SET   longURI = '$longURI', shortURI = '$shortURI',
                    user_id = '$user_id', click_counter = '$click_counter'
            WHERE id = '$id'";

            sURI::requestNoArray($sql);
        }
    }