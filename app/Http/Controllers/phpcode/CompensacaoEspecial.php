<?php

require_once 'ContaCompensa.php';
require_once 'Tmcel.php';

class CompensacaoEspecial extends ContaCompensa implements Tmcel{

    private $diaria;
    //private $numeroConta;


    private function setDiaria($diaria){
        $this-> diaria = $diaria;
    }
    public function getDiaria(){
        return $this -> diaria;
    }

    public function getNumeroParent(){
        return parent::getNumero();
    }

    public function __construct($designacao,$numero,$limite,$saldo,$maximo,$diaria){
        parent::__construct($designacao,$numero,$limite,$saldo,$maximo);
        $this -> diaria  = $diaria;
    }


    public function controladorLimite($ContaCompensa){
        
    }

}

?>