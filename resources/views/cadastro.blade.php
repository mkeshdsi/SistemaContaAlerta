<!DOCTYPE html>
<html lang="PT-PT">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de conta</title>
    <link rel="icon" type="image/x-icon" href="logo_mkesh.png">
    <link rel="stylesheet" href="{{ url('/css/general.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ url('/css/cadastrocss.css') }}" type="text/css">
</head>
<body>

    <div class="container">
    <div class="title">Cadastro</div>
    <form action="{{ url('/ContaAlerta/Contasave/novaConta') }}" method="post">
        @csrf
        <div class="user-details">
            <div class="input-box">
                <span class="details">Designa&ccedil;&atilde;o</span>
                <input type="text" placeholder="Insira a designacao da conta" name="designacao" required>
            </div>
            <div class="input-box">
                <span class="details">N&uacute;mero</span>
                <input type="text" placeholder="Insira o numero da conta" name="numero" required>
            </div>
            <div class="input-box">
                <span class="details">Limite</span>
                <input type="text" placeholder="Insira o limite da conta" name ="limite"  required>
            </div>
            <div class="input-box">
                <span class="details">Saldo externo</span>
                <input type="text" placeholder="Insira o saldo da conta" name="saldoexterno" required>
            </div>
            <div class="input-box">
                <span class="details">M&aacute;ximo</span>
                <input type="text" placeholder="Insira o maximo da conta" name="maximo">
            </div>
            <!--
            <div class="input-box">
                <span class="details">Media di&aacute;ria</span>
                <input type="number" placeholder="0" value="0" name="diaria">
            </div>
            -->
        </div>
        <div class="button">
            <input type="submit" value="Cadastrar">
        </div>
    </form>
    </div>

    <footer class="footer">
        <p>Todos os direitos reservados MKESHIT&copy;</p>
    </footer>
</body>
</html>