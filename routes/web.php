<?php

use App\Http\Controllers\MainController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/rota', function () {
    return '<h1>Olá Laravel!</h1>';
});

Route::get('/user', function () {
    return '<h1>Aqui está o usuário</h1>';
});

Route::get('/injection', function (Request $request) {
    var_dump($request);
});

Route::match(['get', 'post'], '/match', function (Request $request) {
    return '<h1> Aceita varios metodos</h1>';
});

Route::any('/any', function (Request $request) {
    return '<h1> Aceita qualquer http verb</h1>';
});

Route::get('/index', [MainController::class, 'index']);
Route::get('/about', [MainController::class, 'about']);

Route::redirect('/saltar', '/index');

Route::permanentRedirect('/saltar2', '/index');

Route::view('/view', 'home');
Route::view('/view2', 'home', ['myName'=>'Vinicio Lima']);
