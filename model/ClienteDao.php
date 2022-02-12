<?php
require_once("../util/funcoes.php");
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
                        cliente.idcliente
                       ,cliente.nomecliente
                       ,cliente.datanascimento
                       ,cliente.cpf
                       ,cliente.rg
                       ,cliente.telefone
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
        echo $query;
        var_dump($camposVal["params"]);
        foreach($camposVal["params"] as $key => $value)
        {
            $key++;
            $stmt->bindParam($key, $value);
        }
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        // FECHA CONEXÃO
        $conexao = null;

        var_dump($resultado);
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
            $camposQuery .= " AND nomecliente LIKE ?";
            $retornosQuery .= "";
            $params[$cont] = "%".filtraCampos($campos["nomecliente"], 2)."%";

            $cont++;
        }

        if($campos["cpf"] != "")
        {
            $camposQuery .= " AND cpf LIKE ?";
            $retornosQuery .= "";
            $params[$cont] = "%".filtraCampos($campos["cpf"], 3)."%";

            $cont++;
        }

        if($campos["dataNascimento"] != "")
        {
            $camposQuery .= " AND dataNascimento = ?";
            $retornosQuery .= "";
            $params[$cont] = filtraCampos($campos["dataNascimento"], 5);

            $cont++;
        }

        if($campos["rg"] != "")
        {
            $camposQuery .= " AND rg LIKE ?";
            $retornosQuery .= "";
            $params[$cont] = "%".filtraCampos($campos["rg"], 3)."%";

            $cont++;
        }

        if($campos["telefone"] != "")
        {
            $camposQuery .= " AND telefone LIKE ?";
            $retornosQuery .= "";
            $params[$cont] = "%".filtraCampos($campos["telefone"], 3)."%";

            $cont++;
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