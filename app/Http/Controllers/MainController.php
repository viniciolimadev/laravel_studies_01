<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class MainController extends Controller
{
    
    public function index(): void{
        echo '<p> Index <p>';
    }
    public function about(): void{
        echo '<p> About <p>';
    }
    public function contact(): void{
        echo '<p> Contact <p>';
    }
    
    
    
    
    public function initMethod(): string
    {
        return "Hello word!";
    }

    public function viewPage():View
    {
        return view('home');
    }

    public function teste($value): void
    {
        echo 'A string final é' . $this->CleanUpperCaseString($value);
    }
}
