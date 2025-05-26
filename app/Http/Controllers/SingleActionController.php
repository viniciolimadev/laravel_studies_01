<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SingleActionController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request):void
    {
        echo "Sigle Action method";
        echo 'br';
        $this-> privateMethod();
    }
    private function privateMethod():string
    {
        return "private function";
    }

}
