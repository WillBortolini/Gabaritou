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

    <title>Criar Questão</title>

</head>

<body style="text-align:center;">
<?php
    if (isset($_SESSION["CPF"])) {
        require_once("telaprofessor.php");
    ?> 
    <h2 class="text-center mb-1 mt-2">CRIAR QUESTÃO</h2>
    <form action="inserirquestao.php" method="post">

        <div class="form-group row">
            <label class="col-sm-2 font-weight-bold col-form-label text-right" for="ddlprova">Escolha a Prova</label>
            <div class="col-sm-9">
                <select class="form-control" name="ddlprova" id="ddlprova">
                    <option value="">Selecione uma prova...</option>
                    <?php
                    //incluir o arquivo de conexão
                    include_once('conexao.php');

                    //buscar dados do dropdown no BD (tbestcivil)
                    //criar o comando sql
                    $sql = "SELECT idprova_online, descricao
                            FROM prova_online
                            ORDER BY idprova_online";
                    //executa o comando sql
                    $prova = $conn->query($sql);

                    //pego linha por linha da matriz com o resultado
                    while ($rowprova = $prova->fetch_assoc()) {
                    ?>
                        <option value="<?php echo $rowprova["idprova_online"]; ?>"><?php echo $rowprova["descricao"];?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        

        <div class="form-group row">
            <label class="col-sm-2 font-weight-bold col-form-label text-right" for="txtenunciado">Enunciado</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="txtenunciado" required placeholder="Digite o enunciado" autofocus>
            </div>
        </div>



        <div class="form-group row">
            <label class="col-sm-2 font-weight-bold col-form-label text-right" for="alternativa1">
                Alternativa A
                <input type="radio" name="qstcorreta" value="a"/>
            </label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="alternativa1" required placeholder="Digite uma alternativa" autofocus>
                
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 font-weight-bold col-form-label text-right" for="alternativa2">
                Alternativa B
                <input type="radio" name="qstcorreta" value="b"/>
            </label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="alternativa2" required placeholder="Digite uma alternativa" autofocus>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 font-weight-bold col-form-label text-right" for="alternativa3">
                Alternativa C
                <input type="radio" name="qstcorreta" value="c"/>
            </label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="alternativa3" required placeholder="Digite uma alternativa" autofocus>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 font-weight-bold col-form-label text-right" for="alternativa4">
                Alternativa D
                <input type="radio" name="qstcorreta" value="d"/>
            </label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="alternativa4" required placeholder="Digite uma alternativa" autofocus>
            </div>
        </div>
        

        <div class="form-group row">
            <label class="col-sm-1"></label>
            <div class="col-sm-9">
                <input style="background-color: green; border-color: green" class="btn btn-primary " type="submit" value="Enviar questão">
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