<?php
function redireciona($url, $values)
{
    header("Location: ".$url);
}

function filtraCampos($campo, $tipoCampo)
{
    switch($tipoCampo)
    {
        case 1://FILTRAR E-MAIL
            $campo = filter_var($campo, FILTER_SANITIZE_EMAIL);
            break;
        case 2://FILTRA CAMPOS PADRÃO DE TEXTO >> SEM CARACTERES ESPECIAIS
            $campo = filter_var($campo, FILTER_SANITIZE_STRING);
            $campo = preg_replace('/[\@\.\;\-\_\,\(\)]+/', '', $campo);
            $campo = strtoupper($campo);
            break;
        case 3://FILTRA INT
            $campo = filter_var($campo, FILTER_SANITIZE_NUMBER_INT);
            $campo = preg_replace('/[\@\.\;\-\_\,]+/', '', $campo);
            break;
        case 4://FILTRA FLOAT
            $campo = filter_var($campo, FILTER_SANITIZE_NUMBER_FLOAT);
            break;
        case 5://FILTRA DATA (dd/mm/YYYY) -> (YYYY-mm-dd)
            $campo = explode("/", $campo);
            $campo = $campo[2] . "-" . $campo[1] . "-" . $campo[0];
            break;
        default:
            $campo = filter_var($campo, FILTER_SANITIZE_STRING);
            $campo = strtoupper($campo);
            break;
    }

    return $campo;
}

function logado()
{
    session_start();
    $_SESSION["login"] != null
        ? true
        : redireciona("http://localhost/vemprakabum_proj/login", []);
}

function geraCodigo() {//função para gerar um código a partir do sha1 da hora atual  
    $cod = sha1(microtime());
    return $cod;
}

function trataEnderecoForm($params, $cont)
{
    for ($i=0; $i <= $cont; $i++) { 
        if(isset($params["cep".$i]))
        {
            $enderecos[] = array(
                "idendereco" => $params["idendereco".$i],
                "logradouro" => $params["logradouro".$i],
                "bairro" => $params["bairro".$i],
                "numero" => $params["numero".$i],
                "cidade" => $params["cidade".$i],
                "estado" => $params["estado".$i],
                "cep" => $params["cep".$i],
                "pais" => $params["pais".$i]
            );
        }
        
    }

    return $enderecos;
}

function validaCPF($value) {

    $value = preg_replace('/[^0-9]/', "", $value);

    if (strlen($value) !== 11 || preg_match('/(\d)\1{10}/', $value)) {
        return 0;
    }

    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $value{$c} * (($t + 1) - $c);
        }

        $d = ((10 * $d) % 11) % 10;

        if ($value{$c} != $d) {
            return 0;
        }
    }

    return 1;
}

?>