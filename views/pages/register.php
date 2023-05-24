<?php
    if($_SESSION["user"]){
        \App\Services\Router::redirect("/short_uri");
    }
    use App\Services\Page;
    Page::part("header");
?>
    
    <div class="container">
        <h2 class="mt-4">Регистрация</h2>
        <form class="mt-4" action="/auth/register" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="username" class="form-label">Имя пользователя</label>
                <input type="text" name="user_login" class="form-control" id="username">
            </div>
            <div class="mb-3">
                <label for="password_conf" class="form-label">Пароль</label>
                <input type="password" name="user_password" class="form-control" id="password_conf">
            </div>
            <button type="submit" class="btn btn-primary">Отправить</button>
        </form>
    </div>

<?php
    Page::part("footer");
?>