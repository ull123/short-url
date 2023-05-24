<?php
    use App\Services\Router;
    use App\Controllers;
    
    Router::page('/login', 'login');
    Router::page('/short_uri', 'short_uri');
    Router::page('/register', 'register');
    Router::page('/admin', 'admin');
    Router::page('/redact', 'redact');
    
    Router::post('/auth/register', Controllers\Auth::class, 'register');
    Router::post('/auth/login', Controllers\Auth::class, 'auth');
    Router::post('/auth/logout', Controllers\Auth::class, 'logout');
    
    Router::uri('/short_uri/short', Controllers\URI::class, 'create');
    
    Router::admin('/admin/menu', Controllers\Admin::class, 'admin_menu');
    Router::admin('/admin/redact', Controllers\Admin::class, 'admin_redact');
    Router::admin('/admin/save_changes', Controllers\Admin::class, 'safe_changes');
    Router::admin('/admin/delete', Controllers\Admin::class, 'delete');
    
    Router::enable();
