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

        if (empty($dados['enderecos'])) {
            throw new Exception("Pelo menos um endereço deve ser informado!");
        }

        $enderecos = $dados['enderecos'];
        unset($dados['enderecos']);

        $validacaoCliente = '';
        if (empty($dados['nome'])) {
            $validacaoCliente .="O nome do cliente é obrigatório!<br/>";
        }
        if (empty($dados['data_nascimento'])) {
            $validacaoCliente .="O nome do cliente é obrigatório!<br/>";
        }
        if (empty($dados['cpf'])) {
            $validacaoCliente .="O CPF do cliente é obrigatório!<br/>";
        }
        if ($this->clienteModel->existeCPF($dados['cpf'])) {
            $validacaoCliente .="CPF já cadastrado! Verifique e tente novamente.<br/>";
        }

        if (!empty($validacaoCliente)) {
            throw new Exception($validacaoCliente);
        }

        try {

            $this->clienteModel->beginTransaction();

            $dados['usuario_id'] = $_SESSION['usuario_id'];
            $clienteId = $this->clienteModel->cadastrarCliente($dados);

            if ($clienteId) {
                foreach ($enderecos as $endereco) {
                    if(!empty($endereco['logradouro']) && !empty($endereco['numero']) && !empty($endereco['bairro'])
                    && !empty($endereco['cidade']) && !empty($endereco['estado']) && !empty($endereco['cep'])){
                        $this->clienteModel->cadastrarEndereco($endereco, $clienteId);
                    }
                    else{
                        throw new Exception("Todos os dados do endereço devem ser preenchidos!");
                    }
                }

                $this->clienteModel->commit();
            }
            else {
                throw new Exception("Não foi possível inserir o cliente!");
            }

        } catch (Exception $e) {
            $this->clienteModel->rollback();
            throw $e;
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

        if (empty($dados['enderecos'])) {
            throw new Exception("Pelo menos um endereço deve ser informado!");
        }

        $enderecos = $dados['enderecos'];
        unset($dados['enderecos']);

        $clienteAtualizado = $this->clienteModel->atualizarCliente($clienteId, $dados);

        try {
            if ($clienteAtualizado) {

                $this->clienteModel->beginTransaction();

                $this->clienteModel->removerEnderecosPorCliente($clienteId);

                foreach ($enderecos as $endereco) {
                    if (!empty($endereco['logradouro']) && !empty($endereco['numero']) && !empty($endereco['bairro'])
                        && !empty($endereco['cidade']) && !empty($endereco['estado']) && !empty($endereco['cep'])) {
                        $this->clienteModel->cadastrarEndereco($endereco, $clienteId);
                    }
                    else {
                        throw new Exception("Todos os dados do endereço devem ser preenchidos!");
                    }
                }

                $this->clienteModel->commit();

            }
            else {
                throw new Exception("Erro ao editar cliente! Verifique e tente novamente.");
            }
        }
        catch (Exception $e) {
            $this->clienteModel->rollback();
            throw $e;
        }

    }

    public function deletar(int $id) {
        if(!$this->clienteModel->excluir($id)) {
            throw new Exception("Não foi possivel excluir o cliente! Verifique e tente novametne.");
        }
    }
}
