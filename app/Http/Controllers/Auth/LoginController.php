<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Método para exibir a página de login
    public function showLoginForm()
    {
        return view('login');
    }

    // Método para processar a tentativa de login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Se o usuário estiver autenticado com sucesso, redirecione para a página desejada
            return redirect()->intended('/quartos-disponiveis');
        }

        // Se a autenticação falhar, redirecione de volta para a página de login com uma mensagem de erro
        return redirect()->route('login')->with('error', 'Credenciais inválidas. Tente novamente.');
    }
}
