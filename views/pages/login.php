<?php
    if($_SESSION["user"]){
        \App\Services\Router::redirect("/short_uri");
    }
    use App\Services\Page;
    Page::part("header");
?>
    <div class="container">
    <h2 class="mt-4">Авторизация</h2>
    <form class="mt-4" action="/auth/login" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="inputLogin" class="form-label">Имя пользователя</label>
            <input type="text" name="user_login" class="form-control" id="inputLogin" aria-describedby="userHelp">
            <div id="userHelp" class="form-text">user/123 или admin/123</div>
        </div>
        <div class="mb-3">
            <label for="inputPassword" class="form-label">Пароль</label>
            <input type="password" name="user_password" class="form-control" id="inputPassword">
        </div>
        <button type="submit" class="btn btn-primary">Отправить</button>
    </form>
    </div>

<?php
    Page::part("footer");
?>