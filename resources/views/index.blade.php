<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>In&iacute;cio</title>
    <link rel="icon" type="image/x-icon" href="{{ url('/imagem/logo_mkesh.png') }}" >
    <link rel="stylesheet" href="{{ url('/css/testeCss.css') }}" type="text/css">
    <!-- Unicons -->
    <link rel="stylesheet" href="{{ url('https://unicons.iconscout.com/release/v4.0.8/css/line.css') }}" type="text/css">
</head>
<body>
       <!-- Header -->
    <header class="header">
    <nav class="nav">
        <a href="#" class="nav_logo">mKeshIT</a>    
        <ul class="nav_items">
            <li class="nav_item">
                <a href="#" class="nav_link">In&iacute;cio</a>
                <a href="#" class="nav_link">Contas</a>
                <a href="#" class="nav_link">Contas Especiais</a>
                <a href="#" class="nav_link">Contas Compensacao</a>
            </li>
        </ul>


        <button class="button" id="form-open">Conectar&#45;se</button>
        </nav>
    </header>
       

       <!--HOME-->
    <section class="home">
        <div class="form_container">
        <i class="uil uil-times form_close"></i>
        <!--Login Form-->
            <div class="form login_form">
                <form action="{{ url('/ContaAlerta/login') }}" method="post">
                    @csrf
                    <h2>Entrar</h2>
                    <div class="input_box">
                        <input type="text" name="utilizador" placeholder="Coloque o seu usuario" required>
                       <!--<i class="uil uil-envelope-alt email"></i>--> 
                    </div>

                    <div class="input_box">
                        <input type="password" name="senha" placeholder="Coloque a sua senha" required>
                        <i class="uil uil-lock password"></i>
                        <i class="uil uil-eye-slash pw_hide"></i>
                    </div>


                    <div class="option_field">
                        <span class="checkbox">
                            <input type="checkbox" name="" id="check">
                            <label for="check">Lembrar me</label>
                        </span>
                        <a href="#" class="forgot_pw">Esqueci&#45;me da senha</a>
                    </div>
                    <button class="button" value="0" name="nnovo">
                        Entrar
                    </button>
                    <div class="login_signup">
                       N&atilde;o tem conta&#63; <a href="#" id="signup">Cadastre&#45;se</a>
                    </div>              
                </form>
            </div>



                    <!--Signup form--> 
                <div class="form signup_form">
                <form action="{{ url('/ContaAlerta/create') }}" method="post">
                    @csrf
                    <h2>Cadastrar</h2>
                    <div class="input_box">
                        <input type="text" name="usuario" placeholder="Coloque o seu usuario" required>
                        <!-- <i class="uil uil-envelope-alt email"></i> -->
                    </div>

                    <div class="input_box">
                        <input type="password" name="senha_um" placeholder="Crie sua senha" required>
                        <i class="uil uil-lock password"></i>
                        <i class="uil uil-eye-slash pw_hide"></i>
                    </div>

                    <div class="input_box">
                        <input type="password" name="senha_dois" placeholder="Confirme a sua senha" required>
                        <i class="uil uil-lock password"></i>
                        <i class="uil uil-eye-slash pw_hide"></i>
                    </div>

                    <button class="button" value="1" name="novo">Cadastrar</button>

                    <div class="login_signup">
                        Tem conta&#63; <a href="#" id="login">Acesse a sua conta</a>
                    </div>
                </form>
            </div>
    </div>
    </section>
    <footer class="footer">
    <p>Todos os direitos reservados mKeshIT&copy;</p>
    </footer>
       <script src="{{ asset('/js/script.js') }} "></script>
</body>
</html>