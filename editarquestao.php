<?php
require_once("conexao.php");

session_start();

if (isset($_SESSION["CPF"])) { 

    
    if (isset($_POST["ddlprova"])){
    $idprova = $_POST["ddlprova"];
    $enunciado = $_POST["txtenunciado"];
    $alternativa1 = $_POST["alternativa1"];
    $alternativa2 = $_POST["alternativa2"];
    $alternativa3 = $_POST["alternativa3"];
    $alternativa4 = $_POST["alternativa4"];
    $altenativacorreta = $_POST["qstcorreta"];

    $sql = "UPDATE questao   
            SET enunciado = '$enunciado', 
            alternativa_correta = '$alternativacorreta',     
            alternativa_a = '$alternativa1',
            alternativa_b = '$alternativa2',
            alternativa_c = '$alternativa3',
            alternativa_d = '$alternativa4'
            WHERE idProvaOnline = $idprova";

    //echo $sql;
    
    if ($conn->query($sql) === TRUE) {
        ?>
        <script>
            alert("Questão atualizada com sucesso!");
            window.location = "selecionarprofessor.php";
        </script>
        <?php
    }
    else{
        ?>
        <script>
            alert("Erro ao atualizar questão!");
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

    <title>Editar Questão</title>

</head>

<body style="text-align:center;">
<?php
    if (isset($_SESSION["CPF"])) {
        require_once("telaprofessor.php");
    ?> 
        <h2>Editar questão</h2>
        <?php
           if (isset($_GET["idquestao"])) {
            $idquestao = $_GET["idquestao"];
            $sql = "SELECT * from questao where idquestao = $idquestao";
            $consulta = $conn->query($sql);
            $questao = $consulta->fetch_assoc();
        }
        ?>

    <form action="editarquestao.php?idquestao=<?php echo $_GET['idquestao'] ?>"method="post">

        <div class="form-group row">
            <label class="col-sm-2 font-weight-bold col-form-label text-right" for="ddlprova">Escolha a Prova</label>
            <div class="col-sm-9">
                <select class="form-control" name="ddlprova" id="ddlprova">
                    <option value="">Selecione uma prova...</option>
                    <?php
                    //incluir o arquivo de conexão
                    include_once('conexao.php');

                    //criar o comando sql
                    $sql = "SELECT idprova_online, descricao
                            FROM prova_online
                            ORDER BY idprova_online";
                    //executa o comando sql
                    $prova = $conn->query($sql);

                    //pego linha por linha da matriz com o resultado
                    while ($rowprova = $prova->fetch_assoc()) {
                    ?>
                        <option value="<?php echo $rowprova["idprova_online"]; ?>" <?php echo ($rowprova['idprova_online'] == $questao['idProvaOnline']) ? "selected" : "" ?>><?php echo $rowprova["descricao"]; ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        

        <div class="form-group row">
            <label class="col-sm-2 font-weight-bold col-form-label text-right" for="txtenunciado">Enunciado</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="txtenunciado" value="<?php echo $questao["enunciado"] ?>"  required placeholder="Digite o enunciado" autofocus>
            </div>
        </div>



        <div class="form-group row">
            <label class="col-sm-2 font-weight-bold col-form-label text-right" for="alternativa1">
                Alternativa A
                <input type="radio" name="qstcorreta" value="a"<?php if ($questao['alternativa_correta'] === 'a'){ ?> checked <?php } ?>/>
            </label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="alternativa1" value="<?php echo $questao["alternativa_a"] ?>" required placeholder="Digite uma alternativa" autofocus>
                
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 font-weight-bold col-form-label text-right" for="alternativa2">
                Alternativa B
                <input type="radio" name="qstcorreta" value="b"<?php if ($questao['alternativa_correta'] === 'b'){ ?> checked <?php } ?>/>
            </label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="alternativa2" value="<?php echo $questao["alternativa_b"] ?>" required placeholder="Digite uma alternativa" autofocus>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 font-weight-bold col-form-label text-right" for="alternativa3">
                Alternativa C
                <input type="radio" name="qstcorreta" value="c"<?php if ($questao['alternativa_correta'] === 'c'){ ?> checked <?php } ?>/>
            </label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="alternativa3" value="<?php echo $questao["alternativa_c"] ?>" required placeholder="Digite uma alternativa" autofocus>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 font-weight-bold col-form-label text-right" for="alternativa4">
                Alternativa D
                <input type="radio" name="qstcorreta" value="d"<?php if ($questao['alternativa_correta'] === 'd'){ ?> checked <?php } ?>/>
            </label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="alternativa4" value="<?php echo $questao["alternativa_d"] ?>" required placeholder="Digite uma alternativa" autofocus>
            </div>
        </div>
        

        <div class="form-group row">
            <label class="col-sm-2"></label>
            <div class="col-sm-8">
                <input style="background-color: green; border-color: green;" class="btn btn-primary " type="submit" value="Enviar questão">
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