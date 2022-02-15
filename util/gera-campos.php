<?php
require_once("../layout/dao-loader.php");

switch($_POST["opt"])
{
    case 1:// CAMPO ENDEREÇO CLIENTE
        
        $cont = $_POST["contEnd"];
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
                                <a class="btn btn-danger" data-removeid="<?=$codCard?>" id="btnRemoveEndereco"><i class="fas fa-trash"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <input type="hidden" id="idendereco<?=$cont?>" name="idendereco<?=$cont?>" value="<?= $end['idendereco'] ?>">
                        <div class="row">
                            <div class="col-md-3 mb-4">
                                <label for="cep<?=$cont?>" class="form-label">CEP:</label>
                                <input type="text" name="cep<?=$cont?>" class="form-control force-check cep" id="cep<?=$cont?>" value="<?= $end["cep"] ?>">
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="logradouro<?=$cont?>" class="form-label">Logradouro:</label>
                                <input type="text" name="logradouro<?=$cont?>" class="form-control force-check" id="logradouro<?=$cont?>" value="<?= $end["logradouro"] ?>">
                            </div>
                            <div class="col-md-3 mb-4">
                                <label for="numero<?=$cont?>" class="form-label">Número:</label>
                                <input type="text" name="numero<?=$cont?>" class="form-control force-check numEnd" id="numero<?=$cont?>" value="<?= $end["numero"] ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="bairro<?=$cont?>" class="form-label">Bairro:</label>
                                <input type="text" name="bairro<?=$cont?>" class="form-control force-check" id="bairro<?=$cont?>" value="<?= $end["bairro"] ?>">
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="cidade<?=$cont?>" class="form-label">Cidade:</label>
                                <input type="text" name="cidade<?=$cont?>" class="form-control force-check" id="cidade<?=$cont?>" value="<?= $end["cidade"] ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 mb-4">
                                <label for="estado<?=$cont?>" class="form-label">UF:</label>
                                <input type="text" name="estado<?=$cont?>" class="form-control force-check uf" id="estado<?=$cont?>" value="<?= $end["estado"] ?>">
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="pais<?=$cont?>" class="form-label">País:</label>
                                <input type="text" name="pais<?=$cont?>" class="form-control force-check" id="pais<?=$cont?>" value="<?= $end["pais"] ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                $cont++;
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
                                <label for="cep0" class="form-label">CEP:</label>
                                <input type="text" name="cep<?=$cont?>" class="form-control force-check cep" id="cep0" value="">
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="logradouro0" class="form-label">Logradouro:</label>
                                <input type="text" name="logradouro<?=$cont?>" class="form-control force-check" id="logradouro0" value="">
                            </div>
                            <div class="col-md-3 mb-4">
                                <label for="numero0" class="form-label">Número:</label>
                                <input type="text" name="numero<?=$cont?>" class="form-control force-check numEnd" id="numero0" value="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="bairro0" class="form-label">Bairro:</label>
                                <input type="text" name="bairro<?=$cont?>" class="form-control force-check" id="bairro0" value="">
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="cidade0" class="form-label">Cidade:</label>
                                <input type="text" name="cidade<?=$cont?>" class="form-control force-check" id="cidade0" value="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 mb-4">
                                <label for="estado0" class="form-label">UF:</label>
                                <input type="text" name="estado<?=$cont?>" class="form-control force-check uf" id="estado0" value="">
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="pais0" class="form-label">País:</label>
                                <input type="text" name="pais<?=$cont?>" class="form-control force-check" id="pais0" value="">
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            $cont++;
        }
        
        
        break;
}