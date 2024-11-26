<?php

class Kernel {
    protected $routeMiddleware = [
        'remember_me' => \App\Http\Middleware\RememberMeMiddleware::class,
        'admin' => \App\Http\Middleware\AdminMiddleware::class,
    ];
}
