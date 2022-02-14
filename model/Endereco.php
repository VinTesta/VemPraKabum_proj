<?php
class Endereco
{
    #region PARÂMETROS PRIVADOS
    private $_idendereco;
    private $_logradouro;
    private $_bairro;
    private $_numero;
    private $_cidade;
    private $_estado;
    private $_cep;
    private $_pais;
    #endregion

    #region CONSTRUTOR
    public function __construct($params) 
    {
        $this->_idendereco = $params["idendereco"];
        $this->_logradouro = $params["logradouro"];
        $this->_bairro = $params["bairro"];
        $this->_numero = $params["numero"];
        $this->_cidade = $params["cidade"];
        $this->_estado = $params["estado"];
        $this->_cep = $params["cep"];
        $this->_pais = $params["pais"];
    }
    #endregion

    #region GETTERS
    public function getIdEndereco()
    {
        return $this->_idendereco;
    }

    public function getLogradouro()
    {
        return $this->_logradouro;
    }

    public function getBairro()
    {
        return $this->_bairro;
    }

    public function getNumero()
    {
        return $this->_numero;
    }

    public function getCidade()
    {
        return $this->_cidade;
    }

    public function getEstado()
    {
        return $this->_estado;
    }

    public function getCep()
    {
        return $this->_cep;
    }

    public function getPais()
    {
        return $this->_pais;
    }
    #endregion

    #region SETTERS
    public function setIdEndereco($idendereco)
    {
        $this->_idendereco = $idendereco;
    }

    public function setLogradouro($logradouro)
    {
        $this->_logradouro = $logradouro;
    }

    public function setBairro($bairro)
    {
        $this->_bairro = $bairro;
    }

    public function setNumero($numero)
    {
        $this->_numero = $numero;
    }

    public function setCidade($cidade)
    {
        $this->_cidade = $cidade;
    }

    public function setEstado($estado)
    {
        $this->_estado = $estado;
    }

    public function setCep($cep)
    {
        $this->_cep = $cep;
    }

    public function setPais($pais)
    {
        $this->_pais = $pais;
    }
    #endregion
}