<?php
require_once("../layout/dao-loader.php");
class EnderecoDao
{
    #region PARÂMETRO PRIVADOS
    private $_conn;
    #endregion

    #region CONSTRUTOR
    public function __construct(ConexaoInterface $conn)
    {
        $this->_conn = $conn->conecta();
    }
    #endregion

    #region GETTERS
    public function getConn()
    {
        return $this->_conn;
    }
    #endregion

    #region SETTERS
    public function setConn($conn)
    {
        $this->_conn = $conn;
    }
    #endregion

    #region SELECT
    public function select()
    {
        return "SELECT 
                        &*&
                    FROM
                        &endereco&";
    }
    #endregion

    #region REMOVE
    public function remove($idendereco)
    {
        $query = "UPDATE 
                        endereco
                    SET
                        status = 0
                    WHERE 
                        idendereco = :idendereco";

        $stmt = $this->_conn->prepare($query);
        $stmt->bindValue(":idendereco", $idendereco);
        $stmt->execute();
        
        return $stmt->rowCount();

    }
    #endregion
    #region INSERT
    public function insert($params)
    {
        $query = "INSERT INTO 
                            endereco (logradouro, bairro, numero, cidade, estado, pais, cep)
                        VALUES (:logradouro, :bairro, :numero, :cidade, :estado, :pais, :cep)";
        
        $stmt = $this->_conn->prepare($query);
        $stmt->bindValue(":logradouro", filtraCampos($params["logradouro"], 2));
        $stmt->bindValue(":bairro", filtraCampos($params["bairro"], 2));
        $stmt->bindValue(":numero", filtraCampos($params["numero"], 2));
        $stmt->bindValue(":cidade", filtraCampos($params["cidade"], 2));
        $stmt->bindValue(":estado", filtraCampos($params["estado"], 2));
        $stmt->bindValue(":cep", filtraCampos($params["cep"], 2));
        $stmt->bindValue(":pais", filtraCampos($params["pais"], 2));

        $stmt->execute();

        $erro = $stmt->errorInfo();
        $id = $this->_conn->lastInsertId();

        return array("erro" => $erro[1], "insertId" => $id);
    }
    #endregion

    #region INSERT ENDERECO CLIENTE
    public function insertEnderecoCliente($idcliente, $idendereco)
    {
        $query = "INSERT INTO
                            enderecocliente (cliente_idcliente, endereco_idendereco)
                        VALUES (:idcliente, :idendereco)";
        
        $stmt = $this->_conn->prepare($query);
        $stmt->bindValue(":idcliente", $idcliente);
        $stmt->bindValue(":idendereco", $idendereco);

        $stmt->execute();

        $erro = $stmt->errorInfo();
        $id = $this->_conn->lastInsertId();

        return array("erro" => $erro[1], "insertId" => $id);
    }
    #endregion

    #region SELECT ENDERECO CLIENTE
    public function selectEnderecoCliente($idcliente)
    {
        $conexao = $this->_conn;
        $query = $this->select();

        $query = str_replace("&*&", " endereco.*, cliente.idcliente, cliente.nomecliente ", $query);
        $query = str_replace("&endereco&", "endereco, 
                                            cliente, 
                                            enderecocliente 
                                        WHERE 
                                            1 = 1
                                            AND endereco.idendereco = enderecocliente.endereco_idendereco
                                            AND cliente.idcliente = enderecocliente.cliente_idcliente
                                            AND cliente.idcliente = :idcliente
                                            AND endereco.status = 1", $query);

        $stmt = $conexao->prepare($query);
        $stmt->bindValue(":idcliente", $idcliente);
        $stmt->execute();

        $resultado = [];
        foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $end)
        {
            $resultado[$end["idendereco"]] = $end;
        }

        return $resultado;
    }
    #endregion

    #region VALIDA ENDERECO CLIENTE
    public function comparaEnderecoCliente($idcliente, $end_add)
    {
        $end_remove = $this->selectEnderecoCliente($idcliente);
        foreach($end_add as $key => $end)
        {
            if($end["idendereco"] != "" && array_key_exists($end["idendereco"], $end_remove))
            {
                unset($end_add[$key]);
                unset($end_remove[$end["idendereco"]]);
            }
        }

        return array("adicionar" => $end_add, "remover" => $end_remove);
    }
    #endregion
}