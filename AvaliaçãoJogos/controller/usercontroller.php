<?php
class UserController {
    private $conn;

    // Construtor para estabelecer a conexão com o banco
    public function __construct() {
        $this->conn = new mysqli('localhost', 'root', '', 'avaliacaojogosbd');
        if ($this->conn->connect_error) {
            die("Erro na conexão com o banco de dados: " . $this->conn->connect_error);
        }
    }

    // Método para visualizar jogos
    public function visualizarJogos() {
        $sql = "SELECT * FROM jogos";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<h1>Lista de Jogos</h1>";
            echo "<table border='1'>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Gênero</th>
                        <th>Pontuação</th>
                    </tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['nome']}</td>
                        <td>{$row['genero']}</td>
                        <td>{$row['pontuacao']}</td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "<p>Nenhum jogo encontrado.</p>";
        }
    }

    // Método para exibir o ranking de jogos
    public function rankingJogos() {
        $sql = "SELECT * FROM jogos ORDER BY pontuacao DESC";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<h1>Ranking de Jogos</h1>";
            echo "<ol>";
            while ($row = $result->fetch_assoc()) {
                echo "<li>{$row['nome']} - {$row['pontuacao']} pontos</li>";
            }
            echo "</ol>";
        } else {
            echo "<p>Nenhum jogo encontrado para o ranking.</p>";
        }
    }

    // Fechar a conexão ao destruir a classe
    public function __destruct() {
        $this->conn->close();
    }
}

// Exemplo de uso
$controller = new UserController();

// Verifica a ação a ser executada (URL com ?acao=...)
if (isset($_GET['acao'])) {
    $acao = $_GET['acao'];
    if ($acao == 'visualizar') {
        $controller->visualizarJogos();
    } elseif ($acao == 'ranking') {
        $controller->rankingJogos();
    } else {
        echo "<p>Ação inválida.</p>";
    }
} else {
    echo "<p>Nenhuma ação foi definida.</p>";
}
?>

