<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(){
        echo 'index';
    }

    public function about(){
        echo 'about';
    }

     public function mostarValor($valor){
        echo "Valor enviado pela rota: $valor";
    }
    public function mostarValores($valor1 , $valor2){
        echo "Valores enviado pela rota: $valor1, $valor2 ";
    }
    public function mostarValores2(Request $request , $valor1 , $valor2){
        echo "Valores enviado pela rota: $valor1, $valor2 ";
    }
    public function mostrarValorOpcional($valor = null){
        echo "Valor opcional enviado pela rota: $valor";
    }
    public function mostrarValorOpcional2($valor1, $valor2 = null){
        echo "Valor opcional enviado pela rota: $valor1 , $valor2";
    }
    public function mostrarPosts($user_id, $post_id){
        echo "Posts do usuario ID: $user_id e o post com ID: $post_id";
    }
}
