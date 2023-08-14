<?php

    class Conta{

        private $designacao;
        private $numero;

        public function setDesignacao($designacao){
            $this -> designacao = $designacao;
        }
        public function getDesignacao(){
            return $this -> designacao;
        }

        public function getNumero(){
            return $this -> numero;
        }



        public function __construct($designacao,$numero){
            $this -> designacao = $designacao;
            $this -> numero = $numero;
        }

        private function dezip($caminho){
            //const CAMINHO="/home/ewp_archiver/EWP_EOD/"
        }
        public function leituraConta(){

        }

    }
?>
