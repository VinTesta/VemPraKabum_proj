<?php
require_once("../layout/dao-loader.php");
#region CLIENTEDAO
class ClienteDao
{
    #region PARÂMETROS PRIVADO
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

    #region INSERT
    public function insert($params)
    {
        $query = "INSERT INTO 
                            cliente (nomecliente, cpf, rg, telefone, datanascimento)
                        VALUES (:nomecliente, :cpf, :rg, :telefone, :datanascimento)";

        $stmt = $this->_conn->prepare($query);
        $stmt->bindValue(":nomecliente", filtraCampos($params["nomecliente"], 2));
        $stmt->bindValue(":cpf", filtraCampos($params["cpf"], 2));
        $stmt->bindValue(":rg", filtraCampos($params["rg"], 2));
        $stmt->bindValue(":telefone", filtraCampos($params["telefone"], 2));
        $stmt->bindValue(":datanascimento", filtraCampos($params["datanascimento"], 5));

        $stmt->execute();

        $erro = $stmt->errorInfo();
        $id = $this->_conn->lastInsertId();

        return array("insertId" => $id, "erro" => $erro);
    }
    #endregion

    #region UPDATE
    public function update($idcliente, $params)
    {
        $query = "UPDATE
                        cliente
                    SET
                        nomecliente = :nomecliente,
                        datanascimento = :datanascimento,
                        cpf = :cpf,
                        rg = :rg,
                        telefone = :telefone
                    WHERE 
                        idcliente = :idcliente";

        $stmt = $this->_conn->prepare($query);
        $stmt->bindValue(":nomecliente", filtraCampos($params["nomecliente"], 2));
        $stmt->bindValue(":cpf", filtraCampos($params["cpf"], 2));
        $stmt->bindValue(":rg", filtraCampos($params["rg"], 2));
        $stmt->bindValue(":telefone", filtraCampos($params["telefone"], 2));
        $stmt->bindValue(":datanascimento", filtraCampos($params["datanascimento"], 5));
        $stmt->bindValue(":idcliente", $idcliente);

        $stmt->execute();
    }
    #endregion

    #region SELECT
    public function select()
    {
        return "SELECT
                      &*&  
                    FROM
                        &cliente&";
    }
    #endregion

    #region DELETE
    #endregion

    #region BUSCA CLIENTE
    public function buscaCliente($campos)
    {
        $query = $this->select();
        $camposVal = $this->verificaCamposBuscaCliente($campos);

        // ADICIONA OS CAMPOS NECESSARIOS DO RETORNO
        $query = str_replace("&*&", $camposVal["retornosQuery"], $query);
        // ADICIONA OS CAMPOS NECESSARIOS A BUSCA
        $query = str_replace("&cliente&", $camposVal["camposQuery"], $query);

        $stmt = $this->_conn->prepare($query);
        foreach($camposVal["params"] as $key => $value)
        {
            $stmt->bindValue($key, $value);
        }

        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $id_busca = geraCodigo();

        $_SESSION['lista_cliente'. $id_busca] = $resultado;

        return array("resultado" => $resultado, "id_pesquisa" => $id_busca);
    }
    #endregion

    #region BUSCA CLIENTE ID
    public function buscaClienteId($idcliente)
    {
        
        $query = $this->select();

        // ADICIONA OS CAMPOS NECESSARIOS DO RETORNO
        $query = str_replace("&*&", "endereco.*, cliente.* ", $query);
        // ADICIONA OS CAMPOS NECESSARIOS A BUSCA
        $query = str_replace("&cliente&", $camposVal["camposQuery"], $query);
        
        $id_busca = geraCodigo();

        $_SESSION['lista_cliente'. $id_busca] = $resultado;
        return array("resultado" => $resultado, "id_pesquisa" => $id_busca);
    }
    #endregion
    
    #region VERIFICA CAMPOS DA BUSCA
    public function verificaCamposBuscaCliente($campos)
    {
        $camposQuery = "cliente WHERE 1=1";
        $retornosQuery = " * ";
        $params = [];
        $cont = 0;

        if($campos["nomecliente"] != "")
        {
            $camposQuery .= " AND nomecliente LIKE :nomecliente";
            $retornosQuery .= "";
            $params[":nomecliente"] = "%".filtraCampos($campos["nomecliente"], 2)."%";

        }

        if($campos["cpf"] != "")
        {
            $camposQuery .= " AND cpf LIKE :cpf";
            $retornosQuery .= "";
            $params[":cpf"] = "%".filtraCampos($campos["cpf"], 3)."%";

        }

        if($campos["dataNascimento"] != "")
        {
            $camposQuery .= " AND dataNascimento = :dtNascimento";
            $retornosQuery .= "";
            $params[":dtNascimento"] = filtraCampos($campos["dataNascimento"], 5);

        }

        if($campos["rg"] != "")
        {
            $camposQuery .= " AND rg LIKE :rg";
            $retornosQuery .= "";
            $params[":rg"] = "%".filtraCampos($campos["rg"], 3)."%";

        }

        if($campos["telefone"] != "")
        {
            $camposQuery .= " AND telefone LIKE :telefone";
            $retornosQuery .= "";
            $params[":telefone"] = "%".filtraCampos($campos["telefone"], 3)."%";

        }

        return array(
                    "camposQuery" => $camposQuery,
                    "retornosQuery" => $retornosQuery,
                    "params" => $params
                );
    }
    #endregion
}
#endregion
?>