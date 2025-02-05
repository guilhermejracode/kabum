<?php
require_once 'app/models/UsuarioModel.php';

class AuthController {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome_usuario = $_POST['nome_usuario'];
            $senha = $_POST['senha'];

            $usuarioModel = new UsuarioModel();
            $usuarioData = $usuarioModel->buscaUsuario($nome_usuario);

            if ($usuarioData && password_verify($senha, $usuarioData['senha'])) {
                session_start();
                $_SESSION['usuario_id'] = $usuarioData['id'];  // ID do usuário
                $_SESSION['usuario_nome'] = $usuarioData['nome_usuario'];
                header('Location: '.UrlHelper::baseURL().'/home');

            } else {
                $_SESSION['msg_login'] = "Usuário ou Senha inválido!";
                header('Location: '.UrlHelper::baseURL().'/login');
            }

        } else {
            $data = ['titulo' => 'Login'];
            View::render('auth/login', $data, 'layouts/login');
        }
    }

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header('Location: '.UrlHelper::baseURL().'/login');
    }
}
