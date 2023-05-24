<?php
    use App\Services\Page;
    use App\Controllers\Admin;
    if(!$_SESSION["user"]){
        \App\Services\Router::redirect("/login");
    }
   // var_dump($_SESSION['user']['table']['id']);
    Page::part("header");
?>
<div class="container">
    <h2 class="mt-4">Редактирование строки</h2>
    <form class="mt-4" action="/admin/save_changes" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="id" class="form-label">ID записи</label>
            <input value="<?=$_SESSION['user']['table']['id']?>" type="text" name="id" class="form-control" id="id" readonly>
        </div>
        <div class="mb-3">
            <label for="longURI" class="form-label">Полная ссылка</label>
            <input value="<?=$_SESSION['user']['table']['longURI']?>" type="text" name="longURI" class="form-control" id="longURI">
        </div>
        <div class="mb-3">
            <label for="shortURI" class="form-label">Сокращенная ссылка</label>
            <input value="<?=$_SESSION['user']['table']['shortURI']?>" type="text" name="shortURI" class="form-control" id="shortURI">
        </div>
        <div class="mb-3">
            <label for="user_id" class="form-label">Пользователи, которым приналежит ссылка(1 - админ, 2 - юзер, 3 - оба)</label>
            <input value="<?=$_SESSION['user']['table']['user_id']?>" type="text" name="user_id" class="form-control" id="user_id">
        </div>
        <div class="mb-3">
            <label for="click_counter" class="form-label">Количество переходов</label>
            <input value="<?=$_SESSION['user']['table']['click_counter']?>" type="text" name="click_counter" class="form-control" id="click_counter">
        </div>
        <button type="submit" class="btn btn-primary">Отправить</button>
    </form>
</div>
<?php
    Page::part("footer");
?>
