<?php
include '../protect.php';
include_once 'data.php';
?>
<!DOCTYPE html>
<html lang="PT-PT">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contas registradas</title>
    <link rel="icon" type="image/x-icon" href="./../logo_mkesh.png">
    <link rel="stylesheet" href="./../general.css" type="text/css">
    <link rel="stylesheet" href="./../contasRegistradas.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" type="text/css">
</head>
<body>
    <div class="table">
        <div class="table_header">
          <p>Contas Registadas</p>  
            <div>
                <input type="text" placeholder="Conta">
                <button class="add_new"><a href="/ContaAlerta/cadastro.php" class="linka">+ Registar Conta</a></button>
            </div>
        </div>
        <div class="table_section">
            <table>
                <thead>
                    <tr>
                        <th>Designa&ccedil;&atilde;o</th>
                        <th>N&uacute;mero</th>
                        <th>Limite</th>
                        <th>Saldo dispon&iacute;vel</th>
                        <th>M&aacute;ximo recarreg&aacute;vel</th>
                        <th>&Uacute;ltima recarga</th>
                        <th>Data da recarga</th>
                        <th>Ac&ccedil;&atilde;o</th>
                    </tr>
                </thead>
                <tbody>
                @if (@isset($campos))
                @for ($i = 0; $i <= count($campos)-1; $i++)            
                <tr>
                    <td>{{ $campos[0] ?? ''}}</td>
                    <td>{{ $campos[1] ?? ''}}</td>
                    <td>{{ $campos[2] ?? ''}}</td>
                    <td>{{ $campos[3] ?? ''}}</td>
                    <td>{{ $campos[4] ?? ''}}</td>
                    <td>{{ $campos[5] ?? ''}}</td>
                    <td>{{ $campos[6] ?? ''}}</td>
                    <td>
                        <a href="#"><button><i class="fa-solid fa-pen-to-square"></i></button></a>
                        <a href="/ContaAlerta/phpcode/recarregarConta.php?numero=<?=$key[1];?>"><button><i class="fa-solid fa-file-invoice-dollar"></i></button></a>
                    </td>
                </tr>   
                @endfor
                @endif                 
                </tbody>
            </table>
        </div>
    </div>

    <footer class="footer">
        <p>Todos os direitos reservados MKESHIT&copy;</p>
    </footer>
</body>
</html>