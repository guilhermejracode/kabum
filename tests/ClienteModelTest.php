<?php

use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../app/config/Database.php';
require_once __DIR__ . '/../app/models/ClienteModel.php';

class ClienteModelTest extends TestCase {
    private $clienteModel;

    protected function setUp(): void {
        $this->clienteModel = $this->getMockBuilder(ClienteModel::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['cadastrarCliente', 'cadastrarEndereco'])
            ->getMock();
    }

    public function testCadastrarClienteEEndereco() {
        // Simulação de dados do cliente
        $nome = "Carlos Silva";
        $dataNascimento = "1990-05-20";
        $cpf = "12345678900";
        $rg = "1234567";
        $telefone = "11999999999";
        $usuario_id = 1;

        // Simulação de endereços
        $enderecos = [
            ['logradouro' => 'Rua A', 'numero' => '123', 'bairro' => 'Centro', 'cidade' => 'São Paulo', 'estado' => 'SP', 'cep' => '01000-000'],
            ['logradouro' => 'Rua B', 'numero' => '456', 'bairro' => 'Jardins', 'cidade' => 'Rio de Janeiro', 'estado' => 'RJ', 'cep' => '22000-000']
        ];

        // Simula o ID retornado pelo método cadastrarCliente
        $this->clienteModel->method('cadastrarCliente')->willReturn(10);

        // Cria um contador para verificar quantas vezes cadastrarEndereco foi chamado corretamente
        $this->clienteModel->expects($this->exactly(2)) // Precisamos de 2 chamadas
        ->method('cadastrarEndereco')
            ->willReturnCallback(function ($clienteId, $logradouro, $numero, $bairro, $cidade, $estado, $cep) use ($enderecos) {
                // Verifica se um dos endereços está na lista esperada
                foreach ($enderecos as $endereco) {
                    if (
                        $clienteId === 10 &&
                        $logradouro === $endereco['logradouro'] &&
                        $numero === $endereco['numero'] &&
                        $bairro === $endereco['bairro'] &&
                        $cidade === $endereco['cidade'] &&
                        $estado === $endereco['estado'] &&
                        $cep === $endereco['cep']
                    ) {
                        return true;
                    }
                }
                return false;
            });

        // Testa se o cliente é cadastrado corretamente
        $clienteId = $this->clienteModel->cadastrarCliente($nome, $dataNascimento, $cpf, $rg, $telefone, $usuario_id);
        $this->assertEquals(10, $clienteId); // Esperamos que retorne ID 10

        // Verifica se os endereços foram cadastrados corretamente
        foreach ($enderecos as $endereco) {
            $resultado = $this->clienteModel->cadastrarEndereco($clienteId, $endereco['logradouro'], $endereco['numero'], $endereco['bairro'], $endereco['cidade'], $endereco['estado'], $endereco['cep']);
            $this->assertTrue($resultado);
        }
    }
}
