<?php
//incluir o aquivo de conexão com o BD
include_once("conexao.php");

//receber os dados que veio do form via POST
$idprova = $_POST["ddlprova"];
$enunciado = $_POST["txtenunciado"];
$qstcorreta = $_POST["qstcorreta"];
$alternativa1 = $_POST["alternativa1"];
$alternativa2 = $_POST["alternativa2"];
$alternativa3 = $_POST["alternativa3"];
$alternativa4 = $_POST["alternativa4"];

 



//criar o comando sql do insert
$sql = "INSERT INTO questao (idProvaOnline, enunciado, alternativa_correta, alternativa_a, alternativa_b, alternativa_c, alternativa_d)
VALUES ($idprova, '$enunciado', '$qstcorreta', '$alternativa1', '$alternativa2', '$alternativa3', '$alternativa4')";

//echo $sql;

//executar o comando sql
if ($conn->query($sql) === TRUE) {
    ?>
    <script>
        alert("Questão salva com sucesso!");
        window.location = "selecionarquestao.php";
    </script>
    
    <?php
}
else{
    ?>
        <script>
            alert("Erro ao inserir a questao");
            window.history.back(); //simula voltar do navegador
        </script>

    <?php
}

?>