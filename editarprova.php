<?php
require_once("conexao.php");

session_start();

    if (isset($_SESSION["CPF"])) { 

        if (isset($_POST["descricao"])){
        $ID = $_GET["idprova_online"];
        $tempo = $_POST["tempo"];
        $disciplina = $_POST["ddldisciplina"];
        $descricao = $_POST["descricao"];

        $sql = "UPDATE prova_online   
                SET tempo_max_realizacao = $tempo, 
                disciplina_iddisciplina = '$disciplina',     
                descricao = '$descricao'
                WHERE idprova_online = $ID";

        //echo $sql;
        
        if ($conn->query($sql) === TRUE) {
            ?>
            <script>
                alert("Prova atualizada com sucesso!");
                window.location = "selecionarprova.php";
            </script>
            <?php
        }
        else{
            ?>
            <script>
                alert("Erro ao atualizar prova!");
                //window.history.back();
            </script>
            <?php
        }
    }
}
   
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

    <title>Editar Prova</title>

</head>

<body style="text-align:center;">
<?php
    if (isset($_SESSION["CPF"])) {
        require_once("telaprofessor.php");
    ?> 
    
    <h2>Editar Prova</h2>

    <?php
        if (isset($_GET["idprova_online"])) {
            $ID = $_GET["idprova_online"];
            $sql = "SELECT * from prova_online where idprova_online = $ID";
            $consulta = $conn->query($sql);
            $prova = $consulta->fetch_assoc();
        }
    ?>


    <form action="editarprova.php?idprova_online=<?php echo $_GET['idprova_online'] ?>" method="post">

        <div class="form-group row">
            <label class="col-sm-2 font-weight-bold col-form-label text-right" for="idprova_online">ID da Prova</label>
            <div class="col-sm-9">
                <input  class="form-control" name="idprova_online" value="<?php echo $prova["idprova_online"] ?>" disabled>
            </div>
        </div>
        
        <div class="form-group row">
            <label class="col-sm-2 font-weight-bold col-form-label text-right" for="tempo">Tempo de realização da prova(Em minutos)</label>
            <div class="col-sm-9">
                <input type="number" class="form-control" name="tempo" value="<?php echo $prova["tempo_max_realizacao"] ?>" required placeholder="Digite o tempo de realização da prova" autofocus>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 font-weight-bold col-form-label text-right" for="descricao">Descricao</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="descricao" value="<?php echo $prova["descricao"] ?>" required placeholder="Digite a descicao" autofocus>
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
                                <option value="<?php echo $rowdisciplina["iddisciplina"];?>" <?php echo ($rowdisciplina['iddisciplina'] == $prova['disciplina_iddisciplina']) ? "selected" : "" ?>><?php echo $rowdisciplina["disciplina"]; ?></option>
                            <?php
                            }
                            ?>
                        </select>

                </div>
        </div>

    

 

        <div class="form-group row">
            <label class="col-sm-2"></label>
            <div class="col-sm-8">
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