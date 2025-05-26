<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TesteMainController extends Controller
{
    // Método chamado pela rota '/index'
    // Exibe uma mensagem simples "index"
    public function index(){
        echo 'index';
    }

    // Método chamado pela rota '/about'
    // Exibe uma mensagem simples "about"
    public function about(){
        echo 'about';
    }

    // Método chamado pela rota '/valor/{valor}'
    // Recebe um parâmetro da URL e o exibe
    public function mostarValor($valor){
        echo "Valor enviado pela rota: $valor";
    }

    // Método chamado pela rota '/valores/{valor1}/{valor2}'
    // Recebe dois parâmetros da URL e os exibe
    public function mostarValores($valor1 , $valor2){
        echo "Valores enviados pela rota: $valor1, $valor2 ";
    }

    // Mesmo objetivo que o anterior, mas também injeta a instância Request
    // Permite acessar outros dados da requisição se necessário
    public function mostarValores2(Request $request , $valor1 , $valor2){
        echo "Valores enviados pela rota: $valor1, $valor2 ";
    }

    // Método chamado pela rota '/opcional/{valor?}'
    // O parâmetro é opcional e terá valor null se não for passado
    public function mostrarValorOpcional($valor = null){
        echo "Valor opcional enviado pela rota: $valor";
    }

    // Método chamado pela rota '/opcional/{valor1}/{valor2?}'
    // Primeiro valor é obrigatório, segundo é opcional
    public function mostrarValorOpcional2($valor1, $valor2 = null){
        echo "Valor opcional enviado pela rota: $valor1 , $valor2";
    }

    // Método chamado pela rota '/user/{user_id}/post/{post_id}'
    // Recebe dois parâmetros representando o ID do usuário e o ID do post
    public function mostrarPosts($user_id, $post_id){
        echo "Posts do usuário ID: $user_id e o post com ID: $post_id";
    }
}
