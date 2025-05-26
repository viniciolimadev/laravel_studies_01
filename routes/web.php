<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ProductsCOntroller;
use App\Http\Controllers\SingleActionController;
use App\Http\Controllers\TesteMainController;
use App\Http\Controllers\TesteUserController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\OnlyAdmin;
use GuzzleHttp\Middleware;
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

// Rota que chama o método 'index' do TesteMainController quando acessado via GET.
// Normalmente usado para mostrar uma página inicial.
Route::get('/index', [TesteMainController::class, 'index']);

// Rota que chama o método 'about' do TesteMainController via GET.
// Geralmente usada para uma página "Sobre".
Route::get('/about', [TesteMainController::class, 'about']);

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
// Exemplo de URL: /valor/123 -> Envia "123" para o método mostrarValor do TesteMainController.
Route::get('/valor/{value}', [TesteMainController::class, 'mostrarValor']);

// Rota com dois parâmetros obrigatórios.
// Exemplo de URL: /valores/10/20 -> Envia "10" e "20" para mostrarValores.
Route::get('/valores/{value1}/{value2}', [TesteMainController::class, 'mostrarValores']);

// Outra rota com dois parâmetros obrigatórios, possivelmente para outro tipo de lógica.
// Exemplo de URL: /valores2/a/b -> Envia "a" e "b" para mostrarValores2.
Route::get('/valores2/{value1}/{value2}', [TesteMainController::class, 'mostrarValores2']);

// Rota com um parâmetro opcional (pode ou não ser enviado).
// Exemplo: /opcional ou /opcional/abc -> Envia "abc" (se fornecido) para mostrarValorOpcional.
Route::get('/opcional/{value?}', [TesteMainController::class, 'mostrarValorOpcional']);

// Rota com um parâmetro obrigatório e um opcional.
// Exemplo: /opcional/123 ou /opcional/123/xyz -> Envia os dois valores para mostrarValorOpcional2.
Route::get('/opcional/{value}/{value2?}', [TesteMainController::class, 'mostrarValorOpcional2']);

// Rota com múltiplos parâmetros dinâmicos aninhados, representando uma estrutura hierárquica.
// Exemplo: /user/1/post/5 -> Envia "1" como user_id e "5" como post_id para mostrarPosts.
Route::get('/user/{user_id}/post/{post_id}', [TesteMainController::class, 'mostrarPosts']);

// ---------------------------------
// ROUTE PARAMETERS WITH CONTRAINTS
// ---------------------------------

// Define uma rota que responde a requisições GET para URLs no formato 'exp1/algum-valor'.
Route::get('exp1/{value}', function($value){
    // Esta é a função (closure) que será executada quando a rota for acessada.
    // Ela recebe o parâmetro 'value' capturado da URL.
    echo $value; // Simplesmente exibe o valor capturado na tela.

// O método 'where' adiciona uma restrição ao parâmetro 'value'.
})->where('value','[0-9]+');
// '[0-9]+' é uma expressão regular que significa:
// [0-9] -> Permite apenas caracteres numéricos (de 0 a 9).
// +       -> Exige que haja pelo menos um caractere (ou mais).
// Conclusão: Esta rota só será acessada se o valor após 'exp1/' for composto apenas por números.



// Define uma rota GET para URLs no formato 'exp2/algum-valor'.
Route::get('exp2/{value}', function($value){
    // Exibe o valor capturado da URL.
    echo $value;

// Adiciona uma restrição ao parâmetro 'value'.
})->where('value','[A-Za-z0-9]+');
// '[A-Za-z0-9]+' é uma expressão regular que significa:
// [A-Z] -> Permite letras maiúsculas.
// [a-z] -> Permite letras minúsculas.
// [0-9] -> Permite números.
// +     -> Exige que haja pelo menos um caractere (ou mais).
// Conclusão: Esta rota só será acessada se o valor após 'exp2/' for alfanumérico.


// Define uma rota GET para URLs no formato 'exp2/valor1/valor2'.
Route::get('exp2/{value1}/{value2}', function($value){ // ATENÇÃO: A função espera $value, mas a rota define $value1 e $value2. Isso pode causar erro ou comportamento inesperado. O ideal seria: function($value1, $value2)
    // Exibe o valor (provavelmente só o primeiro, $value1, ou dará erro).
    echo $value;

// Adiciona restrições para múltiplos parâmetros usando um array.
})->where([
    // Restringe 'value1' para ser alfanumérico.
    'value1' => '[A-Za-z0-9]+',
    // Restringe 'value2' para ser alfanumérico.
    'value2' => '[A-Za-z0-9]+'
]);
// Conclusão: Esta rota só será acessada se ambos os valores após 'exp2/' forem alfanuméricos.
//              É importante corrigir a assinatura da função para usar $value1 e $value2 corretamente.

// ---------------------------------
// ROUTE NAMES
// ---------------------------------

Route::get('/rota_abc', function(){
    return 'Rota nomeada.';
})->name('rota_nomeada');

Route::get('/rota_referenciada', function(){
    return redirect()->route('rota_nomeada');
});

Route::prefix('admin')->group(function(){
    Route::get('/home',[TesteMainController::class, 'index']);
    Route::get('/about',[TesteMainController::class, 'about']);
    Route::get('/managment',[TesteMainController::class, 'mostrarValor']);
});

Route::get('/admin/only', function(){
    echo "Apenas administradores";
})->middleware(OnlyAdmin::class);

Route::middleware([OnlyAdmin::class])->group(function(){ // <--- Corrected to middleware (lowercase m)
    Route::get('admin/only1', function(){
        return "Apenas administradores";
    });
    Route::get('admin/only2', function(){
        return "Apenas administradores";
    });
    Route::get('admin/only3', function(){
        return "Apenas administradores";
    });
});

Route::controller(TesteUserController::class)->group(function(){
    Route::get('/user/new','new');
    Route::get('/user/edit','edit');
    Route::get('/user/delete','delete');
});

Route::fallback(function(){
    echo 'Pagina não encontrada.';
});


// __________________________________________________________

// CONTROLLERS

Route::get('/init', [TesteMainController::class], 'initMethod')->name('init');

Route::get('/View', [MainController::class], 'View')->name('View');

// single action

Route::get('/Sigle', SingleActionController::class)->name('single');

//resource

Route::resource('users', UserController::class);

Route::resources([
    'clients' => ClientsController::class,
    'products' => ProductsCOntroller::class
]);

// Subpastas
Route::get('admin',[AdminController::class],'index')->name('admin');

//Herança de controller

Route::get('teste/{value}',[MainController::class],'teste');