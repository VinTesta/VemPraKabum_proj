<?php
require_once("../layout/dao-loader-unauthorized.php");
require_once("../layout/toast-alert.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - VemPraKabum</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- DATATABLES CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">

    <!-- FONT AWESOME -->
    <script src="https://kit.fontawesome.com/072fea83f9.js" crossorigin="anonymous"></script>

    <!-- BOXICONS -->
    <script src="https://unpkg.com/boxicons@2.1.1/dist/boxicons.js"></script>

    <link rel="stylesheet" href="web/css/projcss.css">
</head>
<body>
    <div class="bodyContainer">
        <div id="containerLogin">
            <div id="boxLogin" class="col-lg-3 col-12">
                <div id="form">
                    <div id="boxLogin" class="col-10">
                        <h3 id="logoErp">ADMIN PANEL</h3>
                        <h3 id="logoErp">LOGIN</h3>
                        <label for="email">Usuario:</label>
                        <input type="text" id="email" name="email" class="form-control validate-form mb-4 input-login" />
                        <label for="senha">Senha: </label>
                        <input type="password" class="form-control validate-form mb-4 input-login" name="senha" id="senha" />
                        <button name="btnLogar" id="btnLogar" class="btn btn-primary mb-3 col-12">Login</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        &copy; Vinicius Testa Passos
    </div>
    <!-- JQUERY -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- BOOTSTRAP -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- DATATABLE JS -->
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
    
    <script src="web/js/projjs.js"></script>
    
    <!-- JQUERY MASK -->
    <script src="web/js/jquery.mask.min.js"></script>
    <script src="web/js/jquery.mask.js"></script>
</body>
</html>