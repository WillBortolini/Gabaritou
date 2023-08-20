<?php
require_once("conexao.php");

session_start();

    if (isset($_SESSION["CPF"])) { 

        if (isset($_POST["txtnome"])){
        $ra = $_GET["RA"];
        $nome = $_POST["txtnome"];
        $email = $_POST["txtemail"];
        $senha = $_POST["txtsenha"];
        $turma = $_POST["ddlturma"];

        $sql = "UPDATE aluno    
                SET nome = '$nome', 
                email = '$email',     
                senha = '$senha',
                turma_idturma = $turma
                WHERE RA = $ra";

        if ($conn->query($sql) === TRUE) {
            ?>
            <script>
                alert("Registro atualizado com sucesso!");
                window.location = "selecionaraluno.php";
            </script>
            <?php
        }
        else{
            ?>
            <script>
                alert("Erro ao atualizar o registro!");
                //window.history.back();
            </script>
            <?php
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

    <title>Editar Aluno</title>


    <script>
        //função para confirmar senha
        function validarSenha() {
            //declara as variáveis e recebe os elementos
            var txtsenha = document.getElementById("txtsenha"),
                txtconfirmasenha = document.getElementById("txtconfirmasenha");
            //compara as duas senhas
            if (txtsenha.value != txtconfirmasenha.value) {
                //emite o alerta para a caixa de texto
                txtconfirmasenha.setCustomValidity("Senhas diferentes!");
                //alert (txtSenha.value + " - " + txtConfirmaSenha.value)
                //retona false e não submete o form
                return false;
            } else {
                //limpa o alerta da caixa de texto
                txtconfirmasenha.setCustomValidity("");
                //retorna true e submete o form
                return true;
            }
        }
    </script>

</head>

<body style="text-align:center;">
    <?php
    if (isset($_SESSION["CPF"])) {
        require_once("telaprofessor.php");
        if ($_SESSION["tipo"] === "A") {
    ?>
            <h2 class="text-center mb-1 mt-2">EDITAR ALUNO</h2>

            <?php
            if (isset($_GET["RA"])) {
                $RA = $_GET["RA"];
                $sql = "SELECT * from aluno where RA = $RA";
                $consulta = $conn->query($sql);
                $aluno = $consulta->fetch_assoc();
            }
            ?>

            <form action="editaraluno.php?RA=<?php echo $_GET['RA'] ?>" method="post">
                <div class="form-group row">
                    <label class="col-sm-2 font-weight-bold col-form-label text-right" for="txtRA">RA</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="txtRA" value="<?php echo $aluno["RA"] ?>" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 font-weight-bold col-form-label text-right" for="txtnome">Nome</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="txtnome" value="<?php echo $aluno["nome"] ?>" required placeholder="Digite o nome" autofocus>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 font-weight-bold col-form-label text-right" for="txtemail">E-mail</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" name="txtemail" value="<?php echo $aluno["email"] ?>" required placeholder="Digite o e-mail">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 font-weight-bold col-form-label text-right" for="txtsenha">Senha</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="password" id="txtsenha" name="txtsenha" required placeholder="Digite a senha">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 font-weight-bold col-form-label text-right" for="txtconfirmasenha">Confirmar Senha</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="password" id="txtconfirmasenha" name="txtconfirmasenha" required placeholder="Digite a senha">
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-sm-2 font-weight-bold col-form-label text-right" for="ddlturma">Turma</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="ddlturma" id="ddlturma">
                            <option value="">Selecione uma turma...</option>
                            <?php
                            //incluir o arquivo de conexão
                            include_once('conexao.php');

                    
                            //criar o comando sql
                            $sql = "SELECT idturma, nomeTurma
                                    FROM turma
                                    ORDER BY nomeTurma";
                            //executa o comando sql
                            $turma = $conn->query($sql);

                            //pego linha por linha da matriz com o resultado
                            while ($rowturma = $turma->fetch_assoc()) {
                            ?>
                                <option value="<?php echo $rowturma["idturma"];?>" <?php echo ($rowturma['idturma'] == $aluno['turma_idturma']) ? "selected" : "" ?>><?php echo $rowturma["nomeTurma"]; ?></option>

                            <?php
                            }
                            ?>
                        </select>

                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2"></label>
                    <div class="col-sm-8">
                        <input style="background-color: green; border-color: green" class="btn btn-primary " type="submit" value="Atualizar" onclick="validarSenha()">
                        <input style="background-color: #75F95E; border-color: #75F95E"  class="btn btn-warning" type="reset" value="Limpar">
                    </div>
                </div>

            </form>

        <?php
        } else {
        ?>
            <div class="alert alert-warning">
                <p>Usuário não autorizado!</p>
                <p>Entre em contato com o administrador do sistema.</p>
            </div>

        <?php
        }
    } else {
        ?>
        <div class="alert alert-warning">
            <p>Usuário não autenticado!</p>
            <a href="index.php">Se identifique aqui</a>
        </div>
    <?php } ?>

</body>

</html>
<?php
} else {
    echo "Usuário não autenticado!";
?>
    <a href="index.php">Se identifique aqui</a>
<?php
}
?>

