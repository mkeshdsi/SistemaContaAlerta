<?php
//session_start();
//include_once './phpcode/Login.php';


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
        header("Location: /menu-principal");
        
    } else {
        unset($_SESSION['usuario']);
        unset($_SESSION['senha']);
        session_destroy();
        header("Location: index.html");
    }
}

if(isset($_POST['novo'],$_POST['usuario'], $_POST['senha_um'], $_POST['senha_dois'])){
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha_um'];
    $credencial = new Login($usuario,$senha);
    $credencial->CreateCredentials($usuario,$senha);
    header("Location: index.html");
}


?>