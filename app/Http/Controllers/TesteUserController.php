<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TesteUserController extends Controller
{
    public function new(){
        echo 'new user';
    }
    public function edit(){
        echo 'edit user';
    }
    public function delete(){
        echo 'delete user';
    }
}
