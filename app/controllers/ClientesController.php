<?php
require_once 'app/models/ClienteModel.php';

class ClientesController {
    public function listar() {
        $clienteModel = new ClienteModel();
        $clientes = $clienteModel->buscarTodos();

        $data['titulo'] = 'Lista de clientes';
        $data['clientes'] = $clientes;

        View::render('clientes/listar', $data);
    }

    public function cadastrar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Captura os dados do formulário
            $nome = $_POST['nome'];
            $dataNascimento = $_POST['data_nascimento'];
            $cpf = $_POST['cpf'];
            $rg = $_POST['rg'];
            $telefone = $_POST['telefone'];
            $enderecos = $_POST['enderecos']; // Array de endereços
            $usuario_id = $_SESSION['usuario_id'];

            // Instancia a classe ClienteModel para salvar no banco
            $clienteModel = new ClienteModel();
            $clienteId = $clienteModel->cadastrarCliente($nome, $dataNascimento, $cpf, $rg, $telefone, $usuario_id);

            if ($clienteId) {
                foreach ($enderecos as $endereco) {
                    if(!empty($endereco['logradouro'])){
                        $clienteModel->cadastrarEndereco(
                            $clienteId,
                            $endereco['logradouro'],
                            $endereco['numero'],
                            $endereco['bairro'],
                            $endereco['cidade'],
                            $endereco['estado'],
                            $endereco['cep']
                        );
                    }

                }

                // Redireciona para a listagem de clientes
                $_SESSION['sucesso_cadastro'] = "Cadastro realizado com sucesso!";
                header('Location: '.UrlHelper::baseURL().'/clientes/listar');
            } else {
                $_SESSION['erro_cadastro'] = "Erro ao cadastrar cliente.";
                header('Location: '.UrlHelper::baseURL().'/clientes/listar');
            }
        } else {
            $data['titulo'] = 'Cadastrar cliente';

            View::render('clientes/core', $data);
        }
    }

    public function editar($clienteId) {
        $clienteModel = new ClienteModel();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Captura os dados do formulário
            $nome = $_POST['nome'];
            $dataNascimento = $_POST['data_nascimento'];
            $cpf = $_POST['cpf'];
            $rg = $_POST['rg'];
            $telefone = $_POST['telefone'];
            $enderecos = $_POST['enderecos']; // Array de endereços

            // Atualiza os dados do cliente
            $clienteAtualizado = $clienteModel->atualizarCliente($clienteId, $nome, $dataNascimento, $cpf, $rg, $telefone);

            if ($clienteAtualizado) {
                // Remove os endereços antigos
                $clienteModel->removerEnderecosPorCliente($clienteId);

                // Adiciona os novos endereços
                foreach ($enderecos as $endereco) {
                    if(!empty($endereco['logradouro'])) {
                        $clienteModel->cadastrarEndereco(
                            $clienteId,
                            $endereco['logradouro'],
                            $endereco['numero'],
                            $endereco['bairro'],
                            $endereco['cidade'],
                            $endereco['estado'],
                            $endereco['cep']
                        );
                    }
                }

                // Redireciona para a listagem de clientes
                $_SESSION['sucesso_cadastro'] = "Cliente atualizado com sucesso!";
                header('Location: '.UrlHelper::baseURL().'/clientes/editar/'.$clienteId);
                exit();
            } else {
                $_SESSION['erro_cadastro'] = "Erro ao editar cliente.";
                header('Location: '.UrlHelper::baseURL().'/clientes/editar/'.$clienteId);
                exit();
            }
        } else {
            // Busca os dados do cliente para exibir no formulário
            $cliente = $clienteModel->buscarPorId($clienteId);
            $enderecos = $clienteModel->buscarEnderecoPorCliente($clienteId);

            $data['titulo'] = 'Editar Cliente';
            $data['cliente'] = $cliente;
            $data['enderecos'] = $enderecos;

            View::render('clientes/core', $data);
        }
    }

    public function excluir($id) {
        $clienteModel = new ClienteModel();
        if($clienteModel->excluir($id)){
            $_SESSION['sucesso_cadastro'] = "Cliente excluido com sucesso!";
            header('Location: '.UrlHelper::baseURL().'/clientes/listar');
        }
        else{
            $_SESSION['erro_cadastro'] = "Não foi possivel excluido o cliente!";
            header('Location: '.UrlHelper::baseURL().'/clientes/listar');
        }

    }
}
