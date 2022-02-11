<?php

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try {
    //DESENVOLVIMENTO = migração localhost
    $conexao = mysqli_connect('localhost', 'root', '', 'projeto_kabum');

    mysqli_query($conexao, "SET NAMES 'utf8'");
    mysqli_query($conexao, 'SET character_set_connection=utf8');
    mysqli_query($conexao, 'SET character_set_client=utf8');
    mysqli_query($conexao, 'SET character_set_results=utf8');
    
    mysqli_autocommit($conexao, FALSE);

    date_default_timezone_set('America/Sao_Paulo');
} catch (Exception $e) {
    error_log($e->getMessage());
}

?>