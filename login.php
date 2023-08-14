<!DOCTYPE html>
<html lang="en">
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
</head>
<body>
        <div class="corpo">
        <header>
            <h2>Entre em Sua Conta</h2>
        </header>
        <form class="form" id="loginForm" method="post">
            <div class="form-corpo">
                <label for="email">Email</label>
                <input type="email" autocomplete="off" id="email" name="email" placeholder="Digite aqui seu email...">
                <div class="erroMsg"></div>
            </div>
            <div class="form-corpo">
                <label for="password">Senha</label>
                <input type="password" autocomplete="off" id="password" class="password" name="password" placeholder="Digite aqui sua senha...">
                <div class="erroMsg"></div>
            </div>
            <button type="submit">Login</button>
        </form>
        <footer>
            <h5>Não tem uma conta?</h5>
            <h3><a href="cadastro.php">Faça seu cadastro</a></h3>
        </footer>
    </div>
</body>
</html>