<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 m-top-20">
            <h2><?= $titulo ?></h2>
        </div>
    </div>
</div>
<div class="text-kabum">
    <hr>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <a href="<?= UrlHelper::baseURL() ?>/clientes/cadastrar" class="btn btn-primary">Novo Cliente</a>
        </div>
    </div>
</div>
<br/>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
<?php if(!empty($_SESSION['erro_cadastro'])){ ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Erro!</strong><br/><?= $_SESSION['erro_cadastro']; unset($_SESSION['erro_cadastro']); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php } ?>
<?php if(!empty($_SESSION['sucesso_cadastro'])){ ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Sucesso!</strong><br/><?= $_SESSION['sucesso_cadastro']; unset($_SESSION['sucesso_cadastro']); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php } ?>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <table class="table">
                <thead>
                <tr>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($clientes as $cliente): ?>
                    <tr>
                        <td><?php echo $cliente['nome']; ?></td>
                        <td><?php echo $cliente['cpf']; ?></td>
                        <td>
                            <a href="<?= UrlHelper::baseURL() ?>/clientes/editar/<?php echo $cliente['id']; ?>" class="btn btn-outline-kabum">Editar</a>
                            <a href="<?= UrlHelper::baseURL() ?>/clientes/excluir/<?php echo $cliente['id']; ?>" class="btn btn-outline-kabum">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
