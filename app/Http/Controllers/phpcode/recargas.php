<?php
    include_once 'data.php';
    include_once 'ContaCompensa.php';
        
    if(isset($_POST['numero'], $_POST['recarga']))
    {
        $numero=$_POST['numero'];
        $recarga=$_POST['recarga'];
        $linhaCompleta = linhaConteudo($campos, $numero);
        $stringe="$linhaCompleta[0];$linhaCompleta[1];$linhaCompleta[2];$linhaCompleta[3];$linhaCompleta[4]";
        
        
        $novaRecarga = new ContaCompensa($linhaCompleta[0],$linhaCompleta[1],$linhaCompleta[2],$linhaCompleta[3],$linhaCompleta[4]);
        $novaRecarga->recarga($recarga);
        $novaRecarga->setMaximo($linhaCompleta[4]);
        $novoSaldo=$novaRecarga->getSaldo();
        $designacao=$novaRecarga->getDesignacaoParent();
        $limite= $novaRecarga->getLimite();
        $saldo=$novaRecarga->getSaldo();
        $maximo=$novaRecarga->getMaximo();
        $data=date("Y-m-d");
        $stringee="$designacao;$numero;$limite;$saldo;$maximo;$recarga;$data";
        updateSaldo($stringe,$stringee);
        remoteUpdateSaldo();
        trackSaldos($designacao,$stringee);
        header("Location: contas-registradas.php");
    }

    function trackSaldos($designacao,$track){
        //$caminho = "/ScontaAlerta/phpcode/".$designacao;
        $caminho = $designacao;
        if (! file_exists($caminho)) {
            mkdir($caminho);
        }
        $trackFile = fopen("$caminho/".$designacao.".txt", "a") or die("Unable to open file!");
        fwrite($trackFile, "$track\n");
    }

    function updateSaldo($stringAntes,$stringDepois){
        clonarSaldosRemotos();
        $strings = file_get_contents("ContasTesteServer.txt");
        $replace = str_replace($stringAntes,$stringDepois,$strings);
        file_put_contents("ContasTesteServer.txt",$replace);
    }
    
    function clonarSaldosRemotos(){
        $fh = fopen('ftp://devloper:root@127.0.0.1:21/teste/Contas.txt','r');    
        $ficheiroDestino = fopen("ContasTesteServer.txt","w+");
        while(! feof($fh)) {
            $line = fgets($fh);
            fwrite($ficheiroDestino, $line);
          }
        fclose($ficheiroDestino);
    }

    function remoteUpdateSaldo(){
    // Connect to FTP server
    $ftp_server = "localhost";
    
    // Use FTP username
    $ftp_username="devloper";
    
    // Use FTP password 
    $ftp_userpass="root";
    
    // Establish ftp connection 
    $ftp_connection = ftp_connect($ftp_server, 21) 
        or die("Could not connect to $ftp_server");
    
    if($ftp_connection) {
        echo "Successfully connected to the ftp server!";
    
        // logging in to established connection with
        // ftp username password
        $login = ftp_login($ftp_connection, $ftp_username, $ftp_userpass);
        
        if($login) {
            echo "<br>Logged in successfully!";
        }
        else {
            echo "<br>Login failed!";
        }

        $file = 'ContasTesteServer.txt';
        $remote_file = '/teste/Contas.txt';

        if (ftp_put($ftp_connection, $remote_file, $file, FTP_ASCII)) {
            echo "successfully uploaded $file\n";
        } else {
            echo "There was a problem while uploading $file\n";
        }

        }
        unlink("ContasTesteServer.txt");
        }
?>