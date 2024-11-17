<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Jogo</title>
    <style>
        body {
            background-color: black;
            color: #00FF00;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            width: 50px;
        }
        .menu {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        .menu a {
            color: #00FF00;
            text-decoration: none;
            margin: 0 10px;
            padding: 5px 10px;
        }
        .menu a:hover {
            background-color: #00FF00;
            color: black;
        }
        .image {
            text-align: center;
            margin-bottom: 20px;
        }
        .details, .synopsis {
            margin-bottom: 20px;
        }
        .comment-section {
            margin-top: 20px;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            background-color: #333;
            color: #00FF00;
            border: 1px solid #00FF00;
        }
        input[type="submit"] {
            padding: 10px 20px;
            background-color: #00FF00;
            color: black;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: black;
            color: #00FF00;
            border: 1px solid #00FF00;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="logo.png" alt="Logo">
            <h1>Game Database</h1>
        </div>
        <div class="menu">
            <a href="#">Início</a>
            <a href="#">Ranking</a>
            <a href="#">Cadastrar Jogos</a>
        </div>
        <div class="image">
            <img src="godofwar.jpg" alt="God of War" style="max-width:100%;">
        </div>
        <div class="details">
            <p><strong>Nome:</strong> God of War II</p>
            <p><strong>Lançamento:</strong> 13/03/2007</p>
            <p><strong>Plataformas:</strong> PlayStation 2, PlayStation 3, PlayStation Vita</p>
            <p><strong>Gênero:</strong> Ação e Aventura</p>
            <p><strong>Modo de Jogo:</strong> Um jogador</p>
            <p><strong>Características:</strong> Mitologia Grega</p>
            <p><strong>Desenvolvedora:</strong> SIE Santa Monica Studio</p>
            <p><strong>Publicadora:</strong> Sony Interactive Entertainment</p>
            <p><strong>Franquia:</strong> God of War</p>
        </div>
        <div class="synopsis">
            <h3>Sinopse</h3>
            <p>Ao derrotar Ares, Kratos, o antigo guerreiro mortal, torna-se o novo Deus da Guerra. Porém, Kratos logo se vê sozinho no Olimpo...</p>
        </div>
        <div class="comment-section">
            <h3>Comentar</h3>
            <form method="POST" action="">
                <input type="text" name="comment" placeholder="Deixe um comentário...">
                <input type="submit" value="Enviar">
            </form>
        </div>
    </div>
</body>
</html>
