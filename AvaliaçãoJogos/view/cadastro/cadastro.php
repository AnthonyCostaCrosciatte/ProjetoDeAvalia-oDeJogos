<?php
// Configurações de conexão com o banco de dados
$host = 'localhost';  // Nome do host ou IP do servidor MariaDB
$nomeBanco = 'avaliacaojogosbd';  // Nome do banco de dados
$usuarioBanco = 'root';  // Nome de usuário do banco de dados
$senhaBanco = '';  // Senha do banco de dados

try {
    // Criando a conexão com o banco de dados MariaDB usando PDO
    $pdo = new PDO("mysql:host=$host;dbname=$nomeBanco", $usuarioBanco, $senhaBanco);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  // Habilitar erros para debug
} catch (PDOException $e) {
    echo "Erro ao conectar com o banco de dados: " . $e->getMessage();
    exit;
}

// Função para fazer o upload da imagem do avatar
function fazerUploadAvatar($arquivo)
{
    // Verificar se o arquivo foi enviado corretamente
    if ($arquivo['error'] === UPLOAD_ERR_OK) {
        // Obter a extensão do arquivo
        $extensao = strtolower(pathinfo($arquivo['name'], PATHINFO_EXTENSION));

        // Definir o diretório onde as imagens serão armazenadas
        $diretorioAvatares = 'avatars/';

        // Criar o diretório se não existir
        if (!is_dir($diretorioAvatares)) {
            mkdir($diretorioAvatares, 0777, true);  // Permissões para criar a pasta
        }

        // Gerar um nome único para o arquivo
        $nomeAvatar = uniqid() . '.' . $extensao;

        // Tipos permitidos de arquivos
        $tiposPermitidos = ['jpg', 'jpeg', 'png', 'gif'];

        // Verificar se a extensão do arquivo é permitida
        if (in_array($extensao, $tiposPermitidos)) {
            // Mover o arquivo para o diretório de avatares
            if (move_uploaded_file($arquivo['tmp_name'], $diretorioAvatares . $nomeAvatar)) {
                // Retornar o caminho do arquivo no servidor
                return $diretorioAvatares . $nomeAvatar;
            } else {
                return "Erro ao mover o arquivo para o servidor.";
            }
        } else {
            return "Somente imagens JPG, JPEG, PNG e GIF são permitidas.";
        }
    } else {
        return "Erro no envio do arquivo.";
    }
}

// Verificar se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obter os dados do formulário
    $nomeUsuario = $_POST['nome'];
    $emailUsuario = $_POST['email'];
    $senhaUsuario = password_hash($_POST['senha'], PASSWORD_DEFAULT);  // Criptografar a senha
    
    // Verificar se um avatar foi enviado
    $caminhoAvatar = "";
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
        $caminhoAvatar = fazerUploadAvatar($_FILES['avatar']);
    }

    // Inserir os dados no banco de dados
    $sql = "INSERT INTO usuarios (nome_usuario, email, senha_hash, avatar) VALUES (:nome, :email, :senha, :avatar)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nome', $nomeUsuario);
    $stmt->bindParam(':email', $emailUsuario);
    $stmt->bindParam(':senha', $senhaUsuario);
    $stmt->bindParam(':avatar', $caminhoAvatar);

    // Executar a consulta
    if ($stmt->execute()) {
        echo "Usuário cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar usuário.";
    }
}
?>
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
        <form action="cadastro.php" method="POST" enctype="multipart/form-data">
            <label for="nome">Nome</label>
            <input type="text" id="nome" name="nome" placeholder="Digite seu nome" required>
            
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Digite seu email" required>
            
            <label for="senha">Senha</label>
            <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required>
            
            <button type="submit" class="cadastrar">Cadastrar</button>
        </form>
    </div>
</body>
</html>
