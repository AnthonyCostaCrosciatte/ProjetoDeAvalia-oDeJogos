<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="cadastro.css">
</head>
<body>
    <div class="container">
        <div class="avatar">
            <img src="images-removebg-preview.png" alt="Avatar" class="avatar-image">
            <label class="carregar" for="avatar">Carregar avatar</label>
            <input type="file" id="avatar" name="avatar" accept="image/*" style="display: none;" required>
        </div>
        <form action="" method="POST">
            <label for="name">Nome</label>
            <input type="text" id="name" name="name" placeholder="Digite seu nome" required>
            
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Digite seu email" required>
            
            <label for="password">Senha</label>
            <input type="password" id="password" name="password" placeholder="Digite sua senha" required>
            
            <button type="submit" class="cadastrar">Cadastrar</button>
        </form>
    </div>
</body>
</html>
