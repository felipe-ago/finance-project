<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/cadastro.css">
    <title>Cadastro</title>
    <div>
        <a href="index.php" style="color:white;">Tela de Home</a>
</head>
<body>
    <div class="corpo">
        <header>
            <h2>Criar Conta</h2>
        </header>
        <form action="" class="form" id="form" method="post">
            <div class="form-corpo">
                <label for="username">Usuário</label>
                <input type="text" autocomplete="off" id="username" name="username" placeholder="Digite aqui seu usuário...">
                <div class="erroMsg"></div>
            </div>
            <div class="form-corpo">
                <label for="email">Email</label>
                <input class="verde" autocomplete="off" type="email" id="email" name="email" placeholder="Digite aqui seu email...">
                <div class="erroMsg"></div>
            </div>
            <div class="form-corpo">
                <label for="password">Senha</label>
                <input type="password" id="password" class="password" name="password" placeholder="Digite aqui sua senha...">
                <div class="erroMsg"></div>
            </div>
            <div class="form-corpo">
                <label for="Confpass">Confirme a Senha</label>
                <input type="password" id="confPass" name="confPass" placeholder="Confirma sua senha aqui...">
                <div class="erroMsg"></div>
            </div>
            <button type="submit" id="btn">Cadastrar</button>
        </form>
        <footer>
            <h5>Já tem uma conta?</h5>
            <h3><a href="login.php">Faça Login</a></h3>
        </footer>
    </div>
    <script src="assets/js/validaCadastro.js"></script>
</body>
</html>