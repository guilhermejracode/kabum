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

Crie um banco de dados no MySQL
Execute as migrações (caso existam)

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
    ```bash
    📂 kabum/
    │── 📂 app/
    │   ├── 📂 controllers/   # Lógica do fluxo de dados
    │   ├── 📂 models/        # Manipulação de dados com o banco
    │   ├── 📂 views/         # Interface com o usuário
    │── 📂 public/            # Arquivos CSS, JS e imagens
    │── 📂 config/            # Arquivos de configuração, helpers e utilits (ex: Database.php, UrlHelper.php)
    │── 📂 tests/             # Testes automatizados com PHPUnit
    │── 📝 README.md
    │── 📄 index.php
    ´´´

## ✅ Rodando Testes

1. Instale o PHPUnit via Composer (se ainda não tiver):
    ```sh
    composer require --dev phpunit/phpunit
    ```
2. Instale o PHPUnit via Composer (se ainda não tiver):
    ```sh
    vendor/bin/phpunit --testdox
    ```
