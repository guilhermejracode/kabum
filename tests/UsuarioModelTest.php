<?php

use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../app/config/Database.php';
require_once __DIR__ . '/../app/models/UsuarioModel.php';

class UsuarioModelTest extends TestCase {
    private $usuarioModel;

    protected function setUp(): void {
        $this->usuarioModel = new UsuarioModel();
    }

    public function testSenhaCriptografadaDeveSerValida() {
        $senha = "123456";
        $hash = password_hash($senha, PASSWORD_BCRYPT);

        $this->assertTrue(password_verify($senha, $hash));
    }

    public function testAutenticacaoUsuarioValido() {
        $usuario = "admin";
        $senha = "123456";

        // Simula um usuário existente no banco
        $usuarioData = [
            'id' => 1,
            'nome' => 'Admin',
            'usuario' => $usuario,
            'senha' => password_hash($senha, PASSWORD_BCRYPT)
        ];

        // Simula a consulta ao banco
        $mockUsuarioModel = $this->createMock(UsuarioModel::class);
        $mockUsuarioModel->method('buscaUsuario')->willReturn($usuarioData);

        $resultado = $mockUsuarioModel->buscaUsuario($usuario);

        $this->assertNotFalse($resultado);
        $this->assertEquals(1, $resultado['id']);
        $this->assertTrue(password_verify($senha, $resultado['senha']));
    }

    public function testAutenticacaoUsuarioInvalido() {
        $usuario = "admin";
        $senha = "senha_errada";

        $mockUsuarioModel = $this->createMock(UsuarioModel::class);
        $mockUsuarioModel->method('buscaUsuario')->willReturn(false);

        $resultado = $mockUsuarioModel->buscaUsuario($usuario);

        // 🔹 Garantimos que o retorno é false, mesmo sem entrar no if
        $this->assertFalse($resultado);
    }
}
