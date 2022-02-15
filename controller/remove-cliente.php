<?php
require_once("../layout/dao-loader.php");

try
{
    
    $clienteDao = new ClienteDao(new ConexaoMySql());
    $conn = $clienteDao->getConn();
    
    $conn->beginTransaction();
    $infoCliente = $_SESSION["lista_cliente".$_POST["id_pesquisa"]][$_POST["cont"]];

    $resultado = $clienteDao->delete($infoCliente["idcliente"]);

    if($resultado[1] == null)
    {
        echo "Excluido com sucesso";
    } 
    else
    {
        echo "Houve um erro ao excluir o registro. Erro: ".$resultado[2];
    }

    $conn->commit();
}
catch(Exception $ex)
{
    $conn->rollback();
    echo "Houve um erro ao excluir o registro. Erro: ".$ex->me;
}