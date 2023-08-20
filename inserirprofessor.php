<?php
//incluir o aquivo de conexão com o BD
include_once("conexao.php");

//receber os dados que veio do form via POST
$CPF = $_POST["txtcpf"];
$nome = $_POST["txtnome"];
$email = $_POST["txtemail"];
$senha = $_POST["txtsenha"];


//criar o comando sql do insert
$sql = "INSERT INTO professor (CPF, nome, email, senha)
VALUES ($CPF, '$nome', '$email', '$senha')";

//echo $sql;

//executar o comando sql
if ($conn->query($sql) === TRUE) {
    ?>
    <script>
        alert("Registro salvo com sucesso!");
        window.location = "selecionarprofessor.php";
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