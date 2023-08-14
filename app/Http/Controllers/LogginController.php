<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//include_once './phpcode/Login.php';
use App\ClassesExternas;

class LogginController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function loginUser()
    {
        if(isset($_POST['nnovo'],$_POST['utilizador'], $_POST['senha'])){
            $usuario = $_POST['utilizador'];
            $senha = $_POST['senha'];
            $credencial = new Login($usuario,$senha);
            $conteudo = $credencial->buscarcredential($credencial);
            //print_r($conteudo);
            if ($conteudo) {
                $_SESSION['usuario'] = $usuario;
                $_SESSION['senha'] = $senha;
                $_SESSION["logged_in"] = true;
                return view("menu-principal");
                
            } else {
                unset($_SESSION['usuario']);
                unset($_SESSION['senha']);
                session_destroy();
                return view("index");
            }
        }
        
        if(isset($_POST['novo'],$_POST['usuario'], $_POST['senha_um'], $_POST['senha_dois'])){
            $usuario = $_POST['usuario'];
            $senha = $_POST['senha_um'];
            $credencial = new Login($usuario,$senha);
            $credencial->CreateCredentials($usuario,$senha);
            return view("index");
        }
        
    }

    public function menuUser(){
        return view("menu-principal");
    }
}
