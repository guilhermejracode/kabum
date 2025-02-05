<?php

class UsuarioService {
    private $usuarioModel;

    public function __construct() {
        $this->usuarioModel = new UsuarioModel();
    }

    public function autenticar($dados) {
        $usuario = $this->usuarioModel->buscaUsuario($dados['nome_usuario']);

        if (!$usuario || !password_verify($dados['senha'], $usuario['senha'])) {
            throw new Exception("Usuário ou senha inválidos!");
        }

        session_start();
        $_SESSION['usuario_id'] = $usuario['id'];  // ID do usuário
        $_SESSION['usuario_nome'] = $usuario['nome_usuario'];
        return true;
    }

}
