#!/bin/bash

    prefixo=endofdayreport-balance_
    fixo=_000000
    prefixoVendas=endofdayreport-transaction_

    #data do primeiro ficheiro
    dataHoje=`date +%Y%m%d`
    dataOntem=`date -d '1 day ago' +'%Y%m%d'`
    diaum=`date -d '2 days ago' +'%Y%m%d'`

    #CASO ESPECIAL: DADOS E VOZ
    #LEITURA DAS VENDAS DOS ULTIMOS 3 DIAS
    #ESTES FICHEIROS DEVEM SER EXTRAIDOS AQUI!
    FILETRES="extraidoEOD/transactions-${diaum}${fixo}.csv"
    FILEDOIS="extraidoEOD/transactions-${dataOntem}${fixo}.csv"
    FILEUM="extraidoEOD/transactions-${dataHoje}${fixo}.csv"

    vendasCreditoUm=0
    vendasCreditoDois=0
    vendasCreditoTres=0

    #Leitura dia 3
    credito=air.prepaid.sp/SP
    dados=air.databundle.sp/SP

    while IFS=";" read -a line
    do   
        additionalInfo=${line[10]}

        case $additionalInfo in 

            $credito)
                sald=${line[5]}
                vendas=$( printf "%.0f" $sald )
                vendasCreditoTres=${vendas}
            ;;

            $dados)
                sald=${line[5]}
                vendas=$( printf "%.0f" $sald )
                vendasDadosTres=${vendas}
            ;;
        
        esac
    done < <(tac  $FILETRES)

    #Leitura do dia 2
    while IFS=";" read -a line
    do   
        additionalInfo=${line[10]}

        case $additionalInfo in 

            $credito)
                sald=${line[5]}
                vendas=$( printf "%.0f" $sald )
                vendasCreditoDois=${vendas}
            ;;

            $dados)
                sald=${line[5]}
                vendas=$( printf "%.0f" $sald )
                vendasDadosDois=${vendas}
            ;;
        
        esac
    done < <(tac  $FILEDOIS)


    #Leitura do dia 1
    while IFS=";" read -a line
    do   
    additionalInfo=${line[10]}

    case $additionalInfo in 

        $credito)
            sald=${line[5]}
            vendas=$( printf "%.0f" $sald )
            vendasCreditoUm=${vendas}
        ;;

        $dados)
            sald=${line[5]}
            vendas=$( printf "%.0f" $sald )
            vendasDadosUm=${vendas}
        ;;
    
    esac
    done < <(tac  $FILEUM)

    #Calculo das medias
    somaCredito=$(( vendasCreditoUm + vendasCreditoDois + vendasCreditoTres ))
    mediaCreditoGlobal=$(( somaCredito/3 ))
    somaDados=$(( vendasDadosUm + vendasDadosDois + vendasDadosTres ))
    mediaDadosGlobal=$(( somaDados/3 ))

    #CONTAS A VERIFICAR OS SALDOS
    #mkeshfinanceira@tmcel.mz
    simo=46601048
    simoatm=46601146
    airtime=40969929
    databundle=46472348
    credelec=46530995
    bim=210652379
    ecobankcom=46472368
    ecobankfu=557500016659

    #LEITURA DOS FICHEIROS E ANALISE DAS CONTAS
    while IFS=";" read -a line
    do   
    codigo=${line[1]}
    sald=${line[7]}
    saldo=$( printf "%.0f" $sald )

    case $codigo in 

        $simo)
            if [[ $((saldo)) -le 100000 ]]; then
            
                        #mailx -s "Saldo SIMO" -c icau@tmcel.mz,mkeshit@tmcel.mz mkeshfinanceira@tmcel.mz  <<< "
                        #Bom dia caros DFI,
                        #
                        #O saldo na conta SIMO - $simo (SIMO) no EWP está com saldo abaixo do mínimo definido (100.000,00MT), conforme os dados abaixo:
                        #Saldo actual: ${saldo},00 MT 
                        #
                        #Melhores comprimentos
                        #Departamento de Sistemas de Informação (DSI)"
                        echo "Ivanildo"
            fi
        ;;

        $simoatm)
            if [[ $((saldo)) -le 100000 ]]; then
                        
                        #mailx -s "Saldo SIMO ATM"  -c icau@tmcel.mz,mkeshit@tmcel.mz mkeshfinanceira@tmcel.mz  <<< "
                        #Bom dia caros DFI,
                        #
                        #O saldo na conta SIMO - $simoatm (SIMO ATM) no EWP está com saldo abaixo do mínimo definido (100.000,00MT), conforme os dados abaixo:
                        #Saldo actual: ${saldo},00 MT 
                        #
                        #Melhores comprimentos
                        #Departamento de Sistemas de Informação (DSI)"
                        echo "Ivanildo"
            fi
        ;;

        $airtime)
            if [[ $((saldo)) -le $((mediaCreditoGlobal)) ]]; then
                        
                        #mailx -s "Saldo TMCEL AIRTIME" -c icau@tmcel.mz,mkeshit@tmcel.mz mkeshfinanceira@tmcel.mz <<< "
                        #Bom dia caros DFI,
                        #
                        #O saldo na conta TMCEL - $airtime (AIRTIME) no EWP está com saldo abaixo da média das vendas dos últimos 3 dias, conforme os dados abaixo:
                        #Saldo actual: ${saldo},00 MT  
                        #Média das vendas dos últimos 3 dias: ${mediaCreditoGlobal},00 MT.
                        #
                        #Melhores comprimentos
                        #Departamento de Sistemas de Informação (DSI)"
                        echo "Ivanildo"
            fi

            if [[ $((saldo)) -le 100000 ]]; then
                    
                    #mailx -s "Saldo TMCEL AIRTIME" -c icau@tmcel.mz,mkeshit@tmcel.mz mkeshfinanceira@tmcel.mz <<< "
                    #Bom dia caros DFI,
                    #
                    #O saldo na conta TMCEL - $airtime (AIRTIME) no EWP está com saldo abaixo do mínimo definido (100.000,00MT), conforme os dados abaixo:
                    #Saldo actual: ${saldo},00 MT  
                    #
                    #Melhores comprimentos
                    #Departamento de Sistemas de Informação (DSI)"
                    echo "Ivanildo"
            fi
    ;;

        $databundle)
            if [[ $((saldo)) -le $((mediaDadosGlobal)) ]]; then
                        
                        #mailx -s "Saldo TMCEL -- DATABUNDLE" -c icau@tmcel.mz,mkeshit@tmcel.mz mkeshfinanceira@tmcel.mz <<< "
                        #Bom dia caros DFI,
                        #
                        #O saldo na conta TMCEL - $databundle (DATABUNDLE) no EWP está com saldo abaixo da média das vendas dos últimos 3 dias, conforme os dados abaixo:
                        #Saldo actual: ${saldo},00 MT  
                        #Média das vendas dos últimos 3 dias: ${mediaDadosGlobal},00 MT.   
                        #
                        #Melhores comprimentos
                        #Departamento de Sistemas de Informação (DSI)"
                        echo "Ivanildo"
            fi

            if [[ $((saldo)) -le 100000 ]]; then
                        
                        #mailx -s "Saldo TMCEL -- DATABUNDLE" -c icau@tmcel.mz,mkeshit@tmcel.mz mkeshfinanceira@tmcel.mz <<< "
                        #Bom dia caros DFI,
                        #O saldo na conta TMCEL - $databundle (DATABUNDLE) no EWP está com saldo abaixo do mínimo definido (100.000,00MT), conforme os dados abaixo:
                        #Saldo actual: ${saldo},00 MT  
                        #
                        #Melhores comprimentos
                        #Departamento de Sistemas de Informação (DSI)"
                        echo "Ivanildo"
            fi
    ;;

        $credelec)
            if [[ $((saldo)) -le 1000000 ]]; then
                        
                        #mailx -s "Saldo -- CREDELEC"  -c icau@tmcel.mz,mkeshit@tmcel.mz mkeshfinanceira@tmcel.mz  <<< "
                        #Bom dia caros DFI,
                        #
                        #O saldo na conta CREDELEC - $credelec (CREDELEC) no EWP está com saldo abaixo do mínimo definido (100.000,00MT), conforme os dados abaixo:
                        #Saldo actual: ${saldo},00 MT  
                        #
                        #Melhores comprimentos
                        #Departamento de Sistemas de Informação (DSI)"
                        echo "Ivanildo"
            fi
        ;;

        $bim)
            if [[ $((saldo)) -le 2000000 ]]; then
                        
                        #mailx -s "Saldo -- BIM"  -c icau@tmcel.mz,mkeshit@tmcel.mz mkeshfinanceira@tmcel.mz <<< "
                        #Bom dia caros DFI,
                        #
                        #O saldo na conta BIM - $bim (BIM) no EWP está com saldo abaixo do mínimo definido (2.000.000,00MT), conforme os dados abaixo:
                        #Saldo actual: ${saldo},00 MT 
                        #
                        #Melhores comprimentos
                        #Departamento de Sistemas de Informação (DSI)"
                        echo "Ivanildo"
            fi
        ;;

        $ecobankcom)
            if [[ $((saldo)) -le 100000 ]]; then
                    
                    #mailx -s "Saldo -- Ecobank-COMPENSAÇÃO" -c icau@tmcel.mz,mkeshit@tmcel.mz mkeshfinanceira@tmcel.mz <<< "
                    #Bom dia caros DFI,
                    #
                    #O saldo na conta ECOBANK - $ecobankcom (ECOBANK COMPENSAÇÃO) no EWP está com saldo abaixo do mínimo definido (100.000,00MT), conforme os dados abaixo:
                    #Saldo actual: ${saldo},00 MT 
                    #
                    #Melhores comprimentos
                    #Departamento de Sistemas de Informação (DSI)"
                    echo "Ivanildo"
            fi
        ;;

        $ecobankfu)
            if [[ $((saldo)) -le 5000000 ]]; then
                        
                        #mailx -s "Saldo -- Ecobank-FIDUCIÁRIA" -c icau@tmcel.mz,mkeshit@tmcel.mz mkeshfinanceira@tmcel.mz <<< "
                        #Bom dia caros DFI,
                        #
                        #O saldo na conta ECOBANK - $ecobankfu (ECOBANK FIDUCIÁRIA) no EWP está com saldo abaixo do mínimo definido (5.000.000,00MT), conforme os dados abaixo:
                        #Saldo actual: ${saldo},00 MT 
                        #
                        #Melhores comprimentos
                        #Departamento de Sistemas de Informação (DSI)"
                        echo "Ivanildo"
            fi
        ;;
    
    esac
    done < <(tac  "Contas.txt")

    #Apagar ficheiros usados
    rm -r extraidoEOD/*
