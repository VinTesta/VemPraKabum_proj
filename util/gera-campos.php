<?php
require_once("../layout/dao-loader.php");

switch($_POST["opt"])
{
    case 1:// CAMPO ENDEREÇO CLIENTE
        $enderecoDao = new EnderecoDao(new ConexaoMySql);
        $infoCliente = $_SESSION["lista_cliente".$_POST["id_pesquisa"]][$_POST["cont"]];
        $enderecoCliente = $enderecoDao->selectEnderecoCliente($infoCliente["idcliente"]);

        foreach($enderecoCliente as $key => $end)
        {
            var_dump($end);
        }
        break;
}