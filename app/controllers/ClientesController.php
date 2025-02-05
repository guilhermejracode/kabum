<?php

class ClientesController{

    private $clienteService;

    public function __construct() {
        $this->clienteService = new ClienteService();
    }

    public function index() {
        $this->listar();
    }

    public function cadastrar() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $dados = $_POST;
                $this->clienteService->cadastrar($dados);
                $_SESSION['sucesso_cadastro'] = "Cliente cadastrado com sucesso!";
                header('Location: '.UrlHelper::baseURL().'/clientes/listar');
            } catch (Exception $e) {
                $_SESSION['erro_cadastro'] = $e->getMessage();
            }
        }

        $data['titulo'] = 'Cadastrar cliente';
        View::render('clientes/core', $data);

    }

    public function listar() {
        $clientes = $this->clienteService->listar();

        $data['titulo'] = 'Lista de clientes';
        $data['clientes'] = $clientes;

        View::render('clientes/listar', $data);
    }

    public function editar($clienteId) {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $dados = $_POST;
                $this->clienteService->editar($clienteId, $dados);
                $_SESSION['sucesso_cadastro'] = "Cliente atualizado!";
            } catch (Exception $e) {
                $_SESSION['erro_cadastro'] = $e->getMessage();
            }
            header('Location: '.UrlHelper::baseURL().'/clientes');
        } else {
            try {
                $data['titulo'] = 'Editar Cliente';
                $data['cliente'] = $this->clienteService->buscarPorId($clienteId);
                $data['enderecos'] = $this->clienteService->buscarEnderecoPorCliente($clienteId);

                View::render('clientes/core', $data);
            } catch (Exception $e) {
                $_SESSION['erro_cadastro'] = $e->getMessage();
                header('Location: '.UrlHelper::baseURL().'/clientes');
            }
        }
    }

    public function excluir($clienteId) {
        try {
            $this->clienteService->deletar($clienteId);
            $_SESSION['sucesso_cadastro'] = "Cliente excluido com sucesso!";
        } catch (Exception $e) {
            $_SESSION['erro_cadastro'] = $e->getMessage();
        }

        header('Location: '.UrlHelper::baseURL().'/clientes/listar');
    }
}
