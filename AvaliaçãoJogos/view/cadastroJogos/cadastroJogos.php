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
        <img src="./view/cadastroJogos/img/shape.png" alt="">
    </div>
    
    <div class="icons">
      <button><img src="./view/cadastroJogos/img/Icon.png" alt="" style="width: 20px; height: 20px;"></button>
      <button><img src="./view/cadastroJogos/img/Avatar.png" alt="" style="width: 25px; height: 25px;"></button>
    </div>
  </header>
  <br>
  <nav>
      <a href="index.php">Início</a>
      <a href="./view/ranking/ranking.php">Ranking</a>
      <a href="./view/cadastroJogos/cadastroJogos.php">Cadastrar Jogos</a>
    </nav>

  <div class="container">
    <form class="form-jogo">
      <div class="upload-section">
        <div class="upload-frame">
            <img src="./view/cadastroJogos/img/Frame.png" alt="" class="upload-icon">
        </div>
        <button type="button" class="btn-upload">Carregar imagem do jogo</button>
      </div>
      <div class="inputs">
        <div class="input-group">
          <label for="lancamento">Lançamento</label>
          <input type="text" id="lancamento" placeholder="Digite o lançamento">
        </div>

        <div class="input-group">
          <label for="plataformas">Plataformas</label>
          <input type="text" id="plataformas" placeholder="Digite as plataformas">
        </div>

        <div class="input-group">
          <label for="genero">Gênero</label>
          <input type="text" id="genero" placeholder="Digite o gênero">
        </div>

        <div class="input-group">
          <label for="modos">Modos de Jogo</label>
          <input type="text" id="modos" placeholder="Digite os modos de jogo">
        </div>

        <div class="input-group">
          <label for="caracteristicas">Características</label>
          <input type="text" id="caracteristicas" placeholder="Digite as características">
        </div>

        <div class="input-group">
          <label for="temas">Temas</label>
          <input type="text" id="temas" placeholder="Digite os temas">
        </div>

        <div class="input-group">
          <label for="desenvolvedora">Desenvolvedora</label>
          <input type="text" id="desenvolvedora" placeholder="Digite a desenvolvedora">
        </div>

        <div class="input-group">
          <label for="publicadora">Publicadora</label>
          <input type="text" id="publicadora" placeholder="Digite a publicadora">
        </div>

        <div class="input-group">
          <label for="franquia">Franquia</label>
          <input type="text" id="franquia" placeholder="Digite a franquia">
        </div>

        <div class="input-group">
          <label for="sinopse">Sinopse</label>
          <textarea id="sinopse" placeholder="Digite a sinopse"></textarea>
        </div>
      </div>

      <button type="submit" class="btn-enviar">Enviar</button>
    </form>
  </div>
</body>
</html>
