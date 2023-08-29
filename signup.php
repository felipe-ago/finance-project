<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/signup.css">
    <title>Sign Up</title>
</head>
<body>
    <div class="body">
        <header>
            <h2>Criar Conta</h2>
        </header>
        <form action="assets/php/register.php" class="form" id="form" method="POST">
            <div class="form-control">
                <label for="username">Usuário</label>
                <input type="text" id="username" name="username" placeholder="Digite aqui seu usuário...">
                <i class="img-success"><img src="assets/img/success-icon.svg" alt=""></i>
                <i class="img-error"><img src="assets/img/error-icon.svg" alt=""></i>
                <div class="erroMsg"></div>
            </div>

            <div class="form-control">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" placeholder="Digite aqui seu e-mail...">
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

            <div class="form-control">
                <label for="Confpassword">Confirme a Senha</label>
                <input type="password" id="confirmPassword" name="confirm_password" placeholder="Digite sua senha novamente...">
                <i class="img-success"><img src="assets/img/success-icon.svg" alt=""></i>
                <i class="img-error"><img src="assets/img/error-icon.svg" alt=""></i>
                <div class="erroMsg"></div>
            </div>

            <button type="submit" id="btn">Cadastrar</button>

            <div class="modal">
                <div class="modal-content">
                    <p>Cadastro efetuado com sucesso!</p>
                </div>
            </div>

        </form>

        <footer>
            <h5>Já tem uma conta?</h5>
            <h3><a href="login.php">Faça Login</a></h3>
        </footer>
    </div>
    <script src="assets/js/signupValidation.js"></script>
</body>
</html>