<?php
    use App\Services\Page;
    if(!$_SESSION["user"]){
        \App\Services\Router::redirect("/login");
    }
    Page::part("header");
?>

<div class="container">
    <h3 class="mt-4">Здравствуй <?= $_SESSION["user"]["login"]?>!
        <?=($_SESSION["user"]["users_group"] == "1") ? " Тебе доступно расширенное меню!":"";?></h3>
    
    <form class="mt-4" action="/short_uri/short" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="inputLongURL" class="form-label">Введите короткую или длинную ссылку</label>
            <input type="text" name="long_uri" class="form-control" id="inputLongURL" value="<?=stripcslashes($_SESSION["short_uri"]["longURI"])?>">
            <input class="form-control mt-4" type="text" value="<?=$_SESSION["short_uri"]["shortURI"];?>" disabled readonly>
        </div>
        <button type="submit" class="btn btn-primary">Отправить</button>
    </form>
</div>

<?php
    Page::part("footer");
?>
