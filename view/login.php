<?php
require_once("../layout/dao-loader.php");
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

    <link rel="stylesheet" href="src/css/projcss.css">
</head>
<body>

    <div id="containerLogin">
        <div id="boxLogin" class="col-lg-3 col-12">
            <form method="post" action="controller/logar-usuario.php">
                <div id="boxLogin" class="col-10">
                    <h3 id="logoErp">ADMIN PANEL</h3>
                    <h3 id="logoErp">LOGIN</h3>
                    <label for="usuario">Usuario:</label>
                    <input type="text" id="login" name="login" class="form-control mb-4 input-login" />
                    <label for="senha">Senha: </label>
                    <input type="password" class="form-control mb-4 input-login" name="senha" id="senha" />
                    <button type="submit" name="btnLogar" class="btn btn-primary mb-3 col-12">Login</button>
                    <div id="footerLogin">
                        &copy; Vinicius Testa Passos
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <!-- JQUERY -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- BOOTSTRAP -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- DATATABLE JS -->
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
</body>
</html>