<?php
    use App\Services\Page;
    use App\Controllers\Admin;
    if(!$_SESSION["user"]){
        \App\Services\Router::redirect("/login");
    }
    Page::part("header");
   /* echo "<pre>";
    print_r($_SESSION["user"]["uri_table"]);
    echo "</pre>";*/
?>
<div class="container">
        <div class="mt-4">
            <form class="mt-4" action="/admin/menu" method="post" enctype="multipart/form-data">
                <div class="btn-group">
                    <select class="form-select" name="sort">
                        <option value="id">Сортировка по id</option>
                        <option value="shortURI">По коротким ссылкам</option>
                        <option value="longURI">По длинным ссылкам</option>
                        <option value="click_counter">По количеству переходов</option>
                        <option value="user_id">По пользователям</option>
                    </select>
                    <select class="form-select" name="sort_way">
                        <option value="ASC">От меньшего к большему</option>
                        <option value="DESC">От большего к меньшему</option>
                    </select>
                </div>

                <div class="btn-group">
                    <select class="form-select" name="filter_users">
                        <option value="3">Фильтр Все группы</option>
                        <option value="1">Администратор</option>
                        <option value="2">Пользователь</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-light">Отправить</button>
            </form>
        </div>
    <form action="/admin/delete" method="post" enctype="multipart/form-data">
        <table class="table table-striped m-3">
            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Полный адрес</th>
                <th scope="col">Сокращенный адрес</th>
                <th scope="col">Владелец</th>
                <th scope="col">Количество переходов</th>
                <th scope="col">Редактировать</th>
                <th scope="col"><button type="submit" class="btn btn-light"><b>Удалить</b></button></th>
            </tr>
            </thead>
            <tbody>
            <?=$_SESSION["user"]["uri_table"]?>
            </tbody>
        </table>
    </form>
</div>
<?php
    Page::part("footer");
?>
