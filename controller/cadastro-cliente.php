<?php
require_once("../layout/dao-loader.php");

$_POST["btnSalvarCliente"] = TRUE;
if(isset($_POST["btnSalvarCliente"]))
{
    try
    {
        $conn = new ConexaoMySql();
        $clienteDao = new ClienteDao($conn);
        $enderecoDao = new EnderecoDao($conn);
        
        $conexao = $clienteDao->getConn();
        $enderecoDao->setConn($conexao);
        $conexao->beginTransaction();

        if(isset($_POST["cont"]) && $_POST["cont"] != "")
        {// ALTERAR O CLIENTE
            $idCliente = $_SESSION["lista_cliente" . $_POST["id_pesquisa"]][$_POST["cont"]]["idcliente"];
            $enderecosCliente = trataEnderecoForm($_POST, $_POST["contEndereco"]);

            if(count($enderecosCliente) > 0)
            {
                $res_add_cli = $clienteDao->update($idCliente, $_POST);
                $enderecos = $enderecoDao->comparaEnderecoCliente($idCliente, $enderecosCliente);

                foreach($enderecos["adicionar"] as $key => $add)
                {// ADICIONA NOVOS ENDEREÇOS
                    $res_end = $enderecoDao->insert($add);

                    $res_add_end = $enderecoDao->insertEnderecoCliente($idCliente, $res_end["insertId"]);
                }

                foreach($enderecos["remover"] as $key => $remove)
                {// REMOVE ENDEREÇOS
                    $res_remov = $enderecoDao->remove($remove["idendereco"]);
                }
            }
        }   
        else
        {// ADICIONAR O CLIENTE
            $enderecosCliente = trataEnderecoForm($_POST, $_POST["contEndereco"]);
            if(count($enderecosCliente) > 0)
            {
                $resultado_cliente = $clienteDao->insert($_POST);
                
                foreach($enderecosCliente as $end)
                {
                    $resultado_end = $enderecoDao->insert($end);

                    $resultado = $enderecoDao->insertEnderecoCliente($resultado_cliente["insertId"], $resultado_end["insertId"]);
                }
            }
        }

        if($resultado["erro"][1] == null)
        {
            ?>
            <script>
                localStorage.setItem("alerta", "Cadastro/Alteração realizado(a) com sucesso!");
            </script>
            <?php
        }
        else
        {
            ?>
            <script>
                localStorage.setItem("alerta", "Houve um erro ao fazer o(a) cadastro/alteração do usuario");
            </script>
            <?php
        }

        $conexao->commit();
    }
    catch(Exception $ex)
    {
        $conexao->rollback();
        ?>
        <script>
            localStorage.setItem("alerta", "Houve um erro no cadastro/alteração; Erro:".$ex);
        </script>
        <?php
    }

    redireciona("../pesquisa-cliente", []);
}