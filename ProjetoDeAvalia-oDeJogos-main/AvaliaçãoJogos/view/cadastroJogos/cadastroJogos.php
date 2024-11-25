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

// Diretório para salvar as imagens
$upload_dir = __DIR__ . '/uploads/jogos/';

// Verifique se o diretório existe, caso contrário, crie
if (!is_dir($upload_dir)) {
  if (!mkdir($upload_dir, 0777, true)) {
    die('Erro ao criar o diretório de uploads');
  }
}

// Função para fazer o upload da imagem do jogo
function fazerUploadImagemJogo($arquivo, $upload_dir)
{
  // Verifica se o arquivo foi enviado corretamente
  if ($arquivo['error'] === UPLOAD_ERR_OK) {
    // Obtém a extensão do arquivo
    $extensao = strtolower(pathinfo($arquivo['name'], PATHINFO_EXTENSION));

    // Verifica se a extensão é permitida
    $permitidas = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($extensao, $permitidas)) {
      return "Somente imagens JPG, JPEG, PNG e GIF são permitidas.";
    }

    // Gera um nome único para o arquivo
    $novoNome = uniqid() . '.' . $extensao;

    // Caminho completo do arquivo no servidor
    $caminhoCompleto = $upload_dir . $novoNome;

    // Move o arquivo para o diretório de uploads
    if (move_uploaded_file($arquivo['tmp_name'], $caminhoCompleto)) {
      // Retorna apenas o nome do arquivo para ser salvo no banco
      return $novoNome;
    } else {
      return "Erro ao mover o arquivo.";
    }
  } else {
    return "Erro no envio do arquivo.";
  }
}

// Verifica se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Obtém os dados do formulário com verificação de existência
  $nome = $_POST['nome'] ?? '';  // Usando o operador de coalescência nula para garantir que o valor seja vazio se não existir
  $data_lancamento = $_POST['data_lancamento'] ?? '';  // Verifica se a chave existe em $_POST, senão usa um valor padrão vazio
  $plataformas = $_POST['plataformas'] ?? '';  // Mesma lógica para outras variáveis
  $genero = $_POST['genero'] ?? '';
  $modos = $_POST['modos'] ?? '';
  $caracteristicas = $_POST['caracteristicas'] ?? '';
  $temas = $_POST['temas'] ?? '';
  $desenvolvedora = $_POST['desenvolvedora'] ?? '';
  $publicadora = $_POST['publicadora'] ?? '';
  $franquia = $_POST['franquia'] ?? '';
  $sinopse = $_POST['sinopse'] ?? '';

  // Verificar se uma imagem do jogo foi enviada
  $caminhoImagem = "";
  if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
    $caminhoImagem = fazerUploadImagemJogo($_FILES['imagem'], $upload_dir);
    if (strpos($caminhoImagem, 'Erro') !== false) {
      // Se houver erro no upload da imagem, podemos mostrar a mensagem de erro
      echo $caminhoImagem;
      exit;
    }
  }

  // Inserir os dados no banco de dados
  // Prepara a consulta SQL
  $sql = "INSERT INTO jogos (nome, desenvolvedor, data_lancamento, descricao, classificacao_etaria, imagem_url) 
       VALUES (:nome, :desenvolvedor, :data_lancamento, :descricao, :classificacao_etaria, :imagem_url)";

  $stmt = $pdo->prepare($sql);

  // Vincula os parâmetros corretamente
  $stmt->bindParam(':nome', $nome);
  $stmt->bindParam(':desenvolvedor', $desenvolvedora);
  $stmt->bindParam(':data_lancamento', $data_lancamento);
  $stmt->bindParam(':descricao', $sinopse);  // A coluna "descricao" no banco recebe o valor da variável sinopse
  $stmt->bindParam(':classificacao_etaria', $plataformas);  // Ajuste conforme seu modelo de dados
  $stmt->bindParam(':imagem_url', $caminhoImagem);  // A variável $imagem_url

  // Executa a consulta
  if ($stmt->execute()) {
    echo "Jogo cadastrado com sucesso!";
  } else {
    echo "Erro ao cadastrar o jogo.";
  }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro de Jogos</title>
  <link rel="stylesheet" href="cadastroJogos.css">
</head>

<body>
  <header>
    <div class="logo">
      <img src="img/shape.png" alt="Logo">
    </div>

    <div class="icons">
      <button><img src="img/Icon.png" alt="Ícone" style="width: 20px; height: 20px;"></button>
      <button><img src="img/Avatar.png" alt="Avatar" style="width: 25px; height: 25px;"></button>
    </div>
  </header>
  <br>
  <nav>
    <a href="index.php">Início</a>
    <a href="./view/ranking/ranking.php">Ranking</a>
    <a href="./view/cadastroJogos/cadastroJogos.php">Cadastrar Jogos</a>
  </nav>

  <div class="container">
    <form action="cadastroJogos.php" method="POST" enctype="multipart/form-data">
      <div class="upload-section">
        <div class="upload-frame">
          <img src="img/Frame.png" alt="Ícone de upload" class="upload-icon">
        </div>
        <label for="imagem" class="btn-upload">Carregar imagem do jogo</label>
        <input type="file" id="imagem" name="imagem" accept="image/*" style="display: none;" required>
      </div>
      <div class="inputs">
        <div class="input-group">
          <label for="nome">Lançamento</label>
          <input type="text" id="nome" name="nome" placeholder="Digite o lançamento" required>
        </div>

        <div class="input-group">
          <label for="plataformas">Plataformas</label>
          <input type="text" id="plataformas" name="plataformas" placeholder="Digite as plataformas" required>
        </div>

        <div class="input-group">
          <label for="genero">Gênero</label>
          <input type="text" id="genero" name="genero" placeholder="Digite o gênero" required>
        </div>

        <div class="input-group">
          <label for="modos">Modos de Jogo</label>
          <input type="text" id="modos" name="modos" placeholder="Digite os modos de jogo" required>
        </div>

        <div class="input-group">
          <label for="caracteristicas">Características</label>
          <input type="text" id="caracteristicas" name="caracteristicas" placeholder="Digite as características" required>
        </div>

        <div class="input-group">
          <label for="temas">Temas</label>
          <input type="text" id="temas" name="temas" placeholder="Digite os temas" required>
        </div>

        <div class="input-group">
          <label for="desenvolvedora">Desenvolvedora</label>
          <input type="text" id="desenvolvedora" name="desenvolvedora" placeholder="Digite a desenvolvedora" required>
        </div>

        <div class="input-group">
          <label for="publicadora">Publicadora</label>
          <input type="text" id="publicadora" name="publicadora" placeholder="Digite a publicadora" required>
        </div>

        <div class="input-group">
          <label for="franquia">Franquia</label>
          <input type="text" id="franquia" name="franquia" placeholder="Digite a franquia" required>
        </div>

        <div class="input-group">
          <label for="sinopse">Sinopse</label>
          <textarea id="sinopse" name="sinopse" placeholder="Digite a sinopse" required></textarea>
        </div>
      </div>

      <button type="submit" class="btn-enviar">Enviar</button>
    </form>
  </div>
</body>

</html>