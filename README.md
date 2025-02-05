# Portal Administrativo

> Um sistema administrativo para gestão de clientes, desenvolvido com PHP puro e MySQL.

## 📌 Funcionalidades

✅ Autenticação de usuários (login/logout)  
✅ CRUD de clientes (cadastro, edição, listagem e remoção)  
✅ Suporte a múltiplos endereços por cliente  
✅ Arquitetura modular seguindo princípios **SOLID**  
✅ Testes automatizados com **PHPUnit**  

## 🚀 Tecnologias

- **PHP** (sem frameworks)  
- **MySQL** (para armazenamento de dados)  
- **HTML, CSS e JavaScript** (frontend livre)  
- **Composer** (gerenciador de dependências)  
- **PHPUnit** (testes automatizados)  

## ⚙ Pré-requisitos

Antes de começar, certifique-se de ter instalado:  
- **PHP 8.x** ou superior  
- **MySQL**  
- **Composer**  
- **Servidor Apache ou Nginx**  

## 🔧 Instalação e Configuração

1. Clone o repositório:  
   ```sh
   git clone https://github.com/guilhermejracode/kabum.git
   cd kabum
   ```

2. Configure o banco de dados:

 - Crie um banco de dados no MySQL
    ```sql
    CREATE DATABASE kabum;
    
    USE kabum;
    
    CREATE TABLE usuarios (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nome_usuario VARCHAR(50) NOT NULL,
        senha VARCHAR(255) NOT NULL
    );
    
    CREATE TABLE clientes (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(100) NOT NULL,
        data_nascimento DATE NOT NULL,
        cpf VARCHAR(14) NOT NULL,
        rg VARCHAR(20),
        telefone VARCHAR(20),
        usuario_id INT,
        FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
    );
    
    CREATE TABLE enderecos (
        id INT AUTO_INCREMENT PRIMARY KEY,
        cliente_id INT NOT NULL,
        logradouro VARCHAR(255) NOT NULL,
        numero varchar(10) NOT NULL,
        bairro varchar(100) NOT NULL,
        cidade VARCHAR(100) NOT NULL,
        estado VARCHAR(100) NOT NULL,
        cep VARCHAR(10) NOT NULL,
        FOREIGN KEY (cliente_id) REFERENCES clientes(id)
    );
    ```
 - Execute o insert do usuário admin no banco para conseguir realizar login no portal:
    - A **senha** padrão do usuário é **123456**
    ```sql
    INSERT INTO `usuarios` (`id`, `nome_usuario`, `senha`) VALUES
    (1, 'admin', '$2y$10$URMz4lA2UPyDsRhU4uRhUeb9ImziSMaTRcl9IKyOHzklGJgo3Syua');
    ```

3. Edite o arquivo config/Database.php e adicione as credenciais do banco:
    ```php
    private $host = 'host_do_servidor_MySQL';
    private $db_name = 'nome_do_banco';
    private $username = 'seu_usuario';
    private $password = 'sua_senha';
    ```
4. Utilize um servidor local para rodar o projeto:
    ```sh
    php -S localhost:8000/kabum -t public
    ```
5. Acesse o sistema no navegador:
    ```bash
    http://localhost:8000/kabum/login
    ```
    
## 🏗 Estrutura do Projeto
    📂 kabum/
    │── 📂 app/
    │   ├── 📂 controllers/   # Lógica do fluxo de dados
    │   ├── 📂 services/      # Regras de validação
    │   ├── 📂 models/        # Manipulação de dados com o banco
    │   ├── 📂 views/         # Interface com o usuário
    │── 📂 public/            # Arquivos CSS, JS e imagens
    │── 📂 config/            # Arquivos de configuração, helpers e utilits (ex: Database.php, UrlHelper.php)
    │── 📂 tests/             # Testes automatizados com PHPUnit
    │── 📝 README.md
    │── 📄 index.php

## ✅ Rodando Testes

1. Instale o PHPUnit via Composer (se ainda não tiver):
    ```sh
    composer require --dev phpunit/phpunit
    ```
2. Execute os testes automatizados:
    ```sh
    vendor/bin/phpunit --testdox
    ```
