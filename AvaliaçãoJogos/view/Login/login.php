<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Login</title>
    <link rel="stylesheet" href="Login.css">
</head>
<body>
    <div class="login-container">
        <div class="profile-icon">
            <img src="images-removebg-preview.png" alt="Ícone do perfil">
        </div>
        <form class="login-form">
            <label for="email">Email</label>
            <input type="email" id="email" placeholder="E-mail" required>
            
            <label for="password">Senha</label>
            <input type="password" id="password" placeholder="Senha" required>
            
            <div class="button-group">
                <button type="submit" class="login-btn">Entrar</button>
                <button type="button" class="register-btn">Criar Conta</button>
            </div>
            
            <a href="#" class="forgot-password">Esqueceu a senha?</a>
        </form>
    </div>
</body>
</html>