<?php
class EnderecoFactory
{
    public function criaEndereco($params)
    {
        $values["idendereco"] = isset($params["idendereco"]) ? $params["idendereco"] : NULL;
        $values["logradouro"] = isset($params["logradouro"]) ? $params["logradouro"] : NULL;
        $values["cep"] = isset($params["cep"]) ? $params["cep"] : NULL;
        $values["bairro"] = isset($params["bairro"]) ? $params["bairro"] : NULL;
        $values["estado"] = isset($params["estado"]) ? $params["estado"] : NULL;
        $values["cidade"] = isset($params["cidade"]) ? $params["cidade"] : NULL;
        $values["pais"] = isset($params["pais"]) ? $params["pais"] : NULL;
        $values["numero"] = isset($params["numero"]) ? $params["numero"] : NULL;

        return new Endereco($values);
    }
}