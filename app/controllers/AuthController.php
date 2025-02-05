<?php

class AuthController {

    private $usuarioService;

    public function __construct() {
        $this->usuarioService = new UsuarioService();
    }

    public function login() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $dados = $_POST;
                $this->usuarioService->autenticar($dados);
                header('Location: '.UrlHelper::baseURL().'/home');
            } catch (Exception $e) {
                $_SESSION['msg_login'] = $e->getMessage();
                header('Location: '.UrlHelper::baseURL().'/login');
            }
        }
        else{
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
