<?php
include '../protect.php';
include_once 'data.php';
        $numero="";
        if (isset($_GET['numero'])) {
            $numero = $_GET['numero'];
            $resultado=linhaConteudo($campos, $numero);
    }

        
?>
<!DOCTYPE html>
<html lang="PT-PT">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recarga de conta</title>
    <link rel="icon" type="image/x-icon" href="./../logo_mkesh.png">
    <link rel="stylesheet" href="./../general.css" type="text/css">
    <link rel="stylesheet" href="./../cadastrocss.css" type="text/css">
</head>
<body>

    <div class="container">
    <div class="title">Recarga</div>
    <form action="recargas.php" method="POST">
        <div class="user-details">
            <div class="input-box">
                <span class="details">Designa&ccedil;&atilde;o</span>
                <input type="text" placeholder="<?=$resultado[0];?>" value="<?=$resultado[0];?>" name="designacao" readonly>
            </div>
            <div class="input-box">
                <span class="details">N&uacute;mero</span>
                <input type="number" placeholder="<?=$resultado[1];?>" name="numero" value="<?=$numero;?>" readonly>
            </div>
            <div class="input-box">
                <span class="details">Limite</span>
                <input type="number" placeholder="<?=$resultado[2];?>" value="<?=$resultado[2];?>" name ="limite"  readonly>
            </div>
            <div class="input-box">
                <span class="details">Saldo externo</span>
                <input type="number" placeholder="<?=$resultado[3];?>" value="<?=$resultado[3];?>"  name="saldoexterno" readonly>
            </div>
            <div class="input-box">
                <span class="details">M&aacute;ximo</span>
                <input type="number" placeholder="<?=$resultado[4];?>" value="<?=$resultado[4];?>" name="maximo" readonly>
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