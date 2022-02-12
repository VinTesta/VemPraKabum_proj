<?php
require_once("../layout/dao-loader.php");

if(isset($_POST["nomecliente"]))
{
    try
    {
        var_dump($_POST);
        $clienteDao = new ClienteDao(new ConexaoMySql);

        $clienteDao->buscaCliente($_POST);
    }
    catch(Exception $ex)
    {
    
    }
}
