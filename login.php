<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/login.css">
    <title>Login</title>
    <div>
        <a href="index.php" style="color:white;">Tela de Home</a>
    </div>
</head>
<body>
        <div class="body">
        <header>
            <h2>Entre em Sua Conta</h2>
        </header>
        <form class="form" action="assets/php/action_php/login_authenticator.php" id="loginForm" method="POST">
            <div class="form-control">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Digite aqui seu email...">
                <i class="img-success"><img src="assets/img/success-icon.svg" alt=""></i>
                <i class="img-error"><img src="assets/img/error-icon.svg" alt=""></i>
                <div class="erroMsg"></div>
            </div>
            <div class="form-control">
                <label for="password">Senha</label>
                <input type="password" id="password" class="password" name="password" placeholder="Digite aqui sua senha...">
                <i class="img-success"><img src="assets/img/success-icon.svg" alt=""></i>
                <i class="img-error"><img src="assets/img/error-icon.svg" alt=""></i>
                <div class="erroMsg"></div>
            </div>
            <button type="submit">Login</button>
        </form>
        <footer>
            <h5>Não tem uma conta?</h5>
            <h3><a href="signup.php">Faça seu cadastro</a></h3>
        </footer>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="assets/js/loginValidation.js"></script>
    
</body>
</html>