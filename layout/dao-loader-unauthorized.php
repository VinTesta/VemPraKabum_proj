<?php

// error_reporting(E_ALL ^ E_NOTICE);
// ini_set('display_errors', true);

// error_reporting(0);

define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__ . "../config/conexao.php");

function carregaClasseModel($nomeDaClasse) {
    require_once ("../model/" . $nomeDaClasse . ".php");
}

spl_autoload_register("carregaClasseModel");

session_start();
session_destroy();

?>