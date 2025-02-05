<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Kabum</title>
    <link rel="stylesheet" href="<?= UrlHelper::baseURL() ?>/public/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= UrlHelper::baseURL() ?>/public/css/styles-kabum.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body>

<!-- Navbar para dispositivos pequenos -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark d-lg-none">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Portal Kabum</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarMenu">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a href="<?= UrlHelper::baseURL() ?>/home/index" class="nav-link <?= UrlHelper::currentURL() == UrlHelper::baseURL().'/home/index' ? 'active' : '' ?>">
                        <i class="bi bi-house-door"></i> Home
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= UrlHelper::baseURL() ?>/clientes/listar" class="nav-link <?= UrlHelper::currentURL() == UrlHelper::baseURL().'/clientes/listar' || UrlHelper::currentURL() == UrlHelper::baseURL().'/clientes/cadastrar' || UrlHelper::currentURL(true) == UrlHelper::baseURL().'/clientes/editar' ? 'active' : '' ?>">
                        <i class="bi bi-people"></i> Clientes
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= UrlHelper::baseURL() ?>/logout" class="nav-link text-danger">
                        <i class="bi bi-box-arrow-right"></i> Sair
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Layout Principal -->
<div class="container-fluid">
    <div class="row">

        <!-- Sidebar fixa no lado esquerdo (visível apenas em telas grandes) -->
        <aside class="col-lg-2 d-none d-lg-block bg-primary text-white border-end min-vh-100 position-fixed start-0 p-3">
            <h4 class="text-center">Portal Kabum</h4>
            <div class="text-center">
                <img src="<?= UrlHelper::baseURL() ?>/public/img/logo.png" class="text-center" width="100">
            </div>
            <hr>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="<?= UrlHelper::baseURL() ?>/home/index" class="nav-link text-white <?= UrlHelper::currentURL() == UrlHelper::baseURL().'/home/index' ? 'active' : '' ?>">
                        <i class="bi bi-house-door"></i> Home
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= UrlHelper::baseURL() ?>/clientes/listar" class="nav-link text-white <?= UrlHelper::currentURL() == UrlHelper::baseURL().'/clientes/listar' || UrlHelper::currentURL() == UrlHelper::baseURL().'/clientes/cadastrar' || UrlHelper::currentURL(true) == UrlHelper::baseURL().'/clientes/editar' ? 'active' : '' ?>">
                        <i class="bi bi-people"></i> Clientes
                    </a>
                </li>
                <hr>
                <li class="nav-item">
                    <div class="d-grid gap-2">
                        <a href="<?= UrlHelper::baseURL() ?>/logout" class="btn btn-primary bg-kabum text-white">
                            <i class="bi bi-box-arrow-right"></i> Sair
                        </a>
                    </div>
                </li>
            </ul>
        </aside>

        <!-- Conteúdo principal -->
        <main class="col-lg-10 offset-lg-2 py-4">
            <?= $content ?> <!-- Aqui será carregado o conteúdo das views -->
        </main>

    </div>
</div>

<!-- Rodapé -->
<footer class="text-center mt-4">
    <p>&copy; <?= date('Y') ?> - GuilhermeJRA</p>
</footer>

<script src="<?= UrlHelper::baseURL() ?>/public/js/bootstrap.bundle.min.js"></script>
<script src="<?= UrlHelper::baseURL() ?>/public/js/jquery-3.7.1.min.js"></script>
<script src="<?= UrlHelper::baseURL() ?>/public/js/jquery-inputmask.js"></script>
<script>
    $(document).ready(function() {
        // Aplica as máscaras nos campos existentes
        $('#cpf').inputmask('999.999.999-99');
        $('#telefone').inputmask('(99) 99999-9999');
        $('.cep').inputmask('99999-999');
    });
</script>
</body>
</html>
