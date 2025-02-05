<?php

class UsuarioModel {
    private $pdo;

    public function __construct() {
        $database = new Database(); // Instancia a classe Database
        $this->pdo = $database->getConnection(); // Obtém a conexão do banco de dados
    }

    public function buscaUsuario($nome_usuario) {
        $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE nome_usuario = :nome_usuario");
        $stmt->bindParam(':nome_usuario', $nome_usuario);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
