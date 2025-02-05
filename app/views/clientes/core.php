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
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <?php if(!empty($cliente['id'])){ ?>
                <form action="<?= UrlHelper::baseURL() ?>/clientes/editar/<?= $cliente['id']; ?>" method="POST">
            <?php }else{ ?>
                <form action="<?= UrlHelper::baseURL() ?>/clientes/cadastrar" method="POST">
            <?php } ?>
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" value="<?= !empty($cliente['nome']) ? $cliente['nome'] : (!empty($_POST['nome']) ? $_POST['nome'] : '') ?>" required>
                </div>
                <div class="mb-3">
                    <label for="data_nascimento" class="form-label">Data de Nascimento</label>
                    <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" value="<?= !empty($cliente['data_nascimento']) ? $cliente['data_nascimento'] : (!empty($_POST['data_nascimento']) ? $_POST['data_nascimento'] : '') ?>" required>
                </div>
                <div class="mb-3">
                    <label for="cpf" class="form-label">CPF</label>
                    <input type="text" class="form-control" id="cpf" name="cpf" value="<?= !empty($cliente['cpf']) ? $cliente['cpf'] : (!empty($_POST['cpf']) ? $_POST['cpf'] : '') ?>" required>
                </div>
                <div class="mb-3">
                    <label for="rg" class="form-label">RG</label>
                    <input type="text" class="form-control" id="rg" name="rg" value="<?= !empty($cliente['rg']) ? $cliente['rg'] : (!empty($_POST['rg']) ? $_POST['rg'] : '') ?>" required>
                </div>
                <div class="mb-3">
                    <label for="telefone" class="form-label">Telefone</label>
                    <input type="text" class="form-control" id="telefone" name="telefone" value="<?= !empty($cliente['telefone']) ? $cliente['telefone'] : (!empty($_POST['telefone']) ? $_POST['telefone'] : '') ?>" required>
                </div>


                <h3>Endereços</h3>
                <div id="enderecos">
                    <?php if (empty($enderecos)){ ?>
                        <div class="endereco border p-3 mb-3 position-relative">
                            <button type="button" class="btn-close position-absolute top-0 end-0 m-2 remove-endereco"></button>
                            <div class="row">
                                <div class="col">
                                    <label class="form-label">Logradouro</label>
                                    <input type="text" class="form-control" name="enderecos[0][logradouro]">
                                </div>
                                <div class="col">
                                    <label class="form-label">Número</label>
                                    <input type="number" class="form-control" name="enderecos[0][numero]">
                                </div>
                                <div class="col">
                                    <label class="form-label">Bairro</label>
                                    <input type="text" class="form-control" name="enderecos[0][bairro]">
                                </div>
                                <div class="col">
                                    <label class="form-label">Cidade</label>
                                    <input type="text" class="form-control" name="enderecos[0][cidade]">
                                </div>
                                <div class="col">
                                    <label class="form-label">Estado</label>
                                    <input type="text" class="form-control" name="enderecos[0][estado]">
                                </div>
                                <div class="col">
                                    <label class="form-label">CEP</label>
                                    <input type="text" class="form-control cep" name="enderecos[0][cep]">
                                </div>
                            </div>
                        </div>
                    <?php } else { ?>
                        <?php foreach ($enderecos as $k => $end){ ?>
                            <div class="endereco border p-3 mb-3 position-relative">
                                <button type="button" class="btn-close position-absolute top-0 end-0 m-2 remove-endereco"></button>
                                <div class="row">
                                    <div class="col">
                                        <label class="form-label">Logradouro</label>
                                        <input type="text" class="form-control" name="enderecos[<?= $k ?>][logradouro]" value="<?= $end['logradouro'] ?>">
                                    </div>
                                    <div class="col">
                                        <label class="form-label">Número</label>
                                        <input type="number" class="form-control" name="enderecos[<?= $k ?>][numero]" value="<?= $end['numero'] ?>">
                                    </div>
                                    <div class="col">
                                        <label class="form-label">Bairro</label>
                                        <input type="text" class="form-control" name="enderecos[<?= $k ?>][bairro]" value="<?= $end['bairro'] ?>">
                                    </div>
                                    <div class="col">
                                        <label class="form-label">Cidade</label>
                                        <input type="text" class="form-control" name="enderecos[<?= $k ?>][cidade]" value="<?= $end['cidade'] ?>">
                                    </div>
                                    <div class="col">
                                        <label class="form-label">Estado</label>
                                        <input type="text" class="form-control" name="enderecos[<?= $k ?>][estado]" value="<?= $end['estado'] ?>">
                                    </div>
                                    <div class="col">
                                        <label class="form-label">CEP</label>
                                        <input type="text" class="form-control cep" name="enderecos[<?= $k ?>][cep]" value="<?= $end['cep'] ?>">
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div>
                <br>
                <div class="row">
                    <div class="col">
                        <button type="button" class="btn btn-outline-kabum" id="adicionar-endereco">Adicionar Endereço</button>
                    </div>
                </div>
                <br><br>
                <div class="d-grid gap-2 col-lg-1 col-md-2 col-sm-12">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('adicionar-endereco').addEventListener('click', function() {
        let enderecosDiv = document.getElementById('enderecos');
        let index = enderecosDiv.getElementsByClassName('endereco').length;

        let enderecoHtml = `
        <div class="endereco border p-3 mb-3 position-relative">
            <button type="button" class="btn-close position-absolute top-0 end-0 m-2 remove-endereco"></button>
            <div class="row">
                <div class="col">
                    <label class="form-label">Logradouro</label>
                    <input type="text" class="form-control" name="enderecos[\${index}][logradouro]">
                </div>
                <div class="col">
                    <label class="form-label">Número</label>
                    <input type="number" class="form-control" name="enderecos[\${index}][numero]">
                </div>
                <div class="col">
                    <label class="form-label">Bairro</label>
                    <input type="text" class="form-control" name="enderecos[\${index}][bairro]">
                </div>
                <div class="col">
                    <label class="form-label">Cidade</label>
                    <input type="text" class="form-control" name="enderecos[\${index}][cidade]">
                </div>
                <div class="col">
                    <label class="form-label">Estado</label>
                    <input type="text" class="form-control" name="enderecos[\${index}][estado]">
                </div>
                <div class="col">
                    <label class="form-label">CEP</label>
                    <input type="text" class="form-control cep" name="enderecos[\${index}][cep]">
                </div>
            </div>
        </div>
        `;

        enderecosDiv.insertAdjacentHTML('beforeend', enderecoHtml);

        $('.cep').inputmask('99999-999');
        addRemoveEnderecoListeners();
    });

    function addRemoveEnderecoListeners() {
        document.querySelectorAll('.remove-endereco').forEach(button => {
            button.addEventListener('click', function() {
                this.parentElement.remove();
            });
        });
    }

    addRemoveEnderecoListeners();
</script>
