<?php
include_once('config.php');
session_start();

// ===== Cadastro =====
if (isset($_POST['cadastrar'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Criptografa a senha antes de salvar
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    $result = mysqli_query($conexao, "INSERT INTO usuarios(nome, email, senha)
    VALUES ('$nome', '$email', '$senhaHash')");

}

// ===== Login =====
if (isset($_POST['logar'])) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    $resultado = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($resultado) > 0) {
        $usuario = mysqli_fetch_assoc($resultado);

        if (password_verify($senha, $usuario['senha'])) {
            $_SESSION['usuario'] = $usuario['nome'];
            header("Location: ../src/homeAluno/homeAluno.php");
            exit;
        } else {
            echo "<script>alert('Senha incorreta!');</script>";
        }
    } else {
        echo "<script>alert('E-mail não encontrado!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Login</title>
</head>
<body>
    <div class="container">
        <!-- Login -->
        <div class="form-box login">
            <form method="post" action="">
                <h1>Login</h1>
                <div class="input-box">
                    <input type="text" name="email" placeholder="E-mail" required>
                </div>
                <div class="input-box">
                    <input type="password" name="senha" placeholder="Senha" required>                    
                </div>
                <button type="submit" name="logar" class="btn">Entrar</button>
            </form>
        </div>

        <!-- Cadastro -->
        <div class="form-box register">
            <form method="post" action="">
                <h1>Cadastre-se</h1>
                <div class="input-box">
                    <input type="text" name="nome" placeholder="Usuário" required>
                </div>
                <div class="input-box">
                    <input type="text" name="email" placeholder="E-mail" required>
                </div>
                <div class="input-box">
                    <input type="password" name="senha" placeholder="Senha" required>                    
                </div>
                <button type="submit" name="cadastrar" class="btn">Cadastrar</button>
            </form>
        </div>

        <!-- Painéis de alternância -->
        <div class="toggle-box">
            <div class="toggle-panel toggle-left">
                <h1 class="h1 register">Não tem uma conta? Cadastre-se!</h1>
                <img src="img/cadastro.png" alt="Cadastro">
                <button class="btn register-btn">Cadastre-se</button>
            </div>

            <div class="toggle-panel toggle-right">
                <h1 class="h1 login">Já tem uma conta? Vamos logar!</h1>
                <img src="img/login.png" alt="Login">
                <button class="btn login-btn">Logar</button>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>
