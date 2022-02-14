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

    #region INSERT
    #endregion

    #region UPDATE
    #endregion

    #region SELECT
    public function select()
    {
        return "&SELECT&
                        *
                    FROM
                        &cliente&";
    }
    #endregion

    #region DELETE
    #endregion

    #region BUSCA CLIENTE
    public function buscaCliente($campos)
    {

        $conexao = $this->_conn;
        $query = $this->select();
        $camposVal = $this->verificaCamposBuscaCliente($campos);

        // ADICIONA OS CAMPOS NECESSARIOS DO RETORNO
        $query = str_replace("&SELECT&", $camposVal["retornosQuery"], $query);
        // ADICIONA OS CAMPOS NECESSARIOS A BUSCA
        $query = str_replace("&cliente&", $camposVal["camposQuery"], $query);

        $stmt = $conexao->prepare($query);
        foreach($camposVal["params"] as $key => $value)
        {
            $stmt->bindValue($key, $value);
        }

        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // FECHA CONEXÃO
        $conexao = null;

        return $resultado;
    }
    #endregion

    #region VERIFICA CAMPOS DA BUSCA
    public function verificaCamposBuscaCliente($campos)
    {
        $camposQuery = "cliente WHERE 1=1";
        $retornosQuery = "SELECT ";
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