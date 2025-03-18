<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class DocumentacionController extends Controller
{
    public function index()
    {
        return view('documentacion.index');
    }
    
}
