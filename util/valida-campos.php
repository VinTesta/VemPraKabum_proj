<?php
require_once("../layout/dao-loader.php");

switch($_POST["opt"])
{
    case 1: //CPF
        echo validaCPF($_POST["doc"]);
        break;
    case 2: //RG
        $value = preg_replace('/[^0-9]/', "", $_POST["doc"]);

        if (strlen($value) !== 9) {
            echo 0;
        }
        else
        {
            echo 1;
        }

        break;
}