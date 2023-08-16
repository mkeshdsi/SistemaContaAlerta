<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
//include_once './phpcode/Login.php';
use App\ClassesExternas\Login;
//include_once './../../ClassesExternas/Login.php';

class LogginController extends Controller
{
    
    function loginUser(Request $request)
    {
       // if(isset($_POST['nnovo'],$_POST['utilizador'], $_POST['senha'])){
            $usuario = $request->utilizador;
            $senha = $request->senha;
            $credencial = new Login($usuario,$senha);
            $conteudo = $credencial->buscarcredential($credencial);
            //print_r($conteudo);
            if ($conteudo) {
                /*$_SESSION['usuario'] = $usuario;
                $_SESSION['senha'] = $senha;
                $_SESSION["logged_in"] = true;*/
                return view("menu-principal");
                
            } else {
                /*unset($_SESSION['usuario']);
                unset($_SESSION['senha']);
                session_destroy();*/
                return view("index");
            }
     //   }
        

        
    }

    function novoUser(Request $request){
        //if(isset($request->senha_um, $request->senha_dois)){
            $usuario = $request->usuario;
            $senha = $request->senha_um;
            $credencial = new Login($usuario,$senha);
            $credencial->CreateCredentials($usuario,$senha);
            return view("index");
        //}
    }

    public function menuUser(){
        return view("menu-principal");
    }
}
