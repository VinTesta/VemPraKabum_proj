<?php
#region USUARIO
class Usuario 
{
    #region PARÂMETROS PRIVADOS
    private $_idusuario;
    private $_email;
    private $_senha;
    private $_nome;
    #endregion

    #region CONSTRUTOR
    public function __construct($params)
    {
        $this->_idusuario = isset($params["idusuario"]) ? $params["idusuario"] : NULL;
        $this->_email = isset($params["emailusuario"]) ? $params["emailusuario"] : NULL;
        $this->_senha = isset($params["senhausuario"]) ? $params["senhausuario"] : NULL;
        $this->_nome = isset($params["nomeusuario"]) ? $params["nomeusuario"] : NULL;
    }
    #endregion

    #region GETTERS
    public function getIdUsuario()
    {
        return $this->_idusuario;
    }

    public function getEmail()
    {
        return $this->_email;
    }

    public function getSenha()
    {
        return $this->_senha;
    }

    public function getNome()
    {
        return $this->_nome;
    }
    #endregion

    #region SETTERS
    public function setIdUsuario($idusuario)
    {
        $this->_idusuario = $idusuario;
    }

    public function setEmail($email)
    {
        $this->_email = $email;
    }

    public function setSenha($senha)
    {
        $this->_senha = $senha;
    }

    public function setNome($nome)
    {
        $this->_nome = $nome;
    }
    #endregion
}
#endregion
?>