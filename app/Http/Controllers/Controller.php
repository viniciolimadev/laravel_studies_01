<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public  function CleanUpperCaseString($string): string
    {
        //remove os espaços do começo e do final de uma string
        //Deixa string maiuscula.
        return strtoupper(trim($string));
    }
}
