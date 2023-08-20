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
    <title>Lista de Provas</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function confirmarExclusao(idprova_online) {
            if (window.confirm("Deseja realmente excluir a prova: \n" + idprova_online )) {
                window.location = "excluirprova.php?idprovaonline=" + idprova_online;
            }
        }
    </script>

</head>

<body>
    <?php
    if (isset($_SESSION["CPF"])) {
        require_once("telaprofessor.php");
    ?>
    <h2 class="text-center mb-1 mt-2">PROVAS CRIADAS</h2>
    <?php

        $sql = "SELECT*
        FROM prova_online
        order by idprova_online";



        $dadosprova = $conn->query($sql);

        if($dadosprova ->num_rows > 0){
            ?>
            <table class=" table table-striped">
                <tr>
                    <th>ID</th>
                    <th>Tempo de realização(em minutos)</th>
                    <th>Disciplina</th>
                    <th>Descrição</th>
                    <th>Editar</th>
                    <th>Excluir</th>
                    <?php
                    while($exibir = $dadosprova->fetch_assoc()){
                        ?>
                        <tr>
                            <td><?php echo $exibir["idprova_online"]?></td>
                            <td><?php echo $exibir["tempo_max_realizacao"]?></td>
                            <?php
                            //busca o estado civil de acordo com o código da tabela tbpessoa
                            $sqlDisciplina = "SELECT * FROM disciplina WHERE iddisciplina = " . $exibir["disciplina_iddisciplina"];
                            $dadosDisciplina = $conn->query($sqlDisciplina);
                            $disciplina = $dadosDisciplina->fetch_assoc();
                            ?>
                            <td><?php echo $disciplina["disciplina"] ?> </td>
                            <td><?php echo $exibir["descricao"]?></td>

                            <td><a href="editarprova.php?idprova_online=<?php echo $exibir["idprova_online"]?>" style="color: green;" title="Editar prova"><i class="fa fa-edit"></i></td>
                            <td>
                            <a href="#" title="Excluir Prova" style="color: green;" onclick="confirmarExclusao(
                            '<?php echo $exibir["idprova_online"] ?>')">
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