<?php

use App\Http\Middleware\EndMidlleware;
use App\Http\Middleware\StartMidlleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // $middleware->prepend([
        //     //adiciona o middleware no começo de todas rotas.
        //     StartMidlleware::class
        // ]);
        //     //adiciona o midlleware no final de todas as rotas
        // $middleware->append([
        //     EndMidlleware::class
        // ]);
        $middleware->prependToGroup('correr_antes', [
            StartMidlleware::class
        ]);
        $middleware->appendToGroup('correr_depois', [
            EndMidlleware::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
