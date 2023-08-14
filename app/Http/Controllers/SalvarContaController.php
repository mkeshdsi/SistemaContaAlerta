<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use phpseclib3\Net\SFTP\Stream;
use phpseclib3\Net\SFTP;

class SalvarContaController extends Controller
{
    function salvarConta(Request $request){
            
            $designacao=$request->designacao;
            $numero=$request->numero;
            $limite=$request->limite;
            $saldoexterno=$request->saldoexterno;
            $maximo=$request->maximo;
            $diaria=$request->diaria;
            $texto="$designacao;$numero;$limite;$saldoexterno;$maximo;$diaria";
            $this->guardarFicheiro($texto);
            return redirect('/ContaAlerta/contas-disponiveis');
            
    }

    function guardarFicheiro($string){
        $this->clonarSaldosRemotos();
        Storage::disk('local')->append('recursos/ContasTesteServer.txt', $string);
        $this->remoteUpdateSaldo();
    }

    function lerContas(){
        $campo=array();
        //$fh = fopen(storage_path('app/recursos/ContasTesteServer.txt'), 'r');
        Stream::register();
        $fh = fopen('sftp://ewp_archiver:Mkesh2021!@10.100.57.116:22/home/ewp_archiver/EWP_RECON/ContaAlerta/Contas.txt','r');
        //$fh = fopen('ftp://devloper:root@127.0.0.1:21/teste/Contas.txt','r');
        while(! feof($fh)) {
            $line = fgets($fh);
            $conteudo=explode(";",$line);
            array_push($campo,$conteudo);
        }
        return view('contas-registradas', array("conteudo"=>$campo));
    }

    function mostrarDetalhes(Request $request, $conteudo){
        $conta=$this->retornarLinha($conteudo);
        return view('recarregarConta', array("conta" => $conta));
    }

    function retornarLinha($codigo){
        $this->clonarSaldosRemotos();
        $conta=array();
        $fh = fopen(storage_path('app/recursos/ContasTesteServer.txt'), 'r');
        while(! feof($fh)) {
            $line = fgets($fh);
            $posicao=explode(";",$line);
            if($posicao[1] == $codigo){
                array_push($conta,$posicao);
            }
        }
        return $conta;
    }

    function somarRecarga($saldo, $recarga){
        $novoSaldo = $saldo + $recarga;
        return $novoSaldo;
    }

    private function trackSaldos($designacao,$track){
        Storage::disk('local')->append('recursos/track/'.$designacao.'.txt', $track);
    }

    function recarregarConta(Request $request){
        $numero=$request->numero;
        $recarga=$request->recarga;
        $novo = explode(";",collect($this->retornarLinha($numero)[0])->implode(';'));
        array_pop($novo);
        $stringe = collect($novo)->implode(';');
        
        $saldo=$this->somarRecarga($novo[3],$recarga);
        $data=date("Y-m-d");
        $stringee="$novo[0];$numero;$novo[2];$saldo;$novo[4];$recarga;$data;";
        $this->updateSaldo($stringe,$stringee);
        $this->remoteUpdateSaldo();
        $this->trackSaldos($novo[0],$stringee);
        return redirect('/ContaAlerta/contas-disponiveis');
    }

    function updateSaldo($stringAntes,$stringDepois){
        $strings = file_get_contents(storage_path('app/recursos/ContasTesteServer.txt'));
        $replace = str_replace($stringAntes,$stringDepois,$strings);
        file_put_contents(storage_path('app/recursos/ContasTesteServer.txt'),$replace);
    }

    private function clonarSaldosRemotos(){
        //$fh = fopen('ftp://devloper:root@127.0.0.1:21/teste/Contas.txt','r');    
        Stream::register();
        $fh = fopen('sftp://ewp_archiver:Mkesh2021!@10.100.57.116:22/home/ewp_archiver/EWP_RECON/ContaAlerta/Contas.txt','r');
        $ficheiroDestino = fopen(storage_path('app/recursos/ContasTesteServer.txt'),"w+");
        while(! feof($fh)) {
            $line = fgets($fh);
            fwrite($ficheiroDestino, $line);
          }
        fclose($ficheiroDestino);
    }

    private function remoteUpdateSaldo(){
        $sftp = new SFTP('10.100.57.116');
        $sftp->login('ewp_archiver', 'Mkesh2021!');
        $sftp->put(storage_path('app/recursos/ContasTesteServer.txt'), 'xxx');
        $sftp->put('/home/ewp_archiver/EWP_RECON/ContaAlerta/Contas.txt',storage_path('app/recursos/ContasTesteServer.txt'), SFTP::SOURCE_LOCAL_FILE);
        unlink(storage_path('app/recursos/ContasTesteServer.txt'));
        }
}