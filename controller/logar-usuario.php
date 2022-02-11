<?php
require_once("../layout/dao-loader.php");

if(isset($_POST["btnLogar"]))
{
    $funcoes = new Funcoes();
    $usuario = new Usuario(array(
                                "emailusuario" => $_POST["login"],
                                "senhausuario" => $_POST["senha"]
                            ), $conexao);
    if($usuario->login())
    {
        $funcoes->redireciona("../admin", []);
    }
}