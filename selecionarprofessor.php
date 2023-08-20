<?php
require_once("conexao.php");
session_start();

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Professores</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function confirmarExclusao(CPF, nome) {
            if (window.confirm("Deseja realmente excluir o registro: \n" + CPF + " - " + nome)) {
                window.location = "excluirprofessor.php?CPF=" + CPF;
            }
        }
    </script>

</head>

<body>
    <?php
    if (isset($_SESSION["CPF"])) {
        require_once("telaprofessor.php");
    ?>    
    <h2 class="text-center mb-1 mt-2">PROFESSORES CADASTRADOS</h2>
    <?php

        $sql = "SELECT*
        FROM professor
        order by nome";

        $dadosprofessor = $conn->query($sql);

        if($dadosprofessor ->num_rows > 0){
            ?>
            <table class=" table table-striped">
                <tr>
                    <th>CPF</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Editar</th>
                    <th>Excluir</th>
                    <?php
                    while($exibir = $dadosprofessor->fetch_assoc()){
                        ?>
                        <tr>
                            <td><?php echo $exibir["CPF"]?></td>
                            <td><?php echo $exibir["nome"]?></td>
                            <td><?php echo $exibir["email"]?></td>

                            <td><a href="editarprofessor.php?CPF=<?php echo $exibir["CPF"]?>" style="color: green;" title="Editar Professor"><i class="fa fa-edit"></i></td>
                            <td>
                            <a href="#" title="Excluir Professor" style="color: green;" onclick="confirmarExclusao(
                            '<?php echo $exibir["CPF"] ?>')">
                            <i class="fa fa-trash"></i>
                                 </a>
                            </td>
                        </tr>

                        <?php
                    }
                    ?>
                </tr>
            </table>

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

</html>