<?php
require_once("../layout/dao-loader-unauthorized.php");

if(isset($_POST["btnLogar"]))
{
    $ud = new UsuarioDao(new ConexaoMySql);

    try
    {             
        if($ud->login($_POST)) 
        {
            $status =  1;
            $msg = "Login realizado com sucesso!";
        } 
        else
        {
            $status =  0;
            $msg = "Login ou senha invalidos! Tente novamente!";
        }
    }
    catch(Exception $ex)
    {   
        $status = 0;
        $msg = "Ocorreu um erro ao efetuar login: ".$ex;
    }
    
    echo json_encode(array("status"=> $status, "mensagem"=> $msg));
}