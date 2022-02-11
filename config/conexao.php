<?php

interface ConexaoInterface
{
    public function conecta();
}

class ConexaoMySql implements ConexaoInterface
{
    public function conecta()
    {
        try {
            return new PDO("mysql:host=localhost;dbname=projeto_kabum", "root", "");
            date_default_timezone_set('America/Sao_Paulo');
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
    }
}
?>