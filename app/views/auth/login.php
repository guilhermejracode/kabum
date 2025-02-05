<main class="form-signin w-100 m-auto">
    <?php if(!empty($_SESSION['msg_login'])){ ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Erro!</strong><br/><?= $_SESSION['msg_login']; unset($_SESSION['msg_login']); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php } ?>
    <form method="POST" action="<?= UrlHelper::baseURL() ?>/login">
        <img class="mb-4 offset-2" src="<?= UrlHelper::baseURL() ?>/public/img/logo.png" alt="logo Kabum" width="200">
        <h1 class="h3 mb-3 fw-normal text-center">ACESSE SUA CONTA</h1>

        <div class="form-floating">
            <input type="text" class="form-control" id="nome_usuario" name="nome_usuario" placeholder="Nome de usuário">
            <label for="nome_usuario">Nome de usuário</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha">
            <label for="senha">Senha</label>
        </div>
        <button class="btn btn-primary bg-kabum w-100 py-2" type="submit">Entrar</button>
        <p class="mt-5 mb-3 text-body-secondary text-center">&copy; 2025 - GuilhermeJRA</p>
    </form>
</main>
