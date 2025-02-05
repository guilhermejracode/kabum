<?php

class ClienteService {
    private $clienteModel;

    public function __construct() {
        $this->clienteModel = new ClienteModel();
    }

    public function listar() {
        $clienteModel = new ClienteModel();
        return $clienteModel->buscarTodos();
    }

    public function cadastrar(array $dados) {
        $enderecos = $dados['enderecos']; // Array de endereços
        unset($dados['enderecos']);

        // Regras de validação antes de salvar
        if (empty($dados['nome'])) {
            throw new Exception("O nome do cliente é obrigatório!");
        }

        if ($this->clienteModel->existeCPF($dados['cpf'])) {
            throw new Exception("CPF já cadastrado! Verifique e tente novamente.");
        }

        $dados['usuario_id'] = $_SESSION['usuario_id'];
        $clienteId = $this->clienteModel->cadastrarCliente($dados);

        if ($clienteId) {
            foreach ($enderecos as $endereco) {
                if(!empty($endereco['logradouro'])){
                    $this->clienteModel->cadastrarEndereco($endereco, $clienteId);
                }
            }
        }
        else{
            throw new Exception("Não foi possível inserir o cliente!");
        }
    }

    public function buscarPorId(int $id) {
        $resultado = $this->clienteModel->buscarPorId($id);
        if (!$resultado) {
            throw new Exception("Cliente não encontrado!");
        }
        return $resultado;
    }

    public function buscarEnderecoPorCliente(int $clienteId) {
        return $this->clienteModel->buscarEnderecoPorCliente($clienteId);
    }

    public function editar(int $clienteId, array $dados) {
        if (!$this->clienteModel->buscarPorId($clienteId)) {
            throw new Exception("Cliente não encontrado!");
        }

        $enderecos = $dados['enderecos']; // Array de endereços
        unset($dados['enderecos']);

        $clienteAtualizado = $this->clienteModel->atualizarCliente($clienteId, $dados);

        if ($clienteAtualizado) {
            // Remove os endereços antigos
            $this->clienteModel->removerEnderecosPorCliente($clienteId);

            // Adiciona os novos endereços
            foreach ($enderecos as $endereco) {
                if(!empty($endereco['logradouro'])) {
                    $this->clienteModel->cadastrarEndereco($endereco, $clienteId);
                }
            }
        } else {
            throw new Exception("Erro ao editar cliente! Verifique e tente novamente.");
        }

    }

    public function deletar(int $id) {
        if(!$this->clienteModel->excluir($id)) {
            throw new Exception("Não foi possivel excluir o cliente! Verifique e tente novametne.");
        }
    }
}
