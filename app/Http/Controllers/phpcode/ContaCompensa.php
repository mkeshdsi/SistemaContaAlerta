<?php

    require_once 'Conta.php';
    require_once 'Especial.php';

    class ContaCompensa extends Conta implements Especial{

    private $limite;
    private $saldo; //REPRESENTA O SALDO EXTERNO INICIADO QUANDO A CONTA FOR CRIADA
    private $maximo;

    public function setLimite($limite)
    {
        $this -> limite = $limite;
    }
    public function getLimite()
    {
        return $this -> limite;
    }

    public function setSaldo($saldo)
    {
        $this -> saldo = $saldo;        
    }
    public function getSaldo()
    {
        return $this -> saldo;
    }

    public function setMaximo($maximo)
    {
        $this -> maximo = $maximo;
    }
    public function getMaximo()
    {
        return $this -> maximo;
    }

    public function getNumeroParent(){
        return parent::getNumero();
    }

    public function getDesignacaoParent(){
        return parent::getDesignacao();
    }

    public function __construct($designacao,$numero,$limite, $saldo, $maximo)
    {
        parent::__construct($designacao,$numero);
        $this -> limite = $limite;
        $this -> saldo = $saldo;
        $this -> maximo = $saldo;
    }
    
    public function recarga($valor){
        $novoSaldo = (int)$valor + (int)$this ->getSaldo();
        $this->setSaldo($novoSaldo);
    }

    public function controlaLimiteSaldo($absoluto){
       $novoSaldo = (int)$this->getSaldo() - $absoluto;
       $this->setSaldo($novoSaldo);
    }
/*
    //CASOS SIMPLES, RECARREGAVEL NAO INCLUSO
    public function saldoNormal(){
        $maxlim = $this -> getMaximo() - $this -> getLimite(); //representa o limite do nosso lado
        if ($this -> getSaldoEod() >= $maxlim && $this -> getSaldo() <= $this -> getLimite()) {
            echo "A conta esta chegou ao limite";           
        }
    }
*/
    public function controladorLimite($ContaCompensa)
    {
        $saldoExterno   = $ContaCompensa -> getSaldo();
        if ($saldoExterno <= $this -> getLimite()) {
           echo "A conta esta no limite.";
        }
    }

    }
?>