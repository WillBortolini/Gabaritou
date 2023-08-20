<?php
require_once("conexao.php");
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
    

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <title>Gabarito prova</title>

</head>

<body style="text-align:center;">
<?php
    if (isset($_SESSION["RA"]) || isset($_SESSION["CPF"])) {
        require_once("telainicio.php");
    ?>

    
    <h2 class="text-center mb-1 mt-2">GABARITO PROVA</h2>
    <table class=" table table-striped">
                <?php

                $idprova = $_GET["idprova_online"];

                $sql = "SELECT * 
                from questao
                where idProvaOnline = $idprova";

                $resultado = $conn->query($sql);
                $questao = 1;

                if($resultado ->num_rows > 0){
                ?>
                
                <tr>
                    <th>Questão</th>
                    <th>Resposta</th>
                    <?php
                    while($exibir = $resultado->fetch_assoc()){
                        ?>
                        <tr>
                            <td><?php echo $questao?></td>
                            <td><?php echo $exibir["alternativa_correta"]?></td>
                        </tr>
                        
                        <?php
                        $questao = $questao + 1;
                    }
                    ?>
                </tr>
            </table>
        <?php
            } else{
                ?>
                <h2>Não há gabarito para essa prova</h2>
                <?php
            }
        ?>
    <?php
    } else {
    ?>
        <div class="alert alert-warning">
            <p>Usuário não autenticado!</p>
            <a href="index.php">Se identifique aqui</a>
        </div>
    <?php } ?>
</body>


</hmtl>