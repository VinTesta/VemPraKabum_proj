<?php
require_once("../layout/dao-loader.php");

if(isset($_POST["btnLogar"]))
{
    $funcoes = new Funcoes();
    $usuario = new Usuario(array(
                                "emailusuario" => $_POST["login"],
                                "senhausuario" => $_POST["senha"]
                            ), new ConexaoMySql());
    if($usuario->login())
    {
        $funcoes->redireciona("../admin", []);
    } 
    else
    {
        $funcoes->redireciona("../login", []);  
    }
}