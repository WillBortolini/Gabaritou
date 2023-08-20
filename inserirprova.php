<?php
//incluir o aquivo de conexão com o BD
include_once("conexao.php");

//receber os dados que veio do form via POST
$tempo = $_POST["tempo"];
$descicao = $_POST["descricao"];
$disciplina = $_POST["ddldisciplina"];



//criar o comando sql do insert
$sql = "INSERT INTO prova_online (tempo_max_realizacao, disciplina_iddisciplina, descricao)
VALUES ($tempo, $disciplina , '$descicao')";

//echo $sql;

//executar o comando sql
if ($conn->query($sql) === TRUE) {
    ?>
    <script>
        alert("Registro salvo com sucesso!");
        window.location = "criarprova.php";
    </script>
    
    <?php
}
else{
    ?>
        <script>
            alert("Erro ao inserir a prova");
            window.history.back(); //simula voltar do navegador
        </script>

    <?php
}

?>