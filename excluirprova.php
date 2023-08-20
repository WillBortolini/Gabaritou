<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<?php
require_once("conexao.php");
session_start();

if (isset($_SESSION["CPF"])) {
        if (isset($_GET["idprova_online"])) {
            $ID = $_GET["idprova_online"];

            $sql = "DELETE FROM prova_online WHERE idprova_online = $ID";

            if ($conn->query($sql) === TRUE) {
?>
                <script>
                    alert("Prova excluída com sucesso.");
                    window.location = "selecionarprova.php";
                </script>

            <?php

            } else {
            ?>
                <script>
                    alert("Erro ao excluir prova.");
                    window.history.back();
                </script>
        <?php

            }
        }
} else {
    ?>
    <div class="alert alert-warning text-center">
        <p>Usuário não autenticado!</p>
        <p>Entre em contato com o administrador.</p>
        <p><a href="index.php">Tela de login</a></p>

    </div>
<?php
}
?>