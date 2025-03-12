<?php

namespace App\Http\Controllers;
use App\Models\Memo;

use Illuminate\Http\Request;

class MemoController extends Controller
{
    public function index()
    {
        $memos = Memo::latest()->take(1)->get();  // El último comunicado
        return view('comunicado', compact('memos'));
    }
}