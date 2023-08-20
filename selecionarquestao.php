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
    <title>Lista de Questões</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function confirmarExclusao(idquestao) {
            if (window.confirm("Deseja realmente excluir a questão: \n" + idquestao )) {
                window.location = "excluirquestao.php?idquestao=" + idquestao;
            }
        }
    </script>

</head>

<body>
    <?php
    if (isset($_SESSION["CPF"])) {
        require_once("telaprofessor.php");
    ?>
    <h2 class="text-center mb-1 mt-2">QUESTÕES CADASTRADAS</h2>
    <?php

        $sql = "SELECT*
        FROM questao
        order by idProvaOnline";



        $dadosquestao = $conn->query($sql);

        if($dadosquestao ->num_rows > 0){
            ?>
            <table class=" table table-striped">
                <tr>
                    <th>ID questão</th>
                    <th>ID prova</th>
                    <th>Enunciado</th>
                    <th>Alternativa A</th>
                    <th>Alternativa B</th>
                    <th>Alternativa C</th>
                    <th>Alternativa D</th>
                    <th>Alternativa correta</th>
                    <th>Editar</th>
                    <th>Excluir</th>
                    <?php
                    while($exibir = $dadosquestao->fetch_assoc()){
                        ?>
                        <tr>
                            <td><?php echo $exibir["idquestao"]?></td>
                            <td><?php echo $exibir["idProvaOnline"]?></td>
                            <td><?php echo $exibir["enunciado"]?></td>
                            <td><?php echo $exibir["alternativa_a"]?></td>
                            <td><?php echo $exibir["alternativa_b"]?></td>
                            <td><?php echo $exibir["alternativa_c"]?></td>
                            <td><?php echo $exibir["alternativa_d"]?></td>
                            <td><?php echo $exibir["alternativa_correta"]?></td>
                            
                            <td><a href="editarquestao.php?idquestao=<?php echo $exibir["idquestao"]?>" style="color: green;" title="Editar questão"><i class="fa fa-edit"></i></td>
                            <td>
                                <a href="#" title="Excluir questão" style="color: green;" onclick="confirmarExclusao(
                            '<?php echo $exibir["idquestao"] ?>')">
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

    ?><?php
} else {
?>
    <div class="alert alert-warning">
        <p>Usuário não autenticado!</p>
        <a href="index.php">Se identifique aqui</a>
    </div>
<?php } ?>


</body>

</html>