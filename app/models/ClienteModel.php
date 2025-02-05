<?php

class ClienteModel {

    private $pdo;

    public function __construct() {
        $database = new Database(); // Instancia a classe Database
        $this->pdo = $database->getConnection(); // Obtém a conexão do banco de dados
    }

    public function buscarTodos() {
        $stmt = $this->pdo->prepare('SELECT * FROM clientes');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id) {
        $stmt = $this->pdo->prepare('SELECT * FROM clientes WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function buscarEnderecoPorCliente($clienteId) {
        $stmt = $this->pdo->prepare('SELECT * FROM enderecos WHERE cliente_id = :cliente_id');
        $stmt->execute(['cliente_id' => $clienteId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Cadastra um cliente no banco de dados
     */
    public function cadastrarCliente($nome, $dataNascimento, $cpf, $rg, $telefone, $usuario_id) {
        try {
            $stmt = $this->pdo->prepare("
                INSERT INTO clientes (nome, data_nascimento, cpf, rg, telefone, usuario_id) 
                VALUES (:nome, :data_nascimento, :cpf, :rg, :telefone, :usuario_id)
            ");
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':data_nascimento', $dataNascimento);
            $stmt->bindParam(':cpf', $cpf);
            $stmt->bindParam(':rg', $rg);
            $stmt->bindParam(':telefone', $telefone);
            $stmt->bindParam(':usuario_id', $usuario_id);
            $stmt->execute();

            return $this->pdo->lastInsertId(); // Retorna o ID do cliente cadastrado
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Cadastra um endereço vinculado a um cliente
     */
    public function cadastrarEndereco($clienteId, $logradouro, $numero, $bairro, $cidade, $estado, $cep) {
        try {
            $stmt = $this->pdo->prepare("
                INSERT INTO enderecos (cliente_id, logradouro, numero, bairro, cidade, estado, cep) 
                VALUES (:cliente_id, :logradouro, :numero, :bairro, :cidade, :estado, :cep)
            ");
            $stmt->bindParam(':cliente_id', $clienteId);
            $stmt->bindParam(':logradouro', $logradouro);
            $stmt->bindParam(':numero', $numero);
            $stmt->bindParam(':bairro', $bairro);
            $stmt->bindParam(':cidade', $cidade);
            $stmt->bindParam(':estado', $estado);
            $stmt->bindParam(':cep', $cep);
            return $stmt->execute();
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Atualiza um cliente no banco de dados
     */
    public function atualizarCliente($clienteId, $nome, $dataNascimento, $cpf, $rg, $telefone) {
        try {
            $stmt = $this->pdo->prepare("
                UPDATE clientes 
                SET nome = :nome, data_nascimento = :data_nascimento, cpf = :cpf, 
                    rg = :rg, telefone = :telefone 
                WHERE id = :cliente_id
            ");
            $stmt->bindParam(':cliente_id', $clienteId);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':data_nascimento', $dataNascimento);
            $stmt->bindParam(':cpf', $cpf);
            $stmt->bindParam(':rg', $rg);
            $stmt->bindParam(':telefone', $telefone);
            return $stmt->execute();
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Remove todos os endereços de um cliente antes da atualização
     */
    public function removerEnderecosPorCliente($clienteId) {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM enderecos WHERE cliente_id = :cliente_id");
            $stmt->bindParam(':cliente_id', $clienteId);
            return $stmt->execute();
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Exclui os endereços e o cliente pelo id
     */
    public function excluir($id) {
        try {
            // Inicia uma transação para garantir consistência dos dados
            $this->pdo->beginTransaction();

            // Excluir endereços do cliente
            $stmt = $this->pdo->prepare('DELETE FROM enderecos WHERE cliente_id = :cliente_id');
            $stmt->execute(['cliente_id' => $id]);

            // Excluir o cliente
            $stmt = $this->pdo->prepare('DELETE FROM clientes WHERE id = :id');
            $stmt->execute(['id' => $id]);

            // Confirma a transação
            $this->pdo->commit();

            return true; // Retorna sucesso
        } catch (Exception $e) {
            // Se houver erro, reverte a transação
            $this->pdo->rollBack();

            // Opcional: Log do erro para depuração
            error_log("Erro ao excluir cliente: " . $e->getMessage());

            return false; // Retorna falha
        }
    }
}
