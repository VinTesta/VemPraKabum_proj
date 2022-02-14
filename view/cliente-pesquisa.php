<?php
require_once("../layout/cabecalho.php");
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="shadow p-3 mb-4 mt-4 bg-body rounded text-center h3">Tabela de Clientes</div>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-md-12 d-flex justify-content-end">
            <button class="btn btn-outline-secondary btn-sm" type="button" data-bs-placement="left" 
                title="Filtros" data-bs-toggle="collapse" data-bs-target="#collapseExample" 
                aria-expanded="false" aria-controls="collapseExample">

                <i class="fas fa-filter"></i>
            </button>
        </div>
    </div>
        
    <div class="shadow p-3 bg-body rounded mb-4">
        <div class="collapse mb-4 show" id="collapseExample">
            <div class="card card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="nomeCliente" class="form-label">Nome Cliente:</label>
                                <input type="text" class="form-control textName" id="nomeCliente" 
                                    placeholder="">
                            </div>
                            <div class="col-md-3 mb-4">
                                <label for="dataNascimento" class="form-label">Data de Nascimento:</label>
                                <input type="text" class="form-control data" id="dataNascimento">
                            </div>
                            <div class="col-md-3 mb-4">
                                <label for="cpfCliente" class="form-label">CPF:</label>
                                <input type="text" class="form-control cpf" id="cpfCliente">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 mb-4">
                                <label for="rgCliente" class="form-label">RG:</label>
                                <input type="text" class="form-control rg" id="rgCliente">
                            </div>
                            <div class="col-md-3 mb-4">
                                <label for="telefoneCliente" class="form-label">Telefone:</label>
                                <input type="text" class="form-control celular" id="telefoneCliente">
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center">
                <button class="btn btn-primary" id="btnPesquisaCliente">
                    Pesquisar
                </button>
            </div>
        </div>
    </div>
    
    <div class="row mb-4" id="containerTabelaClientes">
        <div class="col-md-12">
            <div class="bg-body rounded d-flex justify-content-center align-center">
                <div id="boxTabelaCliente" class="col-12">
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once("../layout/rodape.php");