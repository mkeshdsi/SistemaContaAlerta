<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Principal</title>
    <link rel="icon" type="image/x-icon" href="{{ url('/imagem/logo_mkesh.png') }}" >
    <link rel="stylesheet" href="{{ url('/css/general.css') }}" type="text/css">
    <!-- Unicons -->
    <link rel="stylesheet" href="{{ url('https://unicons.iconscout.com/release/v4.0.8/css/line.css') }}" type="text/css">
</head>
<body>
       <!-- Header -->
    <header class="header">
    <nav class="nav">
        <a href="{{ url('/ContaAlerta') }}" class="nav_logo">mKeshIT</a>    
        </nav>
    </header>
       
       <div class="conteudo">
            <div class="quadro">
                <section class="contas">
                    <div class="botoes-link linka"><a href="{{ url('/ContaAlerta/ContaSave') }}" class="botoes">Nova conta</a></div>
                    <div class="botoes-link linkb"><a href="#" class="botoes">Recarregar conta</a></div>
                    <div class="botoes-link linkc"><a href="#" class="botoes">Actualizar conta</a></div>
                    <div class="botoes-link linkd"><a href="./phpcode/contas-registradas.php" class="botoes">Listar contas</a></div>
                </section>
            </div>
       </div>

       
    <footer class="footer">
    <p>Todos os direitos reservados mKeshIT&copy;</p>
    </footer>
       
</body>
</html>