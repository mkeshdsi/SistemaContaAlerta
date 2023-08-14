<?php
$campos=array();

//$fh = fopen('ftp://devloper:root@127.0.0.1:21/teste/Contas.txt','r');
$fh = fopen('ewp_archiver:Mkesh2021!@10.100.57.116:22/home/ewp_archiver/EWP_RECON/ContaAlerta/Contas.txt','r');
/*
while(! feof($fh)) {
    $line = fgets($fh);
    $conteudo=explode(";",$line);
    array_push($campos,$conteudo);
  }
  fclose($fh);*/
/*
$handle = fopen("ContasTesteServer.txt", "r");
if ($handle) {
while (($line = fgets($handle)) !== false) {
    $conteudo=explode(";",$line);
    array_push($campos,$conteudo);
        }
    }
*/

function linhaConteudo($vector,$numero){
    foreach ($vector as $key) {
        if($key[1] == $numero){
            $conteudo = $key;
        }
    }
    return $conteudo;
}

?>