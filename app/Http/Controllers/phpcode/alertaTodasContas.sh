#!/bin/bash

#EXTRACAO DO FICHEIRO
#/home/ewp_archiver/EWP_EOD
#CAMINHO=/D/Carteira_MovelSa/Trabalhos/Junho_2023_Tr/EWP_EOD/ #CAMINHO ABSOLUTO PARA ENCONTRAR O FILE A SER EXTRAIDOS
CAMINHO=/home/ewp_archiver/EWP_EOD

#PREFIXOS USADOS
prefixo=endofdayreport-balance_
fixo=_000000
prefixoVendas=endofdayreport-transaction_

#data do primeiro ficheiro
dataHoje=`date +%Y%m%d`
dataOntem=`date -d '1 day ago' +'%Y%m%d'`
#GUARDAR OS FICHEIROS QUE NAO FORAM ENVIADOS
touch ficheirosEmFalta.txt

#DIA-1
CAMINHOCOMPLETO="${CAMINHO}${prefixo}${dataOntem}${fixo}-${dataHoje}${fixo}.zip"
UM="${CAMINHO}${prefixoVendas}${dataOntem}${fixo}-${dataHoje}${fixo}.zip"
if  [[ -f $CAMINHOCOMPLETO && -f $UM ]]; then
    unzip -n $CAMINHOCOMPLETO "user-account-balances-${dataHoje}_000000.csv" -d extraidoEOD
    unzip -n $UM "transactions-${dataHoje}_000000.csv" -d extraidoEOD
#FUNCAO PARA REDEFINIR O SALDO NO FICHEIROS CONTAS
elif ! grep -Fxq "${prefixo}${dataOntem}${fixo}-${dataHoje}${fixo}" ficheirosEmFalta.txt; then
    echo "${prefixo}${dataOntem}${fixo}-${dataHoje}${fixo}.zip" >> ficheirosEmFalta.txt
    exit 0
fi

#DIA-2
diaum=`date -d '2 days ago' +'%Y%m%d'`
CAMINHODOIS="${CAMINHO}${prefixo}${diaum}${fixo}-${dataOntem}${fixo}.zip"
DOIS="${CAMINHO}${prefixoVendas}${diaum}${fixo}-${dataOntem}${fixo}.zip"
if  [[ -f $CAMINHODOIS && -f $DOIS ]]; then
    unzip -n $CAMINHODOIS "user-account-balances-${dataOntem}_000000.csv" -d extraidoEOD
    unzip -n $DOIS "transactions-${dataOntem}_000000.csv" -d extraidoEOD
elif ! grep -Fxq "${prefixo}${diaum}${fixo}-${dataOntem}${fixo}" ficheirosEmFalta.txt; then
    echo "${prefixo}${diaum}${fixo}-${dataOntem}${fixo}.zip" >> ficheirosEmFalta.txt
    exit 0
fi

#DIA-3
diatres=`date -d '3 days ago' +'%Y%m%d'`
CAMINHOTRES="${CAMINHO}${prefixo}${diatres}${fixo}-${diaum}${fixo}.zip"
TRES="${CAMINHO}${prefixoVendas}${diatres}${fixo}-${diaum}${fixo}.zip"
if  [[ -f $TRES ]]; then
    #unzip -n $CAMINHOTRES "user-account-balances-${diaum}_000000.csv" -d extraidoEOD
    unzip -n $TRES "transactions-${diaum}_000000.csv" -d extraidoEOD
else
    exit 0
fi


if ! [[ -s ficheirosEmFalta.txt ]]; then
    #DEVE SER VERIFICADO O FICHEIRO "ficheirosEmFalta" e for nulo, para que o trecho abaixo seja executado.!
    #CALCULAR O ACAUMULADO
    #Captura das datas para organizar
    datas=()
    while read -a lines
    do
        IFS='_' read -ra IN <<< "${lines}"
        IFS='-' read -ra ADDR <<< "${IN[2]}"
        datas+=(${ADDR[1]})
        #echo $var
        if ! [[ -f "${CAMINHO}${lines}" ]]; then
            #echo "${CAMINHO}${lines}"
            echo "Ficheiros em falta. Impossivel calcular saldos."
            exit 0
        fi
    done < "ficheirosEmFalta.txt"
    for i in "${datas[@]}"
    do
        unzip -n "$CAMINHO*${i}${fixo}.zip" 'user-account-balances-'${i}'_000000.csv' -d extraidoEOD
    done
    rm ficheirosEmFalta.txt
    #Organizar os ficheiros em ordem
        find ./extraidoEOD/ -name "user*" -exec basename {} \; >> ficheirosOrdem.txt

    #Redefinir saldos
    while IFS=";" read -a contas
    do
        numContas=${contas[1]}
        saldoContas=${contas[3]}
        saldoContass=$( printf "%.0f" $saldoContas )
        acumulado=0
        saldoAnterior=0
        controlador=0
        diferenca=0
        ficheiroAnterior=""
        ficheiroActual=""
        while read -a ficheiroOrderm
        do
            if [[ $(( controlador )) -eq 0 ]]; then
            let "controlador+=1"
                ficheiroAnterior=${ficheiroOrderm}
                continue
            else
                ficheiroActual=${ficheiroOrderm}
                while IFS=";" read -a eodFileOntem
                do
                    contaOntem=${eodFileOntem[1]}
                    saldOntem=${eodFileOntem[7]}
                    if [[ $saldOntem == "balance"  ]]; then
                        continue
                    else
                        saldoOntem=$( printf "%.0f" $saldOntem )
                        if [[ $((numContas)) -eq $(( contaOntem )) ]]; then
                            while IFS=";" read -a eodFileAnteOntem
                            do
                                contaAnteOntem=${eodFileAnteOntem[1]}
                                saldAnteOntem=${eodFileAnteOntem[7]}
                                if [[ $saldAnteOntem == "balance" ]]; then
                                    continue
                                else
                                    saldoAnteOntem=$( printf "%.0f" $saldAnteOntem )
                                    if [[ $(( contaOntem )) -eq $(( contaAnteOntem )) ]]; then
                                        diferenca=$(( saldoOntem - saldoAnteOntem ))
                                        #echo "Conta:${contaAnteOntem} Saldo actual:${saldoOntem} Saldo anterior:${saldoAnteOntem} Diferenca:${diferenca}"
                                        break
                                    fi
                                fi
                            done < <(tac "extraidoEOD/${ficheiroAnterior}")
                            ficheiroAnterior=$ficheiroOrderm
                            acumulado=$(( diferenca + acumulado ))
                            break
                        fi
                    fi
                done < <(tac "extraidoEOD/${ficheiroActual}")
                ficheiroAnterior=${ficheiroActual}
            fi
        done < <(cat "ficheirosOrdem.txt")
        echo "${numContas};${acumulado}" >> ficheiroAcumulado.txt
    done < "Contas.txt"
    rm ficheirosOrdem.txt
    while IFS=";" read -a contas
    do
        numContas=${contas[1]}
        saldoContas=${contas[3]}
        saldoContass=$( printf "%.0f" $saldoContas )
        controladordef=1
        while IFS=";" read -a acumulo
        do
            numacumulo=${acumulo[0]}
            saldoacumulo=${acumulo[1]}
            saldoacumuloo=$( printf "%.0f" $saldoacumulo )
            if [[ $(( numContas )) -eq $(( numacumulo )) ]]; then
                novoSaldodefinido=$(( saldoContass - saldoacumuloo ))
                sed -i "${controladordef}s/${saldoContas}/${novoSaldodefinido}/" "Contas.txt"
                echo "Linha:${controladordef} Substituindo:${saldoContas} Novo saldo:${novoSaldodefinido} Saldo Acumulado: ${saldoacumuloo} Saldo Antigo:${saldoContass}"
                break
            fi
            let "controladordef+=1"
        done < <(cat "ficheiroAcumulado.txt")
    done < "Contas.txt"
    rm ficheiroAcumulado.txt
    ##FUNCAO PARA ENVIO DE EMAILS
    bash ./controloConta.sh
    exit 0
else
    ##CALCULO NORMAL SEM INTERRUPCOES
    contador=1
    while IFS=";" read -a line
    do   
        conta=${line[1]}
        sald=${line[3]}
        saldo=$( printf "%.0f" $sald )
        diferenca=0
        while IFS=";" read -a eodFileOntem
        do
            contaOntem=${eodFileOntem[1]}
            saldOntem=${eodFileOntem[7]}
            if [[ $saldOntem == "balance"  ]]; then
                continue
            else
                saldoOntem=$( printf "%.0f" $saldOntem )
                if [[ $(( conta )) -eq $(( contaOntem )) ]]; then
                    while IFS=";" read -a eodFileAnteOntem
                    do
                        contaAnteOntem=${eodFileAnteOntem[1]}
                        saldAnteOntem=${eodFileAnteOntem[7]}
                        if [[ $saldAnteOntem == "balance" ]]; then
                            continue
                        else
                            saldoAnteOntem=$( printf "%.0f" $saldAnteOntem )
                            if [[ $(( contaOntem )) -eq $(( contaAnteOntem )) ]]; then
                                diferenca=$(( saldoOntem - saldoAnteOntem ))
                                break
                            fi
                        fi
                    done < <(tac "extraidoEOD/user-account-balances-${dataOntem}_000000.csv")
                    break
                fi
            fi
        done < <(tac "extraidoEOD/user-account-balances-${dataHoje}_000000.csv")
        novoSaldo=$(( saldo - diferenca ))
        sed -i "${contador}s/${sald}/${novoSaldo}/" "Contas.txt"
        contador=$(( contador + 1 ))
    done < "Contas.txt"
    #FUNCAO PARA ENVIO DE EMAILS
    bash ./controloConta.sh
    exit 0
    ##CALCULO PARA CASOS ESPECIAIS (INTERRUPÇOES DE ENVIO DE FICHEIROS)
fi