<?php

use App\Http\Controllers\MainController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Rota simples GET que retorna HTML diretamente.
Route::get('/rota', function () {
    return '<h1>Olá Laravel!</h1>';
});

// Rota GET que retorna uma mensagem simples.
// Ideal para testes rápidos ou endpoints simples.
Route::get('/user', function () {
    return '<h1>Aqui está o usuário</h1>';
});

// Rota que injeta automaticamente a instância de Request do Laravel
// e faz o dump da requisição para debug.
Route::get('/injection', function (Request $request) {
    var_dump($request);
});

// Rota que aceita tanto GET quanto POST para o mesmo endpoint.
// Útil para formulários que podem ser acessados e submetidos na mesma URL.
Route::match(['get', 'post'], '/match', function (Request $request) {
    return '<h1> Aceita varios metodos</h1>';
});

// Rota que aceita qualquer tipo de método HTTP (GET, POST, PUT, DELETE, etc).
// Muito útil para testes ou endpoints genéricos.
Route::any('/any', function (Request $request) {
    return '<h1> Aceita qualquer http verb</h1>';
});

// Rota que chama o método 'index' do MainController quando acessado via GET.
// Normalmente usado para mostrar uma página inicial.
Route::get('/index', [MainController::class, 'index']);

// Rota que chama o método 'about' do MainController via GET.
// Geralmente usada para uma página "Sobre".
Route::get('/about', [MainController::class, 'about']);

// Redireciona permanentemente (status 302) da URL /saltar para /index.
Route::redirect('/saltar', '/index');

// Redirecionamento permanente (status 301) de /saltar2 para /index.
Route::permanentRedirect('/saltar2', '/index');

// Retorna diretamente uma view chamada 'home'.
// Não precisa de um controller para isso.
Route::view('/view', 'home');

// Retorna a mesma view 'home', mas passando dados para ela (myName = Vinicio Lima).
Route::view('/view2', 'home', ['myName'=>'Vinicio Lima']);


// ---------------------------------
// ROUTE PARAMETERS
// ---------------------------------

// Rota com um parâmetro obrigatório.
// Exemplo de URL: /valor/123 -> Envia "123" para o método mostrarValor do MainController.
Route::get('/valor/{value}', [MainController::class, 'mostrarValor']);

// Rota com dois parâmetros obrigatórios.
// Exemplo de URL: /valores/10/20 -> Envia "10" e "20" para mostrarValores.
Route::get('/valores/{value1}/{value2}', [MainController::class, 'mostrarValores']);

// Outra rota com dois parâmetros obrigatórios, possivelmente para outro tipo de lógica.
// Exemplo de URL: /valores2/a/b -> Envia "a" e "b" para mostrarValores2.
Route::get('/valores2/{value1}/{value2}', [MainController::class, 'mostrarValores2']);

// Rota com um parâmetro opcional (pode ou não ser enviado).
// Exemplo: /opcional ou /opcional/abc -> Envia "abc" (se fornecido) para mostrarValorOpcional.
Route::get('/opcional/{value?}', [MainController::class, 'mostrarValorOpcional']);

// Rota com um parâmetro obrigatório e um opcional.
// Exemplo: /opcional/123 ou /opcional/123/xyz -> Envia os dois valores para mostrarValorOpcional2.
Route::get('/opcional/{value}/{value2?}', [MainController::class, 'mostrarValorOpcional2']);

// Rota com múltiplos parâmetros dinâmicos aninhados, representando uma estrutura hierárquica.
// Exemplo: /user/1/post/5 -> Envia "1" como user_id e "5" como post_id para mostrarPosts.
Route::get('/user/{user_id}/post/{post_id}', [MainController::class, 'mostrarPosts']);

