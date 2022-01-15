<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Demo;

class DemoController extends Controller{
    
    public function index()
    {
        $datosDemo = Demo::all();

        return response()->json($datosDemo);
    }

}