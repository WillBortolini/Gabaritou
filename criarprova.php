<?php
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

    <title>Criar Prova</title>

</head>

<body style="text-align:center;">
<?php
    if (isset($_SESSION["CPF"])) {
        require_once("telaprofessor.php");
    ?> 
    <h2 class="text-center mb-1 mt-2">CRIAR PROVA</h2>
    <form action="inserirprova.php" method="post">
        
        <div class="form-group row">
            <label class="col-sm-2 font-weight-bold col-form-label text-right" for="tempo">Tempo de realização da prova(Em minutos)</label>
            <div class="col-sm-9">
                <input type="number" class="form-control" name="tempo" required placeholder="Digite o tempo de realização da prova" autofocus>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 font-weight-bold col-form-label text-right" for="descricao">Descricao</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="descricao" required placeholder="Digite a descrição" autofocus>
            </div>
        </div>

        <div class="form-group row">
                    <label class="col-sm-2 font-weight-bold col-form-label text-right" for="ddldisciplina">Disciplina</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="ddldisciplina" id="ddldisciplina">
                            <option value="">Selecione uma disciplina...</option>
                            <?php
                            //incluir o arquivo de conexão
                            include_once('conexao.php');

                            //buscar dados do dropdown no BD 
                            //criar o comando sql
                            $sql = "SELECT iddisciplina, disciplina
                                    FROM disciplina
                                    ORDER BY disciplina";
                            //executa o comando sql
                            $disciplina = $conn->query($sql);

                            //pego linha por linha da matriz com o resultado
                            while ($rowdisciplina = $disciplina->fetch_assoc()) {
                            ?>
                                <option value="<?php echo $rowdisciplina["iddisciplina"]; ?>"><?php echo $rowdisciplina["disciplina"]; ?></option>
                            <?php
                            }
                            ?>
                        </select>

                </div>
        </div>

    

 

        <div class="form-group row">
            <label class="col-sm-1"></label>
            <div class="col-sm-9">
                <input style="background-color: green; border-color: green" class="btn btn-primary " type="submit" value="Enviar prova">
                <input style="background-color: #75F95E; border-color: #75F95E" class="btn btn-warning" type="reset" value="Limpar">
            </div>
        </div>
        
    </form>
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