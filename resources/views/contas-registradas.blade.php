<!DOCTYPE html>
<html lang="PT-PT">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contas registradas</title>
    <link rel="icon" type="image/x-icon" href="{{ url('/imagem/logo_mkesh.png') }}" >
    <link rel="stylesheet" href="{{ url('/css/general.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ url('/css/contasRegistradas.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ url('/css/icons.css') }}" type="text/css">
</head>
<body>
    <div class="table">
        <div class="table_header">
          <p>Contas Registadas</p>  
            <div>
                <input type="text" placeholder="Conta">
                <button class="add_new"><a href="{{ url('/ContaAlerta/ContaSave') }}" class="linka">+ Registar Conta</a></button>
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
 
                @for ($i = 0; $i < count($conteudo); $i++)     
                <tr>
                    <td>{{ $conteudo[$i][0] ?? ''}}</td>
                    <td>{{ $conteudo[$i][1] ?? ''}}</td>
                    <td>{{ $conteudo[$i][2] ?? ''}}</td>
                    <td>{{ $conteudo[$i][3] ?? ''}}</td>
                    <td>{{ $conteudo[$i][4] ?? ''}}</td>
                    <td>{{ $conteudo[$i][5] ?? ''}}</td>
                    <td>{{ $conteudo[$i][6] ?? ''}}</td>
                    <td>
                        <a href="{{ url('/ContaAlerta/Contasave/novaConta',[$conteudo[$i][1] ?? ''])}}"><button>Recarregar</button></a>
                    </td>
                </tr>
                @endfor             
                </tbody>
            </table>
        </div>
    </div>

    <footer class="footer">
        <p>Todos os direitos reservados MKESHIT&copy;</p>
    </footer>
</body>
</html>