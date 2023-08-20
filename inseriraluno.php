<?php
//incluir o aquivo de conexão com o BD
include_once("conexao.php");

//receber os dados que veio do form via POST
$RA = $_POST["txtra"];
$email = $_POST["txtemail"];
$nome = $_POST["txtnome"];
$senha = $_POST["txtsenha"];
$turma = $_POST["ddlturma"];

//criar o comando sql do insert
$sql = "INSERT INTO aluno (RA, email, nome, turma_idturma, senha)
VALUES ($RA, '$email', '$nome', $turma, '$senha')";

//echo $sql;

//executar o comando sql
if ($conn->query($sql) === TRUE) {
    ?>
    <script>
        alert("Registro salvo com sucesso!");
        window.location = "selecionaraluno.php";
    </script>
    
    <?php
}
else{
    ?>
        <script>
            alert("Erro ao inserir o registro");
            window.history.back(); //simula voltar do navegador
        </script>

    <?php
}

?>