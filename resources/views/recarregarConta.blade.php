<!DOCTYPE html>
<html lang="PT-PT">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recarga de conta</title>
    <link rel="icon" type="image/x-icon" href="{{ url('/imagem/logo_mkesh.png') }}" >
    <link rel="stylesheet" href="{{ url('/css/general.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ url('/css/cadastrocss.css') }}" type="text/css">
</head>
<body>

    <div class="container">
    <div class="title">Recarga</div>
    <form action="{{ url('/ContaAlerta/Contasave/recarga') }}" method="POST">
        @csrf
        <div class="user-details">
            <div class="input-box">
                <span class="details">Designa&ccedil;&atilde;o</span>
                <input type="text" placeholder="{{ $conta[0][0] }}" value="{{ $conta[0][0] }}" name="designacao" readonly>
            </div>
            <div class="input-box">
                <span class="details">N&uacute;mero</span>
                <input type="number" placeholder="{{ $conta[0][1] }}" name="numero" value="{{ $conta[0][1] }}" readonly>
            </div>
            <div class="input-box">
                <span class="details">Limite</span>
                <input type="number" placeholder="{{ $conta[0][2] }}" value="{{ $conta[0][2] }}" name ="limite"  readonly>
            </div>
            <div class="input-box">
                <span class="details">Saldo dispon&iacute;vel</span>
                <input type="number" placeholder="{{ $conta[0][3] }}" value="{{ $conta[0][3] }}"  name="saldoexterno" readonly>
            </div>
            <div class="input-box">
                <span class="details">M&aacute;ximo recarreg&aacute;vel</span>
                <input type="number" placeholder="{{ $conta[0][4] }}" value="{{ $conta[0][4] }}" name="maximo" readonly>
            </div>
            <div class="input-box">
                <span class="details">Recarga</span>
                <input type="number"  name="recarga">
            </div>
        </div>
        <div class="button">
            <input type="submit" value="Recarregar">
        </div>
    </form>
    </div>

        <footer class="footer">
            <p>Todos os direitos reservados MKESHIT&copy;</p>
        </footer>
</body>
</html>