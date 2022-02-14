<?php
#region CLIENTEFACTORY
class ClienteFactory
{
    public function criaCliente($params)
    {
        $values["idcliente"] = isset($params["idcliente"]) ? $params["idcliente"] : NULL;
        $values["nomecliente"] = isset($params["nomecliente"]) ? $params["nomecliente"] : NULL;
        $values["rg"] = isset($params["rg"]) ? $params["rg"] : NULL;
        $values["cpf"] = isset($params["cpf"]) ? $params["cpf"] : NULL;

        $values["datanascimento"] = NULL;
        if(isset($params["datanascimento"]))
        {
            $params["datanascimento"] = explode("-", $params["datanascimento"]);
            $values["datanascimento"] =$params["datanascimento"][2] ."/". $params["datanascimento"][1] ."/". $params["datanascimento"][0];
        }
        
        $values["telefone"] = isset($params["telefone"]) ? $params["telefone"] : NULL;

        return new Cliente($values);
    }
}
#endregion