<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Короткие ссылки</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <h3><a class="navbar-brand" href="#">Short URL's</a></h3>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/short_uri">Home</a>
                </li>
                <?php
                    if($_SESSION["user"]["id"] === 1){
                ?>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/admin">Администратор</a>
                </li>
                <?php
                    }
                ?>
            </ul>
            <span class="navbar-text navbar-nav mb-2 mb-lg-0">
                <?php
                    if(!$_SESSION["user"]){
                ?>
                <ul class="navbar-nav list-group-horizontal">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/login">Авторизация</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/register">Регистрация</a>
                    </li>
                </ul>
                <?php
                }else{
                ?>
                        <form action="/auth/logout" method="post">
                            <button type="submit" class="nav-link active">Выйти</button>
                        </form>
                <?php
                }
                ?>
            </span>
        </div>
    </div>
</nav>