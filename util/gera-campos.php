<?php
require_once("../layout/dao-loader.php");

switch($_POST["opt"])
{
    case 1:// CAMPO ENDEREÇO CLIENTE
        if(isset($_POST["cont"]))
        {
            $enderecoDao = new EnderecoDao(new ConexaoMySql);
            $infoCliente = $_SESSION["lista_cliente".$_POST["id_pesquisa"]][$_POST["cont"]];
            $enderecoCliente = $enderecoDao->selectEnderecoCliente($infoCliente["idcliente"]);
            
            foreach($enderecoCliente as $key => $end)
            {
                $codCard = geraCodigo();
                ?>
                <div class="card mb-4" id="<?=$codCard?>">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-10"><?= $end["logradouro"] .", "
                                                    . $end["numero"] .", "
                                                    . $end["bairro"]?> 
                                                    </div>
                            <div class="col-2 d-flex justify-content-end">
                                <a class="btn btn-danger" id="btnRemoveEndereco"><i class="fas fa-trash"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 mb-4">
                                <label for="cepEndCliente" class="form-label">CEP:</label>
                                <input type="text" class="form-control force-check cep" id="cepEndCliente" value="<?= $end["cep"] ?>">
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="logradouro" class="form-label">Logradouro:</label>
                                <input type="text" class="form-control force-check" id="logradouro" value="<?= $end["logradouro"] ?>">
                            </div>
                            <div class="col-md-3 mb-4">
                                <label for="numero" class="form-label">Número:</label>
                                <input type="text" class="form-control force-check numEnd" id="numero" value="<?= $end["numero"] ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="bairro" class="form-label">Bairro:</label>
                                <input type="text" class="form-control force-check" id="bairro" value="<?= $end["bairro"] ?>">
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="cidade" class="form-label">Cidade:</label>
                                <input type="text" class="form-control force-check" id="cidade" value="<?= $end["cidade"] ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 mb-4">
                                <label for="estado" class="form-label">UF:</label>
                                <input type="text" class="form-control force-check uf" id="estado" value="<?= $end["estado"] ?>">
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="pais" class="form-label">País:</label>
                                <input type="text" class="form-control force-check" id="pais" value="<?= $end["pais"] ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
        else
        {
            $codCard = geraCodigo();
            ?>
            <div class="card mb-4" id="<?= $codCard ?>">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-10"></div>
                            <div class="col-2 d-flex justify-content-end">
                                <a class="btn btn-danger" data-removeid="<?=$codCard?>" id="btnRemoveEndereco"><i class="fas fa-trash"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 mb-4">
                                <label for="cepEndCliente" class="form-label">CEP:</label>
                                <input type="text" class="form-control force-check cep" id="cepEndCliente" value="">
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="logradouro" class="form-label">Logradouro:</label>
                                <input type="text" class="form-control force-check" id="logradouro" value="">
                            </div>
                            <div class="col-md-3 mb-4">
                                <label for="numero" class="form-label">Número:</label>
                                <input type="text" class="form-control force-check numEnd" id="numero" value="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="bairro" class="form-label">Bairro:</label>
                                <input type="text" class="form-control force-check" id="bairro" value="">
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="cidade" class="form-label">Cidade:</label>
                                <input type="text" class="form-control force-check" id="cidade" value="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 mb-4">
                                <label for="estado" class="form-label">UF:</label>
                                <input type="text" class="form-control force-check uf" id="estado" value="">
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="pais" class="form-label">País:</label>
                                <input type="text" class="form-control force-check" id="pais" value="">
                            </div>
                        </div>
                    </div>
                </div>
            <?php
        }
        
        
        break;
}