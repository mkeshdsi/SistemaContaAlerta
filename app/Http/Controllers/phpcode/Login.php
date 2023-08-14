<?php

include_once 'Encipty.php';

    class Login  extends Cifras{

        private $usuario;
        private $senha;

        public function getUsuario(){
            $utilizador = $this->usuario->getTexto();
            return $utilizador;
        }
        
        public function setUsuario($utilizador){
            $usuarioPronto = new Cifras($utilizador);
            $this -> usuario = $usuarioPronto;
        }

        public function getSenha(){
            $password = $this->senha->getTexto();
            return $password;
        }

        public function setSenha($password){
            $senhaPronto = new Cifras($senha);
            $this -> senha = $senhaPronto;
        }

        public function __construct($usuario, $senha){
            $usuarioPronto = new Cifras($usuario);
            $this -> usuario = $usuarioPronto;
            $senhaPronto = new Cifras($senha);
            //$this -> senha = md5($senhaPronto->getTexto());
            $this -> senha = $senhaPronto;
        }

        public function CreateCredentials($usuario,$senha){
            $credencial = new Login($usuario,$senha);
            $usuarioDefinido = $credencial->getUsuario();
            $senhaDefinida = $credencial->getSenha();
            $conta="$usuarioDefinido;$senhaDefinida\n";
            $this->guardarCredencial($conta);
        }

        private function guardarCredencial($conta){
            $myfile = fopen("CredenciaisLogin.txt", "a") or die("Unable to open file!");
            fwrite($myfile, $conta);
        }

        public function buscarcredential($credencial){
            $encontrado = false;
            $usuario = $credencial->getUsuario();
            $senha = $credencial->getSenha();
            $file_to_read = fopen('CredenciaisLogin.txt', 'r');
            if($file_to_read !== FALSE){
                //echo "<table>\n";
                while(($data = fgetcsv($file_to_read, 100, ';')) !== FALSE){
                  //  echo "<tr>";
                    for($i = 0; $i < count($data); $i++) {
                    //    echo "<td>".$data[1]."</td>";
                        if ($data[0] == $usuario && $data[1] == $senha) {
                            $encontrado=true;
                            break;
                        }
                    }
                    //echo "</tr>\n";
                }
                //echo "</table>\n";
                fclose($file_to_read);
        }
        return $encontrado;
    }
}
?>