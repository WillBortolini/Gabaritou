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
    <title>Lista de Alunos</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#form-pesquisa").submit(function(evento) {
                evento.preventDefault();
                let pesquisa = $("#pesquisa").val();
                let turma = $("#ddlturma").val();

                let dados = {
                    pesquisa: pesquisa,
                    turma: turma
                }

                $.post("buscaaluno.php", dados, function(retorna) {
                    $(".resultados").html(retorna);
                });
            });

            $('#ddlturma').change(function() {
            let pesquisa = $("#pesquisa").val();
            let turma = $("#ddlturma").val();

            let dados = {
                pesquisa: pesquisa,
                turma: turma
            }

            $.post("buscaaluno.php", dados, function(retorna) {
                $(".resultados").html(retorna);
            });
        });



        });

        

        function confirmarExclusao(ra, nome) {
            if (window.confirm("Deseja realmente excluir o registro: \n" + ra + " - " + nome)) {
                window.location = "excluiraluno.php?RA=" + ra;
            }
        }
    </script>
</head>

<body>
    <?php
    if (isset($_SESSION["CPF"])) {
        require_once("telaprofessor.php");
    ?>

        <h2 class="text-center mb-1 mt-2">ALUNOS CADASTRADOS</h2>
        <form id="form-pesquisa" action="" method="post">
            <div class="row">
                <div class="form-group col-sm-12">

                    <label for="pesquisa" class="font-weight-bold col-form-label-1 text-right">|        Informe o campo a ser pesquisado</label>

                    <div  class="col-sm-12">
                        <input type="text" class="form-control" name="pesquisa" id="pesquisa">
                    </div>

                    <label for="pesquisa" class="font-weight-bold col-form-label-1 text-right">|          Escolha uma sala</label>
                    
                    <div  class="col-sm-12" >
                        <select class="form-control" name="ddlturma" id="ddlturma">
                            <option value="0">Selecione uma turma</option>
                            <?php
                            //incluir o arquivo de conexão
                            include_once('conexao.php');
                            //buscar dados do dropdown no BD (turma)
                            //criar o comando sql
                            $sql = "SELECT *
                            FROM turma
                            ORDER BY nomeTurma";
                            //executar o comando sql
                            $turma = $conn->query($sql);

                            while ($rowTurma = $turma->fetch_assoc()) {
                            ?>
                                <option value="<?php echo $rowTurma['idturma'] ?>"><?php echo $rowTurma["nomeTurma"] ?></option>
                            <?php
                            }
                            ?>
                        </select>

                    </div>
                    <br>
                    <label  for=""></label>
                    <input style="background-color: green; border-color: green" type="submit" class="btn btn-primary" name="enviar" value="Pesquisar">
                </div>
            </div>
        </form>

        <div class="resultados">

        </div>
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