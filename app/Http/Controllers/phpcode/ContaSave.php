<?php

include 'recargas.php';

if(isset($_POST['designacao'], $_POST['numero'], $_POST['limite'], $_POST['saldoexterno'], $_POST['maximo']))
    {
        $designacao=$_POST['designacao'];
        $numero=$_POST['numero'];
        $limite=$_POST['limite'];
        $saldoexterno=$_POST['saldoexterno'];
        $maximo=$_POST['maximo'];
        $diaria=$_POST['diaria'];
        $texto="$designacao;$numero;$limite;$saldoexterno;$maximo;$diaria\n";
        guardarFicheiro($texto);
        header("Location: contas-registradas.php");
    }

    function guardarFicheiro($string){
        clonarSaldosRemotos();
        $myfile = fopen("ContasTesteServer.txt", "a") or die("Unable to open file!");
        fwrite($myfile, $string);
        remoteUpdateSaldo();
    }
?>
