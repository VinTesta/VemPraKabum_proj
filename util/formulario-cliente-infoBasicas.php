<?php

// O POST É PARA QUANDO VEM DA PESQUISA QUE É PASSADO PARA O cliente-form.php
// QUE IMPLEMENTA ESSE ARQUIVO

$clienteFactory = new ClienteFactory();
$infoCLiente = isset($_POST["cont"]) ? $_SESSION["lista_cliente".$_POST["id_pesquisa"]][$_POST["cont"]] : [];
$cliente = $clienteFactory->criaCliente($infoCLiente);
if(isset($_POST["cont"]))
{
    ?>
    <input type="hidden" name="cont" id="cont" value="<?=$_POST['cont']?>">
    <input type="hidden" name="id_pesquisa" id="id_pesquisa" value="<?=$_POST['id_pesquisa']?>">
<?php
}
?>

<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Informações Basicas
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="nomeCliente" class="form-label">Nome do Cliente:</label>
                            <input type="text" class="form-control force-check" name="nomecliente" id="nomeCliente" value="<?= $cliente->getNome() ?>">
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="cpf" class="form-label">CPF:</label>
                            <input type="text" class="form-control force-check cpf" name="cpf" id="cpf" value="<?= $cliente->getCpf() ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="rg" class="form-label">RG:</label>
                            <input type="text" class="form-control force-check rg" name="rg" id="rg" value="<?= $cliente->getRg() ?>">
                        </div>
                        <div class="col-md-3 mb-4">
                            <label for="dataNascimento" class="form-label">Data de Nacimento:</label>
                            <input type="text" class="form-control force-check datepicker" name="datanascimento" id="datanascimento" value="<?= $cliente->getDataNascimento() ?>">
                        </div>
                        <div class="col-md-3 mb-4">
                            <label for="telefone" class="form-label">Telefone:</label>
                            <input type="text" class="form-control force-check celular" name="telefone" id="telefone" value="<?= $cliente->getTelefone() ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
