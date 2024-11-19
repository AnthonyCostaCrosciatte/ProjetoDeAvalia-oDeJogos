<?php

$host = "localhost";
$db = "aulasphp";
$usuario = "root";
$senha = "";
$port = "3306";

try{
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$db", $usuario, $senha);
    if ($pdo){
        echo "Conexão realizada com sucesso!";
    } else {
        echo "Erro ao conectar o banco de dados!";
    }
} catch (Exception $e){
    echo "Erro: ".$e->getMessage();
}

class Classe {
    public function acao() {
        echo "Método acao() chamado!";
    }
}

$c = new Classe();
$c->acao();