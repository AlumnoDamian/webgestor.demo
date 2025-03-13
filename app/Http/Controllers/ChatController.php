<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatMensaje;

class ChatController extends Controller
{
    public function enviarAnuncio(Request $request)
    {
        ChatMensaje::create([
            'tipo' => 'Anuncio',
            'mensaje' => $request->mensaje,
            'user_id' => auth()->id(),
        ]);

        return back()->with('success', 'Anuncio enviado con éxito.');
    }

    public function enviarComunicado(Request $request)
    {
        ChatMensaje::create([
            'tipo' => $request->tipo,
            'mensaje' => $request->mensaje,
            'user_id' => auth()->id(),
        ]);

        return back()->with('success', 'Comunicado enviado con éxito.');
    }
}
