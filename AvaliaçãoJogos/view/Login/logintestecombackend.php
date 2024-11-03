<?php
session_start();
// require '<nomedobancodedadosou ../diretorio/diretorio/nomedobancodedadosouapastaquecedeoacessoaobancodedados'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($usuario && password_verify($senha, $usuario['senha'])) {
        $_SESSION['usuario_id'] = $usuario['id'];
        header('Location: ../home/home.php'); 
        exit();
    } else {
        $erro = "Email ou senha inválidos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="login-container">
        <div class="profile-icon">
            <img src="images-removebg-preview.png" alt="Ícone do perfil">
        </div>
        <form class="login-form" method="POST" action="login.php">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="E-mail" required>
            
            <label for="password">Senha</label>
            <input type="password" id="password" name="password" placeholder="Senha" required>
            
            <div class="button-group">
                <button type="submit" class="login-btn">Entrar</button>
                <button type="button" class="register-btn">Criar Conta</button>
            </div>
            
            <a href="#" class="forgot-password">Esqueceu a senha?</a>
            <?php if (isset($erro)) { echo "<p style='color:red;'>$erro</p>"; } ?>
        </form>
    </div>
</body>
</html>
