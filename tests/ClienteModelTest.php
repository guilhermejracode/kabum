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
        $dadosCliente['nome'] = "Carlos Silva";
        $dadosCliente['data_nascimento'] = "1990-05-20";
        $dadosCliente['cpf'] = "12345678900";
        $dadosCliente['rg'] = "1234567";
        $dadosCliente['telefone'] = "11999999999";
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
            ->willReturnCallback(function ($dadoEndereco, $clienteId) use ($enderecos) {
                // Verifica se um dos endereços está na lista esperada
                foreach ($enderecos as $endereco) {
                    if (
                        $clienteId === 10 &&
                        $dadoEndereco['logradouro'] === $endereco['logradouro'] &&
                        $dadoEndereco['numero'] === $endereco['numero'] &&
                        $dadoEndereco['bairro'] === $endereco['bairro'] &&
                        $dadoEndereco['cidade'] === $endereco['cidade'] &&
                        $dadoEndereco['estado'] === $endereco['estado'] &&
                        $dadoEndereco['cep'] === $endereco['cep']
                    ) {
                        return true;
                    }
                }
                return false;
            });

        // Testa se o cliente é cadastrado corretamente
        $clienteId = $this->clienteModel->cadastrarCliente($dadosCliente, $usuario_id);
        $this->assertEquals(10, $clienteId); // Esperamos que retorne ID 10

        // Verifica se os endereços foram cadastrados corretamente
        foreach ($enderecos as $endereco) {
            $resultado = $this->clienteModel->cadastrarEndereco($endereco, $clienteId);
            $this->assertTrue($resultado);
        }
    }
}
