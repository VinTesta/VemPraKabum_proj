<?php
require_once("../util/funcoes.php");
#region USUARIODAO
class UsuarioDao
{
    #region PROPRIEDADES PRIVADAS
    private $_conn;
    #endregion

    #region CONSTRUTOR
    public function __construct(ConexaoInterface $conn)
    {
        $this->_conn = $conn->conecta();
    }
    #endregion

    #region INSERT
    public function insert()
    {
        // INSERÇÃO
    }
    #endregion

    #region DELETE
    public function delete()
    {
        // EXCLUSÃO
    }
    #endregion

    #region UPDATE
    public function update()
    {
        // ALTERAÇÃO
    }
    #endregion

    #region LOGIN
    public function login($params)
    {
        $uf = new UsuarioFactory();
        $usuario_db = $uf->criaUsuario($this->selectEmailUsuario($params["email"]));
        
        if($usuario_db->getEmail() != null && password_verify($params["senha"], $usuario_db->getSenha()))
        {
            session_start();
            $_SESSION["login"] = $usuario_db->getEmail();
            $_SESSION["nomeusuario"] = $usuario_db->getNome();
            $_SESSION["idusuario"] = $usuario_db->getIdUsuario();
            
            return true;
        }
        else
        {
            session_start();
            session_destroy();
            
            return false;
        }
    }
    #endregion
    
    #region SELECT
    public function select()
    {
        return "SELECT 
                        &*&
                    FROM 
                        &usuario&";        
    }
    #endregion

    #region SELECT POR EMAIL
    public function selectEmailUsuario($emailusuario)
    {
        $query = $this->select();
        $conexao = $this->_conn;

        $query = str_replace("&*&", " * ", $query);
        $query = str_replace("&usuario&", "usuario WHERE emailusuario = ?", $query);
        
        $paramBusca = filtraCampos($emailusuario, 1);
        $stmt = $conexao->prepare($query);
        $stmt->bindParam(1, $paramBusca);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        // FECHA CONEXÃO
        $conexao = null;

        return $resultado;
    }
    #endregion

    #region SELECT POR ID
    public function selectByIdUsuario($idusuario)
    {
        $query = $this->select();
        $query = str_replace("&*&", " * ", $query);
        $query = str_replace("&usuario&", "usuario WHERE idusuario = ?", $query);
        
        $stmt = mysqli_prepare($this->_conn, $query);
        $stmt->bind_param("i", $idusuario);
        $stmt->execute();
        $resultado = mysqli_fetch_assoc($stmt->get_result());
        $stmt->close();

        var_dump($resultado);

        return $resultado;
    }
    #endregion
}
#endregion
?>