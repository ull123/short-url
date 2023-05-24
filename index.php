<?php
    session_start();
    use App\Services\App;
    use App\Services\DB;
    require_once __DIR__."/vendor/autoload.php";
    App::start();
    DB::startDBConnection();
    require_once __DIR__."/controller/router/routes.php";

