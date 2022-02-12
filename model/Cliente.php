<?php

#region Cliente
class Cliente
{
    #region PARÂMETROS PRIVADOS
    private $_idcliente;
    private $_nome;
    private $_rg;
    private $_cpf;
    private $_dataNascimento;
    private $_telefone;
    #endregion

    #region CONSTRUTOR
    public function __construct($params)
    {
        $this->_idcliente = $params["idusuidclienteario"];
        $this->_nome = $params["nome"];
        $this->_rg = $params["rg"];
        $this->_cpf = $params["cpf"];
        $this->_dataNascimento = $params["dataNascimento"];
        $this->_telefone = $params["telefone"];
    }
    #endregion

    #region GETTERS
    public function getIdCliente()
    {
        return $this->_idcliente;
    }

    public function getNome()
    {
        return $this->_nome;
    }

    public function getRg()
    {
        return $this->_rg;
    }

    public function getCpf()
    {
        return $this->_cpf;
    }

    public function getDataNascimento()
    {
        return $this->_dataNascimento;
    }

    public function getTelefone()
    {
        return $this->_telefone;
    }
    #endregion

    #region SETTERS
    public function setIdCliente($idcliente)
    {
        $this->_idcliente = $idcliente;
    }

    public function setNome($nome)
    {
        $this->_nome = $nome;
    }

    public function setRg($rg)
    {
        $this->_rg = $rg;
    }

    public function setCpf($cpf)
    {
        $this->_cpf = $cpf;
    }

    public function setDataNascimento($dataNascimento)
    {
        $this->_dataNascimento = $dataNascimento;
    }

    public function setTelefone($telefone)
    {
        $this->_telefone = $telefone;
    }
    #endregion
}
#endregion
