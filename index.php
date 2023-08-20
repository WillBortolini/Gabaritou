<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <div class="container mt-3">
        <h2>Formulário de login</h2>

        <form action="login.php" method="post">

            <div class="mb-3 mt-3">
                <label for="txtUser">Usuário:</label>
                <input type="text" class="form-control" name="txtUser" id="txtUser" required autofocus placeholder="Informe o RA ou Email">
            </div>

            <div class="mb-3">
                <label for="txtPassword">Senha:</label>
                <input type="password" class="form-control" name="txtPassword" id="txtPassword" placeholder="Informe a senha" required>
            </div>

            <input style="background-color: green; border-color: green" type="submit" class="btn btn-primary" value="Confirmar">
            <input style="background-color: #75F95E; border-color: #75F95E" type="reset" class="btn btn-warning" value="Cancelar">
        </form>
        <br>

        <?php
        if (isset($_SESSION["erro"])) {
            if ($_SESSION["erro"] === "Erro") {
        ?>
                <script>
                    document.getElementById("txtUser").focus();
                </script>
                <div id="erro" class="text-center alert alert-warning">
                    Usuário ou senha inválidos. Tente novamente.
                </div>
        <?php
                unset($_SESSION["erro"]);
            }
        }

        ?>
    </div>

    <script>
        $(document).ready(function() {
            setInterval(function() {
                $('#erro').fadeOut(1500);
            }, 3000);
        });
    </script>


</body>

</html>
