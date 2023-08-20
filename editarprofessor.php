<?php
require_once("conexao.php");

session_start();

    if (isset($_SESSION["CPF"])) { 

        if (isset($_POST["txtnome"])){
        $CPF = $_GET["CPF"];
        $nome = $_POST["txtnome"];
        $email = $_POST["txtemail"];
        $senha = $_POST["txtsenha"];

        $sql = "UPDATE professor   
                SET nome = '$nome', 
                email = '$email',     
                senha = '$senha'
                WHERE CPF = $CPF";

        //echo $sql;
        
        if ($conn->query($sql) === TRUE) {
            ?>
            <script>
                alert("Registro atualizado com sucesso!");
                window.location = "selecionarprofessor.php";
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

    <title>Editor de Professor</title>


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
        
    ?>
            <h2 class="text-center mb-1 mt-2">EDITAR PROFESSOR</h2>

            <?php
            if (isset($_GET["CPF"])) {
                $CPF = $_GET["CPF"];
                $sql = "SELECT * from professor where CPF = $CPF";
                $consulta = $conn->query($sql);
                $professor = $consulta->fetch_assoc();
            }
            ?>

            <form action="editarprofessor.php?CPF=<?php echo $_GET['CPF'] ?>" method="post">
                <div class="form-group row">
                    <label class="col-sm-2 font-weight-bold col-form-label text-right" for="CPF">CPF</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="CPF" value="<?php echo $professor["CPF"] ?>" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 font-weight-bold col-form-label text-right" for="txtnome">Nome</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="txtnome" value="<?php echo $professor["nome"] ?>" required placeholder="Digite o nome" autofocus>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 font-weight-bold col-form-label text-right" for="txtemail">E-mail</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" name="txtemail" value="<?php echo $professor["email"] ?>" required placeholder="Digite o e-mail">
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
                    <label class="col-sm-2"></label>
                    <div class="col-sm-8">
                        <input style="background-color: green; border-color: green"  class="btn btn-primary " type="submit" value="Atualizar" onclick="validarSenha()">
                        <input style="background-color: #75F95E; border-color: #75F95E"  class="btn btn-warning" type="reset" value="Limpar">
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

</html>
<?php
} else {
    echo "Usuário não autenticado!";
?>
    <a href="index.php">Se identifique aqui</a>
<?php
}
?>