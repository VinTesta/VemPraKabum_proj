<?php
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

    #region SELECT
    public function select()
    {
        return "&SELECT& 
                            *
                        FROM
                            &endereco&";
    }
    #endregion


    #region SELECT ENDERECO CLIENTE
    public function selectEnderecoCliente($idcliente)
    {
        $conexao = $this->_conn;
        $query = $this->select();

        $query = str_replace("&SELECT&", "SELECT", $query);
        $query = str_replace("&endereco&", "endereco, 
                                            cliente, 
                                            enderecocliente 
                                        WHERE 
                                            1 = 1
                                            AND endereco.idendereco = enderecocliente.endereco_idendereco
                                            AND cliente.idcliente = enderecocliente.cliente_idcliente
                                            AND cliente.idcliente = :idcliente", $query);

        $stmt = $conexao->prepare($query);
        $stmt->bindValue(":idcliente", $idcliente);
        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $resultado;
    }
    #endregion
}