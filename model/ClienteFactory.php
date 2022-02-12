<?php
#region CLIENTEFACTORY
class ClienteFactory
{
    public function criaCliente($params)
    {
        $values["idcliente"] = isset($params["idcliente"]) ? $params["idusuidclienteario"] : NULL;
        $values["nome"] = isset($params["nome"]) ? $params["nome"] : NULL;
        $values["rg"] = isset($params["rg"]) ? $params["rg"] : NULL;
        $values["cpf"] = isset($params["cpf"]) ? $params["cpf"] : NULL;
        $values["dataNascimento"] = isset($params["dataNascimento"]) ? $params["dataNascimento"] : NULL;
        $values["telefone"] = isset($params["telefone"]) ? $params["telefone"] : NULL;

        return new Cliente($values);
    }
}
#endregion